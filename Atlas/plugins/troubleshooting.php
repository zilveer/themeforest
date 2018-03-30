<?php

/*
	Begin Create Troubleshooting Options
*/

add_action('admin_menu', 'pp_troubleshooting');

function pp_troubleshooting() {

  add_submenu_page('functions.php', 'Troubleshooting', 'Troubleshooting', 'manage_options', 'pp_troubleshooting', 'pp_troubleshooting_options');

}

function pp_troubleshooting_options() {

  	if (!current_user_can('manage_options'))  {
    	wp_die( __('You do not have sufficient permissions to access this page.') );
  	}
  	
  	$plugin_url = get_stylesheet_directory_uri().'/plugins/troubleshooting';
?>

<div class="wrap rm_wrap">
	<div class="header_wrap">
	<h2>Troubleshooting</h2>
	
	For future updates follow me <a href="http://themeforest.net/user/peerapong">@themeforest</a> or <a href="http://twitter.com/ipeerapong">@twitter</a>
	<br/><br/>
	
	<div id="message" class="updated fade">
	<p style="line-height:1.5em"><strong>
		Please read the instructions in /manual folder from your download package. It will help guide you taking advantage all features of <?php echo $themename; ?> Template ;)
	</p></strong>
	</div>
	</div>
	
	<br/>
	
	<div style="padding:10px 20px 30px 20px;background:#fff">
	<h3>Q: Why the menu, slider or everything are broken?</h3>
	
	Please check.<br/><br/>
	
	<ol>
		<li>Make sure you unzip the file first because there are many folder in the file ex. manual, theme, license info.</li>
		<li>There might be javascript conflict between theme’s script and plugin’s script. <strong>(Try to disable all plugins)</strong></li>
		<li>Check if you create the Wordpress custom menu.</li>
		<li>Try to re-download the file again from Themeforest and upload to your server. Some files are broken while downloading or uploading which cause this issue.</li>
	</ol>
	
	<br/><hr/>
	
	<h3>Some of my page's contents hidden</h3>
	
	A: You can expend page height by using expand_height shortcode. Below is an example of expand page height 300 pixels
	<br/><br/>
	<pre>
		[expand_page height="300"]
	</pre>
	
	<br/><hr/>
	
	<h3>Q: Why the menu isn't show up?</h3>
	A: You have to setup the menu via <strong>Appearance > Menus</strong>.
	
	<p>
			For those who are not familiar with Wordpress 3.0 menu below are some tutorials. 
		</p>
		
		<object width="640" height="385"><param name="movie" value="http://www.youtube.com/v/Idt7oyCD1qY?fs=1&amp;hl=en_US&amp;rel=0&amp;color1=0x3a3a3a&amp;color2=0x999999"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/Idt7oyCD1qY?fs=1&amp;hl=en_US&amp;rel=0&amp;color1=0x3a3a3a&amp;color2=0x999999" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="385"></embed></object>
		<br/><br/>
		
		<ol>
			<li><a href="http://templatic.com/news/wordpress-3-0-menu-management">http://templatic.com/news/wordpress-3-0-menu-management</a></li>
			<li><a href="http://www.wonderhowto.com/how-to-use-new-menu-system-wordpress-3-0-thelonious-376792/">http://www.wonderhowto.com/how-to-use-new-menu-system-wordpress-3-0-thelonious-376792/</a></li>
		</ol>
		
		<strong>*Note: Please check if you named your menu as "Main Menu".</strong>
		
	<br/><hr/>
	
	<h3>Q: Why I use shortcode but it's incorrectly align?</h3>
	
	A: It's because Wordpress automatically insert p tag, you can solve this issue using below plugin
<a href="http://wordpress.org/extend/plugins/text-control/">http://wordpress.org/extend/plugins/text-control/</a>
	
	<br/><hr/>
	
	<h3>Q: Why all of my images isn't show up?</h3>
	A: There are many reason for that, please follow the checklist below.
	<br/><br/>
	<ol>
		<li>Please check if your <strong><?php echo TEMPLATEPATH; ?>/cahce</strong> folder of the theme is writable (chmod 777)</li>
		<li>Try to visit <strong><a href="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php"><?php echo get_stylesheet_directory_uri(); ?>/timthumb.php</a></strong> and see if you get any errors <br/><br/>ex. internal server error, 404 not found. If so then <strong>contact you hosting provider, there might be some server settings which block accessing timthumb file</strong></li>
		<li><strong>Hot-link image is not support.</strong> Please use only image from your server.</li>
		<li>Check if you <strong>set featured image</strong> in Wordpress post page.</li>
	</ol>
	
	<br/><hr/>
	
	<h3>Q: Why map shortcode is not working?</h3>
	A: You have to enter a Google Maps API key in Yen admin panel. <a href="http://code.google.com/apis/maps/signup.html">You can get your API key here</a>
	
	<br/>
	
	</div>
</div>
<br style="clear:both"/>

<?php

}

/*
	End Create Troubleshooting Options
*/

?>