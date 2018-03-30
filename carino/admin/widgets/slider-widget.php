<?php
/**
  * Slider Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_slider_widget_init' );

function van_slider_widget_init(){
	register_widget( 'van_slider_widget' );
}

class van_slider_widget extends WP_Widget {
	function van_slider_widget() {
		$options = array( 'classname' => 'slider-widget' );
		$this->WP_Widget( 'slider-widget','( '. THEME_NAME .' ) - Slider Widget', $options );
	}
	function widget( $args, $instance ) {
		extract( $args );

		$title     = apply_filters('widget_title', $instance['title'] );
		$cats     = $instance['cats'];
		$number = $instance['number'];

		$query = new WP_Query( array( 'category__in' => $cats, 'posts_per_page' => $number ) );

		echo "<div class=\"skip-content\">";
		echo $before_widget;
		if( $title ){ echo $before_title . $title . $after_title;}
			if( $query->have_posts() ) :
			?>
			<div class="slider-cats-widget">
				<div class="slider-container">
					<div id="s-<?php echo $args['widget_id']; ?>" class="flexslider">
						<ul class="slides">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<li>
									<?php  if( has_post_thumbnail() && '' != get_the_post_thumbnail() ) : ?>
										<div class="entry-media">
										   	<a href="<?php the_permalink(); ?>">
										   		<?php van_thumb(300,190); ?>
										   		<div class="thumb-overlay"></div>
										   	</a>
										</div><!-- .post-thumb -->
									<?php	endif; ?>
									<h4 class="gallery-title">
										<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'van' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
									</h4>
								</li>
							<?php	endwhile; ?>
						</ul>
					</div><!-- .flexslider -->
					<script type="text/javascript">
					  jQuery(document).ready(function(){
						  jQuery("#s-<?php echo $args['widget_id']; ?>").flexslider({
							animationLoop: true,
							controlNav: false
						  });
					  });
					</script>
				</div><!-- .slider-container -->
			</div>
			<?php
			endif;
		wp_reset_query();
	 	echo $after_widget;
	 	echo "</div><!--.skip-content-->";
		
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['cats']         = $new_instance['cats'];
		$instance['number']    = strip_tags( $new_instance['number'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>'','cats' => array('1'), 'number' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>
		<p>
		<?php 
			$categories = get_categories('hide_empty=0'); 
			$wp_cats = array();  
			foreach ($categories as $category_list ) {  
		       		$wp_cats[$category_list->cat_ID] = $category_list->cat_name;  
			} 
                  ?>
			<label for="<?php echo $this->get_field_id( 'cats' ); ?>" style="display:block">Choose categories:</label>
			<select style="width:100%;" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" id="<?php echo $this->get_field_id( 'cats' ); ?>" multiple="multiple">
				<?php foreach ($wp_cats as $value => $key): ?>
					<option value="<?php echo $value; ?>" <?php if ( is_array( $instance['cats'] ) && in_array( $value ,$instance['cats'] ) ) { echo 'selected="selected"'; } ?> ><?php echo $key; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of posts :</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" style="width:40px;" type="text" />
		</p>
	<?php
	}
}