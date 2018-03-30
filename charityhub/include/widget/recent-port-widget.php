<?php
/**
 * Plugin Name: Goodlayers Recent Portfolio
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show recent portfolio( Specified by category ).
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'gdlr_recent_portfolio_widget' );
if( !function_exists('gdlr_recent_portfolio_widget') ){
	function gdlr_recent_portfolio_widget() {
		register_widget( 'Goodlayers_Recent_Portfolio' );
	}
}

if( !class_exists('Goodlayers_Recent_Portfolio') ){
	class Goodlayers_Recent_Portfolio extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'gdlr-recent-portfolio-widget', 
				__('Goodlayers Recent Portfolio Widget','gdlr_translate'), 
				array('description' => __('A widget that show lastest portfolios', 'gdlr_translate')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $theme_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$category = $instance['category'];
			$num_fetch = $instance['num_fetch'];
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . $title . $args['after_title']; 
			}
				
			// Widget Content
			$current_post = array(get_the_ID());		
			$query_args = array('post_type' => 'portfolio', 'suppress_filters' => false);
			$query_args['posts_per_page'] = $num_fetch;
			$query_args['orderby'] = 'post_date';
			$query_args['order'] = 'desc';
			$query_args['paged'] = 1;
			$query_args['portfolio_category'] = $category;
			$query_args['post__not_in'] = array(get_the_ID());
			$query = new WP_Query( $query_args );
			
			if($query->have_posts()){
				echo '<div class="gdlr-recent-port-widget">';
				while($query->have_posts()){ $query->the_post();
					echo '<div class="recent-post-widget">';
					$thumbnail = gdlr_get_image(get_post_thumbnail_id(), 'thumbnail');
					if( !empty($thumbnail) ){
						echo '<div class="recent-post-widget-thumbnail"><a href="' . get_permalink() . '" >' . $thumbnail . '</a></div>';
					}
					echo '<div class="recent-post-widget-content">';
					echo '<div class="recent-post-widget-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></div>';
					echo '<div class="recent-post-widget-info">' . gdlr_get_blog_info(array('date'), false) . '</div>';
					echo '</div>';
					echo '<div class="clear"></div>';
					echo '</div>';
				}
				echo '<div class="clear"></div>';
				echo '</div>';
			}
			wp_reset_postdata();
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$category = isset($instance['category'])? $instance['category']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: 3;
			
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
				$category_list = gdlr_get_term_list('portfolio_category'); 
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

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['category'] = (empty($new_instance['category']))? '': strip_tags($new_instance['category']);
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);

			return $instance;
		}	
	}
}
?>