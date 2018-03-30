<?php

/**
 * Blockquote shortcode handler
 *
 * @package wpv
 * @subpackage editor
 */

/**
 * class WPV_Blockquote
 */
class WPV_Blockquote {
	/**
	 * Register the shortcodes
	 */
	public function __construct() {
		add_shortcode('blockquote', array(__CLASS__, 'dispatch'));
	}

	/**
	 * Blockquote shortcode callback
	 *
	 * @param  array  $atts    shortcode attributes
	 * @param  string $content shortcode content
	 * @param  string $code    shortcode name
	 * @return string          output html
	 */
	public static function dispatch($atts, $content, $code) {
		extract(shortcode_atts(array(
			'layout' => 'slider',
			'cat' => '',
			'ids' => '',
			'autorotate' => false,
		), $atts));

		$query = array(
			'post_type' => 'testimonials',
			'orderby' => 'menu_order',
			'order' => 'DESC',
			'posts_per_page' => -1,
		);

		if(!empty($cat)) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'testimonials_category',
					'field' => 'slug',
					'terms' => explode(',', $cat),
				)
			);
		}

		if($ids && $ids != 'null')
			$query['post__in'] = explode(',',$ids);

		$q = new WP_Query($query);

		$output = '';

		if($layout == 'slider') {
			$slides = array();

			while($q->have_posts()) {
				$q->the_post();

				$slides[] = array(
					'type' => 'html',
					'html' => self::format(),
				);
			}

			$output = wpv_shortcode_slider(array(
				'pager' => true,
				'controls' => false,
				'auto' => wpv_sanitize_bool($autorotate),
			), json_encode($slides), 'slider');
		} else {
			$output .= '<div class="blockquote-list">';

			while($q->have_posts()) {
				$q->the_post();

				$output .= self::format();
			}

			$output .= '</div>';
		}

		wp_reset_postdata();

		return $output;
	}

	private static function format() {
		$content = get_the_content();
		$cite = get_post_meta( get_the_ID(), 'testimonial-author', true );
		$link = get_post_meta( get_the_ID(), 'testimonial-link', true );
		$title = get_the_title();

		if(!empty($link) && !empty($cite))
			$cite = '<a href="'.$link.'" target="_blank">'.$cite.'</a>';

		if(!empty($title)) {
			if(!empty($cite))
				$cite = " <span class='company-name'>($cite)</span>";
			$title = "<strong class='quote-title'><span class='the-title'>$title</span>$cite</strong>";
		} elseif(!empty($cite)) {
			$title = "<strong class='quote-title'>$cite</strong>";
		}

		$thumbnail = '';
		if ( has_post_thumbnail() ) {
			$thumbnail  = '<div class="quote-thumbnail">';
			$thumbnail .= get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
			$thumbnail .= $title;
			$thumbnail .= '</div>';
		} else {
			$content .= '<div class="only-title">'.$title.'</div>';
		}

		$content = '<div class="quote-content">'.$content.'</div>';

		return "<blockquote class='clearfix small simple'>$thumbnail<div class='quote-text'>".do_shortcode($content)."</div></blockquote>";
	}
};

new WPV_Blockquote;
