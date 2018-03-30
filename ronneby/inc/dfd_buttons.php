<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
<a class="dfd-fixed-button dfd-buy dfd-tablet-hide" href="http://themeforest.net/item/ronneby-highperformance-wordpress-theme/11776839?ref=dfdevelopment&license=regular&open_purchase_for_item_id=9713415&purchasable=source" title="purchase theme" target="_blank"><i class="dfd-icon-trolley_add"></i><?php _e('Purchase theme', 'dfd') ?></a>
*/
if(isset($dfd_ronneby['extra_header_options']) && $dfd_ronneby['extra_header_options'] == 'on') : ?>
	<a class="dfd-new-fixed-buttons dfd-mail dfd-tablet-hide" href="http://themeforest.net/user/DFDevelopment#contact" title="send us a message" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/img/contact-us.png" /></a>
	<a class="dfd-new-fixed-buttons dfd-buy dfd-tablet-hide" href="http://themeforest.net/item/ronneby-highperformance-wordpress-theme/11776839?ref=dfdevelopment&license=regular&open_purchase_for_item_id=9713415&purchasable=source" title="purchase theme" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/img/cart-icon.png" /><span><?php _e('Buy', 'dfd') ?></span><?php _e('Ronneby','dfd') ?><span><?php _e('on','dfd') ?></span><img src="<?php echo get_template_directory_uri() ?>/assets/img/envato-label.png" /></a>
<?php else : ?>
	<a class="dfd-fixed-button dfd-buy dfd-tablet-hide" href="http://themeforest.net/item/ronneby-highperformance-wordpress-theme/11776839?ref=dfdevelopment&license=regular&open_purchase_for_item_id=9713415&purchasable=source" title="purchase theme" target="_blank"><i class="dfd-icon-trolley_add"></i><?php _e('Purchase theme', 'dfd') ?></a>
	<a class="dfd-fixed-button dfd-mail dfd-tablet-hide" href="http://themeforest.net/user/DFDevelopment#contact" title="send us a message" target="_blank"><i class="dfd-icon-send_mail"></i><?php _e('Send us a message', 'dfd') ?></a>
<?php endif; ?>