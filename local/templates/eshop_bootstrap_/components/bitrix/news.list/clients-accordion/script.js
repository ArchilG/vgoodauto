/**
 * Created by Archil on 17.11.2018.
 */
$(function () {
    setClientsListClick();
});
function setClientsListClick() {
    $('.client-item ._delete').confirmation({
        rootSelector: '.client-item ._delete',
        // other options
    });
    $('.client-item ._delete').on('click', function(e){
        e.stopPropagation();
        e.stopImmediatePropagation();
        var  id = $(this).data('client');
        /* $.ajax({
         url: '/local/ajax/client_remove.php',
         global: false,
         data: {id: id},
         cache: false,
         type: 'POST',
         dataType: 'json',
         processData: false,
         contentType: false,
         success: function (data) {
         if (data.success) {
         $('._client_'+id).hide(200).remove();
         }
         if (data.error) {
         alert(data.error);
         }
         }
         });*/
        $('#preloader').show();
        $.post('/local/ajax/client_remove.php', {'id': id}, function (data) {
            if (data.success) {
                $('._client_'+id).hide(200).remove();
            }
            if (data.error) {
                alert(data.error);
            }
            $('#preloader').hide();
        }, 'json');
    });

    $('.add_note_form').on('submit',function (e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var _this = $(this);
        var data = _this.serialize();
        var client = _this.data('client');
        $.post('/local/ajax/client_note.php', data, function (data) {

            if (data.success) {
                if($(".client_note[data-client='"+client+"'] ._empt").length){
                    $(".client_note[data-client='"+client+"'] ._empt").remove();
                }
                $(".client_note[data-client='"+client+"']").append("<dt>"+data.DESCRIPTION+"</dt><dd>"+data.VALUE+"</dd>");
                _this.find('.form-control').val('');
                _this.closest('.add_note').hide(200);
            }
            if (data.error) {
                alert(data.error);
            }

        }, 'json');

        return false;

    });

    $('._set_critical').on('click',function (e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var _this = $(this);
        var client = _this.data('client');
        var critical = _this.text() == 'Обработано'?0:85;
        $('#preloader').show();
        $.post('/local/ajax/client_actions.php', {'client':client,'action':'setCritical','critical':critical}, function (data) {
            if (data.success) {
                if(critical > 0){
                    _this.text('Обработано').closest('.panel-black').addClass('critical');
                }
                else{
                    _this.text('Требует обработки').closest('.panel-black').removeClass('critical');
                }
            }
            if (data.error) {
                alert(data.error);
            }
            $('#preloader').hide();

        }, 'json');
    })
    $('._set_vidan').on('click',function (e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        $('#preloader').show();
        var _this = $(this);
        var client = _this.data('client');
        var ne_vidan = _this.text() == 'Товар выдан'?0:86;
        var paied_orders = _this.data('paied_orders');
        $.post('/local/ajax/client_actions.php', {'client':client,'action':'setNeVidan','ne_vidan':ne_vidan,'paied_orders':paied_orders}, function (data) {
            if (data.success) {
                if(ne_vidan > 0){
                    _this.text('Товар выдан').closest('.panel-black').addClass('ne_vidan');
                }
                else{
                    _this.text('Товар ещё не выдан').closest('.panel-black').removeClass('ne_vidan');
                }
            }
            if (data.error) {
                alert(data.error);
            }
            $('#preloader').hide();

        }, 'json');
    })
}
$('._delete').on('confirmed.bs.confirmation',function (event) {
    var id = $(event.relatedTarget).data('client');

});
function reloadList(){
    $('._client_filter').val('');
    $('#preloader').show();
    $('#clientsList').load('/local/ajax/client_list.php',null,function(){$('#preloader').hide(); setClientsListClick();});
}