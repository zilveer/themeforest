<?php
/**
 * Main Menu
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
?>

<?php if ( has_nav_menu( 'main-header-menu' ) ) : ?>
	<div class="sd-menu-wrapper clearfix">
		<div class="sd-menu-content">
			<nav class="sd-menu-nav">
				<?php
					wp_nav_menu( array(
						'menu' => 'Main Header Menu',
						'class' => '',
						'menu_class' =>'',
						'menu_id' => 'main-header-menu',
						'container' => false,
						'theme_location' => 'main-header-menu'
						)
					);
				?>
			</nav>
		</div>
		<!-- sd-menu-content -->
		<span class="sd-responsive-menu-toggle"><a href="#sidr-main"><i class="fa fa-bars"></i><?php _e( 'MENU', 'sd-framework' ); ?></a></span>
	</div>
	<!-- sd-menu-wrapper -->
<?php endif; ?>
