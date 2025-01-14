function toggleFavorite() {
    var favoriteIcon = document.querySelector('.favorite-icon');
    var favoriteText = document.getElementById('favorite-text');
    var gameId = 1; // ID do jogo (substitua conforme necessário)
    
    var action = favoriteIcon.style.color === 'red' ? 'remove' : 'add';

    // Enviar requisição AJAX para favoritar/desfavoritar
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'favorites.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText === 'success') {
                if (action === 'add') {
                    favoriteIcon.style.color = 'red';  // Coração vermelho
                    favoriteText.textContent = 'Favoritado';
                } else {
                    favoriteIcon.style.color = '';  // Coração normal
                    favoriteText.textContent = 'Favoritar';
                }
            }
        }
    };
    xhr.send('id_jogo=' + gameId);
}

