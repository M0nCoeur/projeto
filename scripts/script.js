let currentIndex = 0;
 
function move(direction) {
    const images = document.querySelector('.imagens');
    const totalImages = document.querySelectorAll('.carousel img').length;

    currentIndex += direction;

    if (currentIndex < 0) {
        currentIndex = totalImages - 1;
    } else if (currentIndex >= totalImages) {
        currentIndex = 0;
    }

    const offset = -currentIndex * 1000; // 1000 é a largura das imagens
    images.style.transform = `translateX(${offset}px)`;
}

// Função para avançar automaticamente
function autoMove() {
    move(1);
}

// Chama a função autoMove a cada 3 segundos (3000ms)
setInterval(autoMove, 3000);

