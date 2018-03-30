<?php

function footer_panel(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='footer_panel') {

    $selected_font = get_option('pix_style_fonts_w_variants');

?>

        <section id="pix_content_loaded">
            <h3><?php _e('General options','geode'); ?>: <small><?php _e('Top sliding bar and footer','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <label for="pix_content_footer_page" class="for_select"><?php _e('Page to use as footer content', 'geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_footer_page" name="pix_content_footer_page">
                                    <option value=""><?php _e('Do not display any footer', 'geode'); ?></option>
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
                                        $option = '<option '.selected( get_option('pix_content_footer_page'),  $page->ID, false ). 'value="' .  $page->ID . '">';
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

                        <label for="pix_content_top_sliding_page" class="for_select"><?php _e('Page to use as top sliding bar', 'geode'); ?>:
                            <span class="for_select">
                                <select id="pix_content_top_sliding_page" name="pix_content_top_sliding_page">
                                    <option value=""><?php _e('Do not display any sliding bar', ''); ?></option>
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
                                        $option = '<option '.selected( get_option('pix_content_top_sliding_page'),  $page->ID, false ). 'value="' .  $page->ID . '">';
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