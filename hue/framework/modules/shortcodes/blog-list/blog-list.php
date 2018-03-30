<?php

namespace Hue\Modules\BlogList;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

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

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                      => esc_html__('Blog List', 'hue'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
            'category'                  => 'by MIKADO',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Type', 'hue'),
                    'param_name'  => 'type',
                    'value'       => array(
                        esc_html__('Grid Type 1', 'hue')  => 'grid-type-1',
                        esc_html__('Grid Type 2', 'hue')  => 'grid-type-2',
                        esc_html__('Masonry', 'hue')      => 'masonry',
                        esc_html__('Minimal', 'hue')      => 'minimal',
                        esc_html__('Image in box', 'hue') => 'image-in-box'
                    ),
                    'description' => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Number of Posts', 'hue'),
                    'param_name'  => 'number_of_posts',
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Number of Columns', 'hue'),
                    'param_name'  => 'number_of_columns',
                    'value'       => array(
                        esc_html__('One', 'hue')   => '1',
                        esc_html__('Two', 'hue')   => '2',
                        esc_html__('Three', 'hue') => '3',
                        esc_html__('Four', 'hue')  => '4'
                    ),
                    'description' => '',
                    'dependency'  => Array('element' => 'type', 'value' => array('grid-type-1', 'grid-type-2')),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Order By', 'hue'),
                    'param_name'  => 'order_by',
                    'value'       => array(
                        esc_html__('Title', 'hue') => 'title',
                        esc_html__('Date', 'hue')  => 'date'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Order', 'hue'),
                    'param_name'  => 'order',
                    'value'       => array(
                        esc_html__('ASC', 'hue')  => 'ASC',
                        esc_html__('DESC', 'hue') => 'DESC'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Category Slug', 'hue'),
                    'param_name'  => 'category',
                    'description' => esc_html__('Leave empty for all or use comma for list', 'hue')
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Hide Image?', 'hue'),
                    'param_name'  => 'hide_image',
                    'value'       => array(
                        esc_html__('Default', 'hue') => '',
                        esc_html__('Yes', 'hue')     => 'yes',
                        esc_html__('No', 'hue')      => 'no'
                    ),
                    'description' => '',
                    'save_always' => true,
                    'dependency'  => array('element' => 'type', 'value' => array('grid-type-1', 'grid-type-2'))
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Image Size', 'hue'),
                    'param_name'  => 'image_size',
                    'value'       => array(
                        esc_html__('Original', 'hue')  => 'original',
                        esc_html__('Landscape', 'hue') => 'landscape',
                        esc_html__('Square', 'hue')    => 'square',
                        esc_html__('Custom', 'hue')    => 'custom'
                    ),
                    'description' => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Custom Image Size', 'hue'),
                    'param_name'  => 'custom_image_size',
                    'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'hue'),
                    'dependency'  => array('element' => 'image_size', 'value' => 'custom')
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Text length', 'hue'),
                    'param_name'  => 'text_length',
                    'description' => esc_html__('Number of characters', 'hue')
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Title Tag', 'hue'),
                    'param_name'  => 'title_tag',
                    'value'       => array(
                        ''   => '',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6',
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Style', 'hue'),
                    'param_name'  => 'style',
                    'value'       => array(
                        ''                         => '',
                        esc_html__('Light', 'hue') => 'light',
                        esc_html__('Dark', 'hue')  => 'dark'
                    ),
                    'description' => '',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array('grid-type-1', 'grid-type-2')
                    )
                )
            )
        ));

    }

    public function render($atts, $content = null) {

        $default_atts = array(
            'type'              => 'grid-type-1',
            'number_of_posts'   => '',
            'number_of_columns' => '',
            'image_size'        => 'original',
            'custom_image_size' => '',
            'order_by'          => '',
            'order'             => '',
            'category'          => '',
            'title_tag'         => 'h3',
            'text_length'       => '90',
            'hide_image'        => '',
            'style'             => ''
        );

        $params                   = shortcode_atts($default_atts, $atts);
        $params['holder_classes'] = $this->getBlogHolderClasses($params);

        if(empty($atts['title_tag'])) {
            if(in_array($params['type'], array('image-in-box', 'minimal'))) {
                $params['title_tag'] = 'h6';
            }
        }

        $queryArray             = $this->generateBlogQueryArray($params);
        $query_result           = new \WP_Query($queryArray);
        $params['query_result'] = $query_result;

        $params['use_custom_image_size'] = $params['image_size'] === 'custom' && !empty($params['custom_image_size']);

        if($params['use_custom_image_size']) {
            $params['custom_image_dimensions'] = $this->splitCustomImageSize($params['custom_image_size']);
        } else {
            $thumbImageSize             = $this->generateImageSize($params);
            $params['thumb_image_size'] = $thumbImageSize;
        }

        $params['hide_image'] = !empty($params['hide_image']) && $params['hide_image'] === 'yes';

        $html = '';
        $html .= hue_mikado_get_shortcode_module_template_part('templates/blog-list-holder', 'blog-list', '', $params);

        return $html;

    }

    /**
     * Generates holder classes
     *
     * @param $params
     *
     * @return string
     */
    private function getBlogHolderClasses($params) {
        $holderClasses = array(
            'mkd-blog-list-holder',
            $this->getColumnNumberClass($params),
            'mkd-'.$params['type']
        );

        if($params['hide_image'] === 'yes' && in_array($params['type'], array('grid-type-1', 'grid-type-2'))) {
            $holderClasses[] = 'mkd-blog-list-without-image';
        }

        if(in_array($params['type'], $this->getGridTypes())) {
            $holderClasses[] = 'mkd-blog-list-grid';

            if($params['style'] !== '') {
                $holderClasses[] = 'mkd-blog-list-'.$params['style'];
            }
        }

        return $holderClasses;

    }

    /**
     * Generates column classes for boxes type
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params) {

        $columnsNumber = '';
        $type          = $params['type'];
        $columns       = $params['number_of_columns'];

        if(in_array($type, $this->getGridTypes())) {
            switch($columns) {
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

    private function getGridTypes() {
        return array(
            'grid-type-1',
            'grid-type-2'
        );
    }

    /**
     * Generates query array
     *
     * @param $params
     *
     * @return array
     */
    public function generateBlogQueryArray($params) {

        $queryArray = array(
            'orderby'        => $params['order_by'],
            'order'          => $params['order'],
            'posts_per_page' => $params['number_of_posts'],
            'category_name'  => $params['category']
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
    private function generateImageSize($params) {
        $imageSize = $params['image_size'];

        switch($imageSize) {
            case 'landscape':
                $thumbImageSize = 'hue_mikado_landscape';
                break;
            case 'square';
                $thumbImageSize = 'hue_mikado_square';
                break;
            default:
                $thumbImageSize = 'full';
                break;
        }

        return $thumbImageSize;
    }

    private function splitCustomImageSize($customImageSize) {
        if(!empty($customImageSize)) {
            $imageSize = trim($customImageSize);
            //Find digits
            preg_match_all('/\d+/', $imageSize, $matches);
            if(!empty($matches[0])) {
                return array(
                    $matches[0][0],
                    $matches[0][1]
                );
            }
        }

        return false;
    }


}
