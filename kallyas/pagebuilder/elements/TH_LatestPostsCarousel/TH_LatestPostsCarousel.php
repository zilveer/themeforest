<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Latest Posts Carousel
 Description: Display latest post from specific categories in a carousel layout.
 Class: TH_LatestPostsCarousel
 Category: content
 Level: 3
 Scripts: true
 Keywords: blog, news, article
*/

/**
 * Class TH_LatestPostsCarousel
 *
 * Create and display a Latest Posts Carousel element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_LatestPostsCarousel extends ZnElements
{
	public static function getName(){
		return __( "Latest Posts Carousel", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		global $post;

		$options = $this->data['options'];

		$numPosts   = isset( $options['lpc_num_posts'] ) ? $options['lpc_num_posts'] : 10; // how many posts
		$categories = isset( $options['lpc_categories'] ) ? $options['lpc_categories'] : get_option('default_category');
		$title = isset( $options['lpc_title'] ) ? $options['lpc_title'] : __('Latest Posts', 'zn_framework');

		// Configure the query
		$queryArgs = array(
			'post_type'      => 'post',
			'posts_per_page' => $numPosts,
			'category__in' => $categories
		);

		// @since v4.1.6
		// Exclude the current viewed post from the query
		if(is_single() && ('post' == get_post_type())){
			$queryArgs['post__not_in'] = array( get_the_ID() );
		}

		$theQuery = new WP_Query($queryArgs);

		if ( $theQuery->have_posts() )
		{
			?>
				<div class="latest-posts-carousel latest-posts-crs <?php echo $this->data['uid']; ?> <?php echo zn_get_element_classes($options); ?>" <?php echo zn_get_element_attributes($options); ?>>
					<div class="row">
						<div class="col-sm-12">
							<div class="controls latest-posts-crs-controls">
								<a href="#" class="prev latest-posts-crs-arr" style="display: inline;"><span class="glyphicon glyphicon-chevron-left"></span></a>
								<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) );?>" class="latest-posts-crs-arr complete"><span class="glyphicon glyphicon-th"></span></a>
								<a href="#" class="next latest-posts-crs-arr" style="display: inline;"><span class="glyphicon glyphicon-chevron-right"></span></a>
							</div>
							<h3 class="m_title m_title_ext text-custom latest-posts-crs-elmtitle" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><?php echo $title;?></h3>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="posts-carousel latest-posts-crs-list-wrapper">
								<ul class="lp_carousel latest-posts-crs-list clearfix">
									<?php
										// Start the loop
										while ( $theQuery->have_posts() ) {
											$theQuery->the_post();
											// post categories
											$categories = get_the_category();
											$separator = ', ';
											$catList = '';
											if($categories){
												foreach($categories as $category) {
													$catList .= '<a href="'.get_category_link( $category->term_id ).'" title="' .
														esc_attr( sprintf( __( "View all posts in %s", 'zn_framework'),
															$category->name ) ) . '">'.
														$category->cat_name.'</a>'.$separator;
												}
												$catList = trim($catList, $separator);
											}
											$permalink = get_the_permalink();
											// $featuredImage = get_the_post_thumbnail(get_the_ID(), 'full');
											$featuredImage = '';
											$usePostFirstImage = ( zget_option( 'zn_use_first_image', 'blog_options', false, 'yes' ) == 'yes' );
											// Create the featured image html
											if ( has_post_thumbnail( $post->ID ) ) {
												$thumb   = get_post_thumbnail_id( $post->ID );
												$f_image = wp_get_attachment_url( $thumb );
												$alt = get_post_meta($thumb, '_wp_attachment_image_alt', true);
												$title = get_the_title($thumb);

											}
											elseif( $usePostFirstImage ){
												$f_image = echo_first_image();
												$alt   = ZngetImageAltFromUrl( $f_image );
												$title = ZngetImageTitleFromUrl( $f_image );
											}

											if ( ! empty ( $f_image ) ) {
												// Make the "alt" attribute available in the front-end
												$image = vt_resize( '', $f_image, 420, 240, true );
												$featuredImage = '<img class="latest-posts-crs-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $alt . '" title="' . $title . '"/>';
											}

											?>
											<li class="post latest-posts-crs-post">
												<a href="<?php echo $permalink;?>" class="hoverBorder plus latest-posts-crs-link text-custom-parent-hov">
													<?php echo $featuredImage;?>
													<span class="latest-posts-crs-readon u-trans-all-2s text-custom-child kl-main-bgcolor"><?php _e('Read more +', 'zn_framework');?></span>
												</a>
												<em class="latest-posts-crs-details">
													<?php the_date();?>
													<?php _e('By', 'zn_framework');?>
													<?php the_author();?>
													<?php _e('in', 'zn_framework');?>
													<?php echo $catList;?>
												</em>
												<h3 class="m_title m_title_ext text-custom latest-posts-crs-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><a class="latest-posts-crs-title-link" href="<?php echo $permalink;?>"><?php the_title();?></a></h3>
											</li>
										<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>

			<?php
			wp_reset_postdata();
		}
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Enter a title for the latest posts carousel", 'zn_framework' ),
						"id"          => "lpc_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Posts Category", 'zn_framework' ),
						"description" => __( "Select the category to show items", 'zn_framework' ),
						"id"          => "lpc_categories",
						"multiple"    => true,
						"std"         => 0,
						"type"        => "select",
						"options"     => WpkZn::getBlogCategories(),
					),
					array (
						"name"        => __( "Number of items", 'zn_framework' ),
						"description" => __( "Please enter how many items you want to load.", 'zn_framework' ),
						"id"          => "lpc_num_posts",
						"std"         => 10,
						"type"        => "text"
					),
				),
			),



			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#gFcL4BXQpAs',
				'docs'    => 'http://support.hogash.com/documentation/latest-posts-carousel/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;

	}
}
