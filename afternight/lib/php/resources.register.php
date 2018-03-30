<?php
    $sidebar_value = extra::select_value( '_sidebar' );

    if(!( is_array( $sidebar_value ) || !empty( $sidebar_value ) ) ){
        $sidebar_value = array();
    }

    /* hide if is full width */
    $classes = 'sidebar_list';

    $position = array( 'left' => __( 'Align Left' , 'cosmotheme' ) , 'right' => __( 'Align Right' , 'cosmotheme' ) );


    /* post type portfolio */
    $res[ 'portfolio' ][ 'labels' ] = array(
        'name' => _x('Portfolios', 'post type general name','cosmotheme'),
        'singular_name' => _x(__('Portfolio','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Portfolio','cosmotheme')),
        'add_new_item' => __('Add New Portfolio','cosmotheme'),
        'edit_item' => __('Edit Portfolio','cosmotheme'),
        'new_item' => __('New Portfolio','cosmotheme'),
        'view_item' => __('View Portfolio','cosmotheme'),
        'search_items' => __('Search Portfolio','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res[ 'portfolio' ][ 'args' ] = array(
        'public' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => __('portfolio','cosmotheme'), 'with_front' => true ),
        'menu_position' => 3,
        '__on_front_page' => true,
        'supports' => array('title','editor','thumbnail','post-formats','comments','custom-fields','excerpt'),
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.portfolio.png',
        'has_archive' => true
    );

    

    resources::$labels['portfolio']         = $res['portfolio']['labels'];
    resources::$type['portfolio']           = $res['portfolio']['args'];

    /*=====================================================*/
    /* post type event */
    $res[ 'event' ][ 'labels' ] = array(
        'name' => _x('Events', 'post type general name','cosmotheme'),
        'singular_name' => _x(__('Event','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Event','cosmotheme')),
        'add_new_item' => __('Add New Event','cosmotheme'),
        'edit_item' => __('Edit Event','cosmotheme'),
        'new_item' => __('New Event','cosmotheme'),
        'view_item' => __('View Event','cosmotheme'),
        'search_items' => __('Search Event','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res[ 'event' ][ 'args' ] = array(
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 4,
        'rewrite' => array( 'slug' => __('event','cosmotheme'), 'with_front' => true ),
        '__on_front_page' => true,
        'supports' => array('title','editor','thumbnail','comments','custom-fields','excerpt'),
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.event.png',
        'has_archive' => true
    );

    $repeating_options = array('day' => __('Every day','cosmotheme'), 'week' => __('Every week','cosmotheme') ,'month' => __('Every month','cosmotheme') ,'year' => __('Every year','cosmotheme') );

    
    $form[ 'event' ][ 'date' ]['start_date_time']     = array( 
            'type' => 'st--datetimepicker' , 
            'label' => __( '  Event start date' , 'cosmotheme' )
    );
    $form[ 'event' ][ 'date' ]['end_date_time']          = array( 'type' => 'st--datetimepicker' , 'label' => __( '  Event end date' , 'cosmotheme' )  );
    $form[ 'event' ][ 'date' ]['is_repeating']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Is repeating' , 'cosmotheme' ) , 'cvalue' => 'no', 'action' => "act.check( this , { 'yes' : '.repeating'  } , 'sh');" );
    $form[ 'event' ][ 'date' ]['repeating']         = array( 'type' => 'st--select' , 'label' => __( 'Repeat every' , 'cosmotheme' ) , 'value' => $repeating_options  );
    
    if( isset( $_GET['post'] ) &&  meta::logic( get_post( $_GET['post']  ) , 'date' , 'is_repeating' ) ){
        $form['event']['date']['repeating']['classes'] = 'repeating';
    }else{
        $form['event']['date']['repeating']['classes'] = 'hidden repeating'; 
    }

    $box[ 'event' ][ 'date' ]                   = array( __( 'Event date' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form[ 'event' ][ 'date' ] , 'box' => 'date', 'update' => true );

    $form[ 'event' ][ 'info' ]['venue']          = array( 'type' => 'st--text' , 'label' => __( 'Venue' , 'cosmotheme' )  );
    $form[ 'event' ][ 'info' ]['place']          = array( 'type' => 'st--text' , 'label' => __( 'Place' , 'cosmotheme' )  );
    $form[ 'event' ][ 'info' ]['custominfometa']    = array( 'type' => 'stcm--user_defined_text' , 'label' => __( 'Add custom fields' , 'cosmotheme' )  ); /*stcm - standard custom meta (we use this to have a container before the input in which the added alements will be appended)*/
    
    $box[ 'event' ][ 'info' ]                   = array( __( 'Event additional info' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form[ 'event' ][ 'info' ] , 'box' => 'info', 'update' => true );

    /*the hint from this option uses light box as help*/
    $form[ 'event' ][ 'map' ]['map_code']       = array( 'type' => 'st--textarea' , 'label' => __( 'Add map embedded code' , 'cosmotheme' ), 'hint' => sprintf(__( 'For example if you are using google maps, then you can get the embedded code like %s this %s and paste it in the box above. Also make sure to adjust the width and height of the provided embedded code according to your needs.' , 'cosmotheme' ), '<a href="'.get_template_directory_uri().'/lib/images/help_screens/google_maps.png" data-rel="prettyPhoto">','</a>')   );
    $box[ 'event' ][ 'map' ]                   = array( __( 'Map' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form[ 'event' ][ 'map' ] , 'box' => 'map', 'update' => true );

    resources::$labels['event']         = $res['event']['labels'];
    resources::$type['event']           = $res['event']['args'];

    /* Boxes for event posts are added bellow in this file */

    /*=====================================================*/

    /* post type testimonials */
    $res['testimonial']['labels'] = array(
        'name' => _x('Testimonials', 'post type general name','cosmotheme'),
        'singular_name' => _x('Testimonial', 'post type singular name','cosmotheme'),
        'add_new' => _x('Add New', __('Testimonial','cosmotheme')),
        'add_new_item' => __('Add New Testimonial','cosmotheme'),
        'edit_item' => __('Edit Testimonial','cosmotheme'),
        'new_item' => __('New Testimonial','cosmotheme'),
        'view_item' => __('View Testimonial','cosmotheme'),
        'search_items' => __('Search Testimonial','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['testimonial']['args'] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.testimonial.png',
        'public' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => __('testimonial','cosmotheme'), 'with_front' => true ),
        'menu_position' => 7,
        'supports' => array('title','editor','thumbnail'),
        '__on_front_page' => true
    );

    /* box for testimonial */
    $form['testimonial']['info']['name']                = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Author name' , 'cosmotheme') . '</strong>' );
    $form['testimonial']['info']['title']               = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Author title' , 'cosmotheme') . '</strong>' );
    $form['testimonial']['info']['skin']                = array( 'type' => 'st--select' , 'label' => __( 'Select skin for this testimonial' , 'cosmotheme' ) , 'value' => get_skins_array() );
    
    $box['testimonial']['info']                         = array( __('Add testimoniall additional info' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['testimonial']['info'] , 'box' => 'info', 'update' => true );
    $box['testimonial']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );


    resources::$labels['testimonial']         = $res['testimonial']['labels'];
    resources::$type['testimonial']           = $res['testimonial']['args'];
    resources::$box['testimonial']            = $box['testimonial'];

    /*---------------------BOF "banner" post type--------------------------*/
    $res['banner']['labels'] = array( 
        'name' => _x('Banners', 'post type general name','cosmotheme'),
        'singular_name' => _x('Banner', 'post type singular name','cosmotheme'),
        'add_new' => _x('Add New', __('Banner','cosmotheme')),
        'add_new_item' => __('Add New Banner','cosmotheme'),
        'edit_item' => __('Edit Banner','cosmotheme'),
        'new_item' => __('New Banner','cosmotheme'),
        'view_item' => __('View Banner','cosmotheme'),
        'search_items' => __('Search Banner','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['banner']['args'] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.banners.png',
        'public' => true,
        'rewrite' => array( 'slug' => __('banner','cosmotheme'), 'with_front' => true ),
        'hierarchical' => false,
        'menu_position' => 8,
        'supports' => array('title'),
        'exclude_from_search' => true,
        '__on_front_page' => false
    );

    /* box for banner */
    $form['banner']['info']['script']            = array( 'type' => 'st--textarea' , 'label' => __( 'Banner code' , 'cosmotheme'), 'hint' => __('You can insert your advertisement code here, or just any text or HTML code.','cosmotheme') );

    $form['banner']['info']['banner_img']       = array( 'type' => 'st--upload' , 'label' => __( 'Banner image' , 'cosmotheme') , 'id' => 'post_background' , 'hint' => __( 'Upload or choose image from media library.' , 'cosmotheme' ) );
    $form['banner']['info']['img_link']         = array( 'type' => 'st--text' , 'label' => __( 'Banner image link' , 'cosmotheme') , 'hint' => __('This URL is used if the above image is uploaded, and if available, the image will link to it.','cosmotheme') );
    $form['banner']['info']['class']            = array( 'type' => 'st--text' , 'label' => __( 'Banner class' , 'cosmotheme') , 'hint' => __('Add custom css class if you need it.','cosmotheme') );
    
    $box['banner']['info']                      = array( __('Banner content' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['banner']['info'] , 'box' => 'info', 'update' => true );
    //$box['banner']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );


    resources::$labels['banner']         = $res['banner']['labels'];
    resources::$type['banner']           = $res['banner']['args'];
    resources::$box['banner']            = $box['banner'];

    /*---------------------EOF banner post type--------------------------*/


    /*---------------------BOF "boxes" post type--------------------------*/
    $res['box']['labels'] = array(
        'name' => _x('Boxes', 'post type general name','cosmotheme'),
        'singular_name' => _x('Box', 'post type singular name','cosmotheme'),
        'add_new' => _x('Add New', __('Box','cosmotheme')),
        'add_new_item' => __('Add New Box','cosmotheme'),
        'edit_item' => __('Edit Box','cosmotheme'),
        'new_item' => __('New Box','cosmotheme'),
        'view_item' => __('View Box','cosmotheme'),
        'search_items' => __('Search Box','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['box']['args'] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.boxes.png',
        'public' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => __('box','cosmotheme'), 'with_front' => true ),
        'menu_position' => 9,
        'supports' => array('title','editor', 'thumbnail'),
        'exclude_from_search' => true,
        '__on_front_page' => false
    );

    /* box for box */

    $form['box']['info']['box_link']         = array( 'type' => 'st--text' , 'label' => __( 'Box link (optional)' , 'cosmotheme') , 'hint' => __('Make the box image and title clickable by adding a link here (optional)...','cosmotheme') );
    /*
    $form['box']['info']['background_color']            = array( 'type' => 'st--color-picker' , 'label' => __( 'Background color' , 'cosmotheme'), 'hint' => __('Add a custom CSS class to this box only.','cosmotheme') );
    $form['box']['info']['text_color']            = array( 'type' => 'st--color-picker' , 'label' => __( 'Text color' , 'cosmotheme'), 'hint' => __('Add a custom CSS class to this box only.','cosmotheme') );
    */
    $form['box']['info']['skin']                  = array( 'type' => 'st--select' , 'label' => __( 'Select skin for this box' , 'cosmotheme' ) , 'value' => get_skins_array() );
    $form['box']['info']['custom_css']            = array( 'type' => 'st--text' , 'label' => __( 'Custom CSS class' , 'cosmotheme'), 'hint' => __('Add a custom CSS class to this box only.','cosmotheme') );
    
    $box['box']['info']                      = array( __('Box options' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['box']['info'] , 'box' => 'info', 'update' => true );
    //$box['box']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );


    resources::$labels['box']         = $res['box']['labels'];
    resources::$type['box']           = $res['box']['args'];
    resources::$box['box']            = $box['box'];

    /*---------------------EOF boxes post type--------------------------*/


    /*---------------------BOF teams post type--------------------------*/
    $res[ 'team' ][ 'labels' ] = array(
        'name' => __( 'Teams', 'cosmotheme' ),
        'singular_name' => __( 'Team', 'cosmotheme' ),
        'add_new' => __( 'Add New Team', 'cosmotheme' ),
        'add_new_item' => __( 'Add New Team', 'cosmotheme' ),
        'edit_item' => __( 'Edit Team', 'cosmotheme' ),
        'new_item' => __( 'New Team', 'cosmotheme' ),
        'view_item' => __( 'View Team', 'cosmotheme' ),
        'search_items' => __( 'Search Team', 'cosmotheme' ),
        'not_found' =>  __( 'Nothing found', 'cosmotheme' ),
        'not_found_in_trash' => __( 'Nothing found in Trash', 'cosmotheme' )
    );
    $res[ 'team' ][ 'args' ] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.team.png',
        'public' => true,
        'hierarchical' => false,
        'rewrite' => array( 'team' => __('banner','cosmotheme'), 'with_front' => true ),
        'menu_position' => 9,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'exclude_from_search' => true,
        '__on_front_page' => false
    );

    $form[ 'team' ][ 'settings' ]['skin']                  = array( 'type' => 'st--select' , 'label' => __( 'Select skin for this member team' , 'cosmotheme' ) , 'value' => get_skins_array(), 'hint' => sprintf(__( 'You can create your own skins from %s here %s' , 'cosmotheme' ), '<a href="'.admin_url().'admin.php?page=cosmothemes__settings&tab=_post_skins" target="_blank">','</a>')  );
    $form[ 'team' ][ 'settings' ][ 'facebook' ]         = array( 'type' => 'st--text' , 'label' => __( 'Facebook' , 'cosmotheme') , 'id' => 'team_facebook', 'hint' => '(i.e. cosmo.themes)' );
    $form[ 'team' ][ 'settings' ][ 'twitter' ]         = array( 'type' => 'st--text' , 'label' => __( 'Twitter' , 'cosmotheme') , 'id' => 'team_twitter', 'hint' => '(i.e. cosmothemes)' );
    $form[ 'team' ][ 'settings' ][ 'linkedin' ]         = array( 'type' => 'st--text' , 'label' => __( 'LinkedIn' , 'cosmotheme') , 'id' => 'team_linkedin', 'hint' => '(i.e. http://www.linkedin.com/company/cosmothemes)' );
    $box[ 'team' ][ 'settings' ]                   = array( __( 'Team settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form[ 'team' ][ 'settings' ] , 'box' => 'info', 'update' => true );

    resources::$labels[ 'team' ]         = $res[ 'team' ][ 'labels' ];
    resources::$type[ 'team' ]           = $res[ 'team' ][ 'args' ];
    resources::$box[ 'team' ]            = $box[ 'team' ];

    /*---------------------EOF teams post type--------------------------*/

    /*get post type*/
    if( isset($_GET['post']) && is_numeric($_GET['post']) ) {
        $this_post_type = get_post_type($_GET['post']);
    }elseif(isset($_GET['post_type'])){
        $this_post_type = $_GET['post_type'];
    }else{
        $this_post_type = '';
    }
    if($this_post_type == 'portfolio'){ /*we need this option for portfolion only*/
        $form['post']['settings']['portfolio_display']   = array( 'type' => 'st--select' , 'label' => __( 'Display' , 'cosmotheme' ) , 'value' => array( 'landscape' => __( 'Landscape mode' , 'cosmotheme' ) , 'portrait' => __( 'Portrait mode' , 'cosmotheme' )  ),  'cvalue' => options::get_value(  'blog_post' , 'portfolio_display' ) );    
    }
    $form['post']['settings']['featured']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display featured image inside the post' , 'cosmotheme' ) , 'hint' => __( 'If enabled featured images will be displayed on post page' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'enb_featured' ) );
    $form['post']['settings']['related']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show related posts' , 'cosmotheme' ) , 'hint' => __( 'Show related posts on this post' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'show_similar' ) );
    
    if (options::logic( 'blog_post' , 'meta' )) {
        $form['post']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show post meta' , 'cosmotheme' ) , 'hint' => __( 'Show post meta on this post' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'meta' ), 'action' => "act.check( this , { 'yes' : '.post_love'  } , 'sh');" );
        $meta_view_type = array('horizontal' => __('Horizontal','cosmotheme'), 'vertical' => __('Vertical','cosmotheme') );  
        if (isset($_GET['post']) && is_admin()) {
            $settings = meta::get_meta( $_GET['post'] , 'settings' );

            if(isset($settings['meta']) && $settings['meta'] == 'yes'){
                $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
            }else{
                $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love hidden', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
            }
        } elseif(!isset($_GET['post']) && is_admin()){
             $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
        }
    }
    $form['post']['settings']['sharing']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => __( 'Show social sharing on this post'  , 'cosmotheme' ) , 'cvalue' => options::get_value( 'blog_post' , 'post_sharing' ) );
    //$form['post']['settings']['author']     = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show author box' , 'cosmotheme' ) , 'hint' => __( 'Show author box on this post'  , 'cosmotheme' ) , 'cvalue' => options::get_value( 'blog_post' , 'post_author_box' ) );
    $form['post']['settings']['show_feat_on_archive'] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display featured image on archive pages' , 'cosmotheme' ) ,  'cvalue' => options::get_value( 'blog_post' , 'show_feat_on_archive' ) );
    //$form[ 'post' ][ 'settings' ][ 'enb_navigation' ] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable navigation for this post' , 'cosmotheme' ) , 'hint' => __( 'If enabled, this post will show links to the next and previous posts.' , 'cosmotheme' )  ,  'cvalue' => options::get_value( 'blog_post', 'enb-next-prev' ) );
    
    $thumb_view_type = array('thumb-image-main' => __(' Image first, text on hover','cosmotheme'), 'thumb-text-main' => __(' Text first, image on hover','cosmotheme') );
    $form['post']['settings']['thumb_view_type']   = array( 'type' => 'st--select' , 'label' => __( 'Select thumbnail view output type' , 'cosmotheme' ) , 'value' => $thumb_view_type );
    $form['post']['settings']['skin']   = array( 'type' => 'st--select' , 'label' => __( 'Select skin for this post' , 'cosmotheme' ) , 'value' => get_skins_array(), 'ivalue' =>  'skin-0', 'hint' => sprintf(__( 'The selected skin will be used in the list, grid and thumb view. You can create your own skins from %s here %s' , 'cosmotheme' ), '<a href="'.admin_url().'admin.php?page=cosmothemes__settings&tab=_post_skins" target="_blank">','</a>')  );
    
    $form['post']['settings']['post_bg']    = array( 'type' => 'st--upload' , 'label' => __( 'Upload or choose image from media library' , 'cosmotheme') , 'id' => 'post_background' , 'hint' => __( 'This will be the background image for this post' , 'cosmotheme' ) );
    $form['post']['settings']['position']   = array( 'type' => 'st--select' , 'label' => __( 'Image background position' , 'cosmotheme' ) , 'value' => array( 'left' => __( 'Left' , 'cosmotheme' ) , 'center' => __( 'Center' , 'cosmotheme' ) , 'right' => __( 'Right' , 'cosmotheme' ) ) );
    $form['post']['settings']['repeat']     = array( 'type' => 'st--select' , 'label' => __( 'Image background repeat' , 'cosmotheme' ) , 'value' => array( 'no-repeat' => __( 'No Repeat' , 'cosmotheme' ) , 'repeat' => __( 'Tile' , 'cosmotheme' ) , 'repeat-x' => __( 'Tile Horizontally' , 'cosmotheme' ) , 'repeat-y' => __( 'Tile Vertically' , 'cosmotheme' ) ) );
    $form['post']['settings']['attachment'] = array( 'type' => 'st--select' , 'label' => __( 'Image background attachment type' , 'cosmotheme' ) , 'value' => array( 'scroll' => __( 'Scroll' , 'cosmotheme' ) , 'fixed' => __( 'Fixed' , 'cosmotheme' ) ) );
    $form['post']['settings']['color']      = array( 'type' => 'st--color-picker' , 'label' => __( 'Set background color for this post' , 'cosmotheme' ) );

    if( isset( $_GET['post'] ) ){
        $post_format = get_post_format( $_GET['post'] );
    }else{
        $post_format = 'standard';
    }

    $form['post']['format']['type']         = array( 'type' => 'st--select' , 'label' => __( 'Select post format' , 'cosmotheme' ) , 'value' => array(  'standard' => __( 'Standard' , 'cosmotheme' ) , 'video' => __( 'Video' , 'cosmotheme' ) , 'image' => __( 'Image' , 'cosmotheme' ) , 'audio' => __( 'Audio' , 'cosmotheme' )  , 'link' => __( 'Attachment' , 'cosmotheme' ), 'gallery' => __( 'Gallery' , 'cosmotheme' ), 'quote' => __( 'Quote' , 'cosmotheme' ) )  , 'action' => "act.select( '.post_format_type' , { 'video' : '.post_format_video' , 'image' : '.post_format_image' , 'audio' : '.post_format_audio' , 'link' : '.post_format_link', 'gallery' : '.post_format_gallery' } , 'sh_' );" , 'iclasses' => 'post_format_type' , 'ivalue' =>  $post_format );

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'video' ){
        $form['post']['format']['video']=array('type'=>'ni--form-upload', 'format'=>'video', 'classes'=>"post_format_video", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['video']=array('type'=>'ni--form-upload', 'format'=>'video', 'classes'=>"hidden post_format_video");
    }

    
    $form['post']['format']['init']=array('type'=>"no--form-upload-init");

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'image' ){
        $form['post']['format']['image']=array('type'=>'ni--form-upload', 'format'=>'image', 'classes'=>"post_format_image", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['image']=array('type'=>'ni--form-upload', 'format'=>'image', 'classes'=>"post_format_image hidden");
    }

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'gallery' ){
        $form['post']['format']['gallery']=array('type'=>'ni--form-upload', 'format'=>'gallery', 'classes'=>"post_format_gallery", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['gallery']=array('type'=>'ni--form-upload', 'format'=>'gallery', 'classes'=>"post_format_gallery hidden");
    }


    $form['post']['format']['init']=array('type'=>"no--form-upload-init");

    

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'audio' ){
        $form['post']['format']['audio']=array('type'=>'ni--form-upload', 'format'=>'audio', 'classes'=>"post_format_audio", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['audio']=array('type'=>'ni--form-upload', 'format'=>'audio', 'classes'=>"post_format_audio hidden");
    }
    
    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'link' ){
        $form['post']['format']['link']=array('type'=>'ni--form-upload', 'format'=>'link', 'classes'=>"post_format_link", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['link']=array('type'=>'ni--form-upload', 'format'=>'link', 'classes'=>"post_format_link hidden");
    }

    $box['post']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['post']['settings']                = array( __('Post Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['post']['settings'] , 'box' => 'settings' , 'update' => true  );
    $box['post']['format']                  = array( __('Post Format' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['post']['format'] , 'box' => 'format' , 'update' => true );
    
        

    $box['post']['layout']                 = array(
        __( 'Page Builder' , 'cosmotheme' ),
        'normal',
        'high',
        'content' => array(
            array(
                'type' => 'cd--whatever',
                'content' => new LBPageResizer()
            )
        ) ,
        'box' => 'builder',
        'update' => true
    );
    
    resources::$type['post']                = array();
    resources::$box['post']                 = $box['post'];

    resources::$box[ 'portfolio' ]          = $box[ 'post' ];

    //Create a copy for post box
    $box_copy = array_merge( $box['post'], $box[ 'event' ]);
    unset($box_copy['format']); //we don't need format for events
    
    resources::$box[ 'event' ]          = $box_copy;  /*add boxes for event posts*/
    

  
    if(isset($_GET['post'])){
        $the_source = post::get_source($_GET['post']);
    }
    
    if( options::logic( 'blog_post' , 'show_source' ) || (isset($_GET['post']) && strlen($the_source) )  ){ /*show source box only if it is globally enabled, or it has value*/
        $form[ 'portfolio' ][ 'source' ][ 'post_source' ]   = array( 'type' => 'st--text' , 'label' => __( 'Source' , 'cosmotheme' ) , 'hint' => __( 'Example: http://cosmothemes.com' , 'cosmotheme' ) );
        $form[ 'portfolio' ][ 'source' ][ 'post_client' ]   = array( 'type' => 'st--text' , 'label' => __( 'Client' , 'cosmotheme' ) , 'hint' => __( 'Example: John Doe' , 'cosmotheme' ) );
        $form[ 'portfolio' ][ 'source' ][ 'post_services' ] = array( 'type' => 'st--text' , 'label' => __( 'Services' , 'cosmotheme' ) , 'hint' => __( 'Example: Graphic design, Print' , 'cosmotheme' ) );
        $form[ 'portfolio' ][ 'source' ][ 'custominfometa' ]= array( 'type' => 'stcm--user_defined_text' , 'label' => __( 'Add custom fields' , 'cosmotheme' )  ); /*stcm - standard custom meta (we use this to have a container before the input in which the added alements will be appended)*/
    
        resources::$box['portfolio']['source']   = array( __('Portfolio details' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['portfolio']['source'] , 'box' => 'source' , 'update' => true );
    }
    
    if (options::logic( 'blog_post' , 'meta' )) {
        $form['post']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show post meta' , 'cosmotheme' ) , 'hint' => __( 'Show post meta on this post' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'meta' ), 'action' => "act.check( this , { 'yes' : '.post_love'  } , 'sh');" );
        $meta_view_type = array('horizontal' => __('Horizontal','cosmotheme'), 'vertical' => __('Vertical','cosmotheme') );  
        if (isset($_GET['post']) && is_admin()) {
            $settings = meta::get_meta( $_GET['post'] , 'settings' );

            if(isset($settings['meta']) && $settings['meta'] == 'yes'){
                $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
            }else{
                $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love hidden', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
            }
        } elseif(!isset($_GET['post']) && is_admin()){
             $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
        }
    }

    if (options::logic( 'blog_post' , 'page_meta' )) {
        $form['page']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show page meta' , 'cosmotheme' ) , 'hint' => 'Show post meta on this page' , 'cvalue' => options::get_value(  'blog_post' , 'page_meta' ), 'action' => "act.check( this , { 'yes' : '.page_love'  } , 'sh');" );
        
        if (isset($_GET['post']) && is_admin()) {
            $settings = meta::get_meta( $_GET['post'] , 'settings' );

            if(isset($settings['meta']) && $settings['meta'] == 'yes'){
                $form[ 'page' ][ 'settings' ][ 'love' ] = array( 
                    'type' => 'st--logic-radio' , 
                    'label' => __( 'Show post like' , 'cosmotheme' ) , 
                    'hint' => __( 'Show post like on this post' , 'cosmotheme' )  ,
                    'cvalue' => options::get_value(  'likes' , 'enb_likes' ),
                    'classes' => 'page_love'
                ); 
            }else{
                $form[ 'page' ][ 'settings' ][ 'love' ] = array( 
                    'type' => 'st--logic-radio' , 
                    'label' => __( 'Show post like' , 'cosmotheme' ) , 
                    'hint' => __( 'Show post like on this post' , 'cosmotheme' )  ,
                    'cvalue' => options::get_value(  'likes' , 'enb_likes' ),
                    'classes' => 'page_love hidden'
                );                 
            }
        } elseif(!isset($_GET['post']) && is_admin()){
            $form[ 'page' ][ 'settings' ][ 'love' ] = array( 
                'type' => 'st--logic-radio' , 
                'label' => __( 'Show post like' , 'cosmotheme' ) , 
                'hint' => __( 'Show post like on this post' , 'cosmotheme' )  ,
                'cvalue' => options::get_value(  'likes' , 'enb_likes' ),
                'classes' => 'page_love'
            );            
        }
      
    }
    $form['page']['settings']['sharing']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this page' , 'cvalue' => options::get_value( 'blog_post' , 'page_sharing' ) );
    //$form[ 'page' ][ 'settings' ][ 'enb_navigation' ] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable navigation for this page' , 'cosmotheme' ) , 'hint' => __( 'If enabled, this page will show links to the next and previous pages.' , 'cosmotheme' )  ,  'cvalue' => options::get_value( 'blog_post', 'navigation_page' ) );
    //$form['page']['settings']['author']     = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show author box' , 'cosmotheme' ) , 'hint' => 'Show author box on this page' , 'cvalue' => options::get_value( 'blog_post' , 'page_author_box' ) );
    $form['page']['settings']['post_bg']    = array( 'type' => 'st--upload' , 'label' => __( 'Upload image, or choose from media library.' , 'cosmotheme') , 'id' => 'post_background' , 'hint' => __( 'This will be the background image for this page' , 'cosmotheme' ) );
    $form['page']['settings']['position']   = array( 'type' => 'st--select' , 'label' => __( 'Background position' , 'cosmotheme' ) , 'value' => array( 'left' => __( 'Left' , 'cosmotheme' ) , 'center' => __( 'Center' , 'cosmotheme' ) , 'right' => __( 'Right' , 'cosmotheme' ) ) );
    $form['page']['settings']['repeat']     = array( 'type' => 'st--select' , 'label' => __( 'Background repeat' , 'cosmotheme' ) , 'value' => array( 'no-repeat' => __( 'No Repeat' , 'cosmotheme' ) , 'repeat' => __( 'Tile' , 'cosmotheme' ) , 'repeat-x' => __( 'Tile Horizontally' , 'cosmotheme' ) , 'repeat-y' => __( 'Tile Vertically' , 'cosmotheme' ) ) );
    $form['page']['settings']['attachment'] = array( 'type' => 'st--select' , 'label' => __( 'Background attachment type' , 'cosmotheme' ) , 'value' => array( 'scroll' => __( 'Scroll' , 'cosmotheme' ) , 'fixed' => __( 'Fixed' , 'cosmotheme' ) ) );
    $form['page']['settings']['color']      = array( 'type' => 'st--color-picker' , 'label' => __( 'Set background color for this post' , 'cosmotheme' ) );

    $box['page']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['page']['settings']                = array( __('Page Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['page']['settings'] , 'box' => 'settings' , 'update' => true  );
    $box['page']['builder']                 = array(
        __( 'Page Builder' , 'cosmotheme' ) ,
        'normal' ,
        'high' ,
        'content' => array(
            array(
                'type' => 'cd--whatever',
                'content' => new LBPageResizer()
            )
        ) ,
        'box' => 'builder' ,
        'update' => true
    );
    
    
    resources::$type['page']                = array();
    resources::$box['page']                 = $box['page'];


?>