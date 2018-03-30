<?php 
	get_header();
?>

<?php 
	global $post;
	$l = et_page_config();

    $blog_slider = etheme_get_option('blog_slider');
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
						
						<?php if (etheme_get_option('blog_featured_image') && !etheme_get_custom_field('post_featured')): ?>
							
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
						    
							<?php elseif(has_post_thumbnail()): ?>
								<div class="wp-picture">
									<?php the_post_thumbnail('large'); ?>
									<div class="zoom">
										<div class="btn_group">
											<a href="<?php echo etheme_get_image(); ?>" class="btn btn-black xmedium-btn" rel="pphoto"><i class="fa fa-search-plus"></i></span></a>
										</div>
										<i class="bg"></i>
									</div>
								</div>
							<?php endif; ?>
						
						<?php endif ?>

                        <?php if($post_format != 'quote'): ?>
                            <h6 class="active"><?php the_category(',&nbsp;') ?></h6>

                            <h2><?php the_title(); ?></h2>

                        	<?php et_byline(); ?>
                        	
                        <?php endif; ?>

                        <?php if($post_format != 'quote' && $post_format != 'video' && $post_format != 'gallery'): ?>
                            <div class="content-article">
                                    <?php the_content(); ?>
                            </div>
                        <?php elseif($post_format == 'gallery'): ?>
                            <div class="content-article">
                                <?php echo $filtered_content; ?>
                            </div>
                        <?php endif; ?>

						<?php the_tags( __('<div class="single-tags"><span>Tags</span> ', ET_DOMAIN), ', ', '</div>'); ?>

					
						<?php if(etheme_get_option('post_share')): ?>
							<div class="share-post">
								<?php echo do_shortcode('[share title="'.__('Share Post', ET_DOMAIN).'"]'); ?>
							</div>
						<?php endif; ?>

						<div class="clear"></div>

						<?php if(etheme_get_option('posts_links')): ?>
							<?php etheme_project_links(array()); ?>
						<?php endif; ?>
						
						
						<?php if(etheme_get_option('about_author')): ?>
							<div class="author-info">
								<a class="pull-left" href="#">
									<?php echo get_avatar( get_the_author_meta('email') , 90 ); ?>
								</a>
								<div class="media-body">
									<h4 class="title-alt"><span><?php _e('About Author', ET_DOMAIN); ?></span></h4>
									<h4 class="media-heading"><?php the_author_link(); ?></h4>
									<?php echo get_the_author_meta('description'); ?>
									<p>
										<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
											<?php printf( __( 'Other posts by %s', ET_DOMAIN ), get_the_author() ); ?>
										</a>
									</p>
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

					<h1><?php _e('No posts were found!', ET_DOMAIN) ?></h1>

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