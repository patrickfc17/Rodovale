<?php

namespace Rodovale\Database\Migrations;

use PDO;
use Rodovale\Database\Interfaces\Migration;

return new class implements Migration
{
    public function run(PDO $connection): void
    {
        $connection->prepare("
            CREATE TABLE viagens (
                id INT PRIMARY KEY,
                codigo BIGINT UNIQUE,
                horario_partida DATETIME,
                numero_passageiros INT,
                onibus VARCHAR,
                origem VARCHAR,
                destino VARCHAR
            )
        ")->execute();
    }

    public function rollback(PDO $connection): void
    {
        $connection->prepare("
            DROP TABLE viagens
        ")->execute();
    }
};
