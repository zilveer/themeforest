<?php
/**
 * Template Name: Homepage 2
 * Description: Alternative homepage slider using parallax content slider
 *
 * @package WordPress
 * @subpackage Arapah-WP
 */
 ?>

    <?php get_header();  //the Header ?>
        
    <?php get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>
	
	
	<section id="slider">
	<!-- include slider -->
	<?php if (of_get_option('use_defaultslider') && function_exists( 'get_wp_parallax_content_slider' )) : ?>
		<div class="container parallax">	
			<div class="sixteen columns">
				<div class="gutter alpha omega">
				<?php get_wp_parallax_content_slider(); ?>
				</div>
			</div>
		</div>
	<?php endif;?>	
		
	<!-- include carousel posts -->
	<?php if (of_get_option('featured_carousel')) : ?>
		<?php get_template_part('includes/carousel'); ?> 
	<?php endif;?>		
	</section>
        
    
	<?php //include Promo
		if (of_get_option('use_promo')) : ?>
		<?php get_template_part('includes/promo');  ?>
	<?php endif;?>	
			
		<section id="maincontent" class="right-s">	
			<div class="container">	
			<?php $post_query = array( 'cat' => of_get_option('blog_cat'), 'posts_per_page' => 3 ); ?>
				<section id="homepage" class="two-thirds column">
					<div class="gutter alpha">
						<div class="main"> 
							<h3 class="page-title"><?php echo of_get_option('blog-title') ?></h3>
							<?php query_posts( $post_query ); ?>
							<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
											
							<article id="post-<?php the_ID(); ?>">
							  <div class="title">            
								 <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title('', ''); ?></a></h3>  <!--Post titles-->
							  </div>
								<?php
								global $more;
								$more = 0;
								?>
								<?php the_content(''); ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more-link"><span class="block">Read More</span></a>
							</article> <!--The Content-->			
							<?php endwhile; ?><!--  End the Loop -->
							<?php wp_reset_query();?>
					 
						</div>  <!-- .main -->
					</div>  <!-- .gutter .alpha -->
				</section>  <!-- #homepage .two-thirds .column -->
					 
			<?php get_template_part( 'sidebar', 'index' ); //the Sidebar ?>
			</div><!-- .container -->
		</section><!--  #maincontent -->
            
    <?php get_footer(); //the Footer ?>
                        
           
