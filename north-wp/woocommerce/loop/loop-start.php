<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

?>
<?php if (isset($_GET['sidebar'])) { $sidebar_pos = htmlspecialchars($_GET['sidebar']); } else { $sidebar_pos = ot_get_option('shop_sidebar'); }  ?>
<?php $columns = ($sidebar_pos != 'no' ? 3 : 4); ?>
<div class="products row align-center <?php $columns = ($sidebar_pos != 'no' ? 'full-width-row' : ''); ?>">