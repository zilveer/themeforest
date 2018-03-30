<?php

function theme_admin_notice() {
	echo "<div class='error'>" . sprintf( __( 'Your hosting currently use version of PHP %s. To get this theme worked properly you should ask your hosting provider to turn on at least version of PHP5 on your hosting.' ), phpversion() ) . "</div>";
}

if (version_compare(phpversion(), "5.0.0", "<"))
	add_action( 'admin_notices', 'theme_admin_notice' );
else {
	require_once(TEMPLATEPATH . '/functions/core.php');
	require_once(TEMPLATEPATH . '/functions/fonts.php');
	require_once(TEMPLATEPATH . '/functions/custom_types/post_types.php');
	require_once(TEMPLATEPATH . '/functions/custom_types/portfolio.php');
	require_once(TEMPLATEPATH . '/functions/sidebars.php');
	require_once(TEMPLATEPATH . '/functions/thumbnails.php');
	require_once(TEMPLATEPATH . '/functions/short_codes.php');
	require_once(TEMPLATEPATH . '/functions/breadcrumbs.php');
	require_once(TEMPLATEPATH . '/functions/colors.php');
	require_once(TEMPLATEPATH . '/functions/custom_types/sliders.php');
	require_once(TEMPLATEPATH . '/functions/social_links.php');
	require_once(TEMPLATEPATH . '/functions/options.php');
	require_once(TEMPLATEPATH . '/functions/comments.php');
}

?>