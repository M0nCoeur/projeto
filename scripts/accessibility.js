// Salvar o tamanho original da fonte
let originalFontSize = '16px'; // Tamanho de fonte padrão (ajuste conforme necessário)

function increaseFontSize() {
    let body = document.body;
    let currentSize = window.getComputedStyle(body).fontSize;
    let newSize = (parseFloat(currentSize) * 1.1) + 'px'; // Aumenta a fonte em 10%
    body.style.fontSize = newSize;
}

function decreaseFontSize() {
    let body = document.body;
    let currentSize = window.getComputedStyle(body).fontSize;
    let newSize = (parseFloat(currentSize) * 0.9) + 'px'; // Diminui a fonte em 10%
    body.style.fontSize = newSize;
}

// Função para alternar o modo de contraste
function toggleContrast() {
  document.body.classList.toggle('high-contrast');
}

// Função para resetar o tamanho da fonte ao valor original
function resetFontSize() {
    document.body.style.fontSize = originalFontSize;
}

// Alternar entre o modo normal e o modo de alto contraste
function toggleContrast() {
    document.body.classList.toggle('high-contrast');
}

// Função para alternar entre o modo com espaçamento de texto aumentado
function toggleTextSpacing() {
    document.body.classList.toggle('spaced-text');
}

// Mostrar o painel de acessibilidade
function showAccessibilityPanel() {
    const panel = document.getElementById('accessibility-controls');
    const button = document.getElementById('open-accessibility');

    // Calcula a posição do botão
    const buttonPosition = button.getBoundingClientRect();
    panel.style.bottom = (buttonPosition.height + 10) + 'px'; // Coloca o painel logo acima do botão

    // Adiciona a classe que mostra o painel com animação
    panel.classList.add('show');
    button.style.display = 'none'; // Esconde o botão de abrir
}

// Fechar o painel de acessibilidade
function hideAccessibilityPanel() {
    const panel = document.getElementById('accessibility-controls');
    const button = document.getElementById('open-accessibility');

    // Remove a classe para esconder o painel com animação
    panel.classList.remove('show');
    button.style.display = 'block'; // Mostra o botão de abrir novamente
}

// Evento de clique no botão de contraste
document.getElementById('toggle-contrast').addEventListener('click', toggleContrast);

// Eventos de clique nos botões
document.getElementById('reset-font-size').addEventListener('click', resetFontSize);
document.getElementById('increase-font').addEventListener('click', increaseFontSize);
document.getElementById('decrease-font').addEventListener('click', decreaseFontSize);
document.getElementById('toggle-contrast').addEventListener('click', toggleContrast);

// Mostrar ou esconder o painel de acessibilidade
document.getElementById('open-accessibility').addEventListener('click', showAccessibilityPanel);
document.getElementById('close-accessibility').addEventListener('click', hideAccessibilityPanel);
