<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $product, $porto_settings;

$tag = (isset($porto_settings['category-addlinks-convert']) && $porto_settings['category-addlinks-convert']) ? 'span' : 'a';
$link = (isset($porto_settings['category-addlinks-convert']) && $porto_settings['category-addlinks-convert']) ? '' : 'href="' . esc_url( add_query_arg( 'add_to_wishlist', $product_id ) ) . '" rel="nofollow"';
?>

<<?php echo $tag ?> <?php echo $link ?> data-product-id="<?php echo $product_id ?>" data-product-type="<?php echo $product_type?>" class="<?php echo $link_classes ?>" >
    <?php echo $icon ?>
    <?php echo $label ?>
</<?php echo $tag ?>>
<span class="ajax-loading"></span>