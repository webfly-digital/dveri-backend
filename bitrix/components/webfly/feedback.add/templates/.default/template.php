<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
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
<form name="feedbackForm" id="feedbackForm" action="/include/ajax/order.php" method="post">
            <input type="hidden" name="orderItem" value=""/>
            <input type="hidden" name="ajaxm" value="lal" />
            <div class="col-xs-12 col-sm-6">
                <h4><?=GetMessage("WF_COMPONENT_NAME")?></h4>
                    <div class="col-xs-12 line">
                        <input name="name"  type="text" value="" placeholder="<?=GetMessage("WF_USER_NAME")?>" class="inputName"/>
                    </div>
                    <div class="col-xs-12 col-sm-6 line"><input name="email" type="text" value="" placeholder="<?=GetMessage("WF_EMAIL")?>" class="inputMail"></div>
                    <div class="col-xs-12 col-sm-6 line"><input name="phone" type="text" value="" placeholder="<?=GetMessage("WF_CELL")?>" class="inputPhone"></div>
                    <div class="col-xs-12 line">
                        <textarea name="message"  value="" placeholder="<?=GetMessage("WF_TEXT")?>"></textarea>
                    </div>

                    <div class="col-xs-12 line">
                        <p class="legend"><?=GetMessage("WF_NECESSARILY")?></p>
                    </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="col-xs-12 fb_info">
                    <h4><?=GetMessage("WF_INFO_TITLE")?></h4>
                    <p><?=GetMessage("WF_INFO")?></p>
                    <h4><?=GetMessage("WF_TIME_TITLE")?></h4>
                    <p><?=GetMessage("WF_TIME")?></p>
                </div>
                <div class="col-xs-12 fb_info">
                    <input type="submit" value="<?=GetMessage("WF_SUBMIT")?>" class="btn-cart btn-inverted"/>
                </div>
            </div>
        </form>
        <div class="successMessage hide">
            <div class="col-xs-12">
                <?=GetMessage("WF_SUCCESS")?>
            </div>
        </div>
