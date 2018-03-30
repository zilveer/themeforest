<?php
class widget_latest_posts extends WP_Widget {

	function widget_latest_posts() {
	/*Constructor*/
		$widget_ops = array('classname' => 'widget_latest_posts ', 'description' => __( 'Latest Posts' , 'cosmotheme' ) );
		$this->__construct('widget_cosmo_latestPosts', _TN_ . ' : ' . __( 'Latest Posts' , 'cosmotheme' ), $widget_ops);
	}
	
	function widget($args, $instance) {
        /* prints the widget*/
		extract($args, EXTR_SKIP);
        
		echo $before_widget;

		$title = empty($instance['title']) ? __('Latest Posts','cosmotheme') : apply_filters('widget_title', $instance['title']);
		$number = empty($instance['number']) ? 3 : apply_filters('widget_number', $instance['number']);

        if( strlen( $title) > 0 ){
            echo $before_title . $title . $after_title;
        }
?>
		
        <?php

            $recent = get_posts(array('orderby' => 'created', 'numberposts' =>$number ));  /*NOTE use settings*/
            if( is_array( $recent ) && !empty( $recent ) ){
                ?><ul class="widget-list"><?php
                foreach( $recent as $post )  {
					if( get_post_thumbnail_id( $post -> ID ) ){
								$post_img = wp_get_attachment_image( get_post_thumbnail_id( $post -> ID ) , 'tsmall' , '' );
								$cnt_a1 = ' href="' . get_permalink($post -> ID) . '"';
								$cnt_a2 = ' href="' . get_permalink($post -> ID) . '#comments"';
								$cnt_a3 = ' class="entry-img" href="' . get_permalink($post -> ID) . '"';
								
							}else{
								$post_img = '<img src="' . get_template_directory_uri() . '/images/no.image.' . image::tsize( 'tsmall' ) . '.png" alt="" />';
								$cnt_a1 = ' href="' . get_permalink($post -> ID) . '"';
								$cnt_a2 = ' href="' . get_permalink($post -> ID) . '#comments"';
								$cnt_a3 = ' class="entry-img" href="' . get_permalink($post -> ID) . '"';
							}

					$likes = meta::get_meta( $post -> ID , 'like' );
					$nr_like = count( $likes );
					?>
                    <li>
                        
						<article class="row">
							<div class="four mobile-one columns">
                                <a <?php echo $cnt_a3; ?>><?php echo $post_img; ?></a>
                            </div>
                            <div class="eight mobile-three columns">
                                <h6>
                                	<a <?php echo $cnt_a1; ?>>
									<?php
										echo mb_substr( $post -> post_title , 0 , BLOCK_TITLE_LEN );
										if( strlen( $post->post_title ) > BLOCK_TITLE_LEN ) {
											echo '...';
										}
									?>
									</a>
								</h6>
								<div class="widget-meta">
										<ul>
											<?php
	                                            if ( $post -> comment_status == 'open' ) {
	                                        ?>
												<li class="cosmo-comments">
                                        	        <a <?php echo $cnt_a2; ?>>
	                                                	<i class="icon-comments"></i>
	                                                	<span class="comments-count">
	                                                    <?php
	                                                        if( options::logic( 'general' , 'fb_comments' ) ){
	                                                            ?> <fb:comments-count href=<?php echo get_permalink( $post -> ID  ) ?>></fb:comments-count> <?php
	                                                        }else{
	                                                            echo $post -> comment_count . ' ';
	                                                        }
	                                                    ?>
	                                                	</span>
	                                                </a>
		                                        </li>
											<?php
	                                            }
	                                        ?>
		                                    <?php
		                                        if( options::logic( 'likes' , 'enb_likes' ) ){
		                                    ?>
		                                    		<li class=" thelike">
									                    <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false, $additional_class = 'icon-like');  ?>
									                </li>
		                                    <?php    	
		                                        }
		                                    ?>
										</ul>
									</div>
                            </div>
						</article>
                    </li>
        <?php

                }
                ?></ul><?php
            }
            
            wp_reset_query();

            echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {

	/*save the widget*/
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		
		return $instance;
	}
	
	function form($instance) {
	/*widgetform in backend*/

		$instance = wp_parse_args( (array) $instance, array('title' => '',  'number' => '') );
		$title = strip_tags($instance['title']);
		$number = strip_tags($instance['number']);
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','cosmotheme') ?>: 
			    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts','cosmotheme') ?>:
		        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
		    </label>
		</p>
<?php 		
		
		$title = strip_tags( $instance['title'] );
		$number = strip_tags( $instance['number'] );
	}	
}
?>