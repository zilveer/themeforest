<!-- #mobile -->
<div id="mobile" class="bpanel-content">
  <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
            <li><a href="#my-responsive"><?php _e("Responsive",'dt_themes');?></a></li>        
        </ul>
        
        <!-- #my-responsive start --> 
        <div id="my-responsive" class="tab-content">
        	<div class="bpanel-box">
                <!-- Responsive Layout Options start -->
                <div class="box-title"><h3><?php _e('Responsive','dt_themes');?></h3></div>
                <div class="box-content">
                
	                <div class="one-half-content">
    	            	<div class="bpanel-option-set">
                          <h6><?php _e("Make My Site Responsive",'dt_themes');?></h6>
                          <?php $checked = ( "true" ==  dttheme_option('mobile','is-theme-responsive') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  dttheme_option('mobile','is-theme-responsive') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="is-theme-responsive" class="checkbox-switch <?php echo $switchclass;?>"></div>
                          <input class="hidden" id="is-theme-responsive" name="mytheme[mobile][is-theme-responsive]" type="checkbox" value="true" <?php echo $checked;?> />
                          <p class="note"><?php _e('Choose whether you need responsive version for your website','dt_themes');?></p>
        	            </div>
                     </div>

	                <div class="one-half-content last">
    	            	<div class="bpanel-option-set">
	                      <h6><?php _e('Disable Slider for Mobile Devices','dt_themes');?></h6>
                          <?php $checked = ( "true" ==  dttheme_option('mobile','is-slider-disabled') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  dttheme_option('mobile','is-slider-disabled') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="is-slider-disabled" class="checkbox-switch <?php echo $switchclass;?>"></div>
                          <input class="hidden" id="is-slider-disabled" name="mytheme[mobile][is-slider-disabled]" type="checkbox" value="true" <?php echo $checked;?> />
                          <p class="note"><?php _e('Choose whether you wish to hide / display the slider area of your website on mobile devices','dt_themes');?></p>
        	            </div>
                    </div>
                </div><!-- Responsive Layout Options end -->
            
            </div>
        </div><!-- #my-responsive end -->
        
     </div><!-- .bpanel-main-content end-->   
</div><!-- #mobile end -->