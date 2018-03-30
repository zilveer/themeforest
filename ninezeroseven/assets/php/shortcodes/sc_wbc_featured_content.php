<?php
		$atts = extract( shortcode_atts(
				array(
					'img_size'          => 'full',
				), $atts ) );

		if( !is_single() ) return '';

			$html = '';

			$wbc_id = get_the_id();

			$post_meta = wbc_get_meta( $wbc_id );

			$content_type = ( isset( $post_meta['opts-portfolio-type'] ) ) ? $post_meta['opts-portfolio-type'] : 'image';

			switch( $content_type){
				case 'video':

				$video_embed_code = (isset($post_meta['wbc-portfolio-video-embed']) && !empty($post_meta['wbc-portfolio-video-embed'])) ? $post_meta['wbc-portfolio-video-embed'] : false;

				if( $video_embed_code !== false ){
		    		$html .= '<div class="wbc-video-wrap">';
		    		$html .= apply_filters( 'the_content', do_shortcode($video_embed_code) );
		    		$html .= '</div>';
		    	}

				break;

				case 'gallery';

				$gallery_images = ( isset( $post_meta['wbc-portfolio-gallery-format'] ) && !empty( $post_meta['wbc-portfolio-gallery-format'] ) ) ? $post_meta['wbc-portfolio-gallery-format'] : false;

				if ( $gallery_images !== false ) {
					$gallery_ids = explode( ',', $gallery_images );
					$gallery_markup = '';
					if ( is_array( $gallery_ids ) ) {

						$has_gallery = true;

						$html .='<div class="flexslider">';

						$html .='<ul class="slides">';

						foreach ( $gallery_ids as $image ) {

							$path = wp_get_attachment_image_src( $image, $img_size );

							$html .='<li>';
							$html .='	<div class="wbc-image-wrap">';
							$html .='		<a href="'.esc_attr( get_permalink() ).'"><img src="'.esc_attr( $path[0] ).'" alt="'.esc_attr( get_the_title( $image ) ).'"/></a>';
							$html .='		<div class="item-link-overlay"></div>';
							$html .='		<div class="wbc-extra-links">';
							$html .='			<a data-photo-up="prettyPhoto[gallery-'.$wbc_id.']" title="'.esc_attr( get_the_title( $image ) ).'" href="'.esc_attr( $path[0] ).'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';
							$html .='		</div>';
							$html .='	</div>';
							$html .='</li>';
						}

						$html .='</ul>';

						$html .='</div>';
					}
				}

				break;

				default:

					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $wbc_id ), 'full' );
	    			$image_title = get_the_title( get_post_thumbnail_id( $wbc_id ) );

	    			if( has_post_thumbnail()){
		    			$image_html = get_the_post_thumbnail( $wbc_id , $img_size );

			    		$html .='	<div class="wbc-image-wrap">';
			    		$html .='		<a href="'.esc_attr( get_permalink() ).'">';
			    		$html .=		$image_html;
			    		$html .='		</a>';
			    		$html .='		<div class="item-link-overlay"></div>';
			    		$html .='		<div class="wbc-extra-links">';
						$html .='			<a data-photo-up="prettyPhoto" title="'. esc_attr($image_title) .'" href="'.$large_image_url[0].'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';
						$html .='		</div>';
			    		$html .='	</div>';
		    		}

				break;
			}

			$html = (!empty($html)) ? '<div class="wbc-featured-sc post-featured">'.$html.'</div>' : '';



	echo !empty( $html ) ? $html :'';

?>