<?php

//
// Custom Visual Composer Scripts for a Theme Integration
//

//vc_disable_frontend();

vc_remove_element('vc_raw_js');
vc_remove_element('vc_wp_tagcloud');
vc_remove_element('vc_wp_custommenu');
vc_remove_element('vc_wp_links');
vc_remove_element('vc_basic_grid');
vc_remove_element('vc_wp_search');
vc_remove_element('vc_wp_meta');
vc_remove_element('vc_wp_text');
vc_remove_element('vc_wp_categories');
vc_remove_element('vc_wp_archives');
vc_remove_element('vc_wp_rss');
vc_remove_element('vc_wp_calendar');
vc_remove_element('vc_gmaps');
vc_remove_element('vc_posts_slider');
vc_remove_element('vc_carousel');
vc_remove_element('vc_posts_grid');
vc_remove_element('vc_wp_pages');
vc_remove_element('vc_wp_recentcomments');
vc_remove_element('vc_wp_posts');
vc_remove_element('vc_flickr');
vc_remove_element('vc_pinterest');
vc_remove_element('vc_button');
vc_remove_element('vc_button2'); // do
vc_remove_element('vc_cta_button');
vc_remove_element('vc_cta_button2');
vc_remove_element('contact-form-7');
vc_remove_element('vc_masonry_grid');
vc_remove_element('vc_pie');

vc_remove_param("vc_progress_bar","custombgcolor");
vc_remove_param("vc_progress_bar","customtxtcolor");

// v. 4.9
vc_remove_param("vc_row","gap");
vc_remove_param("vc_row","equal_height");
vc_remove_param("vc_row","columns_placement");
// v. 4.10
vc_remove_param("vc_row","parallax_speed_bg");
vc_remove_param("vc_row","parallax_speed_video");

// Font Awesome Icons Param

function th_init_icons_param($settings, $value) {
    //return 'null';
}
vc_add_shortcode_param('init_icons', 'th_init_icons_param', get_template_directory_uri().'/wpbakery/assets/icon-init.js');

function th_fontawesome_array() {
    $icons = array (
		'fa-glass' => 'fa-glass',
		'fa-music' => 'fa-music',
        'fa-search' => 'fa-search',
        'fa-envelope-o' => 'fa-envelope-o',
        'fa-heart' => 'fa-heart',
        'fa-star' => 'fa-star',
        'fa-star-o' => 'fa-star-o',
        'fa-user' => 'fa-user',
        'fa-film' => 'fa-film',
        'fa-th-large' => 'fa-th-large',
        'fa-th' => 'fa-th',
        'fa-th-list' => 'fa-th-list',
        'fa-check' => 'fa-check',
        'fa-times' => 'fa-times',
        'fa-search-plus' => 'fa-search-plus',
        'fa-search-minus' => 'fa-search-minus',
        'fa-power-off' => 'fa-power-off',
        'fa-signal' => 'fa-signal',
        'fa-cog' => 'fa-cog',
        'fa-trash-o' => 'fa-trash-o',
        'fa-home' => 'fa-home',
        'fa-file-o' => 'fa-file-o',
        'fa-clock-o' => 'fa-clock-o',
        'fa-road' => 'fa-road',
        'fa-download' => 'fa-download',
        'fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down',
        'fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up',
        'fa-inbox' => 'fa-inbox',
        'fa-play-circle-o' => 'fa-play-circle-o',
        'fa-repeat' => 'fa-repeat',
        'fa-refresh' => 'fa-refresh',
        'fa-list-alt' => 'fa-list-alt',
        'fa-lock' => 'fa-lock',
        'fa-flag' => 'fa-flag',
        'fa-headphones' => 'fa-headphones',
        'fa-volume-off' => 'fa-volume-off',
        'fa-volume-down' => 'fa-volume-down',
        'fa-volume-up' => 'fa-volume-up',
        'fa-qrcode' => 'fa-qrcode',
        'fa-barcode' => 'fa-barcode',
        'fa-tag' => 'fa-tag',
        'fa-tags' => 'fa-tags',
        'fa-book' => 'fa-book',
        'fa-bookmark' => 'fa-bookmark',
        'fa-print' => 'fa-print',
        'fa-camera' => 'fa-camera',
        'fa-font' => 'fa-font',
        'fa-bold' => 'fa-bold',
        'fa-italic' => 'fa-italic',
        'fa-text-height' => 'fa-text-height',
        'fa-text-width' => 'fa-text-width',
        'fa-align-left' => 'fa-align-left',
        'fa-align-center' => 'fa-align-center',
        'fa-align-right' => 'fa-align-right',
        'fa-align-justify' => 'fa-align-justify',
        'fa-list' => 'fa-list',
        'fa-outdent' => 'fa-outdent',
        'fa-indent' => 'fa-indent',
        'fa-video-camera' => 'fa-video-camera',
        'fa-picture-o' => 'fa-picture-o',
        'fa-pencil' => 'fa-pencil',
        'fa-map-marker' => 'fa-map-marker',
        'fa-adjust' => 'fa-adjust',
        'fa-tint' => 'fa-tint',
        'fa-pencil-square-o' => 'fa-pencil-square-o',
        'fa-share-square-o' => 'fa-share-square-o',
        'fa-check-square-o' => 'fa-check-square-o',
        'fa-arrows' => 'fa-arrows',
        'fa-step-backward' => 'fa-step-backward',
        'fa-fast-backward' => 'fa-fast-backward',
        'fa-backward' => 'fa-backward',
        'fa-play' => 'fa-play',
        'fa-pause' => 'fa-pause',
        'fa-stop' => 'fa-stop',
        'fa-forward' => 'fa-forward',
        'fa-fast-forward' => 'fa-fast-forward',
        'fa-step-forward' => 'fa-step-forward',
        'fa-eject' => 'fa-eject',
        'fa-chevron-left' => 'fa-chevron-left',
        'fa-chevron-right' => 'fa-chevron-right',
        'fa-plus-circle' => 'fa-plus-circle',
        'fa-minus-circle' => 'fa-minus-circle',
        'fa-times-circle' => 'fa-times-circle',
        'fa-check-circle' => 'fa-check-circle',
        'fa-question-circle' => 'fa-question-circle',
        'fa-info-circle' => 'fa-info-circle',
        'fa-crosshairs' => 'fa-crosshairs',
        'fa-times-circle-o' => 'fa-times-circle-o',
        'fa-check-circle-o' => 'fa-check-circle-o',
        'fa-ban' => 'fa-ban',
        'fa-arrow-left' => 'fa-arrow-left',
        'fa-arrow-right' => 'fa-arrow-right',
        'fa-arrow-up' => 'fa-arrow-up',
        'fa-arrow-down' => 'fa-arrow-down',
        'fa-share' => 'fa-share',
        'fa-expand' => 'fa-expand',
        'fa-compress' => 'fa-compress',
        'fa-plus' => 'fa-plus',
        'fa-minus' => 'fa-minus',
        'fa-asterisk' => 'fa-asterisk',
        'fa-exclamation-circle' => 'fa-exclamation-circle',
        'fa-gift' => 'fa-gift',
        'fa-leaf' => 'fa-leaf',
        'fa-fire' => 'fa-fire',
        'fa-eye' => 'fa-eye',
        'fa-eye-slash' => 'fa-eye-slash',
        'fa-exclamation-triangle' => 'fa-exclamation-triangle',
        'fa-plane' => 'fa-plane',
        'fa-calendar' => 'fa-calendar',
        'fa-random' => 'fa-random',
        'fa-comment' => 'fa-comment',
        'fa-magnet' => 'fa-magnet',
        'fa-chevron-up' => 'fa-chevron-up',
        'fa-chevron-down' => 'fa-chevron-down',
        'fa-retweet' => 'fa-retweet',
        'fa-shopping-cart' => 'fa-shopping-cart',
        'fa-folder' => 'fa-folder',
        'fa-folder-open' => 'fa-folder-open',
        'fa-arrows-v' => 'fa-arrows-v',
        'fa-arrows-h' => 'fa-arrows-h',
        'fa-bar-chart-o' => 'fa-bar-chart-o',
        'fa-twitter-square' => 'fa-twitter-square',
        'fa-facebook-square' => 'fa-facebook-square',
        'fa-camera-retro' => 'fa-camera-retro',
        'fa-key' => 'fa-key',
        'fa-cogs' => 'fa-cogs',
        'fa-comments' => 'fa-comments',
        'fa-thumbs-o-up' => 'fa-thumbs-o-up',
        'fa-thumbs-o-down' => 'fa-thumbs-o-down',
        'fa-star-half' => 'fa-star-half',
        'fa-heart-o' => 'fa-heart-o',
        'fa-sign-out' => 'fa-sign-out',
        'fa-linkedin-square' => 'fa-linkedin-square',
        'fa-thumb-tack' => 'fa-thumb-tack',
        'fa-external-link' => 'fa-external-link',
        'fa-sign-in' => 'fa-sign-in',
        'fa-trophy' => 'fa-trophy',
        'fa-github-square' => 'fa-github-square',
        'fa-upload' => 'fa-upload',
        'fa-lemon-o' => 'fa-lemon-o',
        'fa-phone' => 'fa-phone',
        'fa-square-o' => 'fa-square-o',
        'fa-bookmark-o' => 'fa-bookmark-o',
        'fa-phone-square' => 'fa-phone-square',
        'fa-twitter' => 'fa-twitter',
        'fa-facebook' => 'fa-facebook',
        'fa-github' => 'fa-github',
        'fa-unlock' => 'fa-unlock',
        'fa-credit-card' => 'fa-credit-card',
        'fa-rss' => 'fa-rss',
        'fa-hdd-o' => 'fa-hdd-o',
        'fa-bullhorn' => 'fa-bullhorn',
        'fa-bell' => 'fa-bell',
        'fa-certificate' => 'fa-certificate',
        'fa-hand-o-right' => 'fa-hand-o-right',
        'fa-hand-o-left' => 'fa-hand-o-left',
        'fa-hand-o-up' => 'fa-hand-o-up',
        'fa-hand-o-down' => 'fa-hand-o-down',
        'fa-arrow-circle-left' => 'fa-arrow-circle-left',
        'fa-arrow-circle-right' => 'fa-arrow-circle-right',
        'fa-arrow-circle-up' => 'fa-arrow-circle-up',
        'fa-arrow-circle-down' => 'fa-arrow-circle-down',
        'fa-globe' => 'fa-globe',
        'fa-wrench' => 'fa-wrench',
        'fa-tasks' => 'fa-tasks',
        'fa-filter' => 'fa-filter',
        'fa-briefcase' => 'fa-briefcase',
        'fa-arrows-alt' => 'fa-arrows-alt',
        'fa-users' => 'fa-users',
        'fa-link' => 'fa-link',
        'fa-cloud' => 'fa-cloud',
        'fa-flask' => 'fa-flask',
        'fa-scissors' => 'fa-scissors',
        'fa-files-o' => 'fa-files-o',
        'fa-paperclip' => 'fa-paperclip',
        'fa-floppy-o' => 'fa-floppy-o',
        'fa-square' => 'fa-square',
        'fa-bars' => 'fa-bars',
        'fa-list-ul' => 'fa-list-ul',
        'fa-list-ol' => 'fa-list-ol',
        'fa-strikethrough' => 'fa-strikethrough',
        'fa-underline' => 'fa-underline',
        'fa-table' => 'fa-table',
        'fa-magic' => 'fa-magic',
        'fa-truck' => 'fa-truck',
        'fa-pinterest' => 'fa-pinterest',
        'fa-pinterest-square' => 'fa-pinterest-square',
        'fa-google-plus-square' => 'fa-google-plus-square',
        'fa-google-plus' => 'fa-google-plus',
        'fa-money' => 'fa-money',
        'fa-caret-down' => 'fa-caret-down',
        'fa-caret-up' => 'fa-caret-up',
        'fa-caret-left' => 'fa-caret-left',
        'fa-caret-right' => 'fa-caret-right',
        'fa-columns' => 'fa-columns',
        'fa-sort' => 'fa-sort',
        'fa-sort-desc' => 'fa-sort-desc',
        'fa-sort-asc' => 'fa-sort-asc',
        'fa-envelope' => 'fa-envelope',
        'fa-linkedin' => 'fa-linkedin',

        'fa-undo' => 'fa-undo',
        'fa-gavel' => 'fa-gavel',
        'fa-tachometer' => 'fa-tachometer',
        'fa-comment-o' => 'fa-comment-o',
        'fa-comments-o' => 'fa-comments-o',
        'fa-bolt' => 'fa-bolt',
        'fa-sitemap' => 'fa-sitemap',
        'fa-umbrella' => 'fa-umbrella',
        'fa-clipboard' => 'fa-clipboard',
        'fa-lightbulb-o' => 'fa-lightbulb-o',
        'fa-exchange' => 'fa-exchange',
        'fa-cloud-download' => 'fa-cloud-download',
        'fa-cloud-upload' => 'fa-cloud-upload',
        'fa-user-md' => 'fa-user-md',
        'fa-stethoscope' => 'fa-stethoscope',
        'fa-suitcase' => 'fa-suitcase',
        'fa-bell-o' => 'fa-bell-o',
        'fa-coffee' => 'fa-coffee',
        'fa-cutlery' => 'fa-cutlery',
        'fa-file-text-o' => 'fa-file-text-o',
        'fa-building-o' => 'fa-building-o',
        'fa-hospital-o' => 'fa-hospital-o',
        'fa-ambulance' => 'fa-ambulance',
        'fa-medkit' => 'fa-medkit',
        'fa-fighter-jet' => 'fa-fighter-jet',
        'fa-beer' => 'fa-beer',
        'fa-h-square' => 'fa-h-square',
        'fa-plus-square' => 'fa-plus-square',
        'fa-angle-double-left' => 'fa-angle-double-left',
        'fa-angle-double-right' => 'fa-angle-double-right',
        'fa-angle-double-up' => 'fa-angle-double-up',
        'fa-angle-double-down' => 'fa-angle-double-down',
        'fa-angle-left' => 'fa-angle-left',
        'fa-angle-right' => 'fa-angle-right',
        'fa-angle-up' => 'fa-angle-up',
        'fa-angle-down' => 'fa-angle-down',
        'fa-desktop' => 'fa-desktop',
        'fa-laptop' => 'fa-laptop',
        'fa-tablet' => 'fa-tablet',
        'fa-mobile' => 'fa-mobile',
        'fa-circle-o' => 'fa-circle-o',
        'fa-quote-left' => 'fa-quote-left',
        'fa-quote-right' => 'fa-quote-right',
        'fa-spinner' => 'fa-spinner',
        'fa-circle' => 'fa-circle',
        'fa-reply' => 'fa-reply',
        'fa-github-alt' => 'fa-github-alt',
        'fa-folder-o' => 'fa-folder-o',
        'fa-folder-open-o' => 'fa-folder-open-o',
        'fa-smile-o' => 'fa-smile-o',
        'fa-frown-o' => 'fa-frown-o',
        'fa-meh-o' => 'fa-meh-o',
        'fa-gamepad' => 'fa-gamepad',
        'fa-keyboard-o' => 'fa-keyboard-o',
        'fa-flag-o' => 'fa-flag-o',
        'fa-flag-checkered' => 'fa-flag-checkered',
        'fa-terminal' => 'fa-terminal',
        'fa-code' => 'fa-code',
        'fa-reply-all' => 'fa-reply-all',
        'fa-star-half-o' => 'fa-star-half-o',
        'fa-location-arrow' => 'fa-location-arrow',
        'fa-crop' => 'fa-crop',
        'fa-code-fork' => 'fa-code-fork',
        'fa-chain-broken' => 'fa-chain-broken',
        'fa-question' => 'fa-question',
        'fa-info' => 'fa-info',
        'fa-exclamation' => 'fa-exclamation',
        'fa-superscript' => 'fa-superscript',
        'fa-subscript' => 'fa-subscript',
        'fa-eraser' => 'fa-eraser',
        'fa-puzzle-piece' => 'fa-puzzle-piece',
        'fa-microphone' => 'fa-microphone',
        'fa-microphone-slash' => 'fa-microphone-slash',
        'fa-shield' => 'fa-shield',
        'fa-calendar-o' => 'fa-calendar-o',
        'fa-fire-extinguisher' => 'fa-fire-extinguisher',
        'fa-rocket' => 'fa-rocket',
        'fa-maxcdn' => 'fa-maxcdn',
        'fa-chevron-circle-left' => 'fa-chevron-circle-left',
        'fa-chevron-circle-right' => 'fa-chevron-circle-right',
        'fa-chevron-circle-up' => 'fa-chevron-circle-up',
        'fa-chevron-circle-down' => 'fa-chevron-circle-down',
        'fa-html5' => 'fa-html5',
        'fa-css3' => 'fa-css3',
        'fa-anchor' => 'fa-anchor',
        'fa-unlock-alt' => 'fa-unlock-alt',
        'fa-bullseye' => 'fa-bullseye',
        'fa-ellipsis-h' => 'fa-ellipsis-h',
        'fa-ellipsis-v' => 'fa-ellipsis-v',
        'fa-rss-square' => 'fa-rss-square',
        'fa-play-circle' => 'fa-play-circle',
        'fa-ticket' => 'fa-ticket',
        'fa-minus-square' => 'fa-minus-square',
        'fa-minus-square-o' => 'fa-minus-square-o',
        'fa-level-up' => 'fa-level-up',
        'fa-level-down' => 'fa-level-down',
        'fa-check-square' => 'fa-check-square',
        'fa-pencil-square' => 'fa-pencil-square',
        'fa-external-link-square' => 'fa-external-link-square',
        'fa-share-square' => 'fa-share-square',
        'fa-compass' => 'fa-compass',
        'fa-caret-square-o-down' => 'fa-caret-square-o-down',
        'fa-caret-square-o-up' => 'fa-caret-square-o-up',
        'fa-caret-square-o-right' => 'fa-caret-square-o-right',
        'fa-eur' => 'fa-eur',
        'fa-gbp' => 'fa-gbp',
        'fa-usd' => 'fa-usd',
        'fa-inr' => 'fa-inr',
        'fa-jpy' => 'fa-jpy',
        'fa-rub' => 'fa-rub',
        'fa-krw' => 'fa-krw',
        'fa-btc' => 'fa-btc',
        'fa-file' => 'fa-file',
        'fa-file-text' => 'fa-file-text',
        'fa-sort-alpha-asc' => 'fa-sort-alpha-asc',
        'fa-sort-alpha-desc' => 'fa-sort-alpha-desc',
        'fa-sort-amount-asc' => 'fa-sort-amount-asc',
        'fa-sort-amount-desc' => 'fa-sort-amount-desc',
        'fa-sort-numeric-asc' => 'fa-sort-numeric-asc',
        'fa-sort-numeric-desc' => 'fa-sort-numeric-desc',
        'fa-thumbs-up' => 'fa-thumbs-up',
        'fa-thumbs-down' => 'fa-thumbs-down',
        'fa-youtube-square' => 'fa-youtube-square',
        'fa-youtube' => 'fa-youtube',
        'fa-xing' => 'fa-xing',
        'fa-xing-square' => 'fa-xing-square',
        'fa-youtube-play' => 'fa-youtube-play',
        'fa-dropbox' => 'fa-dropbox',
        'fa-stack-overflow' => 'fa-stack-overflow',
        'fa-instagram' => 'fa-instagram',
        'fa-flickr' => 'fa-flickr',
        'fa-adn' => 'fa-adn',
        'fa-bitbucket' => 'fa-bitbucket',
        'fa-bitbucket-square' => 'fa-bitbucket-square',
        'fa-tumblr' => 'fa-tumblr',
        'fa-tumblr-square' => 'fa-tumblr-square',
        'fa-long-arrow-down' => 'fa-long-arrow-down',
        'fa-long-arrow-up' => 'fa-long-arrow-up',
        'fa-long-arrow-left' => 'fa-long-arrow-left',
        'fa-long-arrow-right' => 'fa-long-arrow-right',
        'fa-apple' => 'fa-apple',
        'fa-windows' => 'fa-windows',
        'fa-android' => 'fa-android',
        'fa-linux' => 'fa-linux',
        'fa-dribbble' => 'fa-dribbble',
        'fa-skype' => 'fa-skype',
        'fa-foursquare' => 'fa-foursquare',
        'fa-trello' => 'fa-trello',
        'fa-female' => 'fa-female',
        'fa-male' => 'fa-male',
        'fa-gittip' => 'fa-gittip',
        'fa-sun-o' => 'fa-sun-o',
        'fa-moon-o' => 'fa-moon-o',
        'fa-archive' => 'fa-archive',
        'fa-bug' => 'fa-bug',
        'fa-vk' => 'fa-vk',
        'fa-weibo' => 'fa-weibo',
        'fa-renren' => 'fa-renren',
        'fa-pagelines' => 'fa-pagelines',
        'fa-stack-exchange' => 'fa-stack-exchange',
        'fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right',
        'fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left',
        'fa-caret-square-o-left' => 'fa-caret-square-o-left',
        'fa-dot-circle-o' => 'fa-dot-circle-o',
        'fa-wheelchair' => 'fa-wheelchair',
        'fa-vimeo-square' => 'fa-vimeo-square',
        'fa-try' => 'fa-try',
        'fa-plus-square-o' => 'fa-plus-square-o',
        'fa-space-shuttle' => 'fa-space-shuttle',
        'fa-slack' => 'fa-slack',
        'fa-envelope-square' => 'fa-envelope-square',
        'fa-wordpress' => 'fa-wordpress',
        'fa-openid' => 'fa-openid',
        'fa-university' => 'fa-university',
        'fa-graduation-cap' => 'fa-graduation-cap',
        'fa-yahoo' => 'fa-yahoo',
        'fa-google' => 'fa-google',
        'fa-reddit' => 'fa-reddit',
        'fa-reddit-square' => 'fa-reddit-square',
        'fa-stumbleupon-circle' => 'fa-stumbleupon-circle',
        'fa-stumbleupon' => 'fa-stumbleupon',
        'fa-delicious' => 'fa-delicious',
        'fa-digg' => 'fa-digg',
        'fa-pied-piper' => 'fa-pied-piper',
        'fa-pied-piper-alt' => 'fa-pied-piper-alt',
        'fa-drupal' => 'fa-drupal',
        'fa-joomla' => 'fa-joomla',
        'fa-language' => 'fa-language',
        'fa-fax' => 'fa-fax',

        'fa-building' => 'fa-building',
        'fa-child' => 'fa-child',
        'fa-paw' => 'fa-paw',
        'fa-spoon' => 'fa-spoon',
        'fa-cube' => 'fa-cube',
        'fa-cubes' => 'fa-cubes',
        'fa-behance' => 'fa-behance',
        'fa-behance-square' => 'fa-behance-square',
        'fa-steam' => 'fa-steam',
        'fa-steam-square' => 'fa-steam-square',
        'fa-recycle' => 'fa-recycle',
        'fa-car' => 'fa-car',
        'fa-taxi' => 'fa-taxi',
        'fa-tree' => 'fa-tree',
        'fa-spotify' => 'fa-spotify',
        'fa-deviantart' => 'fa-deviantart',
        'fa-soundcloud' => 'fa-soundcloud',
        'fa-database' => 'fa-database',
        'fa-file-pdf-o' => 'fa-file-pdf-o',
        'fa-file-word-o' => 'fa-file-word-o',
        'fa-file-excel-o' => 'fa-file-excel-o',
        'fa-file-powerpoint-o' => 'fa-file-powerpoint-o',
        'fa-file-image-o' => 'fa-file-image-o',
        'fa-file-archive-o' => 'fa-file-archive-o',
        'fa-file-audio-o' => 'fa-file-audio-o',
        'fa-file-video-o' => 'fa-file-video-o',
        'fa-file-code-o' => 'fa-file-code-o',
        'fa-vine' => 'fa-vine',
        'fa-codepen' => 'fa-codepen',
        'fa-jsfiddle' => 'fa-jsfiddle',
        'fa-life-ring' => 'fa-life-ring',
        'fa-circle-o-notch' => 'fa-circle-o-notch',
        'fa-rebel' => 'fa-rebel',
        'fa-empire' => 'fa-empire',
        'fa-git-square' => 'fa-git-square',
        'fa-git' => 'fa-git',
        'fa-hacker-news' => 'fa-hacker-news',
        'fa-tencent-weibo' => 'fa-tencent-weibo',
        'fa-qq' => 'fa-qq',
        'fa-weixin' => 'fa-weixin',
        'fa-paper-plane' => 'fa-paper-plane',
        'fa-paper-plane-o' => 'fa-paper-plane-o',
        'fa-history' => 'fa-history',
        'fa-circle-thin' => 'fa-circle-thin',
        'fa-header' => 'fa-header',
        'fa-paragraph' => 'fa-paragraph',
        'fa-sliders' => 'fa-sliders',
        'fa-share-alt' => 'fa-share-alt',
        'fa-share-alt-square' => 'fa-share-alt-square',
        'fa-bomb' => 'fa-bomb',

        'fa-angellist' => 'fa-angellist',
        'fa-area-chart' => 'fa-area-chart',
        'fa-at' => 'fa-at',
        'fa-bell-slash' => 'fa-bell-slash',
        'fa-bell-slash-o' => 'fa-bell-slash-o',
        'fa-bicycle' => 'fa-bicycle',
        'fa-binoculars' => 'fa-binoculars',
        'fa-birthday-cake' => 'fa-birthday-cake',
        'fa-bus' => 'fa-bus',
        'fa-calculator' => 'fa-calculator',
        'fa-cc' => 'fa-cc',
        'fa-cc-amex' => 'fa-cc-amex',
        'fa-cc-discover' => 'fa-cc-discover',
        'fa-cc-mastercard' => 'fa-cc-mastercard',
        'fa-cc-paypal' => 'fa-cc-paypal',
        'fa-cc-stripe' => 'fa-cc-stripe',
        'fa-cc-visa' => 'fa-cc-visa',
        'fa-copyright' => 'fa-copyright',
        'fa-eyedropper' => 'fa-eyedropper',
        'fa-futbol-o' => 'fa-futbol-o',
        'fa-google-wallet' => 'fa-google-wallet',
        'fa-ils' => 'fa-ils',
        'fa-ioxhost' => 'fa-ioxhost',
        'fa-lastfm' => 'fa-lastfm',
        'fa-lastfm-square' => 'fa-lastfm-square',
        'fa-line-chart' => 'fa-line-chart',
        'fa-meanpath' => 'fa-meanpath',
        'fa-newspaper-o' => 'fa-newspaper-o',
        'fa-paint-brush' => 'fa-paint-brush',
        'fa-paypal' => 'fa-paypal',
        'fa-pie-chart' => 'fa-pie-chart',
        'fa-plug' => 'fa-plug',
        'fa-shekel (alias)' => 'fa-shekel (alias)',
        'fa-sheqel (alias)' => 'fa-sheqel (alias)',
        'fa-slideshare' => 'fa-slideshare' ,
        'fa-soccer-ball-o' => 'fa-soccer-ball-o',
        'fa-toggle-off' => 'fa-toggle-off',
        'fa-toggle-on' => 'fa-toggle-on',
        'fa-trash' => 'fa-trash',
        'fa-tty' => 'fa-tty',
        'fa-twitch' => 'fa-twitch',
        'fa-wifi' => 'fa-wifi',
        'fa-yelp' => 'fa-yelp',

        'fa-bed' => 'fa-bed',
        'fa-buysellads' => 'fa-buysellads',
        'fa-cart-arrow-down' => 'fa-cart-arrow-down',
        'fa-cart-plus' => 'fa-cart-plus',
        'fa-connectdevelop' => 'fa-connectdevelop',
        'fa-dashcube' => 'fa-dashcube',
        'fa-diamond' => 'fa-diamond',
        'fa-facebook-official' => 'fa-facebook-official',
        'fa-forumbee' => 'fa-forumbee',
        'fa-heartbeat' => 'fa-heartbeat',
        'fa-bed' => 'fa-bed',
        'fa-leanpub' => 'fa-leanpub',
        'fa-mars' => 'fa-mars',
        'fa-mars-double' => 'fa-mars-double',
        'fa-mars-stroke' => 'fa-mars-stroke',
        'fa-mars-stroke-h' => 'fa-mars-stroke-h',
        'fa-mars-stroke-v' => 'fa-mars-stroke-v',
        'fa-medium' => 'fa-medium',
        'fa-mercury' => 'fa-mercury',
        'fa-motorcycle' => 'fa-motorcycle',
        'fa-neuter' => 'fa-neuter',
        'fa-pinterest-p' => 'fa-pinterest-p',
        'fa-sellsy' => 'fa-sellsy',
        'fa-server' => 'fa-server',
        'fa-ship' => 'fa-ship',
        'fa-shirtsinbulk' => 'fa-shirtsinbulk',
        'fa-simplybuilt' => 'fa-simplybuilt',
        'fa-skyatlas' => 'fa-skyatlas',
        'fa-street-view' => 'fa-street-view',
        'fa-subway' => 'fa-subway',
        'fa-train' => 'fa-train',
        'fa-transgender' => 'fa-transgender',
        'fa-transgender-alt' => 'fa-transgender-alt',
        'fa-user-plus' => 'fa-user-plus',
        'fa-user-secret' => 'fa-user-secret',
        'fa-user-times' => 'fa-user-times',
        'fa-venus' => 'fa-venus',
        'fa-venus-double' => 'fa-venus-double',
        'fa-venus-mars' => 'fa-venus-mars',
        'fa-viacoin' => 'fa-viacoin',
        'fa-whatsapp' => 'fa-whatsapp',
		
		'fa-500px' => 'fa-500px',
		'fa-amazon' => 'fa-amazon',
		'fa-balance-scale' => 'fa-balance-scale',
		'fa-battery-empty' => 'fa-battery-empty',
		'fa-battery-quarter' => 'fa-battery-quarter',
		'fa-battery-half' => 'fa-battery-half',
		'fa-battery-three-quarters' => 'fa-battery-three-quarters',
		'fa-battery-full' => 'fa-battery-full',
		'fa-black-tie' => 'fa-black-tie',
		'fa-calendar-check-o' => 'fa-calendar-check-o',
		'fa-calendar-plus-o' => 'fa-calendar-plus-o',
		'fa-calendar-minus-o' => 'fa-calendar-minus-o',
		'fa-calendar-times-o' => 'fa-calendar-times-o',		
		'fa-cc-diners-club' => 'fa-cc-diners-club',
		'fa-cc-jcb' => 'fa-cc-jcb',
		'fa-chrome' => 'fa-chrome',		
		'fa-clone' => 'fa-clone',
		'fa-commenting' => 'fa-commenting',
		'fa-commenting-o' => 'fa-commenting-o',
		'fa-contao' => 'fa-contao',
		'fa-creative-commons' => 'fa-creative-commons',
		'fa-expeditedssl' => 'fa-expeditedssl',
		'fa-firefox' => 'fa-firefox',
		'fa-fonticons' => 'fa-fonticons',
		'fa-genderless' => 'fa-genderless',
		'fa-get-pocket' => 'fa-get-pocket',
		'fa-gg' => 'fa-gg',
		'fa-gg-circle' => 'fa-gg-circle',
		'fa-hand-rock-o' => 'fa-hand-rock-o',
		'fa-hand-lizard-o' => 'fa-hand-lizard-o',
		'fa-hand-paper-o' => 'fa-hand-paper-o',
		'fa-hand-peace-o' => 'fa-hand-peace-o',
		'fa-hand-pointer-o' => 'fa-hand-pointer-o',
		'fa-hand-rock-o' => 'fa-hand-rock-o',
		'fa-hand-scissors-o' => 'fa-hand-scissors-o',
		'fa-hand-spock-o' => 'fa-hand-spock-o',
		'fa-hand-paper-o' => 'fa-hand-paper-o',
		'fa-hourglass' => 'fa-hourglass',
		'fa-hourglass-start' => 'fa-hourglass-start',
		'fa-hourglass-half' => 'fa-hourglass-half',
		'fa-hourglass-end' => 'fa-hourglass-end',
		'fa-hourglass-o' => 'fa-hourglass-o',
		'fa-houzz' => 'fa-houzz',
		'fa-i-cursor' => 'fa-i-cursor',
		'fa-i-cursor' => 'fa-i-cursor',
		'fa-internet-explorer' => 'fa-internet-explorer',
		'fa-map' => 'fa-map',
		'fa-map-o' => 'fa-map-o',
		'fa-map-pin' => 'fa-map-pin',
		'fa-map-signs' => 'fa-map-signs',
		'fa-mouse-pointer' => 'fa-mouse-pointer',
		'fa-object-group' => 'fa-object-group',
		'fa-object-ungroup' => 'fa-object-ungroup',
		'fa-odnoklassniki' => 'fa-odnoklassniki',
		'fa-odnoklassniki-square' => 'fa-odnoklassniki-square',
		'fa-opencart' => 'fa-opencart',
		'fa-opera' => 'fa-opera',
		'fa-optin-monster' => 'fa-optin-monster',
		'fa-registered' => 'fa-registered',
		'fa-safari' => 'fa-safari',
		'fa-sticky-note' => 'fa-sticky-note',
		'fa-sticky-note-o' => 'fa-sticky-note-o',
		'fa-television' => 'fa-television',
		'fa-trademark' => 'fa-trademark',
		'fa-tripadvisor' => 'fa-tripadvisor',
		'fa-vimeo' => 'fa-vimeo',
		'fa-wikipedia-w' => 'fa-wikipedia-w',
		'fa-y-combinator' => 'fa-y-combinator',
		
		'fa fa-bluetooth' => 'fa fa-bluetooth',
		'fa fa-bluetooth-b' => 'fa fa-bluetooth-b',
		'fa fa-codiepie' => 'fa fa-codiepie',
		'fa fa-credit-card-alt' => 'fa fa-credit-card-alt',
		'fa fa-edge' => 'fa fa-edge',
		'fa fa-fort-awesome' => 'fa fa-fort-awesome',
		'fa fa-hashtag' => 'fa fa-hashtag',
		'fa fa-mixcloud' => 'fa fa-mixcloud',
		'fa fa-modx' => 'fa fa-modx',
		'fa fa-pause-circle' => 'fa fa-pause-circle',
		'fa fa-pause-circle-o' => 'fa fa-pause-circle-o',
		'fa fa-percent' => 'fa fa-percent',
		'fa fa-product-hunt' => 'fa fa-product-hunt',
		'fa fa-reddit-alien' => 'fa fa-reddit-alien',
		'fa fa-scribd' => 'fa fa-scribd',
		'fa fa-shopping-bag' => 'fa fa-shopping-bag',
		'fa fa-shopping-basket' => 'fa fa-shopping-basket',
		'fa fa-stop-circle' => 'fa fa-stop-circle',
		'fa fa-stop-circle-o' => 'fa fa-stop-circle-o',
		'fa fa-usb' => 'fa fa-usb',

    );

    return $icons;
}



// Logos Carousel

vc_map( array(
    "name" => __("Logos Carousel", "js_composer"),
    "base" => "logos_carousel",
    "icon" => "fa-css3",
    "class" => "font-awesome",
    "category" => array("Carousels"),
    "description" => "Carousel of logo images",
    "params" => array(
        array(
            'type' => 'attach_images',
            'heading' => __( 'Images', 'js_composer' ),
            'param_name' => 'images',
            'value' => '',
            'description' => __( 'Select images from media library.', 'js_composer' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'On click', 'js_composer' ),
            'param_name' => 'onclick',
            'value' => array(
                __( 'Do nothing', 'js_composer' ) => 'link_no',
                __( 'Open custom link', 'js_composer' ) => 'custom_link'
            ),
            'description' => __( 'Define action for onclick event if needed.', 'js_composer' )
        ),
        array(
            'type' => 'exploded_textarea',
            'heading' => __( 'Custom links', 'js_composer' ),
            'param_name' => 'custom_links',
            'description' => __( 'Enter links for each logo here. Divide links with linebreaks (Enter) . ', 'js_composer' ),
            'dependency' => array(
                'element' => 'onclick',
                'value' => array( 'custom_link' )
            )
        ),
		array(
            "type" => "dropdown",
            "heading" => __('Target', "js_composer"),
            "param_name" => "url_target",
            'value' => array(
                __( 'Same window', 'js_composer' ) => '_self',
                __( 'New window', 'js_composer' ) => '_blank'
            ),
            "description" => __("The target attribute specifies where to open the linked document.", "js_composer"),
			'dependency' => array(
                'element' => 'onclick',
                'value' => array( 'custom_link' )
            )
        ),
    )
));

// Special Heading

vc_map( array(
    "name" => __("Special Heading", "js_composer"),
    "base" => "special_heading",
    "class" => "font-awesome",
    "icon" => "fa-header",
    "description" => "Centered heading text",
    "category" => 'Content',
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'js_composer'),
            "param_name" => "title",
            "holder" => "h5",
            "description" => __("Main heading text.", 'js_composer'),
            "value" => "This is a Special Heading"
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Add underline for heading', "js_composer"),
            "param_name" => "th_is_underline",
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
            "description" => __("Add undeline option. Useful for about page.", "js_composer"),
        ),
        array(
            "type" => "dropdown",
            "class" => "hidden-label",
            "heading" => __("Title Font", "js_composer"),
            "param_name" => "font",
            "value" => array(
                'General-title' => '',
                'Cta-title' => 'cta-title'
            ),
            "description" => __("Is work only if underline option is not checked.", "js_composer"),
            'dependency' => array(
                'element' => 'th_is_underline',
                'is_empty' => true,
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Text align', 'js_composer' ),
            'param_name' => 'th_text_align',
            'value' => array(
                __( 'Align center', 'js_composer' ) => 'text-center',
                __( 'Align left', 'js_composer' ) => 'text-left',
                __( 'Align right', 'js_composer' ) => "text-right",
                __( 'Justify', 'js_composer' ) => 'text-justify'
            ),
            'description' => __( 'Select text align.', 'js_composer' )
        )

    )
));

// VC Row

vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __("Row ID", "js_composer"),
    "param_name" => "el_id",
    "value" => "",
    "description" => __("Row's unique ID.", "js_composer")
));


vc_add_param("vc_row", array(
    'type' => 'dropdown',
    'heading' => __( 'Text align', 'js_composer' ),
    'param_name' => 'th_text_align',
    'value' => array(
        __( 'Align center', 'js_composer' ) => 'text-center',
        __( 'Align left', 'js_composer' ) => 'text-left',
        __( 'Align right', 'js_composer' ) => 'text-right',
        __( 'None', 'js_composer' ) => 'text-justify',
    ),
    'description' => __( 'Select text align.', 'js_composer' )
));

vc_remove_param("vc_row","font_color");
//vc_remove_param("vc_row","el_class");
vc_remove_param("vc_row","css");

/* Since VC 4.8*/
vc_remove_param("vc_row","full_width");
vc_remove_param("vc_row","full_height");
vc_remove_param("vc_row","content_placement");
vc_remove_param("vc_row","video_bg");
vc_remove_param("vc_row","video_bg_url");
vc_remove_param("vc_row","video_bg_parallax");
vc_remove_param("vc_row","parallax");
vc_remove_param("vc_row","parallax_image");

vc_add_param("vc_row", array(
    'type' => 'css_editor',
    'heading' => __( 'Css', 'js_composer' ),
    'param_name' => 'css',
    'group' => __( 'Design options', 'js_composer' )
));

/* Background image */
/*
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Font Color Scheme", 'js_composer'),
    "param_name" => "color_scheme",
    "value" => array(
        "Default" => "",
        "White Scheme" => "white",
        //"Custom" => "custom"
    ),
    "description" => __("White Scheme - all text styled to white color, recommended for dark backgrounds.", 'js_composer'),
    'group' => __( 'Background image', 'js_composer' )
));
*/
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Parallax Effect",
    "param_name" => "parallax",
    "value" => array(
        "No" => "",
        "Yes" => "yes"
    ),
    "description" => __("Enable or disable the parallax effect. Available only if background image is set in the 'Design Options' tab.", 'js_composer'),
));
/*
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Background Image Overlay",
    "param_name" => "bg_overlay",
    "value" => array(
        "None" => "",
        "Dark" => "dark",
        "Darker" => "darker",
        "Light" => "light",
        "White Dots" => 'dots_white',
        "Dark Dots" => 'dots_dark'
    ),
    "description" => __("Enable the row's background overlay to darken or lighten the background image."),
    'group' => __( 'Background image', 'js_composer' )
));
*/
/**/

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Section Background Color",
    "param_name" => "bg_section_color",
    "value" => array(
        "White" => "white",
        "Grey" => "grey",
        "Dark" => "dark"
    ),
    "description" => __("Make the section color grey. Useful for Logo Carousel or Testimonials Carousel.", "js_composer"),
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __('Row\'s Content Width', 'js_composer'),
    "param_name" => "content_width",
    "value" => array(
        "Container" => "container",
        "Container Fluid" => "container-fluid",
        "Fullwidth" => "fullwidth"
    ),
    "description" => __('Make the row\'s content width fullwidth. Useful for fullwidth Portfolio Grid or Portfolio Carousel.', 'js_composer')
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Fullscreen",
    "param_name" => "fullscreen",
    "value" => array(
        "No" => "",
        "Yes" => "yes"
    ),
    "description" => __('Make the row\'s height and width fullscreen\' tab. Suitable mainly for \"Fancy Text Blocks\" ', 'js_composer'),
));

/* vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Video Background",
    "param_name" => "video_bg",
    "value" => array(
        "No" => "",
        "YouTube" => "youtube",
        "Vimeo" => "vimeo"
    ),
    "group" => __( 'Video Background', 'js_composer' ),
    "description" => __("Enable a Video Background"),
));

vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "YouTube Video ID",
    "param_name" => "video",
    "value"	=> '',
    "description" => __("Enter the YouTube video's ID to be displayed as the row background. Example: mSLAF_DjiDU"),
    "group" => __( 'Video Background', 'js_composer' ),
    "dependency" => Array('element' => "video_bg", 'value' => 'youtube')
));

vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Vimeo ID",
    "param_name" => "vimeo",
    "value"	=> '',
    "description" => __("Enter the Vimeo video's ID to be displayed as the row background. Example: 51287059"),
    "group" => __( 'Video Background', 'js_composer' ),
    "dependency" => Array('element' => "video_bg", 'value' => 'vimeo')
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Video Autoplay",
    "param_name" => "video_autoplay",
    "value" => array(
        "True" => "true",
        "False" => "false"
    ),
    "description" => "Should the video play in a loop or not?",
    "group" => __( 'Video Background', 'js_composer' ),
    "dependency" => Array('element' => "video_bg", 'value' => array('youtube','vimeo'))
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Video Player Controls",
    "param_name" => "video_controls",
    "value" => array(
        "True" => "true",
        "False" => "false"
    ),
    "description" => "Display the video player controls?",
    "group" => __( 'Video Background', 'js_composer' ),
    "dependency" => Array('element' => "video_bg", 'value' => array('youtube'))
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Mute Video",
    "param_name" => "video_mute",
    "value" => array(
        "True" => "true",
        "False" => "false"
    ),
    "description" => "Mute the video?",
    "group" => __( 'Video Background', 'js_composer' ),
    "dependency" => Array('element' => "video_bg", 'value' => array('youtube'))
)); */

// VC Column

vc_add_param('vc_column',array(
        "type" => "dropdown",
        "heading" => __('Row\'s Content Width', "js_composer"),
        "param_name" => "th_is_fullwith",
        "value" => array(
            "No" => "no",
            "Yes" => "yes"
        ),
        "description" => __("Make the row\'s content width fullwidth. Useful for fullwidth Portfolio Grid ", "js_composer"),
    )
);

// Pricing Box

vc_map( array(
    "name" => __("Pricing Box", "js_composer"),
    "base" => "pricing_box",
    "class" => "font-awesome",
    "icon" => "fa-usd",
    "category" => 'Content',
    "description" => "Product box with prices",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Box Title", 'js_composer'),
            "param_name" => "title",
            "description" => __("Your Pricing Box title", 'js_composer'),
            "value" => "",
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Price", 'js_composer'),
            "param_name" => "price",
            "description" => __("Pricing Box price", 'js_composer'),
            "value" => "$99",
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Period", 'js_composer'),
            "param_name" => "period",
            "description" => __("Pricing Box period", 'js_composer'),
            "value" => "per project"
        ),
        array(
            "type" => "exploded_textarea",
            "heading" => __("Features", "js_composer"),
            "param_name" => "features",
            "description" => __('Enter features here. Divide each feature with linebreaks (Enter).', 'js_composer')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button Label", 'js_composer'),
            "param_name" => "button_label",
            "description" => __("Text visible on the box button", 'js_composer'),
            "value" => "Buy Now"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button URL", 'js_composer'),
            "param_name" => "button_url",
            "description" => __("Button URL, start with http://", 'js_composer'),
            "value" => "",
            'dependency' => Array('element' => "button_label", 'not_empty' => true)
        ),
    )
));

// Google Map

vc_map( array(
    "name" => __("Google Map", "js_composer"),
    "base" => "gmap",
    "icon"      => "icon-wpb-map-pin",
    "category" => 'Content',
    "description" => "Map block",
    "params" => array(
        array(
            "type" => "textfield",
            "class" => "hidden-label",
            "heading" => __("Location Latitude", "js_composer"),
            "param_name" => "lat",
            "value" => '40.712784',
            "description" => __("Please insert the map address latitude if you have problems displaying it. Helpful site: <a target=\"_blank\" href=\"http://www.latlong.net/\">http://www.latlong.net/</a>", "js_composer")
        ),
        array(
            "type" => "textfield",
            "class" => "hidden-label",
            "heading" => __("Location Longitude", "js_composer"),
            "param_name" => "long",
            "value" => '-74.005941',
            "description" => __("Please insert the map address longitude value.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "class" => "hidden-label",
            "heading" => __("Map Zoom", "js_composer"),
            "param_name" => "zoom",
            "value" => '15',
            "description" => __("Choose the map zoom. Default value: 15", "js_composer")
        ),
        array(
            "type" => "textfield",
            "class" => "hidden-label",
            "heading" => __("Map Height", "js_composer"),
            "param_name" => "height",
            "value" => '400',
            "description" => __("Height of the map element in pixels.", "js_composer")
        ),
    )
));

//Testimonials Carousel

vc_map( array(
    "name" => __("Testimonials Carousel", "js_composer"),
    "base" => "testimonials",
    "icon" => "fa-comments",
    "class" => "font-awesome",
    "category" => array("Carousels"),
    "description" => "Clients testimonials",
    "params" => array(
        array(
            "type" => "textfield",
            "class" => "hidden-label",
            "heading" => __("Number of posts to show", "js_composer"),
            "param_name" => "posts_nr",
            "value" => "7"
        )
    )
));

// Icon Box

vc_map( array(
    "name" => __("Icon Box", "js_composer"),
    "base" => "icon_box",
    "class" => "font-awesome",
    "icon" => "fa-check-circle-o",
    "controls" => "full",
    "category" => 'Content',
    "description" => "Text with an icon",
    "params" => array(	
		array(
            "type" => "dropdown",
            "heading" => __('Icon box style', "js_composer"),
            "param_name" => "icon_box_style",
            'value' => array(
                __( 'Style 1', 'js_composer' ) => 'style1',
                __( 'Style 2', 'js_composer' ) => 'style2'
            ),
            "description" => __("Please choose icon box style.", "js_composer"),
        ),
        array(
            "type" => "textfield",
            "class" => "hidden-label",
            "heading" => __("Title", "js_composer"),
            "param_name" => "title",
            "holder" => "h4",
            //"dependency" => Array('element' => "iconic", 'value' => 'radios'),
            "value" => 'Hey! I am title'
        ),
        array(
            "type" => "textarea",
            "class" => "hidden-label",
            "heading" => __("Text Content", "js_composer"),
            "param_name" => "text",
            "holder" => "span",
            "value" => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.',
        ),
        array(
            "type" => "checkbox",
            "class" => "radio-checkboxes",
            "heading" => __("Icon", "js_composer"),
            "param_name" => "icon",
            "value" => th_fontawesome_array()
        ),
        array("type" => "init_icons")
    )
));

// Button

$target_arr = array(__("Same window", "js_composer") => "_self", __("New window", "js_composer") => "_blank");
$button_type_arr = array(__("Default", "js_composer") => "gold-btn", __("Primary", "js_composer") => "black-btn", __("Success", "js_composer") => "success-btn", __("Info", "js_composer") => "info-btn", __("Warning", "js_composer") => "warning-btn", __("Danger", "js_composer") => "danger-btn", __("Link", "js_composer") => "link-btn");
vc_map( array(
    "name" => __("Button", "js_composer"),
    "base" => "button",
    "class" => "no-padding",
    "icon" => "icon-wpb-ui-button",
    "category" => 'Content',
    "description" => "Simple button",
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Button Type", "js_composer"),
            "param_name" => "type",
            "value" =>  $button_type_arr,
            "description" => __("Button align.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Text on the button", "js_composer"),
            "holder" => "button",
            "class" => "button",
            "param_name" => "label",
            "value" => __("Text on the button", "js_composer"),
            "description" => __("Text on the button.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("URL (Link)", "js_composer"),
            "param_name" => "url",
            "description" => __("Button link.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "js_composer"),
            "param_name" => "target",
            "value" => $target_arr,
            "dependency" => Array('element' => "url", 'not_empty' => true)
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Button Align", "js_composer"),
            "param_name" => "align",
            "value" =>  array(__("Left", "js_composer") => "", __("Centered", "js_composer") => "center",  __("Right", "js_composer") => "right"),
            "description" => __("Button align.", "js_composer")
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', "js_composer" ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
        ),
    )
));

// Team member

vc_map( array(
    "name" => __("Team Member", "js_composer"),
    "base" => "team_member",
    "class" => "font-awesome",
    "icon" => "fa-user",
    "category" => 'Content',
    "description" => "Add out team Member",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Member Name", "js_composer"),
            "param_name" => "name",
            "value" => "John Doe",
            "description" => __("Member Name", "js_composer")
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Job", "js_composer"),
            "param_name" => "position",
            "value" => "",
            "description" => __("Member Position.", "js_composer")
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => "Avatar",
            "param_name" => "src",
            "value" => "",
            "description" => __("Photo or avatar of member.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Description", "js_composer"),
            "param_name" => "description",
            "value" => "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.",
            "description" => __("Short description about member.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Facebook Url", "js_composer"),
            "param_name" => "facebook",
            "value" => "",
            "description" => __("Facebook Url to contact.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Twitter Url", "js_composer"),
            "param_name" => "twitter",
            "value" => "",
            "description" => __("Twitter Url to contact.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Linkedin", "js_composer"),
            "param_name" => "linkedin",
            "value" => "",
            "description" => __("Linkedin Url to contact.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Bahance", "js_composer"),
            "param_name" => "behance",
            "value" => "",
            "description" => __("Bahance Url to contact.", "js_composer")
        ),
		array(
            "type" => "dropdown",
            "heading" => __('Target', "js_composer"),
            "param_name" => "th_social_target",
            'value' => array(
                __( 'Same window', 'js_composer' ) => '_self',
                __( 'New window', 'js_composer' ) => '_blank'
            ),
            "description" => __("The target attribute specifies where to open the linked document.", "js_composer"),
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Email address", "js_composer"),
            "param_name" => "envelope",
            "value" => "",
            "description" => __("\"mailto: email@example.com\"  link that activates the default mail client on the computer for sending an e-mail. ", "js_composer")
        ),
    )
));

// Icon Box Grid

vc_map( array(
    "name" => __("Service Item", "js_composer"),
    "base" => "icon_box_grid",
    "class" => "font-awesome",
    "icon" => "fa-gear",
    "controls" => "full",
    "category" => 'Content',
    "description" => "Icon box grid",
    "params" => array(
        array(
            "type" => "textfield",
            "class" => "hidden-label",
            "heading" => __("Title", "js_composer"),
            "param_name" => "title",
            "holder" => "h4",
            //"dependency" => Array('element' => "iconic", 'value' => 'radios'),
            "value" => 'Hey! I am title'
        ),
        array(
            "type" => "textarea",
            "class" => "hidden-label",
            "heading" => __("Text Content", "js_composer"),
            "param_name" => "text",
            "holder" => "span",
            "value" => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'js_composer' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
        ),
        array(
            "type" => "checkbox",
            "class" => "radio-checkboxes",
            "heading" => __("Icon", "js_composer"),
            "param_name" => "icon",
            "value" => th_fontawesome_array()
        ),
        //array("type" => "init_icons")
    )
));

// Portfolio Grid

$order_by_arr = array(__('None', "js_composer")=>'none', __('ID', "js_composer")=>'ID', __('Author', "js_composer")=>'author', __('Title', "js_composer")=>'title', __('Name', "js_composer")=>'name', __('Type', "js_composer")=>'type', __('Date', "js_composer")=>'date', __('Modified', "js_composer")=>'modified', __('Parent', "js_composer")=>'parent', __('Rand', "js_composer")=>'rand', __('Comment Count', "js_composer")=>'comment_count');
vc_map( array(
    "name"      => __("Portfolio Grid", "js_composer"),
    "base"      => "portfolio_grid",
    "class"     => "font-awesome",
    "icon" => "fa-check",
    "category"  => 'Content',
	"description" => "Grid layout for portfolio",
    "params"    => array(
		array(
		"type"      => "textfield",
		"holder"    => "div",
		"class"     => "",
		"heading"   => __("Keyword for All Projects Filter", "js_composer"),
		"param_name"=> "all_filter",
		"value"     => "All",
		"description" => __("Replace the default \"All\" keyword for the initial filter with another one.", "js_composer")
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Items per page", "js_composer"),
            "param_name"=> "posts_per_page",
            "value"     => "12",
            "description" => __("Set how many portfolio items would you like to include in the grid.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order", "js_composer"),
            "param_name" => "order",
            'value'=>array(
                __('Asc', "js_composer")=>'asc',
                __('Desc', "js_composer")=>'desc'
            ),
            'edit_field_class'=>'vc_col-sm-6'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order By", "js_composer"),
            "param_name" => 'orderby',
            'value'=> $order_by_arr,
            'edit_field_class'=>'vc_col-sm-6'
        ),

    )
));

// VC Progress Bar

vc_remove_param("vc_progress_bar","options");
vc_remove_param("vc_progress_bar","el_class");
vc_remove_param("vc_progress_bar","bgcolor");

// Block Quote

$str = "<strong>Holy guacamole!<strong>";
$str =htmlspecialchars($str);
vc_map( array(
    "name"      => __("Block Quote", "js_composer"),
    "base"      => "blockquote",
    "class"     => "font-awesome",
    "icon" => "fa-quote-left",
    "category"  => 'Content',
	"description" => "Blockquote element",
    "params"    => array(
        array(
            "type"      => "textarea",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Content", "js_composer"),
            "param_name"=> "content",
            "value"     => "Vivamus nunc nunc, lacinia ac nulla eget. Vivamus nunc nunc, lacinia ac nulla eget. Pellentesque congue sodales lacinia.",
            "description" => __("You can use HTML tags. Example : $str ", "js_composer")
        ),array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Author", "js_composer"),
            "param_name"=> "author",
            "value"     => "",
            "description" => __("Author of quote", "js_composer")
        ),array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Extra class", "js_composer"),
            "param_name"=> "el_class",
            "value"     => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        ),
    )
));

// Alert

vc_map( array(
    "name"      => __(" Alert", "js_composer"),
    "base"      => "alert",
    "class"     => "font-awesome",
    "icon" => "fa-bell",
    "category"  => 'Content',
    "description" => __("Alert Messages", "js_composer"),
    "params"    => array(
        array(
            "type"      => "textarea",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Content", "js_composer"),
            "param_name"=> "content",
            "value"     => "Holy guacamole! Best check yo self, you're not looking too good.",
            "description" => __("You can use HTML tags. Example : $str ", "js_composer")
        ),array(
            "type"      => "dropdown",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Type", "js_composer"),
            "param_name"=> "type",
            "value"     => array(
                __('Danger',"js_composer")=>'danger',
                __('Success',"js_composer")=>'success',
                __('Warning',"js_composer")=>'warning',
                __('Info',"js_composer")=>'info'
            ),
            "description" => __("Specify a type", "js_composer")
        ),array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Extra class", "js_composer"),
            "param_name"=> "el_class",
            "value"     => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        ),
    )
));

// Blog Post Grid

$blog_cats = get_terms('category', array('hide_empty' => false));
$cats_array = array();
foreach($blog_cats as $blog_cat) {
    $cats_array[$blog_cat->name] = $blog_cat->slug;
}

vc_map( array(
    "name" => __("Blog Grid", "js_composer"),
    "icon" => "fa-pencil",
    "base" => "blog-grid",
    "description" => "Grid layout for blog posts",
    "class" => "font-awesome",
    "category" => __("Content", "js_composer"),
    "params" => array(
		array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style", "js_composer"),
            "param_name" => "display_style",
            'value'=>array(
                __('Style1', "js_composer")=>'style1',
                __('Style2', "js_composer")=>'style2'
            ),
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of Blog Posts to Display. Use \"-1\" to include all your items.", "js_composer"),
            "param_name" => "number",
            "value" => 3,
            "description" => __("Set how many blog items would you like to include in the grid.", "js_composer")
        ),
        array(
            "type" => "checkbox",
            "heading" => __("Select Categories", "js_composer"),
            "param_name" => "categories",
            "value" => $cats_array,
            "description" => __("Select from which categories to display blog posts(mandatory).", "js_composer")
        ),

        array(
            "type"       => "textfield",
            "holder"     => "div",
            "class"      => "",
            "heading"    => __("Number text", "js_composer"),
            "param_name" => "number_text",
            "value"      => 30,
            "description"=> __("Number text you want to display from each post.", "js_composer"),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order", "js_composer"),
            "param_name" => "order",
            'value'=>array(
                __('Asc', "js_composer")=>'asc',
                __('Desc', "js_composer")=>'desc'
            ),
            'edit_field_class'=>'vc_col-sm-6'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order By", "js_composer"),
            "param_name" => 'orderby',
            'value'=> $order_by_arr,
            'edit_field_class'=>'vc_col-sm-6'
        ),
    )
));

//// VC Column
//
//vc_add_param('vc_custom_heading',array(
//        "type" => "checkbox",
//        "heading" => __('Row\'s Content Width', "js_composer"),
//        "param_name" => "th_is_fullwith",
//        "value" => array(
//            "Yes" => "yes"
//        ),
//        "description" => __("Make the row's content width fullwidth. Useful for fullwidth Portfolio Grid ", "js_composer"),
//    )
//);

// Call to action

vc_map( array(
    "name" => __("Call to Action section", "js_composer"),
    'base' => 'vc_cta_section',
    'icon' => 'fa-check',
    "category" => __("Content", "js_composer"),
    'description' => __( 'Catch visitors attention with CTA block', 'js_composer' ),
    "class" => "font-awesome",
    'params' => array(
        array(
            'type' => 'attach_image',
            'heading' => __( 'Background Image', 'js_composer' ),
            'param_name' => 'bg_image',
            'description' => __( 'Select background image for your row', 'js_composer' )
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Add overlay', "js_composer"),
            "param_name" => "th_is_overlay",
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
            //"description" => __("Add overlay effect. Useful if your image is in bright colors.", "js_composer"),
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Heading first line', 'js_composer' ),
            'admin_label' => true,
            'param_name' => 'h2',
            'value' => __( 'Hey! I am first heading line feel free to change me', 'js_composer' ),
            'description' => __( 'Text for the first heading line.', 'js_composer' )
        ),
        array(
            'type' => 'textarea_html',
            'heading' => __( 'Promotional text', 'js_composer' ),
            'param_name' => 'content',
            'value' => __( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'js_composer' )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Button Type", "js_composer"),
            "param_name" => "type",
            "value" =>  $button_type_arr,
            "description" => __("Button align.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Text on the button", "js_composer"),
            "holder" => "button",
            "class" => "button",
            "param_name" => "label",
            "value" => __("Text on the button", "js_composer"),
            "description" => __("Text on the button.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("URL (Link)", "js_composer"),
            "param_name" => "url",
            "description" => __("Button link.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "js_composer"),
            "param_name" => "target",
            "value" => $target_arr,
            "dependency" => Array('element' => "url", 'not_empty' => true)
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', "js_composer" ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
        ),
    )
));

// Call to action line

vc_map( array(
    "name" => __("Call to Action line", "js_composer"),
    'base' => 'cta_line',
    'icon' => 'fa-eye',
    "category" => __("Content", "js_composer"),
    'description' => __( 'Catch visitors attention with CTA line', 'js_composer' ),
    "class" => "font-awesome",
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Heading first line', 'js_composer' ),
            'admin_label' => true,
            'param_name' => 'h2',
            'value' => __( 'Hey! I am first heading line feel free to change me', 'js_composer' ),
            'description' => __( 'Text for the first heading line.', 'js_composer' )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Button Type", "js_composer"),
            "param_name" => "type",
            "value" =>  $button_type_arr,
            "description" => __("Button align.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Text on the button", "js_composer"),
            "holder" => "button",
            "class" => "button",
            "param_name" => "label",
            "value" => __("Text on the button", "js_composer"),
            "description" => __("Text on the button.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("URL (Link)", "js_composer"),
            "param_name" => "url",
            "description" => __("Button link.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "js_composer"),
            "param_name" => "target",
            "value" => $target_arr,
            "dependency" => Array('element' => "url", 'not_empty' => true)
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', "js_composer" ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
        ),
    )
));

// Contact block

vc_map( array(
    "name"      => __("Conctact Block", "js_composer"),
    "base"      => "contact-block",
    "class"     => "font-awesome",
    "icon"      => "fa-envelope-o",
    "category"  => 'Content',
    "description" => __("Show off your contact data", "js_composer"),
    "params"    => array(
        array(
            "type"      => "dropdown",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Type", "js_composer"),
            "param_name"=> "type",
            "value"     => array(
                __('Text',"js_composer")=>'text',
                __('Contact data',"js_composer")=>'data',
				__('Doubled icon box',"js_composer")=>'doubled',
            ),
            "description" => __("Specify a type", "js_composer"),
        ),
        array(
            "type"      => "textarea",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Content", "js_composer"),
            "param_name"=> "content",
            "value"     => "",
            "description" => __("You can use HTML tags. Example : $str ", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'text' )
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Title", "js_composer"),
            "param_name"=> "title",
            "value"     => "",
            "description" => __("Main heading for contact data.", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'data' )
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Address", "js_composer"),
            "param_name"=> "address",
            "value"     => "",
            "description" => __("Your address", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'data' )
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("E-mail", "js_composer"),
            "param_name"=> "email",
            "value"     => "",
            "description" => __("Your e-mail address.", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'data' )
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Phone Number", "js_composer"),
            "param_name"=> "phone",
            "value"     => "",
            "description" => __("Your phone number.", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'data' )
        ),
        array(
            "type" => "dropdown",
            "heading" => __('Use icon', "js_composer"),
            "param_name" => "th_is_icon_use",
            'value' => array(
                __( 'No', 'js_composer' ) => 'no',
                __( 'Yes', 'js_composer' ) => 'yes'
            ),
            "description" => __("Add icon to your contact data.", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'data' )
        ),
        array(
            "type" => "checkbox",
            "class" => "radio-checkboxes",
            "heading" => __("Icon", "js_composer"),
            "param_name" => "icon",
            "value" => th_fontawesome_array(),
            'dependency' => array(
                'element' => 'th_is_icon_use',
                'value' => array( 'yes' )
            )
        ),
		/*doubled icon box*/
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Title", "js_composer"),
            "param_name"=> "addres_doubled",
            "value"     => "Address",
            "description" => __("Main heading for contact data.", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'doubled' )
        ),
		array(
            "type"      => "textarea",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Content", "js_composer"),
            "param_name"=> "addres_content_doubled",
            "value"     => "",
            "description" => __("You can use HTML tags. Example : $str ", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'doubled' )
        ),
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Title", "js_composer"),
            "param_name"=> "tel_doubled",
            "value"     => "Phone",
            "description" => __("Main heading for contact data.", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'doubled' )
        ),
		array(
            "type"      => "textarea",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Content", "js_composer"),
            "param_name"=> "tel_content_doubled",
            "value"     => "",
            "description" => __("You can use HTML tags. Example : $str ", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'doubled' )
        ),
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Title", "js_composer"),
            "param_name"=> "fax_doubled",
            "value"     => "Fax",
            "description" => __("Main heading for contact data.", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'doubled' )
        ),
		array(
            "type"      => "textarea",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Content", "js_composer"),
            "param_name"=> "fax_content_doubled",
            "value"     => "",
            "description" => __("You can use HTML tags. Example : $str ", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'doubled' )
        ),
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Title", "js_composer"),
            "param_name"=> "mail_doubled",
            "value"     => "Email",
            "description" => __("Main heading for contact data.", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'doubled' )
        ),
		array(
            "type"      => "textarea",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Content", "js_composer"),
            "param_name"=> "mail_content_doubled",
            "value"     => "",
            "description" => __("You can use HTML tags. Example : $str ", "js_composer"),
            "dependency" => Array('element' => "type", 'value' => 'doubled' )
        ),


		//array("type" => "init_icons"),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Extra class", "js_composer"),
            "param_name"=> "el_class",
            "value"     => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        ),
    )
));

// Social icons box

vc_map( array(
    "name" => __("Social icons box", "js_composer"),
    "base" => "social_icons_box",
    "class" => "font-awesome",
    "icon" => "fa-facebook-square",
    "controls" => "full",
    "category" => 'Content',
    "description" => "Add inline social icons",
    "params" => array(
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Facebook URL", "js_composer"),
            "param_name"=> "social_facebook",
            "value"     => "",
            "description" => __("Your Facebook URL", "js_composer"),
        ),
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Twitter URL", "js_composer"),
            "param_name"=> "social_twitter",
            "value"     => "",
            "description" => __("Your Twitter URL.", "js_composer"),
        ),
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Skype URL", "js_composer"),
            "param_name"=> "social_skype",
            "value"     => "",
            "description" => __("Your Skype URL.", "js_composer"),
        ),
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Pinterest URL", "js_composer"),
            "param_name"=> "social_pinterest",
            "value"     => "",
            "description" => __("Your Pinterest URL.", "js_composer"),
        ),
        array(
            "type" => "dropdown",
            "heading" => __('Target', "js_composer"),
            "param_name" => "th_social_target",
            'value' => array(
                __( 'Same window', 'js_composer' ) => '_self',
                __( 'New window', 'js_composer' ) => '_blank'
            ),
            "description" => __("The target attribute specifies where to open the linked document.", "js_composer"),
        ),
		array(
            "type" => "dropdown",
            "heading" => __('Custom Social URL', "js_composer"),
            "param_name" => "th_custom_social",
            'value' => array(
                __( 'No', 'js_composer' ) => 'no',
                __( 'Yes', 'js_composer' ) => 'yes'
            ),
            "description" => __("Add another social icon.", "js_composer"),
        ),
		array(
            "type"      => "textarea_raw_html",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Content", "js_composer"),
            "param_name"=> "social_custom",
            "value"     => "",
            "description" => __("Ex: &lt;li&gt;&lt;a href=\"#\"&gt;&lt;span class=\"fa-stack fa-lg\"&gt;&lt;i class=\"fa fa-circle fa-stack-2x\"&gt;&lt;/i&gt;&lt;i class=\"fa fa-facebook fa-stack-1x fa-inverse\"&gt;&lt;/i&gt;&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;<br> <a href=\"http://fortawesome.github.io/Font-Awesome/icons/\" target=\"_blank\">Click to get icon</a>", "js_composer"),
            "dependency" => Array('element' => "th_custom_social", 'value' => 'yes' )
        ),
		array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Extra class", "js_composer"),
            "param_name"=> "el_class",
            "value"     => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        ),
	)
));
	
	
// Projects gallery

vc_map( array(
    "name" => __("Projects gallery", "js_composer"),
    "base" => "projects-gallery",
    "class" => "font-awesome",
    "icon" => "fa-picture-o",
    "controls" => "full",
    "category" => 'Content',
    "description" => "Projects image gallery",
    "params" => array(
        array(
            'type' => 'attach_image',
            'heading' => __( 'Image', 'js_composer' ),
            'param_name' => 'src',
            'value' => '',
            'description' => __( 'Select image from media library.', 'js_composer' )
        ),
        array(
            "type" => "textfield",
            "heading" => __("URL (Link)", "js_composer"),
            "param_name" => "url",
            "description" => __("Image link.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "js_composer"),
            "param_name" => "target",
            "value" => $target_arr,
            "dependency" => Array('element' => "url", 'not_empty' => true)
        ),
        array(
            "type"      => "textfield",
            "class"     => "",
            "heading"   => __("Project title", "js_composer"),
            "param_name"=> "title",
            "value"     => "Project title",
            "description" => __("Your project title.", "js_composer"),
        ),
        array(
            "type"      => "textfield",
            "class"     => "",
            "heading"   => __("Project description", "js_composer"),
            "param_name"=> "description",
            "value"     => "Project description",
            "description" => __("Your project description.", "js_composer"),
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Extra class", "js_composer"),
            "param_name"=> "el_class",
            "value"     => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        ),
    )
));

// Modal


if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {

    global $wpdb;
    $cf7 = $wpdb->get_results(
        "
	    SELECT ID, post_title
	    FROM $wpdb->posts
	    WHERE post_type = 'wpcf7_contact_form'
	    "
    );
    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->post_title] = $cform->ID;
        }
    } else {
        $contact_forms["No contact forms found"] = 0;
    }

    vc_map( array(
    "name" => __("Modal Section", "js_composer"),
    "base" => "modal",
    "class" => "font-awesome",
    "icon" => "fa-hand-o-up",
    "controls" => "full",
    "category" => 'Content',
    "description" => "Contact form in modal window",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "js_composer"),
            "param_name" => "title",
            "description" => __("Title of modal window.", "js_composer"),
            "value" => "Work with us"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Select contact form", "js_composer"),
            "param_name" => "id",
            "admin_label" => true,
            "value" => $contact_forms,
            "description" => __("Choose previously created Contact Form 7 form from the drop down list.", "js_composer")
        ),

    )
    ));
}

// Modal


if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {

    //vc_remove_element('contact-form-7');

    global $wpdb;
    $cf7 = $wpdb->get_results(
        "
	    SELECT ID, post_title
	    FROM $wpdb->posts
	    WHERE post_type = 'wpcf7_contact_form'
	    "
    );
    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->post_title] = $cform->ID;
        }
    } else {
        $contact_forms["No contact forms found"] = 0;
    }

    vc_map( array(
        "base" => "th_contact_form7",
        "name" => __("Contact Form 7", "js_composer"),
        "icon" => "icon-wpb-contactform7",
        "category" => __('Content', 'js_composer'),
        "description" => __('Place Contact Form7', 'js_composer'),
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Form title', 'js_composer' ),
                'param_name' => 'title',
                'admin_label' => true,
                'description' => __( 'What text use as form title. Leave blank if no title is needed.', 'js_composer' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Select contact form', 'js_composer' ),
                'param_name' => 'id',
                'value' => $contact_forms,
                'description' => __( 'Choose previously created contact form from the drop down list.', 'js_composer' )
            )
        )
    ));
}