<?php /* The default template for displaying content. */
/* Add responsive bootstrap classes */
$classes = array();
if (function_exists('pt_single_content_class')) $classes[] = pt_single_content_class();

// Lazyload for posts
$add_lazy_class = true;
if ( handy_get_option('blog_frontend_layout')=='isotope' ||
	 handy_get_option('blog_frontend_layout')=='grid' ||
	 is_single() ||
	 isset( $_GET['b_type'] ) ) {
	$add_lazy_class = false;
}
if ( handy_get_option('lazyload_on_blog')==='on' && $add_lazy_class ) {
	$classes[] = 'lazyload';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> itemscope="itemscope" itemtype="http://schema.org/Article" <?php if ( !is_single() ) { echo ' data-expand="-100"'; } ?>><!-- Article ID-<?php the_ID(); ?> -->

	<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'plumtree' ) );
		}
	?>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="thumbnail-wrapper" itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
			<?php the_post_thumbnail('post-thumbnail', array('itemprop'=>'url') );
						$post_thumb_extra_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
						if ( is_array($post_thumb_extra_data) && $post_thumb_extra_data !='') {
								echo '<meta itemprop="width" content="'.$post_thumb_extra_data['1'].'">';
								echo '<meta itemprop="height" content="'.$post_thumb_extra_data['2'].'">';
						} ?>
		</div>
	<?php endif; ?>

	<div class="content-wrapper">

	<header class="entry-header"><!-- Article's Header -->

		<?php
			if ( is_single() ) : // Singular page
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			elseif ( is_search() ) : // Search Results
				$title = get_the_title();
	  			$keys = explode(" ",$s);
	  			$title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
				<h1 class="entry-title search-title" itemprop="headline">
					<a href="<?php esc_url(the_permalink()); ?>" title="<?php echo esc_attr( sprintf( __( 'Click to read more about %s', 'plumtree' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" itemprop="url"><?php echo $title; ?></a>
				</h1>
			<?php else :
				$title = get_the_title();
				if ( empty($title) || $title = '' ) { ?>
					<h1 class="entry-title" itemprop="headline">
						<meta itemprop="mainEntityOfPage" content="<?php esc_url(the_permalink()); ?>">
						<a href="<?php esc_url(the_permalink()); ?>" title="<?php _e( 'Click here to read more', 'plumtree' ); ?>" rel="bookmark" itemprop="url"><?php _e( 'Click here to read more', 'plumtree' ); ?></a>
					</h1>
				<?php } else {
					echo '<meta itemprop="mainEntityOfPage" content="'.esc_url(get_permalink()).'">';
					the_title( '<h1 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h1>' );
				}
			endif; ?>

	</header><!-- end of Article's Header -->

	<div class="entry-meta">
		<?php pt_entry_author(); ?>
		<?php pt_entry_post_cats(); ?>
		<?php pt_entry_publication_time()?>
		<?php edit_post_link( __( 'Edit', 'plumtree' ), '<span class="edit-link">', '</span>' ); ?>
	</div>

	<?php if ( is_search() ) : // Only display Excerpts for Search
	  	$excerpt = get_the_excerpt();
	  	$keys = explode(" ",$s);
	  	$excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $excerpt);
	?>
		<div class="entry-summary" itemprop="articleBody"><!-- Excerpt -->
			<?php echo $excerpt; ?>
		</div><!-- end of Excerpt -->
	<?php else : ?>
		<div class="entry-content" itemprop="articleBody"><!-- Content -->
			<?php the_content( apply_filters( 'pt_more', 'Continue Reading...') ); ?>

			<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'plumtree' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '%',
				'separator'   => '&nbsp;',
			) ); ?>
		</div><!-- end of Content -->

		<?php if ( !is_single() ) : ?>
			<div class="entry-additional-meta">
				<?php if ( ! post_password_required() ) { pt_entry_comments_counter(); } ?>
				<?php if (function_exists('pt_output_likes_counter')) {
					echo pt_output_likes_counter(get_the_ID());
				} ?>
			</div>
		<?php endif; ?>

	<?php endif; ?>

	<?php /* Footer of the article */ get_template_part( 'partials/post-meta' ); ?>

	</div>

</article><!-- end of Article ID-<?php the_ID(); ?> -->
