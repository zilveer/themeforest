<?php
/**
 * Search results template
 *
 */

get_header(); ?>
	<!--start contentWrapper-->
	<div id="contentWrapper">
		<!--start content-->
		<div id="content">
			<!-- start Page -->
			<div id="page">
				<h1 class="pageHeading"><?php _e( 'Search Results', 'alive' ); ?></h1>
				<h2><?php _e( 'Search term: ', 'alive' ); ?><?php the_search_query(); ?></h2>
				<?php if ( have_posts() ) : ?>
				<?php 
															
					$post_count = 1;
					$posts_per_page = (int) of_get_option("blog_posts_per_page") + 1;?>
				<!-- start  searchContainer -->
				<div id="searchContainer" class="container noMargin">
			
					<ul class="contentPaginate">
					
					<?php while(have_posts()):the_post();  				
					$image_url_big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
					$image_url_small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog_image_thumb');
					
					if ($post_count == 1){
						echo '<li>';
					}				    					    					    					    					    
					
					$post_count++;
					
					?>

					<!-- start post -->
					<div <?php post_class(); ?>>
						<h3><?php the_title(); ?></h3>
						<?php if (has_post_thumbnail()) : ?>
						<div class="mediaContainer blog">
							<a title="<?php echo $post->post_title ?>" href="<?php the_permalink(); ?>">  							
								<div class="_rollover"></div>
								<img class="_thumb" src="<?php echo $image_url_small[0]; ?>" width="500" height="200" alt=""/>   
							</a>
						</div>
					
						<?php endif; ?>
						
						<ul class="entryMeta">
							<li class="author"><?php the_author_posts_link() ?></li>
							<?php if(has_category()) : ?><li class="category"><?php the_category(" &middot; ") ?></li><?php endif;?>
							<li class="date"><?php the_time("F j, Y") ?></li>
							<li class="comments"><?php comments_number();?></li>
							<?php if(has_tag()) : ?><li class="tags"><?php the_tags("") ?></li><?php endif;?>
							<?php edit_post_link(__('Edit this', 'alive'), '<li>','</li>'); ?>
						</ul> 
						
						<?php the_excerpt(); ?>   
						
						<a class="button small <?php echo of_get_option('blog_button_color'); ?> readMore" href="<?php the_permalink(); ?>"><?php _e("Read more", "alive") ?></a>   
					
					</div>
					<!-- end post -->

				<?php
					if ($post_count == $posts_per_page){
						echo '</li>';
						$post_count = 1;
					}

				?>
				
				<?php endwhile;?>
				</ul>	
				
				<div class="page_navigation"></div>
			
			</div>
			<!-- end searchContainer -->
				
				<?php else : ?>
 
				<div id="post-0" <?php post_class(); ?>>
                    <h3><?php _e( 'Nothing Found', 'alive' ) ?></h3>
                    <div>
                        <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'alive' ); ?></p>
    					<?php get_search_form(); ?>
                    </div>
                </div>
 
				<?php endif; ?>  
			
			</div>
			<!-- end Page -->
		

			<?php get_sidebar(); ?> 
<?php get_footer(); ?>