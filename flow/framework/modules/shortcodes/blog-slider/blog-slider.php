<?php
namespace Flow\Modules\BlogSlider;

use Flow\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Blog Slider
 */
class BlogSlider implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_blog_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see eltd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		$categories_array = array();
		$categories_array[] = 'All Categories';
		$categories = get_categories();
		foreach ( $categories as $category ) {
			$categories_array[$category->term_id] = $category->name;
		}
		$categories_array = array_flip($categories_array);

		vc_map( array(
			'name' => 'Blog Slider',
			'base' => $this->getBase(),
			'category' => 'by ELATED',
			'icon'  => 'icon-wpb-blog-slider extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Slider Type',
					'param_name'	=> 'type',
					'description'	=> 'Choose slider type',
					'value'			=> array(
						'Carousel'	=> 'carousel',
						'Slider'        => 'slider'
					),
					'save_always'	=> true,
					'admin_label'	=> true
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Waterfall',
					'param_name'	=> 'waterfall',
					'value'			=> array(
						'Yes'	=> 'yes',
						'No'        => 'no'
					),
					'save_always'	=> true,
					'admin_label'	=> true,
					'dependency'  => array('element' => 'type', 'value' => array('carousel')),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Slider Title',
					'param_name'	=> 'slider_title'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Slider Subtitle',
					'param_name'	=> 'slider_subtitle'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Selected Posts',
					'param_name'	=> 'selected_posts',
					'description'	=> 'Selected Posts (leave empty for all, delimit by comma)'
				),
				
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Order by',
					'param_name'	=> 'order_by',
					'value'			=> array(
						'Date'			=> 'date',
						'Title'			=> 'title',
						'Menu Order'	=> 'menu_order date' //order by menu order and fallback order is date
					),
					'save_always'	=> true,
					'admin_label'	=> true,
					'description'	=> ''
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Order',
					'param_name'	=> 'order',
					'value'			=> array(
						'DESC'		=> 'desc',
						'ASC'		=> 'asc'
					),
					'save_always'	=> true,
					'admin_label'	=> true,
					'description'	=> ''
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Category',
					'param_name'	=> 'category',
					'description'	=> 'Show posts form category',
					'value'			=> $categories_array,
					'save_always'	=> true,
					'admin_label'	=> true,
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'In grid',
					'param_name'	=> 'in_grid',
					'value'			=> array(
						'Yes'		=> 'yes',
						'No'		=> 'no'
					),
					'save_always'	=> true,
					'admin_label'	=> true,
					'description'	=> ''
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Number of Words in Excerpt',
					'param_name'	=> 'excerpt_word_number',
					'save_always'	=> true,
					'admin_label'	=> true,
					'description'	=> 'Default value is 33'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Margin bottom',
					'param_name'	=> 'margin_bottom',
					'admin_label'	=> true,
					'description'	=> ''
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Navigation',
					'param_name'	=> 'navigation',
					'value'			=> array(
						'No'		=> 'no',
						'Yes'		=> 'yes'
					),
					'save_always'	=> true,
					'admin_label'	=> true,
					'description'	=> ''
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Autoplay',
					'param_name'	=> 'autoplay',
					'value'			=> array(
						'No'		=> 'no',
						'Yes'		=> 'yes'
					),
					'save_always'	=> true,
					'admin_label'	=> true,
					'description'	=> ''
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Autoplay Speed(in ms)',
					'param_name'	=> 'autoplay_speed',
					'admin_label'	=> true,
					'description'	=> '',
					'dependency'  => array('element' => 'autoplay', 'value' => array('yes'))
				)
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'type'			 => 'carousel',
			'waterfall'      => '',
			'number'		 => -1,
			'order_by'		 => 'date',
			'order'			 => 'DESC',
			'category'		 => '',
			'in_grid'	 	 => 'yes',
			'excerpt_word_number' => 33,
			'margin_bottom'	 => '',
			'slider_title'	 => '',
			'slider_subtitle'	 => '',
			'selected_posts' => '',
			'navigation' => 'no',
			'autoplay'	 => '',
			'autoplay_speed'	 => '1000'
		);

		$params = shortcode_atts($args, $atts);
		$params['slider_position'] = $this->getSliderPosition($params);
		$params['slider_data'] = $this->getSliderData($params);
		$params['slider_classes'] = $this->getSliderClasses($params);

		extract($params);
		
		$args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> $number,
			'orderby'			=> $order_by,
			'order'				=> $order
		);
		if($category != '' && $category != 0){
			$args['cat'] = $category;			
		}
		$post_ids = null;
		
		if($selected_posts != ''){
			$post_ids = explode(',', $selected_posts);
			$args['post__in'] = $post_ids;
		}
		

		$query = new \WP_Query($args);

		if ( $query->have_posts() ) {

			$html = '';

			if ( $in_grid == 'yes' ) {
				$html .= '<div class="eltd-grid">';
			}
			$html .= '<div class="eltd-blog-carousel-outer" ' . flow_elated_get_inline_style($slider_position) . ' >';
			
			if($slider_subtitle != ''){
				$html .= '<div class="eltd-blog-slider-subtitle">';
				$html .= '<span>'.esc_attr($slider_subtitle).'</span>';
				$html .= '</div>';
			}
			
			if($slider_subtitle != ''){
				$html .= '<div class="eltd-blog-slider-title">';
				$html .= '<h2>'.esc_attr($slider_title).'</h2>';
				$html .= '</div>';
			}
			$html .= '<div class="eltd-blog-carousel ' . $slider_classes . '" ' . flow_elated_get_inline_attrs($params['slider_data']) . ' >';
			
			while ( $query->have_posts() ) {

				$query->the_post();

				$slide_params = array();
				$slide_params['excerpt_length'] = $excerpt_word_number;

				//Get slide HTML from template
				$html .= flow_elated_get_shortcode_module_template_part('templates/' . $type , 'blog-slider', '', $slide_params);

			}

			$html .= '</div></div>';

			if ( $type == 'carousel' ) {
				$html .= '<div class="eltd-blog-carousel-navigation"></div>';
			}

			if ( $in_grid == 'yes' ) {
				$html .= '</div>';
			}

		} else {

			$html = esc_html__('There is no posts!', 'flow');

		}

		wp_reset_postdata();

		return $html;

	}

	/**
	 * Slider margins
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderPosition($params) {

		$position = array();

		if ($params['margin_bottom'] !== '') {
			$position[] = 'margin-bottom: ' . $params['margin_bottom'] . 'px';
		}

		return $position;

	}

	/**
	 * Data for slider initialization
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderData($params) {

		$slider_data = array();
		
		$slider_data['data-navigation'] = $params['navigation'];
		$slider_data['data-autoplay'] = $params['autoplay'];
		$slider_data['data-autoplay-speed'] = $params['autoplay_speed'];

		return $slider_data;

	}

	private function getSliderClasses( $params ) {
		$slider_classes = array();

		$slider_classes[] = 'eltd-' . $params['type'];

		if ( $params['waterfall'] == 'yes' ) {
			$slider_classes[] = 'eltd-waterfall';
		}

		$slider_classes = implode(' ', $slider_classes);

		return $slider_classes;
	}

}