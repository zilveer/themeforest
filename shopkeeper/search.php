<?php get_header(); ?>

	<div id="primary" class="content-area search-results">

		<?php if ( have_posts() ) : ?>
		<div class="row">
			<div class="large-9 large-centered columns">
				
				<header class="page-header">
					<h1 class="page-title search-results-title"><span class="top-page-excerpt"><?php printf( __( 'Search Results for %s', 'shopkeeper' ), '<span class="page-title">' . get_search_query() . '</span>' ); ?></span></h1>
				</header><!-- .page-header -->
				
			</div>
		</div>
		<?php endif; ?>
	
        <?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
            <div class="row"><div class="large-9 columns with-sidebar">
        <?php endif; ?>
        
                <div id="content" class="site-content" role="main">
                
                    <?php if ( have_posts() ) : ?>
            
						<div class="row">
							<div class="large-9 large-centered columns">
				
									
								<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>
					
									<?php
										/* Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										?>
										
										<div class="search_result_item">
											
											<h1 class="entry-title-archive">
												<a href="<?php echo has_post_format('link') ? esc_url( shopkeeper_get_link_url() ) : the_permalink() ; ?>" class="thumbnail_archive">
													<span><?php the_title(); ?></span>
												</a>
											</h1>
													 
											<div class="post_meta_archive"><?php shopkeeper_entry_archives(); ?></div>
											
										</div><!--.search_content-->
										
										<?php
										//get_template_part( 'content', get_post_format() );
									?>
					
								<?php endwhile; ?>
					
								<?php shopkeeper_content_nav( 'nav-below' ); ?>
							
							 </div><!-- .columns -->
						</div><!-- .row -->
            
                    <?php else : ?>
            
                        <?php get_template_part( 'content', 'none' ); ?>
            
                    <?php endif; ?>
                    
                </div><!-- #content --> 
                         
            <?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
        		</div><!-- .columns -->
            <?php endif; ?>
            
            <?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
				<div class="large-3 columns">        					
					<?php get_sidebar(); ?>			           
                </div><!-- .columns -->
            <?php endif; ?>
            
        <?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
        	</div><!-- .row -->
        <?php endif; ?>
                            
    </div><!-- #primary -->

<?php get_footer(); ?>
