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
                { orderable: false, targets: 5 },
                { width: "30%", targets: 0 }, // Primeira coluna
                { className: "text-center", width: "3%", targets: 1 }, // Segunda coluna
                { className: "text-center", width: "3%", targets: 2 }, // Terceira coluna
                { className: "text-center", width: "3%", targets: 3 }, // Quarta coluna
                { className: "text-center", width: "26%", targets: 4 }, // E assim por diante
                { className: "text-center", width: "35%", targets: 5 } // Altera o índice da coluna "Ações" (0-indexed)
            ]
        });

        $('#lista-exercicios').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
            },
            pageLength: 25,   // Define o número de registros por página
            select: true,
            searching: true, // Remove a caixa de pesquisa
            });

        $('#anamnesesTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
            },
            pageLength: 10,   // Define o número de registros por página
            select: true,
            searching: false,
            ordering: false, // Remove a caixa de pesquisa
            responsive: true,
            autoWidth: false,
            columnDefs: [
                { className: "text-center", width: "15%", targets: 0 }, // Primeira coluna
                { className: "text-center", width: "5%", targets: 1 }, // Segunda coluna
                { className: "text-center", width: "5%", targets: 2 }, // Terceira coluna
                { className: "text-center", width: "5%", targets: 3 }, // Quarta coluna
                { className: "text-center", width: "5%", targets: 4 }, // E assim por diante
                { className: "text-center", width: "5%", targets: 5 },
                { className: "text-center", width: "5%", targets: 6 },
                { className: "text-center", width: "5%", targets: 7 },
                { className: "text-center", width: "15%", targets: 8 },
                { className: "text-center", width: "15%", targets: 9 }
            ]
        });

        $('#perfilTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
            },
            pageLength: 10,   // Define o número de registros por página
            select: true,
            responsive: true,
            searching: false,
            ordering: false, // Remove a caixa de pesquisa
            autoWidth: false, // Desabilita ajuste automático da largura
            columnDefs: [
                { className: "text-center", width: "20%", targets: 0 },
                { className: "text-center", width: "15%", targets: 1 },
                { className: "text-center", width: "15%", targets: 2 },
                { className: "text-center", width: "20%", targets: 3 }
            ]
        });

        $('#medidaCorporalTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
            },
            pageLength: 10,   // Define o número de registros por página
            select: true,
            responsive: true,
            searching: false,
            ordering: false, // Remove a caixa de pesquisa
            autoWidth: false, // Desabilita ajuste automático da largura
            columnDefs: [
                { className: "text-center", width: "50%", targets: 0 },
                { className: "text-center", width: "50%", targets: 1 }
            ]
        });

        $('#aptidaoCardioRespiratoriaTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
            },
            pageLength: 10,   // Define o número de registros por página
            select: true,
            responsive: true,
            searching: false,
            ordering: false, // Remove a caixa de pesquisa
            autoWidth: false, // Desabilita ajuste automático da largura
            columnDefs: [
                { className: "text-center", width: "50%", targets: 0 },
                { className: "text-center", width: "50%", targets: 1 }
            ]
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


document.addEventListener('DOMContentLoaded', function() {
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
    const btnCancelar = document.getElementById('cancelarExcluir');
    if (btnCancelar) {
        btnCancelar.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    // Funções para adicionar e remover regiões
    let contadorRegiao = 1;

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

        // Adicionar event listener ao botão "Remover"
        const btnRemover = div.querySelector('.remove-regiao');
        btnRemover.addEventListener('click', function() {
            removerRegiao(this);
        });
    }

    function removerRegiao(botao) {
        const div = botao.parentElement;
        div.remove();
    }

    const btnAdicionar = document.getElementById('adicionar-regiao');
    if (btnAdicionar) {
        btnAdicionar.addEventListener('click', adicionarRegiao);
    }


    function calcularMedia(grupo) {
        const valor1 = parseFloat(document.getElementById(grupo + '-1').value) || 0;
        const valor2 = parseFloat(document.getElementById(grupo + '-2').value) || 0;
        const valor3 = parseFloat(document.getElementById(grupo + '-3').value) || 0;
    
        // Calcula a média
        const media = (valor1 + valor2 + valor3) / 3;
    
        // Atualiza o campo de média correspondente
        document.getElementById(grupo + '-m').value = media.toFixed(2);
    
        // Atualiza o somatório
        calcularSomatorio();
    }
    
    // Função para calcular o somatório de todas as médias
    function calcularSomatorio() {
        const grupos = ['tricipital', 'subescapular', 'suprailiaca', 'abdominal', 'supraespinhal', 'coxa-guedes', 'coxa-pollock', 'panturrilha', 'peitoral', 'axilar-media', 'biceps'];
        
        let somatorio = 0;
    
        // Somando as médias de cada grupo
        grupos.forEach(grupo => {
            const media = parseFloat(document.getElementById(grupo + '-m').value) || 0;
            somatorio += media;
        });
    
        // Atualiza o campo de somatório
        document.getElementById('somatorio').value = somatorio.toFixed(2);
    }
});

