<?php
global $smof_data;

$about_title = $smof_data['team_about_title'];
$show_description = $smof_data['team_show_subtitleription'];
$excerpt_length = $smof_data['team_excerpt_length'];
$show_socials = $smof_data['team_show_socials'];
$crop_image = false;
$width_image = 200;
$height_image = 200;
?>
<article id="cs_post_<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row cs-item-team">
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 cs-team-details">
			<div class="cs-team-meta">
				<?php if(!empty($about_title)) { ?>
					<h3><?php echo $about_title; ?></h3>
				<?php } ?>
				<?php if ($show_description == true || $show_description == 1) { ?>
					<div class="cs-team-description"><?php echo substr(get_the_content(), 0, $excerpt_length); ?></div>
				<?php } ?>
				<?php if ($show_socials == true || $show_socials == 1) {
				$custom = get_post_custom($post->ID);
				$team_email = isset($custom['team_email'][0]) ? $custom['team_email'][0] : '';
				$team_facebook = isset($custom['team_facebook'][0]) ? $custom['team_facebook'][0] : '';
				$team_twitter = isset($custom['team_twitter'][0]) ? $custom['team_twitter'][0] : '';
				$team_google_plus = isset($custom['team_google_plus'][0]) ? $custom['team_google_plus'][0] : '';
				$team_dribbble = isset($custom['team_dribbble'][0]) ? $custom['team_dribbble'][0] : '';
				$team_youtube = isset($custom['team_youtube'][0]) ? $custom['team_youtube'][0] : '';
				$team_rss = isset($custom['team_rss'][0]) ? $custom['team_rss'][0] : '';
				$team_flickr = isset($custom['team_flickr'][0]) ? $custom['team_flickr'][0] : '';
				$team_linkedin = isset($custom['team_linkedin'][0]) ? $custom['team_linkedin'][0] : '';
				$team_vimeo = isset($custom['team_vimeo'][0]) ? $custom['team_vimeo'][0] : '';
				$team_tumblr = isset($custom['team_tumblr'][0]) ? $custom['team_tumblr'][0] : '';
				$team_pinterest = isset($custom['team_pinterest'][0]) ? $custom['team_pinterest'][0] : '';
				$team_sky = isset($custom['team_sky'][0]) ? $custom['team_sky'][0] : '';
				$team_github = isset($custom['team_github'][0]) ? $custom['team_github'][0] : '';
				$team_instagram = isset($custom['team_instagram'][0]) ? $custom['team_instagram'][0] : '';
				
				$links = array();
				$links[] = ($team_email!='')?'<li><a class="team-email" href="mailto:'.$team_email.'" target="_blank" title="Email"><i class="fa fa-envelope-o"></i></a></li>':'';
				$links[] = ($team_facebook!='')?'<li><a class="team-facebook" href="'.$team_facebook.'" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>':'';
				$links[] = ($team_twitter!='')?'<li><a class="team-twitter" href="'.$team_twitter.'" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>':'';
				$links[] = ($team_google_plus!='')?'<li><a class="team-google_plus" href="'.$team_google_plus.'" target="_blank" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>':'';
				$links[] = ($team_dribbble!='')?'<li><a class="team-dribbble" href="'.$team_dribbble.'" target="_blank" title="Dribble"><i class="fa fa-dribbble"></i></a></li>':'';
				$links[] = ($team_email!='')?'<li><a class="team-youtube" href="'.$team_youtube.'" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>':'';
				$links[] = ($team_rss!='')?'<li><a class="team-rss" href="'.$team_rss.'" target="_blank" title="Rss"><i class="fa fa-rss"></i></a></li>':'';
				$links[] = ($team_flickr!='')?'<li><a class="team-flickr" href="'.$team_flickr.'" target="_blank" title="Flickr"><i class="fa fa-flickr"></i></a></li>':'';
				$links[] = ($team_linkedin!='')?'<li><a class="team-linkedin" href="'.$team_linkedin.'" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>':'';
				$links[] = ($team_vimeo!='')?'<li><a class="team-vimeo" href="'.$team_vimeo.'" target="_blank" title="Vimeo"><i class="fa fa-vimeo-square"></i></a></li>':'';
				$links[] = ($team_tumblr!='')?'<li><a class="team-tumblr" href="'.$team_tumblr.'" target="_blank" title="Tumblr"><i class="fa fa-tumblr"></i></a></li>':'';
				$links[] = ($team_pinterest!='')?'<li><a class="team-pinterest" href="'.$team_pinterest.'" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>':'';
				$links[] = ($team_sky!='')?'<li><a class="team-skype" href="'.$team_sky.'" target="_blank" title="Skype"><i class="fa fa-skype"></i></a></li>':'';
				$links[] = ($team_github!='')?'<li><a class="team-github" href="'.$team_github.'" target="_blank" title="Github"><i class="fa fa-github"></i></a></li>':'';
				$links[] = ($team_instagram!='')?'<li><a class="team-instagram" href="'.$team_instagram.'" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>':'';
				
				if (!empty($links)) {
					$social_title = get_post_meta( $post->ID, '_cshero_team_social', true );
					if(!empty($social_title)){
						echo '<h3 class="cs-content-header">'.$social_title.'</h3>';
					}
					echo '<div class="cs-team-social"><ul class="cs-social">' . implode('', $links) . '</ul></div>';
				}
				
			 } ?>
			 </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9 cs-team-media">
			<?php
			if (has_post_thumbnail()){
				$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
				if($crop_image == true || $crop_image == 1){                                            
					$image_resize = matthewruddy_image_resize( $attachment_image[0], $width_image, $height_image, true, false );
					echo '<div class="cs-team-featured-img"><img class="attachment-featuredImageCropped" src="'. esc_attr($image_resize['url']) .'" /><span class="circle-border"></span></div>';
				}else{
				   echo '<div class="cs-team-featured-img"><img src="'. esc_attr($attachment_image[0]) .'" /><span class="circle-border"></span></div>';
				} 
			}
			?>
		</div>
	</div>
</article>