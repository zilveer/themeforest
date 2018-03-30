<?php
add_action('init','of_options');

if (!function_exists('of_options'))
{

    function of_options()
    {

        /*
        *	Theme Shortname
        */
        $themename = "theme";
        $shortname = "theme";

        /*
        *	Populate the options array
        */
        global $tt_options;

        $tt_options = get_option('of_options');

        /*
        *	Access the WordPress Pages via an Array
        */
        $tt_pages = array();

        $tt_pages_obj = get_pages('sort_column=post_parent,menu_order');

        foreach ($tt_pages_obj as $tt_page)
        {
            $tt_pages[$tt_page->ID] = $tt_page->post_name;
        }

        $tt_pages_tmp = array_unshift($tt_pages, "Select a page:" );


        /*
        *	Access the WordPress Categories via an Array
        */
        $tt_categories = array();
        $tt_categories_obj = get_categories('hide_empty=0');
        foreach ($tt_categories_obj as $tt_cat)
        {
            $tt_categories[$tt_cat->term_id] = $tt_cat->name;
        }
        $categories_tmp = array_unshift($tt_categories, "Select a category:");

        /*
		*	Access the WordPress Tags via an Array
		*/
        $tags_array = array();
        $tags_objects = get_tags('hide_empty=0');
        foreach ($tags_objects as $tag_inst)
        {
            $tags_array[$tag_inst->term_id] = $tag_inst->name;
        }
        $tags_tmp = array_unshift($tags_array, __('Select a Tag','framework'));

        /*
		*	Access the property-feature terms via an Array
		*/
        $features_array = array();
        $features_terms = get_terms('property-feature');
        foreach ($features_terms as $feature_term){
            $features_array[$feature_term->slug] = $feature_term->name;
        }

        /*
        *	Access the property-status terms via an Array
        */
        $statuses_array = array();
        $status_terms = get_terms('property-status');
        foreach ($status_terms as $status_term){
            $statuses_array[$status_term->slug] = $status_term->name;
        }

        /*
        *	Access the property-city terms via an Array
        */
        $cities_array = array();
        $city_terms = get_terms('property-city');
        foreach ($city_terms as $city_term){
            $cities_array[$city_term->slug] = $city_term->name;
        }

        /*
        *	Access the property-type terms via an Array
        */
        $types_array = array();
        $type_terms = get_terms('property-type');
        foreach ($type_terms as $type_term){
            $types_array[$type_term->slug] = $type_term->name;
        }

        /*
        *	Numbers Array
        */
        $numbers_array = array("1","2","3","4","5","6","7","8","9","10");
		$numbers_array_zero = array("0","1","2","3","4","5","6","7","8","9","10");

        /*
        *	Sample Advanced Array - The actual value differs from what the user sees
        */
        $sample_advanced_array = array("image" => "The Image","post" => "The Post");

        /*
        *	Folder Paths for "type" => "images"
        */
        $sampleurl =  get_template_directory_uri() . '/framework/admin/images/sample-layouts/';


        /*-----------------------------------------------------------------------------------*/
        /* Create The Custom Theme Options Panel
        /*-----------------------------------------------------------------------------------*/
        $options = array(); // do not delete this line - sky will fall


        /* Option Page - Header Options */
        $options[] = array( "name" => __('Header','framework'),
            "id" => $shortname."_header_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Logo','framework'),
            "desc" => __('Upload logo for your Website.','framework'),
            "id" => $shortname."_sitelogo",
            "std" => "",
            "type" => "upload");

        $options[] = array( "name" => __('Favicon','framework'),
            "desc" => __('Upload a 16px by 16px PNG image that will represent your website favicon.','framework'),
            "id" => $shortname."_favicon",
            "std" => "",
            "type" => "upload");

        $options[] = array( "name" => __('Do you want to show social icons in header ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_social_menu",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Twitter','framework'),
            "desc" => __('Provide Twitter URL to display its icon.','framework'),
            "id" => $shortname."_twitter_link",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Facebook','framework'),
            "desc" => __('Provide Facebook URL to display its icon.','framework'),
            "id" => $shortname."_facebook_link",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Google Plus','framework'),
            "desc" => __('Provide Google Plus URL to display its icon.','framework'),
            "id" => $shortname."_google_link",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('LinkedIn','framework'),
            "desc" => __('Provide LinkedIn URL to display its icon.','framework'),
            "id" => $shortname."_linkedin_link",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('RSS','framework'),
            "desc" => __('Provide RSS URL to display its icon.','framework'),
            "id" => $shortname."_rss_link",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Instagram','framework'),
            "desc" => __('Provide Instagram URL to display its icon.','framework'),
            "id" => $shortname."_instagram_link",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('YouTube','framework'),
            "desc" => __('Provide YouTube URL to display its icon.','framework'),
            "id" => $shortname."_youtube_link",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Skype','framework'),
            "desc" => __('Provide Skype username to display its icon.','framework'),
            "id" => $shortname."_skype_username",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Pinterest','framework'),
            "desc" => __('Provide Pinterest URL to display its icon.','framework'),
            "id" => $shortname."_pinterest_link",
            "std" => "",
            "type" => "text");


        $options[] = array( "name" => __('Header Email','framework'),
            "desc" => __("Provide Email address to display in header.",'framework'),
            "id" => $shortname."_header_email",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Header Phone Number','framework'),
            "desc" => __("Provide phone number to display in header.",'framework'),
            "id" => $shortname."_header_phone",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Do you want a sticky header ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_sticky_header",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Tracking Code','framework'),
            "desc" => __('Paste Google Analytics (or other) tracking code here.','framework'),
            "id" => $shortname."_google_analytics",
            "std" => "",
            "type" => "textarea");


        /* Home Page Slider Options */
        $options[] = array( "name" => __('Home Slider','framework'),
            "id" => $shortname."_home_slider_heading",
            "type" => "heading");

        $options[] = array( "name" => __('What you want to display in area below header on homepage ?','framework'),
            "id" => $shortname . "_homepage_module",
            "std" => "properties-slider",
            "type" => "radio",
            "options" => array(
                'properties-slider' => __('Display Slider Based on Properties Custom Post Type','framework'),
                'slides-slider' => __('Display Slider Based on Slides Custom Post Type','framework'),
                'properties-map' => __('Display Google Map with Properties Markers','framework'),
                'simple-banner' => __('Display Simple Image Based Banner','framework'),
                'revolution-slider' => __('Display Slider Based on Slider Revolution Plugin.','framework')
            ));

        $options[] = array( "name" => __('Number of slides to display in Slider Based on Properties','framework'),
            "id" => $shortname."_number_of_slides",
            "std" => "3",
            "type" => "select",
            "options" => array(2,3,4,5,6,7,8,9,10));

        $options[] = array( "name" => __('Number of slides to display in Slider Based on Slides Custom Post Type','framework'),
            "id" => $shortname."_number_custom_slides",
            "std" => "3",
            "type" => "select",
            "options" => array(2,3,4,5,6,7,8,9,10));

        $options[] = array( "name" => __('Provide Revolution Slider Alias','framework'),
            "desc" => __('If you want to use Revolution Slider then provide its alias here.','framework'),
            "id" => $shortname."_rev_alias",
            "std" => '',
            "type" => "text");


        /* Home Page Search Options */
        $options[] = array( "name" => __('Home Search','framework'),
            "id" => $shortname."_home_search_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Note','framework'),
            "id" => $shortname."_search_callout",
            "std" => "It is better to configure search fields, Even if you do not want to use search form on homepage. As, the same configurations are used by property search widget.",
            "type" => "info");

        $options[] = array( "name" => __('Do you want to display property search form on Homepage ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_home_search",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('What you want to display in area below header on search results page ?','framework'),
            "id" => $shortname . "_search_module",
            "std" => "simple-banner",
            "type" => "radio",
            "options" => array(
                'properties-map' => __('Display Google Map with Resulted Properties Markers','framework'),
                'simple-banner' => __('Display Simple Image Based Banner','framework')
            ));

        $options[] = array( "name" => __('Advance Search Form Title','framework'),
            "desc" => __('Provide Advance Search Form title.','framework'),
            "id" => $shortname."_home_advance_search_title",
            "std" => __('Find your Home','framework'),
            "type" => "text");

        $options[] = array( "name" => __('Search Page URL','framework'),
            "desc" => __('To Configure The Search Functionality. Create a Property Search Page Using Property Search Template and Provide its URL here.(Also, Make sure to Configure Permalinks)','framework'),
            "id" => $shortname."_search_url",
            "std" => '',
            "type" => "text");

        $options[] = array( "name" => __('Select the search fields that you want to display in search form.','framework'),
            "id" => $shortname."_search_fields",
            "std" => array(
                'keyword-search', 'property-id', 'location', 'status', 'type', 'min-beds', 'min-baths', 'min-max-price', 'min-max-area', 'features'
            ),
            "type" => "multicheck",
            "options" => array(
                'keyword-search' => __('Keyword Search','framework'),
                'property-id' => __('Property ID','framework'),
                'location' => __('Property Location','framework'),
                'status' => __('Property Status','framework'),
                'type' => __('Property Type','framework'),
                'min-beds' => __('Min Beds','framework'),
                'min-baths' => __('Min Baths','framework'),
                'min-max-price' => __('Min and Max Price','framework'),
                'min-max-area' => __('Min and Max Area','framework'),
                'features' => __('Property Features','framework'),
            ));

        $options[] = array( "name" => __('Note','framework'),
            "id" => $shortname."_location_callout",
            "std" => __('In case of 1 location box: all locations will be listed in 1st select box. In case 2 or more: each select box will list parent of a level that matches its number and all the remaining children levels will be listed in last select box.','framework'),
            "type" => "info");

        $options[] = array( "name" => __('Number of Location Select Boxes to Display in Search Form','framework'),
            "desc" => '',
            "id" => $shortname."_location_select_number",
            "std" => "1",
            "type" => "select",
            "options" => array( 1, 2, 3, 4 )
        );

        $options[] = array(
            "name" => __('Title for 1st Location Select Box','framework'),
            "desc" => __("Example: Country",'framework'),
            "id" => $shortname."_location_title_1",
            "std" => "",
            "type" => "text"
        );

        $options[] = array(
            "name" => __('Title for 2nd Location Select Box','framework'),
            "desc" => __("Example: State",'framework'),
            "id" => $shortname."_location_title_2",
            "std" => "",
            "type" => "text"
        );

        $options[] = array(
            "name" => __('Title for 3rd Location Select Box','framework'),
            "desc" => __("Example: City",'framework'),
            "id" => $shortname."_location_title_3",
            "std" => "",
            "type" => "text"
        );

        $options[] = array(
            "name" => __('Title for 4th Location Select Box','framework'),
            "desc" => __("Example: Area",'framework'),
            "id" => $shortname."_location_title_4",
            "std" => "",
            "type" => "text"
        );

        $options[] = array( "name" => __('Do you want to sort Locations in select boxes alphabetically ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_locations_order",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Measurement unit to display with Min and Max Area fields.','framework'),
            "desc" => __("Example: Sq Ft",'framework'),
            "id" => $shortname."_area_unit",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Number of Properties to display on Property Search Template','framework'),
            "desc" => '',
            "id" => $shortname."_properties_on_search",
            "std" => "4",
            "type" => "select",
            "options" => array(2,4,6,8,10,12,14,16,18,20));


        /* Home Page Other Options */
        $options[] = array( "name" => __('Home Others','framework'),
            "id" => $shortname."_home_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Do you want to display Slogan and Properties section on Homepage ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_home_properties",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Slogan Title','framework'),
            "desc" => __("Slogan title  will appear on Homepage below slider.",'framework'),
            "id" => $shortname."_slogan_title",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Slogan Text','framework'),
            "desc" => __("Slogan text  will appear on Homepage below slider.",'framework'),
            "id" => $shortname."_slogan_text",
            "std" => "",
            "type" => "textarea");

        $options[] = array( "name" => __('What Properties you want to display on Homepage ?','framework'),
            "id" => $shortname."_home_properties",
            "std" => "recent",
            "type" => "radio",
            "options" => array(
                'recent' => __('Recent Properties','framework'),
                'featured' => __('Featured Properties','framework'),
                'based-on-selection' => __('Properties based on selected Types, Statuses and Cities.','framework')
            ));

        $options[] = array( "name" => __('Select Property Types','framework'),
            "id" => $shortname."_types_for_homepage",
            "type" => "multicheck",
            "options" => $types_array);

        $options[] = array( "name" => __('Select Property Statuses','framework'),
            "id" => $shortname."_statuses_for_homepage",
            "type" => "multicheck",
            "options" => $statuses_array);

        $options[] = array( "name" => __('Select Property Cities','framework'),
            "id" => $shortname."_cities_for_homepage",
            "type" => "multicheck",
            "options" => $cities_array);

        $options[] = array( "name" => __('Sort Properties By ?','framework'),
            "id" => $shortname."_sorty_by",
            "std" => "recent",
            "type" => "radio",
            "options" => array(
                'recent' => __('Time - Recent First','framework'),
                'low-to-high' => __('Price - Low to High','framework'),
                'high-to-low' => __('Price - High to Low','framework')
            ));

        $options[] = array( "name" => __('Number of Properties to display on Homepage','framework'),
            "id" => $shortname."_properties_on_home",
            "std" => "4",
            "type" => "select",
            "options" => array(2,4,6,8,10,12,14,16,18,20));

        $options[] = array( "name" => __('Do you want to enable Ajax pagination on Homepage ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_ajax_pagination_home",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Do you want to display Featured Properties on Homepage ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_featured_properties",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Featured Properties Title','framework'),
            "desc" => __('Provide Featured Properties Custom Title.','framework'),
            "id" => $shortname."_featured_prop_title",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Featured Properties Text','framework'),
            "desc" => __('Provide Featured Properties Custom Text.','framework'),
            "id" => $shortname."_featured_prop_text",
            "std" => "",
            "type" => "textarea");

        $options[] = array( "name" => __('Do you want to exclude Featured Properties from Recent Properties on Homepage ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_exclude_featured_properties",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Do you want to display News Posts on Homepage ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_news_posts",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('News Posts Title','framework'),
            "desc" => __('Provide News Posts Title','framework'),
            "id" => $shortname."_news_posts_title",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('News Posts Description Text','framework'),
            "desc" => __('Provide News Posts Description Text.','framework'),
            "id" => $shortname."_news_posts_text",
            "std" => "",
            "type" => "textarea");


        /* Property Options */
        $options[] = array( "name" => __('Property','framework'),
            "id" => $shortname."_property_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Select property detail page variation ?','framework'),
            "id" => $shortname . "_property_detail_variation",
            "desc" => __('When agent information will be displayed in sidebar then widget ready sidbar will not be available.','framework'),
            "std" => "default",
            "type" => "radio",
            "options" => array(
                'default' => __('Display agent information below Google Map','framework'),
                'agent-in-sidebar' => __('Display agent information in sidebar','framework'),
            ));

        $property_detail_option = __( 'Do you want to display %s on property detail page ?', 'framework' );

        $options[] = array( "name" => __('Additional Details Title','framework'),
            "id" => $shortname."_additional_details_title",
            "std" => __('Additional Details','framework'),
            "type" => "text");
		
        $options[] = array( "name" => sprintf( $property_detail_option, __('breadcrumbs','framework') ),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_property_breadcrumbs",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Breadcrumbs will be based on','framework'),
            "id" => $shortname."_breadcrumbs_taxonomy",
            "std" => "property-city",
            "type" => "radio",
            "options" => array(
                'property-city' => __( 'Property City', 'framework' ),
                'property-type' => __( 'Property Type', 'framework' ),
                'property-status' => __( 'Property Status', 'framework' ),
            ));

        $options[] = array( "name" => sprintf( $property_detail_option, __('a common note','framework') ),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_common_note",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Common Note Title','framework'),
            "id" => $shortname."_common_note_title",
            "std" => __('Note','framework'),
            "type" => "text");

        $options[] = array( "name" => __('Common Note','framework'),
            "desc" => __('Provide common note text. It will be displayed on all properties detail pages.','framework'),
            "id" => $shortname."_common_note",
            "std" => "",
            "type" => "textarea");

        $options[] = array( "name" => __('Features Title','framework'),
            "id" => $shortname."_property_features_title",
            "std" => __('Features','framework'),
            "type" => "text");

        $options[] = array( "name" => sprintf( $property_detail_option, __('video','framework') ),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_video",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Property Video Title','framework'),
            "id" => $shortname."_property_video_title",
            "std" => __('Property Video','framework'),
            "type" => "text");

        $options[] = array( "name" => sprintf( $property_detail_option, __('google map','framework') ),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_google_map",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Google Map Title','framework'),
            "id" => $shortname."_property_map_title",
            "std" => __('Property Map','framework'),
            "type" => "text");

        $options[] = array( "name" => sprintf( $property_detail_option, __('social share icons','framework') ),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_social_share",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => sprintf( $property_detail_option, __('property attachments','framework') ),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_attachments",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Property Attachments Title','framework'),
            "id" => $shortname."_property_attachments_title",
            "std" => __('Property Attachments','framework'),
            "type" => "text");

        $options[] = array( "name" => __('Child Properties Title','framework'),
            "id" => $shortname."_child_properties_title",
            "std" => __('Sub Properties','framework'),
            "type" => "text");

        $options[] = array( "name" => sprintf( $property_detail_option, __('agent information','framework') ),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_agent_info",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Do you want to receive the copy of message sent to agent ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_send_message_copy",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Email address to receive message copy','framework'),
            "desc" => __("This email address will receive a copy of message sent to agent from property detail page.",'framework'),
            "id" => $shortname."_message_copy_email",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => sprintf( $property_detail_option, __('similar properties','framework') ),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_similar_properties",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Similar Properties Title','framework'),
            "id" => $shortname."_similar_properties_title",
            "std" => __('Similar Properties','framework'),
            "type" => "text");

        $options[] = array( "name" => str_replace('display','add',sprintf( $property_detail_option, __('Open Graph Meta Tags','framework') )),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_add_meta_tags",
            "std" => "false",
            "type" => "checkbox");

        /* Option Page - News */
        $options[] = array( "name" => __('News','framework'),
            "type" => "heading");

        $options[] = array( "name" => __('Banner Title','framework'),
            "desc" => __('Provide the Banner Title for News Page.','framework'),
            "id" => $shortname.'_news_banner_title',
            "std" => __('News', 'framework'),
            "type" => "text");

        $options[] = array( "name" => __('Banner Sub Title','framework'),
            "desc" => __('Provide the Banner Sub Title for News Page.','framework'),
            "id" => $shortname.'_news_banner_sub_title',
            "std" => __('Check out market updates', 'framework'),
            "type" => "text");


        /* Option Page - Gallery */
        $options[] = array( "name" => __('Gallery','framework'),
            "type" => "heading");

        $options[] = array( "name" => __('Banner Title','framework'),
            "desc" => __('Provide the Banner Title for Gallery Pages.','framework'),
            "id" => $shortname.'_gallery_banner_title',
            "std" => __('Properties Gallery', 'framework'),
            "type" => "text");

        $options[] = array( "name" => __('Banner Sub Title','framework'),
            "desc" => __('Provide the Banner Sub Title for Gallery Pages.','framework'),
            "id" => $shortname.'_gallery_banner_sub_title',
            "std" => __('Look for your desired property more efficiently', 'framework'),
            "type" => "text");


        /* Option Page - Price Format Options */
        $options[] = array( "name" => __('Price Format','framework'),
            "id" => $shortname."_price_format",
            "type" => "heading");


        $options[] = array( "name" => __('Currency Sign','framework'),
            "desc" => __('Provide currency sign. For Example: $','framework'),
            "id" => $shortname."_currency_sign",
            "std" => "$",
            "type" => "text");

        $options[] = array( "name" => __('Position of Currency Sign in Price','framework'),
            "id" => $shortname."_currency_position",
            "std" => "before",
            "type" => "radio",
            "options" => array(
                'before' => __('Display currency sign before the numbers','framework'),
                'after' => __('Display currency sign after the numbers','framework')
            ));

        $options[] = array( "name" => __('Number of Decimals Points','framework'),
            "desc" => __('Provide the number of decimals points','framework'),
            "id" => $shortname."_decimals",
            "type" => "select",
            "options" => $numbers_array_zero);

        $options[] = array( "name" => __('Decimal Point Separator','framework'),
            "desc" => __('Provide the decimal point separator. For Example: .','framework'),
            "id" => $shortname."_dec_point",
            "std" => ".",
            "type" => "text");

        $options[] = array( "name" => __('Thousands Separator','framework'),
            "desc" => __('Provide the thousands separator. For Example: ,','framework'),
            "id" => $shortname."_thousands_sep",
            "std" => ",",
            "type" => "text");

        $options[] = array( "name" => __('Text to display when no price is provided.','framework'),
            "id" => $shortname."_no_price_text",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Minimum Prices List for Advance Search Form.','framework'),
            "desc" => __("Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.",'framework'),
            "id" => $shortname."_minimum_price_values",
            "std" => "1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000",
            "type" => "textarea");

        $options[] = array( "name" => __('Maximum Prices List for Advance Search Form.','framework'),
            "desc" => __("Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.",'framework'),
            "id" => $shortname."_maximum_price_values",
            "std" => "5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000",
            "type" => "textarea");

        $options[] = array( "name" => __('Rent Prices','framework'),
            "id" => $shortname."_price_callout",
            "std" => "Visitors expect smaller values for rent prices, So please provide the list of minimum and maximum rent prices below",
            "type" => "info");

        $options[] = array( "name" => __('Select the Appropriate Rent Status','framework'),
            "id" => $shortname."_status_for_rent",
            "desc" => __("The rent prices will be displayed based on selected status.",'framework'),
            "type" => "radio",
            "std" => "for-rent",
            "options" => $statuses_array);

        $options[] = array( "name" => __('Minimum Prices List for Rent Only.','framework'),
            "desc" => __("Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.",'framework'),
            "id" => $shortname."_minimum_price_values_for_rent",
            "std" => "500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000",
            "type" => "textarea");

        $options[] = array( "name" => __('Maximum Prices List for Rent Only.','framework'),
            "desc" => __("Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.",'framework'),
            "id" => $shortname."_maximum_price_values_for_rent",
            "std" => "1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000",
            "type" => "textarea");

        /* Option Page - Currency Switcher */
        if ( class_exists( 'WP_Currencies' ) ) {    // if wp-currencies plugins is active

            // get all currency codes
            $currencies = get_currencies();
            $currency_codes = array();
            if ( 0 < count( $currencies ) ) {
                foreach( $currencies as $currency_code => $currency ) {
                   $currency_codes[] = $currency_code;
                }
            }

            $options[] = array(
                "name" => __('Currency Switcher','framework'),
                "id" => $shortname."_currency_switcher_heading",
                "type" => "heading");

            $options[] = array( "name" => __('About Currencies','framework'),
                "id" => $shortname."_about_currencies",
                "std" => 'You can find the full list of available currencies at <a target="_blank" href="https://openexchangerates.org/currencies">https://openexchangerates.org/currencies</a>',
                "type" => "info");

            $options[] = array(
                "name" => __('Base Currency','framework'),
                "desc" => __('Selected currency will be used as base currency for all conversions.','framework'),
                "id" => $shortname."_base_currency",
                "std" => "USD",
                "type" => "select",
                "options" => $currency_codes
            );

            $options[] = array(
                "name" => __('Currencies you want to support.','framework'),
                "desc" => __("Only provide comma separated list of currency codes in capital letters. Do not add dashes, spaces or currency signs.",'framework'),
                "id" => $shortname."_supported_currencies",
                "std" => "AUD,CAD,CHF,EUR,GBP,HKD,JPY,NOK,SEK,USD",
                "type" => "textarea");

            $options[] = array(
                "name" => __('Expiry time for switched currency','framework'),
                "desc" => __('Select the expiry period for switched currency.','framework'),
                "id" => $shortname."_currency_expiry",
                "std" => '3600',
                "type" => "radio",
                "options" => array(
                    '3600' => __('One Hour','framework'),
                    '86400' => __('One Day','framework'),
                    '604800' => __('One Week','framework'),
                    '18144000' => __('One Month','framework'),
                )
            );

        }


        /* Option Page - General */
        $options[] = array( "name" => __('General','framework'),
            "id" => $shortname."_general_heading",
            "type" => "heading");

        $options[] = array( "name" => __('What you want to display in area below header on Listing & Taxonomy pages ?','framework'),
            "id" => $shortname . "_listing_module",
            "std" => "simple-banner",
            "type" => "radio",
            "options" => array(
                'properties-map' => __('Display Google Map with Properties Markers','framework'),
                'simple-banner' => __('Display Simple Image Based Banner','framework')
            ));

        $options[] = array( "name" => __('Do you want to disable title and subtitle from image based banner ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_banner_titles",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Select the default listing layout for listing & taxonomy pages.','framework'),
            "id" => $shortname."_listing_layout",
            "std" => "list",
            "type" => "radio",
            "options" => array(
                'list' => __('List Layout','framework'),
                'grid' => __('Grid Layout','framework')
            ));

        $options[] = array( "name" => __('Select the number of properties to display on listing & taxonomy pages.','framework'),
            "desc" => '',
            "id" => $shortname."_number_of_properties",
            "std" => "3",
            "type" => "select",
            "options" => array(3,6,9,12,15,18,21,24,27));

        $options[] = array( "name" => __('Select the default sorting for search, listing & taxonomy Pages ?','framework'),
            "id" => $shortname."_listing_default_sort",
            "std" => "date-desc",
            "type" => "radio",
            "options" => array(
                'price-asc' => __('Price - Low to High','framework'),
                'price-desc' => __('Price - High to Low','framework'),
                'date-asc' => __('Date - Old to New','framework'),
                'date-desc' => __('Date - New to Old','framework'),
            ));

        $options[] = array( "name" => __('Number of Posts to display on Agent Listing Template.','framework'),
            "desc" => '',
            "id" => $shortname."_number_posts_agent",
            "std" => "3",
            "type" => "select",
            "options" => array(3,6,9,12,15,18,21,24,27));

        $options[] = array( "name" => __('Select the number of properties to display on Agent detail page.','framework'),
            "desc" => '',
            "id" => $shortname."_number_of_properties_agent",
            "std" => "6",
            "type" => "select",
            "options" => array(3,6,9,12,15,18,21,24,27));

        $options[] = array( "name" => __('Lightbox Plugin','framework'),
            "desc" => __('Select the lightbox plugin that you want to use','framework'),
            "id" => $shortname."_lightbox_plugin",
            "std" => "swipebox",
            "type" => "radio",
            "options" => array(
                'swipebox'      => __('Swipebox Plugin','framework'),
                'pretty-photo'  => __('Pretty Photo Plugin','framework')
            ));

        $options[] = array( "name" => __('Do you want to display reCAPTCHA in contact forms ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_reCAPTCHA",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('reCAPTCHA Public Key','framework'),
            "desc" => __('Get reCAPTCHA public and private keys for your website by <a href="https://www.google.com/recaptcha/admin#whyrecaptcha" target="_blank">signing up here</a> ','framework'),
            "id" => $shortname."_recaptcha_public_key",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('reCAPTCHA Private Key','framework'),
            "id" => $shortname."_recaptcha_private_key",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Do you want to display WPML language switcher in top header ?','framework'),
            "desc" => __('Yes - ( WPML Plugin Required )','framework'),
            "id" => $shortname."_wpml_lang_switcher",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Do you want to localize Google Map below header ?','framework'),
            "desc" => __('Yes - ( WPML Plugin Required )','framework'),
            "id" => $shortname."_map_localization",
            "std" => "true",
            "type" => "checkbox");


        /* Option Page - Contact */
        $options[] = array( "name" => __('Contact','framework'),
            "id" => $shortname."_contactus_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Do you want to show Google Map on contact page ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_contact_map",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Google Map Latitude','framework'),
            "desc" => 'You can use <a href="http://www.latlong.net/" target="_blank">latlong.net</a> &nbsp;OR&nbsp; <a href="http://itouchmap.com/latlong.html" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.',
            "id" => $shortname."_map_lati",
            "std" => "-37.817917",
            "type" => "text");

        $options[] = array( "name" => __('Google Map Longitude','framework'),
            "id" => $shortname."_map_longi",
            "std" => "144.965065",
            "type" => "text");

        $options[] = array( "name" => __('Google Map Zoom','framework'),
            "desc" => __("Provide Google Map Zoom Level. Example: 17",'framework'),
            "id" => $shortname."_map_zoom",
            "std" => "17",
            "type" => "text");

        $options[] = array( "name" => __('Do you want to show Contact Details Section on contact page ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_details",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Contact Details Section Title','framework'),
            "desc" => __("Provide Title for contact details section.",'framework'),
            "id" => $shortname."_contact_details_title",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Contact Address','framework'),
            "desc" => __("Provide address that will be displayed in contact details section.",'framework'),
            "id" => $shortname."_contact_address",
            "std" => "",
            "type" => "textarea");

        $options[] = array( "name" => __('Cell Number','framework'),
            "desc" => __("Provide Cell Number that will be displayed in contact details section.",'framework'),
            "id" => $shortname."_contact_cell",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Phone Number','framework'),
            "desc" => __("Provide Phone Number that will be displayed in contact details section.",'framework'),
            "id" => $shortname."_contact_phone",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Fax Number','framework'),
            "desc" => __("Provide Fax Number that will be displayed in contact details section.",'framework'),
            "id" => $shortname."_contact_fax",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Email Address','framework'),
            "desc" => __("Provide Email Address that will be displayed in contact details section.",'framework'),
            "id" => $shortname."_contact_display_email",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Contact Form Heading','framework'),
            "desc" => __("Provide heading for contact form.",'framework'),
            "id" => $shortname."_contact_form_heading",
            "std" => __("Send us a message", "framework"),
            "type" => "text");

        $options[] = array( "name" => __('Contact Email','framework'),
            "desc" => __("Provide target email address that will receive messages from contact form.",'framework'),
            "id" => $shortname."_contact_email",
            "std" => "",
            "type" => "text");



        /* Option Page - Footer */
        $options[] = array( "name" => __('Footer','framework'),
            "id" => $shortname."_footer_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Do you want to show Partners Carousel above footer ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_show_partners",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Partners Carousel Title ?','framework'),
            "desc" => __('Provide partners carousel title text.','framework'),
            "id" => $shortname."_partners_title",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Footer Copyright Text','framework'),
            "desc" => __("Enter Footer Copyright Text here.",'framework'),
            "id" => $shortname."_copyright_text",
            "std" => "",
            "type" => "textarea");

        $options[] = array( "name" => __('Footer Designed by Text','framework'),
            "desc" => __("Enter Footer Designed by Text here.",'framework'),
            "id" => $shortname."_designed_by_text",
            "std" => "",
            "type" => "textarea");



        /* Option Page - Members */
        $options[] = array( "name" => __('Members','framework'),
            "id" => $shortname."_members_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Do you want to enable header navigation for user Login and Register ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_enable_user_nav",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __('Login & Register Page URL (Optional)','framework'),
            "desc" => __('Create a Page Using Login & Register Template and Provide its URL here. Otherwise the login modal box will appear.','framework'),
            "id" => $shortname."_login_url",
            "std" => '',
            "type" => "text");


        $options[] = array(
            "name" => __( 'Restrict Admin Access','framework'),
            "desc" => __( 'Restrict admin access to any user level equal to or below the selected user level.','framework'),
            "id" => $shortname . "_restricted_level",
            "std" => "0",
            "type" => "radio",
            "options" => array(
                '0' => __( 'Subscriber ( Level 0 )','framework'),
                '1' => __( 'Contributor ( Level 1 )','framework'),
                '2' => __( 'Author ( Level 2 )','framework'),
                // '7' => __( 'Editor ( Level 7 )','framework'),
            ));

        $options[] = array( "name" => __('Profile Page URL','framework'),
            "desc" => __('Create a Page Using Edit Profile Template and Provide its URL here.','framework'),
            "id" => $shortname."_profile_url",
            "std" => '',
            "type" => "text");

        $options[] = array( "name" => __('Submit Property Page URL','framework'),
            "desc" => __('Create a Page Using Submit Property Template and Provide its URL here.','framework'),
            "id" => $shortname."_submit_url",
            "std" => '',
            "type" => "text");

        $options[] = array( "name" => __('Submitted Property Status','framework'),
            "desc" => __('Select the default status for submitted property.','framework'),
            "id" => $shortname."_submitted_status",
            "std" => "pending",
            "type" => "radio",
            "options" => array(
                'pending' => __('Pending ( Recommended )','framework'),
                'publish' => __('Publish','framework')
            ));

        $options[] = array( "name" => __('Default Address in Submit Form','framework'),
            "desc" => "",
            "id" => $shortname."_submit_default_address",
            "std" => '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
            "type" => "text");

        $options[] = array( "name" => __('Default Map Location (Latitude,Longitude) in Submit Form','framework'),
            "desc" => 'You can use <a href="http://www.latlong.net/" target="_blank">latlong.net</a> &nbsp;OR&nbsp; <a href="http://itouchmap.com/latlong.html" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.',
            "id" => $shortname."_submit_default_location",
            "std" => '25.7308309,-80.44414899999998',
            "type" => "text");

        $options[] = array( "name" => __('Message After Successful Submit ?','framework'),
            "desc" => "",
            "id" => $shortname."_submit_message",
            "std" => __('Thanks for Submitting Property!','framework'),
            "type" => "text");

        $options[] = array( "name" => __('Submit Notice Email','framework'),
            "desc" => __("This email address will receive a message when any user submits a property.",'framework'),
            "id" => $shortname."_submit_notice_email",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __( 'My Properties Page URL','framework' ),
            "desc" => __('Create a Page Using My Properties Template and Provide its URL here.','framework'),
            "id" => $shortname."_my_properties_url",
            "std" => '',
            "type" => "text");

        $options[] = array( "name" => __('Do you want to enable Add to Favorites button on property detail page ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_enable_fav_button",
            "std" => "true",
            "type" => "checkbox");

        $options[] = array( "name" => __( 'Favorite Properties Page URL','framework' ),
            "desc" => __('Create a Page Using Favorite Properties Template and Provide its URL here.','framework'),
            "id" => $shortname."_favorites_url",
            "std" => '',
            "type" => "text");



        /* Option Page - Payments */
        $options[] = array( "name" => __('Payments','framework'),
            "id" => $shortname."_paypal_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Do you want to enable PayPal payments for submitted property ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_enable_paypal",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __( 'PayPal IPN URL','framework' ),
            "desc" => __('Install "PayPal IPN for WordPress" plugin and get IPN URL from Settings > PayPal IPN.','framework'),
            "id" => $shortname . "_paypal_ipn_url",
            "std" => '',
            "type" => "text");

        $options[] = array( "name" => __('PayPal merchant account ID or Email ?','framework'),
            "id" => $shortname."_paypal_merchant_id",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Do you want to enable PayPal Sandbox for Testing ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_enable_sandbox",
            "std" => "false",
            "type" => "checkbox");

        /*$options[] = array( "name" => __('Do you want to disable SSL secure connection for post back ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_disable_ssl",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Email address to receive verified IPN Reports ?','framework'),
            "desc" => __('IPN(Instant Payment Notification) report will contain details about payment transaction.','framework'),
            "id" => $shortname."_valid_ipn_email",
            "std" => "",
            "type" => "text");

        $options[] = array( "name" => __('Email address to receive invalid IPN Reports ?','framework'),
            "id" => $shortname."_invalid_ipn_email",
            "std" => "",
            "type" => "text");
        */

        $options[] = array( "name" => __('Payment amount per property ?','framework'),
            "desc" => __('Provide the amount that you want to charge for one property. Example: 20.00','framework'),
            "id" => $shortname."_payment_amount",
            "std" => "20.00",
            "type" => "text");

        $options[] = array( "name" => __('Currency Code ?','framework'),
            "desc" => __('Provide the currency code that you want to use. Example: USD','framework'),
            "id" => $shortname."_currency_code",
            "std" => "USD",
            "type" => "text");

        $options[] = array( "name" => __('Automatically publish the submitted property on payment ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_publish_on_payment",
            "std" => "false",
            "type" => "checkbox");



        /* Option Page - Styling */
        $options[] = array( "name" => __('Styling','framework'),
            "id" => $shortname."_styling_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Body Background','framework'),
            "id" => $shortname."_background_callout",
            "std" => "This theme uses WordPress standard way to change body background. Please visit <strong>Appearance &gt; Background</strong> page to change body background.",
            "type" => "info");

        $options[] = array( "name" => __('Do you want to disable responsive styles ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_disable_responsive",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Quick CSS','framework'),
            "desc" => __('Just want to do some quick CSS changes? Enter them here, they will be applied to the theme. If you need to change major portions of the theme please use the custom.css file in css folder. In case you are using child theme, then please use child-custom.css file in child theme.','framework'),
            "id" => $shortname."_quick_css",
            "std" => "",
            "type" => "textarea");



        /* Option Page - Header - Styles */
        $options[] = array( "name" => __('Header - Styles','framework'),
            "id" => $shortname."_header_styles_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Header Background Color','framework'),
            "desc" => __('Choose a background color for Header. Base theme color is #252A2B.','framework'),
            "id" => $shortname."_header_bg_color",
            "std" => "#252A2B",
            "type" => "color");

        $options[] = array( "name" => __('Logo Text Color','framework'),
            "desc" => __('Choose a color for logo text. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_logo_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Logo Text Hover Color','framework'),
            "desc" => __('Choose a color for logo text hover. Base theme color is #4dc7ec.','framework'),
            "id" => $shortname."_logo_text_hover_color",
            "std" => "#4dc7ec",
            "type" => "color");

        $options[] = array( "name" => __('Tagline Text Color','framework'),
            "desc" => __('Choose a color for tagline text. Base theme color is #8b9293.','framework'),
            "id" => $shortname."_tagline_text_color",
            "std" => "#8b9293",
            "type" => "color");

        $options[] = array( "name" => __('Tagline Background Color','framework'),
            "desc" => __('Choose a background color for tagline. Base theme color is #343a3b.','framework'),
            "id" => $shortname."_tagline_bg_color",
            "std" => "#343a3b",
            "type" => "color");

        $options[] = array( "name" => __('Header Text Color','framework'),
            "desc" => __('Choose a a color for header text. Base theme color is #929A9B.','framework'),
            "id" => $shortname."_header_text_color",
            "std" => "#929A9B",
            "type" => "color");

        $options[] = array( "name" => __('Header Links Hover Color','framework'),
            "desc" => __('Choose a color for header links. Base theme color is #b0b8b9.','framework'),
            "id" => $shortname."_header_link_hover_color",
            "std" => "#b0b8b9",
            "type" => "color");

        $options[] = array( "name" => __('Header Borders Color','framework'),
            "desc" => __('Choose a color for header borders. Base theme color is #343A3B.','framework'),
            "id" => $shortname."_header_border_color",
            "std" => "#343A3B",
            "type" => "color");

        $options[] = array( "name" => __('Main Menu Text Color','framework'),
            "desc" => __('Choose a color for main menu text. Base theme color is #afb4b5.','framework'),
            "id" => $shortname."_main_menu_text_color",
            "std" => "#afb4b5",
            "type" => "color");

        $options[] = array( "name" => __('Drop Down Menu Background Color','framework'),
            "desc" => __('Choose a background color for drop down menu. Base theme color is #ec894d.','framework'),
            "id" => $shortname."_menu_bg_color",
            "std" => "#ec894d",
            "type" => "color");

        $options[] = array( "name" => __('Drop Down Menu Text Color','framework'),
            "desc" => __('Choose a color for drop down menu text. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_menu_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Drop Down Menu Background Color on Mouse Over','framework'),
            "desc" => __('Choose a background color for drop down menu on mouse over. Base theme color is #dc7d44.','framework'),
            "id" => $shortname."_menu_hover_bg_color",
            "std" => "#dc7d44",
            "type" => "color");

        $options[] = array( "name" => __('Header Phone Number Background Color','framework'),
            "desc" => __('Choose a background color for header phone number. Base theme color is #4dc7ec.','framework'),
            "id" => $shortname."_phone_bg_color",
            "std" => "#4dc7ec",
            "type" => "color");

        $options[] = array( "name" => __('Header Phone Number Text Color','framework'),
            "desc" => __('Choose a color for header phone number text. Base theme color is #e7eff7.','framework'),
            "id" => $shortname."_phone_text_color",
            "std" => "#e7eff7",
            "type" => "color");

        $options[] = array( "name" => __('Header Phone Icon Background Color','framework'),
            "desc" => __('Choose a background color for header phone icon. Base theme color is #37b3d9.','framework'),
            "id" => $shortname."_phone_icon_bg_color",
            "std" => "#37b3d9",
            "type" => "color");

        $options[] = array( "name" => __('Header Banner Image','framework'),
            "desc" => __('Upload a banner image that has minimum height of 230px height and minimum width of 2000px.','framework'),
            "id" => $shortname."_general_banner_image",
            "std" => "",
            "type" => "upload");

        $options[] = array( "name" => __('Banner Title Color','framework'),
            "desc" => __('Choose a color for banner title. Base theme color is #394041.','framework'),
            "id" => $shortname."_banner_text_color",
            "std" => "#394041",
            "type" => "color");

        $options[] = array( "name" => __('Banner Title Background Color','framework'),
            "desc" => __('Choose a background color for banner title. Base theme color is #f5f4f3.','framework'),
            "id" => $shortname."_banner_title_bg_color",
            "std" => "#f5f4f3",
            "type" => "color");

        $options[] = array( "name" => __('Banner Sub Title Color','framework'),
            "desc" => __('Choose a color for banner sub title. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_banner_sub_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Banner Sub Title Background Color','framework'),
            "desc" => __('Choose a background color for banner sub title. Base theme color is #37B3D9.','framework'),
            "id" => $shortname."_banner_sub_title_bg_color",
            "std" => "#37B3D9",
            "type" => "color");



        /* Option Page - Header - Styles */
        $options[] = array( "name" => __('Home - Styles','framework'),
            "id" => $shortname."_home_styles_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Slider Styles','framework'),
            "id" => $shortname."_slide_callout",
            "std" => "Color options related to slider are provided below",
            "type" => "info");

        $options[] = array( "name" => __('Slide Title Color','framework'),
            "desc" => __('Choose a color for slide title. Base theme color is #394041.','framework'),
            "id" => $shortname."_slide_title_color",
            "std" => "#394041",
            "type" => "color");

        $options[] = array( "name" => __('Slide Title Hover Color','framework'),
            "desc" => __('Choose a color for slide title hover. Base theme color is #df5400.','framework'),
            "id" => $shortname."_slide_title_hover_color",
            "std" => "#df5400",
            "type" => "color");

        $options[] = array( "name" => __('Slide Description Text Color','framework'),
            "desc" => __('Choose a color for description text in slide. Base theme color is #8b9293.','framework'),
            "id" => $shortname."_slide_desc_text_color",
            "std" => "#8b9293",
            "type" => "color");

        $options[] = array( "name" => __('Slide Price Color','framework'),
            "desc" => __('Choose a color for price text in slide. Base theme color is #df5400.','framework'),
            "id" => $shortname."_slide_price_color",
            "std" => "#df5400",
            "type" => "color");

        $options[] = array( "name" => __('Slide Know More Button Text Color','framework'),
            "desc" => __('Choose a color for know more button text in slide. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_slide_know_more_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Slide Know More Button Background Color','framework'),
            "desc" => __('Choose a background color for know more button in slide. Base theme color is #37b3d9.','framework'),
            "id" => $shortname."_slide_know_more_bg_color",
            "std" => "#37b3d9",
            "type" => "color");

        $options[] = array( "name" => __('Slide Know More Button Hover Background Color','framework'),
            "desc" => __('Choose a background color for know more button hover in slide. Base theme color is #2aa6cc.','framework'),
            "id" => $shortname."_slide_know_more_hover_bg_color",
            "std" => "#2aa6cc",
            "type" => "color");



        /* Option Page - Property Item - Styles */
        $options[] = array( "name" => __('Property Item - Styles','framework'),
            "id" => $shortname."_property_styles_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Property Item Background Color','framework'),
            "desc" => __('Choose a background color for property item. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_property_item_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Property Item Border Color','framework'),
            "desc" => __('Choose a color for property item border. Base theme color is #dedede.','framework'),
            "id" => $shortname."_property_item_border_color",
            "std" => "#dedede",
            "type" => "color");

        $options[] = array( "name" => __('Property Title Color','framework'),
            "desc" => __('Choose a color for property title. Base theme color is #394041.','framework'),
            "id" => $shortname."_property_title_color",
            "std" => "#394041",
            "type" => "color");

        $options[] = array( "name" => __('Property Title Hover Color','framework'),
            "desc" => __('Choose a color for property title hover. Base theme color is #df5400.','framework'),
            "id" => $shortname."_property_title_hover_color",
            "std" => "#df5400",
            "type" => "color");

        $options[] = array( "name" => __('Property Price Text Color','framework'),
            "desc" => __('Choose a color for property price text. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_property_price_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Property Price Background Color','framework'),
            "desc" => __('Choose a background color for property price. Base theme color is #4dc7ec.','framework'),
            "id" => $shortname."_property_price_bg_color",
            "std" => "#4dc7ec",
            "type" => "color");

        $options[] = array( "name" => __('Property Status Text Color','framework'),
            "desc" => __('Choose a color for property status text. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_property_status_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Property Status Background Color','framework'),
            "desc" => __('Choose a background color for property status. Base theme color is #ec894d.','framework'),
            "id" => $shortname."_property_status_bg_color",
            "std" => "#ec894d",
            "type" => "color");

        $options[] = array( "name" => __('Property Description Text Color','framework'),
            "desc" => __('Choose a color for property item description text. Base theme color is #8b9293.','framework'),
            "id" => $shortname."_property_desc_text_color",
            "std" => "#8b9293",
            "type" => "color");

        $options[] = array( "name" => __('More Details Text Color','framework'),
            "desc" => __('Choose a color for more details text. Base theme color is #394041.','framework'),
            "id" => $shortname."_more_details_text_color",
            "std" => "#394041",
            "type" => "color");

        $options[] = array( "name" => __('More Details Text Hover Color','framework'),
            "desc" => __('Choose a color for more details text. Base theme color is #df5400.','framework'),
            "id" => $shortname."_more_details_text_hover_color",
            "std" => "#df5400",
            "type" => "color");

        $options[] = array( "name" => __('Property Meta Text Color','framework'),
            "desc" => __('Choose a color for property meta. Base theme color is #394041.','framework'),
            "id" => $shortname."_property_meta_text_color",
            "std" => "#394041",
            "type" => "color");

        $options[] = array( "name" => __('Property Meta Background Color','framework'),
            "desc" => __('Choose a background color for property meta. Base theme color is #f5f5f5.','framework'),
            "id" => $shortname."_property_meta_bg_color",
            "std" => "#f5f5f5",
            "type" => "color");



        /* Option Page - General Styles */
        $options[] = array( "name" => __('General - Styles','framework'),
            "id" => $shortname."_general_styles_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Button Text Color','framework'),
            "desc" => __('Choose a color for button text. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_button_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Button Background Color','framework'),
            "desc" => __('Choose a background color for button. Base theme color is #ec894d.','framework'),
            "id" => $shortname."_button_bg_color",
            "std" => "#ec894d",
            "type" => "color");

        $options[] = array( "name" => __('Button Hover Text Color','framework'),
            "desc" => __('Choose a color for button hover text. Base theme color is #ffffff.','framework'),
            "id" => $shortname."_button_hover_text_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array( "name" => __('Button Hover Background Color','framework'),
            "desc" => __('Choose a background color for button hover. Base theme color is #e3712c.','framework'),
            "id" => $shortname."_button_hover_bg_color",
            "std" => "#e3712c",
            "type" => "color");



        /* Option Page - Footer Styles */
        $options[] = array( "name" => __('Footer - Styles','framework'),
            "id" => $shortname."_footer_styles_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Footer Widget Title Color','framework'),
            "desc" => __('Choose a color for widget title. Base theme color is #394041.','framework'),
            "id" => $shortname."_footer_widget_title_color",
            "std" => "#394041",
            "type" => "color");

        $options[] = array( "name" => __('Footer Text Color','framework'),
            "desc" => __('Choose a color for footer text. Base theme color is #8b9293.','framework'),
            "id" => $shortname."_footer_widget_text_color",
            "std" => "#8b9293",
            "type" => "color");

        $options[] = array( "name" => __('Footer Link Color','framework'),
            "desc" => __('Choose a color for widget links. Base theme color is #75797A.','framework'),
            "id" => $shortname."_footer_widget_link_color",
            "std" => "#75797A",
            "type" => "color");

        $options[] = array( "name" => __('Footer Link Hover Color','framework'),
            "desc" => __('Choose a color for widget link hover. Base theme color is #dc7d44.','framework'),
            "id" => $shortname."_footer_widget_link_hover_color",
            "std" => "#dc7d44",
            "type" => "color");

        $options[] = array( "name" => __('Footer Border Color','framework'),
            "desc" => __('Choose a color for footer border. Base theme color is #dedede.','framework'),
            "id" => $shortname."_footer_border_color",
            "std" => "#dedede",
            "type" => "color");

        $options[] = array( "name" => __('Do you want to disable footer background image ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_disable_footer_bg",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array( "name" => __('Footer Background Image','framework'),
            "desc" => __('Note: Default background image is 235px in height and 1770px in width.','framework'),
            "id" => $shortname."_footer_bg_img",
            "std" => "",
            "type" => "upload");



        $options = apply_filters('framework_theme_options',$options);

        update_option('of_template',$options);
        update_option('of_themename',$themename);
        update_option('of_shortname',$shortname);

    }
}

?>