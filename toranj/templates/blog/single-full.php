<?php
/**
 *  Single blog post template / layout with full cover image and no sidebar
 * 
 * @package toranj
 * @author owwwlab
 */

$has_format_file = locate_template(OWLAB_TEMPLATES . '/blog/single-full-format-'.get_post_format().'.php');
?>

<?php get_header(); ?>

<!-- Page main wrapper -->
<div id="main-content">
	<div class="page-wrapper">
		<div id="blog-single">

			
			<?php if( $has_format_file ) : ?>
			
				<?php include(locate_template(OWLAB_TEMPLATES . '/blog/single-full-format-'.get_post_format().'.php')); ?>
			
			<?php else: ?>

				<?php if ( has_post_thumbnail() ): ?>
				<!-- Post header -->
				<div id="post-header" class="parallax-parent">

					<!-- Header image -->
					<div class="header-cover set-bg">
						<?php the_post_thumbnail('full',array(
							'class' => 'img-fit'
						)); ?>
					</div>
					<!-- /Header image -->

					<!-- Header content -->
					<div class="header-content tj-parallax" data-ratio="1">
						<div class="container">
							<h1 class="post-title">
								<?php the_title(); ?>
							</h1>
						</div>
					</div>
					<!-- /Header content -->
					

				</div>
				<!-- /Post header -->
				<?php endif; ?>
				
				<div class="container">

					<!-- Post body -->
					<div id="post-body">
						<div class="row">

							<!-- Post sidebar -->
							<div id="post-side" class="col-md-3">

								<!-- Post meta -->
								<div class="post-meta">
									<?php owlab_post_meta_single_full(); ?>
								</div>
								<!-- /Post meta -->

								<?php owlab_sharing_btns_style1(); ?>

							</div>
							<!-- /Post sidebar -->

							<!-- Post main area -->
							<div class="col-md-9">
								<div class="post mb-xlarge">
									<?php if(!$has_format_file): ?>
									<h1 class="lined"><?php the_title(); ?></h1>
									<?php endif; ?>
									<!-- Post Content -->
									<div id="post-content">
										<?php the_content(); ?>
									</div>
									<!-- /Post Content -->


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
	                            <hr />

								<!-- Post Navigation -->
								<?php if (ot_get_option('show_prev_next') == 'on'):?>
								<?php owlab_blog_single_paging_nav(); ?>
								<?php endif; ?>


								<!-- Post Comments -->
								<?php comments_template(); ?>
								<!-- /Post Comments -->

								<!-- BACK TO TOP SECTION -->
								<hr/>
								<a class="back-to-top" href="#"></a>
								<div class="clearfix"></div>

							</div>
							<!-- /Post main area -->

						</div>
					</div>
					<!-- /Post body -->

					

				</div>

			<?php endif; //end for format check ?>

		</div>
	</div>
</div>
<!-- /Page main wrapper -->
<?php get_footer(); ?>