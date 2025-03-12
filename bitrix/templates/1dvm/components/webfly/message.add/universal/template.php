<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div id="modalUniversal" class="modal fade in active">
    <div class="modal-dialog">
        <div class="modal-content">
            <button class="modal-close" data-dismiss="modal"><span class="icomoon icon-cancel-music"></span></button>
            <form action="/include/ajax/universal.php" method="post" id="uniForm" class="form">
                <input type="hidden" name="ajaxm" value="Y">
                <input type="hidden" name="ordername" value="" class="ordername">
                <input type="hidden" name="ym_target" value="" class="ym_target">
                <div class="form-fields">
                    <div class="modal-header">
                        <div class="modal__title h3">Универсальное окно</div>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <p class="form-row__caption">Как к вам обращаться?</p>
                            <input type="text" name="name" class="user-field" required minlength="2"></div>
                        <div class="form-row">
                            <p class="form-row__caption">Номер телефона для связи</p>
                            <input type="text" name="phone" class="input-phone user-field" placeholder="+7 XXX XXX-XX-XX" required></div>
                        <div class="form-row">
                            <p class="form-row__caption">Адрес электронной почты</p>
                            <input type="email" name="email" placeholder="my@example.ru" class="user-field input-email" required></div>
                        <div class="form-row">
                            <p class="form-row__caption">Комментарий</p>
                            <textarea name="comment" placeholder="" class="user-field input-comment"></textarea>
                        </div>
                        <div class="form-row">
                            <label for="agreement" class="checkbox">
                                <input type="checkbox" name="agreement" id="agreement" checked required>
                                <small class="checkbox__inner">Даю свое согласие на обработку моих персональных данных, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях определенных в Согласии на обработку персональных данных
</small>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-footer">
                            <button type="submit" class="btn btn--lg btn--sky">Отправить заявку</button>
                        </div>
                    </div>
                </div>
                <div class="form-thanks">
                    <div class="modal-header">
                        <div class="modal__title h3">Заявка отправлена!</div>
                    </div>
                    <div class="modal-body">
                        <p>В ближайшее время мы с вами свяжемся.</p>
                    </div>
                    <div class="modal-footer">
                        <p class="modal__infotext">Это окно закроется автоматически через несколько секунд</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>