<?php

function webnus_employees_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'cols'=>2,
	'emps' => '-1',
	
	), $atts));
	
$emp_arrays = array();

if(!empty($emps))
{
	
	$emp_arrays = explode(',', $emps);
	
}


$query_atts = array(

					'post_type'=>'employee',
					'nopaging ' => true,
					'posts_per_page'=>-1,
					'post__in' => $emp_arrays,
				);

$query = new WP_Query($query_atts);

$out = '';

// Temp counter for vertical space between rows
$v_space_counter = 1;

if($query->have_posts())
while($query->have_posts())
{
		
	$query->the_post();		
	switch($cols)
	{
		case 2:
			$out .='<div class="col-md-6">';
			break;
		case 3:
			$out .='<div class="col-md-4">';
			break;
		case 4:
			$out .='<div class="col-md-3">';
			break;
		default:
			$out .='<div>';
		break;

	}	

	$post_meta = get_post_meta(get_the_ID(),'_employee_meta',true);
	
	$position = $facebook = $twitter = $google = $linkedin = $instagram = $email = '';
	if(!empty($post_meta))
	{
			
		$position = isset($post_meta['position'])?$post_meta['position']:'';
		$email = isset($post_meta['email'])?$post_meta['email']:'';
		$facebook = isset($post_meta['social_facebook'])?$post_meta['social_facebook']:'';
		$twitter = isset($post_meta['social_twitter'])?$post_meta['social_twitter']:'';
		$google = isset($post_meta['social_googleplus'])?$post_meta['social_googleplus']:'';
		$linkedin = isset($post_meta['social_linkedin'])?$post_meta['social_linkedin']:'';
		$instagram = isset($post_meta['social_instagram'])?$post_meta['social_instagram']:'';
			
		
	}
	$name = get_the_title();
	$text = get_the_content();
	$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
	$large_image = $large_image[0];
	
	$out .=		"<div class='wpb_wrapper' >";
		$out .=		"<div class='wedding-team-violet'>";
			$out .=	 "<img class='team-image' src='$large_image' />";
				$out .=		"<div class='w-frame' >";
					$out .=		"<div class='team-cap' >";
						$out .=  "<h3>$name</h3>";
							$out .=  "<p>$text</p>";
							 $out .=	 "<span>$position</span>";
									$out .= 	"</div>";
										$out .=		"<div class='social-team'>";
										if(!empty($email))
											$out .= "[icon name='mail' link='mailto:$email']";
										if(!empty($facebook))
											$out .= "[icon name='facebook' link='$facebook']";
										if(!empty($twitter))
											$out .= "[icon name='twitter' link='$twitter']";
										if(!empty($google))
											$out .= "[icon name='google-plus' link='$google']";
										if(!empty($linkedin))
											$out .= "[icon name='linkedin' link='$linkedin']";
										if(!empty($instagram))
											$out .= "[icon name='instagram' link='$instagram']";
										$out .= '</div>';
				$out .= '</div>';
		$out .= '</div>';
	$out .= '</div>';
$out .= '</div>';
	
	if( ( 2 == $cols ) && ( $v_space_counter % 2 == 0 ) ) $out .= '<hr class="vertical-space2">';
	if( ( 3 == $cols ) && ( $v_space_counter % 3 == 0 ) ) $out .= '<hr class="vertical-space2">';
	if( ( 4 == $cols ) && ( $v_space_counter % 4 == 0 ) ) $out .= '<hr class="vertical-space2">';
	
	++$v_space_counter;
}


return $out;
}

add_shortcode('employees', 'webnus_employees_shortcode');	
	
?>