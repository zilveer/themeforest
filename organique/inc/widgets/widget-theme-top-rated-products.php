<?php
/**
 * Top Rated Products Widget
 *
 * Gets and displays top rated products in an unordered list
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.1.0
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function register_widget_organique_top_rated_products() {
	if ( ! class_exists( 'WC_Widget' ) )
		return;

	class Organique_Top_Rated_Products extends WC_Widget {

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_cssclass    = 'organique-wp widget-products';
			$this->widget_description = _x( 'Display a list of your top rated products on your site.', 'backend', 'organique_wp' );
			$this->widget_id          = false;
			$this->widget_name        = _x( 'Organique: Top Rated Products', 'backend', 'organique_wp' );
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'std'   => _x( 'Top Rated Products', 'backend', 'organique_wp' ),
					'label' => _x( 'Title', 'backend', 'organique_wp' )
				),
				'number' => array(
					'type'  => 'number',
					'step'  => 1,
					'min'   => 1,
					'max'   => '',
					'std'   => 5,
					'label' => _x( 'Number of products to show', 'backend', 'organique_wp' )
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
		public function widget($args, $instance) {

			if ( $this->get_cached_widget( $args ) )
				return;

			ob_start();
			extract( $args );

			$title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$number = absint( $instance['number'] );

			add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );

			$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

			$query_args['meta_query'] = WC()->query->get_meta_query();

			$r = new WP_Query( $query_args );

			if ( $r->have_posts() ) {

				echo $before_widget;

				if ( $title ) :
				?>

				<div class="widgets__navigation">
					<div class="widgets__heading--line">
						<h4 class="widgets__heading"><?php echo $title; ?></h4>
					</div>
				<?php
					endif;

				while ( $r->have_posts() ) {
					$r->the_post();
					global $product;

					$rating = round( $product->get_average_rating() );

					?>
					<div class="push-down-20  clearfix">
						<a href="<?php the_permalink(); ?>">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'shop_thumbnail', array( 'class' => 'widgets__products' ) ); ?>
						</a>
						<h5 class="products__title">
							<a class="products__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h5>
						<div class="products__price--widgets">
							<?php if ( $price_html = $product->get_price_html() ) : ?>
								<?php echo $price_html; ?>
							<?php endif; ?>
						</div>
						<br>

						<div class="widgets__rating">
							<?php
								for ($i=1; $i <= 5; $i++) :
							?>
							<span class="glyphicon glyphicon-star  <?php echo $i <= $rating ? 'star-on' : 'star-off'; ?>"></span>
							<?php
								endfor;
							?>
						</div>

					</div>
					<?php
				}

				echo '</div>';

				echo $after_widget;
			}

			remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );

			wp_reset_postdata();

			$content = ob_get_clean();

			echo $content;

			$this->cache_widget( $args, $content );
		}
	}

	register_widget( 'Organique_Top_Rated_Products' );
}

add_action( 'widgets_init', 'register_widget_organique_top_rated_products', 12 );