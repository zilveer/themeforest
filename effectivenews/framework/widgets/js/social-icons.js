jQuery(document).ready( function($) {
        jQuery('.social_select_icons').on('change', function(){
                var wrap = jQuery(this).closest('p').siblings('.social-icons');
                wrap.children('p').hide();
                jQuery('option:selected',this).each(function(){
                        wrap.find('.social_icon_'+this.value).show();
                });
        });
});