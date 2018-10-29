<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//print_r($arResult); die();
?>
<div class="wrapperReviews">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="zagolovok">
                    Эти люди довольны нашей работой
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                <div class="responsive slider">
                    <? foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>

                        <div class="itemReview">
                            <div class="imgReview"
                                 style="background-image: url('<?= !empty($arItem['PREVIEW_PICTURE']['SRC']) ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH . '/images/no-photo.jpg' ?>');"></div>
                            <div class="info">
                                <h4 class="reviewTitle">
                                    <?= $arItem['NAME'] ?> </h4>
                                <div class="city">
                                    <?= $arItem['PROPERTIES']['CITY']['VALUE'] ?>
                                </div>
                            </div>
                            <div class="textReview">
                                <p>
                                    <?= $arItem['PREVIEW_TEXT'] ?>
                                </p>
                                <? /*?>
                                <div class="soc">
                                    <a href="#" class="insta"></a>
                                </div>
 <div class="soc">
                                <a href="#" class="vk"></a>
                            </div>
<?*/ ?>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
                    <?/*?><div class="descrBttn">
                        Оставьте отзыв и получите 784 Vgood, которые Вы можете использовать как скидку на покупку
                        запчастей, шиномонтаж, автомойку, услуги автосервиса, диагностику автомобиля, прохождение
                        ТехОсмотра
                    </div><?*/?>
                    <div class="myCenter">
                        <a href="#" class="bttn brown large" data-toggle="modal" data-target="#review">Оставить отзыв</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade onlineZayavka" id="review" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Оставить отзыв</h2>
                <p>Оставьте Ваш отзыв в этой форме</p>
                <div class="btnClose">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                        <p><span></span>X</p>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" name="review" data="modal" id="review_form">
                    <input  name="action" type="hidden" value="new_review">
                    <input class="form" name="name" type="text" value="" placeholder="Имя" required>
                    <input class="form" name="city" type="text" value="" placeholder="Город" >
                    <textarea name="review" id="" cols="30" rows="10" placeholder="Ваш отзыв" required></textarea>
                    <label><input type="checkbox" value="1" name="personal" required><span></span>
                        Я ознакомлен с <a href="#">пользовательским соглашением</a> и согласен с <a href="#">политикой конфиденциальности</a></label>
                    <button class="btn bttn brown">Оставить отзыв</button>
                </form>
            </div>
        </div>
    </div>
</div>