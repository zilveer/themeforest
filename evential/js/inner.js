jQuery(document).ready(function($) {
   'use strict';
	//SMOOTH SCROLL
	smoothScroll.init({
		speed: 500, // How fast to complete the scroll in milliseconds
		easing: 'easeInOutCubic', // Easing pattern to use
		updateURL: false, // Boolean. Whether or not to update the URL with the anchor hash on scroll
		callbackBefore: function ( toggle, anchor ) {}, // Function to run before scrolling
		callbackAfter: function ( toggle, anchor ) {} // Function to run after scrolling
	 });
	  
	//MILESTONE
    $('.timer').countTo();	
 	
	// Nice Scroll
	$("html").niceScroll({scrollspeed:"80"}) ;
	
	//MAGNIFIC POPUP IMAGE
	$('.image-link').magnificPopup({type:'image'});	
	$('.video-link').magnificPopup({type:'iframe'});	
	
	//OWLCAROUSEL SCHEDULE
	var timetable = $("#timetable");
  var days = $("#days");
 
  timetable.owlCarousel({
    singleItem : true,
    slideSpeed : 1000,
    navigation: false,
    pagination:false,
    afterAction : syncPosition,
    responsiveRefreshRate : 200,
  });
 
  days.owlCarousel({
   	items : 4,
    itemsMobile       : [479,4],
    pagination:false,
    responsiveRefreshRate : 100,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    }
  });
 
  function syncPosition(el){
    var current = this.currentItem;
    $("#days")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#days").data("owlCarousel") !== undefined){
      center(current)
    }
  }
 
  $("#days").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    timetable.trigger("owl.goTo",number);
  });
 
  function center(number){
    var daysvisible = days.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in daysvisible){
      if(num === daysvisible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>daysvisible[daysvisible.length-1]){
        days.trigger("owl.goTo", num - daysvisible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        days.trigger("owl.goTo", num);
      }
    } else if(num === daysvisible[daysvisible.length-1]){
      days.trigger("owl.goTo", daysvisible[1])
    } else if(num === daysvisible[0]){
      days.trigger("owl.goTo", num-1)
    }
    
  }

	//OWLCAROUSEL GALLERY
	var owl = $(".gallery");
 
	  owl.owlCarousel({
		  itemsCustom : [
			[0, 2],
			[450, 2],
			[600, 4],
			[700, 4],
			[1000, 4],
			[1200, 4],
			[1600, 4]
		  ],
		  navigation : true,
		  navigationText : ['<i class="fa fa-4x fa-chevron-circle-left"></i>','<i class="fa fa-4x  fa-chevron-circle-right"></i>'],
	  });

	  
	//OWLCAROUSEL TESTIMONIAL
	$("#quote").owlCarousel({
 
		pagination : false, 
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
		navigation : true,
		navigationText : ['<i class="fa fa-3x fa-chevron-circle-left"></i>','<i class="fa fa-3x  fa-chevron-circle-right"></i>'],
	});
	
	
	//FIX HOVER EFFECT ON IOS DEVICES
	document.addEventListener("touchstart", function(){}, true);
	
	
	// if($('a[data-rel="prettyphoto"]').length>0){
	// $('a[data-rel="prettyphoto"]').prettyPhoto();
	// }
	// if($('a[data-rel="prettyPhoto"]').length>0){
	// $('a[data-rel="prettyPhoto"]').prettyPhoto();
	// }

});
	
	


jQuery(document).ready(function($) {
	
	
	//PARALLAX BACKGROUND
	$(window).stellar({
		horizontalScrolling: false,
	});
    
	
    //PRELOADER
    $('#preload').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	
	
	//HEADER ANIMATION
	$(window).scroll(function() {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").addClass("top-nav-collapse");
		} else {
			$(".navbar-fixed-top").removeClass("top-nav-collapse");
		}
	});

});

//Page redirect

jQuery(function(){
    'use strict';
	//if(jQuery(window).width() <= 768){
		jQuery("#menu-main-menu li.menu-item a").click(function(){
			jQuery('#menu-main-menu li.menu-item').removeClass('current');
			jQuery(this).addClass('current');
			var t = jQuery(this).attr('href');
			window.location.href= nav_url+'/'+t;
		});
	//}
});
// Palette //
jQuery(function () {
    'use strict';
    var palettestatus = true;
    if(jQuery("#palette").length > 0)
    {
        jQuery("#palette .palette-edit").click(function(e){
            e.preventDefault();
            if(palettestatus)
            {
                jQuery("#palette").animate({'left': '0px'}, 'slow');
                palettestatus = false;
            }
            else
            {
                jQuery("#palette").animate({'left': '-150px'}, 'slow');
                palettestatus = true;
            }
        });
        
       jQuery("#palette").find('nav a').click(function(e){
            e.preventDefault();
            var skin = jQuery(this).attr('id');
            jQuery(this).addClass('selected').siblings().removeClass('selected');
            jQuery('body').removeClass().addClass(skin);
            if ( jQuery(this).hasClass('default'))
            {   jQuery('body').removeClass();}
        });
    }
});