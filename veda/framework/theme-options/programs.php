<!-- #programs -->
<div id="programs" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">

        <ul class="sub-panel"> 
			<li><a href="#tab1"><?php esc_html_e('Programs', 'veda');?></a></li>
        </ul>
        
        <!-- #tab1 - Program Custom Post Type -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
            
              <div class="box-title">
                  <h3><?php esc_html_e('Program Archives Page Layout', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <h6><?php esc_html_e('Layout', 'veda');?></h6>
                  <p class="note no-margin"> <?php esc_html_e("Choose the Program archives page layout Style", 'veda');?></p>
                  <div class="hr_invisible"> </div>
                  <div class="bpanel-option-set">
                      <ul class="bpanel-post-layout bpanel-layout-set" id="program-archives-layout">
                      <?php $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
                            $v =  veda_option('pageoptions',"program-archives-page-layout");
                            $v = !empty($v) ? $v : "content-full-width";
                            foreach($layout as $key => $value):
                                $class = ( $key ==   $v ) ? " class='selected' " : "";
                                echo "<li><a href='#' rel='{$key}' {$class}><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                            endforeach; ?>
                      </ul>
                      <input name="dttheme[pageoptions][program-archives-page-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                  </div><?php
                  $sb_layout = veda_option('pageoptions',"program-archives-page-layout");
				  $sb_layout = !empty($sb_layout) ? $sb_layout : "content-full-width";
                  $sidebar_both = $sidebar_left = $sidebar_right = '';
                  if($sb_layout == 'content-full-width') {
                    $sidebar_both = 'style="display:none;"'; 
                  } elseif($sb_layout == 'with-left-sidebar') {
                    $sidebar_right = 'style="display:none;"'; 
                  } elseif($sb_layout == 'with-right-sidebar') {
                    $sidebar_left = 'style="display:none;"'; 
                  } ?>
                  <div id="bpanel-widget-area-options" <?php echo 'class="program-archives-layout" '.$sidebar_both;?>>
                    <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo $sidebar_left; ?>>
                        <!-- 2. Standard Sidebar Left Start -->
                        <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                            <h6><?php esc_html_e('Show Standard Left Sidebar', 'veda');?></label></h6>
                            <?php veda_switch("",'pageoptions','show-standard-left-sidebar-for-program-archives'); ?>
                        </div><!-- Standard Sidebar Left End-->
                    </div>

                    <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo $sidebar_right; ?>>
                        <!-- 3. Standard Sidebar Right Start -->
                        <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                            <h6><?php esc_html_e('Show Standard Right Sidebar', 'veda');?></label></h6>
                            <?php veda_switch("",'pageoptions','show-standard-right-sidebar-for-program-archives'); ?>
                        </div><!-- Standard Sidebar Right End-->
                    </div>
                  </div>
              </div>

              <div class="box-title">
                  <h3><?php esc_html_e('Program Archives Post Layout', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <h6><?php esc_html_e('Layout', 'veda');?></h6>
                  <p class="note no-margin"><?php esc_html_e("Choose the Post Layout Style in Program Archives", 'veda');?></p>
                  <div class="hr_invisible"> </div>
                  <div class="bpanel-option-set">
                      <ul class="bpanel-post-layout bpanel-layout-set">
                      <?php $posts_layout = array( 'one-half-column'=>esc_html__("Two posts per row.", 'veda'), 'one-third-column' => esc_html__("Three posts per row.", 'veda'));
                            $v = veda_option('pageoptions',"program-archives-post-layout");
                            $v = !empty($v) ? $v : "one-half-column";
                            foreach($posts_layout as $key => $value):
                               $class = ( $key ==  $v ) ? " class='selected' " :"";                                  
                               echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$key}.png' /></a></li>";
                            endforeach;?>                        
                      </ul>
                      <input name="dttheme[pageoptions][program-archives-post-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                  </div>              
              </div>

              <div class="box-title">
                <h3><?php esc_html_e('Program Custom Fields', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <div class="portfolio-custom-fields">
                    <input type="button" class="black add-custom-field" value="<?php esc_attr_e('Add New Field', 'veda');?>" />
                    <div class="hr_invisible"> </div>
                    <?php $custom_fields = veda_option("pageoptions","program-custom-fields");
                      $custom_fields = is_array($custom_fields) ? array_filter($custom_fields) : array();
                      $custom_fields = array_unique( $custom_fields);

                      foreach( $custom_fields as $field ){ ?>
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][program-custom-fields][]";?>" value="<?php echo esc_attr($field);?>">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                          </div><?php
                      } ?>

                      <div class="clone hidden">
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][program-custom-fields][]";?>" value="">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                        </div>
                      </div>
                  </div>
              </div>

              <div class="box-title">
                <h3><?php esc_html_e('Permalinks', 'veda');?></h3>
              </div>

              <div class="box-content">
                <div class="column one-third"><label><?php esc_html_e('Single Program slug', 'veda');?></label></div>
                <div class="column two-third last">
                  <input name="dttheme[pageoptions][single-program-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','single-program-slug')));?>" />
                  <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. program-item <br> <b>After made changes save permalinks.</b>', 'veda');?></p>
                </div>
                <div class="hr"></div>

                <div class="column one-third"><label><?php esc_html_e('Program Category slug', 'veda');?></label></div>
                <div class="column two-third last">
                  <input name="dttheme[pageoptions][program-category-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','program-category-slug')));?>" />
                  <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. program-types <br> <b>After made changes save permalinks.</b>', 'veda');?></p>
                </div>
                <div class="hr"></div>

                <div class="column one-half">
                  <label><?php esc_html_e('Singular Program Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][singular-program-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-program-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Program", save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
                <div class="column one-half last">
                  <label><?php esc_html_e('Plural Program Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][plural-program-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-program-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Programs". save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>

                <div class="column one-half">
                  <label><?php esc_html_e('Singular Program Category Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][singular-program-tax-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-program-tax-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Category". save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
                <div class="column one-half last">
                  <label><?php esc_html_e('Plural Program Category Name', 'veda');?></label>
                  <div class="clear"></div>
                    <input name="dttheme[pageoptions][plural-program-tax-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-program-tax-name')));?>" />
                    <p class="note"><?php esc_html_e('By default "Categories". save options & reload.', 'veda');?></p>
                    <div class="hr"></div>
                </div>                              
              </div>
            </div><!-- .bpanel-box end -->
            
            <!-- .bpanel-box -->
            <div class="bpanel-box">
              <div class="box-title">
                <h3><?php esc_html_e('Trainer Custom Fields', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <div class="portfolio-custom-fields">
                    <input type="button" class="black add-custom-field" value="<?php esc_attr_e('Add New Field', 'veda');?>" />
                    <div class="hr_invisible"> </div>
                    <?php $custom_fields = veda_option("pageoptions","trainer-custom-fields");
                      $custom_fields = is_array($custom_fields) ? array_filter($custom_fields) : array();
                      $custom_fields = array_unique( $custom_fields);

                      foreach( $custom_fields as $field ){ ?>
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][trainer-custom-fields][]";?>" value="<?php echo esc_attr($field);?>">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                          </div><?php
                      } ?>

                      <div class="clone hidden">
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][trainer-custom-fields][]";?>" value="">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                        </div>
                      </div>
                  </div>
              </div>

              <div class="box-title">
                <h3><?php esc_html_e('Permalinks', 'veda');?></h3>
              </div>

              <div class="box-content">
                <div class="column one-half">
                  <label><?php esc_html_e('Singular Trainer Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][singular-trainer-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-trainer-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Trainer", save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
                <div class="column one-half last">
                  <label><?php esc_html_e('Plural Trainer Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][plural-trainer-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-trainer-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Trainers". save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
              </div>
            </div><!-- .bpanel-box end -->
        </div><!-- #tab1 End -->
      
    </div><!-- .bpanel-main-content end-->
</div><!-- #programoptions end-->