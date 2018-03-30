<?php
if ( class_exists( 'WPBakeryShortCode' ) ) :

add_action( 'vc_before_init', 'handy_sale_carousel' );

function handy_sale_carousel(){

vc_map( array(
      "name" => esc_html__( 'Sale Carousel', 'plumtree' ),
      "base" => "handy_sale_carousel",
			'category' => esc_html__( 'Handy Shortcodes', 'plumtree'),
  	  "description" => esc_html__( 'Output carousel with sale products', 'plumtree' ),
  		'icon' => get_template_directory_uri() . '/images/vc-icon.png',

      "params" => array(
      array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Title text', 'plumtree' ),
        'param_name' => 'el_title',
        'value' => __('Title goes here', 'plumtree'),
      ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Transition Type', 'plumtree' ),
				'param_name' => 'transition_type',
				'value' => array(
						'Fade' => 'fade',
						'Back Slide' => 'backSlide',
						'Go Down' => 'goDown',
						'Fade Up' => 'fadeUp',
					),
				'std'=> 'fade',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Autoplay', 'plumtree' ),
				'param_name' => 'autoplay',
				'description' => esc_html__( 'Whether to running your carousel automatically or not', 'plumtree' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Show Arrows', 'plumtree' ),
				'param_name' => 'show_arrows',
				'description' => esc_html__( 'Show/hide arrow buttons', 'plumtree' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Show Page Navigation', 'plumtree' ),
				'param_name' => 'page_navi',
				'description' => esc_html__( 'Show/hide navigation buttons under your carousel', 'plumtree' ),
			),
			array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Carousel Items', 'plumtree' ),
			'param_name' => 'sale_carousel_items',
			'value' => urlencode( json_encode( array(
				array(
          'product_id' => 'Sale product ID',
					'target_date' => '2016-12-31',
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'position',
					'heading' => esc_html__( 'Enter Sale Product ID', 'plumtree' ),
					'param_name' => 'product_id',
					'description' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Target Date', 'plumtree' ),
					'param_name' => 'target_date',
					'description' => esc_html__( 'Set target date (YYYY-MM-DD) when special offer ends', 'plumtree' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Pre-Countdown text', 'plumtree' ),
					'param_name' => 'pre_countdown_text',
					'description' => esc_html__( 'This text appears before countdown timer', 'plumtree' ),
				),
			),
		),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra class name', 'plumtree' ),
				'param_name' => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'plumtree' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'CSS box', 'plumtree' ),
				'param_name' => 'css',
				'group' => esc_html__( 'Design Options', 'plumtree' ),
			),
      )
   ) );

}

class WPBakeryShortCode_handy_sale_carousel extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
      'el_title' => 'Carousel Title',
			'transition_type' => 'fade',
			'autoplay' => 'false',
			'show_arrows' => '',
			'page_navi' => 'false',
			'sale_carousel_items' => '',
			'css' => '',
			'el_class'=> '',
		), $atts ) );

		$output = '';
    $carousel_items = '';
		$sale_carousel_items_content = vc_param_group_parse_atts($sale_carousel_items);
		$container_id = uniqid('owl',false);
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

    if ($sale_carousel_items_content) {
      $carousel_items .= '<ul class="products">';
		  foreach ($sale_carousel_items_content as $item) {
        if ( isset( $item['product_id'] ) ) {
          $product = new WC_Product( $item['product_id'] );
          if ( $product->is_on_sale() ) {
            $countdown_container_id = uniqid('countdown',false);
            $target = explode("-", $item['target_date']);
            $carousel_items .= '<li class="row"><div class="img-wrapper col-xs-12 col-md-6">';
            $carousel_items .= '<a href="'.esc_url($product->get_permalink()).'" class="link-to-product">'.$product->get_image( 'shop_catalog' ).'</a></div>';
            $carousel_items .= '<div class="counter-wrapper col-xs-12 col-md-6"><h4>'.__('Sale!', 'plumtree').'</h4>';
            // Sale value in percents
            $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
            $carousel_items .= '<span class="sale-value">-'.$percentage.'%</span>';
            $carousel_items .= '<div class="countdown-wrapper">';
            if ( $item['pre_countdown_text'] && $item['pre_countdown_text'] != '' ) {
              $carousel_items .= '<p>'.esc_attr($item['pre_countdown_text']).'</p>';
            }
            $carousel_items .= '<div id="'.$countdown_container_id.'"></div></div>';
            $carousel_items .= '<div class="price-wrapper">'.do_shortcode('[add_to_cart id="'.$item['product_id'].'"]').'</div>';
            if ( $target && $target!='' ) {
    					$carousel_items .='
    					<script type="text/javascript">
    						(function($) {
    							$(document).ready(function() {

    								var container = $("#'.$countdown_container_id.'");
    								var newDate = new Date('.$target[0].', '.$target[1].'-1, '.$target[2].');
    								container.countdown({
    									until: newDate,
    								});

    							});
    						})(jQuery);
    					</script>';
    				}
    				$carousel_items .= '</div></li>';
          }
        }
      }
      $carousel_items .= '</ul>';
    }

    // Output Carousel
    $output .= '<div class="pt-sales-carousel '.$el_class.$css_class.'" id="'.$container_id.'">';
    if ( $el_title && $el_title !='' ) { $output .= '<h3>'.esc_attr($el_title).'</h3>'; }
    $output .= "<div class='wrapper'>";
    if ( $show_arrows ) { $output .= "<span class='prev'></span><span class='next'></span>"; }
    if ( $carousel_items && $carousel_items !='') {
      $output .= $carousel_items;
    } else {
      $output .= esc_html__('Add sale products first', 'plumtree');
    }
    $output .= "</div></div>";

    $output.='
      <script type="text/javascript">
        (function($) {
          $(document).ready(function() {
            var owl = $("#'.$container_id.' ul.products");

            owl.owlCarousel({
              navigation : false,
              pagination : '.$page_navi.',
              autoPlay   : '.$autoplay.',
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
              transitionStyle : "'.$transition_type.'",
            });

            // Custom Navigation Events
            $("#'.$container_id.'").find(".next").click(function(){
              owl.trigger("owl.next");
            })
            $("#'.$container_id.'").find(".prev").click(function(){
              owl.trigger("owl.prev");
            })
          });
        })(jQuery);
      </script>';

		return $output;
	}
}

endif;
