function window_open(url, sizex, sizey, r, scrollb)
{
    var r, titlepage, scrollb;
    if (!scrollb)
        scrollb = 0;
    window.open(url, r, 'Toolbar=0, Titlebar=0, Location=0, Directories=0, Status=0, Menubar=0, Scrollbars=' + scrollb + ', Resizable=0, Copyhistory=1, width=' + sizex + ',height=' + sizey);
}


$.fn.pxgradient = function (options) {

    var options = $.extend({
        //step: 3,
        step: 3,
        colors: ["#eee", "#222"],
        dir: "y"
    }, options);
    options.RGBcolors = [];

    for (var i = 0; i < options.colors.length; i++) {
        options.RGBcolors[i] = hex2Rgb(options.colors[i]);
    }

    return this.each(function (i, e) {

        var pxg = $(e);

        if (!pxg.hasClass("sn-pxg")) {
            var pxg_source = pxg.html();
            pxg
                    .html('<span class="pxg-source" style="visibility: hidden;">' + pxg_source + '</span>')
                    .append('<u class="pxg-set"></u>');

            var pxg_set = pxg.find(".pxg-set");
            var pxg_text = pxg.find(".pxg-source");
            var pxg_w = pxg_text.width() + 10;
            var pxg_h = pxg_text.innerHeight();

            pxg_text.hide();
            pxg.addClass("sn-pxg");

            if (options.dir == "x") {
                var blocksize = pxg_w;
            }
            else if (options.dir == "y") {
                var blocksize = pxg_h;
            }

            var fullsteps = Math.floor(blocksize / options.step);
            var allsteps = fullsteps;
            var laststep = (blocksize - (fullsteps * options.step));

            if (laststep > 0) {
                allsteps++;
            }

            pxg_set.css({width: pxg_w, height: pxg_h});

            var offleft = 0;
            var pxg_set_html = '';

            if (options.dir == "x") {
                for (var i = 0; i < allsteps; i++) {
                    var color = getColor(offleft, blocksize);
                    pxg_set_html += '<s style="height:' + pxg_h + 'px;width:' + options.step + 'px;left:' + offleft + 'px;color:' + color + '"><b style="left:-' + offleft + 'px;width:' + pxg_w + 'px;height:' + pxg_h + 'px;">' + pxg_source + '</b></s>';
                    offleft = offleft + options.step;
                }
            } else if (options.dir == "y") {
                for (var i = 0; i < allsteps; i++) {
                    var color = getColor(offleft, blocksize);
                    pxg_set_html += '<s style="width:' + pxg_w + 'px;height:' + options.step + 'px;top:' + offleft + 'px;color:' + color + '"><b style="top:-' + offleft + 'px;height:' + pxg_w + 'px;height:' + pxg_h + 'px;">' + pxg_source + '</b></s>';
                    offleft = offleft + options.step;
                }
            }

            pxg_set.append(pxg_set_html);
        }
    });

    function hex2Rgb(hex) {
        if ('#' == hex.substr(0, 1)) {
            hex = hex.substr(1);
        }
        if (3 == hex.length) {
            hex = hex.substr(0, 1) + hex.substr(0, 1) + hex.substr(1, 1) + hex.substr(1, 1) + hex.substr(2, 1) + hex.substr(2, 1);
        }
        return [parseInt(hex.substr(0, 2), 16), parseInt(hex.substr(2, 2), 16), parseInt(hex.substr(4, 2), 16)];
    }

    function rgb2Hex(rgb) {
        var s = '0123456789abcdef';
        return '#' + s.charAt(parseInt(rgb[0] / 16)) + s.charAt(rgb[0] % 16) + s.charAt(parseInt(rgb[1] / 16)) + s.charAt(rgb[1] % 16) + s.charAt(parseInt(rgb[2] / 16)) + s.charAt(rgb[2] % 16);
    }

    function getColor(off, blocksize) {
        var fLeft = (off > 0) ? (off / blocksize) : 0;
        for (var i = 0; i < options.colors.length; i++) {
            fStopPosition = (i / (options.colors.length - 1));
            fLastPosition = (i > 0) ? ((i - 1) / (options.colors.length - 1)) : 0;
            if (fLeft == fStopPosition) {
                return options.colors[i];
            } else if (fLeft < fStopPosition) {
                fCurrentStop = (fLeft - fLastPosition) / (fStopPosition - fLastPosition);
                return getMidColor(options.RGBcolors[i - 1], options.RGBcolors[i], fCurrentStop);
            }
        }
        return options.colors[options.colors.length - 1];
    }

    function getMidColor(aStart, aEnd, fMidStop) {
        var aRGBColor = [];
        for (var i = 0; i < 3; i++) {
            aRGBColor[i] = aStart[i] + Math.round((aEnd[i] - aStart[i]) * fMidStop)
        }
        return rgb2Hex(aRGBColor)
    }
}



$(function () {
    $(".gheader").pxgradient();

    $("#foo2").carouFredSel({
        circular: false,
        infinite: false,
        auto: false,
        prev: {
            button: "#foo2_prev",
            key: "left"
        },
        next: {
            button: "#foo2_next",
            key: "right"
        }
    });


    $('.doors_menu.cat a').hover(
            function () {
                var index = $('.doors_menu.cat a').index($(this));
                $('.doors a').not(':eq(' + index + ')').find('img:eq(1)').fadeTo('fast', 1);
            },
            function () {
                var index = $('.doors_menu.cat a').index($(this));
                $('.doors a').not(':eq(' + index + ')').find('img:eq(1)').fadeTo('fast', 0);

            }
    );
    /*$('.doors a').hover(
     function(){
     //$(this).find('img:eq(0)').fadeTo('fast',0);
     $('.doors a').not(this).find('img:eq(1)').fadeTo('fast',1);
     },
     function(){
     $('.doors a').not(this).find('img:eq(1)').fadeTo('fast',0);
     //$(this).find('img:eq(0)').fadeTo('fast',1);
     }
     );*/
    $('.feedback button').click(function () {
        $.post('/feedback.php', $('.feedback').serialize(), function (d) {
            $('.feedback button').replaceWith(d);
        });
        return false;
    });

    /*$('.ajaxview,.newshead').click(function () {
        $.get(this.href, function (d) {
            $('.ajaxblock,.kover').remove();
            $('body').append('<div class="ajaxblock"></div><div class="kover"></div>');
            $(".ajaxblock").html(d);
            $('.ajaxform').css("top", Math.max(0, (($(window).height() - $('.ajaxform').outerHeight()) / 2) + $(window).scrollTop()) + "px");
            $('.ajaxform').css("left", Math.max(0, (($(window).width() - $('.ajaxform').outerWidth()) / 2) + $(window).scrollLeft()) + "px");

            $(".kover").fadeIn("fast", function () {
                $('.kover').css('filter', 'alpha(opacity=70)');
            });
        });
        return false;
    });*/

    $('.uploader').on('click', function () {

        th = this;
        $(this).prev().click();
    });
    $('.photot').on('click', function () {
        tv = this;
        $.get(this.href, function (d) {
            $('.ajaxblock,.kover').remove();
            $('body').append('<div class="ajaxblock" style="display:none"></div><div class="kover"></div>');
            $(".ajaxblock").html(d);
//$(".kover").fadeIn("fast",function(){ $('.kover').css('filter', 'alpha(opacity=70)');   });
            $('.onephoto:eq(0) a').click();
        });
        return false;
    });


    $("#file").on('change', function (e) {

        var uploadData = $("#file").prop("files")[0];
        var newData = new FormData();

        $.each($('#file').prop("files"), function (i, file) {
            newData.append('file-' + i, file);
            newData.append('theme', $('#theme').val());
        });
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: "/vacu.php",
            data: newData,
            success: function (d)
            {
                $(th).replaceWith(d);
            }
        });
    });


   /* $('.smartview').fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false,
        'cyclic': true,
        'padding': 20,
        'titlePosition': 'over',
        'onComplete': function () {
            $("#fancybox-title").hide();
        }
    });*/
    $('.kclose, .kover').on('click', function () {
        $(".ajaxblock,.ajaxblock2").fadeOut("fast");
        $(".kover").fadeOut("fast");
        return false;
    });

});
var th;



$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });

    $('#toTop').click(function () {
        $('body,html').animate({scrollTop: 0}, 800);
    });
});


/*$(document).ready(function () {
    $('a[href^=#]').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                && location.hostname == this.hostname) {
            var $target = $(this.hash);
            $target = $target.length && $target
                    || $('[name=' + this.hash.slice(1) + ']');
            if ($target.length) {
                var targetOffset = $target.offset().top;
                $('html,body')
                        .animate({scrollTop: targetOffset}, 1000);
                return false;
            }
        }
    });
});*/
/*01.07.2015*/
  $(window).load(function() {
	if ($('.blueberry').length)
        $('.blueberry').blueberry();
});
/**/
$(document).ready(function () {
    $(".fastOrder").on('click', function(e) {

        var elName = $(this).attr("elName"),
            $ta = $('.wf_feedback textarea'),
            target = $(this).attr('href');
        $("html,body").stop().animate({"scrollTop": $(target).offset().top}, 700);
        $ta.text(elName).focus();
        e.preventDefault();
    });
});

