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
?>
<div class="wrapperServices">
    <div class="container-fluid">
        <div class="row">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="art">
                        <div class="imgArt" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>')">
                        </div>
                        <h2 class="title"><span><?=$arItem['NAME']?></span></h2>
                        <div class="buttons">
                            <a href="#" class="bttn blue mini" data-toggle="modal" data-title="<?=$arItem['NAME']?>" data-url="/ajax/<?=$arItem['DISPLAY_PROPERTIES']['FORM']['VALUE']?$arItem['DISPLAY_PROPERTIES']['FORM']['VALUE']:'get_app_form'?>.php" data-target="#onlineZayavka"><?=$arItem['DISPLAY_PROPERTIES']['BUTTON_TEXT']['VALUE']?$arItem['DISPLAY_PROPERTIES']['BUTTON_TEXT']['VALUE']:'Заказать'?></a>
                            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="<?=$arItem['DISPLAY_PROPERTIES']['TARGET']['DISPLAY_VALUE']?>" class="bttn black mini" >Подробнее</a>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
