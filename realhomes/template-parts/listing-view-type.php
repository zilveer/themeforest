<div class="view-type clearfix">
    <?php

    //page url
    if( is_tax() ) {
        $page_url = custom_taxonomy_page_url();
    } else {
        global $post;
        $page_url = get_permalink( $post->ID );
    }

    //separator
    $separator = ( parse_url( $page_url, PHP_URL_QUERY ) == NULL ) ? '?' : '&';

    // View Type
    $view_type = 'list';
    if( isset( $_GET['view'] ) ) {
        if ( $_GET['view'] == 'grid' ) {
            $view_type = 'grid';
        }
    } else {
        if( is_page_template( 'template-property-grid-listing.php' ) ) {
            $view_type = 'grid';
        }
    }
    ?>
    <a class="list <?php echo ( $view_type == 'list' )?'active':''; ?>" href="<?php echo $page_url . $separator . 'view=list'; ?>">
        <?php include( get_template_directory() . '/images/list-view.svg' ); ?>
    </a>
    <a class="grid <?php echo ( $view_type == 'grid' )?'active':''; ?>" href="<?php echo $page_url . $separator . 'view=grid'; ?>">
        <?php include( get_template_directory() . '/images/grid-view.svg' ); ?>
    </a>
</div>