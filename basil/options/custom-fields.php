<?php

/**
 * Register Meta Boxes for Resume CPT
 */
add_action('carbon_register_fields', 'basil_register_page_meta_boxes');
function basil_register_page_meta_boxes() {

	// Font Awesome Icon Array
	$fa_array = array( false => 'None', 'fa-adjust' => 'adjust', 'fa-anchor' => 'anchor', 'fa-archive' => 'archive', 'fa-arrows' => 'arrows', 'fa-arrows-h' => 'arrows-h', 'fa-arrows-v' => 'arrows-v', 'fa-asterisk' => 'asterisk', 'fa-ban' => 'ban', 'fa-bar-chart-o' => 'bar-chart-o', 'fa-barcode' => 'barcode', 'fa-bars' => 'bars', 'fa-beer' => 'beer', 'fa-bell' => 'bell', 'fa-bell-o' => 'bell-o', 'fa-bolt' => 'bolt', 'fa-book' => 'book', 'fa-bookmark' => 'bookmark', 'fa-bookmark-o' => 'bookmark-o', 'fa-briefcase' => 'briefcase', 'fa-bug' => 'bug', 'fa-building-o' => 'building-o', 'fa-bullhorn' => 'bullhorn', 'fa-bullseye' => 'bullseye', 'fa-calendar' => 'calendar', 'fa-calendar-o' => 'calendar-o', 'fa-camera' => 'camera', 'fa-camera-retro' => 'camera-retro', 'fa-caret-square-o-down' => 'caret-square-o-down', 'fa-caret-square-o-left' => 'caret-square-o-left', 'fa-caret-square-o-right' => 'caret-square-o-right', 'fa-caret-square-o-up' => 'caret-square-o-up', 'fa-certificate' => 'certificate', 'fa-check' => 'check', 'fa-check-circle' => 'check-circle', 'fa-check-circle-o' => 'check-circle-o', 'fa-check-square' => 'check-square', 'fa-check-square-o' => 'check-square-o', 'fa-circle' => 'circle', 'fa-circle-o' => 'circle-o', 'fa-clock-o' => 'clock-o', 'fa-cloud' => 'cloud', 'fa-cloud-download' => 'cloud-download', 'fa-cloud-upload' => 'cloud-upload', 'fa-code' => 'code', 'fa-code-fork' => 'code-fork', 'fa-coffee' => 'coffee', 'fa-cog' => 'cog', 'fa-cogs' => 'cogs', 'fa-comment' => 'comment', 'fa-comment-o' => 'comment-o', 'fa-comments' => 'comments', 'fa-comments-o' => 'comments-o', 'fa-compass' => 'compass', 'fa-credit-card' => 'credit-card', 'fa-crop' => 'crop', 'fa-crosshairs' => 'crosshairs', 'fa-cutlery' => 'cutlery', 'fa-dashboard' => 'dashboard', 'fa-desktop' => 'desktop', 'fa-dot-circle-o' => 'dot-circle-o', 'fa-download' => 'download', 'fa-edit' => 'edit', 'fa-ellipsis-h' => 'ellipsis-h', 'fa-ellipsis-v' => 'ellipsis-v', 'fa-envelope' => 'envelope', 'fa-envelope-o' => 'envelope-o', 'fa-eraser' => 'eraser', 'fa-exchange' => 'exchange', 'fa-exclamation' => 'exclamation', 'fa-exclamation-circle' => 'exclamation-circle', 'fa-exclamation-triangle' => 'exclamation-triangle', 'fa-external-link' => 'external-link', 'fa-external-link-square' => 'external-link-square', 'fa-eye' => 'eye', 'fa-eye-slash' => 'eye-slash', 'fa-female' => 'female', 'fa-fighter-jet' => 'fighter-jet', 'fa-film' => 'film', 'fa-filter' => 'filter', 'fa-fire' => 'fire', 'fa-fire-extinguisher' => 'fire-extinguisher', 'fa-flag' => 'flag', 'fa-flag-checkered' => 'flag-checkered', 'fa-flag-o' => 'flag-o', 'fa-flash' => 'flash', 'fa-flask' => 'flask', 'fa-folder' => 'folder', 'fa-folder-o' => 'folder-o', 'fa-folder-open' => 'folder-open', 'fa-folder-open-o' => 'folder-open-o', 'fa-frown-o' => 'frown-o', 'fa-gamepad' => 'gamepad', 'fa-gavel' => 'gavel', 'fa-gear' => 'gear', 'fa-gears' => 'gears', 'fa-gift' => 'gift', 'fa-glass' => 'glass', 'fa-globe' => 'globe', 'fa-group' => 'group', 'fa-hdd-o' => 'hdd-o', 'fa-headphones' => 'headphones', 'fa-heart' => 'heart', 'fa-heart-o' => 'heart-o', 'fa-home' => 'home', 'fa-inbox' => 'inbox', 'fa-info' => 'info', 'fa-info-circle' => 'info-circle', 'fa-key' => 'key', 'fa-keyboard-o' => 'keyboard-o', 'fa-laptop' => 'laptop', 'fa-leaf' => 'leaf', 'fa-legal' => 'legal', 'fa-lemon-o' => 'lemon-o', 'fa-level-down' => 'level-down', 'fa-level-up' => 'level-up', 'fa-lightbulb-o' => 'lightbulb-o', 'fa-location-arrow' => 'location-arrow', 'fa-lock' => 'lock', 'fa-magic' => 'magic', 'fa-magnet' => 'magnet', 'fa-mail-forward' => 'mail-forward', 'fa-mail-reply' => 'mail-reply', 'fa-mail-reply-all' => 'mail-reply-all', 'fa-male' => 'male', 'fa-map-marker' => 'map-marker', 'fa-meh-o' => 'meh-o', 'fa-microphone' => 'microphone', 'fa-microphone-slash' => 'microphone-slash', 'fa-minus' => 'minus', 'fa-minus-circle' => 'minus-circle', 'fa-minus-square' => 'minus-square', 'fa-minus-square-o' => 'minus-square-o', 'fa-mobile' => 'mobile', 'fa-mobile-phone' => 'mobile-phone', 'fa-money' => 'money', 'fa-moon-o' => 'moon-o', 'fa-music' => 'music', 'fa-pencil' => 'pencil', 'fa-pencil-square' => 'pencil-square', 'fa-pencil-square-o' => 'pencil-square-o', 'fa-phone' => 'phone', 'fa-phone-square' => 'phone-square', 'fa-picture-o' => 'picture-o', 'fa-plane' => 'plane', 'fa-plus' => 'plus', 'fa-plus-circle' => 'plus-circle', 'fa-plus-square' => 'plus-square', 'fa-plus-square-o' => 'plus-square-o', 'fa-power-off' => 'power-off', 'fa-print' => 'print', 'fa-puzzle-piece' => 'puzzle-piece', 'fa-qrcode' => 'qrcode', 'fa-question' => 'question', 'fa-question-circle' => 'question-circle', 'fa-quote-left' => 'quote-left', 'fa-quote-right' => 'quote-right', 'fa-random' => 'random', 'fa-refresh' => 'refresh', 'fa-reply' => 'reply', 'fa-reply-all' => 'reply-all', 'fa-retweet' => 'retweet', 'fa-road' => 'road', 'fa-rocket' => 'rocket', 'fa-rss' => 'rss', 'fa-rss-square' => 'rss-square', 'fa-search' => 'search', 'fa-search-minus' => 'search-minus', 'fa-search-plus' => 'search-plus', 'fa-share' => 'share', 'fa-share-square' => 'share-square', 'fa-share-square-o' => 'share-square-o', 'fa-shield' => 'shield', 'fa-shopping-cart' => 'shopping-cart', 'fa-sign-in' => 'sign-in', 'fa-sign-out' => 'sign-out', 'fa-signal' => 'signal', 'fa-sitemap' => 'sitemap', 'fa-smile-o' => 'smile-o', 'fa-sort' => 'sort', 'fa-sort-alpha-asc' => 'sort-alpha-asc', 'fa-sort-alpha-desc' => 'sort-alpha-desc', 'fa-sort-amount-asc' => 'sort-amount-asc', 'fa-sort-amount-desc' => 'sort-amount-desc', 'fa-sort-asc' => 'sort-asc', 'fa-sort-desc' => 'sort-desc', 'fa-sort-down' => 'sort-down', 'fa-sort-numeric-asc' => 'sort-numeric-asc', 'fa-sort-numeric-desc' => 'sort-numeric-desc', 'fa-sort-up' => 'sort-up', 'fa-spinner' => 'spinner', 'fa-square' => 'square', 'fa-square-o' => 'square-o', 'fa-star' => 'star', 'fa-star-half' => 'star-half', 'fa-star-half-empty' => 'star-half-empty', 'fa-star-half-full' => 'star-half-full', 'fa-star-half-o' => 'star-half-o', 'fa-star-o' => 'star-o', 'fa-subscript' => 'subscript', 'fa-suitcase' => 'suitcase', 'fa-sun-o' => 'sun-o', 'fa-superscript' => 'superscript', 'fa-tablet' => 'tablet', 'fa-tachometer' => 'tachometer', 'fa-tag' => 'tag', 'fa-tags' => 'tags', 'fa-tasks' => 'tasks', 'fa-terminal' => 'terminal', 'fa-thumb-tack' => 'thumb-tack', 'fa-thumbs-down' => 'thumbs-down', 'fa-thumbs-o-down' => 'thumbs-o-down', 'fa-thumbs-o-up' => 'thumbs-o-up', 'fa-thumbs-up' => 'thumbs-up', 'fa-ticket' => 'ticket', 'fa-times' => 'times', 'fa-times-circle' => 'times-circle', 'fa-times-circle-o' => 'times-circle-o', 'fa-tint' => 'tint', 'fa-toggle-down' => 'toggle-down', 'fa-toggle-left' => 'toggle-left', 'fa-toggle-right' => 'toggle-right', 'fa-toggle-up' => 'toggle-up', 'fa-trash-o' => 'trash-o', 'fa-trophy' => 'trophy', 'fa-truck' => 'truck', 'fa-umbrella' => 'umbrella', 'fa-unlock' => 'unlock', 'fa-unlock-alt' => 'unlock-alt', 'fa-unsorted' => 'unsorted', 'fa-upload' => 'upload', 'fa-user' => 'user', 'fa-users' => 'users', 'fa-video-camera' => 'video-camera', 'fa-volume-down' => 'volume-down', 'fa-volume-off' => 'volume-off', 'fa-volume-up' => 'volume-up', 'fa-warning' => 'warning', 'fa-wheelchair' => 'wheelchair', 'fa-wrench' => 'wrench', 'fa-adn' => 'adn', 'fa-android' => 'android', 'fa-apple' => 'apple', 'fa-bitbucket' => 'bitbucket', 'fa-bitbucket-square' => 'bitbucket-square', 'fa-bitcoin' => 'bitcoin', 'fa-btc' => 'btc', 'fa-css3' => 'css3', 'fa-dribbble' => 'dribbble', 'fa-dropbox' => 'dropbox', 'fa-facebook' => 'facebook', 'fa-facebook-square' => 'facebook-square', 'fa-flickr' => 'flickr', 'fa-foursquare' => 'foursquare', 'fa-github' => 'github', 'fa-github-alt' => 'github-alt', 'fa-github-square' => 'github-square', 'fa-gittip' => 'gittip', 'fa-google-plus' => 'google-plus', 'fa-google-plus-square' => 'google-plus-square', 'fa-html5' => 'html5', 'fa-instagram' => 'instagram', 'fa-linkedin' => 'linkedin', 'fa-linkedin-square' => 'linkedin-square', 'fa-linux' => 'linux', 'fa-maxcdn' => 'maxcdn', 'fa-pagelines' => 'pagelines', 'fa-pinterest' => 'pinterest', 'fa-pinterest-square' => 'pinterest-square', 'fa-renren' => 'renren', 'fa-skype' => 'skype', 'fa-stack-exchange' => 'stack-exchange', 'fa-stack-overflow' => 'stack-overflow', 'fa-trello' => 'trello', 'fa-tumblr' => 'tumblr', 'fa-tumblr-square' => 'tumblr-square', 'fa-twitter' => 'twitter', 'fa-twitter-square' => 'twitter-square', 'fa-vimeo-square' => 'vimeo-square', 'fa-vk' => 'vk', 'fa-weibo' => 'weibo', 'fa-windows' => 'windows', 'fa-xing' => 'xing', 'fa-xing-square' => 'xing-square', 'fa-youtube' => 'youtube', 'fa-youtube-play' => 'youtube-play', 'fa-youtube-square' => 'youtube-square', 'fa-align-center' => 'align-center', 'fa-align-justify' => 'align-justify', 'fa-align-left' => 'align-left', 'fa-align-right' => 'align-right', 'fa-bold' => 'bold', 'fa-chain' => 'chain', 'fa-chain-broken' => 'chain-broken', 'fa-clipboard' => 'clipboard', 'fa-columns' => 'columns', 'fa-copy' => 'copy', 'fa-cut' => 'cut', 'fa-dedent' => 'dedent', 'fa-eraser' => 'eraser', 'fa-file' => 'file', 'fa-file-o' => 'file-o', 'fa-file-text' => 'file-text', 'fa-file-text-o' => 'file-text-o', 'fa-files-o' => 'files-o', 'fa-floppy-o' => 'floppy-o', 'fa-font' => 'font', 'fa-indent' => 'indent', 'fa-italic' => 'italic', 'fa-link' => 'link', 'fa-list' => 'list', 'fa-list-alt' => 'list-alt', 'fa-list-ol' => 'list-ol', 'fa-list-ul' => 'list-ul', 'fa-outdent' => 'outdent', 'fa-paperclip' => 'paperclip', 'fa-paste' => 'paste', 'fa-repeat' => 'repeat', 'fa-rotate-left' => 'rotate-left', 'fa-rotate-right' => 'rotate-right', 'fa-save' => 'save', 'fa-scissors' => 'scissors', 'fa-strikethrough' => 'strikethrough', 'fa-table' => 'table', 'fa-text-height' => 'text-height', 'fa-text-width' => 'text-width', 'fa-th' => 'th', 'fa-th-large' => 'th-large', 'fa-th-list' => 'th-list', 'fa-underline' => 'underline', 'fa-undo' => 'undo', 'fa-unlink' => 'unlink' );
	asort($fa_array);
	
	// Animations
	$animations = array ( false => 'None', 'bounceIn' => 'bounceIn', 'bounceInDown' => 'bounceInDown', 'bounceInLeft' => 'bounceInLeft', 'bounceInRight' => 'bounceInRight', 'bounceInUp' => 'bounceInUp', 'fadeIn' => 'fadeIn', 'fadeInDown' => 'fadeInDown', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeft' => 'fadeInLeft', 'fadeInLeftBig' => 'fadeInLeftBig', 'fadeInRight' => 'fadeInRight', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUp' => 'fadeInUp', 'fadeInUpBig' => 'fadeInUpBig', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY', 'lightSpeedIn' => 'lightSpeedIn', 'rotateIn' => 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight', 'rotateInUpLeft' => 'rotateInUpLeft', 'rotateInUpRight' => 'rotateInUpRight', 'rollIn' => 'rollIn', 'zoomIn' => 'zoomIn', 'zoomInDown' => 'zoomInDown', 'zoomInLeft' => 'zoomInLeft', 'zoomInRight' => 'zoomInRight', 'zoomInUp' => 'zoomInUp' );
	
	// Available Background Colors
	$bg_colors = array ( false => 'White', 'basilGray' => 'Light Gray', 'basilDarkGray' => 'Dark Gray' );

	// Post Categories
	$args = array('hide_empty' => 0);
	$post_cat_array = array();
	$post_categories = get_categories($args);
	foreach($post_categories as $cat):
		$post_cat_array[$cat->term_id] = $cat->name . ' ('.$cat->count.')';
	endforeach;
	
	$recipe_array = array();
	
	// WooCommerce Products
	$woo_array = array();
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
		$woo_args = array( 'post_type' => 'product', 'posts_per_page' => -1 );
		$woo_products = get_posts($woo_args);
		
		$woo_array[false] = __('Choose a product ...','basil');
		foreach($woo_products as $product):
	    	$woo_array[$product->ID] = $product->post_title;
	    endforeach;
	    asort($woo_array);
	endif;
	
	// Recipes
	$recipe_array = array();
	if (class_exists('cooked_plugin')):
		$args = array(
			'post_type' => 'cp_recipe',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => '_cp_private_recipe',
					'compare' => 'NOT EXISTS'
				)
			)
		);
		$recipes = get_posts($args);
		$recipe_array[false] = __('Choose a recipe ...','basil');
		foreach($recipes as $recipe):
			$recipe_array[$recipe->ID] = $recipe->post_title;
		endforeach;
	endif;
	
	$boxy_page_builder_default = Carbon_Container::factory('custom_fields', __('Boxy Page Builder','basil'))->show_on_post_type('page');
	$boxy_page_builder_default->add_fields(array(Carbon_Field::factory('separator', 'basil_page_sections_title', __('Page Sections', 'basil'))));
	
	$boxy_complex_section_default = Carbon_Field::factory('complex', 'basil_page_sections', '')
		->setup_labels(array(
			'singular_name' => __('Page Section', 'basil'),
			'plural_name'   => __('Page Sections', 'basil'),
		));
		
	// Recipe Slider Section
	$boxy_complex_section_default->add_fields('recipe_slider', array(
		
		# Section Enabled
		Carbon_Field::factory('select', 'disabled', __('Recipe Slider', 'basil'))
			->add_options( array( false => 'Enabled', true => 'Disabled' )),
	
		# Section Content
		Carbon_Field::factory('complex', 'recipe_slider', __('Recipes', 'basil'))
			->setup_labels(array(
				'singular_name' => __('Recipe', 'basil'),
				'plural_name'   => __('Recipes', 'basil'),
			))
			->add_fields('recipe_block', array(
				# Recipe
				Carbon_Field::factory('select', 'recipe', __('Choose a Recipe', 'basil'))
					->add_options( $recipe_array ),
			)),
			
		# Section Animation
		Carbon_Field::factory('select', 'section_animation', __('Section Animation','basil'))
			->add_options( $animations ),
			
	));
	
	// Featured Recipes
	$boxy_complex_section_default->add_fields('featured_recipes', array(
		
		# Section Enabled
		Carbon_Field::factory('select', 'disabled', __('Featured Recipes', 'basil'))
			->add_options( array( false => 'Enabled', true => 'Disabled' )),
	
		# Section Title
		Carbon_Field::factory('text', 'featured_title', __('Section Title', 'basil')),
		
		# Button Text
		Carbon_Field::factory('text', 'button_text', __('Button Text', 'basil')),
		
		# Button Link
		Carbon_Field::factory('text', 'button_url', __('Button URL', 'basil')),
		
		# Button Icon
		Carbon_Field::factory('select', 'button_icon', __('Button Icon', 'basil'))
			->add_options( $fa_array ),
	
		# Section Content
		Carbon_Field::factory('complex', 'featured_recipes', __('Recipes', 'basil'))
			->setup_labels(array(
				'singular_name' => __('Recipe', 'basil'),
				'plural_name'   => __('Recipes', 'basil'),
			))
			->add_fields('recipe_block', array(
				# Recipe
				Carbon_Field::factory('select', 'recipe', __('Choose a Recipe', 'basil'))
					->add_options( $recipe_array ),
			)),
			
		# Background Color
		Carbon_Field::factory('select', 'bg_color', __('Background Color','basil'))
			->add_options( $bg_colors ),
			
		# Section Animation
		Carbon_Field::factory('select', 'section_animation', __('Section Animation','basil'))
			->add_options( $animations ),
			
	));
	
	// Featured Products
	$boxy_complex_section_default->add_fields('featured_products', array(
				
		# Section Enabled
		Carbon_Field::factory('select', 'disabled', __('Featured Products', 'basil'))
			->add_options( array( false => 'Enabled', true => 'Disabled' )),
	
		# Section Title
		Carbon_Field::factory('text', 'featured_title', __('Section Title', 'basil')),
		
		# Button Text
		Carbon_Field::factory('text', 'button_text', __('Button Text', 'basil')),
		
		# Button Link
		Carbon_Field::factory('text', 'button_url', __('Button URL', 'basil')),
		
		# Button Icon
		Carbon_Field::factory('select', 'button_icon', __('Button Icon', 'basil'))
			->add_options( $fa_array ),
	
		# Section Content
		Carbon_Field::factory('complex', 'featured_products', __('Products', 'basil'))
			->setup_labels(array(
				'singular_name' => __('Product', 'basil'),
				'plural_name'   => __('Products', 'basil'),
			))
			->add_fields('woo_block', array(
				# Recipe
				Carbon_Field::factory('select', 'product', __('Choose a Product', 'basil'))
					->add_options( $woo_array ),
			)),
			
		# Background Color
		Carbon_Field::factory('select', 'bg_color', __('Background Color','basil'))
			->add_options( $bg_colors ),
			
		# Section Animation
		Carbon_Field::factory('select', 'section_animation', __('Section Animation','basil'))
			->add_options( $animations ),
	
	));
	
	// Page Content
	$boxy_complex_section_default->add_fields('page_content', array(
				
		# Section Enabled
		Carbon_Field::factory('select', 'disabled', __('Page Content', 'basil'))
			->add_options( array( false => 'Enabled', true => 'Disabled' )),
	
		# Page Layout
		Carbon_Field::factory('select', 'page_content_position', __('Page Content', 'basil'))
			->add_options( array ( 'full' => 'Full Width', 'right' => 'Left Sidebar', 'left' => 'Right Sidebar' ) ),
			
		# Page Title
		Carbon_Field::factory('radio', 'page_hide_title', __('Hide Page Title?', 'basil'))
			->add_options( array ( true => 'Yes', false => 'No' ) ),
			
		# Sidebar Select
		Carbon_Field::factory('sidebar', 'page_sidebar', __('Choose Sidebar for Page', 'basil'))->disable_add_new(),
			
		# Background Color
		Carbon_Field::factory('select', 'bg_color', __('Background Color','basil'))
			->add_options( $bg_colors ),	
			
		# Section Animation
		Carbon_Field::factory('select', 'section_animation', __('Section Animation','basil'))
			->add_options( $animations ),
			
	));
	
	// Parallax Block
	$boxy_complex_section_default->add_fields('parallax_block', array(
				
		# Parallax Section Enabled
		Carbon_Field::factory('select', 'disabled', __('Parallax Block', 'basil'))
			->add_options( array( false => 'Enabled', true => 'Disabled' )),
	
		# Parallax Text
		Carbon_Field::factory('textarea', 'parallax_text', __('Text', 'basil')),
			
		# Parallax Text Size
		Carbon_Field::factory('select', 'parallax_font_size', __('Text Size', 'basil'))
			->add_options( array (
				'10' => 'Tiny (10px)',
				'15' => 'Small (15px)',
				'20' => 'Normal (20px)',
				'30' => 'Medium (30px)',
				'40' => 'Large (40px)',
				'50' => 'Larger (50px)',
				'60' => 'Big (60px)',
				'70' => 'Bigger (70px)',
				'80' => 'Huge (80px)',
				'100' => 'Giant (100px)') ),
				
		# Parallax Image
		Carbon_Field::factory('image', 'parallax_image', __('Parallax Image', 'basil'))
			->set_help_text(__('Large for best results (ie. 2000px x 1000px)','basil')),
		
		# Parallax Text Color
		Carbon_Field::factory('color', 'parallax_text_color', __('Text Color', 'basil'))
			->set_help_text(__('You can change the color of the text here','basil')),
			
		# Parallax Screen Color
		Carbon_Field::factory('color', 'parallax_color', __('Screened Color', 'basil'))
			->set_help_text(__('This optional color screen will be overlayed on top of the image.','basil')),
			
		# Parallax Screen Color
		Carbon_Field::factory('select', 'parallax_color_opacity', __('Screened Color Opacity', 'basil'))
			->add_options(array(
				'0' => 'No color screen',
				'0.1' => '10%',
				'0.2' => '20%',
				'0.3' => '30%',
				'0.4' => '40%',
				'0.5' => '50%',
				'0.6' => '60%',
				'0.7' => '70%',
				'0.8' => '80%',
				'0.9' => '90%',
				'1' => '100%'))
			->set_help_text(__('This optional color screen will be overlayed on top of the image.','basil')),
			
	));
	
	// Widget Columns
	$boxy_complex_section_default->add_fields('widget_columns', array(
				
		# Section Enabled
		Carbon_Field::factory('select', 'disabled', __('Widget Columns', 'basil'))
			->add_options( array( false => 'Enabled', true => 'Disabled' )),
		
		# Section Content
		Carbon_Field::factory('complex', 'widget_block_columns', __('Widget Columns', 'basil'))
			->setup_labels(array(
				'singular_name' => __('Column', 'basil'),
				'plural_name'   => __('Columns', 'basil'),
			))
			->add_fields('widget_column', array(
				# Recipe
				Carbon_Field::factory('sidebar', 'sidebar', __('Choose Sidebar', 'basil'))->disable_add_new(),
					
				# Section Animation
				Carbon_Field::factory('select', 'section_animation', __('Animation','basil'))
					->add_options( $animations ),
				))->set_max(4),
				
		# Background Color
		Carbon_Field::factory('select', 'bg_color', __('Background Color','basil'))
			->add_options( $bg_colors ),
	
			
	));
	
	// Recent Tweets
	$boxy_complex_section_default->add_fields('recent_tweets', array(
		
		# Section Enabled
		Carbon_Field::factory('select', 'disabled', __('Recent Tweets', 'basil'))
			->add_options( array( false => 'Enabled', true => 'Disabled' )),
			
		# Section Title
		Carbon_Field::factory('text', 'title', __('Section Title', 'basil')),
		
		# Section Twitter Username
		Carbon_Field::factory('text', 'twitter_user', __('Twitter Username', 'basil')),
		
		# Page Title
		Carbon_Field::factory('select', 'load', __('Tweets to Load', 'basil'))
			->add_options( array ( 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 15 => '15', 20 => '20' ) ),
		
		# Section Animation
		Carbon_Field::factory('select', 'section_animation', __('Animation','basil'))
			->add_options( $animations ),
		
	));
	
	// Recent Posts
	$boxy_complex_section_default->add_fields('recent_posts', array(
		
		# Section Enabled
		Carbon_Field::factory('select', 'disabled', __('Recent Posts', 'basil'))
			->add_options( array( false => 'Enabled', true => 'Disabled' )),
			
		# Post Category
		Carbon_Field::factory('select', 'post_category', __('Post Category', 'basil'))
			->add_options( $post_cat_array ),
			
		# Section Enabled
		Carbon_Field::factory('select', 'post_count', __('Posts to Load', 'basil'))
			->add_options( array( 3 => '3 (one row)', 6 => '6 (two rows)', 9 => '9 (three rows)', 12 => '12 (four rows)' )),
			
		# Section Title
		Carbon_Field::factory('text', 'title', __('Section Title', 'basil')),
		
		# Button Text
		Carbon_Field::factory('text', 'button_text', __('Button Text', 'basil')),
		
		# Button Link
		Carbon_Field::factory('text', 'button_url', __('Button URL', 'basil')),
		
		# Button Icon
		Carbon_Field::factory('select', 'button_icon', __('Button Icon', 'basil'))
			->add_options( $fa_array ),
							
		# Background Color
		Carbon_Field::factory('select', 'bg_color', __('Background Color','basil'))
			->add_options( $bg_colors ),
							
		# Section Animation
		Carbon_Field::factory('select', 'section_animation', __('Animation','basil'))
			->add_options( $animations ),
		
	));
	
	$boxy_page_builder_default->add_fields(array($boxy_complex_section_default));
	
	// Boxy Post Options
	$boxy_post_builder_default = Carbon_Container::factory('custom_fields', __('Post Template Options','basil'))->show_on_post_type('post');
	
	$boxy_post_title = Carbon_Field::factory('radio', 'post_hide_title', __('Hide Post Title?', 'basil'))
			->add_options( array ( true => __('Yes','basil'), false => __('No','basil') ) )
			->set_default_value(false);
			
	$boxy_post_image = Carbon_Field::factory('radio', 'post_hide_featured_image', __('Hide Featured Image?', 'basil'))
			->add_options( array ( true => __('Yes','basil'), false => __('No','basil') ) )
			->set_default_value(false);
			
	$boxy_post_type = Carbon_Field::factory('select', 'post_content_position', __('Post Layout', 'basil'))
			->add_options( array ( 'left' => __('Right Sidebar','basil'), 'right' => __('Left Sidebar','basil'), 'full' => __('Full Width','basil') ) );
			
	$boxy_post_sidebar = Carbon_Field::factory('sidebar', 'post_sidebar', __('Choose Sidebar for Post', 'basil'))
			->disable_add_new();
			
	$boxy_post_builder_default->add_fields(array($boxy_post_title,$boxy_post_image,$boxy_post_type,$boxy_post_sidebar));
	
}