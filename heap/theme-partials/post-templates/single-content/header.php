<?php
//post format specific
$post_format = get_post_format();
if ( empty( $post_format ) ) {
	$post_format = '';
}
?>

<header class="article__header">
	<?php get_template_part( 'theme-partials/post-templates/single-content/featured-classic/image', $post_format ); ?>
	<?php if ( heap_option( 'blog_single_show_breadcrumb' ) ) {
		heap_breadcrumb();
	} ?>

	<?php if ( get_the_title() ): ?>
		<h1 class="article__title entry-title" itemprop="name headline mainEntityOfPage"><?php the_title(); ?></h1>
	<?php else: ?>
		<h1 class="article__title entry-title" itemprop="name headline mainEntityOfPage"><?php esc_html_e( 'Untitled', 'heap' ); ?></h1>
	<?php endif; ?>

	<hr class="separator"/>
	<?php if ( heap_option( 'blog_single_show_title_meta_info' ) || heap_option( 'blog_single_share_links_position' ) == 'top' || heap_option( 'blog_single_share_links_position' ) == 'both' ):
		$both_metas = heap_option( 'blog_single_show_title_meta_info' ) && ( heap_option( 'blog_single_share_links_position' ) == 'top' || heap_option( 'blog_single_share_links_position' ) == 'both' ) ? true : false;
		?>
		<div class="entry__meta--header">
			<div class="post-meta">
				<div>
				<?php
				if ( heap_option( 'blog_single_show_title_meta_info' ) ) {
					$author_display_name = get_the_author_meta( 'display_name' );
					printf( '<span class="article__author-name" itemprop="author" itemscope itemtype="http://schema.org/Person">' . esc_html__( 'By %s', 'heap' ) . '</span>', '<address class="vcard author"><a class="url fn" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . sprintf( __( 'Posts by %s', 'heap' ), $author_display_name ) . '" itemprop="name" >' . $author_display_name . '</a></address>.' ); ?>
					<time class="article__time" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
						<span> <?php printf( esc_html__( 'Published on %s.', 'heap' ), '<abbr class="published" title="' . esc_attr( get_the_date( 'c' ) ) . '">' . get_the_date() . '</abbr>' ); ?></span>
					</time>
					<?php
					if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
						echo '<time itemprop="dateModified" class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . get_the_modified_date() . '</time>';
					}

					if ( comments_open() ) { ?>
						<a href="#comments"
						   class="article__comments-number"><?php echo get_comments_number(); ?></a>
					<?php }
				} ?>
				</div>
				<?php if ( heap_option( 'blog_single_show_share_links' ) && ( heap_option( 'blog_single_share_links_position', 'bottom' ) == 'top' || heap_option( 'blog_single_share_links_position', 'bottom' ) == 'both' ) ): ?>
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style  add_this_list"
					     addthis:url="<?php echo heap_get_current_canonical_url(); ?>"
					     addthis:title="<?php wp_title( '|', true, 'right' ); ?>"
					     addthis:description="<?php echo trim( strip_tags( get_the_excerpt() ) ) ?>">
						<?php get_template_part( 'theme-partials/wpgrade-partials/addthis-social-buttons' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</header><!-- .article__header -->