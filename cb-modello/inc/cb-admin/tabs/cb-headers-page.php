<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:52
 */
add_action( 'wp_ajax_nopriv_save_cb_headers', 'save_cb_headers' );
add_action( 'wp_ajax_save_cb_headers', 'save_cb_headers' );


function save_cb_headers() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';
    update_option('cb5_mheadertype', esc_attr($data['cb5_mheadertype']));
    update_option('cb5_headertransparent', esc_attr($data['cb5_headertransparent']));
    update_option('cb5_slidertoptint', esc_attr($data['cb5_slidertoptint']));
    update_option('cb5_skinimp', esc_attr($data['cb5_skinimp']));
    update_option('cb5_fixed_top', esc_attr($data['cb5_fixed_top']));
    update_option('cb5_lang_top', esc_attr($data['cb5_lang_top']));
    update_option('cb5_header_min', esc_attr($data['cb5_header_min']));
    update_option('cb5_header_line', esc_attr($data['cb5_header_line']));



    die($response);
}

function show_cb_headers_page(){
?>
        <h3>Header Settings</h3>
        <div class="tab_desc">Header and menu settings</div>
        

<form method="post" class="cb-admin-form">
    <!-- HEADERS AND MENU SECTION START -->

        <div class="pd5" style="border-top:none;">
            <?php  generate_select(__('Header Type', 'cb-modello'),get_option('cb5_mheadertype'), array(
            array('center', __('center menu, center logo', 'cb-modello')),
            array('left', __('left menu, left logo', 'cb-modello'))), 'cb5_mheadertype');?>
        </div>

        <div class="pd5 ">
            <?php echo generate_hint('First widgets area on top of page.'); ?>
            <?php generate_check(__('Lang bar area?', 'cb-modello'),get_option('cb5_lang_top'), 'cb5_lang_top');?>
        </div>
    <div class="pd5"><label for="cb5_logo_font"><?php _e('Header minimum height', 'cb-modello'); ?></label>

        <div class="slider_inside">
            <input type="text" name="cb5_header_min" id="cb5_header_min"
                   value="<?php echo get_option('cb5_header_min'); ?>" data-slider="true" data-slider-step="1"
                   data-slider-range="100,600" data-slider-highlight="true"/>
            <?php _e('px', 'cb-modello'); ?>
        </div>
        <div class="clear"></div>
    </div>
        <div class="pd5 hide">
            <?php echo generate_hint('Header will stay in one place while you scroll'); ?>
            <?php generate_check(__('Floating Header area?', 'cb-modello'),get_option('cb5_fixed_top'), 'cb5_fixed_top');?>
        </div>
        

        <div class="pd5">
        <label>Setting icons in Menu</label>
        <div class="cl"></div>
        1. If you want to add custom icon to your menu copy icon name from <a href="<?php echo WP_THEME_URL;?>/docs/documentation.html#icons" target="_blank">here</a><br/>
        2. Go to Wordpress DA-> Appearance-> Menus.<br/>
        3. Select your menu and click Screen Options on the top right.<br/>
        4. Click CSS checkbox.<br/>
        5. Now when you click little triangle on the right of your menu item you will see CSS Classes input field.<br/>
        6. Paste your icon name into CSS Classes input field. (for example: "icon-anchor")<br/>
        7. Save<br/><br/>

        You can control icon size by adding "small" or "big" to css class. <br/>
        For example it will look like this: <pre>icon-anchor big</pre>
        <br/>
        <?php /*
        <div class="pd5" style="border-top:none;"><label for="showtopwidget"><?php _e('Show top widget on home','cb-modello'); ?>?</label>
            <select name="showtopwidget" id="showtopwidget"><option value="no" ><?php _e('no','cb-modello'); ?></option><option value="yes"<?php if($showtopwidget=='yes'){?> selected <?php } ?> ><?php _e('yes','cb-modello'); ?></option></select></div>
        */ ?>
        </div>
        
        <div class="pd5 ">
            <?php generate_check(__('Hide left position menu header line?', 'cb-modello'),get_option('cb5_header_line'), 'cb5_header_line');?>
        </div>
        
        <div class="pd5 hide">
            <?php echo generate_hint('Header background will be transparent'); ?>
            <?php generate_check(__('Transparent header?', 'cb-modello'),get_option('cb5_headertransparent'), 'cb5_headertransparent');?>
                
        </div>
  <div class="pd5 hide">
            <?php generate_select(__('Floating Header Background', 'cb-modello'),get_option('cb5_skinimp'), array(
                array('black', __('black', 'cb-modello')),
                array('white', __('white', 'cb-modello'))), 'cb5_skinimp');?>
         </div>
        <div class="pd5 hide">
            <?php echo generate_hint('Tinting effect for the header background'); ?>
            <?php generate_select(__('Tint header?', 'cb-modello'),get_option('cb5_slidertoptint'), array(
                array('blight', __('black light', 'cb-modello')),
                array('bdark', __('black dark', 'cb-modello')),
                array('wlight', __('white light', 'cb-modello')),
                array('wdark', __('white dark', 'cb-modello')),
                array('no', __('no', 'cb-modello'))), 'cb5_slidertoptint');?>
         </div>

    <!-- ## HEADER AND MENU SECTION END ## -->

    <input type="hidden" name="tab" class="cb-tab" value="cb-headers-page" />
    <input type="hidden" name="action" value="save_cb_headers" />
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="cb-save" ></div>
</form>
<?php
}