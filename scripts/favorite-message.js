function showFavoriteMessage() {
    
    // Cria a div da mensagem
    const message = document.createElement('div');
    message.classList.add('favorite-message');
    message.innerText = 'Jogo favoritado com sucesso!';
    
    // Adiciona a mensagem ao body
    document.body.appendChild(message);
    
    // Remove a mensagem após 3 segundos
    setTimeout(() => {
        message.remove();
    }, 3000);
}