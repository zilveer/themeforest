<?php
/*-----------------------------------------------------------------------------------*/
/*	Video Module 1
/*-----------------------------------------------------------------------------------*/

function fav_video_module_1( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'module_7_type'		=> '',
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
		'show_child_cat'	=> '',
		'title_style'	 	=> '',
		'image_size'        => '',
		'pagination'		=> '',
		'module_space'		=> '',
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

	if( $module_7_type == "two_columns" ) {
		$css_classes = "col-lg-6 col-md-6 col-sm-6 col-xs-6";

	} elseif( $module_7_type == "one_columns" ) {
		$css_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
	} else {
		$css_classes = "col-lg-4 col-md-4 col-sm-6 col-xs-6";
	}

	if( $image_size == '570_320' ) {
		$image_width = '570'; $image_height = '320';
	} else {
		$image_width = '370'; $image_height = '208';
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

	// Pagination
	if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');

	} elseif ( get_query_var('page') ) {
	    $paged = get_query_var('page');

	} else {
	    $paged = 1;
	}

    query_posts(fave_video_post_type_data_source::metabox_to_args($atts, $paged));
	?>
	
	<div class="module gallery-4 main-box-for-load-more <?php echo $text_align; ?>" <?php echo $style; ?>>
		
		<?php if ( $hide_title != 'hide_title' ) { ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="module-top clearfix"> 
					
					<?php echo fave_get_video_block_title( $atts ); ?> 
					<?php echo fave_get_video_block_sub_cats( $atts ); ?>

				</div><!-- .module-top -->
			</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
		</div><!-- .row -->
		<?php } ?>


		<div class="row <?php if(!empty($module_space)){ echo $module_space; }?>">
			<div class="fave-loop-wrap">
				<div class="fave-post">
				<?php while ( have_posts() ): the_post(); ?>
				
					<div class="<?php echo esc_attr( $css_classes ); ?>">
						<div class="thumb big-thumb video-thumb">
							<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
							<div class="thumb-content">
								<h2 class="gallery-title-small"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
								<ul class="list-inline post-meta">
									<?php fave_vc_video_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
								</ul>
							</div>
							<div class="slide-image-wrap slider-with-animation">
								<img class="featured-image" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" src="<?php echo fave_featured_image( get_the_ID(), $image_width, $image_height, true, true, true ); ?>" alt="<?php the_title(); ?>">
							</div><!-- slide-image-wrap -->
						</div><!-- thumb -->
					</div><!-- col-lg-4 col-md-4 col-sm-6 col-xs-6 -->
					
				<?php endwhile; ?>
				</div>
			</div>

	    </div><!-- row -->

	    <?php if( !empty($pagination) ): ?>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php get_template_part( 'inc/pagination/'.$pagination ); ?>
			</div>
		</div>
		<?php endif; ?>

	</div><!-- .module-7 -->

	<?php 
	wp_reset_query();

	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('fav-video-module-1', 'fav_video_module_1');
?>