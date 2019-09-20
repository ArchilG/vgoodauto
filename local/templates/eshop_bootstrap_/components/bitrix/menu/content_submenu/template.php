<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode( true );?>
<?if (!empty($arResult)):?>
    <div class="bx-breadcrumb">
        <?
        foreach($arResult as $arItem):?>
            <?if ($arItem["SELECTED"]):?>
                <div class="bx-breadcrumb-item">
                    <span><?=$arItem["TEXT"]?></span>
                </div>
            <?else:?>
                <div class="bx-breadcrumb-item">
                    <a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>">
                        <span><?=$arItem["TEXT"]?></span>
                    </a>
                </div>
            <?endif?>

        <?endforeach?>
        <div style="clear:both"></div>
    </div>
<?endif?>



