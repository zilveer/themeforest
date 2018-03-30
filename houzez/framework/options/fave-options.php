<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

if ( ! class_exists( 'Redux' ) ) {
    return;
}

$allowed_html_array = array(
    'i' => array(
        'class' => array()
    ),
    'span' => array(
        'class' => array()
    ),
    'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array()
    )
);

// This is your option name where all the Redux data is stored.
$opt_name = "houzez_options";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );
$redux_path = ReduxFramework::$_dir;
$redux_url  = ReduxFramework::$_url;
$img_url = $redux_url. 'assets/img/';



/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__( 'Theme Options', 'houzez' ),
    'page_title'           => esc_html__( 'Options Options', 'houzez' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'houzez_options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = array(
    'id'    => 'houzez-support',
    'href'  => 'https://favethemes.ticksy.com',
    'title' => esc_html__( 'Support', 'houzez' ),
);


$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/Favethemes/',
    'title' => 'Like us on Facebook',
    'icon'  => 'el el-facebook'
);
$args['share_icons'][] = array(
    'url'   => 'http://twitter.com/favethemes',
    'title' => 'Follow us on Twitter',
    'icon'  => 'el el-twitter'
);


Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

// Change the arguments after they've been declared, but before the panel is created
add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if ( ! function_exists( 'change_arguments' ) ) {
    function change_arguments( $args ) {
        $args['dev_mode'] = false;

        return $args;
    }
}
$date_languages = array(  'xx'=> 'default',
    'af'=>'Afrikaans',
    'ar'=>'Arabic',
    'ar-DZ' =>'Algerian',
    'az'=>'Azerbaijani',
    'be'=>'Belarusian',
    'bg'=>'Bulgarian',
    'bs'=>'Bosnian',
    'ca'=>'Catalan',
    'cs'=>'Czech',
    'cy-GB'=>'Welsh/UK',
    'da'=>'Danish',
    'de'=>'German',
    'el'=>'Greek',
    'en-AU'=>'English/Australia',
    'en-GB'=>'English/UK',
    'en-NZ'=>'English/New Zealand',
    'eo'=>'Esperanto',
    'es'=>'Spanish',
    'et'=>'Estonian',
    'eu'=>'Karrikas-ek',
    'fa'=>'Persian',
    'fi'=>'Finnish',
    'fo'=>'Faroese',
    'fr'=>'French',
    'fr-CA'=>'Canadian-French',
    'fr-CH'=>'Swiss-French',
    'gl'=>'Galician',
    'he'=>'Hebrew',
    'hi'=>'Hindi',
    'hr'=>'Croatian',
    'hu'=>'Hungarian',
    'hy'=>'Armenian',
    'id'=>'Indonesian',
    'ic'=>'Icelandic',
    'it'=>'Italian',
    'it-CH'=>'Italian-CH',
    'ja'=>'Japanese',
    'ka'=>'Georgian',
    'kk'=>'Kazakh',
    'km'=>'Khmer',
    'ko'=>'Korean',
    'ky'=>'Kyrgyz',
    'lb'=>'Luxembourgish',
    'lt'=>'Lithuanian',
    'lv'=>'Latvian',
    'mk'=>'Macedonian',
    'ml'=>'Malayalam',
    'ms'=>'Malaysian',
    'nb'=>'Norwegian',
    'nl'=>'Dutch',
    'nl-BE'=>'Dutch-Belgium',
    'nn'=>'Norwegian-Nynorsk',
    'no'=>'Norwegian',
    'pl'=>'Polish',
    'pt'=>'Portuguese',
    'pt-BR'=>'Brazilian',
    'rm'=>'Romansh',
    'ro'=>'Romanian',
    'ru'=>'Russian',
    'sk'=>'Slovak',
    'sl'=>'Slovenian',
    'sq'=>'Albanian',
    'sr'=>'Serbian',
    'sr-SR'=>'Serbian-i18n',
    'sv'=>'Swedish',
    'ta'=>'Tamil',
    'th'=>'Thai',
    'tj'=>'Tajiki',
    'tr'=>'Turkish',
    'uk'=>'Ukrainian',
    'vi'=>'Vietnamese',
    'zh-CN'=>'Chinese',
    'zh-HK'=>'Chinese-Hong-Kong',
    'zh-TW'=>'Chinese Taiwan',
);

$Countries = array(
    'US' => 'United States',
    'CA' => 'Canada',
    'AU' => 'Australia',
    'FR' => 'France',
    'DE' => 'Germany',
    'IS' => 'Iceland',
    'IE' => 'Ireland',
    'IT' => 'Italy',
    'ES' => 'Spain',
    'SE' => 'Sweden',
    'AT' => 'Austria',
    'BE' => 'Belgium',
    'FI' => 'Finland',
    'CZ' => 'Czech Republic',
    'DK' => 'Denmark',
    'NO' => 'Norway',
    'GB' => 'United Kingdom',
    'CH' => 'Switzerland',
    'NZ' => 'New Zealand',
    'RU' => 'Russian Federation',
    'PT' => 'Portugal',
    'NL' => 'Netherlands',
    'IM' => 'Isle of Man',
    'AF' => 'Afghanistan',
    'AX' => 'Aland Islands ',
    'AL' => 'Albania',
    'DZ' => 'Algeria',
    'AS' => 'American Samoa',
    'AD' => 'Andorra',
    'AO' => 'Angola',
    'AI' => 'Anguilla',
    'AQ' => 'Antarctica',
    'AG' => 'Antigua and Barbuda',
    'AR' => 'Argentina',
    'AM' => 'Armenia',
    'AW' => 'Aruba',
    'AZ' => 'Azerbaijan',
    'BS' => 'Bahamas',
    'BH' => 'Bahrain',
    'BD' => 'Bangladesh',
    'BB' => 'Barbados',
    'BY' => 'Belarus',
    'BZ' => 'Belize',
    'BJ' => 'Benin',
    'BM' => 'Bermuda',
    'BT' => 'Bhutan',
    'BO' => 'Bolivia, Plurinational State of',
    'BQ' => 'Bonaire, Sint Eustatius and Saba',
    'BA' => 'Bosnia and Herzegovina',
    'BW' => 'Botswana',
    'BV' => 'Bouvet Island',
    'BR' => 'Brazil',
    'IO' => 'British Indian Ocean Territory',
    'BN' => 'Brunei Darussalam',
    'BG' => 'Bulgaria',
    'BF' => 'Burkina Faso',
    'BI' => 'Burundi',
    'KH' => 'Cambodia',
    'CM' => 'Cameroon',
    'CV' => 'Cape Verde',
    'KY' => 'Cayman Islands',
    'CF' => 'Central African Republic',
    'TD' => 'Chad',
    'CL' => 'Chile',
    'CN' => 'China',
    'CX' => 'Christmas Island',
    'CC' => 'Cocos (Keeling) Islands',
    'CO' => 'Colombia',
    'KM' => 'Comoros',
    'CG' => 'Congo',
    'CD' => 'Congo, the Democratic Republic of the',
    'CK' => 'Cook Islands',
    'CR' => 'Costa Rica',
    'CI' => 'Cote d\'Ivoire',
    'HR' => 'Croatia',
    'CU' => 'Cuba',
    'CW' => 'Curaçao',
    'CY' => 'Cyprus',
    'DJ' => 'Djibouti',
    'DM' => 'Dominica',
    'DO' => 'Dominican Republic',
    'EC' => 'Ecuador',
    'EG' => 'Egypt',
    'SV' => 'El Salvador',
    'GQ' => 'Equatorial Guinea',
    'ER' => 'Eritrea',
    'EE' => 'Estonia',
    'ET' => 'Ethiopia',
    'FK' => 'Falkland Islands (Malvinas)',
    'FO' => 'Faroe Islands',
    'FJ' => 'Fiji',
    'GF' => 'French Guiana',
    'PF' => 'French Polynesia',
    'TF' => 'French Southern Territories',
    'GA' => 'Gabon',
    'GM' => 'Gambia',
    'GE' => 'Georgia',
    'GH' => 'Ghana',
    'GI' => 'Gibraltar',
    'GR' => 'Greece',
    'GL' => 'Greenland',
    'GD' => 'Grenada',
    'GP' => 'Guadeloupe',
    'GU' => 'Guam',
    'GT' => 'Guatemala',
    'GG' => 'Guernsey',
    'GN' => 'Guinea',
    'GW' => 'Guinea-Bissau',
    'GY' => 'Guyana',
    'HT' => 'Haiti',
    'HM' => 'Heard Island and McDonald Islands',
    'VA' => 'Holy See (Vatican City State)',
    'HN' => 'Honduras',
    'HK' => 'Hong Kong',
    'HU' => 'Hungary',
    'IN' => 'India',
    'ID' => 'Indonesia',
    'IR' => 'Iran, Islamic Republic of',
    'IQ' => 'Iraq',
    'IL' => 'Israel',
    'JM' => 'Jamaica',
    'JP' => 'Japan',
    'JE' => 'Jersey',
    'JO' => 'Jordan',
    'KZ' => 'Kazakhstan',
    'KE' => 'Kenya',
    'KI' => 'Kiribati',
    'KP' => 'Korea, Democratic People\'s Republic of',
    'KR' => 'Korea, Republic of',
    'KV' => 'kosovo',
    'KW' => 'Kuwait',
    'KG' => 'Kyrgyzstan',
    'LA' => 'Lao People\'s Democratic Republic',
    'LV' => 'Latvia',
    'LB' => 'Lebanon',
    'LS' => 'Lesotho',
    'LR' => 'Liberia',
    'LY' => 'Libyan Arab Jamahiriya',
    'LI' => 'Liechtenstein',
    'LT' => 'Lithuania',
    'LU' => 'Luxembourg',
    'MO' => 'Macao',
    'MK' => 'Macedonia',
    'MG' => 'Madagascar',
    'MW' => 'Malawi',
    'MY' => 'Malaysia',
    'MV' => 'Maldives',
    'ML' => 'Mali',
    'MT' => 'Malta',
    'MH' => 'Marshall Islands',
    'MQ' => 'Martinique',
    'MR' => 'Mauritania',
    'MU' => 'Mauritius',
    'YT' => 'Mayotte',
    'MX' => 'Mexico',
    'FM' => 'Micronesia, Federated States of',
    'MD' => 'Moldova, Republic of',
    'MC' => 'Monaco',
    'MN' => 'Mongolia',
    'ME' => 'Montenegro',
    'MS' => 'Montserrat',
    'MA' => 'Morocco',
    'MZ' => 'Mozambique',
    'MM' => 'Myanmar',
    'NA' => 'Namibia',
    'NR' => 'Nauru',
    'NP' => 'Nepal',
    'NC' => 'New Caledonia',
    'NI' => 'Nicaragua',
    'NE' => 'Niger',
    'NG' => 'Nigeria',
    'NU' => 'Niue',
    'NF' => 'Norfolk Island',
    'MP' => 'Northern Mariana Islands',
    'OM' => 'Oman',
    'PK' => 'Pakistan',
    'PW' => 'Palau',
    'PS' => 'Palestinian Territory, Occupied',
    'PA' => 'Panama',
    'PG' => 'Papua New Guinea',
    'PY' => 'Paraguay',
    'PE' => 'Peru',
    'PH' => 'Philippines',
    'PN' => 'Pitcairn',
    'PL' => 'Poland',
    'PR' => 'Puerto Rico',
    'QA' => 'Qatar',
    'RE' => 'Reunion',
    'RO' => 'Romania',
    'RW' => 'Rwanda',
    'BL' => 'Saint Barthélemy',
    'SH' => 'Saint Helena',
    'KN' => 'Saint Kitts and Nevis',
    'LC' => 'Saint Lucia',
    'MF' => 'Saint Martin (French part)',
    'PM' => 'Saint Pierre and Miquelon',
    'VC' => 'Saint Vincent and the Grenadines',
    'WS' => 'Samoa',
    'SM' => 'San Marino',
    'ST' => 'Sao Tome and Principe',
    'SA' => 'Saudi Arabia',
    'SN' => 'Senegal',
    'RS' => 'Serbia',
    'SC' => 'Seychelles',
    'SL' => 'Sierra Leone',
    'SG' => 'Singapore',
    'SX' => 'Sint Maarten (Dutch part)',
    'SK' => 'Slovakia',
    'SI' => 'Slovenia',
    'SB' => 'Solomon Islands',
    'SO' => 'Somalia',
    'ZA' => 'South Africa',
    'GS' => 'South Georgia and the South Sandwich Islands',
    'LK' => 'Sri Lanka',
    'SD' => 'Sudan',
    'SR' => 'Suriname',
    'SJ' => 'Svalbard and Jan Mayen',
    'SZ' => 'Swaziland',
    'SY' => 'Syrian Arab Republic',
    'TW' => 'Taiwan, Province of China',
    'TJ' => 'Tajikistan',
    'TZ' => 'Tanzania, United Republic of',
    'TH' => 'Thailand',
    'TL' => 'Timor-Leste',
    'TG' => 'Togo',
    'TK' => 'Tokelau',
    'TO' => 'Tonga',
    'TT' => 'Trinidad and Tobago',
    'TN' => 'Tunisia',
    'TR' => 'Turkey',
    'TM' => 'Turkmenistan',
    'TC' => 'Turks and Caicos Islands',
    'TV' => 'Tuvalu',
    'UG' => 'Uganda',
    'UA' => 'Ukraine',
    'AE' => 'United Arab Emirates',
    'UM' => 'United States Minor Outlying Islands',
    'UY' => 'Uruguay',
    'UZ' => 'Uzbekistan',
    'VU' => 'Vanuatu',
    'VE' => 'Venezuela, Bolivarian Republic of',
    'VN' => 'Viet Nam',
    'VG' => 'Virgin Islands, British',
    'VI' => 'Virgin Islands, U.S.',
    'WF' => 'Wallis and Futuna',
    'EH' => 'Western Sahara',
    'YE' => 'Yemen',
    'ZM' => 'Zambia',
    'ZW' => 'Zimbabwe'
);

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'General', 'houzez' ),
    'id'     => 'general-options',
    'desc'   => '',
    'icon'   => 'el-icon-home el-icon-small',
    'fields'		=> array(
        array(
            'id'		=> 'default_country',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Country', 'houzez' ),
            'subtitle'	=> esc_html__( 'Select default country', 'houzez' ),
            'options'	=> $Countries,
            'default' => 'US'
        ),
        array(
            'id'		=> 'houzez_date_language',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Language for datepicker', 'houzez' ),
            'subtitle'	=> esc_html__( 'This applies for the calendar field type available for properties.', 'houzez' ),
            'options'	=> $date_languages,
            'default' => 'US'
        ),
        array(
            'id'       => 'use_houzez_roles',
            'type'     => 'switch',
            'title'    => esc_html__( 'Use Houzez Custom Role', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'If Enable only user which has role Houzez Agent or Author can add new property', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'disable_compare',
            'type'     => 'switch',
            'title'    => esc_html__( 'Compare', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable property compare', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'disable_favorite',
            'type'     => 'switch',
            'title'    => esc_html__( 'Favorite', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable property favorite', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'users_admin_access',
            'type'     => 'switch',
            'title'    => esc_html__( 'Users Admin Access ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable user admin panel access', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'auto_property_id',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Generate Property ID ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable auto generate property id', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'measurement_unit_global',
            'type'     => 'switch',
            'title'    => esc_html__( 'Measurement Unit Globally', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable property measurement unit globally, it will overwrite measurement unit added for single properties', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'		=> 'measurement_unit',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Measurement Unit', 'houzez' ),
            'subtitle'	=> esc_html__( 'Select the measurement unit you will use on the website', 'houzez' ),
            'required' => array( 'measurement_unit_global', '=', '1' ),
            'options'	=> array(
                'sqft' => 'Square Feet - ft²',
                'sq_meter' => 'Square Meters - m²',
            ),
            'default' => 'sqft'
        ),

        array(
            'id'		=> 'measurement_unit_adv_search',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Advanced Search Measurement Unit', 'houzez' ),
            'subtitle'	=> esc_html__( 'Select the measurement unit for advanced searches', 'houzez' ),
            'options'	=> array(
                'sqft' => 'Square Feet - ft²',
                'sq_meter' => 'Square Meters - m²',
            ),
            'default' => 'sqft'
        ),
        array(
            'id'		=> 'measurement_unit_sqft_text',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Square Feet Text', 'houzez' ),
            'subtitle'	=> esc_html__( 'Enter text for square feet', 'houzez' ),
            'default' => 'sqft'
        ),
        array(
            'id'		=> 'measurement_unit_square_meter_text',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Square Meters Text', 'houzez' ),
            'subtitle'	=> esc_html__( 'Enter text for square meters', 'houzez' ),
            'default' => 'm²'
        ),

        array(
            'id'		=> 'taxonomies_default_view',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Taxonomies Default View', 'houzez' ),
            'subtitle'	=> esc_html__( 'Select default view for taxonomies( City, Area, Type, Status, State ) pages. ', 'houzez' ),
            'options'	=> array(
                'list_view' => 'List View',
                'grid_view' => 'Grid View',
            ),
            'default' => 'list_view'
        ),

        array(
            'id'       => 'video_loop',
            'type'     => 'switch',
            'title'    => esc_html__( 'Video Loop', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable video loop on splash page and video header', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'video_audio',
            'type'     => 'switch',
            'title'    => esc_html__( 'Video Audio', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable video audio on splash page and video header', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'images_overlay',
            'type'     => 'switch',
            'title'    => esc_html__( 'Images overlay ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Remove dark gradient overlay over the images', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'site_breadcrumb',
            'type'     => 'switch',
            'title'    => esc_html__( 'Breadcrumb?', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable breadcrumb', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'site_scroll_top',
            'type'     => 'switch',
            'title'    => esc_html__( 'Scroll To Top?', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable Scroll to top', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'sticky_sidebar',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Sticky Sidebar', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Choose which sidebars you want to be sticky?', 'houzez'),
            'options'  => array(
                'default_sidebar' => esc_html__('Default Sidebar', 'houzez'),
                'property_listings' => esc_html__('Property listings', 'houzez'),
                'single_property' => esc_html__('Single Property', 'houzez'),
                'agent_sidebar' => esc_html__('Agent Sidebar', 'houzez'),
                'search_sidebar' => esc_html__('Search Sidebar', 'houzez'),
                'page_sidebar' => esc_html__('Page Sidebar', 'houzez'),
                'create_listing' => esc_html__('Create listing Sidebar', 'houzez')
            ),
            'default' => array(
                'default_sidebar' => '0',
                'property_listings' => '0',
                'single_property' => '0',
                'agent_sidebar' => '0',
                'search_sidebar' => '0',
                'page_sidebar' => '0',
                'create_listing' => '0'
            )
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Logos & Favicon', 'houzez' ),
    'id'     => 'logo-favicon',
    'desc'   => '',
    'icon'   => 'el-icon-home el-icon-small',
    'fields'		=> array(
        array(
            'id'		=> 'custom_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Logo', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logo/logo-houzez-white.png' ),
            'subtitle'	=> esc_html__( 'Upload your custom site logo.', 'houzez' ),
        ),

        array(
            'id'		=> 'retina_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Retina Logo', 'houzez' ),
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logo/logo-houzez-white@2x.png' ),
            'subtitle'	=> esc_html__( 'Upload your retina logo (optional).', 'houzez' ),
        ),

        array(
            'id'		=> 'mobile_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Mobile Logo', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logo/logo-houzez-white.png' ),
            'subtitle'	=> esc_html__( 'Upload your custom site logo for mobiles.', 'houzez' ),
        ),

        array(
            'id'		=> 'mobile_retina_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Mobile Retina Logo', 'houzez' ),
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logo/logo-houzez-white@2x.png' ),
            'subtitle'	=> esc_html__( 'Upload your retina logo for mobiles (optional).', 'houzez' ),
        ),

        array(
            'id'		=> 'custom_logo_splash',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Logo Splash & Transparent Header', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logos/logo-houzez-white.png' ),
            'subtitle'	=> esc_html__( 'Upload your custom logo for splash page and transparent header.', 'houzez' ),
        ),

        array(
            'id'		=> 'retina_logo_splash',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Retina Logo Splash  & Transparent Header', 'houzez' ),
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logos/logo-houzez-white@2x.png' ),
            'subtitle'	=> esc_html__( 'Upload your retina logo for splash page and transparent header (optional).', 'houzez' ),
        ),

        array(
            'id'       => 'logo_desktop_dimensions',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Desktop logo (Width/Height) Option', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => array(
                'Width'   => '',
                'Height'  => ''
            ),
        ),

        array(
            'id'       => 'logo_mobile_dimensions',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Tablet & Mobile logo (Width/Height) Option', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => array(
                'Width'   => '',
                'Height'  => ''
            ),
        ),

        array(
            'id'		=> 'retina_logo_height',
            'type'		=> 'text',
            'default'	=> '24px',
            'title'		=> esc_html__( 'Standard Logo Height', 'houzez' ),
            'subtitle'	=> esc_html__( 'Enter your standard logo height. Used for retina logo.', 'houzez' ),
        ),

        array(
            'id'		=> 'retina_logo_width',
            'type'		=> 'text',
            'default'	=> '140px',
            'title'		=> esc_html__( 'Standard Logo Width', 'houzez' ),
            'subtitle'	=> esc_html__( 'Enter your standard logo width. Used for retina logo.', 'houzez' ),
        ),

        array(
            'id'	=> 'favicon',
            'url'			=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Favicon', 'houzez' ),
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/favicons/favicon.png' ),
            'subtitle'	=> esc_html__( 'Upload your custom site favicon.', 'houzez' ),
        ),

        array(
            'id'		=> 'iphone_icon',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Apple iPhone Icon ', 'houzez' ),
            'default'	=> array(
                'url'	=> get_template_directory_uri() .'/images/favicons/favicon-57x57.png'
            ),
            'subtitle'	=> esc_html__( 'Upload your custom iPhone icon (57px by 57px).', 'houzez' ),
        ),

        array(
            'id'		=> 'iphone_icon_retina',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Apple iPhone Retina Icon ', 'houzez' ),
            'default'	=> array(
                'url'	=> get_template_directory_uri() .'/images/favicons/favicon-114x114.png'
            ),
            'subtitle'	=> esc_html__( 'Upload your custom iPhone retina icon (114px by 114px).', 'houzez' ),
        ),

        array(
            'id'		=> 'ipad_icon',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Apple iPad Icon ', 'houzez' ),
            'default'	=> array(
                'url'	=> get_template_directory_uri() .'/images/favicons/favicon-72x72.png'
            ),
            'subtitle'	=> esc_html__( 'Upload your custom iPad icon (72px by 72px).', 'houzez' ),
        ),

        array(
            'id'		=> 'ipad_icon_retina',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Apple iPad Retina Icon ', 'houzez' ),
            'default'	=> array(
                'url'	=> get_template_directory_uri() .'/images/favicons/favicon-144x144.png'
            ),
            'subtitle'	=> esc_html__( 'Upload your custom iPad retina icon (144px by 144px).', 'houzez' ),
        )
    ),
) );

/* **********************************************************************
 * Headers
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Headers', 'houzez' ),
    'id'               => 'headers',
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-screen'
) );
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Style', 'houzez' ),
    'id'               => 'header-styles',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'header_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Select header style', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                '1'	=> esc_html__( 'One', 'houzez' ),
                '2'	=> esc_html__( 'Two', 'houzez' ),
                '3'	=> esc_html__( 'Three', 'houzez' ),
                '4' => esc_html__( 'Four', 'houzez' ),
                /*'transparent' => esc_html__( 'Header Transparent', 'houzez' )*/
            ),
            'desc'     => '',
            'default'  => '1'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'header_1_width',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', 'houzez' ),
            'subtitle' => '',
            'required' => array('header_style', '=', '1'),
            'options'	=> array(
                'container'	=> esc_html__( 'Boxed', 'houzez' ),
                'container-fluid'	=> esc_html__( 'Full Width', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'container'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'header_1_menu_align',
            'type'     => 'select',
            'title'    => esc_html__( 'Navigation Align', 'houzez' ),
            'subtitle' => esc_html__( 'Select navigation align', 'houzez' ),
            'required' => array('header_style', '=', '1' ),
            'options'	=> array(
                'nav-left'	=> esc_html__( 'Left Align', 'houzez' ),
                'nav-right'	=> esc_html__( 'Right Align', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'nav-left'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'main-menu-sticky',
            'type'     => 'switch',
            'title'    => esc_html__( 'Sticky Menu', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable sticky menu', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'mobile-menu-sticky',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mobile Sticky Menu', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable sticky menu in mobiles', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'header_4_width',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', 'houzez' ),
            'subtitle' => '',
            'required' => array('header_style', '=', '4'),
            'options'   => array(
                'container' => esc_html__( 'Boxed', 'houzez' ),
                'container-fluid'   => esc_html__( 'Full Width', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'container'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'header_4_menu_align',
            'type'     => 'select',
            'title'    => esc_html__( 'Navigation Align', 'houzez' ),
            'subtitle' => esc_html__( 'Select navigation align', 'houzez' ),
            'required' => array('header_style', '=', '4' ),
            'options'	=> array(
                'nav-left'	=> esc_html__( 'Left Align', 'houzez' ),
                'nav-right'	=> esc_html__( 'Right Align', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'nav-left'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'hd3_callus_section-start',
            'type'     => 'section',
            'required' => array('header_style', '=', '3'),
            'title'    => esc_html__( 'Call Us', 'houzez' ),
            'subtitle' => esc_html__( 'Call us number in header', 'houzez' ),
            'indent'   => true, // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id'       => 'hd3_callus',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable call us in header', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'hd3_call_us_image',
            'type'     => 'media',
            'required' => array('hd3_callus', '=', '1'),
            'url'      => true,
            'title'    => esc_html__( 'Upload image', 'houzez' ),
            'subtitle' => esc_html__('Recommended size 85 x 85', 'houzez'),
            'default'	=> array(
                'url'	=> get_template_directory_uri() . '/images/call-image.png'
            ),
        ),
        array(
            'id'       => 'hd3_call_us_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Text', 'houzez' ),
            'required' => array('hd3_callus', '=', '1'),
            'default'    => 'Call Us:',
            'subtitle' => '',
        ),
        array(
            'id'       => 'hd3_phone',
            'type'     => 'text',
            'required' => array('hd3_callus', '=', '1'),
            'title'    => esc_html__( 'Phone Number', 'houzez' ),
            'default'    => '1-800-987-6543',
            'subtitle' => '',
        ),
        array(
            'id'     => 'hd3_callus_section_end',
            'type'   => 'section',
            'indent' => false, // Indent all options below until the next 'section' option is set.
        ),

        /*
         *  Header 2 Contact Info
         * -----------------------------------------------------------------------*/
        array(
            'id'       => 'hd2_contact-start',
            'type'     => 'section',
            'required' => array('header_style', '=', '2'),
            'title'    => esc_html__( 'Contact Info', 'houzez' ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'       => 'hd2_contact_info',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable Contact Info', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'hd2_contact_icon',
            'type'     => 'text',
            'required' => array('hd2_contact_info', '=', '1'),
            'title'    => esc_html__( 'Contact Info Icon', 'houzez' ),
            'subtitle' => esc_html__('Font Awesome Icon', 'houzez'),
            'default'	=> '<i class="fa fa-phone"></i>',
        ),
        array(
            'id'       => 'hd2_contact_phone',
            'type'     => 'text',
            'required' => array('hd2_contact_info', '=', '1'),
            'title'    => esc_html__( 'Phone Number', 'houzez' ),
            'subtitle' => '',
            'default'	=> '1 800 987 6543',
        ),
        array(
            'id'       => 'hd2_contact_email',
            'type'     => 'text',
            'required' => array('hd2_contact_info', '=', '1'),
            'title'    => esc_html__( 'Email Address', 'houzez' ),
            'subtitle' => '',
            'default'	=> 'info@houzez.com',
        ),
        array(
            'id'     => 'hd2_contact_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        /*
         *  Header 2 Address
         * -----------------------------------------------------------------------*/
        array(
            'id'       => 'hd2_address-start',
            'type'     => 'section',
            'required' => array('header_style', '=', '2'),
            'title'    => esc_html__( 'Address', 'houzez' ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'       => 'hd2_address_info',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable Address', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'hd2_address_icon',
            'type'     => 'text',
            'required' => array('hd2_address_info', '=', '1'),
            'title'    => esc_html__( 'Address Icon', 'houzez' ),
            'subtitle' => esc_html__('Font Awesome Icon', 'houzez'),
            'default'	=> '<i class="fa fa-map-marker"></i>',
        ),
        array(
            'id'       => 'hd2_address_line1',
            'type'     => 'text',
            'required' => array('hd2_address_info', '=', '1'),
            'title'    => esc_html__( 'Line 1', 'houzez' ),
            'subtitle' => '',
            'default'	=> 'Oceanview Hall',
        ),
        array(
            'id'       => 'hd2_address_line2',
            'type'     => 'text',
            'required' => array('hd2_address_info', '=', '1'),
            'title'    => esc_html__( 'Line 2', 'houzez' ),
            'subtitle' => '',
            'default'	=> 'Miami, FL 33141',
        ),
        array(
            'id'     => 'hd2_address_section_end',
            'type'   => 'section',
            'indent' => false,
        ),


        /*
         *  Header 2 Timing
         * -----------------------------------------------------------------------*/
        array(
            'id'       => 'hd2_timing-start',
            'type'     => 'section',
            'required' => array('header_style', '=', '2'),
            'title'    => esc_html__( 'Office Timing', 'houzez' ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'       => 'hd2_timing_info',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable Office Timing', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'hd2_timing_icon',
            'type'     => 'text',
            'required' => array('hd2_timing_info', '=', '1'),
            'title'    => esc_html__( 'Icon', 'houzez' ),
            'subtitle' => esc_html__('Font Awesome Icon', 'houzez'),
            'default'	=> '<i class="fa fa-clock-o"></i>',
        ),
        array(
            'id'       => 'hd2_timing_hours',
            'type'     => 'text',
            'required' => array('hd2_timing_info', '=', '1'),
            'title'    => esc_html__( 'Opening Hours', 'houzez' ),
            'subtitle' => '',
            'default'	=> '9 am to 6 pm',
        ),
        array(
            'id'       => 'hd2_timing_days',
            'type'     => 'text',
            'required' => array('hd2_timing_info', '=', '1'),
            'title'    => esc_html__( 'Opening Days', 'houzez' ),
            'subtitle' => '',
            'default'	=> 'Monday to Friday',
        ),
        array(
            'id'     => 'hd2_timing_section_end',
            'type'   => 'section',
            'indent' => false,
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Advanced Search', 'houzez' ),
    'id'               => 'header-search',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'main-search-enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable Search', 'houzez' ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'search_style',
            'type'     => 'select',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Search Style', 'houzez' ),
            'subtitle' => '',
            'options'   => array(
                'style_1' => esc_html__( 'Style One', 'houzez' ),
                'style_2'  => esc_html__( 'Style Two', 'houzez' )
            ),
            'desc'     => esc_html__('Select search style', 'houzez'),
            'default'  => 'style_1'
        ),
        array(
            'id'       => 'search_width',
            'type'     => 'select',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Search Width', 'houzez' ),
            'subtitle' => '',
            'options'   => array(
                'container' => esc_html__( 'Boxed', 'houzez' ),
                'container-fluid'  => esc_html__( 'Full Width', 'houzez' )
            ),
            'desc'     => esc_html__('Select search width', 'houzez'),
            'default'  => 'container'
        ),
        array(
            'id'       => 'search_position',
            'type'     => 'select',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Search Position', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'under_nav'	=> esc_html__( 'Under Navigation', 'houzez' ),
                'under_banner'	=> esc_html__( 'Under banner ( Slider, Map etc )', 'houzez' )
            ),
            'desc'     => esc_html__('Select search position', 'houzez'),
            'default'  => 'under_nav'
        ),
        array(
            'id'       => 'search_pages',
            'type'     => 'select',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Search Pages', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'only_home'	=> esc_html__( 'Only Homepage', 'houzez' ),
                'all_pages'	=> esc_html__( 'Homepage + Inner Pages', 'houzez' ),
                'only_innerpages' => esc_html__( 'Only Inner Pages', 'houzez' )
            ),
            'desc'     => esc_html__('Select on which pages you want to show search', 'houzez'),
            'default'  => 'all_pages'
        ),
        array(
            'id'       => 'main-search-sticky',
            'type'     => 'switch',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Sticky Advanced Search', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable advnaced search sticky', 'houzez' ),
            'desc'     => esc_html__('Note: will only work when main menu sticky disabled', 'houzez'),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'mobile-search-sticky',
            'type'     => 'switch',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Sticky Mobile', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable advnaced search sticky on mobiles', 'houzez' ),
            'desc'     => esc_html__('Note: will only work when mobile menu sticky disabled', 'houzez'),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social', 'houzez' ),
    'id'               => 'header-social',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'social-header',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable header social media', 'houzez' ),
            'desc'     => esc_html__('Only for header style two, three and top bar', 'houzez'),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'hs-facebook',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Facebook', 'houzez' ),
            'subtitle' => esc_html__( 'Enter facebook profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'hs-twitter',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Twitter', 'houzez' ),
            'subtitle' => esc_html__( 'Enter twitter profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'hs-googleplus',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Google Plus', 'houzez' ),
            'subtitle' => esc_html__( 'Enter google plus profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'hs-linkedin',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Linked In', 'houzez' ),
            'subtitle' => esc_html__( 'Enter linked in profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'hs-instagram',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Instagram', 'houzez' ),
            'subtitle' => esc_html__( 'Enter Instagram profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Create Listing Button', 'houzez' ),
    'id'               => 'header-create-listings',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'create_listing_button',
            'type'     => 'select',
            'title'    => esc_html__( 'Create Listing', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Header create listing button required login or not', 'houzez'),
            'default'  => 'no',
            'options'  => array(
                'no' => esc_html__('No', 'houzez'),
                'yes' => esc_html__('Yes', 'houzez'),
            )
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Top Bar', 'houzez' ),
    'id'               => 'header-top-bar',
    'subsection'       => false,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'top_bar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable header top bar', 'houzez' ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'top_bar_width',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'container'	=> esc_html__( 'Boxed', 'houzez' ),
                'container-fluid'	=> esc_html__( 'Full Width', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'container'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'top_bar_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide Top Bar in Mobile ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'top_bar_left',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Bar Left Area', 'houzez' ),
            'subtitle' => esc_html__( 'What would you like to show on top bar left area.', 'houzez' ),
            'options'   => array(
                'none'   => esc_html__( 'Nothing', 'houzez' ),
                'menu_bar'    => esc_html__( 'Menu ( Create and assing menu under Appearance -> Menus )', 'houzez' ),
                'social_icons'    => esc_html__( 'Social Icons', 'houzez' ),
                'contact_info'    => esc_html__( 'Contact Info', 'houzez' ),
                'contact_info_and_social_icons'    => esc_html__( 'Contact Info + Social Icons', 'houzez' ),
                'slogan'    => esc_html__( 'Slogan', 'houzez' ),
                'houzez_switchers'    => esc_html__( 'Currency Switcher + Area Switcher', 'houzez' )
            ),
            'default'  => 'none'
        ),
        array(
            'id'       => 'top_bar_right',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Bar Right Area', 'houzez' ),
            'subtitle' => esc_html__( 'What would you like to show on top bar right area.', 'houzez' ),
            'options'   => array(
                'none'   => esc_html__( 'Nothing', 'houzez' ),
                'menu_bar'    => esc_html__( 'Menu ( Create and assing menu under Appearance -> Menus )', 'houzez' ),
                'social_icons'    => esc_html__( 'Social Icons', 'houzez' ),
                'contact_info'    => esc_html__( 'Contact Info', 'houzez' ),
                'contact_info_and_social_icons'    => esc_html__( 'Contact Info + Social Icons', 'houzez' ),
                'slogan'    => esc_html__( 'Slogan', 'houzez' ),
                'houzez_switchers'    => esc_html__( 'Currency Switcher + Area Switcher', 'houzez' )
            ),
            'default'  => 'none'
        ),
        array(
            'id'		=> 'top_bar_phone',
            'type'		=> 'text',
            'default'	=> '',
            'title'		=> esc_html__( 'Phone Number', 'houzez' ),
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'top_bar_email',
            'type'		=> 'text',
            'default'	=> '',
            'title'		=> esc_html__( 'Email Address', 'houzez' ),
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'top_bar_slogan',
            'type'		=> 'textarea',
            'default'	=> '',
            'title'		=> esc_html__( 'Slogan', 'houzez' ),
            'subtitle'	=> esc_html__( 'Enter website slogan', 'houzez' )
        )
    )
) );

// Currency Switcher
if ( class_exists( 'WP_Currencies' ) ) {    // if wp-currencies plugins is active

    // get all currency codes
    $currencies = get_currencies();
    $currency_codes = array();
    if ( 0 < count( $currencies ) ) {
        foreach( $currencies as $currency_code => $currency ) {
            $currency_codes[$currency_code] = $currency_code;
        }
    }

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Currency Switcher', 'houzez'),
        'id' => 'currency-switcher',
        'desc' => '',
        'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'currency_switcher_enable',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable/Disable currency switcher in top bar', 'houzez' ),
                'subtitle' => '',
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'houzez' ),
                'off'      => esc_html__( 'Disabled', 'houzez' ),
            ),
            array(
                'id' => 'currency_switcher_info',
                'type' => 'info',
                'title' => esc_html__('About Currencies', 'houzez'),
                'style' => 'info',
                'desc' => __('You can find the full list of available currencies at <a target="_blank" href="https://openexchangerates.org/currencies">https://openexchangerates.org/currencies</a><br/>wp-currencies plugin is required - https://wordpress.org/plugins/wp-currencies/', 'houzez')
            ),
            array(
                'id' => 'houzez_base_currency',
                'type' => 'select',
                'title' => esc_html__('Base Currency', 'houzez'),
                'subtitle' => esc_html__('Selected currency will be used as base currency for all conversions.', 'houzez'),
                'read-only' => false,
                'options' => $currency_codes,
                'default' => 'USD'
            ),
            array(
                'id' => 'houzez_supported_currencies',
                'type' => 'textarea',
                'title' => esc_html__('Currencies you want to support.', 'houzez'),
                'subtitle' => esc_html__('Only provide comma separated list of currency codes in capital letters. Do not add dashes, spaces or currency signs.', 'houzez'),
                'default' => 'AUD,CAD,CHF,EUR,GBP,HKD,JPY,NOK,SEK,USD,NGN'
            ),
            array(
                'id' => 'houzez_currency_expiry',
                'title' => esc_html__('Expiry time for switched currency','houzez'),
                'subtitle' => esc_html__('Select the expiry period for switched currency.','houzez'),
                'default' => '3600',
                'type' => "radio",
                'options' => array(
                    '3600' => esc_html__('One Hour','houzez'),
                    '86400' => esc_html__('One Day','houzez'),
                    '604800' => esc_html__('One Week','houzez'),
                    '18144000' => esc_html__('One Month','houzez'),
                )
            )
        ),
    ));
}

Redux::setSection($opt_name, array(
    'title' => esc_html__('Area Switcher', 'houzez'),
    'id' => 'area-switcher',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'area_switcher_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable area switcher in top bar', 'houzez' ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),

        array(
            'id' => 'houzez_base_area',
            'type' => 'select',
            'title' => esc_html__('Base Area', 'houzez'),
            'subtitle' => esc_html__('Selected area will be used as base area for all conversions.', 'houzez'),
            'read-only' => false,
            'options' => array(
                'sqft' => esc_html( 'Square Feet', 'houzez' ),
                'sq_meter' => esc_html( 'Square Meters', 'houzez' )
            ),
            'default' => 'sqft'
        )
    ),
));

if( class_exists('Houzez_login_register') ):
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Login & Register', 'houzez' ),
    'id'               => 'header-login-register',
    'subsection'       => false,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'header_login',
            'type'     => 'select',
            'title'    => esc_html__( 'Login & Register', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'yes'	=> esc_html__( 'Yes', 'houzez' ),
                'no'	=> esc_html__( 'No', 'houzez' )
            ),
            'desc'     => esc_html__('Enable/Disable login register in header menu', 'houzez'),
            'default'  => 'no'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'user_show_roles',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable user roles on regsiter form', 'houzez' ),
            'subtitle' => esc_html__( 'Roles on regsiter form', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
            'desc'     => ''
        ),
        array(
            'id'       => 'user_show_roles_profile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable user roles on profile page', 'houzez' ),
            'subtitle' => esc_html__( 'Roles on user profile page which will account user to change his role', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
            'desc'     => ''
        ),
        array(
            'id'       => 'enable_password',
            'type'     => 'select',
            'title'    => esc_html__( 'Users can type the password on registration form', 'houzez' ),
            'subtitle' => esc_html__('If no, users will get the auto generated password via email', 'houzez'),
            'options'	=> array(
                'yes'	=> esc_html__( 'Yes', 'houzez' ),
                'no'	=> esc_html__( 'No', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'no'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'login_redirect',
            'type'     => 'select',
            'title'    => esc_html__( 'After Login Redirect Page', 'houzez' ),
            'subtitle' => '',
            'options'   => array(
                'same_page'   => esc_html__( 'Current Page', 'houzez' ),
                'diff_page'    => esc_html__( 'Different Page', 'houzez' )
            ),
            'default'  => 'same_page'
        ),
        array(
            'id'       => 'login_redirect_link',
            'type'     => 'text',
            'required' => array('login_redirect', '=', 'diff_page' ),
            'title'    => esc_html__( 'Enter Redirect Page Link', 'houzez' ),
            'subtitle' => esc_html__( 'This must be a URL.', 'houzez' ),
            'desc'     => '',
            'validate' => 'url',
            'default'  => '',
        ),
        array(
            'id'       => 'user_as_agent',
            'type'     => 'select',
            'title'    => esc_html__( 'Enable frontend regsiter user as agent', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'yes'	=> esc_html__( 'Yes', 'houzez' ),
                'no'	=> esc_html__( 'No', 'houzez' )
            ),
            'desc'     => esc_html__( 'Register front-end user as agent', 'houzez' ),
            'default'  => 'yes'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'login_terms_condition',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Terms & Conditions', 'houzez' ),
            'subtitle' => esc_html__( 'Select terms & conditions page', 'houzez' ),
            'desc'     => '',
        ),
        array(
            'id'       => 'facebook_login',
            'type'     => 'select',
            'title'    => esc_html__( 'Allow login via Facebook ?', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'yes'	=> esc_html__( 'Yes', 'houzez' ),
                'no'	=> esc_html__( 'No', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'no'
        ),
        array(
            'id'       => 'facebook_api_key',
            'type'     => 'text',
            'required' => array( 'facebook_login', '=', 'yes' ),
            'title'    => esc_html__( 'Facebook Api key', 'houzez' ),
            'subtitle' => esc_html__( 'Facebook Api key for facebook login', 'houzez' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'facebook_secret',
            'type'     => 'text',
            'required' => array( 'facebook_login', '=', 'yes' ),
            'title'    => esc_html__( 'Facebook Secret Code', 'houzez' ),
            'subtitle' => esc_html__( 'Facebook secret code for facebook login', 'houzez' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'yahoo_login',
            'type'     => 'select',
            'title'    => esc_html__( 'Allow login via Yahoo ?', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'yes'	=> esc_html__( 'Yes', 'houzez' ),
                'no'	=> esc_html__( 'No', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'no'
        ),
        array(
            'id'       => 'google_login',
            'type'     => 'select',
            'title'    => esc_html__( 'Allow login via Google ?', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'yes'	=> esc_html__( 'Yes', 'houzez' ),
                'no'	=> esc_html__( 'No', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'no'
        ),
        array(
            'id'       => 'google_api_key',
            'type'     => 'text',
            'required' => array( 'google_login', '=', 'yes' ),
            'title'    => esc_html__( 'Google Api key', 'houzez' ),
            'subtitle' => esc_html__( 'Google Api key for google login', 'houzez' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'google_client_id',
            'type'     => 'text',
            'required' => array( 'google_login', '=', 'yes' ),
            'title'    => esc_html__( 'Google OAuth Client ID', 'houzez' ),
            'subtitle' => esc_html__( 'Google oAuth client id for google login', 'houzez' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'google_secret',
            'type'     => 'text',
            'required' => array( 'google_login', '=', 'yes' ),
            'title'    => esc_html__( 'Google Client Secret', 'houzez' ),
            'subtitle' => esc_html__( 'Google client secret code for google login', 'houzez' ),
            'desc'     => '',
            'default'  => ''
        ),
    )
) );
endif;


/* **********************************************************************
 * Splash Page Template
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Splash Page', 'houzez' ),
    'id'     => 'splash-page',
    'desc'   => '',
    'icon'   => 'el-icon-screen el-icon-small',
    'fields'		=> array(
        array(
            'id'       => 'splash_layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Splash Page Layout', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'container-fluid' => 'Full Width',
                'container' => 'Boxed'
            ),
            'desc'     => '',
            'default'  => 'container-fluid'
        ),
        array(
            'id'       => 'backgroud_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Background Type', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'image' => 'Background Image',
                'slider' => 'Background Slider',
                'video' => 'Background Video'
            ),
            'desc'     => '',
            'default'  => 'image'
        ),

        array(
            'id'       => 'splash_page_nav',
            'type'     => 'switch',
            'title'    => esc_html__( 'Navigation', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable splash page navigation', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),

        array(
            'id'       => 'splash_menu_align',
            'type'     => 'select',
            'title'    => esc_html__( 'Navigation Align', 'houzez' ),
            'subtitle' => esc_html__( 'Select navigation align', 'houzez' ),
            'options'	=> array(
                'nav-left'	=> esc_html__( 'Left Align', 'houzez' ),
                'nav-right'	=> esc_html__( 'Right Align', 'houzez' )
            ),
            'desc'     => '',
            'default'  => 'nav-left'// 1 = on | 0 = off
        ),

        array(
            'id'       => 'splash_overlay',
            'type'     => 'switch',
            'title'    => esc_html__( 'Overlay', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable splash page overlay', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'		=> 'splash_overlay_img',
            'url'		=> true,
            'required'  => array('splash_overlay', '=', '1'),
            'type'		=> 'media',
            'title'		=> esc_html__( 'Overlay Image ', 'houzez' ),
            'default'	=> array(
                'url'	=> get_template_directory_uri() .'/images/overlays/03.png'
            ),
            'subtitle'	=> '',
            'desc'     => esc_html__('You can find overlay images in images -> overlay directory', 'houzez')
        ),
        array(
            'id'       => 'splash_overlay_opacity',
            'type'     => 'text',
            'required'  => array('splash_overlay', '=', '1'),
            'title'    => esc_html__( 'Opacity', 'houzez' ),
            'subtitle' => esc_html__( 'Overlay Opacity', 'houzez' ),
            'desc'     => '',
            'default'  => '0.5',
        ),

        // Section background image
        array(
            'id'       => 'splash_image_section-start',
            'type'     => 'section',
            'required' => array('backgroud_type', '=', 'image'),
            'title'    => esc_html__( 'Background Image Options', 'houzez' ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'		=> 'splash_image',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__('Upload image', 'houzez'),
            'default'	=> '',
            'desc'      => esc_html__('The recommended image size in 2000 x 1000.', 'houzez'),
            'subtitle'	=> '',
        ),

        array(
            'id'     => 'splash_image_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Section background slider
        array(
            'id'       => 'splash_slider_section-start',
            'type'     => 'section',
            'required' => array('backgroud_type', '=', 'slider'),
            'title'    => esc_html__( 'Background Slider Options', 'houzez' ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'		=> 'splash_slider',
            'url'		=> true,
            'type'		=> 'gallery',
            'title'		=> esc_html__('Add/Edit Images', 'houzez'),
            'default'	=> '',
            'desc'      => esc_html__('The recommended image size in 2000 x 1000.', 'houzez'),
            'subtitle'	=> '',
        ),
        array(
            'id'       => 'splash_slider_delay',
            'type'     => 'text',
            'title'    => esc_html__( 'Delay', 'houzez' ),
            'subtitle' => esc_html__( 'Default delay is 7000', 'houzez' ),
            'desc'     => '',
            'default'  => '7000',
        ),
        array(
            'id'     => 'splash_slider_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Section background video
        array(
            'id'       => 'splash_video_section-start',
            'type'     => 'section',
            'required' => array('backgroud_type', '=', 'video'),
            'title'    => esc_html__( 'Background Video Options', 'houzez' ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'		=> 'splash_bg_mp4',
            'url'		=> true,
            'type'		=> 'media',
            'mode'       => false,
            'title'		=> esc_html__('MP4 File', 'houzez'),
            'default'	=> '',
            'desc'      => '',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'splash_bg_webm',
            'url'		=> true,
            'type'		=> 'media',
            'mode'       => false,
            'title'		=> esc_html__('WEBM File', 'houzez'),
            'default'	=> '',
            'desc'      => '',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'splash_bg_ogv',
            'url'		=> true,
            'type'		=> 'media',
            'mode'       => false,
            'title'		=> esc_html__('OGV File', 'houzez'),
            'default'	=> '',
            'desc'      => '',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'splash_video_image',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__('Upload video image', 'houzez'),
            'default'	=> '',
            'desc'      => '',
            'subtitle'	=> '',
        ),
        array(
            'id'     => 'splash_video_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

    ),
));

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Welcome Title', 'houzez' ),
    'id'               => 'splash-welcome',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'splash_welcome_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Splash Page Title', 'houzez' ),
            'subtitle' => esc_html__( 'Enter title for splash page', 'houzez' ),
            'desc'     => '',
            'default'  => 'Welcome, Make Yourself At Home',
        ),
        array(
            'id'       => 'splash_welcome_sub',
            'type'     => 'text',
            'title'    => esc_html__( 'Splash Page Subtitle', 'houzez' ),
            'subtitle' => esc_html__( 'Enter subtitle for splash page', 'houzez' ),
            'desc'     => '',
            'default'  => '',
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Call Us', 'houzez' ),
    'id'               => 'splash-callus',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'		=> 'splash_callus_icon',
            'type'		=> 'text',
            'title'		=> esc_html__('Font Awesome Icon', 'houzez'),
            'default'	=> '<i class="fa fa-phone-square"></i>',
            'desc'      => '',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'splash_callus_text',
            'type'		=> 'text',
            'title'		=> esc_html__('Text', 'houzez'),
            'default'	=> 'Call Us Free',
            'desc'      => '',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'splash_callus_phone',
            'type'		=> 'text',
            'title'		=> esc_html__('Phone Number', 'houzez'),
            'default'	=> '(800) 897 6543',
            'desc'      => '',
            'subtitle'	=> '',
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social Media', 'houzez' ),
    'id'               => 'splash-social',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'social-splash',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable social media', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'sp-facebook',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Facebook', 'houzez' ),
            'subtitle' => esc_html__( 'Enter facebook profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'sp-twitter',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Twitter', 'houzez' ),
            'subtitle' => esc_html__( 'Enter twitter profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'sp-googleplus',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Google Plus', 'houzez' ),
            'subtitle' => esc_html__( 'Enter google plus profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'sp-linkedin',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Linked In', 'houzez' ),
            'subtitle' => esc_html__( 'Enter linked in profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'sp-instagram',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Instagram', 'houzez' ),
            'subtitle' => esc_html__( 'Enter Instagram profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Logo Link', 'houzez' ),
    'id'               => 'splash-logo-link',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'splash-logolink-type',
            'type'     => 'select',
            'title'    => esc_html__( 'Splash Page Logo Link', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'options' => array(
                'home_page' => 'Home Page',
                'custom' => 'Custom'
            ),
            'default'  => 'home_page'
        ),

        array(
            'id'       => 'splash-logolink',
            'type'     => 'text',
            'required' => array('splash-logolink-type', '=', 'custom'),
            'title'    => esc_html__( 'Enter Link', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => ''
        )
    )
) );

/* **********************************************************************
 * Price Format
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Price & Currency', 'houzez' ),
    'id'     => 'price-format',
    'desc'   => '',
    'icon'   => 'el-icon-usd el-icon-small',
    'fields'		=> array(
        array(
            'id'		=> 'currency_symbol',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Currency Symbol', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '$',
            'subtitle'	=> esc_html__( 'Provide currency sign. For Example: $.', 'houzez' ),
        ),
        array(
            'id'		=> 'currency_position',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Where to Show the currency?', 'houzez' ),
            'read-only'	=> false,
            'options'	=> array(
                'before'	=> esc_html__( 'Before', 'houzez' ),
                'after'			=> esc_html__( 'After', 'houzez' )
            ),
            'default'	=> 'before',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'decimals',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Number of decimal points?', 'houzez' ),
            'read-only'	=> false,
            'options'	=> array(
                '0'	=> '0',
                '1'	=> '1',
                '2'	=> '2',
                '3'	=> '3',
                '4'	=> '4',
                '5'	=> '5',
                '6'	=> '6',
                '7'	=> '7',
                '8'	=> '8',
                '9'	=> '9',
                '10' => '10',
            ),
            'default'	=> '0',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'decimal_point_separator',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Decimal Point Separator', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '.',
            'subtitle'	=> esc_html__( 'Provide the decimal point separator. For Example: .', 'houzez' ),
        ),
        array(
            'id'		=> 'thousands_separator',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Thousands Separator', 'houzez' ),
            'read-only'	=> false,
            'default'	=> ',',
            'subtitle'	=> esc_html__( 'Provide the thousands separator. For Example: ,', 'houzez' ),
        )
    ),
));

/* **********************************************************************
 * Typography
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Typography', 'houzez' ),
    'id'     => 'houzez-typography',
    'desc'   => '',
    'icon'   => 'el-icon-font el-icon-small',
    'fields'  => array(
        array(
            'id'          => 'typo-body',
            'type'        => 'typography',
            'title'       => esc_html__('Body', 'houzez'),
            'google'      => true,
            'font-family' => true,
            'font-backup' => false,
            'text-align'  => false,
            'text-transform' => true,
            'font-style' => false,
            'units'       =>'px',
            'subtitle'    => esc_html__('Select your custom font options for your main body font.', 'houzez'),
            'default'     => array(
                'color'       => '#000000',
                'font-weight'  => '300',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '16px',
                'line-height' => '24px',
                'text-transform' => 'none'
            ),
        ),

        // Typo header 1
        array(
            'id'          => 'typo-headers',
            'type'        => 'typography',
            'title'       => esc_html__('Headers', 'houzez'),
            'google'      => true,
            'font-family' => true,
            'font-backup' => false,
            'text-align'  => true,
            'text-transform' => true,
            'color' => false,
            'font-style' => false,
            'units'       =>'px',
            'subtitle'    => esc_html__('Select your custom font options for your headers.', 'houzez'),
            'default'     => array(
                'font-family' => 'Roboto',
                'font-weight'  => '500',
                'google'      => true,
                'font-size'   => '14px',
                'line-height' => '18px',
                'text-transform' => 'none',
                'text-align' => 'left'
            ),
        ),

        // Typo mobile menu 1
        array(
            'id'          => 'typo-mobile-menu',
            'type'        => 'typography',
            'title'       => esc_html__('Mobile Menu', 'houzez'),
            'google'      => true,
            'font-family' => true,
            'font-backup' => false,
            'text-align'  => true,
            'text-transform' => true,
            'color' => false,
            'font-style' => false,
            'units'       =>'px',
            'subtitle'    => esc_html__('Select your custom font options for your mobile menu.', 'houzez'),
            'default'     => array(
                'font-family' => 'Roboto',
                'font-weight'  => '500',
                'google'      => true,
                'font-size'   => '14px',
                'line-height' => '18px',
                'text-transform' => 'none',
                'text-align' => 'left'
            ),
        ),

        // Typo Headings 1
        array(
            'id'          => 'typo-headings',
            'type'        => 'typography',
            'title'       => esc_html__('Headings', 'houzez'),
            'google'      => true,
            'font-family' => true,
            'font-backup' => false,
            'text-align'  => true,
            'font-size'   => false,
            'line-height'   => false,
            'text-transform' => true,
            'color' => false,
            'font-style' => false,
            'units'       =>'px',
            'subtitle'    => esc_html__('Select your custom font options for headings ( h1, h2, h3, h3 etc ).', 'houzez'),
            'default'     => array(
                'font-family' => 'Roboto',
                'font-weight'  => '500',
                'google'      => true,
                'text-transform' => 'inherit',
                'text-align' => 'inherit'
            ),
        ),
    ),
));

/* **********************************************************************
 * Styling
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Styling', 'houzez' ),
    'id'               => 'houzez-styling',
    'desc'             => '',
    'customizer_width' => '',
    'icon'             => 'el-icon-brush el-icon-small'
) );

/* Body
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Body', 'houzez' ),
    'id'     => 'styling-body',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'body_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => esc_html__('Choose body background color', 'houzez'),
            'default'  => '#f5f5f5',
            'transparent' => false,
        ),

        array(
            'id'       => 'houzez_primary_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Primary Color', 'houzez' ),
            'subtitle' => esc_html__( 'Pick website primary color.', 'houzez' ),
            'default'  => '#00AEEF',
            'transparent' => false
        ),
        array(
            'id'       => 'houzez_primary_color_hover',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Primary Hover Color', 'houzez' ),
            'subtitle' => esc_html__( 'Pick website primary hover color.', 'houzez' ),
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '.75',
                'rgba'  => ''
            )
        ),

        array(
            'id'       => 'houzez_secondary_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Secondary Color', 'houzez' ),
            'subtitle' => esc_html__( 'Pick website secondary color.', 'houzez' ),
            'default'  => '#FF6E00',
            'transparent' => false
        ),
        array(
            'id'       => 'houzez_secondary_color_hover',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Secondary Hover Color', 'houzez' ),
            'subtitle' => esc_html__( 'Pick website secondary hover color.', 'houzez' ),
            'default'  => array(
                'color' => '#FF6E00',
                'alpha' => '.75',
                'rgba'  => ''
            )
        ),
    )
));


/* Headers
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Headers', 'houzez' ),
    'id'     => 'styling-headers',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'		=> 'styling_headers_type',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Select Header Type', 'houzez' ),
            'read-only'	=> false,
            'options'	=> array(
                'header-1' => 'Header 1',
                'header-2' => 'Header 2',
                'header-3' => 'Header 3',
                'header-4' => 'Header 4'
            ),
            'default'	=> 'header-1',
            'subtitle'	=> '',
        ),

        // Header 1
        array(
            'id'       => 'header_1_bg',
            'type'     => 'color',
            'required' => array('styling_headers_type', '=', 'header-1'),
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => '',
            'default'  =>'#00AEEF',
            'mode'     => 'background',
            'transparent' => false
        ),
        array(
            'id'       => 'header_1_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Links color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-1'),
            'subtitle' => '',
            'default'  => '#FFFFFF',
            'transparent' => false
        ),
        array(
            'id'       => 'header_1_links_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-1'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_1_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover Background color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-1'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '.2',
                'rgba'  => ''
            )
        ),

        // Header 3
        array(
            'id'       => 'header_3_bg',
            'type'     => 'color',
            'required' => array('styling_headers_type', '=', 'header-3'),
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => esc_html__( 'Choose Background Color For Top Area', 'houzez' ),
            'default'  => '#004272',
            'transparent' => true
        ),
        array(
            'id'       => 'header_3_bg_menu',
            'type'     => 'color',
            'required' => array('styling_headers_type', '=', 'header-3'),
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => esc_html__( 'Choose Background Color For Menu Area', 'houzez' ),
            'default'  => '#004272',
            'transparent' => true
        ),
        array(
            'id'       => 'header_3_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Links color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-3'),
            'subtitle' => '',
            'default'  => '#FFFFFF',
            'transparent' => false
        ),
        array(
            'id'       => 'header_3_links_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-3'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_3_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover Background color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-3'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '.2',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_3_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Border', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-3'),
            'subtitle' => esc_html__( 'Pick border for header version 3', 'houzez' ),
            'desc'     => '',
            'bottom' => false,
            'right' => false,
            'left' => false,
            'default'  => array(
                'border-color'  => '#2a353d',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),

        // Header 2
        array(
            'id'       => 'header_2_section-start',
            'type'     => 'section',
            'required' => array( 'styling_headers_type', '=', 'header-2' ),
            'title'    => esc_html__( 'Header Top Area', 'houzez' ),
            'subtitle' => esc_html__( 'Pick style for header top area', 'houzez' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'header_2_top_bg',
            'type'     => 'color',
            'required' => array('styling_headers_type', '=', 'header-2'),
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => esc_html__('Pick header top area background color', 'houzez'),
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_top_text',
            'type'     => 'color',
            'required' => array('styling_headers_type', '=', 'header-2'),
            'title'    => esc_html__( 'Text Color', 'houzez' ),
            'subtitle' => esc_html__('Pick header top area text color', 'houzez'),
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_top_icon',
            'type'     => 'color',
            'required' => array('styling_headers_type', '=', 'header-2'),
            'title'    => esc_html__( 'Icons Color', 'houzez' ),
            'subtitle' => esc_html__('Pick header top area icons color', 'houzez'),
            'default'  => '#4cc6f4',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_section-end',
            'type'     => 'section',
            'required' => array( 'styling_headers_type', '=', 'header-2' ),
            'indent'   => false,
        ),

        array(
            'id'       => 'header_2_bg',
            'type'     => 'color',
            'required' => array('styling_headers_type', '=', 'header-2'),
            'title'    => esc_html__( 'Menu Background Color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#00AEEF',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Links color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-2'),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_links_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-2'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_2_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover Background color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-2'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '.2',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_2_border',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Border Color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-2'),
            'subtitle' => '',
            'default'  => array(
                'color'  => '#FFFFFF',
                'alpha'  => '.2',
                'rgba'  => ''
            )
        ),

        // Header 4
        array(
            'id'       => 'header_4_bg',
            'type'     => 'color',
            'required' => array('styling_headers_type', '=', 'header-4'),
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false

        ),
        array(
            'id'       => 'header_4_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Links color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'header_4_links_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeef',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_section-start',
            'type'     => 'section',
            'required' => array( 'styling_headers_type', '=', 'header-4' ),
            'title'    => esc_html__( 'Create Listing Button', 'houzez' ),
            'subtitle' => esc_html__( 'Pick create listing button style', 'houzez' ),
            'indent'   => true,
        ),

        array(
            'id'       => 'header_4_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Button Text color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'header_4_btn_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Text Hover color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_btn_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Button Color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => esc_html__('Pick button background color', 'houzez'),
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_4_btn_bg_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Hover Color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => esc_html__('Pick button hover background color', 'houzez'),
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_btn_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Button Border', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => array(
                'border-color'  => '#004274',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'header_4_btn_border_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Border Hover Color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => esc_html__('Pick button hover background color', 'houzez'),
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_section-end',
            'type'     => 'section',
            'required' => array( 'styling_headers_type', '=', 'header-4' ),
            'indent'   => false,
        ),

        /*
         * Submenu
         * --------------------------------------------------------------------- */
        array(
            'id'     => 'info-header-submenu',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => esc_html__( 'Sub Menu Dropdown', 'houzez' ),
            'desc'   => ''
        ),
        array(
            'id'       => 'header_submenu_bg',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '.95',
                'rgba'  => ''
            )

        ),
        array(
            'id'       => 'header_submenu_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Links color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#2e3e49',
            'transparent' => false
        ),
        array(
            'id'       => 'header_submenu_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Links Hover color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#00aeef'
        ),
        array(
            'id'       => 'header_submenu_border_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Border color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#e6e6e6',
            'transparent' => true
        ),

        /*
         * Create Listing Button for header 1, 2, 3
         * --------------------------------------------------------------------- */
        array(
            'id'     => 'info-createlisting',
            'type'   => 'info',
            'notice' => false,
            'required' => array('styling_headers_type', '!=', 'header-4'),
            'style'  => 'info',
            'title'  => esc_html__( 'Create Listing Button', 'houzez' ),
            'desc'   => ''
        ),
        array(
            'id'       => 'header_123_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Button Text color', 'houzez' ),
            'required' => array('styling_headers_type', '!=', 'header-4'),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_123_btn_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Text Hover color', 'houzez' ),
            'required' => array('styling_headers_type', '!=', 'header-4'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_123_btn_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Color', 'houzez' ),
            'required' => array('styling_headers_type', '!=', 'header-4'),
            'subtitle' => esc_html__('Pick button background color', 'houzez'),
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '.2',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_123_btn_bg_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Hover Color', 'houzez' ),
            'required' => array('styling_headers_type', '!=', 'header-4'),
            'subtitle' => esc_html__('Pick button hover background color', 'houzez'),
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '0.1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_123_btn_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Button Border', 'houzez' ),
            'required' => array('styling_headers_type', '!=', 'header-4'),
            'subtitle' => '',
            'default'  => array(
                'border-color'  => '#ffffff',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'header_123_btn_border_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Button Border Hover Color', 'houzez' ),
            'required' => array('styling_headers_type', '!=', 'header-4'),
            'subtitle' => esc_html__('Pick button hover background color', 'houzez'),
            'default'  => '#ffffff'
        ),


         /*
         * Header 4 transparent
         * --------------------------------------------------------------------- */
        array(
            'id'     => 'info-header-4-transparent',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'required' => array( 'styling_headers_type', '=', 'header-4' ),
            'title'  => esc_html__( 'Transparent Header', 'houzez' ),
            'desc'   => ''
        ),

        array(
            'id'       => 'header_4_transparent_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Transparent Links color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_4_transparent_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Transparent Links Hover color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => '#00aeef',
            'transparent' => false
        ),

        array(
            'id'       => 'header_4_transparent_border_bottom1',
            'type'     => 'border',
            'title'    => esc_html__( 'Bottom Border', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'color' => false,
            'default'  => array(
                'border-style'  => 'none',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'header_4_transparent_border_bottom_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Bottom Border Color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '.30',
                'rgba'  => ''
            )
        ),

        array(
            'id'       => 'header_4_transparent_section-start',
            'type'     => 'section',
            'required' => array( 'styling_headers_type', '=', 'header-4' ),
            'title'    => esc_html__( 'Create Listing Button', 'houzez' ),
            'subtitle' => esc_html__( 'Pick create listing button style', 'houzez' ),
            'indent'   => true,
        ),

        array(
            'id'       => 'header_4_transparent_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Button Text color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_4_transparent_btn_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Text Hover color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_transparent_btn_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => esc_html__('Pick button background color', 'houzez'),
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '.2',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_transparent_btn_bg_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Hover Color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => esc_html__('Pick button hover background color', 'houzez'),
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_transparent_btn_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Button Border', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => '',
            'default'  => array(
                'border-color'  => '#ffffff',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'header_4_transparent_btn_border_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Border Hover Color', 'houzez' ),
            'required' => array('styling_headers_type', '=', 'header-4'),
            'subtitle' => esc_html__('Pick button hover background color', 'houzez'),
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_transparent_section-end',
            'type'     => 'section',
            'required' => array( 'styling_headers_type', '=', 'header-4' ),
            'indent'   => false,
        ),
    )
));

/* Top Bar
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Top Bar', 'houzez' ),
    'id'     => 'styling-top-bar',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'top_bar_bg',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#000000',
            'transparent' => true
        ),
        array(
            'id'       => 'top_bar_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'top_bar_color_hover',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Hover Color', 'houzez' ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '.75',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'topbar_menu_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Button Color', 'houzez' ),
            'subtitle' => esc_html__('Pick color for mobile menu button', 'houzez'),
            'default'  => '#FFFFFF'
        ),
    )
));

/* Advance Search
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Advanced Search', 'houzez' ),
    'id'     => 'styling-advanced-search',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'adv_background',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => esc_html__( 'Pick a background color for the advanced search (default: #ffffff).', 'houzez' ),
            'default'  => '#ffffff',
            'validate' => 'color',
        ),
        array(
            'id'       => 'adv_textfields_borders',
            'type'     => 'color',
            'title'    => esc_html__( 'Choose Borders Color for Form Fields', 'houzez' ),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '#cccccc',
        ),
        array(
            'id'       => 'adv_text_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Text Color', 'houzez' ),
            'subtitle' => esc_html__('Pick text color like "other features" etc', 'houzez'),
            'desc'     => '',
            'default'  => '#000000',
        ),
        array(
            'id'       => 'adv_search_btn_bg',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Search Button Background Color', 'houzez' ),
            'subtitle' => '',
            'desc'     => '',
            //'regular'   => false, // Disable Regular Color
            //'hover'     => false, // Disable Hover Color
            //'active'    => false, // Disable Active Color
            //'visited'   => true,  // Enable Visited Color
            'default'  => array(
                'regular' => '#ff6e00',
                'hover'   => '#e96603',
                'active'  => '#e96603',
            )
        ),
        array(
            'id'       => 'adv_search_btn_text',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Search Button Text Color', 'houzez' ),
            'subtitle' => '',
            'desc'     => '',
            'default'  => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
                'active'  => '#ffffff',
            )
        ),
        array(
            'id'       => 'adv_search_border',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Search Button Border Color', 'houzez' ),
            'subtitle' => '',
            'desc'     => '',
            'default'  => array(
                'regular' => '#ff6e00',
                'hover'   => '#e96603',
                'active'  => '#e96603',
            )
        ),
        array(
            'id'       => 'adv_button_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Advanced button color', 'houzez' ),
            'subtitle' => '',
            'desc'     => '',
            'default'  => array(
                'regular' => '#00AEEF',
                'hover'   => '#00AEEF',
                'active'  => '#00AEEF',
            )
        ),

        array(
            'id'       => 'adv_overlay_open_close_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Open/Close Button Background Color', 'houzez' ),
            'subtitle' => esc_html__('Advanced search over headers map, video etc background color', 'houzez'),
            'desc'     => '',
            'default'  => '#ff6e00',
            'transparent' => false
        ),
        array(
            'id'       => 'adv_overlay_open_close_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Open/Close Button Color', 'houzez' ),
            'subtitle' => esc_html__('Advanced search over headers map, video etc text color', 'houzez'),
            'desc'     => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
    )
));

/* Mobile Navigation
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Mobile Menu', 'houzez' ),
    'id'     => 'styling-mobile-menu',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'mob_menu_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Background Color', 'houzez' ),
            'subtitle' => esc_html__('Pick background color for mobile menu', 'houzez'),
            'default'  => '#00AEEF'
        ),
        array(
            'id'       => 'mob_submenu_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '.95',
                'rgba'  => ''
            )

        ),
        array(
            'id'       => 'mob_menu_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Button Color', 'houzez' ),
            'subtitle' => esc_html__('Pick color for mobile menu button', 'houzez'),
            'default'  => '#FFFFFF'
        ),
        array(
            'id'       => 'mob_link_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Links Color', 'houzez' ),
            'subtitle' => esc_html__('Pick mobile menu links color', 'houzez'),
            'default'  => '#004274'
        ),
        array(
            'id'       => 'mob_link_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover Color', 'houzez' ),
            'subtitle' => esc_html__('Pick mobile menu links hover color', 'houzez'),
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'mob_link_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover Background Color', 'houzez' ),
            'subtitle' => esc_html__('Pick mobile menu links hover background color', 'houzez'),
            'default'  => array(
                'color' => '#00aeef',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'mob_dropdown_link_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Dropdown Links Color', 'houzez' ),
            'subtitle' => esc_html__('Pick mobile menu dropdown links color', 'houzez'),
            'default'  => '#ffffff'
        ),
        array(
            'id'       => 'mob_dropdown_links_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Dropdown Links Background Color', 'houzez' ),
            'subtitle' => esc_html__('Pick mobile menu dropdown links background color', 'houzez'),
            'default'  =>'#30C7FF'
        ),
        array(
            'id'       => 'mobile_nav_border',
            'type'     => 'border',
            'all'      => false,
            'title'    => esc_html__( 'Border', 'houzez' ),
            'subtitle' => esc_html__( 'Mobile navigation border', 'houzez' ),
            'desc'     => '',
            'bottom' => false,
            'right' => false,
            'left' => false,
            'default'  => array(
                'border-color'  => '#ffffff',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '0px',
                'border-bottom' => '0px',
                'border-left'   => '0px'
            )
        ),
    )
));

/* Featured Label
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Featured Label', 'houzez' ),
    'id'     => 'styling-featured-label',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'featured_label_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#77c720',
            'transparent' => true
        ),
        array(
            'id'       => 'featured_label_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Color', 'houzez' ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        )
    )
));

/* Property Details
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Property Details', 'houzez' ),
    'id'     => 'styling-property-detail',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'houzez_prop_details_bg',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Property Details Background Color', 'houzez' ),
            'subtitle' => esc_html__( 'Pick property details background color.', 'houzez' ),
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '.1',
                'rgba'  => '',
                'rgba'  => ''
            )
        ),
    )
));

/* Footer
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Footer', 'houzez' ),
    'id'     => 'styling-footer',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'footer_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', 'houzez' ),
            'subtitle' => esc_html__('Pick footer background color', 'houzez'),
            'default'  => '#004274',
            'transparent' => false,
        ),
        array(
            'id'       => 'footer_bottom_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer Bottom Background Color', 'houzez' ),
            'subtitle' => esc_html__('Pick footer bottom background color', 'houzez'),
            'default'  => '#00335A',
            'transparent' => false,
        ),
        array(
            'id'       => 'footer_bottom_border',
            'type'     => 'border',
            'title'    => __('Footer Border', 'houzez'),
            'subtitle' => __('Footer bottom border top', 'houzez'),
            'left'     => false,
            'right'    => false,
            'bottom'   => false,
            'desc'     => '',
            'default'  => array(
                'border-color'  => '#00243f',
                'border-style'  => 'solid',
                'border-top'    => '1px'
            )
        ),
        array(
            'id'       => 'footer_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Color', 'houzez' ),
            'subtitle' => esc_html__('Pick footer color', 'houzez'),
            'default'  => '#FFFFFF'
        ),
        array(
            'id'       => 'footer_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Hover Color', 'houzez' ),
            'subtitle' => esc_html__('Pick footer hover color', 'houzez'),
            'default'  => array(
                'color' => '#00aeef',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),

    )
));

/* **********************************************************************
 * Property
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Property Detail Page', 'houzez' ),
    'id'     => 'property-page',
    'desc'   => '',
    'icon'   => 'el-icon-cog el-icon-small',
    'fields'		=> array(
        array(
            'id'       => 'prop-top-area',
            'type'     => 'select',
            'title'    => esc_html__('Property Top Type', 'houzez'),
            'subtitle' => esc_html__('Property top area.', 'houzez'),
            'desc'     => '',
            'options'  => array(
                'v1'   => esc_html__( 'Version 1', 'houzez' ),
                'v2'   => esc_html__( 'Version 2', 'houzez' ),
                'v3'   => esc_html__( 'Version 3', 'houzez' ),
                'v4'   => esc_html__( 'Version 4', 'houzez' )
            ),
            'default'  => 'v1',
        ),
        array(
            'id'       => 'prop_default_active_tab',
            'type'     => 'select',
            'title'    => esc_html__('Property Top Area Default Active Tab', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'image_gallery'   => esc_html__( 'Image/Gallery', 'houzez' ),
                'map_view'   => esc_html__( 'Map View', 'houzez' ),
                'street_view'   => esc_html__( 'Street View', 'houzez' )
            ),
            'default'  => 'image_gallery',
        ),
        array(
            'id'       => 'prop-content-layout',
            'type'     => 'select',
            'title'    => esc_html__('Property Content Layout', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'simple' => esc_html__( 'Default', 'houzez' ),
                'tabs'   => esc_html__( 'Tabs', 'houzez' ),
                'tabs-vertical' => esc_html__( 'Tabs Vertical', 'houzez' ),
                'v2' => esc_html__( 'Luxury Homes ( Since v1.4.0 )', 'houzez' ),
            ),
            'default'  => 'simple',
        ),
        array(
            'id'       => 'prop-detail-nav',
            'type'     => 'select',
            'title'    => esc_html__('Property Detail Nav', 'houzez'),
            'subtitle' => esc_html__('Property detail page sticky navigation', 'houzez'),
            'desc'     => '',
            'required' => array('prop-content-layout', '=', 'simple'),
            'options'  => array(
                'no' => esc_html__( 'No', 'houzez' ),
                'yes'   => esc_html__( 'Yes', 'houzez' )
            ),
            'default'  => 'no',
        ),
        array(
            'id'       => 'send_agent_message_copy',
            'type'     => 'switch',
            'title'    => esc_html__( 'Do you want to receive the copy of message sent to agent ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'print_property_button',
            'type'     => 'switch',
            'title'    => esc_html__( 'Print Property', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable print property button', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'send_agent_message_email',
            'type'     => 'text',
            'required' => array( 'send_agent_message_copy', '=', '1' ),
            'title'    => esc_html__( 'Email address to receive message copy.', 'houzez' ),
            'desc'     => esc_html__('This email address will receive a copy of message sent to agent from property detail page.', 'houzez'),
            'subtitle' => 'Enter valid email address.'
        ),
        array(
            'id'       => 'agent_contact_in_sidebar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent Contact Form in Sidebar ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'agent_contact_in_sidebar_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent Contact Form in Sidebar for Mobiles ?', 'houzez' ),
            'desc'     => '',
            'required' => array( 'agent_contact_in_sidebar', '=', '1' ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'featured_image_overlay',
            'type'     => 'switch',
            'title'    => esc_html__( 'Dark gradient overlay ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Remove dark gradient overlay over the featured image', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'agent_forms',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent Forms', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable agent contact forms.', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'documents_download',
            'type'     => 'switch',
            'title'    => esc_html__( 'Documents Download', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable documents download only for registers users.', 'houzez' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
    ),
));


/* Sections
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Layout Manager', 'houzez' ),
    'id'     => 'property-section',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'property_blocks',
            'type'    => 'sorter',
            'title'   => 'Property Layout Manager',
            'desc'    => 'Drag and drop layout manager, to quickly organize your property layout contents.',
            'options' => array(
                'enabled'  => array(
                    'unit'         => esc_html__('Multi Unit / Sub Listings', 'houzez'),
                    'description'  => esc_html__('Description', 'houzez'),
                    'address'      => esc_html__('Address', 'houzez'),
                    'details'      => esc_html__('Details', 'houzez'),
                    'features'     => esc_html__('Features', 'houzez'),
                    'floor_plans'  => esc_html__('Floor Plans', 'houzez'),
                    'video'        => esc_html__('Video', 'houzez'),
                    'virtual_tour' => esc_html__('360° Virtual Tour', 'houzez'),
                    'walkscore'    => esc_html__('Walkscore', 'houzez'),
                    'stats'        => esc_html__('Stats', 'houzez'),
                    'agent_bottom' => esc_html__('Agent bottom', 'houzez'),
                ),
                'disabled' => array(
                    'yelp_nearby'  => esc_html__('Near by Places', 'houzez'),
                )
            ),
        )
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Layout Manager Tabs', 'houzez' ),
    'id'     => 'property-section-tabs',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'property_blocks_tabs',
            'type'    => 'sorter',
            'title'   => 'Property Tabs Version Layout Manager',
            'desc'    => 'Drag and drop layout manager, to quickly organize your property layout contents.',
            'options' => array(
                'enabled'  => array(
                    'description'  => esc_html__('Description', 'houzez'),
                    'address'      => esc_html__('Address', 'houzez'),
                    'details'      => esc_html__('Details', 'houzez'),
                    'features'     => esc_html__('Features', 'houzez'),
                    'floor_plans'  => esc_html__('Floor Plans', 'houzez'),
                    'video'        => esc_html__('Video', 'houzez'),
                ),
                'disabled' => array(
                    'virtual_tour' => esc_html__('360° Virtual Tour', 'houzez')
                )
            ),
        )
    )
));


/* Property Stats Graph
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Stats Graph', 'houzez' ),
    'id'     => 'stats_graph',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'houzez_stats_graph',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Graph', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable the display of number of view by day graphic.', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),

        array(
            'id'       => 'houzez_stats_days',
            'type'     => 'text',
            'title'    => esc_html__( 'Number of Days', 'houzez' ),
            'subtitle' => esc_html__( 'How many days data will show ? Default: 14', 'houzez' ),
            'default'  => '14',
        ),

        array(
            'id'       => 'houzez_graph_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Graph Type', 'houzez' ),
            'subtitle' => esc_html__( "Select graph type", 'houzez' ),
            'options'  => array(
                'bar' => esc_html__('Bar Chart', 'houzez'),
                'line' => esc_html__('Line Chart', 'houzez'),
            ),
            'default' => 'bar'
        ),
        array(
            'id'       => 'houzez_graph_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Graph Background Color', 'houzez' ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeef',
                'alpha' => '.2',
                'rgba'  => ''
            )
        ),

        array(
            'id'       => 'houzez_graph_border_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Graph Border Color', 'houzez' ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeef',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
    )
));

/* WalkScore
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Walkscore', 'houzez' ),
    'id'     => 'walkscore',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'houzez_walkscore',
            'type'     => 'switch',
            'title'    => esc_html__( 'Walkscore', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable walkscore on property detail page.', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'houzez_walkscore_api',
            'type'     => 'text',
            'title'    => esc_html__( 'Walkscore APi Key', 'houzez' ),
            'subtitle' => esc_html__( "Walkscore info doesn't show if you don't add the API.", 'houzez' ),
            'required' => array('houzez_walkscore', '=', '1')
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Yelp Nearby Places', 'houzez' ),
    'id'     => 'yelp',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'houzez_yelp',
            'type'     => 'switch',
            'title'    => esc_html__( 'Yelp', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable yelp on property detail page.', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'houzez_yelp_consumer_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Consumer Key', 'houzez' ),
            'subtitle' => esc_html__( "Yelp info doesn't show if you don't add the Consumer Key.", 'houzez' ),
            'required' => array('houzez_yelp', '=', '1')
        ),
        array(
            'id'       => 'houzez_yelp_secret_consumer_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Consumer Secret', 'houzez' ),
            'subtitle' => esc_html__( "Yelp info doesn't show if you don't add the Secret Consumer Key.", 'houzez' ),
            'required' => array('houzez_yelp', '=', '1')
        ),
        array(
            'id'       => 'houzez_yelp_token',
            'type'     => 'text',
            'title'    => esc_html__( 'Token', 'houzez' ),
            'subtitle' => esc_html__( "Yelp info doesn't show if you don't add the Token.", 'houzez' ),
            'required' => array('houzez_yelp', '=', '1')
        ),
        array(
            'id'       => 'houzez_yelp_secret_token',
            'type'     => 'text',
            'title'    => esc_html__( 'Token Secret', 'houzez' ),
            'subtitle' => esc_html__( "Yelp info doesn't show if you don't add the Token Secret.", 'houzez' ),
            'required' => array('houzez_yelp', '=', '1')
        ),
        array(
            'id'       => 'houzez_yelp_term',
            'type'     => 'select',
            'multi'    => true,
            'title'    => esc_html__( 'Select Term', 'houzez' ),
            'subtitle' => esc_html__( "Select yelp terms.", 'houzez' ),
            'options'  => $yelp_categories = array (
                'active' => 'Active Life',
                'arts' => 'Arts & Entertainment',
                'auto' => 'Automotive',
                'beautysvc' => 'Beauty & Spas',
                'education' => 'Education',
                'eventservices' => 'Event Planning & Services',
                'financialservices' => 'Financial Services',
                'food' => 'Food',
                'health' => 'Health & Medical',
                'homeservices' => 'Home Services ',
                'hotelstravel' => 'Hotels & Travel',
                'localflavor' => 'Local Flavor',
                'localservices' => 'Local Services',
                'massmedia' => 'Mass Media',
                'nightlife' => 'Nightlife',
                'pets' => 'Pets',
                'professional' => 'Professional Services',
                'publicservicesgovt' => 'Public Services & Government',
                'realestate' => 'Real Estate',
                'religiousorgs' => 'Religious Organizations',
                'restaurants' => 'Restaurants',
                'shopping' => 'Shoppi'
            ),
            'default' => array('food', 'health', 'education', 'realestate'),
            'required' => array('houzez_yelp', '=', '1')
        ),
        array(
            'id'       => 'houzez_yelp_limit',
            'type'     => 'text',
            'title'    => esc_html__( 'Result Limit', 'houzez' ),
            'subtitle' => esc_html__( "Yelp result limit", 'houzez' ),
            'required' => array('houzez_yelp', '=', '1'),
            'default' => 3
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Show/Hide Data', 'houzez' ),
    'id'     => 'propertydetail-showhide',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'hide_detail_prop_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Property Detail Data', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Choose which data you want to hide on property detail page?', 'houzez'),
            'options'  => array(
                'prop_id' => esc_html__('Property ID', 'houzez'),
                'prop_type' => esc_html__('Type', 'houzez'),
                'prop_status' => esc_html__('Status', 'houzez'),
                'prop_label' => esc_html__('Label', 'houzez'),
                'sale_rent_price' => esc_html__('Sale or Rent Price', 'houzez'),
                'bedrooms' => esc_html__('Bedrooms', 'houzez'),
                'bathrooms' => esc_html__('Bathrooms', 'houzez'),
                'area_size' => esc_html__('Area Size', 'houzez'),
                'land_area' => esc_html__('Land Area', 'houzez'),
                'garages' => esc_html__('Garages', 'houzez'),
                'year_built' => esc_html__('Year Built', 'houzez'),
                'updated_date' => esc_html__('Updated Date', 'houzez'),
                'additional_details' => esc_html__('Additional Details', 'houzez'),
            ),
            'default' => array(
                'prop_id' => '0',
                'prop_type' => '0',
                'prop_status' => '0',
                'prop_label' => '0',
                'sale_rent_price' => '0',
                'bedrooms' => '0',
                'bathrooms' => '0',
                'area_size' => '0',
                'land_area' => '0',
                'garages' => '0',
                'year_built' => '0',
                'updated_date' => '0',
                'additional_details' => '0',
            )
        ),
    )
));

/* Icons
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Icons', 'houzez' ),
    'id'     => 'luxury-homes',
    'desc'   => esc_html__( 'Icons for luxury home type property detail page', 'houzez' ),
    'subsection' => true,
    'fields' => array(
        array(
            'id'		=> 'icon_prop_id',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Property ID', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-1.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for property ID.', 'houzez' ),
        ),
        array(
            'id'		=> 'icon_bedrooms',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Bedrooms', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-2.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for bedrooms.', 'houzez' ),
        ),
        array(
            'id'		=> 'icon_rooms',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Rooms', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-8.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for Rooms.', 'houzez' ),
        ),
        array(
            'id'		=> 'icon_bathrooms',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Bathrooms', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-3.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for bathrooms.', 'houzez' ),
        ),
        array(
            'id'		=> 'icon_prop_size',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Property Size', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-4.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for property size.', 'houzez' ),
        ),
        array(
            'id'		=> 'icon_prop_land',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Land Size', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-4.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for property land size.', 'houzez' ),
        ),
        array(
            'id'		=> 'icon_garage_size',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Garage Size', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-5.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for garage size.', 'houzez' ),
        ),
        array(
            'id'		=> 'icon_garage',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Garage', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-6.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for garage.', 'houzez' ),
        ),
        array(
            'id'		=> 'icon_year',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Year Built', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/icons/icon-7.png' ),
            'subtitle'	=> esc_html__( 'Upload icon for year built.', 'houzez' ),
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Similar Properties', 'houzez' ),
    'id'     => 'property-similar-showhide',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(

        array(
            'id'       => 'houzez_similer_properties',
            'type'     => 'switch',
            'title'    => esc_html__( 'Similar Properties', 'houzez' ),
            'subtitle' => esc_html__( 'Enable/Disable similar properties on property detail page.', 'houzez' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),

        array(
            'id'       => 'houzez_similer_properties_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Similer Type', 'houzez' ),
            'subtitle' => esc_html__( "Select type for similer properties.", 'houzez' ),
            'options'  => array(
                'property_type' => esc_html__('Property Type', 'houzez'),
                'property_feature' => esc_html__('Property Feature', 'houzez'),
                'property_status' => esc_html__('Property Status', 'houzez'),
                'property_city' => esc_html__('Property City', 'houzez'),
                'property_label' => esc_html__('Property Label', 'houzez'),
            ),
            'default' => 'property_type'
        ),

        array(
            'id'       => 'houzez_similer_properties_view',
            'type'     => 'select',
            'title'    => esc_html__( 'Similer View', 'houzez' ),
            'subtitle' => esc_html__( "Select view for similer properties.", 'houzez' ),
            'options'  => array(
                'grid-view' => esc_html__('Grid View', 'houzez'),
                'list-view' => esc_html__('List View', 'houzez'),
            ),
            'default' => 'list-view'
        ),

        array(
            'id'       => 'houzez_similer_properties_count',
            'type'     => 'select',
            'title'    => esc_html__( 'Properties Count', 'houzez' ),
            'subtitle' => esc_html__( "Select count for similer properties.", 'houzez' ),
            'options'  => array(
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8,
                9 => 9,
                10 => 10,
            ),
            'default' => 4
        )
    )
));

/* **********************************************************************
 * Property Print
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Print Property', 'houzez' ),
    'id'     => 'property-print',
    'desc'   => '',
    'icon'   => 'el-icon-print el-icon-small',
    'fields'		=> array(
        array(
            'id'		=> 'print_page_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Print Property Logo', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logo/houzez-logo-print.png' ),
            'subtitle'	=> esc_html__( 'Upload your custom site logo for print property.', 'houzez' ),
        ),
        array(
            'id'       => 'print_agent',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Agent', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'print_description',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Description', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'print_details',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Details', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'print_details_additional',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Additional Details', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'print_features',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Features', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'print_floorplans',
            'type'     => 'switch',
            'title'    => esc_html__( 'Floor Plans', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'print_gallery',
            'type'     => 'switch',
            'title'    => esc_html__( 'Gallery Images', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
    )
));

/* **********************************************************************
 * Property
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Add Property Options', 'houzez' ),
    'id'     => 'add-property-page',
    'desc'   => '',
    'icon'   => 'el-icon-cog el-icon-small',
    'fields'		=> array(
        array(
            'id'      => 'property_form_sections',
            'type'    => 'sorter',
            'title'   => 'Submission Form Layout Manager',
            'desc'    => 'Drag and drop layout manager, to quickly organize your property submission form layout.',
            'options' => array(
                'enabled'  => array(
                    'description-price'         => esc_html__('Description & Price', 'houzez'),
                    'media'  => esc_html__('Property Media', 'houzez'),
                    'details'      => esc_html__('Property Details', 'houzez'),
                    'features'      => esc_html__('Property features', 'houzez'),
                    'location'      => esc_html__('Property location', 'houzez'),
                    'floorplans'  => esc_html__('Floor Plans', 'houzez'),
                    'multi-units'        => esc_html__('Multi Units / Sub Properties', 'houzez'),
                    'agent_info'    => esc_html__('Agent Information', 'houzez'),
                ),
                'disabled' => array(
                )
            ),
        ),
        array(
            'id'       => 'year_built_calender',
            'type'     => 'select',
            'title'    => esc_html__('Show Calender for Year Built Field ?', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'yes'   => esc_html__( 'Yes', 'houzez' ),
                'no'   => esc_html__( 'No', 'houzez' )
            ),
            'default'  => 'yes',
        ),
        array(
            'id'       => 'location_dropdowns',
            'type'     => 'select',
            'title'    => esc_html__('Show dropdowns for Property Location ?', 'houzez'),
            'subtitle' => esc_html__('Show dropdowns for Property Location ( City, Neighborhood, County/state, country ) ?', 'houzez'),
            'desc'     => '',
            'options'  => array(
                'yes'   => esc_html__( 'Yes', 'houzez' ),
                'no'   => esc_html__( 'No', 'houzez' )
            ),
            'default'  => 'no',
        ),
        array(
            'id'       => 'max_prop_images',
            'type'     => 'text',
            'title'    => esc_html__( 'Maximum Images', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Maximum images allow for single property.', 'houzez'),
            'default' => '10'
        ),
        array(
            'id'       => 'image_max_file_size',
            'type'     => 'text',
            'title'    => esc_html__( 'Maximum File Size', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Maximum upload image size. For example 10kb, 500kb, 1mb, 10m, 100mb', 'houzez'),
            'default' => '1000kb'
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Show/Hide Fields', 'houzez' ),
    'id'     => 'property-showhide',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'hide_add_prop_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Submit Form Fields', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Choose which fields you want to hide on add property page?', 'houzez'),
            'options'  => array(
                'prop_id' => esc_html__('Property ID', 'houzez'),
                'prop_type' => esc_html__('Type', 'houzez'),
                'prop_status' => esc_html__('Status', 'houzez'),
                'prop_label' => esc_html__('Label', 'houzez'),
                'sale_rent_price' => esc_html__('Sale or Rent Price', 'houzez'),
                'second_price' => esc_html__('Second Price (Optional)', 'houzez'),
                'price_postfix' => esc_html__('After Price Label (ex: monthly)', 'houzez'),
                'price_prefix' => esc_html__('Price Prefix (ex: Start From)', 'houzez'),
                'bedrooms' => esc_html__('Bedrooms', 'houzez'),
                'bathrooms' => esc_html__('Bathrooms', 'houzez'),
                'area_size' => esc_html__('Area Size', 'houzez'),
                'land_area' => esc_html__('Land Area', 'houzez'),
                'garages' => esc_html__('Garage', 'houzez'),
                'garage_size' => esc_html__('Garage Size', 'houzez'),
                'additional_details' => esc_html__('Additional Details', 'houzez'),
            ),
            'default' => array(
                'prop_id' => '0',
                'prop_type' => '0',
                'prop_status' => '0',
                'prop_label' => '0',
                'sale_rent_price' => '0',
                'second_price' => '0',
                'price_postfix' => '0',
                'price_prefix' => '0',
                'bedrooms' => '0',
                'bathrooms' => '0',
                'area_size' => '0',
                'land_area' => '0',
                'garages' => '0',
                'garage_size' => '0',
                'additional_details' => '0',
            )
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Required Fields', 'houzez' ),
    'id'     => 'property-required-fields',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'required_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Required Fields', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Make add property fields required.', 'houzez'),
            'options'  => array(
                'title' => esc_html__('Title', 'houzez'),
                //'description' => esc_html__('Description', 'houzez'),
                'prop_type' => esc_html__('Type', 'houzez'),
                'prop_status' => esc_html__('Status', 'houzez'),
                'prop_labels' => esc_html__('Label', 'houzez'),
                'sale_rent_price' => esc_html__('Sale or Rent Price', 'houzez'),
                'price_label' => esc_html__('After Price Label', 'houzez'),
                'prop_id' => esc_html__('Property ID', 'houzez'),
                'bedrooms' => esc_html__('Bedrooms', 'houzez'),
                'bathrooms' => esc_html__('Bathrooms', 'houzez'),
                'area_size' => esc_html__('Area Size', 'houzez'),
                'land_area' => esc_html__('Land Area', 'houzez'),
                'garages' => esc_html__('Garages', 'houzez'),
                'year_built' => esc_html__('Year Built', 'houzez'),
                'property_map_address' => esc_html__('Map Address', 'houzez'),
            ),
            'default' => array(
                'title' => '1',
                //'description' => '0',
                'prop_type' => '0',
                'prop_status' => '0',
                'prop_labels' => '0',
                'sale_rent_price' => '1',
                'price_label' => '0',
                'prop_id' => '0',
                'bedrooms' => '0',
                'bathrooms' => '0',
                'area_size' => '1',
                'land_area' => '0',
                'garages' => '0',
                'year_built' => '0',
                'property_map_address' => '1',
            )
        ),
    )
));

/* **********************************************************************
 * Contact Form 7 & Gravity Form Settings
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Contact Form 7', 'houzez' ),
    'id'     => 'contact-form-7',
    'desc'   => '',
    'icon'   => 'el-icon-envelope el-icon-small',
    'fields'		=> array(
        array(
            'id'       => 'enable_contact_form_7_prop_detail',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable contact form 7 for property detail page forms ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),

        array(
            'id'       => 'contact_form_agent_above_image',
            'type'     => 'textarea',
            'required' => array( 'enable_contact_form_7_prop_detail', '=', '1' ),
            'title'    => esc_html__( 'Agent Contact Form', 'houzez' ),
            'desc'     => 'Ex: [contact-form-7 id="1243" title="Contact Me"]',
            'subtitle' => esc_html__( 'Enter contact form 7 shortcode for agent form above image, sidebar and property gallery lightbox.', 'houzez' ),
            'default'  => ''
        ),

        array(
            'id'       => 'contact_form_agent_bottom',
            'type'     => 'textarea',
            'required' => array( 'enable_contact_form_7_prop_detail', '=', '1' ),
            'title'    => esc_html__( 'Agent Contact Form Bottom', 'houzez' ),
            'desc'     => 'Ex: [contact-form-7 id="1243" title="Contact Me"]',
            'subtitle' => esc_html__( 'Enter contact form 7 shortcode for agent form in property detail page bottom.', 'houzez' ),
            'default'  => ''
        ),

        array(
            'id'       => 'enable_contact_form_7_agent_detail',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable contact form 7 for agent detail page ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),

        array(
            'id'       => 'contact_form_agent_detail',
            'type'     => 'textarea',
            'required' => array( 'enable_contact_form_7_agent_detail', '=', '1' ),
            'title'    => esc_html__( 'Agent Detail Form', 'houzez' ),
            'desc'     => 'Ex: [contact-form-7 id="1243" title="Contact Me"]',
            'subtitle' => esc_html__( 'Enter contact form 7 shortcode for agent detail page.', 'houzez' ),
            'default'  => ''
        ),
    ),
));

/* **********************************************************************
 * Property Lightbox
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Property Lightbox', 'houzez' ),
    'id'     => 'property-lightbox',
    'desc'   => '',
    'icon'   => 'el-icon-cog el-icon-small',
    'fields'		=> array(

        array(
            'id'       => 'lightbox_agent_cotnact',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Agent Contact Form ?', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Agent contact form on lightbox', 'houzez'),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),
        array(
            'id'		=> 'lightbox_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Lightbox Logo', 'houzez' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> '' ),
            'subtitle'	=> esc_html__( 'Upload logo for lightbox.', 'houzez' ),
        )
    ),
));

/* **********************************************************************
 * Property
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Payment & Membership', 'houzez' ),
    'id'     => 'payment-membership',
    'desc'   => '',
    'icon'   => 'el-icon-cog el-icon-small',
    'fields'		=> array(
        array(
            'id'       => 'listings_admin_approved',
            'type'     => 'select',
            'title'    => esc_html__('Submited Listings Should be Approved by Admin ?', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'yes'   => esc_html__( 'Yes', 'houzez' ),
                'no'   => esc_html__( 'No', 'houzez' )
            ),
            'default'  => 'yes',
        ),
        array(
            'id'       => 'enable_paid_submission',
            'type'     => 'select',
            'title'    => esc_html__('Enable Paid Submission', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'no'   => esc_html__( 'No', 'houzez' ),
                'per_listing'   => esc_html__( 'Per Listing', 'houzez' ),
                'membership'   => esc_html__( 'Membership', 'houzez' )
            ),
            'default'  => 'no',
        ),

        array(
            'id'       => 'per_listing_expire_unlimited',
            'type'     => 'switch',
            'required' => array('enable_paid_submission', '=', 'per_listing'),
            'title'    => esc_html__( 'Expire Days', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Want to set single listing expire days ?', 'houzez'),
            'default'  => 0,
            'on'       => 'Yes',
            'off'      => 'No',
        ),
        array(
            'id'       => 'per_listing_expire',
            'type'     => 'text',
            'required' => array( 'per_listing_expire_unlimited', '=', '1' ),
            'title'    => esc_html__('Number of Expire Days', 'houzez'),
            'subtitle' => 'No of days until a listings will expire. Starts from the moment the property is published on the website',
            'desc'     => '',
            'default'  => '30',
        ),
        array(
            'id'       => 'currency_paid_submission',
            'type'     => 'select',
            'required' => array( 'enable_paid_submission', '!=', 'no' ),
            'title'    => esc_html__('Currency For Paid Submission', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'USD'  => 'USD',
                'EUR'  => 'EUR',
                'AUD'  => 'AUD',
                'BRL'  => 'BRL',
                'CAD'  => 'CAD',
                'CHF'  => 'CHF',
                'CZK'  => 'CZK',
                'DKK'  => 'DKK',
                'HKD'  => 'HKD',
                'HUF'  => 'HUF',
                'IDR'  => 'IDR',
                'ILS'  => 'ILS',
                'INR'  => 'INR',
                'JPY'  => 'JPY',
                'KOR'  => 'KOR',
                'KSH'  => 'KSH',
                'MYR'  => 'MYR',
                'MXN'  => 'MXN',
                'NGN'  => 'NGN',
                'NOK'  => 'NOK',
                'NZD'  => 'NZD',
                'PHP'  => 'PHP',
                'PLN'  => 'PLN',
                'GBP'  => 'GBP',
                'SGD'  => 'SGD',
                'SEK'  => 'SEK',
                'TWD'  => 'TWD',
                'THB'  => 'THB',
                'TRY'  => 'TRY',
                'ZAR'  => 'ZAR'
            ),
            'default'  => 'USD',
        ),
        array(
            'id'       => 'price_listing_submission',
            'type'     => 'text',
            'required' => array( 'enable_paid_submission', '=', 'per_listing' ),
            'title'    => esc_html__('Price Per Submission', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'price_featured_listing_submission',
            'type'     => 'text',
            'required' => array( 'enable_paid_submission', '=', 'per_listing' ),
            'title'    => esc_html__('Price To Make Listing Featured', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
        ),

        array(
            'id'       => 'paypal_api',
            'type'     => 'select',
            'required' => array( 'enable_paid_submission', '!=', 'no' ),
            'title'    => esc_html__('Paypal & Stripe Api', 'houzez'),
            'subtitle' => esc_html__('Sandbox = test API. LIVE = real payments API', 'houzez'),
            'desc'     => esc_html__('Update PayPal and Stripe settings according to API type selection', 'houzez'),
            'options'  => array(
                'sandbox'=> 'Sandbox',
                'live'   => 'Live',
            ),
            'default'  => 'sandbox',
        ),
        array(
            'id'       => 'payment_terms_condition',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Terms & Conditions', 'houzez' ),
            'subtitle' => esc_html__( 'Select terms & conditions page', 'houzez' ),
            'desc'     => '',
        ),
    ),
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Paypal Settings', 'houzez' ),
    'id'     => 'mem-paypal-settings',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'enable_paypal',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Paypal', 'houzez' ),
            'required' => array( 'enable_paid_submission', '!=', 'no' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'paypal_client_id',
            'type'     => 'text',
            'required' => array( 'enable_paypal', '=', '1' ),
            'title'    => esc_html__('Paypal Client ID', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'paypal_client_secret_key',
            'type'     => 'text',
            'required' => array( 'enable_paypal', '=', '1' ),
            'title'    => esc_html__('Paypal Client Secret Key', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'paypal_api_username',
            'type'     => 'text',
            'required' => array( 'enable_paypal', '=', '1' ),
            'title'    => esc_html__('Paypal API Username', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'paypal_api_password',
            'type'     => 'text',
            'required' => array( 'enable_paypal', '=', '1' ),
            'title'    => esc_html__('Paypal API Password', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'paypal_api_signature',
            'type'     => 'text',
            'required' => array( 'enable_paypal', '=', '1' ),
            'title'    => esc_html__('Paypal API Signature', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'paypal_receiving_email',
            'type'     => 'text',
            'required' => array( 'enable_paypal', '=', '1' ),
            'title'    => esc_html__('Paypal Receiving Email', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Stripe Settings', 'houzez' ),
    'id'     => 'mem-stripe-settings',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'enable_stripe',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Stripe', 'houzez' ),
            'required' => array( 'enable_paid_submission', '!=', 'no' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'stripe_secret_key',
            'type'     => 'text',
            'required' => array( 'enable_stripe', '=', '1' ),
            'title'    => esc_html__('Stripe Secret Key', 'houzez'),
            'subtitle' => esc_html__('Info is taken from your account at https://dashboard.stripe.com/login', 'houzez'),
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'stripe_publishable_key',
            'type'     => 'text',
            'required' => array( 'enable_stripe', '=', '1' ),
            'title'    => esc_html__('Stripe Publishable Key', 'houzez'),
            'subtitle' => esc_html__('Info is taken from your account at https://dashboard.stripe.com/login', 'houzez'),
            'desc'     => '',
            'default'  => '',
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Direct Payment / Wire Payment', 'houzez' ),
    'id'     => 'mem-wire-payment',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'enable_wireTransfer',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Wire Transfer', 'houzez' ),
            'required' => array( 'enable_paid_submission', '!=', 'no' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'houzez' ),
            'off'      => esc_html__( 'Disabled', 'houzez' ),
        ),
        array(
            'id'       => 'direct_payment_instruction',
            'type'     => 'editor',
            'required' => array( 'enable_wireTransfer', '=', '1' ),
            'title'    => esc_html__('Wire instructions for direct payment', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
            'args'   => array(
                'teeny'            => true,
                'textarea_rows'    => 10
            )
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Thank You Page', 'houzez' ),
    'id'     => 'mem-thankyou',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'thankyou_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 'Thank you for your business with us',
        ),
        array(
            'id'       => 'thankyou_des',
            'type'     => 'editor',
            'title'    => esc_html__('Message', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in augue rhoncus, congue neque eu, consequat quam. Maecenas in cursus dui, sed tempor est. Duis varius nibh in lorem venenatis, in tincidunt nunc scelerisque.',
            'args'   => array(
                'teeny'            => true,
                'textarea_rows'    => 10
            )
        ),

        array(
            'id'     => 'direct-pay-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Direct pay / Wire Transfer</span>', 'houzez' ), $allowed_html_array),
            'desc'   => ''
        ),

        array(
            'id'       => 'thankyou_wire_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 'Thank you. Your order has been received',
        ),
        array(
            'id'       => 'thankyou_wire_des',
            'type'     => 'editor',
            'title'    => esc_html__('Message', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => 'Make your payment directly into our bank account. Please use your Order ID as payment reference.',
            'args'   => array(
                'teeny'            => true,
                'textarea_rows'    => 10
            )
        ),
    )
));

/* **********************************************************************
 * Email Management
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Email Management', 'houzez' ),
    'id'     => 'houzez-email-management',
    'desc'   => esc_html__( 'Global variables: %website_url as website url,%website_name as website name, %user_email as user_email, %username as username', 'houzez' ),
    'icon'   => 'el-icon-envelope el-icon-small',
    'fields'		=> array(

        array(
            'id'     => 'email-purchase-activated-package-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Purchase Activated Packages</span>', 'houzez' ), $allowed_html_array),
            'subtitle' => esc_html__('Packages wire transfer and other payments gateways purchase activate', 'houzez'),
            'desc'   => ''
        ),

        array(
            'id'       => 'houzez_subject_purchase_activated_pack',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Purchase Activated', 'houzez'),
            'subtitle' => esc_html__('Email subject for purchase activated', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Your purchase was activated', 'houzez'),
        ),
        array(
            'id'       => 'houzez_purchase_activated_pack',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Purchase Activated', 'houzez'),
            'subtitle' => esc_html__('Email content for Purchase Activated', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__("Hi there,
Welcome to %website_url and thank you for purchasing a plan with us. We are excited you have chosen %website_name . %website_name is a great place to advertise and search properties.

You plan on  %website_url activated! You can now list your properties according to you plan.", 'houzez'),
        ),

        array(
            'id'     => 'email-purchase-activated-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Purchase Activated</span>', 'houzez' ), $allowed_html_array),
            'subtitle' => esc_html__('Per listing wire transfer purchase activate', 'houzez'),
            'desc'   => ''
        ),

        array(
            'id'       => 'houzez_subject_purchase_activated',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Purchase Activated', 'houzez'),
            'subtitle' => esc_html__('Email subject for purchase activated', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Your purchase was activated', 'houzez'),
        ),
        array(
            'id'       => 'houzez_purchase_activated',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Purchase Activated', 'houzez'),
            'subtitle' => esc_html__('Email content for Purchase Activated', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
Your purchase on %website_url is activated! You should go and check it out.', 'houzez'),
        ),

        array(
            'id'     => 'email-approved-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Approved Listing</span>', 'houzez' ), $allowed_html_array),
            'subtitle' => esc_html__('You can use %listing_title as listing title, %listing_url as listing link', 'houzez'),
            'desc'   => ''
        ),

        array(
            'id'       => 'houzez_subject_listing_approved',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Approved Listing', 'houzez'),
            'subtitle' => esc_html__('Email subject for approved listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Your listing approved', 'houzez'),
        ),
        array(
            'id'       => 'houzez_listing_approved',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Listing Approved', 'houzez'),
            'subtitle' => esc_html__('Email content for listing approved', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__("Hi there,
Your listing on %website_url has been approved.

Listins Title:%listing_title
Listing Url: %listing_url", 'houzez'),
        ),

        array(
            'id'     => 'email-expired-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Expired Listing</span>', 'houzez' ), $allowed_html_array),
            'subtitle' => esc_html__('You can use %listing_title as listing title, %listing_url as listing link', 'houzez'),
            'desc'   => ''
        ),

        array(
            'id'       => 'houzez_subject_listing_expired',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Expired Listing', 'houzez'),
            'subtitle' => esc_html__('Email subject for expired listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Your listing expired', 'houzez'),
        ),
        array(
            'id'       => 'houzez_listing_expired',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Listing Expired', 'houzez'),
            'subtitle' => esc_html__('Email content for listing expired', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__("Hi there,
Your listing on %website_url has been expired.

Listins Title:%listing_title
Listing Url: %listing_url", 'houzez'),
        ),

        array(
            'id'     => 'email-new-user-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">New Registered User</span>', 'houzez' ), $allowed_html_array),
            'desc'   => esc_html__( '%user_login_register as username, %user_pass_register as user password, %user_email_register as new user email', 'houzez' )
        ),

        array(
            'id'       => 'houzez_subject_new_user_register',
            'type'     => 'text',
            'title'    => esc_html__('Subject for New User Notification', 'houzez'),
            'subtitle' => esc_html__('Email subject for new user notification', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Your username and password on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_new_user_register',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for New User Notification', 'houzez'),
            'subtitle' => esc_html__('Email content for new user notification', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
Welcome to %website_url! You can login now using the below credentials:
Username:%user_login_register
Password: %user_pass_register
If you have any problems, please contact us.
Thank you!', 'houzez'),
        ),

        array(
            'id'       => 'houzez_subject_admin_new_user_register',
            'type'     => 'text',
            'title'    => esc_html__('Subject for New User Admin Notification', 'houzez'),
            'subtitle' => esc_html__('Email subject for new user admin notification', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('New User Registration', 'houzez'),
        ),
        array(
            'id'       => 'houzez_admin_new_user_register',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for New User Admin Notification', 'houzez'),
            'subtitle' => esc_html__('Email content for new user admin notification', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('New user registration on %website_url.
Username: %user_login_register,
E-mail: %user_email_register', 'houzez'),
        ),

        array(
            'id'     => 'email-wire-transfer-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">New Wire Transfer.</span>', 'houzez' ), $allowed_html_array),
            'desc'   => esc_html__( 'you can use %invoice_no as invoice number, %total_price as total price and %payment_details as payment details', 'houzez' )
        ),
        array(
            'id'       => 'houzez_subject_new_wire_transfer',
            'type'     => 'text',
            'title'    => esc_html__('Subject for New wire Transfer', 'houzez'),
            'subtitle' => esc_html__('Email subject for New wire Transfer', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('You ordered a new Wire Transfer', 'houzez'),
        ),
        array(
            'id'       => 'houzez_new_wire_transfer',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for New wire Transfer', 'houzez'),
            'subtitle' => esc_html__('Email content for New wire Transfer', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('We received your Wire Transfer payment request on  %website_url !
Please follow the instructions below in order to start submitting properties as soon as possible.
The invoice number is: %invoice_no, Amount: %total_price.
Instructions:  %payment_details.', 'houzez'),
        ),

        array(
            'id'       => 'houzez_subject_admin_new_wire_transfer',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Admin - New wire Transfer', 'houzez'),
            'subtitle' => esc_html__('Email subject for New wire Transfer', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Somebody ordered a new Wire Transfer', 'houzez'),
        ),
        array(
            'id'       => 'houzez_admin_new_wire_transfer',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Admin - New wire Transfer', 'houzez'),
            'subtitle' => esc_html__('Email content for New wire Transfer', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('We received your Wire Transfer payment request on  %website_url !
Please follow the instructions below in order to start submitting properties as soon as possible.
The invoice number is: %invoice_no, Amount: %total_price.
Instructions:  %payment_details.', 'houzez'),
        ),

        array(
            'id'     => 'email-paid-perlisting-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Paid Submission Per Listing.</span>', 'houzez' ), $allowed_html_array),
            'subtitle' => esc_html__('you can use %invoice_no as invoice number, %listing_title as listing title and %listing_id as listing id', 'houzez'),
            'desc'   => ''
        ),
        array(
            'id'       => 'houzez_subject_paid_submission_listing',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Paid Submission', 'houzez'),
            'subtitle' => esc_html__('Email subject for paid submission per listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Your new listing on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_paid_submission_listing',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Paid Submission', 'houzez'),
            'subtitle' => esc_html__('Email content for paid submission per listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
You have submitted new listing on  %website_url!
Listing Title: %listing_title
Listing ID:  %listing_id
The invoice number is: %invoice_no', 'houzez'),
        ),

        array(
            'id'       => 'houzez_subject_admin_paid_submission_listing',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Admin - Paid Submission', 'houzez'),
            'subtitle' => esc_html__('Email subject for paid submission per listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('New paid submission on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_admin_paid_submission_listing',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Admin - Paid Submission', 'houzez'),
            'subtitle' => esc_html__('Email content for paid submission per listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
You have a new paid submission on  %website_url!
Listing Title: %listing_title
Listing ID:  %listing_id
The invoice number is: %invoice_no', 'houzez'),
        ),

        array(
            'id'     => 'email-featured-perlisting-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Featured Submission Per Listing.</span>', 'houzez' ), $allowed_html_array),
            'subtitle' => esc_html__('you can use %invoice_no as invoice number, %listing_title as listing title and %listing_id as listing id', 'houzez'),
            'desc'   => ''
        ),
        array(
            'id'       => 'houzez_subject_featured_submission_listing',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Featured Submission', 'houzez'),
            'subtitle' => esc_html__('Email subject for featured submission per listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('New featured upgrade on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_featured_submission_listing',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Featured Submission', 'houzez'),
            'subtitle' => esc_html__('Email content for featured submission per listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
You have a new featured submission on  %website_url!
Listing Title: %listing_title
Listing ID:  %listing_id
The invoice number is: %invoice_no', 'houzez'),
        ),

        array(
            'id'       => 'houzez_subject_admin_featured_submission_listing',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Admin - Featured Submission', 'houzez'),
            'subtitle' => esc_html__('Email subject for featured submission per listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('New featured submission on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_admin_featured_submission_listing',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Admin - Featured Submission', 'houzez'),
            'subtitle' => esc_html__('Email content for featured submission per listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
You have a new featured submission on  %website_url!
Listing Title: %listing_title
Listing ID:  %listing_id
The invoice number is: %invoice_no', 'houzez'),
        ),

        array(
            'id'     => 'email-free-package-perlisting-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Package and Free Submission Listings.</span>', 'houzez' ), $allowed_html_array),
            'subtitle' => esc_html__('you can use %listing_title as listing title and %listing_id as listing id', 'houzez'),
            'desc'   => ''
        ),
        array(
            'id'       => 'houzez_subject_free_submission_listing',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Submission', 'houzez'),
            'subtitle' => esc_html__('Email subject for package and free listing submission', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Your new listing on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_free_submission_listing',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Submission', 'houzez'),
            'subtitle' => esc_html__('Email content for package and free listing submission', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
You have submitted new listing on  %website_url!
Listing Title: %listing_title
Listing ID:  %listing_id', 'houzez'),
        ),

        array(
            'id'       => 'houzez_subject_admin_free_submission_listing',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Admin - Submission', 'houzez'),
            'subtitle' => esc_html__('Email subject for package and free listing submission', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('New submission on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_admin_free_submission_listing',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Admin - Submission', 'houzez'),
            'subtitle' => esc_html__('Email content for package and free listing submission', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
You have a new submission on  %website_url!
Listing Title: %listing_title
Listing ID:  %listing_id', 'houzez'),
        ),

        array(
            'id'     => 'email-free-listing-expired-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Free Listing Expired</span>', 'houzez' ), $allowed_html_array),
            'desc'   => esc_html__('Can use %expired_listing_url as expired listing url and %expired_listing_name as expired listing name', 'houzez')
        ),
        array(
            'id'       => 'houzez_subject_free_listing_expired',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Free Listing Expired', 'houzez'),
            'subtitle' => esc_html__('Email subject for free listing expired', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Free Listing expired on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_free_listing_expired',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Free Listing Expired', 'houzez'),
            'subtitle' => esc_html__('Email content for free listing expired', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
One of your free listings on  %website_url has "expired". The listing is %expired_listing_url.
Thank you!', 'houzez'),
        ),

        array(
            'id'     => 'email-expired-listing-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Expired Listings Resend For Approval.</span>', 'houzez' ), $allowed_html_array),
            'desc'   => esc_html__('%submission_title as property title, %submission_url as property submission url', 'houzez')
        ),
        array(
            'id'       => 'houzez_subject_admin_expired_listings',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Admin - Expired Listing', 'houzez'),
            'subtitle' => esc_html__('Email subject for admin expired listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Expired Listing sent for approval on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_admin_expired_listings',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Admin - Expired Listing', 'houzez'),
            'subtitle' => esc_html__('Email content for admin expired listing', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
A user has re-submited a new property on %website_url! You should go and check it out.
This is the property title: %submission_title.', 'houzez'),
        ),

        array(
            'id'     => 'email-matching-submissions-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Matching Submission.</span>', 'houzez' ), $allowed_html_array),
            'desc'   => esc_html__('Use %matching_submissions as matching submissions list', 'houzez')
        ),
        array(
            'id'       => 'houzez_subject_matching_submissions',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Matching Submissions', 'houzez'),
            'subtitle' => esc_html__('Email subject for matching submissions', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Matching Submissions on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_matching_submissions',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Matching Submissions', 'houzez'),
            'subtitle' => esc_html__('Email content for matching submissions', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
A new submission matching your chosen criteria has been published at %website_url.
These are the new submissions:
%matching_submissions', 'houzez'),
        ),


        array(
            'id'     => 'email-recurring-payment-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Recurring Payment</span>', 'houzez' ), $allowed_html_array),
            'desc'   => esc_html__('Can use %recurring_package_name as recurring packacge name and %merchant as merchant name', 'houzez')
        ),
        array(
            'id'       => 'houzez_subject_recurring_payment',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Recurring Payment', 'houzez'),
            'subtitle' => esc_html__('Email subject for recurring payment', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Recurring Payment on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_recurring_payment',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Recurring Payment', 'houzez'),
            'subtitle' => esc_html__('Email content for recurring payment', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
We charged your account on %merchant for a subscription on %website_url ! You should go and check it out.', 'houzez'),
        ),

        array(
            'id'     => 'email-membership-cancelled-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Membership Cancelled</span>', 'houzez' ), $allowed_html_array),
            'desc'   => ''
        ),
        array(
            'id'       => 'houzez_subject_membership_cancelled',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Membership Cancelled', 'houzez'),
            'subtitle' => esc_html__('Email subject for membership cancelled', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Membership Cancelled on %website_url', 'houzez'),
        ),
        array(
            'id'       => 'houzez_membership_cancelled',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Membership Cancelled', 'houzez'),
            'subtitle' => esc_html__('Email content for membership cancelled', 'houzez'),
            'desc'     => '',
            'default'  => esc_html__('Hi there,
Your subscription on %website_url was cancelled because it expired or the recurring payment from the merchant was not processed. All your listings are no longer visible for our visitors but remain in your account.
Thank you.', 'houzez'),
        ),

    ),
));

/* **********************************************************************
 * Advanced Search
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Advanced Search', 'houzez' ),
    'id'     => 'advanced-search-houzez',
    'desc'   => '',
    'icon'   => 'el-icon-cog el-icon-small',
    'fields'		=> array(
        array(
            'id'       => 'enable_advanced_search_over_headers',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Advanced Search ?.', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Enable/Disable advanced search over header type: map, revolution slider, image, property slider and video.', 'houzez'),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),

        array(
            'id'       => 'adv_search_which_header_show',
            'type'     => 'checkbox',
            'required' => array('enable_advanced_search_over_headers', '=', '1'),
            'title'    => esc_html__( 'Choose Header Type', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Choose on which header type you want to show advanced search', 'houzez'),
            'options'  => array(
                'header_map' => 'Header with google map',
                'header_video' => 'Header Video',
                'header_image' => 'Header Parallax Image',
                'header_rs' => 'Header Revolution Slider',
                'header_ps' => 'Header Properties Slider'
            ),
            'default' => array(
                'header_map' => '1',
                'header_video' => '0',
                'header_image' => '0',
                'header_rs' => '0',
                'header_ps' => '0'
            )
        ),
        array(
            'id'       => 'adv_search_over_header_pages',
            'type'     => 'select',
            'title'    => esc_html__( 'Search Pages', 'houzez' ),
            'subtitle' => '',
            'options'	=> array(
                'only_home'	=> esc_html__( 'Only Homepage', 'houzez' ),
                'all_pages'	=> esc_html__( 'Homepage + Inner Pages', 'houzez' ),
                'only_innerpages' => esc_html__( 'Only Inner Pages', 'houzez' ),
                'specific_pages' => esc_html__( 'Specific Pages', 'houzez' )
            ),
            'desc'     => esc_html__('Select on which pages you want to show search', 'houzez'),
            'default'  => 'only_home'
        ),
        array(
            'id'       => 'adv_search_selected_pages',
            'type'     => 'select',
            'multi'    => true,
            'required' => array('adv_search_over_header_pages', '=', 'specific_pages'),
            'title'    => __('Select Pages', 'houzez'),
            'subtitle' => __('You can select multiple pages', 'houzez'),
            'desc'     => '',
            'data' => 'pages',
        ),
        array(
            'id'       => 'keep_adv_search_live',
            'type'     => 'switch',
            'title'    => esc_html__( 'Keep Advanced Search visible?', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('If no, advanced search over header will display in closed position by default.', 'houzez'),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'features_limit',
            'type'     => 'text',
            'title'    => esc_html__('Features Limit', 'houzez'),
            'subtitle' => esc_html__('Number of features to show in advanced search, add -1 for all.', 'houzez'),
            'desc'     => '',
            'default'  => '-1',
        ),
        array(
            'id'       => 'adv_search_price_slider',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Slider for Price?', 'houzez' ),
            'desc'     => esc_html__('Will effect on all searches', 'houzez'),
            'subtitle' => esc_html__('If no, it will show price dropdowns', 'houzez'),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'enable_disable_save_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Use Save Search Feature.', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Save search option on search result page', 'houzez'),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'houzez' ),
            'off'      => esc_html__( 'No', 'houzez' ),
        ),
        array(
            'id'       => 'save_search_duration',
            'type'     => 'select',
            'title'    => esc_html__('Send Emails', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'required' => array( 'enable_disable_save_search', '=', '1' ),
            'options'  => array(
                'daily'   => esc_html__( 'Daily', 'houzez' ),
                'weekly'   => esc_html__( 'weekly', 'houzez' )
            ),
            'default'  => 'daily',
        ),
        array(
            'id'		=> 'min_price',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Minimum Prices List for Advance Search Form', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000',
            'subtitle'	=> esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'houzez' ),
        ),
        array(
            'id'		=> 'max_price',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Maximum Prices List for Advance Search Form', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000',
            'subtitle'	=> esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'houzez' ),
        ),
        array(
            'id'     => 'rentPrice-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Rent Prices.</span>', 'houzez' ), $allowed_html_array),
            'desc'   => esc_html__( 'Visitors expect smaller values for rent prices, So please provide the list of minimum and maximum rent prices below', 'houzez' )
        ),
        array(
            'id'          => 'search_rent_status',
            'type'        => 'radio',
            'title'       => esc_html__( 'Select the Appropriate Rent Status', 'houzez' ),
            'subtitle'    => esc_html__( 'The rent prices will be displayed based on selected status.', 'houzez' ),
            'desc'        => '',
            'data'        => 'terms',
            'args'        =>  array('taxonomies'=>'property_status', 'args'=>array('hide_empty'=>0)),
        ),

        array(
            'id'		=> 'min_price_rent',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Minimum Prices List for Rent Only', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000',
            'subtitle'	=> esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'houzez' ),
        ),
        array(
            'id'		=> 'max_price_rent',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Maximum Prices List for Rent Only', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000',
            'subtitle'	=> esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'houzez' ),
        ),
        array(
            'id'     => 'advanced-search-widget-priceRang-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => __( '<span class="font24">Advanced Search Price range for price slider.</span>', 'houzez' ),
            'desc'   => ''
        ),
        array(
            'id'		=> 'advanced_search_widget_min_price',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Minimum Price', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '200',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'advanced_search_widget_max_price',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Maximum Price', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '2500000',
            'subtitle'	=> '',
        ),
        array(
            'id'          => 'search_rent_status_for_price_range',
            'type'        => 'radio',
            'title'       => esc_html__( 'Select the Appropriate Rent Status', 'houzez' ),
            'subtitle'    => esc_html__( 'The rent prices will be displayed based on selected status.', 'houzez' ),
            'desc'        => '',
            'data'        => 'terms',
            'args'        =>  array('taxonomies'=>'property_status', 'args'=>array('hide_empty'=>0)),
        ),
        array(
            'id'		=> 'advanced_search_min_price_range_for_rent',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Minimum Price for Rent Only', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '50',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'advanced_search_max_price_range_for_rent',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Maximum Price for Rent Only', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '25000',
            'subtitle'	=> '',
        ),


        array(
            'id'     => 'advanced-search-widget-areaRang-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => __( '<span class="font24">Advanced Search Widget Area Size range.</span>', 'houzez' ),
            'desc'   => ''
        ),
        array(
            'id'		=> 'advanced_search_widget_min_area',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Minimum Area Size', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '10',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'advanced_search_widget_max_area',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Maximum Area Size', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '6000',
            'subtitle'	=> '',
        ),

        array(
            'id'     => 'beds-baths-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Bedrooms & Bathrooms</span>', 'houzez' ), $allowed_html_array),
            'desc'   => ''
        ),
        array(
            'id'		=> 'adv_beds_list',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Bedrooms List', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '1,2,3,4,5,6,7,8,9,10',
            'subtitle'	=> esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', 'houzez' ),
        ),
        array(
            'id'		=> 'adv_baths_list',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Bathrooms List', 'houzez' ),
            'read-only'	=> false,
            'default'	=> '1,2,3,4,5,6,7,8,9,10',
            'subtitle'	=> esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', 'houzez' ),
        )
    ),
));

/*Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Splash & Banner Search Type', 'houzez' ),
    'id'     => 'adv-splash-search-type',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'splash_banner_search_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Select Splash & Banner Search Type', 'houzez' ),
            'desc'     => '',
            'options'  => array(
                'type1' => esc_html__('Version 1 ( Simple )', 'houzez'),
                'type2' => esc_html__('Version 2 ( Advanced )', 'houzez')
            ),
            'default' => 'type1'
        ),
    )
));*/

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Search Fields', 'houzez' ),
    'id'     => 'adv-search-fields',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'keyword_field',
            'type'     => 'select',
            'title'    => __('Keyword Field', 'houzez'),
            'subtitle' => __('What keyword field should search from ?', 'houzez'),
            'options'  => array(
                'prop_title' => esc_html__('Property Title or Content', 'houzez'),
                'prop_address' => esc_html__('Property address, street, zip or property ID', 'houzez'),
                'prop_city_state_county' => esc_html__('Search State, City or Area', 'houzez'),
                /*'prop_geocomplete' => esc_html__('Geo Complete', 'houzez'),*/
            ),
            'default' => 'prop_address'
        ),
        array(
            'id'       => 'enable_radius_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Radius Search.', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Enable/Disable advanced search radius search', 'houzez'),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', 'houzez' ),
            'off'      => esc_html__( 'Disable', 'houzez' ),
        ),
        array(
            'id' => 'houzez_default_radius',
            'type' => 'slider',
            'title' => __('Default Radius', 'houzez'),
            'subtitle' => __('Choose default radius', 'houzez_default_radius'),
            'desc' => '',
            "default" => 50,
            "min" => 0,
            "step" => 1,
            "max" => 100,
            'display_value' => ''
        ),
        array(
            'id'       => 'radius_unit',
            'type'     => 'select',
            'title'    => __('Radius Unit', 'houzez'),
            'description' => '',
            'options'  => array(
                'km' => 'km',
                'mi' => 'mi'
            ),
            'default' => 'km'
        ),
        array(
            'id'       => 'keyword_autocomplete',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Complete', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Enable/Disable auto complete for keyeord field.', 'houzez'),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', 'houzez' ),
            'off'      => esc_html__( 'Disable', 'houzez' ),
        ),

        array(
            'id'       => 'adv_show_hide',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Hide Advanced Search Fields', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__('Show/Hide advanced search fields', 'houzez'),
            'options'  => array(
                'keyword' => esc_html__('Keyword', 'houzez'),
                'countries' => esc_html__('Countries', 'houzez'),
                'states' => esc_html__('States', 'houzez'),
                'cities' => esc_html__('Cities', 'houzez'),
                'areas' => esc_html__('Areas', 'houzez'),
                'status' => esc_html__('Status', 'houzez'),
                'type' => esc_html__('Type', 'houzez'),
                //'property_id' => esc_html__('Property ID', 'houzez'),
                'beds' => esc_html__('Bedrooms', 'houzez'),
                'baths' => esc_html__('Bathrooms', 'houzez'),
                'min_area' => esc_html__('Min Area', 'houzez'),
                'max_area' => esc_html__('Max Area', 'houzez'),
                'min_price' => esc_html__('Min Price', 'houzez'),
                'max_price' => esc_html__('Max Price', 'houzez'),
                'price_slider' => esc_html__('Price Range Slider', 'houzez'),
                'area_slider' => esc_html__('Area Range Slider', 'houzez'),
                'other_features' => esc_html__('Other Features', 'houzez'),
            ),
            'default' => array(
                'keyword' => '0',
                'countries' => '1',
                'states' => '1',
                'cities' => '0',
                'areas' => '0',
                'status' => '0',
                'type' => '0',
                //'property_id' => '1',
                'beds' => '0',
                'baths' => '0',
                'min_area' => '0',
                'max_area' => '0',
                'min_price' => '0',
                'max_price' => '0',
                'price_slider' => '0',
                'area_slider' => '0',
                'other_features' => '0',
            )
        ),
        array(
            'id'       => 'splash_v1_dropdown',
            'type'     => 'select',
            'title'    => esc_html__( 'Splash/Banner Search dropdown', 'houzez' ),
            'subtitle'    => esc_html__( 'What you want to show Splash/Banner Search type 1 first field dropdown data ?', 'houzez' ),
            'desc'     => '',
            'options'  => array(
                'property_city' => esc_html__('Cities', 'houzez'),
                'property_area' => esc_html__('Areas', 'houzez'),
                'property_status' => esc_html__('Status', 'houzez'),
                'property_type' => esc_html__('Type', 'houzez')
            ),
            'default' => 'property_city'
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Search Result Page', 'houzez' ),
    'id'     => 'adv-search-resultpage',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'search_result_page',
            'type'     => 'select',
            'title'    => __('Search Reslt Page', 'houzez'),
            'description' => __('<strong>Normal Page:</strong> Create page using "Advanced Search Result" template.<br/><strong>Half Map:</strong> Create page using "Property Listings Half Map" template.', 'houzez'),
            'options'  => array(
                'normal_page' => 'Normal Page',
                'half_map' => 'Half Map'
            ),
            'default' => 'normal_page'
        ),
        array(
            'id'       => 'search_result_layout',
            'type'     => 'image_select',
            'required' => array( 'search_result_page', '=', 'normal_page' ),
            'title'    => __('Page Layout', 'houzez'),
            'subtitle' => __('Select layout for search result page.', 'houzez'),
            'options'  => array(
                'no-sidebar' => array(
                    'alt'   => '',
                    'img'   => ReduxFramework::$_url.'assets/img/1c.png'
                ),
                'left-sidebar' => array(
                    'alt'   => '',
                    'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                ),
                'right-sidebar' => array(
                    'alt'   => '',
                    'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                )
            ),
            'default' => 'left-sidebar'
        ),
        array(
            'id'       => 'search_result_posts_layout',
            'type'     => 'select',
            'required' => array( 'search_result_page', '=', 'normal_page' ),
            'title'    => __('Properties Layout', 'houzez'),
            'subtitle' => __('Select properties layout for search result page.', 'houzez'),
            'options'  => array(
                'list-view' => 'List View',
                'grid-view' => 'Grid View',
                'grid-view-3-col' => 'Grid View 3 col ( only for full width )'
            ),
            'default' => 'list-view'
        ),

        array(
            'id'       => 'search_default_order',
            'type'     => 'select',
            'required' => array( 'search_result_page', '=', 'normal_page' ),
            'title'    => __('Default Order', 'houzez'),
            'subtitle' => __('Select result page properties default display order.', 'houzez'),
            'options'  => array(
                'd_date' => esc_html__( 'Date New to Old', 'houzez' ),
                'a_date' => esc_html__( 'Date Old to New', 'houzez' ),
                'd_price' => esc_html__( 'Price (High to Low)', 'houzez' ),
                'a_price' => esc_html__( 'Price (Low to High)', 'houzez' ),
            ),
            'default' => 'd_date'
        ),

        array(
            'id'       => 'search_num_posts',
            'type'     => 'text',
            'required' => array( 'search_result_page', '=', 'normal_page' ),
            'title'    => esc_html__('Number of Listings to Show', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '9',
        ),
    )
));

/* **********************************************************************
 * Google Map Settings
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Google Map Settings', 'houzez' ),
    'id'     => 'houzez-googlemap-settings',
    'desc'   => '',
    'icon'   => 'el-icon-globe el-icon-small',
    'fields' => array(
        array(
            'id'       => 'googlemap_ssl',
            'type'     => 'select',
            'title'    => esc_html__( 'Google Maps SSL', 'houzez' ),
            'subtitle' => esc_html__( 'Use google maps with ssl', 'houzez' ),
            'desc'     => '',
            'options'  => array(
                'no'   => esc_html__( 'No', 'houzez' ),
                'yes'   => esc_html__( 'Yes', 'houzez' )
            ),
            'default'  => 'no'
        ),
        array(
            'id'       => 'geo_country_limit',
            'type'     => 'switch',
            'title'    => esc_html__( 'Limit to Country', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Geo autocomplete limit to specific country', 'houzez' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'		=> 'geocomplete_country',
            'type'		=> 'select',
            'required'  => array('geo_country_limit', '=', '1'),
            'title'		=> esc_html__( 'Geo Auto Complete Country', 'houzez' ),
            'subtitle'	=> esc_html__( 'Limit Geo auto complete to specific country', 'houzez' ),
            'options'	=> $Countries,
            'default' => ''
        ),

        array(
            'id'       => 'geo_location',
            'type'     => 'switch',
            'title'    => esc_html__( 'Geo Location', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable geo location.', 'houzez' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id' => 'geo_location_info',
            'type' => 'info',
            'required' => array('geo_location', '=', '1'),
            'title' => '',
            'style' => 'info',
            'desc' => __('Note: Google Geo location not work in chrome without SSL (https://), you can enable IPINFO location below for Google chrome if you don not have SSL. ', 'houzez')
        ),

        array(
            'id'       => 'ipinfo_location',
            'type'     => 'switch',
            'title'    => esc_html__( 'IPINFO Location', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable Ip info location, only work with chrome withour SSL.', 'houzez' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'googlemap_api_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Google Maps API KEY', 'houzez' ),
            'desc'     => wp_kses(__( 'We strongly encourage you to get an APIs Console key and post the code in Theme Options. You can get it from <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">here</a>.', 'houzez' ), $allowed_html_array),
            'subtitle' => esc_html__( 'Enter your google maps api key', 'houzez' ),
            'default'  => ''
        ),
        array(
            'id'       => 'googlemap_zoom_level',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Map Zoom', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( '1 to 20', 'houzez' ),
            'default'  => '12'
        ),
        array(
            'id'       => 'googlemap_pin_cluster',
            'type'     => 'select',
            'title'    => esc_html__( 'Pin Cluster', 'houzez' ),
            'subtitle' => esc_html__( 'Use pin cluster on google map', 'houzez' ),
            'desc'     => '',
            'options'  => array(
                'yes'   => esc_html__( 'Yes', 'houzez' ),
                'no'   => esc_html__( 'No', 'houzez' )
            ),
            'default'  => 'yes'
        ),
        array(
            'id'       => 'googlemap_zoom_cluster',
            'type'     => 'text',
            'title'    => esc_html__( 'Cluster Zoom Level', 'houzez' ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Maximum zoom level for Cluster to appear. Default 10', 'houzez' ),
            'default'  => '10'
        ),
        array(
            'id'       => 'googlemap_stype',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Style for Google Map', 'houzez' ),
            'subtitle' => esc_html__( 'Use https://snazzymaps.com/ to create styles', 'houzez' ),
            'desc'     => '',
            'default'  => '',
            'mode'     => 'plain'
        )
    ),
));

/* **********************************************************************
 * Agents
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Agents', 'houzez' ),
    'id'     => 'houzez-agents',
    'desc'   => '',
    'icon'   => 'el-icon-cog el-icon-small',
    'fields'        => array(

        array(
            'id'       => 'num_of_agents',
            'type'     => 'text',
            'title'    => esc_html__( 'Number of Agents to Display', 'houzez' ),
            'desc'     => '',
            'default'  => '9'
        )
    ),
));

/* **********************************************************************
 * Page 404
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Page 404', 'houzez' ),
    'id'     => 'page-404',
    'desc'   => '',
    'icon'   => 'el-icon-error el-icon-small',
    'fields'        => array(

        array(
            'id'       => '404-title',
            'type'     => 'text',
            'title'    => esc_html__( 'Page Title', 'houzez' ),
            'desc'     => '',
            'default'  => 'Oh oh! Page not found.'
        ),
        array(
            'id'        => '404-des',
            'type'      => 'text',
            'title'     => esc_html__( 'Page Description', 'houzez' ),
            'default'   => "We're sorry, but the page you are looking for doesn't exist.<br>
                You can search your topic using the box below or return to the homepage."
        )
    ),
));

/* **********************************************************************
 * Blog
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Blog', 'houzez' ),
    'id'     => 'blog',
    'desc'   => '',
    'icon'   => 'el-icon-edit el-icon-small',
    'fields'        => array(
        array(
            'id'       => 'masorny_num_posts',
            'type'     => 'text',
            'title'    => esc_html__( 'Number of Posts ( for masonry blog template )', 'houzez' ),
            'desc'     => '',
            'default'  => '12'
        ),
        array(
            'id'       => 'blog_featured_image',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable blog featured image', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

    ),
));

/* **********************************************************************
 * Custom Code
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Custom Code', 'houzez' ),
    'id'         => 'custom_code',
    'icon'       => 'el el-cog el-icon-small',
    'desc'       => '',
    'fields'     => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'CSS Code', 'houzez' ),
            'subtitle' => esc_html__( 'Paste your CSS code here.', 'houzez' ),
            'mode'     => 'css',
            'theme'    => 'monokai',
            'desc'     => '',
            'default'  => ""
        ),
        array(
            'id'       => 'custom_js_header',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Custom JS Code', 'houzez' ),
            'subtitle' => esc_html__( 'Custom JavaScript/Analytics Header.', 'houzez' ),
            'mode'     => 'text',
            'theme'    => 'chrome',
            'desc'     => '',
            'default'  => ""
        ),
        array(
            'id'       => 'custom_js_footer',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Custom JS Code', 'houzez' ),
            'subtitle' => esc_html__( 'Custom JavaScript/Analytics Footer.', 'houzez' ),
            'mode'     => 'text',
            'theme'    => 'chrome',
            'desc'     => '',
            'default'  => ""
        )
    )
) );

/* **********************************************************************
 * Footer
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Footer', 'houzez' ),
    'id'     => 'footer',
    'desc'   => '',
    'icon'   => 'el-icon-bookmark el-icon-small',
    'fields'        => array(
        array(
            'id'       => 'footer_cols',
            'type'     => 'select',
            'title'    => esc_html__('Footer Type', 'houzez'),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'three_cols' => esc_html__( 'Three Columns', 'houzez' ),
                'four_cols' => esc_html__( 'Four Columns', 'houzez' )
            ),
            'default'  => 'three_cols',
        ),
        array(
            'id'       => 'copy_rights',
            'type'     => 'text',
            'title'    => esc_html__( 'Copyright', 'houzez' ),
            'desc'     => '',
            'default'  => 'Houzez - All rights reserved - Designed and Developed by Favethemes'
        ),
        array(
            'id'       => 'social-footer',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable footer social media', 'houzez' ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'fs-facebook',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Facebook', 'houzez' ),
            'subtitle' => esc_html__( 'Enter facebook profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-twitter',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Twitter', 'houzez' ),
            'subtitle' => esc_html__( 'Enter twitter profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-googleplus',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Google Plus', 'houzez' ),
            'subtitle' => esc_html__( 'Enter google plus profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-linkedin',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Linked In', 'houzez' ),
            'subtitle' => esc_html__( 'Enter linked in profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-instagram',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Instagram', 'houzez' ),
            'subtitle' => esc_html__( 'Enter Instagram profile url', 'houzez' ),
            'desc'     => '',
            'default'  => false,
        )

    ),
));
