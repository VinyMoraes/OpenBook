// Evento para o botão de pesquisa
document.getElementById('searchBtn').addEventListener('click', function() {
    var input = document.getElementById('searchInput');
    if (input.style.display === "none") {
        input.style.display = "block"; // Mostra o campo de entrada
        input.focus(); // Foca no campo de entrada
    } else {
        input.style.display = "none"; // Oculta o campo de entrada
    }
});

// Adiciona um evento keypress para o campo de entrada
document.getElementById('searchInput').addEventListener('input', function() {
    var searchValue = this.value.toLowerCase(); // Captura o valor da pesquisa em letras minúsculas
    var tableRows = document.querySelectorAll('table tbody tr'); // Seleciona todas as linhas da tabela

    tableRows.forEach(function(row) {
        // Obtém o texto de todas as células da linha
        var rowText = row.innerText.toLowerCase(); 
        // Verifica se a linha deve ser exibida com base no valor de pesquisa
        if (rowText.includes(searchValue)) {
            row.style.display = ''; // Exibe a linha se o texto incluir o valor de pesquisa
        } else {
            row.style.display = 'none'; // Oculta a linha se não incluir o valor de pesquisa
        }
    });
});

// Adiciona evento keypress para o campo de entrada de busca
document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Previne o comportamento padrão do Enter
        // Aqui você pode executar a lógica de pesquisa, como enviar o formulário ou chamar uma função
        var searchValue = this.value.toLowerCase(); // Captura o valor da pesquisa em letras minúsculas
        var tableRows = document.querySelectorAll('table tbody tr'); // Seleciona todas as linhas da tabela

        tableRows.forEach(function(row) {
            // Obtém o texto de todas as células da linha
            var rowText = row.innerText.toLowerCase(); 
            // Verifica se a linha deve ser exibida com base no valor de pesquisa
            if (rowText.includes(searchValue)) {
                row.style.display = ''; // Exibe a linha se o texto incluir o valor de pesquisa
            } else {
                row.style.display = 'none'; // Oculta a linha se não incluir o valor de pesquisa
            }
        });
    }
});
