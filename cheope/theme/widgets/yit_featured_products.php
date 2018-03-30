<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
class yit_featured_products extends WP_Widget {
	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		/* Widget variable settings. */
		$this->woo_widget_idbase = 'yit_featured_products';

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'yit_featured_products', 'description' => __( 'Display a list of featured products on your site.', 'yit' ) );

		/* Create the widget. */
		WP_Widget::__construct('yit-featured-products', 'Featured Products', $widget_ops);
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
	function widget($args, $instance) {
		global $woocommerce;

		ob_start();
		extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Featured Products', 'yit') : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
        
        $query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

		$query_args['meta_query'] = array();

		$query_args['meta_query'][] = array(
			'key' => '_featured',
			'value' => 'yes'
		);
	    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	    $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();

		$r = new WP_Query($query_args);

		if ($r->have_posts()) : ?>

		<?php echo $before_widget; ?>
        <div class="featured-products-widget">
         <?php if ( $title ) echo $before_title . $title . $after_title; ?>
    		<ul class="products-slider featured-products-slider slides">
    		<?php while ($r->have_posts()) : $r->the_post(); global $product; ?>
    
    		<li>
    			<?php if( has_post_thumbnail() ) : ?>
                    <?php if( $instance['link_thumbnail'] ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $r->post->ID ) ); ?>" title="<?php echo esc_attr($r->post->post_title ? $r->post->post_title : $r->post->ID); ?>">
                            <?php the_post_thumbnail( 'featured_products_slider' ) ?>
                        </a>
                    <?php else : ?>
                        <?php the_post_thumbnail( 'featured_products_slider' ) ?>
                    <?php endif ?>
                <?php endif ?>
    			<a href="<?php echo esc_url( get_permalink( $r->post->ID ) ); ?>" title="<?php echo esc_attr($r->post->post_title ? $r->post->post_title : $r->post->ID); ?>">
                    <?php if ( $r->post->post_title ) echo get_the_title( $r->post->ID ); else echo $r->post->ID; ?>
                </a>
	            <?php echo $product->get_price_html(); ?>
            </li>
    
    		<?php endwhile; ?>
    		</ul>
        </div>
		<?php echo $after_widget; ?>

		<?php endif;

		$content = ob_get_clean();
        
        $slider_fx = isset( $slider_fx ) ? $slider_fx : 'fade';
        $slider_speed_fx = isset( $slider_speed_fx ) ? $slider_speed_fx : 300;
        $slider_timeout_fx = isset( $slider_timeout_fx ) ? $slider_timeout_fx : 8000;
        
        $script = '<script type="text/javascript">
		                jQuery(document).ready(function($){
		                	var animation = $.browser.msie || $.browser.opera ? "fade" : "' . $slider_fx . '";
		                    $(".featured-products-widget").flexslider({
		                        animation: animation,
		                        slideshowSpeed: ' . $slider_timeout_fx . ',
		                        animationSpeed: ' . $slider_speed_fx . ',
		                        selectors: ".slides > li",
		                        directionNav: true,
		                        slideshow: true,

						        pauseOnAction: false,
						        controlNav: false,
						        touch: true
		                    });
		                });
		            </script>';

		if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

		echo $content, $script;


        wp_reset_postdata();
	}


	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['slider_fx'] = $new_instance['slider_fx'];   
        $instance['slider_timeout_fx'] = $new_instance['slider_timeout_fx'];
        $instance['slider_speed_fx'] = $new_instance['slider_speed_fx'];    
        $instance['link_thumbnail'] = $new_instance['link_thumbnail'];

		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		$defaults = array(
            'title' => '',
            'number' => 2,
            'slider_fx' => 'slide', 
            'slider_timeout_fx' => 8000,  
            'slider_speed_fx' => 300,
            'link_thumbnail' => 0
        );
        
        $instance = wp_parse_args( $instance, $defaults );
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'yit'); ?>:</label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of products to show', 'yit'); ?>:</label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" size="3" /></p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'slider_fx' ); ?>"><?php _e( 'Slider effect', 'yit' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'slider_fx' ); ?>" name="<?php echo $this->get_field_name( 'slider_fx' ); ?>">
                    <option value="slide" <?php selected( $instance['slider_fx'], 'slide' ) ?>>slide</option>
                    <option value="fade" <?php selected( $instance['slider_fx'], 'fade' ) ?>>fade</option>
                 </select>
            </label>
        </p>          

        
        <p>
            <label for="<?php echo $this->get_field_id( 'slider_timeout_fx' ); ?>"><?php _e( 'Timeout (ms)', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'slider_timeout_fx' ); ?>" name="<?php echo $this->get_field_name( 'slider_timeout_fx' ); ?>" value="<?php echo $instance['slider_timeout_fx']; ?>" size="4" />
            </label>
        </p>          


        <p>
            <label for="<?php echo $this->get_field_id( 'slider_speed_fx' ); ?>"><?php _e( 'Animation speed (ms)', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'slider_speed_fx' ); ?>" name="<?php echo $this->get_field_name( 'slider_speed_fx' ); ?>" value="<?php echo $instance['slider_speed_fx']; ?>" size="4" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'link_thumbnail' ); ?>">
                 <input type="checkbox" id="<?php echo $this->get_field_id( 'link_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'link_thumbnail' ); ?>" value="1" <?php checked( $instance['link_thumbnail'], 1 ) ?> />
                 <?php _e( 'Link thumbnail', 'yit' ) ?>
            </label>
        </p>
<?php
	}
}