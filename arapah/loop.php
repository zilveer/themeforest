<?php 
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
?>

			<div class="two-thirds column">
				<section id="primary" class="main"> 
								
					<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
									
					<article id="post-<?php the_ID(); ?>">
					  <div class="title">            
						 <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title('<h3>', '</h3>'); ?></a>  <!--Post titles-->
					  </div>
						
						<?php if ( is_category() || is_tag() || is_archive() || is_search() ) {
							the_excerpt();
						} else {
							the_content("Continue reading " . the_title('', '', false));
						} ?><!--The Content-->
				 
						 <!--The Meta, Author, Date, Categories and Comments-->   
						<div class="meta"> 
								Date posted: <?php echo get_the_date(); ?>
							  | Author: <?php the_author_posts_link(); ?>
							  | <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
							<p>Categories: <?php the_category(' '); ?></p>
						</div>
					</article>
								
					<?php endwhile; ?><!--  End the Loop -->

					<?php /* Display navigation to next/previous pages when applicable */ ?>

					  <nav id="nav-below">
						<?php if(function_exists('wp_pagenavi')) : wp_pagenavi();
							else : ?>
								<div class="navigation">
									<div class="button float-left"><?php previous_posts_link('prev') ?></div>
									<div class="button float-right"><?php next_posts_link('next') ?></div>
								</div>
						<?php endif; ?>
					  </nav><!-- #nav-below -->
				  
				<?php /* Only load comments on single post/pages*/ ?>
				<?php /* if (is_page() : comments_template( '', true ); endif; */ ?>
			 
			  </section>  <!-- #primary -->
			</div>