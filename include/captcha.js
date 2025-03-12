$(document).ready(function () {
    $("body").on("click", '#reloadCaptcha', function () {
        $('#whiteBlock').show();
        $.getJSON('/include/ajax/reload_captcha.php', function (data) {
            $('#captchaImg').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + data);
            $('#captchaSid').val(data);
            setTimeout(function () {
                $('#whiteBlock').hide();
            }, 300);

        });
        return false;
    });
});

