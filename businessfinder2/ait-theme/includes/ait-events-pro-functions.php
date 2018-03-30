<?php

require_once dirname(__FILE__) . '/AitExtendConfig.php';



// add_filter('ait-load-elements-configs', 'aitExtendElementsConfigs', 14);
// function aitExtendElementsConfigs($allElements)
// {
// 	foreach ($allElements as $key => $element) {

// 		switch ($key) {
// 			case 'header-map':
// 				$allElements[$key]['options'] += AitExtendConfig::getNeonSection(AitExtendConfig::getSectionIndex($element['options']), 'Events Pro Settings');
// 				$allElements[$key]['options'] = array_merge($allElements[$key]['options'], AitExtendConfig::getOptions('header-map'));
// 				break;
// 			case 'search-form':
// 				$allElements[$key]['options'] = AitExtendConfig::arrayInsert($allElements[$key]['options'], AitExtendConfig::getOptions('search-form'), 2);
// 				break;
// 			case 'taxonomy-list':
// 				$allElements[$key]['options']['taxonomy']['default'] = AitExtendConfig::arrayInsert($allElements[$key]['options']['taxonomy']['default'], array('ait-events-pro' => __("Event Categories", 'ait-admin')), 1);
// 				break;
// 			case 'sidebar-map':
// 				$allElements[$key]['options'] = AitExtendConfig::arrayInsert($allElements[$key]['options'], AitExtendConfig::getOptions('sidebar-map'), 3);
// 				break;

// 			default:

// 				break;
// 		}


// 	}
// 	return $allElements;
// }


// add_filter('ait-layout-config', 'aitExtendLayoutConfig');
// function aitExtendLayoutConfig($config)
// {
// 	$i = 0;
// 	foreach ($config['general']['options'] as $key => $option) {
// 		$i++;
// 		if ($key === "headerType") {
// 			$config['general']['options'][$key]['default']['eventslider'] = __("Event Slider", 'ait-admin');

// 			$config['general']['options'] = AitExtendConfig::arrayInsert($config['general']['options'], AitExtendConfig::getNeonSection(AitExtendConfig::getSectionIndex($config['general']['options']), 'Event Slider Options', 'headerType-eventslider'),
// 				$i);

// 			$i++;

// 			$config['general']['options'] = AitExtendConfig::arrayInsert($config['general']['options'], AitExtendConfig::getEventSliderOptions(),
// 				$i);
// 		} elseif ($key === "headerSearchType") {
// 			$config['general']['options'][$key]['default']['events'] = __("Events", 'ait-admin');
// 		}
// 	}
// 	return $config;
// }



add_filter('ait-theme-config', 'aitExtendThemeConfig');
function aitExtendThemeConfig($config)
{
	$config['packages']['options']['packageTypes']['items'] = AitExtendConfig::arrayInsert($config['packages']['options']['packageTypes']['items'], AitExtendConfig::getOptions('packages'), 6);
	foreach ($config['packages']['options']['packageTypes']['default'] as $key => $value) {
		$config['packages']['options']['packageTypes']['default'][$key] = AitExtendConfig::arrayInsert($config['packages']['options']['packageTypes']['default'][$key], array('maxEvents' => 0), 6);
	}
	return $config;
}



add_action('init', 'aitAddEventProLocation');
function aitAddEventProLocation()
{
    register_taxonomy_for_object_type('ait-locations', 'ait-event-pro');
}



add_filter("manage_ait-event-pro_posts_columns" , 'aitManageEventsProColumns');
function aitManageEventsProColumns($columns)
{
	$newColumns = array(
		'item' => __('Item', 'ait-admin'),
	);
	return array_merge($columns, $newColumns);
}



add_action("manage_ait-event-pro_posts_custom_column" , 'aitCustomEventsProColumnValue', 10, 2 );
function aitCustomEventsProColumnValue($column, $postId)
{
	if ($column == 'item') {
		$meta = get_post_meta( $postId, '_ait-event-pro_event-pro-data', true );
		if (isset($meta['item']) and $meta['item'] != 0) {
			echo get_the_title($meta['item']);
		} else {
			echo '';
		}
	}
}



add_action( 'save_post', 'ait_save_related_item_meta', 8, 3 );
function ait_save_related_item_meta( $post_id, $post, $update )
{
    $slug = 'ait-event-pro';

    // If this isn't a 'event-pro' post, don't update it.
    if ( $slug != $post->post_type ) {
        return;
    }
    // save related item metadata
    if ( isset( $_POST['_ait-event-pro_event-pro-data']['item'] ) ) {
        $relatedItem = $_POST['_ait-event-pro_event-pro-data']['item'];
	    if ( ! update_post_meta ( $post_id, 'ait-event-pro-related-item', $relatedItem) ) {
			add_post_meta( $post_id, 'ait-event-pro-related-item', $relatedItem, true );
		}
    }

    // save recurring dates
    if ( isset( $_POST['_ait-event-pro_event-pro-data']['dates'] ) ) {
        $recurringDates = $_POST['_ait-event-pro_event-pro-data']['dates'];

		delete_post_meta( $post_id, 'ait-event-recurring-date' );
		get_option( 'ait-eventpro-all-recurring-days', array() );

        if (is_array($recurringDates)) {
        	$timestamps = array();
			foreach ($recurringDates as $key => $date) {
				$timestamp = strtotime($date['dateFrom']);
				$timestamps[$key] = $timestamp;
				list($day, $time) = explode(" ", $date['dateFrom']);

				add_post_meta( $post_id, 'ait-event-recurring-date', $date['dateFrom'], false );
			}
			//sort recurring dates and set hidden input dateFrom
			array_multisort($recurringDates, SORT_ASC, $timestamps);
			$_POST['_ait-event-pro_event-pro-data']['dates'] = $recurringDates;
			$_POST['_ait-event-pro_event-pro-data']['dateFrom'] = $recurringDates[0]['dateFrom'];
			$_POST['_ait-event-pro_event-pro-data']['dateTo'] = $recurringDates[0]['dateTo'];
        } else {
        	//empty recurring dates
        }
    }
}



// add colorpicker on edit item category page
add_filter( 'ait-enqueue-admin-assets', function($return){
    if (strpos(get_current_screen()->id,'edit-ait-events-pro') !== false) {
        return true;
    } elseif (strpos(get_current_screen()->id,'edit-ait-items') !== false) {
        return true;
    } elseif (strpos(get_current_screen()->id,'ait_events_pro_options') !== false) {
        return true;
    }
    return $return;
});


function aitSortByDateASC($a, $b) {
    return $a['order'] - $b['order'];
}

function aitSortByDateDESC($a, $b) {
    return $b['order'] - $a['order'];
}