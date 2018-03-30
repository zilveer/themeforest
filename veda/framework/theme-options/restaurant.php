<!-- #restaurant -->
<div id="restaurant" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">

        <ul class="sub-panel"> 
			<li><a href="#tab1"><?php esc_html_e('Restaurant', 'veda');?></a></li>
        </ul>
        
        <!-- #tab1 - Menu Custom Post Type -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
            
              <div class="box-title">
                  <h3><?php esc_html_e('Menu Archives Page Layout', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <h6><?php esc_html_e('Layout', 'veda');?></h6>
                  <p class="note no-margin"> <?php esc_html_e("Choose the Menu archives page layout Style", 'veda');?></p>
                  <div class="hr_invisible"> </div>
                  <div class="bpanel-option-set">
                      <ul class="bpanel-post-layout bpanel-layout-set" id="menu-archives-layout">
                      <?php $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
                            $v =  veda_option('pageoptions',"menu-archives-page-layout");
                            $v = !empty($v) ? $v : "content-full-width";
                            foreach($layout as $key => $value):
                                $class = ( $key ==   $v ) ? " class='selected' " : "";
                                echo "<li><a href='#' rel='{$key}' {$class}><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                            endforeach; ?>
                      </ul>
                      <input name="dttheme[pageoptions][menu-archives-page-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                  </div><?php
                  $sb_layout = veda_option('pageoptions',"menu-archives-page-layout");
				  $sb_layout = !empty($sb_layout) ? $sb_layout : "content-full-width";
                  $sidebar_both = $sidebar_left = $sidebar_right = '';
                  if($sb_layout == 'content-full-width') {
                    $sidebar_both = 'style="display:none;"'; 
                  } elseif($sb_layout == 'with-left-sidebar') {
                    $sidebar_right = 'style="display:none;"'; 
                  } elseif($sb_layout == 'with-right-sidebar') {
                    $sidebar_left = 'style="display:none;"'; 
                  } ?>
                  <div id="bpanel-widget-area-options" <?php echo 'class="menu-archives-layout" '.$sidebar_both;?>>
                    <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo $sidebar_left; ?>>
                        <!-- 2. Standard Sidebar Left Start -->
                        <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                            <h6><?php esc_html_e('Show Standard Left Sidebar', 'veda');?></label></h6>
                            <?php veda_switch("",'pageoptions','show-standard-left-sidebar-for-menu-archives'); ?>
                        </div><!-- Standard Sidebar Left End-->
                    </div>

                    <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo $sidebar_right; ?>>
                        <!-- 3. Standard Sidebar Right Start -->
                        <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                            <h6><?php esc_html_e('Show Standard Right Sidebar', 'veda');?></label></h6>
                            <?php veda_switch("",'pageoptions','show-standard-right-sidebar-for-menu-archives'); ?>
                        </div><!-- Standard Sidebar Right End-->
                    </div>
                  </div>
              </div>

              <div class="box-title">
                  <h3><?php esc_html_e('Menu Archives Post Layout', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <h6><?php esc_html_e('Layout', 'veda');?></h6>
                  <p class="note no-margin"><?php esc_html_e("Choose the Post Layout Style in Menu Archives", 'veda');?></p>
                  <div class="hr_invisible"> </div>
                  <div class="bpanel-option-set">
                      <ul class="bpanel-post-layout bpanel-layout-set">
                      <?php $posts_layout = array( 'one-half-column'=>esc_html__("Two posts per row.", 'veda'), 'one-third-column' => esc_html__("Three posts per row.", 'veda'));
                            $v = veda_option('pageoptions',"menu-archives-post-layout");
                            $v = !empty($v) ? $v : "one-half-column";
                            foreach($posts_layout as $key => $value):
                               $class = ( $key ==  $v ) ? " class='selected' " :"";                                  
                               echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$key}.png' /></a></li>";
                            endforeach;?>                        
                      </ul>
                      <input name="dttheme[pageoptions][menu-archives-post-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                  </div>
              </div>

              <div class="box-title">
                <h3><?php esc_html_e('Menu Custom Fields', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <div class="portfolio-custom-fields">
                    <input type="button" class="black add-custom-field" value="<?php esc_attr_e('Add New Field', 'veda');?>" />
                    <div class="hr_invisible"> </div>
                    <?php $custom_fields = veda_option("pageoptions","menu-custom-fields");
                      $custom_fields = is_array($custom_fields) ? array_filter($custom_fields) : array();
                      $custom_fields = array_unique( $custom_fields);

                      foreach( $custom_fields as $field ){ ?>
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][menu-custom-fields][]";?>" value="<?php echo esc_attr($field);?>">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                          </div><?php
                      } ?>

                      <div class="clone hidden">
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][menu-custom-fields][]";?>" value="">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                        </div>
                      </div>
                  </div>
              </div>

              <div class="box-title">
                <h3><?php esc_html_e('Permalinks', 'veda');?></h3>
              </div>

              <div class="box-content">
                <div class="column one-third"><label><?php esc_html_e('Menu Category slug', 'veda');?></label></div>
                <div class="column two-third last">
                  <input name="dttheme[pageoptions][menu-category-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','menu-category-slug')));?>" />
                  <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. menu-types <br> <b>After made changes save permalinks.</b>', 'veda');?></p>
                </div>
                <div class="hr"></div>

                <div class="column one-half">
                  <label><?php esc_html_e('Singular Menu Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][singular-menu-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-menu-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Menu", save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
                <div class="column one-half last">
                  <label><?php esc_html_e('Plural Menu Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][plural-menu-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-menu-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Menus". save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>

                <div class="column one-half">
                  <label><?php esc_html_e('Singular Menu Category Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][singular-menu-tax-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-menu-tax-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Category". save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
                <div class="column one-half last">
                  <label><?php esc_html_e('Plural Menu Category Name', 'veda');?></label>
                  <div class="clear"></div>
                    <input name="dttheme[pageoptions][plural-menu-tax-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-menu-tax-name')));?>" />
                    <p class="note"><?php esc_html_e('By default "Categories". save options & reload.', 'veda');?></p>
                    <div class="hr"></div>
                </div>                              
              </div>
            </div><!-- .bpanel-box end -->
            
            <!-- .bpanel-box -->
            <div class="bpanel-box">
              <div class="box-title">
                <h3><?php esc_html_e('Chef Custom Fields', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <div class="portfolio-custom-fields">
                    <input type="button" class="black add-custom-field" value="<?php esc_attr_e('Add New Field', 'veda');?>" />
                    <div class="hr_invisible"> </div>
                    <?php $custom_fields = veda_option("pageoptions","chef-custom-fields");
                      $custom_fields = is_array($custom_fields) ? array_filter($custom_fields) : array();
                      $custom_fields = array_unique( $custom_fields);

                      foreach( $custom_fields as $field ){ ?>
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][chef-custom-fields][]";?>" value="<?php echo esc_attr($field);?>">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                          </div><?php
                      } ?>

                      <div class="clone hidden">
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][chef-custom-fields][]";?>" value="">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                        </div>
                      </div>
                  </div>
              </div>

              <div class="box-title">
                <h3><?php esc_html_e('Permalinks', 'veda');?></h3>
              </div>

              <div class="box-content">
                <div class="column one-third"><label><?php esc_html_e('Single Chef slug', 'veda');?></label></div>
                <div class="column two-third last">
                  <input name="dttheme[pageoptions][single-chef-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','single-chef-slug')));?>" />
                  <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. chef-item <br> <b>After made changes save permalinks.</b>', 'veda');?></p>
                </div>
                <div class="hr"></div>
                <div class="column one-half">
                  <label><?php esc_html_e('Singular Chef Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][singular-chef-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-chef-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Chef", save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
                <div class="column one-half last">
                  <label><?php esc_html_e('Plural Chef Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][plural-chef-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-chef-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Chefs". save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
              </div>
            </div><!-- .bpanel-box end -->
        </div><!-- #tab1 End -->
      
    </div><!-- .bpanel-main-content end-->
</div><!-- #pageoptions end-->