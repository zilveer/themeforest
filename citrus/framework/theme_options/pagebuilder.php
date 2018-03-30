<!-- #pagebuilder -->
<div id="pagebuilder" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#my-pagebuilder"><?php _e("Page Builder",'dt_wedding');?></a></li>
        </ul>
        

        <!-- #my-pagebuilder-->
        <div id="my-pagebuilder" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e('Page Builder','dt_wedding');?></h3>
                </div>
                
                <?php
				$dt_pb_status = dttheme_is_plugin_active('designthemes-core-features/designthemes-core-features.php');
				if($dt_pb_status) {
					
				?>
                <div class="box-content">
                
                    <div class="bpanel-option-set">

                         <h6><?php _e('Choose any of these post types to activate page builder','dt_wedding');?></h6>
                         
						<?php

						$custom_post_types = array( 'post' => 'Post', 'page' => 'Page', 'dt_portfolios' => 'Portfolio' );
						
                        foreach ( $custom_post_types as $post_type_key => $post_type_name ){
							$switchclass = ( $post_type_key ==  dttheme_option('pagebuilder', $post_type_key) ) ? 'checkbox-switch-on' :'checkbox-switch-off';
							$post_type_object = get_post_type_object( $post_type_key );
							?>
                            <div class="column one-third"><label><?php echo $post_type_object->labels->singular_name; ?></label></div>
                            <div class="column two-third last">
                                 <div data-for="mytheme-<?php echo $post_type_key;?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                                 <input class="hidden" id="mytheme-<?php echo $post_type_key;?>" name="mytheme[pagebuilder][<?php echo $post_type_key;?>]" type="checkbox" value="<?php echo $post_type_key;?>"
                                 <?php checked(dttheme_option('pagebuilder',$post_type_key),$post_type_key);?>/>
                            </div>
                    
							<?php
                        }
                        
                        ?>
                         
                         <div class="hr"></div>

                    </div><!-- .bpanel-option-set -->
 
                    <div class="bpanel-option-set">

                         <?php
						 $checked = ( true ==  dttheme_option('pagebuilder','enable-pagebuilder') ) ? ' checked="checked"' : '';
						 $pb_switchclass = ( true ==  dttheme_option('pagebuilder', 'enable-pagebuilder') ) ? 'checkbox-switch-on' :'checkbox-switch-off';
						?>
                         <h6><?php _e('Keep page builder active in above selected post types','dt_wedding'); ?></h6>
                         <div data-for="mytheme-enable-pagebuilder" class="checkbox-switch <?php echo $pb_switchclass;?>"></div>
                         <input class="hidden" id="mytheme-enable-pagebuilder" name="mytheme[pagebuilder][enable-pagebuilder]" type="checkbox" value="true" <?php $checked; ?>/>
                         
                        <div class="hr"></div>

                    </div><!-- .bpanel-option-set -->
                    
                </div> <!-- .box-content -->
                
                <?php } else { ?>
            	
                	<div class="bpanel-box">
                    	 <div class="bpanel-option-set">
                            <p class="note"><?php _e('Please activate "DesignThemes Core Features Plugin" to get the Page Builder options.','dt_themes');?></p>
                        </div>
                    </div>
                
                <?php } ?>
            
            </div><!-- .bpanel-box end -->
            
            
        </div><!--#my-footer end-->
        
    </div><!-- .bpanel-main-content end-->
</div><!-- #general end-->