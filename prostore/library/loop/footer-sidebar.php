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
 * @package 	proStore/library/loop/footer-sidebar.php
 * @file	 	1.0
 */
?>
<?php global $data, $prefix; ?>

<?php

	if (   ! is_active_sidebar( 'footer-sidebar-1'  )
			&& ! is_active_sidebar( 'footer-sidebar-2' )
			&& ! is_active_sidebar( 'footer-sidebar-3'  )
			&& ! is_active_sidebar( 'footer-sidebar-4'  )
		)
		return;
		
	
	echo '<div class="footer widget-area hide-on-print';
	if($data[$prefix."responsive_sidebar_footer"]!="1") echo " hide-for-small";
	echo '">';
		echo '<div role="complementary">';
			echo '<div class="row">';
			
				switch($data[$prefix."footer_sidebar_layout"]) {							
					case "two" :
						$class = "six";
						$i=2;								
						break;									
					case "three" : 
						$class = "four";
						$i=3;									
						break;									
					case "four" : 
						$class = "three";
						$i=4;									
						break;							
				}
					
				for ($k=1;$k<=$i;$k++) {							
					echo '<div class="'.$class;
					if($i==$k) echo ' clearfix'; 
					echo ' columns">';								
						dynamic_sidebar( 'footer-sidebar-'.$k );									
					echo '</div>';							
				}
		
			echo '</div>';
		echo '</div>';
	echo '</div>';

?>