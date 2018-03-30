<?php add_action("admin_init", "page_metabox");?>
<?php function page_metabox(){
			add_meta_box("page-template-slider-meta-container", __('Slider Options','iamd_text_domain'), "page_sllider_settings", "page", "normal", "default");	
			add_meta_box("page-template-meta-container", __('Default page Options','iamd_text_domain'), "page_settings", "page", "normal", "default");
			add_action('save_post','page_meta_save');
	}

	#Slider Meta Box
	function page_sllider_settings($args){
		global $post;
		$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();?>

		<!-- Show Slider -->
        <div class="custom-box">
        	<div class="column one-sixth">
                <label><?php _e('Show Slider','iamd_text_domain');?> </label>
            </div>
            <div class="column four-sixth last">
				<?php $switchclass = array_key_exists("show_slider",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                      $checked = array_key_exists("show_slider",$tpl_default_settings) ? ' checked="checked"' : '';?>
                <div data-for="mytheme-show-slider" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-show-slider" class="hidden" type="checkbox" name="mytheme-show-slider" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('YES! to show slider on this page.','iamd_text_domain');?> </p>
            </div>
        </div><!-- Show Slider End-->

        <!-- Slider Types -->
        <div class="custom-box">
        	<div class="column one-sixth">
                <label><?php _e('Choose Slider','iamd_text_domain');?></label>
            </div>
            <div class="column four-sixth last">
	            <?php $slider_types = array( '' => __("Select",'iamd_text_domain'),
											 'layerslider' => __("Layer Slider",'iamd_text_domain'),
											 'revolutionslider' => __("Revolution Responsive",'iamd_text_domain'));
											 
	 				  $v =  array_key_exists("slider_type",$tpl_default_settings) ?  $tpl_default_settings['slider_type'] : '';
					  
					  echo "<select class='slider-type' name='mytheme-slider-type'>";
					  foreach($slider_types as $key => $value):
					  	$rs = selected($key,$v,false);
						echo "<option value='{$key}' {$rs}>{$value}</option>";
					  endforeach;
	 				 echo "</select>";?>
            <p class="note"> <?php _e("Choose which slider you wish to use ( eg: Layer or Revolution )",'iamd_text_domain');?> </p>
            </div>
        </div><!-- Slider Types End-->
        
        <!-- slier-container starts-->
    	<div id="slider-conainer">
        <?php $layerslider = $revolutionslider = 'style="display:none"';
			  if(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "layerslider"):
			  	$layerslider = 'style="display:block"';
			  elseif(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "revolutionslider"):
			  	$revolutionslider = 'style="display:block"';
			  endif; ?>
          
              <!-- Layered Slider -->
              <div id="layerslider" class="custom-box" <?php echo $layerslider;?>>
              	<h3><?php _e('Layer Slider','iamd_text_domain');?></h3>
                <?php if(dt_theme_is_plugin_active('LayerSlider/layerslider.php')):?>
                <?php // Get WPDB Object
					  global $wpdb;
					  // Table name
					  $table_name = $wpdb->prefix . "layerslider";
					  // Get sliders
					  $sliders = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE flag_hidden = 0 AND flag_deleted = 0 ORDER BY date_c ASC LIMIT 100", ARRAY_A ) );
					  
					  if($sliders != null && !empty($sliders)):
		 	                echo '<div class="one-half-content">';
							echo '	<div class="bpanel-option-set">';
							echo ' <div class="column one-sixth">';
                            echo '	<label>'.__('Select LayerSlider','iamd_text_domain').'</label>';
							echo ' 	</div>';
							echo ' <div class="column two-sixth">';
                            echo '	<select name="layerslider_id">';
                            echo '		<option value="0">'.__("Select Slider",'iamd_text_domain').'</option>';
									  	foreach($sliders as $item) :
											$name = empty($item->name) ? 'Unnamed' : $item->name;
											$id = $item->id;
											$rs = isset($tpl_default_settings['layerslider_id']) ? $tpl_default_settings['layerslider_id']:'';
											$rs = selected($id,$rs,false);
											echo "	<option value='{$id}' {$rs}>{$name}</option>";
										endforeach;
                            echo '	</select>';
                            echo '<p class="note">';
							_e("Choose Which LayerSlider you would like to use..",'iamd_text_domain');
							echo "</p>";
							echo ' 	</div>';
							echo '	</div>';
                            echo '</div>';
					  else:
					     echo '<p id="j-no-images-container">'.__('Please add atleat one layer slider','iamd_text_domain').'</p>';
					  endif;?>
                      
					<?php $layersliders = get_option('layerslider-slides');
                        if($layersliders):
                            $layersliders = is_array($layersliders) ? $layersliders : unserialize($layersliders);	
                            foreach($layersliders as $key => $val):
                                $layersliders_array[$key+1] = 'LayerSlider #'.($key+1);
                            endforeach;
                            echo '<div class="one-half-content">';
							echo '	<div class="bpanel-option-set">';
							echo ' <div class="column one-sixth">';
                            echo '	<label>'.__('Select LayerSlider','iamd_text_domain').'</label>';
                            echo '</div>';
							echo ' <div class="column two-sixth">';
                            echo '	<select name="layerslider_id">';
                            echo '		<option value="0">'.__("Select Slider",'iamd_text_domain').'</option>';
                            foreach($layersliders_array as $key => $value):
                                $rs = isset($tpl_default_settings['layerslider_id']) ? $tpl_default_settings['layerslider_id']:'';
                                $rs = selected($key,$rs,false);
                                echo "	<option value='{$key}' {$rs}>{$value}</option>";
                            endforeach;
                            echo '	</select>';
                            echo '<p class="note">';
							_e("Choose which LayerSlider would you like to use!",'iamd_text_domain');
							echo "</p>";
                            echo '</div>';
							echo '	</div>';
                            echo '</div>';
                        endif;
					  else:?>
                      <p id="j-no-images-container"><?php _e('Please activate Layered Slider','iamd_text_domain'); ?></p>
               <?php endif;?>         
                
              </div><!-- Layered Slider End-->

              <!-- Revolution Slider -->
              <div id="revolutionslider" class="custom-box" <?php echo $revolutionslider;?>>
	            <h3><?php _e('Revolution Slider','iamd_text_domain');?></h3>
                <?php $return = check_slider_revolution_responsive_wordpress_plugin();
					  if($return):
                        echo '<div class="one-half-content">';
						echo '	<div class="bpanel-option-set">';
						echo ' <div class="column one-sixth">';
						echo '	<label>'.__('Select Slider','iamd_text_domain').'</label>';
						echo '</div>';
						echo ' <div class="column three-sixth">';
						echo '	<select name="revolutionslider_id">';
						echo '		<option value="0">'.__("Select Slider",'iamd_text_domain').'</option>';
						foreach($return as $key => $value):
							$rs = isset($tpl_default_settings['revolutionslider_id']) ? $tpl_default_settings['revolutionslider_id']:'';
							$rs = selected($key,$rs,false);
							echo "	<option value='{$key}' {$rs}>{$value}</option>";
						endforeach;
						echo '</select>';
						echo '<p class="note">';
						_e("Choose which Revolution slider would you like to use!",'iamd_text_domain');
						echo "</p>";
						echo '</div>';
						echo '	</div>';
						echo '</div>';
                	  else: ?>
	                	<p id="j-no-images-container"><?php _e('Please activate Revolution Slider , and add at least one slider.','iamd_text_domain'); ?></p>
                <?php endif;?>
              </div><!-- Revolution Slider End-->
        </div><!-- slier-container ends-->

<?php  wp_reset_postdata();
	}

	#Page Meta Box	
	function page_settings($args){
		 
		global $post;
		$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();?>
        
        <div class="j-pagetemplate-container">

            	<div id="tpl-common-settings">
                
                    <!-- 1. Layout -->
                    <div id="page-layout" class="custom-box">
                        <div class="column one-sixth"><label><?php _e('Layout','iamd_text_domain');?> </label></div>
                        <div class="column five-sixth last">
                            <ul class="bpanel-layout-set"><?php 
                                $homepage_layout = array(
                                    'content-full-width'=>'without-sidebar',
                                    'with-left-sidebar'=>'left-sidebar',
                                    'with-right-sidebar'=>'right-sidebar',
                                    'with-both-sidebar'=>'both-sidebar');
                                
                                    $v =  array_key_exists("layout",$tpl_default_settings) ?  $tpl_default_settings['layout'] : 'content-full-width';
                                
                                foreach($homepage_layout as $key => $value):
                                    $class = ($key == $v) ? " class='selected' " : "";
                                    echo "<li><a href='#' rel='{$key}' {$class}><img src='".IAMD_FW_URL."theme_options/images/columns/{$value}.png' /></a></li>";
                                endforeach;?></ul>
    
                             <input id="mytheme-page-layout" name="layout" type="hidden"  value="<?php echo $v;?>"/>
                             <p class="note"> <?php _e("You can choose between a left, right or no sidebar layout.",'iamd_text_domain');?> </p>
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
                     } 
                    ?>
                    <div id="widget-area-options" <?php echo $sidebar_both;?>>
                        <div id="left-sidebar-container" class="page-left-sidebar" <?php echo $sidebar_left; ?>>
                            <!-- 2. Every Where Sidebar Left Start -->
                            <div id="page-commom-sidebar" class="sidebar-section custom-box">
                                <div class="column one-sixth"><label><?php _e('Disable Standard Left Sidebar','iamd_text_domain');?></label></div>
                                <div class="column five-sixth last"><?php 
                                    $switchclass = array_key_exists("disable-everywhere-sidebar-left",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                    $checked = array_key_exists("disable-everywhere-sidebar-left",$tpl_default_settings) ? ' checked="checked"' : '';?>
                                    
                                    <div data-for="mytheme-disable-everywhere-sidebar-left" class="checkbox-switch <?php echo $switchclass;?>"></div>
                                    <input id="mytheme-disable-everywhere-sidebar-left" class="hidden" type="checkbox" name="disable-everywhere-sidebar-left" value="true"  <?php echo $checked;?>/>
                                    <p class="note"> <?php _e('Yes! to hide "Standard Left Sidebar" on this page.','iamd_text_domain');?> </p>
                                 </div>
                            </div><!-- Every Where Sidebar Left End-->
        
                            <!-- 3. Choose Widget Areas Start -->
                            <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
                                <div class="column one-sixth"><label><?php _e('Choose Widget Area - Left Sidebar','iamd_text_domain');?></label></div>
                                <div class="column five-sixth last"><?php
                                    if( array_key_exists('widget-area-left', $tpl_default_settings)):
                                        $widgetareas =  array_unique($tpl_default_settings["widget-area-left"]);
                                        $widgetareas = array_filter($widgetareas);
                                        foreach( $widgetareas as $widgetarea ){
                                            echo '<div class="multidropdown">';
                                            echo dt_theme_custom_widgetarea_list("widgetareas-left",$widgetarea,"multidropdown","left-sidebar");
                                            echo '</div>';
                                        }
                                        echo '<div class="multidropdown">';
                                            echo dt_theme_custom_widgetarea_list("widgetareas-left","","multidropdown","left-sidebar");
                                        echo '</div>';                                
                                    else:
                                        echo '<div class="multidropdown">';
                                           echo dt_theme_custom_widgetarea_list("widgetareas-left","","multidropdown","left-sidebar");
                                        echo '</div>';                                
                                    endif;?>
                                </div>
                            </div><!-- Choose Widget Areas End -->
                        </div>
                        <div id="right-sidebar-container" class="page-right-sidebar" <?php echo $sidebar_right; ?>>
                            <!-- 3. Every Where Sidebar Right Start -->
                            <div id="page-commom-sidebar" class="sidebar-section custom-box page-right-sidebar">
                                <div class="column one-sixth"><label><?php _e('Disable Standard Right Sidebar','iamd_text_domain');?></label></div>
                                <div class="column five-sixth last"><?php 
                                    $switchclass = array_key_exists("disable-everywhere-sidebar-right",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                    $checked = array_key_exists("disable-everywhere-sidebar-right",$tpl_default_settings) ? ' checked="checked"' : '';?>
                                    
                                    <div data-for="mytheme-disable-everywhere-sidebar-right" class="checkbox-switch <?php echo $switchclass;?>"></div>
                                    <input id="mytheme-disable-everywhere-sidebar-right" class="hidden" type="checkbox" name="disable-everywhere-sidebar-right" value="true"  <?php echo $checked;?>/>
                                    <p class="note"> <?php _e('Yes! to hide "Standard Right Sidebar" on this page.','iamd_text_domain');?> </p>
                                 </div>
                            </div><!-- Every Where Sidebar Right End-->

                            <!-- 3. Choose Widget Areas Start -->
                            <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
                                <div class="column one-sixth"><label><?php _e('Choose Widget Area - Right Sidebar','iamd_text_domain');?></label></div>
                                <div class="column five-sixth last"><?php
                                    if( array_key_exists('widget-area-right', $tpl_default_settings)):
                                        $widgetareas =  array_unique($tpl_default_settings["widget-area-right"]);
                                        $widgetareas = array_filter($widgetareas);
                                        foreach( $widgetareas as $widgetarea ){
                                            echo '<div class="multidropdown">';
                                            echo dt_theme_custom_widgetarea_list("widgetareas-right",$widgetarea,"multidropdown","right-sidebar");
                                            echo '</div>';
                                        }
                                        echo '<div class="multidropdown">';
                                            echo dt_theme_custom_widgetarea_list("widgetareas-right","","multidropdown","right-sidebar");
                                        echo '</div>';                                
                                    else:
                                        echo '<div class="multidropdown">';
                                           echo dt_theme_custom_widgetarea_list("widgetareas-right","","multidropdown","right-sidebar");
                                        echo '</div>';                                
                                    endif;?>
                                </div>
                            </div><!-- Choose Widget Areas End -->
                        </div>
                    </div>
                                                
                 </div><!-- .tpl-common-settings end -->    
                
                <div id="tpl-feature-settings">
                    <div class="custom-box">
                    	<div class="column one-sixth">
                            <label><?php _e('Menu Icon Class','iamd_text_domain');?></label>
                        </div>
                        <div class="column five-sixth last">
	                        <?php $menu_icon_class =  array_key_exists("menu-icon-class",$tpl_default_settings) ? stripcslashes($tpl_default_settings['menu-icon-class']) : "" ;?>
                            <input id="mytheme-menu-class" type="text" name="mytheme-menu-class" value="<?php echo $menu_icon_class;?>"  />
                            <p class="note"> <?php _e('Icon class for this page( eg: fa-desktop )','iamd_text_domain');?> </p>
                        </div>
                    </div>
                	
                </div>
                
				<div id="tpl-default-settings">
                
                    <!-- 4. Allow Commenet -->
                    <div class="custom-box">
                    	<div class="column one-sixth">
                            <label><?php _e('Allow Comments','iamd_text_domain');?></label>
                        </div>
                        <div class="column five-sixth last">
							<?php $switchclass = array_key_exists("comment",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                  $checked = array_key_exists("comment",$tpl_default_settings) ? ' checked="checked"' : '';?>
                            <div data-for="mytheme-page-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input id="mytheme-page-comment" class="hidden" type="checkbox" name="mytheme-page-comment" value="true"  <?php echo $checked;?>/>
                            <p class="note"> <?php _e('YES! to allow comments on this page.','iamd_text_domain');?> </p>
                        </div>
                    </div><!-- Allow Commenet End-->
               </div><!-- tpl-default-settings end-->     

				<div id="tpl-home-fullwidth-settings">
                    <div class="custom-box">
                    	<div class="column one-sixth">
                            <label><?php _e('Full Width Section','iamd_text_domain');?></label>
                        </div>
                        <div class="column five-sixth last">
							<?php $content =  array_key_exists("full-width-section",$tpl_default_settings) ? stripcslashes($tpl_default_settings['full-width-section']) : "" ;?>
                            <textarea name="page-full-width-section" class="widefat" rows="15"><?php echo $content; ?></textarea>
                            <p class="note"> <?php _e('This content will appear in full width','iamd_text_domain');?> </p>
                        </div>
                    </div>
               </div><!-- tpl-home-fullwidth-settings end-->
               
				<div id="tpl-onepage-settings">
                    <div class="custom-box">
                    	<div class="column one-sixth">
                            <label><?php _e('Choose Menu','iamd_text_domain');?></label>
                        </div>
                        <div class="column five-sixth last">
                        	<select name="mytheme-onepage-menu"><?php
								//GETTING ONEPAGE MENUS...
								$v =  array_key_exists("onepage_menu",$tpl_default_settings) ?  $tpl_default_settings['onepage_menu'] : '';
								$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
								foreach($menus as $m):
									$rs = selected($m->term_id,$v,false);
									echo "<option value='".$m->term_id."' {$rs}>".$m->name."</option>";
								endforeach; ?>
                            </select>
                            <p class="note"> <?php _e('The choosen menu items work as one page.','iamd_text_domain');?> </p>
                        </div>
                    </div>
               </div><!-- tpl-onepage-settings end-->
               
               <!-- Blog Template Settings -->
               <div id="tpl-blog">
                  <!-- Post Playout -->
                  <div class="custom-box">
                      <div class="column one-sixth">                
                          <label><?php _e('Posts Layout','iamd_text_domain');?> </label>
                      </div>
                      <div class="column five-sixth last">
                          <ul class="dt-bpanel-layout-set">
                          <?php $posts_layout = array(	'one-column'=>	__("Single post per row.",'iamd_text_domain'),
                                                        'one-half-column'=>	__("Two posts per row.",'iamd_text_domain'),
														'one-third-column'=>	__("Three posts per row.",'iamd_text_domain'),
														'thumb'=>	__("Single Thumb post per row.",'iamd_text_domain'));
                                  $v = array_key_exists("blog-post-layout",$tpl_default_settings) ?  $tpl_default_settings['blog-post-layout'] : 'one-column';
                                  foreach($posts_layout as $key => $value):
                                      $class = ($key == $v) ? " class='selected' " : "";
                                      echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='".IAMD_FW_URL."theme_options/images/columns/{$key}.png' /></a></li>";
                                  endforeach;?>
                          </ul>
                          <input id="mytheme-blog-post-layout" name="mytheme-blog-post-layout" type="hidden" value="<?php echo $v;?>"/>
                          <p class="note"> <?php _e("Choose layout style for your Blog",'iamd_text_domain');?> </p>
                      </div>
                  </div><!-- Post Playout End-->
  
                  <!-- Post Count-->
                  <div class="custom-box">
                      <div class="column one-sixth"> 
                          <label><?php _e('Post per page','iamd_text_domain');?></label>
                      </div>
                      <div class="column five-sixth last"> 
                          <select name="mytheme-blog-post-per-page">
                              <option value="-1"><?php _e("All",'iamd_text_domain');?></option>
                              <?php $selected = 	array_key_exists("blog-post-per-page",$tpl_default_settings) ?  $tpl_default_settings['blog-post-per-page'] : ''; ?>
                              <?php for($i=1;$i<=30;$i++):
                                  echo "<option value='{$i}'".selected($selected,$i,false).">{$i}</option>";
                                  endfor;?>
                          </select>
                          <p class="note"> <?php _e("Your blog pages show at most selected number of posts per page.",'iamd_text_domain');?> </p>
                      </div>
                  </div><!-- Post Count End-->
  
                  <!-- Allow Excerpt -->
                  <div class="custom-box">
                      <div class="column one-sixth">
                          <label><?php _e('Allow Excerpt','iamd_text_domain');?></label>
                      </div>
                      <div class="column five-sixth last">                     
                          <?php $switchclass = array_key_exists("blog-post-excerpt",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                $checked = array_key_exists("blog-post-excerpt",$tpl_default_settings) ? ' checked="checked"' : '';?>
                          <div data-for="mytheme-blog-post-excerpt" class="checkbox-switch <?php echo $switchclass;?>"></div>
                          <input id="mytheme-blog-post-excerpt" class="hidden" type="checkbox" name="mytheme-blog-post-excerpt" value="true"  <?php echo $checked;?>/>
                          <p class="note"> <?php _e('Enable Excerpt','iamd_text_domain');?> </p>
                      </div>
                  </div><!-- Allow Excerpt End-->
  
                  <!-- Excerpt Length-->
                  <div class="custom-box">
                      <div class="column one-sixth">                                 
                          <label><?php _e('Excerpt Length','iamd_text_domain');?></label>
                      </div>
                      <div class="column five-sixth last">                     
                          <?php $v = array_key_exists("blog-post-excerpt-length",$tpl_default_settings) ?  $tpl_default_settings['blog-post-excerpt-length'] : '45';?>
                          <input id="mytheme-blog-post-excerpt-length" name="mytheme-blog-post-excerpt-length" type="text" value="<?php echo $v;?>" />
                          <p class="note"> <?php _e("Limit! Number of charectors from the content to appear on each blog post (Number Only)",'iamd_text_domain');?> </p>
                      </div>
                  </div><!-- Excerpt Length End-->
  
                  <!-- Post Meta-->
                  <div class="custom-box">
                      <h3><?php _e('Post Meta Options','iamd_text_domain');?></h3>
                      <?php $post_meta = array(array(
                                  "id"=>		"disable-author-info",
                                  "label"=>	__("Disable the Author info.",'iamd_text_domain'),
                                  "tooltip"=>	__("By default the author info will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                              ), array(
                                  "id"=>		"disable-date-info",
                                  "label"=>	__("Disable the date info.",'iamd_text_domain'),
                                  "tooltip"=>	__("By default the date info will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                              ),
                              array(
                                  "id"=>		"disable-comment-info",
                                  "label"=>	__("Disable the comment",'iamd_text_domain'),
                                  "tooltip"=>	__("By default the comment will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                              ),
                              array(
                                  "id"=>		"disable-category-info",
                                  "label"=>	__("Disable the category",'iamd_text_domain'),
                                  "tooltip"=>	__("By default the category will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                              ),
                              array(
                                  "id"=>		"disable-tag-info",
                                  "label"=>	__("Disable the tag",'iamd_text_domain'),
                                  "tooltip"=>	__("By default the tag will display when viewing your posts. You can choose to disable it here.",'iamd_text_domain')
                              ));
                          $count = 1;
                          foreach($post_meta as $p_meta):
                              $last = ($count%3 == 0)?"last":'';
                              $id = 		$p_meta['id'];
                              $label =	$p_meta['label'];
                              $tooltip =  $p_meta['tooltip'];
                              $v =  array_key_exists($id,$tpl_default_settings) ?  $tpl_default_settings[$id] : '';
                              $rs =		checked($id,$v,false);
                              $switchclass = ($v<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';
                              
                              echo "<div class='one-third-content {$last}'>";
                              echo '<div class="bpanel-option-set">';
                              echo "<label>{$label}</label>";							
                              echo "<div data-for='{$id}' class='checkbox-switch {$switchclass}'></div>";
                              echo "<input class='hidden' id='{$id}' type='checkbox' name='mytheme-blog-{$id}' value='{$id}' {$rs} />";
                              echo '<p class="note">';
                              echo ($tooltip);
                              echo '</p>';
                              echo '</div>';
                              echo '</div>';
                              
                          $count++;	
                          endforeach;?>
                  </div><!-- Post Meta End-->
                  
                  <!-- Categories -->
                  <div class="custom-box">
                      <h3><?php _e('Exclude Categories','iamd_text_domain');?></h3>
                      <?php if(array_key_exists("blog-post-exclude-categories",$tpl_default_settings)):
                               $exclude_cats = array_unique($tpl_default_settings["blog-post-exclude-categories"]);
                               foreach($exclude_cats as $cats):
                                  echo "<!-- Category Drop Down Container -->
                                        <div class='multidropdown'>";
                                  echo  dt_theme_categorylist("blog,exclude_cats",$cats,"multidropdown");
                                  echo "</div><!-- Category Drop Down Container end-->";		
                               endforeach;
                            else:
                              echo "<!-- Category Drop Down Container -->";
                              echo "<div class='multidropdown'>";
                              echo  dt_theme_categorylist("blog,exclude_cats","","multidropdown");
                              echo "</div><!-- Category Drop Down Container end-->";
                             endif;?>
                      <p class="note"> <?php _e("You can choose certain categories to exclude from your blog page.",'iamd_text_domain');?> </p>
                  </div><!-- Categories End-->
               </div><!-- Blog Template Settings End-->
  
               <!-- Gallery Template Settings -->
               <div id="tpl-gallery">
                  <!-- Post Playout -->
                  <div class="custom-box">
                      <div class="column one-sixth">                 
                          <label><?php _e('Posts Layout','iamd_text_domain');?> </label>
                      </div>
                      <div class="column five-sixth last">
                          <ul class="dt-bpanel-layout-set">
                          <?php $posts_layout = array(	'one-half-column'=>	__("Two posts per row.",'iamd_text_domain'),
                                                        'one-third-column'=>	__("Three posts per row.",'iamd_text_domain'),
                                                        'one-fourth-column' => __("Four Posts per row",'iamd_text_domain'));
                                  $v = array_key_exists("gallery-post-layout",$tpl_default_settings) ?  $tpl_default_settings['gallery-post-layout'] : 'one-half-column';
                                  foreach($posts_layout as $key => $value):
                                      $class = ($key == $v) ? " class='selected' " : "";
                                      echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='".IAMD_FW_URL."theme_options/images/columns/{$key}.png' /></a></li>";
                                  endforeach;?>
                          </ul>
                          <input id="mytheme-gallery-post-layout" name="mytheme-gallery-post-layout" type="hidden" value="<?php echo $v;?>"/>
                          <p class="note"> <?php _e("Choose layout style for your Gallery",'iamd_text_domain');?> </p>
                      </div>      
  
                  </div><!-- Post Playout End-->
  
                  <!-- Post Count-->
                  <div class="custom-box">
                      <div class="column one-sixth">
                          <label><?php _e('Post per page','iamd_text_domain');?></label>
                      </div>
                      <div class="column five-sixth last">   
                          <select name="mytheme-gallery-post-per-page">
                              <option value="-1"><?php _e("All",'iamd_text_domain');?></option>
                              <?php $selected = 	array_key_exists("gallery-post-per-page",$tpl_default_settings) ?  $tpl_default_settings['gallery-post-per-page'] : ''; ?>
                              <?php for($i=1;$i<=30;$i++):
                                  echo "<option value='{$i}'".selected($selected,$i,false).">{$i}</option>";
                                  endfor;?>
                          </select>
                          <p class="note"> <?php _e("Your gallery pages show at most selected number of posts per page.",'iamd_text_domain');?> </p>
                      </div>
                  </div><!-- Post Count End-->
  
                  <div class="custom-box">
                      <div class="column one-sixth">                
                          <label><?php _e('Allow Filters','iamd_text_domain');?></label>
                      </div>
                      <div class="column five-sixth last">                       
                          <?php $switchclass = array_key_exists("filter",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                $checked = array_key_exists("filter",$tpl_default_settings) ? ' checked="checked"' : '';?>
                          <div data-for="mytheme-gallery-filter" class="checkbox-switch <?php echo $switchclass;?>"></div>
                          <input id="mytheme-gallery-filter" class="hidden" type="checkbox" name="mytheme-gallery-filter" value="true"  <?php echo $checked;?>/>
                          <p class="note"> <?php _e('Allow filter options for gallery items','iamd_text_domain');?> </p>
                      </div>
                  </div>

                  <div class="custom-box">
                      <div class="column one-sixth">                
                          <label><?php _e('Disable Full Width','iamd_text_domain');?></label>
                      </div>
                      <div class="column five-sixth last">
                          <?php $switchclass = array_key_exists("gallery-fullwidth",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                $checked = array_key_exists("gallery-fullwidth",$tpl_default_settings) ? ' checked="checked"' : '';?>
                          <div data-for="mytheme-gallery-fullwidth" class="checkbox-switch <?php echo $switchclass;?>"></div>
                          <input id="mytheme-gallery-fullwidth" class="hidden" type="checkbox" name="mytheme-gallery-fullwidth" value="true"  <?php echo $checked;?>/>
                          <p class="note"> <?php _e('Disable Full Width gallery layout','iamd_text_domain');?> </p>
                      </div>
                  </div>
  
                  <!-- Categories -->
                  <div class="custom-box">
                      <h3><?php _e('Choose Categories','iamd_text_domain');?></h3>
                      <?php if(array_key_exists("gallery-categories",$tpl_default_settings)):
                               $exclude_cats = array_unique($tpl_default_settings["gallery-categories"]);
                               foreach($exclude_cats as $cats):
                                  echo "<!-- Category Drop Down Container -->
                                        <div class='multidropdown'>";
                                  echo  dt_theme_gallery_categorylist("gallery,cats",$cats,"multidropdown");
                                  echo "</div><!-- Category Drop Down Container end-->";
                               endforeach;
                            else:
                              echo "<!-- Category Drop Down Container -->";
                              echo "<div class='multidropdown'>";
                              echo  dt_theme_gallery_categorylist("gallery,cats","","multidropdown");
                              echo "</div><!-- Category Drop Down Container end-->";
                             endif;?>
                      <p class="note"> <?php _e("You can choose only certain categories to show in gallery items. ",'iamd_text_domain');?> </p>
                  </div><!-- Categories End-->                
             </div><!-- Gallery Template Settings End-->
        </div>    
<?php  wp_reset_postdata();
   } 
   
	function page_meta_save($post_id){
		global $pagenow;
		if ( 'post.php' != $pagenow ) return $post_id;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 	return $post_id;

			$settings = array();
			$settings['layout'] = $_POST['layout'];
			
			if($_POST['layout'] == 'with-both-sidebar') {
				$settings['disable-everywhere-sidebar-left'] = $_POST['disable-everywhere-sidebar-left'];
				$settings['disable-everywhere-sidebar-right'] = $_POST['disable-everywhere-sidebar-right'];
				$settings['widget-area-left'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-left']));
				$settings['widget-area-right'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-right']));
			} elseif($_POST['layout'] == 'with-left-sidebar') {
				$settings['disable-everywhere-sidebar-left'] = $_POST['disable-everywhere-sidebar-left'];
				$settings['widget-area-left'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-left']));
			} elseif($_POST['layout'] == 'with-right-sidebar') {
				$settings['disable-everywhere-sidebar-right'] = $_POST['disable-everywhere-sidebar-right'];
				$settings['widget-area-right'] =  array_unique(array_filter($_POST['mytheme']['widgetareas-right']));
			} 
			
			if(isset($_POST["page_template"]) && ( 'default' == $_POST["page_template"]) || 'tpl-home.php' == $_POST["page_template"] || 'tpl-feature.php' ==  $_POST["page_template"] || 'tpl-contact.php' == $_POST["page_template"] || 'tpl-fullwidth.php' == $_POST["page_template"] || 'tpl-fullwidth-home.php' == $_POST["page_template"] || 'tpl-onepage.php' == $_POST["page_template"]) :
				$settings['show_slider'] =  $_POST['mytheme-show-slider'];
				$settings['slider_type'] = $_POST['mytheme-slider-type'];
				$settings['comment'] = $_POST['mytheme-page-comment'];
				$settings['layerslider_id'] = $_POST['layerslider_id'];
				$settings['revolutionslider_id'] = $_POST['revolutionslider_id'];
				
				$settings['menu-icon-class'] = $_POST['mytheme-menu-class'];
				$settings['full-width-section'] = $_POST['page-full-width-section'];
				$settings['onepage_menu'] = $_POST['mytheme-onepage-menu'];
			
			elseif( "tpl-blog.php" == $_POST['page_template'] ):
				$settings['blog-post-layout'] = $_POST['mytheme-blog-post-layout'];
				$settings['blog-post-per-page'] = $_POST['mytheme-blog-post-per-page'];
				$settings['blog-post-excerpt'] = $_POST['mytheme-blog-post-excerpt'];
				$settings['blog-post-excerpt-length'] = $_POST['mytheme-blog-post-excerpt-length'];
				$settings['blog-post-exclude-categories'] = $_POST['mytheme']['blog']['exclude_cats'];
				$settings['disable-date-info'] = $_POST['mytheme-blog-disable-date-info'];
				$settings['disable-author-info'] = $_POST['mytheme-blog-disable-author-info'];
				$settings['disable-comment-info'] = $_POST['mytheme-blog-disable-comment-info'];
				$settings['disable-category-info'] = $_POST['mytheme-blog-disable-category-info'];
				$settings['disable-tag-info'] = $_POST['mytheme-blog-disable-tag-info'];
				
			elseif( "tpl-gallery.php" == $_POST['page_template'] ):
				$settings['gallery-post-layout'] = $_POST['mytheme-gallery-post-layout'];
				$settings['gallery-post-per-page'] = $_POST['mytheme-gallery-post-per-page'];
				$settings['filter'] = $_POST['mytheme-gallery-filter'];
				$settings['gallery-categories'] = $_POST['mytheme']['gallery']['cats'];
				$settings['gallery-fullwidth'] = $_POST['mytheme-gallery-fullwidth'];
				
			endif;

		update_post_meta($post_id, "_tpl_default_settings", array_filter($settings));
		
	}?>