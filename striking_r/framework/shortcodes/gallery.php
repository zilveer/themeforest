<?php

if(!function_exists('theme_shortcode_gallery')){
function theme_shortcode_gallery( $output, $attr ) {
	$post = get_post();

	static $cleaner_gallery_instance = 0;
	$cleaner_gallery_instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}
	
	/* Orderby. */
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	$attr = shortcode_atts( array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'link' => '',
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'caption' => 'false',
		'lightboxtitle' => 'caption',//title,caption,none
		'lightbox_fittoview' => 'true',
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => '',
		'numberposts' => -1,
		'offset' => '',
		'grayscale' => 'false',
		'effect' => 'none'
	), $attr );

	extract( $attr );

	$id = intval( $id );
	if ( 'RAND' == $order )
		$orderby = 'none';

	

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty( $attachments ) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}
	
	/* Properly escape the gallery tags. */
	if($lightbox_fittoview === 'false'){
		$lightbox_fittoview = ' data-fittoview="false"';
	}else{
		$lightbox_fittoview = ' data-fittoview="true"';
	}
	
	$itemtag = tag_escape( $itemtag );
	$icontag = tag_escape( $icontag );
	$captiontag = tag_escape( $captiontag );
	$i = 0;

	/* Count the number of attachments returned. */
	$attachment_count = count( $attachments );

	/* If there are fewer attachments than columns, set $columns to $attachment_count. */
	//$columns = ( ( $columns <= $attachment_count ) ? intval( $columns ) : intval( $attachment_count ) );

	/* Open the gallery <div>. */
	if($grayscale == 'true'){
		$effect = 'grayscale';
	}
	if($effect != 'none'){
		$effect = ' effect-'.$effect;
	}else{
		$effect = '';
	}
	$output = "\n\t\t\t<div id='gallery-{$id}-{$cleaner_gallery_instance}' class='gallery gallery-{$id}'>";

	/* Loop through each attachment. */
	foreach ( $attachments as $id => $attachment ) {

		/* Open each gallery row. */
		if ( $columns > 0 && $i % $columns == 0 )
			$output .= "\n\t\t\t\t<div class='gallery-row'>";

		/* Open each gallery item. */
		$output .= "\n\t\t\t\t\t<{$itemtag} class='gallery-item col-{$columns}'>";

		/* Open the element to wrap the image. */
		$output .= "\n\t\t\t\t\t\t<{$icontag} class='gallery-icon'>";

		/* Add the image. */
		$img_lnk = wp_get_attachment_image_src($id, 'full');
		$img_lnk = $img_lnk[0];

		$img_src = wp_get_attachment_image_src( $id, $size );
		$img_src = $img_src[0];
		
		$img_alt = wptexturize( esc_html($attachment->post_excerpt) );
		
		if ( $img_alt == null )
			$img_alt = $attachment->post_title;
		switch($lightboxtitle){
			case 'caption':
				$lightbox_title = wptexturize( esc_html($attachment->post_excerpt) );
				break;
			case 'title':
				$lightbox_title = $attachment->post_title;
				break;
			case 'none':
			default:
				$lightbox_title = '';
		}

		$img_class = apply_filters( 'gallery_img_class', (string) 'gallery-image' ); // Available filter: gallery_img_class
		$img_rel = 'group-' . $post->ID;
		$image  =  '<img src="' . $img_src . '" alt="' . $img_alt . '" class="' . $img_class. ' attachment-' . $size . '" />';
		
		if(isset( $attr['link'] ) && 'file' === $attr['link']){
			$image = '<a href="' . $img_lnk . '" class="lightbox image_icon_zoom gallery-image-wrap'.$effect.'" title="' . $lightbox_title . '" rel="' . $img_rel . '" alt=""'.$lightbox_fittoview.'>'.$image.'</a>';
		}elseif ( ! empty( $attr['link'] ) && 'none' === $attr['link'] ){
			//$image = $image;
		}else{
			$image = '<a href="' . get_attachment_link($id) . '" class="gallery-image-wrap'.$effect.'" title="' . $lightbox_title . '" rel="' . $img_rel . '" alt="">'.$image.'</a>';
		}
		
		$output .= $image;
		
		/* Close the image wrapper. */
		$output .= "</{$icontag}>";
		
		/* Get the caption. */
		if($caption != 'false'){
			/* If image caption is set. */
			if ( !empty( $img_alt ) )
				$output .= "\n\t\t\t\t\t\t<{$captiontag} class='gallery-caption'>{$img_alt}</{$captiontag}>";
		}		

		/* Close individual gallery item. */
		$output .= "\n\t\t\t\t\t</{$itemtag}>";

		/* Close gallery row. */
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= "\n\t\t\t\t</div>";
	}

	/* Close gallery row. */
	if ( $columns > 0 && $i % $columns !== 0 )
		$output .= "\n\t\t\t</div>";

	/* Close the gallery <div>. */
	$output .= "\n\t\t\t</div><!-- .gallery -->\n";

	/* Return out very nice, valid HTML gallery. */
	return $output;
}
}
/* Filter the post gallery shortcode output. */
add_filter( 'post_gallery', 'theme_shortcode_gallery', 10, 2 );