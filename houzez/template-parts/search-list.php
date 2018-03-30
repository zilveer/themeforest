<?php
global $houzez_search_data;

$search_args = $houzez_search_data->query;
$search_args_decoded = unserialize( base64_decode( $search_args ) );
?>
<div class="saved-search-block">
    <p><strong><?php esc_html_e( 'Search Parameters:', 'houzez' ); ?></strong></p>
    <p>
        <?php
        if( isset( $search_args_decoded['tax_query'] ) ) {
            foreach ($search_args_decoded['tax_query'] as $key => $val):

                if (isset($val['taxonomy']) && isset($val['terms']) && $val['taxonomy'] == 'property_city') {
                    $page = get_term_by('slug', $val['terms'], 'property_city');
                    if (!empty($page)) {
                        echo '<strong>' . esc_html__('Location', 'houzez') . ':</strong> ' . esc_attr( $page->name ). ', ';
                    }
                }

                if (isset($val['taxonomy']) && isset($val['terms']) && $val['taxonomy'] == 'property_type') {
                    $page = get_term_by('slug', $val['terms'], 'property_type');
                    if (!empty($page)) {
                        echo '<strong>' . esc_html__('Type', 'houzez') . ':</strong> ' . esc_attr( $page->name ). ', ';
                    }
                }

                if (isset($val['taxonomy']) && isset($val['terms']) && $val['taxonomy'] == 'property_status') {
                    $page = get_term_by('slug', $val['terms'], 'property_status');
                    if (!empty($page)) {
                        echo '<strong>' . esc_html__('Status', 'houzez') . ':</strong> ' . esc_attr( $page->name ). ', ';
                    }
                }

                if (isset($val['taxonomy']) && isset($val['terms']) && $val['taxonomy'] == 'property_area') {
                    $page = get_term_by('slug', $val['terms'], 'property_area');
                    if (!empty($page)) {
                        echo '<strong>' . esc_html__('Neighborhood', 'houzez') . ':</strong> ' . esc_attr( $page->name ). ', ';
                    }
                }

                if (isset($val['taxonomy']) && isset($val['terms']) && $val['taxonomy'] == 'property_state') {
                    $page = get_term_by('slug', $val['terms'], 'property_state');
                    if (!empty($page)) {
                        echo '<strong>' . esc_html__('State', 'houzez') . ':</strong> ' . esc_attr( $page->name ). ', ';
                    }
                }

            endforeach;
        }

        $meta_query     = array();

        if ( isset( $search_args_decoded['meta_query'] ) ) :

            foreach ( $search_args_decoded['meta_query'] as $key => $value ) :

                if ( is_array( $value ) ) :

                    if ( isset( $value['key'] ) ) :

                        $meta_query[] = $value;

                    else :

                        foreach ( $value as $key => $value ) :

                            if ( is_array( $value ) ) :

                                foreach ( $value as $key => $value ) :

                                    if ( isset( $value['key'] ) ) :

                                        $meta_query[]     = $value;

                                    endif;

                                endforeach;

                            endif;

                        endforeach;

                    endif;

                endif;

            endforeach;

        endif;

        if( isset( $meta_query ) && sizeof( $meta_query ) !== 0 ) {
            foreach ( $meta_query as $key => $val ) :

                if (isset($val['key']) && $val['key'] == 'fave_property_bedrooms') {
                    echo '<strong>' . esc_html__('Bedrooms', 'houzez') . ':</strong> ' . esc_attr( $val['value'] ). ', ';
                }

                if (isset($val['key']) && $val['key'] == 'fave_property_bathrooms') {
                    echo '<strong>' . esc_html__('Bathrooms', 'houzez') . ':</strong> ' . esc_attr( $val['value'] ). ', ';
                }

                if (isset($val['key']) && $val['key'] == 'fave_property_price') {
                    if ( isset( $val['value'] ) && is_array( $val['value'] ) ) :
                        echo '<strong>' . esc_html__('Price', 'houzez') . ':</strong> ' . esc_attr( $val['value'][0] ).' - '.esc_attr( $val['value'][1]). ', ';
                    else :
                        echo '<strong>' . esc_html__('Price', 'houzez') . ':</strong> ' . esc_attr( $val['value'] ).', ';
                    endif;
                }

                if (isset($val['key']) && $val['key'] == 'fave_property_size') {
                    if ( isset( $val['value'] ) && is_array( $val['value'] ) ) :
                        echo '<strong>' . esc_html__('Size', 'houzez') . ':</strong> ' . esc_attr( $val['value'][0] ).' - '.esc_attr( $val['value'][1]). ', ';
                    else :
                        echo '<strong>' . esc_html__('Size', 'houzez') . ':</strong> ' . esc_attr( $val['value'] ).', ';
                    endif;
                }

            endforeach;
        }
        ?>
    </p>
    <button class="remove-search" data-propertyid='<?php echo intval($houzez_search_data->id); ?>'><i class="fa fa-remove"></i></button>
    <?php $houzez_site_name     = sprintf( "%s://%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'] ); ?>
    <a class="btn btn-primary" href="<?php echo $houzez_site_name . $houzez_search_data->url; ?>"><?php esc_html_e( 'Search', 'houzez' ); ?></a>
</div>