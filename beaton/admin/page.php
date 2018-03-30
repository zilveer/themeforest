<?php

/*** SETTINGS
 ****************************************************************/
function wize_page_settings_load() {
	add_meta_box('page_settings_load', __('Page settings for Blog', 'wizedesign'), 'wize_page_settings', 'page', 'normal', 'high');
}

function wize_page_settings( $post ) {
	$values = get_post_custom( $post->ID );
	$number 	= isset( $values['page_number'] ) ? esc_attr( $values['page_number'][0] ) : '';
	$category 	= isset( $values['page_category'] ) ? esc_attr( $values['page_category'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>	
	<p>
		<label for="page_number">Number of posts</label>
		<input type="text" size="4" name="page_number" id="page_number" value="<?php echo esc_attr($number); ?>" />
	</p>
	<p>
		<label for="page_category">Category slug</label>
		<input type="text" size="12" name="page_category" id="page_category" value="<?php echo esc_attr($category); ?>" />
	</p>
	<?php	
}


function wize_page_settings_save( $post_id ) {
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure your data is set
	
	if( isset( $_POST['page_number'] ) )
		update_post_meta( $post_id, 'page_number', wp_kses( $_POST['page_number'], $allowed ) );
		
	if( isset( $_POST['page_category'] ) )
		update_post_meta( $post_id, 'page_category', wp_kses( $_POST['page_category'], $allowed ) );
			
}

add_action( 'add_meta_boxes', 'wize_page_settings_load' );
add_action( 'save_post', 'wize_page_settings_save' );


/*** SIDEBAR
 ****************************************************************/
function wize_page_sidebar_load() {
        add_meta_box('page_sidebar_load', __('Sidebar layout settings', 'wizedesign'), 'wize_page_sidebar', 'page', 'normal', 'core');
}

function wize_page_sidebar() {
    global $post;
    $layouts        = array(
        array(
            'icon' => 'sidebar-left.png',
            'name' => 'sidebar-left'
        ),
        array(
            'icon' => 'sidebar-full.png',
            'name' => 'sidebar-full'
        ),
        array(
            'icon' => 'sidebar-right.png',
            'name' => 'sidebar-right'
        )
    );
    $layout_default = 'sidebar-right';
    $wz_sidebar = null;
    $custom         = get_post_custom($post->ID);
    // Check if there is a setup layout
    if (array_key_exists('sidebar-layout', $custom)) {
        $wz_sidebar = $custom["sidebar-layout"][0];
    } else {
        $wz_sidebar = $layout_default;
    }
    echo '<div class="clearfix">';
    foreach ($layouts as $key => $layout) {
        $class = null;
        if ($wz_sidebar == $layout['name']) {
            $class = " active";
        } else {
            $class = null;
        }
        echo '<div style="background:url(' . get_template_directory_uri() . '/includes/images/' . $layout['icon'] . ') no-repeat;" class="wz-sidebar-post' . $class . '"  id="' . esc_attr($layout['name']) . '" ></div>';
    }
    echo '</div>';
    echo '<input type="hidden" id="wz-sidebar-post" name="wz-sidebar-post" value="' . esc_attr($wz_sidebar) . '" />';
}

function wize_page_sidebar_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $page = get_page( $post_ID );
    $post_status = get_post_status( $post_ID ); 
	if ($page && "auto-draft" != $post_status && isset($_POST['wz-sidebar-post']) ) {
    update_post_meta($post_ID, "sidebar-layout", $_POST["wz-sidebar-post"]);
    }

}

add_action('admin_menu', 'wize_page_sidebar_load');
add_action('save_post', 'wize_page_sidebar_save');


function wize_page_sidebar_layout($default = "sidebar-right") {
    global $post;
    $item_meta = get_post_custom($post->ID); // get the item custom variables
    if (is_array($item_meta) && array_key_exists('sidebar-layout', $item_meta)) {
        $layout = $item_meta["sidebar-layout"][0];
        if ($layout != null) {
            $default = $layout;
        }
    }
    return $default;
}


/*** SLIDER
 ****************************************************************/
function wize_page_slider_load() {
    add_meta_box('page_slider_load', __('Slider settings', 'wizedesign'), 'wize_page_slider', 'page', 'normal', 'high');
}

function wize_page_slider( $post ) {
    $values = get_post_custom($post->ID);
	$slider_nr 	= isset( $values['page_slider_nr'] ) ? esc_attr( $values['page_slider_nr'][0] ) : '';
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    $layouts        = array(
        array(
            'icon' => 'slider-full.png',
            'name' => 'sliderfull'
        ),
        array(
            'icon' => 'slider-boxed.png',
            'name' => 'sliderboxed'
        ),
        array(
            'icon' => 'slider-none.png',
            'name' => 'slidernone'
        )
    );
    $layout_default = 'slidernone';
    $wz_page_layout = null;
    $custom         = get_post_custom($post->ID);
    // Check if there is a setup layout
    if (array_key_exists('slider-layout', $custom)) {
        $wz_page_layout = $custom["slider-layout"][0];
    } else {
        $wz_page_layout = $layout_default;
    }
    echo '<div class="clearfix">';
    foreach ($layouts as $key => $layout) {
        $class = null;
        if ($wz_page_layout == $layout['name']) {
            $class = " active";
        } else {
            $class = null;
        }
        echo '<div style="background:url(' . get_template_directory_uri() . '/includes/images/' . $layout['icon'] . ') no-repeat;" class="wz_slider' . esc_attr($class) . '"  id="' . esc_attr($layout['name']) . '" ></div>';
    }
    echo '</div>';
    echo '<input type="hidden" id="wz_slider" name="wz_slider" value="' . esc_attr($wz_page_layout) . '" />';
?>	
	<p>
		<label for="page_slider_nr">Number of slides</label> 
		<input type="text" size="4" name="page_slider_nr" id="page_slider_nr" value="<?php echo esc_attr($slider_nr); ?>" />
	</p>
	
<?php
}

function wize_page_slider_save( $post_ID = 0 ) {
    $post_ID     = (int) $post_ID;
    $page        = get_page($post_ID);
    $post_status = get_post_status($post_ID);
	if ($page && "auto-draft" != $post_status && isset($_POST['wz_slider']) ) {
        update_post_meta($post_ID, "slider-layout", $_POST["wz_slider"]);
    }
    
    // Bail if we're doing an auto save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce'))
        return;
    
    // if our current user can't edit this post, bail
    if (!current_user_can('edit_post'))
        return;
    
    // now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );
    
    // Probably a good idea to make sure your data is set
	if( isset( $_POST['page_slider_nr'] ) )
		update_post_meta( $post_id, 'page_slider_nr', wp_kses( $_POST['page_slider_nr'], $allowed ) );
}

function wize_page_slider_layout($default = "slidernone") {
    global $post;
    $item_meta = get_post_custom($post->ID); // get the item custom variables
    if (is_array($item_meta) && array_key_exists('slider-layout', $item_meta)) {
        $layout = $item_meta["slider-layout"][0];
        if ($layout != null) {
            $default = $layout;
        }
    }
    return $default;
}

add_action('admin_menu', 'wize_page_slider_load');
add_action('save_post', 'wize_page_slider_save');
