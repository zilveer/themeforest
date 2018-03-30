<?php
/*-----------------------------------------------------------------------------------*/
/*	Module 4
/*-----------------------------------------------------------------------------------*/

function fav_module_4( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'module_4_type'		=> '',

		'category_id_1'		=> '',
		'category_ids_1'	=> '',
		'tag_slug_1'		=> '',
		'sort_1'			=> '',
		'autors_id_1'		=> '',
		'hide_title_1'		=> '',
		'offset_1'			=> '',
		'header_color_1'	=> '',
		'header_text_color_1'	=> '',
		'header_border_color_1'	=> '',
		'custom_title_1'	=> '',
		'custom_url_1'		=> '',
		'title_style_1'		=> '',

		'category_id_2'		=> '',
		'category_ids_2'	=> '',
		'tag_slug_2'		=> '',
		'sort_2'			=> '',
		'autors_id_2'		=> '',
		'hide_title_2'		=> '',
		'offset_2'			=> '',
		'header_color_2'	=> '',
		'header_text_color_2'	=> '',
		'header_border_color_2'	=> '',
		'custom_title_2'	=> '',
		'custom_url_2'		=> '',
		'title_style_2'		=> '',

		'category_id_3'		=> '',
		'category_ids_3'	=> '',
		'tag_slug_3'		=> '',
		'sort_3'			=> '',
		'autors_id_3'		=> '',
		'hide_title_3'		=> '',
		'offset_3'			=> '',
		'header_color_3'	=> '',
		'header_text_color_3'	=> '',
		'header_border_color_3'	=> '',
		'custom_title_3'	=> '',
		'custom_url_3'		=> '',
		'title_style_3'		=> '',

		'posts_limit'	  	=> '',
		'module_excerpt'	=> '',
		'excerpt_limit'	  	=> '',
		'read_more' 		=> '',
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

	$count = $count_2 = $count_3 = 0;

    //do the query
    $the_query_one = fave_data_source::get_wp_query_columns($atts, 'columns_one' ); //by ref  do the query

    $the_query_two = fave_data_source::get_wp_query_columns($atts, 'columns_two' ); //by ref  do the query

    if( $module_4_type == 'three_columns' ) {
    	$the_query_three = fave_data_source::get_wp_query_columns($atts, 'columns_three' ); //by ref  do the query
    	$css_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

    	$columns_class = "module-4-three-cols";

	} elseif ( $module_4_type == 'one_columns' ) {
	    $css_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
	    $columns_class = "module-4-one-col";
    } else {
		$css_classes = "col-lg-6 col-md-6 col-sm-6 col-xs-6";
		$columns_class = "module-4-two-cols";
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

	<div class="module module-4 <?php echo $columns_class; ?>" <?php echo $style; ?>>


		<div class="row">


			<div class="<?php echo $css_classes; ?>">

				<?php if ( $hide_title_1 != 'hide_title' ) : ?>
				<div class="module-top clearfix">

					<?php echo fave_get_block_title_column_one( $atts ); ?>

				</div><!-- .module-top -->
				<?php endif; ?>

				<?php while ( $the_query_one->have_posts() ): $the_query_one->the_post(); $count++;

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
					<?php if( $count == 1 ): ?>

					<?php if ( has_post_thumbnail() ) { ?>
					<div class="featured-image-wrap">
						<?php get_template_part( 'inc/article', 'icon' ); ?>

						<div class="category-label"><?php echo $cats_html; ?></div>

						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<img itemprop="image" class="featured-image" width="370" height="277" src="<?php echo fave_featured_image( get_the_ID(), 370, 277, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</a>
					</div><!-- featured-image-wrap -->
					<?php } ?>

					<article <?php post_class('post'); ?> <?php echo fave_get_item_scope(); ?>>
						<h2 itemprop="headline" class="post-title module-big-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->

						<?php if( $module_excerpt != 'hide_excerpt' ): ?>
						<div class="post-content post-small-content" itemprop="articleBody">
							<p><?php echo fave_clean_excerpt( $excerpt_limit, $read_more ); ?></p>
						</div><!-- post-content -->
						<meta content="<?php echo fave_featured_image( get_the_ID(), 120, 120, true, true, true ); ?>" itemprop="image">
						<?php endif; ?>

					</article><!-- .post -->

					<?php else: ?>

					<article <?php post_class('post'); ?> <?php echo fave_get_item_scope(); ?>>
						<div class="category-label-wrap">
							<div class="category-label"><?php echo $cats_html; ?></div>
						</div><!-- category-label-wrap -->
						<h2 itemprop="headline" class="post-title module-small-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->
						<meta content="<?php echo fave_featured_image( get_the_ID(), 120, 120, true, true, true ); ?>" itemprop="image">
					</article><!-- .module-4-post -->

					<?php endif; ?>

				<?php endwhile; wp_reset_postdata(); ?>

			</div><!-- col-lg-6 col-md-6 col-sm-6 col-xs-6 -->

			<?php if( $module_4_type == "two_columns" || $module_4_type == "three_columns" ): ?>
			<div class="<?php echo $css_classes; ?>">

				<?php if ( $hide_title_2 != 'hide_title' ) : ?>
				<div class="module-top clearfix">

					<?php echo fave_get_block_title_column_two( $atts ); ?>

				</div><!-- .module-top -->
				<?php endif; ?>

				<?php while ( $the_query_two->have_posts() ): $the_query_two->the_post(); $count_2++;

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
					<?php if( $count_2 == 1 ): ?>

					<?php if ( has_post_thumbnail() ) { ?>
					<div class="featured-image-wrap">
						<?php get_template_part( 'inc/article', 'icon' ); ?>

						<div class="category-label"><?php echo $cats_html; ?></div>

						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<img itemprop="image" class="featured-image"  width="370" height="277" src="<?php echo fave_featured_image( get_the_ID(), 370, 277, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</a>
					</div><!-- featured-image-wrap -->
					<?php } ?>

					<article <?php post_class('post'); ?> <?php echo fave_get_item_scope(); ?>>
						<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->

						<?php if( $module_excerpt != 'hide_excerpt' ): ?>
						<div class="post-content post-small-content" itemprop="articleBody">
							<p><?php echo fave_clean_excerpt( $excerpt_limit, $read_more ); ?></p>
						</div><!-- post-content -->
							<meta content="<?php echo fave_featured_image( get_the_ID(), 120, 120, true, true, true ); ?>" itemprop="image">
						<?php endif; ?>

					</article><!-- .post -->

					<?php else: ?>

					<article <?php post_class('post'); ?> <?php echo fave_get_item_scope(); ?>>
						<div class="category-label-wrap">
							<div class="category-label"><?php echo $cats_html; ?></div>
						</div><!-- category-label-wrap -->
						<h2 itemprop="headline" class="post-title module-small-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->
						<meta content="<?php echo fave_featured_image( get_the_ID(), 120, 120, true, true, true ); ?>" itemprop="image">
					</article><!-- .module-4-post -->

					<?php endif; ?>

				<?php endwhile; wp_reset_postdata(); ?>

			</div><!-- col-lg-6 col-md-6 col-sm-6 col-xs-6 -->
			<?php endif; ?>

			<?php if( $module_4_type == "three_columns" ): ?>

				<div class="<?php echo $css_classes; ?>">

				<?php if ( $hide_title_3 != 'hide_title' ) : ?>
				<div class="module-top clearfix">

					<?php echo fave_get_block_title_column_three( $atts ); ?>

				</div><!-- .module-top -->
				<?php endif; ?>

				<?php while ( $the_query_three->have_posts() ): $the_query_three->the_post(); $count_3++;

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
					<?php if( $count_3 == 1 ): ?>

					<?php if ( has_post_thumbnail() ) { ?>
					<div class="featured-image-wrap">
						<?php get_template_part( 'inc/article', 'icon' ); ?>

						<div class="category-label"><?php echo $cats_html; ?></div>

						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<img itemprop="image" class="featured-image" width="370" height="277" src="<?php echo fave_featured_image( get_the_ID(), 370, 277, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</a>
					</div><!-- featured-image-wrap -->
					<?php } ?>

					<article <?php post_class('post'); ?> <?php echo fave_get_item_scope(); ?>>
						<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->

						<?php if( $module_excerpt != 'hide_excerpt' ): ?>
						<div class="post-content post-small-content" itemprop="articleBody">
							<p><?php echo fave_clean_excerpt( $excerpt_limit, $read_more ); ?></p>
						</div><!-- post-content -->
							<meta content="<?php echo fave_featured_image( get_the_ID(), 120, 120, true, true, true ); ?>" itemprop="image">
						<?php endif; ?>

					</article><!-- .post -->

					<?php else: ?>

					<article <?php post_class('post'); ?> <?php echo fave_get_item_scope(); ?>>
						<div class="category-label-wrap">
							<div class="category-label"><?php echo $cats_html; ?></div>
						</div><!-- category-label-wrap -->
						<h2 itemprop="headline" class="post-title module-small-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->
						<meta content="<?php echo fave_featured_image( get_the_ID(), 120, 120, true, true, true ); ?>" itemprop="image">
					</article><!-- .module-4-post -->

					<?php endif; ?>

				<?php endwhile; wp_reset_postdata(); ?>
				</div>

			<?php endif; // End three columns if ?>


	    </div><!-- row -->
	</div><!-- .module-4 -->

	<?php
	$result = ob_get_contents();
	ob_end_clean();
	return $result;

	}

add_shortcode('fav-module-4', 'fav_module_4');
?>