jQuery(document).ready(function(){

	var port_carousel_wrapper = jQuery('#footer-gallery-container');
	
	function carousel_port_init(){
		port_carousel_wrapper.each(function(){
			var port_carousel = jQuery(this);
			var port_holder = port_carousel.children('#gallery-item-holder');
			var port_item = port_carousel.find('.footer-gallery-item');
			
			port_item.css('float', 'left');
			
			var child_size;
			if( port_item.filter(':first').hasClass('three') ){
				port_holder.attr('data-num', 4);
				child_size = port_carousel.width() / 4;
			}else if( port_item.filter(':first').hasClass('four') ){
				port_holder.attr('data-num', 3);
				child_size = port_carousel.width() / 3;
			}else if( port_item.filter(':first').hasClass('six') ){
				port_holder.attr('data-num', 2);
				child_size = port_carousel.width() / 2;
			}else if( port_item.filter(':first').hasClass('one-fifth') ){
				port_holder.attr('data-num', 5);
				child_size = port_carousel.width() / 5;
			}
			
			if( jQuery('html').filter(':first').width() <= '767' ){
				port_holder.attr('data-num', 1);
				child_size = port_carousel.width();
			}
			
			port_item.css('width', child_size );
			
			port_holder.attr('data-width', child_size);
			port_holder.attr('data-max', port_item.length);
			port_holder.width( port_item.length * child_size );
			
			var cur_index = parseInt(port_holder.attr('data-index'));
			port_holder.css({ 'margin-left': -(cur_index * child_size) });
		});
	}
	
	// bind the navigation
	var port_nav = port_carousel_wrapper.children('.footer-gallery-nav-wrapper');
	port_nav.children('.footer-gallery-nav-left').click(function(){
		var port_holder = jQuery(this).parent().siblings('.gallery-item-holder');
		var cur_index = parseInt(port_holder.attr('data-index'));
		
		if( cur_index > 0 ){ cur_index--;  }
		
		port_holder.attr('data-index', cur_index);
		port_holder.animate({ 'margin-left': -(cur_index * parseInt(port_holder.attr('data-width'))) });
	});
	port_nav.children('.footer-gallery-nav-right').click(function(){
		var port_holder = jQuery(this).parent().siblings('.gallery-item-holder');
		var cur_index = parseInt(port_holder.attr('data-index'));
		
		if( cur_index + parseInt(port_holder.attr('data-num')) < parseInt(port_holder.attr('data-max')) ){
			cur_index++;
		}
		
		port_holder.attr('data-index', cur_index);
		port_holder.animate({ 'margin-left': -(cur_index * parseInt(port_holder.attr('data-width'))) });
	});
	
	carousel_port_init();
	
	jQuery(window).resize(function(){
		carousel_port_init();
	});
	
});