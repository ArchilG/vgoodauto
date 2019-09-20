<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнёры");
if(!empty($_REQUEST['term'])){
    $switchTerm = switcher($_REQUEST['term']);
    $fil = ["LOGIC" => "OR",
            'NAME' => ["%{$_REQUEST['term']}%","%{$switchTerm}%"],
            'CODE' => "%{$_REQUEST['term']}%",
            'PREVIEW_TEXT' => "%{$_REQUEST['term']}%",
            'PROPERTY_CITY' => "%{$_REQUEST['term']}%",
    ];

    $GLOBALS['partnerFilter'] = [
        $fil
    ];

    $GLOBALS['arrPager'] = ['term' => $_REQUEST['term'],'note' => $_REQUEST['note']];
}
?> <div class="top-bar row mb20">
        <form id="partner_filter_form">
        <div class="col-md-8 col-sm-12">
            <input type="text" class="form-control _partner_filter" name="filter" placeholder="Имя или телефон"  value="<?=!empty($_REQUEST['term'])?$_REQUEST['term']:''?>"/>
            <div class="checkbox">
                <label>
                    <input type="checkbox" class="_live"> Искать прямо во время ввода
                </label>

            </div>
        </div>
        <div class="col-md-2 col-sm-12">
            <button class="btn btn-default" type="submit" ><i class="fa fa-search" aria-hidden="true"></i></button>
            <button class="btn btn-default" onclick="<?=(!empty($_GET['term']))?'document.location.href=\'/personal/partners/\';':'reloadList();'?> return false;"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        </form>
        <div class="col-md-2 col-sm-12">
            <button class="btn btn-default" data-target="#partner-target" data-partner="0" data-toggle="modal" href="#partner-target"><i class="fa fa-plus" aria-hidden="true"></i> Новый партнёр</button>
        </div>
    </div>

 <div id="partnersList">
     <?$APPLICATION->IncludeComponent(
         "bitrix:news.list",
         "partners-accordion",
         Array(
             "ACTIVE_DATE_FORMAT" => "d.m.Y",
             "ADD_SECTIONS_CHAIN" => "N",
             "AJAX_MODE" => "Y",
             "AJAX_OPTION_ADDITIONAL" => "",
             "AJAX_OPTION_HISTORY" => "N",
             "AJAX_OPTION_JUMP" => "Y",
             "AJAX_OPTION_STYLE" => "Y",
             "CACHE_FILTER" => "N",
             "CACHE_GROUPS" => "Y",
             "CACHE_TIME" => "36000000",
             "CACHE_TYPE" => "N",
             "CHECK_DATES" => "Y",
             "DETAIL_URL" => "",
             "DISPLAY_BOTTOM_PAGER" => "Y",
             "DISPLAY_DATE" => "N",
             "DISPLAY_NAME" => "Y",
             "DISPLAY_PICTURE" => "Y",
             "DISPLAY_PREVIEW_TEXT" => "Y",
             "DISPLAY_TOP_PAGER" => "N",
             "FIELD_CODE" => array("DATE_CREATE","CREATED_USER_NAME","PREVIEW_TEXT"),
             "FILTER_NAME" => "partnerFilter",
             "HIDE_LINK_WHEN_NO_DETAIL" => "N",
             "IBLOCK_ID" => "35",
             "IBLOCK_TYPE" => "crm",
             "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
             "INCLUDE_SUBSECTIONS" => "Y",
             "MEDIA_PROPERTY" => "",
             "MESSAGE_404" => "",
             "NEWS_COUNT" => "20",
             "PAGER_BASE_LINK" => "",
             "PAGER_BASE_LINK_ENABLE" => "Y",
             "PAGER_DESC_NUMBERING" => "N",
             "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
             "PAGER_PARAMS_NAME" => "arrPager",
             "PAGER_SHOW_ALL" => "Y",
             "PAGER_SHOW_ALWAYS" => "N",
             "PAGER_TEMPLATE" => ".default",
             "PAGER_TITLE" => "Новости",
             "PARENT_SECTION" => "",
             "PARENT_SECTION_CODE" => "",
             "PREVIEW_TRUNCATE_LEN" => "",
             "PROPERTY_CODE" => array("PHONE","CITY"),
             "SEARCH_PAGE" => "/search/",
             "SET_BROWSER_TITLE" => "N",
             "SET_LAST_MODIFIED" => "N",
             "SET_META_DESCRIPTION" => "N",
             "SET_META_KEYWORDS" => "N",
             "SET_STATUS_404" => "N",
             "SET_TITLE" => "N",
             "SHOW_404" => "N",
             "SLIDER_PROPERTY" => "",
             "SORT_BY1" => "ID",
             "SORT_BY2" => "NAME",
             "SORT_ORDER1" => "DESC",
             "SORT_ORDER2" => "DESC",
             "STRICT_SECTION_CHECK" => "N",
             "TEMPLATE_THEME" => "blue",
             "USE_RATING" => "N",
             "USE_SHARE" => "N"
         )
     );?>
 </div>
    <div id="partner-target" tabindex="-1" role="dialog" aria-labelledby="map" aria-hidden="true" class=" modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="formContent">

            </div><!-- /.модал-контент -->
        </div><!-- /.модальное окно -->
    </div><!-- /.модальные -->
    <script>
        function setFilter() {
            $('#preloader').show();
            var data = {'term':$('._partner_filter').val()};
            $('#partnersList').load('/local/ajax/partner_list.php',data,function(){
                $('#preloader').hide();
                setPartnersListClick();
            });
        }

        $('#partner_filter_form').on('submit',function (e) {
            e.preventDefault();
            setFilter();
        });

        $('#partner-target').on('shown.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('partner');
            var data = {};
            if(id){
                data = {'CODE':id};
            }
            $('#formContent').load('/local/ajax/partner_edit.php',data);
        });
        $('._partner_filter').on('keyup',function (){
            if($('._partner_filter').val().length > 3){
                if($('._live').is(':checked')){
                    setFilter();
                }
            }
        });

        $('._live').on('change',function () {
            $('._partner_filter').trigger('keyup');
        })
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>