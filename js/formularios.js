$(function() {
    $('body').on('submit', 'form', function(event) {
        event.preventDefault(); // Previne o envio padrão do formulário
        var form = $(this);
        $.ajax({


            beforeSend: function() {
                console.log("Mostrando overlay de carregamento");
                $('.overlay-loading').fadeIn();
            },
            url: include_path + 'ajax/formularios.php',
            method: 'post',
            dataType: 'json',
            data: form.serialize()
        }).done(function(data) {
            console.log("Resposta do servidor:", data); // Verifique o conteúdo aqui
            if (data.sucesso) {
                $('.overlay-loading').fadeOut();
                $('.sucesso').fadeIn();
                setTimeout(function() {
                    $('.sucesso').fadeOut();
                }, 3000);
            } else {
                $('.overlay-loading').fadeOut();
                $('.erro').fadeIn();
                setTimeout(function() {
                    $('.erro').fadeOut();
                }, 3000);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Resposta do servidor:", jqXHR.responseText); // Verifique a resposta bruta
        
            $('.overlay-loading').fadeOut();
            $('.erro').fadeIn();
            setTimeout(function() {
                $('.erro').fadeOut();
            }, 3000);
        });
    });
});
