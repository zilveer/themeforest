<?php 
	/*
	Template Name: Page No Title
	*/
	get_header();
	the_post();
?>

<section id="content" class="clearfix">
	
	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php 
			the_content();
			wp_link_pages();
		?>
		<div class="clear"></div><!--clear floats-->
		
	</article>
	
</section>
	
<?php	
	get_footer();