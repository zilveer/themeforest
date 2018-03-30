<?php
/**
 * List products, more interesting layout than then default from the WooCommerce
 *
 * @author 		ProteusThemes
 * @category 	Widgets
 * @package 	Organique
 * @extends 	WC_Widget
 */

function register_widget_organique_products() {
	if ( ! class_exists( 'WC_Widget' ) )
		return;

	class Widget_Organique_Products extends WC_Widget {

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_cssclass    = 'organique-wc widget-products';
			$this->widget_description = _x( 'Widget for the front page.', 'backend', 'organique_wp' );
			$this->widget_id          = false;
			$this->widget_name        = _x( 'Organique: Products', 'backend', 'organique_wp' );
			$this->settings           = array(
				'title' => array(
					'type'    => 'text',
					'std'     => _x( 'Products', 'backend', 'organique_wp' ),
					'label'   => _x( 'Title', 'backend', 'organique_wp' )
				),
				'number' => array(
					'type'    => 'number',
					'step'    => 1,
					'min'     => 1,
					'max'     => '',
					'std'     => 5,
					'label'   => _x( 'Number of products to show', 'backend', 'organique_wp' )
				),
				'show' => array(
					'type'    => 'select',
					'std'     => '',
					'label'   => _x( 'Show', 'backend', 'organique_wp' ),
					'options' => array(
						''         => _x( 'All Products', 'backend', 'organique_wp' ),
						'featured' => _x( 'Featured Products', 'backend', 'organique_wp' ),
						'onsale'   => _x( 'On-sale Products', 'backend', 'organique_wp' ),
					)
				),
				'appearance' => array(
					'type'    => 'select',
					'std'     => '',
					'label'   => _x( 'Show as', 'backend', 'organique_wp' ),
					'options' => array(
						'slider'   => _x( 'Slider', 'backend', 'organique_wp' ),
						'grid'     => _x( 'Grid', 'backend', 'organique_wp' ),
						'list'     => _x( 'List', 'backend', 'organique_wp' ),
					)
				),
				'slider_interval' => array(
					'type'    => 'text',
					'std'     => '5000',
					'label'   => _x( 'Slider interval in ms (1s = 1000ms, set to 0 to disable auto rorate)', 'backend', 'organique_wp' ),
				),
				'orderby' => array(
					'type'    => 'select',
					'std'     => 'date',
					'label'   => _x( 'Order by', 'backend', 'organique_wp' ),
					'options' => array(
						'date'     => _x( 'Date', 'backend', 'organique_wp' ),
						'price'    => _x( 'Price', 'backend', 'organique_wp' ),
						'rand'     => _x( 'Random', 'backend', 'organique_wp' ),
						'sales'    => _x( 'Sales', 'backend', 'organique_wp' ),
					)
				),
				'order' => array(
					'type'    => 'select',
					'std'     => 'desc',
					'label'   => _x( 'Order', 'Sorting order', 'organique_wp' ),
					'options' => array(
						'asc'      => _x( 'ASC', 'backend', 'organique_wp' ),
						'desc'     => _x( 'DESC', 'backend', 'organique_wp' ),
					)
				),
				'hide_free' => array(
					'type'    => 'checkbox',
					'std'     => 0,
					'label'   => _x( 'Hide free products', 'backend', 'organique_wp' )
				),
				'show_hidden' => array(
					'type'    => 'checkbox',
					'std'     => 0,
					'label'   => _x( 'Show hidden products', 'backend', 'organique_wp' )
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

			if ( $this->get_cached_widget( $args ) )
				return;

			ob_start();
			extract( $args );

			$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$number      = absint( $instance['number'] );
			$show        = sanitize_title( $instance['show'] );
			$orderby     = sanitize_title( $instance['orderby'] );
			$order       = sanitize_title( $instance['order'] );
			$show_rating = false;

			$appearance      = sanitize_title( $instance['appearance'] );
			$slider_interval = absint( $instance['slider_interval'] );

			$query_args = array(
				'posts_per_page' => $number,
				'post_status'    => 'publish',
				'post_type'      => 'product',
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

				echo $before_widget;

				if ( 'slider' === $appearance ) {
					$this->slider_output( $title, $widget_id, $r, $slider_interval );
				} else if ( 'grid' === $appearance ) {
					$this->grid_output( $title, $widget_id, $r );
				} else {
					$this->list_output( $title, $widget_id, $r );
				}

				echo $after_widget;
			}

			wp_reset_postdata();

			$content = ob_get_clean();

			echo $content;

			$this->cache_widget( $args, $content );
		}

		/**
		 * Outputs the HTML for the slider layout
		 * @param  wp_query $r
		 * @return void
		 */
		private function slider_output( $title, $widget_id, $r, $slider_interval ) {
			$this->slider_header( $title, $widget_id );
			$this->slider_body( $widget_id, $r, $slider_interval );
		}

		/**
		 * Outputs the HTML for the grid layout
		 * @param  wp_query $r
		 * @return void
		 */
		private function grid_output( $title, $widget_id, $r ) {
			$this->grid_header( $title, $widget_id );
			$this->grid_body( $widget_id, $r );
		}

		/**
		 * Outputs the HTML for the list layout
		 * @param  wp_query $r
		 * @return void
		 */
		private function list_output( $title, $widget_id, $r ) {
			echo '<div class="widgets__navigation">';
			$this->list_header( $title, $widget_id );
			$this->list_body( $widget_id, $r );
			echo '</div>';
		}

		/**
		 * Prints out the title and nav arrows for the slider layout
		 * @param  string $title
		 * @param  string $widget_id
		 * @return void
		 */
		private function slider_header( $title, $widget_id ) {
			if ( $title ) :
			?>

				<!-- Navigation for products -->
				<div class="products-navigation  push-down-15">
					<div class="row">
						<div class="col-xs-12  col-sm-8">
							<div class="products-navigation__title">
								<h3><?php echo $title; ?></h3>
							</div>
						</div>
						<div class="col-xs-12  col-sm-4">
							<div class="products-navigation__arrows">
								<a href="#js--carousel-<?php echo esc_attr( $widget_id ); ?>" data-slide="prev"><span class="glyphicon  glyphicon-chevron-left  glyphicon-circle  products-navigation__arrow"></span></a>&nbsp;
								<a href="#js--carousel-<?php echo esc_attr( $widget_id ); ?>" data-slide="next"><span class="glyphicon  glyphicon-chevron-right  glyphicon-circle  products-navigation__arrow"></span></a>
							</div>
						</div>
					</div>
				</div>

			<?php
				endif;
		}

		/**
		 * Prints out the title for the grid layout
		 * @param  string $title
		 * @param  string $widget_id
		 * @return void
		 */
		private function grid_header( $title, $widget_id ) {
			if ( $title ) :
			?>

			<!-- Navigation -->
			<div class="products-navigation  push-down-15">
				<div class="products-navigation__title">
					<h3><?php echo $title; ?></h3>
				</div>
			</div>

			<?php
				endif;
		}

		/**
		 * Prints out the title for the list layout
		 * @param  string $title
		 * @param  string $widget_id
		 * @return void
		 */
		private function list_header( $title, $widget_id ) {
			if ( $title ) :
			?>

			<div class="widgets__heading--line">
				<h4 class="widgets__heading"><?php echo $title; ?></h4>
			</div>

			<?php
				endif;
		}

		/**
		 * Prints out the body html for the slider layout
		 * @param  string $widget_id
		 * @param  wp_query $r
		 * @return void
		 */
		private function slider_body( $widget_id, $r, $slider_interval ) {
			?>
			<!-- Products -->
			<div id="js--carousel-<?php echo esc_attr( $widget_id ); ?>" class="carousel slide" data-ride="carousel" data-interval="<?php echo $slider_interval > 0 ? $slider_interval : 'false'; ?>">
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<div class="row">

			<?php

				$count = -1;
				while ( $r->have_posts() ) :
					$r->the_post();
					global $product;

					$count++;
					?>

						<?php
							if ( 0 !== $count && 0 === $count % 4) :
						?>
								</div>
							</div>
							<div class="item">
								<div class="row">
						<?php
							elseif ( 0 !== $count && 0 === $count % 2 ) :
						?>
							<div class="clearfix visible-xs"></div>
						<?php
							endif;
						?>

						<div class="col-xs-6  col-sm-3">
							<div class="products__single">
								<figure class="products__image">
									<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog', array( 'class' => 'product__image' ) ); ?></a>
									<div class="product-overlay">
										<a class="product-overlay__more" href="<?php the_permalink(); ?>">
											<span class="glyphicon glyphicon-search"></span>
										</a>
										<?php
											wc_get_template( 'loop/add-to-cart.php' );
										?>
										<div class="product-overlay__stock">
											<span class="<?php echo $product->is_in_stock() ? 'in' : 'out-of'; ?>-stock">&bull;</span> <span class="in-stock--text"><?php echo $product->is_in_stock() ? __( 'In stock', 'organique_wp' ) : __( 'Out of stock', 'organique_wp' ); ?></span>
										</div>
									</div>
								</figure>
								<div class="row">
									<div class="col-xs-12">
										<div class="products__price">
											<a href="<?php the_permalink(); ?>">
												<?php if ( $price_html = $product->get_price_html() ) : ?>
													<?php echo $price_html;?>
												<?php endif; ?>
											</a>
										</div>
										<h5 class="products__title">
											<a class="products__link  js--isotope-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h5>
									</div>
								</div>
								<?php echo $product->get_categories( ', ', '<div class="products__category">', '</div>' ); ?>

							</div>
						</div>

			<?php
				endwhile; // $r->have_posts()
			?>
						</div><!-- .row -->
					</div>
				</div>
			</div>

			<?php
		}

		/**
		 * Prints out the body html for the grid layout
		 * @param  string $widget_id
		 * @param  wp_query $r
		 * @return void
		 */
		private function grid_body( $widget_id, $r ) {
			?>
			<!-- Products -->
			<div class="row">

			<?php

				$count = -1;
				while ( $r->have_posts() ) :
				$r->the_post();
				global $product;

				$count++;
			?>

				<?php
					if ( 0 !== $count && 0 === $count % 4) :
				?>
					</div>
					<div class="row">
				<?php
					elseif ( 0 !== $count && 0 === $count % 2 ) :
				?>
					<div class="clearfix visible-xs"></div>
				<?php
					endif;
				?>

				<div class="col-xs-6 col-sm-3">
					<div class="products__single">
						<figure class="products__image">
							<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog', array( 'class' => 'product__image' ) ); ?></a>
							<div class="product-overlay">
								<a class="product-overlay__more" href="<?php the_permalink(); ?>">
									<span class="glyphicon glyphicon-search"></span>
								</a>
								<?php
									wc_get_template( 'loop/add-to-cart.php' );
								?>
								<div class="product-overlay__stock">
									<span class="<?php echo $product->is_in_stock() ? 'in' : 'out-of'; ?>-stock">&bull;</span> <span class="in-stock--text"><?php echo $product->is_in_stock() ? __( 'In stock', 'organique_wp' ) : __( 'Out of stock', 'organique_wp' ); ?></span>
								</div>
							</div>
						</figure>
						<div class="row">
							<div class="col-xs-12">
								<div class="products__price">
									<a href="<?php the_permalink(); ?>">
										<?php if ( $price_html = $product->get_price_html() ) : ?>
											<?php echo $price_html;?>
										<?php endif; ?>
									</a>
								</div>
								<h5 class="products__title">
									<a class="products__link  js--isotope-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h5>
							</div>
						</div>
						<?php echo $product->get_categories( ', ', '<div class="products__category">', '</div>' ); ?>
					</div>
				</div>

				<?php
					endwhile; // $r->have_posts()
				?>
			</div><!-- .row -->

			<?php
		}

		/**
		 * Prints out the body html for the list layout
		 * @param  string $widget_id
		 * @param  wp_query $r
		 * @return void
		 */
		private function list_body( $widget_id, $r ) {

			while ( $r->have_posts() ) :
				$r->the_post();
				global $product;

			?>

			<div class="clearfix  push-down-15">
				<a href="<?php the_permalink(); ?>">
					<?php echo get_the_post_thumbnail( get_the_ID(), 'shop_thumbnail', array( 'class' => 'widgets__products' ) ); ?>
				</a>
				<div class="products__title">
					<a class="products__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<div class="products__price--widgets">
					<?php if ( $price_html = $product->get_price_html() ) : ?>
						<?php echo $price_html; ?>
					<?php endif; ?>
				</div>
				<br>

				<?php echo $product->get_categories( ', ', '<div class="products__category">', '</div>' ); ?>
			</div>

			<?php

			endwhile; // $r->have_posts()

		}
	}
	register_widget( 'Widget_Organique_Products' );
}

add_action( 'widgets_init', 'register_widget_organique_products', 12 );