<?php 
if(!class_exists('WP_Widget_Productaz')){
	class WP_Widget_Productaz extends WP_Widget {
		function __construct() {
			$widget_ops = array('classname' => 'widget_productaz', 'description' => __( 'This widget show list a-z of your products','wpdance') );
			
			add_action ('pre_get_posts',array($this,'add_a2z_query'),9);
			
			parent::__construct('productaz', __('WD - Product A to Z','wpdance'), $widget_ops);
		}

		function add_a2z_query($query){
			if($query->is_search()){	
				if( isset($_GET['producta2z']) && (int)($_GET['producta2z']) == 1 && strcmp(get_query_var('post_type'),'product') == 0 ){
					set_query_var('start_char',get_query_var('s'));
					add_action( "posts_where", array($this,"add_a2z_query_to_post_where"), 11 );
				
				}
			}
		}
		
		function add_a2z_query_to_post_where($where_query){
			$_start_char = get_query_var('start_char');
			$_up_char = strtoupper($_start_char);
			$_down_char = strtolower($_start_char);
			global $wpdb;
			$thisPreFix = $wpdb->base_prefix;
			$where_query .= " AND left({$thisPreFix}posts.post_title,1) IN ('{$_up_char}','{$_down_char}') ";
			//echo $where_query	;
			return $where_query;
		}		
		
		function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Pages','wpdance' ) : $instance['title'], $instance, $this->id_base);

			
			

			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
			?>
			<div class="alphabet-products">
				<ul>
					<?php
					for ($i = ord('A'); $i <= ord('Z'); $i++){
						$_cur_char = chr($i);
						$_search_link = get_search_link(chr($i));
						$_search_link = esc_url( add_query_arg( array("post_type"=>"product","producta2z"=>"1"),$_search_link ) );
						echo "<li><a href='{$_search_link}'>{$_cur_char}</a></li>";
					}
					for ($i = 1; $i <= 9; $i++){
						$_search_link = get_search_link($i);
						$_search_link = esc_url( add_query_arg( array("post_type"=>"product","producta2z"=>"1"),$_search_link ) );					
						echo "<li><a href='{$_search_link}'>{$i}</a></li>";
					}					
					?>
				</ul>
			</div>
			<?php
			echo $after_widget;
			
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}

		function form( $instance ) {
			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'PRODUCT BY A-Z') );
			$title = esc_attr( $instance['title'] );
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','wpdance'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

	<?php
		}

	}
}
?>