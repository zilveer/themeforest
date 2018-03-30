<?php
    $mode = !empty($view_params['sortable_mode']) ? esc_attr( $view_params['sortable_mode'] ) : 'ajax';
    $sortable_all_text = !empty($view_params['sortable_all_text']) ? esc_attr( $view_params['sortable_all_text'] ) : esc_html__( 'All', 'mk_framework' );
    $data_config[] = 'data-mk-component="Sortable"';
    $data_config[] = 'data-sortable-config=\'{"container":"' . esc_attr( $view_params['container'] ) . '", "item":"' . esc_attr( $view_params['item'] ) . '", "mode":"' . esc_attr( $mode ) . '"}\'';
?>

<?php $requested_term = isset($_REQUEST['term']) ? esc_attr( $_REQUEST['term'] ) : ''; ?> 
<header class="sortable-<?php echo esc_attr( $view_params['style'] ); ?>-style sortable-id-<?php echo esc_attr( $view_params['uniqid'] ); ?> <?php echo (isset($view_params['custom_class']) ? esc_attr( $view_params['custom_class'] ) : ''); ?> js-el" id="mk-filter-portfolio"<?php echo (isset($view_params['custom_style']) ? esc_attr( $view_params['custom_style'] ) : ''); ?> <?php echo implode(' ', $data_config); ?>>
    <div class="mk-grid">
        <ul class="align-<?php echo esc_attr( $view_params['align'] ); ?>">
            <?php
                $terms = array();
                if ($view_params['categories'] != '') {
                    foreach (explode(',', $view_params['categories']) as $term_slug) {
                        $terms[] = get_term_by('slug', $term_slug, $view_params['post_type'].'_category');
                    }
                    /* 
                        We add categories to the All categories item
                        so when sending ajax request for all categories 
                        we tell the php code that the query is not all available
                        categories but selective ones picked from shortcode params

                    */
                    $all_cats_items = $view_params['categories'];

                } else {
                    $terms = get_terms($view_params['post_type'].'_category', 'hide_empty=1&suppress_filters=0');

                    // Star means all categories available
                    $all_cats_items = '*';
            } ?>
            <li><a class="<?php echo (empty($requested_term) ? 'current' : ''); ?>" data-filter="<?php echo esc_attr( $all_cats_items ); ?>" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( $sortable_all_text ); ?></a></li>
            <?php foreach($terms as $term) { ?>
            <li><a class="<?php echo (($term->slug ==  $requested_term) ? 'current' : ''); ?>" data-filter="<?php echo esc_attr( $term->slug ); ?>" href="<?php echo esc_url( get_permalink() ); ?>?term=<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
            <?php } ?>
            <div class="clearboth"></div>
        </ul>
        <div class="clearboth"></div>
  </div>
</header>