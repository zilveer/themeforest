<?php

class WPV_Gallery {
	public function __construct() {
		add_shortcode('wpv_gallery', array(&$this, 'gallery'));
	}

	public function gallery( $attr ) {
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) )
				$attr['orderby'] = 'post__in';
			$attr['include'] = $attr['ids'];
		}

		// Allow plugins/child themes to override the default gallery template.
		$output = apply_filters('wpv_post_gallery', '', $attr);
		if ( $output != '' )
			return $output;

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
			'exclude'    => '',
			'pausetime'  => 3000,
			'direction'  => 'none',
			'where'		 => 'single',
		), $attr, 'gallery'));

		$id = intval($id);
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

		if ( empty($attachments) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		foreach ( $attachments as $id => $attachment ) {

			$image = wp_get_attachment_image_src($id, $size);

			if(!empty($image)) {
				$this_slide = array(
					'type' => 'img',
					'url' => $image[0],
				);

				if(strpos($size, 'small') !== false || strpos($size, 'loop') !== false) {
					$this_slide['href'] = get_permalink();
				}

				$slides[] = $this_slide;
			}
		}

		extract(self::get_size_from_thumbnail_name($size));

		$hw_string = image_hwstring($width, $height);

		return wpv_shortcode_slider(array(
			'width'           => $width,
			'height'          => $height,
			'style'           => 'featured style-2',
			'pausetime'       => $pausetime,
			'effect'          => 'slide',
			'direction'       => $direction,
			'adaptive_height' => ! is_singular( 'post', 'portfolio' ),
		), json_encode($slides), 'slider');
	}

	protected static function get_size_from_thumbnail_name($thumbnail_name) {
		if(isset($GLOBALS['_wp_additional_image_sizes'][$thumbnail_name]))
			return array(
				'width' => $GLOBALS['_wp_additional_image_sizes'][$thumbnail_name]['width'],
				'height' => $GLOBALS['_wp_additional_image_sizes'][$thumbnail_name]['height']
			);

		return array(
			'width' => get_option($thumbnail_name.'_size_w'),
			'height' => get_option($thumbnail_name.'_size_h')
		);
	}

}

new Wpv_Gallery;