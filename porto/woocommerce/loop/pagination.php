<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $wp_query, $porto_settings, $porto_layout;

if ($porto_settings['category-item']) {
    $per_page = explode(',', $porto_settings['category-item']);
} else {
    $per_page = explode(',', '12,24,36');
}
$page_count = porto_loop_shop_per_page();
?>
<nav class="woocommerce-pagination">
    <form class="woocommerce-viewing" method="get">
        <label><?php echo __('View', 'porto') ?>: </label>
        <select name="count" class="count">
            <?php foreach ( $per_page as $count ) : ?>
                <option value="<?php echo esc_attr( $count ); ?>" <?php selected( $page_count, $count ); ?>><?php echo esc_html( $count ); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="paged" value=""/>
        <?php
        // Keep query string vars intact
        foreach ( $_GET as $key => $val ) {
            if ( 'count' === $key || 'submit' === $key || 'paged' === $key ) {
                continue;
            }
            if ( is_array( $val ) ) {
                foreach( $val as $innerVal ) {
                    echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                }
            } else {
                echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
            }
        }
        ?>
    </form>
	<?php
        if ( $wp_query->max_num_pages <= 1 ) {
            echo '</nav>';
            return;
        }
        $size_count = 3;
        if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar')
            $size_count = 2;
        echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => false,
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => '',
			'next_text'    => '',
			'type'         => 'list',
			'end_size'     => $size_count,
			'mid_size'     => floor($size_count / 2)
		) ) );
	?>
</nav>
