<?php

namespace Rodovale\Database\Config;

use Database\Interfaces\Singleton;
use Override;
use PDO;
use PDOException;
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
                self::$instance = new PDO('sqlite:database.sqlite');

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException) {
                throw new UnstableServerException('O servidor encontrou um erro ao tentar estabelecer uma conexão. Por favor tente novamente mais tarde', 500);
            }
        }

        return self::$instance;
    }
}
