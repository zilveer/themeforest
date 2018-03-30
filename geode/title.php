<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */
?>

	<header class="entry-header row">
		<div class="row-inside">
			<?php do_action('pix_title_bg'); ?>
			<?php
				if ( is_tax() ) :
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php echo $term->name; ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>
				<?php elseif ( is_day() ) : ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php printf( __( 'Daily Archives: %s', 'geode' ), get_the_date() ); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_month() ) : ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php printf( __( 'Monthly Archives: %s', 'geode' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'geode' ) ) ); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_year() ) : ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php printf( __( 'Yearly Archives: %s', 'geode' ), get_the_date( _x( 'Y', 'yearly archives date format', 'geode' ) ) ); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_post_type_archive() ) : ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php post_type_archive_title(); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_category() ) : ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php echo single_cat_title( '', false ); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_archive() ) : ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php _e( 'Archives', 'geode' ); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_home() && !is_front_page() ) : ?>
					<?php $id = get_option('page_for_posts'); ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php echo get_the_title($id); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_home() && is_front_page() ) : ?>
					<?php $id = get_option('page_for_posts'); ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php echo apply_filters( 'geode_blog_title', __( 'Blog', 'geode' )); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_404() ) : ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'geode' ); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php elseif ( is_search() ) : ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php _e('Search results', 'geode'); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>

				<?php else : ?>
					<?php if ( !pix_hide_title() ) { ?>
					<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
						<h1 class="entry-title"><span class="row-inside"><?php the_title(); ?></span></h1>
						<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
					</div>
					<?php } ?>

				<?php endif;
			?>
		</div>
	</header>
