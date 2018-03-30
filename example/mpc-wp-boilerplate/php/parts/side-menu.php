<?php 

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

global $mpcth_cake; 
global $mpcth_options;

?>

<!-- Menu on the side of a page -->
<?php if($mpcth_cake['menuPosition'] == 'page'): ?>
	<aside id="mpcth_aside_menu_section" class="mpcth-visible-desktop">
		<?php if($mpcth_cake['logoPosition'] == 'page')
				echo mpcth_display_logo(); ?>

		<nav id="mpcth_nav">
			<?php mpcth_aside_menu(); ?>
		</nav>
		<?php if(isset($mpcth_options['mpcth_show_copyright']) && $mpcth_options['mpcth_show_copyright'] == '1') { ?>
		<div id="mpcth_bottom_footer">
			<?php get_search_form(); ?>
			<?php mpcth_get_social_icons(); ?>
			<span class="mpcth-footer-copyright"><?php echo $mpcth_options['mpcth_copyright_text']; ?></span>
		</div><!-- end #mpcth_bottom_footer -->
	<?php } ?>
	</aside>
<?php endif; ?>
<!-- End Menu on the side -->
