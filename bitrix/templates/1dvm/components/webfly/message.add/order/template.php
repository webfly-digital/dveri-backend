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
<div id="modalOrder" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <button class="modal-close" data-dismiss="modal"><span class="icomoon icon-cancel-music"></span></button>
            <form action="/include/ajax/order.php" method="post" id="orderForm" class="form">
                <input type="hidden" name="ym_target" value="ORDER_GOAL" class="ym_target">
                <input type="hidden" name="ajaxm" value="Y">
                <div class="form-fields">
                    <div class="modal-header">
                        <div class="modal__title h3">Онлайн-заявка</div>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <p class="form-row__caption">Как к вам обращаться?</p>
                            <input type="text" name="name" required minlength="2">
                        </div>
                        <div class="form-row">
                            <p class="form-row__caption">Номер телефона для связи</p>
                            <input type="text" name="phone" class="input-phone" placeholder="+7 XXX XXX-XX-XX" required>
                        </div>
                        <div class="form-row">
                            <p class="form-row__caption">Адрес электронной почты</p>
                            <input type="email" name="email" placeholder="my@example.ru" required>
                        </div>
                        <div class="form-row">
                            <p class="form-row__caption">Комментарии</p>
                            <textarea name="message" id="orderComment"></textarea>
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
                        <p>В ближайшее время мы свяжемся с вами для уточнения деталей заказа.</p>
                    </div>
                    <div class="modal-footer">
                        <p class="modal__infotext">Это окно закроется автоматически через несколько секунд</p>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>