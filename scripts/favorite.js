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
            } else {
                element.style.color = 'red'; // Cor vermelha (favoritado)
                element.setAttribute('data-favoritado', 'true');
            }
        } else if (data === 'not_logged_in') {
            alert('Você precisa estar logado para favoritar jogos.');
        } else {
            alert('Erro ao favoritar/desfavoritar!');
        }
    })
    .catch(error => console.error('Erro ao favoritar:', error));
}
