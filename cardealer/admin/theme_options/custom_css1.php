<?php
// Global Styles
$logo_font = TMM::get_option('logo_font');
if ($logo_font && ($logo_font != 'default_font')) {
	$logo_font = preg_split( '/:/', $logo_font );
	$logo_font = '"' . str_replace('+', ' ', $logo_font[0]) . '"';
}
else{
    unset($logo_font);
}
$logo_text_color = TMM::get_option('logo_text_color');
$logo_font_size = TMM::get_option('logo_font_size');
$general_font_family = TMM::get_option('general_font_family');

if ($general_font_family && ($general_font_family != 'default_font')) {
	$general_font_family = preg_split( '/:/', $general_font_family );
	$general_font_family = '"' . str_replace('+', ' ', $general_font_family[0]) . '"';
}
else{
    unset($general_font_family);
}
$general_font_size = TMM::get_option('general_font_size');
$general_text_color = TMM::get_option('general_text_color');
$general_normal_links_color = TMM::get_option('general_normal_links_color');
$general_mouseover_links_color = TMM::get_option('general_mouseover_links_color');
$general_brd_size = TMM::get_option('general_brd_size');
$general_brd_color = TMM::get_option('general_brd_color');
$secondary_brd_size = TMM::get_option('secondary_brd_size');
$secondary_brd_color = TMM::get_option('secondary_brd_color');

// Main Navigation
$main_nav_font = TMM::get_option('main_nav_font');
if ($main_nav_font && ($main_nav_font != 'default_font')) {
	$main_nav_font = preg_split( '/:/', $main_nav_font );
	$main_nav_font = '"' . str_replace('+', ' ', $main_nav_font[0]) . '"';
}
else{
    unset($main_nav_font);
}
$main_nav_level_2_font = TMM::get_option('main_nav_level_2_font');
if ($main_nav_level_2_font && ($main_nav_level_2_font != 'default_font')) {
	$main_nav_level_2_font = preg_split( '/:/', $main_nav_level_2_font );
	$main_nav_level_2_font = '"' . str_replace('+', ' ', $main_nav_level_2_font[0]) . '"';
}
else{
    unset($main_nav_level_2_font);
}

$main_nav_first_level_font_size = TMM::get_option('main_nav_first_level_font_size');
$main_nav_second_level_font_size = TMM::get_option('main_nav_second_level_font_size');

$main_nav_bg_top = TMM::get_option('main_nav_bg_top');
$main_nav_bg_sub = TMM::get_option('main_nav_bg_sub');

$main_nav_curr_item_bg_top_color = TMM::get_option('main_nav_curr_item_bg_top_color');
$main_nav_dd_curr_item_bg_top_color = TMM::get_option('main_nav_dd_curr_item_bg_top_color');

$main_nav_def_text_color = TMM::get_option('main_nav_def_text_color');
$main_nav_curr_text_color = TMM::get_option('main_nav_curr_text_color');
$main_nav_hover_text_color = TMM::get_option('main_nav_hover_text_color');

$main_nav_dd_def_text_color = TMM::get_option('main_nav_dd_def_text_color');
$main_nav_dd_curr_text_color = TMM::get_option('main_nav_dd_curr_text_color');
$main_nav_dd_hover_text_color = TMM::get_option('main_nav_dd_hover_text_color');

// Headings
$h1_font_family = TMM::get_option('h1_font_family');
if ($h1_font_family && ($h1_font_family != 'default_font')) {
	$h1_font_family = preg_split( '/:/', $h1_font_family );
	$h1_font_family = '"' . str_replace('+', ' ', $h1_font_family[0]) . '"';
}
else{
    unset($h1_font_family);
}
$h1_font_size = TMM::get_option('h1_font_size');
$h1_font_color = TMM::get_option('h1_font_color');
$h1_normal_link_color = TMM::get_option('h1_normal_link_color');
$h1_mouseover_link_color = TMM::get_option('h1_mouseover_link_color');

$h2_font_family = TMM::get_option('h2_font_family');
if ($h2_font_family && ($h2_font_family != 'default_font')) {
	$h2_font_family = preg_split( '/:/', $h2_font_family );
	$h2_font_family = '"' . str_replace('+', ' ', $h2_font_family[0]) . '"';
}
else{
    unset($h2_font_family);
}
$h2_font_size = TMM::get_option('h2_font_size');
$h2_font_color = TMM::get_option('h2_font_color');
$h2_normal_link_color = TMM::get_option('h2_normal_link_color');
$h2_mouseover_link_color = TMM::get_option('h2_mouseover_link_color');

$h3_font_family = TMM::get_option('h3_font_family');
if ($h3_font_family && ($h3_font_family != 'default_font')) {
	$h3_font_family = preg_split( '/:/', $h3_font_family );
	$h3_font_family = '"' . str_replace('+', ' ', $h3_font_family[0]) . '"';
}
else{
    unset($h3_font_family);
}
$h3_font_size = TMM::get_option('h3_font_size');
$h3_font_color = TMM::get_option('h3_font_color');
$h3_normal_link_color = TMM::get_option('h3_normal_link_color');
$h3_mouseover_link_color = TMM::get_option('h3_mouseover_link_color');

$h4_font_family = TMM::get_option('h4_font_family');
if ($h4_font_family && ($h4_font_family != 'default_font')) {
	$h4_font_family = preg_split( '/:/', $h4_font_family );
	$h4_font_family = '"' . str_replace('+', ' ', $h4_font_family[0]) . '"';
}
else{
    unset($h4_font_family);
}
$h4_font_size = TMM::get_option('h4_font_size');
$h4_font_color = TMM::get_option('h4_font_color');
$h4_normal_link_color = TMM::get_option('h4_normal_link_color');
$h4_mouseover_link_color = TMM::get_option('h4_mouseover_link_color');

$h5_font_family = TMM::get_option('h5_font_family');
if ($h5_font_family && ($h5_font_family != 'default_font')) {
	$h5_font_family = preg_split( '/:/', $h5_font_family );
	$h5_font_family = '"' . str_replace('+', ' ', $h5_font_family[0]) . '"';
}
else{
    unset($h5_font_family);
}
$h5_font_size = TMM::get_option('h5_font_size');
$h5_font_color = TMM::get_option('h5_font_color');
$h5_normal_link_color = TMM::get_option('h5_normal_link_color');
$h5_mouseover_link_color = TMM::get_option('h5_mouseover_link_color');

$h6_font_family = TMM::get_option('h6_font_family');
if ($h6_font_family && ($h6_font_family != 'default_font')) {
	$h6_font_family = preg_split( '/:/', $h6_font_family );
	$h6_font_family = '"' . str_replace('+', ' ', $h6_font_family[0]) . '"';
}else{
    unset($h6_font_family);
}
$h6_font_size = TMM::get_option('h6_font_size');
$h6_font_color = TMM::get_option('h6_font_color');
$h6_normal_link_color = TMM::get_option('h6_normal_link_color');
$h6_mouseover_link_color = TMM::get_option('h6_mouseover_link_color');

// Content
$content_font_color = TMM::get_option('content_font_color');
$content_font_family = TMM::get_option('content_font_family');
if ($content_font_family) {
	$content_font_family = preg_split( '/:/', $content_font_family );
	$content_font_family = '"' . str_replace('+', ' ', $content_font_family[0]) . '"';
}
else{
    unset($content_font_family);
}
$content_font_size = TMM::get_option('content_font_size');
$content_text_color = TMM::get_option('content_text_color');
$content_normal_link_color = TMM::get_option('content_normal_link_color');
$content_mouseover_link_color = TMM::get_option('content_mouseover_link_color');

// buttons
$buttons_font_family = TMM::get_option('buttons_font_family');
if ($buttons_font_family && ($buttons_font_family != 'default_font')) {
	$buttons_font_family = preg_split( '/:/', $buttons_font_family );
	$buttons_font_family = '"' . str_replace('+', ' ', $buttons_font_family[0]) . '"';
}
else{
    unset($buttons_font_family);
}
$buttons_font_size = TMM::get_option('buttons_font_size');
$buttons_text_color = TMM::get_option('buttons_text_color');
$buttons_bg_color = TMM::get_option('buttons_bg_color');
$buttons_hover_text_color = TMM::get_option('buttons_hover_text_color');
$buttons_hover_bg_color = TMM::get_option('buttons_hover_bg_color');

// widgets
$widget_title_color = TMM::get_option('widget_title_color');
$widget_title_first_color = TMM::get_option('widget_title_first_color');
$widget_text_color = TMM::get_option('widget_text_color');
$widget_link_color = TMM::get_option('widget_link_color');
$widget_link_hover_color = TMM::get_option('widget_link_hover_color');

$boxed_widget_title_color = TMM::get_option('boxed_widget_title_color');
$boxed_widget_title_first_color = TMM::get_option('boxed_widget_title_first_color');
$boxed_widget_title_bg_top_color = TMM::get_option('boxed_widget_title_bg_top_color');
$boxed_widget_title_bg_btm_color = TMM::get_option('boxed_widget_title_bg_btm_color');
$boxed_widget_text_color = TMM::get_option('boxed_widget_text_color');
$boxed_widget_bg_color = TMM::get_option('boxed_widget_bg_color');

$footer_widget_title_color = TMM::get_option('footer_widget_title_color');
$footer_widget_title_first_color = TMM::get_option('footer_widget_title_first_color');
$footer_widget_text_color = TMM::get_option('footer_widget_text_color');
$footer_widget_link_color = TMM::get_option('footer_widget_link_color');
$footer_widget_link_hover_color = TMM::get_option('footer_widget_link_hover_color');

// footer
$footer_bg = TMM::get_option('footer_bg');
$footer_text_color = TMM::get_option('footer_text_color');
$footer_link_color = TMM::get_option('footer_link_color');
$footer_link_hover_color = TMM::get_option('footer_link_hover_color');
$footer_brd_size = TMM::get_option('footer_brd_size');
$footer_brd_color = TMM::get_option('footer_brd_color');
?>

/* -------------------------------------------------- */
/*	Global Styles
/* -------------------------------------------------- */

body { <?php echo TMM_Helper::draw_body_bg() ?> }

<?php if (!empty($general_font_size) || !empty($general_text_color)): ?>

	body, p {
		color: <?php echo $general_text_color ?>;
		font-size: <?php echo $general_font_size ?>px;
	}

<?php endif; ?>
<?php if (!empty($general_font_family)): ?>

	body, p {
		font-family: <?php echo $general_font_family ?>, sans-serif;
	}

<?php endif; ?>

<?php if (!empty($general_normal_links_color)): ?>

	a, a > * { color: <?php echo $general_normal_links_color ?>; }

<?php endif; ?>

<?php if (!empty($general_mouseover_links_color)): ?>

	a:hover { color: <?php echo $general_mouseover_links_color ?>; }

<?php endif; ?>

<?php if (!empty($logo_font_size)): ?>

	#logo h1 {
		font-size: <?php echo $logo_font_size ?>px;
	}

<?php endif; ?>

<?php if (!empty($logo_text_color)){ ?>

	#logo h1 a {
		color: <?php echo $logo_text_color ?>;

	}

<?php } ?>

<?php if (!empty($logo_font)){ ?>

	#logo h1 a {
		font-family: <?php echo $logo_font ?>;
	}

<?php } ?>

<?php if (!empty($general_brd_size) || !empty($general_brd_color)): ?>

	blockquote {
		border-left: <?php echo $secondary_brd_size ?>px solid <?php echo $secondary_brd_color ?>;
	}

	.tmm-view-mode.item-list article:before,
	.wp-pagenavi,
	.entry.secondary,
	.comment .children,
	.comment {
		border-top: <?php echo $secondary_brd_size ?>px solid <?php echo $secondary_brd_color ?>;
	}

	.widget_recent_entries ul,
	.widget_categories ul,
	.widget_archive ul,
	.widget_links ul,
	.widget-title,
	.section-title,
    h2.title,
    .comment-reply-title {
		border-bottom: <?php echo $general_brd_size ?>px solid <?php echo $general_brd_color ?>;
	}

	.divider {
		height: <?php echo $general_brd_size ?>px;
		background-color: <?php echo $general_brd_color ?>;
	}

<?php endif; ?>

/* -------------------------------------------------- */
/*	Main Navigation
/* -------------------------------------------------- */

/* First Level font family and size */
<?php if (!empty($main_nav_font)): ?>

	.navigation > ul > li > a { font-family: <?php echo $main_nav_font ?>; }

<?php endif; ?>

<?php if (!empty($main_nav_first_level_font_size)): ?>

	.navigation > ul > li > a { font-size: <?php echo $main_nav_first_level_font_size ?>px; }

<?php endif; ?>

/* Sublevels font family and size */
<?php if (!empty($main_nav_level_2_font)): ?>

	.navigation > ul ul li a { font-family: <?php echo $main_nav_level_2_font ?>; }

<?php endif; ?>
<?php if (!empty($main_nav_second_level_font_size)): ?>

	.navigation > ul ul li a { font-size: <?php echo $main_nav_second_level_font_size ?>px; }

<?php endif; ?>

/* First Level navigation background */
<?php if (!empty($main_nav_bg_top)): ?>

	.header.classic .nav-bar .navigation { background-color:<?php echo $main_nav_bg_top ?> ; }

<?php endif; ?>

/* Sublevels navigation background */
<?php if (!empty($main_nav_bg_sub)): ?>

	.navigation > ul ul li,
	.navigation > ul ul li a { background-color:<?php echo $main_nav_bg_sub ?> ; }

<?php endif; ?>

/* First level default, hover and active url colors */
<?php if (!empty($main_nav_def_text_color)): ?>

	.navigation > ul > li > a { color: <?php echo $main_nav_def_text_color ?>; }

<?php endif; ?>

<?php if (!empty($main_nav_curr_text_color)): ?>

	.navigation > ul > li.current-menu-item > a,
	.navigation > ul > li.current-menu-parent > a,
	.navigation > ul > li.current-menu-ancestor > a { color: <?php echo $main_nav_curr_text_color ?>; }

<?php endif; ?>

<?php if (!empty($main_nav_hover_text_color)): ?>

	.navigation > ul > li:hover > a { color:<?php echo $main_nav_hover_text_color ?>; }

<?php endif; ?>

/* Sublevels default, hover and active url colors */
<?php if (!empty($main_nav_dd_def_text_color)): ?>

	.navigation > ul ul li a { color: <?php echo $main_nav_dd_def_text_color ?>; }

<?php endif; ?>

<?php if (!empty($main_nav_dd_curr_text_color)): ?>

	.navigation > ul > li:hover ul li.current-menu-item > a,
	.navigation > ul > li:hover ul li.current-menu-parent > a,
	.navigation > ul > li:hover ul li.current-menu-ancestor > a { color: <?php echo $main_nav_dd_curr_text_color ?>; }

<?php endif; ?>

<?php if (!empty($main_nav_dd_hover_text_color)): ?>

	.navigation > ul ul li:hover > a { color: <?php echo $main_nav_dd_hover_text_color ?>; }

<?php endif; ?>

/* First Level current item bg */
<?php if (!empty($main_nav_curr_item_bg_top_color)): ?>

	.navigation > ul > li.current-menu-item > a,
	.navigation > ul > li.current-menu-parent > a,
	.navigation > ul > li.current-menu-ancestor > a {
		background-color: <?php echo $main_nav_curr_item_bg_top_color ?>;
	}

<?php endif; ?>

/* Sublevels current item bg */
<?php if (!empty($main_nav_dd_curr_item_bg_top_color)): ?>

	.navigation > ul > li:hover ul li.current-menu-item > a,
	.navigation > ul > li:hover ul li.current-menu-parent > a,
	.navigation > ul > li:hover ul li.current-menu-ancestor > a {
		background-color: <?php echo $main_nav_dd_curr_item_bg_top_color ?>;
	}

<?php endif; ?>

/* -------------------------------------------------- */
/*	Headings
/* -------------------------------------------------- */

<?php if (!empty($h1_font_family) || !empty($h1_font_size) || !empty($h1_font_color) || !empty($h1_normal_link_color) || !empty($h1_mouseover_link_color)): ?>

	h1 {
		font-family:<?php echo $h1_font_family ?>;
		font-size:<?php echo $h1_font_size ?>px;
		color:<?php echo $h1_font_color ?>;
	}

	h1 a { color:<?php echo $h1_normal_link_color ?>; }
	h1 a:hover { color:<?php echo $h1_mouseover_link_color ?>; }

<?php endif; ?>

<?php if (!empty($h2_font_family) || !empty($h2_font_size) || !empty($h2_font_color) || !empty($h2_normal_link_color) || !empty($h2_mouseover_link_color)): ?>

	h2 {
		font-family:<?php echo $h2_font_family ?>;
		font-size:<?php echo $h2_font_size ?>px;
		color:<?php echo $h2_font_color ?>;
	}

	h2 a { color:<?php echo $h2_normal_link_color ?>; }
	h2 a:hover { color:<?php echo $h2_mouseover_link_color ?>; }

<?php endif; ?>

<?php if (!empty($h3_font_family) || !empty($h3_font_size) || !empty($h3_font_color) || !empty($h3_normal_link_color) || !empty($h3_mouseover_link_color)): ?>

	h3 {
		font-family:<?php echo $h3_font_family ?>;
		font-size:<?php echo $h3_font_size ?>px;
		color:<?php echo $h3_font_color ?>;
	}

	h3 a { color:<?php echo $h3_normal_link_color ?>; }
	h3 a:hover { color:<?php echo $h3_mouseover_link_color ?>; }

<?php endif; ?>

<?php if (!empty($h4_font_family) || !empty($h4_font_size) || !empty($h4_font_color) || !empty($h4_normal_link_color) || !empty($h4_mouseover_link_color)): ?>

	h4 {
		font-family:<?php echo $h4_font_family ?>;
		font-size:<?php echo $h4_font_size ?>px;
		color:<?php echo $h4_font_color ?>;
	}

	h4 a { color:<?php echo $h4_normal_link_color ?>; }
	h4 a:hover { color:<?php echo $h4_mouseover_link_color ?>; }

<?php endif; ?>

<?php if (!empty($h5_font_family) || !empty($h5_font_size) || !empty($h5_font_color) || !empty($h5_normal_link_color) || !empty($h5_mouseover_link_color)): ?>

	h5 {
		font-family:<?php echo $h5_font_family ?>;
		font-size:<?php echo $h5_font_size ?>px;
		color:<?php echo $h5_font_color ?>;
	}

	h5 a { color:<?php echo $h5_normal_link_color ?>; }
	h5 a:hover { color:<?php echo $h5_mouseover_link_color ?>; }

<?php endif; ?>

<?php if (!empty($h6_font_family) || !empty($h6_font_size) || !empty($h6_font_color) || !empty($h6_normal_link_color) || !empty($h6_mouseover_link_color)): ?>

	h6 {
		font-family:<?php echo $h6_font_family ?>;
		font-size:<?php echo $h6_font_size ?>px;
		color:<?php echo $h6_font_color ?>;
	}

	h6 a { color:<?php echo $h6_normal_link_color ?>; }
	h6 a:hover { color:<?php echo $h6_mouseover_link_color ?>; }

<?php endif; ?>

/* -------------------------------------------------- */
/*	Content
/* -------------------------------------------------- */

<?php if (!empty($content_font_color)): ?>

	.container #main {
		color: <?php echo $content_font_color ?>;
	}

<?php endif; ?>

/* -------------------------------------------------- */
/*	Buttons
/* -------------------------------------------------- */

<?php if ( !empty($buttons_font_size) || !empty($buttons_text_color) || !empty($buttons_bg_color) || !empty($buttons_hover_text_color) || !empty($buttons_hover_bg_color)): ?>

	#back-top,
	.tagcloud a,
	button,
	.button.orange,
	.button.dark:hover {
		font-size: <?php echo $buttons_font_size ?>px;
		color: <?php echo $buttons_text_color ?>;
		background-color: <?php echo $buttons_bg_color ?>;
	}

	#back-top:hover,
	.tagcloud a:hover,
	button:hover,
	.button.orange:hover,
	.button.dark {
		font-size: <?php echo $buttons_font_size ?>px;
		color: <?php echo $buttons_hover_text_color ?>;
		background-color: <?php echo $buttons_hover_bg_color ?>;
	}

<?php endif; ?>
<?php if (!empty($buttons_font_family)): ?>

	#back-top,
	.tagcloud a,
	button,
	.button.orange,
	.button.dark:hover {
		font-family: <?php echo $buttons_font_family ?>;
	}

	#back-top:hover,
	.tagcloud a:hover,
	button:hover,
	.button.orange:hover,
	.button.dark {
		font-family: <?php echo $buttons_font_family ?>;
	}

<?php endif; ?>

/* -------------------------------------------------- */
/*	Widgets
/* -------------------------------------------------- */

<?php if (!empty($widget_title_color) || !empty($widget_title_first_color) || !empty($widget_text_color) || !empty($widget_link_color) || !empty($widget_link_hover_color)) : ?>

	#sidebar .widget > .widget-title {
		color: <?php echo $widget_title_color ?>;
	}

	.section-title > span,
	.widget .widget-title > span,
	.comment-reply-title > span
	{
		color: <?php echo $widget_title_first_color ?>;
	}

	#sidebar .widget,
	#sidebar .widget p {
		color: <?php echo $widget_text_color ?>;
	}


	#sidebar .widget a:hover {
		color: <?php echo $widget_link_hover_color ?>;
	}

<?php endif; ?>

<?php if (!empty($boxed_widget_title_color) || !empty($boxed_widget_title_first_color) || !empty($boxed_widget_title_bg_top_color) || !empty($boxed_widget_title_bg_btm_color) || !empty($boxed_widget_text_color) || !empty($boxed_widget_bg_color)): ?>

		.boxed-widget .widget-title {
			color: <?php echo $boxed_widget_title_color ?>;
		}

			.boxed-widget .widget-title > span {
				color: <?php echo $boxed_widget_title_first_color ?>;
			}

	.boxed-widget {
		background-color: <?php echo $boxed_widget_bg_color ?>;
		color: <?php echo $boxed_widget_text_color ?>;
	}

	<?php if(isset($boxed_widget_link_color)){ ?>
	.boxed-widget a {
		color: <?php echo $boxed_widget_link_color ?>;
	}
	<?php } ?>

	<?php if(isset($boxed_widget_link_hover_color)){ ?>
	.boxed-widget a:hover {
		color: <?php echo $boxed_widget_link_hover_color ?>;
	}
	<?php } ?>

<?php endif; ?>

<?php if (!empty($footer_widget_title_color) || !empty($footer_widget_title_first_color) || !empty($footer_widget_text_color) || !empty($footer_widget_link_color) || !empty($footer_widget_link_hover_color)): ?>

	#footer .widget > .widget-title {
		color: <?php echo $footer_widget_title_color ?>;
	}

		#footer .widget-title > span {
			color: <?php echo $footer_widget_title_first_color ?>;
		}

	#footer .widget,
	#footer .widget p {
		color: <?php echo $footer_widget_text_color ?>;
	}

<?php endif; ?>

/* -------------------------------------------------- */
/*	Footer
/* -------------------------------------------------- */

<?php if (!empty($footer_bg) || !empty($footer_text_color) || !empty($footer_link_color) || !empty($footer_link_hover_color) || !empty($footer_brd_size) || !empty($footer_brd_color)): ?>

	#footer {
		background-color: <?php echo $footer_bg ?>;
	}

	#footer,
	#footer .widget,
	#footer p {
		color: <?php echo $footer_text_color ?>;
	}

	#footer a:not(.button) {
		color: <?php echo $footer_link_color ?>;
	}

	#footer a:hover:not(.button) {
		color: <?php echo $footer_link_hover_color ?>;
	}

	#footer .adjective,
	.widget_text .hours li {
		border-top: <?php echo $footer_brd_size ?>px solid <?php echo $footer_brd_color ?>;
	}

	#footer .widget-title,
	#footer .widget_links li {
		border-bottom: <?php echo $footer_brd_size ?>px solid <?php echo $footer_brd_color ?>;
	}

<?php endif; ?>