<?php 
/*
	Show twitter status for jquery ticker
	Input : 
		- int $userid : id of your account on twitter.
		- int $x : the number of your tweets is get.
	Output :
		- html for jquery ticker. Examlple :
		<div id="ticker-wrapper" class="no-js">
			<ul id="js-news" class="js-hidden">
				<li class="status-item"><a href="http://twitter.com//statuses/20205378586">I'm Trang. I'm living in Vietnam now. I wanna say to u: "Hello. How do you do!" :D Follow me, plz. And I will follow u... [smile]</a></li>
				<li class="status-item"><a href="http://twitter.com//statuses/20129846782">Hello everybody. Am I connecting to the world? :D</a></li>
			</ul>
		</div><!-- #ticker-wrapper -->
*/

if(!function_exists('getLastXTwitterStatus')){
	function getLastXTwitterStatus($userid,$x){
		$cache_file = get_template_directory().'/cache_theme/twitter_'.$userid.'.txt';
		// Seconds to cache feed (1 hour).
		$cachetime = 60*60;
		// Time that the cache was last filled.
		$cache_file_created = ((@file_exists($cache_file))) ? @filemtime($cache_file) : 0;
		// Show file from cache if still valid.
		if (time() - $cachetime < $cache_file_created) {
			include($cache_file);	
		} else {
			try{
				$url = "http://twitter.com/statuses/user_timeline/$userid.xml?count=$x";
				$statuses = simplexml_load_file($url);
				ob_start();
				
						?>
						<div id="ticker-wrapper" class="no-js">
							<?php if(!empty($statuses->status)):?>
							<ul id="js-news" class="js-hidden">
								<?php foreach($statuses->status as $status):?>
								<li class="status-item"><a href="<?php echo 'http://twitter.com/'.$twitter_user.'/statuses/'.$status->id; ?>"><?php echo twitterify($status->text);?></a></li>
								<?php endforeach;?>
							</ul>
							<?php endif;?>				
						</div><!-- #ticker-wrapper -->
			<?php 
				// Save the contents of output buffer to the file, and flush the buffer. 
				global $wp_filesystem;
				if( empty( $wp_filesystem ) ) {
					require_once( ABSPATH .'/wp-admin/includes/file.php' );
					WP_Filesystem();
				}

				if( $wp_filesystem ) {
					$wp_filesystem->put_contents(
						$cache_file,
						ob_get_contents(),
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
				ob_end_flush();
			}catch(Excetion $e){
				$result = new StdClass();
				$result->status = array();
				return $result;
			}
		}
		
	}
}

if(!function_exists('twitterify')){
	function twitterify($ret) {
		$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" >\\2</a>", $ret);
		$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" >\\2</a>", $ret);
		$ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" >@\\1</a>", $ret);
		$ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" >#\\1</a>", $ret);
		return $ret;
	}
}
?>