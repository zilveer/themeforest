<?php global $mango_layout_columns;
$mango_left_sidebar = mango_left_sidebar();
?>
<aside class="col-md-3 sidebar <?php echo ($mango_layout_columns=='both')?' col-md-pull-6':' col-md-pull-9'; ?> " role="complementary">
<?php
    ?>
    <?php if ( !dynamic_sidebar ( $mango_left_sidebar ) ) : ?>
    <div class="widget">
        <h3 class="widget-title"><?php echo ucwords( str_replace( array( '_', '-' ), ' ', $mango_left_sidebar) ) ?></h3>
        <div>
            <p><?php _e ( "Please configure this Widget Area in the Admin Panel under Appearance -> Widget", 'mango' ) ?></p>
        </div>
    </div><!-- End .widget -->
    <?php endif; ?>
</aside><!-- End .col-md-3 -->
<div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->