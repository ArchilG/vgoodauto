<?php
$filter = Array("GROUPS_ID" => Array(8));
$rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
while ($arUser = $rsUsers->Fetch()) {
    $heads[$arUser['ID']] = $arUser['LAST_NAME'] . ' ' . $arUser['NAME'];
}

foreach ($arResult["ELEMENTS"] as $k => $value){
    $db_props = CIBlockElement::GetProperty(32, $value['ID'], "sort", "asc", array());
    while($ar_props = $db_props->Fetch()) {
        $arResult["ELEMENTS"][$k]['PROPERTIES'][$ar_props['CODE']] = $ar_props;
    }

    if(!empty($arResult["ELEMENTS"][$k]['PROPERTIES']['DEFECT']['VALUE'])){
        $db_props = CIBlockElement::GetProperty(32, $value['ID'], "sort", "asc", array('CODE' => 'DEFECT'));
        $arResult["ELEMENTS"][$k]['PROPERTIES']['DEFECT']['VALUE'] = [];
        while($ar_props = $db_props->Fetch()) {
            $arResult["ELEMENTS"][$k]['PROPERTIES']['DEFECT']['VALUE'][] = $ar_props['VALUE'];
        }
    }

    $arSelect = Array("ID","PROPERTY_GOOD",'PROPERTY_HEAD','PROPERTY_STATUS',"DATE_CREATE");
    $arFilter = Array("IBLOCK_ID"=>33, "PROPERTY_TYPE"=>74,"PROPERTY_CAR"=>$value['ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, [], $arSelect);
    $summ = 0;
    if($res->SelectedRowsCount()){
        while($arr = $res->Fetch())
        {
            if($arr['PROPERTY_STATUS_ENUM_ID'] == 84) continue;
            if($arr['PROPERTY_STATUS_ENUM_ID'] == 81) continue;
           foreach ($arr['PROPERTY_GOOD_VALUE'] as $k_g => $item){
               if(strpos($arr['PROPERTY_GOOD_DESCRIPTION'][$k_g],'#')){
                   $prArr = explode('#',$arr['PROPERTY_GOOD_DESCRIPTION'][$k_g]);
                   $count = $prArr[0];
                   $price = $prArr[1];
               }
               else{
                   $count = 1;
                   $price = $arr['PROPERTY_GOOD_DESCRIPTION'][$k_g];
               }

               $summ += ($price*$count);
               $date_create = substr($arr['DATE_CREATE'],0,-3);
               $arResult["ELEMENTS"][$k]['SOLD_GOODS'][] = "{$item} - {$count}x{$price} руб. <small>(Заказ {$arr['ID']} от {$date_create}, отв. {$heads[$arr['PROPERTY_HEAD_VALUE']]})</small>";
           }
        }

    }
    $arResult["ELEMENTS"][$k]['SOLD_SUMM'] = CCurrencyLang::CurrencyFormat($summ, 'RUB', true);

}
//pr($arResult["ELEMENTS"]);