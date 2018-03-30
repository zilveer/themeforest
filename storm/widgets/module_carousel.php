<?php
/**
 * Plugin Name: BK-Ninja: Carousel Module
 * Plugin URI: http://bk-ninja.com
 * Description: This module display posts in carousel
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_carousel_module');

function bk_register_carousel_module(){
	register_widget('bk_carousel');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_carousel extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'module-carousel', 'description' => __('[Full-width module][Content module] Display a carousel in full-width or content section.','bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_carousel', __('*BK: Module Carousel', 'bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){
        global $bk_option;
        global $bk_flex_el;
        $feat_tag = '';
        if (isset($bk_option)):
            $rtl = $bk_option['bk-rtl-sw'];
            if ($bk_option['feat-tag'] != '') $feat_tag = $bk_option['feat-tag'];
        endif;
        $defaults = array('title' => '', 'category' => 'feat', 'style' => 'card', 'entries_display' => 5, 'speed' => 4000, 'autoplay' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults);
		extract($args);
        $title = $instance['title'];
        $post = $instance['entries_display'];
		$cat_id = $instance['category'];
 
        $style = $instance['style'];  
        $maxitem = 4;
        
        $speed = $instance['speed'];  
        $autoplay = $instance['autoplay'];

        if ($cat_id == 'feat') {    
            if ($feat_tag != '') {
                $args = array(
    				'tag' => $feat_tag,
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => $post,
                    );   
            } else {
                $args = array(
    				'post__in'  => get_option( 'sticky_posts' ),
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => $post,
                    );
            }         
        } else { 
		$args = array(
				'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $post,
                );
        }
        $posts_array = get_posts( $args );
        $number_posts_ret = count($posts_array);
        if ($number_posts_ret < 4){
            return;
        }
        $uid = uniqid('carousel-');
                
        
        $config['maxitem'] = $maxitem;
        $config['speed'] = $speed;
        if ($autoplay == 'on') {$config['autoplay'] = true;} else {$config['autoplay'] = false;};
        
        $bk_flex_el['carousel'][$uid] = $config;
        wp_localize_script( 'customjs', 'bk_flex_el', $bk_flex_el );
        
        $query = new WP_Query( $args );
        if ( !($query -> have_posts()) ) return;
        echo $before_widget; 
        if ( $title )
			echo $before_title . $title . $after_title;
        ?>			
            <div class="bkflex-loading clear-fix">            
    			<div id="<?php echo $uid;?>" class="flexslider style-<?php echo $style; ?>" >
    				<ul class="slides">
    					<?php while($query->have_posts()): $query->the_post(); $post_id = get_the_ID(); ?>						
                            <li>
                                <article>		
                                    <a href="<?php echo get_permalink( $post_id );?>">				
                                        <div class="thumb">									
                                            <?php if ($style == 'card') {echo (bk_get_thumbnail($post_id, 'bk262_400'));} else {echo (bk_get_thumbnail($post_id, 'bk262_262'));}?>								
                                        </div>
                                    </a>
                                    <?php        
                                        echo bk_review_score($post_id);
                                        bk_get_post_info($post_id); 
                                    ?>
                                </article>
                                
    						</li>																
    					<?php endwhile; ?>
    				</ul>
    			</div>	
             </div>		
		<?php
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		if ($new_instance['entries_display'] <4){
		  $new_instance['entries_display'] = 4;
		}
		
		$instance['category'] = $new_instance['category'];
		$instance['style'] = $new_instance['style'];
        $instance['entries_display'] = $new_instance['entries_display'];
        $instance['speed'] = $new_instance['speed'];  
        $instance['autoplay'] = $new_instance['autoplay'];      
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('title' => '', 'category' => 'feat', 'style' => 'card', 'entries_display' => 5, 'speed' => 4000, 'autoplay' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<!-- Title: Text Input -->     
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e('Title: ', 'bkninja'); ?></strong></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><strong><?php _e('Post Source:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat categories" style="width:100%;">
                <option value='feat' <?php if ('feat' == $instance['category']) echo 'selected="selected"'; ?>><?php _e( 'Featured Posts', 'bkninja' ); ?></option>
				<option value='' <?php if ('' == $instance['category']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories = get_categories('hide_empty=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id('style'); ?>"><strong><?php _e('Style option:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" class="widefat categories" style="width:100%;">
				<option value='card' <?php if ('card' == $instance['style']) echo 'selected="selected"'; ?>><?php _e('Card', 'bkninja');?></option>
                <option value='thumb' <?php if ('thumb' == $instance['style']) echo 'selected="selected"'; ?>><?php _e('Thumb', 'bkninja');?></option>
			</select>
		</p>
        
		<p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><strong><?php _e('Number of entries to display (Min 4 entries)', 'bkninja'); ?></strong></label>
		<input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>

		<p><label for="<?php echo $this->get_field_id( 'speed' ); ?>"><strong><?php _e('Slider speed (ms)', 'bkninja'); ?></strong></label>
		<input type="text" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" value="<?php echo $instance['speed']; ?>" style="width:100%;" /></p>

        <p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['autoplay'], 'on' ); ?> id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e('Enable Autoplay', 'bkninja'); ?></label>
		</p>
	<?php }
}
?>