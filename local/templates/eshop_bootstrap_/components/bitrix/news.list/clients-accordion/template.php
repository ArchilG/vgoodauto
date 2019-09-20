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
<p>
    <ul class="list-inline meta">
    <li><span class="label" style="background-color: #f00;">&nbsp;&nbsp;</span> - требует обработки</li>
    <li><span class="label" style="background-color: #00f;">&nbsp;&nbsp;</span> - заказ не выдан</li>
    <li><i class="fa fa-truck" aria-hidden="true"></i> - отправка транспортной компанией</li>
    <li><i class="fa fa-rub" aria-hidden="true"></i> - у клиента есть заказы</li>
    <li><i class="fa fa-user-times" aria-hidden="true"></i> - чёрный список</li>
</ul>
    </p>
    <div class="clients-list panel-group" role="tablist" id="accordion">

        <? foreach ($arResult["ITEMS"] as $arItem): ?>

            <div class="panel panel-black _client_<?=$arItem['ID']?> <?=!empty($arItem['PROPERTIES']['CRITICAL']['VALUE'])?'critical':''?> <?=!empty($arItem['PROPERTIES']['NE_VIDAN']['VALUE'])?'ne_vidan':''?>">
                <div class="panel-heading" role="tab" id="headingOne">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$arItem["ID"]?>" aria-expanded="false" aria-controls="collapse_<?=$arItem["ID"]?>" class="collapsed">
                        <h4 class="panel-title">
                            <?=$arItem["NAME"]?> <small><?=$arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']?><?if(!empty($arItem['DISPLAY_PROPERTIES']['TS']['VALUE'])):?>, <?=$arItem['DISPLAY_PROPERTIES']['TS']['VALUE']?><?endif?></small>

                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                            <?=!empty($arItem['PROPERTIES']['BLACKLIST']['VALUE'])?'<i class="fa fa-user-times pull-right mr10" aria-hidden="true">':''?>
                            <?=!empty($arItem['PROPERTIES']['OTK']['VALUE'])?'<i class="fa fa-truck pull-right mr10" aria-hidden="true"></i><i class="fa fa-truck pull-right" aria-hidden="true"></i><i class="fa fa-truck pull-right" aria-hidden="true"></i>':''?>
                            <?=!empty($arItem['ORDERS_SUMM'])?'<i class="fa fa-rub pull-right mr10" aria-hidden="true"></i>':''?>

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
                        <?if(!empty($arItem['ORDERS'])):?>
                            <li class="list-group-item">
                                <dl class="dl-horizontal mb0">
                                    <dt>Заказы:</dt>
                                    <dd>
                                        <p><?=implode('<br>',$arItem['ORDERS'])?></p>

                                        <p><b>Всего купил на <?=$arItem['ORDERS_SUMM']?> р.</b></p>

                                        <a target="_blank" href="/personal/orders-buh/?order_client_id=<?=$arItem['ID']?>">Посмотреть все в списке заказов</a>
                                    </dd>
                                </dl>
                            </li>
                        <?endif?>
                        <li class="list-group-item">
                            <b>Заметки</b>
                            <dl class="dl-horizontal client_note" data-client="<?=$arItem['ID']?>">
                                <?
                                if (empty($arItem['DISPLAY_PROPERTIES']['NOTE']['VALUE'])){
                                    ?>
                                    <dt class="_empt">заметок пока нет</dt>
                                    <dd class="_empt"></dd>
                                    <?
                                }
                                foreach ($arItem['DISPLAY_PROPERTIES']['NOTE']['VALUE'] as $k => $value) {
                                    //$valueArr = explode('::',$value);
                                    ?>
                                    <dt><?= $arItem['DISPLAY_PROPERTIES']['NOTE']['DESCRIPTION'][$k] ?></dt>
                                    <dd><?= $value ?></dd>
                                    <?/*?><div class="client_note"><span><?= $prop['DESCRIPTION'][$k] ?></span> <?= $value ?></div><br><?*/
                                }

                                ?>
                            </dl>
                            <button class="btn btn-success btn-xs" onclick="$(this).siblings('.add_note').toggle(); $('.add_note_form .form-control').focus()">Добавить заметку</button>
                            <div class="add_note" style="display:none">
                                <div class=" row mt10" >
                                    <form class="add_note_form" data-client="<?=$arItem['ID']?>">
                                        <div class="col-md-8 col-xs-12">
                                            <input type="hidden" name="client" value="<?=$arItem['ID']?>">
                                            <input type="text" class="form-control" name="note" placeholder="Заметка"  value=""/>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <button class="btn btn-default" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Добавить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="panel-footer text-right">
                        <button data-client="<?=$arItem['ID']?>" class="btn btn-warning btn-sm _set_critical"><?=!empty($arItem['PROPERTIES']['CRITICAL']['VALUE'])?'Обработано':'Требует обработки'?></button>
                        <button data-client="<?=$arItem['ID']?>" class="btn btn-sm btn-info _set_vidan" data-paied_orders="<?=!empty($arItem['PAYED_ORDERS'])?implode(',',$arItem['PAYED_ORDERS']):''?>"><?=!empty($arItem['PROPERTIES']['NE_VIDAN']['VALUE'])?'Товар выдан':'Товар ещё не выдан'?></button>
                        <button data-target="#client-target" data-client="<?=$arItem['ID']?>" data-toggle="modal" href="#client-target" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Редактировать</button>
                        <a href="/personal/orders-buh/?client_id=<?=$arItem['ID']?>" class="btn btn-sm btn-primary" target="_blank">Создать клиенту заказ</a>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<script>setClientsListClick();</script>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <p><?= $arResult["NAV_STRING"] ?></p>
<? endif ?>