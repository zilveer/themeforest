<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Statistics
 Description: Create and display a Statistics element
 Class: TH_Statistics
 Category: content
 Level: 3
 Keywords: icons, timeline, graph
*/
/**
 * Class TH_Statistics
 *
 * Create and display a Statistics element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 4.0.0
 */
class TH_Statistics extends ZnElements
{
	public static function getName(){
		return __( "Statistics", 'zn_framework' );
	}
	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		// Icon sizes
		$icon_size = $this->opt('th_stat_size','40');
		if( $icon_size != '40' ){
			$css .= ".{$uid} span.statistic-box__icon {font-size: {$icon_size}px }";
		}

		// Bar color
		$bar_color = $this->opt('th_stat_bar_color','#cd2122');
		if( $bar_color != '#cd2122' ){
			$css .= ".{$uid} .statistic-box__line{border-bottom-color: {$bar_color} }";
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

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'th_stat_theme_color', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'th_stat_theme_color', '' );
		$elm_classes[] = 'statistic-box--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$style = $this->opt('th_stat_style','style1');
		$elm_classes[] = 'statistic-box--stl-' . $style;

		$items = (isset($options['statistics_single']) && !empty($options['statistics_single']) ? $options['statistics_single'] : null);

		echo '<div class="statistic-box__container '.implode(' ', $elm_classes).'" '.$attributes.'>';

		if(! empty($items))
		{
			$count = count($items);

			foreach($items as $i => $item)
			{
				$title = (isset($item['th_stat_single_title']) ? $item['th_stat_single_title'] : '');
				$content = (isset($item['th_stat_single_desc']) ? $item['th_stat_single_desc'] : '');

				$iconHolder = $item['th_stat_single_icon'];

				$odd = false;
				$iconhtml = '';
				$icontype = isset($item['th_stat_icontype']) && !empty($item['th_stat_icontype']) ? $item['th_stat_icontype'] : 'icon';
				if($icontype == 'icon'){
					if( !empty( $iconHolder['family'] )){
						$iconhtml .= '
							<div class="statistic-box__icon-holder">
								<span class="statistic-box__icon" '.zn_generate_icon( $iconHolder ).'></span>
							</div>
						';
					}
				}
				else {
					if( isset( $item['th_stat_single_iconimg']) && !empty( $item['th_stat_single_iconimg'] )){
						$iconhtml .= '
							<div class="statistic-box__icon-holder statistic-box__icon-holder--img">
								<img class="statistic-box__icon statistic-box__iconimg" src="'.$item['th_stat_single_iconimg'].'" '.ZngetImageSizesFromUrl($item['th_stat_single_iconimg'], true).' alt="'. ZngetImageAltFromUrl( $item['th_stat_single_iconimg'] ) .'" title="'.ZngetImageTitleFromUrl( $item['th_stat_single_iconimg'] ).'"/>
							</div>
						';
					}

				}

				$detailshtml = '';
				if( !empty($title) && !empty($content) ) {
					$detailshtml .= '<div class="statistic-box__details">';
					if( !empty($title) )
						$detailshtml .= '<h4 class="statistic-box__title" '.WpkPageHelper::zn_schema_markup('title').'>'.$title.'</h4>';
					if( !empty($content) )
						$detailshtml .= '<div class="statistic-box__content">'.$content.'</div>';
					$detailshtml .= '</div>';
				}

				if($i>0 && $i%2 > 0) {
					$odd = true;
				}

				echo '<div class="statistic-box '.( $odd && $style == 'style1' ? 'statistic-box--odd':'' ).' ">';
					echo $iconhtml;
					echo '<div class="statistic-box__line"></div>';
					echo $detailshtml;
				echo '</div>';

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
			"name"           => __( "Statistics", 'zn_framework' ),
			"description"    => __( "Here you can create your desired statistics.", 'zn_framework' ),
			"id"             => "statistics_single",
			"std"            => "",
			"type"           => "group",
			"max_items"      => "5",
			"add_text"       => __( "Statistics", 'zn_framework' ),
			"remove_text"    => __( "Statistics", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "th_stat_single_title",
			"subelements"    => array (
				array (
					"name"        => __( "Title", 'zn_framework' ),
					"description" => __( "Please enter a title for this statistic.", 'zn_framework' ),
					"id"          => "th_stat_single_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Content", 'zn_framework' ),
					"description" => __( "Please enter a content for this statistic.", 'zn_framework' ),
					"id"          => "th_stat_single_desc",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Icon type", 'zn_framework' ),
					"description" => __( "Please select the icon type.", 'zn_framework' ),
					"id"          => "th_stat_icontype",
					"std"         => "icon",
					"type"        => "select",
					"options"     => array (
						'icon'        => __( 'Icon Font', 'zn_framework' ),
						'img'        => __( 'Image (Png, SVG)', 'zn_framework' ),
					),
				),

				array (
					"name"        => __( "Icon", 'zn_framework' ),
					"description" => __( "Select your desired icon.", 'zn_framework' ),
					"id"          => "th_stat_single_icon",
					"std"         => "",
					"type"        => "icon_list",
					'class'       => 'zn_full',
					"dependency"  => array( 'element' => 'th_stat_icontype' , 'value'=> array('icon') )
				),

				array (
					"name"        => __( "Browse for Image Icon", 'zn_framework' ),
					"description" => __( "Select your desired Image icon.", 'zn_framework' ),
					"id"          => "th_stat_single_iconimg",
					"std"         => "",
					"type"        => "media",
					"dependency"  => array( 'element' => 'th_stat_icontype' , 'value'=> array('img') )
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
						"name"        => __( "Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "th_stat_style",
						"std"         => "style1",
						"type"        => "select",
						"options"     => array (
							'style1'        => __( 'Odd / Even placement', 'zn_framework' ),
							'style2'        => __( 'Normal placement', 'zn_framework' ),
							// 'style3'        => __( 'Vertical placement', 'zn_framework' ),
						),
					),

					// array (
					//     "name"        => __( "Text theme color", 'zn_framework' ),
					//     "description" => __( "Please select the color theme.", 'zn_framework' ),
					//     "id"          => "th_stat_theme_color",
					//     "std"         => "light",
					//     "type"        => "select",
					//     "options"     => array (
					//         'light'        => __( 'Light', 'zn_framework' ),
					//         'dark'        => __( 'Dark', 'zn_framework' ),
					//     ),
					// ),

					array(
						'id'          => 'th_stat_theme_color',
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
									'val_prepend'  => 'statistic-box--',
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
						"name"        => __( "Bar Color", 'zn_framework' ),
						"description" => __( "Color of the separator bar.", 'zn_framework' ),
						"id"          => "th_stat_bar_color",
						"std"         => "#cd2122",
						"type"        => "colorpicker",
						'live' => array(
						   'type'        => 'css',
						   'css_class' => '.'.$this->data['uid'].' .statistic-box__line',
						   'css_rule'    => 'border-bottom-color',
						   'unit'        => ''
						),
					),

					array (
						"name"        => __( "Icons Size", 'zn_framework' ),
						"description" => __( "Select the size of the icon.", 'zn_framework' ),
						"id"          => "th_stat_size",
						"std"         => "40",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '10',
							'max' => '200',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'] .' span.statistic-box__icon',
							'css_rule'  => 'font-size',
							'unit'      => 'px'
						),
					),

					$extra_options,
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#RMu6crTnf4U',
				'docs'    => 'http://support.hogash.com/documentation/statistics/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
