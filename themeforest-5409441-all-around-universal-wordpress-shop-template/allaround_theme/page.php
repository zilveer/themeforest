<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */
 
	get_header();
	global $allaround_postmeta, $allaround_sidebar;
	$allaround_sidebar = allaround_sidebar_init();
?>
	<div class="clear"></div><!--clear -->
	<?php if ( $allaround_postmeta['breadcrumbs'] == '' or $allaround_postmeta['breadcrumbs'] == 1 ) allaround_breadcrumbs(); ?>
	<div class="content_wrapper <?php echo $allaround_sidebar['sidebarclass']; ?>">
		<div class="content">
			<?php
				if ( $allaround_postmeta['title'] == 1 ) echo do_shortcode('[aa_title themecolor="yes"]' . get_the_title() . '[/aa_title]'); else echo '<div class="clear margin-top48"></div>';
				if( have_posts() ) { 
				the_post();
			?>
			<div class="real_content" role="main"><?php the_content(); ?></div><!-- real_content -->
			<?php
				wp_link_pages();
				get_sidebar();
			?>
			<div class="clear"></div>
			<?php if ( comments_open() ) comments_template(); ?>
			<div class="clear"></div><!--clear -->
		<?php
			}
		?>
		</div><!-- content -->

	<div class="divider padding-top48"></div>	
	</div><!-- content_wrapper -->
<?php get_footer(); ?>