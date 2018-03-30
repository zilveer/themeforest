<!-- #Buddha Bar Settings -->
<div id="bbar" class="bpanel-content">
    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
            <li><a href="#my-bar"><?php _e("Bar Settings",'dt_themes');?></a></li>
        </ul>
        
        <!-- #my-bar-->
        <div id="my-bar" class="tab-content">
        	
            <!-- Settings -->
            <div class="bpanel-box">
		        <div class="box-title"><h3><?php _e('Bar Settings','dt_themes');?></h3></div>
                <div class="box-content">
                	
                    <div class="column one-half">
                    	<h6><?php _e('Enable Bar','dt_themes');?></h6>
	                	<?php dttheme_switch("",'bbar','show-bbar');?>
                    </div>

                    <div class="column one-half last">
                    	<h6><?php _e('Hide Bar by default','dt_themes');?></h6>
	                	<?php dttheme_switch("",'bbar','status-bbar');?>
                    </div>
                    
                    <div class="hr"> </div>

                
                    <div class="column one-half">
                        <?php $label = 		__("Bar BG Color",'dt_themes');
                          $name  =		"mytheme[bbar][bar-bg-color]";	
                          $value =  	 (dttheme_option('bbar','bar-bg-color')!= NULL) ? dttheme_option('bbar','bar-bg-color') : "#";
                          $tooltip = 	__("Pick a custom buddha bar background color e.g. #a314a3",'dt_themes'); ?>
                          <h6><?php echo $label;?></h6>	
                          <?php dttheme_admin_color_picker("",$name,$value,'');?>
                          <p class="note"><?php echo $tooltip;?></p>   
                          <h6><?php _e('Show BG Color','dt_themes');?></h6>                     
                          <div class="bpanel-option-set"><?php dttheme_switch("",'bbar','disable-bg-color');?></div>
                    </div>
                    
                    <div class="column one-half last">
                        <?php $label = 		__("Shadow Color",'dt_themes');
                          $name  =		"mytheme[bbar][bar-shadow-color]";	
                          $value =  	 (dttheme_option('bbar','bar-shadow-color')!= NULL) ? dttheme_option('bbar','bar-shadow-color') : "#";
                          $tooltip = 	__("Pick a custom buddha bar shadow color e.g. #a314a3",'dt_themes'); ?>
						  <h6><?php echo $label;?></h6>	
                          <?php dttheme_admin_color_picker("",$name,$value,'');?>
                          <p class="note"><?php echo $tooltip;?></p>   
                          <h6><?php _e('Show Shadow Color','dt_themes');?></h6>   
                          <div class="bpanel-option-set"><?php dttheme_switch("",'bbar','disable-shadow-color');?></div>
                    </div>
                          
                </div>
            </div><!-- Settings End-->
            
        
        	<!-- Message Text Settings -->
        	<div class="bpanel-box">
            	<div class="box-title"><h3><?php _e('Message Settings','dt_themes');?></h3></div>
                <div class="box-content">
                     
                     <div class="bpanel-option-set">
                         <h6><?php _e('Message','dt_themes');?></h6>
                         <textarea id="mytheme-bbar-tmsg" name="mytheme[bbar][message]" rows="" cols=""><?php echo stripslashes(dttheme_option('bbar','message'));?></textarea>
                         <p class="note"><?php _e("You can add your custom buddha bar message.",'dt_themes');?></p>
                     </div>
                     
                    <div class="hr"> </div>
                      
                    <div class="column one-column"> 
                        <div class="bpanel-option-set">
							<?php dttheme_admin_fonts(__('Message Font','dt_themes'),'mytheme[bbar][message-font]',dttheme_option('bbar','message-font'));?>
                            <div class="clear"></div>
                            <p class="note"><?php _e("Choose Message Font",'dt_themes');?></p>
                        </div>                        
                    </div>
                    
                    <div class="hr_invisible"> </div>

                    <div class="column one-half">
                        <?php $label = 		__("Message Font Color",'dt_themes');
                          $name  =		"mytheme[bbar][message-font-color]";	
                          $value =  	 (dttheme_option('bbar','message-font-color')!= NULL) ? dttheme_option('bbar','message-font-color') : "#";
                          $tooltip = 	__("Pick a custom font color for the message e.g. #a314a3",'dt_themes'); ?>
                          <h6> <?php echo $label;?> </h6>
                          <?php dttheme_admin_color_picker("",$name,$value,'');?>
                          <p class="note no-margin"><?php echo $tooltip;?></p>     
                    </div>
                    <div class="column one-half last">
						<?php dttheme_admin_jqueryuislider(__('Message Font Size','dt_themes'),"mytheme[bbar][message-font-size]",
                            dttheme_option('bbar',"message-font-size"));?>
                    </div>
                    
                    <div class="hr"> </div>
                    
                    <div class="column one-third">
                    	<h6><?php _e('Disable Font Color','dt_themes');?></h6>   
                        <?php dttheme_switch("",'bbar','disable-message-font-color');?>
                    </div>
                    
                    <div class="column one-third"> 
                        <?php $label = 		__("Link Color",'dt_themes');
                          $name  =		"mytheme[bbar][link-color]";	
                          $value =  	 (dttheme_option('bbar','link-color')!= NULL) ? dttheme_option('bbar','link-color') : "#";
                          $tooltip = 	__("Pick a custom primary color for the links in buddha bar e.g. #564912 ",'dt_themes'); ?>
                          <h6><?php echo $label;?></h6>	
                          <?php dttheme_admin_color_picker('',$name,$value,'');?> 
                          <p class="note"><?php echo $tooltip;?></p>                    
                    </div>

                    <div class="column one-third last">
                        <?php $label = 		__("Link hover Color",'dt_themes');
                          $name  =		"mytheme[bbar][link-hover-color]";	
                          $value =  	 (dttheme_option('bbar','link-hover-color')!= NULL) ? dttheme_option('bbar','link-hover-color') : "#";
                          $tooltip = 	__("Pick a custom hover state color for the links in buddha bar e.g. #564912 ",'dt_themes'); ?>
						  <h6><?php echo $label;?></h6>	
                          <?php dttheme_admin_color_picker('',$name,$value,'');?>                    
                          <p class="note"><?php echo $tooltip;?></p> 
                    </div>
                    

                </div>
            </div><!-- Message Text Settings End -->
        </div><!-- #my-bar -->
    </div><!-- .bpanel-main-content end-->
</div><!-- #Buddha Bar Settings end-->