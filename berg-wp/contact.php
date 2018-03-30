<?php
/*
Template Name: Contact
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
<section class="section-scroll main-section">
	<?php if(YSettings::g('berg_show_page_title')) : ?>
	<header class="section-header">
		<?php the_title(sprintf('<h2 class="entry-title h3">', esc_url( get_permalink())), '</h2>'); ?>
	</header>
	<?php endif; ?>
	<div class="container section-padding">
		<div class="row">
			<div class="col-md-12">
				<?php 
				$post = get_post($id);
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