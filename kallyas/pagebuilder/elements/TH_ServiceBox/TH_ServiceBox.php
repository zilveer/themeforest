<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Service Box
 Description: Create and display a Service Box element
 Class: TH_ServiceBox
 Category: content
 Level: 3
 Keywords: list, icon
*/
/**
 * Class TH_ServiceBox
 *
 * Create and display a Service Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ServiceBox extends ZnElements
{
	public static function getName(){
		return __( "Service Box", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		// Icon sizes
		$icon_size = $this->opt('sbx_size','22');
		if( $icon_size != '22' ){
			$css .= ".{$uid} .services_box__fonticon{font-size: {$icon_size}px}";
		}

		$sbx_style = $this->opt('sbx_style','classic');
		$sbx_color = $this->opt('sbx_color', '#cd2122');

		if( $sbx_style == 'modern' && $sbx_color != '#cd2122' ){
			$css .= '.'.$uid.'.services_box--modern .services_box__icon {box-shadow: inset 0 0 0 2px '.$sbx_color.';}';
			$css .= '.'.$uid.'.services_box--modern:hover .services_box__icon {box-shadow:inset 0 0 0 40px '.$sbx_color.';}';
			$css .= '.'.$uid.'.services_box--modern .services_box__fonticon {color:'.$sbx_color.';}';
			$css .= '.'.$uid.'.services_box--modern:hover .services_box__fonticon {color:#fff;}';
			$css .= '.'.$uid.'.services_box--modern .services_box__list li:before {box-shadow: 0 0 0 2px '.$sbx_color.';}';
			$css .= '.'.$uid.'.services_box--modern .services_box__list li:hover:before {box-shadow: 0 0 0 3px '.$sbx_color.';}';
		}

		if( $sbx_style == 'classic' && $sbx_color != '#cd2122' ){
			$css .= '.'.$uid.'.services_box--classic .text-custom {color:'.$sbx_color.';}';
			$css .= '.'.$uid.'.services_box--classic:hover .services_box__icon {background: '.$sbx_color.';}';
		}

		if( $sbx_style == 'boxed' && $sbx_color != '#cd2122' ){
			$css .= '.'.$uid.'.services_box--boxed .text-custom {color:'.$sbx_color.';}';
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

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'servicebox-sch--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$sb_style = $this->opt('sbx_style','classic');
		$elm_classes[] = 'services_box--'.$sb_style;

		$sbx_type = $this->opt('sbx_type','img');
		$image = $this->opt('service_box_image');
		$icon = $this->opt('sbx_icon');
		$has_icon = '';
		if ( ! empty ( $image ) || ! empty ( $icon ) ) {
			$elm_classes[] = 'sb--hasicon';
		}

		?>
		<div class="services_box <?php echo implode(' ', $elm_classes); ?>" <?php echo $attributes; ?>>
			<div class="services_box__inner clearfix">
				<?php
				// Image
				if ( ! empty ( $image ) && $sbx_type == 'img' ) {

					$hover_image = $this->opt('service_box_image_hover');

					echo '<div class="services_box__icon '.(! empty ( $hover_image ) ? 'sb--hashover':'').'">';
						echo '<div class="services_box__icon-inner">';

							echo '<img src="' . $image . '" '.ZngetImageSizesFromUrl($image, true).' alt="'. ZngetImageAltFromUrl( $image ) .'" title="'.ZngetImageTitleFromUrl( $image ).'" class="services_box__iconimg services_box__iconimg-main">';

							if ( ! empty ( $hover_image ) ) {
								echo '<img src="' . $hover_image . '" '.ZngetImageSizesFromUrl($hover_image, true).' alt="'. ZngetImageAltFromUrl( $hover_image ) .'" title="'.ZngetImageTitleFromUrl( $hover_image ).'" class="services_box__iconimg services_box__iconimg-hover ">';
							}

						echo '</div>';
					echo '</div>';
				}

				// Fonticon

				if ( ! empty ( $icon ) && $sbx_type == 'icon' ) {

					echo '<div class="services_box__icon">';
						echo '<div class="services_box__icon-inner">';
							$custom__icon_style = $sb_style == 'modern' || $sb_style == 'boxed' ? 'text-custom' : '';
							echo '<span ' . zn_generate_icon($icon) . ' class="services_box__fonticon '.$custom__icon_style.'"></span>';

						echo '</div>';
					echo '</div>';
				}

				echo '<div class="services_box__content">';

					// Title
					$title = $this->opt('service_box_title');
					if ( ! empty ( $title ) ) {
						$custom__title_classes = ( $sb_style == 'classic' ? 'text-custom' : 'element-scheme__hdg1' );
						echo '<h4 class="services_box__title '.$custom__title_classes.' " '.WpkPageHelper::zn_schema_markup('title').'>' . $title . '</h4>';
					}

					// Desc
					$desc = $this->opt('service_box_desc');
					if ( ! empty ( $desc ) ) {
						echo '<div class="services_box__desc"><p>'.$desc.'</p></div>';
					}

					echo '<div class="services_box__list-wrapper">';
						echo '<span class="services_box__list-bg"></span>';
						// FEATURES LIST
						$features = $this->opt('service_box_features');
						if ( ! empty ($features ) ) {
							echo '<ul class="services_box__list">';

							$textAr = explode( "\n",$features );
							foreach ( $textAr as $index => $line ) {
								$custom__listitem_style = $sb_style == 'boxed' ? 'text-custom' : '';
								echo '<li class="'.$custom__listitem_style.'">';
								if($sb_style == 'classic') echo '<span class="glyphicon glyphicon-play"></span>';
								echo '<span class="services_box__list-text">'.$line.'</span>';
								echo '</li>';
							}

							echo '</ul>';
						}
					echo '</div>';
				echo '</div>'
				?>
			</div>
			<!-- end box -->
		</div>
	<?php
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
						"name"        => __( "Service Box Style", 'zn_framework' ),
						"description" => __( "Select the style of this services box.", 'zn_framework' ),
						"id"          => "sbx_style",
						"std"         => "classic",
						"type"        => "select",
						"options"     => array (
							'classic' => __( 'Classic', 'zn_framework' ),
							'modern' => __( 'Modern (since v4.0+)', 'zn_framework' ),
							'boxed' => __( 'Boxed (since v4.0+)', 'zn_framework' )
						),
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
									'val_prepend'  => 'servicebox-sch--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),

					array (
						"name"        => __( "Service Box Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Service box", 'zn_framework' ),
						"id"          => "service_box_title",
						"std"         => "",
						"type"        => "text",
					),

					array (
						"name"        => __( "Service Box Text Description", 'zn_framework' ),
						"description" => __( "Enter a text for your Service box", 'zn_framework' ),
						"id"          => "service_box_desc",
						"std"         => "",
						"type"        => "textarea",
					),

					array (
						"name"        => __( "Service Box Features", 'zn_framework' ),
						"description" => __( "Please enter your features one on a line.This will
											 create your features list with an arrow on the right.", 'zn_framework' ),
						"id"          => "service_box_features",
						"std"         => "",
						"type"        => "textarea",
					),

					array (
						"name"        => __( "Icon Type", 'zn_framework' ),
						"description" => __( "Type of the icon.", 'zn_framework' ),
						"id"          => "sbx_type",
						"std"         => "img",
						"type"        => "select",
						"options"     => array (
							'icon' => __( 'Font Icon', 'zn_framework' ),
							'img' => __( 'Image (PNG, JPG, SVG or even GIF)', 'zn_framework' )
						),
					),

					array (
						"name"        => __( "Image Icon", 'zn_framework' ),
						"description" => __( "Upload an Icon Image.", 'zn_framework' ),
						"id"          => "service_box_image",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('img') ),
					),

					array (
						"name"        => __( "Image Hover Icon", 'zn_framework' ),
						"description" => __( "Upload an Icon Image for the hover transition.", 'zn_framework' ),
						"id"          => "service_box_image_hover",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('img') ),
					),

					array (
						"name"        => __( "Icon Size", 'zn_framework' ),
						"description" => __( "Select the size of the icon.", 'zn_framework' ),
						"id"          => "sbx_size",
						"std"         => "22",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '16',
							'max' => '50',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'] .' .services_box__fonticon',
							'css_rule'  => 'font-size',
							'unit'      => 'px'
						),
						"dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('icon') ),
					),

					array(
						"id"          => "sbx_color",
						"name"        => "Icon color",
						"description" => "Please choose the icon or circle color.",
						"std"         => zget_option( 'zn_main_color', 'color_options', false, '#cd2122' ),
						"type"        => "colorpicker",
						"alpha"        => "true",
						"dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('icon') ),
					),

					array (
						"name"        => __( "Select Icon", 'zn_framework' ),
						"description" => __( "Select an icon to display.", 'zn_framework' ),
						"id"          => "sbx_icon",
						"std"         => "",
						"type"        => "icon_list",
						'class'       => 'zn_full',
						"dependency"  => array( 'element' => 'sbx_type' , 'value'=> array('icon') ),
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#uCRbnvo68_A',
				'docs'    => 'http://support.hogash.com/documentation/service-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
