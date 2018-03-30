<!-- #general -->
<div id="general" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#my-general"><?php _e("General",'iamd_text_domain');?></a></li>
            <li><a href="#my-misc"><?php _e("Misc",'iamd_text_domain');?></a></li>
            <li><a href="#my-sociable"><?php _e("Sociable",'iamd_text_domain');?></a></li>
            <li><a href="#my-membership"><?php _e("Membership",'iamd_text_domain');?></a></li>
        </ul>
        
        <!-- #my-general-->
        <div id="my-general" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                    <!-- Logo -->
                    <div class="box-title"><h3><?php _e('Logo','iamd_text_domain');?></h3></div>
                    <div class="box-content">
                    	<div class="column three-fifth">
                            <div class="bpanel-option-set">
                                <?php $logo = array(
                                        'id'=>		'logo',
                                        'options'=>		array(
                                                            'true'	=> __('Custom Image Logo','iamd_text_domain'),
                                                             ''=> 	__('Display Site Title <small><a href="'.esc_url("options-general.php").'">(click here to edit site title)</a></small>','iamd_text_domain')
                                                            )
                                        );
                                             
                                        $output = "";
                                        $i = 0;
                                        foreach($logo['options'] as $key => $option):
                                            $checked = ( $key ==  dt_theme_option('general',$logo['id']) ) ? ' checked="checked"' : '';
                                            $output .= "<label><input type='radio' name='mytheme[general][$logo[id]]' value='{$key}'  $checked />$option</label>";
                                            if($i == 0):
                                                $output .='<div class="clear"></div>';
                                            endif;
                                        $i++;
                                        endforeach;
                                        echo $output;?>
                          </div><!-- .bpanel-option-set end-->
                        </div>
                        
                        <div class="column two-fifth last">
                            <p class="note"><?php _e('You can choose whether you wish to display a custom logo or your site title.','iamd_text_domain');?></p>
                        </div>  
                        <div class="hr"> </div>
                        <div class="clear"></div>
                        
                        <h6><?php _e('Logo','iamd_text_domain');?></h6>
                        <div class="image-preview-container">
                            <input id="mytheme-logo" name="mytheme[general][logo-url]" type="text" class="uploadfield" readonly="readonly"
                                    value="<?php echo  dt_theme_option('general','logo-url');?>" />
                            <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                            <?php dt_theme_adminpanel_image_preview(dt_theme_option('general','logo-url'),false,'logo.png');?>
                        </div>

                        <p class="note"> <?php _e('Upload a logo for your theme, or specify the image address of your online logo.','iamd_text_domain');?> </p>

                        <div class="hr"></div>
                        <div class="clear"></div>
                        <h6><?php _e('Retina Logo','iamd_text_domain');?></h6>
                        <div class="image-preview-container">
                          <input id="mytheme-retina-logo" type="text" name="mytheme[general][retina-logo-url]" class="uploadfield" readonly="readonly" 
                            value="<?php echo dt_theme_option('general','retina-logo-url');?>"/>
                          <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button show_preview" />
                          <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                          <?php dt_theme_adminpanel_image_preview(dt_theme_option('general','retina-logo-url'),false,'logo@2x.png');?>
                        </div>

                        <p class="note"><?php _e('Upload a retina logo for your theme, or specify the image address of your online logo.','iamd_text_domain');?></p>
                        <div class="clear"></div>

                        <div class="one-half-content">
                        	<h6><?php _e('Width','iamd_text_domain');?></h6>
                            <input type="text" class="medium" name="mytheme[general][retina-logo-width]" value="<?php echo dt_theme_option('general','retina-logo-width');?>" />
							<?php _e('px','iamd_text_domain');?>
                        </div>    

                        <div class="one-half-content last">
                        	<h6><?php _e('Height','iamd_text_domain');?></h6>
                            <input type="text" class="medium" name="mytheme[general][retina-logo-height]" value="<?php echo dt_theme_option('general','retina-logo-height');?>"/>
                            <?php _e('px','iamd_text_domain');?>
                        </div>    
                        <p class="note"><?php _e('If retina logo is uploaded, enter the standard logo width and height in above respective boxes.','iamd_text_domain');?></p>
						<div class="clear"></div>
                        
                    </div> <!-- Logo End -->

                    <!-- Favicon -->
                    <div class="box-title">
                        <h3><?php _e('Favicon','iamd_text_domain');?></h3>
                    </div>
                    <div class="box-content">
                    	<h6> <?php _e('Enable Favicon','iamd_text_domain');?> </h6> 
                        
                        <div class="column one-fifth">                        
							<?php $checked = ( "true" ==  dt_theme_option('general','enable-favicon') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  dt_theme_option('general','enable-favicon') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="enable-favicon" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="enable-favicon" name="mytheme[general][enable-favicon]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
						<div class="column four-fifth last"></div>

                        <div class="hr"></div>
                        <div class="clear"></div>
						<h6><?php _e('Custom Favicon','iamd_text_domain');?></h6>
                        <div class="image-preview-container">
                            <input id="mytheme-favicon" name="mytheme[general][favicon-url]" type="text" class="uploadfield" 
                                value="<?php echo  dt_theme_option('general','favicon-url');?>" />
                            <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button" />
                            <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                            <?php dt_theme_adminpanel_image_preview(dt_theme_option('general','favicon-url'),false,'favicon.png');?>
                        </div>
                        <p class="note"> <?php _e('Upload a favicon for your theme, or specify the oneline URL for favicon','iamd_text_domain');?>  </p>
                          
                        <div class="hr"></div>
                        <div class="clear"></div>
                        <h6><?php _e('Apple iPhone Icon','iamd_text_domain');?></h6>
                        <div class="image-preview-container">
                          <input id="mytheme-apple-icon" name="mytheme[general][apple-favicon]" type="text" class="uploadfield"
                            value="<?php echo dt_theme_option('general','apple-favicon');?>"/>
                            <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button" />
                            <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                            <?php dt_theme_adminpanel_image_preview(dt_theme_option('general','apple-favicon'),false,'apple-touch-icon.png');?>
                        </div>
                        <p class="note"> <?php _e('Upload your custom iPhone icon (57px by 57px), or specify the oneline URL for favicon','iamd_text_domain');?>  </p>

                        <div class="hr"></div>
                        <div class="clear"></div>
                        <h6><?php _e('Apple iPhone Retina Icon','iamd_text_domain');?></h6>
                        <div class="image-preview-container">
                          <input id="mytheme-apple-icon" name="mytheme[general][apple-retina-favicon]" type="text" class="uploadfield"
                            value="<?php echo dt_theme_option('general','apple-retina-favicon');?>"/>
                            <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button" />
                            <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                            <?php dt_theme_adminpanel_image_preview(dt_theme_option('general','apple-retina-favicon'),false,'apple-touch-icon-114x114.png');?>
                        </div>
                        <p class="note"><?php _e('Upload your custom iPhone retina icon (114px by 114px), or specify the oneline URL for favicon','iamd_text_domain');?></p>

                        <div class="hr"></div>
                        <div class="clear"></div>
                        <h6><?php _e('Apple iPad Icon','iamd_text_domain');?></h6>
                        <div class="image-preview-container">
                          <input id="mytheme-apple-icon" name="mytheme[general][apple-ipad-favicon]" type="text" class="uploadfield"
                            value="<?php echo dt_theme_option('general','apple-ipad-favicon');?>"/>
                            <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button" />
                            <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                            <?php dt_theme_adminpanel_image_preview(dt_theme_option('general','apple-ipad-favicon'),false,'apple-touch-icon-72x72.png');?>
                        </div>
                        <p class="note"> <?php _e('Upload your custom iPad icon (72px by 72px), or specify the oneline URL for favicon','iamd_text_domain');?>  </p>

                        <div class="hr"></div>
                        <div class="clear"></div>
                        <h6><?php _e('Apple iPad Retina Icon','iamd_text_domain');?></h6>
                        <div class="image-preview-container">
                          <input id="mytheme-apple-icon" name="mytheme[general][apple-ipad-retina-favicon]" type="text" class="uploadfield"
                            value="<?php echo dt_theme_option('general','apple-ipad-retina-favicon');?>"/>
                            <input type="button" value="<?php _e('Upload','iamd_text_domain');?>" class="upload_image_button" />
                            <input type="button" value="<?php _e('Remove','iamd_text_domain');?>" class="upload_image_reset" />
                            <?php dt_theme_adminpanel_image_preview(dt_theme_option('general','apple-ipad-retina-favicon'),false,'apple-touch-icon-144x144.png');?>
                        </div>
                        <p class="note"><?php _e('Upload your custom iPad retina icon (144px by 144px), or specify the oneline URL for favicon','iamd_text_domain');?></p>
                    </div> <!-- Favicon End -->

                    <!-- Others -->
                    <div class="box-title"><h3><?php _e('Others', 'iamd_text_domain');?></h3></div>
                    <div class="box-content">
                    
                      <h6> <?php _e('Enable Sticky Navigation', 'iamd_text_domain'); ?></h6>
                    
                      <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  dt_theme_option('general','enable-sticky-nav') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  dt_theme_option('general','enable-sticky-nav') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-enable-sticky-nav" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="mytheme-enable-sticky-nav" name="mytheme[general][enable-sticky-nav]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
                        
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e('YES! to enable sticky navigation.','iamd_text_domain');?> </p>
                        </div>
                        <div class="clear"> </div>
                        <div class="hr"></div>
                    
                   	  <h6> <?php _e('Globally Disable Comments on Pages','iamd_text_domain');?> </h6>
                    
                      <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  dt_theme_option('general','disable-page-comment') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  dt_theme_option('general','disable-page-comment') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-page-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="mytheme-global-page-comment" name="mytheme[general][disable-page-comment]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
                        
                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php _e('YES! to disable comments on all the pages. This will globally override your "Allow comments" option under your page "Discussion" settings. ','iamd_text_domain');?> </p>
                        </div>
                        <div class="hr"></div>
                        
                      <h6><?php _e('Globally Disable Comments on Posts','iamd_text_domain');?></h6>
                      <div class="column one-fifth">
                   	<?php $checked = ( "true" ==  dt_theme_option('general','global-post-comment') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  dt_theme_option('general','global-post-comment') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-post-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="mytheme-global-post-comment" name="mytheme[general][global-post-comment]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
                        
                        <div class="column four-fifth last">
                        	<p class="note no-margin"><?php _e('YES! to disable comments on all the posts. This will globally override your "Allow comments" option under your post "Discussion" settings. ','iamd_text_domain');?> </p>
                        </div>
                        <div class="hr"></div>
                        
                      <h6><?php _e('Globally Disable Comments on Galleries','iamd_text_domain');?></h6>
                      <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  dt_theme_option('general','disable-gallery-comment') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  dt_theme_option('general','disable-gallery-comment') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-gallery-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="mytheme-global-gallery-comment" name="mytheme[general][disable-gallery-comment]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php _e('Enable/ Disable comments on gallery pages.','iamd_text_domain');?> </p>
                        </div>
                        <div class="hr"></div>

                      <h6><?php _e('Globally Disable Comments on Workouts','iamd_text_domain');?></h6>
                      <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  dt_theme_option('general','disable-workout-comment') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  dt_theme_option('general','disable-workout-comment') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-workout-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="mytheme-global-workout-comment" name="mytheme[general][disable-workout-comment]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php _e('Enable/ Disable comments on workout pages.','iamd_text_domain');?> </p>
                        </div>
                        <div class="hr"></div>

                      <h6><?php _e('Enable Placeholder Images','iamd_text_domain');?></h6>
                      <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  dt_theme_option('general','enable-placeholder-images') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  dt_theme_option('general','enable-placeholder-images') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-placeholder-images" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="mytheme-global-placeholder-images" name="mytheme[general][enable-placeholder-images]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php _e('Enable placeholder images for blog posts.','iamd_text_domain');?> </p>
                        </div>
                        <div class="hr"></div>

                        <h6><?php _e('Globally Disable Breadcrumbs','iamd_text_domain');?></h6>
                        <div class="column one-fifth">
                            <?php $switchclass = ( "on" ==  dt_theme_option('general','disable-breadcrumb') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-breadcrumb-disable" class="checkbox-switch <?php echo $switchclass;?>"></div>
							<input class="hidden" id="mytheme-global-breadcrumb-disable" name="mytheme[general][disable-breadcrumb]" type="checkbox" 
							<?php checked(dt_theme_option('general','disable-breadcrumb'),'on');?>/>                            
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php _e('show / Hide Breacrumbs globally on sitewide','iamd_text_domain');?> </p>
                        </div>
                        
                        <div class="hr-invisible-small"> </div>
                        
                        <label><?php _e('Breadcrumb Delimiter','iamd_text_domain');?></label>
                           <select id="mytheme-breadcrumb-delimiter" name="mytheme[general][breadcrumb-delimiter]">
                            <?php $breadcrumb_icons = array('default','fa-sort','fa-angle-right','fa-caret-right','fa-arrow-right','fa-chevron-right','fa-plus','fa-angle-double-right','fa-hand-o-right','fa-arrow-circle-right');
								foreach($breadcrumb_icons as $breadcrumb_icon):
										$s = selected(dt_theme_option('general','breadcrumb-delimiter'),$breadcrumb_icon,false);
									echo "<option $s >$breadcrumb_icon</option>";
								endforeach;?>
                            </select>
                         <p class="note"><?php _e('This is the symbol that will appear in between your breadcrumbs','iamd_text_domain');?></p>   
                         <div class="hr"></div>
                         
                        <h6><?php _e('Disable Style Picker','iamd_text_domain');?></h6>
                        <div class="column one-fifth">
                        	<?php $switchclass = ( "on" ==  dt_theme_option('general','disable-style-picker') ) ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                            <div data-for="mytheme-style-picker" class="checkbox-switch <?php echo $switchclass;?>"></div>
							<input class="hidden" id="mytheme-style-picker" name="mytheme[general][disable-style-picker]" type="checkbox" 
							<?php checked(dt_theme_option('general','disable-style-picker'),'on');?>/>
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php _e('Check if you do not want disable the style picker.','iamd_text_domain');?> </p>
                        </div>
                        <div class="hr"></div>
                        
                        <h6><?php _e('Google Font Subset','iamd_text_domain');?></h6>
                        <div class="column one-half">
                         <input id="mytheme-google-font-subset" name="mytheme[general][google-font-subset]" type="text" value="<?php echo dt_theme_option('general','google-font-subset');?>"/>
                        </div>

                        <div class="column one-half last">
                            <p class="note no-margin"><?php _e('Specify which subsets should be downloaded. Multiple subsets should be separated with comma.','iamd_text_domain'); ?></p>
                        </div>
                        
                        <div class="clear"> </div>
                        <div class="hr-invisible-small"> </div>
                        
                       	<p class="note"><?php _e('Some of the fonts in the Google Font Directory supports multiple scripts (like Latin and Cyrillic for example). In order to specify which subsets should be downloaded the subset parameter should be appended to the URL. For a complete list of available fonts and font subsets please see','iamd_text_domain'); 
							echo " <a href='http://www.google.com/webfonts'>Google Web Fonts</a>";?> </p>

                        <div class="hr"></div>
                        <div class="clear"> </div>
                        
                        <h6><?php _e('Mailchimp API KEY','iamd_text_domain');?></h6>
                        <div class="column one-half">
                            <input id="mytheme-mailchimp-key" name="mytheme[general][mailchimp-key]" type="text" value="<?php echo dt_theme_option('general','mailchimp-key'); ?>" />
                        </div>
                        
                        <div class="column one-half last">
                            <p class="note no-margin"><?php _e('Paste your mailchimp api key that will be used by the mailchimp widget.','iamd_text_domain'); ?></p>
                        </div>
                        
                    </div>                                            
                    
            </div><!-- .bpanel-box end-->
        </div><!--#my-general end-->
        
        <!-- #my-sociable-->
        <div id="my-misc" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
				<div class="box-title"><h3><?php _e('Top Bar','iamd_text_domain');?></h3></div>
                <div class="box-content">
                    <h6><?php _e('Disable Top Bar','iamd_text_domain');?></h6>
                    <div class="column one-fifth">
                    <?php $checked = ( "true" ==  dt_theme_option('general','header-top-bar') ) ? ' checked="checked"' : ''; ?>
                       <?php $switchclass = ( "true" ==  dt_theme_option('general','header-top-bar') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                       <div data-for="mytheme-header-top-bar" class="checkbox-switch <?php echo $switchclass;?>"></div>
                       <input class="hidden" id="mytheme-header-top-bar" name="mytheme[general][header-top-bar]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                
                    <div class="column four-fifth last">
                       <p class="note"><?php _e('YES! to disable header top bar. ','iamd_text_domain');?> </p>
                    </div>
                    <div class="hr"></div>
                 
                    <h6><?php _e('Top Left Content','iamd_text_domain');?></h6>
                    <div class="column one-half">
                        <textarea id="mytheme-top-bar-left-content" style="height:80px;" name="mytheme[general][top-bar-left-content]"><?php echo stripslashes(dt_theme_option('general','top-bar-left-content'));?></textarea>
                    </div>
                    <div class="column one-half last">
                        <p class="note"><?php _e('Specify top bar left content in above fields.','iamd_text_domain');?> </p>
                    </div>
                </div>
			</div><!-- .bpanel-box end-->
            <!-- .bpanel-box -->
            <div class="bpanel-box">
				<div class="box-title"><h3><?php _e('Loading Animation','iamd_text_domain');?></h3></div>
                <div class="box-content">
                    <h6><?php _e('Disable Loader','iamd_text_domain');?></h6>
                    <div class="column one-fifth">
                    <?php $checked = ( "true" ==  dt_theme_option('general','loading-bar') ) ? ' checked="checked"' : ''; ?>
                       <?php $switchclass = ( "true" ==  dt_theme_option('general','loading-bar') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                       <div data-for="mytheme-loading-bar" class="checkbox-switch <?php echo $switchclass;?>"></div>
                       <input class="hidden" id="mytheme-loading-bar" name="mytheme[general][loading-bar]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                
                    <div class="column four-fifth last">
                       <p class="note"><?php _e('YES! to disable animated site loader. ','iamd_text_domain');?> </p>
                    </div>
                </div>
			</div><!-- .bpanel-box end-->
            <!-- .bpanel-box -->
            <div class="bpanel-box">
				<div class="box-title"><h3><?php _e('Contact Form Question','iamd_text_domain');?></h3></div>
                <div class="box-content">
                    <h6><?php _e('Disable Question','iamd_text_domain');?></h6>

                    <div class="column one-fifth">
                        <?php dt_theme_switch("",'general',"disable-cform-question");?>
                    </div>
                    <div class="column four-fifth last">
                        <p class="note"><?php _e( "Disable contact form question option.",'iamd_text_domain'); ?></p>
                    </div>

                    <div class="clear"></div>
                    <!-- Add / Remove Option -->
                    <div class="cform-question">
                        <a href='' class='add-item'><?php _e('Add Option','iamd_text_domain');?></a>
                        <?php $options = dt_theme_option("general","options-for-question");
                              $options = is_array($options) ? array_filter($options) : array();
                              $options = array_unique( $options);
                            foreach( $options as $option ){ ?>
                            <div class="general-cform-container">
                                <input type="text" name="<?php echo "mytheme[general][options-for-question][]";?>" value="<?php echo $option;?>">
                                <a href='' class='remove-item'><?php _e('Remove','iamd_text_domain');?></a>
                            </div>
                        <?php } ?>
                        <div class="clone hidden">
                            <div class="general-cform-container">
                                <input type="text" name="<?php echo "mytheme[general][options-for-question][]";?>" value="">
                                <a href='' class='remove-item'><?php _e('Remove','iamd_text_domain');?></a>
                            </div>
                        </div>
                    </div><!-- Add / Remove Option -->
                </div>
			</div><!-- .bpanel-box end-->
            <!-- .bpanel-box -->
            <div class="bpanel-box">
				<div class="box-title"><h3><?php _e('Bottom Bar','iamd_text_domain');?></h3></div>
                <div class="box-content">
                    <h6><?php _e('Disable Bottom Bar','iamd_text_domain');?></h6>
                    <div class="column one-fifth">
                    <?php $checked = ( "true" ==  dt_theme_option('general','footer-bottom-bar') ) ? ' checked="checked"' : ''; ?>
                       <?php $switchclass = ( "true" ==  dt_theme_option('general','footer-bottom-bar') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                       <div data-for="mytheme-footer-bottom-bar" class="checkbox-switch <?php echo $switchclass;?>"></div>
                       <input class="hidden" id="mytheme-footer-bottom-bar" name="mytheme[general][footer-bottom-bar]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>

                    <div class="column four-fifth last">
                       <p class="note"><?php _e('YES! to disable footer bottom bar.','iamd_text_domain');?> </p>
                    </div>
                    <div class="hr"></div>

                    <h6><?php _e('Bottom Phone No','iamd_text_domain');?></h6>
                    <div class="column one-half">
                    	<input type="text" id="mytheme-bottom-phoneno-content" name="mytheme[general][bottom-phoneno-content]" value="<?php echo dt_theme_option('general','bottom-phoneno-content');?>" />
                    </div>
                    <div class="column one-half last">
                        <p class="note"><?php _e('Specify bottom phone no in below footer widgets.','iamd_text_domain');?> </p>
                    </div>
                </div>
			</div><!-- .bpanel-box end-->
		</div>

        <!-- #my-sociable-->
        <div id="my-sociable" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">

                <div class="box-title">
                	<h3><?php _e('Sociable','iamd_text_domain');?></h3>
                </div><!-- .box-title -->

                <div class="box-content">
                    <div class="bpanel-option-set">
                         <h6><?php _e('Show Sociable','iamd_text_domain');?></h6>

                         <div class="column one-fifth">
							 <?php $switchclass = ( "on" ==  dt_theme_option('general','show-sociables') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                             <div data-for="mytheme-show-sociables" class="checkbox-switch <?php echo $switchclass;?>"></div>
                             <input class="hidden" id="mytheme-show-sociables" name="mytheme[general][show-sociables]" type="checkbox" 
                             <?php checked(dt_theme_option('general','show-sociables'),'on');?>/>
                         </div>

                         <input type="button" value="<?php _e('Add New Sociable','iamd_text_domain');?>" class="black mytheme_add_item" />

                         <div class="column four-fifth last">
                             <p class="note"> <?php _e('Manage Social Network icons list to display','iamd_text_domain');?> </p>
                         </div>

                         <div class="hr_invisible"></div>
                    </div>
                    
                    <div class="bpanel-option-set">
                        <ul class="menu-to-edit">
                        <?php $socials = dt_theme_option('social');
						      if(is_array($socials)):
							  	$keys = array_keys($socials);
								$i=0;
						 	  foreach($socials as $s):?>
                              <li id="<?php echo $keys[$i];?>">
                                <div class="item-bar">
                                    <span class="item-title"><?php $n = $s['icon']; $n = substr($n, 3); $n = ucwords($n); echo $n;?></span>
                                    <span class="item-control"><a class="item-edit"><?php _e('Edit','iamd_text_domain');?></a></span>
                                </div>
                                <div class="item-content" style="display: none;">
                                	<span><label><?php _e('Sociable Icon','iamd_text_domain');?></label>
										<?php echo dt_theme_sociables_selection($keys[$i],$s['icon']);?></span>
                                    <span><label><?php _e('Sociable Link','iamd_text_domain');?></label>
                                    	<input type="text" class="social-link" name="mytheme[social][<?php echo $keys[$i];?>][link]" value="<?php echo $s['link']?>"/>
                                    </span>
                                    
                                    <div class="remove-cancel-links">
                                        <span class="remove-item"><?php _e('Remove','iamd_text_domain');?></span>
                                        <span class="meta-sep"> | </span>
                                        <span class="cancel-item"><?php _e('Cancel','iamd_text_domain');?></span>
                                    </div>
                                </div>
                              </li>
                        <?php $i++;endforeach; endif;?> 
                        </ul>
                        
                        <ul class="sample-to-edit" style="display:none;">
                        	<!-- Social Item -->
                            <li>
                            	<!-- .item-bar -->
                            	<div class="item-bar">
                                	<span class="item-title"><?php _e('Sociable','iamd_text_domain');?></span>
                                    <span class="item-control"><a class="item-edit"><?php _e('Edit','iamd_text_domain');?></a></span>
                                </div><!-- .item-bar -->
                                <!-- .item-content -->
                                <div class="item-content">                                
                                	<span><label><?php _e('Sociable Icon','iamd_text_domain');?></label><?php echo dt_theme_sociables_selection();?></span>
                                    <span><label><?php _e('Sociable Link','iamd_text_domain');?></label><input type="text" class="social-link" /></span>
                                    <div class="remove-cancel-links">
                                        <span class="remove-item"><?php _e('Remove','iamd_text_domain');?></span>
                                        <span class="meta-sep"> | </span>
                                        <span class="cancel-item"><?php _e('Cancel','iamd_text_domain');?></span>
                                    </div>
                                </div><!-- .item-content end -->
                            </li><!-- Social Item End-->
                        </ul>
                        
                    </div>
                </div> <!-- .box-content -->
                
            </div><!-- .bpanel-box end -->
            
        </div><!--#my-sociable end-->
        
        <!-- #my-membership-->
        <div id="my-membership" class="tab-content">
        
	        <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e('Membership','iamd_text_domain');?></h3>
                </div>
                <div class="box-content">

                    <div class="column one-third"><label><?php _e('Currency Symbol','iamd_text_domain');?></label></div>
                    <div class="column two-third last">
                        <input name="mytheme[general][currency-symbol]" type="text" class="small" value="<?php echo trim(stripslashes(dt_theme_option('general','currency-symbol')));?>" />
                        <p class="note"><?php _e('Please set default currency symbol which will be used in front end display','iamd_text_domain');?></p>
                    </div>
                    
					<div class="hr_invisible"> </div>
 
                    <div class="column one-third"><label><?php _e('Currency','iamd_text_domain');?></label></div>
                    <div class="column two-third last">
                        <?php
						$currency_options = array('ADF', 'ADP', 'AED', 'AFA', 'AFN', 'ALL', 'AMD', 'ANG', 'AOA', 'AON', 'ARS', 'ATS', 'AUD', 'AWG', 'AZN', 'BAM', 'BBD', 'BDT', 'BEF', 'BGN', 'BHD', 'BIF', 'BMD', 'BND', 'BOB', 'BRL', 'BSD', 'BTN', 'BWP', 'BYR', 'BZD', 'CAD', 'CDF', 'CFP', 'CHF', 'CLP', 'CNY', 'COP', 'CRC', 'CSK', 'CUC', 'CUP', 'CVE', 'CYP', 'CZK', 'DEM', 'DJF', 'DKK', 'DOP', 'DZD', 'ECS', 'EEK', 'EGP', 'ESP', 'ETB', 'EUR', 'FIM', 'FJD', 'FKP', 'FRF', 'GBP', 'GEL', 'GHC', 'GHS', 'GIP', 'GMD', 'GNF', 'GRD', 'GTQ', 'GYD', 'HKD', 'HNL', 'HRK', 'HTG', 'HUF', 'IDR', 'IEP', 'ILS', 'INR', 'IQD', 'IRR', 'ISK', 'ITL', 'JMD', 'JOD', 'JPY', 'KES', 'KGS', 'KHR', 'KMF', 'KPW', 'KRW', 'KWD', 'KYD', 'KZT', 'LAK', 'LBP', 'LKR', 'LRD', 'LSL', 'LTL', 'LUF', 'LVL', 'LYD', 'MAD', 'MDL', 'MGF', 'MKD', 'MMK', 'MNT', 'MOP', 'MRO', 'MTL', 'MUR', 'MVR', 'MWK', 'MXN', 'MYR', 'MZM', 'MZN', 'NAD', 'NGN', 'NIO', 'NLG', 'NOK', 'NPR', 'NZD', 'OMR', 'PAB', 'PEN', 'PGK', 'PHP', 'PKR', 'PLN', 'PTE', 'PYG', 'QAR', 'ROL', 'RON', 'RSD', 'RUB', 'SAR', 'SBD', 'SCR', 'SDD', 'SDG', 'SDP', 'SEK', 'SGD', 'SHP', 'SIT', 'SKK', 'SLL', 'SOS', 'SRD', 'SRG', 'STD', 'SVC', 'SYP', 'SZL', 'THB', 'TMM', 'TND', 'TOP', 'TRL', 'TRY', 'TTD', 'TWD', 'TZS', 'UAH', 'UGS', 'USD', 'UYU', 'UZS', 'VEF', 'VND', 'VUV', 'WST', 'XAF', 'XCD', 'XOF', 'XPF', 'YER', 'YUN', 'ZAR', 'ZMK', 'ZWD');
						$currency_membership = dt_theme_option('general','currency-membership') != '' ? dt_theme_option('general','currency-membership') : 'USD';
						?>
                        <select id="mytheme-currency-membership" name="mytheme[general][currency-membership]"><?php 
							foreach ($currency_options as $value):
								$selected = ( $value == $currency_membership ) ? ' selected="selected" ' : '';
								echo "<option $selected value='$value'>$value</option>";
							endforeach; ?>
                        </select>                         
                        <p class="note"><?php _e('Please select your curreny symbol which will be used in s2member for payment.','iamd_text_domain');?></p>
                    </div>
                    
                </div>
            </div>

        </div><!--#my-membership end-->

    </div><!-- .bpanel-main-content end-->
</div><!-- #general end-->