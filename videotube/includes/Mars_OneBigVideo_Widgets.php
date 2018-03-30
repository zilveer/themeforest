<?php
/**
 * VideoTube One Big Video Widget
 * Add One Big Video Widget in Home Page.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_OneBigVideo_Widgets') ){
	function Mars_OneBigVideo_Widgets() {
		register_widget('Mars_OneBigVideo_Widgets_Class');
	}
	add_action('widgets_init', 'Mars_OneBigVideo_Widgets');
}
class Mars_OneBigVideo_Widgets_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-onebigvideo-widgets', 'description' => __('VT Big Video/Post', 'mars') );
	
		parent::__construct( 'mars-onebigvideo-widgets' , __('VT Big Video/Post', 'mars') , $widget_ops);
	}

	function widget($args, $instance){
		wp_reset_postdata();
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$video_id = isset( $instance['video_id'] ) ? $instance['video_id'] : null;
		$thumbnail_size = isset( $instance['thumbnail_size'] ) ? esc_attr( $instance['thumbnail_size'] ) : 'blog-large-thumb';
		$view_more = isset( $instance['view_more'] ) && $instance['view_more'] != '#' ? esc_url( $instance['view_more'] ) : ( get_post_status( $video_id ) == 'publish' ? get_permalink( $video_id ) : null );
		?>
			<div class="video-section">
				<div class="section-header">
					<?php if( $title ):?>
						<h3><i class="fa <?php if( get_post_type( $video_id ) == 'video' ):?>fa-play<?php else: print 'fa-pencil';endif;?>"></i> <?php print $title;?></h3>
					<?php endif;?>
					<?php if( $view_more ):?>
						<div class="section-nav">
							<a href="<?php print $view_more;?>" class="viewmore"><?php _e('View More','mars');?> <i class="fa fa-angle-double-right"></i></a>
						</div>
					<?php endif;?>
				</div>
				<div <?php post_class('item list big');?>>
					<?php 
						if( isset( $video_id ) ):
						$post_type = get_post_type( $video_id );
						$wp_query = new WP_Query( array(
							'p'	=>	$video_id,
							'post_type'	=>	$post_type,
							'no_found_rows'	=>	true
						) );
						if( $wp_query->have_posts() ): $wp_query->the_post();
					?>
					<?php $post = get_post($video_id);?>
						<?php if( $post_type == 'video' ):?><div class="item-img"><?php endif;?>
						<?php 
							if( has_post_thumbnail($post->ID) ){
								print '<a href="'.get_permalink($video_id).'">'. get_the_post_thumbnail($video_id, $thumbnail_size , array('class'=>'img-responsive')) .'</a>';
							}
						?>
						<?php if( $post_type == 'video' ):?>
							<a href="<?php echo get_permalink($video_id); ?>"><div class="img-hover"></div></a>
						</div>
						<?php endif;?>
						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<?php if( $post_type == 'video' ):?>
							<?php do_action( 'mars_video_meta' );?>
						<?php endif;?>
						<?php the_excerpt();?>
						<?php if( get_post_type( $video_id ) == 'video' ):?>
							 <p><a href="<?php print get_permalink( $video_id);?>"><i class="fa fa-play-circle"></i><?php _e('Watch Video','mars')?></a></p>
						<?php endif;?>
						<?php endif;endif;?>
				</div>
			</div>		
		<?php 
		wp_reset_postdata();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_id'] = strip_tags( $new_instance['video_id'] );
		$instance['view_more'] = strip_tags( $new_instance['view_more'] );
		$instance['thumbnail_size']	=	esc_attr( $new_instance['thumbnail_size'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Latest Video/Post', 'mars'),
			'thumbnail_size'	=>	'blog-large-thumb'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo ( isset( $instance['title'] ) ? $instance['title'] : null ); ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_id' ); ?>"><?php _e('Enter a Post ID:', 'mars'); ?></label>
		    <input placeholder="<?php _e('example: 12','mars');?>" id="<?php echo $this->get_field_id( 'video_id' ); ?>" name="<?php echo $this->get_field_name( 'video_id' ); ?>" value="<?php echo ( isset( $instance['video_id'] ) ? $instance['video_id'] : null ); ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'thumbnail_size' ); ?>"><?php _e('Thumbnail Image Size:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'thumbnail_size' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_size' ); ?>" value="<?php echo ( isset( $instance['thumbnail_size'] ) ? $instance['thumbnail_size'] : null ); ?>" style="width:100%;" />
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'view_more' ); ?>"><?php _e('View more link:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'view_more' ); ?>" name="<?php echo $this->get_field_name( 'view_more' ); ?>" value="<?php echo ( isset( $instance['view_more'] ) ? $instance['view_more'] : null ); ?>" style="width:100%;" />
		    <small><?php _e('You can link this to the archive page or something else, or put "#" for default.','mars')?></small>
		</p>										
	<?php		
	}
}

