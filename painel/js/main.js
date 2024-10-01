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

    // Lógica para o dropdown do menu
    $(document).ready(function() {
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