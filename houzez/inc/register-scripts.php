<?php
/**
 * Enqueue scripts and styles.
 */
function houzez_scripts() {
    global $paged, $post, $current_user;
    $property_lat = $property_map = $property_streetView = $is_singular_property = $header_type = $login_redirect = '';
    $property_lng = $google_map_needed = $fave_main_menu_trans = $header_map_selected_city = $fave_adv_search_enable = $current_template = '';
    $advanced_search_rent_status = $advanced_search_price_range_rent_status = 'for-rent';
    $content_has_map_shortcode = false;
    $max_file_size  = 100 * 1000 * 1000;
    wp_get_current_user();
    $userID = $current_user->ID;

    $houzez_logged_in = 'yes';
    if ( !is_user_logged_in() ) {
        $houzez_logged_in = 'no';
    }

    if( is_rtl() ) {
        $houzez_rtl = "yes";
    } else {
        $houzez_rtl = "no";
    }

    if ( isset( $_GET['sortby'] ) ) {
        $sort_by = $_GET['sortby'];
    }

    $houzez_default_radius = houzez_option('houzez_default_radius');
    if( isset( $_GET['radius'] ) ) {
        $houzez_default_radius = $_GET['radius'];
    }

    $houzez_primary_color = houzez_option('houzez_primary_color');

    $search_feature = array();
    $enable_radius_search = houzez_option('enable_radius_search');
    $search_result_page = houzez_option('search_result_page');
    $search_keyword = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
    $search_feature = isset($_GET['feature']) ? ($_GET['feature']) : '';
    $search_country = isset($_GET['country']) ? sanitize_text_field($_GET['country']) : '';
    $search_state = isset($_GET['state']) ? sanitize_text_field($_GET['state']) : '';
    $search_city = isset($_GET['location']) ? sanitize_text_field($_GET['location']) : '';
    $search_area = isset($_GET['area']) ? sanitize_text_field($_GET['area']) : '';
    $search_status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
    $search_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
    $search_bedrooms = isset($_GET['bedrooms']) ? sanitize_text_field($_GET['bedrooms']) : '';
    $search_bathrooms = isset($_GET['bathrooms']) ? sanitize_text_field($_GET['bathrooms']) : '';
    $search_min_price = isset($_GET['min-price']) ? sanitize_text_field($_GET['min-price']) : '';
    $search_max_price = isset($_GET['max-price']) ? sanitize_text_field($_GET['max-price']) : '';
    $search_min_area = isset($_GET['min-area']) ? sanitize_text_field($_GET['min-area']) : '';
    $search_max_area = isset($_GET['max-area']) ? sanitize_text_field($_GET['max-area']) : '';
    $search_publish_date = isset($_GET['publish_date']) ? sanitize_text_field($_GET['publish_date']) : '';
    $sort_by = isset($_GET['sortby']) ? sanitize_text_field($_GET['sortby']) : '';

    $search_location = isset( $_GET[ 'search_location' ] ) ? esc_attr( $_GET[ 'search_location' ] ) : false;
    $use_radius = 'on';
    $search_lat = isset($_GET['lat']) ? (float) $_GET['lat'] : false;
    $search_long = isset($_GET['lng']) ? (float) $_GET['lng'] : false;
    $search_radius = isset($_GET['radius']) ? (int) $_GET['radius'] : false;

    $geo_country_limit = houzez_option('geo_country_limit');
    $geocomplete_country = '';
    if( $geo_country_limit != 0 ) {
        $geocomplete_country = houzez_option('geocomplete_country');
    }

    // Retina Logos
    $simple_logo = houzez_option('custom_logo', '', 'url');
    $retina_logo_url = houzez_option( 'retina_logo', '', 'url' );
    $retina_mobilelogo_url = houzez_option( 'mobile_retina_logo', '', 'url' );
    $retina_splash_logo_url = houzez_option( 'retina_logo_splash', '', 'url' );
    $retina_logo_width = houzez_option( 'retina_logo_width' );
    $retina_logo_height = houzez_option( 'retina_logo_height' );
    $retina_logo_width = preg_replace('#[^0-9]#','',strip_tags($retina_logo_width));
    $retina_logo_height = preg_replace('#[^0-9]#','',strip_tags($retina_logo_height));

    if( !is_404() && !is_search() && !is_tax() ) {
        $header_type = get_post_meta($post->ID, 'fave_header_type', true);
        $content_has_map_shortcode = has_shortcode( get_post_field('post_content', $post->ID), 'houzez-properties-map' );
        $fave_main_menu_trans = get_post_meta( $post->ID, 'fave_main_menu_trans', true );
        $header_map_selected_city = get_post_meta( $post->ID, 'fave_map_city', false );
        $fave_adv_search_enable = get_post_meta( $post->ID, 'fave_adv_search_enable', true );
        $current_template = get_page_template_slug( $post->ID );
    }

    $property_top_area = houzez_option('prop-top-area');
    /* For demo purpose only */
    if( isset( $_GET['s_top'] ) ) {
        $property_top_area = $_GET['s_top'];
    }

    $keyword_field = houzez_option('keyword_field');
    $keyword_autocomplete = houzez_option('keyword_autocomplete');
    $advanced_search_rent_status_id = houzez_option('search_rent_status');
    $advanced_search_rent_status_id_price_range = houzez_option('search_rent_status_for_price_range');
    $measurement_unit_adv_search = houzez_option('measurement_unit_adv_search');
    if( $measurement_unit_adv_search == 'sqft' ) {
        $measurement_unit_adv_search = houzez_option('measurement_unit_sqft_text');
    } elseif( $measurement_unit_adv_search == 'sq_meter' ) {
        $measurement_unit_adv_search = houzez_option('measurement_unit_square_meter_text');
    }

    $thousands_separator = houzez_option('thousands_separator');

    if( taxonomy_exists('property_status') ) {
        $term_exist = get_term_by('id', $advanced_search_rent_status_id, 'property_status');
        if( $term_exist ) {
            $advanced_search_rent_status = get_term($advanced_search_rent_status_id, 'property_status');
            if (!is_wp_error($advanced_search_rent_status)) {
                $advanced_search_rent_status = $advanced_search_rent_status->slug;
            }
        }

        $term_exist_2 = get_term_by('id', $advanced_search_rent_status_id_price_range, 'property_status');
        if( $term_exist_2 ) {
            $advanced_search_price_range_rent_status = get_term($advanced_search_rent_status_id_price_range, 'property_status');
            if (!is_wp_error($advanced_search_price_range_rent_status)) {
                $advanced_search_price_range_rent_status = $advanced_search_price_range_rent_status->slug;
            }
        }

    }
    $currency_symbol = houzez_option('currency_symbol');
    $after_login_redirect = houzez_option('login_redirect');
    $googlemap_ssl = houzez_option('googlemap_ssl');
    $googlemap_api_key = houzez_option('googlemap_api_key');
    $googlemap_zoom_level = houzez_option('googlemap_zoom_level');
    $googlemap_pin_cluster = houzez_option('googlemap_pin_cluster');
    $googlemap_zoom_cluster = houzez_option('googlemap_zoom_cluster');
    $main_search_enable = houzez_option('main-search-enable');
    $year_built_calender = houzez_option('year_built_calender');

    $advanced_search_widget_min_price = houzez_option('advanced_search_widget_min_price');
    if( empty( $advanced_search_widget_min_price ) ) {
        $advanced_search_widget_min_price = '0';
    }
    $advanced_search_widget_max_price = houzez_option('advanced_search_widget_max_price');
    if( empty( $advanced_search_widget_max_price ) ) {
        $advanced_search_widget_max_price = '2500000';
    }


    $advanced_search_min_price_range_for_rent = houzez_option('advanced_search_min_price_range_for_rent');
    if( empty( $advanced_search_min_price_range_for_rent ) ) {
        $advanced_search_min_price_range_for_rent = '0';
    }
    $advanced_search_max_price_range_for_rent = houzez_option('advanced_search_max_price_range_for_rent');
    if( empty( $advanced_search_max_price_range_for_rent ) ) {
        $advanced_search_max_price_range_for_rent = '6000';
    }


    $advanced_search_widget_min_area = houzez_option('advanced_search_widget_min_area');
    if( empty( $advanced_search_widget_min_area ) ) {
        $advanced_search_widget_min_area = '0';
    }

    $advanced_search_widget_max_area = houzez_option('advanced_search_widget_max_area');
    if( empty( $advanced_search_widget_max_area ) ) {
        $advanced_search_widget_max_area = '600';
    }

    if( $after_login_redirect == 'same_page' ) {

        if( is_tax() ) {
            $login_redirect = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        } else {
            if( is_home() || is_front_page() ) {
                $login_redirect = site_url();
            } else {
                if( !is_404() && !is_search() ) {
                    $login_redirect = get_permalink($post->ID);
                }
            }
        }

    } else {
        $login_redirect = houzez_option('login_redirect_link');
    }

    if( is_singular('property') ) {
        $property_location = get_post_meta( get_the_ID(),'fave_property_location',true);
        if(!empty($property_location)){
            $lat_lng = explode(',',$property_location);
            $property_lat = $lat_lng[0];
            $property_lng = $lat_lng[1];

            $property_map  = get_post_meta( get_the_ID(),'fave_property_map',true);
            $property_streetView = get_post_meta( get_the_ID(),'fave_property_map_street_view',true);
        }
        $is_singular_property = 'yes';
    }

    /* Register Styles
     * ----------------------*/
    wp_enqueue_style( 'bootstrap.min', get_template_directory_uri(). '/css/bootstrap.css', array(), '3.3.5', 'all' );
    wp_enqueue_style( 'bootstrap-select', get_template_directory_uri(). '/css/bootstrap-select.css', array(), '1.7.2', 'all' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri(). '/css/font-awesome.css', array(), '4.4.0', 'all' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css/owl.carousel.css', array(), '2.0', 'all' );
    wp_enqueue_style( 'slick.min', get_template_directory_uri(). '/css/slick.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'slick-theme.min', get_template_directory_uri(). '/css/slick-theme.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'jquery-ui.min', get_template_directory_uri(). '/css/jquery-ui.css', array(), '1.11.4', 'all' );
    wp_enqueue_style( 'prettyPhoto', get_template_directory_uri(). '/css/prettyPhoto.css', array(), '3.1.6', 'all' );
    wp_enqueue_style( 'bootstrap-datetimepicker.min', get_template_directory_uri(). '/css/bootstrap-datetimepicker.min.css', array(), '4.17.37', 'all' );
    wp_enqueue_style( 'houzez-main', get_template_directory_uri(). '/css/main.css', array(), HOUZEZ_THEME_VERSION, 'all' );

    if( is_rtl() ) {
        wp_enqueue_style( 'houzez-rtl', get_template_directory_uri(). '/css/rtl.css', array(), HOUZEZ_THEME_VERSION, 'all' );
        wp_enqueue_style( 'bootstrap-rtl.min', get_template_directory_uri(). '/css/bootstrap-rtl.min.css', array(), '3.3.4', 'all' );
    }

    wp_enqueue_style( 'houzez-style', get_stylesheet_uri(), array(), HOUZEZ_THEME_VERSION, 'all' );

    /* Register Scripts
     * ----------------------*/
    wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.5', true );
    wp_enqueue_script( 'slick.min', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.6.0', true ); // property page
    wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui.js', array('jquery'), '1.11.4', true ); // advanced search slide
    wp_enqueue_script( 'jquery.nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.js', array('jquery'), '3.5.0', true );
    wp_enqueue_script( 'moment', get_template_directory_uri() . '/js/moment.js', array('jquery'), '2.11.1', true ); // date pickr
    wp_enqueue_script( 'houzez-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), HOUZEZ_THEME_VERSION, true );

    if( is_page_template( 'template/property-listings-map.php' ) || is_page_template( 'template/submit_property.php' ) || is_page_template( 'template/submit_property_without_login.php' ) || $header_type == 'property_map' || is_singular('property') || is_singular('houzez_agency') || $content_has_map_shortcode || $enable_radius_search != 0 ) {
        if( esc_html( $googlemap_ssl ) == 'yes' ) {
            wp_enqueue_script('google-map', 'https://maps-api-ssl.google.com/maps/api/js?libraries=places&language='.get_locale().'&key='.esc_html( $googlemap_api_key ),array('jquery'), '1.0', false);
        } else {
            wp_enqueue_script('google-map', 'http://maps.googleapis.com/maps/api/js?libraries=places&language='.get_locale().'&key='.esc_html( $googlemap_api_key ), array('jquery'), '1.0', false);
        }
        wp_enqueue_script('google-map-info-box', get_template_directory_uri() . '/js/infobox.js', array('google-map'), '1.1.9', false);

        if( $googlemap_pin_cluster != 'no' ) {
            wp_enqueue_script('google-map-marker-clusterer', get_template_directory_uri() . '/js/markerclusterer.js', array('google-map'), '2.1.1', false);
        }

        $google_map_needed = 'yes';
    }

    $houzez_date_language = houzez_option('houzez_date_language');

    if( $year_built_calender != 'no' ) {
        wp_enqueue_script( 'jquery-ui-datepicker' );

        $houzez_date_language = esc_html ( $houzez_date_language );

        if( $houzez_date_language != 'xx' && !empty($houzez_date_language) ) {
            $handle = "datepicker-".$houzez_date_language;
            $name = "datepicker-".$houzez_date_language.".js";
            wp_enqueue_script($handle, get_template_directory_uri().'/js/i18n/'.$name,array('jquery'), '1.0', true);
        }

        if (function_exists('icl_translate') ){
            if(ICL_LANGUAGE_CODE!='en'){
                $handle="datepicker-".ICL_LANGUAGE_CODE;
                $name="datepicker-".ICL_LANGUAGE_CODE.".js";
                wp_enqueue_script($handle, get_template_directory_uri().'/js/i18n/'.$name,array('jquery'), '1.0', true);
            }
            $houzez_date_language = ICL_LANGUAGE_CODE;
        }
    }
    if( $keyword_autocomplete != 0 ) {
        wp_enqueue_script('jquery-ui-autocomplete');
    }
    wp_enqueue_script( 'jquery-touch-punch' );


    // Ajax Calls
    wp_enqueue_script('houzez_ajax_calls', get_template_directory_uri() . '/js/houzez_ajax_calls.js', array('jquery'), HOUZEZ_THEME_VERSION, true);
    wp_localize_script('houzez_ajax_calls', 'HOUZEZ_ajaxcalls_vars',
        array(
            'admin_url' => get_admin_url(),
            'houzez_rtl' => $houzez_rtl,
            'redirect_type' => $after_login_redirect,
            'login_redirect' => $login_redirect,
            'login_loading' => esc_html__('Sending user info, please wait...', 'houzez'),
            'direct_pay_text' => esc_html__('Processing, Please wait...', 'houzez'),
            'user_id' => $userID,
            'transparent_menu' => $fave_main_menu_trans,
            'simple_logo' => $simple_logo,
            'retina_logo' => $retina_logo_url,
            'retina_logo_mobile' => $retina_mobilelogo_url,
            'retina_logo_splash' => $retina_splash_logo_url,
            'retina_logo_height' => $retina_logo_height,
            'retina_logo_width' => $retina_logo_width,
            'property_lat' => $property_lat,
            'property_lng' => $property_lng,
            'property_map' => $property_map,
            'property_map_street' => $property_streetView,
            'is_singular_property' => $is_singular_property,
            'process_loader_refresh' => 'fa fa-spin fa-refresh',
            'process_loader_spinner' => 'fa fa-spin fa-spinner',
            'process_loader_circle' => 'fa fa-spin fa-circle-o-notch',
            'process_loader_cog' => 'fa fa-spin fa-cog',
            'success_icon' => 'fa fa-check',
            'prop_featured' => esc_html__( 'Featured', 'houzez'),
            'featured_listings_none' => esc_html__( 'You have used all the "Featured" listings in your package.', 'houzez' ),
            'prop_sent_for_approval' => esc_html__('Sent for Approval', 'houzez'),
            'paypal_connecting' => esc_html__( 'Connecting to paypal, Please wait... ', 'houzez'),
            'confirm' => esc_html__('Are you sure you want yo delete?', 'houzez'),
            'not_found' => esc_html__("We didn't find any results", 'houzez'),
            'for_rent' => $advanced_search_rent_status,
            'for_rent_price_range' => $advanced_search_price_range_rent_status,
            'currency_symbol' => $currency_symbol,
            'advanced_search_widget_min_price' => $advanced_search_widget_min_price,
            'advanced_search_widget_max_price' => $advanced_search_widget_max_price,
            'advanced_search_min_price_range_for_rent' => $advanced_search_min_price_range_for_rent,
            'advanced_search_max_price_range_for_rent' => $advanced_search_max_price_range_for_rent,
            'advanced_search_widget_min_area' => $advanced_search_widget_min_area,
            'advanced_search_widget_max_area' => $advanced_search_widget_max_area,
            'advanced_search_price_slide' => houzez_option('adv_search_price_slider'),
            'fave_page_template' => basename( get_page_template() ),
            'google_map_style' => houzez_option('googlemap_stype'),
            'googlemap_default_zoom' => $googlemap_zoom_level,
            'googlemap_pin_cluster' => $googlemap_pin_cluster,
            'googlemap_zoom_cluster' => $googlemap_zoom_cluster,
            'map_icons_path' => get_template_directory_uri() . '/images/map/',
            'infoboxClose' => get_template_directory_uri() . '/images/map/close.png',
            'clusterIcon' => get_template_directory_uri() . '/images/map/cluster-icon.png',
            'google_map_needed' => $google_map_needed,
            'page' => $paged,
            'search_result_page' => $search_result_page,
            'search_keyword' => $search_keyword,
            'search_country' => $search_country,
            'search_state' => $search_state,
            'search_city' => $search_city,
            'search_feature' => $search_feature,
            'search_area' => $search_area,
            'search_status' => $search_status,
            'search_type' => $search_type,
            'search_bedrooms' => $search_bedrooms,
            'search_bathrooms' => $search_bathrooms,
            'search_min_price' => $search_min_price,
            'search_max_price' => $search_max_price,
            'search_min_area' => $search_min_area,
            'search_max_area' => $search_max_area,
            'search_publish_date' => $search_publish_date,

            'search_location' => $search_location,
            'use_radius' => $use_radius,
            'search_lat' => $search_lat,
            'search_long' => $search_long,
            'search_radius' => $search_radius,

            'transportation' => esc_html__('Transportation', 'houzez'),
            'supermarket' => esc_html__('Supermarket', 'houzez'),
            'schools' => esc_html__('Schools', 'houzez'),
            'libraries' => esc_html__('Libraries', 'houzez'),
            'pharmacies' => esc_html__('Pharmacies', 'houzez'),
            'hospitals' => esc_html__('Hospitals', 'houzez'),
            'sort_by' => $sort_by,
            'measurement_updating_msg' => esc_html__('Updating, Please wait...', 'houzez'),
            'currency_updating_msg' => esc_html__('Updating Currency, Please wait...', 'houzez'),
            'currency_position' => houzez_option('currency_position'),
            'submission_currency' => houzez_option('currency_paid_submission'),
            'wire_transfer_text' => esc_html__('To be paid', 'houzez'),
            'direct_pay_thanks'         =>  esc_html__('Thank you. Please check your email for payment instructions.','houzez'),
            'direct_payment_title' => esc_html__('Direct Payment Instructions', 'houzez'),
            'direct_payment_button' => esc_html__('SEND ME THE INVOICE', 'houzez'),
            'direct_payment_details' => houzez_option('direct_payment_instruction'),
            'measurement_unit' => $measurement_unit_adv_search,
            'header_map_selected_city' => $header_map_selected_city,
            'thousands_separator' => $thousands_separator,
            'current_tempalte' => $current_template,
            'monthly_payment' => esc_html__('Monthly Payment', 'houzez'),
            'weekly_payment' => esc_html__('Weekly Payment', 'houzez'),
            'bi_weekly_payment' => esc_html__('Bi-Weekly Payment', 'houzez'),
            'compare_button_url' => houzez_get_template_link_2('template/template-compare.php'),
            'template_thankyou' => houzez_get_template_link('template/template-thankyou.php'),
            'compare_page_not_found' => esc_html__('Please create page using compare properties template', 'houzez'),
            'property_detail_top' => esc_attr__($property_top_area),
            'houzez_autoComplete' => houzez_autocomplete_search(),
            'keyword_search_field' => $keyword_field,
            'keyword_autocomplete' => $keyword_autocomplete,
            'houzez_date_language' => $houzez_date_language,
            'houzez_default_radius' => $houzez_default_radius,
            'enable_radius_search' => $enable_radius_search,
            'houzez_primary_color' => $houzez_primary_color,
            'geocomplete_country' => $geocomplete_country,
            'houzez_logged_in' => $houzez_logged_in,
            'ipinfo_location' => houzez_option('ipinfo_location')

        )
    ); // end ajax calls

    $houzez_stats_graph = houzez_option('houzez_stats_graph');
    $houzez_graph_type = houzez_option('houzez_graph_type');
    if( isset( $_GET['graph_type'] ) ) {
        $houzez_graph_type = $_GET['graph_type'];
    }

    if( is_singular('property') && $houzez_stats_graph != 0 ) {
        $array_label  = houzez_return_traffic_labels( $post->ID );
        $array_values = houzez_return_traffic_data( $post->ID );
        wp_enqueue_script( 'chart.min', get_template_directory_uri() . '/js/Chart.min.js', array('jquery'), '2.2.1', true );

        wp_enqueue_script('property_stats', get_template_directory_uri().'/js/property_stats.js',array('jquery'), HOUZEZ_THEME_VERSION, true);
        wp_localize_script('property_stats', 'houzez_stats_vars',
            array(
                'stats_labels'  => json_encode ( $array_label ),
                'stats_values' => json_encode ( $array_values),
                'stats_view' => esc_html__('Views', 'houzez'),
                'chart_type' => $houzez_graph_type,
                'bg_color' => houzez_option('houzez_graph_bg_color', false, 'rgba'),
                'border_color' => houzez_option('houzez_graph_border_color', false, 'rgba'),

                )
        );
    }


    wp_enqueue_script( 'houzez-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), HOUZEZ_THEME_VERSION, true );

    if ( is_singular('post') && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_page_template( 'template/blog-masonry.php' )) {
        wp_enqueue_script( 'isotope.pkgd.min', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '2.2.2', true );
    }



    if ( is_page_template( 'template/template-splash.php' ) || $header_type == 'video' ) {
        wp_enqueue_style( 'vegas', get_template_directory_uri() . '/css/vegas.css', array(), '1.0', 'all' );
        wp_enqueue_script( 'vegas', get_template_directory_uri() . '/js/vegas.js', array( 'jquery' ), '1.0', true );
    }

    // Edit profile template
    if ( is_page_template( 'template/user_dashboard_profile.php' ) ) {
        wp_enqueue_script( 'plupload' );
        wp_register_script( 'houzez_user_profile', get_template_directory_uri() . '/js/houzez_user_profile.js', array( 'jquery', 'plupload' ), HOUZEZ_THEME_VERSION, true );
        $user_profile_data = array(
            'ajaxURL' => admin_url( 'admin-ajax.php' ),
            'uploadNonce' => wp_create_nonce ( 'favethemes_allow_upload' ),
            'fileTypeTitle' => esc_html__( 'Valid file formats', 'houzez' ),
            'houzez_site_url' => site_url(),
            'process_loader_refresh' => 'fa fa-spin fa-refresh',
            'process_loader_spinner' => 'fa fa-spin fa-spinner',
            'process_loader_circle' => 'fa fa-spin fa-circle-o-notch',
            'process_loader_cog' => 'fa fa-spin fa-cog',
            'processing_text' => esc_html__('Processing, Please wait...', 'houzez'),
        );
        wp_localize_script( 'houzez_user_profile', 'houzezUserProfile', $user_profile_data );
        wp_enqueue_script( 'houzez_user_profile' );
    } // end edit profile

    if( is_page_template( 'template/submit_property.php' ) || is_page_template( 'template/submit_property_without_login.php' || is_page_template( 'template/property-listings-map.php' ) || $header_type == 'property_map' || $enable_radius_search != 0 ) ) {
        wp_enqueue_script('geocomplete.min', get_template_directory_uri() . '/js/jquery.geocomplete.min.js', array('jquery'), '1.6.5', true);
    }

    // Submit Property
    if( is_page_template( 'template/submit_property.php' ) || is_page_template( 'template/submit_property_without_login.php' ) || is_page_template( 'template/user_dashboard_floor_plans.php' ) || is_page_template( 'template/user_dashboard_multi_units.php' ) ) {
        wp_enqueue_script( 'plupload' );
        wp_enqueue_script( 'jquery-ui-sortable' );

        wp_enqueue_script( 'validate.min', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), '1.14.0', true );

        wp_enqueue_script( 'houzez_property', get_template_directory_uri() . '/js/houzez_property.js', array( 'jquery', 'plupload', 'jquery-ui-sortable' ), HOUZEZ_THEME_VERSION, true );

        $prop_req_fields = houzez_option('required_fields');

        $prop_data = array(
            'ajaxURL'       => admin_url( 'admin-ajax.php' ),
            'uploadNonce'   => wp_create_nonce( 'prop_allow_upload' ),
            'fileTypeTitle' => esc_html__( 'Valid file formats', 'houzez' ),
            'msg_digits' => esc_html__( 'Please enter only digits', 'houzez' ),
            'max_prop_images' => houzez_option('max_prop_images'),
            'image_max_file_size' => houzez_option('image_max_file_size'),
            'plan_title_text' => esc_html__('Plan Title', 'houzez'),
            'plan_size_text' => esc_html__('Plan Size', 'houzez'),
            'plan_bedrooms_text' => esc_html__('Plan Bedrooms', 'houzez'),
            'plan_bathrooms_text' => esc_html__('Plan Bathrooms', 'houzez'),
            'plan_price_text' => esc_html__('Plan Price', 'houzez'),
            'plan_price_postfix_text' => esc_html__('Price Postfix', 'houzez'),
            'plan_image_text' => esc_html__('Plan Image', 'houzez'),
            'plan_description_text' => esc_html__('Plan Description', 'houzez'),
            'plan_upload_text' => esc_html__('Upload', 'houzez'),

            'mu_title_text' => esc_html__('Title', 'houzez'),
            'mu_type_text' => esc_html__('Property Type', 'houzez'),
            'mu_beds_text' => esc_html__('Bedrooms', 'houzez'),
            'mu_baths_text' => esc_html__('Bathrooms', 'houzez'),
            'mu_size_text' => esc_html__('Property Size', 'houzez'),
            'mu_size_postfix_text' => esc_html__('Size Postfix', 'houzez'),
            'mu_price_text' => esc_html__('Property Price', 'houzez'),
            'mu_price_postfix_text' => esc_html__('Price Postfix', 'houzez'),
            'mu_availability_text' => esc_html__('Availability Date', 'houzez'),

            'prop_title' => $prop_req_fields['title'],
            //'description' => $prop_req_fields['description'],
            'prop_type' => $prop_req_fields['prop_type'],
            'prop_status' => $prop_req_fields['prop_status'],
            'prop_labels' => $prop_req_fields['prop_labels'],
            'prop_price' => $prop_req_fields['sale_rent_price'],
            'price_label' => $prop_req_fields['price_label'],
            'prop_id' => $prop_req_fields['prop_id'],
            'bedrooms' => $prop_req_fields['bedrooms'],
            'bathrooms' => $prop_req_fields['bathrooms'],
            'area_size' => $prop_req_fields['area_size'],
            'land_area' => $prop_req_fields['land_area'],
            'garages' => $prop_req_fields['garages'],
            'year_built' => $prop_req_fields['year_built'],
            'property_map_address' => $prop_req_fields['property_map_address'],

        );
        wp_localize_script( 'houzez_property', 'houzezProperty', $prop_data );
    }

    $custom_js_code = houzez_option('custom_js_code');
    if ( ! empty( $custom_js_code ) ) {
        wp_add_inline_script( 'houzez-custom', $custom_js_code, 'after' );
    }

}
add_action( 'wp_enqueue_scripts', 'houzez_scripts' );

if (is_admin() ){
    function houzez_admin_scripts(){
        global $pagenow, $typenow;

        wp_enqueue_script('ftmetajs', get_template_directory_uri() .'/js/admin/init.js', array('jquery','media-upload','thickbox'));
        wp_enqueue_style( 'houzez-admin.css', get_template_directory_uri(). '/css/admin/admin.css', array(), HOUZEZ_THEME_VERSION, 'all' );

        wp_enqueue_script('houzez-admin-ajax', get_template_directory_uri() .'/js/admin/houzez-admin-ajax.js', array('jquery'));
        wp_localize_script('houzez-admin-ajax', 'houzez_admin_vars',
            array( 'ajaxurl'            => admin_url('admin-ajax.php'),
                'paid_status'        =>  __('Paid','houzez')

            )
        );

        if ( isset( $_GET['taxonomy'] ) && ( $_GET['taxonomy'] == 'property_status' || $_GET['taxonomy'] == 'property_label' ) ) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'houzez_taxonomies', get_template_directory_uri().'/js/admin/metaboxes-taxonomies.js', array( 'jquery', 'wp-color-picker' ), 'houzez' );
        }

    }
}

add_action('admin_enqueue_scripts', 'houzez_admin_scripts');

// Header custom JS
function houzez_header_scripts(){

    $custom_js_header = houzez_option('custom_js_header');

    if ( $custom_js_header != '' ){
        echo ( $custom_js_header );
    }
    ?>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=217780371604666";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
<?php
}
if(!is_admin()){
    add_action('wp_head', 'houzez_header_scripts');
}

// Footer custom JS
function houzez_footer_scripts(){
    $custom_js_footer = houzez_option('custom_js_footer');

    if ( $custom_js_footer != '' ){
        echo ( $custom_js_footer );
    }
}
if(!is_admin()){
    add_action( 'wp_footer', 'houzez_footer_scripts', 100 );
}