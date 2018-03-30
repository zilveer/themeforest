<?php
/*
Template Name: Forum
*/
?>

<?php get_header(); ?>
	
<?php
	$options = get_option('sf_supreme_options');
	$page_layout = $options['page_layout'];
	if (isset($_GET['layout'])) {
		$page_layout = $_GET['layout'];
	}
?>

<div class="page-heading clearfix">

	<h2><?php the_title(); ?></h2>
	
	<?php if(function_exists('bcn_display')) { ?>	
	<div class="breadcrumbs-wrap">
		<div id="breadcrumbs">
			<?php bcn_display(); ?>
		</div>
	</div>
	<?php } ?>
	
	<div class="heading-divider"></div>
	
</div>

<div class="inner-page-wrap has-right-sidebar has-one-sidebar clearfix">
		
	<?php if (have_posts()) : the_post(); ?>

	<!-- OPEN article -->
	<div <?php post_class('clearfix two-thirds column alpha '. $spacing); ?> id="<?php the_ID(); ?>">
		
		<section class="page-content clearfix">

			<?php the_content(); ?>
			
		</section>
			
	<!-- CLOSE article -->
	</div>

	<?php endif; ?>
			
	<aside class="sidebar right-sidebar one-third column omega">
		<?php dynamic_sidebar('sidebar-2'); ?>
	</aside>

</div>

<!-- WordPress Hook -->
<?php get_footer(); ?>