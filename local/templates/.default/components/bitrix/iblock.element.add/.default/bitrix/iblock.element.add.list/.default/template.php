<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
$this->setFrameMode(false);
//pr($arResult["ELEMENTS"]);
?>
<? if (strlen($arResult["MESSAGE"]) > 0): ?>
    <? ShowNote($arResult["MESSAGE"]) ?>
<? endif ?>
    <p class="text-right"><a class="btn btn-default" href="<?=$arParams["EDIT_URL"]?>?edit=Y"><i class="fa fa-plus" aria-hidden="true"></i> <?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a></p>
    <div class="panel-group" role="tablist" id="accordion">
        <? if ($arResult["NO_USER"] == "N"): ?>

            <? if (count($arResult["ELEMENTS"]) > 0): ?>
                <? foreach ($arResult["ELEMENTS"] as $arElement): ?>


                    <div class="panel panel-black">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$arElement["ID"]?>" aria-expanded="false" aria-controls="collapse_<?=$arElement["ID"]?>" class="collapsed">
                                <h4 class="panel-title">
                                    <?=$arElement["NAME"]?>
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapse_<?=$arElement["ID"]?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                            <? /*?><div class="panel-body">
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					</div><?*/ ?>
                            <ul class="list-group">
                                <? foreach ($arElement['PROPERTIES'] as $property) {
                                    if (empty($property['VALUE'])) continue;
                                    if ($property['CODE'] == 'DEFECT') continue;
                                    ?>
                                    <li class="list-group-item">
                                        <dl class="dl-horizontal mb0">
                                            <dt><?=$property['NAME']?>:</dt>
                                            <dd><?=$property['VALUE']?></dd>
                                        </dl>
                                    </li>
                                    <?
                                } ?>
                                <?if(!empty($arElement['PREVIEW_TEXT'])):?>
                                    <li class="list-group-item">
                                        <dl class="dl-horizontal mb0">
                                            <dt>Комментарий:</dt>
                                            <dd><?=$arElement['PREVIEW_TEXT']?></dd>
                                        </dl>
                                    </li>
                                <?endif?>
                                <?if(!empty($arElement['PROPERTIES']['DEFECT']['VALUE']) || !empty($arElement['SOLD_GOODS'])){
                                    ?>

                                    <li class="list-group-item">
                                        <a href="javascript:void(0)" onclick="$('._defect<?=$arElement['ID']?>').toggle(100); $(this).closest('ul').find('input').focus().scrollToElement()">Списанные/проданные запчасти</a>
                                        <?if(!empty($arElement['SOLD_SUMM'])):?><span class="pull-right"><strong>Всего продано на <?=$arElement['SOLD_SUMM']?></strong></span><?endif;?>
                                    </li>
                                    <li class="list-group-item _defect<?=$arElement['ID']?>" style="display:none">
                                        <dl class="dl-horizontal mb10">
                                            <dt></dt>
                                            <dd>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control ml10 mb10" size="30" data-action="filter" data-filters=".js-filtred-<?=$arElement['ID']?>" value="" placeholder="фильтр по деталям"></div>
                                            </dd>
                                        </dl>
                                        <?if(!empty($arElement['PROPERTIES']['DEFECT']['VALUE'])){
                                            ?>


                                        <dl class="dl-horizontal mb0">
                                            <dt>Списанные:</dt>
                                            <dd>
                                                <ul class="js-filtred-<?=$arElement['ID']?>">
                                                    <?foreach ($arElement['PROPERTIES']['DEFECT']['VALUE'] as $item){
                                                        ?><li><?=$item?></li><?
                                                    }?>
                                                </ul>
                                            </dd>
                                        </dl>
                                        <?}?>
                                        <?if(!empty($arElement['SOLD_GOODS'])){
                                            ?>
                                            <dl class="dl-horizontal mb0 mt10">
                                                <dt>Проданные:</dt>
                                                <dd>
                                                    <ul class="js-filtred-<?=$arElement['ID']?>">
                                                        <?foreach ($arElement['SOLD_GOODS'] as $item){
                                                            ?><li><?=$item?></li><?
                                                        }?>
                                                    </ul>
                                                </dd>
                                            </dl>
                                            <?
                                        }?>
                                    </li>
                                    <?
                                }?>
                            </ul>

                            <div class="panel-footer text-right">
                                <? if ($arElement["CAN_EDIT"] == "Y"): ?><a class="btn btn-primary btn-sm" href="<?=$arParams["EDIT_URL"]?>?edit=Y&amp;CODE=<?=$arElement["ID"]?>"><?=GetMessage(
                                        "IBLOCK_ADD_LIST_EDIT"
                                    )?><? else: ?>&nbsp;<? endif ?></a>
                                <? if ($arElement["CAN_DELETE"] == "Y"): ?><a href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get(
                                )?>" onClick="return confirm('<? echo CUtil::JSEscape(
                                    str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM"))
                                ) ?>')"><?=GetMessage("IBLOCK_ADD_LIST_DELETE")?></a><? else: ?>&nbsp;<? endif ?>
                            </div>
                        </div>
                    </div>
                <? endforeach ?>
            <? else: ?>
                <p class="alert alert-warning"><?=GetMessage("IBLOCK_ADD_LIST_EMPTY")?></p>
            <? endif ?>

        <? endif ?>
    </div>
<? if (strlen($arResult["NAV_STRING"]) > 0): ?><?=$arResult["NAV_STRING"]?><? endif ?>