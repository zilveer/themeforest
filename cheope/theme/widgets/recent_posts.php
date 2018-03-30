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

if( !class_exists( 'recent_posts' ) ) :
class recent_posts extends WP_Widget {
    function __construct() {
    	unregister_widget( 'WP_Widget_Recent_Posts' );
		
        $widget_ops = array( 
            'classname' => 'recent-posts', 
            'description' => __('The latest posts, with a preview thumb.', 'yit') 
        );

        $control_ops = array( 'id_base' => 'recent-posts' );

        WP_Widget::__construct( 'recent-posts', __('Recent Posts', 'yit'), $widget_ops, $control_ops );
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        /* User-selected settings. */
        if( !isset( $instance['title'] ) )
            $instance['title'] = '';
            
        $title = apply_filters('widget_title', $instance['title'] );
		
        $items = isset( $instance['items']) ? $instance['items'] : '';
        $more_text = isset( $instance['more_text']) ? $instance['more_text'] : '';  
        $show_thumb = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : 'yes';
        $excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 10;
        $date = isset( $instance['date_excerpt']) ? $instance['date_excerpt'] : 'no';
        $show_comments = isset( $instance ['show_comments'] ) ? $instance['show_comments'] : 'no';

        echo $before_widget;
        
        if ( $title ) echo $before_title . $title . $after_title;

        $args = array(
           'posts_per_page' => $items,
           'orderby' => 'date',
           'ignore_sticky_posts' => 1
        );                            
        
        $args['order'] = 'DESC';

        $excluded_cats = yit_theme_get_excluded_categories( 2 );
        if( !empty( $excluded_cats ) ) {
            $args['cat'] = $excluded_cats;
        }
        
        $myposts = new WP_Query( $args );
    	
        $html = "\n";       
        $html .= '<div class="recent-post group">'."\n";
        
        if( $myposts->have_posts() ) : while( $myposts->have_posts() ) : $myposts->the_post();
            
            $img = '';
            if(has_post_thumbnail())
                { $img = get_the_post_thumbnail( get_the_ID(), 'blog_thumb' ); }
            else
                { $img = '<img src="'.get_template_directory_uri().'/images/no_image_recentposts.jpg" alt="No Image" />'; }
    		    
            $html .= '<div class="hentry-post group">'."\n";		
            if ( $show_thumb == 'yes' ) {                         
                $html .= "    <div class=\"thumb-img\">$img</div>\n";
                $html .= '<div class="text">';
            } else {
                $html .= '<div class="text without-thumbnail">';
            }
            
            $html .= the_title( '<a href="'.get_permalink().'" title="'.get_the_title().'" class="title">', '</a>', false );
            
            if( strpos( $more_text, "href='#'" ) ) {
                $post_readmore = str_replace( "href='#'", "href='" . get_permalink() . "'", str_replace( '"', "'", do_shortcode( $more_text ) ) );
            } else {
            	$post_readmore = $more_text;
            }
            if( $date == "yes" ) {
                $html .= '<p class="post-date">' . get_the_date();
                if( $show_comments == 'yes' ) {
                    $html .= ' - ' . get_comments_number() . ( get_comments_number() == 1 ? __( ' comment', 'yit' ) : __( ' comments', 'yit' ) );
                } else {
                    $html .= '';
                }
                
                $html .= '</p>';
            } else {
                $html .= '' . yit_content( 'excerpt', $excerpt_length, $post_readmore ) . '';   
            }
            $html .= '</div>'."\n";
    		$html .= '</div>'."\n";
        
        endwhile; endif; 
        
        wp_reset_query();
        $html .= '</div>';
        
        echo $html;
        
        add_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links
        
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['show_thumb'] = $new_instance['show_thumb'];           

        $instance['items'] = $new_instance['items'];           

        $instance['more_text'] = str_replace( '"', "'", $new_instance['more_text'] );
        
        $instance['excerpt_length'] = $new_instance['excerpt_length'];
        
        $instance['date_excerpt'] = $new_instance['date_excerpt'];
        
        $instance['show_comments'] = $new_instance['show_comments'];

        return $instance;
    }

    function form( $instance ) {   
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => __('Recent Posts', 'yit'), 
            'items' => 3,     
            'show_thumb' => 'no',     
            'more_text' => '|| ' . __( 'Read More', 'yit' ),
            'excerpt_length' => '10',
            'date_excerpt' => 'no',
            'show_comments' => 'no'
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
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
            <label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e( 'Items', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" value="<?php echo $instance['items']; ?>" size="3" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'date_excerpt' ); ?>"><?php _e( 'Show Post Date or Excerpt', 'yit' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'date_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'date_excerpt' ); ?>">
                    <option value="yes" <?php selected( $instance['date_excerpt'], 'yes' ) ?>><?php _e( 'Date', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['date_excerpt'], 'no' ) ?>><?php _e( 'Excerpt', 'yit' ) ?></option>
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
        
        <p>
            <label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Excerpt Lenght', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $instance['excerpt_length']; ?>"  size="3" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'more_text' ); ?>"><?php _e( 'More Text', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'more_text' ); ?>" name="<?php echo $this->get_field_name( 'more_text' ); ?>" value="<?php echo $instance['more_text']; ?>" class="widefat" />
            </label>
        </p>    
    <?php
    }
}
endif;