<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Latest Posts 2
 Description: Create and display a Latest Posts 2 element
 Class: TH_LatestPosts2
 Category: content
 Level: 3
 Keywords: blog, news, article
*/

/**
 * Class TH_LatestPosts2
 *
 * Create and display a Latest Posts 2 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_LatestPosts2 extends ZnElements
{
	public static function getName(){
		return __( "Latest Posts 2", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'latestposts2--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;
		?>

			<div class="latest_posts style3 latest_posts--style2 latest_posts2 clearfix <?php echo implode(' ', $elm_classes); ?>" <?php echo $attributes; ?>>
				<h3 class="m_title m_title_ext text-custom latest_posts2-elm-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><?php echo (isset($options['lp_title']) ? strip_tags($options['lp_title']) : '');?></h3>
				<?php

				$array_link = $this->opt('lp_blog_page_new', array());

				if(isset($this->data['options']['lp_blog_page'])){
					$array_link = array(
						'url' => $this->data['options']['lp_blog_page'],
						'title' => __( "VIEW ALL", 'zn_framework' )
					);
				}

				if ( !empty($array_link) ) {
					$viewall_link = zn_extract_link( $array_link, 'viewall element-scheme__linkhv latest_posts2-viewall');
					echo $viewall_link['start'];
					echo !empty($array_link['title']) ? $array_link['title'] : __( "VIEW ALL", 'zn_framework' );
					echo $viewall_link['end'];
				}
				?>
				<ul class="posts latest_posts2-posts">
					<?php
					global $post;

					// Check what categories were selected..if any
					if ( isset ( $options['lp_blog_categories'] ) ) {
						$blog_category = implode( ',', $options['lp_blog_categories'] );
					}
					else { $blog_category = ''; }

					// HOW MANY POSTS
					if ( isset ( $options['lp_num_posts'] ) ) {
						$num_posts = $options['lp_num_posts'];
					}
					else { $num_posts = '2'; }

					// Configure the query
					$theQuery = array (
						'posts_per_page' => $num_posts,
						'cat' => $blog_category
					);
					// @since v4.1.6
					// Exclude the current viewed post from the query
					if(is_single() && ('post' == get_post_type())){
						$theQuery['post__not_in'] = array( get_the_ID() );
					}

					// Run the query
					query_posts( $theQuery );


					// Start the loop
					while ( have_posts() ) {
						the_post();

						echo '<li class="post latest_posts2-post">';

						if( $this->opt('show_img','yes') == 'yes' ){

							$image = '';
							$usePostFirstImage = ( zget_option( 'zn_use_first_image', 'blog_options', false, 'yes' ) == 'yes' );
							// Create the featured image html
							if ( has_post_thumbnail( $post->ID ) ) {
								$thumb = get_post_thumbnail_id( $post->ID );
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
								$img_sizes = $this->opt('img_sizes', array( 'width'  => '54', 'height' => '54'));
								$image = vt_resize( '', $f_image, (int)$img_sizes['width'], (int)$img_sizes['height'], true );
								$image = '<a href="' . get_permalink() . '" class="hoverBorder pull-left latest_posts2-thumb"><img src="'. $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="'.$alt.'" title="'.$title.'" class="latest_posts2-thumb-img"/></a>';
							}
							// IMAGE
							echo $image;
						}

						// TITLE
						echo '<h4 class="title latest_posts2-title"><a class="latest_posts2-title-link" href="' . get_permalink() . '" '.WpkPageHelper::zn_schema_markup('title').'>' . get_the_title() . '</a></h4>';

						if( $this->opt('show_exc','yes') == 'yes' ){

							// TEXT
							echo '<div class="text latest_posts2-post-text">';
								echo '<p>';
								$excerpt = get_the_excerpt();
								$excerpt = strip_shortcodes( $excerpt );
								$excerpt = strip_tags( $excerpt );
								$exc_limit = $this->opt('exc_limit','95');
								$the_str = mb_substr( $excerpt, 0, (int) $exc_limit );
								echo $the_str . '...';
								echo '</p>';
							echo '</div>';
						}

						$show_date = $this->opt( 'show_date','');
						if( $show_date != '' ){
							echo '<div class="latest_posts2-date">';
							if( $show_date != 'yes_noico' ){
								echo '<span class="glyphicon glyphicon-time"></span>';
							}
							echo '<span>';
								echo get_the_date( 'F j, Y' );
							echo '</span>';
							echo '</div>';
						}

						$sep = $this->opt( 'separator','yes') == 'yes' ? 'is-separator' : '';
						echo '<div class="latest_posts2-itemSep '.$sep.' clearfix"></div>';

						echo '</li>';
					}
					wp_reset_query();
					?>
				</ul>
			</div>
			<!-- end // latest posts style 2 -->

	<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$std_blog_page = '';
		if(isset($this->data['options']['lp_blog_page'])){
			$std_blog_page = array(
				'url' => $this->data['options']['lp_blog_page'],
				'title' => __( "VIEW ALL", 'zn_framework' )
			);
		}

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Number of posts", 'zn_framework' ),
						"description" => __( "Enter the number of posts that you want to show", 'zn_framework' ),
						"id"          => "lp_num_posts",
						"std"         => "2",
						"numeric"     => true,
						"type"        => "text",
						"class"        => "zn_input_xs",
					),

					array (
						"name"        => __( "Blog Category", 'zn_framework' ),
						"description" => __( "Select the blog category to show items", 'zn_framework' ),
						"id"          => "lp_blog_categories",
						"multiple"    => true,
						"std"         => "0",
						"type"        => "select",
						"options"     => WpkZn::getBlogCategories()
					),

					array (
						"name"        => __( "Blog page Link", 'zn_framework' ),
						"description" => __( "Enter the link to your blog page and a VIEW ALL link will appear on the top right corner of this element.", 'zn_framework' ),
						"id"          => "lp_blog_page_new",
						"std"         => $std_blog_page,
						"type"        => "link",
						"options"        => zn_get_link_targets(),
					),

					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'latestposts2--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						),

						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$uid,
							'val_prepend'  => 'element-scheme--',
						),
					),
					array (
						"name"        => __( "Element Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Latest Posts element. Not recommended, use Title Element instead.", 'zn_framework' ),
						"id"          => "lp_title",
						"std"         => "",
						"type"        => "text",
					),
				),
			),

			'layout' => array(
				'title' => 'Layout options',
				'options' => array(

					array (
						"name"        => __( "Show Images", 'zn_framework' ),
						"description" => __( "Enable this to display post images.", 'zn_framework' ),
						"id"          => "show_img",
						"std"         => "yes",
						"value"       => "yes",
						"type"        => "toggle2",
					),

					array (
						"name"        => __( "Images Sizes (px)", 'zn_framework' ),
						"description" => __( "Choose some image sizes", 'zn_framework' ),
						"id"          => "img_sizes",
						"std"         => array(
							'width'  => '54',
							'height' => '54'
						),
						"type"        => "image_size",
						"dependency"  => array( 'element' => 'show_img' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Show Post Date", 'zn_framework' ),
						"description" => __( "Enable this to display the posts date.", 'zn_framework' ),
						"id"          => "show_date",
						"std"         => "",
						// "value"       => "yes",
						// "type"        => "toggle2",
						'type'        => 'select',
						'options'        => array(
							'' => __( "No.", 'zn_framework' ),
							'yes' => __( "Yes.", 'zn_framework' ),
							'yes_noico' => __( "Yes, without icon.", 'zn_framework' ),
						),
					),

					array (
						"name"        => __( "Show Excerpt", 'zn_framework' ),
						"description" => __( "Enable thisto display the posts excerpt (text).", 'zn_framework' ),
						"id"          => "show_exc",
						"std"         => "yes",
						"value"       => "yes",
						"type"        => "toggle2",
					),

					array (
						"name"        => __( "Excerpt char. limit", 'zn_framework' ),
						"description" => __( "Add an excerpt limit.", 'zn_framework' ),
						"id"          => "exc_limit",
						"std"         => "95",
						"type"        => "text",
						"class"       => "zn_input_sm",
						"numeric"        => true,
						"helpers"        => array(
							"min" => 10,
							"step" => 5,
						),
						"dependency"  => array( 'element' => 'show_exc' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Post title settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the title.", 'zn_framework' ),
						"id"          => "title_typo",
						"std"         => '',
						'supports'   => array( 'size', 'font', 'style', 'line', 'weight', 'spacing', 'case', 'mb' ),
						"type"        => "font",
						'live' => array(
							'type'      => 'font',
							'css_class' => '.'.$uid. ' .latest_posts2-title',
						),
					),

					array (
						"name"        => __( "Items Border Separator", 'zn_framework' ),
						"description" => __( "Display a border separator between items?", 'zn_framework' ),
						"id"          => "separator",
						"std"         => "yes",
						"value"       => "yes",
						"type"        => "toggle2",
					),

					array (
						"name"        => __( "Items Distance", 'zn_framework' ),
						"description" => __( "Select a distance in pixels between items", 'zn_framework' ),
						"id"          => "item_dist",
						"std"         => "15",
						"type"        => "slider",
						"helpers"     => array (
							"step" => "1",
							"min" => "0",
							"max" => "100"
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .latest_posts2-itemSep',
									'css_rule'  => 'margin-bottom',
									'unit'      => 'px'
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .latest_posts2-itemSep',
									'css_rule'  => 'padding-bottom',
									'unit'      => 'px'
								),
							)
						)
						// 'class'       => 'zn_full',
					),

				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#gFcL4BXQpAs',
				'docs'    => 'http://support.hogash.com/documentation/latest-posts/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}

function css(){

	$uid = $this->data['uid'];
	$css = '';

	$text_styles = '';
	$text_typo = $this->opt('title_typo');
	if( is_array($text_typo) && !empty($text_typo) ){
		foreach ($text_typo as $key => $value) {
			if($value != '') {
				if( $key == 'font-family' ){
					$text_styles .= $key .':'. zn_convert_font($value).';';
				} else {
					$text_styles .= $key .':'. $value.';';
				}
			}
		}
		if(!empty($text_styles)){
			$css .= '.'.$uid.' .latest_posts2-title{'.$text_styles.'}';
		}
	}

	$item_dist = $this->opt( 'item_dist','15');
	if( $item_dist != 15 ){
		$css .= '.'.$uid.' .latest_posts2-itemSep{padding-bottom:'.$item_dist.'px;margin-bottom:'.$item_dist.'px;}';
	}

	return $css;

}
