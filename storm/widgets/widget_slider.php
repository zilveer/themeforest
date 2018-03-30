<?php
/**
 * Plugin Name: BK-Ninja: Slider Widget
 * Plugin URI: http://bk-ninja.com
 * Description: Slider widget in sidebar
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_slider_widget');

function bk_register_slider_widget(){
	register_widget('bk_slider');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_slider extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'widget-slider', 'description' => __('[Sidebar widget] Displays a slider in sidebar.', 'bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_slider', __('*BK: Widget Slider','bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
		extract($args);
        global $bk_flex_el;
        $title = $instance['title'];   	
		$cat_id = $instance['category'];
		$entries_display = $instance['entries_display'];  
        echo $before_widget;
        if ( $title )
			echo $before_title . $title . $after_title;
              
		$args = array(
				'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $entries_display
                );
        $uid = uniqid('sb-slider-');
        
        $bk_flex_el['sidebar_slider'][$uid] = null;

        wp_localize_script( 'customjs', 'bk_flex_id', $bk_flex_el );
        ?>
			<div id="<?php echo $uid;?>" class="flexslider" >
				<ul class="slides">
					<?php $query = new WP_Query( $args ); ?>
					<?php while($query->have_posts()): $query->the_post(); $post_id = get_the_ID(); ?>
					                 	
						 <?php 
                                $thumb_id = get_post_thumbnail_id();
                                $thumb_url = wp_get_attachment_image_src($thumb_id, 'bk330_220', true);
                            ?>					
                                <li data-thumb="<?php echo $thumb_url[0]; ?>" >
                                    <div class="thumb">									
                                        <?php echo (bk_get_thumbnail($post_id, 'bk330_220'));?>										
                                    
    								
        								<div class="post-info">
                                            <div class="post-info-overlay">
                                                <h4 class="post-cat post-cat-main-slider">                                                 
                                                <?php
                                                    $category = get_the_category( $post_id );
                                                    $cat_link = get_category_link( get_cat_ID($category[0]->cat_name));
                                                    echo '<a href="'; echo $cat_link; echo '">';
                                                    echo $category[0]->cat_name;
                                                    echo '</a>';
                                                ?>                                           
                                                </h4>
                                                <div class="post-info-line"></div>								
            									<h4 class="post-title post-title-main-slider">
            										<a href="<?php the_permalink() ?>">
            											<?php 
                											$title = get_the_title();
                											echo the_excerpt_limit($title, 12);
                										?>
            										</a>
            									</h4>
                                            </div>
                                        </div>
                                    </div>
    								
    							</li>	
                        																				
					<?php endwhile; ?>
				</ul>
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
		$instance['category'] = $new_instance['category'];
		$instance['entries_display'] = $new_instance['entries_display'];
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('title' => '', 'category' => 'all', 'entries_display' => 5);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
        
		<!-- Title: Text Input -->     
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e('Title: ','bkninja');?></strong></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        		
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><strong><?php _e('Filter by Category: ','bkninja');?></strong></label> 
			<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['category']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories = get_categories('hide_empty=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
		<p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><strong><?php _e('Number of entries to display: ', 'bkninja'); ?></strong></label>
		<input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>

	<?php }
}
?>