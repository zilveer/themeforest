<?php
/**
 * Plugin Name: BK-Ninja: Tab Posts
 * Plugin URI: http://bk-ninja.com/
 * Description: This widhet displays the most recent and popular posts with thumbnails in the tabs.
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'bk_register_tabs_widget' );

function bk_register_tabs_widget() {
	register_widget( 'bk_tabs' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class bk_tabs extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-tabs', 'description' => __('[Sidebar widget] Displays tabs of recent, popular posts and comments in sidebar.', 'bkninja') );

		/* Create the widget. */
		parent::__construct( 'bk_tabs', __('*BK: Widget Tabs', 'bkninja'), $widget_ops);
	}
    
	/**
	 *display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
		
		/* if ( $title )
		echo $before_title . $title . $after_title; */
		$entries_display = $instance['entries_display'] ;
        
		if( (!isset($entries_display)) || ($entries_display == NULL)){ 
            $entries_display = '5'; 
        }
		
		$args_latest = array(
			'post_type' => 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $entries_display		
		);	
        $recent_post = $instance['recent-post-tab'];
        $popular_post = $instance['popular-post-tab'];
        $recent_comment = $instance['recent-comment-tab'];

        if(($recent_post != 'on' && $popular_post != 'on')
            ||($recent_post != 'on' && $recent_comment != 'on')
            ||$recent_comment != 'on' && $popular_post != 'on'){
            $full_tab = null;
        }else{
            $full_tab = 'on';
        }
        $uid = uniqid();
		?>        
        <div class="widget-tabs-title-container">
			<ul class="widget-tab-titles">
                <?php if($recent_post == 'on') {?>
				    <li class="active"><h3><a href="#widget-tab1-content-<?php echo $uid;?>"><?php $full_tab ? _e('Recent','bkninja'): _e('Latest Posts', 'bkninja'); ?></a></h3></li>
                <?php }?>
                <?php if($popular_post == 'on') {?>
				    <li class="<?php if($recent_post != 'on') { echo "active"; }?>"><h3><a href="#widget-tab2-content-<?php echo $uid;?>"><?php $full_tab ? _e('Popular','bkninja'): _e('Popular Posts', 'bkninja'); ?></a></h3></li>
                <?php }?>
                <?php if($recent_comment == 'on') {?>
				    <li class="<?php if(($recent_post != 'on') && ($popular_post != 'on')) { echo "active"; }?>"><h3><a href="#widget-tab3-content-<?php echo $uid;?>"><?php $full_tab ? _e('Comments','bkninja'): _e('Latest Comments', 'bkninja'); ?></a></h3></li>
                <?php }?>
            </ul>
		</div>
        <?php if($recent_post == 'on') {?>      			
			<div id="widget-tab1-content-<?php echo $uid;?>" class="tab-content" <?php if($recent_post == 'on') { echo 'style="display: block;"';}?>>	
				<?php $latest_posts = new WP_Query( $args_latest ); ?>
				<?php if ( $latest_posts -> have_posts() ) : ?>

					<ul class="list post-list">
    					<?php while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); $post_id = get_the_ID(); ?>					
    						<li>
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
                                    </div>
                                                                       
                                    <div class="post-meta post-meta-secondary clear-fix">
                                        <div class="views">
                        					<i class="fa fa-eye"></i>									
                        					<?php echo getPostViews(get_the_ID()); ?>
                        				</div>
                           								
                        				<?php if ( comments_open() ) : ?>
                        					<div class="comments">
                        						<i class="fa fa-comment"></i>
                        						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
                        					</div>		
                    				    <?php endif; ?>
                                        
                                    </div>									
    							</div>
    						</li>
    					<?php endwhile; ?>
					</ul>
				<?php endif;?>
			</div>
		<?php }?>
        
        <?php if($popular_post == 'on') {?>
			<div id="widget-tab2-content-<?php echo $uid;?>" class="tab-content" <?php if($recent_post != 'on') { echo 'style="display: block;"'; }?>>
				<?php
					$args_popular = array(
						'post_type' => 'post',
						'ignore_sticky_posts' => 1,
						'posts_per_page' => $entries_display,
						'orderby' => 'comment_count'						
					);	
				?>
				<?php $latest_posts = new WP_Query( $args_popular ); ?>
				<?php if ( $latest_posts -> have_posts() ) : ?>
					<ul class="list post-list">
    					<?php while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); $post_id = get_the_ID(); ?>					
    						<li>
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
                        			</div>
                                                                       
                                    <div class="post-meta post-meta-secondary clear-fix">
                                        <div class="views">
                        					<i class="fa fa-eye"></i>									
                        					<?php echo getPostViews(get_the_ID()); ?>
                        				</div>
                           								
                        				<?php if ( comments_open() ) : ?>
                        					<div class="comments">
                        						<i class="fa fa-comment"></i>
                        						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
                        					</div>		
                    				    <?php endif; ?>
                                        
                                    </div>									
								</div>
    						</li>
    					<?php endwhile; ?>
					</ul>
			    <?php endif;?>
			</div>
		<?php }?>
        
        <?php if($recent_comment == 'on') {?>
			<div id="widget-tab3-content-<?php echo $uid;?>" class="tab-content" <?php if(($recent_post != 'on') && ($popular_post != 'on')) { echo 'style="display: block;"'; }?>>
				<ul class="list comment-list">
					<?php 
						//get recent comments
						$args = array(
							   'status' => 'approve',
								'number' => $entries_display
							);	
						$comments = get_comments($args);
						
						foreach($comments as $comment) :							
								$commentcontent = strip_tags($comment->comment_content);			
								$commentcontent = the_excerpt_limit($commentcontent, 20);

                                
								$commentauthor = $comment->comment_author;
								if (strlen($commentauthor)> 30) {
									$commentauthor = mb_substr($commentauthor, 0, 29) . "...";			
								}
								$commentid = $comment->comment_ID;
								$commenturl = get_comment_link($commentid); 
                                
                                $bk_postid = $comment->comment_post_ID;
                                $title = get_the_title($bk_postid);
                                $short_title = the_excerpt_limit($title, 10);
			                   ?>
							   <li>
									<div class="thumbnail">
										<?php echo get_avatar( $comment, '70' ); ?>
									</div>
									<div class="sub-post">
										<div class="comment-author"><?php echo $commentauthor; ?></div>
                                        <div class="date">
                                            <?php echo (' on '.get_comment_date('F j, Y', $commentid)); ?>
                                        </div>        										
                                        <div class="post-title post-title-commented">
                                            <a href="<?php echo get_permalink($bk_postid) ?>"><?php echo $short_title; ?></a>
                                        </div>
										<div class="comment-text">
											<a href="<?php echo $commenturl; ?>"><?php echo $commentcontent; ?></a>
										</div>
									</div>
								</li>
					<?php endforeach; ?>
				</ul>
			</div>
        <?php }?>
    <?php
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['entries_display'] = strip_tags($new_instance['entries_display']);
        $instance['recent-post-tab'] = $new_instance['recent-post-tab'];
        $instance['popular-post-tab'] = $new_instance['popular-post-tab'];
        $instance['recent-comment-tab'] = $new_instance['recent-comment-tab'];
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array('entries_display' => 5, 'recent-post-tab' => 'on', 'popular-post-tab' => 'on', 'recent-comment-tab' => 'on'
                    );
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
        <p><input id="<?php echo $this->get_field_id('recent-post-tab'); ?>" type="checkbox" name="<?php echo $this->get_field_name('recent-post-tab'); ?>" <?php checked($instance['recent-post-tab'], 'on'); ?>/>
        <label for="<?php echo $this->get_field_id( 'recent-post-tab' ); ?>"><?php _e('Recent posts tab', 'bkninja'); ?></label></p>        
        
        <p><input id="<?php echo $this->get_field_id('popular-post-tab'); ?>" type="checkbox" name="<?php echo $this->get_field_name('popular-post-tab'); ?>" <?php checked($instance['popular-post-tab'], 'on'); ?>/>
        <label for="<?php echo $this->get_field_id( 'popular-post-tab' ); ?>"><?php _e('Popular posts tab', 'bkninja'); ?></label></p>
        
        <p><input id="<?php echo $this->get_field_id('recent-comment-tab'); ?>" type="checkbox" name="<?php echo $this->get_field_name('recent-comment-tab'); ?>" <?php checked($instance['recent-comment-tab'], 'on'); ?>/>
        <label for="<?php echo $this->get_field_id( 'recent-comment-tab' ); ?>"><?php _e('Recent comments tab', 'bkninja'); ?></label></p>
        
        <p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><strong><?php _e('Number of entries to display: ', 'bkninja'); ?></strong></label>
		<input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>
        
<?php
	}
}
?>
