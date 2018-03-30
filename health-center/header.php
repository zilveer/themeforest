<?php
/**
 * Header template
 *
 * @package wpv
 * @subpackage health-center
 */
?><!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-ie no-js"> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class('layout-'.WpvTemplates::get_layout()); ?>>
	<span id="top"></span>
	<?php do_action('wpv_body') ?>
	<div id="page" class="main-container">

		<?php include(locate_template('templates/header/top.php'));?>

		<?php do_action('wpv_after_top_header') ?>

		<div class="boxed-layout">
			<div class="pane-wrapper clearfix">
				<?php include(locate_template('templates/header/middle.php'));?>
				<div id="main-content">
					<?php include(locate_template('templates/header/sub-header.php'));?>
					<!-- #main (do not remove this comment) -->
					<div id="main" role="main" class="wpv-main layout-<?php echo WpvTemplates::get_layout() ?>">
						<?php do_action('wpv_inside_main') ?>
						<div class="limit-wrapper">
