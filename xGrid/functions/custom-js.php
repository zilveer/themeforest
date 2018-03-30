<?php
    /*
     * Slide Out Sidebar
     */
    if( bdayh_get_option( 'slide_out_sidebar_position' ) ==  'left' ){
        ?><script type="text/javascript">jQuery(".btn-nav-out").bind("click",function(){if(jQuery(this).hasClass("active")){jQuery(this).removeClass("active");jQuery(".btn-nav-out").removeClass("active");jQuery(".slide_out_sidebar_left .nav-out-bar").animate({left:"-300px"},50);jQuery("body").removeClass("out-bar-js");jQuery("#slide-overlay").empty().remove()}else{jQuery(this).addClass("active");jQuery(".btn-nav-out").addClass("active");jQuery(".slide_out_sidebar_left .nav-out-bar").animate({left:"0px"},100);jQuery("body").addClass("out-bar-js");jQuery("body").append('<div id="slide-overlay"></div>')}});</script><?php
    } else {
        ?><script type="text/javascript">jQuery(".btn-nav-out").bind("click",function(){if(jQuery(this).hasClass("active")){jQuery(this).removeClass("active");jQuery(".btn-nav-out").removeClass("active");jQuery(".nav-out-bar").animate({right:"-300px"},50);jQuery("body").removeClass("out-bar-js");jQuery("#slide-overlay").empty().remove()}else{jQuery(this).addClass("active");jQuery(".btn-nav-out").addClass("active");jQuery(".nav-out-bar").animate({right:"0px"},100);jQuery("body").addClass("out-bar-js");jQuery("body").append('<div id="slide-overlay"></div>')}});</script><?php
    }
?>