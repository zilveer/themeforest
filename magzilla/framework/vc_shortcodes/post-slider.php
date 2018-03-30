<?php
/*-----------------------------------------------------------------------------------*/
/*	Post Slider
/*-----------------------------------------------------------------------------------*/

function fav_post_slider( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'slider_type'	=> '',
		'slider_text_align' => '',
		'post_from'     => '',
		'category_id'	=> '',
		'category_ids'	=> '',
		'image_crop'	=> '',
		'hide_cat'		=> '',
		'sort'			=> '',
		'posts_limit'	=> '',
		'slider_auto'   => '',
		'stop_on_hover'	=> '',
		'navigation'	=> '',
		'bullets_pagination' => '',
		'touch_drag'    => 'true',
		'slide_loop'    => 'false',
		'rewind_nav'	=> '',
		'lazy_load'	    => '',
		'module_meta'   => '',
		'author_name'   => '',
		'time_diff'    => '',
		'post_date'     => '',
		'post_time'     => '',
		'post_view_count'    => '',
		'post_comment_count' => '',
		'module_bg' => '',
		'module_padding' => ''
		), $atts ) );
	
	ob_start();

	$style = $bg = $padding = '';
	if( !empty( $module_bg ) ) {
		$bg = "background-color:".$module_bg.";";
	}
	if( !empty( $module_padding ) ) {
		$padding = "padding:".$module_padding.";";
	}

	if( !empty( $bg ) || !empty( $padding ) ) {
		$style = 'style="' . $bg . ' ' . $padding . '"';
	}

    //do the query
	$wp_query_args = array(
		'ignore_sticky_posts' => 1
		);

	if( $post_from == "category_posts" ) {
		if (!empty($category_id) and empty($category_ids)) {
			$category_ids = $category_id;
		}


		if (!empty($category_ids)) {
			$wp_query_args['cat'] = $category_ids;
		}
	}

	if( $post_from == "featured" ) {

		$wp_query_args['meta_key'] = 'fave_featured';
		$wp_query_args['meta_value'] = '1';
	}

	$current_day = date('j');

	switch ($sort) {

		case 'popular':
		$wp_query_args['meta_key'] = 'fave-post_views';
		$wp_query_args['orderby'] = 'meta_value_num';
		$wp_query_args['order'] = 'DESC';
		break;
		case 'review_high':
            $wp_query_args['meta_key'] = '';//td_review::$td_review_key;
            $wp_query_args['orderby'] = 'meta_value_num';
            $wp_query_args['order'] = 'DESC';
            break;
            case 'random_posts':
            $wp_query_args['orderby'] = 'rand';
            break;
            case 'alphabetical_order':
            $wp_query_args['orderby'] = 'title';
            $wp_query_args['order'] = 'ASC';
            break;
            case 'comment_count':
            $wp_query_args['orderby'] = 'comment_count';
            $wp_query_args['order'] = 'DESC';
            break;
            case 'random_today':
            $wp_query_args['orderby'] = 'rand';
            $wp_query_args['year'] = date('Y');
            $wp_query_args['monthnum'] = date('n');
            $wp_query_args['day'] = date('j');
            break;
            case 'random_7_day':
            $wp_query_args['orderby'] = 'rand';
            $wp_query_args['date_query'] = array(
            	'column' => 'post_date_gmt',
            	'after' => '1 week ago'
            	);
            break;
        }

    //custom pagination limit
        if (empty($posts_limit)) {
        	$posts_limit = get_option('posts_per_page');
        }
        $wp_query_args['posts_per_page'] = $posts_limit;

        $the_query = new WP_Query($wp_query_args);


        $unique_key = fave_unique_key();
		if ( is_rtl() ) { $magzilla_rtl = 'true'; } else { $magzilla_rtl = 'false'; }

	?>

        <script>
        	jQuery(document).ready(function($) {

		        var $elements = $( '[data-vc-stretch-content="true"]' );
		        $.each( $elements, function ( key, item ) {
			        var $el = $( this );
			        $el.children().children().children().children().children().addClass( 'banner-stretch-content' );


		        } );

		        var banner_slider = function () {
			        $('#owl-carousel-grid-banner-slide-<?php echo $unique_key; ?>').owlCarousel({
				        rtl: <?php echo $magzilla_rtl; ?>,
				        loop: <?php echo $slide_loop; ?>,
				        touchDrag: <?php echo $touch_drag; ?>,
				        items: 1,

				        //Autoplay
				        autoplay: <?php echo $slider_auto; ?>,
				        autoplayHoverPause: <?php echo $stop_on_hover; ?>,

				        // Navigation
				        nav: <?php echo $navigation; ?>,
				        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
				        navRewind: <?php echo $rewind_nav; ?>,
				        dots: <?php echo $bullets_pagination; ?>,

				        // Responsive
				        responsiveClass: true,
				        responsiveRefreshRate: 200,
				        responsiveBaseWidth: window,

				        //Lazy load
				        lazyLoad: <?php echo $lazy_load; ?>,
				        lazyFollow: true,
				        lazyEffect: "fade",
			        });
		        }

		        if( $('#owl-carousel-grid-banner-slide-<?php echo $unique_key; ?>').hasClass('banner-stretch-content') ) {

			        $(window).load(function() {

				        banner_slider();

			        });

		        } else {
			            banner_slider();
		        }

});
</script>


<?php if( $slider_type == "fullwidth_slider" ) { ?>

<div class="grid-banner banner-slide" <?php echo $style; ?>>
	<!-- owl-carousel-grid-banner-slide -->
	<div id="owl-carousel-grid-banner-slide-<?php echo $unique_key; ?>" class="owl-carousel">

		<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>

			<?php if( has_post_thumbnail() ): 

			if( $image_crop == "yes" ) {
				$featured_image = fave_featured_image( get_the_ID(), 1470, 650, true, true, true );
			} else {
				$featured_image = fave_featured_image( get_the_ID(), 1470, 650, false);
			}

			else:

				$featured_image = 'http://placehold.it/1170x400';
			endif;
			?>
			<div <?php post_class('slide'); ?> <?php echo fave_get_item_scope(); ?>>
				<div class="row row-no-padding">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="left-side">
							<!-- thumb -->
							<div class="thumb">
								<a href="<?php the_permalink(); ?>"></a>
								<div class="thumb-content <?php echo esc_attr( $slider_text_align ); ?>">

									<?php if( $hide_cat != 'no' ): ?>
										<div class="category-label">
											<?php get_template_part( 'inc/post', 'cats' ); ?>
										</div>
									<?php endif; ?>

									<h2 itemprop="headline" class="gallery-title-big"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<ul class="list-inline post-meta">
										<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
									</ul><!-- .post-meta -->
								</div>
								<div class="slide-image-wrap">
									<?php get_template_part( 'inc/article', 'icon' ); ?>
									<img itemprop="image" class="featured-image lazyOwl" width="1170" height="440" data-src="<?php echo $featured_image; ?>" src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>">
								</div><!-- slide-image-wrap -->
							</div>
						</div>
					</div><!-- col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
				</div><!-- row row-no-padding -->
			</div><!-- slide -->

		<?php endwhile; ?>

		<?php
		/* Restore original Post Data */
		wp_reset_postdata();
		?>

	</div><!-- owl-carousel-grid-banner-slide -->
</div>

<?php } elseif ( $slider_type == "grid_slider" ) { ?>

<div class="grid-banner grid-banner-slide" <?php echo $style; ?>>
	<!-- owl-carousel-grid-banner-slide -->
	<div id="owl-carousel-grid-banner-slide-<?php echo $unique_key; ?>" class="owl-carousel">

		<?php $i = 0; $post_counter = 0; ?>

		<?php while ( $the_query->have_posts() ): $the_query->the_post(); $i++; $post_counter++; ?>

			<?php if( $i == 1 ): ?>
				<div <?php post_class('slide'); ?> <?php echo fave_get_item_scope(); ?>>
					<div class="row row-no-padding">
					<?php endif; ?>


					<?php if( $i == 1 ): ?>
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
							<div class="left-side">
								<!-- thumb -->
								<div class="thumb">
									<a href="<?php the_permalink(); ?>"></a>
									<div class="thumb-content">
										<?php if( $hide_cat != 'no' ): ?>
											<div class="category-label">
												<?php get_template_part( 'inc/post', 'cats' ); ?>
											</div>
										<?php endif; ?>

										<h2 itemprop="headline" class="gallery-title-big"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<ul class="list-inline post-meta">
											<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
										</ul><!-- .post-meta -->
									</div>
									<?php if ( has_post_thumbnail() ) { ?>
									<div class="slide-image-wrap">
										<?php get_template_part( 'inc/article', 'icon' ); ?>

										<?php if( $image_crop == "yes" ) { ?>
										<img class="featured-image lazyOwl" width="780" height="440" data-src="<?php echo fave_featured_image( get_the_ID(), 780, 440, true, true, true ); ?>" src="<?php echo fave_featured_image( get_the_ID(), 780, 440, true, true, true ); ?>" alt="<?php the_title(); ?>">
										<?php } else { ?>
										<img class="featured-image lazyOwl" width="780" height="440" data-src="<?php echo fave_featured_image( get_the_ID(), 780, 440, false); ?>" src="<?php echo fave_featured_image( get_the_ID(), 780, 440, false); ?>" alt="<?php the_title(); ?>">
										<?php } ?>
									</div><!-- slide-image-wrap -->
									<?php } ?>
								</div>
							</div>
						</div><!-- col-xs-8 col-sm-8 col-md-8 col-lg-8 -->
					<?php endif; ?>

					<?php if( $i == 2 ): ?>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="right-side">

							<?php endif; ?>
								<!-- thumb -->
								<?php if( $i == 2 || $i == 3 ): ?>
									<div class="col-xs-6 col-sm-12 col-md-12 col-lg-12">
										<div <?php post_class('thumb'); ?> <?php echo fave_get_item_scope(); ?>>
											<a href="<?php the_permalink(); ?>"></a>
											<div class="thumb-content">
												<?php if( $hide_cat != 'no' ): ?>
													<div class="category-label">
														<?php get_template_part( 'inc/post', 'cats' ); ?>
													</div>
												<?php endif; ?>
												<h2 itemprop="headline" class="gallery-title-small"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
												<ul class="list-inline post-meta">
													<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
												</ul><!-- .post-meta -->
											</div>
											<?php if ( has_post_thumbnail() ) { ?>
											<div class="slide-image-wrap">
												<?php get_template_part( 'inc/article', 'icon' ); ?>
												<?php if( $image_crop == "yes" ) { ?>
												<img itemprop="image" class="featured-image lazyOwl" width="390" height="220" data-src="<?php echo fave_featured_image( get_the_ID(), 390, 220, true, true, true ); ?>" src="<?php echo fave_featured_image( get_the_ID(), 390, 220, true, true, true ); ?>" alt="<?php the_title(); ?>">
												<?php } else { ?>
												<img itemprop="image" class="featured-image lazyOwl" width="390" height="220" data-src="<?php echo fave_featured_image( get_the_ID(), 390, 220, false); ?>" src="<?php echo fave_featured_image( get_the_ID(), 390, 220, false); ?>" alt="<?php the_title(); ?>">
												<?php } ?>
											</div><!-- slide-image-wrap -->
											<?php } ?>

										</div>
									</div>
								<?php endif; ?>

								<?php if( ($i == 3 ) || ( ( $i == 2 ) && ( $post_counter == $the_query->post_count ) ) ): ?>
								
							</div><!-- right-side -->
						</div><!-- col-xs-4 col-sm-4 col-md-4 col-lg-4 -->
					<?php endif; ?>

					<?php if( ($i == 3) || ( $post_counter == $the_query->post_count ) ):  $i = 0; ?>
					</div><!-- row row-no-padding -->
				</div><!-- slide -->
			<?php endif; ?>

		<?php endwhile; ?>

		<?php
		/* Restore original Post Data */
		wp_reset_postdata();
		?>

	</div><!-- owl-carousel-grid-banner-slide -->

</div>

<?php } ?>

<?php 
$result = ob_get_contents();  
ob_end_clean();
return $result;

}

add_shortcode('fav-post-slider', 'fav_post_slider');
?>