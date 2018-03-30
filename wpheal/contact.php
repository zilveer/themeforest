<?php 

/*
Template Name: Contact page
*/

get_header(); 

?>
	<!-- BEGIN MAIN CONTENT -->
	<div id="page-title-wrap">
		<div class="container">
			<div id="breadcrumb"><?php if (function_exists('heal_breadcrumbs') && ( get_post_meta($post->ID,"breadcrumb",true) == "Yes" ) ) heal_breadcrumbs(); ?></div>
			<div id="page-title"><?php the_title(); ?></div>
			<div id="page-subtitle"><?php echo get_post_meta($post->ID, "page_description",true); ?></div>
		</div>
	</div>
	<div class="container">
		<div class="twelve columns left-content contact-page">
			<?php
				if (have_posts()) : while (have_posts()) : the_post();
				the_content();
				endwhile; endif;
			?>
		</div>
		<div class="four columns right-content">
			<?php dynamic_sidebar( 'contact_sidebar' ); ?>	
		</div>
	</div>
	<!-- END MAIN CONTENT -->
<?php get_footer(); ?>
