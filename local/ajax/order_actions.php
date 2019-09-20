<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
    CModule::IncludeModule("iblock");
    $ELEMENT_ID = $_REQUEST['id'];

    switch ($_REQUEST['action']){
        case 'addOrder':
            if(CIBlock::GetPermission(33)>='W')
            {
                $el = new CIBlockElement;


                $PROP = [];
                $PROP['TYPE'] = $_REQUEST['TYPE'];
                $PROP['STATUS'] = $_REQUEST['STATUS'];
                $PROP['HEAD'] = $_REQUEST['HEAD'];
                $PROP['CLIENT'] = $_REQUEST['CLIENT'];
                $PROP['SUMM'] = $_REQUEST['SUMM'];
                $PROP['CAR'] = $_REQUEST['CAR'];
                $PROP['INVOICE'] = $_REQUEST['INVOICE'];
                $PROP['PURSHASE'] = $_REQUEST['PURSHASE'];
                $PROP['VIN'] = $_REQUEST['VIN'];
                $PROP['BRAND'] = $_REQUEST['BRAND'];
                $PROP['MODEL'] = $_REQUEST['MODEL'];
                $PROP['S_CITY'] = $_REQUEST['S_CITY'];
                $PROP['S_PHONE'] = $_REQUEST['S_PHONE'];
                $PROP['S_NAME'] = $_REQUEST['S_NAME'];
                $PROP['PURSHASE_PAYED'] = $_REQUEST['PURSHASE_PAYED'];
                $PROP['GOOD_PURSHASE'] = $_REQUEST['GOOD_PURSHASE'];

                switch ($PROP['TYPE']){
                    //CAR, INVOICE, PURSHASE, VIN, BRAND, MODEL, S_CITY, S_PHONE, S_NAME
                    case '74': //Собственный склад
                        unset($PROP['INVOICE'],$PROP['VIN'],$PROP['BRAND'],$PROP['MODEL'],$PROP['S_CITY'],$PROP['S_PHONE'],$PROP['S_NAME']);
                    break;
                    case '75': //Товар от партнёра
                        unset($PROP['CAR'],$PROP['VIN'],$PROP['BRAND'],$PROP['MODEL'],$PROP['S_CITY'],$PROP['S_PHONE'],$PROP['S_NAME']);
                    break;
                    case '76': //Перепродажа БУ, кроме EuroAuto
                        unset($PROP['CAR'],$PROP['INVOICE']);
                    break;
                    case '77': //Инструмент
                        unset($PROP['INVOICE'],$PROP['CAR'],$PROP['VIN'],$PROP['BRAND'],$PROP['MODEL'],$PROP['S_CITY'],$PROP['S_PHONE'],$PROP['S_NAME']);
                    break;
                    case '78': //Шины/Диски
                        unset($PROP['INVOICE'],$PROP['CAR'],$PROP['VIN'],$PROP['BRAND'],$PROP['MODEL'],$PROP['S_CITY'],$PROP['S_PHONE'],$PROP['S_NAME']);
                    break;

                }

                foreach ($_REQUEST['GOOD'] as $k => $good){
                    $PROP['GOOD'][] = ['VALUE' => $good, 'DESCRIPTION' => $_REQUEST['GOOD_COUNT'][$k].'#'.$_REQUEST['GOOD_DESCRIPTION'][$k]];
                }

                $arLoadArray = Array(
                    "IBLOCK_ID"      => 33,
                    "PROPERTY_VALUES"=> $PROP,
                    "NAME"           => "Заказ от ".date("d.m.Y H:i"),
                    "ACTIVE"         => "Y",            // активен
                    "PREVIEW_TEXT"   => $_REQUEST['PREVIEW_TEXT'],
                );


                if($ID = $el->Add($arLoadArray))
                    $return = ['success'=>$ID];
                else
                    $return = ['error'=>$el->LAST_ERROR];

                die(json_encode($return));
            }
        break;

        case 'updateOrder':
            if(CIBlock::GetPermission(33)>='W' && !empty($_REQUEST['id']))
            {
                global $USER;
                $el = new CIBlockElement;


                $PROP = [];
                $PROP['TYPE'] = $_REQUEST['TYPE'];
                $PROP['STATUS'] = $_REQUEST['STATUS'];
                $PROP['HEAD'] = $_REQUEST['HEAD'];
                $PROP['CLIENT'] = $_REQUEST['CLIENT'];
                $PROP['SUMM'] = $_REQUEST['SUMM'];
                $PROP['CAR'] = $_REQUEST['CAR'];
                $PROP['INVOICE'] = $_REQUEST['INVOICE'];
                $PROP['PURSHASE'] = $_REQUEST['PURSHASE'];
                $PROP['VIN'] = $_REQUEST['VIN'];
                $PROP['BRAND'] = $_REQUEST['BRAND'];
                $PROP['MODEL'] = $_REQUEST['MODEL'];
                $PROP['S_CITY'] = $_REQUEST['S_CITY'];
                $PROP['S_PHONE'] = $_REQUEST['S_PHONE'];
                $PROP['S_NAME'] = $_REQUEST['S_NAME'];
                $PROP['PURSHASE_PAYED'] = $_REQUEST['PURSHASE_PAYED'];
                $PROP['GOOD_PURSHASE'] = $_REQUEST['GOOD_PURSHASE'];

                switch ($PROP['TYPE']){
                    //CAR, INVOICE, PURSHASE, VIN, BRAND, MODEL, S_CITY, S_PHONE, S_NAME
                    case '74': //Собственный склад
                        unset($PROP['INVOICE'],$PROP['VIN'],$PROP['BRAND'],$PROP['MODEL'],$PROP['S_CITY'],$PROP['S_PHONE'],$PROP['S_NAME']);
                        break;
                    case '75': //Товар от партнёра
                        unset($PROP['CAR'],$PROP['VIN'],$PROP['BRAND'],$PROP['MODEL'],$PROP['S_CITY'],$PROP['S_PHONE'],$PROP['S_NAME']);
                        break;
                    case '76': //Перепродажа БУ, кроме EuroAuto
                        unset($PROP['CAR'],$PROP['INVOICE']);
                        break;
                    case '77': //Инструмент
                        unset($PROP['INVOICE'],$PROP['CAR'],$PROP['VIN'],$PROP['BRAND'],$PROP['MODEL'],$PROP['S_CITY'],$PROP['S_PHONE'],$PROP['S_NAME']);
                        break;
                    case '78': //Шины/Диски
                        unset($PROP['INVOICE'],$PROP['CAR'],$PROP['VIN'],$PROP['BRAND'],$PROP['MODEL'],$PROP['S_CITY'],$PROP['S_PHONE'],$PROP['S_NAME']);
                        break;

                }

                foreach ($_REQUEST['GOOD'] as $k => $good){
                    $PROP['GOOD'][] = ['VALUE' => $good, 'DESCRIPTION' => $_REQUEST['GOOD_COUNT'][$k].'#'.$_REQUEST['GOOD_DESCRIPTION'][$k]];
                }
                if(!empty($_REQUEST['RETURN'])){
                    foreach ($_REQUEST['RETURN'] as $k => $good){
                        $PROP['RETURN'][] = ['VALUE' => $good, 'DESCRIPTION' => $_REQUEST['RETURN_COUNT'][$k].'#'.$_REQUEST['RETURN_DESCRIPTION'][$k]];
                    }
                }

                $arLoadArray = Array(
                    "ID"      => $_REQUEST['id'],
                    "MODIFIED_BY"    => $USER->GetID(),
                    "PROPERTY_VALUES"=> $PROP,
                    "NAME"           => $_REQUEST['name'],
                    "ACTIVE"         => "Y",            // активен
                    "PREVIEW_TEXT"   => $_REQUEST['PREVIEW_TEXT'],
                );


                if($el->Update($_REQUEST['id'],$arLoadArray))
                    $return = ['success'=>$_REQUEST['id']];
                else
                    $return = ['error'=>$el->LAST_ERROR];

                die(json_encode($return));
            }
            break;
    }

endif;
?>