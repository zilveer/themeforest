<?php
class BFIAdminPanelSpeedupModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 200;
        $this->menuName = 'Speed up your site';
        $this->showSaveButtons = false;
        $this->additionalHTML = '';
        $this->title = 'Tips on how to Speed up your WordPress Site';
        parent::__construct();
    }
    
    public function createOptions() {

			$this->addOption(array(
			    "name" => "Table of Contents",
			    "desc" => "Here're some tips I've collected on how to speed up your site. Note that some of these won't work if you are using a shared or hosted WordPress site since they probably won't let you change their server's settings. That's okay though, since they've probably have optimizations of their own.",
			    "type" => "toc",
			    ));
               //      
               // $this->addOption(array(
               //     "name" => "",
               //     "desc" => "",
               //     "type" => "note",
               //     ));
       
        $this->addOption(array(
            "name" => "WordPress Configuration (wp-config.php)",
            "type" => "heading"
            ));

		$this->addOption(array(
			"name" => "Remove Post Revisions",
			"desc" => "WordPress saves all your post/page revisions in your database. As your site grows, this might make your database unnecessarily big. You can turn this feature off by adding this line in your wp-config.php:<br><br><code>define('WP_POST_REVISIONS', false );</code>",
			"type" => "note",
		));		
		

		$this->addOption(array(
		       "name" => "WordPress Plugins",
		       "type" => "heading"
		       ));
		
		$this->addOption(array(
			"name" => "WP Super Cache",
			"desc" => "WP Super Cache is a very fast caching engine that's very easy to install and use. This is a <strong>MUST</strong> with every WordPress website! Download it here:<br><br><a href='http://wordpress.org/extend/plugins/wp-super-cache/download/' target='_blank'>http://wordpress.org/extend/plugins/wp-super-cache/download/</a>",
			"type" => "note",
		));
		


		$this->addOption(array(
		       "name" => "PHP Tips",
		       "type" => "heading"
		       ));
		
		$this->addOption(array(
			"name" => "eAccelerator",
			"desc" => "WordPress uses PHP, and PHP's engine compiles code on every page load; this can be costly. eAccelerator stores and re-uses compiled code to make loading times blazing fast! If you are permitted to install software in your server, this can definitely cut down load times by a <strong>TON</strong>. eAccelerator is open source and is very stable. Download eAccelerator here:<br><br><a href='http://eaccelerator.net/' target='_blank'>http://eaccelerator.net/</a>",
			"type" => "note",
		));



        $this->addOption(array(
            "name" => "Apache .htaccess Tips",
            "type" => "heading"
            ));

		$this->addOption(array(
			"name" => "Remove ETags",
			"desc" => "\"Entity tags (ETags) are a mechanism that web servers and browsers use to determine whether the component in the browser's cache matches the one on the origin server.\" (from ySlow). You can opt to not use this feature to shave off additional data being transferred during page load. Just add these lines to your <strong>.htaccess file</strong>:<br><br><code>Header unset ETag<br>FileETag None</code>",
			"type" => "note",
		));

		$this->addOption(array(
			"name" => "Compression",
			"desc" => "Text data (XMLs, CSS, JavaScript and HTML) can be compressed by your server to lessen the file size of the pages being delivered then decompressed afterwards by your browser to make your site load faster (and also lessen your bandwidth usage a little). You can enable this by adding these lines to your <strong>.htaccess file</strong>:<br><br><code>&lt;ifModule mod_deflate.c><br>
				&nbsp;&nbsp;&nbsp;&nbsp;AddOutputFilterByType DEFLATE text/html text/plain text/xml application/xml application/xhtml+xml text/css text/javascript application/javascript application/x-javascript<br>
			&lt;/ifModule></code>",
			"type" => "note",
		));

		$this->addOption(array(
			"name" => "Browser Caching",
			"desc" => "Browsers can keep local copies of parts of your website after a user's first visit. This can vastly speed up navigation in your site. If your server has <strong>mod_expires</strong> and <strong>mod_headers</strong> modules (most likely Apache has this already), you can enable browser caching by adding these lines in your <strong>.htaccess file</strong>:<br><br><code># BEGIN Expire headers<br>
			&lt;ifModule mod_expires.c><br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresActive On<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresDefault \"access plus 5 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType image/x-icon \"access plus 2592000 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType image/jpeg \"access plus 2592000 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType image/png \"access plus 2592000 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType image/gif \"access plus 2592000 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType application/x-shockwave-flash \"access plus 2592000 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType text/css \"access plus 604800 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType text/javascript \"access plus 216000 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType application/javascript \"access plus 216000 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType application/x-javascript \"access plus 216000 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType text/html \"access plus 600 seconds\"<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ExpiresByType application/xhtml+xml \"access plus 600 seconds\"<br>
			&lt;/ifModule><br>
			# END Expire headers<br>
			<br>
				# BEGIN Cache-Control Headers<br>
				&lt;ifModule mod_headers.c><br>
				&nbsp;&nbsp;&nbsp;&nbsp;	&lt;filesMatch \"\\.(ico|jpe?g|png|gif|swf)$\"><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		Header set Cache-Control \"public\"<br>
&nbsp;&nbsp;&nbsp;&nbsp;					&lt;/filesMatch><br>
&nbsp;&nbsp;&nbsp;&nbsp;					&lt;filesMatch \"\\.(css)$\"><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						Header set Cache-Control \"public\"<br>
&nbsp;&nbsp;&nbsp;&nbsp;					&lt;/filesMatch><br>
&nbsp;&nbsp;&nbsp;&nbsp;					&lt;filesMatch \"\\.(js)$\"><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						Header set Cache-Control \"private\"<br>
&nbsp;&nbsp;&nbsp;&nbsp;					&lt;/filesMatch><br>
&nbsp;&nbsp;&nbsp;&nbsp;					&lt;filesMatch \"\\.(x?html?|php)$\"><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						Header set Cache-Control \"private, must-revalidate\"<br>
&nbsp;&nbsp;&nbsp;&nbsp;					&lt;/filesMatch><br>
				&lt;/ifModule><br>
				# END Cache-Control Headers
			
			</code>",
			"type" => "note",
		));


		$this->addOption(array(
            "name" => "MySQL Tips",
            "type" => "heading"
            ));

		$this->addOption(array(
			"name" => "Query Cache",
			"desc" => "WordPress repeatedly queries the database (MySQL) for information. MySQL can cache queries and their results to make future calls faster. Make sure it is turned on by opening your configuration file, usually <strong>/etc/my.ini</strong> and check if your have these two lines:<br><br><code>query_cache_type = 1<br>query_cache_size = 26214400</code>",
			"type" => "note",
		));
		
		



		$this->addOption(array(
		       "name" => "CloudFlare",
		       "type" => "heading"
		       ));
		
		$this->addOption(array(
			"name" => "CloudFlare (Advanced users)",
			"desc" => "CloudFlare is a DNS service that supercharges your website's speed. All you have to do is <a href='http://www.cloudflare.com' target='_blank'>sign up for free with CloudFlare</a>, then change your domain's DNS settings and point them to CloudFlare. CloudFlare takes care of the rest by caching your site's resources in their CDN (thus making your site faster and also save you bandwidth), they also provide security by filtering out threats (bots, etc).<br><br>If you do use CloudFlare, I would recommend setting your site up with the <strong>CDN Only</strong> setting and with file and <strong>Auto minify turned OFF</strong> since your site may display differently otherwise.",
			"type" => "note",
		));
    }
}
?>