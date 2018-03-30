<?php
/**
 * Plugin Name: Goodlayers Fixture and Result Widget
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show fixtures and results( Specified by category ).
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'gdlr_fixture_result_widget' );
if( !function_exists('gdlr_fixture_result_widget') ){
	function gdlr_fixture_result_widget() {
		register_widget( 'Goodlayers_Fixture_Result' );
	}
}

if( !class_exists('Goodlayers_Fixture_Result') ){
	class Goodlayers_Fixture_Result extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'gdlr-fixture-result-widget', 
				__('Goodlayers Fixtures & Results Widget','gdlr_translate'), 
				array('description' => __('A widget that show fixtures and results', 'gdlr_translate')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $theme_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$category = $instance['category'];
			$num_fetch = $instance['num_fetch'];
			$full_table_text = $instance['full_table_text'];
			$full_table_link = $instance['full_table_link'];
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . $title . $args['after_title']; 
			}
				
			if( function_exists('gdlr_print_fixture_result_item') ){
				gdlr_print_fixture_result_item(array(
					'style' => 'summary',
					'button-link' => $full_table_link,
					'button-text' => $full_table_text,
					'num-fetch' => $num_fetch,
					'category' => $category
				));
			}
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$category = isset($instance['category'])? $instance['category']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: 3;
			$full_table_text = isset($instance['full_table_text'])? $instance['full_table_text']: __('View All Fixtures', 'gdlr_translate');
			$full_table_link = isset($instance['full_table_link'])? $instance['full_table_link']: '';
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :', 'gdlr_translate'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>		

			<!-- Post Category -->
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category :', 'gdlr_translate'); ?></label>		
				<select class="widefat" name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>">
				<option value="" <?php if(empty($category)) echo ' selected '; ?>><?php _e('All', 'gdlr_translate') ?></option>
				<?php 	
				$category_list = gdlr_get_term_list('result_category'); 
				foreach($category_list as $cat_slug => $cat_name){ ?>
					<option value="<?php echo $cat_slug; ?>" <?php if ($category == $cat_slug) echo ' selected '; ?>><?php echo $cat_name; ?></option>				
				<?php } ?>	
				</select> 
			</p>
				
			<!-- Show Num --> 
			<p>
				<label for="<?php echo $this->get_field_id('num_fetch'); ?>"><?php _e('Num Fetch :', 'gdlr_translate'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('num_fetch'); ?>" name="<?php echo $this->get_field_name('num_fetch'); ?>" type="text" value="<?php echo $num_fetch; ?>" />
			</p>
			
			<!-- Full Table Text -->
			<p>
				<label for="<?php echo $this->get_field_id('full_table_text'); ?>"><?php _e('Full Table Text :', 'gdlr_translate'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('full_table_text'); ?>" name="<?php echo $this->get_field_name('full_table_text'); ?>" type="text" value="<?php echo $full_table_text; ?>" />
			</p>	

			<!-- Full Table Link -->
			<p>
				<label for="<?php echo $this->get_field_id('full_table_link'); ?>"><?php _e('Full Table Link :', 'gdlr_translate'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('full_table_link'); ?>" name="<?php echo $this->get_field_name('full_table_link'); ?>" type="text" value="<?php echo $full_table_link; ?>" />
			</p>				

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['category'] = (empty($new_instance['category']))? '': strip_tags($new_instance['category']);
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);
			$instance['full_table_text'] = (empty($new_instance['full_table_text']))? '': strip_tags($new_instance['full_table_text']);
			$instance['full_table_link'] = (empty($new_instance['full_table_link']))? '': strip_tags($new_instance['full_table_link']);

			return $instance;
		}	
	}
}
?>