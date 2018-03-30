<?php
/**
 * Plugin Name: Crunchpress Tab Widget
 * Description: A widget that show popular, latest, comments
 * Version: 1.0
 * Author: Nasir hayat
 * Author URI: http://nasirhayat.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'tab_widget' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function tab_widget() {
	register_widget( 'tab_widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class tab_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  tab_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'cp_popularpost-widget', 'description' => __('A widget that show popular posts', 'crunchpress') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'cp_popularpost-widget' );

		/* Create the widget. */
		parent::__construct( 'cp_popularpost-widget', __(THEME_NAME. ' - Tab Widget', 'crunchpress'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('Popular Posts', $instance['title'] );
		$show_num = $instance['show_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		/*if($title){
			echo $before_title . $title . $after_title;
		}*/
		/* Display the widget title if one was input (before and after defined by themes). */
	?>
       <!--SOCIAL WIDGET START-->

        <section class="widget tabs-widget">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#recent">Recent</a></li>
              <li><a href="#commented">Commented</a></li>
              <li><a href="#popular">Popular</a></li>
            </ul>
            <div class="tab-content">
              <div id="recent" class="tab-pane active">
                    <?php wp_reset_postdata();
                        $rec_posts = get_posts('post_type=post&showposts='.$show_num.'');
                        if( !empty($rec_posts) ){ 
                        echo '<div class="small-thumbs">';
                        echo "<ul>";
                        foreach($rec_posts as $rec_post) { 	
                        setup_postdata( $rec_post ); ?> 
                          <li>
                              <figure>
                                <div class="thumb"> 
                                     <a href="<?php echo get_permalink( $rec_post->ID ); ?>">
                                        <?php
                                            $thumbnail_id = get_post_thumbnail_id( $rec_post->ID );				
                                            $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '100x66' );	
                                            $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
                                            if( !empty($thumbnail) ){
                                                echo '<img src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>';
                                            }else{
                                            echo '<img style="width:100px; height:66px; " src="' .CP_THEME_PATH_URL.'/images/footer-gallery2.png" width="100px" height="66px" alt="no image"/>';	
                                            }
                                        ?>
                                    </a>
                                  <div class="play"><a href="<?php echo get_permalink($rec_post->ID); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play2.png" alt=""></a></div>
                                </div>
                                <figcaption>
                                  <h5><?php echo '<a href="' . get_permalink($rec_post->ID) . '">' . get_the_title($rec_post->ID) . '</a>'; ?></h5>
                                  <p><?php echo substr($rec_post->post_content,0,40); ?>... </p>
                                  <p class="color"><?php echo get_the_time("Y-m-d", $rec_post->ID); ?></p>
                                </figcaption>
                              </figure>
                            </li>
                             
                            <?php 
                        }
                        echo "</ul>";
                        echo '</div>';
                    } wp_reset_postdata(); ?>
                 <!--LIST ITEMS START-->
              </div>
              <div id="commented" class="tab-pane">
                <div class="small-thumbs">
                  <ul>
                            <?php              
                            $no_comments = false;         
                            $avatar_size = '66';   
                            $comments_total = new WP_Comment_Query();     
                            $comments_total_number = $comments_total->query(array('count' => 1));   
                            $last_page = ceil($comments_total_number / $show_num);       
                            $comments_query = new WP_Comment_Query();   
                            $comments = $comments_query->query( array( 'number' => $show_num ) );    
                            if ( $comments ) : foreach ( $comments as $comment ) : ?> 
                            <li>
                              <figure>
                                <div class="thumb"> 
                                      <a href="<?php echo get_comment_link($comment->comment_ID); ?>">
                                                    <?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?>     
                                       </a>  
                                </div>
                                <figcaption>
                                  <p><?php echo  get_comment_excerpt( $comment->comment_ID );?></p>
                                </figcaption>
                              </figure>
                            </li>
                            <?php endforeach; 
                            endif; ?>       
                              </ul>
                            </div>
                          </div>
              <div id="popular" class="tab-pane">
             <?php wp_reset_postdata();
                        $pop_posts = get_posts('post_type=post&showposts='.$show_num.'&orderby=comment_count');
                        if( !empty($pop_posts) ){ 
                        echo '<div class="small-thumbs">';
                        echo "<ul>";
                        foreach($pop_posts as $pop_post) { 	
                        setup_postdata( $pop_post ); ?> 
                        
                          <li>
                              <figure>
                                <div class="thumb"> 
                                     <a href="<?php echo get_permalink( $pop_post->ID ); ?>">
                                        <?php
                                            $thumbnail_id = get_post_thumbnail_id( $pop_post->ID );				
                                            $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '100x66' );	
                                            $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
                                            if( !empty($thumbnail) ){
                                                echo '<img src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>';
                                            }else{
                                            echo '<img style="width:100px; height:66px; " src="' .CP_THEME_PATH_URL.'/images/footer-gallery2.png" width="100px" height="66px" alt="no image"/>';	
                                            }
                                        ?>
                                    </a>
                                 <div class="play"><a href="<?php echo get_permalink($rec_post->ID); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play2.png" alt=""></a></div>
                                </div>
                                <figcaption>
                                  <h5><?php echo '<a href="' . get_permalink($rec_post->ID) . '">' . get_the_title($rec_post->ID) . '</a>'; ?></h5>
                                  <p><?php echo substr($rec_post->post_content,0,40); ?>... </p>
                                  <p class="color"><?php echo get_the_time("Y-m-d", $pop_post->ID); ?></p>
                                </figcaption>
                              </figure>
                            </li>
                             
                            <?php 
                        }
                        echo "</ul>";
                        echo '</div>';
                    } wp_reset_postdata(); ?>
              </div>
            </div>            
        </section>  
                    <!--SOCIAL WIDGET END-->
    <?php 
		/* After widget (defined by themes). */
		echo '<div>';
		echo $after_widget;
	}
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );

		return $instance;
	}
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Popular Projects', 'crunchpress'), 'post_cat' => __('0', 'crunchpress'), 'show_num' => '4');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<?php /*?><p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'crunchpress'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>
		<?php */?>
		<!-- Your Name: Text Input -->
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count :', 'crunchpress'); ?></label>
			<input id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" value="<?php echo $instance['show_num']; ?>" class="width100" />
		</p>
		
	<?php
	}
}

?>