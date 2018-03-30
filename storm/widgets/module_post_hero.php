<?php
/**
 * Plugin Name: BK-Ninja: Module Post Hero
 * Plugin URI: http://bk-ninja.com
 * Description: This is a full-width module displays a main post on left side and four sub posts on right side
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://BK-Ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_module_post_hero');

function bk_register_module_post_hero(){
	register_widget('bk_module_post_hero');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_module_post_hero extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'module-hero', 'description' => __('[Full-width module] Displays a main post on left side and four sub posts on right side in full-width section','bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_module_post_hero', __('*BK: Module Posts Hero','bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
        global $bk_option;
        $feat_tag = '';
        if (isset($bk_option)):
            if ($bk_option['feat-tag'] != '') $feat_tag = $bk_option['feat-tag'];
        endif;
        $defaults = array('title' => '', 'category' => 'feat', 'display' => 'thumbnail');
		$instance = wp_parse_args((array) $instance, $defaults);
		extract($args);
        $title = $instance['title'];
		$cat_id = $instance['category'];
		$cat_name = get_cat_name($cat_id);
		$cat_url = get_category_link($cat_id );
        $display = $instance['display']; 
        		
        if ($cat_id == 'feat') {    
            if ($feat_tag != '') {
                $args = array(
    				'tag' => $feat_tag,
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => 5,
                    );   
            } else {
                $args = array(
    				'post__in'  => get_option( 'sticky_posts' ),
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => 5,
                    );
            }         
        } else { 
		$args = array(
				'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 5,
                );
        }
        $query = new WP_Query( $args ); 
        if ($query -> post_count < 2) { return;};
        echo $before_widget;
        if ( $title )
			echo $before_title . $title . $after_title;
		?>		
		<div class="module-post-hero-wrap section">
				
            <div class="module-post-hero-content-wrap clear-fix">
        		<?php if ( $query -> have_posts() ) : ?>
        			<?php $last_post  = $query -> post_count -1; ?>
        			<?php while ( $query -> have_posts() ) : $query -> the_post(); $post_id = get_the_ID();?>	
        				
        				<?php if ( $query->current_post == 0 ) { 
        				    $bk_url = get_post_meta($post_id, 'bk_media_embed_code_post', true);
                            $bk_parse_url = parse_url($bk_url);
                            ?>		
        					<div class="two-col main-post big-post <?php if(($display == 'video')&&( get_post_format( $post_id ) == 'video')) {echo 'hero-video';}?>">
    							<?php
                                if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.youtube.com')||($bk_parse_url['host'] == 'youtube.com'))){
                                    $yt_id = parse_youtube($bk_url);
                                    echo '<div class="thumb-wrap video-thumb">';
                                        echo("<div class='bk-oEmbed-video'>");                                    
                                            echo ('<iframe width="1050" height="591" src="http://www.youtube.com/embed/'.$yt_id.'?feature=oembed" allowFullScreen="true"></iframe>');
                                        echo '</div>';
                                    echo '</div>';
                                    ?> 
                                    <div class="post-details">
                            			<h3 class="post-title">
                                            <a href="<?php the_permalink() ?>">
                                                <?php $title = get_the_title();
                    							     echo the_excerpt_limit($title, 10); 
                                                ?>
                                            </a>
                                        </h3>
                                        
                                        <div class="post-meta post-meta-primary clear-fix">                   
                                        
                                            <div class="post-author">
                                                    <?php the_author_posts_link();?>                            
                                            </div>	
                                                                                     
                                            <div class="date">
                                				<?php echo get_the_date(); ?>
                                			</div>						   

                                        
                                            <div class="views">
                            					<i class="fa fa-eye"></i>									
                            					<?php echo getPostViews($post_id); ?>
                            				</div>
                               								
                            				<?php if ( comments_open() ) : ?>
                            					<div class="comments">
                            						<i class="fa fa-comment"></i>
                            						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
                            					</div>		
                        				    <?php endif; ?>
                                            
                                        </div>
                                        
                                    </div>
                                    <?php
                                    		
    							}else if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.vimeo.com')||($bk_parse_url['host'] == 'vimeo.com'))){
                                    $bk_vimeo_id = parse_vimeo($bk_url);
                                    echo '<div class="thumb-wrap video-thumb"> <div class="bk-oEmbed-video">';                                        
                                        echo ('<iframe src="//player.vimeo.com/video/'.$bk_vimeo_id.'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" title="The Quiet City: Winter in Paris" ></iframe>');
                                    echo '</div></div>';
                                    ?> 
                                    <div class="post-details">
                            			<h3 class="post-title">
                                            <a href="<?php the_permalink() ?>">
                                                <?php $title = get_the_title();
                    							     echo the_excerpt_limit($title, 10); 
                                                ?>
                                            </a>
                                        </h3>
                                        
                                        <div class="post-meta post-meta-primary clear-fix">                   
                                        
                                            <div class="post-author">
                                                    <?php the_author_posts_link();?>                            
                                            </div>	
                                                                                     
                                            <div class="date">
                                				<?php echo get_the_date(); ?>
                                			</div>						   

                                        
                                            <div class="views">
                            					<i class="fa fa-eye"></i>									
                            					<?php echo getPostViews($post_id); ?>
                            				</div>
                               								
                            				<?php if ( comments_open() ) : ?>
                            					<div class="comments">
                            						<i class="fa fa-comment"></i>
                            						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
                            					</div>		
                        				    <?php endif; ?>
                                            
                                        </div>
                                        
                                    </div>
                                    <?php
    							} else{	?>
    									<div class="thumb">
                                            <?php echo (bk_get_thumbnail($post_id, 'bk690_395'));?>
                                            <div class="post-info-overlay">
                                                <h2 class="post-cat post-cat-main-slider">                                                 
                                                <?php
                                                    $category = get_the_category( $post_id );
                                                    $cat_link = get_category_link( $category[0]->term_id );
                                                    echo '<a class="main-color-hover" href="'; echo $cat_link; echo '">';
                                                    echo $category[0]->cat_name;
                                                    echo '</a>';
                                                ?>                                           
                                                </h2>
                                                <div class="post-info-line"></div>								
            									<h2 class="post-title post-title-main-slider">
            										<a href="<?php the_permalink() ?>">
            											<?php
                                                            $title = the_title(FALSE);
                                                            $short_title = the_excerpt_limit($title, 10);
            												echo $short_title; 
            											?>
            										</a>
            									</h2>
                                            </div>
                                            <?php 
                                                echo bk_review_score($post_id);
                                            ?>
    									</div>   								
    						
    							<?php } ?>
                                            							
    						</div>
        				<?php } ?>
        			
        				<?php if ( $query->current_post == 1 ) { $close_wrap = true;?>
        					<div class="post-list">
                        <?php } ?>
                        <?php if (( $query->current_post == 1 ) || ($query->current_post == 3)) { $close_wrap = false;?>
                            <div class="one-col">
                        <?php } ?>
        					
        						<?php if ( $query->current_post >= 1 ) { ?>	
        							<div class="item-post clear-fix">
        								
        									<div class="thumb">
        										<a href="<?php the_permalink() ?>">
                                                    <?php echo (bk_get_thumbnail($post_id, 'bk75_75'));?>
                                                </a>
        									</div>
        														
        								<div class="sub-post clear-fix">
        									<h4 class="post-title post-title-sub-post">
                                                <a href="<?php the_permalink() ?>">
                                                    <?php $title = get_the_title();
        											     echo the_excerpt_limit($title, 10); 
                                                    ?>
                                                </a>
                                            </h4>
        									
        									<div class="post-meta clear-fix">                   
                    
                                                <div class="post-author">
                                                        <?php the_author_posts_link();?>                            
                                                </div>	
                                                                                         
                                                <div class="date">
                                    				<?php echo get_the_date(); ?>
                                    			</div>						   
                                			</div>
                                            								
        								</div>
        								
        							</div>
        						<?php 
                                
                                } ?>
                        <?php if (( $query->current_post == 2 ) || ($query->current_post == 4)) { $close_wrap = true;?>
                            </div>
                         <?php } ?>
        						
        				<?php if ($query->current_post == $last_post ) {
        				    if (!$close_wrap) {  ?>
                            </div>
                         <?php } ?>
        					</div>
        				<?php } ?>					
        				
        			<?php endwhile; ?>
        		<?php endif; ?>	
            </div>	<!-- End content-wrap -->	
		</div><!-- module-post-one-wrap -->
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
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = $new_instance['category'];
        $instance['display'] = $new_instance['display']; 
        return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('title' => '', 'category' => 'feat', 'display' => 'thumbnail');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
	<div class="field">		
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
            <label for="<?php echo $this->get_field_id( 'display' ); ?>"><strong><?php   _e('Video thumbnail option: ','bkninja'); ?></strong></label>    		 	
            <select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">            
                <option value="thumbnail" <?php if ($instance['display'] == 'thumbnail') echo 'selected="selected"'; ?>><?php _e('Thumbnail', 'bkninja');?></option>               
                <option value="video" <?php if ($instance['display'] == 'video') echo 'selected="selected"'; ?>><?php _e('Video', 'bkninja');?></option>                           	
             </select>          
        </p>
	</div>
		
	<?php }
}
    ?>