<?php

class HueMikadoLatestPosts extends HueMikadoWidget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkd_latest_posts_widget', // Base ID
            esc_html__('Mikado Latest Post', 'hue'), // Name
            array('description' => esc_html__('Display posts from your blog', 'hue'),) // Args
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Title', 'hue')
            ),
            array(
                'name'    => 'type',
                'type'    => 'dropdown',
                'title'   => esc_html__('Type', 'hue'),
                'options' => array(
                    'minimal'      => esc_html__('Minimal', 'hue'),
                    'image-in-box' => esc_html__('Image in box', 'hue')
                )
            ),
            array(
                'name'  => 'number_of_posts',
                'type'  => 'textfield',
                'title' => esc_html__('Number of posts', 'hue')
            ),
            array(
                'name'    => 'order_by',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order By', 'hue'),
                'options' => array(
                    'title' => esc_html__('Title', 'hue'),
                    'date'  => esc_html__('Date', 'hue')
                )
            ),
            array(
                'name'    => 'order',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order', 'hue'),
                'options' => array(
                    'ASC'  => esc_html__('ASC', 'hue'),
                    'DESC' => esc_html__('DESC', 'hue')
                )
            ),
            array(
                'name'    => 'image_size',
                'type'    => 'dropdown',
                'title'   => esc_html__('Image Size', 'hue'),
                'options' => array(
                    'original'  => esc_html__('Original', 'hue'),
                    'landscape' => esc_html__('Landscape', 'hue'),
                    'square'    => esc_html__('Square', 'hue'),
                    'custom'    => esc_html__('Custom', 'hue')
                )
            ),
            array(
                'name'  => 'custom_image_size',
                'type'  => 'textfield',
                'title' => esc_html__('Custom Image Size', 'hue')
            ),
            array(
                'name'  => 'category',
                'type'  => 'textfield',
                'title' => 'Category Slug'
            ),
            array(
                'name'  => 'text_length',
                'type'  => 'textfield',
                'title' => esc_html__('Number of characters', 'hue')
            ),
            array(
                'name'    => 'title_tag',
                'type'    => 'dropdown',
                'title'   => esc_html__('Title Tag', 'hue'),
                'options' => array(
                    ""   => "",
                    "h2" => "h2",
                    "h3" => "h3",
                    "h4" => "h4",
                    "h5" => "h5",
                    "h6" => "h6"
                )
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        //prepare variables
        $content        = '';
        $params         = array();
        $params['type'] = 'image_in_box';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }
        if(empty($params['title_tag'])) {
            $params['title_tag'] = 'h6';
        }
        echo '<div class="widget mkd-latest-posts-widget">';

        if(!empty($instance['title'])) {
            print $args['before_title'].$instance['title'].$args['after_title'];
        }

        echo hue_mikado_execute_shortcode('mkd_blog_list', $params);

        echo '</div>'; //close mkd-latest-posts-widget
    }
}
