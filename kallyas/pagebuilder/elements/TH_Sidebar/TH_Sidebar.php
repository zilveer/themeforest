<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Sidebar
 Description: Create and display a Sidebar element
 Class: TH_Sidebar
 Category: content
 Level: 3
*/
/**
 * Class TH_Sidebar
 *
 * Create and display a Sidebar element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Sidebar extends ZnElements
{
	public static function getName(){
		return __( "Sidebar", 'zn_framework' );
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
		$elm_classes[] = 'kl-sidebar--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$sidebar_select = $this->opt( 'sidebar_select', 'defaultsidebar' );
		$elm_classes[]  = $this->opt( 'sidebar_bg', 'yes' ) == 'yes' ? '' : 'no_bg';
		?>

		<?php
		echo '<div id="sidebar-widget-'.$this->data['uid'].'" class="sidebar zn_sidebar '.implode(' ', $elm_classes).'" '.$attributes.'>';
			if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $sidebar_select ) ) : endif;
		echo '</div>';
		?>
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
						"name"        => __( "Select sidebar", 'zn_framework' ),
						"description" => __( "Select your desired sidebar to be used on this
											post", 'zn_framework' ),
						"id"          => "sidebar_select",
						"std"         => "",
						"type"        => "select",
						"options"     => WpkZn::getThemeSidebars()
					),
					array (
						"name"        => __( "Show background?", 'zn_framework' ),
						"description" => __( "Select yes if you want to show the default sidebar
											 background or no to use a transparent background.", 'zn_framework' ),
						"id"          => "sidebar_bg",
						"std"         => "yes",
						"type"        => "select",
						"options"     => array ( 'yes' => __( 'Yes', 'zn_framework' ), 'no' => __( 'No', 'zn_framework' ) )
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
									'val_prepend'  => 'kl-sidebar--',
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

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#QeOx0SoUq9E',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}

