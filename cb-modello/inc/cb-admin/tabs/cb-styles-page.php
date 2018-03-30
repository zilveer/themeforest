<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:52
 */
add_action( 'wp_ajax_nopriv_save_cb_styles', 'save_cb_styles' );
add_action( 'wp_ajax_save_cb_styles', 'save_cb_styles' );


function save_cb_styles() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';

    update_option('cb5_wid', esc_attr($data['cb5_wid']));
    update_option('cb5_color_style', esc_attr($data['cb5_color_style']));
    update_option('cb5_stripes_bg_schema', esc_attr($data['cb5_stripes_bg_schema']));

    update_option('cb5_upload_bg', esc_attr($data['cb5_upload_bg']));
    if (isset($data['cb5_remove_bg']))if ($data['cb5_remove_bg']=='yes') update_option('cb5_upload_bg', '');

    update_option('cb5_bg_fixed', esc_attr($data['cb5_bg_fixed']));
    update_option('cb5_bg_str', esc_attr($data['cb5_bg_str']));
    update_option('cb5_font_family', esc_attr($data['cb5_font_family']));
    update_option('cb5_font_family_google', esc_attr($data['cb5_font_family_google']));
    update_option('cb5_headings_up', esc_attr($data['cb5_headings_up']));
    update_option('cb5_headings_upw', esc_attr($data['cb5_headings_upw']));
    update_option('cb5_headings_upwt', esc_attr($data['cb5_headings_upwt']));
    update_option('cb5_font_family_head', esc_attr($data['cb5_font_family_head']));
    update_option('cb5_font_family_google_head', esc_attr($data['cb5_font_family_google_head']));
    update_option('cb5_font_family_google_head_title', esc_attr($data['cb5_font_family_google_head_title']));
    update_option('cb5_font_family_google_head_title2', esc_attr($data['cb5_font_family_google_head_title2']));
    update_option('cb5_bodyfs', esc_attr($data['cb5_bodyfs']));
    update_option('cb5_h1fs', esc_attr($data['cb5_h1fs']));
    update_option('cb5_h1fts', esc_attr($data['cb5_h1fts']));
    update_option('cb5_h2fs', esc_attr($data['cb5_h2fs']));
    update_option('cb5_h3fs', esc_attr($data['cb5_h3fs']));
    update_option('cb5_h4fs', esc_attr($data['cb5_h4fs']));
    update_option('cb5_h5fs', esc_attr($data['cb5_h5fs']));
    update_option('cb5_h6fs', esc_attr($data['cb5_h6fs']));
    update_option('cb5_headh', esc_attr($data['cb5_headh']));
    update_option('cb5_headhc', esc_attr($data['cb5_headhc']));
    update_option('cb5_menu_f', esc_attr($data['cb5_menu_f']));
    update_option('cb5_menu_font_size', esc_attr($data['cb5_menu_font_size']));
    update_option('cb5_color_master', esc_attr($data['cb5_color_master']));
    update_option('cb5_menu_color', esc_attr($data['cb5_menu_color']));
    update_option('cb5_menu_color_hover', esc_attr($data['cb5_menu_color_hover']));
    update_option('cb5_menu_color_active', esc_attr($data['cb5_menu_color_active']));
    update_option('cb5_menu_color_a', esc_attr($data['cb5_menu_color_a']));
    update_option('cb5_menu_color_ac', esc_attr($data['cb5_menu_color_ac']));
    update_option('cb5_ht_background', esc_attr($data['cb5_ht_background']));
    update_option('cb5_htb_background', esc_attr($data['cb5_htb_background']));
    update_option('cb5_middle_background', esc_attr($data['cb5_middle_background']));
    update_option('cb5_middle_backgroundc', esc_attr($data['cb5_middle_backgroundc']));
    update_option('cb5_disca', esc_attr($data['cb5_disca']));

    update_option('cb5_middle_backgroundi', esc_attr($data['cb5_middle_backgroundi']));
    if (isset($data['cb5_remove_bgi']))if($data['cb5_remove_bgi']=='yes') update_option('cb5_middle_backgroundi', '');

    update_option('cb5_bgf_str', esc_attr($data['cb5_bgf_str']));
    update_option('cb5_footer_background', esc_attr($data['cb5_footer_background']));
    update_option('cb5_background_color', esc_attr($data['cb5_background_color']));
    update_option('cb5_logo_color', esc_attr($data['cb5_logo_color']));
    update_option('cb5_logo_shad', esc_attr($data['cb5_logo_shad']));
    update_option('cb5_text_color', esc_attr($data['cb5_text_color']));
    update_option('cb5_m_color', esc_attr($data['cb5_m_color']));
    update_option('cb5_mwh', esc_attr($data['cb5_mwh']));
    update_option('cb5_mw', esc_attr($data['cb5_mw']));
    update_option('cb5_headings_color', esc_attr($data['cb5_headings_color']));
    update_option('cb5_links_color', esc_attr($data['cb5_links_color']));
    update_option('cb5_links_hover_color', esc_attr($data['cb5_links_hover_color']));
    update_option('cb5_add_css', esc_attr($data['cb5_add_css']));
    update_option('cb5_grid', esc_attr($data['cb5_grid']));
    update_option('cb5_flat', esc_attr($data['cb5_flat']));
    update_option('cb5_menu_color_h', esc_attr($data['cb5_menu_color_h']));
    update_option('cb5_menu_up', esc_attr($data['cb5_menu_up']));
    update_option('cb5_menu_upw', esc_attr($data['cb5_menu_upw']));
    update_option('cb5_cap_bg', esc_attr($data['cb5_cap_bg']));
    update_option('cb5_fhfs', esc_attr($data['cb5_fhfs']));
    update_option('cb5_footer_h_color', esc_attr($data['cb5_footer_h_color']));
    update_option('cb5_footer_text_color', esc_attr($data['cb5_footer_text_color']));

    die($response);
}
function show_cb_styles_page(){
?>
        <h3>Theme Styles</h3>
        <div class="tab_desc">Change the looks of the theme with few clicks. Page/Post dedicated settings will override ones below.</div>
<form method="post" class="cb-admin-form">
        <!-- STYLES SECTION START-->

        <div class="pd5" style="border-top:none;">
            <?php generate_select(__('Layout', 'cb-modello'),get_option('cb5_wid'), array(
                array('full', __('full width', 'cb-modello')),
                array('fixed', __('boxed or fixed', 'cb-modello'))), 'cb5_wid');?>
        </div>
        
        <div class="pd5 hide" style="border-top:none;">
            <?php generate_select(__('Grid Version', 'cb-modello'),get_option('cb5_grid'), array(
                array('', __('960', 'cb-modello')),
                array('1170', __('1170', 'cb-modello'))), 'cb5_grid');?>
        </div>

        <div class="pd5 hide">
            <?php echo generate_hint('Flat style colors'); ?>
            <?php generate_check(__('Flat colors?', 'cb-modello'),get_option('cb5_flat'), 'cb5_flat');?>
        </div>

        <div class="pd5">
            <?php generate_select(__('Color style', 'cb-modello'),get_option('cb5_color_style'), array(
                array('', __('green', 'cb-modello')),
                array('red', __('red', 'cb-modello')),
                array('black', __('black', 'cb-modello')),
                array('blue', __('blue', 'cb-modello')),
                array('grey', __('grey', 'cb-modello')),
                array('brown', __('brown', 'cb-modello')),
                array('orange', __('orange', 'cb-modello')),
                array('gold', __('gold', 'cb-modello')),
                array('magenta', __('magenta', 'cb-modello')),
                array('dark_red', __('dark red', 'cb-modello')),
                array('lemon', __('lemon', 'cb-modello'))), 'cb5_color_style');?>
        </div>

        <div class="pd5"><label for="cb5_stripes_bg_schema" style="line-height: 59px;"><?php _e('Background Pattern','cb-modello'); ?>
                <input type="hidden"  name="cb5_stripes_bg_schema" value="<?php echo get_option('cb5_stripes_bg_schema');?>" id="stripes_bg_schema_val">
            </label> <select name="cb5_stripes_bg_schema" id="stripes_bg_schema">

                <option value="" <?php if(get_option('cb5_stripes_bg_schema')==''){?> selected
                <?php } ?>>-----</option>
                <option value="w.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w.png'){?> selected <?php } ?>>
                    <?php _e('White','cb-modello'); ?>
                </option>
                <option value="bg0.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/bg0.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='bg0.png'){?> selected <?php } ?>>
                    <?php _e('Beige Noise','cb-modello'); ?>
                </option>
                <option value="w1.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w1.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w1.png'){?> selected <?php } ?>>
                    <?php _e('White 1','cb-modello'); ?>
                </option>
                <option value="w2.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w2.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w2.png'){?> selected <?php } ?>>
                    <?php _e('White 2','cb-modello'); ?>
                </option>
                <option value="w3.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w3.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w3.png'){?> selected <?php } ?>>
                    <?php _e('White 3','cb-modello'); ?>
                </option>
                <option value="w4.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w4.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w4.png'){?> selected <?php } ?>>
                    <?php _e('White 4','cb-modello'); ?>
                </option>
                <option value="w5.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w5.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w5.png'){?> selected <?php } ?>>
                    <?php _e('White 5','cb-modello'); ?>
                </option>
                <option value="w6.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w6.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w6.png'){?> selected <?php } ?>>
                    <?php _e('White 6','cb-modello'); ?>
                </option>
                <option value="w7.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w7.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w7.png'){?> selected <?php } ?>>
                    <?php _e('White 7','cb-modello'); ?>
                </option>
                <option value="w8.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w8.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w8.png'){?> selected <?php } ?>>
                    <?php _e('White 8','cb-modello'); ?>
                </option>
                <option value="w9.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w9.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w9.png'){?> selected <?php } ?>>
                    <?php _e('White 9','cb-modello'); ?>
                </option>
                <option value="w10.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w10.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w10.png'){?> selected <?php } ?>>
                    <?php _e('White 10','cb-modello'); ?>
                </option>
                <option value="w11.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w11.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w11.png'){?> selected <?php } ?>>
                    <?php _e('White 11','cb-modello'); ?>
                </option>
                <option value="w12.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w12.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w12.png'){?> selected <?php } ?>>
                    <?php _e('White 12','cb-modello'); ?>
                </option>
                <option value="w13.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w13.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w13.png'){?> selected <?php } ?>>
                    <?php _e('White 13','cb-modello'); ?>
                </option>
                <option value="w14.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w14.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w14.png'){?> selected <?php } ?>>
                    <?php _e('White 14','cb-modello'); ?>
                </option>
                <option value="w15.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w15.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w15.png'){?> selected <?php } ?>>
                    <?php _e('White 15','cb-modello'); ?>
                </option>
                <option value="w16.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w16.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w16.png'){?> selected <?php } ?>>
                    <?php _e('White 16','cb-modello'); ?>
                </option>
                <option value="w17.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w17.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w17.png'){?> selected <?php } ?>>
                    <?php _e('White 17','cb-modello'); ?>
                </option>
                <option value="w18.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/w18.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w18.png'){?> selected <?php } ?>>
                    <?php _e('White 18','cb-modello'); ?>
                </option>
                <option value="b1.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b1.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b1.png'){?> selected <?php } ?>>
                    <?php _e('Black 1','cb-modello'); ?>
                </option>
                <option value="b2.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b2.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b2.png'){?> selected <?php } ?>>
                    <?php _e('Black 2','cb-modello'); ?>
                </option>
                <option value="b3.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b3.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b3.png'){?> selected <?php } ?>>
                    <?php _e('Black 3','cb-modello'); ?>
                </option>
                <option value="b4.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b4.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b4.png'){?> selected <?php } ?>>
                    <?php _e('Black 4','cb-modello'); ?>
                </option>
                <option value="b5.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b5.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b5.png'){?> selected <?php } ?>>
                    <?php _e('Black 5','cb-modello'); ?>
                </option>
                <option value="b6.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b6.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='w6.png'){?> selected <?php } ?>>
                    <?php _e('Black 6','cb-modello'); ?>
                </option>
                <option value="b7.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b7.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b7.png'){?> selected <?php } ?>>
                    <?php _e('Black 7','cb-modello'); ?>
                </option>
                <option value="b8.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b8.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b8.png'){?> selected <?php } ?>>
                    <?php _e('Black 8','cb-modello'); ?>
                </option>
                <option value="b9.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b9.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b9.png'){?> selected <?php } ?>>
                    <?php _e('Black 9','cb-modello'); ?>
                </option>
                <option value="b10.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b10.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b10.png'){?> selected <?php } ?>>
                    <?php _e('Black 10','cb-modello'); ?>
                </option>
                <option value="b11.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b11.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b11.png'){?> selected <?php } ?>>
                    <?php _e('Black 11','cb-modello'); ?>
                </option>
                <option value="b12.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b12.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b12.png'){?> selected <?php } ?>>
                    <?php _e('Black 12','cb-modello'); ?>
                </option>
                <option value="b13.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b13.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b13.png'){?> selected <?php } ?>>
                    <?php _e('Black 13','cb-modello'); ?>
                </option>
                <option value="b14.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b14.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b14.png'){?> selected <?php } ?>>
                    <?php _e('Black 14','cb-modello'); ?>
                </option>
                <option value="b15.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b15.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b15.png'){?> selected <?php } ?>>
                    <?php _e('Black 15','cb-modello'); ?>
                </option>
                <option value="b16.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b16.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b16.png'){?> selected <?php } ?>>
                    <?php _e('Black 16','cb-modello'); ?>
                </option>
                <option value="b17.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b17.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b17.png'){?> selected <?php } ?>>
                    <?php _e('Black 17','cb-modello'); ?>
                </option>
                <option value="b18.png" data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b18.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b18.png'){?> selected <?php } ?>>
                    <?php _e('Black 18','cb-modello'); ?>
                </option>
                <option value="b19.png"  data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b19.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b19.png'){?> selected <?php } ?>>
                    <?php _e('Black 19','cb-modello'); ?>
                </option>
                <option value="b20.png"  data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b20.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b20.png'){?> selected <?php } ?>>
                    <?php _e('Black 20','cb-modello'); ?>
                </option>
                <option value="b21.png"  data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b21.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b21.png'){?> selected <?php } ?>>
                    <?php _e('Black 21','cb-modello'); ?>
                </option>
                <option value="b22.png"  data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b22.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b22.png'){?> selected <?php } ?>>
                    <?php _e('Black 22','cb-modello'); ?>
                </option>
                <option value="b23.png"  data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b23.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b23.png'){?> selected <?php } ?>>
                    <?php _e('Black 23','cb-modello'); ?>
                </option>
                <option value="b24.png"  data-imagesrc="<?php echo bfi_thumb(WP_THEME_URL.'/img/bg/b24.png', array('height'=>'58','width'=>'253','crop'=>true));?>"
                    <?php if(get_option('cb5_stripes_bg_schema')=='b24.png'){?> selected <?php } ?>>
                    <?php _e('Black 24','cb-modello'); ?>
                </option>
            </select>
            <div class="clear"></div>
        </div>


        <div class="pd5">
            <?php echo generate_hint('Enter an URL or upload background image. This setting overrides predefined backgrounds.'); ?>
            <label for="cb5_upload_bg"><?php _e('Background upload','cb-modello'); ?></label>
            <input id="cb5_upload_bg" type="text" size="36" name="cb5_upload_bg" class="upurl input-upload" value="<?php echo get_option('cb5_upload_bg'); ?>" /><input class="upload_button2" type="button" value="Upload" />
            </div>
        
            
            <?php if(get_option('cb5_upload_bg')!='') {
                if (!function_exists('bfi_thumb'))
                    require_once(get_template_directory() . '/inc/cb-lib/bfithumb.php');

                echo '<div class="pd5"><label class="info">Current bg:</label><a href="'.get_option('cb5_upload_bg').'" target="_blank"><img src="'.bfi_thumb(get_option('cb5_upload_bg'), array('width' => 145, 'height'=>70, 'crop' => true)).'" align="absmiddle" alt="logo" class="round" style="width:145px!important;height:70px!important;"/></a></div>';
            } ?>
            
        <?php if(get_option('cb5_upload_bg')!='') { ?>
            <div class="pd5" >
            <?php generate_select(__('Remove background image ?', 'cb-modello'),'', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))), 'cb5_remove_bg');?>
            </div><?php
        } ?>

        <div class="pd5">
            <?php echo generate_hint('Background will stay in one place'); ?>
            <?php generate_check('Fixed background?',get_option('cb5_bg_fixed'), 'cb5_bg_fixed');?>
                
        </div>

        <div class="pd5">
            <?php echo generate_hint('Background image will always fit the window'); ?>
            <?php generate_check('Stretch background?',get_option('cb5_bg_str'), 'cb5_bg_str');?>
                
        </div>


        <div class="pd5">
        <button type="button" class="extend_button cb_button"><?php _e('Show more options', 'cb-modello'); ?> <i class="fa fa-angle-down"></i></button>
       
        </div>
        <div class="extend">
<div class="pd5-reset">
        <h3><?php _e('Font Styles','cb-modello'); ?></h3>
        <div class="tab_desc pb0"><?php _e('Global fonts weight, transform and families','cb-modello'); ?></div>
</div>
        <div class="pd5">
            <?php echo generate_hint('Will take effect if you will not use Google WebFonts'); ?>
            <?php generate_select(__('Font Family', 'cb-modello'),get_option('cb5_font_family'), array(
                array('Arial', __('Arial', 'cb-modello')),
                array('Tahoma', __('Tahoma', 'cb-modello')),
                array('Verdana', __('Verdana', 'cb-modello')),
                array('Trebuchet Ms', __('Trebuchet Ms', 'cb-modello')),
                array('Times New Roman', __('Times New Roman', 'cb-modello')),
                array('Georgia', __('Georgia', 'cb-modello'))), 'cb5_font_family');?>
        </div>
        <div class="pd5">
            <?php echo generate_hint('Fonts from Google WebFonts, will override normal fonts'); ?>
            <label for="cb5_font_family_google"><?php _e('Font Family Google','cb-modello'); ?></label>
            <select name="cb5_font_family_google" id="cb5_font_family_google">
                <?php
                $google_font = array('------','Abel','Abril+Fatface','Aclonica','Acme','Actor','Adamina','Advent+Pro','Aguafina+Script','Aladin','Aldrich','Alegreya','Alegreya+SC','Alex+Brush','Alfa+Slab+One','Alice','Alike','Alike+Angular','Allan','Allerta','Allerta+Stencil','Allura','Almendra','Almendra+SC','Amarante','Amaranth','Amatic+SC','Amethysta','Andada','Andika','Angkor','Annie+Use+Your+Telescope','Anonymous+Pro','Antic','Antic+Didone','Antic+Slab','Anton','Arapey','Arbutus','Architects+Daughter','Arimo','Arizonia','Armata','Artifika','Arvo','Asap','Asset','Astloch','Asul','Atomic+Age','Aubrey','Audiowide','Average','Averia+Gruesa+Libre','Averia+Libre','Averia+Sans+Libre','Averia+Serif+Libre','Bad+Script','Balthazar','Bangers','Basic','Battambang','Baumans','Bayon','Belgrano','Belleza','Bentham','Berkshire+Swash','Bevan','Bigshot+One','Bilbo','Bilbo+Swash+Caps','Bitter','Black+Ops+One','Bokor','Bonbon','Boogaloo','Bowlby+One','Bowlby+One+SC','Brawler','Bree+Serif','Bubblegum+Sans','Buda','Buenard','Butcherman','Butterfly+Kids','Cabin','Cabin+Condensed','Cabin+Sketch','Caesar+Dressing','Cagliostro','Calligraffitti','Cambo','Candal','Cantarell','Cantata+One','Cantora+One','Capriola','Cardo','Carme','Carter+One','Caudex','Cedarville+Cursive','Ceviche+One','Changa+One','Chango','Chau+Philomene+One','Chelsea+Market','Chenla','Cherry+Cream+Soda','Chewy','Chicle','Chivo','Coda','Coda+Caption','Codystar','Comfortaa','Coming+Soon','Concert+One','Condiment','Content','Contrail+One','Convergence','Cookie','Copse','Corben','Courgette','Cousine','Coustard','Covered+By+Your+Grace','Crafty+Girls','Creepster','Crete+Round','Crimson+Text','Crushed','Cuprum','Cutive','Damion','Dancing+Script','Dangrek','Dawning+of+a+New+Day','Days+One','Delius','Delius+Swash+Caps','Delius+Unicase','Della+Respira','Devonshire','Didact+Gothic','Diplomata','Diplomata+SC','Doppio+One','Dorsa','Dosis','Dr+Sugiyama','Droid+Sans','Droid+Sans+Mono','Droid+Serif','Duru+Sans','Dynalight','EB+Garamond','Eagle+Lake','Eater','Economica','Electrolize','Emblema+One','Emilys+Candy','Engagement','Enriqueta','Erica+One','Esteban','Euphoria+Script','Ewert','Exo','Expletus+Sans','Fanwood+Text','Fascinate','Fascinate+Inline','Fasthand','Federant','Federo','Felipa','Fjord+One','Flamenco','Flavors','Fondamento','Fontdiner+Swanky','Forum','Francois+One','Fredericka+the+Great','Fredoka+One','Freehand','Fresca','Frijole','Fugaz+One','GFS+Didot','GFS+Neohellenic','Galdeano','Galindo','Gentium+Basic','Gentium+Book+Basic','Geo','Geostar','Geostar+Fill','Germania+One','Give+You+Glory','Glass+Antiqua','Glegoo','Gloria+Hallelujah','Goblin+One','Gochi+Hand','Gorditas','Goudy+Bookletter+1911','Graduate','Gravitas+One','Great+Vibes','Gruppo','Gudea','Habibi','Hammersmith+One','Handlee','Hanuman','Happy+Monkey','Henny+Penny','Herr+Von+Muellerhoff','Holtwood+One+SC','Homemade+Apple','Homenaje','IM+Fell+DW+Pica','IM+Fell+DW+Pica+SC','IM+Fell+Double+Pica','IM+Fell+Double+Pica+SC','IM+Fell+English','IM+Fell+English+SC','IM+Fell+French+Canon','IM+Fell+French+Canon+SC','IM+Fell+Great+Primer','IM+Fell+Great+Primer+SC','Iceberg','Iceland','Imprima','Inconsolata','Inder','Indie+Flower','Inika','Irish+Grover','Istok+Web','Italiana','Italianno','Jim+Nightshade','Jockey+One','Jolly+Lodger','Josefin+Sans','Josefin+Slab','Judson','Julee','Junge','Jura','Just+Another+Hand','Just+Me+Again+Down+Here','Kameron','Karla','Kaushan+Script','Kelly+Slab','Kenia','Khmer','Knewave','Kotta+One','Koulen','Kranky','Kreon','Kristi','Krona+One','La+Belle+Aurore','Lancelot','Lato','League+Script','Leckerli+One','Ledger','Lekton','Lemon','Life+Savers','Lilita+One','Limelight','Linden+Hill','Lobster','Lobster+Two','Londrina+Outline','Londrina+Shadow','Londrina+Sketch','Londrina+Solid','Lora','Love+Ya+Like+A+Sister','Loved+by+the+King','Lovers+Quarrel','Luckiest+Guy','Lusitana','Lustria','Macondo','Macondo+Swash+Caps','Magra','Maiden+Orange','Mako','Marck+Script','Marko+One','Marmelad','Marvel','Mate','Mate+SC','Maven+Pro','McLaren','Meddon','MedievalSharp','Medula+One','Megrim','Merienda+One','Merriweather','Metal','Metal+Mania','Metamorphous','Metrophobic','Michroma','Miltonian','Miltonian+Tattoo','Miniver','Miss+Fajardose','Modern+Antiqua','Molengo','Monofett','Monoton','Monsieur+La+Doulaise','Montaga','Montez','Montserrat','Moul','Moulpali','Mountains+of+Christmas','Mr+Bedfort','Mr+Dafoe','Mr+De+Haviland','Mrs+Saint+Delafield','Mrs+Sheppards','Muli','Mystery+Quest','Neucha','Neuton','News+Cycle','Niconne','Nixie+One','Nobile','Nokora','Norican','Nosifer','Nothing+You+Could+Do','Noticia+Text','Nova+Cut','Nova+Flat','Nova+Mono','Nova+Oval','Nova+Round','Nova+Script','Nova+Slim','Nova+Square','Numans','Nunito','Odor+Mean+Chey','Old+Standard+TT','Oldenburg','Oleo+Script','Open+Sans','Open+Sans+Condensed','Orbitron','Oregano','Original+Surfer','Oswald','Over+the+Rainbow','Overlock','Overlock+SC','Ovo','Oxygen','PT+Mono','PT+Sans','PT+Sans+Caption','PT+Sans+Narrow','PT+Serif','PT+Serif+Caption','Pacifico','Parisienne','Passero+One','Passion+One','Patrick+Hand','Patua+One','Paytone+One','Peralta','Permanent+Marker','Petrona','Philosopher','Piedra','Pinyon+Script','Plaster','Play','Playball','Playfair+Display','Podkova','Poiret+One','Poller+One','Poly','Pompiere','Pontano+Sans','Port+Lligat+Sans','Port+Lligat+Slab','Prata','Preahvihear','Press+Start+2P','Princess+Sofia','Prociono','Prosto+One','Puritan','Quando','Quantico','Quattrocento','Quattrocento+Sans','Questrial','Quicksand','Qwigley','Racing+Sans+One','Radley','Raleway','Rammetto+One','Rancho','Rationale','Redressed','Reenie+Beanie','Revalia','Ribeye','Ribeye+Marrow','Righteous','Roboto','Rochester','Rock+Salt','Rokkitt','Romanesco','Ropa+Sans','Rosario','Rosarivo','Rouge+Script','Ruda','Ruge+Boogie','Ruluko','Ruslan+Display','Russo+One','Ruthie','Sail','Salsa','Sancreek','Sansita+One','Sarina','Satisfy','Schoolbell','Seaweed+Script','Sevillana','Shadows+Into+Light','Shadows+Into+Light+Two','Shanti','Share','Shojumaru','Short+Stack','Siemreap','Sigmar+One','Signika','Signika+Negative','Simonetta','Sirin+Stencil','Six+Caps','Slackey','Smokum','Smythe','Sniglet','Snippet','Sofia','Sonsie+One','Sorts+Mill+Goudy','Source+Sans+Pro','Special+Elite','Spicy+Rice','Spinnaker','Spirax','Squada+One','Stardos+Stencil','Stint+Ultra+Condensed','Stint+Ultra+Expanded','Stoke','Sue+Ellen+Francisco','Sunshiney','Supermercado+One','Suwannaphum','Swanky+and+Moo+Moo','Syncopate','Tangerine','Taprom','Telex','Tenor+Sans','The+Girl+Next+Door','Tienne','Tinos','Titan+One','Trade+Winds','Trocchi','Trochut','Trykker','Tulpen+One','Ubuntu','Ubuntu+Condensed','Ubuntu+Mono','Ultra','Uncial+Antiqua','UnifrakturCook','UnifrakturMaguntia','Unkempt','Unlock','Unna','VT323','Varela','Varela+Round','Vast+Shadow','Vibur','Vidaloka','Viga','Voces','Volkhov','Vollkorn','Voltaire','Waiting+for+the+Sunrise','Wallpoet','Walter+Turncoat','Wellfleet','Wire+One','Yanone+Kaffeesatz','Yellowtail','Yeseva+One','Yesteryear','Zeyada');
                $google_font = str_replace('+', ' ', $google_font);
                for ($i=0;$i<sizeof($google_font);$i++){
                    if(get_option('cb5_font_family_google')==$google_font[$i]) $ffg=' selected'; else $ffg='';
                    echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
                } ?>
            </select>
        </div>


        <div class="pd5">
            <?php echo generate_hint('Headings fonts styling'); ?>
            <?php generate_select(__('Headings Transform', 'cb-modello'),get_option('cb5_headings_up'), array(
                array('normal', __('normal', 'cb-modello')),
                array('uppercase', __('uppercase', 'cb-modello'))), 'cb5_headings_up');?>
        </div>

        <div class="pd5">
            <?php echo generate_hint('Headings fonts styling'); ?>
            <?php generate_select(__('Headings Font Weight', 'cb-modello'),get_option('cb5_headings_upw'), array(
                array('300', __('light', 'cb-modello')),
                array('normal', __('normal', 'cb-modello')),
                array('bold', __('semi-bold', 'cb-modello')),
                array('bolder', __('bold', 'cb-modello'))), 'cb5_headings_upw');?>
        </div>

        <div class="pd5">
            <?php echo generate_hint('Title fonts styling'); ?>
            <?php generate_select(__('Title Font Weight', 'cb-modello'),get_option('cb5_headings_upwt'), array(
                array('300', __('light', 'cb-modello')),
                array('normal', __('normal', 'cb-modello')),
                array('bold', __('semi-bold', 'cb-modello')),
                array('bolder', __('bold', 'cb-modello'))), 'cb5_headings_upwt');?>
        </div>
        
        
        <div class="pd5">
            <?php echo generate_hint('Menu fonts styling'); ?>
            <?php generate_select(__('Menu Font Transform', 'cb-modello'),get_option('cb5_menu_up'), array(
                array('uppercase', __('uppercase', 'cb-modello')),
            	array('normal', __('normal', 'cb-modello'))), 'cb5_menu_up');?>
        </div>

        <div class="pd5">
            <?php echo generate_hint('Menu fonts styling'); ?>
            <?php generate_select(__('Menu Font Weight', 'cb-modello'),get_option('cb5_menu_upw'), array(
                array('300', __('light', 'cb-modello')),
                array('normal', __('normal', 'cb-modello')),
                array('bold', __('semi-bold', 'cb-modello')),
                array('bolder', __('bold', 'cb-modello'))), 'cb5_menu_upw');?>
        </div>

        <div class="pd5">
            <?php generate_select(__('Headings Font Family', 'cb-modello'),get_option('cb5_font_family_head'), array(
                array('Arial', __('Arial', 'cb-modello')),
                array('Tahoma', __('Tahoma', 'cb-modello')),
                array('Verdana', __('Verdana', 'cb-modello')),
                array('Trebuchet Ms', __('Trebuchet Ms', 'cb-modello')),
                array('Times New Roman', __('Times New Roman', 'cb-modello')),
                array('Georgia', __('Georgia', 'cb-modello'))), 'cb5_font_family_head');?>
        </div>

        <div class="pd5">
            <?php echo generate_hint('Fonts from Google WebFonts, will override normal fonts'); ?>
            <label for="cb5_font_family_google_head"><?php _e('Headings Font Google','cb-modello'); ?></label>
            <select name="cb5_font_family_google_head" id="cb5_font_family_google_head">
                <?php for ($i=0;$i<sizeof($google_font);$i++){
                    if(get_option('cb5_font_family_google_head')==$google_font[$i]) $ffg=' selected'; else $ffg='';
                    echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
                } ?>
            </select>
        </div>


        <div class="pd5">
            <?php echo generate_hint('Fonts from Google WebFonts, will override normal fonts'); ?>
            <label for="cb5_font_family_google_head_title"><?php _e('Title Heading Font Family','cb-modello'); ?></label>
            <select name="cb5_font_family_google_head_title" id="cb5_font_family_google_head_title">
                <?php for ($i=0;$i<sizeof($google_font);$i++){
                    if(get_option('cb5_font_family_google_head_title')==$google_font[$i]) $ffg=' selected'; else $ffg='';
                    echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
                } ?>
            </select> 
        </div>
        <div class="pd5">
            <?php echo generate_hint('Fonts from Google WebFonts, will override normal fonts'); ?>
            <label for="cb5_font_family_google_head_title2"><?php _e('Second Title Font Family','cb-modello'); ?></label>
            <select name="cb5_font_family_google_head_title2" id="cb5_font_family_google_head_title2">
                <?php for ($i=0;$i<sizeof($google_font);$i++){
                    if(get_option('cb5_font_family_google_head_title2')==$google_font[$i]) $ffg=' selected'; else $ffg='';
                    echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
                } ?>
            </select> 
        </div>
        
        


<div class="pd5-reset">
        <h3><?php _e('Font Sizes','cb-modello'); ?></h3>
        <div class="tab_desc pb0"><?php _e('Set different sizes for the fonts','cb-modello'); ?></div>
</div>
        <div class="pd5"><label for="cb5_bodyfs"><?php _e('Body font size','cb-modello'); ?></label>
            <input type="text" name="cb5_bodyfs" id="cb5_bodyfs" value="<?php echo get_option('cb5_bodyfs');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,30" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_h1fts"><?php _e('Title Heading font size','cb-modello'); ?></label>
            <input type="text" name="cb5_h1fts" id="cb5_h1fts" value="<?php echo get_option('cb5_h1fts');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,100" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_h1fs"><?php _e('Heading 1 font size','cb-modello'); ?></label>
            <input type="text" name="cb5_h1fs" id="cb5_h1fs" value="<?php echo get_option('cb5_h1fs');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,100" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_h2fs"><?php _e('Heading 2 font size','cb-modello'); ?></label>
            <input type="text" name="cb5_h2fs" id="cb5_h2fs" value="<?php echo get_option('cb5_h2fs');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,100" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_h3fs"><?php _e('Heading 3 font size','cb-modello'); ?></label>
            <input type="text" name="cb5_h3fs" id="cb5_h3fs" value="<?php echo get_option('cb5_h3fs');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,100" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_h4fs"><?php _e('Heading 4 font size','cb-modello'); ?></label>
            <input type="text" name="cb5_h4fs" id="cb5_h4fs" value="<?php echo get_option('cb5_h4fs');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,100" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_h5fs"><?php _e('Heading 5 font size','cb-modello'); ?></label>
            <input type="text" name="cb5_h5fs" id="cb5_h5fs" value="<?php echo get_option('cb5_h5fs');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,100" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_h6fs"><?php _e('Heading 6 font size','cb-modello'); ?></label>
            <input type="text" name="cb5_h6fs" id="cb5_h6fs" value="<?php echo get_option('cb5_h6fs');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,100" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
         <div class="pd5"><label for="cb5_h6fs"><?php _e('Footer Heading font size','cb-modello'); ?></label>
            <input type="text" name="cb5_fhfs" id="cb5_fhfs" value="<?php echo get_option('cb5_fhfs');?>"  data-slider="true" data-slider-step="1" data-slider-range="8,100" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_headh"><?php _e('Title Headings Line Height','cb-modello'); ?></label>
            <input type="text" name="cb5_headh" id="cb5_headh" value="<?php echo get_option('cb5_headh');?>"  data-slider="true" data-slider-step="1" data-slider-range="10,1000" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>
        <div class="pd5"><label for="cb5_headhc"><?php _e('Title, slash, icon color','cb-modello'); ?></label>
            <input type="text" name="cb5_headhc" id="cb5_headhc" class="color" value="<?php echo get_option('cb5_headhc');?>"/></div>


        <div class="pd5"><label for="cb5_menu_f"><?php _e('Menu Font Family - Google','cb-modello'); ?></label>
            <select name="cb5_menu_f" id="cb5_menu_f">
                <?php for ($i=0;$i<sizeof($google_font);$i++){
                    if(get_option('cb5_menu_f')==$google_font[$i]) $ffg=' selected'; else $ffg='';
                    echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
                } ?>
            </select>
        </div>

        <div class="pd5">
            <label for="cb5_menu_font_size"><?php _e('Menu font size','cb-modello'); ?></label>
            <input type="text" name="cb5_menu_font_size" id="cb5_menu_font_size" value="<?php echo get_option('cb5_menu_font_size');?>" data-slider="true" data-slider-step="1" data-slider-range="8,30" data-slider-highlight="true"/> <?php _e('px','cb-modello'); ?></div>

<div class="pd5-reset">
        <h3><?php _e('Custom Colors','cb-modello'); ?></h3>
        <div class="tab_desc pb0"><?php _e('Set colors yourself. This settings will override general color schema','cb-modello'); ?></div>
</div>

        <div class="pd5">
            <?php echo generate_hint('Master color switcher. This setting will work like our predefined color styles'); ?>
            <label for="cb5_color_master"><?php _e('Accent and Master color','cb-modello'); ?></label>
            <input type="text" name="cb5_color_master" id="cb5_color_master" value="<?php echo get_option('cb5_color_master');?>" class="color"/></div>

        <div class="pd5"><label for="cb5_menu_color"><?php _e('Menu font color','cb-modello'); ?></label>
            <input type="text" name="cb5_menu_color" id="cb5_menu_color" value="<?php echo get_option('cb5_menu_color');?>" class="color"/></div>
            <div class="pd5"><label for="cb5_menu_color_hover"><?php _e('Menu font color hover','cb-modello'); ?></label>
                <input type="text" name="cb5_menu_color_hover" id="cb5_menu_color_hover" value="<?php echo get_option('cb5_menu_color_hover');?>" class="color"/></div>
            <div class="pd5"><label for="cb5_menu_color_active"><?php _e('Menu font color active','cb-modello'); ?></label>
                <input type="text" name="cb5_menu_color_active" id="cb5_menu_color_active" value="<?php echo get_option('cb5_menu_color_active');?>" class="color"/></div>
            
        <div class="pd5"><label for="cb5_menu_color_a"><?php _e('Menu active background','cb-modello'); ?></label>
            <input type="text" name="cb5_menu_color_a" id="cb5_menu_color_a" value="<?php echo get_option('cb5_menu_color_a');?>" class="color"/></div>
            
        <div class="pd5"><label for="cb5_menu_color_ac"><?php _e('Menu active color','cb-modello'); ?></label>
            <input type="text" name="cb5_menu_color_ac" id="cb5_menu_color_ac" value="<?php echo get_option('cb5_menu_color_ac');?>" class="color"/></div>
            
        <div class="pd5"><label for="cb5_menu_color_h"><?php _e('Menu hover color','cb-modello'); ?></label>
            <input type="text" name="cb5_menu_color_h" id="cb5_menu_color_h" value="<?php echo get_option('cb5_menu_color_h');?>" class="color"/></div>
            
        <div class="pd5"><label for="cb5_ht_background"><?php _e('Header background color','cb-modello'); ?></label>
            <input type="text" name="cb5_ht_background" id="cb5_ht_background" value="<?php echo get_option('cb5_ht_background');?>" class="color"/></div>

        <div class="pd5">
            <?php echo generate_hint('Background color for the slider or title area'); ?>
            <label for="cb5_htb_background"><?php _e('Below Header background','cb-modello'); ?></label>
            <input type="text" name="cb5_htb_background" id="cb5_htb_background" value="<?php echo get_option('cb5_htb_background');?>" class="color"/></div>

        <div class="pd5">
            <?php echo generate_hint('Background color for content area'); ?>
            <label for="cb5_middle_background">
            <?php _e('Content area background','cb-modello'); ?></label>
            <input type="text" name="cb5_middle_background" id="cb5_middle_background" value="<?php echo get_option('cb5_middle_background');?>" class="color"/></div>

        <div class="pd5 hide">
            <?php echo generate_hint('Background for area above footer'); ?>
            <label for="cb5_middle_backgroundc">
            <?php _e('Below content background','cb-modello'); ?></label>
            <input type="text" name="cb5_middle_backgroundc" id="cb5_middle_backgroundc" value="<?php echo get_option('cb5_middle_backgroundc');?>" class="color"/></div>

        <div class="pd5 hide">
            <?php echo generate_hint('Enter an URL or upload logo. Background image for area above footer.'); ?>
            <label for="cb5_middle_backgroundi"><?php _e('Below content background img','cb-modello'); ?></label>
            <input id="cb5_middle_backgroundi" type="text" size="36" name="cb5_middle_backgroundi" class="upurl input-upload" value="<?php echo get_option('cb5_middle_backgroundi'); ?>" /><input class="upload_button2" type="button" value="Upload"  />
                </div>
        
            <?php if(get_option('cb5_middle_backgroundi')!='') {
                if (!function_exists('bfi_thumb'))
                    require_once(get_template_directory() . '/inc/cb-lib/bfithumb.php');
                echo '<div class="pd5"><label class="info">Current bg:</label><a href="'.get_option('cb5_middle_backgroundi').'" target="_blank">
                <img src="'.bfi_thumb(get_option('cb5_middle_backgroundi'), array('width' => 145, 'height'=>70, 'crop' => true)).'" align="absmiddle" alt="logo" class="round" style="width:145px!important;height:70px!important;"/></a></div>';
            } ?>
        <?php if(get_option('cb5_middle_backgroundi')!='') { ?>
            <div class="pd5">
            <?php generate_check(__('Remove background image?', 'cb-modello'),get_option('cb5_remove_bgi'), 'cb5_remove_bgi');?>
                
            </div><?php
        } ?>

        <div class="pd5 hide">
            <?php generate_check(__('Stretch background?', 'cb-modello'),get_option('cb5_bgf_str'), 'cb5_bgf_str');?>
                
        </div>

        <div class="pd5"><label for="cb5_footer_background"><?php _e('Footer background color','cb-modello'); ?></label>
            <input type="text" name="cb5_footer_background" id="cb5_footer_background" value="<?php echo get_option('cb5_footer_background');?>" class="color"/></div>
        
        <div class="pd5"><label for="cb5_footer_text_color"><?php _e('Footer text color','cb-modello'); ?></label>
            <input type="text" name="cb5_footer_text_color" id="cb5_footer_text_color" value="<?php echo get_option('cb5_footer_text_color');?>" class="color"/></div>
        
        <div class="pd5"><label for="cb5_footer_h_color"><?php _e('Footer Headings color','cb-modello'); ?></label>
            <input type="text" name="cb5_footer_h_color" id="cb5_footer_h_color" value="<?php echo get_option('cb5_footer_h_color');?>" class="color"/></div>
        
        <div class="pd5"><label for="cb5_background_color"><?php _e('Background color','cb-modello'); ?></label>
            <input type="text" name="cb5_background_color" id="cb5_background_color" value="<?php echo get_option('cb5_background_color');?>" class="color"/></div>

        <div class="pd5"><label for="cb5_logo_color"><?php _e('Logo color','cb-modello'); ?></label>
            <input type="text" name="cb5_logo_color" id="cb5_logo_color" value="<?php echo get_option('cb5_logo_color');?>" class="color"/></div>

        <div class="pd5"><label for="cb5_logo_shad"><?php _e('Logo shadow color','cb-modello'); ?></label>
            <input type="text" name="cb5_logo_shad" id="cb5_logo_shad" value="<?php echo get_option('cb5_logo_shad');?>" class="color"/></div>

        <div class="pd5"><label for="cb5_text_color"><?php _e('Text color','cb-modello'); ?></label>
            <input type="text" name="cb5_text_color" id="cb5_text_color" value="<?php echo get_option('cb5_text_color');?>" class="color"/></div>
            
        <div class="pd5" style="display:none;"><label for="cb5_m_color"><?php _e('Menu text color','cb-modello'); ?></label>
            <input type="text" name="cb5_m_color" id="cb5_m_color" value="<?php echo get_option('cb5_m_color');?>" class="color"/></div>
            
        <div class="pd5">
            <?php echo generate_hint('Colors for the headings above footer area'); ?>
        <label for="cb5_mwh"><?php _e('Above Footer Headings Colors','cb-modello'); ?></label>
            <input type="text" name="cb5_mwh" id="cb5_mwh" value="<?php echo get_option('cb5_mwh');?>" class="color"/></div>

        <div class="pd5">
            <?php echo generate_hint('Colors for the above footer area text'); ?>
            <label for="cb5_mw"><?php _e('Above Footer Text Colors','cb-modello'); ?></label>
            <input type="text" name="cb5_mw" id="cb5_mw" value="<?php echo get_option('cb5_mw');?>" class="color"/></div>

        <div class="pd5">
            <?php echo generate_hint('General Headings color'); ?>
            <label for="cb5_headings_color"><?php _e('Headings color','cb-modello'); ?></label>
            <input type="text" name="cb5_headings_color" id="cb5_headings_color" value="<?php echo get_option('cb5_headings_color');?>" class="color"/></div>

        <div class="pd5"><label for="cb5_links_color"><?php _e('Links color','cb-modello'); ?></label>
            <input type="text" name="cb5_links_color" id="cb5_links_color" value="<?php echo get_option('cb5_links_color');?>" class="color"/></div>

        <div class="pd5"><label for="cb5_links_hover_color"><?php _e('Links hover color','cb-modello'); ?></label>
            <input type="text" name="cb5_links_hover_color" id="cb5_links_hover_color" value="<?php echo get_option('cb5_links_hover_color');?>" class="color"/></div>
            
        <div class="pd5"><label for="cb5_cap_bg"><?php _e('Image Captions Background','cb-modello'); ?></label>
            <input type="text" name="cb5_cap_bg" id="cb5_cap_bg" value="<?php echo get_option('cb5_cap_bg');?>" class="color"/></div>
            
        <div class="pd5">
            <?php generate_check(__('Disable captions?', 'cb-modello'),get_option('cb5_disca'), 'cb5_disca');?>
                
        </div>
            
        <div class="pd5">
            <?php echo generate_hint('Your custom css code'); ?>
            <label for="cb5_add_css">
            <?php _e('Additional CSS','cb-modello'); ?></label>
            <textarea name="cb5_add_css" id="cb5_add_css" style="width:300px;height:100px;"><?php echo get_option('cb5_add_css'); ?></textarea></div>

        </div><!-- extend end -->

        <!--## STYLES SECTION END ##-->

    <input type="hidden" name="tab" class="cb-tab" value="cb-styles-page" />
    <input type="hidden" name="action" value="save_cb_styles" />
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="cb-save"></div>
</form>
<?php
}