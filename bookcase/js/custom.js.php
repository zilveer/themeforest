/*-----------------------------------------------------------------------------------*/
/* Preloader & Initialize Masonry Script
/*-----------------------------------------------------------------------------------*/

// Set jQuery to NoConflict Mode
jQuery.noConflict();

<?php if (is_home() || is_page_template('taxonomy-skills.php')) { ?>

jQuery(document).ready(function($){
  $('#container').masonry({ //Call masonry plugin once loaded
	itemSelector : '.item',
    columnWidth : 260,
	isAnimated: !Modernizr.csstransitions 
    }); 
 });

/***********Load Individual Slides***************/                 
jQuery(".attachment-portfoliosmall").bind("load", 
 	function ($) { 
    	jQuery(this).css('visibility','visible').hide().fadeIn('slow', 
        	function() {  jQuery(this).parent(".portfoliopreload").css("background", "none");
            });
         }).each(function($) {
 			 if(this.complete) {  
             	jQuery(this).css('visibility','visible').hide().fadeIn('slow', 
                	function() {  jQuery(this).parent(".portfoliopreload").css("background", "none"); 
                    });
              }
});

/***********Load Individual Slides***************/                 
jQuery(".largeport").bind("load", 
 	function ($) { 
    	jQuery(this).css('visibility','visible').hide().fadeIn('slow', 
        	function() {  jQuery(this).parent(".videocontainer").css("background", "none");
            });
         }).each(function($) {
 			 if(this.complete) {  
             	jQuery(this).css('visibility','visible').hide().fadeIn('slow', 
                	function() {  jQuery(this).parent(".videocontainer").css("background", "none"); 
                    });
              }
});

(function($){  //Self Invoking Anonymous Function

 $(window).load(function(){ /*** Fix IE Stuff ***/
    $(".largeport").css('visibility','visible').hide().fadeIn('slow', function () {   
  		$(".videocontainer").delay(700).css("background", "none");
     });
 });
 })(jQuery);  

 <?php } ?>
/*-----------------------------------------------------------------------------------*/
/* Superfish Initialization
/*-----------------------------------------------------------------------------------*/


	jQuery(function($) { 
        $('ul.sf-menu').superfish({ 
            autoArrows:  true
        }); 
    }); 
		

/*-----------------------------------------------------------------------------------*/
/* Tabs
/*-----------------------------------------------------------------------------------*/
    if(jQuery() .tabs) {	 
		jQuery( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
		jQuery( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		jQuery( "#tabs" ).tabs({ fx: { opacity: 'toggle' } });
	};
	
/*-----------------------------------------------------------------------------------*/
/* Pretty Photo
/*-----------------------------------------------------------------------------------*/
	
	jQuery(function($){
	   $("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: false, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: '<?php  if ($ppskin = get_option('of_prettyphoto_skin')) { echo $ppskin; } else { echo 'light_square'; } ?>', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true
			});
	});
	
	
/*-----------------------------------------------------------------------------------*/
/* Hover Effects
/*-----------------------------------------------------------------------------------*/

       function hover_overlay() {
        
        jQuery('.postphoto img, .hover img, .lightboxhover img').hover( function() {
            jQuery(this).stop().animate({opacity : 0.2}, 500);
        }, function() {
            jQuery(this).stop().animate({opacity : 1}, 500);
        });
    }
    
    hover_overlay();

       function hover_overlay_slide() {
        
        jQuery('.video').hover( function() {
            jQuery(this).stop().animate({opacity : 1}, 100);
        }, function() {
            jQuery(this).stop().animate({opacity : .9}, 100);
        });
    }
    
    hover_overlay_slide();
    
   

/*-----------------------------------------------------------------------------------*/
/*  Custom Masonry Reaction Script by Andre Gagnon
/*-----------------------------------------------------------------------------------*/


var switcher = 'Z'; // Set a variable to say that no boxes are open

		function changer(letter, postid, height){
			
			if (switcher == 'Z') { //If no boxes are open	
			
				document.getElementById('itemdiv'+letter).style.width ='500px'; //make the itemdiv box 500px wide 
				document.getElementById('arrow'+letter).style.display ='inline'; //flash item div width and hieght for masonry
                $textHeight = jQuery('#arrow' +letter).children('.portfoliocontent').height(); //get the height of the text
                $divheight=Number($textHeight) + Number(height) + 60; //add text height to maximum image height + toggle buttons
                jQuery('#arrow' + letter).height($divheight); //Set div height before masonry
				jQuery('#container').masonry({ itemSelector : '.item', columnWidth : 260, isAnimated: !Modernizr.csstransitions});
               
                document.getElementById('itemdiv'+letter).style.width ='500px';
                
				document.getElementById('arrow'+letter).style.display ='none'; //display:none; so we can fade in.

				jQuery('#arrow' + letter).delay(600).fadeIn('slow'); // Fade in the project	
							
				switcher = letter; // Tell the switcher that a box is open
				window.setTimeout(function() {jQuery('html,body').animate({scrollTop: jQuery(postid).offset().top}, 1000, 'easeOutCubic');}, 1000); // Scroll window to item div
			
			} else {

				document.getElementById(switcher).height ='155'; //change height of open image (before masonry)
				document.getElementById(switcher).width ='240';//change width of open image (before masonry)
				document.getElementById('itemdiv'+switcher).style.width ='240px'; //Change width of open container (before masonry)
				
				jQuery('#arrow' + switcher).fadeOut('fast', function(){ //fade out open content container
						/* After Fadeout Open Box*/
						document.getElementById('itemdiv'+letter).style.width ='500px'; //Change width of clicked on container after fade out
						document.getElementById('arrow'+letter).style.display ='inline'; //flash the clicked-on div width and hieght for masonry
                        $textHeight = jQuery('#arrow' +letter).children('.portfoliocontent').height();
                        $divheight=Number($textHeight) + Number(height) + 60;
                		jQuery('#arrow' + letter).height($divheight);
						jQuery('#container').masonry({ itemSelector : '.item', columnWidth : 260, isAnimated: !Modernizr.csstransitions}); //run masonry
						document.getElementById('arrow'+letter).style.display ='none'; //display none
						jQuery('#arrow' + letter).delay(600).fadeIn('slow')  // fade in new div after .6 seconds
						/* After Fadeout Open Box*/
						});
				
				switcher = letter;  //Let the function know a box is open
				window.setTimeout(function() {$('html,body').animate({scrollTop: $(postid).offset().top}, 1000, 'easeOutCubic');}, 1000); //Scroll window to the div box
				}
			}
			
			function xout(letter, postid) {
				document.getElementById(letter).height ='155';
				document.getElementById(letter).width ='240';
				document.getElementById(switcher).style.display ='inline';
				document.getElementById('itemdiv'+letter).style.width ='240px';
				jQuery('#arrow' + letter).fadeOut('fast', function() {
				jQuery('#container').masonry({ itemSelector : '.item', columnWidth : 260, isAnimated: !Modernizr.csstransitions});
						switcher = 'Z'; //Let the function know that no windows are open
					        								  });
				// window.setTimeout(function() {$('html,body').animate({scrollTop: $(postid).offset().top}, 1000, 'easeOutCubic');}, 1000);
				} 
       
       onComplete = function() {
       alert('doing it');
       }         
                
var boxCount = jQuery('#container').find('.item').size(), //find out what this is

    counter = 0,
    onComplete1 = function() {
    alert(boxCount);
        if (counter < boxCount) { 
        counter++;
        } else {
        window.setTimeout(function() {jQuery('html,body').animate({scrollTop: jQuery(postid).offset().top}, 1000, 'easeOutCubic');}, 500);
            alert("Finished?");
            counter = 0;
        }
    }
 
/*-----------------------------------------------------------------------------------*/
/*  Portfolio Mini Cycle Slideshow
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function($) {	
	$('.pics').each(function() {
	    var $nav = $('<div class="navtoggle"></div>').insertAfter(this);
        var $this = $(this);
        $this.cycle({
            speed:    300,
            <?php  if ($autoplay = get_option('of_autoplay')) { if ($delay = get_option('of_autoplay_delay')) { if ($autoplay == 'true') { echo 'timeout:'.$delay.','; } else { echo 'timeout:0,';}}}?>
    		pager:  $nav,
			pauseOnPagerHover: true,
			fx: 'fade',
			pause:         true,
            
            // use slideshow as the transition trigger
            next:     $this,
			
            before:    function(curr,next,opts) {
				var $ht = $(this).height();
				$(this).parent().animate({height: $ht});
				 
				 
            }
        });
		
		
    });
});



	

/*-----------------------------------------------------------------------------------*/
/*  Scroll to Top by Andre Gagnon
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function($) {
						   
$(window).scroll(function () {
						   
 	var y_scroll_pos = window.pageYOffset;
    var scroll_pos_test = 50;             // set to whatever you want it to be
	
    if(y_scroll_pos > scroll_pos_test) {
        $('.top').fadeIn(1000);
        $('.iphone').children('.top').css('display', 'none !important');
		} else { $('.top').fadeOut(500);
         }
	});

	$('.top').click(function(){
			
			$('html, body').animate({scrollTop:0}, 500, 'easeOutCubic');
			return false;
	});
});


/*-----------------------------------------------------------------------------------*/
/*  Footer Widgets Drawer by Andre Gagnon
/*-----------------------------------------------------------------------------------*/
    
  jQuery(function($) {
	var height = $('#footer_content').height();
	$('#footer_button').click(function() {
		var docHeight = $(document).height();
		var windowHeight = $(window).height();
		var scrollPos = docHeight - windowHeight + height;
		$('#footer_content').animate({ height: "toggle"}, 500, 'easeOutCubic');
        $('#toggle_button').toggleClass("downarrow");
        jQuery('#footerbutton').removeClass('active');
					jQuery(this).addClass('active');
	});
});

/*-----------------------------------------------------------------------------------*/
/* Coda Slider
/*-----------------------------------------------------------------------------------*/
if(jQuery().codaSlider){
       jQuery('#coda-slider-1').codaSlider({
           dynamicArrows: false,
           dynamicTabs: false
       });
}
 
/*-----------------------------------------------------------------------------------*/
/* Form Validation
/*-----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function($){
	$("#contactform").validate();
	$("#quoteform").validate();
	$("#quickform").validate();
    $("#commentsubmit").validate();
});