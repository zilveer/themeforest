<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Core configuration class
 * 
 * @since 1.0.0
 */
class YIT_Config {
	
	/**
	 * Config array
	 * 
	 * @var array
	 */
	protected static $_config = array(        
        'slider' => array('nivo', 'elegant'),
        
		//TODO: alphabetically reorder
		'awesome_icons' => array(
		    'icon-glass'=> 'Glass',
		    'icon-music'=> 'Music',
		    'icon-search'=> 'Search',
		    'icon-envelope'=> 'Envelope',
		    'icon-heart'=> 'Heart',
		    'icon-star'=> 'Star',
		    'icon-star-empty'=> 'Star empty',
		    'icon-user'=> 'User',
		    'icon-film'=> 'Film',
		    'icon-th-large'=> 'Th large',
		    'icon-th'=> 'Th',
		    'icon-th-list'=> 'Th list',
		    'icon-ok'=> 'Ok',
		    'icon-remove'=> 'Remove',
		    'icon-zoom-in'=> 'Zoom In',
		    'icon-zoom-out'=> 'Zoom Out',
		    'icon-off'=> 'Off',
		    'icon-signal'=> 'Signal',
		    'icon-cog'=> 'Cog',
		    'icon-trash'=> 'Trash',
		    'icon-home'=> 'Home',
		    'icon-file'=> 'File',
		    'icon-time'=> 'Time',
		    'icon-road'=> 'Road',
		    'icon-download-alt'=> 'Download alt',
		    'icon-download'=> 'Download',
		    'icon-upload'=> 'Upload',
		    'icon-inbox'=> 'Inbox',
		    'icon-play-circle'=> 'Play circle',
		    'icon-repeat'=> 'Repeat',
		    'icon-refresh'=> 'Refresh',
		    'icon-list-alt'=> 'List alt',
		    'icon-lock'=> 'Lock',
		    'icon-flag'=> 'Flag',
		    'icon-headphones'=> 'Headphones',
		    'icon-volume-off'=> 'Volume Off',
		    'icon-volume-down'=> 'Volume Down',
		    'icon-volume-up'=> 'Volume Up',
		    'icon-qrcode'=> 'QR code',
		    'icon-barcode'=> 'Barcode',
		    'icon-tag'=> 'Tag',
		    'icon-tags'=> 'Tags',
		    'icon-book'=> 'Book',
		    'icon-bookmark'=> 'Bookmark',
		    'icon-print'=> 'Print',
		    'icon-camera'=> 'Camera',
		    'icon-font'=> 'Font',
		    'icon-bold'=> 'Bold',
		    'icon-italic'=> 'Italic',
		    'icon-text-height'=> 'Text height',
		    'icon-text-width'=> 'Text width',
		    'icon-align-left'=> 'Align left',
		    'icon-align-center'=> 'Align center',
		    'icon-align-right'=> 'Align right',
		    'icon-align-justify'=> 'Align justify',
		    'icon-list'=> 'List',
		    'icon-indent-left'=> 'Indent left',
		    'icon-indent-right'=> 'Indent right',
		    'icon-facetime-video'=> 'Facetime video',
		    'icon-picture'=> 'Picture',
		    'icon-pencil'=> 'Pencil',
		    'icon-map-marker'=> 'Map marker',
		    'icon-adjust'=> 'Adjust',
		    'icon-tint'=> 'Tint',
		    'icon-edit'=> 'Edit',
		    'icon-share'=> 'Share',
		    'icon-check'=> 'Check',
		    'icon-move'=> 'Move',
		    'icon-step-backward'=> 'Step backward',
		    'icon-fast-backward'=> 'Fast backward',
		    'icon-backward'=> 'Backward',
		    'icon-play'=> 'Play',
		    'icon-pause'=> 'Pause',
		    'icon-stop'=> 'Stop',
		    'icon-forward'=> 'Forward',
		    'icon-fast-forward'=> 'Fast forward',
		    'icon-step-forward'=> 'Step forward',
		    'icon-eject'=> 'Eject',
		    'icon-chevron-left'=> 'Chevron left',
		    'icon-chevron-right'=> 'Chevron right',
		    'icon-plus-sign'=> 'Plus sign',
		    'icon-minus-sign'=> 'Minus sign',
		    'icon-remove-sign'=> 'Remove sign',
		    'icon-ok-sign'=> 'Ok sign',
		    'icon-question-sign'=> 'Question sign',
		    'icon-info-sign'=> 'Info sign',
		    'icon-screenshot'=> 'Screenshot',
		    'icon-remove-circle'=> 'Remove circle',
		    'icon-ok-circle'=> 'Ok circle',
		    'icon-ban-circle'=> 'Ban circle',
		    'icon-arrow-left'=> 'Arrow left',
		    'icon-arrow-right'=> 'Arrow right',
		    'icon-arrow-up'=> 'Arrow up',
		    'icon-arrow-down'=> 'Arrow down',
		    'icon-share-alt'=> 'Share alt',
		    'icon-resize-full'=> 'Resize full',
		    'icon-resize-small'=> 'Resize small',
		    'icon-plus'=> 'Plus',
		    'icon-minus'=> 'Minus',
		    'icon-asterisk'=> 'Asterisk',
		    'icon-exclamation-sign'=> 'Exclamation sign',
		    'icon-gift'=> 'Gift',
		    'icon-leaf'=> 'Leaf',
		    'icon-fire'=> 'Fire',
		    'icon-eye-open'=> 'Eye open',
		    'icon-eye-close'=> 'Eye close',
		    'icon-warning-sign'=> 'Warning sign',
		    'icon-plane'=> 'Plane',
		    'icon-calendar'=> 'Calendar',
		    'icon-random'=> 'Random',
		    'icon-comment'=> 'Comment',
		    'icon-magnet'=> 'Magnet',
		    'icon-chevron-up'=> 'Chevron up',
		    'icon-chevron-down'=> 'Chevron down',
		    'icon-retweet'=> 'Retweet',
		    'icon-shopping-cart'=> 'Shopping cart',
		    'icon-folder-close'=> 'Folder close',
		    'icon-folder-open'=> 'Folder open',
		    'icon-resize-vertical'=> 'Resize vertical',
		    'icon-resize-horizontal'=> 'Resize horizontal',
		    'icon-bar-chart'=> 'Bar chart',
		    'icon-twitter-sign'=> 'Twitter sign',
		    'icon-facebook-sign'=> 'Facebook sign',
		    'icon-camera-retro'=> 'Camera retro',
		    'icon-key'=> 'Key',
		    'icon-cogs'=> 'Cogs',
		    'icon-comments'=> 'Comments',
		    'icon-thumbs-up'=> 'Thumbs up',
		    'icon-thumbs-down'=> 'Thumbs down',
		    'icon-star-half'=> 'Star half',
		    'icon-heart-empty'=> 'Heart empty',
		    'icon-signout'=> 'Signout',
		    'icon-linkedin-sign'=> 'LinkedIn sign',
		    'icon-pushpin'=> 'Push pin',
		    'icon-external-link'=> 'External link',
		    'icon-signin'=> 'Sign in',
		    'icon-trophy'=> 'Trophy',
		    'icon-github-sign'=> 'Github sign',
		    'icon-upload-alt'=> 'Upload alt',
		    'icon-lemon'=> 'Lemon',
		    'icon-phone'=> 'Phone',
		    'icon-check-empty'=> 'Check empty',
		    'icon-bookmark-empty'=> 'Bookmark empty',
		    'icon-phone-sign'=> 'Phone sign',
		    'icon-twitter'=> 'Twitter',
		    'icon-facebook'=> 'Facebook',
		    'icon-github'=> 'Github',
		    'icon-unlock'=> 'Unlock',
		    'icon-credit-card'=> 'Credit card',
		    'icon-rss'=> 'RSS',
		    'icon-hdd'=> 'HDD',
		    'icon-bullhorn'=> 'Bullhorn',
		    'icon-bell'=> 'Bell',
		    'icon-certificate'=> 'Certificate',
		    'icon-hand-right'=> 'Hand right',
		    'icon-hand-left'=> 'Hand left',
		    'icon-hand-up'=> 'Hand up',
		    'icon-hand-down'=> 'Hand down',
		    'icon-circle-arrow-left'=> 'Circle arrow left',
		    'icon-circle-arrow-right'=> 'Circle arrow right',
		    'icon-circle-arrow-up'=> 'Circle arrow up',
		    'icon-circle-arrow-down'=> 'Circle arrow down',
		    'icon-globe'=> 'Globe',
		    'icon-wrench'=> 'Wrench',
		    'icon-tasks'=> 'Tasks',
		    'icon-filter'=> 'Filter',
		    'icon-briefcase'=> 'Briefcase',
		    'icon-fullscreen'=> 'Fullscreen',
		    'icon-group'=> 'Group',
		    'icon-link'=> 'Link',
		    'icon-cloud'=> 'Cloud',
		    'icon-beaker'=> 'Beaker',
		    'icon-cut'=> 'Cut',
		    'icon-copy'=> 'Copy',
		    'icon-paper-clip'=> 'Paper clip',
		    'icon-save'=> 'Save',
		    'icon-sign-blank'=> 'Sign blank',
		    'icon-reorder'=> 'Reorder',
		    'icon-list-ul'=> 'List ul',
		    'icon-list-ol'=> 'List ol',
		    'icon-strikethrough'=> 'Strike through',
		    'icon-underline'=> 'Underline',
		    'icon-table'=> 'Table',
		    'icon-magic'=> 'Magic',
		    'icon-truck'=> 'Truck',
		    'icon-pinterest'=> 'Pinterest',
		    'icon-pinterest-sign'=> 'Pinterest sign',
		    'icon-google-plus-sign'=> 'Google Plus sign',
		    'icon-google-plus'=> 'Google Plus',
		    'icon-money'=> 'Money',
		    'icon-caret-down'=> 'Caret down',
		    'icon-caret-up'=> 'Caret up',
		    'icon-caret-left'=> 'Caret left',
		    'icon-caret-right'=> 'Caret right',
		    'icon-columns'=> 'Columns',
		    'icon-sort'=> 'Sort',
		    'icon-sort-down'=> 'Sort down',
		    'icon-sort-up'=> 'Sort up',
		    'icon-envelope-alt'=> 'Envelope alt',
		    'icon-linkedin'=> 'LinkedIn',
		    'icon-undo'=> 'Undo',
		    'icon-legal'=> 'Legal',
		    'icon-dashboard'=> 'Dashboard',
		    'icon-comment-alt'=> 'Comment alt',
		    'icon-comments-alt'=> 'Comments alt',
		    'icon-bolt'=> 'Bolt',
		    'icon-sitemap'=> 'Sitemap',
		    'icon-umbrella'=> 'Umbrella',
		    'icon-paste'=> 'Paste',
		    'icon-user-md'=> 'User medical'		    
		),
		
		'header_backgrounds' => array(),
		'body_backgrounds' => array(),
        
        // tags used in theme options (e.g. %tag%) to have some common informations
        'tag' => array(
            //'themeurl' => get_template_directory_uri()
        ),
        
        'cycle_fx' => array(
            'blindX' => 'blindX', 		'blindY' => 'blindY', 		'blindZ' => 'blindZ', 		'cover' => 'cover', 		'curtainX' => 'curtainX',
            'curtainY' => 'curtainY', 	'fade' => 'fade', 			'fadeZoom' => 'fadeZoom', 	'growX' => 'growX', 		'growY' => 'growY',
            'scrollUp' => 'scrollUp', 	'scrollDown' => 'scrollDown','scrollLeft' => 'scrollLeft','scrollRight' => 'scrollRight', 	'scrollHorz' => 'scrollHorz',
            'shuffle' => 'shuffle', 	'slideX' => 'slideX', 		'slideY' => 'slideY', 		'toss' => 'toss', 			'turnUp' => 'turnUp',
            'turnLeft' => 'turnLeft', 	'turnRight' => 'turnRight', 'uncover' => 'uncover', 	'wipe' => 'wipe', 			'zoom' => 'zoom',
            'none' => 'none',			'turnDown' => 'turnDown',	'scrollVert' => 'scrollVert'
        ),
        
        'easings' => array(
            FALSE => 'none',
        	'easeInQuad' => 'easeInQuad',
        	'easeOutQuad' => 'easeOutQuad',
        	'easeInOutQuad' => 'easeInOutQuad',
        	'easeInCubic' => 'easeInCubic',
        	'easeOutCubic' => 'easeOutCubic',
        	'easeInOutCubic' => 'easeInOutCubic',
        	'easeInQuart' => 'easeInQuart',
        	'easeOutQuart' => 'easeOutQuart',
        	'easeInOutQuart' => 'easeInOutQuart',
        	'easeInQuint' => 'easeInQuint',
        	'easeOutQuint' => 'easeOutQuint',
        	'easeInOutQuint' => 'easeInOutQuint',
        	'easeInSine' => 'easeInSine',
        	'easeOutSine' => 'easeOutSine',
        	'easeInOutSine' => 'easeInOutSine',
        	'easeInExpo' => 'easeInExpo',
        	'easeOutExpo' => 'easeOutExpo',
        	'easeInOutExpo' => 'easeInOutExpo',
        	'easeInCirc' => 'easeInCirc',
        	'easeOutCirc' => 'easeOutCirc',
        	'easeInOutCirc' => 'easeInOutCirc',
        	'easeInElastic' => 'easeInElastic',
        	'easeOutElastic' => 'easeOutElastic',
        	'easeInOutElastic' => 'easeInOutElastic',
        	'easeInBack' => 'easeInBack',
        	'easeOutBack' => 'easeOutBack',
        	'easeInOutBack' => 'easeInOutBack',
        	'easeInBounce' => 'easeInBounce',
        	'easeOutBounce' => 'easeOutBounce',
        	'easeInOutBounce' => 'easeInOutBounce'
        )
	);
	
	/**
	 * Get configuration array
	 * 
	 * @return array
	 */
	public static function load() {
		self::_loadThemeInfo();
        ksort( self::$_config['awesome_icons'] );
		
		return self::$_config;
	}
	
	/**
	 * Return theme data
	 * 
	 * First the method checks if the wp_get_theme() function exists (WP 3.4.0 at least). 
	 * If not, the method calls the deprecated function get_template_directory()
	 * 
	 * @return array
	 */
	protected static function _loadThemeInfo() {
		if( function_exists('wp_get_theme') ) {
			
			$theme = wp_get_theme();
			
			self::$_config['theme'] = array(
				'name' => $theme->Name,
//				'themeuri' => $theme->{'Theme URI'},
				'description' => $theme->Description,
				'author' => $theme->Author,
				'authoruri' => $theme->{'Author URI'},
				'version' => $theme->Version,
				'template' => $theme->Template,
				'status' => $theme->Status,
				'tags' => $theme->Tags,
//				'textdomain' => $theme->{'Text Domain'},
//				'domainpath' => $theme->{'Domain Path'}
			);

			
		}  else {
			$theme = get_theme_data(get_template_directory() . DS . 'style.css');
			
			self::$_config['theme'] =  array(
				'name' => $theme['Name'],
				'themeuri' => $theme['URI'],
				'description' => $theme['Description'],
				'author' => $theme['Author'],
				'authoruri' => $theme['AuthorURI'],
				'version' => $theme['Version'],
				'template' => $theme['Template'],
				'status' => $theme['Status'],
				'tags' => $theme['Tags']
			);
			
		} 
	}


	public function init() {
		self::$_config['header_backgrounds'] = apply_filters( 'yit_header_backgrounds', self::$_config['header_backgrounds'] );
		self::$_config['body_backgrounds'] = apply_filters( 'yit_body_backgrounds', self::$_config['body_backgrounds'] );
	}
}
