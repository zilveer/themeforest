/*jshint undef:false, unused:false, jquery:true, browser:true*/
/*global logo_font:true, WebFontConfig: true, cookies_prefix: true, FB: true, MyAjax:true, login_localize:true*/

/*Google fonts api */

(function() {
  if(logo_font!=''){
    WebFontConfig = {
      google:{
        families: [logo_font] 
      },
      active: function() {
        slabTextHeadlines();
      }
    };
  }else{
    slabTextHeadlines();
  }
  

  var wf = document.createElement('script');
  wf.src = ('https:' === document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();

/* End of Google fonts api*/


function slabTextHeadlines() {
  "use strict";
    jQuery("#header-container .logo a h1").slabText({
        "viewportBreakpoint":380
    });
}



function setCookie(c_name,value,exdays)
{
  "use strict";
  var exdate=new Date();
  exdate.setDate(exdate.getDate() + exdays);
  var c_value=window.escape(value) + ((exdays===null) ? "" : "; expires="+exdate.toUTCString());
  document.cookie=c_name + "=" + c_value;
}

function resizeVideo(){
  "use strict";
  if(jQuery('.embedded_videos').length){
  jQuery('.embedded_videos iframe ').each(function(){
        var iframe_width = jQuery(this).parents('.embedded_videos').parent().width();
        var iframe_height = iframe_width/1.37;  
      jQuery(this).attr('width',iframe_width);
      jQuery(this).attr('height',iframe_height);
  });

  jQuery('.embedded_videos div.video-js ').each(function(){
        var iframe_width = jQuery(this).parents('.embedded_videos').parent().width();
        var iframe_height = iframe_width/1.37;  
        
            jQuery(this).attr('width',iframe_width);
            jQuery(this).attr('height',iframe_height);
            jQuery(this).css('width',iframe_width);
            jQuery(this).css('height',iframe_height);
          });
  }
}


/* Mobile menu */


(function($){
  "use strict";
$.fn.mobileMenu = function(options) {

  var defaults = {
      defaultText: 'Navigate to...',
      className: 'select-menu',
      subMenuClass: 'sub-menu',
      subMenuDash: '&ndash;'
    },
    settings = $.extend( defaults, options ),
    el = jQuery(this);

  this.each(function(){
    // ad class to submenu list
    el.find('ul').addClass(settings.subMenuClass);

    // Create base menu
    jQuery('<select />',{
      'class' : settings.className
    }).insertAfter( el );

    // Create default option
    jQuery('<option />', {
      "value"   : '#',
      "text"    : settings.defaultText
    }).appendTo( '.' + settings.className );

    // Create select option from menu
    var el_text;
    el.find('a').each(function(){
      if(jQuery(this).html().indexOf("<span>") !== -1){
        el_text = jQuery(this).html().replace(/<span>.*<\/span>/gi,'');
      } else{
        el_text = jQuery(this).text();
      }

      
      
      //console.log(el_text);
      var $this   = jQuery(this),
          optText = '&nbsp;' + el_text,
          optSub  = $this.parents( '.' + settings.subMenuClass ),
          len     = optSub.length,
          dash;

      // if menu has sub menu
      if( $this.parents('ul').hasClass( settings.subMenuClass ) ) {
        dash = new Array( len+1 ).join( settings.subMenuDash );
        optText = dash + optText;
      }

      // Now build menu and append it
      jQuery('<option />', {
        "value" : this.href,
        "html"  : optText
      }).appendTo( '.' + settings.className );

    }); // End el.find('a').each

    // Change event on select element
    jQuery('.' + settings.className).change(function(){
      var locations = $(this).val();
      if( locations !== '#' ) {
        window.location.href = jQuery(this).val();
      }
    });

  }); // End this.each

  return this;

};
})(jQuery);

jQuery(document).ready(function($) {
"use strict";
  $('.menu nav.main-menu').mobileMenu();
  $('.top_menu nav.top-menu').mobileMenu({
      defaultText: 'Top menu',
      className: 'mobile-select-top-sub-menu',
      subMenuDash: '&ndash;'
    });
  $('.mobile-login-menu li.signin').mobileMenu({
      defaultText: 'User menu',
      className: 'mobile-select-sub-menu',
      subMenuDash: '&ndash;'
  });
});




/* Masonry */

jQuery(document).ready(function() {
  "use strict";
    jQuery( window ).resize( function(){
        if( jQuery(window).width() > 767 ){
            jQuery('.masonry').isotope({
                // options
                itemSelector : '.masonry .masonry_elem'
            });
        }
    });
     
});

jQuery( window ).load( function(){
  "use strict";
  jQuery(function() {
      elastislide_carousel();
    setInterval(function(){
      showDiv();
    },300);
  });
});
   
function showDiv()
{
  "use strict";
  jQuery(".ourcarousel ul").show('slow');
}

function elastislide_carousel(){
  "use strict";
  var slide_margin = 0;
  jQuery('.ourcarousel').elastislide({
      margin : slide_margin,
      imageW    : jQuery('.ourcarousel .es-carousel').width(),
      minItems  : 1
  });

    //slideshow single carousel
    var the_width;
    if(jQuery('.es-carousel > ul > li').length){
        the_width = jQuery('.es-carousel > ul > li').width(); /*for list view thumbs*/
    }else{
        the_width = 1140; /*for single page*/
    } 

    /*for single page*/
    jQuery('article .featimg .single_carousel').elastislide({
      margin : 0 ,
      imageW  : 1140
    });
  var timeline_width;
    if(jQuery('.timeline-view article .entry-image').length){
        timeline_width = jQuery('.timeline-view article .entry-image').width();
    }else{
        timeline_width = 825;
    }

    jQuery('.timeline-view .single_carousel').elastislide({
        margin : 0 ,
        imageW  : timeline_width
    });  

  var list_width;
    if(jQuery('.list-view .single_carousel, .list-view .full-thumb-article .single_carousel').length){
        list_width = jQuery('.list-view .element .single_carousel, .list-view .full-thumb-article .single_carousel').width();
    }else{
        list_width = 825;
    }

    jQuery('.list-view .single_carousel').elastislide({
        margin : 0 ,
        imageW  : list_width
    });  

   var grid_width;
    if(jQuery('.grid-view .masonry_elem').length){
        grid_width = jQuery('.grid-view .masonry_elem').width();
    }else{
        grid_width = 825;
    }

    jQuery(' .grid-view .single_carousel').elastislide({
        margin : 0 ,
        imageW  : grid_width
    });   

    
    jQuery('.single_carousel li').each(function() {
        jQuery(this).show();
    });

    jQuery(window).trigger('resize'); /*trigger window resize to fix the carousel */

}


/* ###### Filters ##### */

/* thumbs filter */
jQuery(function(){
  "use strict";
    var $container = jQuery('.filter-on');

    $container.isotope({
      itemSelector : '.masonry_elem'
    });
    
    var $optionSets = jQuery('.thumbs-splitter'),
        $optionLinks = $optionSets.find('a');

    $optionLinks.click(function(){
        var $this = jQuery(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.thumbs-splitter');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
          // otherwise, apply new options
          $container.isotope( options );
        
        return false;
    });

  
});

jQuery(document).ready(function(){
"use strict";
    /* Related tabs */
    jQuery('.related-tabs li a').click(function(){
        var element_id =  jQuery(this).attr('href');
        jQuery(this).parents('li').parent().find('.active').removeClass('active');
        jQuery(this).parents('li').addClass('active');
        jQuery(this).parents('li').parent().next().find(' > div:visible').fadeOut(400);
        jQuery(this).parents('li').parent().next().find(element_id).delay(400).fadeIn(400);
        return false;
    });


    

    jQuery('.tabs-controller > li > a').click(function(){
        var this_id = jQuery(this).attr('href'); // Get the id of the div to show
        var tabs_container_divs = '.' + jQuery(this).parent().parent().next().attr('class') + ' >  div'; // All of elements to hide
        jQuery(tabs_container_divs).hide(); // Hide all other divs
        jQuery(this).parent().parent().next().find(this_id).show(); // Show the selected element
        jQuery(this).parent().parent().find('.active').removeClass('active'); // Remove '.active' from elements
        jQuery(this).addClass('active'); // Add class '.active' to the active element
        return false;
    }); 
  
  /*resize FB comments depending on viewport*/

  setTimeout(function(){
    viewPort();
  },3000); 
  
  resizeVideo();

  jQuery( window ).resize( function(){
  viewPort();
  resizeVideo();
    });
  
  /* Accordion */
  jQuery('.cosmo-acc-container').hide();
  jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
  jQuery('.cosmo-acc-trigger').click(function(){
    if( jQuery(this).next().is(':hidden') ) {
      jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
      jQuery(this).toggleClass('active').next().slideDown();
    }
    return false;
  });


  
  /* Hide Tooltip */
  jQuery(function() {
    jQuery('a.close').click(function() {
      jQuery(jQuery(this).attr('href')).slideUp();
            jQuery.cookie(cookies_prefix + "_tooltip" , 'closed' , {expires: 365, path: '/'});
            jQuery('.header-delimiter').removeClass('hidden');
      return false;
    });
  });
  
  

  /* initialize tabs */
  jQuery('.cosmo-tabs').each(function(){
    // Set default active classes
    jQuery(this).find('.tabs-container').not(':first').css('display','none');
    jQuery(this).find('ul li:first').addClass('tabs-selected');

     jQuery(this).find('ul li a').click(function(){
      if( jQuery(this).parent().hasClass('tabs-selected') ){
        return false;
      }
      var tabId = jQuery(this).attr('href');

      // We clear all active clasees
      jQuery(this).parent().parent().find('.tabs-selected').removeClass('tabs-selected');


      jQuery(this).parent().addClass('tabs-selected');
      jQuery(this).parents('.cosmo-tabs').find('.tabs-container').not(tabId).css('display','none');
      jQuery(this).parents('.cosmo-tabs').find(tabId).css('display','block');
      return false;
    })

  });
  
  


  
  jQuery(document).ready(function() {
    jQuery('aside.widget').append('<div class="clear"></div>');
  });


  	/* widget tabber */
    jQuery( 'ul.widget_tabber li a' ).click(function(){
        jQuery(this).parent('li').parent('ul').find('li').removeClass('active');
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').fadeTo( 200 , 0 );
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').hide();
        jQuery( jQuery( this ).attr('href') + '_panel' ).fadeTo( 600 , 1 );
        jQuery( this ).parent('li').addClass('active');
    });
  
    
  	/*toogle*/
  	/*Case when by default the toggle is closed */
	jQuery('.open_title').click(function(){
		if (jQuery(this).find('a').hasClass('show')) {
			jQuery(this).find('a').removeClass('show');
			jQuery(this).find('a').addClass('toggle_close'); 
			jQuery(this).find('.title_closed').hide();
			jQuery(this).find('.title_open').show();
		} else {
			jQuery(this).find('a').removeClass('toggle_close');
			jQuery(this).find('a').addClass('show');     
			jQuery(this).find('.title_open').hide();
			jQuery(this).find('.title_closed').show();
		}
		jQuery('.cosmo-toggle-container').slideToggle("slow");
	});
  
  	/*Case when by default the toggle is oppened */
	jQuery('.close_title').click(function(){
		if (jQuery(this).find('a').hasClass('hide')) {
			jQuery(this).find('a').removeClass('toggle_close');
			jQuery(this).find('a').addClass('show');     
			jQuery(this).find('.title_open').hide();
			jQuery(this).find('.title_closed').show();
		} else {
			jQuery(this).find('a').removeClass('show');
			jQuery(this).find('a').addClass('toggle_close');
			jQuery(this).find('.title_closed').hide();
			jQuery(this).find('.title_open').show();
		}
		jQuery('.cosmo-toggle-container').slideToggle("slow");
	});
  
	/*Accordion*/
	jQuery('.cosmo-acc-container').hide();
	jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
	jQuery('.cosmo-acc-trigger').click(function(){
	if( jQuery(this).next().is(':hidden') ) {
	  jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
	  jQuery(this).toggleClass('active').next().slideDown();
	}
	return false;
	}); 
  
});

/* grid / list switch */








/*EOF functions for style switcher*/

function viewPort(){ 
  "use strict";
  /* Determine screen resolution */
  //var $body = jQuery('body');
  var wSizes = [1200, 960, 768, 480, 320, 240];
  
  //$body.removeClass(wSizesClasses.join(' '));
  var size = jQuery(window).width();
  //alert(size);
  for (var i=0; i<wSizes.length; i++) { 
    if (size >= wSizes[i] ) { 
      //$body.addClass(wSizesClasses[i]);

      
      jQuery('.cosmo-comments .fb_iframe_widget iframe,.cosmo-comments .fb_iframe_widget span').css({'width':jQuery('.cosmo-comments.twelve.columns').width() });   
      
      break;
    }
  }
  if(typeof(FB) !== 'undefined' ){
    FB.Event.subscribe('xfbml.render', function(response) {
      FB.Canvas.setAutoGrow();
    });
  }  

}
jQuery(document).ready(function() {
"use strict";
  /*Tweets widget*/
   var delay = 4000; //millisecond delay between cycles
   function cycleThru(variable, j){
           var jmax = jQuery(variable + " div").length;
           jQuery(variable + " div:eq(" + j + ")")
                   .css('display', 'block')
                   .animate({opacity: 1}, 600)
                   .animate({opacity: 1}, delay)
                   .animate({opacity: 0}, 800, function(){
                     if(j+1 === jmax){ 
      j=0;
                     }else{ 
      j++; 
                     }
                           jQuery(this).css('display', 'none').animate({opacity: 0}, 10);
                           cycleThru(variable, j);
                   });
           }
           
   jQuery('.tweets').each(function(index, val) {
     //iterate through array or object
     var parent_tweets = jQuery(val).parent().attr('id');
     var actioner = '#' + parent_tweets + ' .tweets .dynamic .cosmo_twitter .slides_container';
     cycleThru(actioner, 0);
   });
   

    /* list view tabs */

    jQuery('.tabment-tabs li:first-child a').addClass('active'); // Set the class for active state
    jQuery('.tabment-tabs li a').click(function( event ){ // When link is clicked
      if(!jQuery(this).hasClass('active')){
        var tabment_id = jQuery(this).attr('href'); // Set currentTab to value of href attribute
        jQuery(this).parent().parent().find('.active').removeClass('active');
        jQuery(this).parent().parent().parent().parent().next().find('.tabment-tabs-container').find('li.tabs-container').hide();
        jQuery(this).parent().parent().parent().parent().next().find('.tabment-tabs-container').find(tabment_id).fadeIn(500);
        jQuery(window).trigger('resize');
        jQuery(this).addClass('active');
      }
      event.preventDefault();
      return false;
    });


    jQuery('.flickr_badge_image').each(function(index){
      var x = index % 3;
      if(index !==1 && x === 2){
        
        jQuery(this).addClass('last');
      } 
    });
  

 });

 /*========================================================================*/   


//init hover on thumb view with image main
function hoverThumbImg(){
  "use strict";
  var thisElem;

  jQuery('.thumb-image-main').mouseenter(function(){
    thisElem = jQuery(this);

    jQuery('.entry-content', thisElem).css('opacity','1');
  }).mouseleave(function(){
    thisElem = jQuery(this);

    jQuery('.entry-content', thisElem).css('opacity','0');
  });
}

//init hover on thumb view with text main 
function hoverThumbText(){
  "use strict";
  jQuery('.thumb-text-main').mouseenter(function(){
  var thisElem = jQuery(this);

    jQuery('.featimg', thisElem).css('opacity','1');
  }).mouseleave(function(){
    var thisElem = jQuery(this);

    jQuery('.featimg', thisElem).css('opacity','0');
  });
}



jQuery(function(){
"use strict";
  hoverThumbImg();
  hoverThumbText();

  if(navigator.platform.match('Mac') !== null) {
    jQuery(document.body).addClass('OSX');
  }

});

//Global variables
var calculatedStickyMenu = false;


// init Logo-Text stretching
function slabTextHeadlines() {
  "use strict";
    jQuery("#header-container .logo a h1").slabText({
        "viewportBreakpoint":380
    });
}

function searchAction(activeBoth){
  "use strict";
  if(jQuery('.search-btn').hasClass('searching')){
    jQuery('#main>.search-container').fadeOut(function(){
      jQuery('#main>.main-container').fadeIn();
      jQuery('.search-btn').removeClass('searching');
    });
  }else if(activeBoth){
    if(jQuery(window).width()<768){
      jQuery('body').animate({scrollTop: jQuery('#main>.main-container').offset().top-30},'slow','swing', 
        function(){
          jQuery('#main>.main-container').fadeOut(function(){
          jQuery('#main>.search-container').fadeIn(function(){
            jQuery('#main>.search-container form input.input').focus();
          });
          jQuery('.search-btn').addClass('searching');
        });
      });
    }else{
      jQuery('body').animate({scrollTop: 0},'slow','swing', 
        function(){
          jQuery('#main>.main-container').fadeOut(function(){
          jQuery('#main>.search-container').fadeIn(function(){
            jQuery('#main>.search-container form input.input').focus();
          });
          jQuery('.search-btn').addClass('searching');
        });
      });
    }
  }
}

//init Search btn to toggle the content
function initSearchBtn(){
  "use strict";
  jQuery('.search-btn').click(function(){
    searchAction(true);
  });

  jQuery(document).keyup(function(e) {
    if (e.keyCode === 27) {
      searchAction(false);
    }
  });
}

//init menu - you need just to give him the menu class
function initMenu(menu){
  "use strict";
  jQuery(menu).supersubs({ 
        minWidth:    14,   // minimum width of sub-menus in em units 
        maxWidth:    35,   // maximum width of sub-menus in em units
        animation: {height:'show'}  // slide-down effect without fade-in 
                           // due to slight rounding differences and font-family 
    }).superfish({
      dropShadows:   false
    });  // call supersubs first, then superfish, so that subs are 
   // not display:none when measuring. Call before initialising 
   // containing tabs for same reason. 
}

function initStickyMenu(){
  "use strict";
  jQuery(document).on('scroll',function(){
    if( jQuery(document).scrollTop() >= jQuery('.menu > .main-menu').offset().top-15){
      //jQuery('#page').animate({paddingTop: '40px'}, 500);
      jQuery('header#top #header-container .sticky-menu-container').fadeIn(300);
      if(!calculatedStickyMenu){
        initMenu('.sticky-menu-container ul.sf-menu');
        calculatedStickyMenu=true;
      }
    }else{
      jQuery('header#top #header-container .sticky-menu-container').fadeOut(200);
    }
  });
}

function initTestimonialsCarousel(){
"use strict";
  //jQuery('.testimonials-view ul.testimonials-carousel').height(jQuery('.testimonials-carousel-elem.active').height());

  jQuery('.testimonials-view ul.testimonials-carousel, .widget ul.testimonials-carousel').each(function(){
    if(jQuery(this).children().length<=1){
      jQuery('.testimonials-carousel-nav', jQuery(this).parent()).css('display', 'none');
    }
  });

  

  jQuery('.testimonials-view ul.testimonials-carousel-nav > li, .widget ul.testimonials-carousel-nav > li').click(function(){
    var thisElem = jQuery(this);
    var thisTestimonialContainer = jQuery(this).parent().parent();
    var activeTestimonial = jQuery('.testimonials-carousel-elem.active', thisTestimonialContainer);
    var indexOfActiveElem = jQuery('.testimonials-carousel-elem', thisTestimonialContainer).index(jQuery('.testimonials-carousel-elem.active', thisTestimonialContainer));

    var listOfTestimonials = jQuery('.testimonials-carousel-elem', thisTestimonialContainer).toArray();
    var lengthOfList = listOfTestimonials.length-1;
    var IndexOfNextTestimonial;
    var IndexOfPrevTestimonial;
    var nextTestimonial;
    var prevTestimonial;


    if(indexOfActiveElem+1 > lengthOfList){
      IndexOfNextTestimonial = 0;
    }else{
      IndexOfNextTestimonial = indexOfActiveElem+1;
    }

    if(indexOfActiveElem-1 < 0){
      IndexOfPrevTestimonial = lengthOfList;
    }else{
      IndexOfPrevTestimonial = indexOfActiveElem-1;
    }

    nextTestimonial = listOfTestimonials[IndexOfNextTestimonial];
    prevTestimonial = listOfTestimonials[IndexOfPrevTestimonial];


    if( thisElem.hasClass('testimonials-carousel-nav-left') ){

      activeTestimonial.fadeOut('fast', function(){
        activeTestimonial.removeClass('active');
        jQuery(prevTestimonial).addClass('active');
        jQuery(prevTestimonial).fadeIn();
      });

    }else{

      activeTestimonial.fadeOut('fast', function(){
        activeTestimonial.removeClass('active');
        jQuery(nextTestimonial).addClass('active');
        jQuery(nextTestimonial).fadeIn();
      });

    }
  });

}

function initCarousel(){
  "use strict";
  jQuery('.carousel-wrapper').each(function(){
    var thisElem = jQuery(this);
    var numberOfElems = parseInt(jQuery('.carousel-container', thisElem).children().length, 10);
    var oneElemWidth;
    var numberOfColumns = [['two',6],['three',4],['four',3],['six',2],['twelve',1]];
    var curentNumberOfColumns;
    var moveMargin;
    var leftHiddenElems = 0;
    var rightHiddenElems; 
    var curentMargin = 0;
    var numberOfElemsDisplayed;
    var index = 0;
    var carouselContainerWidth;
    var carouselContainerWidthPercentage;
    var elemWidth;
    var elemWidthPercentage;

    while( index < numberOfColumns.length){
      if ( jQuery('.carousel-container>.columns', thisElem).hasClass(numberOfColumns[index][0]) ){
        curentNumberOfColumns = numberOfColumns[index][1];
        break;
      }
      index ++;
    }

    elemWidth = 100/numberOfElems;
    elemWidth = elemWidth.toFixed(4);
    elemWidthPercentage = elemWidth + '%';

    reinitCarousel();

    jQuery(window).resize(function() {
      reinitCarousel();
    });

    function showHideArrows(){
      if(curentNumberOfColumns>=numberOfElems){
        jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('display','none');
        jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('display','none');
      }else if(curentMargin===0){
        jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('display','none');
        jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('display','block');
      }else if(rightHiddenElems===0){
        jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('display','block');
        jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('display','none');
      }else{
        jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('display','block');
        jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('display','block');
      }
    }

    function reinitCarousel(){

      showHideArrows();

      jQuery('.carousel-container', thisElem).css('margin-left',0);
      leftHiddenElems = 0;
      jQuery('ul.carousel-nav > li', thisElem).unbind('click');

      if(jQuery(window).width()<=767){

        carouselContainerWidth = 100 * numberOfElems;
        carouselContainerWidthPercentage = carouselContainerWidth + '%';
        rightHiddenElems = numberOfElems - 1;
        moveMargin = 100;

        curentMargin = 0;

        jQuery('ul.carousel-nav > li', thisElem).unbind('click');

        jQuery('ul.carousel-nav > li', thisElem).click(function(){



          if( jQuery(this).hasClass('carousel-nav-left') ){

            if (leftHiddenElems!==0){

              curentMargin = curentMargin + moveMargin;
              jQuery('.carousel-container', thisElem).css('margin-left',curentMargin+'%');
              rightHiddenElems++;
              leftHiddenElems--;
            }

            showHideArrows();

          }else{

            if (rightHiddenElems!==0){
              curentMargin = curentMargin - moveMargin;
              jQuery('.carousel-container', thisElem).css('margin-left', curentMargin+'%');
              rightHiddenElems--;
              leftHiddenElems++;
            }

            showHideArrows();

          }

        });

      }else{

        while( index < numberOfColumns.length){
          if ( jQuery('.carousel-container>.columns', thisElem).hasClass(numberOfColumns[index][0]) ){
            numberOfElemsDisplayed = numberOfColumns[index][1];
            moveMargin = 100/numberOfElemsDisplayed;
            rightHiddenElems = numberOfElems - numberOfElemsDisplayed;
            oneElemWidth = 100 / numberOfColumns[index][1];
            break;
          }
          index ++;
        }

        carouselContainerWidth = oneElemWidth * numberOfElems;
        carouselContainerWidthPercentage  = carouselContainerWidth + '%';

        curentMargin = 0;

        jQuery('ul.carousel-nav > li', thisElem).click(function(){

          if( jQuery(this).hasClass('carousel-nav-left') ){

            if (leftHiddenElems!==0){
              curentMargin = curentMargin + moveMargin;
              jQuery('.carousel-container', thisElem).css('margin-left',curentMargin+'%');
              rightHiddenElems++;
              leftHiddenElems--;
            }

            showHideArrows();

          }else{

            if (rightHiddenElems!==0){
              curentMargin = curentMargin - moveMargin;
              jQuery('.carousel-container', thisElem).css('margin-left', curentMargin+'%');
              rightHiddenElems--;
              leftHiddenElems++;
            }

            showHideArrows();

          }

        });

      }

      //set container width
      jQuery('.carousel-container', thisElem).width(carouselContainerWidthPercentage).css({'max-height':'999px', 'opacity':'1'});


      //set eachelem width
      jQuery('.carousel-container>.columns', thisElem).each(function(){
        jQuery(this).attr('style','width: '+elemWidthPercentage+' !important; float:left;');
      });
      
    }

  });
}

jQuery(window).load(function() {
  "use strict";
    initSearchBtn();
    initStickyMenu();
    initTestimonialsCarousel();
    initCarousel();
    jQuery('.filter-on').isotope();


    //if(logo_font==''){
    //  slabTextHeadlines();
    //}
});

jQuery(document).ready(function(){
  "use strict";
  initMenu('.menu ul.sf-menu');
  setTimeout(function(){
      jQuery('.single article.post .featimg .featbg').css('display','inline-block'); /* This fix the bug on safari (iamge too small when is set inline-block parent) */
    }, 1000);
});


/*==========================================BOF Pretty Photo Settings===============================*/

if (prettyPhoto_enb.enb_lightbox) { 
  jQuery(document).ready(function(){
    "use strict";
      /* show images inserted in gallery */
      jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
              autoplay_slideshow: false,
              theme: 'light_square',
              social_tools:false,
              deeplinking: false,
              hook: 'data-rel'  

      });

      /* show images inserted into post in LightBox */
      jQuery("[class*='wp-image-']").parents('a').not("a[data-rel^='attachment']").prettyPhoto({
              autoplay_slideshow: false,
              theme: 'light_square',
              deeplinking: false,
              hook: 'data-rel' 

      });
      
      jQuery("a[data-rel^='keyboardtools']").prettyPhoto({
              autoplay_slideshow: false,
              theme: 'light_square',
              social_tools : '',
              deeplinking: false ,
              hook: 'data-rel'

      });
  });
}
/*==========================================EOF Pretty Photo Settings===============================*/


/*==========================================BOF Login Settings===============================*/
var user_archives_link;

function redirect(){
  "use strict";
  //document.location = user_archives_link;
  location.reload();
}

jQuery( '#register_form' ).ready( function(){
  "use strict";
  jQuery( '#register_form' ).submit( function( event ){
    jQuery.ajax({
      url: MyAjax.ajaxurl,
      data: '&action=cosmo_register&'+jQuery( '#register_form' ).serialize(),
      type: 'POST',
      dataType: "json",
      cache: false,
      success: function (json) {

        if(json.status && json.status === 'success'){
          if(json.url){
            user_archives_link = json.url; 
          }
          
          jQuery( '#registration_error' ).removeClass( 'login-error' );
          jQuery( '#registration_error' ).addClass( 'login-success' );
          jQuery( '#registration_error' ).html( json.msg ).fadeIn();


          setTimeout( redirect , 1000 );
        }else{
          jQuery( '#registration_error' ).html( json.msg ).fadeIn();
        }

        
      }
    });
  event.preventDefault();
  });
});

    
jQuery( '#cosmo-loginform' ).ready( function(){
  "use strict";
  jQuery( '#cosmo-loginform' ).submit( function(event){
        jQuery( '#ajax-indicator' ).show();
    jQuery.ajax({
      url: MyAjax.ajaxurl,
      data: '&action=cosmo_login&'+jQuery( '#cosmo-loginform' ).serialize(),
      type: 'POST',
      dataType: "json",
      cache: false,
      success: function (json) {
                jQuery( '#ajax-indicator' ).hide();

                if(json.status && json.status === 'success'){
                  user_archives_link = json.url;
                  jQuery( '#registration_error' ).removeClass( 'login-error' );
          jQuery( '#registration_error' ).addClass( 'login-success' );
                    
          jQuery( '#registration_error' ).html( json.msg ).fadeIn();
          setTimeout( redirect , 1000 );
                }else{
                  jQuery( '#registration_error' ).html( json.msg ).fadeIn();
                }

        
      }
    });
    event.preventDefault();
  });
});

jQuery( '#lostpasswordform' ).ready( function(){
  "use strict";
  jQuery( '#lostpasswordform' ).submit( function(){
    //jQuery( '#registration_error' ).html(  'Please check your email'  ).fadeIn();
    jQuery( '#registration_error' ).html( login_localize.check_email ).fadeIn();
    
  });
});

function get_login_box(action){ 
  "use strict";
  jQuery('.not_logged_msg').fadeOut();

  if(jQuery('.login_box').is(':hidden')){
    //jQuery('.login_box').removeClass("hide"); //show login box
    jQuery('.login_box').slideToggle(600);

  }
  //if(action != ''){
    jQuery('.'+action+'_warning').fadeIn();   
    jQuery('body,html').animate({scrollTop:0},300);
  //}

  //e.preventDefault();
}
/*==========================================EOF Login Settings===============================*/

jQuery(document).ready(function(){
  jQuery('.tab_7_days').click(function(){
     jQuery('#tabber_30_days_panel').css('display', 'none');
    jQuery('#tabber_7_days_panel').css('display', 'block');
   
  });

jQuery('.tab_30_days').click(function(){
    jQuery('#tabber_7_days_panel').css('display', 'none');
    jQuery('#tabber_30_days_panel').css('display', 'block');
  });
  jQuery('.menu-main-menu-container').css('height',jQuery(window).height()+60);
});
jQuery('.mobile-hamburger').click(function(){
  jQuery('.menu-main-menu-container').toggleClass('open');
  jQuery('#page').toggleClass('menu-open');
  jQuery('.mobile-hamburger').toggleClass('active');
  jQuery('body').toggleClass('stop-scrolling');
});
jQuery('.top-menu-trigger').click(function(){
  jQuery('.top-menu-mobile').toggleClass('trigit');
  jQuery('.top-menu-trigger').toggleClass('triggered');
  jQuery('.mobile-container').toggleClass('goup');
});




