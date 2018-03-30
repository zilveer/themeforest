<?php
/**
 * Plugin Name: BK-Ninja: Grid Module
 * Plugin URI: http://bk-ninja.com
 * Description: This widget displays latests posts in grid layout
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_grid_module');

function bk_register_grid_module(){
	register_widget('bk_grid');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_grid extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'module-grid', 'description' => __('[Full-width module] Displays grid module in full-width section.', 'bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_grid', __('*BK: Module Grid', 'bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
        global $bk_option;
        global $bk_flex_el;
        $feat_tag = '';
        if (isset($bk_option)):
            $primary_color = $bk_option['bk-primary-color'];
            $rtl = $bk_option['bk-rtl-sw'];
            if ($bk_option['feat-tag'] != ''){
                $feat_tag = $bk_option['feat-tag'];
                $tag_id = get_term_by('name', $feat_tag, 'post_tag')->slug;
            }
        endif;
        $defaults = array('title' => '', 'category' => 'feat', 'entries_display' => 7, 'layout' => 'center');
		$instance = wp_parse_args((array) $instance, $defaults);
		extract($args);
        $title = $instance['title'];
		$cat_id = $instance['category'];
        $entries_display = $instance['entries_display'];
        $layout = $instance['layout'];
        if ($cat_id == 'feat') {    
            if ($feat_tag != '') {
                $args = array(
    				'tag' => $tag_id,
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => $entries_display,
                    );   
            } else {
                $args = array(
    				'post__in'  => get_option( 'sticky_posts' ),
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => $entries_display,
                    );
            }         
        } else { 
		$args = array(
				'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $entries_display,
                );
        }
        $grid_slider_uid = uniqid('masonry-grid-slider-');        
        $bk_flex_el['grid'][$grid_slider_uid] = null;
 
       wp_localize_script( 'customjs', 'bk_flex_el', $bk_flex_el );

            
            
        ?>        
<?php 
    $posts_array = get_posts( $args );
    $number_posts_ret = count($posts_array);
    if ($number_posts_ret < 5){
        return;
    }
    $slide_num = $number_posts_ret - 4;
    echo $before_widget; 
    if ( $title ) {
		echo $before_title . $title . $after_title;
    }
?>
		<div class="grid-widget-posts <?php if ($layout == 'left') {echo 'left-slider';} else {echo 'center-slider';} ?>" >
			 <div class="js-masonry grid-container">
				<?php
                if ($layout == 'left') {
                    for ($i=0; $i<$number_posts_ret;$i++){
                        switch($i){
                            case $number_posts_ret - 4:
                            case $number_posts_ret - 1:
                            case $number_posts_ret - 2:
                            case $number_posts_ret - 3:
                                
                                    $pos = $i;
                                echo ('<div class="small-grid item invisible">');
                                    echo ("<div class='item-wrap'>");
                                        echo ("<div class='thumb'><a href='". get_permalink($posts_array[$pos]->ID)."'>");
                                        echo (bk_get_thumbnail($posts_array[$pos]->ID, 'bk270_210'));
                                        echo("</a>");
                                        echo (bk_get_post_info($posts_array[$pos]->ID)); 
                                        echo bk_review_score($posts_array[$pos]->ID);
                                        echo ("</div>");
                                    echo ('</div>');
                                echo ('</div>');
                                break;
                            default:
                                $pos = $i;
                                if ($i == 0) {
                                    echo ('<div class="big-grid item">');
                                    echo ('<div id='.$grid_slider_uid.' class="flexslider masonry-grid-slider" >');   
                                    echo ('<ul class="slides">');
                                    }
                                        echo ('<li>');
                                            echo ("<div class='thumb'><a href='". get_permalink($posts_array[$pos]->ID)."'>");
                                            echo (bk_get_thumbnail($posts_array[$pos]->ID, 'bk530_416'));
                                            echo("</a>");
                                            echo (bk_get_post_info($posts_array[$pos]->ID));
                                            echo bk_review_score($posts_array[$pos]->ID);
                                            echo ("</div>");
                                        echo ('</li>');
                                if ($i == $number_posts_ret - 5) {
                                        echo('</ul>');
                                    echo('</div>');      
                                echo '</div>';
                                }
                                break;
                        }
                        
                    }
                } else {
                    for ($i=0; $i<$number_posts_ret;$i++){
                        switch($i){
                            case 0:
                            case $number_posts_ret - 1:
                            case $number_posts_ret - 2:
                            case $number_posts_ret - 3:
                                if ($i == 0) {
                                    $pos = $number_posts_ret - 4;
                                } else {
                                    $pos = $i;
                                }
                                echo ('<div class="small-grid item invisible">');
                                    echo ("<div class='item-wrap'>");
                                        echo ("<div class='thumb'><a href='". get_permalink($posts_array[$pos]->ID)."'>");
                                        echo (bk_get_thumbnail($posts_array[$pos]->ID, 'bk270_210'));
                                        echo("</a>");
                                        echo (bk_get_post_info($posts_array[$pos]->ID)); 
                                        echo bk_review_score($posts_array[$pos]->ID);
                                        echo ("</div>");
                                    echo ('</div>');
                                echo ('</div>');
                                break;
                            default:
                                $pos = $i -1;
                                if ($i == 1) {
                                    echo ('<div class="big-grid item">');
                                    echo ('<div id='.$grid_slider_uid.' class="flexslider masonry-grid-slider" >');   
                                    echo ('<ul class="slides">');
                                    }
                                        echo ('<li>');
                                            echo ("<div class='thumb'><a href='". get_permalink($posts_array[$pos]->ID)."'>");
                                            echo (bk_get_thumbnail($posts_array[$pos]->ID, 'bk530_416'));
                                            echo("</a>");
                                            echo (bk_get_post_info($posts_array[$pos]->ID));
                                            echo bk_review_score($posts_array[$pos]->ID);
                                            echo ("</div>");
                                        echo ('</li>');
                                if ($i == $number_posts_ret - 4) {
                                        echo('</ul>');
                                    echo('</div>');      
                                echo '</div>';
                                }
                                break;
                        }
                        
                    }
                } 
?>
				
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
		$instance['category'] = $new_instance['category'];
        $instance['layout'] = $new_instance['layout'];
        if ($new_instance['entries_display'] <5){
		  $new_instance['entries_display'] = 5;
		}
        $instance['entries_display'] = $new_instance['entries_display'];
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('title' => '', 'category' => 'feat', 'entries_display' => 7, 'layout' => 'center');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
        <!-- Title: Text Input -->     
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e('Title: ', 'bkninja'); ?></strong></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

        <!-- Categories
        --------------------------------------------->
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><strong><?php _e('Post Source:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat categories" style="width:100%;">
				<option value='feat' <?php if ('feat' == $instance['category']) echo 'selected="selected"'; ?>><?php _e( 'Featured Posts', 'bkninja' ); ?></option>
                <option value='' <?php if ('' == $instance['category']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
        <p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><strong><?php _e('Number of entries to display (Min 5 entries)', 'bkninja'); ?></strong></label>
		<input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" />
        </p>
        
        <!-- Layout
        --------------------------------------------->
		<p>
			<label for="<?php echo $this->get_field_id('layout'); ?>"><strong><?php _e('Grid layout', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>" class="widefat categories" style="width:100%;">
				<option value='center' <?php if ('center' == $instance['layout']) echo 'selected="selected"'; ?>><?php _e( 'Center slider', 'bkninja' ); ?></option>
                <option value='left' <?php if ('left' == $instance['layout']) echo 'selected="selected"'; ?>><?php _e( 'Left slider', 'bkninja' ); ?></option>
			</select>
		</p>
        

	<?php }
}
?>