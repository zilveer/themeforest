<!-- #widgetarea -->
<div id="widgetarea" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('Sidebar', 'veda');?></a></li>
        </ul>
        
        <!-- #tab1-custom-widgetarea -->
        <div id="tab1" class="tab-content">

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Create New Widget Area', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <p class="note"><?php esc_html_e("You can create widget areas here, and assign them in individual page / post", 'veda');?></p>
                    <div class="bpanel-option-set">
                        <input type="button" data-for="custom" value="<?php esc_attr_e('Add New Widget Area', 'veda');?>" class="black dttheme_add_widgetarea" />
                        <div class="hr_invisible"></div><?php
                        $widgets = veda_option('widgetarea','custom');
                        $widgets = is_array($widgets) ? array_unique($widgets) : array();
                        $widgets = array_filter($widgets); ?>
                    </div>
                    <div class="bpanel-option-set">
                      <ul class="added-menu"><?php
                          foreach( $widgets as $k => $v){?>
                              <li>
                                <div class="item-bar">
                                  <span class="item-title"><?php esc_html_e('Widget Area:', 'veda'); echo" $v";?></span>
                                  <span class="item-control"><a class="item-edit"><?php esc_html_e('Edit', 'veda');?></a></span>
                                </div>
                                <div class="item-content" style="display: none;">
                                  <span><label><?php esc_html_e('Name', 'veda');?></label><input type="text" name="dttheme[widgetarea][custom][]" class="social-link" value="<?php echo esc_attr($v);?>" /></span>
                                  <div class="remove-cancel-links">
                                    <span class="remove-item"><?php esc_html_e('Remove', 'veda');?></span>
                                    <span class="meta-sep"> | </span>
                                    <span class="cancel-item"><?php esc_html_e('Cancel', 'veda');?></span>
                                  </div>
                                </div>
                              </li><?php
                          }?>
                      </ul>

                      <ul class="sample-to-edit" style="display:none;">
                        <li>
                          <div class="item-bar">
                            <span class="item-title"><?php esc_html_e('Widget Area', 'veda');?></span>
                            <span class="item-control"><a class="item-edit"><?php esc_html_e('Edit', 'veda');?></a></span>
                          </div>

                          <div class="item-content">
                            <span><label><?php esc_html_e('Name', 'veda');?></label><input type="text" class="social-link" /></span>
                            <div class="remove-cancel-links">
                              <span class="remove-item"><?php esc_html_e('Remove', 'veda');?></span>
                              <span class="meta-sep"> | </span>
                              <span class="cancel-item"><?php esc_html_e('Cancel', 'veda');?></span>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Widget Styles', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-half">
						<h6><?php esc_html_e('Widget Title Style', 'veda');?></h6>
                        <div class="column one-fifth">
                            <select name="dttheme[widgetarea][wtitle-style]" class="dt-chosen-select"><?php
                                $selected = veda_option('widgetarea','wtitle-style');
                                $wtitle_styles = array( '' => esc_html__('Choose any  type', 'veda'), 'type1' => esc_html__('Double Border','veda'), 'type2' => esc_html__('Tooltip','veda'), 'type3' => esc_html__('Title Top Border','veda'),
								'type4' => esc_html__('Left Border & Pattren','veda'), 'type5' => esc_html__('Bottom Border','veda'), 'type6' => esc_html__('Tooltip Border','veda'), 'type7' => esc_html__('Boxed Modern','veda'), 'type8' => esc_html__('Elegant Border','veda'),
								'type9' => esc_html__('Needle','veda'), 'type10' => esc_html__('Ribbon','veda'), 'type11' => esc_html__('Content Background','veda'), 'type12' => esc_html__('Classic BG','veda'), 'type13' => esc_html__('Tiny Boders','veda'),
								'type14' => esc_html__('BG & Border','veda'), 'type15' => esc_html__('Classic BG Alt','veda'), 'type16' => esc_html__('Left Border & BG','veda'), 'type17' => esc_html__('Basic','veda'), 'type18' => esc_html__('BG & Pattern','veda'));
                                foreach( $wtitle_styles as $wt => $bv ):
                                    echo "<option value='{$wt}'".selected($selected,$wt,false).">{$bv}</option>";
                                endforeach;?></select>
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('Choose the style of widget title.', 'veda');?></p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div><!--#tab1-custom-widgetarea end-->

    </div><!-- .bpanel-main-content end-->
</div><!-- #widgetarea end-->