<?php

function portfolio_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='portfolio_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('Portfolio','geode'); ?>: <small><?php _e('Portfolio archives','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        


                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pix_style_portfolio_page_base" class="for_select"><?php _e('Page to use as base for breadcrumbs','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_page_base" name="pix_style_portfolio_page_base">
                                    <option value="" <?php echo selected( get_option('pix_style_portfolio_page_base'), '' ); ?>><?php _e('Use the general archive page', 'geode'); ?></option>
                                    <?php 
                                    $args_pages = array('post_status' => 'publish,private');
                                    $pages = get_pages($args_pages); 
                                    $pp_space = '';
                                    $parent = '';
                                    foreach ( $pages as $page ) {
                                        if ( $page->post_parent != '0' ) {
                                            if ( $parent == $page->post_parent ) {
                                                $pp_space = '&nbsp&nbsp';
                                            } else {
                                                $parent = $page->post_parent;
                                                $pp_space = $pp_space.'&nbsp&nbsp';
                                            }
                                        } else {
                                            $pp_space = '';
                                            $parent = '';
                                        }
                                        $option = '<option '.selected( get_option('pix_style_portfolio_page_base'),  $page->ID, false ). 'value="' .  $page->ID . '">';
                                        $option .= $pp_space.$page->post_title;
                                        $option .= '</option>';
                                        echo $option;
                                    }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_list_layout" class="for_select"><?php _e('Layout','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_list_layout" name="pix_style_portfolio_list_layout">
                                    <option value="1:1" <?php selected(get_option('pix_style_portfolio_list_layout'),'1:1'); ?>><?php _e( 'Grid of square thumbs', 'geode' ); ?></option>
                                    <option value="4:3" <?php selected(get_option('pix_style_portfolio_list_layout'),'4:3'); ?>><?php _e( 'Grid of 4:3 thumbs', 'geode' ); ?></option>
                                    <option value="16:9" <?php selected(get_option('pix_style_portfolio_list_layout'),'16:9'); ?>><?php _e( 'Grid of 16:9 thumbs', 'geode' ); ?></option>
                                    <option value="grid" <?php selected(get_option('pix_style_portfolio_list_layout'),'grid'); ?>><?php _e( 'Grid of original ratio thumbs', 'geode' ); ?></option>
                                    <option value="masonry" <?php selected(get_option('pix_style_portfolio_list_layout'),'masonry'); ?>><?php _e( 'Masonry grid (original ratio)', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_text_position" class="for_select"><?php _e('Text position','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_text_position" name="pix_style_portfolio_text_position">
                                    <option value='fancy' <?php selected(get_option('pix_style_portfolio_text_position'),'fancy'); ?>><?php _e('fancy','geode'); ?></option>
                                    <option value='below' <?php selected(get_option('pix_style_portfolio_text_position'),'below'); ?>><?php _e('below','geode'); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_content_portfolio_list_sidebar" class="for_select"><?php _e('Sidebar (primary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_portfolio_list_sidebar" name="pix_content_portfolio_list_sidebar">
                                    <option value="" <?php selected(get_option('pix_content_portfolio_list_sidebar'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_portfolio_list_sidebar'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_content_portfolio_list_sidebar_2" class="for_select"><?php _e('Sidebar (secondary)','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_portfolio_list_sidebar_2" name="pix_content_portfolio_list_sidebar_2">
                                    <option value="" <?php selected(get_option('pix_content_portfolio_list_sidebar_2'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <?php
                                        $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                                        foreach ($get_sidebar_options as $sideb) {
                                            echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(get_option('pix_content_portfolio_list_sidebar_2'),ucwords( $sideb['id'] )) .'>'.ucwords( $sideb['name'] ).'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_list_bg" class="for_select"><?php _e('Background','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_list_bg" name="pix_style_portfolio_list_bg">
                                    <option value="" <?php selected(get_option('pix_style_portfolio_list_bg'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_portfolio_list_bg'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_portfolio_list_bg'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_list_bg_img"><?php _e('Upload a body background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_portfolio_list_bg_img'); ?>" name="pix_style_portfolio_list_bg_img" id="pix_style_portfolio_list_bg_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_portfolio_list_link" class="for_select"><?php _e('Link to...','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_list_link" name="pix_style_portfolio_list_link">
                                    <option value="none" <?php selected(get_option('pix_style_portfolio_list_link'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="post" <?php selected(get_option('pix_style_portfolio_list_link'),'post'); ?>><?php _e( 'Post', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_portfolio_list_link'),'image'); ?>><?php _e( 'Image (with ColorBox if active)', 'geode' ); ?></option>
                                    <option value="both" <?php selected(get_option('pix_style_portfolio_list_link'),'both'); ?>><?php _e( 'Both', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_list_orderby" class="for_select"><?php _e('Order by','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_list_orderby" name="pix_style_portfolio_list_orderby">
                                    <option value="" <?php selected(get_option('pix_style_portfolio_list_orderby'),''); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="ID" <?php selected(get_option('pix_style_portfolio_list_orderby'),'ID'); ?>><?php _e( 'ID', 'geode' ); ?></option>
                                    <option value="title" <?php selected(get_option('pix_style_portfolio_list_orderby'),'title'); ?>><?php _e( 'title', 'geode' ); ?></option>
                                    <option value="name" <?php selected(get_option('pix_style_portfolio_list_orderby'),'name'); ?>><?php _e( 'name', 'geode' ); ?></option>
                                    <option value="date" <?php selected(get_option('pix_style_portfolio_list_orderby'),'date'); ?>><?php _e( 'date', 'geode' ); ?></option>
                                    <option value="rand" <?php selected(get_option('pix_style_portfolio_list_orderby'),'rand'); ?>><?php _e( 'random', 'geode' ); ?></option>
                                    <option value="menu_order" <?php selected(get_option('pix_style_portfolio_list_orderby'),'menu_order'); ?>><?php _e( 'menu_order', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_portfolio_list_columns" class="for_select"><?php _e('Grid','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_list_columns" name="pix_style_portfolio_list_columns">
                                    <option value="2" <?php selected(get_option('pix_style_portfolio_list_columns'),'2'); ?>><?php _e( '2 columns', 'geode' ); ?></option>
                                    <option value="3" <?php selected(get_option('pix_style_portfolio_list_columns'),'3'); ?>><?php _e( '3 columns', 'geode' ); ?></option>
                                    <option value="4" <?php selected(get_option('pix_style_portfolio_list_columns'),'4'); ?>><?php _e( '4 columns', 'geode' ); ?></option>
                                    <option value="5" <?php selected(get_option('pix_style_portfolio_list_columns'),'5'); ?>><?php _e( '5 columns', 'geode' ); ?></option>
                                    <option value="6" <?php selected(get_option('pix_style_portfolio_list_columns'),'6'); ?>><?php _e( '6 columns', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_list_gutter" class="for_select"><?php _e('Gutter (%)','geode'); ?>:</label>
                        <div class="slider_div percent">
                            <input id="pix_style_portfolio_list_gutter" name="pix_style_portfolio_list_gutter" type="text" value="<?php echo esc_attr(get_option('pix_style_portfolio_list_gutter')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>
                        
                        <label for="pix_style_portfolio_template" class="for_select"><?php _e('Page template','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_template" name="pix_style_portfolio_template">
                                    <option value='default' <?php selected(get_option('pix_style_portfolio_template'),'default'); ?>><?php _e('Default Template','geode'); ?></option>
                                    <option value='templates/wide-page.php' <?php selected(get_option('pix_style_portfolio_template'),'templates/wide-page.php'); ?>><?php _e('Wide Page Template','geode'); ?></option>
                                    <option value='templates/double-side-page.php' <?php selected(get_option('pix_style_portfolio_template'),'templates/double-side-page.php'); ?>><?php _e('Double sidebar Page Template','geode'); ?></option>
                                    <option value='templates/full-width-page.php' <?php selected(get_option('pix_style_portfolio_template'),'templates/full-width-page.php'); ?>><?php _e('Full-width Page Template','geode'); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_title_color"><?php _e('Text color of the title section','geode'); ?>:</label>
                        <div class="pix_color_picker">
                            <input id="pix_style_portfolio_title_color" type="text" value="<?php echo esc_attr(get_option('pix_style_portfolio_title_color')); ?>" name="pix_style_portfolio_title_color" >
                            <a class="pix_button" href="#"></a>
                            <div class="colorpicker"></div>
                            <i class="scicon-iconic-cancel"></i>
                        </div>
                        <br>

                        <label for="pix_style_portfolio_list_bg_title" class="for_select"><?php _e('Background of the title section','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_list_bg_title" name="pix_style_portfolio_list_bg_title">
                                    <option value="" <?php selected(get_option('pix_style_portfolio_list_bg_title'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="none" <?php selected(get_option('pix_style_portfolio_list_bg_title'),'none'); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="image" <?php selected(get_option('pix_style_portfolio_list_bg_title'),'image'); ?>><?php _e( 'Fixed image', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_list_bg_title_img"><?php _e('Upload a title background image','geode'); ?>:</label>
                        <div class="pix_upload upload_image">
                            <input type="text" value="<?php echo get_option('pix_style_portfolio_list_bg_title_img'); ?>" name="pix_style_portfolio_list_bg_title_img" id="pix_style_portfolio_list_bg_title_img">
                            <span class="img_preview"></span>
                            <a class="pix_button" href="#"><?php _e('Insert','geode'); ?></a>
                        </div>
                        <br>

                        <label for="pix_style_portfolio_list_pagination" class="for_select"><?php _e('Page navigation','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_list_pagination" name="pix_style_portfolio_list_pagination">
                                    <option value="numbers" <?php selected(get_option('pix_style_portfolio_list_pagination'),'numbers'); ?>><?php _e( 'Numbers', 'geode' ); ?></option>
                                    <option value="infinite" <?php selected(get_option('pix_style_portfolio_list_pagination'),'infinite'); ?>><?php _e( 'Infinite button', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_portfolio_list_order" class="for_select"><?php _e('Order','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_portfolio_list_order" name="pix_style_portfolio_list_order">
                                    <option value="" <?php selected(get_option('pix_style_portfolio_list_order'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="DESC" <?php selected(get_option('pix_style_portfolio_list_order'),'DESC'); ?>><?php _e( 'DESC', 'geode' ); ?></option>
                                    <option value="ASC" <?php selected(get_option('pix_style_portfolio_list_order'),'ASC'); ?>><?php _e( 'ASC', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.second -->

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