<!-- #layout -->
<div id="layout" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('General', 'veda');?></a></li>
            <li><a href="#tab2"><?php esc_html_e('Header', 'veda');?></a></li>
			<li><a href="#tab3"><?php esc_html_e('Menu', 'veda');?></a></li>
            <li><a href="#tab4"><?php esc_html_e('Sociable', 'veda');?></a></li>
            <li><a href="#tab5"><?php esc_html_e('Footer', 'veda');?></a></li>
            <li><a href="#tab6"><?php esc_html_e('Custom Css &amp; Js', 'veda');?></a></li>
        </ul>

        <!-- #tab1-general -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Logo', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column three-fifth">
                        <div class="bpanel-option-set"><?php
							$logo = array( 'id'=> 'logo',
			                               'options'=> array( 'true'	=> esc_html__('Custom Image Logo', 'veda'),
										   					  ''=> 	esc_html__('Display Site Title', 'veda').' <small><a href="'.esc_url("options-general.php").'">(click here to edit site title)</a></small>'));
							$output = "";
							$i = 0;
							foreach($logo['options'] as $key => $option):
								$checked = ( $key ==  veda_option('layout',$logo['id']) ) ? ' checked="checked"' : '';
								$output .= "<label><input type='radio' name='dttheme[layout][$logo[id]]' value='{$key}' $checked />$option</label>";
								if($i == 0):
									$output .='<div class="clear"></div>';
								endif;
							$i++;
							endforeach;
							echo $output; ?>
                        </div>
                    </div>
                    <div class="column two-fifth last">
                        <p class="note"><?php esc_html_e('You can choose whether you wish to display a custom logo or your site title.', 'veda');?></p>
                    </div>
                    <div class="hr"> </div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Logo', 'veda');?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-logo" name="dttheme[layout][logo-url]" type="text" class="uploadfield" readonly="readonly" value="<?php echo veda_option('layout','logo-url');?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button show_preview" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('layout','logo-url'),false,'logo.png');?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload a logo for your theme, or specify the image url of your on-line logo.', 'veda');?></p>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Retina Logo', 'veda');?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-retina-logo" name="dttheme[layout][retina-logo-url]" type="text" class="uploadfield" readonly="readonly" value="<?php echo veda_option('layout','retina-logo-url');?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button show_preview" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('layout','retina-logo-url'),false,'logo@2x.png');?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload a retina logo for your theme, or specify the image url of your on-line logo.', 'veda');?></p>
                    <div class="clear"></div>

                    <div class="one-half-content">
                        <h6><?php esc_html_e('Width', 'veda');?></h6>
                        <input type="text" class="medium" name="dttheme[layout][retina-logo-width]" value="<?php echo veda_option('layout','retina-logo-width');?>" />
                        <?php esc_html_e('px', 'veda');?>
                    </div>
  
                    <div class="one-half-content last">
                        <h6><?php esc_html_e('Height', 'veda');?></h6>
                        <input type="text" class="medium" name="dttheme[layout][retina-logo-height]" value="<?php echo veda_option('layout','retina-logo-height');?>"/>
                        <?php esc_html_e('px', 'veda');?>
                    </div>
                    <p class="note"><?php esc_html_e('If retina logo is uploaded, enter the standard logo width and height in above respective boxes.', 'veda');?></p>
                    <div class="clear"></div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
            
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Favicon', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <h6><?php esc_html_e('Custom Favicon', 'veda');?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-favicon" name="dttheme[layout][favicon-url]" type="text" class="uploadfield" value="<?php echo  veda_option('layout','favicon-url');?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('layout','favicon-url'),false,'favicon.png');?>
                    </div>
                    <p class="note"> <?php esc_html_e('Upload a favicon for your theme, or specify the oneline URL for favicon', 'veda');?>  </p>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Apple iPhone Icon', 'veda');?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-apple-icon" name="dttheme[layout][apple-favicon]" type="text" class="uploadfield" value="<?php echo veda_option('layout','apple-favicon');?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('layout','apple-favicon'),false,'apple-touch-icon.png');?>
                    </div>
                    <p class="note"> <?php esc_html_e('Upload your custom iPhone icon (57px by 57px), or specify the oneline URL for favicon', 'veda');?>  </p>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Apple iPhone Retina Icon', 'veda');?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-apple-icon" name="dttheme[layout][apple-retina-favicon]" type="text" class="uploadfield" value="<?php echo veda_option('layout','apple-retina-favicon');?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('layout','apple-retina-favicon'),false,'apple-touch-icon-114x114.png');?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload your custom iPhone retina icon (114px by 114px), or specify the oneline URL for favicon', 'veda');?></p>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Apple iPad Icon', 'veda');?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-apple-icon" name="dttheme[layout][apple-ipad-favicon]" type="text" class="uploadfield" value="<?php echo veda_option('layout','apple-ipad-favicon');?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('layout','apple-ipad-favicon'),false,'apple-touch-icon-72x72.png');?>
                    </div>
                    <p class="note"> <?php esc_html_e('Upload your custom iPad icon (72px by 72px), or specify the oneline URL for favicon', 'veda');?></p>
                    <div class="hr"></div>
                    <div class="clear"></div>
                    
                    <h6><?php esc_html_e('Apple iPad Retina Icon', 'veda');?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-apple-icon" name="dttheme[layout][apple-ipad-retina-favicon]" type="text" class="uploadfield" value="<?php echo veda_option('layout','apple-ipad-retina-favicon');?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('layout','apple-ipad-retina-favicon'),false,'apple-touch-icon-144x144.png');?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload your custom iPad retina icon (144px by 144px), or specify the oneline URL for favicon', 'veda');?></p>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Others', 'veda');?></h3>
                </div>

                <div class="box-content">
                	<div class="one-half column">
                        <h6><?php esc_html_e('Show Breadcrumb', 'veda');?></h6>
                        <div class="column one-fifth">
                             <?php $checked = ( "true" ==  veda_option('layout','show-breadcrumb') ) ? ' checked="checked"' : ''; ?>
                             <?php $switchclass = ( "true" ==  veda_option('layout','show-breadcrumb') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                             <div data-for="dttheme-layout-breadcrumb" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                             <input class="hidden" id="dttheme-layout-breadcrumb" name="dttheme[layout][show-breadcrumb]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                            <p class="note"><?php esc_html_e('Yes! to show breadcrumbs for all pages here', 'veda');?></p>
                        </div>
                    </div>
                    <div class="one-half column last">
                        <h6><?php esc_html_e('Breadcrumb Delimiter', 'veda');?></h6>
                        <select id="dttheme-breadcrumb-delimiter" name="dttheme[layout][breadcrumb-delimiter]" class="dt-chosen-select"><?php
                          $bIcons = array('fa default' => esc_html__('Default', 'veda'), 'fa fa-angle-double-right' => esc_html__('Double Right', 'veda'),
                                 'fa fa-sort' => esc_html__('Sort', 'veda'), 'fa fa-arrow-circle-right' => esc_html__('Arrow Circle Right', 'veda'), 'fa fa-angle-right' => esc_html__('Angle Right', 'veda'),
                                 'fa fa-caret-right' => esc_html__('Caret Right', 'veda'), 'fa fa-angle-double-right' => esc_html__('Double Angle Right', 'veda'),
                                 'fa fa-arrow-right' => esc_html__('Arrow Right', 'veda'), 'fa fa-chevron-right' => esc_html__('Chevron Right', 'veda'),
                                 'fa fa-hand-o-right' => esc_html__('Hand Right', 'veda'), 'fa fa-plus' => esc_html__('Plus', 'veda'), 'fa fa-remove' => esc_html__('Remove', 'veda'),
								 'fa fa-glass' => esc_html__('Glass', 'veda') );
                          foreach($bIcons as $key => $bIcon):
                              $s = selected(veda_option('layout','breadcrumb-delimiter'),$key,false);
                              echo "<option value='{$key}' $s >$bIcon</option>";
                          endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select the symbol that will appear in between your breadcrumbs', 'veda');?></p>
                    </div>
                    <div class="one-half column">
                        <h6><?php esc_html_e('Breadcrumb Dark BG', 'veda');?></h6>
                        <div class="column one-fifth">
                             <?php $checked = ( "true" ==  veda_option('layout','breadcrumb-darkbg') ) ? ' checked="checked"' : ''; ?>
                             <?php $switchclass = ( "true" ==  veda_option('layout','breadcrumb-darkbg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                             <div data-for="dttheme-layout-breadcrumb-darkbg" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                             <input class="hidden" id="dttheme-layout-breadcrumb-darkbg" name="dttheme[layout][breadcrumb-darkbg]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                            <p class="note"><?php esc_html_e('Yes! to show dark background for breadcrumb in all the pages', 'veda');?></p>
                        </div>
                    </div>
                    <div class="one-half column last">
                        <h6><?php esc_html_e('Breadcrumb Style', 'veda');?></h6>
                        <select id="dttheme-breadcrumb-style" name="dttheme[layout][breadcrumb-style]" class="dt-chosen-select"><?php
                            $bstyles = array('default' => esc_html__('Default', 'veda'), 'aligncenter' => esc_html__('Align Center','veda'),
                                'alignright' => esc_html__('Align Right','veda'), 'breadcrumb-left' => esc_html__('Left Side Breadcrumb','veda'),
                                'breadcrumb-right' => esc_html__('Right Side Breadcrumb','veda'), 'breadcrumb-top-right-title-center' => esc_html__('Top Right Title Center', 'veda'),
								'breadcrumb-top-left-title-center' => esc_html__('Top Left Title Center', 'veda'));

                            foreach( $bstyles as $key => $bstyle ):
                              $s = selected(veda_option('layout','breadcrumb-style'),$key,false);
                              echo "<option value='{$key}' $s >$bstyle</option>";
                            endforeach;
                        ?></select>
                        <p class="note"><?php esc_html_e('Select the style that will be added to your breadcrumbs', 'veda');?></p>
					</div>

                    <div class="one-half column">
						<h6><?php esc_html_e( 'Sub Title Background','veda');?></h6>
                        <div class="image-preview-container" style="width:86%;">
                            <?php $breadbg = veda_option('layout','sub-title-bg');?>
                            <input name="dttheme[layout][sub-title-bg]" type="text" class="uploadfield large" readonly="readonly" value="<?php echo esc_attr($breadbg);?>"/>  
                            <div class="hr_invisible"></div>                          
                            <input type="button" value="<?php esc_attr_e('Upload','veda');?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                            <?php if( !empty($breadbg) ) veda_adminpanel_image_preview($breadbg );?>
                            <p class="note"><?php esc_html_e('Upload an image for the sub title background','veda');?></p>
                        </div>
                    </div>
                    <div class="one-half column last">
                        <h6><?php esc_html_e('Opacity','veda');?></h6>
                        <?php $opacity = veda_option('layout','sub-title-opacity');?>
                        <select name="dttheme[layout][sub-title-opacity]" class="dt-chosen-select">
                            <option value=""><?php esc_html_e("Select",'veda');?></option>
                            <?php foreach( array('1','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9') as $option): ?>
                                   <option value="<?php echo esc_attr($option);?>" <?php selected($option,$opacity);?>><?php echo esc_attr($option);?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select background color opacity','veda');?></p>
                        <div class="hr_invisible"></div>
                    </div>
                    <div class="clear"></div>

                    <div class="one-third column">
                        <h6><?php esc_html_e('Background Repeat','veda');?></h6>
                        <?php $bgrepeat = veda_option('layout','sub-title-bg-repeat');?>
                        <select class="medium" name="dttheme[layout][sub-title-bg-repeat]">
                            <option value=""><?php esc_html_e("Select",'veda');?></option>
                            <?php foreach( array('repeat','repeat-x','repeat-y','no-repeat') as $option): ?>
                                   <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgrepeat);?>><?php echo esc_attr($option);?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select how would you like to repeat the background image','veda');?></p>
                    </div>

                    <div class="one-third column">
                        <h6><?php esc_html_e('Background Position','veda');?></h6>
                        <?php $bgposition = veda_option('layout','sub-title-bg-position');?>
                        <select class="medium" name="dttheme[layout][sub-title-bg-position]">
                            <option value=""><?php esc_html_e('Select','veda');?></option>
                            <?php foreach( array('top left','top center','top right','center left','center center','center right','bottom left','bottom center','bottom right') as $option): ?>
                                <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgposition);?>> <?php echo esc_attr($option);?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select how would you like to position the background','veda');?></p>
                    </div>

                    <div class="one-third column last">
                    <?php $label = 		esc_html__('Background Color','veda');
                          $name  =		'dttheme[layout][sub-title-bg-color]';
                          $value =  	veda_option('layout','sub-title-bg-color');
                          $tooltip = 	esc_html__('Select background color for sub title section e.g. #f2d607','veda'); ?>
                          <h6><?php echo esc_html($label);?></h6>
                          <div class="clear"></div>
                          <?php veda_admin_color_picker("",$name,$value,'');?>
                          <p class="note"><?php echo $tooltip;?></p>
                    </div>

                    <div class="hr"></div>
                    <div class="clear"></div>

                	<div class="column one-third">
                    	<label><?php esc_html_e('Mailchimp API Key', 'veda');?></label>
                    </div>
                    <div class="column two-third last">
                    	<input name="dttheme[layout][mailchimp-key]" type="text" class="large" value="<?php echo veda_option('layout','mailchimp-key');?>" />
                    	<p class="note"><?php esc_html_e('Put a valid mailchimp account api key here', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                    <div class="clear"></div>

                	<h6><?php esc_html_e('Layout', 'veda');?></h6>
                	<p class="note no-margin"><?php esc_html_e("Choose the Layout Style(Boxed / Fullwidth)", 'veda');?></p>
                    <div class="hr_invisible"> </div>
					<div class="bpanel-option-set">
                        <ul class="bpanel-layout-set bpanel-post-layout">
                          <?php $layouts = array("boxed","wide");
                                foreach($layouts as $layout):
                                  $class = ( $layout ==  veda_option('layout','site-layout')) ? " class='selected' " : "";?>
                                  <li class="themelayout"><a href="#" rel="<?php echo esc_attr($layout);?>" <?php echo $class;?> title="<?php echo esc_attr($layout);?>">
	                                  <img src="<?php echo esc_url( VEDA_THEME_URI."/framework/theme-options/images/layouts/{$layout}.png" );?>" /></a>
                                  </li>
                          <?php endforeach;?>
                        </ul>
                        <input id="dttheme[layout][site-layout]" name="dttheme[layout][site-layout]" type="hidden" value="<?php echo veda_option('layout','site-layout');?>"/>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

            <?php $style = (veda_option('layout','site-layout') == "boxed") ? '' :'style="display:none;"'; ?>
	        <div id="boxed" class="bpanel-box" <?php echo $style;?>>
                <div class="box-title">
                	<h3><?php esc_html_e('Boxed Layout Background BG', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <?php veda_bgtypes("dttheme[layout][bg-type]","layout","bg-type");?>

                    <?php $bg_pattern = ( veda_option('layout','bg-type')=="bg-patterns" ) ? 'style="display:block"' : 'style="display:none"'; ?>
                    <?php $bg_custom = ( veda_option('layout','bg-type')=="bg-custom" ) ? 'style="display:block"' : 'style="display:none"'; ?>

                	<!-- In-built BG Patterns starts-->
                    <div class="bg-pattern" <?php echo $bg_pattern;?>>

                    	<div class="hr_invisible"> </div>

                    	<h6> <?php esc_html_e('Choose Patterns', 'veda');?> </h6>
                    	<!-- Pattern Sets Start -->
                    	<div class="bpanel-option-set">
                            <ul class="bpanel-layout-set bpanel-post-layout"><?php
                            	$pattrens  = veda_listImage(VEDA_THEME_DIR . "/framework/theme-options/images/patterns/");
								foreach($pattrens as $key => $value):
									$class = ( $key ==  veda_option('layout','boxed-layout-pattern')) ? " class='selected' " : "";
									echo "<li>";
									echo "<a href='#' rel='{$key}' {$class}><img width='80px' height='80px' src='" . VEDA_THEME_URI . "/framework/theme-options/images/patterns/$key' /></a>";
									echo "</li>";
								endforeach;?>
                            </ul>
                            <input id="dttheme[layout][boxed-layout-pattern]" name="dttheme[layout][boxed-layout-pattern]" type="hidden" value="<?php echo veda_option('layout','boxed-layout-pattern');?>"/>
                            <p class="note"><?php esc_html_e('Choose background pattern, you can add patterns by placing .png files in the folder ', 'veda'); echo ('<b>framework/theme-options/images/patterns/</b>');?></p>
                        </div><!-- Patterns set End -->

                        <!-- Pattern BG Settings -->
                        <div class="column one-column">
                        	<div class="bpanel-option-set">
                                <h6><?php esc_html_e('Boxed Layout Background Pattern repeat', 'veda');?></h6>
                                <div class="clear"></div>
                                <select name="dttheme[layout][boxed-layout-pattern-repeat]" class="dt-chosen-select">
                                    <option value=""><?php esc_html_e("Select", 'veda');?></option>
                                    <?php $options = array("repeat","repeat-x","repeat-y","no-repeat");
										foreach($options as $option):?>
                                        <option value="<?php echo esc_attr($option);?>"
                                            <?php selected($option,veda_option('layout','boxed-layout-pattern-repeat')); ?>><?php echo $option;?></option>
                                    <?php endforeach;?>
                                </select>
                                <p class="note"> <?php esc_html_e("Select how would you like to repeat the pattern image", 'veda');?> </p>
                            </div>
                        </div>
                        <div class="hr"> </div>

                        <div class="column one-half">
                            <h6><?php esc_html_e("Show Background Color", 'veda');?></h6>
                            <?php veda_switch("",'layout','show-boxed-layout-pattern-color');?>
                        </div>

                        <div class="column one-half last">
                        <?php $label = 		esc_html__("Choose Background Color", 'veda');
                              $name  =		"dttheme[layout][boxed-layout-pattern-color]";
                              $value =  	(veda_option('layout','boxed-layout-pattern-color') != NULL) ? veda_option('layout','boxed-layout-pattern-color') :"#";
                              $tooltip = 	esc_html__("Pick a custom background color of the theme.(e.g. #a314a3)", 'veda');
                              veda_admin_color_picker($label,$name,$value,'');?>
                              <p class="note"><?php echo esc_html($tooltip);?></p>
                        </div><!-- Pattern BG Settings end-->
                        <div class="hr"> </div>
                        
                        <div class="bpanel-option-set">
	                        <?php echo veda_admin_jqueryuislider( esc_html__("Background opacity", 'veda'),	"dttheme[layout][boxed-layout-pattern-opacity]",
                                                                          veda_option("layout","boxed-layout-pattern-opacity"),"");?>
                        </div>
                    </div><!-- In-built BG Patterns ends-->
                     	
                	<!-- Upload custom BG option Starts -->
                    <div class="bg-custom" <?php echo $bg_custom;?>>
                        
                        <div class="hr_invisible"> </div>

                        <h6><?php esc_html_e("Boxed Layout Background Image", 'veda');?></h6>
                        <div class="clear"></div>
                        <div class="image-preview-container">
                            <input id="dttheme-boxed-layout-bg" name="dttheme[layout][boxed-layout-bg]" type="text" class="uploadfield medium" readonly="readonly"
                                    value="<?php echo veda_option('layout','boxed-layout-bg');?>"/>
                            <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                            <?php veda_adminpanel_image_preview(veda_option('layout','boxed-layout-bg'));?>
                        </div>
                        <p class="note"><?php esc_html_e("Upload an image for the theme's background", 'veda');?> </p>
                       
                       <div class="hr_invisible"> </div>                       
                
                        <!-- Boxed Layout BG Settings -->
                        <div class="column one-half">
                        <?php $bg_settings = array(
                                    array(
                                        "label"=>	esc_html__('Background Image Repeat', 'veda'),
                                        "tooltip"=>	esc_html__("Select how would you like to repeat the background image", 'veda'),
                                        "name" => "dttheme[layout][boxed-layout-bg-repeat]",
                                        "db-key"=>"boxed-layout-bg-repeat",
                                        "options"=>  array("repeat","repeat-x","repeat-y","no-repeat")
                                    ),
                                    array(
                                        "label"=>esc_html__('Background Image Position', 'veda'),
                                        "tooltip"=>	esc_html__("Select how would you like to position the background", 'veda'),
                                        "name" => "dttheme[layout][boxed-layout-bg-position]",
                                        "db-key"=>"boxed-layout-bg-position",
                                        "options"=>  array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right")
                                    )
                              );

                              foreach($bg_settings as $bgsettings): ?>
                                  <div class="bpanel-option-set">
                                    <label><?php echo $bgsettings['label'];?></label>
                                    <div class="clear"></div>
                                    <select name="<?php echo esc_attr($bgsettings['name']);?>" class="dt-chosen-select">
                                        <option value=""><?php esc_html_e("Select", 'veda');?></option>
                                        <?php foreach($bgsettings['options'] as $option):?>
                                            <option value="<?php echo esc_attr($option);?>"
                                                <?php selected($option,veda_option('layout',$bgsettings['db-key'])); ?>><?php echo $option;?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <p class="note"><?php echo $bgsettings['tooltip'];?></p>
                                    <div class="hr_invisible"> </div>
                                  </div><?php
                              endforeach;?>

                              <div class="bpanel-option-set">
                                 <h6><?php esc_html_e("Show Background Color", 'veda');?></h6>
                                 <?php veda_switch("",'layout','show-boxed-layout-bg-color');?>
                              </div>
                        </div><!-- Boxed Layout BG Settings End -->
                        
                         <!-- Boxed Layout BG Color -->
                         <div class="column one-half last">
                            <?php $label = 		esc_html__("Background Color", 'veda');
                                  $name  =		"dttheme[layout][boxed-layout-bg-color]";
                                  $value =  	(veda_option('layout','boxed-layout-bg-color') != NULL) ? veda_option('layout','boxed-layout-bg-color') :"#";
                                  $tooltip = 	esc_html__("Pick a background color of the theme.(e.g. #a314a3)", 'veda');
                                  veda_admin_color_picker($label,$name,$value,'');?>
                                  <p class="note"><?php echo esc_html($tooltip);?></p>
                                  <div class="hr_invisible_large"> </div>
                                
							 <?php echo veda_admin_jqueryuislider( esc_html__("Background opacity", 'veda'),	"dttheme[layout][boxed-layout-bg-opacity]",
                                                                      veda_option("layout","boxed-layout-bg-opacity"),"");?>                                
                         </div><!-- Boxed Layout BG Color -->
                    </div><!-- Upload custom BG option Ends -->
                     
                </div><!-- .box-content -->   
            </div><!-- .bpanel-box -->
        </div><!--#tab1-general end-->

        <!-- #tab2-header -->
        <div id="tab2" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Header Style', 'veda');?></h3>
                </div>

                <div class="box-content">
                	<h6><?php esc_html_e('Header Types', 'veda'); ?></h6>
                    <p class="note no-margin"> <?php esc_html_e("Choose the header type", 'veda');?> </p>
                    <div class="hr_invisible"> </div>
					<div class="bpanel-option-set">
                         <ul class="bpanel-layout-set bpanel-post-layout"><?php
							 $htypes = array("fullwidth-header" => "fullwidth-header", "boxed-header" => "boxed-header", "split-header fullwidth-header" => "splitted-fullwidth-header", "split-header boxed-header" => "splitted-boxed-header", "fullwidth-header header-align-center fullwidth-menu-header" => "fullwidth-menu-center", "two-color-header" => "two-color-header", "fullwidth-header header-align-left fullwidth-menu-header" => "fullwidth-menu-left", "left-header" => "left-header", "left-header-boxed" => "left-header-boxed", "creative-header" => "creative-header", "overlay-header" => "overlay-header");
							 foreach( $htypes as $key => $htype):
								$class = ( $key ==  veda_option('layout','header-type')) ? " class='selected' " : "";?>
								<li class="headerlayout"><a href="#" rel="<?php echo esc_attr($key);?>" <?php echo $class;?> title="<?php echo esc_attr($htype);?>">
									<img src="<?php echo VEDA_THEME_URI . "/framework/theme-options/images/headers/{$htype}.jpg";?>" />
								</a></li><?php
							 endforeach; ?>
                         </ul>
                         <input id="dttheme[layout][header-type]" name="dttheme[layout][header-type]" type="hidden" value="<?php echo veda_option('layout','header-type');?>"/>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Others', 'veda');?></h3>
                </div>

                <div class="box-content">
                	<div class="column one-half">
                        <h6><?php esc_html_e('Enable Sticky Navigation', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('layout','layout-stickynav') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('layout','layout-stickynav') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-stickynav" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-layout-stickynav" name="dttheme[layout][layout-stickynav]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to use sticky header for this site.', 'veda');?></p>
                        </div>
                    </div>
                	<div class="column one-half last">
                        <h6><?php esc_html_e('Header Dark BG', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('layout','header-darkbg') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('layout','header-darkbg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-header-darkbg" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-layout-header-darkbg" name="dttheme[layout][header-darkbg]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to use dark bg header for this site.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="hr"></div>

                	<div class="column one-half">
                        <h6><?php esc_html_e('Header Position', 'veda');?></h6>
                        <div class="column one-fifth">
                            <select id="dttheme-header-position" name="dttheme[layout][header-position]" class="dt-chosen-select"><?php
                              $hpos = array('above slider', 'on slider', 'below slider');
                              foreach($hpos as $v):
                                  $s = selected(veda_option('layout','header-position'),$v,false);
                                  echo "<option $s >$v</option>";
                              endforeach;?>
                            </select>
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('Select header Position for this site.', 'veda');?></p>
                        </div>
                    </div>
                	<div class="column one-half last">
                        <h6><?php esc_html_e('Header Transparency', 'veda');?></h6>
                        <div class="column one-fifth">
                            <select id="dttheme-header-transparant" name="dttheme[layout][header-transparant]" class="dt-chosen-select"><?php
                              $htrans = array('' =>'Choose any one', 'semi-transparent-header' => 'Semi Transparent', 'transparent-header' => 'Transparent');
                              foreach($htrans as $key => $v):
                                  $s = selected(veda_option('layout','header-transparant'),$key,false);
                                  echo "<option value='{$key}' $s>$v</option>";
                              endforeach;?>
                            </select>
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('Select header Transparency for this site.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="hr"></div>
					<div class="clear"></div>

                    <div class="column one-third">
						<h6><?php esc_html_e( 'Header Background','veda');?></h6>
                        <div class="image-preview-container" style="width:86%;">
                            <?php $headbg = veda_option('layout','header-bg');?>
                            <input name="dttheme[layout][header-bg]" type="text" class="uploadfield large" readonly="readonly" value="<?php echo esc_attr($headbg);?>"/>  
                            <div class="hr_invisible"></div>                          
                            <input type="button" value="<?php esc_attr_e('Upload','veda');?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                            <?php if( !empty($headbg) ) veda_adminpanel_image_preview($headbg );?>
                            <p class="note"><?php esc_html_e('Upload an image for the header background.','veda');?></p>
                        </div>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Background Repeat','veda');?></h6>
                        <?php $bgrepeat = veda_option('layout','header-bg-repeat');?>
                        <select class="medium" name="dttheme[layout][header-bg-repeat]">
                            <option value=""><?php esc_html_e("Select",'veda');?></option>
                            <?php foreach( array('repeat','repeat-x','repeat-y','no-repeat') as $option): ?>
                                   <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgrepeat);?>><?php echo esc_attr($option);?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select how would you like to repeat the background image.','veda');?></p>
                    </div>
                    <div class="column one-third last">
                        <h6><?php esc_html_e('Background Position','veda');?></h6>
                        <?php $bgposition = veda_option('layout','header-bg-position');?>
                        <select class="medium" name="dttheme[layout][header-bg-position]">
                            <option value=""><?php esc_html_e('Select','veda');?></option>
                            <?php foreach( array('top left','top center','top right','center left','center center','center right','bottom left','bottom center','bottom right') as $option): ?>
                                <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgposition);?>> <?php echo esc_attr($option);?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select how would you like to position the background.','veda');?></p>
                    </div>
                    <div class="hr"></div>
					<div class="clear"></div>

                    <div class="column one-half">
                    	<h6><?php esc_html_e('Enable Top Bar', 'veda');?></h6>
                        <div class="column one-half">
                              <?php $checked = ( "true" ==  veda_option('layout','layout-topbar') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('layout','layout-topbar') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-topbar" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-layout-topbar" name="dttheme[layout][layout-topbar]" type="checkbox" value="true" <?php echo $checked;?> />
                              <p class="note"><?php esc_html_e('YES! to enable top bar', 'veda');?></p>
                        </div>
                        <div class="column one-column last">
                        	<div class="clear"></div>
                        	<div class="hr_invisible"></div>
                        	<textarea id="dttheme[layout][top-content]" name="dttheme[layout][top-content]"><?php echo stripslashes(veda_option('layout', 'top-content'));?></textarea>
                            <p class="note"><?php esc_html_e('Any code you place here will appear above header of your site.', 'veda');?></p>
                        </div>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--#tab2-header end-->

        <!-- #tab3-menu -->
        <div id="tab3" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Menu', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                	<div class="column one-third">
                        <h6><?php esc_html_e('Menu Active Style', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-menu-active-type" name="dttheme[layout][menu-active-type]" class="dt-chosen-select"><?php
                          $hpos = array('' => 'Choose any one', 'menu-active-with-icon menu-active-highlight' => 'Highlight with Plus Icon', 'menu-active-highlight' => 'Highlight', 'menu-active-highlight-grey' => 'Highlight Grey', 'menu-active-highlight-with-arrow' => 'Highlight with Arrow', 'menu-active-with-two-border' => 'Two Border', 'menu-active-with-double-border' => 'Double Border', 'menu-active-border-with-arrow' => 'Border with Arrow', 'menu-with-slanting-splitter' => 'Slanting Splitter');
                          foreach($hpos as $key => $v):
                              $s = selected(veda_option('layout','menu-active-type'),$key,false);
                              echo "<option value ='{$key}' $s >$v</option>";
                          endforeach;?>
                        </select>
                          <p class="note"><?php esc_html_e('Choose type of menu active for this site.', 'veda');?></p>                    
                    </div>
                    <div class="hr"></div>
                    
                	<div class="column one-half">
                        <h6><?php esc_html_e('Search Icon', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('layout','menu-searchicon') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('layout','menu-searchicon') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-menu-searchicon" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-layout-menu-searchicon" name="dttheme[layout][menu-searchicon]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('YES! to show search icon for this site.', 'veda');?></p>
                        </div>
                    </div>
                	<div class="column one-half last">
						<h6><?php esc_html_e('Top Left Content', 'veda');?></h6>
                    	<div class="column one-column">
	                    	<textarea id="dttheme[layout][menu-top-left-content]" name="dttheme[layout][menu-top-left-content]"><?php echo stripslashes(veda_option('layout', 'menu-top-left-content'));?></textarea>
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('This content will appear top left side of menu, <br>applies only for selected headers.', 'veda');?></p>
                        </div>
					</div>
                    <div class="hr"></div>
					<div class="clear"></div>
                    
                	<div class="column one-half">
                        <h6><?php esc_html_e('Cart Icon', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('layout','menu-carticon') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('layout','menu-carticon') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-menu-carticon" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-layout-menu-carticon" name="dttheme[layout][menu-carticon]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('YES! to show cart icon for this site.', 'veda');?></p>
                        </div>
					</div>
                	<div class="column one-half last">
						<h6><?php esc_html_e('Top Right Content', 'veda');?></h6>
                    	<div class="column one-column">
	                    	<textarea id="dttheme[layout][menu-top-right-content]" name="dttheme[layout][menu-top-right-content]"><?php echo stripslashes(veda_option('layout', 'menu-top-right-content'));?></textarea>
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('This content will appear top right side of menu, <br>applies only for selected headers.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="hr"></div>
					<div class="clear"></div>

                	<div class="column one-half">
						<h6><?php esc_html_e('Left Header Content', 'veda');?></h6>
                    	<div class="column one-column">
	                    	<textarea id="dttheme[layout][menu-left-header-content]" name="dttheme[layout][menu-left-header-content]"><?php echo stripslashes(veda_option('layout', 'menu-left-header-content'));?></textarea>
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('This content will appear bottom of menu, <br>applies only left header.', 'veda');?></p>
                        </div>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

            <!-- Sub Menu .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Sub Menu or Mega Menu','veda');?></h3>
                </div>
                <div class="box-content">
                	<h4><?php esc_html_e('Mega Menu & Sub Menu Container Options', 'veda');?></h4>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Hover Animation', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-menu-hover-style" name="dttheme[layout][menu-hover-style]" class="dt-chosen-select"><?php
                            $hover_styles = array(
                                '' => esc_html__('Default','veda'), "bigEntrance" => "bigEntrance", "bounce" => "bounce",
                                "bounceIn" => "bounceIn", "bounceInDown" => "bounceInDown", "bounceInLeft" => "bounceInLeft",
                                "bounceInRight" => "bounceInRight", "bounceInUp" => "bounceInUp", "bounceOut" => "bounceOut",
                                "bounceOutDown" => "bounceOutDown","bounceOutLeft" => "bounceOutLeft", "bounceOutRight" => "bounceOutRight",
                                "bounceOutUp" => "bounceOutUp", "expandOpen" => "expandOpen","expandUp" => "expandUp", "fadeIn" => "fadeIn",
                                "fadeInDown" => "fadeInDown", "fadeInDownBig" => "fadeInDownBig", "fadeInLeft" => "fadeInLeft",
                                "fadeInLeftBig" => "fadeInLeftBig", "fadeInRight" => "fadeInRight", "fadeInRightBig" => "fadeInRightBig",
                                "fadeInUp" => "fadeInUp","fadeInUpBig" => "fadeInUpBig", "fadeOut" => "fadeOut", "fadeOutDownBig" => "fadeOutDownBig",
                                "fadeOutLeft" => "fadeOutLeft","fadeOutLeftBig" => "fadeOutLeftBig", "fadeOutRight" => "fadeOutRight",
                                "fadeOutUp" => "fadeOutUp", "fadeOutUpBig" => "fadeOutUpBig", "flash" => "flash","flip" => "flip", "flipInX" => "flipInX",
                                "flipInY" => "flipInY", "flipOutX" => "flipOutX", "flipOutY" => "flipOutY", "floating" => "floating","hatch" => "hatch",
                                "hinge" => "hinge", "lightSpeedIn" => "lightSpeedIn", "lightSpeedOut" => "lightSpeedOut", "pullDown" => "pullDown",
                                "pullUp" => "pullUp", "pulse" => "pulse", "rollIn" => "rollIn", "rollOut" => "rollOut", "rotateIn" => "rotateIn",
                                "rotateInDownLeft" => "rotateInDownLeft","rotateInDownRight" => "rotateInDownRight", "rotateInUpLeft" => "rotateInUpLeft",
                                "rotateInUpRight" => "rotateInUpRight", "rotateOut" => "rotateOut","rotateOutDownRight" => "rotateOutDownRight",
                                "rotateOutUpLeft" => "rotateOutUpLeft", "rotateOutUpRight" => "rotateOutUpRight", "shake" => "shake",
                                "slideDown" => "slideDown", "slideExpandUp" => "slideExpandUp", "slideLeft" => "slideLeft", "slideRight" => "slideRight",
                                "slideUp" => "slideUp","stretchLeft" => "stretchLeft", "stretchRight" => "stretchRight","swing" => "swing", "tada" => "tada",
                                "tossing" => "tossing", "wobble" => "wobble","fadeOutDown" => "fadeOutDown", "fadeOutRightBig" => "fadeOutRightBig",
                                "rotateOutDownLeft" => "rotateOutDownLeft");
                            foreach($hover_styles as $key => $v):
                                $s = selected(veda_option('layout','menu-hover-style'),$key,false);
                                echo "<option value ='{$key}' $s >$v</option>";
                            endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select sub menu hover animation for this site.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                	<h4><?php esc_html_e('Border', 'veda');?></h4>
                    
                    <div class="column one-third">&nbsp;</div>
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  veda_option('layout','menu-border') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  veda_option('layout','menu-border') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-border" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-border" name="dttheme[layout][menu-border]" type="checkbox" value="true" <?php echo $checked;?> />
                        <p class="note"><?php esc_html_e('YES! to show menu border for this site.', 'veda');?></p>
                    </div>                     
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Width', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Top (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-border-width-top]" class="small" value="<?php echo veda_option('layout','menu-border-width-top');?>" />
                        </div>
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Right (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-border-width-right]" class="small" value="<?php echo veda_option('layout','menu-border-width-right');?>" />
                        </div>
                    	<div class="column one-fifth" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Bottom (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-border-width-bottom]" class="small" value="<?php echo veda_option('layout','menu-border-width-bottom');?>" />
                        </div>
                    	<div class="column one-fifth last" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Left (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-border-width-left]" class="small" value="<?php echo veda_option('layout','menu-border-width-left');?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border width of menu container for this site.', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Style', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-menu-border-style" name="dttheme[layout][menu-border-style]" class="dt-chosen-select"><?php
                            $border_styles = array( 'dotted' => esc_html__('Dotted','veda'), 'dashed' => esc_html__('Dashed','veda'),'solid' => esc_html__('Solid','veda'), 'double' => esc_html__('Double','veda'),
								'groove' => esc_html__('Groove','veda'), 'ridge' => esc_html__('Ridge','veda'));
                            foreach($border_styles as $key => $v):
                                $s = selected(veda_option('layout','menu-border-style'),$key,false);
                                echo "<option value ='{$key}' $s >$v</option>";
                            endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select border style of menu container for this site.', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Color', 'veda');?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-border-color]";
                        $value =  (veda_option('layout','menu-border-color') != NULL) ? veda_option('layout','menu-border-color') : "";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Set a custom border color of the menu container.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Radius', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Top Left (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-border-radius-top]" class="small" value="<?php echo veda_option('layout','menu-border-radius-top');?>" />
                        </div>
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Top Right (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-border-radius-right]" class="small" value="<?php echo veda_option('layout','menu-border-radius-right');?>" />
                        </div>
                    	<div class="column one-fifth" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Bottom Right (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-border-radius-bottom]" class="small" value="<?php echo veda_option('layout','menu-border-radius-bottom');?>" />
                        </div>
                    	<div class="column one-fifth last" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Bottom Left (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-border-radius-left]" class="small" value="<?php echo veda_option('layout','menu-border-radius-left');?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border radius of menu container for this site.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third">
                        <h6><?php esc_html_e('Box Shadow', 'veda');?></h6>
                    </div>
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  veda_option('layout','menu-boxshadow') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  veda_option('layout','menu-boxshadow') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-boxshadow" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-boxshadow" name="dttheme[layout][menu-boxshadow]" type="checkbox" value="true" <?php echo $checked;?> />
                        <p class="note"><?php esc_html_e('YES! to show box shadow for this site.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                	<h4><?php esc_html_e('Background', 'veda');?></h4>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Background Color', 'veda');?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-bg-color]";
                        $value =  (veda_option('layout','menu-bg-color') != NULL) ? veda_option('layout','menu-bg-color') : "";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Set a custom background color of the menu container.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Gradient Background', 'veda');?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-gradient-color1]";
                        $value =  (veda_option('layout','menu-gradient-color1') != NULL) ? veda_option('layout','menu-gradient-color1') : "";
                        veda_admin_color_picker_two($name,$value);

                        $name  =  "dttheme[layout][menu-gradient-color2]";
                        $value =  (veda_option('layout','menu-gradient-color2') != NULL) ? veda_option('layout','menu-gradient-color2') : "";
                        veda_admin_color_picker_two($name,$value);?><br />

                        <input type="text" name="dttheme[layout][menu-gradient-percent1]" style="width:29%;" placeholder="20%" class="small" value="<?php echo veda_option('layout','menu-gradient-percent1');?>" />
                        <input type="text" name="dttheme[layout][menu-gradient-percent2]" style="width:29%;" placeholder="80%" class="small" value="<?php echo veda_option('layout','menu-gradient-percent2');?>" />

                        <p class="note"><?php esc_html_e('Set a custom gradient color of the menu container.', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Background Image', 'veda');?></h6>
                    </div>
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  veda_option('layout','menu-bgimage') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  veda_option('layout','menu-bgimage') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-bgimage" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-bgimage" name="dttheme[layout][menu-bgimage]" type="checkbox" value="true" <?php echo $checked;?> />
                        <p class="note"><?php esc_html_e('YES! to show background image for menu items.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                	<h4><?php esc_html_e('Mega Menu Column Title', 'veda');?></h4> 
                            
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Default', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Text Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-title-text-dcolor]";
							$value =  (veda_option('layout','menu-title-text-dcolor') != NULL) ? veda_option('layout','menu-title-text-dcolor') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth last">
                            <p class="note no-margin"><?php esc_html_e('Hover Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-title-text-dhcolor]";
							$value =  (veda_option('layout','menu-title-text-dhcolor') != NULL) ? veda_option('layout','menu-title-text-dhcolor') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a default color options of the menu title.(e.g. #a314a3)', 'veda');?></p>
                    </div>     
                           
                                     
                    <div class="column one-third">
                        <h6><?php esc_html_e('With Background', 'veda');?></h6>
                    </div>
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  veda_option('layout','menu-title-bg') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  veda_option('layout','menu-title-bg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-title-bg" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-title-bg" name="dttheme[layout][menu-title-bg]" type="checkbox" value="true" <?php echo $checked;?> />
                        <p class="note"><?php esc_html_e('YES! to show mega menu column title background for this site.', 'veda');?></p>
                    </div>  
                    <div class="column one-third">&nbsp;</div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('BG Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-title-bg-color]";
							$value =  (veda_option('layout','menu-title-bg-color') != NULL) ? veda_option('layout','menu-title-bg-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Text Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-title-text-color]";
							$value =  (veda_option('layout','menu-title-text-color') != NULL) ? veda_option('layout','menu-title-text-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Hover BG Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-title-hoverbg-color]";
							$value =  (veda_option('layout','menu-title-hoverbg-color') != NULL) ? veda_option('layout','menu-title-hoverbg-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Hover Text Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-title-hovertext-color]";
							$value =  (veda_option('layout','menu-title-hovertext-color') != NULL) ? veda_option('layout','menu-title-hovertext-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a custom color options of the menu title.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Radius', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <input type="text" name="dttheme[layout][menu-title-border-radius]" class="small" value="<?php echo veda_option('layout','menu-title-border-radius');?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border radius value, when using background color.', 'veda');?></p>
                        <div class="hr_invisible"></div>
                    </div>
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Width', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Top (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-title-border-width-top]" class="small" value="<?php echo veda_option('layout','menu-title-border-width-top');?>" />
                        </div>
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Right (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-title-border-width-right]" class="small" value="<?php echo veda_option('layout','menu-title-border-width-right');?>" />
                        </div>
                    	<div class="column one-fifth" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Bottom (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-title-border-width-bottom]" class="small" value="<?php echo veda_option('layout','menu-title-border-width-bottom');?>" />
                        </div>
                    	<div class="column one-fifth last" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Left (in px)', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-title-border-width-left]" class="small" value="<?php echo veda_option('layout','menu-title-border-width-left');?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border width of menu title for this site.', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Style', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-menu-title-border-style" name="dttheme[layout][menu-title-border-style]" class="dt-chosen-select"><?php
                            $border_styles = array( 'dotted' => esc_html__('Dotted','veda'), 'dashed' => esc_html__('Dashed','veda'),'solid' => esc_html__('Solid','veda'), 'double' => esc_html__('Double','veda'),
								'groove' => esc_html__('Groove','veda'), 'ridge' => esc_html__('Ridge','veda'));
                            foreach($border_styles as $key => $v):
                                $s = selected(veda_option('layout','menu-title-border-style'),$key,false);
                                echo "<option value ='{$key}' $s >$v</option>";
                            endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select border style of menu title for this site.', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Color', 'veda');?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-title-border-color]";
                        $value =  (veda_option('layout','menu-title-border-color') != NULL) ? veda_option('layout','menu-title-border-color') : "";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Set a custom border color of the menu title.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                    
                	<h4><?php esc_html_e('Mega Menu & Sub Menu Links', 'veda');?></h4>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Default', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Text Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-link-text-dcolor]";
							$value =  (veda_option('layout','menu-link-text-dcolor') != NULL) ? veda_option('layout','menu-link-text-dcolor') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth last">
                            <p class="note no-margin"><?php esc_html_e('Hover Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-link-text-dhcolor]";
							$value =  (veda_option('layout','menu-link-text-dhcolor') != NULL) ? veda_option('layout','menu-link-text-dhcolor') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a default color options of the menu link.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('With Background', 'veda');?></h6>
                    </div>
                    
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  veda_option('layout','menu-links-bg') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  veda_option('layout','menu-links-bg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-links-bg" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-links-bg" name="dttheme[layout][menu-links-bg]" type="checkbox" value="true" <?php echo $checked;?> />
                        <p class="note"><?php esc_html_e('YES! to show menu links background for this site.', 'veda');?></p>
                    </div>
                    
                    <div class="column one-third"> &nbsp; </div>
                    
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('BG Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-link-bg-color]";
							$value =  (veda_option('layout','menu-link-bg-color') != NULL) ? veda_option('layout','menu-link-bg-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Text Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-link-text-color]";
							$value =  (veda_option('layout','menu-link-text-color') != NULL) ? veda_option('layout','menu-link-text-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Hover BG Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-link-hoverbg-color]";
							$value =  (veda_option('layout','menu-link-hoverbg-color') != NULL) ? veda_option('layout','menu-link-hoverbg-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Hover Text Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-link-hovertext-color]";
							$value =  (veda_option('layout','menu-link-hovertext-color') != NULL) ? veda_option('layout','menu-link-hovertext-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a custom color options of the menu link.(e.g. #a314a3)', 'veda');?></p>
                    </div>                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Radius', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <input type="text" name="dttheme[layout][menu-link-border-radius]" class="small" value="<?php echo veda_option('layout','menu-link-border-radius');?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border radius value, when using background color.', 'veda');?></p>
                        <div class="hr_invisible"></div>
                    </div>
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('With Hover Border', 'veda');?></h6>
                    </div>
                    
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  veda_option('layout','menu-hover-border') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  veda_option('layout','menu-hover-border') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-hover-border" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-hover-border" name="dttheme[layout][menu-hover-border]" type="checkbox" value="true" <?php echo $checked;?> />
                        <p class="note"><?php esc_html_e('YES! to show menu links hover border for this site.', 'veda');?></p>
                    </div>


                    <div class="column one-third">
                        <h6><?php esc_html_e('Hover Border Color', 'veda');?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-link-hborder-color]";
                        $value =  (veda_option('layout','menu-link-hborder-color') != NULL) ? veda_option('layout','menu-link-hborder-color') : "";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Set a custom hover border color of the menu link.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('With Bottom Border', 'veda');?></h6>
                    </div>
                    
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  veda_option('layout','menu-links-border') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  veda_option('layout','menu-links-border') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-links-border" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-links-border" name="dttheme[layout][menu-links-border]" type="checkbox" value="true" <?php echo $checked;?> />
                        <p class="note"><?php esc_html_e('YES! to show menu links border for this site.', 'veda');?></p>
                    </div>
                    
                    <div class="column one-third"> &nbsp; </div> 
                    
                    <div class="column two-third last">
                        <div class="column one-fourth" style="width:23%;">
                        	<p class="note no-margin"><?php esc_html_e('Border Width', 'veda');?></p>
                            <input type="text" name="dttheme[layout][menu-link-border-width]" class="medium" value="<?php echo veda_option('layout','menu-link-border-width');?>" />
                        </div>
                        <div class="column one-fourth" style="width:32%;">
                            <p class="note no-margin"><?php esc_html_e('Border Color', 'veda');?></p><?php
							$name  =  "dttheme[layout][menu-link-border-color]";
							$value =  (veda_option('layout','menu-link-border-color') != NULL) ? veda_option('layout','menu-link-border-color') : "";
							veda_admin_color_picker_two($name,$value);?>
                        </div>
                        <div class="column one-fourth last">
                            <p class="note no-margin"><?php esc_html_e('Border Style', 'veda');?></p>
                            <select id="dttheme-menu-link-border-style" name="dttheme[layout][menu-link-border-style]" class="small"><?php
                                $border_style = array( 'dotted' => esc_html__('Dotted','veda'), 'dashed' => esc_html__('Dashed','veda'),'solid' => esc_html__('Solid','veda'), 'double' => esc_html__('Double','veda'),
								'groove' => esc_html__('Groove','veda'), 'ridge' => esc_html__('Ridge','veda'));
                                foreach($border_style as $key => $v):
                                    $s = selected(veda_option('layout','menu-link-border-style'),$key,false);
                                    echo "<option value ='{$key}' $s >$v</option>";
                                endforeach;?>
                            </select>
                        </div>
                        <p class="note"><?php esc_html_e('Pick bottom border options for menu link.', 'veda');?></p>
                    </div>                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Default Arrow', 'veda');?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
							<p class="note no-margin"><?php esc_html_e('Enable Arrow', 'veda');?></p><?php
							$checked = ( "true" ==  veda_option('layout','menu-link-arrow') ) ? ' checked="checked"' : ''; ?>
							<?php $switchclass = ( "true" ==  veda_option('layout','menu-link-arrow') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
							<div data-for="dttheme-layout-menu-link-arrow" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
							<input class="hidden" id="dttheme-layout-menu-link-arrow" name="dttheme[layout][menu-link-arrow]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column one-fourth last">
                            <p class="note no-margin"><?php esc_html_e('Arrow Style', 'veda');?></p>
                            <select id="dttheme-menu-link-arrow-style" name="dttheme[layout][menu-link-arrow-style]" class="small"><?php
                                $arrow_style = array( 'single' => esc_html__('Single','veda'),'double' => esc_html__('Double','veda'),'disc' => esc_html__('Disc','veda'));
                                foreach($arrow_style as $key => $v):
                                    $s = selected(veda_option('layout','menu-link-arrow-style'),$key,false);
                                    echo "<option value ='{$key}' $s >$v</option>";
                                endforeach;?>
                            </select>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a default arrow & it style of the menu link.', 'veda');?></p>
                    </div>
                </div>
            </div><!-- Sub Menu .bpanel-box end -->

        </div><!--#tab3-menu end-->

        <!-- #tab4-sociable -->
        <div id="tab4" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Sociable', 'veda');?></h3>
                </div>

                <div class="box-content">
                	<div class="bpanel-option-set">
                        <h6><?php esc_html_e('Show Sociable', 'veda');?></h6>
                        <div class="column one-fifth">
                           <?php $switchclass = ( "on" ==  veda_option('layout','show-sociables') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                           <div data-for="dttheme-show-sociables" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                           <input class="hidden" id="dttheme-show-sociables" name="dttheme[layout][show-sociables]" type="checkbox" 
                           <?php checked(veda_option('layout','show-sociables'),'on');?>/>
                        </div>
                        <input type="button" value="<?php esc_attr_e('Add New Sociable', 'veda');?>" class="black dttheme_add_item" />
                        <div class="column four-fifth last">
                           <p class="note"><?php esc_html_e('YES! to show social icons & Add new to the list to display', 'veda');?></p>
                        </div>
                        <div class="hr_invisible"></div>
					</div>

					<div class="bpanel-option-set">
                        <ul class="menu-to-edit">
                        <?php $socials = veda_option('social');
						      if(is_array($socials)):
							  	$keys = array_keys($socials);
								$i=0;
								
						 	  foreach($socials as $s):?>
                                  <li id="<?php echo esc_attr($keys[$i]);?>">
                                    <div class="item-bar">
                                        <span class="item-title"><?php $n = $s['icon']; $n = substr($n, 3); $n = ucwords($n); echo $n;?></span>
                                        <span class="item-control"><a class="item-edit"><?php esc_html_e('Edit', 'veda');?></a></span>
                                    </div>
                                    <div class="item-content" style="display: none;">
                                        <span><label><?php esc_html_e('Sociable Icon', 'veda');?></label>
                                            <?php echo veda_sociables_selection($keys[$i],$s['icon']);?></span>
                                        <span><label><?php esc_html_e('Sociable Link', 'veda');?></label>
                                            <input type="text" class="social-link" name="dttheme[social][<?php echo $keys[$i];?>][link]" value="<?php echo esc_attr($s['link']);?>"/></span>
                                        <div class="remove-cancel-links">
                                            <span class="remove-item"><?php esc_html_e('Remove', 'veda');?></span>
                                            <span class="meta-sep"> | </span>
                                            <span class="cancel-item"><?php esc_html_e('Cancel', 'veda');?></span>
                                        </div>
                                    </div>
                                  </li>
                        <?php $i++; endforeach; endif;?> 
                        </ul>
                        
                        <ul class="sample-to-edit" style="display:none;">
                        	<li><!-- Social Item -->
                            	<div class="item-bar"><!-- .item-bar -->
                                	<span class="item-title"><?php esc_html_e('Sociable', 'veda');?></span>
                                    <span class="item-control"><a class="item-edit"><?php esc_html_e('Edit', 'veda');?></a></span>
                                </div><!-- .item-bar -->
                                <div class="item-content"><!-- .item-content -->                                
                                	<span><label><?php esc_html_e('Sociable Icon', 'veda');?></label><?php echo veda_sociables_selection();?></span>
                                    <span><label><?php esc_html_e('Sociable Link', 'veda');?></label><input type="text" class="social-link" /></span>
                                    <div class="remove-cancel-links">
                                        <span class="remove-item"><?php esc_html_e('Remove', 'veda');?></span>
                                        <span class="meta-sep"> | </span>
                                        <span class="cancel-item"><?php esc_html_e('Cancel', 'veda');?></span>
                                    </div>
                                </div><!-- .item-content end -->
                            </li><!-- Social Item End-->
                        </ul>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!--#tab4-sociable end-->

        <!-- #tab5-footer -->
        <div id="tab5" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">

                <div class="box-title">
                    <h3><?php esc_html_e('Footer', 'veda');?></h3>
                </div>
                
                <div class="box-content">

                    <div class="column one-half">
                        <h6><?php esc_html_e('Enable Footer Columns', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('layout','enable-footer') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('layout','enable-footer') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-footer" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-layout-footer" name="dttheme[layout][enable-footer]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to use footer columns for this site.', 'veda');?></p>
                        </div>
                    </div>

                    <div class="column one-half last">
                        <h6><?php esc_html_e('Footer Dark BG', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('layout','footer-darkbg') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('layout','footer-darkbg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-footer-darkbg" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-layout-footer-darkbg" name="dttheme[layout][footer-darkbg]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to use dark background footer for this site.', 'veda');?></p>
                        </div>
                    </div>

                    <div class="hr"></div>

                    <div class="bpanel-option-set">
                        <h6><?php esc_html_e('Footer Column Layout', 'veda');?></h6>
                        <p class="note"><?php esc_html_e("Select a perfect column layout style for your theme's footer.", 'veda');?></p>
                        <ul class="bpanel-layout-set bpanel-post-layout">
                        <?php $footer_layouts = array(
									1=>'one-column',							2=>'one-half-column',
									3=>'one-third-column',						4=>'one-fourth-column',
									5=>'one-fifth-column',						6=>'one-sixth-column',
									12=>'onefourth-onefourth-onehalf-column',	13=>'onehalf-onefourth-onefourth-column',
                                    11 => 'onefourth-onehalf-onefourth-column',
									7=>'onefourth-threefourth-column',			8=>'threefourth-onefourth-column',
									9=>'onethird-twothird-column',				10=>'twothird-onethird-column');
						//Footer layout options...
                        foreach($footer_layouts as $k => $v): 
                            $class = ( $k ==  veda_option('layout','footer-columns')) ? " class='selected' " : "";?>
                            <li><a href="#" rel="<?php echo esc_attr($k);?>" <?php echo $class;?>><img src="<?php echo VEDA_THEME_URI . "/framework/theme-options/images/columns/{$v}.png";?>" /></a></li><?php 
                        endforeach;?>
                        </ul>
                        <input id="dttheme[layout][footer-columns]" name="dttheme[layout][footer-columns]" type="hidden" value="<?php echo veda_option('layout','footer-columns');?>"/>
	                    <div class="hr"></div>
                    </div>

                    <!-- footer-bg -->
                    <h6><?php esc_html_e('Footer Background Image', 'veda');?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-footerbg" name="dttheme[layout][footer-bg]" type="text" class="uploadfield" readonly="readonly" value="<?php echo veda_option('layout','footer-bg');?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button show_preview" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('layout','footer-bg'));?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload an image for footer background, or specify the image url directly', 'veda');?></p>
                    <div class="clear"></div>
                    <!-- footer-bg -->
                    
                    <!-- Boxed Layout BG Settings -->
                    <div class="column one-half">

	                    <?php $bg_settings = array("repeat","repeat-x","repeat-y","no-repeat"); ?>

                        <div class="bpanel-option-set">
                          <label><?php esc_html_e('Background Image Repeat', 'veda');?></label>
                          <div class="clear"></div>
                          <select name="dttheme[layout][footer-bg-repeat]" class="dt-chosen-select">
                              <option value=""><?php esc_html_e("Select", 'veda');?></option>
                              <?php foreach($bg_settings as $option):?>
                                  <option value="<?php echo esc_attr($option);?>"
                                      <?php selected($option,veda_option('layout', 'footer-bg-repeat')); ?>><?php echo $option;?></option>
                              <?php endforeach;?>
                          </select>
                          <p class="note"><?php esc_html_e("Select how would you like to repeat the background image", 'veda');?></p>
                          <div class="hr_invisible"> </div>
                        </div>

                    </div><!-- Boxed Layout BG Settings End -->

                    <div class="column one-half last">

                    	<?php $bg_settings = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right"); ?>

                        <div class="bpanel-option-set">
                          <label><?php esc_html_e('Background Image Position', 'veda');?></label>
                          <div class="clear"></div>
                          <select name="dttheme[layout][footer-bg-position]" class="dt-chosen-select">
                              <option value=""><?php esc_html_e("Select", 'veda');?></option>
                              <?php foreach($bg_settings as $option):?>
                                  <option value="<?php echo esc_attr($option);?>"
                                      <?php selected($option,veda_option('layout', 'footer-bg-position')); ?>><?php echo $option;?></option>
                              <?php endforeach;?>
                          </select>
                          <p class="note"><?php esc_html_e("Select how would you like to position the background", 'veda');?></p>
                          <div class="hr_invisible"> </div>
                        </div>
                    </div><!-- Boxed Layout BG Settings End -->

                </div><!-- .box-content -->

                <div class="box-title">
                    <h3><?php esc_html_e('Copyright Section', 'veda');?></h3>
                </div>
                <div class="box-content">

                    <!-- enable-copyright -->
                    <div class="column one-half">
                        <h6><?php esc_html_e('Show Copyright Text', 'veda');?></h6>
                        <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('layout','enable-copyright') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('layout','enable-copyright') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-layout-copyright" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-layout-copyright" name="dttheme[layout][enable-copyright]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to show copyright text.', 'veda');?></p>
                        </div>
                        <div class="clear"></div>
                        <div class="hr_invisible"></div>
                        <!-- copyright content -->
                        <textarea id="dttheme[layout][copyright-content]" name="dttheme[layout][copyright-content]"><?php echo stripslashes(veda_option('layout', 'copyright-content'));?></textarea>
                        <p class="note no-margin"><?php esc_html_e('Enter copyright text in this box. <br>This will be automatically added to the footer.', 'veda');?></p>
                        <!-- copyright content -->
                    </div><!-- enable-copyright -->

                    <!-- enable-copyright-darkbg -->
                    <div class="column one-half">
                        <h6><?php esc_html_e('Copyright Dark BG', 'veda');?></h6>
                        <div class="column one-fifth">
                            <?php $checked = ( "true" ==  veda_option('layout','copyright-darkbg') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('layout','copyright-darkbg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="dttheme-layout-copyright-darkbg" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-layout-copyright-darkbg" name="dttheme[layout][copyright-darkbg]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                            <p class="note"><?php esc_html_e('YES! to use dark bg copyright for this site.', 'veda');?></p>
                        </div>
                        <div class="clear"></div>
                        <div class="hr_invisible"></div>
                    </div><!-- enable-copyright-darkbg -->
                </div>
            </div><!-- .bpanel-box end -->            
        </div><!--#tab5-footer end-->

        <!-- #tab6-hooks -->
        <div id="tab6" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Custom CSS', 'veda');?></h3>
                </div>

                <div class="box-content">
                     <h6><?php esc_html_e('Enable Custom CSS', 'veda');?></h6>
                     <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('layout','enable-customcss') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('layout','enable-customcss') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-layout-customcss" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-layout-customcss" name="dttheme[layout][enable-customcss]" type="checkbox" value="true" <?php echo $checked;?> />
                     </div>
                     <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to use custom CSS.', 'veda');?></p>
                     </div>
                     <div class="clear"></div>
                     <div class="hr_invisible_large"></div>
                     <textarea id="dttheme[layout][customcss-content]" name="dttheme[layout][customcss-content]"><?php echo stripslashes(veda_option('layout', 'customcss-content'));?></textarea>
                     <p class="note"><?php esc_html_e('Enter your custom CSS code here.', 'veda');?></p>

                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Custom JS', 'veda');?></h3>
                </div>

                <div class="box-content">
                     <h6><?php esc_html_e('Enable Custom JS', 'veda');?></h6>
                     <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('layout','enable-customjs') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('layout','enable-customjs') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-layout-customjs" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-layout-customjs" name="dttheme[layout][enable-customjs]" type="checkbox" value="true" <?php echo $checked;?> />
                     </div>
                     <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to use custom JS', 'veda');?></p>
                     </div>
                     <div class="clear"></div>
                     <div class="hr_invisible_large"></div>
                     <textarea id="dttheme[layout][customjs-content]" name="dttheme[layout][customjs-content]"><?php echo stripslashes(veda_option('layout', 'customjs-content'));?></textarea>
                     <p class="note"><?php esc_html_e('Enter your custom JS code here. <br><b>To use jQuery code wrap it into jQuery(function($){ ... });</b>', 'veda');?></p>

                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--#tab6-hooks end-->
    </div><!-- .bpanel-main-content end-->
</div><!-- #layout end-->