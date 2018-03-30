<?php
// allows programmers to include part in the same way as in latte syntax
function aitRenderLatteTemplate($template, $params = array())
{
    AitWpLatte::init();
    ob_start();
    WpLatte::render(aitPath('theme', $template), $params);
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}



function aitGetItemsMarkers($query)
{
    $markers = array();

    foreach (new WpLatteLoopIterator($query) as $item) {
        $meta = $item->meta('item-data');
        // skip items with [1,1] coordinates
        if ($meta->map['latitude'] == 1 and $meta->map['longitude'] == 1) {
            continue;
        }

        $price = get_post_meta( $item->id, '_ait-item_food-options_price', true );

        $options = aitOptions()->getOptionsByType('theme');
		$featuredImage = $item->imageUrl;
        $imageLink = empty($featuredImage) ? $options['item']['noFeatured'] : $item->imageUrl;

        $context = aitRenderLatteTemplate('/parts/item-marker.php', array('item' => $item, 'meta' => $meta));
        $catData = aitItemCategoriesData($item->id);
        $marker = (object)array(
            'lat'        => $meta->map['latitude'],
            'lng'        => $meta->map['longitude'],
            'title'      => $item->rawTitle,
            'icon'       => $catData['icon'],
            'context'    => $context,
            'type'       => 'item',
            'data'       => array(),
        );
        array_push($markers, $marker);
    }
    return $markers;
}

function aitItemCategoriesData($itemID)
{
    $options = aitOptions()->getOptionsByType('theme');
    $itemCats = get_the_terms($itemID, 'ait-items');
    $icon = $options['items']['categoryDefaultPin'];
    // $parents = array();

    if (!$itemCats) {
        $itemCats = array();
    }

    foreach ($itemCats as $cat) {
        $parent = get_term($cat->parent, 'ait-items');
        $catOption = get_option('ait-items_category_'.$cat->term_id);

        if (!empty($catOption['map_icon'])) {
            $icon = $catOption['map_icon'];
        } elseif(isset($parent) && !($parent instanceof WP_Error)) {
            $parentOption = get_option('ait-items_category_'.$parent->term_id);
            // array_push($parents, $parent->term_id);
            if (!empty($parentOption['map_icon'])) {
                $icon = $parentOption['map_icon'];
            }
        }

        // if(isset($parent) && !($parent instanceof WP_Error) && !in_array($parent->term_id, $parents)) {
        //     array_push($parents, $parent->term_id);
        // } else {
        //     array_push($parents, $cat->term_id);
        // }
    }

    return array(
        'icon' => $icon,
        // 'parents' => $parents
    );
}

function aitGetMapOptions($options)
{
    $result = array();
    $result['styles'] = aitGetMapStyles($options);

    if (!isset($options['autoZoomAndFit']) || !$options['autoZoomAndFit']) {
        $result['center'] = array(
            'lat' => floatval($options['address']['latitude']),
            'lng' => floatval($options['address']['longitude']),
        );
    }

    if (!empty($options['mousewheelZoom'])) {
        $result['scrollwheel'] = true;
    }

    if (isset($options['zoom'])) {
        $result['zoom'] = intval($options['zoom']);
    }

    return $result;
}

function aitGetMapStyles($options)
{
    $o = $options;
    $styles = array(
    	array(
    		'stylers' => array(
                array('hue'        => $o['mapHue']),
                array('saturation' => $o['mapSaturation']),
                array('lightness'  => $o['mapBrightness']),
    		),
    	),
    	array(
    		'featureType' => 'landscape',
    		'stylers' => array(
                array('visibility' => $o['landscapeShow'] == false ? 'off' : 'on'),
                array('hue'        => $o['landscapeColor']),
                array('saturation' => $o['landscapeColor'] != '' ? $o['objSaturation'] : ''),
                array('lightness'  => $o['landscapeColor'] != '' ? $o['objBrightness'] : ''),
    		),
    	),
        array(
            'featureType' => 'administrative',
            'stylers' => array(
                array('visibility' => $o['administrativeShow'] == false ? 'off' : 'on'),
                array('hue'        => $o['administrativeColor']),
                array('saturation' => $o['administrativeColor'] != '' ? $o['objSaturation'] : ''),
                array('lightness'  => $o['administrativeColor'] != '' ? $o['objBrightness'] : ''),
            ),
        ),
        array(
            'featureType' => 'road',
            'stylers' => array(
                array('visibility' => $o['roadsShow'] == false ? 'off' : 'on'),
                array('hue'        => $o['roadsColor']),
                array('saturation' => $o['roadsColor'] != '' ? $o['objSaturation'] : ''),
                array('lightness'  => $o['roadsColor'] != '' ? $o['objBrightness'] : ''),
            ),
        ),
        array(
            'featureType' => 'water',
            'stylers' => array(
                array('visibility' => $o['waterShow'] == false ? 'off' : 'on'),
                array('hue'        => $o['waterColor']),
                array('saturation' => $o['waterColor'] != '' ? $o['objSaturation'] : ''),
                array('lightness'  => $o['waterColor'] != '' ? $o['objBrightness'] : ''),
            ),
        ),
        array(
            'featureType' => 'poi',
            'stylers' => array(
                array('visibility' => $o['poiShow'] == false ? 'off' : 'on'),
                array('hue'        => $o['poiColor']),
                array('saturation' => $o['poiColor'] != '' ? $o['objSaturation'] : ''),
                array('lightness'  => $o['poiColor'] != '' ? $o['objBrightness'] : ''),
            ),
        ),
    );
    return $styles;
}


add_filter( 'ait_alter_search_query', function($query){
    /* SETTINGS FOR POST TYPE RELATED PAGES: */
    if($query->is_tax('ait-events-pro') || is_post_type_archive('ait-event-pro')) {
        $settings = (object)get_option('ait_events_pro_options', array());
    } else {
        $settings = aitOptions()->getOptionsByType('theme');
        $settings = (object)$settings['items'];
    }

    $filterCountsSelected = isset($_REQUEST['count']) && $_REQUEST['count'] != "" ? $_REQUEST['count'] : $settings->sortingDefaultCount;
    $filterOrderBySelected = isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != "" ? $_REQUEST['orderby'] : $settings->sortingDefaultOrderBy;
    $filterOrderSelected = isset($_REQUEST['order']) && $_REQUEST['order'] != "" ? $_REQUEST['order'] : $settings->sortingDefaultOrder;
    $taxQuery  = array();
    $metaQuery = array();
    $metaQuery['relation'] = 'AND';

    $query->set('lang', AitLangs::getCurrentLanguageCode());

    /* APPLY REVIEWS ORDERING FOR ITEMS */
    if (defined('AIT_REVIEWS_ENABLED') and $filterOrderBySelected == 'rating') {
        $metaQuery['rating_clause'] = array(
            'key' => 'rating_mean',
            'compare' => 'EXISTS'
        );
        $filterOrderBySelected = 'rating_clause';
    }

    /* APPLY ADVANCED FILTERS FOR ITEMS */
    if (!empty($_REQUEST['filters'])) {
        $metaQuery = aitFilterByAdvancedFilters( $metaQuery, $_REQUEST['filters'] );
    }

    /* IS SEARCH PAGE FOR ITEMS */
    if(isset($_REQUEST['a']) && $_REQUEST['a'] == true) {
        $query->set('post_type', 'ait-item');
        $metaQuery['featured_clause'] = array(
            'key'   => '_ait-item_item-featured',
            'compare' => 'EXISTS'
        );
		if (!empty($_REQUEST['s'])) {
			aitIncludeMetaInSearch();
		}

        /* FILTER BY TAXONOMIES */
        if (!empty($_REQUEST['category'])) {
            array_push($taxQuery, array('taxonomy' => 'ait-items', 'field' => 'term_id', 'terms' => $_REQUEST['category']));
        }
        if (!empty($_REQUEST['location'])){
            array_push($taxQuery, array('taxonomy' => 'ait-locations', 'field' => 'term_id', 'terms' => $_REQUEST['location']));
        }

        /* FILTER BY RADIUS */
        if (!empty($_REQUEST['lat']) && !empty($_REQUEST['lon']) and !empty($_REQUEST['rad'])) {
            $radiusUnits = !empty($_REQUEST['runits']) ? $_REQUEST['runits'] : 'km';
            $radiusValue = !empty($_REQUEST['rad']) ? $_REQUEST['rad'] * 1000 : 100 * 1000;
            $radiusValue = $radiusUnits == 'mi' ? $radiusValue * 1.609344 : $radiusValue;

            $latitude = $_REQUEST['lat'];
            $longitude = $_REQUEST['lon'];


            $query->set('post_type', 'ait-item');
            $query->set('posts_per_page', -1);
            $query->set('meta_query', $metaQuery);
            $query->set('tax_query', $taxQuery);

            $queryToFilter = new WP_Query($query->query_vars);
            $filteredByRadiusList = aitFilterByRadius($queryToFilter, $radiusValue, $latitude, $longitude);

            /* if $filteredByRadiusList is empty it means there are no items in result */
            if (empty($filteredByRadiusList)) {
               $filteredByRadiusList = array(0);
            }

            wp_reset_query();
            $query->set('post__in', $filteredByRadiusList);
        } else {
            $query->set('meta_query', $metaQuery);
            $query->set('tax_query', $taxQuery);
        }
        $query->set('post_type', 'ait-item');
        $query->set('posts_per_page', $filterCountsSelected);
        $query->set('orderby', array(
            'featured_clause' => 'DESC',
            $filterOrderBySelected => $filterOrderSelected
        ));

    /* IS ITEM TAXONOMY AND ARCHIVE PAGE */
    } elseif ($query->is_tax('ait-items') || $query->is_tax('ait-locations') || is_post_type_archive('ait-item')) {
        $metaQuery['featured_clause'] = array(
            'key'   => '_ait-item_item-featured',
            'compare' => 'EXISTS'
        );
        $query->set('posts_per_page', $filterCountsSelected);
        $query->set('meta_query', $metaQuery);
        $query->set('orderby', array(
            'featured_clause' => 'DESC',
            $filterOrderBySelected => $filterOrderSelected
        ));

    /* IS EVENTS PRO TAXONOMY AND ARCHIVE PAGE */
    } elseif ($query->is_tax('ait-events-pro') || is_post_type_archive('ait-event-pro')) {
         $metaQuery['dates_clause'] = array(
            'key'     => 'ait-event-recurring-date',
            'value'   => date('Y-m-d'),
            'compare' => '>',
            'type'    => 'date',
        );
        $query->set('posts_per_page', $filterCountsSelected);
        $query->set('meta_query', $metaQuery);
        if ($filterOrderBySelected == 'eventDate') {
            $query->set('orderby', array(
                'dates_clause' => $filterOrderSelected
            ));
        } else {
            $query->set('orderby', array(
                $filterOrderBySelected => $filterOrderSelected
            ));
        }

    }
    return $query;
} );



function aitIncludeMetaInSearch($request = '') {
    global $wp_query;
    $queryVars = $wp_query->query_vars;
    $queryVars['fields'] = 'ids';
    $queryVars['posts_per_page'] = -1;

    $ids1 = new WP_Query($queryVars);

    $queryVars['meta_query']['meta_search'] = array(
		'relation' => 'OR',
		array(
			'key'     => 'subtitle',
			'value'   => $queryVars['s'],
			'compare' => 'LIKE',
		),
		array(
			'key'     => 'features_search_string',
			'value'   => $queryVars['s'],
			'compare' => 'LIKE',
		),
	);
    $queryVars['s'] = '';
    $ids2 = new WP_Query($queryVars);
	$ids = array_merge($ids1->posts, $ids2->posts);
	if (empty($ids)) {
		$ids = array(0);
	}
	$wp_query->set('s', '');
	$wp_query->set('post__in', $ids);
}



function aitFilterByRadius($query, $radiusValue, $latitude, $longitude)
{
    $metaKey = 'item-data';

    $filtered = array();
    foreach (new WpLatteLoopIterator($query) as $item) {
        $meta = $item->meta($metaKey);
        $lat = !empty($meta->map['latitude']) ? $meta->map['latitude'] : false;
        $lng = !empty($meta->map['longitude']) ? $meta->map['longitude'] : false;

        if($lat !== false && $lng !== false){
            if (isPointInRadius($radiusValue, $latitude, $longitude, $lat, $lng)){
                array_push($filtered, $item->id);
            }
        }
    }
    return $filtered;
}



function aitFilterByAdvancedFilters($metaQuery, $filters)
{
    $filters = explode(";", $filters);

    foreach ($filters as $key => $value) {
        array_push($metaQuery, array(
            'key' => '_ait-item_filters-options',
            'value' => '"'.$value.'"',
            'compare' => 'LIKE',
        ));
    }

    return $metaQuery;
}



add_action( 'save_post', 'aitSaveItemMeta', 13, 2 );
function aitSaveItemMeta( $post_id, $post )
{
    $slug = 'ait-item';

    if ( $slug != $post->post_type ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    // save separated meta data for featured
    if(!empty($_POST)){ // bulk edit check ... in this case $_POST is still empty
        if(isset($_POST['_ait-item_item-data']['featuredItem'])){
            if (intval($_POST['_ait-item_item-data']['featuredItem']) == 1) {
                update_post_meta($post_id, '_ait-item_item-featured', '1');
            }
            else {
                update_post_meta($post_id, '_ait-item_item-featured', '0');
            }
        } else {
            // item created with directory role that cannot set item as featured
            update_post_meta($post_id, '_ait-item_item-featured', '0');
        }
    }

	// save separated meta data for subTitle
    if(!empty($_POST)){ // bulk edit check ... in this case $_POST is still empty
        if(isset($_POST['_ait-item_item-data']['subtitle'])){
			update_post_meta($post_id, 'subtitle', $_POST['_ait-item_item-data']['subtitle']);
        } else {
            // item created with directory role that cannot set subTitle
			update_post_meta($post_id, 'subtitle', '');
        }
    }

	// save separated meta data for features
	// the reason is to include features in search by keyword
	// we can chain all feature labels and descriptions to one long text because we anyway search by %LIKE%
    if(!empty($_POST)){ // bulk edit check ... in this case $_POST is still empty
        if(!empty($_POST['_ait-item_item-data']['features'])){
			$result = "";
			foreach ($_POST['_ait-item_item-data']['features'] as $feature) {
				$result .= $feature['text'].';'.$feature['desc'].';';
			}
			update_post_meta($post_id, 'features_search_string', $result);
        } else {
            // we don't need meta if features are empty
			delete_post_meta($post_id, 'features_search_string');
        }
    }

    // if item hasn't been rated yet, create rating manually
    if (get_post_meta( $post_id, 'rating_mean', true ) == '') {
        update_post_meta($post_id, 'rating_mean', '0');
    }
}



// save custom meta for items created via CSV importer
add_action('ait_csv_post_imported', function($post_type, $post_id){
    // quit if post isn't ait-item
    if ( $post_type != 'ait-item' ) {
        return;
    }

    $meta = get_post_meta($post_id, '_ait-item_item-data', true);
    // quit if post doesn't have meta for some reason
    if(empty($meta)){
        $return;
    }

    if(!empty($meta['subtitle'])){
        update_post_meta($post_id, 'subtitle', $meta['subtitle']);
    } else {
		delete_post_meta($post_id, 'subtitle');
	}

	if(!empty($meta['features'])){
		$result = "";
		foreach ($meta['features'] as $feature) {
			$result .= $feature['text'].';'.$feature['desc'].';';
		}
        update_post_meta($post_id, 'features_search_string', $result);
    } else {
		delete_post_meta($post_id, 'features_search_string');
	}

}, 10, 2 );



add_filter( 'ait_search_filter_orderby', function($orderby, $postType = ''){
    if (class_exists('AitEventsProSettingsAdminPage') && $postType == 'ait-event-pro') {
        $sortingConfig = AitEventsProSettingsAdminPage::getInstance()->config('admin');
        $sortingConfig = $sortingConfig['sorting']['options']['sortingDefaultOrderBy']['default'];
        foreach ($sortingConfig as $key => $value) {
            // array_push($orderby, array($key, $value));
            $orderby[$key] = $value;
        }
    }
    return $orderby;
}, 10, 2 );