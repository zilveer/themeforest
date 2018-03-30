<?php
 
// Define Directories
define( 'mango_dir', get_template_directory () ); // Template Directory
define( 'mango_uri', get_template_directory_uri () ); // Template Directory URI
define( 'mango_css', mango_uri . '/css' ); // CSS URI
define( 'mango_js', mango_uri . '/js' ); // JS URI

define( 'mango_inc', mango_dir . '/inc' ); // Include Directory
define( 'mango_admin', mango_inc . '/admin' ); // Include admnin
define( 'mango_plugins', mango_inc . '/plugins' ); // get plugins directory
define( 'mango_functions', mango_inc . '/functions' ); // get plugins directory
define( 'mango_plugins_uri', mango_uri . '/inc/admin/plugins' ); // get plugins uri
define('MANGO_AJAX_URL', admin_url('admin-ajax.php') );

// Set Content Width
if ( !isset( $content_width ) ) {
    $content_width = 770;
}
get_template_part('inc/plugins/sidebar-generator/sidebar_generator');
// Image Size
//add image sizes
add_image_size( 'portfolio-grid', 370, 240, false );
add_image_size( 'shop-image', 200, 276, false);
add_image_size("single-product",470,630,false);
add_image_size( 'shop-widget', 71, 91, false );

add_image_size("2col-portfolio",420,272, false );
add_image_size("4col-portfolio",270,175, false );
add_image_size("blog-other-style",870,420, false);
add_image_size("blog-image",570,390, false);
add_image_size("thumb_60",60,70, false);

if(!function_exists("mango_setup")){
    function mango_setup(){
        load_theme_textdomain ( 'mango', mango_dir . '/lang' );
// Default RSS feed links
        add_theme_support ( "automatic-feed-links" );
        add_theme_support ( "post-thumbnail" );
        add_theme_support ( "title-tag" );
        add_theme_support ( "html5", array ( 'comment-form', 'comment-list', 'search-form' ) );
        add_theme_support ( 'post-formats', array ( 'gallery', 'image', 'audio', 'video', 'aside', 'link', 'quote', 'chat', 'status' ) );

// Woocommerce Support
        add_theme_support ( "woocommerce" );
        if ( defined ( "WOOCOMMERCE_VERSION" ) ) {
            if ( version_compare ( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
              add_filter ( "woocommerce_enqueue_styles", "__return_false" );
            } else {
                define( "WOOCOMMERCE_USE_CSS", false );
            }
        }
    }
}
add_action("init","mango_setup");

function mango_font_awesome_list(){
    $mango_font_awesome_list =  array(
        'fa fa-adjust' => 'Adjust',
        'fa fa-anchor' => 'Anchor',
        'fa fa-archive' => 'archive',
        'fa fa-arrows' => 'arrows',
        'fa fa fa-arrows-h' => 'arrows-h',
        'fa fa-arrows-v' => 'arrows-v',
        'fa fa-asterisk' => 'asterisk',
        'fa fa-automobile' => 'automobile',
        'fa fa-ban' => 'ban',
        'fa fa-bank' => 'bank',
        'fa fa-bar-chart-o' => 'bar-chart-o',
        'fa fa-barcode' => 'barcode',
        'fa fa-bars' => 'bars',
        'fa fa-beer' => 'beer',
        'fa fa-bell' => 'bell',
        'fa fa-bell-o' => 'bell-o',
        'fa fa-bolt' => 'bolt',
        'fa fa-bomb' => 'bomb',
        'fa fa-book' => 'book',
        'fa fa-bookmark' => 'bookmark',
        'fa fa-bookmark-o' => 'bookmark-o',
        'fa fa-briefcase' => 'briefcase',
        'fa fa-bug' => 'bug',
        'fa fa-building' => 'building',
        'fa fa-building-o' => 'building-o',
        'fa fa-bullhorn' => 'bullhorn',
        'fa fa-bullseye' => 'bullseye',
        'fa fa-cab' => 'cab',
        'fa fa-calendar' => 'calendar',
        'fa fa-calendar-o' => 'calendar-o',
        'fa fa-camera' => 'camera',
        'fa fa-camera-retro' => 'camera-retro',
        'fa fa-car' => 'car',
        'fa fa-caret-square-o-down' => 'caret-square-o-down',
        'fa fa-caret-square-o-left' => 'caret-square-o-left',
        'fa fa-caret-square-o-right' => 'caret-square-o-right',
        'fa fa-caret-square-o-up' => 'caret-square-o-up',
        'fa fa-certificate' => 'certificate',
        'fa fa-check' => 'check',
        'fa fa-check-circle' => 'check-circle',
        'fa fa-check-circle-o' => 'check-circle-o',
        'fa fa-check-square' => 'check-square',
        'fa fa-check-square-o' => 'check-square-o',
        'fa fa-child' => 'child',
        'fa fa-circle' => 'circle',
        'fa fa-circle-o' => 'circle-o',
        'fa fa-circle-o-notch' => 'circle-o-notch',
        'fa fa-circle-thin' => 'circle-thin',
        'fa fa-clock-o' => 'clock-o',
        'fa fa-cloud' => 'cloud',
        'fa fa-cloud-download' => 'cloud-download',
        'fa fa-cloud-upload' => 'cloud-upload',
        'fa fa-code' => 'code',
        'fa fa-code-fork' => 'code-fork',
        'fa fa-coffee' => 'coffee',
        'fa fa-cog' => 'cog',
        'fa fa-cogs' => 'cogs',
        'fa fa-comment' => 'comment',
        'fa fa-comment-o' => 'comment-o',
        'fa fa-comments' => 'comments',
        'fa fa-comments-o' => 'comments-o',
        'fa fa-compass' => 'compass',
        'fa fa-credit-card' => 'credit-card',
        'fa fa-crop' => 'crop',
        'fa fa-crosshairs' => 'crosshairs',
        'fa fa-cube' => 'cube',
        'fa fa-cubes' => 'cubes',
        'fa fa-cutlery' => 'cutlery',
        'fa fa-dashboard' => 'dashboard',
        'fa fa-database' => 'database',
        'fa fa-desktop' => 'desktop',
        'fa fa-dot-circle-o' => 'dot-circle-o',
        'fa fa-download' => 'download',
        'fa fa-edit' => 'edit',
        'fa fa-ellipsis-h' => 'ellipsis-h',
        'fa fa-ellipsis-v' => 'ellipsis-v',
        'fa fa-envelope' => 'envelope',
        'fa fa-envelope-o' => 'envelope-o',
        'fa fa-envelope-square' => 'envelope-square',
        'fa fa-eraser' => 'eraser',
        'fa fa-exchange' => 'exchange',
        'fa fa-exclamation' => 'exclamation',
        'fa fa-exclamation-circle' => 'exclamation-circle',
        'fa fa-exclamation-triangle' => 'exclamation-triangle',
        'fa fa-external-link' => 'external-link',
        'fa fa-external-link-square' => 'external-link-square',
        'fa fa-eye' => 'eye',
        'fa fa-eye-slash' => 'eye-slash',
        'fa fa-fax' => 'fax',
        'fa fa-female' => 'female',
        'fa fa-fighter-jet' => 'fighter-jet',
        'fa fa-file-archive-o' => 'file-archive-o',
        'fa fa-file-audio-o' => 'file-audio-o',
        'fa fa-file-code-o' => 'file-code-o',
        'fa fa-file-excel-o' => 'file-excel-o',
        'fa fa-file-image-o' => 'file-image-o',
        'fa fa-file-movie-o' => 'file-movie-o',
        'fa fa-file-pdf-o' => 'file-pdf-o',
        'fa fa-file-photo-o' => 'file-photo-o',
        'fa fa-file-picture-o' => 'file-picture-o',
        'fa fa-file-powerpoint-o' => 'file-powerpoint-o',
        'fa fa-file-sound-o' => 'file-sound-o',
        'fa fa-file-video-o' => 'file-video-o',
        'fa fa-file-word-o' => 'file-word-o',
        'fa fa-file-zip-o' => 'file-zip-o',
        'fa fa-film' => 'film',
        'fa fa-filter' => 'filter',
        'fa fa-fire' => 'fire',
        'fa fa-fire-extinguisher' => 'fire-extinguisher',
        'fa fa-flag' => 'flag',
        'fa fa-flag-checkered' => 'flag-checkered',
        'fa fa-flag-o' => 'flag-o',
        'fa fa-flash' => 'flash',
        'fa fa-flask' => 'flask',
        'fa fa-folder' => 'folder',
        'fa fa-folder-o' => 'folder-o',
        'fa fa-folder-open' => 'folder-open',
        'fa fa-folder-open-o' => 'folder-open-o',
        'fa fa-frown-o' => 'frown-o',
        'fa fa-gamepad' => 'gamepad',
        'fa fa-gavel' => 'gavel',
        'fa fa-gear' => 'gear',
        'fa fa-gears' => 'gears',
        'fa fa-gift' => 'gift',
        'fa fa-glass' => 'glass',
        'fa fa-globe' => 'globe',
        'fa fa-graduation-cap' => 'graduation-cap',
        'fa fa-group' => 'group',
        'fa fa-hdd-o' => 'hdd-o',
        'fa fa-headphones' => 'headphones',
        'fa fa-heart' => 'heart',
        'fa fa-heart-o' => 'heart-o',
        'fa fa-history' => 'history',
        'fa fa-home' => 'home',
        'fa fa-image' => 'image',
        'fa fa-inbox' => 'inbox',
        'fa fa-info' => 'info',
        'fa fa-info-circle' => 'info-circle',
        'fa fa-institution' => 'institution',
        'fa fa-key' => 'key',
        'fa fa-keyboard-o' => 'keyboard-o',
        'fa fa-language' => 'language',
        'fa fa-laptop' => 'laptop',
        'fa fa-leaf' => 'leaf',
        'fa fa-legal' => 'legal',
        'fa fa-lemon-o' => 'lemon-o',
        'fa fa-level-down' => 'level-down',
        'fa fa-level-up' => 'level-up',
        'fa fa-life-bouy' => 'life-bouy',
        'fa fa-life-ring' => 'life-ring',
        'fa fa-life-saver' => 'life-saver',
        'fa fa-lightbulb-o' => 'lightbulb-o',
        'fa fa-location-arrow' => 'location-arrow',
        'fa fa-lock' => 'lock',
        'fa fa-magic' => 'magic',
        'fa fa-magnet' => 'magnet',
        'fa fa-mail-forward' => 'mail-forward',
        'fa fa-mail-reply' => 'mail-reply',
        'fa fa-mail-reply-all' => 'mail-reply-all',
        'fa fa-male' => 'male',
        'fa fa-map-marker' => 'map-marker',
        'fa fa-meh-o' => 'meh-o',
        'fa fa-microphone' => 'microphone',
        'fa fa-microphone-slash' => 'microphone-slash',
        'fa fa-minus' => 'minus',
        'fa fa-minus-circle' => 'minus-circle',
        'fa fa-minus-square' => 'minus-square',
        'fa fa-minus-square-o' => 'minus-square-o',
        'fa fa-mobile' => 'mobile',
        'fa fa-mobile-phone' => 'mobile-phone',
        'fa fa-money' => 'money',
        'fa fa-moon-o' => 'moon-o',
        'fa fa-mortar-board' => 'mortar-board',
        'fa fa-music' => 'music',
        'fa fa-navicon' => 'navicon',
        'fa fa-paper-plane' => 'paper-plane',
        'fa fa-paper-plane-o' => 'paper-plane-o',
        'fa fa-paw' => 'paw',
        'fa fa-pencil' => 'pencil',
        'fa fa-pencil-square' => 'pencil-square',
        'fa fa-pencil-square-o' => 'pencil-square-o',
        'fa fa-phone' => 'phone',
        'fa fa-phone-square' => 'phone-square',
        'fa fa-photo' => 'photo',
        'fa fa-picture-o' => 'picture-o',
        'fa fa-plane' => 'plane',
        'fa fa-plus' => 'plus',
        'fa fa-plus-circle' => 'plus-circle',
        'fa fa-plus-square' => 'plus-square',
        'fa fa-plus-square-o' => 'plus-square-o',
        'fa fa-power-off' => 'power-off',
        'fa fa-print' => 'print',
        'fa fa-puzzle-piece' => 'puzzle-piece',
        'fa fa-qrcode' => 'qrcode',
        'fa fa-question' => 'question',
        'fa fa-question-circle' => 'question-circle',
        'fa fa-quote-left' => 'quote-left',
        'fa fa-quote-right' => 'quote-right',
        'fa fa-random' => 'random',
        'fa fa-recycle' => 'recycle',
        'fa fa-refresh' => 'refresh',
        'fa fa-reorder' => 'reorder',
        'fa fa-reply' => 'reply',
        'fa fa-reply-all' => 'reply-all',
        'fa fa-retweet' => 'retweet',
        'fa fa-road' => 'road',
        'fa fa-rocket' => 'rocket',
        'fa fa-rss' => 'rss',
        'fa fa-rss-square' => 'rss-square',
        'fa fa-search' => 'search',
        'fa fa-search-minus' => 'search-minus',
        'fa fa-search-plus' => 'search-plus',
        'fa fa-send' => 'send',
        'fa fa-send-o' => 'send-o',
        'fa fa-share' => 'share',
        'fa fa-share-alt' => 'share-alt',
        'fa fa-share-alt-square' => 'share-alt-square',
        'fa fa-share-square' => 'share-square',
        'fa fa-share-square-o' => 'share-square-o',
        'fa fa-shield' => 'shield',
        'fa fa-shopping-cart' => 'shopping-cart',
        'fa fa-sign-in' => 'sign-in',
        'fa fa-sign-out' => 'sign-out',
        'fa fa-signal' => 'signal',
        'fa fa-sitemap' => 'sitemap',
        'fa fa-sliders' => 'sliders',
        'fa fa-smile-o' => 'smile-o',
        'fa fa-sort' => 'sort',
        'fa fa-sort-alpha-asc' => 'sort-alpha-asc',
        'fa fa-sort-alpha-desc' => 'sort-alpha-desc',
        'fa fa-sort-amount-asc' => 'sort-amount-asc',
        'fa fa-sort-amount-desc' => 'sort-amount-desc',
        'fa fa-sort-asc' => 'sort-asc',
        'fa fa-sort-desc' => 'sort-desc',
        'fa fa-sort-down' => 'sort-down',
        'fa fa-sort-numeric-asc' => 'sort-numeric-asc',
        'fa fa-sort-numeric-desc' => 'sort-numeric-desc',
        'fa fa-sort-up' => 'sort-up',
        'fa fa-space-shuttle' => 'space-shuttle',
        'fa fa-spinner' => 'spinner',
        'fa fa-spoon' => 'spoon',
        'fa fa-square' => 'square',
        'fa fa-square-o' => 'square-o',
        'fa fa-star' => 'star',
        'fa fa-star-half' => 'star-half',
        'fa fa-star-half-empty' => 'star-half-empty',
        'fa fa-star-half-full' => 'star-half-full',
        'fa fa-star-half-o' => 'star-half-o',
        'fa fa-star-o' => 'star-o',
        'fa fa-suitcase' => 'suitcase',
        'fa fa-sun-o' => 'sun-o',
        'fa fa-support' => 'support',
        'fa fa-tablet' => 'tablet',
        'fa fa-tachometer' => 'tachometer',
        'fa fa-tag' => 'tag',
        'fa fa-tags' => 'tags',
        'fa fa-tasks' => 'tasks',
        'fa fa-taxi' => 'taxi',
        'fa fa-terminal' => 'terminal',
        'fa fa-thumb-tack' => 'thumb-tack',
        'fa fa-thumbs-down' => 'thumbs-down',
        'fa fa-thumbs-o-down' => 'thumbs-o-down',
        'fa fa-thumbs-o-up' => 'thumbs-o-up',
        'fa fa-thumbs-up' => 'thumbs-up',
        'fa fa-ticket' => 'ticket',
        'fa fa-times' => 'times',
        'fa fa-times-circle' => 'times-circle',
        'fa fa-times-circle-o' => 'times-circle-o',
        'fa fa-tint' => 'tint',
        'fa fa-toggle-down' => 'toggle-down',
        'fa fa-toggle-left' => 'toggle-left',
        'fa fa-toggle-right' => 'toggle-right',
        'fa fa-toggle-up' => 'toggle-up',
        'fa fa-trash-o' => 'trash-o',
        'fa fa-tree' => 'tree',
        'fa fa-trophy' => 'trophy',
        'fa fa-truck' => 'truck',
        'fa fa-umbrella' => 'umbrella',
        'fa fa-university' => 'university',
        'fa fa-unlock' => 'unlock',
        'fa fa-unlock-alt' => 'unlock-alt',
        'fa fa-unsorted' => 'unsorted',
        'fa fa-upload' => 'upload',
        'fa fa-user' => 'user',
        'fa fa-users' => 'users',
        'fa fa-video-camera' => 'video-camera',
        'fa fa-volume-down' => 'volume-down',
        'fa fa-volume-off' => 'volume-off',
        'fa fa-volume-up' => 'volume-up',
        'fa fa-warning' => 'warning',
        'fa fa-wheelchair' => 'wheelchair',
        'fa fa-wrench' => 'wrench',
        'fa fa-file' => 'file',
        'fa fa-file-o' => 'file-o',
        'fa fa-file-text' => 'file-text',
        'fa fa-file-text-o' => 'file-text-o',
        'fa fa-bitcoin' => 'bitcoin',
        'fa fa-btc' => 'btc',
        'fa fa-cny' => 'cny',
        'fa fa-dollar' => 'dollar',
        'fa fa-eur' => 'eur',
        'fa fa-euro' => 'euro',
        'fa fa-gbp' => 'gbp',
        'fa fa-inr' => 'inr',
        'fa fa-jpy' => 'jpy',
        'fa fa-krw' => 'krw',
        'fa fa-rmb' => 'rmb',
        'fa fa-rouble' => 'rouble',
        'fa fa-rub' => 'rub',
        'fa fa-ruble' => 'ruble',
        'fa fa-rupee' => 'rupee',
        'fa fa-try' => 'try',
        'fa fa-turkish-lira' => 'turkish-lira',
        'fa fa-usd' => 'usd',
        'fa fa-won' => 'won',
        'fa fa-yen' => 'yen',
        'fa fa-align-center' => 'align-center',
        'fa fa-align-justify' => 'align-justify',
        'fa fa-align-left' => 'align-left',
        'fa fa-align-right' => 'align-right',
        'fa fa-bold' => 'bold',
        'fa fa-chain' => 'chain',
        'fa fa-chain-broken' => 'chain-broken',
        'fa fa-clipboard' => 'clipboard',
        'fa fa-columns' => 'columns',
        'fa fa-copy' => 'copy',
        'fa fa-cut' => 'cut',
        'fa fa-dedent' => 'dedent',
        'fa fa-files-o' => 'files-o',
        'fa fa-floppy-o' => 'floppy-o',
        'fa fa-font' => 'font',
        'fa fa-header' => 'header',
        'fa fa-indent' => 'indent',
        'fa fa-italic' => 'italic',
        'fa fa-link' => 'link',
        'fa fa-list' => 'list',
        'fa fa-list-alt' => 'list-alt',
        'fa fa-list-ol' => 'list-ol',
        'fa fa-list-ul' => 'list-ul',
        'fa fa-outdent' => 'outdent',
        'fa fa-paperclip' => 'paperclip',
        'fa fa-paragraph' => 'paragraph',
        'fa fa-paste' => 'paste',
        'fa fa-repeat' => 'repeat',
        'fa fa-rotate-left' => 'rotate-left',
        'fa fa-rotate-right' => 'rotate-right',
        'fa fa-save' => 'save',
        'fa fa-scissors' => 'scissors',
        'fa fa-strikethrough' => 'strikethrough',
        'fa fa-subscript' => 'subscript',
        'fa fa-superscript' => 'superscript',
        'fa fa-table' => 'table',
        'fa fa-text-height' => 'text-height',
        'fa fa-text-width' => 'text-width',
        'fa fa-th' => 'th',
        'fa fa-th-large' => 'th-large',
        'fa fa-th-list' => 'th-list',
        'fa fa-underline' => 'underline',
        'fa fa-undo' => 'undo',
        'fa fa-unlink' => 'unlink',
        'fa fa-angle-double-down' => 'angle-double-down',
        'fa fa-angle-double-left' => 'angle-double-left',
        'fa fa-angle-double-right' => 'angle-double-right',
        'fa fa-angle-double-up' => 'angle-double-up',
        'fa fa-angle-down' => 'angle-down',
        'fa fa-angle-left' => 'angle-left',
        'fa fa-angle-right' => 'angle-right',
        'fa fa-angle-up' => 'angle-up',
        'fa fa-arrow-circle-down' => 'arrow-circle-down',
        'fa fa-arrow-circle-left' => 'arrow-circle-left',
        'fa fa-arrow-circle-o-down' => 'arrow-circle-o-down',
        'fa fa-arrow-circle-o-left' => 'arrow-circle-o-left',
        'fa fa-arrow-circle-o-right' => 'arrow-circle-o-right',
        'fa fa-arrow-circle-o-up' => 'arrow-circle-o-up',
        'fa fa-arrow-circle-right' => 'arrow-circle-right',
        'fa fa-arrow-circle-up' => 'arrow-circle-up',
        'fa fa-arrow-down' => 'arrow-down',
        'fa fa-arrow-left' => 'arrow-left',
        'fa fa-arrow-right' => 'arrow-right',
        'fa fa-arrow-up' => 'arrow-up',
        'fa fa-arrows-alt' => 'arrows-alt',
        'fa fa-caret-down' => 'caret-down',
        'fa fa-caret-left' => 'caret-left',
        'fa fa-caret-right' => 'caret-right',
        'fa fa-caret-up' => 'caret-up',
        'fa fa-chevron-circle-down' => 'chevron-circle-down',
        'fa fa-chevron-circle-left' => 'chevron-circle-left',
        'fa fa-chevron-circle-right' => 'chevron-circle-right',
        'fa fa-chevron-circle-up' => 'chevron-circle-up',
        'fa fa-chevron-down' => 'chevron-down',
        'fa fa-chevron-left' => 'chevron-left',
        'fa fa-chevron-right' => 'chevron-right',
        'fa fa-chevron-up' => 'chevron-up',
        'fa fa-hand-o-down' => 'hand-o-down',
        'fa fa-hand-o-left' => 'hand-o-left',
        'fa fa-hand-o-right' => 'hand-o-right',
        'fa fa-hand-o-up' => 'hand-o-up',
        'fa fa-long-arrow-down' => 'long-arrow-down',
        'fa fa-long-arrow-left' => 'long-arrow-left',
        'fa fa-long-arrow-right' => 'long-arrow-right',
        'fa fa-long-arrow-up' => 'long-arrow-up',
        'fa fa-backward' => 'backward',
        'fa fa-compress' => 'compress',
        'fa fa-eject' => 'eject',
        'fa fa-expand' => 'expand',
        'fa fa-fast-backward' => 'fast-backward',
        'fa fa-fast-forward' => 'fast-forward',
        'fa fa-forward' => 'forward',
        'fa fa-pause' => 'pause',
        'fa fa-play' => 'play',
        'fa fa-play-circle' => 'play-circle',
        'fa fa-play-circle-o' => 'play-circle-o',
        'fa fa-step-backward' => 'step-backward',
        'fa fa-step-forward' => 'step-forward',
        'fa fa-stop' => 'stop',
        'fa fa-youtube-play' => 'youtube-play',
        'fa fa-adn' => 'adn',
        'fa fa-android' => 'android',
        'fa fa-apple' => 'apple',
        'fa fa-behance' => 'behance',
        'fa fa-behance-square' => 'behance-square',
        'fa fa-bitbucket' => 'bitbucket',
        'fa fa-bitbucket-square' => 'bitbucket-square',
        'fa fa-codepen' => 'codepen',
        'fa fa-css3' => 'css3',
        'fa fa-delicious' => 'delicious',
        'fa fa-deviantart' => 'deviantart',
        'fa fa-digg' => 'digg',
        'fa fa-dribbble' => 'dribbble',
        'fa fa-dropbox' => 'dropbox',
        'fa fa-drupal' => 'drupal',
        'fa fa-empire' => 'empire',
        'fa fa-facebook' => 'facebook',
        'fa fa-facebook-square' => 'facebook-square',
        'fa fa-flickr' => 'flickr',
        'fa fa-foursquare' => 'foursquare',
        'fa fa-ge' => 'ge',
        'fa fa-git' => 'git',
        'fa fa-git-square' => 'git-square',
        'fa fa-github' => 'github',
        'fa fa-github-alt' => 'github-alt',
        'fa fa-github-square' => 'github-square',
        'fa fa-gittip' => 'gittip',
        'fa fa-google' => 'google',
        'fa fa-google-plus' => 'google-plus',
        'fa fa-google-plus-square' => 'google-plus-square',
        'fa fa-hacker-news' => 'hacker-news',
        'fa fa-html5' => 'html5',
        'fa fa-instagram' => 'instagram',
        'fa fa-joomla' => 'joomla',
        'fa fa-jsfiddle' => 'jsfiddle',
        'fa fa-linkedin' => 'linkedin',
        'fa fa-linkedin-square' => 'linkedin-square',
        'fa fa-linux' => 'linux',
        'fa fa-maxcdn' => 'maxcdn',
        'fa fa-openid' => 'openid',
        'fa fa-pagelines' => 'pagelines',
        'fa fa-pied-piper' => 'pied-piper',
        'fa fa-pied-piper-alt' => 'pied-piper-alt',
        'fa fa-pied-piper-square' => 'pied-piper-square',
        'fa fa-pinterest' => 'pinterest',
        'fa fa-pinterest-square' => 'pinterest-square',
        'fa fa-qq' => 'qq',
        'fa fa-ra' => 'ra',
        'fa fa-rebel' => 'rebel',
        'fa fa-reddit' => 'reddit',
        'fa fa-reddit-square' => 'reddit-square',
        'fa fa-renren' => 'renren',
        'fa fa-skype' => 'skype',
        'fa fa-slack' => 'slack',
        'fa fa-soundcloud' => 'soundcloud',
        'fa fa-spotify' => 'spotify',
        'fa fa-stack-exchange' => 'stack-exchange',
        'fa fa-stack-overflow' => 'stack-overflow',
        'fa fa-steam' => 'steam',
        'fa fa-steam-square' => 'steam-square',
        'fa fa-stumbleupon' => 'stumbleupon',
        'fa fa-stumbleupon-circle' => 'stumbleupon-circle',
        'fa fa-tencent-weibo' => 'tencent-weibo',
        'fa fa-trello' => 'trello',
        'fa fa-tumblr' => 'tumblr',
        'fa fa-tumblr-square' => 'tumblr-square',
        'fa fa-twitter' => 'twitter',
        'fa fa-twitter-square' => 'twitter-square',
        'fa fa-vimeo-square' => 'vimeo-square',
        'fa fa-vine' => 'vine',
        'fa fa-vk' => 'vk',
        'fa fa-wechat' => 'wechat',
        'fa fa-weibo' => 'weibo',
        'fa fa-weixin' => 'weixin',
        'fa fa-windows' => 'windows',
        'fa fa-wordpress' => 'wordpress',
        'fa fa-xing' => 'xing',
        'fa fa-xing-square' => 'xing-square',
        'fa fa-yahoo' => 'yahoo',
        'fa fa-youtube' => 'youtube',
        'fa fa-youtube-square' => 'youtube-square',
        'fa fa-ambulance' => 'ambulance',
        'fa fa-h-square' => 'h-square',
        'fa fa-hospital-o' => 'hospital-o',
        'fa fa-medkit' => 'medkit',
        'fa fa-stethoscope' => 'stethoscope',
        'fa fa-user-md' => 'user-md',
    );
    return $mango_font_awesome_list;
}

function mango_get_coming_soon_pages(){
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'templates/coming_soon.php'
    ));
    $ret = array();
    if(!empty($pages)){
        foreach($pages as $page) {
            $ret[ $page->ID ] = $page->post_title;
        }
    }
    return $ret;
}

add_action( "wp_head", "mango_check_coming_soon" );
function mango_check_coming_soon() {
    global $mango_settings;
    if( !is_page_template("templates/coming_soon.php") && !current_user_can( 'manage_options' ) &&  $mango_settings[ 'mango_coming_soon_mode' ]   && $mango_settings['mango_coming_soon_page'] ) {
    ?>
        <script>
            window.location.href = "<?php echo esc_url(get_the_permalink($mango_settings[ 'mango_coming_soon_page' ])) ?>";
        </script>
    <?php exit; }
}

// Define Variables
$theme = wp_get_theme ();
define( 'mango_version', $theme->get ( 'Version' ) );

/**
 * Embedded Redux Framework
 */

if ( file_exists ( mango_admin . '/mango/functions.php' ) ) {
    require_once ( mango_admin . '/mango/functions.php' );
}

if ( !class_exists ( 'ReduxFramework' ) && file_exists ( mango_admin.'/ReduxCore/framework.php' ) ) {
    require_once ( mango_admin .'/ReduxCore/framework.php' );
}
global $mango_settings;
// mango Settings Options
if ( !isset( $mango_settings ) && file_exists ( mango_admin.'/theme_options.php' ) ) {
    require_once ( mango_admin.'/theme_options.php' );
}
if ( !function_exists ( 'mango_styles_scripts' ) ):
    function mango_styles_scripts () {
        global $wp_scripts, $wp_styles, $is_IE, $is_gecko, $mango_settings, $post;
        // default font
        wp_deregister_style ( 'open-sans' );
        wp_register_style ( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' );
        wp_enqueue_style ( 'open-sans' );

        // plugin styles
        wp_deregister_style ( 'plugins' );
        wp_register_style ( 'plugins', mango_css . '/plugins.css' );
        wp_enqueue_style ( 'plugins' );

        // default styles
        do_action ( "load_child_stylesheet" );
        wp_deregister_style ( 'style' );
        wp_register_style ( 'style', get_stylesheet_uri () );
        wp_enqueue_style ( 'style' );

        wp_dequeue_script("jquery-selectBox");
        wp_dequeue_style("jquery-selectBox");

        $filename = mango_dir.'/_config/settings_'.get_current_blog_id().'.css';
        if(file_exists($filename)){
            wp_register_style ( 'settings_', mango_uri . '/_config/settings_'.get_current_blog_id().'.css' );
            wp_enqueue_style ( 'settings_' );
        }

        //wp_register_style ( 'mango_custom_color', mango_css . '/colors/blue2.css' );
        //wp_enqueue_style ( 'mango_custom_color' );
        ?>
        <script type="text/javascript">
            /* <![CDATA[ */
            var js_sys_template_uri = "<?php echo esc_js( get_template_directory_uri() ); ?>";
            var ajaxurl = "<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>";
            /* ]]> */
        </script>
        <?php
        if(is_page_template("templates/contact.php")) {
           $arr["lat"] = get_option("mango_lat");
           $arr["lng"] = get_option("mango_lng");
           // if($arr["lat"] !='' && $arr["lng"] !='') {
                $arr['addres'] = get_post_meta ( $post->ID, 'mango_contact_address', true ) ? get_post_meta ( $post->ID, 'mango_contact_address', true ) : '';
                $arr['pin_path'] = mango_uri.'/images/pin.png';
                wp_enqueue_script ( "google-map-api", "//maps.googleapis.com/maps/api/js?sensor=false", array (), null, true );
                wp_register_script( "google-map", mango_js . "/map.js", array (), null, true );
                wp_localize_script( 'google-map', 'js_mango_vars', $arr );
                wp_enqueue_script ( 'google-map');
           // }
        }
        wp_localize_script ( 'mango-js', 'js_mango_vars', array () );
        //@todo: add js files here
        //head js files
        wp_register_script ( 'modernizr', mango_js . '/modernizr.js', array ( 'jquery' ) );
        wp_enqueue_script ( 'modernizr' );

        //footer js files
        wp_register_script ( 'plugins', mango_js . "/plugins.js", array ( 'jquery' ), null, true );
        wp_enqueue_script ( 'plugins' );
        if(is_page_template("templates/coming_soon.php")){
            wp_register_script ( 'countdown_plugin', mango_js . "/jquery.countdown.plugin.min.js", array ( 'jquery' ), null, true );
            wp_enqueue_script ( 'countdown_plugin' );
            wp_register_script ( 'countdown', mango_js . "/jquery.countdown.min.js", array ( 'jquery' ), null, true );
            wp_enqueue_script ( 'countdown' );
        }
        wp_register_script ( 'main', mango_js . "/main.js", array ( 'jquery' ), null, true );
        wp_enqueue_script ( 'main' );

        if ( is_singular() ) {
            wp_enqueue_script ( "comment-reply" );
        }
		
		wp_register_script ( 'scroller', mango_js . "/skrollr.js", array ( 'jquery' ), null, true );
		wp_enqueue_script ( 'scroller' );
    }
endif;
add_action ( 'wp_enqueue_scripts', 'mango_styles_scripts' );
//custom icons for iconizer plugin
add_filter( 'iconize_fonts_styles', 'mango_iconize_styles' );
function mango_iconize_styles( $array ) {
        $array['simple_line_icons'] = array(
            'path' =>  mango_dir. '/css/simple_line_icons.css',
            'url' =>   mango_uri. '/css/simple_line_icons.css'
        );
    return $array;
}

// Load Admin CSS
if ( !function_exists ( 'mango_admin_css' ) ):
    function mango_admin_css () {
        /*@todo - AHSAN */
        if (function_exists('add_thickbox'))
            //add_thickbox();

        wp_enqueue_media();
        wp_enqueue_style('mango_admin_css', mango_css . '/admin.css', false, mango_version, 'all');
        wp_register_style('plugins_chosen', mango_css . '/chosen.css');
        wp_enqueue_style('plugins_chosen');
        wp_enqueue_style ( 'mango_admin_font_awesome', mango_css . '/font-awesome.min.css', false, mango_version, 'all' );
        /* End */
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        wp_enqueue_script('mango_admin_js', mango_js . '/admin.js', false, mango_version, 'all');
        wp_enqueue_script('mango_choosen_js', mango_js . '/admin/chosen.jquery.js', false, mango_version, 'all');
        wp_enqueue_script('mango__admin_js', mango_js . '/admin/admin.js', false, mango_version, 'all');
     
    }
endif;
add_action ( 'admin_enqueue_scripts', 'mango_admin_css' );
// Include Functions

require_once( mango_inc.'/menu/menu-option.php' );
require_once ( mango_functions . '/functions.php' );


// Revolution Slider Upadte Close
	if(function_exists( 'set_revslider_as_theme' )){
			add_action( 'init', 'disable_rev_slider' );
			function disable_rev_slider() {
				set_revslider_as_theme();
			}
	}
	
add_action('admin_head', 'remove_message');
function  remove_message() {
  echo '<style>
   div.green.below-h2{
      display: none !important;
    } 
	 div#sidebar-1 {
  display: none !important;
}
div#widgets-right .widgets-holder-wrap{
 border: none;
}
.update-nag.bsf-update-nag {
    display: none;
}
div#message{
	  display: none;
	
}

.vc_add-element-container .wpb-elements-list.vc_filter-all .wpb-layout-element-button.vc_element-deprecated[data-element="vc_tabs"],.vc_add-element-container .wpb-elements-list.vc_filter-all .wpb-layout-element-button.vc_element-deprecated[data-element="vc_tab"],.vc_add-element-container .wpb-elements-list.vc_filter-all .wpb-layout-element-button.vc_element-deprecated[data-element="vc_tour"],.vc_add-element-container .wpb-elements-list.vc_filter-all .wpb-layout-element-button.vc_element-deprecated[data-element="vc_accordion"],.vc_add-element-container .wpb-elements-list.vc_filter-all .wpb-layout-element-button.vc_element-deprecated[data-element="vc_accordion_tab"] { 
    display: block;
  }
  
.vc_add-element-container .wpb-content-layouts li.vc_element-deprecated.js-category-deprecated{
	display:block !important
}
.vc_row.vc_ui-flex-row.vc_shortcode-edit-form-deprecated-message {
    display: none;
}
  </style>';
}
function get($var)
{
	return isset($_GET[$var]) ? $_GET[$var] : (isset($_REQUEST[$var]) ? $_REQUEST[$var] : '');
}

function disable_iconize_on_nav_menus() {
    $array = array(
        'enabled'=> false,
        'show_in_options' => true
    );
    return $array;
}
add_filter( 'iconize_nav_menus', 'disable_iconize_on_nav_menus' );
function custom_wc_ajax_variation_threshold( $qty, $product ) {
	return 1000;
 }
 add_filter( 'woocommerce_ajax_variation_threshold', 'custom_wc_ajax_variation_threshold', 1000, 2 );
 
 
 
function add_more_buttons($buttons) {
$buttons[] = 'hr';
$buttons[] = 'del';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'cleanup';
$buttons[] = 'styleselect';
return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");


// Add custom Fonts to the Fonts list
if( !function_exists( 'wpex_mce_google_fonts_array' ) ) {
    function wpex_mce_google_fonts_array( $initArray ) {
        $initArray[ 'font_formats' ] = 'Raliway=railway;Monsterrat=monsterrat;Lato=lato;Open Sans=Open Sans;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings;Wingdings=wingdings,zapf dingbats';
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_google_fonts_array' );

/** Login with E-Mail address */
function loginWithEmailAddress( &$username ) {
    $user = get_user_by( 'email', $username );
    if ( !empty( $user->user_login ) )
        $username = $user->user_login;
    return $username;
}
add_action( 'wp_authenticate','loginWithEmailAddress' );