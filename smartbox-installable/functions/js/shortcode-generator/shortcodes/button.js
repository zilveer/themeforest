desShortcodeMeta={
	attributes:[
			{
				label:"Title",
				id:"content",
				help:"The button title.",
				isRequired:true
			},
			{
				label:"Link",
				id:"link",
				help:"Optional link (e.g. http://designarethemes.com).",
				validateLink:true
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
			},
			{
				label:"Float Button",
				id:"align_button",
				controlType:"select-control", 
				selectValues:['', 'none', 'left', 'right'],
				defaultValue: '', 
				defaultText: ''
			},
			{
				label:"Size",
				id:"size",
				help:"Values: &lt;empty&gt; for normal size, Small, Large, XL.", 
				controlType:"select-control", 
				selectValues:['small', '', 'large', 'xl'],
				defaultValue: '', 
				defaultText: 'medium (Default)'
			},
			{
				label:"Icon ?",
				id:"enable_icon",
				controlType:"select-control", 
				selectValues:['Yes', 'No'],
				defaultValue: 'No', 
				defaultText: 'No'
			},
			{
				label:"Icon",
				id:"icon",
				controlType: "select-control",
				selectValues:['glass' , 'music' , 'search' , 'envelope-alt' , 'heart' , 'star' , 'star-empty' , 'user' , 'film' , 'th-large' , 'th' , 'th-list' , 'ok' , 'remove' , 'zoom-in' , 'zoom-out' , 'off' , 'signal' , 'cog' , 'trash' , 'home' , 'file' , 'time' , 'road' , 'download-alt' , 'download' , 'upload' , 'inbox' , 'play-circle' , 'repeat' , 'refresh' , 'list-alt' , 'lock' , 'flag' , 'headphones' , 'volume-off' , 'volume-down' , 'volume-up' , 'qrcode' , 'barcode' , 'tag' , 'tags' , 'book' , 'bookmark' , 'print' , 'camera' , 'font' , 'bold' , 'italic' , 'text-height' , 'text-width' , 'align-left' , 'align-center' , 'align-right' , 'align-justify' , 'list' , 'indent-left' , 'indent-right' , 'facetime-video' , 'picture' , 'pencil' , 'map-marker' , 'adjust' , 'tint' , 'edit' , 'share' , 'check' , 'move' , 'step-backward' , 'fast-backward' , 'backward' , 'play' , 'pause' , 'stop' , 'forward' , 'fast-forward' , 'step-forward' , 'eject' , 'chevron-left' , 'chevron-right' , 'plus-sign' , 'minus-sign' , 'remove-sign' , 'ok-sign' , 'question-sign' , 'info-sign' , 'screenshot' , 'remove-circle' , 'ok-circle' , 'ban-circle' , 'arrow-left' , 'arrow-right' , 'arrow-up' , 'arrow-down' , 'share-alt' , 'resize-full' , 'resize-small' , 'plus' , 'minus' , 'asterisk' , 'exclamation-sign' , 'gift' , 'leaf' , 'fire' , 'eye-open' , 'eye-close' , 'warning-sign' , 'plane' , 'calendar' , 'random' , 'comment' , 'magnet' , 'chevron-up' , 'chevron-down' , 'retweet' , 'shopping-cart' , 'folder-close' , 'folder-open' , 'resize-vertical' , 'resize-horizontal' , 'bar-chart' , 'twitter-sign' , 'facebook-sign' , 'camera-retro' , 'key' , 'cogs' , 'comments' , 'thumbs-up' , 'thumbs-down' , 'star-half' , 'heart-empty' , 'signout' , 'linkedin-sign' , 'pushpin' , 'external-link' , 'signin' , 'trophy' , 'github-sign' , 'upload-alt' , 'lemon' , 'phone' , 'check-empty' , 'bookmark-empty' , 'phone-sign' , 'twitter' , 'facebook' , 'github' , 'unlock' , 'credit-card' , 'rss' , 'hdd' , 'bullhorn' , 'bell' , 'certificate' , 'hand-right' , 'hand-left' , 'hand-up' , 'hand-down' , 'circle-arrow-left' , 'circle-arrow-right' , 'circle-arrow-up' , 'circle-arrow-down' , 'globe' , 'wrench' , 'tasks' , 'filter' , 'briefcase' , 'fullscreen' , 'group' , 'link' , 'cloud' , 'beaker' , 'cut' , 'copy' , 'paper-clip' , 'save' , 'sign-blank' , 'reorder' , 'list-ul' , 'list-ol' , 'strikethrough' , 'underline' , 'table' , 'magic' , 'truck' , 'pinterest' , 'pinterest-sign' , 'google-plus-sign' , 'google-plus' , 'money' , 'caret-down' , 'caret-up' , 'caret-left' , 'caret-right' , 'columns' , 'sort' , 'sort-down' , 'sort-up' , 'envelope-alt' , 'linkedin' , 'undo' , 'legal' , 'dashboard' , 'comment-alt' , 'comments-alt' , 'bolt' , 'sitemap' , 'umbrella' , 'paste' , 'lightbulb' , 'exchange' , 'cloud-download' , 'cloud-upload' , 'user-md' , 'stethoscope' , 'suitcase' , 'bell-alt' , 'coffee' , 'food' , 'file-alt' , 'building' , 'hospital' , 'ambulance' , 'medkit' , 'fighter-jet' , 'beer' , 'h-sign' , 'plus-sign-alt' , 'double-angle-left' , 'double-angle-right' , 'double-angle-up' , 'double-angle-down' , 'angle-left' , 'angle-right' , 'angle-up' , 'angle-down' , 'desktop' , 'laptop' , 'tablet' , 'mobile-phone' , 'circle-blank' , 'quote-left' , 'quote-right' , 'spinner' , 'circle' , 'reply' , 'github-alt' , 'folder-close-alt' , 'expand-alt', 'collapse-alt', 'smile', 'frown', 'meh', 'gamepad', 'keyboard', 'flag-alt', 'flag-checkered', 'terminal', 'code', 'reply-all', 'mail-reply-all', 'star-half-empty', 'location-arrow', 'crop', 'code-fork', 'unlink', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-off', 'shield', 'calendar-empty', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-sign-left', 'chevron-sign-right', 'chevron-sign-up', 'chevron-sign-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-horizontal', 'ellipsis-vertical', 'rss-sign', 'play-sign', 'ticket', 'minus-sign-alt', 'check-minus', 'level-up', 'level-down', 'check-sign', 'edit-sign', 'external-link-sign', 'share-sign', 'compass', 'collapse', 'collapse-top', 'expand', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'cny', 'krw', 'btc', 'file', 'file-text', 'sort-by-alphabet', 'sort-by-alphabet-alt', 'sort-by-attributes', 'sort-by-attributes-alt', 'sort-by-order', 'sort-by-order-alt', 'thumbs-up', 'thumbs-down', 'youtube-sign', 'youtube', 'xing', 'xing-sign', 'youtube-play', 'dropbox', 'stackexchange', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-sign', 'tumblr', 'tumblr-sign', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'sun', 'moon', 'archive', 'bug', 'vk', 'weibo', 'renren' ],
				help:"The icon will only be visible on the website.",
			},
			{
				label:"Predefined Style",
				id:"color",
				help:'Designare predefined styles (this overrides the custom colour settings).', 
				controlType:"select-control", 
				selectValues:['', 'yellow', 'white', 'black', 'red', 'green', 'orange', 'blue', 'violet', 'greensmartbox'],
				defaultValue: '', 
				defaultText: 'none (Default)'
			},
			
			{
				label:"Background Color",
				id:"bg_color",
				controlType:"colourpicker-control",
				help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
			},
			
			{
				label:"Border",
				id:"border",
				controlType:"colourpicker-control",
				help:"&lt;empty&gt; for default or the border color (e.g. Yellow or #ffffff)."
			},
			{
				label:"Text & Icon Color",
				id:"text_icon_color",
				controlType:"colourpicker-control",
				help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
			},
			{
				label:"Hover Background Color",
				id:"hover_bg_color",
				controlType:"colourpicker-control",
				help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
			},
			
			{
				label:"Hover Border",
				id:"hover_border",
				controlType:"colourpicker-control",
				help:"&lt;empty&gt; for default or the border color (e.g. Yellow or #ffffff)."
			},
			{
				label:"Hover Text & Icon Color",
				id:"hover_text_icon_color",
				controlType:"colourpicker-control",
				help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
			},
			{
				label:"CSS Class",
				id:"class",
				help:"Optional CSS class."
			},
			{
				label:"Open in a new window",
				id:"window",
				help:"Open this link in a new window.", 
				controlType:"select-control", 
				selectValues:['', 'yes'],
				defaultValue: '', 
				defaultText: 'no (Default)'
			}
			],
			disablePreview: true,
			customMakeShortcode: function(b){
				var a=b.data;
				
				var windows = "";
				if(b.window)
					windows = "target='_blank'";
					
				var class_output = "";
				if(b.text)
					class_output += " dark";
				if(b.class)
					class_output += " class='" + b.class +"'";
				if(b.size)
					class_output += " size='" + b.size+"'";
					
				if (b.text_icon_color == "") b.text_icon_color = "#FFF";
					
				var color_output = "";
				var border_out = "";
				if(b.color != "" ){
					if(b.color == 'yellow' || b.color == 'white' || b.color == 'black' || b.color == 'red' || b.color == 'green' || b.color == 'orange' || b.color == 'blue' || b.color == 'violet' || b.color == 'greensmartbox'){
						class_output += " color='" + b.color+"'";
						color_output = " background='"+b.bg_color+"'";
						
						if(b.border)
				   			color_output += " border='"+b.border+"'";
				   			
					} else {
						if ( b.border )
					   		border_out = b.border;
					   	else
					   		border_out = b.color;

				   		color_output = " background='"+b.color+"'";
				   		
				   		if(border_out && b.color != "greensmartbox") 
				   			color_output += " border='"+border_out+"'";
					}
				} else {

			   		if ( b.border != "")
				   		border_out = b.border;
			   		color_output = " background='"+b.bg_color+"'";
			   		
			   		if(border_out != "")
				   		color_output += " border='"+border_out+"'";
				   	color_output +=" color='"+b.text_icon_color+"'";
			   	}
			
				var content = "Button";
				if(b.content)
					content = b.content;
				
				var imagem = "";
				if (b.enable_icon == "Yes") imagem = " icon='"+b.icon+"'";	
				if(b.color == 'yellow' || b.color == 'white' || b.color == 'black' || b.color == 'red' || b.color == 'green' || b.color == 'orange' || b.color == 'blue' || b.color == 'violet' || b.color == 'greensmartbox') color_output="";
				else color_output+=" hover_bg_color='"+b.hover_bg_color+"' hover_border='"+b.hover_border+"' hover_text_icon_color='"+b.hover_text_icon_color+"'";
				
				
				return "[button "+windows+" align_button='" + b.align_button+"' a_fffect='" + b.a_fffect+"' delay='"+b.a_delay+"' link='"+b.link+"'"+class_output+color_output+imagem+"]"+content+"[/button]";
				
			}
};
