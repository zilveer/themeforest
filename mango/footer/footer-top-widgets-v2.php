<?php
global $mango_settings , $post, $current_page;

    $id = $post->ID;
    $mango_hide_footer = get_post_meta ( $current_page, 'mango_top_footer_widget_hide', true ) ? get_post_meta ( $current_page, 'mango_top_footer_widget_hide', true ) : '';
	if($mango_hide_footer==1){
		return;
	}
 
$mango_top_footer_v2 = get_post_meta ( $current_page, 'mango_top_footer_widget_v2_columns', true ) ? get_post_meta ( $current_page, 'mango_top_footer_widget_v2_columns', true ) : '';

if(!$mango_top_footer_v2){
    $mango_top_footer_v2 = ( isset( $mango_settings[ 'mango_top_footer_widget_v2_columns' ] ) ) ? $mango_settings[ 'mango_top_footer_widget_v2_columns' ] : 4;
}
?>
<div id="footer-inner">
    <div class="row footer_v2">
        <?php  $widget_classs = 12/$mango_top_footer_v2; ?>
        <?php for($i=1; $i<= $mango_top_footer_v2; $i++){ ?>
        <div class="col-sm-<?php echo esc_attr($widget_classs); ?>">
            <?php if ( !dynamic_sidebar ( 'footer_top_v2_'.$i ) ) : ?>
                <div class="widget">
                    <h4 class="widget-title">
                        <?php echo __("Footer Top Widget v2", 'mango' ).' '.$i; ?>
                    </h4>
                    <div>
                        <p><?php _e ( "Please configure this Widget Area in the Admin Panel under Appearance -> Widget", 'mango' ) ?></p>
                    </div>
                </div><!-- End corporate-widget -->
            <?php endif; ?>
        </div><!-- End .col-sm-* -->
        <?php } ?>
    </div><!-- End .row -->
</div><!-- End #footer-inner -->