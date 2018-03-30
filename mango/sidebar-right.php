<aside class="col-md-3 sidebar" role="complementary">
    <?php
    $mango_right_sidebar = mango_right_sidebar();
    ?>
    <?php if ( !dynamic_sidebar ( $mango_right_sidebar ) ) : ?>
        <div class="widget">
            <h3 class="widget-title"><?php echo ucwords( str_replace( array( '_', '-' ), ' ', $mango_right_sidebar) ) ?></h3>
            <div>
                <p><?php _e ( "Please configure this Widget Area in the Admin Panel under Appearance -> Widget", 'mango' ) ?></p>
            </div>
        </div><!-- End .widget -->
    <?php endif; ?> 
</aside><!--sEnd .col-md-3 -->

