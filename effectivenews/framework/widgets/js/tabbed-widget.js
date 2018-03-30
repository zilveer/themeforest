jQuery(document).ready(function($){
        jQuery(".widget_momizattabber").each(function(){
        var ul = jQuery(this).find(".main_tabs ul.tabs");

        jQuery(this).find(".tab-content").each(function() {
            jQuery(this).find('a.mom-tw-title').wrap('<li></li>').parent().detach().appendTo(ul);
        });
    });
});