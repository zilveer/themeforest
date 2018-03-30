<?php
/**
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:51
 */
add_action( 'wp_ajax_nopriv_save_cb_woo', 'save_cb_woo' );
add_action( 'wp_ajax_save_cb_woo', 'save_cb_woo' );


function save_cb_woo() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';

    update_option('cb5_sidebar_shop', esc_attr($data['cb5_sidebar_shop']));
    update_option('cb5_woo_menu', esc_attr($data['cb5_woo_menu']));
    update_option('cb5_woo_pagi', esc_attr($data['cb5_woo_pagi']));
    update_option('cb5_woo_cols', esc_attr($data['cb5_woo_cols']));
    update_option('cb5_woo_per_page', esc_attr($data['cb5_woo_per_page']));
    update_option('cb5_woo_related_c', esc_attr($data['cb5_woo_related_c']));
    update_option('cb5_woo_related_n', esc_attr($data['cb5_woo_related_n']));
    update_option('cb5_woo_catalog', esc_attr($data['cb5_woo_catalog']));
    update_option('cb5_woo_previews', esc_attr($data['cb5_woo_previews']));
    update_option('cb5_remhov', esc_attr($data['cb5_remhov']));
    update_option('cb5_hidegr', esc_attr($data['cb5_hidegr']));
    update_option('cb5_clicka', esc_attr($data['cb5_clicka']));
    update_option('cb5_listy', esc_attr($data['cb5_listy']));
    update_option('cb5_skus', esc_attr($data['cb5_skus']));
    update_option('cb5_hidereca', esc_attr($data['cb5_hidereca']));


    die($response);

}
function show_cb_woo(){
        ?>
        <h3>WooCommerce</h3>
        <div class="tab_desc">Global theme settings for your shop</div>
        
        <!-- WooCommerce SECTION START -->
        <form method="post" class="cb-admin-form">
        
        <div class="pd5">
            <?php generate_select(__('Sidebar Column', 'cb-modello'),get_option('cb5_sidebar_shop'), array(
                array('left', __('left', 'cb-modello')),
                array('right', __('right', 'cb-modello')),
                array('', __('none-full width', 'cb-modello'))), 'cb5_sidebar_shop');?>
        </div>
        
        <div class="pd5">
            <?php echo generate_hint('List WooCommerce Categories in Header Main Menu?'); ?>
            <?php generate_check(__('Categories in Menu?', 'cb-modello'),get_option('cb5_woo_menu'), 'cb5_woo_menu');?>
        </div>
        
        <div class="pd5">
            <?php generate_select(__('Catalog Mode', 'cb-modello'),get_option('cb5_woo_catalog'), array(
                array('', __('No', 'cb-modello')),
                array('show_prices', __('Show prices, hide cart', 'cb-modello')),
                array('hide', __('Hide prices and cart', 'cb-modello'))), 'cb5_woo_catalog');?>
        </div>

        <div class="pd5 hide">
            <?php generate_check(__('Show quick previews?', 'cb-modello'),get_option('cb5_woo_previews'), 'cb5_woo_previews');?>
                
        </div>
        <div class="pd5">
            <?php generate_select(__('Pagination', 'cb-modello'),get_option('cb5_woo_pagi'), array(
                array('ajax', __('ajax', 'cb-modello')),
                array('normal', __('normal', 'cb-modello'))), 'cb5_woo_pagi');?>
        </div>
        
        <div class="pd5"><label for="cb5_woo_per_page"><?php _e('Products per page','cb-modello'); ?></label>
            <input type="text" name="cb5_woo_per_page" id="cb5_woo_per_page" value="<?php echo get_option('cb5_woo_per_page');?>"/></div>
        
        <div class="pd5">
            <?php generate_select(__('Number of columns', 'cb-modello'),get_option('cb5_woo_cols'), array(
                array('1', __('1', 'cb-modello')),
                array('2', __('2', 'cb-modello')),
                array('3', __('3', 'cb-modello')),
                array('4', __('4', 'cb-modello'))), 'cb5_woo_cols');?>
        </div>
        <div class="pd5">
            <?php generate_select(__('Related Columns', 'cb-modello'),get_option('cb5_woo_related_c'), array(
                array('1', __('1', 'cb-modello')),
                array('2', __('2', 'cb-modello')),
                array('3', __('3', 'cb-modello')),
                array('4', __('4', 'cb-modello'))), 'cb5_woo_related_c');?>
        </div>
        
        <div class="pd5"><label for="cb5_woo_related_n"><?php _e('Related Products per page','cb-modello'); ?></label>
            <input type="text" name="cb5_woo_related_n" id="cb5_woo_related_n" value="<?php echo get_option('cb5_woo_related_n');?>"/></div>
        
        <div class="pd5">
            <?php echo generate_hint('Will always show buttons in responsive mode(good for touch devices)'); ?>
            <?php generate_check(__('Dont hide buttons for mobiles?', 'cb-modello'),get_option('cb5_remhov'), 'cb5_remhov');?>
        </div>
        
        <div class="pd5">
            <?php echo generate_hint('Will hide grid and list buttons in product category'); ?>
            <?php generate_check(__('Hide grid and list buttons', 'cb-modello'),get_option('cb5_hidegr'), 'cb5_hidegr');?>
        </div>
        <div class="pd5">
            <?php generate_check(__('Clickable product images', 'cb-modello'),get_option('cb5_clicka'), 'cb5_clicka');?>
        </div>
        <div class="pd5">
            <?php generate_check(__('List View by default', 'cb-modello'),get_option('cb5_listy'), 'cb5_listy');?>
        </div>
        
        <div class="pd5">
            <?php generate_check(__('Show SKU in product view', 'cb-modello'),get_option('cb5_skus'), 'cb5_skus');?>
        </div>
        
        <div class="pd5">
            <?php generate_check(__('Hide price from recently viewed widget', 'cb-modello'),get_option('cb5_hidereca'), 'cb5_hidereca');?>
        </div>


    <input type="hidden" name="tab" class="cb-tab" value="cb-woo" />
    <input type="hidden" name="action" value="save_cb_woo" />
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="cb-save"></div>
</form>
    <?php


    }
