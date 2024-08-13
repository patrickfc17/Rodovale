<?php

namespace Rodovale\Database\DTO;

use DateTime;
use InvalidArgumentException;

final class ViagemDTO
{
    public int $id;

    public int $codigo;

    public string|DateTime $partida;

    public int $numero_passageiros;

    public string $onibus;

    public string $origem;

    public string $destino;

    public function __construct(?object $data = null)
    {
        if (!$data) return;

        $this->id = 0;

        foreach ($this->getAttributes() as $attribute) {
            if ($attribute === 'id') continue;

            if (!in_array($attribute, array_keys((array) $data)))
                throw new InvalidArgumentException('Os dados enviado ao DTO para serialização são inválidos');
        }

        foreach ((array) $data as $attribute => $value) {
            if ($attribute === 'partida' and gettype($attribute) === 'string')
                $value = new DateTime($value);

            if (!in_array($attribute, $this->getAttributes()))
                continue;

            $this->{$attribute} = $value;
        }
    }

    private function getAttributes(): array
    {
        return array_map(
            fn(object $attribute) => $attribute->name,
            (new \ReflectionClass($this))->getProperties()
        );
    }

    public function toArray(string|array $without = []): array
    {
        $without = gettype($without) === 'string' ? [$without] : $without;

        $attributes = [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'partida' => $this->partida->format('Y-m-d H:i:s'),
            'numero_passageiros' => $this->numero_passageiros,
            'onibus' => $this->onibus,
            'origem' => $this->origem,
            'destino' => $this->destino,
        ];

        foreach ($without as $item) {
            if (!in_array($item, array_keys($attributes))) continue;

            unset($attributes[$item]);
        }

        return $attributes;
    }
}
