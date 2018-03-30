<?php
/**
 * The template for displaying Quasar Product Category pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Quasar
 * @since Quasar 1.0
 */

get_header(); ?>
<?php do_action('rockthemes_pb_frontend_before_page'); ?>
<?php if(function_exists('rockthemes_pb_frontend_sidebar_before_content')) rockthemes_pb_frontend_sidebar_before_content(); ?>
	<?php 
	global $wp_query;
	$this_object = $wp_query->queried_object;
	?>

	<div id="primary" class="content-area large-<?php echo rockthemes_pb_frontend_get_content_columns_after_sidebars(); ?> column">
		<div id="content" class="site-content" role="main">
	<?php
	global $wp_query;
	$term = $wp_query->get_queried_object();

	//If Quasar Call Portfolio Shortcode function is defined, call the shortcode function.
	if(function_exists('quasar_call_gallery_shortcode') && $term):
		$portfolio_atts = array(
				'post_type'					=>	'quasargallery',
				'category'					=>	$term->slug,
				'excerpt_title_option'		=>	'title_excerpt',
				'excerpt_length'			=>	18,
				'block_grid_large'			=>	'3',
				'block_grid_medium'			=>	'3',
				'block_grid_small'			=>	'3',
				'total'						=>	get_option('posts_per_page'),
				'activate_hover_box'		=>	'false',
				'activate_hover'			=>	'true',
				'disable_hover_link'		=>	'true',
				'masonry'					=>	'true',
				'load_more'					=>	'true',
				'small_thumb_hover'			=>	'false',
				'boxed_layout'				=>	'true',
				'image_size'				=>	'rockthemes_medium',
				'pagination'				=>	'false',
				'portfolio_model'			=>	'list',
				'portfolio_model_switch'	=>	'true',
				'activate_category_link'	=>	'true',
				'header_title'				=>	'',
				'activate_header_link'		=>	'true',
				'use_shadow'				=>	'true',
				'use_swiper_for_thumbnails'	=>	'true'
		);
		quasar_call_gallery_shortcode($portfolio_atts);
		?>
	<br  />
    
    <?php
	else :
	?>
		<?php if ( have_posts() ) : ?>
        	<?php
			global $quasar_disable_regular_title;

			if(!$quasar_disable_regular_title):
			?>
			<header class="taxonomy-header">
				<h2 class="taxonomy-title">
				<?php
					if(is_category()){
						printf( __( 'Category Archives: %s', 'quasar' ), single_cat_title( '', false ) );
					}elseif(is_tag()){
						printf( __( 'Tag Archives: %s', 'quasar' ), single_tag_title( '', false ) );
					}elseif(is_tax()){
						$queried = get_queried_object();
						$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
						printf( __( $the_tax->labels->name.': %s', 'quasar' ), $queried->name );
					}elseif(is_archive()){
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'quasar' ), get_the_date() );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'quasar' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'quasar' ) ) );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'quasar' ), get_the_date( _x( 'Y', 'yearly archives date format', 'quasar' ) ) );
						else :
							_e( 'Archives', 'quasar' );
						endif;
					}else{
						echo get_the_title(get_queried_object_id()); 
					}
				?> 
				?></h2>
			</header><!-- .archive-header -->
			<?php endif; ?>
            
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php quasar_paging_nav(true); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	<?php endif; ?>
    
		<div class="vertical-space"></div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php 
if(function_exists('rockthemes_pb_frontend_sidebar_after_content')) rockthemes_pb_frontend_sidebar_after_content();
else get_sidebar();
?>
<?php do_action('rockthemes_pb_frontend_after_page'); ?>
<?php get_footer(); ?>