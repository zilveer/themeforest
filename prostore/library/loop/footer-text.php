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
 * @package 	proStore/library/loop/footer-text.php
 * @file	 	1.0
 */
?>
<?php global $data, $prefix; ?>

<?php
				
	echo '<section role="contentinfo" class="row container hide-on-print">';	
			
		$text_align = 'text-'.$data[$prefix."footer_section_last_text_align"];
			
			echo '<p class="twelve columns '.$text_align.' attribution';
			if($data[$prefix."footer_section"]!="1") echo ' last';
			echo '">';			
				echo nl2br($data[$prefix."footer_section_last_text"]);
			echo '</p>';	
						
	echo '</section>';

?>