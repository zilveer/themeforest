<?php

//add_action( 'init', 'sc_button' );
function sc_button() {
	add_filter("mce_external_plugins", "sc_add_buttons");
    add_filter('mce_buttons', 'sc_register_buttons');
}	
function sc_add_buttons($plugin_array) {
	$plugin_array['sc_button'] = get_template_directory_uri() . '/shortcodes/sc_button.js';
	return $plugin_array;
}
function sc_register_buttons($buttons) {
	array_push( $buttons, 'shortcodeButton' ); 
	return $buttons;
}


if ( is_admin() ) {
  
    if ( 
	   ( current_user_can( 'edit_posts' ) 
	   || current_user_can( 'edit_pages' ) ) 
	  && 'true' == get_user_option( 'rich_editing' ) 
    ) {
     add_action( 'admin_footer', 'sc_dialog' );
    }
}

function sc_dialog() {


$content_slider = array (
	'Title'=>'[title_slider]Title[/title_slider]'
);
$issues = array (
	'Issues'=>'[issues icon="true" number="3"]'
);
$team = array (
	'Team'=>'[team title="MEET OUR TEAM" number="8" cat=""]',
	'Team 3 column'=>'[team3 title="MEET OUR TEAM" number="8" cat=""]',
	'Team 4 column'=>'[team4 title="MEET OUR TEAM" number="8" cat=""]'
);

$tooltip = array (
'Tooltip' => '[tooltip placement="top" title="Title"] Tooltip [/tooltip]',
'Highlight' => '[highlight] Highlight [/highlight]'
);


$tables = array (
	'Table' => '[table1 title="Tables"]<table>
							
							<tr>
								<th>Header 1</th>
								<th>Header 2</th>
								<th>Header 3</th>
							</tr>
							
							<tr>
								<td>Item#1</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#2</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#3</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#4</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#5</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#6</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#7</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td><strong>Total:</strong></td>
								<td><strong>Lacinia fermentum</strong></td>
								<td><strong>55</strong></td>
							</tr>
							
						</table>[/table1]',
						
	'Pricing Table' => '[table2 title="PRICING TABLES"]	
			<table class="pricing-tables">
							<tr>
								
								<td>
									
									<div class="pricing-table">
										
										<div class="pricing-header">
											<h4>Basic</h4>
										</div>
										
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">9</span>
											<span class="period">/ mo</span>
										</div>
										
										<ul class="pricing-features">
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
										</ul>
										
										<div class="pricing-button">
											<a href="#" class="button big">Sign up</a>
										</div>
										
									</div>
									
								</td>
								
								<td>
									
									<div class="pricing-table most-popular">
										
										<div class="pricing-header">
											<h4>Pro</h4>
											<span>Most Popular</span>
										</div>
										
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">19</span>
											<span class="period">/ mo</span>
										</div>
										
										<ul class="pricing-features">
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
											<li>Elementum vel cursus</li>
										</ul>
										
										<div class="pricing-button">
											<a href="#" class="button big">Sign up</a>
										</div>
										
									</div>
									
								</td>
								
								<td>
									
									<div class="pricing-table">
										
										<div class="pricing-header">
											<h4>Advanced</h4>
										</div>
										
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">29</span>
											<span class="period">/ mo</span>
										</div>
										
										<ul class="pricing-features">
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
										</ul>
										
										<div class="pricing-button">
											<a href="#" class="button big">Sign up</a>
										</div>
										
									</div>
									
								</td>
								
								<td>
									
									<div class="pricing-table">
										
										<div class="pricing-header">
											<h4>Business</h4>
										</div>
										
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">39</span>
											<span class="period">/ mo</span>
										</div>
										
										<ul class="pricing-features">
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
										</ul>
										
										<div class="pricing-button">
											<a href="#" class="button big">Sign up</a>
										</div>
										
									</div>
									
								</td>
								
							</tr>
						</table>
		[/table2]'
);



$misc = array (
	'Text' => '[form_text title="Text"]',
	'Radio' => '[form_radio title="Radio"]',
	'Checkbox' => '[form_checkbox title="Checkbox"]',
	'Select' => '[form_select title="Select"]',
	'Textarea' => '[form_textarea title="Textarea"]',
	'Notification' => '[form_notification title="Input with warning" type="warning" ]Something may have gone wrong[/form_notification]'

);




//Categories
$categories = array (  			
	'Slider-content' => $content_slider,
	'Issues' => $issues,
	'Team' => $team,
	'Tooltip-highlight' => $tooltip,
	'Table' => $tables,
	'Forms' => $misc
	);


$page = '';
$i = '0';


	echo '<div  style="display:none;"><div id="my_plugin_dialog">';
	?>
	
		<div id="my_sidebar">
			<div id="my-nav">
				<ul class="sc_activate_nav">
				<?php
					foreach ( $categories as $name => $shortcodes ) {
						$cls = '';
						
						if ( $i == '0') { $cls = ''; }
						echo '<li><a rel="" href="#sc_page_'.$name.'" class="normal '.$cls.'">'.$name.'</a></li>';
					
						
							$page .= '<div id="sc_page_'.$name.'" class="sc_page">';
								$page .= '<h4 class="heading">'.$name.'</h4>';
								foreach ( $shortcodes as $shortcode_name => $shortcode_value ) {
									$page .= '<div class="my_sc_container"><div class="my_sc_title">'.$shortcode_name.'</div><div class="my_shortcode_text">'.$shortcode_value.'</div></div>';
								}
							$page .= '</div>';
						
						$i++;
					}
				?>
				</ul>
			</div>
		</div>	
				<div id="content">
						<?php echo $page;?>
				</div>	
		
	
	<?php
	echo '</div></div>';
}







//content_slider///////////////////////////////////////////////////////////////////////////////////////////////

//////content_title//////
function shortcode_title_slider( $atts, $content = null ) {
	$res ='';
	$res .= '<div class = "title_slider">
				<h4 class="great-vibes" >' . do_shortcode($content) . '</h4>
			</div>';

	return $res;	
}
add_shortcode('title_slider', 'shortcode_title_slider');


//content_ios_text////////////////////
function shortcode_content_ios_text( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"price" => '',
		"title1" => ''
	), $atts));
	$res ='';
	$res .= '<div class = "desc">
				<h3>' . $title1 . '</h3>
				<span>' . do_shortcode($content) . ' <span class="price" style="color: #2c3e50 !important;">' . $price . '</span></span>
			</div>';
			
	return $res;	
}
add_shortcode('content_ios_text', 'shortcode_content_ios_text');


//but_ios////////////////////
function shortcode_but_ios( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"size" => '',
		"color" => '',
		"url" => '',
		"target" => '',
		"title" => ''
	), $atts));
	$res ='';
	$res .= '<div class = "button">
				<a class="button ' . $size . ' ' . $color . '" href="' . $url . '" target="' . $target . '" >' . $title . '</a>
			</div>';

	return $res;	
}
add_shortcode('but_ios', 'shortcode_but_ios');







////////////issues///////////////////////////////////////////////////////////////////////////////////////////////////////
function shortcode_issues( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"icon" => '',
		"number" => '3'
	), $atts));
	$output ='';
	
	
	global $post;
	$tmp_post = $post;
	
	$args = array('numberposts'=> $number, 'post_type'=>'issues');
	$myposts = get_posts($args);
	$output = '';
	$output .= '<div class="row">';
		
	$setting1 = array();
	$setting1['options'] = candidat_custom_fontello_classes();
		
		foreach( $myposts as $post ) : setup_postdata($post);
			global $post;
			$des = get_the_excerpt();
			$des = candidat_the_excerpt_max_charlength_text($des, 17);
			$ico = get_meta_option('issues_icon_meta_box');
			$ico = $setting1['options'][$ico];
			
		
		
		$output .= '<div class="col-lg-4 col-md-4 col-sm-12 animate-onscroll">
								
				<div class="issue-block">';
		if($icon == 'true') {			
		$output .= '<div class="issue-icon">
						<i class="icons '. $ico .'"></i>
					</div>';
		} else {			
		$output .= '<div class="issue-image">';
		$output .=	get_the_post_thumbnail($post->ID, 'post-blog');	
		$output .= '</div>';
		}		
		$output .= '<div class="issue-content">
					
						<h4>'. get_the_title($post->ID) .' </h4>
						<p>'. $des .'</p>
						
						<a class="button big button-arrow" href="'. get_permalink() .'">'. __('Read more', 'candidate') .'</a>
					
					</div>
					
				</div>
				
			</div>';

				endforeach; 
		$output .= '</div>';
	
	
	
	$post = $tmp_post; 
	return $output;	
}
add_shortcode('issues', 'shortcode_issues');

////////////team///////////////////////////////////////////////////////////////////////////////////////////////////////
function shortcode_team( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => '',
		"number" => '8',
		"cat" => ''
	), $atts));
	$output ='';
	
	global $post;
	$tmp_post = $post;
	
	$tt = 0;
	$team_member_class='big';
	
	
	//$my_cat = $cat;
	$term = get_term( $cat, 'team-category' );
	if( !empty($term->slug) ) {
	$my_cat = $term->slug;
	}


	$args = array('numberposts'=> $number, 'post_type'=>'team_members', 'team-category' => $my_cat);
	$myposts = get_posts($args);
	$output = '';
	$output .= '<h3 class="animate-onscroll no-margin-top">'. $title .'</h3>';
	$max = count($myposts);
	
		foreach( $myposts as $post ) : setup_postdata($post);
			$tt++;
			global $post;
			$title1 = get_the_title();
			$des = get_the_excerpt();
			$social = get_meta_option('team_social_show_meta_box');
			$share = get_meta_option('team_share_show_meta_box');
			$job = get_meta_option('team_job_meta_box');

			if($tt == 1) 
			{
			$des = candidat_the_excerpt_max_charlength_text($des, 97);
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'team1'); 
			} else {
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'team1'); 
			}
			$team_member = array(
							'facebook' => get_meta_option('team_facebook_meta_box'),
							'twitter' => get_meta_option('team_twitter_meta_box'),
							'google' => get_meta_option('team_google_meta_box'),
							'youtube' => get_meta_option('team_youtube_meta_box'),
							'flickr' => get_meta_option('team_flickr_meta_box'),
							'instagram' => get_meta_option('team_instagram_meta_box'),
							'linkedin' => get_meta_option('team_linkedin_meta_box'),
							'email' => get_meta_option('team_mail_meta_box'),
							'twitter-follow' => '#'
						);
						
			
			if($tt == 2) 
			{	
			$output .= '<div class="row">';
			}
			if($tt >= 2  && $tt <= 4) 
			{	
			$des = candidat_the_excerpt_max_charlength_text($des, 37);
			$output .= '<div class="col-lg-4 col-md-4 col-sm-6">';
			}
			if($tt > 4) 
			{
			$des = candidat_the_excerpt_max_charlength_text($des, 15);			
			$output .= '<div class="col-lg-3 col-md-3 col-sm-6">';
			}
		
			$output .= '<div class="team-member animate-onscroll '. $team_member_class .'">
									
									<img class="team-member-image" src="'. $thumb_image_url[0] .'" alt="">
									
									<div class="team-member-info">
										
										<h2><a href="'. esc_url(get_permalink($post->ID)) .'" class="team-link">'. $title1 .'</a></h2>
										<span class="job">'. $job .'</span>
										
										<div class="team-member-more">
											'. $des .' ';

											
			if($social != 'hide') {		
								$output .= '<div class="social-media">
												<span class="small-caption">'. __('Get connected','candidate') .':</span>
												<ul class="social-icons">';
													
													
													if(isset($team_member['facebook']) && $team_member['facebook'] !='' ) {
				$output .= '<li class="facebook"><a href="'.$team_member['facebook'].'" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>';
											}
											
													if(isset($team_member['twitter']) && $team_member['twitter'] !='' ) {
				$output .= '<li class="twitter"><a href="'.$team_member['twitter'].'" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>';
											}
											
													if(isset($team_member['google']) && $team_member['google'] !='' ) {
				$output .= '<li class="google"><a href="'.$team_member['google'].'" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>';
											}
											
													if(isset($team_member['youtube']) && $team_member['youtube'] !='' ) {
				$output .= '<li class="youtube"><a href="'.$team_member['youtube'].'" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>';
											}
											
													if(isset($team_member['flickr']) && $team_member['flickr'] != '') {
				$output .= '<li class="flickr"><a href="'.$team_member['flickr'].'" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>';
											}		
												
				
				
				if(isset($team_member['instagram']) && $team_member['instagram'] != '') {
				$output .= '<li class="instagram"><a href="'.$team_member['instagram'].'" class="tooltip-ontop" title="Instagram"><i class="icons icon-instagram-1"></i></a></li>';
											}		

				if(isset($team_member['linkedin']) && $team_member['linkedin'] != '') {
				$output .= '<li class="linkedin"><a href="'.$team_member['linkedin'].'" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin-1"></i></a></li>';
											}		

											
											
													if(isset($team_member['email']) && $team_member['email'] !='' ) {
				$output .= '<li class="email"><a href="'.$team_member['email'].'" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>';
											}			
													
				$output .= '</ul></div>';
											
			}			
			
		$output .= '</div>
										
									</div>
									
								</div>';
								
		if($tt >= 2) 
			{	
			$output .= '</div>';
			}
		
		
		if($tt >= 2 && $tt == $max) 
			{	
			$output .= '</div>';
			}
		
		$team_member_class='';
		
				endforeach; 
				
		$output .= '';
	
	
	
	$post = $tmp_post; 
	return $output;	
}
add_shortcode('team', 'shortcode_team');







function shortcode_team3( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => '',
		"number" => '8',
		"cat" => ''
	), $atts));
	$output ='';
	
	global $post;
	$tmp_post = $post;
	
	$tt = 0;
	$team_member_class='';
	
	
	//$my_cat = $cat;
	$term = get_term( $cat, 'team-category' );
	if( !empty($term->slug) ) {
	$my_cat = $term->slug;
	}


	$args = array('numberposts'=> $number, 'post_type'=>'team_members', 'team-category' => $my_cat);
	$myposts = get_posts($args);
	$output = '';
	$output .= '<h3 class="animate-onscroll no-margin-top">'. $title .'</h3>';
	$max = count($myposts);
	
	
		$output .= '<div class="row">';
		
		
		foreach( $myposts as $post ) : setup_postdata($post);
			$tt++;
			global $post;
			$title1 = get_the_title();
			$des = get_the_excerpt();
			$social = get_meta_option('team_social_show_meta_box');
			$share = get_meta_option('team_share_show_meta_box');
			$job = get_meta_option('team_job_meta_box');

			
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'team1'); 
			$team_member = array(
							'facebook' => get_meta_option('team_facebook_meta_box'),
							'twitter' => get_meta_option('team_twitter_meta_box'),
							'google' => get_meta_option('team_google_meta_box'),
							'youtube' => get_meta_option('team_youtube_meta_box'),
							'flickr' => get_meta_option('team_flickr_meta_box'),
							'instagram' => get_meta_option('team_instagram_meta_box'),
							'linkedin' => get_meta_option('team_linkedin_meta_box'),
							'email' => get_meta_option('team_mail_meta_box'),
							'twitter-follow' => '#'
						);
						
			
			
		
			
				
			$des = candidat_the_excerpt_max_charlength_text($des, 37);
			$output .= '<div class="col-lg-4 col-md-4 col-sm-6">';
			
			
		
			$output .= '<div class="team-member animate-onscroll '. $team_member_class .'">
									
									<img class="team-member-image" src="'. $thumb_image_url[0] .'" alt="">
									
									<div class="team-member-info">
										
										<h2><a href="'. esc_url(get_permalink($post->ID)) .'" class="team-link">'. $title1 .'</a></h2>
										<span class="job">'. $job .'</span>
										
										<div class="team-member-more">
											'. $des .' ';

											
											
			if($social != 'hide') {		
										$output .= '<div class="social-media">
												<span class="small-caption">'. __('Get connected','candidate') .':</span>
												<ul class="social-icons">';
													
													
													if(isset($team_member['facebook']) && $team_member['facebook'] !='' ) {
				$output .= '<li class="facebook"><a href="'.$team_member['facebook'].'" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>';
											}
											
													if(isset($team_member['twitter']) && $team_member['twitter'] !='' ) {
				$output .= '<li class="twitter"><a href="'.$team_member['twitter'].'" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>';
											}
											
													if(isset($team_member['google']) && $team_member['google'] !='' ) {
				$output .= '<li class="google"><a href="'.$team_member['google'].'" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>';
											}
											
													if(isset($team_member['youtube']) && $team_member['youtube'] !='' ) {
				$output .= '<li class="youtube"><a href="'.$team_member['youtube'].'" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>';
											}
											
													if(isset($team_member['flickr']) && $team_member['flickr'] != '') {
				$output .= '<li class="flickr"><a href="'.$team_member['flickr'].'" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>';
											}		
												


					if(isset($team_member['instagram']) && $team_member['instagram'] != '') {
				$output .= '<li class="instagram"><a href="'.$team_member['instagram'].'" class="tooltip-ontop" title="Instagram"><i class="icons icon-instagram-1"></i></a></li>';
											}		

				if(isset($team_member['linkedin']) && $team_member['linkedin'] != '') {
				$output .= '<li class="linkedin"><a href="'.$team_member['linkedin'].'" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin-1"></i></a></li>';
											}									
												
												
													if(isset($team_member['email']) && $team_member['email'] !='' ) {
				$output .= '<li class="email"><a href="'.$team_member['email'].'" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>';
											}			
													
				$output .= '</ul></div>';
			}	
				
		$output .= '</div>
										
									</div>
									
								</div>';
								
		
			$output .= '</div>';
			
		
		
		
	
		
		
		$team_member_class='';
		
				endforeach; 
				
		
		$output .= '</div>';
	
	
	$post = $tmp_post; 
	return $output;	
}
add_shortcode('team3', 'shortcode_team3');





function shortcode_team4( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => '',
		"number" => '8',
		"cat" => ''
	), $atts));
	$output ='';
	
	global $post;
	$tmp_post = $post;
	
	$tt = 0;
	$team_member_class='';
	
	
	
	
	//$my_cat = $cat;
	$term = get_term( $cat, 'team-category' );
	if( !empty($term->slug) ) {
	$my_cat = $term->slug;
	}

	
	$args = array('numberposts'=> $number, 'post_type'=>'team_members', 'team-category' => $my_cat);
	$myposts = get_posts($args);
	$output = '';
	$output .= '<h3 class="animate-onscroll no-margin-top">'. $title .'</h3>';
	$max = count($myposts);
	
	
		$output .= '<div class="row">';
		
		
		foreach( $myposts as $post ) : setup_postdata($post);
			$tt++;
			global $post;
			$title1 = get_the_title();
			$des = get_the_excerpt();
			$social = get_meta_option('team_social_show_meta_box');
			$share = get_meta_option('team_share_show_meta_box');
			$job = get_meta_option('team_job_meta_box');

			
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'team1'); 
			$team_member = array(
							'facebook' => get_meta_option('team_facebook_meta_box'),
							'twitter' => get_meta_option('team_twitter_meta_box'),
							'google' => get_meta_option('team_google_meta_box'),
							'youtube' => get_meta_option('team_youtube_meta_box'),
							'flickr' => get_meta_option('team_flickr_meta_box'),
							'instagram' => get_meta_option('team_instagram_meta_box'),
							'linkedin' => get_meta_option('team_linkedin_meta_box'),
							'email' => get_meta_option('team_mail_meta_box'),
							'twitter-follow' => '#'
						);
						
			
			
		
			
				
			$des = candidat_the_excerpt_max_charlength_text($des, 15);
			$output .= '<div class="col-lg-3 col-md-3 col-sm-6">';
			
			
		
			$output .= '<div class="team-member animate-onscroll '. $team_member_class .'">
									
									<img class="team-member-image" src="'. $thumb_image_url[0] .'" alt="">
									
									<div class="team-member-info">
										
										<h2><a href="'. esc_url(get_permalink($post->ID)) .'" class="team-link">'. $title1 .'</a></h2>
										<span class="job">'. $job .'</span>
										
										<div class="team-member-more">
											'. $des .' ';

			if($social != 'hide') {			
										$output .= '<div class="social-media">
												<span class="small-caption">'. __('Get connected','candidate') .':</span>
												<ul class="social-icons">';
													
													
													if(isset($team_member['facebook']) && $team_member['facebook'] !='' ) {
				$output .= '<li class="facebook"><a href="'.$team_member['facebook'].'" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>';
											}
											
													if(isset($team_member['twitter']) && $team_member['twitter'] !='' ) {
				$output .= '<li class="twitter"><a href="'.$team_member['twitter'].'" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>';
											}
											
													if(isset($team_member['google']) && $team_member['google'] !='' ) {
				$output .= '<li class="google"><a href="'.$team_member['google'].'" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>';
											}
											
													if(isset($team_member['youtube']) && $team_member['youtube'] !='' ) {
				$output .= '<li class="youtube"><a href="'.$team_member['youtube'].'" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>';
											}
											
													if(isset($team_member['flickr']) && $team_member['flickr'] != '') {
				$output .= '<li class="flickr"><a href="'.$team_member['flickr'].'" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>';
											}		
												




					if(isset($team_member['instagram']) && $team_member['instagram'] != '') {
				$output .= '<li class="instagram"><a href="'.$team_member['instagram'].'" class="tooltip-ontop" title="Instagram"><i class="icons icon-instagram-1"></i></a></li>';
											}		

				if(isset($team_member['linkedin']) && $team_member['linkedin'] != '') {
				$output .= '<li class="linkedin"><a href="'.$team_member['linkedin'].'" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin-1"></i></a></li>';
											}									



												
													if(isset($team_member['email']) && $team_member['email'] !='' ) {
				$output .= '<li class="email"><a href="'.$team_member['email'].'" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>';
											}			
													
				$output .= '</ul></div>';
				
			}	
		$output .= '</div>
										
									</div>
									
								</div>';
								
		
			$output .= '</div>';
			
		
		
		
	
		
		
		$team_member_class='';
		
				endforeach; 
				
		
		$output .= '</div>';
	
	
	$post = $tmp_post; 
	return $output;	
}
add_shortcode('team4', 'shortcode_team4');






/*--------------------------------------------------------------------------------------------------
	ToolTip
--------------------------------------------------------------------------------------------------*/
function bs_tooltip( $atts, $content=null ) {
	extract(shortcode_atts(array(
		"placement" => '',
		"title" => ''
	), $atts));	
	if ( empty ($placement) ) {
		
		$placement = 'top';
	}
	$tooltipt = '<a href="#" title="'.$title.'" class="mytooltip  tooltip-on'.$placement.'">'.$content.'</a>';
	return $tooltipt;
}
add_shortcode('tooltip', 'bs_tooltip');



/*--------------------------------------------------------------------------------------------------
	Highlight
--------------------------------------------------------------------------------------------------*/
function bs_highlight( $atts, $content=null ) {
	$tooltipt = '<span class="highlight">'.$content.'</span>';
	return $tooltipt;
}
add_shortcode('highlight', 'bs_highlight');





/*--------------------------------------------------------------------------------------------------
	TABLES styles
--------------------------------------------------------------------------------------------------*/
function bs_table1( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));	
	
	$output = '<h3>'.$title.'</h3>'.$content.'';

	return $output;
}
add_shortcode('table1', 'bs_table1');



function bs_table2( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));	
	
	$output = '<h3>'.$title.'</h3>'.$content.'';

	return $output;
}
add_shortcode('table2', 'bs_table2');


//////////////////////////////////////////////////////////////////////////////

function bs_form_text( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));	
	
	$output = '<label>'.$title.'</label>
						<input type="text">
						
						<br><br>';

	return $output;
}
add_shortcode('form_text', 'bs_form_text');



//////////////////////////////////////////////////////////////////////////////

function bs_form_radio( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));	
	
	$output = '<label>'.$title.'</label><br>
						<input type="radio" name="radiogroup" id="radio-1"><label for="radio-1">Radio 1</label>
						<input type="radio" name="radiogroup" id="radio-2"><label for="radio-2">Radio 2</label>
						<br><br>';

	return $output;
}
add_shortcode('form_radio', 'bs_form_radio');


//////////////////////////////////////////////////////////////////////////////

function bs_form_checkbox( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));	
	
	$output = '<label>'.$title.'</label><br>
						<input type="checkbox" id="checkbox-1"><label for="checkbox-1">Checkbox 1</label>
						<input type="checkbox" id="checkbox-2"><label for="checkbox-2">Checkbox 2</label>
						
						<br><br>';

	return $output;
}
add_shortcode('form_checkbox', 'bs_form_checkbox');


//////////////////////////////////////////////////////////////////////////////

function bs_form_select( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));	
	
	$output = '<label>'.$title.'</label>
						<select class="chosen-select form-select">
							<option>Please select</option>
							<option>Option 1</option>
							<option>Option 2</option>
							<option>Option 3</option>
							<option>Option 4</option>
							<option>Option 5</option>
						</select>
						
						<br><br>';

	return $output;
}
add_shortcode('form_select', 'bs_form_select');


//////////////////////////////////////////////////////////////////////////////

function bs_form_textarea( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));	
	
	$output = '<label>'.$title.'</label>
						<textarea rows="8"></textarea>
						
						<br><br>';

	return $output;
}
add_shortcode('form_textarea', 'bs_form_textarea');



//////////////////////////////////////////////////////////////////////////////

function bs_form_notification( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => '',
		"type" => ''
	), $atts));	
	
	$output = '<div class="notification-input">
							
							<label>'.$title.'</label>
							<div class="'.$type.'">
								<input type="text"><label>'.$content.'</label>
							</div></div>';

	return $output;
}
add_shortcode('form_notification', 'bs_form_notification');


?>