<?php
/*
Template Name: Team
*/

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */

get_header(); 

$teamMember = YSettings::g('team_member');
$text_align = YSettings::g('berg_team_align');

$output = '';
$team_arr = array();
$team_id_order = '';
$team_member = '';

if ( !empty($teamMember['ids']) ) {
	$team_id_order = explode(',', $teamMember['ids']);
}
if ( !empty($teamMember['team']) ) {
	$team_member = explode('|x;|', $teamMember['team']);
}

$max = count($team_member);
$mod4 = $max % 4;
$mod3 = $max % 3;
$margin_clean = '';
if( $mod4 == 0 || $mod3 == 0 ) {
	$margin_clean = 'margin-clean';
}

$style = '';

if ($max <= 2) {
	if ($max == 2) {
		$width = '50%';
	} else {
		$width = '50%';
		$style = 'text-align: center;';
	}
} else {
	$width = '25%'; 

	if( $mod4 == 0 || $mod3 == 0 ) {
		if ( $mod4 == 0 && $mod3 == 0 ) {
			$width = '25%';
		} else {
			if( $mod4 == 0) {
				$width = '25%';
			} 
			if ( $mod3 == 0) {
				$width = '33.3332%';
			}
		} 
	} else {
		// $mod4 = $max % 4; 
		// $mod3 = $max % 3;
		if( $mod4 > $mod3 ) {
			$width = '25%';
		} else {
			$width = '33%';
		}
	}
}	

$imgUrl = 'http://placehold.it/1440x900&amp;text=Please+select+featured+image';
if ( has_post_thumbnail()) {
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large_bg');
	$imgUrl = $large_image_url[0];
};	

?>

<header class="main-section team-page no-intro-padding"> 
	<div class="team-bg-fullscreen"> 
		<div class="bg-overlay"></div>
		<div class="team-member-wrapper">
			<div class="team-members">
				<div class="team-members-table">
					<div class="team-members-table-inner">
						<div class="container">
							<div class="row">
								<div class="col-md-12 <?php echo $margin_clean ;?>" style="overflow: hidden; <?php echo $style ;?>">

									<?php 
									
										if ( is_array($team_member) && is_array($team_id_order) ) {
											foreach ( $team_member as $member ) {
												foreach ( json_decode($member, true) as $id => $value ) {
													$team_arr[$id] = $value[0];
												}
											}
											foreach ( $team_id_order as $id_team ) {
											$output .= '<div class="member" style="width: '.$width.'; text-align: '.$text_align.';">';
												$output .= '<h4 class="member-name">'.$team_arr[$id_team]['name'].'</h4>';
												$output .= '<div class="member-pos">'.$team_arr[$id_team]['pos'].'</div>';
												$output .= '<div class="member-desc">'.$team_arr[$id_team]['desc'].'</div>';
												
											$output .= '</div>';
											}
										}
										echo $output;
									; ?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="team-bg-image" data-background="<?php echo $imgUrl ?>"></div>
	</div>
</header>


<?php
wp_reset_postdata();
berg_getFooter();
get_template_part('footer');
?>