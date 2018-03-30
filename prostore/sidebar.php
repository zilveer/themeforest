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
 * @package 	proStore/sidebar.php
 * @file	 	1.0
 */
?>
<?php 
	global $data, $prefix, $post;
	if(is_singular('post')) {
		$layout = $data[$prefix."default_layout_post"];
	} elseif(is_singular('page')) {
		$layout = $data[$prefix."default_layout_page"];
	} elseif(is_singular('portfolio')) {
		$layout = $data[$prefix."default_layout_portfolio"];
	} else {
		$layout = $data[$prefix."default_layout"];			
	}
	$choice = 'sidebar1';
	if(is_singular()) {
		$layout = get_post_meta($post->ID,'sidebar_position',true) =="" ? $layout : get_post_meta($post->ID,'sidebar_position',true);	
		$choice = get_post_meta($post->ID,'sidebar_choice',true) == "" ? 'sidebar1' : get_post_meta($post->ID,'sidebar_choice',true);	
	}
?>
				
	<div id="sidebar1" class="sidebar four <?php if($layout=="left") echo "pull-eight"; ?> <?php if($data[$prefix."responsive_sidebar"]!="1") echo "hide-for-small"; ?> columns" role="complementary">

		<div class="panel">
			<?php 
			
				if(is_active_sidebar( $choice )) {
				
					dynamic_sidebar( $choice );
					
				} else {
				
					echo '<div class="alert-box">Please activate some Widgets.</div>';
				
				}
				
			?>

		</div>

	</div>