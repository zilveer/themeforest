<?php get_header(); ?>
<?php global $wp_query; ?>
<?php
jaw_template_set_var('posts', $wp_query);

if (isset($_GET['post_type'])) {
    $post_types[] = $_GET['post_type'];
} else {
    $post_types = jwOpt::get_option('search_posttypes', array('post', 'page'));
}
if (sizeof($post_types) > 0) {
    foreach ($post_types as $i => $type) {
        $q = array();
        $q = $wp_query->query_vars;

        if ($type == 'product') {
            $q['meta_query'] = array(
                array(
                    'key' => '_visibility',
                    'value' => array('search', 'visible'),
                    'compare' => 'IN')
            );

            if (get_option('woocommerce_hide_out_of_stock_items') == 'yes') {
                $q['meta_query'][] = array(
                    'key' => '_stock_status',
                    'value' => 'instock',
                    'compare' => '='
                );
            }

            if (isset($_GET['orderby'])) {

                $price = explode('-', $_GET['orderby']);
                if (count($price) > 1) {
                    $q['orderby'] = $price[0];
                    $q['order'] = $price[1];
                }
            }
        } else if ($type == 'attachment') {
            $q['post_status'] = array('open', 'public', 'inherit');
        }

        $q['post_type'] = $type;
        $query = new WP_Query($q);

        jaw_template_set_var($type, $query);
    }
}

$taxonomies = jwOpt::get_option('search_taxonomies', array());
if (sizeof($taxonomies) > 0) {
    foreach ($taxonomies as $i => $type) {
        $temms = get_terms($type, array('name__like'=>get_search_query(), 'get'=>'all'));
        jaw_template_set_var($type, $temms);
    }
}

?> 
<!-- Row for main content area -->
<div id="content" class="<?php echo implode(' ', jwLayout::content_width()); ?> columns builder-section" role="main">

    <h1><?php _e('Search Results for', 'jawtemplates'); ?> "<?php echo get_search_query(); ?>"</h1>
    <?php
    get_template_part('loop', 'search');
    ?>

</div><!-- End Content row -->

<?php
get_sidebar();

get_footer();