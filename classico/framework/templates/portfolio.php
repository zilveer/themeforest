<?php
/**
 * Template Name: Portfolio
 *
 */
 ?>

<?php 
	get_header();
?>

<?php 

	$l = et_page_config();

?>

<?php do_action( 'et_page_heading' ); ?>

<div class="container">
	<div class="page-content sidebar-position-without">
		<div class="row">
			<div class="content">
				<?php et_portfolio(); ?>
			</div>
		</div>

	</div>
</div>
	
<?php
	get_footer();
?>