<?php


/***************************************************
:: Theme options
 ***************************************************/

add_filter( 'kleo_theme_settings', 'kleo_page_title_settings' );

function kleo_page_title_settings( $kleo )
{

    $kleo['panels']['kleo_panel_page_title'] = array(
        'title' => esc_html__('Page title', 'buddyapp'),
        'description' => esc_html__('Page title section settings', 'buddyapp'),
        'priority' => 15
    );

    $kleo['sec']['kleo_section_page_title'] = array(
        'title' => esc_html__('General settings', 'buddyapp'),
        'panel' => 'kleo_panel_page_title',
        'priority' => 15
    );
    $kleo['sec']['kleo_section_page_title_styling'] = array(
        'title' => esc_html__('Styling options', 'buddyapp'),
        'panel' => 'kleo_panel_page_title',
        'priority' => 15
    );


    $kleo['set'][] = array(
        'id' => 'page_title_enable',
        'type' => 'switch',
        'title' => esc_html__('Enable Page Title section', 'buddyapp'),
        'default' => '1',
        'section' => 'kleo_section_page_title',
        'description' => esc_html__('Show the page title section on your site', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $kleo['set'][] = array(
        'id' => 'page_title_title',
        'type' => 'switch',
        'title' => esc_html__('Show Page Title', 'buddyapp'),
        'default' => '1',
        'section' => 'kleo_section_page_title',
        'description' => esc_html__('Show the page title on your site', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh',
        'condition' => array('page_title_enable', '1')
    );

    $kleo['set'][] = array(
        'id' => 'page_title_tagline',
        'type' => 'text',
        'title' => esc_html__('Tag line', 'buddyapp'),
        'default' => 'Your small tag line here',
        'section' => 'kleo_section_page_title',
        'customizer' => true,
        'transport' => 'refresh',
        'condition' => array('page_title_enable', '1')

    );


    $kleo['set'][] = array(
        'id' => 'page_title_breadcrumb',
        'type' => 'switch',
        'title' => esc_html__('Show Breadcrumb', 'buddyapp'),
        'default' => '1',
        'section' => 'kleo_section_page_title',
        'description' => esc_html__('Show breadcrumb on your site', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh',
        'condition' => array('page_title_enable', '1')

    );

    foreach ( Kleo::get_config( 'styling_variables' ) as $slug => $name ) {

        $kleo['set'][] = array(
            'id' => 'page_title_style_' . str_replace('-', '_', $slug),
            'type' => 'color',
            'title' => $name,
            'default' => '',
            'section' => 'kleo_section_page_title_styling',
            'customizer' => true,
            'transport' => 'refresh',
            'condition' => array('page_title_enable', '1')

        );

    }


    return $kleo;
}


/***************************************************
:: LESS VARIABLES
 ***************************************************/

add_filter( 'kleo_get_dynamic_variables', 'kleo_page_title_variables' );
function kleo_page_title_variables( $variables ) {

    foreach (Kleo::get_config('styling_variables') as $slug => $name) {
        if (sq_option('page_title_style_' . str_replace('-', '_', $slug))) {
            $variables['page-title-' . $slug] = sq_option('page_title_style_' . str_replace('-', '_', $slug));
        }
    }

    return $variables;
}


/***************************************************
:: EXTRA LOGIC FUNCTIONS
 ***************************************************/

add_filter('body_class', 'sq_add_page_title_class');
function sq_add_page_title_class( $classes = array() ) {
    if ( ! sq_option( 'page_title_enable', true, true ) ) {
        $classes[] = 'pagetitle-disabled';
    }
    return $classes;
}



/**
 * Display the classes for the page title element.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function kleo_page_title_class( $class = '' ) {
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join( ' ', kleo_get_page_title_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the page title element as an array.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function kleo_get_page_title_class( $class = '' ) {

    $classes = array( 'page-title-colors' );

    if ( ! empty( $class ) ) {
        if ( !is_array( $class ) ) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge( $classes, $class );
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = apply_filters( 'kleo_page_title_class', $classes, $class );

    return array_unique( $classes );
}
