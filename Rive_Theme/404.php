<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Believe
 */
get_header();

	$title_404 = get_option(SHORTNAME . '_404_title', "This is somewhat embarrassing, isn't it?");
	$title_msg = get_option(SHORTNAME . '_404_message', "It seems we can’t find what you’re looking for. Perhaps searching, or one of the links below, can help.");
?>

<div class="white-bg">
	<div>
		<h1 class="page-title">
			<?php
			if ( !is_front_page() && !is_home() ) {
				echo ch_breadcrumbs();
			} ?>
			<?php echo $title_404; ?></h1>
		<p><?php echo $title_msg; ?></p>
		<p>&nbsp;</p>
		<div class="widget">
			<h4><?php _e('Most Used Categories', 'ch'); ?></h4>
			<ul>
				<?php wp_list_categories(array('orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10)); ?>
			</ul>
		</div>
		<div class="msg_404_img">
			<img src="<?php echo get_template_directory_uri() . '/images/404_msg.png'; ?>" alt="Page not Found" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>
<?php get_footer();