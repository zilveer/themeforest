<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php options_data('options-page', 'favorites-icon'); ?>">
	<link rel="apple-touch-icon-precomposed" href="<?php options_data('options-page', 'mobile-bookmark'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php

// Header Data
//................................................................
$header_data = get_layout_options('header');
$header = (isset($header_data)) ? $header_data : false;
// out($header);

// global $layouts_manager;
// out($layouts_manager);

// Full screen background images
//................................................................

$bodyPosition = get_options_data('options-page', 'background-position');
$bodyImage    = get_options_data('options-page', 'background-image');
if ( $bodyImage && $bodyPosition == 'full-screen' ) {
	echo '<img src="' . $bodyImage . '" alt="' . esc_attr( generate_title() ) . '" id="full-background" />';
}

// Top Sidebar Area (above the page)
//................................................................
?>	
<div class="site widget-area" id="AbovePage">
	<div class="inner-wrapper"><?php 
		if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-top')) : endif; 
	?></div>
</div> <!-- / #AbovePage -->
<?php

// Begin design
//................................................................
?>	
<div id="page" class="hfeed site">

	<div id="Top">
		<header id="masthead" class="site-header" role="banner">
			<div class="masthead-container">
				<div class="inner-wrapper">
					<div class="hgroup">
						<h1 class="site-title">
							<?php
							
							// Logo
							//................................................................
							$home_url = (get_options_data('options-page', 'logo-url')) ? get_options_data('options-page', 'logo-url') : home_url( '/' );
							// The logo image or text
							$logo = get_bloginfo('name');
							$logoImage = get_options_data('options-page', 'logo-image');
							$logoClass = 'logo';
							if ( !empty($header['header-alternate-logo']) ) {
								$logoImage = $header['header-alternate-logo'];
							}
							if ($logoImage) {
								$logo = '<img src="'.$logoImage.'" alt="'.get_options_data('options-page', 'logo-title').'">';
								$logoClass .= ' logo-image';
							}
							?>
							<a href="<?php echo esc_url( $home_url ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="<?php echo $logoClass; ?>" rel="home"><?php echo $logo; ?></a>
						</h1>
					</div><!-- .hgroup -->

					<?php 
					// Top Masthead Area (header sidebar)
					//................................................................
					?>	
					<div class="widget-area" id="HeaderSidebar">
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-header')) : endif; ?>
					</div> <!-- / #HeaderSidebar -->

					<div class="clear"></div>
				</div>

				<div id="MainNav">
					<div class="inner-wrapper">
						<?php 

						// Navigation Extras (search, breadcrumbs, etc.)
						//................................................................ 

						// Get the selection for content type
						$navExtra = get_options_data('options-page', 'nav-extra-right', 'search');
						if ( !empty($header['nav-extra-right']) ) {
							$navExtra = $header['nav-extra-right'];
						}

						if (isset($navExtra) && !empty($navExtra)) { ?>
							<div id="NavExtras">
							<?php
							if ($navExtra == 'search') {
								// Show the search input ?>
								<div class="navSearch">
									<a href="?s=" id="NavSearchLink"><i class="fa fa-search"></i></a>
									<form method="get" id="NavSearchForm" action="<?php echo home_url('/') ?>">
										<div>
											<input type="text" name="s" id="NavS" value="<?php echo get_search_query() ?>">
											<button type="submit"><?php _e( 'Search', 'framework' ) ?></button>
										</div>
									</form>
								</div>
								<?php
							} elseif ($navExtra == 'breadcrumbs') {
								// Show the breadcrumbs ?>
								<div class="default-breadcrumbs">
									<?php if(function_exists('breadcrumbs_display')) {
										breadcrumbs_display();
									}?>
								</div>
								<?php
							} else {
								// Include selected sidebar? (possible update)
							} ?>
							</div> <!-- / #NavExtras -->
							<?php						
						} else {
							// Empty is the alternative, show nothing
						}


						// Navigation - Main Menu
						//................................................................
						if ( function_exists( 'uberMenu_direct' ) ) {
							// Call Ubermenu 
							uberMenu_direct( 'primary' );
						} else {
							// Call WP Nav Menu ?>
							<nav id="site-navigation" class="main-navigation" role="navigation">
								<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
							</nav><!-- #site-navigation -->
							<?php
						} ?>
					</div>

					<div class="clear"></div>
				</div><!-- / #MainNav -->
			</div><!-- .masthead-container -->
		</header><!-- #masthead -->
		<?php 

		// Header Content
		//................................................................
		$header_one_type = (isset($header['header-content']))   ? get_top_content($header['header-content'])   : false;
		$header_two_type = (isset($header['header-content-2'])) ? get_top_content($header['header-content-2']) : false;

		if ( (!empty($header_one_type) && $header_one_type != 'default') || (!empty($header_two_type) && $header_two_type != 'default') ) {
			?>	
			<section id="TopContent">
				<?php

				// Top Content 1
				if ($header_one_type !== 'default') { ?>
					<div class="top-content-first type_<?php echo $header_one_type ?>">
						<?php show_top_content($header_one_type, $header['header-content']); ?>
					</div>
				<?php }

				// Top Content 2
				if ($header_two_type !== 'default') { ?>
					<div class="top-content-second type_<?php echo $header_two_type ?>">
						<?php show_top_content($header_two_type, $header['header-content-2']); ?>
					</div>
				<?php }
				?>
			</section><!-- #TopContent -->
			<?php
		} // End TopContent
		?>
	</div><!-- #Top -->

	<div id="Middle">
		<div class="main-content">

			<?php 

			// Layout Manager - Start Layout
			//................................................................
			do_action('output_layout','start'); // do_action('output_header'); // :/ 

			?>