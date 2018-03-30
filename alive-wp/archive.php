<?php 


get_header(); 

?>

	<!-- start contentWrapper -->
	<div id="contentWrapper">
		<!-- start content -->
		<div id="content">
			<h1 class="pageHeading" >
			<?php if ( is_404() || is_category() || is_tag() || is_day() || is_month() || is_year() || is_search() || is_paged() ) { ?>
			<?php if (is_category()) { 
				?> Category: <?php single_cat_title();
				} elseif( is_tag() ) {
				?> Tag: <?php single_tag_title();
				} elseif (is_day()) { 
				the_time('F jS, Y'); 
				} elseif (is_month()) { 
				the_time('F, Y');
				} elseif (is_year()) {
				the_time('Y'); 
				} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
				?>Blog Archives
			<?php } 
			}?>
			</h1>
							
			<!-- start blogContainer -->
			<div id="blogContainer" class="container noMargin">
				<!-- start contentPaginate -->
				<ul class="contentPaginate">
					<?php 
										
										
					$post_count = 1;
					$posts_per_page = (int) of_get_option("blog_posts_per_page") + 1;
					
					if (have_posts()) : while (have_posts()) : the_post();
					
					$image_url_big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
					$image_url_small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog_image_thumb');
					
					if ($post_count == 1) {
						echo '<li>';
					}																													  
					
					$post_count++;
					
					?>
					
					<!-- start post -->
					<div <?php post_class(); ?>>
						<h2><?php the_title(); ?></h2>
						<?php if (has_post_thumbnail()) : ?>
						<div class="mediaContainer blog">
							<a title="<?php echo $post->post_title ?>" href="<?php the_permalink(); ?>">
								<div class="_rollover"></div>
								<img src="<?php echo $image_url_small[0]; ?>" width="500" height="200" alt="<?php echo $post->post_title ?>"/>
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

					if ($post_count == $posts_per_page) {
						echo '</li>';
						$post_count = 1;
					}

					endwhile; endif; 
					
					?>
				
				</ul>	
				<!-- end contentPaginate -->
				
				<div class="page_navigation"></div>
			
			</div>
			<!-- end blogContainer -->
		 
		<div class="clear"></div>
		<?php get_sidebar(); ?> 
<?php get_footer(); ?>