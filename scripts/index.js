function toggleFavorite(element) {
    var jogo_id = element.getAttribute('data-id-jogo');
    var isFavorited = element.getAttribute('data-favoritado') === 'true';

    var formData = new FormData();
    formData.append('id_jogo', jogo_id);

    fetch('/HTML_PROJECT/favorites.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            // Atualiza o estado do ícone com base no estado atual
            if (isFavorited) {
                element.style.color = ''; // Cor padrão (desfavoritado)
                element.setAttribute('data-favoritado', 'false');
                // Exibe a mensagem de desfavoritar com fundo vermelho
                showSuccessMessage('Jogo desfavoritado com sucesso!', 'red');
            } else {
                element.style.color = 'red'; // Cor vermelha (favoritado)
                element.setAttribute('data-favoritado', 'true');
                // Exibe a mensagem de favoritar com fundo verde
                showSuccessMessage('Jogo favoritado com sucesso!', 'green');
            }
        } else if (data === 'not_logged_in') {
            alert('Você precisa estar logado para favoritar jogos.');
        } else {
            alert('Erro ao favoritar/desfavoritar!');
        }
    })
    .catch(error => console.error('Erro ao favoritar:', error));
}

// Função para exibir a mensagem de sucesso
function showSuccessMessage(message, color) {
    const messageContainer = document.createElement('div');
    messageContainer.classList.add('success-message');
    messageContainer.textContent = message;
    messageContainer.style.backgroundColor = color; // Define o fundo da mensagem (verde ou vermelha)
    messageContainer.style.color = 'white'; // Cor do texto (branca) para contraste
    document.body.appendChild(messageContainer);

    // Adiciona um efeito de fade-out para desaparecer após 3 segundos
    setTimeout(() => {
        messageContainer.style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(messageContainer);
        }, 500); // 500ms para completar o fade-out
    }, 3000); // Exibe a mensagem por 3 segundos
}
