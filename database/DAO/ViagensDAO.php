<?php

namespace Rodovale\Database\DAO;

use PDO;
use Exception;
use Override;
use Rodovale\Database\Interfaces\BaseDAO;
use Rodovale\Database\Interfaces\Singleton;
use Rodovale\Database\Config\ConnectionFactory;
use Rodovale\Database\DTO\ViagemDTO;
use PDOException;
use Rodovale\Exceptions\PersistenceException;

class ViagensDAO implements Singleton, BaseDAO
{
    private static ?ViagensDAO $instance = null;

    private function __construct(
        private PDO $pdo
    ) {}

    #[Override]
    public static function getInstance(): static
    {
        if (!self::$instance)
            self::$instance = new ViagensDAO(ConnectionFactory::getInstance());

        return self::$instance;
    }

    #[Override]
    public function create(ViagemDTO $viagem): void
    {
        try {
            $this->pdo
                ->prepare("
                    INSERT INTO viagens (codigo, partida, numero_passageiros, onibus, origem, destino)
                    VALUES (:codigo, :partida, :numero_passageiros, :onibus, :origem, :destino)
                ")->execute($viagem->toArray(without: 'id'));
        } catch (PDOException) {
            throw new PersistenceException('Ocorreu um erro ao salvar os dados da viagem. Aguarde alguns instantes que estaremos resolvendo');
        }
    }

    #[Override]
    public function fetchAll(): array | PersistenceException
    {
        try {
            $statement = $this->pdo
                ->prepare(
                    "SELECT * FROM viagens"
                );

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS, ViagemDTO::class);
        } catch (PDOException) {
            throw new PersistenceException('Ocorreu um erro ao recuperar os dados das viagens. Aguarde alguns instantes que estaremos resolvendo');
        }
    }

    #[Override]
    public function fetchOne(int $id): ViagemDTO | PersistenceException | null
    {
        try {
            $statement = $this->pdo
                ->prepare("
                    SELECT * FROM viagens
                    WHERE id = :id
                ");

            $statement->execute([
                'id' => $id
            ]);

            return $statement->fetchObject(ViagemDTO::class, [null]) ?: null;
        } catch (PDOException) {
            throw new PersistenceException('Ocorreu um erro ao recuperar os dados dessa viagem. Aguarde alguns instantes que estaremos resolvendo');
        }
    }

    #[Override]
    public function fetchLast(): ?ViagemDTO
    {
        try {
            $statement = $this->pdo
                ->prepare("
                    SELECT * FROM viagens
                    ORDER BY id DESC
                    LIMIT 1
                ");

            $statement->execute();

            return $statement->fetchObject(ViagemDTO::class, [null]) ?: null;
        } catch (PDOException) {
            throw new PersistenceException('Ocorreu um erro ao recuperar os dados dessa viagem. Aguarde alguns instantes que estaremos resolvendo');
        }
    }

    #[Override]
    public function update(ViagemDTO $viagem): void
    {
        try {
            $this->pdo
                ->prepare("
                    UPDATE viagens
                    SET 
                        codigo = :codigo,
                        partida = :partida,
                        numero_passageiros = :numero_passageiros,
                        onibus = :onibus,
                        origem = :origem,
                        destino = :destino
                    WHERE id = :id 
                ")->execute($viagem->toArray());
        } catch (PDOException) {
            throw new PersistenceException('Ocorreu um erro ao atualizar os dados dessa viagem. Aguarde alguns instantes que estaremos resolvendo');
        }
    }

    #[Override]
    public function delete(int $id): void
    {
        try {
            $this->pdo
                ->prepare("
                    DELETE FROM viagens
                    WHERE id = :id
                ")->execute(['id' => $id]);
        } catch (PDOException) {
            throw new PersistenceException('Ocorreu um erro ao excluir os dados dessa viagem. Aguarde alguns instantes que estaremos resolvendo');
        }
    }
}
