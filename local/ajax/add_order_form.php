<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Data\Cache;

global $USER;
$cur_user_id = $USER->GetId();
CModule::IncludeModule("iblock");
$cache = Cache::createInstance();

$ID = !empty($_REQUEST['id']) ? $_REQUEST['id'] : 0;
if (/*$cache->initCache(3600, "FORM_DATA_KEY".$ID)*/
false
) { // проверяем кеш и задаём настройки
    $arR = $cache->getVars(); // достаем переменные из кеша
    $arResult = $arR;
} elseif ($cache->startDataCache()) {
    $arR = [];

    $arSelect = ["ID", "NAME", "PROPERTY_VIN", "PROPERTY_PROCENT", "PROPERTY_PAID_OFF"];
    $arFilter = [
        "IBLOCK_ID" => 32,
        "ACTIVE"    => "Y"
    ];
    $res = CIBlockElement::GetList(['NAME' => 'ASC'], $arFilter, false, [], $arSelect);

    while ($arRes = $res->Fetch()) {
        if($arRes['PROPERTY_PAID_OFF_VALUE']) $arRes['PROPERTY_PROCENT_VALUE'] = '';
        $arR['CARS'][] = $arRes;
    }

    $filter = Array("GROUPS_ID" => Array(8));
    $rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
    while ($arUser = $rsUsers->Fetch()) {
        $arR['HEADS'][] = ['NAME' => $arUser['LAST_NAME'] . ' ' . $arUser['NAME'], 'ID' => $arUser['ID']];
    }

    $cache->endDataCache($arR); // записываем в кеш
    $arResult = $arR;

    if ($ID) {

        $res = CIBlockElement::GetList(['NAME' => 'ASC'], ['IBLOCK_ID' => 33, 'ID' => $ID], false, [],
            ['ID', 'NAME','DATE_CREATE', 'PREVIEW_TEXT', 'PROPERTY_TYPE', 'PROPERTY_STATUS', 'PROPERTY_HEAD', 'PROPERTY_CLIENT', 'PROPERTY_CLIENT.NAME', 'PROPERTY_CLIENT.PROPERTY_PHONE', 'PROPERTY_SUMM', 'PROPERTY_CAR', 'PROPERTY_INVOICE',
             'PROPERTY_PURSHASE', 'PROPERTY_VIN', 'PROPERTY_BRAND', 'PROPERTY_MODEL', 'PROPERTY_S_CITY', 'PROPERTY_S_PHONE', 'PROPERTY_S_NAME', 'PROPERTY_PURSHASE_PAYED', 'PROPERTY_GOOD', 'PROPERTY_RETURN','PROPERTY_GOOD_PURSHASE']
        );
        $element = $res->Fetch();
       // pr($element, true);
    }

    if(!empty($_REQUEST['client_id'])){
        $arSelect = ["ID", "NAME", "PROPERTY_VIN", "PROPERTY_TS", "PROPERTY_PHONE",'CODE'];
        $arFilter = [
            "IBLOCK_ID" => 31,
            "ID" => $_REQUEST['client_id'],
            "ACTIVE"    => "Y"
        ];
        $res = CIBlockElement::GetList(['NAME' => 'ASC'], $arFilter, false, [], $arSelect);

        while ($arRes = $res->Fetch()) {
            $client = $arRes;
        }

        if(!empty($client)){
            $element['PROPERTY_CLIENT_NAME'] = $client['NAME'];
            $element['PROPERTY_CLIENT_PROPERTY_PHONE_VALUE'] = $client['PROPERTY_PHONE_VALUE'].' '.$client['PROPERTY_TS_VALUE'];
            $element['PROPERTY_CLIENT_VALUE'] = $client['ID'];
        }
    }


}
//pr($element['DATE_CREATE']);
?>
<form name="iblock_add" class="form-horizontal" id="addOrderForm">
    <? if ($ID > 0) {
        ?>
        <input type="hidden" name="id" value="<?=$element['ID']?>"/>
        <input type="hidden" name="name" value="<?=$element['NAME']?>"/>
        <input type="hidden" name="action" value="updateOrder"/>
        <?
    } else {
        ?><input type="hidden" name="action" value="addOrder"/><?
    } ?>
    <h2 class="text-center mb30"><?=!empty($element['ID']) ? "Редактирование заказа №{$element['ID']}" : 'Создать новый заказ'?></h2>
    <div class="form-group">
        <label class="col-sm-2 control-label">Клиент</label>
        <div class="col-sm-8 controls">
            <input type="hidden"  name="CLIENT" value="<?=!empty($element['PROPERTY_CLIENT_VALUE'])?$element['PROPERTY_CLIENT_VALUE']:''?>" id="clientAutocompleteVal">
            <div class="input-group">
                <input <?=!empty($element['PROPERTY_CLIENT_NAME'])?'readonly':''?> type="text" class="form-control _client_search_input" name="" value="<?=!empty($element['PROPERTY_CLIENT_NAME'])?$element['PROPERTY_CLIENT_NAME'].' '.$element['PROPERTY_CLIENT_PROPERTY_PHONE_VALUE']:''?>" id="clientAutocomplete" >
                <div class="input-group-addon <?=(!empty($ID) && !$USER->isAdmin())?'':'_client_search_button'?>" >
                    <i class="fa fa-search" aria-hidden="true" <?=(!empty($ID) && !$USER->isAdmin())?'style="display:none"':''?>></i>
                </div>
            </div>
        </div>

        <div class="col-sm-2 controls pl0">
            <a class="btn btn-default" <?=(!empty($ID) && !$USER->isAdmin())?'style="display:none"':''?> data-target="#client-target" data-client="0" data-toggle="modal" href="#client-target"><i class="fa fa-plus" aria-hidden="true"></i> новый</a></div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Тип заказа</label>
        <div class="col-sm-8 controls">
            <select name="TYPE" class="form-control" required onchange="typeChange()" id="type_select">
                <option value="">Выберите тип заказа</option>
                <option <?=$element['PROPERTY_TYPE_ENUM_ID'] == 74 ? 'selected' : ''?> value="74">Склад</option>
                <option <?=$element['PROPERTY_TYPE_ENUM_ID'] == 75 ? 'selected' : ''?> value="75">Поставка</option>
                <option <?=$element['PROPERTY_TYPE_ENUM_ID'] == 76 ? 'selected' : ''?> value="76">Перепродажа</option>
                <option <?=$element['PROPERTY_TYPE_ENUM_ID'] == 77 ? 'selected' : ''?> value="77">Инструмент</option>
                <option <?=$element['PROPERTY_TYPE_ENUM_ID'] == 78 ? 'selected' : ''?> value="78">Шины/Диски</option>
            </select>
        </div>
    </div>

    <div class="dinamic-fields">
        <div class="form-group _show-74">
            <label class="col-sm-2 control-label">Авто с разбора</label>
            <div class="col-sm-8 controls">
                <select name="CAR" class="form-control" id="car_select">
                    <option value="">Выберите автомобиль</option>
                    <? foreach ($arResult['CARS'] as $car) {
                        ?>
                        <option <?=$element['PROPERTY_CAR_VALUE'] == $car['ID'] ? 'selected' : ''?> value="<?=$car['ID']?>" data-vin="<?=$car['PROPERTY_VIN_VALUE']?>" data-procent="<?=$car['PROPERTY_PROCENT_VALUE']?>"><?=$car['NAME']?></option>
                        <?
                    } ?>
                </select>
            </div>
        </div>

        <div class="form-group _show-75">
            <label class="col-sm-2 control-label">Номер расходной накладной</label>
            <div class="col-sm-5 controls">
                <input type="text" class="form-control" name="INVOICE" value="<?=!empty($element['PROPERTY_INVOICE_VALUE'])?$element['PROPERTY_INVOICE_VALUE']:''?>">
            </div>
        </div>


        <div class="form-group _show-76">
            <label class="col-sm-2 control-label">VIN</label>
            <div class="col-sm-8 controls">
                <input type="text" class="form-control vin-mask" name="VIN" value="<?=!empty($element['PROPERTY_VIN_VALUE'])?$element['PROPERTY_VIN_VALUE']:''?>">
            </div>
        </div>
        <div class="form-group _show-76">
            <label class="col-sm-2 control-label">Марка</label>
            <div class="col-sm-8 controls">
                <input type="text" class="form-control" name="BRAND" value="<?=!empty($element['PROPERTY_BRAND_VALUE'])?$element['PROPERTY_BRAND_VALUE']:''?>">
            </div>
        </div>
        <div class="form-group _show-76">
            <label class="col-sm-2 control-label">Модель</label>
            <div class="col-sm-8 controls">
                <input type="text" class="form-control" name="MODEL" value="<?=!empty($element['PROPERTY_MODEL_VALUE'])?$element['PROPERTY_MODEL_VALUE']:''?>">
            </div>
        </div>
        <div class="form-group _show-76">
            <label class="col-sm-2 control-label">Город поставщика</label>
            <div class="col-sm-8 controls">
                <input type="text" class="form-control" name="S_CITY" value="<?=!empty($element['PROPERTY_S_CITY_VALUE'])?$element['PROPERTY_S_CITY_VALUE']:''?>">
            </div>
        </div>
        <div class="form-group _show-76">
            <label class="col-sm-2 control-label">Телефон поставщика</label>
            <div class="col-sm-8 controls">
                <input type="text" class="form-control phone-mask" name="S_PHONE" value="<?=!empty($element['PROPERTY_S_PHONE_VALUE'])?$element['PROPERTY_S_PHONE_VALUE']:''?>">
            </div>
        </div>
        <div class="form-group _show-76">
            <label class="col-sm-2 control-label">Имя поставщика</label>
            <div class="col-sm-8 controls">
                <input type="text" class="form-control" name="S_NAME" value="<?=!empty($element['PROPERTY_S_NAME_VALUE'])?$element['PROPERTY_S_NAME_VALUE']:''?>">
            </div>
        </div>
    </div>


    <div class="form-group" <?=(!$USER->isAdmin())?'style="display:none"':''?>>
        <label class="col-sm-2 control-label">Ответственный</label>
        <div class="col-sm-8 controls">
            <select name="HEAD" class="form-control">
                <option value="">Выберите ответственного</option>
                <? foreach ($arResult['HEADS'] as $head) {
                    ?>
                    <option <?=$element['PROPERTY_HEAD_VALUE'] == $head['ID'] ? 'selected' : ''?> value="<?=$head['ID']?>" <?=$element['PROPERTY_HEAD_VALUE'] == $head['ID'] ? 'selected'
                        : ((empty($ID) && $cur_user_id == $head['ID']) ? 'selected' : '')?>><?=$head['NAME']?></option>
                    <?
                } ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Статус заказа</label>
        <div class="col-sm-8 controls">
            <select name="STATUS" class="form-control">
                <option <?=$element['PROPERTY_STATUS_ENUM_ID'] == 81 ? 'selected' : ''?> value="81">принят</option>
                <option <?=$element['PROPERTY_STATUS_ENUM_ID'] == 82 ? 'selected' : ''?> value="82">оплачен</option>
                <option <?=$element['PROPERTY_STATUS_ENUM_ID'] == 83 ? 'selected' : ''?> value="83">выполнен</option>
                <option <?=$element['PROPERTY_STATUS_ENUM_ID'] == 84 ? 'selected' : ''?> value="84">возврат</option>
            </select>
        </div>
    </div>
    <div class="_goods">
        <? $i = 0;
        if (!empty($element['PROPERTY_GOOD_VALUE'])){
            foreach ($element['PROPERTY_GOOD_VALUE'] as $k => $good): $i++; ?>
                <? if ($i == 1): ?>
                    <?
                    if(strpos($element['PROPERTY_GOOD_DESCRIPTION'][$k],'#')){
                        $prArr = explode('#',$element['PROPERTY_GOOD_DESCRIPTION'][$k]);
                        $count = $prArr[0];
                        $price = $prArr[1];
                    }
                    else{
                        $count = 1;
                        $price = $element['PROPERTY_GOOD_DESCRIPTION'][$k];

                    }
                    $pur = $element['PROPERTY_GOOD_PURSHASE_VALUE'][$k];
                    ?>
                    <div class="form-group good-item">
                        <label class="col-sm-2 control-label">Товары <?=$pur?></label>
                        <div class="col-sm-<?=IS_SUPERMAN?"4":"5"?> controls">
                            <label class="meta small-head">Наименование товара</label>
                            <input type="text" class="form-control" name="GOOD[]" value="<?=$good?>" required placeholder="Наименование товара">
                        </div>
                        <div class="col-sm-1 controls pl0">
                            <label class="meta small-head">Кол-во</label>
                            <input type="text" class="form-control numeric" data-min="1" required name="GOOD_COUNT[]" value="<?=$count?>" placeholder="Кол-во">
                        </div>
                        <div class="col-sm-1 controls pl0" <?=IS_SUPERMAN?"":"style='display:none'"?>>
                            <label class="meta small-head">Закупка</label>
                            <input type="text" class="form-control numeric" name="GOOD_PURSHASE[]" <?=!$USER->isAdmin()?'readonly':''?>value="<?=$pur?>" placeholder="Зак.">
                        </div>
                        <div class="col-sm-2 controls pl0">
                            <div class="input-group">
                                <label class="meta small-head">Цена</label>
                                <input type="text" class="form-control numeric" required name="GOOD_DESCRIPTION[]" value="<?=$price ?>" placeholder="Цена">
                                <div class="input-group-addon">р.</div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="_return label label-danger"  title="Частичный возврат"><i class="fa fa-undo" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)" class="_return-plus label label-success" title="Отменить возврат"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                <? else: ?>
                    <?
                    if(strpos($element['PROPERTY_GOOD_DESCRIPTION'][$k],'#')){
                        $prArr = explode('#',$element['PROPERTY_GOOD_DESCRIPTION'][$k]);
                        $count = $prArr[0];
                        $price = $prArr[1];
                    }
                    else{
                        $count = 1;
                        $price = $element['PROPERTY_GOOD_DESCRIPTION'][$k];
                    }
                    $pur = $element['PROPERTY_GOOD_PURSHASE_VALUE'][$k];
                    ?>
                    <div class="form-group good-item">
                        <div class="col-sm-offset-2 col-sm-<?=IS_SUPERMAN?"4":"5"?> controls"><input type="text" class="form-control" name="GOOD[]" value="<?=$good?>" placeholder="Наименование товара"></div>
                        <div class="col-sm-1 controls pl0">
                            <label class="meta small-head">Кол-во</label>
                            <input type="text" class="form-control numeric" data-min="1" required name="GOOD_COUNT[]" value="<?=$count?>" placeholder="Кол-во">
                        </div>
                        <div class="col-sm-1 controls pl0" <?=IS_SUPERMAN?"":"style='display:none'"?>>
                            <label class="meta small-head">Закупка</label>
                            <input type="text" class="form-control numeric" name="GOOD_PURSHASE[]" <?=!$USER->isAdmin()?'readonly':''?> value="<?=$pur?>" placeholder="Зак.">
                        </div>
                        <div class="col-sm-2 controls pl0">
                            <div class="input-group"><input type="text" class="form-control numeric" name="GOOD_DESCRIPTION[]" value="<?=$price ?>" placeholder="Цена">
                                <div class="input-group-addon">р.</div>
                            </div>
                        </div>
                        <div class="col-sm-2 controls pl0">
                            <a class="btn btn-default _remove-good" data-btn-ok-label="Удалить" data-title="Удалить товар?" data-btn-cancel-label="Отмена" data-btn-ok-class="btn-success btn-sm" data-btn-cancel-class="btn-danger btn-sm" data-original-title="" title=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                        <a href="javascript:void(0)" class="_return label label-danger" title="Частичный возврат"><i class="fa fa-undo" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)" class="_return-plus label label-success" title="Отменить возврат"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                <? endif ?>
            <? endforeach;
        }
        else{
            ?>
            <div class="form-group good-item">
                <label class="col-sm-2 control-label">Товары</label>
                <div class="col-sm-<?=IS_SUPERMAN?"4":"5"?> controls">
                    <label class="meta small-head">Наименование товара</label>
                    <input type="text" class="form-control" name="GOOD[]" value="" required placeholder="Наименование товара">
                </div>
                <div class="col-sm-1 controls pl0">
                    <label class="meta small-head">Кол-во</label>
                    <input type="text" class="form-control numeric" data-min="1" required name="GOOD_COUNT[]" value="1" placeholder="Кол-во">
                </div>
                <div class="col-sm-1 controls pl0" <?=IS_SUPERMAN?"":"style='display:none'"?>>
                    <label class="meta small-head">Закупка</label>
                    <input type="text" class="form-control numeric" name="GOOD_PURSHASE[]" <?=!$USER->isAdmin()?'readonly':''?> value="" placeholder="Зак.">
                </div>
                <div class="col-sm-2 controls pl0">
                    <div class="input-group">
                        <label class="meta small-head">Цена</label>
                        <input type="text" class="form-control numeric" required name="GOOD_DESCRIPTION[]" value="" placeholder="Цена">
                        <div class="input-group-addon">р.</div>
                    </div>
                </div>
            </div>
            <?
        }

        if (!empty($element['PROPERTY_RETURN_VALUE'])){
            foreach ($element['PROPERTY_RETURN_VALUE'] as $k => $good): $i++; ?>
                    <?
                    if(strpos($element['PROPERTY_RETURN_DESCRIPTION'][$k],'#')){
                        $prArr = explode('#',$element['PROPERTY_RETURN_DESCRIPTION'][$k]);
                        $count = $prArr[0];
                        $price = $prArr[1];
                    }
                    else{
                        $count = 1;
                        $price = $element['PROPERTY_RETURN_DESCRIPTION'][$k];

                    }
                $pur = $element['PROPERTY_GOOD_PURSHASE_VALUE'][$k];
                    ?>
                    <div class="form-group good-item return-item">
                        <div class="col-sm-offset-2 col-sm-<?=IS_SUPERMAN?"4":"5"?> controls"><input type="text" class="form-control" name="RETURN[]" value="<?=$good?>" placeholder="Наименование товара" readonly></div>
                        <div class="col-sm-1 controls pl0">
                            <label class="meta small-head">Кол-во</label>
                            <input type="text" class="form-control numeric" data-min="1" required name="RETURN_COUNT[]" value="<?=$count?>" placeholder="Кол-во" readonly>
                        </div>
                        <div class="col-sm-1 controls pl0" <?=IS_SUPERMAN?"":"style='display:none'"?>>
                            <label class="meta small-head">Закупка</label>
                            <input type="text" class="form-control numeric"  name="GOOD_PURSHASE[]" <?=!$USER->isAdmin()?'readonly':''?> value="<?=$pur?>" placeholder="Закупка">
                        </div>
                        <div class="col-sm-2 controls pl0">
                            <div class="input-group"><input type="text" class="form-control numeric" name="RETURN_DESCRIPTION[]" value="<?=$price ?>" placeholder="Цена" readonly>
                                <div class="input-group-addon">р.</div>
                            </div>
                        </div>
                        <div class="col-sm-2 controls pl0">
                            <a class="btn btn-default _remove-good" data-btn-ok-label="Удалить" data-title="Удалить товар?" data-btn-cancel-label="Отмена" data-btn-ok-class="btn-success btn-sm" data-btn-cancel-class="btn-danger btn-sm" data-original-title="" title=""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                        <a href="javascript:void(0)" class="_return label label-danger" title="Частичный возврат"><i class="fa fa-undo" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)" class="_return-plus label label-success" title="Отменить возврат"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
            <? endforeach;
        }
         ?>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8 text-right">
            <a class="btn btn-default btn-xs" onclick="addGoodRow()"><i class="fa fa-plus" aria-hidden="true"></i> Добавть товар</a>
        </div>
    </div>
<?/*?><div class="dinamic-fields"><?*/?>

    <div class="form-group<?/*?> _show-75 _show-76 _show-77 _show-78<?*/?>" <?=IS_SUPERMAN?'':'style="display:none"'?>>
        <label class="col-sm-2 control-label">Сумма закупки</label>
        <div class="col-sm-5 controls">
            <div class="input-group">
                <input type="text" class="form-control numeric" name="PURSHASE" value="<?=!empty($element['PROPERTY_PURSHASE_VALUE'])?$element['PROPERTY_PURSHASE_VALUE']:''?>" <?/*if(!$ID || $element['DATE_CREATE'] > '06.05.2019'):?>readonly<?endif*/?>>
                <div class="input-group-addon">р.</div>
            </div>
        </div>

           <?/*?> <div class="col-sm-3 controls pl0">
                <div class="checkbox">
                    <label> <input type="checkbox" value="79" <?=!empty($element['PROPERTY_PURSHASE_PAYED_VALUE'])?'checked':''?> name="PURSHASE_PAYED"> Закупка оплачена</label>
                </div>
            </div><?*/?>

    </div>
<?/*?></div><?*/?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Сумма</label>
        <div class="col-sm-5 controls">
            <div class="input-group">
                <input type="text" class="form-control" name="SUMM" value="<?=$element['PROPERTY_SUMM_VALUE']?>" readonly>
                <div class="input-group-addon">р.</div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Комментарий</label>
        <div class="col-sm-8 controls">
            <textarea class="form-control" cols="30" rows="4" name="PREVIEW_TEXT"><?=$element['PREVIEW_TEXT']?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <input class="btn btn-default" type="submit" name="iblock_submit" value="Сохранить">
            <input class="btn btn-default" type="button" name="iblock_cancel" value="Отмена" onclick="$('#addformToggle').trigger('click'); return false;">
        </div>
    </div>
</form>

<script>
    function typeChange() {
        var type = $('#type_select').val();
        $('.dinamic-fields > div').hide();
        if (type) {
            $('._show-' + type).show();
        }
    }

    function calcPur() {
        var pur = 0;
        $('[name="GOOD_PURSHASE[]"]').each(function () {

            pur += (parseFloat($(this).val()?$(this).val():0) * parseInt($(this).closest('.form-group').find('[name="GOOD_COUNT[]"]').val()));

        });

        $('[name="PURSHASE"]').val(pur);

    }
    function calcSumm() {
        var sum = 0;
        $('[name="GOOD_DESCRIPTION[]"]').each(function () {
            sum += (parseFloat($(this).val()) * parseInt($(this).closest('.form-group').find('[name="GOOD_COUNT[]"]').val()));
        });
        $('[name="SUMM"]').val(sum);


    }



    function addGoodRow() {

        var row = '<div class="form-group good-item">\
            <div class="col-sm-offset-2 col-sm-<?=IS_SUPERMAN?"4":"5"?> controls">\
            <input type="text" class="form-control" name="GOOD[]" placeholder="Наименование товара">\
            </div>\
            <div class="col-sm-1 controls pl0">\
            <input type="text" class="form-control numeric" required name="GOOD_COUNT[]" data-min="1" value="1" placeholder="Кол-во">\
            </div>\
            <div class="col-sm-1 controls pl0" <?=IS_SUPERMAN?"":"style='display:none'"?>>\
                    <label class="meta small-head">Закупка</label>\
                    <input type="text" class="form-control numeric" name="GOOD_PURSHASE[]"   value="" placeholder="Зак.">\
                    </div>\
                    <div class="col-sm-2 controls pl0">\
                    <div class="input-group">\
                    <input type="text" class="form-control numeric" name="GOOD_DESCRIPTION[]" placeholder="Цена">\
                    <div class="input-group-addon">р.</div>\
                    </div>\
                    </div>\
                    <div class="col-sm-2 controls pl0"><a class="btn btn-default _remove-good" data-btn-ok-label="Удалить" data-title="Удалить товар?" data-btn-cancel-label="Отмена" data-btn-ok-class="btn-success btn-sm" data-btn-cancel-class="btn-danger btn-sm" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> </div>\
                    <a href="javascript:void(0)" class="_return label label-danger" title="Частичный возврат"><i class="fa fa-undo" aria-hidden="true"></i></a>\
                    <a href="javascript:void(0)" class="_return-plus label label-success" title="Отменить возврат"><i class="fa fa-plus" aria-hidden="true"></i></a>\
                    </div>';

                $('._goods').append(row);

                setInputValidator();

                $('._remove-good').confirmation({
                    rootSelector: '._remove-good'
                });
            }


            $(document).on('click', '._remove-good', function () {
                $(this).closest('.form-group').remove();
                calcSumm();
                calcPur();

            });
            $(document).on('click', '._return', function () {

                var _par = $(this).closest('.form-group');

                _par.find('[name="GOOD[]"]').attr('name','RETURN[]').prop('readonly', true);
                _par.find('[name="GOOD_COUNT[]"]').attr('name','RETURN_COUNT[]').prop('readonly', true);
                _par.find('[name="GOOD_DESCRIPTION[]"]').attr('name','RETURN_DESCRIPTION[]').prop('readonly', true);
                _par.addClass('return-item');
                calcSumm();
                calcPur();

            });
            $(document).on('click', '._return-plus', function () {

                var _par = $(this).closest('.form-group');

                _par.find('[name="RETURN[]"]').attr('name','GOOD[]').removeAttr('readonly');
                _par.find('[name="RETURN_COUNT[]"]').attr('name','GOOD_COUNT[]').removeAttr('readonly');
                _par.find('[name="RETURN_DESCRIPTION[]"]').attr('name','GOOD_DESCRIPTION[]').removeAttr('readonly');
                _par.removeClass('return-item');
                calcSumm();
                calcPur();

            });
            $(function () {

                $('._client_search_button').on('click',function () {
                    $('._client_search_input').val('').attr('readonly',false).focus();
                    $('#clientAutocompleteVal').val('');

                });

                $('#client-target').on('shown.bs.modal', function (event) {

                    $('#formContent').load('/local/ajax/client_edit.php?redirect_to_order=Y');
                });


               $( "#clientAutocomplete" ).autocomplete({
                    source: function(request, response){
                        $.ajax({
                            url: "/local/ajax/get_data_autocomplete.php",
                            method:'post',
                            dataType: "json",
                            data:{
                                action: "getClients",
                                term: request.term
                            },
                            // обработка успешного выполнения запроса
                            success: function(data){
                                response(data);
                            }
                        });
                    },
                    minLength: 2,
                   select: function (event, ui) {
                        $('#clientAutocompleteVal').val(ui.item.id);
                        $('._client_search_input').attr('readonly',true);
                   }
                });

                $(document).on('change', '[name="GOOD_DESCRIPTION[]"],[name="GOOD_COUNT[]"]', function () {
                    calcSumm();

                    if($('#type_select').val() == 74 && $('#car_select option:selected').data('procent')){
                        var gi = $(this).closest('.good-item');
                        gi.find('[name="GOOD_PURSHASE[]"]').val(parseFloat(gi.find('[name="GOOD_DESCRIPTION[]"]').val())  / 100 * parseInt($('#car_select option:selected').data('procent')));
                        calcPur();
                    }
                });

                $(document).on('change', '[name="GOOD_PURSHASE[]"],[name="GOOD_COUNT[]"]', function () {
                       calcPur();
                });

        $('#addOrderForm').on('submit', function (e) {
            e.preventDefault();
            var _this = $(this);

            var data = _this.serialize();
            if(parseFloat($('[name="PURSHASE"]').val()?$('[name="PURSHASE"]').val():0) <= parseFloat($('[name="SUMM"]').val()?$('[name="SUMM"]').val():0)){
                $.post('/local/ajax/order_actions.php', data, function (data) {
                    if (data.success) {
                        pushNotifications('success', 'Заказ номер ' + data.success + ' успешно сохранён');
                        $('#orderForm').hide(200);
                        //reloadList();
                        //document.location.reload();
                        setFilter($('.orders-list').data('page'));
                    }
                    if (data.error) {
                        pushNotifications('danger', 'Ошибка: ' + data.error);
                    }

                }, 'json');
            }
            else{
                pushNotifications('danger', 'Ошибка: сумма закупки больше суммы товаров');
            }



        })
    })

</script>
<div id="client-target" tabindex="-1" role="dialog" aria-labelledby="map" aria-hidden="true" class=" modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="formContent">
        </div>
    </div>
</div>