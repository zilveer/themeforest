<?php 
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( is_active_sidebar( 'catalog-widget-area' ) ) : ?>
        <?php dynamic_sidebar( 'catalog-widget-area' ); ?>
<?php endif; ?>