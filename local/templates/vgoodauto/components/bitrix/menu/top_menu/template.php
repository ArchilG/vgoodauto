<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
if (empty($arResult))
    return;
?>
<ul class="nav">
    <? foreach ($arResult as $itemIdex => $arItem):  $parid = 0;?>
        <?
        if($arItem["DEPTH_LEVEL"] == "1"){
            $par = str_replace('/','',$arItem['LINK']);
        }

        if($arItem["SELECTED"]){
            $selectedClass = $par;
        }
        ?>

            <li class="<?=($arItem["SELECTED"])?'selected':''?> <?=($arItem["DEPTH_LEVEL"] == "1") ? 'first' : 'sub '.$par?>"><a href="<?= htmlspecialcharsbx($arItem["LINK"]) ?>"><?= htmlspecialcharsbx($arItem["TEXT"]) ?><?if($arItem['IS_PARENT']): ?><i class="fa fa-chevron-down" data-par="<?=$par?>" aria-hidden="true" title="Раскрыть"></i><i class="fa fa-chevron-up" data-par="<?=$par?>" title="Скрыть" aria-hidden="true" style="display:none"></i><?endif?></a></li>

    <? endforeach; ?>
</ul>

<?if(!empty($selectedClass)):?>
<script>
    $(function () {
        $('.fa.fa-chevron-down[data-par="<?=$selectedClass?>"]').trigger('click');
    })
</script>
<?endif?>
