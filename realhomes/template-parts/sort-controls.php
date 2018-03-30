<div class="sort-controls">
    <strong><?php _e('Sort By','framework');?>:</strong>
    &nbsp;
    <?php
    if ( isset( $_GET['sortby'] ) ) {
        $sort_by = $_GET['sortby'];
    } else {
        if ( is_page_template( array (
            'template-property-listing.php',
            'template-property-grid-listing.php',
            'template-map-based-listing.php',
            ) ) ) {
            $sort_by = get_post_meta( get_the_ID(), 'inspiry_properties_order', true );
        } else {
            $sort_by = get_option( 'theme_listing_default_sort' );
        }
    }
    ?>
    <select name="sort-properties" id="sort-properties">
        <option value="default"><?php _e('Default Order','framework');?></option>
        <option value="price-asc" <?php echo ( $sort_by == 'price-asc' ) ? 'selected' : '' ; ?>><?php _e('Price Low to High','framework');?></option>
        <option value="price-desc" <?php echo ( $sort_by == 'price-desc' ) ? 'selected' : '' ; ?>><?php _e('Price High to Low','framework');?></option>
        <option value="date-asc" <?php echo ( $sort_by == 'date-asc' ) ? 'selected' : '' ; ?>><?php _e('Date Old to New','framework');?></option>
        <option value="date-desc" <?php echo ( $sort_by == 'date-desc' ) ? 'selected' : '' ; ?>><?php _e('Date New to Old','framework');?></option>
    </select>
</div>