<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
 get_header(); ?>
<?php
			if(function_exists("rwmb_meta")){
				$images_c = rwmb_meta( 'wish_header_bg', 'type=image&size=full', get_option( 'page_for_posts' ) );
			}else{
				$images_c = array();
			}
			
?>
<!-- PARALLAX BANNER STARTS

			========================================================================= --> 			
		<div class="parallax-inner page-18" <?php if(!empty($images_c)) { foreach($images_c as $image){ ?>style="background-image:url(<?php echo esc_url($image['url']); ?>);"<?php } } ?> >
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<div class="info">
							<h1 class="animated" data-animation="flipInX" data-animation-delay="100"><?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?></h1>
							<div class="description animated" data-animation="fadeInUp" data-animation-delay="300"><?php echo get_post_meta(get_option( 'page_for_posts' ), 'wish_under_title', true); ?></div>
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