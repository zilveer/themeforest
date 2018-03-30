<?php
global $ttso;
$woocommerce_breadcrumbs    = esc_attr( $ttso->st_woocommerce_breadcrumbs );
$woocommerce_title          = esc_html( $ttso->st_woocommerce_title );
$woocommerce_description    = esc_textarea( $ttso->st_woocommerce_description );
?>

<div class="center-wrap <?php if ( 'true' == $woocommerce_breadcrumbs ) echo 'banner-no-crumbs'; ?>">
    <p class="page-banner-heading"><?php echo esc_attr( $woocommerce_title ); ?></p>

    <?php if ( '' != $woocommerce_description ) : ?>
        <p class="page-banner-description"><?php echo esc_attr( $woocommerce_description ); ?></p>
    <?php endif; ?>

    <?php if ( 'true' == $woocommerce_breadcrumbs ) : ?>
        <div class="breadcrumbs"><?php tt_woo_breadcrumbs(); ?></div><!-- end .breadcrumbs -->
    <?php endif; ?>
</div><!-- end .center-wrap -->
<div class="shadow top"></div>
<div class="shadow bottom"></div>
<div class="tt-overlay"></div>