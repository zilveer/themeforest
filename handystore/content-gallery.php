<?php
/* The template for displaying posts in the Gallery post format */

/* Add responsive bootstrap classes */
$classes = array();
if (function_exists('pt_single_content_class')) $classes[] = pt_single_content_class();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> itemscope="itemscope" itemtype="http://schema.org/Article">

	<?php // Carousel for Blog Page
	if ( handy_get_option('show_gallery_carousel')=='on' && !is_single() && get_post_gallery()) :

		//$images = get_post_gallery( get_the_ID(), false );
		$count = 0;
		$gallery_type = esc_attr((handy_get_option('gallery_carousel_type') == '' ? 'paginated' : handy_get_option('gallery_carousel_type')));
		$transition_type = esc_attr((handy_get_option('gallery_carousel_effect') != '') ? handy_get_option('gallery_carousel_effect') : 'fade');

		switch ($gallery_type) {
			case 'paginated':
				$extra_class = 'paginated';
				$extra_count = 5;
				$owl_type = 'simple';
			break;
			case 'with-thumbs':
				$extra_class = 'with-icons';
				$extra_count = 3;
				$owl_type = 'with-icons';
			break;
		}

		if ( get_post_gallery() ) {

			$gallery = get_post_gallery( get_the_ID(), false );
			$img_ids = isset($gallery['ids'])? $gallery['ids'] : 0;
			$img_ids_array = explode(",", $img_ids);?>

			<div class="entry-carousel">

			<div class="blog-gallery <?php echo esc_attr($extra_class); ?>"
						data-owl="container"
						data-owl-slides="1"
						data-owl-type="<?php echo esc_attr($owl_type); ?>"
						data-owl-navi="false"
						data-owl-pagi="true"
						data-owl-transition="<?php echo esc_attr($transition_type); ?>">

			<?php foreach( $img_ids_array as $img_id ) :
				if ($count > $extra_count) {
					continue;
				}?>
				<div class="slide">
					<?php echo wp_get_attachment_image( $img_id, 'post-thumbnail', false, array('itemprop' => 'thumbnail') ); ?>
				</div>
				<?php $count++;
			endforeach;?>

			</div></div>
		<?php }

	endif;
?>
	<div class="content-wrapper" role="main">

		<header class="entry-header">
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
				else :
					the_title( '<h1 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h1>' );
				endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-meta">
			<?php pt_entry_author(); ?>
			<?php pt_entry_post_cats(); ?>
			<?php pt_entry_publication_time()?>
			<?php edit_post_link( __( 'Edit', 'plumtree' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->

		<div class="entry-content" itemprop="articleBody">
			<?php
			if ( handy_get_option('show_gallery_carousel')=='on' && !is_single() && get_post_gallery()) {
				global $post;
				echo strip_shortcodes($post->post_content);
			} else {
				the_content( apply_filters( 'pt_more', __('Continue Reading...', 'plumtree')) );
			}
			?>

			<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'plumtree' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '%',
				'separator'   => '&nbsp;',
			) ); ?>
		</div><!-- .entry-content -->

		<?php if ( !is_single() ) : ?>
			<div class="entry-additional-meta">
				<?php if ( ! post_password_required() ) { pt_entry_comments_counter(); } ?>
				<?php if (function_exists('pt_get_likes_counter')) {
					echo pt_get_likes_counter(get_the_ID());
				} ?>
			</div>
		<?php endif; ?>

		<?php /* Footer of the article */ get_template_part( 'partials/post-meta' ); ?>
	</div>

</article><!-- #post-## -->
