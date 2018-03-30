<!doctype html>
<?php global $unf_options; ?>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
<meta charset="utf-8">
<?php // Google Chrome Frame for IE
if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
echo('<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>');
?>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<?php if(!empty($unf_options['unf_favicon']['url'])) { ?>
<link rel="icon" type="image/x-icon" href="<?php echo esc_url($unf_options['unf_favicon']['url']);?>" />
<?php } else {?>
<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/library/img/favicon.png">
<?php } ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part('raysoflight');?>

<div class="heavens hidden-xs">
	<div class="container cloudwrap">
		<div class="clouds clouds-left"></div>
		<div class="clouds clouds-right"></div>
	</div>
</div>

<div class="container" id="sitecontainer">
	<div id="header" class="row clearfix">
		<div class="col-md-12 column">
			<?php get_template_part('library/unf/mobilehead');?>
			<?php get_template_part('library/unf/topbar');?>
			<div class="logo">
				<a href="<?php echo site_url(); ?>"><h1>
					<?php bloginfo( 'name' ); ?>
				</h1></a>
			</div>
			<div class="navcontainer hidden-xs">
				<nav>
				<?php unf_main_menu(); ?>
				</nav>
			</div>


			<div class="headimg-left"></div>

			<div class="headimg-right"></div>

			<div class="row"><div class="grass col-xs-12 column"></div></div>
		</div>
	</div>

<?php
if ( class_exists( 'WooCommerce' ) ) {
	if (is_shop()) {
		get_template_part('library/unf/shophead');
	} else {
		 get_template_part('breadcrumb');
	}
} else {
	get_template_part('breadcrumb');
}