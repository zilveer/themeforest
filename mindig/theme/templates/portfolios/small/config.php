<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Configuration of this portfolio layout
 *
 * @var $this \YIT_CPT_Unlimited The object
 */

$this->enqueue_style( 'portfolio-' . $layout, 'css/style.css' );
$this->enqueue_script( 'jquery-filterable', 'js/jquery.filterable.js', array( 'jquery-commonlibraries' ) );
$this->enqueue_script( 'prettyPhoto' );

if ( function_exists( 'YIT_Testimonial' ) ) {
    $testimonials_array = yit_get_testimonial_list_array( array( - 1 => __( 'No testimonial', 'yit' ) ) );
    if ( ! empty( $testimonials_array ) ) {
        $testimonials_list = array(
            'label'   => __( 'Project Testimonial', 'yit' ),
            'type'    => 'chosen',
            'desc'    => __( 'Show testimonial on single page.', 'yit' ),
            'std'     => '',
            'options' => $testimonials_array
        );

        $testimonial_title = array(
            'label' => __( 'Project Testimonial Title', 'yit' ),
            'type'  => 'text',
            'desc'  => __( 'Testimonial title on single page.', 'yit' ),
            'std'   => __( "Customer's Review", 'yit' ),
        );
    }
    else {
        $testimonials_list = false;
        $testimonial_title = false;
    }

}
else {
    $testimonials_list = false;
    $testimonial_title = false;
}

$this->add_layout_fields( array(

    'nitems'                 => array(
        'label' => __( 'Items per page', 'yit' ),
        'type'  => 'text',
        'desc'  => __( 'Select the number of items to show. The option will active a pagination system below the items. Leave 0 to show all.', 'yit' ),
        'std'   => 12
    ),

    'activate_filters'      => array(
        'label' => __( 'Activate Filters', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Select if you want to use filters.', 'yit' ),
        'std'   => 'yes'
    ),

    'enable_thumbnail'      => array(
        'label' => __( 'Show thumbnail', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Select if you want to show project thumbnail.', 'yit' ),
        'std'   => 'yes'
    ),

    'enable_categories'     => array(
        'label' => __( 'Show Categories', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Select if you want to show Categories on project.', 'yit' ),
        'std'   => 'yes'
    ),

    'enable_title'          => array(
        'label' => __( 'Project title', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Show the project name.', 'yit' ),
        'std'   => 'yes'
    ),

    'enable_extra_info' => array(
        'label' => __( 'Project Extra Info', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Show the project extra info area.', 'yit' ),
        'std'   => 'yes'
    ),


    'info_box_location' => array(
        'label'   => __( 'Info box location', 'yit' ),
        'type'    => 'select',
        'options' => array(
            'top'    => __( 'Top: before featured image', 'yit' ),
            'bottom' => __( 'Bottom: after featured image', 'yit' )
        ),
        'desc'    => __( 'Select the location of category box. Select "Top" to show info box before featured image, "Bottom" to show info box after featured image', 'yit' ),
        'std'     => 'bottom'
    ),



) );

$item_fields = array(

    'gallery'      => array(
        'label' => __( 'Gallery', 'yit' ),
        'type'  => 'image-gallery',
        'desc'  => __( 'Choose extra images for the gallery ', 'yit' ),
        'std'   => ''
    ),

    array( 'type' => 'sep' ),

    'customer'          => array(
        'label' => __( 'Customer', 'yit' ),
        'type'  => 'text',
        'desc'  => __( 'Insert the customer (leave empty to not use it)', 'yit' ),
        'std'   => ''
    ),

    'year'              => array(
        'label' => __( 'Year', 'yit' ),
        'type'  => 'text',
        'desc'  => __( 'Insert the year (leave empty to not use it)', 'yit' ),
        'std'   => ''
    ),

    'project'           => array(
        'label' => __( 'Project', 'yit' ),
        'type'  => 'text',
        'desc'  => __( 'Insert the project (leave empty to not use it)', 'yit' ),
        'std'   => ''
    ),

    'website'           => array(
        'label' => __( 'Website', 'yit' ),
        'type'  => 'text',
        'desc'  => __( 'The website name of customer (leave empty to not use it)', 'yit' ),
        'std'   => ''
    ),

    'website-url'       => array(
        'label' => __( 'Website (URL)', 'yit' ),
        'type'  => 'text',
        'desc'  => __( 'The website url of customer (leave empty to not use it)', 'yit' ),
        'std'   => ''
    ),

    'budget'            => array(
        'label' => __( 'Budget', 'yit' ),
        'type'  => 'text',
        'desc'  => __( 'Insert the budget (leave empty to not use it)', 'yit' ),
        'std'   => ''
    ),

    'testimonial-title' => $testimonial_title,

    'show_testimonial'  => $testimonials_list,

    array( 'type' => 'sep' ),

    'share_title'       => array(
        'label' => __( 'Share section title', 'yit' ),
        'type'  => 'text',
        'desc'  => __( 'Insert the title of the share section (leave empty to not use it)', 'yit' ),
        'std'   => __( 'Love it, share it', 'yit' )
    ),

    'share_socials'     => array(
        'label'    => __( 'Share social', 'yit' ),
        'type'     => 'chosen',
        'multiple' => true,
        'options'  => array(
            'facebook'  => __( 'Facebook', 'yit' ),
            'twitter'   => __( 'Twitter', 'yit' ),
            'google'    => __( 'Google+', 'yit' ),
            'pinterest' => __( 'Pinterest', 'yit' )
        ),
        'desc'     => __( 'Select socials to insert in share section (leave empty to not use it)', 'yit' ),
        'std'      => array()
    ),

);

if ( ! $testimonials_list ) {
    unset( $item_fields['show_testimonial'] );
}

$this->add_item_fields( $item_fields );