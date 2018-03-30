<div id="secondary" class="shop-sidebar col-md-3 hidden-sm hidden-xs" role="complementary">
    <?php if (is_active_sidebar( 'shop-sidebar' ) ) :
        dynamic_sidebar( 'shop-sidebar' );
    endif; // end sidebar widget area
    ?>
</div><!-- #secondary -->