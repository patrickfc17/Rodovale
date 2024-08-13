<?php

namespace Rodovale\Controllers;

use Rodovale\Abstract\IBaseController;
use Rodovale\Abstract\ViewRenderer;
use Rodovale\Database\DTO\ViagemDTO;
use Rodovale\Database\Interfaces\BaseDAO;

final class ViagensController extends ViewRenderer implements IBaseController
{
    private const COGIDO_INICIAL = 10000;

    public function __construct(
        private readonly BaseDAO $dao
    ) {}

    public function index(): void
    {
        $_SESSION['page_name'] = 'Home';

        $this->render('show', [
            'viagens' => $this->dao->fetchAll()
        ]);
    }

    public function create(): void
    {
        $_SESSION['page_name'] = 'Cadastrar Viagem';

        $this->render('create');
    }

    public function store(object $data): void
    {
        $data->partida = "{$data->partida} {$data->horario}:00";

        $data->codigo = self::COGIDO_INICIAL;

        $ultimaViagem = $this->dao->fetchLast();
        if ($ultimaViagem) {
            $data->codigo = $ultimaViagem->codigo;
            $data->codigo++;
        }

        $this->dao->create(new ViagemDTO($data));

        header('Location: /', 301);
    }

    public function edit(int $id): void
    {
        $this->render('create', [
            'viagem' => $this->dao->fetchOne($id)
        ]);
    }

    public function update(int $id, object $data): void
    {
        $data->codigo = $this->dao
            ->fetchOne($id)
            ->codigo;
            
        $dto = new ViagemDTO($data);
        $dto->id = $id;

        $this->dao->update($dto);

        header('Location: /', 301);
    }

    public function destroy(int $id): void
    {
        $this->dao->delete($id);

        header('Location: /', 301);
    }
}
