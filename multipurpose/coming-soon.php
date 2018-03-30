<?php
/*
* Template name: Coming soon page
*/
?>
<!DOCTYPE html> 
<html <?php language_attributes(); ?> class="coming-soon">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title( '', true, 'right' );?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<?php
		$favicon = get_theme_mod('favicon') ? get_theme_mod('favicon') : false;
		if($favicon) : ?>
		<link rel="Shortcut icon" href="<?php echo $favicon ?>">
	<?php endif; ?>
	<?php 
		$primary_font = get_theme_mod('primary_font') ? get_theme_mod('primary_font') : false;
		if ($primary_font == 'google') {
			$primary_google_font = get_theme_mod('primary_google_font');
			if (!$primary_google_font) $primary_font = false;
		}
		if ($primary_font == 'google') : 
	?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo $primary_google_font; ?>:700,400' rel='stylesheet' type='text/css'>
	<?php endif; ?>

	<?php 
		$secondary_font = get_theme_mod('secondary_font') ? get_theme_mod('secondary_font') : false;
		if ($secondary_font == 'google') {
			$secondary_google_font = get_theme_mod('secondary_google_font');
			if (!$secondary_google_font) $secondary_font = false;
		}
		if ($secondary_font == 'google') : 
	?>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $secondary_google_font; ?>:700,400,300' rel='stylesheet' type='text/css'>
	<?php else : ?>
		<link href='http://fonts.googleapis.com/css?family=Signika:400,300' rel='stylesheet' type='text/css'>
	<?php endif; ?>

	
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	<?php if($primary_font || $secondary_font) : ?>
		<style type="text/css">
			<?php 
			if ($primary_font): 
				if($primary_font == 'google') $primary_font = $primary_google_font;
				?>
				body {font-family: <?php echo $primary_font ?>;}
			<?php endif; ?>

			<?php 
			if ($secondary_font): 
				if($secondary_font == 'google') $secondary_font = $secondary_google_font;
				?>
				h1, h2, h3, h4, h5, h6,
				nav.mainmenu>ul>li>a,
				header p.title,
				ul.tabs li a,
				ul.accordion li>a,
				ul.accordion li>a:before,
				.main .content-slider.big article,
				.slider4 h3+p,
				.slider5 h3,
				.slider5 h2 + p,
				.slider6 article h3,
				.slider7 .controls ul a,
				.slider9 h3+p,
				.slider9 .slider-titles a,
				.slider11 h3+p,
				.hp-quote p,
				.hp-intro p.slogan,
				.cat-archive ul li,
				.product .price span,
				.events .rss-link a,
				.calendar th,
				.calendar td span.day, .calendar td a.day,
				.content>aside section > div > ul.menu,
				blockquote.quote p,
				p.progress,
				.box h4,
				table.alt th,
				.pricing-plan p.subtitle,
				.pricing-plan p.price,
				table.pricing th,
				.e404 p,
				.e404 article form + p {font-family: <?php echo $secondary_font ?>;}
			<?php endif; ?>

			<?php if ($primary_font): ?>
				.hp-quote p.signature,
				.cat-archive ul li p,
				.comment-form input[type="submit"],
				ul.event-list p.date span:first-child,
				.content>aside section > div > ul.menu ul,
				.content>aside section table caption,
				a.btn,
				blockquote.quote p.signature, aside blockquote.quote p.signature,
				.e404 article:first-child p:first-child {font-family: <?php echo $primary_font ?>;}
			<?php endif; ?>
		</style>
	<?php endif; ?>
	
	<?php 
	$custom_css = get_theme_mod('custom_css');
	if($custom_css) :
	?>
	<style type="text/css">
		<?php echo $custom_css; ?>
	</style>
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/styles/style-ie.css" media="screen">
	<![endif]-->
</head>
<?php 
$body_classes = array();

$color_scheme = get_theme_mod('color_scheme') ? 'color-' . get_theme_mod('color_scheme') : false;
if($color_scheme) $body_classes[] = $color_scheme;

$uhs = get_theme_mod('underlined_heading_style') ? get_theme_mod('underlined_heading_style') : 1;
if($uhs != 0)  {
	if ($uhs < 10) {
        $uhs = "0" . $uhs;
    }
    $heading_class = "t".$uhs;
    $body_classes[] = $heading_class;
}

?>

<body <?php body_class($body_classes); ?>>
	<header>
		<p class="title"><a href="<?php echo home_url(); ?>/">
			<?php 
			$logo_file = get_theme_mod('logo_file');
			$logo_file_hires = get_theme_mod('logo_file_hires');
			$logo_width = esc_attr(get_theme_mod('logo_width'));
			$logo_height = esc_attr(get_theme_mod('logo_height'));
			?>

			<?php if (!$logo_file && !$logo_file_hires) : ?>
	            <?php bloginfo('name'); ?>   
	        <?php else : ?>
	            <img src="<?php echo get_theme_mod( 'logo_file' ); ?>" 
	            <?php if ($logo_width != '') : ?> width="<?php echo get_theme_mod( 'logo_width' );?>"<?php endif; ?> 
	            <?php if ($logo_height != '' ) : ?> height="<?php echo get_theme_mod( 'logo_height' );?>"<?php endif; ?>
	            alt="<?php bloginfo( 'name' ); ?>">
	        <?php endif; ?>
			</a> <span><?php bloginfo('description'); ?></span>
		</p>
	</header>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>

	<?php if(is_active_sidebar('coming-soon')) : ?>
		<section class="sidebar content">
			<?php if (!dynamic_sidebar('coming-soon') ) : ?><?php endif; ?>		
		</section>
	<?php endif; ?>

	<nav class="social">
		<ul>
			<?php $social_links = multipurpose_get_social_links(); 
			foreach($social_links as $link) : ?>
			<li><a href="<?php echo $link->url ?>" class="<?php echo $link->class ?>" target="_blank"><?php echo $link->name ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<?php wp_footer(); ?>
</body>
</html>