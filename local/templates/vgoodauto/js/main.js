 //alert MESAGE
 // reductative ::function on dNage Studio
 /*
 function alertMy(text){
    jQuery('#alertModal DIV.modal-body').html('');
    jQuery('#alertModal DIV.modal-body').append('<h4 style="text-align:center;">'+text+'</h4>');
    jQuery('#alertModal').modal();
}
*/

// form validator of dNage Studio
// must be include inputValidatot.js
/*
jQuery(function($){
   $.mask.autoclear = !1;
   $("INPUT[type=tel]").mask("+7 (999) 999-99-99",{"placeholder":" "});
   //$("#tin").mask("99-9999999");
   //$("#ssn").mask("999-99-9999");
   //$("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
});
*/

// JQuery of page
jQuery(document).ready(function(){
    // show Modall window of bootstrap
    /*
    jQuery("#idClickElement").on('click', function(){
        jQuery('#idModalOnShow').modal();
    });
    */
    /*
    jQuery('FORM[name=callMeGo]').submit(function(){
        if(jQuery('INPUT[name=name]').val() == ''){
            alert('Введите свое имя');
            jQuery('INPUT[name=name]').focus();
            return false;
        }
        if(jQuery('INPUT[name=phone]').val() == null){
            alert('Введите свой телефон');
            jQuery('INPUT[name=phone]').focus();
            return false;
        }

        var post = [],
            atributes = '';
        post = {name:jQuery(this).children('INPUT[name=name]').val(), phone:jQuery(this).children('INPUT[name=phone]').val(), label:jQuery(this).attr('label')};
        atributes = jQuery(this).attr('data');
        console.log(JSON.stringify(post));

        callMeGo(atributes, JSON.stringify(post));
        return false;
    });
*/
jQuery('.wrapperMenuIcon').on('click', function() {
    jQuery(".wrapperMenuIcon").toggleClass('open');
    if (jQuery(this).hasClass('open')) {
        jQuery(".wrapperMenu").animate({
            right: "0px"
        }, 400);
    } else {
        jQuery(".wrapperMenu").animate({
            right: "-320px"
        }, 400);
    }
  });
  jQuery('.menuIcons').on('click', function() {
    jQuery(".wrapperMenuIcon").toggleClass('open');
    if (jQuery(this).hasClass('open')) {
        jQuery(".wrapperMenu").animate({
            right: "0px"
        }, 400);
    } else {
        jQuery(".wrapperMenu").animate({
            right: "-320px"
        }, 400);
    }
  });

    //Submit
    jQuery("form").on('submit', function(){
        var errMy = 0;
        if( jQuery(this).children('DIV').children('INPUT[name=name]').val() == '' ){
            errMy = 1;
        }
        if( jQuery(this).children('DIV').children('INPUT[name=phone]').val() == '' ){
            errMy = 1;
        }
        if( jQuery(this).children('DIV').children('INPUT[name=email]').val() == '' ){
            errMy = 1;
        }
        if(errMy){
            alertMy('Не все данные введены, либо введены не коректные данные');
            return false;
        }
    });
});




function callMeGo(atributes, post){
    jQuery.ajax({
        url    : "/includes/mailToAjax.php",
        type   : 'POST',
        data   : {'atributes':atributes, 'post':post, 'func':'sentOnlineZajavka'},
        cache  : false,
        success: function(data){
        }
    })
    .done( function(data){
            //data = JSON.parse(data);
            console.log(data);
            if( data.id ){
                if(atributes == 'modal'){
                    jQuery('#modalZayavka .modal-header').append("<h3>Спасибо за заявку!</br>Мы свяжемся с Вами в ближайшее время!</h3>");
                    jQuery('#modalZayavka .modal-body').css('display','none');
                } else {
                    jQuery('#alertModal DIV.modal-body').html('');
                    jQuery('#alertModal DIV.modal-body').append("<h3>Спасибо за заявку!</br>Мы свяжемся с Вами в ближайшее время!</h3>");
                    jQuery('#alertModal').modal();
                }
                jQuery('INPUT[name=name').val('');
                jQuery('INPUT[name=phone').val('');
            } else {
                if(atributes == 'modal'){
                    jQuery('#modalZayavka .modal-header').append("Не все поля заполненны");
                    jQuery('#modalZayavka .modal-body').css('display','none');
                } else {
                    jQuery('#alertModal DIV.modal-body').html('');
                    jQuery('#alertModal DIV.modal-body').append("Не все поля заполненны");
                    jQuery('#alertModal').modal();
                }
            }
        }
    )
    .fail( function(){
        //alert('Error');
        }
    );
}
