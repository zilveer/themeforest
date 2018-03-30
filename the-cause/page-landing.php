<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Landing Page
*/
?>

<!DOCTYPE HTML>

<html <?php language_attributes(); ?> class="landing">
<head>

<meta charset="<?php bloginfo('charset'); ?>">
<title><?php if (is_home() || is_front_page()) { bloginfo('name'); ?><?php } elseif (is_category() || is_page() ||is_single()) { ?> <?php } ?><?php wp_title(''); ?></title>

<?php $favicon = get_option('tb_favicon', DEFAULT_FAVICON); ?>

<link rel="icon" type="image/png" href="<?php echo $favicon; ?>">

<!-- STYLES -->
<?php get_template_part('tbFonts'); ?>
<link rel="stylesheet" href="<?php echo TEMPLATE_DIRECTORY; ?>/styles/grid960.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php wp_head(); ?>

<?php

$tbCountdown = get_option('tb_countdown');

if ($tbCountdown) {

$tbCountdownArray = explode(',', $tbCountdown);

$finalDateArray = array();
$finalDateIndex = 1;

foreach ($tbCountdownArray as $countdown) {
	if ($finalDateIndex == 2) {
		$finalDateArray[] = trim($countdown) . ' - 1';
	} else {
		$finalDateArray[] = trim($countdown);
	}
	
	$finalDateIndex++;
}

$finalDate = implode(',', $finalDateArray);

?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	var finalDate = new Date(<?php echo $finalDate; ?>);
	$('#countdown').countdown({until: finalDate, layout: '<div><div class="number">{dn}</div><div>{dl}</div></div><div><div class="number">{hn}</div><div>{hl}</div></div><div><div class="number">{mn}</div><div>{ml}</div></div><div><div class="number">{sn}</div><div>{sl}</div></div>'});
});
</script>

<?php } ?>

</head>

<body <?php body_class(); ?>>

<a id="top"></a>

<div id="landing" class="width100" <?php tb_write_bckg('landing'); ?>>
	<div class="width1000 tbFonts">	
		<div id="logo">
			<h1>
				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo tb_get_logo(); ?>" alt="<?php bloginfo('name'); ?>">
				</a>
			</h1>
		</div>
		
		<div class="center">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h2><?php the_title(); ?></h2>
			
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
			
			<div id="countdown"></div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>