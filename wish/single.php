<?php get_header(); ?>
<?php
global $post;


if(function_exists("rwmb_meta")){
	$page_para = rwmb_meta( 'wish_header_bg', 'type=image&size=full', $post->ID );
}


	$redux_wish = wish_redux();
	$layout = $redux_wish['wish-blog-single-layout'];
	//$layout = 1 => 3 columns (default)
	//$layout = 2 => Full Width
	//$layout = 3 => Right Column
	//$layout = 4 => Left Column

	$wish_sidebar = 'right';
	if($layout == 2){
		$wish_sidebar = 'no';
	}

	$blog_img_class = "";
	if(empty($page_para)){ 
		$blog_img_class = "blog_img_margin";

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
		<div <?php post_class("container-fluid blog-page"); ?>>
			<div class="row no-gutter-10 <?php echo sanitize_html_class($blog_img_class); ?>">
            <?php if($wish_sidebar == 'left'){ ?>
            	<div class="col-lg-2">
				
				<?php get_sidebar(); ?>
				
				
				</div>
                <?php } ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="<?php if($wish_sidebar == 'no'){ echo 'col-lg-12'; }else{ ?>col-lg-10<?php } ?> post">
			<?php while ( have_posts() ) : the_post(); ?>
				<!-- Posts Detail Starts -->
			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php endwhile; // end of the loop. ?>
            	</div>
</article><!-- #post-## -->
				<!-- Posts Detail Ends -->
			 <?php if($wish_sidebar == 'right'){ ?>
            	<div class="col-lg-2">
				
				<?php get_sidebar(); ?>
				
				
				</div>
                <?php } ?>
				
			</div>
		</div>
		<!-- /. BLOG ENDS
			========================================================================= -->
		
			<?php get_footer(); ?>