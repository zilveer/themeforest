<?php
    global $mango_settings , $post,$current_page;
    if(isset($post)) {
        $id = $post->ID;
    }else{
        $id = 0;
    }
    $mango_hide_footer = get_post_meta ( $current_page, 'mango_top_footer_widget_hide', true ) ? get_post_meta ( $current_page, 'mango_top_footer_widget_hide', true ) : '';
    if($mango_hide_footer==1){
        return;
    }

    if(!$mango_hide_footer){
        $mango_hide_footer = ( isset( $mango_settings[ 'mango_hide_footer_top_widgets' ] ) ) ? $mango_settings[ 'mango_hide_footer_top_widgets' ] : '';
        if($mango_hide_footer){
            return;
        }
    }

    $mango_top_footer = get_post_meta ( $current_page, 'mango_top_footer_widget_columns', true ) ? get_post_meta ( $current_page, 'mango_top_footer_widget_columns', true ) : '';
    if(!$mango_top_footer){
        $mango_top_footer = ( isset( $mango_settings[ 'mango_top_footer_widget_columns' ] ) ) ? $mango_settings[ 'mango_top_footer_widget_columns' ] : 4;
    }
?>
<div id="footer-top">
    <div class="container">
        <div class="row">
            <?php  $widget_classs = 12/$mango_top_footer; ?>
            <?php for($i=1; $i<= $mango_top_footer; $i++){ ?>
            <div class="col-sm-<?php echo esc_attr($widget_classs); ?>">
                <?php if ( !dynamic_sidebar ( 'footer_top_'.$i ) ) : ?>
                <div class="widget">
                    <h4 class="widget-title"><?php echo __("Footer Top Widget", 'mango' ).' '.$i; ?></h4>
                    <div>
                        <p>
                            <?php _e ( "Please configure this Widget Area in the Admin Panel under Appearance -> Widget", 'mango' ) ?>
                        </p>
                    </div>
                </div>
               <?php endif; ?>
            </div><!-- End .col-md-*-->
            <?php } ?>

        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End #footer-top -->