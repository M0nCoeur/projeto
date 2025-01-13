document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('account-form');
    const inputs = form.querySelectorAll('input');
    const updateButton = document.getElementById('update-button');
    const toggle = document.getElementById('edit-toggle');
    const editLabel = document.getElementById('edit-label');

    // Alterna o estado de edição
    window.toggleEditMode = () => {
        const isEditing = toggle.checked;
        
        inputs.forEach(input => {
            input.disabled = !isEditing;
            input.style.cursor = isEditing ? "text" : "not-allowed";
        });
        updateButton.disabled = !isEditing;
        editLabel.textContent = isEditing ? "Modo Edição" : "Modo Visualização";
    };
});
