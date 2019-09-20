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
//if(!empty($_REQUEST['archil']))pr($arResult['NAV_RESULT']->NavRecordCount);
?>
<p>Всего <?=$arResult['NAV_RESULT']->NavRecordCount?></p>

    <div class="clients-list panel-group" role="tablist" id="accordion">

        <? foreach ($arResult["ITEMS"] as $arItem): ?>

            <div class="panel panel-black _partner_<?=$arItem['ID']?>">
                <div class="panel-heading" role="tab" id="headingOne">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$arItem["ID"]?>" aria-expanded="false" aria-controls="collapse_<?=$arItem["ID"]?>" class="collapsed">
                        <h4 class="panel-title">
                            <?=$arItem["NAME"]?> <small><?=$arItem['DISPLAY_PROPERTIES']['CITY']['VALUE']?></small>
                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </h4>
                    </a>
                </div>
                <div id="collapse_<?=$arItem["ID"]?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                    <? /*?><div class="panel-body">
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					</div><?*/ ?>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <dl class="dl-horizontal mb0 meta">
                                <dt>Добавлен:</dt>
                                <dd><?=substr($arItem['DATE_CREATE'],0,-3)?>&nbsp;&nbsp;
                                    <?=$arItem['CREATED_USER_NAME']?></dd>
                            </dl>
                        </li>
                        <? foreach ($arItem['DISPLAY_PROPERTIES'] as $prop) {
                            if($prop['ID'] == 202) continue;
                            ?>
                            <li class="list-group-item">
                                <dl class="dl-horizontal mb0">
                                    <dt><?=$prop['NAME']?>:</dt>
                                    <dd><?=$prop['VALUE']?></dd>
                                </dl>
                            </li>
                            <?
                        } ?>
                        <?if(!empty($arItem['PREVIEW_TEXT'])):?>
                            <li class="list-group-item">
                                <dl class="dl-horizontal mb0">
                                    <dt>Комментарий:</dt>
                                    <dd>
                                        <?=$arItem['PREVIEW_TEXT']?>
                                    </dd>
                                </dl>
                            </li>
                        <?endif?>
                    </ul>
                    <div class="panel-footer text-right">
                        <button data-target="#partner-target" data-partner="<?=$arItem['ID']?>" data-toggle="modal" href="#partner-target" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Редактировать</button>

                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <p><?= $arResult["NAV_STRING"] ?></p>
<? endif ?>