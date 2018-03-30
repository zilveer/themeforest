/**
 * This file contains all the main JavaScript functionality needed for the editor formatting buttons.
 * 
 * @author differentthemes
 * http://differentthemes.com
 */

/**
 * Define all the formatting buttons with the HTML code they set.
 */
var differentthemesButtons=[
		{
			id:'differentthemesbutton',
			image:'button.png',
			title:'Button',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},{id:'href', name:'Link URL'},{id:'color', name:'Color', colorpalette:true},{id:'textcolor', name:'Text Color', colorpalette:true},{id:'style', name:'Button Style', values:['Normal', 'Gloss']},{id:'target', name:'Target', values:['Self', 'Blank']},{id:'icon', name:'Icon', values:['None','icon-cloud-download','icon-cloud-upload','icon-lightbulb','icon-exchange','icon-bell-alt','icon-file-alt','icon-beer','icon-coffee','icon-food','icon-fighter-jet','icon-user-md','icon-stethoscope','icon-suitcase','icon-building','icon-hospital','icon-ambulance','icon-medkit','icon-h-sign','icon-plus-sign-alt','icon-spinner','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-circle-blank','icon-circle','icon-desktop','icon-laptop','icon-tablet','icon-mobile-phone','icon-quote-left','icon-quote-right','icon-reply','icon-github-alt','icon-folder-close-alt','icon-folder-open-alt','icon-adjust','icon-asterisk','icon-ban-circle','icon-bar-chart','icon-barcode','icon-beaker','icon-beer','icon-bell','icon-bell-alt','icon-bolt','icon-book','icon-bookmark','icon-bookmark-empty','icon-briefcase','icon-bullhorn','icon-calendar','icon-camera','icon-camera-retro','icon-certificate','icon-check','icon-check-empty','icon-circle','icon-circle-blank','icon-cloud','icon-cloud-download','icon-cloud-upload','icon-coffee','icon-cog','icon-cogs','icon-comment','icon-comment-alt','icon-comments','icon-comments-alt','icon-credit-card','icon-dashboard','icon-desktop','icon-download','icon-download-alt','icon-edit','icon-envelope','icon-envelope-alt','icon-exchange','icon-exclamation-sign','icon-external-link','icon-eye-close','icon-eye-open','icon-facetime-video','icon-fighter-jet','icon-film','icon-filter','icon-fire','icon-flag','icon-folder-close','icon-folder-open','icon-folder-close-alt','icon-folder-open-alt','icon-food','icon-gift','icon-glass','icon-globe','icon-group','icon-hdd','icon-headphones','icon-heart','icon-heart-empty','icon-home','icon-inbox','icon-info-sign','icon-key','icon-leaf','icon-laptop','icon-legal','icon-lemon','icon-lightbulb','icon-lock','icon-unlock','icon-magic','icon-magnet','icon-map-marker','icon-minus','icon-minus-sign','icon-mobile-phone','icon-money','icon-move','icon-music','icon-off','icon-ok','icon-ok-circle','icon-ok-sign','icon-pencil','icon-picture','icon-plane','icon-plus','icon-plus-sign','icon-print','icon-pushpin','icon-qrcode','icon-question-sign','icon-quote-left','icon-quote-right','icon-random','icon-refresh','icon-remove','icon-remove-circle','icon-remove-sign','icon-reorder','icon-reply','icon-resize-horizontal','icon-resize-vertical','icon-retweet','icon-road','icon-rss','icon-screenshot','icon-search','icon-share','icon-share-alt','icon-shopping-cart','icon-signal','icon-signin','icon-signout','icon-sitemap','icon-sort','icon-sort-down','icon-sort-up','icon-spinner','icon-star','icon-star-empty','icon-star-half','icon-tablet','icon-tag','icon-tags','icon-tasks','icon-thumbs-down','icon-thumbs-up','icon-time','icon-tint','icon-trash','icon-trophy','icon-truck','icon-umbrella','icon-upload','icon-upload-alt','icon-user','icon-user-md','icon-volume-off','icon-volume-down','icon-volume-up','icon-warning-sign','icon-wrench','icon-zoom-in','icon-zoom-out','icon-file','icon-file-alt','icon-cut','icon-copy','icon-paste','icon-save','icon-undo','icon-repeat','icon-text-height','icon-text-width','icon-align-left','icon-align-center','icon-align-right','icon-align-justify','icon-indent-left','icon-indent-right','icon-font','icon-bold','icon-italic','icon-strikethrough','icon-underline','icon-link','icon-paper-clip','icon-columns','icon-table','icon-th-large','icon-th','icon-th-list','icon-list','icon-list-ol','icon-list-ul','icon-list-alt','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-arrow-down','icon-arrow-left','icon-arrow-right','icon-arrow-up','icon-caret-down','icon-caret-left','icon-caret-right','icon-caret-up','icon-chevron-down','icon-chevron-left','icon-chevron-right','icon-chevron-up','icon-circle-arrow-down','icon-circle-arrow-left','icon-circle-arrow-right','icon-circle-arrow-up','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-hand-down','icon-hand-left','icon-hand-right','icon-hand-up','icon-circle','icon-circle-blank','icon-play-circle','icon-play','icon-pause','icon-stop','icon-step-backward','icon-fast-backward','icon-backward','icon-forward','icon-fast-forward','icon-step-forward','icon-eject','icon-fullscreen','icon-resize-full','icon-resize-small','icon-phone','icon-phone-sign','icon-facebook','icon-facebook-sign','icon-twitter','icon-twitter-sign','icon-github','icon-github-alt','icon-github-sign','icon-linkedin','icon-linkedin-sign','icon-pinterest','icon-pinterest-sign','icon-google-plus','icon-google-plus-sign','icon-sign-blank','icon-ambulance','icon-beaker','icon-h-sign','icon-hospital','icon-medkit','icon-plus-sign-alt','icon-stethoscope','icon-user-md']},{id:'size', name:'Size', values:['Default', 'Small', 'Medium', 'Large', 'Full']}],
			generateHtml:function(obj){
			


				return '[button link="'+obj.href+'" target="'+obj.target.toLowerCase()+'" color="'+obj.color.toLowerCase()+'" icon="'+obj.icon.toLowerCase()+'" style="'+obj.style.toLowerCase()+'" textcolor="'+obj.textcolor.toLowerCase()+'" size="'+obj.size.toLowerCase()+'"]'+obj.text+'[/button]';

			}
		},
		{

			id:'differentthemescolumns',
			image:'column.png',
			title:'Columns',
			allowSelection:true,
			fields:[{id:'column', name:'Column Width', values:['Sixteen', 'Half', 'One Third', 'Two Thirds', 'One Four', 'Three fourth'],selesction:true}],
			generateHtml:function(obj){

				switch(obj.column) {
					case 'One Third':
						var column='one-third'
					break;
					case 'Two Thirds':
						var column='two-thirds'
					break;
					case 'One Four':
						var column='four'
					break;
					case 'Three fourth':
						var column='three-fourths'
					break;

					default:
					var column=obj.column;
				}

				return '['+column.toLowerCase()+']'+obj.selection+'[/'+column.toLowerCase()+']';

			}

		},

		{
			id:'differentthemesspacer',
			image:'spacer.png',
			title:'Spacer',
			allowSelection:false,
			fields:[{id:'type', name:'Spacer Style', values:['1', '2']}],
			generateHtml:function(obj){
				if(obj.type=="2") {
					return '<hr class="stripe">';
				} else {
					return '<hr>';
				}
			}
		},
		{
			id:'differentthemesteam',
			image:'team.png',
			title:'Team Box',
			allowSelection:false,
			fields:[{id:'title', name:'Title: '},{id:'subtitle', name:'Subtitle: '},{id:'img', name:'Photo Url: '}, {id:'text', name:'Text: ', textarea:true},{id:'social-1', name:'Social', values:['AddThis', 'Behance', 'Blogger', 'Delicious', 'Deviantart', 'Digg', 'Dopplr', 'Dribbble', 'Evernote', 'Facebook', 'Flickr', 'Forrst', 'Github', 'Google', 'Grooveshark', 'Instagram', 'Lastfm', 'Linkedin', 'Mail', 'Myspace', 'Paypal', 'Picasa', 'Pinterest', 'Posterous', 'Reddit', 'Rss', 'Sharethis', 'Skype', 'Soundcloud', 'Spotify', 'Stumbleupon', 'Tumblr', 'Viddler', 'Vimeo', 'Virb', 'Windows', 'Wordpress', 'Youtube', 'Twitter']},{id:'url-1', name:'URL: ', team:true}],
			generateHtml:function(obj){
				var x = jQuery('#df-team').val();  
				var output = '[about';
				output+= ' img="'+obj.img+'"';
				output+= ' subtitle="'+obj.subtitle+'"';
				output+= ' title="'+obj.title+'"';
				for(e = 1; e <= x; e++) {
					output+= ' '+jQuery('#differentthemes-shortcode-social-'+e).val().toLowerCase()+'="'+jQuery('#differentthemes-shortcode-url-'+e).val()+'" ';
				}
				output+= ']';
				output+= obj.text;
				output+="[/about]";

				return output;
			}
		},
		{
			id:'differentthemesquote',
			image:'blockquote.png',
			title:'Block text',
			allowSelection:false,
			fields:[{id:'blocktext', name:'Block text', textarea:true},{id:'align', name:'Position', values:['Left', 'Center', 'Right']}],
			generateHtml:function(obj){
				return '[blocktext align="'+obj.align.toLowerCase()+'"]'+obj.blocktext+'[/blocktext]';
			}
		},
		{
			id:'differentthemesvideo',
			image:'video.png',
			title:'Video',
			allowSelection:false,
			fields:[{id:'blocktext', name:'Embed Code', textarea:true}],
			generateHtml:function(obj){
				return '[video]'+obj.blocktext+'[/video]';
			}
		},
		{
			id:'differentthemesattention',
			image:'attention.png',
			title:'Attention Box',
			allowSelection:false,
			fields:[{id:'title', name:'Box Title'},{id:'attention', name:'Box Text', textarea:true},{id:'align', name:'Text Align', values:['Left', 'Center']},{id:'button', name:'Button Text'},{id:'link', name:'Button Link'},{id:'target', name:'Target', values:['Self', 'Blank']}],
			generateHtml:function(obj){
				return '[attention align="'+obj.align.toLowerCase()+'" target="'+obj.target.toLowerCase()+'" button="'+obj.button+'" title="'+obj.title+'" link="'+obj.link+'"]'+obj.attention+'[/attention]';
			}
		},
		{
			id:'differentthemesalert',
			image:'alert.png',
			title:'Alert',
			allowSelection:false,
			fields:[{id:'type', name:'Type', values:['Error', 'Success', 'Info', 'Warning']},{id:'title', name:'Title' }, {id:'text', name:'Text', textarea:true}],
			generateHtml:function(obj){
				return '[alert type="'+obj.type.toLowerCase()+'" title="'+obj.title+'"]'+obj.text+'[/alert]';
			}
		},
		{
			id:'differentthemesimages',
			image:'alert.png',
			title:'Alert',
			allowSelection:false,
			fields:[{id:'type', name:'Type', values:['Error', 'Success', 'Info', 'Notice']},{id:'title', name:'Title' }, {id:'text', name:'Text', textarea:true}],
			generateHtml:function(obj){
				return '[alert type="'+obj.type.toLowerCase()+'" title="'+obj.title+'"]'+obj.text+'[/alert]';
			}
		},
		{
			id:'differentthemespreformated',
			image:'preformated-text.png',
			title:'Preformated text',
			allowSelection:true,
			generateHtml:function(obj){
				return '[preformated]'+obj+'[/preformated]';
			}

		},
		{
			id:'differentthemesmiscellaneous',
			image:'miscellaneous.png',
			title:'Miscellaneous',
			allowSelection:true,
			fields:[{id:'type', name:'Type', values:['Superscript', 'Subscript', 'Small'],selesction:true}],
			generateHtml:function(obj){
				return '[miscellaneous type="'+obj.type.toLowerCase()+'"]'+obj.selection+'[/miscellaneous]';
			}

		},
		{
			id:'differentthemesmarker',
			image:'highlights.png',
			title:'Highlights',
			allowSelection:true,
			fields:[{id:'type', name:'Type', values:['Background Color', 'Text Color']}, {id:'markercolor', name:'Color', color:"c24000", colorpalette:true,selesction:true}],
			generateHtml:function(obj){
				return '[textmarker color="'+obj.markercolor+'" type="'+obj.type.toLowerCase()+'"]'+obj.selection+'[/textmarker]';
			}

		},
		{
			id:'differentthemesheading',
			image:'headings.png',
			title:'Heading',
			allowSelection:true,
			generateHtml:function(obj){
				return '[heading style="subheader"]'+obj+'[/heading]';
			}

		},
		{
			id:'differentthemestooltip',
			image:'tooltip.png',
			title:'Tooltip',
			allowSelection:true,
			fields:[{id:'tooltip', name:'Tooltip Text:'},{id:'url', name:'Link:',selesction:true},{id:'target', name:'Button Target', values:['Self', 'Blank']}],
			generateHtml:function(obj){
				return '[tooltip text="'+obj.tooltip+'" url="'+obj.url+'"]'+obj.selection+'[/tooltip]';
			}

		},
		{
			id:'differentthemesicon',
			image:'cool-icons.png',
			title:'Icons',
			allowSelection:false,
			fields:[{id:'icon', name:'Icon', values:['icon-cloud-download','icon-cloud-upload','icon-lightbulb','icon-exchange','icon-bell-alt','icon-file-alt','icon-beer','icon-coffee','icon-food','icon-fighter-jet','icon-user-md','icon-stethoscope','icon-suitcase','icon-building','icon-hospital','icon-ambulance','icon-medkit','icon-h-sign','icon-plus-sign-alt','icon-spinner','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-circle-blank','icon-circle','icon-desktop','icon-laptop','icon-tablet','icon-mobile-phone','icon-quote-left','icon-quote-right','icon-reply','icon-github-alt','icon-folder-close-alt','icon-folder-open-alt','icon-adjust','icon-asterisk','icon-ban-circle','icon-bar-chart','icon-barcode','icon-beaker','icon-beer','icon-bell','icon-bell-alt','icon-bolt','icon-book','icon-bookmark','icon-bookmark-empty','icon-briefcase','icon-bullhorn','icon-calendar','icon-camera','icon-camera-retro','icon-certificate','icon-check','icon-check-empty','icon-circle','icon-circle-blank','icon-cloud','icon-cloud-download','icon-cloud-upload','icon-coffee','icon-cog','icon-cogs','icon-comment','icon-comment-alt','icon-comments','icon-comments-alt','icon-credit-card','icon-dashboard','icon-desktop','icon-download','icon-download-alt','icon-edit','icon-envelope','icon-envelope-alt','icon-exchange','icon-exclamation-sign','icon-external-link','icon-eye-close','icon-eye-open','icon-facetime-video','icon-fighter-jet','icon-film','icon-filter','icon-fire','icon-flag','icon-folder-close','icon-folder-open','icon-folder-close-alt','icon-folder-open-alt','icon-food','icon-gift','icon-glass','icon-globe','icon-group','icon-hdd','icon-headphones','icon-heart','icon-heart-empty','icon-home','icon-inbox','icon-info-sign','icon-key','icon-leaf','icon-laptop','icon-legal','icon-lemon','icon-lightbulb','icon-lock','icon-unlock','icon-magic','icon-magnet','icon-map-marker','icon-minus','icon-minus-sign','icon-mobile-phone','icon-money','icon-move','icon-music','icon-off','icon-ok','icon-ok-circle','icon-ok-sign','icon-pencil','icon-picture','icon-plane','icon-plus','icon-plus-sign','icon-print','icon-pushpin','icon-qrcode','icon-question-sign','icon-quote-left','icon-quote-right','icon-random','icon-refresh','icon-remove','icon-remove-circle','icon-remove-sign','icon-reorder','icon-reply','icon-resize-horizontal','icon-resize-vertical','icon-retweet','icon-road','icon-rss','icon-screenshot','icon-search','icon-share','icon-share-alt','icon-shopping-cart','icon-signal','icon-signin','icon-signout','icon-sitemap','icon-sort','icon-sort-down','icon-sort-up','icon-spinner','icon-star','icon-star-empty','icon-star-half','icon-tablet','icon-tag','icon-tags','icon-tasks','icon-thumbs-down','icon-thumbs-up','icon-time','icon-tint','icon-trash','icon-trophy','icon-truck','icon-umbrella','icon-upload','icon-upload-alt','icon-user','icon-user-md','icon-volume-off','icon-volume-down','icon-volume-up','icon-warning-sign','icon-wrench','icon-zoom-in','icon-zoom-out','icon-file','icon-file-alt','icon-cut','icon-copy','icon-paste','icon-save','icon-undo','icon-repeat','icon-text-height','icon-text-width','icon-align-left','icon-align-center','icon-align-right','icon-align-justify','icon-indent-left','icon-indent-right','icon-font','icon-bold','icon-italic','icon-strikethrough','icon-underline','icon-link','icon-paper-clip','icon-columns','icon-table','icon-th-large','icon-th','icon-th-list','icon-list','icon-list-ol','icon-list-ul','icon-list-alt','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-arrow-down','icon-arrow-left','icon-arrow-right','icon-arrow-up','icon-caret-down','icon-caret-left','icon-caret-right','icon-caret-up','icon-chevron-down','icon-chevron-left','icon-chevron-right','icon-chevron-up','icon-circle-arrow-down','icon-circle-arrow-left','icon-circle-arrow-right','icon-circle-arrow-up','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-hand-down','icon-hand-left','icon-hand-right','icon-hand-up','icon-circle','icon-circle-blank','icon-play-circle','icon-play','icon-pause','icon-stop','icon-step-backward','icon-fast-backward','icon-backward','icon-forward','icon-fast-forward','icon-step-forward','icon-eject','icon-fullscreen','icon-resize-full','icon-resize-small','icon-phone','icon-phone-sign','icon-facebook','icon-facebook-sign','icon-twitter','icon-twitter-sign','icon-github','icon-github-alt','icon-github-sign','icon-linkedin','icon-linkedin-sign','icon-pinterest','icon-pinterest-sign','icon-google-plus','icon-google-plus-sign','icon-sign-blank','icon-ambulance','icon-beaker','icon-h-sign','icon-hospital','icon-medkit','icon-plus-sign-alt','icon-stethoscope','icon-user-md']},{id:'size', name:'Size', values:['Small', 'Medium', 'Large']},{id:'borders', name:'Borders', values:['No', 'Yes']}],
			generateHtml:function(obj){
				return '[icon style="'+obj.icon+'" size="'+obj.size.toLowerCase()+'" borders="'+obj.borders.toLowerCase()+'"]';
			}

		},
		{
			id:'differentthemesdropcaps',
			image:'dropcaps.png',
			title:'Dropcaps',
			allowSelection:true,
			generateHtml:function(obj){
				return '[dropcaps]'+obj+'[/dropcaps]';
			}

		},
		{
			id:'differentthemestables',
			image:'tables.png',
			title:'Create Table',
			allowSelection:false,
			fields:[{id:'table_row', name:'Rows Count'},{id:'table_columns', name:'Columns Count'}],
			generateHtml:function(obj){
				var $rows = obj.table_row;
				var $colomns = obj.table_columns;
				var $table = "<table class=\"table-bordered\">";
				$table += "<thead><tr>";
				for($i=1; $i<=$colomns; $i++) {

					$table += "<th>Main Header "+$i+"</th>";

				}
				$table += "</tr></thead>";
				$table += "<tbody>";

				for($i=1; $i<=$rows; $i++) {
					$table += "<tr>";
					for($ii=1; $ii<=$colomns; $ii++) {

						$table += "<th>Text "+$ii+"</th>";

					}
					$table += "</tr>";
				}

				$table += "</tbody>";
				$table += "</table>";

				return $table;

			}

		},

		{
			id:'differentthemeslist',
			image:'lists.png',
			title:'Lists',
			allowSelection:false,
			fields:[{id:'type-1', name:'Icon', values:['icon-cloud-download','icon-cloud-upload','icon-lightbulb','icon-exchange','icon-bell-alt','icon-file-alt','icon-beer','icon-coffee','icon-food','icon-fighter-jet','icon-user-md','icon-stethoscope','icon-suitcase','icon-building','icon-hospital','icon-ambulance','icon-medkit','icon-h-sign','icon-plus-sign-alt','icon-spinner','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-circle-blank','icon-circle','icon-desktop','icon-laptop','icon-tablet','icon-mobile-phone','icon-quote-left','icon-quote-right','icon-reply','icon-github-alt','icon-folder-close-alt','icon-folder-open-alt','icon-adjust','icon-asterisk','icon-ban-circle','icon-bar-chart','icon-barcode','icon-beaker','icon-beer','icon-bell','icon-bell-alt','icon-bolt','icon-book','icon-bookmark','icon-bookmark-empty','icon-briefcase','icon-bullhorn','icon-calendar','icon-camera','icon-camera-retro','icon-certificate','icon-check','icon-check-empty','icon-circle','icon-circle-blank','icon-cloud','icon-cloud-download','icon-cloud-upload','icon-coffee','icon-cog','icon-cogs','icon-comment','icon-comment-alt','icon-comments','icon-comments-alt','icon-credit-card','icon-dashboard','icon-desktop','icon-download','icon-download-alt','icon-edit','icon-envelope','icon-envelope-alt','icon-exchange','icon-exclamation-sign','icon-external-link','icon-eye-close','icon-eye-open','icon-facetime-video','icon-fighter-jet','icon-film','icon-filter','icon-fire','icon-flag','icon-folder-close','icon-folder-open','icon-folder-close-alt','icon-folder-open-alt','icon-food','icon-gift','icon-glass','icon-globe','icon-group','icon-hdd','icon-headphones','icon-heart','icon-heart-empty','icon-home','icon-inbox','icon-info-sign','icon-key','icon-leaf','icon-laptop','icon-legal','icon-lemon','icon-lightbulb','icon-lock','icon-unlock','icon-magic','icon-magnet','icon-map-marker','icon-minus','icon-minus-sign','icon-mobile-phone','icon-money','icon-move','icon-music','icon-off','icon-ok','icon-ok-circle','icon-ok-sign','icon-pencil','icon-picture','icon-plane','icon-plus','icon-plus-sign','icon-print','icon-pushpin','icon-qrcode','icon-question-sign','icon-quote-left','icon-quote-right','icon-random','icon-refresh','icon-remove','icon-remove-circle','icon-remove-sign','icon-reorder','icon-reply','icon-resize-horizontal','icon-resize-vertical','icon-retweet','icon-road','icon-rss','icon-screenshot','icon-search','icon-share','icon-share-alt','icon-shopping-cart','icon-signal','icon-signin','icon-signout','icon-sitemap','icon-sort','icon-sort-down','icon-sort-up','icon-spinner','icon-star','icon-star-empty','icon-star-half','icon-tablet','icon-tag','icon-tags','icon-tasks','icon-thumbs-down','icon-thumbs-up','icon-time','icon-tint','icon-trash','icon-trophy','icon-truck','icon-umbrella','icon-upload','icon-upload-alt','icon-user','icon-user-md','icon-volume-off','icon-volume-down','icon-volume-up','icon-warning-sign','icon-wrench','icon-zoom-in','icon-zoom-out','icon-file','icon-file-alt','icon-cut','icon-copy','icon-paste','icon-save','icon-undo','icon-repeat','icon-text-height','icon-text-width','icon-align-left','icon-align-center','icon-align-right','icon-align-justify','icon-indent-left','icon-indent-right','icon-font','icon-bold','icon-italic','icon-strikethrough','icon-underline','icon-link','icon-paper-clip','icon-columns','icon-table','icon-th-large','icon-th','icon-th-list','icon-list','icon-list-ol','icon-list-ul','icon-list-alt','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-arrow-down','icon-arrow-left','icon-arrow-right','icon-arrow-up','icon-caret-down','icon-caret-left','icon-caret-right','icon-caret-up','icon-chevron-down','icon-chevron-left','icon-chevron-right','icon-chevron-up','icon-circle-arrow-down','icon-circle-arrow-left','icon-circle-arrow-right','icon-circle-arrow-up','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-hand-down','icon-hand-left','icon-hand-right','icon-hand-up','icon-circle','icon-circle-blank','icon-play-circle','icon-play','icon-pause','icon-stop','icon-step-backward','icon-fast-backward','icon-backward','icon-forward','icon-fast-forward','icon-step-forward','icon-eject','icon-fullscreen','icon-resize-full','icon-resize-small','icon-phone','icon-phone-sign','icon-facebook','icon-facebook-sign','icon-twitter','icon-twitter-sign','icon-github','icon-github-alt','icon-github-sign','icon-linkedin','icon-linkedin-sign','icon-pinterest','icon-pinterest-sign','icon-google-plus','icon-google-plus-sign','icon-sign-blank','icon-ambulance','icon-beaker','icon-h-sign','icon-hospital','icon-medkit','icon-plus-sign-alt','icon-stethoscope','icon-user-md']},{id:'lists', name:'Text', lists:true}],
			generateHtml:function(obj){
				var x = jQuery('#df-lists').val();  
				var output = '[list]';
				for(e = 1; e <= x; e++) {
					var icon = jQuery('#differentthemes-shortcode-type-'+e).val().toLowerCase()
				
				
					output+= '[item icon="'+icon+'"]';
					output+= jQuery('#differentthemes-shortcode-lists-'+e).val();
					output+= '[/item]';
				}
				output+="[/list]";
				
				return output;
			}
		},
		{
			id:'differentthemessocial',
			image:'social.png',
			title:'Social Icons',
			allowSelection:false,
			fields:[{id:'type-1', name:'Type', values:['AddThis', 'Behance', 'Blogger', 'Delicious', 'Deviantart', 'Digg', 'Dopplr', 'Dribbble', 'Evernote', 'Facebook', 'Flickr', 'Forrst', 'Github', 'Google', 'Grooveshark', 'Instagram', 'Lastfm', 'Linkedin', 'Mail', 'Myspace', 'Paypal', 'Picasa', 'Pinterest', 'Posterous', 'Reddit', 'Rss', 'Sharethis', 'Skype', 'Soundcloud', 'Spotify', 'Stumbleupon', 'Tumblr', 'Viddler', 'Vimeo', 'Virb', 'Windows', 'Wordpress', 'Youtube', 'Twitter']},{id:'social', name:'Account Url', social:true}],
			generateHtml:function(obj){
				var x = jQuery('#df-social').val();  
				var output = '[social]';
				for(e = 1; e <= x; e++) {
					var icon = jQuery('#differentthemes-shortcode-type-'+e).val().toLowerCase()
				
				
					output+= '[account icon="'+icon+'" ]';
					output+= jQuery('#differentthemes-shortcode-social-'+e).val();
					output+= '[/account]';
				}
				output+="[/social]";
				
				return output;
			}
		},		
		{
			id:'differentthemespricing',
			image:'pricing-columns.png',
			title:'Pricing Table',
			allowSelection:false,
			fields:[{id:'title', name:'Title'},{id:'tooltip', name:'Tooltip'},{id:'price', name:'Price'},{id:'subtitle', name:'Sub Title'},{id:'list', name:'List', unlimitedinput:true},{id:'btntext', name:'Button Text'},{id:'href', name:'Button Link'},{id:'target', name:'Button Target', values:['Self', 'Blank']},{id:'color', name:'Button Color', values:['Blue', 'Red', 'Orange', 'Purple', 'Black', 'Green']}],
			generateHtml:function(obj){
				var x = jQuery('#df-list').val();  

				var output = '[pricing tooltip="'+obj.tooltip+'" title="'+obj.title+'" price="'+obj.price+'" subtitle="'+obj.subtitle+'" btntext="'+obj.btntext+'" url="'+obj.href+'" target="'+obj.target.toLowerCase()+'" color="'+obj.color.toLowerCase()+'"]';
				for(e = 1; e <= x; e++) {
					output+=jQuery('#differentthemes-shortcode-list-'+e).val()+",";
				}

				output+="[/pricing]";
				
				return output;

			}
		},
		{
			id:'differentthemestabs',
			image:'tabs.png',
			title:'Insert Tabs',
			allowSelection:false,
			fields:[{id:'title-1', name:'Title: '},{id:'text', name:'Text: ', tabs:true}],
			generateHtml:function(obj){
				var x = jQuery('#df-tabs').val();  
				var output = '[tabs ';
				for(e = 1; e <= x; e++) {
					output+= 'title'+e+'="'+jQuery('#differentthemes-shortcode-title-'+e).val()+'" ';
					output+= 'text'+e+'="'+jQuery('#differentthemes-shortcode-text-'+e).val()+'" ';
				}
				output+="]";
				
				return output;
			}
		},
		{
			id:'differentthemesskillbar',
			image:'skill-bar.png',
			title:'Skill Bar',
			allowSelection:false,
			fields:[{id:'title-1', name:'Skill Title: '},{id:'level', name:'Skill Level in Percentage: ', skill:true}],
			generateHtml:function(obj){
				var x = jQuery('#df-skill').val();  
				var output = '[skill ';
				for(e = 1; e <= x; e++) {
					output+= 'title'+e+'="'+jQuery('#differentthemes-shortcode-title-'+e).val()+'" ';
					output+= 'level'+e+'="'+jQuery('#differentthemes-shortcode-level-'+e).val()+'" ';
				}
				output+="]";
				
				return output;
			}
		},
		{
			id:'differentthemestoggles',
			image:'toggle.png',
			title:'Toggles',
			allowSelection:false,
			fields:[{id:'title', name:'Title: '},{id:'icon', name:'Icon', values:['icon-cloud-download','icon-cloud-upload','icon-lightbulb','icon-exchange','icon-bell-alt','icon-file-alt','icon-beer','icon-coffee','icon-food','icon-fighter-jet','icon-user-md','icon-stethoscope','icon-suitcase','icon-building','icon-hospital','icon-ambulance','icon-medkit','icon-h-sign','icon-plus-sign-alt','icon-spinner','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-circle-blank','icon-circle','icon-desktop','icon-laptop','icon-tablet','icon-mobile-phone','icon-quote-left','icon-quote-right','icon-reply','icon-github-alt','icon-folder-close-alt','icon-folder-open-alt','icon-adjust','icon-asterisk','icon-ban-circle','icon-bar-chart','icon-barcode','icon-beaker','icon-beer','icon-bell','icon-bell-alt','icon-bolt','icon-book','icon-bookmark','icon-bookmark-empty','icon-briefcase','icon-bullhorn','icon-calendar','icon-camera','icon-camera-retro','icon-certificate','icon-check','icon-check-empty','icon-circle','icon-circle-blank','icon-cloud','icon-cloud-download','icon-cloud-upload','icon-coffee','icon-cog','icon-cogs','icon-comment','icon-comment-alt','icon-comments','icon-comments-alt','icon-credit-card','icon-dashboard','icon-desktop','icon-download','icon-download-alt','icon-edit','icon-envelope','icon-envelope-alt','icon-exchange','icon-exclamation-sign','icon-external-link','icon-eye-close','icon-eye-open','icon-facetime-video','icon-fighter-jet','icon-film','icon-filter','icon-fire','icon-flag','icon-folder-close','icon-folder-open','icon-folder-close-alt','icon-folder-open-alt','icon-food','icon-gift','icon-glass','icon-globe','icon-group','icon-hdd','icon-headphones','icon-heart','icon-heart-empty','icon-home','icon-inbox','icon-info-sign','icon-key','icon-leaf','icon-laptop','icon-legal','icon-lemon','icon-lightbulb','icon-lock','icon-unlock','icon-magic','icon-magnet','icon-map-marker','icon-minus','icon-minus-sign','icon-mobile-phone','icon-money','icon-move','icon-music','icon-off','icon-ok','icon-ok-circle','icon-ok-sign','icon-pencil','icon-picture','icon-plane','icon-plus','icon-plus-sign','icon-print','icon-pushpin','icon-qrcode','icon-question-sign','icon-quote-left','icon-quote-right','icon-random','icon-refresh','icon-remove','icon-remove-circle','icon-remove-sign','icon-reorder','icon-reply','icon-resize-horizontal','icon-resize-vertical','icon-retweet','icon-road','icon-rss','icon-screenshot','icon-search','icon-share','icon-share-alt','icon-shopping-cart','icon-signal','icon-signin','icon-signout','icon-sitemap','icon-sort','icon-sort-down','icon-sort-up','icon-spinner','icon-star','icon-star-empty','icon-star-half','icon-tablet','icon-tag','icon-tags','icon-tasks','icon-thumbs-down','icon-thumbs-up','icon-time','icon-tint','icon-trash','icon-trophy','icon-truck','icon-umbrella','icon-upload','icon-upload-alt','icon-user','icon-user-md','icon-volume-off','icon-volume-down','icon-volume-up','icon-warning-sign','icon-wrench','icon-zoom-in','icon-zoom-out','icon-file','icon-file-alt','icon-cut','icon-copy','icon-paste','icon-save','icon-undo','icon-repeat','icon-text-height','icon-text-width','icon-align-left','icon-align-center','icon-align-right','icon-align-justify','icon-indent-left','icon-indent-right','icon-font','icon-bold','icon-italic','icon-strikethrough','icon-underline','icon-link','icon-paper-clip','icon-columns','icon-table','icon-th-large','icon-th','icon-th-list','icon-list','icon-list-ol','icon-list-ul','icon-list-alt','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-arrow-down','icon-arrow-left','icon-arrow-right','icon-arrow-up','icon-caret-down','icon-caret-left','icon-caret-right','icon-caret-up','icon-chevron-down','icon-chevron-left','icon-chevron-right','icon-chevron-up','icon-circle-arrow-down','icon-circle-arrow-left','icon-circle-arrow-right','icon-circle-arrow-up','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-hand-down','icon-hand-left','icon-hand-right','icon-hand-up','icon-circle','icon-circle-blank','icon-play-circle','icon-play','icon-pause','icon-stop','icon-step-backward','icon-fast-backward','icon-backward','icon-forward','icon-fast-forward','icon-step-forward','icon-eject','icon-fullscreen','icon-resize-full','icon-resize-small','icon-phone','icon-phone-sign','icon-facebook','icon-facebook-sign','icon-twitter','icon-twitter-sign','icon-github','icon-github-alt','icon-github-sign','icon-linkedin','icon-linkedin-sign','icon-pinterest','icon-pinterest-sign','icon-google-plus','icon-google-plus-sign','icon-sign-blank','icon-ambulance','icon-beaker','icon-h-sign','icon-hospital','icon-medkit','icon-plus-sign-alt','icon-stethoscope','icon-user-md']},{id:'text', name:'Text: ', textarea:true}],
			generateHtml:function(obj){
				var output = '[toggles title="'+obj.title+'" icon="'+obj.icon+'"]'+obj.text+'[/toggles]';
				
				return output;
			}
		},

		
];

/**
 * Contains the main formatting buttons functionality.
 */
differentthemesButtonManager={
	dialog:null,
	idprefix:'differentthemes-shortcode-',
	ie:false,
	opera:false,
		
	/**
	 * Init the formatting button functionality.
	 */
	init:function(){
			
		var length=differentthemesButtons.length;
		for(var i=0; i<length; i++){
		
			var btn = differentthemesButtons[i];
			differentthemesButtonManager.loadButton(btn);
			
		}
		
		if ( jQuery.browser.msie ) {
			differentthemesButtonManager.ie=true;
		}
		
		if (jQuery.browser.opera){
			differentthemesButtonManager.opera=true;
		}
		
	},
	
	/**
	 * Loads a button and sets the functionality that is executed when the button has been clicked.
	 */
	loadButton:function(btn){
		
		tinymce.create('tinymce.plugins.'+btn.id, {
	        init : function(ed, url) {
			        ed.addButton(btn.id, {
	                title : btn.title,
	                image : url+'/buttons/'+btn.image,
	                onclick : function() {
			        	
			           var selection = ed.selection.getContent();
	                   if(btn.allowSelection && selection && btn.fields){
							
	                	   //there are inputs to fill in, show a dialog to fill the required data
	                	   differentthemesButtonManager.showDialog(btn, ed);
	                   }else if(btn.allowSelection && selection){
							
	                	   //modification via selection is allowed for this button and some text has been selected
							selection = btn.generateHtml(selection);
							ed.selection.setContent(selection);
	                   }else if(btn.fields){
	                	   //there are inputs to fill in, show a dialog to fill the required data
	                	   differentthemesButtonManager.showDialog(btn, ed);
	                   }else if(btn.list){
	                	   ed.dom.remove('differentthemescaret');
		           		    ed.execCommand('mceInsertContent', false, '&nbsp;');	
	           			
	                	    //this is a list
	                	    var list, dom = ed.dom, sel = ed.selection;
	                	    
		               		// Check for existing list element
		               		list = dom.getParent(sel.getNode(), 'ul');
		               		
		               		// Switch/add list type if needed
		               		ed.execCommand('InsertUnorderedList');
		               		
		               		// Append styles to new list element
		               		list = dom.getParent(sel.getNode(), 'ul');
		               		
		               		if (list) {
		               			dom.addClass(list, btn.list);
		               		}
	                   }else{
	                	   //no data is required for this button, insert the generated HTML
	                	   ed.execCommand('mceInsertContent', true, btn.generateHtml());
	                   }
					  
					   addLoadEvent(jscolor.init);

	                }
	            });
	        }
	    });
		
	    tinymce.PluginManager.add(btn.id, tinymce.plugins[btn.id]);
	},
	
	/**
	 * Displays a dialog that contains fields for inserting the data needed for the button.
	 */
	showDialog:function(btn, ed){
		
		
		if(differentthemesButtonManager.ie){
			ed.dom.remove('differentthemescaret');
		    var caret = '<div id="differentthemescaret">&nbsp;</div>';
		    ed.execCommand('mceInsertContent', false, caret);	
			var selection = ed.selection;
		}
	    
		var html='<div>';
		var selection = ed.selection;
		var selectedvalue = ed.selection.getContent();
		
		for(var i=0, length=btn.fields.length; i<length; i++){
			var field=btn.fields[i], inputHtml='';
			if(btn.fields[i].selesction){
				//this field should be a text area
				if(selectedvalue){ 
					// unlimited input
					html+='<div class="differentthemes-shortcode-field"><label>Selected Text</label><input type="text" value="'+selectedvalue+'" id="'+differentthemesButtonManager.idprefix+"selection"+'"></div><div>';
				} 
				
			}
			if(btn.fields[i].colorpalette){
				//this field should be a text area
				inputHtml+='<input type="text" class="color" value="'+btn.fields[i].color+'" id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'">';
				
			} else if (btn.fields[i].values){
				//this is a select list
				inputHtml='<select id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'">';
				jQuery.each(btn.fields[i].values, function(index, value){
					inputHtml+='<option value="'+value+'">'+value+'</option>';
				});
				inputHtml+='</select>';
			} else {
				if(btn.fields[i].textarea && !differentthemesButtonManager.opera){
					//this field should be a text area
					inputHtml='<textarea id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'" ></textarea>';
				} else if(btn.fields[i].unlimitedinput && !differentthemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<input type="text" class="otlist" id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'-1" /><input type="text" id="df-list" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				} else if(btn.fields[i].lists && !differentthemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<input type="text" class="lists" id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'-1" /><input type="text" id="df-lists" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				} else if(btn.fields[i].social && !differentthemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<input type="text" class="social" id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'-1" /><input type="text" id="df-social" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				} else if(btn.fields[i].tabs && !differentthemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<textarea id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'-1"  class="tabs" ></textarea><input type="text" id="df-tabs" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				} else if(btn.fields[i].team && !differentthemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<input type="text" class="team" id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'-1" /><input type="text" id="df-team" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				} else if(btn.fields[i].skill && !differentthemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<input type="text" id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'-1"  class="skill" ><input type="text" id="df-skill" value="1" hidden /><br /><br /><br /><strong>To add new field press Enter</strong>';
				} else{
					//this field should be a normal input
					inputHtml='<input type="text" id="'+differentthemesButtonManager.idprefix+btn.fields[i].id+'" />';
				}
			}
			html+='<div class="differentthemes-shortcode-field"><label>'+btn.fields[i].name+'</label>'+inputHtml+'</div>';
		}
		html+='<a href="" id="insertbtn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Insert</span></a></div>';
				
		var dialog = jQuery(html).dialog({
							dialogClass: "different-themes",
							 title:btn.title, 
							 modal:true,
							 close:function(event, ui){
								jQuery(this).html('').remove();
							 }
							 });
		
		differentthemesButtonManager.dialog=dialog;
		
		//set a click handler to the insert button
		dialog.find('#insertbtn').click(function(event){
			event.preventDefault();
			differentthemesButtonManager.executeCommand(ed,btn,selection);
		});

			dialog.keyup(function(){
			  if(event.keyCode == 13 && jQuery(".otlist").is(":focus")) {
				var i = jQuery('#df-list').val();
				var n = Number(i)+Number(1);
				jQuery('<input type="text" class="otlist" id="differentthemes-shortcode-list-'+n+'" />').insertAfter("#differentthemes-shortcode-list-"+i);    
				jQuery('#df-list').val(n);
			  }
			});
			
			dialog.keyup(function(){
				if(event.keyCode == 13 && jQuery(".tabs").is(":focus") && jQuery('#df-tabs').val() <5) {
					var i = jQuery('#df-tabs').val();
					var n = Number(i)+Number(1);
					jQuery('<div class="differentthemes-shortcode-field"><label>Title: </label><input type="text" id="differentthemes-shortcode-title-'+n+'"></div><div class="differentthemes-shortcode-field"><label>Text: </label><textarea id="differentthemes-shortcode-text-'+n+'" class="tabs"></textarea></div>').insertBefore("#insertbtn");    
					jQuery('#df-tabs').val(n);
				}
			});		

			dialog.keyup(function(){
			  if(event.keyCode == 13 && jQuery(".team").is(":focus")) {
				var i = jQuery('#df-team').val();
				var n = Number(i)+Number(1);
				jQuery('<div class="differentthemes-shortcode-field"><label>Social</label><select id="differentthemes-shortcode-social-'+n+'"><option value="AddThis">AddThis</option><option value="Behance">Behance</option><option value="Blogger">Blogger</option><option value="Delicious">Delicious</option><option value="Deviantart">Deviantart</option><option value="Digg">Digg</option><option value="Dopplr">Dopplr</option><option value="Dribbble">Dribbble</option><option value="Evernote">Evernote</option><option value="Facebook">Facebook</option><option value="Flickr">Flickr</option><option value="Forrst">Forrst</option><option value="Github">Github</option><option value="Google">Google</option><option value="Grooveshark">Grooveshark</option><option value="Instagram">Instagram</option><option value="Lastfm">Lastfm</option><option value="Linkedin">Linkedin</option><option value="Mail">Mail</option><option value="Myspace">Myspace</option><option value="Paypal">Paypal</option><option value="Picasa">Picasa</option><option value="Pinterest">Pinterest</option><option value="Posterous">Posterous</option><option value="Reddit">Reddit</option><option value="Rss">Rss</option><option value="Sharethis">Sharethis</option><option value="Skype">Skype</option><option value="Soundcloud">Soundcloud</option><option value="Spotify">Spotify</option><option value="Stumbleupon">Stumbleupon</option><option value="Tumblr">Tumblr</option><option value="Viddler">Viddler</option><option value="Vimeo">Vimeo</option><option value="Virb">Virb</option><option value="Windows">Windows</option><option value="Wordpress">Wordpress</option><option value="Youtube">Youtube</option><option value="Twitter">Twitter</option></select></div><div class="differentthemes-shortcode-field"><label>URL</label><input type="text" class="team" id="differentthemes-shortcode-url-'+n+'"></div>').insertBefore("#insertbtn");    
				jQuery('#df-team').val(n);
			  }
			});
			
			dialog.keyup(function(){
				if(event.keyCode == 13 && jQuery(".skill").is(":focus") && jQuery('#df-skill').val() <5) {
					var i = jQuery('#df-skill').val();
					var n = Number(i)+Number(1);
					jQuery('<div class="differentthemes-shortcode-field"><label>Skill Title: </label><input type="text" id="differentthemes-shortcode-title-'+n+'"></div><div class="differentthemes-shortcode-field"><label>Skill Level in Precentage: </label><input type="text" id="differentthemes-shortcode-level-'+n+'" class="skill"></div>').insertBefore("#insertbtn");    
					jQuery('#df-skill').val(n);
				}
			});
			
			dialog.keyup(function(){
				if(event.keyCode == 13 && jQuery(".lists").is(":focus")) {
					var i = jQuery('#df-lists').val();
					var n = Number(i)+Number(1);
					jQuery('<div class="differentthemes-shortcode-field"><label>Type</label><select id="differentthemes-shortcode-type-'+n+'"><option value="icon-cloud-download">icon-cloud-download</option><option value="icon-cloud-upload">icon-cloud-upload</option><option value="icon-lightbulb">icon-lightbulb</option><option value="icon-exchange">icon-exchange</option><option value="icon-bell-alt">icon-bell-alt</option><option value="icon-file-alt">icon-file-alt</option><option value="icon-beer">icon-beer</option><option value="icon-coffee">icon-coffee</option><option value="icon-food">icon-food</option><option value="icon-fighter-jet">icon-fighter-jet</option><option value="icon-user-md">icon-user-md</option><option value="icon-stethoscope">icon-stethoscope</option><option value="icon-suitcase">icon-suitcase</option><option value="icon-building">icon-building</option><option value="icon-hospital">icon-hospital</option><option value="icon-ambulance">icon-ambulance</option><option value="icon-medkit">icon-medkit</option><option value="icon-h-sign">icon-h-sign</option><option value="icon-plus-sign-alt">icon-plus-sign-alt</option><option value="icon-spinner">icon-spinner</option><option value="icon-angle-left">icon-angle-left</option><option value="icon-angle-right">icon-angle-right</option><option value="icon-angle-up">icon-angle-up</option><option value="icon-angle-down">icon-angle-down</option><option value="icon-double-angle-left">icon-double-angle-left</option><option value="icon-double-angle-right">icon-double-angle-right</option><option value="icon-double-angle-up">icon-double-angle-up</option><option value="icon-double-angle-down">icon-double-angle-down</option><option value="icon-circle-blank">icon-circle-blank</option><option value="icon-circle">icon-circle</option><option value="icon-desktop">icon-desktop</option><option value="icon-laptop">icon-laptop</option><option value="icon-tablet">icon-tablet</option><option value="icon-mobile-phone">icon-mobile-phone</option><option value="icon-quote-left">icon-quote-left</option><option value="icon-quote-right">icon-quote-right</option><option value="icon-reply">icon-reply</option><option value="icon-github-alt">icon-github-alt</option><option value="icon-folder-close-alt">icon-folder-close-alt</option><option value="icon-folder-open-alt">icon-folder-open-alt</option><option value="icon-adjust">icon-adjust</option><option value="icon-asterisk">icon-asterisk</option><option value="icon-ban-circle">icon-ban-circle</option><option value="icon-bar-chart">icon-bar-chart</option><option value="icon-barcode">icon-barcode</option><option value="icon-beaker">icon-beaker</option><option value="icon-beer">icon-beer</option><option value="icon-bell">icon-bell</option><option value="icon-bell-alt">icon-bell-alt</option><option value="icon-bolt">icon-bolt</option><option value="icon-book">icon-book</option><option value="icon-bookmark">icon-bookmark</option><option value="icon-bookmark-empty">icon-bookmark-empty</option><option value="icon-briefcase">icon-briefcase</option><option value="icon-bullhorn">icon-bullhorn</option><option value="icon-calendar">icon-calendar</option><option value="icon-camera">icon-camera</option><option value="icon-camera-retro">icon-camera-retro</option><option value="icon-certificate">icon-certificate</option><option value="icon-check">icon-check</option><option value="icon-check-empty">icon-check-empty</option><option value="icon-circle">icon-circle</option><option value="icon-circle-blank">icon-circle-blank</option><option value="icon-cloud">icon-cloud</option><option value="icon-cloud-download">icon-cloud-download</option><option value="icon-cloud-upload">icon-cloud-upload</option><option value="icon-coffee">icon-coffee</option><option value="icon-cog">icon-cog</option><option value="icon-cogs">icon-cogs</option><option value="icon-comment">icon-comment</option><option value="icon-comment-alt">icon-comment-alt</option><option value="icon-comments">icon-comments</option><option value="icon-comments-alt">icon-comments-alt</option><option value="icon-credit-card">icon-credit-card</option><option value="icon-dashboard">icon-dashboard</option><option value="icon-desktop">icon-desktop</option><option value="icon-download">icon-download</option><option value="icon-download-alt">icon-download-alt</option><option value="icon-edit">icon-edit</option><option value="icon-envelope">icon-envelope</option><option value="icon-envelope-alt">icon-envelope-alt</option><option value="icon-exchange">icon-exchange</option><option value="icon-exclamation-sign">icon-exclamation-sign</option><option value="icon-external-link">icon-external-link</option><option value="icon-eye-close">icon-eye-close</option><option value="icon-eye-open">icon-eye-open</option><option value="icon-facetime-video">icon-facetime-video</option><option value="icon-fighter-jet">icon-fighter-jet</option><option value="icon-film">icon-film</option><option value="icon-filter">icon-filter</option><option value="icon-fire">icon-fire</option><option value="icon-flag">icon-flag</option><option value="icon-folder-close">icon-folder-close</option><option value="icon-folder-open">icon-folder-open</option><option value="icon-folder-close-alt">icon-folder-close-alt</option><option value="icon-folder-open-alt">icon-folder-open-alt</option><option value="icon-food">icon-food</option><option value="icon-gift">icon-gift</option><option value="icon-glass">icon-glass</option><option value="icon-globe">icon-globe</option><option value="icon-group">icon-group</option><option value="icon-hdd">icon-hdd</option><option value="icon-headphones">icon-headphones</option><option value="icon-heart">icon-heart</option><option value="icon-heart-empty">icon-heart-empty</option><option value="icon-home">icon-home</option><option value="icon-inbox">icon-inbox</option><option value="icon-info-sign">icon-info-sign</option><option value="icon-key">icon-key</option><option value="icon-leaf">icon-leaf</option><option value="icon-laptop">icon-laptop</option><option value="icon-legal">icon-legal</option><option value="icon-lemon">icon-lemon</option><option value="icon-lightbulb">icon-lightbulb</option><option value="icon-lock">icon-lock</option><option value="icon-unlock">icon-unlock</option><option value="icon-magic">icon-magic</option><option value="icon-magnet">icon-magnet</option><option value="icon-map-marker">icon-map-marker</option><option value="icon-minus">icon-minus</option><option value="icon-minus-sign">icon-minus-sign</option><option value="icon-mobile-phone">icon-mobile-phone</option><option value="icon-money">icon-money</option><option value="icon-move">icon-move</option><option value="icon-music">icon-music</option><option value="icon-off">icon-off</option><option value="icon-ok">icon-ok</option><option value="icon-ok-circle">icon-ok-circle</option><option value="icon-ok-sign">icon-ok-sign</option><option value="icon-pencil">icon-pencil</option><option value="icon-picture">icon-picture</option><option value="icon-plane">icon-plane</option><option value="icon-plus">icon-plus</option><option value="icon-plus-sign">icon-plus-sign</option><option value="icon-print">icon-print</option><option value="icon-pushpin">icon-pushpin</option><option value="icon-qrcode">icon-qrcode</option><option value="icon-question-sign">icon-question-sign</option><option value="icon-quote-left">icon-quote-left</option><option value="icon-quote-right">icon-quote-right</option><option value="icon-random">icon-random</option><option value="icon-refresh">icon-refresh</option><option value="icon-remove">icon-remove</option><option value="icon-remove-circle">icon-remove-circle</option><option value="icon-remove-sign">icon-remove-sign</option><option value="icon-reorder">icon-reorder</option><option value="icon-reply">icon-reply</option><option value="icon-resize-horizontal">icon-resize-horizontal</option><option value="icon-resize-vertical">icon-resize-vertical</option><option value="icon-retweet">icon-retweet</option><option value="icon-road">icon-road</option><option value="icon-rss">icon-rss</option><option value="icon-screenshot">icon-screenshot</option><option value="icon-search">icon-search</option><option value="icon-share">icon-share</option><option value="icon-share-alt">icon-share-alt</option><option value="icon-shopping-cart">icon-shopping-cart</option><option value="icon-signal">icon-signal</option><option value="icon-signin">icon-signin</option><option value="icon-signout">icon-signout</option><option value="icon-sitemap">icon-sitemap</option><option value="icon-sort">icon-sort</option><option value="icon-sort-down">icon-sort-down</option><option value="icon-sort-up">icon-sort-up</option><option value="icon-spinner">icon-spinner</option><option value="icon-star">icon-star</option><option value="icon-star-empty">icon-star-empty</option><option value="icon-star-half">icon-star-half</option><option value="icon-tablet">icon-tablet</option><option value="icon-tag">icon-tag</option><option value="icon-tags">icon-tags</option><option value="icon-tasks">icon-tasks</option><option value="icon-thumbs-down">icon-thumbs-down</option><option value="icon-thumbs-up">icon-thumbs-up</option><option value="icon-time">icon-time</option><option value="icon-tint">icon-tint</option><option value="icon-trash">icon-trash</option><option value="icon-trophy">icon-trophy</option><option value="icon-truck">icon-truck</option><option value="icon-umbrella">icon-umbrella</option><option value="icon-upload">icon-upload</option><option value="icon-upload-alt">icon-upload-alt</option><option value="icon-user">icon-user</option><option value="icon-user-md">icon-user-md</option><option value="icon-volume-off">icon-volume-off</option><option value="icon-volume-down">icon-volume-down</option><option value="icon-volume-up">icon-volume-up</option><option value="icon-warning-sign">icon-warning-sign</option><option value="icon-wrench">icon-wrench</option><option value="icon-zoom-in">icon-zoom-in</option><option value="icon-zoom-out">icon-zoom-out</option><option value="icon-file">icon-file</option><option value="icon-file-alt">icon-file-alt</option><option value="icon-cut">icon-cut</option><option value="icon-copy">icon-copy</option><option value="icon-paste">icon-paste</option><option value="icon-save">icon-save</option><option value="icon-undo">icon-undo</option><option value="icon-repeat">icon-repeat</option><option value="icon-text-height">icon-text-height</option><option value="icon-text-width">icon-text-width</option><option value="icon-align-left">icon-align-left</option><option value="icon-align-center">icon-align-center</option><option value="icon-align-right">icon-align-right</option><option value="icon-align-justify">icon-align-justify</option><option value="icon-indent-left">icon-indent-left</option><option value="icon-indent-right">icon-indent-right</option><option value="icon-font">icon-font</option><option value="icon-bold">icon-bold</option><option value="icon-italic">icon-italic</option><option value="icon-strikethrough">icon-strikethrough</option><option value="icon-underline">icon-underline</option><option value="icon-link">icon-link</option><option value="icon-paper-clip">icon-paper-clip</option><option value="icon-columns">icon-columns</option><option value="icon-table">icon-table</option><option value="icon-th-large">icon-th-large</option><option value="icon-th">icon-th</option><option value="icon-th-list">icon-th-list</option><option value="icon-list">icon-list</option><option value="icon-list-ol">icon-list-ol</option><option value="icon-list-ul">icon-list-ul</option><option value="icon-list-alt">icon-list-alt</option><option value="icon-angle-left">icon-angle-left</option><option value="icon-angle-right">icon-angle-right</option><option value="icon-angle-up">icon-angle-up</option><option value="icon-angle-down">icon-angle-down</option><option value="icon-arrow-down">icon-arrow-down</option><option value="icon-arrow-left">icon-arrow-left</option><option value="icon-arrow-right">icon-arrow-right</option><option value="icon-arrow-up">icon-arrow-up</option><option value="icon-caret-down">icon-caret-down</option><option value="icon-caret-left">icon-caret-left</option><option value="icon-caret-right">icon-caret-right</option><option value="icon-caret-up">icon-caret-up</option><option value="icon-chevron-down">icon-chevron-down</option><option value="icon-chevron-left">icon-chevron-left</option><option value="icon-chevron-right">icon-chevron-right</option><option value="icon-chevron-up">icon-chevron-up</option><option value="icon-circle-arrow-down">icon-circle-arrow-down</option><option value="icon-circle-arrow-left">icon-circle-arrow-left</option><option value="icon-circle-arrow-right">icon-circle-arrow-right</option><option value="icon-circle-arrow-up">icon-circle-arrow-up</option><option value="icon-double-angle-left">icon-double-angle-left</option><option value="icon-double-angle-right">icon-double-angle-right</option><option value="icon-double-angle-up">icon-double-angle-up</option><option value="icon-double-angle-down">icon-double-angle-down</option><option value="icon-hand-down">icon-hand-down</option><option value="icon-hand-left">icon-hand-left</option><option value="icon-hand-right">icon-hand-right</option><option value="icon-hand-up">icon-hand-up</option><option value="icon-circle">icon-circle</option><option value="icon-circle-blank">icon-circle-blank</option><option value="icon-play-circle">icon-play-circle</option><option value="icon-play">icon-play</option><option value="icon-pause">icon-pause</option><option value="icon-stop">icon-stop</option><option value="icon-step-backward">icon-step-backward</option><option value="icon-fast-backward">icon-fast-backward</option><option value="icon-backward">icon-backward</option><option value="icon-forward">icon-forward</option><option value="icon-fast-forward">icon-fast-forward</option><option value="icon-step-forward">icon-step-forward</option><option value="icon-eject">icon-eject</option><option value="icon-fullscreen">icon-fullscreen</option><option value="icon-resize-full">icon-resize-full</option><option value="icon-resize-small">icon-resize-small</option><option value="icon-phone">icon-phone</option><option value="icon-phone-sign">icon-phone-sign</option><option value="icon-facebook">icon-facebook</option><option value="icon-facebook-sign">icon-facebook-sign</option><option value="icon-twitter">icon-twitter</option><option value="icon-twitter-sign">icon-twitter-sign</option><option value="icon-github">icon-github</option><option value="icon-github-alt">icon-github-alt</option><option value="icon-github-sign">icon-github-sign</option><option value="icon-linkedin">icon-linkedin</option><option value="icon-linkedin-sign">icon-linkedin-sign</option><option value="icon-pinterest">icon-pinterest</option><option value="icon-pinterest-sign">icon-pinterest-sign</option><option value="icon-google-plus">icon-google-plus</option><option value="icon-google-plus-sign">icon-google-plus-sign</option><option value="icon-sign-blank">icon-sign-blank</option><option value="icon-ambulance">icon-ambulance</option><option value="icon-beaker">icon-beaker</option><option value="icon-h-sign">icon-h-sign</option><option value="icon-hospital">icon-hospital</option><option value="icon-medkit">icon-medkit</option><option value="icon-plus-sign-alt">icon-plus-sign-alt</option><option value="icon-stethoscope">icon-stethoscope</option><option value="icon-user-md">icon-user-md</option></select></div><div class="differentthemes-shortcode-field"><label>Text</label><input type="text" class="lists" id="differentthemes-shortcode-lists-'+n+'"></div>').insertBefore("#insertbtn");    
					jQuery('#df-lists').val(n);
				}
			});			
			dialog.keyup(function(){
				if(event.keyCode == 13 && jQuery(".social").is(":focus")) {
					var i = jQuery('#df-social').val();
					var n = Number(i)+Number(1);
					jQuery('<div class="differentthemes-shortcode-field"><label>Type</label><select id="differentthemes-shortcode-type-'+n+'"><option value="AddThis">AddThis</option><option value="Behance">Behance</option><option value="Blogger">Blogger</option><option value="Delicious">Delicious</option><option value="Deviantart">Deviantart</option><option value="Digg">Digg</option><option value="Dopplr">Dopplr</option><option value="Dribbble">Dribbble</option><option value="Evernote">Evernote</option><option value="Facebook">Facebook</option><option value="Flickr">Flickr</option><option value="Forrst">Forrst</option><option value="Github">Github</option><option value="Google">Google</option><option value="Grooveshark">Grooveshark</option><option value="Instagram">Instagram</option><option value="Lastfm">Lastfm</option><option value="Linkedin">Linkedin</option><option value="Mail">Mail</option><option value="Myspace">Myspace</option><option value="Paypal">Paypal</option><option value="Picasa">Picasa</option><option value="Pinterest">Pinterest</option><option value="Posterous">Posterous</option><option value="Reddit">Reddit</option><option value="Rss">Rss</option><option value="Sharethis">Sharethis</option><option value="Skype">Skype</option><option value="Soundcloud">Soundcloud</option><option value="Spotify">Spotify</option><option value="Stumbleupon">Stumbleupon</option><option value="Tumblr">Tumblr</option><option value="Viddler">Viddler</option><option value="Vimeo">Vimeo</option><option value="Virb">Virb</option><option value="Windows">Windows</option><option value="Wordpress">Wordpress</option><option value="Youtube">Youtube</option><option value="Twitter">Twitter</option></select></div><div class="differentthemes-shortcode-field"><label>Account Url</label><input type="text" class="social" id="differentthemes-shortcode-social-'+n+'"></div>').insertBefore("#insertbtn");    
					jQuery('#df-social').val(n);
				}
			});
	},

	/**
	 * Executes a command when the insert button has been clicked.
	 */
	executeCommand:function(ed, btn, selection){

    		var values={}, html='';
    		var selection = ed.selection.getContent();
    		if(!btn.allowSelection){
    			//the button doesn't allow selection, generate the values as an object literal
	    		for(var i=0, length=btn.fields.length; i<length; i++){
	        		var id=btn.fields[i].id,
	        			value=jQuery('#'+differentthemesButtonManager.idprefix+id).val();
	        		
	    			values[id]=value;
	    		}
	    		html = btn.generateHtml(values);
    		}else{
				var values={};
    			//the button allows selection - only one value is needed for the formatting, so
    			//return this value only (not an object literal)
    			values[btn.fields[0].id]=jQuery('#'+differentthemesButtonManager.idprefix+btn.fields[0].id).attr("value");
				if(btn.fields.length>=2) {
					values[btn.fields[1].id]=jQuery('#'+differentthemesButtonManager.idprefix+btn.fields[1].id).attr("value");
				}
				values["selection"]= jQuery('#'+differentthemesButtonManager.idprefix+"selection").attr("value");

    			html = btn.generateHtml(values);
    		}
    		
    	differentthemesButtonManager.dialog.remove();

    	if(differentthemesButtonManager.ie){
	    	selection.select(ed.dom.select('div#differentthemescaret')[0], false);
	    	ed.dom.remove('differentthemescaret');
    	}

  		ed.execCommand('mceInsertContent', false, html);
    	
	}
};

/**
 * Init the formatting functionality.
 */
(function() {
	
	differentthemesButtonManager.init();
    
})();

