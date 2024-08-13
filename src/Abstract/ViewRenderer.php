<?php

namespace Rodovale\Abstract;

class ViewRenderer
{
    protected function render(string $view, array $values = []): void
    {
        extract($values);

        require_once __DIR__ . "/../../public/pages/$view.php";
    }
}
