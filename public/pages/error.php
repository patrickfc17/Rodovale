<?php

$_SESSION['page_name'] = '500';

include_once __DIR__ . '/layouts/head.php';

?>

<main class="w-screen h-screen flex flex-col justify-center items-center">
    <p class="text-9xl text-red-500 font-bold text-center">500</p>
    <p class="text-2xl text-red-500 font-bold text-center">Ocorreu um erro inesperado no sistema.<br>Por favor, volte novamente mais tarde</p>
</main>

<?php include_once __DIR__ . '/layouts/footer.php'; ?>