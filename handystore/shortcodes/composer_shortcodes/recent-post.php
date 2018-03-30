<?php
if ( class_exists( 'WPBakeryShortCode' ) ) :

add_action( 'vc_before_init', 'handy_recent_post' );

function handy_recent_post(){

  vc_map( array(
      "name" => esc_html__( 'Recent Posts', 'plumtree' ),
      "base" => "handy_recent_post",
			'category' => esc_html__( 'Handy Shortcodes', 'plumtree'),
  	  "description" => esc_html__( 'Output Carousel with Recent Posts', 'plumtree' ),
  		'icon' => get_template_directory_uri() . '/images/vc-icon.png',

      "params" => array(
    			array(
    				'type' => 'textfield',
    				'heading' => esc_html__( 'Element Title', 'plumtree' ),
    				'param_name' => 'el_title',
    			),
    			array(
    				'type' => 'dropdown',
    				'heading' => esc_html__( 'Posts per row', 'plumtree' ),
    				'param_name' => 'per_row',
    				'value' => array(
    						'3 Posts' => '3',
    						'4 Posts' => '4',
    					),
    				'std'=> '3',
    			),
    			array(
    				'type' => 'position',
    				'heading' => esc_html__( 'Total number of Posts to show', 'plumtree' ),
    				'param_name' => 'number_recent_post',
    				'std' =>'5',
    			),
    			array(
    				'type' => 'dropdown',
    				'heading' => esc_html__( 'Orderby Parameter', 'plumtree' ),
    				'param_name' => 'recent_orderby',
    				'value' => array(
    						esc_html__( 'Date', 'plumtree' ) => 'date' ,
                esc_html__( 'Random', 'plumtree' ) => 'rand',
                esc_html__( 'Author', 'plumtree' ) => 'author',
                esc_html__( 'Comments Quantity', 'plumtree' ) => 'comment_count',
    					),
    				'std'=> 'date',
    			),
    			array(
    				'type' => 'dropdown',
    				'heading' => esc_html__( 'Order Parameter', 'plumtree' ),
    				'param_name' => 'order_param',
    				'value' => array(
                  esc_html__( 'Ascending', 'plumtree' ) => 'ASC',
                  esc_html__( 'Descending', 'plumtree' ) => 'DESC',
    					),
    				'std'=> 'DESC',
    			),
    			array(
    				'type' => 'textfield',
    				'heading' => esc_html__( 'Posts by Category slug', 'plumtree' ),
    				'param_name' => 'by_category',
    			),
    			array(
    				'type' => 'checkbox',
    				'heading' => esc_html__( 'Use Owl Carousel?', 'plumtree' ),
    				'param_name' => 'owl_carousel',
    				'edit_field_class' => 'vc_col-sm-3 vc_column',
    				'std' => 'true',
    			),
    			array(
    				'type' => 'checkbox',
    				'heading' => esc_html__( 'Turn On autoplay', 'plumtree' ),
    				'param_name' => 'autoplay',
    				'edit_field_class' => 'vc_col-sm-3 vc_column',
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

class WPBakeryShortCode_handy_recent_post extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'el_title'           => '',
			'per_row' 			     => '3',
			'number_recent_post' => '5',
			'recent_orderby' 	   => 'date',
			'order_param' 		   => 'DESC',
			'by_category' 		   => '',
			'owl_carousel'		   => 'true',
			'autoplay' 			     => 'false',
			'el_class'    		   => '',
			'css'         		   => '',
		), $atts ) );

    $output = '';
		$container_id = uniqid('owl',false);
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

    // Excerpt filters
    $new_excerpt_more = create_function('$more', 'return " ";');
    add_filter('excerpt_more', $new_excerpt_more);

    $new_excerpt_length = create_function('$length', 'return "25";');
    add_filter('excerpt_length', $new_excerpt_length);

    $the_query = new WP_Query(
      array(
        'orderby' => $recent_orderby,
        'order' => $order_param,
        'category_name' => $by_category,
        'post_type' => 'post',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => $number_recent_post,
      )
    );

    if ($the_query->have_posts()) {

      $container_class = 'pt-posts-shortcode ';
      if ( $owl_carousel == 'true' ) {
        $container_class = $container_class.'with-slider ';
      }

    $output .= '<div class="wpb_content_element '.$container_class.$el_class.' '.$css_class.'" id="'.$container_id.'">';
    $output .= "<div class='title-wrapper'><h3>{$el_title}</h3>";
    if ( $owl_carousel == 'true' ) { $output .= "<div class='slider-navi'><span class='prev'></span><span class='next'></span></div>"; }
    $output .= "</div>";

    $output .= '<ul class="post-list columns-'.esc_attr($per_row).'">';
    while( $the_query->have_posts() ) : $the_query->the_post();
      $output .= "<li class='post'>";

          if ( has_post_thumbnail() ) {
            $output .= "<div class='thumb-wrapper'>";
            $output .= '<a class="posts-img-link" rel="bookmark" href="'.esc_url(get_permalink(get_the_ID())).'" title="'.__( 'Click to learn more', 'plumtree').'">';
            $output .= get_the_post_thumbnail(get_the_ID(), 'pt-recent-posts-thumb');
            $output .= '</a></div>';
          }

          $output .= '<div class="item-content">';
          $output .= '<h3>'.get_the_title(get_the_ID()).'</h3>';
          $output .= '<div class="meta-data"><span class="author">'.__('By ', 'plumtree').'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">'.get_the_author().'</a></span>';
          $output .= '<span class="date">'.get_the_date().'</span></div>';
          $output .= '<div class="entry-excerpt">'.get_the_excerpt().'</div>';
          $output .= '<div class="buttons-wrapper">';
          $output .= '<div class="comments-qty"><i class="fa fa-comments"></i>('.get_comments_number(get_the_ID()).')</div>';
          if (function_exists('pt_output_likes_counter')) {
             $output .= pt_output_likes_counter(get_the_ID());
          }
          $output .= '<div class="link-to-post"><a rel="bookmark" href="'.esc_url(get_permalink(get_the_ID())).'" title="'.__( 'Click to learn more', 'plumtree').'"><i class="fa fa-chevron-right"></i></a></div>';
          $output .= '</div>';
          $output .= '</div>';

      $output .= "</li>";
    endwhile;
    wp_reset_postdata();
    $output .= '</ul>';
    $output .= '</div>';

    if ( $owl_carousel == 'true' ) {
      if ( pt_show_layout()=='layout-one-col' && $per_row==4 ) {
        $qty_sm = 3;
      } else {
        $qty_sm = $per_row-2;
      }

      $output.='
      <script type="text/javascript">
        (function($) {
          $(document).ready(function() {
            var owl = $("#'.$container_id.' ul.post-list");

            owl.owlCarousel({
            items : '.$per_row.',
            itemsDesktop : '.$per_row.',
            itemsDesktopSmall : [900,'.($per_row-1).'],
            itemsTablet: [600,'.$qty_sm.'],
            itemsMobile : [479,1],
            pagination: false,
            navigation : false,
            autoPlay   : '.$autoplay.',
            rewindNav : false,
            scrollPerPage : false,
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
    }

		return $output;
	  }
  }
}

endif;
