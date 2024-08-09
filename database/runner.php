<?php

use Rodovale\Database\Config\ConnectionFactory;

require_once 'vendor/autoload.php';

const MIGRATIONS_DIR = __DIR__ . '/Migrations';

function up(): void
{
    foreach (new DirectoryIterator(MIGRATIONS_DIR) as $migration) {
        if ($migration->isDot()) continue;

        (include_once $migration->getPathname())
            ->run(ConnectionFactory::getInstance());
    }

    echo 'Migrations Runned Successfully' . PHP_EOL;
}

function down(): void
{
    $migrations = [];

    foreach (new DirectoryIterator(MIGRATIONS_DIR) as $migration) {
        if ($migration->isDot()) continue;

        $migrations[] = include_once $migration->getPathname();
    }

    foreach (array_reverse($migrations) as $migration)
        $migration->rollback(ConnectionFactory::getInstance());

    echo 'Migrations Rolled Back Successfully' . PHP_EOL;
}

$action = match ($argv[1] ?? null) {
    'migrate' => up(...),
    'migrate:down' => down(...),
    default => function () {
        echo 'Nothing to do' . PHP_EOL;
    }
};

$action();
