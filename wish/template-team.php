<?php
/*
Template Name: Team
*/
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Wish
 */

get_header(); ?>
<?php
global $post;
$page_para = rwmb_meta( 'wish_header_bg', 'type=image&size=full', $post->ID );

?>
<!-- PARALLAX BANNER STARTS
			========================================================================= --> 
		<div class="parallax-inner page-10" <?php if(!empty($page_para)) { foreach($page_para as $image){ ?>style="background-image:url(<?php echo esc_url($image['url']); ?>);"<?php } } ?>>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<div class="info">
							<h1 class="animated" data-animation="flipInX" data-animation-delay="100"><?php the_title(); ?></h1>
							<div class="description animated" data-animation="fadeInUp" data-animation-delay="300"><?php echo get_post_meta($post->ID, 'wish_under_title', true); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /. PARALLAX BANNER ENDS
			========================================================================= -->
<div class="container blog-page">
			<!-- BLOG STARTS
			========================================================================= -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="row">
				<div class="col-md-12 page">
					<div class="info">
				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'team' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>
			
					</div>
					
				</div>
				
	</div>
			
</article><!-- #post-## -->
		
		<!-- /. BLOG ENDS
			========================================================================= -->
		
			
</div>
<?php get_footer(); ?>
