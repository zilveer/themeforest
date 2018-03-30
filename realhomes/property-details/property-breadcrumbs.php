<?php
/*
 * Property Breadcrumbs
 */
global $post;

$possible_taxonomies = array( 'property-city', 'property-type', 'property-status' );
$breadcrumbs_taxonomy = get_option( 'theme_breadcrumbs_taxonomy' );
if ( $breadcrumbs_taxonomy && in_array( $breadcrumbs_taxonomy, $possible_taxonomies ) ) {

    $inspiry_breadcrumbs_items = inspiry_get_breadcrumbs_items( $post->ID, $breadcrumbs_taxonomy, false );
    $breadcrumbs_count = count( $inspiry_breadcrumbs_items );

    if ( is_array( $inspiry_breadcrumbs_items ) && ( 0 < $breadcrumbs_count ) ) {

        ?>
        <div class="page-breadcrumbs">
        <nav class="property-breadcrumbs">
            <ul>
            <?php
            $breadcrumbs_item_index = 1;
            foreach( $inspiry_breadcrumbs_items as $item ) {

                echo '<li>';

                if ( isset( $item[ 'url' ] ) && ! empty( $item[ 'url' ] ) ) {
                    ?><a href="<?php echo esc_url ( $item[ 'url' ] ); ?>"><?php echo esc_html( $item[ 'name' ] ); ?></a><?php
                } else {
                    echo esc_html( $item[ 'name' ] );
                }

                $breadcrumbs_item_index++;
                if ( $breadcrumbs_item_index <= $breadcrumbs_count ) {
                    if ( is_rtl() ) {
                        ?><i class="breadcrumbs-separator fa fa-angle-left"></i><?php
                    } else {
                        ?><i class="breadcrumbs-separator fa fa-angle-right"></i><?php
                    }
                }

                echo '</li>';
            }
            ?>
            </ul>
        </nav>
        </div>
        <?php

    }
}
?>