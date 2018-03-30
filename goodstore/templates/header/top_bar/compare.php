<?php global $yith_woocompare; ?>
<a href="<?php echo esc_url(add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() )); ?>" class="yith-woocompare-open">
    <span class="icon-arrow3"></span>
    <span><?php _e( 'Compare', 'jawtemplates' ) ?></span>
</a>