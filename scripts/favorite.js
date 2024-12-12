function toggleFavorite(id_jogo, element) {
    // Verifica se o usuário está logado
    var isLoggedIn = false;

    // Verifica se o cookie de sessão de usuário está presente
    if (document.cookie.indexOf('id_user') !== -1) {
        isLoggedIn = true;
    }

    if (isLoggedIn) {
        var action = element.classList.contains('favoritado') ? 'remove' : 'add';
        
        // Faz a requisição para o PHP para adicionar ou remover o favorito
        var request = new XMLHttpRequest();
        request.open('POST', 'favorites.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        request.onload = function() {
            if (request.status == 200) {
                var response = JSON.parse(request.responseText);
                if (response.status == 'success') {
                    if (action === 'add') {
                        element.classList.add('favoritado');
                    } else {
                        element.classList.remove('favoritado');
                    }
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            } else {
                alert('Erro ao processar a ação');
            }
        };
        
        request.send('id_jogo=' + id_jogo + '&action=' + action);
    } else {
        alert('Você precisa estar logado para favoritar jogos!');
    }
}
