<?php
/*-----------------------------------------------------------------------------------*/
/*	Module 7
/*-----------------------------------------------------------------------------------*/

function fav_module_7( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'module_7_type'		=> '',
		'category_id'		=> '',
		'category_ids'	  	=> '',
		'tag_slug'    		=> '',
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
		'title_style'	 	=> '',
		'show_child_cat'	=> '',
		'image_size'        => '',
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

	if ( $module_7_type == "two_columns" ) {
		$css_classes = "col-lg-6 col-md-6 col-sm-6 col-xs-6";
		$columns_class = "module-7-two-cols";
	} elseif ( $module_7_type == "one_columns" ) {
		$css_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
		$columns_class = "module-7-one-cols";
	} else {
		$css_classes = "col-lg-4 col-md-4 col-sm-6 col-xs-6";
		$columns_class = "module-7-three-cols";
	}

	if( $image_size == '570_427' ) {
		$img_width = '570'; $img_height = '427';
	} else {
		$img_width = '370'; $img_height = '277';
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

    //do the query
    $the_query = fave_data_source::get_wp_query($atts); //by ref  do the query
	?>
	
	<div class="module module-7 <?php echo esc_attr( $columns_class.' '.$text_align ); ?> gallery-4" <?php echo $style; ?>>
		<?php if ( $hide_title != 'hide_title' ) { ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="module-top clearfix">
					<?php					
					//get the block title
					echo fave_get_block_title( $atts );
					//get the sub category filter for this block
					echo fave_get_block_sub_cats( $atts );
					?>
				</div><!-- .module-top -->
			</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
		</div><!-- .row -->
		<?php } ?>

		<div class="row <?php if(!empty($module_space)){ echo $module_space; }?>">
			<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
			<div <?php post_class($css_classes); ?> <?php echo fave_get_item_scope(); ?>>
				<div class="thumb big-thumb">
					<a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"></a>
					<div class="thumb-content">
						<h2 itemprop="headline" class="gallery-title-small"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta hidden-xs hidden-sm hidden-md">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->
					</div>
					<div class="slide-image-wrap slider-with-animation">
						<?php get_template_part( 'inc/article', 'icon' ); ?>
						<img itemprop="image" class="featured-image" width="<?php echo $img_width; ?>" height="<?php echo $img_height; ?>" src="<?php echo fave_featured_image( get_the_ID(), $img_width, $img_height, true, true, true ); ?>" alt="<?php the_title(); ?>">
					</div><!-- slide-image-wrap -->
				</div><!-- thumb -->
			</div><!-- col-lg-4 col-md-4 col-sm-6 col-xs-6 -->				
			<?php endwhile; ?>
	    </div><!-- row -->
	</div><!-- .module-7 -->

	<?php 
	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('fav-module-7', 'fav_module_7');
?>