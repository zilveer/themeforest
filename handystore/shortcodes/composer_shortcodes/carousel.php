<?php
if ( class_exists( 'WPBakeryShortCode' ) ) :

add_action( 'vc_before_init', 'handy_carousel' );

function handy_carousel(){

vc_map( array(
      "name" => esc_html__( 'Configurable Carousel', 'plumtree' ),
      "base" => "handy_carousel",
			'category' => esc_html__( 'Handy Shortcodes', 'plumtree'),
  	  "description" => esc_html__( 'Carousel with awesome options', 'plumtree' ),
  		'icon' => get_template_directory_uri() . '/images/vc-icon.png',

      "params" => array(
          array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title text', 'plumtree' ),
            'param_name' => 'el_title',
            'value' => __('Title goes here', 'plumtree'),
          ),
          array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use as banners rotator?', 'plumtree' ),
            'param_name' => 'rotator',
            'description' => '',
          ),
      		array(
      			'type' => 'param_group',
      			'heading' => esc_html__( 'Carousel Images', 'plumtree' ),
      			'param_name' => 'slides',
      			'value' => urlencode( json_encode( array(
      				array(
      					'label' => esc_html__( 'Facebook', 'plumtree' ),
      					'url' => 'https://www.facebook.com/',
      				),
      				array(
      					'label' => esc_html__( 'Twitter', 'plumtree' ),
      					'url' => 'https://twitter.com',
      				),
      				array(
      					'label' =>esc_html__( 'Google Plus', 'plumtree' ),
      					'url' => 'https://plus.google.com',
      				),
      			) ) ),
      			'params' => array(
              array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'plumtree' ),
                'param_name' => 'slide_img',
                'description' => esc_html__( 'Add image from Media library', 'plumtree' ),
              ),
              array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Image size', 'plumtree' ),
                'param_name' => 'slide_img_size',
                'value' => array(
                  'Thumbnail' => 'thumbnail',
                  'Medium' => 'medium',
                  'Large' => 'large',
                  'Full' => 'full',
                  ),
                'std'=> 'full',
                'description' => esc_html__( "Enter image size. You can change these images' dimensions in wordpress media settings.", 'plumtree' ),
              ),
      				array(
      					'type' => 'textfield',
      					'heading' => esc_html__( 'Title', 'plumtree' ),
      					'param_name' => 'heading',
      					'description' => esc_html__( 'Enter heading text for item', 'plumtree' ),
      					'admin_label' => true,
      				),
      				array(
      					'type' => 'textfield',
      					'heading' => esc_html__( 'Short Description', 'plumtree' ),
      					'param_name' => 'description',
      					'description' => esc_html__( 'Enter description text for item', 'plumtree' ),
      				),
              array(
                'type' => 'textfield',
                'heading' => esc_html__( 'URL for detailed view', 'plumtree' ),
                'param_name' => 'url',
                'description' => esc_html__( 'Url of a link for detailed view button', 'plumtree' ),
              ),
              array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text (shown with banner rotator)', 'plumtree' ),
                'param_name' => 'btn_txt',
                'description' => esc_html__( 'Enter text for button', 'plumtree' ),
                'dependency' => array(
                  'element' => 'rotator',
                  'value' => array( 'true' ),
                ),
              ),
      			),
      		),
          array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Items per Slide', 'plumtree' ),
            'param_name' => 'per_slide',
            'value' => array(
              esc_html__( '1 item in row', 'plumtree' ) => '1',
              esc_html__( '2 items in row', 'plumtree' ) => '2',
              esc_html__( '3 items in row', 'plumtree' ) => '3',
              esc_html__( '6 items in 2 rows', 'plumtree' ) => '6',
              esc_html__( 'n items in row', 'plumtree' ) => 'n',
              ),
            'std'=> '1',
            'description' => '',
            'dependency' => array(
              'element' => 'rotator',
              'value_not_equal_to' => array('true'),
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'How many slides to show in one moment', 'plumtree' ),
            'param_name' => 'slides_qty',
            'value' => array(
              esc_html__( '2 Slides', 'plumtree' ) => '2',
              esc_html__( '3 Slides', 'plumtree' ) => '3',
              esc_html__( '4 Slides', 'plumtree' ) => '4',
              esc_html__( '5 Slides', 'plumtree' ) => '5',
              esc_html__( '6 Slides', 'plumtree' ) => '6'
              ),
            'std'=> '4',
            'description' => '',
            'dependency' => array(
              'element' => 'per_slide',
              'value' => array( 'n' ),
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Animation on hover', 'plumtree' ),
            'param_name' => 'hover_animation',
            'value' => array(
              esc_html__( 'Full height shift', 'plumtree' ) => 'shift',
              esc_html__( 'Full height fading', 'plumtree' ) => 'fading',
              esc_html__( 'Sliding from bottom', 'plumtree' ) => 'bottom-sliding',
              esc_html__( 'No animation', 'plumtree' ) => 'none',
              ),
            'std'=> 'shift',
            'description' => '',
            'dependency' => array(
              'element' => 'rotator',
              'value_not_equal_to' => array('true'),
            ),
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
            'dependency' => array(
              'element' => 'rotator',
              'value' => array( 'true' ),
            ),
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

class WPBakeryShortCode_handy_carousel extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'el_title' => '',
			'rotator' => 'false',
			'slides' => '',
      'per_slide' => '1',
      'slides_qty' => '4',
      'hover_animation' => 'shift',
			'transition_type' => 'fade',
			'autoplay' => 'false',
      'show_arrows' => '',
      'page_navi' => 'false',
			'css' => '',
			'el_class'=> '',
		), $atts ) );

		$output = '';
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'pt-carousel animation-'.esc_attr($hover_animation).' wpb_content_element ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    $container_id = uniqid('owl',false);

    /* Responsive qty */
    if ( $slides_qty=='2' && (pt_show_layout()!='layout-one-col') ) {
      $qty_sm = $qty_xs = 1;
      $qty_md = 2;
    } elseif ( $slides_qty=='2' && (pt_show_layout()=='layout-one-col') ) {
      $qty_sm = $qty_xs = 1;
      $qty_md = 2;
    } elseif ( $slides_qty!='2' && (pt_show_layout()!='layout-one-col') ) {
      $qty_md = 3;
      $qty_sm = 2;
      $qty_xs = 2;
    } elseif ( $slides_qty!='2' && (pt_show_layout()=='layout-one-col') ) {
      $qty_md = $slides_qty;
      $qty_sm = 2;
      $qty_xs = 1;
    }

    /* Get Carousel images */
    $carousel_imgs = '';
    $carousel_imgs_attributes =  vc_param_group_parse_atts( $slides );

    if( $carousel_imgs_attributes ){
      foreach ( $carousel_imgs_attributes as $data ) {
        if( ! empty($data['slide_img']) ) {
          $image_attributes = wp_get_attachment_image_src( $data['slide_img'], $data['slide_img_size'] );
          $img = wp_get_attachment_image( $data['slide_img'], $data['slide_img_size'] );
        }
        $header = ! empty( $data['heading'] ) ? '<h3>'.esc_attr($data['heading']).'</h3>' : '';
        $text = ! empty( $data['description'] ) ? '<span>'.esc_attr($data['description']).'</span>' : '';
        $quick_view = '<a href="'.esc_url($image_attributes[0]).'" title="'.__('Quick View', 'plumtree').'" rel="nofollow" data-magnific="link"><i class="fa fa-search"></i></a>';
        $button = ! empty( $data['url'] ) ? '<a href="'.esc_url($data['url']).'" title="'.__('Learn More', 'plumtree').'" rel="bookmark"><i class="fa fa-link"></i></a>' : '';
        $btn_txt = ! empty( $data['btn_txt'] ) ? esc_attr($data['btn_txt']) : esc_html__('Learn More', 'plumtree');

        if ($rotator == 'true') {
          $carousel_imgs .= '<div class="item-wrapper rotator"><figure><figcaption>';
          $carousel_imgs .= $header.$text.'</figcaption>';
          $carousel_imgs .= $img;
          $carousel_imgs .= '<a href="'.esc_url($data['url']).'" title="'.__('Learn More', 'plumtree').'" rel="bookmark">'.$btn_txt.'</a>';
          $carousel_imgs .= '</figure></div><!--divider-->';
        } else {
          $carousel_imgs .= '<div class="item-wrapper"><figure>';
          $carousel_imgs .= $img;
          $carousel_imgs .= '<figcaption>';
          $carousel_imgs .= '<div class="caption-wrapper">'.$header.$text.'<div class="btn-wrapper">'.$quick_view.$button.'</div></div>';
          $carousel_imgs .= '<div class="vertical-helper"></div></figcaption></figure></div><!--divider-->';
        }

      }
    }

    /* Wrap Carousel Items to slides */
    $items = explode( '<!--divider-->', $carousel_imgs );
    array_pop($items);
    $total = count($items);
    $resulting_items = '';

    if ( $total<(int)$per_slide || (int)$per_slide==1 || $per_slide=='n' ) {
      foreach ($items as $position => $item) {
        $resulting_items .= '<div class="carousel-item">'.$item.'</div>';
      }
      unset($item);
    } else {
      foreach ($items as $position => $item) {
        $current_position = $position + 1;
        if ( ($current_position == 1) || ($current_position % (int)$per_slide == 1) ) {
          $resulting_items .= '<div class="carousel-item">'.$item;
          if ($current_position == $total) {
            $resulting_items .= '</div>';
          }
        } elseif ( $current_position == $total ) {
          $resulting_items .= $item.'</div>';
        } elseif ( $current_position % (int)$per_slide == 0 ) {
          $resulting_items .= $item.'</div>';
        } else {
          $resulting_items .= $item;
        }
      }
      unset($item);
    }

    /* Output Carousel */
    $owlSingleItem = 'false';
    if ($per_slide!='n') {
      $owlSingleItem = 'true';
    }

    $output .= '<div class="'.esc_attr($css_class).'" id="'.$container_id. '">';
    if ( $el_title && $el_title !='' ) { $output .= "<div class='title-wrapper'><h3>{$el_title}</h3>"; }
    if ( $show_arrows == 'true' ) { $output .= "<span class='prev'></span><span class='next'></span>"; }
    if ( $el_title && $el_title !='' ) { $output .= "</div>"; }
    $output .= "<div class='carousel-container per-slide-{$per_slide}'>";
    $output .= $resulting_items;
    $output .= "</div></div>";

    $output.='
      <script type="text/javascript">
        (function($) {
          $(document).ready(function() {
            var owl = $("#'.$container_id.' .carousel-container");

            owl.owlCarousel({
              navigation : false,
              pagination : '.$page_navi.',
              autoPlay   : '.$autoplay.',
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : '.$owlSingleItem.',
              transitionStyle : "'.$transition_type.'",';
              if ($per_slide=='n') {
                $output.= 'items : '.$slides_qty.',
                itemsDesktop : [1199,'.$qty_md.'],
                itemsDesktopSmall : [979,'.$qty_sm.'],
                itemsTablet: [768,'.$qty_xs.'],
                itemsMobile : [479,1],';
              }
 $output.= '});
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
