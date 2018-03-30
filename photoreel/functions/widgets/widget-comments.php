<?php
/*---------------------------------------------------------------------------------*/
/* Tabs widget */
/*---------------------------------------------------------------------------------*/
class Comments extends WP_Widget {

   function Comments() {
	   $widget_ops = array('description' => 'This is Comments widget.' );
       parent::WP_Widget(false, __('Themnific - Comments', 'themnific'),$widget_ops);      
   }

   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
	$postcount = $instance['postcount'];
	?>		
	<?php echo $before_widget; ?>
        <?php if ($title) { echo $before_title . $title . $after_title; } ?>
        	
            <ul class="inn">

			<?php
            
            $comment_posts = get_option('comment_posts');
            if (empty($comment_posts) || $comment_posts < 1) $comment_posts = $postcount;
            
            global $wpdb;
             
            $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
            comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
            comment_type,comment_author_url,
            SUBSTRING(comment_content,1,100) AS com_excerpt
            FROM $wpdb->comments
            LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
            $wpdb->posts.ID)
            WHERE comment_approved = '1' AND comment_type = '' AND
            post_password = ''
            ORDER BY comment_date_gmt DESC LIMIT ".$comment_posts;
            
            $comments = $wpdb->get_results($sql);
            
            foreach ($comments as $comment) {
            
            
            ?>
            <li class="com_post">
            
                    <?php echo get_avatar( $comment, '35' ); ?>
                    <p><span><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>">
                    <?php echo strip_tags($comment->comment_author); ?> says:</a></span>
                    <?php echo strip_tags($comment->com_excerpt); ?>...</p>
                </li>
           
            <?php 
            }
	echo '</ul>';
   }


   function form($instance) {   
   
   		$defaults = array('title' => '','postcount' => '');
		$instance = wp_parse_args((array) $instance, $defaults);    
   
       $title = esc_attr($instance['title']);
	   $postcount = esc_attr($instance['postcount']);

       ?>
       	<p>
	   	   	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','themnific'); ?></label>
	       	<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       	</p>
       
       	<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of comments', 'themnific') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
      <?php
   }

} 

register_widget('Comments');
?>