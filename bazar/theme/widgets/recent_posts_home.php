<?php
/**
 * Your Inspiration Themes 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( !class_exists( 'recent_posts_home' ) ) :
class recent_posts_home extends WP_Widget {
    function __construct() {
		
        $widget_ops = array( 
            'classname' => 'recent-posts-home recent-posts', 
            'description' => __('The latest posts, with a preview thumb. The widget must be used only in Home widget area', 'yit') 
        );

        $control_ops = array( 'id_base' => 'recent-posts-home' );

        WP_Widget::__construct( 'recent-posts-home', __('Home Recent Posts', 'yit'), $widget_ops, $control_ops );
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        /* User-selected settings. */
        if( !isset( $instance['title'] ) )
            $instance['title'] = '';
            
        $title = apply_filters('widget_title', $instance['title'] );
		
        $items = isset( $instance['items']) ? $instance['items'] : '';
        $show_thumb = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : 'yes';
        $show_comments = isset( $instance ['show_comments'] ) ? $instance['show_comments'] : 'yes';


        echo str_replace('span3', 'span6', $before_widget);
		
		echo '<div class="border-1 border">';
		echo '<div class="border-2 border">';
        
        if ( $title ) echo $before_title . $title . $after_title;

        $args = array(
           'posts_per_page' => $items,
           'orderby' => 'date',
           'ignore_sticky_posts' => 1
        );                            
        
        $args['order'] = 'DESC'; 
        
        $myposts = new WP_Query( $args );
    	
        $html = "\n";       
        $html .= '<div class="recent-post group">'."\n";
        
        if( $myposts->have_posts() ) : while( $myposts->have_posts() ) : $myposts->the_post();
            
            $html .= '<div class="hentry-post group">'."\n";	
			
				// DATE
	            $html .= '<p class="post-date">' . get_the_date( 'M' ) . '<br /><span>' . get_the_date( 'd' ) . '</span></p>';
            
				// border (thumb, title, author and comments)
            	$html .= '<div class="border group">';
			
					// THUMB
		            if ( $show_thumb == 'yes' && has_post_thumbnail()) {
		            	
						$img = '';
		            	if(has_post_thumbnail()) $img = yit_image( "size=blog_thumb", false );
		            	else $img = '<img src="'.get_template_directory_uri().'/images/no_image_recentposts.jpg" alt="No Image" />';
						
		                $html .= "<div class=\"thumb-img\">$img</div>\n";
		                $html .= '<div class="title">';
						
		            } else {
		                $html .= '<div class="title without-thumbnail">';
		            }
		            
						// TITLE
			            $html .= the_title( '<a href="'.get_permalink().'" title="'.get_the_title().'" class="title">', '</a>', false );
			            
						// ATUTHOR
						$html .= '<span class="posted_by">' . __( 'posted by', 'yit' ) . ' <a href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_the_author() . '</a></span>' ;
					
					// close title div
		            $html .= '</div>'."\n";
					
					// COMMENTS
					if( $show_comments == 'yes' )
		                $html .= '<div class="comments ' . ( get_comments_number() == 0 ? 'no' : 'yes' ) . '"><span>' . get_comments_number() . '</span></div>';
				
				// close border div
	            $html .= '</div><div class="clear"></div>'."\n";
			 // close entry-post div
    		$html .= '</div><div class="clear"></div>'."\n";
        
        endwhile; endif; 
        
        wp_reset_query();
        $html .= '</div>';
        
        echo $html;
        
        add_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links
        
        echo '</div></div>' . $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['items'] = $new_instance['items'];           
		
        $instance['show_thumb'] = $new_instance['show_thumb'];           
        
        $instance['show_comments'] = $new_instance['show_comments'];

        return $instance;
    }

    function form( $instance ) {   
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => __('Recent Posts', 'yit'), 
            'items' => 2,     
            'show_thumb' => 'yes',
            'show_comments' => 'yes'
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e( 'Items', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" value="<?php echo $instance['items']; ?>" size="3" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Show thumbnail', 'yit' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>">
                    <option value="yes" <?php selected( $instance['show_thumb'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['show_thumb'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                 </select>
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'show_comments' ); ?>"><?php _e( 'Show number of comments', 'yit' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'show_comments' ); ?>" name="<?php echo $this->get_field_name( 'show_comments' ); ?>">
                    <option value="yes" <?php selected( $instance['show_comments'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['show_comments'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                 </select>
            </label>
        </p>   
    <?php
    }
}
endif;