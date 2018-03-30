<?php
/**
 * The template part for displaying results in search pages.
 *
 */
?>

<div class="post_wrap clearfix">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->

	<div class="entry-meta">
		<?php _e('Published: ','heartfelt'); the_time( get_option( 'date_format' ) ); ?>
	</div><!-- .entry-meta -->

	<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'page-thumbnails' );
		}
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	</article><!-- #post-## -->

	</div><!-- post class -->

</div><!-- .post_wrap -->
