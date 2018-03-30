<?php
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

if(function_exists("rwmb_meta")){
	$page_para = rwmb_meta( 'wish_header_bg', 'type=image&size=full', $post->ID );
	$page_text = rwmb_meta('wish_under_title', $post->ID);
	$page_check = rwmb_meta('wish_under_check', $post->ID);
}else{
	$page_check = 0;
	$page_para = array();
	$page_text = "";
}



if ($page_check == 1) {

?>
<!-- PARALLAX BANNER STARTS
			========================================================================= --> 
		<div class="parallax-inner page-10" <?php if(!empty($page_para)) { foreach($page_para as $image){ ?>style="background-image:url(<?php echo esc_url( $image['url'] ); ?>);"<?php } } ?>>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<div class="info">
							<h1 class="animated" data-animation="flipInX" data-animation-delay="100"><?php echo esc_attr( get_the_title() ); ?></h1>
							<div class="description animated" data-animation="fadeInUp" data-animation-delay="300"><?php echo esc_attr($page_text); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /. PARALLAX BANNER ENDS
			========================================================================= -->
<?php } ?>
<div class="container blog-page">
    <div class="content">

    <?php if($page_check == 0) { ?> <h1 class="single-page-title"><?php echo esc_attr( get_the_title() ); ?></h1> <?php } ?>
       
        <div class="row">
            <div class="col-md-12">
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
           <!-- </div>-->
            
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->
</div>

<?php get_footer(); ?>
