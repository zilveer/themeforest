<?php
$style_main_color = of_get_option("style_main_color");
$style_body_font = of_get_option("style_body_font");
$style_heading_font = of_get_option("style_heading_font");
$logo_width = of_get_option("logo_width");
$custom_styles = of_get_option("custom_styles");
?>



<style type="text/css">
	
/*=== Body Font ===*/
	
	body,
	h1 span,
	h5,
	.post .post_date h5,	
	#contact_form label,
	.widget_calendar #wp-calendar a {
		<?php if ($style_body_font == "opensans") : ?>
		font-family: "Open Sans", Helvetica, sans-serif;
		<?php elseif ($style_body_font == "sans") : ?>
		font-family: "Droid Sans", sans-serif;
		<?php elseif ($style_body_font == "serif") : ?>
		font-family: "Droid Serif", sans-serif;
		<?php endif; ?>
	}
	
/*=== Heading Font ===*/

	h1, h2, h3, h4, h5, h6,
	#header #nav ul li a,
	.post .post_bottom .cats ul li a, 
	.format-link a,
	.btn, .tagcloud a, .widget_categories ul li a, .cats ul li a {
		<?php if ($style_heading_font == "montserrat") : ?>
		font-family: "Montserrat", sans-serif;
		<?php elseif ($style_heading_font == "francois") : ?>
		font-family: "Francois One", sans-serif;
		<?php elseif ($style_heading_font == "voltaire") : ?>
		font-family: "Voltaire", sans-serif;
		<?php endif; ?>
	}
	
<?php if ($logo_width != "") : ?>	
/*=== Logo Width ===*/

	
	#logo {
		width: <?php echo $logo_width; ?>px;
	}
	
<?php endif; ?>

/*=== Custom CSS ===*/

	<?php echo $custom_styles; ?>

</style>