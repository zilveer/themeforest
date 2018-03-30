<?php
/**
 * The template for displaying search results pages.
 *
 * @package berg-wp
 */


get_header(); 

?>

<section id="primary" class="content-area section-scroll main-section search-section">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>


		<header class="section-header">
			<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'BERG'), '<span>' . get_search_query() . '</span>' ); ?></h2>
		</header>

		<div class="container">
			<div class="row">
				<div class="col-md-7 search-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'search' ); ?>
				<?php endwhile; ?>
				</div>
				<div class="col-md-4 col-md-offset-1 widget-sidebar sidebar-padding">
					<?php get_sidebar();?>
				</div>	
				<?php berg_wp_paging_nav(); ?>
			</div>
		</div>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

	</main>
</section>
<?php
if (YSettings::g('berg_archive_footer', 1) == 1) {
	get_template_part('footer', 'content');
}
get_template_part('footer'); 
?>