$(function(){

    $('.botao-menu-mobile').click(function(){

        var listaMenu = $('div.box-links');
        var icone = $('.botao-menu-mobile').find('i');

        if(listaMenu.is(':hidden')){ 
            listaMenu.slideToggle();

            icone.removeClass('fa-bars'); 
            icone.addClass('fa-times');
             
        }
        else{
            listaMenu.slideToggle();

            icone.removeClass('fa-times');
            icone.addClass('fa-bars');
        }
    });
})