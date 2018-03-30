<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

add_filter( 'rwmb_meta_boxes', 'houzez_register_metaboxes' );

if( !function_exists( 'houzez_register_metaboxes' ) ) {
    function houzez_register_metaboxes() {

        if (!class_exists('RW_Meta_Box')) {
            return;
        }

        global $meta_boxes, $wpdb;

        $houzez_prefix = 'fave_';

        $meta_boxes = array();

        // Get Agents
        $agents_array = array(-1 => esc_html__('None', 'houzez'));
        $agents_posts = get_posts(array('post_type' => 'houzez_agent', 'posts_per_page' => -1, 'suppress_filters' => 0));
        if (!empty($agents_posts)) {
            foreach ($agents_posts as $agent_post) {
                $agents_array[$agent_post->ID] = $agent_post->post_title;
            }
        }

        $agencies_array = array();
        $agencies_posts = get_posts(array('post_type' => 'houzez_agency', 'posts_per_page' => -1, 'suppress_filters' => 0));
        if (!empty($agencies_posts)) {
            foreach ($agencies_posts as $agency_post) {
                $agencies_array[$agency_post->ID] = $agency_post->post_title;
            }
        }

        $users_array = array();
        $order = 'user_nicename';
        $fave_users = $wpdb->get_results("SELECT * FROM $wpdb->users ORDER BY $order"); // query users
        foreach( $fave_users as $user ) : // start users' profile "loop"
            $users_array[$user->ID] = $user->display_name;
        endforeach;

        $prop_status_qry = $wpdb->get_results( "SELECT * from $wpdb->terms as tm, $wpdb->term_taxonomy as tx where tm.term_id=tx.term_id AND tx.taxonomy =  'property_status'" );

        $prop_status = array();
        foreach( $prop_status_qry as $tax ) {
            $prop_status[$tax->slug] = $tax->name.' '.'('.$tax->count.')';
        }
        $prop_status_temp = array_unshift( $prop_status, "-- --");

        $prop_locations = array();
        $prop_types = array();
        $prop_status = array();
        $prop_features = array();

        houzez_get_terms_array( 'property_feature', $prop_features );
        houzez_get_terms_array( 'property_status', $prop_status );
        houzez_get_terms_array( 'property_type', $prop_types );
        houzez_get_terms_array( 'property_city', $prop_locations );
        houzez_get_terms_array( 'agent_category', $agent_categories );

        $Countries = array(
            'US' => esc_html__('United States', 'houzez'),
            'CA' => esc_html__('Canada', 'houzez'),
            'AU' => esc_html__('Australia', 'houzez'),
            'FR' => esc_html__('France', 'houzez'),
            'DE' => esc_html__('Germany', 'houzez'),
            'IS' => esc_html__('Iceland', 'houzez'),
            'IE' => esc_html__('Ireland', 'houzez'),
            'IT' => esc_html__('Italy', 'houzez'),
            'ES' => esc_html__('Spain', 'houzez'),
            'SE' => esc_html__('Sweden', 'houzez'),
            'AT' => esc_html__('Austria', 'houzez'),
            'BE' => esc_html__('Belgium', 'houzez'),
            'FI' => esc_html__('Finland', 'houzez'),
            'CZ' => esc_html__('Czech Republic', 'houzez'),
            'DK' => esc_html__('Denmark', 'houzez'),
            'NO' => esc_html__('Norway', 'houzez'),
            'GB' => esc_html__('United Kingdom', 'houzez'),
            'CH' => esc_html__('Switzerland', 'houzez'),
            'NZ' => esc_html__('New Zealand', 'houzez'),
            'RU' => esc_html__('Russian Federation', 'houzez'),
            'PT' => esc_html__('Portugal', 'houzez'),
            'NL' => esc_html__('Netherlands', 'houzez'),
            'IM' => esc_html__('Isle of Man', 'houzez'),
            'AF' => esc_html__('Afghanistan', 'houzez'),
            'AX' => esc_html__('Aland Islands ', 'houzez'),
            'AL' => esc_html__('Albania', 'houzez'),
            'DZ' => esc_html__('Algeria', 'houzez'),
            'AS' => esc_html__('American Samoa', 'houzez'),
            'AD' => esc_html__('Andorra', 'houzez'),
            'AO' => esc_html__('Angola', 'houzez'),
            'AI' => esc_html__('Anguilla', 'houzez'),
            'AQ' => esc_html__('Antarctica', 'houzez'),
            'AG' => esc_html__('Antigua and Barbuda', 'houzez'),
            'AR' => esc_html__('Argentina', 'houzez'),
            'AM' => esc_html__('Armenia', 'houzez'),
            'AW' => esc_html__('Aruba', 'houzez'),
            'AZ' => esc_html__('Azerbaijan', 'houzez'),
            'BS' => esc_html__('Bahamas', 'houzez'),
            'BH' => esc_html__('Bahrain', 'houzez'),
            'BD' => esc_html__('Bangladesh', 'houzez'),
            'BB' => esc_html__('Barbados', 'houzez'),
            'BY' => esc_html__('Belarus', 'houzez'),
            'BZ' => esc_html__('Belize', 'houzez'),
            'BJ' => esc_html__('Benin', 'houzez'),
            'BM' => esc_html__('Bermuda', 'houzez'),
            'BT' => esc_html__('Bhutan', 'houzez'),
            'BO' => esc_html__('Bolivia, Plurinational State of', 'houzez'),
            'BQ' => esc_html__('Bonaire, Sint Eustatius and Saba', 'houzez'),
            'BA' => esc_html__('Bosnia and Herzegovina', 'houzez'),
            'BW' => esc_html__('Botswana', 'houzez'),
            'BV' => esc_html__('Bouvet Island', 'houzez'),
            'BR' => esc_html__('Brazil', 'houzez'),
            'IO' => esc_html__('British Indian Ocean Territory', 'houzez'),
            'BN' => esc_html__('Brunei Darussalam', 'houzez'),
            'BG' => esc_html__('Bulgaria', 'houzez'),
            'BF' => esc_html__('Burkina Faso', 'houzez'),
            'BI' => esc_html__('Burundi', 'houzez'),
            'KH' => esc_html__('Cambodia', 'houzez'),
            'CM' => esc_html__('Cameroon', 'houzez'),
            'CV' => esc_html__('Cape Verde', 'houzez'),
            'KY' => esc_html__('Cayman Islands', 'houzez'),
            'CF' => esc_html__('Central African Republic', 'houzez'),
            'TD' => esc_html__('Chad', 'houzez'),
            'CL' => esc_html__('Chile', 'houzez'),
            'CN' => esc_html__('China', 'houzez'),
            'CX' => esc_html__('Christmas Island', 'houzez'),
            'CC' => esc_html__('Cocos (Keeling) Islands', 'houzez'),
            'CO' => esc_html__('Colombia', 'houzez'),
            'KM' => esc_html__('Comoros', 'houzez'),
            'CG' => esc_html__('Congo', 'houzez'),
            'CD' => esc_html__('Congo, the Democratic Republic of the', 'houzez'),
            'CK' => esc_html__('Cook Islands', 'houzez'),
            'CR' => esc_html__('Costa Rica', 'houzez'),
            'CI' => esc_html__('Cote d\'Ivoire', 'houzez'),
            'HR' => esc_html__('Croatia', 'houzez'),
            'CU' => esc_html__('Cuba', 'houzez'),
            'CW' => esc_html__('Curaçao', 'houzez'),
            'CY' => esc_html__('Cyprus', 'houzez'),
            'DJ' => esc_html__('Djibouti', 'houzez'),
            'DM' => esc_html__('Dominica', 'houzez'),
            'DO' => esc_html__('Dominican Republic', 'houzez'),
            'EC' => esc_html__('Ecuador', 'houzez'),
            'EG' => esc_html__('Egypt', 'houzez'),
            'SV' => esc_html__('El Salvador', 'houzez'),
            'GQ' => esc_html__('Equatorial Guinea', 'houzez'),
            'ER' => esc_html__('Eritrea', 'houzez'),
            'EE' => esc_html__('Estonia', 'houzez'),
            'ET' => esc_html__('Ethiopia', 'houzez'),
            'FK' => esc_html__('Falkland Islands (Malvinas)', 'houzez'),
            'FO' => esc_html__('Faroe Islands', 'houzez'),
            'FJ' => esc_html__('Fiji', 'houzez'),
            'GF' => esc_html__('French Guiana', 'houzez'),
            'PF' => esc_html__('French Polynesia', 'houzez'),
            'TF' => esc_html__('French Southern Territories', 'houzez'),
            'GA' => esc_html__('Gabon', 'houzez'),
            'GM' => esc_html__('Gambia', 'houzez'),
            'GE' => esc_html__('Georgia', 'houzez'),
            'GH' => esc_html__('Ghana', 'houzez'),
            'GI' => esc_html__('Gibraltar', 'houzez'),
            'GR' => esc_html__('Greece', 'houzez'),
            'GL' => esc_html__('Greenland', 'houzez'),
            'GD' => esc_html__('Grenada', 'houzez'),
            'GP' => esc_html__('Guadeloupe', 'houzez'),
            'GU' => esc_html__('Guam', 'houzez'),
            'GT' => esc_html__('Guatemala', 'houzez'),
            'GG' => esc_html__('Guernsey', 'houzez'),
            'GN' => esc_html__('Guinea', 'houzez'),
            'GW' => esc_html__('Guinea-Bissau', 'houzez'),
            'GY' => esc_html__('Guyana', 'houzez'),
            'HT' => esc_html__('Haiti', 'houzez'),
            'HM' => esc_html__('Heard Island and McDonald Islands', 'houzez'),
            'VA' => esc_html__('Holy See (Vatican City State)', 'houzez'),
            'HN' => esc_html__('Honduras', 'houzez'),
            'HK' => esc_html__('Hong Kong', 'houzez'),
            'HU' => esc_html__('Hungary', 'houzez'),
            'IN' => esc_html__('India', 'houzez'),
            'ID' => esc_html__('Indonesia', 'houzez'),
            'IR' => esc_html__('Iran, Islamic Republic of', 'houzez'),
            'IQ' => esc_html__('Iraq', 'houzez'),
            'IL' => esc_html__('Israel', 'houzez'),
            'JM' => esc_html__('Jamaica', 'houzez'),
            'JP' => esc_html__('Japan', 'houzez'),
            'JE' => esc_html__('Jersey', 'houzez'),
            'JO' => esc_html__('Jordan', 'houzez'),
            'KZ' => esc_html__('Kazakhstan', 'houzez'),
            'KE' => esc_html__('Kenya', 'houzez'),
            'KI' => esc_html__('Kiribati', 'houzez'),
            'KP' => esc_html__('Korea, Democratic People\'s Republic of', 'houzez'),
            'KR' => esc_html__('Korea, Republic of', 'houzez'),
            'KV' => esc_html__('kosovo', 'houzez'),
            'KW' => esc_html__('Kuwait', 'houzez'),
            'KG' => esc_html__('Kyrgyzstan', 'houzez'),
            'LA' => esc_html__('Lao People\'s Democratic Republic', 'houzez'),
            'LV' => esc_html__('Latvia', 'houzez'),
            'LB' => esc_html__('Lebanon', 'houzez'),
            'LS' => esc_html__('Lesotho', 'houzez'),
            'LR' => esc_html__('Liberia', 'houzez'),
            'LY' => esc_html__('Libyan Arab Jamahiriya', 'houzez'),
            'LI' => esc_html__('Liechtenstein', 'houzez'),
            'LT' => esc_html__('Lithuania', 'houzez'),
            'LU' => esc_html__('Luxembourg', 'houzez'),
            'MO' => esc_html__('Macao', 'houzez'),
            'MK' => esc_html__('Macedonia', 'houzez'),
            'MG' => esc_html__('Madagascar', 'houzez'),
            'MW' => esc_html__('Malawi', 'houzez'),
            'MY' => esc_html__('Malaysia', 'houzez'),
            'MV' => esc_html__('Maldives', 'houzez'),
            'ML' => esc_html__('Mali', 'houzez'),
            'MT' => esc_html__('Malta', 'houzez'),
            'MH' => esc_html__('Marshall Islands', 'houzez'),
            'MQ' => esc_html__('Martinique', 'houzez'),
            'MR' => esc_html__('Mauritania', 'houzez'),
            'MU' => esc_html__('Mauritius', 'houzez'),
            'YT' => esc_html__('Mayotte', 'houzez'),
            'MX' => esc_html__('Mexico', 'houzez'),
            'FM' => esc_html__('Micronesia, Federated States of', 'houzez'),
            'MD' => esc_html__('Moldova, Republic of', 'houzez'),
            'MC' => esc_html__('Monaco', 'houzez'),
            'MN' => esc_html__('Mongolia', 'houzez'),
            'ME' => esc_html__('Montenegro', 'houzez'),
            'MS' => esc_html__('Montserrat', 'houzez'),
            'MA' => esc_html__('Morocco', 'houzez'),
            'MZ' => esc_html__('Mozambique', 'houzez'),
            'MM' => esc_html__('Myanmar', 'houzez'),
            'NA' => esc_html__('Namibia', 'houzez'),
            'NR' => esc_html__('Nauru', 'houzez'),
            'NP' => esc_html__('Nepal', 'houzez'),
            'NC' => esc_html__('New Caledonia', 'houzez'),
            'NI' => esc_html__('Nicaragua', 'houzez'),
            'NE' => esc_html__('Niger', 'houzez'),
            'NG' => esc_html__('Nigeria', 'houzez'),
            'NU' => esc_html__('Niue', 'houzez'),
            'NF' => esc_html__('Norfolk Island', 'houzez'),
            'MP' => esc_html__('Northern Mariana Islands', 'houzez'),
            'OM' => esc_html__('Oman', 'houzez'),
            'PK' => esc_html__('Pakistan', 'houzez'),
            'PW' => esc_html__('Palau', 'houzez'),
            'PS' => esc_html__('Palestinian Territory, Occupied', 'houzez'),
            'PA' => esc_html__('Panama', 'houzez'),
            'PG' => esc_html__('Papua New Guinea', 'houzez'),
            'PY' => esc_html__('Paraguay', 'houzez'),
            'PE' => esc_html__('Peru', 'houzez'),
            'PH' => esc_html__('Philippines', 'houzez'),
            'PN' => esc_html__('Pitcairn', 'houzez'),
            'PL' => esc_html__('Poland', 'houzez'),
            'PR' => esc_html__('Puerto Rico', 'houzez'),
            'QA' => esc_html__('Qatar', 'houzez'),
            'RE' => esc_html__('Reunion', 'houzez'),
            'RO' => esc_html__('Romania', 'houzez'),
            'RW' => esc_html__('Rwanda', 'houzez'),
            'BL' => esc_html__('Saint Barthélemy', 'houzez'),
            'SH' => esc_html__('Saint Helena', 'houzez'),
            'KN' => esc_html__('Saint Kitts and Nevis', 'houzez'),
            'LC' => esc_html__('Saint Lucia', 'houzez'),
            'MF' => esc_html__('Saint Martin (French part)', 'houzez'),
            'PM' => esc_html__('Saint Pierre and Miquelon', 'houzez'),
            'VC' => esc_html__('Saint Vincent and the Grenadines', 'houzez'),
            'WS' => esc_html__('Samoa', 'houzez'),
            'SM' => esc_html__('San Marino', 'houzez'),
            'ST' => esc_html__('Sao Tome and Principe', 'houzez'),
            'SA' => esc_html__('Saudi Arabia', 'houzez'),
            'SN' => esc_html__('Senegal', 'houzez'),
            'RS' => esc_html__('Serbia', 'houzez'),
            'SC' => esc_html__('Seychelles', 'houzez'),
            'SL' => esc_html__('Sierra Leone', 'houzez'),
            'SG' => esc_html__('Singapore', 'houzez'),
            'SX' => esc_html__('Sint Maarten (Dutch part)', 'houzez'),
            'SK' => esc_html__('Slovakia', 'houzez'),
            'SI' => esc_html__('Slovenia', 'houzez'),
            'SB' => esc_html__('Solomon Islands', 'houzez'),
            'SO' => esc_html__('Somalia', 'houzez'),
            'ZA' => esc_html__('South Africa', 'houzez'),
            'GS' => esc_html__('South Georgia and the South Sandwich Islands', 'houzez'),
            'LK' => esc_html__('Sri Lanka', 'houzez'),
            'SD' => esc_html__('Sudan', 'houzez'),
            'SR' => esc_html__('Suriname', 'houzez'),
            'SJ' => esc_html__('Svalbard and Jan Mayen', 'houzez'),
            'SZ' => esc_html__('Swaziland', 'houzez'),
            'SY' => esc_html__('Syrian Arab Republic', 'houzez'),
            'TW' => esc_html__('Taiwan, Province of China', 'houzez'),
            'TJ' => esc_html__('Tajikistan', 'houzez'),
            'TZ' => esc_html__('Tanzania, United Republic of', 'houzez'),
            'TH' => esc_html__('Thailand', 'houzez'),
            'TL' => esc_html__('Timor-Leste', 'houzez'),
            'TG' => esc_html__('Togo', 'houzez'),
            'TK' => esc_html__('Tokelau', 'houzez'),
            'TO' => esc_html__('Tonga', 'houzez'),
            'TT' => esc_html__('Trinidad and Tobago', 'houzez'),
            'TN' => esc_html__('Tunisia', 'houzez'),
            'TR' => esc_html__('Turkey', 'houzez'),
            'TM' => esc_html__('Turkmenistan', 'houzez'),
            'TC' => esc_html__('Turks and Caicos Islands', 'houzez'),
            'TV' => esc_html__('Tuvalu', 'houzez'),
            'UG' => esc_html__('Uganda', 'houzez'),
            'UA' => esc_html__('Ukraine', 'houzez'),
            'AE' => esc_html__('United Arab Emirates', 'houzez'),
            'UM' => esc_html__('United States Minor Outlying Islands', 'houzez'),
            'UY' => esc_html__('Uruguay', 'houzez'),
            'UZ' => esc_html__('Uzbekistan', 'houzez'),
            'VU' => esc_html__('Vanuatu', 'houzez'),
            'VE' => esc_html__('Venezuela, Bolivarian Republic of', 'houzez'),
            'VN' => esc_html__('Viet Nam', 'houzez'),
            'VG' => esc_html__('Virgin Islands, British', 'houzez'),
            'VI' => esc_html__('Virgin Islands, U.S.', 'houzez'),
            'WF' => esc_html__('Wallis and Futuna', 'houzez'),
            'EH' => esc_html__('Western Sahara', 'houzez'),
            'YE' => esc_html__('Yemen', 'houzez'),
            'ZM' => esc_html__('Zambia', 'houzez'),
            'ZW' => esc_html__('Zimbabwe', 'houzez')
        );

        $countries_array = array();
        if (!empty($Countries)) {
            foreach ($Countries as $key=>$val ) {
                $countries_array[$key] = $val;
            }
        }

        $max_prop_images = houzez_option('max_prop_images');
        $default_country = houzez_option('default_country');
        //$hide_add_prop_fields = houzez_option('hide_add_prop_fields');
        $auto_property_id = houzez_option('auto_property_id');
        $beds_hidden = $baths_hidden = $garages = $garage_size = $prop_id = $area_size = $land_area = '';

        /*if( $hide_add_prop_fields['bedrooms'] != 0 ) {
            $beds_hidden = 'houzez_hidden';
        }
        if( $hide_add_prop_fields['bathrooms'] != 0 ) {
            $baths_hidden = 'houzez_hidden';
        }
        if( $hide_add_prop_fields['garages'] != 0 ) {
            $garages = 'houzez_hidden';
        }
        if( $hide_add_prop_fields['garage_size'] != 0 ) {
            $garage_size = 'houzez_hidden';
        }
        if( $hide_add_prop_fields['prop_id'] != 0 || $auto_property_id != 0 ) {
            $prop_id = 'houzez_hidden';
        }
        if( $hide_add_prop_fields['area_size'] != 0 ) {
            $area_size = 'houzez_hidden';
        }
        if( $hide_add_prop_fields['land_area'] != 0 ) {
            $land_area = 'houzez_hidden';
        }*/

        /* ===========================================================================================
        *   Property Custom Post Type Meta
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id' => 'property-meta-box',
            'title' => esc_html__('Property', 'houzez'),
            'pages' => array('property'),
            'tabs' => array(
                'property_details' => array(
                    'label' => esc_html__('Basic Information', 'houzez'),
                    'icon' => 'dashicons-admin-home',
                ),
                'property_map' => array(
                    'label' => esc_html__('Map', 'houzez'),
                    'icon' => 'dashicons-location',
                ),
                'property_settings' => array(
                    'label' => esc_html__('Property Setting', 'houzez'),
                    'icon' => 'dashicons-admin-generic',
                ),
                'gallery' => array(
                    'label' => esc_html__('Gallery Images', 'houzez'),
                    'icon' => 'dashicons-format-gallery',
                ),
                'video' => array(
                    'label' => esc_html__('Property Video', 'houzez'),
                    'icon' => 'dashicons-format-video',
                ),
                'virtual_tour' => array(
                    'label' => esc_html__('360° Virtual Tour', 'houzez'),
                    'icon' => 'dashicons-format-video',
                ),
                'agent' => array(
                    'label' => esc_html__('Agent Information', 'houzez'),
                    'icon' => 'dashicons-businessman',
                ),
                'home_slider' => array(
                    'label' => esc_html__('Property Slider', 'houzez'),
                    'icon' => 'dashicons-images-alt',
                ),
                'multi_units' => array(
                    'label' => esc_html__('Multi Units / Sub Properties', 'houzez'),
                    'icon' => 'dashicons-layout',
                ),
                'floor_plans' => array(
                    'label' => esc_html__('Floor Plans', 'houzez'),
                    'icon' => 'dashicons-layout',
                ),
                'attachments' => array(
                    'label' => esc_html__('Attachments', 'houzez'),
                    'icon' => 'dashicons-book',
                )

            ),
            'tab_style' => 'left',
            'fields' => array(

                // Property Details
                array(
                    'id' => "{$houzez_prefix}property_price",
                    'name' => esc_html__('Sale or Rent Price', 'houzez'),
                    'desc' => esc_html__('Eg: 557000 or See opan request', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_sec_price",
                    'name' => esc_html__('Second Price ( Display optional price for rental or square feet )', 'houzez'),
                    'desc' => esc_html__('Eg: 700', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_price_prefix",
                    'name' => esc_html__('Before Price Label', 'houzez'),
                    'desc' => esc_html__('Eg: Start From', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_price_postfix",
                    'name' => esc_html__('After Price Label', 'houzez'),
                    'desc' => esc_html__('Eg: Per Month', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_size",
                    'name' => esc_html__('Area Size ( Only digits )', 'houzez'),
                    'desc' => esc_html__('Eg: 1500', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'class' => $area_size,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_size_prefix",
                    'name' => esc_html__('Size Prefix', 'houzez'),
                    'desc' => esc_html__('Eg: Sq Ft', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'class' => $area_size,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_land",
                    'name' => esc_html__('Land Area ( Only digits )', 'houzez'),
                    'desc' => esc_html__('Eg: 1500', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'class' => $land_area,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_land_postfix",
                    'name' => esc_html__('Land Area Postfix', 'houzez'),
                    'desc' => esc_html__('Eg: SqFt', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'class' => $land_area,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_bedrooms",
                    'name' => esc_html__('Bedrooms', 'houzez'),
                    'desc' => esc_html__('Eg: 4', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'class' => $beds_hidden,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_bathrooms",
                    'name' => esc_html__('Bathrooms', 'houzez'),
                    'desc' => esc_html__('Eg: 3', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'class' => $baths_hidden,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_garage",
                    'name' => esc_html__('Garages', 'houzez'),
                    'desc' => esc_html__('Eg: 1', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'class' => $garages,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_garage_size",
                    'name' => esc_html__('Garages Size', 'houzez'),
                    'desc' => "",
                    'type' => 'text',
                    'std' => "",
                    'class' => $garage_size,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_year",
                    'name' => esc_html__('Year Built', 'houzez'),
                    'desc' => "",
                    'type' => 'date',
                    'js_options' => array(
                        'dateFormat'      => esc_html__( 'yy-mm-dd', 'houzez' ),
                        'changeMonth'     => true,
                        'changeYear'      => true,
                        'showButtonPanel' => true,
                    ),
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'property_details',
                ),
                array(
                    'id' => "{$houzez_prefix}property_id",
                    'name' => esc_html__('Property ID', 'houzez'),
                    'desc' => esc_html__('It will help you search a property directly.', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'class' => $prop_id,
                    'columns' => 6,
                    'tab' => 'property_details',
                ),

                // Property Map
                array(
                    'type' => 'divider',
                    'columns' => 12,
                    'id' => 'google_map_divider',
                    'tab' => 'property_details',
                ),
                array(
                    'name' => esc_html__('Property Map ?', 'houzez'),
                    'id' => "{$houzez_prefix}property_map",
                    'type' => 'radio',
                    'std' => 0,
                    'options' => array(
                        1 => esc_html__('Show ', 'houzez'),
                        0 => esc_html__('Hide', 'houzez')
                    ),
                    'columns' => 12,
                    'tab' => 'property_map',
                ),
                array(
                    'id' => "{$houzez_prefix}property_map_address",
                    'name' => esc_html__('Property Address', 'houzez'),
                    'desc' => esc_html__('Leave it empty if you want to hide map on property detail page.', 'houzez'),
                    'type' => 'text',
                    'std' => '',
                    'columns' => 12,
                    'tab' => 'property_map',
                ),
                array(
                    'id' => "{$houzez_prefix}property_location",
                    'name' => esc_html__('Property Location at Google Map*', 'houzez'),
                    'desc' => esc_html__('Drag the google map marker to point your property location. You can also use the address field above to search for your property.', 'houzez'),
                    'type' => 'map',
                    'std' => '25.686540,-80.431345,15',   // 'latitude,longitude[,zoom]' (zoom is optional)
                    'style' => 'width: 95%; height: 400px',
                    'address_field' => "{$houzez_prefix}property_map_address",
                    'columns' => 12,
                    'tab' => 'property_map',
                ),
                array(
                    'name' => esc_html__('Google Map Street View', 'houzez'),
                    'id' => "{$houzez_prefix}property_map_street_view",
                    'type' => 'select',
                    'std' => 'hide',
                    'options' => array(
                        'hide' => esc_html__('Hide', 'houzez'),
                        'show' => esc_html__('Show ', 'houzez')
                    ),
                    'columns' => 12,
                    'tab' => 'property_map',
                ),

                // Property Settings
                array(
                    'id' => "{$houzez_prefix}property_address",
                    'name' => esc_html__('Address(*only street name and building no)', 'houzez'),
                    'desc' => "",
                    'type' => 'textarea',
                    'columns' => 6,
                    'tab' => 'property_settings',
                ),
                array(
                    'id' => "{$houzez_prefix}property_zip",
                    'name' => esc_html__('Zip', 'houzez'),
                    'desc' => "",
                    'type' => 'text',
                    'columns' => 6,
                    'tab' => 'property_settings',
                ),
                array(
                    'id' => "{$houzez_prefix}property_country",
                    'name' => esc_html__('Country', 'houzez'),
                    'desc' => "",
                    'std' => $default_country,
                    'type' => 'select',
                    'options' => $countries_array,
                    'columns' => 6,
                    'tab' => 'property_settings',
                ),
                array(
                    'name' => esc_html__('Mark this property as featured ?', 'houzez'),
                    'id' => "{$houzez_prefix}featured",
                    'type' => 'radio',
                    'std' => 0,
                    'options' => array(
                        1 => esc_html__('Yes ', 'houzez'),
                        0 => esc_html__('No', 'houzez')
                    ),
                    'columns' => 6,
                    'tab' => 'property_settings',
                ),

                // Gallery
                array(
                    'name' => esc_html__('Property Gallery Images', 'houzez'),
                    'id' => "{$houzez_prefix}property_images",
                    'desc' => esc_html__('Recommend image size 1170 x 738', 'houzez'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 48,
                    'columns' => 12,
                    'tab' => 'gallery',
                ),

                // Property Video
                array(
                    'id' => "{$houzez_prefix}video_url",
                    'name' => esc_html__('Video URL', 'houzez'),
                    'desc' => esc_html__('Provide video URL. YouTube, Vimeo, SWF File and MOV File are supported', 'houzez'),
                    'type' => 'text',
                    'columns' => 12,
                    'tab' => 'video',
                ),
                array(
                    'name' => esc_html__('Video Image', 'houzez'),
                    'id' => "{$houzez_prefix}video_image",
                    'desc' => esc_html__('Provide an image that will be displayed as a place holder and when user will click over it the video will be opened in a lightbox. You must provide this image otherwise the video will not be displayed. Image should have minimum width of 818px and minimum height 417px. Bigger size images will be cropped automatically.', 'houzez'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'columns' => 12,
                    'tab' => 'video',
                ),

                //Virtual Tour
                array(
                    'id' => "{$houzez_prefix}virtual_tour",
                    'name' => esc_html__('Virtual Tour', 'houzez'),
                    'desc' => esc_html__('Enter virtual tour embeded code', 'houzez'),
                    'type' => 'textarea',
                    'columns' => 12,
                    'tab' => 'virtual_tour',
                ),


                // Agents
                array(
                    'name' => esc_html__('What to display in agent information box ?', 'houzez'),
                    'id' => "{$houzez_prefix}agent_display_option",
                    'type' => 'radio',
                    'std' => 'author_info',
                    'options' => array(
                        'author_info' => esc_html__('Author information.', 'houzez'),
                        'agent_info' => esc_html__('Agent Information. ( Select the agent below )', 'houzez'),
                        'none' => esc_html__('Hide information box', 'houzez'),
                    ),
                    'columns' => 12,
                    'tab' => 'agent',
                ),
                array(
                    'name' => esc_html__('Agent Responsible', 'houzez'),
                    'id' => "{$houzez_prefix}agents",
                    'type' => 'select',
                    'options' => $agents_array,
                    'columns' => 12,
                    'tab' => 'agent',
                ),

                // Homepage Slider
                array(
                    'name' => esc_html__('Do you want to add this property in property slider?', 'houzez'),
                    'id' => "{$houzez_prefix}prop_homeslider",
                    'desc' => esc_html__('If yes, then provide slider image below.', 'houzez'),
                    'type' => 'radio',
                    'options' => array(
                        'yes' => esc_html__('Yes', 'houzez'),
                        'no'  => esc_html__('No', 'houzez'),
                    ),
                    'columns' => 12,
                    'tab' => 'home_slider',
                ),
                array(
                    'name' => esc_html__('Slider Image', 'houzez'),
                    'id' => "{$houzez_prefix}prop_slider_image",
                    'desc' => esc_html__('The recommended image size in 2000 x 700. You can use bigger and smaller image but keep same height to width ratio. Use same size images for all properties which you want to add in slider', 'houzez'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'columns' => 12,
                    'tab' => 'home_slider',
                ),

                //Multi Units / Sub Properties
                array(
                    'id' => "{$houzez_prefix}multiunit_plans_enable",
                    'name' => esc_html__('Multi Units / Sub Properties', 'houzez'),
                    'desc' => esc_html__('Enable/Disable', 'houzez'),
                    'type' => 'select',
                    'std' => "disable",
                    'options' => array('disable' => esc_html__('Disable', 'houzez'), 'enable' => esc_html__('Enable', 'houzez')),
                    'columns' => 12,
                    'tab' => 'multi_units'
                ),
                array(
                    'id'     => "{$houzez_prefix}multi_units",
                    // Gropu field
                    'type'   => 'group',
                    // Clone whole group?
                    'clone'  => true,
                    'sort_clone' => true,
                    'tab' => 'multi_units',
                    // Sub-fields
                    'fields' => array(
                        array(
                            'name' => esc_html__( 'Title', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_title",
                            'type' => 'text',
                            'columns' => 12,
                        ),
                        array(
                            'name' => esc_html__( 'Price', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_price",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Price Postfix', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_price_postfix",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Bedrooms', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_beds",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Bathrooms', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_baths",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Property Size', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_size",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Size Postfix', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_size_postfix",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Property Type', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_type",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Availability Date', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_availability_date",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        /*array(
                            'name' => esc_html__( 'Image', 'houzez' ),
                            'id'   => "{$houzez_prefix}mu_image",
                            'type' => 'file_input',
                            'columns' => 12,
                        )*/

                    ),
                ),

                //Floor Plans
                array(
                    'id' => "{$houzez_prefix}floor_plans_enable",
                    'name' => esc_html__('Floor Plans', 'houzez'),
                    'desc' => esc_html__('Enable/Disable floor plans', 'houzez'),
                    'type' => 'select',
                    'std' => "disable",
                    'options' => array('disable' => esc_html__( 'Disable', 'houzez' ), 'enable' => esc_html__( 'Enable', 'houzez' )),
                    'columns' => 12,
                    'tab' => 'floor_plans'
                ),
                array(
                    'id'     => 'floor_plans',
                    // Gropu field
                    'type'   => 'group',
                    // Clone whole group?
                    'clone'  => true,
                    'sort_clone' => true,
                    'tab' => 'floor_plans',
                    // Sub-fields
                    'fields' => array(
                        array(
                            'name' => esc_html__( 'Plan Title', 'houzez' ),
                            'id'   => "{$houzez_prefix}plan_title",
                            'type' => 'text',
                            'columns' => 12,
                        ),
                        array(
                            'name' => esc_html__( 'Plan Bedrooms', 'houzez' ),
                            'id'   => "{$houzez_prefix}plan_rooms",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Plan Bathrooms', 'houzez' ),
                            'id'   => "{$houzez_prefix}plan_bathrooms",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Plan Price', 'houzez' ),
                            'id'   => "{$houzez_prefix}plan_price",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Price Postfix', 'houzez' ),
                            'id'   => "{$houzez_prefix}plan_price_postfix",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Plan Size', 'houzez' ),
                            'id'   => "{$houzez_prefix}plan_size",
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Plan Image', 'houzez' ),
                            'id'   => "{$houzez_prefix}plan_image",
                            'type' => 'file_input',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Plan Description', 'houzez' ),
                            'id'   => "{$houzez_prefix}plan_description",
                            'type' => 'textarea',
                            'columns' => 12,
                        ),

                    ),
                ),

                // Attachments
                array(
                    'id' => "{$houzez_prefix}attachments",
                    'name' => esc_html__('Attachments', 'houzez'),
                    'desc' => esc_html__('You can attach PDF files, Map images OR other documents to provide further details related to property.', 'houzez'),
                    'type' => 'file_advanced',
                    'mime_type' => '',
                    'columns' => 12,
                    'tab' => 'attachments',
                )
            )
        );

        //if( $hide_add_prop_fields['additional_details'] != 1 ) {
            $meta_boxes[] = array(
                'title' => esc_html__('Additional Details', 'houzez'),
                'pages' => array('property'),
                'fields' => array(
                    array(
                        'id' => "{$houzez_prefix}additional_features_enable",
                        'name' => esc_html__('Additional Features', 'houzez'),
                        'desc' => esc_html__('Enable/Disable Additional Features', 'houzez'),
                        'type' => 'select',
                        'std' => "disable",
                        'options' => array('disable' => esc_html__('Disable', 'houzez'), 'enable' => esc_html__('Enable', 'houzez')),
                        'columns' => 12
                    ),
                    array(
                        'id' => 'additional_features',
                        'type' => 'group',
                        'clone' => true,
                        'sort_clone' => true,
                        'fields' => array(
                            array(
                                'name' => esc_html__('Title', 'houzez'),
                                'id' => "{$houzez_prefix}additional_feature_title",
                                'type' => 'text',
                                'columns' => 6,
                            ),
                            array(
                                'name' => esc_html__('Value', 'houzez'),
                                'id' => "{$houzez_prefix}additional_feature_value",
                                'type' => 'text',
                                'columns' => 6,
                            )
                        ),
                    ),
                ),
            );
        //}

        /* ===========================================================================================
        *   Agent
        * ============================================================================================*/
        $meta_boxes[] = array(
            'title'  => esc_html__( 'Agent Information', 'houzez' ),
            'pages'  => array('houzez_agent'),
            'fields' => array(

                array(
                    'name'      => esc_html__('Short Description', 'houzez'),
                    'id'        => $houzez_prefix . 'agent_des',
                    'type'      => 'textarea',
                    'desc'      => '',
                    'columns'   => 12
                ),
                array(
                    'name'      => 'Position',
                    'id'        => $houzez_prefix . 'agent_position',
                    'type'      => 'text',
                    'desc'      => esc_html__('Ex: Founder & CEO.','houzez'),
                    'columns'   => 6
                ),
                array(
                    'name'      => esc_html__('Company Name', 'houzez'),
                    'id'        => $houzez_prefix . 'agent_company',
                    'type'      => 'text',
                    'desc'      => '',
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_mobile",
                    'name' => esc_html__("Mobile Number", 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_office_num",
                    'name' => esc_html__("Office Number", 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_fax",
                    'name' => esc_html__("Fax Number", 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_skype",
                    'name' => "Skype",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_website",
                    'name' => esc_html__("Website", 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_facebook",
                    'name' => "Facebook URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_twitter",
                    'name' => "Twitter URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_linkedin",
                    'name' => "LinkedIn URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_googleplus",
                    'name' => "Google Plus URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_youtube",
                    'name' => "Youtube URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_instagram",
                    'name' => "Instagram URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_pinterest",
                    'name' => "Pinterest URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_vimeo",
                    'name' => "Vimeo URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_email",
                    'name' => esc_html__( 'Email Address', 'houzez' ),
                    'desc' => esc_html__('Provide agent email address, Agent related messages from contact form on property details page, will be sent on this email address. ', 'houzez'),
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'name'    => esc_html__('Company Logo', 'houzez'),
                    'id'      => $houzez_prefix . 'agent_logo',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc'      => '',
                    'columns'   => 12
                )
            ),
        );

        $meta_boxes[] = array(
            'title'  => esc_html__( 'Agencies', 'houzez' ),
            'pages'  => array('houzez_agent'),
            'context' => 'side',
            'priority' => 'high',
            'fields' => array(
                array(
                    //'name'      => esc_html__('Agencies', 'houzez'),
                    'id'        => $houzez_prefix . 'agent_agencies',
                    'type'      => 'select',
                    'options'   => $agencies_array,
                    'desc'      => '',
                    'columns' => 12,
                    'multiple' => true
                ),
            )
        );

        /* ===========================================================================================
        *   Membership
        * ============================================================================================*/
        $meta_boxes[] = array(
            'title'  => esc_html__( 'Package Details', 'houzez' ),
            'pages'  => array('houzez_packages'),
            'fields' => array(
                array(
                    'id' => "{$houzez_prefix}billing_time_unit",
                    'name' => esc_html__( 'Billing Period', 'houzez' ),
                    'type' => 'select',
                    'std' => "",
                    'options' => array( 'Day' => esc_html__('Day', 'houzez' ), 'Week' => esc_html__('Week', 'houzez' ), 'Month' => esc_html__('Month', 'houzez' ), 'Year' => esc_html__('Year', 'houzez' ) ),
                    'columns' => 6,
                ),
                array(
                    'id' => "{$houzez_prefix}billing_unit",
                    'name' => esc_html__( 'Billing Frequency', 'houzez' ),
                    'type' => 'text',
                    'std' => "0",
                    'columns' => 6,
                ),
                array(
                    'id' => "{$houzez_prefix}package_listings",
                    'name' => esc_html__( 'How many listings are included?', 'houzez' ),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,

                ),
                array(
                    'id' => "{$houzez_prefix}unlimited_listings",
                    'name' => esc_html__( "Unlimited listings", 'houzez' ),
                    'type' => 'checkbox',
                    'desc' => esc_html__('Unlimited listings ?', 'houzez'),
                    'std' => "",
                    'columns' => 6,
                ),
                array(
                    'id' => "{$houzez_prefix}package_featured_listings",
                    'name' => esc_html__( 'How many Featured listings are included?', 'houzez' ),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                ),
                array(
                    'id' => "{$houzez_prefix}package_price",
                    'name' => esc_html__( 'Package Price ', 'houzez' ),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                ),
                array(
                    'id' => "{$houzez_prefix}package_stripe_id",
                    'name' => esc_html__( 'Package stripe id (ex: gold_pack)', 'houzez' ),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                ),
                array(
                    'id' => "{$houzez_prefix}package_visible",
                    'name' => esc_html__( 'Is Visible?', 'houzez' ),
                    'type' => 'select',
                    'std' => "",
                    'options' => array( 'yes' => esc_html__( 'Yes', 'houzez' ), 'no' => esc_html__( 'No', 'houzez' ) ),
                    'columns' => 6,
                ),
                array(
                    'id' => "{$houzez_prefix}package_popular",
                    'name' => esc_html__( 'Is Popular/Featured?', 'houzez' ),
                    'type' => 'select',
                    'std' => "no",
                    'options' => array( 'no' => esc_html__( 'No', 'houzez' ), 'yes' => esc_html__( 'Yes', 'houzez' ) ),
                    'columns' => 12,
                ),
            ),
        );


        /* ===========================================================================================
        *   Listing Template
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id'        => 'fave_listing_template',
            'title'     => esc_html__('Property Listing Advanced Options', 'houzez'),
            'pages'     => array( 'page' ),
            'context' => 'normal',

            'fields'    => array(
                array(
                    'name'      => esc_html__('Default View', 'houzez'),
                    'id'        => $houzez_prefix . 'default_view',
                    'type'      => 'select',
                    'options'   => array(
                        'list_view' => esc_html__('List View', 'houzez'),
                        'grid_view' => esc_html__('Grid View', 'houzez'),
                        'grid_view_3_col' => esc_html__('Grid View 3 col ( Only for "Property listing full width template" )', 'houzez')
                    ),
                    'std'       => array( 'list_view' ),
                    'desc'      => esc_html__('Select default view for listing page','houzez'),
                    'columns' => 6,
                ),
                array(
                    'name'      => esc_html__('Order Properties By', 'houzez'),
                    'id'        => $houzez_prefix . 'properties_sort',
                    'type'      => 'select',
                    'options'   => array(
                        'd_date'  => esc_html__('Date New to Old', 'houzez'),
                        'a_date'  => esc_html__('Date Old to New', 'houzez'),
                        'd_price' => esc_html__('Price (High to Low)', 'houzez'),
                        'a_price' => esc_html__('Price (Low to High)', 'houzez'),
                    ),
                    'std'       => array( 'd_date' ),
                    'desc'      => '',
                    'columns' => 6,
                ),
                array(
                    'id' => $houzez_prefix."listings_tabs",
                    'name' => esc_html__('Tabs', 'houzez'),
                    'desc' => esc_html__('Enable/Disable listing tabs', 'houzez'),
                    'type' => 'select',
                    'std' => "",
                    'options' => array('enable' => esc_html__('Enable', 'houzez'), 'disable' => esc_html__('Disable', 'houzez')),
                    'columns' => 12
                ),
                array(
                    'id' => $houzez_prefix."listings_tab_1",
                    'name' => esc_html__('Tabs One', 'houzez'),
                    'desc' => esc_html__('Choose property status for this tab', 'houzez'),
                    'type' => 'select',
                    'std' => "",
                    'options' => $prop_status,
                    'columns' => 6
                ),
                array(
                    'id' => $houzez_prefix."listings_tab_2",
                    'name' => esc_html__('Tabs Two', 'houzez'),
                    'desc' => esc_html__('Choose property status for this tab', 'houzez'),
                    'type' => 'select',
                    'std' => "",
                    'options' => $prop_status,
                    'columns' => 6
                ),
                array(
                    'id' => $houzez_prefix."featured_listing",
                    'name' => esc_html__('Featured Listings', 'houzez'),
                    'desc' => esc_html__('Enable/Disable featured listings on top. Ex: Show first (x) listings featured then non-featured', 'houzez'),
                    'type' => 'select',
                    'std' => "",
                    'options' => array('enable' => 'Enable', 'disable' => 'Disable'),
                    'columns' => 12
                ),
                array(
                    'id' => $houzez_prefix."featured_prop_no",
                    'name' => esc_html__('Number of featured listings to show', 'houzez'),
                    'desc' => "",
                    'type' => 'text',
                    'std' => "4",
                    'columns' => 6
                ),
                array(
                    'id' => $houzez_prefix."prop_no",
                    'name' => esc_html__('Number of listings to show', 'houzez'),
                    'desc' => "",
                    'type' => 'text',
                    'std' => "9",
                    'columns' => 6
                ),

                //Filters
                array(
                    'name'      => esc_html__('Locations', 'houzez'),
                    'id'        => $houzez_prefix . 'locations',
                    'type'      => 'select',
                    'options'   => $prop_locations,
                    'desc'      => '',
                    'columns' => 6,
                    'multiple' => true
                ),
                array(
                    'name'      => esc_html__('Types', 'houzez'),
                    'id'        => $houzez_prefix . 'types',
                    'type'      => 'select',
                    'options'   => $prop_types,
                    'desc'      => '',
                    'columns' => 6,
                    'multiple' => true
                ),
                array(
                    'name'      => esc_html__('Features', 'houzez' ),
                    'id'        => $houzez_prefix . 'features',
                    'type'      => 'select',
                    'options'   => $prop_features,
                    'desc'      => '',
                    'columns' => 6,
                    'multiple' => true
                ),
                array(
                    'name'      => esc_html__('Status', 'houzez' ),
                    'id'        => $houzez_prefix . 'status',
                    'type'      => 'select',
                    'options'   => $prop_status,
                    'desc'      => '',
                    'columns' => 6,
                    'multiple' => true
                ),
            )
        );

        /* ===========================================================================================
        *   Agents Template
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id'        => 'fave_agents_template',
            'title'     => esc_html__('Agents Options', 'houzez'),
            'pages'     => array( 'page' ),
            'context' => 'normal',

            'fields'    => array(
                array(
                    'name'      => esc_html__('Order By', 'houzez'),
                    'id'        => $houzez_prefix . 'agent_orderby',
                    'type'      => 'select',
                    'options'   => array('None' => 'none', 'ID' => 'ID', 'title' => 'title', 'Date' => 'date', 'Random' => 'rand', 'Menu Order' => 'menu_order' ),
                    'desc'      => '',
                    'columns' => 6,
                    'multiple' => false
                ),
                array(
                    'name'      => esc_html__('Order', 'houzez'),
                    'id'        => $houzez_prefix . 'agent_order',
                    'type'      => 'select',
                    'options'   => array('ASC' => 'ASC', 'DESC' => 'DESC' ),
                    'desc'      => '',
                    'columns' => 6,
                    'multiple' => false
                ),
                //Filters
                array(
                    'name'      => esc_html__('Agent Category', 'houzez'),
                    'id'        => $houzez_prefix . 'agent_category',
                    'type'      => 'select',
                    'options'   => $agent_categories,
                    'desc'      => '',
                    'columns' => 12,
                    'multiple' => true
                )
            )
        );

        /* ===========================================================================================
        *   Page Settings
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id'        => 'fave_default_template_settings',
            'title'     => esc_html__('Default Template Options', 'houzez' ),
            'pages'     => array( 'page' ),
            'context' => 'normal',

            'fields'    => array(
                array(
                    'name'      => esc_html__('Page Sidebar', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_sidebar',
                    'type'      => 'select',
                    'options'   => array(
                        'none' => esc_html__('None', 'houzez' ),
                        'right_sidebar' => esc_html__('Right Sidebar', 'houzez' ),
                        'left_sidebar' => esc_html__('Left Sidebar', 'houzez' )
                    ),
                    'std'       => array( 'right_sidebar' ),
                    'desc'      => esc_html__('Choose page Sidebar','houzez'),
                ),
                array(
                    'name'      => esc_html__('Page Background', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_background',
                    'type'      => 'select',
                    'options'   => array(
                        'none' => esc_html__('None', 'houzez' ),
                        'yes' => esc_html__('Yes', 'houzez' )
                    ),
                    'std'       => array( 'yes' ),
                    'desc'      => esc_html__('Choose page background','houzez'),
                )
            )
        );

        /* ===========================================================================================
        *   Page Settings
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id'        => 'fave_page_settings',
            'title'     => esc_html__('Page Header Options', 'houzez' ),
            'pages'     => array( 'page' ),
            'context' => 'normal',

            'fields'    => array(
                array(
                    'name'      => esc_html__('Header Type', 'houzez' ),
                    'id'        => $houzez_prefix . 'header_type',
                    'type'      => 'select',
                    'options'   => array(
                        'none' => esc_html__('None', 'houzez' ),
                        'property_slider' => esc_html__('Properties Slider', 'houzez' ),
                        'rev_slider' => esc_html__('Revolution Slider', 'houzez' ),
                        'property_map' => esc_html__('Properties Google Map', 'houzez' ),
                        'static_image' => esc_html__('Image', 'houzez' ),
                        'video' => esc_html__('Video', 'houzez' ),
                    ),
                    'std'       => array( 'none' ),
                    'desc'      => esc_html__('Choose page header type','houzez'),
                ),
                array(
                    'name'      => esc_html__('Full Screen', 'houzez' ),
                    'id'        => $houzez_prefix . 'header_full_screen',
                    'type'      => 'select',
                    'options'   => array(
                        'no' => esc_html__('No', 'houzez' ),
                        'yes' => esc_html__('Yes', 'houzez' )
                    ),
                    'std'       => array( 'no' ),
                    'desc'      => esc_html__('If "Yes" it will fit according to screen size' ,'houzez'),
                ),
                array(
                    'name'      => esc_html__('Title', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_title',
                    'type' => 'text',
                    'std' => '',
                    'desc' => '',
                ),
                array(
                    'name'      => esc_html__('Subtitle', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_subtitle',
                    'type' => 'text',
                    'std' => '',
                    'desc' => '',
                ),
                array(
                    'name'      => esc_html__('Show Search', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_search',
                    'type' => 'select',
                    'options' => array(
                        'no' => esc_html__('No', 'houzez' ),
                        'yes' => esc_html__('Yes', 'houzez' )
                    ),
                    'std'       => array( 'no' ),
                    'desc' => '',
                ),
                array(
                    'name'      => esc_html__('Revolution Slider', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_revslider',
                    'type' => 'select_advanced',
                    'std' => '',
                    'options' => houzez_get_revolution_slider(),
                    'multiple'    => false,
                    'placeholder' => esc_html__( 'Select an Slider', 'houzez' ),
                    'desc' => '',
                ),
                array(
                    'name'      => esc_html__('Image', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_image',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc'      => '',
                ),
                array(
                    'name'      => esc_html__('Image Height', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_image_height',
                    'type' => 'text',
                    'std' => '',
                    'desc' => esc_html__('Default 600px', 'houzez '),
                ),
                array(
                    'name'      => esc_html__('Overlay Color', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_image_overlay',
                    'type' => 'color',
                    'std' => '',
                    'desc' => '',
                ),
                array(
                    'name'      => esc_html__('Overlay Color Opacity', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_image_opacity',
                    'type' => 'select',
                    'options' => array(
                        '0' => '0',
                        '0.1' => '1',
                        '0.2' => '2',
                        '0.3' => '3',
                        '0.4' => '4',
                        '0.5' => '5',
                        '0.6' => '6',
                        '0.7' => '7',
                        '0.8' => '8',
                        '0.9' => '9',
                        '1' => '10',
                    ),
                    'std'       => array( '0.5' ),
                    'desc' => '',
                ),

                array(
                    'name' => esc_html__('MP4 File', 'houzez'),
                    'id' => "{$houzez_prefix}page_header_bg_mp4",
                    'type' => 'file_input'
                ),
                array(
                    'name' => esc_html__('WEBM File', 'houzez'),
                    'id' => "{$houzez_prefix}page_header_bg_webm",
                    'type' => 'file_input'
                ),
                array(
                    'name' => esc_html__('OGV File', 'houzez'),
                    'id' => "{$houzez_prefix}page_header_bg_ogv",
                    'type' => 'file_input'
                ),
                array(
                    'name'      => esc_html__('Video Overlay', 'houzez' ),
                    'id'        => $houzez_prefix . 'page_header_video_overlay',
                    'type' => 'select',
                    'options' => array(
                        'yes' => esc_html__('Yes', 'houzez' ),
                        'no' => esc_html__('No', 'houzez' )
                    ),
                    'std'       => array( 'yes' ),
                    'desc' => '',
                ),
                array(
                    'name'      => esc_html__('Overlay Image', 'houzez'),
                    'id'        => $houzez_prefix . 'page_header_video_overlay_img',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc'      => '',
                ),
                array(
                    'name'      => esc_html__('Video Image', 'houzez'),
                    'id'        => $houzez_prefix . 'page_header_video_img',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc'      => '',
                ),
                array(
                    'name'      => esc_html__('Select City', 'houzez'),
                    'id'        => $houzez_prefix . 'map_city',
                    'type'      => 'select',
                    'options'   => $prop_locations,
                    'desc'      => esc_html__('Choose city for proeprties on map header, you can select multiple cities or keep all un-select to show from all cities', 'houzez'),
                    'multiple' => true
                ),
            )
        );

        $meta_boxes[] = array(
            'id'        => 'fave_menu_settings',
            'title'     => esc_html__('Page Navigation Options', 'houzez' ),
            'pages'     => array( 'page' ),
            'context' => 'normal',
            'fields'    => array(
                array(
                    'name'      => esc_html__('Main Menu Transparent ?', 'houzez'),
                    'id'        => $houzez_prefix . 'main_menu_trans',
                    'type'      => 'select',
                    'options'   => array(
                        'no' => esc_html__('No', 'houzez' ),
                        'yes' => esc_html__('Yes', 'houzez' )
                    ),
                    'std'       => array( 'no' ),
                    'desc'      => esc_html__('Will only work with header 4, you can choose header 4 from theme options','houzez'),
                ),
            )
        );

        /* ===========================================================================================
        *   Post Meta
        * ============================================================================================*/

        $meta_boxes[] = array(
            'id' => 'fave_format_gallery',
            'title' => esc_html__('Gallery Format', 'houzez' ),
            'pages' => array( 'post' ),
            'context' => 'normal',
            'priority' => 'high',

            'fields' => array(
                array(
                    'name' => esc_html__('Upload Gallery Images: ', 'houzez' ),
                    'desc' => '',
                    'id' => $houzez_prefix . 'gallery_posts',
                    'type' => 'image_advanced',
                    'std' => ''
                )
            )
        );

        $meta_boxes[] = array(
            'id' => 'fave_format_video',
            'title' => esc_html__('Video Format', 'houzez' ),
            'pages' => array( 'post' ),
            'context' => 'normal',
            'priority' => 'high',

            'fields' => array(
                array(
                    'name' => esc_html__('Add video page url: ', 'houzez' ),
                    'desc' => '',
                    'id' => $houzez_prefix . 'video_post',
                    'type' => 'text',
                    'std' => '',
                    'desc'  => __(' - For exmaple https://vimeo.com/120596335', 'houzez' )
                )
            )
        );

        $meta_boxes[] = array(
            'id' => 'fave_format_audio',
            'title' => esc_html__('Audio Format', 'houzez' ),
            'pages' => array( 'post' ),
            'context' => 'normal',
            'priority' => 'high',

            'fields' => array(
                array(
                    'name' => esc_html__('Add SoundCloud Audio: ', 'houzez' ),
                    'desc' => '',
                    'id' => $houzez_prefix . 'audio_post',
                    'type' => 'text',
                    'std' => '',
                    'desc'  => esc_html__(' - Paste page URL from SoundCloud', 'houzez' )
                )
            )
        );


        /* ===========================================================================================
        *   Advanced Search
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id' => 'fave_advanced_search',
            'title' => esc_html__('Advanced Search', 'houzez' ),
            'pages' => array( 'page' ),
            'context' => 'side',
            'priority' => 'high',

            'fields' => array(

                array(
                    'name' => esc_html__('Advanced Search', 'houzez'),
                    'desc' => '',
                    'id' => $houzez_prefix . 'adv_search_enable',
                    'type' => 'select',
                    'options' => array(
                        'global' => esc_html__('Global ( As theme options settings )', 'houzez'),
                        'current_page' => esc_html__('Custom Settings for this Page', 'houzez')
                    ),
                    'std'   => array( 'global' ),
                    'desc'  => ''
                ),
                array(
                    'name' => esc_html__('Search Options ', 'houzez'),
                    'desc' => '',
                    'id' => $houzez_prefix . 'adv_search',
                    'type' => 'select',
                    'options' => array(
                        'hide' => esc_html__('Hide for This Page', 'houzez'),
                        'show' => esc_html__('Show for This Page', 'houzez'),
                        'hide_show' => esc_html__('Hide but show on scroll', 'houzez'),
                    ),
                    'std'   => array( 'hide' ),
                    'desc'  => ''
                ),
                array(
                    'name' => esc_html__('Search Position ', 'houzez'),
                    'desc' => '',
                    'id' => $houzez_prefix . 'adv_search_pos',
                    'type' => 'select',
                    'options' => array(
                        'under_menu' => esc_html__('Under Navigation', 'houzez'),
                        'under_banner' => esc_html__('Under Banners ( Sliders, Map, Video etc )', 'houzez')
                    ),
                    'std'   => array( 'under_menu' ),
                    'desc'  => ''
                )
            )
        );

        /* ===========================================================================================
        *   Testimonials
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id'        => 'fave_testimonials',
            'title'     => esc_html__('Testimonial Details', 'houzez' ),
            'pages'     => array( 'houzez_testimonials' ),
            'context' => 'normal',

            'fields'    => array(
                array(
                    'name'      => esc_html__('Testimonial Text', 'houzez' ),
                    'id'        => $houzez_prefix . 'testi_text',
                    'type'      => 'textarea',
                    'desc'      => esc_html__('Write a testimonial into the textarea.','houzez'),
                ),
                array(
                    'name'      => esc_html__('By who?', 'houzez'),
                    'id'        => $houzez_prefix . 'testi_name',
                    'type'      => 'text',
                    'desc'      => esc_html__('Name of the client who gave feedback','houzez'),
                ),
                array(
                    'name'      => esc_html__('Position', 'houzez'),
                    'id'        => $houzez_prefix . 'testi_position',
                    'type'      => 'text',
                    'desc'      => esc_html__('Ex: Founder & CEO.','houzez'),
                ),
                array(
                    'name'      => esc_html__('Company Name', 'houzez'),
                    'id'        => $houzez_prefix . 'testi_company',
                    'type'      => 'text',
                    'desc'      => '',
                ),
                array(
                    'name'      => esc_html__('Photo', 'houzez'),
                    'id'        => $houzez_prefix . 'testi_photo',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc'      => '',
                ),
                array(
                    'name'      => esc_html__('Company Logo', 'houzez'),
                    'id'        => $houzez_prefix . 'testi_logo',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc'      => '',
                )
            )
        );

        /* ===========================================================================================
        *   Partners
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id'        => 'fave_partners',
            'title'     => esc_html__('Partner Information', 'houzez'),
            'pages'     => array( 'houzez_partner' ),
            'context' => 'normal',

            'fields'    => array(
                array(
                    'name'      => esc_html__('Website Url', 'houzez'),
                    'id'        => $houzez_prefix . 'partner_website',
                    'type'      => 'text',
                    'desc'      => esc_html__('Provide website url.','houzez'),
                )
            )
        );

        /* ===========================================================================================
        *   Partners
        * ============================================================================================*/
        $meta_boxes[] = array(
            'id'        => 'houzez_agencies',
            'title'     => esc_html__('Agency Information', 'houzez'),
            'pages'     => array( 'houzez_agency' ),
            'context' => 'normal',

            'fields'    => array(
                array(
                    'name'      => esc_html__('Email', 'houzez'),
                    'id'        => $houzez_prefix . 'agency_email',
                    'type'      => 'text',
                    'desc'      => esc_html__('Enter email address','houzez'),
                    'columns'   => 6
                ),
                array(
                    'name'      => esc_html__('Mobile', 'houzez'),
                    'id'        => $houzez_prefix . 'agency_mobile',
                    'type'      => 'text',
                    'desc'      => '',
                    'columns'   => 6
                ),
                array(
                    'name'      => esc_html__('Phone Number', 'houzez'),
                    'id'        => $houzez_prefix . 'agency_phone',
                    'type'      => 'text',
                    'desc'      => '',
                    'columns'   => 6
                ),
                array(
                    'name'      => esc_html__('Fax', 'houzez'),
                    'id'        => $houzez_prefix . 'agency_fax',
                    'type'      => 'text',
                    'desc'      => '',
                    'columns'   => 6
                ),
                array(
                    'name'      => esc_html__('Licenses', 'houzez'),
                    'id'        => $houzez_prefix . 'agency_licenses',
                    'type'      => 'text',
                    'desc'      => '',
                    'columns'   => 6
                ),
                array(
                    'name'      => esc_html__('Website Url', 'houzez'),
                    'id'        => $houzez_prefix . 'agency_web',
                    'type'      => 'text',
                    'desc'      => esc_html__('Provide website url.','houzez'),
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agency_facebook",
                    'name' => "Facebook URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agency_twitter",
                    'name' => "Twitter URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agency_linkedin",
                    'name' => "LinkedIn URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agency_googleplus",
                    'name' => "Google Plus URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agent_youtube",
                    'name' => "Youtube URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agency_instagram",
                    'name' => "Instagram URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agency_pinterest",
                    'name' => "Pinterest URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agency_vimeo",
                    'name' => "Vimeo URL",
                    'type' => 'text',
                    'std' => "",
                    'columns'   => 6
                ),
                array(
                    'id' => "{$houzez_prefix}agency_address",
                    'name' => esc_html__('Address', 'houzez'),
                    'type' => 'textarea',
                    'std' => "",
                    'columns'   => 12
                ),
                array(
                    'id' => "{$houzez_prefix}agency_map_address",
                    'name' => esc_html__('Agency Location', 'houzez'),
                    'desc' => esc_html__('Leave it empty if you want to hide map on agency detail page.', 'houzez'),
                    'type' => 'text',
                    'std' => '',
                    'columns' => 12
                ),
                array(
                    'id' => "{$houzez_prefix}agency_location",
                    'name' => esc_html__('Agency Location at Google Map*', 'houzez'),
                    'desc' => esc_html__('Drag the google map marker to point your agency location. You can also use the address field above to search for your agency.', 'houzez'),
                    'type' => 'map',
                    'std' => '25.686540,-80.431345,15',   // 'latitude,longitude[,zoom]' (zoom is optional)
                    'style' => 'width: 95%; height: 400px',
                    'address_field' => "{$houzez_prefix}agency_map_address",
                    'columns' => 12
                ),
            )
        );

        $meta_boxes = apply_filters('houzez_theme_meta', $meta_boxes);

        return $meta_boxes;

    }
} // End Meta boxes


// Get revolution sliders
if( !function_exists('houzez_get_revolution_slider') ) {
    function houzez_get_revolution_slider()
    {
        global $wpdb;
        $catList = array();
        //Revolution Slider
        if (is_plugin_active('revslider/revslider.php')) {
            $sliders = $wpdb->get_results($q = "SELECT * FROM " . $wpdb->prefix . "revslider_sliders ORDER BY id LIMIT 100");

            // Iterate over the sliders
            $catList = array();
            foreach ($sliders as $key => $item) {
                $catList[$item->alias] = stripslashes($item->title);
            }
        }

        return $catList;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get terms array
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_get_terms_array' ) ) {
    function houzez_get_terms_array( $tax_name, &$terms_array ) {
        $tax_terms = get_terms( $tax_name, array(
            'hide_empty' => false,
        ) );
        houzez_add_term_children( 0, $tax_terms, $terms_array );
    }
}


if ( ! function_exists( 'houzez_add_term_children' ) ) :
    function houzez_add_term_children( $parent_id, $tax_terms, &$terms_array, $prefix = '' ) {
        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ) {
            foreach ( $tax_terms as $term ) {
                if ( $term->parent == $parent_id ) {
                    $terms_array[ $term->slug ] = $prefix . $term->name;
                    houzez_add_term_children( $term->term_id, $tax_terms, $terms_array, $prefix . '- ' );
                }
            }
        }
    }
endif;

?>