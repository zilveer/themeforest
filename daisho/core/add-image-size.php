<?php
/**
 * Adds one more size for images uploaded to Media Library.
 */
add_image_size( 'project-image', 1120, 9999 );

/**
 * Makes custom size selectable from WordPress admin.
 *
 * @param array Currently selectable sizes.
 * @return array Updated selectable sizes.
 */
function flow_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'project-image' => __( 'Project Image', 'flowthemes' ),
    ) );
}
add_filter( 'image_size_names_choose', 'flow_custom_image_sizes' );
