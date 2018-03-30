( function( $ ) {
  $( function() {
    // Infinite scroll init
    if($('body').hasClass('with-infinite-scroll') && $('.isotope-next-params').length){
      $('.pagination-w.hide-for-isotope').hide().after('<div class="infinite-scroll-trigger"></div>');
      $(window).scroll($.debounce( 50, function(){ loadNextPageIsotope(); }));
    }
    // Infinite button init
    if($('body').hasClass('with-infinite-button') && $('.isotope-next-params').length){
      $('.pagination-w.hide-for-isotope').hide();
      $('.load-more-posts-button-w a').on('click', function(){ loadNextPageIsotope(); return false; });
    }
  });

  function is_display_type(display_type){
    return ( ($('.display-type').css('content') == display_type) || ($('.display-type').css('content') == '"'+display_type+'"'));
  }
  function not_display_type(display_type){
    return ( ($('.display-type').css('content') != display_type) && ($('.display-type').css('content') != '"'+display_type+'"'));
  }

  function loadNextPageIsotope(){
    if(!$('body').hasClass('infinite-loading-pending')){
      if($('.isotope-next-params').length){
        if(isScrolledIntoView('.infinite-scroll-trigger')){
          // if loading animation is not already on a page - add it
          if(!$('.isotope-loading').length){
            $loading_block = $('<div class="isotope-loading"></div>');
            $loading_block.insertAfter('.index-isotope');
          }
          var os_layout_type = 'v3';
          if($('.isotope-next-params').data("layout-type") == 'v1'){
            os_layout_type = 'v1';
          }
          if($('.isotope-next-params').data("layout-type") == 'v2'){
            os_layout_type = 'v2';
          }
          if($('.isotope-next-params').data("layout-type") == 'v3'){
            os_layout_type = 'v3';
          }
          if($('.isotope-next-params').data("layout-type") == 'v3-simple'){
            os_layout_type = 'v3-simple';
          }
          os_template_type = $('.isotope-next-params').data("template-type");

          $.ajax({
            type: "POST",
            url: ajaxurl,
            dataType: 'json',
            data: {
              action: 'load_infinite_content',
              next_params: $('.isotope-next-params').data("params"),
              layout_type: os_layout_type,
              template_type: os_template_type
            },
            beforeSend: function(){
              $('body').addClass('infinite-loading-pending');
            },
            success: function(response){
              if(response.success){
                if(response.has_posts){
                  // posts found and returned
                  var $new_posts = $(response.new_posts);
                  if($('.index-isotope').length && (not_display_type("tablet") || (is_display_type("tablet") && $('body').hasClass('menu-position-top') && $('body').hasClass('no-sidebar'))) && not_display_type("phone")){
                    $('.index-isotope').append($new_posts).isotope( 'appended', $new_posts ).imagesLoaded(function(){
                      $('.index-isotope').isotope('layout');
                      // setTimeout(function(){
                      //   $('.index-isotope .pluto-post-box .post-media-body, .index-isotope .product-media-body').find('.figure-link-w, iframe').slideDown(300, function(){
                      //     $('.index-isotope').isotope('layout');
                      //     setTimeout(function(){
                      //       $('.index-isotope .pluto-post-box .post-media-body, .index-isotope .product-media-body').find('.figure-link-w, iframe').addClass('os-faded-in');
                      //     }, 50)
                      //   });
                      // }, 500);

                    });
                  }else{
                    $('.index-isotope').append($new_posts);
                  }
                  if(response.next_params){
                    $('.isotope-next-params').data("params", response.next_params);
                  }else{
                    $('.isotope-next-params').remove();
                    $('.load-more-posts-button-w').remove();
                    $('.index-isotope').after('<div class="no-more-posts-message"><span>' + response.no_more_posts_message + '</span></div>');
                    $('.no-more-posts-message').hide().fadeIn("slow");
                  }
                  $('body').removeClass('infinite-loading-pending');

                  $('.os-lightbox-activator').magnificPopup({
                    type: 'image',
                    mainClass: 'mfp-with-zoom', // this class is for CSS animation below

                    zoom: {
                      enabled: true, // By default it's false, so don't forget to enable it

                      duration: 300, // duration of the effect, in milliseconds
                      easing: 'ease-in-out', // CSS transition easing function

                      // The "opener" function should return the element from which popup will be zoomed in
                      // and to which popup will be scaled down
                      // By defailt it looks for an image tag:
                      opener: function(openerElement) {
                        // openerElement is the element on which popup was initialized, in this case its <a> tag
                        // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                      }
                    }

                  });
                  $('.flexslider').flexslider({
                    animation : "slide"
                  });

                }else{
                  // no more posts
                  $('.isotope-next-params').remove();
                  $('body').removeClass('infinite-loading-pending');
                  $('.index-isotope').append(response.no_more_posts_message);
                }
              }else{
                // error handling
              }
              $('.isotope-loading').remove();
            }
          });
        }
      }
    }
  }

  function isScrolledIntoView(elem)
  {
    if($('body').hasClass('with-infinite-button')){
      // if button was clicked - no need to check if user scrolled into view or not just return true
      return true;
    }else{
      var docViewTop = $(window).scrollTop();
      var docViewBottom = docViewTop + $(window).height();

      var elemTop = $(elem).offset().top;
      var elemBottom = elemTop + $(elem).height();

      return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }
  }
} )( jQuery );