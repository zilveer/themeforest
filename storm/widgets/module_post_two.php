<?php
/**
 * Plugin Name: BK-Ninja: Module Post Two
 * Plugin URI: http://bk-ninja.com
 * Description: This module displays two main posts with list of four posts below
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://BK-Ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_module_post_two');

function bk_register_module_post_two(){
	register_widget('bk_module_post_two');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_module_post_two extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'module-post-two', 'description' => __('[Content module] Displays two main posts with list of four posts below in content section', 'bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_module_post_two', __('*BK: Module Posts Two', 'bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){
        $defaults = array('left_category' => '', 'right_category' => '', 'display' => 'thumbnail');
		$instance = wp_parse_args((array) $instance, $defaults);
		extract($args);
        $display = $instance['display']; 	
		echo $before_widget;	
		?>
        <div class="module-post-two-wrap">
    	   <!-- category1 -->
            <div class="one-col">
    			<?php
    				$cat_id = $instance['left_category'];
    			?>			
    			
    			<div class="cat-header">
    				<div class="cat-title">
    					<?php if (($cat_id) != ''){ 
    						$cat_name = get_cat_name($cat_id);
    						$cat_url = get_category_link($cat_id );
    					?>
    						<h3 ><a href="<?php echo esc_url( $cat_url ); ?>" ><?php echo $cat_name; ?></a></h3>	
    					<?php } else{ ?>
    						<h3 ><?php _e('Latest Posts', 'bkninja');?></h3>	
    					<?php } ?>	
    				</div>
    			</div>
    			<?php
    				$args = array(
    					'cat' => $cat_id,
    					'post_status' => 'publish',
    					'ignore_sticky_posts' => 1,
    					'posts_per_page' => 3
    				);
    			?>
    			<?php $query = new WP_Query( $args ); ?>
    			<?php if ( $query -> have_posts() ) : ?>
    				<?php $last_post  = $query -> post_count -1; ?>
                    
    				<?php while ( $query -> have_posts() ) : $query -> the_post(); $post_id = get_the_ID(); ?>	
    					
    					<?php if ( $query->current_post == 0 ) { ?>			
    						<div class="main-post">
    							<?php
                                $bk_url = get_post_meta($post_id, 'bk_media_embed_code_post', true);
                                $bk_parse_url = parse_url($bk_url);
                                if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.youtube.com')||($bk_parse_url['host'] == 'youtube.com'))){
                                    $yt_id = parse_youtube($bk_url);
                                    echo '<div class="thumb-wrap video-thumb">';
                                        echo("<div class='bk-oEmbed-video'>");                                    
                                            echo ('<iframe width="1050" height="591" src="http://www.youtube.com/embed/'.$yt_id.'?feature=oembed" allowFullScreen="true"></iframe>');
                                        echo '</div>';
                                    		
    							}else if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.vimeo.com')||($bk_parse_url['host'] == 'vimeo.com'))){
                                    $bk_vimeo_id = parse_vimeo($bk_url);
                                    echo '<div class="thumb-wrap video-thumb"> <div class="bk-oEmbed-video">';
                                        
                                        echo ('<iframe src="//player.vimeo.com/video/'.$bk_vimeo_id.'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" title="The Quiet City: Winter in Paris" ></iframe>');
                                    echo '</div>';
                                    		
    							} else{	?>
    								<div class="thumb-wrap">                                                       
    									<div class="thumb">
    										<a href="<?php the_permalink() ?>">
                                                <?php echo (bk_get_thumbnail($post_id, 'bk330_220'));?>
                                            </a>
                                            <?php 
                                                echo bk_review_score($post_id);
                                            ?>
    									</div>
    							<?php } ?>						
                                    
                                        <?php 
                        					$category = get_the_category(); 
                        					if($category[0]){?>  										
                        						<div class="post-cat post-cat-bg">
                        							<?php echo '<a  href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
                        						</div>					
                        						<?php
                        					}
                        				?>
                                    </div>
    							<div class="post-details">
    								<h3 class="post-title post-title-main-post">
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
                        			</div>
                                    
    								<div class="entry-excerpt">
                                    <?php 
                                    $string = get_the_excerpt();
                                    echo the_excerpt_limit($string, 35); ?>
                                    </div>
                                    
                                    <div class="post-meta post-meta-secondary clear-fix">
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
                                        
                                        <div class="read-more">
                                            <a href="<?php the_permalink() ?>"><?php _e('Read more','bkninja') ?></a>
                                        </div>
                                    </div>
                                    
    							</div>							
    						</div><!-- main post -->
    					<?php } ?>
    			
    					<?php if ( $query->current_post == 1 ) { ?>
    						<div class="post-list">
    						<?php } ?>
    					
    						<?php if ( $query->current_post >= 1 ) { ?>	
    							<div class="item-post">
        								
									<div class="thumb">
										<a href="<?php the_permalink() ?>">
                                            <?php echo (bk_get_thumbnail($post_id, 'bk75_75'));?>
                                        </a>
									</div>
    														
    								<div class="sub-post clear-fix">
    									<h3 class="post-title post-title-sub-post">
                                            <a href="<?php the_permalink() ?>">
                                            <?php $title = get_the_title();
    											 echo the_excerpt_limit($title, 10); 
                                            ?>
                                            </a>
                                        </h3>
    									
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
    						<?php } ?>
    						
    				<?php if (($query->current_post == $last_post ) && ($query->post_count > 1)) { ?>
    					</div>
    				<?php } ?>						
    				
    			<?php endwhile; ?>
    		<?php endif; ?>			
    	
    	<!-- category1 -->
    	</div>
	<!-- category2 -->
	
				
		<div class="one-col last">
			<?php
				$cat_id = $instance['right_category'];
			?>			
			
			<div class="cat-header">
				<div class="cat-title">
					<?php if (!empty($cat_id)){ 
						$cat_name = get_cat_name($cat_id);
						$cat_url = get_category_link($cat_id );
					?>
						<h3 ><a href="<?php echo esc_url( $cat_url ); ?>" ><?php echo $cat_name; ?></a></h3>	
					<?php } else{ ?>
						<h3 ><?php _e('Latest Posts', 'bkninja'); ?></h3>	
					<?php } ?>	
				
				</div>
			</div>
			<?php
				$args = array(
					'cat' => $cat_id,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => 3
				);
			?>
			<?php $query = new WP_Query( $args ); ?>
			<?php if ( $query -> have_posts() ) : ?>
				<?php $last_post  = $query -> post_count -1; ?>
				<?php while ( $query -> have_posts() ) : $query -> the_post(); $post_id = get_the_ID();?>	
					
					<?php if ( $query->current_post == 0 ) { ?>			
						<div class="main-post">
							<?php
                            $bk_url = get_post_meta($post_id, 'bk_media_embed_code_post', true);
                            $bk_parse_url = parse_url($bk_url);
                            if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.youtube.com')||($bk_parse_url['host'] == 'youtube.com'))){
                                $yt_id = parse_youtube($bk_url);
                                echo '<div class="thumb-wrap video-thumb">';
                                    echo("<div class='bk-oEmbed-video'>");                                    
                                        echo ('<iframe width="1050" height="591" src="http://www.youtube.com/embed/'.$yt_id.'?feature=oembed" allowFullScreen="true"></iframe>');
                                    echo '</div>';
                                		
							}else if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.vimeo.com')||($bk_parse_url['host'] == 'vimeo.com'))){
                                $bk_vimeo_id = parse_vimeo($bk_url);
                                echo '<div class="thumb-wrap video-thumb"> <div class="bk-oEmbed-video">';
                                    
                                    echo ('<iframe src="//player.vimeo.com/video/'.$bk_vimeo_id.'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" title="The Quiet City: Winter in Paris" ></iframe>');
                                echo '</div>';
							} else {?>
								<div class="thumb-wrap">
									<div class="thumb">
										<a href="<?php the_permalink() ?>">
                                            <?php echo (bk_get_thumbnail($post_id, 'bk330_220'));?>
                                        </a>
                                        <?php 
                                            echo bk_review_score($post_id);
                                        ?>
									</div>	
													
                            <?php } ?>		
                                                                    
                                <?php 
                                	$category = get_the_category(); 
                                	if($category[0]){?>  										
                                		<div class="post-cat post-cat-bg">
                                			<?php echo '<a  href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
                                		</div>					
                                		<?php
                                
                                	}
                                ?>

                            </div>
							<div class="post-details">
    								<h3 class="post-title post-title-main-post">
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
                        			</div>
                                    
    								<div class="entry-excerpt">
                                    <?php 
                                    $string = get_the_excerpt();
                                    echo the_excerpt_limit($string, 35); ?>
                                    </div>
                                    
                                    <div class="post-meta post-meta-secondary clear-fix">
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
                                        
                                        <div class="read-more">
                                            <a href="<?php the_permalink() ?>"><?php _e('Read more','bkninja') ?></a>
                                        </div>
                                    </div>
                                    
    							</div> <!-- Post detail -->							
						</div>
					<?php } ?>
			
					<?php if ( $query->current_post == 1 ) { ?>
						<div class="post-list">
						<?php } ?>
					
						<?php if ( $query->current_post >= 1 ) { ?>	
							<div class="item-post">
        								
								<div class="thumb">
									<a href="<?php the_permalink() ?>">
                                        <?php echo (bk_get_thumbnail($post_id, 'bk75_75'));?>
                                    </a>
								</div>
														
								<div class="sub-post clear-fix">
									<h3 class="post-title post-title-sub-post">
                                            <a href="<?php the_permalink() ?>">
                                            <?php $title = get_the_title();
    											 echo the_excerpt_limit($title, 10); 
                                            ?>
                                            </a>
                                    </h3>
									
									<div class="post-meta clear-fix">                   
            
                                        <div class="post-author">
                                                <?php the_author_posts_link();?>                            
                                        </div>	
                                                                                 
                                        <div class="date">
                            				<?php echo get_the_date(); ?>
                            			</div>						   
                        			</div>
                                    									
								</div><!-- sub-post -->
								
							</div><!-- item-post -->
						<?php } ?>
      
				<?php if (($query->current_post == $last_post ) && ($query->post_count > 1)) { ?>
					</div>
				<?php } ?>					
				
			<?php endwhile; ?>
		<?php endif; ?>			
		</div>
	</div>
	<!-- /category2 -->
	   <?php
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}
    
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['left_category'] = $new_instance['left_category'];
        $instance['right_category'] = $new_instance['right_category'];
        $instance['display'] = $new_instance['display'];       
        return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('left_category' => '', 'right_category' => '', 'display' => 'thumbnail');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

    <h4><?php _e('Left Column Category', 'bkninja'); ?></h4>	
	<div class="field">													
		<?php 
			$categories = get_categories( array( 'hide_empty' => 1 ) );  ?>
			<select id="<?php echo $this->get_field_id( 'left_category' ); ?>" name="<?php echo $this->get_field_name('left_category'); ?>" style="width:100%;">
				<option value='' <?php if ('' == $instance['left_category']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php foreach( $categories as $category ) : ?>
					<option <?php if ($category->term_id == $instance['left_category']) echo 'selected="selected"';?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
                <?php endforeach; ?>
			</select>											
	</div>
		
	<h4><?php _e('Right Column Category', 'bkninja'); ?></h4>

	<div class="field">														
			<select id="<?php echo $this->get_field_id( 'right_category' ); ?>" name="<?php echo $this->get_field_name('right_category'); ?>" style="width:100%;">
				<option value='' <?php if ('' == $instance['right_category']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php foreach( $categories as $category ) : ?>
					<option <?php if ($category->term_id == $instance['right_category']) echo 'selected="selected"';?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
				<?php endforeach; ?>
			</select>																						            
	</div>
    
    <p>     
        <label for="<?php echo $this->get_field_id( 'display' ); ?>"><strong><?php   _e('Video thumbnail option: ','bkninja'); ?></strong></label>    		 	
        <select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">            
            <option value="thumbnail" <?php if ($instance['display'] == 'thumbnail') echo 'selected="selected"'; ?>><?php _e('Thumbnail', 'bkninja');?></option>               
            <option value="video" <?php if ($instance['display'] == 'video') echo 'selected="selected"'; ?>><?php _e('Video', 'bkninja');?></option>                           	
         </select>          
    </p>
	<?php }
}
    ?>