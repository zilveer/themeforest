( function( $ ) {

  function is_display_type(display_type){
    return ( ($('.display-type').css('content') == display_type) || ($('.display-type').css('content') == '"'+display_type+'"'));
  }
  function not_display_type(display_type){
    return ( ($('.display-type').css('content') != display_type) && ($('.display-type').css('content') != '"'+display_type+'"'));
  }

  // Document Ready functions
  $( function() {
    if(not_display_type("tablet") && not_display_type("phone")){
      var offset = 220;
      var duration = 500;

      $(window).scroll($.debounce( 500, function(){
        if ($(this).scrollTop() > offset) {
            $('.os-back-to-top').fadeIn(duration);
        } else {
            $('.os-back-to-top').fadeOut(duration);
        }
      }));

      $('.os-back-to-top').click(function(event) {
          event.preventDefault();
          $('html, body').animate({scrollTop: 0}, duration);
          return false;
      });
    }

  } );
} )( jQuery );
