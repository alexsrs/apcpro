$(function() {
    var open = true;
    var windowSize = $(window)[0].innerWidth;

    var targetSizeMenu = (windowSize <= 400) ? 200 : 250;



    if (windowSize <= 768) {
        $('.menu').css('width', '0').css('padding', '0');
        open = false;
    }

    $('.menu-btn').click(function() {
        if (open) {
            // O menu está aberto, precisamos fechar
            $('.menu').animate({ 'width': 0, 'padding': 0 }, function() {
                open = false;
            });
            $('.content,header').css('width', '100%');
            $('.content,header').animate({ 'left': 0 }, function() {
                open = false;
            });
        } else {
            // O menu está fechado, precisamos abrir
            $('.menu').css('display', 'block');
            $('.menu').animate({ 'width': targetSizeMenu + 'px', 'padding': '10px 0' }, function() {
                open = true;
            });
            if (windowSize > 768)
                $('.content,header').css('width', 'calc(100% - 250px)');
            $('.content,header').animate({ 'left': targetSizeMenu + 'px' }, function() {
                open = true;
            });
        }
    });

    $(window).resize(function() {
        windowSize = $(window)[0].innerWidth;
        if (windowSize <= 768) {
            $('.menu').css('width', '0').css('padding', '0');
            $('.content,header').css('width', '100%').css('left', '0');
            open = false;
        } else {
            if (open) {
                $('.menu').css('width', targetSizeMenu + 'px').css('padding', '10px 0');
                $('.content,header').css('width', 'calc(100% - ' + targetSizeMenu + 'px)').css('left', targetSizeMenu + 'px');
            }
        }
        targetSizeMenu = (windowSize <= 400) ? 200 : 250;
    });

    // Lógica para o datatables.js
    $(document).ready(function() {
        $('#lista-usuarios').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
            },
            pageLength: 10,   // Define o número de registros por página
            select: true,
            searching: false, // Remove a caixa de pesquisa
            
            columnDefs: [
                { orderable: false, targets: 5 } // Altera o índice da coluna "Ações" (0-indexed)
            ]
        });

        $('#anamnesesTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
            },
            pageLength: 10,   // Define o número de registros por página
            select: true,
            searching: false,
            ordering: false // Remove a caixa de pesquisa
        });
        
        // Restaurar o estado do menu salvo no Local Storage
        var activeMenu = localStorage.getItem('activeMenu');
        if (activeMenu) {
            $('.items-menu h2').not('#' + activeMenu).nextUntil('h2').hide();
            $('#' + activeMenu).addClass('ativo').nextUntil('h2').show();
        } else {
            $('.items-menu h2').not('.ativo').nextUntil('h2').hide();
        }

        // Adicionar evento de clique no h2
        $(".items-menu h2").click(function() {
            // Fechar todos os menus abertos, exceto o clicado
            $(".items-menu h2").not(this).removeClass('ativo').nextUntil("h2").slideUp();
            
            // Alternar o menu clicado e manter aberto adicionando a classe 'ativo'
            $(this).toggleClass('ativo').nextUntil("h2").slideToggle();
            
            // Salvar o estado do menu no Local Storage
            if ($(this).hasClass('ativo')) {
                localStorage.setItem('activeMenu', $(this).attr('id'));
            } else {
                localStorage.removeItem('activeMenu');
            }
        });

        // Prevenir que o menu feche ao clicar nos links <a>
        $(".items-menu a").click(function(event) {
            event.stopPropagation();
        });
    });

    $('[formato=data]').mask('99/99/9999');

});


// Abrir o modal ao clicar no botão de excluir
const excluirBtns = document.querySelectorAll('.open-modal');
const modal = document.getElementById('excluirModal');
const idInput = document.getElementById('id_usuario_excluir');

excluirBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        const excluirId = btn.getAttribute('data-id'); // Captura o ID do usuário
        idInput.value = excluirId; // Define o valor do input hidden no modal
        modal.style.display = 'flex'; // Exibe o modal
    });
});

// Fechar o modal ao clicar em "Cancelar"
document.getElementById('cancelarExcluir').addEventListener('click', () => {
    modal.style.display = 'none';
});



let contadorRegiao = 1;

        // Função para adicionar uma nova região
        function adicionarRegiao() {
            contadorRegiao++;
            const container = document.getElementById('regioes-container');

            const div = document.createElement('div');
            div.className = 'regiao-container';

            div.innerHTML = `
                <label for="regiao${contadorRegiao}">Região:</label>
                <input type="text" id="regiao${contadorRegiao}" name="regiao[]" required><br>
                <label for="nota${contadorRegiao}">Nota:</label>
                <input type="number" id="nota${contadorRegiao}" name="nota[]" min="0" max="10" placeholder="0-10" required><br>
                <label for="dificuldade${contadorRegiao}">Dificuldade:</label>
                <input type="text" id="dificuldade${contadorRegiao}" name="dificuldade[]">
                <button type="button" class="remove-regiao">Remover</button><br>
            `;

            container.appendChild(div);

            // Adicionar event listener ao botão "Remover" recém-criado
            const btnRemover = div.querySelector('.remove-regiao');
            btnRemover.addEventListener('click', function() {
                removerRegiao(this);
            });
        }

        // Função para remover uma região
        function removerRegiao(botao) {
            const div = botao.parentElement;
            div.remove();
        }

        // Adicionar event listener ao botão "Adicionar Região" após o carregamento do DOM
        document.addEventListener('DOMContentLoaded', function() {
            const btnAdicionar = document.getElementById('adicionar-regiao');
            btnAdicionar.addEventListener('click', adicionarRegiao);

            // Adicionar event listener ao botão "Remover" da primeira região
            const btnRemoverInicial = document.querySelector('.regiao-container .remove-regiao');
            btnRemoverInicial.addEventListener('click', function() {
                removerRegiao(this);
            });
        });