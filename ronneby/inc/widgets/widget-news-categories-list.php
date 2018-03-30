<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(dirname(__FILE__).'/widget.php');

class crum_news_categories_list extends SB_WP_Widget {
	
	protected $widget_base_id = 'crum_news_categories_list';
	protected $widget_name = 'Widget: News categories list';
	
	protected $options;
	
	 public function __construct() {
		$this->widget_params = array(
			'description' => __('News categories list widget', 'dfd')
		);
		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => __('Title', 'dfd'), 
				'input'=>'text', 
				'filters'=>'widget_title', 
				'on_update'=>'esc_attr',
			),

			array(
				'cat', 'array', '',
				'label' => __('News categories IDs', 'dfd'),
				'input' => 'wp_category_checklist',
			)
		);
		
        parent::__construct();
    }
	
	function widget( $args, $instance ) {
        extract( $args );
		$this->setInstances($instance, 'filter');
		
		$title = $this->getInstance('title');
		$categories = (array) $this->getInstance('cat');
		
        echo $before_widget;
		
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
		}
		?>

		<div class="row">
			<ul>
				<?php foreach ($categories as $cat) : ?>
				<?php 
					$cat_obj = get_category_by_slug($cat);
					if (empty($cat_obj) || !is_object($cat_obj)) {
						continue;
					}
					
					$cat_link = get_category_link($cat_obj);
					$cat_name = $cat_obj->name;
				?>
				<li class="six column"><a href="<?php echo esc_url($cat_link); ?>"><?php echo $cat_name; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php
        echo $after_widget;
    }
	
}