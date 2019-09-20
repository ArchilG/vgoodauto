/**
 * Created by Archil on 14.11.2018.
 */
$(function () {
    $('.phone-mask').mask("+7 (999) 999-99-99");
    $('.vin-mask').mask('XXXXXXXXXXXXXXXXX');
    $('.phone-mask,.vin-mask').on('click', function () {
        $(this).focus();
    });
})