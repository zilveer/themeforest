<?php
#
# RT-Theme Latest Posts With Thumbnails
#

class Latest_Posts extends WP_Widget {

	function Latest_Posts() {
		$opts =array(
					'classname' 	=> 'widget_latest_posts',
					'description' 	=> __( 'The most recent posts on your site with post thumbnails.', 'rt_theme_admin' )
				);

		parent::__construct('latest_posts', '['. THEMENAME.']   '.__('Recent Posts ', 'rt_theme_admin'), $opts);
	}
	

	function widget( $args, $instance ) {
		extract( $args ); 

		$title			=	apply_filters('widget_title', $instance['title']) ;		 
		$categories		=	empty($instance['categories']) ? $instance['categories'] : implode($instance['categories'],',') ; 
		$count 			= 	empty($instance['count']) ? 5 : $instance['count'];
		$limit			=  	empty($instance['limit']) ? 100 : $instance['limit'];
		$show_thumbnails	=	$instance['show_thumbnails'];
		$show_excerpt		=	$instance['show_excerpt'];
		$all_post_formats	=	$instance['all_post_formats'];
		$thumb_width		=  	empty($instance['thumb_width']) ? 50 : $instance['thumb_width'];
		$thumb_height		=  	empty($instance['thumb_height']) ? 50 : $instance['thumb_height'];
	 	
		
		//remove aside and quote post formats from the list
		$postargs			=	($all_post_formats) ?
							array('post_type'=>'post','showposts'=>$count,'cat'=>$categories, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1 ) :
							array('tax_query' => array( array( 'operator' => 'NOT IN', 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-quote' , 'post-format-aside' ) ) ),'post_type'=>'post','showposts'=>$count,'cat'=>$categories, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1 ) ;
							
		$post_query 		= 	new WP_Query($postargs); 
		
		$rt_posts = '<div class="recent_posts clearfix"><ul>';
		
										
		if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
						
			$post_title		=	get_the_title();
			$link			=	get_permalink();
			$date			=	get_the_time('d M Y');
			$rt_gallery_images 			= (get_post_meta( $post_query->post->ID, THEMESLUG . "rt_gallery_images", true )) ? get_post_meta( $post_query->post->ID, THEMESLUG . "rt_gallery_images", true ) : "";
			$rt_gallery_image_titles 	= (get_post_meta( $post_query->post->ID, THEMESLUG . "rt_gallery_image_titles", true )) ? get_post_meta( $post_query->post->ID, THEMESLUG . "rt_gallery_image_titles", true ) : "";
			$rt_gallery_image_descs 		= (get_post_meta( $post_query->post->ID, THEMESLUG . "rt_gallery_image_descs", true )) ? get_post_meta( $post_query->post->ID, THEMESLUG . "rt_gallery_image_descs", true ) : "";
			$fist_featured_image		= (is_array($rt_gallery_images)) ? find_image_org_path($rt_gallery_images[0]) : "";
		  
			$rt_posts .='<li class="clearfix">';
			
			if ( $fist_featured_image && !$show_thumbnails) : 
				$f_thumb 		= 	get_post_thumbnail_id(); 
				$f_image 		= 	@vt_resize('', $fist_featured_image, $thumb_width, $thumb_height, true );			
				if($f_image["url"]) $rt_posts .=	'<img src="'. $f_image["url"] .'" alt="'. $title .'" class="recent-posts-thumb" />';
			endif;
			
	
			$rt_posts .='<span class="date">'.$date.'</span>';
			$rt_posts .='<span class="title"><a href="'.$link.'">'.$post_title.'</a></span>';			
			$rt_posts .= ($show_excerpt) ? ''.wp_html_excerpt(get_the_excerpt(),$limit).'... <div class="space margin-b10"></div>' : "" ;
			$rt_posts .='</li>';

		endwhile;endif;wp_reset_query();
		$rt_posts .= '</ul></div>';

		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		echo $rt_posts;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		 
		$instance = $old_instance;
		$instance['title']			= strip_tags($new_instance['title']); 
		$instance['categories']		= $new_instance['categories'];
		$instance['newWidget']		= $new_instance['newWidget']; 
		$instance['limit']			= (int) $new_instance['limit'];
		$instance['count']			= (int) $new_instance['count'];
		$instance['show_thumbnails']	= !empty($new_instance['show_thumbnails']) ? 1 : 0;
		$instance['show_excerpt']	= !empty($new_instance['show_excerpt']) ? 1 : 0;
		$instance['all_post_formats']	= !empty($new_instance['all_post_formats']) ? 1 : 0;
		$instance['thumb_width']		= !empty($new_instance['thumb_width']) ? intval($new_instance['thumb_width']) : 50;
		$instance['thumb_height']	= !empty($new_instance['thumb_height']) ? intval($new_instance['thumb_height']) : 50; 

		return $instance;
	}

	function form( $instance ) {
		$title 			= 	isset($instance['title']) ? esc_attr($instance['title']) : '';
		$categories 		=	isset($instance['categories']) ? $instance['categories'] : array();
		$newWidget		= 	isset($instance['newWidget']) ? $instance['newWidget']: '';
		$limit			=	empty($instance['limit']) ? 100 : $instance['limit'];
		$count			=	empty($instance['count']) ? 5 : $instance['count'];
		$show_thumbnails	=	isset($instance['show_thumbnails']) ? $instance['show_thumbnails']: '';
		$show_excerpt		=	isset($instance['show_excerpt']) ? $instance['show_excerpt']: '';
		$all_post_formats	=	isset($instance['all_post_formats']) ? $instance['all_post_formats']: '';
		$thumb_width		=  	empty($instance['thumb_width']) ? 50 : $instance['thumb_width'];
		$thumb_height		=  	empty($instance['thumb_height']) ? 50 : $instance['thumb_height'];		
		
		// Categories
		$rt_getcat = RTTheme::rt_get_categories();
		

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo empty($title) ? __('Recent Posts','rt_theme') : $title; ?>" /></p>
		
		
		<p><label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Select Categories:', 'rt_theme_admin'); ?></label>
		
		<select class="widefat <?php echo empty($newWidget)? '' : 'multiple'; ?>"   name="<?php echo $this->get_field_name('categories'); ?>[]" id="<?php echo $this->get_field_id('categories'); ?>" multiple="multiple" title="<?php _e('Select','rt_theme_admin'); ?>">

			<?php
			foreach ($rt_getcat as $op_val=>$option) {
				if($categories){
					foreach($categories as $a_key => $a_value){
						if (	$a_value ==  $op_val ){
							$selected	= "selected";
						}				
					}
				}
			 ?>
				<option value="<?php echo $op_val;?>" <?php echo empty($selected) ? "" :  'selected="selected"'; ?> >
					<?php  echo $option; ?>
				</option>
			<?php
			$selected='';
			}
			?>
		</select>

		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of posts to show:', 'rt_theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="4" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" <?php checked( $show_excerpt ); ?> />
		<label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e( 'Display Excerpt', 'rt_theme_admin' ); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit excerpt characters: ', 'rt_theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" size="4" /></p>			

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_thumbnails'); ?>" name="<?php echo $this->get_field_name('show_thumbnails'); ?>" <?php checked( $show_thumbnails ); ?> />
		<label for="<?php echo $this->get_field_id('show_thumbnails'); ?>"><?php _e( 'Don\'t display post thumbnails', 'rt_theme_admin' ); ?></label></p>
	
		<p><label for="<?php echo $this->get_field_id('thumb_width'); ?>"><?php _e('Thumbnail Width (px):', 'rt_theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('thumb_width'); ?>" name="<?php echo $this->get_field_name('thumb_width'); ?>" type="text" value="<?php echo $thumb_width; ?>" size="4" /></p>
	
		<p><label for="<?php echo $this->get_field_id('thumb_height'); ?>"><?php _e('Thumbnail Height (px):', 'rt_theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('thumb_height'); ?>" name="<?php echo $this->get_field_name('thumb_height'); ?>" type="text" value="<?php echo $thumb_height; ?>" size="4" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('all_post_formats'); ?>" name="<?php echo $this->get_field_name('all_post_formats'); ?>" <?php checked( $all_post_formats ); ?> />
		<label for="<?php echo $this->get_field_id('all_post_formats'); ?>"><?php _e( 'Show All Post Formats', 'rt_theme_admin' ); ?></label></p> 
				
		<input class="widefat" id="<?php echo $this->get_field_id('newWidget'); ?>" name="<?php echo $this->get_field_name('newWidget'); ?>" type="hidden" value="1" />
		
<?php } } ?>