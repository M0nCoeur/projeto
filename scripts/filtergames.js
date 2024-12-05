// Função para filtrar os jogos com base no texto digitado no campo de busca
function filtergames() {
    // Obtém o valor digitado no campo de busca
    const searchValue = document.querySelector('.search-input').value.toLowerCase();
  
    // Seleciona todos os cards dos jogos
    const gameCards = document.querySelectorAll('.card-wrapper .card-item, .card-wrapper .card-adm, .card-wrapper .card-sec');
  
    // Itera sobre os cards e aplica o filtro
    gameCards.forEach(card => {
      // Busca o nome do jogo no título do card
      const gameName = card.querySelector('h3') ? card.querySelector('h3').innerText.toLowerCase() : '';
  
      // Exibe ou oculta o card com base no filtro
      if (gameName.includes(searchValue)) {
        card.style.opacity = '1'; // Deixa o card visível
        card.style.visibility = 'visible'; // Torna o card visível
      } else {
        card.style.opacity = '0'; // Torna o card invisível
        card.style.visibility = 'hidden'; // Torna o card invisível
      }
    });
  }
  
