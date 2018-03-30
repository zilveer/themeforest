<?php 

/*********** Aeron Shortcode: Callout box ************************************************************/

$ABdev_shortcodes['callout_box'] = array(
	'name' => 'callout_box',
	'type' => 'wrap',
	'atts' => array(
		'title' => array(
			'desc' => __( 'Title', 'ABdev_aeron' ),
		),
		'style' => array(
			'desc' => __( 'Style', 'ABdev_aeron' ),
			'default' => '1',
			'values' => array(
				'1' =>  __( 'Style 1', 'ABdev_aeron' ),
				'2' =>  __( 'Style 2', 'ABdev_aeron' ),
				'3' =>  __( 'Style 3', 'ABdev_aeron' ),
				'4' =>  __( 'Style 4', 'ABdev_aeron' ),
			),
		),
		'as_section' => array(
			'default' => '0',
			'type' => 'checkbox',
			'desc' => __( 'Use as Section', 'ABdev_aeron' ),
		),
		'centered' => array(
			'default' => '0',
			'type' => 'checkbox',
			'desc' => __( 'Centered', 'ABdev_aeron' ),
		),
		'no_button' => array(
			'default' => '0',
			'type' => 'checkbox',
			'desc' => __( 'No Button', 'ABdev_aeron' ),
		),
		'button_target' => array(
			'default' => '_self',
			'desc' => __( 'Button Target', 'ABdev_aeron' ),
			'values' => array(
				'_self' =>  __( 'Self', 'ABdev_aeron' ),
				'_blank' => __( 'Blank', 'ABdev_aeron' ),
			),
		),
		'button_size' => array(
			'default' => 'medium',
			'desc' => __( 'Button Size', 'ABdev_aeron' ),
			'values' => array(
				'small' =>  __( 'Small', 'ABdev_aeron' ),
				'medium' => __( 'Medium', 'ABdev_aeron' ),
				'large' => __( 'Large', 'ABdev_aeron' ),
			),
		),
		'button_url' => array(
			'desc' => __( 'Button Target URL', 'ABdev_aeron' ),
		),
		'button_text' => array(
			'desc' => __( 'Button Text', 'ABdev_aeron' ),
		),
	),
	'content' => array(
		'desc' => __( 'Content', 'ABdev_aeron' ),
	),
	'desc' => __( 'Callout Box', 'ABdev_aeron' )
);

if ( ! function_exists( 'ABs_callout_box_shortcode' ) ){
	function ABs_callout_box_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( ABdev_extract_attributes('callout_box'), $atts ) );
		$centered_out = ( $centered == '1' ) ? 'ABs_callout_box_center' : '';   
		$as_section_class = ( $as_section == '1' ) ? ' ABs_callout_box_as_section' : '';   
		$return = '<section class="ABs_callout_box '.$centered_out.$as_section_class.' ABs_callout_box_' . $style . '">';
		if ( $as_section == '1' ){
			$return .= '<div class="container">';
		}
		if ( $no_button != '1' ){
			$return .= '<div class="row"><div class="span9">';
		}
		$return .= '<span class="ABs_callout_box_title">'.$title.'</span>
			<p>'.do_shortcode($content).'</p>';
		if ( $no_button != '1' ){
			$button_class = ($style==4) ? 'ABs_button_normal ABs_button_small' : '';
			$return .= '</div>
					<div class="span3">
						<a href="'. $button_url .'" target="' . $button_target . '" class="ABs_button ' . $button_class . '">'.$button_text.'<i class="icon-share"></i></a>
					</div></div>';
		}       
		if ( $as_section == '1' ){
			$return .= '</div>';
		}
		$return .= '</section>';

		return $return;
	}
}





/*********** Aeron Shortcode: Section ************************************************************/

$ABdev_shortcodes['section'] = array(
	'name' => 'section',
	'type' => 'wrap',
	'atts' => array(
		'section_border_top' => array(
			'default' => '0',
			'desc' => __( 'Full Width Top Border', 'ABdev_aeron' ),
			'type' => 'checkbox',
		),
		'class' => array(
			'desc' => __( 'Custom class', 'ABdev_aeron' ),
		),
	),
	'content' => array(
		'default' => __('section content here', 'ABdev_aeron' ),
		'desc' => __( 'Content', 'ABdev_aeron' ),
	),
	'desc' => __( 'Content Section', 'ABdev_aeron' )
);

if ( ! function_exists( 'ABs_section_shortcode' ) ){
	function ABs_section_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( ABdev_extract_attributes('section'), $atts ) );
		$section_border_top_out = ( $section_border_top == 1 ) ? ' section_border_top' : '';
		return '
			<section class="' . $class . $section_border_top_out . '">
				<div class="container">
					'.do_shortcode($content).'
				</div>
			</section>';
	}
}






/*********** Aeron Shortcode: Button ************************************************************/

$ABdev_shortcodes['button'] = array(
	'name' => 'Button',
	'type' => 'wrap',
	'atts' => array(
		'size' => array(
			'desc' => __( 'Size', 'ABdev_aeron' ),
			'default' => 'medium',
			'values' => array(
				'small' =>  __( 'Small', 'ABdev_aeron' ),
				'medium' => __( 'Medium', 'ABdev_aeron' ),
				'large' => __( 'Large', 'ABdev_aeron' ),
			),
		),
		'style' => array(
			'desc' => __( 'Style', 'ABdev_aeron' ),
			'default' => 'normal',
			'values' => array(
				'white' =>  __( 'White', 'ABdev_aeron' ),
				'light' =>  __( 'Light', 'ABdev_aeron' ),
				'normal' =>  __( 'Normal', 'ABdev_aeron' ),
				'dark' =>  __( 'Dark', 'ABdev_aeron' ),
				'link' =>  __( 'Link', 'ABdev_aeron' ),
			),
		),
		'size' => array(
			'desc' => __( 'Size', 'ABdev_aeron' ),
			'default' => 'large',
			'values' => array(
				'large' =>  __( 'Large', 'ABdev_aeron' ),
				'small' =>  __( 'Small', 'ABdev_aeron' ),
			),
		),
		'url' => array(
			'desc' => __( 'URL', 'ABdev_aeron' ),
		),
		'target' => array(
			'desc' => __( 'Target', 'ABdev_aeron' ),
			'default' => '_self',
			'values' => array(
				'_self' =>  __( 'Self', 'ABdev_aeron' ),
				'_blank' => __( 'Blank', 'ABdev_aeron' ),
			),
		),
	),
	'content' => array(
		'default' => 'Click Here',
		'desc' => __( 'Button Text', 'ABdev_aeron' ),
	),
	'desc' => __( 'Button', 'ABdev_aeron' )
);

if ( ! function_exists( 'ABs_button_shortcode' ) ){
	function ABs_button_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( ABdev_extract_attributes('button'), $atts ) );
		$icon = ( $size != 'small') ? '<i class="icon-share"></i>' : '';
		$link_style = ( $style == 'link') ? 'link' : '';
		$style_class = 'ABs_button_'.$style;
		$size_class = 'ABs_button_'.$size;
		return '<a href="'. $url .'" target="' . $target . '" class="ABs_button'.$link_style.' ' . $style_class . ' ' . $size_class . '">' . $content . $icon . '</a>';
	}
}





/*********** Aeron Shortcode: Teaser ************************************************************/
$ABdev_shortcodes['teaser'] = array(
	'name' => 'teaser',
	'type' => 'wrap',
	'atts' => array(
		'title' => array(
			'desc' => __( 'Title', 'ABdev_aeron' ),
		),
		'as_section' => array(
			'default' => '0',
			'type' => 'checkbox',
			'desc' => __( 'Use as Section', 'ABdev_aeron' ),
		),
		'icon' => array(
			'desc' => __( 'Icon name', 'ABdev_aeron' ),
		),
		'image' => array(
			'desc' => __( 'Image', 'ABdev_aeron' ),
		),
	),
	'content' => array(
		'default' => __('Teaser content here', 'ABdev_aeron' ),
		'desc' => __( 'Content', 'ABdev_aeron' ),
	),
	'desc' => __( 'Content teaser', 'ABdev_aeron' )
);

if ( ! function_exists( 'ABs_teaser_shortcode' ) ){
	function ABs_teaser_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( ABdev_extract_attributes('teaser'), $atts ) );
		$classes = $icon_out = $image_out = '';
		if ($icon!=''){
			$classes .= ' ABs_teaser_with_icon';
			$icon_out = '<i class="icon-'.$icon.'"></i>';
		}
		if ($image!=''){
			$classes .= ' ABs_teaser_with_image';
			$image_out = '<img src="'.$image.'" alt="">';
		}
		$return = '<section class="ABs_teaser'.$classes.'">';
		if ( $as_section == '1' ){
			$return .= '<div class="container">';
		}
		$return .= '
			<span class="ABs_teaser_title">'.$title.'</span>
			<p>'.do_shortcode($content).'</p>'
			.$icon_out
			.$image_out;
		if ( $as_section == '1' ){
			$return .= '</div>';
		}
		$return .= '</section>';
		return $return;
	}
}






/*********** Shortcode: Latest Post ************************************************************/

$ABdev_shortcodes['posts'] = array(
	'name' => 'posts',
	'type' => 'single',
	'atts' => array(
		'category' => array(
			'desc' => __( 'Category', 'ABdev_aeron' ),
		),
		'ids' => array(
			'desc' => __( 'Posts IDs', 'ABdev_aeron' ),
		),
		'order' => array(
			'default' => 'DESC',
			'desc' => __( 'Order', 'ABdev_aeron' ),
			'values' => array(
				'ASC' =>  __( 'ASC', 'ABdev_aeron' ),
				'DESC' =>  __( 'DESC', 'ABdev_aeron' ),
			),      
		),
		'orderby' => array(
			'default' => 'date',
			'desc' => __( 'Order by', 'ABdev_aeron' ),
			'values' => array(
				'ID' =>  __( 'ID', 'ABdev_aeron' ),
				'none' =>  __( 'none', 'ABdev_aeron' ),
				'author' =>  __( 'author', 'ABdev_aeron' ),
				'title' =>  __( 'title', 'ABdev_aeron' ),
				'name' =>  __( 'name', 'ABdev_aeron' ),
				'date' =>  __( 'date', 'ABdev_aeron' ),
				'modified' =>  __( 'modified', 'ABdev_aeron' ),
				'parent' =>  __( 'parent', 'ABdev_aeron' ),
				'rand' =>  __( 'rand', 'ABdev_aeron' ),
				'menu_order' =>  __( 'menu_order', 'ABdev_aeron' ),
				'post__in' =>  __( 'post__in', 'ABdev_aeron' ),
			),      
		),
		'post_parent' => array(
			'desc' => __( 'Post Parent', 'ABdev_aeron' ),
		),
		'post_type' => array(
			'default' => 'post',
			'desc' => __( 'Post Type', 'ABdev_aeron' ),
		),
		'offset' => array(
			'default' => '0',
			'desc' => __( 'Offset', 'ABdev_aeron' ),
		),
		'tag' => array(
			'desc' => __( 'Tag', 'ABdev_aeron' ),
		),
		'tax_operator' => array(
			'default' => 'IN',
			'desc' => __( 'Tax Operator', 'ABdev_aeron' ),
		),
		'tax_term' => array(
			'desc' => __( 'Tax Term', 'ABdev_aeron' ),
		),
		'taxonomy' => array(
			'desc' => __( 'Taxonomy', 'ABdev_aeron' ),
		),
	),
	'desc' => __( 'Latest Posts', 'ABdev_aeron' )
);

if ( ! function_exists( 'ABs_posts_shortcode' ) ){
	function ABs_posts_shortcode( $atts ) {
		extract( shortcode_atts( ABdev_extract_attributes('posts'), $atts ) );
		$category = (isset($atts['category'])) ? wp_kses( $atts['category'] ,'') : '';
		$ids = (isset($atts['ids'])) ? wp_kses( $atts['ids'] ,'') : '';
		$order = (isset($atts['order'])) ? wp_kses( $atts['order'] ,'') : '';
		$orderby = (isset($atts['orderby'])) ? wp_kses( $atts['orderby'] ,'') : '';
		$post_parent = (isset($atts['post_parent'])) ? intval( $atts['post_parent']) : '';
		$post_type = (isset($atts['post_type'])) ? wp_kses( $atts['post_type'] ,'') : '';
		$offset = (isset($atts['offset'])) ? intval( $atts['offset']) : '';
		$tag = (isset($atts['tag'])) ? wp_kses( $atts['tag'] ,'') : '';
		$tax_operator = (isset($atts['tax_operator'])) ? wp_kses( $atts['tax_operator'] ,'') : '';
		$tax_term = (isset($atts['tax_term'])) ? wp_kses( $atts['tax_term'] ,'') : '';
		$taxonomy = (isset($atts['taxonomy'])) ? wp_kses( $atts['taxonomy'] ,'') : '';

		$args = array(
			'category_name'  => $category,
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => 2,
			'offset'         => $offset,
			'tag'            => $tag,
		);
		if( $ids ) {
			$posts_in = array_map( 'intval', explode( ',', $ids ) );
			$args['post__in'] = $posts_in;
		}
		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
			$tax_term = explode( ', ', $tax_term );
			if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ){
				$tax_operator = 'IN';
			}
			$tax_args = array(
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $tax_term,
						'operator' => $tax_operator
					)
				)
			);
			$args = array_merge( $args, $tax_args );
		}
		if( $post_parent ) {
			if( 'current' == $post_parent ) {
				global $post;
				$post_parent = $post->ID;
			}
			$args['post_parent'] = $post_parent;
		}
		$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $atts ) );
		if ( ! $listing->have_posts() ){
			return apply_filters( 'display_posts_shortcode_no_results', false );
		}
		$output = '<div class="row">';
		while ( $listing->have_posts() ): $listing->the_post(); global $post;

			$custom = get_post_custom();
			if(isset($custom['ABdevFW_selected_media'][0])){
				switch ($custom['ABdevFW_selected_media'][0]){
					case 'soundcloud':
						$icon = 'icon-microphonealt';
						break;
					case 'youtube':
						$icon = 'icon-video';
						break;
					case 'vimeo':
						$icon = 'icon-video';
						break;
					default:
						$icon = 'icon-featheralt-write';
				}
			}
			$title = '<h5><a class="title" href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
			$excerpt = ' <span class="excerpt">' . get_the_excerpt() . '</span>';
			$output .= '
				<div class="span3">
					<div class="ABdev_overlayed">
						' . get_the_post_thumbnail() . '
						<div class="ABdev_overlay">
							<p>
								<a href="' . get_permalink() . '"><i class="'.$icon.'"></i></a>
							</p>
						</div>
					</div>
				</div>';
			$output .= '<div class="span3 latest_news_shortcode_content">';
			$output .= $title;
			$output .= '<p>'.get_the_date() . ' / ' . __(' by ', 'ABdev_aeron') . get_the_author().'</p>';
			$output .= $excerpt;
			$output .= '</div>';
		endwhile; 
		$output .= '</div>';
		wp_reset_postdata();
		return '<div class="posts-shortcode">'.$output.'</div>';
	}
}



// ***************** 3rd party shortcode support ***************************************


// *************** ab-testimonials plugin support ********************

if( in_array('ab-testimonials/ab-testimonials.php', get_option('active_plugins')) ){
	$ABdev_shortcodes['AB_testimonials'] = array(
		'name' => 'AB_testimonials',
		'type' => 'single',
		'third_party' => 1, 
		'atts' => array(
			'category' => array(
				'desc' => __( 'Testimonial Category', 'ABdev_aeron' ),
			),
			'count' => array(
				'desc' => __( 'Number of Testimonials to Show', 'ABdev_aeron' ),
				'default' => '8',
			),
			'show_arrows' => array(
				'default' => '0',
				'type' => 'checkbox',
				'desc' => __( 'Show Navigation Arrows', 'ABdev_aeron' ),
			),
			'timeoutduration' => array(
				'desc' => __( 'Delay', 'ABdev_aeron' ),
				'default' => '5000',
			),
			'duration' => array(
				'desc' => __( 'Animation Duration', 'ABdev_aeron' ),
				'default' => '1000',
			),
			'style' => array(
				'desc' => __( 'Style', 'ABdev_aeron' ),
				'default' => '1',
				'values' => array(
					'1' =>  __( 'Big without image', 'ABdev_aeron' ),
					'2' => __( 'Small with image', 'ABdev_aeron' ),
				),
			),
			'fx' => array(
				'desc' => __( 'Transition Effect', 'ABdev_aeron' ),
				'default' => 'crossfade',
				'values' => array(
					'none' =>  __( 'None', 'ABdev_aeron' ),
					'fade' =>  __( 'Fade', 'ABdev_aeron' ),
					'crossfade' =>  __( 'Crossfade', 'ABdev_aeron' ),
					'cover-fade' =>  __( 'Cover Fade', 'ABdev_aeron' ),
				),
			),
			'easing' => array(
				'desc' => __( 'Easing Effect', 'ABdev_aeron' ),
				'default' => 'quadratic',
				'values' => array(
					'linear' =>  __( 'Linear', 'ABdev_aeron' ),
					'swing' =>  __( 'Swing', 'ABdev_aeron' ),
					'quadratic' =>  __( 'Quadratic', 'ABdev_aeron' ),
					'cubic' =>  __( 'Cubic', 'ABdev_aeron' ),
					'elastic' =>  __( 'Elastic', 'ABdev_aeron' ),
				),
			),
			'direction' => array(
				'desc' => __( 'Slide Direction', 'ABdev_aeron' ),
				'default' => 'left',
				'values' => array(
					'left' =>  __( 'Left', 'ABdev_aeron' ),
					'right' =>  __( 'Right', 'ABdev_aeron' ),
				),
			),
			'play' => array(
				'default' => '0',
				'type' => 'checkbox',
				'desc' => __( 'Autoplay', 'ABdev_aeron' ),
			),
			'pauseOnHover' => array(
				'desc' => __( 'Pause on Hover', 'ABdev_aeron' ),
				'default' => 'immediate',
				'values' => array(
					'false' =>  __( 'No', 'ABdev_aeron' ),
					'resume' =>  __( 'Resume', 'ABdev_aeron' ),
					'immediate' =>  __( 'Immediate', 'ABdev_aeron' ),
				),
			),
			'class' => array(
				'default' => '',
				'desc' => __( 'Class', 'ABdev_aeron' ),
			),
		),
		'desc' => __( 'AB Testimonial Slider', 'ABdev_aeron' )
	);
}