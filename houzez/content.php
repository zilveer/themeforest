<?php
/**
 * Used for both single and index/archive/search.
 *
 */
global $houzez_local;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>
	<?php houzez_post_thumbnail(); ?>

	<div class="article-detail">
		<?php the_title( '<h1 class="article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

		<?php the_excerpt(); ?>

	</div>
	<div class="article-footer">

		<ul class="author-meta">
			<li>
				<?php if( get_the_author_meta( 'fave_author_custom_picture' ) != '' ) { ?>
					<img src="<?php echo esc_url( get_the_author_meta( 'fave_author_custom_picture' ) );?>" alt="Auther Image" width="40" height="40" class="meta-image img-circle">
				<?php } ?>
				<?php echo $houzez_local['by_text']; ?> <?php echo esc_attr( get_the_author() ); ?>
			</li>
			<li><i class="fa fa-calendar"></i> <?php echo esc_attr( get_the_date() ); ?> </li>

			<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && houzez_categorized_blog() ) : ?>
				<li><i class="fa fa-bookmark-o"></i> <?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'houzez' ) ); ?></li>
			<?php endif; ?>
		</ul>

		<div class="article-footer-right">
			<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo $houzez_local['read_more'];?></a>
		</div>
	</div>
</article>
