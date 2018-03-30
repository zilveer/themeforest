<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Team Box
 Description: Create and display a Team Box element
 Class: TH_TeamBox
 Category: content
 Level: 3
 Keywords: member, person
*/
/**
 * Class TH_TeamBox
 *
 * Create and display a Team Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_TeamBox extends ZnElements
{
	public static function getName(){
		return __( "Team Box", 'zn_framework' );
	}

	function css(){
		$css = '';
		$uid = $this->data['uid'];

		$social_icons = $this->opt('single_team_social','');
		if ( $social_icons && is_array( $social_icons ) ) {
			foreach ( $social_icons as $key => $icon ) {
				if(isset($icon['teb_social_iconcolor']) && !empty($icon['teb_social_iconcolor'])){
					$css .= '.'.$this->data['uid'].' .sctb-icon-'.$icon['teb_social_icon']['unicode'].' { background-color: '.$icon['teb_social_iconcolor'].'; }';
				}
			}
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

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'teambox--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$elm_classes[] = 'teambox-style--'.$this->opt('team_style','hover');

		echo '<div class="team_member team-member u-trans-all-2s '.implode(' ', $elm_classes).'" '.$attributes.'>';

		$image      = '';

		$teb_link = zn_extract_link( $this->opt('teb_link',''), 'grayHover team-member-link', false, false, false, '#' );

		$teb_image_sizew = $this->opt('teb_image_sizew', 270);
		$teb_image_sizeh = $this->opt('teb_image_sizeh', 270);

		// Check to see if we have an image
		// $slide_image = $options['teb_image'];
		if ( $slide_image = $this->opt('teb_image','') ) {

			$saved_alt   = ZngetImageAltFromUrl( $options['teb_name'], true );
			$saved_title = ZngetImageTitleFromUrl( $options['teb_name'], true );

			if ( is_array( $slide_image ) ) {

				if ( $saved_image = $slide_image['image'] ) {

					// Image alt
					if ( ! empty( $slide_image['alt'] ) ) {
						$saved_alt = 'alt="' . $slide_image['alt'] . '"';
					}

					// Image title
					if ( ! empty( $slide_image['title'] ) ) {
						$saved_title = 'title="' . $slide_image['title'] . '"';
					}

					$image = vt_resize( '', $saved_image, $teb_image_sizew, $teb_image_sizeh, true );
					$image = '<img class="team-member-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" ' . $saved_alt . ' ' . $saved_title . '/>';
				}
			}
			else {
				$saved_image = $slide_image;
				$image       = vt_resize( '', $saved_image, $teb_image_sizew, $teb_image_sizeh, true );
				$image       = '<img class="team-member-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" ' . $saved_alt . ' ' . $saved_title . '/>';
			}
		}

		// IMAGE
		echo $teb_link['start'] . $image . $teb_link['end'];

		// NAME AND POSITION
		if( $teb_name = $this->opt('teb_name','') )
			echo '<h4 class="team-member-name" '.WpkPageHelper::zn_schema_markup('person').'>' . $teb_name . '</h4>';

		if( $teb_position = $this->opt('teb_position','') )
			echo '<h6 class="team-member-pos">' . $teb_position . '</h6>';

		echo '<div class="details team-member-details">';

		// DESCRIPTION
		if ( ! empty ( $options['teb_desc'] ) ) {
			echo '<div class="desc team-member-desc">';

			if ( preg_match( '%(<p[^>]*>.*?</p>)%i', $options['teb_desc'], $regs ) ) {
				echo $options['teb_desc'];
			}
			else {
				echo '<p>' . $options['teb_desc'] . '</p>';
			}

			echo '</div>';
		}

		// SOCIAL ICONS
		$single_team_social = $this->opt('single_team_social', '');
		if ($single_team_social && is_array( $single_team_social ) ) {

			echo '<ul class="social-icons sc--colored fixclear">';

			foreach ( $single_team_social as $icon ) {

				$iconHolder = $icon['teb_social_icon'];
				$social_icon = !empty( $iconHolder['family'] )  ? zn_generate_icon( $icon['teb_social_icon'] ) : '';
				$icon_color = isset($icon['teb_social_iconcolor']) && !empty($icon['teb_social_iconcolor']) ? $icon['teb_social_icon']['unicode'] : 'nocolor';
				echo '<li class="social-icons-li"><a '.$social_icon.' href="' . $icon['teb_social_link']['url'] . '" target="' . $icon['teb_social_link']['target'] . '" title="' . $icon['teb_social_title'] . '" class="social-icons-item sctb-icon-'.$icon_color.'"></a></li>';
			}

			echo '</ul>';
		}

		echo '</div><!-- end details -->';

		echo '</div><!-- end team_member -->';

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Social Icons", 'zn_framework' ),
			"description"    => __( "Here you can add your desired social icons.", 'zn_framework' ),
			"id"             => "single_team_social",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Icon", 'zn_framework' ),
			"remove_text"    => __( "Icon", 'zn_framework' ),
			"group_title"    => "",
			"group_sortable" => true,
			"element_title" => "teb_social_title",
			"subelements"    => array (
				array (
					"name"        => __( "Icon title", 'zn_framework' ),
					"description" => __( "Here you can enter a title for this social icon.Please note that this is just for your information as this text will not be visible on the site.", 'zn_framework' ),
					"id"          => "teb_social_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Social icon link", 'zn_framework' ),
					"description" => __( "Please enter your desired link for the social
											icon. If this field is left blank, the icon will not be linked.", 'zn_framework' ),
					"id"          => "teb_social_link",
					"std"         => "",
					"type"        => "link",
					"options"     => array (
						'_blank' => __( "New window", 'zn_framework' ),
						'_self'  => __( "Same window", 'zn_framework' )
					)
				),
				array (
					"name"        => __( "Social icon Background color", 'zn_framework' ),
					"description" => __( "Select a background color for the icon (if you selected <strong>Colored</strong> or <strong>Colored on hover</strong> options)", 'zn_framework' ),
					"id"          => "teb_social_iconcolor",
					"std"         => "#000",
					"type"        => "colorpicker"
				),
				array (
					"name"        => __( "Social icon", 'zn_framework' ),
					"description" => __( "Select your desired social icon.", 'zn_framework' ),
					"id"          => "teb_social_icon",
					"std"         => "",
					"type"        => "icon_list",
					'class'       => 'zn_full',
				)
			)
		);
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

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
									'val_prepend'  => 'teambox--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),

					array(
						'id'          => 'team_style',
						'name'        => 'MemberBox style',
						'description' => 'Select the style for this element',
						'type'        => 'select',
						'std'         => 'hover',
						'options'        => array(
							'normal' => 'Simple',
							'hover' => 'Hover details',
						),
					),

					array (
						"name"        => __( "Name", 'zn_framework' ),
						"description" => __( "Please enter a name for this team member", 'zn_framework' ),
						"id"          => "teb_name",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Position", 'zn_framework' ),
						"description" => __( "Please enter a position for this team member", 'zn_framework' ),
						"id"          => "teb_position",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Description", 'zn_framework' ),
						"description" => __( "Please enter a description for this team member", 'zn_framework' ),
						"id"          => "teb_desc",
						"std"         => "",
						"type"        => "textarea",
					),
					array (
						"name"        => __( "Member image", 'zn_framework' ),
						"description" => __( "Please select an image for this team member", 'zn_framework' ),
						"id"          => "teb_image",
						"std"         => "",
						"type"        => "media",
						"alt"         => true
					),
					array (
						"name"        => __( "Member image Width", 'zn_framework' ),
						"description" => __( "Please select the width of the image for this image", 'zn_framework' ),
						"id"          => "teb_image_sizew",
						"std"         => "270",
						"type"        => "text"
					),
					array (
						"name"        => __( "Member image Height", 'zn_framework' ),
						"description" => __( "Please select the height of the image for this image", 'zn_framework' ),
						"id"          => "teb_image_sizeh",
						"std"         => "270",
						"type"        => "text"
					),
					array (
						"name"        => __( "Image link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use for the image.", 'zn_framework' ),
						"id"          => "teb_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					$extra_options,
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#XOb_L7apg0o',
				'docs'    => 'http://support.hogash.com/documentation/team-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
