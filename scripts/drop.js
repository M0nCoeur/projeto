function toggleDropdown() {
    const dropdown = document.querySelector('.dropdown');
    dropdown.classList.toggle('active');
}

// Fechar o menu dropdown ao clicar fora
document.addEventListener('click', function (event) {
    const dropdown = document.querySelector('.dropdown');
    const userMenu = document.querySelector('.user-menu');

    // Verifica se o clique foi fora do dropdown e do botão "Olá, usuário"
    const isClickInside = dropdown.contains(event.target) || userMenu.contains(event.target);

    if (!isClickInside) {
        dropdown.classList.remove('active');
    }
});
