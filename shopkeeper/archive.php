<?php get_header(); ?>

	<div id="primary" class="content-area">
        
        <div id="content" class="site-content archive" role="main">
                
            <?php if ( have_posts() ) : ?>
            
				<div class="row">
					
					<div class="xlarge-8 xlarge-centered large-10 large-centered columns">
					
						<header class="entry-header-page">
								
								<?php 
									
									if ( is_category() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Category Archives', 'shopkeeper' ); ?></div>
										<h2 class="page-title blog-listing"><?php echo single_cat_title("", false) ?></h2>  

										<?php $args = array(
												'show_option_all'    => '',
												'orderby'            => 'name',
												'order'              => 'ASC',
												'style'              => 'list',
												'show_count'         => 0,
												'hide_empty'         => 1,
												'use_desc_for_title' => 1,
												'child_of'           => get_cat_id( single_cat_title("", false) ),
												'feed'               => '',
												'feed_type'          => '',
												'feed_image'         => '',
												'exclude'            => '',
												'exclude_tree'       => '',
												'include'            => '',
												'hierarchical'       => 1,
												'title_li'           => '',
												'show_option_none'   => '',
												'number'             => null,
												'echo'               => 1,
												'depth'              => 1,
												'current_category'   => 0,
												'pad_counts'         => 0,
												'taxonomy'           => 'category',
												'walker'             => null
										); ?>
										
										<ul class="list_categories list-centered">
										   <?php wp_list_categories( $args ); ?> 
										</ul>


										<?php
								  
									elseif ( is_tag() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Tag Archives', 'shopkeeper' ); ?></div>
										<h2 class="page-title blog-listing"><?php echo single_tag_title("", false) ?></h2>                                            
										<?php
									   
			
									elseif ( is_author() ) :
										the_post();
										?>
										<div class="page-type page-title-desc"><?php _e( 'Author', 'shopkeeper' ); ?></div>
										<h2 class="page-title blog-listing"><?php echo get_the_author() ?></h2>                                            
										<?php
										rewind_posts();
			
									elseif ( is_day() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Day Archives', 'shopkeeper' ); ?></div>
										<h2 class="page-title blog-listing"><?php echo get_the_date() ?></h2>                                            
										<?php
			
									elseif ( is_month() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Month Archives', 'shopkeeper' ); ?></div>
										<h2 class="page-title blog-listing"><?php echo get_the_date( 'F Y' ) ?></h2>                                            
										<?php
			
									elseif ( is_year() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Year Archives', 'shopkeeper' ); ?></div>
										<h2 class="page-title blog-listing"><?php echo get_the_date( 'Y' ) ?></h2>                                            
										<?php
			
									else :
										_e( 'Archives', 'shopkeeper' );
			
									endif;
								
								?>
							
							<?php
								// Show an optional term description.
								$term_description = term_description();
								if ( ! empty( $term_description ) ) :
									printf( '<div class="taxonomy-description">%s</div>', $term_description );
								endif;
							?>
										
						</header><!-- .page-header -->
						
					</div><!-- .columns -->
					
				</div><!-- .row -->
						
				<div class="row">
			
					<?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
					<div class="large-12 columns with-sidebar">
					<?php else : ?>
					<div class="xxlarge-10 xlarge-11 large-12 large-centered columns">
					<?php endif; ?>
				
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
										
											<h3 class="entry-title-archive">
												<a href="<?php echo has_post_format('link') ? esc_url( shopkeeper_get_link_url() ) : the_permalink() ; ?>" class="thumbnail_archive">
													<span class="thumbnail_archive_container">
														<?php the_post_thumbnail('blog-isotope'); ?>
													</span>
													<span><?php the_title(); ?></span>
												</a>
											</h3>
										 
											<div class="post_meta_archive"><?php shopkeeper_entry_archives(); ?></div>
										
											<div class="entry-content-archive">
												
												<?php if (get_option('rss_use_excerpt') == 0) : ?>
													<?php the_content(__('Continue Reading', 'shopkeeper')); ?>
												<?php elseif (get_option('rss_use_excerpt') == 1) : ?>
													<?php the_excerpt(); ?>
													<a href="<?php the_permalink(); ?>" class="more-link">
														<?php _e('Continue Reading', 'shopkeeper'); ?>
													</a>
												<?php else : ?>
													<?php the_content(__('Continue Reading', 'shopkeeper')); ?>
												<?php endif ?>
												
											</div>
								
										</div><!--blog-post-inner-->
									</div><!-- .blog-post-->
									
								<?php endwhile; ?>
								
							</div><!-- .blog-isotope -->
							<?php shopkeeper_content_nav( 'nav-below' ); ?>
						</div><!-- .blog-isotop-container-->

					<?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
					<div class="blog-sidebar">
						<?php get_sidebar(); ?>
					</div><!-- .columns-->
					<?php endif; ?>			

					</div><!-- .columns-->
			

				</div><!-- .row-->
            
            <?php else : ?>
            
                <?php get_template_part( 'content', 'none' ); ?>
            
            <?php endif; ?>
                    
		</div><!-- #content -->                            
                     
	</div><!-- #primary -->
            
<?php get_footer(); ?>
