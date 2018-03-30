<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package omni
 */

get_header(); ?>

<?php
$page_sidebar = cs_get_customize_option( 'post_sidebar' );

$page_meta = get_post_meta( get_the_ID(), 'custom_sidebar_options', true );
if ( isset( $page_meta['custom_post_sidebar'] ) && ! ( '' === $page_meta['custom_post_sidebar'] ) && ! ( 'default' === $page_meta['custom_post_sidebar'] ) ) {
	$page_sidebar = $page_meta['custom_post_sidebar'];
}

if ( isset( $page_sidebar ) && ( 'left' === $page_sidebar ) ) {
	$sidebar_class = 'pull-right';
	$content_width = 730;
} else {
	$sidebar_class = '';
	$content_width = 730;
}

$media_format = get_post_format();

if ( 'audio' === $media_format ) {
	$featured_media = crumina_post_audio();
} elseif ( 'video' === $media_format ) {
	$featured_media = crumina_post_video();
} elseif ( 'gallery' === $media_format ) {
	$featured_media = crumina_post_gallery();
} elseif ( 'image' === $media_format ) {
	$featured_media = crumina_post_image();
} elseif ( 'quote' === $media_format ) {
	$featured_media = crumina_post_quote();
} else {
	$featured_media = crumina_post_thumbnail();
}

$hide_post_related = cs_get_customize_option( 'related_posts_hide' );
$post_meta         = get_post_meta( get_the_ID(), 'meta-post-show-related', true );

if ( isset( $post_meta['meta_show_related'] ) && ! empty( $post_meta['meta_show_related'] ) && ! ( 'default' === $post_meta['meta_show_related'] ) ) {
	if ( 'enable' === $post_meta['meta_show_related'] ) {
		$hide_post_related = true;
	} elseif ( 'disable' === $post_meta['meta_show_related'] ) {
		$hide_post_related = '';
	}
}
$post_related_style = cs_get_customize_option( 'related_posts_style' );

if ( isset( $post_meta['meta_related_posts_style'] ) && ! empty( $post_meta['meta_related_posts_style'] ) && ! ( 'default' === $post_meta['meta_related_posts_style'] ) ) {
	$post_related_style = $post_meta['meta_related_posts_style'];
}

$blog_page_meta = get_post_meta( get_the_ID(), '_custom_page_options', true );
$show_meta      = cs_get_customize_option( 'blog_meta_display' );
if ( isset( $blog_page_meta['meta_show_meta'] ) && ! empty( $blog_page_meta['meta_show_meta'] ) && ! ( 'default' === $blog_page_meta['meta_show_meta'] ) ) {
	if ( 'enable' === $blog_page_meta['meta_show_meta'] ) {
		$show_meta = true;
	} elseif ( 'disable' === $blog_page_meta['meta_show_meta'] ) {
		$show_meta = false;
	}
}

$show_excerpt = cs_get_customize_option( 'blog_excerpt_display' );
if ( isset( $blog_page_meta['meta_show_excerpt'] ) && ! empty( $blog_page_meta['meta_show_excerpt'] ) && ! ( 'default' === $blog_page_meta['meta_show_excerpt'] ) ) {
	if ( 'enable' === $blog_page_meta['meta_show_excerpt'] ) {
		$show_excerpt = true;
	} elseif ( 'disable' === $blog_page_meta['meta_show_excerpt'] ) {
		$show_excerpt = false;
	}
}
set_query_var( 'show_excerpt', $show_excerpt );
set_query_var( 'show_meta', $show_meta );

if('none' === $page_sidebar){
	$author_class = 'author-center-align';
}else{
	$author_class = 'author-entry';
}
?>

<div class="container blog-container">
	<div class="new-block">
		<div class="row">
			<?php if ('none' === $page_sidebar){ ?>
			<div class="col-md-10 col-md-offset-1 blog-content-column">
				<?php }else{ ?>
				<div class="col-md-8 blog-content-column <?php echo esc_attr( $sidebar_class ); ?>">
					<?php } ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post detail-post' ); ?>>

							<div class="data">
								<div class="text">

									<?php if ('none' === $page_sidebar){ ?>
									<div class="blog-post-hat-center-align">
										<?php } ?>

										<a class="button back-button" href="#" onClick="history.go(-1); return false;">
											<span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span><?php echo esc_html__( 'back', 'omni' ); ?></a>

										<?php the_title( '<h1 class="entry-title title">', '</h1>' ); ?>

										<div class="<?php echo esc_attr($author_class);?>">

											<?php $args = array(
												'post_id'         => get_the_ID(),
												'show_author'     => true,
												'show_categories' => true,
												'show_date'       => true,
												'show_comments'   => true,
												'avatar_size'     => 100,
											);
											if ( ! ( true === $show_meta ) ) {
												omni_posted_on( $args );
											}
											?>

										</div>

										<?php if ( has_excerpt() ) : ?>

											<div class="blog-article-description">
												<?php the_excerpt(); ?>
											</div>


										<?php endif; ?>
										<?php if ('none' === $page_sidebar){ ?>
									</div>
									<?php } ?>

									<div class="thumbnail-entry">

										<?php echo $featured_media; // WPCS: XSS OK.  ?>

									</div>

									<div class="blog-detail-article">
										<?php the_content(); ?>
									</div>


									<div class="row">
										<div class="col-sm-8">

											<?php the_tags( '<div class="tags-container"><div class="tags-title">' . esc_html__( 'Tags', 'omni' ) . ':</div>', ' ', '</div>' ); ?>

										</div>
										<div class="col-sm-4">
											<div class="share-post">
												<div class="tags-title"><?php esc_html_e( 'Share', 'omni' ) ?></div>
												<span class="share-buttons-js"></span>
											</div>
										</div>
									</div>

								</div>
								<div class="clear"></div>
							</div>
						</article>

					<?php endwhile; // End of the loop. ?>

					<?php

					if ( ! ( true === $hide_post_related ) ) {
						if ( 'list' === $post_related_style ) {
							get_template_part( 'template-parts/post-related', 'list' );
						} else {
							get_template_part( 'template-parts/post-related', 'slider' );
						}
					} ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>



					<div class="clear"></div>
				</div>

				<?php if ( ! ( 'none' === $page_sidebar ) ) {
					get_sidebar();
				} ?>

			</div>
		</div>
	</div>

	<?php get_template_part( 'template-parts/posts', 'navigation' ); ?>

	<?php get_footer(); ?>
