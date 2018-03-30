<?php

class SWPF_Blog_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'SWPF_Blog_Widget', // Base ID  
                'Sellya Blog', // Name  
                array(
                    'description' => __('This widget will show Blog','sellya')
                )
        );
    }
    public function form($instance){
        $defaults = array(
            'title' => 'Sellya Blog', 
            'blog_show' => 5); 
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>  
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'sellya'); ?></label>  
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:216px;" />  
        </p> 
        <p>  
            <label for="<?php echo $this->get_field_id('blog_show'); ?>"><?php _e('Show Blog:', 'sellya'); ?></label>  
            <input id="<?php echo $this->get_field_id('blog_show'); ?>" name="<?php echo $this->get_field_name('blog_show'); ?>" value="<?php echo $instance['blog_show'] ?>" style="width:216px;" />  
        </p> 
        <?php
    }
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['blog_show'] = strip_tags($new_instance['blog_show']);
        return $instance;
    }
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $blog_show=$instance['blog_show'];
         extract($args, EXTR_SKIP);
            echo $before_widget;
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
            
            
               	echo '<div class="sds_blog">';
                     echo '<ul>';
	
                        global $wpdb;
                        $result = new WP_Query( 'ignore_sticky_posts=1&posts_per_page='.$blog_show );
			while ($result->have_posts()) : $result->the_post(); ?>	
				<li>
					<?php if((function_exists('has_post_thumbnail') && has_post_thumbnail($id))) 
                                         { ?>
					<div class="sds_post_thumb">
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
					</div>
					<?php } ?>
					<a href="<?php the_permalink(); ?>"><strong><?php the_title();?></strong></a>
					<div class="sds_post">
                                            <span><?php the_date(); ?></span>,
                                            <span><?php comments_popup_link(__('No Comments', 'sellya'), __('1 Comment', 'sellya'), __('% Comments', 'sellya'),'',__( 'Comments off', 'sellya' )); ?></span>
					</div>
				</li>
						
			<?php endwhile; 
                    ?>
            </ul>
            <?php
		echo '</div>';
            echo $after_widget;
         
    }

}
add_action('widgets_init', create_function('', 'register_widget( "SWPF_Blog_Widget" );'));
?>