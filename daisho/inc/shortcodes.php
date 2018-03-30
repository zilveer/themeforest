<?php
// Add shortcodes for backwards compatibility
add_shortcode( 'toggle', 'symple_toggle_shortcode' );
add_shortcode( 'accordion_group', 'symple_accordion_main_shortcode' );
add_shortcode( 'accordion', 'symple_accordion_section_shortcode' );
add_shortcode( 'tabs', 'symple_tabgroup_shortcode' );
add_shortcode( 'tab', 'symple_tab_shortcode' );

/**
 * A shortcode that allows inserting widgets in content.
 *
 * @param array Shortcode attributes.
 * @param string Inner content of the shortcode.
 * @return string Iframe with a video.
 */
function flow_shortcode_sidebar( $atts, $content = null ) {
	$atts = shortcode_atts( array( 'id' => '' ), $atts );
	if ( $atts['id'] != '' ) {
		$this_sidebar = '<div class="post-sidebar">';
		
		ob_start();
		dynamic_sidebar( apply_filters( 'flow_sidebar', $atts['id'] ) );
		$this_sidebar .= ob_get_contents();
		ob_end_clean();
		
		$this_sidebar .= '</div>';
		
		return $this_sidebar;
	}
}
add_shortcode( 'flow-sidebar', 'flow_shortcode_sidebar' );

/**
 * A shortcode that displays recent posts.
 *
 * @param array Shortcode attributes.
 * @param string Inner content of the shortcode.
 * @return string HTML output with recent posts.
 */
function flow_shortcode_recent_posts( $atts, $content = null ) {
	$atts = shortcode_atts( array( 'header' => '' ), $atts );

	$blog_page = get_option( 'page_for_posts' );

	if ( $blog_page ) {
		$blog_page_link = get_permalink( $blog_page );
	} else {
		$blog_page_link = get_home_url();
	}

	$args = array(
		'orderby' => 'date',
		'order' => 'DESC',
		'post_type' => array( 'post' ),
		'posts_per_page' => 4,
		'ignore_sticky_posts' => 1 // 0 to show stickies
	);
	
	$recent_posts_query = new WP_Query( $args );
	if ( $recent_posts_query->have_posts() ) {
		$output = '<div class="rbp-container clearfix">';
			if ( $atts['header'] != 'false' ) {
				$output .= '<div class="rbp-header">';
					$output .= '<h2>' . __( 'New Blog Posts', 'flowthemes' ) . '</h2>';
					$output .= '<span class="spacer"></span>';
					$output .= '<a href="' . $blog_page_link . '">' . __( 'View Blog', 'flowthemes' ) . '</a>';
				$output .= '</div>';
			}
			$output .= '<div class="rbp-content clearfix">';
			while ( $recent_posts_query->have_posts() ) {
				$recent_posts_query->the_post();
				
				$date = sprintf( '<span class="rbp-date"><a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a></span>',
					esc_url( get_permalink() ),
					esc_attr( sprintf( __( 'Permalink to %s', 'flowthemes' ), the_title_attribute( 'echo=0' ) ) ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
				
				$output .= '<div class="rbp-entry">';
					$output .= '<a class="rbp-title" href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a>';
					$output .= $date;
				$output .= '</div>';
			}
			$output .= '</div>';
		$output .= '</div>';
	}
	wp_reset_postdata();
	
	return $output;
}
add_shortcode( 'recent_posts', 'flow_shortcode_recent_posts' );

/**
 * A shortcode that displays recent portfolio posts.
 *
 * @param array Shortcode attributes.
 * @param string Inner content of the shortcode.
 * @return string HTML output with recent portfolio posts.
 */
function flow_shortcode_recent_projects( $atts, $content = null ) {
	$atts = shortcode_atts( array( 'header' => '' ), $atts );
	
	global $post;

	$portfolio_page = get_option('flow_portfolio_page');
	$portfolio_page_link = get_permalink( $portfolio_page );
	
	// Projects Loop
	$args = array(
		'post_type' => array( 'portfolio' ),
		'posts_per_page' => 5,
		'ignore_sticky_posts' => 1 // 0 to show stickies
	);
	
	$recent_projects = new WP_Query( $args );
	
	if ( $recent_projects->have_posts() ) {
		$output = '<div class="rpp-container clearfix">';
			$output .= '<div class="rpp-header">';
				$output .= '<h2>' . __( 'Recent Projects', 'flowthemes' ) . '</h2>';
				$output .= '<span class="spacer"></span>';
				$output .= '<a href="' . $portfolio_page_link . '">' . __( 'View Portfolio', 'flowthemes' ) . '</a>';
			$output .= '</div>';
			$output .= '<div id="content-small" class="clearfix">';
			while ( $recent_projects->have_posts() ) {
				$recent_projects->the_post();
			
				$attachments = get_post_meta($post->ID, '300-160-image', true);
				$thumbnail_hover_color = get_post_meta($post->ID, 'thumbnail_hover_color', true);
				$thumb_title = get_the_title();
				$thumb_client = get_post_meta($post->ID, 'portfolio_client', true);
				
				$project_categories = array();
				$project_categories = wp_get_object_terms($post->ID, 'portfolio_category');
				$project_categories_names_array = array();
				foreach($project_categories as $project_category_index => $project_category_object){
					$project_categories_names_array[] = $project_category_object->name;
				}
				$project_categories_names = implode(", ", $project_categories_names_array);
				
				$tmpdddisplay = get_post_meta($post->ID, 'thumbnail_meta', true);
				if($tmpdddisplay == 1){
					$tmpdddisplay = 'tn-display-meta';
				}else{
					$tmpdddisplay = '';
				}
				
				$tmpddlink = get_post_meta($post->ID, 'thumbnail_link', true);
				if($tmpddlink == ''){
					$tmpddlink = get_permalink();
				}
				$tmpddLinkNewWindow = get_post_meta($post->ID, 'thumbnail_link_newwindow', true);
				if($tmpddLinkNewWindow == 1){
					$tmpddLinkNewWindow = 'target="_blank"';
				}else{
					$tmpddLinkNewWindow = '';
				}
				
				$output .= '<div class="element element-stand-alone ' . $tmpdddisplay . '">';
					if ( $tmpddlink ) {
						$output .= '<a class="thumbnail-link" href="' . $tmpddlink . '" ' . $tmpddLinkNewWindow . '></a>';
					}
					$output .= '<div class="thumbnail-meta-data-wrapper">';
						$output .= '<div class="symbol" style="z-index:3;">' . $thumb_title . '</div>';
					$output .= '</div>';
					$output .= '<div class="name" style="z-index: 3;">' . strip_tags( $thumb_client ) . '</div>';
					$output .= '<div class="categories" style="z-index: 3;">' . $project_categories_names . '</div>';
					$output .= '<div style="background-color: ' . $thumbnail_hover_color . '; width: 100%; height: 100%; z-index: 2;" class="thumbnail-hover"></div>';
					if ( $attachments ) {
						$output .= '<img class="project-img" style="z-index: 1;" src="' . esc_attr( $attachments ) . '" alt="' . esc_attr( $thumb_title ) . '">';
					}
					$output .= '<div style="background-color: ' . $thumbnail_hover_color . '; width: 100%; height: 100%; z-index: 0;"></div>';
				$output .= '</div>';
			}
			$output .= '</div>';
		$output .= '</div>';
	}
	
	wp_reset_postdata();
	
	return $output;
}
add_shortcode( 'recent_projects', 'flow_shortcode_recent_projects' );

/**
 * A shortcode that displays portfolio posts as Isotope grid.
 *
 * @param array Shortcode attributes.
 * @param string Inner content of the shortcode.
 * @return string HTML output with portfolio posts.
 */
function flow_shortcode_isotope( $atts, $content = null ) {
	$atts = shortcode_atts( array( 'order' => 'DESC', 'orderby' => 'date', 'categories' => '', 'categories_operator' => 'IN' ), $atts );
	
	global $post;
	
	// Projects Loop
	$args = array(
		'post_type' => array( 'portfolio' ),
		'orderby' => $atts['orderby'],
		'order' => $atts['order'],
		'posts_per_page' => -1,
		'ignore_sticky_posts' => 1
	);
	
	// Exclude or Include categories
	if ( ! empty( $atts['categories'] ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'term_id',
				'terms' => $atts['categories'],
				'operator' => $atts['categories_operator']
			)
		);
	}
	
	$recent_projects = new WP_Query( $args );
	
	if ( $recent_projects->have_posts() ) {
		$output = '<div class="ns-isotope clearfix">';
		
			$output .= '<section class="ns-filters clearfix">';
				$output .= '<ul class="option-set ns-filter-category clearfix" data-option-key="filter">';
					$output .= '<li><a href="#filter" data-project-category-id="all" data-option-value="*" class="selected">' . __( 'All Works', 'flowthemes' ) . '</a></li>';
					if ( ! empty( $atts['categories'] ) ) {
						if ( $atts['categories_operator'] == 'NOT IN' ) {
							$tax_terms = get_terms( 'portfolio_category', array( 'hide_empty' => true, 'exclude' => $atts['categories'] ) );
						}else{
							$tax_terms = get_terms( 'portfolio_category', array( 'hide_empty' => true, 'include' => $atts['categories'] ) );
						}
					}else{
						$tax_terms = get_terms( 'portfolio_category', array( 'hide_empty' => true ) );
					}
					foreach ( $tax_terms as $tax_term ) {
						$output .= '<li>' . '<a href="#filter" data-project-category-id="' . $tax_term->term_id . '" data-option-value=".portfolio-category-' . $tax_term->term_id . '">' . $tax_term->name  . '</a></li>';
					}
				$output .= '</ul>';
				$output .= '<ul class="ns-filter-size clearfix">
					<li>
						<a href="#toggle-sizes" class="toggle-selected">
							<svg version="1.1" class="toggle-sizes-large-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="18px" viewBox="0 0 28 18" enable-background="new 0 0 28 18" xml:space="preserve">
								<g>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2,0h14c1.105,0,2,0.895,2,2V16c0,1.104-0.895,2-2,2H2
										c-1.105,0-2-0.895-2-2V2C0,0.895,0.895,0,2,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,0H26c1.105,0,2,0.895,2,2V6C28,7.104,27.105,8,26,8h-3.999
										C20.895,8,20,7.104,20,6V2C20,0.895,20.895,0,22.001,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,10H26c1.105,0,2,0.895,2,1.999V16c0,1.104-0.895,2-2,2
										h-3.999C20.895,18,20,17.105,20,16V12C20,10.896,20.895,10,22.001,10z"/>
								</g>
							</svg>						
						</a>
						<a href="#toggle-sizes">
							<svg version="1.1" class="toggle-sizes-small-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="18px" viewBox="0 0 28 18" enable-background="new 0 0 28 18" xml:space="preserve">
								<g>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2.001,0h4C7.104,0,8,0.895,8,2V6c0,1.104-0.896,2-1.999,2h-4
										C0.896,8,0,7.104,0,6V2C0,0.895,0.896,0,2.001,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M12,0h4.001C17.105,0,18,0.895,18,2V6c0,1.104-0.895,2-1.998,2H12
										c-1.105,0-2-0.896-2-2V2C10,0.895,10.895,0,12,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,0h4C27.104,0,28,0.895,28,2V6c0,1.104-0.896,2-1.999,2h-4
										C20.896,8,20,7.104,20,6V2C20,0.895,20.896,0,22.001,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2.001,10h4C7.104,10,8,10.895,8,12V16c0,1.104-0.896,2-1.999,2h-4
										C0.896,18,0,17.105,0,16V12C0,10.895,0.896,10,2.001,10z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M12,10h4.001C17.105,10,18,10.895,18,12V16c0,1.104-0.895,2-1.998,2
										H12c-1.105,0-2-0.895-2-2V12C10,10.895,10.895,10,12,10z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,10h4C27.104,10,28,10.895,28,12V16c0,1.104-0.896,2-1.999,2
										h-4C20.896,18,20,17.105,20,16V12C20,10.895,20.896,10,22.001,10z"/>
								</g>
							</svg>
						</a>
					</li>
				</ul>';
			$output .= '</section>';
		
			$output .= '<div class="ns-container variable-sizes clearfix">';
			while ( $recent_projects->have_posts() ) {
				$recent_projects->the_post();
				
				// Thumbnail and its mouse over color
				$thumbnail_image = get_post_meta($post->ID, '300-160-image', true);
				$thumbnail_hover_color = get_post_meta($post->ID, 'thumbnail_hover_color', true);
				if($thumbnail_image or $thumbnail_hover_color){
				}else{
					$thumbnail_hover_color = '#888';
				}
				
				/*
				 * Get project categories
				 *
				 * 1. Get project categories display names (for thumbnails)
				 * 2. Get project categories slugs (for PHP/JS/CSS use)
				 */
				$project_categories = array();
				$project_categories = wp_get_object_terms($post->ID, "portfolio_category");

				$project_categories_ids_array = array();
				$project_categories_names_array = array();
				foreach($project_categories as $project_category_index => $project_category_object){
					$project_categories_ids_array[] = $project_category_object->term_id;
					$project_categories_names_array[] = $project_category_object->name;
				}
				$project_categories_ids = array();
				foreach($project_categories_ids_array as $k => $v){
					$project_categories_ids[$k] = 'portfolio-category-' . $v;
				}
				$project_categories_ids = implode(" ", $project_categories_ids);
				$project_categories_names = implode(", ", $project_categories_names_array);
					
				// Project title
				$thumb_title = get_the_title();
				
				// Project meta data
				$tmpdddisplay = get_post_meta($post->ID, 'thumbnail_meta', true);
				if($tmpdddisplay == 1){
					$tmpdddisplay = 'tn-display-meta';
				}else{
					$tmpdddisplay = '';
				}
				$thumb_ourrole = get_post_meta($post->ID, 'portfolio_ourrole', true);
				$thumb_date = get_post_meta($post->ID, 'portfolio_date', true);
				$thumb_client = get_post_meta($post->ID, 'portfolio_client', true);
				$thumb_agency = get_post_meta($post->ID, 'portfolio_agency', true);
				
				// Thumbnail link
				$thumb_link = get_post_meta($post->ID, 'thumbnail_link', true);
				$thumb_link_target_blank = get_post_meta($post->ID, 'thumbnail_link_newwindow', true);
				if($thumb_link_target_blank == 1){
					$thumb_link_target_blank = 'target="_blank"';
				}else{
					$thumb_link_target_blank = '';
				}
				
				// Thumbnail size
				// 0 = random, 1 = large, 2 = medium, 3 = vertical, 4 = horizontal, 5 = small
				$thumb_size = get_post_meta( $post->ID, 'thumbnail_size', true );
				$thumb_size_classes = '';
				if ( $thumb_size == 0 || empty( $thumb_size ) ) {
					$thumb_size = rand( 0, 99 );
					if ( $thumb_size < 3 ) {
						$thumb_size_classes = 'width3 height2';
					} else if ( $thumb_size < 9) {
						$thumb_size_classes = 'width2 height2';
					} else if ( $thumb_size < 16) {
						$thumb_size_classes = 'height2';
					} else if ( $thumb_size < 24) {
						$thumb_size_classes = 'width2';
					} else {
						$thumb_size_classes = '';
					}
				} else if ( $thumb_size == 1 ) {
					$thumb_size_classes = 'width3 height2';
				} else if ( $thumb_size == 2 ) {
					$thumb_size_classes = 'width2 height2';
				} else if ( $thumb_size == 3 ) {
					$thumb_size_classes = 'height2';
				} else if ( $thumb_size == 4 ) {
					$thumb_size_classes = 'width2';
				}
				
				$output .= '<div id="post-' . get_the_ID() . '" class="' . implode( ' ', get_post_class( array( 'item', $project_categories_ids, $tmpdddisplay, $thumb_size_classes ) ) ) . '">';
					 if ( $thumb_link ) {
						$output .= '<a class="thumbnail-link" href="' . esc_url( $thumb_link ) . '" ' . $thumb_link_target_blank . '></a>';
					} else {
						$output .= '<a class="thumbnail-project-link" href="' . get_permalink() . '">' . $thumb_title . '</a>';
					}
					$output .= '<div class="thumbnail-meta-data-wrapper">';
						$output .= '<div class="symbol">' . $thumb_title . '</div>';
					$output .= '</div>';
					$output .= '<div class="name">' . strip_tags( $thumb_client ) . '</div>';
					$output .= '<div class="categories">' . $project_categories_names . '</div>';
					$output .= '<div style="background-color: ' . $thumbnail_hover_color . ';" class="thumbnail-hover"></div>';
					if ( esc_url( $thumbnail_image ) ) {
						$output .= '<img class="project-img" src="' . esc_url( $thumbnail_image ) . '" alt="' . esc_attr( $thumb_title ) . '" />';
					}
					$output .= '<div class="project-thumbnail-background" style="background-color: ' . $thumbnail_hover_color . '"></div>';
				$output .= '</div>';
			}
			$output .= '</div>';
		$output .= '</div>';
		
		wp_reset_query();
		wp_reset_postdata();
		
		return $output;
	}
}
add_shortcode( 'ns-isotope', 'flow_shortcode_isotope' );

function flow_content_slider($atts, $content = null) {
	$class = shortcode_atts( array('title' => '', 'icon' => '', 'image' => '', 'description' => '', 'link' => '', 'post_type' => '', 'posts_per_page' => '', 'arrows_top_position' => '120px'), $atts );
	
	$output = $image = $description = $icon = '';
	
	if($class['icon'] != ''){
		$icon = 'data-icon="' . $class['icon'] . '"';
	}
	
	if($class['image'] != ''){
		$image = '<img class="cb-image" src="' . $class['image'] . '" alt="" />';
	}
	
	if($class['description'] != ''){
		$description = '<span class="cb-description">'.$class['description'].'</span>';
	}
	
	$title = $class['title'];
	if($class['link'] != ''){
		$title = '<a class="cb-title-link" href="' . $class['link'] . '">' . $class['title'] . '</a>';
		if($image){
			$image = '<a class="cb-image-link" href="' . $class['link'] . '">' . $image . '</a>';
		}
	}
	
	// Post Type carousel
	if($class['post_type'] != ''){
		if(empty($class['posts_per_page'])){
			$post_per_page = -1; // -1 shows all posts
		}else{
			$post_per_page = $class['posts_per_page'];
		}
		
		$do_not_show_stickies = 1; // 0 to show stickies
		$args = array(
			'post_type' => $class['post_type'],
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => $post_per_page,
			'ignore_sticky_posts' => $do_not_show_stickies
		);
		$block_query = new WP_Query( $args ); 
		if( $block_query->have_posts() ) {
			while($block_query->have_posts()){
				$block_query->the_post();
				$output .= '<div class="grid_4 content-block" id="post-' . get_the_ID() . '" data-arrows-top-position="' . $class['arrows_top_position'] . '">';
					$output .= '<div class="cb-date">' . esc_html( get_the_date() ) . '</div>';
					$output .= '<div class="cb-title cb-news-title">';
						$output .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
					$output .= '</div>';
					$output .= '<div class="cb-content"><p>' . get_the_excerpt() . '</p></div>';
					$output .= '<div style="clear: both;"></div>';
				$output .= '</div>';
			}
		}
		wp_reset_postdata();
	}else{
		$output = '<div class="grid_4 content-block" data-arrows-top-position="' . $class['arrows_top_position'] . '">';
			$output .= '<div class="cb-date"></div>';
			$output .= $image;
			$output .= '<div class="cb-title" ' . $icon . '>' . $title . $description . '</div>';
			$output .= '<div class="cb-content">';
				$output .= '<p>' . do_shortcode( $content ) . '</p>';
			$output .= '</div>';
		$output .= '</div>';
	}
	
	return $output;
}
add_shortcode('content_block', 'flow_content_slider');

function flow_content_slider_scripts() {
	wp_enqueue_script( 'flow-content-slider', get_template_directory_uri() . '/js/content-slider.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'flow-content-slider', get_template_directory_uri() . '/css/content-slider.css' );
}
add_action( 'wp_enqueue_scripts', 'flow_content_slider_scripts' );
