<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Image Gallery
 Description: Create and display an Image Gallery element
 Class: TH_ImageGallery
 Category: content, media
 Level: 3
*/
/**
 * Class TH_ImageGallery
 *
 * Create and display an Image Gallery element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_ImageGallery extends ZnElements
{
	public static function getName(){
		return __( "Image Gallery", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];
		$element_size = zn_get_size( 'one-third' );

		echo '<div class="th-image-gallery '.$this->data['uid'].' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';

		if ( ! empty ( $options['ig_title'] ) ) {
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
				echo '<h4 class="th-image-gallery-title text-custom"><span class="th-image-gallery-title-sp" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['ig_title'] . '</span></h4>';
				echo '</div>';
			echo '</div>';
		}

		if ( ! empty ( $options['single_ig'] ) && is_array( $options['single_ig'] ) )
		{
			$count = count( $options['single_ig'] );
			$i     = 1;
			foreach ( $options['single_ig'] as $image_arr )
			{
				if ( $i % 3 == 1 ) {
					echo '<div class="row">';
				}
				if ( ! empty ( $image_arr['sig_image'] ) ) {
					$image = vt_resize( '', $image_arr['sig_image'], $element_size['width'], '', true );

					echo '<div class="col-sm-4">';
					echo '<a href="' . $image_arr['sig_image'] . '" class="hoverBorder" data-lightbox="image"><img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="'. ZngetImageAltFromUrl( $image_arr['sig_image'] ) .'" title="'.ZngetImageTitleFromUrl( $image_arr['sig_image'] ).'" /></a>';
					echo '</div>';
				}

				if ( $i % 3 == 0 || $i == $count ) {
					echo '</div>';
				}
				$i ++;
			}
		}
		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Images", 'zn_framework' ),
			"description"    => __( "Here you can add your desired images.", 'zn_framework' ),
			"id"             => "single_ig",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Image", 'zn_framework' ),
			"remove_text"    => __( "Image", 'zn_framework' ),
			"group_title"    => "",
			"group_sortable" => true,
			"element_img"  => 'sig_image',
			"subelements"    => array (
				array (
					"name"        => __( "Image", 'zn_framework' ),
					"description" => __( "Please select an image.", 'zn_framework' ),
					"id"          => "sig_image",
					"std"         => "",
					"type"        => "media"
				)
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						"name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
						"description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use a one of these elements: <strong>Photo Gallery</strong> Element or <strong>Grid Photo Gallery</strong> Element. They have more options.', 'zn_framework' ),
						'type'  => 'zn_message',
						'id'    => 'zn_error_notice',
						'show_blank'  => 'true',
						'supports'  => 'warning'
					),
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter a title for this gallery.", 'zn_framework' ),
						"id"          => "ig_title",
						"std"         => "",
						"type"        => "text",
					),
					$extra_options,
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#eloxER8HFvs',
				'docs'    => 'http://support.hogash.com/documentation/image-gallery/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
