<?php
/*-----------------------------------------------------------------------------------*/
/*	Module 5
/*-----------------------------------------------------------------------------------*/

function fav_module_5( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'module_5_type'		=> '',
		'module_title_size' => 'module-big-title',
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
		'module_excerpt'	=> '',
		'excerpt_limit'		=> '',
		'image_size'        => '',
		'read_more'			=> '',
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
    //do the query
    $the_query = fave_data_source::get_wp_query($atts); //by ref  do the query

    if ( $module_5_type == 'three_columns' ) {
    	$css_class = "col-lg-4 col-md-4 col-sm-6 col-xs-6";
    	$columns_class = "module-5-three-cols";
    	$title_class = $module_title_size;
    } elseif ( $module_5_type == 'one_columns' )  {
	    $css_class = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
	    $columns_class = "module-5-one-cols";
	    $title_class = $module_title_size;
    } else {
    	$css_class = "col-lg-6 col-md-6 col-sm-6 col-xs-6";
    	$columns_class = "module-5-two-cols";
    	$title_class = $module_title_size;
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

	?>
	

	<div class="module-5 <?php echo $columns_class.' '.$text_align; ?> module" <?php echo $style; ?>>
		
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


		<div class="row">
			
			<?php

			$count = 0;
		
			while ( $the_query->have_posts() ): $the_query->the_post();
				$count++;

				$categories = get_the_category( get_the_ID() );

				$cats_html = '';
				if($categories){
					foreach($categories as $category) {
						$cat_id = $category->cat_ID;
						$cat_link = get_category_link( $cat_id );
						
						$cats_html .= '<a class="cat-color-'.$cat_id.'" href="'.esc_url($cat_link).'">'.esc_html($category->name).'</a>';
					}
				}

				
			?>
				
				<div <?php post_class($css_class); ?> <?php echo fave_get_item_scope(); ?>>
					
					<?php if ( has_post_thumbnail() ) { ?>
					<div class="featured-image-wrap">
						<?php get_template_part( 'inc/article', 'icon' ); ?>
						
						<div class="category-label"><?php echo $cats_html; ?></div>

						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<img itemprop="image" class="featured-image" width="<?php echo $img_width; ?>" height="<?php echo $img_height; ?>" src="<?php echo fave_featured_image( get_the_ID(), $img_width, $img_height, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</a>
						
					</div><!-- featured-image-wrap -->
					<?php } ?>

					<article>
						<h2 itemprop="headline" class="post-title <?php echo $title_class; ?>"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->

						<?php if( $module_excerpt != 'hide_excerpt' ): ?>
						<div class="post-content post-small-content" itemprop="articleBody"><p><?php echo fave_clean_excerpt( $excerpt_limit, $read_more ); ?></p></div><!-- post-content -->
						<?php endif; ?>

					</article><!-- .module-5-post -->
				</div><!-- col-lg-6 col-md-6 col-sm-12 col-xs-12 -->

				
				<?php endwhile; ?>
			
		</div><!-- .row -->
	</div><!-- .module-5 -->
    

	<?php 
	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('fav-module-5', 'fav_module_5');
?>