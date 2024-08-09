<?php

namespace Rodovale\Interfaces;

use Database\Interfaces\BaseDAO;

abstract class BaseController
{
    public abstract function __construct(BaseDAO $dao);

    public abstract function index(): void;

    protected abstract function render(array $values): void;
}
