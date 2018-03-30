<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		<?php
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'creativeclean' ), max( $paged, $page ) );
		?>
	</title>
	<meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
	<meta name="keywords" content="Website Keywords" />
	<?php
	if ( get_option('cc_color_scheme') == 'Blue') : ?>
		<style type="text/css" media="all">@import "<?php bloginfo( 'stylesheet_url' ); ?>";</style>
	<?php elseif ( get_option('cc_color_scheme') == 'Red') : ?>
		<style type="text/css" media="all">@import "<?php echo get_template_directory_uri(); ?>/red.css";</style>
	<?php elseif ( get_option('cc_color_scheme') == 'Green') : ?>
		<style type="text/css" media="all">@import "<?php echo get_template_directory_uri(); ?>/green.css";</style>
	<?php else: ?>
		<style type="text/css" media="all">@import "<?php bloginfo( 'stylesheet_url' ); ?>";</style>
	<?php endif; ?>
	<!--[if IE 7]>
		<style type="text/css">@import "<?php echo get_template_directory_uri(); ?>/style/ie7.css";</style>
	<![endif]-->
	<?php
	if ( get_option('cc_rtl') == 'true') : ?>
		<style type="text/css" media="all">@import "<?php echo get_template_directory_uri(); ?>/rtl.css";</style>
	<?php endif; ?>
	<?php 
	if (( get_option('cc_color_scheme') == 'Red') && ( get_option('cc_rtl') == 'true')) : ?>
		<style type="text/css" media="all">@import "<?php echo get_template_directory_uri(); ?>/rtl-red.css";</style>
	<?php elseif (( get_option('cc_color_scheme') == 'Green') && ( get_option('cc_rtl') == 'true')) : ?>
		<style type="text/css" media="all">@import "<?php echo get_template_directory_uri(); ?>/rtl-green.css";</style>
	<?php endif; ?>
	<?php $options = get_option("cc_favicon");
		$file = $options['file']; 
	?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $file['url'];?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php echo bloginfo( 'name' ); ?> RSS Feed" href="<?php echo bloginfo( 'rss2_url' ); ?>" />
	<?php
	wp_head();
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($){

		
			$('#slideshow2').jqFancyTransitions({ 
				width: '1002', 
				height: '316',
				position: '<?php echo get_option('cc_slideshow_position') ?>',
				direction: '<?php echo get_option('cc_slideshow_animation') ?>',
				strips: <?php echo get_option('cc_slideshow_strips') ?>,
				stripDelay: <?php echo get_option('cc_slideshow_stripdelay') ?>,
				titleOpacity: 0.7,
				links: true
			});


		
			$('#placeslideshow').tabs({ fx: { opacity: 'toggle' } }); 
		<?php
		if ( get_option('cc_cufon') <> 'true') : ?>
			Cufon.replace('h1, .contentfront h2, .boxfooter h4, .boxfootertweet h4, .widget-title, .titlenews h2, #maincontent .titlenews a, .titlecomment, .titleservices, .titletestimonial, .titleteam');
		<?php endif; ?>
		$('a.popup, .gallery-icon a').lightBox({fixedNavigation:true});
		$("#commentform").validate();
	});
	</script>
</head>
<body <?php if ( get_option('cc_rtl') == 'true') : echo "dir=\"rtl\""; endif; ?> <?php body_class($class); ?>>

<p><a class="skiplink" href="#maincontent">Skip over navigation</a></p>
<div id="container">
	<div id="wrapper">
		<div id="header">
			<?php
				 $optionslogo = get_option("cc_logo");
				 $filelogo = $optionslogo['file']; 
	
				if ($filelogo['url'] <> '' ) {
					?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo $filelogo['url'];?>" alt="<?php bloginfo('name'); ?>" id="imglogo" /></a>
					<?php
				} else {
					?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri('template_directory');?>/images/logo.png" alt="<?php bloginfo('name'); ?>" id="imglogo" /></a>
					<?php
				}
			?>
			<div id="placemainmenu">
				<?php wp_nav_menu( array( 'theme_location' => 'main-navigation', 'menu_id' => 'mainmenu') ); ?>
			</div>
		</div>