<?php
/**
 *
 * This is the blog template, to use with your blogs. 
 *
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

get_header();

global $mpcth_options;

// get sidebar position
if(isset($mpcth_options) && isset($mpcth_options['mpcth_404_page_sidebar']))
	$sidebar_position = $mpcth_options['mpcth_404_page_sidebar'];
else
	$sidebar_position = 'none';
?>
	<div id="mpcth_page_container" class="mpcth-sidebar-<?php echo $sidebar_position ?>">
		<!-- Display menu on the side and logo (if set in settings ) -->
		<?php get_template_part('mpc-wp-boilerplate/php/parts/side-menu'); ?>

		<div id="mpcth_page_content">
			<div id="mpcth-archive-header-info">
				<!-- post cornsers -->
				<span class="mpcth-corner-tl"></span>
				<span class="mpcth-corner-tr"></span>
				<span class="mpcth-corner-bl"></span>
				<span class="mpcth-corner-br"></span>
				<span>
					404. Please try something else.
				</span>
			</div>
		</div><!-- end #mpcth_page_content -->

		<?php if($sidebar_position != "none")
			get_sidebar(); ?>

	</div><!-- #mpcth_page_container -->
<?php get_footer(); ?>