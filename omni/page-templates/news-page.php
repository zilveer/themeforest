<?php
/**
 * Template Name: News Page
 *
 * @package omni
 */

global $newspage_query;

global $crum_set__blog_image_size;
global $crum_set__blog_style;

$crum_set__blog_style = cs_get_customize_option( 'blog_style' );
if ( null === $crum_set__blog_style ) {
	$crum_set__blog_style = 'standard';
}
$post_meta = get_post_meta( get_the_ID(), '_custom_page_options', true );

if ( isset( $post_meta['news_page_blog_style'] ) && ! ( empty( $post_meta['news_page_blog_style'] ) ) && ! ( 'default' === $post_meta['news_page_blog_style'] ) ) {
	$crum_set__blog_style = $post_meta['news_page_blog_style'];
}

if ( null === cs_get_customize_option( 'page_sidebar' ) ) {
	$page_sidebar = 'none';
} else {
	$page_sidebar = cs_get_customize_option( 'page_sidebar' );
}

$page_meta = get_post_meta( get_the_ID(), 'custom_sidebar_options', true );
if ( isset( $page_meta['custom_page_sidebar'] ) && ! ( empty( $page_meta['custom_page_sidebar'] ) ) && ! ( 'default' === $page_meta['custom_page_sidebar'] ) ) {
	$page_sidebar = $page_meta['custom_page_sidebar'];
}

if ( isset( $post_meta['meta_excerpt_length'] ) && ! ( empty( $post_meta['meta_excerpt_length'] ) ) ) {
	$meta_excerpt_length = $post_meta['meta_excerpt_length'];
} else {
	$meta_excerpt_length = '';
}

if ( isset( $page_sidebar ) && ( 'left' === $page_sidebar ) ) {
	$sidebar_class = 'pull-right';
} else {
	$sidebar_class = '';
}

if ( isset( $post_meta ) && ! empty( $post_meta['news_page_categories'] ) ) {
	$meta_blog_categories = $post_meta['news_page_categories'];

	if ( is_array( $meta_blog_categories ) ) {
		foreach ( $meta_blog_categories as $key => $value ) {

			$blog_cat_array[] = $value['news_page_category'];

		}
	}
}

if ( is_front_page() ) {
	$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
} else {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
}

$args = array(
	'post_type' => 'post',
	'paged'     => $paged,
);

if(isset($post_meta['news_page_posts_number']) && !empty($post_meta['news_page_posts_number'])){
	$args['posts_per_page'] = $post_meta['news_page_posts_number'];
}

if ( isset( $blog_cat_array ) && ! empty( $blog_cat_array ) ) {
	if ( false === $post_meta['post-category-include-exclude'] ) {
		$args['category__in'] = $blog_cat_array;
	} else {
		$args['category__not_in'] = $blog_cat_array;
	}
}


$blog_page_meta = get_post_meta( get_the_ID(), '_custom_page_options', true );

$posts_animation = cs_get_customize_option( 'blog_posts_animation' );
if ( isset( $blog_page_meta['meta_blog_posts_animation'] ) && ! empty( $blog_page_meta['meta_blog_posts_animation'] ) && ! ( 'default' === $blog_page_meta['meta_blog_posts_animation'] ) ) {
	$posts_animation = $blog_page_meta['meta_blog_posts_animation'];
}
if ( isset( $posts_animation ) && ! ( 'none' === $posts_animation ) ) {
	$animation_class = 'wow ' . $posts_animation;
} else {
	$animation_class = '';
}

$show_date = cs_get_customize_option( 'blog_date_display' );
if ( isset( $blog_page_meta['meta_show_date'] ) && ! empty( $blog_page_meta['meta_show_date'] ) && ! ( 'default' === $blog_page_meta['meta_show_date'] ) ) {
	if ( 'enable' === $blog_page_meta['meta_show_date'] ) {
		$show_date = true;
	} elseif ( 'disable' === $blog_page_meta['meta_show_date'] ) {
		$show_date = false;
	}
}

$show_meta = cs_get_customize_option( 'blog_meta_display' );
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

$blog_excerpt_type = cs_get_customize_option( 'blog_excerpt_type' );
if ( isset( $blog_page_meta['meta_excerpt_type'] ) && ! empty( $blog_page_meta['meta_excerpt_type'] ) && ! ( 'default' === $blog_page_meta['meta_excerpt_type'] ) ) {
	$blog_excerpt_type = $blog_page_meta['meta_excerpt_type'];
}

$excerpt_length = cs_get_customize_option( 'excerpt_length' );
if ( isset( $blog_page_meta['meta_excerpt_length'] ) && ! empty( $blog_page_meta['meta_excerpt_length'] ) && ! ( 'default' === $blog_page_meta['meta_excerpt_length'] ) ) {
	$excerpt_length = $blog_page_meta['meta_excerpt_length'];
}


if ( 'full' === $crum_set__blog_style ) {
	$content_width             = 1040;
	$crum_set__blog_image_size = 'large';
}
if ( 'image-side' === $crum_set__blog_style ) {
	$content_width             = 1040;
	$crum_set__blog_image_size = 'large';
} elseif ( 'none' === $page_sidebar ) {
	$content_width             = 1140;
	$crum_set__blog_image_size = 'large';
} else {
	$crum_set__blog_image_size = 'large';
}

set_query_var( 'posts_animation', $animation_class );
set_query_var( 'show_date', $show_date );
set_query_var( 'show_meta', $show_meta );
set_query_var( 'show_excerpt', $show_excerpt );
set_query_var( 'blog_excerpt_type', $blog_excerpt_type );
set_query_var( 'excerpt_length', $excerpt_length );

?>

<?php get_header(); ?>

	<section class="blog-section">
		<div class="container">
			<?php if ( ! ( true === $page_meta['page_padding_disable'] ) && isset( $page_meta['page_padding_disable'] ) ){ ?>
			<div class="new-block">
				<?php } ?>
				<?php if(empty($page_meta['page_title_hide'])){?>
				<div class="row page-tagline">
					<div class="col-md-6 col-md-offset-3">
						<h2 class="title"><?php the_title();?></h2>
					</div>
				</div>
				<?php }?>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

					</article><!-- #post-## -->

				<?php endwhile; ?>
				<div class="row">
					<?php
					if ( ( 'none' === $page_sidebar ) && isset( $page_sidebar ) ) {

						echo '<div class=" col-md-12 col-sm-12 col-xs-12">';

					} else {

						echo '<div class=" col-md-8 blog-content-column ' . esc_attr( $sidebar_class ) . '">';
					} ?>

					<?php
					wp_reset_postdata();

					$newspage_query = new WP_Query( $args );

					if ( $newspage_query->have_posts() ) :

						while ( $newspage_query->have_posts() ) : $newspage_query->the_post();

							$format = get_post_format();
							if ( false === $format ) {
								$format = 'standard';
							}

							get_template_part( 'post-formats/format', $format );

						endwhile;


						crum_posts_navigation( 'newspage_query' );

					endif;?>


				</div>
				<!-- end content -->

				<?php if ( ! ( 'none' === $page_sidebar ) ) {
					get_sidebar();
				} ?>
				<?php echo '</div>';// end columns ?>
			</div>
			<?php if ( ! ( true === $page_meta['page_padding_disable'] ) && isset( $page_meta['page_padding_disable'] ) ){ ?>
		</div>
		<?php } ?>
		<!-- end row -->
		</div>
		<!-- end container -->
	</section><!-- end blog-section -->


<?php get_footer(); ?>