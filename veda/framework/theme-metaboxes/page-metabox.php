<?php
	#Page Meta Box
	add_action("add_meta_boxes", "veda_page_metabox");
	add_action('save_post','veda_page_meta_save');
	function veda_page_metabox(){
		add_meta_box("page-template-slider-meta-container", esc_html__('Slider Options', 'veda'), "veda_page_slider_settings", "page", "normal", "default");
		add_meta_box("page-template-meta-container", esc_html__('Default page Options', 'veda'), "veda_page_settings", "page", "normal", "default");
	}

	#Slider Meta Box
	function veda_page_slider_settings($args){
		global $post;
		$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
		echo '<input type="hidden" name="dt_theme_page_meta_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';?>

		<!-- Show Slider -->
        <div class="custom-box">
        	<div class="column one-sixth">
                <label><?php esc_html_e('Show Slider','veda');?> </label>
            </div>
            <div class="column four-sixth last">
				<?php $switchclass = array_key_exists("show_slider",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                      $checked = array_key_exists("show_slider",$tpl_default_settings) ? ' checked="checked"' : '';?>
                <div data-for="dttheme-show-slider" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                <input id="dttheme-show-slider" class="hidden" type="checkbox" name="dttheme-show-slider" value="true" <?php echo $checked;?>/>
                <p class="note"> <?php esc_html_e('YES! to show slider on this page.','veda');?> </p>
            </div>
        </div><!-- Show Slider End-->

        <!-- Slider Types -->
        <div class="custom-box">
        	<div class="column one-sixth">
                <label><?php esc_html_e('Choose Slider','veda');?></label>
            </div>
            <div class="column four-sixth last">
	            <?php $slider_types = array( '' => esc_html__('Select','veda'),
											 'layerslider' => esc_html__('Layer Slider','veda'),
											 'revolutionslider' => esc_html__('Revolution Responsive','veda'),
											 'customslider' => esc_html__('Custom Slider Shortcode', 'veda'));
											 
	 				  $v =  array_key_exists("slider_type",$tpl_default_settings) ?  $tpl_default_settings['slider_type'] : '';
					  echo "<select class='slider-type dt-chosen-select' name='dttheme-slider-type'>";
					  foreach($slider_types as $key => $value):
					  	$rs = selected($key,$v,false);
						echo "<option value='{$key}' {$rs}>{$value}</option>";
					  endforeach;
	 				 echo "</select>";?>
            <p class="note"> <?php esc_html_e("Select a slider for your page",'veda');?> </p>
            </div>
        </div><!-- Slider Types End-->

        <!-- slier-container starts-->
    	<div id="slider-conainer"><?php

    		$layerslider = $revolutionslider = $customslider = 'style="display:none"';

        	if(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "layerslider"):
        		$layerslider = 'style="display:block"';
        	elseif(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "revolutionslider"):
        		$revolutionslider = 'style="display:block"';
        	elseif(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "customslider"):
        		$customslider = 'style="display:block"';
        	endif;?>

        	<!-- Layered Slider -->
        	<div id="layerslider" class="custom-box" <?php echo $layerslider;?>>
        		<h3><?php esc_html_e('Layer Slider','veda');?></h3><?php
    			# Check layer slider active
    			if(veda_is_plugin_active('LayerSlider/layerslider.php')):
    				$sliders = LS_Sliders::find(array('limit' => 50));

    				if(!empty($sliders)):
    					echo '<div class="one-half-content">';
    					echo '	<div class="bpanel-option-set">';
    					echo '		<div class="column one-sixth">';
    					echo '			<label>'.esc_html__('Select LayerSlider','veda').'</label>';
    					echo '		</div>';
    					echo ' 		<div class="column two-sixth">';
    					echo '			<select name="layerslider_id" class="dt-chosen-select">';
    					echo '				<option value="0">'.esc_html__("Select Slider",'veda').'</option>';
    										foreach($sliders as $key => $item):
    											$id = $item['id'];
    											$name = $item['name'];
    											$rs = isset($tpl_default_settings['layerslider_id']) ? $tpl_default_settings['layerslider_id']:'';
    											$rs = selected($id,$rs,false);
    											echo "	<option value='{$id}' {$rs}>{$name}</option>";
    										endforeach;
    					echo '			</select>';
    					echo '			<p class="note">'.esc_html__("Choose Which LayerSlider you would like to use..",'veda').'</p>';
    					echo '		</div>';
    					echo '	</div>';
						echo '</div>';
					else:
						echo '<p id="j-no-images-container">'.esc_html__('Please add at leat one layer slider','veda').'</p>';
					endif;
				else:
					echo '<p id="j-no-images-container">'.esc_html__('Please activate Layered Slider','veda').'</p>';
				endif; ?>
            </div><!-- Layered Slider End-->

            <!-- Revolution Slider -->
            <div id="revolutionslider" class="custom-box" <?php echo $revolutionslider;?>>
            	<h3><?php esc_html_e('Revolution Slider','veda');?></h3><?php
            	# Check revolution slider active
				if(veda_is_plugin_active('revslider/revslider.php')):
					$sld = new RevSlider();
					$sliders = $sld->getArrSliders();
					if(!empty($sliders)):
						echo '<div class="one-half-content">';
						echo '	<div class="bpanel-option-set">';
						echo ' <div class="column one-sixth">';
						echo '	<label>'.esc_html__('Select Slider','veda').'</label>';
						echo ' 	</div>';
						echo ' <div class="column three-sixth">';
						echo '	<select name="revolutionslider_id" class="dt-chosen-select">';
							echo '		<option value="0">'.esc_html__("Select Slider",'veda').'</option>';
							foreach($sliders as $key => $item):
								$alias = $item->getAlias();
								$title = $item->getTitle();
								$rs = isset($tpl_default_settings['revolutionslider_id']) ? $tpl_default_settings['revolutionslider_id']:'';
								$rs = selected($alias,$rs,false);
								echo "	<option value='{$alias}' {$rs}>{$title}</option>";
							endforeach;
						echo '	</select>';
						echo '<p class="note">'.esc_html__("Choose which Revolution slider would you like to use!",'veda').'</p>';
						echo ' 	</div>';
						echo '	</div>';
						echo '</div>';
					else:
						echo '<p id="j-no-images-container">'.esc_html__('Please add at leat one revolution slider','veda').'</p>';
					endif;
				else:
					echo '<p id="j-no-images-container">'.esc_html__('Please activate Revolution Slider , and add at least one slider.','veda').'</p>';
				endif; ?>
            </div><!-- Revolution Slider End-->

            <!-- Custom Slider Shortcode -->
            <div id="customslider" class="custom-box" <?php echo $customslider;?>>
            	<h3><?php esc_html_e('Custom Slider','veda');?></h3>
                <div class="one-half-content">
                	<div class="bpanel-option-set">
                        <div class="column one-sixth">
                            <label><?php esc_html_e('Shortcode', 'veda'); ?></label>
                        </div>
                        <div class="column three-sixth">
                            <?php $v = array_key_exists("customslider_sc",$tpl_default_settings) ?  $tpl_default_settings['customslider_sc'] : '';?>
                            <textarea rows="3" cols="30" id="dttheme-custom-slider" name="dttheme-custom-slider"><?php echo esc_attr($v);?></textarea>
                            <p class="note"> <?php esc_html_e('Enter your custom slider shortcode.','veda');?> </p>
                        </div>
                    </div>
                </div>
            </div><!-- Custom Slider Shortcode-->
        </div><!-- slier-container ends--><?php
        wp_reset_postdata();
	}

	#Page Meta Box	
	function veda_page_settings($args){
		 
		global $post;
		$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();?>
        
        <div class="j-pagetemplate-container">

            	<div id="tpl-common-settings">

					<!-- 0. Sub Title -->
					<div class="sub-title custom-box">
                        <div class="column one-sixth"><?php esc_html_e( 'Title Background','veda');?></div>
                        <div class="column five-sixth last">
                            <div class="two-third column image-preview-container" style="width:60%;">
                                <?php $subtitlebg = array_key_exists ( 'sub-title-bg', $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg'] : '';?>
                                <input name="sub-title-bg" type="text" class="uploadfield medium" readonly="readonly" value="<?php echo esc_attr($subtitlebg);?>"/>
                                <input type="button" value="<?php esc_attr_e('Upload','veda');?>" class="upload_image_button show_preview" />
                                <input type="button" value="<?php esc_attr_e('Remove','veda');?>" class="upload_image_reset" />
                                <?php if( !empty($subtitlebg) ) veda_adminpanel_image_preview($subtitlebg );?>
                                <p class="note"><?php esc_html_e('Upload an image for the sub title background','veda');?></p>
                            </div>
                            <div class="one-eighth column"></div>
                            <div class="one-third column last">
                                <label><?php esc_html_e('Opacity','veda');?></label>
                                <?php $opacity =  array_key_exists ( "sub-title-opacity", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-opacity'] : ''; ?>
                                <select name="sub-title-opacity">
                                    <option value=""><?php esc_html_e("Select",'veda');?></option>
                                    <?php foreach( array('1','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9') as $option): ?>
                                           <option value="<?php echo esc_attr($option);?>" <?php selected($option,$opacity);?>><?php echo esc_attr($option);?></option>
                                    <?php endforeach;?>
                                </select>
                                <p class="note"><?php esc_html_e('Select background color opacity','veda');?></p>
                            </div>    
                        </div>
                    </div>
    
                    <div class="sub-title custom-box">
                        <div class="column one-sixth"></div>
                        <div class="column five-sixth last">
                            <div class="column one-third">
                                <label><?php esc_html_e('Background Repeat','veda');?></label>
                                <?php $bgrepeat =  array_key_exists ( "sub-title-bg-repeat", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-repeat'] : ''; ?>
                                <div class="clear"></div>
                                <select class="dt-chosen-select" name="sub-title-bg-repeat">
                                    <option value=""><?php esc_html_e("Select",'veda');?></option>
                                    <?php foreach( array('repeat','repeat-x','repeat-y','no-repeat') as $option): ?>
                                           <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgrepeat);?>><?php echo esc_attr($option);?></option>
                                    <?php endforeach;?>
                                </select>
                                <p class="note"><?php esc_html_e('Select background image repeat style','veda');?></p>
                            </div>
    
                            <div class="column one-third">
                                <label><?php esc_html_e('Background Position','veda');?></label>
                                <?php $bgposition =  array_key_exists ( "sub-title-bg-position", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-position'] : ''; ?>
                                <div class="clear"></div>
                                <select class="dt-chosen-select" name="sub-title-bg-position">
                                    <option value=""><?php esc_html_e('Select','veda');?></option>
                                    <?php foreach( array('top left','top center','top right','center left','center center','center right','bottom left','bottom center','bottom right') as $option): ?>
                                        <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgposition);?>> <?php echo esc_attr($option);?></option>
                                    <?php endforeach;?>
                                </select>
                                <p class="note"><?php esc_html_e('Select background image position','veda');?></p>
                            </div>
    
                            <div class="column one-third last">
							<?php $label = 		esc_html__('Background Color','veda');
                                  $name  =		'sub-title-bg-color';
                                  $value =  	array_key_exists ( 'sub-title-bg-color', $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-color'] : '';
                                  $tooltip = 	esc_html__('Select background color for sub title section','veda'); ?>
                                  <label><?php echo esc_html($label);?></label>
	                              <div class="clear"></div>
                                  <?php veda_admin_color_picker("",$name,$value,'');?>
                                  <p class="note"><?php echo $tooltip;?></p>
                            </div>
                        </div>
                    </div><!-- 0. Sub title End-->
                
                    <!-- 1. Layout -->
                    <div id="page-layout" class="custom-box">
                        <div class="column one-sixth"><label><?php esc_html_e('Layout','veda');?> </label></div>
                        <div class="column five-sixth last">
                            <ul class="bpanel-layout-set"><?php 
                                $homepage_layout = array( 'content-full-width'=>'without-sidebar', 'with-left-sidebar'=>'left-sidebar', 'with-right-sidebar'=>'right-sidebar', 'with-both-sidebar'=>'both-sidebar');
                                $v =  array_key_exists("layout",$tpl_default_settings) ?  $tpl_default_settings['layout'] : 'content-full-width';
                                foreach($homepage_layout as $key => $value):
                                    $class = ($key == $v) ? " class='selected' " : "";
                                    echo "<li><a href='#' rel='{$key}' {$class}><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                                endforeach;?>
                            </ul>
                            <input id="dttheme-page-layout" name="layout" type="hidden" value="<?php echo esc_attr($v);?>"/>
                            <p class="note"> <?php esc_html_e("You can choose a perfect layout for your page",'veda');?> </p>
                        </div>
                    </div> <!-- Layout End-->

					<?php
                    $sb_layout = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : 'content-full-width';
                    $sidebar_both = $sidebar_left = $sidebar_right = '';

					if($sb_layout == 'content-full-width') {
						$sidebar_both = 'style="display:none;"'; 
					} elseif($sb_layout == 'with-left-sidebar') {
						$sidebar_right = 'style="display:none;"'; 
					} elseif($sb_layout == 'with-right-sidebar') {
						$sidebar_left = 'style="display:none;"'; 
					}?>
                    <div id="widget-area-options" <?php echo $sidebar_both;?>>
                        <div id="left-sidebar-container" class="page-left-sidebar" <?php echo $sidebar_left; ?>>
                            <!-- 2. Standard Sidebar Left Start -->
                            <div id="page-commom-sidebar" class="sidebar-section custom-box">
                                <div class="column one-sixth"><label><?php esc_html_e('Show Standard Left Sidebar','veda');?></label></div>
                                <div class="column five-sixth last"><?php 
                                    $switchclass = array_key_exists("show-standard-sidebar-left",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                    $checked = array_key_exists("show-standard-sidebar-left",$tpl_default_settings) ? ' checked="checked"' : '';
									if(empty($tpl_default_settings) || array_key_exists("show-standard-sidebar-left",$tpl_default_settings)) {
									  $switchclass = 'checkbox-switch-on'; $checked = ' checked="checked"';
									}?>
                                    <div data-for="dttheme-show-standard-sidebar-left" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                                    <input id="dttheme-show-standard-sidebar-left" class="hidden" type="checkbox" name="show-standard-sidebar-left" value="true" <?php echo $checked;?>/>
                                    <p class="note"> <?php esc_html_e('Yes! to show Standard Left Sidebar','veda');?> </p>
                                 </div>
                            </div><!-- Standard Sidebar Left End-->

                            <!-- 3. Choose Widget Areas Start -->
                            <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
                                <div class="column one-sixth"><label><?php esc_html_e('Choose Widget Area - Left Sidebar','veda');?></label></div>
                                <div class="column five-sixth last"><?php
									$widgetareas = array_key_exists("widget-area-left",$tpl_default_settings) ? array_unique($tpl_default_settings["widget-area-left"]) : array();
									$widgets = veda_option('widgetarea','custom');?>
									<select class="dt-chosen-select" name="dttheme[widgetareas-left][]" multiple="multiple" data-placeholder="<?php esc_attr_e('Select Widget Area', 'veda');?>"><?php
										echo "<option value=''></option>";
										foreach ( $widgets as $widget ) :
											$id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
											$id = str_replace(" ", "-", $id);
											$selected = in_array( $id , $widgetareas ) ? " selected='selected' " : "";
											echo "<option value='{$id}' {$selected}>{$widget}</option>";
										endforeach;?>
									</select>
                                </div>
                            </div><!-- Choose Widget Areas End -->
                        </div>
                        <div id="right-sidebar-container" class="page-right-sidebar" <?php echo $sidebar_right; ?>>
                            <!-- 3. Standard Sidebar Right Start -->
                            <div id="page-commom-sidebar" class="sidebar-section custom-box page-right-sidebar">
                                <div class="column one-sixth"><label><?php esc_html_e('Show Standard Right Sidebar','veda');?></label></div>
                                <div class="column five-sixth last"><?php 
                                    $switchclass = array_key_exists("show-standard-sidebar-right",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                    $checked = array_key_exists("show-standard-sidebar-right",$tpl_default_settings) ? ' checked="checked"' : '';
									if(empty($tpl_default_settings) || array_key_exists("show-standard-sidebar-right",$tpl_default_settings)) {
									  $switchclass = 'checkbox-switch-on'; $checked = ' checked="checked"';
									}?>
                                    <div data-for="dttheme-show-standard-sidebar-right" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                                    <input id="dttheme-show-standard-sidebar-right" class="hidden" type="checkbox" name="show-standard-sidebar-right" value="true" <?php echo $checked;?>/>
                                    <p class="note"> <?php esc_html_e('Yes! to show Standard Right Sidebar','veda');?> </p>
                                 </div>
                            </div><!-- Standard Sidebar Right End-->

                            <!-- 3. Choose Widget Areas Start -->
                            <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
                                <div class="column one-sixth"><label><?php esc_html_e('Choose Widget Area - Right Sidebar','veda');?></label></div>
                                <div class="column five-sixth last"><?php
									$widgetareas = array_key_exists("widget-area-right",$tpl_default_settings) ? array_unique($tpl_default_settings["widget-area-right"]) : array();
									$widgets = veda_option('widgetarea','custom');?>
									<select class="dt-chosen-select" name="dttheme[widgetareas-right][]" multiple="multiple" data-placeholder="<?php esc_attr_e('Select Widget Area', 'veda');?>"><?php
										echo "<option value=''></option>";
										foreach ( $widgets as $widget ) :
											$id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
											$id = str_replace(" ", "-", $id);
											$selected = in_array( $id , $widgetareas ) ? " selected='selected' " : "";
											echo "<option value='{$id}' {$selected}>{$widget}</option>";
										endforeach;?>
									</select>
                                </div>
                            </div><!-- Choose Widget Areas End -->
                        </div>
                    </div>
                 </div><!-- .tpl-common-settings end -->

				<div id="tpl-onepage-settings">
                    <div class="custom-box">
                    	<div class="column one-sixth">
                            <label><?php esc_html_e('Choose Menu','veda');?></label>
                        </div>
                        <div class="column five-sixth last">
                        	<select name="dttheme-onepage-menu" class="dt-chosen-select"><?php
								//GETTING ONEPAGE MENUS...
								$v =  array_key_exists("onepage_menu",$tpl_default_settings) ?  $tpl_default_settings['onepage_menu'] : '';
								$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
								foreach($menus as $m):
									$rs = selected($m->term_id,$v,false);
									echo "<option value='".$m->term_id."' {$rs}>".$m->name."</option>";
								endforeach; ?>
                            </select>
                            <p class="note"> <?php esc_html_e("Select a menu items work as one page. Note: It doesn't work for split menu.",'veda');?> </p>
                        </div>
                    </div>
               </div><!-- tpl-onepage-settings end-->
               
               <!-- Blog Template Settings -->
               <div id="tpl-blog">
                  <!-- Post Playout -->
                  <div class="custom-box">
                      <div class="column one-sixth">                
                          <label><?php esc_html_e('Posts Layout','veda');?> </label>
                      </div>
                      <div class="column five-sixth last">
                          <ul class="dt-bpanel-layout-set">
                          <?php $posts_layout = array(	'one-column'=>	esc_html__("Single post per row.",'veda'),
                                                        'one-half-column'=>	esc_html__("Two posts per row.",'veda'),
														'one-third-column'=>	esc_html__("Three posts per row.",'veda'));
                                  $v = array_key_exists("blog-post-layout",$tpl_default_settings) ?  $tpl_default_settings['blog-post-layout'] : 'one-column';
                                  foreach($posts_layout as $key => $value):
                                      $class = ($key == $v) ? " class='selected' " : "";
                                      echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$key}.png' /></a></li>";
                                  endforeach;?>
                          </ul>
                          <input id="dttheme-blog-post-layout" name="dttheme-blog-post-layout" type="hidden" value="<?php echo esc_attr($v);?>"/>
                          <p class="note"> <?php esc_html_e("You can choose perfect column style for your blog posts",'veda');?> </p>
                      </div>
                  </div><!-- Post Playout End-->

                  <!-- Post Style-->
                  <div class="custom-box">
                      <div class="column one-sixth"> 
                          <label><?php esc_html_e('Post Style','veda');?></label>
                      </div>
                      <div class="column five-sixth last"> 
                          <select name="dttheme-blog-post-style" class="dt-chosen-select">
                              <?php $selected = 	array_key_exists("blog-post-style",$tpl_default_settings) ?  $tpl_default_settings['blog-post-style'] : ''; ?>
                              <?php	$blog_styles =  array( 
                                        '' => esc_html__('Default','veda'),
                                        'entry-date-left' => esc_html__('Date Left','veda'),
                                        'entry-date-author-left' => esc_html__('Date and Author Left','veda'),
                                        'blog-medium-style'=>esc_html__('Medium','veda'),
                                        'blog-medium-style dt-blog-medium-highlight'=>esc_html__('Medium Highlight','veda'),
                                        'blog-medium-style dt-blog-medium-highlight dt-sc-skin-highlight' => esc_html__('Medium Skin Highlight','veda')
                                    );
									foreach( $blog_styles as $bs => $bv ):
										echo "<option value='{$bs}'".selected($selected,$bs,false).">{$bv}</option>";
									endforeach;?>
                          </select>
                          <p class="note"> <?php esc_html_e("Select a style to show blog post",'veda');?> </p>
                      </div>
                  </div><!-- Post Style End-->


                  <!-- Enable Readmore button -->
                  <div class="custom-box">
                      <div class="column one-sixth">
                          <label><?php esc_html_e('Enable Readmore','veda');?></label>
                      </div>
                      <div class="column five-sixth last">                     
                          <?php $switchclass = array_key_exists("enable-blog-readmore",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                $checked = array_key_exists("enable-blog-readmore",$tpl_default_settings) ? ' checked="checked"' : '';?>
                          <div data-for="dttheme-enable-blog-readmore" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input id="dttheme-enable-blog-readmore" class="hidden" type="checkbox" name="dttheme-enable-blog-readmore" value="true" <?php echo $checked;?>/>
                          <p class="note"> <?php esc_html_e('YES! to enable read more button','veda');?> </p>
                      </div>
                  </div><!-- Enable Readmore button End-->
                  

                  <!-- Readmore Style-->
                  <div class="custom-box">
                      <div class="column one-sixth"> 
                          <label><?php esc_html_e('Read More Button','veda');?></label>
                      </div>
                      <div class="column five-sixth last">
							<?php $v = array_key_exists("blog-readmore",$tpl_default_settings) ?  $tpl_default_settings['blog-readmore'] : '[dt_sc_button title="Read More" style="filled" icon_type="fontawesome" iconalign="icon-right with-icon" iconclass="fa fa-long-arrow-right" class="type1" /]';?>
                            <textarea rows="1" cols="100%" id="dttheme-blog-readmore" name="dttheme-blog-readmore"><?php echo esc_attr($v);?></textarea>
                          <p class="note"> <?php esc_html_e("Enter button shortcode",'veda');?> </p>
                      </div>
                  </div><!-- Readmore Style End-->

                  <!-- Allow Excerpt -->
                  <div class="custom-box">
                      <div class="column one-sixth">
                          <label><?php esc_html_e('Allow Excerpt','veda');?></label>
                      </div>
                      <div class="column five-sixth last">                     
                          <?php $switchclass = array_key_exists("blog-post-excerpt",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                $checked = array_key_exists("blog-post-excerpt",$tpl_default_settings) ? ' checked="checked"' : '';?>
                          <div data-for="dttheme-blog-post-excerpt" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input id="dttheme-blog-post-excerpt" class="hidden" type="checkbox" name="dttheme-blog-post-excerpt" value="true" <?php echo $checked;?>/>
                          <p class="note"> <?php esc_html_e('YES! to enable excerpt','veda');?> </p>
                      </div>
                  </div><!-- Allow Excerpt End-->
  
                  <!-- Excerpt Length-->
                  <div class="custom-box">
                      <div class="column one-sixth">
                          <label><?php esc_html_e('Excerpt Length','veda');?></label>
                      </div>
                      <div class="column five-sixth last">
                          <?php $v = array_key_exists("blog-post-excerpt-length",$tpl_default_settings) ?  $tpl_default_settings['blog-post-excerpt-length'] : '45';?>
                          <input id="dttheme-blog-post-excerpt-length" name="dttheme-blog-post-excerpt-length" type="text" value="<?php echo esc_attr($v);?>" />
                          <p class="note"> <?php esc_html_e("Limit! Number of characters from the content to appear on each blog post (Number Only)",'veda');?> </p>
                      </div>
                  </div><!-- Excerpt Length End-->
  
                  <!-- Post Count-->
                  <div class="custom-box">
                      <div class="column one-sixth"> 
                          <label><?php esc_html_e('Post per page','veda');?></label>
                      </div>
                      <div class="column five-sixth last"> 
                          <select name="dttheme-blog-post-per-page" class="dt-chosen-select">
                              <option value="-1"><?php esc_html_e("All",'veda');?></option>
                              <?php $selected = 	array_key_exists("blog-post-per-page",$tpl_default_settings) ?  $tpl_default_settings['blog-post-per-page'] : ''; ?>
                              <?php for($i=1;$i<=30;$i++):
                                  echo "<option value='{$i}'".selected($selected,$i,false).">{$i}</option>";
                                  endfor;?>
                          </select>
                          <p class="note"> <?php esc_html_e("Select number of posts per page.",'veda');?> </p>
                      </div>
                  </div><!-- Post Count End-->
                  
                  <!-- Categories -->
                  <div class="custom-box">
                      <div class="column one-sixth">
                          <label><?php esc_html_e('Choose Categories','veda');?></label>
                      </div>
                      <div class="column five-sixth last"><?php
						  $blog_post_cats = array_key_exists("blog-post-cats",$tpl_default_settings) ? array_unique($tpl_default_settings["blog-post-cats"]) : array();
						  $cats = get_categories ( 'orderby=name&hide_empty=0' );?>
						  <select class="dt-chosen-select" name="dttheme[blog][cats][]" multiple="multiple" data-placeholder="<?php esc_attr_e('Select Categories', 'veda');?>"><?php
							  echo "<option value=''></option>";
							  foreach ( $cats as $cat ) :
								  $id = esc_attr ( $cat->term_id );
								  $title = esc_html ( $cat->name );
								  $selected = in_array( $id , $blog_post_cats ) ? " selected='selected' " : "";
								  echo "<option value='{$id}' {$selected}>{$title}</option>";
							  endforeach;?>                        	
						  </select>
						  <p class="note"> <?php esc_html_e("Select categories to exclude from your blog page.",'veda');?> </p>
                      </div>
                  </div><!-- Categories End-->

                <!-- Post Meta-->
                <div class="custom-box">
	                <h3><?php esc_html_e('Post Meta Options','veda');?></h3>
                	<?php $post_meta = array(
							array(
								"id"=>		"show-postformat-info",
								"label"=>	esc_html__("Show the post format info.",'veda'),
								"tooltip"=>	esc_html__("By default the post format info will display when viewing your posts. You can easily disable it here.",'veda')
							), array(
								"id"=>		"show-author-info",
								"label"=>	esc_html__("Show the Author info.",'veda'),
								"tooltip"=>	esc_html__("By default the author info will display when viewing your posts. You can easily disable it here.",'veda')
							), array(
								"id"=>		"show-date-info",
								"label"=>	esc_html__("Show the date info.",'veda'),
								"tooltip"=>	esc_html__("By default the date info will display when viewing your posts. You can easily disable it here.",'veda')
							),
							array(
								"id"=>		"show-comment-info",
								"label"=>	esc_html__("Show the comment",'veda'),
								"tooltip"=>	esc_html__("By default the comment will display when viewing your posts. You can easily disable it here.",'veda')
							),
							array(
								"id"=>		"show-category-info",
								"label"=>	esc_html__("Show the category",'veda'),
								"tooltip"=>	esc_html__("By default the category will display when viewing your posts. You can easily disable it here.",'veda')
							),
							array(
								"id"=>		"show-tag-info",
								"label"=>	esc_html__("Show the tag",'veda'),
								"tooltip"=>	esc_html__("By default the tag will display when viewing your posts. You can easily disable it here.",'veda')
							));
						$count = 1;
						foreach($post_meta as $p_meta):
							$last = ($count%3 == 0)?"last":'';
							$id = 		$p_meta['id'];
							$label =	$p_meta['label'];
							$tooltip =  $p_meta['tooltip'];
							$v =  array_key_exists($id,$tpl_default_settings) ?  $tpl_default_settings[$id] : '';
							$rs =		checked($id,$v,false);
						 	$switchclass = ($v <> '') ? 'checkbox-switch-on' :'checkbox-switch-off';
							if(empty($tpl_default_settings)) {
								$switchclass = 'checkbox-switch-on'; $rs = ' checked="checked"';
							}

							echo "<div class='one-third-content {$last}'>";
							echo '<div class="bpanel-option-set">';
							echo "<label>{$label}</label>";							
							echo "<div data-for='{$id}' class='checkbox-switch {$switchclass}'></div>";
							echo "<input class='hidden' id='{$id}' type='checkbox' name='dttheme-blog-{$id}' value='{$id}' {$rs} />";
							echo '<p class="note">';
							echo ($tooltip);
							echo '</p>';
							echo '</div>';
							echo '</div>';
							
						$count++;	
						endforeach;?>
                </div><!-- Post Meta End-->
                  
               </div><!-- Blog Template Settings End-->
  
               <!-- Portfolio Template Settings -->
               <div id="tpl-portfolio">
               
                  <!-- Post Playout -->
                  <div class="custom-box">
                      <div class="column one-sixth">                 
                          <label><?php esc_html_e('Posts Layout','veda');?> </label>
                      </div>
                      <div class="column five-sixth last">
                          <ul class="dt-bpanel-layout-set">
                          <?php $posts_layout = array(	'one-half-column'=>	esc_html__("Two posts per row.",'veda'),
                                    'one-third-column'=>	esc_html__("Three posts per row.",'veda'),
                                    'one-fourth-column' => esc_html__("Four Posts per row",'veda'));
                                $v = array_key_exists("portfolio-post-layout",$tpl_default_settings) ?  $tpl_default_settings['portfolio-post-layout'] : 'one-half-column';
                                foreach($posts_layout as $key => $value):
                                    $class = ($key == $v) ? " class='selected' " : "";
                                    echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$key}.png' /></a></li>";
                                endforeach;?>
                          </ul>
                          <input id="dttheme-portfolio-post-layout" name="dttheme-portfolio-post-layout" type="hidden" value="<?php echo esc_attr($v);?>"/>
                          <p class="note"> <?php esc_html_e("You can choose perfect column style for your portfolio items",'veda');?> </p>
                      </div>      
  
                  </div><!-- Post Playout End-->

                  <!-- Post Style-->
                  <div class="custom-box">
                      <div class="column one-sixth"> 
                          <label><?php esc_html_e('Post Style','veda');?></label>
                      </div>
                      <div class="column five-sixth last"> 
                          <select name="dttheme-portfolio-post-style" class="dt-chosen-select">
                              <?php $selected = 	array_key_exists("portfolio-post-style",$tpl_default_settings) ?  $tpl_default_settings['portfolio-post-style'] : ''; ?>
                              <?php	$portfolio_styles =  array( 'type1' => esc_html__('Type 1','veda'), 'type2' => esc_html__('Type 2','veda'), 'type3' => esc_html__('Type 3','veda'),
							  								'type4' => esc_html__('Type 4','veda'), 'type5' => esc_html__('Type 5','veda'), 'type6' => esc_html__('Type 6','veda'),
															'type7' => esc_html__('Type 7','veda'), 'type8' => esc_html__('Type 8','veda'), 'type9' => esc_html__('Type 9','veda'));
									foreach( $portfolio_styles as $bs => $bv ):
										echo "<option value='{$bs}'".selected($selected,$bs,false).">{$bv}</option>";
									endforeach;?>
                          </select>
                          <p class="note"> <?php esc_html_e("Select a style to show portfolio item",'veda');?> </p>
                      </div>
                  </div><!-- Post Style End-->
                  
                  <!-- Allow Grid Space -->
                  <div class="custom-box">
                      <div class="column one-sixth">                
                          <label><?php esc_html_e('Allow Grid Space','veda');?></label>
                      </div>
                      <div class="column five-sixth last">
                          <?php $switchclass = array_key_exists("portfolio-grid-space",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                $checked = array_key_exists("portfolio-grid-space",$tpl_default_settings) ? ' checked="checked"' : '';?>
                          <div data-for="dttheme-portfolio-grid-space" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input id="dttheme-portfolio-grid-space" class="hidden" type="checkbox" name="dttheme-portfolio-grid-space" value="true" <?php echo $checked;?>/>
                          <p class="note"> <?php esc_html_e('YES! to allow grid space in between portfolio item','veda');?> </p>
                      </div>
                  </div><!-- Allow Grid Space -->
                  
                  <!-- Allow Filters -->  
                  <div class="custom-box">
                      <div class="column one-sixth">                
                          <label><?php esc_html_e('Allow Filters','veda');?></label>
                      </div>
                      <div class="column five-sixth last">                       
                          <?php $switchclass = array_key_exists("filter",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                $checked = array_key_exists("filter",$tpl_default_settings) ? ' checked="checked"' : '';?>
                          <div data-for="dttheme-portfolio-filter" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input id="dttheme-portfolio-filter" class="hidden" type="checkbox" name="dttheme-portfolio-filter" value="true" <?php echo $checked;?>/>
                          <p class="note"> <?php esc_html_e('YES! to allow filter options for portfolio items','veda');?> </p>
                      </div>
                  </div><!-- Allow Filters -->
                  
                  <!-- Allow Full Width -->
                  <div class="custom-box">
                      <div class="column one-sixth">                
                          <label><?php esc_html_e('Allow Full Width','veda');?></label>
                      </div>
                      <div class="column five-sixth last">
                          <?php $switchclass = array_key_exists("portfolio-fullwidth",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                $checked = array_key_exists("portfolio-fullwidth",$tpl_default_settings) ? ' checked="checked"' : '';?>
                          <div data-for="dttheme-portfolio-fullwidth" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input id="dttheme-portfolio-fullwidth" class="hidden" type="checkbox" name="dttheme-portfolio-fullwidth" value="true" <?php echo $checked;?>/>
                          <p class="note"> <?php esc_html_e('YES! to allow Full Width portfolio layout','veda');?> </p>
                      </div>
                  </div><!-- Allow Full Width -->

                  <!-- Post Count-->
                  <div class="custom-box">
                      <div class="column one-sixth">
                          <label><?php esc_html_e('Post per page','veda');?></label>
                      </div>
                      <div class="column five-sixth last">   
                          <select name="dttheme-portfolio-post-per-page" class="dt-chosen-select">
                              <option value="-1"><?php esc_html_e("All",'veda');?></option>
                              <?php $selected = 	array_key_exists("portfolio-post-per-page",$tpl_default_settings) ?  $tpl_default_settings['portfolio-post-per-page'] : ''; ?>
                              <?php for($i=1;$i<=30;$i++):
                                  echo "<option value='{$i}'".selected($selected,$i,false).">{$i}</option>";
                                  endfor;?>
                          </select>
                          <p class="note"> <?php esc_html_e("Select number of posts per page.",'veda');?> </p>
                      </div>
                  </div><!-- Post Count End-->

                  <!-- Categories -->
                  <div class="custom-box">
                      <div class="column one-sixth">
                          <label><?php esc_html_e('Choose Categories','veda');?></label>
                      </div>
                      <div class="column five-sixth last"><?php
						  $portfolio_cats = array_key_exists("portfolio-categories",$tpl_default_settings) ? array_unique($tpl_default_settings["portfolio-categories"]) : array();
						  $cats = get_categories ( 'taxonomy=portfolio_entries&hide_empty=0' );?>
						  <select class="dt-chosen-select" name="dttheme[portfolio][cats][]" multiple="multiple" data-placeholder="<?php esc_attr_e('Select Categories', 'veda');?>"><?php
							  echo "<option value=''></option>";
							  foreach ( $cats as $cat ) :
								  $id = esc_attr ( $cat->term_id );
								  $title = esc_html ( $cat->name );
								  $selected = in_array( $id , $portfolio_cats ) ? " selected='selected' " : "";
								  echo "<option value='{$id}' {$selected}>{$title}</option>";
							  endforeach;?>                        	
						  </select>
						  <p class="note"> <?php esc_html_e("Select categories to show in portfolio items.",'veda');?> </p>
                      </div>
                  </div><!-- Categories End-->                
             </div><!-- Portfolio Template Settings End-->
        </div><?php
        wp_reset_postdata();
   } 
   
	function veda_page_meta_save($post_id){

		if( key_exists ( '_inline_edit',$_POST )) :
			if ( wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) return;
		endif;

		if( key_exists( 'dt_theme_page_meta_nonce',$_POST ) ) :
			if ( ! wp_verify_nonce( $_POST['dt_theme_page_meta_nonce'], basename(__FILE__) ) ) return;
		endif;
	 
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if (!current_user_can('edit_page', $post_id)) :
			return;
		endif;

		if ( (key_exists('post_type', $_POST)) && ('page' == $_POST['post_type']) ) :

			$layout 	  = isset($_POST['layout'])		   ? 	$_POST['layout'] 		:	 "";
			$pagetemplate = isset($_POST["page_template"]) ? 	$_POST["page_template"] : 	 "";
	
			$settings = array();
			$settings['layout'] = $layout;
			
			$settings['sub-title-bg'] = isset ( $_POST['sub-title-bg'] ) ? $_POST['sub-title-bg'] : "";
			$settings['sub-title-bg-repeat'] = isset ( $_POST['sub-title-bg-repeat'] ) ? $_POST['sub-title-bg-repeat'] : "";
			$settings['sub-title-opacity'] = isset ( $_POST['sub-title-opacity'] ) ? $_POST['sub-title-opacity'] : "";
			$settings['sub-title-bg-position'] = isset ( $_POST['sub-title-bg-position'] ) ? $_POST['sub-title-bg-position'] : "";
			$settings['sub-title-bg-color'] = isset ( $_POST['sub-title-bg-color'] ) ? $_POST['sub-title-bg-color'] : "";
	
			if( $layout == 'with-both-sidebar') {
				$settings['show-standard-sidebar-left'] = isset ( $_POST['show-standard-sidebar-left'] ) ? $_POST['show-standard-sidebar-left'] : "";
				$settings['show-standard-sidebar-right'] = isset ($_POST['show-standard-sidebar-right'] ) ? $_POST['show-standard-sidebar-right']: "";
	
				$settings['widget-area-left'] =  isset($_POST['dttheme']['widgetareas-left'] ) ? array_unique(array_filter($_POST['dttheme']['widgetareas-left'])) :'';
				$settings['widget-area-right'] = isset( $_POST['dttheme']['widgetareas-right'] ) ? array_unique(array_filter($_POST['dttheme']['widgetareas-right'])) : '';
			} elseif( $layout == 'with-left-sidebar') {
				$settings['show-standard-sidebar-left'] = isset ( $_POST['show-standard-sidebar-left'] ) ? $_POST['show-standard-sidebar-left'] : "";
				$settings['widget-area-left'] =  isset($_POST['dttheme']['widgetareas-left']) ? array_unique(array_filter($_POST['dttheme']['widgetareas-left'])) : "";
			} elseif( $layout == 'with-right-sidebar') {
				$settings['show-standard-sidebar-right'] = isset ( $_POST['show-standard-sidebar-right'] ) ? $_POST['show-standard-sidebar-right'] : "";
				$settings['widget-area-right'] = isset($_POST['dttheme']['widgetareas-right']) ? array_unique(array_filter($_POST['dttheme']['widgetareas-right'])) : "";
			} 
	
			if( "tpl-blog.php" == $pagetemplate ):
				$settings['blog-post-layout'] = isset ( $_POST['dttheme-blog-post-layout'] ) ? $_POST['dttheme-blog-post-layout'] : "";
				$settings['blog-post-per-page'] = isset ( $_POST['dttheme-blog-post-per-page'] ) ? $_POST['dttheme-blog-post-per-page'] : "";
				$settings['blog-post-style'] = isset ( $_POST['dttheme-blog-post-style'] ) ? $_POST['dttheme-blog-post-style'] : "";
				$settings['enable-blog-readmore'] = isset ( $_POST['dttheme-enable-blog-readmore'] ) ? $_POST['dttheme-enable-blog-readmore'] : "";			
				$settings['blog-readmore'] = isset( $_POST['dttheme-blog-readmore'] ) ? $_POST['dttheme-blog-readmore'] : '';			
				$settings['blog-post-excerpt'] = isset ( $_POST['dttheme-blog-post-excerpt'] ) ? $_POST['dttheme-blog-post-excerpt'] : "";
				$settings['blog-post-excerpt-length'] = isset ( $_POST['dttheme-blog-post-excerpt-length'] ) ? $_POST['dttheme-blog-post-excerpt-length'] : "";
				$settings['blog-post-cats'] = isset ( $_POST['dttheme']['blog']['cats'] ) ? $_POST['dttheme']['blog']['cats'] : "";
				
				$settings['show-date-info'] = isset( $_POST['dttheme-blog-show-date-info'] ) ? $_POST['dttheme-blog-show-date-info'] : "";
				$settings['show-author-info'] = isset( $_POST['dttheme-blog-show-author-info'] ) ? $_POST['dttheme-blog-show-author-info'] : "";
				$settings['show-comment-info'] = isset( $_POST['dttheme-blog-show-comment-info'] ) ? $_POST['dttheme-blog-show-comment-info'] : "";
				$settings['show-category-info'] = isset($_POST['dttheme-blog-show-category-info']  ) ? $_POST['dttheme-blog-show-category-info'] : "";
				$settings['show-tag-info'] = isset( $_POST['dttheme-blog-show-tag-info'] ) ? $_POST['dttheme-blog-show-tag-info'] : "";
				$settings['show-postformat-info'] = isset( $_POST['dttheme-blog-show-postformat-info'] ) ? $_POST['dttheme-blog-show-postformat-info'] : '';

			elseif( "tpl-portfolio.php" == $pagetemplate ):
				$settings['portfolio-post-layout'] = isset ( $_POST['dttheme-portfolio-post-layout'] ) ? $_POST['dttheme-portfolio-post-layout'] : "";
				$settings['portfolio-post-style'] = isset ( $_POST['dttheme-portfolio-post-style'] ) ? $_POST['dttheme-portfolio-post-style'] : "";
				$settings['portfolio-post-per-page'] = isset ( $_POST['dttheme-portfolio-post-per-page'] ) ? $_POST['dttheme-portfolio-post-per-page'] : "";
				$settings['filter'] = isset ( $_POST['dttheme-portfolio-filter'] ) ? $_POST['dttheme-portfolio-filter'] : "";
				$settings['portfolio-categories'] = isset ( $_POST['dttheme']['portfolio']['cats'] ) ? $_POST['dttheme']['portfolio']['cats'] : "";
				$settings['portfolio-fullwidth'] = isset ( $_POST['dttheme-portfolio-fullwidth'] ) ? $_POST['dttheme-portfolio-fullwidth'] : "";
				$settings['portfolio-grid-space'] = isset ( $_POST['dttheme-portfolio-grid-space'] ) ? $_POST['dttheme-portfolio-grid-space'] : "";

			else:
				$settings['onepage_menu'] = isset ( $_POST['dttheme-onepage-menu'] ) ? $_POST['dttheme-onepage-menu'] : "";			
				$settings['show_slider'] =  isset ( $_POST['dttheme-show-slider'] ) ? $_POST['dttheme-show-slider'] : "";
				$settings['slider_type'] = isset ( $_POST['dttheme-slider-type'] ) ? $_POST['dttheme-slider-type'] : "";
				$settings['layerslider_id'] = isset ( $_POST['layerslider_id'] ) ? $_POST['layerslider_id'] : "";
				$settings['revolutionslider_id'] = isset ( $_POST['revolutionslider_id'] ) ? $_POST['revolutionslider_id'] : "";
				$settings['customslider_sc'] = isset ( $_POST['dttheme-custom-slider'] ) ? $_POST['dttheme-custom-slider'] : "";

			endif;

			update_post_meta($post_id, "_tpl_default_settings", array_filter($settings));
		endif;			
	}?>