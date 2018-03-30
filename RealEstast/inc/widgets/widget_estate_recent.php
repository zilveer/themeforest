<?php

class PGL_Widget_Estate_Recent extends WP_Widget {
	function __construct() {
		$widget_options = array(
			'classname'   => 'tabsidebar',
			'description' => __( 'Recent estates', PGL )
		);
		parent::__construct( 'estate_recent', __( 'PixelGeekLab Estate recent', PGL ), $widget_options );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = empty($instance['title']) ? 'Recent estate' : $instance['title'];
		$count = empty($instance['count']) ? '5' : (int) $instance['count'];
		$query = new WP_Query('posts_per_page=' . $count . '&post_type=estate');
		echo $before_widget;
		if($title) {
			echo $before_title. $title .  $after_title;
			if($query->have_posts()) {
				echo '<ul class="product_list_wg">';
				while($query->have_posts()) {
					$query->the_post();
					$the_id = get_the_ID();
					?>
					<li>
						<div class="clearfix">
							<a title="" href="<?php the_permalink();?>">
								<?php PGL_Template_Tag::the_post_thumbnail($the_id,'estate-sidebar-widget-thumbnail');?>
								<span><?php the_title();?></span>
							</a>
							<div class="amount">
								<?php
								$price = get_post_meta($the_id,'estate_price', true);
								echo PGL_Addon_Estate::format_price($price);
								?>
							</div>
						</div>
					</li>
					<?php
				}
				echo '</ul>';
			}
		}
		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'count' => '5',
			'title'          => 'Recent estate'
		) );
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title');	?>"><?php _e('Widget title', PGL)?></label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('title');?>" id="<?php echo $this->get_field_id('title');?>" value="<?php echo esc_attr($instance['title'])?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count')?>"></label>
			<input type="text" name="<?php echo $this->get_field_name('count');?>" id="<?php echo $this->get_field_id('count');?>"  value="<?php echo esc_attr($instance['count']);?>"/>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$old_instance['title'] = sanitize_text_field($new_instance['title']);
		$old_instance['count'] = sanitize_text_field($new_instance['count']);
		return $old_instance;
	}


}