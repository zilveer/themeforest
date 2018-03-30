<?php
/*
Template Name: Reservation
*/

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */

get_header(); 

?>
<section id="reservation" class="section-scroll main-section">
	<?php if(YSettings::g('berg_show_page_title')) : ?>
	<header class="section-header">
		<?php the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ), '</h2>' ); ?>
	</header> 
	<?php endif; ?>
	<div class="reservation-content container section-padding">
		<div class="row">
			<div class="col-xs-12 col-md-10 col-md-offset-1">
				<?php 
					the_post(); 
					the_content();
				?>
			</div>
		</div>
	</div>
</section>
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>



