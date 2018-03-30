<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Flickr Feed
 Description: Create and display a Flickr Feed element
 Class: TH_FlickrFeed
 Category: content
 Level: 3
 Scripts: true
*/
/**
 * Class TH_FlickrFeed
 *
 * Create and display a Flickr Feed element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_FlickrFeed extends ZnElements
{
	public static function getName(){
		return __( "Flickr Feed", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'flickr_feed', THEME_BASE_URI . '/addons/flickrfeed/jquery.jflickrfeed.min.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}
	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options['ff_id'] ) || empty( $options['ff_image_size'] ) ){
			return;
		}

		// default number of images to display
		$numImages = 6;
		if ( ! empty ( $options['ff_images'] ) ) {
			$numImages = absint($options['ff_images']);
			if(empty($numImages)){
				$numImages = 6;
			}
		}

		$image_size = '';
		if ( $options['ff_image_size'] == 'small' ) {
			$image_size = 'data-size="small"';
		}


		echo '<div class="flickrfeed '.$this->data['uid'].' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';
		if(isset($options['ff_title']) && !empty($options['ff_title'])){
			echo '<h3 class="m_title m_title_ext text-custom">' . $options['ff_title'] . '</h3>';
		}
		echo '<ul class="flickr_feeds flickrfeed-list fixclear " data-limit="' . $numImages . '" data-fid="'.$options['ff_id'].'" ' . $image_size . '></ul>';
		echo '</div><!-- end // flickrfeed -->';

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter a title for this element", 'zn_framework' ),
						"id"          => "ff_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Flickr ID", 'zn_framework' ),
						"description" => __( "Please enter your Flickr ID", 'zn_framework' ),
						"id"          => "ff_id",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Image Size", 'zn_framework' ),
						"description" => __( "Select the desired image size for the Flickr images", 'zn_framework' ),
						"id"          => "ff_image_size",
						"type"        => "select",
						"std"         => "small",
						"options"     => array (
							'normal' => __( 'Normal', 'zn_framework' ),
							'small'  => __( 'Small', 'zn_framework' )
						),
					),
					array (
						"name"        => __( "Images to load", 'zn_framework' ),
						"description" => __( "Please enter the number of images that you want to display", 'zn_framework' ),
						"id"          => "ff_images",
						"std"         => "6",
						"type"        => "text",
					),
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#HsX1KxNxKNM',
				'docs'    => 'http://support.hogash.com/documentation/flickr-feed/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
