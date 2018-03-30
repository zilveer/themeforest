<?php
/**
 * The template for displaying posts in the Link post format
 *
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clearfix'); ?> role="article">
		<?php mnky_post_links(); ?>

		<header class="post-entry-header">
			<div class="link-text">
				<?php if( is_single() ) : ?>
					<h2 class="entry-title"><a href="<?php echo esc_url(get_the_content()); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'care' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" target="_blank"><?php echo get_the_content(); ?></a></h2>
				<?php else : ?>
					<h2 class="entry-title"><a href="<?php echo esc_url(get_the_content()); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'care' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" target="_blank"><?php the_title(); ?></a></h2>
					<span><?php echo get_the_content(); ?></span>
				<?php endif; ?>				
			</div>
		
			<?php mnky_post_meta(); ?>
		</header><!-- .entry-header -->
		<?php 
		if( is_single() && has_tag() && ot_get_option('post_tags') != 'off' ) {
			the_tags( '<div class="tag-links"><span>','</span><span>','</span></div>' ); 
		} ?>

	</article><!-- #post-<?php the_ID(); ?> -->