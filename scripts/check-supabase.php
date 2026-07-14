<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once dirname(__DIR__) . '/app/Core/Database.php';

use App\Core\Database;

$host = $_ENV['DB_HOST'] ?? '';
$url  = $_ENV['DATABASE_URL'] ?? '';

if (
    str_contains($host, 'YOUR_PROJECT_REF')
    || str_contains($_ENV['DB_PASSWORD'] ?? '', 'YOUR_SUPABASE')
    || str_contains($url, 'YOUR_PROJECT_REF')
    || str_contains($url, 'YOUR_SUPABASE')
) {
    fwrite(STDERR, "Supabase is not configured yet. Update .env with your real Supabase connection details.\n");
    exit(2);
}

try {
    $pdo = Database::getConnection();
    $version = $pdo->query('SELECT version()')->fetchColumn();
    $table = $pdo->query("SELECT to_regclass('public.demandes')")->fetchColumn();

    echo "Connected to Supabase/Postgres.\n";
    echo "Server: " . preg_replace('/\s+/', ' ', (string) $version) . "\n";

    if ($table === 'demandes') {
        $count = $pdo->query('SELECT COUNT(*) FROM demandes')->fetchColumn();
        echo "Table demandes exists. Rows: {$count}\n";
    } else {
        echo "Table demandes is missing. Run database/supabase.sql in the Supabase SQL Editor.\n";
        exit(3);
    }
} catch (Throwable $e) {
    fwrite(STDERR, "Supabase connection failed: {$e->getMessage()}\n");
    exit(1);
}
