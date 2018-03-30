<?php
/**
 * Plugin Name: BK-Ninja: Review posts Widget
 * Plugin URI: http://bk-ninja.com/
 * Description: This widget displays review posts.
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com/
 *
 */


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'bk_register_reviews_widget' );

function bk_register_reviews_widget() {
	register_widget( 'bk_review' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class bk_review extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-review-tabs', 'description' => __('[Sidebar widget] Displays tabs of recent and popular review posts in sidebar.', 'bkninja') );

		/* Create the widget. */
		parent::__construct( 'bk_review', __('*BK: Widget Post Reviews', 'bkninja'), $widget_ops);
	}

	/**
	 *display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
		
        $latest_reviews_en = $instance['latest-reviews'];
		$bk_top_reviews_time = $instance['top-reviews'];
        
        $week = date('W');
        $year = date('Y');
        $month = date('m');
?>        
        <div class="widget_reviews_tabs"> 
    
            <div class="widget-tabs-title-container">
            	<ul class="widget-reviews-tab-titles">
                    <?php if ($latest_reviews_en != 'disable'){?>
            		      <li class="active"><h3><a href="#reviews-tab1-content"><?php _e('LATEST REVIEWS', 'bkninja'); ?></a></h3></li>
                    <?php }?>
                    <?php if ($bk_top_reviews_time != 'disable'){?>
            		      <li class="<?php if ($latest_reviews_en == 'disable'): echo ('active'); endif;?>"><h3><a href="#reviews-tab2-content"><?php if($bk_top_reviews_time == 'all-time'){_e('TOP REVIEWS', 'bkninja');}else{_e('TOP '.$bk_top_reviews_time, 'bkninja');} ?></a></h3></li>
            	   <?php }?>
                </ul>
            </div>
            <div class="reviews-tabs-content-container">
                <?php if ($latest_reviews_en != 'disable'){?>
                    <div id="reviews-tab1-content" class="reviews-tab-content" style="display: block;">	
                        <?php
                		$args_latest = array(
                			'post_type' => 'post',
                			'ignore_sticky_posts' => 1,
                            'orderby' => 'date',
                            'order'=> 'DESC',
                			'posts_per_page' => 5,
                			'meta_query' => array(
                				array(
                					'key' => 'bk_review_checkbox',
                					'value' => '1',
                				)
                             )		
                		);
                        $latest_posts = new WP_Query( $args_latest );
                        if ( $latest_posts -> have_posts() ) :
                        	echo '<ul class="list post-list">';
                        	while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post();
                                $bk_review_checkbox = get_post_meta(get_the_ID(), 'bk_review_checkbox', true );
                                $bk_final_score = get_post_meta(get_the_ID(), 'bk_final_score', true ); 
                                $bk_title = get_the_title();
                                $bk_title =  the_excerpt_limit($bk_title, 7);
                                ?>
                                <li class="bk-review-box clear-fix">
                                    <h4 class="bk-review-title post-title"><a href="<?php the_permalink(); ?>"><?php echo $bk_title ;?></a></h4>
                                    <span class="bk-final-score"> <?php echo $bk_final_score;?></span>
                                    <span class="bk-overlay"><span class="bk-zero-trigger" style="width: <?php echo ($bk_final_score*10);?>%"></span></span>                        
                                </li>
                                    
                            <?php 
                        	endwhile;
                        	echo '</ul>';
                        endif;?>
                    </div>
                <?php }?>
                <?php if ($bk_top_reviews_time != 'disable'){?>
                    <div id="reviews-tab2-content" class="reviews-tab-content" <?php if ($latest_reviews_en == 'disable'): echo ('style="display: block;"'); endif;?>>	
                        <?php
                        if($bk_top_reviews_time == 'week'){
                           $args_latest1 = array(
                    			'post_type' => 'post',
                    			'ignore_sticky_posts' => 1,
                                'meta_key'  => 'bk_final_score',
                                'orderby' => 'meta_value_num',
                                'order'=> 'DESC',
                                'w'  => $week,                                                        
                    			'posts_per_page' => 5		
                            );
                        }else if($bk_top_reviews_time == 'month'){
                            $args_latest1 = array(
                    			'post_type' => 'post',
                    			'ignore_sticky_posts' => 1,
                                'meta_key'  => 'bk_final_score',
                                'orderby' => 'meta_value_num',
                                'order'=> 'DESC',
                                'monthnum '  => $month,
                    			'posts_per_page' => 5		
                            );
                        }else if($bk_top_reviews_time == 'year'){
                            $args_latest1 = array(
                    			'post_type' => 'post',
                    			'ignore_sticky_posts' => 1,
                                'meta_key'  => 'bk_final_score',
                                'orderby' => 'meta_value_num',
                                'order'=> 'DESC',
                                'year'  => $year,
                    			'posts_per_page' => 5		
                            );
                        }else{
                    		$args_latest1 = array(
                    			'post_type' => 'post',
                    			'ignore_sticky_posts' => 1,
                                'meta_key'  => 'bk_final_score',
                                'orderby' => 'meta_value_num',
                                'order'=> 'DESC',
                    			'posts_per_page' => 5		
                            );
                        }				
                		
                        $latest_posts = new WP_Query( $args_latest1 );
                        if ( $latest_posts -> have_posts() ) :
                        	echo '<ul class="list post-list">';
                        	while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post();
                                $bk_review_checkbox = get_post_meta(get_the_ID(), 'bk_review_checkbox', true );
                                $bk_final_score = get_post_meta(get_the_ID(), 'bk_final_score', true ); 
                                $bk_title = get_the_title();
                                $bk_title =  the_excerpt_limit($bk_title, 7);
                                ?>
                                <li class="bk-review-box clear-fix">
                                    <h4 class="bk-review-title post-title"><a href="<?php the_permalink(); ?>"><?php echo $bk_title ;?></a></h4>
                                    <span class="bk-final-score"> <?php echo $bk_final_score;?></span>
                                    <span class="bk-overlay"><span class="bk-zero-trigger" style="width: <?php echo ($bk_final_score*10);?>%"></span></span>                        
                                </li>
                                    
                            <?php 
                        	endwhile;
                        	echo '</ul>';
                        endif;?>
                    </div>
                <?php }?>
            </div>		
        </div>
		<?php echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
        $instance['top-reviews'] = $new_instance['top-reviews'];
		$instance['latest-reviews'] = $new_instance['latest-reviews'];
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array('latest-reviews' => 'enable', 'top-reviews' => 'all-time');
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
    <label for="<?php echo $this->get_field_id('latest-reviews'); ?>"><strong><?php _e('Latest Reviews: ', 'bkninja'); ?></strong></label> 
	<select id="<?php echo $this->get_field_id('latest-reviews'); ?>" name="<?php echo $this->get_field_name('latest-reviews'); ?>" style="width:100%;">
		<option value='enable' <?php if ('enable' == $instance['latest-reviews']) echo 'selected="selected"'; ?>><?php _e('Enable', 'bkninja');?></option>
		<option value='disable' <?php if ('disable' == $instance['latest-reviews']) echo 'selected="selected"'; ?>><?php _e('Disable', 'bkninja');?></option>
	</select>
    
    
	<p>
		<label for="<?php echo $this->get_field_id('top-reviews'); ?>"><strong><?php _e('Filter by time for Top Reviews: ', 'bkninja'); ?></strong></label> 
		<select id="<?php echo $this->get_field_id('top-reviews'); ?>" name="<?php echo $this->get_field_name('top-reviews'); ?>" style="width:100%;">
            <option value='disable' <?php if ('disable' == $instance['top-reviews']) echo 'selected="selected"'; ?>><?php _e('Disable', 'bkninja');?></option>
		  	<option value='all-time' <?php if ('all-time' == $instance['top-reviews']) echo 'selected="selected"'; ?>><?php _e('All time', 'bkninja');?></option>
			<option value='week' <?php if ('week' == $instance['top-reviews']) echo 'selected="selected"'; ?>><?php _e('This week', 'bkninja');?></option>
            <option value='month' <?php if ('month' == $instance['top-reviews']) echo 'selected="selected"'; ?>><?php _e('This month', 'bkninja');?></option>
            <option value='year' <?php if ('year' == $instance['top-reviews']) echo 'selected="selected"'; ?>><?php _e('This year', 'bkninja');?></option>
		</select>
	</p>
    	
	<?php
	}
}
?>