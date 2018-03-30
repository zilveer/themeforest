<?php
class Veda_Portfolio_Widget extends WP_Widget {
	#1.constructor
	function __construct() {
		$widget_options = array("classname"=>'widget_popular_entries', 'description'=>esc_html__('To list out portfolio items', 'veda'));
		parent::__construct(false,THEME_NAME.esc_html__(' Portfolio','veda'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array('title'=>'','_post_count'=>'','_post_categories'=>'') );
		$title = strip_tags($instance['title']);
		$_post_count = !empty($instance['_post_count']) ? strip_tags($instance['_post_count']) : "-1";
		$_post_categories = !empty($instance['_post_categories']) ? $instance['_post_categories']: array();?>
        
        <!-- Form -->
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','veda');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
           
	    <p><label for="<?php echo $this->get_field_id('_post_categories'); ?>">
			<?php esc_html_e('Choose the categories you want to display (multiple selection possible)','veda');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('_post_categories').'[]';?>" 
            	name="<?php echo $this->get_field_name('_post_categories').'[]';?>" multiple="multiple">
                <option value=""><?php esc_html_e("Select",'veda');?></option>
           	<?php $cats = get_categories('taxonomy=portfolio_entries&hide_empty=1');
			foreach ($cats as $cat):
				$id = esc_attr($cat->term_id);
				$selected = ( in_array($id,$_post_categories)) ? 'selected="selected"' : '';
				$title = esc_html($cat->name);
				echo "<option value='{$id}' {$selected}>{$title}</option>";
			endforeach;?>
            </select></p>

	    <p><label for="<?php echo $this->get_field_id('_post_count'); ?>"><?php esc_html_e('No.of posts to show:','veda');?></label>
		   <input id="<?php echo $this->get_field_id('_post_count'); ?>" name="<?php echo $this->get_field_name('_post_count'); ?>" value="<?php echo esc_attr($_post_count);?>" /></p>
        <!-- Form end-->
<?php
	}
	#3.processes & saves the twitter widget option
	function update( $new_instance,$old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['_post_count'] = strip_tags($new_instance['_post_count']);
		$instance['_post_categories'] = $new_instance['_post_categories'];
		return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
		global $post;
		$title = empty($instance['title']) ?'' : apply_filters('widget_title', $instance['title']);
		$_post_count = (int) $instance['_post_count'];
		$_post_categories = "";
		if(!empty($instance['_post_categories']) && is_array($instance['_post_categories'])):
			$_post_categories =  array_filter($instance['_post_categories']);
		elseif(!empty($instance['_post_categories'])):
			$_post_categories = explode(",",$instance['_post_categories']);
		endif;
		
		$arg = array('posts_per_page' => $_post_count ,'post_type' => 'dt_portfolios');
		$arg = empty($_post_categories) ? $arg : array(
											'posts_per_page'=> $_post_count,
											'tax_query'		=> array(array( 'taxonomy'=>'portfolio_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$_post_categories ) ));
		echo $before_widget;
		if ( !empty( $title ) ) echo $before_title.$title.$after_title;		
		echo "<div class='recent-portfolio-widget'><ul>";
			 $the_query = new WP_Query($arg);
			 if($the_query->have_posts()) :
				 while($the_query->have_posts()):
					$the_query->the_post();

					echo "<li>";
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'thumbnail',false);
						$image = ( $image != false)? $image[0] : VEDA_THEME_URI . '/images/dummy-images/post-thumb.jpg';
						echo "<a href='".get_permalink()."' class='thumb'>";
							echo "<img src='{$image}' alt='{$title}'/>";
						echo "</a>";
					echo "</li>";

				 endwhile;
			 else:
			 	echo "<li>".esc_html__('No Portfolio Entries found','veda')."</li>";
			 endif;
			 wp_reset_postdata();
	 	echo "</ul></div>";			 
		echo $after_widget;
	}
}?>