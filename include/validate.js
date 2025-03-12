$(document).ready(function () {
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    });
    $("form.wf_feedback").validate({
        submitHandler: function (form) {
            var $captcha_word_input, $captcha_sid_input, $inputBlock, captcha_word, captcha_sid, params;
            $inputBlock = $("#captchaBlock .inline");
            $captcha_word_input = $(form).find("input[name='captcha_word']");
            $captcha_sid_input = $(form).find("input[name='captcha_sid']");
            captcha_word = $captcha_word_input.val();
            captcha_sid = $captcha_sid_input.val();
            console.log(captcha_word);
            params = {captcha_word: captcha_word, captcha_sid: captcha_sid};
            $.post("/include/ajax/check_captcha.php", params, function (data) {
                if (data.indexOf("wrong") == 0)
                {
                    $captcha_word_input.addClass("error");
                    $inputBlock.append('<label class="error" for="captcha_word">Вы ввели неверные символы</label>');
                }
                if (data.indexOf("right") == 0)
                {
                    $captcha_word_input.removeClass("error");
                    $inputBlock.find('label.error').hide();
                    $(form).ajaxSubmit();
                    $("form.wf_feedback .but button").hide();
                    $("form.wf_feedback .but span").show();
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            });
        },
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                minlength: 7
            },
            uploadfile: {
                filesize: 31457280
            },
            captcha_word: {
                required: true
            }
        },
        messages: {
            name: {
                required: 'Пожалуйста, представьтесь'
            },
            email: {
                required: 'Укажите ваш e-mail',
                email: 'Пожалуйста, введите корректный e-mail',
                minlength: "Слишком мало букв (мин. - 7 символов)"
            },
            uploadfile: {
                filesize: 'Файл превышает допустимый размер и не может быть загружен!'
            },
            captcha_word: {
                required: 'Введите символы с картинки'
            }
        },
    });
    $("form.wf_zamer").validate({
        submitHandler: function (form) {
            $(form).ajaxSubmit();
            $("form.wf_zamer .but button").hide();
            $("form.wf_zamer .but span").show();
            setTimeout(function () {
                location.reload();
            }, 3500);
        },
        rules: {
            name: {
                required: true
            },
            email: {
                required: false,
            },
            phone: {
                required: true
            }
        },
        messages: {
            name: {
                required: 'Пожалуйста, представьтесь'
            },
            email: {
                required: '',
            },
            phone: {
                required: 'Пожалуйста, укажите Ваш телефон'
            }

        },
    });
$('.inputPhone').mask('+7 999 999-99-99');
    var $callbackform = $('#form-callback');
    if ($callbackform.length) {
        var callback_validator = $callbackform.validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                phone: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Это поле обязательно для заполнения",
                    minlength: "Минимальная длина поля - 2 символа"
                },
                phone: {
                    required: "Это поле обязательно для заполнения"
                }
            },
            submitHandler: function (form) {
                $(form).ajaxSubmit();
                $(form).find("button").hide();
                 $(form).find(".hiddensuccess").show();
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
        });
    }
})