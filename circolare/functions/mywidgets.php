<?php

/* Blogposts Widget */
add_action( 'widgets_init', 'circolare_blogposts_load_widgets' );

function circolare_blogposts_load_widgets() {
	register_widget( 'Circolare_blogposts_Widget' );
}

class Circolare_blogposts_Widget extends WP_Widget {

	function Circolare_blogposts_Widget() {
		$widget_ops = array( 'classname' => 'circolare_blogposts', 'description' => __('Blogposts widget for Circolare theme.', 'circolare') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'circolare_blogposts-widget' );
		$this->__construct ( 'circolare_blogposts-widget', __('circolare - Blogposts', 'circolare'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$post_cat = $instance['post_cat'];
		$post_num = $instance['post_num'];
		$type = $instance['type'];
		
		echo $before_widget . "\n";

		echo '<div class="latest-comments-list">' . "\n";
		if ( $title )
		echo $before_title . $title . $after_title . "\n";
		?>
			<?php 
			if ( $type == 'popular' )
			$myposts = new WP_Query("orderby=comment_count&showposts=$post_num&cat=$post_cat");
			
			else
			$myposts = new WP_Query("showposts=$post_num&cat=$post_cat");
			
			if($myposts->have_posts()) : ?>
			<ul class="sidebar-alt">
			<?php while ($myposts->have_posts()) : $myposts->the_post();
			$btheme_imageid = get_post_thumbnail_id();
				?><li class="sidebar-post-single">
					<?php if( $btheme_imageid ) {
					$image_url = btheme_getimage($btheme_imageid);
					?><div class="sidebar-post-thumb float-left">
						<a href="<?php the_permalink(); ?>"><img src="<?php echo aq_resize($image_url, 54, 54, true) ?>" alt="" /></a>
					</div><?php } ?>
					<span class="sidebar-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<span class="sidebar-post-date<?php if( !$btheme_imageid ) echo " alt-post-date"; ?>"><?php the_time('M j, Y') ?></span>
					<div class="clear"></div>
				</li>
			<?php endwhile; ?>
			</ul><?php endif; wp_reset_query(); ?>
		<?php echo "\n" . '</div>' . $after_widget . "\n";
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_cat'] = strip_tags( $new_instance['post_cat'] );
		$instance['post_num'] = strip_tags( $new_instance['post_num'] );
		$instance['type'] = strip_tags( $new_instance['type'] );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', 'post_cat' => '', 'post_num' => '3', 'type' => 'recent' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'post_num' ); ?>"><?php _e('Number of Posts to Show', 'circolare'); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'post_num' ); ?>" name="<?php echo $this->get_field_name( 'post_num' ); ?>" style="width: 200px;">
				<option <?php if($instance['post_num'] == "1") echo "selected"; ?> value="1">1</option>
				<option <?php if($instance['post_num'] == "2") echo "selected"; ?> value="2">2</option>
				<option <?php if($instance['post_num'] == "3") echo "selected"; ?> value="3">3</option>
				<option <?php if($instance['post_num'] == "4") echo "selected"; ?> value="4">4</option>
				<option <?php if($instance['post_num'] == "5") echo "selected"; ?> value="5">5</option>
				<option <?php if($instance['post_num'] == "6") echo "selected"; ?> value="6">6</option>
				<option <?php if($instance['post_num'] == "7") echo "selected"; ?> value="7">7</option>
				<option <?php if($instance['post_num'] == "8") echo "selected"; ?> value="8">8</option>
				<option <?php if($instance['post_num'] == "9") echo "selected"; ?> value="9">9</option>
				<option <?php if($instance['post_num'] == "10") echo "selected"; ?> value="10">10</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Recent or Popular posts?', 'circolare'); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" style="width: 200px;">
				<option <?php if($instance['type'] == "recent") echo "selected"; ?> value="recent">recent posts</option>
				<option <?php if($instance['type'] == "popular") echo "selected"; ?> value="popular">popular posts</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'post_cat' ); ?>"><?php _e('Enter Category ID', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'post_cat' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'post_cat' ); ?>" value="<?php echo $instance['post_cat']; ?>" style="width:90%;" />
			<small><?php _e('Enter a Category ID to show popular posts from that Category. Leave blank to show from all posts.', 'circolare'); ?></small>
		</p>

	<?php
	}
}




/* Subscribe Widget */
add_action( 'widgets_init', 'subscribe_load_widgets' );

function subscribe_load_widgets() {
	register_widget( 'Subscribe_Widget' );
}

class Subscribe_Widget extends WP_Widget {

	function Subscribe_Widget() {
		$widget_ops = array( 'classname' => 'subscribe', 'description' => __('Give your readers another way to stay updated.', 'circolare') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'subscribe-widget' );
		$this->__construct ( 'subscribe-widget', __('circolare - Subscribe Widget', 'circolare'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$rss_id = $instance['rss_id'];
		$content = $instance['content'];
		
		echo $before_widget . "\n";

		echo '<div class="subscribe_widget">' . "\n";

		if ( $title )
		echo $before_title . $title . $after_title . "\n"; ?>
		
		<p><?php echo $content ?></p>

		<form method="post" class="newsletter" action="//feedburner.google.com/fb/a/mailverify" target="popupwindow" onsubmit="window.open('//feedburner.google.com/fb/a/mailverify?uri=<?php echo $rss_id ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input type="text" class="newsletter-field" onclick="if(this.value == '<?php _e('Enter your e-mail...', 'circolare'); ?>') this.value='';" onblur="if(this.value.length == 0) this.value='<?php _e('Enter your e-mail...', 'circolare'); ?>';" value="<?php _e('Enter your e-mail...', 'circolare'); ?>" name="email" />
			<input type="hidden" value="<?php echo $rss_id ?>" name="uri"/>
			<input type="hidden" name="loc" value="en_US"/>
			<input type="submit" class="go-btn" value="<?php _e('Sign Up', 'circolare'); ?>" />
		</form>
		
		<?php echo "\n" . '</div>' . $after_widget . "\n";
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['rss_id'] = strip_tags( $new_instance['rss_id'] );
		$instance['content'] = strip_tags( $new_instance['content'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Subscribe', 'circolare') );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$content = esc_attr($instance['content']); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e('Custom text that appears before the form:', 'circolare'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $instance['content']; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'rss_id' ); ?>"><?php _e('Enter your newsletter ID name', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'rss_id' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'rss_id' ); ?>" value="<?php echo $instance['rss_id']; ?>" style="width:90%;" />
			<div class="clear"></div>
			<small><?php _e('You can get an id for your newsletter from feedburner.com', 'circolare'); ?></small>
		</p>

	<?php
	}
}




/* Products Widget */
add_action( 'widgets_init', 'products_load_widgets' );

function products_load_widgets() {
	register_widget( 'Products_Widget' );
}

class Products_Widget extends WP_Widget {

	function Products_Widget() {
		$widget_ops = array( 'classname' => 'products slider-container', 'description' => __('Show your best products right on the homepage below the slider area.', 'circolare') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'products-widget' );
		$this->__construct( 'products-widget', __('circolare - Products Widget', 'circolare'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$product_cat = $instance['product_cat'];
		$product_total = $instance['product_total'];
		
		if(!is_numeric($product_total))
		$product_total = 12;
		
		global $uni_carousel_id;

		echo $args['before_widget'] . "\n";

		if ( $title )
		echo $before_title . $title . $after_title . "\n";	?>
		
		<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
		<div id="woo-product-items" class="products grid-view list-carousel responsive">
			
			<ul id="<?php echo "foo" . $uni_carousel_id; ?>" class="products products-carousel">
				<script type="text/javascript">
					/*global jQuery:false */
					jQuery(document).ready(function($) {
						"use strict";
						// Products Carousel
						$('#foo<?php echo $uni_carousel_id; ?>').carouFredSel({
							responsive: true,
							auto: false,
							width: '100%',
							scroll: {
								items : 2,
								pauseOnHover    : true
							},
							prev: '#prev<?php echo $uni_carousel_id; ?>',
							next: '#next<?php echo $uni_carousel_id; ?>',
							pagination: "#pager<?php echo $uni_carousel_id; ?>",
							items: {
								width: 250,
								height: 'auto',
								visible: {
									min: 2,
									max: 4
								}
							}
						});
					});
				</script>
				<?php
				
				$args = array( 'post_type' => 'product', 'product_cat' => "$product_cat", 'posts_per_page' => $product_total );				
				$loop = new WP_Query( $args );					
				$products_available = $loop->found_posts;
				while ( $loop->have_posts() ) : $loop->the_post(); global $product;
				
				global $woocommerce;
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), apply_filters( 'single_product_large_thumbnail_size', 'shop_catalog' ));				
				$productlink = get_permalink( $loop->post->ID );
				$content_excerpt = apply_filters( 'woocommerce_short_description', $loop->post->post_excerpt );
				
				?><li class="product-grid-container">
					<div class="product-item">	
						<div class="title">
							<h3 class="title-container product-titles"><a href="<?php echo $productlink ?>"><?php the_title(); ?></a></h3>
						</div>
						
						<div class="image mosaic-block bar">
							<?php if($content_excerpt != "") { ?><a href="<?php echo $productlink ?>" class="mosaic-overlay">
								<div class="details">
									<?php echo $content_excerpt ?>
								</div>
							</a><?php } ?>
							<a href="<?php echo $productlink ?>">
								<span class="price heading-style"><?php echo $product->get_price_html(); ?></span>
								<?php woocommerce_show_product_sale_flash( $loop->post, $product ); ?>
								<?php if(!$large_image_url == "") { ?><img src="<?php echo $large_image_url[0]; ?>" alt="" /><?php } else { ?><img src="<?php echo woocommerce_placeholder_img_src() ?>" width="240" height="160" alt="" /><?php } ?>
							</a>
						</div>
						
						<div class="info">
							<div class="float-left">
								<?php woocommerce_template_loop_rating( $loop->post, $product ) ?>
							</div>
							
							<div class="float-right">
								<?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
							</div>
						</div>
					</div>
				</li>
			<?php endwhile; wp_reset_query(); ?>
			</ul>
			
			<div id="pager<?php echo $uni_carousel_id; $uni_carousel_id++; ?>" class="pager"></div>
			
			<div class="clear"></div>
		</div><?php } ?></div>
		
		<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['product_cat'] = strip_tags( $new_instance['product_cat'] );
		$instance['product_total'] = strip_tags( $new_instance['product_total'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', 'product_cat' => '', 'product_total' => '12' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'product_cat' ); ?>"><?php _e('Product Categories', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'product_cat' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'product_cat' ); ?>" value="<?php echo $instance['product_cat']; ?>" style="width:90%;" />
			<small><?php _e('Enter the slugs of the categories from which the product items would be fetched. Separate multiple slugs with commas. Leave blank if all categories are to be included.', 'circolare'); ?></small>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'product_total' ); ?>"><?php _e('Maximum products', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'product_total' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'product_total' ); ?>" value="<?php echo $instance['product_total']; ?>" style="width:90%;" />
			<small><?php _e('Enter the maximum number of product items to show. Leave blank to show the default 12 items.', 'circolare'); ?></small>
		</p>

	<?php
	}
}



/* Social Icons Widget */
add_action( 'widgets_init', 'socialicons_load_widgets' );

function socialicons_load_widgets() {
	register_widget( 'Social_Widget' );
}

class Social_Widget extends WP_Widget {

	function Social_Widget() {
		$widget_ops = array( 'classname' => 'socialicons', 'description' => __('Give your readers another way to stay updated.', 'circolare') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'socialicons-widget' );
		$this->__construct ( 'socialicons-widget', __('circolare - Social Icons', 'circolare'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$twitter = $instance['social_twitter'];
		$digg = $instance['social_digg'];
		$facebook = $instance['social_facebook'];
		$youtube = $instance['social_youtube'];
		$googleplus = $instance['social_googleplus'];
		$vimeo = $instance['social_vimeo'];
		
		echo $before_widget . "\n";
		
		if ( $title )
		echo $before_title . $title . $after_title . "\n"; ?>
		<ul class="social-icons">
			<?php if($twitter) { ?><li class="social twitter"><a href="<?php echo $twitter ?>">twitter</a></li><?php } ?>
			<?php if($digg) { ?><li class="social digg"><a href="<?php echo $digg ?>">digg</a></li><?php } ?>
			<?php if($facebook) { ?><li class="social facebook"><a href="<?php echo $facebook ?>">facebook</a></li><?php } ?>
			<?php if($youtube) { ?><li class="social youtube"><a href="<?php echo $youtube ?>">youtube</a></li><?php } ?>
			<?php if($googleplus) { ?><li class="social googleplus"><a href="<?php echo $googleplus ?>">googleplus</a></li><?php } ?>
			<?php if($vimeo) { ?><li class="social vimeo"><a href="<?php echo $vimeo ?>">vimeo</a></li><?php } ?>
		</ul>
		<?php echo "\n" . $after_widget . "\n";
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['social_twitter'] = $new_instance['social_twitter'];
		$instance['social_digg'] = $new_instance['social_digg'];
		$instance['social_facebook'] = $new_instance['social_facebook'];
		$instance['social_youtube'] = $new_instance['social_youtube'];
		$instance['social_googleplus'] = $new_instance['social_googleplus'];
		$instance['social_vimeo'] = $new_instance['social_vimeo'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>
		
		<p><small><?php _e('Enter your profiles\' urls in the fields below', 'circolare'); ?></small><div class="clear"></div>
			<label for="<?php echo $this->get_field_id( 'social_twitter' ); ?>"><?php _e('Twitter', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'social_twitter' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'social_twitter' ); ?>" value="<?php echo $instance['social_twitter']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'social_digg' ); ?>"><?php _e('Digg', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'social_digg' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'social_digg' ); ?>" value="<?php echo $instance['social_digg']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'social_facebook' ); ?>"><?php _e('Facebook', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'social_facebook' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'social_facebook' ); ?>" value="<?php echo $instance['social_facebook']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'social_youtube' ); ?>"><?php _e('Youtube', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'social_youtube' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'social_youtube' ); ?>" value="<?php echo $instance['social_youtube']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'social_googleplus' ); ?>"><?php _e('Google Plus', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'social_googleplus' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'social_googleplus' ); ?>" value="<?php echo $instance['social_googleplus']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'social_vimeo' ); ?>"><?php _e('Vimeo', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'social_vimeo' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'social_vimeo' ); ?>" value="<?php echo $instance['social_vimeo']; ?>" style="width:90%;" />
		</p>

	<?php
	}
}



/* Circolare Photos Widget */
add_action( 'widgets_init', 'circolare_photo_load_widgets' );

function circolare_photo_load_widgets() {
	register_widget( 'CircolarePhoto_Widget' );
}

class CircolarePhoto_Widget extends WP_Widget {

	function CircolarePhoto_Widget() {
		$widget_ops = array( 'classname' => 'circolare_photo', 'description' => __('A widget to display a photo gallery of posts or products.', 'circolare') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'circolare_photo-widget' );
		$this->__construct ( 'circolare_photo-widget', __('circolare - Photo Gallery', 'circolare'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$bellphoto_id = $instance['bellphoto_id'];
		$bellphoto_src = $instance['bellphoto_src'];
		$bellphoto_num = $instance['bellphoto_num'];

		echo $before_widget . "\n";

		if ( $title )
			echo $before_title . $title . $after_title . "\n";
			?>
			

				<?php
				if($bellphoto_src == "product") {
					$recent_widget = new WP_Query("post_type=product&showposts=$bellphoto_num&product_cat=$bellphoto_id&meta_key=_thumbnail_id");
				} else {
					$recent_widget = new WP_Query("showposts=$bellphoto_num&category_name=$bellphoto_id&meta_key=_thumbnail_id");
				}
				if($recent_widget->have_posts()) : 
				while ($recent_widget->have_posts()) : $recent_widget->the_post();
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id,'full');
				$image_url = $image_url[0];
				?>
				<div class="one-third float-left gallery">
					<div class="gallery-item-small mosaic-block circle">
						<a href="<?php the_permalink() ?>" class="mosaic-overlay">&nbsp;</a>
						<div class="mosaic-backdrop"><img src="<?php echo aq_resize($image_url, 150, 100, true) ?>" alt="" /></div>
					</div>
					<div class="gallery-text">
						<span><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></span>
					</div>
				</div>
				<?php endwhile; endif; wp_reset_query(); ?>

			<div class="clear"></div>
			<?php 
		
		echo "\n" . $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['bellphoto_id'] = strip_tags( $new_instance['bellphoto_id'] );
		$instance['bellphoto_src'] = $new_instance['bellphoto_src'];
		$instance['bellphoto_num'] = $new_instance['bellphoto_num'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Our Photostream', 'bellphoto_id' => '', 'bellphoto_num' => '9', 'bellphoto_src' => 'post' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'bellphoto_src' ); ?>"><?php _e('Photo Source', 'circolare'); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'bellphoto_src' ); ?>" name="<?php echo $this->get_field_name( 'bellphoto_src' ); ?>" class="widefat" style="width:90%;">
				<option <?php if ( 'post' == $instance['bellphoto_src'] ) echo 'selected="selected"'; ?>><?php _e('post', 'circolare'); ?></option>
				<option <?php if ( 'product' == $instance['bellphoto_src'] ) echo 'selected="selected"'; ?>><?php _e('product', 'circolare'); ?></option>
			</select>
			<small><?php _e('Please note that only those posts/products would be shown that have a thumbnail added.', 'circolare'); ?></small>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'bellphoto_num' ); ?>"><?php _e('Number of Photos', 'circolare'); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'bellphoto_num' ); ?>" name="<?php echo $this->get_field_name( 'bellphoto_num' ); ?>" class="widefat" style="width:90%;">
				<option <?php if ( '3' == $instance['bellphoto_num'] ) echo 'selected="selected"'; ?>>3</option>
				<option <?php if ( '6' == $instance['bellphoto_num'] ) echo 'selected="selected"'; ?>>6</option>
				<option <?php if ( '9' == $instance['bellphoto_num'] ) echo 'selected="selected"'; ?>>9</option>
				<option <?php if ( '12' == $instance['bellphoto_num'] ) echo 'selected="selected"'; ?>>12</option>
				<option <?php if ( '15' == $instance['bellphoto_num'] ) echo 'selected="selected"'; ?>>15</option>
				<option <?php if ( '18' == $instance['bellphoto_num'] ) echo 'selected="selected"'; ?>>18</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'bellphoto_id' ); ?>"><?php _e('Categories', 'circolare'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'bellphoto_id' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'bellphoto_id' ); ?>" value="<?php echo $instance['bellphoto_id']; ?>" style="width:90%;" />
			<div class="clear"></div><small><?php _e('In case your photo source is Posts or Products, if you want to show items only from select categories, enter there Slugs here. Separate multiple slugs with commas.', 'circolare'); ?></small>
		</p>
	<?php
	}
}
?>