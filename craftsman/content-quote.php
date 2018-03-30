<?php
/**
 * The template for displaying posts in the Quote post format
 *
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clearfix'); ?> role="article">
		
		<?php mnky_post_links(); ?>

		<header class="post-entry-header">
			<div class="quoute-text">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'craftsman' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo get_the_content(); ?></a></h2>
				
				<?php if ( !is_single() ) : ?>
					<span><?php the_title(); ?></span>
				<?php endif; ?>
			</div>

			<?php mnky_post_meta(); ?>
		</header><!-- .entry-header -->
		
		<?php 
		if( is_single() && has_tag() && ot_get_option('post_tags') != 'off' ) {
			the_tags( '<div class="tag-links"><span>','</span><span>','</span></div>' ); 
		} ?>

	</article><!-- #post-<?php the_ID(); ?> -->