<?php /* Plumtree Search */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'widgets_init', create_function( '', 'register_widget( "pt_search_widget");' ) );

class pt_search_widget extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
	 		'pt_search_widget', // Base ID
			__('PT Search', 'plumtree'), // Name
			array('description' => __( "Plum Tree special widget. A search form for your site.", 'plumtree' ), ) 
		);
	}

	public function form($instance) {
		$defaults = array(
			'title' => 'Search Field',
			'search-input' => 'Text here...',
			'search-button' => 'Find',
			'category-search' => false,
			'search-in' => 'category',
			'exclude' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title: ', 'plumtree' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Input Text: ', 'plumtree' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('search-input') ); ?>" name="<?php echo esc_attr( $this->get_field_name('search-input') ); ?>" type="text" value="<?php echo esc_attr( $instance['search-input'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Button Title Text: ', 'plumtree' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('search-button') ); ?>" name="<?php echo esc_attr( $this->get_field_name('search-button') ); ?>" type="text" value="<?php echo esc_attr( $instance['search-button'] ); ?>" />
		</p>
		<p>
    	    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("category-search"); ?>" name="<?php echo $this->get_field_name("category-search"); ?>" <?php checked( (bool) $instance["category-search"] ); ?> />
            <label for="<?php echo $this->get_field_id("category-search"); ?>"><?php _e( 'Add "search in category" dropdown?', 'plumtree' ); ?></label>
        </p>
		<p><?php _e('Select which categories to display','plumtree'); ?></p><p>
		<?php
		$typeoptions = array (
							"category" => __("Post categories",'plumtree'),
							"product_cat" => __("Product categories",'plumtree'),
		);
		foreach ($typeoptions as $val => $html) {
			$checked = '';
			$output = '<input type="radio" value="'.$val.'" id="'.$this->get_field_id('search-in').'-'.$val.'" name="'.$this->get_field_name('search-in').'" ';
			if($instance['search-in']==$val) { $checked = 'checked="checked"'; } 
			$output .= $checked.' class="radio" /><label for="'.$this->get_field_id('search-in').'-'.$val.'">'.$html.'</label><br />';
			echo $output;
		};
		?></p>
		<p>
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude next categories(a comma-separated list of categories by unique ID, in ascending order): ', 'plumtree' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('exclude') ); ?>" name="<?php echo esc_attr( $this->get_field_name('exclude') ); ?>" type="text" value="<?php echo esc_attr( $instance['exclude'] ); ?>" />
		</p>

	<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['search-input'] = strip_tags( $new_instance['search-input'] );
		$instance['search-button'] = strip_tags( $new_instance['search-button'] );
		$instance['category-search'] = $new_instance['category-search'];
		$instance['search-in'] = $new_instance['search-in'];
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title'] );
		$text = ( isset($instance['search-input']) ? $instance['search-input'] : 'Text here...' );
		$button = ( isset($instance['search-button']) ? $instance['search-button'] : 'Find' );
		$category_search = ( isset($instance['category-search']) ? $instance['category-search'] : false );
		$search_in = ( isset($instance['search-in']) ? $instance['search-in'] : '' );
		$exclude = ( isset($instance['exclude']) ? $instance['exclude'] : '' );

		echo $before_widget;
		if ($title) { echo $before_title . $title . $after_title; }
	?>

	<form class="pt-searchform" method="get" action="<?php echo esc_url( home_url() ); ?>">
		<input id="s" name="s" type="text" class="searchtext" value="" placeholder="<?php echo esc_attr( $text ); ?>" tabindex="1">
		
		<?php if ($category_search) {
			$select_output = '';
			$args = array(
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hierarchical'             => 0,
				'exclude'                  => $exclude,
				'taxonomy'                 => $search_in,
			);
			$categories = get_categories( $args );
			if ($categories) {
				if ($search_in == 'product_cat') { $select_name = 'product_cat'; } else { $select_name = 'category_name'; }
				$select_output = '<select class="search-select" name="'.$select_name.'">';
				$select_output .= '<option value="">'.__('All Categories', 'plumtree').'</option>';
				foreach ($categories as $category) {
					$select_output .= '<option value="'.$category->slug.'">'.$category->name.'</option>';
				}
				$select_output .= '</select>';
			}
			echo $select_output;
		}?>

		<button id="searchsubmit" class="search-button" title="<?php echo esc_attr( $button ); ?>" tabindex="2"><i class="custom-icon-search"></i></button>
		
		<?php if ($search_in == 'product_cat') {
			echo '<input type="hidden" name="post_type" value="product" />';
		}?>

	</form>		

	<?php
		echo $after_widget;
	}

}