<?php
/*-----------------------------------------------------------------------------------*/
/*	Video Module 2
/*-----------------------------------------------------------------------------------*/

function fav_video_module_2( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'category_id'		=> '',
		'sort'	  			=> '',
		'autors_id'	  		=> '',
		'posts_limit'	  	=> '',
		'offset'	 	 	=> '',
		'header_color'	  	=> '',
		'header_text_color' => '',
		'header_border_color' => '',
		'custom_title'	  	=> '',
		'custom_url'	 	=> '',
		'hide_title'		=> '',
		'hide_meta'			=> '',
		'title_style'	 	=> '',
		'slider_post_row'	=> '',
		'slider_auto'		=> '',
		'stop_on_hover'		=> '',
		'navigation'		=> '',
		'touch_drag'        => 'true',
		'slide_loop'        => 'false',
		'rewind_nav'		=> '',
		'lazy_load'			=> '',
		'text_align'    => '',
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

	$rnr_id = fave_element_key();

	if ( is_rtl() ) { $magzilla_rtl = 'true'; } else { $magzilla_rtl = 'false'; }

	?>
	<script>
		jQuery(document).ready(function($) {

		// Gallery 1 with sidebar
		$("#favethemes-carousel-<?php echo $rnr_id; ?>").owlCarousel({ 
			rtl: <?php echo $magzilla_rtl; ?>,
			loop: <?php echo $slide_loop; ?>,
			touchDrag: <?php echo $touch_drag; ?>,

			responsive:{
				0:{
					items:2
				},
				479:{
					items:2
				},
				768:{
					items:3
				},
				980:{
					items:3
				},
				1199:{
					items:<?php echo $slider_post_row; ?>
				}
			},

			//Autoplay
			autoplay : <?php echo $slider_auto; ?>,
			autoplayHoverPause : <?php echo $stop_on_hover; ?>,

			// Navigation
			nav : <?php echo $navigation; ?>,
			navRewind : <?php echo $rewind_nav; ?>,
			navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],

			// Responsive
			responsiveClass:true,
			responsiveRefreshRate : 200,
			responsiveBaseWidth: window,

			//Lazy load
			lazyLoad : <?php echo $lazy_load; ?>,
			lazyFollow : true,
			lazyEffect : "fade",

		});
	});

	</script>
	<?php
    //do the query
	$the_query = fave_video_post_type_data_source::get_wp_query($atts);

	if( $slider_post_row == '1' ) {

		$img_width = '1170'; 
		$img_height = '658';
		$title_custom_class = "title-cols-1";

	} elseif( $slider_post_row == '2' ) {

		$img_width = '570'; 
		$img_height = '320';
		$title_custom_class = "title-cols-2";

	} elseif( $slider_post_row == '2' ) {
		$title_custom_class = "title-cols-3";    	

	} else {
		$img_width = '370'; 
		$img_height = '208';
		$title_custom_class = "title-cols-4";
	}

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

	?>
	
	<div class="module-8 video <?php echo $text_align; ?>" <?php echo $style; ?>>
		
		<?php if ( $hide_title != 'hide_title' ) { ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="module-top clearfix"> <?php echo fave_get_video_block_title( $atts ); ?> </div><!-- .module-top -->
			</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
		</div><!-- .row -->
		<?php } ?>


		<div class="row">
			<div id="favethemes-carousel-<?php echo $rnr_id; ?>" class="owl-carousel">
				<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
					<div class="slide">
						<div class="thumb big-thumb video-thumb">
							<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
							<div class="slide-image-wrap slider-with-animation">
								<img class="featured-image lazyOwl" data-src="<?php echo fave_featured_image( get_the_ID(), $img_width, $img_height, true, true, true ); ?>" src="<?php echo fave_featured_image( get_the_ID(), $img_width, $img_height, true, true, true ); ?>" alt="<?php the_title(); ?>">

							</div><!-- slide-image-wrap -->
						</div>
						<h2 class="gallery-title-small <?php echo esc_attr( $title_custom_class ); ?>"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<?php if( $hide_meta != 'hide_meta' ): ?>
							<ul class="list-inline post-meta">
								<?php fave_vc_video_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
							</ul><!-- .post-meta -->
						<?php endif; ?>
					</div><!-- slide -->
				<?php endwhile; wp_reset_postdata(); ?>
			</div><!-- owl-carousel -->
		</div><!-- row -->
	</div><!-- .module-8 -->

	<?php 
	$result = ob_get_contents();  
	ob_end_clean();
	return $result;

}

add_shortcode('fav-video-module-2', 'fav_video_module_2');
?>