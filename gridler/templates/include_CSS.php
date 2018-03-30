<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<style type="text/css">
/* Background Image */
body {
	background:url("<?php bloginfo('template_directory'); ?>/images/bg/patterns/<?php echo of_get_option('bg_pattern' ); ?>.png") repeat;
}

/* Links */
a, a:visited {
	color:<?php echo of_get_option('link_color')?>;
}
a:hover {
	color:<?php echo of_get_option('link_color_hover')?>;
	text-decoration:none;
}
/* Custom Fonts */
h1, h2, h3, h4, h5, h6, .gfont, .form-submit {
	font-family: <?php echo of_get_option('google_font_css')?>;
}
/* h1 Image Replacement Logo */
h1#logo {
	background: url("<?php echo of_get_option('logo'); ?>") no-repeat;
	display: inline;
    height: <?php echo of_get_option('logo_height'); ?>px;
    text-indent: -4000px;
    width: <?php echo of_get_option('logo_width'); ?>px;
}
h1#logo a {
    display: block;
    height: <?php echo of_get_option('logo_height'); ?>;
}
</style>