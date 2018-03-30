<?php
/**
 * Top menu template part onepage type
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>

<div id="header" class="top-menu <?php if ( get_mental_option( 'topmenu_stiky' ) > 0 ) { echo 'tm-fixonscroll'; } ?>"
	<?php echo get_mental_option('topmenu_stiky') == 2? 'data-fixed-on-scroll-top="1"' : 'data-fixed-on-scroll-top="0"' ?>>
	<header class="shadow-down">
		<div class="container">
			<div class="row">
				<?php
				$logo_cols = get_mental_option('logo_column_size');
				$menu_cols = 12 - $logo_cols;
				?>
				<div class="col-md-<?php echo (int) $logo_cols; ?> tm-logo <?php if( get_mental_option('logo_show_tagline') ) echo "tm-wtagline" ?>">
					<a href="<?php echo site_url(); ?>"><?php echo get_mental_image( get_mental_option( 'logo' ) , 'full' ) ?></a>
					<p class="tm-site-descr"><?php bloginfo( 'description' ); ?></p>
				</div>
				<div class="col-md-<?php echo (int) $menu_cols; ?> tm-menu">
					<nav class="top-main-menu-scrollspy smoothscroll">
						<?php wp_nav_menu( array(
								'theme_location' => 'top-menu-onepage',
								'menu_class'     => 'top-main-menu mtmenu nav',
								'walker'         => new Topmenu_Walker_Nav_Menu()
							) ); ?>
					</nav>
				</div>
			</div> <!-- row -->
		</div> <!-- container -->
	</header>
</div>