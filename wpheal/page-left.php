<?php 

get_header(); 

/*
Template Name: Page with left sidebar
*/

?>
	<!-- BEGIN MAIN CONTENT -->
	<div id="page-title-wrap">
		<div class="container">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="breadcrumb"><?php if (function_exists('heal_breadcrumbs') && ( get_post_meta($post->ID,"breadcrumb",true) == "Yes" ) ) heal_breadcrumbs(); ?></div>
			<div id="page-title"><?php the_title(); ?></div>
			<div id="page-subtitle"><?php echo get_post_meta($post->ID, "page_description",true); ?></div>
		</div>
	</div>
	<div class="container">
		<div class="twelve columns left-content page content-right">
			<?php
				the_content();
				endwhile; endif;
			?>
		</div>
		<div class="four columns right-content sidebar-left">
			<?php dynamic_sidebar( 'page_sidebar' ); ?>	
		</div>
	</div>
	<!-- END MAIN CONTENT -->
<?php get_footer(); ?>
