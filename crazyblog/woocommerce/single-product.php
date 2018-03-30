<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
$crazyblog_meta = get_post_meta( get_the_ID(), 'crazyblog_page_meta', true );
$sidebar = (crazyblog_set( $crazyblog_meta, 'sidebar' )) ? crazyblog_set( $crazyblog_meta, 'sidebar' ) : 'primary-widget-area';
$layout = (crazyblog_set( $crazyblog_meta, 'layout' )) ? crazyblog_set( $crazyblog_meta, 'layout' ) : '';
$show_banner = crazyblog_set( $crazyblog_meta, 'page_title_section' );
$bg = (crazyblog_set( $crazyblog_meta, 'title_section_bg' )) ? 'background:url(' . crazyblog_set( $crazyblog_meta, 'title_section_bg' ) . ')' : "";

if ( $show_banner ) :
	?>
	<div class="pagetop" style="<?php echo esc_attr( $bg ); ?>">
		<div class="page-name">
			<div class="container">
				<span><?php echo esc_html( get_the_title() ); ?></span>
				<?php echo crazyblog_get_breadcrumbs(); ?>
			</div>
		</div>
	</div><!-- Page Top -->
<?php endif; ?>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<?php if ( $sidebar && $layout == 'left' && is_active_sidebar( $sidebar ) ): ?>
					<aside class="col-md-4 column left-sidebar sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
				<div class="<?php echo esc_js( ($layout == 'full' || $layout == '') ? 'col-md-12' : 'col-md-8'  ); ?> column">
					<div class="single-product">
						<div class="row">
							<?php
							while ( have_posts() ) : the_post();
								wc_get_template_part( 'content', 'single-product' );
							endwhile;
							?>
						</div>
					</div>
				</div>
				<?php if ( $sidebar && $layout == 'right' && is_active_sidebar( $sidebar ) ): ?>
					<aside class="col-md-4 column right-sidebar sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();

