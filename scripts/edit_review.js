document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const notaInput = document.getElementById('nota');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const selectedRating = parseInt(star.getAttribute('data-value'));
            notaInput.value = selectedRating;
            updateStars(selectedRating);
        });

        star.addEventListener('mouseover', function () {
            const currentHoverRating = parseInt(star.getAttribute('data-value'));
            updateStars(currentHoverRating);
        });

        star.addEventListener('mouseout', function () {
            const currentSelectedRating = parseInt(notaInput.value) || 0;
            updateStars(currentSelectedRating);
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-value'));
            if (starValue <= rating) {
                star.classList.add('filled');
            } else {
                star.classList.remove('filled');
            }
        });
    }
});
