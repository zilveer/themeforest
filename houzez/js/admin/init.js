jQuery(document).ready(function($) {

    $('#post-formats-select input').change(checkpostFormat);
    $('#page_template').change(checkTemplate);
    $('#fave_header_type, #fave_floor_plans_enable, #fave_additional_features_enable').change(checkPageSettings);
    $('#fave_page_sidebar').change(checkDefaultTemplateSettings);
    $('#fave_adv_search_enable').change( advancedSearch );
    //$('#fave_listings_tabs').change( TabsShowHide );

    $('#authordiv h2 span').empty();
    $('#authordiv h2 span').append('Assign Property to User');

    function checkpostFormat(){
        var format = $('#post-formats-select input:checked').attr('value');

        //only run on the posts page
        if(typeof format != 'undefined'){
            
            $('#post-body div[id^=fave_format_]').hide();
            $('#post-body #fave_format_'+format+'').stop(true,true).fadeIn(500);
        }
    }


    function checkTemplate() {

        var template = jQuery('#page_template').attr('value');

        if( template == 'template/property-listing-template.php' || template == 'template/property-listing-template-style2.php' || template == 'template/property-listing-fullwidth.php' || template == 'template/property-listing-style2-fullwidth.php' ) {
            jQuery('#fave_listing_template').stop(true,true).fadeIn(500);

        } else {
            jQuery('#fave_listing_template').hide();
        }

        if( template == 'template/template-splash.php' || template == 'template/template-blank.php' || template == 'template/property-listings-map.php' ) {
            jQuery('#fave_page_settings, #fave_menu_settings').hide();
        } else {
            jQuery('#fave_page_settings, #fave_menu_settings').stop(true,true).fadeIn(500);
        }

        if( template == 'template/template-page.php' || template == 'template/template-idx.php' ) {
            jQuery('#fave_default_template_settings').stop(true,true).fadeIn(500);
        } else {
            jQuery('#fave_default_template_settings').hide();
        }
        if( template == 'template/template-agents.php' ) {
            jQuery('#fave_agents_template').stop(true,true).fadeIn(500);
        } else {
            jQuery('#fave_agents_template').hide();
        }

    }

    $('#fave_default_template_settings .inside .rwmb-meta-box > div:gt(0):lt(2)').wrapAll('<div id="default_template_background_option">');
    $('#fave_advanced_search .inside .rwmb-meta-box > div:gt(0):lt(2)').wrapAll('<div id="fave_advanced_search_option">');

    $('#fave_page_settings .inside .rwmb-meta-box > div:gt(0):lt(1)').wrapAll('<div id="page_header_fix_screen_settings">');
    $('#fave_page_settings .inside .rwmb-meta-box > div:gt(1):lt(3)').wrapAll('<div id="page_header_common_settings">');
    $('#fave_page_settings .inside .rwmb-meta-box > div:gt(2):lt(1)').wrapAll('<div id="page_header_slider_settings">');
    $("#fave_page_settings .inside .rwmb-meta-box > div:gt(3):lt(4)").wrapAll('<div id="page_header_image_settings">');
    $("#fave_page_settings .inside .rwmb-meta-box > div:gt(4):lt(6)").wrapAll('<div id="page_header_video_settings">');
    $("#fave_page_settings .inside .rwmb-meta-box > div:gt(5):lt(7)").wrapAll('<div id="page_header_map_settings">');

    $("#additional-details .inside .rwmb-meta-box > div:gt(0):lt(1)").wrapAll('<div id="additional_details_settings">');
    $("#floor-plans .inside .rwmb-meta-box > div:gt(0):lt(1)").wrapAll('<div id="floor_plans_settings">');

    $("#fave_listing_template .inside .rwmb-meta-box > div:gt(1):lt(1)").wrapAll('<div id="property_tabs">');

    function checkDefaultTemplateSettings() {
        var page_sidebar = jQuery('#fave_page_sidebar').attr('value');

        if( page_sidebar == 'none' ) {
            jQuery('#default_template_background_option').stop(true,true).fadeIn(500);
        } else {
            jQuery('#default_template_background_option').hide();
        }
    }

    function checkPageSettings() {
        var header_type = jQuery('#fave_header_type').attr('value');
        var fave_floor_plans_enable = jQuery('#fave_floor_plans_enable').attr('value');
        var fave_additional_features_enable = jQuery('#fave_additional_features_enable').attr('value');


        jQuery('#page_header_slider_settings, #page_header_image_settings, #page_header_video_settings, #page_header_common_settings, #floor_plans_settings, #additional_details_settings, #page_header_fix_screen_settings, #page_header_map_settings').hide();
        if( header_type == 'rev_slider' ) {
            jQuery('#page_header_slider_settings, #fave_menu_settings').stop(true,true).fadeIn(500);
            //jQuery('#page_header_fix_screen_settings').hide();

        } else if( header_type == 'static_image' ) {
            jQuery('#page_header_image_settings, #page_header_common_settings, #page_header_fix_screen_settings, #fave_menu_settings').stop(true,true).fadeIn(500);

        } else if( header_type == 'video' ) {
            jQuery('#page_header_video_settings, #page_header_common_settings, #page_header_fix_screen_settings, #fave_menu_settings').stop(true,true).fadeIn(500);

        } else if ( header_type == 'property_slider' ) {
            jQuery('#page_header_common_settings, #page_header_fix_screen_settings, #fave_menu_settings, #page_header_map_settings').hide();

        } else if ( header_type == 'property_map' ) {
            jQuery('#page_header_fix_screen_settings, #page_header_map_settings').stop(true,true).fadeIn(500);
            jQuery('#fave_menu_settings').hide();
        }

        //Floor Meta
        if( fave_floor_plans_enable == 'enable' ) {
            jQuery('#floor_plans_settings').stop(true,true).fadeIn(500);
        }

        // Additional Settings
        if( fave_additional_features_enable == 'enable' ) {
            jQuery('#additional_details_settings').stop(true, true).fadeIn(500);
        }
    }

    function advancedSearch() {
        var search = jQuery('#fave_adv_search_enable').attr('value');
        if( search == 'current_page' ) {
            jQuery('#fave_advanced_search_option').stop(true,true).fadeIn(500);
        } else {
            jQuery('#fave_advanced_search_option').hide();
        }
    }

    function TabsShowHide() {
        var tabs = jQuery('#fave_listings_tabs').attr('value');
        if( tabs == 'enable' ) {
            jQuery('#property_tabs').stop(true,true).fadeIn(500);
            jQuery("#fave_listing_template .inside .rwmb-meta-box > div:gt(5):lt(6) > .rwmb-column-last").hide();
        } else {
            jQuery('#property_tabs').hide();
            jQuery("#fave_listing_template .inside .rwmb-meta-box > div:gt(5):lt(6) > .rwmb-column-last").stop(true,true).fadeIn(500);
        }
    }

    jQuery(window).load(function(){ 
        checkpostFormat();
        checkTemplate();
        checkPageSettings();
        checkDefaultTemplateSettings();
        advancedSearch();
        //TabsShowHide();
    });

	
});