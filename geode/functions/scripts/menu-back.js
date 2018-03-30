/******************************************************
*
*	MegaMenu
*
******************************************************/
function update_megamenu(){
	jQuery('.menu-item-depth-0 .pix-megamenu-item').each(function(){
		var c = jQuery(this),
			li = c.closest('li'),
			p = jQuery('> dl .item-type',li),
			megaEq = li.index('.menu-item-depth-0'),
			megaNext = jQuery('.menu-item-depth-0').eq(megaEq+1),
			startEq = li.index('.menu-item'),
			endEq = megaNext.length ? megaNext.index('.menu-item') : jQuery('.menu-item').length;
		if(!jQuery('> dl .custom-type',li).length){
			p.after('<span class="custom-type" />').hide();
		}
		var te = jQuery('> dl .custom-type',li);
		if(c.is(':checked')){
			te.html('<span class="pixmegamenu-label">PixMegaMenu</span>').show();
			p.hide();
			li.addClass('pix-megamenu-parent');
			li.nextUntil('.menu-item-depth-0').addClass('in-a-megamenu');
		} else {
			te.hide();
			p.show();
			li.removeClass('pix-megamenu-parent');
			li.nextUntil('.menu-item-depth-0').removeClass('in-a-megamenu');
		}
		jQuery('.in-a-megamenu').each(function(){
			var subs = jQuery(this).attr('class').indexOf('menu-item-depth-'),
				depth = parseFloat(jQuery(this).attr('class').substring(subs+16,subs+17));
			if ( depth > 2 ) {
				jQuery(this).addClass('menu-item-alert');
				if ( !jQuery('#pix_builder_cant').length ) {
					jQuery('body').append('<div id="pix_builder_cant" /></div>');
				}
				jQuery('#pix_builder_cant').html('<p>PixMegaMenu can\'t have more than two levels, please check</p>')
					.dialog({
						height: 'auto',
						width: 250,
						modal: true,
						dialogClass: 'wp-dialog',
						zIndex: 50,
						close: function(){
							jQuery('#pix_builder_cant').remove();
						}
					});
			} else {
				jQuery(this).removeClass('menu-item-alert');
			}
		});
		c.bind('click',function(){
			if(c.is(':checked')){
				te.html('<span class="pixmegamenu-label">PixMegaMenu</span>').show();
				p.hide();
				li.addClass('pix-megamenu-parent');
				li.nextUntil('.menu-item-depth-0').addClass('in-a-megamenu');
			} else {
				te.hide();
				p.show();
				li.removeClass('pix-megamenu-parent');
				li.nextUntil('.menu-item-depth-0').removeClass('in-a-megamenu');
			}
		});
	});
	jQuery('.menu-item-depth-1 .pix-column-item').each(function(){
		var c = jQuery(this),
			v = jQuery('option:selected',c).val(),
			li = c.closest('li'),
			p = jQuery('> dl .item-type',li);
		if(!jQuery('> dl .custom-type',li).length){
			p.after('<span class="custom-type" />').hide();
		}
		var te = jQuery('> dl .custom-type',li);
		if(v == 'column'){
			c.parents('li').eq(0).addClass('menu-item-column');
			te.html('<span class="pixmegamenu-column">'+pixmenu_column+'</span>').show();
			p.hide();
			jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).hide();
			jQuery('.pix_width-item',li).show();
		} else if(v == 'row'){
			c.parents('li').eq(0).addClass('menu-item-row');
			te.html('<span class="pixmegamenu-row">'+pixmenu_row+'</span>').show();
			p.hide();
			jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).hide();
			jQuery('.pix_width-item',li).hide();
		} else {
			te.hide();
			p.show();
			jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).show();
			jQuery('.pix_width-item',li).hide();
		}
		c.change(function(){
			v = jQuery('option:selected',c).val();
			if(v == 'column'){
				te.html('<span class="pixmegamenu-column">'+pixmenu_column+'</span>').show();
				p.hide();
				jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).slideUp();
				jQuery('.pix_width-item',li).slideDown();
			} else if(v == 'row'){
				te.html('<span class="pixmegamenu-row">'+pixmenu_row+'</span>').show();
				p.hide();
				jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).slideUp();
				jQuery('.pix_width-item',li).slideUp();
			} else {
				te.hide();
				p.show();
				jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).slideDown();
				jQuery('.pix_width-item',li).slideUp();
			}
		});
	});
}

jQuery(function(){
	if(pagenow=='nav-menus') {

		update_megamenu();

		jQuery('body').ajaxSuccess(function() {
			var set = setTimeout('update_megamenu()',1);
		});
		
		jQuery('#menu-to-edit').bind( "sortstop", function(event, ui) {
			var set = setTimeout('update_megamenu()',1);
		});
		
	}
});

