jQuery( document ).ready(function($) {

  "use strict";
  
  function flatsome_QuickView(element){
    $(element).click(function(e){
     if($(this).attr('data-prod') == '') return;
     /* add loader  */
     $(this).parent().parent().addClass('processing');

     var product_id = $(this).attr('data-prod');

     var data = { action: 'flatsome_quickview', product: product_id};
      $.post(flatsomeVars.ajaxurl, data, function(response) {

       $('.processing').removeClass('processing');
       
       // Start popup
       $.magnificPopup.open({
          removalDelay: 300,
          closeBtnInside: false,
          autoFocusLast: false,
          items: {
            src: '<div class="product-lightbox lightbox-content">'+response+'</div>',
            type: 'inline'
          }
        });

        // Refresh slider after images are loaded.
        setTimeout(function(){ 
          $('.product-lightbox').imagesLoaded(function () {
              $('.product-lightbox .slider').flickity({
                  cellAlign: "center",
                  wrapAround: true,
                  autoPlay: false,
                  prevNextButtons:true,
                  adaptiveHeight: true,
                  percentPosition: true,
                  imagesLoaded: true,
                  lazyLoad: 1,
                  dragThreshold : 15,
                  pageDots: false,
              });
          });
        }, 300);

        if ($('.product-lightbox form').hasClass('variations_form')) {
                $('.product-lightbox form.variations_form').wc_variation_form();
        }

        $(".product-lightbox form.variations_form").on('show_variation', function (event, variation) {
          if (variation.image_src){
            $('.product-lightbox .product-gallery-slider .slide.first img').attr('src', variation.image_src).attr('srcset','');
            $('.product-lightbox .product-gallery-slider .slide.first a').attr('href', variation.image_link);
            $('.product-lightbox .product-gallery-slider').flickity('select', 0);
          }
        });

        // Add QTY
        $('.product-lightbox .quantity').addQty();

      });
      e.preventDefault();
    }); // product lightbox
  };

  // Start Quick View
  flatsome_QuickView('.quick-view');
});