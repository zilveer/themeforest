<?php
	add_filter( 'post_gallery', 'duotive_gallery', 10, 2 );
	function duotive_gallery ( $output, $attr) {
		global $post, $wp_locale;
	
		static $instance = 0;
		$instance++;
	
		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}
	
		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
		), $attr));
	
		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';
	
		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
	
		if ( empty($attachments) )
			return '';
	
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}
	
		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$columns = intval($columns);
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';
	
		$selector = "gallery-{$instance}";
	
		$output = '<div class="gallery-wrapper">';
		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
			$class = '';
			if ( $columns > 0 &&  ++$i % $columns == 0 ) $class = ' duotive-gallery-item-last';
			$output .= "<{$itemtag} class='duotive-gallery-item".$class."'>";
			$output .= "<{$icontag} class='gallery-icon pageflip'>";
				$output .= "$link";
			$output .= "</{$icontag}>";
			$output .= "<dd>&nbsp;</dd>";
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && $i % $columns == 0 ) $output .= '<div class="duotive-gallery-separator"></div>';
		}
	
		$output .= "</div>";
	
		return $output;
	}
	function duotive_get_attachment_link_addon($html){
		$html = str_replace("'>","'><span class=\"icon-zoom\">&nbsp;</span>",$html);
		return $html;
	}
	add_filter('wp_get_attachment_link','duotive_get_attachment_link_addon',10,1);

	// IMAGE SIZES FOR GALLERY ON FULL WIDTH	
	add_image_size( 'fullwidth-landscape-1', 900, 600, true );
	add_image_size( 'fullwidth-landscape-2', 435, 290, true );
	add_image_size( 'fullwidth-landscape-3', 280, 185, true );
	add_image_size( 'fullwidth-landscape-4', 202, 134, true );
	add_image_size( 'fullwidth-landscape-5', 156, 104, true );
	add_image_size( 'fullwidth-landscape-6', 125, 83, true );		
	add_image_size( 'fullwidth-portrait-1', 900, 1110, true );
	add_image_size( 'fullwidth-portrait-2', 435, 570, true );
	add_image_size( 'fullwidth-portrait-3', 280, 330, true );
	add_image_size( 'fullwidth-portrait-4', 202, 264, true );
	add_image_size( 'fullwidth-portrait-5', 156, 204, true );					
	add_image_size( 'fullwidth-portrait-6', 125, 153, true );
	
	// IMAGE SIZES FOR GALLERY ON SIDEBAR	
	add_image_size( 'sidebar-landscape-1', 590, 390, true );
	add_image_size( 'sidebar-landscape-2', 280, 185, true );
	add_image_size( 'sidebar-landscape-3', 175, 115, true );
	add_image_size( 'sidebar-landscape-4', 125, 83, true );
	add_image_size( 'sidebar-portrait-1', 590, 730, true );
	add_image_size( 'sidebar-portrait-2', 280, 330, true );
	add_image_size( 'sidebar-portrait-3', 175, 230, true );
	add_image_size( 'sidebar-portrait-4', 125, 153, true );	

	
?>