<?php
		global $post, $wbc_blog_count;
		$temp_post = $post;

		$atts = shortcode_atts(
			array(
				'blog_layout'    => '',
				'img_size'       => '',
				'paginate'       => '',
				'blog_cats'      =>'',
				'order_by'       => 'date',
				'order_dir'      => 'DESC',
				'post_in'        => '',
				'post_not_in'    => '',
				'padding'        => '',

				'show_post'      => -1,
				'ajaxed'         => '',
				'excerpt_length' => 260,
				'overlay_color'  => '',
				'page_nav_align' => 'right',
				'load_more_text' => '',
				'page_nav_type' => '',

				//Column Settings
				'cols_xl'        => '',
				'cols_l'         => '',
				'cols_s'         => '',
				'cols_xs'        => ''

			), $atts );

		extract( $atts );

		if ( empty( $blog_layout ) ) { $blog_layout = 'blog-style-1';}

		if ( empty( $wbc_blog_count ) ) $wbc_blog_count = 0;
		
		$page_var = ( is_front_page() && !is_home() ) ? 'page' : 'paged';

		if ( $paginate == 'yes' && $show_post != '-1' ) {
			$paged = ( get_query_var( $page_var ) ) ? get_query_var( $page_var ) : 1;
		}else {
			$paged = 1;
		}

		$args = array(
			'post_type'      => 'post',
			'order'          => $order_dir,
			'orderby'        => $order_by,
			'paged'          => $paged,
			'posts_per_page' => $show_post,
		);

		if ( !empty( $blog_cats ) ) {
			$args['category_name'] = $blog_cats;
		}

		if ( !empty( $post_in ) ) {
			$post_ids = explode( ',', $post_in );
			foreach ( $post_ids as $key => $value ) {
				$value = trim( $value );

				if ( !is_numeric( $value ) || empty( $value ) ) {
					unset( $post_ids[$key] );
				}
			}

			$post_ids = array_values( $post_ids );

			$args['post__in'] = $post_ids;
		}

		if ( !empty( $post_not_in ) ) {
			$post_ids = explode( ',', $post_not_in );
			foreach ( $post_ids as $key => $value ) {
				$value = trim( $value );

				if ( !is_numeric( $value ) || empty( $value ) ) {
					unset( $post_ids[$key] );
				}
			}

			$post_ids = array_values( $post_ids );

			$args['post__not_in'] = $post_ids;
		}



		$style = '';

		$q = new WP_Query( $args );

		$html = '';

		$count = 0;

		$img_size = ( !empty( $img_size ) ) ? $img_size : 'large';

		if ( $q->have_posts() ) {

			$wrapper_id = 'wbc-blog-'.$wbc_blog_count;

			$data_tags = ' ';

			$data_array = array(
				'x-large-screen' => $cols_xl,
				'large-screen' => $cols_l,
				'small-screen' => $cols_s,
				'x-small-screen'=> $cols_xs,
			);

			$data_array['layout-type'] = 'masonry';
			if ( $blog_layout == 'blog-style-3' ) {
				foreach ( $data_array as $key => $value ) {

					if ( !empty( $value ) && is_numeric( $value ) ) {
						$data_tags .='data-'.$key.'="'.$value.'" ';
					}elseif ( !empty( $value ) ) {
						$data_tags .='data-'.$key.'="'.esc_attr( $value ).'" ';
					}
				}
			}

			$wrapper_class = 'wbc-blog-post-wrapper ';

			if ( $ajaxed == "yes" && $show_post !='-1' ) {
				$wrapper_class .='ajaxed ';
			}


			$wrapper_style = '';
			$article_style = '';

			if( !empty( $padding ) && is_numeric( $padding ) ){
				$styleArray = array(
					'margin-left'  => '-'.$padding,
					'margin-right' => '-'.$padding,
				);


				$wrapper_style = wbc_generate_css( $styleArray );

				$styleArray = array(
					'padding-left'  => $padding,
					'padding-right' => $padding,
				);


				$article_style = wbc_generate_css( $styleArray );
			}

			$html .= '<div id="'. esc_attr( $wrapper_id ).'" class="'. esc_attr( $wrapper_class ).'" '.$wrapper_style.'>';
			$html .= '<span class="wbc-content-loader"><i class="fa fa-spinner fa-spin"></i></span>';

			$html .= '<div class="posts '.$blog_layout.'" '.$data_tags.'>';


			$filters = array();

			while ( $q->have_posts() ) {

				$q->the_post();

				//BEGIN
				$add_in = '';

				$classes = 'clearfix';

				if ( $blog_layout == 'blog-style-3' ) $classes .=' masonry-item';

				$classes = 'class="'.join( " " , get_post_class( $classes , get_the_id() ) ).'"';

				$html .= '<article id="post-'.get_the_id().'" '.$classes.' '.$article_style.'>';

				$post_meta = wbc_get_meta( get_the_id() );

				$overlay = '';

				if ( !empty( $overlay_color ) ) {
					$overlay .='style="background-color:'.$overlay_color.';"';
				}

				switch ( get_post_format() ) {
				case 'video':
					$video_embed_code = ( isset( $post_meta['wbc-video-embed'] ) && !empty( $post_meta['wbc-video-embed'] ) ) ? $post_meta['wbc-video-embed'] : false;
					if ( $video_embed_code !== false ) {

						$html .= '<div class="post-featured video-format">';
						$html .= '<div class="wbc-video-wrap">';
						$html .= apply_filters( 'the_content', do_shortcode( $video_embed_code ) );
						$html .= '</div>';
						$html .= '</div>';
					}

					break;

				case 'gallery':
					$id = get_the_id();
					$gallery_images = ( isset( $post_meta['wbc-gallery-format'] ) && !empty( $post_meta['wbc-gallery-format'] ) ) ? $post_meta['wbc-gallery-format'] : false;

					if ( $gallery_images !== false ) {
						$gallery_ids = explode( ',', $gallery_images );
						$gallery_markup = '';
						if ( is_array( $gallery_ids ) ) {

							$has_gallery = true;

							$gallery_markup .='<div class="flexslider">';

							$gallery_markup .='<ul class="slides">';

							foreach ( $gallery_ids as $image ) {

								$path = wp_get_attachment_image_src( $image, $img_size );
								$large_path = wp_get_attachment_image_src( $image, 'full' );

								$gallery_markup .='<li>';
								$gallery_markup .='	<div class="wbc-image-wrap">';
								$gallery_markup .='		<a href="'.esc_attr( get_permalink() ).'"><img src="'.$path[0].'" alt="'.get_the_title( $image ).'"/></a>';
								$gallery_markup .='		<a class="item-link-overlay" href="'.esc_attr( get_permalink() ).'" '.$overlay.'></a>';
								$gallery_markup .='		<div class="wbc-extra-links">';
								$gallery_markup .='			<a data-photo-up="prettyPhoto[gallery-'.$id.'-'.$wbc_blog_count.']" title="'.esc_attr( get_the_title( $image ) ).'" href="'.esc_attr( $large_path[0] ).'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';
								$gallery_markup .='			<a href="'.esc_attr( get_permalink() ).'" class="wbc-go-link"><i class="fa fa-link"></i></a>';
								$gallery_markup .='		</div>';
								$gallery_markup .='	</div>';
								$gallery_markup .='</li>';
							}

							$gallery_markup .='</ul>';

							$gallery_markup .='</div>';
						}
						if ( $has_gallery !== false ) {
							$html .= '<div class="post-featured gallery-format">';
							$html .= $gallery_markup;
							$html .= '</div>';
						}
					}

					break;

				case 'link':

					$link_title = ( isset( $post_meta['wbc-link-format-text'] ) && !empty( $post_meta['wbc-link-format-text'] ) ) ? $post_meta['wbc-link-format-text'] : get_the_title();
					$link_URL = ( isset( $post_meta['wbc-link-format-link'] ) && !empty( $post_meta['wbc-link-format-link'] ) ) ? $post_meta['wbc-link-format-link'] : get_permalink();

					$add_in .= '<a href="'.esc_attr( esc_url( $link_URL ) ).'" class="link-format">';

					$add_in .= '<h2 class="entry-title">'.$link_title.'</h2>';

					$add_in .= '<span class="link-url">';
					$add_in .= $link_URL;
					$add_in .= '</span>';

					$add_in .= '</a>';

					break;

				case 'quote':

					$quote_who = ( isset( $post_meta['wbc-quote-who'] ) && !empty( $post_meta['wbc-quote-who'] ) ) ? $post_meta['wbc-quote-who'] : '';
					$quote_message = ( isset( $post_meta['wbc-quote-message'] ) && !empty( $post_meta['wbc-quote-message'] ) ) ? $post_meta['wbc-quote-message'] : '';

					$add_in .= '<div class="quote-format">';

					$add_in .= $quote_message;

					$add_in .= '<span class="quote-who">'.$quote_who.'</span>';

					$add_in .= '</div>';

					break;

				default:
					$id = get_the_id();
					if ( has_post_thumbnail() ) {
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );

						$html .='<div class="post-featured">';
						$html .='	<div class="wbc-image-wrap">';
						$html .='		<a href="'.esc_attr( get_permalink() ).'">';
						$html .=   get_the_post_thumbnail( $id, $img_size );
						$html .='		</a>';
						$html .='		<a class="item-link-overlay" href="'.esc_attr( get_permalink() ).'" '.$overlay.'></a>';
						$html .='		<div class="wbc-extra-links">';
						$html .='			<a data-photo-up="prettyPhoto" title="'.get_the_title( get_post_thumbnail_id( $id ) ).'" href="'.esc_attr( $large_image_url[0] ).'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';
						$html .='			<a href="'.esc_attr( get_permalink() ).'" class="wbc-go-link"><i class="fa fa-link"></i></a>';
						$html .='		</div>';
						$html .='	</div>';
						$html .='</div>';
					}
					break;
				}


				$html .='<div class="post-contents">';

				if ( get_post_format() != 'quote' && get_post_format() != 'link' ) {

					$html .='<header class="post-header">';

					$html .='<h2 class="entry-title"><a href="'.esc_attr( get_permalink() ).'">'.get_the_title().'</a></h2>';

					$html .='<div class="entry-meta">';
					$html .='<span class="date"><i class="fa fa-calendar"></i> '.get_the_date( get_option( 'date_format' ) ).'</span>';
					$html .='<span class="user"><i class="fa fa-user"></i> '.esc_html__( 'By', 'ninezeroseven' ).' <a href="'.esc_attr( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.get_the_author_meta( 'display_name' ).'</a></span>';


					if ( get_post_type() == 'post' ) {
						$html .='<span class="post-in"><i class="fa fa-pencil"></i> '.esc_html__( 'In', 'ninezeroseven' ).' ';

						ob_start();

						the_category( ', ' );

						$html .= ob_get_contents();

						ob_get_clean();

						$html .='</span>';

					}



					$html .='<span class="comments"><i class="fa fa-comments"></i> ';

					ob_start();

					comments_number( esc_html__( 'No Comments', 'ninezeroseven' ), esc_html__( '1 Comment', 'ninezeroseven' ), esc_html__( '% Comments', 'ninezeroseven' ) );

					$html .= ob_get_contents();

					ob_get_clean();

					$html .='</span>';
					$html .='</div>';
					$html .='</header>';

				}

				$html .='<div class="entry-content clearfix">';

				if ( get_post_format() == 'quote' || get_post_format() == 'link' ) {

					$html .= $add_in;

				}else {

					$html .= wbc_get_excerpt( $excerpt_length );

					$html .= sprintf( '<div class="more-link"><a href="%1s" class="button btn-primary">%2s</a></div>',
						esc_attr( get_permalink() ),
						esc_html__( 'Read More', 'ninezeroseven' )
					);
				}

				$html .='</div><!-- ./entry-content clearfix -->';

				$html .='</div><!-- ./post-contents -->';

				$html .='</article> <!-- ./post -->';
				//END

			} // Ends while have posts


			$html .='</div><!-- /.posts -->';

			if ( $paginate == 'yes' ) {
				if( $page_nav_align == 'left' || $page_nav_align == 'right' || $page_nav_align == 'center' ){
					$page_nav_align = 'text-'.$page_nav_align;
				}else{
					$page_nav_align = 'text-right';
				}

				$big = 999999999; // need an unlikely integer
				$page_links = paginate_links( array(
						'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'  => '?paged=%#%',
						'current' => max( 1, get_query_var( $page_var ) ),
						'total'   => $q->max_num_pages,
						'type'    => 'array'
					) );
				if ( is_array( $page_links ) ) {


					$html .='<div class="'.esc_attr($page_nav_align).'">';
					$paginate_type  = 1;
					if( $page_nav_type == 'load-more' ){
						$html .='<div class="load-more">';
						foreach ( $page_links as $link ) {
							if( false != preg_match('/<a.*?class=\".*?(next).*?<\/a>/', $link,$matched)){
								$link_url = preg_match('/<a.*?href="([^\"]+).*?<\/a>/', $link,$url_part);
								if(!empty($url_part[1])){
									$load_more_text = ( empty( $load_more_text ) ) ? esc_html__('Load More Posts', 'ninezeroseven' ) : esc_html( $load_more_text );
									$html .='<a class="button btn-primary" href="'.esc_attr( $url_part[1] ).'">'.esc_html( $load_more_text ).'</a>';
								}
							}
						}
						
						$html .='</div>';
					}else{
						$html .='<ul class="wbc-pagination">';

						foreach ( $page_links as $link ) {
							$html .='<li>'.$link.'</li>';
						}
						$html .='</ul>';
					}

					$html .='</div>';
				}
			}

			$html .='</div><!-- /.wbc-blog-post-wrapper -->';
		} //Ends if have_posts

		$wbc_blog_count++;

		$post = $temp_post;
		

		echo !empty( $html ) ? $html :'';

?>