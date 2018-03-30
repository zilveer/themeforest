<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:52
 */
add_action( 'wp_ajax_nopriv_save_cb_home', 'save_cb_home' );
add_action( 'wp_ajax_save_cb_home', 'save_cb_home' );


function save_cb_home() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';

    update_option('cb5_home_template', esc_attr($data['cb5_home_template']));
    update_option('cb5_h_title', esc_attr($data['cb5_h_title']));
    update_option('cb5_h_more', esc_attr($data['cb5_h_more']));
    update_option('cb5_home_number', esc_attr($data['cb5_home_number']));
    update_option('cb5_home_limit', esc_attr($data['cb5_home_limit']));
    update_option('cb5_home_cat', esc_attr($data['cb5_home_cat']));
    update_option('cb5_h_sid', esc_attr($data['cb5_h_sid']));


    die($response);
}
function show_cb_home_page(){
    ?>
    <form method="post" class="cb-admin-form">
        <!-- HOMEPAGE SECTION START ##-->
            <b><?php _e('Use this only if you did not set up home to a single page in Wordpress Settings -> Reading','cb-modello');?></b><br/><br/>

            <div class="pd5" style="border-top:none;">
                <?php generate_select(__('Home Layout', 'cb-modello'),get_option('cb5_home_template'), array(
                    array('4', __('4 Columns', 'cb-modello')),
                    array('3', __('3 Columns', 'cb-modello')),
                    array('2', __('2 Columns', 'cb-modello')),
                    array('1', __('1 Columns', 'cb-modello'))), 'cb5_home_template');?>
            </div>

            <div class="pd5">
                <?php generate_select(__('Show title in posts with featured image', 'cb-modello'),get_option('cb5_h_title'), array(
                    array('yes', __('yes', 'cb-modello')),
                    array('no', __('no', 'cb-modello'))), 'cb5_h_title');?>
            </div>

            <div class="pd5">
                <?php generate_select(__('Show short description and details in posts with featured image', 'cb-modello'),get_option('cb5_h_more'), array(
                    array('yes', __('yes', 'cb-modello')),
                    array('no', __('no', 'cb-modello'))), 'cb5_h_more');?>
            </div>

            <div class="pd5"><label for="cb5_home_number"><?php _e('Home number of posts','cb-modello'); ?></label>
                <div class="slider_inside">
                <input type="text" name="cb5_home_number" id="cb5_home_number" value="<?php echo get_option('cb5_home_number');?>"  data-slider="true" data-slider-step="1" data-slider-range="1,40" data-slider-highlight="true"/>
                </div>
                <div class="clear"></div>
            </div>

            <div class="pd5"><label for="cb5_home_limit"><?php _e('Post characters limit','cb-modello'); ?></label>
                <div class="slider_inside">
                <input type="text" name="cb5_home_limit" id="cb5_home_limit" value="<?php echo get_option('cb5_home_limit');?>"  data-slider="true" data-slider-step="1" data-slider-range="1,1000" data-slider-highlight="true"/>
                </div>
                <div class="clear"></div>
                </div>

            <div class="pd5"><label for="cb5_home_cat"><?php _e('Home posts category','cb-modello'); ?></label>
                <?php wp_dropdown_categories('show_count=0&hierarchical=1&hide_empty=0&name=cb5_home_cat&selected='.get_option('cb5_home_cat').''); ?>
            </div>

            <div class="pd5"><label for="cb5_h_sid"><?php _e('Sidebar','cb-modello'); ?></label>
                <select name="cb5_h_sid" id="cb5_h_sid"><option value=""<?php if(get_option('cb5_h_sid')== ''){ echo " selected";} ?>>none</option><?php
                    global $wp_registered_sidebars;
                    $sidy = $wp_registered_sidebars;
                    if(is_array($sidy) && !empty($sidy)){
                        foreach($sidy as $side){
                            if(get_option('cb5_h_sid') == $side['name']){ echo "<option value='{$side['name']}' selected>{$side['name']}</option>\n";
                            } else { echo "<option value='{$side['name']}'>{$side['name']}</option>\n";}
                        }
                    } ?></select>
            </div>

        <!-- ## HOMEPAGE SECTION END ##-->


        <input type="hidden" name="tab" class="cb-tab" value="cb-home-page" />
        <input type="hidden" name="action" value="save_cb_home" />
        <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

        <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="button-primary btn" style="padding: 0 5px!important;"></div>
    </form>
<?php
}