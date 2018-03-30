<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Image Box 2
 Description: Create and display an Image Box element
 Class: TH_ImageBox2
 Category: content, media
 Level: 3
 Keywords: imagebox, image, picture, photo
*/
	/**
	 * Class TH_ImageBox2
	 *
	 * Create and display an Images Box element
	 *
	 * @package  Kallyas
	 * @category Page Builder
	 * @author   Team Hogash
	 * @since    3.8.0
	 */
	class TH_ImageBox2 extends ZnElements
	{
		public static function getName(){
			return __( "Images Box 2", 'zn_framework' );
		}
/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$margin = $this->opt('ib2_bottommargin', '20');

		if( $margin != '20' ){
			$css .= ".{$uid} .offer-banners-link { margin-bottom: {$margin}px }";
		}

		return $css;
	}
		/**
		 * This method is used to display the output of the element.
		 *
		 * @return void
		 */
		function element()
		{
			$options = $this->data['options'];
			$uid = $this->data['uid'];
			$resize_method = $this->opt('ib2_resize_method','default');

			echo '<div class="offer-banners ob--resize-'.$resize_method.' '.$uid.' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';

			if ( ! empty ( $options['image_box_title'] ) ) {
				echo '<h3 class="m_title m_title_ext text-custom offer-banners-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['image_box_title'] . '</h3>';
			}

			if ( ! empty ( $options['ib2_single'] ) && is_array( $options['ib2_single'] ) )
			{
				echo '<div class="row">';
				foreach ( $options['ib2_single'] as $simage )
				{
					if ( $slide_image = $simage['ib2_image'] )
					{
						$saved_alt   = ZngetImageAltFromUrl( $slide_image );
						$saved_title = ZngetImageTitleFromUrl( $slide_image, true );

						if ( is_array( $slide_image ) )
						{
							// Get the saved image
							$saved_image = $slide_image['image'];

							if ( ! empty( $slide_image['alt'] ) ) {
								$saved_alt = $slide_image['alt'];
							}
							if ( ! empty( $slide_image['title'] ) ) {
								$saved_title = 'title="' . $slide_image['title'] . '"';
							}
						}
						else {
							$saved_image = $slide_image;
						}

						$element_size = zn_get_size( $simage['ib2_width'] );

						echo '<div class="'.$element_size['sizer'].'">';

							$ib2_link = zn_extract_link( $simage['ib2_link'], 'offer-banners-link hoverBorder', false, false, false, '#' );

							echo $ib2_link['start'];

							if($resize_method == 'default') {
								$image = vt_resize( '', $saved_image, $element_size['width'], '', true );
								echo '<img src="' . $image['url'] . '" height="' . $image['height'] . '" width="' . $image['width'] . '" alt="' . $saved_alt . '"  ' . $saved_title . ' class="img-responsive offer-banners-img" />';
							} else if($resize_method == 'cover') {
								$imgheight = isset($simage['ib2_image_height']) && !empty($simage['ib2_image_height']) ? $simage['ib2_image_height'] : 330;
								echo '<div class="offer-banners-img hoverborder-img" style="background-image:url('.$saved_image.'); height:'.$imgheight.'px;"></div>';
							} else if($resize_method == 'no-resize') {
								echo '<img src="' . $saved_image . '" '.ZngetImageSizesFromUrl($saved_image, true).' alt="' . $saved_alt . '"  ' . $saved_title . ' class="img-responsive offer-banners-img" />';
							}

							echo $ib2_link['end'];

						echo '</div>';
					}
				}
				echo '</div>';
			}
			echo "</div>";
		}

		/**
		 * This method is used to retrieve the configurable options of the element.
		 * @return array The list of options that compose the element and then passed as the argument for the render() function
		 */
		function options()
		{
			$extra_options = array (
				"name"           => __( "Images", 'zn_framework' ),
				"description"    => __( "Here you can add your images.", 'zn_framework' ),
				"id"             => "ib2_single",
				"std"            => "",
				"type"           => "group",
				"add_text"       => __( "Image", 'zn_framework' ),
				"remove_text"    => __( "Image", 'zn_framework' ),
				"group_sortable" => true,
				// "element_title" => "ib2_link",
			"element_img"  => 'ib2_image',
				"subelements"    => array (
					array (
						"name"        => __( "Image", 'zn_framework' ),
						"description" => __( "Please select an image.", 'zn_framework' ),
						"id"          => "ib2_image",
						"std"         => "",
						"type"        => "media",
						"alt"         => true
					),
					array (
						"name"        => __( "Image Link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
						"id"          => "ib2_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					array (
						"name"        => __( "Image Width", 'zn_framework' ),
						"description" => __( "Please select the desired width for this image.The number 3 means the image will take
			a quarter of the space and 12 means it will take the full width of the page. Depending on the image sizes,
			you can stack images one under the other.", 'zn_framework' ),
						"id"          => "ib2_width",
						"std"         => "one-third",
						"options"     => array (
							'four'  => __( '3', 'zn_framework' ),
							'one-third'  => __( '4', 'zn_framework' ),
							'span5'  => __( '5', 'zn_framework' ),
							'eight'  => __( '6', 'zn_framework' ),
							'span7'  => __( '7', 'zn_framework' ),
							'two-thirds'  => __( '8', 'zn_framework' ),
							'twelve'  => __( '9', 'zn_framework' ),
							'span10' => __( '10', 'zn_framework' ),
							'span11' => __( '11', 'zn_framework' ),
							'sixteen' => __( '12', 'zn_framework' )
						),
						"type"        => "select"
					),
					array (
						"name"        => __( "Image Height", 'zn_framework' ),
						"description" => __( "Please select an image height. This option works only with the COVER option of the resize method.", 'zn_framework' ),
						"id"          => "ib2_image_height",
						"std"         => "330",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '50',
							'max' => '500',
							'step' => '5'
						),
					),
				)
			);

			$uid = $this->data['uid'];

			$options = array(
				'has_tabs'  => true,
				'general' => array(
					'title' => 'General options',
					'options' => array(
						array (
							"name"        => __( "Image Box Title", 'zn_framework' ),
							"description" => __( "Enter a title for your Image box", 'zn_framework' ),
							"id"          => "image_box_title",
							"std"         => "",
							"type"        => "text",
						),
						array (
							"name"        => __( "Resize Method", 'zn_framework' ),
							"description" => __( "This option determines wether the images should be resized by a default 1170px grid column split; or, by a un resized but filled block with custom height.", 'zn_framework' ),
							"id"          => "ib2_resize_method",
							"std"         => "default",
							"options"     => array (
								'no-resize'  => __( 'No Resize', 'zn_framework' ),
								'default'  => __( 'Default resize (grid formula)', 'zn_framework' ),
								'cover'  => __( 'Cover ( No resize, cover image and custom image height).', 'zn_framework' ),
							),
							"type"        => "select"
						),
						array (
							"name"        => __( "Bottom Margins", 'zn_framework' ),
							"description" => __( "Please select an image height. This option works only with the COVER option of the resize method.", 'zn_framework' ),
							"id"          => "ib2_bottommargin",
							"std"         => "20",
							'type'        => 'slider',
							'class'       => 'zn_full',
							'helpers'     => array(
								'min' => '0',
								'max' => '100',
								'step' => '1'
							),
						),
						$extra_options,
					),
				),


				'help' => znpb_get_helptab( array(
					'video'   => 'http://support.hogash.com/kallyas-videos/#NduGrZO1S4E',
					'docs'    => 'http://support.hogash.com/documentation/image-box/',
					'copy'    => $uid,
					'general' => true,
				)),

			);
			return $options;
		}
	}
