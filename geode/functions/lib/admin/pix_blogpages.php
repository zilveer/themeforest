<?php

function blog_pages_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='blog_pages_panel') {
    
    $selected_font = get_option('pix_style_fonts_w_variants');
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Blog','geode'); ?>: <small><?php _e('Other blog pages','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">
                    <div class="tip_info large">
                        <?php _e('What is the top bar?','geode'); ?> <a href="#" data-dialog="<?php _e('Where available (not on this page, for instance) your options will be saved without refreshing the page.<br>If you encounter any problem just switch this field off.','geode'); ?>"><?php _e('More info','geode'); ?></a>
                    </div><!-- .tip_info -->
                    <br>

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_content_404_page" class="for_select"><?php _e('404 page', 'geode'); ?> <small>(<a href="#" data-dialog="<?php _e('Set a static page to use as 404 page','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:
                            <span class="for_select">
                                <select id="pix_content_404_page" name="pix_content_404_page">
                                    <option value=""><?php _e('Select a page', ''); ?></option>
                                    <?php 
                                    $args_pages = array('post_status' => 'publish,private');
                                    $pages = get_pages($args_pages); 
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
                                        $option = '<option '.selected( get_option('pix_content_404_page'),  $page->ID, false ). 'value="' .  $page->ID . '">';
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

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pix_content_search_page" class="for_select"><?php _e('Search result page', 'geode'); ?> <small>(<a href="#" data-dialog="<?php _e('Set a static page to use as search result page','geode'); ?>"><?php _e('more info','geode'); ?></a>)</small>:
                            <span class="for_select">
                                <select id="pix_content_search_page" name="pix_content_search_page">
                                    <option value=""><?php _e('Select a page', ''); ?></option>
                                    <?php 
                                    $args_pages = array('post_status' => 'publish,private');
                                    $pages = get_pages($args_pages); 
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
                                        $option = '<option '.selected( get_option('pix_content_search_page'),  $page->ID, false ). 'value="' .  $page->ID . '">';
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