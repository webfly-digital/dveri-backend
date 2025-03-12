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
<div id="modalCallback" class="wf-modal modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="form-recall-new" class="wf-form">
                <input type="hidden" name="ajaxm" value="1" />
                <div class="modal-header">
                    <p class="h2 hideOnSuccess">Обратный звонок</p>
                    <p class="h2 showOnSuccess">Заявка успешно отправлена!</p>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span class="flaticon-cancel-button"></span></button>
                </div>

                <div class="modal-body">
                    <div class="row hideOnSuccess">
                        <div class="col-xs-12">
                            <div class="input-wrapper">
                                <p>Ваше имя</p>
                                <input type="text" name="name" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row hideOnSuccess">
                        <div class="col-xs-7">
                            <div class="input-wrapper">
                                <p>Номер телефона</p>
                                <input type="text" name="phone" value="" class="input-phone" placeholder="+7 000 000-00-00"/>
                            </div>
                        </div>
                    </div>
                    <div class="row showOnSuccess">
                        <div class="col-xs-12">
                            <p>В ближайшее время мы с Вами свяжемся по номеру, который вы указали</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer hideOnSuccess">
                    <button class="btn btn-primary btn-lg">Перезвоните мне</button>
                </div>
            </form>
        </div>
    </div>
</div>