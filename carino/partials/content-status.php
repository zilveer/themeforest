<?php 
/**
* The template for displaying posts in the status post format.
*
* @author : VanThemes ( http://www.vanthemes.com )
*/

$class_attr = array('content', 'post-inner', 'status-format');

if ( van_is_embed_status() ) {
	$class_attr = array('post-inner');
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class_attr ); ?>>
	
	

	<?php if ( van_is_embed_status() ): ?>

		<?php van_entry_media();  ?>

	<?php else: ?>

		<?php van_ribbon(); ?>

		<div class="entry-container">

			<header class="entry-header">

				<?php if ( is_single() ): ?>

					<h1 class="entry-title"><?php the_title(); ?></h1><!-- .entry-title -->

				<?php else: ?>

					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'van' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2><!-- .entry-title -->

				<?php endif; ?>
				
				<?php van_entry_meta(); ?>

			</header>
		
			<?php van_entry_content(); ?>

			<?php van_entry_footer(); ?>

		</div><!-- .entry-container -->

	<?php endif; ?>

</article>