(function($) {
	"use strict";
	var active_shortcode;
	var instance;
	var $dialog;
	var $widget;

	/* HANDLE MULTIPLE IMAGES */
	$(document).on( 'click', '.shortcode-add-images', function( e ){
		e.preventDefault();
		
		var $this = $(this);
		var $parent = $this.parents('.shortcode-option');
		var $field = $parent.find( 'input' );
		var $image_holder = $parent.find('.shortcode-images-holder');
		
		var Proper_Frame = wp.media({
			multiple: true,
			title: 'Select Images'
		});

		Proper_Frame.on('select', function(){
			var selection = Proper_Frame.state().get('selection').toJSON();
			$image_holder.html('');
			for( var i=0; i<selection.length; i++ ){
				$image_holder.append( '<div class="shortcode-image-wrapper">\
										 <img src="'+selection[i].url+'" data-image_id="'+selection[i].id+'" class="shortcode-option-thumb" />\
									   	 <a href="javascript:;" class="shortcode-remove-images" data-image_id="'+selection[i].id+'">X</a>\
									   </div>' );
			}
			update_images( $image_holder, $field );
			Proper_Frame.close();
		});
				
		
		Proper_Frame.open();
	});
	
	$(document).on( 'click', '.shortcode-remove-images', function(e){
		e.preventDefault();
		var $this = $(this);
		var $parent = $this.parents('.shortcode-option');
		var $field = $parent.find( 'input' );
		var $image_holder = $parent.find( '.shortcode-images-holder' );		
		var image_id = $this.data('image_id');
		$image_holder.find('img[data-image_id="'+image_id+'"]').fadeOut( 150, function(){ 
			$(this).remove();
			$this.remove(); 
			update_images( $image_holder, $field );
		});		
	});
	
	function update_images( $image_holder, $field ){
		var image_ids = [];
		$image_holder.find( 'img' ).each(function(){
			var $this = $(this);
			image_ids.push( $this.data('image_id') );
		});
		
		$field.val( image_ids.join(",") );
	}

	/* END HANDLE MULTIPLE IMAGES */

	/* HANDLE ONE IMAGE */
	$(document).on( 'click', '.shortcode-add-image', function( e ){
		var $this = $(this);
		var $parent = $this.parents('.shortcode-option');
		var $field = $parent.find( 'input' );
		e.preventDefault();

		var Proper_Frame = wp.media({
			multiple: false,
			title: 'Select Image'
		});

		Proper_Frame.on('select', function(){
			var selection = Proper_Frame.state().get('selection'),
				model = selection.first();
			$field.val( model.attributes.id );
			$parent.find('img').remove();
			$parent.find('.shortcode-image-holder').html( '<div class="shortcode-image-wrapper">\
						  	<img src="'+model.attributes.url+'" data-image_id="'+model.attributes.id+'" class="shortcode-option-thumb" />\
						 	<a href="javascript:;" class="shortcode-remove-image">X</a>\
						  </div>' );
			Proper_Frame.close();
		});

		Proper_Frame.open();
	});
	
	$(document).on( 'click', '.shortcode-remove-image', function(e){
		e.preventDefault();
		var $this = $(this);
		var $parent = $this.parents('.shortcode-option');
		var $field = $parent.find( 'input' );

		$('img[data-image_id="'+$field.val()+'"]').fadeOut( 100, function(){ 
			$parent.find('.shortcode-image-wrapper').remove();
		});

		$field.val('');
	});	
	/* END HANDLE ONE IMAGE */

	$(document).on( 'click', '.shortcode-save-options', function(e){
		e.preventDefault();
		var params = [];
		var content = '';
		$dialog.find('.shortcode-field').each(function(){
			var $this = $(this);
			var val = $this.val();
			if( !val ){
				val = '';
			}
			if( $this.attr('name') == 'contents' ){
				content = val;
			}
			else{
				params.push( $this.attr('name')+'="'+val+'"' );
			}
		});

		if( active_shortcode !== 'accordion' ){
			var shortcode = '['+active_shortcode+' '+params.join(' ')+'][/'+active_shortcode+']';
		}
		else{
			var shortcode = '['+active_shortcode+' '+params.join(' ')+']'+content+'[/'+active_shortcode+']';
		}
		add_shortcode( shortcode );
		$dialog.dialog('close');
	});

	function add_shortcode( shortcode ){
		if( instance ){
			instance.execCommand( 'mceInsertContent', 0, shortcode );
		}
		else{
			$widget.find('.shortcode-input').val( shortcode );
		}
	}

	function call_shortcode(){
		$.ajax({
			url: ajaxurl,
			data: { 
				shortcode: active_shortcode,
				action: 'shortcode_call'
			},
			method: 'POST',
			success: function( response ){
				if( response !== '' ){
					$dialog = $('.shortcode-shortcode-dialog');
					if( $dialog.length == 0 ){
						$('body').append( '<div class="shortcode-shortcode-dialog"></div>' );
						$dialog = $('.shortcode-shortcode-dialog');
					}
					$dialog.html( response );
					$dialog.dialog({
						open: function(){
							$dialog.find('.shortcode-colorpicker').each(function(){
								$(this).wpColorPicker();
							});
							/* MAKE MULTIPLE IMAGES SORTABLE */
							$dialog.find('.shortcode-images-holder').each(function(){
								var $this = $(this);
								$this.sortable({
								stop: function(){
										var $field = $this.parent().find('input');
										update_images( $this, $field );
									 }
								});
							});
						}
					});
				}
				else{
					add_shortcode( '['+active_shortcode+'][/'+active_shortcode+']' );
				}
			}
		});
	}

	$(document).on('change', '.shortcode-add', function(){
		var $this = $(this);
		active_shortcode = $this.val();
		if( active_shortcode != '' ){
			$widget = $this.parents('.widget');
			call_shortcode();
		}
	});

	if( typeof tinymce != 'undefined' ){
	    tinymce.create('tinymce.plugins.couponxl', {
	        init : function(ed, url) {
	        	instance = ed;        	
				ed.addButton('couponxlgrid', {
					type: 'listbox',
					text: 'CouponXL Grid',
					icon: false,
					onselect: function(e) {
						active_shortcode = this.value();
						call_shortcode();
					},
					values: [
						{ text: 'Row', value: 'row' },
						{ text: 'Columns', value: 'column' },
					],
					onPostRender: function() {
						ed.my_control = this;
					}
				});
				/* elements */
				ed.addButton('couponxlelements', {
					type: 'listbox',
					text: 'CouponXL Elements',
					icon: false,
					onselect: function(e) {
						active_shortcode = this.value();
						call_shortcode();
					},
					values: [
						{ text: 'Coupons', value: 'coupons' },
						{ text: 'Deals', value: 'deals' },
						{ text: 'Blogs', value: 'blogs' },
						{ text: 'Button', value: 'button' },
						{ text: 'Content', value: 'content' },
						{ text: 'Featured Stores', value: 'featured_stores' },
						{ text: 'Gmap', value: 'gmap' },
						{ text: 'Sidebar', value: 'sidebar' },
						{ text: 'Slider', value: 'slider' },
						{ text: 'Accordion', value: 'accordion' },
					],
					onPostRender: function() {
						ed.my_control = this;
					}
				});			
	        }
	    });
	    // Register plugin
	    tinymce.PluginManager.add( 'couponxl', tinymce.plugins.couponxl );
	}
})(jQuery);
