<!-- #specialty-pages -->
<div id="specialty-pages" class="bpanel-content">
    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
    	 <ul class="sub-panel">
         <?php $sub_menus = array(
					array("title"=>__("Global",'iamd_text_domain'), "link"=>"#global-page"),
					array("title"=>__("Post Archives",'iamd_text_domain'), "link"=>"#post-archives"),
                    array("title"=>__("Gallery Archives",'iamd_text_domain'), "link"=>"#gallery-archives"),
					array("title"=>__("Search",'iamd_text_domain'), "link"=>"#search"),
					array("title"=>__("404",'iamd_text_domain'), "link"=>"#not-found-404"));
				  foreach($sub_menus as $menu): ?>
                  	<li><a href="<?php echo $menu['link']?>"><?php echo $menu['title'];?></a></li>
		 <?php endforeach?>
         </ul>
         
         <?php 
		 $posts_layout_array_one =   array( 'one-column'=>__("Single post per row.",'iamd_text_domain'),'one-half-column'=>__("Two posts per row.",'iamd_text_domain'),'one-third-column'=>__("Three posts per row.",'iamd_text_domain'));
		 $tabs = array(

				array(  "id"=>"global-page",
						"layout-title"=>__("Global Page Layout",'iamd_text_domain'),
						"layout-tooltip"=>__("You can choose between a left, right or no sidebar layout globally.",'iamd_text_domain')
				 ),

				array(  "id"=>"post-archives",
						"layout-title"=>__("Post's Archive Page Layout",'iamd_text_domain'),
						"layout-tooltip"=>__("You can choose between a left, right or no sidebar layout for the Archive pages.",'iamd_text_domain'),
						"post-layout-title" => __("Posts Layout",'iamd_text_domain'),
						"post-layout-tooltip"=>__("Your archive results will use the layout you select below.",'iamd_text_domain'),                                
						"post-layouts" => $posts_layout_array_one
				 ),

				array(  "id"=>"gallery-archives", 
						"layout-title"=>__("Gallery Custom Post's Archive Page Layout",'iamd_text_domain'),
						"layout-tooltip"=>__("You can choose between a left, right or no sidebar layout for the Gallery custom post's Archive page.",'iamd_text_domain'),
						"post-layout-title" => __("Posts Layout",'iamd_text_domain'),
						"post-layout-tooltip"=>__("Your archive results will use the layout you select below.",'iamd_text_domain'),                                
						"post-layouts" => array(
							'one-column'=>__("Single gallery item  per row.",'iamd_text_domain'),
							'one-half-column'=>__("Two gallery items per row.",'iamd_text_domain'),
							'one-third-column'=>__("Three gallery items per row.",'iamd_text_domain'),                                   
							'one-fourth-column' => __("Three gallery items per row.",'iamd_text_domain'))
				),

				array(  "id"=>"search",
						"layout-title"=>__("Search Layout",'iamd_text_domain'),
						"layout-tooltip"=>__("You can choose between a left, right or no sidebar layout for your Search page.",'iamd_text_domain'),
						"post-layout-title" => __("Posts Layout",'iamd_text_domain'),
						"post-layout-tooltip"=>__("Your Search results will use the layout you select below.",'iamd_text_domain'),
						"post-layouts" => $posts_layout_array_one
				),

				array(  "id"=>"not-found-404",
						"layout-title"=>__("404 Layout",'iamd_text_domain'),
						"layout-tooltip"=>__("You can choose between a left, right or no sidebar layout for your 404 page.",'iamd_text_domain'),
						
						"bg-title"=>__("404 Background",'iamd_text_domain'),
						"bg-label"=>__("404 background image",'iamd_text_domain'),
						"bg-tooltip"=>__('Upload an image for the theme\'s 404 page background','iamd_text_domain'),

						"content-title" => __("404 Message",'iamd_text_domain'),
						"content-tooltip"=>__("You can give custom 404 page message",'iamd_text_domain')
				));
				
				?>
        <?php foreach($tabs as $tab): 
				$id =  $tab['id'];?>
        	<div id="<?php echo $id;?>" class="tab-content">
            	 <div class="bpanel-box">
                 
                 	<!-- Section 1 -->	
                    <div class="box-title"><h3><?php echo $tab['layout-title'];?></h3></div>
                    <div class="box-content">
                    
						<?php if( $id == "global-page" ): ?>
                            <div class="bpanel-option-set">
                                <h6><?php _e('Force to Enable Global Page Layout','iamd_text_domain');?></h6>
                                <?php dt_theme_switch("",'specialty','force-enable-global-layout');?>
                                <p class="note"> <?php _e('Force to enable or disable global page layout for all pages.','iamd_text_domain');?>  </p>
                            </div>
                            <div class="clear"> </div>
                            <div class="hr"> </div>
                        <?php endif; ?>
                    
                    	<p class="note"> <?php echo ($tab['layout-tooltip']);?></p>

                    	<div class="bpanel-option-set">
                        	<ul class="bpanel-post-layout bpanel-layout-set" id="<?php echo 'dt-'.$id;?>">
                           	<?php $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
							foreach($layout as $key => $value):
								$class = ( $key ==  dt_theme_option('specialty',"{$id}-layout")) ? " class='selected' " : "";
								echo "<li><a href='#' rel='{$key}' {$class}><img src='".IAMD_FW_URL."theme_options/images/columns/{$value}.png' /></a></li>";
							endforeach; ?>
                            </ul>
                            <input id="mytheme[specialty][<?php echo $id;?>-layout]" name="mytheme[specialty][<?php echo $id;?>-layout]" type="hidden"  
                            	value="<?php echo dt_theme_option('specialty',"{$id}-layout");?>"/>
                        </div>

						 <?php
                         $sb_layout = dt_theme_option('specialty',"{$id}-layout");
						 $sb_layout = !empty($sb_layout) ? $sb_layout : "content-full-width";
                         $sidebar_both = $sidebar_left = $sidebar_right = '';
                         if($sb_layout == 'content-full-width') {
                            $sidebar_both = 'style="display:none;"'; 
                         } elseif($sb_layout == 'with-left-sidebar') {
                            $sidebar_right = 'style="display:none;"'; 
                         } elseif($sb_layout == 'with-right-sidebar') {
                            $sidebar_left = 'style="display:none;"'; 
                         }
						 if( $id != "global-page" ): ?>
                            <div id="bpanel-widget-area-options" <?php echo 'class="dt-'.$id.'" '.$sidebar_both;?>>

                                <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo $sidebar_left; ?>>
                                    <!-- 2. Every Where Sidebar Left Start -->
                                    <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                                        <h6><?php _e('Disable Standard Left Sidebar','iamd_text_domain');?></label></h6>
                                        <?php dt_theme_switch("",'specialty','disable-everywhere-left-sidebar-for-'.$id); ?>
                                    </div><!-- Every Where Sidebar Left End-->
                                </div>

                                <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo $sidebar_right; ?>>
                                    <!-- 3. Every Where Sidebar Right Start -->
                                    <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                                        <h6><?php _e('Disable Standard Right Sidebar','iamd_text_domain');?></label></h6>
                                        <?php dt_theme_switch("",'specialty','disable-everywhere-right-sidebar-for-'.$id); ?>
                                    </div><!-- Every Where Sidebar Right End-->
                                </div>

                            </div><?php
						 endif; ?>

                    </div><!-- Section 1 End -->


                    <?php if( $id != "not-found-404" && $id != "global-page" ): ?>
                    <!-- Post Layout Section -->
	                <div class="box-title"><h3><?php echo $tab['post-layout-title'];?></h3></div>
                    <div class="box-content">
                    	<p class="note"><?php echo $tab['post-layout-tooltip'];?></p>
                    	<div class="bpanel-option-set">
                        	<ul class="bpanel-post-layout bpanel-layout-set">
                            <?php $posts_layout = $tab['post-layouts'];
									$v = dt_theme_option('specialty',"{$id}-post-layout");
									$v = !empty($v) ? $v : "one-column";
								  foreach($posts_layout as $key => $value):
									$class = ( $key ==  $v ) ? " class='selected' " :"";								  
									echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='".IAMD_FW_URL."theme_options/images/columns/{$key}.png' /></a></li>";
                           		 endforeach;?>
                    		</ul>
                            <input id="mytheme[specialty][<?php echo $id;?>-post-layout]" name="mytheme[specialty][<?php echo $id;?>-post-layout]" type="hidden"  
                            	value="<?php echo dt_theme_option('specialty',"{$id}-post-layout");?>"/>
                        </div>
                    </div>
                    <!-- Post Layout Section End-->
                    <?php endif; ?>
                    

                   
                    <!-- 404 Content -->
                    <?php if($id == "not-found-404"): ?>
                        <div class="box-title"><h3><?php echo $tab['content-title'];?></h3></div>
                        <div class="box-content">
                        	<p class="note"><?php echo ($tab['content-tooltip']);?></p>
                            
                            
                            <div class="bpanel-option-set">
                                <h6><?php _e('404 Custom Message','iamd_text_domain');?></h6>
                                <textarea id="mytheme-404-text" name="mytheme[specialty][404-message]" rows="" 
                                	cols=""><?php echo stripslashes(dt_theme_option('specialty','404-message'));?></textarea>
                            </div>
                            <div class="hr"></div>
                            
                            <h6><?php _e("Disable Font Settings",'iamd_text_domain')?></h6>
                            <div class="column one-fifth bpanel-option-set">
                            	<?php dt_theme_switch("",'specialty','disable-404-font-settings');?>
                            </div>
                            <div class="column four-fifth last"><p class="note"><?php _e('Enable / Disable 404 Font settings','iamd_text_domain');?></p></div>
                            <div class="hr"></div>
                        
                        	<!-- Font Section -->                        	
                            <div class="column one-column">
                                <div class="bpanel-option-set">
                                    <?php dt_theme_admin_fonts(__('Message Font','iamd_text_domain'),'mytheme[specialty][message-font]',dt_theme_option('specialty','message-font'));?>
                                </div>
                            </div>
                            <!-- Font Section -->
                            <div class="hr_invisible"> </div>
                            <!-- Font Color Section -->
                            <div class="column one-half">
        	                    <?php $label = 		__("Message Font Color",'iamd_text_domain');
									  $name  =		"mytheme[specialty][message-font-color]";	
									  $value =  	 (dt_theme_option('specialty','message-font-color')!= NULL) ? dt_theme_option('specialty','message-font-color') : "#";
									  $tooltip = 	__("Pick a custom color for 404 message font color of the theme e.g. #a314a3",'iamd_text_domain'); ?>
									  <h6> <?php echo $label;?> </h6>
                                  <?php dt_theme_admin_color_picker("",$name,$value,'');?>
                            
                            </div><!-- Font Color Section -->
                            <div class="column one-half last">
								<?php dt_theme_admin_jqueryuislider(__('Message Font Size','iamd_text_domain'),"mytheme[specialty][message-font-size]",
    	                        dt_theme_option('specialty',"message-font-size"));?>
                            </div>
                            
                        </div>
                    <?php endif;?>
                    <!-- 404 Content End-->

                 </div><!-- .bpanel-box end -->
            </div><!-- .tab-content end -->
        <?php endforeach;?>
    </div>
</div><!-- #specialty-pages end-->