// JavaScript Document
jQuery(document).ready(function() {

  var device = navigator.userAgent.toLowerCase();
  var ios = device.match(/(iphone|ipod|ipad)/);

 //function that returns element's y position
    
    jQuery("a[href*=#]").on('click', function(e) {
      var scrollTarget = jQuery(this.hash).offset().top - 165;
      if(scrollTarget) 
          e.preventDefault();
        if(parseInt(scrollTarget) !== parseInt(jQuery(window).scrollTop())) {
          var nav2 = jQuery("header");
        if (ios) nav2.hide();
          jQuery('html,body').animate({scrollTop:scrollTarget}, 1000, "swing", function(evt) {
          if (ios) {
            nav2.css({position:'absolute', top:scrollTarget});
            var nav2clone = jQuery("header");
            nav2clone.show();
          }
      });
    }
    });

    if (ios) {
        jQuery(document).bind('touchmove',function(){
          var nav2 = jQuery("header");
        if(intro.height() <= nav2.position().top)
        {
            nav2.css({position:'fixed', top:'110px'});
            nav2.show();
          }
          else
            nav2.hide();
      });   
    }
});