<?php

/*-----------------------------------------------------------------------------------*/
/*	Highlight Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['highlight'] = array(
	'preview' => 'true',
	'shortcode' => '[highlight background="{{background}}" color="{{color}}"]{{content}}[/highlight]',
	'title' => __('Insert Highlight Shortcode', 'mpcth'),
	'fields' => array(
		'content' => array(
			'std' => __('Highlight Text', 'mpcth'),
			'type' => 'text',
			'title' => __('Text', 'mpcth'),
			'desc' => __('Specify text which will be displayed inside the highlight.', 'mpcth')
		),
		'background' => array(
			'std' => '#37485F',
			'type' => 'color',
			'title' => __('Background Color', 'mpcth'),
			'desc' => __('Highlight background color.', 'mpcth')
		),
		'color' => array(
			'std' => '#ffffff',
			'type' => 'color',
			'title' => __('Text Color', 'mpcth'),
			'desc' => __('Specify text color.', 'mpcth')
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Dropcaps Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['dropcaps'] = array(
	'preview' => 'true',
	'shortcode' => '[dropcaps background="{{background}}" color="{{color}}" size="{{size}}"]{{content}}[/dropcaps]',
	'title' => __('Insert Dropcaps Shortcode', 'mpcth'),
	'fields' => array(
		'content' => array(
			'std' => 'A',
			'type' => 'text',
			'title' => __('Text', 'mpcth'),
			'desc' => __('Specify letter which will be displayed inside the dropcaps.', 'mpcth')
		),
		'background' => array(
			'std' => '#37485F',
			'type' => 'color',
			'title' => __('Background Color', 'mpcth'),
			'desc' => __('Dropcaps background color.', 'mpcth')
		),
		'color' => array(
			'std' => '#ffffff',
			'type' => 'color',
			'title' => __('Text Color', 'mpcth'),
			'desc' => __('Specify letter color.', 'mpcth')
		),
		'size' => array(
			'type' => 'select',
			'title' => __('Size', 'mpcth'),
			'desc' => __('Select the size.', 'mpcth'),
			'options' => array(
				'small' => __('Small', 'mpcth'),
				'normal' => __('Normal', 'mpcth'),
				'big' => __('Big', 'mpcth')
			)
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Tooltip Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['tooltip'] = array(
	'preview' => 'false',
	'shortcode' => '[tooltip message="{{message}}"]{{content}}[/tooltip]',
	'title' => __('Insert Tooltip Shortcode', 'mpcth'),
	'fields' => array(
		'content' => array(
			'std' => __('Text with tooltip.', 'mpcth'),
			'type' => 'text',
			'title' => __('Text', 'mpcth'),
			'desc' => __('Specify tooltip text.', 'mpcth')
		),
		'message' => array(
			'std' => __('Tooltip text', 'mpcth'),
			'type' => 'text',
			'title' => __('Tooltip Text', 'mpcth'),
			'desc' => __('Tooltip message.', 'mpcth')
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Fancybox Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['fancybox'] = array(
	'preview' => 'false',
	'shortcode' => '[fancybox src="{{src}}" caption="{{caption}}"]{{content}}[/fancybox]',
	'title' => __('Insert Tooltip Shortcode', 'mpcth'),
	'fields' => array(
		'content' => array(
			'std' => __('Fancybox element', 'mpcth'),
			'type' => 'text',
			'title' => __('Fancybox Element', 'mpcth'),
			'desc' => __('Element that will have Fancybox.', 'mpcth')
		),
		'src' => array(
			'std' => '#',
			'type' => 'text',
			'title' => __('Fancybox source', 'mpcth'),
			'desc' => __('URL to Fancybox target.', 'mpcth')
		),
		'caption' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Fancybox caption', 'mpcth'),
			'desc' => __('Caption fot Fancybox target.', 'mpcth')
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Button Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['button'] = array(
	'preview' => 'true',
	'shortcode' => '[button id="{{id}}" icon="{{icon}}" url="{{url}}" color="{{color}}" hover_color="{{hover_color}}" background="{{background}}" hover_background="{{hover_background}}"]{{content}}[/button]',
	'title' => __('Insert Button Shortcode', 'mpcth'),
	'fields' => array(
		'content' => array(
			'std' => __('Button text', 'mpcth'),
			'type' => 'text',
			'title' => __('Button Text', 'mpcth'),
			'desc' => __('Specify button text.', 'mpcth')
		),
		'icon' => array(
			'type' => 'select',
			'title' => __('Icon', 'mpcth'),
			'desc' => __('Select the icon.', 'mpcth'),
			'options' => array(
				'plus' => 'Plus', 'minus' => 'Minus', 'info' => 'Info', 'left-thin' => 'Left thin', 'up-thin' => 'Up thin', 'right-thin' => 'Right thin', 'down-thin' => 'Down thin', 'level-up' => 'Level up', 'level-down' => 'Level down', 'switch' => 'Switch', 'infinity' => 'Infinity', 'plus-squared' => 'Plus squared', 'minus-squared' => 'Minus squared', 'home' => 'Home', 'keyboard' => 'Keyboard', 'erase' => 'Erase', 'pause' => 'Pause', 'fast-forward' => 'Fast forward', 'fast-backward' => 'Fast backward', 'to-end' => 'To end', 'to-start' => 'To start', 'hourglass' => 'Hourglass', 'stop' => 'Stop', 'up-dir' => 'Up dir', 'play' => 'Play', 'right-dir' => 'Right dir', 'down-dir' => 'Down dir', 'left-dir' => 'Left dir', 'adjust' => 'Adjust', 'cloud' => 'Cloud', 'star' => 'Star', 'star-empty' => 'Star empty', 'cup' => 'Cup', 'menu' => 'Menu', 'moon' => 'Moon', 'heart-empty' => 'Heart empty', 'heart' => 'Heart', 'note' => 'Note', 'note-beamed' => 'Note beamed', 'layout' => 'Layout', 'flag' => 'Flag', 'tools' => 'Tools', 'cog' => 'Cog', 'attention' => 'Attention', 'flash' => 'Flash', 'record' => 'Record', 'cloud-thunder' => 'Cloud thunder', 'tape' => 'Tape', 'flight' => 'Flight', 'mail' => 'Mail', 'pencil' => 'Pencil', 'feather' => 'Feather', 'check' => 'Check', 'cancel' => 'Cancel', 'cancel-circled' => 'Cancel circled', 'cancel-squared' => 'Cancel squared', 'help' => 'Help', 'quote' => 'Quote', 'plus-circled' => 'Plus circled', 'minus-circled' => 'Minus circled', 'right' => 'Right', 'direction' => 'Direction', 'forward' => 'Forward', 'ccw' => 'Ccw', 'cw' => 'Cw', 'left' => 'Left', 'up' => 'Up', 'down' => 'Down', 'list-add' => 'List add', 'list' => 'List', 'left-bold' => 'Left bold', 'right-bold' => 'Right bold', 'up-bold' => 'Up bold', 'down-bold' => 'Down bold', 'user-add' => 'User add', 'help-circled' => 'Help circled', 'info-circled' => 'Info circled', 'eye' => 'Eye', 'tag' => 'Tag', 'upload-cloud' => 'Upload cloud', 'reply' => 'Reply', 'reply-all' => 'Reply all', 'code' => 'Code', 'export' => 'Export', 'print' => 'Print', 'retweet' => 'Retweet', 'comment' => 'Comment', 'chat' => 'Chat', 'vcard' => 'Vcard', 'address' => 'Address', 'location' => 'Location', 'map' => 'Map', 'compass' => 'Compass', 'trash' => 'Trash', 'doc' => 'Doc', 'doc-text-inv' => 'Doc text inv', 'docs' => 'Docs', 'doc-landscape' => 'Doc landscape', 'archive' => 'Archive', 'rss' => 'Rss', 'share' => 'Share', 'basket' => 'Basket', 'shareable' => 'Shareable', 'login' => 'Login', 'logout' => 'Logout', 'volume' => 'Volume', 'resize-full' => 'Resize full', 'resize-small' => 'Resize small', 'popup' => 'Popup', 'publish' => 'Publish', 'window' => 'Window', 'arrow-combo' => 'Arrow combo', 'chart-pie' => 'Chart pie', 'language' => 'Language', 'air' => 'Air', 'database' => 'Database', 'drive' => 'Drive', 'bucket' => 'Bucket', 'thermometer' => 'Thermometer', 'down-circled' => 'Down circled', 'left-circled' => 'Left circled', 'right-circled' => 'Right circled', 'up-circled' => 'Up circled', 'down-open' => 'Down open', 'left-open' => 'Left open', 'right-open' => 'Right open', 'up-open' => 'Up open', 'down-open-mini' => 'Down open mini', 'left-open-mini' => 'Left open mini', 'right-open-mini' => 'Right open mini', 'up-open-mini' => 'Up open mini', 'down-open-big' => 'Down open big', 'left-open-big' => 'Left open big', 'right-open-big' => 'Right open big', 'up-open-big' => 'Up open big', 'progress-0' => 'Progress 0', 'progress-1' => 'Progress 1', 'progress-2' => 'Progress 2', 'progress-3' => 'Progress 3', 'back-in-time' => 'Back in time', 'network' => 'Network', 'inbox' => 'Inbox', 'install' => 'Install', 'lifebuoy' => 'Lifebuoy', 'mouse' => 'Mouse', 'dot' => 'Dot', 'dot-2' => 'Dot 2', 'dot-3' => 'Dot 3', 'suitcase' => 'Suitcase', 'flow-cascade' => 'Flow cascade', 'flow-branch' => 'Flow branch', 'flow-tree' => 'Flow tree', 'flow-line' => 'Flow line', 'flow-parallel' => 'Flow parallel', 'brush' => 'Brush', 'paper-plane' => 'Paper plane', 'magnet' => 'Magnet', 'gauge' => 'Gauge', 'traffic-cone' => 'Traffic cone', 'cc' => 'Cc', 'cc-by' => 'Cc by', 'cc-nc' => 'Cc nc', 'cc-nc-eu' => 'Cc nc eu', 'cc-nc-jp' => 'Cc nc jp', 'cc-sa' => 'Cc sa', 'cc-nd' => 'Cc nd', 'cc-pd' => 'Cc pd', 'cc-zero' => 'Cc zero', 'cc-share' => 'Cc share', 'cc-remix' => 'Cc remix', 'github' => 'Github', 'github-circled' => 'Github circled', 'flickr' => 'Flickr', 'flickr-circled' => 'Flickr circled', 'vimeo' => 'Vimeo', 'vimeo-circled' => 'Vimeo circled', 'twitter' => 'Twitter', 'twitter-circled' => 'Twitter circled', 'facebook' => 'Facebook', 'facebook-circled' => 'Facebook circled', 'facebook-squared' => 'Facebook squared', 'gplus' => 'Gplus', 'gplus-circled' => 'Gplus circled', 'pinterest' => 'Pinterest', 'pinterest-circled' => 'Pinterest circled', 'tumblr' => 'Tumblr', 'tumblr-circled' => 'Tumblr circled', 'linkedin' => 'Linkedin', 'linkedin-circled' => 'Linkedin circled', 'dribbble' => 'Dribbble', 'dribbble-circled' => 'Dribbble circled', 'stumbleupon' => 'Stumbleupon', 'stumbleupon-circled' => 'Stumbleupon circled', 'lastfm' => 'Lastfm', 'lastfm-circled' => 'Lastfm circled', 'rdio' => 'Rdio', 'rdio-circled' => 'Rdio circled', 'spotify' => 'Spotify', 'spotify-circled' => 'Spotify circled', 'qq' => 'Qq', 'instagrem' => 'Instagrem', 'dropbox' => 'Dropbox', 'evernote' => 'Evernote', 'flattr' => 'Flattr', 'skype' => 'Skype', 'skype-circled' => 'Skype circled', 'renren' => 'Renren', 'sina-weibo' => 'Sina weibo', 'paypal' => 'Paypal', 'picasa' => 'Picasa', 'soundcloud' => 'Soundcloud', 'mixi' => 'Mixi', 'behance' => 'Behance', 'google-circles' => 'Google circles', 'vkontakte' => 'Vkontakte', 'smashing' => 'Smashing', 'db-shape' => 'Db shape', 'sweden' => 'Sweden', 'logo-db' => 'Logo db', 'picture' => 'Picture', 'globe' => 'Globe', 'leaf' => 'Leaf', 'graduation-cap' => 'Graduation cap', 'mic' => 'Mic', 'palette' => 'Palette', 'ticket' => 'Ticket', 'video' => 'Video', 'target' => 'Target', 'music' => 'Music', 'trophy' => 'Trophy', 'thumbs-up' => 'Thumbs up', 'thumbs-down' => 'Thumbs down', 'bag' => 'Bag', 'user' => 'User', 'users' => 'Users', 'lamp' => 'Lamp', 'alert' => 'Alert', 'water' => 'Water', 'droplet' => 'Droplet', 'credit-card' => 'Credit card', 'monitor' => 'Monitor', 'briefcase' => 'Briefcase', 'floppy' => 'Floppy', 'cd' => 'Cd', 'folder' => 'Folder', 'doc-text' => 'Doc text', 'calendar' => 'Calendar', 'chart-line' => 'Chart line', 'chart-bar' => 'Chart bar', 'clipboard' => 'Clipboard', 'attach' => 'Attach', 'bookmarks' => 'Bookmarks', 'book' => 'Book', 'book-open' => 'Book open', 'phone' => 'Phone', 'megaphone' => 'Megaphone', 'upload' => 'Upload', 'download' => 'Download', 'box' => 'Box', 'newspaper' => 'Newspaper', 'mobile' => 'Mobile', 'signal' => 'Signal', 'camera' => 'Camera', 'shuffle' => 'Shuffle', 'loop' => 'Loop', 'arrows-ccw' => 'Arrows ccw', 'light-down' => 'Light down', 'light-up' => 'Light up', 'mute' => 'Mute', 'sound' => 'Sound', 'battery' => 'Battery', 'search' => 'Search', 'key' => 'Key', 'lock' => 'Lock', 'lock-open' => 'Lock open', 'bell' => 'Bell', 'bookmark' => 'Bookmark', 'link' => 'Link', 'back' => 'Back', 'flashlight' => 'Flashlight', 'chart-area' => 'Chart area', 'clock' => 'Clock', 'rocket' => 'Rocket', 'block' => 'Block'
			)
		),
		'color' => array(
			'std' => '#ffffff',
			'type' => 'color',
			'title' => __('Text Color', 'mpcth'),
			'desc' => __('Specify text color.', 'mpcth')
		),
		'hover_color' => array(
			'std' => '#eeeeee',
			'type' => 'color',
			'title' => __('Hover Text Color', 'mpcth'),
			'desc' => __('Specify hover text color.', 'mpcth')
		),
		'background' => array(
			'std' => '#37485F',
			'type' => 'color',
			'title' => __('Background Color', 'mpcth'),
			'desc' => __('Specify background color.', 'mpcth')
		),
		'hover_background' => array(
			'std' => '#2f3e51',
			'type' => 'color',
			'title' => __('Hover Background Color', 'mpcth'),
			'desc' => __('Specify hover background color.', 'mpcth')
		),
		'url' => array(
			'std' => '#',
			'type' => 'text',
			'title' => __('Button URL', 'mpcth'),
			'desc' => __('Button URL.', 'mpcth')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Button ID', 'mpcth'),
			'desc' => __('Button ID (if empty it will by random).', 'mpcth')
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Lists
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['list'] = array(
	'preview' => 'true',
	'shortcode' => '[list] {{inside}} [/list]',
	'title' => __('Insert Columns Shortcode', 'mpcth'),
	'fields' => array(),
	'inside' => array( 
		'shortcode' => '[l_item type="{{type}}" color="{{color}}" icon_color="{{icon_color}}"] {{item}} [/l_item]',
		'add_section' => __('Add New List Item', 'mpcth'),
		'remove_section' => __('Remove List Item', 'mpcth'),
		'fields' => array(
			'item' => array(
				'std' => __('List Item', 'mpcth'),
				'type' => 'textarea',
				'title' => __('List Item Content', 'mpcth'),
				'desc' => __('Specify the list item content.', 'mpcth'),
			),
			'color' => array(
				'std' => '#37485F',
				'type' => 'color',
				'title' => __('Color', 'mpcth'),
				'desc' => __('Specify the list item content.', 'mpcth'),
			),
			'icon_color' => array(
				'std' => '#37485F',
				'type' => 'color',
				'title' => __('Icon Color', 'mpcth'),
				'desc' => __('Specify the list item content.', 'mpcth'),
			),
			'type' => array(
			'type' => 'select',
			'title' => __('List Type', 'mpcth', 'mpcth'),
			'desc' => __('Specify the list type', 'mpcth'),
			'options' => array(
					'plus' => 'Plus', 'minus' => 'Minus', 'info' => 'Info', 'left-thin' => 'Left thin', 'up-thin' => 'Up thin', 'right-thin' => 'Right thin', 'down-thin' => 'Down thin', 'level-up' => 'Level up', 'level-down' => 'Level down', 'switch' => 'Switch', 'infinity' => 'Infinity', 'plus-squared' => 'Plus squared', 'minus-squared' => 'Minus squared', 'home' => 'Home', 'keyboard' => 'Keyboard', 'erase' => 'Erase', 'pause' => 'Pause', 'fast-forward' => 'Fast forward', 'fast-backward' => 'Fast backward', 'to-end' => 'To end', 'to-start' => 'To start', 'hourglass' => 'Hourglass', 'stop' => 'Stop', 'up-dir' => 'Up dir', 'play' => 'Play', 'right-dir' => 'Right dir', 'down-dir' => 'Down dir', 'left-dir' => 'Left dir', 'adjust' => 'Adjust', 'cloud' => 'Cloud', 'star' => 'Star', 'star-empty' => 'Star empty', 'cup' => 'Cup', 'menu' => 'Menu', 'moon' => 'Moon', 'heart-empty' => 'Heart empty', 'heart' => 'Heart', 'note' => 'Note', 'note-beamed' => 'Note beamed', 'layout' => 'Layout', 'flag' => 'Flag', 'tools' => 'Tools', 'cog' => 'Cog', 'attention' => 'Attention', 'flash' => 'Flash', 'record' => 'Record', 'cloud-thunder' => 'Cloud thunder', 'tape' => 'Tape', 'flight' => 'Flight', 'mail' => 'Mail', 'pencil' => 'Pencil', 'feather' => 'Feather', 'check' => 'Check', 'cancel' => 'Cancel', 'cancel-circled' => 'Cancel circled', 'cancel-squared' => 'Cancel squared', 'help' => 'Help', 'quote' => 'Quote', 'plus-circled' => 'Plus circled', 'minus-circled' => 'Minus circled', 'right' => 'Right', 'direction' => 'Direction', 'forward' => 'Forward', 'ccw' => 'Ccw', 'cw' => 'Cw', 'left' => 'Left', 'up' => 'Up', 'down' => 'Down', 'list-add' => 'List add', 'list' => 'List', 'left-bold' => 'Left bold', 'right-bold' => 'Right bold', 'up-bold' => 'Up bold', 'down-bold' => 'Down bold', 'user-add' => 'User add', 'help-circled' => 'Help circled', 'info-circled' => 'Info circled', 'eye' => 'Eye', 'tag' => 'Tag', 'upload-cloud' => 'Upload cloud', 'reply' => 'Reply', 'reply-all' => 'Reply all', 'code' => 'Code', 'export' => 'Export', 'print' => 'Print', 'retweet' => 'Retweet', 'comment' => 'Comment', 'chat' => 'Chat', 'vcard' => 'Vcard', 'address' => 'Address', 'location' => 'Location', 'map' => 'Map', 'compass' => 'Compass', 'trash' => 'Trash', 'doc' => 'Doc', 'doc-text-inv' => 'Doc text inv', 'docs' => 'Docs', 'doc-landscape' => 'Doc landscape', 'archive' => 'Archive', 'rss' => 'Rss', 'share' => 'Share', 'basket' => 'Basket', 'shareable' => 'Shareable', 'login' => 'Login', 'logout' => 'Logout', 'volume' => 'Volume', 'resize-full' => 'Resize full', 'resize-small' => 'Resize small', 'popup' => 'Popup', 'publish' => 'Publish', 'window' => 'Window', 'arrow-combo' => 'Arrow combo', 'chart-pie' => 'Chart pie', 'language' => 'Language', 'air' => 'Air', 'database' => 'Database', 'drive' => 'Drive', 'bucket' => 'Bucket', 'thermometer' => 'Thermometer', 'down-circled' => 'Down circled', 'left-circled' => 'Left circled', 'right-circled' => 'Right circled', 'up-circled' => 'Up circled', 'down-open' => 'Down open', 'left-open' => 'Left open', 'right-open' => 'Right open', 'up-open' => 'Up open', 'down-open-mini' => 'Down open mini', 'left-open-mini' => 'Left open mini', 'right-open-mini' => 'Right open mini', 'up-open-mini' => 'Up open mini', 'down-open-big' => 'Down open big', 'left-open-big' => 'Left open big', 'right-open-big' => 'Right open big', 'up-open-big' => 'Up open big', 'progress-0' => 'Progress 0', 'progress-1' => 'Progress 1', 'progress-2' => 'Progress 2', 'progress-3' => 'Progress 3', 'back-in-time' => 'Back in time', 'network' => 'Network', 'inbox' => 'Inbox', 'install' => 'Install', 'lifebuoy' => 'Lifebuoy', 'mouse' => 'Mouse', 'dot' => 'Dot', 'dot-2' => 'Dot 2', 'dot-3' => 'Dot 3', 'suitcase' => 'Suitcase', 'flow-cascade' => 'Flow cascade', 'flow-branch' => 'Flow branch', 'flow-tree' => 'Flow tree', 'flow-line' => 'Flow line', 'flow-parallel' => 'Flow parallel', 'brush' => 'Brush', 'paper-plane' => 'Paper plane', 'magnet' => 'Magnet', 'gauge' => 'Gauge', 'traffic-cone' => 'Traffic cone', 'cc' => 'Cc', 'cc-by' => 'Cc by', 'cc-nc' => 'Cc nc', 'cc-nc-eu' => 'Cc nc eu', 'cc-nc-jp' => 'Cc nc jp', 'cc-sa' => 'Cc sa', 'cc-nd' => 'Cc nd', 'cc-pd' => 'Cc pd', 'cc-zero' => 'Cc zero', 'cc-share' => 'Cc share', 'cc-remix' => 'Cc remix', 'github' => 'Github', 'github-circled' => 'Github circled', 'flickr' => 'Flickr', 'flickr-circled' => 'Flickr circled', 'vimeo' => 'Vimeo', 'vimeo-circled' => 'Vimeo circled', 'twitter' => 'Twitter', 'twitter-circled' => 'Twitter circled', 'facebook' => 'Facebook', 'facebook-circled' => 'Facebook circled', 'facebook-squared' => 'Facebook squared', 'gplus' => 'Gplus', 'gplus-circled' => 'Gplus circled', 'pinterest' => 'Pinterest', 'pinterest-circled' => 'Pinterest circled', 'tumblr' => 'Tumblr', 'tumblr-circled' => 'Tumblr circled', 'linkedin' => 'Linkedin', 'linkedin-circled' => 'Linkedin circled', 'dribbble' => 'Dribbble', 'dribbble-circled' => 'Dribbble circled', 'stumbleupon' => 'Stumbleupon', 'stumbleupon-circled' => 'Stumbleupon circled', 'lastfm' => 'Lastfm', 'lastfm-circled' => 'Lastfm circled', 'rdio' => 'Rdio', 'rdio-circled' => 'Rdio circled', 'spotify' => 'Spotify', 'spotify-circled' => 'Spotify circled', 'qq' => 'Qq', 'instagrem' => 'Instagrem', 'dropbox' => 'Dropbox', 'evernote' => 'Evernote', 'flattr' => 'Flattr', 'skype' => 'Skype', 'skype-circled' => 'Skype circled', 'renren' => 'Renren', 'sina-weibo' => 'Sina weibo', 'paypal' => 'Paypal', 'picasa' => 'Picasa', 'soundcloud' => 'Soundcloud', 'mixi' => 'Mixi', 'behance' => 'Behance', 'google-circles' => 'Google circles', 'vkontakte' => 'Vkontakte', 'smashing' => 'Smashing', 'db-shape' => 'Db shape', 'sweden' => 'Sweden', 'logo-db' => 'Logo db', 'picture' => 'Picture', 'globe' => 'Globe', 'leaf' => 'Leaf', 'graduation-cap' => 'Graduation cap', 'mic' => 'Mic', 'palette' => 'Palette', 'ticket' => 'Ticket', 'video' => 'Video', 'target' => 'Target', 'music' => 'Music', 'trophy' => 'Trophy', 'thumbs-up' => 'Thumbs up', 'thumbs-down' => 'Thumbs down', 'bag' => 'Bag', 'user' => 'User', 'users' => 'Users', 'lamp' => 'Lamp', 'alert' => 'Alert', 'water' => 'Water', 'droplet' => 'Droplet', 'credit-card' => 'Credit card', 'monitor' => 'Monitor', 'briefcase' => 'Briefcase', 'floppy' => 'Floppy', 'cd' => 'Cd', 'folder' => 'Folder', 'doc-text' => 'Doc text', 'calendar' => 'Calendar', 'chart-line' => 'Chart line', 'chart-bar' => 'Chart bar', 'clipboard' => 'Clipboard', 'attach' => 'Attach', 'bookmarks' => 'Bookmarks', 'book' => 'Book', 'book-open' => 'Book open', 'phone' => 'Phone', 'megaphone' => 'Megaphone', 'upload' => 'Upload', 'download' => 'Download', 'box' => 'Box', 'newspaper' => 'Newspaper', 'mobile' => 'Mobile', 'signal' => 'Signal', 'camera' => 'Camera', 'shuffle' => 'Shuffle', 'loop' => 'Loop', 'arrows-ccw' => 'Arrows ccw', 'light-down' => 'Light down', 'light-up' => 'Light up', 'mute' => 'Mute', 'sound' => 'Sound', 'battery' => 'Battery', 'search' => 'Search', 'key' => 'Key', 'lock' => 'Lock', 'lock-open' => 'Lock open', 'bell' => 'Bell', 'bookmark' => 'Bookmark', 'link' => 'Link', 'back' => 'Back', 'flashlight' => 'Flashlight', 'chart-area' => 'Chart area', 'clock' => 'Clock', 'rocket' => 'Rocket', 'block' => 'Block'
				)
			)
		)
	)
);

?>