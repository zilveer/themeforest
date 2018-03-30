<?php get_header(); ?>
	
<div class="page-heading clearfix">

	<h1><?php woocommerce_page_title(); ?></h1>
	
	<?php if(function_exists('bcn_display')) { ?>	
	<div class="breadcrumbs-wrap">
		<div id="breadcrumbs">
			<?php bcn_display(); ?>
		</div>
	</div>
	<?php } ?>
	
	<div class="heading-divider"></div>
	
</div>

<div class="inner-page-wrap has-right-sidebar top-spacing clearfix">

	<!-- OPEN article -->
	<div class="type-page type-woocommerce two-thirds column alpha clearfix">
		
		<section class="page-content clearfix">

			<?php woocommerce_content(); ?>
			
		</section>
			
	<!-- CLOSE article -->
	</div>
	
	<aside class="sidebar right-sidebar one-third column omega">
		<?php dynamic_sidebar('woocommerce-sidebar'); ?>
	</aside>

</div>

<!-- WordPress Hook -->
<?php get_footer(); ?>