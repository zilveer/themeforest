<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								
					<?php if (is_front_page()) { ?>
						
						<h2 class="entry-title"><?php the_title(); ?></h2>
						
					<?php } else { ?>
						
						<h1 class="entry-title"><?php the_title(); ?></h1>
						
					<?php } ?>
				
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>');
					} ?>

				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>