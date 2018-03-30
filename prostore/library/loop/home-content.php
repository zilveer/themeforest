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
 * @package 	proStore/library/loop/home-content.php
 * @file	 	1.1
 */
?>
<?php global $data, $prefix; ?>

<?php

	$modules = $data[$prefix."home_modules_blocks"]['enabled'];
	unset($modules['placebo']);
	$desired_id = "";

/*
	if(array_key_exists('custom-page',$modules)) {
		$home_page = $data[$prefix."home_modules_custom-page"];
		$desired_home = $data[$prefix."home_module_custom-page_custom"];
		$current_home = get_option('show_on_front');
		$current_home_id = get_option('page_on_front');
		if($home_page == "Shop" || $home_page == "Custom page") {
			if($current_home!="page") {
				update_option('show_on_front','page');
			}
			if($current_home_id!=$desired_id) {
				if($home_page == "Shop" && plugin_is_active('woocommerce/woocommerce.php')=="activated") {
					update_option('page_on_front',woocommerce_get_page_id( 'shop' ));
				} else {
					update_option('page_on_front',$desired_home);
				}
			}

		}
	} else {
		update_option('show_on_front','posts');
	}
*/

/* ! */if($_GET['home_layout']=="alt") {
		$modules = array('welcome-message' => 'Welcome message',  'featured-product' => 'Featured Products', 'sale-product' => 'On-sale Products', 'recent-product' => 'Recent Products',  'cat-product' => 'Shop categories', 'blog-post' => 'Blog posts', 'sidebar' => 'Sidebar' );

/* ! */	}

	if(count($modules)>0) {
		echo '<div class="row container">';

		foreach($modules as $module=>$module_name) {
			switch($module) {
				case "featured-product" :
					$carousel = $data[$prefix."home_modules_featured-product_carousel"]!='1' ? 'false' : 'true';
					shortcode_products(array('type'=>'featured','count'=>$data[$prefix."home_modules_featured-product_count"],'carousel'=>$carousel,'title'=>$data[$prefix."home_modules_featured-product_title"]));
					break;
				case "recent-product" :
					$carousel = $data[$prefix."home_modules_recent-product_carousel"]!='1' ? 'false' : 'true';
					shortcode_products(array('type'=>'recent','count'=>$data[$prefix."home_modules_recent-product_count"],'carousel'=>$carousel,'title'=>$data[$prefix."home_modules_recent-product_title"]));
					break;
				case "sale-product" :
					$carousel = $data[$prefix."home_modules_sale-product_carousel"]!='1' ? 'false' : 'true';
					shortcode_products(array('type'=>'sale','count'=>$data[$prefix."home_modules_sale-product_count"],'carousel'=>$carousel,'title'=>$data[$prefix."home_modules_sale-product_title"]));
					break;
				case "cat-product" :
					$carousel = $data[$prefix."home_modules_cat-product_carousel"]!='1' ? 'false' : 'true';
					shortcode_products(array('type'=>'cat','count'=>'','carousel'=>$carousel,'title'=>$data[$prefix."home_modules_cat-product_title"]));
					break;
				case "tab-product" :
					$tabs = $data[$prefix."home_modules_tab-product"]['enabled'];
					unset($tabs['placebo']);
					if(count($tabs)>1) {
						$carousel = $data[$prefix."home_modules_tab-product_carousel"]!='1' ? 'false' : 'true';
						$number = $data[$prefix."home_modules_tab-product_count"];
						$i=1;
						echo '<dl class="tabs">';
							foreach($tabs as $type=>$title) {
								switch($type) {
									case "featured" :
										$title = $data[$prefix."home_modules_featured-product_title"]!="" ? $data[$prefix."home_modules_featured-product_title"] : $title;
										break;
									case "recent" :
										$title = $data[$prefix."home_modules_recent-product_title"]!="" ? $data[$prefix."home_modules_recent-product_title"] : $title;
										break;
									case "sale" :
										$title = $data[$prefix."home_modules_sale-product_title"]!="" ? $data[$prefix."home_modules_sale-product_title"] : $title;
										break;
								}
								echo '<dd class="';
								if($i=="1") echo "active";
								echo '"><a href="#home-tab-'.$type.'" data-toggle="pill">'.$title.'</a></dd>';
								$i++;
							}
						echo '</dl>';
						$j=1;
						$type = "";
						$title = "";
						echo '<ul class="tabs-content">';
							foreach($tabs as $type=>$title) {
								echo '<li id="home-tab-'.$type.'" class="';
								if($j=="1") echo "active";
								echo '">';
									shortcode_products(array('type'=>$type,'count'=>$number,'carousel'=>$carousel,'title'=>''));
								echo '</li>';
								$j++;
							}
						echo '</ul>';
					}
					break;
				case "welcome-message" :
/*
					if($data[$prefix."home_modules_welcome-message_color"]!="none") {
						$class = $data[$prefix."home_modules_welcome-message_color"]."-bg";
					}
*/
					if($data[$prefix."home_modules_welcome-message_boxed"]=="1") {
						$class = "panel ";
					}
					echo '<div class="home-welcome '.$class.' text-'.$data[$prefix."home_modules_welcome-message_align"].'">';
						if($data[$prefix."home_modules_welcome-message_title"]!="") {
							echo '<h1>'.$data[$prefix."home_modules_welcome-message_title"].'</h1>';
						}
						if($data[$prefix."home_modules_welcome-message_caption"]!="") {
							echo '<div>'.$data[$prefix."home_modules_welcome-message_caption"].'</div>';
						}
					echo '</div>';
					break;
				case "blog-post" :
					$sticky = $data[$prefix."home_modules_blog-post_sticky"]!='1' ? '0' : '1';
					$per_page = $data[$prefix."home_modules_blog-post_count"];
					$layout = $data[$prefix."home_modules_blog-post_layout"];
					if($data[$prefix."home_modules_blog-post_category"]=="0") {
						echo do_shortcode('[posts layout="'.$layout.'" order="" orderby="" pagination="0" per_page="'.$per_page.'" ignore_sticky="0" only_sticky="'.$sticky.'"]');
					} else {
						echo do_shortcode('[posts_by_category id="'.$data[$prefix."home_modules_blog-post_category"].'" layout="'.$layout.'" order="" orderby="" pagination="0" per_page="'.$per_page.'" ignore_sticky="0" only_sticky="'.$sticky.'"]');
					}
					echo do_shortcode('[spacer]');
					break;
				case "sidebar" :
					$count = $data[$prefix."home_modules_sidebar_count"];
					$sidebars = array();
					$sidebars[]=$data[$prefix."home_modules_sidebar_one"];
					$sidebars[]=$data[$prefix."home_modules_sidebar_two"];
					if($count == "three") {
						$sidebars[]=$data[$prefix."home_modules_sidebar_three"];
					}
					if($count == "four") {
						$sidebars[]=$data[$prefix."home_modules_sidebar_three"];
						$sidebars[]=$data[$prefix."home_modules_sidebar_four"];
					}

					echo '<div class="home widget-area hide-on-print';
					if($data[$prefix."responsive_sidebar"]!="1") echo " hide-for-small";
					echo '">';
						echo '<div role="complementary">';
							echo '<div class="row">';

								switch(count($sidebars)) {
									case "2" :
										$class = "six";
										$i=2;
										break;
									case "3" :
										$class = "four";
										$i=3;
										break;
									case "4" :
										$class = "three";
										$i=4;
										break;
								}

								for ($k=0;$k<count($sidebars);$k++) {
									echo '<div class="'.$class;
									if($i==$k) echo ' clearfix';
									echo ' columns">';
										dynamic_sidebar( $sidebars[$k] );
									echo '</div>';
								}

							echo '</div>';
						echo '</div>';
					echo '</div>';
					break;
			}
		}

		echo '</div>';
	}
?>