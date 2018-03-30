<?php if(! defined('ABSPATH')){ return; }
/*
Name: Action Box
Description: Create and display an Action Box element
Class: TH_ActionBox
Category: header
Level: 3
*/
/**
 * Class TH_ActionBox
 *
 * Create and display an Action Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_ActionBox extends ZnElements
{
	public static function getName(){
		return __( "Action Box", 'zn_framework' );
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

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'actionbox--'.$color_scheme;

		$elm_classes[] = $this->opt( 'ac_style', 'style1' );

		echo '<div class="action_box '.implode(' ', $elm_classes).'" data-arrowpos="center" '.$attributes.'>';

			echo '<div class="action_box_inner action_box-inner">';

				echo '<div class="action_box_content action_box-content">';
					// Title
					$hasTitle = (isset($options['page_ac_title']) && ! empty ($options['page_ac_title']));
					$hasSubtitle = (isset($options['page_ac_subtitle']) && ! empty ($options['page_ac_subtitle']));

					if($hasTitle || $hasSubtitle){
						echo '<div class="ac-content-text action_box-text">';
					}
						if($hasTitle){
							echo '<h4 class="text action_box-title" '.WpkPageHelper::zn_schema_markup('title').'>' . do_shortcode( $options['page_ac_title'] ) . '</h4>';
						}
						if($hasSubtitle){
							echo '<h5 class="ac-subtitle action_box-subtitle">' . do_shortcode( $options['page_ac_subtitle'] ) . '</h5>';
						}
					if($hasTitle || $hasSubtitle){
						echo '</div>';
					}

					// LINKS
					$page_ac_b_link = zn_extract_link($this->opt('page_ac_b_link',''), 'btn ac-btn action_box-button action_box-button-first '.$this->opt('page_ac_b_link_style','btn-lined'), '');
					$page_ac_b_link2 = zn_extract_link($this->opt('page_ac_b_link2',''), 'btn ac-btn action_box-button action_box-button-second '.$this->opt('page_ac_b_link2_style','btn-fullwhite'), '');

					if(!empty($page_ac_b_link['start']) || !empty($page_ac_b_link2['start'])){

						echo '<div class="ac-buttons action_box-buttons">';
					}
						if( !empty($page_ac_b_link['start']) ){
							echo $page_ac_b_link['start'] . $options['page_ac_b_text'] . $page_ac_b_link['end'];
						}
						if( !empty($page_ac_b_link2['start']) ){

							echo $page_ac_b_link2['start'] . $options['page_ac_b_text2'] . $page_ac_b_link2['end'];
						}

					if(!empty($page_ac_b_link['start']) || !empty($page_ac_b_link2['start'])){
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
		$uid = $this->data['uid'];

		$options = array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
						"description" => sprintf(__( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".%s {  }" data-tooltip="Click to copy CSS class to clipboard">.%s</span> .', 'zn_framework' ), $uid, $uid),
						"id"          => "ibstg_uid",
						"std"         => "",
						"type"        => "zn_title",
						"class"       => "zn_full zn_nomargin"
					),

					array (
						"name"        => __( "Element Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "ac_style",
						"std"         => "style1",
						"options"     => array (
							'style1' => __( 'Style 1', 'zn_framework' ),
							'style2' => __( 'Style 2', 'zn_framework' ),
							'style3' => __( 'Style 3', 'zn_framework' ),
						),
						"type"        => "select",
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$this->data['uid']
						)
					),
					array (
						"name"        => __( "Action Box Title", 'zn_framework' ),
						"description" => __( "Enter a title for your action box", 'zn_framework' ),
						"id"          => "page_ac_title",
						"std"         => "",
						"type"        => "textarea"
					),
					array (
						"name"        => __( "Action Box Subtitle", 'zn_framework' ),
						"description" => __( "Enter a subtitle for the action box", 'zn_framework' ),
						"id"          => "page_ac_subtitle",
						"std"         => "",
						"type"        => "textarea"
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
									'val_prepend'  => 'actionbox--',
								),
							)
						)
					),
				),
			),
			'buttons' => array(
				'title' => 'Button options',
				'options' => array(
					array (
						"name"        => __( "Action Box Button Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear inside your action box button.", 'zn_framework' ),
						"id"          => "page_ac_b_text",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Action Box link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use for your action box button.", 'zn_framework' ),
						"id"          => "page_ac_b_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					array (
						"name"        => __( "Primary Button Style", 'zn_framework' ),
						"description" => __( "Select a style for the button", 'zn_framework' ),
						"id"          => "page_ac_b_link_style",
						"std"         => "btn-lined",
						"type"        => "select",
						"options"     => array (
							'btn-fullcolor'                     => __( "Flat (main color)", 'zn_framework' ),
							'btn-fullwhite'                     => __( "Flat (white)", 'zn_framework' ),
							'btn-fullblack'                     => __( "Flat (black)", 'zn_framework' ),
							'btn-lined'                         => __( "Lined (light)", 'zn_framework' ),
							'btn-lined lined-dark'              => __( "Lined (dark)", 'zn_framework' ),
							'btn-lined lined-gray'              => __( "Lined (gray)", 'zn_framework' ),
							'btn-lined lined-custom'            => __( "Lined (custom)", 'zn_framework' ),
							'btn-lined lined-full-light'        => __( "Lined-Full (light)", 'zn_framework' ),
							'btn-lined lined-full-dark'         => __( "Lined-Full (dark)", 'zn_framework' ),
							'btn-lined btn-skewed'              => __( "Lined-Skewed (light)", 'zn_framework' ),
							'btn-lined btn-skewed lined-dark'   => __( "Lined-Skewed (dark)", 'zn_framework' ),
							'btn-lined btn-skewed lined-gray'   => __( "Lined-Skewed (gray)", 'zn_framework' ),
							'btn-fullcolor btn-skewed'          => __( "Flat-Skewed (main color)", 'zn_framework' ),
							'btn-fullwhite btn-skewed'          => __( "Flat-Skewed (white)", 'zn_framework' ),
							'btn-fullblack btn-skewed'          => __( "Flat-Skewed (black)", 'zn_framework' ),
							'btn-default'                       => __( "Bootstrap - Default", 'zn_framework' ),
							'btn-primary'                       => __( "Bootstrap - Primary", 'zn_framework' ),
							'btn-success'                       => __( "Bootstrap - Success", 'zn_framework' ),
							'btn-info'                          => __( "Bootstrap - Info", 'zn_framework' ),
							'btn-warning'                       => __( "Bootstrap - Warning", 'zn_framework' ),
							'btn-danger'                        => __( "Bootstrap - Danger", 'zn_framework' ),
							'btn-link'                          => __( "Bootstrap - Link", 'zn_framework' ),
						),
					),
					array (
						"name"        => __( "Action Box Secondary Button Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear inside your action box secondary button.", 'zn_framework' ),
						"id"          => "page_ac_b_text2",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Action Box Secondary link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use for your action box secondary button.", 'zn_framework' ),
						"id"          => "page_ac_b_link2",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					array (
						"name"        => __( "Secondary Button Style", 'zn_framework' ),
						"description" => __( "Select a style for the button", 'zn_framework' ),
						"id"          => "page_ac_b_link2_style",
						"std"         => "btn-fullwhite",
						"type"        => "select",
						"options"     => array (
							'btn-fullcolor'                     => __( "Flat (main color)", 'zn_framework' ),
							'btn-fullwhite'                     => __( "Flat (white)", 'zn_framework' ),
							'btn-fullblack'                     => __( "Flat (black)", 'zn_framework' ),
							'btn-lined'                         => __( "Lined (light)", 'zn_framework' ),
							'btn-lined lined-dark'              => __( "Lined (dark)", 'zn_framework' ),
							'btn-lined lined-gray'              => __( "Lined (gray)", 'zn_framework' ),
							'btn-lined lined-custom'            => __( "Lined (custom)", 'zn_framework' ),
							'btn-lined lined-full-light'        => __( "Lined-Full (light)", 'zn_framework' ),
							'btn-lined lined-full-dark'         => __( "Lined-Full (dark)", 'zn_framework' ),
							'btn-lined btn-skewed'              => __( "Lined-Skewed (light)", 'zn_framework' ),
							'btn-lined btn-skewed lined-dark'   => __( "Lined-Skewed (dark)", 'zn_framework' ),
							'btn-lined btn-skewed lined-gray'   => __( "Lined-Skewed (gray)", 'zn_framework' ),
							'btn-fullcolor btn-skewed'          => __( "Flat-Skewed (main color)", 'zn_framework' ),
							'btn-fullwhite btn-skewed'          => __( "Flat-Skewed (white)", 'zn_framework' ),
							'btn-fullblack btn-skewed'          => __( "Flat-Skewed (black)", 'zn_framework' ),
							'btn-default'                       => __( "Bootstrap - Default", 'zn_framework' ),
							'btn-primary'                       => __( "Bootstrap - Primary", 'zn_framework' ),
							'btn-success'                       => __( "Bootstrap - Success", 'zn_framework' ),
							'btn-info'                          => __( "Bootstrap - Info", 'zn_framework' ),
							'btn-warning'                       => __( "Bootstrap - Warning", 'zn_framework' ),
							'btn-danger'                        => __( "Bootstrap - Danger", 'zn_framework' ),
							'btn-link'                          => __( "Bootstrap - Link", 'zn_framework' ),
						),
					),
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#PMwI-Jsy1Ck&list',
				'docs'    => 'http://support.hogash.com/documentation/action-box/',
				'copy'    => false,
				'general' => true,
			)),
		);

		return $options;
	}
}