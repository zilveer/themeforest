<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 16/12/15
 * Time: 6:18 PM
 */
global $listing_page_link, $listings_tabs, $listings_tab_1, $listings_tab_2, $fave_featured_listing;

$tab1_link = add_query_arg( 'tab', $listings_tab_1, $listing_page_link );
$tab2_link = add_query_arg( 'tab', $listings_tab_2, $listing_page_link );

$tab_all = $tab1_active = $tab2_active = $sortby = '';
if( isset( $_GET['tab'] ) && $_GET['tab'] == $listings_tab_1 ) {
    $tab1_active = "class = active";
} elseif( isset( $_GET['tab'] ) && $_GET['tab']  == $listings_tab_2 ) {
    $tab2_active = "class = active";
} else {
    $tab_all = "class = active";
}
if( isset( $_GET['sortby'] ) ) {
    $sortby = $_GET['sortby'];
}
$tab_1 = houzez_get_term_by( 'slug', $listings_tab_1, 'property_status' );
$tab_2 = houzez_get_term_by( 'slug', $listings_tab_2, 'property_status' );
?>

<?php if( !is_tax() && $listings_tabs != 'disable' && !is_page_template('template/template-search.php')) { ?>
<div class="list-tabs table-list full-width">
    <div class="tabs table-cell">
        <ul>
            <li><a href="<?php echo esc_url( $listing_page_link ); ?>" <?php echo esc_attr( $tab_all ); ?>><?php esc_html_e( 'ALL', 'houzez' ); ?></a></li>

            <?php if( $listings_tab_1 != '0' ) { ?>
                <li> <a href="<?php echo esc_url( $tab1_link ); ?>" <?php echo esc_attr( $tab1_active ); ?>><?php echo esc_attr( $tab_1->name ); ?></a></li>
            <?php } ?>

            <?php if( $listings_tab_2 != '0' ) { ?>
                <li><a href="<?php echo esc_url( $tab2_link ); ?>" <?php echo esc_attr( $tab2_active ); ?>><?php echo esc_attr( $tab_2->name ); ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="sort-tab table-cell text-right">
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
</div>
<?php } ?>