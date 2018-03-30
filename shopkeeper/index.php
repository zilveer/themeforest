<?php
	
	global $shopkeeper_theme_options;
	
	$page_id = "";
	if ( is_single() || is_page() ) {
		$page_id = get_the_ID();
	} else if ( is_home() ) {
		$page_id = get_option('page_for_posts');		
	}

    $blog_with_sidebar = "";
    if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];

    $page_header_src = "";

    if ( $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) ) )
    {

    }
	
	if (get_post_meta( $page_id, 'page_title_meta_box_check', true )) {
		$page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
	} else {
		$page_title_option = "on";
	}	


?>

<?php get_header(); ?>

	<div id="primary" class="content-area">                    
                
    <div id="content" class="site-content blog" role="main">             

        
        <?php if ( have_posts() ) : ?>

			<header class="entry-header-page">
				<div class="row">
					<div class="xlarge-8 large-10 xlarge-centered large-centered columns without-sidebar">
				
						<?php if (!empty($page_header_src)): ?>
					    <div class="blog-featured-image" style="background:url(<?php echo $page_header_src; ?>) center center no-repeat; height: 300px; background-size: cover;">
					    	<!-- <img src="<?php echo $page_header_src; ?>" style="width: 100%;" /> -->
					    </div>
					<?php endif; ?>

						<?php
						if( is_home() && get_option('page_for_posts') ) {
							if ( (isset($page_title_option)) && ($page_title_option == "on") ) {
								$blog_page_id = get_option('page_for_posts');
								echo '<p class="top-page-excerpt">'.get_page($blog_page_id)->post_excerpt.'</p>';
								echo '<h2 class="page-title blog-listing">'.get_page($blog_page_id)->post_title.'</h2>';
							}
						}
						?>
						
						<?php $args = array(
								'show_option_all'    => '',
								'orderby'            => 'name',
								'order'              => 'ASC',
								'style'              => 'list',
								'show_count'         => 0,
								'hide_empty'         => 1,
								'use_desc_for_title' => 1,
								'child_of'           => 0,
								'feed'               => '',
								'feed_type'          => '',
								'feed_image'         => '',
								'exclude'            => '',
								'exclude_tree'       => '',
								'include'            => '',
								'hierarchical'       => 1,
								'title_li'           => '',
								'show_option_none'   => 'No categories',
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
						
					</div><!-- .large-10-->
				</div><!-- .row-->
			</header>
					
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

            <?php get_template_part( 'no-results', 'index' ); ?>

        <?php endif; ?>
       
        </div><!-- #content -->                            
                     
    </div><!-- #primary -->
            
<?php get_footer(); ?>