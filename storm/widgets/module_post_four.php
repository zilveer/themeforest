<?php
/**
 * Plugin Name: BK-Ninja: Module Post Four
 * Plugin URI: http://bk-ninja.com
 * Description: This module displays one main posts on left side and list of four posts on right side
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://BK-Ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_module_post_four');

function bk_register_module_post_four(){
	register_widget('bk_module_post_four');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_module_post_four extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'module-post-four', 'description' => __('[Content module] Displays one main posts on left side and list of four posts on right side in content section', 'bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_module_post_four', __('*BK: Module Posts Four', 'bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
        $defaults = array('category' => '', 'entries_display' => 4);
		$instance = wp_parse_args((array) $instance, $defaults);
		extract($args);

		$cat_id = $instance['category'];
		$cat_name = get_cat_name($cat_id);
		$cat_url = get_category_link($cat_id );
        $entries_display = $instance['entries_display'];
		echo $before_widget; 		
		$args = array(
				'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $entries_display
			);
		?>		
		<div class="module-post-four-wrap section">
				
			<div class="cat-header">
				<div class="cat-title">
                    <?php if($cat_url != NULL){?>				
                            <h3 ><a href="<?php echo esc_url( $cat_url ); ?>" ><?php echo $cat_name; ?></a></h3>
                          <?php }else{?>
                            <h3 ><?php _e('Latest Posts','bkninja');?></h3>
                          <?php }?>
                            				
				</div>
			</div>
            <div class="module-post-four-content-wrap clear-fix">
        		<?php $query = new WP_Query( $args ); ?>
        		<?php if ( $query -> have_posts() ) : ?>
        			<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>	
        				    <?php 
                                $post_id = get_the_ID();
                                $review = '';
                                $bk_review_score = get_post_meta($post_id, 'bk_final_score', true);
                                if ($bk_review_score != null) { $review = 'has-review'; };?>
        					<div class="one-col main-post">                            
								<div class="thumb-wrap">
									<div class="thumb">
										<a href="<?php the_permalink() ?>">
                                            <?php echo (bk_get_thumbnail($post_id, 'bk330_220'));?>
                                        </a>
                                        <?php 
                                            echo bk_review_score($post_id);
                                        ?>
									</div>		                                        
                                    <?php 
                    					$category = get_the_category(); 
                    					if($category[0]){?>  										
                    						<div class="post-cat post-cat-bg">
                    							<?php echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
                    						</div>					
 						             <?php } ?>
                                     
                                    <div class="post-details <?php echo $review;?>">
        								<h3 class="post-title post-title-main-post">
        									<a href="<?php the_permalink() ?>">
        										<?php 
        											$title = get_the_title();
        											echo the_excerpt_limit($title, 10);
        										?>
        									</a>
        								</h3> 								
        							</div>			
								</div>									
    						</div>					
        				
        			<?php endwhile; ?>
        		<?php endif; ?>	
            </div>	<!-- End content-wrap -->	
		</div><!-- module post four wrap -->
	<!-- End category -->
	<?php	
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
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
		$defaults = array('category' => '', 'entries_display' => 4);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
	<div class="field">													
		<h4><?php _e('Category', 'bkninja'); ?></h4>
		<?php 
			$categories = get_categories( array( 'hide_empty' => 1 ) );  ?>
			<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name('category'); ?>" style="width:100%;">
				<option value='' <?php if ('' == $instance['category']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php foreach( $categories as $category ) : ?>
					<option <?php if ($category->term_id == $instance['category']) echo 'selected="selected"';?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
                <?php endforeach; ?>
			</select>
            
            <p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><strong><?php _e('Number of entries to display (Even number recommended)', 'bkninja'); ?></strong></label>
    		  <input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" />
            </p>											
	</div>
		
	<?php }
}
    ?>