<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Vertical Tabs
 Description: Create and display a Vertical Tabs element
 Class: TH_VerticalTabs
 Category: content
 Level: 3
 Multiple: true
 Keywords: side, menu
*/

/**
 * Class TH_VerticalTabs
 *
 * Create and display a Vertical Tabs element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_VerticalTabs extends ZnElements
{
	public static function getName(){
		return __( "Vertical Tabs", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$elm_classes=array();
		$elm_classes[] = $uid = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'verttabs--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$elm_classes[] = $vt_style = $this->opt('vtabs_style', 'kl-style-2');
		$elm_classes[] = 'vr-tabs-'.$vt_style;

		$single_tabs = $this->opt('single_vertical_tab', array() );
		$tabsListCount = count($single_tabs);

		if( empty ( $single_tabs ) ){
			return;
		}

		// Begin render
		echo '<div class="vertical_tabs vr-tabs '.implode(' ', $elm_classes).' clearfix" '.$attributes.'>';
			echo '<div class="tabbable vr-tabs-tbb">';

				echo '<ul class=" vr-tabs-nav fixclear">';

				$content = '';

				for ($i = 0; $i < $tabsListCount; $i++ ){
					$cls  = '';
					$icon = '';

					if ( $i == 0 ) {
						$cls = 'active';
					}

					$uniq_name = $uid.'_'.$i;

					// ICON CHECK
					if ( ! empty ( $single_tabs[$i]['vts_tab_icon'] ) ) {
						$iconHolder = $single_tabs[$i]['vts_tab_icon'];
						$icon = !empty( $iconHolder['family'] )  ? '<span class="vr-tabs-nav-icon " '.zn_generate_icon( $single_tabs[$i]['vts_tab_icon'] ).'></span>' : '';
					}

					// Tab Handle
					echo '<li class="vr-tabs-nav-item '.( $vt_style == 'kl-style-1' ? 'text-custom-parent-act':'' ).' ' . $cls . '">';
						echo '<a class="vr-tabs-nav-link text-custom-active text-custom-hover " href="#tabs_v2-pane' . $uniq_name . '" data-toggle="tab">';
						echo $icon;
						echo $single_tabs[$i]['vts_tab_title'];
					echo '</a>';

					echo '</li>';

				}

				echo '</ul>';

				echo '<div class="tab-content vr-tabs-content">';

					// foreach ( $single_tabs as $tab )
					for ($i = 0; $i < $tabsListCount; $i++ )
					{
						$cls = $content = '';
						$uniq_name = $uid.'_'.$i;
						if ( $i === 0 ) {
							$cls = 'active';
						}

						// Convert the old content to PB elements
						if( empty( $this->data['content'][$i] ) && ( ! empty( $single_tabs[$i]['vts_tab_c_title'] ) || ! empty( $single_tabs[$i]['vts_tab_c_content'] ) ) ){
							$textbox = ZNPB()->add_module_to_layout( 'TH_TextBox', array( 'stb_title' => $single_tabs[$i]['vts_tab_c_title'], 'stb_content' => $single_tabs[$i]['vts_tab_c_content'], 'stb_title_heading' => 'h4' ) );
							$column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array( $textbox ), 'col-sm-12' );
							$this->data['content'][$i] = array ( $column );
						}

						echo '<div class="tab-pane vr-tabs-tabpane fade in ' . $cls . ' row zn_columns_container zn_content" data-droplevel="1" id="tabs_v2-pane' . $uniq_name . '">';

							if ( empty( $this->data['content'][$i] ) ) {
								$column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
								$this->data['content'][$i] = array ( $column );
							}

							if ( !empty( $this->data['content'][$i] ) ) {
								ZNPB()->zn_render_content( $this->data['content'][$i] );
							}

						echo '</div>';

					}

				echo '</div>';


			echo '</div>';
		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Tabs", 'zn_framework' ),
			"description"    => __( "Here you can add your desired tabs.", 'zn_framework' ),
			"id"             => "single_vertical_tab",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Tab", 'zn_framework' ),
			"remove_text"    => __( "Tab", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "vts_tab_title",
			"subelements"    => array (
				array (
					"name"        => __( "Tab Title", 'zn_framework' ),
					"description" => __( "Please enter the desired title that will appear as tab.", 'zn_framework' ),
					"id"          => "vts_tab_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Tab icon", 'zn_framework' ),
					"description" => __( "Select your desired icon that will appear on the left side of the tab title.", 'zn_framework' ),
					"id"          => "vts_tab_icon",
					"std"         => "",
					"type"        => "icon_list",
					'class'       => 'zn_full',
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
						"name"        => __( "Select style", 'zn_framework' ),
						"description" => __( "Select the desired style for this element", 'zn_framework' ),
						"id"          => "vtabs_style",
						"type"        => "select",
						"std"         => "kl-style-2",
						"options"     => array (
							'kl-style-1' => __( 'Style 1', 'zn_framework' ),
							'kl-style-2' => __( 'Style 2', 'zn_framework' ),
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
									'val_prepend'  => 'verttabs--',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#dSJi2pegFow',
				'docs'    => 'http://support.hogash.com/documentation/vertical-tabs/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
