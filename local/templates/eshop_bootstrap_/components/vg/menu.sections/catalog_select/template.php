<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<? if (!empty($arResult)): ?>
<?    Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.formstyler.min.js");?>
<script>
    var selectArResult = <?=json_encode($arResult)?>;
</script>

    <? if (!empty($arResult['LEVEL_1'])) {
        ?><select id="car_brand" class="select_style width-200 mr20">
        <option>Марка автомобиля</option>
        <?
        foreach ($arResult['LEVEL_1'] as $item) {
            ?><option value="<?=$item['ID']?>" data-url="<?=$item['SECTION_PAGE_URL']?>" data-cnt="<?=$item['ELEMENT_CNT']?>" <?=$item['SELECTED'] ? "selected" : ""?>><?=$item['NAME']?></option><?
        }
        ?></select><?
    }
    ?>
<select id="car_model" disabled class="select_style width-200">
    <option>Модель автомобиля</option>
</select>

 <select id="car_year" disabled class="select_style width-200">
    <option>Год выпуска</option>
</select>
<a href="" class="btn btn-default disabled" id="sectionGet">Показать <span></span></a>
<? endif ?>
