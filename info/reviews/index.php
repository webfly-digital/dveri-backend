<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Отзывы | Завод «Двери металл-М»");
$APPLICATION->SetTitle("Отзывы");
?>
<?
$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
  "ROOT_MENU_TYPE" => "left",
  "MENU_CACHE_TYPE" => "A",
  "MENU_CACHE_TIME" => "36000",
  "MENU_CACHE_USE_GROUPS" => "Y",
  "MENU_CACHE_GET_VARS" => array(
  ),
  "MAX_LEVEL" => "1",
  "CHILD_MENU_TYPE" => "",
  "USE_EXT" => "N",
  "DELAY" => "N",
  "ALLOW_MULTI_SELECT" => "N"
    ), false
);
?>
<div class="col-md-9">
    <? $gallery = WFGeneral::GetGallery(9); ?>
    <div class="gal gal-v2">
        <?
        if ($gallery):
            foreach ($gallery as $production):
                if (!empty($production["DESCRIPTION"]))
                    $production_desc = $production["DESCRIPTION"];
                else
                    $production_desc = $production["NAME"];
                ?>
                <div class="gal-item">
                    <a href="<?= $production["PATH"] ?>" class="gal-item__preview lazyload" title="<?= $production_desc ?>"
                       data-original="<?= $production["PATH"] ?>"></a>
                </div>
            <?
            endforeach;
            else:
                ?>
        <p>Пока нет ни одного отзыва!</p>
                    <?
        endif;
        ?>
    </div>

</div>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>