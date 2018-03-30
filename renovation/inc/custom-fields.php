<?php
function add_custom_meta_boxes() {
    $meta_box = array(
        'id'         => 'progression_page_settings', // Meta box ID
        'title'      => 'Page Settings', // Meta box title
        'pages'      => array('page'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_category_slug',
                'name' => 'Homepage Slider: Insert Slider Shortcode',
                'desc' => '<br>Copy/paste in your slider shortcode. ',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'id' => 'progression_sub_headline',
                'name' => 'Page Title Description',
                'desc' => '<br>Add-in a page title description that displays in the page title area. ',
                'type' => 'textarea',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box );
	
	
	
	
    $meta_box2 = array(
        'id'         => 'progression_post_settings2', // Meta box ID
        'title'      => 'Post Format Settings', // Meta box title
        'pages'      => array('portfolio'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_remove_image',
                'name' => 'Remove Featured Image/Gallery on Post page',
                'desc' => '<br>Type "True" in order to remove the featured image on the portfolio post page. ',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'id' => 'progression_media_embed',
                'name' => 'Audio/Video Embed',
                'desc' => '<br>Paste in your video embed code here',
                'type' => 'textarea',
                'std' => ''
            ),
            array(
                'id' => 'progression_external_link',
                'name' => 'External Link',
                'desc' => '<br>Make your post link to another page than the post page. ',
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box2 );
	
	
    $meta_box4 = array(
        'id'         => 'progression_post_settings', // Meta box ID
        'title'      => 'Post Format Settings', // Meta box title
        'pages'      => array('post'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_media_embed',
                'name' => 'Audio/Video Embed',
                'desc' => '<br>Paste in your video embed code here',
                'type' => 'textarea',
                'std' => ''
            ),
            array(
                'id' => 'progression_external_link',
                'name' => 'External Link',
                'desc' => '<br>Make your post link to another page than the post page. ',
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box4 );
	
    $meta_box3 = array(
        'id'         => 'progression_testimonial_settings', // Meta box ID
        'title'      => 'Testimonial Settings', // Meta box title
        'pages'      => array('testimonial'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_title_testimonial',
                'name' => 'Testimonial Title',
                'desc' => '<br>Add-in a title or sub-heading for each testimonial ',
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box3 );
	
	
    $meta_box4 = array(
        'id'         => 'progression_service_link_setting', // Meta box ID
        'title'      => 'Service Settings', // Meta box title
        'pages'      => array('service'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_service_link',
                'name' => 'Service Link',
                'desc' => '<br>Add-in a link for the service featured image and heading.',
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box4 );
}
add_action( 'dev7_meta_boxes', 'add_custom_meta_boxes' );






?>