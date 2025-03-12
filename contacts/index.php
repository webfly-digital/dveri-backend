<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты в #WF_CITY_PRED# | Завод «Двери металл-М»");
$APPLICATION->SetPageProperty("description", "Контакты завода Двери металл-М в #WF_CITY_PRED#  - производство противопожарных дверей. Схема проезда, телефоны, адрес, производство и продажа противопожарных дверей.");
$APPLICATION->SetTitle("«Двери металл-М» в #WF_CITY_PRED#");
?><?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"left",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "36000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "N"
	)
);?>
<div class="col-md-9">
	<div class="row">
		<div class="col-sm-4">
			<h6>Звоните</h6>
			<div class="contacts-section">
				<div class="contacts-section__top">
 <span class="flaticon-phone-call"></span>
					#WF_PHONE#<br>
					#WF_PHONES_GOR#
				</div>
				<div class="contacts-section__bottom">
					<p>
						<br /> #WF_SCHEDULE#
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<h6>Пишите</h6>
			<div class="contacts-section">
				<div class="contacts-section__top">
 <span class="flaticon-envelope"></span> <a href="mailto:#WF_EMAIL#">#WF_EMAIL#</a>
				</div>
                <div class="contacts-section__bottom">
                    <div class="socials">
                        <a href="https://t.me/dverim_bot" target="_blank" class="telegram"></a>
                        <span class="whatsapp"></span>
                    </div>
                </div>
			</div>
		</div>
		<div class="col-sm-4">
			<h6>Приходите</h6>
			<div class="contacts-section">
				<div class="contacts-section__top">
 <span class="flaticon-placeholder"></span>
					Офис в #WF_CITY_PRED#:<br>
					 #WF_CONTACTS#<br><br>#WF_ADRESS_2#
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<h6>Скачать</h6>
			<div class="contacts-section">
				<div class="contacts-section__top">
					<a href="/info/about/" class="link-doc">Реквизиты в PDF</a>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="map-section">
				<h6>Офис «Двери Металл-М» на карте</h6>
				 #WF_MAP#
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
				#WF_CONTACTS_FOTO#
		</div>
	</div>
</div>
<div style="clear: both;">
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>