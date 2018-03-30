<?php
/**
 * Display a recent post (for the homepage).
 *
 * @package Listify
 * @category Content
 * @since 1.4.0
 */

// global should be avoided
global $style, $excerpt;

if ( 'standard' == $style ) :
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div <?php echo apply_filters( 'listify_cover', 'listify-clickbox-container entry-header entry-cover entry-cover--grid entry-cover--grid-empty' ); ?>>
		
		<a href="<?php the_permalink(); ?>" rel="bookmark" class="listify-clickbox"></a>
	</div>

	<div class="content-box-inner">
		<div class="entry-meta entry-meta--grid">
			<span class="entry-category">
				<?php echo get_the_date(); ?> &bull; <?php the_category( ', ' ); ?>
			</span>
		</div>

		<h1 class="entry-title entry-title--grid"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( $excerpt ): ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php endif; ?>

		<footer class="entry-footer">
			<a href="<?php the_permalink(); ?>" class="entry-read-more"><?php _e( 'Read More', 'listify' ); ?></a>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->

<?php else : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div <?php echo apply_filters( 'listify_cover', 'entry-header entry-cover entry-cover--grid-cover' ); ?>>
		<div class="cover-wrapper cover-wrapper--entry-grid">
			<div class="entry-meta entry-meta--grid">
				<span class="entry-category">
					<?php echo get_the_date(); ?> &bull; <?php the_category( ', ' ); ?>
				</span>
			</div>

			<h1 class="entry-title entry-title--grid"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( $excerpt ): ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php endif; ?>

			<footer class="entry-footer">
				<a href="<?php the_permalink(); ?>" class="entry-read-more"><?php _e( 'Read More', 'listify' ); ?></a>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->

<?php endif; ?>
