let offset = 5; // Começa a partir da 6ª avaliação

// Função principal que carrega mais avaliações
async function loadMoreReviews() {
    const jogoId = document.getElementById('show-all-reviews').getAttribute('data-jogo-id');
    const showMoreButton = document.getElementById('show-all-reviews');  // Referência ao botão de ver mais avaliações

    try {
        const response = await fetch(`get_all_reviews.php?id_jogo=${jogoId}&offset=${offset}`);
        const data = await response.json();

        if (response.ok) {
            if (data.length > 0) {
                renderReviews(data);  // Renderiza as avaliações
                offset += 5;  // Incrementa o offset para a próxima requisição
                repositionShowMoreButton();  // Reposiciona o botão para o final das avaliações
                scrollToBottom();  // Rola para a parte inferior onde o botão estará
            } else {
                alert('Não há mais avaliações para carregar.');
            }
        } else {
            console.error(data.error || 'Erro desconhecido ao carregar avaliações.');
            alert(data.error || 'Erro ao carregar avaliações.');
        }
    } catch (error) {
        console.error('Erro ao carregar avaliações:', error);
        alert('Erro ao carregar avaliações. Tente novamente mais tarde.');
    }
}

// Função que renderiza as novas avaliações
function renderReviews(reviews) {
    const reviewsContainer = document.getElementById('reviews-list');  // Contêiner das avaliações

    reviews.forEach(review => {
        const reviewElement = document.createElement('div');
        reviewElement.classList.add('review-card');
        
        // Gerando as estrelas
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= review.nota) {
                stars += '<i class="fas fa-star"></i>'; // Estrela cheia
            } else {
                stars += '<i class="far fa-star"></i>'; // Estrela vazia
            }
        }

        // Adicionando as informações da avaliação ao elemento
        reviewElement.innerHTML = `
            <p><strong>Nota:</strong> <span class="star-rating">${stars}</span></p>
            <p><strong>Comentário:</strong> ${review.comentario}</p>
            <p><small>Por: ${review.id_user} em ${review.data_avaliacao}</small></p>
        `;
        reviewsContainer.appendChild(reviewElement);
    });
}


// Função que reposiciona o botão "Ver Mais Avaliações" para o final da lista
function repositionShowMoreButton() {
    const reviewsContainer = document.getElementById('reviews-list');
    const showMoreButton = document.getElementById('show-all-reviews');

    // Remove o botão da posição atual
    if (showMoreButton) {
        showMoreButton.remove();
    }

    // Cria uma nova referência do botão
    const newShowMoreButton = document.createElement('button');
    newShowMoreButton.id = 'show-all-reviews';
    newShowMoreButton.textContent = 'Ver Mais Avaliações';
    newShowMoreButton.onclick = loadMoreReviews;
    
    // Adiciona o botão no final das avaliações
    reviewsContainer.appendChild(newShowMoreButton);
}

// Função para rolar suavemente até o final das avaliações, onde o botão está
function scrollToBottom() {
    const reviewsContainer = document.getElementById('reviews-list');
    reviewsContainer.scrollIntoView({ behavior: 'smooth', block: 'end' });
}
