$(function(){

    // get load average value from crm
    // wf-load-avg input setup in bitrix\templates\1dvm\header.php
    var wfLoadEl = document.getElementById('wf-load-avg');

    if (wfLoadEl) {
        var readyTime = wfLoadEl.value, //срок изготовления (дни)
            $readyPh = $(".wf-order-ready"); //плейсхолдеры для даты готовности

        $( ".wf-load-value" ).each(function( index ) {
            $( this ).html(readyTime);
            if ($( this ).data('ratio'))
                $( this ).html(Math.round(parseFloat(readyTime) * parseFloat($( this ).data('ratio'))));
        });

        //вывод даты готовности заказа на детальной странице двери
        calculateOrderReady(readyTime, $readyPh);
    }

    let searchGroups = $('.search-group')
    if (searchGroups.length) {
        searchGroups.each(function (index, item) {
            let opener = item.querySelector('.search-opener'),
                input = item.querySelector('.search-input');
            if (opener && input) {
                opener.addEventListener('click', function () {
                    if (!item.classList.contains('opened')) {
                        event.preventDefault()
                        item.classList.add('opened')
                        input.focus()
                    }
                })
                item.addEventListener("click", function () {
                    event.stopPropagation()
                })
                window.addEventListener("click", function () {
                    item.classList.remove('opened')
                })
            }
        })
    }
    var $topMenuSlider = $('.top-screen__menu');
        if ($topMenuSlider.length) {
            $topMenuSlider.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                lazyload: 'ondemand',
                prevArrow: `<button type="button" class="slick-prev"></button>`,
                nextArrow: `<button type="button" class="slick-next"></button>`,
                autoplay: false,
                autoplaySpeed: 5000,
                mobileFirst: true,
                responsive: [{
                    breakpoint: 767,
                    settings: "unslick"
                }]
            });
        }
});

/*Вывод даты готовности*/
function calculateOrderReady(days, $targets) {
    if ($targets.length === 0 || typeof $targets === 'undefined')
        return false;
    var d = new Date();

    d.setDate(d.getDate() + parseInt(days));

    var readyString = formatDate(d);

    $targets.each(function(){
        this.innerHTML = readyString;
    });
}

function formatDate(date) {

    var dd = date.getDate();
    if (dd < 10) dd = '0' + dd;

    var mm = date.getMonth();
    var months = ['января', 'февраля', 'матра', 'апреля', 'мая','июня','июля','августа','сентября','октября','ноября','декабря']
   // var yy = date.getFullYear();

    return dd + ' ' + months[mm];
}