<?php 
$blog_with_sidebar = "";
if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];    
?>

<?php get_header(); ?>

    <div id="primary" class="content-area">                    

		<?php if ( $blog_with_sidebar == "yes" ) : ?>
            <div class="row"><div class="large-8 columns with-sidebar">
        <?php endif; ?>
                
                <div id="content" class="site-content" role="main">             

					<?php if ( have_posts() ) : ?>
									
						<!--masonry style-->
						<?php if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "2" ) ) : ?>
						
							<!--isotope listing-->
							<div class="blog-isotop-master-wrapper">
							
								<div class="row">
								<div class="large-12 columns">
								
									<div class="blog-isotop-container">
							
										<div id="filters" class="button-group">
											<button class="filter-item is-checked" data-filter="*">show all</button>
										</div>
							
										<div class="blog-isotope">
											<div class="grid-sizer"></div>
								
											<?php /* Start the Loop */ ?>
											<?php while ( have_posts() ) : the_post(); ?>
									
												<div class="blog-post hidden <?php echo get_post_format(); ?>">
													<div class="blog-post-inner">
													
														<h2 class="entry-title-archive">
															<a href="<?php the_permalink(); ?>" class="thumbnail_archive">
																<span class="thumbnail_archive_container">
																	<?php the_post_thumbnail('large'); ?>
																</span>
																<span class="entry-title-archive-text"><?php the_title(); ?></span>
															</a>
														</h2>
																 
														<div class="post_meta_archive"><?php mr_tailor_post_header_entry_date(); ?></div>
																
														<div class="entry-content-archive">
															
															<?php
											                if( ($post->post_excerpt) && (!is_single()) ) {
											                    the_excerpt();
											                    ?>
											                    <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Continue reading &rarr;', 'mr_tailor'); ?></a>
											                <?php
											                } else {
											                    the_content( __( 'Continue reading &rarr;', 'mr_tailor' ) );
											                }
											                ?>
															
														</div>
															   
													</div><!--blog-post-inner-->
												</div><!-- .blog-post-->
								
											<?php endwhile; ?>
								
										</div><!-- .blog-isotope -->
										
									</div><!-- .blog-isotop-container-->
									
								</div><!--.large-12-->
								</div><!--.row-->
								
								<?php mr_tailor_content_nav( 'nav-below' ); ?>
							
							</div><!--blog-isotop-master-wrapper-->
							
						<!--default style-->	
						<?php else : ?>
							
							<?php while ( have_posts() ) : the_post(); ?>
								
									<?php get_template_part( 'content', get_post_format() ); ?>
									
									<hr class="content_hr" />
									
							<?php endwhile; ?>
				
							<?php mr_tailor_content_nav( 'nav-below' ); ?>
							
						<?php endif; ?>
					
					<!--no posts found-->
                    <?php else : ?>
            
                        <?php get_template_part( 'no-results', 'index' ); ?>
            
                    <?php endif; ?>
                
                </div><!-- #content -->                            
            
            <?php if ( $blog_with_sidebar == "yes" ) : ?>
        		</div><!-- .columns -->
            <?php endif; ?>
    
			<?php if ( $blog_with_sidebar == "yes" ) : ?>
				<div class="large-4 columns">        					
					<?php get_sidebar(); ?>			           
                </div><!-- .columns -->
            <?php endif; ?>
            
        <?php if ( $blog_with_sidebar == "yes" ) : ?>
        	</div><!-- .row -->
        <?php endif; ?>
                 
    </div><!-- #primary -->
            
<?php get_footer(); ?>