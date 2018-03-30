<?php
get_header();
GLOBAL $webnus_options;
?>

<section id="headline" style="<?php if(!empty($titlebar_bg)) echo ' background-color:'.$titlebar_bg.';'; ?>">
    <div class="container">
		<h2 style="<?php if(!empty($titlebar_fg)) echo ' color:'.$titlebar_fg.';'; if(!empty($titlebar_fs)) echo ' font-size:'.$titlebar_fs.';';  ?>"><?php printf( __( 'Author Archives: %s', 'WEBNUS_TEXT_DOMAIN' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h2><br />
    </div>
</section>

<section id="main-content-pin">
	<hr class="vertical-space1">
	<div class="container">

		<div class="about-author-sec">		  
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
			<h5><?php the_author(); ?></h5>
			<p><?php echo get_the_author_meta( 'description' ); ?></p>
		</div> 

		<div id="pin-content">

			<?php if (have_posts()) : while (have_posts()) : the_post();
				$post_format = get_post_format(get_the_ID());
				$content = get_the_content(); ?>

			<article  class="pin-box entry -item">
				<div class="img-item"> <?php

					if(  $webnus_options->webnus_blog_featuredimage_enable() ) {
						global $featured_video;
						$meta_video = $featured_video->the_meta();
						
						if( 'video'  == $post_format || 'audio'  == $post_format) {	
							$pattern = '\\[' .'(\\[?)' ."(video|audio)" .'(?![\\w-])' .'(' .'[^\\]\\/]*' .'(?:' .'\\/(?!\\])' .'[^\\]\\/]*' .')*?' .')' .'(?:' .'(\\/)' .'\\]' .'|' .'\\]' .'(?:' .'(' .'[^\\[]*+' .'(?:' .'\\[(?!\\/\\2\\])' .'[^\\[]*+' .')*+' .')' .'\\[\\/\\2\\]' .')?' .')' .'(\\]?)';
							preg_match('/'.$pattern.'/s', $post->post_content, $matches);
							
							if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2]))) {
								$video = $matches[0];
								echo do_shortcode($video);
								$content = preg_replace('/'.$pattern.'/s', '', $content);
								
							} else if( (!empty( $meta_video )) && (!empty($meta_video['the_post_video'])) ) {
								echo do_shortcode($meta_video['the_post_video']);
							}

						} else if( 'gallery'  == $post_format) {		
							$pattern = '\\[' .'(\\[?)' ."(gallery)" .'(?![\\w-])' .'(' .'[^\\]\\/]*' .'(?:' .'\\/(?!\\])' .'[^\\]\\/]*' .')*?' .')' .'(?:' .'(\\/)' .'\\]' .'|' .'\\]' .'(?:' .'(' .'[^\\[]*+' .'(?:' .'\\[(?!\\/\\2\\])' .'[^\\[]*+' .')*+' .')' .'\\[\\/\\2\\]' .')?' .')' .'(\\]?)';
							preg_match('/'.$pattern.'/s', $post->post_content, $matches);
							
							if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2]))) {
								$ids = (shortcode_parse_atts($matches[3]));
								if(is_array($ids) && isset($ids['ids'])) $ids = $ids['ids'];
								echo do_shortcode('[vc_gallery onclick="link_no" img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'"  custom_links_target="_self"]');
								$content = preg_replace('/'.$pattern.'/s', '', $content);
							}
						} else {
							get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full' ) ); 
						}
					} ?>
				</div>

				<div class="pin-ecxt">
					<h6 class="blog-cat"><strong><?php _e('in','WEBNUS_TEXT_DOMAIN'); ?></strong> <?php the_category(', ') ?> </h6>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<p><?php echo get_the_excerpt(); ?></p>
				</div>
				<div class="pin-ecxt2">
					<div class="col1-3">
						<i class="fa-comment-o"></i>
						<span><?php echo get_comments_number() ?></span>
					</div>
					<div class="col1-3">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
						<p>
						<?php the_author_posts_link(); ?>
						</p>
					</div>
					<div class="col1-3">
						<h6 class="blog-date"><?php echo get_the_date('d M Y');?></h6>
					</div>
				</div>

			</article>
			<?php endwhile; endif; ?>

		</div><!-- end-pin-content -->

		<div class="vertical-space2"></div>

	</div> <!-- end container -->

	<section class="container aligncenter">
        <?php 
			if(function_exists('wp_pagenavi')) {
				wp_pagenavi();	
			}
	    ?>
        <hr class="vertical-space2">
    </section>

</section><!-- end-main-content-pin -->

<?php
wp_reset_query(); // Reset the Query Loop 
get_footer();