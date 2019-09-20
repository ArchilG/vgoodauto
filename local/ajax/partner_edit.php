<?
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
    "vg:iblock.element.add.form",
    "partner",
    Array(
        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
        "CUSTOM_TITLE_DETAIL_PICTURE" => "",
        "CUSTOM_TITLE_DETAIL_TEXT" => "",
        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
        "CUSTOM_TITLE_NAME" => "ФИО",
        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
        "CUSTOM_TITLE_PREVIEW_TEXT" => "",
        "CUSTOM_TITLE_TAGS" => "",
        "DEFAULT_INPUT_SIZE" => "30",
        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
        "ELEMENT_ASSOC" => "CREATED_BY",
        "GROUPS" => array("8"),
        "IBLOCK_ID" => "35",
        "IBLOCK_TYPE" => "crm",
        "LEVEL_LAST" => "Y",
        "LIST_URL" => "/personal/partners/",
        "MAX_FILE_SIZE" => "0",
        "MAX_LEVELS" => "100000",
        "MAX_USER_ENTRIES" => "100000",
        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
        "PROPERTY_CODES" => !empty($_REQUEST['CODE']) && $_REQUEST['CODE'] > 0 ? array("236", "238", "NAME", "PREVIEW_TEXT") :array("236","238","237", "NAME", "PREVIEW_TEXT"),
        "PROPERTY_CODES_REQUIRED" => !empty($_REQUEST['CODE']) && $_REQUEST['CODE'] > 0 ? array("NAME") :array("237","NAME"),
        "RESIZE_IMAGES" => "N",
        "SEF_MODE" => "N",
        "STATUS" => "ANY",
        "STATUS_NEW" => "N",
        "USER_MESSAGE_ADD" => "Добавлено",
        "USER_MESSAGE_EDIT" => "Данные сохранены",
        "CUSTOM_TITLE_PREVIEW_TEXT" => "Комментарий",
        "USE_CAPTCHA" => "N",
        "AJAX_MODE" => "Y",  // режим AJAX
        "AJAX_OPTION_SHADOW" => "Y", // затемнять область
        "AJAX_OPTION_JUMP" => "Y", // скроллить страницу до компонента
        "AJAX_OPTION_STYLE" => "Y", // подключать стили
        "AJAX_OPTION_HISTORY" => "Y",
    )
);

?>
