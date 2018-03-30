<?php
/**
 *
 */
class mysiteBlog {
	
	private static $carousel_id = 1;

	/**
	 *
	 */
	function blog_grid( $atts, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Blog Grid Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'blog_grid',
				'options' => array(
					array(
						'name' => __( 'Number of Columns', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of columns you wish to have your posts displayed in.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'column',
						'options' => array(
							'1' => __('One Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'2' => __('Two Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'3' => __('Three Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'4' => __('Four Column', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Number of Posts', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to have displayed on each page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Offset Posts <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple blog shortcodes on the same page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Post Content <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can choose to have the post excerpt displayed or the full content of your post including shortcodes.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'post_content',
						'options' => array(
							'excerpt' => __('Excerpt', MYSITE_ADMIN_TEXTDOMAIN ),
							'full' => __('Full Post', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __('Blog Categories <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you want posts from specific categories to display then you may choose them here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'category_in',
						'default' => array(),
						'target' => 'cat',
						'type' => 'multidropdown'
					),
					array(
						'name' => __('Show Post Pagination <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will show pagination at the bottom so the reader can go to the next page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'pagination',
						'options' => array('true' => 'Show Post Pagination'),
						'type' => 'checkbox'
					),
					array(
						'name' => __('Disable Post Elements <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __('Disable Post Image', MYSITE_ADMIN_TEXTDOMAIN ),
							'title' => __('Disable Post Title', MYSITE_ADMIN_TEXTDOMAIN ),
							'content' => __('Disable Post Content', MYSITE_ADMIN_TEXTDOMAIN ),
							'meta' => __('Disable Post Meta', MYSITE_ADMIN_TEXTDOMAIN ),
							'more' => __('Disable Read More', MYSITE_ADMIN_TEXTDOMAIN )
							
						),
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		$defaults = array(
			'column' 		=> '',
			'showposts'		=> '',
			'offset' 		=> '',
			'post_content'	=> '',
			'categories' 	=> '',
			'pagination' 	=> '',
			'disable' 		=> '',
			'post_in'		=> '',
			'category_in'	=> '',
			'tag_in'		=> ''
		);
		
		$atts = shortcode_atts( $defaults, $atts );
		
		$args = array( 'type' => $code, 'atts' => $atts );
		
		return self::_blog_shortcode( $args );
	}
	
	/**
	 *
	 */
	function blog_list($atts, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __('Blog List Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'blog_list',
				'options' => array(
					array(
						'name' => __('Select Thumbnail Size', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( "Select the size of thumbnails that you wish to have displayed.<br /><br />This is a thumbnail of the 'Featured Image' in each of your posts.", MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'thumb',
						'default' => '',
						'options' => array(
							'small' => __('Small', MYSITE_ADMIN_TEXTDOMAIN ),
							'medium' => __('Medium', MYSITE_ADMIN_TEXTDOMAIN ),
							'large' => __('Large', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __('Number of Posts', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to have displayed on each page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'default' => '',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select'
					),
					array(
						'name' => __('Offset Posts <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple blog shortcodes on the same page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'default' => '',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select'
					),
					array(
						'name' => __('Post Content <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can choose to have the post excerpt displayed or the full content of your post including shortcodes.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'post_content',
						'default' => '',
						'options' => array(
							'excerpt' => __('Excerpt', MYSITE_ADMIN_TEXTDOMAIN ),
							'full' => __('Full Post', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __('Blog Categories <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you want posts from specific categories to display then you may choose them here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'category_in',
						'default' => array(),
						'target' => 'cat',
						'type' => 'multidropdown'
					),
					array(
						'name' => __('Show Post Pagination <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will show pagination at the bottom so the reader can go to the next page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'pagination',
						'options' => array('true' => __('Show Post Pagination', MYSITE_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Disable Post Elements <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __( 'Disable Post Image', MYSITE_ADMIN_TEXTDOMAIN ),
							'title' => __( 'Disable Post Title', MYSITE_ADMIN_TEXTDOMAIN ),
							'content' => __( 'Disable Post Content', MYSITE_ADMIN_TEXTDOMAIN ),
							'meta' => __( 'Disable Post Meta', MYSITE_ADMIN_TEXTDOMAIN ),
							'more' => __( 'Disable Read More', MYSITE_ADMIN_TEXTDOMAIN )
							
						),
						'default' => '',
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		$defaults = array(
			'thumb' 		=> '',
			'showposts'		=> '',
			'offset' 		=> '',
			'post_content'	=> '',
			'categories' 	=> '',
			'pagination' 	=> '',
			'disable' 		=> '',
			'post_in'		=> '',
			'category_in'	=> '',
			'tag_in'		=> ''
		);
		
		$atts = shortcode_atts( $defaults, $atts );
		
		$args = array( 'type' => $code, 'atts' => $atts );
		
		return self::_blog_shortcode( $args );
	}
	
	function _blog_shortcode( $args = array() ) {
		global $post, $wp_rewrite, $wp_query, $mysite;

		extract( $args['atts'] );

		$out = '';

		$showposts = trim( $showposts );
		$column = ( !empty( $column ) ) ? trim( $column ) : '3';
		$thumb = ( !empty( $thumb ) ) ? trim( $thumb ) : 'medium';
		$offset = ( isset( $offset ) ) ? trim( $offset ) : '';
		$post_in = ( !empty($post_in) ) ? explode(",", trim( $post_in )) : '';
		$category_in = ( !empty($category_in) ) ? explode(",", trim( $category_in )) : '';
		$tag_in = ( !empty($tag_in) ) ? explode(",", trim( $tag_in )) : '';

		if( is_front_page() ) {
			$_layout = mysite_get_setting( 'homepage_layout' );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} else {
			$post_obj = $wp_query->get_queried_object();
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$template = get_post_meta( $post_obj->ID, '_wp_page_template', true );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' || $template == 'template-featuretour.php' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		}
		
		$post_img = '';

		$blog_query = new WP_Query();

		if( trim( $pagination ) == 'true' ) {
			
			if( is_numeric( $offset ) ) {
				$mysite->offset = $offset;
				$mysite->posts_per_page = $showposts;
				add_filter('post_limits', 'my_post_limit');
			}
			
			$paged = mysite_get_page_query();
			$blog_query->query(array(
				'post__in' => $post_in,
				'category__in' => $category_in,
				'tag__in' => $tag_in,
				'post_type' => 'post',
				'posts_per_page' => $showposts,
				'paged' => $paged,
				'offset' => $offset,
				'ignore_sticky_posts' => 1
			));

		} else {

			$blog_query->query(array(
				'post__in' => $post_in,
				'category__in' => $category_in,
				'tag__in' => $tag_in,
				'post_type' => 'post',
				'showposts' => $showposts,
				'nopaging' => 0,
				'offset' => $offset,
				'ignore_sticky_posts' => 1
			));
		}

		if( $blog_query->have_posts() ) :

		$img_sizes = $mysite->layout[$images];
		$width = '';
		$height = '';

		if( $args['type'] == 'blog_grid' ) {
			switch( $column ) {
				case 1:
					$main_class = 'post_grid one_column_blog';
					$post_class = 'post_grid_module';
					$content_class = 'post_grid_content';
					$img_class = 'post_grid_image';
					$excerpt_lenth = 400;
					$width = $img_sizes['one_column_blog'][0];
					$height = $img_sizes['one_column_blog'][1];
					break;
				case 2:
					$main_class = 'post_grid two_column_blog';
					$post_class = 'post_grid_module';
					$content_class = 'post_grid_content';
					$img_class = 'post_grid_image';
					$column_class = 'one_half';
					$excerpt_lenth = 150;
					$width = $img_sizes['two_column_blog'][0];
					$height = $img_sizes['two_column_blog'][1];
					break;
				case 3:
					$main_class = 'post_grid three_column_blog';
					$post_class = 'post_grid_module';
					$content_class = 'post_grid_content';
					$img_class = 'post_grid_image';
					$column_class = 'one_third';
					$excerpt_lenth = 75;
					$width = $img_sizes['three_column_blog'][0];
					$height = $img_sizes['three_column_blog'][1];
					break;
				case 4:
					$main_class = 'post_grid four_column_blog';
					$post_class = 'post_grid_module';
					$content_class = 'post_grid_content';
					$img_class = 'post_grid_image';
					$column_class = 'one_fourth';
					$excerpt_lenth = 50;
					$width = $img_sizes['four_column_blog'][0];
					$height = $img_sizes['four_column_blog'][1];
					break;
			}

		} else {

			if( $args['type'] == 'blog_list' ) {
				switch( $thumb ) {
					case 'small':
						$main_class = 'post_list small_post_list';
						$post_class = 'post_list_module';
						$content_class = 'post_list_content';
						$img_class = 'post_list_image';
						$excerpt_lenth = 180;
						$width = $img_sizes['small_post_list'][0];
						$height = $img_sizes['small_post_list'][1];
						break;
					case 'medium':
						$main_class = 'post_list medium_post_list';
						$post_class = 'post_list_module';
						$content_class = 'post_list_content';
						$img_class = 'post_list_image';
						$excerpt_lenth = 180;
						$width = $img_sizes['medium_post_list'][0];
						$height = $img_sizes['medium_post_list'][1];
						break;
					case 'large':
						$main_class = 'post_list large_post_list';
						$post_class = 'post_list_module';
						$content_class = 'post_list_content';
						$img_class = 'post_list_image';
						$excerpt_lenth = 180;
						$width = $img_sizes['large_post_list'][0];
						$height = $img_sizes['large_post_list'][1];
						break;
				}
			}
		}
		
		$filter_args = array( 'width' => $width, 'height' => $height, 'img_class' => $img_class, 'link_class' => 'blog_sc_image_load', 'preload' => ( isset( $mysite->mobile ) ? false : true ), 'post_content' => $post_content, 'disable' => $disable, 'column' => $column, 'thumb' => $thumb, 'type' => $args['type'], 'shortcode' => true, 'echo' => false );

		$out .= ( $args['type'] == 'blog_grid' ) ? '<div class="' .  $main_class . '">' : '<ul class="' . $main_class . '">';

		$i=1;
		while( $blog_query->have_posts() ) : $blog_query->the_post();
		
		$post_id = get_the_ID();
		
		$video = get_post_meta( $post_id, '_featured_video', true);
		
		if ( !empty( $video ) )
			$filter_args = array_merge( array( 'video' => $video ), $filter_args );
			
		$out .= ( $args['type'] == 'blog_list' ? '' : ( $column != 1 ? '<div class="' . ( $i%$column == 0 ? $column_class . ' last' : $column_class ) . '">' : '' ) );

		$out .= ( $args['type'] == 'blog_grid' ) ? '<div class="' . join( ' ', get_post_class( $post_class, $post_id ) ) . '">' : '<li class="' . join( ' ', get_post_class( $post_class, $post_id ) ) . '">';
		
		$out .= mysite_before_post_sc( $filter_args );

		$out .= '<div class="' . $content_class . '">';
		
		$out .= mysite_before_entry_sc( $filter_args );
		
		$out .= '<div class="post_excerpt">';
		if( strpos( $disable, 'content' ) === false ) {
			ob_start();
			mysite_post_content( $filter_args );
			$out .= ob_get_clean();
		}
		$out .= '</div>';
		
		$out .= mysite_after_entry_sc( $filter_args );

		$out .= '</div>';

		$out .= ( $args['type'] == 'blog_grid' ) ? '</div>' : '</li>';

		$out .= ( $args['type'] == 'blog_list' ? '' : ( $column != 1 ? '</div>' : '' ) );

		if( $args['type'] == 'blog_grid' ) {
			if( ( $i % $column ) == 0 )
				$out .= '<div class="clearboth"></div>';
		}

		$i++;

		endwhile;

		$out .= ( $args['type'] == 'blog_grid' ) ? '</div>' : '</ul>';

		if( $pagination == 'true' ) {
			$out .= mysite_pagenavi( '', '', $blog_query );
		}

		endif;
		
		if( ( is_numeric( $offset ) ) && ( trim( $pagination ) == 'true' ) )
			remove_filter('post_limits', 'my_post_limit');

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
	function jcarousel_blog( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'jCarousel Blog', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'jcarousel_blog',
				'options' => array(
					array(
						'name' => __( 'Number of Columns', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of columns you wish to have your posts displayed in.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'column',
						'options' => array(
							'1' => __('One Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'2' => __('Two Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'3' => __('Three Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'4' => __('Four Column', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Number of Posts', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to have displayed on each page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Offset Posts <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple blog shortcodes on the same page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Post Content <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can choose to have the post excerpt displayed or the full content of your post including shortcodes.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'post_content',
						'options' => array(
							'excerpt' => __('Excerpt', MYSITE_ADMIN_TEXTDOMAIN ),
							'full' => __('Full Post', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __('Blog Categories <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you want posts from specific categories to display then you may choose them here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'category_in',
						'default' => array(),
						'target' => 'cat',
						'type' => 'multidropdown'
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
						'name' => __('Disable Post Elements <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __('Disable Post Image', MYSITE_ADMIN_TEXTDOMAIN ),
							'title' => __('Disable Post Title', MYSITE_ADMIN_TEXTDOMAIN ),
							'content' => __('Disable Post Content', MYSITE_ADMIN_TEXTDOMAIN ),
							'meta' => __('Disable Post Meta', MYSITE_ADMIN_TEXTDOMAIN ),
							'more' => __('Disable Read More', MYSITE_ADMIN_TEXTDOMAIN )
							
						),
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'teaser'		=> '',
			'column' 		=> '',
			'showposts'		=> '',
			'offset' 		=> '',
			'post_content'	=> '',
			'categories' 	=> '',
			'disable' 		=> '',
			'post_in'		=> '',
			'category_in'	=> '',
			'tag_in'		=> '',
			'scroll' 		=> '1',
			'animation' 	=> 500,
			'auto' 			=> 0,
			'wrap' 			=> null,
		), $atts));
		
		global $post, $wp_rewrite, $wp_query, $mysite;
		
		$mobile_disable_shortcodes = mysite_get_setting( 'mobile_disable_shortcodes' );
		if( isset( $mysite->mobile ) && is_array( $mobile_disable_shortcodes ) && in_array( 'tooltips', $mobile_disable_shortcodes ) )
			return;
		
		$out = '';
		
		$showposts = trim( $showposts );
		$wrap = trim( $wrap );
		$teaser = trim( $teaser );
		$column = ( !empty( $column ) ) ? trim( $column ) : '3';
		$thumb = ( !empty( $thumb ) ) ? trim( $thumb ) : 'medium';
		$offset = ( isset( $offset ) ) ? trim( $offset ) : '';
		$post_in = ( !empty($post_in) ) ? explode(",", trim( $post_in )) : '';
		$category_in = ( !empty($category_in) ) ? explode(",", trim( $category_in )) : '';
		$tag_in = ( !empty($tag_in) ) ? explode(",", trim( $tag_in )) : '';
		
		if( is_front_page() ) {
			$_layout = mysite_get_setting( 'homepage_layout' );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} else {
			$post_obj = $wp_query->get_queried_object();
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$template = get_post_meta( $post_obj->ID, '_wp_page_template', true );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' || $template == 'template-featuretour.php' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		}
		
		$blog_query = new WP_Query();

		$blog_query->query(array(
			'post__in' => $post_in,
			'category__in' => $category_in,
			'tag__in' => $tag_in,
			'post_type' => 'post',
			'showposts' => $showposts,
			'nopaging' => 0,
			'offset' => $offset,
			'ignore_sticky_posts' => 1
		));

		if( $blog_query->have_posts() ) :

		$img_sizes = $mysite->layout[$images];
		$carousel_id = 'mysite_blog_jcarousel_' . self::_carousel_id();
		$width = '';
		$height = '';		

		switch( $column ) {
			case 1:
				$main_class = 'mysite_jcarousel_blog post_grid one_column_blog';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'post_grid_image';
				$excerpt_lenth = 400;
				$width = $img_sizes['one_column_blog'][0];
				$height = $img_sizes['one_column_blog'][1];
				break;
			case 2:
				$main_class = 'mysite_jcarousel_blog post_grid two_column_blog';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'post_grid_image';
				$column_class = 'one_half';
				$excerpt_lenth = 150;
				$width = $img_sizes['two_column_blog'][0];
				$height = $img_sizes['two_column_blog'][1];
				break;
			case 3:
				$main_class = 'mysite_jcarousel_blog post_grid three_column_blog';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'post_grid_image';
				$column_class = 'one_third';
				$excerpt_lenth = 75;
				$width = $img_sizes['three_column_blog'][0];
				$height = $img_sizes['three_column_blog'][1];
				break;
			case 4:
				$main_class = 'mysite_jcarousel_blog post_grid four_column_blog';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'post_grid_image';
				$column_class = 'one_fourth';
				$excerpt_lenth = 50;
				$width = $img_sizes['four_column_blog'][0];
				$height = $img_sizes['four_column_blog'][1];
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
		$out .= 'setupCallback: '.$carousel_id.'_setup,';
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
		
		# Show after jcarousel is completely setup
		$out .= 'function '.$carousel_id.'_setup(c) {';
		$out .= "c.clip.parent().parent().parent().parent().parent().removeClass('noscript');";
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
		
		
		$filter_args = array( 'width' => $width, 'height' => $height, 'img_class' => $img_class, 'link_class' => 'blog_sc_image_load', 'preload' => false, 'post_content' => $post_content, 'disable' => $disable, 'column' => $column, 'thumb' => $thumb, 'type' => 'blog_grid', 'shortcode' => true, 'echo' => false );

		$i=1;
		while( $blog_query->have_posts() ) : $blog_query->the_post();

		# Start building slide
		$out .= '<li style="width: ' . $width . ';margin-right:' . $space . 'px;">';
		
		$out .= '<div class="' . join( ' ', get_post_class( $post_class, get_the_ID() ) ) . '">';
		
		$out .= mysite_before_post_sc( $filter_args );

		$out .= '<div class="' . $content_class . '">';
		
		$out .= mysite_before_entry_sc( $filter_args );
		
		$out .= '<div class="post_excerpt">';
		if( strpos( $disable, 'content' ) === false ) {
			ob_start();
			mysite_post_content( $filter_args );
			$out .= ob_get_clean();
		}
		$out .= '</div>';
		
		$out .= mysite_after_entry_sc( $filter_args );

		$out .= '</div>';

		$out .= '</div>';

		$i++;

		// Ending slide
		$out .= '</li>';
		
		endwhile;
		
		# Ending jCarousel HTML
		$out .= '</ul>';
		$out .= '</div><div class = "clearboth"></div></div>';
		
		$out .= '</div>';
		
		else :
		
			$out .= __( 'No blog posts were found for the category selected.', MYSITE_TEXTDOMAIN );
		
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
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __('Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of blog you wish to use.<br /><br />The grid will display posts in a column layout while the list will display your posts from top to bottom.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'blog',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>