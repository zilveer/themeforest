<?php
/*-----------------------------------------------------------------------------------*/
/*	Module 6
/*-----------------------------------------------------------------------------------*/

function fav_module_6( $atts, $content = null )
{
	extract( shortcode_atts( array(
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
		'module_bg' => '',
		'module_padding' => ''
    ), $atts ) );
	
	ob_start();

    //do the query
    $the_query = fave_data_source::get_wp_query($atts); //by ref  do the query

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
	

	<div class="module-6 module" <?php echo $style; ?>>
		
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

			
		<?php
	
		while ( $the_query->have_posts() ): $the_query->the_post();

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
			
			
			<div <?php post_class('row'); ?> <?php echo fave_get_item_scope(); ?>>
				
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="col-lg-6 col-md-6 col-sm-5 col-xs-5">
					<div class="featured-image-wrap">
						<?php get_template_part( 'inc/article', 'icon' ); ?>
						
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<img itemprop="image" class="featured-image" width="<?php echo $img_width; ?>" height="<?php echo $img_height; ?>" src="<?php echo fave_featured_image( get_the_ID(), $img_width, $img_height, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</a>
						
					</div><!-- featured-image-wrap -->
				</div><!-- col-lg-6 col-md-6 col-sm-5 col-xs-5 -->
				<?php } ?>

				<div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
					<article>
						<div class="category-label-wrap">
							<div class="category-label"><?php echo $cats_html; ?></div>
						</div><!-- category-label-wrap -->
						
						<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->

						<div class="post-content post-small-content"  itemprop="articleBody"><p><?php echo fave_clean_excerpt( $excerpt_limit, $read_more ); ?></p></div><!-- post-content -->

					</article><!-- .module-6-post -->
				</div><!-- col-lg-6 col-md-6 col-sm-7 col-xs-7 -->
			</div><!-- .row -->

		
		<?php endwhile; ?>
			
	</div><!-- .module-6 -->
    

	<?php 
	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('fav-module-6', 'fav_module_6');
?>