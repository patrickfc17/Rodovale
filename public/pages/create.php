<?php include_once __DIR__ . '/layouts/head.php'; ?>

<main class="w-screen min-h-full h-screen flex flex-col justify-center items-center py-64">
    <a class="w-40 h-8 border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:border-slate-200 hover:text-slate-200 active:brightness-90 transition-all rounded text-center mb-6" href="/">Retornar</a>
    <section class="w-1/3 p-6 border-2 border-slate-200 rounded-lg min-h-full">
        <form action="<?= isset($viagem) ? "/viagem/editar/{$viagem->id}" : '/viagem/cadastrar' ?>" method="POST" class="w-full flex flex-col items-center gap-4">
            <section class="flex flex-col w-64">
                <label for="onibus">Ônibus</label>
                <input type="text" name="onibus" id="onibus" value="<?= $viagem?->onibus ?? '' ?>" required />
            </section>
            <section class="flex flex-col w-64">
                <label for="partida">Data de Partida</label>
                <input
                    type="date"
                    name="partida"
                    id="partida"
                    value="<?= $viagem?->partida
                                ? explode(' ', $viagem->partida)[0]
                                : (new \DateTime(timezone: new \DateTimeZone('America/Sao_Paulo')))->format('Y-m-d') ?>"
                    required />
            </section>
            <section class="flex flex-col w-64">
                <label for="horario">Horário de Partida</label>
                <input
                    type="time"
                    name="horario"
                    id="horario"
                    value="<?= $viagem?->partida
                                ? explode(' ', $viagem->partida)[1]
                                : (new \DateTime(timezone: new \DateTimeZone('America/Sao_Paulo')))->format('H:i') ?>"
                    required />
            </section>
            <section class="flex flex-col w-64">
                <label for="origem">Origem</label>
                <input type="text" name="origem" id="origem" value="<?= $viagem?->origem ?? '' ?>" required />
            </section>
            <section class="flex flex-col w-64">
                <label for="destino">Destino</label>
                <input type="text" name="destino" id="destino" value="<?= $viagem?->destino ?? '' ?>" required />
            </section>
            <section class="flex flex-col w-64">
                <label for="numero_passageiros">Número de Passageiros</label>
                <input type="number" name="numero_passageiros" id="numero_passageiros" value="<?= $viagem?->numero_passageiros ?? '' ?>" required />
            </section>
            <section>
                <button class="w-40 h-8 border-2 border-green-500 text-green-500 hover:bg-green-500 hover:border-slate-200 hover:text-slate-200 active:brightness-90 transition-all rounded text-center mb-6" type="submit">Enviar</button>
            </section>
        </form>
    </section>
</main>

<?php include_once __DIR__ . '/layouts/footer.php'; ?>