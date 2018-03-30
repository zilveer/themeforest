<?php

/**
 * Theme Options Page
 */
function zilla_options_page(){    
	global $zilla_changelog_link, $zilla_docs_link;
	$zilla_options = get_option('zilla_framework_options');
    ksort($zilla_options['zilla_framework']);
    ?>
    <div id="zilla-framework-messages">
        <?php if(isset($_GET['activated'])){ ?>
        <div class="updated" id="message"><p><?php echo sprintf( __('%s activated', 'zilla'), $zilla_options['theme_name'] ); ?></p></div>
        <?php } ?>
        <?php if($xml = zilla_get_theme_changelog()){

            $theme_name = $zilla_options['theme_name'];
            $theme_version = $zilla_options['theme_version'];

    		if( version_compare( $theme_version, $xml->latest ) == -1 ) {
			?>
				<div id="message" class="updated">
					<p><?php echo sprintf( __('<strong>There is a new version of the %s theme available.</strong> You have version %s installed. Update to version %s', 'zilla' ), $theme_name, $theme_version, $xml->latest ); ?></p>
				</div>
				<?php 
			}
		}
		?>
    </div>
	<div id="zilla-framework" class="clearfix">
		<form action="<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>" method="post">
			<div class="header clearfix">
			    <a href="http://themezilla.com" target="_blank" class="zilla-logo">
			        <img src="<?php echo get_template_directory_uri(); ?>/framework/images/logo.png" alt="ThemeZilla" />
		        </a>
				<h1 class="theme-name"><?php echo $zilla_options['theme_name']; ?></h1>
				<span class="theme-version">v.<?php echo $zilla_options['theme_version']; ?></span>
				<ul class="theme-links">
					<li><a href="http://www.themezilla.com/support/" target="_blank" class="forums"><?php _e( 'Support Forums', 'zilla' ); ?></a></li>
					<li><a href="<?php echo admin_url( 'admin.php?page=zillaframework-themes' ); ?>" class="themes"><?php _e( 'More Themes', 'zilla' ); ?></a></li>
				</ul>
			</div>
			<div class="main clearfix">
				<div class="nav">
					<ul>
                    
						<?php foreach( $zilla_options['zilla_framework'] as $page ){ ?>
                        
                        <li><a href="#<?php echo zilla_to_slug( key($page) ); ?>"><?php echo key($page); ?></a></li>
                        
                        <?php } ?>
                        
					</ul>
				</div>
				<div class="content">
                
					<?php foreach( $zilla_options['zilla_framework'] as $page ){ ?>
                    
                    <div id="page-<?php echo zilla_to_slug( key($page) ); ?>" class="page">
                        <h2><?php echo key($page); ?></h2>
                        <p class="page-desc"><?php 
                        if( isset($page[key($page)]['description']) && $page[key($page)]['description'] != '') echo $page[key($page)]['description']; 
                        ?></p>
                        <?php foreach( $page[key($page)] as $item ){ ?>
                        	<?php if(key((array)$item) == 'description') continue; ?>
                            <div class="section <?php echo zilla_to_slug( $item['title'] ); ?>">
                                <h3><?php echo $item['title']; ?></h3>
                                <?php if(isset($item['desc']) && $item['desc'] != ''){ ?>
                                <div class="desc">
                                    <?php echo $item['desc']; ?>
                                </div>
                                <?php } ?>
                                <?php zilla_create_input( $item ); ?>
                                <div class="zilla-clear"></div>
                            </div>
                        <?php } ?>
                        
                    </div>
                    
                    <?php } ?>
				</div>
				<div class="zilla-clear"></div>
			</div>
			<div class="footer clearfix">
                <input type="hidden" name="action" value="zilla_framework_save" />
                <input type="hidden" name="zilla_noncename" id="zilla_noncename" value="<?php echo wp_create_nonce('zilla_framework_options'); ?>" />
                <input type="button" value="<?php _e( 'Reset Options', 'zilla' ); ?>" class="button" id="reset-button" />
                <input type="submit" value="<?php _e( 'Save All Changes', 'zilla' ); ?>" class="button-primary" id="save-button" />
			</div>
		</form>
	</div>
    
	<?php if( ZILLA_DEBUG ){ ?>
    <div id="zilla-debug">
        <p><strong>Debug Output</strong></p>
        <textarea><?php 
        echo '//zilla_framework_values'."\n";
        print_r(get_option('zilla_framework_values'));
        echo '//zilla_framework_options'."\n";
        print_r($zilla_options);
        echo '//misc'."\n";
        echo 'TEMPLATEPATH: '. get_template_directory();
        ?></textarea>
    </div>
    <?php }
}

/**
 * AJAX Save Options
 */
function zilla_framework_save(){
    $response['error'] = false;
    $response['message'] = '';
    $response['type'] = '';
    
    // Verify this came from the our screen and with proper authorization
    if(!isset($_POST['zilla_noncename']) || !wp_verify_nonce($_POST['zilla_noncename'], plugin_basename('zilla_framework_options'))){
        $response['error'] = true;
        $response['message'] = __('You do not have sufficient permissions to save these options.', 'zilla' );
        echo json_encode($response);
    	die;
    }
            
    $zilla_values = get_option('zilla_framework_values');
    foreach( $_POST['settings'] as $key => $val ){
        $zilla_values[$key] = $val;
    }
    
    $zilla_values = apply_filters( 'zilla_framework_save', $zilla_values ); // Pre save filter
    
    update_option('zilla_framework_values', $zilla_values);
    
    $response['message'] = __( 'Settings saved', 'zilla' );    
    echo json_encode($response);
    die;
}
add_action('wp_ajax_zilla_framework_save', 'zilla_framework_save');

/**
 * AJAX Reset Options
 */
function zilla_framework_reset(){
    $response['error'] = false;
    $response['message'] = '';
    
    // Verify this came from the our screen and with proper authorization
    if(!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], plugin_basename('zilla_framework_options'))){
        $response['error'] = true;
        $response['message'] = __('You do not have sufficient permissions to reset these options.', 'zilla' );
        echo json_encode($response);
    	die;
    }
            
    update_option('zilla_framework_values', array());
      
    echo json_encode($response);
    die;
}
add_action('wp_ajax_zilla_framework_reset', 'zilla_framework_reset');

/**
 * Framework AJAX upload
 */
function zilla_ajax_upload(){
    $response['error'] = false;
    $response['message'] = '';
    
    $wp_uploads = wp_upload_dir();
    $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
    $filename = zilla_to_slug(basename($_FILES['userfile']['name'], $ext));
    $filename = rtrim($filename, '-') .'.'. $ext;    
    $uploadfile = $wp_uploads['path'] .'/'. $filename;

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        $zilla_values = get_option('zilla_framework_values');
        $zilla_values[$_POST['data']] = $wp_uploads['url'] .'/'. $filename;
        update_option('zilla_framework_values', $zilla_values);
        $response['message'] =  'success';
        $response['file_url'] = $wp_uploads['url'] .'/'. $filename;
    } else {
        $response['error'] = true;
        $response['message'] =  'error'; 
    }
    
    echo json_encode($response);
    die;
}
add_action('wp_ajax_zilla_ajax_upload', 'zilla_ajax_upload');

/**
 * Framework AJAX remove upload
 */
function zilla_ajax_remove(){
    $response['error'] = false;
    $response['message'] = '';
    
    $data = $_POST['data'];

    $zilla_values = get_option('zilla_framework_values');
    unset($zilla_values[$_POST['data']]);
    update_option('zilla_framework_values', $zilla_values);
    $response['message'] =  'success';
    
    echo json_encode($response);
    die;
}
add_action('wp_ajax_zilla_ajax_remove', 'zilla_ajax_remove');
    
?>