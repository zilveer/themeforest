<?php if(! defined('ABSPATH')){ return; }
/*
Name: CSS3 Panels
Description: Create and display a CSS3 Panels element
Class: TH_CSS3Panels
Category: headers, Fullwidth
Level: 1
*/

/**
 * Class TH_CSS3Panels
 *
 * Create and display a CSS3 Panels element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_CSS3Panels extends ZnElements
{
	public static function getName(){
		return __( "CSS3 Panels", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$uid = $this->data['uid'];
		$css = $min_1200 = '';

		$height = $this->opt( 'css_height' );
		if(!empty($height)){
			$css .= zn_smart_slider_css( $height, '.'.$uid.' .css3panels-container' );
			$height_to_use = isset($height['lg']) ? $height['lg'] : $height;
			$unit_to_use = isset($height['unit_lg']) ? $height['unit_lg'] : 'px';
			$min_1200 .= '.'.$uid.' .css3panels-container.css3panel--hasSkew, .'.$uid.' .css3panel--hasSkew .css3panel-mainimage-wrapper{margin-left:-'.($height_to_use/10).$unit_to_use.'; margin-right:-'.($height_to_use/10).$unit_to_use.'}';
			$min_1200 .= '.'.$uid.' .css3panel--hasSkew .css3panel:not(:first-child) .css3panel-caption.text-left{padding-left:'.($height_to_use/10).$unit_to_use.'}';
			$min_1200 .= '.'.$uid.' .css3panel--hasSkew .css3panel:not(:last-child) .css3panel-caption.text-right{padding-right:'.($height_to_use/10).$unit_to_use.'}';
		}

		$single = $this->opt('single_css_panel');
		if ( isset ( $single ) && !empty( $single ) ) {
			foreach ( $single as $i => $panel ) {
				$title_styles = '';
				if( isset($panel['title_typo']) && !empty($panel['title_typo']) ){
					foreach ($panel['title_typo'] as $key => $value) {
						if($value != '') {
							if( $key == 'font-family' ){
								$title_styles .= $key .':'. zn_convert_font($value).';';
							}
							else {
								$title_styles .= $key .':'. $value.';';
							}
						}
					}
					if(!empty($title_styles)){
						$min_1200 .= '.'.$uid.' .css3panel--'.$i.' .css3panel-title{'.$title_styles.'}';
					}
				}
			}
		}

		if(!empty($min_1200)){
			$css .= '@media (min-width: 1200px){' . $min_1200 . '}';
		}

		// panel resize timing

		if($this->opt('panel_resize',1) == 1){
			$speed = $this->opt('panel_resize_speed','0.5');
			if($speed != '0.5'){
				$css .= '.'.$uid.' .css3panels--resize .css3panel{-webkit-transition-duration:'.$speed.'s; transition-duration:'.$speed.'s;}';
			}
			$distance = $this->opt('panel_resize_distance','1.3');
			if($distance != '1.3'){
				$css .= '.'.$uid.' .css3panels--resize .css3panel:hover{-webkit-box-flex:'.$distance.';-webkit-flex:'.$distance.';-ms-flex:'.$distance.';flex: '.$distance.'}';
			}

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

		if( empty( $options ) ) { return; }

		$all = 0;
		$single = $this->opt('single_css_panel');
		if( is_array($single) ){
			$all = count( $single );
		}

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($this->data['options']);

		?>
		<div class="kl-slideshow kl-slideshow-css3panels <?php echo implode(' ', $elm_classes); ?>">

			<div class="clearfix"></div>
			<div class="fake-loading loading-1s"></div>

			<?php
				$container_classes = array();
				$container_classes[] = $this->opt('panel_resize',1) == 1 ? 'css3panels--resize' : '';
				$container_classes[] = isset($options['panel_caption_effect']) ? 'cssp-capt-animated cssp-capt-'.$options['panel_caption_effect'] : '';
				$container_classes[] = $this->opt('has_skew', 1) == 1 ? 'css3panel--hasSkew':'';

				$has_border = $this->opt('has_border', 1);
				if($has_border == 1 || $has_border == 2 ){
					$container_classes[] = 'css3panel--hasBorder '.($has_border == 2 ? 'is-dark' : '');
				}
			?>

			<div class="css3panels-container <?php echo implode(' ', $container_classes);?>" data-panels="<?php echo $all; ?>">
				<?php
				if ( isset ( $single ) && !empty( $single ) ) {

					foreach ( $single as $i => $panel ) {

						echo '<div class="css3panel css3panel--' . $i . '">';

							echo '<div class="css3panel-inner">';
								echo '<div class="css3panel-mainimage-wrapper">';

								if ( isset ( $panel['panel_image'] ) && ! empty ( $panel['panel_image'] ) ) {
									$panel_img = $panel['panel_image'];

									$alt = ZngetImageAltFromUrl($panel_img, true);
									$title = ZngetImageTitleFromUrl($panel_img, true);

									// img stretch
									$img_stretch = $this->opt('image_stretch',1) == 1 ? 'css3panel-mainimage--stretch':'css3panel-mainimage--noStretch';

									echo '<div class="css3panel-mainimage '.$img_stretch.'">';

									echo '<img src="'.$panel_img.'" '.ZngetImageSizesFromUrl($panel_img, true).' class="css3panel-mainimage-img cover-fit-img" '.$alt.' '.$title.'>';

									if( isset($options['panel_effect']) && !empty($options['panel_effect']) ){
										echo '<img src="'.$panel_img.'" class="css3panel-mainimage-img cover-fit-img css3panel-mainimage-effect '. $options['panel_effect'] .'" '.$alt.' '.$title.'>';
									}

									// Check for overlay (and backwards compatible one)
									$has_overlay = '';
									if( isset($panel['panel__overlay']) && $panel['panel__overlay'] == '1' ){
										$has_overlay = zn_hex2rgba_str( $panel['panel__overlay_color'], $panel['panel__overlay_opacity'] );
									}
									elseif (isset($panel['overlay_color']) && !empty($panel['overlay_color'])){
										$has_overlay = $panel['overlay_color'];
									}
									if( !empty($has_overlay) ){
										echo '<div class="css3p-overlay css3p--overlay-color" style="background: '.$has_overlay.'"></div>';
									}
									else {
										echo '<div class="css3p-overlay css3p-overlay--gradient"></div>';
									}
									echo '</div>';
								}

								echo '</div>';
							echo '</div>';

						// Panel Position
						$panel_position = '';

						if ( isset ( $panel['panel_title_position'] ) && ! empty ( $panel['panel_title_position'] ) ) {
							$panel_position = 'css3caption--middle';
						}

						$panel_position .= ' text-'. (isset ( $panel['te_alignment'] ) && ! empty ( $panel['te_alignment'] ) ? $panel['te_alignment'] : 'right');

						// Panel Content
						if (
							( isset ($panel['panel_title']) && ! empty ($panel['panel_title']) ) ||
							( isset ($panel['panel_text']) && ! empty ($panel['panel_text']) )
						) {
							echo '<div class="css3panel-caption ' . $panel_position . ' ">';

							// Panel title
							if ( isset ($panel['panel_title']) && ! empty ($panel['panel_title']) ) {

								$title_link = zn_extract_link( $panel['title_link'] );

								echo $title_link['start'];

									echo '<h3 class="css3panel-title ff-alternative '.(isset($panel['panel_title_style']) ? $panel['panel_title_style'] : '').' '.(isset($panel['panel_title_size']) ? 'title-size-'.$panel['panel_title_size'] : '' ).'" '.WpkPageHelper::zn_schema_markup('title').'>'.$panel['panel_title'].'</h3>';

								echo $title_link['end'];
							}

							// Panel text
							if ( isset ($panel['panel_text']) && ! empty ($panel['panel_text']) ) {
								echo '<div class="css3panel-text">'.$panel['panel_text'].'</div>';
							}

							echo '<div class="css3panel-btn-area">';

								// Panel Primary Button
								if(isset($panel['title_link']['title']) && !empty($panel['title_link']['title'])){
									$prim_link = zn_extract_link( $panel['title_link'], 'btn btn-fullcolor btn-skewed' );
									echo $prim_link['start'] . $panel['title_link']['title'] . $prim_link['end'];
								}

								// Panel Secondary Button
								if(isset($panel['sec_link']['title']) && !empty($panel['sec_link']['title'])){
									$sec_link = zn_extract_link( $panel['sec_link'], 'btn btn-lined btn-skewed' );
									echo $sec_link['start'] . $panel['sec_link']['title'] . $sec_link['end'];
								}

							echo '</div><!-- /.btn-area -->';

							echo '</div><!-- /.css3panel-caption -->';
						}

						echo '</div>';

					}
				}
				?>
			</div>
			<!-- end panels -->
			<div class="clearfix"></div>

			<div class="kl-mask kl-bottommask kl-mask--shadow_ud"></div>

		</div><!-- end kl-slideshow -->
	<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$data_options = isset($this->data['options']) ? $this->data['options'] : array();

		$single_std = array();
		if(isset( $this->data['options']['single_css_panel'] ) && !empty($this->data['options']['single_css_panel'])){
			$single_std = $this->data['options']['single_css_panel'];
			foreach ( $this->data['options']['single_css_panel'] as $key => &$value ) {
				// Overlay
				if( isset($value['panel__overlay']) && $value['panel__overlay'] == '1' ){
					$value['overlay_color'] = zn_hex2rgba_str( $value['panel__overlay_color'], $value['panel__overlay_opacity'] );
				}
				// Title settings (If bigger)
				if( isset($value['panel_title_size']) && $value['panel_title_size'] == 'bigger' ){
					$color = isset($value['panel_text_theme']) && $value['panel_text_theme'] == 'dark' ? '#252525' : '';
					$value['title_typo'] = array(
						'font-size' => '70px',
						'line-height' => '80px',
						'letter-spacing' => '-2px',
						'text-shadow' => '1px 1px 50px rgba(0,0,0,.4)',
						'color' => $color,
					);
				}
			}
		}

		$extra_options = array (
			"name"           => __( "CSS Panels", 'zn_framework' ),
			"description"    => __( "Here you can create your CSS3 Panels.", 'zn_framework' ),
			"id"             => "single_css_panel",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Panel", 'zn_framework' ),
			"remove_text"    => __( "Panel", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "panel_title",
			"subelements"    => array (
				'has_tabs'  => true,
				'general' => array(
					'title' => 'General options',
					'options' => array(
						array (
							"name"        => __( "Panel image", 'zn_framework' ),
							"description" => __( "Select an image for this Panel. Recommended size 1000px x 700px", 'zn_framework' ),
							"id"          => "panel_image",
							"std"         => "",
							"type"        => "media"
						),

						array(
							'id'          => 'overlay_color',
							'name'        => 'Overlay Background color',
							'description' => 'Choose a custom color for the overlay on the image.',
							'type'        => 'colorpicker',
							'alpha'        => true,
							'std'         => '',
						),

						array (
							"name"        => __( "Panel title", 'zn_framework' ),
							"description" => __( "Here you can enter a title that will appear on this panel.", 'zn_framework' ),
							"id"          => "panel_title",
							"std"         => "",
							"type"        => "text"
						),
						array (
							"name"        => __( "Panel Text", 'zn_framework' ),
							"description" => __( "Here you can enter some that will appear on this panel, under the title.", 'zn_framework' ),
							"id"          => "panel_text",
							"std"         => "",
							"type"        => "textarea"
						),
						array (
							"name"        => __( "Primary Button", 'zn_framework' ),
							"description" => __( "Set the url & text of the button. Use title field as text inside the button.", 'zn_framework' ),
							"id"          => "title_link",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
						),
						array (
							"name"        => __( "Secondary Button", 'zn_framework' ),
							"description" => __( "Set the url & text of the button. Use title field as text inside the button.", 'zn_framework' ),
							"id"          => "sec_link",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
						),
					),
				),
				'style' => array(
					'title' => 'Styling options',
					'options' => array(

						array (
							"name"        => __( "Title typography", 'zn_framework' ),
							"description" => __( "Specify the typography properties for the title.", 'zn_framework' ),
							"id"          => "title_typo",
							"std"         => '',
							'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight', 'spacing', 'case', 'shadow' ),
							"type"        => "font",
						),

						array (
							"name"        => __( "Content Position", 'zn_framework' ),
							"description" => __( "Here you can choose where the panel content will be shown", 'zn_framework' ),
							"id"          => "panel_title_position",
							"std"         => "",
							"type"        => "select",
							"options"     => array (
								''      => __( "Normal (Bottom)", 'zn_framework' ),
								'upper' => __( "Upper (Middle)", 'zn_framework' )
							)
						),

						array (
							"name"        => __( "Text Alignment", 'zn_framework' ),
							"description" => __( "Select the alignment of the text.", 'zn_framework' ),
							"id"          => "te_alignment",
							"std"         => "right",
							"type"        => "select",
							"type"        => "zn_radio",
							"options"     => array(
								"left" => '<span class="dashicons dashicons-editor-alignleft"></span>',
								"center" => '<span class="dashicons dashicons-editor-aligncenter"></span>',
								"right" => '<span class="dashicons dashicons-editor-alignright"></span>',
							),
						),

						array (
							"name"        => __( "Title style", 'zn_framework' ),
							"description" => __( "Select title style", 'zn_framework' ),
							"id"          => "panel_title_style",
							"std"         => "",
							"type"        => "select",
							"options"     => array (
								''                  => __( "No Background", 'zn_framework' ),
								'captiontitle--wbg' => __( "White Background", 'zn_framework' ),
								'captiontitle--dbg' => __( "Dark background", 'zn_framework' )
							)
						),

					),
				),
			)
		);

		$options = array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array(
						'id'          => 'css_height',
						'name'        => __( 'Height', 'zn_framework'),
						'description' => __( 'Choose the desired height for this element. You can choose either height as a property. Height will force a fixed size rather than just a minimum. <br>*TIP: Use 100vh to have a full-height element.', 'zn_framework' ),
						'type'        => 'smart_slider',
						'std'        => '600',
						'helpers'     => array(
							'min' => '0',
							'max' => '1400'
						),
						'supports' => array('breakpoints'),
						'units' => array('px', 'vh'),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid. ' .css3panels-container',
							'css_rule'  => 'height',
							'unit'      => 'px'
						),
					),

					array (
						"name"        => __( "Panel Resize on hover", 'zn_framework' ),
						"description" => __( "Resize the panel on hover?", 'zn_framework' ),
						"id"          => "panel_resize",
						"std"         => "1",
						"type"        => "zn_radio",
						"options"     => array (
							'1' => __( "Yes", 'zn_framework' ),
							'0' => __( "No", 'zn_framework' )
						),
					    "class"        => "zn_radio--yesno",
					),
					array (
						"name"        => __( "Resize speed", 'zn_framework' ),
						"description" => __( "Select the resize speed", 'zn_framework' ),
						"id"          => "panel_resize_speed",
						"std"         => "0.5",
						"type"        => "select",
						"options"     => array (
							'0.2' => __( "Fast", 'zn_framework' ),
							'0.5' => __( "Normal", 'zn_framework' ),
							'1' => __( "Slow", 'zn_framework' )
						),
						"dependency"  => array( 'element' => 'panel_resize' , 'value'=> array('1') ),
					),
					array (
						"name"        => __( "Resize distance", 'zn_framework' ),
						"description" => __( "Select the resize distance. Make sure the images allow such resize.", 'zn_framework' ),
						"id"          => "panel_resize_distance",
						"std"         => "1.3",
						"type"        => "select",
						"options"     => array (
							'1.1' => __( "Short (1.1x)", 'zn_framework' ),
							'1.3' => __( "Normal (1.3x)", 'zn_framework' ),
							'1.5' => __( "Large (1.5x)", 'zn_framework' ),
							'2' => __( "Double (2x)", 'zn_framework' ),
						),
						"dependency"  => array( 'element' => 'panel_resize' , 'value'=> array('1') ),
					),

				),
			),

			'styles' => array(
				'title' => 'Styles',
				'options' => array(


					array (
						"name"        => __( "Image CSS3 Filter", 'zn_framework' ),
						"description" => __( "Select an effect for normal and hover states.", 'zn_framework' ),
						"id"          => "panel_effect",
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							''                              => __( "None", 'zn_framework' ),
							'anim--grayscale'               => __( "Grayscale Filter", 'zn_framework' ),
							'anim--blur'                    => __( "Blur filter", 'zn_framework' ),
							'anim--grayscale anim--blur'    => __( "Grayscale & Blur filter", 'zn_framework' ),
						)
					),

					array (
						"name"        => __( "Image Stretch", 'zn_framework' ),
						"description" => __( "Should the images strect to the full width of their respective container? This usually is ok for images with different ratios. So basically if you're going to properly resize your images, you should not enable this option. So make sure your images are wide enough to be properly displayed on hover when the panel is resizing.", 'zn_framework' ),
						"id"          => "image_stretch",
						"std"         => "1",
						"type"        => "zn_radio",
						"options"     => array (
							'1' => __( "Yes", 'zn_framework' ),
							'0' => __( "No", 'zn_framework' )
						),
					    "class"        => "zn_radio--yesno",
					),

					array (
						"name"        => __( "Skew Images (Angled effect)", 'zn_framework' ),
						"description" => __( "Do you want to enable the skewed angle effect of the panels?.", 'zn_framework' ),
						"id"          => "has_skew",
						"std"         => "1",
						"type"        => "zn_radio",
						"options"     => array (
							'1' => __( "Yes", 'zn_framework' ),
							'0' => __( "No", 'zn_framework' )
						),
					    "class"        => "zn_radio--yesno",
					),

					array (
						"name"        => __( "Caption Effect", 'zn_framework' ),
						"description" => __( "Specify the caption effect.", 'zn_framework' ),
						"id"          => "panel_caption_effect",
						"std"         => "default",
						"type"        => "select",
						"options"     => array (
							'default'  => __( "No effect, captions always visible", 'zn_framework' ),
							'fadein' => __( "Hidden captions, fade in on hover", 'zn_framework' ),
							'fadeout' => __( "Visible captions, fade out (hide) on hover", 'zn_framework' ),
							'slidein' => __( "Hidden captions, slide in on hover", 'zn_framework' ),
							'slideout' => __( "Visible captions, slide out on hover", 'zn_framework' )
						)
					),

					array (
						"name"        => __( "Items Separator", 'zn_framework' ),
						"description" => __( "Enable if you want the panels to be separated with a white stroke of 3-4px.", 'zn_framework' ),
						"id"          => "has_border",
						"std"         => "1",
						"type"        => "select",
						"options"     => array (
							'1' => __( "Yes", 'zn_framework' ),
							'2' => __( "Yes - Dark Line", 'zn_framework' ),
							'0' => __( "No", 'zn_framework' )
						),
					),

				),
			),

			'panels' => array(
				'title' => 'CSS panels',
				'options' => array(
					$extra_options,
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#t702hKJbbns',
				'docs'    => 'http://support.hogash.com/documentation/css3-panels/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
