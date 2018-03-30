<?php

/**
 * Convert a string to a slug
 *
 * @param string $str Input string
 * @return string Valid URL string
 */
function zilla_to_slug($str)
{
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return $str;
}

/**
 * Parse inputs for Framework Settings page
 *
 * @param array $item Array holding input item values
 */
function zilla_create_input($item)
{
    $zilla_values = get_option('zilla_framework_values');
    
    echo '<div class="input '. zilla_to_slug($item['type']) .'">';
    
    // Set the class
    $class = '';
    if(array_key_exists('class', $item)) $class = ' class="'. $item['class'] .'"';
    // Do we ignore this input?
    $prefix = 'settings';
    if(array_key_exists('ignore', $item) && $item['ignore'] == true) $prefix = 'ignore';
    
    
    // text input
    if($item['type'] == 'text'){
        $val = '';
        if(array_key_exists('val', $item)) $val = ' value="'. $item['val'] .'"';
        if(array_key_exists($item['id'], $zilla_values)) $val = ' value="'. $zilla_values[$item['id']] .'"';
        echo '<input type="text" id="'. $item['id'] .'" name="'. $prefix .'['. $item['id'] .']"'. $val . $class .' />';
    }
    // textarea
    if($item['type'] == 'textarea'){
        $val = '';
        if(array_key_exists('val', $item)) $val = $item['val'];
        if(array_key_exists($item['id'], $zilla_values)) $val = $zilla_values[$item['id']];
        echo '<textarea id="'. $item['id'] .'" name="'. $prefix .'['. $item['id'] .']"'. $class .'>'. stripslashes($val) .'</textarea>';
    }
    // select
    if($item['type'] == 'select' && array_key_exists('options', $item)){
        echo '<select id="'. $item['id'] .'" name="'. $prefix .'['. $item['id'] .']"'. $class .'>';
        foreach($item['options'] as $key=>$value){   
            $val = '';
            if(array_key_exists($item['id'], $zilla_values)){
                if($zilla_values[$item['id']] == $key) $val = ' selected="selected"';
            } else {
                if(array_key_exists('val', $item) && $item['val'] == $key) $val = ' selected="selected"';
            }
            echo '<option value="'. $key .'"'. $val .'>'. $value .'</option>';
        }
        echo '</select>';
    }
    // pages select
    if($item['type'] == 'pages'){
        $zilla_pages_obj = get_pages();
        
        echo '<select id="'. $item['id'] .'" name="'. $prefix .'['. $item['id'] .']"'. $class .'>';
        foreach($zilla_pages_obj as $zilla_page){   
            $val = '';
            if(array_key_exists($item['id'], $zilla_values)){
                if($zilla_values[$item['id']] == $zilla_page->ID) $val = ' selected="selected"';
            } else {
                if(array_key_exists('val', $item) && $item['val'] == $zilla_page->ID) $val = ' selected="selected"';
            }
            echo '<option value="'. $zilla_page->ID .'"'. $val .'>'. $zilla_page->post_title .'</option>';
        }
        echo '</select>';
    }
    // category select
    if($item['type'] == 'categories'){
        $zilla_categories_obj = get_categories('hide_empty=0');
        
        echo '<select id="'. $item['id'] .'" name="'. $prefix .'['. $item['id'] .']"'. $class .'>';
        foreach($zilla_categories_obj as $zilla_category){   
            $val = '';
            if(array_key_exists($item['id'], $zilla_values)){
                if($zilla_values[$item['id']] == $zilla_category->cat_ID) $val = ' selected="selected"';
            } else {
                if(array_key_exists('val', $item) && $item['val'] == $zilla_category->cat_ID) $val = ' selected="selected"';
            }
            echo '<option value="'. $zilla_category->cat_ID .'"'. $val .'>'. $zilla_category->cat_name .'</option>';
        }
        echo '</select>';
    }
	// radio
    if($item['type'] == 'radio' && array_key_exists('options', $item)){
    	$i = 0;
        foreach($item['options'] as $key=>$value){   
            $val = '';
            if(array_key_exists($item['id'], $zilla_values)){
                if($zilla_values[$item['id']] == $key) $val = ' checked="checked"';
            } else {
                if(array_key_exists('val', $item) && $item['val'] == $key) $val = ' checked="checked"';
            }
            echo '<label for="'. $item['id'] .'_'. $i .'"><input type="radio" id="'. $item['id'] .'_'. $i .'" name="'. $prefix .'['. $item['id'] .']" value="'. $key .'"'. $val . $class .'> '. $value .'</label><br />';
            $i++;
        }
    }
    // checkbox
    if($item['type'] == 'checkbox'){
        $val = '';
        if(array_key_exists('val', $item) && $item['val'] == 'on') $val = ' checked="yes"';
        if(array_key_exists($item['id'], $zilla_values) && $zilla_values[$item['id']] == 'on') $val = ' checked="yes"';
        if(array_key_exists($item['id'], $zilla_values) && $zilla_values[$item['id']] != 'on') $val = '';
        echo '<input type="hidden" name="'. $prefix .'['. $item['id'] .']" value="off" />
        <input type="checkbox" id="'. $item['id'] .'" name="'. $prefix .'['. $item['id'] .']" value="on"'. $class . $val .' /> ';
        if(array_key_exists('text', $item)) echo $item['text'];
    }
    // multi checkbox
    if($item['type'] == 'multi_checkbox' && array_key_exists('options', $item)){
        foreach($item['options'] as $key=>$value){  
            $val = '';
            $id = $item['id'].'_'.zilla_to_slug($key);
            if($value == 'on') $val = ' checked="yes"';
            if(array_key_exists($id, $zilla_values) && $zilla_values[$id] == 'on') $val = ' checked="yes"';
            if(array_key_exists($id, $zilla_values) && $zilla_values[$id] != 'on') $val = '';
            echo '<input type="hidden" name="'. $prefix .'['. $id .']" value="off" />
            <input type="checkbox" id="'. $id .'" name="'. $prefix .'['. $id .']" value="on"'. $class . $val .' /> ';
            echo '<label for="'. $id .'">'. $key .'</label><br />';
        }
    }
    // file
    if($item['type'] == 'file'){
        $val = 'Upload';
        if(array_key_exists('val', $item)) $val = $item['val'];
        $wp_uploads = wp_upload_dir();
        ?>
		<div id="uploaded_<?php echo $item['id']; ?>" class="ajax-uploaded">
            <?php 
            if(array_key_exists($item['id'], $zilla_values)){
                $ext = substr($zilla_values[$item['id']], strrpos($zilla_values[$item['id']], '.') + 1);
                if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif')
                    echo '<img src="'. $zilla_values[$item['id']] .'" alt="" />'; 
                else 
                    echo $zilla_values[$item['id']]; 
            }
            ?>
        </div>
        <a href="#" id="ajax_upload_<?php echo $item['id']; ?>" class="button-secondary"><?php echo $val; ?></a>
        <a href="#" id="ajax_remove_<?php echo $item['id']; ?>" class="button-secondary"<?php if(!array_key_exists($item['id'], $zilla_values)){ echo ' style="display:none"'; } ?>><?php _e( 'Remove', 'zilla' ); ?></a>
        <script type="text/javascript">
        jQuery(document).ready(function($){ 
            var button = $('#ajax_upload_<?php echo $item['id']; ?>');
            var buttonVal = button.text();
            var interval = '';
            // AJAX upload
            new AjaxUpload(button, {
                action: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                data: { action:'zilla_ajax_upload', data:'<?php echo $item['id']; ?>' },
                onSubmit : function(file, ext){
                    button.text('Uploading');
                    this.disable();
                    
                     // Uploding -> Uploading. -> Uploading...
                    interval = window.setInterval(function(){
                        var text = button.text();
                        if (text.length < 13){
                            button.text(text + '.');
                        } else {
                            button.text('Uploading');
                        }
                    }, 200);
                },
                onComplete: function(file, response){
                    button.text(buttonVal);
                    this.enable();
                    window.clearInterval(interval);
                    response = jQuery.parseJSON(response);
                    if(response.file_url){
                        // Show image
                        $('#uploaded_<?php echo $item['id']; ?>').html('');
                        var ext = response.file_url.substr(response.file_url.lastIndexOf(".")+1,response.file_url.length);
                        if(ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
                            $('#uploaded_<?php echo $item['id']; ?>').html('<img src="' + response.file_url + '" alt="" />');
                        } else {
                            $('#uploaded_<?php echo $item['id']; ?>').text(response.file_url);
                        }
                        $('#ajax_remove_<?php echo $item['id']; ?>').show();
                    }
                }
            });
            
            var remove = $('#ajax_remove_<?php echo $item['id']; ?>');
            remove.bind('click', function(){
				remove.text('Removing...');
                $.post('<?php echo site_url(); ?>/wp-admin/admin-ajax.php', 
                    { action:'zilla_ajax_remove', data:'<?php echo $item['id']; ?>' }, 
                    function(data){
                        remove.fadeOut(500, function(){
							remove.text('Remove');
						});
                        $('#uploaded_<?php echo $item['id']; ?>').html('');
                    }
                );
				return false;
            });
        });
        </script>
        <?php
    }
	// color input
    if($item['type'] == 'color'){
        $val = '';
        if(array_key_exists('val', $item)) $val = ' value="'. $item['val'] .'"';
        if(array_key_exists($item['id'], $zilla_values)) $val = ' value="'. $zilla_values[$item['id']] .'"';
        echo '<div class="colorpicker-wrapper">';
        echo '<input type="text" id="'. $item['id'] .'_cp" name="'. $prefix .'['. $item['id'] .']"'. $val . $class .' />';
		echo '<div id="'. $item['id'] .'" class="colorpicker"></div>';
		echo '</div>';
    }
    // html
    if($item['type'] == 'html'){
        echo $item['val'];
    }
	// custom
    if($item['type'] == 'custom'){
		$func = '';
		$args = array();
		$id = '';
        if(array_key_exists('function', $item)) $func = $item['function'];
		if(array_key_exists('args', $item)) $args = $item['args'];
		if(array_key_exists('id', $item)) $id = $item['id'];
		
		if($func != '') call_user_func( $func, $id, $args );
    }
	
	// after
	if(array_key_exists('after', $item) && $item['after'] != ''){
		echo $item['after'];
	}
    
    echo '</div>';
}

/**
 * Add a Page to the Framework
 *
 * @param string $title Framework page title
 * @param array $data Framework page input data
 * @param int $order The order of the page in the menu
 */
function zilla_add_framework_page( $title, $data, $order = 0 )
{
    if( !is_array($data) ) return false;
    
    // Get current Framework pages
    $zilla_options = get_option('zilla_framework_options');
    $zilla_framework = array();
    if( is_array($zilla_options['zilla_framework']) ) $zilla_framework = $zilla_options['zilla_framework'];
    
    // Add new page
    $zilla_framework[$order] = array( $title => $data );
    
    // Save
    $zilla_options['zilla_framework'] = $zilla_framework;
    update_option('zilla_framework_options', $zilla_options);
}

/**
 * Is there an avialable theme update
 *
 * @return int|bool New theme version if required (zero otherwise), false on failure
 */
function zilla_do_you_need_to_get_your_update_on()
{
    // Well do you?
    $zilla_options = get_option('zilla_framework_options');
    $theme_version = 0;
    
    // Try and get the version
    $response = wp_remote_get( ZILLA_UPDATE_URL .'/?action=updatecheck&theme='. urlencode(ZILLA_THEME_NAME) );
	if( !is_wp_error( $response ) && wp_remote_retrieve_response_code($response) == 200 ) { 
        $remote_version = wp_remote_retrieve_body($response); 
        
        if( !$remote_version ) 
            $theme_version = false;
            
        if( $remote_version > $zilla_options['theme_version'] )
            $theme_version = $remote_version;
            
	} else { 
        $theme_version = false; 
	} 
        
    return $theme_version;
}

/**
 * Has the theme just been activated
 *
 * @return bool
 */
function zilla_is_theme_activated()
{
    global $pagenow;
    
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" )
        return true;
    return false;
} 

/**
 * Generate the labels for custom post types
 *
 * @param string $singular The singular post type name
 * @param string $plural The plural post type name
 * @return array Array of labels
 */
function zilla_post_type_labels( $singular, $plural = '' )
{
    if( $plural == '') $plural = $singular .'s';
    
    return array(
        'name' => _x( $plural, 'post type general name', 'zilla' ),
        'singular_name' => _x( $singular, 'post type singular name', 'zilla' ),
        'add_new' => __( 'Add New', 'zilla' ),
        'add_new_item' => sprintf( __( 'Add New %s', 'zilla' ), $singular),
        'edit_item' => sprintf( __( 'Edit %s', 'zilla' ), $singular),
        'new_item' => sprintf( __( 'New %s', 'zilla' ), $singular),
        'view_item' => sprintf( __( 'View %s', 'zilla' ), $singular),
        'search_items' => sprintf( __( 'Search %s', 'zilla' ), $plural),
        'not_found' =>  sprintf( __( 'No %s found', 'zilla' ), $plural),
        'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'zilla' ), $plural),
        'parent_item_colon' => ''
    );
}

/**
 * Generate the labels for custom taxonomies
 *
 * @param string $singular The singular taxonomy name
 * @param string $plural The plural taxonomy name
 * @return array Array of labels
 */
function zilla_taxonomy_labels( $singular, $plural = '' )
{
    if( $plural == '') $plural = $singular .'s';
    
    return array(
        'name' => _x( $plural, 'taxonomy general name', 'zilla' ),
        'singular_name' => _x( $singular, 'taxonomy singular name', 'zilla' ),
        'search_items' => sprintf( __( 'Search %s', 'zilla' ), $plural),
        'popular_items' => sprintf( __( 'Popular %s', 'zilla' ), $plural),
        'all_items' => sprintf( __( 'All %s', 'zilla' ), $plural),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => sprintf( __( 'Edit %s', 'zilla' ), $singular),
        'update_item' => sprintf( __( 'Update %s', 'zilla' ), $singular),
        'add_new_item' => sprintf( __( 'Add New %s', 'zilla' ), $singular),
        'new_item_name' => sprintf( __( 'New %s Name', 'zilla' ), $singular),
        'separate_items_with_commas' => sprintf( __( 'Separate %s with commas', 'zilla' ), $plural),
        'add_or_remove_items' => sprintf( __( 'Add or remove %s', 'zilla' ), $plural),
        'choose_from_most_used' => sprintf( __( 'Choose from the most used %s', 'zilla' ), $plural)
    ); 
}

/**
 * Get the changelog for this theme
 *
 * @return object Changelog xml
 */
function zilla_get_theme_changelog()
{ 	
    $zilla_options = get_option('zilla_framework_options');
	$changelog_url = ZILLA_UPDATE_URL .'/'. zilla_to_slug( $zilla_options['theme_name'] ) .'/changelog.xml';
	$trans_key = 'zilla_latest_theme_version_'. zilla_to_slug( $zilla_options['theme_name'] );
	if(ZILLA_DEBUG) echo '<p>Changelog URL: '. $changelog_url .'</p>';
	
	if ( false === ( $cached_xml = get_transient( $trans_key ) ) ){
		if( function_exists('curl_init') ){
			$ch = curl_init($changelog_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$xml = curl_exec($ch);
			curl_close($ch);
		} else {
			$xml = file_get_contents($changelog_url);
		}
	
		if ($xml){
			set_transient( $trans_key, $xml, 3600 ); // Cache for 1 hour
		} else {
			return false;
		}
	} else {
		$xml = $cached_xml;
	}
	
	return @simplexml_load_string($xml);
}

/**
 * Add an update notice to the dashboard when needed
 *
 */
function zilla_admin_notice() {  
    global $pagenow;

    if( $pagenow == 'index.php' && $xml = zilla_get_theme_changelog() ) {
        
        $theme_data = get_option('zilla_framework_options');
        $theme_name = $theme_data['theme_name'];
        $theme_version = $theme_data['theme_version'];

		if( version_compare( $theme_version, $xml->latest ) == -1 ) {
			?>
			<div id="message" class="updated">
				<p><?php printf( __( '<strong>There is a new version of the %s theme available.</strong> You have version %s installed. <a href="%s">Update to version %s</a>.', 'zilla' ), $theme_name, $theme_version, admin_url( 'admin.php?page=zillaframework-update' ), $xml->latest); ?></p>
			</div>
			<?php 
		}
	}
	
	return false;
}
add_action('admin_notices', 'zilla_admin_notice');

/**
 * Get the "More Themes" RSS feed
 *
 * @return object RSS feed
 */
function zilla_get_more_themes_rss()
{
	include_once(ABSPATH . WPINC . '/feed.php');

	$rss = fetch_feed('http://www.themezilla.com/feed/?post_type=theme');
	if ( !is_wp_error( $rss ) ){
	    return $rss->get_items(); 
	}
	
	return false;
}

/**
 * Are there any third party SEO plugins active
 *
 * @return bool True is other plugin is detected
 */
function zilla_is_third_party_seo()
{
	include_once( ABSPATH .'wp-admin/includes/plugin.php' );
	
	if( is_plugin_active('headspace2/headspace.php') ) return true;
	if( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) return true;
	if( is_plugin_active('wordpress-seo/wp-seo.php') ) return true;
	
	return false;
}

?>