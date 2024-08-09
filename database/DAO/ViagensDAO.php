<?php

namespace Database\DAO;

use PDO;
use Database\Interfaces\Singleton;
use Override;
use Rodovale\Database\Config\ConnectionFactory;

class ViagensDAO implements Singleton
{
    private static ?ViagensDAO $instance = null;

    private function __construct(
        private PDO $pdo
    ) {}

    #[Override]
    public static function getInstance(): static
    {
        if (!self::$instance)
            self::$instance = new ViagensDAO(ConnectionFactory::getInstance());

        return self::$instance;
    }
}
