<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 
 */

get_header(); ?>
<?php
	$redux_wish = wish_redux();
	$banner_img = $redux_wish["wish-author-banner"];	
			
?>
<!-- PARALLAX BANNER STARTS

			========================================================================= --> 			
		<div class="parallax-inner page-02" style="background-image:url(<?php echo esc_url($banner_img['url']); ?>)">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<div class="info">
							<h1 class="animated" data-animation="flipInX" data-animation-delay="100"><?php printf( esc_html__( 'Posts by %s', 'wish' ), get_the_author() ); ?></h1>
							<div class="description animated" data-animation="fadeInUp" data-animation-delay="300"><?php the_author_meta( 'description' ); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /. PARALLAX BANNER ENDS
			========================================================================= -->
		<!-- BLOG STARTS
			========================================================================= -->
		<div class="container-fluid blog-page">


<?php $wish = 0; ?>
<?php if ( have_posts() ) : ?> 

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
        
        <?php $wish = $wish+1;  ?>

<?php endwhile; ?>

<?php //kleo_pagination(); ?>

<?php else : ?>
    <?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>     

</div>

<?php get_footer(); ?>