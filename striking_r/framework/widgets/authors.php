<?php
/**
 * Authors Widget Class
 */
if (!class_exists('Theme_Widget_Authors')) {
class Theme_Widget_Authors extends WP_Widget {

	public function __construct(){
		$widget_ops = array('classname' => 'widget_authors', 'description' => __( 'Displays a list of author', 'theme_admin' ) );
		parent::__construct('authors', THEME_SLUG.' - '.__('Authors', 'theme_admin'), $widget_ops);
		
		if ('widgets.php' == basename($_SERVER['PHP_SELF'])) {
			add_action( 'admin_print_scripts', array(&$this, 'add_admin_script') );
		}
	}
	
	function get_all_author(){
		global $wpdb;
		$order = 'user_id';
		$user_ids = $wpdb->get_col($wpdb->prepare("SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta where meta_key='{$wpdb->prefix}user_level' and meta_value>=1 ORDER BY %s ASC",$order));

		foreach($user_ids as $user_id) :
			$user = get_userdata($user_id);
			$all_authors[$user_id] = $user->display_name;
		endforeach;
		return $all_authors;
	}
	
	function built_author_options($authors,$selected){
		$options = '';
		if(is_array($authors)){
			foreach($authors as $user_id => $display_name){
				$options .= '<option value="'.$user_id.'"'.selected($selected,$user_id).'>'.$display_name.'</option>';
			}
		}
		return $options;
	}
	
	function add_admin_script(){
		wp_enqueue_script( 'authors-widget', THEME_ADMIN_ASSETS_URI . '/js/authors-widget.js', array('jquery'));
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Authors', 'striking-r') : $instance['title'], $instance, $this->id_base);

		$count = (int)$instance['count'];

		$output = '';
		if( $count > 0){
			$output .= '<ul class="authors_list">';

			for($i=1; $i<= $count; $i++){
				$id = isset($instance['author_'.$i.'_id'])?$instance['author_'.$i.'_id']:'';
				if($id){
					$desc = !empty($instance['author_'.$i.'_desc'])?$instance['author_'.$i.'_desc']:get_the_author_meta('description',$id);
					$desc  = do_shortcode($desc);				
					$output .= '<li><div class="gravatar">'.get_avatar( get_the_author_meta('user_email',$id), '60' ).'</div><div class="author_name"><a href="'.get_author_posts_url( $id, get_the_author_meta('user_nicename',$id) ).'">'.get_the_author_meta('display_name',$id).'</a></div><div class="author_desc">'.$desc.'</div></li>';
				}
			}
			$output .= '</ul>';
		}
		
		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
			echo $output;
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = (int) $new_instance['count'];
		for($i=1;$i<=$instance['count'];$i++){
			$instance['author_'.$i.'_id'] = strip_tags($new_instance['author_'.$i.'_id']);
			$instance['author_'.$i.'_desc'] = strip_tags($new_instance['author_'.$i.'_desc']);
		}
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		for($i=1;$i<=10;$i++){
			$author_id = 'author_'.$i.'_id';
			$$author_id = isset($instance[$author_id]) ? $instance[$author_id] : '';
			$author_desc = 'author_'.$i.'_desc';
			$$author_desc = isset($instance[$author_desc]) ? $instance[$author_desc] : '';
		}
		$authors = $this->get_all_author();
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many authors to display?', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('count'); ?>" class="author_count" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>

		<div class="authors_wrap">
		<?php for($i=1;$i<=10;$i++): $author_id = 'author_'.$i.'_id';$author_desc = 'author_'.$i.'_desc'; ?>
			<div class="author_<?php echo $i;?>" <?php if($i>$count):?>style="display:none"<?php endif;?>>
				<p>
					<label for="<?php echo $this->get_field_id($author_id); ?>"><?php printf(__('#%s Author:', 'theme_admin'),$i);?></label>
					<select name="<?php echo $this->get_field_name($author_id); ?>" id="<?php echo $this->get_field_id($author_id); ?>" class="widefat">
						<?php echo $this->built_author_options($authors,$$author_id);?>
					</select>
				</p>
				
				<p><label for="<?php echo $this->get_field_id( $author_desc ); ?>"><?php printf(__('#%s Author Desc (Optional)&#x200E;:', 'theme_admin'),$i);?></label>
				<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id($author_desc); ?>" name="<?php echo $this->get_field_name($author_desc); ?>"><?php echo $$author_desc; ?></textarea>
			</div>

		<?php endfor;?>
		</div>
<?php
	}
}
}