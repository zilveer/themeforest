<?php
/*-----------------------------------------------------------------------------------*/
/*	Magzilla Grids
/*-----------------------------------------------------------------------------------*/

function fav_grids( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'grid_type'	=> '',
		'post_from'     => '',
		'category_id'	=> '',
		'category_ids'	=> '',
		'hide_meta'	=> '',
		'hide_cat'		=> '',
		'sort'			=> '',
		'posts_limit'	=> '',
		'module_meta'   => '',
		'author_name'   => '',
		'time_diff'     => '',
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
        ?>

       

<?php if( $grid_type == "grid_1" ) { ?>

<div class="grid-banner magzilla-grid-1" <?php echo $style; ?>>
		
		<div class="row row-no-padding">

		<?php $i = 0; ?>
		<?php while ( $the_query->have_posts() ): $the_query->the_post();
			
			$i++;
			if( $i == 1 || $i == 6 ){
				$grid_classes = "col-lg-6 col-md-6 col-sm-6 col-xs-12 grid-1-big";
				$img_width = '585'; $img_height = '285';
				if( has_post_thumbnail() ): 
					$featured_image = fave_featured_image( get_the_ID(), 585, 285, true, true, true );
				else: 
					$featured_image = 'http://placehold.it/585x284';
				endif;

			}else{
				$grid_classes = "col-lg-3 col-md-3 col-sm-3 col-xs-6 grid-1-small";
				$img_width = '290'; $img_height = '285';
				if( has_post_thumbnail() ): 
					$featured_image = fave_featured_image( get_the_ID(), 290, 285, true, true, true );
				else: 
					$featured_image = 'http://placehold.it/293x285';
				endif;
			}
			
			if( $i == 6 ){ $i = 0; }
			?> 	
			<div class="<?php echo esc_attr( $grid_classes ); ?>">
				
				<div <?php post_class('thumb'); ?> <?php echo fave_get_item_scope(); ?>>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
					<div class="thumb-content">
						<?php if( $hide_cat != 'no' ): ?>
							<div class="category-label">
								<?php get_template_part( 'inc/post', 'cats' ); ?>
							</div>
						<?php endif; ?>
						<h2 itemprop="headline" class="gallery-title-small"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						
						<?php if( $hide_meta != 'no' ): ?>
						<ul class="list-inline post-meta">
							<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
						</ul><!-- .post-meta -->
						<?php endif; ?>

					</div>
					<?php if ( has_post_thumbnail() ) { ?>
					<div class="slide-image-wrap">
						<?php get_template_part( 'inc/article', 'icon' ); ?>
						
						<img itemprop="image" class="featured-image lazyOwl" width="<?php echo $img_width; ?>" height="<?php echo $img_height; ?>" data-src="<?php echo $featured_image; ?>" src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>">
						
					</div><!-- slide-image-wrap -->
					<?php } ?>

				</div>
			</div>
			

		<?php endwhile; ?>

		<?php
		/* Restore original Post Data */
		wp_reset_postdata();
		?>
	</div>
</div>

<?php } elseif ( $grid_type == "grid_2" ) { ?>

		<div class="grid-banner magzilla-grid-2" <?php echo $style; ?>>
		
				<div class="row row-no-padding">

				<?php $i = 0; ?>
				<?php while ( $the_query->have_posts() ): $the_query->the_post();  

					$i++;
					if( $i == 1 || $i == 2 ){
						$grid_classes = "col-lg-6 col-md-6 col-sm-12 col-xs-12 grid-2-big";
						$img_width = '585'; $img_height = '285';
						if( has_post_thumbnail() ): 
							$featured_image = fave_featured_image( get_the_ID(), 585, 285, true, true, true );
						else: 
							$featured_image = 'http://placehold.it/720x350';
						endif;

					}else{
						$grid_classes = "col-lg-3 col-md-3 col-sm-6 col-xs-12 grid-2-small";
						$img_width = '293'; $img_height = '285';
						if( has_post_thumbnail() ): 
							$featured_image = fave_featured_image( get_the_ID(), 293, 285, true, true, true );
						else: 
							$featured_image = 'http://placehold.it/450x438';
						endif;
					}
					
					if( $i == 6 ){ $i = 0; }
					?> 	
					<div class="<?php echo esc_attr( $grid_classes ); ?>">
						
						<div <?php post_class('thumb'); ?> <?php echo fave_get_item_scope(); ?>>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
							<div class="thumb-content">
								<?php if( $hide_cat != 'no' ): ?>
									<div class="category-label">
										<?php get_template_part( 'inc/post', 'cats' ); ?>
									</div>
								<?php endif; ?>
								<h2 itemprop="headline" class="gallery-title-small"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
								<?php if( $hide_meta != 'no' ): ?>
								<ul class="list-inline post-meta">
									<?php fave_vc_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
								</ul><!-- .post-meta -->
								<?php endif; ?>
								
							</div>
							<?php if ( has_post_thumbnail() ) { ?>
							<div class="slide-image-wrap">
								<?php get_template_part( 'inc/article', 'icon' ); ?>
								
								<img itemprop="image" class="featured-image lazyOwl" width="<?php echo $img_width; ?>" height="<?php echo $img_height; ?>" data-src="<?php echo $featured_image; ?>" src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>">
								
							</div><!-- slide-image-wrap -->
							<?php } ?>

						</div>
					</div>
					

				<?php endwhile; ?>

				<?php
				/* Restore original Post Data */
				wp_reset_postdata();
				?>
			</div>
		</div>

<?php } ?>

<?php 
$result = ob_get_contents();  
ob_end_clean();
return $result;

}

add_shortcode('fav-post-grids', 'fav_grids');
?>