<?php

namespace Rodovale\Abstract;

interface IBaseController
{
    public function index(): void;

    public function create(): void;

    public function store(object $data): void;

    public function edit(int $id): void;

    public function update(int $id, object $data): void;

    public function destroy(int $id): void;
}
