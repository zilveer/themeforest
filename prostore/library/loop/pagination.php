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
 * @package 	proStore/library/loop/pagination.php
 * @file	 	1.0
 */
?>
<?php global $data, $prefix; ?>

<?php  if(show_posts_nav()) {	 ?>	
	<?php if (function_exists('page_navi') && $data[$prefix."default_content_pagination"]=="numbers") { // if expirimental feature is active ?>			
		<?php page_navi(); ?>
	<?php } elseif(function_exists('default_nav') && $data[$prefix."default_content_pagination"]!="numbers") { // if it is disabled, display regular wp prev & next links ?>
		<?php default_nav(); ?>
	<?php } ?>
<?php } ?>