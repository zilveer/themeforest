<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 *
 * 1. class BTP_Option_Model_Flex_Slides
 * 2. class BTP_Option_View_Flex_Slides
 * 3. class BTP_Option_Controller_Flex_Slides
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



if ( is_admin() ) {
	/* Include stylesheets */
	add_action( 'admin_enqueue_scripts', 'btp_flexslider_enqueue_admin_styles' );
	
	/* Include javascripts */
	add_action( 'admin_enqueue_scripts', 'btp_flexslider_enqueue_admin_scripts' );    
    
	/* Register AJAX callbacks */
	add_action( 'wp_ajax_btp_delete_flex_slide', 	'BTP_Option_Controller_Flex_Slides::delete_slide' );
	add_action( 'wp_ajax_btp_refresh_flex_slides', 'BTP_Option_Controller_Flex_Slides::refresh' );
}  



function btp_flexslider_enqueue_admin_styles() {
	wp_register_style( 
		'btp_flexslider', 
		get_template_directory_uri() . '/lib/flexsliders/css/btp_flexslider.css', 
		false,			 
		'1.0'
	);  	
    
    wp_enqueue_style( 'btp_flexslider' );
}



function btp_flexslider_enqueue_admin_scripts() {
	wp_register_script( 
        'btp_flexslider', 
        get_template_directory_uri() . '/lib/flexsliders/js/btp_flexslider.js', 
        array( 'jquery', 'wp-ajax-response' ) 
    );   	
    
    wp_enqueue_script( 'btp_flexslider' );
}



/**
 * Adds Flex Slider to extend Mediabox possibilities. 
 * 
 * Callback for btp_mediabox_choices custom filter hook
 * 
 * @param 				array $choices
 * @return				array
 */
function btp_flexslider_mediabox_choices( $choices ) {
	$choices[ 'flexslider' ] = 'flexslider';

	return $choices;
}
add_filter( 'btp_mediabox_choices' , 'btp_flexslider_mediabox_choices' );



/**
 * Adds Flex Slider description  
 * 
 * Callback for btp_mediabox_help custom filter hook
 * 
 * @param 				string $help
 * @return				string
 */
function btp_flexslider_mediabox_help( $help ) {
	$help .= '<p>' . __( 'The <strong>flexslider</strong> displays only image attachments. It tries to open an attachment alternative link (if provided) in a lightbox.', 'btp_theme' ) . '</p>';
	
	return $help;
}
add_filter( 'btp_mediabox_help' , 'btp_flexslider_mediabox_help' );



/**
 * Callback for btp_mediabox custom action hook
 * 
 * @param 			string $size Image size
 * @param 			string $type Mediabox type
 */
function btp_flexslider_mediabox( $size, $type ) {
	if ( 'flexslider' === $type ) {
		global $post;
		
		if ( $post ) {
			echo do_shortcode( '[flex_slider entry_id="' . $post->ID . '" class="entry-mediabox" size="' . $size . '"]' );
		}		
	}
}
add_action( 'btp_mediabox', 'btp_flexslider_mediabox', 10, 2 );



/**
 * Callback for btp_slider_choices custom filter hook
 * 
 * Adds available Flex Sliders.  
 * 
 * @param 				array $choices
 * @return				array
 */
function btp_flexslider_choices( $choices ) {
	$query_args = array( 
		'post_type' 	=> 'btp_flexslider', 
		'numberposts' 	=> -1,		 
	); 
	
	$sliders = get_posts( $query_args );
	if ( $sliders ) {
		foreach ( $sliders as $slider ) {
			$title = apply_filters( 'the_title' , $slider->post_title );
			$post_type = get_post_type_object( get_post_type( $slider ) );
			$title .= ' (' . $post_type->labels->singular_name;
			$title .= ', ID:' . $slider->ID . ')';
			
			$choices[ $slider->ID ] = strip_tags($title);
		}
	}
	
	return $choices;
}	
add_filter( 'btp_slider_choices' , 'btp_flexslider_choices' );



/**
 * Gets layout choices for a Flex Slider
 * 
 * If you want to add/delete some choices, hook into the btp_flexslider_layout_choices custom filter.
 * 
 * @return			array 
 */
function btp_flexslider_get_layout_choices() {
	$path = get_template_directory_uri();
	$path = $path . '/lib/flexsliders/images';
	
	$choices = array(
		'wide'		=> $path . '/layout-wide.png',
		'narrow'	=> $path . '/layout-narrow.png',
        );
        
	return apply_filters( 'btp_flexslider_layout_choices', $choices );
}



/**
 * Gets fx choices for a Flex Slider
 * 
 * If you want to add/delete some choices, hook into the btp_flexslider_fx_choices custom filter.
 * 
 * @return			array 
 */
function btp_flexslider_get_fx_choices() {
	$choices = array(
		'fade'		=> 'fade',
		'slide'		=> 'slide',
        );
        
	return apply_filters( 'btp_flexslider_fx_choices', $choices );
}



/**
 * Callback for btp_precontent custom action hook
 * 
 * Checks if the current object has some Flex Slider assigned.
 * If yes: it renders slider.
 * If no: it does nothing.      
 */
function btp_flexslider_precontent() {
	$slider_id = absint( btp_elements_get( 'slider_id' ) );
	
	if( !$slider_id || 'btp_flexslider' !== get_post_type( $slider_id) ) {
		return;
	}
	
	$layout = btp_entry_get_option_value( $slider_id, 'flexslider_layout');
	
	switch ( $layout ) {
		case 'narrow':
			echo do_shortcode( '[flex_slider entry_id="' . $slider_id . '" size="slider_narrow"]' );	
			break;
			
		default:
			echo do_shortcode( '[flex_slider entry_id="' . $slider_id . '" size="slider_wide"]' );
			break;	
	}	
}
add_action( 'btp_precontent', 'btp_flexslider_precontent' );



/**
 * Returns a flex slider markup
 * 
 * @param 				string $id The id attribute
 * @param 				integer $width Slider width
 * @param 				integer $height Slider height
 * @param 				array $config Slider configuration
 * @param 				array $slides 
 * @return				string
 */
function btp_flexslider_capture( $slides, $config, $args ) {
	static $counter = 0;
	$counter++;
	
	$out = '';
		
	if ( ! count( $slides ) ) {
		return '';
	}

	/* Clean arguments */
	$args[ 'id' ]			= !empty( $args[ 'id' ] ) ? $args[ 'id' ] : 'flex-container-counter-' . $counter;
	$args[ 'id' ]			= esc_attr( $args[ 'id' ] );
	$args[ 'class' ]		= !empty( $args[ 'class' ] ) ? $args[ 'class' ] : '';
	$args[ 'class' ]		= sanitize_html_classes( $args[ 'class' ] );
	$args[ 'width' ]		= absint( $args[ 'width' ] );
	$args[ 'height' ] 		= absint( $args[ 'height' ] );
	$config[ 'layout' ]				= preg_replace('/[^0-9a-zA-Z_-]*/', '', $config[ 'layout' ] );
	$config[ 'layout' ]				= strlen( $config[ 'layout' ] ) ? $config[ 'layout' ] : 'wide';
	$config[ 'shadow' ]				= preg_replace('/[^0-9a-zA-Z_-]*/', '', $config[ 'shadow' ] );
	$config[ 'animation' ]			= preg_replace('/[^0-9a-zA-Z_-]*/', '', $config[ 'animation' ] );
	$config[ 'animation' ]			= str_replace( '-', '_', $config[ 'animation' ] );
	$config[ 'animationDuration' ] 	= absint( $config[ 'animationDuration' ] );		
	$config[ 'slideshow' ]		= $config[ 'slideshow' ];
	$config[ 'slideshowSpeed' ]		= absint( $config[ 'slideshowSpeed' ] );

	$final_class = 'flex-container layout-' . $config[ 'layout' ] . ' ' . $args[ 'class' ];
	$final_class = trim( sanitize_html_classes( $final_class ) );
		
	/* Install Flex Slider. Not every page needs to load additional javascrips */
	add_action('wp_footer', 'btp_flexslider_wp_footer');
		
	$out .= '<div ' .
			'id="' . $args[ 'id' ] . '" ' .
			'class="' . $final_class . '" ' .
			'>';
	$out .= '<div class="flexslider" ' .
			'style="max-width: ' . $args[ 'width' ] . 'px;" ' .
			'data-config="' . btp_data_capture( $config ) . '">' . "\n";
		
			$out .= '<ul class="slides">' . "\n";
			foreach ( $slides as $slide ) {
				/* Default slide configuration  */
				$x = array(
					'layout' 	=> 'default',
					'width' 	=> $args['width'],
					'height' 	=> $args['height'],
				);
				/* Cascade configuration */
				$x = array_merge( $x, $slide );
				/* Check for an empty link */				
				$x['linking'] = strlen( $x[ 'link' ] ) ? $x['linking'] : 'none';
                $alt = !empty( $x['image_alt'] ) ? $x['image_alt'] : esc_url( $x['src'] );

				$media = '<img src="' .	esc_url( $x['src'] ) . '" ' . 
							'width="' . absint( $x['width'] ) . '" ' . 
							'height="' . absint( $x['height']) . '" ' .
							'alt="'. $alt .'" ' .
						'/>';
				
				switch ( $x[ 'linking' ] ) {
					case 'none':
						break;
					case 'new_window':
					case 'new-window':
						$media = '<a href="' . esc_url( $x[ 'link' ] ) . '" class="new-window">' .
									do_shortcode( '[indicator type="new-window"]' ) .
									$media .
								 '</a>';
						break;	
					case 'lightbox':
						$media = '<a href="' . esc_url( $x[ 'link' ] ) . '" rel="prettyPhoto[' . $args[ 'id' ] . ']">' .
									do_shortcode( '[indicator type="zoom"]' ) .
									$media . 
								 '</a>';
						break;
					default:									
						$media = '<a href="' . esc_url( $x[ 'link' ] ) . '">' .
									do_shortcode( '[indicator type="document"]' ) .
									$media .
								 '</a>';
						break;			
				}	
				$media = '<div class="media">' . 
							$media .
						'</div>';

				$desc = '';								
				if ( strlen( $x['title'] || strlen($x['content']) ) ) {
					$desc .=	'<div class="description">' . "\n" .
									'<div class="inner">' . "\n" .
										'<h4>' . $x['title'] . '</h4>' . "\n" .
										'<div>' . do_shortcode( $x['content'] ) . '</div>' . "\n" .
									'</div>' . "\n" .
									'<div class="background"></div>' . "\n" .
								'</div>' . "\n";
				}	
							
				$out .= '<li>' . "\n" .
							'<div class="slide layout-' . sanitize_html_class( $x['layout'] ) . '">' . "\n" .
								$media . 
								$desc .
							'</div>' . "\n" .
						'</li>' . "\n";
			}
			$out .= '</ul>' . "\n";
	$out .= '</div><!-- .slider -->' . "\n";	
	
	if ( strlen( $config['shadow'] ) ) {	
		$img_src = get_template_directory_uri() . '/images/' . $config['shadow'] . '.png';

        $out .= '<img class="flex-shadow" src="' . $img_src . '" alt="' . $img_src . '"/>';
	}	
	$out .= '<div class="flex-nav"></div>';
	
	
	$out .= '</div>';
	
	return $out;
}
function btp_flexslider_render( $slides, $config, $args ) {
	echo btp_flexslider_capture( $slides, $config, $args );
}



btp_shortgen_add_subgroup( 'sliders', array( 'label' => __( 'Sliders', 'btp_theme' ), ), 'general', 400 );



btp_shortgen_add_item( 
	'flex_slider',
	array(
		'label'			=> '[flex_slider]',
		'atts'			=> array(
			'id' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( 'The id attribute specifies an id for an HTML element.', 'btp_theme' ) . '<br />' .
					__( 'It must be unique within the HTML document.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),	 
			),
			'class'			=> array(
				'view'			=> 'String',
				'hint'			=> 
					__( 'The class attribute specifies a class name for an HTML element.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),
			),
			'width' 		=> array( 
				'view' 			=> 'String',
				'hint'			=> __( 'The width in pixels', 'btp_theme' ), 
			),			
			'height' 		=> array( 
				'view' 			=> 'String',
				'hint'			=> __( 'The height in pixels', 'btp_theme' ), 
			),
		),
		'content'		=> array( 
			'view' 			=> 'Text', 
			'label' 		=> __( 'images', 'btp_theme' ),
			'hint'			=> __( 'Each image source in a new line', 'btp_theme' ), 
		),
		'group'			=> 'general',
		'subgroup'		=> 'sliders',	
		'position'		=> 10,
	)						 
); 



/**
 * [flex_slider] shortcode callback. 
 * 
 * @param $atts
 * @param $content
 * @return string
 */
function btp_flexslider_shortcode( $atts, $content = null ) {
	global $post;
	
	extract( shortcode_atts( array(		
		'entry_id'	=> 0,
		'id'		=> '',
		'class'		=> '',
		'size'		=> 'thumbnail',
		'height'	=> 100,
		'width'		=> 100, 
	), $atts ) );			
	$content	= preg_replace( '#^<\/p>|<p>$#', '', $content );
	$imgs 		= strip_tags( $content );
	$imgs 		= explode( "\n", trim( $imgs ) );	

	/* Clean attributes */
	$entry_id 	= absint( $entry_id );
	$width 		= absint( $width );
	$height		= absint( $height );
	$size 		= preg_replace('/[^0-9a-zA-Z_-]*/', '', $size );
	
	/* Compose default configuration */
	$config = array(
		'layout'				=> 'wide',
		'shadow'				=> '',
		'animation'				=> btp_theme_get_option_value( 'flexslider_animation' ),
		'animationDuration'		=> btp_theme_get_option_value( 'flexslider_animation_duration' ) * 1000,		
		'slideshow'		        => btp_theme_get_option_value( 'flexslider_slideshow' ),
		'slideshowSpeed'		=> btp_theme_get_option_value( 'flexslider_slideshow_speed' ) * 1000,
	);
	
	$slides = array();
	
	/* --------------------------------------------------------------------- */
	/* Build slider from attachments */
	/* --------------------------------------------------------------------- */
	if ( $entry_id ) {	
		/* Compose final HTML id attribute */
		$id = strlen( $id ) ? $id : 'flex-slider-entry-' . $entry_id;		 
		
		$slider = get_post( $entry_id );
		if ( ! $slider  )
			return '';
		
		/* Check if image size exists */
		global $_wp_additional_image_sizes;	
		if ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
			$width = absint( $_wp_additional_image_sizes[ $size ][ 'width' ] );	
			$height = absint( $_wp_additional_image_sizes[ $size ][ 'height' ] );
		} else {
			return btp_helpmode_capture(
				__( 'Wrong shortcode attribute: size', 'btp_theme' ),
				__( 'There is no such image size registered with the add_image_size() function', 'btp_theme' ),
				'error'
			);
		}
		
		/* Get configuration from the attachments parent ( slider ) */
		if ( 'btp_flexslider' == $slider->post_type ) {
			$config[ 'layout' ]				= btp_entry_get_option_value( $entry_id, 'flexslider_layout' );
			$config[ 'shadow' ]				= btp_entry_get_option_value( $entry_id, 'flexslider_shadow' );
			$config[ 'animation' ]			= btp_entry_get_option_value( $entry_id, 'flexslider_animation' );			
			$config[ 'animationDuration' ] 	= btp_entry_get_option_value( $entry_id, 'flexslider_animation_duration' ) * 1000;		
			$config[ 'slideshow' ]		    = btp_entry_get_option_value( $entry_id, 'flexslider_slideshow' );
			$config[ 'slideshowSpeed' ]		= btp_entry_get_option_value( $entry_id, 'flexslider_slideshow_speed' ) * 1000;
		}
		
		/* Prepare query arguments */
		$query_args = array(
			'post_parent'		=> $entry_id,
			'post_type'			=> 'attachment',
			'post_mime_type'	=> array( 'image' ),
			'post_status'		=> 'inherit',
			'posts_per_page'	=> 50,
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC'
		);
	
		btp_loop_before();
		
		$query = new WP_Query($query_args);
		
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) { $query->the_post();
				$slide = array(
					'title' 	=> $post->post_excerpt,
					'content'	=> $post->post_content,
                    'image_alt' => get_post_meta( $post->ID, '_btp_image_alt', true ),
					'link'		=> get_post_meta( $post->ID, '_btp_alt_link', true ),
					'linking'	=> get_post_meta( $post->ID, '_btp_alt_linking', true ),
					'layout'	=> get_post_meta( $post->ID, '_btp_layout', true ),
				);		
				
				$slide[ 'src' ] = wp_get_attachment_image_src( $post->ID, $size );
				$slide[ 'src' ] = $slide[ 'src'][ 0 ];
				
				$slides[] = $slide;
			}
		}		
			
		btp_loop_after();

	/* --------------------------------------------------------------------- */	
	/* Build slider from shortcode content */
	/* --------------------------------------------------------------------- */
	} else {		
		foreach( $imgs as $img ) {
			$slide = array(
				'title'		=> '',
				'content'	=> '',
				'link'		=> '',
				'linking'	=> '',
				'layout'	=> '',
				'src'		=> $img,
			);
			$slides[] = $slide;
		}		
	}	
	
	$args = array(
		'id'		=> $id,
		'class'		=> $class,
		'width'		=> $width,
		'height'	=> $height,
	);
	
	return btp_flexslider_capture( $slides, $config, $args );
}
add_shortcode( 'flex_slider', 'btp_flexslider_shortcode' );
add_shortcode( 'flexslider', 'btp_flexslider_shortcode' );



/**
 * Enqueues javascripts required for the Flex Slider to work
 */
function btp_flexslider_wp_footer() {	
	wp_enqueue_script( 'jquery.flexslider', get_template_directory_uri().'/js/jquery.flexslider/jquery.flexslider-min.js', array( 'jquery', 'easing' ) );	 
	wp_print_scripts( 'jquery.flexslider' );		
}



/**
 * Removes unused metaboxes from the Flex Slider edit screen
 */
function btp_flexslider_remove_meta_boxes() {
	remove_meta_box( 'slugdiv', 'btp_flexslider', 'normal' );
}
add_action( 'add_meta_boxes', 'btp_flexslider_remove_meta_boxes' );



/**
 * Filters form fields those will be rendered when editing an attachment of a Flex Slider 
 * 
 * @param 			array $form_fields
 * @param 			object $post
 * @return 			array 
 */
function btp_flexslider_attachment_fields_to_edit( $form_fields, $post ) {
	if (
		$post->post_parent &&		 
		'btp_flexslider' === get_post_type( $post->post_parent ) 
	) {
		/* Clear all fields, these will be available on the slider edit screen */
   		$form_fields = array();
   		
   		/* Prepare button 'Back to Edit Slider' */
   		$button = "<a href='#' onclick='BTPAddFlexSlide(\"$post->ID\");return false;'>" . esc_html__( 'Back to Edit Slider', 'btp_theme' ) . "</a>";
   		
   		/* Add button as field */
   		$form_fields[ 'buttons' ] = array( 'tr' => "\t\t<tr class='submit'><td></td><td>$button</td></tr>\n" );
	}	
  
	return $form_fields;  
} 
add_filter( 'attachment_fields_to_edit', 'btp_flexslider_attachment_fields_to_edit', 999, 2 );



/**
 * Filters media upload tabs those will be rendered when editing an attachment of a Flex Slider 
 * 
 * @param 			array $tabs
 * @return			array	
 */
function btp_flexslider_manage_media_upload_tabs( $tabs ) {
	if(
		isset ( $_REQUEST[ 'post_id' ] ) &&
		'btp_flexslider' === get_post_type( $_REQUEST[ 'post_id' ] )
	) {	
		unset( $tabs[ 'type_url'] );
		unset( $tabs[ 'library'] );
		unset( $tabs[ 'gallery'] );
	}	
	return $tabs;
}
add_filter( 'media_upload_tabs', 'btp_flexslider_manage_media_upload_tabs', 999 );



/**
 * Callback for add_attachment filter
 * 
 * Updates menu_order field with some high value, so that a new attachment 
 * (slide to be exact ) can land at the end of the Flex Slider  
 *  
 * @param $post_id
 */
function btp_flexslider_add_attachment( $post_id ) {		
	$post = get_post( absint( $post_id ) );
	
	if ( 
		$post && 
		$post->post_parent && 
		'btp_flexslider' === get_post_type( $post->post_parent ) 
	) {		
		global $wpdb;
		
		/* Update menu_order field with some high value */
  		$wpdb->update( 
			$wpdb->posts,
			array( 'menu_order' => 999 ), 
			array( 
				'ID' 			=> $post_id,
			), 
			array( '%d'	), 
			array( '%d' ) 
		);
		
		/* Remember to clean post cache due to previous update */
		clean_post_cache( $post_id );
	}
	
}
add_filter( 'add_attachment', 'btp_flexslider_add_attachment', 999 );



class BTP_Option_Model_Flex_Slides extends BTP_Option_Model {	
	public function update( $option ) {
		$id = $option->id;
		$prefix = $option[ 'prefix' ];
		
		switch( $this->scope ) {
			case 'post':
			case 'entry':	
				if ( 
					isset( $_POST[ $prefix ][ $id ] ) &&
					isset( $_POST[ $prefix ][ $id ][ 'slides' ] )
				 ) {
					
					$slides = $_POST[ $prefix ][ $id ][ 'slides' ];
					
					foreach( $slides as $slide_id => $slide ) {
						$slide_id = intval( $slide_id );
						
						/* Prepare data for update */
						$data = array();

						$data[ 'post_excerpt' ] = isset( $slide[ 'post_excerpt' ] ) ? stripslashes_deep( $slide[ 'post_excerpt' ] ) : '';
						$data[ 'post_content' ] = isset( $slide[ 'post_content' ] ) ? stripslashes_deep( $slide[ 'post_content' ] ) : '';
						$data[ 'menu_order' ] = isset( $slide[ 'menu_order' ] ) ? absint( $slide[ 'menu_order' ] ) : 999;
						
  						
  						global $wpdb;
  						$wpdb->update( 
							$wpdb->posts,
							$data, 
							array( 
								'ID' 			=> $slide_id,
								'post_parent' 	=> $this->object_id,
							), 
							array( '%s', '%s', '%d'	), 
							array( '%d', '%d' ) 
						);
							
						clean_post_cache( $slide_id );


                        if ( isset( $slide[ 'image_alt' ] ) ) {
                            update_post_meta( $slide_id, '_btp_image_alt', stripslashes_deep( $slide[ 'image_alt' ] ) );
                        } else {
                            delete_post_meta( $slide_id, '_btp_image_alt');
                        }

						if ( isset( $slide[ 'link' ] ) ) {						
							update_post_meta( $slide_id, '_btp_alt_link', stripslashes_deep( $slide[ 'link' ] ) );
						} else {
							delete_post_meta( $slide_id, '_btp_alt_link');
						}	
						
						if ( isset( $slide[ 'linking' ] ) ) {						
							update_post_meta( $slide_id, '_btp_alt_linking', stripslashes_deep( $slide[ 'linking' ] ) );
						} else {
							delete_post_meta( $slide_id, '_btp_alt_linking');
						}
						if ( isset( $slide[ 'layout' ] ) ) {						
							update_post_meta( $slide_id, '_btp_layout', stripslashes_deep( $slide[ 'layout' ] ) );
						} else {
							delete_post_meta( $slide_id, '_btp_layout');
						}
					}
					
				}	
				
				break;
		}	
	}
	
	
	/**
	 * Ends the update process
	 */
	public function after_updates(){
		
	}
	
	
	
	public function select( $option ) {
		$result = array( 'slider_id' => $this->object_id, 'slides' => array() );
		
		$query_args = array(
			'post_type'			=> 'attachment',
			'post_parent'		=> $this->object_id,
	   		//'posts_per_page'	=> 50,
			'numberposts'     	=> 50,		
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order ID'
		);

		$result[ 'slides' ] = get_posts( $query_args );
		
		return $result;
	}
	
	
	/**
	 * Ends the select process
	 */
	public function after_selects(){
		
	}
}



class BTP_Option_View_Flex_Slides extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-flex-slides'; }
	
	public function capture_label() {}
	
	public function capture_field(){
		$out = '';
		
		$value = $this->get_value();
		
		$out .= '<div class="btp-flex-slide-container">';
			$out .= '<input name="' . esc_attr( $this->get_name() . '[option_id]' ) . '" type="hidden" value="' . esc_attr( $this->get_id() ) . '" />';	
			foreach ( $value[ 'slides' ] as $slide ) {			
				$prefix = $this->get_name() . '[slides][' . intval( $slide->ID ) . ']';		
				
				$out .= '<div id="' . esc_attr( 'btp-flex-slide-' . $slide->ID ) . '" class="btp-flex-slide">';
					$out .= '<input name="' . esc_attr( $prefix . '[menu_order]' ) . '" type="hidden" value="' . esc_attr( $slide->menu_order ) . '" />';
	        		$out .= '<input name="' . esc_attr( $prefix . '[delete_flex_slide_nonce]' ) . '" type="hidden" value="' . esc_attr( wp_create_nonce( 'delete_flex_slide_' . $slide->ID ) ) . '" />';	
	        			
					$out .= '<ul class="btp-toolbar">';
						$out .= '<li><a title="' . __( 'Drag', 'btp_theme' ) . '" class="btp-handle" href="#"></a></li>';
						$out .= '<li><a title="' . __( 'Move Up', 'btp_theme' ) . '" class="btp-move-up" href="#"></a></li>';
						$out .= '<li><a title="' . __( 'Move Down', 'btp_theme' ) . '" class="btp-move-down" href="#"></a></li>';
  						$out .= '<li><a title="' . __( 'Delete', 'btp_theme' ) . '" class="btp-delete-slide" href="#" rel="' . esc_attr( $slide->ID ) . '">' . __( 'Delete', 'btp_theme' ) . '</a></li>';
  					$out .= '</ul>';
  					
  					$out .= '<div class="btp-essentials">';
  						$out .= '<div class="btp-media">';
  						 	$out .= wp_get_attachment_image( $slide->ID, 'thumbnail' );
  						$out .= '</div><!-- .btp-media -->';
  						
  						$out .= '<div class="btp-nonmedia">';
  				
			        		$obj = new BTP_Option_View_String(
			        			$prefix . '[excerpt]',
			        			array(
			        				'label'		=> __( 'Caption', 'btp_theme' ),
			        				'name'		=> $prefix . '[post_excerpt]'
			        			),
			        			$slide->post_excerpt
			        		); 	
			        		$out .= $obj->capture();
			        		
			        		$obj = new BTP_Option_View_Text(
			        			$prefix . '[content]',
			        			array(
			        				'label'		=> __( 'Description', 'btp_theme' ),
			        				'name'		=> $prefix . '[post_content]',
			        			),
			        			$slide->post_content
			        		); 	
			        		$out .= $obj->capture();

                            $obj = new BTP_Option_View_String(
                                $prefix . '[image_alt]',
                                array(
                                    'label'		=> __( 'Alternate image text', 'btp_theme' ),
                                    'name'		=> $prefix . '[image_alt]',
                                ),
                                get_post_meta( $slide->ID, '_btp_image_alt', true )
                            );
                            $out .= $obj->capture();

			        		$obj = new BTP_Option_View_Text(
			        			$prefix . '[link]',
			        			array(
			        				'label'		=> __( 'Link', 'btp_theme' ),
			        				'name'		=> $prefix . '[link]',
			        			),
			        			get_post_meta( $slide->ID, '_btp_alt_link', true )
			        		); 	
			        		$out .= $obj->capture();

			        		$obj = new BTP_Option_View_Choice(
			        			$prefix . '[linking]',
			        			array(
			        				'label'		=> __( 'Linking', 'btp_theme' ),
			        				'hint'		=> __( 'What to do when user clicks the slide?', 'btp_theme' ), 
			        				'name'		=> $prefix . '[linking]',
			        				'choices'	=> array(
			        					'standard'		=> 'open the link in the same window',
			        					'new-window'	=> 'open the link in a new window',
			        					'lightbox'		=> 'open the link in a lightbox',
			        					'none'			=> 'none',
			        				),
			        			),
			        			get_post_meta( $slide->ID, '_btp_alt_linking', true )
			        		);
			        		$out .= $obj->capture();
			        		
			        		$obj = new BTP_Option_View_Choice(
			        			$prefix . '[layout]',
			        			array(
			        				'label'		=> __( 'Layout', 'btp_theme' ),
			        				'name'		=> $prefix . '[layout]',
			        				'choices'	=> array(
			        					'bubble-top-left'		=> 'bubble-top-left',
			        					'bubble-top-right'		=> 'bubble-top-right',
			        					'bubble-bottom-left'	=> 'bubble-bottom-left',
			        					'bubble-bottom-right'	=> 'bubble-bottom-right',
			        				),
			        			),
			        			get_post_meta( $slide->ID, '_btp_layout', true )
			        		); 	 	
			        		$out .= $obj->capture(); 	        		
        				$out .= '</div><!-- .btp-nonmedia -->';
        			$out .= '</div><!-- .btp-essentials -->';
	        	$out .= '</div><!-- .btp-flex-slide -->';
			}
		
			if ( $value[ 'slider_id' ] ) {
				$out .= '<p><a href="' . admin_url( 'media-upload.php?post_id=' . $value[ 'slider_id' ] . '&type=image&TB_iframe=1&width=640&height=466' ) . '" class="button thickbox">' . __( 'Add new Flex Slide', 'btp_theme') . '</a></p>';	
			} else {
				$out .= '<p>' . __( 'You must first save this slider in order to adding slides', 'btp_theme' ) . '</p>';
			}
			
		return $out;	
	}
}





class BTP_Option_Controller_Flex_Slides {
	
	/**
	 * Refresh slide container ( AJAX callback )
	 * 
	 * @return 			WP_Ajax_Response
	 */
	static public function refresh() {	
		$slider_id = absint( $_POST[ 'btp_slider_id' ] );
		$option_id = $_POST[ 'btp_option_id' ];	
		
		/* Get option configuration */
		$option = btp_entry_get_option( $option_id );
		
		/* Prepare response arguments */
		$response_args = array(
	   		'what'			=> 'btp_refresh_flex_slides',
	   		'action'		=> 'btp_refresh_flex_slides',
		);	
	
		/* Create Option Model */
		$model = new BTP_Option_Model_Flex_Slides( 'entry', $slider_id );
		/* Select value from the model */
		$slides = $model->select( $option );
		
		/* Create Option View */
		$view = new BTP_Option_View_Flex_Slides( 
	        $option->id,
	        $option->config,							
	        $slides		
	    );
	    						
		$response_args[ 'data' ] = $view->capture();
	
		/* Successful AJAX action */
	    $response_args[ 'id'] = 1;
	    
	    /* Create response object and send it */
	    $response = new WP_Ajax_Response( $response_args );
		$response->send();
		exit;
	}
	
	
	/**
	 * Delete slide ( AJAX callback )
	 * 
	 * @return 		WP_Ajax_Response
	 */
	static public function delete_slide() {
		$slide_id = intval( $_POST['btp_slide_id'] );
		
		/* Prepare response arguments */
		$response_args = array(
   			'what'			=> 'btp_delete_flex_slide',
   			'action'		=> 'btp_delete_flex_slide',
		);
				
		/* Verify nonce */
		if ( !check_ajax_referer( 'delete_flex_slide_' . $slide_id, 'btp_nonce', false) ) {
			$response_args[ 'id'] = new WP_Error( 'oops', __( 'Nonce incorrect!', 'btp_theme' ) );
			$response = new WP_Ajax_Response( $response_args );
			$response->send();
			exit;		
		}	
		
		/* Check permissions */
	    if ( !current_user_can( 'delete_post', $slide_id ) ) {
	        $response_args[ 'id'] = new WP_Error( 'oops', __('You do not have sufficient permissions to access this page.', 'btp_theme') );
			$response = new WP_Ajax_Response( $response_args );
			$response->send();
			exit;	         
	    }		
		
	    /* Try to delete slide */
		if( !wp_delete_attachment( $slide_id, true ) ) {
			$response_args[ 'id'] = new WP_Error( 'oops', __('Could not delete new slide. Please try again.', 'btp_theme') );
			$response = new WP_Ajax_Response( $response_args );
			$response->send();
			exit;	 
		} 		
		
		/* Successful AJAX action */
		$response_args[ 'id'] = 1;
		
		/* Create response object and send it */
		$response = new WP_Ajax_Response( $response_args );
		$response->send();
		exit;			
	}
}
?>