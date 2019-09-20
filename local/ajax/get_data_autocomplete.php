<?
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
    CModule::IncludeModule("iblock");
    switch ($_REQUEST['action']) {
        case 'getClients':
            $term = $_REQUEST['term'];
            $arSelect = ["ID", "NAME", "PROPERTY_VIN", "PROPERTY_TS", "PROPERTY_PHONE", 'CODE'];
            $arFilter = [
                "IBLOCK_ID" => 31,
                "ACTIVE"    => "Y",
                array(
                    "LOGIC" => "OR",
                    ['NAME' => "%".$term."%"],
                    ['CODE' => "%".$term."%"],
                    ['PROPERTY_TS' => "%".$term."%"],
                )


            ];

         //   pr($arFilter);
          //  pr($_REQUEST['term']);

            $res = CIBlockElement::GetList(['NAME' => 'ASC'], $arFilter, false, [], $arSelect);
            $availableClients = [];
            while ($arRes = $res->Fetch()) {
                $availableClients[] = ['id'=>$arRes['ID'],'value'=>$arRes['NAME'].', '.$arRes['PROPERTY_PHONE_VALUE'].($arRes['PROPERTY_TS_VALUE'] ? ', ' . $arRes['PROPERTY_TS_VALUE'] : '')];

            }
            die(json_encode($availableClients));
        break;
    }
endif;
