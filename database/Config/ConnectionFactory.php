<?php

namespace Rodovale\Database\Config;

use PDO;
use Override;
use PDOException;
use Rodovale\Database\Interfaces\Singleton;
use Rodovale\Exceptions\UnstableServerException;

final class ConnectionFactory implements Singleton
{
    private static ?PDO $instance = null;

    private function __construct() {}

    #[Override]
    public static function getInstance(): PDO
    {
        if (!self::$instance) {
            try {
                self::$instance = new PDO('sqlite:' . __DIR__ . '/../../database.sqlite');

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException) {
                throw new UnstableServerException('O servidor encontrou um erro ao tentar estabelecer uma conexão. Por favor tente novamente mais tarde', 500);
            }
        }

        return self::$instance;
    }
}
