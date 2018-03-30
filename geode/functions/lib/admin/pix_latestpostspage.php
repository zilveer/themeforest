<?php

function latest_posts_page_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='latest_posts_page_panel') {
    
    $selected_font = get_option('pix_style_fonts_w_variants');
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Blog','geode'); ?>: <small><?php _e('Latest posts page','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_content_latest_post_page" class="for_select"><?php _e('Latest post static page', 'geode'); ?> <small>(<a href="#" data-dialog="<?php _e('Set a static page to use to define layout, background and other settings of your latest posts page if this coicides with your front page','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:
                            <span class="for_select">
                                <select id="pix_content_latest_post_page" name="pix_content_latest_post_page">
                                    <option value=""><?php _e('Select a page', ''); ?></option>
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
                                        $option = '<option '.selected( get_option('pix_content_latest_post_page'),  $page->ID, false ). 'value="' .  $page->ID . '">';
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

                        <label for="pix_style_latest_post_page_layout" class="for_select"><?php _e('Layout','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_latest_post_page_layout" name="pix_style_latest_post_page_layout">
                                    <option value="standard" <?php selected(get_option('pix_style_latest_post_page_layout'),'standard'); ?>><?php _e( 'Standard blog', 'geode' ); ?></option>
                                    <option value="masonry" <?php selected(get_option('pix_style_latest_post_page_layout'),'masonry'); ?>><?php _e( 'Masonry grid', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_latest_post_page_pagination" class="for_select"><?php _e('Pagination','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_latest_post_page_pagination" name="pix_style_latest_post_page_pagination">
                                    <option value="numbers" <?php selected(get_option('pix_style_latest_post_page_pagination'),'numbers'); ?>><?php _e( 'Numbers', 'geode' ); ?></option>
                                    <option value="infinite" <?php selected(get_option('pix_style_latest_post_page_pagination'),'infinite'); ?>><?php _e( 'Infinite button', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_latest_post_page_order" class="for_select"><?php _e('Order','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_latest_post_page_order" name="pix_style_latest_post_page_order">
                                    <option value="" <?php selected(get_option('pix_style_latest_post_page_order'),''); ?>><?php _e( 'Default', 'geode' ); ?></option>
                                    <option value="DESC" <?php selected(get_option('pix_style_latest_post_page_order'),'DESC'); ?>><?php _e( 'DESC', 'geode' ); ?></option>
                                    <option value="ASC" <?php selected(get_option('pix_style_latest_post_page_order'),'ASC'); ?>><?php _e( 'ASC', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_style_latest_post_page_gutter" class="for_select"><?php _e('Gutter (%)','geode'); ?>:</label>
                        <div class="slider_div percent">
                            <input id="pix_style_latest_post_page_gutter" name="pix_style_latest_post_page_gutter" type="text" value="<?php echo esc_attr(get_option('pix_style_latest_post_page_gutter')); ?>">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>
                        
                        <label for="pix_style_latest_post_page_columns" class="for_select"><?php _e('Grid','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_latest_post_page_columns" name="pix_style_latest_post_page_columns">
                                    <option value="2" <?php selected(get_option('pix_style_latest_post_page_columns'),'2'); ?>><?php _e( '2 columns', 'geode' ); ?></option>
                                    <option value="3" <?php selected(get_option('pix_style_latest_post_page_columns'),'3'); ?>><?php _e( '3 columns', 'geode' ); ?></option>
                                    <option value="4" <?php selected(get_option('pix_style_latest_post_page_columns'),'4'); ?>><?php _e( '4 columns', 'geode' ); ?></option>
                                    <option value="5" <?php selected(get_option('pix_style_latest_post_page_columns'),'5'); ?>><?php _e( '5 columns', 'geode' ); ?></option>
                                    <option value="6" <?php selected(get_option('pix_style_latest_post_page_columns'),'6'); ?>><?php _e( '6 columns', 'geode' ); ?></option>
                                </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pix_style_latest_post_page_orderby" class="for_select"><?php _e('Order by','geode'); ?>:
                            <span class="for_select">
                                <select id="pix_style_latest_post_page_orderby" name="pix_style_latest_post_page_orderby">
                                    <option value="" <?php selected(get_option('pix_style_latest_post_page_orderby'),''); ?>><?php _e( 'None', 'geode' ); ?></option>
                                    <option value="ID" <?php selected(get_option('pix_style_latest_post_page_orderby'),'ID'); ?>><?php _e( 'ID', 'geode' ); ?></option>
                                    <option value="title" <?php selected(get_option('pix_style_latest_post_page_orderby'),'title'); ?>><?php _e( 'title', 'geode' ); ?></option>
                                    <option value="name" <?php selected(get_option('pix_style_latest_post_page_orderby'),'name'); ?>><?php _e( 'name', 'geode' ); ?></option>
                                    <option value="date" <?php selected(get_option('pix_style_latest_post_page_orderby'),'date'); ?>><?php _e( 'date', 'geode' ); ?></option>
                                    <option value="rand" <?php selected(get_option('pix_style_latest_post_page_orderby'),'rand'); ?>><?php _e( 'random', 'geode' ); ?></option>
                                    <option value="menu_order" <?php selected(get_option('pix_style_latest_post_page_orderby'),'menu_order'); ?>><?php _e( 'menu_order', 'geode' ); ?></option>
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