<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

get_sidebar('shop'); ?>
    
            <div class="product-extra span<?php echo (yit_get_sidebar_layout() != 'sidebar-no') ? 9 : 12 ?>">
                <?php do_action('woocommerce_after_sidebar'); ?> 
            </div>
    
        </div>    
    </div>
</div>