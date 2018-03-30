<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', '_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_theme_options() {

  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( 'option_tree_settings', array() );


  /**
   *  Icons select
   */

   $icons = Array(
		array( 'label' => 'icon-cloud-download', 'value' => 'icon-cloud-download'),
		array( 'label' => 'icon-cloud-upload', 'value' => 'icon-cloud-upload'),
		array( 'label' => 'icon-lightbulb', 'value' => 'icon-lightbulb'),
		array( 'label' => 'icon-exchange', 'value' => 'icon-exchange'),
		array( 'label' => 'icon-bell-alt', 'value' => 'icon-bell-alt'),
		array( 'label' => 'icon-file-alt', 'value' => 'icon-file-alt'),
		array( 'label' => 'icon-beer', 'value' => 'icon-beer'),
		array( 'label' => 'icon-coffee', 'value' => 'icon-coffee'),
		array( 'label' => 'icon-food', 'value' => 'icon-food'),
		array( 'label' => 'icon-fighter-jet', 'value' => 'icon-fighter-jet'),
		array( 'label' => 'icon-user-md', 'value' => 'icon-user-md'),
		array( 'label' => 'icon-stethoscope', 'value' => 'icon-stethoscope'),
		array( 'label' => 'icon-suitcase', 'value' => 'icon-suitcase'),
		array( 'label' => 'icon-building', 'value' => 'icon-building'),
		array( 'label' => 'icon-hospital', 'value' => 'icon-hospital'),
		array( 'label' => 'icon-ambulance', 'value' => 'icon-ambulance'),
		array( 'label' => 'icon-medkit', 'value' => 'icon-medkit'),
		array( 'label' => 'icon-h-sign', 'value' => 'icon-h-sign'),
		array( 'label' => 'icon-plus-sign-alt', 'value' => 'icon-plus-sign-alt'),
		array( 'label' => 'icon-spinner', 'value' => 'icon-spinner'),
		array( 'label' => 'icon-angle-left', 'value' => 'icon-angle-left'),
		array( 'label' => 'icon-angle-right', 'value' => 'icon-angle-right'),
		array( 'label' => 'icon-angle-up', 'value' => 'icon-angle-up'),
		array( 'label' => 'icon-angle-down', 'value' => 'icon-angle-down'),
		array( 'label' => 'icon-double-angle-left', 'value' => 'icon-double-angle-left'),
		array( 'label' => 'icon-double-angle-right', 'value' => 'icon-double-angle-right'),
		array( 'label' => 'icon-double-angle-up', 'value' => 'icon-double-angle-up'),
		array( 'label' => 'icon-double-angle-down', 'value' => 'icon-double-angle-down'),
		array( 'label' => 'icon-circle-blank', 'value' => 'icon-circle-blank'),
		array( 'label' => 'icon-circle', 'value' => 'icon-circle'),
		array( 'label' => 'icon-desktop', 'value' => 'icon-desktop'),
		array( 'label' => 'icon-laptop', 'value' => 'icon-laptop'),
		array( 'label' => 'icon-tablet', 'value' => 'icon-tablet'),
		array( 'label' => 'icon-mobile-phone', 'value' => 'icon-mobile-phone'),
		array( 'label' => 'icon-quote-left', 'value' => 'icon-quote-left'),
		array( 'label' => 'icon-quote-right', 'value' => 'icon-quote-right'),
		array( 'label' => 'icon-reply', 'value' => 'icon-reply'),
		array( 'label' => 'icon-github-alt', 'value' => 'icon-github-alt'),
		array( 'label' => 'icon-folder-close-alt', 'value' => 'icon-folder-close-alt'),
		array( 'label' => 'icon-folder-open-alt', 'value' => 'icon-folder-open-alt'),
		array( 'label' => 'icon-adjust', 'value' => 'icon-adjust'),
		array( 'label' => 'icon-asterisk', 'value' => 'icon-asterisk'),
		array( 'label' => 'icon-ban-circle', 'value' => 'icon-ban-circle'),
		array( 'label' => 'icon-bar-chart', 'value' => 'icon-bar-chart'),
		array( 'label' => 'icon-barcode', 'value' => 'icon-barcode'),
		array( 'label' => 'icon-beaker', 'value' => 'icon-beaker'),
		array( 'label' => 'icon-beer', 'value' => 'icon-beer'),
		array( 'label' => 'icon-bell', 'value' => 'icon-bell'),
		array( 'label' => 'icon-bell-alt', 'value' => 'icon-bell-alt'),
		array( 'label' => 'icon-bolt', 'value' => 'icon-bolt'),
		array( 'label' => 'icon-book', 'value' => 'icon-book'),
		array( 'label' => 'icon-bookmark', 'value' => 'icon-bookmark'),
		array( 'label' => 'icon-bookmark-empty', 'value' => 'icon-bookmark-empty'),
		array( 'label' => 'icon-briefcase', 'value' => 'icon-briefcase'),
		array( 'label' => 'icon-bullhorn', 'value' => 'icon-bullhorn'),
		array( 'label' => 'icon-calendar', 'value' => 'icon-calendar'),
		array( 'label' => 'icon-camera', 'value' => 'icon-camera'),
		array( 'label' => 'icon-camera-retro', 'value' => 'icon-camera-retro'),
		array( 'label' => 'icon-certificate', 'value' => 'icon-certificate'),
		array( 'label' => 'icon-check', 'value' => 'icon-check'),
		array( 'label' => 'icon-check-empty', 'value' => 'icon-check-empty'),
		array( 'label' => 'icon-circle', 'value' => 'icon-circle'),
		array( 'label' => 'icon-circle-blank', 'value' => 'icon-circle-blank'),
		array( 'label' => 'icon-cloud', 'value' => 'icon-cloud'),
		array( 'label' => 'icon-cloud-download', 'value' => 'icon-cloud-download'),
		array( 'label' => 'icon-cloud-upload', 'value' => 'icon-cloud-upload'),
		array( 'label' => 'icon-coffee', 'value' => 'icon-coffee'),
		array( 'label' => 'icon-cog', 'value' => 'icon-cog'),
		array( 'label' => 'icon-cogs', 'value' => 'icon-cogs'),
		array( 'label' => 'icon-comment', 'value' => 'icon-comment'),
		array( 'label' => 'icon-comment-alt', 'value' => 'icon-comment-alt'),
		array( 'label' => 'icon-comments', 'value' => 'icon-comments'),
		array( 'label' => 'icon-comments-alt', 'value' => 'icon-comments-alt'),
		array( 'label' => 'icon-credit-card', 'value' => 'icon-credit-card'),
		array( 'label' => 'icon-dashboard', 'value' => 'icon-dashboard'),
		array( 'label' => 'icon-desktop', 'value' => 'icon-desktop'),
		array( 'label' => 'icon-download', 'value' => 'icon-download'),
		array( 'label' => 'icon-download-alt', 'value' => 'icon-download-alt'),
		array( 'label' => 'icon-edit', 'value' => 'icon-edit'),
		array( 'label' => 'icon-envelope', 'value' => 'icon-envelope'),
		array( 'label' => 'icon-envelope-alt', 'value' => 'icon-envelope-alt'),
		array( 'label' => 'icon-exchange', 'value' => 'icon-exchange'),
		array( 'label' => 'icon-exclamation-sign', 'value' => 'icon-exclamation-sign'),
		array( 'label' => 'icon-external-link', 'value' => 'icon-external-link'),
		array( 'label' => 'icon-eye-close', 'value' => 'icon-eye-close'),
		array( 'label' => 'icon-eye-open', 'value' => 'icon-eye-open'),
		array( 'label' => 'icon-facetime-video', 'value' => 'icon-facetime-video'),
		array( 'label' => 'icon-fighter-jet', 'value' => 'icon-fighter-jet'),
		array( 'label' => 'icon-film', 'value' => 'icon-film'),
		array( 'label' => 'icon-filter', 'value' => 'icon-filter'),
		array( 'label' => 'icon-fire', 'value' => 'icon-fire'),
		array( 'label' => 'icon-flag', 'value' => 'icon-flag'),
		array( 'label' => 'icon-folder-close', 'value' => 'icon-folder-close'),
		array( 'label' => 'icon-folder-open', 'value' => 'icon-folder-open'),
		array( 'label' => 'icon-folder-close-alt', 'value' => 'icon-folder-close-alt'),
		array( 'label' => 'icon-folder-open-alt', 'value' => 'icon-folder-open-alt'),
		array( 'label' => 'icon-food', 'value' => 'icon-food'),
		array( 'label' => 'icon-gift', 'value' => 'icon-gift'),
		array( 'label' => 'icon-glass', 'value' => 'icon-glass'),
		array( 'label' => 'icon-globe', 'value' => 'icon-globe'),
		array( 'label' => 'icon-group', 'value' => 'icon-group'),
		array( 'label' => 'icon-hdd', 'value' => 'icon-hdd'),
		array( 'label' => 'icon-headphones', 'value' => 'icon-headphones'),
		array( 'label' => 'icon-heart', 'value' => 'icon-heart'),
		array( 'label' => 'icon-heart-empty', 'value' => 'icon-heart-empty'),
		array( 'label' => 'icon-home', 'value' => 'icon-home'),
		array( 'label' => 'icon-inbox', 'value' => 'icon-inbox'),
		array( 'label' => 'icon-info-sign', 'value' => 'icon-info-sign'),
		array( 'label' => 'icon-key', 'value' => 'icon-key'),
		array( 'label' => 'icon-leaf', 'value' => 'icon-leaf'),
		array( 'label' => 'icon-laptop', 'value' => 'icon-laptop'),
		array( 'label' => 'icon-legal', 'value' => 'icon-legal'),
		array( 'label' => 'icon-lemon', 'value' => 'icon-lemon'),
		array( 'label' => 'icon-lightbulb', 'value' => 'icon-lightbulb'),
		array( 'label' => 'icon-lock', 'value' => 'icon-lock'),
		array( 'label' => 'icon-unlock', 'value' => 'icon-unlock'),
		array( 'label' => 'icon-magic', 'value' => 'icon-magic'),
		array( 'label' => 'icon-magnet', 'value' => 'icon-magnet'),
		array( 'label' => 'icon-map-marker', 'value' => 'icon-map-marker'),
		array( 'label' => 'icon-minus', 'value' => 'icon-minus'),
		array( 'label' => 'icon-minus-sign', 'value' => 'icon-minus-sign'),
		array( 'label' => 'icon-mobile-phone', 'value' => 'icon-mobile-phone'),
		array( 'label' => 'icon-money', 'value' => 'icon-money'),
		array( 'label' => 'icon-move', 'value' => 'icon-move'),
		array( 'label' => 'icon-music', 'value' => 'icon-music'),
		array( 'label' => 'icon-off', 'value' => 'icon-off'),
		array( 'label' => 'icon-ok', 'value' => 'icon-ok'),
		array( 'label' => 'icon-ok-circle', 'value' => 'icon-ok-circle'),
		array( 'label' => 'icon-ok-sign', 'value' => 'icon-ok-sign'),
		array( 'label' => 'icon-pencil', 'value' => 'icon-pencil'),
		array( 'label' => 'icon-picture', 'value' => 'icon-picture'),
		array( 'label' => 'icon-plane', 'value' => 'icon-plane'),
		array( 'label' => 'icon-plus', 'value' => 'icon-plus'),
		array( 'label' => 'icon-plus-sign', 'value' => 'icon-plus-sign'),
		array( 'label' => 'icon-print', 'value' => 'icon-print'),
		array( 'label' => 'icon-pushpin', 'value' => 'icon-pushpin'),
		array( 'label' => 'icon-qrcode', 'value' => 'icon-qrcode'),
		array( 'label' => 'icon-question-sign', 'value' => 'icon-question-sign'),
		array( 'label' => 'icon-quote-left', 'value' => 'icon-quote-left'),
		array( 'label' => 'icon-quote-right', 'value' => 'icon-quote-right'),
		array( 'label' => 'icon-random', 'value' => 'icon-random'),
		array( 'label' => 'icon-refresh', 'value' => 'icon-refresh'),
		array( 'label' => 'icon-remove', 'value' => 'icon-remove'),
		array( 'label' => 'icon-remove-circle', 'value' => 'icon-remove-circle'),
		array( 'label' => 'icon-remove-sign', 'value' => 'icon-remove-sign'),
		array( 'label' => 'icon-reorder', 'value' => 'icon-reorder'),
		array( 'label' => 'icon-reply', 'value' => 'icon-reply'),
		array( 'label' => 'icon-resize-horizontal', 'value' => 'icon-resize-horizontal'),
		array( 'label' => 'icon-resize-vertical', 'value' => 'icon-resize-vertical'),
		array( 'label' => 'icon-retweet', 'value' => 'icon-retweet'),
		array( 'label' => 'icon-road', 'value' => 'icon-road'),
		array( 'label' => 'icon-rss', 'value' => 'icon-rss'),
		array( 'label' => 'icon-screenshot', 'value' => 'icon-screenshot'),
		array( 'label' => 'icon-search', 'value' => 'icon-search'),
		array( 'label' => 'icon-share', 'value' => 'icon-share'),
		array( 'label' => 'icon-share-alt', 'value' => 'icon-share-alt'),
		array( 'label' => 'icon-shopping-cart', 'value' => 'icon-shopping-cart'),
		array( 'label' => 'icon-signal', 'value' => 'icon-signal'),
		array( 'label' => 'icon-signin', 'value' => 'icon-signin'),
		array( 'label' => 'icon-signout', 'value' => 'icon-signout'),
		array( 'label' => 'icon-sitemap', 'value' => 'icon-sitemap'),
		array( 'label' => 'icon-sort', 'value' => 'icon-sort'),
		array( 'label' => 'icon-sort-down', 'value' => 'icon-sort-down'),
		array( 'label' => 'icon-sort-up', 'value' => 'icon-sort-up'),
		array( 'label' => 'icon-spinner', 'value' => 'icon-spinner'),
		array( 'label' => 'icon-star', 'value' => 'icon-star'),
		array( 'label' => 'icon-star-empty', 'value' => 'icon-star-empty'),
		array( 'label' => 'icon-star-half', 'value' => 'icon-star-half'),
		array( 'label' => 'icon-tablet', 'value' => 'icon-tablet'),
		array( 'label' => 'icon-tag', 'value' => 'icon-tag'),
		array( 'label' => 'icon-tags', 'value' => 'icon-tags'),
		array( 'label' => 'icon-tasks', 'value' => 'icon-tasks'),
		array( 'label' => 'icon-thumbs-down', 'value' => 'icon-thumbs-down'),
		array( 'label' => 'icon-thumbs-up', 'value' => 'icon-thumbs-up'),
		array( 'label' => 'icon-time', 'value' => 'icon-time'),
		array( 'label' => 'icon-tint', 'value' => 'icon-tint'),
		array( 'label' => 'icon-trash', 'value' => 'icon-trash'),
		array( 'label' => 'icon-trophy', 'value' => 'icon-trophy'),
		array( 'label' => 'icon-truck', 'value' => 'icon-truck'),
		array( 'label' => 'icon-umbrella', 'value' => 'icon-umbrella'),
		array( 'label' => 'icon-upload', 'value' => 'icon-upload'),
		array( 'label' => 'icon-upload-alt', 'value' => 'icon-upload-alt'),
		array( 'label' => 'icon-user', 'value' => 'icon-user'),
		array( 'label' => 'icon-user-md', 'value' => 'icon-user-md'),
		array( 'label' => 'icon-volume-off', 'value' => 'icon-volume-off'),
		array( 'label' => 'icon-volume-down', 'value' => 'icon-volume-down'),
		array( 'label' => 'icon-volume-up', 'value' => 'icon-volume-up'),
		array( 'label' => 'icon-warning-sign', 'value' => 'icon-warning-sign'),
		array( 'label' => 'icon-wrench', 'value' => 'icon-wrench'),
		array( 'label' => 'icon-zoom-in', 'value' => 'icon-zoom-in'),
		array( 'label' => 'icon-zoom-out', 'value' => 'icon-zoom-out'),
		array( 'label' => 'icon-file', 'value' => 'icon-file'),
		array( 'label' => 'icon-file-alt', 'value' => 'icon-file-alt'),
		array( 'label' => 'icon-cut', 'value' => 'icon-cut'),
		array( 'label' => 'icon-copy', 'value' => 'icon-copy'),
		array( 'label' => 'icon-paste', 'value' => 'icon-paste'),
		array( 'label' => 'icon-save', 'value' => 'icon-save'),
		array( 'label' => 'icon-undo', 'value' => 'icon-undo'),
		array( 'label' => 'icon-repeat', 'value' => 'icon-repeat'),
		array( 'label' => 'icon-text-height', 'value' => 'icon-text-height'),
		array( 'label' => 'icon-text-width', 'value' => 'icon-text-width'),
		array( 'label' => 'icon-align-left', 'value' => 'icon-align-left'),
		array( 'label' => 'icon-align-center', 'value' => 'icon-align-center'),
		array( 'label' => 'icon-align-right', 'value' => 'icon-align-right'),
		array( 'label' => 'icon-align-justify', 'value' => 'icon-align-justify'),
		array( 'label' => 'icon-indent-left', 'value' => 'icon-indent-left'),
		array( 'label' => 'icon-indent-right', 'value' => 'icon-indent-right'),
		array( 'label' => 'icon-font', 'value' => 'icon-font'),
		array( 'label' => 'icon-bold', 'value' => 'icon-bold'),
		array( 'label' => 'icon-italic', 'value' => 'icon-italic'),
		array( 'label' => 'icon-strikethrough', 'value' => 'icon-strikethrough'),
		array( 'label' => 'icon-underline', 'value' => 'icon-underline'),
		array( 'label' => 'icon-link', 'value' => 'icon-link'),
		array( 'label' => 'icon-paper-clip', 'value' => 'icon-paper-clip'),
		array( 'label' => 'icon-columns', 'value' => 'icon-columns'),
		array( 'label' => 'icon-table', 'value' => 'icon-table'),
		array( 'label' => 'icon-th-large', 'value' => 'icon-th-large'),
		array( 'label' => 'icon-th', 'value' => 'icon-th'),
		array( 'label' => 'icon-th-list', 'value' => 'icon-th-list'),
		array( 'label' => 'icon-list', 'value' => 'icon-list'),
		array( 'label' => 'icon-list-ol', 'value' => 'icon-list-ol'),
		array( 'label' => 'icon-list-ul', 'value' => 'icon-list-ul'),
		array( 'label' => 'icon-list-alt', 'value' => 'icon-list-alt'),
		array( 'label' => 'icon-angle-left', 'value' => 'icon-angle-left'),
		array( 'label' => 'icon-angle-right', 'value' => 'icon-angle-right'),
		array( 'label' => 'icon-angle-up', 'value' => 'icon-angle-up'),
		array( 'label' => 'icon-angle-down', 'value' => 'icon-angle-down'),
		array( 'label' => 'icon-arrow-down', 'value' => 'icon-arrow-down'),
		array( 'label' => 'icon-arrow-left', 'value' => 'icon-arrow-left'),
		array( 'label' => 'icon-arrow-right', 'value' => 'icon-arrow-right'),
		array( 'label' => 'icon-arrow-up', 'value' => 'icon-arrow-up'),
		array( 'label' => 'icon-caret-down', 'value' => 'icon-caret-down'),
		array( 'label' => 'icon-caret-left', 'value' => 'icon-caret-left'),
		array( 'label' => 'icon-caret-right', 'value' => 'icon-caret-right'),
		array( 'label' => 'icon-caret-up', 'value' => 'icon-caret-up'),
		array( 'label' => 'icon-chevron-down', 'value' => 'icon-chevron-down'),
		array( 'label' => 'icon-chevron-left', 'value' => 'icon-chevron-left'),
		array( 'label' => 'icon-chevron-right', 'value' => 'icon-chevron-right'),
		array( 'label' => 'icon-chevron-up', 'value' => 'icon-chevron-up'),
		array( 'label' => 'icon-circle-arrow-down', 'value' => 'icon-circle-arrow-down'),
		array( 'label' => 'icon-circle-arrow-left', 'value' => 'icon-circle-arrow-left'),
		array( 'label' => 'icon-circle-arrow-right', 'value' => 'icon-circle-arrow-right'),
		array( 'label' => 'icon-circle-arrow-up', 'value' => 'icon-circle-arrow-up'),
		array( 'label' => 'icon-double-angle-left', 'value' => 'icon-double-angle-left'),
		array( 'label' => 'icon-double-angle-right', 'value' => 'icon-double-angle-right'),
		array( 'label' => 'icon-double-angle-up', 'value' => 'icon-double-angle-up'),
		array( 'label' => 'icon-double-angle-down', 'value' => 'icon-double-angle-down'),
		array( 'label' => 'icon-hand-down', 'value' => 'icon-hand-down'),
		array( 'label' => 'icon-hand-left', 'value' => 'icon-hand-left'),
		array( 'label' => 'icon-hand-right', 'value' => 'icon-hand-right'),
		array( 'label' => 'icon-hand-up', 'value' => 'icon-hand-up'),
		array( 'label' => 'icon-circle', 'value' => 'icon-circle'),
		array( 'label' => 'icon-circle-blank', 'value' => 'icon-circle-blank'),
		array( 'label' => 'icon-play-circle', 'value' => 'icon-play-circle'),
		array( 'label' => 'icon-play', 'value' => 'icon-play'),
		array( 'label' => 'icon-pause', 'value' => 'icon-pause'),
		array( 'label' => 'icon-stop', 'value' => 'icon-stop'),
		array( 'label' => 'icon-step-backward', 'value' => 'icon-step-backward'),
		array( 'label' => 'icon-fast-backward', 'value' => 'icon-fast-backward'),
		array( 'label' => 'icon-backward', 'value' => 'icon-backward'),
		array( 'label' => 'icon-forward', 'value' => 'icon-forward'),
		array( 'label' => 'icon-fast-forward', 'value' => 'icon-fast-forward'),
		array( 'label' => 'icon-step-forward', 'value' => 'icon-step-forward'),
		array( 'label' => 'icon-eject', 'value' => 'icon-eject'),
		array( 'label' => 'icon-fullscreen', 'value' => 'icon-fullscreen'),
		array( 'label' => 'icon-resize-full', 'value' => 'icon-resize-full'),
		array( 'label' => 'icon-resize-small', 'value' => 'icon-resize-small'),
		array( 'label' => 'icon-phone', 'value' => 'icon-phone'),
		array( 'label' => 'icon-phone-sign', 'value' => 'icon-phone-sign'),
		array( 'label' => 'icon-facebook', 'value' => 'icon-facebook'),
		array( 'label' => 'icon-facebook-sign', 'value' => 'icon-facebook-sign'),
		array( 'label' => 'icon-twitter', 'value' => 'icon-twitter'),
		array( 'label' => 'icon-twitter-sign', 'value' => 'icon-twitter-sign'),
		array( 'label' => 'icon-github', 'value' => 'icon-github'),
		array( 'label' => 'icon-github-alt', 'value' => 'icon-github-alt'),
		array( 'label' => 'icon-github-sign', 'value' => 'icon-github-sign'),
		array( 'label' => 'icon-linkedin', 'value' => 'icon-linkedin'),
		array( 'label' => 'icon-linkedin-sign', 'value' => 'icon-linkedin-sign'),
		array( 'label' => 'icon-pinterest', 'value' => 'icon-pinterest'),
		array( 'label' => 'icon-pinterest-sign', 'value' => 'icon-pinterest-sign'),
		array( 'label' => 'icon-google-plus', 'value' => 'icon-google-plus'),
		array( 'label' => 'icon-google-plus-sign', 'value' => 'icon-google-plus-sign'),
		array( 'label' => 'icon-sign-blank', 'value' => 'icon-sign-blank'),
		array( 'label' => 'icon-ambulance', 'value' => 'icon-ambulance'),
		array( 'label' => 'icon-beaker', 'value' => 'icon-beaker'),
		array( 'label' => 'icon-h-sign', 'value' => 'icon-h-sign'),
		array( 'label' => 'icon-hospital', 'value' => 'icon-hospital'),
		array( 'label' => 'icon-medkit', 'value' => 'icon-medkit'),
		array( 'label' => 'icon-plus-sign-alt', 'value' => 'icon-plus-sign-alt'),
		array( 'label' => 'icon-stethoscope', 'value' => 'icon-stethoscope'),
		array( 'label' => 'icon-user-md', 'value' => 'icon-user-md')
	);

  /**
   * Create a custom settings array that we pass to
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p>Help content goes here!</p>'
        )
      ),
      'sidebar'       => '<p>Sidebar content goes here!</p>'
    ),
	'sections'        => array(
		array(
			'title'       => 'General',
			'id'          => 'general'
		),
		array(
			'title'       => 'HomePage',
			'id'          => 'home'
		),
		array(
			'title'       => 'Home 3 Steps',
			'id'          => 'steps'
		),
		array(
			'title'       => 'Blog',
			'id'          => 'blog'
		),
		array(
			'title'       => 'Events',
			'id'          => 'events'
		),
		array(
			'title'       => 'Social',
			'id'          => 'social'
		) /*,
		array(
			'title'       => 'General std',
			'id'          => 'general_default'
		),
		array(
			'title'       => 'Miscellaneous std',
			'id'          => 'miscellaneous'
		),*/
	),
    'settings'        => array(
		array(
		  'label'       => 'Favicon',
		  'id'          => 'favicon_img',
		  'type'        => 'upload',
		  'desc'        => 'Upload the site favicon.',
		  'std'         => get_template_directory_uri() .'/favicon.ico',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'general'
		),
      array(
        'label'       => 'Background',
        'id'          => 'my_background',
        'type'        => 'background',
        'desc'        => 'BlahLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => array(
			'background-color' => '#FAFAFA',
			'background-repeat'=> 'repeat',
			'background-attachment' => 'scroll',
			'background-position' => 'left top',
			'background-image' => get_template_directory_uri() . '/img/grid_noise.png'
		),
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
      array(
        'label'       => 'Primary Color',
        'id'          => 'primary_color',
        'type'        => 'colorpicker',
        'desc'        => 'Choose a primary color',
        'std'         => '#e3511c',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
      array(
        'label'       => 'Secondary Color',
        'id'          => 'secondary_color',
        'type'        => 'colorpicker',
        'desc'        => 'Choose a secondary color.',
        'std'         => '#4fb1b8',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
      array(
        'label'       => 'Footer Sponsor',
        'id'          => 'sponsor',
        'type'        => 'list-item',
        'desc'        => 'Upload your sponsor to show in the footer',
        'settings'    => array(
          array(
            'label'       => 'Sponsor logo',
            'id'          => 'sponsor_logo',
            'type'        => 'upload',
            'desc'        => '',
            'std'         => get_template_directory_uri() . '/img/elastislide/small/sweetco.jpg',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'label'       => 'URL',
            'id'          => 'sponsor_url',
            'type'        => 'text',
            'desc'        => 'The url to link to.',
            'std'         => 'http://www.dynamick.it',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        ),
        'std'         => array(
			array('title'=>'Sweetco', 'sponsor_logo'=> get_template_directory_uri() . '/img/elastislide/small/sweetco.jpg', 'sponsor_url' => 'http://www.dynamick.it'),
			array('title'=>'Cloud28', 'sponsor_logo'=> get_template_directory_uri() . '/img/elastislide/small/cloud28.jpg', 'sponsor_url' => 'http://www.dynamick.it'),
			array('title'=>'Josephine', 'sponsor_logo'=> get_template_directory_uri() . '/img/elastislide/small/josephine.jpg', 'sponsor_url' => 'http://www.dynamick.it'),
			array('title'=>'Erre', 'sponsor_logo'=> get_template_directory_uri() . '/img/elastislide/small/r.jpg', 'sponsor_url' => 'http://www.dynamick.it'),
			array('title'=>'Simpa', 'sponsor_logo'=> get_template_directory_uri() . '/img/elastislide/small/simpa.jpg', 'sponsor_url' => 'http://www.dynamick.it'),
			array('title'=>'John', 'sponsor_logo'=> get_template_directory_uri() . '/img/elastislide/small/john.jpg', 'sponsor_url' => 'http://www.dynamick.it')
		),
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  	array(
				'label'       => 'ThemeForest check update',
				'id'          => 'tfcheck',
				'type'        => 'radio',
				'desc'        => 'Do you want to check theme updates?',
				'std'         => '0',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => 'general',
				'choices'     => array(
					array( 'label' => 'Yes', 'value' => '1' ),
					array( 'label' => 'No', 'value' => '0' ) )
				),
      array(
        'label'       => 'ThemeForest Username',
        'id'          => 'themeforestid',
        'type'        => 'text',
        'desc'        => 'Used for theme updates',
        'std'         => 'demonstudio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
      array(
        'label'       => 'ThemeForest API KEY',
        'id'          => 'tfsecrectapikey',
        'type'        => 'text',
        'desc'        => 'Used for theme updates',
        'std'         => 'xxxxxxxav7hny3p1ptm7xxxxxxxx',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),


      array(
        'label'       => 'Homepage Slideshow',
        'id'          => 'home_slides_category',
        'type'        => 'category-select',
        'desc'        => 'Choose the category to show in the home slides show',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home'
      ),
      array(
        'label'       => 'Homepage News Category',
        'id'          => 'home_news_category',
        'type'        => 'category-select',
        'desc'        => 'Choose the news category to show in the home',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home'
      ),
      array(
        'label'       => 'Event slideshow',
        'id'          => 'event_highlight_category',
        'type'        => 'taxonomy-select',
        'desc'        => 'Choose the event category to show in the box slides.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => 'event-category',
        'class'       => '',
        'section'     => 'home'
      ),
      array(
        'label'       => 'Event Tab 1',
        'id'          => 'event_tab1_category',
        'type'        => 'taxonomy-select',
        'desc'        => 'Choose the event category to show in the tab 1 pane',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => 'event-category',
        'class'       => '',
        'section'     => 'home'
      ),
      array(
        'label'       => 'Event Tab 2',
        'id'          => 'event_tab2_category',
        'type'        => 'taxonomy-select',
        'desc'        => 'Choose the event category to show in the tab 2 pane',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => 'event-category',
        'class'       => '',
        'section'     => 'home'
      ),
      array(
        'label'       => 'Quote',
        'id'          => 'citation',
        'type'        => 'text',
        'desc'        => 'Write an emotional sentence',
        'std'         => 'Style is what separates the good from the great.',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home'
      ),
      array(
        'label'       => 'Quote Author',
        'id'          => 'citation_author',
        'type'        => 'text',
        'desc'        => 'Write the quote author',
        'std'         => 'Bozhidar Batsov',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home'
      ),



      array(
        'label'       => 'FIRST STEP',
        'id'          => '1_step',
        'type'        => 'textblock-titled',
        'desc'        => '<p>Customize the first step</p>',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Icon',
        'id'          => '1_step_icon',
        'type'        => 'select',
        'desc'        => 'Choose an icon to show in the first step',
        'choices'     => $icons,
        'std'         => 'icon-heart',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Title',
        'id'          => '1_step_title',
        'type'        => 'text',
        'desc'        => 'Write the 1° step title',
        'std'         => 'Features',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Text',
        'id'          => '1_step_text',
        'type'        => 'text',
        'desc'        => 'Write the 1° step payoff',
        'std'         => 'Discover our best exhibitions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'URL',
        'id'          => '1_step_url',
        'type'        => 'text',
        'desc'        => 'The url to link',
        'std'         => '/features',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),

      array(
        'label'       => 'SECOND STEP',
        'id'          => '2_step',
        'type'        => 'textblock-titled',
        'desc'        => '<p>Customize the second step</p>',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Icon',
        'id'          => '2_step_icon',
        'type'        => 'select',
        'desc'        => 'Choose an icon to show in the second step',
        'choices'     => $icons,
        'std'         => 'icon-beer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Title',
        'id'          => '2_step_title',
        'type'        => 'text',
        'desc'        => 'Write the 2° step title',
        'std'         => 'Food &amp; Drink',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Text',
        'id'          => '2_step_text',
        'type'        => 'text',
        'desc'        => 'Write the 2° step payoff',
        'std'         => 'Taste our special traditional dishes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'URL',
        'id'          => '2_step_url',
        'type'        => 'text',
        'desc'        => 'The url to link',
        'std'         => '/typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),

      array(
        'label'       => 'THIRD STEP',
        'id'          => '3_step',
        'type'        => 'textblock-titled',
        'desc'        => '<p>Customize the Third step</p>',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Icon',
        'id'          => '3_step_icon',
        'type'        => 'select',
        'desc'        => 'Choose an icon to show in the third step',
        'choices'     => $icons,
        'std'         => 'icon-food',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Title',
        'id'          => '3_step_title',
        'type'        => 'text',
        'desc'        => 'Write the 3° step title',
        'std'         => 'Entertainment',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'Text',
        'id'          => '3_step_text',
        'type'        => 'text',
        'desc'        => 'Write the 3° step payoff',
        'std'         => 'Relax and enjoy our fantastic music',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),
      array(
        'label'       => 'URL',
        'id'          => '3_step_url',
        'type'        => 'text',
        'desc'        => 'The url to link',
        'std'         => '/credits',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'steps'
      ),



	  array(
		  'label'       => 'Blog header',
		  'id'          => 'blog_header_image',
		  'type'        => 'upload',
		  'desc'        => 'It will shown in the blog archive header',
		  'std'         => get_template_directory_uri() . '/img/panorama.jpg',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'blog'
	  ),
	  array(
		  'label'       => 'Author Box',
		  'id'          => 'author_box',
		  'type'        => 'radio',
		  'desc'        => 'Do you want the author box below the posts?',
		  'std'         => '1',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'blog',
		  'choices'     => array(
			  array( 'label' => 'Yes', 'value' => '1' ),
			  array( 'label' => 'No', 'value' => '0' ) )
		  ),
	  array(
		  'label'       => 'Event Organizer Box',
		  'id'          => 'author_event_box',
		  'type'        => 'radio',
		  'desc'        => 'Do you want the event organizer box below the event description?',
		  'std'         => '1',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'events',
		  'choices'     => array(
			  array( 'label' => 'Yes', 'value' => '1' ),
			  array( 'label' => 'No', 'value' => '0' ) )
		  ),


	  array(
		  'label'       => 'Facebook Fan Page',
		  'id'          => 'facebook_url',
		  'type'        => 'text',
		  'desc'        => 'The URL of your Facebook fan page',
		  'std'         => 'http://www.facebook.com/dynamick.it',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'social'
	  ),
	  array(
		  'label'       => 'Twitter Page',
		  'id'          => 'twitter_url',
		  'type'        => 'text',
		  'desc'        => 'The url of your Twitter page.',
		  'std'         => 'https://twitter.com/dynamick',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'social'
	  ),
	  array(
		  'label'       => 'Feed URL',
		  'id'          => 'feed_url',
		  'type'        => 'text',
		  'desc'        => 'Leave blank for the default wordpress url',
		  'std'         => '/feed',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'social'
	  ),
	  array(
		  'label'       => 'Mailchimp signup form link url',
		  'id'          => 'mailchimp_link_url',
		  'type'        => 'text',
		  'desc'        => 'The url of your mailchimp signup form. You could specify any other newsletter signup url.',
		  'std'         => 'http://eepurl.com/sgukr',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'social'
	  ),
	  array(
		  'label'       => 'Google Analytics Account ID',
		  'id'          => 'analytics_uid',
		  'type'        => 'text',
		  'desc'        => 'Paste here your UA-XXXXXXXX-X code',
		  'std'         => 'UA-795127-3',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'social'
	  ),
	  array(
		  'label'       => 'Facebook App ID',
		  'id'          => 'facebook_app_id',
		  'type'        => 'text',
		  'desc'        => 'Paste here your Facebook app id, if any.',
		  'std'         => '235354229916474',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'class'       => '',
		  'section'     => 'social'
	  ),








      array(
        'label'       => 'Category Checkbox',
        'id'          => 'my_category_checkbox',
        'type'        => 'category-checkbox',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Category Select',
        'id'          => 'my_category_select',
        'type'        => 'category-select',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Checkbox',
        'id'          => 'my_checkbox',
        'type'        => 'checkbox',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'choices'     => array(
          array (
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Colorpicker',
        'id'          => 'my_colorpicker',
        'type'        => 'colorpicker',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'CSS',
        'id'          => 'my_css',
        'type'        => 'css',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Custom Post Type Checkbox',
        'id'          => 'my_custom_post_type_checkbox',
        'type'        => 'custom-post-type-checkbox',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => 'post',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Custom Post Type Select',
        'id'          => 'my_custom_post_type_select',
        'type'        => 'custom-post-type-select',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => 'post',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'List Item',
        'id'          => 'my_list_item',
        'type'        => 'list-item',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'settings'    => array(
          array(
            'label'       => 'Upload',
            'id'          => 'my_list_item_upload',
            'type'        => 'upload',
            'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'label'       => 'Text',
            'id'          => 'my_list_item_text',
            'type'        => 'text',
            'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'label'       => 'Textarea Simple',
            'id'          => 'my_list_item_textarea_simple',
            'type'        => 'textarea-simple',
            'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'std'         => '',
            'rows'        => '10',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Measurement',
        'id'          => 'my_measurement',
        'type'        => 'measurement',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Page Checkbox',
        'id'          => 'my_page_checkbox',
        'type'        => 'page-checkbox',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Page Select',
        'id'          => 'my_page_select',
        'type'        => 'page-select',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Post Checkbox',
        'id'          => 'my_post_checkbox',
        'type'        => 'post-checkbox',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Post Select',
        'id'          => 'my_post_select',
        'type'        => 'post-select',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Radio',
        'id'          => 'my_radio',
        'type'        => 'radio',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          ),
          array(
            'label'       => 'No',
            'value'       => 'no'
          ),
          array(
            'label'       => 'Maybe',
            'value'       => 'maybe'
          )
        ),
        'std'         => 'yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Radio Image',
        'id'          => 'my_radio_image',
        'type'        => 'radio-image',
        'desc'        => 'xLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => 'right-sidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Select',
        'id'          => 'my_select',
        'type'        => 'select',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'choices'     => array(
          array('label'=> 'Yes', 'value' => 'yes'),
          array(
            'label'       => 'No',
            'value'       => 'no'
          ),
          array(
            'label'       => 'Maybe',
            'value'       => 'maybe'
          )
        ),
        'std'         => 'maybe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Slider',
        'id'          => 'my_slider',
        'type'        => 'slider',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Tag Checkbox',
        'id'          => 'my_tag_checkbox',
        'type'        => 'tag-checkbox',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Tag Select',
        'id'          => 'my_tag_select',
        'type'        => 'tag-select',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Taxonomy Checkbox',
        'id'          => 'my_taxonomy_checkbox',
        'type'        => 'taxonomy-checkbox',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => 'category,post_tag',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Taxonomy Select',
        'id'          => 'my_taxonomy_select',
        'type'        => 'taxonomy-select',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => 'category,post_tag',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Text',
        'id'          => 'my_text',
        'type'        => 'text',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Textarea',
        'id'          => 'my_textarea',
        'type'        => 'textarea',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '15',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Textarea Simple',
        'id'          => 'my_textarea_simple',
        'type'        => 'textarea-simple',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Textblock',
        'id'          => 'my_textblock',
        'type'        => 'textblock',
        'desc'        => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Textblock Titled',
        'id'          => 'my_textblock_titled',
        'type'        => 'textblock-titled',
        'desc'        => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Typography',
        'id'          => 'my_typography',
        'type'        => 'typography',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
      array(
        'label'       => 'Upload',
        'id'          => 'my_upload',
        'type'        => 'upload',
        'desc'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      )
    )
  );

  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings );
  }

}
