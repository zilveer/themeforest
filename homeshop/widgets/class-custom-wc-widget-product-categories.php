<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Product Categories Widget.
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */

class Custom_WC_Widget_Product_Categories extends WC_Widget {

	public $cat_ancestors;
	public $current_cat;


	/**
	 * Constructor
	 */
	public function __construct() {

		$this->widget_cssclass    = 'woocommerce widget_product_categories widget_product_categories_custom';
		$this->widget_description = __( 'A list or dropdown of product categories.', 'homeshop' );
		$this->widget_id          = 'custom_woocommerce_product_categories';
		$this->widget_name        = 'homeshop'.' - '.__( 'WooCommerce Product Categories', 'homeshop' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Product Categories', 'homeshop' ),
				'label' => __( 'Title', 'homeshop' )
			),
			'icon' => array(
				'type'  => 'select',
				'std'   => 'icon-folder-open-empty',
				'label' => __( 'Select Icon', 'homeshop' ),
				'options' => wm_fontello_classes(),
			),
			'color' => array(
				'type'  => 'select',
				'std'   => 'red',
				'label' => __( 'Select Color', 'homeshop' ),
				'options' => array(
					'default' => __( 'Default', 'homeshop' ),
					'red' => __( 'Red', 'homeshop' ),
					'green' => __( 'Green', 'homeshop' ),
					'blue' => __( 'Blue', 'homeshop' ),
					'orange' => __( 'Orange', 'homeshop' ),
					'purple'  => __( 'Purple', 'homeshop' )
				)
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'name',
				'label' => __( 'Order by', 'homeshop' ),
				'options' => array(
					'order' => __( 'Category Order', 'homeshop' ),
					'name'  => __( 'Name', 'homeshop' )
				)
			),
			'dropdown' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show as dropdown', 'homeshop' )
			),
			'count' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show post counts', 'homeshop' )
			),
			'hierarchical' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Show hierarchy', 'homeshop' )
			),
			'show_children_only' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Only show children of the current category', 'homeshop' )
			),
			'show_parent_only' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Only show parent category', 'homeshop' )
			),
			'hide_empty' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide empty categories', 'homeshop' )
			),
			'cat_exclude'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'ID  exclude', 'homeshop' )
			)
			
		);
		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {
		global $wp_query, $post;

		$title         = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$c             = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
		
		$color             =  $instance['color'] ;
		$icon             =  $instance['icon'] ;
		
		$h             = isset( $instance['hierarchical'] ) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
		$s             = isset( $instance['show_children_only'] ) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
		$p             = ! empty( $instance['show_parent_only'] );
		$d             = isset( $instance['dropdown'] ) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
		$o             = $instance['orderby'] ? $instance['orderby'] : 'order';
		$hide_empty         = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
		$dropdown_args = array( 'hide_empty' => $hide_empty );
		$list_args     = array( 'show_count' => $c, 'hierarchical' => $h, 'taxonomy' => 'product_cat', 'hide_empty' => $hide_empty );

		
		$cat_exclude = '';
		if(! empty( $instance['cat_exclude'] )) {
		$cat_exclude = $instance['cat_exclude'];
		}
		
		// Menu Order
		$list_args['menu_order'] = false;
		if ( $o == 'order' ) {
			$list_args['menu_order'] = 'asc';
		} else {
			$list_args['orderby']    = 'title';
		}
		
		// Setup Current Category
		$this->current_cat   = false;
		$this->cat_ancestors = array();

		if ( is_tax('product_cat') ) {

			$this->current_cat   = $wp_query->queried_object;
			$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );

		} elseif ( is_singular('product') ) {

			$product_category = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent' ) );

			if ( $product_category ) {
				$this->current_cat   = end( $product_category );
				$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
			}

		}
		
		// Show Siblings and Children Only
		if ( $s && $this->current_cat ) {

			// Top level is needed
			$top_level = get_terms( 
				'product_cat', 
				array( 
					'fields'       => 'ids', 
					'parent'       => 0, 
					'hierarchical' => true, 
					'hide_empty'   => false
				) 
			);

			// Direct children are wanted
			$direct_children = get_terms( 
				'product_cat', 
				array( 
					'fields'       => 'ids', 
					'parent'       => $this->current_cat->term_id, 
					'hierarchical' => true, 
					'hide_empty'   => false 
				) 
			);
			
			// Gather siblings of ancestors
			$siblings  = array();
			if ( $this->cat_ancestors ) {
				foreach ( $this->cat_ancestors as $ancestor ) {
					$ancestor_siblings = get_terms( 
						'product_cat', 
						array( 
							'fields'       => 'ids', 
							'parent'       => $ancestor, 
							'hierarchical' => false, 
							'hide_empty'   => false 
						)
					);
					$siblings = array_merge( $siblings, $ancestor_siblings );
				}
			}

			if ( $h ) {
				$include = array_merge( $top_level, $this->cat_ancestors, $siblings, $direct_children, array( $this->current_cat->term_id ) );
			} else {
				$include = array_merge( $direct_children );
			}
			
			$dropdown_args['include'] = implode( ',', $include );
			$list_args['include']     = implode( ',', $include );

			if ( empty( $include ) ) {
				return;
			}
			
		} elseif ( $s ) {
			$dropdown_args['depth']        = 1;
			$dropdown_args['child_of']     = 0;
			$dropdown_args['hierarchical'] = 1;
			$list_args['depth']            = 1;
			$list_args['child_of']         = 0;
			$list_args['hierarchical']     = 1;
		}

		
		
		
		if ( $p ) {
			$dropdown_args['depth']        = 1;
			$dropdown_args['child_of']     = 0;
			$dropdown_args['hierarchical'] = 1;
			$list_args['depth']            = 1;
			$list_args['child_of']         = 0;
			$list_args['hierarchical']     = 1;
		}
		
		//echo $before_widget;

		
		
		echo '<div class="row sidebar-box '. esc_html($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_html($icon) .'"></i>
					<h4>'. $title .'</h4>
				</div>';
				
				
				
				
		
		// Dropdown
		if ( $d ) {
		
			echo '<div class="sidebar-box-content sidebar-padding-box">';
			
			
			$dropdown_defaults = array(
				'show_counts'        => $c,
				'hierarchical'       => $h,
				'show_uncategorized' => 0,
				'orderby'            => $o,
				'exclude'            => $cat_exclude,
				'selected'           => $this->current_cat ? $this->current_cat->slug : ''
			);
			$dropdown_args = wp_parse_args( $dropdown_args, $dropdown_defaults );

			// Stuck with this until a fix for http://core.trac.wordpress.org/ticket/13258
			wc_product_dropdown_categories( apply_filters( 'woocommerce_product_categories_widget_dropdown_args', $dropdown_args ) );
			
			
			wc_enqueue_js( "
				jQuery( '.dropdown_product_cat' ).change( function() {
					if ( jQuery(this).val() != '' ) {
						var this_page = '';
						var home_url  = '" . esc_js( home_url( '/' ) ) . "';
						if ( home_url.indexOf( '?' ) > 0 ) {
							this_page = home_url + '&product_cat=' + jQuery(this).val();
						} else {
							this_page = home_url + '?product_cat=' + jQuery(this).val();
						}
						location.href = this_page;
					}
				});
			" );
			

		// List
		} else {

		echo '<div class="sidebar-box-content">';

			
			$list_args['walker']                     = new WC_Product_Cat_List_Walker1;
			$list_args['title_li']                   = '';
			$list_args['pad_counts']                 = 1;
			$list_args['show_option_none']           = __('No product categories exist.', 'homeshop' );
			$list_args['current_category']           = ( $this->current_cat ) ? $this->current_cat->term_id : '';
			$list_args['current_category_ancestors'] = $this->cat_ancestors;

			
			$list_args['exclude'] = $cat_exclude;
			
			echo '<ul>';

		
			
			wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $list_args ) );

			echo '</ul>';
		}

		echo '</div>
                </div>		
				</div>';
	}
}


if ( ! class_exists( 'WC_Product_Cat_List_Walker' ) ) :
class WC_Product_Cat_List_Walker1 extends Walker {

	/**
	 * What the class handles.
	 *
	 * @var string
	 */
	public $tree_type = 'product_cat';

	/**
	 * DB fields to use.
	 *
	 * @var array
	 */
	public $db_fields = array(
		'parent' => 'parent',
		'id'     => 'term_id',
		'slug'   => 'slug'
	);
	
	
	/**
	 * @see Walker::start_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of category. Used for tab indentation.
	 * @param array $args Will only append content if style argument value is 'list'.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children sidebar-dropdown  hidden-xs'><li><ul>\n";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of category. Used for tab indentation.
	 * @param array $args Will only append content if style argument value is 'list'.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></li></ul>\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int $depth Depth of category in reference to parents.
	 * @param integer $current_object_id
	 */
	public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$output .= '<li class="cat-item cat-item-' . $cat->term_id;

		if ( $args['current_category'] == $cat->term_id ) {
			$output .= ' current-cat';
		}

		if ( $args['has_children'] && $args['hierarchical'] ) {
			$output .= ' cat-parent';
		}

		if ( $args['current_category_ancestors'] && $args['current_category'] && in_array( $cat->term_id, $args['current_category_ancestors'] ) ) {
			$output .= ' current-cat-parent';
		}

		$count_cat = '';
		if ( $args['show_count'] ) {
		$count_cat = '('. $cat->count .')';
		}
		
		
		
		$output .=  '"><a href="' . get_term_link( (int) $cat->term_id, $this->tree_type ) . '">' .  _x( $cat->name, 'product category name', 'homeshop' ) . ' '. $count_cat .'<i class="icons icon-right-dir"></i></a>';

		
	}

	/**
	 * @see Walker::end_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page Not used.
	 * @param int $depth Depth of category. Not used.
	 * @param array $args Only uses 'list' for whether should append to output.
	 */
	public function end_el( &$output, $cat, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth. It is possible to set the
	 * max depth to include all depths, see walk() method.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		if ( ! $element || ( 0 === $element->count && ! empty( $args['hide_empty'] ) ) ) {
			return;
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

endif;
