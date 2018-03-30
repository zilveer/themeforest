<!-- #attorneys -->
<div id="attorney" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">

        <ul class="sub-panel"> 
      <li><a href="#tab1"><?php esc_html_e('Attorneys', 'veda');?></a></li>
        </ul>
        
        <!-- #tab1 - Attorney Custom Post Type -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
              <!-- Custom Fields -->
                <div class="box-title">
                  <h3><?php esc_html_e('Attorney Custom Fields', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <div class="portfolio-custom-fields">
                      <input type="button" class="black add-custom-field" value="<?php esc_attr_e('Add New Field', 'veda');?>" />
                      <div class="hr_invisible"> </div>
                      <?php $custom_fields = veda_option("pageoptions","attorney-custom-fields");
                        $custom_fields = is_array($custom_fields) ? array_filter($custom_fields) : array();
                        $custom_fields = array_unique( $custom_fields);

                        foreach( $custom_fields as $field ){ ?>
                          <div class="custom-field-container">
                            <div class="hr_invisible"> </div>
                              <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][attorney-custom-fields][]";?>" value="<?php echo esc_attr($field);?>">
                              <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                            </div><?php
                        } ?>

                        <div class="clone hidden">
                          <div class="custom-field-container">
                            <div class="hr_invisible"> </div>
                              <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][attorney-custom-fields][]";?>" value="">
                              <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                          </div>
                        </div>
                    </div>
                </div>
              <!-- Custom Fields -->

              <!-- Taxonomy Page Settings -->
              <div class="box-title">
                <h3><?php $title = veda_opts_get( 'singular-attorney-tax-name', esc_html__('Department', 'veda') );
                printf( esc_html__( '%s Archive Page Layout', 'veda' ), $title );?></h3>
              </div>
              <div class="box-content">

                <div class="column one-third"><label><?php esc_html_e('Post Style', 'veda');?></label></div>
                <div class="column two-third last">
                  <?php $selected = veda_option('pageoptions','attorney-post-layout');?>
                  <select class="dt-chosen-select" name="dttheme[pageoptions][attorney-post-layout]">
                      <option value="2" <?php selected( $selected, 2);?>><?php esc_html_e('Two Columns','veda');?></option>
                      <option value="3" <?php selected( $selected, 3);?>><?php esc_html_e('Three Columns','veda');?></option>
                      <option value="4" <?php selected( $selected, 4);?>><?php esc_html_e('Four Columns','veda');?></option>
                  </select>
                  <p class="note"><?php esc_html_e('Choose the attorney post layout style', 'veda');?></p>
                </div>
                <div class="hr"></div>

                <div class="hr_invisible"> </div>
                <h6><?php esc_html_e('Layout', 'veda');?></h6>
                <p class="note no-margin"><?php esc_html_e("Choose the archive page layout style", 'veda');?></p>
                <div class="hr_invisible"> </div>
                <div class="bpanel-option-set">
                  <ul class="bpanel-post-layout bpanel-layout-set" id="attorneys-archives-layout"><?php
                    $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
                    $v = veda_option('pageoptions',"attorneys-archives-page-layout");
                    $v = !empty($v) ? $v : "content-full-width";

                    foreach($layout as $key => $value):
                      $class = ( $key ==   $v ) ? " class='selected' " : "";
                      echo "<li><a href='#' rel='{$key}' {$class}><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                    endforeach;?>
                  </ul>
                  <input name="dttheme[pageoptions][attorneys-archives-page-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                </div><?php
                  $sb_layout = veda_option('pageoptions',"attorneys-archives-page-layout");
                  $sb_layout = !empty($sb_layout) ? $sb_layout : "content-full-width";
                  $sidebar_both = $sidebar_left = $sidebar_right = '';
                  if($sb_layout == 'content-full-width' ) {
                    $sidebar_both = 'style="display:none;"'; 
                  } elseif($sb_layout == 'with-left-sidebar') {
                    $sidebar_right = 'style="display:none;"'; 
                  } elseif($sb_layout == 'with-right-sidebar') {
                    $sidebar_left = 'style="display:none;"'; 
                  }?>

                <div id="bpanel-widget-area-options" <?php echo 'class="attorneys-archives-layout" '.$sidebar_both;?>>

                  <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo $sidebar_left; ?>>
                    <!-- 2. Standard Sidebar Left Start -->
                    <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                      <h6><?php esc_html_e('Show Standard Left Sidebar', 'veda');?></label></h6>
                      <?php veda_switch("",'pageoptions','show-standard-left-sidebar-for-attorney_departments'); ?>
                    </div><!-- Standard Sidebar Left End-->
                  </div>

                  <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo $sidebar_right; ?>>
                    <!-- 3. Standard Sidebar Right Start -->
                    <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                      <h6><?php esc_html_e('Show Standard Right Sidebar', 'veda');?></label></h6>
                      <?php veda_switch("",'pageoptions','show-standard-right-sidebar-for-attorney_departments'); ?>
                    </div><!-- Standard Sidebar Right End-->
                  </div>
                </div>
              </div>
              <!-- Taxonomy Page Settings -->

              <!-- Permalink-->
                <div class="box-title">
                  <h3><?php esc_html_e('Permalinks', 'veda');?></h3>
                </div>

                <div class="box-content">
                  <div class="column one-third"><label><?php esc_html_e('Single Attorney slug', 'veda');?></label></div>
                  <div class="column two-third last">
                    <input name="dttheme[pageoptions][single-attorney-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','single-attorney-slug')));?>" />
                    <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. attorney-item <br> <b>After made changes save permalinks.</b>', 'veda');?></p>
                  </div>
                  <div class="hr"></div>

                  <div class="column one-third"><label><?php esc_html_e('Attorney Department slug', 'veda');?></label></div>
                  <div class="column two-third last">
                    <input name="dttheme[pageoptions][attorney-department-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','attorney-department-slug')));?>" />
                    <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. attorney-types <br> <b>After made changes save permalinks.</b>', 'veda');?></p>
                  </div>
                  <div class="hr"></div>

                  <div class="column one-half">
                    <label><?php esc_html_e('Singular Attorney Name', 'veda');?></label>
                    <div class="clear"></div>
                    <input name="dttheme[pageoptions][singular-attorney-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-attorney-name')));?>" />
                    <p class="note"><?php esc_html_e('By default "Attorney", save options & reload.', 'veda');?></p>
                    <div class="hr"></div>
                  </div>
                  <div class="column one-half last">
                    <label><?php esc_html_e('Plural Attorney Name', 'veda');?></label>
                    <div class="clear"></div>
                    <input name="dttheme[pageoptions][plural-attorney-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-attorney-name')));?>" />
                    <p class="note"><?php esc_html_e('By default "Attorneys". save options & reload.', 'veda');?></p>
                    <div class="hr"></div>
                  </div>

                  <div class="column one-half">
                    <label><?php esc_html_e('Singular Attorney Department Name', 'veda');?></label>
                    <div class="clear"></div>
                    <input name="dttheme[pageoptions][singular-attorney-tax-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-attorney-tax-name')));?>" />
                    <p class="note"><?php esc_html_e('By default "Department". save options & reload.', 'veda');?></p>
                    <div class="hr"></div>
                  </div>
                  <div class="column one-half last">
                    <label><?php esc_html_e('Plural Attorney Department Name', 'veda');?></label>
                    <div class="clear"></div>
                      <input name="dttheme[pageoptions][plural-attorney-tax-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-attorney-tax-name')));?>" />
                      <p class="note"><?php esc_html_e('By default "Departments". save options & reload.', 'veda');?></p>
                      <div class="hr"></div>
                  </div>                              
                </div>
              <!-- Permalink-->
            </div><!-- .bpanel-box end -->
        </div><!-- #tab1 End -->
    </div><!-- .bpanel-main-content end-->
</div><!-- #attorney end-->