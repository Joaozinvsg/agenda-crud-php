document.addEventListener('DOMContentLoaded', function() {
    
    // Seleciona todos os botões/links com a classe 'btn-excluir'
    const botoesExcluir = document.querySelectorAll('.btn-excluir');

    botoesExcluir.forEach(botao => {
        botao.addEventListener('click', function(event) {
            
            // Exibe a caixa de diálogo de confirmação
            const confirmou = confirm('Tem certeza que deseja excluir este contato?');

            // Se o usuário clicar em "Cancelar", previne a ação padrão (seguir o link)
            if (!confirmou) {
                event.preventDefault();
            }
        });
    });

});