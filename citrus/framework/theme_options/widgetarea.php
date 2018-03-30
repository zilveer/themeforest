<!-- #widgetarea -->
<div id="widgetarea" class="bpanel-content">

  <!-- .bpanel-main-content -->
  <div class="bpanel-main-content">
    <ul class="sub-panel widget-area-nav">
      <li><a href="#custom-widget-area-sidebars"><?php _e("For Sidebars",'dt_themes');?></a></li>
    </ul>

    <!-- Sidebar -->
    <div id="custom-widget-area-sidebars" class="tab-content">
      <div class="bpanel-box">
        <div class="box-title"><h3><?php _e('Create New Widget Area','dt_themes');?></h3></div>
        <div class="box-content">

          <p class="note"><?php _e("You can create widget areas here, and assign them in individual page/post for left, right or both sidebars",'dt_themes');?></p>
          <div class="bpanel-option-set">
            <input type="button" value="<?php _e('Add New Widget Area','dt_themes');?>" id="sidebars" class="black mytheme_add_widgetarea" />
            <div class="hr_invisible"></div><?php
              $widgets = dttheme_option('widgetarea','sidebars');
              $widgets = is_array($widgets) ? array_unique($widgets) : array();
              $widgets = array_filter($widgets);?>
          </div>
          <div class="bpanel-option-set">    
            <ul class="added-menu"><?php
                foreach( $widgets as $k => $v){?>
                    <li>
                      <div class="item-bar">
                        <span class="item-title"><?php _e('Widget Area:','dt_themes'); echo" $v";?></span>
                        <span class="item-control"><a class="item-edit"><?php _e('Edit','dt_themes');?></a></span>
                      </div>
                      <div class="item-content" style="display: none;">
                        <span><label><?php _e('Name','dt_themes');?></label><input type="text" name="mytheme[widgetarea][sidebars][]" class="social-link" value="<?php echo $v;?>" /></span>
                        <div class="remove-cancel-links">
                          <span class="remove-item"><?php _e('Remove','dt_themes');?></span>
                          <span class="meta-sep"> | </span>
                          <span class="cancel-item"><?php _e('Cancel','dt_themes');?></span>
                        </div>
                      </div>
                    </li><?php
                }?>
            </ul>

            <ul class="sample-to-edit" style="display:none;">
              <li>
                <div class="item-bar">
                  <span class="item-title"><?php _e('Widget Area','dt_themes');?></span>
                  <span class="item-control"><a class="item-edit"><?php _e('Edit','dt_themes');?></a></span>
                </div>

                <div class="item-content">
                  <span><label><?php _e('Name','dt_themes');?></label><input type="text" class="social-link" /></span>
                  <div class="remove-cancel-links">
                    <span class="remove-item"><?php _e('Remove','dt_themes');?></span>
                    <span class="meta-sep"> | </span>
                    <span class="cancel-item"><?php _e('Cancel','dt_themes');?></span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div><!-- Sidebar End -->
 
  </div><!-- .bpanel-main-content end-->
  
</div><!-- #widgetarea end -->