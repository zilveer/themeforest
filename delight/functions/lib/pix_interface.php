<?php
if(session_id() == "") session_start();
function pix_add_admin() {

    global $themename, $options, $shortname, $current_user;
	
	get_currentuserinfo();

function pix_admin() {

    global $themename, $options, $shortname, $current_user;
	get_currentuserinfo();

    if ( isset($_REQUEST['action']) && $_REQUEST['action']=='save' ) echo '
	<script type="text/javascript">
		//<![CDATA[
		jQuery(window).one("load",function(){
			jQuery("#settings-saved").fadeIn(500);
			var set = setTimeout(function(){jQuery("#settings-saved").fadeOut(500)},6000);
		});
		//]]>
	</script>
	';
    if ( isset($_REQUEST['action']) && $_REQUEST['action']=='reset' ) echo '
		<script type="text/javascript">
		//<![CDATA[
		jQuery(window).one("load",function(){
			jQuery("#settings-reset").fadeIn(500);
			var set = setTimeout(function(){jQuery("#settings-reset").fadeOut(500)},6000);
		});
		//]]>
	</script>
	';
    

	if( $current_user->display_name == 'pix_test' ) {
		pix_delete_session_files();
	}

	if (isset($_GET['activate']) && $_GET['activate']=='true') {
		pix_include_css();
		pix_include_js();
	}

?>

<div id="pix_wrap">
<?php if ($current_user->display_name == 'pix_test' || $current_user->display_name == 'manu_test') { ?><p class="howto" style="padding:5px 10px">In this preview you can see only the <strong>Delight Admin panel</strong>, nothing else. And some features of the admin panel itself are unavailable, such as the media uploading... <strong>but try to change something and go <a href="http://www.pixedelic.com/themes/delight/" target="_blank">back to the site</a> to see the result!</strong></p><?php } ?>

<?php 
	$css_dir = TEMPLATEPATH . '/functions/includes/';
	$css_file = $css_dir . 'css_include.css';
    $my_theme = wp_get_theme();
    $pix_cur_version = $my_theme->get( 'Version' );
    if(get_pix_option('pix_use_timthumb')=='show') { ?>
<div id="message" class="updated" style="padding:5px 10px; margin:0 5px 10px">
            <strong>This is a recommendation:</strong> turn TimThumb off (the script that resizes the images on the fly) by going to Delight admin panel &rarr; General &rarr; Scripts. TimThumb was used in the first versions of Delight, but it is getting more and more unstable and I preferred to offer a different solution.
            <br>
            <br>If you already installed a version earlier than 5.0.0, you need to regenerate the images on your server. In this case, please install and run this plugin to work without TimThumb: <a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/" target="_blank">http://wordpress.org/extend/plugins/regenerate-thumbnails/</a>
        </div><?php } ?>
    <?php if(get_pix_option('pix_css_inline')!='true' && !is_writeable($css_file)) { ?>
<div id="message" class="error" style="padding:5px 10px; margin:0 5px 10px">
            You must change the <strong>CHMOD</strong> of one of your files to make Delight work correctly. Set the <strong>CHMOD</strong> of these files:<br>
            <code><?php echo TEMPLATEPATH; ?>/functions/includes/css_include.css</code><br>
            <code><?php echo TEMPLATEPATH; ?>/functions/includes/js_include.js</code><br>
            to <strong>777</strong>. If you don't know what CHMOD is or how to change it have a look to <a href="https://www.google.it/search?sugexp=chrome,mod=16&sourceid=chrome&ie=UTF-8&q=how+to+change+chomd#hl=it&sa=X&ei=uUq2T8H4Lq754QTt6-mfCQ&ved=0CAgQvwUoAQ&q=how+to+change+chmod&spell=1&bav=on.2,or.r_gc.r_pw.r_cp.r_qf.,cf.osb&fp=37f51f292a0d3a84&biw=1496&bih=732" target="_blank">Google</a> or to the <a href="http://codex.wordpress.org/Changing_File_Permissions" target="_blank">official documentation</a>
        </div><?php } ?>
	<div id="pix_credits">
    	<div id="pix_credits_right">a <span id="pixedelic"><a href="http://www.pixedelic.com/" target="_blank">Pixedelic</a></span> by <span id="consorziocreativo"><a href="http://consorziocreativo.com" target="_blank">Consorzio Creativo</a></span> work</div>
    </div><!-- #pix_credits -->
    <div id="pix_header">

    	<div id="pix_header_left">
            <div id="pix_header_right">
            	<a id="delight_admin_panel">&nbsp;</a>
                <div id="header-alert">
                	<div id="header-left-alert">
                        <div id="header-right-alert">
                            <a href="http://www.pixedelic.com/delight_current_version_changelog.php" id="update-button" class="toleft" title="Delight v.<?php echo $pix_cur_version; ?> is installed. Click here to know if a new version is available">&nbsp;</a>
                        </div><!-- header-right-alert -->
                    </div><!-- header-left-alert -->
                </div><!-- #header-alert -->
                <div id="header-buttons">
                	<a href="#" id="settings-reset">&nbsp;</a>
                	<a href="#" id="settings-saved">&nbsp;</a>
                	<a href="mailto:manuel.masia@consorziocreativo.com" id="mail-button" class="toleft" title="Contact the developer">&nbsp;</a>
                </div><!-- #header-buttons -->
            </div><!-- #pix_header_right -->
        </div><!-- #pix_header_left -->
    </div><!-- #pix_header -->
    
        <div id="pix_body">
            <ul id="pix_aside">
                <li><a href="#general-tab" id="general_icon" title="Here you can decide layouts, positions, paste some scripts..." data-width="200">General</a></li>
                <li><a href="#typo-tab" id="typo_icon" title="Select the fonts from Google Web fonts, their size... but not their colors" data-width="200">Typography</a></li>
                <li><a href="#colors-tab" id="colors_icon" title="Decide the color or the background of any element" data-width="200">Colors &amp; images</a></li>
                <li><a href="#frontpage-tab" id="frontpage_icon" title="The blog page... it could be the home page too" data-width="200">Posts page</a></li>
                <li><a href="#sidebar-tab" id="sidebar_icon" title="Generate and admin your sidebars" data-width="200">Sidebars</a></li>
                <li><a href="#contact-tab" id="contact_icon" title="Generate and admin your contact forms" data-width="200">Contacts</a></li>
                <li><a href="#blog-tab" id="blog_icon" title="Decide the settings of posts and pages, including the 404 page, the search results page and archives" data-width="200">Blog</a></li>
                <li><a href="#portfolio-main-tab" id="portfolio_icon" class="toright" title="Set all the features of your galleries" data-width="200">Portfolio</a></li>
                <li><a href="#translation-tab" id="translation_icon" class="toright" title="How to generate your own localization file" data-width="200">Translation</a></li>
                <li><a href="#styles-tab" id="styles_icon" class="toright" title="Add custom styles... they won't be overwrite with an update" data-width="200">Styles</a></li>
                <li><a href="#help-tab" id="help_icon" class="toright" title="Hacks &amp; tips... have a look" data-width="200">Hacks &amp; tips</a></li>
            </ul><!-- #pix_aside -->
        
            <div id="general-tab">
                <ul>
                    <li><a href="#layout-tab">Layout</a></li>
                    <li><a href="#header-tab">Header</a></li>
                    <li><a href="#navigation-tab">Navigation</a></li>
                    <li><a href="#footer-tab">Footer</a></li>
                    <li><a href="#seo-tab">SEO</a></li>
                    <li><a href="#media-tab">Media</a></li>
                    <li><a href="#scripts-tab">Scripts</a></li>
                    <li><a href="#slideshows-tab">Slideshows</a></li>
                </ul>
                <form method="post">
                <div id="layout-tab">
                    <div class="block_separator">
                        <label for="pix_layout_animated">Animation on loading</label>
                        <input type="hidden" value="0" name="pix_layout_animated">
                        <input type="checkbox" value="show" name="pix_layout_animated"<?php if(get_pix_option('pix_layout_animated')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sliding_page">Sliding page</label>
                        <select id="pix_sliding_page" name="pix_sliding_page">
                            <option value="open"<?php if (get_pix_option('pix_sliding_page') == 'open') { echo ' selected="selected"'; } ?>>Open on load</option>
                            <option value="closed"<?php if (get_pix_option('pix_sliding_page') == 'closed') { echo ' selected="selected"'; } ?>>Closed on load</option>
                            <option value="always"<?php if (get_pix_option('pix_sliding_page') == 'always') { echo ' selected="selected"'; } ?>>Always open</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_general_sidebar">Show/hide sidebar and its position</label>
                        <select id="pix_general_sidebar" name="pix_general_sidebar" class="toggler">
                            <option value="rightsidebar"<?php if (get_pix_option('pix_general_sidebar') == 'rightsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the right</option>
                            <option value="leftsidebar"<?php if (get_pix_option('pix_general_sidebar') == 'leftsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the left</option>
                            <option value="nosidebar"<?php if (get_pix_option('pix_general_sidebar') == 'nosidebar') { echo ' selected="selected"'; } ?>>Hide sidebar</option>
                        </select>
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator toggle pix_general_sidebar" id="pix_general_sidebar" data-type="nosidebar">
                    	<label for="pix_general_template">
                        	Main column width and position
                        </label>
                        <select id="pix_general_template" name="pix_general_template">
                            <option value="left"<?php if (get_pix_option('pix_general_template') == 'left') { echo ' selected="selected"'; } ?>>Narrow left column</option>
                            <option value="right"<?php if (get_pix_option('pix_general_template') == 'right') { echo ' selected="selected"'; } ?>>Narrow right column</option>
                            <option value="wide"<?php if (get_pix_option('pix_general_template') == 'wide') { echo ' selected="selected"'; } ?>>Wide column</option>
                        </select>
                    </div><!-- .block_separator -->
                </div><!-- #layout-tab-->

                <div id="header-tab">
                    <div class="block_separator">
                        <label for="pix_header_position">Header position</label>
                        <select id="pix_header_position" name="pix_header_position">
                            <option value="fixed"<?php if (get_pix_option('pix_header_position') == 'fixed') { echo ' selected="selected"'; } ?>>Fixed</option>
                            <option value="scrollable"<?php if (get_pix_option('pix_header_position') == 'scrollable') { echo ' selected="selected"'; } ?>>Scrollable</option>
                        </select>
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                        <label for="pix_site_title">Site title</label>
                         <input name="pix_site_title" id="pix_site_title" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_site_title' )); ?>" />
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                        <label for="pix_site_description">Site description</label>
                        <input name="pix_site_description" id="pix_site_description" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_site_description' )); ?>" />
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                        <label for="pix_social_bar">Social and search bar<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/socialbar.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small></label>
                        <select id="pix_social_bar" name="pix_social_bar">
                            <option value="closed"<?php if (get_pix_option('pix_social_bar') == 'closed') { echo ' selected="selected"'; } ?>>Closed</option>
                            <option value="open"<?php if (get_pix_option('pix_social_bar') == 'open') { echo ' selected="selected"'; } ?>>Open</option>
                            <option value="hidden"<?php if (get_pix_option('pix_social_bar') == 'hidden') { echo ' selected="selected"'; } ?>>Hidden</option>
                        </select>
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Search form</label>
                        <label for="pix_seach_show" class="innerlabel">Show search form</label>
                        <input type="hidden" value="0" name="pix_seach_show">
                        <input type="checkbox" value="show" name="pix_seach_show"<?php if(get_pix_option('pix_seach_show')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Twitter link</label>
                        <label for="pix_twitter_icon" class="innerlabel">Show Twitter icon</label>
                        <input type="hidden" value="0" name="pix_twitter_icon">
                        <input type="checkbox" value="show" name="pix_twitter_icon"<?php if(get_pix_option('pix_twitter_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_twitter_url" class="innerlabel">Twitter URL</label><input name="pix_twitter_url" id="pix_twitter_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_twitter_url' )); ?>" style="width:50%" />
                        <label for="pix_twitter_text" class="innerlabel">Twitter title</label><input name="pix_twitter_text" id="pix_twitter_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_twitter_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Google+ link</label>
                        <label for="pix_google_icon" class="innerlabel">Show Google+ icon</label>
                        <input type="hidden" value="0" name="pix_google_icon">
                        <input type="checkbox" value="show" name="pix_google_icon"<?php if(get_pix_option('pix_google_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_google_url" class="innerlabel">Google+ profile URL</label><input name="pix_google_url" id="pix_google_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_google_url' )); ?>" style="width:50%" />
                        <label for="pix_google_text" class="innerlabel">Google+ title</label><input name="pix_google_text" id="pix_google_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_google_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Facebook link</label>
                        <label for="pix_facebook_icon" class="innerlabel">Show Facebook icon</label>
                        <input type="hidden" value="0" name="pix_facebook_icon">
                        <input type="checkbox" value="show" name="pix_facebook_icon"<?php if(get_pix_option('pix_facebook_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_facebook_url" class="innerlabel">Facebook URL</label><input name="pix_facebook_url" id="pix_facebook_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_facebook_url' )); ?>" style="width:50%" />
                        <label for="pix_facebook_text" class="innerlabel">Facebook title</label><input name="pix_facebook_text" id="pix_facebook_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_facebook_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Tumblr link</label>
                        <label for="pix_tumblr_icon" class="innerlabel">Show Tumblr icon</label>
                        <input type="hidden" value="0" name="pix_tumblr_icon">
                        <input type="checkbox" value="show" name="pix_tumblr_icon"<?php if(get_pix_option('pix_tumblr_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_tumblr_url" class="innerlabel">Tumblr URL</label><input name="pix_tumblr_url" id="pix_tumblr_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_tumblr_url' )); ?>" style="width:50%" />
                        <label for="pix_tumblr_text" class="innerlabel">Tumblr title</label><input name="pix_tumblr_text" id="pix_tumblr_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_tumblr_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>LinkedIn link</label>
                        <label for="pix_linkedin_icon" class="innerlabel">Show LinkedIn icon</label>
                        <input type="hidden" value="0" name="pix_linkedin_icon">
                        <input type="checkbox" value="show" name="pix_linkedin_icon"<?php if(get_pix_option('pix_linkedin_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_linkedin_url" class="innerlabel">LinkedIn URL</label><input name="pix_linkedin_url" id="pix_linkedin_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_linkedin_url' )); ?>" style="width:50%" />
                        <label for="pix_linkedin_text" class="innerlabel">LinkedIn title</label><input name="pix_linkedin_text" id="pix_linkedin_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_linkedin_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Flickr link</label>
                        <label for="pix_flickr_icon" class="innerlabel">Show Flickr icon</label>
                        <input type="hidden" value="0" name="pix_flickr_icon">
                        <input type="checkbox" value="show" name="pix_flickr_icon"<?php if(get_pix_option('pix_flickr_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_flickr_url" class="innerlabel">Flickr URL</label><input name="pix_flickr_url" id="pix_flickr_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_flickr_url' )); ?>" style="width:50%" />
                        <label for="pix_flickr_text" class="innerlabel">Flickr title</label><input name="pix_flickr_text" id="pix_flickr_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_flickr_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>MySpace link</label>
                        <label for="pix_myspace_icon" class="innerlabel">Show MySpace icon</label>
                        <input type="hidden" value="0" name="pix_myspace_icon">
                        <input type="checkbox" value="show" name="pix_myspace_icon"<?php if(get_pix_option('pix_myspace_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_myspace_url" class="innerlabel">MySpace URL</label><input name="pix_myspace_url" id="pix_myspace_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_myspace_url' )); ?>" style="width:50%" />
                        <label for="pix_myspace_text" class="innerlabel">MySpace title</label><input name="pix_myspace_text" id="pix_myspace_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_myspace_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>YouTube link</label>
                        <label for="pix_youtube_icon" class="innerlabel">Show YouTube icon</label>
                        <input type="hidden" value="0" name="pix_youtube_icon">
                        <input type="checkbox" value="show" name="pix_youtube_icon"<?php if(get_pix_option('pix_youtube_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_youtube_url" class="innerlabel">YouTube URL</label><input name="pix_youtube_url" id="pix_youtube_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_youtube_url' )); ?>" style="width:50%" />
                        <label for="pix_youtube_text" class="innerlabel">YouTube title</label><input name="pix_youtube_text" id="pix_youtube_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_youtube_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Vimeo link</label>
                        <label for="pix_vimeo_icon" class="innerlabel">Show Vimeo icon</label>
                        <input type="hidden" value="0" name="pix_vimeo_icon">
                        <input type="checkbox" value="show" name="pix_vimeo_icon"<?php if(get_pix_option('pix_vimeo_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_vimeo_url" class="innerlabel">Vimeo URL</label><input name="pix_vimeo_url" id="pix_vimeo_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_vimeo_url' )); ?>" style="width:50%" />
                        <label for="pix_vimeo_text" class="innerlabel">Vimeo title</label><input name="pix_vimeo_text" id="pix_vimeo_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_vimeo_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Behance link</label>
                        <label for="pix_behance_icon" class="innerlabel">Show Behance icon</label>
                        <input type="hidden" value="0" name="pix_behance_icon">
                        <input type="checkbox" value="show" name="pix_behance_icon"<?php if(get_pix_option('pix_behance_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_behance_url" class="innerlabel">Behance URL</label><input name="pix_behance_url" id="pix_behance_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_behance_url' )); ?>" style="width:50%" />
                        <label for="pix_behance_text" class="innerlabel">Behance title</label><input name="pix_behance_text" id="pix_behance_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_behance_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>500px link</label>
                        <label for="pix_500px_icon" class="innerlabel">Show 500px icon</label>
                        <input type="hidden" value="0" name="pix_500px_icon">
                        <input type="checkbox" value="show" name="pix_500px_icon"<?php if(get_pix_option('pix_500px_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_500px_url" class="innerlabel">500px URL</label><input name="pix_500px_url" id="pix_500px_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_500px_url' )); ?>" style="width:50%" />
                        <label for="pix_500px_text" class="innerlabel">500px title</label><input name="pix_500px_text" id="pix_500px_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_500px_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>SoundCloud link</label>
                        <label for="pix_soundcloud_icon" class="innerlabel">Show SoundCloud icon</label>
                        <input type="hidden" value="0" name="pix_soundcloud_icon">
                        <input type="checkbox" value="show" name="pix_soundcloud_icon"<?php if(get_pix_option('pix_soundcloud_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_soundcloud_url" class="innerlabel">SoundCloud URL</label><input name="pix_soundcloud_url" id="pix_soundcloud_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_soundcloud_url' )); ?>" style="width:50%" />
                        <label for="pix_soundcloud_text" class="innerlabel">SoundCloud title</label><input name="pix_soundcloud_text" id="pix_soundcloud_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_soundcloud_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Pinterest link</label>
                        <label for="pix_pinterest_icon" class="innerlabel">Show Pinterest icon</label>
                        <input type="hidden" value="0" name="pix_pinterest_icon">
                        <input type="checkbox" value="show" name="pix_pinterest_icon"<?php if(get_pix_option('pix_pinterest_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_pinterest_url" class="innerlabel">Pinterest URL</label><input name="pix_pinterest_url" id="pix_pinterest_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_pinterest_url' )); ?>" style="width:50%" />
                        <label for="pix_pinterest_text" class="innerlabel">Pinterest title</label><input name="pix_pinterest_text" id="pix_pinterest_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_pinterest_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Dribbble link</label>
                        <label for="pix_dribbble_icon" class="innerlabel">Show Dribbble icon</label>
                        <input type="hidden" value="0" name="pix_dribbble_icon">
                        <input type="checkbox" value="show" name="pix_dribbble_icon"<?php if(get_pix_option('pix_dribbble_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_dribbble_url" class="innerlabel">Dribbble URL</label><input name="pix_dribbble_url" id="pix_dribbble_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_dribbble_url' )); ?>" style="width:50%" />
                        <label for="pix_dribbble_text" class="innerlabel">Dribbble title</label><input name="pix_dribbble_text" id="pix_dribbble_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_dribbble_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Forrst link</label>
                        <label for="pix_forrst_icon" class="innerlabel">Show Forrst icon</label>
                        <input type="hidden" value="0" name="pix_forrst_icon">
                        <input type="checkbox" value="show" name="pix_forrst_icon"<?php if(get_pix_option('pix_forrst_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_forrst_url" class="innerlabel">Forrst URL</label><input name="pix_forrst_url" id="pix_forrst_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_forrst_url' )); ?>" style="width:50%" />
                        <label for="pix_forrst_text" class="innerlabel">Forrst title</label><input name="pix_forrst_text" id="pix_forrst_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_forrst_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>Skype link</label>
                        <label for="pix_skype_icon" class="innerlabel">Show Skype icon</label>
                        <input type="hidden" value="0" name="pix_skype_icon">
                        <input type="checkbox" value="show" name="pix_skype_icon"<?php if(get_pix_option('pix_skype_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_skype_id" class="innerlabel">Skype ID</label><input name="pix_skype_id" id="pix_skype_id" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_skype_id' )); ?>" style="width:50%" />
                        <div class="clear"></div>
                        <label for="pix_skype_action" class="innerlabel">Skype action</label>
                        <select name="pix_skype_action" id="pix_skype_action" style="width:50%">
                            <option value="call"<?php if (get_pix_option('pix_skype_action') == 'call') { echo ' selected="selected"'; } ?>>Call</option>
                            <option value="chat"<?php if (get_pix_option('pix_skype_action') == 'chat') { echo ' selected="selected"'; } ?>>Chat</option>
                        </select>
                        <label for="pix_skype_text" class="innerlabel">Skype title</label><input name="pix_skype_text" id="pix_skype_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_skype_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label>RSS link</label>
                        <label for="pix_rss_icon" class="innerlabel">Show RSS icon</label>
                        <input type="hidden" value="0" name="pix_rss_icon">
                        <input type="checkbox" value="show" name="pix_rss_icon"<?php if(get_pix_option('pix_rss_icon')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        <label for="pix_rss_url" class="innerlabel">RSS URL</label><input name="pix_rss_url" id="pix_rss_url" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_rss_url' )); ?>" style="width:50%" />
                        <label for="pix_rss_text" class="innerlabel">RSS title</label><input name="pix_rss_text" id="pix_rss_text" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_rss_text' )); ?>" style="width:50%" />
                    </div><!-- .block_separator -->
                </div><!-- #header-tab -->
                
                <div id="navigation-tab">
                    <div class="block_separator">
                        <label for="pix_nav_position">Navigation menu position</label>
                        <select id="pix_nav_position" name="pix_nav_position">
                            <option value="fixed"<?php if (get_pix_option('pix_nav_position') == 'fixed') { echo ' selected="selected"'; } ?>>Fixed</option>
                            <option value="scrollable"<?php if (get_pix_option('pix_nav_position') == 'scrollable') { echo ' selected="selected"'; } ?>>Scrollable</option>
                        </select>
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                        <label for="pix_breadcrumbs_show">Show / hide breadcrunbs</label>
                        <input type="hidden" value="0" name="pix_breadcrumbs_show">
                        <input type="checkbox" value="show" name="pix_breadcrumbs_show"<?php if(get_pix_option('pix_breadcrumbs_show')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->
                </div><!-- #navigation-tab -->
                
                <div id="footer-tab">
                    <div class="block_separator">
                        <label for="pix_footer_sitetitle">Site title on the footer<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/footertitle.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small></label>
                         <input name="pix_footer_sitetitle" id="pix_footer_sitetitle" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_footer_sitetitle' )); ?>" />
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label for="pix_footer_credits">Credits on the footer<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/footercredits.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small></label>
                         <textarea name="pix_footer_credits" id="pix_footer_credits"><?php echo stripslashes(get_pix_option( 'pix_footer_credits' )); ?></textarea>
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label for="pix_footer_show">Show footer</label>
                        <input type="hidden" value="0" name="pix_footer_show">
                        <input type="checkbox" value="show" name="pix_footer_show"<?php if(get_pix_option('pix_footer_show')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                        <label for="pix_photocredits_show">Show credits of photographs / videos<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/photocredits.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small></label>
                        <input type="hidden" value="0" name="pix_photocredits_show">
                        <input type="checkbox" value="show" name="pix_photocredits_show"<?php if(get_pix_option('pix_photocredits_show')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                        <label for="pix_photocommands_show">Show commands for slideshow / videos<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/commands.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small></label>
                        <input type="hidden" value="0" name="pix_photocommands_show">
                        <input type="checkbox" value="show" name="pix_photocommands_show"<?php if(get_pix_option('pix_photocommands_show')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                        <label for="pix_footerthumbnail_show">Show thumbnails for slideshow<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/slidethumb.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small></label>
                        <input type="hidden" value="0" name="pix_footerthumbnail_show">
                        <input type="checkbox" value="show" name="pix_footerthumbnail_show"<?php if(get_pix_option('pix_footerthumbnail_show')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->
                </div><!-- #footer-tab -->
                
                <div id="seo-tab">
                    <div class="block_separator">
                        <label for="pix_seo_enable">Enable native SEO plugin</label>
                        <input type="hidden" value="0" name="pix_seo_enable">                        
                        <input type="checkbox" value="true" name="pix_seo_enable"<?php if(get_pix_option('pix_seo_enable')=="true") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                </div><!-- #seo-tab -->
                
                <div id="media-tab">
                    <div class="block_separator">
                        <label for="pix_audio_external">Use 3rd party plugins for audio players</label>
                        <input type="hidden" value="0" name="pix_audio_external">                        
                        <input type="checkbox" value="true" name="pix_audio_external"<?php if(get_pix_option('pix_audio_external')=="true") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_video_external">Use 3rd party plugins for video players</label>
                        <input type="hidden" value="0" name="pix_video_external">                        
                        <input type="checkbox" value="true" name="pix_video_external"<?php if(get_pix_option('pix_video_external')=="true") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                </div><!-- #seo-tab -->
                
                <div id="scripts-tab">
                    <div class="block_separator">
                        <label for="pix_google_analytics">Google Analytics script <small>(or any other code you want to put into the footer)</small></label>
                        
                        <textarea name="pix_google_analytics" id="pix_google_analytics"><?php if ($current_user->display_name != 'pix_test' || $current_user->display_name != 'manu_test') {  echo stripslashes(get_pix_option( 'pix_google_analytics' )); } ?></textarea>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_css_inline">Put your custom CSS inline <small>if you switch it on, the options you saved in this admin panel will be written directly in the head of your pages. In this case the performance of your site could be a little slower, so I recommend to leave this button off if you don't have more important reasons to switch it on</small></label>
                        <input type="hidden" value="0" name="pix_css_inline">                        
                        <input type="checkbox" value="true" name="pix_css_inline"<?php if(get_pix_option('pix_css_inline')=="true") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_google_prevent">Block the download from Google's servers<small>If you switch on you can't use Google fonts: probably your connection will be faster but you need to use web safe fonts<br>N.B.: after saving refresh the page.</small></label>
                        <input type="hidden" value="0" name="pix_google_prevent">                        
                        <input type="checkbox" value="show" name="pix_google_prevent"<?php if(get_pix_option('pix_google_prevent')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_use_timthumb">Use TimThumb</small></label>
                        <input type="hidden" value="0" name="pix_use_timthumb">                        
                        <input type="checkbox" value="show" name="pix_use_timthumb"<?php if(get_pix_option('pix_use_timthumb')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_timthumb_cache">Use cache folder with TimThumb <small>If you switch this field off TimThumb will use the server temp directory. This is not always usable (based upon server configurations) so the cache directory may sometimes be required and you must switch this field on (even if the second method is less secure).</small></label>
                        <input type="hidden" value="0" name="pix_timthumb_cache">                        
                        <input type="checkbox" value="show" name="pix_timthumb_cache"<?php if(get_pix_option('pix_timthumb_cache')=="show") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->
                </div><!-- #scripts-tab -->
                
                <div id="slideshows-tab">
                	<div class="block_separator">
                    	<label for="pix_slideshow_speed">Decide the speed (between one slider on the next one) of all your background slideshows<small>But the script loads the images only when they are displayed. So, even it you decide to have 1 second between one slide and the next one, you must always wait the loading of the image itself.</small></label>
                        <div class="slider_div milliseconds">
                            <input type="text" id="pix_slideshow_speed" name="pix_slideshow_speed" class="slider_input milliseconds" value="<?php echo get_pix_option('pix_slideshow_speed'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->

                	<div class="block_separator">
                    	<label for="pix_slideshow_speed">Decide the duration of the transition effect</small></label>
                        <div class="slider_div milliseconds">
                            <input type="text" id="pix_slideshow_fade" name="pix_slideshow_fade" class="slider_input milliseconds" value="<?php echo get_pix_option('pix_slideshow_fade'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->

                	<div class="block_separator">
                    	<label for="pix_slideshow_adapt">Fit portraits:
                        </label>
                        <input type="hidden" value="0" name="pix_slideshow_adapt">                        
                        <input type="checkbox" value="true" name="pix_slideshow_adapt"<?php if(get_pix_option('pix_slideshow_adapt')=="true") { ?> checked="checked"<?php } ?>>
                        <small>Show the vertical images without cropping them</small>
    
                    </div><!-- .block_separator -->
                </div><!-- #slideshows-tab -->
                
                <input name="save" type="submit" value="&nbsp;" class="input-save" />
                <input type="hidden" name="action" value="save" />
            </form>
            </div><!-- #general-tab -->
            
             <div id="typo-tab">
                <ul>
                    <li><a href="#general-typo-tab">General</a></li>
                    <li><a href="#header-typo-tab">Header</a></li>
                    <li><a href="#navigation-typo-tab">Navigation</a></li>
                    <li><a href="#footer-typo-tab">Footer</a></li>
                </ul>
                <form method="post">
             	<div id="general-typo-tab">
                    <div class="block_separator">
                    	<?php listFont('pix_typo_general', 'pix_typo_general_own', 'General font', 'Type your font from the Google font list', 'General font') ; ?>

                        <div class="slider_div">
                            <label for="pix_typo_general_fontsize" style="clear:left" class="slider_input">Font size:</label>
                            <input type="text" id="pix_typo_general_fontsize" name="pix_typo_general_fontsize" class="slider_input" value="<?php echo get_pix_option('pix_typo_general_fontsize'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<?php listFont('pix_typo_buttons', 'pix_typo_buttons_own', 'Font of the buttons', 'Type your font from the Google font list', 'Button') ; ?>

                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<?php listFont('pix_typo_h1', 'pix_typo_h1_own', 'Heading 1 font', 'Type your font from the Google font list', 'Heading 1') ; ?>

                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<?php listFont('pix_typo_h2', 'pix_typo_h2_own', 'Heading 2 font', 'Type your font from the Google font list', 'Heading 2') ; ?>

                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<?php listFont('pix_typo_h3', 'pix_typo_h3_own', 'Heading 3 font', 'Type your font from the Google font list', 'Heading 3') ; ?>

                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<?php listFont('pix_typo_h4', 'pix_typo_h4_own', 'Heading 4 font', 'Type your font from the Google font list', 'Heading 4') ; ?>

                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<?php listFont('pix_typo_h5', 'pix_typo_h5_own', 'Heading 5 font', 'Type your font from the Google font list', 'Heading 5') ; ?>

                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<?php listFont('pix_typo_h6', 'pix_typo_h6_own', 'Heading 6 font', 'Type your font from the Google font list', 'Heading 6') ; ?>

                    </div><!-- .block_separator -->
                </div><!-- #general-typo-tab -->
                
             	<div id="header-typo-tab">
                    <div class="block_separator">
                    	<?php listFont('pix_typo_sitetitle', 'pix_typo_sitetitle_own', 'Site title', 'Type your font from the Google font list', 'Site title') ; ?>

                        <div class="slider_div">
                            <label for="pix_typo_sitetitle_fontsize" style="clear:left" class="slider_input">Font size:</label>
                            <input type="text" id="pix_typo_sitetitle_fontsize" name="pix_typo_sitetitle_fontsize" class="slider_input" value="<?php echo get_pix_option('pix_typo_sitetitle_fontsize'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<?php listFont('pix_typo_sitedescription', 'pix_typo_sitedescription_own', 'Site description', 'Type your font from the Google font list', 'Site description') ; ?>
    
                        <div class="slider_div">
                            <label for="pix_typo_sitedescription_fontsize" style="clear:left" class="slider_input">Font size:</label>
                            <input type="text" id="pix_typo_sitedescription_fontsize" name="pix_typo_sitedescription_fontsize" class="slider_input" value="<?php echo get_pix_option('pix_typo_sitedescription_fontsize'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->
                </div><!-- #header-typo-tab -->
                
             	<div id="navigation-typo-tab">
                    <div class="block_separator">
                        <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/firstlevellink.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small>
                    	<?php listFont('pix_typo_firstlevellink', 'pix_typo_firstlevellink_own', 'First level link', 'Type your font from the Google font list', 'First level link') ; ?>

                        <div class="slider_div">
                            <label for="pix_typo_firstlevellink_fontsize" style="clear:left" class="slider_input">Font size:</label>
                            <input type="text" id="pix_typo_firstlevellink_fontsize" name="pix_typo_firstlevellink_fontsize" class="slider_input" value="<?php echo get_pix_option('pix_typo_firstlevellink_fontsize'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/secondlevellink.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small>
                    	<?php listFont('pix_typo_secondlevellink', 'pix_typo_secondlevellink_own', 'Second level link', 'Type your font from the Google font list', 'Second level link') ; ?>

                        <div class="slider_div">
                            <label for="pix_typo_secondlevellink_fontsize" style="clear:left" class="slider_input">Font size:</label>
                            <input type="text" id="pix_typo_secondlevellink_fontsize" name="pix_typo_secondlevellink_fontsize" class="slider_input" value="<?php echo get_pix_option('pix_typo_secondlevellink_fontsize'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/thirdlevellink.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small>
                    	<?php listFont('pix_typo_thirdlevellink', 'pix_typo_thirdlevellink_own', 'Third level link', 'Type your font from the Google font list', 'Third level link') ; ?>

                        <div class="slider_div">
                            <label for="pix_typo_thirdlevellink_fontsize" style="clear:left" class="slider_input">Font size:</label>
                            <input type="text" id="pix_typo_thirdlevellink_fontsize" name="pix_typo_thirdlevellink_fontsize" class="slider_input" value="<?php echo get_pix_option('pix_typo_thirdlevellink_fontsize'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->

                </div><!-- #navigation-typo-tab -->

             	<div id="footer-typo-tab">
                    <div class="block_separator">
                    <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/footertitle.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small>
                    	<?php listFont('pix_typo_logobottom', 'pix_typo_logobottom_own', 'Font of the bottom site title', 'Type your font from the Google font list', 'Site title') ; ?>

                        <div class="slider_div">
                            <label for="pix_typo_logobottom_fontsize" style="clear:left" class="slider_input">Font size:</label>
                            <input type="text" id="pix_typo_logobottom_fontsize" name="pix_typo_logobottom_fontsize" class="slider_input" value="<?php echo get_pix_option('pix_typo_logobottom_fontsize'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
    
                    </div><!-- .block_separator -->

                </div><!-- #footer-typo-tab -->
                
    
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>
            </div><!-- #typo-tab -->
                
           <div id="colors-tab">
                <ul>
                    <li><a href="#bodybg-tab">Site background</a></li>
                    <li><a href="#overlay_effect-tab">Overlay pattern</a></li>
                    <li><a href="#widebg-tab">Wide bg</a></li>
                    <li><a href="#general-colors-tab">General</a></li>
                    <li><a href="#header-colors-tab">Header</a></li>
                    <li><a href="#navigation-colors-tab">Navigation</a></li>
                    <li><a href="#2navigation-colors-tab">2nd navigation</a></li>
                    <li><a href="#footer-colors-tab">Footer</a></li>
                    <li><a href="#typography-color-tab">Typography</a></li>
                    <li><a href="#divs-buttons-tab">Divs, buttons etc</a></li>
                    <li><a href="#colorbox-tab">ColorBox &amp; tooltips</a></li>
                </ul>
                <form method="post">
                <div id="bodybg-tab">
                    <div class="block_separator pix_color">
                        <label for="pix_body_background_color">General background color</label>
                         <input name="pix_body_background_color" id="pix_body_background_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_body_background_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_body_background">Select your body background</label>
                        <select id="pix_body_background" name="pix_body_background" class="toggler">
                            <option value="pattern"<?php if (get_pix_option('pix_body_background') == 'pattern') { echo ' selected="selected"'; } ?>>Pattern</option>
                            <option value="single_image"<?php if (get_pix_option('pix_body_background') == 'single_image') { echo ' selected="selected"'; } ?>>Single image</option>
                            <option value="none"<?php if (get_pix_option('pix_body_background') == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_body_background" id="pix_body_background" data-type="pattern">
                    	<label for="pix_body_background_pattern">
                        	Select a pattern
                        </label>
                        <div class="radio_labels">
                            <label>Arabesque
                            	<input name="pix_body_background_pattern" type="radio" value="arabesque" <?php if(get_pix_option('pix_body_background_pattern') == 'arabesque'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="arabesque"></span>
                            </label>
                            <label>Block
                                <input name="pix_body_background_pattern" type="radio" value="block" <?php if(get_pix_option('pix_body_background_pattern') == 'block'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="block"></span>
                            </label>
                            <label>Diagonal
                                <input name="pix_body_background_pattern" type="radio" value="diagonal" <?php if(get_pix_option('pix_body_background_pattern') == 'diagonal'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="diagonal"></span>
                            </label>
                            <label>Grid
                                <input name="pix_body_background_pattern" type="radio" value="grid" <?php if(get_pix_option('pix_body_background_pattern') == 'grid'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="grid"></span>
                            </label>
                            <label>Pipes
                                <input name="pix_body_background_pattern" type="radio" value="pipes" <?php if(get_pix_option('pix_body_background_pattern') == 'pipes'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="pipes"></span>
                            </label>
                            <label>Leaves
                                <input name="pix_body_background_pattern" type="radio" value="leaves" <?php if(get_pix_option('pix_body_background_pattern') == 'leaves'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="leaves"></span>
                            </label>
                            <label>Squares
                                <input name="pix_body_background_pattern" type="radio" value="squares" <?php if(get_pix_option('pix_body_background_pattern') == 'squares'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="squares"></span>
                            </label>
                            <label>Stripes
                                <input name="pix_body_background_pattern" type="radio" value="stripes" <?php if(get_pix_option('pix_body_background_pattern') == 'stripes'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="stripes"></span>
                            </label>
                            <label>Zig zag
                                <input name="pix_body_background_pattern" type="radio" value="zig" <?php if(get_pix_option('pix_body_background_pattern') == 'zig'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="zigzag"></span>
                            </label>
                       </div><!-- .radio_labels -->
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_body_background" id="pix_body_background" data-type="single_image">
                    	<label for="pix_body_background_single_image">
                        	Upload your image
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        </label>
                        <div id="pix_body_background_single_image" class="rm_upload_image">
							<?php if(get_pix_option('pix_body_background_single_image')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                            <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_body_background_single_image'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                            <input name="pix_body_background_single_image" type="text" value="<?php echo get_pix_option('pix_body_background_single_image'); ?>">
                            <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                        </div><!-- .rm_upload_image -->
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_body_background" id="pix_body_background" data-type="single_image">
                    	<label for="pix_body_background_single_image_position">
                        	Image position
                        </label>
                        <select id="pix_body_background_single_image_position" name="pix_body_background_single_image_position" class="toggler">
                            <option value="center top"<?php if (get_pix_option('pix_body_background_single_image_position') == 'center top') { echo ' selected="selected"'; } ?>>Center top</option>
                            <option value="center"<?php if (get_pix_option('pix_body_background_single_image_position') == 'center') { echo ' selected="selected"'; } ?>>Center</option>
                            <option value="center bottom"<?php if (get_pix_option('pix_body_background_single_image_position') == 'center bottom') { echo ' selected="selected"'; } ?>>Center bottom</option>
                            <option value="left top"<?php if (get_pix_option('pix_body_background_single_image_position') == 'left top') { echo ' selected="selected"'; } ?>>Left top</option>
                            <option value="right top"<?php if (get_pix_option('pix_body_background_single_image_position') == 'right top') { echo ' selected="selected"'; } ?>>Right top</option>
                            <option value="left center"<?php if (get_pix_option('pix_body_background_single_image_position') == 'left center') { echo ' selected="selected"'; } ?>>Left center</option>
                            <option value="right center"<?php if (get_pix_option('pix_body_background_single_image_position') == 'right center') { echo ' selected="selected"'; } ?>>Right center</option>
                            <option value="left bottom"<?php if (get_pix_option('pix_body_background_single_image_position') == 'left bottom') { echo ' selected="selected"'; } ?>>Left bottom</option>
                            <option value="right bottom"<?php if (get_pix_option('pix_body_background_single_image_position') == 'right bottom') { echo ' selected="selected"'; } ?>>Right bottom</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_body_background" id="pix_body_background" data-type="single_image">
                    	<label for="pix_body_background_single_image_repeat">
                        	Image repeat
                        </label>
                        <select id="pix_body_background_single_image_repeat" name="pix_body_background_single_image_repeat" class="toggler">
                            <option value="repeat"<?php if (get_pix_option('pix_body_background_single_image_repeat') == 'repeat') { echo ' selected="selected"'; } ?>>Repeat</option>
                            <option value="repeat-x"<?php if (get_pix_option('pix_body_background_single_image_repeat') == 'repeat-x') { echo ' selected="selected"'; } ?>>Horizontal repeat</option>
                            <option value="repeat-y"<?php if (get_pix_option('pix_body_background_single_image_repeat') == 'repeat-y') { echo ' selected="selected"'; } ?>>Vertical repeat</option>
                            <option value="no-repeat"<?php if (get_pix_option('pix_body_background_single_image_repeat') == 'no-repeat') { echo ' selected="selected"'; } ?>>No repeat</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_body_background" id="pix_body_background" data-type="single_image">
                    	<label for="pix_body_background_single_image_attachment">
                        	Image attachment
                        </label>
                        <select id="pix_body_background_single_image_attachment" name="pix_body_background_single_image_attachment" class="toggler">
                            <option value="scroll"<?php if (get_pix_option('pix_body_background_single_image_attachment') == 'scroll') { echo ' selected="selected"'; } ?>>Scroll</option>
                            <option value="fixed"<?php if (get_pix_option('pix_body_background_single_image_attachment') == 'fixed') { echo ' selected="selected"'; } ?>>Fixed</option>
                        </select>

                    </div><!-- .block_separator -->
                </div><!-- #imagebg-tab2 -->
    
                <div id="overlay_effect-tab">
                    <div class="block_separator">
                    	<label for="pix_overlay_pattern">
                        	Select an overlay pattern
                        </label>
                        <div class="radio_labels">
                            <label>None
                            	<input name="pix_overlay_pattern" type="radio" value="none" <?php if(get_pix_option('pix_overlay_pattern') == 'none'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="none"></span>
                            </label>
                            <label>1
                                <input name="pix_overlay_pattern" type="radio" value="1" <?php if(get_pix_option('pix_overlay_pattern') == '1'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="one"></span>
                            </label>
                            <label>2
                                <input name="pix_overlay_pattern" type="radio" value="2" <?php if(get_pix_option('pix_overlay_pattern') == '2'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="two"></span>
                            </label>
                            <label>3
                                <input name="pix_overlay_pattern" type="radio" value="3" <?php if(get_pix_option('pix_overlay_pattern') == '3'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="three"></span>
                            </label>
                            <label>4
                                <input name="pix_overlay_pattern" type="radio" value="4" <?php if(get_pix_option('pix_overlay_pattern') == '4'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="four"></span>
                            </label>
                            <label>5
                                <input name="pix_overlay_pattern" type="radio" value="5" <?php if(get_pix_option('pix_overlay_pattern') == '5'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="five"></span>
                            </label>
                            <label>6
                                <input name="pix_overlay_pattern" type="radio" value="6" <?php if(get_pix_option('pix_overlay_pattern') == '6'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="six"></span>
                            </label>
                            <label>7
                                <input name="pix_overlay_pattern" type="radio" value="7" <?php if(get_pix_option('pix_overlay_pattern') == '7'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="seven"></span>
                            </label>
                            <label>8
                                <input name="pix_overlay_pattern" type="radio" value="8" <?php if(get_pix_option('pix_overlay_pattern') == '8'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="eight"></span>
                            </label>
                            <label>9
                                <input name="pix_overlay_pattern" type="radio" value="9" <?php if(get_pix_option('pix_overlay_pattern') == '9'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="nine"></span>
                            </label>
                            <label>10
                                <input name="pix_overlay_pattern" type="radio" value="10" <?php if(get_pix_option('pix_overlay_pattern') == '10'){ echo "checked=\"checked\""; } ?>>
                                <span class="preview_pattern" id="ten"></span>
                            </label>
                       </div><!-- .radio_labels -->
                    </div><!-- .block_separator -->

                    <div class="block_separator slider_div opacity">
                        <label for="pix_overlay_pattern_opacity">Overlay pattern opacity</label>
                        <input type="text" id="pix_overlay_pattern_opacity" name="pix_overlay_pattern_opacity" class="slider_input" value="<?php echo get_pix_option('pix_overlay_pattern_opacity'); ?>" />
                        <div class="slider_cursor"></div>
                    </div><!-- .block_separator -->

                </div><!-- #overlay_effect-tab -->
                
                <div id="widebg-tab">
                    <div class="block_separator">
                        <label for="pix_general_background">Select your general wide background</label>
                        <select id="pix_general_background" name="pix_general_background" class="toggler">
                            <option value="single_wide"<?php if (get_pix_option('pix_general_background') == 'single_wide') { echo ' selected="selected"'; } ?>>Single wide image</option>
                            <option value="slideshow"<?php if (get_pix_option('pix_general_background') == 'slideshow') { echo ' selected="selected"'; } ?>>Slideshow</option>
                            <option value="video"<?php if (get_pix_option('pix_general_background') == 'video') { echo ' selected="selected"'; } ?>>Video</option>
                            <option value="googlemap"<?php if (get_pix_option('pix_general_background') == 'googlemap') { echo ' selected="selected"'; } ?>>Google map</option>
                            <option value="none"<?php if (get_pix_option('pix_general_background') == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_general_background" id="pix_general_background" data-type="slideshow">
                    	<label>
                        	Add fields, upload images, remove them, drag and drop!
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        </label>
                        <div class="sorting_admin">
                        <a href="#" class="add" id="add_a_slider">&nbsp;</a>
                        <?php 

							$i = 0;
							$pix_array_slide_general = get_pix_option('pix_array_slide_general_');
							while($i<count($pix_array_slide_general)){
								if($pix_array_slide_general[$i]=='') { $style=' style="display:none"'; } else { $style=''; }
								echo '<div id="pix_array_slide_general_'.$i.'" class="rm_upload_image">
								<div class="handle"></div>
								<div class="image_thumb"><img src="'.get_pix_thumb($pix_array_slide_general[$i], 'exTh').'" alt="Preview"'. $style .' /></div>
								<input name="pix_array_slide_general_['.$i.']" type="text" value="'.$pix_array_slide_general[$i].'">
								<a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                                <a href="#" class="button-secondary remove">Remove</a></div>';
								$i++;
							} 
						?>
                        </div><!-- .sorting -->
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_general_background" id="pix_general_background" data-type="single_wide">
                    	<label for="pix_wide_image_general">
                        	Upload your image
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        </label>
                        
                        <div id="pix_wide_image_general" class="rm_upload_image">
							<?php if(get_pix_option('pix_wide_image_general')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                            <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_wide_image_general'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                            <input name="pix_wide_image_general" type="text" value="<?php echo get_pix_option('pix_wide_image_general'); ?>">
                            <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                        </div><!-- .rm_upload_image -->
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_general_background" id="pix_general_background" data-type="video">
                    	<label for="pix_wide_video_general">
                        	Upload your video
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadvideo.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        </label>
                        
                        <div id="pix_wide_image_general" class="rm_upload_video">
                            <input name="pix_wide_video_general" type="text" value="<?php echo get_pix_option('pix_wide_video_general'); ?>"><br>
                            <a class="button-secondary pix_upload_video_button" href="#">Upload Video</a>
                        </div><!-- .rm_upload_image -->
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_general_background" id="pix_general_background" data-type="video">
                        <label for="pix_wide_video_general_start">
                            Auto start for your video
                        </label>
                        <input type="hidden" value="0" name="pix_wide_video_general_start">                        
                        <input type="checkbox" value="true" name="pix_wide_video_general_start"<?php if(get_pix_option('pix_wide_video_general_start')=="true") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_general_background" id="pix_general_background" data-type="video">                        
                        <label for="pix_wide_video_general_loop">
                            Loop for your video
                        </label>
                        <input type="hidden" value="0" name="pix_wide_video_general_loop">                        
                        <input type="checkbox" value="true" name="pix_wide_video_general_loop"<?php if(get_pix_option('pix_wide_video_general_loop')=="true") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                           
                    <div class="block_separator toggle pix_general_background" id="pix_general_background" data-type="googlemap">
                    	<label for="pix_wide_googlemap_general">
                        	Coordinates <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" class="pix_tips_ajax topLeft" data-width="520" data-height="467">how can I get them?</a>)</small>
                        </label>
                        
                        <input name="pix_wide_googlemap_general" type="text" value="<?php echo get_pix_option('pix_wide_googlemap_general'); ?>"><br>

                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_general_background slider_div googlemap" id="pix_general_background" data-type="googlemap">
                        <label for="pix_wide_googlemap_general_zoom">Zoom</label>
                        <input type="text" id="pix_wide_googlemap_general_zoom" name="pix_wide_googlemap_general_zoom" class="slider_input" value="<?php echo get_pix_option('pix_wide_googlemap_general_zoom'); ?>" />
                        <div class="slider_cursor"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_general_background" id="pix_general_background" data-type="googlemap">
                        <label for="pix_wide_googlemap_indications">Indications</label>
                        <textarea name="pix_wide_googlemap_indications" id="pix_wide_googlemap_indications"><?php echo stripslashes(get_pix_option( 'pix_wide_googlemap_indications' )); ?></textarea>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_general_background" id="pix_general_background" data-type="googlemap">
                        <label for="pix_wide_googlemap_type">Type</label>
                        <select id="pix_wide_googlemap_type" name="pix_wide_googlemap_type">
                            <option value="HYBRID"<?php if (get_pix_option('pix_wide_googlemap_type') == 'HYBRID') { echo ' selected="selected"'; } ?>>hybrid</option>
                            <option value="SATELLITE"<?php if (get_pix_option('pix_wide_googlemap_type') == 'SATELLITE') { echo ' selected="selected"'; } ?>>satellite</option>
                            <option value="ROADMAP"<?php if (get_pix_option('pix_wide_googlemap_type') == 'ROADMAP') { echo ' selected="selected"'; } ?>>road map</option>
                            <option value="TERRAIN"<?php if (get_pix_option('pix_wide_googlemap_type') == 'TERRAIN') { echo ' selected="selected"'; } ?>>terrain</option>
                        </select>
                    </div><!-- .block_separator -->

                </div><!-- #widebg-tab -->
    
                <div id="general-colors-tab">
                    <div class="block_separator">
                        <label for="pix_favicon_ico">Upload your favicon (.ico file)</label>
                        <div id="pix_favicon_ico_div" class="rm_upload_image">
							<?php if(get_pix_option('pix_favicon_ico')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                            <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_favicon_ico'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                            <input name="pix_favicon_ico" type="text" value="<?php echo get_pix_option('pix_favicon_ico'); ?>">
                            <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                        </div><!-- .rm_upload_image -->
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_content_background">Content area background color<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/contentbg.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small></label>
                         <input name="pix_content_background" id="pix_content_background" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_content_background' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator slider_div opacity">
                        <label for="pix_content_bg_opacity">Content area background opacity</label>
                        <input type="text" id="pix_content_bg_opacity" name="pix_content_bg_opacity" class="slider_input" value="<?php echo get_pix_option('pix_content_bg_opacity'); ?>" />
                        <div class="slider_cursor"></div>
                    </div><!-- .block_separator -->

                   <div class="block_separator pix_color">
                        <label for="pix_content_text_color">Content area text color</label>
                         <input name="pix_content_text_color" id="pix_content_text_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_content_text_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator pix_color">
                        <label for="pix_link_color">Simple link color</label>
                         <input name="pix_link_color" id="pix_link_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_link_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                </div><!-- #general-colors-tab -->


                <div id="header-colors-tab">
                    <div class="block_separator pix_color">
                        <label for="pix_header_background">Header background color</label>
                         <input name="pix_header_background" id="pix_header_background" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_header_background' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator slider_div opacity">
                        <label for="pix_header_bg_opacity">Header background opacity</label>
                        <input type="text" id="pix_header_bg_opacity" name="pix_header_bg_opacity" class="slider_input" value="<?php echo get_pix_option('pix_header_bg_opacity'); ?>" />
                        <div class="slider_cursor"></div>
                    </div><!-- .block_separator -->

                   <div class="block_separator pix_color">
                        <label for="pix_header_text_color">Header text color</label>
                         <input name="pix_header_text_color" id="pix_header_text_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_header_text_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label for="pix_header_image_bg">Header background image</label>
                        <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        <div id="pix_header_image_bg" class="rm_upload_image">
							<?php if(get_pix_option('pix_header_image_bg')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                            <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_header_image_bg'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                            <input name="pix_header_image_bg" type="text" value="<?php echo get_pix_option('pix_header_image_bg'); ?>">
                            <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                        </div><!-- .rm_upload_image -->
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label for="pix_header_image_position">Header background image position</label>
                         <input name="pix_header_image_position" id="pix_header_image_position" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_header_image_position' )); ?>" />
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_header_image_repeat">Header background image repeat</label>
                        <select id="pix_header_image_repeat" name="pix_header_image_repeat">
                            <option value="no-repeat"<?php if (get_pix_option('pix_header_image_repeat') == 'no-repeat') { echo ' selected="selected"'; } ?>>No repeat</option>
                            <option value="repeat"<?php if (get_pix_option('pix_header_image_repeat') == 'repeat') { echo ' selected="selected"'; } ?>>Repeat</option>
                            <option value="repeat-x"<?php if (get_pix_option('pix_header_image_repeat') == 'repeat-x') { echo ' selected="selected"'; } ?>>Repeat horizontally</option>
                            <option value="repeat-y"<?php if (get_pix_option('pix_header_image_repeat') == 'repeat-y') { echo ' selected="selected"'; } ?>>Repeat vertically</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_header_padding">Header padding</label>
                         <input name="pix_header_padding" id="pix_header_padding" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_header_padding' )); ?>" />
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_header_margin">Header margin</label>
                         <input name="pix_header_margin" id="pix_header_margin" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_header_margin' )); ?>" />
                    </div><!-- .block_separator -->

                </div><!-- #header-colors-tab -->
                
                <div id="navigation-colors-tab">
                	<div class="block_separator">
                    	<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/firstnavigation.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small>
                        <div class="pix_color clear">
                            <label for="pix_first_level_background">First level menu background color</label>
                             <input name="pix_first_level_background" id="pix_first_level_background" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_first_level_background' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                        <div class="slider_div opacity clear">
                            <label for="pix_first_level_opacity">First level menu background opacity</label>
                            <input type="text" id="pix_first_level_opacity" name="pix_first_level_opacity" class="slider_input" value="<?php echo get_pix_option('pix_first_level_opacity'); ?>" />
                            <div class="slider_cursor"></div>
                            <div class="clear"></div>
                            <small><strong>Pay attention!</strong> If you have sub-menus set opacity to 1</small>
                        </div><!-- .slider_div -->
    
                       <div class="pix_color clear">
                            <label for="pix_first_level_color">First level menu text color</label>
                             <input name="pix_first_level_color" id="pix_first_level_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_first_level_color' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_first_level_hover">First level menu text color on mouse hover</label>
                             <input name="pix_first_level_hover" id="pix_first_level_hover" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_first_level_hover' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_first_level_border">First level menu border on mouse hover</label>
                             <input name="pix_first_level_border" id="pix_first_level_border" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_first_level_border' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
                    </div><!-- .block_separator -->
                    
                	<div class="block_separator">
                        <div class="pix_color clear">
                            <label for="pix_second_level_background">Second level menu background color</label>
                             <input name="pix_second_level_background" id="pix_second_level_background" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_second_level_background' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_second_level_color">Second level menu text color</label>
                             <input name="pix_second_level_color" id="pix_second_level_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_second_level_color' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_second_level_hover">Second level menu text color on mouse hover</label>
                             <input name="pix_second_level_hover" id="pix_second_level_hover" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_second_level_hover' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                    </div><!-- .block_separator -->
                    
                	<div class="block_separator">
                        <div class="pix_color clear">
                            <label for="pix_third_level_background">Third level menu background color</label>
                             <input name="pix_third_level_background" id="pix_third_level_background" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_third_level_background' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_third_level_color">Third level menu text color</label>
                             <input name="pix_third_level_color" id="pix_third_level_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_third_level_color' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_third_level_hover">Third level menu text color on mouse hover</label>
                             <input name="pix_third_level_hover" id="pix_third_level_hover" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_third_level_hover' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                    </div><!-- .block_separator -->
                    
                </div><!-- #navigation-colors-tab -->                
                
                <div id="2navigation-colors-tab">
                	<div class="block_separator">
                    	<small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/secondnavigation.php?TB_iframe=true&width=600&height=550" class="info thickbox">what's that?</a>)</small>
                        <div class="pix_color clear">
                            <label for="pix_first_level_background_2nd">First level secondary menu background color</label>
                             <input name="pix_first_level_background_2nd" id="pix_first_level_background_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_first_level_background_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                        <div class="slider_div opacity clear">
                            <label for="pix_first_level_opacity_2nd">First level secondary menu background opacity</label>
                            <input type="text" id="pix_first_level_opacity_2nd" name="pix_first_level_opacity_2nd" class="slider_input" value="<?php echo get_pix_option('pix_first_level_opacity_2nd'); ?>" />
                            <div class="slider_cursor"></div>
                            <div class="clear"></div>
                            <small><strong>Pay attention!</strong> If you have sub-menus set opacity to 1</small>
                        </div><!-- .slider_div -->
    
                       <div class="pix_color clear">
                            <label for="pix_first_level_color_2nd">First level secondary menu text color</label>
                             <input name="pix_first_level_color_2nd" id="pix_first_level_color_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_first_level_color_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_first_level_hover_2nd">First level secondary menu text color on mouse hover</label>
                             <input name="pix_first_level_hover_2nd" id="pix_first_level_hover_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_first_level_hover_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_first_level_border_2nd">First level secondary menu border on mouse hover</label>
                             <input name="pix_first_level_border_2nd" id="pix_first_level_border_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_first_level_border_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
                    </div><!-- .block_separator -->
                    
                	<div class="block_separator">
                        <div class="pix_color clear">
                            <label for="pix_second_level_background_2nd">Second level secondary menu background color</label>
                             <input name="pix_second_level_background_2nd" id="pix_second_level_background_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_second_level_background_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_second_level_color_2nd">Second level secondary menu text color</label>
                             <input name="pix_second_level_color_2nd" id="pix_second_level_color_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_second_level_color_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_second_level_hover_2nd">Second level secondary menu text color on mouse hover</label>
                             <input name="pix_second_level_hover_2nd" id="pix_second_level_hover_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_second_level_hover_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                    </div><!-- .block_separator -->
                    
                	<div class="block_separator">
                        <div class="pix_color clear">
                            <label for="pix_third_level_background_2nd">Third level secondary menu background color</label>
                             <input name="pix_third_level_background_2nd" id="pix_third_level_background_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_third_level_background_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_third_level_color_2nd">Third level secondary menu text color</label>
                             <input name="pix_third_level_color_2nd" id="pix_third_level_color_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_third_level_color_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                       <div class="pix_color clear">
                            <label for="pix_third_level_hover_2nd">Third level secondary menu text color on mouse hover</label>
                             <input name="pix_third_level_hover_2nd" id="pix_third_level_hover_2nd" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_third_level_hover_2nd' )); ?>" />
                            <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                           <div class="colorpicker"></div>
                        </div><!-- .pix_color -->
    
                    </div><!-- .block_separator -->
                    
                </div><!-- #2navigation-colors-tab --> 
                
                <div id="footer-colors-tab">
                    <div class="block_separator pix_color">
                        <label for="pix_footer_background">Footer background color</label>
                         <input name="pix_footer_background" id="pix_footer_background" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_footer_background' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                   <div class="block_separator pix_color">
                        <label for="pix_footer_text_color">Footer text color</label>
                         <input name="pix_footer_text_color" id="pix_footer_text_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_footer_text_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label for="pix_footer_image_bg">Footer logo</label>
                        <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        <div id="pix_footer_image_bg" class="rm_upload_image">
							<?php if(get_pix_option('pix_footer_image_bg')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                            <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_footer_image_bg'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                            <input name="pix_footer_image_bg" type="text" value="<?php echo get_pix_option('pix_footer_image_bg'); ?>">
                            <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                        </div><!-- .rm_upload_image -->
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator">
                        <label for="pix_footer_image_position">Footer logo position</label>
                         <input name="pix_footer_image_position" id="pix_footer_image_position" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_footer_image_position' )); ?>" />
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_footer_image_repeat">Footer logo repeat</label>
                        <select id="pix_footer_image_repeat" name="pix_footer_image_repeat">
                            <option value="no-repeat"<?php if (get_pix_option('pix_footer_image_repeat') == 'no-repeat') { echo ' selected="selected"'; } ?>>No repeat</option>
                            <option value="repeat"<?php if (get_pix_option('pix_footer_image_repeat') == 'repeat') { echo ' selected="selected"'; } ?>>Repeat</option>
                            <option value="repeat-x"<?php if (get_pix_option('pix_footer_image_repeat') == 'repeat-x') { echo ' selected="selected"'; } ?>>Repeat horizontally</option>
                            <option value="repeat-y"<?php if (get_pix_option('pix_footer_image_repeat') == 'repeat-y') { echo ' selected="selected"'; } ?>>Repeat vertically</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_footer_padding">Footer logo padding</label>
                         <input name="pix_footer_padding" id="pix_footer_padding" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_footer_padding' )); ?>" />
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_footer_margin">Footer logo margin</label>
                         <input name="pix_footer_margin" id="pix_footer_margin" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_footer_margin' )); ?>" />
                    </div><!-- .block_separator -->

                </div><!-- #footer-colors-tab -->
                
                <div id="typography-color-tab">
                    <div class="block_separator pix_color">
                        <label for="pix_h1_color">Heading 1 color</label>
                         <input name="pix_h1_color" id="pix_h1_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_h1_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_h2_color">Heading 2 color</label>
                         <input name="pix_h2_color" id="pix_h2_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_h2_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_h3_color">Heading 3 color</label>
                         <input name="pix_h3_color" id="pix_h3_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_h3_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_h4_color">Heading 4 color</label>
                         <input name="pix_h4_color" id="pix_h4_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_h4_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_h5_color">Heading 5 color</label>
                         <input name="pix_h5_color" id="pix_h5_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_h5_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_h6_color">Heading 6 color</label>
                         <input name="pix_h6_color" id="pix_h6_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_h6_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->


                </div><!-- #typography-color-tab -->
                
                <div id="divs-buttons-tab">
                    <div class="block_separator pix_color">
                        <label for="pix_buttons_bg">General button background</label>
                         <input name="pix_buttons_bg" id="pix_buttons_bg" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_buttons_bg' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_buttons_color">General button text color</label>
                         <input name="pix_buttons_color" id="pix_buttons_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_buttons_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_buttons_bghover">General button background (hover state)</label>
                         <input name="pix_buttons_bghover" id="pix_buttons_bghover" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_buttons_bghover' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_buttons_colorhover">General button text color (hover state)</label>
                         <input name="pix_buttons_colorhover" id="pix_buttons_colorhover" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_buttons_colorhover' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_general_box_bg">General box background color</label>
                         <input name="pix_general_box_bg" id="pix_general_box_bg" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_general_box_bg' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_general_box_bg_hover">General box background color (hover state)</label>
                         <input name="pix_general_box_bg_hover" id="pix_general_box_bg_hover" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_general_box_bg_hover' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_general_light_text_color">General light text color</label>
                         <input name="pix_general_light_text_color" id="pix_general_light_text_color" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_general_light_text_color' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator pix_color">
                        <label for="pix_general_light_text_color_hover">General light text color (hover state)</label>
                         <input name="pix_general_light_text_color_hover" id="pix_general_light_text_color_hover" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_general_light_text_color_hover' )); ?>" />
                        <img src="<?php echo get_template_directory_uri(); ?>/functions/images/color_picker_icon.gif" width="20" height="20" style="cursor:pointer; display:block; float:left; margin:6px 0 0 1px" class="a_palette" />
                       <div class="colorpicker"></div>
                    </div><!-- .block_separator -->
                    
                </div><!-- #divs-buttons-tab -->
                
                <div id="colorbox-tab">
                    <div class="block_separator">
                        <label for="pix_checkcolorbox">
                            Use the colorbox any time you link to an image
                        </label>
                        <input type="hidden" value="0" name="pix_checkcolorbox">                        
                        <input type="checkbox" value="show" name="pix_checkcolorbox"<?php if(get_pix_option('pix_checkcolorbox')=="show") { ?> checked="checked"<?php } ?>>
                        <small>If you select &quot;ON&quot; you can add the class &quot;noColorBox&quot; to the links where you do not want to apply the Colorbox.<br>
                        If you select &quot;OFF&quot; you can add the class &quot;colorbox&quot; to the links where you want to apply the Colorbox.</small>
                    </div><!-- .block_separator -->

                	<div class="block_separator">
                    	<label for="pix_colorbox_theme">
                        	Select the ColorBox skin
                        </label>
                        <select id="pix_colorbox_theme" name="pix_colorbox_theme">
                            <option value="whiteonblack"<?php if (get_pix_option('pix_colorbox_theme') == 'whiteonblack') { echo ' selected="selected"'; } ?>>White on black</option>
                            <option value="blackonwhite"<?php if (get_pix_option('pix_colorbox_theme') == 'blackonwhite') { echo ' selected="selected"'; } ?>>Black on white</option>
                            <option value="black"<?php if (get_pix_option('pix_colorbox_theme') == 'black') { echo ' selected="selected"'; } ?>>Black</option>
                            <option value="white"<?php if (get_pix_option('pix_colorbox_theme') == 'white') { echo ' selected="selected"'; } ?>>White</option>
                            <option value="gray"<?php if (get_pix_option('pix_colorbox_theme') == 'gray') { echo ' selected="selected"'; } ?>>Gray on black</option>
                        </select>
                    </div><!-- .block_separator -->

                	<div class="block_separator">
                    	<label for="pix_colorbox_theme">
                        	Select the Tooltip skin
                        </label>
                        <select id="pix_tooltip_theme" name="pix_tooltip_theme">
                            <option value="default"<?php if (get_pix_option('pix_tooltip_theme') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="light"<?php if (get_pix_option('pix_tooltip_theme') == 'light') { echo ' selected="selected"'; } ?>>Light</option>
                            <option value="dark"<?php if (get_pix_option('pix_tooltip_theme') == 'dark') { echo ' selected="selected"'; } ?>>Dark</option>
                            <option value="cream"<?php if (get_pix_option('pix_tooltip_theme') == 'cream') { echo ' selected="selected"'; } ?>>Cream</option>
                            <option value="red"<?php if (get_pix_option('pix_tooltip_theme') == 'red') { echo ' selected="selected"'; } ?>>Red</option>
                            <option value="green"<?php if (get_pix_option('pix_tooltip_theme') == 'green') { echo ' selected="selected"'; } ?>>Green</option>
                            <option value="blue"<?php if (get_pix_option('pix_tooltip_theme') == 'blue') { echo ' selected="selected"'; } ?>>Blue</option>
                            <option value="youtube"<?php if (get_pix_option('pix_tooltip_theme') == 'youtube') { echo ' selected="selected"'; } ?>>You Tube</option>
                            <option value="jtools"<?php if (get_pix_option('pix_tooltip_theme') == 'jtools') { echo ' selected="selected"'; } ?>>jQuery Tools</option>
                            <option value="cluetip"<?php if (get_pix_option('pix_tooltip_theme') == 'cluetip') { echo ' selected="selected"'; } ?>>Cluetip</option>
                            <option value="tipsy"<?php if (get_pix_option('pix_tooltip_theme') == 'tipsy') { echo ' selected="selected"'; } ?>>Tipsy</option>
                            <option value="tipped"<?php if (get_pix_option('pix_tooltip_theme') == 'tipped') { echo ' selected="selected"'; } ?>>Tipped</option>
                        </select>
                    </div><!-- .block_separator -->
               </div><!-- #colorbox-tab -->               
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>

            </div><!-- #colors-tab -->
                        
            <div id="frontpage-tab">
                <ul>
                    <li><a href="#background-front-tab">Background</a></li>
                    <li><a href="#layout-front-tab">Layout</a></li>
                    <li><a href="#content-front-tab">Content</a></li>
                    <li><a href="#seo-front-tab">SEO</a></li>
                    <li><a href="#sidebar-front-tab">Sidebar</a></li>
                </ul>
                <form method="post">
                <div id="background-front-tab">
                    <div class="block_separator">
                    	<label for="pix_home_background">
                        	Select the background of your posts page
                        </label>
                        <select id="pix_home_background" name="pix_home_background" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_home_background') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="slideshow"<?php if (get_pix_option('pix_home_background') == 'slideshow') { echo ' selected="selected"'; } ?>>Slideshow</option>
                            <option value="single"<?php if (get_pix_option('pix_home_background') == 'single') { echo ' selected="selected"'; } ?>>Single image</option>
                            <option value="video"<?php if (get_pix_option('pix_home_background') == 'video') { echo ' selected="selected"'; } ?>>Video</option>
                            <option value="googlemap"<?php if (get_pix_option('pix_home_background') == 'googlemap') { echo ' selected="selected"'; } ?>>Google map</option>
                            <option value="none"<?php if (get_pix_option('pix_home_background') == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_home_background" id="pix_home_background" data-type="single">
                    	<label for="pix_wide_image_home">
                        	Upload your image
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        </label>
                        
                        <div id="pix_wide_image_home" class="rm_upload_image">
							<?php if(get_pix_option('pix_wide_image_home')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                            <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_wide_image_home'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                            <input name="pix_wide_image_home" type="text" value="<?php echo get_pix_option('pix_wide_image_home'); ?>">
                            <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                        </div><!-- .rm_upload_image -->
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_home_background" id="pix_home_background" data-type="slideshow">
                    	<label>
                        	Add fields, upload images, remove them, drag and drop!
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        </label>
                        <div class="sorting_admin">
                        <a href="#" class="add" id="add_a_slider">&nbsp;</a>
                        <?php 

							$i = 0;
							$pix_array_slide_home = get_pix_option('pix_array_slide_home_');
							while($i<count($pix_array_slide_home)){
								if($pix_array_slide_home[$i]=='') { $style=' style="display:none"'; } else { $style=''; }
								echo '<div id="pix_array_slide_home_'.$i.'" class="rm_upload_image">
								<div class="handle"></div>
								<div class="image_thumb"><img src="'.get_pix_thumb($pix_array_slide_home[$i], 'exTh').'" alt="Preview"'. $style .' /></div>
								<input name="pix_array_slide_home_['.$i.']" type="text" value="'.$pix_array_slide_home[$i].'">
								<a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                                <a href="#" class="button-secondary remove">Remove</a></div>';
								$i++;
							} 
						?>
                        </div><!-- .sorting -->
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_home_background" id="pix_home_background" data-type="video">
                    	<label for="pix_wide_video_home">
                        	Upload your video
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadvideo.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        </label>
                        
                        <div id="pix_wide_image_home" class="rm_upload_video">
                            <input name="pix_wide_video_home" type="text" value="<?php echo get_pix_option('pix_wide_video_home'); ?>"><br>
                            <a class="button-secondary pix_upload_video_button" href="#">Upload Video</a>
                        </div><!-- .rm_upload_image -->
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_home_background" id="pix_home_background" data-type="video">
                        <label for="pix_wide_video_home_start">
                            Auto start for your video
                        </label>
                        <input type="hidden" value="0" name="pix_wide_video_home_start">                        
                        <input type="checkbox" value="true" name="pix_wide_video_home_start"<?php if(get_pix_option('pix_wide_video_home_start')=="true") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_home_background" id="pix_home_background" data-type="video">                        
                        <label for="pix_wide_video_home_loop">
                            Loop for your video
                        </label>
                        <input type="hidden" value="0" name="pix_wide_video_home_loop">                        
                        <input type="checkbox" value="true" name="pix_wide_video_home_loop"<?php if(get_pix_option('pix_wide_video_home_loop')=="true") { ?> checked="checked"<?php } ?>>
                    </div><!-- .block_separator -->

                           
                    <div class="block_separator toggle pix_home_background" id="pix_home_background" data-type="googlemap">
                    	<label for="pix_wide_googlemap_home">
                        	Coordinates <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" class="pix_tips_ajax topLeft"  data-rel="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" data-width="520">how can I get them?</a>)</small>
                        </label>
                        
                        <input name="pix_wide_googlemap_home" type="text" value="<?php echo get_pix_option('pix_wide_googlemap_home'); ?>"><br>

                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_home_background slider_div googlemap" id="pix_home_background" data-type="googlemap">
                        <label for="pix_wide_googlemap_home_zoom">Zoom</label>
                        <input type="text" id="pix_wide_googlemap_home_zoom" name="pix_wide_googlemap_home_zoom" class="slider_input" value="<?php echo get_pix_option('pix_wide_googlemap_home_zoom'); ?>" />
                        <div class="slider_cursor"></div>
                    </div><!-- .block_separator -->

                    <div class="block_separator toggle pix_home_background" id="pix_home_background" data-type="googlemap">
                        <label for="pix_wide_googlemap_indications_home">Indications</label>
                        <textarea name="pix_wide_googlemap_indications_home" id="pix_wide_googlemap_indications_home"><?php echo stripslashes(get_pix_option( 'pix_wide_googlemap_indications_home' )); ?></textarea>
                    </div><!-- .block_separator -->


                    <div class="block_separator toggle pix_home_background" id="pix_home_background" data-type="googlemap">
                        <label for="pix_wide_googlemap_type_home">Type</label>
                        <select id="pix_wide_googlemap_type_home" name="pix_wide_googlemap_type_home">
                            <option value="HYBRID"<?php if (get_pix_option('pix_wide_googlemap_type_home') == 'HYBRID') { echo ' selected="selected"'; } ?>>hybrid</option>
                            <option value="SATELLITE"<?php if (get_pix_option('pix_wide_googlemap_type_home') == 'SATELLITE') { echo ' selected="selected"'; } ?>>satellite</option>
                            <option value="ROADMAP"<?php if (get_pix_option('pix_wide_googlemap_type_home') == 'ROADMAP') { echo ' selected="selected"'; } ?>>road map</option>
                            <option value="TERRAIN"<?php if (get_pix_option('pix_wide_googlemap_type_home') == 'TERRAIN') { echo ' selected="selected"'; } ?>>terrain</option>
                        </select>
                    </div><!-- .block_separator -->

                </div><!-- #background-front-tab -->

                <div id="layout-front-tab">
                    <div class="block_separator">
                        <label for="pix_sliding_frontpage">Sliding page</label>
                        <select id="pix_sliding_frontpage" name="pix_sliding_frontpage">
                            <option value="default"<?php if (get_pix_option('pix_sliding_frontpage') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="open"<?php if (get_pix_option('pix_sliding_frontpage') == 'open') { echo ' selected="selected"'; } ?>>Open on load</option>
                            <option value="closed"<?php if (get_pix_option('pix_sliding_frontpage') == 'closed') { echo ' selected="selected"'; } ?>>Closed on load</option>
                            <option value="always"<?php if (get_pix_option('pix_sliding_frontpage') == 'always') { echo ' selected="selected"'; } ?>>Always open</option>
                        </select>
                    </div><!-- .block_separator -->
                </div><!-- #layout-front-tab -->

                <div id="content-front-tab">
                    <div class="block_separator">
                        <label for="pix_frontpage_posttype">What do you want to show in the posts page</label>
                        <select id="pix_frontpage_posttype" name="pix_frontpage_posttype" class="toggler">
                            <option value="posts"<?php if (get_pix_option('pix_frontpage_posttype') == 'posts') { echo ' selected="selected"'; } ?>>Posts</option>
                            <option value="portfolio"<?php if (get_pix_option('pix_frontpage_posttype') == 'portfolio') { echo ' selected="selected"'; } ?>>Portfolio items</option>
                            <option value="nothing"<?php if (get_pix_option('pix_frontpage_posttype') == 'nothing') { echo ' selected="selected"'; } ?>>Nothing</option>
                        </select>
                    </div><!-- .block_separator -->

                <div class="toggle pix_frontpage_posttype" data-type="portfolio posts">
                    <div class="block_separator toggle pix_frontpage_posttype" data-type="posts">
                        <label for="pix_frontpage_posttype_categories">What categories</label>
                        <small>Keep &quot;ctrl&quot; button on PC or &quot;cmd&quot; button on MAC for multiple selections</small>
                        <select id="pix_frontpage_posttype_categories" multiple size="6" style="height:auto!important" name="pix_frontpage_posttype_categories[]">
                            <option value="all"<?php if (is_array(get_pix_option('pix_frontpage_posttype_categories')) && in_array('all',get_pix_option('pix_frontpage_posttype_categories'))) { echo ' selected="selected"'; } ?>>All the categories</option>
							<?php 
							$categories =  get_categories(); 
                            foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->term_id; ?>"<?php if (is_array(get_pix_option('pix_frontpage_posttype_categories')) && in_array($category->term_id,get_pix_option('pix_frontpage_posttype_categories'))) { echo ' selected="selected"'; } ?>><?php echo $category->cat_name; ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- .block_separator -->
                
                    <div class="block_separator toggle pix_frontpage_posttype" data-type="portfolio">
                        <label for="pix_frontpage_posttype_galleries">What galleries</label>
                        <small>Keep &quot;ctrl&quot; button on PC or &quot;cmd&quot; button on MAC for multiple selections</small>
                        <select id="pix_frontpage_posttype_galleries" multiple size="6" style="height:auto!important" name="pix_frontpage_posttype_galleries[]">
                            <option value="all"<?php if (is_array(get_pix_option('pix_frontpage_posttype_galleries')) && in_array('all',get_pix_option('pix_frontpage_posttype_galleries'))) { echo ' selected="selected"'; } ?>>All the portfolio items</option>
                            <?php $terms = get_terms("gallery");
                            $count = count($terms);
                            if($count > 0){
                                foreach ($terms as $term) { ?>
                                    <option value="<?php echo $term->slug; ?>"<?php if (is_array(get_pix_option('pix_frontpage_posttype_galleries')) && in_array($term->slug,get_pix_option('pix_frontpage_posttype_galleries'))) { echo ' selected="selected"'; } ?>><?php echo $term->name; ?></option>
                            
                                <?php }
                            } ?>
                        </select>
                    </div><!-- .block_separator -->
                	<div class="block_separator toggle pix_frontpage_posttype" data-type="portfolio">

                        <label for="pix_frontpage_galleries_template" >Template</label>
                        <select class="toggler" name="pix_frontpage_galleries_template" id="pix_frontpage_galleries_template">
                            <option value="onecolumn"<?php if (get_pix_option('pix_frontpage_galleries_template') == 'onecolumn') { echo ' selected="selected"'; } ?>>One column</option>
                            <option value="twocolumns"<?php if (get_pix_option('pix_frontpage_galleries_template') == 'twocolumns') { echo ' selected="selected"'; } ?>>Two columns</option>
                            <option value="threecolumns"<?php if (get_pix_option('pix_frontpage_galleries_template') == 'threecolumns') { echo ' selected="selected"'; } ?>>Three columns</option>
                            <option value="fourcolumns"<?php if (get_pix_option('pix_frontpage_galleries_template') == 'fourcolumns') { echo ' selected="selected"'; } ?>>Four columns</option>
                            <option value="fivecolumns"<?php if (get_pix_option('pix_frontpage_galleries_template') == 'fivecolumns') { echo ' selected="selected"'; } ?>>Five columns</option>
                            <option value="widepage"<?php if (get_pix_option('pix_frontpage_galleries_template') == 'widepage') { echo ' selected="selected"'; } ?>>Wide page</option>
                        </select>

                        <div class="clear"></div>

                        <label for="pix_frontpage_galleries_filterable">Filterable portfolio page</label>
                        <input type="hidden" value="0" name="pix_frontpage_galleries_filterable">
                        <input type="checkbox" data-target="sliding_term_toggle" class="check_toggler" value="show" name="pix_frontpage_galleries_filterable"<?php if(get_pix_option('pix_frontpage_galleries_filterable')=="show") { ?> checked="checked"<?php } ?>>

                        <div class="clear"></div>

                        <label for="pix_frontpage_galleries_scrolling">Infinite scrolling page</label>
                        <input type="hidden" value="0" name="pix_frontpage_galleries_scrolling">
                        <input type="checkbox" data-target="sliding_term_toggle" class="check_toggler" value="show" name="pix_frontpage_galleries_scrolling"<?php if(get_pix_option('pix_frontpage_galleries_scrolling')=="show") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>

                        <label for="pix_frontpage_galleries_colorbox">Show &quot;Open in a ColorBox&quot; link</label>
                        <input type="hidden" value="0" name="pix_frontpage_galleries_colorbox">
                        <input type="checkbox" data-target="sliding_term_toggle" class="check_toggler" value="show" name="pix_frontpage_galleries_colorbox"<?php if(get_pix_option('pix_frontpage_galleries_colorbox')=="show") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>

                        <label for="pix_frontpage_galleries_slideshow">Have a slideshow in the ColorBox</label>
                        <input type="hidden" value="0" name="pix_frontpage_galleries_slideshow">
                        <input type="checkbox" data-target="sliding_term_toggle" class="check_toggler" value="show" name="pix_frontpage_galleries_slideshow"<?php if(get_pix_option('pix_frontpage_galleries_slideshow')=="show") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>

                        <label for="pix_frontpage_galleries_gotopage">Show &quot;Go to the page&quot; link</label>
                        <input type="hidden" value="0" name="pix_frontpage_galleries_gotopage">
                        <input type="checkbox" data-target="sliding_term_toggle" class="check_toggler" value="show" name="pix_frontpage_galleries_gotopage"<?php if(get_pix_option('pix_frontpage_galleries_gotopage')=="show") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>

                    	<label for="pix_frontpage_galleries_tooltip">Tooltip on image</label>
                        <select id="pix_frontpage_galleries_tooltip" name="pix_frontpage_galleries_tooltip">
                            <option value="title"<?php if (get_pix_option('pix_frontpage_galleries_tooltip') == 'title') { echo ' selected="selected"'; } ?>>Show title</option>
                            <option value="titleexcerpt"<?php if (get_pix_option('pix_frontpage_galleries_tooltip') == 'titleexcerpt') { echo ' selected="selected"'; } ?>>Show title and excerpt</option>
                            <option value="titleaction"<?php if (get_pix_option('pix_frontpage_galleries_tooltip') == 'titleaction') { echo ' selected="selected"'; } ?>>Show title and action</option>
                            <option value="titleexcerptaction"<?php if (get_pix_option('pix_frontpage_galleries_tooltip') == 'titleexcerptaction') { echo ' selected="selected"'; } ?>>Show title, excerpt and action</option>
                            <option value="action"<?php if (get_pix_option('pix_frontpage_galleries_tooltip') == 'action') { echo ' selected="selected"'; } ?>>Show action</option>
                            <option value="hide"<?php if (get_pix_option('pix_frontpage_galleries_tooltip') == 'hide') { echo ' selected="selected"'; } ?>>Hide tooltip</option>
                        </select>

                    </div><!-- .block_separator -->

                	<div class="block_separator toggle pix_frontpage_posttype" data-type="posts">
                        <div class="slider_div">
                            <label for="pix_frontpage_length_excerpt">How many words do you want to show in the excerpt</label>
                            <input type="text" id="pix_frontpage_length_excerpt" name="pix_frontpage_length_excerpt" class="slider_input" value="<?php echo get_pix_option('pix_frontpage_length_excerpt'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                    </div><!-- .block_separator -->
        
                	<div class="block_separator toggle pix_frontpage_posttype" data-type="posts">
                        <label for="pix_frontpage_content_excerpt">What do you want to display</label>
                        <select id="pix_frontpage_content_excerpt" name="pix_frontpage_content_excerpt">
                            <option value="excerpt"<?php if (get_pix_option('pix_frontpage_content_excerpt') == 'excerpt') { echo ' selected="selected"'; } ?>>The excerpt</option>
                            <option value="content"<?php if (get_pix_option('pix_frontpage_content_excerpt') == 'content') { echo ' selected="selected"'; } ?>>The content</option>
                        </select>
                    </div><!-- .block_separator -->
        
                	<div class="block_separator toggle pix_frontpage_posttype" data-type="posts">
                        <label for="pix_frontpage_featured_image" >
                            Hide the featured images
                        </label>
                        <input type="hidden" value="0" name="pix_frontpage_featured_image">
                        <input type="checkbox" value="true" name="pix_frontpage_featured_image"<?php if(get_pix_option('pix_frontpage_featured_image')=="true") { ?> checked="checked"<?php } ?>>
                        
                    </div><!-- .block_separator -->
                        
                	<div class="block_separator toggle pix_frontpage_posttype" data-type="portfolio posts">
                        <div class="slider_div border">
                            <label for="pix_frontpage_galleries_ppp">How many posts per page</label>
                            <input type="text" id="pix_frontpage_galleries_ppp" name="pix_frontpage_galleries_ppp" class="slider_input" value="<?php echo get_pix_option('pix_frontpage_galleries_ppp'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->

                    </div><!-- .block_separator -->
    

                	<div class="block_separator toggle pix_frontpage_posttype" data-type="posts">

                        <label for="pix_frontpage_posts_image_link">Featured image action</label>
                        <select id="pix_frontpage_posts_image_link" name="pix_frontpage_posts_image_link">
                            <option value="goto"<?php if (get_pix_option('pix_frontpage_posts_image_link') == 'goto') { echo ' selected="selected"'; } ?>>Go to the post</option>
                            <option value="enlarge"<?php if (get_pix_option('pix_frontpage_posts_image_link') == 'enlarge') { echo ' selected="selected"'; } ?>>Enlarge picture</option>
                            <option value="both"<?php if (get_pix_option('pix_frontpage_posts_image_link') == 'both') { echo ' selected="selected"'; } ?>>Both</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                    	<label for="pix_front_page_title">
                        	Main posts page title
                        </label>
                         <input name="pix_front_page_title" id="pix_front_page_title" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_front_page_title' )); ?>" />
                         <p></p>
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                    	<label for="pix_front_page_content">
                        	Description
                        </label>
                    	<?php the_editor(stripslashes(get_pix_option('pix_front_page_content')), $id = 'pix_front_page_content'); ?>
                    </div><!-- .block_separator -->
                 </div><!-- .toggle "nothing -->
                </div><!-- #content-front-tab -->

                <div id="seo-front-tab">
                    <div class="block_separator">
                    	<label for="pix_front_page_seo_title">
                        	Posts page title
                        </label>
                         <input name="pix_front_page_seo_title" id="pix_front_page_seo_title" class="pix_title_seo" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_front_page_seo_title' )); ?>" />
                        <p></p>
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                    	<label for="pix_front_page_seo_description">
                        	Meta description
                        </label>
                         <textarea name="pix_front_page_seo_description" id="pix_front_page_seo_description" class="pix_desc_seo"><?php echo stripslashes(get_pix_option( 'pix_front_page_seo_description' )); ?></textarea>
                        <p></p>
                    </div><!-- .block_separator -->
                    <div class="block_separator">
                    	<label for="pix_front_page_seo_keywords">
                        	Meta keywords
                        </label>
                         <input name="pix_front_page_seo_keywords" id="pix_front_page_seo_keywords" type="text" value="<?php echo stripslashes(get_pix_option( 'pix_front_page_seo_keywords' )); ?>" />
                    </div><!-- .block_separator -->
               </div><!-- #seo-front-tab -->

                <div id="sidebar-front-tab">
                    <div class="block_separator">
                        <label for="pix_sidebar_frontpage_layout">Show/hide sidebar and its position</label>
                        <select id="pix_sidebar_frontpage_layout" name="pix_sidebar_frontpage_layout" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_sidebar_frontpage_layout') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="rightsidebar"<?php if (get_pix_option('pix_sidebar_frontpage_layout') == 'rightsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the right</option>
                            <option value="leftsidebar"<?php if (get_pix_option('pix_sidebar_frontpage_layout') == 'leftsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the left</option>
                            <option value="nosidebar"<?php if (get_pix_option('pix_sidebar_frontpage_layout') == 'nosidebar') { echo ' selected="selected"'; } ?>>Hide sidebar</option>
                        </select>
                    </div><!-- .block_separator -->
                    
                    <div class="block_separator toggle pix_sidebar_frontpage_layout" id="pix_sidebar_frontpage_layout" data-type="nosidebar">
                    	<label for="pix_front_page_layout">
                        	Main content layout
                        </label>
                        <select id="pix_front_page_layout" name="pix_front_page_layout">
                            <option value="left"<?php if (get_pix_option('pix_front_page_layout') == 'left') { echo ' selected="selected"'; } ?>>Narrow left column</option>
                            <option value="right"<?php if (get_pix_option('pix_front_page_layout') == 'right') { echo ' selected="selected"'; } ?>>Narrow right column</option>
                            <option value="wide"<?php if (get_pix_option('pix_front_page_layout') == 'wide') { echo ' selected="selected"'; } ?>>Wide column</option>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sidebar_frontpage">Select the sidebar for your posts page</label>
                    	<select name="pix_sidebar_frontpage" id="pix_sidebar_frontpage" class="select_sidebar">
                            <option<?php if (get_pix_option('pix_sidebar_frontpage') == 'None') { echo ' selected="selected"'; } ?>>None</option>
                        <?php
                        $sidebars = sidebar_generator_pix::get_sidebars();
                        if(is_array($sidebars) && !empty($sidebars)){
                            foreach($sidebars as $sidebar){ ?>
                                <option<?php if (get_pix_option('pix_sidebar_frontpage') == $sidebar) { echo ' selected="selected"'; } ?>><?php echo $sidebar; ?></option>
                            <?php }
                        }
                        ?>
                        </select>
                    </div><!-- .block_separator -->
                </div><!-- #sidebar-front-tab -->
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>
            </div><!-- #frontpage-tab -->
           
            <div id="sidebar-tab">
                <ul>
                    <li><a href="#your-sidebars-tab">Your sidebars</a></li>
                    <li><a href="#associate-sidebars-tab">Associate them</a></li>
                </ul>
                <form method="post">
                <div id="your-sidebars-tab">
                    <div class="block_separator">
                	<?php if ($current_user->display_name == 'pix_test' || $current_user->display_name == 'manu_test') { ?>
                    	<p>Sorry, you can't see this section as a preview.</p>
                    <?php } else { ?>
                     	<label for="sidebar_generator_0">Add a sidebar</label>
                        <input name="sidebar_generator_0" id="sidebar_generator_0" type="text" value="" />
                        <input name="save" type="submit" class="add-sidebar" value="&nbsp;" />

                    </div><!-- .block_separator -->

                    <div class="block_separator">
                     	<label>Your sidebars</label>
    <?php
    $get_sidebar_options = sidebar_generator_pix::get_sidebars();
    if($get_sidebar_options != "") {
    $i=1;
    
    foreach ($get_sidebar_options as $sidebar_gen) { ?>
    <?php if($i == 1) { ?>
    
    <?php } ?>
    
        <div id="sidebar_row_<?php echo $i; ?>" class="sidebar_row">
            <input type="submit" name="sidebar_rm_<?php echo $i; ?>" id="<?php echo $i; ?>" class="delete-sidebar" value="&nbsp;" />
        	<?php echo $i.' - '; ?>
            <span class="loading_sidebar"><img class="sidebar_rm_<?php echo $i; ?>" style="display:none;" src="images/wpspin_light.gif" alt="Loading" /></span>
            <span class="sidebar_gen_Text"><?php echo $sidebar_gen; ?></span>

            <input id="<?php echo 'sidebar_generator_'.$i ?>" type="hidden" name="<?php echo 'sidebar_generator_'.$i ?>" value="<?php echo $sidebar_gen; ?>" />
        </div>
    <?php $i++;  
    }
    } else {
		echo 'You still have no sidebars';
	}
    

	}
    ?>
                    </div><!-- .block_separator -->

                </div><!-- #your-sidebars-tab -->

                <div id="associate-sidebars-tab">
                    <div class="block_separator">
                        <label>To associate a sidebar to the posts page, click &quot;Posts page -&gt; Sidebar&quot;</label>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sidebar_posts">Associate a sidebar to all the POSTS</label>
                    	<select name="pix_sidebar_posts" id="pix_sidebar_posts" class="select_sidebar">
                            <option<?php if (get_pix_option('pix_sidebar_posts') == 'None') { echo ' selected="selected"'; } ?>>None</option>
                        <?php
                        $sidebars = sidebar_generator_pix::get_sidebars();
                        if(is_array($sidebars) && !empty($sidebars)){
                            foreach($sidebars as $sidebar){ ?>
                                <option<?php if (get_pix_option('pix_sidebar_posts') == $sidebar) { echo ' selected="selected"'; } ?>><?php echo $sidebar; ?></option>
                            <?php }
                        }
                        ?>
                        </select>
                        <small>Then you can select a different sidebar for each single post directly by its admin panel</small>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sidebar_pages">Associate a sidebar to all the PAGES</label>
                    	<select name="pix_sidebar_pages" id="pix_sidebar_pages" class="select_sidebar">
                            <option<?php if (get_pix_option('pix_sidebar_pages') == 'None') { echo ' selected="selected"'; } ?>>None</option>
                        <?php
                        $sidebars = sidebar_generator_pix::get_sidebars();
                        if(is_array($sidebars) && !empty($sidebars)){
                            foreach($sidebars as $sidebar){ ?>
                                <option<?php if (get_pix_option('pix_sidebar_pages') == $sidebar) { echo ' selected="selected"'; } ?>><?php echo $sidebar; ?></option>
                            <?php }
                        }
                        ?>
                        </select>
                        <small>Then you can select a different sidebar for each single page directly by its admin panel</small>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sidebar_categories">Associate a sidebar to all the CATEGORY pages</label>
                    	<select name="pix_sidebar_categories" id="pix_sidebar_categories" class="select_sidebar">
                            <option<?php if (get_pix_option('pix_sidebar_categories') == 'None') { echo ' selected="selected"'; } ?>>None</option>
                        <?php
                        $sidebars = sidebar_generator_pix::get_sidebars();
                        if(is_array($sidebars) && !empty($sidebars)){
                            foreach($sidebars as $sidebar){ ?>
                                <option<?php if (get_pix_option('pix_sidebar_categories') == $sidebar) { echo ' selected="selected"'; } ?>><?php echo $sidebar; ?></option>
                            <?php }
                        }
                        ?>
                        </select>
                        <small>Then you can select a different sidebar for each single category page by clicking &quot;Blog -&gt; Categories&quot;</small>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sidebar_taxonomies">Associate a sidebar to all the PORTFOLIO pages</label>
                    	<select name="pix_sidebar_taxonomies" id="pix_sidebar_taxonomies" class="select_sidebar">
                            <option<?php if (get_pix_option('pix_sidebar_taxonomies') == 'None') { echo ' selected="selected"'; } ?>>None</option>
                        <?php
                        $sidebars = sidebar_generator_pix::get_sidebars();
                        if(is_array($sidebars) && !empty($sidebars)){
                            foreach($sidebars as $sidebar){ ?>
                                <option<?php if (get_pix_option('pix_sidebar_taxonomies') == $sidebar) { echo ' selected="selected"'; } ?>><?php echo $sidebar; ?></option>
                            <?php }
                        }
                        ?>
                        </select>
                        <small>Then you can select a different sidebar for each single portfolio page by clicking &quot;Delight -&gt; Portfolio&quot;</small>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sidebar_archives">Associate a sidebar to all the ARCHIVE pages</label>
                    	<select name="pix_sidebar_archives" id="pix_sidebar_archives" class="select_sidebar">
                            <option<?php if (get_pix_option('pix_sidebar_archives') == 'None') { echo ' selected="selected"'; } ?>>None</option>
                        <?php
                        $sidebars = sidebar_generator_pix::get_sidebars();
                        if(is_array($sidebars) && !empty($sidebars)){
                            foreach($sidebars as $sidebar){ ?>
                                <option<?php if (get_pix_option('pix_sidebar_archives') == $sidebar) { echo ' selected="selected"'; } ?>><?php echo $sidebar; ?></option>
                            <?php }
                        }
                        ?>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sidebar_404">Associate a sidebar to the 404 page</label>
                    	<select name="pix_sidebar_404" id="pix_sidebar_404" class="select_sidebar">
                            <option<?php if (get_pix_option('pix_sidebar_404') == 'None') { echo ' selected="selected"'; } ?>>None</option>
                        <?php
                        $sidebars = sidebar_generator_pix::get_sidebars();
                        if(is_array($sidebars) && !empty($sidebars)){
                            foreach($sidebars as $sidebar){ ?>
                                <option<?php if (get_pix_option('pix_sidebar_404') == $sidebar) { echo ' selected="selected"'; } ?>><?php echo $sidebar; ?></option>
                            <?php }
                        }
                        ?>
                        </select>
                    </div><!-- .block_separator -->

                    <div class="block_separator">
                        <label for="pix_sidebar_search">Associate a sidebar to the SEARCH RESULTS page</label>
                    	<select name="pix_sidebar_search" id="pix_sidebar_search" class="select_sidebar">
                            <option<?php if (get_pix_option('pix_sidebar_search') == 'None') { echo ' selected="selected"'; } ?>>None</option>
                        <?php
                        $sidebars = sidebar_generator_pix::get_sidebars();
                        if(is_array($sidebars) && !empty($sidebars)){
                            foreach($sidebars as $sidebar){ ?>
                                <option<?php if (get_pix_option('pix_sidebar_search') == $sidebar) { echo ' selected="selected"'; } ?>><?php echo $sidebar; ?></option>
                            <?php }
                        }
                        ?>
                        </select>
                    </div><!-- .block_separator -->

                </div><!-- #associate-sidebars-tab -->
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>
            </div><!-- #sidebar-tab -->

            
            <div id="contact-tab">
                <ul>
                    <li><a href="#your-form-tab">Admin your forms</a></li>
                     <?php 

                        $i = 0;
                        $pix_array_your_forms = get_pix_option('pix_array_your_forms_');
                        while($i<count($pix_array_your_forms)){
                            echo '<li><a href="#'.sanitize_title($pix_array_your_forms[$i]).'_form_builder">'.$pix_array_your_forms[$i].'</a></li>';
                            $i++;
                        } 
                    ?>
                </ul>
                <form method="post">
                <div id="your-form-tab">
                    <div class="block_separator">
                    	<label>
                        	Your forms
                            <small>Be always sure to use different names for your forms.<br>
                            N.B.: only letters and numbers are allowed</small>
                        </label>
                        <div class="added_forms_div">
                            <a href="#" id="add_a_form">&nbsp;</a><br>


							 <?php 
                                $i = 0;
                                $pix_array_your_forms = get_pix_option('pix_array_your_forms_');
                                while($i<count($pix_array_your_forms)){
                                    echo '<div class="added_form" id="added_form_'.$i.'"><input id="'.sanitize_title($pix_array_your_forms[$i]).'" name="pix_array_your_forms_[' . $i . ']" type="text" value="'.$pix_array_your_forms[$i].'" style="width:390px; float:left;" /><a href="#" class="button-secondary remove alignright" style="margin-top:4px">Remove</a></div><div class="clear"></div>';
                                    $i++;
                                } 
                            ?>
                           
                        </div><!-- .form_added_div -->
                    </div><!-- .block_separator -->

                    <div class="block_separator" style="display:none;">
                    	Prova
                    </div><!-- .block_separator -->

                </div><!-- #your-sidebars-tab -->
				<?php 
					$i = 0;
					$pix_array_your_forms = get_pix_option('pix_array_your_forms_');
					while($i<count($pix_array_your_forms)){
						echo '<div id="'.sanitize_title($pix_array_your_forms[$i]).'_form_builder" class="form_builder">
							<div class="block_separator">
						<label>'.$pix_array_your_forms[$i].'</label>
						If you want to have this form inside a page or post, use the button you find on the editor, or copy and paste this shortcode:<br><strong style="background:#fff; padding:2px 1px;">[pix_contact_form form="'.sanitize_title($pix_array_your_forms[$i]).'"]</strong><br><br>';
						$i2 = 0;
						$pix_array_your_field = get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_fields_');
						?>
                        Recipient address:
                        <input type="text" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_recipient" value="<?php if(get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_recipient')==''){ echo get_pix_option('admin_email'); } else { echo get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_recipient'); } ?>">
                        Email subject:
                        <input type="text" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_subject" value="<?php if(get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_subject')==''){ echo 'Email from '.stripslashes(get_pix_option( 'pix_site_title' )); } else { echo get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_subject'); } ?>">
                        Success:
                        <textarea name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_issuccess"><?php if(get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_issuccess')==''){ ?><strong>Thank you!</strong> We received your message.<?php } else { echo get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_issuccess'); } ?></textarea>
                        Unuccess:
                        <textarea name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_unsuccess"><?php if(get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_unsuccess')==''){ ?><strong>Sorry, unexpected error.</strong> Please try again later.<?php } else { echo get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_unsuccess'); } ?></textarea>
                        Send button:
                        <input type="text" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_button" value="<?php if(get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_button')==''){ ?>Send<?php } else { echo get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_button'); } ?>"><br>
                        <div class="sorting_fields">
                        <a href="#" class="add_a_field">&nbsp;</a>
                        <?php 
							while ($i2<count($pix_array_your_field)){ ?>
								<div id="added_field<?php echo $i; ?>_<?php echo $i2; ?>" class="added_field">
								<div class="handle"></div>
								<div style="float:left; width:190px"><select name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][0]">
									<option value="2"<?php if($pix_array_your_field[$i2][0]=='2') { ?> selected="selected"<?php } ?>>Text</option>
									<option value="3"<?php if($pix_array_your_field[$i2][0]=='3') { ?> selected="selected"<?php } ?>>Email</option>
									<option value="4"<?php if($pix_array_your_field[$i2][0]=='4') { ?> selected="selected"<?php } ?>>Alternative mail</option>
									<option value="5"<?php if($pix_array_your_field[$i2][0]=='5') { ?> selected="selected"<?php } ?>>Textarea</option>
									<option value="6"<?php if($pix_array_your_field[$i2][0]=='6') { ?> selected="selected"<?php } ?>>Select</option>
									<option value="10"<?php if($pix_array_your_field[$i2][0]=='10') { ?> selected="selected"<?php } ?>>Multiple selection select</option>
									<option value="11"<?php if($pix_array_your_field[$i2][0]=='11') { ?> selected="selected"<?php } ?>>Checkbox</option>
									<option value="12"<?php if($pix_array_your_field[$i2][0]=='12') { ?> selected="selected"<?php } ?>>Radio button</option>
									<option value="7"<?php if($pix_array_your_field[$i2][0]=='7') { ?> selected="selected"<?php } ?>>Period (from)</option>
									<option value="13"<?php if($pix_array_your_field[$i2][0]=='13') { ?> selected="selected"<?php } ?>>Period (to)</option>
									<option value="8"<?php if($pix_array_your_field[$i2][0]=='8') { ?> selected="selected"<?php } ?>>Captcha</option>
								</select>
                                <div class="added_field_2 added_field_4 added_field_5 added_field_6 added_field_7 added_field_10 added_field_11 added_field_12 added_field_13 toHide" style="display:none">
                                    <label for="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][1]">Required:</label>
                                    <input type="hidden" value="0" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][1]">                        
                                    <input type="checkbox" value="required" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][1]"<?php if($pix_array_your_field[$i2][1]=='required') { ?> checked="checked"<?php } ?>>
                                </div>
                                <a href="#" class="button-secondary remove">Remove</a>
                                <div class="added_field_2 added_field_4 added_field_5 added_field_6 added_field_7 added_field_10 added_field_11 added_field_12 added_field_13 toHide" style="display:none; clear:left; padding-top:5px">
                                	<label for="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][9]">Name:</label>
                                    <input type="text" style="border-color:#b2b2a1; width:140px; float:right" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][9]"  value="<?php if($pix_array_your_field[$i2][9]==''){ ?>Field<?php echo $i2; ?><?php } else { echo stripslashes($pix_array_your_field[$i2][9]); } ?>">
                                </div>
                                <div class="added_field_3 added_field_8 alert toHide" style="display: none">Use this field only once in a form!</div>
                                </div>
                                <textarea class="added_field_2 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][2]"><?php if($pix_array_your_field[$i2][2]==''){ ?><label>Name:</label>
[pix_text name="Field<?php echo $i2; ?>"]<?php } else { echo stripslashes($pix_array_your_field[$i2][2]); } ?></textarea>
                                <textarea class="added_field_3 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][3]"><?php if($pix_array_your_field[$i2][3]==''){ ?><label>Email:</label>
[pix_email]<?php } else { echo stripslashes($pix_array_your_field[$i2][3]); } ?></textarea>
                                <textarea class="added_field_4 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][4]"><?php if($pix_array_your_field[$i2][4]==''){ ?><label>Alternative email:</label>
[pix_alt_email name="Field<?php echo $i2; ?>"]<?php } else { echo stripslashes($pix_array_your_field[$i2][4]); } ?></textarea>
                                <textarea class="added_field_5 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][5]"><?php if($pix_array_your_field[$i2][5]==''){ ?><label>Message:</label>
[pix_textarea name="Field<?php echo $i2; ?>"]<?php } else { echo stripslashes($pix_array_your_field[$i2][5]); } ?></textarea>
                                <textarea class="added_field_6 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][6]"><?php if($pix_array_your_field[$i2][6]==''){ ?><label>Select an option:</label>
[pix_select name="Field<?php echo $i2; ?>"][pix_option][/pix_option][pix_option value="first"]First[/pix_option][pix_option value="second"]Second[/pix_option][/pix_select]<?php } else { echo stripslashes($pix_array_your_field[$i2][6]); } ?></textarea>
                                <textarea class="added_field_10 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][10]"><?php if($pix_array_your_field[$i2][10]==''){ ?><label>Select an option:</label>
[pix_select name="Field<?php echo $i2; ?>" multiple="multiple" height="50"][pix_option][/pix_option][pix_option value="first"]First[/pix_option][pix_option value="second"]Second[/pix_option][/pix_select]<?php } else { echo stripslashes($pix_array_your_field[$i2][10]); } ?></textarea>
                                <textarea class="added_field_11 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][11]"><?php if($pix_array_your_field[$i2][11]==''){ ?><label>Check this box:</label>
[pix_checkbox name="Field<?php echo $i2; ?>"]<?php } else { echo stripslashes($pix_array_your_field[$i2][11]); } ?></textarea>
                                <textarea class="added_field_12 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][12]"><?php if($pix_array_your_field[$i2][12]==''){ ?><label>Radio button:</label>
[pix_radio name="Field<?php echo $i2; ?>" value="First button"][pix_radio name="Field<?php echo $i2; ?>" value="Second button"]<?php } else { echo stripslashes($pix_array_your_field[$i2][12]); } ?></textarea>
                                <textarea class="added_field_7 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][7]"><?php if($pix_array_your_field[$i2][7]==''){ ?><label>Pediod from:</label>
[pix_period_from name="From<?php echo $i2; ?>"]<?php } else { echo stripslashes($pix_array_your_field[$i2][7]); } ?></textarea>
                                <textarea class="added_field_13 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][13]"><?php if($pix_array_your_field[$i2][13]==''){ ?><label>Pediod to:</label>
[pix_period_to name="To<?php echo $i2; ?>"]<?php } else { echo stripslashes($pix_array_your_field[$i2][13]); } ?></textarea>
                                <textarea class="added_field_8 toHide" style="display:none" name="pix_array_<?php echo sanitize_title($pix_array_your_forms[$i]); ?>_fields_[<?php echo $i2; ?>][8]"><?php if($pix_array_your_field[$i2][8]==''){ ?><label>Captcha:</label>
<div class="captchaCont">[pix_captcha_img] [pix_captcha_input]</div><?php } else { echo stripslashes($pix_array_your_field[$i2][8]); } ?></textarea>
                                </div>
                            <?php
								$i2++;
							} 
						?>
                        </div><!-- .sorting -->
                        <?php
						echo '</div><!-- .block_separator -->
						</div><!-- #'.sanitize_title($pix_array_your_forms[$i][0]).' -->';
						$i++;
					} 
                ?>
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>
            </div><!-- #contact-tab -->

            <div id="blog-tab">
                <ul>
                    <li><a href="#posts-tab">Posts</a></li>
                    <li><a href="#pages-tab">Pages</a></li>
                    <li><a href="#archives-tab">Archive pages</a></li>
                    <?php $categories = get_categories();
						$category_ids = array();
						foreach ($categories as $category) { 
							array_push($category_ids, $category->cat_ID);
						}
						if(get_pix_option('pix_category_hack')=='all' || get_pix_option('pix_category_hack')=='' || (is_array(get_pix_option('pix_category_hack')) && in_array('all', get_pix_option('pix_category_hack')))) {
							$pix_category_hack = $category_ids;
						} else {
							$pix_category_hack = get_pix_option('pix_category_hack');
						}
                        foreach ($categories as $category) { if (in_array($category->cat_ID, $pix_category_hack)) {  ?>
                        <li><a href="#category-tab-<?php echo $category->cat_ID; ?>"><?php echo $category->cat_name; ?></a></li>
                    <?php } } ?>
                    <li><a href="#searchpage-tab">Search result page</a></li>
                    <li><a href="#404-tab">404 page</a></li>
                </ul>
                
                <form method="post">
                <div id="posts-tab">
                	<div class="block_separator">
                        <label for="pix_show_postmetadata">Show post meta data section in single posts</label>
                        <input type="hidden" value="0" name="pix_show_postmetadata">
                        <input type="checkbox" value="show" name="pix_show_postmetadata"<?php if(get_pix_option('pix_show_postmetadata')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>

                        <label for="pix_archive_show_postmetadata">Show post meta data section in archive pages</label>
                        <input type="hidden" value="0" name="pix_archive_show_postmetadata">
                        <input type="checkbox" value="show" name="pix_archive_show_postmetadata"<?php if(get_pix_option('pix_archive_show_postmetadata')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>

                        <label for="pix_postmetadata_comments">Display the comments in the post meta data section</label>
                        <input type="hidden" value="0" name="pix_postmetadata_comments">
                        <input type="checkbox" value="show" name="pix_postmetadata_comments"<?php if(get_pix_option('pix_postmetadata_comments')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>

                        <label for="pix_prev_next_posts">Show prev/next post links below the posts</label>
                        <input type="hidden" value="0" name="pix_prev_next_posts">
                        <input type="checkbox" value="show" name="pix_prev_next_posts"<?php if(get_pix_option('pix_prev_next_posts')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>

                        <label for="pix_show_related_items">Show related items below the posts</label>
                        <input type="hidden" value="0" name="pix_show_related_items">
                        <input type="checkbox" value="show" name="pix_show_related_items"<?php if(get_pix_option('pix_show_related_items')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        
                        <label for="pix_what_related_items" >What to show in related posts</label>
                        <select id="pix_what_related_items" name="pix_what_related_items">
                            <option value="excerpt"<?php if (get_pix_option('pix_what_related_items') == 'excerpt') { echo ' selected="selected"'; } ?>>Excerpt only</option>
                            <option value="thumbnail"<?php if (get_pix_option('pix_what_related_items') == 'thumbnail') { echo ' selected="selected"'; } ?>>Thumbnail and excerpt</option>
                        </select>

                        <div class="slider_div">
                            <label for="pix_length_related_items">How many words do you want to show in the excerpt</label>
                            <input type="text" id="pix_length_related_items" name="pix_length_related_items" class="slider_input" value="<?php echo get_pix_option('pix_length_related_items'); ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <div class="clear"></div>
    
                        <label for="pix_post_show_share_section">Show share section in posts</label>
                        <input type="hidden" value="0" name="pix_post_show_share_section">
                        <input type="checkbox" value="show" name="pix_post_show_share_section"<?php if(get_pix_option('pix_post_show_share_section')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>

                        
                        <label for="pix_post_share_type" >Share section type</label>
                        <select id="pix_post_share_type" name="pix_post_share_type">
                            <option value="classic"<?php if (get_pix_option('pix_post_share_type') == 'classic') { echo ' selected="selected"'; } ?>>Simple icons</option>
                            <option value="counter"<?php if (get_pix_option('pix_post_share_type') == 'counter') { echo ' selected="selected"'; } ?>>Official icons with counter</option>
                        </select>
                        <small>"Simple icons": Twitter, Facebook, Delicious, Digg, LinkedIn, StumbleUpon<br>
                        "Official icons with counter": Twitter, Facebook, Google+</small> 
                        <div class="clear"></div>

                    </div><!-- .block_separator -->
                </div><!-- #posts-tab -->

                <div id="pages-tab">
                	<div class="block_separator">
                        <label for="pix_page_show_share_section">Show share section in pages</label>
                        <input type="hidden" value="0" name="pix_page_show_share_section">
                        <input type="checkbox" value="show" name="pix_page_show_share_section"<?php if(get_pix_option('pix_page_show_share_section')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>
                        
                        <label for="pix_page_share_type" >Share section type</label>
                        <select id="pix_page_share_type" name="pix_page_share_type">
                            <option value="classic"<?php if (get_pix_option('pix_page_share_type') == 'classic') { echo ' selected="selected"'; } ?>>Simple icons</option>
                            <option value="counter"<?php if (get_pix_option('pix_page_share_type') == 'counter') { echo ' selected="selected"'; } ?>>Official icons with counter</option>
                        </select>
                        <small>"Simple icons": Twitter, Facebook, Delicious, Digg, LinkedIn, StumbleUpon<br>
                        "Official icons with counter": Twitter, Facebook, Google+</small> 
                        <div class="clear"></div>


                        
                    </div><!-- .block_separator -->
                </div><!-- #posts-tab -->

                <div id="archives-tab">
                	<div class="block_separator">

                        <label for="pix_archive_sliding_page" >Sliding page</label>
                        <select id="pix_archive_sliding_page" name="pix_archive_sliding_page">
                            <option value="default"<?php if (get_pix_option('pix_archive_sliding_page') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="open"<?php if (get_pix_option('pix_archive_sliding_page') == 'open') { echo ' selected="selected"'; } ?>>Open on load</option>
                            <option value="closed"<?php if (get_pix_option('pix_archive_sliding_page') == 'closed') { echo ' selected="selected"'; } ?>>Closed on load</option>
                            <option value="always"<?php if (get_pix_option('pix_archive_sliding_page') == 'always') { echo ' selected="selected"'; } ?>>Always open</option>
                        </select>

                        <label for="pix_archive_sidebar" >Show/hide sidebar and its position</label>
                        <select id="pix_archive_sidebar" name="pix_archive_sidebar" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_archive_sidebar') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="rightsidebar"<?php if (get_pix_option('pix_archive_sidebar') == 'rightsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the right</option>
                            <option value="leftsidebar"<?php if (get_pix_option('pix_archive_sidebar') == 'leftsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the left</option>
                            <option value="nosidebar"<?php if (get_pix_option('pix_archive_sidebar') == 'nosidebar') { echo ' selected="selected"'; } ?>>Hide sidebar</option>
                        </select>
                    
                        <div class="toggle pix_archive_sidebar" id="pix_archive_sidebar" data-type="nosidebar">
                            <label for="pix_archive_maincolumn" >
                                Main column width and position
                            </label>
                            <select id="pix_archive_maincolumn" name="pix_archive_maincolumn">
                                <option value="left"<?php if (get_pix_option('pix_archive_maincolumn') == 'left') { echo ' selected="selected"'; } ?>>Narrow left column</option>
                                <option value="right"<?php if (get_pix_option('pix_archive_maincolumn') == 'right') { echo ' selected="selected"'; } ?>>Narrow right column</option>
                                <option value="wide"<?php if (get_pix_option('pix_archive_maincolumn') == 'wide') { echo ' selected="selected"'; } ?>>Wide column</option>
                            </select>
                        </div><!-- .toggle -->
                        
                    	<label for="pix_archive_slide">Select the background of your archive page</label>
                        <select id="pix_archive_slide" name="pix_archive_slide" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_archive_slide') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="slideshow"<?php if (get_pix_option('pix_archive_slide') == 'slideshow') { echo ' selected="selected"'; } ?>>Slideshow</option>
                            <option value="single"<?php if (get_pix_option('pix_archive_slide') == 'single') { echo ' selected="selected"'; } ?>>Single image</option>
                            <option value="video"<?php if (get_pix_option('pix_archive_slide') == 'video') { echo ' selected="selected"'; } ?>>Video</option>
                            <option value="googlemap"<?php if (get_pix_option('pix_archive_slide') == 'googlemap') { echo ' selected="selected"'; } ?>>Google Map</option>
                            <option value="none"<?php if (get_pix_option('pix_archive_slide') == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        </select>

                        <div class="toggle pix_archive_slide" id="pix_archive_slide" data-type="slideshow">
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            <div class="sorting_admin">
                            <br>
                            <a href="#" class="add" id="add_a_slider">&nbsp;</a>
                            <?php 
    
                                $i = 0;
                                $pix_archive_slide = get_pix_option('pix_array_archive_slide_');
                                while($i<count($pix_archive_slide)){
                                    if($pix_archive_slide[$i]=='') { $style=' style="display:none"'; } else { $style=''; }
                                    echo '<div id="pix_array_archive_slide_'.$i.'" class="rm_upload_image">
                                    <div class="handle"></div>
                                    <div class="image_thumb"><img src="'.get_pix_thumb($pix_archive_slide[$i], 'exTh').'" alt="Preview"'. $style .' /></div>
                                    <input name="pix_array_archive_slide_['.$i.']" type="text" value="'.$pix_archive_slide[$i].'">
                                    <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                                    <a href="#" class="button-secondary remove">Remove</a></div>';
                                    $i++;
                                } 
                            ?>
                            </div><!-- .sorting -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_archive_slide" id="pix_archive_slide" data-type="single">
                        	<br>
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            
                            <div id="pix_archive_single" class="rm_upload_image">
                                <?php if(get_pix_option('pix_archive_single')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                                <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_archive_single'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                                <input name="pix_archive_single" type="text" value="<?php echo get_pix_option('pix_archive_single'); ?>">
                                <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                            </div><!-- .rm_upload_image -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_archive_slide" id="pix_archive_slide" data-type="video">
                            <label for="pix_archive_video">
                                Upload your video
                                <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadvideo.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            </label>
                            
                            <div class="rm_upload_video">
                                <input name="pix_archive_video" type="text" value="<?php echo get_pix_option('pix_archive_video'); ?>"><br>
                                <a class="button-secondary pix_upload_video_button" href="#">Upload Video</a>
                            </div><!-- .rm_upload_image -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_archive_slide" id="pix_archive_slide" data-type="video">
                            <label for="pix_archive_video_start">
                                Auto start for your video
                            </label>
                            <input type="hidden" value="0" name="pix_archive_video_start">                        
                            <input type="checkbox" value="true" name="pix_archive_video_start"<?php if(get_pix_option('pix_archive_video_start')=="true") { ?> checked="checked"<?php } ?>>
                        </div><!-- .toggle -->

						<div class="clear"></div>
                        <div class="toggle pix_archive_slide" id="pix_archive_slide" data-type="video">
                            <label for="pix_archive_video_loop">
                                Loop for your video
                            </label>
                            <input type="hidden" value="0" name="pix_archive_video_loop">                        
                            <input type="checkbox" value="true" name="pix_archive_video_loop"<?php if(get_pix_option('pix_archive_video_loop')=="true") { ?> checked="checked"<?php } ?>>
                        </div><!-- .toggle -->

                        <div class="toggle pix_archive_slide" id="pix_archive_slide" data-type="googlemap">
                            <label for="pix_archive_googlemap">
                                Coordinates <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" class="pix_tips_ajax topLeft"  data-rel="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" data-width="520">how can I get them?</a>)</small>
                            </label>
                            
                            <input name="pix_archive_googlemap" type="text" value="<?php echo get_pix_option('pix_archive_googlemap'); ?>">
    
    
                            <div class="slider_div googlemap">
                                <label for="pix_archive_googlemap_zoom">Zoom</label>
                                <input type="text" id="pix_archive_googlemap_zoom" name="pix_archive_googlemap_zoom" class="slider_input" value="<?php echo get_pix_option('pix_archive_googlemap_zoom'); ?>" />
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->
                            <div class="clear"></div>
    
                            <label for="pix_archive_googlemap_indications">Indications</label>
                            <textarea name="pix_archive_googlemap_indications" id="pix_archive_googlemap_indications"><?php echo stripslashes(get_pix_option( 'pix_archive_googlemap_indications' )); ?></textarea>
                             <div class="clear"></div>
                           
                            <label for="pix_archive_googlemap_type">Type</label>
                            <select id="pix_archive_googlemap_type" name="pix_archive_googlemap_type">
                                <option value="HYBRID"<?php if (get_pix_option('pix_archive_googlemap_type') == 'HYBRID') { echo ' selected="selected"'; } ?>>hybrid</option>
                                <option value="SATELLITE"<?php if (get_pix_option('pix_archive_googlemap_type') == 'SATELLITE') { echo ' selected="selected"'; } ?>>satellite</option>
                                <option value="ROADMAP"<?php if (get_pix_option('pix_archive_googlemap_type') == 'ROADMAP') { echo ' selected="selected"'; } ?>>road map</option>
                                <option value="TERRAIN"<?php if (get_pix_option('pix_archive_googlemap_type') == 'TERRAIN') { echo ' selected="selected"'; } ?>>terrain</option>
                            </select>

                        </div><!-- .toggle -->



                    </div><!-- .block_separator -->

                </div><!-- #archives-tab -->
                
				<?php $categories = get_categories();
						$category_ids = array();
						foreach ($categories as $category) { 
							array_push($category_ids, $category->cat_ID);
						}
						if(get_pix_option('pix_category_hack')=='all' || get_pix_option('pix_category_hack')=='' || (is_array(get_pix_option('pix_category_hack')) && in_array('all', get_pix_option('pix_category_hack')))) {
							$pix_category_hack = $category_ids;
						} else {
							$pix_category_hack = get_pix_option('pix_category_hack');
						}
                        foreach ($categories as $category) { if (in_array($category->cat_ID, $pix_category_hack)) {  ?>
                <div id="category-tab-<?php echo $category->cat_ID; ?>">
                	<div class="block_separator">
                        <?php $pix_array_category = get_pix_option('pix_array_category_'.$category->cat_ID); ?>

                        <label for="pix_array_category_<?php echo $category->cat_ID; ?>_0" >Sliding page</label>
                        <select id="pix_array_category_<?php echo $category->cat_ID; ?>_0" name="pix_array_category_<?php echo $category->cat_ID; ?>[0]">
                            <option value="default"<?php if ($pix_array_category[0] == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="open"<?php if ($pix_array_category[0] == 'open') { echo ' selected="selected"'; } ?>>Open on load</option>
                            <option value="closed"<?php if ($pix_array_category[0] == 'closed') { echo ' selected="selected"'; } ?>>Closed on load</option>
                            <option value="always"<?php if ($pix_array_category[0] == 'always') { echo ' selected="selected"'; } ?>>Always open</option>
                        </select>

                        <label for="pix_array_category_<?php echo $category->cat_ID; ?>_1" >Show/hide sidebar and its position</label>
                        <select id="pix_array_category_<?php echo $category->cat_ID; ?>_1" name="pix_array_category_<?php echo $category->cat_ID; ?>[1]" class="toggler">
                            <option value="default"<?php if ($pix_array_category[1] == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="rightsidebar"<?php if ($pix_array_category[1] == 'rightsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the right</option>
                            <option value="leftsidebar"<?php if ($pix_array_category[1] == 'leftsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the left</option>
                            <option value="nosidebar"<?php if ($pix_array_category[1] == 'nosidebar') { echo ' selected="selected"'; } ?>>Hide sidebar</option>
                        </select>
                    
                        <div class="toggle pix_array_category_<?php echo $category->cat_ID; ?>_1" id="pix_array_category_<?php echo $category->cat_ID; ?>_1" data-type="nosidebar">
                            <label for="pix_array_category_<?php echo $category->cat_ID; ?>_2" >
                                Main column width and position
                            </label>
                            <select id="pix_array_category_<?php echo $category->cat_ID; ?>_2" name="pix_array_category_<?php echo $category->cat_ID; ?>[2]">
                                <option value="left"<?php if ($pix_array_category[2] == 'left') { echo ' selected="selected"'; } ?>>Narrow left column</option>
                                <option value="right"<?php if ($pix_array_category[2] == 'right') { echo ' selected="selected"'; } ?>>Narrow right column</option>
                                <option value="wide"<?php if ($pix_array_category[2] == 'wide') { echo ' selected="selected"'; } ?>>Wide column</option>
                            </select>
                        </div><!-- .toggle -->
                        
                        <label for="pix_array_category_<?php echo $category->cat_ID; ?>_3" >Select a sidebar</label>
						<?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") { ?>
                        <select id="pix_array_category_<?php echo $category->cat_ID; ?>_3" name="pix_array_category_<?php echo $category->cat_ID; ?>[3]">
                                <option value="none"<?php if ($pix_array_category[3] == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        <?php $i=1;
                        
                        foreach ($get_sidebar_options as $sidebar_gen) { ?>
                                <option value="<?php echo $sidebar_gen; ?>"<?php if ($pix_array_category[3] == $sidebar_gen) { echo ' selected="selected"'; } ?>><?php echo $sidebar_gen; ?></option>
                        <?php $i++;  
                        } ?>
                        </select>
                        <?php } else {
                            echo 'You still have no sidebars';
                        }
                        
                        ?>

                        <div class="clear"></div>

                    	<label for="pix_front_page_seo_title">
                        	Posts page title
                        </label>
                         <input name="pix_array_term_seotitle_<?php echo $category->cat_ID; ?>" id="pix_array_term_seotitle_<?php echo $category->cat_ID; ?>" class="pix_title_seo" type="text" value="<?php echo get_pix_option('pix_array_term_seotitle_'.$category->cat_ID); ?>" />
                         <p></p>
                         
                        <div class="clear"></div>

                    	<label for="pix_front_page_seo_description">
                        	Meta description
                        </label>
                         <textarea name="pix_array_term_seodescription_<?php echo $category->cat_ID; ?>" id="pix_array_term_seodescription_<?php echo $category->cat_ID; ?>" class="pix_desc_seo"><?php echo get_pix_option('pix_array_term_seodescription_'.$category->cat_ID); ?></textarea>
                         <p></p>

                        <div class="clear"></div>

                    	<label for="pix_front_page_seo_keywords">
                        	Meta keywords
                        </label>
                         <input name="pix_array_term_seokeywords_<?php echo $category->cat_ID; ?>" id="pix_array_term_seokeywords_<?php echo $category->cat_ID; ?>" type="text" value="<?php echo get_pix_option('pix_array_term_seokeywords_'.$category->cat_ID); ?>" />

                        <div class="clear"></div>

                    	<label for="pix_array_category_slide_<?php echo $category->cat_ID; ?>">Select the background of your category page</label>
                        <select id="pix_array_category_slide_<?php echo $category->cat_ID; ?>" name="pix_array_category_slide_<?php echo $category->cat_ID; ?>" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_array_category_slide_'. $category->cat_ID) == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="slideshow"<?php if (get_pix_option('pix_array_category_slide_'. $category->cat_ID) == 'slideshow') { echo ' selected="selected"'; } ?>>Slideshow</option>
                            <option value="single"<?php if (get_pix_option('pix_array_category_slide_'. $category->cat_ID) == 'single') { echo ' selected="selected"'; } ?>>Single image</option>
                            <option value="video"<?php if (get_pix_option('pix_array_category_slide_'. $category->cat_ID) == 'video') { echo ' selected="selected"'; } ?>>Video</option>
                            <option value="googlemap"<?php if (get_pix_option('pix_array_category_slide_'. $category->cat_ID) == 'googlemap') { echo ' selected="selected"'; } ?>>Google map</option>
                            <option value="none"<?php if (get_pix_option('pix_array_category_slide_'. $category->cat_ID) == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        </select>

                        <div class="toggle pix_array_category_slide_<?php echo $category->cat_ID; ?>" id="pix_array_category_slide_<?php echo $category->cat_ID; ?>" data-type="slideshow">
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            <div class="sorting_admin">
                            <br>
                            <a href="#" class="add" id="add_a_slider">&nbsp;</a>
                            <?php 
    
                                $i = 0;
                                $pix_array_category_slide = get_pix_option('pix_array_category_slide_'. $category->cat_ID.'_');
                                while($i<count($pix_array_category_slide)){
                                    if($pix_array_category_slide[$i]=='') { $style=' style="display:none"'; } else { $style=''; }
                                    echo '<div id="pix_array_category_slide_'. $category->cat_ID.'_'.$i.'" class="rm_upload_image">
                                    <div class="handle"></div>
                                    <div class="image_thumb"><img src="'.get_pix_thumb($pix_array_category_slide[$i], 'exTh').'" alt="Preview"'. $style .' /></div>
                                    <input name="pix_array_category_slide_'. $category->cat_ID.'_['.$i.']" type="text" value="'.$pix_array_category_slide[$i].'">
                                    <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                                    <a href="#" class="button-secondary remove">Remove</a></div>';
                                    $i++;
                                } 
                            ?>
                            </div><!-- .sorting -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_array_category_slide_<?php echo $category->cat_ID; ?>" id="pix_array_category_slide_<?php echo $category->cat_ID; ?>" data-type="single">
                        	<br>
                            
                            <div id="pix_array_category_single_<?php echo $category->cat_ID; ?>" class="rm_upload_image">
                                <?php if(get_pix_option('pix_array_category_single_'.$category->cat_ID)=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                                <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_array_category_single_'.$category->cat_ID), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                                <input name="pix_array_category_single_<?php echo $category->cat_ID; ?>" type="text" value="<?php echo get_pix_option('pix_array_category_single_'.$category->cat_ID); ?>">
                                <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                            </div><!-- .rm_upload_image -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_array_category_slide_<?php echo $category->cat_ID; ?>" id="pix_array_category_slide_<?php echo $category->cat_ID; ?>" data-type="video">
                            
                            <label for="pix_array_category_video_<?php echo $category->cat_ID; ?>">
                                Upload your video
                                <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadvideo.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            </label>
                            
                            <div class="rm_upload_video">
                                <input name="pix_array_category_video_<?php echo $category->cat_ID; ?>" type="text" value="<?php echo get_pix_option('pix_array_category_video_'.$category->cat_ID); ?>"><br>
                                <a class="button-secondary pix_upload_video_button" href="#">Upload Video</a>
                            </div><!-- .rm_upload_video -->

                            <label for="pix_array_category_video_start_<?php echo $category->cat_ID; ?>">
                                Auto start for your video
                            </label>
                        	<input type="hidden" value="0" name="pix_array_category_video_start_<?php echo $category->cat_ID; ?>">
                        	<input type="checkbox" value="true" name="pix_array_category_video_start_<?php echo $category->cat_ID; ?>"<?php if(get_pix_option('pix_array_category_video_start_'.$category->cat_ID)=="true") { ?> checked="checked"<?php } ?>>
                            
                            <div class="clear"></div>
                            
                            <label for="pix_array_category_video_loop_<?php echo $category->cat_ID; ?>">
                                Loop for your video
                            </label>
                        	<input type="hidden" value="0" name="pix_array_category_video_loop_<?php echo $category->cat_ID; ?>">
                        	<input type="checkbox" value="true" name="pix_array_category_video_loop_<?php echo $category->cat_ID; ?>"<?php if(get_pix_option('pix_array_category_video_loop_'.$category->cat_ID)=="true") { ?> checked="checked"<?php } ?>>
                            
                        </div><!-- .toggle -->


                        <div class="toggle pix_array_category_slide_<?php echo $category->cat_ID; ?>" id="pix_array_category_slide_<?php echo $category->cat_ID; ?>" data-type="googlemap">
                            <label for="pix_array_category_googlemap_<?php echo $category->cat_ID; ?>">
                                Coordinates <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" class="pix_tips_ajax topLeft"  data-rel="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" data-width="520">how can I get them?</a>)</small>
                            </label>
                            
                            <input name="pix_array_category_googlemap_<?php echo $category->cat_ID; ?>" type="text" value="<?php echo get_pix_option('pix_array_category_googlemap_'.$category->cat_ID); ?>">
    
    
                            <div class="slider_div googlemap">
                                <label for="pix_array_category_googlemap_zoom_<?php echo $category->cat_ID; ?>">Zoom</label>
                                <input type="text" id="pix_array_category_googlemap_zoom_<?php echo $category->cat_ID; ?>" name="pix_array_category_googlemap_zoom_<?php echo $category->cat_ID; ?>" class="slider_input" value="<?php echo get_pix_option('pix_array_category_googlemap_zoom_'.$category->cat_ID); ?>" />
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->
                            <div class="clear"></div>
    
                            <label for="pix_array_category_googlemap_indications_<?php echo $category->cat_ID; ?>">Indications</label>
                            <textarea name="pix_array_category_googlemap_indications_<?php echo $category->cat_ID; ?>" id="pix_array_category_googlemap_indications_<?php echo $category->cat_ID; ?>"><?php echo stripslashes(get_pix_option( 'pix_array_category_googlemap_indications_'.$category->cat_ID )); ?></textarea>
                             <div class="clear"></div>
                           
                            <label for="pix_array_category_googlemap_type_<?php echo $category->cat_ID; ?>">Type</label>
                            <select id="pix_array_category_googlemap_type_<?php echo $category->cat_ID; ?>" name="pix_array_category_googlemap_type_<?php echo $category->cat_ID; ?>">
                                <option value="HYBRID"<?php if (get_pix_option( 'pix_array_category_googlemap_type_'.$category->cat_ID ) == 'HYBRID') { echo ' selected="selected"'; } ?>>hybrid</option>
                                <option value="SATELLITE"<?php if (get_pix_option( 'pix_array_category_googlemap_type_'.$category->cat_ID ) == 'SATELLITE') { echo ' selected="selected"'; } ?>>satellite</option>
                                <option value="ROADMAP"<?php if (get_pix_option( 'pix_array_category_googlemap_type_'.$category->cat_ID ) == 'ROADMAP') { echo ' selected="selected"'; } ?>>road map</option>
                                <option value="TERRAIN"<?php if (get_pix_option( 'pix_array_category_googlemap_type_'.$category->cat_ID ) == 'TERRAIN') { echo ' selected="selected"'; } ?>>terrain</option>
                            </select>

                        </div><!-- .toggle -->

                        <label for="pix_array_category_<?php echo $category->cat_ID; ?>_4" >
                            Hide the featured images
                        </label>
                        <input type="hidden" value="0" name="pix_array_category_<?php echo $category->cat_ID; ?>[4]">
                        <input type="checkbox" value="true" name="pix_array_category_<?php echo $category->cat_ID; ?>[4]"<?php if($pix_array_category[4]=="true") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>
                        
                    </div><!-- .block_separator -->
                </div><!-- #category-tab-<?php echo $category->cat_ID; ?> -->
				<?php } } ?>

                <div id="searchpage-tab">
                	<div class="block_separator">

                        <label for="pix_searchpage_sliding_page" >Sliding page</label>
                        <select id="pix_searchpage_sliding_page" name="pix_searchpage_sliding_page">
                            <option value="default"<?php if (get_pix_option('pix_searchpage_sliding_page') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="open"<?php if (get_pix_option('pix_searchpage_sliding_page') == 'open') { echo ' selected="selected"'; } ?>>Open on load</option>
                            <option value="closed"<?php if (get_pix_option('pix_searchpage_sliding_page') == 'closed') { echo ' selected="selected"'; } ?>>Closed on load</option>
                            <option value="always"<?php if (get_pix_option('pix_searchpage_sliding_page') == 'always') { echo ' selected="selected"'; } ?>>Always open</option>
                        </select>

                        <label for="pix_searchpage_sidebar" >Show/hide sidebar and its position</label>
                        <select id="pix_searchpage_sidebar" name="pix_searchpage_sidebar" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_searchpage_sidebar') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="rightsidebar"<?php if (get_pix_option('pix_searchpage_sidebar') == 'rightsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the right</option>
                            <option value="leftsidebar"<?php if (get_pix_option('pix_searchpage_sidebar') == 'leftsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the left</option>
                            <option value="nosidebar"<?php if (get_pix_option('pix_searchpage_sidebar') == 'nosidebar') { echo ' selected="selected"'; } ?>>Hide sidebar</option>
                        </select>
                    
                        <div class="toggle pix_searchpage_sidebar" id="pix_searchpage_sidebar" data-type="nosidebar">
                            <label for="pix_searchpage_maincolumn" >
                                Main column width and position
                            </label>
                            <select id="pix_searchpage_maincolumn" name="pix_searchpage_maincolumn">
                                <option value="left"<?php if (get_pix_option('pix_searchpage_maincolumn') == 'left') { echo ' selected="selected"'; } ?>>Narrow left column</option>
                                <option value="right"<?php if (get_pix_option('pix_searchpage_maincolumn') == 'right') { echo ' selected="selected"'; } ?>>Narrow right column</option>
                                <option value="wide"<?php if (get_pix_option('pix_searchpage_maincolumn') == 'wide') { echo ' selected="selected"'; } ?>>Wide column</option>
                            </select>
                        </div><!-- .toggle -->
                        
                    	<label for="pix_searchpage_slide">Select the background of your search result page</label>
                        <select id="pix_searchpage_slide" name="pix_searchpage_slide" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_searchpage_slide') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="slideshow"<?php if (get_pix_option('pix_searchpage_slide') == 'slideshow') { echo ' selected="selected"'; } ?>>Slideshow</option>
                            <option value="single"<?php if (get_pix_option('pix_searchpage_slide') == 'single') { echo ' selected="selected"'; } ?>>Single image</option>
                            <option value="video"<?php if (get_pix_option('pix_searchpage_slide') == 'video') { echo ' selected="selected"'; } ?>>Video</option>
                            <option value="googlemap"<?php if (get_pix_option('pix_searchpage_slide') == 'googlemap') { echo ' selected="selected"'; } ?>>Google map</option>
                            <option value="none"<?php if (get_pix_option('pix_searchpage_slide') == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        </select>

                        <div class="toggle pix_searchpage_slide" id="pix_searchpage_slide" data-type="slideshow">
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            <div class="sorting_admin">
                            <br>
                            <a href="#" class="add" id="add_a_slider">&nbsp;</a>
                            <?php 
    
                                $i = 0;
                                $pix_searchpage_slide = get_pix_option('pix_array_searchpage_slide_');
                                while($i<count($pix_searchpage_slide)){
                                    if($pix_searchpage_slide[$i]=='') { $style=' style="display:none"'; } else { $style=''; }
                                    echo '<div id="pix_array_searchpage_slide_'.$i.'" class="rm_upload_image">
                                    <div class="handle"></div>
                                    <div class="image_thumb"><img src="'.get_pix_thumb($pix_searchpage_slide[$i], 'exTh').'" alt="Preview"'. $style .' /></div>
                                    <input name="pix_array_searchpage_slide_['.$i.']" type="text" value="'.$pix_searchpage_slide[$i].'">
                                    <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                                    <a href="#" class="button-secondary remove">Remove</a></div>';
                                    $i++;
                                } 
                            ?>
                            </div><!-- .sorting -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_searchpage_slide" id="pix_searchpage_slide" data-type="single">
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        	<br>
                            
                            <div id="pix_searchpage_single" class="rm_upload_image">
                                <?php if(get_pix_option('pix_searchpage_single')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                                <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_searchpage_single'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                                <input name="pix_searchpage_single" type="text" value="<?php echo get_pix_option('pix_searchpage_single'); ?>">
                                <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                            </div><!-- .rm_upload_image -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_searchpage_slide" id="pix_searchpage_slide" data-type="video">
                            <label for="pix_searchpage_video">
                                Upload your video
                                <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadvideo.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            </label>
                            
                            <div class="rm_upload_video">
                                <input name="pix_searchpage_video" type="text" value="<?php echo get_pix_option('pix_searchpage_video'); ?>"><br>
                                <a class="button-secondary pix_upload_video_button" href="#">Upload Video</a>
                            </div><!-- .rm_upload_image -->
                        </div><!-- .toggle -->


                        <div class="toggle pix_searchpage_slide" id="pix_searchpage_slide" data-type="video">
                            <label for="pix_searchpage_video_start">
                                Auto start for your video
                            </label>
                            <input type="hidden" value="0" name="pix_searchpage_video_start">                        
                            <input type="checkbox" value="true" name="pix_searchpage_video_start"<?php if(get_pix_option('pix_searchpage_video_start')=="true") { ?> checked="checked"<?php } ?>>
                        </div><!-- .toggle -->

                        <div class="toggle pix_searchpage_slide" id="pix_searchpage_slide" data-type="video">
                            <label for="pix_searchpage_video_loop">
                                Loop for your video
                            </label>
                            <input type="hidden" value="0" name="pix_searchpage_video_loop">                        
                            <input type="checkbox" value="true" name="pix_searchpage_video_loop"<?php if(get_pix_option('pix_searchpage_video_loop')=="true") { ?> checked="checked"<?php } ?>>
                        </div><!-- .toggle -->
                        
                        <div class="toggle pix_searchpage_slide" id="pix_searchpage_slide" data-type="googlemap">
                            <label for="pix_searchpage_googlemap">
                                Coordinates <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" class="pix_tips_ajax topLeft"  data-rel="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" data-width="520">how can I get them?</a>)</small>
                            </label>
                            
                            <input name="pix_searchpage_googlemap" type="text" value="<?php echo get_pix_option('pix_searchpage_googlemap'); ?>">
    
    
                            <div class="slider_div googlemap">
                                <label for="pix_searchpage_googlemap_zoom">Zoom</label>
                                <input type="text" id="pix_searchpage_googlemap_zoom" name="pix_searchpage_googlemap_zoom" class="slider_input" value="<?php echo get_pix_option('pix_searchpage_googlemap_zoom'); ?>" />
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->
                            <div class="clear"></div>
    
                            <label for="pix_searchpage_googlemap_indications">Indications</label>
                            <textarea name="pix_searchpage_googlemap_indications" id="pix_searchpage_googlemap_indications"><?php echo stripslashes(get_pix_option( 'pix_searchpage_googlemap_indications' )); ?></textarea>
                            <div class="clear"></div>
    
                            <label for="pix_searchpage_googlemap_type">Type</label>
                            <select id="pix_searchpage_googlemap_type" name="pix_searchpage_googlemap_type">
                                <option value="HYBRID"<?php if (get_pix_option('pix_searchpage_googlemap_type') == 'HYBRID') { echo ' selected="selected"'; } ?>>hybrid</option>
                                <option value="SATELLITE"<?php if (get_pix_option('pix_searchpage_googlemap_type') == 'SATELLITE') { echo ' selected="selected"'; } ?>>satellite</option>
                                <option value="ROADMAP"<?php if (get_pix_option('pix_searchpage_googlemap_type') == 'ROADMAP') { echo ' selected="selected"'; } ?>>road map</option>
                                <option value="TERRAIN"<?php if (get_pix_option('pix_searchpage_googlemap_type') == 'TERRAIN') { echo ' selected="selected"'; } ?>>terrain</option>
                            </select>

                        </div><!-- .toggle -->

                    </div><!-- .block_separator -->
                </div><!-- #searchpage-tab -->
                
                <div id="404-tab">
                	<div class="block_separator">

                        <label for="pix_404_sliding_page" >Sliding page</label>
                        <select id="pix_404_sliding_page" name="pix_404_sliding_page">
                            <option value="default"<?php if (get_pix_option('pix_404_sliding_page') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="open"<?php if (get_pix_option('pix_404_sliding_page') == 'open') { echo ' selected="selected"'; } ?>>Open on load</option>
                            <option value="closed"<?php if (get_pix_option('pix_404_sliding_page') == 'closed') { echo ' selected="selected"'; } ?>>Closed on load</option>
                            <option value="always"<?php if (get_pix_option('pix_404_sliding_page') == 'always') { echo ' selected="selected"'; } ?>>Always open</option>
                        </select>

                        <label for="pix_404_sidebar" >Show/hide sidebar and its position</label>
                        <select id="pix_404_sidebar" name="pix_404_sidebar" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_404_sidebar') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="rightsidebar"<?php if (get_pix_option('pix_404_sidebar') == 'rightsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the right</option>
                            <option value="leftsidebar"<?php if (get_pix_option('pix_404_sidebar') == 'leftsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the left</option>
                            <option value="nosidebar"<?php if (get_pix_option('pix_404_sidebar') == 'nosidebar') { echo ' selected="selected"'; } ?>>Hide sidebar</option>
                        </select>
                    
                        <div class="toggle pix_404_sidebar" id="pix_404_sidebar" data-type="nosidebar">
                            <label for="pix_404_maincolumn" >
                                Main column width and position
                            </label>
                            <select id="pix_404_maincolumn" name="pix_404_maincolumn">
                                <option value="left"<?php if (get_pix_option('pix_404_maincolumn') == 'left') { echo ' selected="selected"'; } ?>>Narrow left column</option>
                                <option value="right"<?php if (get_pix_option('pix_404_maincolumn') == 'right') { echo ' selected="selected"'; } ?>>Narrow right column</option>
                                <option value="wide"<?php if (get_pix_option('pix_404_maincolumn') == 'wide') { echo ' selected="selected"'; } ?>>Wide column</option>
                            </select>
                        </div><!-- .toggle -->
                        
                    	<label for="pix_404_slide">Select the background of your 404 page</label>
                        <select id="pix_404_slide" name="pix_404_slide" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_404_slide') == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="slideshow"<?php if (get_pix_option('pix_404_slide') == 'slideshow') { echo ' selected="selected"'; } ?>>Slideshow</option>
                            <option value="single"<?php if (get_pix_option('pix_404_slide') == 'single') { echo ' selected="selected"'; } ?>>Single image</option>
                            <option value="video"<?php if (get_pix_option('pix_404_slide') == 'video') { echo ' selected="selected"'; } ?>>Video</option>
                            <option value="googlemap"<?php if (get_pix_option('pix_404_slide') == 'googlemap') { echo ' selected="selected"'; } ?>>Google map</option>
                            <option value="none"<?php if (get_pix_option('pix_404_slide') == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        </select>

                        <div class="toggle pix_404_slide" id="pix_404_slide" data-type="slideshow">
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            <div class="sorting_admin">
                            <br>
                            <a href="#" class="add" id="add_a_slider">&nbsp;</a>
                            <?php 
    
                                $i = 0;
                                $pix_404_slide = get_pix_option('pix_array_404_slide_');
                                while($i<count($pix_404_slide)){
                                    if($pix_404_slide[$i]=='') { $style=' style="display:none"'; } else { $style=''; }
                                    echo '<div id="pix_array_404_slide_'.$i.'" class="rm_upload_image">
                                    <div class="handle"></div>
                                    <div class="image_thumb"><img src="'.get_pix_thumb($pix_404_slide[$i], 'exTh').'" alt="Preview"'. $style .' /></div>
                                    <input name="pix_array_404_slide_['.$i.']" type="text" value="'.$pix_404_slide[$i].'">
                                    <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                                    <a href="#" class="button-secondary remove">Remove</a></div>';
                                    $i++;
                                } 
                            ?>
                            </div><!-- .sorting -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_404_slide" id="pix_404_slide" data-type="single">
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        	<br>
                            
                            <div id="pix_404_single" class="rm_upload_image">
                                <?php if(get_pix_option('pix_404_single')=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                                <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_404_single'), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                                <input name="pix_404_single" type="text" value="<?php echo get_pix_option('pix_404_single'); ?>">
                                <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                            </div><!-- .rm_upload_image -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_404_slide" id="pix_404_slide" data-type="video">
                            <label for="pix_404_video">
                                Upload your video
                                <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            </label>
                            
                            <div class="rm_upload_video">
                                <input name="pix_404_video" type="text" value="<?php echo get_pix_option('pix_404_video'); ?>"><br>
                                <a class="button-secondary pix_upload_video_button" href="#">Upload Video</a>
                            </div><!-- .rm_upload_image -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_404_slide" id="pix_404_slide" data-type="video">
                            <label for="pix_404_video_start">
                                Auto start for your video
                            </label>
                            <input type="hidden" value="0" name="pix_404_video_start">                        
                            <input type="checkbox" value="true" name="pix_404_video_start"<?php if(get_pix_option('pix_404_video_start')=="true") { ?> checked="checked"<?php } ?>>
                        </div><!-- .toggle -->

                        <div class="toggle pix_404_slide" id="pix_404_slide" data-type="video">
                            <label for="pix_404_video_loop">
                                Loop for your video
                            </label>
                            <input type="hidden" value="0" name="pix_404_video_loop">                        
                            <input type="checkbox" value="true" name="pix_404_video_loop"<?php if(get_pix_option('pix_404_video_loop')=="true") { ?> checked="checked"<?php } ?>>
                        </div><!-- .toggle -->
                        
                        <div class="toggle pix_404_slide" id="pix_404_slide" data-type="googlemap">
                            <label for="pix_404_googlemap">
                                Coordinates <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" class="pix_tips_ajax topLeft"  data-rel="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" data-width="520">how can I get them?</a>)</small>
                            </label>
                            
                            <input name="pix_404_googlemap" type="text" value="<?php echo get_pix_option('pix_404_googlemap'); ?>">
    
    
                            <div class="slider_div googlemap">
                                <label for="pix_404_googlemap_zoom">Zoom</label>
                                <input type="text" id="pix_404_googlemap_zoom" name="pix_404_googlemap_zoom" class="slider_input" value="<?php echo get_pix_option('pix_404_googlemap_zoom'); ?>" />
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->
                            <div class="clear"></div>
    
                            <label for="pix_404_googlemap_indications">Indications</label>
                            <textarea name="pix_404_googlemap_indications" id="pix_404_googlemap_indications"><?php echo stripslashes(get_pix_option( 'pix_404_googlemap_indications' )); ?></textarea>
                            
                            <div class="clear"></div>
                            <label for="pix_404_googlemap_type">Type</label>
                            <select id="pix_404_googlemap_type" name="pix_404_googlemap_type">
                                <option value="HYBRID"<?php if (get_pix_option('pix_404_googlemap_type') == 'HYBRID') { echo ' selected="selected"'; } ?>>hybrid</option>
                                <option value="SATELLITE"<?php if (get_pix_option('pix_404_googlemap_type') == 'SATELLITE') { echo ' selected="selected"'; } ?>>satellite</option>
                                <option value="ROADMAP"<?php if (get_pix_option('pix_404_googlemap_type') == 'ROADMAP') { echo ' selected="selected"'; } ?>>road map</option>
                                <option value="TERRAIN"<?php if (get_pix_option('pix_404_googlemap_type') == 'TERRAIN') { echo ' selected="selected"'; } ?>>terrain</option>
                            </select>
                        </div><!-- .toggle -->

                    </div><!-- .block_separator -->
                </div><!-- #404-tab -->
                
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>
            </div><!-- #blog-tab -->
            
            <div id="portfolio-main-tab">
                <ul>
                    <li><a href="#portfolio-items-tab">Portfolio items</a></li>
                    <?php $terms = get_terms('gallery');
						$terms_slug = array();
						foreach ($terms as $term) { 
							array_push($terms_slug, $term->slug);
						}
						if(get_pix_option('pix_gallery_hack')=='all' || get_pix_option('pix_gallery_hack')=='' || (is_array(get_pix_option('pix_gallery_hack')) && in_array('all', get_pix_option('pix_gallery_hack')))) {
							$pix_gallery_hack = $terms_slug;
						} else {
							$pix_gallery_hack = get_pix_option('pix_gallery_hack');
						}
                        foreach ($terms as $term) { if (in_array($term->slug, $pix_gallery_hack)) {  ?>
                        <li><a href="#term-tab-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
                    <?php } } ?>
                </ul>
                <form method="post">
                <div id="portfolio-items-tab">
                	<div class="block_separator">
                        <label for="pix_show_custom_related_items">Show related items below the posts</label>
                        <input type="hidden" value="0" name="pix_show_custom_related_items">
                        <input type="checkbox" value="show" name="pix_show_custom_related_items"<?php if(get_pix_option('pix_show_custom_related_items')=="show") { ?> checked="checked"<?php } ?>>

                        <div class="clear"></div>

                        <label for="pix_portfolio_show_share_section">Show share section in portfolio posts</label>
                        <input type="hidden" value="0" name="pix_portfolio_show_share_section">
                        <input type="checkbox" value="show" name="pix_portfolio_show_share_section"<?php if(get_pix_option('pix_portfolio_show_share_section')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>

                        <label for="pix_portfolio_share_type" >Share section type</label>
                        <select id="pix_portfolio_share_type" name="pix_portfolio_share_type">
                            <option value="classic"<?php if (get_pix_option('pix_portfolio_share_type') == 'classic') { echo ' selected="selected"'; } ?>>Simple icons</option>
                            <option value="counter"<?php if (get_pix_option('pix_portfolio_share_type') == 'counter') { echo ' selected="selected"'; } ?>>Official icons with counter</option>
                        </select>
                        <small>"Simple icons": Twitter, Facebook, Delicious, Digg, LinkedIn, StumbleUpon<br>
                        "Official icons with counter": Twitter, Facebook, Google+</small> 
                        <div class="clear"></div>

                        <label for="pix_portfolio_credits_section">Show credits section in portfolio posts</label>
                        <input type="hidden" value="0" name="pix_portfolio_credits_section">
                        <input type="checkbox" value="show" name="pix_portfolio_credits_section"<?php if(get_pix_option('pix_portfolio_credits_section')=="show") { ?> checked="checked"<?php } ?>>
                        <div class="clear"></div>

                    </div><!-- .block-separator -->
                </div><!-- #portfolio-items-tab -->
                
				<?php
					foreach ($terms as $term) { if (in_array($term->slug, $pix_gallery_hack)) {  ?>
                <div id="term-tab-<?php echo $term->term_id; ?>">
                	<div class="block_separator">
                        <?php $pix_array_term = get_pix_option('pix_array_term_'.$term->term_id); ?>

                        <label for="pix_array_term_<?php echo $term->term_id; ?>_4" >Template</label>
                        <select class="toggler" name="pix_array_term_<?php echo $term->term_id; ?>[4]" id="pix_array_term_<?php echo $term->term_id; ?>_4">
                            <option value="onecolumn"<?php if ($pix_array_term[4] == 'onecolumn') { echo ' selected="selected"'; } ?>>One column</option>
                            <option value="twocolumns"<?php if ($pix_array_term[4] == 'twocolumns') { echo ' selected="selected"'; } ?>>Two columns</option>
                            <option value="threecolumns"<?php if ($pix_array_term[4] == 'threecolumns') { echo ' selected="selected"'; } ?>>Three columns</option>
                            <option value="fourcolumns"<?php if ($pix_array_term[4] == 'fourcolumns') { echo ' selected="selected"'; } ?>>Four columns</option>
                            <option value="fivecolumns"<?php if ($pix_array_term[4] == 'fivecolumns') { echo ' selected="selected"'; } ?>>Five columns</option>
                            <option value="widepage"<?php if ($pix_array_term[4] == 'widepage') { echo ' selected="selected"'; } ?>>Wide page</option>
                        </select>

                        <div class="toggle pix_array_term_<?php echo $term->term_id; ?>_4" data-type="onecolumn twocolumns threecolumns fourcolumns fivecolumns">
                            <div class="check_toggle" id="sliding_term_toggle">
                                <label for="pix_array_term_<?php echo $term->term_id; ?>_0" >Sliding page</label>
                                <select id="pix_array_term_<?php echo $term->term_id; ?>_0" name="pix_array_term_<?php echo $term->term_id; ?>[0]">
                                    <option value="default"<?php if ($pix_array_term[0] == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                                    <option value="open"<?php if ($pix_array_term[0] == 'open') { echo ' selected="selected"'; } ?>>Open on load</option>
                                    <option value="closed"<?php if ($pix_array_term[0] == 'closed') { echo ' selected="selected"'; } ?>>Closed on load</option>
                                <option value="always"<?php if ($pix_array_term[0] == 'always') { echo ' selected="selected"'; } ?>>Always open</option>
                                </select>
                            </div>
    
                            <label for="pix_array_term_<?php echo $term->term_id; ?>_1" >Show/hide sidebar and its position</label>
                            <select id="pix_array_term_<?php echo $term->term_id; ?>_1" name="pix_array_term_<?php echo $term->term_id; ?>[1]" class="toggler">
                                <option value="default"<?php if ($pix_array_term[1] == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                                <option value="rightsidebar"<?php if ($pix_array_term[1] == 'rightsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the right</option>
                                <option value="leftsidebar"<?php if ($pix_array_term[1] == 'leftsidebar') { echo ' selected="selected"'; } ?>>Sidebar on the left</option>
                                <option value="nosidebar"<?php if ($pix_array_term[1] == 'nosidebar') { echo ' selected="selected"'; } ?>>Hide sidebar</option>
                            </select>
                        
                            <div class="toggle pix_array_term_<?php echo $term->term_id; ?>_1" id="pix_array_term_<?php echo $term->term_id; ?>_1" data-type="nosidebar">
                                <label for="pix_array_term_<?php echo $term->term_id; ?>_2" >
                                    Main column width and position
                                </label>
                                <select id="pix_array_term_<?php echo $term->term_id; ?>_2" name="pix_array_term_<?php echo $term->term_id; ?>[2]">
                                    <option value="left"<?php if ($pix_array_term[2] == 'left') { echo ' selected="selected"'; } ?>>Narrow left column</option>
                                    <option value="right"<?php if ($pix_array_term[2] == 'right') { echo ' selected="selected"'; } ?>>Narrow right column</option>
                                    <option value="wide"<?php if ($pix_array_term[2] == 'wide') { echo ' selected="selected"'; } ?>>Wide column</option>
                                </select>
                            </div><!-- .toggle -->
                            
                            <label for="pix_array_term_<?php echo $term->term_id; ?>_3" >Select a sidebar</label>
                            <?php
                            $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                            if($get_sidebar_options != "") { ?>
                            <select id="pix_array_term_<?php echo $term->term_id; ?>_3" name="pix_array_term_<?php echo $term->term_id; ?>[3]">
                                    <option value="none"<?php if ($pix_array_term[3] == 'none') { echo ' selected="selected"'; } ?>>None</option>
                            <?php $i=1;
                            
                            foreach ($get_sidebar_options as $sidebar_gen) { ?>
                                    <option value="<?php echo $sidebar_gen; ?>"<?php if ($pix_array_term[3] == $sidebar_gen) { echo ' selected="selected"'; } ?>><?php echo $sidebar_gen; ?></option>
                            <?php $i++;  
                            } ?>
                            </select>
                            <?php } else {
                                echo 'You still have no sidebars';
                            }
                            
                            ?>
                        </div><!-- .toggle -->
    
                        <label for="pix_array_term_<?php echo $term->term_id; ?>[5]">Filterable portfolio page</label>
                        <input type="hidden" value="0" name="pix_array_term_<?php echo $term->term_id; ?>_5">
                        <input type="checkbox" data-target="sliding_term_toggle" class="check_toggler" value="show" name="pix_array_term_<?php echo $term->term_id; ?>[5]"<?php if($pix_array_term[5]=="show") { ?> checked="checked"<?php } ?>>

                        <div class="clear"></div>

                        <label for="pix_array_term_<?php echo $term->term_id; ?>[6]">Infinite scrolling page</label>
                        <input type="hidden" value="0" name="pix_array_term_<?php echo $term->term_id; ?>[6]">
                        <input type="checkbox" data-target="sliding_term_toggle" class="check_toggler" value="show" name="pix_array_term_<?php echo $term->term_id; ?>[6]"<?php if($pix_array_term[6]=="show") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>

                        <label for="pix_array_term_<?php echo $term->term_id; ?>[7]">Show &quot;Open in a ColorBox&quot; link</label>
                        <input type="hidden" value="0" name="pix_array_term_<?php echo $term->term_id; ?>[7]">
                        <input type="checkbox" value="show" name="pix_array_term_<?php echo $term->term_id; ?>[7]"<?php if($pix_array_term[7]=="show") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>

                        <label for="pix_array_term_<?php echo $term->term_id; ?>[9]">Have a slideshow in the ColorBox</label>
                        <input type="hidden" value="0" name="pix_array_term_<?php echo $term->term_id; ?>[9]">
                        <input type="checkbox" value="show" name="pix_array_term_<?php echo $term->term_id; ?>[9]"<?php if($pix_array_term[9]=="show") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>

                        <label for="pix_array_term_<?php echo $term->term_id; ?>[8]">Show &quot;Go to the page&quot; link</label>
                        <input type="hidden" value="0" name="pix_array_term_<?php echo $term->term_id; ?>[8]">
                        <input type="checkbox" value="show" name="pix_array_term_<?php echo $term->term_id; ?>[8]"<?php if($pix_array_term[8]=="show") { ?> checked="checked"<?php } ?>>
                        
                        <div class="clear"></div>

                        <div class="slider_div border">
                            <label for="pix_array_term_ppp_<?php echo $term->term_id; ?>">How many posts per page</label>
                            <input type="text" id="pix_array_term_ppp_<?php echo $term->term_id; ?>" name="pix_array_term_ppp_<?php echo $term->term_id; ?>" class="slider_input" value="<?php if (get_pix_option('pix_array_term_ppp_'. $term->term_id) == '') { echo '9'; } else { echo get_pix_option('pix_array_term_ppp_'.$term->term_id); } ?>" />
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->

                        <div class="clear"></div>
    
                    	<label for="pix_array_term_tooltip_<?php echo $term->term_id; ?>">Tooltip on image</label>
                        <select id="pix_array_term_tooltip_<?php echo $term->term_id; ?>" name="pix_array_term_tooltip_<?php echo $term->term_id; ?>">
                            <option value="title"<?php if (get_pix_option('pix_array_term_tooltip_'. $term->term_id) == 'title') { echo ' selected="selected"'; } ?>>Show title</option>
                            <option value="titleexcerpt"<?php if (get_pix_option('pix_array_term_tooltip_'. $term->term_id) == 'titleexcerpt') { echo ' selected="selected"'; } ?>>Show title and excerpt</option>
                            <option value="titleaction"<?php if (get_pix_option('pix_array_term_tooltip_'. $term->term_id) == 'titleaction') { echo ' selected="selected"'; } ?>>Show title and action</option>
                            <option value="titleexcerptaction"<?php if (get_pix_option('pix_array_term_tooltip_'. $term->term_id) == 'titleexcerptaction') { echo ' selected="selected"'; } ?>>Show title, excerpt and action</option>
                            <option value="action"<?php if (get_pix_option('pix_array_term_tooltip_'. $term->term_id) == 'action') { echo ' selected="selected"'; } ?>>Show action</option>
                            <option value="hide"<?php if (get_pix_option('pix_array_term_tooltip_'. $term->term_id) == 'hide') { echo ' selected="selected"'; } ?>>Hide tooltip</option>
                        </select>

                        <div class="clear"></div>

                    	<label for="pix_front_page_seo_title">
                        	Posts page title
                        </label>
                         <input name="pix_array_term_seotitle_<?php echo $term->term_id; ?>" id="pix_array_term_seotitle_<?php echo $term->term_id; ?>" class="pix_title_seo" type="text" value="<?php echo get_pix_option('pix_array_term_seotitle_'.$term->term_id); ?>" />
                         <p></p>
                         
                        <div class="clear"></div>

                    	<label for="pix_front_page_seo_description">
                        	Meta description
                        </label>
                         <textarea name="pix_array_term_seodescription_<?php echo $term->term_id; ?>" id="pix_array_term_seodescription_<?php echo $term->term_id; ?>" class="pix_desc_seo"><?php echo get_pix_option('pix_array_term_seodescription_'.$term->term_id); ?></textarea>
                         <p></p>

                        <div class="clear"></div>

                    	<label for="pix_front_page_seo_keywords">
                        	Meta keywords
                        </label>
                         <input name="pix_array_term_seokeywords_<?php echo $term->term_id; ?>" id="pix_array_term_seokeywords_<?php echo $term->term_id; ?>" type="text" value="<?php echo get_pix_option('pix_array_term_seokeywords_'.$term->term_id); ?>" />
                        <div class="clear"></div>

                    	<label for="pix_array_term_slide_<?php echo $term->term_id; ?>">Select the background of your portofolio page</label>
                        <select id="pix_array_term_slide_<?php echo $term->term_id; ?>" name="pix_array_term_slide_<?php echo $term->term_id; ?>" class="toggler">
                            <option value="default"<?php if (get_pix_option('pix_array_term_slide_'. $term->term_id) == 'default') { echo ' selected="selected"'; } ?>>Default</option>
                            <option value="slideshow"<?php if (get_pix_option('pix_array_term_slide_'. $term->term_id) == 'slideshow') { echo ' selected="selected"'; } ?>>Slideshow</option>
                            <option value="single"<?php if (get_pix_option('pix_array_term_slide_'. $term->term_id) == 'single') { echo ' selected="selected"'; } ?>>Single image</option>
                            <option value="video"<?php if (get_pix_option('pix_array_term_slide_'. $term->term_id) == 'video') { echo ' selected="selected"'; } ?>>Video</option>
                            <option value="googlemap"<?php if (get_pix_option('pix_array_term_slide_'. $term->term_id) == 'googlemap') { echo ' selected="selected"'; } ?>>Google map</option>
                            <option value="none"<?php if (get_pix_option('pix_array_term_slide_'. $term->term_id) == 'none') { echo ' selected="selected"'; } ?>>None</option>
                        </select>

                        <div class="toggle pix_array_term_slide_<?php echo $term->term_id; ?>" id="pix_array_term_slide_<?php echo $term->term_id; ?>" data-type="slideshow">
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            <div class="sorting_admin">
                            <br>
                            <a href="#" class="add" id="add_a_slider">&nbsp;</a>
                            <?php 
    
                                $i = 0;
                                $pix_array_term_slide = get_pix_option('pix_array_term_slide_'. $term->term_id.'_');
                                while($i<count($pix_array_term_slide)){
                                    if($pix_array_term_slide[$i]=='') { $style=' style="display:none"'; } else { $style=''; }
                                    echo '<div id="pix_array_term_slide_'. $term->term_id.'_'.$i.'" class="rm_upload_image">
                                    <div class="handle"></div>
                                    <div class="image_thumb"><img src="'.get_pix_thumb($pix_array_term_slide[$i], 'exTh').'" alt="Preview"'. $style .' /></div>
                                    <input name="pix_array_term_slide_'. $term->term_id.'_['.$i.']" type="text" value="'.$pix_array_term_slide[$i].'">
                                    <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                                    <a href="#" class="button-secondary remove">Remove</a></div>';
                                    $i++;
                                } 
                            ?>
                            </div><!-- .sorting -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_array_term_slide_<?php echo $term->term_id; ?>" id="pix_array_term_slide_<?php echo $term->term_id; ?>" data-type="single">
                            <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadimage.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                        	<br>
                            
                            <div id="pix_array_term_single_<?php echo $term->term_id; ?>" class="rm_upload_image">
                                <?php if(get_pix_option('pix_array_term_single_'.$term->term_id)=='') { $style=' style="display:none"'; } else { $style=''; } ?>
                                <div class="image_thumb"><img src="<?php echo get_pix_thumb(get_pix_option('pix_array_term_single_'.$term->term_id), 'exTh'); ?>" alt="Preview"<?php echo $style; ?> /></div>
                                <input name="pix_array_term_single_<?php echo $term->term_id; ?>" type="text" value="<?php echo get_pix_option('pix_array_term_single_'.$term->term_id); ?>">
                                <a class="button-secondary pix_upload_image_button" href="#">Upload Image</a>
                            </div><!-- .rm_upload_image -->
                        </div><!-- .toggle -->

                        <div class="toggle pix_array_term_slide_<?php echo $term->term_id; ?>" id="pix_array_term_slide_<?php echo $term->term_id; ?>" data-type="video">
                            
                            <label for="pix_array_term_video_<?php echo $term->term_id; ?>">
                                Upload your video
                                <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/uploadvideo.php?TB_iframe=true&width=600&height=550" class="info thickbox">how to</a>)</small>
                            </label>
                            
                            <div class="rm_upload_video">
                                <input name="pix_array_term_video_<?php echo $term->term_id; ?>" type="text" value="<?php echo get_pix_option('pix_array_term_video_'.$term->term_id); ?>"><br>
                                <a class="button-secondary pix_upload_video_button" href="#">Upload Video</a>
                            </div><!-- .rm_upload_video -->

                            <label for="pix_array_term_video_start_<?php echo $term->term_id; ?>">
                                Auto start for your video
                            </label>
                            <input type="hidden" value="0" name="pix_array_term_video_start_<?php echo $term->term_id; ?>">
                        	<input type="checkbox" value="true" name="pix_array_term_video_start_<?php echo $term->term_id; ?>"<?php if(get_pix_option('pix_array_term_video_start_'.$term->term_id)=="true") { ?> checked="checked"<?php } ?>>
                            
                        <div class="clear"></div>

                            <label for="pix_array_term_video_loop_<?php echo $term->term_id; ?>">
                                Loop for your video
                            </label>
                            <input type="hidden" value="0" name="pix_array_term_video_loop_<?php echo $term->term_id; ?>">
                        	<input type="checkbox" value="true" name="pix_array_term_video_loop_<?php echo $term->term_id; ?>"<?php if(get_pix_option('pix_array_term_video_loop_'.$term->term_id)=="true") { ?> checked="checked"<?php } ?>>
                            
                        </div><!-- .toggle -->


                        <div class="toggle pix_array_term_slide_<?php echo $term->term_id; ?>" id="pix_array_term_slide_<?php echo $term->term_id; ?>" data-type="googlemap">
                            <label for="pix_array_term_googlemap_<?php echo $term->term_id; ?>">
                                Coordinates <small>(<a href="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" class="pix_tips_ajax topLeft"  data-rel="<?php echo get_template_directory_uri(); ?>/functions/documentation/googlemap-coords.php" data-width="520">how can I get them?</a>)</small>
                            </label>
                            
                            <input name="pix_array_term_googlemap_<?php echo $term->term_id; ?>" type="text" value="<?php echo get_pix_option('pix_array_term_googlemap_'.$term->term_id); ?>">
    
    
                            <div class="slider_div googlemap">
                                <label for="pix_array_term_googlemap_zoom_<?php echo $term->term_id; ?>">Zoom</label>
                                <input type="text" id="pix_array_term_googlemap_zoom_<?php echo $term->term_id; ?>" name="pix_array_term_googlemap_zoom_<?php echo $term->term_id; ?>" class="slider_input" value="<?php echo get_pix_option('pix_array_term_googlemap_zoom_'.$term->term_id); ?>" />
                                <div class="slider_cursor"></div>
                            </div><!-- .slider_div -->
                            <div class="clear"></div>
    
                            <label for="pix_array_term_googlemap_indications_<?php echo $term->term_id; ?>">Indications</label>
                            <textarea name="pix_array_term_googlemap_indications_<?php echo $term->term_id; ?>" id="pix_array_term_googlemap_indications_<?php echo $term->term_id; ?>"><?php echo stripslashes(get_pix_option( 'pix_array_term_googlemap_indications_'.$term->term_id )); ?></textarea>
                            
                            <div class="clear"></div>
                            <label for="pix_array_term_googlemap_type_<?php echo $term->term_id; ?>">Type</label>
                            <select id="pix_array_term_googlemap_type_<?php echo $term->term_id; ?>" name="pix_array_term_googlemap_type_<?php echo $term->term_id; ?>">
                                <option value="HYBRID"<?php if (get_pix_option('pix_array_term_googlemap_type_'.$term->term_id) == 'HYBRID') { echo ' selected="selected"'; } ?>>hybrid</option>
                                <option value="SATELLITE"<?php if (get_pix_option('pix_array_term_googlemap_type_'.$term->term_id) == 'SATELLITE') { echo ' selected="selected"'; } ?>>satellite</option>
                                <option value="ROADMAP"<?php if (get_pix_option('pix_array_term_googlemap_type_'.$term->term_id) == 'ROADMAP') { echo ' selected="selected"'; } ?>>road map</option>
                                <option value="TERRAIN"<?php if (get_pix_option('pix_array_term_googlemap_type_'.$term->term_id) == 'TERRAIN') { echo ' selected="selected"'; } ?>>terrain</option>
                            </select>
                        </div><!-- .toggle -->

                    </div><!-- .block_separator -->
                </div><!-- #term-tab-<?php echo $term->term_id; ?> -->
				<?php } } ?>
                
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>
            </div><!-- #portfolio-main-tab -->

            <div id="translation-tab">
            	<ul>
                	<li>
                    	<a href="#download-poedit-tab">Poedit</a>
                    </li>
                	<li>
                    	<a href="#open-po-tab">Open .po file</a>
                    </li>
                	<li>
                    	<a href="#translate-strings">Translate</a>
                    </li>
                	<li>
                    	<a href="#save-po">Save and use</a>
                    </li>
                </ul>
                <form method="post">
                <div id="download-poedit-tab">
                	<div class="block_separator">
                        <p>First of all download and install Poedit (of course I recommend making a donation to the developer): go to <a href="http://www.poedit.net/download.php" title="Go to Poedit" target="_blank" class="toleft">http://www.poedit.net/download.php</a></p>
                        <p>
                        	<img src="<?php echo get_template_directory_uri(); ?>/functions/documentation/images/poedit-screenshot.jpg">
                        </p>
                    </div><!-- .block_separator -->
                </div><!-- #download-poedit-tab -->

                <div id="open-po-tab">
                	<div class="block_separator">
                        <p>Launch Poedit and open &quot;delight.po&quot; (you'll find it in: delight / languages)</p>
                        <p>
                        	<img src="<?php echo get_template_directory_uri(); ?>/functions/documentation/images/open-poedit.jpg">
                        </p>
                    </div><!-- .block_separator -->
                </div><!-- #open-po-tab -->

                <div id="translate-strings">
                	<div class="block_separator">
                        <p>Now you must select all the original strings and type, in the field below each of them, your translation. See the image below:</p>
                        <p>
                        	<img src="<?php echo get_template_directory_uri(); ?>/functions/documentation/images/translate-poedit.jpg">
                        </p>
                    </div><!-- .block_separator -->
                </div><!-- #translate-strings -->
                
                <div id="save-po">
                	<div class="block_separator">
                        <p>Once you translated all the strings, you must save the file, according to the language you used for your Wordpress installation. If you are using the italian, you must save the file as &quot;it_IT.po&quot;, if you are using the german you must save the file as &quot;de_DE&quot; and so on...</p>
                        <p><strong>Remember:</strong> open your file wp-config.php and copy the value for WPLANG:</p>
                        <p>
                        	<img src="<?php echo get_template_directory_uri(); ?>/functions/documentation/images/define_wplang.jpg">
                        </p>
                        <p>
                        	Save the file in the same &quot;languages&quot; folder where you found &quot;delight.po&quot;, with the value of WPLANG and .po extension. So, in this case, you must save the file as: &quot;it_IT.po&quot;.
                        </p>
                        <p>
                        	A file with .mo extension will be generated automatically. Upload to the server both files, .po and .mo. That's all.
                        </p>
                        <p>
                        	<strong>N.B.:</strong> I recommend you repeating the procedure after every update of Delight because the original localization file can change each time (always check the changelog).
                        </p>
                    </div><!-- .block_separator -->
                </div><!-- #save-po -->
                </form>
            </div><!-- #translation-tab -->

            <div id="styles-tab">
                <ul>
                    
                </ul>
                <form method="post">
                <div>
                    <div class="block_separator">
                        <label for="pix_custom_style">Type your rules</label>
                        <textarea name="pix_custom_style" id="pix_custom_style" class="pix_editor"><?php echo stripslashes(get_pix_option( 'pix_custom_style')  ); ?></textarea>
                    </div><!-- .block_separator -->
                </div>
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>
            </div><!-- #styles-tab -->

            <div id="help-tab">
            	<ul>
                	<li>
                    	<a href="#blog-help-tab">Blog</a>
                    </li>
                	<li>
                    	<a href="#portfolio-help-tab">Portfolio</a>
                    </li>
                </ul>
                <form method="post">
                <div id="blog-help-tab">
                    <div class="block_separator">
                        <label for="pix_category_hack">How many categories do you need to set</label>
                        <small>Keep &quot;ctrl&quot; button on PC or &quot;cmd&quot; button on MAC for multiple selections<br><br>
                        If you can't save anything in Delight -> Blog, maybe it's because you created many categories and when you click the "Save" button too much data are sent to the database. Here you can try to include some categories only and see if this fix the problem</small>
                        <select id="pix_category_hack" multiple size="10" style="height:auto!important" name="pix_category_hack[]">
                            <option value="all"<?php if (is_array(get_pix_option('pix_category_hack')) && in_array('all',get_pix_option('pix_category_hack'))) { echo ' selected="selected"'; } ?>>All the categories</option>
                            <?php 
							$categories =  get_categories(); 
                            foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->term_id; ?>"<?php if (is_array(get_pix_option('pix_category_hack')) && in_array($category->term_id,get_pix_option('pix_category_hack'))) { echo ' selected="selected"'; } ?>><?php echo $category->cat_name; ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- .block_separator -->
                </div><!-- #blog-help-tab -->

                <div id="portfolio-help-tab">
                    <div class="block_separator">
                        <label for="pix_gallery_hack">How many galleries do you need to set</label>
                        <small>Keep &quot;ctrl&quot; button on PC or &quot;cmd&quot; button on MAC for multiple selections<br><br>
                        If you can't save anything in Delight -> Portfolio, maybe it's because you created many galleries and when you click the "Save" button too much data are sent to the database. Here you can try to include some galleries only and see if this fix the problem</small>
                        <select id="pix_gallery_hack" multiple size="6" style="height:auto!important" name="pix_gallery_hack[]">
                            <option value="all"<?php if (is_array(get_pix_option('pix_gallery_hack')) && in_array('all',get_pix_option('pix_gallery_hack'))) { echo ' selected="selected"'; } ?>>All the portfolio items</option>
                            <?php $terms = get_terms("gallery");
                            $count = count($terms);
                            if($count > 0){
                                foreach ($terms as $term) { ?>
                                    <option value="<?php echo $term->slug; ?>"<?php if (is_array(get_pix_option('pix_gallery_hack')) && in_array($term->slug,get_pix_option('pix_gallery_hack'))) { echo ' selected="selected"'; } ?>><?php echo $term->name; ?></option>
                            
                                <?php }
                            } ?>
                        </select>
                    </div><!-- .block_separator -->
                </div><!-- #portfolio-help-tab -->
                
                    <input name="save" type="submit" value="&nbsp;" class="input-save" />
                    <input type="hidden" name="action" value="save" />
                </form>
            </div><!-- #help-tab -->
        </div><!-- #pix_body -->
<?php if ($current_user->display_name != 'pix_test' && $current_user->display_name != 'manu_test') { ?>
    <form method="post">
        <input id="pix_admin_reset" type="button" value="&nbsp;" class="input-reset" />
        <input style="display:none" name="reset" id="pix_admin_reset_hidden" type="submit" value="reset" />
        <input type="hidden" name="action" value="reset" />
    </form>
<?php } ?>


</div><!-- #pix_wrap -->
 

<?php

}




	
if ($current_user->display_name == 'pix_test' || $current_user->display_name == 'manu_test') {
	
	$turn = 0;
	foreach ($_POST as $key => $value) {
		$_SESSION[$key] = $value;
		$turn++;
		$req = count($_POST);
		if($turn==$req && $req>'0'){
			pix_include_css();
			pix_include_js();
		}
	}
		
	pix_admin();




} else {




	if ( $_GET['page'] ) {
		if ( isset($_REQUEST['action']) && $_REQUEST['action']=='save' ) {
	 
			foreach ($_POST as $key => $value) {
				if ( preg_match("/pix_array/", $key) ) {
					delete_option($key);
					if(!get_option($key)) {
						add_option($key, $value);
					} else {
						update_option($key, $value);
					}
				}
			}
			$turn = 0;
			foreach ($options as $value) {
				if(isset($_REQUEST[$value['id']])) {
					update_option($value['id'], $_REQUEST[$value['id']]);
				}
				$turn++;
				$req = count($_POST);
				if($turn==$req && $req>'0'){
					pix_include_css();
					pix_include_js();
				}
			}
			
	
	
			$get_sidebar_options = sidebar_generator_pix::get_sidebars();
			$sidebar_name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_generator_0']);
			$sidebar_id = sidebar_generator_pix::name_to_class($sidebar_name);
			if($sidebar_id == '' ){
				$options_sidebar = $get_sidebar_options;
			}else{
				if(isset($get_sidebar_options[$sidebar_id])){
					
				}
				if ( is_array($get_sidebar_options) ) {
					$new_sidebar_gen[$sidebar_id] = $sidebar_id;
					$options_sidebar = array_merge($get_sidebar_options, (array) $new_sidebar_gen);	
				}else{
					$options_sidebar[$sidebar_id] = $sidebar_id;
				}		
			 }
			
			update_option( $shortname.'_sidebar_generator', $options_sidebar);
	 
	 
	} 
	if ( isset($_REQUEST['action']) && $_REQUEST['action']=='reset' ) {
	 
		foreach ($options as $value) {
			update_option($value['id'], $value['std']);
		}
	 
	 
	}
	}
		
		pix_admin();
	}
	 
	 
}


?>
