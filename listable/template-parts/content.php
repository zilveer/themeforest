<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Listable
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'card card--post' ); ?>>
	<?php if ( has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'listable-card-image' ); ?>
		<a href="<?php the_permalink(); ?>">
			<aside class="card__image" style="background-image: url('<?php echo listable_get_inline_background_image( $image[0] ); ?>')"></aside>
		</a>
	<?php } else { ?>
		<a href="<?php the_permalink(); ?>">
			<aside class="card__image"></aside>
		</a>
	<?php } ?>
	<div class="card__content">
		<?php the_title( sprintf( '<h2 class="card__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php if ( 'post' === get_post_type() ) { ?>
			<div class="card__meta">
				<?php listable_posted_on();
				$categories = get_the_category();
				if ( count( $categories ) ) { ?>
					<ul class="card__links">
						<?php foreach ( $categories as $category ) { ?>
							<li><a href="<?php echo esc_sql( get_category_link($category->cat_ID) ); ?>"><?php echo $category->name; ?></a></li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div><!-- .entry-meta -->
		<?php } ?>
	</div>
	<!-- .entry-header -->
</article><!-- #post-## -->
