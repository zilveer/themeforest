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
 * @use $this \YIT_CPT_Unlimited The object
 */

$this->enqueue_style( 'portfolio-' . $layout, 'css/style.css' );
$this->enqueue_script( 'jquery-filterable', 'js/jquery.filterable.js' );

$this->add_layout_fields( array(

	'nitems' => array(
		'label' => __( 'Items per page', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'Select the number of items to show. The option will active a pagination system below the items. Leave 0 to show all.', 'yit' ),
		'std'   => 12
	),

	'items_per_row' => array(
		'label' => __( 'Items per row', 'yit' ),
		'type' => 'select',
		'desc' => __( 'Select the number of items to show per row', 'yit' ),
		'options' => array(
			'3' => __( 'Three', 'yit' ),
			'4' => __( 'Four', 'yit')
		),
		'std' => '3'
	),

	'activate_filters' => array(
		'label' => __( 'Activate Filters', 'yit' ),
		'type' => 'onoff',
		'desc' => __( 'Select if you want to use filters.', 'yit' ),
		'std' => 'yes'
	),

	'enable_quick_view' => array(
		'label' => __( 'Enable Quick View', 'yit' ),
		'type' => 'onoff',
		'desc' => __( 'Set if you want to active quick view for the projects.', 'yit' ),
		'std' => 'no'
	),

	'enable_hover' => array(
		'label' => __( 'Hover effect', 'yit' ),
		'type'  => 'onoff',
		'desc'  => __( 'Enable the hover effect on each portfolio item', 'yit' ),
		'std'   => 'yes'
	),

	'enable_title' => array(
		'label' => __( 'Project title on hover', 'yit' ),
		'type'  => 'onoff',
		'desc'  => __( 'Show the project name on image hover.', 'yit' ),
		'std'   => 'yes'
	),

	'enable_categories' => array(
		'label' => __( 'Project categories on hover', 'yit' ),
		'type'  => 'onoff',
		'desc'  => __( 'Show the project categories on image hover.', 'yit' ),
		'std'   => 'yes'
	),

	'enable_other_project' => array(
		'label' => __( 'Show other project in small layout', 'yit' ),
		'type' => 'onoff',
		'desc' => __( 'Show slider with other projects in small layout', 'yit' ),
		'std' => 'yes'
	),

	'other_projects_title' => array(
		'label' => __( 'Title for other project slider', 'yit' ),
		'type' => 'text',
		'desc' => __( 'Title for the slider with other projects in small layout', 'yit' )
	)

) );

$this->add_item_fields( array(



	'content_title' => array(
		'label' => __( 'Content title', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'Insert the title of the content section (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	array( 'type' => 'sep' ),

	'extra_title' => array(
		'label' => __( 'Extra title', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'Insert the title of the extra information section (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

    array( 'type' => 'sep' ),

    'gallery'      => array(
        'label' => __( 'Gallery', 'yit' ),
        'type'  => 'image-gallery',
        'desc'  => __( 'Choose extra images for the gallery ', 'yit' ),
        'std'   => ''
    ),

    array( 'type' => 'sep' ),


	'customer' => array(
		'label' => __( 'Customer', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'Insert the customer (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	'year' => array(
		'label' => __( 'Year', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'Insert the year (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	'project' => array(
		'label' => __( 'Project', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'Insert the project (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	'website' => array(
		'label' => __( 'Website', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'The website name of customer (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	'website-url' => array(
		'label' => __( 'Website (URL)', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'The website url of customer (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	array( 'type' => 'sep' ),

	'custom_button_label' => array(
		'label' => __( 'Custom button label', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'The label of custom button (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	'custom_button_url' => array(
		'label' => __( 'Custom button url', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'The url of custom button (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	array( 'type' => 'sep' ),

	'share_title' => array(
		'label' => __( 'Share section title', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'Insert the title of the share section (leave empty to not use it)', 'yit' ),
		'std'   => ''
	),

	'share_socials' => array(
		'label' => __( 'Share social', 'yit' ),
		'type'  => 'chosen',
		'multiple' => true,
		'options' => array(
			'facebook' => __( 'Facebook', 'yit' ),
			'twitter' => __( 'Twitter', 'yit' ),
			'google' => __( 'Google+', 'yit' ),
			'pinterest' => __( 'Pinterest', 'yit' )
		),
		'desc'  => __( 'Insert a comma separated list of socials to insert in share section (leave empty to not use it)', 'yit' ),
		'std'   => array()
	),

) );