<?php
global $listing_view, $fave_featured_listing, $taxonomy_title, $listings_tabs;

$active = $listing_view;
$sortby = '';
if( $active == 'grid-view grid-view-3-col' ) {
    $active = 'grid-view-3-col';
}
if( isset( $_GET['sortby'] ) ) {
    $sortby = $_GET['sortby'];
}
?>
<div class="page-title breadcrumb-top">
    <div class="row">
        <div class="col-sm-12">
            <?php get_template_part( 'inc/breadcrumb' ); ?>
            <div class="page-title-left">
                <?php if( !is_front_page() ) {
                    if( is_tax() ) { ?>
                        <h2><?php echo esc_attr( $taxonomy_title ); ?></h2>
                    <?php } else { ?>
                        <h1 class="title-head"><?php the_title(); ?></h1>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="page-title-right">
                <div class="view">
                    <?php if( $listings_tabs != 'enable' ) { ?>
                        <div class="sort-tab table-cell">
                            <?php esc_html_e( 'Sort by:', 'houzez' ); ?>
                            <select id="sort_properties" class="selectpicker bs-select-hidden" title="<?php esc_html_e( 'Default Order', 'houzez' ); ?>" data-live-search-style="begins" data-live-search="false">
                                <option <?php if( $sortby == 'a_price' ) { echo "selected"; } ?> value="a_price"><?php esc_html_e( 'Price (Low to High)', 'houzez' ); ?></option>
                                <option <?php if( $sortby == 'd_price' ) { echo "selected"; } ?> value="d_price"><?php esc_html_e( 'Price (High to Low)', 'houzez' ); ?></option>
                                <?php if( $fave_featured_listing != 'enable' ) { ?>
                                    <option <?php if( $sortby == 'featured' ) { echo "selected"; } ?> value="featured"><?php esc_html_e( 'Featured', 'houzez' ); ?></option>
                                <?php } ?>
                                <option <?php if( $sortby == 'a_date' ) { echo "selected"; } ?> value="a_date"><?php esc_html_e( 'Date Old to New', 'houzez' ); ?></option>
                                <option <?php if( $sortby == 'd_date' ) { echo "selected"; } ?> value="d_date"><?php esc_html_e( 'Date New to Old', 'houzez' ); ?></option>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="table-cell hidden-xs">
                        <span class="view-btn btn-list <?php if( $active == 'list-view' ) { echo 'active'; }?>"><i class="fa fa-th-list"></i></span>
                        <span class="view-btn btn-grid <?php if( $active == 'grid-view' ) { echo 'active'; }?>"><i class="fa fa-th-large"></i></span>

                        <?php if( is_page_template( 'template/property-listing-fullwidth.php' ) || is_page_template( 'template/property-listing-style2-fullwidth.php' ) ) { ?>
                            <span class="view-btn btn-grid-3-col <?php if( $active == 'grid-view-3-col' ) { echo 'active'; }?>"><i class="fa fa-th"></i></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>