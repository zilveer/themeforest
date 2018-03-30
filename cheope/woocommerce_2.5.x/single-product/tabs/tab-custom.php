<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post;

$tabs = yit_get_post_meta($post->ID, '_custom_tabs');

if( !empty( $tabs ) ) {
    foreach( $tabs as $tab ) :
    	if($tab["name"] != "" && $tab["value"] != "") :
        ?>
        	<li class="custom_tab"><a href="#tab-custom-<?php echo $tab["position"] ?>"><?php echo $tab["name"]?></a></li>
        	
        <?php
        endif;
    endforeach;
}
?>