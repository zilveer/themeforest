<?php
add_action( 'widgets_init', 'tie_slider_widget' );
function tie_slider_widget() {
	register_widget( 'tie_slider' );
}
class tie_slider extends WP_Widget {

	function tie_slider() {
		$widget_ops 	= array( 'classname' => 'tie-slider' );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'tie-slider-widget' );
		parent::__construct( 'tie-slider-widget',THEME_NAME .' - '.__( 'Slider' , 'tie'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$no_of_posts 	= $instance['no_of_posts'];
		$cats_id 		= $instance['cats_id'];
		$custom_slider 	= $instance['custom_slider'];

		global $post;
		$original_post = $post;

		$argss 			= array('posts_per_page'=> $no_of_posts , 'cat' => $cats_id, 'no_found_rows' => 1 );
		$featured_query = new WP_Query( $argss );
		
	if( empty($custom_slider) ):
	if( $featured_query->have_posts() ) : ?>
	<div class="flexslider" id="<?php echo $args['widget_id']; ?>">
		<ul class="slides">
		<?php while ( $featured_query->have_posts() ) : $featured_query->the_post()?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
				<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'tie-large' ); ?>
				</a>
			<?php endif; ?>
				<div class="slider-caption">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>
			</li>
		<?php endwhile;?>
		</ul>
	</div>
	<?php endif; ?>
	<?php else :
		$custom_slider_args 	= array( 'post_type' => 'tie_slider', 'p' => $custom_slider, 'no_found_rows' => 1  ) ;
		$custom_slider_query 	= new WP_Query( $custom_slider_args );
	?>
	<div class="flexslider" id="<?php echo $args['widget_id']; ?>">
		<ul class="slides">
		<?php while ( $custom_slider_query->have_posts() ) : $custom_slider_query->the_post();
			$custom = get_post_custom($post->ID);
			$slider = unserialize( $custom["custom_slider"][0] );
			$number = count($slider);
				
			if( $slider ){
			foreach( $slider as $slide ): ?>	
			<li>
				<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo tie_slider_img_src( $slide['id'] , 'tie-large' ) ?>" alt="" />
				<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
				<?php if( !empty( $slide['title'] ) || !empty( $slide['caption'] ) ) :?>
				<div class="slider-caption">
					<?php if( !empty( $slide['title'] ) ):?><h2><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?><?php  echo stripslashes( $slide['title'] )  ?><?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?></h2><?php endif; ?>
					<?php if( !empty( $slide['caption'] ) ):?><p><?php echo stripslashes($slide['caption']) ; ?></p><?php endif; ?>
				</div>
				<?php endif; ?>
			</li>
			<?php endforeach; 
			}?>
		<?php endwhile;?>
		</ul>
	</div>
	<?php endif;

	$post = $original_post;
	wp_reset_query();
	?>
	<script>
	jQuery(document).ready(function() {
	  jQuery('#<?php echo $args['widget_id']; ?>').flexslider({
		animation: "fade",
		slideshowSpeed: 7000,
		animationSpeed: 600,
		randomize: false,
		pauseOnHover: true,
		prevText: "",
		nextText: "",
		controlNav: false
	  });
	});
	</script>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance 						= $old_instance;
		$instance['cat_posts_title'] 	= strip_tags( $new_instance['cat_posts_title'] );
		$instance['no_of_posts'] 		= strip_tags( $new_instance['no_of_posts'] );
		$instance['custom_slider'] 		=  $new_instance['custom_slider'] ;
		$instance['cats_id'] 			= implode(',' , $new_instance['cats_id']  );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'no_of_posts' => '5' , 'cats_id' => '1' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories();
		$categories 	= array();

		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}

		global $post;
		$original_post = $post;
		
		$sliders = array();
		$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
		while ( $custom_slider->have_posts() ) {
			$custom_slider->the_post();
			$sliders[get_the_ID()] = get_the_title();
		}
		$post = $original_post;
		wp_reset_query();
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e( 'Number of posts to show:' , 'tie') ?> </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php if( !empty($instance['no_of_posts']) ) echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<?php $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
			<label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php _e( 'Category:' , 'tie') ?></label>
			<select multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
				<?php foreach ($categories as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</p>
		<?php if(!empty($instance['custom_slider']))  $slider = $instance['custom_slider'] ; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_slider' ); ?>"><?php _e( 'Custom Slider:' , 'tie') ?> </label>
			<?php if( !empty($sliders) ):  ?>
			<select id="<?php echo $this->get_field_id( 'custom_slider' ); ?>" name="<?php echo $this->get_field_name( 'custom_slider' ); ?>">
				<option value=""><?php _e( 'Disable' , 'tie') ?></option>
				<?php foreach ($sliders as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( !empty( $slider ) && ( $key == $slider ) )  { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			<?php else: ?>
			<span style="color:#FF0000;"><?php _e( 'Add Custom sliders first .' , 'tie') ?></span>
			<?php endif; ?>
		</p>
	<?php
	}
}
?>