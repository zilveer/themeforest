<?php 
	/*
	Template Name: Page With Sidebar
	*/
	get_header();
	the_post();
	
	get_sidebar('page');
?>

<section id="content" class="clearfix">
	
	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php 
			the_title('<h2 class="article-title entry-title"><a href="' . get_permalink() . '">','</a></h2><div class="break-30"></div>');
			the_content();
			wp_link_pages();
		?>
		
		<div class="clear"></div><!--clear floats-->
		
	</article>
	
</section>
	
<?php	
	get_footer();