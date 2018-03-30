<?php
get_header(); 
?>
				<div id="content">
					<div id="maincontent" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignright\""; endif; ?>>
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
						<?php edit_post_link( __( 'Edit', 'creativeclean' ), '<span class="edit-link">', '</span>' ); ?>
						<?php endwhile; ?>
					</div><!-- #maincontent -->
					<div id="nav" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignleft\""; endif; ?>>
						<?php get_sidebar(); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
<?php get_footer(); ?>
