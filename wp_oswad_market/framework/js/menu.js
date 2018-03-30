jQuery(document).ready(function(){
    if(jQuery('.nav_root li').length > 0){
        jQuery('.nav_root li:first-child').addClass('first');
        jQuery('.nav_root li:last-child').addClass('last');
    }
});

