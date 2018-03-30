<?php
/**
 * Portfolios Images Widget Class
 */
if (!class_exists('Theme_Widget_Portfolio_Images')) {
class Theme_Widget_Portfolio_Images extends WP_Widget {

	public function __construct(){
		$widget_ops = array('classname' => 'widget_portfolio_images', 'description' => __( "Displays the portfolio items's image with slideshow effect on your site", 'theme_admin') );
		parent::__construct('portfolio_images', THEME_SLUG.' - '.__('Portfolio Images', 'theme_admin'), $widget_ops);
		$this->alt_option_name = 'widget_portfolio_images';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );

		if ( is_active_widget(false, false, $this->id_base) ){
			add_action( 'wp_print_scripts', array(&$this, 'add_script') );
		}
	}

	function add_script(){
		wp_enqueue_script( 'tinyslider-init');
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('theme_widget_portfolio_images', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		if ( !$width = (int) $instance['width'] ){
			$width = 275;
		} else if ( $width < 1 ){
			$width = 1;
		}
		if ( !$height = (int) $instance['height'] ){
			$height = 150;
		} else if ( $height < 1 ){
			$height = 1;
		}
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		$linkable = $instance['linkable'] ? '1' : '0';
		// slideshow options
		$animation = $instance['animation'] ? $instance['animation'] :'fade';
		if ( !$duration = (int) $instance['duration'] ){
			$duration = 1000;
		} else if ( $duration < 1 ){
			$duration = 1;
		}
		if ( !$delay = (int) $instance['delay'] ){
			$delay = 4000;
		} else if ( $delay < 1 ){
			$delay = 1;
		}
		$caption = $instance['caption'] ? '1' : '0';
		$pager = $instance['pager'] ? '1' : '0';
		$nav = $instance['nav'] ? '1' : '0';
		$touch = $instance['touch'] ? '1' : '0';
		$random = $instance['random'] ? '1' : '0';
		$autoplay = $instance['autoplay'] ? '1' : '0';
		$pauseOnHover = $instance['pauseOnHover'] ? '1' : '0';
		// end slideshow options

		// query options
		if ( !$number = (int) $instance['number'] ){
			$number = 10;
		} else if ( $number < 1 ){
			$number = 1;
		} else if ( $number > 15 ){
			$number = 15;
		}
		
		$order = $instance['order'] ? $instance['order'] :'ASC';
		$orderby = $instance['orderby'] ? $instance['orderby'] :'date';

		$query = array(
			'showposts' => $number, 
			'nopaging' => 0, 
			'order' => $order,
			'orderby'=> $orderby, 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => 1,
			'suppress_filters'=>0,
			'post_type' => 'portfolio'
		);


		if(!empty($instance['cat'])){
			global $wp_version;
			foreach($instance['cat'] as &$id){
				$id = wpml_get_object_id($id, 'portfolio_category');
			}
			if(version_compare($wp_version, "3.1", '>=')){
				$query['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'id',
						'terms' => $instance['cat']
					)
				);
			}else{
				$terms = array();
				foreach($instance['cat'] as $cat){
					$term = get_term_by('id', $cat, 'portfolio_category');
					$terms[] = $term->slug;
				}
				$query['taxonomy'] = 'portfolio_category';
				$query['term'] = implode(",",$terms);
			}
		}
		if(!empty($instance['portfolio_type'])){
			$query['meta_key'] = '_type';
			$query['meta_value'] = $instance['portfolio_type'];
			$query['meta_compare'] = 'IN';
		}
		$r = new WP_Query($query);
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<div class="tinyslider_images" 
			data-tinyslider-animation="<?php echo $animation;?>" 
			data-tinyslider-duration="<?php echo $duration;?>" 
			data-tinyslider-delay="<?php echo $delay;?>" 
			data-tinyslider-pager="<?php echo $pager;?>" 
			data-tinyslider-nav="<?php echo $nav;?>" 
			data-tinyslider-touch="<?php echo $touch;?>" 
			data-tinyslider-random="<?php echo $random;?>" 
			data-tinyslider-autoplay="<?php echo $autoplay;?>" 
			data-tinyslider-pauseOnHover="<?php echo $pauseOnHover;?>"
			data-caption="<?php echo $caption;?>">
		<ul>
<?php  
$i=0;$style='';
while ($r->have_posts()) : $r->the_post(); 
if (has_post_thumbnail() ): 
	$image_id = get_post_thumbnail_id();
	$image_src = theme_get_image_src(array('type'=>'attachment_id','value'=>$image_id), array($width, $height));
	if ($i>=1) $style='style="display:none;"'; else $style='';
	$i++;
?>
			<li <?php echo $style;?>>
	<?php if($linkable): ?>
				<a href="<?php echo get_permalink() ?>" title="<?php the_title();?>">
					<img width="<?php echo $width;?>" height="<?php echo $height;?>" data-thumbnail="<?php echo $image_id;?>" src="<?php echo $image_src;?>" alt="<?php the_title();?>" />
				</a>
	<?php else:?>
				<img width="<?php echo $width;?>" height="<?php echo $height;?>" data-thumbnail="<?php echo $image_id;?>" src="<?php echo $image_src;?>" alt="<?php the_title();?>" />
	<?php endif;?>
			</li>
<?php endif;?>
<?php endwhile; ?>
		</ul>
		</div>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('theme_widget_portfolio_images', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['linkable'] = !empty($new_instance['linkable']) ? 1 : 0;
		$instance['number'] = (int) $new_instance['number'];
		$instance['width'] = (int) $new_instance['width'];
		$instance['height'] = (int) $new_instance['height'];
		$instance['order'] = $new_instance['order'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['cat'] = $new_instance['cat'];
		$instance['caption'] = $new_instance['caption'];
		$instance['portfolio_type'] = $new_instance['portfolio_type'];

		$instance['animation'] = $new_instance['animation'];
		$instance['duration'] = (int) $new_instance['duration'];
		$instance['delay'] = (int) $new_instance['delay'];
		$instance['pager'] = !empty($new_instance['pager']) ? 1 : 0;
		$instance['nav'] = !empty($new_instance['nav']) ? 1 : 0;
		$instance['touch'] = !empty($new_instance['touch']) ? 1 : 0;
		$instance['random'] = !empty($new_instance['random']) ? 1 : 0;
		$instance['autoplay'] = !empty($new_instance['autoplay']) ? 1 : 0;
		$instance['pauseOnHover'] = !empty($new_instance['pauseOnHover']) ? 1 : 0;

		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('theme_widget_portfolio_images', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$linkable = isset( $instance['linkable'] ) ? (bool) $instance['linkable'] : false;
		$order = isset( $instance['order'] ) ? $instance['order'] : 'ASC';
		$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'date';
		$cat = isset($instance['cat']) ? $instance['cat'] : array();
		$portfolio_type = isset($instance['portfolio_type']) ? $instance['portfolio_type'] : array();
		$caption = isset( $instance['caption'] ) ? (bool) $instance['caption'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] ){
			$number = 5;
		}
		if ( !isset($instance['width']) || !$width = (int) $instance['width'] ){
			$width = 275;
		}
		if ( !isset($instance['height']) || !$height = (int) $instance['height'] ){
			$height = 150;
		}

		$animation = isset( $instance['animation'] ) ? $instance['animation'] : 'fade';
        if ( !isset($instance['duration']) || !$duration = (int) $instance['duration'] ){
        	$duration = 1000;
        }
		if ( !isset($instance['delay']) || !$delay = (int) $instance['delay'] ){
			$delay = 4000;	
		}	
        $pager = isset( $instance['pager'] ) ? (bool) $instance['pager'] : true;
        $nav = isset( $instance['nav'] ) ? (bool) $instance['nav'] : true;
        $touch = isset( $instance['touch'] ) ? (bool) $instance['touch'] : true;
        $random = isset( $instance['random'] ) ? (bool) $instance['random'] : false;
        $autoplay = isset( $instance['autoplay'] ) ? (bool) $instance['autoplay'] : true;
        $pauseOnHover = isset( $instance['pauseOnHover'] ) ? (bool) $instance['pauseOnHover'] : true;


        $categories = get_terms('portfolio_category','orderby=name&hide_empty=0&suppress_filters=0');
		$portfolio_type_array = array(
			"image" => __('Image','theme_admin'),
			"gallery" => __('Gallery','theme_admin'),
			"video" => __('Video','theme_admin'),
			"doc" => __('Document','theme_admin'),
			"link" => __('Link','theme_admin'),
			"lightbox" => __('Lightbox','theme_admin'),
		);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of items to show:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width of image:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height of image:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('caption'); ?>" name="<?php echo $this->get_field_name('caption'); ?>"<?php checked( $caption ); ?> />
		<label for="<?php echo $this->get_field_id('caption'); ?>"><?php _e( 'Show Caption?' , 'theme_admin'); ?></label></p>
		
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('linkable'); ?>" name="<?php echo $this->get_field_name('linkable'); ?>"<?php checked( $linkable ); ?> />
		<label for="<?php echo $this->get_field_id('linkable'); ?>"><?php _e( 'Link to portfolio item page?' , 'theme_admin'); ?></label></p>

		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e( 'Order:', 'theme_admin' ); ?></label>
			<select name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>" class="widefat">
				<option value="ASC"<?php selected($order,'id');?>><?php _e( 'ASC', 'theme_admin' ); ?></option>
				<option value="DESC"<?php selected($order,'author');?>><?php _e( 'DESC', 'theme_admin' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e( 'Order by:', 'theme_admin' ); ?></label>
			<select name="<?php echo $this->get_field_name('orderby'); ?>" id="<?php echo $this->get_field_id('orderby'); ?>" class="widefat">
				<option value="id"<?php selected($orderby,'id');?>><?php _e( 'Post id', 'theme_admin' ); ?></option>
				<option value="author"<?php selected($orderby,'author');?>><?php _e( 'Author', 'theme_admin' ); ?></option>
				<option value="title"<?php selected($orderby,'title');?>><?php _e( 'Title', 'theme_admin' ); ?></option>
				<option value="date"<?php selected($orderby,'date');?>><?php _e( 'Date', 'theme_admin' ); ?></option>
				<option value="modified"<?php selected($orderby,'modified');?>><?php _e( 'Last modified date', 'theme_admin' ); ?></option>
				<option value="rand"<?php selected($orderby,'rand');?>><?php _e( 'Random order', 'theme_admin' ); ?></option>
				<option value="comment_count"<?php selected($orderby,'comment_count');?>><?php _e( 'Number of comments', 'theme_admin' ); ?></option>
				<option value="menu_order"<?php selected($orderby,'menu_order');?>><?php _e( 'Page Order', 'theme_admin' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e( 'Choose Portfolio Category(s) to Display:' , 'theme_admin'); ?></label>
			<select style="height:5.5em" name="<?php echo $this->get_field_name('cat'); ?>[]" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat" multiple="multiple">
				<?php foreach($categories as $category):?>
				<option value="<?php echo $category->term_id;?>"<?php echo in_array($category->term_id, $cat)? ' selected="selected"':'';?>><?php echo $category->name;?></option>
				<?php endforeach;?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('portfolio_type'); ?>"><?php _e( 'Portfolio Type:' , 'theme_admin'); ?></label>
			<select style="height:5.5em" name="<?php echo $this->get_field_name('portfolio_type'); ?>[]" id="<?php echo $this->get_field_id('portfolio_type'); ?>" class="widefat" multiple="multiple">
				<?php foreach($portfolio_type_array as $key=>$value):?>
				<option value="<?php echo $key;?>"<?php echo in_array($key, $portfolio_type)? ' selected="selected"':'';?>><?php echo $value;?></option>
				<?php endforeach;?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e( 'Animation:', 'theme_admin' ); ?></label>
			<select name="<?php echo $this->get_field_name('animation'); ?>" id="<?php echo $this->get_field_id('animation'); ?>" class="widefat">
				<option value="fade"<?php selected($animation,'fade');?>><?php _e( 'Fade', 'theme_admin' ); ?></option>
				<option value="slide"<?php selected($animation,'slide');?>><?php _e( 'Slide', 'theme_admin' ); ?></option>
			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id('duration'); ?>"><?php _e('Duration of transition:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('duration'); ?>" name="<?php echo $this->get_field_name('duration'); ?>" type="text" value="<?php echo $duration; ?>" size="5" /> <?php _e('ms', 'theme_admin'); ?></p>

		<p><label for="<?php echo $this->get_field_id('delay'); ?>"><?php _e('Time between transitions:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('delay'); ?>" name="<?php echo $this->get_field_name('delay'); ?>" type="text" value="<?php echo $delay; ?>" size="5" /> <?php _e('ms', 'theme_admin'); ?></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('pager'); ?>" name="<?php echo $this->get_field_name('pager'); ?>"<?php checked( $pager ); ?> />
		<label for="<?php echo $this->get_field_id('pager'); ?>"><?php _e( 'Show Pager?' , 'theme_admin'); ?></label></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('nav'); ?>" name="<?php echo $this->get_field_name('nav'); ?>"<?php checked( $nav ); ?> />
		<label for="<?php echo $this->get_field_id('nav'); ?>"><?php _e( 'Show Prev/Next Navigation?' , 'theme_admin'); ?></label></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('touch'); ?>" name="<?php echo $this->get_field_name('touch'); ?>"<?php checked( $touch ); ?> />
		<label for="<?php echo $this->get_field_id('touch'); ?>"><?php _e( 'Enable Touch Support?' , 'theme_admin'); ?></label></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>"<?php checked( $random ); ?> />
		<label for="<?php echo $this->get_field_id('random'); ?>"><?php _e( 'Randomize the order?' , 'theme_admin'); ?></label></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>"<?php checked( $autoplay ); ?> />
		<label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e( 'Animate automatically?' , 'theme_admin'); ?></label></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('pauseOnHover'); ?>" name="<?php echo $this->get_field_name('pauseOnHover'); ?>"<?php checked( $pauseOnHover ); ?> />
		<label for="<?php echo $this->get_field_id('pauseOnHover'); ?>"><?php _e( 'Pause when hovering over?' , 'theme_admin'); ?></label></p>
<?php
	}
}
}