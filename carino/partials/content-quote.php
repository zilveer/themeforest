<?php 
/**
* The template for displaying posts in the quote post format.
*
* @author : VanThemes ( http://www.vanthemes.com )
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array('content', 'post-inner', 'quote-format') ); ?>>
	

	<?php van_entry_media(); ?>

	<div class="entry-container <?php echo ( !is_single() ) ? "arch" : ""; ?>">

		<header class="entry-header">
			
			<?php if ( is_single() ): ?>

				<h1 class="entry-title"><?php the_title(); ?></h1><!-- .entry-title -->
			
			<?php endif; ?>

			<?php van_entry_meta(); ?>

		</header>

		<?php if ( is_single() ): ?>
			
			<?php van_entry_content(); ?>

		<?php endif; ?>

		<?php van_entry_footer(); ?>

	</div>

</article>