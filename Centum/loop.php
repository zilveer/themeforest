<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage centum
 * @since centum 1.0
 */
?>

<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">



		<!-- Page Title -->
		<div id="page-title">
			<?php if (is_search()) { ?>
				<h2 ><?php printf( __( 'Search Results for: %s', 'centum' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			<?php } elseif(is_archive()) {  
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				  } else { ?>
			<h1><?php
                $pp_blog_page = ot_get_option('incr_blog_page');
                if (function_exists('icl_register_string')) {
                    icl_register_string('Blog page title','pp_blog_page', $pp_blog_page);
                    echo icl_t('Blog page title','pp_blog_page', $pp_blog_page);
                } else {
                    echo $pp_blog_page;
                }
            ?></h1>
			<?php } ?>
			<div id="bolded-line"></div>
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->

<!-- 960 Container -->
<div class="container">

<!-- Blog Posts
	================================================== -->
	<div class="twelve columns <?php if(ot_get_option('blog_layout') == 'left-sidebar'){ echo "left-sb"; } ?>">

		<!-- Post -->
		<?php /* If there are no posts to display, such as an empty archive page */ ?>
        <?php if (!have_posts()) : ?>
	        <div class="post page post404" >
				<p>
					<?php _e('Apologies, but no results were found for the requested archive.', 'centum'); ?>
	            </p>
	 			<ul class="tabs-nav">
	               
	                <li><a href="#tab2"><?php _e( 'Posts by title', 'centum' ); ?></a></li>
	                <li><a href="#tab3"><?php _e( 'By subject', 'centum' ); ?></a></li>
	            </ul>
	            <div class="tabs-container">
	                
	                <div id="tab2" class="tab-content">
	                    <ul class="circle_list">
	                        <?php wp_get_archives(array('type'=> 'alpha','limit' => '50', 'format' => 'html', 'show_post_count' => true )); ?>
	                    </ul>
	                </div>
	                <div id="tab3" class="tab-content">
	                    <ul class="circle_list">
	                        <?php wp_list_categories(array('pad_counts'=> true, 'title_li' => '')); ?>
	                    </ul>
	                </div>
	            </div>

			</div>
        <?php endif;

        while (have_posts()) : the_post(); ?>

		<div <?php
            $showthumb = get_post_meta($post->ID, 'incr_feattype', true);
            if($showthumb!='hide_thumb'){ 
            	$class = 'loop'; 
            	if(!has_post_thumbnail()){
            		$class = 'loop hidden-thumbnail'; 
            	}
            } else { 
            	$class = 'loop hidden-thumbnail'; 
            } post_class($class); ?> id="post-<?php the_ID(); ?>" >

			<?php
			// Check what to display above post title (image,vide, slideshow)
			global $shortname;
			$feat_type = get_post_meta($post->ID, 'incr_feattype', true);

		    if(function_exists( 'get_post_format' ) && get_post_format( $post->ID ) != 'gallery' && get_post_format( $post->ID ) != 'video' && has_post_thumbnail()) {
                $showthumb = get_post_meta($post->ID, 'incr_feattype', true);
                if($showthumb!='hide_thumb') {
                    $thumbbig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' )
                    ?>
                    <div class="post-img picture">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <div class="image-overlay-link"></div>
                        </a>
                    </div>
                <?php }
            } 

			if (( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) )  ) {
                $videoembed = get_post_meta($post->ID, 'incr_video_embed', true);
                if($videoembed) {
                        echo '<div class="embed video-cont">'.$videoembed.'</div>';
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
										<img src="<?php echo $thumb[0] ?>" class="rsImg" alt="<?php echo $image->post_title; ?>" />
										<div class="image-overlay-zoom"></div>
									</a>
								</div>
							

						<?php	} ?>
					
				</div>
				<?php }
				wp_reset_postdata();
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
						<h2>
							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'centum'), the_title_attribute('echo=0')); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h2>
					</div>
					<?php centum_posted_on(); ?>
					
					<div class="post-description">
						<?php 
						if(ot_get_option('centum_blog_content','excerpt') == 'excerpt') {
							the_excerpt();
						} else {
							the_content();
						}
						?>

					</div>
					<a class="button medium color post-entry" href="<?php the_permalink(); ?>"><?php  _e('Continue Reading', 'centum'); ?></a>
				</div>
		</div>
		<!-- Post -->
		<?php endwhile; // End the loop. Whew.  ?>

		<div class="pagination">
			<?php if(function_exists('wp_pagenavi')) :
			wp_pagenavi();
			else:
				if ($wp_query->max_num_pages > 1) : ?>
			<nav id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('&larr; Older posts', 'centum')); ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts &rarr;', 'centum')); ?></div>
			</nav><!-- #nav-below -->
			<?php endif;
			endif; ?>

		</div>

		</div> <!-- eof eleven column -->

