<?php 
/**
* The template for displaying posts in the gallery post format.
*
* @author : VanThemes ( http://www.vanthemes.com )
*/

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array('content', 'post-inner', 'gallery-format') ); ?> >

	<?php van_ribbon(); ?>
	
	<?php van_entry_media(); ?>

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

	</div>

</article>