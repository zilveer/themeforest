<?php
/**
 * Theme Footer Copyright
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

global $sd_data;

$boxed_footer   = $sd_data['sd_boxed_footer'];
$copyright_text = ( ! empty( $sd_data['sd_copyright_text'] ) ? $sd_data['sd_copyright_text'] : NULL );

?>

<div class="sd-copyright-wrapper clearfix ">
	<div <?php if ( $boxed_footer !== '1' ) echo 'class="container"'; ?>>
		<div class="sd-copyright <?php if ( $boxed_footer == '1' ) { echo 'sd-boxed-padding'; } ?>">
			<?php if ( ! empty( $copyright_text ) ) : ?>
				<?php echo do_shortcode( $copyright_text ) ;?>
			<?php else : ?>
				<span class="sd-copyright-text"><?php _e( 'Copyright', 'sd-framework' ); ?> &copy; <?php echo date( 'Y' ); ?> - <a href="http://skat.tf" title="Charity WordPress Themes" target="_blank"> Charity WordPress Themes </a></span>
			<?php endif; ?>
			<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
				<nav class="sd-footer-menu">
					<?php
						// Using wp_nav_menu() to display menu
						wp_nav_menu( array(
							'menu'			 => 'Footer Menu', // Select the menu to show by Name
							'class' 		 => '',
							'menu_class'	 => '',
							'menu_id' 		 => '',
							'container'		 => false, // Remove the navigation container div
							'theme_location' => 'footer-menu'
							)
						);
					?>
				</nav>
				<!-- sd-footer-menu -->
			<?php endif; ?>
		</div>
		<!-- sd-copyright -->
	</div>
</div>
<!-- sd-copyright-wrapper -->