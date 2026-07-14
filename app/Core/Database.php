<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $config = self::config();

            if (!$config['dbname']) {
                die('Erreur : DB_NAME non configure dans .env');
            }

            try {
                self::$pdo = new PDO(
                    self::dsn($config),
                    $config['user'],
                    $config['password'],
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => $config['emulate_prepares'],
                    ]
                );
            } catch (PDOException $e) {
                die('Erreur de connexion Supabase : ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }

    public static function driver(): string
    {
        return 'pgsql';
    }

    private static function config(): array
    {
        $url = $_ENV['DATABASE_URL'] ?? '';
        if ($url !== '') {
            $parts = parse_url($url);
            if ($parts === false || !str_starts_with($parts['scheme'] ?? '', 'postgres')) {
                die('Erreur : DATABASE_URL Supabase invalide');
            }

            return [
                'host'     => $parts['host'] ?? '',
                'port'     => isset($parts['port']) ? (string) $parts['port'] : '5432',
                'dbname'   => ltrim($parts['path'] ?? '', '/'),
                'user'     => isset($parts['user']) ? rawurldecode($parts['user']) : '',
                'password' => isset($parts['pass']) ? rawurldecode($parts['pass']) : '',
                'sslmode'  => $_ENV['DB_SSLMODE'] ?? 'require',
                'emulate_prepares' => self::boolEnv('DB_EMULATE_PREPARES', false),
            ];
        }

        return [
            'host'     => $_ENV['DB_HOST'] ?? '',
            'port'     => $_ENV['DB_PORT'] ?? '5432',
            'dbname'   => $_ENV['DB_NAME'] ?? 'postgres',
            'user'     => $_ENV['DB_USER'] ?? 'postgres',
            'password' => $_ENV['DB_PASSWORD'] ?? '',
            'sslmode'  => $_ENV['DB_SSLMODE'] ?? 'require',
            'emulate_prepares' => self::boolEnv('DB_EMULATE_PREPARES', false),
        ];
    }

    private static function dsn(array $config): string
    {
        $dsn = 'pgsql:host=' . $config['host'] . ';dbname=' . $config['dbname'];
        if ($config['port'] !== '') {
            $dsn .= ';port=' . $config['port'];
        }
        if ($config['sslmode'] !== '') {
            $dsn .= ';sslmode=' . $config['sslmode'];
        }

        return $dsn;
    }

    private static function boolEnv(string $key, bool $default): bool
    {
        $value = $_ENV[$key] ?? null;
        if ($value === null || $value === '') {
            return $default;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? $default;
    }
}
