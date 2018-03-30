/*
    tagDiv wp-admin js
    used on posts meta options and in different places in the theme
 */


//init the variable if it's undefined, sometimes wordpress will not run the wp_footer hooks in wp-admin (in modals for example)
if (typeof td_get_template_directory_uri === 'undefined') {
    td_get_template_directory_uri = '';
}


function td_widget_attach_color_picker() {
    //hide all colorpickers
    jQuery('.td-color-picker-widget').hide();

    // tagdiv widget colorpicker
    jQuery('.widgets-php .td-color-picker-widget').each(function(){
        var $this = jQuery(this);
        var id = $this.attr('rel');
        $this.farbtastic('#' + id);
    });

    jQuery('.td-color-picker-field').click(function(){
        jQuery('#' + jQuery(this).data('td-w-color')).fadeIn();
    });


    jQuery(document).mousedown(function() {
        jQuery('.td-color-picker-widget').each(function() {
            var display = jQuery(this).css('display');
            if ( display == 'block' )
                jQuery(this).fadeOut();
        });
    });
}


function td_theme_update() {
    if (typeof tdUpdateAvailable !== undefined && tdUpdateAvailable !== null) {
        //appearance menu
        updateCount = ' <span class="update-plugins"><span class="plugin-count">1</span></span>';
        jQuery('#menu-appearance .wp-menu-name').append(updateCount);

        var themeContainer = jQuery('.theme.active'),
            themeScreenshot = themeContainer.find('.theme-screenshot');

        //theme notice
        if (themeScreenshot.length > 0) {
            var updateBanner = '<div class="update-ionmag notice inline notice-warning notice-alt"><p>New version available. <a target="_blank" href="' + tdUpdateUrl + '"><button class="button-link" type="button">Update now</button></a></p></div>';
            themeScreenshot.after(updateBanner);
        }
        //overlay single (when only one theme is available)
        var themeOverlay = jQuery('.theme-overlay.active .theme-author');
        if (themeOverlay.length > 0) {
            var overlayBanner = '<div class="notice notice-warning notice-alt notice-large"><h3 class="notice-title">Update Available</h3><p><strong>There is a new version of ionMag available. <a target="_blank" href="' + tdUpdateUrl + '">View version ' + tdUpdateAvailable + ' details</a> or <a target="_blank" href="' + tdUpdateUrl + '">update now</a>.</strong></p></div>';
            themeOverlay.after(overlayBanner);
        }
        //overlay general (when multiple themes are available)
        themeContainer.on('click', function() {
            setTimeout(function() {
                var overlayAuthor = jQuery('.theme-overlay .theme-author');
                if (overlayAuthor.length > 0) {
                    var overlayGeneral = '<div class="notice notice-warning notice-alt notice-large"><h3 class="notice-title">Update Available</h3><p><strong>There is a new version of ionMag available. <a target="_blank" href="' + tdUpdateUrl + '">View version ' + tdUpdateAvailable + ' details</a> or <a target="_blank" href="' + tdUpdateUrl + '">update now</a>.</strong></p></div>';
                    overlayAuthor.after(overlayGeneral);
                }
            }, 50);
        });
    }
}
document.addEventListener("DOMContentLoaded", td_theme_update);


jQuery().ready(function() {



    td_widget_attach_color_picker();

    //alert(td_get_template_directory_uri);


    /*  ----------------------------------------------------------------------------
        Sidebar manager
     */
    jQuery('.td_rename').click(function(event){
        event.preventDefault();
        jQuery('.td-modal').hide('fast');
        jQuery(jQuery(this).attr('href')).show('fast');
    });


    jQuery('.td_modal_cancel').click(function(event){
        event.preventDefault();
        jQuery('.td-modal').hide('fast');
    });








});



