export function menu(){

    $('.menu-top__li').mouseenter(function(){
        $(this).find('.menu-top__li-link').css({'color':'#ffffff'}).addClass('menu-top__link-active');
    }).mouseleave(function(){
        $(this).find('.menu-top__li-link').css({'color':'#c5c5c5'}).removeClass('menu-top__link-active');
    });

    $('body').on('click', '.menu-mobile-icon', function(){
        var menu =  $(this).closest('body').find('.menu-mobile');
        menu.slideToggle('500', function(){

        });
    });
}