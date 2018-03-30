            </div> <!-- End id="inner-content-container" -->
        </div> <!-- End id="content-container" -->
        
        <?php
            
            $slider_header_footer_style = uxbarn_get_slider_header_footer_style();
			
			if ( function_exists( 'ot_get_option' ) ) {
					
	            $display_footer_widget_area = ot_get_option('uxbarn_to_setting_display_footer_widget_area');
				if ( $display_footer_widget_area == '' || $display_footer_widget_area == 'false' ) {
					$display_footer_widget_area = false;
				} else {
					$display_footer_widget_area = true;
				}
	            
	            $footer_widget_area_columns = (int)ot_get_option('uxbarn_to_setting_footer_widget_area_columns');
				
			} else {
				
				$display_footer_widget_area = true;
				$footer_widget_area_columns = 3;
				
			}
				
            $has_any_widgets = false;
            $footer_bar_top_margin_class = ''; 
            
            for($i = 1; $i <= $footer_widget_area_columns; $i++) {
                
                $sidebar_id = 'footer-widget-area-' . $i;
                /*$widgets_count = uxbarn_count_sidebar_widgets($sidebar_id, false);
                
                if($widgets_count > 0) {
                    $has_any_widgets = true;
                }*/
                
                // Check if the current sidebar has any widgets
                if(is_active_sidebar($sidebar_id)) {
                    $has_any_widgets = true;
                }
                
            }
            
            if(!$has_any_widgets || $display_footer_widget_area == false) {
                $footer_bar_top_margin_class = ' top-margin ';
            }
            
        ?>
        
        <div id="footer-root-container"<?php echo $slider_header_footer_style; ?>>
            
            <?php if($display_footer_widget_area && $has_any_widgets) : ?>
                
                <div id="footer-content-container">
                    <div id="footer-content-inner-wrapper" class="content-width">
                        <div id="footer-content" class="row top-margin">
                            
                            <?php
                                
                                $col_num = 12 / $footer_widget_area_columns;
                                
                                for($i = 1; $i <= $footer_widget_area_columns; $i++) {
                                    
                                    $sidebar_id = 'footer-widget-area-' . $i;
                                    
                                    ?>
                                    
                                    <div class="uxb-col large-<?php echo $col_num; ?> columns less-padding">
                                        <?php dynamic_sidebar($sidebar_id); ?>
                                    </div>
                                    
                                    <?php
                                    
                                }
                            
                            ?>
                            
                        </div>
                    </div>
                </div> <!-- End id="footer-content-container" -->
                
            <?php endif; ?>
                
            <!-- Footer Bar -->
            <?php
                
                $copyright_column = ' large-12 center ';
                $social_string = uxbarn_get_footer_social_list_string();
                if($social_string != '') {
                    $copyright_column = ' large-6 ';
                }
            
            ?>
            <div id="footer-bar-container" class="row <?php echo $footer_bar_top_margin_class; ?>">
                <div id="footer-bar-inner-wrapper" class="content-width">
                    <div class="uxb-col <?php echo $copyright_column; ?> columns less-padding">
                        
                        <?php 
                        	
                        	$copyright_text = __( '&copy; Archtek. Premium Theme by <a href="http://themeforest.net/user/UXbarn?ref=UXbarn">UXBARN</a>.', 'uxbarn' );
							if ( function_exists( 'ot_get_option' ) ) {
								$copyright_text = ot_get_option('uxbarn_to_setting_copyright_text');
							}
							
                        	echo balanceTags( $copyright_text, true ); 
                        	
                    	?>
                        
                    </div>
                    
                    <?php if($social_string != '') : ?>
                            
                        <div class="uxb-col large-6 columns less-padding">
                            <div id="footer-social">
                                <span><?php _e('Connect with us:', 'uxbarn'); ?></span> 
                                <ul class="bar-social">
                                    <?php echo $social_string; ?>
                                </ul>
                            </div>
                        </div>
                                
                    <?php endif; ?>
                            
                </div>
            </div> <!-- End id="footer-bar-container" -->
            
        </div> <!-- End id="footer-root-container" -->

        <?php wp_footer(); ?>
        
        </div> <!-- End id="root-container" -->
    </body>
</html>