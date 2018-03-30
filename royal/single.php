<?php 
	get_header();
?>

<?php 

    $l = et_page_config();
    
    $blog_slider = etheme_get_option('blog_slider');
    $disable_featured = etheme_get_custom_field('disable_featured');
    $postspage_id = get_option('page_for_posts');
    $post_format = get_post_format();
    
    $post_content = $post->post_content;
    preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
    if(!empty($ids)) {
	    $attach_ids = explode(",", $ids[1]);
	    $content =  str_replace($ids[0], "", $post_content);
	    $filtered_content = apply_filters( 'the_content', $content);
    }
    
    $slider_id = rand(100,10000);
?>


<?php do_action( 'et_page_heading' ); ?>

<div class="container">
	<div class="page-content sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?>">
		<div class="row">
			
			<div class="content <?php esc_attr_e( $l['content-class'] ); ?>">
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>
				
					<article <?php post_class('blog-post post-single'); ?> id="post-<?php the_ID(); ?>" >
					
						<?php 
							$width = etheme_get_option('blog_page_image_width');
							$height = etheme_get_option('blog_page_image_height');
							$crop = etheme_get_option('blog_page_image_cropping');
						?>
						

						<?php if($post_format == 'quote' || $post_format == 'video'): ?>
					    
					            <?php the_content(); ?>
					        
						<?php elseif($post_format == 'gallery'): ?>
					            <?php if(count($attach_ids) > 0): ?>
					                <div class="post-gallery-slider slider_id-<?php echo $slider_id; ?>">
					                    <?php foreach($attach_ids as $attach_id): ?>
					                        <div>
					                            <?php echo wp_get_attachment_image($attach_id, 'large'); ?>
					                        </div>
					                    <?php endforeach; ?>
					                </div>
					    
					                <script type="text/javascript">
					                    jQuery('.slider_id-<?php echo $slider_id; ?>').owlCarousel({
					                        items:1,
					                        navigation: true,
					                        lazyLoad: false,
					                        rewindNav: false,
					                        addClassActive: true,
					                        singleItem : true,
					                        autoHeight : true,
					                        itemsCustom: [1600, 1]
					                    });
					                </script>
					            <?php endif; ?>
					    
						<?php elseif(has_post_thumbnail() && ! $disable_featured): ?>
							<div class="wp-picture">
								<?php the_post_thumbnail('large'); ?>
								<div class="zoom">
									<div class="btn_group">
										<a href="<?php echo etheme_get_image(); ?>" class="btn btn-black xmedium-btn" rel="pphoto"><span><?php _e('View large', ETHEME_DOMAIN); ?></span></a>
									</div>
									<i class="bg"></i>
								</div>
							</div>
						<?php endif; ?>

                        <?php if($post_format != 'quote'): ?>
                            <h6 class="active"><?php the_category(',&nbsp;') ?></h6>

                            <h2 class="entry-title"><?php the_title(); ?></h2>

                        	<?php if(etheme_get_option('blog_byline')): ?>
                                <div class="meta-post">
                                        <?php _e('Posted on', ETHEME_DOMAIN) ?>
                                        <?php the_time(get_option('date_format')); ?> 
                                        <?php _e('at', ETHEME_DOMAIN) ?> 
                                        <?php the_time(get_option('time_format')); ?>
                                        <?php _e('by', ETHEME_DOMAIN);?> <span class="vcard"> <span class="fn"><?php the_author_posts_link(); ?></span></span>
                                        <?php // Display Comments 

                                                if(comments_open() && !post_password_required()) {
                                                        echo ' / ';
                                                        comments_popup_link('0', '1 Comment', '% Comments', 'post-comments-count');
                                                }

                                         ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if($post_format != 'quote' && $post_format != 'video' && $post_format != 'gallery'): ?>
                            <div class="content-article entry-content">
                                    <?php the_content(); ?>
                            </div>
                        <?php elseif($post_format == 'gallery'): ?>
                            <div class="content-article entry-content">
                                <?php echo $filtered_content; ?>
                            </div>
                        <?php endif; ?>
					
						<?php if(etheme_get_option('post_share')): ?>
							<div class="share-post">
								<?php echo do_shortcode('[share title="'.__('Share Post', ETHEME_DOMAIN).'"]'); ?>
							</div>
						<?php endif; ?>
						
						<?php if(etheme_get_option('posts_links')): ?>
							<?php etheme_project_links(array()); ?>
						<?php endif; ?>
						
						
						<?php if(etheme_get_option('about_author')): ?>
							<h4 class="title-alt"><span><?php _e('About Author', ETHEME_DOMAIN); ?></span></h4>
							
							<div class="author-info vcard">
								<a class="pull-left" href="#">
									<?php echo get_avatar( get_the_author_meta('email') , 90 ); ?>
								</a>
								<div class="media-body">
									<h4 class="media-heading url"><?php the_author_link(); ?></h4>
									<p class="note"><?php echo get_the_author_meta('description'); ?></p>
								</div>
							</div>
						<?php endif; ?>
						
						<?php if(etheme_get_option('post_related')): ?>
							<div class="related-posts">
								<?php et_get_related_posts(); ?>
							</div>
						<?php endif; ?>
					
					</article>


				<?php endwhile; else: ?>

					<h1><?php _e('No posts were found!', ETHEME_DOMAIN) ?></h1>

				<?php endif; ?>

				<?php comments_template('', true); ?>

			</div>

			<?php get_sidebar(); ?>

		</div>

	</div>
</div>
	
<?php
	get_footer();
?>