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

if( !class_exists( 'last_post' ) ) :
class last_post extends WP_Widget
{
    function __construct()
    {
		$widget_ops = array( 
            'classname' => 'widget-last-post group', 
            'description' => __('Show the title of last post of blog, with ability to add an icon near the title of widget.', 'yit')
        );

		$control_ops = array( 'id_base' => 'last-post', 'width' => 430 );

		WP_Widget::__construct( 'last-post', 'Last Post', $widget_ops, $control_ops );
		
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        //wp_enqueue_script( 'media-upload' );
        add_action( 'admin_print_footer_scripts', array( &$this, 'add_script_textimage' ), 999 );
	}
	
	function form( $instance )
	{		
        /* Impostazioni di default del widget */
		$defaults = array( 
            'title' => '',
            'link' => '',
            'icon_img' => '',
            'more_text' => ' | ' . __( 'more &rarr;', 'yit' ),
            'img_url' => ''
        );
                                        
        $config = YIT_Config::load();
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label>
				<strong><?php _e( 'Title', 'yit' ) ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</label>
		</p> 
        
        <p>
			<label>
				<strong><?php _e( 'Link', 'yit' ) ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
			</label>
		</p>                
		
		<p>
			<?php _e( 'Icon', 'yit' ) ?>:
		     <select id="<?php echo $this->get_field_id( 'icon_img' ); ?>" name="<?php echo $this->get_field_name( 'icon_img' ); ?>">
		         <option value="0"></option>
                 <?php foreach ( $config['awesome_icons'] as $id_icon => $icon ) echo '<option value="'.$id_icon.'"'.selected( $id_icon, $instance['icon_img'], false ).'>'.$icon.'</option>'; ?>    
		     </select> <br /> 
		     <?php _e( 'or upload your icon:', 'yit' ) ?>
		     <input type="text" id="<?php echo $this->get_field_id( 'img_url' ); ?>" name="<?php echo $this->get_field_name( 'img_url' ); ?>" value="<?php echo $instance['img_url']; ?>" />
		    <a href="#" id="<?php echo $this->id ?>-upload-button" class="upload-image button-secondary">Upload</a>
        </p>  
		
		<p>
			<label>
				<strong><?php _e( 'More text', 'yit' ) ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'more_text' ); ?>" name="<?php echo $this->get_field_name( 'more_text' ); ?>" value="<?php echo $instance['more_text']; ?>" />
			</label>
		</p> 
		<?php
	}
	
	function widget( $args, $instance )
	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		$title = str_replace( '[', '<span>', $title );
		$title = str_replace( ']', '</span>', $title );
		
		if ( preg_match( '/<span>/', $title ) )
		    $reverse_icon = true;
		else
		    $reverse_icon = false;
		
		$icon = '';
		if ( ! empty( $instance['img_url'] ) ) {
            $icon = "<img class=\"imgicon\" src=\"$instance[img_url]\" alt=\"\" />";
            
        } else if ( ! empty( $instance['icon_img'] ) ) {   
    		$icon = "<i class=\"$instance[icon_img]";
    		if ( $reverse_icon ) $icon .= " reverse";
            $icon .= "\"></i>";
        } 
		
		echo $before_widget;
        
        if( !empty( $instance['link'] ) ) {
            $before_title = $before_title . '<a class="text-color" href="' . $instance['link'] . '" title="">';
            $after_title = '</a>' . $after_title;
        }
        
        $last_post = get_posts( array(
            'numberposts' => 1
        ) );
        
        $last_post = $last_post[0];
        
        ?>
		<?php echo $icon; ?>
		<?php echo $before_title; echo $title; echo $after_title; ?>
		<p><?php echo $last_post->post_title; ?> <a href="<?php echo get_permalink( $last_post->ID ) ?>"><?php echo $instance['more_text'] ?></a></p>
		
		<?php
            
        echo $after_widget;
	}                     

    function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
        
        $instance['link'] = $new_instance['link'];

		$instance['icon_img'] = $new_instance['icon_img'];

		$instance['img_url'] = $new_instance['img_url'];

		$instance['more_text'] = $new_instance['more_text'];

		return $instance;
	}              
	
	function add_script_textimage()
	{                          
	    global $pagenow;
	    
	    if ( $pagenow != 'widgets.php' )
	       { return; }
        ?>   
		<script type="text/javascript">               	

            jQuery(document).ready(function($){
                             
                 $('#<?php echo $this->id ?>-upload-button').live('click', function(){
            		var yiw_this_object = $(this).prev();
            		
            		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');    
            	
            		window.send_to_editor = function(html) {
            			imgurl = $('img', html).attr('src');
            			yiw_this_object.val(imgurl);
            			
            			tb_remove();
            		}          
            		
            		return false;
            	});
            });  
		</script> 
        <?php
    }
	
}     
endif;