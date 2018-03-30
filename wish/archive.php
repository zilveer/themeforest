<?php
/**
 * The template for displaying search results pages.
 *
 * @package Wish
 */

get_header(); 
$redux_wish = wish_redux();
$banner_img = $redux_wish["wish-archive-banner"];	

?>

<!-- PARALLAX BANNER STARTS
			========================================================================= --> 
		<div class="parallax-inner page-02" style="background-image:url(<?php echo esc_url($banner_img['url']); ?>)">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<div class="info">
							<h1 class="animated" data-animation="flipInX" data-animation-delay="100"><?php single_month_title(" "); ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /. PARALLAX BANNER ENDS
			========================================================================= -->	
<div class="container-fluid wish-main">

	<div class="row no-gutter-10">
	
		<div class="col-lg-10">
		
		<?php if ( have_posts() ) : ?>

			

<ul>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>

</ul>
		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
		

	<div class="col-md-12">		
		<?php wish_posts_navigation(); ?>
	</div>


		</div>
		
		<div class="col-lg-2">
		
		<div class="related-posts row">
		
		<?php get_sidebar(); ?>
		
		</div>
		
		</div>
		
	</div>
	
</div><!-- #main -->
	

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
