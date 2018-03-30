<?php
global $sidebar_width;
$shop_page_id = null;

if ( is_shop() ){
    $shop_page_id = woocommerce_get_page_id( 'shop' );
    $page_title   = get_the_title( $shop_page_id );
}

$sidebar_position = ishyoboy_get_sidebar_position($shop_page_id);

if ( 'left' == $sidebar_position || 'right' == $sidebar_position){
?>
<div class="grid3 <?php echo $sidebar_position . '-sidebar' ?>" id="sidebar">
    <div class="row">
        <?php $sidebar_width = 3; // Used when displaying widgets ?>
        <?php $sidebar = ishyoboy_get_sidebar($shop_page_id); ?>
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) : else : ?>

        <div class="pre-widget">
            <div class="space"></div>
            <p><strong>Widgetized Sidebar</strong></p>
            <p>This panel is active and ready for you to add some widgets via the WP Admin</p>
        </div>

        <?php endif; ?>

        <div class="space"></div>

    </div>
</div>
<?php
}
?>