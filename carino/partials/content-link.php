<?php 
/**
* The template for displaying posts in the link post format.
*
* @author : VanThemes ( http://www.vanthemes.com )
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array('content', 'post-inner', 'link-format') ); ?> >

	<?php van_ribbon(); ?>

	<div class="entry-container <?php echo ( !is_single() ) ? "arch" : ""; ?>">
		
		<?php $link = get_post_meta( get_the_ID(),'van_post_link',true );  ?>

		<header class="entry-header">

			<?php if ( is_single() ): ?>

				<h1 class="entry-title">
					
					<?php if ( $link ): ?><a href="<?php echo $link; ?>"><?php endif; ?>

					<?php the_title(); ?>

					<?php if ( $link ): ?></a><?php endif; ?>

				</h1><!-- .entry-title -->
			
			<?php else: ?>

				<h2 class="entry-title">
					
					<?php if ( $link ): ?><a href="<?php echo $link; ?>"><?php endif; ?>

					<?php the_title(); ?>

					<?php if ( $link ): ?></a><?php endif; ?>

				</h2><!-- .entry-title -->

			<?php endif; ?>

			<div class="link-meta">&mdash; <?php echo $link; ?></div>

			<?php van_entry_meta(); ?>

		</header>

		<?php if ( is_single() ) : ?>
			<?php van_entry_content(); ?>
		<?php endif; ?>

		<?php van_entry_footer(); ?>

	</div>

</article>