<?php 
/*
Template Name: Page Left Sidebar
*/
?>
<?php get_header(); 
if(function_exists('rwmb_meta')){
		$page_para = rwmb_meta( 'wish_header_bg', 'type=image&size=full', $post->ID );
}else{
	$page_para = array();
}

?>
<!-- PARALLAX BANNER STARTS
			========================================================================= --> 
            <?php if(!empty($page_para)){ ?>
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
         <?php } ?>
		<!-- /. PARALLAX BANNER ENDS
			========================================================================= -->
		<!-- BLOG STARTS
			========================================================================= -->
		<div class="container-fluid blog-page">
			<div class="row">
				<!-- Posts Detail Starts -->
				<div class="col-lg-10 col-md-10 col-sm-10 col-lg-push-2 col-md-push-2 col-sm-push-2">              
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'template-parts/content', 'page' ); ?>

                           <?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

                        <?php endwhile; // end of the loop.  ?>

                    </main><!-- #main -->
                </div><!-- #primary -->
									</div>
				
				<!-- Related Posts Starts -->
				<div class="col-lg-2 col-md-2 col-sm-2 col-sm-pull-10 col-md-pull-10 col-lg-pull-10 wish_sidebar_page">
					<?php get_sidebar(); ?>	
				</div>
				<!-- Related Posts Ends -->
			</div>
		</div>
		<!-- /. BLOG ENDS
			========================================================================= -->
		<?php get_footer(); ?>