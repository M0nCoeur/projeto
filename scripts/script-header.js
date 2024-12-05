document.addEventListener('DOMContentLoaded', () => {
    // Função genérica para inicializar um carousel
    function initCarousel(imagensSelector, prevButtonSelector, nextButtonSelector, imageWidth) {
        let currentIndex = 0;

        // Seleciona o container das imagens e todas as imagens dentro do carousel
        const imagesContainer = document.querySelector(imagensSelector);
        const images = imagesContainer.querySelectorAll('img');
        const totalImages = images.length;

        if (!imagesContainer || images.length === 0) {
            console.error(`Não foi possível encontrar o container ou as imagens em ${imagensSelector}`);
            return;
        }

        // Função para mover o carousel
        function move(direction) {
            currentIndex += direction;

            if (currentIndex < 0) {
                currentIndex = totalImages - 1;
            } else if (currentIndex >= totalImages) {
                currentIndex = 0;
            }

            const offset = -currentIndex * imageWidth; // Largura de cada imagem
            imagesContainer.style.transform = `translateX(${offset}px)`;
            imagesContainer.style.transition = 'transform 0.5s ease'; // Adiciona suavidade à transição
        }

        // Associar eventos de clique aos botões
        const prevButton = document.querySelector(prevButtonSelector);
        const nextButton = document.querySelector(nextButtonSelector);

        if (prevButton) prevButton.addEventListener('click', () => move(-1));
        if (nextButton) nextButton.addEventListener('click', () => move(1));

        // Movimento automático
        setInterval(() => move(1), 3000);
    }

    // Inicializar o primeiro carousel (header)
    initCarousel(
        '.imagens-header',   // Container das imagens no header
        '.prev-header',      // Botão "anterior" do primeiro carousel
        '.next-header',      // Botão "próximo" do primeiro carousel
        1000                 // Largura de cada imagem
    );

    // Inicializar o segundo carousel (notícias)
    initCarousel(
        '.imagens',          // Container das imagens nas notícias
        '.prev',             // Botão "anterior" do segundo carousel
        '.next',             // Botão "próximo" do segundo carousel
        1000                 // Largura de cada imagem
    );
});
