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
 * @package 	proStore/footer.php
 * @file	 	1.0
 */
?>
<?php global $data, $prefix; ?>

		</div><!-- #content -->

		<div class="clear"></div>

		<?php

			if($data[$prefix."footer_sidebar"]=="1") {
				get_template_part('library/loop/footer','sidebar');
			}

			if($data[$prefix."footer_section"]=="1") {
				get_template_part('library/loop/footer','section');
			}

			if($data[$prefix."footer_section_last"]=="1") {
				get_template_part('library/loop/footer','text');
			}

		?>

		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

		<?php
			if($data[$prefix."google_analytics"]!="") {
    			echo $data[$prefix."google_analytics"];
			}
		?>

		<?php do_action('custom_foot'); ?>

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>