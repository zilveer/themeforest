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

if( !class_exists( 'search_mini' ) ) :
/**
 * Search widget class
 *
 * @since 2.8.0
 */
class search_mini extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_search_mini', 'description' => __( "A mini search form for your site", 'yit' ) );
		parent::__construct('search_mini', __( 'Mini Search', 'yit' ), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);

		echo $before_widget;
        
        $search_type = yit_get_option('search_type');
        if ( ! is_shop_installed() && $search_type == 'product' ) $search_type = 'post';
        ?>

		<form action="<?php echo home_url( '/' ); ?>" method="get" class="search_mini">
			<input type="text" name="s" id="search_mini" value="<?php the_search_query(); ?>" placeholder="<?php if( is_shop_installed() ): echo apply_filters( 'yit_search_mini_text', __( 'search for products', 'yit' ) ); else: echo apply_filters( 'yit_search_mini_text', __( 'search for...', 'yit' ) ); endif ?>" />
			<input type="hidden" name="post_type" value="<?php echo apply_filters( 'yit_search_mini_posttype', $search_type ) ?>" />
            <input type="submit" value="" id="mini-search-submit" />
		</form>

<?php		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array() );
?>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array());
		return $instance;
	}

}
endif;