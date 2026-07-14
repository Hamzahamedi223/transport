<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once dirname(__DIR__) . '/app/Core/Database.php';

use App\Core\Database;

$sqlPath = dirname(__DIR__) . '/database/supabase.sql';
$sql = file_get_contents($sqlPath);

if ($sql === false) {
    fwrite(STDERR, "Could not read database/supabase.sql\n");
    exit(1);
}

try {
    Database::getConnection()->exec($sql);
    echo "Supabase schema applied.\n";
} catch (Throwable $e) {
    fwrite(STDERR, "Could not apply Supabase schema: {$e->getMessage()}\n");
    exit(1);
}
