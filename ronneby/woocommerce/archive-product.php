<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author         WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $dfd_ronneby;

$options = array(
	'woo_category_stun_header' => false,
	'woo_category_layout' => false,
	'woo_category_sidebars' => '1col-fixed',
	'woo_category_cat_tag' => false,
);

foreach($options as $option => $default) {
	if(isset($dfd_ronneby[$option]) && !empty($dfd_ronneby[$option])) {
		$options[$option] = $dfd_ronneby[$option];
	}
}

if($options['woo_category_stun_header'] != 'off') {
	get_template_part('templates/header/top', 'woocommerce');
}

if($options['woo_category_cat_tag'] != 'off') {
	?>
	<div class="blog-top row <?php echo esc_attr($options['woo_category_layout']) ?>">
		<div class="twelve columns">
			<?php get_template_part('templates/woo', 'top'); ?>
		</div>
	</div>
<?php } ?>

<section id="layout" class="dfd-woo-category-loop dfd-equal-height-children">

	<div class="row module dfd-woo-archive <?php echo esc_attr($options['woo_category_layout']) ?>">
		<?php
		if(!empty($options['woo_category_sidebars']) && $options['woo_category_sidebars']) {
			switch($options['woo_category_sidebars']) {
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
			?>
			<div class="blog-section <?php echo esc_attr($dfd_layout) ?>">
				<section id="main-content" role="main" class="<?php echo esc_attr($dfd_width) ?> columns">
		<?php
		} else {
			set_layout('archive', true);
		}
		?>
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

				<h2 class="widget-title  text-left woo-page-title">
					<span><?php woocommerce_page_title(); ?></span>
				</h2>

			<?php endif; ?>
			
			<div class="clear"></div>
			
            <?php
            global $post;
            $shop_page_id = woocommerce_get_page_id( 'shop' );
            $shop_page    = get_post( $shop_page_id );


            if ( is_post_type_archive() && !empty($shop_page) && is_object($shop_page) ){ ?>
                <div class="shop__main_desc">
					<?php
					$content = apply_filters('the_content', $shop_page->post_content);
					echo $content;
					?>
                </div>
            <?php
			}
            ?>
			
			<div class="clear"></div>
			
			
            <?php if (have_posts()) : ?>
			
				<div class="dfd-woo-category-wrap">

					<div class="dfd-woo-category">

						<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */

						remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

						do_action('woocommerce_before_shop_loop');

						?>

						<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php
							global $woocommerce_loop;
							if(isset($dfd_ronneby['woo_category_columns']) && !empty($dfd_ronneby['woo_category_columns']))
								$woocommerce_loop['columns'] =  apply_filters( 'loop_shop_columns', (int) $dfd_ronneby['woo_category_columns']);
							else
								$woocommerce_loop['columns'] = 3;
						?>
						<?php while (have_posts()) : the_post(); ?>

							<?php woocommerce_get_template_part('content', 'product'); ?>

							<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>

						<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action('woocommerce_after_shop_loop');
						?>
					</div>

				</div>

            <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

				<?php woocommerce_get_template('loop/no-products-found.php'); ?>

            <?php endif; ?>

	
		<?php
			if(!empty($options['woo_category_sidebars']) && $options['woo_category_sidebars']) { ?>
				</section>
				<?php
				if (($options['woo_category_sidebars'] == "2c-l-fixed") || ($options['woo_category_sidebars'] == "3c-fixed")) {
					?>
					<aside class="three columns dfd-eq-height" id="left-sidebar">
						<?php dynamic_sidebar('shop-sidebar-product-list-left'); ?>
					</aside>
					<?php
					echo ' </div>';
				}
				if (($options['woo_category_sidebars'] == "3c-l-fixed")){
					?>
					<aside class="three columns dfd-eq-height" id="right-sidebar">
						<?php dynamic_sidebar('shop-sidebar-product-list'); ?>
					</aside>
					<?php
					echo ' </div>';
					?>
					<aside class="three columns dfd-eq-height" id="left-sidebar">
						<?php dynamic_sidebar('shop-sidebar-product-list-left'); ?>
					</aside>
					<?php
				}
				if ($options['woo_category_sidebars'] == "3c-r-fixed"){
					?>
					<aside class="three columns dfd-eq-height" id="left-sidebar">
						<?php dynamic_sidebar('shop-sidebar-product-list-left'); ?>
					</aside>
					<?php
					echo ' </div>';
				}
				if (($options['woo_category_sidebars'] == "2c-r-fixed") || ($options['woo_category_sidebars'] == "3c-fixed") || ($options['woo_category_sidebars'] == "3c-r-fixed") ) {
					?>
					<aside class="three columns dfd-eq-height" id="right-sidebar">
						<?php dynamic_sidebar('shop-sidebar-product-list'); ?>
					</aside>
					<?php
				}
			} else {
				set_layout('archive', false);
			}
			?>

		</div>
    </div>
</section>