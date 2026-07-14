<?php
namespace App\Core;

class Lang
{
    private static ?string $code = null;
    private static array $dict = [];

    public static function init(): void
    {
        $code = $_SESSION['lang'] ?? 'ar';
        if (!in_array($code, ['ar', 'fr'], true)) {
            $code = 'ar';
        }
        self::$code = $code;
        self::$dict = require dirname(__DIR__, 2) . "/config/lang/{$code}.php";
    }

    public static function code(): string
    {
        return self::$code ?? 'fr';
    }

    public static function isRtl(): bool
    {
        return self::code() === 'ar';
    }

    public static function dir(): string
    {
        return self::isRtl() ? 'rtl' : 'ltr';
    }

    public static function set(string $code): void
    {
        if (in_array($code, ['ar', 'fr'], true)) {
            $_SESSION['lang'] = $code;
        }
    }

    public static function t(string $key): string
    {
        return self::$dict[$key] ?? $key;
    }

    public static function tIn(string $code, string $key): string
    {
        static $dicts = [];

        if (!in_array($code, ['ar', 'fr'], true)) {
            $code = 'ar';
        }
        if (!isset($dicts[$code])) {
            $dicts[$code] = require dirname(__DIR__, 2) . "/config/lang/{$code}.php";
        }

        return $dicts[$code][$key] ?? $key;
    }
}
