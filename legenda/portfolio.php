<?php
/**
 * Template Name: Portfolio
 *
 */
 ?>
 
<?php 
	extract(etheme_get_page_sidebar());
?>

<?php 
	get_header();
?>

<?php if ($page_heading != 'disable' && ($page_slider == 'no_slider' || $page_slider == '')): ?>
	<?php et_page_heading(); ?>
<?php endif ?>

<?php if($page_slider != 'no_slider' && $page_slider != ''): ?>
	
	<?php echo do_shortcode('[rev_slider_vc alias="'.$page_slider.'"]'); ?>

<?php endif; ?>

<div class="container">
	<div class="page-content sidebar-position-without">
		<div class="row">
			<div class="content span12">
					
					<?php get_etheme_portfolio(); ?>
			</div>
		</div>

	</div>
</div>
	
<?php
	get_footer();
?>