function toggleFavorite(icon, gameId) {
    // Verifica se o coração já está ativo (favoritado)
    const isFavorited = icon.classList.contains('favorited');
  
    // Alterna a classe para mudar a aparência do coração
    if (isFavorited) {
      icon.classList.remove('favorited');
    } else {
      icon.classList.add('favorited');
    }
  
    // Envia a atualização para o servidor via Fetch API
    fetch('/favoritar.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        gameId: gameId, // ID do jogo que foi clicado
        action: isFavorited ? 'remove' : 'add', // Define a ação: adicionar ou remover
      }),
    })
      .then((response) => response.json()) // Converte a resposta em JSON
      .then((data) => {
        if (!data.success) {
          alert('Ocorreu um erro ao atualizar o favorito.');
        }
      })
      .catch((error) => {
        console.error('Erro:', error);
        alert('Não foi possível conectar ao servidor.');
      });
  }
  