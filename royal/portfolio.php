<?php
/**
 * Template Name: Portfolio
 *
 */
 ?>
 
<?php 

	$l = et_page_config();

?>

<?php 
	get_header();
?>

<?php do_action( 'et_page_heading' ); ?>

<div class="container">
	<div class="page-content sidebar-position-without">
		<div class="row">
			<div class="content col-md-12">
					
					<?php get_etheme_portfolio(); ?>
			</div>
		</div>

	</div>
</div>
	
<?php
	get_footer();
?>