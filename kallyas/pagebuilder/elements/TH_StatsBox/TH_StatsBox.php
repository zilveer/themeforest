<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Stats Box
 Description: Create and display a Stats Box element
 Class: TH_StatsBox
 Category: content
 Level: 3
 Keywords: icon, facts
*/
/**
 * Class TH_StatsBox
 *
 * Create and display a Stats Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StatsBox extends ZnElements
{
	public static function getName(){
		return __( "Stats Box", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options ) ) { return; }

		$iconHolder = $this->opt('vts_tab_icon');
		$tabIcon = !empty( $iconHolder['family'] )  ? '<span class="kl-icon-dark statsboxes-elm-titleicon" '.zn_generate_icon( $this->opt('vts_tab_icon') ).'></span>' : '';
		//$tabIcon = (isset($options['vts_tab_icon']) && !empty($options['vts_tab_icon']) ? $options['vts_tab_icon'] : '');
		$tabTitle = (isset($options['stb_title']) && !empty($options['stb_title']) ? $options['stb_title'] : '');

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'stsbx--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		echo '<div class="zn_stats_box statsboxes '.implode(' ', $elm_classes).'" '.$attributes.'>';

		if(!empty($tabTitle)){
			echo '<h3 class="mb_title statsboxes-elm-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $tabIcon . $tabTitle . '</h3>';
		}

		if ( ! empty ( $options['single_stats'] ) && is_array( $options['single_stats'] ) ) {
			echo '<div class="row u-mb-0 statsboxes-row">';
			foreach ( $options['single_stats'] as $stat ) {
				echo '<div class="col-sm-6 col-md-3">';

				echo '<div class="statbox statsboxes-item clearfix">';

					$sb_type = isset($stat['sb_type']) && !empty($stat['sb_type']) ? $stat['sb_type'] : 'img';

					if ( ! empty ( $stat['sb_icon'] ) && $sb_type == 'img' ) {
						echo '<img class="statsboxes-img" src="' . $stat['sb_icon'] . '" '.ZngetImageSizesFromUrl($stat['sb_icon'], true).' alt="'. ZngetImageAltFromUrl( $stat['sb_icon'] ) .'" title="'.ZngetImageTitleFromUrl( $stat['sb_icon'] ).'" />';
					}

					// Fonticon
					if ( isset($stat['sb_iconfont']) && !empty ( $stat['sb_iconfont'] ) && $sb_type == 'icon' ) {
						$iconsize = isset($stat['sb_size']) && $stat['sb_size'] != 22 ? 'font-size:'.$stat['sb_size'].'px;' : '';
						$sb_iconcolor = isset($stat['sb_iconcolor']) && $stat['sb_iconcolor'] != '#8f8f8f' ? 'color:'.$stat['sb_size'].';' : '';
						echo '<span ' . zn_generate_icon($stat['sb_iconfont']) . ' style="'.$iconsize . $sb_iconcolor.'" class="statbox__fonticon statsboxes-icon"></span>';
					}

					echo '<h4 class="statsboxes-title text-custom" '.WpkPageHelper::zn_schema_markup('title').'>' . $stat['sb_title'] . '</h4>';
					echo '<h6 class="statsboxes-content">' . $stat['sb_content'] . '</h6>';

				echo '</div>';

				echo '</div>';
			}
			echo '</div>';
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
			"name"           => __( "Stats Boxes", 'zn_framework' ),
			"description"    => __( "Here you can add your desired stats boxes.", 'zn_framework' ),
			"id"             => "single_stats",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Stat Box", 'zn_framework' ),
			"remove_text"    => __( "Stat Box", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "sb_title",
			"subelements"    => array (
				array (
					"name"        => __( "Title", 'zn_framework' ),
					"description" => __( "Please enter the desired title that will
											appear on the right of the icon.", 'zn_framework' ),
					"id"          => "sb_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Content", 'zn_framework' ),
					"description" => __( "Please enter the desired title that will appear bellow the icon/Title.", 'zn_framework' ),
					"id"          => "sb_content",
					"std"         => "",
					"type"        => "text"
				),

				array (
					"name"        => __( "Icon Type", 'zn_framework' ),
					"description" => __( "Type of the icon.", 'zn_framework' ),
					"id"          => "sb_type",
					"std"         => "img",
					"type"        => "select",
					"options"     => array (
						'icon' => __( 'Font Icon', 'zn_framework' ),
						'img' => __( 'Image (PNG, JPG, SVG or even GIF)', 'zn_framework' )
					),
				),

				array (
					"name"        => __( "Icon", 'zn_framework' ),
					"description" => __( "Please select an icon that will appear on the
											left side of the title.", 'zn_framework' ),
					"id"          => "sb_icon",
					"std"         => "",
					"type"        => "media",
					"dependency"  => array( 'element' => 'sb_type' , 'value'=> array('img') ),
				),

				array (
					"name"        => __( "Icon Size", 'zn_framework' ),
					"description" => __( "Select the size of the icon.", 'zn_framework' ),
					"id"          => "sb_size",
					"std"         => "22",
					'type'        => 'slider',
					'class'       => 'zn_full',
					'helpers'     => array(
						'min' => '16',
						'max' => '70',
						'step' => '1'
					),
					"dependency"  => array( 'element' => 'sb_type' , 'value'=> array('icon') ),
				),

				array (
					"name"        => __( "Icon Color", 'zn_framework' ),
					"description" => __( "Select the color of the icon.", 'zn_framework' ),
					"id"          => "sb_iconcolor",
					"std"         => "#8f8f8f",
					'type'        => 'colorpicker',
					"dependency"  => array( 'element' => 'sb_type' , 'value'=> array('icon') ),
				),

				array (
					"name"        => __( "Select Icon", 'zn_framework' ),
					"description" => __( "Select an icon to display.", 'zn_framework' ),
					"id"          => "sb_iconfont",
					"std"         => "",
					"type"        => "icon_list",
					'class'       => 'zn_full',
					"dependency"  => array( 'element' => 'sb_type' , 'value'=> array('icon') ),
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
						"description" => __( "Please enter the title for this box", 'zn_framework' ),
						"id"          => "stb_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Tab icon", 'zn_framework' ),
						"description" => __( "Select your desired icon that will appear on the left side of the title.", 'zn_framework' ),
						"id"          => "vts_tab_icon",
						"std"         => "",
						"type"        => "icon_list",
						'class'       => 'zn_full',
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
									'val_prepend'  => 'stsbx--',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#1I5uTW7B5_o',
				'docs'    => 'http://support.hogash.com/documentation/stats-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
