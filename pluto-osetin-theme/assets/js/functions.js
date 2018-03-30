/**
 * Theme functions file
 *
 * Contains handlers for navigation, accessibility, header sizing
 * footer widgets and Featured Content slider
 *
 */
( function( $ ) {

  function is_display_type(display_type){
    return ( ($('.display-type').css('content') == display_type) || ($('.display-type').css('content') == '"'+display_type+'"'));
  }
  function not_display_type(display_type){
    return ( ($('.display-type').css('content') != display_type) && ($('.display-type').css('content') != '"'+display_type+'"'));
  }

  // Initialize isotope layout only if there is a index-isotope container element on a page and the device in use is not a phone or a tablet
  function initiate_isotope() {
    var is_origin_left = true;
    if($('body').hasClass('rtl')){
      is_origin_left = false;
    }
    if($('.index-isotope').length && (not_display_type("tablet") || (is_display_type("tablet") && $('body').hasClass('menu-position-top') && $('body').hasClass('no-sidebar'))) && not_display_type("phone")){
      var layout_mode = $('.index-isotope').data('layout-mode');
      var $isotope_container = $('.index-isotope').isotope({
        'itemSelector': '.item-isotope',
        'layoutMode': layout_mode,
        'isOriginLeft': is_origin_left
      });
      $('.index-isotope').addClass('isotope-active');
      // init isotope
      $isotope_container.isotope('layout');
      // reposition when everything loads isotope
      $(window).load(function() {
        $isotope_container.isotope('layout');
      });
      // reposition when images load
      $('.index-isotope').imagesLoaded(function(){
        $isotope_container.isotope('layout');
        // $('.index-isotope .pluto-post-box .post-media-body, .index-isotope .product-media-body').find('.figure-link-w, iframe').slideDown(100, function(){
        //   $isotope_container.isotope('layout');
        //   setTimeout(function(){
        //     $('.index-isotope .pluto-post-box .post-media-body, .index-isotope .product-media-body').find('.figure-link-w, iframe').addClass('os-faded-in');
        //   }, 50);
        // });
      });
    }else{
      if($('.index-isotope').length && $('.index-isotope').hasClass('isotope-active')){
        $('.index-isotope').isotope('destroy').removeClass('isotope-active');
      }
    }
  }


  // Smarter window resize which allows to disregard continious resizing in favor of action on resize complete
  $(window).resize(function() {
    if(this.resizeTO) clearTimeout(this.resizeTO);
    this.resizeTO = setTimeout(function() {
      $(this).trigger('resizeEnd');
    }, 500);
  });


  // Re-init isotope on window resize
  $(window).bind('resizeEnd', function() {
    initiate_isotope();
  });



  // Document Ready functions
  $( function() {


    // If there is a qr-code generator button - init it
    if($('.single-post-top-qr').length){
      $('.single-post-top-qr').on("click", function(){
        $('#qrcode').html("");
        var qrcode = new QRCode("qrcode");
        qrcode.makeCode(window.location);
        $('#qrcode-modal').modal();
      });
    }

    // Initiate isotope layout on document ready
    initiate_isotope();

    // Menu block sub items
    $('.menu-trigger-click .menu-item-has-children > a').on("click", function(){
      $submenu = $(this).next('.sub-menu');
      if($submenu.hasClass('sub-menu-active')){
        $submenu.slideUp(100).removeClass('sub-menu-active');
      }else{
        $('.sub-menu').slideUp(100).removeClass('sub-menu-active');
        $submenu.slideDown(100).addClass('sub-menu-active');
      }
      return false;
    });

    $('.menu-trigger-hover .menu-item-has-children').hover(function(){
      $submenu = $(this).find('.sub-menu');
      $('.sub-menu').slideUp(100).removeClass('sub-menu-active');
      $submenu.show().addClass('sub-menu-active');
    }, function(){
      $submenu = $(this).find('.sub-menu');
      $submenu.hide().removeClass('sub-menu-active');
    });

    // Initiate perfect scrollbar for the fixed side menu
    $('.menu-position-left .menu-block, .menu-position-right .menu-block').perfectScrollbar({
      suppressScrollX: true,
      wheelPropagation: true,
      includePadding: true
    });

    $('.menu-toggler').on("click", function(){
      $("body").toggleClass('side-menu-active');
      return false;
    });

    $('.sidebar-toggler, .sidebar-main-toggler').on("click", function(){
      $("body").toggleClass('sidebar-active');
      return false;
    });

    // Click on top share button on single posts
    $('body').on("click", ".post-top-share .share-activator, .single-post-top-share .share-activator", function(){
      $(this).closest('.post-top-share, .single-post-top-share').toggleClass('active');
      $(this).closest('.post-top-share, .single-post-top-share').find('i.share-activator').toggleClass('os-icon-minus');
      return false;
    });


    // Flexslider init
    $('.flexslider').flexslider({
      animation : "slide"
    });

    if($('.featured-carousel').length){
      $('.featured-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        responsive : {
          0 : { items : 1 },
          480 : { items : 2 },
          768 : { items : 2 },
          992 : { items : 3 },
          1200 : { items : 4 },
          1700 : { items : 5 }
        }
      });
    }

    // Toggle reading mode on link click
    $('.single-post-top-reading-mode').on("click", function(){
      if($('body').hasClass('reading-mode')){
        $('body').removeClass("reading-mode");
        $('.single-post-top-reading-mode i').removeClass('os-icon-eye-slash').addClass('os-icon-eye');
        $('.single-post-top-reading-mode span').text($(this).data('message-on'));
      }else{
        $('body').addClass("reading-mode");
        $('.single-post-top-reading-mode i').removeClass('os-icon-eye').addClass('os-icon-eye-slash');
        $('.single-post-top-reading-mode span').text($(this).data('message-off'));
      }
      return false;
    });

    // Disable reading mode when ESC key is pressed
    $(document).keyup(function(e) {
      if (e.keyCode == 27) { $('body').removeClass('reading-mode'); }   // esc
    });

    // featured posts slider
    $('.featured-post-control-up').on("click", function(){
      var step_px = 95;
      var total_height = $('.featured-posts-slider-contents').height();
      var current_margin = Math.abs($('.featured-posts-slider-contents').css('margin-top').replace('px', ''));
      if((current_margin - step_px - 40) >= 0){
        var new_margin = (current_margin - step_px) * -1;
        $('.featured-posts-slider-contents').animate({ 'marginTop': new_margin + "px"}, 200);
      }else{
        $('.featured-posts-slider-contents').animate({ 'marginTop': '0px'}, 200);
      }
    });
    // featured posts slider
    $('.featured-post-control-down').on("click", function(){
      var step_px = 95;
      var total_height = $('.featured-posts-slider-contents').height();
      var current_margin = Math.abs($('.featured-posts-slider-contents').css('margin-top').replace('px', ''));
      if((current_margin + step_px + 40) <= total_height){
        var new_margin = (current_margin + step_px) * -1;
        $('.featured-posts-slider-contents').animate({ 'marginTop': new_margin + "px"}, 200);
      }else{
        $('.featured-posts-slider-contents').animate({ 'marginTop': '0px'}, 200);
      }
    });


  } );
} )( jQuery );
