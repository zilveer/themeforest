var btpShortcodeGenerator = function( ed, id, editorType ) {

    this.ed = ed;
	this.id = id;

	this.context = jQuery( '#' + id + ' .btp-shortcode-generator' );
	var obj = this;	

	// Connect navigation items with viewport items
	obj.context.find('div.btp-nav select').change(function(){
		jQuery('option', this).each(function(optionIndex){			
			if ( jQuery(this).attr('selected') === 'selected' ) {				
				obj.context.find('.btp-viewport .btp-viewport-item').each(function(itemIndex){
					
					if ( ( optionIndex - 1 ) === itemIndex ) {
						jQuery(this).show();
						obj.context.find('.btp-actions').show();
					} else {
						jQuery(this).hide();
					}	
				});
			}				
		});
	});
	
	/**
	 * Closes thickbox with shortcode generator user interface
	 * 
	 * @return
	 */
	this.hideUI = function(){
		tb_remove();
		obj.context.hide();
	};
	
	/**
	 * Opens thickbox with shortcode generator user interface
	 * 
	 * @return
	 */
	this.showUI = function(){
		var windowWidth = jQuery(window).width();
		var windowWidth = ( 720 < windowWidth ) ? 720 : windowWidth;		
		var windowHeight = jQuery(window).height();
		
		var title = obj.context.find( 'h1' ).text();
		
		windowWidth -= 80;
		windowHeight -= 80;

		// Display shortcode generator UI		
		obj.context.show();
		obj.context.find('.btp-nav select').val("");
		obj.context.find('.btp-viewport .btp-viewport-item').hide();
		obj.context.find('.btp-actions').hide();
		
		tb_show( title, '#TB_inline?width=' + windowWidth + '&height=' + windowHeight + '&inlineId=' + obj.id, null );
		
		// Use editor selection as shortcode content 
		//obj.context.find('.btp-shortcode-content input').attr( 'value', ed.selection.getContent() );
	};
	
	/**
	 * Recognizes function name based on attribute's model
	 * 
	 * @param attrModel
	 * @return string
	 */
	this.getFunctionName = function( attrModel ){
		var functionName = '';
		var functionNameParts = attrModel.split( /-|_/ );
		for ( var i in functionNameParts ) {
		    functionName += functionNameParts[i].charAt(0).toUpperCase() + functionNameParts[i].slice(1);
		}
		functionName = 'extract' + functionName;
		
		return functionName;
	}; 	
	
	
	/**
	 * Extract name and value from string form unit 
	 */
	this.extractString = function( x ) {
		var out;
		jQuery('input:eq(0)', x).each(function() {			
			var attrValue = jQuery(this).attr( 'value' );
			if ( attrValue.length ) {
				out = new Array( jQuery(this).attr( 'name' ), attrValue );
				
			}	
		});
		
		return out;
	};	
	
	/**
	 * Extract name and value from input checkbox form unit 
	 */
	this.extractCheckbox = function( x ) {
		var out;	
		jQuery('input:eq(0)[checked]', x).each(function() {
			out = new Array( jQuery(this).attr( 'name' ), 'true');
		});
		
		return out;
	};	
	
	/**
	 * Extract name and value from Choice form unit 
	 */
	this.extractChoice = function( x ) {
		var out;
		jQuery('select:eq(0)', x).each(function() {
			var option = jQuery( 'option:selected:eq(0)', this );
			if ( option.length && option.attr( 'value' ).length ) {
				out = new Array( jQuery(this).attr( 'name' ), option.attr( 'value' ) );
			}
		});
		
		return out;		
	};
	
	/**
	 * Extract name and value from text form unit 
	 */
	this.extractText = function( x ) {
		var out;
		jQuery('textarea:eq(0)', x).each(function() {			
			var attrValue = jQuery(this).attr( 'value' );
			if ( attrValue.length ) {
				
				attrValue = attrValue.replace(/\n/g,"<br />");
				
				out = new Array( jQuery(this).attr( 'name' ), attrValue );
			}	
		});
		
		return out;
	};	
	
	/**
	 * Extract name and value from color form unit 
	 */
	this.extractColor = function( x ) {
		var out;
		jQuery('input:eq(0)', x).each(function() {			
			var attrValue = jQuery(this).attr( 'value' );
			if ( attrValue.length ) {
				out = new Array( jQuery(this).attr( 'name' ), attrValue );
				
			}	
		});
		
		return out;
	};
	
	
	// Insert shortcode
	obj.context.find('.btp-actions .button-secondary').click(function(event){
		// Prevent default event to avoid duplicated shortcodes
		event.preventDefault();

		var out = '';		
		var scTag = '';
		
		obj.context.find('div.btp-nav select option', this).each(function(optionIndex){			
			if ( jQuery(this).attr('selected') === 'selected' && optionIndex ) {
				
				scTag = jQuery(this).attr('value');
				
				obj.context.find('.btp-viewport .btp-viewport-item').each(function(itemIndex){
					if ( ( optionIndex - 1 ) === itemIndex ) {
						
						var display = jQuery('.btp-shortcode .btp-shortcode-meta input[name="display"]', this).val();
						
						var result = jQuery('.btp-shortcode .btp-shortcode-result', this);
						if ( !result.length ) {
							
							out += '[' + scTag;
							
							// Process shortcode attributes
							jQuery('.btp-shortcode .btp-shortcode-attributes .btp-option-view', this).each(function(){
								var attrModel = jQuery(this).attr( 'class' ).split(' ')[1];
								attrModel = attrModel.replace('btp-option-view-', '');			
								
								var functionName = obj.getFunctionName(attrModel);
								if ( typeof obj[functionName] === 'function' ) {
									var result = obj[functionName]( this );				
									if ( result instanceof Array ) {						
										out += ' ' + result[0] + '="' + result[1] + '"';
									}	
								}						
							});
							
							out += ']';							
							
							// Process shortcode content
							jQuery('.btp-shortcode .btp-shortcode-content .btp-option-view', this).each(function(){
								var attrModel = jQuery(this).attr( 'class' ).split(' ')[1];
								attrModel = attrModel.replace('btp-option-view-', '');			
								
								var functionName = obj.getFunctionName(attrModel);
								if ( typeof obj[functionName] === 'function' ) {
									var result = obj[functionName]( this );				
									if ( result instanceof Array ) {										
										switch ( display ) {
											case 'block':
												out += '<br /><br />' + result[1] + '<br /><br />[/' + scTag + ']';
												break;
											case 'inline':
											default:	
												out += result[1] + '[/' + scTag + ']';
												break;
										}
									}	
								}						
							});	
						
						} else {						
							out = result.find('textarea').val().replace(/\n/g,"<br />");
						}
					}	
				});
			}				
		});		
		
		// Insert shortcode into editor
        if (editorType == 'html') {
            // convert br tags to new line characters
            out = out.replace(/<br\s*\/?>/g,'\n');

            QTags.insertContent(out);
        } else {
            obj.ed.execCommand(
                'mceInsertContent',
                false,
                out
            );
        }

		// Close UI
		obj.hideUI();
			
	});

    return obj;
}