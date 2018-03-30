<?php


$room_slug = trim(st_get_setting('post_room')) !='' ? trim(st_get_setting('post_room')) : 'room'  ;
$portfolio_slug = trim(st_get_setting('post_portfolio')) !='' ? trim(st_get_setting('post_portfolio')) : 'portfolio'  ;
$event_slug=  trim(st_get_setting('post_event')) !='' ? trim(st_get_setting('post_event')) : 'event'  ;
 
 
register_post_type('room',array(
        'label'=>_x('Room','smooththemes'),
        'labels'=>array(
            'singular_name'=>_x('Room','smooththemes'),
            'menu_name'=>_x('Rooms','smooththemes'),
            'all_items'=>_x('All Rooms','smooththemes'),
            'add_new'=>_x('Add Room','smooththemes'),
            'add_new_item'=>_x('Add new Room','smooththemes'),
            'edit_item'=>_x('Edit Room','smooththemes'),
            'new_item'=>_x('New Room','smooththemes'),
            'view_item'=>_x('View Room','smooththemes'),
            'search_items'=>_x('Search Rooms','smooththemes'),
            'not_found'=>_x('Not found','smooththemes'),
            'not_found_in_trash'=>_x('Not found in trash','smooththemes')  
        ),
        'public' => true,
        'show_ui'=>true,
        'rewrite'=> array('slug'=> $room_slug ,  'with_front' => false),
        'supports'=>array( 'title','editor' ,'thumbnail' ),
        'menu_position'=>6,
        'can_export' => true
 ));
 
 
 register_post_type('room_service',array(
        'label'=>_x('Room Service','smooththemes'),
        'labels'=>array(
            'singular_name'=>_x('Room Service','smooththemes'),
            'menu_name'=>_x('Room  Services','smooththemes'),
            'all_items'=>_x('All Room Services','smooththemes'),
            'add_new'=>_x('Add Room Service','smooththemes'),
            'add_new_item'=>_x('Add new Room Service','smooththemes'),
            'edit_item'=>_x('Edit Room Service','smooththemes'),
            'new_item'=>_x('New Room Service','smooththemes'),
            'view_item'=>_x('View Room Service','smooththemes'),
            'search_items'=>_x('Search Room Services','smooththemes'),
            'not_found'=>_x('Not found','smooththemes'),
            'not_found_in_trash'=>_x('Not found in trash','smooththemes')  
        ),
        'public' => false,
        'show_ui'=>true,
        'show_in_nav_menus'=>false,
        'supports'=>array( 'title' ,'thumbnail' ),
        'menu_position'=>7,
        'can_export' => true
 ));
 
 
 
 register_post_type('event',array(
        'label'=>_x('Event','smooththemes'),
        'labels'=>array(
            'singular_name'=>_x('Event','smooththemes'),
            'menu_name'=>_x('Events','smooththemes'),
            'all_items'=>_x('All Events','smooththemes'),
            'add_new'=>_x('Add Event','smooththemes'),
            'add_new_item'=>_x('Add new Event','smooththemes'),
            'edit_item'=>_x('Edit Event','smooththemes'),
            'new_item'=>_x('New Event','smooththemes'),
            'view_item'=>_x('View Event','smooththemes'),
            'search_items'=>_x('Search Events','smooththemes'),
            'not_found'=>_x('Not found','smooththemes'),
            'not_found_in_trash'=>_x('Not found in trash','smooththemes')  
        ),
        'public' => true,
        'show_ui'=>true,
       
        'rewrite'=> array('slug'=> $event_slug, 'with_front' => false),
        'supports'=>array( 'title','editor' ,'thumbnail' ),
        'menu_position'=>20,
        'can_export' => true
 ));
 
 
 register_post_type('portfolio',array(
        'label'=>_x('Portfolio','smooththemes'),
        'labels'=>array(
            'singular_name'=>_x('Portfolio','smooththemes'),
            'menu_name'=>_x('Portfolio','smooththemes'),
            'all_items'=>_x('All Portfolio','smooththemes'),
            'add_new'=>_x('Add Portfolio','smooththemes'),
            'add_new_item'=>_x('Add new Portfolio','smooththemes'),
            'edit_item'=>_x('Edit Portfolio','smooththemes'),
            'new_item'=>_x('New Portfolio','smooththemes'),
            'view_item'=>_x('View Portfolio','smooththemes'),
            'search_items'=>_x('Search Portfolio','smooththemes'),
            'not_found'=>_x('Not found','smooththemes'),
            'not_found_in_trash'=>_x('Not found in trash','smooththemes')  
        ),
        'public' => true,
        'show_ui'=>true,
        'rewrite'=> array('slug'=> $portfolio_slug,  'with_front' => false),
        'supports'=>array( 'title','editor' ,'thumbnail','excerpt' ),
        'menu_position'=>20,
        'can_export' => true
        
 ));
 

register_post_type('gallery',array(
        'label'=>_x('Gallery','smooththemes'),
        'labels'=>array(
            'singular_name'=>_x('Gallery','smooththemes'),
            'menu_name'=>_x('Gallery','smooththemes'),
            'all_items'=>_x('All Galleries','smooththemes'),
            'add_new'=>_x('Add new','smooththemes'),
            'add_new_item'=>_x('Add new','smooththemes'),
            'edit_item'=>_x('Edit Gallery','smooththemes'),
            'new_item'=>_x('New Gallery','smooththemes'),
            'view_item'=>_x('View Gallery','smooththemes'),
            'search_items'=>_x('Search Galleries','smooththemes'),
            'not_found'=>_x('Not found','smooththemes'),
            'not_found_in_trash'=>_x('Not found in trash','smooththemes')  
        ),
        'public' => true,
        'show_ui'=>true,
        'supports'=>array( 'title','editor' ,'thumbnail' ),
        'menu_position'=>11,
        'can_export' => true
        
 ));
 

 // flush_rewrite_rules();
