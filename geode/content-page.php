<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */
?>

<?php global $multipage; ?>

<?php $gridder = geode_check_gridder(get_the_id()); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php if ( !isset($gridder) || $gridder!=true ) { ?>
				<div class="row">
					<div class="row-inside">
			<?php } ?>
			<?php the_content(); ?>
			<?php if ( !isset($gridder) || $gridder!=true ) { ?>
					</div><!-- .row-inside -->
				</div><!-- .row -->
			<?php } ?>
			<?php if ( $multipage ) { ?>
				<div class="row">
					<div class="row-inside">
						<?php wp_link_pages( array( 'before' => '<nav class="page-links">','after' => '</nav>', 'pagelink' => '<span>%</span>' ) ); ?>
					</div><!-- .row-inside -->
				</div><!-- .row -->
			<?php } ?>
		</div><!-- .entry-content -->
			
		<?php edit_post_link( __( 'Edit', 'geode' ), '<footer class="entry-meta row"><div class="row-inside"><span class="edit-link">', '</div><!-- .row-inside --></footer><!-- .entry-meta --></span>' ); ?>
			
	</article>
