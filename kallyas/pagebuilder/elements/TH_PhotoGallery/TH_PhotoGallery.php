<?php if (!defined('ABSPATH')) { return; }
/*
 Name: Photo Gallery / Slider
 Description: Create and display a Photo Gallery element
 Class: TH_PhotoGallery
 Category: content, media
 Keywords: slideshow, album, folder
 Level: 3
*/
/**
 * Class TH_PhotoGallery
 *
 * Create and display a Photo Gallery element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PhotoGallery extends ZnElements
{
	public static function getName(){
		return __( "Photo Gallery", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js',  array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	function css(){
		$uid = $this->data['uid'];
		$css = '';

		if($this->opt('pg_sld_car_height','auto') == 'fixed' && $this->opt('pg_layout','def') == 'sld'){
			$css .= '@media (min-width:992px){.'.$uid.' .elm-phg-slideshow li{height:'.$this->opt('pg_sld_height', '600').'px}}';
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$layout = $this->opt('pg_layout','def');

		?>
			<div class="photo-gallery zn_image_gallery elm-phg elm-phg--<?php echo $layout; ?> <?php echo $this->data['uid']; ?> <?php echo zn_get_element_classes($options); ?>" <?php echo zn_get_element_attributes($options); ?>>

				<?php

				$single = $this->opt('single_photo_gallery', array());

				if (!empty($single) && is_array($single)) {

					/**
					 * Default Layout
					 * @var def
					 */
					if($layout == 'def'){

						$num_cols = $this->opt('pg_num_cols', '6');
						$height = $this->opt('pg_img_height','');

						$new_size = 12 / $num_cols;
						$size = zn_get_size('span' . $new_size, false, 10);

						echo '<div class="row mfp-gallery mfp-gallery--misc">';

						foreach ($single as $image) {

							echo '<div class="col-xs-6 col-sm-4 col-lg-' . $new_size . ' u-mb-20">';
							echo $this->do_item($layout, $image, $size['width'], $height);
							echo '</div>';

						}
						echo '</div>';

					}
					/**
					 * Folder Layout
					 * @var fld
					 */
					elseif($layout == 'fld'){

						echo '<div class="elm-phg-gallery mfp-gallery mfp-gallery--misc">';

							echo $this->do_item('def', $single[0]);

							foreach ($single as $k => $image) {
								if($k != 0){
									echo $this->do_item($layout, $image);
								}
							}

						echo '</div>';
					}
					/**
					 * Slideshow Layout
					 * @var sld
					 */
					elseif($layout == 'sld'){

						$pager = array();

						$size = zn_get_size('span12', false, 10);
						$width = $size['width'];

						$cheight_type = $this->opt('pg_sld_car_height','auto');

						$sld_height = '';
						$img_class = '';
						if($cheight_type == 'fixed'){
							$sld_height = $this->opt('pg_sld_height', '600');
							$img_class = 'cover-fit-img';
						}

						$autoplay = $this->opt('sld_autoplay', 'yes') == 'yes' ? 'data-autoplay="auto"' : '';

						$nav = $this->opt('sld_nav', 'thumbs');

						echo '<ul class="elm-phg-slideshow mfp-gallery mfp-gallery--misc cheight-'.$cheight_type.' cfs--default" data-timeoutduration="'.$this->opt('sld_timeout', 6000).'" '.$autoplay.'>';

						foreach ($single as $k => $image) {
							$item = $this->do_item($layout, $image, '', '', true, $img_class);
							$pg_item = $this->do_item($layout, $image, 80, 80, false);
							if(!empty($item)){
								echo '<li data-eq="'.$k.'" class="cfs--item">'.$item.'</li>';
							}
							if(!empty($pg_item) && ($nav == 'thumbs' || $nav == 'both')){
								$pager[] = '<li data-eq="'.$k.'">'.$pg_item.'</li>';
							}
						}

						echo '</ul>';

						if(($nav == 'thumbs' || $nav == 'both')){
							echo '<div class="elm-phg-slideshow-pager-wrapper">';
								echo '<ul class="elm-phg-slideshow-pager">';
								echo implode('', $pager);
								echo '</ul>';
							echo '</div>';
						}

						if(($nav == 'arrows' || $nav == 'both')){
							echo '
							<div class="elm-phg-slideshow-arrows">
								<a href="#" class="elm-phg-slideshow-prev"><span class="glyphicon glyphicon-menu-left"></span></a>
								<a href="#" class="elm-phg-slideshow-next"><span class="glyphicon glyphicon-menu-right"></span></a>
							</div>';
						}

						echo '<div class="fake-loading loading-10s"></div>';

					}

				}
				?>
			</div>
	<?php
	}

	function do_item( $layout = 'def', $image = array(), $width = '', $height = '', $linked = true, $class = '' ){

		if(empty($image)) return;

		$item = '';
		$the_image = $image['spg_image'];
		$the_video = $image['spg_video'];

		$alt = '';
		$title = '';

		if(!empty($the_image)){
			$alt = ZngetImageAltFromUrl( $the_image );
			$title = ZngetImageTitleFromUrl( $the_image );
		}

		$target = isset($image['spg_url_target']) && !empty($image['spg_url_target']) ? $image['spg_url_target'] : 'modal_iframe';

		$url_target = '';
		if($target == '_blank' || $target == '_self'){
			$url_target = 'target="' . $target  . '"';
		}
		elseif($target == 'modal_image' || $target == 'modal'){
			$url_target = 'data-lightbox="mfp" data-mfp="image"';
		}
		elseif($target == 'modal_iframe'){
			$url_target = 'data-lightbox="mfp" data-mfp="iframe"';
		}

		$is_hidden = $layout == 'fld' ? 'hidden':'';
		$is_hov_bord = $layout != 'sld' ? 'hoverBorder':'';

		// If Image linking to a Custom URL
		if(!empty($the_image) && !empty($the_video)){

			if($linked){
				$item .= '<a href="' . $the_video . '" title="' . $image['spg_title'] . '" class="'.$is_hov_bord.' '.$is_hidden.'" '.$url_target.'>';
			}

			if($layout != 'fld'){
				if(!empty($width) || !empty($height)){
					$image_resized = vt_resize('', $the_image, $width, $height, true);
					$item .= '<img src="' . $image_resized['url'] . '" width="' . $image_resized['width'] . '" height="' . $image_resized['height'] . '" alt="'.$alt.'" title="'.$title.'">';
				} else {
					$item .= '<img src="' . $the_image . '" '.ZngetImageSizesFromUrl($the_image, true).' alt="'.$alt.'" title="'.$title.'">';
				}
			}

			if($linked){
				$item .= '</a>';
			}
		}
		elseif( !empty($the_image)){

			if($linked){
				$item .= '<a data-lightbox="mfp" data-mfp="image" href="' . $the_image . '" title="' . $image['spg_title'] . '" class="elm-phg-link '.$is_hov_bord.' '.$is_hidden.'">';
			}

			if($layout != 'fld'){

				if(!empty($width) || !empty($height)){
					$image_resized = vt_resize('', $the_image, $width, $height, true);
					$item .= '<img src="' . $image_resized['url'] . '" width="' . $image_resized['width'] . '" height="' . $image_resized['height'] . '" alt="'.$alt.'" title="'.$title.'" class="elm-phg-image '.$class.'">';
				} else {
					$item .= '<img src="' . $the_image . '" '.ZngetImageSizesFromUrl($the_image, true).' alt="'.$alt.'" title="'.$title.'"  class="elm-phg-image '.$class.'">';
				}
			}
			if($linked){
				$item .= '</a>';
			}
		}
		elseif( !empty($the_video ) && $layout != 'sld' ){
			$item .= '<a class="playVideo '.$is_hidden.'" '.$url_target.' href="' . $the_video . '"></a>';
		}

		return $item;

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{

		$extra_options = array(
			"name" => __("Images", 'zn_framework'),
			"description" => __("Here you can add your desired images.", 'zn_framework'),
			"id" => "single_photo_gallery",
			"std" => "",
			"type" => "group",
			"add_text" => __("Image", 'zn_framework'),
			"remove_text" => __("Image", 'zn_framework'),
			"group_title" => "",
			"group_sortable" => true,
			"element_title" => "spg_title",
			"element_img"  => 'spg_image',
			"subelements" => array(
				array(
					"name" => __("Title", 'zn_framework'),
					"description" => __("Please enter a title for this image.", 'zn_framework'),
					"id" => "spg_title",
					"std" => "",
					"type" => "text"
				),
				array(
					"name" => __("Image", 'zn_framework'),
					"description" => __("Please select an image.", 'zn_framework'),
					"id" => "spg_image",
					"std" => "",
					"type" => "media"
				),
				array(
					"name" => __("Custom URL", 'zn_framework'),
					"description" => __("Please enter a custom URL in case you want to link differently.", 'zn_framework'),
					"id" => "spg_video",
					"std" => "",
					"type" => "text"
				),

				array(
					"name" => __("URL Target", 'zn_framework'),
					"description" => __("Select the target of the custom URL.", 'zn_framework'),
					"id" => "spg_url_target",
					"std" => 'modal_iframe',
					"type"     => "select",
					"options"     => zn_get_link_targets( array('modal_inline', 'modal_inline_dyn', 'smoothscroll') ),
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
						"name"        => __( "Gallery layout", 'zn_framework' ),
						"description" => __( "Choose the gallery's layout.", 'zn_framework' ),
						"id"          => "pg_layout",
						"std"         => "def",
						"type"        => "radio_image",
						"class"			=> "ri-hover-line ri-3",
						"options"     => array(
							array(
								'value' => 'def',
								'name'  => __( 'Normal gallery', 'zn_framework' ),
								'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_PhotoGallery/images/normal-gallery.svg',
								'desc'  => __( "It'll display images on columns as a normal gallery.", 'zn_framework' ),
							),
							array(
								'value' => 'sld',
								'name'  => __( 'Slideshow gallery with thumbnails', 'zn_framework' ),
								'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_PhotoGallery/images/slideshow-gallery.svg',
								'desc'  => __( "It'll display a big slideshow with thumbnails navigation at the bottom.", 'zn_framework' ),
							),
							array(
								'value' => 'fld',
								'name'  => __( 'Album Gallery', 'zn_framework' ),
								'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_PhotoGallery/images/album-gallery.svg',
								'desc'  => __( "This will only display the first image but upon clicking it will open a lightbox modal gallery.", 'zn_framework' ),
							),
						),
					),

					array(
						"name" => __("Number of columns", 'zn_framework'),
						"description" => __("Select the desired number of columns for the images.", 'zn_framework'),
						"id" => "pg_num_cols",
						"std" => "6",
						"type" => "select",
						"options" => array(
							'1' => __('1', 'zn_framework'),
							'2' => __('2', 'zn_framework'),
							'3' => __('3', 'zn_framework'),
							'4' => __('4', 'zn_framework'),
							'6' => __('6', 'zn_framework')
						),
						'dependency'  => array ( 'element' => 'pg_layout', 'value' => array ( 'def' ) ),
					),
					array(
						"name" => __("Images Height (px)", 'zn_framework'),
						"description" => __("Select the desired image height in pixels.", 'zn_framework'),
						"id" => "pg_img_height",
						"std" => "",
						"type" => "text",
						'dependency'  => array ( 'element' => 'pg_layout', 'value' => array ( 'def' ) ),
					),
					array(
						"name" => __("Carousel Height", 'zn_framework'),
						"description" => __("Select the type of height for the carousel.", 'zn_framework'),
						"id" => "pg_sld_car_height",
						'type'        => 'select',
						'std'		  => 'auto',
						"options" => array(
							'auto' => __('Auto-height (rely on image height)', 'zn_framework'),
							'fixed' => __('Fixed Custom height', 'zn_framework'),
						),
						'dependency'  => array ( 'element' => 'pg_layout', 'value' => array ( 'sld' ) ),
					),

					array(
						"name" => __("Slideshow Height", 'zn_framework'),
						"description" => __("Select the desired image height in percent unit.", 'zn_framework'),
						"id" => "pg_sld_height",
						'type'        => 'slider',
						'std'		  => '600',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '150',
							'max' => '1000',
							'step' => '1'
						),
						'dependency'  => array(
							array ( 'element' => 'pg_layout', 'value' => array ( 'sld' ) ),
							array ( 'element' => 'pg_sld_car_height', 'value' => array ( 'fixed' ) ),
						),
				  //   	'live' => array(
						//    'type'        => 'css',
						//    'css_class' => '.'.$uid.' .elm-phg-slideshow li',
						//    'css_rule'    => 'height',
						//    'unit'        => 'px'
						// ),
					),
					array(
						"name" => __("Autoplay slideshow?", 'zn_framework'),
						"description" => __("Select if you want to autoplay the slideshow.", 'zn_framework'),
						"id" => "sld_autoplay",
						"std" => "yes",
						"type" => "toggle2",
						'value' => 'yes',
						'dependency'  => array ( 'element' => 'pg_layout', 'value' => array ( 'sld' ) ),
					),
					array(
						"name" => __("Slideshow interval", 'zn_framework'),
						"description" => __("Select the interval between slide changes in milliseconds.", 'zn_framework'),
						"id" => "sld_timeout",
						"std" => "6000",
						"type" => "text",
						'dependency'  => array(
							array ( 'element' => 'pg_layout', 'value' => array ( 'sld' ) ),
							array ( 'element' => 'sld_autoplay', 'value' => array ( 'yes' ) ),
						),
					),
					array(
						"name" => __("Navigation type", 'zn_framework'),
						"description" => __("Select the navigation type you want for the slideshow.", 'zn_framework'),
						"id" => "sld_nav",
						"std" => "thumbs",
						"type" => "select",
						"options" => array(
							'thumbs' => __('Thumbnails', 'zn_framework'),
							'arrows' => __('Arrows', 'zn_framework'),
							'both' => __('Thumbnails and Arrows', 'zn_framework'),
						),
						'dependency'  => array ( 'element' => 'pg_layout', 'value' => array ( 'sld' ) ),
					),

					$extra_options,
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#o4Ei4xDN71E',
				'docs'    => 'http://support.hogash.com/documentation/photo-gallery/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
