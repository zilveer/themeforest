<?php

function webnus_ourteam ($atts, $content = null) {
	extract(shortcode_atts(array(
	'type'  => '1',
	'img'=>'',
	'name' => '',
	'link' => '',
	'title' =>'',
	'text'=>'',
	'social'=>'',
	'first_social'=>'twitter',
	'first_url'=>'',
	'second_social'=>'facebook',
	'second_url'=>'',
	'third_social'=>'google-plus',
	'third_url'=>'',
	'fourth_social'=>'linkedin',
	'fourth_url'=>'',
	), $atts));
	
	if(is_numeric($img)) $img = wp_get_attachment_url( $img );

	switch ($type) {
		case '1':
			$out  = '<article class="our-team">';
			if(!empty($link)){
				$out .= '<figure><a href="'. $link .'"><img src="'. $img .'" alt=""></a></figure>';
				$out .= '<h2><a href="'. $link .'">'. $name .'</a></h2>';
			}
			else{
				$out .= '<figure><img src="'. $img .'" alt=""></figure>';
				$out .= '<figcaption><h2>'. $name .'</h2>';
			}
			$out .= '<h5>'. $title .'</h5>';
			$out .= '<p>'. $text .'</p></figcaption>';
			if($social=='enable'){
				$out .= '<div class="social-team">';
				if(!empty($first_url))
					$out .= '<a href="'. $first_url .'"><i class="fa-'. $first_social .'"></i></a>';
				if(!empty($second_url))
					$out .= '<a href="'. $second_url .'"><i class="fa-'. $second_social .'"></i></a>';
				if(!empty($third_url))
					$out .= '<a href="'. $third_url .'"><i class="fa-'. $third_social .'"></i></a>';
				if(!empty($fourth_url))
					$out .= '<a href="'. $fourth_url .'"><i class="fa-'. $fourth_social .'"></i></a>';
				$out .= '</div>';
			}
			$out .= '</article>';

		break;

		case '2':
			$out = '<article class="our-team2">';
			$out .= '<figure><img src="'. $img .'" alt=""></figure>';
			$out .= "<div class=\"content-team\">";
			if($social=='enable') {
				$out .= '<div class="social-team"><ul>';
				if(!empty($first_url))
					$out .= '<li class="first-social"><a href="'. $first_url .'"><i class="fa-'. $first_social .'"></i></a></li>';
				if(!empty($second_url))
					$out .= '<li class="second-social"><a href="'. $second_url .'"><i class="fa-'. $second_social .'"></i></a></li>';
				if(!empty($third_url))
					$out .= '<li class="third-social"><a href="'. $third_url .'"><i class="fa-'. $third_social .'"></i></a></li>';
				if(!empty($fourth_url))
					$out .= '<li class="fourth-social"><a href="'. $fourth_url .'"><i class="fa-'. $fourth_social .'"></i></a></li>';
				$out .= '</ul></div>';
			}
			$out .= '<h2>'. $name .'</h2>';
			$out .= '<h5>'. $title .'</h5>';
			$out .= '<p>'. $text .'</p>';
			$out .= '</div>';
			$out .= '</article>';	
		break;
		
		case 3:	
			$out = "<article class=\"our-team3 clearfix\">";
			$out .= '<figure><img src="'. $img .'" alt=""></figure>';
			$out .= "<div class=\"tdetail\">";
			$out .= '<h2>'. $name .'</h2>';
			$out .= '<h5>'. $title .'</h5>';
			if($social=='enable') {
				$out .= '<div class="social-team">';
				if(!empty($first_url))
					$out .= '<a href="'. $first_url .'"><i class="fa-'. $first_social .'"></i></a>';
				if(!empty($second_url))
					$out .= '<a href="'. $second_url .'"><i class="fa-'. $second_social .'"></i></a>';
				if(!empty($third_url))
					$out .= '<a href="'. $third_url .'"><i class="fa-'. $third_social .'"></i></a>';
				if(!empty($fourth_url))
					$out .= '<a href="'. $fourth_url .'"><i class="fa-'. $fourth_social .'"></i></a>';
				$out .= '</div>';
			}
			$out .= '</div>';

			$out .= '</article>';
		break;
		
	}

return $out;
}
add_shortcode('ourteam','webnus_ourteam');


?>