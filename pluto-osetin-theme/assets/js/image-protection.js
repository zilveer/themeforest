( function( $ ) {

  // Document Ready functions
  $( function() {

    $(document).on("contextmenu", "#fancybox-img, article.post img, .figure-shade, .figure-icon, .mfp-img", function(e){
      $('.copyright-tooltip').css('left', e.pageX).css('top', e.pageY).fadeIn('fast', function(){
        setTimeout(function(){
          jQuery('.copyright-tooltip').fadeOut();
        }, 1500);
      });
      return false;
    });

  } );
} )( jQuery );
