<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product,$zorka_data;
$product_new = get_post_meta(get_the_ID(),'zorka_product_new',true);
$sale_percent = 0;
if ($product->is_on_sale() && $product->product_type != 'grouped') {
    if ($product->product_type == 'variable') {
        $available_variations =  $product->get_available_variations();
        for ($i = 0; $i < count($available_variations); ++$i) {
            $variation_id = $available_variations[$i]['variation_id'];
            $variable_product1 = new WC_Product_Variation( $variation_id );
            $regular_price = $variable_product1->get_regular_price();
            $sales_price = $variable_product1->get_sale_price();
            $price = $variable_product1->get_price();
            if ( $sales_price != $regular_price && $sales_price == $price ) {
                $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
                if ($percentage > $sale_percent) {
                    $sale_percent = $percentage;
                }
            }
        }
    } else {
        $sale_percent = round((( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100),1) ;
    }
    $sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
}

if (isset($sales_price_to) && !empty($sales_price_to)) {
    $sales_price_date_to = date("Y/m/d", $sales_price_to);
}
$product_sale_flash_mode = isset($zorka_data['product-sale-flash-mode']) ? $zorka_data['product-sale-flash-mode'] : 'percent';
?>
<?php if (($product->is_on_sale()) || ($product_new == 'yes')) : ?>
    <div class="product-item-feature">
        <?php if ($product->is_on_sale()) : ?>
            <?php if ($product_sale_flash_mode == 'percent') : ?>
                <?php if ($sale_percent > 0) : ?>
                    <?php echo apply_filters( 'woocommerce_sale_flash', '<div class="on-sale"><span>-' . $sale_percent . '%</span></div>', $post, $product ); ?>
                <?php endif; ?>
            <?php else: ?>
                <?php echo apply_filters( 'woocommerce_sale_flash', '<div class="on-sale"><span>' . esc_html__('Sale!', 'woocommerce' ) . '</span></div>', $post, $product ); ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($product_new == 'yes') : ?>
            <div class="on-new"><span><?php esc_html_e("New","zorka"); ?></span></div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if (isset($sales_price_date_to)) : ?>
    <div class="product-deal-countdown" data-date-end="<?php echo esc_attr($sales_price_date_to); ?>">
        <div class="product-deal-countdown-inner">
            <div class="countdown-section">
                <span class="countdown-amount countdown-day"></span>
                <span class="countdown-period"><?php esc_html_e('Days','zorka'); ?></span>
            </div>
            <div class="countdown-section">
                <span class="countdown-amount countdown-hours"></span>
                <span class="countdown-period"><?php esc_html_e('Hours','zorka'); ?></span>
            </div>
            <div class="countdown-section">
                <span class="countdown-amount countdown-minutes"></span>
                <span class="countdown-period"><?php esc_html_e('Minutes','zorka'); ?></span>
            </div>
            <div class="countdown-section">
                <span class="countdown-amount countdown-seconds"></span>
                <span class="countdown-period"><?php esc_html_e('Seconds','zorka'); ?></span>
            </div>
        </div>
    </div>
<?php endif; ?>

