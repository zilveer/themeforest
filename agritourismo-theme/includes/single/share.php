<?php
	
	//social share icons
	$shareAll = get_option(THEME_NAME."_share_all");
	$shareSingle = get_post_meta( $post->ID, THEME_NAME."_share_single", true ); 
	$image = get_post_thumb($post->ID,0,0); 
?>

	<?php if($shareAll == "show" || ($shareAll=="custom" && $shareSingle=="show")) { ?>

		<!-- BEGIN .social-icon-block -->
		<div class="social-icon-block">
			<a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" data-url="<?php the_permalink();?>" data-url="<?php the_permalink();?>" class="ot-share">
				<span class="facebook-color"><?php _e("Facebook", THEME_NAME);?></span>

			</a>
			<a href="#" data-hashtags="" data-url="<?php the_permalink();?>" data-via="<?php echo get_option(THEME_NAME.'_twitter_name');?>" data-text="<?php the_title();?>" class="ot-tweet">
				<span class="twitter-color"><?php _e("Twitter", THEME_NAME);?></span>

			</a>
			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="small-likes-icon ot-pluss">
				<span class="google-color"><?php _e("Google+", THEME_NAME);?></span>

			</a>
			<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image['src']; ?>&description=<?php the_title(); ?>" data-url="<?php the_permalink();?>" class="ot-pin">
				<span class="pinterest-color"><?php _e("Pinterest", THEME_NAME);?></span>

			</a>
			<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php the_title();?>" data-url="<?php the_permalink();?>" class="ot-link">
				<span class="linkedin-color"><?php _e("LinkedIn", THEME_NAME);?></span>

			</a>
		<!-- END .social-icon-block -->
		</div>

		<div class="split-line-1"></div>
	<?php } ?>