<?php 
/**
 * Template Name: Site Map
 */

get_header(); 
 
?>
	<div class="content-wrapper">
		<div class="page-wrapper sitemap">
			<div class="sixteen columns mt30">
				<div class="gdl-page-title-wrapper">
					<h1 class="gdl-page-title gdl-title title-color"><?php the_title(); ?></h1>
					<div class="gdl-page-title-left-bar"></div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="one-third column">
				<?php dynamic_sidebar( 'Site Map 1' ); ?>
			</div>
			<div class="one-third column">
				<?php dynamic_sidebar( 'Site Map 2' ); ?>
			</div>
			<div class="one-third column">
				<?php dynamic_sidebar( 'Site Map 3' ); ?>
			</div>
			<br class="clear">
		</div>
	</div> <!-- content-wrapper -->
	
<?php get_footer(); ?>