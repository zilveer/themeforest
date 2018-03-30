<?php
//post format specific
$post_format = get_post_format();
if ( empty( $post_format ) || $post_format == 'standard' ) {
	$post_format = '';
} ?>

<header class="article__header">
	<?php
	get_template_part( 'theme-partials/post-templates/loop-content/featured-masonry/image', $post_format );

	if ( heap_option( 'blog_show_categories' ) ) {
		$categories = get_the_category();
		if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) { ?>
			<ol class="nav  article__categories">
				<?php foreach ( $categories as $category ) { ?>
					<li>
						<a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s", 'heap' ), $category->name ) ) ?>" rel="tag">
							<?php echo $category->name; ?>
						</a>
					</li>
				<?php } ?>
			</ol>
		<?php
		}
	}

	if ( ! in_array( $post_format, array( 'aside', 'chat' ) ) ) { ?>
		<h3 class="article__title entry-title">
			<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>
	<?php } ?>
	<span class="vcard author"><span class="fn"><span class="value-title" title="<?php the_author() ?>"></span></span></span>
</header>