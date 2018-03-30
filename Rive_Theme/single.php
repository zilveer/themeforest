<?php
/**
 * Single template file.
 */
get_header();

$layout_type = get_post_meta(get_the_id(), 'layouts', true);

if(empty($layout_type)) {
	$layout_type = get_option('ch_layout_style') ? get_option('ch_layout_style') : 'full';
}
?>
<div class="white-bg">
	<div class="clearfix"></div>
	<?php
	if ( LAYOUT == 'sidebar-left' ) {
	?>
	<div class="span8 <?php echo LAYOUT; ?>">
		<div class="sidebar-inner container-fluid">
		<?php
			global $ch_is_in_sidebar;
			$ch_is_in_sidebar = true;
			generated_dynamic_sidebar();
		?>
		</div>
	</div><!--end of sidebars-->
	<?php } ?>
	<?php
	if ( LAYOUT == 'sidebar-left' ) { ?>
	<div class="sidebar-left-pull-right">
	<?php } ?>
		<div class="<?php echo ( LAYOUT != 'sidebar-no' ) ? 'span15 main-content' : ''; ?>">
			<?php
			echo '
			<div class="page-title">';
			if ( !is_front_page() && !is_home() ) {
				echo ch_breadcrumbs();
			}
			echo '
				' . the_title( '<h1>', '</h1>' ) . '
			</div>
			<div class="clearfix"></div>';

			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'content', 'single' );
					comments_template( '', true );
				}
			} else {
				echo '
					<h2>Nothing Found</h2>
					<p>Sorry, it appears there is no content in this section.</p>';
			}
			?>
		</div>
	<?php if ( LAYOUT == 'sidebar-left' ) { ?>
	</div>
	<?php } ?>
	<?php
	if ( LAYOUT == 'sidebar-right' ) {
	?>
	<div class="span8 pull-right <?php echo LAYOUT; ?>">
		<div class="sidebar-inner pull-right container-fluid">
		<?php
			global $ch_is_in_sidebar;
			$ch_is_in_sidebar = true;
			generated_dynamic_sidebar();
		?>
			<div class="clearfix"></div>
		</div>
	</div><!--end of span8-->
	<?php } ?>

	<div class="clearfix"></div>
</div>
<?php $ch_is_in_sidebar = false; ?>
<?php get_footer();