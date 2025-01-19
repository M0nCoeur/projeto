document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll("#game-rating i"); // Alterado para o novo ID
    const notaInput = document.getElementById("nota");
  
    stars.forEach(star => {
      // Lógica de clique para selecionar a nota
      star.addEventListener("click", function () {
        // Limpar todas as seleções anteriores
        stars.forEach(s => s.classList.remove("selected"));
  
        // Marcar a estrela clicada e todas as anteriores
        let selectedValue = parseInt(star.getAttribute("data-value"));
        notaInput.value = selectedValue; // Atualizar o valor do input hidden
        for (let i = 0; i < selectedValue; i++) {
          stars[i].classList.add("selected");
        }
      });
  
      // Lógica de hover para destacar as estrelas
      star.addEventListener("mouseover", function () {
        // Adicionar a classe 'hovered' para as estrelas até a que está sendo passada o mouse
        stars.forEach((s, index) => {
          if (index < parseInt(star.getAttribute("data-value"))) {
            s.classList.add("hovered");
          } else {
            s.classList.remove("hovered");
          }
        });
      });
  
      // Remover a classe 'hovered' ao sair do hover
      star.addEventListener("mouseout", function () {
        stars.forEach(s => s.classList.remove("hovered"));
        // Manter as estrelas que foram realmente selecionadas
        let selectedValue = parseInt(notaInput.value);
        for (let i = 0; i < selectedValue; i++) {
          stars[i].classList.add("selected");
        }
      });
    });
  });
  