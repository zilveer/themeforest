<?php
global $post, $splash_welcome_text, $page_head_subtitle, $keyword_field_placeholder, $houzez_local;
$css_class = '';
$search_template = houzez_get_search_template_link();
$splash_v1_dropdown = houzez_option('splash_v1_dropdown');
$splash_banner_search_type = 'type1';//houzez_option('splash_banner_search_type');
$keyword_field = houzez_option('keyword_field');

if( $keyword_field == 'prop_title' ) {
    $keyword_field_placeholder = $houzez_local['keyword_text'];

} else if( $keyword_field == 'prop_city_state_county' ) {
    $keyword_field_placeholder = $houzez_local['city_state_area'];

} else if( $keyword_field == 'prop_address' ) {
    $keyword_field_placeholder = $houzez_local['search_address'];

} else {
    $keyword_field_placeholder = $houzez_local['enter_location'];
}

if( $splash_v1_dropdown == 'property_status' ) {
    $dropdown_title = $houzez_local['all_status'];
    $select_name = 'status';
} else if ( $splash_v1_dropdown == 'property_type' ) {
    $dropdown_title = $houzez_local['all_types'];
    $select_name = 'type';
} else if ( $splash_v1_dropdown == 'property_area' ) {
    $dropdown_title = $houzez_local['all_areas'];
    $select_name = 'area';
} else {
    $dropdown_title = $houzez_local['all_cities'];
    $select_name = 'location';
}
?>

<?php if( !empty( $splash_welcome_text ) ) { ?>
    <h1><?php echo esc_html( $splash_welcome_text );?></h1>
<?php } ?>
<?php if( !empty( $page_head_subtitle ) ) { ?>
    <h2 class="banner-sub-title"><?php echo $page_head_subtitle; ?></h2>
<?php } ?>

<?php if( $splash_banner_search_type == "type1" ) { ?>
<div class="banner-search-main">
    <form method="get" action="<?php echo esc_url( $search_template ); ?>" class="form-inline">
        <div class="form-group">
            <select name="<?php echo esc_attr_e($select_name);?>" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                <?php
                // All Option
                echo '<option value="all">'.$dropdown_title.'</option>';

                $prop_city = get_terms (
                    array(
                        $splash_v1_dropdown
                    ),
                    array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => false,
                        'parent' => 0
                    )
                );
                houzez_hirarchical_options( $splash_v1_dropdown, $prop_city, '' );
                ?>
            </select>
            <div class="search input-search input-icon">
                <input type="text" class="form-control" name="keyword" placeholder="<?php esc_html_e( $keyword_field_placeholder ); ?>">
            </div>
            <div class="search-btn">
                <button class="btn btn-orange"><?php echo $houzez_local['search']; ?></button>
            </div>

        </div>
    </form>
</div>
<?php } elseif ( $splash_banner_search_type == "type2" ) { ?>

    <div class="banner-search-taber">
        <div class="banner-search-tabs">
            <div class="search-tab active">
                <div class="search-tab-inner">All</div>
            </div>
            <div class="search-tab">
                <div class="search-tab-inner">For Sale</div>
            </div>
            <div class="search-tab">
                <div class="search-tab-inner">For Rent</div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in">
                <?php get_template_part( 'template-parts/advanced-search/splash', 'banner' ); ?>
            </div>
            <div class="tab-pane fade">
                <?php get_template_part( 'template-parts/advanced-search/splash', 'banner' ); ?>
            </div>
            <div class="tab-pane fade">
                <?php get_template_part( 'template-parts/advanced-search/splash', 'banner' ); ?>
            </div>
        </div>
    </div>

<?php } ?>
        