$(function(){

    //Função para abrir o menu quando clicar no botão (nav.mobile)
    $('nav.mobile').click(function(){

        var listaMenu = $('nav.mobile ul'); //Retornando o elemento que deve ser mostrado 
        var icone = $('.botao-menu-mobile').find('i'); //Retornando o ícone do botão que foi clicado

        //Verificando se o menu está ou não aberto
        if(listaMenu.is(':hidden')){ 
            listaMenu.slideToggle(); //Fazendo o menu aparecer

            //Trocando o ícone de 'abrir' para 'fechar'
            icone.removeClass('fa-bars'); 
            icone.addClass('fa-times');
        }
        else{
            listaMenu.slideToggle(); //Fazendo o menu desaparecer

            //Trocando o ícone de 'fechar' para 'abrir'
            icone.removeClass('fa-times');
            icone.addClass('fa-bars');
        }
    })
})