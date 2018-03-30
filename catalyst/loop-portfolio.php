<?php
/**
* Catalyst Portfolio Loop
 */
?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content-wrapper">
				<?php if ( is_front_page() ) { ?>
					<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php } else { ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php } ?>
				
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mthemelocal' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'edit this entry', 'mthemelocal' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</div>
		</div><!-- #post-## -->

		<?php comments_template(); ?>
	<?php endwhile; else: ?>
<?php endif; ?>