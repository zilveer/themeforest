<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Info Box 2
 Description: Create and display a Info Box 2 element
 Class: TH_InfoBox2
 Category: content
 Level: 3
 Keywords: notification, notice
*/

/**
 * @since    4.0.0
 */
class TH_InfoBox2 extends ZnElements
{
	public static function getName(){
		return __( "Info Box 2", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$ib2_style = $this->opt('ib2_style','style1');

		// background color
		$ib2_bgcolor = $this->opt('ib2_bgcolor','');
		if( !empty($ib2_bgcolor) && $ib2_style != 'style1' ){
			$css .= ".{$uid}{background-color:{$ib2_bgcolor}}";
		}

		// background color for style1
		$ib2_bgcolor_st1 = $this->opt('ib2_bgcolor_st1','#767676');
		if( !empty($ib2_bgcolor_st1) && $ib2_bgcolor_st1 != '#767676' && $ib2_style == 'style1' ){
			$css .= ".{$uid}{background-color:{$ib2_bgcolor_st1}}";
		}

		//  background image
		$ib2_bgimage = $this->opt('ib2_bgimage','');
		if( !empty($ib2_bgimage) && $ib2_style == 'style3'){
			$css .= ".{$uid}{background-image:url({$ib2_bgimage})}";
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

		// They were previously saved oddly
		$get_scheme = $this->opt( 'ib2_text_color', '' );
		if($get_scheme == 'ib2-text-color-light-theme'){
			$get_scheme = 'light';
		} elseif($get_scheme == 'ib2-text-color-dark-theme'){
			$get_scheme = 'dark';
		}
		$color_scheme = $get_scheme == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $get_scheme;
		$elm_classes[] = 'infobox2--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$ib2_style = $this->opt('ib2_style','style1');
		$elm_classes[] = 'ib2-'.$ib2_style;

		// Style 2 && style 3
		if('style2' == $ib2_style || 'style3' == $ib2_style) {
			?>
			<div class="<?php echo implode(' ', $elm_classes); ?> ib2-custom infobox2-container" <?php echo $attributes; ?>>
				<div class="ib2-inner infobox2-inner">
					<?php

					if($infoMessage = $this->opt('ib2_info_message','')){
						echo '<h4 class="ib2-info-message infobox2-message text-custom-before">'.$infoMessage.'</h4>';
					}

					echo '<div class="ib2-content">';

						if($ibTitle = $this->opt('ib2_title_text','')){
							echo '<h3 class="ib2-content--title infobox2-title" '.WpkPageHelper::zn_schema_markup('title').'>'.$ibTitle.'</h3>';
						}
						if($ibText = $this->opt('ib2_title','')){
							echo '<div class="ib2-content--text infobox2-text">'.wpautop($ibText).'</div>';
						}

					echo '</div>';

					?>
				</div>
			</div>
		<?php
		}
		else {
			if($ibText = $this->opt('ib2_title','')){
				// if no subtitle nor description use full 12 column
				echo '<div class="info-text infobox2-infotext '.implode(' ', $elm_classes).'">';
				echo wpautop($ibText);
				echo '</div>';
			}
		}
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
						"name"        => __( "Select style", 'zn_framework' ),
						"description" => __( "Select the desired style for this element", 'zn_framework' ),
						"id"          => "ib2_style",
						"type"        => "select",
						"std"         => "style1",
						"options"     => array (
							'style1' => __( 'Style 1 (Default)', 'zn_framework' ),
							'style2' => __( 'Style 2 (Background color)', 'zn_framework' ),
							'style3' => __( 'Style 3 (background image)', 'zn_framework' ),
						),
					),

					array (
						"name"        => __( "Select background color", 'zn_framework' ),
						"description" => __( "Select a color to apply as background color.", 'zn_framework' ),
						"id"          => "ib2_bgcolor",
						"std"         => "",
						"type"        => "colorpicker",
						'live'        => array(
							'type'      => 'css',
							'css_class' => '.'.$uid,
							'css_rule'  => 'background-color',
							'unit'      => ''
						),
						'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style2') ),
					),

					array (
						"name"        => __( "Select background color", 'zn_framework' ),
						"description" => __( "Select a color to apply as background color.", 'zn_framework' ),
						"id"          => "ib2_bgcolor_st1",
						"std"         => "#767676",
						"type"        => "colorpicker",
						'live'        => array(
							'type'      => 'css',
							'css_class' => '.'.$uid,
							'css_rule'  => 'background-color',
							'unit'      => ''
						),
						'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style1') ),
					),

					array(
						'id'          => 'ib2_text_color',
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
									'val_prepend'  => 'infobox2--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						),
						// 'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style2','style3') ),
					),
					array (
						"name"        => __( "Select background image", 'zn_framework' ),
						"description" => __( "Please select an image to use as background image.", 'zn_framework' ),
						"id"          => "ib2_bgimage",
						"std"         => "",
						"type"        => "media",
						'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style3') ),
					),

					array (
						"name"        => __( "Info message", 'zn_framework' ),
						"description" => __( "Please enter the info message", 'zn_framework' ),
						"id"          => "ib2_info_message",
						"std"         => "",
						"type"        => "text",
						'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style2','style3') ),
					),
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter the title", 'zn_framework' ),
						"id"          => "ib2_title_text",
						"std"         => "",
						"type"        => "text",
						'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style2','style3') ),
					),

					array (
						"name"        => __( "Content", 'zn_framework' ),
						"description" => __( "Please enter the content for this box", 'zn_framework' ),
						"id"          => "ib2_title",
						"std"         => "",
						"type"        => "visual_editor",
						'class'       => 'zn_full'
					)
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#LoGkTg6n6lg',
				'docs'    => 'http://support.hogash.com/documentation/info-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;

	}
}
