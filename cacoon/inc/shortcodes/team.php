<?php

function met_su_TEAM_shortcode_data( $shortcodes ) {

	// Add new shortcode
	$shortcodes['met_team'] = array(
		'name' => __( 'Team Member', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'desc' => '',
		'atts' => array(
			'title' => array(
				'default' => 'John Doe',
				'name' => __( 'Team Member Name', 'su' ),
			),
			'position_title' => array(
				'default' => '',
				'name' => __( 'Position', 'su' ),
			),
			'desc' => array(
				'default' => '',
				'name' => __( 'Description', 'su' ),
			),
			'avatar' => array(
				'type' => 'upload',
				'default' => '',
				'name' => __( 'Member Photo', 'su' ),
			),
			'member_skill_title_1' => array(
				'default' => '',
				'name' => __( 'Member Skill Title (1)', 'su' ),
			),
			'member_skill_percent_1' => array(
				'name' => __( 'Member Skill Percent (1)', 'su' ),'type' => 'slider','min' => 1,'max' => 100,'step' => 1,'default' => '',
			),
			'member_skill_title_2' => array(
				'default' => '',
				'name' => __( 'Member Skill Title (2)', 'su' ),
			),
			'member_skill_percent_2' => array(
				'name' => __( 'Member Skill Percent (2)', 'su' ),'type' => 'slider','min' => 1,'max' => 100,'step' => 1,'default' => '',
			),
			'member_skill_title_3' => array(
				'default' => '',
				'name' => __( 'Member Skill Title (3)', 'su' ),
			),
			'member_skill_percent_3' => array(
				'name' => __( 'Member Skill Percent (3)', 'su' ),'type' => 'slider','min' => 1,'max' => 100,'step' => 1,'default' => '',
			),
			'member_skill_title_4' => array(
				'default' => '',
				'name' => __( 'Member Skill Title (4)', 'su' ),
			),
			'member_skill_percent_4' => array(
				'name' => __( 'Member Skill Percent (4)', 'su' ),'type' => 'slider','min' => 1,'max' => 100,'step' => 1,'default' => '',
			),
			'social_icon_1' => array(
				'name' => __( 'Social Icon (1)', 'su' ),'type' => 'icon','default' => '',
			),
			'social_icon_link_1' => array(
				'name' => __( 'Social Icon Link (1)', 'su' ),'default' => '',
			),
			'social_icon_2' => array(
				'name' => __( 'Social Icon (2)', 'su' ),'type' => 'icon','default' => '',
			),
			'social_icon_link_2' => array(
				'name' => __( 'Social Icon Link (2)', 'su' ),'default' => '',
			),
			'social_icon_3' => array(
				'name' => __( 'Social Icon (3)', 'su' ),'type' => 'icon','default' => '',
			),
			'social_icon_link_3' => array(
				'name' => __( 'Social Icon Link (3)', 'su' ),'default' => '',
			),
			'social_icon_4' => array(
				'name' => __( 'Social Icon (4)', 'su' ),'type' => 'icon','default' => '',
			),
			'social_icon_link_4' => array(
				'name' => __( 'Social Icon Link (4)', 'su' ),'default' => '',
			),
			'social_icon_5' => array(
				'name' => __( 'Social Icon (5)', 'su' ),'type' => 'icon','default' => '',
			),
			'social_icon_link_5' => array(
				'name' => __( 'Social Icon Link (5)', 'su' ),'default' => '',
			),
		),
		'icon' => 'star',
		'function' => 'met_su_team_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_TEAM_shortcode_data' );


function met_su_team_shortcode( $atts, $content = null ) {

	for($i=1; $i<5; $i++){
		if ( $atts['social_icon_'.$i] ) {
			if ( strpos( $atts['social_icon_'.$i], 'icon:' ) !== false ) {
				$atts['social_icon_'.$i] = '<i class="fa fa-' . trim( str_replace( 'icon:', '', $atts['social_icon_'.$i] ) ) . '"></i>';
				su_query_asset( 'css', 'font-awesome' );
			}
		}
	}


	$output = '
	<div class="row-fluid">
		<div class="span12">
			<div class="met_team_member">
				<div class="met_team_member_preview">
					<img src="'. ((empty($atts['avatar'])) ? 'http://placehold.it/275x244' : $atts['avatar']) .'" alt="'.esc_attr($atts['title']).'" />
					<div class="met_team_member_overlay">';

						$output .= ((!empty($atts['member_skill_title_1'])) ? '<div class="met_team_member_skill"><div style="width: '.$atts['member_skill_percent_1'].'%"><span class="met_bgcolor_trans met_color2">'.$atts['member_skill_title_1'].'</span></div></div>' : '');
						$output .= ((!empty($atts['member_skill_title_2'])) ? '<div class="met_team_member_skill"><div style="width: '.$atts['member_skill_percent_2'].'%"><span class="met_bgcolor_trans met_color2">'.$atts['member_skill_title_2'].'</span></div></div>' : '');
						$output .= ((!empty($atts['member_skill_title_3'])) ? '<div class="met_team_member_skill"><div style="width: '.$atts['member_skill_percent_3'].'%"><span class="met_bgcolor_trans met_color2">'.$atts['member_skill_title_3'].'</span></div></div>' : '');
						$output .= ((!empty($atts['member_skill_title_4'])) ? '<div class="met_team_member_skill"><div style="width: '.$atts['member_skill_percent_4'].'%"><span class="met_bgcolor_trans met_color2">'.$atts['member_skill_title_4'].'</span></div></div>' : '');

					$output .= '
					</div>
				</div>
				<div class="met_team_member_details met_bgcolor3 met_color2">
					<h2 class="met_title_stack">'.$atts['position_title'].'</h2>
					<h3 class="met_title_stack met_bold_one">'.$atts['title'].'</h3>
					<p>'.$atts['desc'].'</p>
				</div>
				<div class="met_team_member_socials met_bgcolor clearfix">';

					$output .= ((!empty($atts['social_icon_1'])) ? '<a href="'.$atts['social_icon_link_1'].'" class="met_color2" title="" target="_blank">'.$atts['social_icon_1'].'</a>' : '');
					$output .= ((!empty($atts['social_icon_2'])) ? '<a href="'.$atts['social_icon_link_2'].'" class="met_color2" title="" target="_blank">'.$atts['social_icon_2'].'</a>' : '');
					$output .= ((!empty($atts['social_icon_3'])) ? '<a href="'.$atts['social_icon_link_3'].'" class="met_color2" title="" target="_blank">'.$atts['social_icon_3'].'</a>' : '');
					$output .= ((!empty($atts['social_icon_4'])) ? '<a href="'.$atts['social_icon_link_4'].'" class="met_color2" title="" target="_blank">'.$atts['social_icon_4'].'</a>' : '');
					$output .= ((!empty($atts['social_icon_5'])) ? '<a href="'.$atts['social_icon_link_5'].'" class="met_color2" title="" target="_blank">'.$atts['social_icon_5'].'</a>' : '');

				$output .= '
				</div>
			</div>
		</div>
	</div>
	';

	return $output;
}