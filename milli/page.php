<?php 
	get_header();
	the_post();
?>

<section id="content" class="clearfix">
	
	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php 
			the_title('<h2 class="article-title mega entry-title">','</h2><div class="break-30"></div>');
			the_content();
			wp_link_pages();
		?>
		<div class="clear"></div><!--clear floats-->
		
	</article>
	
</section>
	
<?php	
	get_footer();