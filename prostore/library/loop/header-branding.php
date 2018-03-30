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
 * @package 	proStore/library/loop/header-branding.php
 * @file	 	1.1
 */
?>
<?php
	global $data, $prefix;
	$options = get_option('prostore_options');

	if(!isset($data[$prefix."header_layout"])) $data[$prefix."header_layout"] = '';
	$layout = $data[$prefix."header_layout"];

/* ! */	if($_GET['header_layout']!="") {
			$layout = $_GET['header_layout'];
/* ! */	}

	$branding_class = "";
			$left_logo_class  = "";
			$left_content_class  = "";
	switch ($layout) {
		case "half-half" :
			$left_class  = "six";
			$right_class = "six";
			break;
		case "onet-twot" :
			$left_class  = "four";
			$right_class = "eight";
			break;
		case "twot-onet" :
			$left_class  = "eight";
			$right_class = "four";
			$branding_class = "split-layout";
			break;
		case "vert" :
			$left_class  = "twelve text-center";
			$right_class = "twelve text-center";
			$branding_class = "split-layout";
			break;
		case "vert-split" :
			$left_class  = "twelve";
			$left_logo_class  = "six columns";
			$left_content_class  = "six columns";
			$right_class = "twelve text-center";
			$branding_class = "split-layout";
			break;
	}
?>

<div id="branding" class="hide-on-print <?php echo $branding_class; ?>">
	<div class="row container">
		<div class="<?php echo $left_class; ?> columns mobile-four">
			<div class="siteinfo <?php echo $left_logo_class; ?>">
				<?php if ( isset($options['logo_image']) && $options['logo_image']!="" ) { ?>
						<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" href="<?php echo home_url( '/'); ?>" class="brand" id="logo"><img src="<?php echo $options["logo_image"];?>" alt="<?php bloginfo('name'); ?>" /></a>
				<?php } else {  ?>
					<h1><a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="brand" id="logo" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
					<h4 class="subheader"><?php echo get_bloginfo ( 'description' ); ?></h4>
				<?php } ?>
			</div>
			<?php if($layout=="vert-split") { ?>
				<div class="<?php echo $left_content_class; ?>">
					<?php echo nl2br($data[$prefix."header_layout_content"]); ?>
				</div>
			<?php } ?>
		</div>
		<div class="<?php echo $right_class; ?> columns end hide-for-small">
			<?php prostore_main_nav('top-nav nav-bar hide-for-small','globalMenu'); // Adjust using Menus in Wordpress Admin ?>

		</div>
	</div>
</div>