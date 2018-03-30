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
 * @package 	proStore/library/loop/footer-section.php
 * @file	 	1.0
 */
?>
<?php global $data, $prefix; ?>

<?php

	$footer_blocks = $data[$prefix."footer_section_blocks"]['enabled'];
	unset($footer_blocks['placebo']);

	$blocks_count = count($footer_blocks);

	switch($blocks_count) {
		case "2" :
			$fclass="six"; break;
		case "3" :
			$fclass="four"; break;
		case "4" :
			$fclass="three"; break;
	}

	echo '<footer role="contentinfo" class="hide-on-print">';

		echo '<div class="row container">';

			$j=1;
			$total = count($footer_blocks);
			foreach($footer_blocks as $type=>$value) {
				if($j==1) { $text_align = "text-left"; }
				elseif($j<$total && $j>1) { $text_align = "text-center"; }
				elseif($j==$total) { $text_align = "text-right"; }

				echo '<div class="'.$fclass.' columns '.$text_align.'">';
					switch($type) {
						case "menu" :
							prostore_footer_links();
							break;
						case "social" :
							if( function_exists('zilla_social') ) zilla_social();
							break;
						case "text" :
							echo nl2br($data[$prefix."footer_section_content"]);
							break;
					}
				echo '</div>';
				$j++;
			}

		echo '</div>';

	echo '</footer>';

?>