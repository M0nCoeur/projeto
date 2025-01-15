function openModal() {
    // Exibe o modal
    document.getElementById("reviewsModal").style.display = "block";
  
    // Carregar avaliações completas (por exemplo, usando AJAX)
    const modalReviewsContainer = document.getElementById("modal-reviews-container");
    
    // Fazendo uma requisição AJAX para carregar todas as avaliações
    fetch('get_all_reviews.php?id_jogo=<?php echo $jogo_id; ?>') // Arquivo PHP que irá buscar todas as avaliações
      .then(response => response.json())
      .then(data => {
        if (data && data.length > 0) {
          let reviewsHtml = '';
          data.forEach(review => {
            reviewsHtml += `
              <div class="review-card">
                <p><strong>Nota:</strong> ${'&#9733;'.repeat(review.nota)}</p>
                <p><strong>Comentário:</strong> ${review.comentario}</p>
                <p><small>Por: ${review.id_user} em ${review.data_avaliacao}</small></p>
              </div>
            `;
          });
          modalReviewsContainer.innerHTML = reviewsHtml;
        } else {
          modalReviewsContainer.innerHTML = "<p>Não há avaliações para este jogo.</p>";
        }
      })
      .catch(error => {
        console.error('Erro ao carregar avaliações:', error);
      });
  }
  
  function closeModal() {
    // Fecha o modal
    document.getElementById("reviewsModal").style.display = "none";
  }
  