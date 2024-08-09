<?php

namespace Database\Interfaces;

use PDO;

interface Singleton
{
    public static function getInstance(): mixed;
}
