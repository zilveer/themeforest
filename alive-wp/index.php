<?php
/**
 * Index file.
 *
 */

get_header(); ?>

	<!--start contentWrapper-->
	<div id="contentWrapper">
		<!--start content-->
		<div id="content">
			<!-- start Page -->
			<div id="page">
				<?php while(have_posts()):the_post();  ?>
				<h1 class="pageHeading"><?php the_title();?></h1>
				
					<?php the_content(); ?>
	
			<?php endwhile;?>
								
			</div>
			<!-- end Page -->
		

	<?php get_sidebar(); ?> 

<?php get_footer(); ?>