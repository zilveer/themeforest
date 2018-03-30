<?php
/**
 * The Template Part for displaying post navigation.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
	$post_type = get_post_type();
		
	$href = '';
	$text = '';
	if ( 'post' === $post_type ) {			
		$index_page = intval( g1_get_theme_option( 'post_type_post', 'page_for_posts' ) );
		$home_page = intval( g1_get_theme_option( 'post_type_page', 'home_page' ) );

        // WPML fallback
        if ( G1_WPML_LOADED ) {
            $index_page = absint( icl_object_id( $index_page, 'page', true ) );
            $home_page = absint( icl_object_id( $home_page, 'page', true ) );
        }

		if ( $index_page && $index_page !== $home_page ) {
			$href = get_permalink( $index_page );	
		} else {
			$href = home_url();
		}	
	} else {
		$href = get_post_type_archive_link( $post_type );
	}
	
	$post_type_obj = get_post_type_object( $post_type );
	$text = $post_type_obj->labels->all_items;
?>
<nav class="g1-nav-single">
    <p><?php _e( 'See more', 'g1_theme' ); ?></p>
	<ol>
		<li class="g1-nav-single__prev">
            <?php previous_post_link( __('<strong class="g1-meta">Prev:</strong>', 'g1_theme' ) . '%link', '%title' ); ?>
        </li>
		<li class="g1-nav-single__back">
            <strong><?php _e( 'Back:', 'g1_theme' ); ?></strong>
			<a href="<?php echo esc_url( $href ); ?>" title="<?php echo esc_attr( __( 'See all entries', 'g1_theme' ) ); ?>"><?php echo esc_html( $text ); ?></a>
		</li>
		<li class="g1-nav-single__next">
            <?php next_post_link( __('<strong class="g1-meta">Next:</strong>', 'g1_theme' ) . '%link', '%title' ); ?>
        </li>
	</ol>
</nav>