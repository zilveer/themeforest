<?php
		global $post, $wbc_gallery_count;

		if ( empty( $wbc_gallery_count ) ) $wbc_gallery_count = 0;
		$temp_post = $post;

		$atts = extract( shortcode_atts(
				array(
					'portfolio_display' => '',
					'portfolio_cats'    => '',
					'padding'           => '',
					'img_size'          => 'square',
					'paginate'          => '',
					'order_by'          => 'date',
					'order_dir'         => 'DESC',
					'all_word'          => '',
					'filter_align'      => 'left',
					'pagination_align'  => 'right',

					'show_post'         => -1,
					'show_filter'       => '',
					'layout_type'       => '',
					'ajaxed'            => '',
					'excerpt_length'    => 40,
					'overlay_color'     => '',
					'text_color'        => '',
					'box_bg'            => '',
					'gap'				=> '',

					//Column Settings
					'cols_xl'           => '',
					'cols_l'            => '',
					'cols_s'            => '',
					'cols_xs'           => '',

					'mouse_over_play' => '',
				), $atts ) );

		$brick_wall = false;
		if ( $layout_type == 'brick' ) {
			$brick_wall = true;
			$img_size = 'landscape';
		}

		if( empty( $pagination_align) ) $pagination_align = 'right';

		if( $filter_align == 'left' || $filter_align == 'right' || $filter_align == 'center' ){
			$filter_align = 'text-'.$filter_align;
		}else{
			$filter_align = 'text-left';
		}

		if ( empty( $layout_type ) ) { $layout_type = 'masonry'; }


		$page_var = ( is_front_page() && !is_home() ) ? 'page' : 'paged';

		if ( $paginate == 'yes' && $show_post != '-1' ) {
			$paged = ( get_query_var( $page_var ) ) ? get_query_var( $page_var ) : 1;
		}else {
			$paged = 1;
		}

		$args = array(
			'post_type'      => 'wbc-portfolio',
			'meta_key'       => '_thumbnail_id',
			'order'          => $order_dir,
			'orderby'        => $order_by,
			'paged'          => $paged,
			'posts_per_page' => $show_post,
		);

		if ( !empty( $portfolio_cats ) ) {
			$args['portfolio-categories'] = $portfolio_cats;
		}

		$style = '';
		$container_margin ='';
		if ( is_numeric( $padding ) ) {
			$style .='style="padding:0 '.$padding.'px;margin-bottom:'.( $padding * 2 ).'px;"';

			if ( $padding > 0 ) {
				$container_margin = 'style="margin:0 -'.$padding.'px -'.( $padding * 2 ).'px;"';
			}else {
				$container_margin = 'style="margin:0;"';
			}
		}

		$q = new WP_Query( $args );

		$html = '';

		$count = 0;

		$css_classes = '';
		$css_classes .= 'wbc-portfolio-grid iso-type portfolio-4-cols';

		if( isset($gap) && is_numeric($gap) ){
			$css_classes .= ' gap-'.esc_attr( $gap );
		}


		$overlay_style = '';
		if ( !empty( $overlay_color ) ) {
			$overlay_style = 'style="background-color:'.esc_attr( $overlay_color ).';"';
		}


		$id = 'gal-'.$wbc_gallery_count;

		if ( $q->have_posts() ) {

			if($mouse_over_play == 'yes') wp_enqueue_script( 'wbc-froogaloop' );

			$data_tags = ' ';
			$data_array = array(
				'x-large-screen' => $cols_xl,
				'large-screen'   => $cols_l,
				'small-screen'   => $cols_s,
				'x-small-screen' => $cols_xs,
			);
			foreach ( $data_array as $key => $value ) {

				if ( !empty( $value ) && is_numeric( $value ) ) {
					$data_tags .='data-'.$key.'="'.$value.'" ';
				}
			}
			$html .= '<span class="wbc-content-loader"><i class="fa fa-spinner fa-spin"></i></span>';
			$html .= '<div id="'.$id.'" class="'.$css_classes.'" data-layout-type="'.$layout_type.'" '.$container_margin.' '.$data_tags.'>';


			$filters = array();
			$vid_count = 0;

			while ( $q->have_posts() ) {

				$q->the_post();

				$post_meta = wbc_get_meta( get_the_id() );

				$terms = get_the_terms( get_the_ID(), 'portfolio-filter' );


				$type = '';
				if ( isset( $terms ) && is_array( $terms ) ) {

					$term_list = array();
					foreach ( $terms as $term ) {

						if ( !in_array( $term->term_id, $filters ) ) {
							$filters[] = $term->term_id;
						}

						$type = strtolower( preg_replace( '/\s+/', '-', $term->slug ) );

						$term_list[] = strtolower( preg_replace( '/\s+/', '-', $term->slug ) );

					}

					$term_list = join( ' ', $term_list );

				}
				if ( $brick_wall == true ) {

					if ( isset( $post_meta['opts-portfolio-image-size'] ) && !empty( $post_meta['opts-portfolio-image-size'] ) ) {
						$img_size = $post_meta['opts-portfolio-image-size'];
					}else {
						$img_size = 'square';
					}
				}


				$extra_class = '';

				$extra_class .= 'portfolio-image-'.$img_size;

				$extra_class .= ' '.( ( !empty( $type ) ) ? $term_list : 'image' );


				$html .= '<div class="portfolio-item isotope-item '.$extra_class.'" '.$style.' data-id="'.get_the_ID().'" data-type="'.( ( !empty( $type ) ) ? $term_list : 'image' ).'">';

				$content_type = ( isset( $post_meta['opts-portfolio-type'] ) ) ? $post_meta['opts-portfolio-type'] : 'image';

				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );

				$html .= '<div class="post-featured">';
				$html .= '	<div class="wbc-image-wrap">';
				$html .= '		<a href="'.esc_attr( get_permalink() ).'">';
				$html .=    get_the_post_thumbnail( get_the_id(), $img_size );
				$html .= '		</a>';
				$html .= '		<a class="item-link-overlay" href="'.esc_attr( get_permalink() ).'" '.$overlay_style.'></a>';
				$html .= '		<div class="wbc-extra-links">';
				$html .= '		<h4 class="item-title">'.get_the_title().'</h4>';

				switch ( $content_type ) {
				case 'video':

					$url = '';

					$videoHtmlCode = '';

					$video_embed_code = ( isset( $post_meta['wbc-portfolio-video-embed'] ) && !empty( $post_meta['wbc-portfolio-video-embed'] ) ) ? $post_meta['wbc-portfolio-video-embed'] : false;

					if ( $video_embed_code !== false ) {
						if ( 1 === preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_embed_code, $matches ) ) {

							$url = 'http://youtube.com/watch?v='.$matches[1].'&width=70%&height=60%';
							$video_ID   = $matches[1];
							$video_type = 'youtube';

							if($mouse_over_play == 'yes'){
								$videoHtmlCode = '<span class="video-atts" data-id="wbc_'.rand().'" data-type="'.$video_type.'" data-url="'.$video_ID.'"></span>';

								// wp_enqueue_script( 'wbc-froogaloop' );
							}

						}elseif ( 1 === preg_match( '/vimeo.com\/(?:video\/)?([0-9]+)/', $video_embed_code , $matches ) ) {

							$url = 'http://vimeo.com/'.$matches[1].'?width=70%&height=60%';
							$video_ID   = $matches[1];
							$video_type = 'vimeo';

							if($mouse_over_play == 'yes'){
								$videoHtmlCode = '<span class="video-atts" data-id="wbc_'.rand().'" data-type="'.$video_type.'" data-url="'.$video_ID.'"></span>';

								// wp_enqueue_script( 'wbc-froogaloop' );
							}

						}elseif ( 1 === preg_match_all( '/.*https?:\/\/.*\.(mp4|webm|ogg).*$/i', $video_embed_code , $matches ,PREG_PATTERN_ORDER) ) {
							
							$video_embed_code = explode("\"", $video_embed_code);
							$video_ID         = '';
							$video_type       = 'HTML5';
							$url              = '';

							foreach ($video_embed_code as $video) {

								if(1 === preg_match( '/https?:\/\/.*\.(mp4|webm|ogg|ogv)$/i', $video , $matched)){
									switch ($matched[1]) {
										case 'mp4':
											$video_ID .= ' data-mp4-url="'.esc_attr( $matched[0] ).'"';
											break;
										
										case 'webm':
											$video_ID .= ' data-webm-url="'.esc_attr( $matched[0] ).'"';
											break;

										case 'ogv':
										case 'ogg':
										$video_ID .= ' data-ogv-url="'.esc_attr( $matched[0] ).'"';
										break;
									}
								}
							}

							// $videoHtmlCode
							if( !empty( $video_ID ) && $mouse_over_play == 'yes' ){
								$videoHtmlCode = '<span class="video-atts" data-id="wbc_'.rand().'" data-type="'.$video_type.'"'.$video_ID.'></span>';
							}
						}
					}
					if ( isset( $url ) && !empty($url)) {
						$html .= '<a data-photo-up="prettyPhoto" title="'.get_the_title( get_the_id() ).'" href="'.esc_attr( $url ).'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';

						// wp_enqueue_script( 'wbc-froogaloop' );

						$html .= $videoHtmlCode;

					}else {
						$html .= '<a data-photo-up="prettyPhoto" title="'.get_the_title( get_post_thumbnail_id( get_the_id() ) ).'" href="'.$large_image_url[0].'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';
						$html .= $videoHtmlCode;
					}

					break;

				case 'gallery':
					//$id = get_the_id();

					$html .= '<a data-photo-up="prettyPhoto[gallery-'.$id.'-'.get_the_id().']" title="'.get_the_title( get_post_thumbnail_id( get_the_id() ) ).'" href="'.$large_image_url[0].'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';

					$gallery_images = ( isset( $post_meta['wbc-portfolio-gallery-format'] ) && !empty( $post_meta['wbc-portfolio-gallery-format'] ) ) ? $post_meta['wbc-portfolio-gallery-format'] : false;

					if ( $gallery_images !== false ) {
						$gallery_ids = explode( ',', $gallery_images );


						foreach ( $gallery_ids as $image ) {

							$path = wp_get_attachment_image_src( $image, 'large' );

							$html .='<a data-photo-up="prettyPhoto[gallery-'.$id.'-'.get_the_id().']" title="'.get_the_title( $image ).'" href="'.$path[0].'" class="wbc-gallery"></a>';

						}
					}
					break;

				default:
					$html .= '<a data-photo-up="prettyPhoto" title="'.get_the_title( get_post_thumbnail_id( get_the_id() ) ).'" href="'.$large_image_url[0].'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';
					break;
				}




				$html .= '			<a href="'.esc_attr( get_permalink() ).'" class="wbc-go-link"><i class="fa fa-link"></i></a>';
				$html .= '		</div>';
				$html .= '	</div>';
				$html .= '</div>';

				if ( $portfolio_display == 'yes' ) {
					$cssArray = array(
						'color' => $text_color,
						'background-color' => $box_bg
					);
					$css = wbc_generate_css( $cssArray );

					$html .= '<div class="portfolio-text-wrap" '.$css.'>';
					$html .= '<h4 class="portfolio-title entry-title" ><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';

					$html .= wbc_get_excerpt( $excerpt_length );

					$html .= '</div>';
				}

				$html .= '</div>';


				$count++;

			} // Ends while have posts


			$html .='</div>';


			if ( is_array( $filters ) && count( $filters ) > 0 && $show_filter == 'yes' ) {

				$filters = get_terms( 'portfolio-filter', array('include' => $filters ) );

				$all_word = ( isset( $all_word ) && !empty( $all_word ) ) ? $all_word : esc_html__( 'All', 'ninezeroseven' );
				$filter_html = '';
				$filter_html .= '<div class="clearfix wbc-filter-wrap '.$filter_align.'">';
				$filter_html .= '<ul class="wbc-filter" id="'.str_replace( 'gal', 'filter', $id ).'">';

				$filter_html .='<li><a href="#" data-filter-gallery="all" class="button btn-primary selected">'.$all_word.'</a></li>';

				foreach ( $filters as $filter ) {
					$filter_html .='<li><a href="#" data-filter-gallery="'.esc_attr( $filter->slug ).'" class="button btn-primary">'.$filter->name.'</a></li>';
				}
				$filter_html .='</ul>';
				$filter_html .='</div>';

				$html = $filter_html.$html;

			}


			if ( $paginate == 'yes' ) {
				$big = 999999999; // need an unlikely integer

				$page_links = paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var( $page_var ) ),
						'total' => $q->max_num_pages,
						'type' => 'array'
					) );

				if ( is_array( $page_links ) ) {

					$html .='<div class="wbc-pagination-portfolio text-'.esc_attr( $pagination_align ).'">';
					$html .='<ul data-gallery-id="'.$id.'" class="wbc-pagination">';

					foreach ( $page_links as $link ) {
						$html .='<li>'.$link.'</li>';
					}

					$html .='</ul></div>';
				}
			}

			$portfolio_wrap_class = '';

			$portfolio_wrap_class .='wbc-portfolio-wrapper ';

			if ( $ajaxed == "yes" && $show_post !='-1' ) {
				$portfolio_wrap_class .='ajaxed ';
			}

			$portfolio_wrap = '';

			$portfolio_wrap .= '<div id="'.str_replace( 'gal', 'portfolio', $id ).'" class="'.$portfolio_wrap_class.'">';

			$portfolio_wrap .= $html;

			$portfolio_wrap .='</div>';

			$html = $portfolio_wrap;
		} //Ends if have_posts


		$wbc_gallery_count++;

		$post = $temp_post;

	echo !empty( $html ) ? $html :'';

?>