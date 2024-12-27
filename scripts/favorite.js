function toggleFavorite(element, jogo_id) {
    // Obtém o estado atual (favoritado ou não)
    var isFavorited = element.getAttribute('data-favoritado') === 'true';

    // Preparando os dados para enviar via POST
    var formData = new FormData();
    formData.append('id_jogo', jogo_id);

    // Envia a requisição para o PHP
    fetch('/HTML_PROJECT/favorites.php', {
        method: 'POST',
        body: formData // Usando FormData para enviar os dados
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            // Se a operação for bem-sucedida, atualiza o ícone
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
