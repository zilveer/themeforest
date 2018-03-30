jQuery(document).ready(function($) {
    var mthemePopup={	
    	loadVals: function() {
			var shortcode=$(mthemeElements.shortcodeModule).find('form').children(mthemeElements.shortcodeModulePattern).html();
			var clones='';

    		$(mthemeElements.shortcodeModule).find('input, select, textarea').each(function() {
    			var id=$(this).attr('id'),
    				re=new RegExp('{{'+id+'}}','g');
    				
    			shortcode=shortcode.replace(re, $(this).val());
    		});
			
			$(mthemeElements.shortcodeModule).find(mthemeElements.shortcodeModuleClone).each(function() {
				var shortcode=$(this).children(mthemeElements.shortcodeModulePattern).html();
				
				$(this).find('input, select, textarea').each(function() {
					var id=$(this).attr('id'),
						re=new RegExp('{{'+id+'}}','g');
						
					shortcode=shortcode.replace(re, $(this).val());
				});
				
				clones=clones+shortcode;
			});
			
			shortcode=shortcode.replace('{{clone}}', clones);
			shortcode=shortcode.replace('="null"', '="0"');
			$(mthemeElements.shortcodeModuleValue).html(shortcode);
    	},
		
		resize: function() {
			$('#TB_ajaxContent').outerHeight($('#TB_window').outerHeight()-$('#TB_title').outerHeight()-2);
		},
		
    	init: function() {
    		var	mthemePopup=this,
    			form=$(mthemeElements.shortcodeModule).find('form');
				
			//update values
			form.find('select').live('change', function() {
				mthemePopup.loadVals();
			});
			
			form.find('input').live('change', function() {
				mthemePopup.loadVals();
			});
			
			form.find('textarea').bind('propertychange keyup input paste', function(event){
				mthemePopup.loadVals();				
			});
			
			//update clones
			form.find(mthemeElements.buttonClone).live('click', function() {
				mthemePopup.loadVals();
				mthemePopup.resize();
			});
			
			form.find(mthemeElements.buttonRemove).live('click', function() {
				mthemePopup.loadVals();
				mthemePopup.resize();
			});
			
			//send to editor
			form.live('submit', function() {
				mthemePopup.loadVals();
				if(window.tinyMCE) {
					if(window.tinyMCE.majorVersion>3) {
						window.tinyMCE.execCommand('mceInsertContent', false, $(mthemeElements.shortcodeModuleValue).html());
					} else {
						window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $(mthemeElements.shortcodeModuleValue).html());
					}
					
					tb_remove();
				}
				
				return false;
			});	
    	}
	}
	
		//init popup
	mthemePopup.init();
	
	//resize popup
	$(window).resize(function() {
		mthemePopup.resize();
	});
});