<?php
/**
 *
 */
class mysitePortfolio {
	
	private static $carousel_id = 1;
	
	/**
	 *
	 */
	function portfolio_grid( $atts ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Portfolio Grid', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'portfolio_grid',
				'options' => array(
					array(
						'name' => __( 'Number of Columns', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of columns you would like your posts to display in.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'column',
						'default' => '',
						'options' => array(
							'1' => __('One Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'2' => __('Two Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'3' => __('Three Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'4' => __('Four Column', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Number of Portfolio Posts', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you would like to display on each page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'default' => '',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Portfolio Categories <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select which portfolio categories you would like to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cat',
						'default' => array(),
						'target' => 'portfolio_category',
						'type' => 'multidropdown'
					),
					array(
						'name' => __( 'Offset Portfolio Posts <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple portfolio shortcodes on the same page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'default' => '',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Fancy Layout <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => sprintf( __( '%1$s comes with an additional fancy portfolio layout.', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ),
						'id' => 'fancy_layout',
						'options' => array(
							'true' => __( 'Enable Fancy Layout', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'default' => '',
						'type' => ( defined( 'FANCY_PORTFOLIO' ) ? 'checkbox' : '' )
					),
					array(
						'name' => __( 'Disable Portfolio Elements <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __( 'Disable Post Image', MYSITE_ADMIN_TEXTDOMAIN ),
							'title' => __( 'Disable Post Title', MYSITE_ADMIN_TEXTDOMAIN ),
							'excerpt' => __( 'Disable Post Excerpt', MYSITE_ADMIN_TEXTDOMAIN ),
							'date' => __( 'Disable Date', MYSITE_ADMIN_TEXTDOMAIN ),
							'more' => __( 'Disable Read More', MYSITE_ADMIN_TEXTDOMAIN ),
							'visit' => __( 'Disable Visit Site', MYSITE_ADMIN_TEXTDOMAIN ),
							'pagination' => __( 'Disable Pagination', MYSITE_ADMIN_TEXTDOMAIN )
							
						),
						'default' => '',
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'column' 	=> '4',
			'showposts'	=> '8',
			'cat' 		=> '',
			'offset' 	=> '',
			'disable'	=> ''
		), $atts));
		
		$out = '';
		
		$portfolio_query = new WP_Query();
		
		global $post, $wp_rewrite, $wp_query, $mysite;
		
		$column = trim( $column );
		$showposts = trim( $showposts );
		$cat = trim( $cat );
		$offset = trim( $offset );
		
		if( is_front_page() ) {
			$_layout = mysite_get_setting( 'homepage_layout' );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} else {
			$post_obj = $wp_query->get_queried_object();
			$dependencies = get_post_meta( $post_obj->ID, '_dependencies', true );
			$dependencies = ( empty( $dependencies ) ) ? get_post_meta( $post_obj->ID, '_' . THEME_SLUG .'_dependencies', true ) : $dependencies;
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$_layout = ( empty( $_layout ) ? 'full_width' : $_layout );
			$images = ( ( strpos( $dependencies, 'fancy_portfolio' ) !== false || apply_atomic( 'fancy_portfolio', false ) == true ) && ( !isset( $mysite->responsive ) ) ? 'additional_images'
			: ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) ) );
		}
		
		$paged = mysite_get_page_query();
		
		$gallery_post = $post->post_name;
		
		if( $post->post_parent) {
			$parent_query = get_post( $post->post_parent );	 
		 	$gallery_parent = $parent_query->ID;
		}
		
		if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
			$mysite->offset = $offset;
			$mysite->posts_per_page = $showposts;
			add_filter('post_limits', 'my_post_limit');
		}
		
		if( strpos( $disable, 'pagination' ) === false ) {
			
			if( !empty( $cat ) )
			{
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'tax_query' => array(
						'relation' => 'IN',
						array(
							'taxonomy' => 'portfolio_category',
							'field' => 'slug',
							'terms' => explode(',', $cat)
						)
					),
					'offset' => $offset,
					'paged' => $paged,
				));

			}
			else
			{
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'offset' => $offset,
					'paged' => $paged,
				));
			}
			
		} else {
			
			if( !empty( $cat ) )
			{
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'tax_query' => array(
						'relation' => 'IN',
						array(
							'taxonomy' => 'portfolio_category',
							'field' => 'slug',
							'terms' => explode(',', $cat)
						)
					),
					'offset' => $offset,
					'nopaging' => 0,
				));

			}
			else
			{
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'offset' => $offset,
					'nopaging' => 0,
				));
			}
			
		}
			
					
		if( $portfolio_query->have_posts() ) :
		
		$img_sizes = $mysite->layout[$images];
		$img_group = 'portfolio_img_group_' . rand(1,1000);
		$width = '';
		$height = '';
		switch( $column ) {
			case 1:
				$main_class = 'post_grid one_column_portfolio';
				$width = $img_sizes['one_column_portfolio'][0];
				$height = $img_sizes['one_column_portfolio'][1];
				break;
			case 2:
				$main_class = 'post_grid two_column_portfolio';
				$column_class = 'one_half';
				$width = $img_sizes['two_column_portfolio'][0];
				$height = $img_sizes['two_column_portfolio'][1];
				break;
			case 3:
				$main_class = 'post_grid three_column_portfolio';
				$column_class = 'one_third';
				$width = $img_sizes['three_column_portfolio'][0];
				$height = $img_sizes['three_column_portfolio'][1];
				break;
			case 4:
				$main_class = 'post_grid four_column_portfolio';
				$column_class = 'one_fourth';
				$width = $img_sizes['four_column_portfolio'][0];
				$height = $img_sizes['four_column_portfolio'][1];
				break;
		}
		
		$out .= '<div class="' .  $main_class . '">';
		
		$i = 1;
		while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
		
		$id = get_the_ID();
		$image_id = get_post_thumbnail_id();
		
		$custom_fields = get_post_custom( $id );
		foreach( $custom_fields as $key => $value ) {
			${$key}[$id] = $value[0];
			
			if( is_serialized( ${$key}[$id] ) )
				${$key}[$id] = unserialize( ${$key}[$id] );
		}
		
		if ( has_post_thumbnail() || !empty( $_image[$id] ) || !empty( $_featured_video[$id] ) ) {
			
			if( has_post_thumbnail() ) :
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full', true );
			else :
				$img[0] = ( !empty( $_image[$id] ) ) ? $_image[$id] : '';
			endif;
			
			if( $wp_rewrite->using_permalinks() ) :
				$url = ( empty( $_custom_link[$id] ) ) ? home_url( '/' ) . 'portfolio/' . $post->post_name . '/gallery/' . $gallery_post . '/' : $_custom_link[$id];
			else :
				$url = htmlspecialchars( esc_url( add_query_arg( array( 'gallery' => $gallery_post ), get_permalink( $id )) ) );
			endif;
			
			$link_to = ( empty( $_post[$id][0] )
			? ( empty( $_featured_video[$id] )
			? ( empty( $_image[$id] )
			? $img[0]
			: $_image[$id] )
			: $_featured_video[$id] )
			: $url
			);
						
			$out .= ( $column != 1 ? '<div class="' . ( $i%$column == 0 ? $column_class . ' last' : $column_class ) . '">' : '' );

			$out .= '<div class="' .  join( ' ', get_post_class( 'post_grid_module', get_the_ID() ) ) . '">';
			
			if( strpos( $disable, 'image' ) === false ) {
				$offset = $mysite->layout['images']['image_padding'];
				$load_width = $width + $offset;
				$load_height = $height + $offset;
				
				$out .= '<div class="post_grid_image" style="width:' . $load_width . 'px;">';
				
				ob_start(); mysite_portfolio_image_begin();
				$out .= ob_get_clean();
				
				if( empty( $img[0] ) && !empty( $_featured_video[$id] ) )
					$video_check = mysite_video( $args = array( 'url' => $_featured_video[$id], 'parse' => true, 'width' => $width, 'height' => $height ) );
				else
					$video_check = false;
					
				if( !empty( $video_check ) )
				{
					$out .= $video_check;
				}
				else
				{
					$image_tags = mysite_post_image_tags( $image_id, $id );
					$out .= mysite_display_image( array(
									'src' => $img[0], 
									'alt' => $image_tags['alt'],
									'title' => $image_tags['title'],
									'height' => $height,
									'width' => $width,
									'class' => 'hover_fade_js',
									'link_to' => $link_to,
									'link_class' => 'portfolio_img_load',
									'prettyphoto' => ( empty( $_post[$id][0] ) ? true : false ),
									'group' => $img_group,
									'preload' => ( isset( $mysite->mobile ) ? false : true ),
								) );
				}
							
				ob_start(); 
				mysite_portfolio_image_end(array(
					'column' => $column,
					'disable' => $disable,
					'more' => ( !empty( $_more[$id][0] ) ? $_more[$id][0] : '' ),
					'link' => ( !empty( $_link[$id] ) ? $_link[$id] : '' ),
					'url' => $url,
					'date' => ( !empty( $_date[$id] ) ?  $_date[$id] : '' )
				));
				$out .= ob_get_clean();

				$out .= '</div>';
			}
			
			$out .= '<div class="post_grid_content">';
			
			$out .= apply_filters( 'mysite_portfolio_date_top', '', array( 'column' => $column, 'date' => ( !empty(  $_date[$id] ) ?  $_date[$id] : '' ), 'disable' => $disable ) );
			
			if( strpos( $disable, 'title' ) === false ) {
				$title = ( empty( $_more[$id][0] ) ) ? '<a href="' . esc_url( $url ) . '">' . get_the_title( $id ) . '</a>' : get_the_title( $id );
				
				if( $column == 1 || $column == 2 )
					$out .= '<h2 class="post_title">' . $title . '</h2>';
				else
					$out .= '<h3 class="post_title">' . $title . '</h3>';
			}
			
			if( ( !empty( $_date[$id] ) ) && ( strpos( $disable, 'date' ) === false ) )
				$out .= apply_filters( 'mysite_portfolio_date', '<p class="date">' . $_date[$id] . '</p>', array( 'column' => $column ) );
			
			
			if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) || !empty( $_teaser[$id] ) ) {
				$out .= '<div class="post_excerpt">';
				
				$out .= ( ( !empty( $_teaser[$id] ) ) && ( strpos( $disable, 'excerpt' ) === false ) ) ? '<p class="portfolio_excerpt">' . do_shortcode( $_teaser[$id] ) . '</p>' : '';
				
				if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) ) {
					$out .= '<p>';
					
					if( ( empty( $_more[$id][0] ) ) && ( strpos( $disable, 'more' ) === false ) ) {
						$read_more = '<a href="' . esc_url( $url )  . '" class="post_more_link portfolio_more">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a>&nbsp;&nbsp;';
						$out .= apply_filters( 'mysite_portfolio_read_more', $read_more, esc_url( $url ) );
					}
					
					if( ( !empty( $_link[$id] ) ) && ( strpos( $disable, 'visit' ) === false ) ) {
						$visit_site = '<a href="' . esc_url( $_link[$id] )  . '" class="post_more_link portfolio_link">' . __( 'Visit Site', MYSITE_TEXTDOMAIN ) . '</a>';
						$out .= apply_filters( 'mysite_portfolio_visit_site', $visit_site, esc_url( $_link[$id] ) );
					}
					
					$out .= '</p>';
				}
				
				$out .= '</div>';
			}
				
			$out .= '</div>';
						
			$out .= '</div>';
			
			$out .= ( $column != 1 ? '</div>' : '' );
			
			if( ( $i % $column ) == 0 )
				$out .= '<div class="clearboth"></div>';
			
			$i++;
		}
		
		endwhile;
		
		$out .= '</div>';
		
		$out .= ( strpos( $disable, 'pagination' ) === false ) ? mysite_pagenavi( '', '', $portfolio_query ) : '';
		
		else :
		
			$out .= __( 'No portfolio posts were found for the category selected.', MYSITE_TEXTDOMAIN );
		
		endif;
		
		if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
			remove_filter('post_limits', 'my_post_limit');
		}
		
		wp_reset_query();
		
		return $out;
	}
	
	/**
	 *
	 */
	function portfolio_list( $atts ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Portfolio List', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'portfolio_list',
				'options' => array(
					array(
						'name' => __( 'Select Thumbnail Size', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the size of thumbnails that you wish to have displayed.<br /><br />This is a thumbnail of the "Featured Image" in each of your posts.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'thumb',
						'default' => '',
						'options' => array(
							'small' => __( 'Small', MYSITE_ADMIN_TEXTDOMAIN ),
							'medium' => __( 'Medium', MYSITE_ADMIN_TEXTDOMAIN ),
							'large' => __('Large',  MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Number of Portfolio Posts', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you would like to display on each page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'default' => '',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Portfolio Categories <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select which portfolio categories you would like to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cat',
						'default' => array(),
						'target' => 'portfolio_category',
						'type' => 'multidropdown'
					),
					array(
						'name' => __( 'Offset Portfolio Posts <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple portfolio shortcodes on the same page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'default' => '',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Disable Portfolio Elements <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __( 'Disable Post Image', MYSITE_ADMIN_TEXTDOMAIN ),
							'title' => __( 'Disable Post Title', MYSITE_ADMIN_TEXTDOMAIN ),
							'excerpt' => __( 'Disable Post Excerpt', MYSITE_ADMIN_TEXTDOMAIN ),
							'date' => __( 'Disable Date', MYSITE_ADMIN_TEXTDOMAIN ),
							'more' => __( 'Disable Read More', MYSITE_ADMIN_TEXTDOMAIN ),
							'visit' => __( 'Disable Visit Site', MYSITE_ADMIN_TEXTDOMAIN ),
							'pagination' => __( 'Disable Pagination', MYSITE_ADMIN_TEXTDOMAIN )
							
						),
						'default' => '',
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'thumb' 	=> 'large',
			'showposts'	=> '3',
			'cat' 		=> '',
			'offset' 	=> '',
			'disable'	=> ''
		), $atts));
		
		$out = '';
		
		$portfolio_query = new WP_Query();
		
		global $post, $wp_rewrite, $wp_query, $mysite;
		
		$thumb = trim( $thumb );
		$showposts = trim( $showposts );
		$cat = trim( $cat );
		$offset = trim( $offset );
		
		if( is_front_page() ) {
			$_layout = mysite_get_setting( 'homepage_layout' );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} else {
			$post_obj = $wp_query->get_queried_object();
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$_layout = ( empty( $_layout ) ? 'full_width' : $_layout );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		}
		
		$paged = mysite_get_page_query();
		
		$gallery_post = $post->post_name;
		
		if( $post->post_parent) {
			$parent_query = get_post( $post->post_parent );	 
		 	$gallery_parent = $parent_query->ID;
		}
		
		if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
			$mysite->offset = $offset;
			$mysite->posts_per_page = $showposts;
			add_filter('post_limits', 'my_post_limit');
		}
		
		if( strpos( $disable, 'pagination' ) === false ) {

			if( !empty( $cat ) )
			{
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'tax_query' => array(
						'relation' => 'IN',
						array(
							'taxonomy' => 'portfolio_category',
							'field' => 'slug',
							'terms' => explode(',', $cat)
						)
					),
					'offset' => $offset,
					'paged' => $paged,
				));

			}
			else
			{
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'offset' => $offset,
					'paged' => $paged,
				));
			}

		} else {

			if( !empty( $cat ) )
			{
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'tax_query' => array(
						'relation' => 'IN',
						array(
							'taxonomy' => 'portfolio_category',
							'field' => 'slug',
							'terms' => explode(',', $cat)
						)
					),
					'offset' => $offset,
					'nopaging' => 0,
				));

			}
			else
			{
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'offset' => $offset,
					'nopaging' => 0,
				));
			}

		}
			
		
		if( $portfolio_query->have_posts() ) :
		
		$img_sizes = $mysite->layout[$images];
		$img_group = 'portfolio_img_group_' . rand(1,1000);
		
		$width = '';
		$height = '';
		
		switch( $thumb ) {
			case 'small':
				$main_class = 'post_list small_post_list';
				$width = $img_sizes['small_post_list'][0];
				$height = $img_sizes['small_post_list'][1];
				break;
			case 'medium':
				$main_class = 'post_list medium_post_list';
				$width = $img_sizes['medium_post_list'][0];
				$height = $img_sizes['medium_post_list'][1];
				break;
			case 'large':
				$main_class = 'post_list large_post_list';
				$width = $img_sizes['large_post_list'][0];
				$height = $img_sizes['large_post_list'][1];
				break;
		}
		
		$out .= '<ul class="portfolio_gallery ' .  $main_class . '">';
		
		$i = 1;
		while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
		
		$id = get_the_ID();
		$image_id = get_post_thumbnail_id();
		
		$custom_fields = get_post_custom( $id );
		foreach( $custom_fields as $key => $value ) {
			${$key}[$id] = $value[0];
			
			if( is_serialized( ${$key}[$id] ) )
				${$key}[$id] = unserialize( ${$key}[$id] );
		}
		
		if ( has_post_thumbnail() || !empty( $_image[$id] ) || !empty( $_featured_video[$id] ) ) {
			
			if( has_post_thumbnail() ) :
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full', true );
			else :
				$img[0] = ( !empty( $_image[$id] ) ) ? $_image[$id] : '';
			endif;
			
			if( $wp_rewrite->using_permalinks() ) :
				$url = ( empty( $_custom_link[$id] ) ) ? home_url( '/' ) . 'portfolio/' . $post->post_name . '/gallery/' . $gallery_post . '/' : $_custom_link[$id];
			else :
				$url = htmlspecialchars( esc_url( add_query_arg( array( 'gallery' => $gallery_post ), get_permalink( $id )) ) );
			endif;
			
			$link_to = ( empty( $_post[$id][0] )
			? ( empty( $_featured_video[$id] )
			? ( empty( $_image[$id] )
			? $img[0]
			: $_image[$id] )
			: $_featured_video[$id] )
			: $url
			);
			
			$out .= '<li class="' . join( ' ', get_post_class( 'post_list_module', get_the_ID() ) ) . '">';
			
			if( strpos( $disable, 'image' ) === false ) {
				$offset = $mysite->layout['images']['image_padding'];
				$load_width = $width + $offset;
				$load_height = $height + $offset;
				
				$out .= '<div class="post_list_image" style="width:' . $load_width . 'px;">';
				
				if( $thumb != 'small' ) {
					ob_start(); mysite_portfolio_image_begin();
					$out .= ob_get_clean();
				}
				
				if( empty( $img[0] ) && !empty( $_featured_video[$id] ) )
					$video_check = mysite_video( $args = array( 'url' => $_featured_video[$id], 'parse' => true, 'width' => $width, 'height' => $height ) );
				else
					$video_check = false;

				if( !empty( $video_check ) )
				{
					$out .= $video_check;
				}
				else
				{
					$image_tags = mysite_post_image_tags( $image_id, $id );
					$out .= mysite_display_image( array(
									'src' => $img[0], 
									'alt' => $image_tags['alt'],
									'title' => $image_tags['title'],
									'height' => $height,
									'width' => $width,
									'class' => 'hover_fade_js',
									'link_to' => $link_to,
									'link_class' => 'portfolio_img_load',
									'prettyphoto' => ( empty( $_post[$id][0] ) ? true : false ),
									'group' => $img_group,
									'preload' => ( isset( $mysite->mobile ) ? false : true ),
								) );
				}
				
				if( $thumb != 'small' ) {
					ob_start();
					mysite_portfolio_image_end(array(
						'thumb' => $thumb,
						'disable' => $disable,
						'more' => ( !empty( $_more[$id][0] ) ? $_more[$id][0] : '' ),
						'link' => ( !empty( $_link[$id] ) ? $_link[$id] : '' ),
						'url' => $url,
						'date' => ( !empty( $_date[$id] ) ?  $_date[$id] : '' )
					));
					$out .= ob_get_clean();
				}

				$out .= '</div>';
			}
			
			$out .= '<div class="post_list_content">';
			
			$out .= apply_filters( 'mysite_portfolio_date_top', '', array( 'thumb' => $thumb, 'date' => ( !empty(  $_date[$id] ) ? $_date[$id] : '' ), 'disable' => $disable ) );
			
			if( strpos( $disable, 'title' ) === false ) {
				$title = ( empty( $_more[$id][0] ) ) ? '<a href="' . esc_url( $url ) . '">' . get_the_title( $id ) . '</a>' : get_the_title( $id );
				
				if( $thumb == 'small' )
					$out .= '<p class="post_title">' . $title . '</p>';
				else
					$out .= '<h2 class="post_title">' . $title . '</h2>';
			}
			
			if( ( !empty( $_date[$id] ) ) && ( strpos( $disable, 'date' ) === false ) )
				$out .= apply_filters( 'mysite_portfolio_date', '<p class="date">' . $_date[$id] . '</p>', array( 'thumb' => $thumb ) );
			
			
			if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) || !empty( $_teaser[$id] ) ) {
				$out .= '<div class="post_excerpt">';
				
				$out .= ( ( !empty( $_teaser[$id] ) ) && ( strpos( $disable, 'excerpt' ) === false ) ) ? '<p>' . do_shortcode( $_teaser[$id] ) . '</p>' : '';
				
				if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) ) {
					$out .= '<p>';
					
					if( ( empty( $_more[$id][0] ) ) && ( strpos( $disable, 'more' ) === false ) ) {
						$read_more = '<a href="' . esc_url( $url )  . '" class="post_more_link">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a>&nbsp;&nbsp;';
						$out .= apply_filters( 'mysite_portfolio_read_more', $read_more, esc_url( $url ) );
					}
					
					if( ( !empty( $_link[$id] ) ) && ( strpos( $disable, 'visit' ) === false ) ) {
						$visit_site = '<a href="' . esc_url( $_link[$id] )  . '" class="post_more_link">' . __( 'Visit Site', MYSITE_TEXTDOMAIN ) . '</a>';
						$out .= apply_filters( 'mysite_portfolio_visit_site', $visit_site, esc_url( $_link[$id] ) );
					}
					
					$out .= '</p>';
				}
				
				$out .= '</div>';
			}
				
			$out .= '</div>';
						
			$out .= '</li>';
		}
		
		endwhile;
		
		$out .= '</ul>';
		
		$out .= ( strpos( $disable, 'pagination' ) === false ) ? mysite_pagenavi( '', '', $portfolio_query ) : '';
		
		else :
		
			$out .= __( 'No portfolio posts were found for the category selected.', MYSITE_TEXTDOMAIN );
		
		endif;
		
		if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
			remove_filter('post_limits', 'my_post_limit');
		}
		
		wp_reset_query();
		
		return $out;
	}
	
	/**
	 *
	 */
	function _carousel_id() {
	    return self::$carousel_id++;
	}
	
	/**
	 *
	 */
	function jcarousel_portfolio( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'jCarousel Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'jcarousel_portfolio',
				'options' => array(
					array(
						'name' => __( 'Number of Columns', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of columns you would like your posts to display in.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'column',
						'default' => '',
						'options' => array(
							'1' => __('One Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'2' => __('Two Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'3' => __('Three Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'4' => __('Four Column', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Number of Portfolio Posts', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you would like to display on each page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'default' => '',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Portfolio Categories <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select which portfolio categories you would like to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cat',
						'default' => array(),
						'target' => 'portfolio_category',
						'type' => 'multidropdown'
					),
					array(
						'name' => __( 'Offset Portfolio Posts <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple portfolio shortcodes on the same page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'default' => '',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Scrolling Range', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select how many posts you wish to cycle when scrolling.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'scroll',
						'default' => '',
						'options' => array_combine(range(1,4), array_values(range(1,4))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Animation speed', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Type out how fast you want the animation to display.  The value is defined in milliseconds so 1000 equals 1 second.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'animation',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Automatic sliding', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many seconds you want to pass before the carousel cycles automatically.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'auto',
						'options' => array_combine(range(1,20), array_values(range(1,20))),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Ending Wrap', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select the behaviour for when the end of the carousel is reached.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'wrap',
						'options' => array(
							'first' => __('First', MYSITE_ADMIN_TEXTDOMAIN ),
							'last' => __('Last', MYSITE_ADMIN_TEXTDOMAIN ),
							'both' => __('Both', MYSITE_ADMIN_TEXTDOMAIN ),
							'circular' => __('Circular', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Description Content', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'The content you enter here will be displayed to the left of your carousel.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'teaser',
						'type' => 'textarea',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Disable Portfolio Elements <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __( 'Disable Post Image', MYSITE_ADMIN_TEXTDOMAIN ),
							'title' => __( 'Disable Post Title', MYSITE_ADMIN_TEXTDOMAIN ),
							'excerpt' => __( 'Disable Post Excerpt', MYSITE_ADMIN_TEXTDOMAIN ),
							'date' => __( 'Disable Date', MYSITE_ADMIN_TEXTDOMAIN ),
							'more' => __( 'Disable Read More', MYSITE_ADMIN_TEXTDOMAIN ),
							'visit' => __( 'Disable Visit Site', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'default' => '',
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'teaser'	=> '',
			'column' 	=> '4',
			'showposts'	=> '8',
			'cat' 		=> '',
			'offset' 	=> '',
			'disable'	=> '',
			'scroll' 	=> '1',
			'animation' => 500,
			'auto' 		=> 0,
			'wrap' 		=> null,
		), $atts));
		
		global $post, $wp_rewrite, $wp_query, $mysite;
		
		$mobile_disable_shortcodes = mysite_get_setting( 'mobile_disable_shortcodes' );
		if( isset( $mysite->mobile ) && is_array( $mobile_disable_shortcodes ) && in_array( 'tooltips', $mobile_disable_shortcodes ) )
			return;
		
		$out = '';
		
		$portfolio_query = new WP_Query();
		
		$wrap = trim( $wrap );
		$teaser = trim( $teaser );
		$column = trim( $column );
		$showposts = trim( $showposts );
		$cat = trim( $cat );
		$offset = trim( $offset );
		$gallery_post = $post->post_name;
		
		if( is_front_page() ) {
			$_layout = mysite_get_setting( 'homepage_layout' );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} else {
			$post_obj = $wp_query->get_queried_object();
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		}
		
		if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
			$mysite->offset = $offset;
			$mysite->posts_per_page = $showposts;
			add_filter('post_limits', 'my_post_limit');
		}
		
		if( !empty( $cat ) )
		{
			$portfolio_query->query(array(
				'post_type' => 'portfolio',
				'posts_per_page' => $showposts,
				'tax_query' => array(
					'relation' => 'IN',
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'slug',
						'terms' => explode(',', $cat)
					)
				),
				'offset' => $offset,
				'nopaging' => 0,
			));
			
		}
		else
		{
			$portfolio_query->query(array(
				'post_type' => 'portfolio',
				'posts_per_page' => $showposts,
				'offset' => $offset,
				'nopaging' => 0,
			));
		}
		
		if( $portfolio_query->have_posts() ) :
		
		$img_sizes = $mysite->layout[$images];
		$carousel_id = 'mysite_jcarousel_' . self::_carousel_id();
		$img_group = 'portfolio_img_group_' . rand( 1,1000 );
		$width = '';
		$height = '';
		switch( $column ) {
			case 1:
				$main_class = 'mysite_jcarousel_portfolio one_column_portfolio';
				$width = $img_sizes['one_column_portfolio'][0];
				$height = $img_sizes['one_column_portfolio'][1];
				break;
			case 2:
				$main_class = 'mysite_jcarousel_portfolio two_column_portfolio';
				$width = $img_sizes['two_column_portfolio'][0];
				$height = $img_sizes['two_column_portfolio'][1];
				break;
			case 3:
				$main_class = 'mysite_jcarousel_portfolio three_column_portfolio';
				$width = $img_sizes['three_column_portfolio'][0];
				$height = $img_sizes['three_column_portfolio'][1];
				break;
			case 4:
				$main_class = 'mysite_jcarousel_portfolio four_column_portfolio';
				$width = $img_sizes['four_column_portfolio'][0];
				$height = $img_sizes['four_column_portfolio'][1];
				break;
		}
		
		# Variable calculations
		$column_margin_percent = ( isset( $mysite->layout['images']['column_margin'] ) ) ? $mysite->layout['images']['column_margin'] : 4;
		$image_padding = $mysite->layout['images']['image_padding'];
		$content_area_width = $img_sizes['one_column_portfolio'][0] + $image_padding;
		$space = ( $content_area_width * $column_margin_percent ) / 100;
		$wrapper_width = round( ( ( $width + $space + $image_padding ) * $column ) );
		$text_width = $img_sizes['four_column_portfolio'][0] + $image_padding + $space;
		$nav_position = ( $height / 2 ) - 15;
		$fallback_width = $width + $image_padding;
		
		$out = '<div class="' . $main_class . ( !empty( $teaser ) ? ' has_jcarousel_text' : ' no_jcarousel_text' ) . ' noscript">';
		
		# Build the jCarousel
		$out .= '<script type="text/javascript">';
		$out .= 'jQuery(document).ready(function() {';
		$out .= 'jQuery("#'.$carousel_id.'").jcarousel({';
		# Setup options
		$out .= 'visible: ' . $column . ',';
		$out .= 'scroll: ' . $scroll . ',';
		$out .= 'animation: ' . $animation . ',';
		$out .= 'auto: ' . $auto . ',';
		$out .= 'wrap: "' . $wrap . '",';
		$out .= 'itemFallbackDimension: "' . $fallback_width . '",';
		$out .= 'buttonNextHTML: null, buttonPrevHTML: null,'; 
		$out .= 'initCallback: '.$carousel_id.'_callback,';
		$out .= 'setupCallback: mysite_jcarousel_setup,';
		$out .= 'buttonNextCallback: '.$carousel_id.'_next_event,';
		
		if( $wrap != 'first' && $wrap !='circular' && $wrap != 'both' )
			$out .= 'buttonPrevCallback: '.$carousel_id.'_prev_event,';

		$out .= '});';
		$out .= '});';
		
		# Add disabled class to next button
		$out .= 'function '.$carousel_id.'_next_event(c) {';
		$out .= 'if( c.buttonNextState === true ) { jQuery("#'.$carousel_id.'_next").addClass("jcarousel_next_disabled"); }';
		$out .= 'if( c.buttonNextState === false ){ jQuery("#'.$carousel_id.'_next").removeClass("jcarousel_next_disabled"); }';
		$out .= '}';
		
		# Add disabled class to prev button
		$out .= 'function '.$carousel_id.'_prev_event(c) {';
		$out .= 'if( c.buttonPrevState === true || c.buttonPrevState === null ) { jQuery("#'.$carousel_id.'_prev").addClass("jcarousel_prev_disabled"); }';
		$out .= 'if( c.buttonPrevState === false ){ jQuery("#'.$carousel_id.'_prev").removeClass("jcarousel_prev_disabled"); }';
		$out .= '}';
		
		# Setup our custom next prev buttons
		$out .= 'function '.$carousel_id.'_callback(c) {';
		$out .= 'jQuery("#'.$carousel_id.'_next").live("click", function(){ c.next(); Cufon.refresh(); return false; });';
		$out .= 'jQuery("#'.$carousel_id.'_prev").live("click", function(){ c.prev(); Cufon.refresh(); return false; });';
		$out .= '}';
		
		$out .= '</script>';
		
		# Check if description is set
		if( !empty( $teaser ) ) {
			# Setup description dimensions
			$wrapper_width = $wrapper_width - $text_width;

			# Decrease width of images to fit inside
			$old_width = $width;
			$old_height = $height;
			$width = round( ( ( $wrapper_width - ( $space * $column ) ) / $column ) - $image_padding );
			$height = round( $old_height * ( $width/$old_width ) );
			
			$out .= '<div class="mysite_jcarousel_text">' . $teaser;
			$out .= '<div class = "clearboth"></div>';
			$out .= '<div class="mysite_jcarousel_nav"><span id = "' . $carousel_id . '_prev" class="mysite_jcarousel_prev"></span><span id="' . $carousel_id . '_next" class="mysite_jcarousel_next"></span></div>';
			$out .= '</div>';
		}
		else
		{
			# If description is empty just display jcarousel navagation
			$out .= '<div class="mysite_jcarousel_nav" style="top:' . $nav_position . 'px;">';
			$out .= '<span id="' . $carousel_id . '_prev" class="mysite_jcarousel_prev"></span><span id="' . $carousel_id . '_next" class="mysite_jcarousel_next"></span>';
			$out .= '</div>';
		}
		
		# Start displaying the jCarousel HTML and slides
		$out .= '<div class="portfolio_clip">';
		$out .= '<div id="' . $carousel_id . '_wrapper" class="jcarousel_wrapper jcarousel_grid" style="width: ' . $wrapper_width . 'px; height: auto;">';
		$out .= '<ul id="' . $carousel_id . '" class="jcarousel-skin-mysite">';
		
		while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
		
		# Start building slide
		$out .= '<li style="width: ' . $width . ';margin-right:' . $space . 'px;">';
		
		$out .= '<div class="' .  join( ' ', get_post_class( 'post_grid_module', get_the_ID() ) ) . '">';
		
		$id = get_the_ID();
		$image_id = get_post_thumbnail_id();

		$custom_fields = get_post_custom( $id );
		foreach( $custom_fields as $key => $value ) {
			${$key}[$id] = $value[0];

			if( is_serialized( ${$key}[$id] ) )
				${$key}[$id] = unserialize( ${$key}[$id] );
		}

		if ( has_post_thumbnail() || !empty( $_image[$id] ) || !empty( $_featured_video[$id] ) ) {
			
			if( has_post_thumbnail() ) :
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full', true );
			else :
				$img[0] = ( !empty( $_image[$id] ) ) ? $_image[$id] : '';
			endif;

			if( $wp_rewrite->using_permalinks() ) :
				$url = ( empty( $_custom_link[$id] ) ) ? home_url( '/' ) . 'portfolio/' . $post->post_name . '/gallery/' . $gallery_post . '/' : $_custom_link[$id];
			else :
				$url = htmlspecialchars( esc_url( add_query_arg( array( 'gallery' => $gallery_post ), get_permalink( $id )) ) );
			endif;

			$link_to = ( empty( $_post[$id][0] )
			? ( empty( $_featured_video[$id] )
			? ( empty( $_image[$id] )
			? $img[0]
			: $_image[$id] )
			: $_featured_video[$id] )
			: $url
			);

			if( strpos( $disable, 'image' ) === false ) {
				$offset = $mysite->layout['images']['image_padding'];
				$load_width = $width + $offset;
				$load_height = $height + $offset;

				$out .= '<div class="post_grid_image" style="width:' . $load_width . 'px;">';

				ob_start(); mysite_portfolio_image_begin();
				$out .= ob_get_clean();

				if( empty( $img[0] ) && !empty( $_featured_video[$id] ) )
					$video_check = mysite_video( $args = array( 'url' => $_featured_video[$id], 'parse' => true, 'width' => $width, 'height' => $height ) );
				else
					$video_check = false;

				if( !empty( $video_check ) )
				{
					$out .= $video_check;
				}
				else
				{
					$image_tags = mysite_post_image_tags( $image_id, $id );
					$out .= mysite_display_image( array(
									'src' => $img[0], 
									'alt' => $image_tags['alt'],
									'title' => $image_tags['title'],
									'height' => $height,
									'width' => $width,
									'class' => 'hover_fade_js',
									'link_to' => $link_to,
									'link_class' => 'portfolio_img_load',
									'prettyphoto' => ( empty( $_post[$id][0] ) ? true : false ),
									'group' => $img_group,
									'preload' => false
								) );
				}

				ob_start(); 
				mysite_portfolio_image_end(array(
					'column' => $column,
					'disable' => $disable,
					'more' => ( !empty( $_more[$id][0] ) ? $_more[$id][0] : '' ),
					'link' => ( !empty( $_link[$id] ) ? $_link[$id] : '' ),
					'url' => $url,
					'date' => ( !empty( $_date[$id] ) ?  $_date[$id] : '' )
				));
				$out .= ob_get_clean();

				$out .= '</div>';
			}
		}
		
		$out .= '<div class="post_grid_content">';

		$out .= apply_filters( 'mysite_portfolio_date_top', '', array( 'column' => $column, 'date' => ( !empty(  $_date[$id] ) ?  $_date[$id] : '' ), 'disable' => $disable ) );

		if( strpos( $disable, 'title' ) === false ) {
			$title = ( empty( $_more[$id][0] ) ) ? '<a href="' . esc_url( $url ) . '">' . get_the_title( $id ) . '</a>' : get_the_title( $id );

			if( $column == 1 || $column == 2 )
				$out .= '<h2 class="post_title">' . $title . '</h2>';
			else
				$out .= '<h3 class="post_title">' . $title . '</h3>';
		}

		if( ( !empty( $_date[$id] ) ) && ( strpos( $disable, 'date' ) === false ) )
			$out .= apply_filters( 'mysite_portfolio_date', '<p class="date">' . $_date[$id] . '</p>', array( 'column' => $column ) );


		if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) || !empty( $_teaser[$id] ) ) {
			$out .= '<div class="post_excerpt">';

			$out .= ( ( !empty( $_teaser[$id] ) ) && ( strpos( $disable, 'excerpt' ) === false ) ) ? '<p class="portfolio_excerpt">' . do_shortcode( $_teaser[$id] ) . '</p>' : '';

			if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) ) {
				$out .= '<p>';

				if( ( empty( $_more[$id][0] ) ) && ( strpos( $disable, 'more' ) === false ) ) {
					$read_more = '<a href="' . esc_url( $url )  . '" class="post_more_link portfolio_more">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a>&nbsp;&nbsp;';
					$out .= apply_filters( 'mysite_portfolio_read_more', $read_more, esc_url( $url ) );
				}

				if( ( !empty( $_link[$id] ) ) && ( strpos( $disable, 'visit' ) === false ) ) {
					$visit_site = '<a href="' . esc_url( $_link[$id] )  . '" class="post_more_link portfolio_link">' . __( 'Visit Site', MYSITE_TEXTDOMAIN ) . '</a>';
					$out .= apply_filters( 'mysite_portfolio_visit_site', $visit_site, esc_url( $_link[$id] ) );
				}

				$out .= '</p>';
			}

			$out .= '</div>';
		}
		
		$out .= '</div>';
		
		$out .= '</div>';
		
		# Ending slide
		$out .= '</li>';
		
		endwhile;
		
		# Ending jCarousel HTML
		$out .= '</ul>';
		$out .= '</div><div class = "clearboth"></div></div>';
		
		$out .= '</div>';
		
		else :
		
			$out .= __( 'No portfolio posts were found for the category selected.', MYSITE_TEXTDOMAIN );
		
		endif;
		
		if( is_numeric( $offset ) )
			remove_filter('post_limits', 'my_post_limit');
		
		wp_reset_query();
		
		return $out;
	}
	
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();

		$class_methods = get_class_methods( $class );

		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}

		$options = array(
			'name' => __( 'Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of portfolio you wish to use.<br /><br />The grid will display posts in a column layout while the list will display your posts from top to bottom.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'portfolio',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);

		return $options;
	}

}

?>