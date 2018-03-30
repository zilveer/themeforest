function desServiceFAMaker(h, i, f) {

    this.parentControl = h;
    var d = this;
    this.width = 250;
    this.maxTabs = i;
    this.buttonsControl = this.textControl = this.selectControl = null;
    this.init = function () {
    
        this.buildSelectControl();
        
    };
    
    this.getTotalTabs = function () {
        return Number(d.selectControl.find( "option:selected").val())
    };
    
    this.buildSelectControl = function () {
    	// .attr( "style", "width:" + this.width + "px")
        this.selectControl = jQuery( "<select></select>").attr( "id", "des-service-select").addClass(f ? f : "" );
        var a = jQuery( "<option></option>").attr( "value", "select").attr( "selected", "selected").text( "Number of Items..." );
        a.appendTo(this.selectControl);
        for (var b = 2; b <= this.maxTabs; b++) {
            a = jQuery( "<option></option>").attr( "value", b).text(b + " Items" );
            a.appendTo(this.selectControl)
        }
        this.selectControl.change(function (c) {
            (c = d.getTotalTabs()) && d.buildTabButtons(c)
                        
            // Update the text in the appropriate span tag.
            var newText = jQuery(this).children('option:selected').text();
            
            jQuery(this).parents('.select_wrapper').find( 'span').text( newText );
            
            /*
            REMOVER OPÇÃO PARA ALTERAR O NUMERO DE ITENS. RESOLVE A QUESTÃO TODA MAS NAO PERMITE A EDIÇÃO.  
            jQuery( this ).parents( 'tr' ).hide();
            */
                        
        });
        
        this.parentControl.append(this.selectControl);
    };
    
    this.buildTextInputControl = function ( id ) {
    	var scripts = document.getElementsByTagName( "script"),
			src = scripts[scripts.length-1].src;
			
			if ( scripts.length ) {
				for ( i in scripts ) {
	
					var scriptSrc = '';
					
					if ( typeof scripts[i].src != 'undefined' ) { scriptSrc = scripts[i].src; } // End IF Statement
					var txt = scriptSrc.search( 'page-options' );
					
					
					if ( txt != -1 ) {
					
						src = scripts[i].src;
					
					} // End IF Statement
				
				} // End FOR Loop
			
			} // End IF Statement
	
			var framework_url = src.split( '/lib/' );
			
			var icon_url = framework_url[0] + '/img/designare_icons/';
    
    	var labelElement = '<label for="des_service_title">Item ' + id + ' Title</label>';
    	var inputElement = '<input type="text" id="des_service_title_' + id.toString() + '" class="txt input-text" name="des_service_title" />';
    	
    	var labelElement3 = '<label for="des_icon_color">Icon ' + id + ' Color</label>';
    	var inputElement3 = '<td id="des-marker-colourpicker-control_' + id.toString() + '" class="des-marker-colourpicker-control"><div class="colorSelector"><div></div></div><input type="text" id="des_service_color_' + id.toString() + '" name="des_service_color_' + id.toString() + '" class="txt input-text input-colourpicker" style="float: left;"><br><span class="des-input-help">Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff).</span></td>';
    
    	var startingColour = '000000';
    	
    	var checker = setInterval(function(){
			if (jQuery('#des-marker-colourpicker-control_' + id.toString()).length != 0){
				jQuery( '#des-marker-colourpicker-control_' + id.toString() + ' div.colorSelector').each ( function () {
    	
		    		var colourPicker = jQuery(this).ColorPicker({
		    	
			    	color: startingColour,
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
					},
					onChange: function (hsb, hex, rgb) {
						jQuery(colourPicker).children( 'div').css( 'backgroundColor', '#' + hex);
						jQuery(colourPicker).next( 'input').attr( 'value','#' + hex);
					}
			    	
			    	});
			    	
		    	});
		    	   	
		    	jQuery( '.colorpicker').css( 'position', 'absolute').css( 'z-index', '9999' );
				clearInterval(checker);
			}
		}, 100);
    	
    	var labelElement2 = '<label for="des_service_icon">Item ' + id + ' Icon</label>';
    	var inputElementh = '<input type="text" id="des_service_iconh_' + id.toString() + '" class="txt input-text" name="des_service_title" style="display:none;" value="icon1"/>';
    	
    	var inputElement2 = '<select id="des_service_icon_' + id.toString() + '" class="select input-select des-icon-chooser" name="des_service_icon" onchange="document.getElementById(\'des_service_iconh_' + id.toString() + '\').value = this.value; document.getElementById(\'img_preview_' + id.toString() + '\').src = \''+icon_url+'\' + this.value + \'.png\'" style="opacity:1;">';
    	arrayFA = ['glass' , 'music' , 'search' , 'envelope-alt' , 'heart' , 'star' , 'star-empty' , 'user' , 'film' , 'th-large' , 'th' , 'th-list' , 'ok' , 'remove' , 'zoom-in' , 'zoom-out' , 'off' , 'signal' , 'cog' , 'trash' , 'home' , 'file' , 'time' , 'road' , 'download-alt' , 'download' , 'upload' , 'inbox' , 'play-circle' , 'repeat' , 'refresh' , 'list-alt' , 'lock' , 'flag' , 'headphones' , 'volume-off' , 'volume-down' , 'volume-up' , 'qrcode' , 'barcode' , 'tag' , 'tags' , 'book' , 'bookmark' , 'print' , 'camera' , 'font' , 'bold' , 'italic' , 'text-height' , 'text-width' , 'align-left' , 'align-center' , 'align-right' , 'align-justify' , 'list' , 'indent-left' , 'indent-right' , 'facetime-video' , 'picture' , 'pencil' , 'map-marker' , 'adjust' , 'tint' , 'edit' , 'share' , 'check' , 'move' , 'step-backward' , 'fast-backward' , 'backward' , 'play' , 'pause' , 'stop' , 'forward' , 'fast-forward' , 'step-forward' , 'eject' , 'chevron-left' , 'chevron-right' , 'plus-sign' , 'minus-sign' , 'remove-sign' , 'ok-sign' , 'question-sign' , 'info-sign' , 'screenshot' , 'remove-circle' , 'ok-circle' , 'ban-circle' , 'arrow-left' , 'arrow-right' , 'arrow-up' , 'arrow-down' , 'share-alt' , 'resize-full' , 'resize-small' , 'plus' , 'minus' , 'asterisk' , 'exclamation-sign' , 'gift' , 'leaf' , 'fire' , 'eye-open' , 'eye-close' , 'warning-sign' , 'plane' , 'calendar' , 'random' , 'comment' , 'magnet' , 'chevron-up' , 'chevron-down' , 'retweet' , 'shopping-cart' , 'folder-close' , 'folder-open' , 'resize-vertical' , 'resize-horizontal' , 'bar-chart' , 'twitter-sign' , 'facebook-sign' , 'camera-retro' , 'key' , 'cogs' , 'comments' , 'thumbs-up' , 'thumbs-down' , 'star-half' , 'heart-empty' , 'signout' , 'linkedin-sign' , 'pushpin' , 'external-link' , 'signin' , 'trophy' , 'github-sign' , 'upload-alt' , 'lemon' , 'phone' , 'check-empty' , 'bookmark-empty' , 'phone-sign' , 'twitter' , 'facebook' , 'github' , 'unlock' , 'credit-card' , 'rss' , 'hdd' , 'bullhorn' , 'bell' , 'certificate' , 'hand-right' , 'hand-left' , 'hand-up' , 'hand-down' , 'circle-arrow-left' , 'circle-arrow-right' , 'circle-arrow-up' , 'circle-arrow-down' , 'globe' , 'wrench' , 'tasks' , 'filter' , 'briefcase' , 'fullscreen' , 'group' , 'link' , 'cloud' , 'beaker' , 'cut' , 'copy' , 'paper-clip' , 'save' , 'sign-blank' , 'reorder' , 'list-ul' , 'list-ol' , 'strikethrough' , 'underline' , 'table' , 'magic' , 'truck' , 'pinterest' , 'pinterest-sign' , 'google-plus-sign' , 'google-plus' , 'money' , 'caret-down' , 'caret-up' , 'caret-left' , 'caret-right' , 'columns' , 'sort' , 'sort-down' , 'sort-up' , 'envelope-alt' , 'linkedin' , 'undo' , 'legal' , 'dashboard' , 'comment-alt' , 'comments-alt' , 'bolt' , 'sitemap' , 'umbrella' , 'paste' , 'lightbulb' , 'exchange' , 'cloud-download' , 'cloud-upload' , 'user-md' , 'stethoscope' , 'suitcase' , 'bell-alt' , 'coffee' , 'food' , 'file-alt' , 'building' , 'hospital' , 'ambulance' , 'medkit' , 'fighter-jet' , 'beer' , 'h-sign' , 'plus-sign-alt' , 'double-angle-left' , 'double-angle-right' , 'double-angle-up' , 'double-angle-down' , 'angle-left' , 'angle-right' , 'angle-up' , 'angle-down' , 'desktop' , 'laptop' , 'tablet' , 'mobile-phone' , 'circle-blank' , 'quote-left' , 'quote-right' , 'spinner' , 'circle' , 'reply' , 'github-alt' , 'folder-close-alt' , 'expand-alt', 'collapse-alt', 'smile', 'frown', 'meh', 'gamepad', 'keyboard', 'flag-alt', 'flag-checkered', 'terminal', 'code', 'reply-all', 'mail-reply-all', 'star-half-empty', 'location-arrow', 'crop', 'code-fork', 'unlink', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-off', 'shield', 'calendar-empty', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-sign-left', 'chevron-sign-right', 'chevron-sign-up', 'chevron-sign-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-horizontal', 'ellipsis-vertical', 'rss-sign', 'play-sign', 'ticket', 'minus-sign-alt', 'check-minus', 'level-up', 'level-down', 'check-sign', 'edit-sign', 'external-link-sign', 'share-sign', 'compass', 'collapse', 'collapse-top', 'expand', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'cny', 'krw', 'btc', 'file', 'file-text', 'sort-by-alphabet', 'sort-by-alphabet-alt', 'sort-by-attributes', 'sort-by-attributes-alt', 'sort-by-order', 'sort-by-order-alt', 'thumbs-up', 'thumbs-down', 'youtube-sign', 'youtube', 'xing', 'xing-sign', 'youtube-play', 'dropbox', 'stackexchange', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-sign', 'tumblr', 'tumblr-sign', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'sun', 'moon', 'archive', 'bug', 'vk', 'weibo', 'renren' ];
    	for (var i=0; i < arrayFA.length; i++){
    		inputElement2 += '<option value="' + arrayFA[i] + '">' + arrayFA[i] + '</option>';
    	}
    	inputElement2 += '</select>';
    
/*
    	var labelElement3 = '<label for="des_service_icustom">Item ' + id + ' Custom Icon</label>';
    	var inputElement3 = '<input type="text" id="des_service_icustom_' + id.toString() + '" class="txt input-text" name="des_service_icustom" />';
*/
    
        this.textInputControl = jQuery( '<tr class="remover"><th>' + labelElement + '</th><td class="td-first">' + inputElement + '</td></tr><tr><th>' + labelElement3 + '</th>' + inputElement3 + '</tr><tr class="remover"><th style="vertical-align:top; padding-top: 20px;">' + labelElement2 + '</th><td>' + inputElement2 + inputElementh + '</td></tr><tr class="remover"><td class="td-divider" colspan=2></tr>' );
        this.parentControl.parents( 'tbody').append(this.textInputControl)
    };
    
    this.buildTabButtons = function (a) {
        if (this.buttonsControl) {
            this.buttonsControl.html( "" );
        } else {

			// Wipe the slate clean when the number of tabs desired changes.
			//jQuery( 'tr.remover').remove();
			//if (jQuery('#des-options-table').find('tr').length > 4){
			jQuery('#des-options-table').find('tr:gt(5)').remove();
			var checker = setInterval(function(){
				if (jQuery('.des-icon-chooser').length != 0){
		       		jQuery('.des-icon-chooser').css('display','none');
				  	jQuery('.des-icon-chooser').after('<ul class="icon_chooser" />');
					jQuery('.des-icon-chooser option').each(function(){
						jQuery(this).parent().siblings('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED');jQuery(this).parent().siblings('input').val(jQuery(this).attr('id'));\" />");
					});	
					jQuery('#des-options').width('100%');
					jQuery('#TB_window').css('overflow','scroll');
					clearInterval(checker);
				}
			}, 100);
	       		
            //}

            //this.parentControl.append(this.buttonsControl);

        }
        
        for (var b = 1; b <= a; b++) {    	
      		this.buildTextInputControl( b );
        }
        
    };
    
    this.updateTabButtonsState = function () {
        var a = this.getTotalTabs();
        if (a) {
            var b = this.countCurrentTabs(),
                c = a - b;
            this.buttonsControl.find( "input").each(function (e, g) {
                e >= c ? jQuery(g).attr( "disabled", "disabled") : jQuery(g).removeAttr( "disabled")
            })
        }
    };
    
    this.countCurrentTabs = function () {
        for (var a = this.textControl.text(), b = 0, c = 0; c < a.length; c++) a.charAt(c) == "x" && b++;
        return b
    };
    
    this.init()
};