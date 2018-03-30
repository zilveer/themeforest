<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/shop/errors.php
 * @sub-package WooCommerce/Templates/shop/errors.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php if ( ! $errors ) return; ?>

<ul class="woocommerce_message alert alert-box">
	<li><span class="alert-color"><em class="icon-cancel"></em></span></li>
	<?php foreach ( $errors as $error ) : ?>
		<li><?php echo $error; ?></li>
	<?php endforeach; ?>
</ul>