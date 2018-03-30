<?php
/**
 * @package Centum
 */
?>

<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">

		<!-- Page Title -->
		<div id="page-title">
			<h2><?php    $pp_blog_page = ot_get_option('incr_blog_page');
                if (function_exists('icl_register_string')) {
                    icl_register_string('Blog page title','pp_blog_page', $pp_blog_page);
                    echo icl_t('Blog page title','pp_blog_page', $pp_blog_page);
                } else {
                    echo $pp_blog_page;
                } ?></h2>

			<div id="portfolio-navi">
				<?php if (!get_adjacent_post(false, '', false)) { echo '<a href="#" class="prev off"></a>' ;} else { ?> <a class="prev" href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>"></a> <?php } ?>
				<?php if (!get_adjacent_post(false, '', true)) { echo '<a href="#" class="next off"></a>' ;} else { ?> <a class="next" href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>"></a> <?php } ?>
			</div>
			<div class="clear"></div>

			<div id="bolded-line"></div>
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->


<!-- 960 Container -->
<div class="container">

	<?php

	$sidebar_side = get_post_meta($post->ID, 'incr_sidebar_layout', true);

	?>
<!-- Blog Posts
	================================================== -->
	<div class="twelve columns <?php if($sidebar_side == "left-sidebar") { echo "left-sb"; } ?>">

		<!-- Post -->

		<?php while (have_posts()) : the_post(); ?>

		<div <?php
            $showthumb = get_post_meta($post->ID, 'incr_feattype', true);
            if($showthumb!='hide_thumb'){ 
            	$class = ''; 
            	if(!has_post_thumbnail()){
            		$class = 'hidden-thumbnail'; 
            	}
            } else { 
            	$class = 'hidden-thumbnail'; 
            } post_class($class); ?> id="post-<?php the_ID(); ?>" >

			<?php
			// Check what to display above post title (image,vide, slideshow)
			global $shortname;
			$feat_type = get_post_meta($post->ID, 'incr_feattype', true);

			if(function_exists( 'get_post_format' ) && get_post_format( $post->ID ) != 'gallery' && get_post_format( $post->ID ) != 'video' && has_post_thumbnail()) {
				$showthumb = get_post_meta($post->ID, 'incr_feattype', true);
                if($showthumb!='hide_thumb'){
                $thumbbig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' )
				?>
				<div class="post-img picture">
					<a rel="image" href="<?php echo $thumbbig[0]; ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail(); ?>
						<div class="image-overlay-zoom"></div>
					</a>
				</div>
				<?php }
                } ?>

				<?php
				if (( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) )  ) {
					$videoembed = get_post_meta($post->ID, 'incr_video_embed', true);
					if($videoembed) {
							echo '<div class="embed video-cont">'.do_shortcode($videoembed).'</div>';
					} else {
						global $wp_embed;
						$videolink = get_post_meta($post->ID, 'incr_video_link', true);

						$post_embed = $wp_embed->run_shortcode('[embed  width="600" height="360"]'.$videolink.'[/embed]') ;
						echo '<div class="embed video-cont">'.$post_embed.'</div>';
					}
				}

				if (( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) )  ) {
							$ids = get_post_meta($post->ID, 'pp_gallery_slider', TRUE);
                    $args = array(
                      'post_type' => 'attachment',
                      'post_status' => 'inherit',
                      'post_mime_type' => 'image',
                      'post__in' => explode( ",", $ids),
                      'posts_per_page' => '-1',
                      'orderby' => 'post__in'
                      );


                    $images_array = get_posts( $args );

                    	// continued from above ...
					if($images_array){ ?>
					<div class="basic-slider royalSlider rsDefault">
						<?php foreach($images_array as $image){
							$attachment = wp_get_attachment_image_src($image->ID, 'large');
							$thumb = wp_get_attachment_image_src($image->ID, 'post-thumbnail');
							?>
							
							<div class="picture">
								<a href="<?php echo $attachment[0] ?>"  rel="image-gallery" title="<?php echo $image->post_title; ?>" >
									<img src="<?php echo $thumb[0] ?>" alt="<?php echo $image->post_title; ?>" />
									<div class="image-overlay-zoom"></div>
								</a>
							</div>
						
						<?php } ?>
					</div>
					<?php }
					}
					if ( function_exists( 'get_post_format' )) {  
						if(has_post_format( 'video' , $post->ID )){ ?>
							<a href="#" class="post-icon"><i class="fa fa-film"></i></a>
						<?php } else if(has_post_format( 'gallery' , $post->ID )){ ?>
							<a href="#" class="post-icon"><i class="fa fa-image"></i></a>
						<?php } else if(has_post_format( 'audio' , $post->ID )){ ?>
							<a href="#" class="post-icon"><i class="fa fa-music"></i></a>
						<?php } else { ?>
							<a href="#" class="post-icon"><i class="fa fa-file"></i></a>
						<?php } 
					} else {  ?>
						<a href="#" class="post-icon"><i class="fa fa-file"></i></a>
					<?php } ?>
					<div class="post-content">
						<div class="post-title">
							<h1 class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'centum'), the_title_attribute('echo=0')); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h1>
						</div>
						<?php centum_posted_on(); ?>
						<div class="post-description">
							<?php the_content() ?>
							<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'centum' ),
								'after'  => '</div>',
								) );
							?>
						</div>

						</div>
					</div>
					<!-- Post -->
				<?php endwhile; // End the loop. Whew.  ?>

				<?php if(ot_get_option('centum_comments','no') == 'no') { comments_template('', true); } ?>

			</div> <!-- eof eleven column -->

