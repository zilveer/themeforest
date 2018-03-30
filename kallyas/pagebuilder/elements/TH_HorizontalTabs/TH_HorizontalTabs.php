<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Horizontal Tabs
 Description: Create and display a Horizontal Tabs element
 Class: TH_HorizontalTabs
 Category: content
 Level: 3
 Multiple: true
*/
/**
 * Class TH_HorizontalTabs
 *
 * Create and display a Horizontal Tabs element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_HorizontalTabs extends ZnElements
{
	public static function getName(){
		return __( "Horizontal Tabs", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{

		$options = $this->data['options'];

		if( empty ( $options['single_horizontal_tab'] ) ){
			return;
		}
		$icon = '';

		$elm_classes=array();
		$elm_classes[] = $uid = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'tabs--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$single_tabs = $this->opt('single_horizontal_tab');
		$tabsListCount = count($single_tabs);

		$elm_classes[] = $this->opt('vts_tab_style','tabs_style1');

		$pb_tab = 0;

		echo '<div class="tabbable '.implode(' ', $elm_classes).'" '.$attributes.'>';

		if ( ! empty ( $single_tabs ) && is_array( $single_tabs ) )
		{
			echo '<ul class="nav nav-alignment--'.($this->opt('tabs_alignment','left')).' clearfix" role="tablist">';

				// foreach ( $single_tabs as $tab )
				for ($i = 0; $i < $tabsListCount; $i++ )
				{
					$cls = '';
					if ( $i === 0 ) {
						$cls = 'active in';
					}

					// ICON CHECK
					if ( ! empty ( $single_tabs[$i]['vts_tab_icon'] ) ) {
						$iconHolder = $single_tabs[$i]['vts_tab_icon'];
						$icon = !empty( $iconHolder['family'] )  ? '<span class="hr-tabs-nav-icon " '.zn_generate_icon( $single_tabs[$i]['vts_tab_icon'] ).'></span>' : '';
					}

					$uniq_name = $uid.'_'.$i;
					// Tab Handle
					echo '<li class="' . $cls . '">';
						echo '<a href="#' . $uniq_name . '" role="tab" data-toggle="tab">';
							echo $icon;
							echo '<span>'.$single_tabs[$i]['vts_tab_title'].'</span>';
						echo '</a>';
					echo '</li>';
					// $i++;
				}

			echo '</ul>';

			echo '<div class="tab-content">';

				// foreach ( $single_tabs as $tab )
				for ($i = 0; $i < $tabsListCount; $i++ )
				{
					$cls = $content = '';
					if ( $i === 0 ) {
						$cls = 'active in';
					}
					$uniq_name = $uid.'_'.$i;


					// TAB CONTENT
					echo '<div class="tab-pane ' . $cls . '" id="' . $uniq_name . '">';

						// Convert the old content to PB elements
						if( empty( $this->data['content'][$i] ) && ( ! empty( $single_tabs[$i]['vts_tab_c_title'] ) || ! empty( $single_tabs[$i]['vts_tab_c_content'] ) ) ){
							$textbox = ZNPB()->add_module_to_layout( 'TH_TextBox', array( 'stb_title' => $single_tabs[$i]['vts_tab_c_title'], 'stb_content' => $single_tabs[$i]['vts_tab_c_content'] ) );
							$column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array( $textbox ), 'col-sm-12' );
							$this->data['content'][$i] = array ( $column );
						}

						// Add complex page builder element
						echo '<div class="row tabPaneContainer zn_columns_container zn_content" data-droplevel="1">';
							if ( empty( $this->data['content'][$i] ) ) {
								$column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
								$this->data['content'][$i] = array ( $column );
							}

							if ( !empty( $this->data['content'][$i] ) ) {
								// print_z($this);
								ZNPB()->zn_render_content( $this->data['content'][$i] );
							}
						echo '   </div>';

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
			"name"           => __( "Tabs", 'zn_framework' ),
			"description"    => __( "Here you can add your desired tabs.", 'zn_framework' ),
			"id"             => "single_horizontal_tab",
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
					"name"        => __( "Display Icon?", 'zn_framework' ),
					"description" => __( "Please enter the desired title that will appear as tab.", 'zn_framework' ),
					"id"          => "vts_tab_hasicon",
					"std"         => "",
					"value"         => "1",
					"type"        => "toggle2"
				),
				array (
					"name"        => __( "Select Icon", 'zn_framework' ),
					"description" => __( "Select an icon to display.", 'zn_framework' ),
					"id"          => "vts_tab_icon",
					"std"         => "",
					"type"        => "icon_list",
					'class'       => 'zn_full',
					"dependency"  => array( 'element' => 'vts_tab_hasicon' , 'value'=> array('1') ),
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
						"name"        => __( "Tabs Style", 'zn_framework' ),
						"description" => __( "Using this option you can choose the desired tabs style.", 'zn_framework' ),
						"id"          => "vts_tab_style",
						"std"         => "tabs_style1",
						'options'     => array(
								'tabs_style1' => __( 'Style 1', 'zn_framework' ),
								'tabs_style2' => __( 'Style 2', 'zn_framework' ),
								'tabs_style3' => __( 'Style 3', 'zn_framework' ),
								'tabs_style4' => __( 'Style 4', 'zn_framework' ),
								'tabs_style5' => __( 'Style 5', 'zn_framework' ),
							),
						"type"        => "select",
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$this->data['uid']
						),
					),

					array (
						"name"        => __( "Tab Buttons Alignment", 'zn_framework' ),
						"description" => __( "Please select an alignment for the Tab Buttons", 'zn_framework' ),
						"id"          => "tabs_alignment",
						"std"         => "left",
						"type"        => "select",
						'options'     => array(
							'left' => __( 'Left (default)', 'zn_framework' ),
							'center' => __( 'Center', 'zn_framework' ),
							'right' => __( 'Right', 'zn_framework' ),
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$this->data['uid'].' ul.nav',
							'val_prepend'   => 'nav-alignment--'
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
									'val_prepend'  => 'tabs--',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#WvgZVeXIKRY',
				'docs'    => 'http://support.hogash.com/documentation/horizontal-tabs/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
