<?php

namespace Rodovale\Controllers;

use Override;
use Database\Interfaces\BaseDAO;
use Rodovale\Interfaces\BaseController;

final class HomeController extends BaseController
{
    private readonly BaseDAO $dao;

    public function __construct(BaseDAO $dao)
    {
        $this->dao = $dao;
    }

    #[Override]
    public function index(): void {}

    #[Override]
    protected function render(array $values): void {}
}
