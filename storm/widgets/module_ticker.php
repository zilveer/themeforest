<?php
/**
 * Plugin Name: BK-Ninja: Ticker Module
 * Plugin URI: http://bk-ninja.com/
 * Description: This widget displays the breaking news.
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com/
 *
 */
add_action( 'widgets_init', 'bk_register_ticker_widget' );
function bk_register_ticker_widget() {
	register_widget( 'bk_ticker' );
}
class bk_ticker extends WP_Widget {
	/**

	 * Widget setup.

	 */
	function __construct() {
	   
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'bk-ticker-module', 'description' => __('[Full-width module][Content module] Displays the ticker in full-width or content section.', 'bkninja') );
        
		/* Create the widget. */
		parent::__construct( 'bk_ticker', __('*BK: Module Ticker', 'bkninja'), $widget_ops );
	}
	/**

	 * How to display the widget on the screen.

	 */

	function widget( $args, $instance ) {	   
        global $bk_option;
        global $bk_ticker;
        $feat_tag = '';
        if (isset($bk_option)):
            $rtl = $bk_option['bk-rtl-sw'];
            if ($bk_option['feat-tag'] != '') $feat_tag = $bk_option['feat-tag'];
        endif;
        $defaults = array( 'title' => 'Trending now', 'ticker_num' => 5, 'ticker_cat' => 'feat', 'ticker_ani' => 'Scroll');
		$instance = wp_parse_args( $instance, $defaults );
		extract( $args );
        echo $before_widget;
        
		/* Our variables from the widget settings. */       
        $title = $instance['title'];       
        if ( $title == '' ) { $title = 'Breaking News';}

		$ticker_cat = $instance['ticker_cat'];      
        if ( $ticker_cat == '' ) { $ticker_cat = 'feat';}

		$ticker_num = $instance['ticker_num'];
        if ( $ticker_num == '' ) { $ticker_num = 5;}
        
        $ticker_ani = $instance['ticker_ani'];
        if ( $ticker_ani == '' ) { $ticker_ani = 'Slide';}
        
        $uid = uniqid('ticker-wrapper-');
        
        $bk_ticker[$uid] = $ticker_ani;
        wp_localize_script( 'customjs', 'ticker', $bk_ticker );
        
        if ($ticker_cat == 'feat') {    
            if ($feat_tag != '') {
                $args = array(
    				'tag' => $feat_tag,
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => $ticker_num,
                    );   
            } else {
                $args = array(
    				'post__in'  => get_option( 'sticky_posts' ),
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => $ticker_num,
                    );
            }         
        } else { 
		$args = array(
				'cat' => $ticker_cat,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $ticker_num,
                );
        }
        ?>
         
		<div id="<?php echo $uid;?>" class="ticker-wrapper">
            <h3 class="ticker-header"><?php echo $title; ?></h3>
            <div class="ticker-header-arrow"></div>
            <ul class="ticker">
                <?php $ticker_news = new WP_Query($args); while($ticker_news->have_posts()) : $ticker_news->the_post();?>
                <li><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></li>
                <?php endwhile; ?>
            </ul>
        
        </div><!--ticker-wrapper-->
 		<?php
        
        echo $after_widget;  
	}
	/**

	 * Update the widget settings.

	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags($new_instance['title']);        
        $instance['ticker_cat'] = $new_instance['ticker_cat'];
		$instance['ticker_num'] = absint((int) $new_instance['ticker_num']);       
        $instance['ticker_ani'] = $new_instance['ticker_ani'];      

		return $instance;

	}
       
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Trending now', 'ticker_num' => 5, 'ticker_cat' => 'feat', 'ticker_ani' => 'Scroll');
		$instance = wp_parse_args( $instance, $defaults ); ?>
        
		<!-- Ticker Title: Text Input -->     
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e('Title: ','bkninja');?></strong></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
                
        <!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id('ticker_cat'); ?>"><strong><?php _e('Post Source: ', 'bkninja');?></strong></label>
			<select id="<?php echo $this->get_field_id('ticker_cat'); ?>" name="<?php echo $this->get_field_name('ticker_cat'); ?>" style="width:100%;">
				<option value='feat' <?php if ('feat' == $instance['ticker_cat']) echo 'selected="selected"'; ?>><?php _e( 'Featured Posts', 'bkninja' ); ?></option>
                <option value='' <?php if ('' == $instance['ticker_cat']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories = get_categories('hide_empty=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				    <option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['ticker_cat']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>

			</select>

		</p>

		<!-- Number of ticker posts -->

		<p>
			<label for="<?php echo $this->get_field_id( 'ticker_num' ); ?>"><strong><?php _e('Number of posts to show: ', 'bkninja');?></strong></label>
			<input type="text" id="<?php echo $this->get_field_id( 'ticker_num' ); ?>" name="<?php echo $this->get_field_name( 'ticker_num' ); ?>" value="<?php echo $instance['ticker_num']; ?>" size="3" />
		</p>
        

        <!-- Animation Option -->        
        <p>     
            <label for="<?php echo $this->get_field_id( 'ticker_ani' ); ?>"><strong><?php _e('Animation: ', 'bkninja');?></strong></label>    		 	
            <select id="<?php echo $this->get_field_id( 'ticker_ani' ); ?>" name="<?php echo $this->get_field_name( 'ticker_ani' ); ?>">            
                <option value="Scroll" <?php if ($instance['ticker_ani'] == 'Scroll') echo 'selected="selected"'; ?>><?php _e('Scroll', 'bkninja');?></option>               
                <option value="Type" <?php if ($instance['ticker_ani'] == 'Type') echo 'selected="selected"'; ?>><?php _e('Type', 'bkninja');?></option>                
                <option value="Slide" <?php if ($instance['ticker_ani'] == 'Slide') echo 'selected="selected"'; ?>><?php _e('Slide', 'bkninja');?></option>               	
             </select>          
        </p>
		<?php  
    } 
}