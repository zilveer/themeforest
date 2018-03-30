<?php
/*-----------------------------------------------------------------------------------*/
/*	Gallery Module 1
/*-----------------------------------------------------------------------------------*/

function fav_gallery_module_1( $atts, $content = null )
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
		'module_meta'   => '',
		'author_name'   => '',
		'time_diff'    => '',
		'post_date'     => '',
		'post_time'     => '',
		'post_view_count'    => '',
		'post_comment_count' => '',
		'text_align'    => '',
		'module_bg' => '',
		'module_padding' => ''
    ), $atts ) );
	
	ob_start();

	if( $module_7_type == "two_columns" ) {
		$css_classes = "col-lg-6 col-md-6 col-sm-6 col-xs-6";
		$image_thumb_size = "big-thumb";
	} elseif( $module_7_type == "one_columns" ) {
		$css_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
		$image_thumb_size = "big-thumb";
	} else {
		$css_classes = "col-lg-4 col-md-4 col-sm-6 col-xs-6";
		$image_thumb_size = "small-thumb";
	}

	if( $image_size == '570_428' ) {
		$image_width = '570'; $image_height = '428';
	} else {
		$image_width = '370'; $image_height = '278';
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

    query_posts(fave_gallery_post_type_data_source::metabox_to_args($atts, $paged));
	?>
	
	<div class="module gallery-4 <?php echo $text_align; ?> main-box-for-load-more" <?php echo $style; ?>>
		
		<?php if ( $hide_title != 'hide_title' ) { ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="module-top clearfix"> 
					
					<?php echo fave_get_gallery_block_title( $atts ); ?> 
					<?php echo fave_get_gallery_block_sub_cats( $atts ); ?>

				</div><!-- .module-top -->
			</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
		</div><!-- .row -->
		<?php } ?>


		<div class="row <?php if(!empty($module_space)){ echo esc_attr( $module_space ); }?>">
			<div class="fave-loop-wrap">
				<div class="fave-post">
				<?php while ( have_posts() ): the_post(); ?>
				
					<div class="<?php echo esc_attr( $css_classes ); ?>">
						<div class="thumb <?php echo esc_attr( $image_thumb_size ); ?>">
							<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
							<div class="thumb-content">
								<h2 class="gallery-title-small"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
								<ul class="list-inline post-meta hidden-xs hidden-sm hidden-md">
									<?php fave_vc_gallery_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
								</ul><!-- .post-meta -->
							</div>
							<div class="slide-image-wrap slider-with-animation ">
								<div class="post-type-icon"><i class="fa fa-picture-o"></i></div>								
								<img class="featured-image" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" src="<?php echo fave_featured_image( get_the_ID(), $image_width, $image_height, true, true, true ); ?>">
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

add_shortcode('fav-gallery-module-1', 'fav_gallery_module_1');
?>