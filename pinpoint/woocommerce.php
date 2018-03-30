<?php get_header(); ?>
	
<?php
	$options = get_option('sf_pinpoint_options');
	$page_layout = $options['page_layout'];
	if (isset($_GET['layout'])) {
		$page_layout = $_GET['layout'];
	}
?>

<div class="page-heading full-width clearfix">
	<?php if ($page_layout == "fullwidth") { ?>
	<div class="container">
	<div class="sixteen columns">
	<?php } ?>
	
	<h1><?php woocommerce_page_title(); ?></h1>
	
	<?php if ($page_layout == "fullwidth") { ?>
	</div>
	</div>
	<?php } ?>
</div>

<?php if ($page_layout == "fullwidth") { ?>
<div class="container">
<div class="sixteen columns">
<?php } ?>

<div class="inner-page-wrap has-right-sidebar top-spacing clearfix">

	<!-- OPEN article -->
	<div class="type-page type-woocommerce eleven columns alpha clearfix">
		
		<div class="page-content clearfix">

			<?php woocommerce_content(); ?>
			
		</div>
			
	<!-- CLOSE article -->
	</div>
	
	<aside class="sidebar right-sidebar five columns omega">
		<?php dynamic_sidebar('woocommerce-sidebar'); ?>
	</aside>

</div>

<?php if ($page_layout == "fullwidth") { ?>
</div>
</div>
<?php } ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>