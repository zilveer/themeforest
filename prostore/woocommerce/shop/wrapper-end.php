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
 * @package 	proStore/woocommerce/shop/wrapper-end.php
 * @sub-package WooCommerce/Templates/shop/wrapper-end.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php

	global $data, $prefix;	
	
	$sidebar_choice = $data[$prefix."woocommerce_layout_sidebar_choice"];
	
	$filter_layout = $data[$prefix."woocommerce_layout_main"];
	
	switch($filter_layout) {
		case "horizontal" : 
			$main_class = "twelve horizontal";
			$sidebar_class = "hidden";
			$sidebar_min_class = "";
			$sidebar_min_icon = "";
			$sidebar_horizontal_class="twelve";
			break;
		case "vertical-right" :
			$main_class = "eight b-right";
			$sidebar_class = "four b-left";
			$sidebar_min_class = "one b-left";
			$sidebar_min_icon = "right";
			$sidebar_horizontal_class="hidden";
			break;
		case "none" :
			$main_class = "twelve";
			$sidebar_class = "hidden";
			$sidebar_min_class = "hidden";
			$sidebar_min_icon = "";
			$sidebar_horizontal_class="hidden";
			break;
		default : 
			$main_class = "eight push-four b-left";
			$sidebar_class = "four pull-eight b-right";
			$sidebar_min_class = "one pull-eleven b-right";	
			$sidebar_min_icon = "left";
			$sidebar_horizontal_class="hidden";	
			break;
	}
	if($data[$prefix."woocommerce_responsive_sidebar"]!="1") {
		$sidebar_class .=" store-sidebar-responsive";
		$sidebar_min_class .=" store-sidebar-responsive";
	}

?>

		</div>
		<div class="store_filter_sidebar minimal column <?php echo $sidebar_min_class; ?> clearfix" role="complementary mobile-one">
			<h3 class="section-title text-center">
				<em class="icon-th-list-summary"></em>
			</h3>
		</div>
		<div class="store_filter_sidebar <?php echo $sidebar_class; ?> columns clearfix" role="complementary">
			<?php
				switch($sidebar_choice) {
					case "custom" : 
						get_template_part('library/loop/shop','sidebar');
						break;
					default :
						echo '<h3 class="section-title clearfix">&nbsp;</h3>';
						if ( is_active_sidebar( 'sidebar2' ) ) {
							dynamic_sidebar( 'sidebar2' );
						}
						break;
				}
			?>
		</div>
		
	</div>