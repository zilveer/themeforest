<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Partners Logos
 Description: Create and display a Partners Logos element
 Class: TH_PartnersLogos
 Category: content
 Level: 3
 Scripts: true
 Keywords: carousel, thumbs
*/
/**
 * Class TH_PartnersLogos
 *
 * Create and display a Partners Logos element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_PartnersLogos extends ZnElements
{
	public static function getName(){
		return __( "Partners Logos", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$autoscroll = $this->opt( 'autoscroll', 'no' ) == 'yes';

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'prtc--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		if( empty( $options['pl_title'] ) && empty( $options['partners_single'] ) ) { return; }

		?>
			<div class="partners_carousel clearfix <?php echo implode(' ', $elm_classes); ?>" <?php echo $attributes; ?>>
				<div class="row">
					<div class="col-sm-2">
						<?php
						if ( ! empty ( $options['pl_title'] ) && $options['pl_title_style'] == 'style1' ) {
							echo '<h5 class="title partners_carousel-title element-scheme__hdg1"><span>' . $options['pl_title'] . '</span></h5>';
						}
						elseif ( ! empty ( $options['pl_title'] ) && $options['pl_title_style'] == 'style2' ) {
							echo '<h4 class="m_title text-custom partners_carousel-title element-scheme__hdg1" '.WpkPageHelper::zn_schema_markup('title').'><span>' . $options['pl_title'] . '</span></h4>';
						}
						?>
						<div class="controls partners_carousel-controls">
							<a href="#" class="prev partners_carousel-arr"><span class="glyphicon glyphicon-chevron-left"></span></a>
							<a href="#" class="next partners_carousel-arr"><span class="glyphicon glyphicon-chevron-right"></span></a>
						</div>
					</div>
					<div class="col-sm-10">
						<ul class="partners_carousel partners_carousel-list fixclear partners_carousel_trigger" data-autoplay="<?php echo $autoscroll ? 'true' : 'false'; ?>" data-timeout="<?php echo $this->opt('slider_timeout', 9000) ?>" >
							<?php
							if ( ! empty ( $options['partners_single'] ) && is_array( $options['partners_single'] ) ) {
								foreach ( $options['partners_single'] as $partner ) {

									if ( $slide_image = $partner['lp_single_logo'] ) {

										$lp_link = zn_extract_link( $partner['lp_link'], 'partners_carousel-link u-trans-all-2s', false, false, false, '#');

										$saved_alt   = ZngetImageAltFromUrl( $slide_image );
										$saved_title = ZngetImageTitleFromUrl( $slide_image, true );

										if ( is_array( $slide_image ) ) {
											if ( $saved_image = $slide_image['image'] ) {
												// Image alt
												if ( ! empty( $slide_image['alt'] ) ) {
													$saved_alt = $slide_image['alt'];
												}

												// Image title
												if ( ! empty( $slide_image['title'] ) ) {
													$saved_title = 'title="' . $slide_image['title'] . '"';
												}
											}
										} else {
											$saved_image = $slide_image;
										}

										echo '<li class="partners_carousel-item">';
										echo $lp_link['start'];
										echo '<img class="partners_carousel-img" src="' . $saved_image . '" '.ZngetImageSizesFromUrl($saved_image, true).' alt="' . $saved_alt . '" ' . $saved_title . '/>';
										echo $lp_link['end'];
										echo '</li>';

									}
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Logos", 'zn_framework' ),
			"description"    => __( "Here you can add your partners logos.", 'zn_framework' ),
			"id"             => "partners_single",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Logo", 'zn_framework' ),
			"remove_text"    => __( "Logo", 'zn_framework' ),
			"group_sortable" => true,
			// "element_title"  => array('img' => 'lp_single_logo'),
			"element_img"  => 'lp_single_logo',
			"subelements"    => array (
				array (
					"name"        => __( "Logo", 'zn_framework' ),
					"description" => __( "Please enter the logo for this partner. Recommended size 135px x 30px", 'zn_framework' ),
					"id"          => "lp_single_logo",
					"std"         => "",
					"type"        => "media",
					"alt"         => true
				),
				array (
					"name"        => __( "Logo Link", 'zn_framework' ),
					"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
					"id"          => "lp_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
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
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter the title for this element.", 'zn_framework' ),
						"id"          => "pl_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Title Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use for this title.", 'zn_framework' ),
						"id"          => "pl_title_style",
						"std"         => "style1",
						"options"     => array (
							"style1" => __( "Style 1", 'zn_framework' ),
							"style2" => __( "Style 2", 'zn_framework' )
						),
						"type"        => "select"
					),
					array(
						'id'            => 'autoscroll',
						"name"        => __( "Enable autoscroll ?", 'zn_framework' ),
						"description" => __( "Choose if you want to autoscroll the logos or not.", 'zn_framework' ),
						'type'          => 'toggle2',
						'std'           => 'no',
						'value'         => 'yes'
					),
					array (
						"name"        => __( "Timeout duration", 'zn_framework' ),
						"description" => __( "The amount of milliseconds the carousel will pause. 1 second = 1000 milliseconds", 'zn_framework' ),
						"id"          => "slider_timeout",
						"std"         => "9000",
						"type"        => "text",
                        'dependency' => array( 'element' => 'autoscroll' , 'value'=> array('yes') )
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
									'val_prepend'  => 'prtc--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
					$extra_options,
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#FI_0ex4KB84',
				'docs'    => 'http://support.hogash.com/documentation/partners-logos/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
