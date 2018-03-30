<?php
/**
 * Popular_Posts Widget Class
 */
if (!class_exists('Theme_Widget_Popular_Posts')) {
class Theme_Widget_Popular_Posts extends WP_Widget {

	public function __construct(){
		$widget_ops = array('classname' => 'widget_popular_posts', 'description' => __( "Displays the popular posts on your site", 'theme_admin') );
		parent::__construct('popular_posts', THEME_SLUG.' - '.__('Popular Posts', 'theme_admin'), $widget_ops);
		$this->alt_option_name = 'widget_popular_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
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
	
	function widget($args, $instance) {
		$cache = wp_cache_get('theme_widget_popular_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Posts', 'striking-r') : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		
		if ( !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 80;
		else if ( $desc_length < 1 )
			$desc_length = 1;

		if ( !$title_length = (int) $instance['title_length'] )
			$title_length = '';
		else if ( $title_length < 1 )
			$title_length = '';
		
		$thumbnail_size = theme_get_option('blog', 'widget_thumbnail_size');
		$disable_thumbnail = $instance['disable_thumbnail'] ? '1' : '0';
		$display_extra_type = $instance['display_extra_type'] ? $instance['display_extra_type'] :'time';
		if($display_extra_type == 'both'){
			$display_extra_type = array('time','description');
		}else{
			$display_extra_type = array($display_extra_type);
		}
		$query = array('showposts' => $number, 'nopaging' => 0, 'orderby'=> 'comment_count', 'post_status' => array('publish', 'private'), 'ignore_sticky_posts' => 1,'perm'=>'readable');
		if(!empty($instance['cat'])){
			$query['cat'] = implode(',', $instance['cat']);
		}
		if(!empty($instance['authors'])){
			$query['author'] = implode(',', $instance['authors']);
		}
		$exclude_cats = theme_get_option('blog','exclude_categorys');
		if(!empty($exclude_cats)){
			$query['category__not_in'] = $exclude_cats;
		}
		
		
		$r = new WP_Query($query);
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="posts_list">
<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<li>
<?php if(!$disable_thumbnail):?>
<?php if (has_post_thumbnail() ): ?>
				<a class="thumbnail" href="<?php echo get_permalink() ?>" title="<?php the_title();?>">
					<?php the_post_thumbnail(array($thumbnail_size,$thumbnail_size),array('title'=>get_the_title(),'alt'=>get_the_title())); ?>
				</a>
<?php elseif(theme_get_option('blog','display_default_thumbnail')):
	if($default_thumbnail_custom = theme_get_option('blog','default_thumbnail_custom')){
		$default_thumbnail_image = theme_get_image_src($default_thumbnail_custom);
	}else{
		$default_thumbnail_image = THEME_IMAGES.'/widget_posts_thumbnail.png';
	}
?>
				<a class="thumbnail" href="<?php echo get_permalink() ?>" title="<?php the_title();?>">
					<img src="<?php echo $default_thumbnail_image;?>" width="<?php echo $thumbnail_size;?>" height="<?php echo $thumbnail_size;?>" title="<?php the_title();?>" alt="<?php the_title();?>"/>
				</a>
<?php endif;//end has_post_thumbnail ?>
<?php endif;//disable_thumbnail ?>
				<div class="post_extra_info">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
						<?php 
							if( get_the_title() ) { 
								if((int)$title_length){
									echo theme_strcut(get_the_title(),$title_length,'...');
								}else{
									echo get_the_title();
								}
							}else {
								the_ID();
							}
						?>
					</a>
<?php if(in_array('time', $display_extra_type)):?>
					<time datetime="<?php the_time('Y-m-d') ?>"><?php echo get_the_date(); ?></time>
<?php endif;?>
<?php if(in_array('description', $display_extra_type)):?>
					<p><?php echo wp_html_excerpt(get_the_excerpt(),$desc_length);?>...</p>
<?php endif;//end display extra type ?>
				</div>
				<div class="clearboth"></div>
			</li>
<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('theme_widget_popular_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['title_length'] = (int) $new_instance['title_length'];
		$instance['desc_length'] = (int) $new_instance['desc_length'];
		$instance['disable_thumbnail'] = !empty($new_instance['disable_thumbnail']) ? 1 : 0;
		$instance['display_extra_type'] = $new_instance['display_extra_type'];
		$instance['cat'] = $new_instance['cat'];
		$instance['authors'] = $new_instance['authors'];
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['theme_widget_popular_posts']) )
			delete_option('theme_widget_popular_posts');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('theme_widget_popular_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumbnail = isset( $instance['disable_thumbnail'] ) ? (bool) $instance['disable_thumbnail'] : false;
		$display_extra_type = isset( $instance['display_extra_type'] ) ? $instance['display_extra_type'] : 'time';
		$cat = isset($instance['cat']) ? $instance['cat'] : array();
		$authors = isset($instance['authors']) ? $instance['authors'] : array();
		$authors_list = $this->get_all_author();
		if(empty($authors_list)){
			$authors_list = array();
		}
		
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;

		if ( !isset($instance['title_length']) || !$title_length = (int) $instance['title_length'] )
			$title_length = '';

		if ( !isset($instance['desc_length']) || !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 80;
		

		$categories = get_categories('orderby=name&hide_empty=0');

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumbnail'); ?>" name="<?php echo $this->get_field_name('disable_thumbnail'); ?>"<?php checked( $disable_thumbnail ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumbnail'); ?>"><?php _e( 'Disable Post Thumbnail?' , 'theme_admin'); ?></label></p>
		
		<p><label for="<?php echo $this->get_field_id('title_length'); ?>"><?php _e('Length of Title to show:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('title_length'); ?>" name="<?php echo $this->get_field_name('title_length'); ?>" type="text" value="<?php echo $title_length; ?>" size="3" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('display_extra_type'); ?>"><?php _e( 'Display Extra infomation type:', 'theme_admin' ); ?></label>
			<select name="<?php echo $this->get_field_name('display_extra_type'); ?>" id="<?php echo $this->get_field_id('display_extra_type'); ?>" class="widefat">
				<option value="time"<?php selected($display_extra_type,'time');?>><?php _e( 'Time', 'theme_admin' ); ?></option>
				<option value="description"<?php selected($display_extra_type,'description');?>><?php _e( 'Description', 'theme_admin' ); ?></option>
				<option value="both"<?php selected($display_extra_type,'both');?>><?php _e( 'Time and Description', 'theme_admin' ); ?></option>
				<option value="none"<?php selected($display_extra_type,'none');?>><?php _e( 'None', 'theme_admin' ); ?></option>
			</select>
		</p>
		
		<p><label for="<?php echo $this->get_field_id('desc_length'); ?>"><?php _e('Length of Description to show:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('desc_length'); ?>" name="<?php echo $this->get_field_name('desc_length'); ?>" type="text" value="<?php echo $desc_length; ?>" size="3" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e( 'Categorys:' , 'theme_admin'); ?></label>
			<select style="height:5.5em" name="<?php echo $this->get_field_name('cat'); ?>[]" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat" multiple="multiple">
				<?php foreach($categories as $category):?>
				<option value="<?php echo $category->term_id;?>"<?php echo in_array($category->term_id, $cat)? ' selected="selected"':'';?>><?php echo $category->name;?></option>
				<?php endforeach;?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('authors'); ?>"><?php _e( 'Authors:' , 'theme_admin'); ?></label>
			<select style="height:5.5em" name="<?php echo $this->get_field_name('authors'); ?>[]" id="<?php echo $this->get_field_id('authors'); ?>" class="widefat" multiple="multiple">
				<?php foreach($authors_list as $user_id => $display_name):?>
				<option value="<?php echo $user_id;?>"<?php echo in_array($user_id, $authors)? ' selected="selected"':'';?>><?php echo $display_name;?></option>
				<?php endforeach;?>
			</select>
		</p>
<?php
	}
}
}