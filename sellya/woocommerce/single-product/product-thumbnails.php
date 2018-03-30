<?php
/**
 * Single Product Thumbnails
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

global $post, $woocommerce, $product, $smof_data;

	$attachments = $product->get_gallery_attachment_ids();
	if($smof_data['sellya_en_colorbox'] != 1){
        $main_img_id = array(get_post_thumbnail_id($product->id));
        $attachments = array_merge($main_img_id, $attachments);
    }
	if (!empty($attachments)) {

		$loop = 0;
		
		foreach ( $attachments as $c=>$attachment_id ) {


			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;
			
			$image = wp_get_attachment_image_src($attachment_id,'full');
			
			$image = $image[0];
			
			$image_url = wp_get_attachment_image_src($attachment_id,'thumbnail');
			
			$image_url = $image_url[0];
			
			$image_title = esc_attr( get_the_title( $attachment_id ) );


			$style = ( ($c + 1) % 3 == 0 )? "style='margin-right:0;'" : "";

			
			if($smof_data['sellya_en_colorbox'] != '0'):
			
				echo "<a class='colorbox' $style rel='colorbox' href='$image' title='$image_title'><img src='$image_url' alt='$image_title' /></a>";
			
			else:
			
				
			
                echo '<a class="cloud-zoom-gallery" '.$style.' rel="useZoom: \'zoom1\', smallImage: \''.$image.'\' " href="'.$image.'" title="'.$image_title.'"><img src="'.$image_url.'" alt="'.$image_title.'" /></a>';
			
			endif;
			
			$loop++;

		}

	}
	elseif ( has_post_thumbnail($product->id) ) {
		
		$attachment_id = get_post_thumbnail_id($product->id);
		
		
		$image_link = wp_get_attachment_url( $attachment_id );

		if ( ! $image_link )
			continue;
		
		$image = wp_get_attachment_image_src($attachment_id,'full');
		
		$image = $image[0];
		
		$image_url = wp_get_attachment_image_src($attachment_id,'thumbnail');
		
		$image_url = $image_url[0];
		
		$image_title = esc_attr( get_the_title( $attachment_id ) );
		
	
		//echo '<a class="cloud-zoom-gallery" rel="useZoom: \'zoom1\', smallImage: \''.$image.'\' " href="'.$image.'" title="'.$image_title.'"><img src="'.$image_url.'" alt="'.$image_title.'" /></a>';
		
		
		
		if($smof_data['sellya_en_colorbox'] != '0'):
			
			echo "<a class='colorbox' rel='colorbox' href='$image' title='$image_title'><img src='$image_url' alt='$image_title' /></a>";
		
		else:
		
			
		
			echo '<a class="cloud-zoom-gallery" rel="useZoom: \'zoom1\', smallImage: \''.$image.'\' " href="'.$image.'" title="'.$image_title.'"><img src="'.$image_url.'" alt="'.$image_title.'" /></a>';
		
		endif;
		
		
		
		
		
	}
	
?>