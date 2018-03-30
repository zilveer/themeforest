<?php
 global $post, $mango_settings,$current_page;
 

?>
<div class="row">
            <?php
           
            $mango_footer = get_post_meta ( $current_page, 'mango_footer_widget_columns', true ) ? get_post_meta ( $current_page, 'mango_footer_widget_columns', true ) : '';
            if(!$mango_footer){
                $mango_footer = ( isset( $mango_settings[ 'mango_footer_widget_columns' ] ) ) ? $mango_settings[ 'mango_footer_widget_columns' ] : 5;
            }
          
            if($mango_footer==5) {
                $wid_class[1] = 'col-md-3';
                $wid_class[2] = 'col-md-2 col-sm-4';
                $wid_class[3] = 'col-md-2 col-sm-4';
                $wid_class[4] = 'col-md-2 col-sm-4';
                $wid_class[5] = 'col-md-3';
            }else{
                $wid_class_ = 12/$mango_footer;
                $wid_class[1] = 'col-md-'.$wid_class_;
                $wid_class[2] = 'col-md-'.$wid_class_;
                $wid_class[3] = 'col-md-'.$wid_class_;
                $wid_class[4] = 'col-md-'.$wid_class_;
                $wid_class[5] = 'col-md-'.$wid_class_;
            }
            ?>
            <?php for($i=1;$i<=$mango_footer; $i++){ ?>
                <div class="<?php echo esc_attr($wid_class[$i]); ?>">
                <?php if ( !dynamic_sidebar ( 'footer_'.$i ) ) : ?>
                    <div class="widget">
                        <h4 class="widget-title">
                            <?php echo __("Footer Widget", 'mango' ).' '.$i; ?>
                        </h4>
                        <div>
                            <p><?php _e ( "Please configure this Widget Area in the Admin Panel under Appearance -> Widget", 'mango' ) ?></p>
                        </div>
                    </div><!-- End corporate-widget -->
                    <?php endif; ?>
                </div><!-- End .widget -->
                <div class="clearfix visible-sm"></div><!-- End clearfix -->
            <?php } ?>
        </div><!-- End .row -->
	