<?php
global $theme_search_fields;
if( !empty($theme_search_fields) ):
?>
<div class="as-form-wrap">
    <form class="advance-search-form clearfix" action="<?php global $theme_search_url; echo $theme_search_url; ?>" method="get">
    <?php

    if ( in_array ( 'keyword-search', $theme_search_fields ) ) {
        ?>
        <div class="option-bar large">
            <label for="keyword-txt"><?php _e('Keyword', 'framework'); ?></label>
            <input type="text" name="keyword" id="keyword-txt" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" placeholder="<?php _e('Any', 'framework'); ?>" />
        </div>
        <?php
    }

    if ( in_array ( 'property-id', $theme_search_fields ) ) {
        ?>
        <div class="option-bar large">
            <label for="property-id-txt"><?php _e('Property ID', 'framework'); ?></label>
            <input type="text" name="property-id" id="property-id-txt" value="<?php echo isset($_GET['property-id'])?$_GET['property-id']:''; ?>" placeholder="<?php _e('Any', 'framework'); ?>" />
        </div>
        <?php
    }

    if ( in_array ( 'location', $theme_search_fields ) ) {

        // number of locations chosen from theme options
        $location_select_count = inspiry_get_locations_number();

        // Variable that contains location select boxes names
        $location_select_names = inspiry_get_location_select_names();;

        // Default location select boxes titles
        $location_select_titles = inspiry_get_location_titles();

        // Generate required location select boxes
        for ( $i=0; $i < $location_select_count; $i++ ) {
            ?>
            <div class="option-bar large">
                <label for="<?php echo $location_select_names[$i];  ?>"><?php echo $location_select_titles[$i] ?></label>
                <span class="selectwrap">
                    <select name="<?php echo $location_select_names[$i]; ?>" id="<?php echo $location_select_names[$i];  ?>" class="search-select"></select>
                </span>
            </div>
            <?php
        }

        // important action hook - related JS works based on it
        do_action( 'after_location_fields' );
    }

    if ( in_array ( 'status', $theme_search_fields ) ) {
        ?>
        <div class="option-bar large">
            <label for="select-status"><?php _e('Property Status', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="status" id="select-status" class="search-select">
                    <?php advance_search_options('property-status'); ?>
                </select>
            </span>
        </div>
        <?php
    }

    if ( in_array ( 'type', $theme_search_fields ) ) {
        ?>
        <div class="option-bar large">
            <label for="select-property-type"><?php _e('Property Type', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="type" id="select-property-type" class="search-select">
                    <?php advance_hierarchical_options('property-type'); ?>
                </select>
            </span>
        </div>
        <?php
    }

    if ( in_array( 'min-beds', $theme_search_fields ) ) {
        ?>
        <div class="option-bar small">
            <label for="select-bedrooms"><?php _e('Min Beds', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="bedrooms" id="select-bedrooms" class="search-select">
                    <?php numbers_list('bedrooms'); ?>
                </select>
            </span>
        </div>
        <?php
    }

    if ( in_array ( 'min-baths', $theme_search_fields ) ) {
        ?>
        <div class="option-bar small">
            <label for="select-bathrooms"><?php _e('Min Baths', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="bathrooms" id="select-bathrooms" class="search-select">
                    <?php numbers_list('bathrooms'); ?>
                </select>
            </span>
        </div>
        <?php
    }

    if ( in_array( 'min-max-price', $theme_search_fields ) ) {
        ?>
        <div class="option-bar small price-for-others">
            <label for="select-min-price"><?php _e('Min Price', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="min-price" id="select-min-price" class="search-select">
                    <?php min_prices_list(); ?>
                </select>
            </span>
        </div>

        <div class="option-bar small price-for-others">
            <label for="select-max-price"><?php _e('Max Price', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="max-price" id="select-max-price" class="search-select">
                    <?php max_prices_list(); ?>
                </select>
            </span>
        </div>

        <div class="option-bar small price-for-rent hide-fields">
            <label for="select-min-price"><?php _e('Min Price', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="min-price" id="select-min-price-for-rent" class="search-select" disabled="disabled">
                    <?php min_prices_for_rent_list(); ?>
                </select>
            </span>
        </div>

        <div class="option-bar small price-for-rent hide-fields">
            <label for="select-max-price"><?php _e('Max Price', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="max-price" id="select-max-price-for-rent" class="search-select" disabled="disabled">
                    <?php max_prices_for_rent_list(); ?>
                </select>
            </span>
        </div>
        <?php
    }

    if ( in_array ( 'min-max-area', $theme_search_fields ) ) {
        $area_unit = get_option("theme_area_unit");
        ?>
        <div class="option-bar small">
            <label for="min-area"><?php _e('Min Area', 'framework'); ?> <span><?php if($area_unit){ echo "($area_unit)"; } ?></span></label>
            <input type="text" name="min-area" id="min-area" pattern="[0-9]+" value="<?php echo isset($_GET['min-area'])?$_GET['min-area']:''; ?>" placeholder="<?php _e('Any', 'framework'); ?>" title="<?php _e('Please only provide digits!','framework'); ?>" />
        </div>

        <div class="option-bar small">
            <label for="max-area"><?php _e('Max Area', 'framework'); ?> <span><?php if($area_unit){ echo "($area_unit)"; } ?></span></label>
            <input type="text" name="max-area" id="max-area" pattern="[0-9]+" value="<?php echo isset($_GET['max-area'])?$_GET['max-area']:''; ?>" placeholder="<?php _e('Any', 'framework'); ?>" title="<?php _e('Please only provide digits!','framework'); ?>" />
        </div>
        <?php
    }
    ?>

    <div class="option-bar">
        <input type="submit" value="<?php _e('Search', 'framework'); ?>" class=" real-btn btn">
    </div>

    <?php
    if ( in_array ( 'features', $theme_search_fields ) ) {
        /* all property features terms */
        $all_features = get_terms( 'property-feature' );

        $required_features_slugs = array();
        if ( isset( $_GET['features'] ) ) {
            $required_features_slugs = $_GET['features'];
        }

        $features_count = count ( $all_features );
        if ( $features_count > 0 ) {
            ?>
            <div class="clearfix"></div>

            <div class="more-option-trigger">
                <a href="#">
                    <i class="fa <?php echo ( count( $required_features_slugs ) > 0 )? 'fa-minus-square-o': 'fa-plus-square-o'; ?>"></i>
                    <?php _e( 'Looking for certain features', 'framework' ); ?>
                </a>
            </div>

            <div class="more-options-wrapper clearfix <?php echo ( count( $required_features_slugs ) > 0 )? '': 'collapsed'; ?>">
            <?php
            foreach ($all_features as $feature ) {
                ?>
                <div class="option-bar">
                    <input type="checkbox"
                           id="feature-<?php echo $feature->slug; ?>"
                           name="features[]"
                           value="<?php echo $feature->slug; ?>"
                        <?php if ( in_array( $feature->slug, $required_features_slugs ) ) { echo 'checked'; } ?> />
                    <label for="feature-<?php echo $feature->slug; ?>"><?php echo ucwords( $feature->name ); ?> <small>(<?php echo $feature->count; ?>)</small></label>
                </div>
                <?php
            }
            ?>
            </div>
            <?php
        }
    }
    ?>

    </form>
</div>
<?php
endif;
?>