<?php

/**************************************
WIDGET: inspire_sidebar_posts
***************************************/

	add_action('widgets_init', 'register_widget_inspire_sidebar_posts' );
	function register_widget_inspire_sidebar_posts () {
		register_widget('inspire_sidebar_posts');	
	}

	class inspire_sidebar_posts extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'inspire_sidebar_posts', 								
					'description' =>'Display latest posts or posts from a category' 				
				);
				$control_ops = array(
					'id_base' => 'inspire_sidebar_posts' 														
				);

				parent::__construct('inspire_sidebar_posts','Inspire: Posts', $widget_ops, $control_ops );	
		}

		/**************************************
		2. UPDATE
		***************************************/
		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		/**************************************
		3. FORM
		***************************************/
		function form($instance) {

			//defaults
			$defaults = array( 
				'widget_title' => 'More posts',
				'posts_from' => 'latest_posts', 
				'style' => 'style_grid',
				'num_posts' => 6 
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('posts_from'); ?> ">What to show: </label><br>
					<select id="<?php echo $this->get_field_id('posts_from'); ?>" name="<?php echo $this->get_field_name('posts_from'); ?>"> 
	     			<option value="latest_posts" <?php if (isset($posts_from)) {if ($posts_from == "latest_posts") echo "selected='selected'";} ?>>Latest posts</option> 
<!-- 	     			
	     			<option value="post-format-audio" <?php if (isset($posts_from)) {if ($posts_from == "post-format-audio") echo "selected='selected'";} ?>>Latest audio</option> 
	     			<option value="post-format-video" <?php if (isset($posts_from)) {if ($posts_from == "post-format-video") echo "selected='selected'";} ?>>Latest videos</option> 
	     			<option value="post-format-gallery" <?php if (isset($posts_from)) {if ($posts_from == "post-format-gallery") echo "selected='selected'";} ?>>Latest galleries</option> 
 -->	     			
 					<option value="random_posts" <?php if (isset($posts_from)) {if ($posts_from == "random_posts") echo "selected='selected'";} ?>>Random posts</option> 
	     			<option value=""><hr></option> 
	     			<?php 
	     				$categories = get_categories(array(
	     					'orderby' => 'name',
	     					'order' => 'ASC'
	     				));
	     				foreach ($categories as $single_category) {
	     				?>
	     					<option value="<?php echo $single_category->name; ?>" <?php if (isset($posts_from)) {if ($posts_from == "$single_category->name") echo "selected='selected'";} ?>><?php echo $single_category->name; ?> category</option> 
	     				<?php	     						
	     				}
	     			 ?>

					</select> 
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('style'); ?> ">Default style: </label><br>
					<select id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>"> 
	     			<option value="style_list" <?php if (isset($style)) {if ($style == "style_list") echo "selected='selected'";} ?>>List view</option> 
	     			<option value="style_grid" <?php if (isset($style)) {if ($style == "style_grid") echo "selected='selected'";} ?>>Grid view</option> 
					</select> 
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('num_posts'); ?>'>Number of posts: </label><br>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='100'
						id='<?php echo $this->get_field_id('num_posts'); ?>' 
						name='<?php echo $this->get_field_name('num_posts'); ?>' 
						value='<?php if (isset($num_posts)) echo esc_attr($num_posts); ?>'
					>
				</p>

			<?php
		}

		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								
			extract($instance);	

			// DEFAULTS
			if (empty($instance)) {
				$widget_title 		= 'More posts';
				$posts_from 		= 'latest_posts'; 
				$style 				= 'style_grid';
				$num_posts 			= 6;
			}

			if ($posts_from == "latest_posts") {
				$results_query = get_posts(array(
					'numberposts' 		=> $num_posts,
					'offset' 			=> 0,
					'category'			=> '',
					'orderby'			=> 'post_date',
					'order'				=> 'DESC',
					'post_type'    		=> 'post',
					'post_status'     	=> 'publish',
					'suppress_filters' 	=> true
				));
			} elseif ($posts_from == "post-format-audio" || $posts_from == "post-format-video" || $posts_from == "post-format-gallery") {
				$results_query = get_posts(array(
					'numberposts' 		=> $num_posts,
					'offset' 			=> 0,
					'category'			=> '',
					'orderby'			=> 'post_date',
					'order'				=> 'DESC',
					'post_type'    		=> 'post',
					'post_status'     	=> 'publish',
					'suppress_filters' 	=> true,
					'tax_query' => array(
						array(
							'taxonomy' 	=> 'post_format',
							'field' 	=> 'slug',
							'terms' 	=> array($posts_from),
							'operator' 	=> 'IN'
						)
					)
				));
			} elseif ($posts_from == "random_posts") {
				$results_query = get_posts(array(
					'numberposts' 		=> $num_posts,
					'orderby'			=> 'rand',
					'post_type'    		=> 'post',
					'post_status'     	=> 'publish',
					'suppress_filters' 	=> true
				));
			} else {
				$results_query = get_posts(array(
					'numberposts' 		=> $num_posts,
					'offset' 			=> 0,
					'category'			=> get_cat_ID($posts_from),
					'orderby'			=> 'post_date',
					'order'				=> 'DESC',
					'post_type'    		=> 'post',
					'post_status'     	=> 'publish',
					'suppress_filters' => true
				));

	
			}

			//if less posts in query set num_posts to num query posts
			if (count($results_query) < $num_posts) $num_posts = count($results_query);


			?>

			<?php echo $before_widget; ?>
			<?php echo $before_title . $widget_title; ?> 
			<span class="grid"><img src="<?php echo get_template_directory_uri(); ?>/images/grid.png" alt="" /></span>
			<span class="list"><img src="<?php echo get_template_directory_uri(); ?>/images/list.png" alt="" /></span> 
			<?php echo $after_title; ?>

			<div id='default_view' data-default_view='<?php echo $style; ?>'></div>

			<div class='list_view'>

			<?php 
				for ($i = 0; $i < $num_posts; $i++) { 
				?> 

					<div class="widget-item">

					<?php 
						if (has_post_thumbnail($results_query[$i]->ID)) { 
							printf("<a href='%s'>%s</a>", esc_url(get_permalink($results_query[$i]->ID)),get_the_post_thumbnail($results_query[$i]->ID,'sidebar_list_thumb'));
						} else {
							printf("<a href='%s'><img src='%s'></a>", esc_url(get_permalink($results_query[$i]->ID)), esc_url(get_template_directory_uri()."/images/default_sidebar_list_thumb.jpg"));
						}
					?>
						
						<h3><a href="<?php echo get_permalink($results_query[$i]->ID); ?>"><?php echo $results_query[$i]->post_title; ?></a></h3>
						<span class="meta"><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_query[$i]->post_date));?></span>
						
					</div>

				<?php
				}
			?>

			</div>

			<div class="grid_view">

			<?php 
				for ($i = 0; $i < $num_posts; $i++) { 

					$img_class = ($i%2) ? "widget-img last" : "widget-img";

				?> 

					<?php 
						if (has_post_thumbnail($results_query[$i]->ID)) { 
							printf("<a href='%s'>%s</a>", esc_url(get_permalink($results_query[$i]->ID)),get_the_post_thumbnail($results_query[$i]->ID,'sidebar_grid_thumb',array('class'=>$img_class)));
						} else {
							printf("<a href='%s'><img src='%s'></a>", esc_url(get_permalink($results_query[$i]->ID)), esc_url(get_template_directory_uri()."/images/default_sidebar_grid_thumb.jpg"));
						}
					?>
						
				<?php
				}
			?>

			</div>

			<?php echo $after_widget; ?>

			<?php
		}

	} //END CLASS



