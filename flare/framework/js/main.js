shortcode_generators = new Array();

function btpFixAction( target ) {
	jQuery( target ).attr( 'action', window.location );
}

jQuery(document).ready(function() {	

	jQuery( '.btp-theme-options' ).each( function() {
		var $this = jQuery( this );		
		
		var navigation = jQuery('<ul class="btp-option-group-nav"></ul>');
		var viewport = jQuery('<div class="btp-option-group-viewport"></div>');
				
		$this.find( '.btp-option-group' ).each( function( i ) {			
			var $li = jQuery('<li class="btp-option-group-nav-item">' + jQuery( '.btp-option-group-title', this ).text()  + '</li>');
			var $div = jQuery('<div class="btp-option-group-viewport-item"></div>').append(jQuery( '.btp-option-group-content', this).detach().contents());
			$div.data( 'data', { li: $li } );
			
			navigation.append($li);			
			viewport.append($div);
			
			$li.click( function() {							
				$this.find('.btp-option-group-nav-item').removeClass('btp-option-group-nav-item-current');				
				$li.addClass('btp-option-group-nav-item-current');				
				$this.find('.btp-option-group-viewport-item').hide();				
				$div.show();
				
				/* Change hash and prevent scroll jump */
				var scroll = jQuery('body').scrollTop();				
				window.location.hash = '#' + $div.find( '.btp-option-subgroup-viewport-item:eq(0)' ).attr( 'id' );
				jQuery('html,body').scrollTop(scroll);
			});
			
			jQuery(this).remove();
		} );		
		
		$this.append( navigation );
		$this.append( viewport );
		
		/* Hide all */
		$this.find('.btp-option-group-nav-item').removeClass('btp-option-group-nav-item-current');
		$this.find('.btp-option-group-viewport-item').hide();
		
		/* Show first */		
		$this.find('.btp-option-group-nav-item:eq(0)').addClass('btp-option-group-nav-item-current');
		$this.find('.btp-option-group-viewport-item:eq(0)').show();
	} );
	
	
	jQuery( '.btp-option-group-viewport-item' ).each( function() {
		var $this = jQuery( this );		
		
		var navigation = jQuery('<ul class="btp-option-subgroup-nav"></ul>');
		var viewport = jQuery('<div class="btp-option-subgroup-viewport"></div>');
				
		$this.find( '.btp-option-subgroup' ).each( function( i ) {		
			var $li = jQuery('<li class="btp-option-subgroup-nav-item">' + jQuery( '.btp-option-subgroup-title', this ).text()  + '</li>');
			var $div = jQuery('<div id="' + jQuery( this ).attr( 'id' ) + '" class="btp-option-subgroup-viewport-item"></div>').append(jQuery( '.btp-option-subgroup-content', this).detach().contents() );
			$div.data( 'data', { li: $li } );
				
			navigation.append( $li );			
			viewport.append( $div );
			
			$li.click( function() {				
				$this.find('.btp-option-subgroup-nav-item').removeClass('btp-option-subgroup-nav-item-current');
				$li.addClass('btp-option-subgroup-nav-item-current');
				$this.find('.btp-option-subgroup-viewport-item').hide();
				$div.show();
				
				/* Change hash and prevent scroll jump */
				var scroll = jQuery('body').scrollTop();
				window.location.hash = '#' + $div.attr( 'id' );
				jQuery('html,body').scrollTop(scroll);
			});
			
			jQuery(this).remove();
		} );		
		
		$this.prepend( navigation );
		$this.append( viewport );
		
		/* Hide all */
		$this.find('.btp-option-subgroup-nav-item').removeClass('btp-option-subgroup-nav-item-current');
		$this.find('.btp-option-subgroup-viewport-item').hide();
		
		/* Show first */
		$this.find('.btp-option-subgroup-nav-item:eq(0)').addClass('btp-option-subgroup-nav-item-current');
		$this.find('.btp-option-subgroup-viewport-item:eq(0)').show();
	} );
	
	/* The hash string provides information about the current opened tabs  */
	var hash = window.location.hash;
	if ( hash.length ) {
		jQuery( hash ).each( function(){
			var $li = jQuery( this ).data('data').li;
			$li.closest( '.btp-option-group-viewport-item' ).data('data').li.trigger( 'click' );
			$li.trigger( 'click' );			
		});			
	}	
	
	
	
	// INITIALIZE COLOR PICKER	
	jQuery('.btp-field-color').each(function(){
		var $this = jQuery(this);
		
		
		
		var $container = $this.find('.btp-color-picker-container').eq(0);
		var $input = $this.find('input').eq(0);
		var $preview = $this.find('.btp-color-picker-preview').eq(0);
		var $previewCurrent = $this.find('.btp-color-picker-preview-current').eq(0);
		var $previewNew = $this.find('.btp-color-picker-preview-new').eq(0);
		var $toggle = $this.find('.btp-color-picker-toggle').eq(0);
		
		var openColorPicker = function(){
			$preview.addClass('on');
			$container.addClass('on');
			
			$container.farbtastic(function callback(color){			 			 
				 $previewNew.css('background-color', color);
				 $input.attr('value', color);
			 });
			
			jQuery.farbtastic($container).setColor($input.attr('value'));		
		};
		
		$this.blur(function(){
			if ( $preview.is( '.on' ) ) {
				//$previewCurrent.css( 'background-image', 'none' );
				$previewCurrent.css( 'background', $previewNew.css('background-color') );
				$preview.removeClass( 'on' );
				$container.removeClass( 'on' );
			}	
		});
		
		$previewCurrent.click(function(){			
			if ( $preview.is('.on') ) {	
				$previewNew.css('background-color', $previewCurrent.css('background-color'));			
			} else {				
				openColorPicker();
			}	
		});		
		
		$toggle.click( openColorPicker );	
	});
	
	jQuery('.btp-option-view-color input').blur(function(){		
		var $preview = jQuery(this).siblings('.btp-color-picker-preview').eq(0);				
		$preview.find('.btp-color-picker-preview-current').css('background-color', jQuery(this).attr('value'));
	});
	
	
	// INITIALIZE FORM UNITS
	jQuery('.btp-option-view .btp-help').each(function(){		
		var context = this;		
		jQuery('.btp-help-content',context).hide();
		jQuery('.btp-help-toggle', context).toggleClass('btp-help-toggle-off').click(function(){
			jQuery(this).toggleClass('btp-help-toggle-on').toggleClass('btp-help-toggle-off');
			jQuery('.btp-help-content', context).toggle('fast');			
		});
	});
	

//	jQuery( '.btp-field-image-upload' ).each( function() {
//		//alert( window.send_to_editor );
//		
//		jQuery( 'input.button', this ).live( 'click', function() {
//			
//			formfield = jQuery(this).prev('input').attr('id');
//	        //formID = 23;//$(this).attr('rel');	        
//	        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
//	        //tb_show('', 'media-upload.php?post_id='+formID+'&type=image&amp;TB_iframe=1');
//	        
//	        window.send_to_editor = function(html) {
//	        	alert( 'yoyo' );
//	            //imgURL = jQuery('img',html).attr('src');
//	            //jQuery('#_meta_fotos\\[pic\\]').val(imgURL);
//	            //tb_remove();
//	          }
//
//	        
//	        return false;
//		} );	
//	} );
	
	
	
	
	jQuery( '.btp-field-image-choice' ).each( function() {
		var container = jQuery(this);
		jQuery( 'div:has( input:checked )', this).addClass( 'btp-checked' );
				
		jQuery( 'div input', this ).change( function() {
			jQuery(this).blur();
			jQuery( 'div', container ).removeClass( 'btp-checked' );
			jQuery( 'div:has( input:checked )', container).addClass( 'btp-checked' );
		} ); 
		
	} );
	
	jQuery('input[type="range"]').rangeinput({ progress: true });
	
	
	
//	function ($) {
//		  uploadOption = {
//		    init: function () {
//		      var formfield,
//		          formID,
//		          btnContent = true;
//		      // On Click
//		      $('.upload_button').live("click", function () {
//		        formfield = $(this).prev('input').attr('id');
//		        formID = $(this).attr('rel');
//		        tb_show('', 'media-upload.php?post_id='+formID+'&type=image&amp;TB_iframe=1');
//		        return false;
//		      });
//		     
//		      window.original_send_to_editor = window.send_to_editor;
//		      window.send_to_editor = function(html) {
//		        if (formfield) {
//		          itemurl = $(html).attr('href');
//		          var image = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;
//		          var document = /(^.*\.pdf|doc|docx|ppt|pptx|odt*)/gi;
//		          var audio = /(^.*\.mp3|m4a|ogg|wav*)/gi;
//		          var video = /(^.*\.mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2*)/gi;
//		          if (itemurl.match(image)) {
//		            btnContent = '<img src="'+itemurl+'" alt="" /><a href="" class="remove">Remove Image</a>';
//		          } else {
//		            btnContent = '<div class="no_image">'+html+'<a href="" class="remove">Remove</a></div>';
//		          }
//		          $('#' + formfield).val(itemurl);
//		          $('#' + formfield).next().next('div').slideDown().html(btnContent);
//		          tb_remove();
//		        } else {
//		          window.original_send_to_editor(html);
//		        }
//		      }
//		    }
//		  };
//		  $(document).ready(function () {
//		    uploadOption.init()
//		  })
//		})(jQuery);
	
	
	//jQuery( '.postbox .btp-option-group-title').hide();
	//jQuery( '.postbox .btp-option-subgroup-title').hide();
	
	
	
	jQuery( '#how-to-use-relation-tags-content' ).hide();
	jQuery( '#how-to-use-relation-tags-title' ).click( function( event ) {
		event.preventDefault();
		
		jQuery( '#how-to-use-relation-tags-content' ).slideToggle( 'fast' );
	});
	
	
	
	
	// INITIALIZE SHORTCODE GENERATOR
	if ( typeof tinymce !== "undefined" && tinymce) {
		
		jQuery( '.btp-shortcode-generator' ).parent().each( function() {		
			var $this = jQuery( this );
			
			var image = $this.find( 'h1 img' ).attr( 'src' );
			var title = $this.find( 'h1' ).text();
			
			
			var id = $this.attr( 'id' );
			id = id.replace( /\-/g, '_' );
			
			tinymce.create('tinymce.plugins.' + id, {    	
				init : function(ed, url){
					shortcode_generators[ id ] = new btpShortcodeGenerator(ed, $this.attr( 'id' ));   		
			    	
			        ed.addButton(id, {
			        	title : title,
			            	onclick : function() {
			            		shortcode_generators[ id ].showUI();
			                },
			            image: image
			        });
			    },
			    createControl : function(n, cm) {
			    	return null;
			    }
			});
		
			tinymce.PluginManager.add( id, tinymce.plugins[ id ]);			
		});		
	}

    function registerShortcodeGeneratorForHTMLEditor()
    {
        if ( typeof(QTags) !== 'function' ) {
            return;
        }
        var qt = QTags;

        var generator = new btpShortcodeGenerator(null, 'btp-shortcode-generator-general', 'html');

        qt.ShortcodeGeneratorHTMLButton = function() {
            qt.Button.call(this, 'g1_shotgen', '[/]', 'f', 'General Shortcode Generator');
        };
        qt.ShortcodeGeneratorHTMLButton.prototype = new qt.Button();
        qt.ShortcodeGeneratorHTMLButton.prototype.callback = function(e, c) {
            generator.showUI();
        };

        edButtons[edButtons.length] = new qt.ShortcodeGeneratorHTMLButton();
    }

    registerShortcodeGeneratorForHTMLEditor();
});

//Function to convert hex format to a rgb color
function rgbToHex(rgb){
	rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	return "#" +
		("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
		("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
		("0" + parseInt(rgb[3],10).toString(16)).slice(-2);
}




