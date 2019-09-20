$(function () {
    $('.select_style').styler({'selectSearch': true});

    $('#car_brand').on('change',function () {
        $('#car_year').html('<option>Год выпуска</option>').attr('disabled',true).trigger('refresh');
        if(selectArResult.LEVEL_2[$(this).val()] && selectArResult.LEVEL_2[$(this).val()].length){
            $('#car_model').html('<option>Модель автомобиля</option>');
            $.each(selectArResult.LEVEL_2[$(this).val()],function(index,value){
                var s = '';
                if(value.SELECTED == 1){
                    s = 'selected';
                }

                $('#car_model').append("<option value='"+value.ID+"' data-url='"+value.SECTION_PAGE_URL+"' "+s+" data-cnt='"+value.ELEMENT_CNT+"'>"+value.NAME+"</option>").attr('disabled',false).trigger('refresh').trigger('change');
            })

        }
        else{
            $('#car_model').html('<option>Модель автомобиля</option>').attr('disabled',true).trigger('refresh');

        }

        if(parseInt($("#car_brand option:selected").data('cnt'))){
            $('#sectionGet').attr('href',$("#car_brand option:selected").data('url')).removeClass('disabled').find('span').text($("#car_brand option:selected").data('cnt'));
        }
        else{
            $('#sectionGet').attr('href',$("#car_brand option:selected").data('url')).addClass('disabled').find('span').text($("#car_brand option:selected").data('cnt'));
        }
    });

    $('#car_model').on('change',function () {
        if(selectArResult.LEVEL_3[$(this).val()] && selectArResult.LEVEL_3[$(this).val()].length){
            $('#car_year').html('<option>Год выпуска</option>');

            $.each(selectArResult.LEVEL_3[$(this).val()],function(index,value){
                var s = '';
                if(value.SELECTED == 1){
                    s = 'selected';
                }
                $('#car_year').append("<option value='"+value.ID+"' data-url='"+value.SECTION_PAGE_URL+"' "+s+" data-cnt='"+value.ELEMENT_CNT+"'>"+value.NAME+"</option>").attr('disabled',false).trigger('change').trigger('refresh');
            })

        }
        else{
            $('#car_year').html('<option>Год выпуска</option>').attr('disabled',true).trigger('refresh');
        }

        if(parseInt($("#car_model option:selected").data('cnt'))){
            $('#sectionGet').attr('href',$("#car_model option:selected").data('url')).removeClass('disabled').find('span').text($("#car_model option:selected").data('cnt'));
        }
        else{
            $('#sectionGet').attr('href',$("#car_model option:selected").data('url')).addClass('disabled').find('span').text($("#car_model option:selected").data('cnt'));
        }
    });

    $('#car_year').on('change',function () {
        if(parseInt($("#car_year option:selected").data('cnt'))){
            $('#sectionGet').attr('href',$("#car_year option:selected").data('url')).removeClass('disabled').find('span').text($("#car_year option:selected").data('cnt'));
        }
        else{
            $('#sectionGet').attr('href',$("#car_year option:selected").data('url')).addClass('disabled').find('span').text($("#car_year option:selected").data('cnt'));
        }
    });

    setTimeout(function () {
        if($('#car_brand').val()){
            $('#car_brand').trigger('change');
        }
    },500);
});
