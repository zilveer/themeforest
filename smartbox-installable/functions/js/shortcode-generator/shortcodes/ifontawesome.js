desShortcodeMeta={
	attributes:[
		{
			label:"Icon Size",
			id:"icon_size",
			help:"The size of the icon. You can either use <i>px</i> or <i>em</i> unities. Ex #1: <i>12px</i> | Ex #2: <i>3em</i>"
		},
		{
			label:"Icon Color",
			id:"icon_color",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
		},
		{
			label:"Icon Style",
			id:"icon_stylebg",
			help:"Values: &lt;empty&gt; for none style, circle, rounded.", 
			controlType:"select-control", 
			selectValues:['', 'None', 'Circle', 'Rounded'],
			defaultValue: 'none', 
		},
		
		{
			label:"Icon Style BG Color",
			id:"icon_bgcolor",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
		},
		{
			label:"Icon Style Border Color",
			id:"icon_bordercolor",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
		},
		{
			label: "Icon Align",
			id:"align",
			controlType:"select-control", 
			selectValues:['Left', 'Center', 'Right'],
			defaultValue: 'Left', 
			defaultText: 'Left',
			help: "Left, Center or Right Alignment"
		},
		{
			label:"Icon",
			id:"icon",
			controlType: "select-control",
			selectValues:['glass' , 'music' , 'search' , 'envelope-alt' , 'heart' , 'star' , 'star-empty' , 'user' , 'film' , 'th-large' , 'th' , 'th-list' , 'ok' , 'remove' , 'zoom-in' , 'zoom-out' , 'off' , 'signal' , 'cog' , 'trash' , 'home' , 'file' , 'time' , 'road' , 'download-alt' , 'download' , 'upload' , 'inbox' , 'play-circle' , 'repeat' , 'refresh' , 'list-alt' , 'lock' , 'flag' , 'headphones' , 'volume-off' , 'volume-down' , 'volume-up' , 'qrcode' , 'barcode' , 'tag' , 'tags' , 'book' , 'bookmark' , 'print' , 'camera' , 'font' , 'bold' , 'italic' , 'text-height' , 'text-width' , 'align-left' , 'align-center' , 'align-right' , 'align-justify' , 'list' , 'indent-left' , 'indent-right' , 'facetime-video' , 'picture' , 'pencil' , 'map-marker' , 'adjust' , 'tint' , 'edit' , 'share' , 'check' , 'move' , 'step-backward' , 'fast-backward' , 'backward' , 'play' , 'pause' , 'stop' , 'forward' , 'fast-forward' , 'step-forward' , 'eject' , 'chevron-left' , 'chevron-right' , 'plus-sign' , 'minus-sign' , 'remove-sign' , 'ok-sign' , 'question-sign' , 'info-sign' , 'screenshot' , 'remove-circle' , 'ok-circle' , 'ban-circle' , 'arrow-left' , 'arrow-right' , 'arrow-up' , 'arrow-down' , 'share-alt' , 'resize-full' , 'resize-small' , 'plus' , 'minus' , 'asterisk' , 'exclamation-sign' , 'gift' , 'leaf' , 'fire' , 'eye-open' , 'eye-close' , 'warning-sign' , 'plane' , 'calendar' , 'random' , 'comment' , 'magnet' , 'chevron-up' , 'chevron-down' , 'retweet' , 'shopping-cart' , 'folder-close' , 'folder-open' , 'resize-vertical' , 'resize-horizontal' , 'bar-chart' , 'twitter-sign' , 'facebook-sign' , 'camera-retro' , 'key' , 'cogs' , 'comments' , 'thumbs-up' , 'thumbs-down' , 'star-half' , 'heart-empty' , 'signout' , 'linkedin-sign' , 'pushpin' , 'external-link' , 'signin' , 'trophy' , 'github-sign' , 'upload-alt' , 'lemon' , 'phone' , 'check-empty' , 'bookmark-empty' , 'phone-sign' , 'twitter' , 'facebook' , 'github' , 'unlock' , 'credit-card' , 'rss' , 'hdd' , 'bullhorn' , 'bell' , 'certificate' , 'hand-right' , 'hand-left' , 'hand-up' , 'hand-down' , 'circle-arrow-left' , 'circle-arrow-right' , 'circle-arrow-up' , 'circle-arrow-down' , 'globe' , 'wrench' , 'tasks' , 'filter' , 'briefcase' , 'fullscreen' , 'group' , 'link' , 'cloud' , 'beaker' , 'cut' , 'copy' , 'paper-clip' , 'save' , 'sign-blank' , 'reorder' , 'list-ul' , 'list-ol' , 'strikethrough' , 'underline' , 'table' , 'magic' , 'truck' , 'pinterest' , 'pinterest-sign' , 'google-plus-sign' , 'google-plus' , 'money' , 'caret-down' , 'caret-up' , 'caret-left' , 'caret-right' , 'columns' , 'sort' , 'sort-down' , 'sort-up' , 'envelope-alt' , 'linkedin' , 'undo' , 'legal' , 'dashboard' , 'comment-alt' , 'comments-alt' , 'bolt' , 'sitemap' , 'umbrella' , 'paste' , 'lightbulb' , 'exchange' , 'cloud-download' , 'cloud-upload' , 'user-md' , 'stethoscope' , 'suitcase' , 'bell-alt' , 'coffee' , 'food' , 'file-alt' , 'building' , 'hospital' , 'ambulance' , 'medkit' , 'fighter-jet' , 'beer' , 'h-sign' , 'plus-sign-alt' , 'double-angle-left' , 'double-angle-right' , 'double-angle-up' , 'double-angle-down' , 'angle-left' , 'angle-right' , 'angle-up' , 'angle-down' , 'desktop' , 'laptop' , 'tablet' , 'mobile-phone' , 'circle-blank' , 'quote-left' , 'quote-right' , 'spinner' , 'circle' , 'reply' , 'github-alt' , 'folder-close-alt' , 'expand-alt', 'collapse-alt', 'smile', 'frown', 'meh', 'gamepad', 'keyboard', 'flag-alt', 'flag-checkered', 'terminal', 'code', 'reply-all', 'mail-reply-all', 'star-half-empty', 'location-arrow', 'crop', 'code-fork', 'unlink', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-off', 'shield', 'calendar-empty', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-sign-left', 'chevron-sign-right', 'chevron-sign-up', 'chevron-sign-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-horizontal', 'ellipsis-vertical', 'rss-sign', 'play-sign', 'ticket', 'minus-sign-alt', 'check-minus', 'level-up', 'level-down', 'check-sign', 'edit-sign', 'external-link-sign', 'share-sign', 'compass', 'collapse', 'collapse-top', 'expand', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'cny', 'krw', 'btc', 'file', 'file-text', 'sort-by-alphabet', 'sort-by-alphabet-alt', 'sort-by-attributes', 'sort-by-attributes-alt', 'sort-by-order', 'sort-by-order-alt', 'thumbs-up', 'thumbs-down', 'youtube-sign', 'youtube', 'xing', 'xing-sign', 'youtube-play', 'dropbox', 'stackexchange', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-sign', 'tumblr', 'tumblr-sign', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'sun', 'moon', 'archive', 'bug', 'vk', 'weibo', 'renren' ],
		},
		{
			label:"Animation Effect",
			id:"a_fffect",
			controlType:"select-control", 
			selectValues:['','flip', 'flipInX', 'bounceIn', 'bounceInDown', 'bounceInUp', 'bounceInLeft', 'bounceInRight', 'fadeIn', 'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'fadeInUpBig', 'fadeInDownBig', 'fadeInLeftBig', 'fadeInRightBig', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'lightSpeedIn', 'lightSpeedOut', 'hinge', 'rollIn', 'rollOut'],
			defaultValue: '', 
			defaultText: ''
		},
		{
			label:"Animation Delay",
			id:"a_delay",
			help:"You can set a delay for the animation in <i>seconds</i>. Ex #1: <i>1s</i> | Ex #2: <i>0.3s</i>"
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			
			var style = "";
			
			if(b.icon_color != '')
				style += "color='" +b.icon_color+ "' ";
			
			if(b.icon_size != '')
				style += "font_size='" +b.icon_size+ "' ";
			
			
			if(b.icon_stylebg != '')
				style += "style_bg='" +b.icon_stylebg+ "' ";
			
			if(b.icon_bgcolor != '')
				style += "background='" +b.icon_bgcolor+ "' ";
			
			if(b.icon_bordercolor != '')
				style += "border='1px solid " +b.icon_bordercolor+ "' ";
			
			if(b.icon_align != '')
				style += "text-align='" +b.icon_align+ "' ";
				
			if(b.a_fffect != '')
				style += "a_fffect='" + b.a_fffect+ "' ";
			
			if (b.a_delay != ''){
				style += "a_delay='"+b.a_delay+"' ";
			}
			
			style += "align='"+b.align+"'";
			
			g = "[i class='icon-"+b.icon+"' ";
			if (style!="") g+= style;
			g += "]";
			return g;
		}
};