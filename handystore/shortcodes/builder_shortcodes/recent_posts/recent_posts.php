<?php


if ( ! class_exists( 'IG_Recent_Posts' ) ) {

	class IG_Recent_Posts extends IG_Pb_Shortcode_Parent {

		public function __construct() {
			parent::__construct();
		}

		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['name']      = esc_html__( 'PT Recent Posts', 'plumtree' );
			$this->config['exception'] = array(
				'default_content'  => esc_html__( 'Recent Posts', 'plumtree' ),
				'data-modal-title' => esc_html__( 'Recent Posts', 'plumtree' ),
			);
            $this->config['edit_using_ajax'] = true;
		}

		public function element_items() {
			$this->items = array(
				'content' => array(
					array(
						'name'    => esc_html__( 'Element Title', 'plumtree' ),
						'id'      => 'el_title',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '',
						'role'    => 'title',
					),
					array(
						'name'       => esc_html__( 'Posts per row', 'plumtree' ),
						'id'         => 'per_row',
						'type'       => 'select',
						'std'        => '3',
						'options'    => array('3' => esc_html__( '3 Posts', 'plumtree' ), '4' => esc_html__( '4 Posts', 'plumtree' )),
					),
					array(
						'name'       => esc_html__( 'Total number of Posts to show', 'plumtree' ),
						'id'         => 'posts_qty',
						'type'       => 'text_append',
						'type_input' => 'number',
						'std'        => '',
					),
					array(
                        'name'    => esc_html__( 'Orderby Parameter', 'plumtree' ),
                        'id'      => 'orderby',
                        'type'    => 'select',
                        'std'     => 'date',
                        'options' => array(
                            'date' => esc_html__( 'Date', 'plumtree' ),
                            'rand' => esc_html__( 'Random', 'plumtree' ),
                            'author' => esc_html__( 'Author', 'plumtree' ),
                            'comment_count' => esc_html__( 'Comments Quantity', 'plumtree' ),
                        ),
                    ),
					array(
                        'name'    => esc_html__( 'Order Parameter', 'plumtree' ),
                        'id'      => 'order',
                        'type'    => 'select',
                        'std'     => 'ASC',
                        'options' => array(
                            'ASC' => esc_html__( 'Ascending', 'plumtree' ),
                            'DESC' => esc_html__( 'Descending', 'plumtree' ),
                        ),
                    ),
					array(
						'name'    => esc_html__( 'Posts by Category slug', 'plumtree' ),
						'id'      => 'category',
						'type'    => 'text_field',
						'class'   => 'jsn-input-xxlarge-fluid',
						'std'     => '',
						'tooltip' => esc_html__( 'Enter specific category if needed', 'plumtree' ),
					),
				),

				'styling' => array(
					array(
						'name' => esc_html__( 'Use Owl Carousel?', 'plumtree' ),
						'id' => 'use_slider',
						'type' => 'radio',
						'std' => 'no',
						'options' => array( 'yes' => esc_html__( 'Yes', 'plumtree' ), 'no' => esc_html__( 'No', 'plumtree' ) ),
						'tooltip' => esc_html__( 'Show or not linked button above banner', 'plumtree' ),
						'has_depend' => '1',
					),
					array(
						'name'    => esc_html__( 'Elements', 'plumtree' ),
						'id'      => 'elements',
						'type'    => 'items_list',
						'std'     => 'post_thumb__#__title__#__excerpt__#__buttons',
						'options' => array(
							'post_thumb' => esc_html__( 'Featured Image', 'plumtree' ),
							'title'   => esc_html__( 'Title with Meta Data', 'plumtree' ),
							'excerpt' => esc_html__( 'Post Excerpt', 'plumtree' ),
							'buttons'  => esc_html__( 'Buttons', 'plumtree' )
						),
						'options_type'    => 'checkbox',
						'popover_items'   => array( 'title', 'button' ),
						'tooltip'         => esc_html__( 'Select elements which you want to display', 'plumtree' ),
						'style'           => array( 'height' => '200px' ),
						'container_class' => 'unsortable',
					),
					array(
						'name' => esc_html__( 'Add "lazyload" to this element?', 'plumtree' ),
						'id' => 'lazyload',
						'type' => 'radio',
						'std' => 'no',
						'options' => array( 'yes' => esc_html__( 'Yes', 'plumtree' ), 'no' => esc_html__( 'No', 'plumtree' ) ),
					),
				)
			);
		}

		public function element_shortcode_full( $atts = null, $content = null ) {
			$html_output = '';
			$lazy_param = '';
			$arr_params     = shortcode_atts( $this->config['params'], $atts );
			extract( $arr_params );

			$elements = explode( '__#__', $elements );
			$use_slider = $arr_params['use_slider'];

			$container_class = 'pt-posts-shortcode '.$css_suffix;
			if ( $use_slider == 'yes' ) {
				$container_class = $container_class.' with-slider';
				$container_id = uniqid('owl',false);
			}
			if ($arr_params['lazyload'] == 'yes') {	$lazy_param = ' data-expand="-100"'; $container_class = $container_class.' lazyload'; }
			$container_class = ( ! empty( $container_class ) ) ? ' class="' . $container_class . '"' : '';

			$html_output = "<div{$container_class} id='{$container_id}'{$lazy_param}>";
			$html_output .= "<div class='title-wrapper'><h3>{$el_title}</h3>";
			if ( $use_slider == 'yes' ) { $html_output .= "<div class='slider-navi'><span class='prev'></span><span class='next'></span></div>"; }
			$html_output .= "</div>";

			// Atts for post query
			if ( in_array( 'post_thumb', $elements ) ) { $show_thumb = true; } else { $show_thumb = false; }
			if ( in_array( 'title', $elements ) ) { $show_title = true; } else { $show_title = false; }
			if ( in_array( 'excerpt', $elements ) ) { $show_excerpt = true; } else { $show_excerpt = false; }
			if ( in_array( 'buttons', $elements ) ) { $show_buttons = true; } else { $show_buttons = false; }

			$html = '';

			// Excerpt filters
			$new_excerpt_more = create_function('$more', 'return " ";');
			add_filter('excerpt_more', $new_excerpt_more);

			$new_excerpt_length = create_function('$length', 'return "25";');
			add_filter('excerpt_length', $new_excerpt_length);

			// The Query
			$the_query = new WP_Query(
				array(
					'orderby' => $orderby,
					'order' => $order,
					'category_name' => $category,
					'post_type' => 'post',
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => $posts_qty,
				)
			);

			$html = '<ul class="post-list columns-'.esc_attr($per_row).'">';
			while( $the_query->have_posts() ) : $the_query->the_post();
				$html .= "<li class='post'>";

						if ( $show_thumb && has_post_thumbnail() ) {
							$html .= "<div class='thumb-wrapper'>";
							$html .= '<a class="posts-img-link" rel="bookmark" href="'.esc_url(get_permalink(get_the_ID())).'" title="'.__( 'Click to learn more', 'plumtree').'">';
							$html .= get_the_post_thumbnail(get_the_ID(), 'pt-recent-posts-thumb');
							$html .= '</a></div>';
						}

						$html .= '<div class="item-content">';

							if ( $show_title ) {
								$html .= '<h3>'.get_the_title(get_the_ID()).'</h3>';
								$html .= '<div class="meta-data"><span class="author">'.__('By ', 'plumtree').'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">'.get_the_author().'</a></span>';
								$html .= '<span class="date">'.get_the_date().'</span></div>';
							}

							if ( $show_excerpt ) {
								$html .= '<div class="entry-excerpt">'.get_the_excerpt().'</div>';
							}

							if ( $show_buttons ) {
								$html .= '<div class="buttons-wrapper">';
								$html .= '<div class="comments-qty"><i class="fa fa-comments"></i>('.get_comments_number(get_the_ID()).')</div>';
								if (function_exists('pt_output_likes_counter')) {
									$html .= pt_output_likes_counter(get_the_ID());
								}
								$html .= '<div class="link-to-post"><a rel="bookmark" href="'.esc_url(get_permalink(get_the_ID())).'" title="'.__( 'Click to learn more', 'plumtree').'"><i class="fa fa-chevron-right"></i></a></div>';
								$html .= '</div>';
							}

						$html .= '</div>';

				$html .= "</li>";
			endwhile;
			wp_reset_postdata();
			$html .= '</ul>';

			if ($html && $html !='') {
				$html_output .= $html;
			}

	    $html_output .= '</div>';

	    if ( $use_slider == 'yes' ) {
		    if ( pt_show_layout()=='layout-one-col' && $per_row==4 ) {
					$qty_sm = 3;
				} else {
					$qty_sm = $per_row-2;
				}

				$html_output.='
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

			return $this->element_wrapper( $html_output, $arr_params );
		}

	}

}
