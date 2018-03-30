<?php
/* 
Template Name: Compact Page With Sidebar 
*/
?>


<?php get_header(); ?>

		<?php 
			$inspire_options_post = get_option('inspire_options_post');
			$layout = "single";		//single, full, full_sidebar
			$featured_img_width = 650;
		?>

		<div id="content" class="<?php echo $layout; ?>">


			<!-- BEGIN LOOP -->
			<?php while ( have_posts() ) : the_post(); ?>
				
				<div class="post <?php echo $layout; ?>" data-post_ID="<?php the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('like_post'); ?>">


					<!-- FEATURED IMAGE FOR SINGLE & FULL-->
					<?php
						if (has_post_thumbnail(get_the_ID())) { 
							printf("<div class='post-img'>%s</div>", get_the_post_thumbnail(get_the_ID(), array($featured_img_width,9999)));
						}
					?>

					<!-- TITLE AND META -->
					<div class="post-title">
						
						<h1><?php the_title(); ?></h1>

						<?php 
							if (isset($inspire_options_post['page_show_byline'])) {
							?>
								<span class="meta"><?php _e('by', 'loc_inspire'); ?> <?php the_author_posts_link(); ?></span>
							<?php
							} 
						?>
						
					</div>
					
					<!-- MAIN CONTENT AND TAGS -->
					<div class="post-entry">

						<?php the_content(); ?>
						
						<?php wp_link_pages(); ?>
						
						<div class="clearfix"></div>
						
					</div>
					
					<!-- SHARE THE LOVE -->
					<?php if (isset($inspire_options_post ['page_show_share'])) get_template_part('inc/templates/template_post_share'); ?>

				</div>
				<!-- class: post -->

			<?php endwhile; ?>
			<!-- END LOOP -->
			
		</div> <!-- id:content -->

<?php if ($layout == "single" || $layout == "full_sidebar") get_sidebar(); ?>
			
<?php get_footer(); ?>