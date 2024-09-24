$(function(){
	// Aqui vai todo o código de javascript

	// Menu mobile
	$('nav.mobile').click(function(){
		// o que acontece quando clicamos na nav.mobile
		var listaMenu = $('nav.mobile ul');
		
		//Abrir menu usando fadeIn
		/*
		if(listaMenu.is(':hidden') == true)
			listaMenu.fadeIn();
		else
			listaMenu.fadeOut();
		*/
		// Abrir ou fechar o menu usando função propria jquery
		listaMenu.slideToggle();
	});

	// Função de scrool jquery 


	if($('target').length > 0){
		// O elemento existe, portanto precisamos dar o scroll em algum elemento 
		var elemento = '#'+$('target').attr('target');
		//alert(elemento);
		var divScroll = $(elemento).offset().top;
		
		$('html,body').animate({scrollTop:divScroll},2000);
		//lert(divScroll);
	}

	carregarDinamico()	;

	function carregarDinamico(){
		$('[realtime]').click(function(){
			var pagina = $(this).attr('realtime');
			$('.container-principal').hide();
			$('.container-principal').load(INCLUDE_PATH+'pages/'+pagina+'.php');
			
			setTimeout(function(){
				initialize();
				addMarker(-27.609959,-48.576585,'',"Minha casa",undefined,false);
			},1000);
			$('.container-principal').fadeIn(1000);
			
			return false;
		})
	}

})

