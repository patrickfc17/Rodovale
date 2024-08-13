<?php include_once __DIR__ . '/layouts/head.php'; ?>

<main class="w-screen min-h-full h-screen flex flex-col justify-center items-center py-64">
    <a class="w-40 h-8 border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:border-slate-200 hover:text-slate-200 active:brightness-90 transition-all rounded text-center mb-6" href="/viagem">Adicionar</a>
    <section class="w-5/6 p-6 border-2 border-slate-200 rounded-lg min-h-full">
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-slate-500">
                    <th class="text-left w-1/12">Código</th>
                    <th class="text-left w-3/12">Ônibus</th>
                    <th class="text-left w-2/12">Origem</th>
                    <th class="text-left w-2/12">Destino</th>
                    <th class="text-left w-2/12">Partida</th>
                    <th class="text-left w-1/12">Passageiros</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viagens as $viagem) : ?>
                    <tr class="hover:bg-slate-200 cursor-pointer" ondblclick="edit(this)" onclick="destroy(this)">
                        <td class="hidden"><?= $viagem->id ?></td>
                        <td><?= $viagem->codigo ?></td>
                        <td><?= $viagem->onibus ?></td>
                        <td><?= $viagem->origem ?></td>
                        <td><?= $viagem->destino ?></td>
                        <td><?= (new \DateTime($viagem->partida))->format('d/m/Y H:i') ?>h</td>
                        <td><?= $viagem->numero_passageiros ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<script src="../js/show.js" defer></script>

<?php include_once __DIR__ . '/layouts/footer.php'; ?>