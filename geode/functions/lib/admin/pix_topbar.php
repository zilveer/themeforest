<?php

function top_bar(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='top_bar') {

?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Top bar','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        
                <?php
                    $pix_geode_array_topleft_icon = get_option('pix_geode_array_topleft_icon_'); 
                    echo '<input type="hidden" name="pix_geode_array_topleft_icon_" value="">';
                    $pix_geode_array_topright_icon = get_option('pix_geode_array_topright_icon_'); 
                    echo '<input type="hidden" name="pix_geode_array_topright_icon_" value="">';
                ?>

                <div class="pix_columns cf">
                    <div class="tip_info large">
                        <?php _e('What is the top bar?','geode'); ?> <a href="#" data-dialog="<?php _e('Where available (not on this page, for instance) your options will be saved without refreshing the page.<br>If you encounter any problem just switch this field off.','geode'); ?>"><?php _e('More info','geode'); ?></a>
                    </div><!-- .tip_info -->
                    <br>

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_style_topbar_display"><?php _e('Display the top bar','geode'); ?>:
                            <input type="hidden" name="pix_style_topbar_display" value="0">
                            <input type="checkbox" id="pix_style_topbar_display" name="pix_style_topbar_display" value="true" <?php checked( get_option('pix_style_topbar_display'), 'true' ); ?>>
                            <span></span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_topbar_height"><?php _e('Height of the topbar (in pixels)', 'geode'); ?> <small><a href="#" data-dialog="<?php _e('The value must be bigger than the height of the header (on Geode &rarr; General &rarr; Header)','geode'); ?>"><?php _e('more info','geode'); ?></a></small>:</label>
                        <div class="slider_div">
                            <input id="pix_style_topbar_height" name="pix_style_topbar_height" type="text" value="<?php echo esc_attr(get_option('pix_style_topbar_height')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_topbar_fontsize"><?php _e('Font size (in rems)', 'geode'); ?>:</label>
                        <div class="slider_div em">
                            <input id="pix_style_topbar_fontsize" name="pix_style_topbar_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_topbar_fontsize')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pix_style_topbar_group_break"><?php _e('Size under what to display the elements below as a group (in pixels)', 'geode'); ?>:</label>
                        <input id="pix_style_topbar_group_break" name="pix_style_topbar_group_break" type="text" value="<?php echo esc_attr(get_option('pix_style_topbar_group_break')); ?>">
                        <br>

                    </div><!-- .pix_column.second -->
                </div><!-- .pix_columns -->

                <hr>

                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <h4><?php _e('Elements on the left side', 'geode'); ?></h4>

                        <div class="pix-sorting">

                            <div class="pix-sorting-elem hidden clone">
                                <div class="edit-element"><i class="scicon-awesome-pencil"></i></div><!-- .edit-element -->
                                <div class="move-element"><i class="scicon-awesome-move"></i></div><!-- .move-element -->
                                <div class="delete-element"><i class="scicon-awesome-trash"></i></div><!-- .delete-element -->

                                <div class="element-content">
                                    <dl>
                                        <dt><?php _e('Link','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="link" data-clone="pix_geode_array_topleft_icon_[i][link]"></dd>
                                        <dt><?php _e('Target','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="target" data-clone="pix_geode_array_topleft_icon_[i][target]" value="_blank"></dd>
                                        <dt><?php _e('Icon color','geode'); ?>:</dt>
                                            <dd><input type="hidden" readOnly="true" data-name="color" data-clone="pix_geode_array_topleft_icon_[i][color]" value=""><span class="color-preview" data-color="color" style="background-color:"></span></dd>
                                        <dt><?php _e('Sidebar on hover','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="sidebar" data-clone="pix_geode_array_topleft_icon_[i][sidebar]"></dd>
                                        <dt><?php _e('Text','geode'); ?>:</dt>
                                            <dd><textarea readOnly="true" data-name="text" data-clone="pix_geode_array_topleft_icon_[i][text]"></textarea></dd>
                                    </dl>
                                </div><!-- .element-content -->

                                <input type="hidden" readOnly="true" data-name="icon" data-clone="pix_geode_array_topleft_icon_[i][icon]">
                                <div class="icon-preview"><i data-class="icon"></i></div>
                                <input type="hidden" readOnly="true" data-name="exclude" data-clone="pix_geode_array_topleft_icon_[i][exclude]">
                            </div><!-- .pix-sorting-elem -->


                        <?php 

                            $i = 0;
                            if ( isset($pix_geode_array_topleft_icon[$i]) && $pix_geode_array_topleft_icon[$i]!='' ) {
                                while($i<count($pix_geode_array_topleft_icon)) {
                        ?>

                            <div class="pix-sorting-elem">
                                <div class="edit-element"><i class="scicon-awesome-pencil"></i></div><!-- .edit-element -->
                                <div class="move-element"><i class="scicon-awesome-move"></i></div><!-- .move-element -->
                                <div class="delete-element"><i class="scicon-awesome-trash"></i></div><!-- .delete-element -->

                                <div class="element-content">
                                    <dl>
                                        <dt><?php _e('Link','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="link" name="pix_geode_array_topleft_icon_[<?php echo $i; ?>][link]" value="<?php if(isset($pix_geode_array_topleft_icon[$i]['link'])) { echo esc_attr($pix_geode_array_topleft_icon[$i]['link']); } ?>"></dd>
                                        <dt><?php _e('Target','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="target" name="pix_geode_array_topleft_icon_[<?php echo $i; ?>][target]" value="<?php if(isset($pix_geode_array_topleft_icon[$i]['target'])) { echo esc_attr($pix_geode_array_topleft_icon[$i]['target']); } ?>"></dd>
                                        <dt><?php _e('Icon color','geode'); ?>:</dt>
                                            <dd><input type="hidden" readOnly="true" data-name="color" name="pix_geode_array_topleft_icon_[<?php echo $i; ?>][color]" value="<?php if(isset($pix_geode_array_topleft_icon[$i]['color'])) { echo esc_attr($pix_geode_array_topleft_icon[$i]['color']); } ?>"><span class="color-preview" data-color="color" <?php if(isset($pix_geode_array_topleft_icon[$i]['color'])) { echo 'style="background-color:'.esc_attr($pix_geode_array_topleft_icon[$i]['color']).'"'; } ?>></span></dd>
                                        <dt><?php _e('Sidebar on hover','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="sidebar" name="pix_geode_array_topleft_icon_[<?php echo $i; ?>][sidebar]" value="<?php if(isset($pix_geode_array_topleft_icon[$i]['sidebar'])) { echo esc_attr($pix_geode_array_topleft_icon[$i]['sidebar']); } ?>"></dd>
                                        <dt><?php _e('Text','geode'); ?>:</dt>
                                            <dd><textarea readOnly="true" data-name="text" name="pix_geode_array_topleft_icon_[<?php echo $i; ?>][text]"><?php if(isset($pix_geode_array_topleft_icon[$i]['text'])) { echo esc_attr(stripslashes($pix_geode_array_topleft_icon[$i]['text'])); } ?></textarea></dd>
                                    </dl>
                                </div><!-- .element-content -->

                                <input type="hidden" readOnly="true" data-name="exclude" name="pix_geode_array_topleft_icon_[<?php echo $i; ?>][exclude]" value="<?php if(isset($pix_geode_array_topleft_icon[$i]['exclude'])) { echo esc_attr($pix_geode_array_topleft_icon[$i]['exclude']); } ?>">
                                <input type="hidden" readOnly="true" data-name="icon" name="pix_geode_array_topleft_icon_[<?php echo $i; ?>][icon]" value="<?php if(isset($pix_geode_array_topleft_icon[$i]['icon'])) { echo esc_attr($pix_geode_array_topleft_icon[$i]['icon']); } ?>">
                                <div class="icon-preview"><i data-class="icon" class="<?php if(isset($pix_geode_array_topleft_icon[$i]['icon'])) { echo esc_attr($pix_geode_array_topleft_icon[$i]['icon']); } ?>"></i></div>
                            </div><!-- .pix-sorting-elem -->

                        <?php
                                    $i++;
                                } 
                            }
                        ?>

                           <a href="#" class="pix_button alignright add-element"><?php _e('Add an element','geode'); ?></a>
                        </div><!-- .pix-sorting -->

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <h4><?php _e('Elements on the right side','geode'); ?></h4>

                        <div class="pix-sorting">

                            <div class="pix-sorting-elem hidden clone">
                                <div class="edit-element"><i class="scicon-awesome-pencil"></i></div><!-- .edit-element -->
                                <div class="move-element"><i class="scicon-awesome-move"></i></div><!-- .move-element -->
                                <div class="delete-element"><i class="scicon-awesome-trash"></i></div><!-- .delete-element -->

                                <div class="element-content">
                                    <dl>
                                        <dt><?php _e('Link','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="link" data-clone="pix_geode_array_topright_icon_[i][link]"></dd>
                                        <dt><?php _e('Target','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="target" data-clone="pix_geode_array_topright_icon_[i][target]" value="_blank"></dd>
                                        <dt><?php _e('Icon color','geode'); ?>:</dt>
                                            <dd><input type="hidden" readOnly="true" data-name="color" data-clone="pix_geode_array_topright_icon_[i][color]" value=""><span class="color-preview" data-color="color" style="background-color:"></span></dd>
                                        <dt><?php _e('Sidebar on hover','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="sidebar" data-clone="pix_geode_array_topright_icon_[i][sidebar]"></dd>
                                        <dt><?php _e('Text','geode'); ?>:</dt>
                                            <dd><textarea readOnly="true" data-name="text" data-clone="pix_geode_array_topright_icon_[i][text]"></textarea></dd>
                                    </dl>
                                </div><!-- .element-content -->

                                <input type="hidden" readOnly="true" data-name="icon" data-clone="pix_geode_array_topright_icon_[i][icon]">
                                <div class="icon-preview"><i data-class="icon"></i></div>
                                <input type="hidden" readOnly="true" data-name="exclude" data-clone="pix_geode_array_topright_icon_[i][exclude]">
                            </div><!-- .pix-sorting-elem -->


                        <?php 

                            $i = 0;
                            if ( isset($pix_geode_array_topright_icon[$i]) && $pix_geode_array_topright_icon[$i]!='' ) {
                                while($i<count($pix_geode_array_topright_icon)) {
                        ?>

                            <div class="pix-sorting-elem">
                                <div class="edit-element"><i class="scicon-awesome-pencil"></i></div><!-- .edit-element -->
                                <div class="move-element"><i class="scicon-awesome-move"></i></div><!-- .move-element -->
                                <div class="delete-element"><i class="scicon-awesome-trash"></i></div><!-- .delete-element -->

                                <div class="element-content">
                                    <dl>
                                        <dt><?php _e('Link','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="link" name="pix_geode_array_topright_icon_[<?php echo $i; ?>][link]" value="<?php if(isset($pix_geode_array_topright_icon[$i]['link'])) { echo esc_attr($pix_geode_array_topright_icon[$i]['link']); } ?>"></dd>
                                        <dt><?php _e('Target','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="target" name="pix_geode_array_topright_icon_[<?php echo $i; ?>][target]" value="<?php if(isset($pix_geode_array_topright_icon[$i]['target'])) { echo esc_attr($pix_geode_array_topright_icon[$i]['target']); } ?>"></dd>
                                        <dt><?php _e('Icon color','geode'); ?>:</dt>
                                            <dd><input type="hidden" readOnly="true" data-name="color" name="pix_geode_array_topright_icon_[<?php echo $i; ?>][color]" value="<?php if(isset($pix_geode_array_topright_icon[$i]['color'])) { echo esc_attr($pix_geode_array_topright_icon[$i]['color']); } ?>"><span class="color-preview" data-color="color" style="background-color:<?php if(isset($pix_geode_array_topright_icon[$i]['color'])) { echo esc_attr($pix_geode_array_topright_icon[$i]['color']); } else { esc_attr(get_option('pix_style_topbar_color')); } ?>";></span></dd>
                                        <dt><?php _e('Sidebar on hover','geode'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="sidebar" name="pix_geode_array_topright_icon_[<?php echo $i; ?>][sidebar]" value="<?php if(isset($pix_geode_array_topright_icon[$i]['sidebar'])) { echo esc_attr($pix_geode_array_topright_icon[$i]['sidebar']); } ?>"></dd>
                                        <dt><?php _e('Text','geode'); ?>:</dt>
                                            <dd><textarea readOnly="true" data-name="text" name="pix_geode_array_topright_icon_[<?php echo $i; ?>][text]"><?php if(isset($pix_geode_array_topright_icon[$i]['text'])) { echo esc_attr(stripslashes($pix_geode_array_topright_icon[$i]['text'])); } ?></textarea></dd>
                                    </dl>
                                </div><!-- .element-content -->

                                <input type="hidden" readOnly="true" data-name="exclude" name="pix_geode_array_topright_icon_[<?php echo $i; ?>][exclude]" value="<?php if(isset($pix_geode_array_topright_icon[$i]['exclude'])) { echo esc_attr($pix_geode_array_topright_icon[$i]['exclude']); } ?>">
                                <input type="hidden" readOnly="true" data-name="icon" name="pix_geode_array_topright_icon_[<?php echo $i; ?>][icon]" value="<?php if(isset($pix_geode_array_topright_icon[$i]['icon'])) { echo esc_attr($pix_geode_array_topright_icon[$i]['icon']); } ?>">
                                <div class="icon-preview"><i data-class="icon" class="<?php if(isset($pix_geode_array_topright_icon[$i]['icon'])) { echo esc_attr($pix_geode_array_topright_icon[$i]['icon']); } ?>"></i></div>
                            </div><!-- .pix-sorting-elem -->

                        <?php
                                    $i++;
                                } 
                            }
                        ?>

                           <a href="#" class="pix_button alignright add-element"><?php _e('Add an element','geode'); ?></a>
                        </div><!-- .pix-sorting -->

                    </div><!-- .pix_column.second -->
                </div><!-- .pix_columns -->

                <div class="clear"></div>

                <input type="hidden" name="action" value="data_save" />
                <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>" />
                <button type="submit" class="pix-save-options pix_button fake_button alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <button type="submit" class="pix-save-options pix_button fake_button2 alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <button type="submit" class="pix-save-options pix_button alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <div id="gradient-save-button"></div>

<!-- #START: Hidden div to fill the icon fields -->

                <div class="dialog-edit-sorting-elements hidden" data-title="<?php _e('Edit','geode'); ?>">
                    <label for="icon-element-hide"><?php _e('Icon','geode'); ?>:</label>
                    <div class="clear"></div>
                    <input type="hidden" data-id="icon-element-hide-hidden" data-name="icon">
                    <div class="icon-preview alignleft"><i></i></div><!-- .icon-preview -->
                    <a class="pix_button icon-preview-edit alignleft" href="#"><i class="scicon-awesome-pencil"></i></a>
                    <a class="pix_button icon-remove alignleft" href="#"><i class="scicon-awesome-cancel"></i></a>

                    <div class="clear"></div>

                    <label for="link-element-hide"><?php _e('Link URL','geode'); ?>:</label>
                    <input type="text" data-name="link" id="link-element-hide">

                    <label class="for_select" for="target-element-hide"><?php _e('Open the link in','geode'); ?>:
                        <span class="for_select">
                            <select type="text" data-name="target" data-id="target-element-hide">
                                <option value="_self"><?php _e('the same window','geode'); ?></option>
                                <option value="_blank"><?php _e('a new window','geode'); ?> </option>
                            </select>
                        </span>
                    </label>
                    <br>

                    <label for="color-element-hide"><?php _e('Icon color (leave blank to inherit)','geode'); ?>:</label>
                    <div class="pix_color_picker">
                        <input data-id="color-element-hide" type="text" value="#000000" data-name="color" >
                        <a class="pix_button" href="#"></a>
                        <div class="colorpicker"></div>
                        <i class="scicon-iconic-cancel"></i>
                    </div>

                    <label class="for_select" for="sidebar-element-hide"><?php _e('Sidebar on hover','geode'); ?>:
                        <span class="for_select">
                            <select data-name="sidebar" data-id="sidebar-element-hide">
                                <option value=""><?php _e('select an option...','geode'); ?></option>
                                <?php
                                    $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];

                                    foreach ($get_sidebar_options as $sidebar) {
                                        echo '<option value="'.ucwords( $sidebar['id'] ).'">'.ucwords( $sidebar['name'] ).'</option>';
                                    }
                                ?>
                            </select>
                        </span>
                    </label>
                    <br>

                    <label for="text-element-hide"><?php _e('Text','geode'); ?>:</label>
                    <textarea data-id="text-element-hide" data-name="text"></textarea>

                    <label for="exclude-element-hide"><?php _e('Exclude from group','geode'); ?>:
                        <input type="checkbox" data-name="exclude" data-id="exclude-element-hide" value="true">
                        <span></span>
                   </label>

                </div><!-- .dialog-edit-sorting-elements -->
<!-- #END: Hidden div to fill the icon fields -->


            </form><!-- .dynamic_form -->

        </section><!-- #pix_content_loaded -->
</div>


<?php }
} ?>