<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Centum
 */
function dtbaker_wp_nav_menu_objects($sorted_menu_items, $args){
    // this is the code from nav-menu-template.php that we want to stop running
    // so we try our best to "reverse" this code wp code in this filter.
    /* if ( ! empty( $home_page_id ) && 'post_type' == $menu_item->type && empty( $wp_query->is_page ) && $home_page_id == $menu_item->object_id )
            $classes[] = 'current_page_parent'; */

    // check if the current page is really a blog post.
    //print_r($wp_query);exit;
    global $wp_query;
    if(!empty($wp_query->queried_object_id)){
        $current_page = get_post($wp_query->queried_object_id);
        if($current_page && $current_page->post_type=='post'){
            //yes!
        }else{
            $current_page = false;
        }
    }else{
        $current_page = false;
    }


    $home_page_id = (int) get_option( 'page_for_posts' );
    foreach($sorted_menu_items as $id => $menu_item){
        if ( ! empty( $home_page_id ) && 'post_type' == $menu_item->type && empty( $wp_query->is_page ) && $home_page_id == $menu_item->object_id ){
            if(!$current_page){
                foreach($sorted_menu_items[$id]->classes as $classid=>$classname){
                    if($classname=='current_page_parent'){
                        unset($sorted_menu_items[$id]->classes[$classid]);
                    }
                }
            }
        }
    }
    return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects','dtbaker_wp_nav_menu_objects',10,2);
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function centum_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'centum_body_classes' );


if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function centum_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'centum' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'centum_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function centum_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'centum_render_title' );
endif;



if ( ! function_exists( 'centum_get_rating_class' ) ) :
function centum_get_rating_class($average) {
	switch ($average) {
		case $average >= 1 and $average < 1.5:
			$class="one-stars";
			break;
		case $average >= 1.5 and $average < 2:
			$class="one-and-half-stars";
			break;
		case $average >= 2 and $average < 2.5:
			$class="two-stars";
			break;
		case $average >= 2.5 and $average < 3:
			$class="two-and-half-stars";
			break;
		case $average >= 3 and $average < 3.5:
			$class="three-stars";
			break;
		case $average >= 3.5 and $average < 4:
			$class="three-and-half-stars";
			break;
		case $average >= 4 and $average < 4.5:
			$class="four-stars";
			break;
		case $average >= 4.5 and $average < 5:
			$class="four-and-half-stars";
			break;
		case $average >= 5:
			$class="five-stars";
			break;
		default:
			$class="no-rating";
			break;
	}
	return $class;
}
endif;



//twitter function
add_action( 'init', 'centum_twitter_api' );
function centum_twitter_api() {
    global $cb;
    $consumer_key = ot_get_option('pp_twitter_ck');
    $consumer_secret = ot_get_option('pp_twitter_cs');
    $access_token = ot_get_option('pp_twitter_at');
    $access_secret = ot_get_option('pp_twitter_ts');
    if(!empty($consumer_key)){
      require_once('codebird.php');
      Codebird::setConsumerKey( $consumer_key, $consumer_secret );
      $cb = Codebird::getInstance();
      $cb->setToken( $access_token, $access_secret );
    }
}


function centum_icons_list(){
        $icon = array(
            'no-icon'=> 'No-Icon',
            'adjust' => 'Adjust',
            'adn' => 'Adn',
            'align-center' => 'Align Center',
            'align-justify' => 'Align Justify',
            'align-left' => 'Align Left',
            'align-right' => 'Align Right',
            'ambulance' => 'Ambulance',
            'anchor' => 'Anchor',
            'android' => 'Android',
            'angle-double-down' => 'Angle Double Down',
            'angle-double-left' => 'Angle Double Left',
            'angle-double-right' => 'Angle Double Right',
            'angle-double-up' => 'Angle Double Up',
            'angle-down' => 'Angle Down',
            'angle-left' => 'Angle Left',
            'angle-right' => 'Angle Right',
            'angle-up' => 'Angle Up',
            'apple' => 'Apple',
            'archive' => 'Archive',
            'arrow-circle-down' => 'Arrow Circle Down',
            'arrow-circle-left' => 'Arrow Circle Left',
            'arrow-circle-o-down' => 'Arrow Circle O Down',
            'arrow-circle-o-left' => 'Arrow Circle O Left',
            'arrow-circle-o-right' => 'Arrow Circle O Right',
            'arrow-circle-o-up' => 'Arrow Circle O Up',
            'arrow-circle-right' => 'Arrow Circle Right',
            'arrow-circle-up' => 'Arrow Circle Up',
            'arrow-down' => 'Arrow Down',
            'arrow-left' => 'Arrow Left',
            'arrow-right' => 'Arrow Right',
            'arrows' => 'Arrows',
            'arrows-alt' => 'Arrows Alt',
            'arrows-h' => 'Arrows H',
            'arrows-v' => 'Arrows V',
            'arrow-up' => 'Arrow Up',
            'asterisk' => 'Asterisk',
            'automobile' => 'Automobile',
            'backward' => 'Backward',
            'ban' => 'Ban',
            'bank' => 'Bank',
            'bar-chart-o' => 'Bar Chart O',
            'barcode' => 'Barcode',
            'bars' => 'Bars',
            'bed' => 'Bed',
            'bed' => 'Hotel',
            'beer' => 'Beer',
            'behance' => 'Behance',
            'behance-square' => 'Behance Square',
            'bell' => 'Bell',
            'bell-o' => 'Bell O',
            'bitbucket' => 'Bitbucket',
            'bitbucket-square' => 'Bitbucket Square',
            'bitcoin' => 'Bitcoin',
            'bold' => 'Bold',
            'bolt' => 'Bolt',
            'bomb' => 'Bomb',
            'book' => 'Book',
            'bookmark' => 'Bookmark',
            'bookmark-o' => 'Bookmark O',
            'briefcase' => 'Briefcase',
            'btc' => 'Btc',
            'bug' => 'Bug',
            'building' => 'Building',
            'building-o' => 'Building O',
            'bullhorn' => 'Bullhorn',
            'bullseye' => 'Bullseye',
            'buysellads' => 'Buysellads',
            'cab' => 'Cab',
            'calendar' => 'Calendar',
            'calendar-o' => 'Calendar O',
            'camera' => 'Camera',
            'camera-retro' => 'Camera Retro',
            'car' => 'Car',
            'caret-down' => 'Caret Down',
            'caret-left' => 'Caret Left',
            'caret-right' => 'Caret Right',
            'caret-square-o-down' => 'Caret Square O Down',
            'caret-square-o-left' => 'Caret Square O Left',
            'caret-square-o-right' => 'Caret Square O Right',
            'caret-square-o-up' => 'Caret Square O Up',
            'caret-up' => 'Caret Up',
            'cart-arrow-down' => 'Cart Arrow Down',
            'cart-plus' => 'Cart Plus',
            'certificate' => 'Certificate',
            'chain' => 'Chain',
            'chain-broken' => 'Chain Broken',
            'check' => 'Check',
            'check-circle' => 'Check Circle',
            'check-circle-o' => 'Check Circle O',
            'check-square' => 'Check Square',
            'check-square-o' => 'Check Square O',
            'chevron-circle-down' => 'Chevron Circle Down',
            'chevron-circle-left' => 'Chevron Circle Left',
            'chevron-circle-right' => 'Chevron Circle Right',
            'chevron-circle-up' => 'Chevron Circle Up',
            'chevron-down' => 'Chevron Down',
            'chevron-left' => 'Chevron Left',
            'chevron-right' => 'Chevron Right',
            'chevron-up' => 'Chevron Up',
            'child' => 'Child',
            'circle' => 'Circle',
            'circle-o' => 'Circle O',
            'circle-o-notch' => 'Circle O Notch',
            'circle-thin' => 'Circle Thin',
            'clipboard' => 'Clipboard',
            'clock-o' => 'Clock O',
            'cloud' => 'Cloud',
            'cloud-download' => 'Cloud Download',
            'cloud-upload' => 'Cloud Upload',
            'cny' => 'Cny',
            'code' => 'Code',
            'code-fork' => 'Code Fork',
            'codepen' => 'Codepen',
            'coffee' => 'Coffee',
            'cog' => 'Cog',
            'cogs' => 'Cogs',
            'columns' => 'Columns',
            'comment' => 'Comment',
            'comment-o' => 'Comment O',
            'comments' => 'Comments',
            'comments-o' => 'Comments O',
            'compass' => 'Compass',
            'compress' => 'Compress',
            'connectdevelop' => 'Connectdevelop',
            'copy' => 'Copy',
            'credit-card' => 'Credit Card',
            'crop' => 'Crop',
            'crosshairs' => 'Crosshairs',
            'css3' => 'Css3',
            'cube' => 'Cube',
            'cubes' => 'Cubes',
            'cut' => 'Cut',
            'cutlery' => 'Cutlery',
            'dashboard' => 'Dashboard',
            'dashcube' => 'Dashcube',
            'database' => 'Database',
            'dedent' => 'Dedent',
            'delicious' => 'Delicious',
            'desktop' => 'Desktop',
            'deviantart' => 'Deviantart',
            'diamond' => 'Diamond',
            'digg' => 'Digg',
            'dollar' => 'Dollar',
            'dot-circle-o' => 'Dot Circle O',
            'download' => 'Download',
            'dribbble' => 'Dribbble',
            'dropbox' => 'Dropbox',
            'drupal' => 'Drupal',
            'edit' => 'Edit',
            'eject' => 'Eject',
            'ellipsis-h' => 'Ellipsis H',
            'ellipsis-v' => 'Ellipsis V',
            'empire' => 'Empire',
            'envelope' => 'Envelope',
            'envelope-o' => 'Envelope O',
            'envelope-square' => 'Envelope Square',
            'eraser' => 'Eraser',
            'eur' => 'Eur',
            'euro' => 'Euro',
            'exchange' => 'Exchange',
            'exclamation' => 'Exclamation',
            'exclamation-circle' => 'Exclamation Circle',
            'exclamation-triangle' => 'Exclamation Triangle',
            'expand' => 'Expand',
            'external-link' => 'External Link',
            'external-link-square' => 'External Link Square',
            'eye' => 'Eye',
            'eye-slash' => 'Eye Slash',
            'facebook' => 'Facebook',
            'facebook-official' => 'Facebook Official',
            'facebook-square' => 'Facebook Square',
            'fast-backward' => 'Fast Backward',
            'fast-forward' => 'Fast Forward',
            'fax' => 'Fax',
            'female' => 'Female',
            'fighter-jet' => 'Fighter Jet',
            'file' => 'File',
            'file-archive-o' => 'File Archive O',
            'file-audio-o' => 'File Audio O',
            'file-code-o' => 'File Code O',
            'file-excel-o' => 'File Excel O',
            'file-image-o' => 'File Image O',
            'file-movie-o' => 'File Movie O',
            'file-o' => 'File O',
            'file-pdf-o' => 'File Pdf O',
            'file-photo-o' => 'File Photo O',
            'file-picture-o' => 'File Picture O',
            'file-powerpoint-o' => 'File Powerpoint O',
            'files-o' => 'Files O',
            'file-sound-o' => 'File Sound O',
            'file-text' => 'File Text',
            'file-text-o' => 'File Text O',
            'file-video-o' => 'File Video O',
            'file-word-o' => 'File Word O',
            'file-zip-o' => 'File Zip O',
            'film' => 'Film',
            'filter' => 'Filter',
            'fire' => 'Fire',
            'fire-extinguisher' => 'Fire Extinguisher',
            'flag' => 'Flag',
            'flag-checkered' => 'Flag Checkered',
            'flag-o' => 'Flag O',
            'flash' => 'Flash',
            'flask' => 'Flask',
            'flickr' => 'Flickr',
            'floppy-o' => 'Floppy O',
            'folder' => 'Folder',
            'folder-o' => 'Folder O',
            'folder-open' => 'Folder Open',
            'folder-open-o' => 'Folder Open O',
            'font' => 'Font',
            'forumbee' => 'Forumbee',
            'forward' => 'Forward',
            'foursquare' => 'Foursquare',
            'frown-o' => 'Frown O',
            'gamepad' => 'Gamepad',
            'gavel' => 'Gavel',
            'gbp' => 'Gbp',
            'ge' => 'Ge',
            'gear' => 'Gear',
            'gears' => 'Gears',
            'gift' => 'Gift',
            'git' => 'Git',
            'github' => 'Github',
            'github-alt' => 'Github Alt',
            'github-square' => 'Github Square',
            'git-square' => 'Git Square',
            'gittip' => 'Gittip',
            'glass' => 'Glass',
            'globe' => 'Globe',
            'google' => 'Google',
            'google-plus' => 'Google Plus',
            'google-plus-square' => 'Google Plus Square',
            'graduation-cap' => 'Graduation Cap',
            'group' => 'Group',
            'hacker-news' => 'Hacker News',
            'hand-o-down' => 'Hand O Down',
            'hand-o-left' => 'Hand O Left',
            'hand-o-right' => 'Hand O Right',
            'hand-o-up' => 'Hand O Up',
            'hdd-o' => 'Hdd O',
            'header' => 'Header',
            'headphones' => 'Headphones',
            'heart' => 'Heart',
            'heartbeat' => 'Heartbeat',
            'heart-o' => 'Heart O',
            'history' => 'History',
            'home' => 'Home',
            'hospital-o' => 'Hospital O',
            'h-square' => 'H Square',
            'html5' => 'Html5',
            'image' => 'Image',
            'inbox' => 'Inbox',
            'indent' => 'Indent',
            'info' => 'Info',
            'info-circle' => 'Info Circle',
            'inr' => 'Inr',
            'instagram' => 'Instagram',
            'institution' => 'Institution',
            'italic' => 'Italic',
            'joomla' => 'Joomla',
            'jpy' => 'Jpy',
            'jsfiddle' => 'Jsfiddle',
            'key' => 'Key',
            'keyboard-o' => 'Keyboard O',
            'krw' => 'Krw',
            'language' => 'Language',
            'laptop' => 'Laptop',
            'leaf' => 'Leaf',
            'leanpub' => 'Leanpub',
            'legal' => 'Legal',
            'lemon-o' => 'Lemon O',
            'level-down' => 'Level Down',
            'level-up' => 'Level Up',
            'life-bouy' => 'Life Bouy',
            'life-ring' => 'Life Ring',
            'life-saver' => 'Life Saver',
            'lightbulb-o' => 'Lightbulb O',
            'link' => 'Link',
            'linkedin' => 'Linkedin',
            'linkedin-square' => 'Linkedin Square',
            'linux' => 'Linux',
            'list' => 'List',
            'list-alt' => 'List Alt',
            'list-ol' => 'List Ol',
            'list-ul' => 'List Ul',
            'location-arrow' => 'Location Arrow',
            'lock' => 'Lock',
            'long-arrow-down' => 'Long Arrow Down',
            'long-arrow-left' => 'Long Arrow Left',
            'long-arrow-right' => 'Long Arrow Right',
            'long-arrow-up' => 'Long Arrow Up',
            'magic' => 'Magic',
            'magnet' => 'Magnet',
            'mail-forward' => 'Mail Forward',
            'mail-reply' => 'Mail Reply',
            'mail-reply-all' => 'Mail Reply All',
            'male' => 'Male',
            'map-marker' => 'Map Marker',
            'mars' => 'Mars',
            'mars-double' => 'Mars Double',
            'mars-stroke' => 'Mars Stroke',
            'mars-stroke-h' => 'Mars Stroke H',
            'mars-stroke-v' => 'Mars Stroke V',
            'maxcdn' => 'Maxcdn',
            'medium' => 'Medium',
            'medkit' => 'Medkit',
            'meh-o' => 'Meh O',
            'mercury' => 'Mercury',
            'microphone' => 'Microphone',
            'microphone-slash' => 'Microphone Slash',
            'minus' => 'Minus',
            'minus-circle' => 'Minus Circle',
            'minus-square' => 'Minus Square',
            'minus-square-o' => 'Minus Square O',
            'mobile' => 'Mobile',
            'mobile-phone' => 'Mobile Phone',
            'money' => 'Money',
            'moon-o' => 'Moon O',
            'mortar-board' => 'Mortar Board',
            'motorcycle' => 'Motorcycle',
            'music' => 'Music',
            'navicon' => 'Navicon',
            'neuter' => 'Fa Neuter',
            'openid' => 'Openid',
            'outdent' => 'Outdent',
            'pagelines' => 'Pagelines',
            'paperclip' => 'Paperclip',
            'paper-plane' => 'Paper Plane',
            'paper-plane-o' => 'Paper Plane O',
            'paragraph' => 'Paragraph',
            'paste' => 'Paste',
            'pause' => 'Pause',
            'paw' => 'Paw',
            'pencil' => 'Pencil',
            'pencil-square' => 'Pencil Square',
            'pencil-square-o' => 'Pencil Square O',
            'phone' => 'Phone',
            'phone-square' => 'Phone Square',
            'photo' => 'Photo',
            'picture-o' => 'Picture O',
            'pied-piper' => 'Pied Piper',
            'pied-piper-alt' => 'Pied Piper Alt',
            'pied-piper-square' => 'Pied Piper Square',
            'pinterest' => 'Pinterest',
            'pinterest-p' => 'Pinterest P',
            'pinterest-square' => 'Pinterest Square',
            'plane' => 'Plane',
            'play' => 'Play',
            'play-circle' => 'Play Circle',
            'play-circle-o' => 'Play Circle O',
            'plus' => 'Plus',
            'plus-circle' => 'Plus Circle',
            'plus-square' => 'Plus Square',
            'plus-square-o' => 'Plus Square O',
            'power-off' => 'Power Off',
            'print' => 'Print',
            'puzzle-piece' => 'Puzzle Piece',
            'qq' => 'Qq',
            'qrcode' => 'Qrcode',
            'question' => 'Question',
            'question-circle' => 'Question Circle',
            'quote-left' => 'Quote Left',
            'quote-right' => 'Quote Right',
            'ra' => 'Ra',
            'random' => 'Random',
            'rebel' => 'Rebel',
            'recycle' => 'Recycle',
            'reddit' => 'Reddit',
            'reddit-square' => 'Reddit Square',
            'refresh' => 'Refresh',
            'renren' => 'Renren',
            'reorder' => 'Reorder',
            'repeat' => 'Repeat',
            'reply' => 'Reply',
            'reply-all' => 'Reply All',
            'retweet' => 'Retweet',
            'rmb' => 'Rmb',
            'road' => 'Road',
            'rocket' => 'Rocket',
            'rotate-left' => 'Rotate Left',
            'rotate-right' => 'Rotate Right',
            'rouble' => 'Rouble',
            'rss' => 'Rss',
            'rss-square' => 'Rss Square',
            'rub' => 'Rub',
            'ruble' => 'Ruble',
            'rupee' => 'Rupee',
            'save' => 'Save',
            'scissors' => 'Scissors',
            'search' => 'Search',
            'search-minus' => 'Search Minus',
            'search-plus' => 'Search Plus',
            'sellsy' => 'Sellsy',
            'send' => 'Send',
            'send-o' => 'Send O',
            'server' => 'Fa Server',
            'share' => 'Share',
            'share-alt' => 'Share Alt',
            'share-alt-square' => 'Share Alt Square',
            'share-square' => 'Share Square',
            'share-square-o' => 'Share Square O',
            'shield' => 'Shield',
            'ship' => 'Ship',
            'shirtsinbulk' => 'Shirtsinbulk',
            'shopping-cart' => 'Shopping Cart',
            'signal' => 'Signal',
            'sign-in' => 'Sign In',
            'sign-out' => 'Sign Out',
            'simplybuilt' => 'Simplybuilt',
            'sitemap' => 'Sitemap',
            'skyatlas' => 'Skyatlas',
            'skype' => 'Skype',
            'slack' => 'Slack',
            'sliders' => 'Sliders',
            'smile-o' => 'Smile O',
            'sort' => 'Sort',
            'sort-alpha-asc' => 'Sort Alpha Asc',
            'sort-alpha-desc' => 'Sort Alpha Desc',
            'sort-amount-asc' => 'Sort Amount Asc',
            'sort-amount-desc' => 'Sort Amount Desc',
            'sort-asc' => 'Sort Asc',
            'sort-desc' => 'Sort Desc',
            'sort-down' => 'Sort Down',
            'sort-numeric-asc' => 'Sort Numeric Asc',
            'sort-numeric-desc' => 'Sort Numeric Desc',
            'sort-up' => 'Sort Up',
            'soundcloud' => 'Soundcloud',
            'space-shuttle' => 'Space Shuttle',
            'spinner' => 'Spinner',
            'spoon' => 'Spoon',
            'spotify' => 'Spotify',
            'square' => 'Square',
            'square-o' => 'Square O',
            'stack-exchange' => 'Stack Exchange',
            'stack-overflow' => 'Stack Overflow',
            'star' => 'Star',
            'star-half' => 'Star Half',
            'star-half-empty' => 'Star Half Empty',
            'star-half-full' => 'Star Half Full',
            'star-half-o' => 'Star Half O',
            'star-o' => 'Star O',
            'steam' => 'Steam',
            'steam-square' => 'Steam Square',
            'step-backward' => 'Step Backward',
            'step-forward' => 'Step Forward',
            'stethoscope' => 'Stethoscope',
            'stop' => 'Stop',
            'street-view' => 'Street View',
            'strikethrough' => 'Strikethrough',
            'stumbleupon' => 'Stumbleupon',
            'stumbleupon-circle' => 'Stumbleupon Circle',
            'subscript' => 'Subscript',
            'subway' => 'Fa Subway',
            'suitcase' => 'Suitcase',
            'sun-o' => 'Sun O',
            'superscript' => 'Superscript',
            'support' => 'Support',
            'table' => 'Table',
            'tablet' => 'Tablet',
            'tachometer' => 'Tachometer',
            'tag' => 'Tag',
            'tags' => 'Tags',
            'tasks' => 'Tasks',
            'taxi' => 'Taxi',
            'tencent-weibo' => 'Tencent Weibo',
            'terminal' => 'Terminal',
            'text-height' => 'Text Height',
            'text-width' => 'Text Width',
            'th' => 'Th',
            'th-large' => 'Th Large',
            'th-list' => 'Th List',
            'thumbs-down' => 'Thumbs Down',
            'thumbs-o-down' => 'Thumbs O Down',
            'thumbs-o-up' => 'Thumbs O Up',
            'thumbs-up' => 'Thumbs Up',
            'thumb-tack' => 'Thumb Tack',
            'ticket' => 'Ticket',
            'times' => 'Times',
            'times-circle' => 'Times Circle',
            'times-circle-o' => 'Times Circle O',
            'tint' => 'Tint',
            'toggle-down' => 'Toggle Down',
            'toggle-left' => 'Toggle Left',
            'toggle-right' => 'Toggle Right',
            'toggle-up' => 'Toggle Up',
            'train' => 'Train',
            'transgender' => 'Transgender',
            'transgender-alt' => 'Transgender Alt',
            'trash-o' => 'Trash O',
            'tree' => 'Tree',
            'trello' => 'Trello',
            'trophy' => 'Trophy',
            'truck' => 'Truck',
            'try' => 'Try',
            'tumblr' => 'Tumblr',
            'tumblr-square' => 'Tumblr Square',
            'turkish-lira' => 'Turkish Lira',
            'twitter' => 'Twitter',
            'twitter-square' => 'Twitter Square',
            'umbrella' => 'Umbrella',
            'underline' => 'Underline',
            'undo' => 'Undo',
            'university' => 'University',
            'unlink' => 'Unlink',
            'unlock' => 'Unlock',
            'unlock-alt' => 'Unlock Alt',
            'unsorted' => 'Unsorted',
            'upload' => 'Upload',
            'usd' => 'Usd',
            'user' => 'User',
            'user-md' => 'User Md',
            'user-plus' => 'User Plus',
            'users' => 'Users',
            'user-secret' => 'User Secret',
            'user-times' => 'User Times',
            'venus' => 'Venus',
            'venus-double' => 'Venus Double',
            'venus-mars' => 'Venus Mars',
            'viacoin' => 'Viacoin',
            'video-camera' => 'Video Camera',
            'vimeo-square' => 'Vimeo Square',
            'vine' => 'Vine',
            'vk' => 'Vk',
            'volume-down' => 'Volume Down',
            'volume-off' => 'Volume Off',
            'volume-up' => 'Volume Up',
            'warning' => 'Warning',
            'wechat' => 'Wechat',
            'weibo' => 'Weibo',
            'weixin' => 'Weixin',
            'whatsapp' => 'Whatsapp',
            'wheelchair' => 'Wheelchair',
            'windows' => 'Windows',
            'won' => 'Won',
            'wordpress' => 'Wordpress',
            'wrench' => 'Wrench',
            'xing' => 'Xing',
            'xing-square' => 'Xing Square',
            'yahoo' => 'Yahoo',
            'yen' => 'Yen',
            'youtube' => 'Youtube',
            'youtube-play' => 'Youtube Play',
            'youtube-square' => 'Youtube Square',
        );
        return array_flip($icon);
    }
