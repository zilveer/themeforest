<?php
// Custom for Composer
$target_arr = array(__("Same window", 'candidate') => "_self", __("New window", 'candidate') => "_blank");
$show_arr = array(__("Show", 'candidate') => "_show", __("Hide", 'candidate') => "_hide");
$btn_size = array(__("Small", 'candidate') => "transparent", __("Middle", 'candidate') => " ", __("Big", 'candidate') => "big");

 
$icon_arr = candidat_custom_fontello_classes();


if (!function_exists('candidate_wpb_getImageBySize')) {
	function candidate_wpb_getImageBySize(
		$params = array(
			'post_id' => null,
			'attach_id' => null,
			'thumb_size' => 'thumbnail',
			'class' => ''
		)
	) {
		//array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size )
		if ( ( ! isset( $params['attach_id'] ) || $params['attach_id'] == null ) && ( ! isset( $params['post_id'] ) || $params['post_id'] == null ) ) {
			return false;
		}
		$post_id = isset( $params['post_id'] ) ? $params['post_id'] : 0;

		if ( $post_id ) {
			$attach_id = get_post_thumbnail_id( $post_id );
		} else {
			$attach_id = $params['attach_id'];
		}

		$thumb_size = $params['thumb_size'];
		$thumb_class = ( isset( $params['class'] ) && $params['class'] != '' ) ? $params['class'] . ' ' : '';

		global $_wp_additional_image_sizes;
		$thumbnail = '';

		if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, array(
					'thumbnail',
					'thumb',
					'medium',
					'large',
					'full'
				) ) )
		) {
			$attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );
			$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
		} elseif ( $attach_id ) {
			if ( is_string( $thumb_size ) ) {
				preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
				if ( isset( $thumb_matches[0] ) ) {
					$thumb_size = array();
					if ( count( $thumb_matches[0] ) > 1 ) {
						$thumb_size[] = $thumb_matches[0][0]; // width
						$thumb_size[] = $thumb_matches[0][1]; // height
					} elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
						$thumb_size[] = $thumb_matches[0][0]; // width
						$thumb_size[] = $thumb_matches[0][0]; // height
					} else {
						$thumb_size = false;
					}
				}
			}
			if ( is_array( $thumb_size ) ) {
				// Resize image to custom size
				$p_img = wpb_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
				$alt = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
				$attachment = get_post( $attach_id );
				if ( ! empty( $attachment ) ) {
					$title = trim( strip_tags( $attachment->post_title ) );

					if ( empty( $alt ) ) {
						$alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
					}
					if ( empty( $alt ) ) {
						$alt = $title;
					} // Finally, use the title
					if ( $p_img ) {

						$attributes = array(
							'class' => $thumb_class,
							'src' => $p_img['url'],
							'width' => $p_img['width'],
							'height' => $p_img['height'],
							'alt' => $alt,
							'title' => $title,
						);

						$thumbnail = '<img ' . vc_convert_atts_to_string( $attributes ) . ' />';
					}
				}
			}
		}

		$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

		return apply_filters( 'vc_wpb_getimagesize', array(
			'thumbnail' => $thumbnail,
			'p_img_large' => $p_img_large
		), $attach_id, $params );
	}
}






//////////////////////////////vc_statistic////////////////////////////////////////////////////////////////////////////////
function vc_statistic_func( $atts, $content = null ) { // New function parameter $content is added!
  $title = $number = $css_animation = '';
  
  extract( shortcode_atts( array(
    'title' => __("COMPLETED PROJECTS",'candidate'),
    'number' => '11000',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation." ";
	
	
	ob_start();
	
	echo '<div class="widget_stat  '. $css_class .'"  >';
		

	echo '<div class="p_table_stat" data-counter="' . esc_attr($number) . '">
					  <h2 class="counter_output">' . esc_html($number) . '</h2>
					  <div class="align_right">
						<div class="p_icon"></div>
					  </div>
					  <h6>' . esc_html($title) . '</h6>
					</div>';
		
	echo '</div>';	
	
	return ob_get_clean();
		

}
add_shortcode('vc_statistic', 'vc_statistic_func');


vc_map( array(
   "name" => __("Statistic", 'candidate'),
   "base" => "vc_statistic",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Widget Statistic', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("COMPLETED PROJECTS",'candidate'),
         "description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.",'candidate')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number", 'candidate'),
         "param_name" => "number",
         "value" => "11000",
         "description" => __("Enter number.",'candidate')
        ),
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );






//////////////////////////////vc_event_countdown////////////////////////////////////////////////////////////////////////////////
function vc_event_countdown_func( $atts, $content = null ) { // New function parameter $content is added!
  $title = $custom_link = $custom_link2 = $event_id = $css_animation = '';
  
  extract( shortcode_atts( array(
    'title' => __("Next Upcoming Event:",'candidate'),
    'custom_link' => '',
    'custom_link2' => '',
    'event_id' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation." ";
	$output = '';
	
	
	if( $event_id != '') {	
		$event_id = $event_id;
	} else {
		$event_posts = tribe_get_events(
			apply_filters(
				'tribe_events_list_widget_query_args', array(
					'eventDisplay'   => 'list',
					'posts_per_page' => '1'
				)
			)
		);
		foreach( $event_posts as $post ) :  setup_postdata($post);
			setup_postdata( $post );
			$event_id = $post->ID;
		endforeach; 	
		wp_reset_query();
	}
	
	$start_day = tribe_get_start_date( $event_id, false, 'd' );
	$start_month = tribe_get_start_date( $event_id, false, 'm' );
	$start_month1 = tribe_get_start_date( $event_id, false, 'M' );
	$start_year = tribe_get_start_date( $event_id, false, 'Y' );
	$link_event = get_permalink($event_id);
	$title_event = get_the_title($event_id);
	
	ob_start();
	
	echo '<div class="widget_event_countdown  '. $css_class .'"><div class="row">';
		
			echo '<div class="col-md-4 col-sm-12">';
			echo '<ul class="upcoming-events"><li>
									<div class="date">
										<span>
											<span class="day">'. $start_day .'</span>
											<span class="month">'. $start_month1 .'</span>
										</span>
									</div>
									
									<div class="event-content">
										<h6><a href="'. $link_event .'">'. esc_html($title) .'</a></h6>
										<h5><a href="'. $link_event .'">'. $title_event .'</a></h5>
									</div>
								</li></ul>';
			echo '</div>';	
			
			echo '<div class="col-md-4 col-sm-12"><div id="countdown2"></div></div>';
			
			echo '<div class="col-md-4 col-sm-12">';
			
				if (isset($custom_link) && !empty($custom_link)) {
					echo '<a href="'. $custom_link .'" target="_blank" class="button big button-arrow donate ">'. __('Join Now', 'candidate') .'</a>';
				}
				if (isset($custom_link2) && !empty($custom_link2)) {
					echo '<span class="button_or">'. __('or', 'candidate') .'</span><a href="'. $custom_link2 .'" target="_blank" class="button transparent button-arrow">'. __('View All Events', 'candidate') .'</a>';
				}			
							
			echo '</div>';
		
		?>
		<script type="text/javascript">
			(function($) {
			$(document).ready(function(){

				// countdown
					var newYear = new Date(); 
					newYear = new Date(<?php echo $start_year; ?>, <?php echo $start_month; ?>-1, <?php echo $start_day; ?>);  
					//alert(newYear);
					$('#countdown2').countdown({
						until: newYear,
						layout:'<dl class="count_item"><dt class="main_title">{d<}{dnn}</dt><dd><span>{dl}</span></dd></dl></div> {d>}'+
						'<dl class="count_item"><dt class="main_title">{hnn}</dt><dd><span>{hl}</span></dd></dl></div>'+
						' <dl class="count_item"><dt class="main_title">{mnn}</dt><dd><span>{ml}</span></dd></dl>'+
						' <dl class="count_item"><dt class="main_title">{snn}</dt><dd><span>{sl}</span></dd></dl>'
					}); 
					
			});
			})(jQuery);
		</script>
		<?php
	echo '</div></div>';	
	
	return ob_get_clean();
		

}
add_shortcode('vc_event_countdown', 'vc_event_countdown_func');


vc_map( array(
   "name" => __("Event countdown", 'candidate'),
   "base" => "vc_event_countdown",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Widget Event Countdown', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Next Upcoming Event:",'candidate'),
         "description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Event ID", 'candidate'),
         "param_name" => "event_id",
         "value" => "",
         "description" => __("Enter Event ID.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Join Now Link", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("View All Events Link", 'candidate'),
         "param_name" => "custom_link2",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );





//////////////////////////////vc_newsletter////////////////////////////////////////////////////////////////////////////////
function vc_newsletter_func( $atts, $content = null ) { // New function parameter $content is added!
  $title = $custom_link = $css_animation = '';
  
  extract( shortcode_atts( array(
    'title' => __("Newsletter",'candidate'),
    'type_newsletter' => 'type1',
    'custom_link' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation." ";
	$css_class .= $type_newsletter." ";
	$output = '';
	
	ob_start();
	
	echo '<div class="widget_newsletter  '. $css_class .'">';
			
			if($type_newsletter == 'type1') {
			
			echo '<div class="newsletter-form col-lg-8 col-md-8 col-sm-12 col-xs-12">';
			
			echo '<form id="newsletter" action="#" method="POST" >
						<span class="ajax-loader"></span>';
						
			if ( !empty($title) ) {
				echo '<h5>' . esc_html($title) . '</h5>';
				} else { 
				echo '<h5><strong>'. __( 'Sign up', 'candidate' ) .'</strong>'. __( 'for email updates', 'candidate' ) .'</h5>';
			}
						
			echo '<div class="newsletter-form">	
					<div class="newsletter-email">
						<input id="s-email" type="text" name="email" placeholder="'. __( 'Email address', 'candidate' ) .'">
					</div>
					<div class="newsletter-zip">
						<input type="text" name="newsletter-zip" placeholder="'. __( 'Zip code', 'candidate' ) .'">
					</div>
					
					<div class="newsletter-submit">
						<input type="submit" id="signup_submit" name="newsletter-submit" value=""><i class="icons icon-right-thin"></i>
					</div>
					
				</div>
				<div id="mailchimp-sign-up1" ><p>.</p></div>
			</form>';
			
			
			echo '</div>';
		
		
			} else {
				
			echo '<div class="newsletter-form col-lg-9 col-md-9 col-sm-12 col-xs-12">';
			
			echo '<form id="newsletter" action="#" method="POST" >
						<span class="ajax-loader"></span>';
						
			if ( !empty($title) ) {
				echo '<h5>' . esc_html($title) . '</h5>';
				} else { 
				echo '<h5><strong>'. __( 'Sign up', 'candidate' ) .'</strong><br>'. __( 'for email updates', 'candidate' ) .'</h5>';
			}
						
			echo '<div class="newsletter-form">	
					<div class="newsletter-email">
						<input id="s-email" type="text" name="email" placeholder="'. __( 'Email address', 'candidate' ) .'">
					</div>
					<div class="newsletter-zip">
						<input type="text" name="newsletter-zip" placeholder="'. __( 'Zip code', 'candidate' ) .'">
					</div>
					
					<div class="newsletter-submit">
						<input type="submit" id="signup_submit" name="newsletter-submit" value="'. __( 'Subscribe', 'candidate' ) .'">
					</div>
					
				</div>
				<div id="mailchimp-sign-up1" ><p>.</p></div>
			</form>';
			
			
			echo '</div>';
				
				
			}	
		
		
		
		
			if (isset($custom_link) && !empty($custom_link)): 
				echo '<div class="newsletter-bunnon pull-right"><a target="_blank" href="'. esc_url($custom_link) .'" class="button donate"><h3>'. __('Donate Now!','candidate') .'</h3></a></div>';
			endif; 
		
		
		
	echo '</div>';	
	
	return ob_get_clean();
		

}
add_shortcode('vc_newsletter', 'vc_newsletter_func');


vc_map( array(
   "name" => __("Newsletter(mailchimp)", 'candidate'),
   "base" => "vc_newsletter",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Widget Newsletter', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Newsletter",'candidate'),
         "description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.",'candidate')
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'candidate' ),
			'param_name' => 'type_newsletter',
			'value' => array(
				'type1' => 'type1',
				'type2' => 'type2'
			),
			'description' => esc_html__( 'Select type newsletter form.', 'candidate' )
		),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("URL Link", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );






//////////////////////////////vc_brands_logo ////////////////////////////////////////////////////////////////////////////////
function vc_brands_logo_func( $atts, $content = null ) { // New function parameter $content is added!
   $images = $columns = $autoplay = $autoplaytimeout = $animation_class = $css_animation = '';
   
   extract( shortcode_atts( array(
    'title' => __("Brands",'candidate'),
	'images' => "",
	'links' => "",
	'columns' => '6',
	'autoplay' => '',
	'autoplaytimeout' => 5000,
	'css_animation' => ""
   ), $atts ) );

	$css_class .= $css_animation.' ';
	
	
	$links = !empty($links) ? explode('|', $links) : '';
	$images = explode( ',', $images);
	$autoplay = ($autoplay == 'yes') ? 'true' : 'false';
	$i = 0;
	
	$output  = '<!-- Owl Carousel -->
						<div class="owl-carousel-container '. $css_class .'">
							
							<div class="owl-header">
								
								<h3 class="brands_carousel_title animate-onscroll">'. $title .'</h3>';
								
								
				if(count($images) > $columns) {			
			$output  .= '<div class="carousel-arrows animate-onscroll">
									<span class="left-arrow"><i class="icons icon-left-dir"></i></span>
									<span class="right-arrow"><i class="icons icon-right-dir"></i></span>
								</div>';
					}	
								
								
								
	$output  .= '</div>
	<div class="owl-carousel brands_carousel " data-max-items="'. $columns .'">';

	
	
	
		foreach ($images as $id => $attach_id): 

			$output  .= '<div class="item ">';

				if ($attach_id > 0): 

					$post_thumbnail = candidate_wpb_getImageBySize(
						array(
							'attach_id' => $attach_id,
							'thumb_size' => array(165, 100),
							'class' => ''
						)
					);
					else: 

					$post_thumbnail = array();
					$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
				endif; 

				$thumbnail = $post_thumbnail['thumbnail']; 
				$link = (isset($links[$i]) && !empty($links[$i])) ? trim($links[$i]) : ''; 

				if (isset($link) && !empty($link)): 
					$output  .= '<a target="_blank" href="'. esc_url($link) .'" class="d_block frame_container">';
				endif; 
				$output  .= $thumbnail; 
				if (isset($link) && !empty($link)): 
					$output  .= '</a>';
				endif; 

				$i++; 

			$output  .= '</div>';

		endforeach;
	
	
	
	$output .=  '</div></div>';
 
   return $output;
}
add_shortcode('vc_brands_logo', 'vc_brands_logo_func');

vc_map( array(
   "name" => __("Home block brands logo", 'candidate'),
   "base" => "vc_brands_logo",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of brands logo', 'candidate'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Brands",'candidate'),
         "description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.",'candidate')
        ),

		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'candidate' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'candidate' )
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__( 'Links', 'candidate' ),
			"param_name" => "links",
			"holder" => "span",
			"description" => esc_html__( 'Input links values. Divide values with linebreaks (|). Example: http://brand.com | http://brand2.com', 'candidate' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'candidate' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '2 columns', 'candidate' ) => '2',
				esc_html__( '5 columns', 'candidate' ) => '5',
				esc_html__( '6 columns', 'candidate' ) => '6'
			),
			'std' => '6',
			'description' => esc_html__( 'Columns', 'candidate' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Autoplay', 'candidate' ),
			'param_name' => 'autoplay',
			'description' => esc_html__( 'Enables autoplay mode.', 'candidate' ),
			'value' => array( esc_html__( 'Yes, please', 'candidate' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Autoplay timeout', 'candidate' ),
			'param_name' => 'autoplaytimeout',
			'description' => esc_html__( 'Autoplay interval timeout', 'candidate' ),
			'value' => '5000',
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( 'yes' )
			)
		),
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );



//////////////////////////////vc_instagram_photos////////////////////////////////////////////////////////////////////////////////
function vc_instagram_photos_func( $atts, $content = null ) { // New function parameter $content is added!
  $title = $link = $css_animation = '';
  
  extract( shortcode_atts( array(
    'title' => __("Instagram Feed",'candidate'),
    'link' => '',
    'custom_link' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation." ";
	$output = '';
	
	if ($link == '') {
			return null;
		}
	$link = trim(vc_value_from_safe($link));
		
		
	$output .= '<div class="widget_instagram_photos  '. $css_class .'">';

			 if (!empty($title)): 
				$output .= '<h3 class="animate-onscroll">'. $title .'</h3>';
			 endif; 
		
			if (!empty($custom_link)): 
			$output  .= '<a class="animate-onscroll btn_follow button" href="'. $custom_link .'" target="blank" ><i class="fa fa-instagram"></i>'. __('Follow on Instagram','candidate') .'</h4></a>';
			endif;
		
		
			$output .= '<div class="wrapper">'. $link .'</div>';
		
	$output .= '</div>';	
		
		

   return $output;
}
add_shortcode('vc_instagram_photos', 'vc_instagram_photos_func');


vc_map( array(
   "name" => __("Instagram photos", 'candidate'),
   "base" => "vc_instagram_photos",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of instagram photos', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Instagram Feed",'candidate'),
         "description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.",'candidate')
        ),
		
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Instagram embed iframe', 'candidate' ),
			'param_name' => 'link',
			'description' => sprintf( esc_html__( 'Visit %s to create.', 'candidate' ), '<a href="http://snapwidget.com" target="_blank">http://snapwidget.com</a>' )
		),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("URL Link", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );




//////////////////////////////vc_team_carousel////////////////////////////////////////////////////////////////////////////////
function vc_team_carousel_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("MEET OUR TEAM",'candidate'),
      'columns_count' => 3,
      'num_items' => 4,
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	
	
    $args = array(  
    'post_type' => 'team_members',  
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	$id = rand(1, 100);

	
	$output  = '<!-- Owl Carousel -->
						<div class="owl-carousel-container block_other stories '. $css_class .'">
							
							<div class="owl-header">
								
								<h3 class="no-margin-top animate-onscroll">'. $title .'</h3>';
								
								
				if(count($myposts) > $columns_count) {			
			$output  .= '<div class="carousel-arrows animate-onscroll">
									<span class="left-arrow"><i class="icons icon-left-dir"></i></span>
									<span class="right-arrow"><i class="icons icon-right-dir"></i></span>
								</div>';
					}	
								
								
								
	$output  .= '</div>
	<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';


	
	
	if(count($myposts) > 0) {
		
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$title1 = get_the_title($post_id);
			$des = get_the_excerpt();
			$des = candidat_the_excerpt_max_charlength_text($des, 15);
			
			$social = get_meta_option('team_social_show_meta_box', $post->ID);
			$share = get_meta_option('team_share_show_meta_box', $post->ID);
			$job = get_meta_option( 'team_job_meta_box', $post->ID );

			$team_member = array(
							'facebook' => get_meta_option('team_facebook_meta_box', $post->ID),
							'twitter' => get_meta_option('team_twitter_meta_box', $post->ID),
							'google' => get_meta_option('team_google_meta_box', $post->ID),
							'youtube' => get_meta_option('team_youtube_meta_box', $post->ID),
							'flickr' => get_meta_option('team_flickr_meta_box', $post->ID),
							'instagram' => get_meta_option('team_instagram_meta_box', $post->ID),
							'linkedin' => get_meta_option('team_linkedin_meta_box', $post->ID),
							'email' => get_meta_option('team_mail_meta_box', $post->ID),
							'twitter-follow' => '#'
						);
						
			
	
	$output .=  '<!-- Owl Item --><div>
				<!-- Blog Post -->
				<div class="blog-post animate-onscroll">';
				
					
		
			$output .= '<div class="team-member animate-onscroll">
									
									'. get_the_post_thumbnail( $post_id, 'team1' ) .'
									
									<div class="team-member-info">
										
										<h2><a href="'. esc_url(get_permalink($post->ID)) .'" class="team-link">'. $title1 .'</a></h2>
										<span class="job">'. $job .'</span>
										
										<div class="team-member-more">
											'. $des .' ';

			if($social != 'hide') {			
										$output .= '<div class="social-media">
												<span class="small-caption">'. __('Get connected','candidate') .':</span>
												<ul class="social-icons">';
													
													
				if(isset($team_member['facebook']) && $team_member['facebook'] !='' ) {
				$output .= '<li class="facebook"><a href="'.$team_member['facebook'].'" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>';
											}
											
				if(isset($team_member['twitter']) && $team_member['twitter'] !='' ) {
				$output .= '<li class="twitter"><a href="'.$team_member['twitter'].'" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>';
											}
											
				if(isset($team_member['google']) && $team_member['google'] !='' ) {
				$output .= '<li class="google"><a href="'.$team_member['google'].'" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>';
											}
											
				if(isset($team_member['youtube']) && $team_member['youtube'] !='' ) {
				$output .= '<li class="youtube"><a href="'.$team_member['youtube'].'" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>';
											}
											
				if(isset($team_member['flickr']) && $team_member['flickr'] != '') {
				$output .= '<li class="flickr"><a href="'.$team_member['flickr'].'" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>';
				}		
	
				if(isset($team_member['instagram']) && $team_member['instagram'] != '') {
				$output .= '<li class="instagram"><a href="'.$team_member['instagram'].'" class="tooltip-ontop" title="Instagram"><i class="icons icon-instagram-1"></i></a></li>';
				}		

				if(isset($team_member['linkedin']) && $team_member['linkedin'] != '') {
				$output .= '<li class="linkedin"><a href="'.$team_member['linkedin'].'" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin-1"></i></a></li>';
				}									
								
				if(isset($team_member['email']) && $team_member['email'] !='' ) {
				$output .= '<li class="email"><a href="'.$team_member['email'].'" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>';
				}			
													
				$output .= '</ul></div>';
				
			}	
		$output .= '</div>
										
									</div>
									
								</div>';


					
	$output .=  '</div><!-- /Blog Post -->
				</div><!-- /Owl Item -->';

	endforeach; 
	}
	
	$output .=  '</div></div>';
 
   return $output;
}
add_shortcode('vc_team_carousel', 'vc_team_carousel_func');

vc_map( array(
   "name" => __("Home block team carousel", 'candidate'),
   "base" => "vc_team_carousel",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of team carousel', 'candidate'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("MEET OUR TEAM",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "num_items",
         "std" => 4,
         "description" => __("Number of items in a carousel.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number columns", 'candidate'),
         "param_name" => "columns_count",
         "std" => 3,
         "description" => __("Number columns in a carousel.",'candidate')
        ),


        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );




//////////////////////////////vc_team///////////////////////////////////////////////
function vc_team_func( $atts, $content = null ) { 
   extract( shortcode_atts( array(
      'title' => __("MEET OUR TEAM",'candidate'),
      'my_product_cat' => '',
      'team_style' => 'style1',
      'num_items' => '8',
      'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation;
	
	
	$output  = '<div class="team_block '. $css_class .'">';

	if( $team_style == 'style1' ) {
	$output .=  do_shortcode('[team title="'. $title .'" number="'. $num_items .'" cat="'. $my_product_cat .'"]');
	}
	
	if( $team_style == 'style2' ) {
	$output .=  do_shortcode('[team3 title="'. $title .'" number="'. $num_items .'" cat="'. $my_product_cat .'"]');
	}
	
	if( $team_style == 'style3' ) {
	$output .=  do_shortcode('[team4 title="'. $title .'" number="'. $num_items .'" cat="'. $my_product_cat .'"]');
	}
	
	
	
	$output .=  '</div>';

   return $output;
}
add_shortcode('vc_team', 'vc_team_func');

vc_map( array(
   "name" => __("Home block Team Members", 'candidate'),
   "base" => "vc_team",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Team', 'candidate'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("MEET OUR TEAM",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		array(
            "type" => "team_category",
            "heading" => __("Select category", 'candidate'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'candidate')
        ),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Team Style', 'candidate' ),
			'param_name' => 'team_style',
			'value' => array(
				__( 'default', 'candidate' ) => 'style1',
				__( '3 column', 'candidate' ) => 'style2',
				__( '4 column', 'candidate' ) => 'style3'
			),
			'description' => __( 'Team Style.', 'candidate' )
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "num_items",
         "std" => 8,
         "description" => __("Number of items in a team.",'candidate')
        ),
		
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );
















//////////////////////////////vc_contact_information////////////////////////////////////////////////////////////////////////////////
function vc_contact_information_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("Our Location",'candidate'),
      'map_address' => '',
      'map_markers' => '',
      'image_markers' => '',
      'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation;
	
	$img_id = preg_replace('/[^\d]/', '', $image_markers);
    $map_thumbnail = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => 'latest-post', 'class' => '' ));
	$map_thumbnail = $map_thumbnail['p_img_large'][0];  

	
	$id = rand(1, 100);
	$output  = '';
	
	$output .=  '<script async defer src="http://maps.google.com/maps/api/js?v=3.19&sensor=false" type="text/javascript" ></script>
	<script  type="text/javascript" >
		(function($) {

		$(document).ready(function(){
			
		function initialize() {
		  var myLatlng = new google.maps.LatLng('. $map_address .');
		  var myLatlng2 = new google.maps.LatLng('. $map_markers .');
		  var image = "'. $map_thumbnail .'";
		  
		  
		  var mapOptions = {
			zoom: 10,
			center: myLatlng,
			mapTypeControl: false,
			scrollwheel: false,
			navigationControl: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };
		  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

		  var marker = new google.maps.Marker({
			  position: myLatlng2,
			  map: map,
			  icon: image
		  });
		}

		google.maps.event.addDomListener(window, "load", initialize);

		});
		
		})(jQuery);
		
    </script>';
	
	$output  .= '<style type="text/css" >
			  body #map-canvas img {
				max-width: none !important;
			  }
			  #map-canvas {
				height: 400px;
				margin: 0px;
				padding: 0px
			  }
    </style>';
	
	$output  .= '<div class="contact-info'.$id.' '. $css_class .'">
				<h3 class="no-margin-top" >'. $title .'</h3>
		<div class="contact-info-map">
		    <div id="map-canvas" ></div>
		</div></div>';
		
	
	

 
   return $output;
}
add_shortcode('vc_contact_information', 'vc_contact_information_func');

vc_map( array(
   "name" => __("Custom Map", 'candidate'),
   "base" => "vc_contact_information",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Google Map block', 'candidate'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Our Location",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Google Map Address (51.451955,-0.055755)", 'candidate'),
         "param_name" => "map_address",
         "value" => "",
         "description" => __("Google Map Address.",'candidate')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Google Map Markers", 'candidate'),
         "param_name" => "map_markers",
         "value" => "",
         "description" => ""
        ),
		
		array(
		  "type" => "attach_image",
		  "heading" => __("Marker image", 'candidate'),
		  "param_name" => "image_markers",
		  "value" => "",
		  "description" => __("Select marker image from media library.", 'candidate')
		),

        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );











//////////////////////////////FlexSlider////////////////////////////////////////////////////////////////////////////////
function flexslider_func( $atts, $content = null ) { // New function parameter $content is added!
   
   extract( shortcode_atts( array(
      'slideshow' => '',
	  'slideshowspeed' => '',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
 if($slideshow != 'true') {
 $slideshow = 'false';
	}
	
	if($slideshowspeed == '') {
 $slideshowspeed = '5000';
	}
	
	
	
	$args = array( 'post_type'=>'slideshow',
				   'orderby' => 'menu_order',
				   'order' => 'ASC',
				   'numberposts' => -1);
				   
	$myposts = get_posts( $args );
	
	$id= rand(1, 100);
	
	$output  = '<div class="flexslider main-flexslider my-flexslider-'. $id .' animate-onscroll  '. $css_class .'">
                        <ul class="slides">';
	$count = 0;
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$count++;
			$title = get_the_title();		
			$content = get_the_content();	
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

			$position = get_meta_option('slideshow_btn_pos_meta_box', $post->ID);
			$post_url = get_meta_option('slideshow_btn_url_meta_box', $post->ID);
			$post_url_title = get_meta_option('slideshow_btn_meta_box', $post->ID);
			
	$output .=  '<li id="main_flex_'. $count .'" style="background: transparent url(' . $post_thumbnail_url . ') no-repeat;" >
								<div class = "slide ' . $position . '">
									'. $content .'';
									if($post_url != '') {
	$output .=  '<a href="'. $post_url .'" class="button big button-arrow">'. $post_url_title .'</a>';
									}
	$output .=  '</div>
                            </li>';
	
	
	endforeach; 	
	
	$output .=  '</ul>
                    </div>';
 
 
	$output .= '<script type="text/javascript">'."\n";
		$output .= '(function($){'."\n";
		$output .= '$(window).load(function() {'."\n";
		$output .= 'var fslider_'.$id.' = $(".main-flexslider.my-flexslider-'.$id.'");'."\n";
		$output .= 'fslider_'.$id.'.flexslider({'."\n";
		$output .= '		animation: "slide",'."\n";
		$output .= '		slideshow: '.$slideshow.','."\n";                
		$output .= '		slideshowSpeed: '.$slideshowspeed."\n";  
		$output .= '	});'."\n";
		
		$output .= '	});'."\n";
		
		$output .= '	})(jQuery);'."\n";
		$output .= '</script>'."\n";
 
 
   return $output;
}
add_shortcode('vc_flexslider', 'flexslider_func');

vc_map( array(
   "name" => __("Home block of Flexslider", 'candidate'),
   "base" => "vc_flexslider",
    "wrapper_class" => "clearfix",
  "category" => __('Content', 'candidate'),
  "description" => __('A block of flexslider', 'candidate'),
   "params" => array(
		array(
            "type" => "dropdown",
            "heading" => __("Slideshow", 'candidate'),
            "param_name" => "slideshow",
            "description" => __('Select slideshow.', 'candidate'),
            "value" => array(__("Yes", 'candidate') => "true", __("No", 'candidate') => "false")
        ),
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow speed", 'candidate'),
         "param_name" => "slideshowspeed",
         "value" => "5000",
         "description" => __("Enter of slideshow speed.",'candidate')
        ),
      array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)
   )
) );







//////////////////////////////vc_mylatest_news///////////////////////////////////////////////
function vc_mylatest_news_func( $atts, $content = null ) { 
   extract( shortcode_atts( array(
      'title' => __("Latest news",'candidate'),
      'my_product_cat' => '',
      'author_show' => '',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	$custom_class = '';
	$my_cat = '';
	$term = get_term( $my_product_cat, 'category' );
	if( !empty($term->slug) ) {
	$my_cat = $term->slug;
	}
	
	
    $args = array(  
    'post_type' => 'post',  
	'category_name' => $my_cat, 
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => 1 
	);  
		   
	$myposts = get_posts( $args );


	$output  = '<div class="latest_news m_bottom_30 '. $css_class .'">
					<h3>'. $title .'</h3>';

	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
	
	$output .=  '<!-- Blog Post -->
						<div class="blog-post big animate-onscroll">
							
							<div class="post-image"><a href="'. get_permalink($post_id) .'">
								'. get_the_post_thumbnail( $post_id, 'portfolio3' ) .'
							</a></div>
							
							<h4 class="post-title"><a href="'. get_permalink($post_id) .'">'. get_the_title($post_id) .'</a></h4>';
				
				
				if($author_show != '_hide') {
				$output .=  '<div class="post-meta">
								<span>'. __('by', 'candidate') .' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></span>
								<span>'. get_the_time('F j, Y g:i a', $post_id) .'</span>
							</div>';
				}			
							
							
	$output .=  '<p>'. candidat_the_excerpt_max_charlength_text(get_the_excerpt(), 32) .'</p>
							
							<a href="'. get_permalink($post_id) .'" class="button read-more-button big button-arrow">'. get_option('sense_more_text') .'</a>
							
						</div>
						<!-- /Blog Post -->';
	
	endforeach; 	
	
	$output .=  '</div>';

   return $output;
}
add_shortcode('vc_mylatest_news', 'vc_mylatest_news_func');

vc_map( array(
   "name" => __("Home block Latest News", 'candidate'),
   "base" => "vc_mylatest_news",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Latest News', 'candidate'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Latest news",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
            "type" => "post_category",
            "heading" => __("Select category", 'candidate'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'candidate')
        ),
	   
	    array(
		  "type" => "dropdown",
		  "heading" => __("Author Show", 'candidate'),
		  "param_name" => "author_show",
		  "description" => __("Select show or hide author info.", 'candidate'),
		  'value' => $show_arr
		  
		),
	   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );




//////////////////////////////vc_mylatest_products////////////////////////////////////////////////////////////////////////////////
function vc_mylatest_products_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("Our Causes",'candidate'),
      'columns' => 3,
      'num_items' => 4,
      'title_color' => '',
      'my_product_cat' => '',
      'orderby' => '',
      'order' => 'desc',
      'my_style' => 'mystyle1',
      'rating_show' => '_show',
      'description_show' => '_show',
      'css_animation' => ''
   ), $atts ) );
 
    global $woocommerce, $woocommerce_loop;
    if (!is_object($woocommerce) || !is_object($woocommerce->query)) return;
	$woocommerce_loop['columns'] = 12;
	
	
	$title_color1 = '';
    if($title_color != '') {
	   $title_color1 = ' style="color:'.$title_color.' !important" ';
	}
	
	
	
	
	$my_cat = '';
	$term = get_term( $my_product_cat, 'product_cat' );
	if( !empty($term->slug) ) {
	$my_cat = $term->slug;
	}
	
	
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	$custom_class = '';
	
	// Meta query
		$meta_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
		$meta_query[] = $woocommerce->query->stock_status_meta_query();
		$meta_query = array_filter($meta_query);
	
	$query = array(
			'post_type' 	 => 'product',
			'product_cat' => $my_cat, 
			'post_status' 	 => 'publish',
			'ignore_sticky_posts'	=> 1,
			'order'   		 => $order == 'asc' ? 'asc' : 'desc',
			'meta_query' 	 => $meta_query,
			'posts_per_page' => $num_items
		);
	
    if ( $orderby != '' ) {
			switch ( $orderby ) {
				case 'price' :
					$query['meta_key'] = '_price';
					$query['orderby']  = 'meta_value_num';
					break;
				case 'rand' :
					$query['orderby']  = 'rand';
					break;
				case 'sales' :
					$query['meta_key'] = 'total_sales';
					$query['orderby']  = 'meta_value_num';
					break;
				default :
					$query['orderby']  = 'date';
					break;
			}
		} else {
			$query['orderby'] = get_option('woocommerce_default_catalog_orderby');
		}
	
	$products = new WP_Query( $query );
	$id = rand(1, 100);
	$slideshow_auto = 'false';
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	ob_start();
	
	if ( $products->have_posts() ) { ?>	
	
	<div class="owl-carousel-container block_latest_products  description<?php echo $description_show;  ?> rating<?php echo $rating_show;  ?>  <?php echo $css_class;  ?>">					
		<div class="owl-header"><h3 class="latest_products_title" <?php echo $title_color1; ?> ><?php echo $title ?></h3>
			<?php  if($products->found_posts > $columns) {	?>		
			<div class="carousel-arrows animate-onscroll"><span class="left-arrow"><i class="icons icon-left-dir"></i></span><span class="right-arrow"><i class="icons icon-right-dir"></i></span></div>
			<?php } ?>		
		</div>
		<div class="owl-carousel custom_latest_products owl-carousel<?php echo $id; ?>  custom_latest_products_<?php echo $my_style; ?> " data-max-items="<?php echo $columns; ?>">

		
		
		
		
		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
		
		
		<?php 
		if ($my_style ==  'mystyle1') {
			wc_get_template_part( 'content', 'productowl' ); 
		} else {
			wc_get_template_part( 'content', 'productowl2' ); 
		}
		?>
		
		
		<?php endwhile;  ?>
		
		
		
		
		</div>
	</div>
	<?php  }
	woocommerce_reset_loop();
	wp_reset_postdata();
			
 return ob_get_clean();
 
}
add_shortcode('vc_mylatest_products', 'vc_mylatest_products_func');

vc_map( array(
   "name" => __("Home block latest products", 'candidate'),
   "base" => "vc_mylatest_products",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of latest products', 'candidate'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Our Causes",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Title Color', 'candidate' ),
			'param_name' => 'title_color',
			'description' => __( 'Select title color.', 'candidate' ),
		),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "num_items",
         "std" => 4,
         "description" => __("Number of items in a carousel.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number columns", 'candidate'),
         "param_name" => "columns",
         "std" => 3,
         "description" => __("Number columns in a carousel.",'candidate')
        ),

		array(
            "type" => "my_category",
            "heading" => __("Select category", 'candidate'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'candidate')
        ),
		
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'candidate' ),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__('Default', 'candidate' ) => '',
				esc_html__('Date', 'candidate' ) => 'date',
				esc_html__('Price', 'candidate' ) => 'price',
				esc_html__('Random', 'candidate' ) => 'rand',
				esc_html__('Sales', 'candidate' ) => 'sales'
			),
			'description' => esc_html__( 'Here you can choose how to display the products', 'candidate' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Sorting Order', 'candidate' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'ASC', 'candidate' ) => 'asc',
				esc_html__( 'DESC', 'candidate' ) => 'desc'
			),
			'description' => esc_html__( 'Here you can choose how to display the products', 'candidate' )
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Rating Show", 'candidate'),
		  "param_name" => "rating_show",
		  "description" => __("Select show or hide rating.", 'candidate'),
		  'value' => $show_arr
		  
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Description Show", 'candidate'),
		  "param_name" => "description_show",
		  "description" => __("Select show or hide description.", 'candidate'),
		  'value' => $show_arr
		  
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Style", 'candidate'),
		  "param_name" => "my_style",
		  "admin_label" => true,
		  "value" => array(__("Style1", 'candidate') => "mystyle1", __("Style2", 'candidate') => "mystyle2"),
		  "description" => __("Select style type.", 'candidate')
		),
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );





//////////////////////////////vc_mylatest_other stories////////////////////////////////////////////////////////////////////////////////
function vc_mylatest_post_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("Other Stories",'candidate'),
      'video_thumbnails' => '',
      'my_product_cat' => '',
      'columns_count' => 3,
      'num_items' => 4,
      'author_show' => '',
      'info_show' => '',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	$custom_class = '';
	$my_cat = '';
	$term = get_term( $my_product_cat, 'category' );
	if( !empty($term->slug) ) {
	$my_cat = $term->slug;
	}
	
	//$num_items =  $num_items + 1;
	
	
    $args = array(  
    'post_type' => 'post',  
	'category_name' => $my_cat, 
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	
	
	
	$id = rand(1, 100);
	
	$slideshow_auto = 'false';
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	$output  = '<!-- Owl Carousel -->
						<div class="owl-carousel-container block_other stories '. $css_class .'">
							
							<div class="owl-header">
								
								<h3 class="no-margin-top animate-onscroll">'. $title .'</h3>';
								
								
				if(count($myposts) > $columns_count) {			
			$output  .= '<div class="carousel-arrows animate-onscroll">
									<span class="left-arrow"><i class="icons icon-left-dir"></i></span>
									<span class="right-arrow"><i class="icons icon-right-dir"></i></span>
								</div>';
					}	
								
								
								
	$output  .= '</div>
	<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';


	
	
	if(count($myposts) > 0) {
		
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			
			$format = 'standard';
			if(get_post_meta($post->ID,'meta_blogposttype',true) && get_post_meta($post->ID,'meta_blogposttype',true) !=''){
			$format = get_post_meta($post->ID,'meta_blogposttype',true); 
			}
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

	
	$output .=  '<!-- Owl Item -->
				<div>
					
					<!-- Blog Post -->
					<div class="blog-post animate-onscroll">';
						
					if ($video_thumbnails == 'yes' && $format == 'video') {	
					
				$output .=  '<div class="post-image">';
						
						
						
					 if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'html5' ) { 
						$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "latest-post" ); 
				$output .=  '<video width="100%" height="177"  id="home_video" class="entry-video video-js vjs-default-skin" poster="'. esc_url($url[0]) .'" data-aspect-ratio="2.41" data-setup="{}" controls>
						<source src="'. esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)) .'" type="video/mp4"/>
						<source src="'. esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)) .'" type="video/webm"/>
						<source src="'. esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)) .'" type="video/ogg"/>
						</video>';

					} 


					if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'vimeo' && ! post_password_required() ) { 
				$output .=  '<iframe src="http://player.vimeo.com/video/'.  get_post_meta($post->ID,'meta_blogvideourl',true) .'?js_api=1&amp;js_onLoad=player'.  get_post_meta($post->ID,'meta_blogvideourl',true) .'_1798970533.player.moogaloopLoaded" width="100%" height="177"  allowFullScreen></iframe>';
					} 


					if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'youtube' && ! post_password_required() ) {
				$output .=  '<iframe width="100%" height="177" src="http://www.youtube.com/embed/'. get_post_meta($post->ID,'meta_blogvideourl',true) .'" allowfullscreen></iframe>';
					} 	

						
						
						
						
						
						
					$output .=  '</div>';	
						
					} else {
						
				$output .=  '<div class="post-image"><a href="'. get_permalink($post_id) .'">
							'. get_the_post_thumbnail( $post_id, 'latest-post' ) .'
						</a></div>';		
						
					}
	
	$output .=  '<h4 class="post-title"><a href="'. get_permalink($post_id) .'">'. get_the_title($post_id) .'</a></h4>';
						
				if($author_show != '_hide') {		
				$output .=  '<div class="post-meta">
							<span>'. __('by', 'candidate') .' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></span>
							<span>'. get_the_time('F j, Y g:i a', $post_id) .'</span>
						</div>';
				}		
					

					
					
				if($info_show != '_hide') {		
	$output .=  '<p class="post-description" >'. candidat_the_excerpt_max_charlength_text(get_the_excerpt($post_id), 12) .'</p>
						
						<a href="'. get_permalink($post_id) .'" class="button read-more-button big button-arrow">'. get_option('sense_more_text') .'</a>';
				}	
						
						
						
	$output .=  '</div>
					<!-- /Blog Post -->
					
				</div>
				<!-- /Owl Item -->';

	endforeach; 
	}
	
	$output .=  '</div></div>';
 
   return $output;
}
add_shortcode('vc_mylatest_post', 'vc_mylatest_post_func');

vc_map( array(
   "name" => __("Home block Other Stories", 'candidate'),
   "base" => "vc_mylatest_post",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Other Stories', 'candidate'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Other Stories",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
            "type" => "post_category",
            "heading" => __("Select category", 'candidate'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'candidate')
        ),
   
		array(
			'type' => 'checkbox',
			'heading' => __( 'Video Thumbnails', 'candidate' ),
			'param_name' => 'video_thumbnails',
			'description' => __( 'If selected, show Video Thumbnails.', 'candidate' ),
			'value' => array( __( 'Yes, please', 'candidate' ) => 'yes' )
		),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "num_items",
         "std" => 4,
         "description" => __("Number of items in a carousel.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number columns", 'candidate'),
         "param_name" => "columns_count",
         "std" => 3,
         "description" => __("Number columns in a carousel.",'candidate')
        ),
   
		array(
		  "type" => "dropdown",
		  "heading" => __("Author Show", 'candidate'),
		  "param_name" => "author_show",
		  "description" => __("Select show or hide author info.", 'candidate'),
		  'value' => $show_arr
		  
		),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("Text Show", 'candidate'),
		  "param_name" => "info_show",
		  "description" => __("Select show or hide text.", 'candidate'),
		  'value' => $show_arr
		  
		),

        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );










//////////////////////////////vc_mylatest_portfolio////////////////////////////////////////////////////////////////////////////////
function vc_mylatest_portfolio_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("Portfolio",'candidate'),
      'video_thumbnails' => '',
      'my_product_cat' => '',
      'columns_count' => 3,
      'num_items' => 4,
      'author_show' => '_hide',
      'info_show' => '_hide',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	$custom_class = '';
	$my_cat = '';
	$term = get_term( $my_product_cat, 'category' );
	if( !empty($term->slug) ) {
	$my_cat = $term->slug;
	}
	
	//$num_items =  $num_items + 1;
	
	
    $args = array(  
    'post_type' => 'portfolio_post',  
	'portfolio-category' => $my_cat, 
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	
	
	
	$id = rand(1, 100);
	
	$slideshow_auto = 'false';
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	$output  = '<!-- Owl Carousel -->
						<div class="owl-carousel-container block_other stories '. $css_class .'">
							
							<div class="owl-header">
								
								<h3 class="no-margin-top animate-onscroll">'. $title .'</h3>';
								
								
				if(count($myposts) > $columns_count) {			
			$output  .= '<div class="carousel-arrows animate-onscroll">
									<span class="left-arrow"><i class="icons icon-left-dir"></i></span>
									<span class="right-arrow"><i class="icons icon-right-dir"></i></span>
								</div>';
					}	
								
								
								
	$output  .= '</div>
	<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';


	
	
	if(count($myposts) > 0) {
		
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			
			$format = 'standard';
			if(get_post_meta($post->ID,'meta_blogposttype',true) && get_post_meta($post->ID,'meta_blogposttype',true) !=''){
			$format = get_post_meta($post->ID,'meta_blogposttype',true); 
			}
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

	
	$output .=  '<div><div class="blog-post animate-onscroll">';
						
			
						
	$output .=  '<div class="post-image"><a href="'. get_permalink($post_id) .'">
							'. get_the_post_thumbnail( $post_id, 'post-blog' ) .'
						</a></div>';		
						
					
	
	$output .=  '<h4 class="post-title"><a href="'. get_permalink($post_id) .'">'. get_the_title($post_id) .'</a></h4>';
						
				if($author_show != '_hide') {		
				$output .=  '<div class="post-meta">
							<span>'. __('by', 'candidate') .' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></span>
							<span>'. get_the_time('F j, Y g:i a', $post_id) .'</span>
						</div>';
				}		
					

					
					
				if($info_show != '_hide') {		
	$output .=  '<p class="post-description" >'. candidat_the_excerpt_max_charlength_text(get_the_excerpt($post_id), 12) .'</p>
						
						<a href="'. get_permalink($post_id) .'" class="button read-more-button big button-arrow">'. get_option('sense_more_text') .'</a>';
				}	
						
						
						
	$output .=  '</div>
					<!-- /Blog Post -->
					
				</div>
				<!-- /Owl Item -->';

	endforeach; 
	}
	
	$output .=  '</div></div>';
 
   return $output;
}
add_shortcode('vc_mylatest_portfolio', 'vc_mylatest_portfolio_func');

vc_map( array(
   "name" => __("Home block Portfolio", 'candidate'),
   "base" => "vc_mylatest_portfolio",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Portfolio', 'candidate'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Portfolio",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
            "type" => "portfolio_category",
            "heading" => __("Select category", 'candidate'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'candidate')
        ),

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "num_items",
         "std" => 4,
         "description" => __("Number of items in a carousel.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number columns", 'candidate'),
         "param_name" => "columns_count",
         "std" => 3,
         "description" => __("Number columns in a carousel.",'candidate')
        ),
   
		

        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );





//////////////////////////////vc_mylatest_campaign////////////////////////////////////////////////////////////////////////////////
function vc_mylatest_campaign_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'num_items' => '4',
      'my_style' => 'mystyle1',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $my_style.' ';
	$css_class .= $css_animation;
	$custom_class = '';
	
    $args = array(  
    'post_type' => 'campaign',  
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );


	if($my_style == 'mystyle1') {
	$output  = '<!-- Banner Rotator -->
						<div class="banner-rotator '. $css_class .'">
							
							<div class="flexslider banner-rotator-flexslider">
								
								<ul class="slides">';

	$count=0;
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			//$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'post-full'); 
			
			$title2 = get_meta_option('campaign_text_meta_box', $post->ID);
			
			$btn_title = get_meta_option('campaign_btn_meta_box', $post->ID);
			$btn_url = get_meta_option('campaign_btn_url_meta_box', $post->ID);
			
			$campaign_date = get_meta_option('campaign_date_meta_box', $post->ID);
			
			
			
	$count++;
	$output .=  '<li id="flex_rotator_'. $count .'" style="background: transparent url(' . $post_thumbnail_url[0] . ') center center no-repeat; background-size: cover;" >
					<div class="banner-rotator-content">
						<h5>'. get_the_title($post_id) .'</h5>
						<h2>'.$title2  .'</h2>
						<span class="date campaign-date">'. $campaign_date .'</span>
						<a href="'. $btn_url .'" class="button big button-arrow">'. $btn_title .'</a>
					</div>
				</li>';

	endforeach; 	
	
	$output .=  '</div></div>';
	} else {
		
		$output  = '<!-- Banner Rotator -->
						<div class="banner-rotator '. $css_class .'">
							
							<div class="flexslider banner-rotator-flexslider">
								
								<ul class="slides">';

	$count=0;
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			//$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'post-full'); 
			
			$title2 = get_meta_option('campaign_text_meta_box', $post->ID);
			
			$btn_title = get_meta_option('campaign_btn_meta_box', $post->ID);
			$btn_url = get_meta_option('campaign_btn_url_meta_box', $post->ID);
			
			$campaign_date = get_meta_option('campaign_date_meta_box', $post->ID);
			
			
			
	$count++;
	$output .=  '<li id="flex_rotator_'. $count .'" style="background: transparent url(' . $post_thumbnail_url[0] . ') center center no-repeat; background-size: cover;" >
					
					
					<div class="container"><div class="banner-rotator-content">
						<h5>'. get_the_title($post_id) .'</h5>
						<h2>'.$title2  .'</h2>
						<span class="date campaign-date">'. $campaign_date .'</span>
						<a href="'. $btn_url .'" class="button big button-arrow">'. $btn_title .'</a>
					</div></div>
					
					
				</li>';

	endforeach; 	
	
	$output .=  '</div></div>';
		
	}
	
	
	
 
   return $output;
}
add_shortcode('vc_mylatest_campaign', 'vc_mylatest_campaign_func');

vc_map( array(
   "name" => __("Home block Campaign", 'candidate'),
   "base" => "vc_mylatest_campaign",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Campaign', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'candidate')
        ),
   
   
		array(
		  "type" => "dropdown",
		  "heading" => __("Style", 'candidate'),
		  "param_name" => "my_style",
		  "admin_label" => true,
		  "value" => array(__("Style1", 'candidate') => "mystyle1", __("Style2", 'candidate') => "mystyle2"),
		  "description" => __("Select style type.", 'candidate')
		),
   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );






//////////////////////////////vc_banner////////////////////////////////////////////////////////////////////////////////
function vc_banner_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Title Banner",'candidate'),
    'custom_color' => '',
    'background_style' => '',
    'text_banner' => '',
	'custom_link' => '',
	'custom_links_target' => '',
	'icon' => 'icon-docs',
	'my_style' => '',
    'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$custom_class = '';
	
	$custom_color1 = '';
   if($background_style == 'custom') {
	   $custom_color1 = ' style=background:'.$custom_color.' ';
	}

	$output  = '<div class="banner-wrapper '. $my_style .' ">
					<a class="banner '. $css_class .'" href="'. $custom_link .'" target="'. $custom_links_target .'"  '. $custom_color1 .' >
						<i class="icons '. $icon .'"></i>
						<h4>'. $title .'</h4>
						<p>'. $text_banner .'</p>
					</a>
				</div>';

   return $output;
}
add_shortcode('vc_banner', 'vc_banner_func');

vc_map( array(
   "name" => __("Home block Banner", 'candidate'),
   "base" => "vc_banner",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Banner', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Title Banner",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Style', 'candidate' ),
			'param_name' => 'background_style',
			'value' => array(
				__( 'Default', 'candidate' ) => '',
				__( 'Custom', 'candidate' ) => 'custom',
			),
			'description' => __( 'Background style.', 'candidate' )
		),
		
		
		
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Custom Background Color', 'candidate' ),
			'param_name' => 'custom_color',
			'description' => __( 'Select custom color.', 'candidate' ),
			'dependency' => array(
				'element' => 'background_style',
				'value' => 'custom'
			),
		),
		

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Banner", 'candidate'),
         "param_name" => "text_banner",
         "value" => "Text Banner",
         "description" => __("Number of items in a carousel.",'candidate')
        ),
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'candidate'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'candidate'),
            'value' => $icon_arr
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("URL Link", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
            "type" => "dropdown",
            "heading" => __("Target Link", 'candidate'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'candidate'),
            'value' => $target_arr
        ),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("Style", 'candidate'),
		  "param_name" => "my_style",
		  "admin_label" => true,
		  "value" => array(__("Style1", 'candidate') => "mystyle1", __("Style2", 'candidate') => "mystyle2"),
		  "description" => __("Select style type.", 'candidate')
		),
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom",'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );




//////////////////////////////vc_donate////////////////////////////////////////////////////////////////////////////////
function vc_banner_donate_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Make a <strong>quick donation</strong> here",'candidate'),
    'text_amount1' => '5',
    'text_amount2' => '25',
    'text_amount3' => '100',
    'url_amount' => '',
    'org_donate' => '',
    'currency_amount' => '',
    'css_animation' => ''
   ), $atts ) );
 


	if ( empty( $currency_amount ) ) {
		$currency_amount = 'USD';
	}
 
 	$currency_code_symbol = homeshop_get_woocommerce_currency_symbol( $currency_amount );	 
 
 
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$custom_class = '';
	
   

	
	$output  = '<div class="banner-wrapper">
					<div class="banner donate-banner '. $css_class .'">
					
						<h5>'. $title .'</h5>';
						
						
		$output  .= '<form name="_xclick" id="sd_paypalform"  action="https://www.paypal.com/uk/cgi-bin/webscr" method="post">';
						if($text_amount1 != '') {
							$output  .= '<input value="' . $text_amount1 . '" class="other_amt sd_object sd_usermod sd_radio" id="donate-amount-1" type="radio" name="sd_radio" checked>
							<label for="donate-amount-1">'. $currency_code_symbol .''. $text_amount1 .'</label>';
						}
						if($text_amount2 != '') {
							$output  .= '<input value="' . $text_amount2 . '" class="sd_object sd_usermod sd_radio" id="donate-amount-2" type="radio" name="sd_radio">
							<label for="donate-amount-2">'. $currency_code_symbol .''. $text_amount2 .'</label>';
						}	
						if($text_amount3 != '') {
							$output  .= '<input value="' . $text_amount3 . '" class="sd_object sd_usermod sd_radio" id="donate-amount-3" type="radio" name="sd_radio">
							<label for="donate-amount-3">'. $currency_code_symbol .''. $text_amount3 .'</label>';
						}	
							
							
							
			$output  .= '<input type="hidden" name="cmd" value="_donations" id="cmd"/>
							<input type="hidden" name="no_shipping" value="2"/>
							<input type="hidden" name="no_note" value="1"/>
							<input type="hidden" name="tax" value="0"/>
							<input type="hidden" name="business" value="' . esc_html( $url_amount ) . '" class="sd_object paypal_object" />
							<input type="hidden" name="bn" value="' . esc_html( $org_donate ) . '" class="sd_object paypal_object"/>
							<input type="hidden" name="currency_code" value="' . esc_html( $currency_amount ) . '" class="sd_object paypal_object"/>
							
							
							<input type="submit" name="submit"  value="' . __( "Donate", 'candidate' ) . '" class="sd_object" id="sd_submit"  >
							
							
						</form>';	
						
						
						
	$output  .= '</div>';

	//		Javascript
	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function($){
				
				$("#sd_paypalform #sd_submit").before(\'<input type="hidden" name="amount" value="\' + $(".other_amt").val() + \'" class="sd_object paypal_object" id="paypal_amount" />\');
				
				$(".sd_object.sd_usermod").change(function() {
					$("#sd_paypalform #paypal_amount").val($(this).val()); 
				});';

	$output .= '});
		</script>';			
	
	$output  .= '</div>';

	
   return $output;
}
add_shortcode('vc_banner_donate', 'vc_banner_donate_func');





$homeshop_currency_code_options = homeshop_get_woocommerce_currencies();
foreach ( $homeshop_currency_code_options as $code => $name ) {
	$homeshop_currency_code_options[ $code ] = $name . " (" . $code . ")";
}	
$homeshop_currency_code_options = array_flip($homeshop_currency_code_options);




vc_map( array(
   "name" => __("Home block Banner Donate", 'candidate'),
   "base" => "vc_banner_donate",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Banner Donate', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Make a <strong>quick donation</strong> here",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Amount1", 'candidate'),
         "param_name" => "text_amount1",
         "value" => "5",
         "description" => __("Text Amount1.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Amount2", 'candidate'),
         "param_name" => "text_amount2",
         "value" => "25",
         "description" => __("Text Amount2.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Amount3", 'candidate'),
         "param_name" => "text_amount3",
         "value" => "100",
         "description" => __("Text Amount3.",'candidate')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("PayPal Email Address", 'candidate'),
         "param_name" => "url_amount",
         "value" => "",
         "description" => __("PayPal Email Address.",'candidate')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Organization", 'candidate'),
         "param_name" => "org_donate",
         "value" => "",
         "description" => __("PayPal Email Address.",'candidate')
        ),
		
		// array(
		  // "type" => "dropdown",
		  // "heading" => __("Currency Amount", "js_composer"),
		  // "param_name" => "currency_amount",
		  // "admin_label" => true,
		  // "value" => array(__("USD", "js_composer") => 'USD', __("CHF", "js_composer") => "CHF", __("SEK", "js_composer") => "SEK", __("SGD", "js_composer") => "SGD", __("GBP", "js_composer") => "GBP", __("PLN", "js_composer") => "PLN", __("NZD", "js_composer") => "NZD", __("NOK", "js_composer") => "NOK", __("JPY", "js_composer") => "JPY", __("HUF", "js_composer") => "HUF", __("EUR", "js_composer") => "EUR", __("DKK", "js_composer") => "DKK", __("CZK", "js_composer") => "CZK", __("CAD", "js_composer") => "CAD", __("AUD", "js_composer") => "AUD"),
		  // "description" => __("Select Currency Amount.", "js_composer")
		// ),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("Currency Amount", 'candidate'),
		  "param_name" => "currency_amount",
		  "admin_label" => true,
		  "value" => $homeshop_currency_code_options,
		  "description" => __("Select Currency Amount.", 'candidate')
		),
		
		
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );





//////////////////////////////vc_social_media////////////////////////////////////////////////////////////////////////////////
function vc_social_media1_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Get connected",'candidate'),
	'custom_link1' => '',
	'custom_link2' => '',
	'custom_link3' => '',
	'custom_link4' => '',
	'custom_link5' => '',
	'custom_link6' => '',
	'custom_link7' => '',
	'social_show' => '',
	'custom_links_target' => '',
    'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$custom_class = '';
	

	$output  = '<div class="social-media '. $css_class .'">
					<span class="small-caption">'. $title .':</span>
					<ul class="social-icons">';
					if($custom_link1 != '' && $custom_link1 != '#' ) {
	$output  .= '<li class="facebook"><a href="'. $custom_link1 .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>';
					}	
					if($custom_link2 != '' && $custom_link2 != '#' ) {	
	$output  .= '<li class="twitter"><a href="'. $custom_link2 .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>';
					}	
					if($custom_link3 != '' && $custom_link3 != '#' ) {	
	$output  .= '<li class="google"><a href="'. $custom_link3 .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>';
					}	
					if($custom_link4 != '' && $custom_link4 != '#' ) {	
	$output  .= '<li class="youtube"><a href="'. $custom_link4 .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>';
					}	
					if($custom_link5 != '' && $custom_link5 != '#' ) {	
	$output  .= '<li class="flickr"><a href="'. $custom_link5 .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>';
					}	
					if($custom_link6 != '' && $custom_link6 != '#' ) {	
	$output  .= '<li class="email"><a href="'. $custom_link6 .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>';
					}	
					if($custom_link7 != '' && $custom_link7 != '#' ) {	
	$output  .= '<li class="linkedin"><a href="'. $custom_link7 .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin"></i></a></li>';
					}		
	$output  .= '</ul>';
					
					if($social_show != '_hide' ) {	
	$output  .= '<ul class="social-buttons">
						<li>
							<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35" style="border:none; overflow:hidden; height:21px; padding-top:1px; width:50px;"></iframe>
						</li>
						<li class="facebook-share">
							<div class="fb-share-button" data-href="'. get_permalink() .'" data-type="button_count"></div>
						</li>
						<li class="twitter-share">
							<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
						</li>
					</ul>';
					}
	$output  .= '</div>';
	

   return $output;
}
add_shortcode('vc_social_media1', 'vc_social_media1_func');


vc_map( array(
   "name" => __("Home block Social Media", 'candidate'),
   "base" => "vc_social_media1",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Social Media', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Get connected",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Facebook URL Link", 'candidate'),
         "param_name" => "custom_link1",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Twitter URL Link", 'candidate'),
         "param_name" => "custom_link2",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Google Plus URL Link", 'candidate'),
         "param_name" => "custom_link3",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Youtube URL Link", 'candidate'),
         "param_name" => "custom_link4",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Flickr URL Link", 'candidate'),
         "param_name" => "custom_link5",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Email URL Link", 'candidate'),
         "param_name" => "custom_link6",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("LinkedIn URL Link", 'candidate'),
         "param_name" => "custom_link7",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Link", 'candidate'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'candidate'),
            'value' => $target_arr
        ),
        array(
		  "type" => "dropdown",
		  "heading" => __("Social Show", 'candidate'),
		  "param_name" => "social_show",
		  "description" => __("Select show or hide social buttons.", 'candidate'),
		  'value' => $show_arr
		  
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );








//////////////////////////////vc_featured-video////////////////////////////////////////////////////////////////////////////////
function vc_featured_video_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Featured Video",'candidate'),
	'video_link' => '',
	'custom_link' => '',
	'custom_link_text' => '',
	'custom_links_target' => '',
	'type_video' => 'youtube',
    'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$custom_class = '';
	

	$output  = '<!-- Featured Video -->
						<div class="sidebar-box white featured-video '. $css_class .'">
							<h3>'. $title .'</h3>';
							
					if($type_video == 'youtube') {
		$output  .= '<iframe width="560" height="315" src="//www.youtube.com/embed/'. $video_link .'?wmode=transparent" allowfullscreen></iframe>';
					}		
					if($type_video == 'vimeo') {
		$output  .= '<iframe width="560" height="315" src="http://player.vimeo.com/video/'. $video_link .'?js_api=1&amp;js_onLoad=player'. $video_link .'_1798970533.player.moogaloopLoaded" allowfullscreen></iframe>';
					}			
					if($type_video == 'html5') {
		$output  .= '<video width="100%" height="115"  id="home_video_featured" class="entry-video video-js vjs-default-skin" poster="" data-aspect-ratio="2.41" data-setup="{}" controls>
		<source src="'. $video_link .'.mp4" type="video/mp4"/>
	<source src="'. $video_link .'.webm" type="video/webm"/>
	<source src="'. $video_link .'.ogg" type="video/ogg"/></video>';
					}			
							
	$output  .= '<a href="'. $custom_link .'" target="'. $custom_links_target .'" class="button transparent button-arrow">'. $custom_link_text .'</a>
	
						</div>
						<!-- /Featured Video -->';
	

   return $output;
}
add_shortcode('vc_featured_video', 'vc_featured_video_func');


vc_map( array(
   "name" => __("Home block Featured Video", 'candidate'),
   "base" => "vc_featured_video",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Featured Video', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Featured Video",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Video URL ID", 'candidate'),
         "param_name" => "video_link",
         "value" => "",
         "description" => __("URL Video.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("More Videos URL", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("More Videos Text", 'candidate'),
         "param_name" => "custom_link_text",
         "value" => "",
         "description" => __("Text Link.",'candidate')
        ),		
		array(
            "type" => "dropdown",
            "heading" => __("Target Link", 'candidate'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'candidate'),
            'value' => $target_arr
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Type Video", 'candidate'),
            "param_name" => "type_video",
            "description" => __('Select type video.', 'candidate'),
            "value" => array(__("Youtube", 'candidate') => "youtube", __("Vimeo", 'candidate') => "vimeo", __("HTML5", 'candidate') => "html5")
        ),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );













//////////////////////////////vc_latest_sermons////////////////////////////////////////////////////////////////////////////////
function vc_latest_sermons_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Latest Sermons",'candidate'),
    'limit' => '2',
	'custom_link' => '',
	'custom_link_text' => 'MORE SERMONS',
	'title_style' => 'h2',
	'custom_links_target' => '',
    'css_animation' => ''
   ), $atts ) );

	$css_class =  '';
	$css_class .= $css_animation;
	
	$args = array(  
    'post_type' => 'ctc_sermon',  
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => $limit  
	);  
	
	$myposts = get_posts( $args );
	$counter = 0;
	$output  = '<div class="sidebar-box latest_sermons_box style2'. $css_class .'">';
	$output  .= "<{$title_style} class='box-title'>". esc_html($title) ."</{$title_style}>";
	$output  .= '<div class="row">';
		
		foreach( $myposts as $post ) :  setup_postdata($post);
			setup_postdata( $post );
			$event_id = $post->ID;
			$counter++;
			$post_thumbnail_id = get_post_thumbnail_id($event_id);
			$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'latest-post'); 
		
			$sermonvideo = get_post_meta( $event_id, '_ctc_sermon_video', true );
		    $audio_value = get_post_meta( $event_id, '_ctc_sermon_audio', true );
		    $pdf_value = get_post_meta( $event_id, '_ctc_sermon_pdf', true );
		
		
		
			if($counter == 1) {
				
				$output  .= '<div class="sermon_first col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="blog-post">	
					<div class="post-image">
						<a href="'. get_permalink($event_id) .'">
						<img src="' . $post_thumbnail_url[0] . '" alt="">
						</a>
					</div>
					<h4 class="post-title"><a href="'. get_permalink($event_id) .'">'. get_the_title($event_id) .'</a></h4>
					<div class="post-meta m_bottom_25">
						<span>'. get_the_time('F j, Y g:i a', $event_id) .' ·'. __("pastor", 'candidate') .'</span>
						<span><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></span>
					</div>
					<div class="post-action">';
						
						if($sermonvideo != '') {
						$output  .= '<div class="action-icon">
							<a href="'. $sermonvideo .'" target="_blank" > <span><i class="icon-videocam"></i></span> </a>
						</div>';
						}
						if($audio_value != '') {
						$output  .= '<div class="action-icon">
							<a href="'. $audio_value .'"  target="_blank"  > <span><i class="icon-headphones"></i></span> </a>
						</div>';
						}
						if($pdf_value != '') {
						$output  .= '<div class="action-icon">
							<a href="'. $pdf_value .'" target="_blank" > <span><i class="icon-download"></i></span> </a>
						</div>';
						}
						
				$output  .= '<div class="action-icon">
							<a href="'. get_permalink($event_id) .'"> <span><i class="icon-book"></i></span> </a>
						</div>
					</div>
				</div>	
				</div><div class="sermon_last col-lg-6 col-md-6 col-sm-12 col-xs-12"><ul class="upcoming-events var2">';
			} else {
			
			$output  .= '<li>
			<div class="blog-post">						
				<a href="'. get_permalink($event_id) .'"><h4 class="post-title no-margin-top">'. get_the_title($event_id) .'</h4></a>
				<div class="post-meta">
					<span>'. get_the_time('F j, Y g:i a', $event_id) .' ·'. __("pastor", 'candidate') .'</span>
					<span><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></span>
				</div>
				<div class="post-action var2">';
					if($sermonvideo != '') {
					$output  .= '<div class="action-icon transparent">
						<a href="'. $sermonvideo .'" target="_blank"  > <span><i class="icon-videocam"></i></span> </a> 
					</div>';
					}
					if($audio_value != '') {
					$output  .= '<div class="action-icon transparent">
						<a href="'. $audio_value .'" target="_blank" > <span><i class="icon-headphones"></i></span> </a> 
					</div>';
					}
					if($pdf_value != '') {
					$output  .= '<div class="action-icon transparent">
						<a href="'. $pdf_value .'" target="_blank" > <span><i class="icon-download"></i></span> </a> 
					</div>';
					}
			$output  .= '<div class="action-icon transparent">
						<a href="'. get_permalink($event_id) .'"> <span><i class="icon-book"></i></span> </a>
					</div>
				</div>
			</div>
			</li><!-- /sermon -->';		
			}
			
			
		endforeach; 	
	
	wp_reset_query();
	
	$output  .= '</ul><a href="'. $custom_link .'" target="'. $custom_links_target .'"  class="no-margin-top button transparent button-arrow">'. $custom_link_text .'</a></div></div></div><!-- /sermons -->';
	
   return $output;
}
add_shortcode('vc_latest_sermons', 'vc_latest_sermons_func');


vc_map( array(
   "name" => __("Home block latest sermons", 'candidate'),
   "base" => "vc_latest_sermons",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of latest sermons', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Latest Sermons",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Limit", 'candidate'),
         "param_name" => "limit",
         "value" => 2,
         "description" => __("Events limit.",'candidate')
        ),
		
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("More URL", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("More text", 'candidate'),
         "param_name" => "custom_link_text",
         "value" => "MORE SERMONS",
         "description" => __("Text Link.",'candidate')
        ),		
		array(
            "type" => "dropdown",
            "heading" => __("Target Link", 'candidate'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'candidate'),
            'value' => $target_arr
        ),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Tag for title', 'candidate' ),
			'param_name' => 'title_style',
			'value' => array(
				__( 'h1', 'candidate' ) => 'h1',
				__( 'h2', 'candidate' ) => 'h2',
				__( 'h3', 'candidate' ) => 'h3',
				__( 'h4', 'candidate' ) => 'h4',
				__( 'h5', 'candidate' ) => 'h5',
			),
			'description' => __( 'Choose tag for title.', 'candidate' )
		),
		
		
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );




//////////////////////////////vc_upcoming_events////////////////////////////////////////////////////////////////////////////////
function vc_upcoming_events_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Upcoming Events",'candidate'),
    'limit' => '2',
	'custom_link' => '',
	'custom_link_text' => 'More Events',
	'events_style' => 'style1',
	'custom_links_target' => '',
	'title_style' => 'h3',
	'item_style' => 'h4',
    'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $events_style.' ';
	$css_class .= $css_animation;
	$custom_class = '';
	
	

	$myposts = tribe_get_events(
			apply_filters(
				'tribe_events_list_widget_query_args', array(
					'eventDisplay'   => 'list',
					'posts_per_page' => $limit
				)
			)
		);
	
	
	
	if($events_style == 'style1') {
	
	
	$output  = '<!-- Upcoming Events --><div class="sidebar-box white '. $css_class .'">';
	$output  .= "<{$title_style} class='box-title'>". esc_html($title) ."</{$title_style}>";
	$output  .= '<ul class="upcoming-events">';
	
		foreach( $myposts as $post ) :  setup_postdata($post);
			setup_postdata( $post );
			$event_id = $post->ID;
			$type_event = get_meta_option('events_type_meta_box');
			$time_range_separator = tribe_get_option('timeRangeSeparator', ' - ');

			$start_date = tribe_get_start_date( $event_id );
			$end_date = tribe_get_end_date( $event_id );
			
			$address = tribe_address_exists($event_id) ? '' . tribe_get_full_address($event_id) . '' : '';
			
			$start_day = tribe_get_start_date( $event_id, false, 'd' );
		    $start_month = tribe_get_start_date( $event_id, false, 'M' );

	$output  .= '<!-- Event -->
								<li>
									<div class="date">
										<span>
											<span class="day">'. $start_day .'</span>
											<span class="month">'. $start_month .'</span>
										</span>
									</div>
									
									<div class="event-content">';
						$output  .= "<{$item_style} class='events-title'><a href='". get_permalink($event_id) ."'>". get_the_title($event_id) ."</a></{$item_style}>";
						$output  .= '<ul class="event-meta">
											<li><i class="icons icon-clock"></i> '. $start_date .'-'. $end_date .'</li>
											<li><i class="icons icon-location"></i> '. $address .'</li>
										</ul>
									</div>
								</li>
								<!-- /Event -->';		
			
	
		endforeach; 	
	
	wp_reset_query();
	
	$output  .= '</ul><a href="'. $custom_link .'" target="'. $custom_links_target .'"  class="button transparent button-arrow">'. $custom_link_text .'</a></div><!-- /Upcoming Events -->';
	
	} else {
		
		$counter = 0;
		
		$output  = '<!-- Upcoming Events --><div class="sidebar-box latest-events '. $css_class .'">';
		$output  .= "<{$title_style} class='box-title'>". esc_html($title) ."</{$title_style}><div class='row'>";
	
		foreach( $myposts as $post ) :  setup_postdata($post);
			setup_postdata( $post );
			$event_id = $post->ID;
			
			$counter++;
			
			
			$type_event = get_meta_option('events_type_meta_box');
			$time_range_separator = tribe_get_option('timeRangeSeparator', ' - ');

			$start_date = tribe_get_start_date( $event_id );
			$end_date = tribe_get_end_date( $event_id );
			
			$address = tribe_address_exists($event_id) ? '' . tribe_get_full_address($event_id) . '' : '';
			
			$start_day = tribe_get_start_date( $event_id, false, 'd' );
		    $start_month = tribe_get_start_date( $event_id, false, 'M' );
		
		
			$post_thumbnail_id = get_post_thumbnail_id($event_id);
			$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'latest-post'); 
		
			if($counter == 1) {
				
				$output  .= '<div class="event_big col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="blog-post">
					<div class="post-image m_bottom_20">
					<a href="'. get_permalink($event_id) .'">
						<img src="' . $post_thumbnail_url[0] . '" alt="">
					</a>	
					</div>
					<ul class="upcoming-events-date upcoming-events">
					<li>
					<div class="date">
						<span>
							<span class="day">'. $start_day .'</span>
							<span class="month">'. $start_month .'</span>
						</span>
					</div>
					<div class="event-content">';
					
					$output  .= "<a href='". get_permalink($event_id) ."'><{$item_style} class='events-title'>". get_the_title($event_id) ."</{$item_style}></a>";
					
					$output  .= '<ul class="event-meta">
							<li><i class="icons icon-clock"></i> '. $start_date .'-'. $end_date .'</li>
							<li><i class="icons icon-location"></i> '. $address .'</li>
						</ul>
						
					</div>
					
					
					</li>
					</ul>
					<a href="'. get_permalink($event_id) .'" class="button read-more-button big button-arrow" >'. __("Join Now", 'candidate') .'</a>
				</div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><ul class="upcoming-events">';	
				
			} else {
			
			$output  .= '<li>
					<div class="date">
						<span>
							<span class="day">'. $start_day .'</span>
							<span class="month">'. $start_month .'</span>
						</span>
					</div>
					
					<div class="event-content">';
					$output  .= "<a href='". get_permalink($event_id) ."'><{$item_style} class='events-title'>". get_the_title($event_id) ."</{$item_style}></a>";
					$output  .= '<ul class="event-meta">
							<li><i class="icons icon-clock"></i> '. $start_date .'-'. $end_date .'</li>
							<li><i class="icons icon-location"></i> '. $address .'</li>
						</ul>
					</div>
				</li><!-- /Event -->';		
			}

		endforeach; 	
	
	wp_reset_query();
	
	$output  .= '</ul><a href="'. $custom_link .'" target="'. $custom_links_target .'"  class="button transparent button-arrow">'. $custom_link_text .'</a></div></div></div><!-- /Upcoming Events -->';	
	}
	
   return $output;
}
add_shortcode('vc_upcoming_events', 'vc_upcoming_events_func');


vc_map( array(
   "name" => __("Home block Upcoming Events", 'candidate'),
   "base" => "vc_upcoming_events",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Upcoming Events', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Upcoming Events",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Limit", 'candidate'),
         "param_name" => "limit",
         "value" => 2,
         "description" => __("Events limit.",'candidate')
        ),
		
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("More Events URL", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("More Events Text", 'candidate'),
         "param_name" => "custom_link_text",
         "value" => "More Events",
         "description" => __("Text Link.",'candidate')
        ),		
		array(
            "type" => "dropdown",
            "heading" => __("Target Link", 'candidate'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'candidate'),
            'value' => $target_arr
        ),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'candidate' ),
			'param_name' => 'events_style',
			'value' => array(
				__( 'Style1', 'candidate' ) => 'style1',
				__( 'Style2', 'candidate' ) => 'style2',
			),
			'description' => __( 'Select Style.', 'candidate' )
		),
		
		array(
			'type' => 'dropdown',
			'heading' => __( 'Tag for block title', 'candidate' ),
			'param_name' => 'title_style',
			'value' => array(
				__( 'h1', 'candidate' ) => 'h1',
				__( 'h2', 'candidate' ) => 'h2',
				__( 'h3', 'candidate' ) => 'h3',
				__( 'h4', 'candidate' ) => 'h4',
				__( 'h5', 'candidate' ) => 'h5',
			),
			'description' => __( 'Choose tag for title.', 'candidate' )
		),
		
		array(
			'type' => 'dropdown',
			'heading' => __( 'Tag for item title', 'candidate' ),
			'param_name' => 'item_style',
			'value' => array(
				__( 'h3', 'candidate' ) => 'h3',
				__( 'h4', 'candidate' ) => 'h4',
				__( 'h5', 'candidate' ) => 'h5',
				__( 'h6', 'candidate' ) => 'h6',
			),
			'description' => __( 'Choose tag for title.', 'candidate' )
		),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );








//////////////////////////////vc_main_issues////////////////////////////////////////////////////////////////////////////////
function vc_main_issues_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("The main issues",'candidate'),
	'custom_image' => '',
	'custom_link' => '',
	'custom_link_text' => 'Find out more',
	'custom_links_target' => '',
    'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$custom_class = '';
	
	$img_id = preg_replace('/[^\d]/', '', $custom_image);
	$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => '232x137' ));

	
	
	$output  = '<!-- Image Banner -->
				<div class="sidebar-box image-banner '. $css_class .'">
					<a target="'. $custom_links_target .'"  href="'. $custom_link .'">
						'. $img['thumbnail'] .'
						<h3>'. $title .'</h3>
						<span class="button transparent button-arrow">'. $custom_link_text .'</span>
					</a>
				</div>
				<!-- /Image Banner -->';
	

	
	

   return $output;
}
add_shortcode('vc_main_issues', 'vc_main_issues_func');


vc_map( array(
   "name" => __("Home block Main Issues", 'candidate'),
   "base" => "vc_main_issues",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Home block of Main Issues', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("The main issues",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => __("Image", 'candidate'),
         "param_name" => "custom_image",
         "description" => __("Select image from media library.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Btn More URL", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Btn More Text", 'candidate'),
         "param_name" => "custom_link_text",
         "value" => "Find out more",
         "description" => __("Text Link.",'candidate')
        ),		
		array(
            "type" => "dropdown",
            "heading" => __("Target Link", 'candidate'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'candidate'),
            'value' => $target_arr
        ),

		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );







//////////////////////////////vc_widget_popular_news////////////////////////////////////////////////////////////////////////////////
function vc_mypopular_news_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("Popular news",'candidate'),
      'num_items' => '4',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$custom_class = '';
	
    $args = array(  
    'post_type' => 'post',  
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );


	
	$output  = '<!-- Popular News -->
						<div class="sidebar-box white '. $css_class .'">
							<h3>'. $title .'</h3>
							<ul class="popular-news">';


	$count=0;
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			//$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'th-sidebar'); 

	$count++;
	$output .=  '<li>
					<div class="thumbnail">
						<img src="' . $post_thumbnail_url[0] . '" alt="">
					</div>
					
					<div class="post-content">
						<h6><a href="'. get_permalink($post_id) .'">'. get_the_title($post_id) .'</a></h6>
						<div class="post-meta">
							<span>'. __('by', 'candidate') .' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></span>
							<span>'. get_the_time('F j, Y g:i a', $post_id) .'</span>
						</div>
					</div>
				</li>';

	endforeach; 	
	
	$output .=  '</ul></div><!-- /Popular News -->';
 
   return $output;
}
add_shortcode('vc_mypopular_news', 'vc_mypopular_news_func');

vc_map( array(
   "name" => __("Popular news", 'candidate'),
   "base" => "vc_mypopular_news",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Popular news', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Popular news",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'candidate')
        ),
   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );











//////////////////////////////vc_mybuttons////////////////////////////////////////////////////////////////////////////////
function vc_mybuttons_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Button",'candidate'),
	'custom_link' => '',
	'custom_links_target' => '',
	'btn_arr' => '',
	'btn_size' => '',
	'btn_type' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  'mycustom_button button ';
	$css_class .= $css_animation." ";
	$css_class .= $btn_type." ";
	$css_class .= $btn_size." ";
	$css_class .= $btn_arr." ";

	$output  = '<a target="'. $custom_links_target .'" href="'. $custom_link .'" class=" '. $css_class .'">'. $title .'</a>';

   return $output;
}
add_shortcode('vc_mybuttons', 'vc_mybuttons_func');


vc_map( array(
   "name" => __("Custom Buttons", 'candidate'),
   "base" => "vc_mybuttons",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom Buttons', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Button",'candidate'),
         "description" => __("Block title.",'candidate')
        ),

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Btn More URL", 'candidate'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.",'candidate')
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Link", 'candidate'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'candidate'),
            'value' => $target_arr
        ),

		array(
		  "type" => "dropdown",
		  "heading" => __("Button Arrow", 'candidate'),
		  "param_name" => "btn_arr",
		  "value" => array(__("No", 'candidate') => '', __("With Arrow", 'candidate') => "button-arrow"),
		  "description" => __("Select arrow.", 'candidate')
		),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("Button Size", 'candidate'),
		  "param_name" => "btn_size",
		   "description" => __("Select button size.", 'candidate'),
		  "value" => $btn_size
		),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("Button Type", 'candidate'),
		  "param_name" => "btn_type",
		  "value" => array(__("Normal", 'candidate') => '', __("Donate", 'candidate') => "donate"),
		  "description" => __("Select button type.", 'candidate')
		),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );







//////////////////////////////vc_mylists////////////////////////////////////////////////////////////////////////////////
function vc_mylists_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'type_list' => 'arrow-list',
    'custom_links' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  'list ';
	$css_class .= $type_list." ";
	$css_class .= $css_animation." ";
	
	$custom_links = explode( ',', $custom_links); 
	
	if($type_list == 'ordered-list') {  
	$output  = '<ol class=" '. $css_class .'">';
	} else {
	$output  = '<ul class=" '. $css_class .'">';
	}
	
	$i = 0;

	
	while ($i<count($custom_links))
	{
		$output  .= '<li>'. $custom_links[$i] .'</li>';
		$i++;
	}
	
	
	if($type_list == 'ordered-list') {  
	$output  .= '</ol>';
	} else {
	$output  .= '</ul>';
	}
	

   return $output;
}
add_shortcode('vc_mylists', 'vc_mylists_func');


vc_map( array(
   "name" => __("Custom Lists", 'candidate'),
   "base" => "vc_mylists",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom List', 'candidate'),
   "params" => array(

		array(
		  "type" => "dropdown",
		  "heading" => __("Type List", 'candidate'),
		  "param_name" => "type_list",
		  "value" => array(__("Arrow List", 'candidate') => "arrow-list", __("Check List", 'candidate') => "check-list", __("Star List", 'candidate') => "star-list", __("Plus List", 'candidate') => "plus-list", __("Finger List", 'candidate') => "finger-list", __("Ordered List", 'candidate') => "ordered-list"),
		  "description" => __("Select Type.", 'candidate')
		),
   
		array(
            "type" => "exploded_textarea",
            "heading" => __("Custom list", 'candidate'),
            "param_name" => "custom_links",
            "description" => __('Enter text for each list. Divide text with linebreaks (,).', 'candidate')
        ),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );








//////////////////////////////vc_mybloquotes////////////////////////////////////////////////////////////////////////////////
function vc_mybloquotes_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'type_list' => '',
    'custom_text' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $type_list." ";
	$css_class .= $css_animation." ";

	$output  = '<blockquote class="'. $css_class .'">"'. $custom_text .'"</blockquote>';

   return $output;
}
add_shortcode('vc_mybloquotes', 'vc_mybloquotes_func');


vc_map( array(
   "name" => __("Custom Bloquotes", 'candidate'),
   "base" => "vc_mybloquotes",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom List', 'candidate'),
   "params" => array(

		array(
		  "type" => "dropdown",
		  "heading" => __("Type Bloquote", 'candidate'),
		  "param_name" => "type_list",
		  "value" => array(__("Type1", 'candidate') => "", __("Type2", 'candidate') => "iconic-quote"),
		  "description" => __("Select Type Bloquote.", 'candidate')
		),
   

		array(  
	        "type" => "textarea",
			"holder" => "div",
			"heading" => __("Text", 'candidate'),
			"param_name" => "custom_text",
			"value" => '',
			"description" => __("Enter your content.", 'candidate')
		),    
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );









//////////////////////////////vc_widget_mytestimonials////////////////////////////////////////////////////////////////////////////////
function vc_mytestimonials_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'num_items' => '4',
      'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation;
	
    $args = array(  
    'post_type' => 'testimonial',  
	'orderby' => 'post_date',
	'order' => 'DESC',
    'posts_per_page' => $num_items,
	'post_status'     => 'publish'	
	);  
		   
	$myposts = get_posts( $args );


	
	$output  = '<!-- Owl Carousel -->
						<div class="owl-carousel-container testimonial-carousel '. $css_class .'">
							<div class="owl-carousel" data-max-items="1">';
	
		$count=0;
		foreach( $myposts as $post ) :  setup_postdata($post);
				$des = get_the_content();
				$address = get_meta_option('address_testimonial_meta_box', $post->ID);
				$title1 = get_the_title($post->ID);
				$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'th-sidebar'); 
				$count++;
	
			$output  .= '<!-- Owl Item -->
								<div>
									
									<!-- Testimonial -->
									<div class="testimonial">
							
										<div class="testimonial-content">
											<p>'. $des .'</p>
										</div>
										
										<div class="testimonial-author">
											<img src="'. $thumb_image_url[0] .'" alt="">
											<div class="author-meta">
												<span class="name">'. $title1 .'';
								if($address != '') {				
						$output  .= ',';						
								}		
			$output  .= '</span><span class="location">'. $address .'</span>
											</div>
										</div>
										
									</div>
									<!-- /Testimonial -->
								</div>';
		
		
		endforeach; 	
	
	$output  .= '</div>';
		if($num_items != '1') {					
	$output  .= '<div class="owl-header">
								
								<div class="carousel-arrows">
									<span class="left-arrow"><i class="icons icon-left-dir"></i></span>
									<span class="right-arrow"><i class="icons icon-right-dir"></i></span>
								</div>
								
							</div>';
			}		
	$output  .= '</div>
						<!-- /Owl Carousel -->';
	
	
 
   return $output;
}
add_shortcode('vc_mytestimonials', 'vc_mytestimonials_func');

vc_map( array(
   "name" => __("Testimonials", 'candidate'),
   "base" => "vc_mytestimonials",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Testimonials', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'candidate')
        ),
   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );







//////////////////////////////vc_myalertbox////////////////////////////////////////////////////////////////////////////////
function vc_myalertbox_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'type_list' => 'warning',
    'custom_text' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $type_list." ";
	$css_class .= $css_animation." ";

	$output  = '<div class="alert-box '. $css_class .'">
							<p>'. $custom_text .'</p>
							<i class="icons icon-cancel-circle-1"></i>
						</div>';

   return $output;
}
add_shortcode('vc_myalertbox', 'vc_myalertbox_func');


vc_map( array(
   "name" => __("Custom Alert", 'candidate'),
   "base" => "vc_myalertbox",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom Alert', 'candidate'),
   "params" => array(

		array(
		  "type" => "dropdown",
		  "heading" => __("Type Alert", 'candidate'),
		  "param_name" => "type_list",
		  "value" => array(__("Warning", 'candidate') => "warning", __("Error", 'candidate') => "error", __("Success", 'candidate') => "success", __("Info", 'candidate') => "info"),
		  "description" => __("Select Type Alert.", 'candidate')
		),
   

		array(  
	        "type" => "textarea",
			"holder" => "div",
			"heading" => __("Text", 'candidate'),
			"param_name" => "custom_text",
			"value" => '',
			"description" => __("Enter your content.", 'candidate')
		),    
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );





//////////////////////////////vc_mypagination////////////////////////////////////////////////////////////////////////////////
function vc_mypagination_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'type_list' => 'numeric',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation." ";

	
	if($type_list == 'numeric') {
	$output  = '<div class="numeric-pagination '. $css_class .'">
							<a href="#" class="button"><i class="icons icon-left-dir"></i></a>
							<a href="#" class="button">1</a>
							<a href="#" class="button">2</a>
							<a href="#" class="button">3</a>
							<a href="#" class="button"><i class="icons icon-right-dir"></i></a>
						</div>';
	} else {
	$output  = '<div class="button-pagination '. $css_class .'">
							<a href="#" class="button big previous">Prev post</a>
							<a href="#" class="button big next">Next post</a>
						</div>';
	}
	

   return $output;
}
add_shortcode('vc_mypagination', 'vc_mypagination_func');


vc_map( array(
   "name" => __("Custom Pagination", 'candidate'),
   "base" => "vc_mypagination",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom Pagination', 'candidate'),
   "params" => array(

		array(
		  "type" => "dropdown",
		  "heading" => __("Type Pagination", 'candidate'),
		  "param_name" => "type_list",
		  "value" => array(__("Numeric", 'candidate') => "numeric", __("Button", 'candidate') => "button"),
		  "description" => __("Select Type Pagination.", 'candidate')
		),
   
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );







//////////////////////////////vc_mydropcaps////////////////////////////////////////////////////////////////////////////////
function vc_mydropcaps_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'type_dropcaps' => '',
    'custom_text' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $type_dropcaps." ";
	$css_class .= $css_animation." ";

	$output  = '<span class="dropcap  '. $css_class .'">'. $custom_text .'</span>';

   return $output;
}
add_shortcode('vc_mydropcaps', 'vc_mydropcaps_func');


vc_map( array(
   "name" => __("Custom Dropcaps", 'candidate'),
   "base" => "vc_mydropcaps",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom Dropcaps', 'candidate'),
   "params" => array(

		array(
		  "type" => "dropdown",
		  "heading" => __("Type Dropcaps", 'candidate'),
		  "param_name" => "type_dropcaps",
		  "value" => array(__("Normal", 'candidate') => "", __("Blue", 'candidate') => "blue", __("Squared", 'candidate') => "squared", __("Squared Blue", 'candidate') => "squared blue"),
		  "description" => __("Select Type Dropcaps.", 'candidate')
		),
   

		array(  
	        "type" => "textarea",
			"holder" => "div",
			"heading" => __("Text", 'candidate'),
			"param_name" => "custom_text",
			"value" => '',
			"description" => __("Enter your content.", 'candidate')
		),    
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top",'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );





//////////////////////////////vc_mytooltip////////////////////////////////////////////////////////////////////////////////
function vc_mytooltip_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => '',
    'type_tooltip' => '',
    'custom_text' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $type_tooltip." ";
	$css_class .= $css_animation." ";

	$output  = '<a href="#" title="'. $custom_text .'" class="mytooltip '. $css_class .'"  style="float: left;" >'. $title .'</a>';

   return $output;
}
add_shortcode('vc_mytooltip', 'vc_mytooltip_func');


vc_map( array(
   "name" => __("Custom Tooltip", 'candidate'),
   "base" => "vc_mytooltip",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom Tooltip', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Tooltip",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		
		array(
		  "type" => "dropdown",
		  "heading" => __("Type Tooltip", 'candidate'),
		  "param_name" => "type_tooltip",
		  "value" => array(__("Top", 'candidate') => "tooltip-ontop", __("Bottom", 'candidate') => "tooltip-onbottom", __("Left", 'candidate') => "tooltip-onleft", __("Right", 'candidate') => "tooltip-onright"),
		  "description" => __("Select Type Tooltip.", 'candidate')
		),
   

		array(  
	        "type" => "textarea",
			"holder" => "div",
			"heading" => __("Text", 'candidate'),
			"param_name" => "custom_text",
			"value" => 'Text Tooltip',
			"description" => __("Enter your content.", 'candidate')
		),    
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );






//////////////////////////////vc_myaudio////////////////////////////////////////////////////////////////////////////////
function vc_myaudio_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Audio",'candidate'),
    'custom_text' => '',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation." ";

	$output  = '<audio class="volume-on custom_audio '. $css_class .'">
							<source src="'. $custom_text .'" type="audio/mpeg">
							<source src="'. $custom_text .'" type="audio/ogg">
							Your browser does not support the audio element.
						</audio><h6>'. $title .'</h6>';

   return $output;
}
add_shortcode('vc_myaudio', 'vc_myaudio_func');


vc_map( array(
   "name" => __("Custom Audio", 'candidate'),
   "base" => "vc_myaudio",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom Audio', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Audio",'candidate'),
         "description" => __("Block title.",'candidate')
        ),

		array(  
	        "type" => "textfield",
			"holder" => "div",
			 "class" => "",
			"heading" => __("URL Audio", 'candidate'),
			"param_name" => "custom_text",
			"value" => '',
			"description" => __("Enter your URL Audio.", 'candidate')
		),    
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );







//////////////////////////////vc_mylightbox////////////////////////////////////////////////////////////////////////////////
function vc_mylightbox_func( $atts, $content = null ) { // New function parameter $content is added!
	$output = $image = $img_size = $title = $title_url = $css_animation = '';
   extract( shortcode_atts( array(
    'title' => __("LightBox",'candidate'),
    'title_url' => '',
	'image' => $image,
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation." ";

	$img_id = preg_replace( '/[^\d]/', '', $image );
	$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'thumbnail', 'class' => '' ) );
	if ( $img == NULL ) $img['thumbnail'] = '<img class="" src="' . vc_asset_url( 'vc/no_image.png' ) . '" />'; 
	
	$link_to_img = wp_get_attachment_image_src( $img_id, 'latest-post' );
	$link_to_img = $link_to_img[0];
	
	$link_to = wp_get_attachment_image_src( $img_id, 'large' );
	$link_to = $link_to[0];
	
	$output  = '<div class="media-item gallery-item no-margin-bottom  '. $css_class .'">
									<img src="' . $link_to_img . '" alt="">
									<div class="media-hover">
										<div class="media-icons">
											<a href="' . $link_to . '" data-group="media-jackbox" class="jackbox media-icon"><i class="icons icon-eye"></i></a>
											<a href="'. $title_url .'" class="media-icon"><i class="icons icon-link"></i></a>
										</div>
									</div>
								</div><h6>'. $title .'</h6>';

   return $output;
}
add_shortcode('vc_mylightbox', 'vc_mylightbox_func');


vc_map( array(
   "name" => __("Custom LightBox", 'candidate'),
   "base" => "vc_mylightbox",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom LightBox', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("LightBox",'candidate'),
         "description" => __("Block title.",'candidate')
        ),

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("URL", 'candidate'),
         "param_name" => "title_url",
         "value" => "",
         "description" => __("Block URL.",'candidate')
        ),
		
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'candidate' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'candidate' )
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );



//////////////////////////////vc_toptitle////////////////////////////////////////////////////////////////////////////////
function vc_toptitle_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => __("Title",'candidate'),
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation;

	$output  = '<h3 class="no-margin-top '. $css_class .'" >'. $title .'</h3>';

   return $output;
}
add_shortcode('vc_toptitle', 'vc_toptitle_func');


vc_map( array(
   "name" => __("Custom Top Title", 'candidate'),
   "base" => "vc_toptitle",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Block of Custom Top Title', 'candidate'),
   "params" => array(

		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => __("Title",'candidate'),
         "description" => __("Block title.",'candidate')
        ),
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );





//////////////////////////////vc_type_issues////////////////////////////////////////////////////////////////////////////////
function vc_type_issues_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
    'title' => '',
	'icon' => 'true',
	'number' => '',
	'columns' => 'col-lg-4 col-md-4 col-sm-12',
    'css_animation' => ''
   ), $atts ) );
 
	$css_class =  '';
	$css_class .= $css_animation;
	$css_class .= ' ';
	$css_class .= $columns;

	global $post;
	$tmp_post = $post;
	
	$args = array('numberposts'=> $number, 'post_type'=>'issues');
	$myposts = get_posts($args);
	$output = '';
	$output .= '<div class="row">';
		
	$setting1 = array();
	$setting1['options'] = candidat_custom_fontello_classes();
		
		foreach( $myposts as $post ) : setup_postdata($post);
			global $post;
			$des = get_the_excerpt();
			$des = candidat_the_excerpt_max_charlength_text($des, 17);
			$ico = get_meta_option('issues_icon_meta_box');
			$ico = $setting1['options'][$ico];
			
		
		
		$output .= '<div class="'. $css_class .'">
								
				<div class="issue-block">';
		if($icon == 'true') {			
		$output .= '<div class="issue-icon">
						<i class="icons '. $ico .'"></i>
					</div>';
		} else {			
		$output .= '<div class="issue-image">';
		$output .=	get_the_post_thumbnail($post->ID, 'post-blog');	
		$output .= '</div>';
		}		
		$output .= '<div class="issue-content">
					
						<h4>'. get_the_title($post->ID) .' </h4>
						<p>'. $des .'</p>
						
						<a class="button big button-arrow" href="'. get_permalink() .'">'. __('Read more', 'candidate') .'</a>
					
					</div>
					
				</div>
				
			</div>';

				endforeach; 
		$output .= '</div>';
	
	
	
	$post = $tmp_post; 
	return $output;	

}
add_shortcode('vc_type_issues', 'vc_type_issues_func');


vc_map( array(
   "name" => __("Custom block Issues", 'candidate'),
   "base" => "vc_type_issues",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'candidate'),
	"description" => __('Custom block of Issues', 'candidate'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'candidate'),
         "param_name" => "title",
         "value" => "",
         "description" => __("Block title.",'candidate')
        ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'candidate'),
         "param_name" => "number",
         "value" => "3",
         "description" => __("Number items.",'candidate')
        ),
		array(
            "type" => "dropdown",
            "heading" => __("Columns", 'candidate'),
            "param_name" => "columns",
            "description" => __('Select columns.', 'candidate'),
            'value' => array(__("3 columns", 'candidate') => 'col-lg-4 col-md-4 col-sm-12', __("4 columns", 'candidate') => "col-lg-3 col-md-3 col-sm-12")
        ),

		array(
            "type" => "dropdown",
            "heading" => __("Type", 'candidate'),
            "param_name" => "icon",
            "description" => __('Select type.', 'candidate'),
            'value' => array(__("Icon", 'candidate') => 'true', __("Image", 'candidate') => "false")
        ),

		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'candidate'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'candidate') => '', __("Top to bottom", 'candidate') => "top-to-bottom", __("Bottom to top", 'candidate') => "bottom-to-top", __("Left to right", 'candidate') => "left-to-right", __("Right to left", 'candidate') => "right-to-left", __("Appear from center", 'candidate') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'candidate')
		)

   )
) );
















//////////////custom param///////////////////////////////////////////////////////////////////////
function portfolio_category_settings_field($param, $param_value) {
   $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=portfolio-category');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
                
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->term_id == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->term_id.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('portfolio_category', 'portfolio_category_settings_field');





function homeshop_team_category_settings_field($param, $param_value) {
   $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=team-category');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
                
				$selected1 = '';
				if ( $param_value == 'all') $selected1 = ' selected="selected"';
				$param_line .= '<option value="all"'.$selected1.'>all</option>';
				
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->term_id == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->term_id.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('team_category', 'homeshop_team_category_settings_field');


function homeshop_post_category_settings_field($param, $param_value) {
   $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=category');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
                
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->term_id == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->term_id.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('post_category', 'homeshop_post_category_settings_field');

function homeshop_category_settings_field($param, $param_value) {
   $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=product_cat');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
                
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->term_id == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->term_id.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('my_category', 'homeshop_category_settings_field');




function homeshop_contact_form_field($param, $param_value) {
    $dependency = vc_generate_dependencies_attributes($param);
   
    $param_line = '';
	$param_line .= '<div class="cf_wrapper">';
	$param_line .= '<input name="'.$param['param_name'].'" class="val wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.$param_value.'"/>';
	$param_line .= '<ul class="contact_fields"></ul>
					<div class="form">
						<label for="lb" style="width: 60px;float: left;">Label</label> <input id="lb" type="text" class="label" style="width: 200px; margin-bottom: 4px;" /><br>
						<label for="nm" style="width: 60px;float: left;">Name</label> <input id="nm" type="text" class="name" style="width: 200px; margin-bottom: 4px;" />
						<input type="button" class="add_cf_row" value="add new field"/>
					 </div>';
	$param_line .=  '<script> var builder = new cf_builder({"container": ".cf_wrapper"}); builder.init('.$param_value.');</script>';
	$param_line .= '</div>';
   

    return $param_line;
}
vc_add_shortcode_param('contact_form', 'homeshop_contact_form_field');










/* remove
---------------------------------------------------------- */
vc_remove_element("vc_toggle");
vc_remove_element("vc_gallery");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_pie");








 ?>