jQuery(function($){
  $(document).mouseup(function (e){ // событие клика по веб-документу
    var div = $(".wrapperMenu"); // тут указываем ID элемента
    if (!div.is(e.target) // если клик был не по нашему блоку
        && div.has(e.target).length === 0) { // и не по его дочерним элементам
      div.animate({
          right: "-320px"
      }, 400); // скрываем его
      jQuery(".wrapperMenuIcon").removeClass('open');

    }
  });
});
// JQuery of page
jQuery(document).ready(function(){

  $('.slider').slick({
    dots: false,
    //infinite: false,
    //speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    //speed: 500,
    //fade: true,
    //cssEase: 'linear',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

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
});

$(function () {
    $('.nav .fa').on('click',function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('.nav').find('.sub.'+$(this).data('par')).toggle(100);
        $(this).parent().find('.fa').toggle();
    })
})