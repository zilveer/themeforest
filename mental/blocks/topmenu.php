<?php
/**
 * Top menu template part
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
					<nav>
                        <?php
                        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                        if(is_plugin_active('woocommerce/woocommerce.php') && get_mental_option( 'shopping_cart' )) { ?>
                        <div class="basket-box">
                            <?php $cart_url = WC()->cart->get_cart_url(); ?>
                            <a href="<?php echo esc_url( $cart_url ); ?>" class="card-icon">
                                <span><?php echo nm_get_cart_contents_count(); ?></span>
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>
                        </div>
                        <?php } ?>
						<?php wp_nav_menu( array(
								'theme_location' => 'top-menu',
								'menu_class'     => 'top-main-menu mtmenu',
								'walker'         => new Topmenu_Walker_Nav_Menu()
							) ); ?>
					</nav>
				</div>
			</div> <!-- row -->
		</div> <!-- container -->
	</header>
</div>