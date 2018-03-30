<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Call Out Banner
 Description: Create and display a Call Out Banner element
 Class: TH_CallOutBanner
 Category: content
 Level: 3
*/
/**
 * Class TH_CallOutBanner
 *
 * Create and display a Call Out Banner element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_CallOutBanner extends ZnElements
{
	public static function getName(){
		return __( "Call Out Banner", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options ) ) { return; }

		$button   = false;
		$div_size = 'col-sm-12';

		if ( ! empty ( $options['cab_button_text'] ) ) {
			$button   = true;
			$div_size = 'col-sm-10';
		}

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'calloutbanner--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		echo '<div class="callout-banner clearfix '.implode(' ', $elm_classes).'" '.$attributes.'>';
			echo '<div class="row">';

			if ( ! empty ( $options['cab_main_title'] ) || ! empty ( $options['cab_sec_title'] ) ) {

				echo '<div class="' . $div_size . '">';

				if ( ! empty ( $options['cab_main_title'] ) ) {

					echo '<h3 class="m_title m_title_ext text-custom callout-banner-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['cab_main_title'] . '</h3>';
				}

				if ( ! empty ( $options['cab_sec_title'] ) ) {
					echo '<p>' . $options['cab_sec_title'] . '</p>';
				}

				echo '</div>';
			}

			if ( $button ) {

				$cab_button_link = zn_extract_link( $this->opt( 'cab_button_link', '' ), 'circlehover with-symbol kl-main-bgcolor kl-main-bgcolor-before '. $this->opt( 'calloutbox_style', 'style1' ), 'data-size="" data-position="top-left" data-align="right"' );

				echo '<div class="col-sm-2">';

					echo $cab_button_link['start'];

						echo '<span class="text circlehover-text u-trans-all-2s">' . $options['cab_button_text'] . '</span>';

						$alt__cab_button_image = '';
						if ( ! empty ( $options['cab_button_image'] ) ) {
							echo '<span class="symbol circlehover-symbol u-trans-all-2s"><img class="circlehover-symbol-img" '.ZngetImageSizesFromUrl($options['cab_button_image'], true).' src="' . $options['cab_button_image'] . '" alt="'. ZngetImageAltFromUrl( $options['cab_button_image'] ) .'" title="'. ZngetImageTitleFromUrl( $options['cab_button_image'] ) .'"></span>';
						}
						else {
							echo '<span class="symbol u-trans-all-2s"><img class="circlehover-symbol-img" src="' . THEME_BASE_URI . '/images/ok.png" width="75" height="62" alt="'. __('OK!','zn_framework') .'"></span>';
						}
						echo '<div class="triangle circlehover-symbol-trg"><span class="play-icon"></span></div>';

					echo $cab_button_link['end'];

				echo '</div>';
			}
			echo '</div>';
		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "calloutbox_style",
						"std"         => "style1",
						"options"     => array (
							'style1'     => __( 'Style 1', 'zn_framework' ),
							'style2'    => __( 'Style 2 (since v4.0)', 'zn_framework' ),
							'style3'    => __( 'Style 3 (since v4.0)', 'zn_framework' )
						),
						"type"        => "select",
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$this->data['uid'] .' .circlehover'
						),
					),
					array (
						"name"        => __( "Main Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Call Out Banner element", 'zn_framework' ),
						"id"          => "cab_main_title",
						"std"         => "",
						"type"        => "textarea",
					),
					array (
						"name"        => __( "Secondary Title", 'zn_framework' ),
						"description" => __( "Enter a secondary title for your Call Out Banner element", 'zn_framework' ),
						"id"          => "cab_sec_title",
						"std"         => "",
						"type"        => "textarea",
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
									'val_prepend'  => 'calloutbanner--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
				),
			),
			'button' => array(
				'title' => 'Button options',
				'options' => array(
					array (
						"name"        => __( "Button Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear on the right button.", 'zn_framework' ),
						"id"          => "cab_button_text",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Button Hover Image", 'zn_framework' ),
						"description" => __( "Please select an image that will appear when
											hovering the mouse over the button. If no image is chosen , the default OK image will be used", 'zn_framework' ),
						"id"          => "cab_button_image",
						"std"         => "",
						"type"        => "media",
					),
					array (
						"name"        => __( "Button link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use for your button.", 'zn_framework' ),
						"id"          => "cab_button_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#q-5UZku-5Jk',
				'docs'    => 'http://support.hogash.com/documentation/call-out-banner/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;
	}
}
