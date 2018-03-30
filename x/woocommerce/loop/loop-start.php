<?php

// =============================================================================
// WOOCOMMERCE/LOOP/LOOP-START.PHP
// -----------------------------------------------------------------------------
// @version 2.0.0
// =============================================================================

?>

<?php $columns      = x_get_option( 'x_woocommerce_shop_columns' ); ?>
<?php $column_class = ( is_shop() || is_product_category() || is_product_tag() ) ? ' cols-' . $columns : ''; ?>

<ul class="products<?php echo $column_class; ?>">