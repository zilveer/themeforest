<?php

/* ---------------------------------------------------------------------- */
/*	Columns
/* ---------------------------------------------------------------------- */

	/* -------------------------------------------------- */
	/*	One half
	/* -------------------------------------------------- */

	function ss_framework_one_half_sc( $atts, $content = null ) {

		return '<div class="one-half">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('one_half', 'ss_framework_one_half_sc');

	/* -------------------------------------------------- */
	/*	One half last
	/* -------------------------------------------------- */

	function ss_framework_one_half_last_sc( $atts, $content = null ) {

		return '<div class="one-half last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('one_half_last', 'ss_framework_one_half_last_sc');

	/* -------------------------------------------------- */
	/*	One third
	/* -------------------------------------------------- */

	function ss_framework_one_third_sc( $atts, $content = null ) {

		return '<div class="one-third">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('one_third', 'ss_framework_one_third_sc');

	/* -------------------------------------------------- */
	/*	One third last
	/* -------------------------------------------------- */

	function ss_framework_one_third_last_sc( $atts, $content = null ) {

		return '<div class="one-third last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('one_third_last', 'ss_framework_one_third_last_sc');

	/* -------------------------------------------------- */
	/*	One fourth
	/* -------------------------------------------------- */

	function ss_framework_one_fourth_sc( $atts, $content = null ) {

		return '<div class="one-fourth">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('one_fourth', 'ss_framework_one_fourth_sc');

	/* -------------------------------------------------- */
	/*	One fourth last
	/* -------------------------------------------------- */

	function ss_framework_one_fourth_last_sc( $atts, $content = null ) {

		return '<div class="one-fourth last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('one_fourth_last', 'ss_framework_one_fourth_last_sc');

	/* -------------------------------------------------- */
	/*	Two third
	/* -------------------------------------------------- */

	function ss_framework_two_third_sc( $atts, $content = null ) {

		return '<div class="two-third">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('two_third', 'ss_framework_two_third_sc');

	/* -------------------------------------------------- */
	/*	Two third last
	/* -------------------------------------------------- */

	function ss_framework_two_third_last_sc( $atts, $content = null ) {

		return '<div class="two-third last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('two_third_last', 'ss_framework_two_third_last_sc');

	/* -------------------------------------------------- */
	/*	Three fourth
	/* -------------------------------------------------- */

	function ss_framework_three_four_sc( $atts, $content = null ) {

		return '<div class="three-fourth">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('three_fourth', 'ss_framework_three_four_sc');

	/* -------------------------------------------------- */
	/*	Three fourth last
	/* -------------------------------------------------- */

	function ss_framework_three_fourth_last_sc( $atts, $content = null ) {

		return '<div class="three-fourth last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('three_fourth_last', 'ss_framework_three_fourth_last_sc');

/* ---------------------------------------------------------------------- */
/*	Alert Boxes
/* ---------------------------------------------------------------------- */

	/* -------------------------------------------------- */
	/*	Error
	/* -------------------------------------------------- */

	function ss_framework_error_sc( $atts, $content = null ) {

		return '<p class="error">' . $content . '</p>';

	}
	add_shortcode('error', 'ss_framework_error_sc');

	/* -------------------------------------------------- */
	/*	Success
	/* -------------------------------------------------- */

	function ss_framework_success_sc( $atts, $content = null ) {

		return '<p class="success">' . $content . '</p>';

	}
	add_shortcode('success', 'ss_framework_success_sc');

	/* -------------------------------------------------- */
	/*	Info
	/* -------------------------------------------------- */

	function ss_framework_info_sc( $atts, $content = null ) {

		return '<p class="info">' . $content . '</p>';

	}
	add_shortcode('info', 'ss_framework_info_sc');

	/* -------------------------------------------------- */
	/*	Notice
	/* -------------------------------------------------- */

	function ss_framework_notice_sc( $atts, $content = null ) {

		return '<p class="notice">' . $content . '</p>';

	}
	add_shortcode('notice', 'ss_framework_notice_sc');

/* ---------------------------------------------------------------------- */
/*	General
/* ---------------------------------------------------------------------- */

	/* -------------------------------------------------- */
	/*	Divider
	/* -------------------------------------------------- */

	function ss_framework_divider_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'style' => ''
		), $atts ) );

		return '<hr class="' . esc_attr( $style ) . '" />';
	
	}
	add_shortcode('divider', 'ss_framework_divider_sc');

	/* -------------------------------------------------- */
	/*	Slogan
	/* -------------------------------------------------- */

	function ss_framework_slogan_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'align' => ''
		), $atts ) );

		return '<h1 class="slogan ' . ( $align ? 'align-' . esc_attr( $align ) : '' )  . '">' . do_shortcode( $content ) . '</h1>';
	
	}
	add_shortcode('slogan', 'ss_framework_slogan_sc');

	/* -------------------------------------------------- */
	/*	Button
	/* -------------------------------------------------- */

	function ss_framework_button_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'url'    => '',
			'target' => '_self',
			'size'   => '',
			'style'  => '',
			'arrow'  => ''
		), $atts ) );

		$output = '<a class="button ' . esc_attr( $size ) . ' ' . esc_attr( $style ) . '" href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '">';

		if( $arrow && $arrow == 'left' )
			$output .= '<span class="arrow ' . esc_attr( $arrow ) . '">&laquo;</span> ';

		$output .= $content;

		if( $arrow && $arrow == 'right' )
			$output .= ' <span class="arrow">&raquo;</span>';

		$output .= '</a>';

		return $output;
	
	}
	add_shortcode('button', 'ss_framework_button_sc');

	/* -------------------------------------------------- */
	/*	Dropcap
	/* -------------------------------------------------- */

	function ss_framework_dropcap_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'style' => ''
		), $atts ) );

		return '<span class="dropcap ' . esc_attr( $style ) . '">' . $content . '</span>';

	}
	add_shortcode('dropcap', 'ss_framework_dropcap_sc');

	/* -------------------------------------------------- */
	/*	Info box
	/* -------------------------------------------------- */

	function ss_framework_infobox_sc( $atts, $content = null ) {

		return '<div class="infobox">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('infobox', 'ss_framework_infobox_sc');

	/* -------------------------------------------------- */
	/*	List
	/* -------------------------------------------------- */

	function ss_framework_list_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'icon'  => '',
			'style' => ''
		), $atts ) );

		return '<div class="' . esc_attr( $icon ) . ' ' . esc_attr( $style ) . '">' . $content . '</div>';

	}
	add_shortcode('list', 'ss_framework_list_sc');

	/* -------------------------------------------------- */
	/*	Quote
	/* -------------------------------------------------- */

	function ss_framework_quote_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'author' => '',
			'type'   => ''
		), $atts ) );

		$output = '<blockquote class="' . esc_attr( $type ) . '">';

		$output .= '<p>' . $content . '</p>';

		if( $author )
			$output .= '<small>' . esc_attr( $author ) . '</small>';

		$output .= '</blockquote>';

		return $output;

	}
	add_shortcode('quote', 'ss_framework_quote_sc');

	/* -------------------------------------------------- */
	/*	Lightbox
	/* -------------------------------------------------- */

	function ss_framework_lightbox_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'type'      => 'single-image',
			'full'      => '',
			'title'     => '',
			'group'     => '',
			'zoom_icon' => 'plus'
		), $atts ) );

		return '<a class="' . esc_attr( $type ) . ' ' . esc_attr( $zoom_icon ) . '" href="' . esc_attr( $full ) . '" title="' . esc_attr( $title ) . '" rel="' . esc_attr( $group ) . '"> ' . $content . ' </a>';
	
	}
	add_shortcode('lightbox', 'ss_framework_lightbox_sc');

	/* -------------------------------------------------- */
	/*	Accordion Content
	/* -------------------------------------------------- */

	function ss_framework_accordion_content_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'      => '',
			'title_size' => 'span',
			'mode'       => ''
		), $atts ) );

		return '<' . esc_attr( $title_size ) . ' class="acc-trigger" data-mode="' . esc_attr( $mode ) . '"><a href="#">' . esc_attr( $title ) . '</a></' . esc_attr( $title_size ) . '><div class="acc-container"><div class="content">' . do_shortcode( $content ) . '</div></div>';
	
	}
	add_shortcode('accordion_content', 'ss_framework_accordion_content_sc');

	/* -------------------------------------------------- */
	/*	Content Tabs
	/* -------------------------------------------------- */

	// Tabs container
	function ss_framework_content_tabgroup_sc( $atts, $content = null ) {

		if( !isset( $GLOBALS['tabs_groups'] ) )
			$GLOBALS['tabs_groups'] = 0;
			
		$GLOBALS['tabs_groups']++;

		$GLOBALS['tab_count'] = 0;

		$tabs_count = 1;

		do_shortcode( $content );

		if( is_array( $GLOBALS['tabs'] ) ) {

			foreach( $GLOBALS['tabs'] as $tab ) {

				$tabs[] = '<li><a href="#tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count . '">' . $tab['title'] . '</a></li>';
				$panes[] = '<div id="tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count++ . '" class="tab-content">' . do_shortcode( $tab['content'] ) . '</div>';

			}

			$return = "\n". '<ul class="tabs-nav">' . implode( "\n", $tabs ) . '</ul>' . "\n" . '<div class="tabs-container">' . implode( "\n", $panes ) . '</div>' . "\n";
		}
		
		$GLOBALS['tabs'] = null;

		return $return;

	}
	add_shortcode('tabgroup', 'ss_framework_content_tabgroup_sc');

	// Single tab
	function ss_framework_content_tab_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title' => ''
		), $atts) );

		$i = $GLOBALS['tab_count'];

		$GLOBALS['tabs'][$i] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );

		$GLOBALS['tab_count']++;

	}
	add_shortcode('tab', 'ss_framework_content_tab_sc');

/* ---------------------------------------------------------------------- */
/*	Pricing Table
/* ---------------------------------------------------------------------- */

// Pricing table container
function ss_framework_pricing_table_sc( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'column_count' => '4',
		'type'         => 'simple'
	), $atts) );
	
	// Reset everything
	$GLOBALS['pricing_column_count'] = 0;
	$GLOBALS['pricing_columns'] = null;

	$extended_features_list = null;
	$featured = null;
	$count = 0;

	do_shortcode( $content );

	if( is_array( $GLOBALS['pricing_columns'] ) ) {

		foreach( $GLOBALS['pricing_columns'] as $i => $pricing_column ) {

			// Remove any old data
			$features_list = null;
			$features = null;
			$data_feature = null;

			// Strip list items
			$features = preg_replace( array('%</?ul>%', '%</li>%') , '', $pricing_column['content'] );
			$features = explode('<li>', $features);

			// And create array
			if( is_array( $features ) )
				foreach ( $features as $k => $feature ) {

					if( $k > 0 )
						$features_list[$i][] = trim( $feature );

				}

			// Remove any old data
			$features = '';

			// Loop through items
			if( is_array( $features_list ) )
				foreach ( $features_list[$i] as $k => $feature ) {

					// Check if has tooltip and if does, apply it
					$data_tooltip = preg_match( '/\[tooltip\stext="/', $feature );

					if( $data_tooltip ) {
						
						$data_tooltip = ' data-tooltip="' . preg_replace( array('/\[tooltip\stext="/', '/"].+/'), '', $feature ) . '"';
						$feature = preg_replace( '/\[tooltip\stext=".+"]/', '', $feature );

					} else {

						$data_tooltip = '';

					}

					// If extended table's features list, save it for later use
					if( $pricing_column['type'] == 'features-list' && $type == 'extended' )
						$extended_features_list[] = trim( $feature );

					// If extended table's and normal column, apply feature to each fields
					if( $pricing_column['type'] != 'features-list' && $type == 'extended' )
						$data_feature = ' data-feature="' . $extended_features_list[$k] . '"';

					$features .= '<li' . $data_tooltip . $data_feature . '>' . $feature . '</li>';

				}

			// Create new column
			if( $pricing_column['special'] == 'featured' )
				$featured = 'featured';

			$pricing_columns[$i] = '<div class="column ' . $pricing_column['type'] . ' ' . $pricing_column['special'] . '">';

				$pricing_columns[$i] .= '<div class="header">';

					if( $pricing_column['title'] )
						$pricing_columns[$i] .= '<h2 class="title">' . $pricing_column['title'] . '</h2>';

					if( $pricing_column['price'] )
						$pricing_columns[$i] .= '<h3 class="price"><span>' . $pricing_column['price'] . '</span>' . $pricing_column['period'] . '</h3>';

					if( $pricing_column['description'] && $type == 'simple' )
						$pricing_columns[$i] .= '<h5 class="description">' . $pricing_column['description'] . '</h5>';

				$pricing_columns[$i] .= '</div><!-- end .header -->';

				$pricing_columns[$i] .= '<ul class="features">' . do_shortcode( $features ) . '</ul><!-- end .features -->';

				if( $pricing_column['sign_up_title'] ) {

					$pricing_columns[$i] .= '<div class="footer">';

						$pricing_columns[$i] .= '<a class="button" href="' . $pricing_column['sign_up_url'] . '">' . $pricing_column['sign_up_title'] . '</a>';

					$pricing_columns[$i] .= '</div><!-- end .footer -->';

				}

			$pricing_columns[$i] .= '</div><!-- end .column -->';

		}

		$output = "\n". '<section class="' . esc_attr( $type ) . '-pricing-table col' . esc_attr( $column_count ) . ' ' . $featured . ' clearfix">' . implode( "\n", $pricing_columns ) . '</section><!-- end pricing-table -->';

	}


	return $output;
	

}
add_shortcode('pricing_table', 'ss_framework_pricing_table_sc');

// Pricing table columns
function ss_framework_pricing_table_columns_sc( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'type'          => '',
		'title'         => '',
		'price'         => '',
		'period'        => '',
		'description'   => '',
		'sign_up_title' => '',
		'sign_up_url'   => '',
		'special'       => ''
	), $atts ) );

	$i = $GLOBALS['pricing_column_count'];

	$GLOBALS['pricing_columns'][$i] = array(
		'type'          => esc_attr( $type ),
		'title'         => esc_attr( $title ),
		'content'       => $content,
		'price'         => esc_attr( $price ),
		'period'        => esc_attr( $period ),
		'description'   => esc_attr( $description ),
		'sign_up_title' => esc_attr( $sign_up_title ),
		'sign_up_url'   => esc_url( $sign_up_url ),
		'special'       => esc_attr( $special )
	);

	$GLOBALS['pricing_column_count']++;

}
add_shortcode('pricing_column', 'ss_framework_pricing_table_columns_sc') ;

// Pricing table check icon
function ss_framework_pricing_table_check_sc( $atts, $content = null ) {

	return '<span class="check">&check;</span>';

}
add_shortcode('check', 'ss_framework_pricing_table_check_sc');

/* ---------------------------------------------------------------------- */
/*	HTML5 Video
/* ---------------------------------------------------------------------- */
function ss_framework_video_sc( $atts ) {

	extract( shortcode_atts( array(
		'mp4'          => '',
		'webm'         => '',
		'ogg'          => '',
		'track'        => '',
		'poster'       => '',
		'aspect_ratio' => '1.7',
		'preload'      => false,
		'autoplay'     => false,
	), $atts ) );

	global $post;

	if ( $mp4 )
		$mp4 = '<source src="' . $mp4 . '" type="video/mp4" />';

	if ( $webm )
		$webm = '<source src="' . $webm . '" type="video/webm" />';

	if ( $ogg )
		$ogg = '<source src="' . $ogg . '" type="video/ogg" />';

	if ( $track)
		$track = '<track kind="subtitles" src="' . $track . '" srclang="en" label="English">';

	if ( $poster)
		$poster = ' poster="' . $poster . '"';

	if ( $preload )
		$preload = 'preload="' . $preload . '"';

	if ( $autoplay )
		$autoplay = 'autoplay';

	$output = "<video id='video-js-id-$post->ID' class='video-js vjs-default-skin' controls {$preload} {$autoplay} {$poster} data-setup='{}' data-aspect-ratio='{$aspect_ratio}'>
			{$mp4}
			{$webm}
			{$ogg}
			{$track}
		</video>";

	return $output;

}
add_shortcode('video', 'ss_framework_video_sc');

/* ---------------------------------------------------------------------- */
/*	HTML5 Audio
/* ---------------------------------------------------------------------- */
function ss_framework_audio_sc( $atts ) {

	extract( shortcode_atts( array(
		'mp3'      => '',
		'ogg'      => '',
		'width'    => '',
		'height'   => '',
		'preload'  => false,
		'autoplay' => false,
	), $atts ) );

	global $post;

	if ( $mp3 )
		$mp3 = '<source src="' . $mp3 . '" type="audio/mp3" />';

	if ( $ogg )
		$ogg = '<source src="' . $ogg . '" type="audio/ogg" />';

	if ( $preload )
		$preload = 'preload="' . $preload . '"';

	if ( $autoplay )
		$autoplay = 'autoplay';

	$output = "<audio id='AudioPlayerV1-id-$post->ID' class='AudioPlayerV1' width='100%' height='29' controls {$preload} {$autoplay} data-fallback='" . SS_BASE_URL . "js/audioplayerv1.swf'>
					{$mp3}
					{$ogg}
				</audio>";

	return $output;

}
add_shortcode('audio', 'ss_framework_audio_sc');

/* ---------------------------------------------------------------------- */
/*	Template Tags
/* ---------------------------------------------------------------------- */

	/* -------------------------------------------------- */
	/*	Post Carousel
	/* -------------------------------------------------- */

	function ss_framework_post_carousel_sc( $atts ) {

		$atts = extract( shortcode_atts( array(
			'title'        => __('Latest stuff from our blog', 'ss_framework'),
			'limit'        => 8,
			'categories'   => '',
			'auto'         => 0,
			'scroll_count' => ''
		), $atts ) );

		$args = array('posts_per_page' => esc_attr( $limit ),
					  'post_type'      => 'post'
				  );

		if( $categories ) 
			$args = array_merge( $args, array( 'cat' => esc_attr( $categories ) ) );

		query_posts( $args );

		if( have_posts() ):

			$output = '';

			if( !empty( $title ) )
				$output .= '<h6 class="section-title">' . esc_attr( $title ) . '</h6>';

			$output .= '<ul class="post-carousel clearfix" data-auto="' . esc_attr( $auto ) . '" data-scroll_count="' . esc_attr( $scroll_count ) . '">';

			$GLOBALS['post-carousel'] = true;

			while( have_posts() ): the_post();

				$output .= '<li>';

				$output .= ss_framework_load_template_part( 'content', get_post_format() );

				$output .= '</li>';
				
			endwhile;

			$GLOBALS['post-carousel'] = null;

			$output .= '</ul><!-- end .post-carousel -->';

		endif;

		wp_reset_query();

		return $output;

	}
	add_shortcode('post_carousel', 'ss_framework_post_carousel_sc');

	/* -------------------------------------------------- */
	/*	Projects Carousel
	/* -------------------------------------------------- */

	function ss_framework_projects_carousel_sc( $atts ) {

		$atts = extract( shortcode_atts( array(
			'title'        => __('Latest projects', 'ss_framework'),
			'limit'        => 8,
			'categories'   => '',
			'auto'         => 0,
			'scroll_count' => ''
		), $atts ) );

		global $post;

		$args = array('post_type'      => 'portfolio',
					  'posts_per_page' => esc_attr( $limit ),
					  'order'          => 'DESC',
					  'orderby'        => 'date',
					  'post_status'    => 'publish'
				  );
		
		if( $categories ) {
		
			$categories = explode( ',', $categories );
			
			foreach ( $categories as $i => $category ) {
				
				$category_slugs[$i] .= get_term( $category, 'portfolio-categories' )->slug;

			}
			
			$categories = implode( ',', $category_slugs );
			
			$args = array_merge( $args, array( 'portfolio-categories' => esc_attr( $categories ) ) );
		
		}
			
		query_posts( $args );

		if( have_posts() ) {

			$output = '';

			if( !empty( $title ) )
				$output .= '<h6 class="section-title">' . esc_attr( $title ) . '</h6>';

			$output .= '<ul class="projects-carousel clearfix" data-auto="' . esc_attr( $auto ) . '" data-scroll_count="' . esc_attr( $scroll_count ) . '">';

			while( have_posts() ) {
			
				the_post();

				// Remove any old data
				$data_categories = null;
				$category_names = null;

				$portfolio_categories = get_the_terms( $post->ID, 'portfolio-categories' );

				$post_thumbnail_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portfolio-one-fourth' );
				$post_thumbnail_data = ss_framework_get_the_post_thumbnail_data( $post->ID );

				if( $portfolio_categories )
					foreach ( $portfolio_categories as $project_category ) {
						
						$data_categories .= $project_category->slug . ' ';
						
						$category_names .= strtolower( $project_category->name ) . ' / ';

					}

				$output .= '<li>';

					$output .= '<a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '">';
					
						if( $post_thumbnail_img )
							$output .= '<img src="' . $post_thumbnail_img[0] . '" alt="' . $post_thumbnail_data['alt'] . '" class="entry-image ' . $post_thumbnail_data['class'] . '">';

						$output .= '<h5 class="title">' . get_the_title( $post->ID ) . '</h5>';

						$output .= '<span class="categories">' . substr( trim( $category_names ), 0, -2 ) . '</span>';

					$output .= '</a>';

				$output .= '</li><!-- end project -->';

			}

			$output .= '</ul><!-- end .projects-carousel -->';

		}

		wp_reset_query();

		return $output;

	}
	add_shortcode('projects_carousel', 'ss_framework_projects_carousel_sc');

	/* -------------------------------------------------- */
	/*	Portfolio
	/* -------------------------------------------------- */

	function ss_framework_portfolio_sc( $atts ) {

		$atts = extract( shortcode_atts( array(
			'columns'    => 'one-fourth',
			'limit'      => -1,
			'categories' => '',
			'pagination' => 'yes'
		), $atts ) );

		global $post;
		
		if( $pagination == 'yes' )
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;

		$args = array('post_type'      => 'portfolio',
					  'posts_per_page' => esc_attr( $limit ),
					  'order'          => 'DESC',
					  'orderby'        => 'date',
					  'post_status'    => 'publish',
					  'paged'          => isset( $paged ) ? $paged : 1
				  );
		
		if( $categories ) {
		
			$categories = explode( ',', $categories );
			
			foreach ( $categories as $i => $category ) {
				
				$category_slugs[$i] .= get_term( $category, 'portfolio-categories' )->slug;

			}
			
			$categories = implode( ',', $category_slugs );
			
			$args = array_merge( $args, array( 'portfolio-categories' => esc_attr( $categories ) ) );
		
		}
			
		query_posts( $args );

		if( have_posts() ) :

			$output = '<section id="portfolio-items" class="clearfix">';

			$lightbox = of_get_option('ss_portfolio_lightbox');

			if( $lightbox == '1' ) {

				$lightbox_class = ' class="single-image"';

			} else {

				$lightbox_class = null;

			}

			while ( have_posts() ) : the_post();

				// Remove any old data
				$data_categories = null;
				$category_names = null;

				$categories = get_the_terms( $post->ID, 'portfolio-categories' );

				if( $categories ) {

					foreach ( $categories as $category ) {
						
						$data_categories .= $category->slug . ' ';
						
						$category_names .= strtolower( $category->name ) . ' / ';

					}

				}

				$post_thumbnail_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portfolio-' . esc_attr( $columns ) );
				$post_thumbnail_data = ss_framework_get_the_post_thumbnail_data( $post->ID );

				if( $lightbox == '1' ) {

					$permalink = $post_thumbnail_data['src'];

				} else {

					$permalink = get_permalink();

				}

				$output .= '<article class="' . esc_attr( $columns ) . '" data-categories="' . trim( $data_categories ) . '">';
					
					if( $post_thumbnail_img ) {
					
						$output .= '<a href="' . $permalink . '" title="' . get_the_title() . '"' . $lightbox_class . '>';
							
							$output .= '<img src="' . $post_thumbnail_img[0] . '" alt="' . $post_thumbnail_data['alt'] . '" class="entry-image ' . $post_thumbnail_data['class'] . '">';
						
						$output .= '</a>';
					
					}

					$output .= '<a href="' . get_permalink() . '" class="project-meta">';

						$output .= '<h5 class="title">' . get_the_title()  . '</h5>';

						$output .= '<span class="categories">' . substr( trim( $category_names ), 0, -2 ) . '</span>';

					$output .= '</a>';

				$output .= '</article><!-- end project -->';

			endwhile;

			$output .= '</section><!-- end #portfolio-items -->';
			
			if( $pagination == 'yes' )
				$output .= ss_framework_pagination();

			wp_reset_query();

		endif;

		return $output;

	}
	add_shortcode('portfolio', 'ss_framework_portfolio_sc');

	/* -------------------------------------------------- */
	/*	Slider
	/* -------------------------------------------------- */

	function ss_framework_slider_sc( $atts, $content = null ) {
		
		extract( shortcode_atts( array(
			'id' => ''
			), $atts ) );

		global $post;

		$args = array('name'           => esc_attr( $id ),
					  'post_type'      => 'slider',
					  'posts_per_page' => '1'
				  );

		query_posts( $args );

		if( have_posts() ) while ( have_posts() ) : the_post();

			$output = '<section id="ss-' . $post->post_name . '" class="ss-slider">';

				$slides = get_post_meta( $post->ID, 'ss_slider_slides' );

				if( !$slides || !$slides[0] )
					return;

				foreach ( $slides[0] as $slide ) :

					$output .= '<article class="slide">';

						if( $slide['slide-link-url'] )
							$output .= '<a href="' . $slide['slide-link-url'] . '" class="' . $slide['slide-link-lightbox'] . '">';

						$output .= '<img src="' . $slide['slide-img-src'] . '" alt="' . $post->post_title . '" class="slide-bg-image" />';
						
						$output .= '<div class="slide-button ' . ( $slide['slide-button-type'] ? $slide['slide-button-type'] : null ) . '">';

							if( $slide['slide-button-dropcap'] && $slide['slide-button-type'] != 'image' )
								$output .= '<span class="dropcap">' . $slide['slide-button-dropcap'] . '</span>';

							if( $slide['slide-button-title'] && $slide['slide-button-type'] != 'image' )
								$output .= '<h5>' . $slide['slide-button-title'] . '</h5>';

							if( $slide['slide-button-description'] && $slide['slide-button-type'] != 'image' )
								$output .= '<span class="description">' . $slide['slide-button-description'] . '</span>';
							
							if( $slide['slide-button-img-src'] && $slide['slide-button-type'] == 'image' )
								$output .= '<img src="' . $slide['slide-button-img-src'] . '" alt="' . $post->post_title . '" />';

						$output .= '</div>';

						if( $slide['slide-link-url'] )
							$output .= '</a>';

						if( isset( $slide['slide-content'] ) )
							$output .= '<div class="slide-content">' . do_shortcode( $slide['slide-content'] ) . '</div>';

					$output .= '</article><!-- end .slide -->';

				endforeach;

			$output .= '</section><!-- end .ss-slider -->';

		endwhile;

		wp_reset_query();

		return $output;

	}
	add_shortcode('slider', 'ss_framework_slider_sc');

	/* -------------------------------------------------- */
	/*	Team Member
	/* -------------------------------------------------- */

	function ss_framework_team_member_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'id'            => '',
			'single_url'    => '',
			'single_target' => '_self',
			'column'        => 'one-fourth',
			'last'          => ''
		), $atts ) );

		global $post;

		$args = array('name'           => esc_attr( $id ),
					  'post_type'      => 'team',
					  'posts_per_page' => '1'
				  );

		$social_links = array('behance', 'delicious', 'deviantart', 'digg', 'dribbble', 'dropbox', 'facebook', 'flickr', 'forrst', 'github', 'google', 'googleplus', 'ichat', 'lastfm', 'linkedin', 'mobypicture', 'myspace', 'picasa', 'pinterest', 'plixi', 'skype', 'stumbleupon', 'tumblr', 'twitter', 'vimeo', 'youtube', 'email');

		query_posts( $args );

		if( have_posts() ) while ( have_posts() ) : the_post();

			$output = '<div class="team-member ' . ( $column ? esc_attr( $column ) : null ) . ' ' . ( $last ? esc_attr( $last ) : null ) . '">';

				if( has_post_thumbnail() ) {

					$output .= ( $single_url ? '<a href="' . esc_url( $single_url ) . '" target="' . esc_attr( $single_target ) . '">' : null );

						$output .= get_the_post_thumbnail( get_the_ID(), 'full', array('class' => 'photo') );

					$output .= ( $single_url ? '</a>' : null );

				}

				$output .= '<div class="content">';

					$output .= '<h4 class="name">';

						$output .= ( $single_url ? '<a href="' . esc_url( $single_url ) . '" target="' . esc_attr( $single_target ) . '">' . get_the_title() . '</a>' : get_the_title() );

					$output .= '</h4>';

					$output .= '<span class="job-title">' . ss_framework_get_custom_field('ss_job_title') . '</span>';

					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
					$content = str_replace( ']]>', ']]&gt;', $content );

					$output .= $content;

					if( strpos( implode(' ', get_post_custom_keys() ), 'ss_social_link_' ) !== false ) {

						$output .= '<ul class="social-links">';

						foreach ( $social_links as $social_link ) {

							$address = '';

							if( $social_link == 'twitter' )
								$address = 'http://twitter.com/';

							if( $social_link == 'email' )
								$address = 'mailto:';

							if( ss_framework_get_custom_field( 'ss_social_link_' . $social_link ) )
								$output .= '<li class="' . esc_attr( $social_link ) . '"><a href="' . $address . ss_framework_get_custom_field( 'ss_social_link_' . $social_link ) . '" target="_blank">' . esc_attr( ucfirst( $social_link ) ) . '</a></li>';

						}

						$output .= '</ul><!-- end .social-links -->';

					}

				$output .= '</div><!-- end .content -->';

			$output .= '</div><!-- end .team-member -->';

			if( $last )
				$output .= '<div class="clear"></div>';

		endwhile;

		wp_reset_query();

		return $output;

	}
	add_shortcode('team_member', 'ss_framework_team_member_sc');

/* ---------------------------------------------------------------------- */
/*	Misc
/* ---------------------------------------------------------------------- */

	/* -------------------------------------------------- */
	/*	Fullwidth Map
	/* -------------------------------------------------- */

	function ss_framework_fullwidth_map_sc( $atts, $content = null ) {

		$output = '</div><!-- end .container --><section id="map">' . do_shortcode( $content ) . '</section><!-- end #map --><div class="container clearfix">';

		return $output;

	}
	add_shortcode('fullwidth_map', 'ss_framework_fullwidth_map_sc');

	/* -------------------------------------------------- */
	/*	Shortcode Fixer
	/* -------------------------------------------------- */

	function ss_framework_shortcode_fixer( $content ) {
		$ss_framework_shortcodes = join('|', array('one_half', 'one_half_last', 'one_third', 'one_third_last', 'one_fourth', 'one_fourth_last', 'two_third', 'two_third_last', 'three_fourth', 'three_fourth_last', 'error', 'success', 'info', 'notice', 'divider', 'slogan', 'button', 'dropcap', 'infobox', 'list', 'quote', 'lightbox', 'accordion_content', 'tabgroup', 'tab', 'pricing_table', 'pricing_column', 'check', 'video', 'audio', 'post_carousel', 'projects_carousel', 'portfolio', 'slider', 'team_member', 'fullwidth_map',' raw') );

		$new_content = preg_replace( "/(<p>)?\[($ss_framework_shortcodes)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

		$new_content = preg_replace( "/(<p>)?\[\/($ss_framework_shortcodes)](<\/p>|<br \/>)?/", "[/$2]", $new_content );

		return $new_content;
	}
	add_filter('the_content', 'ss_framework_shortcode_fixer');

	// Just to make sure that nothing seriously breaks in older versions of the theme (<v1.08)
	function ss_framework_raw_sc( $atts, $content = null ) {

		return do_shortcode( $content );

	}
	add_shortcode('raw', 'ss_framework_raw_sc');

/* ---------------------------------------------------------------------- */
/*	TinyMCE Buttons
/* ---------------------------------------------------------------------- */

function add_shortcodes_button() {

	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter('mce_external_plugins', 'add_shortcodes_tinymce_plugin');
		add_filter('mce_buttons', 'register_shortcodes_button');
	}

}
add_action('init', 'add_shortcodes_button');

function register_shortcodes_button( $buttons ) {

	array_push( $buttons, '|', 'ss_framework_shortcodes' );

	return $buttons;

}

function add_shortcodes_tinymce_plugin( $plugin_array ) {

	$plugin_array['ss_framework_shortcodes'] = SS_BASE_URL . 'functions/tinymce/tinymce.js';

	return $plugin_array;

}

function my_refresh_mce( $ver ) {

	$ver += 3;

	return $ver;

}
add_filter('tiny_mce_version', 'my_refresh_mce');