// Desativa o scroll da página
function disableScroll() {
    document.body.style.overflow = "hidden";
}

// Reativa o scroll da página
function enableScroll() {
    document.body.style.overflow = "auto";
}

// Abre o modal e exibe a imagem clicada
function openModal(img) {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImage");

    if (modal && modalImg) {
        modal.style.display = "flex";
        modalImg.src = img.src;
        disableScroll(); // Desativa o scroll ao abrir o modal
    }
}

// Fecha o modal
function closeModal() {
    const modal = document.getElementById("imageModal");

    if (modal) {
        modal.style.display = "none";
        enableScroll(); // Reativa o scroll ao fechar o modal
    }
}
