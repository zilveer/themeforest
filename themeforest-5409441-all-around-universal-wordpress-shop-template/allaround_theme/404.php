<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

	get_header();
?>
	<div class="clear"></div><!--clear -->	
	<?php allaround_breadcrumbs(); ?>
	<div class="content_wrapper no-sidebar">
		<div class="content">
			<?php
				echo do_shortcode('[aa_title themecolor="no"]<span class="customColor">404</span> ' . __('Page', 'allaround') . '[/aa_title]');
			?>
				<div class="p404">
				<span class="p404-1"><?php _e('CONGRATULATIONS!', 'allaround'); ?></span>
				<div class="clear"></div><!--clear -->
				<span class="p404-2"><?php _e('YOU HAVE UNLOCKED THE ACHIEVEMENT', 'allaround'); ?></span>
				<div class="clear"></div><!--clear -->
				<span class="p404-3 customColor"><?php _e('"FIND THE 404 PAGE"', 'allaround'); ?></span>
				<div class="clear"></div><!--clear -->
				<img src="<?php echo get_template_directory_uri(); ?>/images/404-present.png" alt="404" />
				<div class="clear"></div><!--clear -->
				<span class="p404-1"><?php _e('RETURN TO THE', 'allaround'); ?> <a class="customColor" href="index.html"><?php _e('HOME PAGE', 'allaround'); ?></a></span>
				<div class="clear"></div><!--clear -->
				<span class="p404-2"><?php _e('TO CLAIM YOUR PRIZE', 'allaround'); ?></span>
				</div><!-- p404 -->
			<div class="clear"></div><!--clear -->
		</div><!-- content -->
	<div class="divider padding-top48"></div>	
	</div><!-- content_wrapper -->
<?php get_footer(); ?>