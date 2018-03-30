<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-my-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $dfd_ronneby;

if(!isset($dfd_ronneby['woo_single_stun_header']) || $dfd_ronneby['woo_single_stun_header'] == 'on') {
	get_template_part('templates/header/top', 'woocommerce');
}

$inside_width = (isset($dfd_ronneby['woo_single_layout']) || !empty($dfd_ronneby['woo_single_layout'])) ? $dfd_ronneby['woo_single_layout']  : '';

$woo_single_enable_pagination = (isset($dfd_ronneby['woo_single_enable_pagination']) || !empty($dfd_ronneby['woo_single_enable_pagination'])) ? $dfd_ronneby['woo_single_enable_pagination']  : 'on';

$blog_sidebars = (isset($dfd_ronneby['woo_single_sidebars']) || !empty($dfd_ronneby['woo_single_sidebars'])) ? $dfd_ronneby['woo_single_sidebars']  : '';
?>

<?php
if(isset($dfd_ronneby['woo_single_enable_pagination']) && $dfd_ronneby['woo_single_enable_pagination'] == 'on') {
	$woo_single_pagination_style = (isset($dfd_ronneby['woo_single_pagination_style']) && !empty($dfd_ronneby['woo_single_pagination_style']));

	if($woo_single_pagination_style) { ?>
		<div class="row <?php echo esc_attr($inside_width); ?>">
			<div class="twelve columns">
				<?php get_template_part('templates/pagination', 'links'); ?>
				<?php get_template_part('templates/entry-meta/woo-top-link'); ?>
			</div>
		</div>
	<?php } else {
		get_template_part('templates/inside-pagination');
	}
}
?>
<section id="layout">
    <div class="row <?php echo esc_attr($inside_width); ?>">
		<?php
		if(!empty($blog_sidebars) && $blog_sidebars) {
			switch($blog_sidebars) {
				case '3c-l-fixed':
					$dfd_layout = 'sidebar-left2';
					$dfd_width = 'six dfd-eq-height';
					break;
				case '3c-r-fixed':
					$dfd_layout = 'sidebar-right2';
					$dfd_width = 'six dfd-eq-height';
					break;
				case '2c-l-fixed':
					$dfd_layout = 'sidebar-left';
					$dfd_width = 'nine dfd-eq-height';
					break;
				case '2c-r-fixed':
					$dfd_layout = 'sidebar-right';
					$dfd_width = 'nine dfd-eq-height';
					break;
				case '3c-fixed':
					$dfd_layout = 'sidebar-both';
					$dfd_width = 'six dfd-eq-height';
					break;
				case '1col-fixed':
				default:
					$dfd_layout = '';
					$dfd_width = 'twelve';
			}
			echo '<div class="blog-section ' . esc_attr($dfd_layout) . '">';
			echo '<section id="main-content" role="main" class="' . esc_attr($dfd_width) . ' columns">';
		} else {
			set_layout('single', true);
		}
		?>

            <?php while (have_posts()) : the_post(); ?>

                <?php woocommerce_get_template_part('content', 'single-product'); ?>

            <?php endwhile; ?>
		<?php
		if(!empty($blog_sidebars) && $blog_sidebars) {
			echo ' </section>';

			if (($blog_sidebars == "2c-l-fixed") || ($blog_sidebars == "3c-fixed")) {
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($blog_sidebars == "3c-l-fixed")){
				get_template_part('templates/sidebar', 'right');
				echo ' </div>';
				get_template_part('templates/sidebar', 'left');
			}
			if ($blog_sidebars == "3c-r-fixed"){
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($blog_sidebars == "2c-r-fixed") || ($blog_sidebars == "3c-fixed") || ($blog_sidebars == "3c-r-fixed") ) {
				get_template_part('templates/sidebar', 'right');
			}
			echo '</div>';
        } else {
			set_layout('single', false);
		}
		?>
    </div>
	
	<?php
		/**
		 * dfd_woocommerce_single_product_footer hook
		 *
		 * @hooked dfd_woocommerce_single_product_footer - 10
		 */
		//do_action( 'dfd_woocommerce_single_product_footer' );
	?>
</section>