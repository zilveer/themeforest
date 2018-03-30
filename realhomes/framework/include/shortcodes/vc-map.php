<?php
add_action( 'vc_before_init', 'inspiry_shortcodes_integration' );
function inspiry_shortcodes_integration() {


    // locations
    $property_cities_array = array();
    $property_cities = get_terms( 'property-city' );
    if ( ! empty( $property_cities ) && ! is_wp_error( $property_cities ) ){
        foreach ( $property_cities as $property_city ) {
            $property_cities_array[ $property_city->name ] = $property_city->slug;
        }
    }

    // statuses
    $property_statuses_array = array();
    $property_statuses = get_terms( 'property-status' );
    if ( ! empty( $property_statuses ) && ! is_wp_error( $property_statuses ) ){
        foreach ( $property_statuses as $property_status ) {
            $property_statuses_array[ $property_status->name ] = $property_status->slug;
        }
    }

    // types
    $property_types_array = array();
    $property_types = get_terms( 'property-type' );
    if ( ! empty( $property_types ) && ! is_wp_error( $property_types ) ){
        foreach ( $property_types as $property_type ) {
            $property_types_array[ $property_type->name ] = $property_type->slug;
        }
    }

    // features
    $property_features_array = array();
    $property_features = get_terms( 'property-feature' );
    if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ){
        foreach ( $property_features as $property_feature ) {
            $property_features_array[ $property_feature->name ] = $property_feature->slug;
        }
    }

    vc_map( array(
        "name" => __( "Properties", "framework" ),
        "description" => __( "List of Properties", "framework" ),
        "base" => "properties",
        "category" => __( "Theme", "framework" ),
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Layout", "framework" ),
                "param_name" => "layout",
                "value" => array(
                    'Grid' => 'grid',
                    'List' => 'list'
                ),
                'admin_label' => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Number of Properties", "framework" ),
                "param_name" => "count",
                "value" => array(
                    __('All','framework') => -1,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                    '12' => 12,
                    '13' => 13,
                    '14' => 14,
                    '15' => 15,
                    '16' => 16,
                    ),
                'admin_label' => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Order By", "framework" ),
                "param_name" => "orderby",
                "value" => array(
                    __('Date','framework') => 'date',
                    __('Price','framework') => 'price'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Order", "framework" ),
                "param_name" => "order",
                "value" => array(
                    __('Descending','framework') => 'DESC',
                    __('Ascending','framework') => 'ASC'
                ),
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Locations", "framework" ),
                "param_name" => "locations",
                "value" => $property_cities_array,
                'admin_label' => true,
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Statuses", "framework" ),
                "param_name" => "statuses",
                "value" => $property_statuses_array,
                'admin_label' => true,
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Types", "framework" ),
                "param_name" => "types",
                "value" => $property_types_array,
                'admin_label' => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Minimum Bedrooms", "framework" ),
                "param_name" => "min_beds",
                "value" => array(
                    __('Any','framework') => null,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                ),
                'admin_label' => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Maximum Bedrooms", "framework" ),
                "param_name" => "max_beds",
                "value" => array(
                    __('Any','framework') => null,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                    '12' => 12,
                ),
                'admin_label' => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Minimum Bathrooms", "framework" ),
                "param_name" => "min_baths",
                "value" => array(
                    __('Any','framework') => null,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                ),
                'admin_label' => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Maximum Bathrooms", "framework" ),
                "param_name" => "max_baths",
                "value" => array(
                    __('Any','framework') => null,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                    '12' => 12,
                ),
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Minimum Price", "framework" ),
                "description" => __( "Only provide digits", "framework" ),
                "param_name" => "min_price",
                "value" => '',
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Maximum Price", "framework" ),
                "description" => __( "Only provide digits", "framework" ),
                "param_name" => "max_price",
                "value" => '',
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Minimum Area", "framework" ),
                "description" => __( "Only provide digits", "framework" ),
                "param_name" => "min_area",
                "value" => '',
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Maximum Area", "framework" ),
                "description" => __( "Only provide digits", "framework" ),
                "param_name" => "max_area",
                "value" => '',
                'admin_label' => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Display Only Featured Properties", "framework" ),
                "param_name" => "featured",
                "value" => array(
                    __('No','framework') => 'no',
                    __('Yes','framework') => 'yes',
                ),
                'admin_label' => true,
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Features", "framework" ),
                "param_name" => "features",
                "value" => $property_features_array,
                'admin_label' => true,
            ),
        )
    ) );
}
?>