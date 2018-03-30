<?php
global $different_themes_managment;
$differentThemes_general_options= array(
 array(
	"type" => "navigation",
	"name" => "General",
	"slug" => "general"
),

array(
	"type" => "tab",
	"slug"=>'general'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"page", "name"=>"General"), 
		array("slug"=>"blog", "name"=>"Blog"),
		array("slug"=>"home", "name"=>"Home"),
		array("slug"=>"portfolio", "name"=>"Portfolio"),
		array("slug"=>"contact", "name"=>"Contact/Footer"),
		array("slug"=>"banner_settings", "name"=>"Banners")
	)
),

/* ------------------------------------------------------------------------*
 * PAGE SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=>'page'
),

array(
	"type" => "homepage_set_test",
	"title" => "Set up Your Homepage and post page!",
	"desc" => "	<p><b>You have not selected the correct template page for homepage.</b></p>
	<p>Please make sure, you choose template \"Homepage\".</p>
	<br/>
	<ul>
		<li>Current front page: <a href='".get_permalink(get_option('page_on_front'))."'>".get_the_title(get_option('page_on_front'))."</a></li>
		<li>Current blog page: <a href'".get_permalink(get_option('page_for_posts'))."'>".get_the_title(get_option('page_for_posts'))."</a></li>
	</ul>",
	"desc_2" => "<p><b>You have NOT enabled homepage.</b></p>
	<p>To use custom homepage, you must first create two <a href='".home_url()."/wp-admin/post-new.php?post_type=page'>new pages</a>, and one of them assign to \"<b>Homepage</b>\" template.Give each page a title, but avoid adding any text.</p>
	<p>Then enable homepage  in <a href='".home_url()."/wp-admin/options-reading.php'>wordpress reading settings</a> (See \"Front page displays\" option). Select your previously created pages from both dropdowns and save changes.</p>"
),
   
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Add logo image"
),
   
array(
	"type" => "upload",
	"title" => "Add Header Logo Image",
	"id" => $different_themes_managment->themeslug."_logo"
),      
array(
	"type" => "upload",
	"title" => "Add Footer Logo Image",
	"id" => $different_themes_managment->themeslug."_footer_logo"
),   

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Favicon"
),
   
array(
	"type" => "upload",
	"title" => "Favicon",
	"info" => "Favicons are the small 16 pixel by 16 pixel pictures you see beside some URLs in your browser's address bar.",
	"id" => $different_themes_managment->themeslug."_favicon"
),   

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => "Save Changes"
),
   
array(
	"type" => "closesubtab"
),

/* ------------------------------------------------------------------------*
 * BLOG SETTINGS
 * ------------------------------------------------------------------------*/   
  
array(
	"type" => "sub_tab",
	"slug"=>'blog'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Unit Settings"
),

array(
	"type" => "checkbox",
	"title" => "Show thumbnails in blog post list:",
	"id"=>$different_themes_managment->themeslug."_show_first_thumb"
),

array(
	"type" => "checkbox",
	"title" => "Show thumbnail in open post/page:",
	"id"=>$different_themes_managment->themeslug."_show_single_thumb"
),

array(
	"type" => "checkbox",
	"title" => "Show \"no image\" thumbnail, when no thumbnail is available:",
	"id"=>$different_themes_managment->themeslug."_show_no_image_thumb"
),
array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Blog Settings"
),

array(
	"type" => "checkbox",
	"title" => "Show pictures in post list page:",
	"id"=>$different_themes_managment->themeslug."_show_first_pictures"
),

array(
	"type" => "checkbox",
	"title" => "Show other objects on post list page (videos etc.):",
	"id"=>$different_themes_managment->themeslug."_show_first_objects"
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * HOME SETTINGS
 * ------------------------------------------------------------------------*/   
  
array(
	"type" => "sub_tab",
	"slug"=>'home'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Homepage Settings"
),

array(
	"type" => "close"
),
array(
	"type" => "homepage_blocks",
	"title" => "Homepage Blocks:",
	"id" => $different_themes_managment->themeslug."_homepage_blocks",
	"blocks" => array(
		array(
			"title" => "Four Info Blocks",
			"type" => "homepage_4_info_blocks",
			"options" => array(
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_title_1", "title" => "Block Title 1:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_text_1", "title" => "Block Text 1:", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_icon_1",
					"title" => "Block Icon 1:",
						"options"=>array(
							array("slug"=>"icon-cloud-download", "name"=>"icon-cloud-download"),
							array("slug"=>"icon-cloud-upload", "name"=>"icon-cloud-upload"),
							array("slug"=>"icon-lightbulb", "name"=>"icon-lightbulb"),
							array("slug"=>"icon-exchange", "name"=>"icon-exchange"),
							array("slug"=>"icon-bell-alt", "name"=>"icon-bell-alt"),
							array("slug"=>"icon-file-alt", "name"=>"icon-file-alt"),
							array("slug"=>"icon-beer", "name"=>"icon-beer"),
							array("slug"=>"icon-coffee", "name"=>"icon-coffee"),
							array("slug"=>"icon-food", "name"=>"icon-food"),
							array("slug"=>"icon-fighter-jet", "name"=>"icon-fighter-jet"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
							array("slug"=>"icon-stethoscope", "name"=>"icon-stethoscope"),
							array("slug"=>"icon-suitcase", "name"=>"icon-suitcase"),
							array("slug"=>"icon-building", "name"=>"icon-building"),
							array("slug"=>"icon-hospital", "name"=>"icon-hospital"),
							array("slug"=>"icon-ambulance", "name"=>"icon-ambulance"),
							array("slug"=>"icon-medkit", "name"=>"icon-medkit"),
							array("slug"=>"icon-h-sign", "name"=>"icon-h-sign"),
							array("slug"=>"icon-plus-sign-alt", "name"=>"icon-plus-sign-alt"),
							array("slug"=>"icon-spinner", "name"=>"icon-spinner"),
							array("slug"=>"icon-angle-left", "name"=>"icon-angle-left"),
							array("slug"=>"icon-angle-right", "name"=>"icon-angle-right"),
							array("slug"=>"icon-angle-up", "name"=>"icon-angle-up"),
							array("slug"=>"icon-angle-down", "name"=>"icon-angle-down"),
							array("slug"=>"icon-double-angle-left", "name"=>"icon-double-angle-left"),
							array("slug"=>"icon-double-angle-right", "name"=>"icon-double-angle-right"),
							array("slug"=>"icon-double-angle-up", "name"=>"icon-double-angle-up"),
							array("slug"=>"icon-double-angle-down", "name"=>"icon-double-angle-down"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-desktop", "name"=>"icon-desktop"),
							array("slug"=>"icon-laptop", "name"=>"icon-laptop"),
							array("slug"=>"icon-tablet", "name"=>"icon-tablet"),
							array("slug"=>"icon-mobile-phone", "name"=>"icon-mobile-phone"),
							array("slug"=>"icon-quote-left", "name"=>"icon-quote-left"),
							array("slug"=>"icon-quote-right", "name"=>"icon-quote-right"),
							array("slug"=>"icon-reply", "name"=>"icon-reply"),
							array("slug"=>"icon-github-alt", "name"=>"icon-github-alt"),
							array("slug"=>"icon-folder-close-alt", "name"=>"icon-folder-close-alt"),
							array("slug"=>"icon-folder-open-alt", "name"=>"icon-folder-open-alt"),
							array("slug"=>"icon-adjust", "name"=>"icon-adjust"),
							array("slug"=>"icon-asterisk", "name"=>"icon-asterisk"),
							array("slug"=>"icon-ban-circle", "name"=>"icon-ban-circle"),
							array("slug"=>"icon-bar-chart", "name"=>"icon-bar-chart"),
							array("slug"=>"icon-barcode", "name"=>"icon-barcode"),
							array("slug"=>"icon-beaker", "name"=>"icon-beaker"),
							array("slug"=>"icon-beer", "name"=>"icon-beer"),
							array("slug"=>"icon-bell", "name"=>"icon-bell"),
							array("slug"=>"icon-bell-alt", "name"=>"icon-bell-alt"),
							array("slug"=>"icon-bolt", "name"=>"icon-bolt"),
							array("slug"=>"icon-book", "name"=>"icon-book"),
							array("slug"=>"icon-bookmark", "name"=>"icon-bookmark"),
							array("slug"=>"icon-bookmark-empty", "name"=>"icon-bookmark-empty"),
							array("slug"=>"icon-briefcase", "name"=>"icon-briefcase"),
							array("slug"=>"icon-bullhorn", "name"=>"icon-bullhorn"),
							array("slug"=>"icon-calendar", "name"=>"icon-calendar"),
							array("slug"=>"icon-camera", "name"=>"icon-camera"),
							array("slug"=>"icon-camera-retro", "name"=>"icon-camera-retro"),
							array("slug"=>"icon-certificate", "name"=>"icon-certificate"),
							array("slug"=>"icon-check", "name"=>"icon-check"),
							array("slug"=>"icon-check-empty", "name"=>"icon-check-empty"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-cloud", "name"=>"icon-cloud"),
							array("slug"=>"icon-cloud-download", "name"=>"icon-cloud-download"),
							array("slug"=>"icon-cloud-upload", "name"=>"icon-cloud-upload"),
							array("slug"=>"icon-coffee", "name"=>"icon-coffee"),
							array("slug"=>"icon-cog", "name"=>"icon-cog"),
							array("slug"=>"icon-cogs", "name"=>"icon-cogs"),
							array("slug"=>"icon-comment", "name"=>"icon-comment"),
							array("slug"=>"icon-comment-alt", "name"=>"icon-comment-alt"),
							array("slug"=>"icon-comments", "name"=>"icon-comments"),
							array("slug"=>"icon-comments-alt", "name"=>"icon-comments-alt"),
							array("slug"=>"icon-credit-card", "name"=>"icon-credit-card"),
							array("slug"=>"icon-dashboard", "name"=>"icon-dashboard"),
							array("slug"=>"icon-desktop", "name"=>"icon-desktop"),
							array("slug"=>"icon-download", "name"=>"icon-download"),
							array("slug"=>"icon-download-alt", "name"=>"icon-download-alt"),
							array("slug"=>"icon-edit", "name"=>"icon-edit"),
							array("slug"=>"icon-envelope", "name"=>"icon-envelope"),
							array("slug"=>"icon-envelope-alt", "name"=>"icon-envelope-alt"),
							array("slug"=>"icon-exchange", "name"=>"icon-exchange"),
							array("slug"=>"icon-exclamation-sign", "name"=>"icon-exclamation-sign"),
							array("slug"=>"icon-external-link", "name"=>"icon-external-link"),
							array("slug"=>"icon-eye-close", "name"=>"icon-eye-close"),
							array("slug"=>"icon-eye-open", "name"=>"icon-eye-open"),
							array("slug"=>"icon-facetime-video", "name"=>"icon-facetime-video"),
							array("slug"=>"icon-fighter-jet", "name"=>"icon-fighter-jet"),
							array("slug"=>"icon-film", "name"=>"icon-film"),
							array("slug"=>"icon-filter", "name"=>"icon-filter"),
							array("slug"=>"icon-fire", "name"=>"icon-fire"),
							array("slug"=>"icon-flag", "name"=>"icon-flag"),
							array("slug"=>"icon-folder-close", "name"=>"icon-folder-close"),
							array("slug"=>"icon-folder-open", "name"=>"icon-folder-open"),
							array("slug"=>"icon-folder-close-alt", "name"=>"icon-folder-close-alt"),
							array("slug"=>"icon-folder-open-alt", "name"=>"icon-folder-open-alt"),
							array("slug"=>"icon-food", "name"=>"icon-food"),
							array("slug"=>"icon-gift", "name"=>"icon-gift"),
							array("slug"=>"icon-glass", "name"=>"icon-glass"),
							array("slug"=>"icon-globe", "name"=>"icon-globe"),
							array("slug"=>"icon-group", "name"=>"icon-group"),
							array("slug"=>"icon-hdd", "name"=>"icon-hdd"),
							array("slug"=>"icon-headphones", "name"=>"icon-headphones"),
							array("slug"=>"icon-heart", "name"=>"icon-heart"),
							array("slug"=>"icon-heart-empty", "name"=>"icon-heart-empty"),
							array("slug"=>"icon-home", "name"=>"icon-home"),
							array("slug"=>"icon-inbox", "name"=>"icon-inbox"),
							array("slug"=>"icon-info-sign", "name"=>"icon-info-sign"),
							array("slug"=>"icon-key", "name"=>"icon-key"),
							array("slug"=>"icon-leaf", "name"=>"icon-leaf"),
							array("slug"=>"icon-laptop", "name"=>"icon-laptop"),
							array("slug"=>"icon-legal", "name"=>"icon-legal"),
							array("slug"=>"icon-lemon", "name"=>"icon-lemon"),
							array("slug"=>"icon-lightbulb", "name"=>"icon-lightbulb"),
							array("slug"=>"icon-lock", "name"=>"icon-lock"),
							array("slug"=>"icon-unlock", "name"=>"icon-unlock"),
							array("slug"=>"icon-magic", "name"=>"icon-magic"),
							array("slug"=>"icon-magnet", "name"=>"icon-magnet"),
							array("slug"=>"icon-map-marker", "name"=>"icon-map-marker"),
							array("slug"=>"icon-minus", "name"=>"icon-minus"),
							array("slug"=>"icon-minus-sign", "name"=>"icon-minus-sign"),
							array("slug"=>"icon-mobile-phone", "name"=>"icon-mobile-phone"),
							array("slug"=>"icon-money", "name"=>"icon-money"),
							array("slug"=>"icon-move", "name"=>"icon-move"),
							array("slug"=>"icon-music", "name"=>"icon-music"),
							array("slug"=>"icon-off", "name"=>"icon-off"),
							array("slug"=>"icon-ok", "name"=>"icon-ok"),
							array("slug"=>"icon-ok-circle", "name"=>"icon-ok-circle"),
							array("slug"=>"icon-ok-sign", "name"=>"icon-ok-sign"),
							array("slug"=>"icon-pencil", "name"=>"icon-pencil"),
							array("slug"=>"icon-picture", "name"=>"icon-picture"),
							array("slug"=>"icon-plane", "name"=>"icon-plane"),
							array("slug"=>"icon-plus", "name"=>"icon-plus"),
							array("slug"=>"icon-plus-sign", "name"=>"icon-plus-sign"),
							array("slug"=>"icon-print", "name"=>"icon-print"),
							array("slug"=>"icon-pushpin", "name"=>"icon-pushpin"),
							array("slug"=>"icon-qrcode", "name"=>"icon-qrcode"),
							array("slug"=>"icon-question-sign", "name"=>"icon-question-sign"),
							array("slug"=>"icon-quote-left", "name"=>"icon-quote-left"),
							array("slug"=>"icon-quote-right", "name"=>"icon-quote-right"),
							array("slug"=>"icon-random", "name"=>"icon-random"),
							array("slug"=>"icon-refresh", "name"=>"icon-refresh"),
							array("slug"=>"icon-remove", "name"=>"icon-remove"),
							array("slug"=>"icon-remove-circle", "name"=>"icon-remove-circle"),
							array("slug"=>"icon-remove-sign", "name"=>"icon-remove-sign"),
							array("slug"=>"icon-reorder", "name"=>"icon-reorder"),
							array("slug"=>"icon-reply", "name"=>"icon-reply"),
							array("slug"=>"icon-resize-horizontal", "name"=>"icon-resize-horizontal"),
							array("slug"=>"icon-resize-vertical", "name"=>"icon-resize-vertical"),
							array("slug"=>"icon-retweet", "name"=>"icon-retweet"),
							array("slug"=>"icon-road", "name"=>"icon-road"),
							array("slug"=>"icon-rss", "name"=>"icon-rss"),
							array("slug"=>"icon-screenshot", "name"=>"icon-screenshot"),
							array("slug"=>"icon-search", "name"=>"icon-search"),
							array("slug"=>"icon-share", "name"=>"icon-share"),
							array("slug"=>"icon-share-alt", "name"=>"icon-share-alt"),
							array("slug"=>"icon-shopping-cart", "name"=>"icon-shopping-cart"),
							array("slug"=>"icon-signal", "name"=>"icon-signal"),
							array("slug"=>"icon-signin", "name"=>"icon-signin"),
							array("slug"=>"icon-signout", "name"=>"icon-signout"),
							array("slug"=>"icon-sitemap", "name"=>"icon-sitemap"),
							array("slug"=>"icon-sort", "name"=>"icon-sort"),
							array("slug"=>"icon-sort-down", "name"=>"icon-sort-down"),
							array("slug"=>"icon-sort-up", "name"=>"icon-sort-up"),
							array("slug"=>"icon-spinner", "name"=>"icon-spinner"),
							array("slug"=>"icon-star", "name"=>"icon-star"),
							array("slug"=>"icon-star-empty", "name"=>"icon-star-empty"),
							array("slug"=>"icon-star-half", "name"=>"icon-star-half"),
							array("slug"=>"icon-tablet", "name"=>"icon-tablet"),
							array("slug"=>"icon-tag", "name"=>"icon-tag"),
							array("slug"=>"icon-tags", "name"=>"icon-tags"),
							array("slug"=>"icon-tasks", "name"=>"icon-tasks"),
							array("slug"=>"icon-thumbs-down", "name"=>"icon-thumbs-down"),
							array("slug"=>"icon-thumbs-up", "name"=>"icon-thumbs-up"),
							array("slug"=>"icon-time", "name"=>"icon-time"),
							array("slug"=>"icon-tint", "name"=>"icon-tint"),
							array("slug"=>"icon-trash", "name"=>"icon-trash"),
							array("slug"=>"icon-trophy", "name"=>"icon-trophy"),
							array("slug"=>"icon-truck", "name"=>"icon-truck"),
							array("slug"=>"icon-umbrella", "name"=>"icon-umbrella"),
							array("slug"=>"icon-upload", "name"=>"icon-upload"),
							array("slug"=>"icon-upload-alt", "name"=>"icon-upload-alt"),
							array("slug"=>"icon-user", "name"=>"icon-user"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
							array("slug"=>"icon-volume-off", "name"=>"icon-volume-off"),
							array("slug"=>"icon-volume-down", "name"=>"icon-volume-down"),
							array("slug"=>"icon-volume-up", "name"=>"icon-volume-up"),
							array("slug"=>"icon-warning-sign", "name"=>"icon-warning-sign"),
							array("slug"=>"icon-wrench", "name"=>"icon-wrench"),
							array("slug"=>"icon-zoom-in", "name"=>"icon-zoom-in"),
							array("slug"=>"icon-zoom-out", "name"=>"icon-zoom-out"),
							array("slug"=>"icon-file", "name"=>"icon-file"),
							array("slug"=>"icon-file-alt", "name"=>"icon-file-alt"),
							array("slug"=>"icon-cut", "name"=>"icon-cut"),
							array("slug"=>"icon-copy", "name"=>"icon-copy"),
							array("slug"=>"icon-paste", "name"=>"icon-paste"),
							array("slug"=>"icon-save", "name"=>"icon-save"),
							array("slug"=>"icon-undo", "name"=>"icon-undo"),
							array("slug"=>"icon-repeat", "name"=>"icon-repeat"),
							array("slug"=>"icon-text-height", "name"=>"icon-text-height"),
							array("slug"=>"icon-text-width", "name"=>"icon-text-width"),
							array("slug"=>"icon-align-left", "name"=>"icon-align-left"),
							array("slug"=>"icon-align-center", "name"=>"icon-align-center"),
							array("slug"=>"icon-align-right", "name"=>"icon-align-right"),
							array("slug"=>"icon-align-justify", "name"=>"icon-align-justify"),
							array("slug"=>"icon-indent-left", "name"=>"icon-indent-left"),
							array("slug"=>"icon-indent-right", "name"=>"icon-indent-right"),
							array("slug"=>"icon-font", "name"=>"icon-font"),
							array("slug"=>"icon-bold", "name"=>"icon-bold"),
							array("slug"=>"icon-italic", "name"=>"icon-italic"),
							array("slug"=>"icon-strikethrough", "name"=>"icon-strikethrough"),
							array("slug"=>"icon-underline", "name"=>"icon-underline"),
							array("slug"=>"icon-link", "name"=>"icon-link"),
							array("slug"=>"icon-paper-clip", "name"=>"icon-paper-clip"),
							array("slug"=>"icon-columns", "name"=>"icon-columns"),
							array("slug"=>"icon-table", "name"=>"icon-table"),
							array("slug"=>"icon-th-large", "name"=>"icon-th-large"),
							array("slug"=>"icon-th", "name"=>"icon-th"),
							array("slug"=>"icon-th-list", "name"=>"icon-th-list"),
							array("slug"=>"icon-list", "name"=>"icon-list"),
							array("slug"=>"icon-list-ol", "name"=>"icon-list-ol"),
							array("slug"=>"icon-list-ul", "name"=>"icon-list-ul"),
							array("slug"=>"icon-list-alt", "name"=>"icon-list-alt"),
							array("slug"=>"icon-angle-left", "name"=>"icon-angle-left"),
							array("slug"=>"icon-angle-right", "name"=>"icon-angle-right"),
							array("slug"=>"icon-angle-up", "name"=>"icon-angle-up"),
							array("slug"=>"icon-angle-down", "name"=>"icon-angle-down"),
							array("slug"=>"icon-arrow-down", "name"=>"icon-arrow-down"),
							array("slug"=>"icon-arrow-left", "name"=>"icon-arrow-left"),
							array("slug"=>"icon-arrow-right", "name"=>"icon-arrow-right"),
							array("slug"=>"icon-arrow-up", "name"=>"icon-arrow-up"),
							array("slug"=>"icon-caret-down", "name"=>"icon-caret-down"),
							array("slug"=>"icon-caret-left", "name"=>"icon-caret-left"),
							array("slug"=>"icon-caret-right", "name"=>"icon-caret-right"),
							array("slug"=>"icon-caret-up", "name"=>"icon-caret-up"),
							array("slug"=>"icon-chevron-down", "name"=>"icon-chevron-down"),
							array("slug"=>"icon-chevron-left", "name"=>"icon-chevron-left"),
							array("slug"=>"icon-chevron-right", "name"=>"icon-chevron-right"),
							array("slug"=>"icon-chevron-up", "name"=>"icon-chevron-up"),
							array("slug"=>"icon-circle-arrow-down", "name"=>"icon-circle-arrow-down"),
							array("slug"=>"icon-circle-arrow-left", "name"=>"icon-circle-arrow-left"),
							array("slug"=>"icon-circle-arrow-right", "name"=>"icon-circle-arrow-right"),
							array("slug"=>"icon-circle-arrow-up", "name"=>"icon-circle-arrow-up"),
							array("slug"=>"icon-double-angle-left", "name"=>"icon-double-angle-left"),
							array("slug"=>"icon-double-angle-right", "name"=>"icon-double-angle-right"),
							array("slug"=>"icon-double-angle-up", "name"=>"icon-double-angle-up"),
							array("slug"=>"icon-double-angle-down", "name"=>"icon-double-angle-down"),
							array("slug"=>"icon-hand-down", "name"=>"icon-hand-down"),
							array("slug"=>"icon-hand-left", "name"=>"icon-hand-left"),
							array("slug"=>"icon-hand-right", "name"=>"icon-hand-right"),
							array("slug"=>"icon-hand-up", "name"=>"icon-hand-up"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-play-circle", "name"=>"icon-play-circle"),
							array("slug"=>"icon-play", "name"=>"icon-play"),
							array("slug"=>"icon-pause", "name"=>"icon-pause"),
							array("slug"=>"icon-stop", "name"=>"icon-stop"),
							array("slug"=>"icon-step-backward", "name"=>"icon-step-backward"),
							array("slug"=>"icon-fast-backward", "name"=>"icon-fast-backward"),
							array("slug"=>"icon-backward", "name"=>"icon-backward"),
							array("slug"=>"icon-forward", "name"=>"icon-forward"),
							array("slug"=>"icon-fast-forward", "name"=>"icon-fast-forward"),
							array("slug"=>"icon-step-forward", "name"=>"icon-step-forward"),
							array("slug"=>"icon-eject", "name"=>"icon-eject"),
							array("slug"=>"icon-fullscreen", "name"=>"icon-fullscreen"),
							array("slug"=>"icon-resize-full", "name"=>"icon-resize-full"),
							array("slug"=>"icon-resize-small", "name"=>"icon-resize-small"),
							array("slug"=>"icon-phone", "name"=>"icon-phone"),
							array("slug"=>"icon-phone-sign", "name"=>"icon-phone-sign"),
							array("slug"=>"icon-facebook", "name"=>"icon-facebook"),
							array("slug"=>"icon-facebook-sign", "name"=>"icon-facebook-sign"),
							array("slug"=>"icon-twitter", "name"=>"icon-twitter"),
							array("slug"=>"icon-twitter-sign", "name"=>"icon-twitter-sign"),
							array("slug"=>"icon-github", "name"=>"icon-github"),
							array("slug"=>"icon-github-alt", "name"=>"icon-github-alt"),
							array("slug"=>"icon-github-sign", "name"=>"icon-github-sign"),
							array("slug"=>"icon-linkedin", "name"=>"icon-linkedin"),
							array("slug"=>"icon-linkedin-sign", "name"=>"icon-linkedin-sign"),
							array("slug"=>"icon-pinterest", "name"=>"icon-pinterest"),
							array("slug"=>"icon-pinterest-sign", "name"=>"icon-pinterest-sign"),
							array("slug"=>"icon-google-plus", "name"=>"icon-google-plus"),
							array("slug"=>"icon-google-plus-sign", "name"=>"icon-google-plus-sign"),
							array("slug"=>"icon-sign-blank", "name"=>"icon-sign-blank"),
							array("slug"=>"icon-ambulance", "name"=>"icon-ambulance"),
							array("slug"=>"icon-beaker", "name"=>"icon-beaker"),
							array("slug"=>"icon-h-sign", "name"=>"icon-h-sign"),
							array("slug"=>"icon-hospital", "name"=>"icon-hospital"),
							array("slug"=>"icon-medkit", "name"=>"icon-medkit"),
							array("slug"=>"icon-plus-sign-alt", "name"=>"icon-plus-sign-alt"),
							array("slug"=>"icon-stethoscope", "name"=>"icon-stethoscope"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
						),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_title_2", "title" => "Block Title 2:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_text_2", "title" => "Block Text 2:", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_icon_2",
					"title" => "Block Icon 2:",
						"options"=>array(
							array("slug"=>"icon-cloud-download", "name"=>"icon-cloud-download"),
							array("slug"=>"icon-cloud-upload", "name"=>"icon-cloud-upload"),
							array("slug"=>"icon-lightbulb", "name"=>"icon-lightbulb"),
							array("slug"=>"icon-exchange", "name"=>"icon-exchange"),
							array("slug"=>"icon-bell-alt", "name"=>"icon-bell-alt"),
							array("slug"=>"icon-file-alt", "name"=>"icon-file-alt"),
							array("slug"=>"icon-beer", "name"=>"icon-beer"),
							array("slug"=>"icon-coffee", "name"=>"icon-coffee"),
							array("slug"=>"icon-food", "name"=>"icon-food"),
							array("slug"=>"icon-fighter-jet", "name"=>"icon-fighter-jet"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
							array("slug"=>"icon-stethoscope", "name"=>"icon-stethoscope"),
							array("slug"=>"icon-suitcase", "name"=>"icon-suitcase"),
							array("slug"=>"icon-building", "name"=>"icon-building"),
							array("slug"=>"icon-hospital", "name"=>"icon-hospital"),
							array("slug"=>"icon-ambulance", "name"=>"icon-ambulance"),
							array("slug"=>"icon-medkit", "name"=>"icon-medkit"),
							array("slug"=>"icon-h-sign", "name"=>"icon-h-sign"),
							array("slug"=>"icon-plus-sign-alt", "name"=>"icon-plus-sign-alt"),
							array("slug"=>"icon-spinner", "name"=>"icon-spinner"),
							array("slug"=>"icon-angle-left", "name"=>"icon-angle-left"),
							array("slug"=>"icon-angle-right", "name"=>"icon-angle-right"),
							array("slug"=>"icon-angle-up", "name"=>"icon-angle-up"),
							array("slug"=>"icon-angle-down", "name"=>"icon-angle-down"),
							array("slug"=>"icon-double-angle-left", "name"=>"icon-double-angle-left"),
							array("slug"=>"icon-double-angle-right", "name"=>"icon-double-angle-right"),
							array("slug"=>"icon-double-angle-up", "name"=>"icon-double-angle-up"),
							array("slug"=>"icon-double-angle-down", "name"=>"icon-double-angle-down"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-desktop", "name"=>"icon-desktop"),
							array("slug"=>"icon-laptop", "name"=>"icon-laptop"),
							array("slug"=>"icon-tablet", "name"=>"icon-tablet"),
							array("slug"=>"icon-mobile-phone", "name"=>"icon-mobile-phone"),
							array("slug"=>"icon-quote-left", "name"=>"icon-quote-left"),
							array("slug"=>"icon-quote-right", "name"=>"icon-quote-right"),
							array("slug"=>"icon-reply", "name"=>"icon-reply"),
							array("slug"=>"icon-github-alt", "name"=>"icon-github-alt"),
							array("slug"=>"icon-folder-close-alt", "name"=>"icon-folder-close-alt"),
							array("slug"=>"icon-folder-open-alt", "name"=>"icon-folder-open-alt"),
							array("slug"=>"icon-adjust", "name"=>"icon-adjust"),
							array("slug"=>"icon-asterisk", "name"=>"icon-asterisk"),
							array("slug"=>"icon-ban-circle", "name"=>"icon-ban-circle"),
							array("slug"=>"icon-bar-chart", "name"=>"icon-bar-chart"),
							array("slug"=>"icon-barcode", "name"=>"icon-barcode"),
							array("slug"=>"icon-beaker", "name"=>"icon-beaker"),
							array("slug"=>"icon-beer", "name"=>"icon-beer"),
							array("slug"=>"icon-bell", "name"=>"icon-bell"),
							array("slug"=>"icon-bell-alt", "name"=>"icon-bell-alt"),
							array("slug"=>"icon-bolt", "name"=>"icon-bolt"),
							array("slug"=>"icon-book", "name"=>"icon-book"),
							array("slug"=>"icon-bookmark", "name"=>"icon-bookmark"),
							array("slug"=>"icon-bookmark-empty", "name"=>"icon-bookmark-empty"),
							array("slug"=>"icon-briefcase", "name"=>"icon-briefcase"),
							array("slug"=>"icon-bullhorn", "name"=>"icon-bullhorn"),
							array("slug"=>"icon-calendar", "name"=>"icon-calendar"),
							array("slug"=>"icon-camera", "name"=>"icon-camera"),
							array("slug"=>"icon-camera-retro", "name"=>"icon-camera-retro"),
							array("slug"=>"icon-certificate", "name"=>"icon-certificate"),
							array("slug"=>"icon-check", "name"=>"icon-check"),
							array("slug"=>"icon-check-empty", "name"=>"icon-check-empty"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-cloud", "name"=>"icon-cloud"),
							array("slug"=>"icon-cloud-download", "name"=>"icon-cloud-download"),
							array("slug"=>"icon-cloud-upload", "name"=>"icon-cloud-upload"),
							array("slug"=>"icon-coffee", "name"=>"icon-coffee"),
							array("slug"=>"icon-cog", "name"=>"icon-cog"),
							array("slug"=>"icon-cogs", "name"=>"icon-cogs"),
							array("slug"=>"icon-comment", "name"=>"icon-comment"),
							array("slug"=>"icon-comment-alt", "name"=>"icon-comment-alt"),
							array("slug"=>"icon-comments", "name"=>"icon-comments"),
							array("slug"=>"icon-comments-alt", "name"=>"icon-comments-alt"),
							array("slug"=>"icon-credit-card", "name"=>"icon-credit-card"),
							array("slug"=>"icon-dashboard", "name"=>"icon-dashboard"),
							array("slug"=>"icon-desktop", "name"=>"icon-desktop"),
							array("slug"=>"icon-download", "name"=>"icon-download"),
							array("slug"=>"icon-download-alt", "name"=>"icon-download-alt"),
							array("slug"=>"icon-edit", "name"=>"icon-edit"),
							array("slug"=>"icon-envelope", "name"=>"icon-envelope"),
							array("slug"=>"icon-envelope-alt", "name"=>"icon-envelope-alt"),
							array("slug"=>"icon-exchange", "name"=>"icon-exchange"),
							array("slug"=>"icon-exclamation-sign", "name"=>"icon-exclamation-sign"),
							array("slug"=>"icon-external-link", "name"=>"icon-external-link"),
							array("slug"=>"icon-eye-close", "name"=>"icon-eye-close"),
							array("slug"=>"icon-eye-open", "name"=>"icon-eye-open"),
							array("slug"=>"icon-facetime-video", "name"=>"icon-facetime-video"),
							array("slug"=>"icon-fighter-jet", "name"=>"icon-fighter-jet"),
							array("slug"=>"icon-film", "name"=>"icon-film"),
							array("slug"=>"icon-filter", "name"=>"icon-filter"),
							array("slug"=>"icon-fire", "name"=>"icon-fire"),
							array("slug"=>"icon-flag", "name"=>"icon-flag"),
							array("slug"=>"icon-folder-close", "name"=>"icon-folder-close"),
							array("slug"=>"icon-folder-open", "name"=>"icon-folder-open"),
							array("slug"=>"icon-folder-close-alt", "name"=>"icon-folder-close-alt"),
							array("slug"=>"icon-folder-open-alt", "name"=>"icon-folder-open-alt"),
							array("slug"=>"icon-food", "name"=>"icon-food"),
							array("slug"=>"icon-gift", "name"=>"icon-gift"),
							array("slug"=>"icon-glass", "name"=>"icon-glass"),
							array("slug"=>"icon-globe", "name"=>"icon-globe"),
							array("slug"=>"icon-group", "name"=>"icon-group"),
							array("slug"=>"icon-hdd", "name"=>"icon-hdd"),
							array("slug"=>"icon-headphones", "name"=>"icon-headphones"),
							array("slug"=>"icon-heart", "name"=>"icon-heart"),
							array("slug"=>"icon-heart-empty", "name"=>"icon-heart-empty"),
							array("slug"=>"icon-home", "name"=>"icon-home"),
							array("slug"=>"icon-inbox", "name"=>"icon-inbox"),
							array("slug"=>"icon-info-sign", "name"=>"icon-info-sign"),
							array("slug"=>"icon-key", "name"=>"icon-key"),
							array("slug"=>"icon-leaf", "name"=>"icon-leaf"),
							array("slug"=>"icon-laptop", "name"=>"icon-laptop"),
							array("slug"=>"icon-legal", "name"=>"icon-legal"),
							array("slug"=>"icon-lemon", "name"=>"icon-lemon"),
							array("slug"=>"icon-lightbulb", "name"=>"icon-lightbulb"),
							array("slug"=>"icon-lock", "name"=>"icon-lock"),
							array("slug"=>"icon-unlock", "name"=>"icon-unlock"),
							array("slug"=>"icon-magic", "name"=>"icon-magic"),
							array("slug"=>"icon-magnet", "name"=>"icon-magnet"),
							array("slug"=>"icon-map-marker", "name"=>"icon-map-marker"),
							array("slug"=>"icon-minus", "name"=>"icon-minus"),
							array("slug"=>"icon-minus-sign", "name"=>"icon-minus-sign"),
							array("slug"=>"icon-mobile-phone", "name"=>"icon-mobile-phone"),
							array("slug"=>"icon-money", "name"=>"icon-money"),
							array("slug"=>"icon-move", "name"=>"icon-move"),
							array("slug"=>"icon-music", "name"=>"icon-music"),
							array("slug"=>"icon-off", "name"=>"icon-off"),
							array("slug"=>"icon-ok", "name"=>"icon-ok"),
							array("slug"=>"icon-ok-circle", "name"=>"icon-ok-circle"),
							array("slug"=>"icon-ok-sign", "name"=>"icon-ok-sign"),
							array("slug"=>"icon-pencil", "name"=>"icon-pencil"),
							array("slug"=>"icon-picture", "name"=>"icon-picture"),
							array("slug"=>"icon-plane", "name"=>"icon-plane"),
							array("slug"=>"icon-plus", "name"=>"icon-plus"),
							array("slug"=>"icon-plus-sign", "name"=>"icon-plus-sign"),
							array("slug"=>"icon-print", "name"=>"icon-print"),
							array("slug"=>"icon-pushpin", "name"=>"icon-pushpin"),
							array("slug"=>"icon-qrcode", "name"=>"icon-qrcode"),
							array("slug"=>"icon-question-sign", "name"=>"icon-question-sign"),
							array("slug"=>"icon-quote-left", "name"=>"icon-quote-left"),
							array("slug"=>"icon-quote-right", "name"=>"icon-quote-right"),
							array("slug"=>"icon-random", "name"=>"icon-random"),
							array("slug"=>"icon-refresh", "name"=>"icon-refresh"),
							array("slug"=>"icon-remove", "name"=>"icon-remove"),
							array("slug"=>"icon-remove-circle", "name"=>"icon-remove-circle"),
							array("slug"=>"icon-remove-sign", "name"=>"icon-remove-sign"),
							array("slug"=>"icon-reorder", "name"=>"icon-reorder"),
							array("slug"=>"icon-reply", "name"=>"icon-reply"),
							array("slug"=>"icon-resize-horizontal", "name"=>"icon-resize-horizontal"),
							array("slug"=>"icon-resize-vertical", "name"=>"icon-resize-vertical"),
							array("slug"=>"icon-retweet", "name"=>"icon-retweet"),
							array("slug"=>"icon-road", "name"=>"icon-road"),
							array("slug"=>"icon-rss", "name"=>"icon-rss"),
							array("slug"=>"icon-screenshot", "name"=>"icon-screenshot"),
							array("slug"=>"icon-search", "name"=>"icon-search"),
							array("slug"=>"icon-share", "name"=>"icon-share"),
							array("slug"=>"icon-share-alt", "name"=>"icon-share-alt"),
							array("slug"=>"icon-shopping-cart", "name"=>"icon-shopping-cart"),
							array("slug"=>"icon-signal", "name"=>"icon-signal"),
							array("slug"=>"icon-signin", "name"=>"icon-signin"),
							array("slug"=>"icon-signout", "name"=>"icon-signout"),
							array("slug"=>"icon-sitemap", "name"=>"icon-sitemap"),
							array("slug"=>"icon-sort", "name"=>"icon-sort"),
							array("slug"=>"icon-sort-down", "name"=>"icon-sort-down"),
							array("slug"=>"icon-sort-up", "name"=>"icon-sort-up"),
							array("slug"=>"icon-spinner", "name"=>"icon-spinner"),
							array("slug"=>"icon-star", "name"=>"icon-star"),
							array("slug"=>"icon-star-empty", "name"=>"icon-star-empty"),
							array("slug"=>"icon-star-half", "name"=>"icon-star-half"),
							array("slug"=>"icon-tablet", "name"=>"icon-tablet"),
							array("slug"=>"icon-tag", "name"=>"icon-tag"),
							array("slug"=>"icon-tags", "name"=>"icon-tags"),
							array("slug"=>"icon-tasks", "name"=>"icon-tasks"),
							array("slug"=>"icon-thumbs-down", "name"=>"icon-thumbs-down"),
							array("slug"=>"icon-thumbs-up", "name"=>"icon-thumbs-up"),
							array("slug"=>"icon-time", "name"=>"icon-time"),
							array("slug"=>"icon-tint", "name"=>"icon-tint"),
							array("slug"=>"icon-trash", "name"=>"icon-trash"),
							array("slug"=>"icon-trophy", "name"=>"icon-trophy"),
							array("slug"=>"icon-truck", "name"=>"icon-truck"),
							array("slug"=>"icon-umbrella", "name"=>"icon-umbrella"),
							array("slug"=>"icon-upload", "name"=>"icon-upload"),
							array("slug"=>"icon-upload-alt", "name"=>"icon-upload-alt"),
							array("slug"=>"icon-user", "name"=>"icon-user"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
							array("slug"=>"icon-volume-off", "name"=>"icon-volume-off"),
							array("slug"=>"icon-volume-down", "name"=>"icon-volume-down"),
							array("slug"=>"icon-volume-up", "name"=>"icon-volume-up"),
							array("slug"=>"icon-warning-sign", "name"=>"icon-warning-sign"),
							array("slug"=>"icon-wrench", "name"=>"icon-wrench"),
							array("slug"=>"icon-zoom-in", "name"=>"icon-zoom-in"),
							array("slug"=>"icon-zoom-out", "name"=>"icon-zoom-out"),
							array("slug"=>"icon-file", "name"=>"icon-file"),
							array("slug"=>"icon-file-alt", "name"=>"icon-file-alt"),
							array("slug"=>"icon-cut", "name"=>"icon-cut"),
							array("slug"=>"icon-copy", "name"=>"icon-copy"),
							array("slug"=>"icon-paste", "name"=>"icon-paste"),
							array("slug"=>"icon-save", "name"=>"icon-save"),
							array("slug"=>"icon-undo", "name"=>"icon-undo"),
							array("slug"=>"icon-repeat", "name"=>"icon-repeat"),
							array("slug"=>"icon-text-height", "name"=>"icon-text-height"),
							array("slug"=>"icon-text-width", "name"=>"icon-text-width"),
							array("slug"=>"icon-align-left", "name"=>"icon-align-left"),
							array("slug"=>"icon-align-center", "name"=>"icon-align-center"),
							array("slug"=>"icon-align-right", "name"=>"icon-align-right"),
							array("slug"=>"icon-align-justify", "name"=>"icon-align-justify"),
							array("slug"=>"icon-indent-left", "name"=>"icon-indent-left"),
							array("slug"=>"icon-indent-right", "name"=>"icon-indent-right"),
							array("slug"=>"icon-font", "name"=>"icon-font"),
							array("slug"=>"icon-bold", "name"=>"icon-bold"),
							array("slug"=>"icon-italic", "name"=>"icon-italic"),
							array("slug"=>"icon-strikethrough", "name"=>"icon-strikethrough"),
							array("slug"=>"icon-underline", "name"=>"icon-underline"),
							array("slug"=>"icon-link", "name"=>"icon-link"),
							array("slug"=>"icon-paper-clip", "name"=>"icon-paper-clip"),
							array("slug"=>"icon-columns", "name"=>"icon-columns"),
							array("slug"=>"icon-table", "name"=>"icon-table"),
							array("slug"=>"icon-th-large", "name"=>"icon-th-large"),
							array("slug"=>"icon-th", "name"=>"icon-th"),
							array("slug"=>"icon-th-list", "name"=>"icon-th-list"),
							array("slug"=>"icon-list", "name"=>"icon-list"),
							array("slug"=>"icon-list-ol", "name"=>"icon-list-ol"),
							array("slug"=>"icon-list-ul", "name"=>"icon-list-ul"),
							array("slug"=>"icon-list-alt", "name"=>"icon-list-alt"),
							array("slug"=>"icon-angle-left", "name"=>"icon-angle-left"),
							array("slug"=>"icon-angle-right", "name"=>"icon-angle-right"),
							array("slug"=>"icon-angle-up", "name"=>"icon-angle-up"),
							array("slug"=>"icon-angle-down", "name"=>"icon-angle-down"),
							array("slug"=>"icon-arrow-down", "name"=>"icon-arrow-down"),
							array("slug"=>"icon-arrow-left", "name"=>"icon-arrow-left"),
							array("slug"=>"icon-arrow-right", "name"=>"icon-arrow-right"),
							array("slug"=>"icon-arrow-up", "name"=>"icon-arrow-up"),
							array("slug"=>"icon-caret-down", "name"=>"icon-caret-down"),
							array("slug"=>"icon-caret-left", "name"=>"icon-caret-left"),
							array("slug"=>"icon-caret-right", "name"=>"icon-caret-right"),
							array("slug"=>"icon-caret-up", "name"=>"icon-caret-up"),
							array("slug"=>"icon-chevron-down", "name"=>"icon-chevron-down"),
							array("slug"=>"icon-chevron-left", "name"=>"icon-chevron-left"),
							array("slug"=>"icon-chevron-right", "name"=>"icon-chevron-right"),
							array("slug"=>"icon-chevron-up", "name"=>"icon-chevron-up"),
							array("slug"=>"icon-circle-arrow-down", "name"=>"icon-circle-arrow-down"),
							array("slug"=>"icon-circle-arrow-left", "name"=>"icon-circle-arrow-left"),
							array("slug"=>"icon-circle-arrow-right", "name"=>"icon-circle-arrow-right"),
							array("slug"=>"icon-circle-arrow-up", "name"=>"icon-circle-arrow-up"),
							array("slug"=>"icon-double-angle-left", "name"=>"icon-double-angle-left"),
							array("slug"=>"icon-double-angle-right", "name"=>"icon-double-angle-right"),
							array("slug"=>"icon-double-angle-up", "name"=>"icon-double-angle-up"),
							array("slug"=>"icon-double-angle-down", "name"=>"icon-double-angle-down"),
							array("slug"=>"icon-hand-down", "name"=>"icon-hand-down"),
							array("slug"=>"icon-hand-left", "name"=>"icon-hand-left"),
							array("slug"=>"icon-hand-right", "name"=>"icon-hand-right"),
							array("slug"=>"icon-hand-up", "name"=>"icon-hand-up"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-play-circle", "name"=>"icon-play-circle"),
							array("slug"=>"icon-play", "name"=>"icon-play"),
							array("slug"=>"icon-pause", "name"=>"icon-pause"),
							array("slug"=>"icon-stop", "name"=>"icon-stop"),
							array("slug"=>"icon-step-backward", "name"=>"icon-step-backward"),
							array("slug"=>"icon-fast-backward", "name"=>"icon-fast-backward"),
							array("slug"=>"icon-backward", "name"=>"icon-backward"),
							array("slug"=>"icon-forward", "name"=>"icon-forward"),
							array("slug"=>"icon-fast-forward", "name"=>"icon-fast-forward"),
							array("slug"=>"icon-step-forward", "name"=>"icon-step-forward"),
							array("slug"=>"icon-eject", "name"=>"icon-eject"),
							array("slug"=>"icon-fullscreen", "name"=>"icon-fullscreen"),
							array("slug"=>"icon-resize-full", "name"=>"icon-resize-full"),
							array("slug"=>"icon-resize-small", "name"=>"icon-resize-small"),
							array("slug"=>"icon-phone", "name"=>"icon-phone"),
							array("slug"=>"icon-phone-sign", "name"=>"icon-phone-sign"),
							array("slug"=>"icon-facebook", "name"=>"icon-facebook"),
							array("slug"=>"icon-facebook-sign", "name"=>"icon-facebook-sign"),
							array("slug"=>"icon-twitter", "name"=>"icon-twitter"),
							array("slug"=>"icon-twitter-sign", "name"=>"icon-twitter-sign"),
							array("slug"=>"icon-github", "name"=>"icon-github"),
							array("slug"=>"icon-github-alt", "name"=>"icon-github-alt"),
							array("slug"=>"icon-github-sign", "name"=>"icon-github-sign"),
							array("slug"=>"icon-linkedin", "name"=>"icon-linkedin"),
							array("slug"=>"icon-linkedin-sign", "name"=>"icon-linkedin-sign"),
							array("slug"=>"icon-pinterest", "name"=>"icon-pinterest"),
							array("slug"=>"icon-pinterest-sign", "name"=>"icon-pinterest-sign"),
							array("slug"=>"icon-google-plus", "name"=>"icon-google-plus"),
							array("slug"=>"icon-google-plus-sign", "name"=>"icon-google-plus-sign"),
							array("slug"=>"icon-sign-blank", "name"=>"icon-sign-blank"),
							array("slug"=>"icon-ambulance", "name"=>"icon-ambulance"),
							array("slug"=>"icon-beaker", "name"=>"icon-beaker"),
							array("slug"=>"icon-h-sign", "name"=>"icon-h-sign"),
							array("slug"=>"icon-hospital", "name"=>"icon-hospital"),
							array("slug"=>"icon-medkit", "name"=>"icon-medkit"),
							array("slug"=>"icon-plus-sign-alt", "name"=>"icon-plus-sign-alt"),
							array("slug"=>"icon-stethoscope", "name"=>"icon-stethoscope"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
						),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_title_3", "title" => "Block Title 3:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_text_3", "title" => "Block Text 3:", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_icon_3",
					"title" => "Block Icon 3:",
						"options"=>array(
							array("slug"=>"icon-cloud-download", "name"=>"icon-cloud-download"),
							array("slug"=>"icon-cloud-upload", "name"=>"icon-cloud-upload"),
							array("slug"=>"icon-lightbulb", "name"=>"icon-lightbulb"),
							array("slug"=>"icon-exchange", "name"=>"icon-exchange"),
							array("slug"=>"icon-bell-alt", "name"=>"icon-bell-alt"),
							array("slug"=>"icon-file-alt", "name"=>"icon-file-alt"),
							array("slug"=>"icon-beer", "name"=>"icon-beer"),
							array("slug"=>"icon-coffee", "name"=>"icon-coffee"),
							array("slug"=>"icon-food", "name"=>"icon-food"),
							array("slug"=>"icon-fighter-jet", "name"=>"icon-fighter-jet"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
							array("slug"=>"icon-stethoscope", "name"=>"icon-stethoscope"),
							array("slug"=>"icon-suitcase", "name"=>"icon-suitcase"),
							array("slug"=>"icon-building", "name"=>"icon-building"),
							array("slug"=>"icon-hospital", "name"=>"icon-hospital"),
							array("slug"=>"icon-ambulance", "name"=>"icon-ambulance"),
							array("slug"=>"icon-medkit", "name"=>"icon-medkit"),
							array("slug"=>"icon-h-sign", "name"=>"icon-h-sign"),
							array("slug"=>"icon-plus-sign-alt", "name"=>"icon-plus-sign-alt"),
							array("slug"=>"icon-spinner", "name"=>"icon-spinner"),
							array("slug"=>"icon-angle-left", "name"=>"icon-angle-left"),
							array("slug"=>"icon-angle-right", "name"=>"icon-angle-right"),
							array("slug"=>"icon-angle-up", "name"=>"icon-angle-up"),
							array("slug"=>"icon-angle-down", "name"=>"icon-angle-down"),
							array("slug"=>"icon-double-angle-left", "name"=>"icon-double-angle-left"),
							array("slug"=>"icon-double-angle-right", "name"=>"icon-double-angle-right"),
							array("slug"=>"icon-double-angle-up", "name"=>"icon-double-angle-up"),
							array("slug"=>"icon-double-angle-down", "name"=>"icon-double-angle-down"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-desktop", "name"=>"icon-desktop"),
							array("slug"=>"icon-laptop", "name"=>"icon-laptop"),
							array("slug"=>"icon-tablet", "name"=>"icon-tablet"),
							array("slug"=>"icon-mobile-phone", "name"=>"icon-mobile-phone"),
							array("slug"=>"icon-quote-left", "name"=>"icon-quote-left"),
							array("slug"=>"icon-quote-right", "name"=>"icon-quote-right"),
							array("slug"=>"icon-reply", "name"=>"icon-reply"),
							array("slug"=>"icon-github-alt", "name"=>"icon-github-alt"),
							array("slug"=>"icon-folder-close-alt", "name"=>"icon-folder-close-alt"),
							array("slug"=>"icon-folder-open-alt", "name"=>"icon-folder-open-alt"),
							array("slug"=>"icon-adjust", "name"=>"icon-adjust"),
							array("slug"=>"icon-asterisk", "name"=>"icon-asterisk"),
							array("slug"=>"icon-ban-circle", "name"=>"icon-ban-circle"),
							array("slug"=>"icon-bar-chart", "name"=>"icon-bar-chart"),
							array("slug"=>"icon-barcode", "name"=>"icon-barcode"),
							array("slug"=>"icon-beaker", "name"=>"icon-beaker"),
							array("slug"=>"icon-beer", "name"=>"icon-beer"),
							array("slug"=>"icon-bell", "name"=>"icon-bell"),
							array("slug"=>"icon-bell-alt", "name"=>"icon-bell-alt"),
							array("slug"=>"icon-bolt", "name"=>"icon-bolt"),
							array("slug"=>"icon-book", "name"=>"icon-book"),
							array("slug"=>"icon-bookmark", "name"=>"icon-bookmark"),
							array("slug"=>"icon-bookmark-empty", "name"=>"icon-bookmark-empty"),
							array("slug"=>"icon-briefcase", "name"=>"icon-briefcase"),
							array("slug"=>"icon-bullhorn", "name"=>"icon-bullhorn"),
							array("slug"=>"icon-calendar", "name"=>"icon-calendar"),
							array("slug"=>"icon-camera", "name"=>"icon-camera"),
							array("slug"=>"icon-camera-retro", "name"=>"icon-camera-retro"),
							array("slug"=>"icon-certificate", "name"=>"icon-certificate"),
							array("slug"=>"icon-check", "name"=>"icon-check"),
							array("slug"=>"icon-check-empty", "name"=>"icon-check-empty"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-cloud", "name"=>"icon-cloud"),
							array("slug"=>"icon-cloud-download", "name"=>"icon-cloud-download"),
							array("slug"=>"icon-cloud-upload", "name"=>"icon-cloud-upload"),
							array("slug"=>"icon-coffee", "name"=>"icon-coffee"),
							array("slug"=>"icon-cog", "name"=>"icon-cog"),
							array("slug"=>"icon-cogs", "name"=>"icon-cogs"),
							array("slug"=>"icon-comment", "name"=>"icon-comment"),
							array("slug"=>"icon-comment-alt", "name"=>"icon-comment-alt"),
							array("slug"=>"icon-comments", "name"=>"icon-comments"),
							array("slug"=>"icon-comments-alt", "name"=>"icon-comments-alt"),
							array("slug"=>"icon-credit-card", "name"=>"icon-credit-card"),
							array("slug"=>"icon-dashboard", "name"=>"icon-dashboard"),
							array("slug"=>"icon-desktop", "name"=>"icon-desktop"),
							array("slug"=>"icon-download", "name"=>"icon-download"),
							array("slug"=>"icon-download-alt", "name"=>"icon-download-alt"),
							array("slug"=>"icon-edit", "name"=>"icon-edit"),
							array("slug"=>"icon-envelope", "name"=>"icon-envelope"),
							array("slug"=>"icon-envelope-alt", "name"=>"icon-envelope-alt"),
							array("slug"=>"icon-exchange", "name"=>"icon-exchange"),
							array("slug"=>"icon-exclamation-sign", "name"=>"icon-exclamation-sign"),
							array("slug"=>"icon-external-link", "name"=>"icon-external-link"),
							array("slug"=>"icon-eye-close", "name"=>"icon-eye-close"),
							array("slug"=>"icon-eye-open", "name"=>"icon-eye-open"),
							array("slug"=>"icon-facetime-video", "name"=>"icon-facetime-video"),
							array("slug"=>"icon-fighter-jet", "name"=>"icon-fighter-jet"),
							array("slug"=>"icon-film", "name"=>"icon-film"),
							array("slug"=>"icon-filter", "name"=>"icon-filter"),
							array("slug"=>"icon-fire", "name"=>"icon-fire"),
							array("slug"=>"icon-flag", "name"=>"icon-flag"),
							array("slug"=>"icon-folder-close", "name"=>"icon-folder-close"),
							array("slug"=>"icon-folder-open", "name"=>"icon-folder-open"),
							array("slug"=>"icon-folder-close-alt", "name"=>"icon-folder-close-alt"),
							array("slug"=>"icon-folder-open-alt", "name"=>"icon-folder-open-alt"),
							array("slug"=>"icon-food", "name"=>"icon-food"),
							array("slug"=>"icon-gift", "name"=>"icon-gift"),
							array("slug"=>"icon-glass", "name"=>"icon-glass"),
							array("slug"=>"icon-globe", "name"=>"icon-globe"),
							array("slug"=>"icon-group", "name"=>"icon-group"),
							array("slug"=>"icon-hdd", "name"=>"icon-hdd"),
							array("slug"=>"icon-headphones", "name"=>"icon-headphones"),
							array("slug"=>"icon-heart", "name"=>"icon-heart"),
							array("slug"=>"icon-heart-empty", "name"=>"icon-heart-empty"),
							array("slug"=>"icon-home", "name"=>"icon-home"),
							array("slug"=>"icon-inbox", "name"=>"icon-inbox"),
							array("slug"=>"icon-info-sign", "name"=>"icon-info-sign"),
							array("slug"=>"icon-key", "name"=>"icon-key"),
							array("slug"=>"icon-leaf", "name"=>"icon-leaf"),
							array("slug"=>"icon-laptop", "name"=>"icon-laptop"),
							array("slug"=>"icon-legal", "name"=>"icon-legal"),
							array("slug"=>"icon-lemon", "name"=>"icon-lemon"),
							array("slug"=>"icon-lightbulb", "name"=>"icon-lightbulb"),
							array("slug"=>"icon-lock", "name"=>"icon-lock"),
							array("slug"=>"icon-unlock", "name"=>"icon-unlock"),
							array("slug"=>"icon-magic", "name"=>"icon-magic"),
							array("slug"=>"icon-magnet", "name"=>"icon-magnet"),
							array("slug"=>"icon-map-marker", "name"=>"icon-map-marker"),
							array("slug"=>"icon-minus", "name"=>"icon-minus"),
							array("slug"=>"icon-minus-sign", "name"=>"icon-minus-sign"),
							array("slug"=>"icon-mobile-phone", "name"=>"icon-mobile-phone"),
							array("slug"=>"icon-money", "name"=>"icon-money"),
							array("slug"=>"icon-move", "name"=>"icon-move"),
							array("slug"=>"icon-music", "name"=>"icon-music"),
							array("slug"=>"icon-off", "name"=>"icon-off"),
							array("slug"=>"icon-ok", "name"=>"icon-ok"),
							array("slug"=>"icon-ok-circle", "name"=>"icon-ok-circle"),
							array("slug"=>"icon-ok-sign", "name"=>"icon-ok-sign"),
							array("slug"=>"icon-pencil", "name"=>"icon-pencil"),
							array("slug"=>"icon-picture", "name"=>"icon-picture"),
							array("slug"=>"icon-plane", "name"=>"icon-plane"),
							array("slug"=>"icon-plus", "name"=>"icon-plus"),
							array("slug"=>"icon-plus-sign", "name"=>"icon-plus-sign"),
							array("slug"=>"icon-print", "name"=>"icon-print"),
							array("slug"=>"icon-pushpin", "name"=>"icon-pushpin"),
							array("slug"=>"icon-qrcode", "name"=>"icon-qrcode"),
							array("slug"=>"icon-question-sign", "name"=>"icon-question-sign"),
							array("slug"=>"icon-quote-left", "name"=>"icon-quote-left"),
							array("slug"=>"icon-quote-right", "name"=>"icon-quote-right"),
							array("slug"=>"icon-random", "name"=>"icon-random"),
							array("slug"=>"icon-refresh", "name"=>"icon-refresh"),
							array("slug"=>"icon-remove", "name"=>"icon-remove"),
							array("slug"=>"icon-remove-circle", "name"=>"icon-remove-circle"),
							array("slug"=>"icon-remove-sign", "name"=>"icon-remove-sign"),
							array("slug"=>"icon-reorder", "name"=>"icon-reorder"),
							array("slug"=>"icon-reply", "name"=>"icon-reply"),
							array("slug"=>"icon-resize-horizontal", "name"=>"icon-resize-horizontal"),
							array("slug"=>"icon-resize-vertical", "name"=>"icon-resize-vertical"),
							array("slug"=>"icon-retweet", "name"=>"icon-retweet"),
							array("slug"=>"icon-road", "name"=>"icon-road"),
							array("slug"=>"icon-rss", "name"=>"icon-rss"),
							array("slug"=>"icon-screenshot", "name"=>"icon-screenshot"),
							array("slug"=>"icon-search", "name"=>"icon-search"),
							array("slug"=>"icon-share", "name"=>"icon-share"),
							array("slug"=>"icon-share-alt", "name"=>"icon-share-alt"),
							array("slug"=>"icon-shopping-cart", "name"=>"icon-shopping-cart"),
							array("slug"=>"icon-signal", "name"=>"icon-signal"),
							array("slug"=>"icon-signin", "name"=>"icon-signin"),
							array("slug"=>"icon-signout", "name"=>"icon-signout"),
							array("slug"=>"icon-sitemap", "name"=>"icon-sitemap"),
							array("slug"=>"icon-sort", "name"=>"icon-sort"),
							array("slug"=>"icon-sort-down", "name"=>"icon-sort-down"),
							array("slug"=>"icon-sort-up", "name"=>"icon-sort-up"),
							array("slug"=>"icon-spinner", "name"=>"icon-spinner"),
							array("slug"=>"icon-star", "name"=>"icon-star"),
							array("slug"=>"icon-star-empty", "name"=>"icon-star-empty"),
							array("slug"=>"icon-star-half", "name"=>"icon-star-half"),
							array("slug"=>"icon-tablet", "name"=>"icon-tablet"),
							array("slug"=>"icon-tag", "name"=>"icon-tag"),
							array("slug"=>"icon-tags", "name"=>"icon-tags"),
							array("slug"=>"icon-tasks", "name"=>"icon-tasks"),
							array("slug"=>"icon-thumbs-down", "name"=>"icon-thumbs-down"),
							array("slug"=>"icon-thumbs-up", "name"=>"icon-thumbs-up"),
							array("slug"=>"icon-time", "name"=>"icon-time"),
							array("slug"=>"icon-tint", "name"=>"icon-tint"),
							array("slug"=>"icon-trash", "name"=>"icon-trash"),
							array("slug"=>"icon-trophy", "name"=>"icon-trophy"),
							array("slug"=>"icon-truck", "name"=>"icon-truck"),
							array("slug"=>"icon-umbrella", "name"=>"icon-umbrella"),
							array("slug"=>"icon-upload", "name"=>"icon-upload"),
							array("slug"=>"icon-upload-alt", "name"=>"icon-upload-alt"),
							array("slug"=>"icon-user", "name"=>"icon-user"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
							array("slug"=>"icon-volume-off", "name"=>"icon-volume-off"),
							array("slug"=>"icon-volume-down", "name"=>"icon-volume-down"),
							array("slug"=>"icon-volume-up", "name"=>"icon-volume-up"),
							array("slug"=>"icon-warning-sign", "name"=>"icon-warning-sign"),
							array("slug"=>"icon-wrench", "name"=>"icon-wrench"),
							array("slug"=>"icon-zoom-in", "name"=>"icon-zoom-in"),
							array("slug"=>"icon-zoom-out", "name"=>"icon-zoom-out"),
							array("slug"=>"icon-file", "name"=>"icon-file"),
							array("slug"=>"icon-file-alt", "name"=>"icon-file-alt"),
							array("slug"=>"icon-cut", "name"=>"icon-cut"),
							array("slug"=>"icon-copy", "name"=>"icon-copy"),
							array("slug"=>"icon-paste", "name"=>"icon-paste"),
							array("slug"=>"icon-save", "name"=>"icon-save"),
							array("slug"=>"icon-undo", "name"=>"icon-undo"),
							array("slug"=>"icon-repeat", "name"=>"icon-repeat"),
							array("slug"=>"icon-text-height", "name"=>"icon-text-height"),
							array("slug"=>"icon-text-width", "name"=>"icon-text-width"),
							array("slug"=>"icon-align-left", "name"=>"icon-align-left"),
							array("slug"=>"icon-align-center", "name"=>"icon-align-center"),
							array("slug"=>"icon-align-right", "name"=>"icon-align-right"),
							array("slug"=>"icon-align-justify", "name"=>"icon-align-justify"),
							array("slug"=>"icon-indent-left", "name"=>"icon-indent-left"),
							array("slug"=>"icon-indent-right", "name"=>"icon-indent-right"),
							array("slug"=>"icon-font", "name"=>"icon-font"),
							array("slug"=>"icon-bold", "name"=>"icon-bold"),
							array("slug"=>"icon-italic", "name"=>"icon-italic"),
							array("slug"=>"icon-strikethrough", "name"=>"icon-strikethrough"),
							array("slug"=>"icon-underline", "name"=>"icon-underline"),
							array("slug"=>"icon-link", "name"=>"icon-link"),
							array("slug"=>"icon-paper-clip", "name"=>"icon-paper-clip"),
							array("slug"=>"icon-columns", "name"=>"icon-columns"),
							array("slug"=>"icon-table", "name"=>"icon-table"),
							array("slug"=>"icon-th-large", "name"=>"icon-th-large"),
							array("slug"=>"icon-th", "name"=>"icon-th"),
							array("slug"=>"icon-th-list", "name"=>"icon-th-list"),
							array("slug"=>"icon-list", "name"=>"icon-list"),
							array("slug"=>"icon-list-ol", "name"=>"icon-list-ol"),
							array("slug"=>"icon-list-ul", "name"=>"icon-list-ul"),
							array("slug"=>"icon-list-alt", "name"=>"icon-list-alt"),
							array("slug"=>"icon-angle-left", "name"=>"icon-angle-left"),
							array("slug"=>"icon-angle-right", "name"=>"icon-angle-right"),
							array("slug"=>"icon-angle-up", "name"=>"icon-angle-up"),
							array("slug"=>"icon-angle-down", "name"=>"icon-angle-down"),
							array("slug"=>"icon-arrow-down", "name"=>"icon-arrow-down"),
							array("slug"=>"icon-arrow-left", "name"=>"icon-arrow-left"),
							array("slug"=>"icon-arrow-right", "name"=>"icon-arrow-right"),
							array("slug"=>"icon-arrow-up", "name"=>"icon-arrow-up"),
							array("slug"=>"icon-caret-down", "name"=>"icon-caret-down"),
							array("slug"=>"icon-caret-left", "name"=>"icon-caret-left"),
							array("slug"=>"icon-caret-right", "name"=>"icon-caret-right"),
							array("slug"=>"icon-caret-up", "name"=>"icon-caret-up"),
							array("slug"=>"icon-chevron-down", "name"=>"icon-chevron-down"),
							array("slug"=>"icon-chevron-left", "name"=>"icon-chevron-left"),
							array("slug"=>"icon-chevron-right", "name"=>"icon-chevron-right"),
							array("slug"=>"icon-chevron-up", "name"=>"icon-chevron-up"),
							array("slug"=>"icon-circle-arrow-down", "name"=>"icon-circle-arrow-down"),
							array("slug"=>"icon-circle-arrow-left", "name"=>"icon-circle-arrow-left"),
							array("slug"=>"icon-circle-arrow-right", "name"=>"icon-circle-arrow-right"),
							array("slug"=>"icon-circle-arrow-up", "name"=>"icon-circle-arrow-up"),
							array("slug"=>"icon-double-angle-left", "name"=>"icon-double-angle-left"),
							array("slug"=>"icon-double-angle-right", "name"=>"icon-double-angle-right"),
							array("slug"=>"icon-double-angle-up", "name"=>"icon-double-angle-up"),
							array("slug"=>"icon-double-angle-down", "name"=>"icon-double-angle-down"),
							array("slug"=>"icon-hand-down", "name"=>"icon-hand-down"),
							array("slug"=>"icon-hand-left", "name"=>"icon-hand-left"),
							array("slug"=>"icon-hand-right", "name"=>"icon-hand-right"),
							array("slug"=>"icon-hand-up", "name"=>"icon-hand-up"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-play-circle", "name"=>"icon-play-circle"),
							array("slug"=>"icon-play", "name"=>"icon-play"),
							array("slug"=>"icon-pause", "name"=>"icon-pause"),
							array("slug"=>"icon-stop", "name"=>"icon-stop"),
							array("slug"=>"icon-step-backward", "name"=>"icon-step-backward"),
							array("slug"=>"icon-fast-backward", "name"=>"icon-fast-backward"),
							array("slug"=>"icon-backward", "name"=>"icon-backward"),
							array("slug"=>"icon-forward", "name"=>"icon-forward"),
							array("slug"=>"icon-fast-forward", "name"=>"icon-fast-forward"),
							array("slug"=>"icon-step-forward", "name"=>"icon-step-forward"),
							array("slug"=>"icon-eject", "name"=>"icon-eject"),
							array("slug"=>"icon-fullscreen", "name"=>"icon-fullscreen"),
							array("slug"=>"icon-resize-full", "name"=>"icon-resize-full"),
							array("slug"=>"icon-resize-small", "name"=>"icon-resize-small"),
							array("slug"=>"icon-phone", "name"=>"icon-phone"),
							array("slug"=>"icon-phone-sign", "name"=>"icon-phone-sign"),
							array("slug"=>"icon-facebook", "name"=>"icon-facebook"),
							array("slug"=>"icon-facebook-sign", "name"=>"icon-facebook-sign"),
							array("slug"=>"icon-twitter", "name"=>"icon-twitter"),
							array("slug"=>"icon-twitter-sign", "name"=>"icon-twitter-sign"),
							array("slug"=>"icon-github", "name"=>"icon-github"),
							array("slug"=>"icon-github-alt", "name"=>"icon-github-alt"),
							array("slug"=>"icon-github-sign", "name"=>"icon-github-sign"),
							array("slug"=>"icon-linkedin", "name"=>"icon-linkedin"),
							array("slug"=>"icon-linkedin-sign", "name"=>"icon-linkedin-sign"),
							array("slug"=>"icon-pinterest", "name"=>"icon-pinterest"),
							array("slug"=>"icon-pinterest-sign", "name"=>"icon-pinterest-sign"),
							array("slug"=>"icon-google-plus", "name"=>"icon-google-plus"),
							array("slug"=>"icon-google-plus-sign", "name"=>"icon-google-plus-sign"),
							array("slug"=>"icon-sign-blank", "name"=>"icon-sign-blank"),
							array("slug"=>"icon-ambulance", "name"=>"icon-ambulance"),
							array("slug"=>"icon-beaker", "name"=>"icon-beaker"),
							array("slug"=>"icon-h-sign", "name"=>"icon-h-sign"),
							array("slug"=>"icon-hospital", "name"=>"icon-hospital"),
							array("slug"=>"icon-medkit", "name"=>"icon-medkit"),
							array("slug"=>"icon-plus-sign-alt", "name"=>"icon-plus-sign-alt"),
							array("slug"=>"icon-stethoscope", "name"=>"icon-stethoscope"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
						),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_title_4", "title" => "Block Title 4:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_text_4", "title" => "Block Text 4:", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $different_themes_managment->themeslug."_homepage_4_info_blocks_icon_4",
					"title" => "Block Icon 4:",
						"options"=>array(
							array("slug"=>"icon-cloud-download", "name"=>"icon-cloud-download"),
							array("slug"=>"icon-cloud-upload", "name"=>"icon-cloud-upload"),
							array("slug"=>"icon-lightbulb", "name"=>"icon-lightbulb"),
							array("slug"=>"icon-exchange", "name"=>"icon-exchange"),
							array("slug"=>"icon-bell-alt", "name"=>"icon-bell-alt"),
							array("slug"=>"icon-file-alt", "name"=>"icon-file-alt"),
							array("slug"=>"icon-beer", "name"=>"icon-beer"),
							array("slug"=>"icon-coffee", "name"=>"icon-coffee"),
							array("slug"=>"icon-food", "name"=>"icon-food"),
							array("slug"=>"icon-fighter-jet", "name"=>"icon-fighter-jet"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
							array("slug"=>"icon-stethoscope", "name"=>"icon-stethoscope"),
							array("slug"=>"icon-suitcase", "name"=>"icon-suitcase"),
							array("slug"=>"icon-building", "name"=>"icon-building"),
							array("slug"=>"icon-hospital", "name"=>"icon-hospital"),
							array("slug"=>"icon-ambulance", "name"=>"icon-ambulance"),
							array("slug"=>"icon-medkit", "name"=>"icon-medkit"),
							array("slug"=>"icon-h-sign", "name"=>"icon-h-sign"),
							array("slug"=>"icon-plus-sign-alt", "name"=>"icon-plus-sign-alt"),
							array("slug"=>"icon-spinner", "name"=>"icon-spinner"),
							array("slug"=>"icon-angle-left", "name"=>"icon-angle-left"),
							array("slug"=>"icon-angle-right", "name"=>"icon-angle-right"),
							array("slug"=>"icon-angle-up", "name"=>"icon-angle-up"),
							array("slug"=>"icon-angle-down", "name"=>"icon-angle-down"),
							array("slug"=>"icon-double-angle-left", "name"=>"icon-double-angle-left"),
							array("slug"=>"icon-double-angle-right", "name"=>"icon-double-angle-right"),
							array("slug"=>"icon-double-angle-up", "name"=>"icon-double-angle-up"),
							array("slug"=>"icon-double-angle-down", "name"=>"icon-double-angle-down"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-desktop", "name"=>"icon-desktop"),
							array("slug"=>"icon-laptop", "name"=>"icon-laptop"),
							array("slug"=>"icon-tablet", "name"=>"icon-tablet"),
							array("slug"=>"icon-mobile-phone", "name"=>"icon-mobile-phone"),
							array("slug"=>"icon-quote-left", "name"=>"icon-quote-left"),
							array("slug"=>"icon-quote-right", "name"=>"icon-quote-right"),
							array("slug"=>"icon-reply", "name"=>"icon-reply"),
							array("slug"=>"icon-github-alt", "name"=>"icon-github-alt"),
							array("slug"=>"icon-folder-close-alt", "name"=>"icon-folder-close-alt"),
							array("slug"=>"icon-folder-open-alt", "name"=>"icon-folder-open-alt"),
							array("slug"=>"icon-adjust", "name"=>"icon-adjust"),
							array("slug"=>"icon-asterisk", "name"=>"icon-asterisk"),
							array("slug"=>"icon-ban-circle", "name"=>"icon-ban-circle"),
							array("slug"=>"icon-bar-chart", "name"=>"icon-bar-chart"),
							array("slug"=>"icon-barcode", "name"=>"icon-barcode"),
							array("slug"=>"icon-beaker", "name"=>"icon-beaker"),
							array("slug"=>"icon-beer", "name"=>"icon-beer"),
							array("slug"=>"icon-bell", "name"=>"icon-bell"),
							array("slug"=>"icon-bell-alt", "name"=>"icon-bell-alt"),
							array("slug"=>"icon-bolt", "name"=>"icon-bolt"),
							array("slug"=>"icon-book", "name"=>"icon-book"),
							array("slug"=>"icon-bookmark", "name"=>"icon-bookmark"),
							array("slug"=>"icon-bookmark-empty", "name"=>"icon-bookmark-empty"),
							array("slug"=>"icon-briefcase", "name"=>"icon-briefcase"),
							array("slug"=>"icon-bullhorn", "name"=>"icon-bullhorn"),
							array("slug"=>"icon-calendar", "name"=>"icon-calendar"),
							array("slug"=>"icon-camera", "name"=>"icon-camera"),
							array("slug"=>"icon-camera-retro", "name"=>"icon-camera-retro"),
							array("slug"=>"icon-certificate", "name"=>"icon-certificate"),
							array("slug"=>"icon-check", "name"=>"icon-check"),
							array("slug"=>"icon-check-empty", "name"=>"icon-check-empty"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-cloud", "name"=>"icon-cloud"),
							array("slug"=>"icon-cloud-download", "name"=>"icon-cloud-download"),
							array("slug"=>"icon-cloud-upload", "name"=>"icon-cloud-upload"),
							array("slug"=>"icon-coffee", "name"=>"icon-coffee"),
							array("slug"=>"icon-cog", "name"=>"icon-cog"),
							array("slug"=>"icon-cogs", "name"=>"icon-cogs"),
							array("slug"=>"icon-comment", "name"=>"icon-comment"),
							array("slug"=>"icon-comment-alt", "name"=>"icon-comment-alt"),
							array("slug"=>"icon-comments", "name"=>"icon-comments"),
							array("slug"=>"icon-comments-alt", "name"=>"icon-comments-alt"),
							array("slug"=>"icon-credit-card", "name"=>"icon-credit-card"),
							array("slug"=>"icon-dashboard", "name"=>"icon-dashboard"),
							array("slug"=>"icon-desktop", "name"=>"icon-desktop"),
							array("slug"=>"icon-download", "name"=>"icon-download"),
							array("slug"=>"icon-download-alt", "name"=>"icon-download-alt"),
							array("slug"=>"icon-edit", "name"=>"icon-edit"),
							array("slug"=>"icon-envelope", "name"=>"icon-envelope"),
							array("slug"=>"icon-envelope-alt", "name"=>"icon-envelope-alt"),
							array("slug"=>"icon-exchange", "name"=>"icon-exchange"),
							array("slug"=>"icon-exclamation-sign", "name"=>"icon-exclamation-sign"),
							array("slug"=>"icon-external-link", "name"=>"icon-external-link"),
							array("slug"=>"icon-eye-close", "name"=>"icon-eye-close"),
							array("slug"=>"icon-eye-open", "name"=>"icon-eye-open"),
							array("slug"=>"icon-facetime-video", "name"=>"icon-facetime-video"),
							array("slug"=>"icon-fighter-jet", "name"=>"icon-fighter-jet"),
							array("slug"=>"icon-film", "name"=>"icon-film"),
							array("slug"=>"icon-filter", "name"=>"icon-filter"),
							array("slug"=>"icon-fire", "name"=>"icon-fire"),
							array("slug"=>"icon-flag", "name"=>"icon-flag"),
							array("slug"=>"icon-folder-close", "name"=>"icon-folder-close"),
							array("slug"=>"icon-folder-open", "name"=>"icon-folder-open"),
							array("slug"=>"icon-folder-close-alt", "name"=>"icon-folder-close-alt"),
							array("slug"=>"icon-folder-open-alt", "name"=>"icon-folder-open-alt"),
							array("slug"=>"icon-food", "name"=>"icon-food"),
							array("slug"=>"icon-gift", "name"=>"icon-gift"),
							array("slug"=>"icon-glass", "name"=>"icon-glass"),
							array("slug"=>"icon-globe", "name"=>"icon-globe"),
							array("slug"=>"icon-group", "name"=>"icon-group"),
							array("slug"=>"icon-hdd", "name"=>"icon-hdd"),
							array("slug"=>"icon-headphones", "name"=>"icon-headphones"),
							array("slug"=>"icon-heart", "name"=>"icon-heart"),
							array("slug"=>"icon-heart-empty", "name"=>"icon-heart-empty"),
							array("slug"=>"icon-home", "name"=>"icon-home"),
							array("slug"=>"icon-inbox", "name"=>"icon-inbox"),
							array("slug"=>"icon-info-sign", "name"=>"icon-info-sign"),
							array("slug"=>"icon-key", "name"=>"icon-key"),
							array("slug"=>"icon-leaf", "name"=>"icon-leaf"),
							array("slug"=>"icon-laptop", "name"=>"icon-laptop"),
							array("slug"=>"icon-legal", "name"=>"icon-legal"),
							array("slug"=>"icon-lemon", "name"=>"icon-lemon"),
							array("slug"=>"icon-lightbulb", "name"=>"icon-lightbulb"),
							array("slug"=>"icon-lock", "name"=>"icon-lock"),
							array("slug"=>"icon-unlock", "name"=>"icon-unlock"),
							array("slug"=>"icon-magic", "name"=>"icon-magic"),
							array("slug"=>"icon-magnet", "name"=>"icon-magnet"),
							array("slug"=>"icon-map-marker", "name"=>"icon-map-marker"),
							array("slug"=>"icon-minus", "name"=>"icon-minus"),
							array("slug"=>"icon-minus-sign", "name"=>"icon-minus-sign"),
							array("slug"=>"icon-mobile-phone", "name"=>"icon-mobile-phone"),
							array("slug"=>"icon-money", "name"=>"icon-money"),
							array("slug"=>"icon-move", "name"=>"icon-move"),
							array("slug"=>"icon-music", "name"=>"icon-music"),
							array("slug"=>"icon-off", "name"=>"icon-off"),
							array("slug"=>"icon-ok", "name"=>"icon-ok"),
							array("slug"=>"icon-ok-circle", "name"=>"icon-ok-circle"),
							array("slug"=>"icon-ok-sign", "name"=>"icon-ok-sign"),
							array("slug"=>"icon-pencil", "name"=>"icon-pencil"),
							array("slug"=>"icon-picture", "name"=>"icon-picture"),
							array("slug"=>"icon-plane", "name"=>"icon-plane"),
							array("slug"=>"icon-plus", "name"=>"icon-plus"),
							array("slug"=>"icon-plus-sign", "name"=>"icon-plus-sign"),
							array("slug"=>"icon-print", "name"=>"icon-print"),
							array("slug"=>"icon-pushpin", "name"=>"icon-pushpin"),
							array("slug"=>"icon-qrcode", "name"=>"icon-qrcode"),
							array("slug"=>"icon-question-sign", "name"=>"icon-question-sign"),
							array("slug"=>"icon-quote-left", "name"=>"icon-quote-left"),
							array("slug"=>"icon-quote-right", "name"=>"icon-quote-right"),
							array("slug"=>"icon-random", "name"=>"icon-random"),
							array("slug"=>"icon-refresh", "name"=>"icon-refresh"),
							array("slug"=>"icon-remove", "name"=>"icon-remove"),
							array("slug"=>"icon-remove-circle", "name"=>"icon-remove-circle"),
							array("slug"=>"icon-remove-sign", "name"=>"icon-remove-sign"),
							array("slug"=>"icon-reorder", "name"=>"icon-reorder"),
							array("slug"=>"icon-reply", "name"=>"icon-reply"),
							array("slug"=>"icon-resize-horizontal", "name"=>"icon-resize-horizontal"),
							array("slug"=>"icon-resize-vertical", "name"=>"icon-resize-vertical"),
							array("slug"=>"icon-retweet", "name"=>"icon-retweet"),
							array("slug"=>"icon-road", "name"=>"icon-road"),
							array("slug"=>"icon-rss", "name"=>"icon-rss"),
							array("slug"=>"icon-screenshot", "name"=>"icon-screenshot"),
							array("slug"=>"icon-search", "name"=>"icon-search"),
							array("slug"=>"icon-share", "name"=>"icon-share"),
							array("slug"=>"icon-share-alt", "name"=>"icon-share-alt"),
							array("slug"=>"icon-shopping-cart", "name"=>"icon-shopping-cart"),
							array("slug"=>"icon-signal", "name"=>"icon-signal"),
							array("slug"=>"icon-signin", "name"=>"icon-signin"),
							array("slug"=>"icon-signout", "name"=>"icon-signout"),
							array("slug"=>"icon-sitemap", "name"=>"icon-sitemap"),
							array("slug"=>"icon-sort", "name"=>"icon-sort"),
							array("slug"=>"icon-sort-down", "name"=>"icon-sort-down"),
							array("slug"=>"icon-sort-up", "name"=>"icon-sort-up"),
							array("slug"=>"icon-spinner", "name"=>"icon-spinner"),
							array("slug"=>"icon-star", "name"=>"icon-star"),
							array("slug"=>"icon-star-empty", "name"=>"icon-star-empty"),
							array("slug"=>"icon-star-half", "name"=>"icon-star-half"),
							array("slug"=>"icon-tablet", "name"=>"icon-tablet"),
							array("slug"=>"icon-tag", "name"=>"icon-tag"),
							array("slug"=>"icon-tags", "name"=>"icon-tags"),
							array("slug"=>"icon-tasks", "name"=>"icon-tasks"),
							array("slug"=>"icon-thumbs-down", "name"=>"icon-thumbs-down"),
							array("slug"=>"icon-thumbs-up", "name"=>"icon-thumbs-up"),
							array("slug"=>"icon-time", "name"=>"icon-time"),
							array("slug"=>"icon-tint", "name"=>"icon-tint"),
							array("slug"=>"icon-trash", "name"=>"icon-trash"),
							array("slug"=>"icon-trophy", "name"=>"icon-trophy"),
							array("slug"=>"icon-truck", "name"=>"icon-truck"),
							array("slug"=>"icon-umbrella", "name"=>"icon-umbrella"),
							array("slug"=>"icon-upload", "name"=>"icon-upload"),
							array("slug"=>"icon-upload-alt", "name"=>"icon-upload-alt"),
							array("slug"=>"icon-user", "name"=>"icon-user"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
							array("slug"=>"icon-volume-off", "name"=>"icon-volume-off"),
							array("slug"=>"icon-volume-down", "name"=>"icon-volume-down"),
							array("slug"=>"icon-volume-up", "name"=>"icon-volume-up"),
							array("slug"=>"icon-warning-sign", "name"=>"icon-warning-sign"),
							array("slug"=>"icon-wrench", "name"=>"icon-wrench"),
							array("slug"=>"icon-zoom-in", "name"=>"icon-zoom-in"),
							array("slug"=>"icon-zoom-out", "name"=>"icon-zoom-out"),
							array("slug"=>"icon-file", "name"=>"icon-file"),
							array("slug"=>"icon-file-alt", "name"=>"icon-file-alt"),
							array("slug"=>"icon-cut", "name"=>"icon-cut"),
							array("slug"=>"icon-copy", "name"=>"icon-copy"),
							array("slug"=>"icon-paste", "name"=>"icon-paste"),
							array("slug"=>"icon-save", "name"=>"icon-save"),
							array("slug"=>"icon-undo", "name"=>"icon-undo"),
							array("slug"=>"icon-repeat", "name"=>"icon-repeat"),
							array("slug"=>"icon-text-height", "name"=>"icon-text-height"),
							array("slug"=>"icon-text-width", "name"=>"icon-text-width"),
							array("slug"=>"icon-align-left", "name"=>"icon-align-left"),
							array("slug"=>"icon-align-center", "name"=>"icon-align-center"),
							array("slug"=>"icon-align-right", "name"=>"icon-align-right"),
							array("slug"=>"icon-align-justify", "name"=>"icon-align-justify"),
							array("slug"=>"icon-indent-left", "name"=>"icon-indent-left"),
							array("slug"=>"icon-indent-right", "name"=>"icon-indent-right"),
							array("slug"=>"icon-font", "name"=>"icon-font"),
							array("slug"=>"icon-bold", "name"=>"icon-bold"),
							array("slug"=>"icon-italic", "name"=>"icon-italic"),
							array("slug"=>"icon-strikethrough", "name"=>"icon-strikethrough"),
							array("slug"=>"icon-underline", "name"=>"icon-underline"),
							array("slug"=>"icon-link", "name"=>"icon-link"),
							array("slug"=>"icon-paper-clip", "name"=>"icon-paper-clip"),
							array("slug"=>"icon-columns", "name"=>"icon-columns"),
							array("slug"=>"icon-table", "name"=>"icon-table"),
							array("slug"=>"icon-th-large", "name"=>"icon-th-large"),
							array("slug"=>"icon-th", "name"=>"icon-th"),
							array("slug"=>"icon-th-list", "name"=>"icon-th-list"),
							array("slug"=>"icon-list", "name"=>"icon-list"),
							array("slug"=>"icon-list-ol", "name"=>"icon-list-ol"),
							array("slug"=>"icon-list-ul", "name"=>"icon-list-ul"),
							array("slug"=>"icon-list-alt", "name"=>"icon-list-alt"),
							array("slug"=>"icon-angle-left", "name"=>"icon-angle-left"),
							array("slug"=>"icon-angle-right", "name"=>"icon-angle-right"),
							array("slug"=>"icon-angle-up", "name"=>"icon-angle-up"),
							array("slug"=>"icon-angle-down", "name"=>"icon-angle-down"),
							array("slug"=>"icon-arrow-down", "name"=>"icon-arrow-down"),
							array("slug"=>"icon-arrow-left", "name"=>"icon-arrow-left"),
							array("slug"=>"icon-arrow-right", "name"=>"icon-arrow-right"),
							array("slug"=>"icon-arrow-up", "name"=>"icon-arrow-up"),
							array("slug"=>"icon-caret-down", "name"=>"icon-caret-down"),
							array("slug"=>"icon-caret-left", "name"=>"icon-caret-left"),
							array("slug"=>"icon-caret-right", "name"=>"icon-caret-right"),
							array("slug"=>"icon-caret-up", "name"=>"icon-caret-up"),
							array("slug"=>"icon-chevron-down", "name"=>"icon-chevron-down"),
							array("slug"=>"icon-chevron-left", "name"=>"icon-chevron-left"),
							array("slug"=>"icon-chevron-right", "name"=>"icon-chevron-right"),
							array("slug"=>"icon-chevron-up", "name"=>"icon-chevron-up"),
							array("slug"=>"icon-circle-arrow-down", "name"=>"icon-circle-arrow-down"),
							array("slug"=>"icon-circle-arrow-left", "name"=>"icon-circle-arrow-left"),
							array("slug"=>"icon-circle-arrow-right", "name"=>"icon-circle-arrow-right"),
							array("slug"=>"icon-circle-arrow-up", "name"=>"icon-circle-arrow-up"),
							array("slug"=>"icon-double-angle-left", "name"=>"icon-double-angle-left"),
							array("slug"=>"icon-double-angle-right", "name"=>"icon-double-angle-right"),
							array("slug"=>"icon-double-angle-up", "name"=>"icon-double-angle-up"),
							array("slug"=>"icon-double-angle-down", "name"=>"icon-double-angle-down"),
							array("slug"=>"icon-hand-down", "name"=>"icon-hand-down"),
							array("slug"=>"icon-hand-left", "name"=>"icon-hand-left"),
							array("slug"=>"icon-hand-right", "name"=>"icon-hand-right"),
							array("slug"=>"icon-hand-up", "name"=>"icon-hand-up"),
							array("slug"=>"icon-circle", "name"=>"icon-circle"),
							array("slug"=>"icon-circle-blank", "name"=>"icon-circle-blank"),
							array("slug"=>"icon-play-circle", "name"=>"icon-play-circle"),
							array("slug"=>"icon-play", "name"=>"icon-play"),
							array("slug"=>"icon-pause", "name"=>"icon-pause"),
							array("slug"=>"icon-stop", "name"=>"icon-stop"),
							array("slug"=>"icon-step-backward", "name"=>"icon-step-backward"),
							array("slug"=>"icon-fast-backward", "name"=>"icon-fast-backward"),
							array("slug"=>"icon-backward", "name"=>"icon-backward"),
							array("slug"=>"icon-forward", "name"=>"icon-forward"),
							array("slug"=>"icon-fast-forward", "name"=>"icon-fast-forward"),
							array("slug"=>"icon-step-forward", "name"=>"icon-step-forward"),
							array("slug"=>"icon-eject", "name"=>"icon-eject"),
							array("slug"=>"icon-fullscreen", "name"=>"icon-fullscreen"),
							array("slug"=>"icon-resize-full", "name"=>"icon-resize-full"),
							array("slug"=>"icon-resize-small", "name"=>"icon-resize-small"),
							array("slug"=>"icon-phone", "name"=>"icon-phone"),
							array("slug"=>"icon-phone-sign", "name"=>"icon-phone-sign"),
							array("slug"=>"icon-facebook", "name"=>"icon-facebook"),
							array("slug"=>"icon-facebook-sign", "name"=>"icon-facebook-sign"),
							array("slug"=>"icon-twitter", "name"=>"icon-twitter"),
							array("slug"=>"icon-twitter-sign", "name"=>"icon-twitter-sign"),
							array("slug"=>"icon-github", "name"=>"icon-github"),
							array("slug"=>"icon-github-alt", "name"=>"icon-github-alt"),
							array("slug"=>"icon-github-sign", "name"=>"icon-github-sign"),
							array("slug"=>"icon-linkedin", "name"=>"icon-linkedin"),
							array("slug"=>"icon-linkedin-sign", "name"=>"icon-linkedin-sign"),
							array("slug"=>"icon-pinterest", "name"=>"icon-pinterest"),
							array("slug"=>"icon-pinterest-sign", "name"=>"icon-pinterest-sign"),
							array("slug"=>"icon-google-plus", "name"=>"icon-google-plus"),
							array("slug"=>"icon-google-plus-sign", "name"=>"icon-google-plus-sign"),
							array("slug"=>"icon-sign-blank", "name"=>"icon-sign-blank"),
							array("slug"=>"icon-ambulance", "name"=>"icon-ambulance"),
							array("slug"=>"icon-beaker", "name"=>"icon-beaker"),
							array("slug"=>"icon-h-sign", "name"=>"icon-h-sign"),
							array("slug"=>"icon-hospital", "name"=>"icon-hospital"),
							array("slug"=>"icon-medkit", "name"=>"icon-medkit"),
							array("slug"=>"icon-plus-sign-alt", "name"=>"icon-plus-sign-alt"),
							array("slug"=>"icon-stethoscope", "name"=>"icon-stethoscope"),
							array("slug"=>"icon-user-md", "name"=>"icon-user-md"),
						),
					"home" => "yes"
				),

			),
		),
		array(
			"title" => "Featured Box",
			"type" => "homepage_featured_box",
			"options" => array(
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_featured_box_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $different_themes_managment->themeslug."_homepage_featured_box_text", "title" => "Text:", "home" => "yes" ),
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_featured_box_link", "title" => "Link:", "home" => "yes" ),
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_featured_box_link_text", "title" => "Button Text:", "home" => "yes" ),
			),
		),
		array(
			"title" => "Latest News",
			"type" => "homepage_main_news_block",
			"options" => array(
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_main_news_block_title", "title" => "Title:", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $different_themes_managment->themeslug."_homepage_main_news_block_type",
					"title" => "Post Type:",
						"options"=>array(
							array("slug"=>"post", "name"=>"Post"), 
							array("slug"=>"portfolio-item", "name"=>"Portfolio"),
							array("slug"=>"post,portfolio-item", "name"=>"Post & Portfolio"),
						),
					"home" => "yes"
				),
			),
		),

		array(
			"title" => "Latest News By Category",
			"type" => "homepage_cat_news_block",
			"options" => array(
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_cat_news_block_title", "title" => "Title:", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $different_themes_managment->themeslug."_homepage_cat_news_block_type",
					"title" => "Post Type:",
						"options"=>array(
							array("slug"=>"post", "name"=>"Post"), 
							array("slug"=>"portfolio-item", "name"=>"Portfolio"),
						),
					"home" => "yes",
					"class" => "otpost-type"
				),
				array(
					"type" => "categories",
					"id" => $different_themes_managment->themeslug."_homepage_cat_news_block_id",
					"taxonomy" => "category",
					"title" => "Set News Category",
					"home" => "yes",
					"class" => "ppid"
				),
				array(
					"type" => "categories",
					"id" => $different_themes_managment->themeslug."_homepage_cat_news_block_pid",
					"taxonomy" => "portfolio-cat",
					"title" => "Set News Category",
					"home" => "yes",
					"class" => "pid"
				),

			),
		),
		array(
			"title" => "HTML Code/Shortcode",
			"type" => "homepage_html",
			"options" => array(
				array( "type" => "textarea", "id" => $different_themes_managment->themeslug."_homepage_html", "title" => "HTML Code:", "home" => "yes" ),
			),
		),
		array(
			"title" => "Text Block",
			"type" => "homepage_text_block",
			"options" => array(
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_text_block_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $different_themes_managment->themeslug."_homepage_text_block_subtitle", "title" => "Subtitle:", "home" => "yes" ),
			),
		),
	)
),


array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),

/* ------------------------------------------------------------------------*
 * CONTACT SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "sub_tab",
	"slug"=>'contact'
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => "Header Contact Information"
),

array(
	"type" => "checkbox",
	"title" => "Enable Contact Information",
	"id" => $different_themes_managment->themeslug."_contac_info_header",
	"std" => "off"
),
array(
	"type" => "input",
	"title" => "Contact Phone:",
	"id" => $different_themes_managment->themeslug."_contac_phone_header",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_contac_info_header", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Contact Mail:",
	"id" => $different_themes_managment->themeslug."_contac_mail_header",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_contac_info_header", "value" => "on")
	)
),
array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => "Footer Contact Information"
),

array(
	"type" => "checkbox",
	"title" => "Enable Contact Information",
	"id" => $different_themes_managment->themeslug."_contac_info",
	"std" => "off"
),
array(
	"type" => "input",
	"title" => "Contact Information Title:",
	"id" => $different_themes_managment->themeslug."_contac_title",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_contac_info", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Contact Phone:",
	"id" => $different_themes_managment->themeslug."_contac_phone",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_contac_info", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Contact Mail:",
	"id" => $different_themes_managment->themeslug."_contac_mail",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_contac_info", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Contact Address:",
	"id" => $different_themes_managment->themeslug."_contac_address",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_contac_info", "value" => "on")
	)
),

array(
	"type" => "textarea",
	"title" => "Text:",
	"id" => $different_themes_managment->themeslug."_footer_text"
),
array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Contact Form"
),

array(
	"type" => "input",
	"title" => "Contact Form E-mail:",
	"id" => $different_themes_managment->themeslug."_contact_mail"
),
array(
	"type" => "input",
	"title" => "Contact Form Subjects:",
	"info" => "Separate subjects with \",\".",
	"id" => $different_themes_managment->themeslug."_contact_subjects"
),

array(
	"type" => "close"
),


array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Social Networks"
),

array(
	"type" => "checkbox",
	"title" => "Social Networks Icons",
	"id" => $different_themes_managment->themeslug."_social_footer",
	"std" => "off"
),


array(
	"type" => "input",
	"title" => "Twitter Account Url:",
	"id" => $different_themes_managment->themeslug."_twitter",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_social_footer", "value" => "on")
	)
),

array(
	"type" => "input",
	"title" => "Facebook Account Url:",
	"id" => $different_themes_managment->themeslug."_facebook",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_social_footer", "value" => "on")
	)
),

array(
	"type" => "input",
	"title" => "Digg Account Url:",
	"id" => $different_themes_managment->themeslug."_digg",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_social_footer", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Flickr Account Url:",
	"id" => $different_themes_managment->themeslug."_flickr",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_social_footer", "value" => "on")
	)
),

array(
	"type" => "input",
	"title" => "Dribbble Account Url:",
	"id" => $different_themes_managment->themeslug."_dribbble",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_social_footer", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Googleplus Account Url:",
	"id" => $different_themes_managment->themeslug."_googleplus",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_social_footer", "value" => "on")
	)
),


array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * PORTFOLIO SETTINGS
 * ------------------------------------------------------------------------*/   
array(
	"type" => "sub_tab",
	"slug"=>'portfolio'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title"=>'Portfolio Settings'
),

array(
	"type" => "input",
	"title" => "Items per portfolio page:",
	"id" => $different_themes_managment->themeslug."_portfolio_items",
	"number" => "yes",
	"std" => "8"
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * BANNER SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "sub_tab",
	"slug"=>'banner_settings'
),


array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Select Pop Up Banner Type"
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_banner_type",
	"radio" => array(
		array("title" => "Off", "value" => "off"),
		array("title" => "Banner With Image", "value" => "image"),
		array("title" => "Banner With Text Or HTML Code", "value" => "text"),
		array("title" => "Banner With Image &amp; Text", "value" => "text_image")
	),
	"std" => "off"
),

array(
	"type" => "upload",
	"title" => "Add Banner Image",
	"id" => $different_themes_managment->themeslug."_banner_image",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_banner_type", "value" => "image")
	)
),

array(
	"type" => "textarea",
	"title" => "Banner content",
	"info" => "You can copy also some HTML code here.",
	"id" => $different_themes_managment->themeslug."_banner_text",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_banner_type", "value" => "text")
	)
),

array(
	"type" => "upload",
	"title" => "Add Banner Image",
	"id" => $different_themes_managment->themeslug."_banner_text_image_img",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_banner_type", "value" => "text_image")
	)
),

array(
	"type" => "textarea",
	"title" => "Banner text",
	"info" => "You add only text.",
	"id" => $different_themes_managment->themeslug."_banner_text_image_txt",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_banner_type", "value" => "text_image")
	)
),

array(
	"type" => "close"
),


array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Banner Settings",
),

array(
	"type" => "select",
	"title" => "Start Time",
	"id" => $different_themes_managment->themeslug."_banner_start",
	"options"=>array(
		array("slug"=>"0", "name"=>"0 Secconds"), 
		array("slug"=>"5", "name"=>"5 Secconds"),
		array("slug"=>"10", "name"=>"10 Secconds"),
		array("slug"=>"15", "name"=>"15 Secconds"),
		array("slug"=>"20", "name"=>"20 Secconds"),
		array("slug"=>"25", "name"=>"25 Secconds"),
		array("slug"=>"30", "name"=>"30 Secconds"),
		array("slug"=>"60", "name"=>"1 Minute"),
		array("slug"=>"120", "name"=>"2 Minute"),
		array("slug"=>"180", "name"=>"3 Minute"),

		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Close Time",
	"id" => $different_themes_managment->themeslug."_banner_close",
	"options"=>array(
		array("slug"=>"0", "name"=>"Off"), 
		array("slug"=>"5", "name"=>"5 Secconds"),
		array("slug"=>"10", "name"=>"10 Secconds"),
		array("slug"=>"15", "name"=>"15 Secconds"),
		array("slug"=>"20", "name"=>"20 Secconds"),
		array("slug"=>"25", "name"=>"25 Secconds"),
		array("slug"=>"30", "name"=>"30 Secconds"),
		array("slug"=>"60", "name"=>"1 Minute"),
		array("slug"=>"120", "name"=>"2 Minute"),
		array("slug"=>"180", "name"=>"3 Minute"),

		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Fly In From",
	"id" => $different_themes_managment->themeslug."_banner_fly_in",
	"options"=>array(
		array("slug"=>"off", "name"=>"Off"), 
		array("slug"=>"top", "name"=>"Top"),
		array("slug"=>"top-left", "name"=>"Top Left"),
		array("slug"=>"top-right", "name"=>"Top Right"),
		array("slug"=>"left", "name"=>"Left"),
		array("slug"=>"bottom", "name"=>"Bottom"),
		array("slug"=>"bottom-left", "name"=>"Bottom Left"),
		array("slug"=>"bottom-right", "name"=>"Bottom Right"),
		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Fly Out To",
	"id" => $different_themes_managment->themeslug."_banner_fly_out",
	"options"=>array(
		array("slug"=>"off", "name"=>"Off"), 
		array("slug"=>"top", "name"=>"Top"),
		array("slug"=>"top-left", "name"=>"Top Left"),
		array("slug"=>"top-right", "name"=>"Top Right"),
		array("slug"=>"left", "name"=>"Left"),
		array("slug"=>"bottom", "name"=>"Bottom"),
		array("slug"=>"bottom-left", "name"=>"Bottom Left"),
		array("slug"=>"bottom-right", "name"=>"Bottom Right"),
		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Show Banner after",
	"info" => "How many times site may be viewed until the popup will be shown again",
	"id" => $different_themes_managment->themeslug."_banner_views",
	"options"=>array(
		array("slug"=>"0", "name"=>"0 Click"), 
		array("slug"=>"1", "name"=>"1 Click"),
		array("slug"=>"2", "name"=>"2 Clicks"),
		array("slug"=>"2", "name"=>"3 Clicks"),
		array("slug"=>"4", "name"=>"4 Clicks"),
		array("slug"=>"5", "name"=>"5 Clicks"),
		array("slug"=>"10", "name"=>"10 Clicks"),
		array("slug"=>"20", "name"=>"20 Clicks"),
		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "How offen show the banner",
	"id" => $different_themes_managment->themeslug."_banner_timeout",
	"options"=>array(
		array("slug"=>"0", "name"=>"One time per visit"), 
		array("slug"=>"1", "name"=>"Once a day"), 
		array("slug"=>"2", "name"=>"Once in 2 days"),
		array("slug"=>"3", "name"=>"Once in 3 days"),
		),
	"std" => "off"
),

array(
	"type" => "checkbox",
	"title" => "Enable Background Overlay:",
	"id" => $different_themes_managment->themeslug."_banner_overlay",
	"std" => "off"
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
 );


$different_themes_managment->add_options($differentThemes_general_options);
?>