/**
 * Created by Archil on 17.11.2018.
 */
$(function () {
    setPartnersListClick();
});
function setPartnersListClick() {

}

function reloadList(){
    $('._partner_filter').val('');
    $('#preloader').show();
    $('#partnersList').load('/local/ajax/partner_list.php',null,function(){$('#preloader').hide(); setPartnersListClick();});
}