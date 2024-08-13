function edit(element) {
    redirect(`/viagem/${element.querySelector(".hidden").textContent}`);
}

function destroy(element) {
    document.addEventListener("keyup", (e) => {
        if (e.key !== "Delete") return;

        redirect(
            `/viagem/deletar/${element.querySelector(".hidden").textContent}`
        );
    });
}

function redirect(route) {
    window.location.replace(
        new URL(route, `${window.location.protocol}//${window.location.host}`)
    );
}
