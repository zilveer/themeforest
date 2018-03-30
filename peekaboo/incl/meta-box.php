<?php

/*-----------------------------------------------------------------------------------*/
/*  Define Metabox Fields
/*-----------------------------------------------------------------------------------*/

function pkb_contact_metaboxes() {

	$prefix = 'pkb_';

	$cmb = new_cmb2_box( array(
		'id'           => 'pkb_contact_meta_box',
		'title'        => __( 'Contact Information', 'peekaboo' ),
		'object_types' => array( 'page' ), // post type
		'show_on'      => array( 'key' => 'page-template', 'value' => 'page-contact.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );

	$cmb->add_field( array(

		'name' => __( 'Map', 'peekaboo' ),
		'desc' => __( 'Google Map URL', 'peekaboo' ),
		'id'   => $prefix . 'map_code',
		'type' => 'text',
		'std'  => ''
	) );
	$cmb->add_field( array(

		'name' => __( 'Contact Info Title', 'peekaboo' ),
		'desc' => __( '', 'peekaboo' ),
		'id'   => $prefix . 'contact_info_title',
		'type' => 'text_medium',
		'std'  => ''
	) );
	$cmb->add_field( array(

		'name' => __( 'Contact Info', 'peekaboo' ),
		'desc' => __( 'Address, Phone Number, etc', 'peekaboo' ),
		'id'   => $prefix . 'contact_info',
		'type' => 'textarea_code',
		'std'  => ''
	) );
	$cmb->add_field( array(

		'name' => __( 'Form Info', 'peekaboo' ),
		'desc' => __( '', 'peekaboo' ),
		'id'   => $prefix . 'cf7_info',
		'type' => 'textarea_code',
		'std'  => ''
	) );
	$cmb->add_field( array(

		'name' => __( 'Form ID', 'peekaboo' ),
		'desc' => __( 'Contact Form 7 ID', 'peekaboo' ),
		'id'   => $prefix . 'cf7_id',
		'type' => 'text_small',
		'std'  => ''
	) );

}

add_action( 'cmb2_admin_init', 'pkb_contact_metaboxes' );


/*-----------------------------------------------------------------------------------*/
/*  Define Slide Metabox Fields
/*-----------------------------------------------------------------------------------*/

function pkb_slide_metaboxes() {

	$prefix = 'pkb_';

	$cmb = new_cmb2_box( array(
		'id'           => 'pkb_slide_meta_box',
		'title'        => __( 'Slides', 'peekaboo' ),
		'object_types' => array( 'slide', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );


	$cmb->add_field( array(
		'name'    => __( 'Slide Type', 'peekaboo' ),
		'desc'    => __( '', 'peekaboo' ),
		'id'      => $prefix . 'slide_type',
		'type'    => 'radio_inline',
		'options' => array(
			'image'         => __( 'Image', 'peekaboo' ),
			'image-caption' => __( 'Image with Caption', 'peekaboo' ),
		),
		'std'     => 'image'

	) );
	$cmb->add_field( array(
		'name' => __( 'Caption Title', 'peekaboo' ),
		'desc' => __( 'Slide caption title', 'peekaboo' ),
		'id'   => $prefix . 'image_caption',
		'type' => 'text',
		'std'  => ''
	) );
	$cmb->add_field( array(
		'name' => __( 'Caption Title color', 'peekaboo' ),
		'desc' => __( 'Slide caption color', 'peekaboo' ),
		'id'   => $prefix . 'slide_caption_color',
		'type' => 'colorpicker',
		'std'  => ''
	) );
	$cmb->add_field( array(
		'name' => __( 'Description', 'peekaboo' ),
		'desc' => __( 'Slide description', 'peekaboo' ),
		'id'   => $prefix . 'slide_desc',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Description color', 'peekaboo' ),
		'desc' => __( 'Slide description color', 'peekaboo' ),
		'id'   => $prefix . 'slide_description_color',
		'type' => 'colorpicker',
		'std'  => ''
	) );

	$cmb->add_field( array(
		'name' => __( 'Caption top position', 'peekaboo' ),
		'desc' => __( 'Caption position from the top.', 'peekaboo' ),
		'id'   => $prefix . 'slide_caption_top',
		'type' => 'text_small',
		'std'  => ''
	) );
	$cmb->add_field( array(
		'name' => __( 'Caption left position', 'peekaboo' ),
		'desc' => __( 'Caption position from the left', 'peekaboo' ),
		'id'   => $prefix . 'slide_caption_left',
		'type' => 'text_small',
		'std'  => ''
	) );

	$cmb->add_field( array(
		'name' => __( 'CTA', 'peekaboo' ),
		'desc' => __( 'Call to Action description', 'peekaboo' ),
		'id'   => $prefix . 'slide_cta',
		'type' => 'text_medium',
	) );
	$cmb->add_field( array(
		'name' => __( 'URL', 'peekaboo' ),
		'desc' => __( 'Link to the image or cta', 'peekaboo' ),
		'id'   => $prefix . 'image_url',
		'type' => 'text',
		'std'  => ''
	) );

}

add_action( 'cmb2_admin_init', 'pkb_slide_metaboxes' );

/*-----------------------------------------------------------------------------------*/
/*  Define Testimonial Metabox Fields
/*-----------------------------------------------------------------------------------*/

function pkb_testimonial_metaboxes() {

	$prefix = 'pkb_';

	$cmb = new_cmb2_box( array(
		'id'           => 'pkb_testimonial_meta_box',
		'title'        => __( 'Testimonial Content', 'peekaboo' ),
		'object_types' => array( 'testimonial', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );

	$cmb->add_field( array(
		'name' => __( 'Name', 'peekaboo' ),
		'desc' => __( 'Costumer name', 'peekaboo' ),
		'id'   => $prefix . 'author_name',
		'type' => 'text',
		'std'  => ''
	) );

	$cmb->add_field( array(
		'name' => __( 'Title', 'peekaboo' ),
		'desc' => __( 'Costumer title', 'peekaboo' ),
		'id'   => $prefix . 'author_title',
		'type' => 'text',
		'std'  => ''
	) );


}

add_action( 'cmb2_admin_init', 'pkb_testimonial_metaboxes' );


/*-----------------------------------------------------------------------------------*/
/*  Define Gallery Metabox Fields
/*-----------------------------------------------------------------------------------*/

function pkb_gallery_metaboxes( $meta_boxes ) {

	$prefix = 'pkb_';

	$cmb = new_cmb2_box( array(
		'id'           => 'pkb_gallery_meta_box',
		'title'        => __( 'Gallery', 'peekaboo' ),
		'object_types' => array( 'gallery', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );

	$cmb->add_field( array(

		'name' => __( 'Image 1', 'peekaboo' ),
		'desc' => __( 'Upload an image or enter an URL. Recommended resolution 720px wide', 'peekaboo' ),
		'id'   => $prefix . 'upload_image',
		'type' => 'file',
	) );
	$cmb->add_field( array(

		'name' => __( 'Image 2', 'peekaboo' ),
		'desc' => __( 'Upload an image or enter an URL. Recommended resolution 720px wide', 'peekaboo' ),
		'id'   => $prefix . 'upload_image2',
		'type' => 'file',
	) );
	$cmb->add_field( array(

		'name' => __( 'Image 3', 'peekaboo' ),
		'desc' => __( 'Upload an image or enter an URL. Recommended resolution 720px wide', 'peekaboo' ),
		'id'   => $prefix . 'upload_image3',
		'type' => 'file',
	) );
	$cmb->add_field( array(

		'name' => __( 'Image 4', 'peekaboo' ),
		'desc' => __( 'Upload an image or enter an URL. Recommended resolution 720px wide', 'peekaboo' ),
		'id'   => $prefix . 'upload_image4',
		'type' => 'file',
	) );
	$cmb->add_field( array(

		'name' => __( 'Image 5', 'peekaboo' ),
		'desc' => __( 'Upload an image or enter an URL. Recommended resolution 720px wide', 'peekaboo' ),
		'id'   => $prefix . 'upload_image5',
		'type' => 'file',
	) );
	$cmb->add_field( array(

		'name' => __( 'Image 6', 'peekaboo' ),
		'desc' => __( 'Upload an image or enter an URL. Recommended resolution 720px wide', 'peekaboo' ),
		'id'   => $prefix . 'upload_image6',
		'type' => 'file',
	) );
	$cmb->add_field( array(

		'name' => __( 'Image 7', 'peekaboo' ),
		'desc' => __( 'Upload an image or enter an URL. Recommended resolution 720px wide', 'peekaboo' ),
		'id'   => $prefix . 'upload_image7',
		'type' => 'file',
	) );

	$cmb->add_field( array(

		'name' => __( 'Embed code', 'peekaboo' ),
		'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'peekaboo' ),
		'id'   => $prefix . 'video_url',
		'type' => 'oembed',
	) );


}

add_action( 'cmb2_admin_init', 'pkb_gallery_metaboxes' );
?>