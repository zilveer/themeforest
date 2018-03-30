<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $wp_query;

global $venedor_settings, $venedor_woo_version;

parse_str($_SERVER['QUERY_STRING'], $params);
$query_string = '?'.$_SERVER['QUERY_STRING'];
$query_string = venedor_remove_url_parameters($query_string, 'paged');

// replace it with theme option
if ($venedor_settings['category-item']) {
    $per_page = explode(',', $venedor_settings['category-item']);
} else {
    $per_page = explode(',', '9,15,30');
}

$item_count = !empty($params['count']) ? $params['count'] : $per_page[0];
?>
<div class="pager">
    <?php // pagination ?>
    <nav class="woocommerce-pagination">
        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <?php
            $pager_links = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
                'base'         => ( version_compare($venedor_woo_version, '2.3', '<') ? esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', htmlspecialchars_decode( get_pagenum_link( 999999999 ) ) ) ) ) : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', htmlspecialchars_decode( get_pagenum_link( 999999999 ) ) ) ) )),
                'format'         => '',
                'add_args'     => '',
                'current'         => max( 1, get_query_var('paged') ),
                'total'         => $wp_query->max_num_pages,
                'prev_text'     => '',
                'next_text'     => '',
                'type'            => 'list',
                'end_size'        => 2,
                'mid_size'        => 2
            ) ) );
            echo str_replace('#038;', '&', preg_replace('~>\s+<~m', '><', $pager_links));
        ?>
        <?php endif; ?>
    </nav>
    <?php // view limiter ?>
    <div class="limiter">
        <label><?php echo __('View', 'venedor') ?>: </label>
        <div class="dropdown left dropdown-select">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false" title="<?php echo __('View', 'venedor') ?>">
                <?php echo $item_count ?>
                <span class="arrow"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                for ($i = 0; $i < count($per_page); $i++) :
                    if ($item_count != $per_page[$i]) : ?>
                        <li><a tabindex="-1" href="<?php echo venedor_add_url_parameters($query_string, 'count', $per_page[$i]) ?>"><?php echo $per_page[$i] ?></a></li>
                <?php endif; 
                endfor; ?>
            </ul>
        </div>
    </div>
</div>
