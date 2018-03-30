<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<!--========================================================-->
<!--//   Made By Shorti for Creadivs - www.creadivs.com   //-->
<!--========================================================-->

<head>

	<!--=== Meta ===-->
	<meta http-equiv="Content-Type" content="<?php bloginfo("html_type"); ?>; charset=<?php bloginfo("charset"); ?>" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />
	
	<!--=== Title ===-->
	<title><?php wp_title("|", true, "right"); ?><?php bloginfo("name"); ?></title>
	
	<!--=== Javascript Disabled ===-->
	<noscript>
	
		<style type="text/css">
		
			body {
				display: block !important;
				opacity: 1 !important;
			}
			
			#header #nav {
				top: 0 !important;
			}
		
		</style>
		
	</noscript>
	
	<!--=== Pingback ===-->
	<link rel="pingback" href="<?php bloginfo( "pingback_url" ); ?>" />
	
	<!--// BEGIN CSS Settings //-->
	<?php get_template_part( "includes/settings-css" ); ?>
	<!--// END CSS Settings //-->
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="overlay"></div>

<?php 
// Logo
$logo = of_get_option("logo_reg");
$logo_w = of_get_option("logo_width");
$logo_h = of_get_option("logo_height");
$logo_retina = of_get_option("logo_ret");
$plain_text = of_get_option("plain_text");
?>



	<!--// BEGIN #header //-->
	<header id="header">
	
		<!-- BEGIN #nav -->
		<nav id="nav">
		
			<?php wp_nav_menu( array( "container" => false, "theme_location" => "main-menu", "menu_class" => "nav", "before" => "<span>&bull;</span>" ) ); ?>
			
			<div id="mobile_nav">
		
				<?php 
					
				$locations = get_nav_menu_locations();
				
				$menu = wp_get_nav_menu_object( $locations[ "main-menu" ] );
				
				$menu_items = wp_get_nav_menu_items( $menu->term_id );
				
				$menu_list = "<select onchange='location = this.options[this.selectedIndex].value;'>";
				
				$menu_list .= "<option>-------</option>";
				
				foreach ( ( array ) $menu_items as $key => $menu_item ) {
				   $title = $menu_item->title;
				   $url = $menu_item->url;
				   $menu_list .= "<option value='" . $url . "'>" . $title . "</option>";
				}
				$menu_list .= "</select>";
				
				echo $menu_list;
				
				?>
			
			</div>
		
		</nav>
		<!-- END #nav -->
		
		
		
		<?php if ($plain_text == "0") : ?>
	
			<!-- BEGIN #logo -->
			<div id="logo">
			
				<h1>
				
					<a href="<?php echo home_url("/"); ?>">
					
						<img src="<?php echo $logo; ?>" alt="<?php bloginfo("name"); ?>" width="<?php echo $logo_w; ?>" height="<?php echo $logo_h; ?>" class="reg" />
						<?php if ($logo_retina != "") : ?><img src="<?php echo $logo_retina; ?>" alt="<?php bloginfo("name"); ?>" width="<?php echo $logo_w; ?>" height="<?php echo $logo_h; ?>" class="ret" /><?php endif;?>
					
					</a>
				
				</h1>
					
			</div>
			<!-- END #logo -->
		
		<?php elseif ($plain_text == "1" || $logo == "" ) : ?>
		
			<h1 class="plain_text"><a href="<?php echo home_url("/"); ?>"><?php bloginfo("name"); ?></a></h1>
		
		<?php endif; ?>
		
	</header>
	<!--// END #header //-->
	
	
	
	<!--// BEGIN #main //-->
	<section id="main">
	
		<div id="content">
	