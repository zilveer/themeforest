<?php

function aitGetItems($args, $cacheKey = '')
{
    static $_query;
    if (!empty($cacheKey)) {
        if(!is_null($_query[$cacheKey])){
            return $_query[$cacheKey];
        }
        else {
            $_query[$cacheKey] = new WpLatteWpQuery($args);
            return $_query[$cacheKey];
        }
    } else {
        return new WpLatteWpQuery($args);

    }
}



function aitEventAddress($event, $all = false)
{
    $meta = $event->meta('event-pro-data');
    $useItemLocation = filter_var($meta->useItemLocation, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    if ($useItemLocation and !empty($meta->item)) {
        $itemMeta = get_post_meta($meta->item, '_ait-item_item-data', true);
        if ($all) {
            return array(
                'address'    => $itemMeta['map']['address'],
                'latitude'   => $itemMeta['map']['latitude'],
                'longitude'  => $itemMeta['map']['longitude'],
                'swheading'  => $itemMeta['map']['swheading'],
                'swpitch'    => $itemMeta['map']['swpitch'],
                'swzoom'     => $itemMeta['map']['swzoom'],
                'streetview' => $itemMeta['map']['streetview'],
            );
        }
        return $itemMeta['map']['address'];
    } else {
        if ($all) {
            return array(
                'address'   => $meta->map['address'],
                'latitude'  => $meta->map['latitude'],
                'longitude' => $meta->map['longitude'],
                'swheading' => $meta->map['swheading'],
                'swpitch' => $meta->map['swpitch'],
                'swzoom' => $meta->map['swzoom'],
                'streetview' => $meta->map['streetview'],
            );
        }
        return $meta->map['address'];
    }
}





function aitGetAllRecurringDates()
{
    global $wpdb;

    $query =
        "SELECT DATE(pm.meta_value) as 'meta_value' FROM $wpdb->postmeta pm
        LEFT JOIN $wpdb->posts p ON p.ID = pm.post_id
        WHERE pm.meta_key = 'ait-event-recurring-date'
        AND p.post_status = 'publish'
        AND p.post_type = 'ait-event-pro'
        ORDER BY pm.meta_value ASC";
    $result = $wpdb->get_results( $query, ARRAY_A );
    $allMeta = array();
    foreach ($result as $key => $meta) {
        array_push($allMeta, $meta['meta_value']);
    }
    return $allMeta;
}
// getAllRecurringDates();


function aitGetNextDate($dates, $from = '', $includeToday = false)
{
    if (empty($dates)) {
        return array();
    }
    $now = empty($from) ? new DateTime() : new DateTime($from);
    $nowTimestamp = ($now->getTimeStamp());

    // if date is today consider also time
    // if ( date('Ymd') == date('Ymd', strtotime($dateSelected))) {
    //    $dateSelected = date('Y-m-d H:i:s');
    // }


    if (isset($dates[0]) && is_array( $dates[0] )) {
        // dates array consists of elements with dateFrom and dateTo
        foreach ($dates as $date) {
            $newDate = new DateTime($date['dateFrom']);
            $newDateTimestamp = ($newDate->getTimeStamp());
            if ($includeToday) {
                if ($newDateTimestamp >= $nowTimestamp) {
                    return $date;
                }
            } else {
                if ($newDateTimestamp > $nowTimestamp) {
                    return $date;
                }
            }

        }
        // if any date isn't future - fix for archive pages
        return $dates[0];
    } else {
        // simple array of single dates
        foreach ($dates as $date) {
            $newDate = new DateTime($date);
            if ($includeToday) {
                if ($newDate >= $now) {
                    return $date;
                }
            } else {
                if ($newDate > $now) {
                    return $date;
                }
            }
        }
    }

    return array();
}



function aitGetRecurringDates($event, $from = '')
{
    $result = array();
    $now = empty($from) ? new DateTime() : new DateTime($from);
    $now = $now->getTimeStamp();

    $meta = $event->meta('event-pro-data');

    $dates = $meta->dates;
    foreach ($dates as $date) {
       if (strtotime($date['dateFrom']) >= $now ) {
            array_push($result, $date);
       }
    }

    return $result;
}





function aitItemRelatedEvents($itemId, $args = array())
{
    $eventsProOptions = get_option('ait_events_pro_options', array());
    $selectedOrderBy = isset($args['orderby']) ? $args['orderby'] : $eventsProOptions['sortingDefaultOrderBy'];
    $selectedOrder = isset($args['order']) ? $args['order'] : $eventsProOptions['sortingDefaultOrder'];
    $selectedCount = isset($args['posts_per_page']) ? $args['posts_per_page'] : $eventsProOptions['sortingDefaultCount'];

    $defaults = array(
        'posts_per_page' => $selectedCount,
    );

    $args = wp_parse_args($args, $defaults);

    $sortingSettings = $settings = aitOptions()->getOptionsByType('theme');
    $sortingSettings = $sortingSettings['items'];

    // eventguide has different theme options
    // $sortingSettings = $sortingSettings['sorting'];


    $order = $sortingSettings['sortingDefaultOrder'];
    $orderBy = array();

    if ($selectedOrderBy == 'eventDate') {
        $orderBy['dates_clause'] = $selectedOrder;
    } else {
        $orderBy[$selectedOrderBy] = $selectedOrder;
    }

    $eventsArgs = array(
        'post_type'      => 'ait-event-pro',
        'posts_per_page' => $args['posts_per_page'],
        'lang'           => AitLangs::getCurrentLanguageCode(),
        'meta_query' => array(
            'relation' => 'AND',
            'dates_clause' => array(
                'key'     => 'ait-event-recurring-date',
                'value'   => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'date',
            ),
            'related_clause' => array(
                'key'     => 'ait-event-pro-related-item',
                'value'   => $itemId,
                'compare' => '=',
            )
        ),
        'orderby' => $orderBy,
    );
    return aitGetItems($eventsArgs);
}


// determine the topmost parent of a term
function aitGetOnlyParentTerms($postId, $taxonomy){
    $terms = get_the_terms($postId, $taxonomy);
    $categoryParent = '';
    $counter = 0;
    if ($terms) {
        foreach ($terms as $category) {
            // start from the current term
            $parent  = get_term_by( 'id', $category->term_id, 'ait-events-pro');
            // climb up the hierarchy until we reach a term with parent = '0'
            while ($parent->parent != '0'){
                $term_id = $parent->parent;

                $parent  = get_term_by( 'id', $term_id, 'ait-events-pro');
            }
            $parents[$parent->term_id] = new WpLatteTaxonomyTermEntity($parent, 'ait-events-pro');
            // $categories = $wp->categories(array('taxonomy' => 'ait-events-pro', 'hide_empty' => 0, 'parent' => $parentCategory))}
        }
    }
    return $parents;
}