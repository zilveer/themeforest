<?php

function nav_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='nav_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');
    
?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Navigation menu','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">

                    <div class="pix_column alignleft">
                        <label for="pix_style_nav_mobile_size"><?php _e('Display as drop down button at width... (pixels)', 'geode'); ?> <small><a href="#" data-dialog="<?php _e('Set at what browser max-width you want that your main menu is displayed as a mobile one', 'geode'); ?>"><?php _e('more info','geode'); ?></a></small>:</label>
                        <div class="slider_div layout">
                            <input id="pix_style_nav_mobile_size" name="pix_style_nav_mobile_size" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_mobile_size')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                    </div><!-- .pix_column.second -->

                </div><!-- .pix_columns -->
                <div class="pix_columns cf">

                    <h4 class="section_title active"><span>First level menu</span></h4>

                    <div class="admin-section-toggle visible">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label for="pix_style_nav_color"><?php _e('Text color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav_color" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_color')); ?>" name="pix_style_nav_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_current_border"><?php _e('Border color for the current menu item','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_current_border" type="text" value="<?php echo esc_attr(get_option('pix_style_current_border')); ?>" name="pix_style_current_border" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_nav_lineheight"><?php _e('Line height (in pixels)', 'geode'); ?> <small><a href="#" data-dialog="<?php _e('Do not use value too low, otherwise the font-size will be bigger than the available space', 'geode'); ?>"><?php _e('pay attention','geode'); ?></a></small>:</label>
                            <div class="slider_div">
                                <input id="pix_style_nav_lineheight" name="pix_style_nav_lineheight" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_lineheight')); ?>">
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->
                            <br>

                            <label for="pix_style_nav_hover_color"><?php _e('Text color on hover','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav_hover_color" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_hover_color')); ?>" name="pix_style_nav_hover_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_nav_hover_bg"><?php _e('Background color on hover','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav_hover_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_hover_bg')); ?>" name="pix_style_nav_hover_bg" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <div class="load-icons">
                                <input type="hidden" name="pix_style_menu_search_icon" value="<?php echo get_option('pix_style_menu_search_icon'); ?>">
                                <div class="icon-preview alignleft"><i class="<?php echo get_option('pix_style_menu_search_icon'); ?>"></i></div><!-- .icon-preview -->
                                <label for="pix_content_menu_search_field" ><?php _e('Display the search icon in nav menu','geode'); ?>:
                                    <input type="hidden" name="pix_content_menu_search_field" value="0">
                                    <input type="checkbox" id="pix_content_menu_search_field" name="pix_content_menu_search_field" value="true" <?php checked( get_option('pix_content_menu_search_field'), 'true' ); ?>>
                                    <span></span>
                                    <br><small><?php _e('Click the icon if you want to change it','geode'); ?></small>
                                </label>
                            </div>
                            <br>
                            <br>

                            <?php if ( pix_is_woocommerce_active() ) { ?>

                            <div class="load-icons">
                                <input type="hidden" name="pix_style_menu_woo_icon" value="<?php echo get_option('pix_style_menu_woo_icon'); ?>">
                                <div class="icon-preview alignleft"><i class="<?php echo get_option('pix_style_menu_woo_icon'); ?>"></i></div><!-- .icon-preview -->
                                <label for="pix_content_menu_woo_field" ><?php _e('Display the shop cart in nav menu','geode'); ?>:
                                    <input type="hidden" name="pix_content_menu_woo_field" value="0">
                                    <input type="checkbox" id="pix_content_menu_woo_field" name="pix_content_menu_woo_field" value="true" <?php checked( get_option('pix_content_menu_woo_field'), 'true' ); ?>>
                                    <span></span>
                                    <br><small><?php _e('Click the icon if you want to change it','geode'); ?></small>
                                </label>
                            </div>
                            <br>
                            <br>

                            <?php } ?>

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_nav_icons" class="for_select"><?php _e('Position of the icons','geode'); ?>:
                                <span class="for_select">
                                    <select id="pix_style_nav_icons" name="pix_style_nav_icons">
                                         <option value="floating" <?php selected(get_option('pix_style_nav_icons'),'floating'); ?>><?php _e( 'floating', 'geode' ); ?></option>
                                         <option value="centered" <?php selected(get_option('pix_style_nav_icons'),'centered'); ?>><?php _e( 'centered', 'geode' ); ?></option>
                                    </select>
                                </span>
                            </label>
                            <br>
                            <br>

                            <label><?php _e('First level menu font','geode'); ?> <small><a href="#" data-dialog="<?php printf(__('Uppercase property is set in style.css. To remove it just go to Geode &rarr; Styles and type %s','geode'), '<pre>header#masthead #navbar > nav > div > ul > li > a {
text-transform: none;
}</pre>'); ?>"><?php _e('more info','geode'); ?></a></small>:</label>
                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_nav_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_nav_fontfamily" name="pix_style_nav_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_nav_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_nav_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_nav_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_nav_fontvariant" name="pix_style_nav_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_nav_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_nav_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_nav_fontsize"><?php _e('Font size (in pixels)', 'geode'); ?>:</label>
                                <div class="slider_div border">
                                    <input id="pix_style_nav_fontsize" name="pix_style_nav_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                            <br>

                            <label for="pix_style_post_type_search"><?php _e( 'Limit Search Results to these post types (if you don\'t select any is like if you select all of them', 'geode' ); ?>:</label>
                            <blockquote>
                            <?php   

                                $post_types = get_post_types(array( 'public' => true ));   

                                $pix_style_post_type_search = get_option('pix_style_post_type_search');

                                foreach ( $post_types as $post_type ) {
                                    if ( post_type_supports( $post_type, 'editor' ) ) {
                                        $object = get_post_type_object($post_type);
                                        $label = $object->label;
                                        $name = $object->name; ?>
                                        <label for="pix_style_post_type_search_<?php echo $name; ?>">
                                            <input type="hidden" name="pix_style_post_type_search[<?php echo $name; ?>]" value="0">
                                            <input type="checkbox" id="pix_style_post_type_search_<?php echo $name; ?>" name="pix_style_post_type_search[<?php echo $name; ?>]" value="<?php echo $name; ?>" <?php if (isset($pix_style_post_type_search[$name])) { checked( $pix_style_post_type_search[$name], $name ); } ?>>
                                            <span></span>
                                            <?php echo $label; ?>
                                        </label>
                                        <?php
                                    }
                                }
                            ?>
                            </blockquote>
                            <br>

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span><?php _e('Call to action button', 'geode'); ?></span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label for="pix_style_nav_color_cta"><?php _e('Text color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav_color_cta" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_color_cta')); ?>" name="pix_style_nav_color_cta" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_border_cta"><?php _e('Border color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_border_cta" type="text" value="<?php echo esc_attr(get_option('pix_style_border_cta')); ?>" name="pix_style_border_cta" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_bg_cta"><?php _e('Background color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_bg_cta" type="text" value="<?php echo esc_attr(get_option('pix_style_bg_cta')); ?>" name="pix_style_bg_cta" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_radius_cta"><?php _e('Border radius (in pixels)', 'geode'); ?>:</label>
                            <div class="slider_div">
                                <input id="pix_style_radius_cta" name="pix_style_radius_cta" type="text" value="<?php echo esc_attr(get_option('pix_style_radius_cta')); ?>">
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_hover_color_cta"><?php _e('Text color on hover','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_hover_color_cta" type="text" value="<?php echo esc_attr(get_option('pix_style_hover_color_cta')); ?>" name="pix_style_hover_color_cta" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_border_hover_cta"><?php _e('Border color on hover','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_border_hover_cta" type="text" value="<?php echo esc_attr(get_option('pix_style_border_hover_cta')); ?>" name="pix_style_border_hover_cta" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_bg_hover_cta"><?php _e('Background color on hover','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_bg_hover_cta" type="text" value="<?php echo esc_attr(get_option('pix_style_bg_hover_cta')); ?>" name="pix_style_bg_hover_cta" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_border_w_cta"><?php _e('Border width (in pixels)', 'geode'); ?>:</label>
                            <div class="slider_div border">
                                <input id="pix_style_border_w_cta" name="pix_style_border_w_cta" type="text" value="<?php echo esc_attr(get_option('pix_style_border_w_cta')); ?>">
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Centered header</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label for="pix_style_nav_border"><?php _e('Border color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav_border" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_border')); ?>" name="pix_style_nav_border" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_nav_background"><?php _e('Background color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav_background" type="text" value="<?php echo esc_attr(get_option('pix_style_nav_background')); ?>" name="pix_style_nav_background" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Second and next levels</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label for="pix_style_nav2nd_color"><?php _e('Text color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav2nd_color" type="text" value="<?php echo esc_attr(get_option('pix_style_nav2nd_color')); ?>" name="pix_style_nav2nd_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_nav2nd_bg"><?php _e('Background color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav2nd_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_nav2nd_bg')); ?>" name="pix_style_nav2nd_bg" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_nav2nd_border"><?php _e('Border top color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav2nd_border" type="text" value="<?php echo esc_attr(get_option('pix_style_nav2nd_border')); ?>" name="pix_style_nav2nd_border" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_nav2nd_border2"><?php _e('Color of the other borders','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav2nd_border2" type="text" value="<?php echo esc_attr(get_option('pix_style_nav2nd_border2')); ?>" name="pix_style_nav2nd_border2" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_nav2nd_hover_color"><?php _e('Text color on hover','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav2nd_hover_color" type="text" value="<?php echo esc_attr(get_option('pix_style_nav2nd_hover_color')); ?>" name="pix_style_nav2nd_hover_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_nav2nd_hover_bg"><?php _e('Background color descriptive sections','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_nav2nd_hover_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_nav2nd_hover_bg')); ?>" name="pix_style_nav2nd_hover_bg" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label><?php _e('Second and next levels font','geode'); ?>:</label>
                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_nav2nd_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_nav2nd_fontfamily" name="pix_style_nav2nd_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_nav2nd_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_nav2nd_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_nav2nd_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_nav2nd_fontvariant" name="pix_style_nav2nd_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_nav2nd_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_nav2nd_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_nav2nd_fontsize"><?php _e('Font size (in pixels)', 'geode'); ?>:</label>
                                <div class="slider_div border">
                                    <input id="pix_style_nav2nd_fontsize" name="pix_style_nav2nd_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_nav2nd_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                </div><!-- .pix_columns -->

                <div class="clear"></div>

                <input type="hidden" name="action" value="data_save" />
                <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>" />
                <button type="submit" class="pix-save-options pix_button fake_button alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <button type="submit" class="pix-save-options pix_button fake_button2 alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <button type="submit" class="pix-save-options pix_button alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <div id="gradient-save-button"></div>

            </form><!-- .dynamic_form -->

        </section><!-- #pix_content_loaded -->
</div>


<?php }
} ?>