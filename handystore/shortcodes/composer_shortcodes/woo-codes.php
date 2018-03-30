<?php

if ( class_exists( 'WPBakeryShortCode' ) ) :

add_action( 'vc_before_init', 'handy_woo_codes' );

function handy_woo_codes() {
   vc_map( array(
      'name' => esc_html__( 'Woocommerce Shortcode', 'plumtree' ),
      'description' => esc_html__( 'Add shortcodes with Carousel', 'plumtree' ),
      'base' => 'handy_woo_codes',
      'category' => esc_html__( 'Handy Shortcodes', 'plumtree'),
      'icon' => get_template_directory_uri() . '/images/vc-icon.png',

      'params' => array(
          array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Element Title', 'plumtree' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Enter Element Title', 'plumtree' ),
          ),
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Choose Woocommerce Shortcode', 'plumtree' ),
      			'param_name' => 'codeswoo',
      			'value' => array(
                      esc_html__( 'Recent Products', 'plumtree' ) => 'recent_products',
                      esc_html__( 'Featured Products', 'plumtree' ) => 'featured_products',
                      esc_html__( 'Products by category', 'plumtree' ) => 'product_category',
                      esc_html__( 'Sale Products', 'plumtree' ) => 'sale_products',
                      esc_html__( 'Best Selling Products', 'plumtree' ) => 'best_selling_products',
                      esc_html__( 'Top Rated Products', 'plumtree' ) => 'top_rated_products',
                      esc_html__( 'Product Categories', 'plumtree' ) => 'product_categories',
      			),
      			'description' => '',
      		),
          array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Categorie ID', 'plumtree' ),
            'param_name' => 'cat_id',
            'description' => esc_html__( 'Please enter ID of categorie which products you want to output', 'plumtree' ),
            'dependency' => array(
              'element' => 'codeswoo',
              'value' => array( 'product_category' ),
            ),
          ),
          array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Categories IDs', 'plumtree' ),
            'param_name' => 'cat_ids',
            'description' => esc_html__( 'Please enter IDs of categories which you want to output (comma separated list)', 'plumtree' ),
            'dependency' => array(
              'element' => 'codeswoo',
              'value' => array( 'product_categories' ),
            ),
          ),
          array(
            'type' => 'position',
            'heading' => esc_html__( 'Number of Products/Categories to show', 'plumtree' ),
      			'param_name' => 'items_number',
      			'description' => esc_html__( 'Set the number of items to show', 'plumtree' ),
            'value'=>'',
            'std'=> '5',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
          ),
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Order Parameter', 'plumtree' ),
      			'param_name' => 'order_param',
      			'value' => array(
                      esc_html__( 'Ascending', 'plumtree' ) => 'ASC',
                      esc_html__( 'Descending', 'plumtree' ) => 'DESC',
      			),
      			'std' => 'DESC',
      			'description' => '',
      		),
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Sort Parameter by', 'plumtree' ),
      			'param_name' => 'order_param_by',
      			'value' => array(
      				esc_html__( 'Date', 'plumtree') => 'date',
      				esc_html__( 'Title', 'plumtree') => 'title',
      				esc_html__( 'Name', 'plumtree') => 'name',
      				esc_html__( 'ID', 'plumtree') => 'id',
      				esc_html__( 'Random', 'plumtree') => 'rand',
      			),
      			'description' => '',
      		),
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Columns quantity', 'plumtree' ),
      			'param_name' => 'columns_number',
      			'value' => array(
                esc_html__( '2 Cols', 'plumtree' ) => '2',
                esc_html__( '3 Cols', 'plumtree' ) => '3',
                esc_html__( '4 Cols', 'plumtree' ) => '4',
                esc_html__( '5 Cols', 'plumtree' ) => '5',
                esc_html__( '6 Cols', 'plumtree' ) => '6',
      			),
      			'std' => '',
      			'description' => esc_html__( 'Set Columns quantity', 'plumtree' ),
      		),
      		array(
      			'type' => 'checkbox',
      			'heading' => esc_html__( 'Use Owl Carousel', 'plumtree' ),
      			'param_name' => 'use_slider',
      			'value' => array( esc_html__( 'Yes', 'plumtree' ) => 'true' ),
      			'std' => 'true',
      			'description' => esc_html__( 'Check to add Owl Carousel to products', 'plumtree' ),
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

class WPBakeryShortCode_handy_woo_codes extends WPBakeryShortCode {

 protected function content( $atts, $content = null ) {

   extract( shortcode_atts(array(
			'title' => '',
			'codeswoo' => 'recent_products',
      'cat_id' => '',
      'cat_ids' => '',
			'items_number' => '',
			'use_slider' => 'true',
			'columns_number' => '',
      'order_param_by' => 'date',
			'order_param' => 'DESC',
			'el_class' => '',
			'css' => '',
		), $atts ) );

		$output = '';
    $container_id = '';
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		$container_class = 'pt-woo-shortcode wpb_content_element ' . $el_class . $css_class;
    if ( $columns_number=='2' && (pt_show_layout()!='layout-one-col') ) {
      $qty_sm = $qty_xs = 1;
      $qty_md = 2;
    } elseif ( $columns_number=='2' && (pt_show_layout()=='layout-one-col') ) {
      $qty_sm = 2;
      $qty_xs = 1;
      $qty_md = 2;
    } elseif ( $columns_number!='2' && (pt_show_layout()!='layout-one-col') ) {
      $qty_md = 3;
      $qty_sm = 2;
      $qty_xs = 2;
    } elseif ( $columns_number!='2' && (pt_show_layout()=='layout-one-col') ) {
      $qty_md = $columns_number;
      $qty_sm = 3;
      $qty_xs = 1;
    }
		if ( $use_slider == 'true' ) {
			$container_class = $container_class.' with-slider';
			$container_id = uniqid('owl',false);
		}

		$output = '<div class="'.esc_attr($container_class).'" id="'.esc_attr($container_id).'">';
    $output .= '<div class="title-wrapper"><h3>'.esc_attr($title).'</h3>';
    if ( $use_slider == 'true' ) { $output .= "<div class='slider-navi'><span class='prev'></span><span class='next'></span></div>"; }
    $output .= '</div>';

    if ($codeswoo == 'product_category' && $cat_id != '') {
      $shortcode = '['.esc_attr($codeswoo).' per_page="'.esc_attr($items_number).'" columns="'.esc_attr($columns_number).'" orderby="'.esc_attr($order_param_by).'" order="'.esc_attr($order_param).'" category="'.esc_attr($cat_id).'"]';
    } elseif ($codeswoo == 'product_categories' && $cat_ids != '') {
      $shortcode = '['.esc_attr($codeswoo).' number="'.esc_attr($items_number).'" columns="'.esc_attr($columns_number).'" ids="'.esc_attr($cat_ids).'" orderby="'.esc_attr($order_param_by).'" order="'.esc_attr($order_param).'"]';
    } elseif ($codeswoo == 'best_selling_products') {
      $shortcode = '['.esc_attr($codeswoo).' columns="'.esc_attr($columns_number).'" per_page="'.esc_attr($items_number).'"]';
    } else {
      $shortcode = '['.esc_attr($codeswoo).' per_page="'.esc_attr($items_number).'" columns="'.esc_attr($columns_number).'" orderby="'.esc_attr($order_param_by).'" order="'.esc_attr($order_param).'"]'; }

		$output .= do_shortcode($shortcode);

		$output .= "</div>";

			if ( $use_slider == 'true' ) {
				$output.='
				<script type="text/javascript">
					(function($) {
						$(document).ready(function() {
              var owl = $("#'.esc_attr($container_id).' ul.products");

              owl.owlCarousel({
              items : '.esc_attr($columns_number).',
              itemsDesktop : [1199,'.esc_attr($qty_md).'],
              itemsDesktopSmall : [979,'.esc_attr($qty_sm).'],
              itemsTablet: [768,'.esc_attr($qty_xs).'],
              itemsMobile : [479,1],
              pagination: false,
              navigation : false,
              rewindNav : false,
              scrollPerPage : false,
              });

              // Custom Navigation Events
              $("#'.esc_attr($container_id).'").find(".next").click(function(){
              owl.trigger("owl.next");
              })
              $("#'.esc_attr($container_id).'").find(".prev").click(function(){
              owl.trigger("owl.prev");
              })
						});
					})(jQuery);
				</script>';
			}

		return $output;
	}
}

endif;
