<?php
/**
 * Portfolios_List Widget Class
 */
if (!class_exists('Theme_Widget_Related_Portfolios_List')) {
class Theme_Widget_Related_Portfolios_List extends WP_Widget {

	public function __construct(){
		$widget_ops = array('classname' => 'widget_portfolios_list', 'description' => __( "Displays the related portfolio lists on your site", 'theme_admin') );
		parent::__construct('related_portfolios_list', THEME_SLUG.' - '.__('Related Portfolio List', 'theme_admin'), $widget_ops);
		$this->alt_option_name = 'widget_portfolios_list';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('theme_widget_related_portfolios_list', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Related Portfolios', 'striking-r') : $instance['title'], $instance, $this->id_base);
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
		
		$thumbnail_size = theme_get_option('portfolio', 'widget_thumbnail_size');
		$disable_thumbnail = $instance['disable_thumbnail'] ? '1' : '0';
		$display_extra_type = $instance['display_extra_type'] ? $instance['display_extra_type'] :'time';
		$target = isset($instance['target'])?$instance['target']:'_self';

		if($display_extra_type == 'both'){
			$display_extra_type = array('time','description');
		}else{
			$display_extra_type = array($display_extra_type);
		}
		$base_on = $instance['base_on'] ? $instance['base_on'] :'cat';
		$orderby = $instance['orderby'] ? $instance['orderby'] : 'menu_order';
		$query = array(
			'showposts' => $number, 
			'nopaging' => 0, 
			'orderby'=> $orderby, 
			'post_status' => array('publish', 'private'),
			'perm'=>'readable',
			'ignore_sticky_posts' => 1,
			'suppress_filters'=>0,
			'post_type' => 'portfolio'
		);

		global $post;
		switch ($base_on){
			case 'type':
				$query['meta_key'] = '_type';
				$query['meta_value'] =  get_post_meta($post->ID, '_type', true);;
				$query['meta_compare'] = 'IN';
				break;
			case 'cat':
			default:
				$category_ids = array();
				$categorys = wp_get_object_terms($post->ID, 'portfolio_category');
				if(!empty($categorys) && is_array($categorys)){
					foreach($categorys as $category){
						$category_ids[] = $category->term_id;
					}
					$query['tax_query'] = array(
						array(
							'taxonomy' => 'portfolio_category',
							'field' => 'id',
							'terms' => $category_ids
						)
					);
				}
		}
		
		$r = new WP_Query($query);
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="posts_list">
<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<li>
<?php
	$type = get_post_meta(get_the_id(), '_type', true);
	if($type == 'link'){
		$link = get_post_meta(get_the_ID(), '_link', true);
		$href = theme_get_superlink($link);
	} else {
		$href = get_permalink();
	}
?>
<?php 
if(!$disable_thumbnail):
if (has_post_thumbnail() ): ?>
				<a class="thumbnail" href="<?php echo $href; ?>" title="<?php the_title();?>" target="<?php echo $target;?>">
					<?php the_post_thumbnail(array($thumbnail_size,$thumbnail_size),array('title'=>get_the_title(),'alt'=>get_the_title())); ?>
				</a>
<?php elseif(theme_get_option('portfolio','display_default_thumbnail')):
	if($default_thumbnail_custom = theme_get_option('portfolio','default_thumbnail_custom')){
		$default_thumbnail_image = theme_get_image_src($default_thumbnail_custom);
	}else{
		$default_thumbnail_image = THEME_IMAGES.'/widget_posts_thumbnail.png';
	}
?>
				<a class="thumbnail" href="<?php echo $href; ?>" title="<?php the_title();?>" target="<?php echo $target;?>">
					<img src="<?php echo $default_thumbnail_image;?>" width="<?php echo $thumbnail_size;?>" height="<?php echo $thumbnail_size;?>" title="<?php the_title();?>" alt="<?php the_title();?>"/>
				</a>
<?php endif;//end has_post_thumbnail ?>
<?php endif;//disable_thumbnail ?>
				<div class="post_extra_info">
					<a href="<?php echo $href; ?>" rel="bookmark" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" target="<?php echo $target;?>">
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
		wp_cache_set('theme_widget_related_portfolios_list', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['title_length'] = (int) $new_instance['title_length'];
		$instance['desc_length'] = (int) $new_instance['desc_length'];
		$instance['disable_thumbnail'] = !empty($new_instance['disable_thumbnail']) ? 1 : 0;
		$instance['display_extra_type'] = $new_instance['display_extra_type'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['base_on'] = $new_instance['base_on'];
		$instance['target'] = $new_instance['target'];
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['theme_widget_related_portfolios_list']) )
			delete_option('theme_widget_related_portfolios_list');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('theme_widget_related_portfolios_list', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumbnail = isset( $instance['disable_thumbnail'] ) ? (bool) $instance['disable_thumbnail'] : false;
		$display_extra_type = isset( $instance['display_extra_type'] ) ? $instance['display_extra_type'] : 'time';
		$base_on = isset( $instance['base_on'] ) ? $instance['base_on'] : 'cat';
		$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'menu_order';
		$target = isset($instance['target'])?$instance['target']:'_self';
		
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;

		if ( !isset($instance['title_length']) || !$title_length = (int) $instance['title_length'] )
			$title_length = '';

		if ( !isset($instance['desc_length']) || !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 80;
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
			<label for="<?php echo $this->get_field_id('base_on'); ?>"><?php _e( 'Base on the same:', 'theme_admin' ); ?></label>
			<select name="<?php echo $this->get_field_name('base_on'); ?>" id="<?php echo $this->get_field_id('base_on'); ?>" class="widefat">
				<option value="cat"<?php selected($base_on,'cat');?>><?php _e( 'Category', 'theme_admin' ); ?></option>
				<option value="type"<?php selected($base_on,'type');?>><?php _e( 'Type', 'theme_admin' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e( 'Orderby:', 'theme_admin' ); ?></label>
			<select name="<?php echo $this->get_field_name('orderby'); ?>" id="<?php echo $this->get_field_id('orderby'); ?>" class="widefat">
				<option value="none"<?php selected($orderby,'none');?>><?php _e( 'None', 'theme_admin' ); ?></option>
				<option value="ID"<?php selected($orderby,'ID');?>><?php _e( ' Order by post id', 'theme_admin' ); ?></option>
				<option value="author"<?php selected($orderby,'author');?>><?php _e( ' Order by author', 'theme_admin' ); ?></option>
				<option value="title"<?php selected($orderby,'title');?>><?php _e( ' Order by title', 'theme_admin' ); ?></option>
				<option value="date"<?php selected($orderby,'date');?>><?php _e( 'Order by date', 'theme_admin' ); ?></option>
				<option value="modified"<?php selected($orderby,'modified');?>><?php _e( 'Order by last modified date', 'theme_admin' ); ?></option>
				<option value="rand"<?php selected($orderby,'rand');?>><?php _e( 'Random order', 'theme_admin' ); ?></option>
				<option value="comment_count"<?php selected($orderby,'comment_count');?>><?php _e( 'Order by number of comments', 'theme_admin' ); ?></option>
				<option value="menu_order"<?php selected($orderby,'menu_order');?>><?php _e( 'Order by Page Order', 'theme_admin' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'target' ); ?>"><?php _e('Link target:', 'theme_admin');?></label>
			<select name="<?php echo $this->get_field_name( 'target' ); ?>" id="<?php echo $this->get_field_id( 'target' ); ?>" class="widefat">
				<option value="_blank"<?php selected($target,'_blank');?>><?php _e( 'Load in a new window', 'theme_admin' ); ?></option>
				<option value="_self"<?php selected($target,'_self');?>><?php _e( 'Load in the same frame as it was clicked', 'theme_admin' ); ?></option>
				<option value="_parent"<?php selected($target,'_parent');?>><?php _e( 'Load in the parent frameset', 'theme_admin' ); ?></option>
				<option value="_top"<?php selected($target,'_top');?>><?php _e( 'Load in the full body of the window', 'theme_admin' ); ?></option>
			</select>
		</p>
<?php
	}
}
}