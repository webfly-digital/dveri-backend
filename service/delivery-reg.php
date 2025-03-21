<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @global CMain $APPLICATION */

$APPLICATION->SetPageProperty("DESCRIPTION", "Установка и монтаж противопожарных дверей в #WF_CITY_PRED#");
$APPLICATION->SetPageProperty("title", "Доставка и оплата | Завод «Двери металл-М» в #WF_CITY_PRED#");
$APPLICATION->SetTitle("Монтаж и установка");
?>

    <div class="text-content">
        <p class="subtitle">Компания Двери Металл-М предлагает доставку заказов в пределах Центрального региона, а также в другие регионы России по согласованию. Стоимость и срок доставки обсуждается
            с менеджером при оформлении заказа. Дата и время доставки подбираются совместно с клиентом. Возможна доставка любых объемов продукции на объект. Цена зависит от расстояния перевозки и
            объема партии.</p>
    </div>

    <!--Оплата и предоплата-->
    <section class="page-section">
        <p class="h2 page-section__title">Оплата и предоплата</p>
        <p class="subtitle">При оформлении заказа потребуется полная 100% предоплата всех заказанных позиций. Оплатить заказ вы можете любым удобным способом</p>
        <div class="text-content">
            <!--Варианты оплаты-->
            <div class="row other-content">
                <div class="col-xs-12 col-sm-6">
                    <div class="ico-block theme--light-gray">
                        <div class="ico-block__inner">
                            <div class="ico-block__icon">
                                <svg class="svg-icon svg-icon--xxl">
                                    <use xlink:href="/bitrix/templates/1dvm/img/svg-symbols.svg#cash"></use>
                                </svg>
                            </div>
                            <div class="ico-block__content">
                                <p class="ico-block__title">Наличные</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="ico-block theme--light-gray">
                        <div class="ico-block__inner">
                            <div class="ico-block__icon">
                                <svg class="svg-icon svg-icon--xxl">
                                    <use xlink:href="/bitrix/templates/1dvm/img/svg-symbols.svg#cashless"></use>
                                </svg>
                            </div>
                            <div class="ico-block__content">
                                <p class="ico-block__title">Безналичный расчет</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/варианты оплаты-->

            <p>При заказе крупных партий товара действуют индивидуальные предложения. Чтобы узнать больше информации и рассчитать стоимость заказа и доставки, свяжитесь с менеджером компании.</p>

            <h3>Порядок оплаты при наличном расчете</h3>
            <p>Заключается договор на производство и поставку противопожарных изделий. Необходимо произвести оплату в срок, установленный договором. Внести деньги возможно через сотрудников компании.
                Для заказов из регионов вся сумма вносится сразу.</p>

            <h3>Порядок оплаты при безналичном расчете</h3>
            <p>Заключается договор на производство и поставку изделий. Сотрудник компании подготовит и выставит счет, по которому необходимо произвести оплату. Счет может быть отправлен клиенту любым
                удобным способом — факс, электронная почта, почтовое отправление и прочее. Для начала производства должна быть внесена полная стоимость заказа.</p>

            <div class="gal gal-v4">
                <div class="gal-item">
                    <a href="/bitrix/templates/1dvm/img/doc-examples/doc-1.jpg" class="gal-item__preview">
                        <img alt="" src="<?= ImageCompressor::getCompressedSrc('/bitrix/templates/1dvm/img/doc-examples/preview/doc-1.jpg') ?>">
                    </a>
                </div>
                <div class="gal-item">
                    <a href="/bitrix/templates/1dvm/img/doc-examples/doc-2.jpg" class="gal-item__preview">
                        <img alt="" src="<?= ImageCompressor::getCompressedSrc('/bitrix/templates/1dvm/img/doc-examples/preview/doc-2.jpg') ?>">
                    </a>
                </div>
                <div class="gal-item">
                    <a href="/bitrix/templates/1dvm/img/doc-examples/doc-3.jpg" class="gal-item__preview">
                        <img alt="" src="<?= ImageCompressor::getCompressedSrc('/bitrix/templates/1dvm/img/doc-examples/preview/doc-3.jpg') ?>">
                    </a>
                </div>
            </div>
            <p class="text-caption">Пример документов, которыми сопровождается каждый заказ</p>
        </div>
    </section>
    <!--/оплата и предоплата-->

    <!--Варианты доставки-->
    <section class="page-section">
        <h2 class="page-section__title">Варианты доставки</h2>
        <div class="text-content">
            <p class="subtitle">Доставка в регионы осуществляется при помощи транспортной компании «Деловые Линии». Возможно оформление доставки до удобного терминала в городе получателя или
                непосредственно на адрес объекта.</p>
            <p>Найти ближайший терминал можно здесь:</p>

            <div class="delivery-snippet">
                <div class="delivery-snippet__pic">
                    <img src="/bitrix/templates/1dvm/img/dellines.png" alt="Деловые линии">
                </div>
                <div class="delivery-snippet__controls">
                    <a href="https://www.dellin.ru/contacts/" target="_blank" class="btn btn--sun">Смотреть терминалы</a>
                </div>
            </div>


            <p>Отправка при помощи транспортной компании оформляется в любой день недели с 9 до 19 часов. Дата и время получения рассчитываются по срокам доставки перевозчика.</p>
            <p>
                <a href="#modalUniversal" class="btn btn--gray modal-universal-button" data-options="Вызвать замерщика|.input-comment"><span class="flaticon-user-1"></span> Вызвать замерщика</a>
            </p>

        </div>
    </section>
    <!--/варианты доставки-->

    <!--Условия доставки-->
    <section class="page-section">
        <h2 class="page-section__title">Условия доставки</h2>
        <div class="text-content">
            <p class="subtitle">Упаковка и погрузка товара начинаются после получения оплаты заказа. Стоимость доставки зависит от объема продукции и города получателя. Средняя стоимость
                составляет:</p>

            <ul class="">
                <li>в Тамбов — от 4000 рублей при заказе от 1 и более позиций, от 6000 рублей при заказе от 10 и более
                    позиций,
                </li>
                <li>в Курск — от 4200 рублей при заказе от 1 и более позиций, от 6500 рублей при заказе от 10 и более
                    позиций,
                </li>
                <li>в Тулу — от 4900 рублей при заказе от 1 и более позиций, от 7000 рублей при заказе от 10 и более
                    позиций,
                </li>
                <li>в Рязань — от 4800 рублей при заказе от 1 и более позиций, от 6500 рублей при заказе от 10 и более
                    позиций,
                </li>
                <li>во Владимир — от 6500 рублей при заказе от 1 и более позиций, от 11000 рублей при заказе от 10 и
                    более позиций.
                </li>
            </ul>

            <p>Точную стоимость доставки в город получателя уточняйте у менеджера при оформлении заказа или у консультантов на горячей линии. Дата доставки согласовывается с клиентом по факту
                готовности заказа или при оформлении покупки.</p>
        </div>
    </section>
    <!--/условия доставки-->

    <!--Фото/видео-->
    <section class="page-section">
        <h2 class="page-section__title">Фото и видео с производства</h2>
        <div class="text-content">
            <p class="subtitle">Приглашаем вас ознакомиться с процессом изготовления противопожарной продукции на нашем заводе</p>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/SXc0VjE_qFY"></iframe>
            </div>

            <!--Фотки с производства - ограничиться тремя-->
            <!--Gallery-->
            <div class="gal gal-v2">
                <div class="gal-item">
                    <a href="/bitrix/templates/1dvm/img/gal/04.jpg" class="gal-item__preview"
                       style="background-image: url('<?= ImageCompressor::getCompressedSrc('/bitrix/templates/1dvm/img/gal/04.jpg') ?>');">
                    </a>
                </div>
                <div class="gal-item">
                    <a href="/bitrix/templates/1dvm/img/gal/07.jpg" class="gal-item__preview"
                       style="background-image: url('<?= ImageCompressor::getCompressedSrc('/bitrix/templates/1dvm/img/gal/07.jpg') ?>');">
                    </a>
                </div>
                <div class="gal-item">
                    <a href="/bitrix/templates/1dvm/img/gal/08.jpg" class="gal-item__preview"
                       style="background-image: url('<?= ImageCompressor::getCompressedSrc('/bitrix/templates/1dvm/img/gal/08.jpg') ?>');">
                    </a>
                </div>
            </div>
            <!--/gallery-->
            <!--/фотки с производства-->
        </div>
    </section>
    <!--/фото/видео-->


<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>