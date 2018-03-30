<?php
// Original code courtesy of Unisphere Design - http://themeforest.net/user/unisphere            
function update_notifier_menu() {  
	$xml = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme('kingsize'); // Get theme data from style.css (current version is what we want)
	
	if(version_compare($theme_data['Version'], $xml->latest) == -1) {
		add_dashboard_page( $theme_data['Name'] . ' Theme Update', $theme_data['Name'] . '<span class="update-plugins count-1"><span class="update-count">Update</span></span>', 'administrator', strtolower($theme_data['Name']) . '-updates', 'update_notifier');
	}
}   

add_action('admin_menu', 'update_notifier_menu');

function update_notifier() { 
	$xml = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data =  wp_get_theme( 'kingsize' ); // Get theme data from style.css (current version is what we want) wp_get_theme	
	?>
	
	<style>
		.update-nag {display: none;}
		#instructions {}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo $theme_data['Name']; ?> Theme Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo $theme_data['Name']; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Please update to version <?php echo $xml->latest; ?>.</p></div>
        
        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo esc_url( get_template_directory_uri() )  . '/screenshot.png'; ?>" />
        
        <div id="instructions" style="">
            
            <h3>Version <?php echo $xml->latest; ?> is Now Available! Here's how to update!...</h3>
            
            <p>There is a new version of <a href="http://themeforest.net/item/king-size-fullscreen-background-wordpress-theme/166299?ref=OWMLabs">KingSize WordPress</a> available for download on Themeforest!</p>
            
            <p>To download this head over to Themeforest, log in and go to <a href="http://themeforest.net/downloads?ref=OWMLabs" target="blank">Downloads</a>.</p>
            
            <p>Locate in your list of downloads, our theme and click "Download" (green button).</p>
            
            <p>When download is clicked it will drop-down more options, you will select <em>"Installable WordPress file only"</em>.</p>
            
            <p>After downloading the updated files, extract that and follow these next steps:</p>
            
            <p><strong>ONE:</strong> <em style="color: #ff0000;">Backup your website BEFORE you update it!</em></p>
            
            <p><strong>TWO:</strong> Connect to your website using FTP (<a href="https://filezilla-project.org/" target="blank">FileZilla</a> or similar) and locate your WordPress install.</p>
            
            <p><strong>THREE:</strong> Inside your WordPress install locate the <em>"/wp-content/themes/"</em> directory.</p>
            
            <p><strong>FOUR:</strong> You should see inside the "/themes" folder an existing "kingsize" folder.</p>
            
            <p><strong>FIVE:</strong> With the new downloaded version from Themeforest, upload it to overwrite the existing folder.</p> 
            
            <p><strong>SIX:</strong> That's it! Load your website and ensure it's all working as it did before.</p>
            
            <p><strong>TIP:</strong> If new Theme Option features were added, it's a good practice to "Save All Changes" after updating.</p>
            
            <p>For more help, review our <a href="http://www.kingsizetheme.com/tag/change-log/" target="blank">Change Logs</a>, <a href="http://www.ourwebmedia.com/clients/knowledgebase.php" target="blank">FAQs</a> and <a href="https://www.youtube.com/playlist?list=PLKnLRhNTdKhYpXHh82Znbrp3iIeGIM0Qd" target="blank">Video Tutorials</a>, as well other tutorials on our demo site <a href="http://www.kingsizetheme.com/blog" target="blank">blog</a>.</p>
            
            <p>If you need help, drop by our Free Buyer Support Forums: <a href="http://www.ourwebmedia.com/support" target="blank">http://www.ourwebmedia.com/support</a></p>
            
            <p>Not comfortable updating it yourself? <a href="http://www.ourwebmedia.com/clients/submitticket.php?step=2&deptid=3" target="blank">Contact us</a> and for $25.00 we'll update your version of KingSize WordPress within 24hrs of the service requested (limited to Monday through Thursday only).</p>
            
			<p><?php echo $xml->info; ?></p>
			
        </div>
        
        <div class="clear"></div>

	</div>
    
<?php } 

// This function retrieves a remote xml file on my server to see if there's a new update 
// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)
function get_latest_theme_version($interval) {
	// remote xml file location
	$notifier_file_url = 'http://www.kingsizetheme.com/notification/notifier.xml';
	
	$db_cache_field = 'kingsize-notifier-cache';
	$db_cache_field_last_updated = 'kingsize-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		if( function_exists('curl_init') ) { // if cURL is available, use it...
			$ch = curl_init($notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
		} else {
			$cache = @file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
		}
		
		if ($cache) {			
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );			
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	if ( function_exists('simplexml_load_string') ) {	
		return @simplexml_load_string($notifier_data); 	
	}
	
}

?>
