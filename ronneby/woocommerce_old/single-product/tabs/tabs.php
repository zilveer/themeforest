<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) :
    $i ='1';
?>

<dl class="tabs contained horisontal  twelve columns">
    <?php foreach ( $tabs as $key => $tab ) :
	$class = '';
    if ($i == '1'){
        $class .= 'active';
	}
    ?>
	<dt></dt>
    <dd class="<?php echo esc_attr($key) ?>_tab <?php echo esc_attr($class); ?>">
        <a href="#tab-<?php echo esc_attr($key); ?>" class="box-name"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ) ?></a>
    </dd>

    <?php $i++; endforeach; ?>
</dl>

<ul class="tabs-content contained clearfix twelve columns ">

    <?php
    $it ='1';
    foreach ( $tabs as $key => $tab ) :
        if ($it == '1'){
            $class = 'active';
        } else {
            $class = '';
        }

        ?>

    <li id="tab-<?php echo esc_attr($key) ?>Tab" class="<?php echo esc_attr($class); ?>">
        <?php call_user_func( $tab['callback'], $key, $tab ) ?>
    </li>

        <?php $it++; endforeach; ?>


</ul>

<?php endif; ?>
