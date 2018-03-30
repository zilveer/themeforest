<?php

/* KowloonBay Team: shortcodes */
add_shortcode('team', 'kowloonbay_team_shortcode');

function kowloonbay_team_shortcode()
{
	$kowloonbay_team_member_query = array(
		'posts_per_page'	=> '-1',
		'post_type'			=> 'kowloonbay_team',
		'order'				=> 'ASC',
		'orderby'			=> 'menu_order date',
		'paged'				=> '1',
	);
	$kowloonbay_team_members = new WP_Query( $kowloonbay_team_member_query );

	global $kowloonbay_carousel_multiple_items_count;
	$kowloonbay_carousel_multiple_items_count = $kowloonbay_team_members->post_count;

	$html = '<div class="no-page-padding margin-t-2x">';
		$html .= '<div class="owl-carousel carousel-multiple-items">';

	if ($kowloonbay_team_members->have_posts()):
		while($kowloonbay_team_members->have_posts()):
			$kowloonbay_team_members->the_post();
			$kowloonbay_team_photo = rwmb_meta( 'kowloonbay_team_photo',array('type'=>'image_advanced') );
			$kowloonbay_team_photo = reset($kowloonbay_team_photo);
			$kowloonbay_team_pos = rwmb_meta( 'kowloonbay_team_pos');
			$permalink = get_permalink(get_the_id());

			$html .= '<div class="hover-effect-move-right height-2x">';
				$html .= '<div class="img-bg-cover"><img src="'. esc_url($kowloonbay_team_photo['full_url']) .'" alt=""></div>';
				$html .= '<div class="caption">';
					$html .= '<div class="v-centered-container">';
						$html .= '<div class="v-centered">	';
							$html .= '<h2>'. esc_html(get_the_title()) .'</h2>';
							$html .= '<p>' . esc_html($kowloonbay_team_pos) . '</p>';
						$html .= '</div>';
					$html .= '</div>';
					$html .= '<a href="'. esc_url($permalink) .'">View More</a>';
				$html .= '</div>';
			$html .= '</div>';
			
		endwhile;
	endif;

		$html .= '</div>';
	$html .= '</div>';


	wp_reset_postdata();

	return $html;
}