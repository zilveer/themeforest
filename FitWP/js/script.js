jQuery(document).ready(function() {

jQuery(".gallery-icon a").prettyPhoto({animationSpeed:'normal',theme:'light_square', show_title : false}); jQuery("a[rel^='prettyPhoto'], .gallery-icon a").prettyPhoto({animationSpeed:'normal',theme:'light_square', show_title : false});

function prettyPhoto() {
    
    jQuery("area[rel^='prettyPhoto']").prettyPhoto();
				
				jQuery(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
				jQuery(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				jQuery("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){initialize();}
				});

				jQuery("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){_bsap.exec();}
				});
    
}

function topBarBtn() {
    
    jQuery('.openingHours').on('click', function(e) {
        
        jQuery(this).toggleClass('topBarActive')
        jQuery('.openingHoursModule .footerModule').fadeToggle();
  
          e.preventDefault();
        
    });
    
    jQuery('.contact').on('click', function(e) {
        
        jQuery(this).toggleClass('topBarActive');
        jQuery('.contactModule .footerModule').fadeToggle();
  
          e.preventDefault();
        
    });
    
      jQuery('.openingHoursClose').on('click', function(e) {
        
        jQuery('.openingHoursModule .footerModule').fadeToggle();
    jQuery('.openingHours').toggleClass('topBarActive');
  
          e.preventDefault();
        
    });
    
     jQuery('.contactClose').on('click', function(e) {
        
        jQuery('.contactModule .footerModule').fadeToggle();
     jQuery('.contact').toggleClass('topBarActive');
  
          e.preventDefault();
        
    });
    
}
function whiteBar() {
    
         var windowWidth = jQuery(window).width();
   var windowWidthMinusBar = windowWidth - 980;
    var windowWidthMinusBar2 = windowWidth - 790;
   var positionLeft = windowWidthMinusBar / 2;
   var positionLeft2 = windowWidthMinusBar2 / 2;
   
   
     jQuery('.whiteTop').css("left", positionLeft);
         jQuery('.whiteTop2').css("left", positionLeft2);
         jQuery('.slidesDescription').css("left", positionLeft);
       
         
}

function prettyPhoto() {
    
    jQuery("area[rel^='prettyPhoto']").prettyPhoto();
				
				jQuery(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
				jQuery(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				jQuery("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){initialize();}
				});

				jQuery("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){_bsap.exec();}
				});
    
}



 function mobileMenu() {
            
        // Create the dropdown base
        jQuery("<select />").appendTo("nav .container .sixteen");
        jQuery("nav select").hide();
        
        // Create default option "Go to..."
        jQuery("<option />", {
            "selected": "selected",
            "value"   : "",
            "text"    : "Go to..."
        }).appendTo("nav select");

        // Populate dropdown with menu items
        jQuery("nav a").each(function() {
            var el = jQuery(this);
            jQuery("<option />", {
                "value"   : el.attr("href"),
                "text"    : el.text()
            }).appendTo("nav select");
        });

        jQuery("nav select").change(function() {
            window.location = jQuery(this).find("option:selected").val();
        });
            
        }
        
          
        function select() {
            
        
              // FOR EACH SELECT
    jQuery('nav select').each(function() {
        
        // LET'S PUT OUR MARKUP BEFORE IT
        jQuery(this).before('<div class="select-wrapper">');
        
        // LETS PUR OUR MARKUP AFTER IT
        jQuery(this).after('<span class="select-container"></span></div>');
        
        // UPDATES THE INITIAL SELECTED VALUE
        var initialVal = jQuery(this).children('option:selected').text();
        jQuery(this).siblings('span.select-container').text(initialVal);
        
        // HIDES SELECT BUT LET THE USER STILL CLICK IT
        jQuery(this).css({opacity: 0});  
        
        // WHEN USER CHANGES THE SELECT, WE UPDATE THE SPAN BOX
        jQuery(this).change(function() {
            
            // GETS NEW SELECTED VALUE
            var newSelVal = jQuery(this).children('option:selected').text();
            
            // UPDATES BOX
            jQuery(this).siblings('span.select-container').text(newSelVal);
            
        });
        
    }); 
            
        }
 
    jQuery(window).load(function() {
        
        
          // cache container
var container = jQuery('.page-template-template-classes-php .dd_classes_widget, .archive .dd_classes_widget, .page-template-template-trainers-php .dd_trainers_widget , .archive .dd_trainers_widget');
// initialize isotope
container.isotope({
  // options...
    itemSelector : '.one-third',
    layoutMode : 'masonry'
});


// filter items when filter link is clicked
jQuery('#reset a').click(function(){
  var selector = jQuery(this).attr('data-filter');
  container.isotope({ filter: selector });
  return false;
});
    

   jQuery('ul.sf-menu').superfish(); 
   jQuery('.sliderWrapper').fadeIn(); 

   jQuery("body").css("overflow", "hidden");
   
   
     var t=setTimeout(function(){
               
                   jQuery("body").css("overflow", "auto");
                 whiteBar();
           },100)
           
topBarBtn();
mobileMenu();
select();
prettyPhoto();

       
    });
    
    
    jQuery(window).resize(function() {
       
       jQuery('.reset').click();
   whiteBar();
        
      
    });

});
