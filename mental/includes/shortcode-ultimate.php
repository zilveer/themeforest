<?php
/**
 * Shortcodes Ultimate Plugin support
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Shortcode Ultimate Settings
 *
 * @return array
 */
function get_mental_su_settings()
{
	// Prepare settings lists

	static $animate_css_options = array('' => '', 'bounce' => 'bounce', 'flash' => 'flash', 'pulse' => 'pulse', 'rubberBand' => 'rubberBand', 'shake' => 'shake', 'swing' => 'swing', 'tada' => 'tada', 'wobble' => 'wobble', 'bounceIn' => 'bounceIn', 'bounceInDown' => 'bounceInDown', 'bounceInLeft' => 'bounceInLeft', 'bounceInRight' => 'bounceInRight', 'bounceInUp' => 'bounceInUp', 'bounceOut' => 'bounceOut', 'bounceOutDown' => 'bounceOutDown', 'bounceOutLeft' => 'bounceOutLeft', 'bounceOutRight' => 'bounceOutRight', 'bounceOutUp' => 'bounceOutUp', 'fadeIn' => 'fadeIn', 'fadeInDown' => 'fadeInDown', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeft' => 'fadeInLeft', 'fadeInLeftBig' => 'fadeInLeftBig', 'fadeInRight' => 'fadeInRight', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUp' => 'fadeInUp', 'fadeInUpBig' => 'fadeInUpBig', 'fadeOut' => 'fadeOut', 'fadeOutDown' => 'fadeOutDown', 'fadeOutDownBig' => 'fadeOutDownBig', 'fadeOutLeft' => 'fadeOutLeft', 'fadeOutLeftBig' => 'fadeOutLeftBig', 'fadeOutRight' => 'fadeOutRight', 'fadeOutRightBig' => 'fadeOutRightBig', 'fadeOutUp' => 'fadeOutUp', 'fadeOutUpBig' => 'fadeOutUpBig', 'flip' => 'flip', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY', 'flipOutX' => 'flipOutX', 'flipOutY' => 'flipOutY', 'lightSpeedIn' => 'lightSpeedIn', 'lightSpeedOut' => 'lightSpeedOut', 'rotateIn' => 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight', 'rotateInUpLeft' => 'rotateInUpLeft', 'rotateInUpRight' => 'rotateInUpRight', 'rotateOut' => 'rotateOut', 'rotateOutDownLeft' => 'rotateOutDownLeft', 'rotateOutDownRight' => 'rotateOutDownRight', 'rotateOutUpLeft' => 'rotateOutUpLeft', 'rotateOutUpRight' => 'rotateOutUpRight', 'hinge' => 'hinge', 'rollIn' => 'rollIn', 'rollOut' => 'rollOut', 'zoomIn' => 'zoomIn', 'zoomInDown' => 'zoomInDown', 'zoomInLeft' => 'zoomInLeft', 'zoomInRight' => 'zoomInRight', 'zoomInUp' => 'zoomInUp', 'zoomOut' => 'zoomOut', 'zoomOutDown' => 'zoomOutDown', 'zoomOutLeft' => 'zoomOutLeft', 'zoomOutRight' => 'zoomOutRight', 'zoomOutUp' => 'zoomOutUp');
	static $font_awesome_icons = array('' => 'No Icon', 'fa fa-adjust' => 'adjust', 'fa fa-anchor' => 'anchor', 'fa fa-archive' => 'archive', 'fa fa-arrows' => 'arrows', 'fa fa-arrows-h' => 'arrows-h', 'fa fa-arrows-v' => 'arrows-v', 'fa fa-asterisk' => 'asterisk', 'fa fa-automobile' => 'automobile', 'fa fa-ban' => 'ban', 'fa fa-bank' => 'bank', 'fa fa-bar-chart-o' => 'bar-chart-o', 'fa fa-barcode' => 'barcode', 'fa fa-bars' => 'bars', 'fa fa-beer' => 'beer', 'fa fa-bell' => 'bell', 'fa fa-bell-o' => 'bell-o', 'fa fa-bolt' => 'bolt', 'fa fa-bomb' => 'bomb', 'fa fa-book' => 'book', 'fa fa-bookmark' => 'bookmark', 'fa fa-bookmark-o' => 'bookmark-o', 'fa fa-briefcase' => 'briefcase', 'fa fa-bug' => 'bug', 'fa fa-building' => 'building', 'fa fa-building-o' => 'building-o', 'fa fa-bullhorn' => 'bullhorn', 'fa fa-bullseye' => 'bullseye', 'fa fa-cab' => 'cab', 'fa fa-calendar' => 'calendar', 'fa fa-calendar-o' => 'calendar-o', 'fa fa-camera' => 'camera', 'fa fa-camera-retro' => 'camera-retro', 'fa fa-car' => 'car', 'fa fa-caret-square-o-down' => 'caret-square-o-down', 'fa fa-caret-square-o-left' => 'caret-square-o-left', 'fa fa-caret-square-o-right' => 'caret-square-o-right', 'fa fa-caret-square-o-up' => 'caret-square-o-up', 'fa fa-certificate' => 'certificate', 'fa fa-check' => 'check', 'fa fa-check-circle' => 'check-circle', 'fa fa-check-circle-o' => 'check-circle-o', 'fa fa-check-square' => 'check-square', 'fa fa-check-square-o' => 'check-square-o', 'fa fa-child' => 'child', 'fa fa-circle' => 'circle', 'fa fa-circle-o' => 'circle-o', 'fa fa-circle-o-notch' => 'circle-o-notch', 'fa fa-circle-thin' => 'circle-thin', 'fa fa-clock-o' => 'clock-o', 'fa fa-cloud' => 'cloud', 'fa fa-cloud-download' => 'cloud-download', 'fa fa-cloud-upload' => 'cloud-upload', 'fa fa-code' => 'code', 'fa fa-code-fork' => 'code-fork', 'fa fa-coffee' => 'coffee', 'fa fa-cog' => 'cog', 'fa fa-cogs' => 'cogs', 'fa fa-comment' => 'comment', 'fa fa-comment-o' => 'comment-o', 'fa fa-comments' => 'comments', 'fa fa-comments-o' => 'comments-o', 'fa fa-compass' => 'compass', 'fa fa-credit-card' => 'credit-card', 'fa fa-crop' => 'crop', 'fa fa-crosshairs' => 'crosshairs', 'fa fa-cube' => 'cube', 'fa fa-cubes' => 'cubes', 'fa fa-cutlery' => 'cutlery', 'fa fa-dashboard' => 'dashboard', 'fa fa-database' => 'database', 'fa fa-desktop' => 'desktop', 'fa fa-dot-circle-o' => 'dot-circle-o', 'fa fa-download' => 'download', 'fa fa-edit' => 'edit', 'fa fa-ellipsis-h' => 'ellipsis-h', 'fa fa-ellipsis-v' => 'ellipsis-v', 'fa fa-envelope' => 'envelope', 'fa fa-envelope-o' => 'envelope-o', 'fa fa-envelope-square' => 'envelope-square', 'fa fa-eraser' => 'eraser', 'fa fa-exchange' => 'exchange', 'fa fa-exclamation' => 'exclamation', 'fa fa-exclamation-circle' => 'exclamation-circle', 'fa fa-exclamation-triangle' => 'exclamation-triangle', 'fa fa-external-link' => 'external-link', 'fa fa-external-link-square' => 'external-link-square', 'fa fa-eye' => 'eye', 'fa fa-eye-slash' => 'eye-slash', 'fa fa-fax' => 'fax', 'fa fa-female' => 'female', 'fa fa-fighter-jet' => 'fighter-jet', 'fa fa-file-archive-o' => 'file-archive-o', 'fa fa-file-audio-o' => 'file-audio-o', 'fa fa-file-code-o' => 'file-code-o', 'fa fa-file-excel-o' => 'file-excel-o', 'fa fa-file-image-o' => 'file-image-o', 'fa fa-file-movie-o' => 'file-movie-o', 'fa fa-file-pdf-o' => 'file-pdf-o', 'fa fa-file-photo-o' => 'file-photo-o', 'fa fa-file-picture-o' => 'file-picture-o', 'fa fa-file-powerpoint-o' => 'file-powerpoint-o', 'fa fa-file-sound-o' => 'file-sound-o', 'fa fa-file-video-o' => 'file-video-o', 'fa fa-file-word-o' => 'file-word-o', 'fa fa-file-zip-o' => 'file-zip-o', 'fa fa-film' => 'film', 'fa fa-filter' => 'filter', 'fa fa-fire' => 'fire', 'fa fa-fire-extinguisher' => 'fire-extinguisher', 'fa fa-flag' => 'flag', 'fa fa-flag-checkered' => 'flag-checkered', 'fa fa-flag-o' => 'flag-o', 'fa fa-flash' => 'flash', 'fa fa-flask' => 'flask', 'fa fa-folder' => 'folder', 'fa fa-folder-o' => 'folder-o', 'fa fa-folder-open' => 'folder-open', 'fa fa-folder-open-o' => 'folder-open-o', 'fa fa-frown-o' => 'frown-o', 'fa fa-gamepad' => 'gamepad', 'fa fa-gavel' => 'gavel', 'fa fa-gear' => 'gear', 'fa fa-gears' => 'gears', 'fa fa-gift' => 'gift', 'fa fa-glass' => 'glass', 'fa fa-globe' => 'globe', 'fa fa-graduation-cap' => 'graduation-cap', 'fa fa-group' => 'group', 'fa fa-hdd-o' => 'hdd-o', 'fa fa-headphones' => 'headphones', 'fa fa-heart' => 'heart', 'fa fa-heart-o' => 'heart-o', 'fa fa-history' => 'history', 'fa fa-home' => 'home', 'fa fa-image' => 'image', 'fa fa-inbox' => 'inbox', 'fa fa-info' => 'info', 'fa fa-info-circle' => 'info-circle', 'fa fa-institution' => 'institution', 'fa fa-key' => 'key', 'fa fa-keyboard-o' => 'keyboard-o', 'fa fa-language' => 'language', 'fa fa-laptop' => 'laptop', 'fa fa-leaf' => 'leaf', 'fa fa-legal' => 'legal', 'fa fa-lemon-o' => 'lemon-o', 'fa fa-level-down' => 'level-down', 'fa fa-level-up' => 'level-up', 'fa fa-life-bouy' => 'life-bouy', 'fa fa-life-ring' => 'life-ring', 'fa fa-life-saver' => 'life-saver', 'fa fa-lightbulb-o' => 'lightbulb-o', 'fa fa-location-arrow' => 'location-arrow', 'fa fa-lock' => 'lock', 'fa fa-magic' => 'magic', 'fa fa-magnet' => 'magnet', 'fa fa-mail-forward' => 'mail-forward', 'fa fa-mail-reply' => 'mail-reply', 'fa fa-mail-reply-all' => 'mail-reply-all', 'fa fa-male' => 'male', 'fa fa-map-marker' => 'map-marker', 'fa fa-meh-o' => 'meh-o', 'fa fa-microphone' => 'microphone', 'fa fa-microphone-slash' => 'microphone-slash', 'fa fa-minus' => 'minus', 'fa fa-minus-circle' => 'minus-circle', 'fa fa-minus-square' => 'minus-square', 'fa fa-minus-square-o' => 'minus-square-o', 'fa fa-mobile' => 'mobile', 'fa fa-mobile-phone' => 'mobile-phone', 'fa fa-money' => 'money', 'fa fa-moon-o' => 'moon-o', 'fa fa-mortar-board' => 'mortar-board', 'fa fa-music' => 'music', 'fa fa-navicon' => 'navicon', 'fa fa-paper-plane' => 'paper-plane', 'fa fa-paper-plane-o' => 'paper-plane-o', 'fa fa-paw' => 'paw', 'fa fa-pencil' => 'pencil', 'fa fa-pencil-square' => 'pencil-square', 'fa fa-pencil-square-o' => 'pencil-square-o', 'fa fa-phone' => 'phone', 'fa fa-phone-square' => 'phone-square', 'fa fa-photo' => 'photo', 'fa fa-picture-o' => 'picture-o', 'fa fa-plane' => 'plane', 'fa fa-plus' => 'plus', 'fa fa-plus-circle' => 'plus-circle', 'fa fa-plus-square' => 'plus-square', 'fa fa-plus-square-o' => 'plus-square-o', 'fa fa-power-off' => 'power-off', 'fa fa-print' => 'print', 'fa fa-puzzle-piece' => 'puzzle-piece', 'fa fa-qrcode' => 'qrcode', 'fa fa-question' => 'question', 'fa fa-question-circle' => 'question-circle', 'fa fa-quote-left' => 'quote-left', 'fa fa-quote-right' => 'quote-right', 'fa fa-random' => 'random', 'fa fa-recycle' => 'recycle', 'fa fa-refresh' => 'refresh', 'fa fa-reorder' => 'reorder', 'fa fa-reply' => 'reply', 'fa fa-reply-all' => 'reply-all', 'fa fa-retweet' => 'retweet', 'fa fa-road' => 'road', 'fa fa-rocket' => 'rocket', 'fa fa-rss' => 'rss', 'fa fa-rss-square' => 'rss-square', 'fa fa-search' => 'search', 'fa fa-search-minus' => 'search-minus', 'fa fa-search-plus' => 'search-plus', 'fa fa-send' => 'send', 'fa fa-send-o' => 'send-o', 'fa fa-share' => 'share', 'fa fa-share-alt' => 'share-alt', 'fa fa-share-alt-square' => 'share-alt-square', 'fa fa-share-square' => 'share-square', 'fa fa-share-square-o' => 'share-square-o', 'fa fa-shield' => 'shield', 'fa fa-shopping-cart' => 'shopping-cart', 'fa fa-sign-in' => 'sign-in', 'fa fa-sign-out' => 'sign-out', 'fa fa-signal' => 'signal', 'fa fa-sitemap' => 'sitemap', 'fa fa-sliders' => 'sliders', 'fa fa-smile-o' => 'smile-o', 'fa fa-sort' => 'sort', 'fa fa-sort-alpha-asc' => 'sort-alpha-asc', 'fa fa-sort-alpha-desc' => 'sort-alpha-desc', 'fa fa-sort-amount-asc' => 'sort-amount-asc', 'fa fa-sort-amount-desc' => 'sort-amount-desc', 'fa fa-sort-asc' => 'sort-asc', 'fa fa-sort-desc' => 'sort-desc', 'fa fa-sort-down' => 'sort-down', 'fa fa-sort-numeric-asc' => 'sort-numeric-asc', 'fa fa-sort-numeric-desc' => 'sort-numeric-desc', 'fa fa-sort-up' => 'sort-up', 'fa fa-space-shuttle' => 'space-shuttle', 'fa fa-spinner' => 'spinner', 'fa fa-spoon' => 'spoon', 'fa fa-square' => 'square', 'fa fa-square-o' => 'square-o', 'fa fa-star' => 'star', 'fa fa-star-half' => 'star-half', 'fa fa-star-half-empty' => 'star-half-empty', 'fa fa-star-half-full' => 'star-half-full', 'fa fa-star-half-o' => 'star-half-o', 'fa fa-star-o' => 'star-o', 'fa fa-suitcase' => 'suitcase', 'fa fa-sun-o' => 'sun-o', 'fa fa-support' => 'support', 'fa fa-tablet' => 'tablet', 'fa fa-tachometer' => 'tachometer', 'fa fa-tag' => 'tag', 'fa fa-tags' => 'tags', 'fa fa-tasks' => 'tasks', 'fa fa-taxi' => 'taxi', 'fa fa-terminal' => 'terminal', 'fa fa-thumb-tack' => 'thumb-tack', 'fa fa-thumbs-down' => 'thumbs-down', 'fa fa-thumbs-o-down' => 'thumbs-o-down', 'fa fa-thumbs-o-up' => 'thumbs-o-up', 'fa fa-thumbs-up' => 'thumbs-up', 'fa fa-ticket' => 'ticket', 'fa fa-times' => 'times', 'fa fa-times-circle' => 'times-circle', 'fa fa-times-circle-o' => 'times-circle-o', 'fa fa-tint' => 'tint', 'fa fa-toggle-down' => 'toggle-down', 'fa fa-toggle-left' => 'toggle-left', 'fa fa-toggle-right' => 'toggle-right', 'fa fa-toggle-up' => 'toggle-up', 'fa fa-trash-o' => 'trash-o', 'fa fa-tree' => 'tree', 'fa fa-trophy' => 'trophy', 'fa fa-truck' => 'truck', 'fa fa-umbrella' => 'umbrella', 'fa fa-university' => 'university', 'fa fa-unlock' => 'unlock', 'fa fa-unlock-alt' => 'unlock-alt', 'fa fa-unsorted' => 'unsorted', 'fa fa-upload' => 'upload', 'fa fa-user' => 'user', 'fa fa-users' => 'users', 'fa fa-video-camera' => 'video-camera', 'fa fa-volume-down' => 'volume-down', 'fa fa-volume-off' => 'volume-off', 'fa fa-volume-up' => 'volume-up', 'fa fa-warning' => 'warning', 'fa fa-wheelchair' => 'wheelchair', 'fa fa-wrench' => 'wrench', 'fa fa-file' => 'file', 'fa fa-file-archive-o' => 'file-archive-o', 'fa fa-file-audio-o' => 'file-audio-o', 'fa fa-file-code-o' => 'file-code-o', 'fa fa-file-excel-o' => 'file-excel-o', 'fa fa-file-image-o' => 'file-image-o', 'fa fa-file-movie-o' => 'file-movie-o', 'fa fa-file-o' => 'file-o', 'fa fa-file-pdf-o' => 'file-pdf-o', 'fa fa-file-photo-o' => 'file-photo-o', 'fa fa-file-picture-o' => 'file-picture-o', 'fa fa-file-powerpoint-o' => 'file-powerpoint-o', 'fa fa-file-sound-o' => 'file-sound-o', 'fa fa-file-text' => 'file-text', 'fa fa-file-text-o' => 'file-text-o', 'fa fa-file-video-o' => 'file-video-o', 'fa fa-file-word-o' => 'file-word-o', 'fa fa-file-zip-o' => 'file-zip-o', 'fa fa-circle-o-notch' => 'circle-o-notch', 'fa fa-cog' => 'cog', 'fa fa-gear' => 'gear', 'fa fa-refresh' => 'refresh', 'fa fa-spinner' => 'spinner', 'fa fa-check-square' => 'check-square', 'fa fa-check-square-o' => 'check-square-o', 'fa fa-circle' => 'circle', 'fa fa-circle-o' => 'circle-o', 'fa fa-dot-circle-o' => 'dot-circle-o', 'fa fa-minus-square' => 'minus-square', 'fa fa-minus-square-o' => 'minus-square-o', 'fa fa-plus-square' => 'plus-square', 'fa fa-plus-square-o' => 'plus-square-o', 'fa fa-square' => 'square', 'fa fa-square-o' => 'square-o', 'fa fa-bitcoin' => 'bitcoin', 'fa fa-btc' => 'btc', 'fa fa-cny' => 'cny', 'fa fa-dollar' => 'dollar', 'fa fa-eur' => 'eur', 'fa fa-euro' => 'euro', 'fa fa-gbp' => 'gbp', 'fa fa-inr' => 'inr', 'fa fa-jpy' => 'jpy', 'fa fa-krw' => 'krw', 'fa fa-money' => 'money', 'fa fa-rmb' => 'rmb', 'fa fa-rouble' => 'rouble', 'fa fa-rub' => 'rub', 'fa fa-ruble' => 'ruble', 'fa fa-rupee' => 'rupee', 'fa fa-try' => 'try', 'fa fa-turkish-lira' => 'turkish-lira', 'fa fa-usd' => 'usd', 'fa fa-won' => 'won', 'fa fa-yen' => 'yen', 'fa fa-align-center' => 'align-center', 'fa fa-align-justify' => 'align-justify', 'fa fa-align-left' => 'align-left', 'fa fa-align-right' => 'align-right', 'fa fa-bold' => 'bold', 'fa fa-chain' => 'chain', 'fa fa-chain-broken' => 'chain-broken', 'fa fa-clipboard' => 'clipboard', 'fa fa-columns' => 'columns', 'fa fa-copy' => 'copy', 'fa fa-cut' => 'cut', 'fa fa-dedent' => 'dedent', 'fa fa-eraser' => 'eraser', 'fa fa-file' => 'file', 'fa fa-file-o' => 'file-o', 'fa fa-file-text' => 'file-text', 'fa fa-file-text-o' => 'file-text-o', 'fa fa-files-o' => 'files-o', 'fa fa-floppy-o' => 'floppy-o', 'fa fa-font' => 'font', 'fa fa-header' => 'header', 'fa fa-indent' => 'indent', 'fa fa-italic' => 'italic', 'fa fa-link' => 'link', 'fa fa-list' => 'list', 'fa fa-list-alt' => 'list-alt', 'fa fa-list-ol' => 'list-ol', 'fa fa-list-ul' => 'list-ul', 'fa fa-outdent' => 'outdent', 'fa fa-paperclip' => 'paperclip', 'fa fa-paragraph' => 'paragraph', 'fa fa-paste' => 'paste', 'fa fa-repeat' => 'repeat', 'fa fa-rotate-left' => 'rotate-left', 'fa fa-rotate-right' => 'rotate-right', 'fa fa-save' => 'save', 'fa fa-scissors' => 'scissors', 'fa fa-strikethrough' => 'strikethrough', 'fa fa-subscript' => 'subscript', 'fa fa-superscript' => 'superscript', 'fa fa-table' => 'table', 'fa fa-text-height' => 'text-height', 'fa fa-text-width' => 'text-width', 'fa fa-th' => 'th', 'fa fa-th-large' => 'th-large', 'fa fa-th-list' => 'th-list', 'fa fa-underline' => 'underline', 'fa fa-undo' => 'undo', 'fa fa-unlink' => 'unlink', 'fa fa-angle-double-down' => 'angle-double-down', 'fa fa-angle-double-left' => 'angle-double-left', 'fa fa-angle-double-right' => 'angle-double-right', 'fa fa-angle-double-up' => 'angle-double-up', 'fa fa-angle-down' => 'angle-down', 'fa fa-angle-left' => 'angle-left', 'fa fa-angle-right' => 'angle-right', 'fa fa-angle-up' => 'angle-up', 'fa fa-arrow-circle-down' => 'arrow-circle-down', 'fa fa-arrow-circle-left' => 'arrow-circle-left', 'fa fa-arrow-circle-o-down' => 'arrow-circle-o-down', 'fa fa-arrow-circle-o-left' => 'arrow-circle-o-left', 'fa fa-arrow-circle-o-right' => 'arrow-circle-o-right', 'fa fa-arrow-circle-o-up' => 'arrow-circle-o-up', 'fa fa-arrow-circle-right' => 'arrow-circle-right', 'fa fa-arrow-circle-up' => 'arrow-circle-up', 'fa fa-arrow-down' => 'arrow-down', 'fa fa-arrow-left' => 'arrow-left', 'fa fa-arrow-right' => 'arrow-right', 'fa fa-arrow-up' => 'arrow-up', 'fa fa-arrows' => 'arrows', 'fa fa-arrows-alt' => 'arrows-alt', 'fa fa-arrows-h' => 'arrows-h', 'fa fa-arrows-v' => 'arrows-v', 'fa fa-caret-down' => 'caret-down', 'fa fa-caret-left' => 'caret-left', 'fa fa-caret-right' => 'caret-right', 'fa fa-caret-square-o-down' => 'caret-square-o-down', 'fa fa-caret-square-o-left' => 'caret-square-o-left', 'fa fa-caret-square-o-right' => 'caret-square-o-right', 'fa fa-caret-square-o-up' => 'caret-square-o-up', 'fa fa-caret-up' => 'caret-up', 'fa fa-chevron-circle-down' => 'chevron-circle-down', 'fa fa-chevron-circle-left' => 'chevron-circle-left', 'fa fa-chevron-circle-right' => 'chevron-circle-right', 'fa fa-chevron-circle-up' => 'chevron-circle-up', 'fa fa-chevron-down' => 'chevron-down', 'fa fa-chevron-left' => 'chevron-left', 'fa fa-chevron-right' => 'chevron-right', 'fa fa-chevron-up' => 'chevron-up', 'fa fa-hand-o-down' => 'hand-o-down', 'fa fa-hand-o-left' => 'hand-o-left', 'fa fa-hand-o-right' => 'hand-o-right', 'fa fa-hand-o-up' => 'hand-o-up', 'fa fa-long-arrow-down' => 'long-arrow-down', 'fa fa-long-arrow-left' => 'long-arrow-left', 'fa fa-long-arrow-right' => 'long-arrow-right', 'fa fa-long-arrow-up' => 'long-arrow-up', 'fa fa-toggle-down' => 'toggle-down', 'fa fa-toggle-left' => 'toggle-left', 'fa fa-toggle-right' => 'toggle-right', 'fa fa-toggle-up' => 'toggle-up', 'fa fa-arrows-alt' => 'arrows-alt', 'fa fa-backward' => 'backward', 'fa fa-compress' => 'compress', 'fa fa-eject' => 'eject', 'fa fa-expand' => 'expand', 'fa fa-fast-backward' => 'fast-backward', 'fa fa-fast-forward' => 'fast-forward', 'fa fa-forward' => 'forward', 'fa fa-pause' => 'pause', 'fa fa-play' => 'play', 'fa fa-play-circle' => 'play-circle', 'fa fa-play-circle-o' => 'play-circle-o', 'fa fa-step-backward' => 'step-backward', 'fa fa-step-forward' => 'step-forward', 'fa fa-stop' => 'stop', 'fa fa-youtube-play' => 'youtube-play', 'fa fa-adn' => 'adn', 'fa fa-android' => 'android', 'fa fa-apple' => 'apple', 'fa fa-behance' => 'behance', 'fa fa-behance-square' => 'behance-square', 'fa fa-bitbucket' => 'bitbucket', 'fa fa-bitbucket-square' => 'bitbucket-square', 'fa fa-bitcoin' => 'bitcoin', 'fa fa-btc' => 'btc', 'fa fa-codepen' => 'codepen', 'fa fa-css3' => 'css3', 'fa fa-delicious' => 'delicious', 'fa fa-deviantart' => 'deviantart', 'fa fa-digg' => 'digg', 'fa fa-dribbble' => 'dribbble', 'fa fa-dropbox' => 'dropbox', 'fa fa-drupal' => 'drupal', 'fa fa-empire' => 'empire', 'fa fa-facebook' => 'facebook', 'fa fa-facebook-square' => 'facebook-square', 'fa fa-flickr' => 'flickr', 'fa fa-foursquare' => 'foursquare', 'fa fa-ge' => 'ge', 'fa fa-git' => 'git', 'fa fa-git-square' => 'git-square', 'fa fa-github' => 'github', 'fa fa-github-alt' => 'github-alt', 'fa fa-github-square' => 'github-square', 'fa fa-gittip' => 'gittip', 'fa fa-google' => 'google', 'fa fa-google-plus' => 'google-plus', 'fa fa-google-plus-square' => 'google-plus-square', 'fa fa-hacker-news' => 'hacker-news', 'fa fa-html5' => 'html5', 'fa fa-instagram' => 'instagram', 'fa fa-joomla' => 'joomla', 'fa fa-jsfiddle' => 'jsfiddle', 'fa fa-linkedin' => 'linkedin', 'fa fa-linkedin-square' => 'linkedin-square', 'fa fa-linux' => 'linux', 'fa fa-maxcdn' => 'maxcdn', 'fa fa-openid' => 'openid', 'fa fa-pagelines' => 'pagelines', 'fa fa-pied-piper' => 'pied-piper', 'fa fa-pied-piper-alt' => 'pied-piper-alt', 'fa fa-pied-piper-square' => 'pied-piper-square', 'fa fa-pinterest' => 'pinterest', 'fa fa-pinterest-square' => 'pinterest-square', 'fa fa-qq' => 'qq', 'fa fa-ra' => 'ra', 'fa fa-rebel' => 'rebel', 'fa fa-reddit' => 'reddit', 'fa fa-reddit-square' => 'reddit-square', 'fa fa-renren' => 'renren', 'fa fa-share-alt' => 'share-alt', 'fa fa-share-alt-square' => 'share-alt-square', 'fa fa-skype' => 'skype', 'fa fa-slack' => 'slack', 'fa fa-soundcloud' => 'soundcloud', 'fa fa-spotify' => 'spotify', 'fa fa-stack-exchange' => 'stack-exchange', 'fa fa-stack-overflow' => 'stack-overflow', 'fa fa-steam' => 'steam', 'fa fa-steam-square' => 'steam-square', 'fa fa-stumbleupon' => 'stumbleupon', 'fa fa-stumbleupon-circle' => 'stumbleupon-circle', 'fa fa-tencent-weibo' => 'tencent-weibo', 'fa fa-trello' => 'trello', 'fa fa-tumblr' => 'tumblr', 'fa fa-tumblr-square' => 'tumblr-square', 'fa fa-twitter' => 'twitter', 'fa fa-twitter-square' => 'twitter-square', 'fa fa-vimeo-square' => 'vimeo-square', 'fa fa-vine' => 'vine', 'fa fa-vk' => 'vk', 'fa fa-wechat' => 'wechat', 'fa fa-weibo' => 'weibo', 'fa fa-weixin' => 'weixin', 'fa fa-windows' => 'windows', 'fa fa-wordpress' => 'wordpress', 'fa fa-xing' => 'xing', 'fa fa-xing-square' => 'xing-square', 'fa fa-yahoo' => 'yahoo', 'fa fa-youtube' => 'youtube', 'fa fa-youtube-play' => 'youtube-play', 'fa fa-youtube-square' => 'youtube-square', 'fa fa-ambulance' => 'ambulance', 'fa fa-h-square' => 'h-square', 'fa fa-hospital-o' => 'hospital-o', 'fa fa-medkit' => 'medkit', 'fa fa-plus-square' => 'plus-square', 'fa fa-stethoscope' => 'stethoscope', 'fa fa-user-md' => 'user-md', 'fa fa-wheelchair' => 'wheelchair');
	static $font_elegant_icons = array('' => 'No Icon', 'arrow_up' => 'arrow_up', 'arrow_down' => 'arrow_down', 'arrow_left' => 'arrow_left', 'arrow_right' => 'arrow_right', 'arrow_left-up' => 'arrow_left-up', 'arrow_right-up' => 'arrow_right-up', 'arrow_right-down' => 'arrow_right-down', 'arrow_left-down' => 'arrow_left-down', 'arrow-up-down' => 'arrow-up-down', 'arrow_up-down_alt' => 'arrow_up-down_alt', 'arrow_left-right_alt' => 'arrow_left-right_alt', 'arrow_left-right' => 'arrow_left-right', 'arrow_expand_alt2' => 'arrow_expand_alt2', 'arrow_expand_alt' => 'arrow_expand_alt', 'arrow_condense' => 'arrow_condense', 'arrow_expand' => 'arrow_expand', 'arrow_move' => 'arrow_move', 'arrow_carrot-up' => 'arrow_carrot-up', 'arrow_carrot-down' => 'arrow_carrot-down', 'arrow_carrot-left' => 'arrow_carrot-left', 'arrow_carrot-right' => 'arrow_carrot-right', 'arrow_carrot-2up' => 'arrow_carrot-2up', 'arrow_carrot-2down' => 'arrow_carrot-2down', 'arrow_carrot-2left' => 'arrow_carrot-2left', 'arrow_carrot-2right' => 'arrow_carrot-2right', 'arrow_carrot-up_alt2' => 'arrow_carrot-up_alt2', 'arrow_carrot-down_alt2' => 'arrow_carrot-down_alt2', 'arrow_carrot-left_alt2' => 'arrow_carrot-left_alt2', 'arrow_carrot-right_alt2' => 'arrow_carrot-right_alt2', 'arrow_carrot-2up_alt2' => 'arrow_carrot-2up_alt2', 'arrow_carrot-2down_alt2' => 'arrow_carrot-2down_alt2', 'arrow_carrot-2left_alt2' => 'arrow_carrot-2left_alt2', 'arrow_carrot-2right_alt2' => 'arrow_carrot-2right_alt2', 'arrow_triangle-up' => 'arrow_triangle-up', 'arrow_triangle-down' => 'arrow_triangle-down', 'arrow_triangle-left' => 'arrow_triangle-left', 'arrow_triangle-right' => 'arrow_triangle-right', 'arrow_triangle-up_alt2' => 'arrow_triangle-up_alt2', 'arrow_triangle-down_alt2' => 'arrow_triangle-down_alt2', 'arrow_triangle-left_alt2' => 'arrow_triangle-left_alt2', 'arrow_triangle-right_alt2' => 'arrow_triangle-right_alt2', 'arrow_back' => 'arrow_back', 'icon_minus-06' => 'icon_minus-06', 'icon_plus' => 'icon_plus', 'icon_close' => 'icon_close', 'icon_check' => 'icon_check', 'icon_minus_alt2' => 'icon_minus_alt2', 'icon_plus_alt2' => 'icon_plus_alt2', 'icon_close_alt2' => 'icon_close_alt2', 'icon_check_alt2' => 'icon_check_alt2', 'icon_zoom-out_alt' => 'icon_zoom-out_alt', 'icon_zoom-in_alt' => 'icon_zoom-in_alt', 'icon_search' => 'icon_search', 'icon_box-empty' => 'icon_box-empty', 'icon_box-selected' => 'icon_box-selected', 'icon_minus-box' => 'icon_minus-box', 'icon_plus-box' => 'icon_plus-box', 'icon_box-checked' => 'icon_box-checked', 'icon_circle-empty' => 'icon_circle-empty', 'icon_circle-slelected' => 'icon_circle-slelected', 'icon_stop_alt2' => 'icon_stop_alt2', 'icon_stop' => 'icon_stop', 'icon_pause_alt2' => 'icon_pause_alt2', 'icon_pause' => 'icon_pause', 'icon_menu' => 'icon_menu', 'icon_menu-square_alt2' => 'icon_menu-square_alt2', 'icon_menu-circle_alt2' => 'icon_menu-circle_alt2', 'icon_ul' => 'icon_ul', 'icon_ol' => 'icon_ol', 'icon_adjust-horiz' => 'icon_adjust-horiz', 'icon_adjust-vert' => 'icon_adjust-vert', 'icon_document_alt' => 'icon_document_alt', 'icon_documents_alt' => 'icon_documents_alt', 'icon_pencil' => 'icon_pencil', 'icon_pencil-edit_alt' => 'icon_pencil-edit_alt', 'icon_pencil-edit' => 'icon_pencil-edit', 'icon_folder-alt' => 'icon_folder-alt', 'icon_folder-open_alt' => 'icon_folder-open_alt', 'icon_folder-add_alt' => 'icon_folder-add_alt', 'icon_info_alt' => 'icon_info_alt', 'icon_error-oct_alt' => 'icon_error-oct_alt', 'icon_error-circle_alt' => 'icon_error-circle_alt', 'icon_error-triangle_alt' => 'icon_error-triangle_alt', 'icon_question_alt2' => 'icon_question_alt2', 'icon_question' => 'icon_question', 'icon_comment_alt' => 'icon_comment_alt', 'icon_chat_alt' => 'icon_chat_alt', 'icon_vol-mute_alt' => 'icon_vol-mute_alt', 'icon_volume-low_alt' => 'icon_volume-low_alt', 'icon_volume-high_alt' => 'icon_volume-high_alt', 'icon_quotations' => 'icon_quotations', 'icon_quotations_alt2' => 'icon_quotations_alt2', 'icon_clock_alt' => 'icon_clock_alt', 'icon_lock_alt' => 'icon_lock_alt', 'icon_lock-open_alt' => 'icon_lock-open_alt', 'icon_key_alt' => 'icon_key_alt', 'icon_cloud_alt' => 'icon_cloud_alt', 'icon_cloud-upload_alt' => 'icon_cloud-upload_alt', 'icon_cloud-download_alt' => 'icon_cloud-download_alt', 'icon_image' => 'icon_image', 'icon_images' => 'icon_images', 'icon_lightbulb_alt' => 'icon_lightbulb_alt', 'icon_gift_alt' => 'icon_gift_alt', 'icon_house_alt' => 'icon_house_alt', 'icon_genius' => 'icon_genius', 'icon_mobile' => 'icon_mobile', 'icon_tablet' => 'icon_tablet', 'icon_laptop' => 'icon_laptop', 'icon_desktop' => 'icon_desktop', 'icon_camera_alt' => 'icon_camera_alt', 'icon_mail_alt' => 'icon_mail_alt', 'icon_cone_alt' => 'icon_cone_alt', 'icon_ribbon_alt' => 'icon_ribbon_alt', 'icon_bag_alt' => 'icon_bag_alt', 'icon_creditcard' => 'icon_creditcard', 'icon_cart_alt' => 'icon_cart_alt', 'icon_paperclip' => 'icon_paperclip', 'icon_tag_alt' => 'icon_tag_alt', 'icon_tags_alt' => 'icon_tags_alt', 'icon_trash_alt' => 'icon_trash_alt', 'icon_cursor_alt' => 'icon_cursor_alt', 'icon_mic_alt' => 'icon_mic_alt', 'icon_compass_alt' => 'icon_compass_alt', 'icon_pin_alt' => 'icon_pin_alt', 'icon_pushpin_alt' => 'icon_pushpin_alt', 'icon_map_alt' => 'icon_map_alt', 'icon_drawer_alt' => 'icon_drawer_alt', 'icon_toolbox_alt' => 'icon_toolbox_alt', 'icon_book_alt' => 'icon_book_alt', 'icon_calendar' => 'icon_calendar', 'icon_film' => 'icon_film', 'icon_table' => 'icon_table', 'icon_contacts_alt' => 'icon_contacts_alt', 'icon_headphones' => 'icon_headphones', 'icon_lifesaver' => 'icon_lifesaver', 'icon_piechart' => 'icon_piechart', 'icon_refresh' => 'icon_refresh', 'icon_link_alt' => 'icon_link_alt', 'icon_link' => 'icon_link', 'icon_loading' => 'icon_loading', 'icon_blocked' => 'icon_blocked', 'icon_archive_alt' => 'icon_archive_alt', 'icon_heart_alt' => 'icon_heart_alt', 'icon_star_alt' => 'icon_star_alt', 'icon_star-half_alt' => 'icon_star-half_alt', 'icon_star' => 'icon_star', 'icon_star-half' => 'icon_star-half', 'icon_tools' => 'icon_tools', 'icon_tool' => 'icon_tool', 'icon_cog' => 'icon_cog', 'icon_cogs' => 'icon_cogs', 'arrow_up_alt' => 'arrow_up_alt', 'arrow_down_alt' => 'arrow_down_alt', 'arrow_left_alt' => 'arrow_left_alt', 'arrow_right_alt' => 'arrow_right_alt', 'arrow_left-up_alt' => 'arrow_left-up_alt', 'arrow_right-up_alt' => 'arrow_right-up_alt', 'arrow_right-down_alt' => 'arrow_right-down_alt', 'arrow_left-down_alt' => 'arrow_left-down_alt', 'arrow_condense_alt' => 'arrow_condense_alt', 'arrow_expand_alt3' => 'arrow_expand_alt3', 'arrow_carrot_up_alt' => 'arrow_carrot_up_alt', 'arrow_carrot-down_alt' => 'arrow_carrot-down_alt', 'arrow_carrot-left_alt' => 'arrow_carrot-left_alt', 'arrow_carrot-right_alt' => 'arrow_carrot-right_alt', 'arrow_carrot-2up_alt' => 'arrow_carrot-2up_alt', 'arrow_carrot-2dwnn_alt' => 'arrow_carrot-2dwnn_alt', 'arrow_carrot-2left_alt' => 'arrow_carrot-2left_alt', 'arrow_carrot-2right_alt' => 'arrow_carrot-2right_alt', 'arrow_triangle-up_alt' => 'arrow_triangle-up_alt', 'arrow_triangle-down_alt' => 'arrow_triangle-down_alt', 'arrow_triangle-left_alt' => 'arrow_triangle-left_alt', 'arrow_triangle-right_alt' => 'arrow_triangle-right_alt', 'icon_minus_alt' => 'icon_minus_alt', 'icon_plus_alt' => 'icon_plus_alt', 'icon_close_alt' => 'icon_close_alt', 'icon_check_alt' => 'icon_check_alt', 'icon_zoom-out' => 'icon_zoom-out', 'icon_zoom-in' => 'icon_zoom-in', 'icon_stop_alt' => 'icon_stop_alt', 'icon_menu-square_alt' => 'icon_menu-square_alt', 'icon_menu-circle_alt' => 'icon_menu-circle_alt', 'icon_document' => 'icon_document', 'icon_documents' => 'icon_documents', 'icon_pencil_alt' => 'icon_pencil_alt', 'icon_folder' => 'icon_folder', 'icon_folder-open' => 'icon_folder-open', 'icon_folder-add' => 'icon_folder-add', 'icon_folder_upload' => 'icon_folder_upload', 'icon_folder_download' => 'icon_folder_download', 'icon_info' => 'icon_info', 'icon_error-circle' => 'icon_error-circle', 'icon_error-oct' => 'icon_error-oct', 'icon_error-triangle' => 'icon_error-triangle', 'icon_question_alt' => 'icon_question_alt', 'icon_comment' => 'icon_comment', 'icon_chat' => 'icon_chat', 'icon_vol-mute' => 'icon_vol-mute', 'icon_volume-low' => 'icon_volume-low', 'icon_volume-high' => 'icon_volume-high', 'icon_quotations_alt' => 'icon_quotations_alt', 'icon_clock' => 'icon_clock', 'icon_lock' => 'icon_lock', 'icon_lock-open' => 'icon_lock-open', 'icon_key' => 'icon_key', 'icon_cloud' => 'icon_cloud', 'icon_cloud-upload' => 'icon_cloud-upload', 'icon_cloud-download' => 'icon_cloud-download', 'icon_lightbulb' => 'icon_lightbulb', 'icon_gift' => 'icon_gift', 'icon_house' => 'icon_house', 'icon_camera' => 'icon_camera', 'icon_mail' => 'icon_mail', 'icon_cone' => 'icon_cone', 'icon_ribbon' => 'icon_ribbon', 'icon_bag' => 'icon_bag', 'icon_cart' => 'icon_cart', 'icon_tag' => 'icon_tag', 'icon_tags' => 'icon_tags', 'icon_trash' => 'icon_trash', 'icon_cursor' => 'icon_cursor', 'icon_mic' => 'icon_mic', 'icon_compass' => 'icon_compass', 'icon_pin' => 'icon_pin', 'icon_pushpin' => 'icon_pushpin', 'icon_map' => 'icon_map', 'icon_drawer' => 'icon_drawer', 'icon_toolbox' => 'icon_toolbox', 'icon_book' => 'icon_book', 'icon_contacts' => 'icon_contacts', 'icon_archive' => 'icon_archive', 'icon_heart' => 'icon_heart', 'icon_profile' => 'icon_profile', 'icon_group' => 'icon_group', 'icon_grid-2x2' => 'icon_grid-2x2', 'icon_grid-3x3' => 'icon_grid-3x3', 'icon_music' => 'icon_music', 'icon_pause_alt' => 'icon_pause_alt', 'icon_phone' => 'icon_phone', 'icon_upload' => 'icon_upload', 'icon_download' => 'icon_download', 'social_facebook' => 'social_facebook', 'social_twitter' => 'social_twitter', 'social_pinterest' => 'social_pinterest', 'social_googleplus' => 'social_googleplus', 'social_tumblr' => 'social_tumblr', 'social_tumbleupon' => 'social_tumbleupon', 'social_wordpress' => 'social_wordpress', 'social_instagram' => 'social_instagram', 'social_dribbble' => 'social_dribbble', 'social_vimeo' => 'social_vimeo', 'social_linkedin' => 'social_linkedin', 'social_rss' => 'social_rss', 'social_deviantart' => 'social_deviantart', 'social_share' => 'social_share', 'social_myspace' => 'social_myspace', 'social_skype' => 'social_skype', 'social_youtube' => 'social_youtube', 'social_picassa' => 'social_picassa', 'social_googledrive' => 'social_googledrive', 'social_flickr' => 'social_flickr', 'social_blogger' => 'social_blogger', 'social_spotify' => 'social_spotify', 'social_delicious' => 'social_delicious', 'social_facebook_circle' => 'social_facebook_circle', 'social_twitter_circle' => 'social_twitter_circle', 'social_pinterest_circle' => 'social_pinterest_circle', 'social_googleplus_circle' => 'social_googleplus_circle', 'social_tumblr_circle' => 'social_tumblr_circle', 'social_stumbleupon_circle' => 'social_stumbleupon_circle', 'social_wordpress_circle' => 'social_wordpress_circle', 'social_instagram_circle' => 'social_instagram_circle', 'social_dribbble_circle' => 'social_dribbble_circle', 'social_vimeo_circle' => 'social_vimeo_circle', 'social_linkedin_circle' => 'social_linkedin_circle', 'social_rss_circle' => 'social_rss_circle', 'social_deviantart_circle' => 'social_deviantart_circle', 'social_share_circle' => 'social_share_circle', 'social_myspace_circle' => 'social_myspace_circle', 'social_skype_circle' => 'social_skype_circle', 'social_youtube_circle' => 'social_youtube_circle', 'social_picassa_circle' => 'social_picassa_circle', 'social_googledrive_alt2' => 'social_googledrive_alt2', 'social_flickr_circle' => 'social_flickr_circle', 'social_blogger_circle' => 'social_blogger_circle', 'social_spotify_circle' => 'social_spotify_circle', 'social_delicious_circle' => 'social_delicious_circle', 'social_facebook_square' => 'social_facebook_square', 'social_twitter_square' => 'social_twitter_square', 'social_pinterest_square' => 'social_pinterest_square', 'social_googleplus_square' => 'social_googleplus_square', 'social_tumblr_square' => 'social_tumblr_square', 'social_stumbleupon_square' => 'social_stumbleupon_square', 'social_wordpress_square' => 'social_wordpress_square', 'social_instagram_square' => 'social_instagram_square', 'social_dribbble_square' => 'social_dribbble_square', 'social_vimeo_square' => 'social_vimeo_square', 'social_linkedin_square' => 'social_linkedin_square', 'social_rss_square' => 'social_rss_square', 'social_deviantart_square' => 'social_deviantart_square', 'social_share_square' => 'social_share_square', 'social_myspace_square' => 'social_myspace_square', 'social_skype_square' => 'social_skype_square', 'social_youtube_square' => 'social_youtube_square', 'social_picassa_square' => 'social_picassa_square', 'social_googledrive_square' => 'social_googledrive_square', 'social_flickr_square' => 'social_flickr_square', 'social_blogger_square' => 'social_blogger_square', 'social_spotify_square' => 'social_spotify_square', 'social_delicious_square' => 'social_delicious_square', 'icon_printer' => 'icon_printer', 'icon_calulator' => 'icon_calulator', 'icon_building' => 'icon_building', 'icon_floppy' => 'icon_floppy', 'icon_drive' => 'icon_drive', 'icon_search-2' => 'icon_search-2', 'icon_id' => 'icon_id', 'icon_id-2' => 'icon_id-2', 'icon_puzzle' => 'icon_puzzle', 'icon_like' => 'icon_like', 'icon_dislike' => 'icon_dislike', 'icon_mug' => 'icon_mug', 'icon_currency' => 'icon_currency', 'icon_wallet' => 'icon_wallet', 'icon_pens' => 'icon_pens', 'icon_easel' => 'icon_easel', 'icon_flowchart' => 'icon_flowchart', 'icon_datareport' => 'icon_datareport', 'icon_briefcase' => 'icon_briefcase', 'icon_shield' => 'icon_shield', 'icon_percent' => 'icon_percent', 'icon_globe' => 'icon_globe', 'icon_globe-2' => 'icon_globe-2', 'icon_target' => 'icon_target', 'icon_hourglass' => 'icon_hourglass', 'icon_balance' => 'icon_balance', 'icon_rook' => 'icon_rook', 'icon_printer-alt' => 'icon_printer-alt', 'icon_calculator_alt' => 'icon_calculator_alt', 'icon_building_alt' => 'icon_building_alt', 'icon_floppy_alt' => 'icon_floppy_alt', 'icon_drive_alt' => 'icon_drive_alt', 'icon_search_alt' => 'icon_search_alt', 'icon_id_alt' => 'icon_id_alt', 'icon_id-2_alt' => 'icon_id-2_alt', 'icon_puzzle_alt' => 'icon_puzzle_alt', 'icon_like_alt' => 'icon_like_alt', 'icon_dislike_alt' => 'icon_dislike_alt', 'icon_mug_alt' => 'icon_mug_alt', 'icon_currency_alt' => 'icon_currency_alt', 'icon_wallet_alt' => 'icon_wallet_alt', 'icon_pens_alt' => 'icon_pens_alt', 'icon_easel_alt' => 'icon_easel_alt', 'icon_flowchart_alt' => 'icon_flowchart_alt', 'icon_datareport_alt' => 'icon_datareport_alt', 'icon_briefcase_alt' => 'icon_briefcase_alt', 'icon_shield_alt' => 'icon_shield_alt', 'icon_percent_alt' => 'icon_percent_alt', 'icon_globe_alt' => 'icon_globe_alt', 'icon_clipboard' => 'icon_clipboard');

	$gallery_categories_raw = get_terms( 'gallery_category', 'orderby=name&hide_empty=0' );
	$gallery_categories     = array( '' => '' );
	foreach ( $gallery_categories_raw as $gallery_category ) {
		$gallery_categories[ $gallery_category->term_id ] = $gallery_category->name;
	}

	$blog_categories_raw = get_terms( 'category', 'orderby=name&hide_empty=0' );
	$blog_categories     = array( '' => '' );
	foreach ( $blog_categories_raw as $blog_category ) {
		$blog_categories[ $blog_category->term_id ] = $blog_category->name;
	}


	$settings = array(

		/* ========================================================================= *\
			 Section
		\* ========================================================================= */

		'mental_section'             => array(
			'name' => __( 'Mentas Section', 'mental' ),
			'type' => 'wrap',
			'icon' => 'bars',
			'desc' => __( '', 'mental' ),
			'content' => __( 'Section Content', 'mental' ),
			'atts' => array(

				'title'                      => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'description'                => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Description', 'mental' )
				),
				'padding_top'                => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Top Padding', 'mental' )
				),
				'padding_bottom'             => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Bottom Padding', 'mental' )
				),
				'background_color'           => array(
					'type'    => 'color',
					'default' => '#FFFFFF',
					'name'    => __( 'Background color', 'mental' )
				),
				'background_image'           => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Background image URL', 'mental' )
				),
				'inverted'                   => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Dark background', 'mental' )
				),
				'background_parallax_image'  => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Background parallax image URL', 'mental' )
				),
				'background_parallax_ratio'  => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 1,
					'step'    => 0.1,
					'default' => 0.5,
					'name'    => __( 'Background parallax ratio', 'mental' )
				),
				'background_parallax_offset' => array(
					'type'    => 'text',
					'default' => '-150',
					'name'    => __( 'Background parallax offset', 'mental' )
				),
				'background_video'           => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Video background video URL', 'mental' ),
					'desc'    => __( 'You can type several different video format URLs separated by space', 'mental' )
				),
				'background_video_opacity' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 1,
					'step'    => 0.1,
					'default' => 0.1,
					'name'    => __( 'Video background opacity', 'mental' )
				),
				'full_height'                   => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( '100% height section', 'mental' )
				),
				'id'                         => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Section ID', 'mental' ),
				),
				'classes'                    => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Additional section classes', 'mental' ),
				),
				'no_container'                   => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Section without container (content takes full page width)', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Mental Gallery
		\* ========================================================================= */

		'mental_gallery'             => array(
			'name' => __( 'Mentas Gallery', 'mental' ),
			'type' => 'single',
			'icon' => 'picture-o',
			'desc' => __( '', 'mental' ),
			'atts' => array(

				'category'       => array(
					'type'    => 'select',
					'values'  => $gallery_categories,
					'default' => '',
					'name'    => __( 'Gallery category', 'mental' )
				),
				'type'           => array(
					'type'    => 'select',
					'values'  => array(
						'expanding' => 'Expanding',
						'normal'    => 'Normal',
						'pinterest' => 'Pinterest',
					),
					'default' => 'expanding',
					'name'    => __( 'Gallery type', 'mental' )
				),
				'load_on_scroll'    => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Load new items on scroll (infinite scroll)', 'mental' )
				),
				'show_filter'    => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Show filters panel', 'mental' )
				),
				'filter_align'   => array(
					'type'    => 'select',
					'values'  => array(
						'left'      => 'Left',
						'center'    => 'Center',
						'right'     => 'Right',
					),
					'default' => 'left',
					'name'    => __( 'Filter align', 'mental' )
				),
				'show_load_more'    => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Show load more', 'mental' )
				),
				'fixed_items'    => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Fixed images ratio', 'mental' ),
					'desc'   => __( 'Works only with gallery type Normal', 'mental' )
				),
				'items_per_page' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Items per page', 'mental' )
				),
				'columns_count'  => array(
					'type'    => 'select',
					'values'  => array(
						'3' => '3',
						'4' => '4',
						'5' => '5'
					),
					'default' => '4',
					'name'    => __( 'Columns count', 'mental' )
				),
				'preview_full_size'    => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Show full size preview', 'mental' ),
					'desc'   => __( 'Show in expanding preview full size preview without description and title (only with gallery type Expanding)', 'mental' )
				),
				'item_padding' => array(
					'type'    => 'text',
					'default' => '0',
					'name'    => __( 'Item padding', 'mental' )
				),
				'orderby'  => array(
						'type'    => 'select',
						'values'  => array(
							'none' => 'No order',
							'ID' => 'Order by post id',
							'author' => 'Order by author',
							'title' => 'Order by title',
							'name' => 'Order by post name (post slug)',
							'date' => 'Order by date',
							'modified' => 'Order by last modified date',
							'rand' => 'Random order',
							'comment_count' => 'Order by number of comments',
						),
						'default' => 'date',
						'name'    => __( 'Sort retrieved posts by parameter. Defaults to \'date (post_date)\'.', 'mental' )
				),
				'order'  => array(
						'type'    => 'select',
						'values'  => array(
							'ASC' => 'ASC',
							'DESC' => 'DESC',
						),
						'default' => 'ASC',
						'name'    => __( 'Designates the ascending or descending order of the \'orderby\' parameter.', 'mental' )
				),
				'id'             => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Gallery ID', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Mental Blog
		\* ========================================================================= */

		'mental_blog'                => array(
			'name' => __( 'Mentas Blog', 'mental' ),
			'type' => 'single',
			'icon' => 'list-alt',
			'desc' => __( '', 'mental' ),
			'atts' => array(

				'category'       => array(
					'type'    => 'select',
					'values'  => $blog_categories,
					'default' => '',
					'name'    => __( 'Posts category', 'mental' )
				),
				'type'           => array(
					'type'    => 'select',
					'values'  => array(
						'vertical' => __('Normal Blog', 'mental'),
						'masonry'  => __('Pinterest Style', 'mental'),
						'full'  => __('Full text', 'mental'),
					),
					'default' => 'nomral',
					'name'    => __( 'Blog type', 'mental' )
				),
				'load_on_scroll'    => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Load new items on scroll (infinite scroll)', 'mental' )
				),
				'items_per_page' => array(
					'type'    => 'text',
					'default' => '10',
					'name'    => __( 'Items per page', 'mental' )
				),
				'columns_count'  => array(
					'type'    => 'select',
					'values'  => array(
						'2' => '2',
						'3' => '3',
						'4' => '4'
					),
					'default' => '4',
					'name'    => __( 'Columns count', 'mental' )
				),
				'show_load_more' => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Show Load more link', 'mental' )
				),
                'show_excerpt' => array(
                    'type'    => 'bool',
                    'default' => 'yes',
                    'name'    => __( 'Show excerpt text', 'mental' )
                ),
				'id'             => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Blog ID', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Load More
		\* ========================================================================= */

		'mental_load_more'           => array(
			'name' => __( 'Mentas Load More', 'mental' ),
			'type' => 'single',
			'icon' => 'code',
			'desc' => __( 'Load more button, used for Gallery and Blog shortcodes', 'mental' ),
			'atts' => array(

				'target_id' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Target ID', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Animation
		\* ========================================================================= */

		'mental_animation'           => array(
			'name' => __( 'Mentas Animation', 'mental' ),
			'type' => 'wrap',
			'icon' => 'play',
			'desc' => __( '', 'mental' ),
			'content' => '',
			'atts' => array(

				'animate' => array(
					'type'    => 'select',
					'values'  => $animate_css_options,
					'default' => '',
					'name'    => __( 'Animation', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Creative Minds Section
		\* ========================================================================= */

		'mental_creative_minds'      => array(
			'name' => __( 'Mentas Creative Minds Section', 'mental' ),
			'type' => 'wrap',
			'icon' => 'puzzle-piece',
			'desc' => __( '', 'mental' ),
			'content' => '',
			'atts' => array(

				'title'                      => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'description'                => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Description', 'mental' )
				),
				'padding_top'                => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Top Padding', 'mental' )
				),
				'padding_bottom'             => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Bottom Padding', 'mental' )
				),
				'background_color'           => array(
					'type'    => 'color',
					'default' => '#FFFFFF',
					'name'    => __( 'Background color', 'mental' )
				),
				'background_image'           => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Background image URL', 'mental' )
				),
				'background_parallax_image'  => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Background parallax image URL', 'mental' )
				),
				'background_parallax_ratio'  => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 1,
					'step'    => 0.1,
					'default' => 0.5,
					'name'    => __( 'Background parallax ratio', 'mental' )
				),
				'background_parallax_offset' => array(
					'type'    => 'text',
					'default' => '-150',
					'name'    => __( 'Background parallax offset', 'mental' )
				),
				'background_video'           => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Video background video URL', 'mental' ),
					'desc'    => __( 'You can type several different video format URLs separated by space', 'mental' )
				),
				'background_video_opacity' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 1,
					'step'    => 0.1,
					'default' => 0.1,
					'name'    => __( 'Video background opacity', 'mental' )
				),
				'full_height'                   => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( '100% height section', 'mental' )
				),
				'columns_count'  => array(
					'type'    => 'select',
					'values'  => array(
							'2' => '2',
							'3' => '3',
							'4' => '4',
							'5' => '5',
							'6' => '6'
					),
					'default' => '3',
					'name'    => __( 'Columns count', 'mental' )
				),
				'id'                         => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Section ID', 'mental' ),
				),
				'classes'                    => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Additional section classes', 'mental' ),
				),

			)
		),

		'mental_creative_minds_item' => array(
			'name' => __( 'Mentas Creat. Minds Item', 'mental' ),
			'type' => 'single',
			'icon' => 'puzzle-piece',
			'desc' => __( '', 'mental' ),
			'note' => __( 'Did you know that you need to wrap single Creative Minds Item with [su_mental_creative_minds] shortcode?', 'mental' ),
			'atts' => array(

				'image'       => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Image', 'mental' )
				),
				'title'       => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'description' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Description', 'mental' )
				),
				'active'      => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Active', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Qoute Section
		\* ========================================================================= */

		'mental_quote_section'       => array(
			'name' => __( 'Mentas Qoute Section', 'mental' ),
			'type' => 'single',
			'icon' => 'quote-left',
			'desc' => __( '', 'mental' ),
			'atts' => array(

				'title'                      => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'description'                => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Description', 'mental' )
				),
				'quote'                      => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Quote', 'mental' )
				),
				'author'                     => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Author', 'mental' )
				),
				'padding_top'                => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Top Padding', 'mental' )
				),
				'padding_bottom'             => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Bottom Padding', 'mental' )
				),
				'background_color'           => array(
					'type'    => 'color',
					'default' => '#FFFFFF',
					'name'    => __( 'Background color', 'mental' )
				),
				'background_image'           => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Background image URL', 'mental' )
				),
				'background_parallax_image'  => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Background parallax image URL', 'mental' )
				),
				'background_parallax_ratio'  => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 1,
					'step'    => 0.1,
					'default' => 0.5,
					'name'    => __( 'Background parallax ratio', 'mental' )
				),
				'background_parallax_offset' => array(
					'type'    => 'text',
					'default' => '-150',
					'name'    => __( 'Background parallax offset', 'mental' )
				),
				'background_video'           => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Video background video URL', 'mental' ),
					'desc'    => __( 'You can type several different video format URLs separated by space', 'mental' )
				),
				'background_video_opacity' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 1,
					'step'    => 0.1,
					'default' => 0.1,
					'name'    => __( 'Video background opacity', 'mental' )
				),
				'full_height'                   => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( '100% height section', 'mental' )
				),
				'id'                         => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Section ID', 'mental' ),
				),
				'classes'                    => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Additional section classes', 'mental' ),
				),
				'animate' => array(
					'type'    => 'select',
					'values'  => $animate_css_options,
					'default' => '',
					'name'    => __( 'Animation', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Page Header Section
		\* ========================================================================= */

		'mental_page_header_section'       => array(
			'name' => __( 'Mentas Page Header Section', 'mental' ),
			'type' => 'single',
			'icon' => 'h-square',
			'desc' => __( '', 'mental' ),
			'atts' => array(

				'header_main'                      => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Header', 'mental' )
				),
				'header_tag'                      => array(
					'type'    => 'select',
					'values'  => array(
						'1'     => 'H1 - Extra Large',
						'2'     => 'H2 - Large',
						'3'     => 'H3 - Normal',
						'4'     => 'H4 - Small',
						'5'     => 'H5 - Smaller',
						'6'     => 'H6 - Extra Small',
				     ),
					'default' => 'h1',
					'name'    => __( 'Heading tag', 'mental' )
				),
				'header_sub'                     => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Sub header', 'mental' )
				),
				'color_main'           => array(
					'type'    => 'color',
					'default' => '#000000',
					'name'    => __( 'Header text color', 'mental' )
				),
				'color_sub'           => array(
					'type'    => 'color',
					'default' => '#000000',
					'name'    => __( 'Sub header text color', 'mental' )
				),
				'background_color_main'           => array(
					'type'    => 'color',
					'default' => '#FFFFFF',
					'name'    => __( 'Header Background color', 'mental' )
				),
				'background_color_sub'           => array(
					'type'    => 'color',
					'default' => '#FFFFFF',
					'name'    => __( 'Sub Header Background color', 'mental' )
				),
			)
		),

		/* ========================================================================= *\
			 Our Services Item
		\* ========================================================================= */

		'mental_our_services_item'   => array(
			'name' => __( 'Mentas Our Services Item', 'mental' ),
			'type' => 'single',
			'icon' => 'puzzle-piece',
			'desc' => __( 'Our Services Section Item (looks better in a column) ', 'mental' ),
			'atts' => array(

				'icon'        => array(
					'type'    => 'select',
					'values'  => array_merge( $font_awesome_icons, $font_elegant_icons ),
					'default' => '',
					'name'    => __( 'Icon', 'mental' )
				),
				'custom-icon'        => array(
					'type'    => 'upload',
					'values'  => '',
					'default' => '',
					'name'    => __( 'Custom Icon', 'mental' )
				),
				'title'       => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'description' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Description', 'mental' )
				),
				'animate'     => array(
					'type'    => 'select',
					'values'  => $animate_css_options,
					'default' => '',
					'name'    => __( 'Animation', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Testimonials
		\* ========================================================================= */

		'mental_testimonials'        => array(
			'name' => __( 'Mentas Testimonials', 'mental' ),
			'type' => 'single',
			'icon' => 'quote-right',
			'desc' => __( 'Testimonials are pulled from Posts with quote format', 'mental' ),
			'atts' => array(
				'limit' => array(
					'type'    => 'text',
					'default' => '5',
					'name'    => __( 'Limit testimonials count (default 5)', 'mental' ),
				),

			)
		),

		/* ========================================================================= *\
			 Pricing Table
		\* ========================================================================= */

		'mental_pricing_table'       => array(
			'name' => __( 'Mentas Pricing Table', 'mental' ),
			'type' => 'single',
			'icon' => 'dollar',
			'desc' => __( 'Pricing Table (looks better in a column) ', 'mental' ),
			'atts' => array(

				'title'   => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'price'   => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Price', 'mental' )
				),
				'link'    => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Link', 'mental' )
				),
				'active'  => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Active', 'mental' )
				),
				'button'  => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Show button', 'mental' )
				),
				'button_text'    => array(
					'type'    => 'text',
					'default' => __( 'Buy it now', 'mental' ),
					'name'    => __( 'Button text', 'mental' )
				),
				'items'   => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Price Items (comma separated)', 'mental' )
				),
				'columns' => array(
					'type'    => 'select',
					'values'  => array( '4' => '3', '3' => '4', '6' => '2' ),
					'default' => '',
					'name'    => __( 'Solumns count', 'mental' )
				),
				'animate' => array(
					'type'    => 'select',
					'values'  => $animate_css_options,
					'default' => '',
					'name'    => __( 'Animation', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Pie Chart
		\* ========================================================================= */

		'mental_pie_chart'           => array(
			'name' => __( 'Mentas Pie Chart', 'mental' ),
			'type' => 'single',
			'icon' => 'circle-o-notch',
			'desc' => __( 'Mentas Pie Chart', 'mental' ),
			'atts' => array(

				'title' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'value' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 100,
					'step'    => 1,
					'default' => 50,
					'name'    => __( 'Value', 'mental' )
				),
				'color' => array(
					'type'    => 'color',
					'default' => '',
					'name'    => __( 'Color', 'mental' )
				),
			)
		),

		/* ========================================================================= *\
			 Call to Action
		\* ========================================================================= */

		'mental_call_to_action'      => array(
			'name' => __( 'Mentas Call to Action', 'mental' ),
			'type' => 'single',
			'icon' => 'exclamation-circle',
			'desc' => __( 'Mentas Call to Action', 'mental' ),
			'atts' => array(

				'title'           => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'button_position' => array(
					'type'    => 'select',
					'values'  => array(
						'bottom' => 'Bottom',
						'right'  => 'Right',
					),
					'default' => 'Bottom',
					'name'    => __( 'Button position', 'mental' )
				),
				'button_text'     => array(
					'type'    => 'text',
					'default' => '',
					'default' => 'Lets go',
					'name'    => __( 'Button text', 'mental' )
				),
				'link'            => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Link', 'mental' )
				),
				'animate'         => array(
					'type'    => 'select',
					'values'  => $animate_css_options,
					'default' => '',
					'name'    => __( 'Animation', 'mental' )
				),
			)
		),

		/* ========================================================================= *\
			 Progress Bar
		\* ========================================================================= */

		'mental_progress_bar'        => array(
			'name' => __( 'Mentas Progress Bar', 'mental' ),
			'type' => 'single',
			'icon' => 'minus',
			'desc' => __( 'Mentas Progress Bar', 'mental' ),
			'atts' => array(

				'title' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'value' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Value %', 'mental' )
				),
			)
		),

		/* ========================================================================= *\
			 Accordion
		\* ========================================================================= */

		'mental_accordion'           => array(
			'name' => __( 'Mentas Accordion', 'mental' ),
			'type' => 'wrap',
			'icon' => 'align-justify',
			'desc' => __( 'Mentas Accordion (container)', 'mental' ),
			'content' => '',
			'atts' => array(

				'id' => array(
					'type'    => 'text',
					'default' => 'accordion',
					'name'    => __( 'ID', 'mental' )
				),
			)
		),

		/* ========================================================================= *\
			 Accordion Panel
		\* ========================================================================= */

		'mental_accordion_panel'     => array(
			'name' => __( 'Mentas Accordion Panel', 'mental' ),
			'type' => 'wrap',
			'icon' => 'align-justify',
			'desc' => __( 'Mentas Accordion Panel', 'mental' ),
			'note' => __( 'Did you know that you need to wrap single accordion panel with [su_mental_accordion] shortcode?', 'mental' ),
			'content' => __( 'Some Accordion Panel content', 'mental' ),
			'atts' => array(

				'title'     => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'parent_id' => array(
					'type'    => 'text',
					'default' => 'accordion',
					'name'    => __( 'Parent ID', 'mental' )
				),
				'opened'    => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Opened on start', 'mental' )
				),
			)
		),

		/* ========================================================================= *\
			 Some fun facts block
		\* ========================================================================= */

		'mental_sff'                 => array(
			'name' => __( 'Mentas Some Fun Facts', 'mental' ),
			'type' => 'single',
			'icon' => 'heart',
			'desc' => __( 'Mentas Some Fun Facts', 'mental' ),
			'atts' => array(

				'title'   => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'value'   => array(
					'type'    => 'text',
					'default' => '1000',
					'name'    => __( 'Value', 'mental' )
				),
				'icon'    => array(
					'type'    => 'select',
					'values'  => array_merge( $font_awesome_icons, $font_elegant_icons ),
					'default' => '',
					'name'    => __( 'Icon', 'mental' )
				),
				'custom-icon'        => array(
					'type'    => 'upload',
					'values'  => '',
					'default' => '',
					'name'    => __( 'Custom Icon', 'mental' )
				),
				'animate' => array(
					'type'    => 'select',
					'values'  => $animate_css_options,
					'default' => '',
					'name'    => __( 'Animation', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Icon block
		\* ========================================================================= */

		'mental_contact_p'           => array(
			'name' => __( 'Mentas Contact Paragraph', 'mental' ),
			'type' => 'wrap',
			'icon' => 'paragraph',
			'desc' => __( 'Text paragraph with icon', 'mental' ),
			'content' => '',
			'atts' => array(

				'type'    => array(
					'type'    => 'select',
					'values'  => array(
						'address-block' => 'Address block',
						'phone-block'   => 'Phone block',
						'email-block'   => 'Email block',
					),
					'default' => '',
					'name'    => __( 'Icon', 'mental' )
				),
				'animate' => array(
					'type'    => 'select',
					'values'  => $animate_css_options,
					'default' => '',
					'name'    => __( 'Animation', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Map
		\* ========================================================================= */

		'mental_map'                 => array(
			'name' => __( 'Mentas Map', 'mental' ),
			'type' => 'single',
			'icon' => 'map-marker',
			'desc' => __( 'Mentas Google Map', 'mental' ),
			'atts' => array(

				'coord'  => array(
					'type'    => 'text',
					'default' => '34.040842, -118.233977',
					'name'    => __( 'Coordinates', 'mental' )
				),
				'zoom'  => array(
					'type'    => 'text',
					'default' => '12',
					'name'    => __( 'Zoom', 'mental' )
				),
				'height' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Height', 'mental' )
				),
				'marker' => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Map marker', 'mental' )
				),
				'id' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'ID', 'mental' )
				),

			)
		),

		/* ========================================================================= *\
			 Sidebar
		\* ========================================================================= */

		'mental_sidebar'             => array(
			'name' => __( 'Mentas Sidebar', 'mental' ),
			'type' => 'single',
			'icon' => 'puzzle-piece',
			'desc' => __( 'Mentas Theme Sidebar', 'mental' ),
			'atts' => array()
		),

		/* ========================================================================= *\
			 Tabs
		\* ========================================================================= */

		'mental_tabs'                => array(
			'name' => __( 'Mentas Tabs', 'mental' ),
			'type' => 'wrap',
			'icon' => 'list-alt',
			'desc' => __( 'Mentas Tabs', 'mental' ),
			'atts' => array(),
			'content' => '',
		),

		/* ========================================================================= *\
			 Tab
		\* ========================================================================= */

		'mental_tab'                 => array(
			'name' => __( 'Mentas Tab', 'mental' ),
			'type' => 'wrap',
			'icon' => 'list-alt',
			'desc' => __( 'Mentas Tab', 'mental' ),
			'note' => __( 'Did you know that you need to wrap single tab with [su_mental_tabs] shortcode?', 'mental' ),
			'content' => '',
			'atts' => array(

				'title'      => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Title', 'mental' )
				),
				'id'         => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'ID', 'mental' )
				),
				'active'     => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Active', 'mental' )
				),
				'hightlight' => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Hightlight', 'mental' )
				),

			)
		),

	);

	/* ========================================================================= *\
		 Mental WooCommerce support
	\* ========================================================================= */

	if ( class_exists( 'WooCommerce' ) ) {

		$products_categories_raw = get_terms( 'product_cat', 'orderby=name&hide_empty=0' );
		$products_categories     = array( '' => '' );
		foreach ( $products_categories_raw as $products_category ) {
			$products_categories[ $products_category->term_id ] = $products_category->name;
		}

		$settings['mental_woo_gallery'] = array(
			'name' => __( 'Mentas Products Gallery', 'mental' ),
			'type' => 'single',
			'icon' => 'picture-o',
			'desc' => __( '', 'mental' ),
			'atts' => array(

				'category'       => array(
					'type'    => 'select',
					'values'  => $products_categories,
					'default' => '',
					'name'    => __( 'Product category', 'mental' )
				),
				'load_on_scroll'    => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Load new items on scroll (infinite scroll)', 'mental' )
				),
				'show_filter'    => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Show filters panel', 'mental' )
				),
				'filter_align'   => array(
						'type'    => 'select',
						'values'  => array(
								'left' => 'Left',
								'center'    => 'Center',
								'right' => 'Right',
						),
						'default' => 'left',
						'name'    => __( 'Filter align', 'mental' )
				),
				'fixed_items'    => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Fixed images ratio', 'mental' ),
					'desc'   => __( 'Works only with gallery type Normal', 'mental' )
				),
				'items_per_page' => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Items per page', 'mental' )
				),
				'columns_count'  => array(
					'type'    => 'select',
					'values'  => array(
						'3' => '3',
						'4' => '4',
						'5' => '5'
					),
					'default' => '',
					'name'    => __( 'Columns count', 'mental' )
				),
				'item_padding' => array(
						'type'    => 'text',
						'default' => '0',
						'name'    => __( 'Item padding', 'mental' )
				),
				'id'             => array(
					'type'    => 'text',
					'default' => '',
					'name'    => __( 'Gallery ID', 'mental' )
				),

			)
		);

	}

	return $settings;

} // function get_mental_su_settings()


/**
 * Add custom group to Shortcode Ultimate plugin
 *
 * @param $groups
 *
 * @return mixed
 */
add_filter( 'su/data/groups', 'register_mental_custom_su_group', 0, 1 );
function register_mental_custom_su_group( $groups )
{
	$groups['mental'] = __( 'Mentas', 'mental' );

	return $groups;
}

/**
 * Add custom shortcodes to Shortcode Ultimate plugin
 *
 * @param array $shortcodes Basic plugin shortcodes
 *
 * @return array Modified array
 */
add_filter( 'su/data/shortcodes', 'register_mental_custom_su_shortcodes', 0, 1 );
function register_mental_custom_su_shortcodes( $shortcodes )
{
	//   unset($shortcodes);
	$mental_su_settings = get_mental_su_settings();

	foreach ( $mental_su_settings as $shortcode => $values ) {
		$mental_su_settings[ $shortcode ]['group'] = 'mental';
		if ( ! isset( $mental_su_settings[ $shortcode ]['desc'] ) ) {
			$mental_su_settings[ $shortcode ]['desc'] = '';
		}
	}

	$shortcodes = array_merge( $mental_su_settings, $shortcodes );

	return $shortcodes;

}


/**
 * Function to show admin notice if Shortcodes Ultimate is not installed

add_action( 'admin_notices', 'mental_admin_su_notice' );
function mental_admin_su_notice()
{
	// Check that plugin is installed
	if ( function_exists( 'shortcodes_ultimate' ) ) {
		return;
	}
	// If plugin isn't installed, show notice
	echo '<div class="error notice is-dismissible"><p>For full functionality of this theme you need to
install and activate plugin <strong>Shortcodes Ultimate</strong>
. <a href="' . admin_url( 'plugin-install.php?tab=search&s=shortcodes+ultimate' ) . '">Install now</a></p></div>';
}
 */

