<?php
/**
* Header Navigation
 */
?>
<div class="top-menu-wrap clearfix">
	<div class="logo-menu-wrapper clearfix">
	
		<div class="social-header">
			<?php if ( !function_exists('dynamic_sidebar') 

				|| !dynamic_sidebar('Social Header') ) : ?>

			<?php endif; ?>
		</div>
		
		<div class="logo">
			<a href="<?php echo home_url(); ?>/">
				<?php
				$main_logo=of_get_option('main_logo');
				if ( $main_logo<>"" ) {
					echo '<img class="logoimage" src="' . $main_logo .'" alt="logo" />';
				} else {
					if ( isset( $_GET['demo_theme_style'] ) ) $_SESSION['demo_theme_style']=$_GET['demo_theme_style'];
					if ( isset($_SESSION['demo_theme_style'] )) $demo_theme_style = $_SESSION['demo_theme_style'];
					if ($_SESSION['demo_theme_style'] == "dark" ) {
					echo '<img class="logoimage" src="'.MTHEME_PATH.'/images/logo_dark.png" alt="logo" />';
					} else {
					echo '<img class="logoimage" src="'.MTHEME_PATH.'/images/logo.png" alt="logo" />';
					}
				}
				?>
			</a>
		</div>
	</div>
	
	<div class="mainmenu-navigation clearfix">
		<?php
		if ( function_exists('wp_nav_menu') ) { 
			// If 3.0 menus exist
			require ( MTHEME_INCLUDES . 'menu/call-menu.php' );

		} else {
		?>
		<ul>
			<li>
				<a href="<?php echo home_url(); ?>/"><?php _e('Home','mthemelocal'); ?></a>
			</li>
		</ul>
		<?php
		}
		?>
	</div>
	<div class="main-select-menu">
	<?php				
	// Responsive menu conversion to drop down list
	echo Menu_to_SelectMenu ("top_menu","top-select-menu","-","Main Menu");
	?>
	</div>
</div>