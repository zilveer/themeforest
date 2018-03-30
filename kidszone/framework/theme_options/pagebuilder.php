<!-- #pagebuilder -->
<div id="pagebuilder" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#my-pagebuilder"><?php _e("Page Builder",'iamd_text_domain');?></a></li>
        </ul>
        

        <!-- #my-pagebuilder-->
        <div id="my-pagebuilder" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e('Page Builder','iamd_text_domain');?></h3>
                </div>
                
                <?php
				$dt_pb_status = dt_theme_is_plugin_active('designthemes-core-features/designthemes-core-features.php');
				if($dt_pb_status) {
				?>
                <div class="box-content">
                
                    <div class="bpanel-option-set">
                    
						<h6><?php esc_html_e('Choose any of these post types to activate page builder', 'iamd_text_domain');?></h6><?php
						//Getting post types...
						$post_types = array( 'post' => 'Post', 'page' => 'Page', 'dt_galleries' => 'Gallery');
						foreach ( $post_types as $key => $pname ):
							
							$sel_posttypes = array();
							if(is_array(dt_theme_option('pagebuilder', 'post-types'))) {
								$sel_posttypes = dt_theme_option('pagebuilder', 'post-types');	
							} else {
								$sel_posttypes = dt_theme_option('pagebuilder', $key);
								$sel_posttypes = !is_array($sel_posttypes) ? array($sel_posttypes => $sel_posttypes) : $sel_posttypes;
							}
							
						  	$switchclass = ( array_key_exists($key, $sel_posttypes) && $key ==  $sel_posttypes[$key] ) ? 'checkbox-switch-on' :'checkbox-switch-off';
						  	$obj = get_post_type_object( $key );?>
							  <div class="column one-third"><label><?php echo esc_attr($obj->labels->singular_name); ?></label></div>
							  <div class="column two-third last">
								   <div data-for="mytheme-<?php echo esc_attr($key);?>" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
								   <input class="hidden" id="mytheme-<?php echo esc_attr($key);?>" name="mytheme[pagebuilder][post-types][<?php echo esc_attr($key);?>]" type="checkbox" value="<?php echo esc_attr($key);?>"
								   <?php if(array_key_exists($key, $sel_posttypes)) checked($sel_posttypes[$key],$key);?>/>
							  </div><?php
						endforeach;
                    	?>

                         <div class="hr"></div>

                    </div><!-- .bpanel-option-set -->
 
                    <div class="bpanel-option-set">

                         <?php
						 $checked = ( true ==  dt_theme_option('pagebuilder','enable-pagebuilder') ) ? ' checked="checked"' : '';
						 $pb_switchclass = ( true ==  dt_theme_option('pagebuilder', 'enable-pagebuilder') ) ? 'checkbox-switch-on' :'checkbox-switch-off';
						?>
                         <h6><?php _e('Keep page builder active in above selected post types','iamd_text_domain'); ?></h6>
                         <div data-for="mytheme-enable-pagebuilder" class="checkbox-switch <?php echo $pb_switchclass;?>"></div>
                         <input class="hidden" id="mytheme-enable-pagebuilder" name="mytheme[pagebuilder][enable-pagebuilder]" type="checkbox" value="true" <?php $checked; ?>/>
                         
                        <div class="hr"></div>

                    </div><!-- .bpanel-option-set -->
                    
                    <div class="bpanel-option-set">
                    
                        <?php
						if(dt_theme_option('pagebuilder_update') == 'done') { $disable_cls = 'disabled'; }
						else { $disable_cls = ''; }
						?>
                        <h6><?php esc_html_e('Update page contents for latest page builder', 'iamd_text_domain'); ?></h6>
                        <input type="button" value="<?php esc_attr_e('Update Content','iamd_text_domain');?>" class="dt_update_pagebuilder_contents <?php echo $disable_cls; ?>" />
						<p class="note"><?php esc_html_e('Latest page builder update needs your content to be updated. Please click the above button to update it. It may take while please be patient.','iamd_text_domain');?></p>
                        <div class="hr"></div>
						
					</div>
                    
                </div> <!-- .box-content -->
                
                <?php } else { ?>
            	
                	<div class="bpanel-box">
                    	 <div class="bpanel-option-set">
                            <p class="note"><?php _e('Please activate "DesignThemes Core Features Plugin" to get the Page Builder options.','iamd_text_domain');?></p>
                        </div>
                    </div>
                    
                <?php } ?>
                
            </div><!-- .bpanel-box end -->
            
            
        </div><!--#my-footer end-->
        
    </div><!-- .bpanel-main-content end-->
</div><!-- #general end-->