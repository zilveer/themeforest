<footer id="footer"><?php

$footer_sidebar_1 = get_theme_mod('footer_sidebar_1', 'vc_col-sm-6');
$footer_sidebar_2 = get_theme_mod('footer_sidebar_2', 'disabled');
$footer_sidebar_3 = get_theme_mod('footer_sidebar_3', 'disabled');
$footer_sidebar_4 = get_theme_mod('footer_sidebar_4', 'vc_col-sm-6');

if( $footer_sidebar_1 != 'disabled' || $footer_sidebar_2 != 'disabled' || $footer_sidebar_3 != 'disabled' || $footer_sidebar_4 != 'disabled' ) { ?>

<div id="prefooter">
	<div class="container">
		<div class="vc_row">

			<?php if( $footer_sidebar_1 != 'disabled' ) {
				echo('<div class="' . $footer_sidebar_1 . '">');
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-sidebar-1'));
				echo('</div>');
			} ?>

			<?php if( $footer_sidebar_2 != 'disabled' ) {
				echo('<div class="' . $footer_sidebar_2 . '">');
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-sidebar-2'));
				echo('</div>');
			} ?>

			<?php if( $footer_sidebar_3 != 'disabled' ) {
				echo('<div class="' . $footer_sidebar_3 . '">');
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-sidebar-3'));
				echo('</div>');
			} ?>

			<?php if( $footer_sidebar_1 != 'disabled' ) {
				echo('<div class="' . $footer_sidebar_4 . '">');
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-sidebar-4'));
				echo('</div>');
			} ?>

		</div>
	</div>
</div><?php 

}

$footer_text = get_theme_mod('footer_text', '&copy; 2015 Jobseek - Responsive Job Board WordPress Theme<br>Designed &amp; Developed by <a href="http://themeforest.net/user/Coffeecream" target="_blank">Coffeecream Themes</a>');

$social_profiles = array(
	'facebook'      => get_theme_mod('facebook'),
	'twitter-bird'  => get_theme_mod('twitter-bird'),
	'google-plus-1' => get_theme_mod('google-plus-1'),
	'linkedin'      => get_theme_mod('linkedin'),
	'youtube-clip'  => get_theme_mod('youtube-clip'),
	'instagram'     => get_theme_mod('instagram'),
);

if( !empty( $footer_text ) ) { ?>
	<div id="credits">
		<?php foreach ($social_profiles as $key => $value) {
			if( !empty($value) ) {
				echo '<a href="' . $value . '"><i class="icon-logo-' . $key . '"></i></a>';
			}
		} ?>
		<div class="container"><?php echo ent2ncr($footer_text); ?></div>
	</div>
<?php } ?>

</footer>
<?php wp_footer(); ?>
</body>
</html>