<?php

namespace Libero\Modules\BlogList;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class BlogList
 */
class BlogList implements ShortcodeInterface {
	/**
	* @var string
	*/
	private $base;
	
	function __construct() {
		$this->base = 'mkd_blog_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => 'Mikado Blog List',
			'base' => $this->base,
			'icon' => 'icon-wpb-blog-list extended-custom-icon',
			'category' => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => esc_html__('Type', 'libero'),
						'param_name' => 'type',
						'value' => array(
							'Boxes' => 'boxes',
							'Minimal' => 'minimal',
							'Image in box' => 'image_in_box'
						),
						'description' => '',
                        'save_always' => true
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Number of Posts',
						'param_name' => 'number_of_posts',
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Number of Columns',
						'param_name' => 'number_of_columns',
						'value' => array(
							'One' => '1',
							'Two' => '2',
							'Three' => '3',
							'Four' => '4'
						),
						'description' => '',
						'dependency' => Array('element' => 'type', 'value' => array('boxes')),
                        'save_always' => true
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Order By',
						'param_name' => 'order_by',
						'value' => array(
							'Title' => 'title',
							'Date' => 'date'
						),
						'description' => '',
                        'save_always' => true
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Order',
						'param_name' => 'order',
						'value' => array(
							'ASC' => 'ASC',
							'DESC' => 'DESC'
						),
						'description' => '',
                        'save_always' => true
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Category Slug',
						'param_name' => 'category',
						'description' => 'Leave empty for all or use comma for list'
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Image Size',
						'param_name' => 'image_size',
						'value' => array(
							'Default' => '',
							'Original' => 'original',
							'Landscape' => 'landscape',
							'Square' => 'square'
						),
						'description' => '',
						'dependency' => Array('element' => 'type', 'value' => array('boxes')),
                        'save_always' => true
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Text length',
						'param_name' => 'text_length',
						'description' => 'Number of characters'
					),
					array(
						'type' => 'dropdown',
						'class' => '',
						'heading' => 'Title Tag',
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'description' => ''
					)
				)
		) );

	}
	public function render($atts, $content = null) {
		
		$default_atts = array(
			'type' => 'boxes',
            'number_of_posts' => '',
            'number_of_columns' => '',
            'image_size' => '',
            'order_by' => '',
            'order' => '',
            'category' => '',
            'title_tag' => '',
			'text_length' => '90'
        );



		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['holder_classes'] = $this->getBlogHolderClasses($params);
	
		$queryArray = $this->generateBlogQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;	
		
        $thumbImageSize = $this->generateImageSize($params);
		$params['thumb_image_size'] = $thumbImageSize;
		$params['title_tag'] = $this->getTitleTag($params);


		$html ='';
        $html .= libero_mikado_get_shortcode_module_template_part('templates/blog-list-holder', 'blog-list', '', $params);
		return $html;
		
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getBlogHolderClasses($params){
		$holderClasses = '';
		
		$columnNumber = $this->getColumnNumberClass($params);
		
		if(!empty($params['type'])){
			switch($params['type']){
				case 'image_in_box':
					$holderClasses = 'mkd-image-in-box';
				break;
				case 'boxes' : 
					$holderClasses = 'mkd-boxes';
				break;
				case 'minimal' :
					$holderClasses = 'mkd-minimal';
				break;
				default: 
					$holderClasses = 'mkd-boxes';
			}
		}
		
		$holderClasses .= ' '.$columnNumber;
		
		return $holderClasses;
		
	}

	/** 
	   * Generates column classes for boxes type
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getColumnNumberClass($params){
		
		$columnsNumber = '';
		$type = $params['type'];
		$columns = $params['number_of_columns'];
		
        if ($type == 'boxes') {
            switch ($columns) {
                case 1:
                    $columnsNumber = 'mkd-one-column';
                    break;
                case 2:
                    $columnsNumber = 'mkd-two-columns';
                    break;
                case 3:
                    $columnsNumber = 'mkd-three-columns';
                    break;
                case 4:
                    $columnsNumber = 'mkd-four-columns';
                    break;
                default:
					$columnsNumber = 'mkd-one-column';
                    break;
            }
        }
		return $columnsNumber;
	}

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateBlogQueryArray($params){
		
		$queryArray = array(
			'orderby' => $params['order_by'],
			'order' => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'category_name' => $params['category']
		);
		return $queryArray;
	}

	/**
	   * Generates image size option
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function generateImageSize($params){
		$thumbImageSize = '';
		$image_size = '';
		if ($params['image_size'] == ''){
			if ($params['type'] == 'image_in_box'){
				$image_size = 'square';
			}
			else{
				$image_size = 'original';
			}
		}
		else{
			$image_size = $params['image_size'];
		}
		
		if ($image_size !== '' && $image_size == 'landscape') {
            $thumbImageSize .= 'libero_mikado_landscape';
        } else if($image_size === 'square'){
			$thumbImageSize .= 'libero_mikado_square';
		} else if ($image_size !== '' && $image_size == 'original') {
            $thumbImageSize .= 'full';
        }
		return $thumbImageSize;
	}

	/**
	   * Set title tag
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getTitleTag($params){
		$title_tag = '';

		if ($params['title_tag'] == ''){
			if ($params['type'] == 'image_in_box'){
				$title_tag = 'h4';
			}
			else{
				$title_tag = 'h3';
			}
		}
		else{
			$title_tag = $params['title_tag'];
		}

		return $title_tag;
	}

}
