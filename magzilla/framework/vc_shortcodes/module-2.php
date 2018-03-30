<?php
/*-----------------------------------------------------------------------------------*/
/*	Module 2
/*-----------------------------------------------------------------------------------*/

function fav_module_2( $atts, $content = null )
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
	

	<div class="module-2 module" <?php echo $style; ?>>
		
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
			<div <?php post_class('row'); ?> <?php echo fave_get_item_scope(); ?>>
				
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
					<div class="featured-image-wrap">
						
						<?php get_template_part( 'inc/article', 'icon' ); ?>

						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<img itemprop="image" class="featured-image" width="437" height="327" src="<?php echo fave_featured_image( get_the_ID(), 437, 327, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</a>

					</div><!-- featured-image-wrap -->
				</div><!-- col-lg-7 col-md-7 col-sm-12 col-xs-12 -->
				<?php } ?>

				<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
					<article class="post">
						
						<div class="category-label-wrap">
							<div class="category-label"><?php echo $cats_html; ?></div>
						</div><!-- category-label-wrap -->		
						
						<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->

						<div class="post-content" itemprop="articleBody"><p><?php echo fave_clean_excerpt( $excerpt_limit, $read_more ); ?></p></div><!-- post-content -->

					</article><!-- .module-2-post -->
				</div><!-- col-lg-4 col-md-4 col-sm-12 col-xs-12 -->
			</div><!-- .row -->
			
			<?php
			
			if ($count == 1 ) {
				break;
			}

		endwhile;
		?>
		

			
		<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
		
		<?php
		$categories = get_the_category( get_the_ID() );
		$cats_html_2 = '';
		if($categories) {
			foreach($categories as $category) {
				$cat_id = $category->cat_ID;
				$cat_link = get_category_link( $cat_id );
				
				$cats_html_2 .= '<a href="'.esc_url($cat_link).'" class="cat-color-'.$cat_id.'">'.esc_html($category->name).'</a>';
			}
		}

		?>

			<div <?php post_class('row'); ?> <?php echo fave_get_item_scope(); ?>>
				
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4">
					<div class="featured-image-wrap">

						<?php get_template_part( 'inc/article', 'icon' ); ?>

						<a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>">
							<img itemprop="image" class="featured-image" width="303" height="227" src="<?php echo fave_featured_image( get_the_ID(), 303, 227, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</a>
						
					</div><!-- featured-image-wrap -->
				</div><!-- col-lg-5 col-md-5 col-sm-12 col-xs-12 -->
				<?php } ?>

				<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8">
					<article class="post">
						
						<div class="category-label-wrap">
							<div class="category-label"><?php echo $cats_html_2; ?></div>
						</div><!-- category-label-wrap -->
						
						<h2 itemprop="headline" class="post-title module-small-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->
						
						<div class="post-content" itemprop="articleBody"><p><?php echo fave_clean_excerpt( $excerpt_limit, $read_more ); ?></p></div><!-- post-content -->

					</article><!-- .module-2-post -->
				</div><!-- col-lg-7 col-md-7 col-sm-12 col-xs-12 -->
			</div><!-- .row -->

		<?php endwhile; ?>
		
		<?php
		/* Restore original Post Data */
		wp_reset_postdata();
		?>

	</div><!-- .module-2 -->
    

	<?php 
	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('fav-module-2', 'fav_module_2');
?>