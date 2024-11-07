// Evento para o botão "Mostrar Todos"
document.getElementById('showAllBtn').addEventListener('click', function() {
    // Redireciona para a mesma página, removendo o parâmetro de busca
    window.location.href = window.location.pathname; // Apenas recarrega a página atual
});