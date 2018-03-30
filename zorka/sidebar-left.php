<div id="secondary" class="primary-sidebar col-md-3 col-md-pull-9 hidden-sm hidden-xs" role="complementary">
    <?php if (is_active_sidebar( 'primary-sidebar' ) ) :
        dynamic_sidebar( 'primary-sidebar' );
    endif; // end sidebar widget area
    ?>
</div><!-- #secondary -->