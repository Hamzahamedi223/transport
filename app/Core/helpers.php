<?php

function t(string $key): string
{
    return \App\Core\Lang::t($key);
}

function icon(string $name, string $class = ''): string
{
    static $cache = [];

    if (!isset($cache[$name])) {
        $path = dirname(__DIR__, 2) . "/public/assets/icons/{$name}.svg";
        $cache[$name] = file_exists($path) ? file_get_contents($path) : '';
    }

    $svg = $cache[$name];
    if ($class !== '' && $svg !== '') {
        $svg = preg_replace('/<svg /', '<svg class="' . htmlspecialchars($class, ENT_QUOTES) . '" ', $svg, 1);
    }

    return $svg;
}

function ltr_isolate(string $text): string
{
    return "\u{2066}" . $text . "\u{2069}";
}

function whatsapp_number(string $raw): string
{
    $digits = preg_replace('/\D+/', '', $raw);

    if (str_starts_with($digits, '216')) {
        return $digits;
    }
    if (strlen($digits) === 8) {
        return '216' . $digits;
    }

    return $digits;
}
