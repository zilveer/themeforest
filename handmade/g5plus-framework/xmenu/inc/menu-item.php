<?php
add_action( 'admin_footer-nav-menus.php' , 'xmenu_menu_item_config_panel_render');
function xmenu_menu_item_config_panel_render() {
	global $xmenu_item_settings;
	$icons = array('glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'remove', 'close', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'gear', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'rotate-right', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'dedent', 'outdent', 'indent', 'video-camera', 'photo', 'image', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'edit', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'mail-forward', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'warning', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'gears', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook-f', 'facebook', 'github', 'unlock', 'credit-card', 'feed', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'group', 'users', 'chain', 'link', 'cloud', 'flask', 'cut', 'scissors', 'copy', 'files-o', 'paperclip', 'save', 'floppy-o', 'square', 'navicon', 'reorder', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'unsorted', 'sort', 'sort-down', 'sort-desc', 'sort-up', 'sort-asc', 'envelope', 'linkedin', 'rotate-left', 'undo', 'legal', 'gavel', 'dashboard', 'tachometer', 'comment-o', 'comments-o', 'flash', 'bolt', 'sitemap', 'umbrella', 'paste', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile-phone', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'mail-reply', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'mail-reply-all', 'reply-all', 'star-half-empty', 'star-half-full', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'unlink', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'toggle-down', 'caret-square-o-down', 'toggle-up', 'caret-square-o-up', 'toggle-right', 'caret-square-o-right', 'euro', 'eur', 'gbp', 'dollar', 'usd', 'rupee', 'inr', 'cny', 'rmb', 'yen', 'jpy', 'ruble', 'rouble', 'rub', 'won', 'krw', 'bitcoin', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'gratipay', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'toggle-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'turkish-lira', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'institution', 'bank', 'university', 'mortar-board', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper-pp', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'automobile', 'car', 'cab', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-photo-o', 'file-picture-o', 'file-image-o', 'file-zip-o', 'file-archive-o', 'file-sound-o', 'file-audio-o', 'file-movie-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-bouy', 'life-buoy', 'life-saver', 'support', 'life-ring', 'circle-o-notch', 'ra', 'resistance', 'rebel', 'ge', 'empire', 'git-square', 'git', 'y-combinator-square', 'yc-square', 'hacker-news', 'tencent-weibo', 'qq', 'wechat', 'weixin', 'send', 'paper-plane', 'send-o', 'paper-plane-o', 'history', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'soccer-ball-o', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'shekel', 'sheqel', 'ils', 'meanpath', 'buysellads', 'connectdevelop', 'dashcube', 'forumbee', 'leanpub', 'sellsy', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'cart-plus', 'cart-arrow-down', 'diamond', 'ship', 'user-secret', 'motorcycle', 'street-view', 'heartbeat', 'venus', 'mars', 'mercury', 'intersex', 'transgender', 'transgender-alt', 'venus-double', 'mars-double', 'venus-mars', 'mars-stroke', 'mars-stroke-v', 'mars-stroke-h', 'neuter', 'genderless', 'facebook-official', 'pinterest-p', 'whatsapp', 'server', 'user-plus', 'user-times', 'hotel', 'bed', 'viacoin', 'train', 'subway', 'medium', 'yc', 'y-combinator', 'optin-monster', 'opencart', 'expeditedssl', 'battery-4', 'battery-full', 'battery-3', 'battery-three-quarters', 'battery-2', 'battery-half', 'battery-1', 'battery-quarter', 'battery-0', 'battery-empty', 'mouse-pointer', 'i-cursor', 'object-group', 'object-ungroup', 'sticky-note', 'sticky-note-o', 'cc-jcb', 'cc-diners-club', 'clone', 'balance-scale', 'hourglass-o', 'hourglass-1', 'hourglass-start', 'hourglass-2', 'hourglass-half', 'hourglass-3', 'hourglass-end', 'hourglass', 'hand-grab-o', 'hand-rock-o', 'hand-stop-o', 'hand-paper-o', 'hand-scissors-o', 'hand-lizard-o', 'hand-spock-o', 'hand-pointer-o', 'hand-peace-o', 'trademark', 'registered', 'creative-commons', 'gg', 'gg-circle', 'tripadvisor', 'odnoklassniki', 'odnoklassniki-square', 'get-pocket', 'wikipedia-w', 'safari', 'chrome', 'firefox', 'opera', 'internet-explorer', 'tv', 'television', 'contao', '500px', 'amazon', 'calendar-plus-o', 'calendar-minus-o', 'calendar-times-o', 'calendar-check-o', 'industry', 'map-pin', 'map-signs', 'map-o', 'map', 'commenting', 'commenting-o', 'houzz', 'vimeo', 'black-tie', 'fonticons', 'reddit-alien', 'edge', 'credit-card-alt', 'codiepie', 'modx', 'fort-awesome', 'usb', 'product-hunt', 'mixcloud', 'scribd', 'pause-circle', 'pause-circle-o', 'stop-circle', 'stop-circle-o', 'shopping-bag', 'shopping-basket', 'hashtag', 'bluetooth', 'bluetooth-b', 'percent', 'gitlab', 'wpbeginner', 'wpforms', 'envira', 'universal-access', 'wheelchair-alt', 'question-circle-o', 'blind', 'audio-description', 'volume-control-phone', 'braille', 'assistive-listening-systems', 'asl-interpreting', 'american-sign-language-interpreting', 'deafness', 'hard-of-hearing', 'deaf', 'glide', 'glide-g', 'signing', 'sign-language', 'low-vision', 'viadeo', 'viadeo-square', 'snapchat', 'snapchat-ghost', 'snapchat-square', 'pied-piper', 'first-order', 'yoast', 'themeisle', 'google-plus-circle', 'google-plus-official', 'fa', 'font-awesome');
	?>
	<div class="xmenu-config-panel-wrapper">
		<div class="xmenu-header">
			<h2>
				<i class="fa fa-cogs"></i><span>Menu Name</span>
				<button class="x-button xmenu-config-panel-save" type="button"><i class="fa fa-save"></i> <?php echo esc_html__('Save Changes','g5plus-handmade') ?></button>
				<button class="x-button xmenu-config-panel-close" type="button"><i class="fa fa-close"></i></button>
			</h2>
		</div>
		<div class="xmenu-config-panel-left">
			<ul>
				<?php foreach ($xmenu_item_settings as $item_key => $item_value): ?>
				<li <?php echo ($item_key == 'general' ? 'class="active"' :'') ?> rel-section="<?php echo esc_attr('section-' . $item_key) ?>"><i class="fa <?php echo esc_attr($item_value['icon']) ?>"></i><span><?php echo esc_html($item_value['text']) ?></span></li>
				<?php endforeach; ?>
				<li class="x-reset">
					<i class="fa fa-refresh"></i> <?php esc_html_e('Reset','g5plus-handmade') ?>
				</li>
			</ul>
		</div>
		<form class="xmenu-config-panel-right">
			<div class="xmenu-config-panel-right-inner">
				<?php foreach ($xmenu_item_settings as $item_key => $item_value): ?>
					<section <?php echo ($item_key == 'general' ? 'class="active"' :'') ?> id="<?php echo esc_attr('section-' . $item_key) ?>">
						<?php foreach ($item_value['config'] as $config_key => $config): ?>
							<?php xmenu_menu_item_config_panel_render_item($config_key, $config);?>
						<?php endforeach; ?>
					</section>
				<?php endforeach; ?>
			</div>
			<div class="xmenu-panel-scroll-wrapper">
				<div class="xmenu-panel-scroll">
					<div class="xmenu-panel-drag"></div>
				</div>
			</div>
		</form>
		<div class="xmenu-icon-popup">
			<div class="xmenu-icon-popup-header">
				<input type="text" placeholder="<?php esc_html_e('Type to search...','g5plus-handmade') ?>"/>
				<div class="xmenu-icon-remove">
					<button class="x-button">Remove Icon</button>
				</div>
				<i class="fa fa-remove"></i>
			</div>
			<div class="xmenu-icon-popup-content">
				<ul>
					<?php foreach($icons as $icon_value): ?>
						<li title="<?php echo esc_attr($icon_value) ?>"><i class="fa fa-<?php echo esc_attr($icon_value) ?>"></i></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
function xmenu_menu_item_config_panel_render_item($config_key, $config) {
	switch($config['type']) {
		case 'heading':
			?>
				<h3 class="x-section-title"><?php echo esc_html($config['text']); ?></h3>
			<?php
			break;
		case 'checkbox':
			$chekbox_value = '1';
			if (isset($config['value']) && !empty($config['value'])) {
				$chekbox_value = $config['value'];
			}
			?>
			<div class="x-col">
				<label class="x-position-relative" for="xmenu_config_<?php echo esc_attr($config_key); ?>"><input class="x-input x-checkbox" name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" type="checkbox" value="<?php echo esc_attr($chekbox_value) ?>" <?php checked( $config['std'], $chekbox_value ); ?>/> <span><?php echo esc_html($config['text']); ?></span> </label>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'text':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input"><input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textbox" type="text" value="<?php echo esc_attr($config['std']); ?>"/></div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'array':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input"><input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textbox x-array" type="text" value="<?php echo esc_attr($config['std']); ?>"/></div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'select':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input">
					<label class="x-input-label" for="xmenu_config_<?php echo esc_attr($config_key); ?>">
						<select name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-select">
							<?php foreach ($config['options'] as $key => $value):?>
								<option <?php selected( $config['std'], $key ); ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
							<?php endforeach;?>
						</select>
						<div class="x-select-arrow"><i class="fa fa-caret-down"></i></div>
					</label>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'textarea':
			$element_style = '';
			if (isset($config['height']) && $config['height']) {
				$element_style = 'height:' . $config['height'];
			}
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input"><textarea name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textarea" style="<?php echo esc_attr($element_style) ?>"><?php echo esc_html($config['std']); ?></textarea></div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'select-group':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input">
					<label class="x-input-label" for="xmenu_config_<?php echo esc_attr($config_key); ?>">
						<select name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-select x-select-group">
							<?php foreach ($config['options'] as $op_key => $op_value):?>
								<optgroup label="<?php echo esc_attr($op_value['text']) ?>">
									<?php foreach ($op_value['options'] as $key => $value):?>
										<option <?php selected( $config['std'], $key ); ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
									<?php endforeach;?>
								</optgroup>
							<?php endforeach;?>
						</select>
						<div class="x-select-arrow"><i class="fa fa-caret-down"></i></div>
					</label>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'image':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input x-col-media-image">
					<input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textbox x-media-image" type="text" value="<?php echo esc_attr($config['std']); ?>"/>
					<button type="button" id="browser_xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-button x-media-button"><i class="fa fa-image"></i></button>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'icon':
			?>
			<div class="x-col">
				<div class="x-col-input">
					<div class="x-icon-wrapper" data-rel="xmenu_config_<?php echo esc_attr($config_key); ?>">
						<input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textbox x-icon" type="hidden" value="<?php echo esc_attr($config['std']); ?>"/>
						<i></i>
						<span><?php echo esc_html($config['text']); ?></span>
						<div class="x-icon-remove"><i class="fa fa-remove"></i></div>
					</div>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'color':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input">
					<input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-color-picker" type="text" value="<?php echo esc_attr($config['std']); ?>"/>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'sidebar':
			$m_sidebars = array();
			$m_sidebars['-1'] = esc_html__('--None--','g5plus-handmade');
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				$m_sidebars[$sidebar['id']] = ucwords( $sidebar['name'] );
			}
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input">
					<label class="x-input-label" for="xmenu_config_<?php echo esc_attr($config_key); ?>">
						<select name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-select">
							<?php foreach ($m_sidebars as $key => $value):?>
								<option <?php selected( $config['std'], $key ); ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
							<?php endforeach;?>
						</select>
						<div class="x-select-arrow"><i class="fa fa-caret-down"></i></div>
					</label>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
	}
}
function xmenu_menu_item_render_description($config) {
	?>
	<?php if (isset($config['des']) && (!empty($config['des']))):?>
		<div class="x-description"><?php echo wp_kses_post($config['des']); ?></div>
	<?php endif;?>
	<?php
}

function xmenu_save_config_callback() {
	$error_result = array(
		'code' => '-1',
		'message' => esc_html__('Save menu config fail','g5plus-handmade'),
	);

	$config = $_POST['config'];
	$menu_id = $_POST['id'];

	$term = wp_get_object_terms($menu_id, 'nav_menu');
	if (!$term) {
		echo json_encode($error_result);
		die();
	}
	$term = $term[0];

	$menu_list = wp_get_nav_menu_items( $term->term_id, array( 'post_status' => 'any' ) );
	$menu_obj = null;
	foreach ($menu_list as $key => $menu_value) {
		if ($menu_value->ID == $menu_id) {
			$menu_obj = $menu_list[$key];
			break;
		}
	}
	if (!$menu_obj) {
		echo json_encode($error_result);
		die();
	}

	$args = array(
		'menu-item-db-id' => $menu_id,
		'menu-item-object-id' => $menu_obj->object_id,
		'menu-item-object' => $menu_obj->object,
		'menu-item-parent-id' => $menu_obj->menu_item_parent,
		'menu-item-position' => $menu_obj->menu_order,
		'menu-item-type' => $menu_obj->type,
		'menu-item-title' => $config['general-title'],
		'menu-item-url' => $menu_obj->type == 'custom' ? $config['general-url'] : $menu_obj->url,
		'menu-item-description' => $config['general-description'],
		'menu-item-attr-title' => $config['general-attr-title'],
		'menu-item-target' => $config['general-target'],
		'menu-item-classes' => $config['general-classes'],
		'menu-item-xfn' => $config['general-xfn'],
		'menu-item-status' => $menu_obj->post_status,
	);

	$id = wp_update_nav_menu_item( $term->term_id, $menu_id, $args );
	if ( $id && ! is_wp_error( $id ) ) {
		foreach($config as $key => $value) {
			if ((strpos($key, 'nosave-') === 0) || (strpos($key, 'general-') === 0)) {
				unset($config[$key]);
			}
		}

		update_post_meta( (int) $menu_id, '_menu_item_xmenu_config', json_encode( $config ) );
		echo json_encode(array(
			'code' => '1',
			'message' => '',
		));
		die();
	}
	echo json_encode($error_result);
	die();
}
add_action( 'wp_ajax_xmenu_save_config', 'xmenu_save_config_callback' );