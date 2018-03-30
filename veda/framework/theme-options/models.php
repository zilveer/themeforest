<!-- #pageoptions -->
<div id="models" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">

        <ul class="sub-panel"> 
			<li><a href="#tab1"><?php esc_html_e('Models', 'veda');?></a></li>
        </ul>
        
        <!-- #tab1 - Model Custom Post Type -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">

              <div class="box-title">
                <h3><?php esc_html_e('Model Custom Fields', 'veda');?></h3>
              </div>

              <div class="box-content">
                  <div class="portfolio-custom-fields">
                    <input type="button" class="black add-custom-field" value="<?php esc_attr_e('Add New Field', 'veda');?>" />
                    <div class="hr_invisible"> </div>
                    <?php $custom_fields = veda_option("pageoptions","model-custom-fields");
                      $custom_fields = is_array($custom_fields) ? array_filter($custom_fields) : array();
                      $custom_fields = array_unique( $custom_fields);

                      foreach( $custom_fields as $field ){ ?>
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][model-custom-fields][]";?>" value="<?php echo esc_attr($field);?>">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                          </div><?php
                      } ?>

                      <div class="clone hidden">
                        <div class="custom-field-container">
                          <div class="hr_invisible"> </div>
                            <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][model-custom-fields][]";?>" value="">
                            <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                        </div>
                      </div>
                  </div>
              </div>

              <div class="box-title">
                <h3><?php esc_html_e('Permalinks', 'veda');?></h3>
              </div>

              <div class="box-content">
                <div class="column one-third"><label><?php esc_html_e('Single Model slug', 'veda');?></label></div>
                <div class="column two-third last">
                  <input name="dttheme[pageoptions][single-model-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','single-model-slug')));?>" />
                  <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. model-item <br> <b>After made changes save permalinks.</b>', 'veda');?></p>
                </div>
                <div class="hr"></div>

                <div class="column one-third"><label><?php esc_html_e('Model Category slug', 'veda');?></label></div>
                <div class="column two-third last">
                  <input name="dttheme[pageoptions][model-category-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','model-category-slug')));?>" />
                  <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. model-types <br> <b>After made changes save permalinks.</b>', 'veda');?></p>
                </div>
                <div class="hr"></div>

                <div class="column one-half">
                  <label><?php esc_html_e('Singular Model Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][singular-model-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-model-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Model", save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
                <div class="column one-half last">
                  <label><?php esc_html_e('Plural Model Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][plural-model-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-model-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Models". save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>

                <div class="column one-half">
                  <label><?php esc_html_e('Singular Model Category Name', 'veda');?></label>
                  <div class="clear"></div>
                  <input name="dttheme[pageoptions][singular-model-tax-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','singular-model-tax-name')));?>" />
                  <p class="note"><?php esc_html_e('By default "Category". save options & reload.', 'veda');?></p>
                  <div class="hr"></div>
                </div>
                <div class="column one-half last">
                  <label><?php esc_html_e('Plural Model Category Name', 'veda');?></label>
                  <div class="clear"></div>
                    <input name="dttheme[pageoptions][plural-model-tax-name]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','plural-model-tax-name')));?>" />
                    <p class="note"><?php esc_html_e('By default "Categories". save options & reload.', 'veda');?></p>
                    <div class="hr"></div>
                </div>                              
              </div>
            </div><!-- .bpanel-box end -->
        </div><!-- #tab1 End -->

    </div><!-- .bpanel-main-content end-->
</div><!-- #pageoptions end-->