function Subscribirse(){
    alert("Te has suscrito al autor");
}

$(document).ready(function(){

    $('.main-nav-item').click(function(){
        if($(this).attr('id') != 'Entrar' && $(this).attr('id') != 'Salir'){
            $(this).addClass('activo').siblings().removeClass('activo');
            var elemento1 = $(this);
            $('.nav-item-sub').each(function(){
                if(elemento1.attr('id') == $(this).attr('id')){
                    $(this).removeClass('oculto');
                    console.log($(this));
                    
                }else{
                    $(this).addClass('oculto');
                }
            });
            console.log($('.nav-item-sub'));
            switch(elemento1.attr('id')){
                    case '1':
                        $('.libros').each(function(){
                            if($(this).attr('id')<=6){
                                $(this).removeClass('oculto');
                            }else{
                                $(this).addClass('oculto');
                            }
                        });
                    break;
                    case '2':
                        $('.libros').each(function(){
                            if($(this).attr('id')<=9 && $(this).attr('id')>6){
                                $(this).removeClass('oculto');
                            }else{
                                $(this).addClass('oculto');
                            }
                        });
                    break;
                    case '3':
                        $('.libros').each(function(){
                            if($(this).attr('id')<=12 && $(this).attr('id')>9){
                                $(this).removeClass('oculto');
                            }else{
                                $(this).addClass('oculto');
                            }
                        });
                    break;      
                }
            }
    });

    $('.nav-item-sub').click(function(){
        if($(this).hasClass("activo")){
            $(this).removeClass('activo');
        }else{
            var elemento1sub = $(this);
            $(this).addClass('activo').siblings().removeClass('activo');
            switch($(this).attr('data-iden2')){
                case '14':
                    $('.libros').each(function(){
                        if($(this).attr('id')==4){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
                case '15':
                    $('.libros').each(function(){
                        if($(this).attr('id')==5){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
                case '16':
                    $('.libros').each(function(){
                        if($(this).attr('id')==6){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
                case '27':
                    $('.libros').each(function(){
                        if($(this).attr('id')==7){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
                case '28':
                    $('.libros').each(function(){
                        if($(this).attr('id')==8){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
                case '29':
                    $('.libros').each(function(){
                        if($(this).attr('id')==9){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
                case '310':
                    $('.libros').each(function(){
                        if($(this).attr('id')==10){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
                case '311':
                    $('.libros').each(function(){
                        if($(this).attr('id')==11){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
                case '312':
                    $('.libros').each(function(){
                        if($(this).attr('id')==12){
                            $(this).removeClass('oculto');
                        }else{
                            $(this).addClass('oculto');
                        }
                    });
                break;
            }
        } 
    });
});