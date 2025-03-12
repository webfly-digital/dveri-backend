/**
 * Created by Vanya_Webfly on 02.12.2014.
 */
$(document).ready(function () {
    /* Горизонтальное меню */
    var winWidth = $(window).width();
    $(window).on('resize', function() {
        winWidth=$(window).width();
    });
    if(winWidth < 992) {
        console.log('touchmenu');
        $('body').on('tap', '.dropdown > a', function(e){
            touchMenu('.menu-catalog', $(this).parent('.dropdown'));
            return false;
            e.preventDefault();
        });
    }
    else {
        hoverMenu('.dropdown');
    }

    /*Сворачиваем меню по клике за его пределами*/
    $(document).click( function(event){
        if( $(event.target).closest(".menu-catalog").length)
            return;
        $('.menu-catalog .opened').removeClass('opened');
        event.stopPropagation();
    });
    /*Открываем на узких экранах*/
    $('.showMenu').on('click', function(){
        if($('#navAdapt').is(':not(".opened")'))
            showHidden('#navAdapt', '#navigation');
        else
            clearBox('#navAdapt');
    });


});

function hoverMenu(dropdownClass) {
    $(dropdownClass).hover(
        function(){
            $(this).addClass('opened');
        },
        function(){
            $(this).removeClass('opened');
        });
}

function touchMenu(menu, touchClass) {
    var trgt = $(touchClass);
    var trgtClass='.' + trgt.attr('class');
    var parent = trgt.parent('.submenu');
    if(trgt.is('.opened') && trgt.parent(menu).length) {
        //по повторному клику/тапу закрываем текущий выпадающий список
        $(menu).find('.opened').removeClass('opened');
        return false;
    }
    if(parent.length) { //клик по субменю второго уровня
        console.log('route 1');
        var firstParent = parent.parents('.dropdown');
        $(menu).find(trgtClass).removeClass('opened');
        firstParent.addClass('opened');
        trgt.toggleClass('opened');
        return false;
    }
    else { //клик по субменю первого уровня
        console.log('route 2');
        $(menu).find(trgtClass).removeClass('opened');
        trgt.addClass('opened');
    }
    return false;
}