<?php

namespace Rodovale\Database\Interfaces;

use PDO;

interface Migration
{
    public function run(PDO $connection): void;
    public function rollback(PDO $connection): void;
}
