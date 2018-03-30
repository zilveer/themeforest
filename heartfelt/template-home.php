<?php
/**
 * Template Name: Home
 *
 */

get_header(); ?>

<?php if ( get_theme_mod( 'home_hero_choice' ) ) { ?>

<div class="hero_wrap">

	<div class="hero_cta_wrap">

		<div class="bg-image-hero bg-image clearfix">

				<div class="hero_content_wrap">

						<div class="hero_content">

						<?php
							$hero_page = get_theme_mod( 'hero_page' );

							$args = array(
								'post_type' => 'page',
								'page_id' => $hero_page
							);
							$hero_content_query = new WP_Query( $args );

							// The Loop
							while ( $hero_content_query->have_posts() ) {
								$hero_content_query->the_post();
								the_content();
							}
							
							wp_reset_postdata();
						?>

						</div><!-- .hero_content -->

				</div><!-- .hero_content_wrap -->

		</div><!-- .bg-image .bg-image-hero -->

	</div><!-- .hero_cta_wrap -->

</div><!-- .hero_wrap -->

<?php } // end home_hero_choice check ?>

<?php if ( is_active_sidebar( 'home_hero' ) ) : 
	$hero_widgets_animate = get_theme_mod( 'hero_widgets_animate' );
?>

<div class="row hero_sidebar <?php if ( $hero_widgets_animate != 'none' ) { echo 'wow '; echo $hero_widgets_animate; };  ?>">

	<?php dynamic_sidebar( 'home_hero' );  ?>

</div><!-- .row -->

<?php endif; // end home_hero?>

<!-- Home Page Content -->
<div class="home_content_wrap">

	<div class="row">

		<div class="large-12 columns">

			<div class="home_content">

				<?php if (have_posts()) : while (have_posts()) : the_post();?>

					<?php the_content(); ?>

				<?php endwhile; endif; ?>

			</div><!-- .home_content -->

		</div><!-- .large-12 -->

	</div><!-- .row -->

	<!-- Blog Posts -->
	<?php if ( get_theme_mod( 'blog_section_choice' ) ) { ?>

	<?php 
		$home_blog_bg_image = get_theme_mod( 'home_blog_bg_image' );
		$blog_animate = get_theme_mod( 'blog_animate' );  
	?>

	<div class="blog_area_wrap clearfix <?php if ( $blog_animate != 'none' ) { echo 'wow '; echo $blog_animate; };  ?>" <?php if ( $home_blog_bg_image ) { ?> style="background:url('<?php echo esc_url( $home_blog_bg_image ); ?>') no-repeat scroll 0 0 transparent; background-size:cover;" <?php } ?>>

    	<div class="row blog_section_title">
    		
    		<div class="large-12 columns">			

			<h2><?php if ( get_theme_mod( 'home_blog_title' ) ) { echo esc_attr ( get_theme_mod( 'home_blog_title', customizer_library_get_default( 'home_blog_title' ) ) ); } ?></h2>

			<h5><?php if ( get_theme_mod( 'home_blog_subtitle' ) ) { echo esc_attr( get_theme_mod( 'home_blog_subtitle', customizer_library_get_default( 'home_blog_subtitle' ) ) ); } ?> 
				<a href="<?php if ( get_theme_mod( 'home_blog_link' ) ) { echo esc_attr( get_theme_mod( 'home_blog_link', customizer_library_get_default( 'home_blog_link' ) ) ); } ?> ">
					<?php echo esc_attr( get_theme_mod( 'home_blog_button_text', customizer_library_get_default( 'home_blog_button_text' ) ) ); ?>
				</a>
			</h5>

    		</div><!-- .large-12 -->

    	</div><!-- .row .blog_section_title -->

		<div class="row">

			<div class="owl-carousel large-12 columns blog_list">

				<?php 
					$home_blog_category = get_theme_mod( 'home_blog_category' );
					$home_blog_qty = get_theme_mod( 'home_blog_qty' );

					$args = array (
						'showposts' => $home_blog_qty,
						'category_name' => $home_blog_category,
						);
					$the_query = new WP_Query( $args ); 
					
					while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

					<div class="blog_single">

					<?php if ( has_post_thumbnail() ) {

						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnails'  );  
						the_post_thumbnail( 'home-blog-thumbnails' );

					?>

				      <span class="text-content">
				      	<span>
				      		<a href="<?php echo esc_url( $image[0] ); ?>" data-featherlight="image" alt="example"><i class="fa fa-picture-o fa-2x"></i></a>
				      		<a href="<?php the_permalink(); ?> "><i class="fa fa-link fa-2x"></i></a>
				      	</span>
				      </span>

				      <div class="blog_details">

					      <div class="blog_title">
					      	<h5><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h5>
					      </div><!-- .blog_title -->

					      <div class="blog_meta">
					      	<span class="blog_date"><i class="fa fa-calendar"></i><?php the_time('F j, Y'); ?></span>
					      	<span class="blog_comments"><a href="<?php comments_link(); ?> "><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></a></span>
					      </div><!-- .blog_meta -->

				 	 </div><!-- .blog_details -->

				<?php } else { // if no featured image, show empty image

					$image = get_template_directory_uri() . '/img/bg_post_no_image_245x245.jpg'; ?>

					<img alt="<?php the_title(); ?>" src="<?php echo esc_url( $image ); ?>">

				      <span class="text-content">
				      	<span>
				      		<a href="<?php the_permalink(); ?> "><i class="fa fa-link fa-2x"></i></a>
				      	</span>
				      </span>

				      <div class="blog_details">

					      <div class="blog_title">
					      	<h5><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h5>
					      </div><!-- .blog_title -->

					      <div class="blog_meta">
					      	<span class="blog_date"><i class="fa fa-calendar"></i><?php the_time('F j, Y'); ?></span>
					      	<span class="blog_comments"><a href="<?php comments_link(); ?> "><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></a></span>
					      </div><!-- .blog_meta -->

				 	 </div><!-- .blog_details -->

				<?php } // end image check ?>

					</div><!-- .blog_single -->

				<?php endwhile;?>
				
			</div><!-- .owl-carousel .large-12 -->

		</div><!-- .row -->

	</div><!-- .blog_area_wrap -->

	<?php } // end Blog Section ?>

	<!-- Latest from Shop -->
	<?php 
		if ( get_theme_mod( 'shop_section_choice' ) ) :
		$home_shop_animate = get_theme_mod( 'home_shop_animate' ); 
	?>
	<div class="home_shop_wrap <?php if ( $home_shop_animate != 'none' ) { echo 'wow '; echo $home_shop_animate; };  ?>">

		<div class="row">
			<div class="large-12 columns">

				<div class="shop_section_title">

					<h2>
						<?php if ( get_theme_mod( 'home_shop_title' ) ) { echo esc_attr( get_theme_mod( 'home_shop_title', customizer_library_get_default( 'home_shop_title' ) ) ); } ?>
					</h2>

					<h5>
						<?php if ( get_theme_mod( 'home_shop_subtitle' ) ) { echo esc_attr( get_theme_mod( 'home_shop_subtitle', customizer_library_get_default( 'home_shop_subtitle' ) ) ); } ?> 
						<?php if ( get_theme_mod( 'home_shop_link' ) ) { ?>
						<a href="<?php echo esc_attr( get_theme_mod( 'home_shop_link', customizer_library_get_default( 'home_shop_link' ) ) ); ?> ">
							<?php echo esc_attr( get_theme_mod( 'home_shop_link_text', customizer_library_get_default( 'home_shop_link_text' ) ) ); ?>
						</a>
						<?php } // end home_shop_link ?>
					</h5>

				</div><!-- .shop_section_title -->

				<?php echo do_shortcode('[featured_products per_page="3" columns="3" orderby="date" order="desc"]'); ?>

			</div><!-- . large-12 -->
		</div><!-- .row -->

	</div><!-- .home_shop_wrap -->
	<?php endif; // end shop_section_choice ?>

</div><!-- .home_content_wrap -->

<?php get_footer(); ?>
