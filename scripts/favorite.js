function toggleFavorite(element) {
    var jogo_id = element.getAttribute('data-id-jogo');
    var isFavorited = element.getAttribute('data-favoritado') === 'true';
    var cardItem = element.closest('.card-item'); // Pega o card do jogo clicado

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
                // O card permanece na tela
            } else {
                element.style.color = 'red'; // Cor vermelha (favoritado)
                element.setAttribute('data-favoritado', 'true');
            }

            // Após 1 segundo (ou 1,5 segundo), recarrega a página
            setTimeout(() => {
                location.reload(); // Recarrega a página
            }, 1000); // 1000ms = 1 segundo

        } else if (data === 'not_logged_in') {
            alert('Você precisa estar logado para favoritar/desfavoritar jogos.');
        } else {
            alert('Erro ao favoritar/desfavoritar!');
        }
    })
    .catch(error => console.error('Erro ao favoritar:', error));
}
