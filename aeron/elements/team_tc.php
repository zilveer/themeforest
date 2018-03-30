<?php

/*********** Shortcode: Team ************************************************************/

$tcvpb_elements['team_tc'] = array(
	'name' => esc_html__('Team', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-team',
	'category' =>  esc_html__('Social', 'ABdev_aeron'),
	'child' => 'team_socials_tc',
	'child_button' => esc_html__('New Social Link', 'ABdev_aeron'),
	'child_title' => esc_html__('Social Links', 'ABdev_aeron'),
	'attributes' => array(
		'name' => array(
			'description' => esc_html__('Name', 'ABdev_aeron'),
		),
		'position' => array(
			'description' => esc_html__('Position', 'ABdev_aeron'),
		),
		'image' => array(
			'type' => 'image',
			'description' => esc_html__('Image URL', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'link' => array(
			'description' => esc_html__('Profile URL', 'ABdev_aeron'),
			'info' => esc_html__('Link to about page', 'ABdev_aeron'),
			'tab' => esc_html__('Details', 'ABdev_aeron'),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__( 'Target', 'ABdev_aeron' ),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'ABdev_aeron' ),
				'_blank' => esc_html__( 'Blank', 'ABdev_aeron' ),
			),
			'tab' => esc_html__('Details', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'modal' => array(
			'type' => 'checkbox',
			'description' => esc_html__('Use Modal Link', 'ABdev_aeron'),
			'info' => esc_html__('Modal window will appear on click instead of following a link. Use content to add modal window content', 'ABdev_aeron'),
			'tab' => esc_html__('Details', 'ABdev_aeron'),
		),
		'modal_content' => array(
			'description' => esc_html__( 'Modal Content', 'ABdev_aeron' ),
			'type' => 'small_tinymce',
			'tab' => esc_html__('Details', 'ABdev_aeron'),
		),
		'animation' => array(
			'default'     => '',
			'description' => esc_html__('Entrance Animation', 'ABdev_aeron'),
			'type'        => 'select',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
			'values'      => array(
				''                  => esc_html__('None', 'ABdev_aeron'),
				'animate_fade'      => esc_html__('Fade', 'ABdev_aeron'),
				'animate_afc'       => esc_html__('Zoom', 'ABdev_aeron'),
				'animate_afl'       => esc_html__('Fade to Right', 'ABdev_aeron'),
				'animate_afr'       => esc_html__('Fade to Left', 'ABdev_aeron'),
				'animate_aft'       => esc_html__('Fade Down', 'ABdev_aeron'),
				'animate_afb'       => esc_html__('Fade Up', 'ABdev_aeron'),
			),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_aeron'),
			'info'        => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'ABdev_aeron'),
			'default'     => '1000',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
	'content' => '',
);
function tcvpb_team_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('team_tc'), $attributes));
	global $social_links;
	do_shortcode($content);

	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$return = '
		<div '.esc_attr($id_out).' class="tcvpb_team_member '.esc_attr($class).' '.$animation_classes.'" '.$animation_out.'>';

		// $social_links = '';

		if($social_links!='' || $link!='' || $modal==1){
			$return .= '<div class="tcvpb_overlayed">
				<img src="'.esc_url($image).'" alt="'.esc_attr($name).'">
				<div class="tcvpb_overlay">';
					if ($modal==1){
						$return .='<a class="tcvpb_team_member_link tcvpb_team_member_modal_link" href="'.esc_url($link).'"></a>';
					}
					if ($link!=''){
						$return .='<a class="tcvpb_team_member_profile_link" href="'.esc_url($link).'" target="'.esc_attr($target).'"></a>';
					}
					$return .= '<p>';
						$return .= $social_links;
					$return .= '</p>
				</div>
				<div class="tcvpb_overlay_after"></div>
			</div>';
		}
		else{
			$return .= '<img src="'.esc_url($image).'" alt="'.esc_attr($name).'">';
		}

		$return .= '<div class="tcvpb_team_member_details">';
			if ($modal==1){
				$return .='<a class="tcvpb_team_member_link tcvpb_team_member_modal_link" href="'.esc_url($link).'"></a>';
			}
			if ($link!=''){
				$return .='<a class="tcvpb_team_member_profile_link" href="'.esc_url($link).'" target="'.esc_attr($target).'"></a>';
			}
			$return .='<span class="tcvpb_team_member_name">'.$name.'</span>
			<span class="tcvpb_team_member_position">'.$position.'</span>
		</div>';

		if($modal == 1){
			$return .= '
				<div class="tcvpb_team_member_modal">
					<h3 class="tcvpb_team_member_name">'.esc_attr($name).'</h3>
					<h4 class="tcvpb_team_member_position">'.$position.'</h4>
					<div class="tcvpb_container">
						<div class="tcvpb_column_tc_span4">
							<img src="'.esc_url($image).'" alt="'.esc_attr($name).'">
						</div>
						<div class="tcvpb_column_tc_span8">
							<p>'.do_shortcode($modal_content).'</p>
						</div>
					</div>
					<div class="tcvpb_team_member_modal_close">X</div>
				</div>';
		}
		else{
			$return .= '';
		}

		$return .= '</div>';

	$social_links = '';

	return $return;
}

$tcvpb_elements['team_socials_tc'] = array(
	'name' => esc_html__('Single Social Link', 'ABdev_aeron' ),
	'type' => 'child',
	'attributes' => array(
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_aeron'),
			'type' => 'icon',
		),
		'url' => array(
			'description' => esc_html__('Social URL', 'ABdev_aeron'),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__('Target', 'ABdev_aeron'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'ABdev_aeron'),
				'_blank' => esc_html__('Blank', 'ABdev_aeron'),
			),
		),
	),
);
function tcvpb_team_socials_tc_shortcode( $attributes, $content = null ) {
	global $social_links;
	extract(shortcode_atts(tcvpb_extract_attributes('team_socials_tc'), $attributes));

	$social_links .= ($icon!='') ? '<a class="tcvpb_socialicon" href="'.esc_url($url).'" target="'.esc_attr($target).'"><i class="'.esc_attr($icon).'"></i></a>' : '';

	$return = '';
	return $return;
}