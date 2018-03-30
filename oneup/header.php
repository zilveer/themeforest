<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="site-wrapper">
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?><!DOCTYPE html>
<?php $t =& peTheme();?>
<?php $content =& $t->content; ?>
<?php $skin = $t->options->get("skin"); ?>
<?php $class = "skin_$skin"; ?>
<!--[if IE 7 ]><html class="desktop ie7 no-js <?php echo $class ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="desktop ie8 no-js <?php echo $class ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="desktop ie9 no-js <?php echo $class ?>" <?php language_attributes(); ?>><![endif]--> 
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js <?php echo $class ?>" <?php language_attributes();?>><!--<![endif]-->
   
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php $t->header->title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no" />

		<!--[if lt IE 9]>
		<script type="text/javascript">/*@cc_on'abbr article aside audio canvas details figcaption figure footer header hgroup mark meter nav output progress section summary subline time video'.replace(/\w+/g,function(n){document.createElement(n)})@*/</script>
		<![endif]-->
		<script type="text/javascript">if(Function('/*@cc_on return document.documentMode===10@*/')()){document.documentElement.className+=' ie10';}</script>
		<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
		<script type="text/javascript">
			(function(u,i){if(u[i]('Safari')>-1 && u[i]('Mobile')===-1 && u[i]('Chrome') === -1){document.documentElement.className+=' safari';}}(navigator.userAgent,'indexOf'));
		</script>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<!-- favicon -->
		<link rel="shortcut icon" href="<?php echo $t->options->get("favicon") ?>" />

		<?php $t->font->load(); ?>

		<!-- wp_head() -->
		<?php $t->header->wp_head(); ?>
	</head>

	<?php $bclasses = $t->transparent() ? 'pe-header-transparent' : '';  ?>
	<?php $bclasses .= $t->layout->content != 'fullwidth' ? '' : ' pe-page-fullwidth'; ?>
	<?php $bclasses .= $t->stickyFooter() ? ' pe-sticky-footer' : '' ?>
	<?php $bclasses .= $t->hasBgVideo() ? ' pe-has-bg-video' : '' ?>

	<body <?php $content->body_class($bclasses); ?>>
		<div class="site-loader"></div>

		<!--wrapper for boxed version-->
		<div class="site-wrapper">
			<div class="head-wrapper">

			<?php if (true): ?>
			<div class="pe-menu-sticky">

				<!--main bar-->
				<div class="pe-container"> 
					<header class="row-fluid">
						<div class="span12">
							<!-- logo -->
							<a class="logo" href="<?php echo home_url(); ?>" title="<?php _e("Home",'Pixelentity Theme/Plugin'); ?>" >

								<?php $logo = $t->options->get("logo"); ?>

								<?php if ( ! empty( $logo ) ) : ?>

									<?php $t->image->retina($logo); ?>

								<?php else : ?>

									<img src="<?php echo $t->image->blank( 160, 60 ); ?>">

								<?php endif; ?>

							</a>

							<?php if (false && defined('ICL_LANGUAGE_CODE')): // if WPML is installed, add the lang menu here ?>
							<div class="pe-wpml-lang-selector">
								<?php do_action('icl_language_selector'); ?>
							</div>
							<?php endif; ?>

							<!--main navigation-->
							<nav class="pe-menu-main">
								
								<?php $t->menu->show("main"); ?>
							</nav>
							
						</div>
					</header><!-- end header  -->
				</div><!--end container-->
			</div><!--end sticky bar-->
			<?php endif; ?>	

		</div> <!-- end head wrapper -->
		<?php do_action("pe_theme_after_header"); ?>
			