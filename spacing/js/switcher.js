/**
*
* Stylessheet switcher appearance script.
* By Tauris ( http://themeforest.net/user/Tauris/ )
*
**/

jQuery(document).ready(function(){
jQuery('.switch-button').click(function() {
	
	if (jQuery(this).is('.open')) {
			jQuery(this).addClass('closed');	
			jQuery(this).removeClass('open');
			jQuery('#switcher').animate({
				'left':'-178px'
			});
		} else {
			jQuery(this).addClass('open');	
			jQuery(this).removeClass('closed');	
			jQuery('#switcher').animate({
				'left':'0px'
			});
		}	
		
});

function checkSize(){
    if (jQuery(window).width() > 1100) {
        jQuery("#switcher").fadeIn(100);
    }else{
       jQuery("#switcher").fadeOut(100);
    }
}

checkSize();

jQuery(window).resize(function() {
    checkSize();
});

});

jQuery(document).ready(function() { 
      jQuery("#switch a").click(function() { 
         jQuery("link[data-id=5]").attr("href","http://thetauris.com/themes/spacing/wp-content/themes/spacing/css/schemes.php?color="+$(this).attr('data-color'));
         return false;
      });
	  jQuery("#switch2 a").click(function() { 
         jQuery("link[data-id=6]").attr("href","http://thetauris.com/themes/spacing/wp-content/themes/spacing/css/bg.php?bg="+$(this).attr('data-bg'));
         return false;
      });
   });