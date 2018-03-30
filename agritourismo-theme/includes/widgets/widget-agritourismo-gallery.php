<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_gallery");'));

class OT_gallery extends WP_Widget {
	function OT_gallery() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Latest Galleries');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
		 $count = esc_attr($instance['count']);
		 $color = esc_attr($instance['color']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php  printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php  printf ( __( 'Item shown:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['color'] = strip_tags($new_instance['color']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$counter=1;
		if(!$count) $count=3;

		
		$args = array('post_type' => 'gallery', 'showposts' => $count);
		$my_query = new WP_Query($args);
		
		$totalCount = $my_query->found_posts;
        ?>
        <?php echo $before_widget; ?>
			<?php if($title) echo $before_title.$title.$after_title; ?>
			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<?php
					global $post;
					$g = $post->ID;
					$gallery_style = get_post_meta ( $post->ID, THEME_NAME."_gallery_style", true );
				?>
				<div class="widget-gallery" rel="gallery-<?php echo $g;?>">
					<div class="gallery-photos">
						<a href="#gal-prev" class="icon-text">&#59233;</a>
						<a href="#gal-next" class="icon-text">&#59234;</a>
						<ul>
							<?php
								$args = array( 'post_type' => 'attachment', 'numberposts' => 10, 'post_parent' => $g, 'post_status' => null, 'order'=> 'ASC', 'orderby'=> 'menu_order' ); 
								$attachments = get_posts($args);
								$c=1;
								if ($attachments) {
									foreach($attachments as $attachment) {
									$file = wp_get_attachment_url($attachment->ID);
									$image = get_post_thumb(false, 208, 152, false, $file);
									
									?>
										<li<?php if($c==1) { ?> class="active"<?php } ?>>
											<a href="<?php the_permalink();?>?page=<?php echo $c;?>" class="photo-border-2<?php if($gallery_style=="lightbox") { echo ' light-show '; } ?>" data-id="gallery-<?php echo $g;?>">
												<img src="<?php echo $image['src'];?>" data-id="<?php echo $c;?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
											</a>
										</li>
									<?php 	
									$c++;
									} 
								} 
							?>
						</ul>
					</div>
					<a href="<?php the_permalink();?>" class="button-link right"><?php _e("View Gallery", THEME_NAME);?><span class="icon-text">&#9656;</span></a>
					<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
					<div class="clear-float"></div>
				</div>
			<?php $counter++; ?>
			<?php endwhile; ?>
			<?php endif; ?>	
		<?php echo $after_widget; ?>	
        <?php
	}
}
?>
