<?php
/**
 *  Template for single post regular layout
 * 
 * @package toranj
 * @author owwwlab
 */
?>

<?php get_header(); ?>

<!-- Page main wrapper -->
<div id="main-content">
	<div class="page-wrapper regular-page blog-single-alt" >
		<div class="container">
			
			<div class="row">

				<!-- Post Main area -->
				<div class="col-md-8">
					
					<div class="post mb-xlarge">
						
						<!-- Post thumb -->
						<?php if( locate_template(OWLAB_TEMPLATES . '/blog/format-'.get_post_format().'.php') ) : ?>
							<?php include(locate_template(OWLAB_TEMPLATES . '/blog/format-'.get_post_format().'.php')); ?>
						<?php endif; ?>

						<?php if (get_post_format() == false): ?>
							<?php include(locate_template(OWLAB_TEMPLATES . '/blog/format-standard.php')); ?>
						<?php endif; ?>
						<!-- /Post thumb -->

						<!-- Post Content -->
						<div class="post-content">
							<div class="post-content-wrapper">
								
								<h2 class="post-header lined">
									<?php the_title(); ?>
								</h2>

								<!-- post meta -->
								<div class="post-meta">                 
					                <?php 
										// Display the meta information
										owlab_post_meta();
									?>
								</div>

								<div id="post-content" class="post-main-content">
									<?php the_content(); ?>

									<div class="navigation"><p><?php echo paginate_links(); ?></p></div>
								</div>

								<?php owlab_sharing_btns_style1(); ?>

								<?php if ( ot_get_option('show_author_bio') == 'on' ): ?>
								<!-- author bio -->
                                <div class="author-bio">
                                            
                                        <!-- avatar -->
                                        <div class="avatar">
                                            <?php echo get_avatar(get_the_author_meta('ID') , '80'); ?>
                                        </div>
                                        <!-- end avatar --> 

                                        <div class="author-bio-content">
                                                        
                                            <h4>
                                            	<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
                                            		<?php echo get_the_author_meta('display_name'); ?>
                                            	</a>
                                            </h4>
                                            <p>
                                                <?php echo get_the_author_meta('description'); ?>
                                            </p>

                                        </div>                          
        
                                </div>
                                <!-- end author bio -->
                                <?php endif; ?>


                                <?php if( ot_get_option('show_related_posts') == 'on' ) : ?>
                                <!-- related posts -->
                                <div class="related-posts">
                                            
										<h4 class="lined"><?php _e('Related Posts' , 'toranj'); ?></h4>
                                            
										<?php $related_posts = owlab_get_related_posts(); ?>
                                    

                                </div><!-- end related posts -->
                                <?php endif; // end related posts check ?>


							</div>
						</div>
						<!-- /Post Content -->

					</div>

					<hr/>

					<!-- Post Navigation -->
					<?php if (ot_get_option('show_prev_next') == 'on'):?>
					<?php owlab_blog_single_paging_nav(); ?>
					<?php endif; ?>

					<!-- Post Comments -->
					<?php comments_template(); ?>
					<!-- /Post Comments -->
				</div>
				<!-- /Post Main area -->
				
				<!-- Page Sidebar -->
				<div class="col-md-4 regular-sidebar" role="complementary">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
				<!-- /Page Sidebar -->

			</div>
		</div>
	</div>
</div>
<!-- /Page main wrapper -->

<?php get_footer(); ?>