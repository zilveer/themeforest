<?php

add_action( 'widgets_init', 'homeshop_custom_widgets' );
function homeshop_custom_widgets() {
	unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Text' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'WP_Widget_Meta' );
	
	

	register_widget( 'Mailchimp_Widget' );
	
	 register_widget( 'WP_Widget_Categories1' );
	 register_widget( 'WP_Widget_Pages1' );
	 register_widget( 'WP_Widget_Search1' );
	 register_widget( 'WP_Widget_Archives1' );
	 register_widget( 'WP_Widget_Meta1' );
	 register_widget( 'WP_Widget_Calendar1' );
	 register_widget( 'WP_Widget_Text1' );
	 register_widget( 'WP_Widget_Recent_Posts1' );
	 register_widget( 'WP_Widget_Recent_Comments1' );
	 register_widget( 'WP_Widget_RSS1' );
	 register_widget( 'WP_Widget_Tag_Cloud1' );
	 register_widget( 'WP_Nav_Menu_Widget1' );
	 register_widget( 'WP_Nav_Menu_Widget2' );
	
	
	
	register_widget( 'WC_Product_Slider_Widget' );
	register_widget( 'WC_Top_Rated_Widget' );
	register_widget( 'WC_Recent_Reviews_Widget' );
	
	register_widget( 'WP_Widget_Social' );
	register_widget( 'WP_Widget_Contacts' );
	register_widget( 'Banner_Slider_Widget' );
	
	
	
	
  // woocommerce
  if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
    unregister_widget( 'WC_Widget_Product_Categories' );
    include_once( 'class-custom-wc-widget-product-categories.php' );
    register_widget( 'Custom_WC_Widget_Product_Categories' );
  }
  
   if ( class_exists( 'WC_Widget_Cart' ) ) {
    unregister_widget( 'WC_Widget_Cart' );
  }
  if ( class_exists( 'WC_Widget_Layered_Nav' ) ) {
    unregister_widget( 'WC_Widget_Layered_Nav' );
  }
   if ( class_exists( 'WC_Widget_Layered_Nav_Filters' ) ) {
    unregister_widget( 'WC_Widget_Layered_Nav_Filters' );
  }
   if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
    unregister_widget( 'WC_Widget_Price_Filter' );
  }
  if ( class_exists( 'WC_Widget_Product_Search' ) ) {
    unregister_widget( 'WC_Widget_Product_Search' );
    include_once( 'class-wc-widget-product-search.php' );
    register_widget( 'Custom_WC_Widget_Product_Search' );
  }
   if ( class_exists( 'WC_Widget_Products' ) ) {
    unregister_widget( 'WC_Widget_Products' );
  }
  if ( class_exists( 'WC_Widget_Product_Tag_Cloud' ) ) {
    unregister_widget( 'WC_Widget_Product_Tag_Cloud' );
    include_once( 'class-wc-widget-product-tag-cloud.php' );
    register_widget( 'Custom_WC_Widget_Product_Tag_Cloud' );
  }
  if ( class_exists( 'WC_Widget_Recently_Viewed' ) ) {
    unregister_widget( 'WC_Widget_Recently_Viewed' );
  }
   if ( class_exists( 'WC_Widget_Top_Rated_Products' ) ) {
    unregister_widget( 'WC_Widget_Top_Rated_Products' );
  }
   if ( class_exists( 'WC_Compare_Widget' ) ) {
    unregister_widget( 'WC_Compare_Widget' );
    include_once( 'compare_widget.php' );
   register_widget( 'Custom_WC_Compare_Widget' );
  }
   if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
    unregister_widget( 'WC_Widget_Recent_Reviews' );
  }
 
}













///////Banner Slider///////////////////////////////////////////////////////////////
class Banner_Slider_Widget extends WP_Widget 
{

	function Banner_Slider_Widget() {
		$widget_ops = array( 'classname' => 'widget_banner_slider', 'description' => __('Display a banner slider on your site.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_banner_slider' ); //default width = 250
		parent::__construct( 'widget_banner_slider', 'homeshop'.' - '.__('Side Banner Carousel', 'homeshop'), $widget_ops, $control_ops );
	}
	
	
	function widget( $args, $instance ) {
		
		extract( $args );
		$instance = wp_parse_args( (array) $instance, array( 
					'title' 				=> '', 
					'category_id' 			=> 0, 
					'slider_auto_scroll'	=> '',
					'effect_delay'			=> 1,
					'color_button'			=> '',
					'number_products' => ''
				) );
		
		
		
		$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number      = $instance['number_products'];
		$color_button      = $instance['color_button'];
		$order       = 'asc';
		$slider_auto_scroll             =  $instance['slider_auto_scroll'] ;
		$effect_delay             =  $instance['effect_delay'] ;
		$category_id             =  $instance['category_id'] ;
		
		$slug = '';
		if($category_id != '0') {
		$term = get_term( $category_id, 'banners-category' );
		$slug = $term->slug;
		}
		
		$id = rand(1, 100);
		
		if ($slider_auto_scroll == 'yes') {
		$slider_auto_scroll = 'true';
		}else{
		$slider_auto_scroll = 'false';
		}
		$slideshow = $effect_delay*1000;
		
		
    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'banners',
    		'banners-category' 	 => $slug,
    		'no_found_rows'  => 1,
    		'order'          => $order == 'asc' ? 'asc' : 'desc'
    	);

    	$query_args['meta_query'] = array();

		$r = new WP_Query( $query_args );

		if ( $r->have_posts() ) {
		
			
			echo '<div class="row sidebar-box">
						
						<div class="col-lg-12 col-md-12 col-sm-12 sidebar-carousel">
							
							<!-- Slider -->
							<section class="sidebar-slider">
								<div class="sidebar-flexslider_'.$id.'">
									<ul class="slides ">';
	
			while ( $r->have_posts()) {
					$r->the_post();
					
					
					$post_id = get_the_ID();
					$post_thumbnail_id = get_post_thumbnail_id($post_id);
					$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
					$url = get_meta_option('link_portfolio_photo_meta_box', $post_id);
					
					$target = '';
					if(get_meta_option('target_portfolio_photo_meta_box', $post_id) == 'true') {
					$target = '_blank';
					}

					echo  '<li>
							<a target="'. $target .'" href="'. esc_url($url) .'">'. get_the_post_thumbnail( $post_id, 'banner-slider' ) .'</a>
							</li>';
				}
			
			
			echo  '</ul>
								</div>
								<div class="slider-nav"></div>
							</section>
						</div>
					</div>';
			
			
		$output =	'';
		
		$output .= '<style>
                .sidebar-slider .flex-control-paging li a:hover, .sidebar-slider .flex-control-paging li a.flex-active { 
				background: '. $color_button .'; }            
		</style>';	
		
		$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		$output .= '$(".sidebar-flexslider_'.$id.'").flexslider({'."\n";
		$output .= 'animation: "slide",'."\n";  
		$output .= 'controlNav: true,'."\n";  
		$output .= 'slideshow: '.$slider_auto_scroll.','."\n";  
		$output .= 'slideshowSpeed: '.$slideshow.','."\n";  
		$output .= 'directionNav: false,'."\n";  
		$output .= 'prevText: "",'."\n";           
		$output .= 'nextText: "",'."\n";  
		$output .= '});'."\n";
	

		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
		echo $output;		
		}
		wp_reset_postdata();
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );

		$instance['category_id'] = strip_tags( $new_instance['category_id'] );
		$instance['slider_auto_scroll'] = strip_tags( $new_instance['slider_auto_scroll'] );
		$instance['effect_delay'] = strip_tags( $new_instance['effect_delay'] );
		$instance['color_button'] = strip_tags( $new_instance['color_button'] );
		
		$number_products = intval( $new_instance['number_products'] );
		if ( $number_products < 0 ) $number_products = -1;
		$instance['number_products'] 		= $number_products;
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' 				=> '', 
			'category_id' 			=> 0, 
			'slider_auto_scroll'	=> '',
			'effect_delay'			=> 1,
			'color_button'			=> '',
			'number_products' => ''
		) );
		extract( $instance );
		
		$title = esc_attr( $title );
		$color_button = $instance['color_button'];
		
		$number_products = intval( $number_products );
		if ( $number_products < 0 ) $number_products = -1;
		
		
		
?>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		

		<fieldset id="wc_product_slider_upgrade_area">
		<p><label><?php _e('Number of products to show:', 'homeshop'); ?> <input class="" name="<?php echo esc_attr($this->get_field_name('number_products')); ?>" type="text" value="<?php echo esc_attr($number_products); ?>" size="2" /></label><br />
		<span class="description"><?php _e('Important! Set -1 to show all products.', 'homeshop'); ?></span>
		</p>
		</fieldset>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('category_id')); ?>"><?php _e('Category:', 'homeshop'); ?></label> 
		<?php wp_dropdown_categories( array('show_option_all' => 'All', 'orderby' => 'name', 'selected' => $category_id, 'name' => esc_attr($this->get_field_name('category_id')), 'id' => esc_attr($this->get_field_id('category_id')), 'class' => 'widefat', 'depth' => true, 'taxonomy' => 'banners-category') ); ?>
		</p>

		<fieldset id="banner_slider_upgrade_area">
		<p><label><strong><?php _e( 'Color Button:', 'homeshop' ); ?></strong></label></p>
		
		<?php 		
		$output = '';
		$output = '<input  name="'. esc_attr($this->get_field_name('color_button')) .'" class="color-picker-banner" type="text" id="'. esc_attr($this->get_field_name('color_button')) .'" value="'. esc_attr($instance['color_button']) .'">';
			
			$output .= '<script type="text/javascript">
			jQuery(document).ready(function($) {  
					$(".color-picker-banner").iris();
			});           
			</script>'; 
		echo $output;	
		 ?>
		
		</fieldset>


  
		<p><label><strong><?php _e( 'Slideshow:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="wc_product_slider_slider_auto_scroll" data-id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_auto_scroll')); ?>" value="no" checked="checked" /> <?php _e( 'No', 'homeshop' ); ?></label> &nbsp;&nbsp;&nbsp;
			<label><input type="radio" class="wc_product_slider_slider_auto_scroll" data-id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_auto_scroll')); ?>" value="yes" <?php checked( $slider_auto_scroll, 'yes' ); ?> /> <?php _e( 'AUTO', 'homeshop' ); ?></label>
		</p>

		<fieldset id="wc_product_slider_upgrade_area">
		<div id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>_auto" <?php if ( $slider_auto_scroll != 'yes' ) { echo 'style="display:none"'; } ?>>
			<p><label><?php _e('Slideshow Delay:', 'homeshop'); ?> <input name="<?php echo esc_attr($this->get_field_name('effect_delay')); ?>" type="text" value="<?php echo esc_attr($effect_delay); ?>" size="1" /> <?php _e('seconds', 'homeshop'); ?></label></p>
		</div>


		</fieldset>
       
<?php
	}
}








/**
 * Contacts widget class
 */
class WP_Widget_Contacts extends WP_Widget {

	function WP_Widget_Contacts() {
		$widget_ops = array( 'classname' => 'widget_contact', 'description' => __('A contacts for your site.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_contact' ); //default width = 250
		parent::__construct( 'widget_contact', 'homeshop'.' - '.__('Contact widget', 'homeshop'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$address = apply_filters( 'widget_text', empty( $instance['address'] ) ? '' : $instance['address'], $instance );
		$phone = $instance['phone'];
		$mail = $instance['mail'];
		$skype = $instance['skype'];
		
		echo '<div class="contact-footer-info" ><h4>'. $title .'</h4><ul>';	
		
			if($address != '') {
				echo '<li><i class="icons icon-location"></i> ';
				echo !empty( $instance['filter'] ) ? wpautop( $address ) : $address;
				echo '</li>';
				}
			if($phone != '') {	
				echo '<li><i class="icons icon-phone"></i> '. $phone .'</li>';
				}
			if($mail != '') {
				echo '<li><i class="icons icon-mail-alt"></i><a href="mailto:'. $mail .'"> '. $mail .'</a></li>';
				}
			if($skype != '') {
				echo '<li><i class="icons icon-skype"></i> '. $skype .'</li>';
			}
		

		echo '</ul></div>';	
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'address' => '', 'phone' => '', 'mail' => '', 'skype' => '' ) );
		$title = strip_tags($instance['title']);
		$address = esc_textarea($instance['address']);
		$phone = $instance['phone'];
		$mail = $instance['mail'];
		$skype = $instance['skype'];
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

		
		<p><label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php _e('Phone:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('mail')); ?>"><?php _e('Mail:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('mail')); ?>" name="<?php echo esc_attr($this->get_field_name('mail')); ?>" type="text" value="<?php echo esc_attr($mail); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('skype')); ?>"><?php _e('Skype:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('skype')); ?>" name="<?php echo esc_attr($this->get_field_name('skype')); ?>" type="text" value="<?php echo esc_attr($skype); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php _e('Address:', 'homeshop'); ?></p>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>"><?php echo esc_textarea($address); ?></textarea>

		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php _e('Automatically add paragraphs', 'homeshop'); ?></label></p>

		
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['mail'] = strip_tags( $new_instance['mail'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );

		if ( current_user_can('unfiltered_html') )
			$instance['address'] =  $new_instance['address'];
		else
			$instance['address'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['address']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		
		return $instance;
	}

}






/**
 * Social widget class
 */
class WP_Widget_Social extends WP_Widget {

	function WP_Widget_Social() {
		$widget_ops = array( 'classname' => 'widget_social', 'description' => __('A social button for your site.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_social' ); //default width = 250
		parent::__construct( 'widget_social', 'homeshop'.' - '.__('Social widget', 'homeshop'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$target1 = $target2 = $target3 = $target4 = $target5 = '';
		
		
		$title1 = $instance['title1'];
		$color1 = $instance['color1'];
		$icon1 = $instance['icon1'];
		$open_new1 = $instance['open_new1'];
		$url1 = $instance['url1'];
		
		$title2 = $instance['title2'];
		$color2 = $instance['color2'];
		$icon2 = $instance['icon2'];
		$open_new2 = $instance['open_new2'];
		$url2 = $instance['url2'];
		
		$title3 = $instance['title3'];
		$color3 = $instance['color3'];
		$icon3 = $instance['icon3'];
		$open_new3 = $instance['open_new3'];
		$url3 = $instance['url3'];
		
		$title4 = $instance['title4'];
		$color4 = $instance['color4'];
		$icon4 = $instance['icon4'];
		$open_new4 = $instance['open_new4'];
		$url4 = $instance['url4'];
		
		$title5 = $instance['title5'];
		$color5 = $instance['color5'];
		$icon5 = $instance['icon5'];
		$open_new5 = $instance['open_new5'];
		$url5 = $instance['url5'];
		
		if($open_new1 == 'yes') {
		$target1 = '_blank';
		}
		if($open_new2 == 'yes') {
				$target2 = '_blank';
				}
		if($open_new3 == 'yes') {
				$target3 = '_blank';
				}
		if($open_new4 == 'yes') {
				$target4 = '_blank';
				}
		if($open_new5 == 'yes') {
				$target5 = '_blank';
				}

		echo '<div class="social-media"><h4>'. $title .'</h4>';	

		echo '<ul>';
			if($url1 != '' && $url1 != '#') {
			echo '<li class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="'. $title1 .'">
			<a href="'. esc_url($url1) .'" target="'. $target1 .'"  style="margin-right: 5px;background-color: '. $color1 .';" >
			<i style="line-height:40px;text-align: center;display: block;" class="icons '. $icon1 .'"></i></a>
			</li>';
			}
			if($url2 != '' && $url2 != '#') {
			echo '<li class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="'. $title2 .'">
			<a href="'. esc_url($url2) .'" target="'. $target2 .'"  style="margin-right: 5px;background-color: '. $color2 .';" >
			<i style="line-height:40px;text-align: center;display: block;" class="icons '. $icon2 .'"></i></a>
			</li>';
			}
			if($url3 != '' && $url3 != '#') {
			echo '<li class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="'. $title3 .'">
			<a href="'. esc_url($url3) .'" target="'. $target3 .'"  style="margin-right: 5px;background-color: '. $color3 .';" >
			<i style="line-height:40px;text-align: center;display: block;" class="icons '. $icon3 .'"></i></a>
			</li>';
			}
			if($url4 != '' && $url4 != '#') {
			echo '<li class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="'. $title4 .'">
			<a href="'. esc_url($url4) .'" target="'. $target4 .'"  style="margin-right: 5px;background-color: '. $color4 .';" >
			<i style="line-height:40px;text-align: center;display: block;" class="icons '. $icon4 .'"></i></a>
			</li>';
			}
			if($url5 != '' && $url5 != '#') {
			echo '<li class="tooltip-hover" data-toggle="tooltip" data-placement="top" title="'. $title5 .'">
			<a href="'. esc_url($url5) .'" target="'. $target5 .'"  style="margin-right: 5px;background-color: '. $color5 .';" >
			<i style="line-height:40px;text-align: center;display: block;" class="icons '. $icon5 .'"></i></a>
			</li>';
			}
			
		
		
		echo '</ul></div>';	
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];

		$title1 = $instance['title1'];
		$color1 = $instance['color1'];
		$icon1 = $instance['icon1'];
		$open_new1 = $instance['open_new1'];
		$url1 = $instance['url1'];
		
		$title2 = $instance['title2'];
		$color2 = $instance['color2'];
		$icon2 = $instance['icon2'];
		$open_new2 = $instance['open_new2'];
		$url2 = $instance['url2'];
		
		$title3 = $instance['title3'];
		$color3 = $instance['color3'];
		$icon3 = $instance['icon3'];
		$open_new3 = $instance['open_new3'];
		$url3 = $instance['url3'];
		
		$title4 = $instance['title4'];
		$color4 = $instance['color4'];
		$icon4 = $instance['icon4'];
		$open_new4 = $instance['open_new4'];
		$url4 = $instance['url4'];
		
		$title5 = $instance['title5'];
		$color5 = $instance['color5'];
		$icon5 = $instance['icon5'];
		$open_new5 = $instance['open_new5'];
		$url5 = $instance['url5'];
		
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<br>
		
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('title1')); ?>"><?php _e('Name Button1:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title1')); ?>" name="<?php echo esc_attr($this->get_field_name('title1')); ?>" type="text" value="<?php echo esc_attr($title1); ?>" /></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('url1')); ?>"><?php _e('Url 1:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('url1')); ?>" name="<?php echo esc_attr($this->get_field_name('url1')); ?>" type="text" value="<?php echo esc_attr($url1); ?>" /></label></p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon1')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon1' ) ); ?>" name="<?php echo $this->get_field_name( 'icon1' ); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_social(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon1 ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		
		<?php 		
		$output = '';
		$output = '<input name="'. esc_attr($this->get_field_name('color1')) .'" class="color-picker" type="text" id="'. esc_attr($this->get_field_name('color1')) .'" value="'. esc_attr($instance['color1']) .'">';
			
			$output .= '<script type="text/javascript">
			jQuery(document).ready(function($) {  
					$(".color-picker").iris();
			});           
			</script>'; 
		echo $output;	
		 ?>
		</p>
		
		<p><label><strong><?php _e( 'Open in a new window:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="open_new" data-id="<?php echo esc_attr($this->get_field_id('open_new1')); ?>" name="<?php echo esc_attr($this->get_field_name('open_new1')); ?>" value="yes" <?php checked( $instance['open_new1'], 'yes' ); ?> /> <?php _e( 'yes', 'homeshop' ); ?></label>
		</p>
		<br>
		
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('title2')); ?>"><?php _e('Name Button2:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title2')); ?>" name="<?php echo esc_attr($this->get_field_name('title2')); ?>" type="text" value="<?php echo esc_attr($title2); ?>" /></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('url2')); ?>"><?php _e('Url 2:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('url2')); ?>" name="<?php echo esc_attr($this->get_field_name('url2')); ?>" type="text" value="<?php echo esc_attr($url2); ?>" /></label></p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon2')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon2' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon2' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_social(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon2 ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		
		<?php 		
		$output = '';
		$output = '<input name="'. esc_attr($this->get_field_name('color2')) .'" class="color-picker" type="text" id="'. esc_attr($this->get_field_name('color2')) .'" value="'. esc_attr($instance['color2']) .'">';
			
			$output .= '<script type="text/javascript">
			jQuery(document).ready(function($) {  
					$(".color-picker").iris();
			});           
			</script>'; 
		echo $output;	
		 ?>
		</p>
		
		<p><label><strong><?php _e( 'Open in a new window:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="open_new" data-id="<?php echo esc_attr($this->get_field_id('open_new2')); ?>" name="<?php echo esc_attr($this->get_field_name('open_new2')); ?>" value="yes" <?php checked( $instance['open_new2'], 'yes' ); ?> /> <?php _e( 'yes', 'homeshop' ); ?></label>
		</p>
		<br>
		
		
		
		
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('title3')); ?>"><?php _e('Name Button3:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title3')); ?>" name="<?php echo esc_attr($this->get_field_name('title3')); ?>" type="text" value="<?php echo esc_attr($title3); ?>" /></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('url3')); ?>"><?php _e('Url 3:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('url3')); ?>" name="<?php echo esc_attr($this->get_field_name('url3')); ?>" type="text" value="<?php echo esc_attr($url3); ?>" /></label></p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon3')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon3' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon3' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_social(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon3 ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		
		<?php 		
		$output = '';
		$output = '<input name="'. esc_attr($this->get_field_name('color3')) .'" class="color-picker" type="text" id="'. esc_attr($this->get_field_name('color3')) .'" value="'. esc_attr($instance['color3']) .'">';
			
			$output .= '<script type="text/javascript">
			jQuery(document).ready(function($) {  
					$(".color-picker").iris();
			});           
			</script>'; 
		echo $output;	
		 ?>
		</p>
		
		<p><label><strong><?php _e( 'Open in a new window:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="open_new" data-id="<?php echo esc_attr($this->get_field_id('open_new3')); ?>" name="<?php echo esc_attr($this->get_field_name('open_new3')); ?>" value="yes" <?php checked( $instance['open_new3'], 'yes' ); ?> /> <?php _e( 'yes', 'homeshop' ); ?></label>
		</p>
		<br>
		
		
		
		
		
		
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('title4')); ?>"><?php _e('Name Button4:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title4')); ?>" name="<?php echo esc_attr($this->get_field_name('title4')); ?>" type="text" value="<?php echo esc_attr($title4); ?>" /></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('url4')); ?>"><?php _e('Url 4:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('url4')); ?>" name="<?php echo esc_attr($this->get_field_name('url4')); ?>" type="text" value="<?php echo esc_attr($url4); ?>" /></label></p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon4')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon4' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon4' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_social(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon4 ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		
		<?php 		
		$output = '';
		$output = '<input name="'. esc_attr($this->get_field_name('color4')) .'" class="color-picker" type="text" id="'. esc_attr($this->get_field_name('color4')) .'" value="'. esc_attr($instance['color4']) .'">';
			
			$output .= '<script type="text/javascript">
			jQuery(document).ready(function($) {  
					$(".color-picker").iris();
			});           
			</script>'; 
		echo $output;	
		 ?>
		</p>
		
		<p><label><strong><?php _e( 'Open in a new window:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="open_new" data-id="<?php echo esc_attr($this->get_field_id('open_new4')); ?>" name="<?php echo esc_attr($this->get_field_name('open_new4')); ?>" value="yes" <?php checked( $instance['open_new4'], 'yes' ); ?> /> <?php _e( 'yes', 'homeshop' ); ?></label>
		</p>
		<br>
		
		
		
		
		
		
		
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('title5')); ?>"><?php _e('Name Button5:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title5')); ?>" name="<?php echo esc_attr($this->get_field_name('title5')); ?>" type="text" value="<?php echo esc_attr($title5); ?>" /></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('url5')); ?>"><?php _e('Url 5:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('url5')); ?>" name="<?php echo esc_attr($this->get_field_name('url5')); ?>" type="text" value="<?php echo esc_attr($url5); ?>" /></label></p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon5')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon5' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon5' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_social(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon5 ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		
		<?php 		
		$output = '';
		$output = '<input name="'. esc_attr($this->get_field_name('color5')) .'" class="color-picker" type="text" id="'. esc_attr($this->get_field_name('color5')) .'" value="'. esc_attr($instance['color5']) .'">';
			
			$output .= '<script type="text/javascript">
			jQuery(document).ready(function($) {  
					$(".color-picker").iris();
			});           
			</script>'; 
		echo $output;	
		 ?>
		</p>
		
		<p><label><strong><?php _e( 'Open in a new window:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="open_new" data-id="<?php echo esc_attr($this->get_field_id('open_new5')); ?>" name="<?php echo esc_attr($this->get_field_name('open_new5')); ?>" value="yes" <?php checked( $instance['open_new5'], 'yes' ); ?> /> <?php _e( 'yes', 'homeshop' ); ?></label>
		</p>
		
		

	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['title1'] = strip_tags($new_instance['title1']);
		$instance['color1'] = strip_tags( $new_instance['color1'] );
		$instance['icon1'] = strip_tags( $new_instance['icon1'] );
		$instance['open_new1'] = strip_tags( $new_instance['open_new1'] );
		$instance['url1'] = strip_tags( $new_instance['url1'] );
		
		$instance['title2'] = strip_tags($new_instance['title2']);
		$instance['color2'] = strip_tags( $new_instance['color2'] );
		$instance['icon2'] = strip_tags( $new_instance['icon2'] );
		$instance['open_new2'] = strip_tags( $new_instance['open_new2'] );
		$instance['url2'] = strip_tags( $new_instance['url2'] );
		
		$instance['title3'] = strip_tags($new_instance['title3']);
		$instance['color3'] = strip_tags( $new_instance['color3'] );
		$instance['icon3'] = strip_tags( $new_instance['icon3'] );
		$instance['open_new3'] = strip_tags( $new_instance['open_new3'] );
		$instance['url3'] = strip_tags( $new_instance['url3'] );
		
		$instance['title4'] = strip_tags($new_instance['title4']);
		$instance['color4'] = strip_tags( $new_instance['color4'] );
		$instance['icon4'] = strip_tags( $new_instance['icon4'] );
		$instance['open_new4'] = strip_tags( $new_instance['open_new4'] );
		$instance['url4'] = strip_tags( $new_instance['url4'] );
		
		$instance['title5'] = strip_tags($new_instance['title5']);
		$instance['color5'] = strip_tags( $new_instance['color5'] );
		$instance['icon5'] = strip_tags( $new_instance['icon5'] );
		$instance['open_new5'] = strip_tags( $new_instance['open_new5'] );
		$instance['url5'] = strip_tags( $new_instance['url5'] );
		
		return $instance;
	}

}







//////////////////////////////////////////////////////////////////////
class WC_Recent_Reviews_Widget extends WP_Widget 
{

	function WC_Recent_Reviews_Widget() {
		$widget_ops = array( 'classname' => 'widget_product_reviews', 'description' => __('Display a list of your most recent reviews on your site.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_product_reviews' ); //default width = 250
		parent::__construct( 'widget_product_reviews', 'homeshop'.' - '.__('Woo Recent Reviews', 'homeshop'), $widget_ops, $control_ops );
	}
	
	
	function widget( $args, $instance ) {
		
		extract( $args );
		$instance = wp_parse_args( (array) $instance, array( 
					'title' 				=> '', 
					'category_id' 			=> 0, 
					'slider_auto_scroll'	=> '',
					'effect_delay'			=> 1,
					'color'			=> '',
					'icon'			=> '',
					'skin_type'			=> '',
					'number_products' => ''
				) );
		
		
		
		$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number      = $instance['number_products'];
		$skin_type      = $instance['skin_type'];
		$color             =  $instance['color'] ;
		$icon             =  $instance['icon'] ;
		$slider_auto_scroll             =  $instance['slider_auto_scroll'] ;
		$effect_delay             =  $instance['effect_delay'] ;
		$category_id             =  $instance['category_id'] ;

		$term = get_term( $category_id, 'product_cat' );
		$id = rand(1, 100);
		
		if ($slider_auto_scroll == 'yes') {
		$slideshow = $effect_delay*1000;
		}else{
		$slideshow = 'false';
		}

		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product', 'product_cat' => $term->slug ) );

		if ( $comments ) {
			if ( $skin_type == 'simple' ) {
				echo '<div class="row sidebar-box '. esc_attr($color) .'">
							
				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<div class="sidebar-box-heading">
						<i class="icons '. esc_attr($icon) .'"></i>
						<h4>'. esc_html($title) .'</h4>
					</div>
					<div class="sidebar-box-content">';	
				
				
				echo '<table class="bestsellers-table">';

					foreach ( (array) $comments as $comment ) {

					$_product = get_product( $comment->comment_post_ID );

					$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
					$num_rating = (int) $_product->get_average_rating();
					?>
					<tr>
						<td class="product-thumbnail">
						 <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php echo esc_attr($_product->get_title()); ?>">
						  <?php echo $_product->get_image(); ?>
						 </a>
						</td>
						<td class="product-info">
							<p><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo product_max_charlength_text($_product->get_title(), (int) get_option('sense_num_product_title')); ?></a></p>
						
							 <?php if (  get_option('woocommerce_enable_review_rating') != 'no'  ){ ?>
							  <div class="rating readonly-rating" data-score="<?php echo $num_rating; ?>"></div>
							  <?php } ?>
							 <?php  printf( '<span class="reviewer">' . _x( 'by %1$s', 'by comment author', 'homeshop' ) . '</span>', get_comment_author() ); ?>

							<span class="price"><?php echo $_product->get_price_html(); ?></span>
						</td>
					</tr>
					<?php
					}

				echo '</table>';
				echo  '</div></div></div>';
			} else {
			
			echo '<div class="row products-row sidebar-box  '. $color .'">
						 
						<div class="col-lg-12 col-md-12 col-sm-12">
							
							<!-- Carousel Heading -->
							<div class="carousel-heading no-margin">
								
								<h4><i class="icons  '. esc_attr($icon) .'"></i> '. esc_html($title) .'</h4>
								<div class="carousel-arrows">
									<i class="icons icon-left-dir"></i>
									<i class="icons icon-right-dir"></i>
								</div>
								
							</div>
							<!-- /Carousel Heading -->
							
						</div>
						
						<!-- Carousel -->
						<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
							
							<div class="owl-carousel owl-carousel'. esc_attr($id) .' " data-max-items="1">';
			
			
			foreach ( (array) $comments as $comment ) {

					$_product = get_product( $comment->comment_post_ID );

					$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
					$num_rating = (int) $_product->get_average_rating();
					$image_src = WC_Compare_Functions::get_post_thumbnail($_product->id, 270, 270);
					?>
			
			
			
			
					<!-- Slide -->
					<div>
						<!-- Carousel Item -->
						<div class="product">
							
							<div class="product-image">
							
								<?php echo $image_src; ?>
								
								<?php if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') { ?>
								
								<a href="<?php echo esc_url( get_permalink( $_product->id ) ); ?>" class="product-hover">
									<i class="icons icon-eye-1"></i> <?php _e('Quick View', 'homeshop'); ?>
								</a>
								
								<?php } ?>
								
							</div>
							
							<div class="product-info">
								<h5><a href="<?php echo esc_url( get_permalink( $_product->id ) ); ?>"><?php echo product_max_charlength_text($_product->get_title(), (int) get_option('sense_num_product_title')); ?></a></h5>
								<span class="price"><?php echo $_product->get_price_html(); ?></span>
								
								<?php if (  get_option('woocommerce_enable_review_rating') != 'no'  ){ ?>
								    <div class="rating readonly-rating" data-score="<?php echo $num_rating; ?>"></div>
								<?php } ?>
								
								 <?php  printf( '<span class="reviewer">' . _x( 'by %1$s', 'by comment author', 'homeshop' ) . '</span>', get_comment_author() ); ?>

							</div>
							
							<div class="product-actions">
								<?php
					
								woocommerce_template_loop_add_to_cart();
								
								if( class_exists( 'YITH_WCWL_Shortcode' ) ) {
								echo do_shortcode('[yith_wcwl_add_to_wishlist]');
								}
								
								?>
								
								
									<?php if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button() != '' ) { ?>
									<span class="add-to-compare">
										<span class="action-wrapper">
											<i class="icons icon-docs"></i>
											<span class="action-name"><?php if ( function_exists('woo_add_compare_button' ) ) echo woo_add_compare_button(); ?></span>
										</span>
									</span>
									<?php } ?>	
							</div>
							
						</div>
						<!-- /Carousel Item -->
					</div>
					<!-- /Slide -->

			
			
			
			
			
			<?php }
			echo  '</div></div></div>';
			
			
			
			$output =	'';
			$output .= '<script type="text/javascript">'."\n";
			$output .= ' jQuery(document).ready(function($){'."\n";
			
			
			$output .= 'var max_items = 1; '."\n"; 
			$output .= 'var tablet_items = max_items;'."\n"; 
			$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
			$output .= 'var mobile_items = 1;'."\n"; 
			
			$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
			$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
			$output .= '	autoPlay: '.$slideshow.','."\n"; 
			if (is_rtl()) {
			$output .= '	direction:"rtl",'."\n"; 
			}			
			$output .= '	stopOnHover : true,'."\n";                 
			$output .= '	items:max_items,'."\n";                 
			$output .= '	pagination : false,'."\n";                 
			$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
			$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
			$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
			$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
			$output .= '	});'."\n";
			
			
			$output .= '	 });'."\n";
			$output .= '</script>'."\n";
	 
			echo $output;	
			}

		}

	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );

		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		$instance['category_id'] = strip_tags( $new_instance['category_id'] );
		$instance['slider_auto_scroll'] = strip_tags( $new_instance['slider_auto_scroll'] );
		$instance['effect_delay'] = strip_tags( $new_instance['effect_delay'] );
		$instance['skin_type'] = strip_tags( $new_instance['skin_type'] );
		
		$number_products = intval( $new_instance['number_products'] );
		if ( $number_products < 0 ) $number_products = -1;
		$instance['number_products'] 		= $number_products;
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' 				=> '', 
			'category_id' 			=> 0, 
			'slider_auto_scroll'	=> '',
			'effect_delay'			=> 1,
			'color'			=> '',
			'icon'			=> '',
			'skin_type'			=> '',
			'number_products' => ''
		) );
		extract( $instance );
		
		$title = esc_attr( $title );
		$color = $instance['color'];
		$icon = $instance['icon'];
		$skin_type = $instance['skin_type'];
		
		$number_products = intval( $number_products );
		if ( $number_products < 0 ) $number_products = -1;
		?>
		
		
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		

		<fieldset id="wc_product_slider_upgrade_area">
		<p><label><?php _e('Number of products to show:', 'homeshop'); ?> <input class="" name="<?php echo esc_attr($this->get_field_name('number_products')); ?>" type="text" value="<?php echo esc_attr($number_products); ?>" size="2" /></label><br />
		<span class="description"><?php _e('Important! Set -1 to show all products.', 'homeshop'); ?></span>
		</p>
		</fieldset>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('category_id')); ?>"><?php _e('Category:', 'homeshop'); ?></label> 
		<?php wp_dropdown_categories( array('orderby' => 'name', 'selected' => $category_id, 'name' => $this->get_field_name('category_id'), 'id' => $this->get_field_id('category_id'), 'class' => 'widefat', 'depth' => true, 'taxonomy' => 'product_cat') ); ?>
		</p>

		<fieldset id="wc_product_slider_upgrade_area">
		<p><label><strong><?php _e( 'Skin Type:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="wc_product_slider_skin_type" data-id="<?php echo esc_attr($this->get_field_id('skin_type')); ?>" name="<?php echo esc_attr($this->get_field_name('skin_type')); ?>" value="simple" checked="checked" /> <?php _e( 'Simple', 'homeshop' ); ?></label> &nbsp;&nbsp;&nbsp;
			<label><input type="radio" class="wc_product_slider_skin_type" data-id="<?php echo esc_attr($this->get_field_id('skin_type')); ?>" name="<?php echo esc_attr($this->get_field_name('skin_type')); ?>" value="carousel" <?php checked( $skin_type, 'carousel' ); ?> /> <?php _e( 'Carousel', 'homeshop' ); ?></label>
		</p>
		</fieldset>


  
		<p><label><strong><?php _e( 'Slideshow:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="wc_product_slider_slider_auto_scroll" data-id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_auto_scroll')); ?>" value="no" checked="checked" /> <?php _e( 'No', 'homeshop' ); ?></label> &nbsp;&nbsp;&nbsp;
			<label><input type="radio" class="wc_product_slider_slider_auto_scroll" data-id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_auto_scroll')); ?>" value="yes" <?php checked( $slider_auto_scroll, 'yes' ); ?> /> <?php _e( 'AUTO', 'homeshop' ); ?></label>
		</p>

		<fieldset id="wc_product_slider_upgrade_area">
		<div id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>_auto" <?php if ( $slider_auto_scroll != 'yes' ) { echo 'style="display:none"'; } ?>>
			<p><label><?php _e('Slideshow Delay:', 'homeshop'); ?> <input name="<?php echo esc_attr($this->get_field_name('effect_delay')); ?>" type="text" value="<?php echo esc_attr($effect_delay); ?>" size="1" /> <?php _e('seconds', 'homeshop'); ?></label></p>
		</div>


		</fieldset>
       
<?php
	}
}





//////////////////////////////////////////////////////////////////////
class WC_Top_Rated_Widget extends WP_Widget 
{

	function WC_Top_Rated_Widget() {
		$widget_ops = array( 'classname' => 'widget_product_toprated', 'description' => __('Display a list of your top rated products on your site.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_product_toprated' ); //default width = 250
		parent::__construct( 'widget_product_toprated', 'homeshop'.' - '.__('Woo Top Rated Products', 'homeshop'), $widget_ops, $control_ops );
	}
	
	
	function widget( $args, $instance ) {
		
		extract( $args );
		$instance = wp_parse_args( (array) $instance, array( 
					'title' 				=> '', 
					'category_id' 			=> 0, 
					'slider_auto_scroll'	=> '',
					'effect_delay'			=> 1,
					'color'			=> '',
					'icon'			=> '',
					'skin_type'			=> '',
					'number_products' => ''
				) );
		
		
		
		$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number      = $instance['number_products'];
		$skin_type      = $instance['skin_type'];
		$order       = 'asc';
		$show_rating = false;

		$color             =  $instance['color'] ;
		$icon             =  $instance['icon'] ;
		$slider_auto_scroll             =  $instance['slider_auto_scroll'] ;
		$effect_delay             =  $instance['effect_delay'] ;
		$category_id             =  $instance['category_id'] ;
		
		
		$term = get_term( $category_id, 'product_cat' );
		
		$instance['show_hidden'] = 0;
		$instance['hide_free'] = 0;
		$id = rand(1, 100);
		
		if ($slider_auto_scroll == 'yes') {
		$slideshow = $effect_delay*1000;
		}else{
		$slideshow = 'false';
		}

		
		add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
		
    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'product',
    		'product_cat' 	 => $term->slug,
    		'no_found_rows'  => 1,
    		'order'          => $order == 'asc' ? 'asc' : 'desc'
    	);

    	$query_args['meta_query'] = array();

    	if ( empty( $instance['show_hidden'] ) ) {
			$query_args['meta_query'][] = WC()->query->visibility_meta_query();
			$query_args['post_parent']  = 0;
		}

		if ( ! empty( $instance['hide_free'] ) ) {
    		$query_args['meta_query'][] = array(
			    'key'     => '_price',
			    'value'   => 0,
			    'compare' => '>',
			    'type'    => 'DECIMAL',
			);
    	}

	    $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	    $query_args['meta_query'] = WC()->query->get_meta_query();


    	

		$r = new WP_Query( $query_args );

		
		
		
		if ( $r->have_posts() ) {
			if ( $skin_type == 'simple' ) {
				echo '<div class="row sidebar-box '. esc_attr($color) .'">
							
				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<div class="sidebar-box-heading">
						<i class="icons '. esc_attr($icon) .'"></i>
						<h4>'. esc_html($title) .'</h4>
					</div>
					<div class="sidebar-box-content">';	
				
				
				echo '<table class="bestsellers-table">';

				while ( $r->have_posts()) {
					$r->the_post();
					wc_get_template( 'content-widget-product.php', array( 'show_rating' => $show_rating ) );
				}

				echo '</table>';
				echo  '</div></div></div>';
			}else{
			
			echo '<div class="row products-row sidebar-box  '. esc_attr($color) .'">
						 
						<div class="col-lg-12 col-md-12 col-sm-12">
							
							<!-- Carousel Heading -->
							<div class="carousel-heading no-margin">
								
								<h4><i class="icons  '. $icon .'"></i> '. esc_html($title) .'</h4>';
								
							
							if(count($r->posts) > 1) {	
								echo '<div class="carousel-arrows">
									<i class="icons icon-left-dir"></i>
									<i class="icons icon-right-dir"></i>
								</div>';
							}	
			echo '</div>
							<!-- /Carousel Heading -->
							
						</div>
						
						<!-- Carousel -->
						<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
							
							<div class="owl-carousel owl-theme owl-carousel'. esc_attr($id) .' " data-max-items="1">';
			
			
			
			while ( $r->have_posts()) {
					$r->the_post();
					wc_get_template( 'content-widget-product-carousel.php', array( 'show_rating' => $show_rating ) );
				}
			
			
			echo  '</div></div></div>';
			
			
			
		$output =	'';
		$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = 1; '."\n"; 
		$output .= 'var tablet_items = 1;'."\n"; 
		//$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
		$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n";  
		if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}	
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
		echo $output;
		
			}

			
		}
		
		remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
		wp_reset_postdata();
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );

		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		$instance['category_id'] = strip_tags( $new_instance['category_id'] );
		$instance['slider_auto_scroll'] = strip_tags( $new_instance['slider_auto_scroll'] );
		$instance['effect_delay'] = strip_tags( $new_instance['effect_delay'] );
		$instance['skin_type'] = strip_tags( $new_instance['skin_type'] );
		
		$number_products = intval( $new_instance['number_products'] );
		if ( $number_products < 0 ) $number_products = -1;
		$instance['number_products'] 		= $number_products;
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' 				=> '', 
			'category_id' 			=> 0, 
			'slider_auto_scroll'	=> '',
			'effect_delay'			=> 1,
			'color'			=> '',
			'icon'			=> '',
			'skin_type'			=> '',
			'number_products' => ''
		) );
		extract( $instance );
		
		$title = esc_attr( $title );
		$color = $instance['color'];
		$icon = $instance['icon'];
		$skin_type = $instance['skin_type'];
		
		$number_products = intval( $number_products );
		if ( $number_products < 0 ) $number_products = -1;
		
		
		
?>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		

		<fieldset id="wc_product_slider_upgrade_area">
		<p><label><?php _e('Number of products to show:', 'homeshop'); ?> <input class="" name="<?php echo esc_attr($this->get_field_name('number_products')); ?>" type="text" value="<?php echo esc_attr($number_products); ?>" size="2" /></label><br />
		<span class="description"><?php _e('Important! Set -1 to show all products.', 'homeshop'); ?></span>
		</p>
		</fieldset>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('category_id')); ?>"><?php _e('Category:', 'homeshop'); ?></label> 
		<?php wp_dropdown_categories( array('orderby' => 'name', 'selected' => $category_id, 'name' => esc_attr($this->get_field_name('category_id')), 'id' => esc_attr($this->get_field_id('category_id')), 'class' => 'widefat', 'depth' => true, 'taxonomy' => 'product_cat') ); ?>
		</p>

		<fieldset id="wc_product_slider_upgrade_area">
		<p><label><strong><?php _e( 'Skin Type:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="wc_product_slider_skin_type" data-id="<?php echo esc_attr($this->get_field_id('skin_type')); ?>" name="<?php echo esc_attr($this->get_field_name('skin_type')); ?>" value="simple" checked="checked" /> <?php _e( 'Simple', 'homeshop' ); ?></label> &nbsp;&nbsp;&nbsp;
			<label><input type="radio" class="wc_product_slider_skin_type" data-id="<?php echo esc_attr($this->get_field_id('skin_type')); ?>" name="<?php echo esc_attr($this->get_field_name('skin_type')); ?>" value="carousel" <?php checked( $skin_type, 'carousel' ); ?> /> <?php _e( 'Carousel', 'homeshop' ); ?></label>
		</p>
		</fieldset>


  
		<p><label><strong><?php _e( 'Slideshow:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="wc_product_slider_slider_auto_scroll" data-id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_auto_scroll')); ?>" value="no" checked="checked" /> <?php _e( 'No', 'homeshop' ); ?></label> &nbsp;&nbsp;&nbsp;
			<label><input type="radio" class="wc_product_slider_slider_auto_scroll" data-id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_auto_scroll')); ?>" value="yes" <?php checked( $slider_auto_scroll, 'yes' ); ?> /> <?php _e( 'AUTO', 'homeshop' ); ?></label>
		</p>

		<fieldset id="wc_product_slider_upgrade_area">
		<div id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>_auto" <?php if ( $slider_auto_scroll != 'yes' ) { echo 'style="display:none"'; } ?>>
			<p><label><?php _e('Slideshow Delay:', 'homeshop'); ?> <input name="<?php echo esc_attr($this->get_field_name('effect_delay')); ?>" type="text" value="<?php echo esc_attr($effect_delay); ?>" size="1" /> <?php _e('seconds', 'homeshop'); ?></label></p>
		</div>


		</fieldset>
       
<?php
	}
}




//////////////////////////////////////////////////////////////////////////////
class WC_Product_Slider_Widget extends WP_Widget 
{

	function WC_Product_Slider_Widget() {
		$widget_ops = array( 'classname' => 'widget_product_cycle', 'description' => __('Use this widget to add Woocommerce Products', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_product_cycle' ); //default width = 250
		parent::__construct( 'widget_product_cycle', 'homeshop'.' - '.__('Woo Products', 'homeshop'), $widget_ops, $control_ops );
	}
	
	
	function widget( $args, $instance ) {
		
		extract( $args );
		$instance = wp_parse_args( (array) $instance, array( 
					'title' 				=> '', 
					'category_id' 			=> 0, 
					'slider_auto_scroll'	=> '',
					'effect_delay'			=> 1,
					'color'			=> '',
					'icon'			=> '',
					'skin_type'			=> '',
					'orderby'			=> '',
					'show'			=> '',
					'number_products' => ''
				) );
		
		
		
		$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number      = $instance['number_products'];
		$skin_type      = $instance['skin_type'];
		$show        = sanitize_title( $instance['show_type'] );
		$orderby     = sanitize_title( $instance['orderby'] );
		$order       = 'asc';
		$show_rating = false;

		$color             =  $instance['color'] ;
		$icon             =  $instance['icon'] ;
		$slider_auto_scroll             =  $instance['slider_auto_scroll'] ;
		$effect_delay             =  $instance['effect_delay'] ;
		$category_id             =  $instance['category_id'] ;
		
		
		$term = get_term( $category_id, 'product_cat' );
		
		$instance['show_hidden'] = 0;
		$instance['hide_free'] = 0;
		$id = rand(1, 100);
		
		if ($slider_auto_scroll == 'yes') {
		$slideshow = $effect_delay*1000;
		}else{
		$slideshow = 'false';
		}

		
		
    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'product',
    		'product_cat' 	 => $term->slug,
    		'no_found_rows'  => 1,
    		'order'          => $order == 'asc' ? 'asc' : 'desc'
    	);

    	$query_args['meta_query'] = array();

    	if ( empty( $instance['show_hidden'] ) ) {
			$query_args['meta_query'][] = WC()->query->visibility_meta_query();
			$query_args['post_parent']  = 0;
		}

		if ( ! empty( $instance['hide_free'] ) ) {
    		$query_args['meta_query'][] = array(
			    'key'     => '_price',
			    'value'   => 0,
			    'compare' => '>',
			    'type'    => 'DECIMAL',
			);
    	}

	    $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	    $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

    	switch ( $show ) {
    		case 'featured' :
    			$query_args['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
    			break;
    		case 'onsale' :
    			$product_ids_on_sale = wc_get_product_ids_on_sale();
				$product_ids_on_sale[] = 0;
				$query_args['post__in'] = $product_ids_on_sale;
    			break;
    	}

    	switch ( $orderby ) {
			case 'price' :
				$query_args['meta_key'] = '_price';
    			$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand' :
    			$query_args['orderby']  = 'rand';
				break;
			case 'sales' :
				$query_args['meta_key'] = 'total_sales';
    			$query_args['orderby']  = 'meta_value_num';
				break;
			default :
				$query_args['orderby']  = 'date';
    	}

		$r = new WP_Query( $query_args );

		if ( $r->have_posts() ) {
			if ( $skin_type == 'simple' ) {
				echo '<div class="row sidebar-box '. esc_attr($color) .'">
							
				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<div class="sidebar-box-heading">
						<i class="icons '. esc_attr($icon) .'"></i>
						<h4>'. $title .'</h4>
					</div>
					<div class="sidebar-box-content">';	
				
				
				echo '<table class="bestsellers-table">';

				while ( $r->have_posts()) {
					$r->the_post();
					wc_get_template( 'content-widget-product.php', array( 'show_rating' => $show_rating ) );
				}

				echo '</table>';
				echo  '</div></div></div>';
			}else{
			
			echo '<div class="row products-row sidebar-box  '. esc_attr($color) .'">
						 
						<div class="col-lg-12 col-md-12 col-sm-12">
							
							<!-- Carousel Heading -->
							<div class="carousel-heading no-margin">
								
								<h4><i class="icons  '. esc_attr($icon) .'"></i> '. $title .'</h4>
								<div class="carousel-arrows">
									<i class="icons icon-left-dir"></i>
									<i class="icons icon-right-dir"></i>
								</div>
								
							</div>
							<!-- /Carousel Heading -->
							
						</div>
						
						<!-- Carousel -->
						<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
							
							<div class="owl-carousel owl-carousel'. esc_attr($id) .' " data-max-items="1">';
			
			
			
			while ( $r->have_posts()) {
					$r->the_post();
					wc_get_template( 'content-widget-product-carousel.php', array( 'show_rating' => $show_rating ) );
				}
			
			
			echo  '</div></div></div>';
			
			
			
		$output =	'';
		$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = 1; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
		$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n"; 
		if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}	
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
		echo $output;	
			}

			
		}
		wp_reset_postdata();
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );

		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		$instance['category_id'] = strip_tags( $new_instance['category_id'] );
		$instance['slider_auto_scroll'] = strip_tags( $new_instance['slider_auto_scroll'] );
		$instance['effect_delay'] = strip_tags( $new_instance['effect_delay'] );
		$instance['orderby'] = strip_tags( $new_instance['orderby'] );
		$instance['show_type'] = strip_tags( $new_instance['show_type'] );
		$instance['skin_type'] = strip_tags( $new_instance['skin_type'] );
		
		$number_products = intval( $new_instance['number_products'] );
		if ( $number_products < 0 ) $number_products = -1;
		$instance['number_products'] 		= $number_products;
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' 				=> '', 
			'category_id' 			=> 0, 
			'slider_auto_scroll'	=> '',
			'effect_delay'			=> 1,
			'color'			=> '',
			'icon'			=> '',
			'skin_type'			=> '',
			'orderby'			=> 0,
			'show_type'			=> 0,
			'number_products' => ''
		) );
		extract( $instance );
		
		$title = esc_attr( $title );
		$color = $instance['color'];
		$icon = $instance['icon'];
		$orderby = $instance['orderby'];
		$show_type = $instance['show_type'];
		$skin_type = $instance['skin_type'];
		
		$number_products = intval( $number_products );
		if ( $number_products < 0 ) $number_products = -1;
		
		
		
?>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
		
		<p>
		<label><?php _e( 'Show Type:', 'homeshop'); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('show_type')); ?>" name="<?php echo esc_attr($this->get_field_name('show_type')); ?>" >
				<option value="" <?php selected( $instance['show_type'], '' ); ?>><?php _e( 'Category', 'homeshop' ); ?></option>
				<option value="featured" <?php selected( $instance['show_type'], 'featured' ); ?>><?php _e( 'Featured', 'homeshop' ); ?></option>
				<option value="onsale" <?php selected( $instance['show_type'], 'onsale' ); ?>><?php _e( 'On Sale', 'homeshop' ); ?></option>
			</select>
		</p>

		<fieldset id="wc_product_slider_upgrade_area">
		<p><label><?php _e('Number of products to show:', 'homeshop'); ?> <input class="" name="<?php echo esc_attr($this->get_field_name('number_products')); ?>" type="text" value="<?php echo esc_attr($number_products); ?>" size="2" /></label><br />
		<span class="description"><?php _e('Important! Set -1 to show all products.', 'homeshop'); ?></span>
		</p>
		</fieldset>

		<p>
		<label><?php _e( 'Order by:', 'homeshop'); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" >
				<option value="date" <?php selected( $instance['orderby'], 'date' ); ?>><?php _e( 'Date', 'homeshop' ); ?></option>
				<option value="price" <?php selected( $instance['orderby'], 'price' ); ?>><?php _e( 'Price', 'homeshop' ); ?></option>
				<option value="rand" <?php selected( $instance['orderby'], 'rand' ); ?>><?php _e( 'Random', 'homeshop' ); ?></option>
				<option value="sales" <?php selected( $instance['orderby'], 'sales' ); ?>><?php _e( 'Sales', 'homeshop' ); ?></option>
			</select>
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('category_id')); ?>"><?php _e('Category:', 'homeshop'); ?></label> 
		<?php wp_dropdown_categories( array('orderby' => 'name', 'selected' => $category_id, 'name' => esc_attr($this->get_field_name('category_id')), 'id' => esc_attr($this->get_field_id('category_id')), 'class' => 'widefat', 'depth' => true, 'taxonomy' => 'product_cat') ); ?>
		</p>

		<fieldset id="wc_product_slider_upgrade_area">
		<p><label><strong><?php _e( 'Skin Type:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="wc_product_slider_skin_type" data-id="<?php echo esc_attr($this->get_field_id('skin_type')); ?>" name="<?php echo esc_attr($this->get_field_name('skin_type')); ?>" value="simple" checked="checked" /> <?php _e( 'Simple', 'homeshop' ); ?></label> &nbsp;&nbsp;&nbsp;
			<label><input type="radio" class="wc_product_slider_skin_type" data-id="<?php echo esc_attr($this->get_field_id('skin_type')); ?>" name="<?php echo esc_attr($this->get_field_name('skin_type')); ?>" value="carousel" <?php checked( $skin_type, 'carousel' ); ?> /> <?php _e( 'Carousel', 'homeshop' ); ?></label>
		</p>
		</fieldset>


  
		<p><label><strong><?php _e( 'Slideshow:', 'homeshop' ); ?></strong></label>
			<label><input type="radio" class="wc_product_slider_slider_auto_scroll" data-id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_auto_scroll')); ?>" value="no" checked="checked" /> <?php _e( 'No', 'homeshop' ); ?></label> &nbsp;&nbsp;&nbsp;
			<label><input type="radio" class="wc_product_slider_slider_auto_scroll" data-id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>" name="<?php echo esc_attr($this->get_field_name('slider_auto_scroll')); ?>" value="yes" <?php checked( $slider_auto_scroll, 'yes' ); ?> /> <?php _e( 'AUTO', 'homeshop' ); ?></label>
		</p>

		<fieldset id="wc_product_slider_upgrade_area">
		<div id="<?php echo esc_attr($this->get_field_id('slider_auto_scroll')); ?>_auto" <?php if ( $slider_auto_scroll != 'yes' ) { echo 'style="display:none"'; } ?>>
			<p><label><?php _e('Slideshow Delay:', 'homeshop'); ?> <input name="<?php echo esc_attr($this->get_field_name('effect_delay')); ?>" type="text" value="<?php echo esc_attr($effect_delay); ?>" size="1" /> <?php _e('seconds', 'homeshop'); ?></label></p>
		</div>


		</fieldset>
       
<?php
	}
}


/**
 * Navigation Menu widget class
 *
 * @since 3.0.0
 */
 class WP_Nav_Menu_Widget1 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Add a custom menu to your sidebar.', 'homeshop') );
		parent::__construct( 'nav_menu', 'homeshop'.' - '.__('Custom Menu', 'homeshop'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$color = $instance['color'];
		$icon = $instance['icon'];
		
		
	
        echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($instance['title']) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
		
		wp_nav_menu( array( 'fallback_cb' => '', 'container' => false, 'menu' => $nav_menu, 'depth'           => 3, 'walker' => new widget_walker_nav_menu ) );

	
		echo "</div></div></div>\n";	
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		return $instance;
	}

	function form( $instance ) {
		$color = $icon = $nav_menu = $title = '';
		
		$instance = wp_parse_args( (array) $instance, array( 
			'title' 				=> '', 
			'color'			=> '',
			'nav_menu'			=> '',
			'icon' => ''
		) );
		extract( $instance );
		
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		$color = $instance['color'];
		$icon = $instance['icon'];
		
		// Get menus
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'homeshop' ), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
		
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>"><?php _e('Select Menu:', 'homeshop'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>">
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. $menu->name . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}



class WP_Nav_Menu_Widget2 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Add a custom menu to your sidebar.', 'homeshop') );
		parent::__construct( 'nav_menu_bottom', 'homeshop'.' - '.__('Custom Menu Bottom', 'homeshop'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		
		
	
        echo '<h4>'. $instance['title'] .'</h4>';	
		
		wp_nav_menu( array( 'fallback_cb' => '', 'container' => false, 'menu' => $nav_menu, 'depth'           => 3, 'walker' => new widget_walker_nav_menu_bottom ) );

	
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		
		
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		
	
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>"><?php _e('Select Menu:', 'homeshop'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>">
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. $menu->name . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}







class widget_walker_nav_menu extends Walker_Nav_Menu {



     function start_lvl( &$output, $depth = 0, $args = array() ) {
		
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='sidebar-dropdown'><li><ul>\n";
	}


	 function end_lvl( &$output, $depth = 0, $args = array() ) {
		
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></li></ul>\n";
	}


// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}

class widget_walker_nav_menu_bottom extends Walker_Nav_Menu {



     function start_lvl( &$output, $depth = 0, $args = array() ) {
		
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='sidebar-dropdown'><li><ul>\n";
	}


	 function end_lvl( &$output, $depth = 0, $args = array() ) {
		
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></li></ul>\n";
	}


// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

    $item_output = sprintf( '%1$s<a%2$s><i class="icons icon-right-dir"></i> %3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}



/**
 * Tag cloud widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Tag_Cloud1 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "A cloud of your most used tags.", 'homeshop') );
		parent::__construct('tag_cloud', 'homeshop'.' - '.__('Tag Cloud', 'homeshop'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		
		$color = $instance['color'];
		$icon = $instance['icon'];
		
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags', 'homeshop');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content sidebar-padding-box">';	
				
		

		/**
		 * Filter the taxonomy used in the Tag Cloud widget.
		 *
		 * @since 2.8.0
		 * @since 3.0.0 Added taxonomy drop-down.
		 *
		 * @see wp_tag_cloud()
		 *
		 * @param array $current_taxonomy The taxonomy to use in the tag cloud. Default 'tags'.
		 */
		wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array(
			'taxonomy' => $current_taxonomy
		) ) );

		echo "</div></div></div>\n";
		//echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		
		return $instance;
	}

	function form( $instance ) {
	
	    $instance = wp_parse_args( (array) $instance, array( 
			'title' 				=> '', 
			'color'			=> '',
			'icon' => ''
		) );
		extract( $instance );
	
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		
		$color = $instance['color'];
		$icon = $instance['icon'];
?>
	<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop') ?></label>
	<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	
	
	
	
	
	    <p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
	
	
	
	<p><label for="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>"><?php _e('Taxonomy:', 'homeshop') ?></label>
	<select class="widefat" id="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>" name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>">
	<?php foreach ( get_taxonomies() as $taxonomy ) :
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) )
					continue;
	?>
		<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
	<?php endforeach; ?>
	</select></p><?php
	}

	function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
}




/**
 * RSS widget class
 *
 * @since 2.8.0
 */
class WP_Widget_RSS1 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Entries from any RSS or Atom feed.', 'homeshop') );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::__construct( 'rss', 'homeshop'.' - '.__('RSS', 'homeshop'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {

		if ( isset($instance['error']) && $instance['error'] )
			return;

		extract($args, EXTR_SKIP);

		$url = ! empty( $instance['url'] ) ? $instance['url'] : '';
		while ( stristr($url, 'http') != $url )
			$url = substr($url, 1);

		if ( empty($url) )
			return;

		// self-url destruction sequence
		if ( in_array( untrailingslashit( $url ), array( site_url(), home_url() ) ) )
			return;

		$rss = fetch_feed($url);
		$title = $instance['title'];
		
		$color = 'red'; //$instance['color'];
		
		$desc = '';
		$link = '';

		if ( ! is_wp_error($rss) ) {
			$desc = esc_attr(strip_tags(@html_entity_decode($rss->get_description(), ENT_QUOTES, get_option('blog_charset'))));
			if ( empty($title) )
				$title = esc_html(strip_tags($rss->get_title()));
			$link = esc_url(strip_tags($rss->get_permalink()));
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);
		}

		if ( empty($title) ) {
			$title = empty($desc) ? __('Unknown Feed', 'homeshop') : $desc;
		}
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$url = esc_url(strip_tags($url));
		$icon = includes_url('images/rss.png');
		
		
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content" style="padding:20px;" >';	
				
		wp_widget_rss_output( $rss, $instance );
		//echo $after_widget;

		echo  '</div></div></div>';
		
		if ( ! is_wp_error($rss) )
			$rss->__destruct();
		unset($rss);
	}

	function update($new_instance, $old_instance) {
		$testurl = ( isset( $new_instance['url'] ) && ( !isset( $old_instance['url'] ) || ( $new_instance['url'] != $old_instance['url'] ) ) );

		return wp_widget_rss_process1( $new_instance, $testurl );
	}

	function form($instance) {

		if ( empty($instance) )
		{
			$instance = array( 'title' => '', 'url' => '', 'color' => '',  'items' => 10, 'error' => false, 'show_summary' => 0, 'show_author' => 0, 'show_date' => 0 );
		}
		$instance['number'] = $this->number;

		$instance['color'] = 'red';

		wp_widget_rss_form1( $instance );
	}
}


function wp_widget_rss_process1( $widget_rss, $check_feed = true ) {
	$items = (int) $widget_rss['items'];
	if ( $items < 1 || 20 < $items )
		$items = 10;
	$url           = esc_url_raw( strip_tags( $widget_rss['url'] ) );
	$title         = isset( $widget_rss['title'] ) ? trim( strip_tags( $widget_rss['title'] ) ) : '';
	$color         =isset( $widget_rss['color'] ) ? trim( strip_tags( $widget_rss['color'] ) ) : '';
	$show_summary  = isset( $widget_rss['show_summary'] ) ? (int) $widget_rss['show_summary'] : 0;
	$show_author   = isset( $widget_rss['show_author'] ) ? (int) $widget_rss['show_author'] :0;
	$show_date     = isset( $widget_rss['show_date'] ) ? (int) $widget_rss['show_date'] : 0;

	
	if ( $check_feed ) {
		$rss = fetch_feed($url);
		$error = false;
		$link = '';
		if ( is_wp_error($rss) ) {
			$error = $rss->get_error_message();
		} else {
			$link = esc_url(strip_tags($rss->get_permalink()));
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);

			$rss->__destruct();
			unset($rss);
		}
	}

	return compact( 'title', 'color', 'url', 'link', 'items', 'error', 'show_summary', 'show_author', 'show_date' );
}



function wp_widget_rss_form1( $args, $inputs = null ) {

	$default_inputs = array( 'url' => true, 'title' => true,  'color' => true, 'items' => true, 'show_summary' => true, 'show_author' => true, 'show_date' => true );
	$inputs = wp_parse_args( $inputs, $default_inputs );
	extract( $args );
	extract( $inputs, EXTR_SKIP );

	$number = esc_attr( $number );
	$title  = esc_attr( $title );
	
	$color  = $args['color'];
	
	$url    = esc_url( $url );
	$items  = (int) $items;
	if ( $items < 1 || 20 < $items )
		$items  = 10;
	$show_summary   = (int) $show_summary;
	$show_author    = (int) $show_author;
	$show_date      = (int) $show_date;

	if ( !empty($error) )
		echo '<p class="widget-error"><strong>' . sprintf( __('RSS Error: %s', 'homeshop'), $error) . '</strong></p>';

		
	
	?>
	
	<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="1 <?php echo esc_attr($args['color']); ?>" id="1 <?php echo esc_attr($args['color']); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $color, 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $color, 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $color, 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $color, 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $color, 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
	</p>	
	
		<?php
		
	if ( $inputs['url'] ) :
?>
	<p><label for="rss-url-<?php echo esc_attr($number); ?>"><?php _e('Enter the RSS feed URL here:', 'homeshop'); ?></label>
	<input class="widefat" id="rss-url-<?php echo esc_attr($number); ?>" name="widget-rss[<?php echo esc_attr($number); ?>][url]" type="text" value="<?php echo $url; ?>" /></p>
<?php endif; if ( $inputs['title'] ) : ?>
	<p><label for="rss-title-<?php echo esc_attr($number); ?>"><?php _e('Give the feed a title (optional):', 'homeshop'); ?></label>
	<input class="widefat" id="rss-title-<?php echo esc_attr($number); ?>" name="widget-rss[<?php echo esc_attr($number); ?>][title]" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php endif; if ( $inputs['items'] ) : ?>
	<p><label for="rss-items-<?php echo esc_attr($number); ?>"><?php _e('How many items would you like to display?', 'homeshop'); ?></label>
	<select id="rss-items-<?php echo esc_attr($number); ?>" name="widget-rss[<?php echo esc_attr($number); ?>][items]">
<?php
		for ( $i = 1; $i <= 20; ++$i )
			echo "<option value='$i' " . selected( $items, $i, false ) . ">$i</option>";
?>
	</select></p>
<?php endif; if ( $inputs['show_summary'] ) : ?>
	<p><input id="rss-show-summary-<?php echo esc_attr($number); ?>" name="widget-rss[<?php echo esc_attr($number); ?>][show_summary]" type="checkbox" value="1" <?php if ( $show_summary ) echo 'checked="checked"'; ?>/>
	<label for="rss-show-summary-<?php echo esc_attr($number); ?>"><?php _e('Display item content?', 'homeshop'); ?></label></p>
<?php endif; if ( $inputs['show_author'] ) : ?>
	<p><input id="rss-show-author-<?php echo esc_attr($number); ?>" name="widget-rss[<?php echo esc_attr($number); ?>][show_author]" type="checkbox" value="1" <?php if ( $show_author ) echo 'checked="checked"'; ?>/>
	<label for="rss-show-author-<?php echo esc_attr($number); ?>"><?php _e('Display item author if available?', 'homeshop'); ?></label></p>
<?php endif; if ( $inputs['show_date'] ) : ?>
	<p><input id="rss-show-date-<?php echo esc_attr($number); ?>" name="widget-rss[<?php echo esc_attr($number); ?>][show_date]" type="checkbox" value="1" <?php if ( $show_date ) echo 'checked="checked"'; ?>/>
	<label for="rss-show-date-<?php echo esc_attr($number); ?>"><?php _e('Display item date?', 'homeshop'); ?></label></p>
<?php
	endif;
	foreach ( array_keys($default_inputs) as $input ) :
		if ( 'hidden' === $inputs[$input] ) :
			$id = str_replace( '_', '-', $input );
?>
	<input type="hidden" id="rss-<?php echo esc_attr($id); ?>-<?php echo esc_attr($number); ?>" name="widget-rss[<?php echo esc_attr($number); ?>][<?php echo $input; ?>]" value="<?php echo esc_attr($input); ?>" />
<?php
		endif;
	endforeach;
}










/**
 * Recent_Comments widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Recent_Comments1 extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_comments', 'description' => __( 'Your site most recent comments.', 'homeshop' ) );
		parent::__construct('recent-comments', 'homeshop'.' - '.__('Recent Comments', 'homeshop'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) ) {
			add_action( 'wp_head', array($this, 'recent_comments_style') );
		}
			

		add_action( 'comment_post', array($this, 'flush_widget_cache') );
		add_action( 'edit_comment', array($this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array($this, 'flush_widget_cache') );
	}

	function recent_comments_style() {

		/**
		 * Filter the Recent Comments default widget styles.
		 *
		 * @since 3.1.0
		 *
		 * @param bool   $active  Whether the widget is active. Default true.
		 * @param string $id_base The widget ID.
		 */
		if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
			return;
		?>
	<style type="text/css">.recentcomments a{display: block !important; padding: 8px 35px 8px 20px !important;}</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get('widget_recent_comments', 'widget');
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		
		
		
		
		
		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments', 'homeshop' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$color = isset( $instance['color'] ) ? esc_attr( $instance['color'] ) : 'default';
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';
		
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		) ) );

		
		$output .=  '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content"  >';	
				
		$output .= '<ul id="recentcomments">';
		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment) {
				$output .=  '<li class="recentcomments"><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">'. get_comment_author_link() .', ' . get_the_title($comment->comment_post_ID) . '</a></li>';
			}
		}
		$output .= '</ul></div></div></div>';
		
		echo $output;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = $output;
			wp_cache_set( 'widget_recent_comments', $cache, 'widget' );
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		

		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option('widget_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		
		if(!isset( $instance['color'] )) {
			$instance['color'] = 'default';
			
		}

		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$color = isset( $instance['color'] ) ? esc_attr( $instance['color'] ) : 'default';
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'homeshop' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of comments to show:', 'homeshop' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
	<?php
	}
}






/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Recent_Posts1 extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "Your site&#8217;s most recent Posts.", 'homeshop') );
		parent::__construct('recent-posts', 'homeshop'.' - '.__('Recent Posts', 'homeshop'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	
	
	
	
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);
		$instance = wp_parse_args( (array) $instance, array( 
					'title' 				=> '', 
					'color' 			=> '', 
					'icon'	=> '',
					'number'			=> ''
				) );
		
		
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'homeshop' );
		
		$color = $instance['color'];
		$icon = $instance['icon'];
		
		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
			echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content" style="" >';	
		
		?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php get_the_title() ? the_title() : the_ID(); ?>
			<?php if ( $show_date ) : ?>
				<span class="post-date">(<?php echo get_the_date(); ?>)</span>
			<?php endif; ?>
			</a>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo '</div></div></div>'; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
		} else {
			ob_flush();
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'color' => '', 'icon' => '', 'show_date' => '', 'number' => '' ) );
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$color = $instance['color'];
		$icon = $instance['icon'];
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'homeshop' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'homeshop' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'homeshop' ); ?></label></p>
		
		<p>
		<label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
<?php
	}
}





/**
 * Text widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Text1 extends WP_Widget {
	
	function WP_Widget_Text1() {
		$widget_ops = array( 'classname' => 'widget_text', 'description' => __('Arbitrary text or HTML.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_text' ); //default width = 250
		parent::__construct( 'widget_text', 'homeshop'.' - '.__('Text', 'homeshop'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$color = $instance['color'];
		$icon = $instance['icon'];
		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		//echo $before_widget;
		
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content" style="padding:15px;" >';	
		?>
			<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		//echo $after_widget;
		echo '</div></div></div>';
		
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'color' => '', 'icon' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		$color = $instance['color'];
		$icon = $instance['icon'];	
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php _e('Automatically add paragraphs', 'homeshop'); ?></label></p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
	<?php
	}
}




/**
 * Calendar widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Calendar1 extends WP_Widget {

	function WP_Widget_Calendar1() {
		$widget_ops = array( 'classname' => 'widget_calendar', 'description' => __('A calendar of your site&#8217;s Posts.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_calendar' ); //default width = 250
		parent::__construct( 'widget_calendar', 'homeshop'.' - '.__('Calendar', 'homeshop'), $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract($args);

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$color = $instance['color'];
		$icon = $instance['icon'];
		
		//echo $before_widget;
		//if ( $title ) echo $before_title . $title . $after_title;
		//echo '<div id="calendar_wrap">';
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content" style="padding:15px;" >';	
		
		get_calendar();
		
		
		echo '</div></div></div>';
		//echo $after_widget;
		
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		
		
		if(!isset( $instance['color'] )) {
			$instance['color'] = 'default';
			
		}

		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$color = isset( $instance['color'] ) ? esc_attr( $instance['color'] ) : 'default';
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';

	
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
	<?php
	}
}






/**
 * Meta widget class
 *
 * Displays log in/out, RSS feed links, etc.
 *
 * @since 2.8.0
 */
class WP_Widget_Meta1 extends WP_Widget {

	function WP_Widget_Meta1() {
		$widget_ops = array( 'classname' => 'widget_meta', 'description' => __('Login, RSS, &amp; WordPress.org links.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_meta' ); //default width = 250
		parent::__construct( 'widget_meta', 'homeshop'.' - '.__('Meta', 'homeshop'), $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract($args);

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Meta', 'homeshop' ) : $instance['title'], $instance, $this->id_base );

		$color = $instance['color'];
		$icon = $instance['icon'];
		
		//echo $before_widget;
		//if ( $title )  echo $before_title . $title . $after_title;
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
?>
			<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_attr(__('Syndicate this site using RSS 2.0', 'homeshop')); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>', 'homeshop'); ?></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_attr(__('The latest comments to all posts in RSS', 'homeshop')); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>', 'homeshop'); ?></a></li>
<?php
			/**
			 * Filter the "Powered by WordPress" text in the Meta widget.
			 *
			 * @since 3.6.0
			 *
			 * @param string $title_text Default title text for the WordPress.org link.
			 */
			echo apply_filters( 'widget_meta_poweredby', sprintf( '<li><a href="%s" title="%s">%s</a></li>',
				esc_url( __( 'https://wordpress.org/', 'homeshop' ) ),
				esc_attr__( 'Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'homeshop' ),
				_x( 'WordPress.org', 'meta widget link text', 'homeshop' )
			) );

			wp_meta();
?>
			</ul>
<?php
		//echo $after_widget;
		
		echo '</div>
                </div>		
				</div>';	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		$color = $instance['color'];
		$icon = $instance['icon'];
		
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop'); ?></label> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
			
			
	<?php
	}
}






/**
 * Archives widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Archives1 extends WP_Widget {

	function WP_Widget_Archives1() {
		$widget_ops = array( 'classname' => 'widget_archive', 'description' => __('A monthly archive of your site&#8217;s Posts.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_archive' ); //default width = 250
		parent::__construct( 'widget_archive', 'homeshop'.' - '.__('Archives', 'homeshop'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract($args);
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty($instance['title'] ) ? __( 'Archives', 'homeshop' ) : $instance['title'], $instance, $this->id_base );

		$color = $instance['color'];
		$icon = $instance['icon'];
		
		//echo $before_widget;
		//if ( $title ) echo $before_title . $title . $after_title;

		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
		
		
		if ( $d ) {
?>
		<select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
			<option value=""><?php echo esc_attr( __( 'Select Month', 'homeshop' ) ); ?></option>

			<?php
			/**
			 * Filter the arguments for the Archives widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_get_archives()
			 *
			 * @param array $args An array of Archives widget drop-down arguments.
			 */
			wp_get_archives( apply_filters( 'widget_archives_dropdown_args', array(
				'type'            => 'monthly',
				'format'          => 'option',
				'show_post_count' => $c
			) ) );
?>
		</select>
<?php
		} else {
?>
		<ul>
<?php
		/**
		 * Filter the arguments for the Archives widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_get_archives()
		 *
		 * @param array $args An array of Archives option arguments.
		 */
		wp_get_archives( apply_filters( 'widget_archives_args', array(
			'type'            => 'monthly',
			'show_post_count' => $c
		) ) );
?>
		</ul>
<?php
		}

		//echo $after_widget;
		
		echo '</div>
                </div>		
				</div>';	
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;

		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		
		return $instance;
	}

	function form( $instance ) {
	
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '', 'color' => '', 'icon' => 'none') );
		$title = strip_tags($instance['title']);
		$count = $instance['count'] ? 'checked="checked"' : '';
		$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
		
		$color = $instance['color'];
		$icon = $instance['icon'];
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop'); ?></label> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo esc_attr($this->get_field_id('dropdown')); ?>" name="<?php echo esc_attr($this->get_field_name('dropdown')); ?>" /> <label for="<?php echo esc_attr($this->get_field_id('dropdown')); ?>"><?php _e('Display as dropdown', 'homeshop'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" /> <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php _e('Show post counts', 'homeshop'); ?></label>
		</p>
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
		
<?php
	}
}






/**
 * Search widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Search1 extends WP_Widget {

	function WP_Widget_Search1() {
		$widget_ops = array( 'classname' => 'widget_search', 'description' => __('A search form for your site.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_search' ); //default width = 250
		parent::__construct( 'widget_search', 'homeshop'.' - '.__('Search widget', 'homeshop'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$color = $instance['color'];
		$icon = $instance['icon'];
		

		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
		
		
		// Use current theme search form if it exists
		get_search_form();

		echo '</div>
                </div>		
				</div>';	
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'color' => '', 'icon' => 'none') );
		$title = $instance['title'];
		
		
		$color = $instance['color'];
		$icon = $instance['icon'];
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

		
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		
		return $instance;
	}

}





/**
 * Pages widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Pages1 extends WP_Widget {

	function WP_Widget_Pages1() {
		$widget_ops = array( 'classname' => 'widget_pages', 'description' => __('A list of your site&#8217;s Pages.', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_pages' ); //default width = 250
		parent::__construct( 'widget_pages', 'homeshop'.' - '.__('Pages', 'homeshop'), $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract( $args );

		/**
		 * Filter the widget title.
		 *
		 * @since 2.6.0
		 *
		 * @param string $title    The widget title. Default 'Pages'.
		 * @param array  $instance An array of the widget's settings.
		 * @param mixed  $id_base  The widget ID.
		 */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Pages', 'homeshop' ) : $instance['title'], $instance, $this->id_base );

		$color = $instance['color'];
		$icon = $instance['icon'];
		
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		if ( $sortby == 'menu_order' )
			$sortby = 'menu_order, post_title';

		/**
		 * Filter the arguments for the Pages widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_list_pages()
		 *
		 * @param array $args An array of arguments to retrieve the pages list.
		 */
		$out = wp_list_pages( apply_filters( 'widget_pages_args', array(
			'title_li'    => '',
			'echo'        => 0,
			'sort_column' => $sortby,
			'exclude'     => $exclude
		) ) );

		if ( !empty( $out ) ) {
		
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
	
		?>
		<ul>
			<?php echo $out; ?>
		</ul>
		<?php
		echo '</div>
                </div>		
				</div>';	
			
			
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'post_title', 'title' => '', 'icon' => '', 'color' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
		
		
		$color = $instance['color'];
		$icon = $instance['icon'];
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'homeshop'); ?></label> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('sortby')); ?>"><?php _e( 'Sort by:', 'homeshop' ); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('sortby')); ?>" id="<?php echo esc_attr($this->get_field_id('sortby')); ?>" class="widefat">
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title', 'homeshop'); ?></option>
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order', 'homeshop'); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID', 'homeshop' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('exclude')); ?>"><?php _e( 'Exclude:', 'homeshop' ); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo esc_attr($this->get_field_name('exclude')); ?>" id="<?php echo esc_attr($this->get_field_id('exclude')); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Page IDs, separated by commas.', 'homeshop' ); ?></small>
		</p>
		
		
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
				<?php 
				$setting = array();
				$setting['options'] = wm_fontello_classes(); 
				
				foreach ( $setting['options'] as $option_key => $option_value ) : ?>
					<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
<?php
	}

}


/**
 * Categories widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Categories1 extends WP_Widget {


	function WP_Widget_Categories1() {
		$widget_ops = array( 'classname' => 'widget_categories', 'description' => __('A list or dropdown of categories', 'homeshop') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_categories' ); //default width = 250
		parent::__construct( 'widget_categories', 'homeshop'.' - '.__('Categories', 'homeshop'), $widget_ops, $control_ops );
	}
	

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

		
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories', 'homeshop' ) : $instance['title'], $instance, $this->id_base );

		$color = $instance['color'];
		$icon = $instance['icon'];
		
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		//echo $before_widget;
		//if ( $title )
			//echo $before_title . $title . $after_title;

			
		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
			
		$cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h);

		if ( $d ) {
			$cat_args['show_option_none'] = __('Select Category', 'homeshop');

			/**
			 * Filter the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
?>

<script type='text/javascript'>
/* <![CDATA[ */
	var dropdown = document.getElementById("cat");
	function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
		}
	}
	dropdown.onchange = onCatChange;
/* ]]> */
</script>

<?php
		} else {
?>
		<ul>
<?php
		$cat_args['title_li'] = '';
		$cat_args['walker'] = new Walker_Category_Cust;
		
		
		/**
		 * Filter the arguments for the Categories widget.
		 *
		 * @since 2.8.0
		 *
		 * @param array $cat_args An array of Categories widget options.
		 */
		wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
?>
		</ul>
<?php
		}


		echo '</div>
                </div>		
				</div>';
		//echo $after_widget;
	}

	

	function form( $instance ) {
		$defaults = array( 'title' => 'Categories', 'color' => '', 'icon' => 'icon-docs', 'count' => '', 'hierarchical' => '', 'dropdown' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );

		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		
		$title = $instance['title'];
		$icon = $instance['icon'];
		?>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'homeshop' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>


		
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
				<?php 
				$setting = array();
				$setting['options'] = wm_fontello_classes(); 
				
				foreach ( $setting['options'] as $option_key => $option_value ) : ?>
					<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		
		
		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('color')); ?>" id="<?php echo esc_attr($this->get_field_id('color')); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
		
		
		
		
		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('dropdown')); ?>" name="<?php echo esc_attr($this->get_field_name('dropdown')); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('dropdown')); ?>"><?php _e( 'Display as dropdown', 'homeshop' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php _e( 'Show post counts', 'homeshop' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>" name="<?php echo esc_attr($this->get_field_name('hierarchical')); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>"><?php _e( 'Show hierarchy', 'homeshop' ); ?></label></p>
<?php
	}

}




/**
 * Mailchimp_Widget
 */
class Mailchimp_Widget extends WP_Widget {
	var $data = '';

	function __construct() {
		$widget_ops = array( 'description' => __('Use this widget to add a mailchimp newsletter to your site.','homeshop') );
		parent::__construct( 'zn_mailchimp',  'homeshop'.' - '.__('Newsletter', 'homeshop'), $widget_ops );

	}
	
	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		?>
		
		<form id="newsletter" action="#" method="POST" style="display: block !important;" >
		<?php
		if ( !empty($instance['title']) ) {
			echo '<h4>' . esc_html($instance['title']) . '</h4>';
			}
		?>	
		
		<?php
		//if ( !empty($instance['zn_mailchimp_intro']) ) {
			echo '<div id="mailchimp-sign-up1" style="position: absolute;font-size: 10px;top: 34px;left: 15px;color: red;" ><p>' . $instance['zn_mailchimp_intro'] . '</p></div>';
			//}
		?>	

		
		<span class="ajax-loader"></span>
		<input  id="s-email" type="text" name="email" placeholder="<?php _e('Enter your email address', 'homeshop'); ?>">
		<input type="submit" id="signup_submit" name="newsletter-submit" value="<?php echo __('Submit', 'homeshop'); ?>">

		</form>

		<?php	
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['zn_mailchimp_intro'] =  stripslashes($new_instance['zn_mailchimp_intro']) ;
		
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$zn_mailchimp_intro = isset( $instance['zn_mailchimp_intro'] ) ? $instance['zn_mailchimp_intro'] : '';
		$zn_mailchimp_outro = isset( $instance['zn_mailchimp_outro'] ) ? $instance['zn_mailchimp_outro'] : '';
		$data_mailchimp_api = get_option('sense_mailchimp_api');
		if ( $data_mailchimp_api == '' ) {
			echo __('Please enter your MailChimp API KEY in the theme options pannel prior of using this widget.','homeshop');
			return;
		}

		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','homeshop') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p>
			<div><label for="<?php echo esc_attr($this->get_field_id('zn_mailchimp_intro')); ?>"><?php echo __('Intro Text :','homeshop'); ?></label></div>
			<div><textarea id="<?php echo esc_attr($this->get_field_id('zn_mailchimp_intro')); ?>" name="<?php echo esc_attr($this->get_field_name('zn_mailchimp_intro')); ?>" cols="35" rows="5"><?php echo esc_textarea($zn_mailchimp_intro); ?></textarea></div>
		</p>
		

		<?php
	}
}


/////////Walker_Category_Cust//////////////////////////////////////////
class Walker_Category_Cust extends Walker {

	var $tree_type = 'category';
	var $db_fields = array ( 'parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );


	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='sidebar-dropdown hidden-xs'><li><ul>\n";
	}


	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></li></ul>\n";
	}


	public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$output .= '<li class="777 cat-item cat-item-' . $cat->term_id;

		if ( $args['current_category'] == $cat->term_id ) {
			$output .= ' current-cat';
		}

		if ( $args['has_children'] && $args['hierarchical'] ) {
			$output .= ' cat-parent';
		}

		
		if(isset( $args['current_category_ancestors'] )) {
		if ( $args['current_category_ancestors'] && $args['current_category'] && in_array( $cat->term_id, $args['current_category_ancestors'] ) ) {
			$output .= ' current-cat-parent';
		}
		}

		$count_cat = '';
		if ( $args['show_count'] ) {
		$count_cat = '('. $cat->count .')';
		}
		
		
		$output .=  '"><a href="' . esc_url(get_term_link( (int) $cat->term_id, 'category' )) . '">' . $cat->name . ' '. $count_cat .'<i class="icons icon-right-dir"></i></a>';

		
	}


	public function end_el( &$output, $cat, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}


	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		if ( ! $element || 0 === $element->count ) {
			return;
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

?>