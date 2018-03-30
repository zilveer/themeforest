<?php
/*
    Extension Name: Content Rotator
    Extension URI:
    Version: 1.0
    Description: Adds a simple content rotator ability to theme content or by shortcode.
    Author: Parallelus
    Author URI: http://runwaywp.com
    Text Domain:
    Domain Path:
    Network:
    Site Wide Only:
*/

// Initiate the class
$Runway_ContentRotator = new Runway_ResponsiveContentRotator();


/**
 * 
 * A class to invoke the different content output methods and settings
 * 
 */

class Runway_ResponsiveContentRotator {


	function __construct() {

		// Enqueue scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'Styles_and_scripts' ) );

		// Should we register a shortcode here?
		// $this->create_shortcode();
	}

	/**
	 * JavaScript and CSS includes
	 */
	public function Styles_and_scripts() {

		// Register scripts
		wp_register_script( 'content-rotator',    get_template_directory_uri() . '/extensions/content-rotator/js/jquery.content-rotator.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'content-rotator' ); 

		// Add style sheets
		wp_enqueue_style( 'content-rotator', get_template_directory_uri() . '/extensions/content-rotator/css/content-rotator.css' );
	}

	/**
	 * Output the content rotator code.
	 */
	public function Generate( $params=array() ) {

		$rotator = '';

		// Check for a title
		if (isset($params['title']) && !empty($params['title'])) {
			$rotator .= '<h2 class="content-rotator-heading">'. $params['title'] .'</h2>';
			unset($params['title']);
		} 

		// Select content sourece
		if (!isset($params['type']) || empty($params['type']) || $params['type'] == 'posts') {
			$content = $this->getPostContent( $params );
		} elseif ($params['type'] == 'post-gallery') {
			$content = $this->getPostGallery( $params );
		} // elseif ( media ) {
			// TODO:  Add support for media files (and maybe other media from URLs?)
		// }

		// How many columns
		$columns = 1;
		if ( isset($params['columns']) ) {
			$columns = (int) $params['columns'];
			if ($columns > 12) {
				$columns = 12;
			}
			if ($columns < 1) {
				$columns = 1;
			}
		}

		// Get all the slides
		if (isset($content) && is_array($content)) {
			$slides = array();
			$count = 1;
			foreach ($content as $slide) {
				$first = ( $count++ % $columns == 1) ? ' first' : '';
				$slides[] = '<div class="single-item'. $first .'" data-index="'.($count-1).'">'. $slide .'</div>';
			}
		}

		// Settings
		$data['paging']   = (isset($params['slide_paging']) && $this->trueFalse($params['slide_paging'])) ? 'data-paginate' : '';
		$data['autoplay'] = (isset($params['autoplay']) && $this->trueFalse($params['autoplay'])) ? 'data-autoplay="true"' : '';
		$data['interval'] = (isset($params['interval'])) ? 'data-interval="'. $params['interval'] .'"' : '';
		$transition       = (!isset($params['transition']) && $columns > 1) ? 'slide' : $params['transition']; // slide, fade, flip
		$class            = "rotator rotator-columns-". $columns;
		$class            = (isset($params['class'])) ? $class .' '. $params['class'] : $class;
		$dataAttributes   = implode(" ", $data);

		if (isset($slides)) {
			// Add the container and content
			$rotator .= '<div class="'. $class .'" data-transition="'. $transition .'" '. $dataAttributes .'>'. implode("\n", $slides) .'</div>';
		} else {
			$rotator .= '<!-- Content Rotator: Nothing to show. -->';
		}

		// Send the content out
		return $rotator;
	}

	/**
	 * 
	 * Get the content for posts
	 * 
	 */
	public function getPostContent($params = array()) {

		$content='';

		// Initiate shortcode query builder class
		$shortcodeQuery = new Runway_ShortcodeQueryBuilder();
		$wp_query_args = $shortcodeQuery->getQueryParams( $params );

		if (!$wp_query_args) {
			return;
		}

		// Make sure we get all queried items
		$wp_query_args['posts_per_page'] = -1;

	    // make new query based on shortcode
		$the_query = new WP_Query($wp_query_args);

		if ( $the_query->have_posts() ) : 

			// Get posts and content
			// ------------------------------------------------------------------

			// Loop through the results and print each. 
			while ( $the_query->have_posts() ) : $the_query->the_post();  
					
				$linkTitle = esc_attr(sprintf( __('Permalink to %s', 'framework'), the_title_attribute('echo=0')));
				$excerptLength = (isset($params['excerpt_length'])) ? $params['excerpt_length'] : 20;
				$id = get_the_ID();
				$content[$id] = '';

				// Thumbnail image
				if (has_post_thumbnail()) {

					// Get the image data
					$image['post_id'] = $id;
					if (isset($params['image_size'])) {
						$image['image_size'] = $params['image_size'];
					}

					// Retrieve the resized image
					$thumbnail = $this->getResizedImage( $image );

					// see if we have any content after the image
					$hasContent = '';
					if ( (isset($params['hide_title']) && $params['hide_title'] == 'true') && (!isset($params['post_excerpts']) || empty($params['post_excerpts']))) {
						$hasContent = 'no-content';
					}

					// Build the image container
					$content[$id] .= '<div class="featured-image '.$hasContent.'" data-image="'. esc_url($thumbnail['large_image']) .'">';
					$content[$id] .= '<a href="'. get_permalink() .'" class="styled-image '. get_post_format() .'" title="'. $linkTitle .'" rel="bookmark">'. $thumbnail['full_image_tag'] .'</a>';
					$content[$id] .= '</div>';
				}

				// Post title
				if (!isset($params['hide_title']) || $params['hide_title'] !== 'true') {
					$content[$id] .= '<h2 class="entry-title"><a href="'. get_permalink() .'" title="'. $linkTitle .'">'. get_the_title() .'</a></h2>';
				}

				// Post content
				if (isset($params['post_excerpts']) && !empty($params['post_excerpts'])) {
					$content[$id] .= '<div class="entry-content"><p>'. customExcerpt(get_the_excerpt(), $excerptLength) .'</p></div>';
				}

			endwhile;
		endif;

		// Clean up
	    unset($the_query);
	    unset($wp_query_args);
		wp_reset_postdata();

		return $content;

	}

	/**
	 * 
	 * Get the content for featured images
	 * 
	 */
	public function getPostGallery($params = array()) {
		global $post;

		$content='';

		// Get a post object or ID
    	$post_id = (isset($params['post_id'])) ? $params['post_id'] : $post->ID;

    	// Get the media ID's
		$ids = esc_attr(get_post_meta($post_id, 'postformat_gallery_ids', true));

		// Set the image size
		if (isset($params['image_size'])) {
			$image['image_size'] = $params['image_size'];
		}

		// Query the media data
		$attachments = get_posts( array(
			'post__in' => explode(",", $ids),
			'orderby' => 'post__in',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => 'any',
			'numberposts' => -1
		));
		
		// Wrap image in container
		$before = '<div class="plain-image">'; 
		$after  = '</div>';

		// In blog lists we use links to wrap the images
		if ( ! is_single() )  {
			$before = '<a href="'. get_permalink() .'" title="'. sprintf( __( 'Permalink to %s', 'framework' ), the_title_attribute( 'echo=0' ) ) .'" rel="bookmark" class="plain-image '. get_post_format() .'">'; 
			$after = '</a>';
		}

		// Create the media display
		if ($attachments) {
			foreach ($attachments as $attachment) {

				// Get the image data
				$image['id'] = $attachment->ID;

				// Retrieve the resized image
				$thumbnail = $this->getResizedImage( $image );

				// Create the content item
				$content[$attachment->ID] = $before . $thumbnail['full_image_tag'] . $after;
			
			}
		}	

		return $content;

	}

	/**
	 * 
	 * Get resized image
	 * 
	 */
	public function getResizedImage($params) {
		global $_wp_additional_image_sizes;

		// Some variables we'll need
		$defaults = array(
			'image_size'=>'medium', 
			'id'=>false, 
			'post_id'=>false
		);
		$params = array_merge($defaults, $params); 
		$resizedImage = $fullImage = $alt = '';

		// Get variables from the $params array
		extract($params); 

		// Check if a post ID was supplied
		if ($post_id && !$id) {
			$id = get_post_thumbnail_id($post_id);
		}

		// We must have an ID for the media file
		if (!$id) {
			return;
		}

		// Grab the large image for later
		$largeImage  = wp_get_attachment_image_src($id, 'large' );

		// See if WP already has a resized image matching what we want
		if ( is_string($image_size) && ((!empty($_wp_additional_image_sizes[$image_size]) && is_array($_wp_additional_image_sizes[$image_size])) || in_array($image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) ) {
			$fullImage = wp_get_attachment_image( $id, $image_size );
		}

		// We didn't find an existing image at the needed size so we need to create a new one
		if ( $fullImage == '' &&  $id ) {

			// Get the full image tag for the medium image, just in case...
			$fullImage = wp_get_attachment_image($id, 'medium' );

			// Resize image to custom size
			if (function_exists('vt_resize') && is_string($image_size)) {

				// Clean up the image size data to get the dimensions.
				$size = str_replace(array( 'px', ' ', '*', '×' ), array( '', '', 'x', 'x' ), strtolower($image_size)); 
				$size = explode("x", $size);

				// Set width and height
				$width  = (isset($size[0])) ? $size[0] : 0;
				$height = (isset($size[1])) ? $size[1] : 0;

				$crop = (  $width == 0 || $height == 0 ) ? false : true;

				// Resize the image
				$resizedImage = vt_resize( $id, '', $width, $height, $crop );

				// Find the alt text associated with this media file
				$alt = trim(strip_tags( get_post_meta($id, '_wp_attachment_image_alt', true) ));
						
			} else {
				// Oh bother! We don't have a reize function to use.
			}

			// Make sure we have alternate text
			if ( empty($alt) ) {

				// No? Try the caption instead.
				$attachment = get_post($id);
				$alt = trim(strip_tags( $attachment->post_excerpt ));

				if ( empty($alt) ) {

					// Still nothing!!? Ok, we'll use the post title.
					$alt = trim(strip_tags( $attachment->post_title ));

				} 
			}

			// Let's wrap this up and create a full image tag.
			if ( $resizedImage ) {
				// $resizedImage = '<img src="'.$p_img['url'].'" width="'.$p_img['width'].'" height="'.$p_img['height'].'" alt="'.$alt.'" />';
				$fullImage = '<img src="'. $resizedImage['url'] .'" width="'. $resizedImage['width'] .'" height="'. $resizedImage['height'] .'" alt="'.$alt.'">';
			}
		}

		return array( 'full_image_tag' => $fullImage, 'large_image' => $largeImage[0] );

	}
	/**
	 * 
	 * Return a bool TRUE/FALSE including for human responses
	 * 
	 */
	private function trueFalse($value) {

		if ($value === true) {
			return true;
		}

		if (is_string($value)) {
			$value = strtolower($value);
		}

		return in_array($value, array('true','1','yes','on')); // anything else if false
	}
}


// Quick access function
function theme_content_rotator( $args ) {
	// global $Runway_ContentRotator;

	$Runway_ContentRotator = new Runway_ResponsiveContentRotator();
	return $Runway_ContentRotator->Generate( $args );
}

?>