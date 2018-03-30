<!-- #advance starts here-->
<div id="branding" class="bpanel-content">
  	<!-- .bpanel-main-content starts here-->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
            <li><a href="#my-admin"><?php _e("Admin",'iamd_text_domain');?></a></li>
        </ul>
        

        <!-- #my-admin starts here --> 
        <div id="my-admin" class="tab-content">
        	<div class="bpanel-box">
 
                <!-- Buddha Panel logo -->
                <div class="box-title">
                   <h3><?php _e('Buddha Panel Logo','iamd_text_domain');?></h3>
                </div>
                
                <div class="box-content">
                	<h6> <?php _e('Replace Buddha Panel Logo','iamd_text_domain');?> </h6>
                    
                    <div class="column one-fifth">                
						<?php $checked = ( "true" ==  dt_theme_option('advance','enable-buddhapanel-logo-url') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  dt_theme_option('advance','enable-buddhapanel-logo-url') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="enable-buddhapanel-logo-url" class="checkbox-switch <?php echo $switchclass;?>"></div>
                        <input class="hidden" id="enable-buddhapanel-logo-url" name="mytheme[advance][enable-buddhapanel-logo-url]" type="checkbox" value="true" 
                        <?php echo $checked;?> />
                    </div>
                    
                    <div class="column four-fifth last">                
                        <div class="image-preview-container">
                            <input id="mytheme-buddhapanellogo" name="mytheme[advance][buddhapanel-logo-url]" type="text" class="uploadfield medium" readonly="readonly"
                                value="<?php echo  dt_theme_option('advance','buddhapanel-logo-url');?>" />
                            <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                            <?php dt_theme_adminpanel_image_preview(dt_theme_option('advance','buddhapanel-logo-url'),true,'logo.png');?>
                        </div>
                    </div>
                    <p class="note"> <?php _e('Upload an image to replace the default buddha panel logo.<b><i>You can set your own brnad</i></b>. ','iamd_text_domain');?> </p>
                    
                </div><!-- Buddha Panel logo -->
                
                
            </div> <!-- .bpanel-box ends here -->
        </div><!-- #my-admin ends here -->
     </div><!-- .bpanel-main-content ends here-->   
</div><!-- #advance ends here -->