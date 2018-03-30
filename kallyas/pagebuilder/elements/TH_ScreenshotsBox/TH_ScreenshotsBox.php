<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Screenshots Box
 Description: Create and display a Screenshots Box element
 Class: TH_ScreenshotsBox
 Category: content, media
 Level: 3
 Scripts: true
 Keywords: carousel, photo, image
*/

/**
 * Class TH_ScreenshotsBox
 *
 * Create and display a Screenshots Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ScreenshotsBox extends ZnElements
{
	public static function getName(){
		return __( "Screenshots Box", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'screenshot-box--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$elm_classes[] = $sbStyle = (isset($options['sb_style']) && !empty($options['sb_style']) ? esc_attr($options['sb_style']) : 'kl-style-1');

		if( empty( $options['ssb_imag_single'] ) ) { return; }

		$dataAttribute = '';
		$paginationID = uniqid('th-');
		if('kl-style-2' == $sbStyle){
			$dataAttribute = 'data-carousel-pagination=".'.$paginationID.'"';
		}

		?>

			<div class="screenshot-box <?php echo implode(' ', $elm_classes); ?> clearfix" <?php echo $attributes; ?>>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="left-side">
							<h3 class="title screenshot-box__title text-custom" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><?php echo $options['ssb_title'];?></h3>
							<?php
								if ( ! empty ( $options['ssb_feat_single'] ) && is_array( $options['ssb_feat_single'] ) ) {
									echo '<ul class="features">';
									foreach ( $options['ssb_feat_single'] as $feat ) {
										echo '<li>';
										// FEATURE TITLE
										if ( ! empty ( $feat['ssb_single_title'] ) ) {
											echo '<h4 class="screenshot-box__feature-title element-scheme__hdg1" '.WpkPageHelper::zn_schema_markup('subtitle').'>' . $feat['ssb_single_title'] . '</h4>';
										}
										// FEATURE DESC
										if ( ! empty ( $feat['ssb_single_desc'] ) ) {
											echo '<span class="screenshot-box__feature-desc">' . $feat['ssb_single_desc'] . '</span>';
										}
										echo '</li>';
									}
									echo '</ul>';
								}

								// BUTTON LINK
								$ssb_button_link = zn_extract_link( $options['ssb_button_link'], 'btn btn-fullcolor btn-third' );
								if ( ! empty ( $options['ssb_link_text'] ) ) {
									echo $ssb_button_link['start'] . $options['ssb_link_text'] . $ssb_button_link['end'];
								}
							?>
						</div>
					</div>

					<div class="col-sm-12 col-md-6">
						<div class="thescreenshot">
							<div class="controls"><a href="#" class="prev"></a><a href="#" class="next"></a></div>
							<ul class=" zn_screenshot-carousel" <?php echo $dataAttribute;?>>
								<?php
									if ( ! empty ( $options['ssb_imag_single'] ) && is_array( $options['ssb_imag_single'] ) ) {
										foreach ( $options['ssb_imag_single'] as $image ) {
											if(isset($image['ssb_single_screenshoot']) && !empty($image['ssb_single_screenshoot'])){
												$image_res = vt_resize( '', $image['ssb_single_screenshoot'], '580', '380', true );
												echo '<li><img src="' . $image_res['url'] . '" width="' . $image_res['width'] . '" height="' . $image_res['height'] . '" alt="'. ZngetImageAltFromUrl( $image['ssb_single_screenshoot'] ) .'" title="'.ZngetImageTitleFromUrl( $image['ssb_single_screenshoot'] ).'"></li>';
											}
										}

									}
								?>
							</ul>
							<?php if(! empty($dataAttribute)) { ?>
							<div class="<?php echo $paginationID;?>"></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!-- end screenshot-box -->

		<?php

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array();

// FEATURES SINGLE
		$extra_options['ssb_feat_single'] = array (
			"name"           => __( "Features", 'zn_framework' ),
			"description"    => __( "Here you can add your desired features.", 'zn_framework' ),
			"id"             => "ssb_feat_single",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Feature", 'zn_framework' ),
			"remove_text"    => __( "Feature", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "ssb_single_title",
			"subelements"    => array (
				array (
					"name"        => __( "Title", 'zn_framework' ),
					"description" => __( "Please enter the desired title for this
											feature.", 'zn_framework' ),
					"id"          => "ssb_single_title",
					"std"         => "",
					"type"        => "textarea"
				),
				array (
					"name"        => __( "Description", 'zn_framework' ),
					"description" => __( "Please enter the desired description for this
											feature.", 'zn_framework' ),
					"id"          => "ssb_single_desc",
					"std"         => "",
					"type"        => "textarea"
				)
			)
		);

// IMAGES SINGLE
		$extra_options['ssb_imag_single'] = array (
			"name"           => __( "Images", 'zn_framework' ),
			"description"    => __( "Here you can add your screenshots images.", 'zn_framework' ),
			"id"             => "ssb_imag_single",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Image", 'zn_framework' ),
			"remove_text"    => __( "Image", 'zn_framework' ),
			"group_sortable" => true,
			// "element_title" => "ssb_single_screenshoot",
			"subelements"    => array (
				array (
					"name"        => __( "Image", 'zn_framework' ),
					"description" => __( "Please choose your desired screenshot. Recommended size 555px x 364px", 'zn_framework' ),
					"id"          => "ssb_single_screenshoot",
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
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter title for this box.", 'zn_framework' ),
						"id"          => "ssb_title",
						"std"         => "",
						"type"        => "textarea",
					),
					array (
						"name"        => __( "Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "sb_style",
						"std"         => "kl-style-1",
						"type"        => "select",
						"options"     => array (
							'kl-style-1'     => __( 'Style 1', 'zn_framework' ),
							'kl-style-2'    => __( 'Style 2 (since v4.0)', 'zn_framework' )
						),
					),
					array (
						"name"        => __( "Link Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear as a button
											link.", 'zn_framework' ),
						"id"          => "ssb_link_text",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Button Link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
						"id"          => "ssb_button_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
						// "class"        => "zn_link_field",
					),
					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'screenshot-box--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
					$extra_options['ssb_feat_single'],
					$extra_options['ssb_imag_single'],
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#MjnESQZG6pY',
				'docs'    => 'http://support.hogash.com/documentation/screenshots-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
