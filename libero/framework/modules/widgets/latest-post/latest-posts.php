<?php

class LiberoLatestPosts extends LiberoWidget {
	protected $params;
	public function __construct() {
		parent::__construct(
			'mkd_latest_posts_widget', // Base ID
			'Mikado Latest Posts', // Name
			array( 'description' => esc_html__( 'Display posts from your blog', 'libero' ), ) // Args
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'name' => 'title',
				'type' => 'textfield',
				'title' => 'Title',
				'value' => 'Latest Blog Posts'
			),
			array(
				'name' => 'number_of_posts',
				'type' => 'textfield',
				'title' => 'Number of posts'
			),
			array(
				'name' => 'order_by',
				'type' => 'dropdown',
				'title' => 'Order By',
				'options' => array(
					'title' => 'Title',
					'date' => 'Date'
				)
			),
			array(
				'name' => 'order',
				'type' => 'dropdown',
				'title' => 'Order',
				'options' => array(
					'ASC' => 'ASC',
					'DESC' => 'DESC'
				)
			),
			array(
				'name' => 'category',
				'type' => 'textfield',
				'title' => 'Category Slug'
			),
			array(
				'name' => 'text_length',
				'type' => 'textfield',
				'title' => 'Number of characters'
			),
			array(
				'name' => 'title_tag',
				'type' => 'dropdown',
				'title' => 'Title Tag',
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
		extract($instance);

		//prepare variables
		$content        = '';
		$params         = array();
		$params['type'] = 'image_in_box';
		$params['image_size'] = 'square';
		//is instance empty?
		if(is_array($instance) && count($instance)) {
			//generate shortcode params
			foreach($instance as $key => $value) {
				$params[$key] = $value;
			}
		}
		if(empty($params['title_tag'])){
			$params['title_tag'] = 'h6';
		}
		if(empty($params['text_length'])){
			$params['text_length'] = '0';
		}
		echo '<div class="widget mkd-latest-posts-widget">';
		
		if (isset($title) && $title !== ''){
			echo '<h4>'.esc_html($title).'</h4>';
		}

		echo libero_mikado_execute_shortcode('mkd_blog_list', $params);

		echo '</div>'; //close mkd-latest-posts-widget
	}
}
