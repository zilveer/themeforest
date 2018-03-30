<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

if ( !function_exists('sf_add_desc_tab') ) {
	function sf_add_desc_tab($tabs = array()) {
		global $post;
		$product_description = sf_get_post_meta($post->ID, 'sf_product_description', true);
		if ($product_description != "") {
			$tabs['description'] = array(
				'title'    => __( 'Description', 'swiftframework' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);
		}
		return $tabs;
	}
	add_filter('woocommerce_product_tabs', 'sf_add_desc_tab', 0);
}

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

$options = get_option('sf_neighborhood_options');
if (isset($options['enable_default_tabs'])) {
	$enable_default_tabs = $options['enable_default_tabs'];
} else {
	$enable_default_tabs = false;
}

$count = 0;

if ( ! empty( $tabs ) ) : ?>

	<?php if ($enable_default_tabs) { ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>

			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>

		<?php endforeach; ?>
	</div>

	<?php } else { ?>

	<div class="accordion" id="product-accordion">

		<?php foreach ( $tabs as $key => $tab ) : ?>
		
		<?php 
			
			$class = "";
			
			if ($count == 0) {
				$class = "in";
			}
			
		?>

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#product-accordion" href="#product-<?php echo $key ?>">
					<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
				</a>
	    	</div>
	    	<div id="product-<?php echo esc_attr($key); ?>" class="accordion-body collapse <?php echo $class; ?>">
	      		<div class="accordion-inner">
	      			<?php call_user_func( $tab['callback'], $key, $tab ) ?>
	      		</div>
	  		</div>
		</div>
		<?php 
			$count++;
			endforeach;
		?>

	</div>

	<?php } ?>

<?php endif; ?>