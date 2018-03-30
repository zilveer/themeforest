jQuery(document).ready(function(){

	var port_carousel_wrapper = jQuery('.blog-carousel-wrapper');
	
	function carousel_port_init(){
		port_carousel_wrapper.each(function(){
			var port_carousel = jQuery(this);
			var port_holder = port_carousel.children('.blog-carousel-holder');
			var port_item = port_carousel.find('.gdl-blog-widget');
			
			port_item.css('float', 'left');
			
			var parent_col = 12;
			if( jQuery(this).parent().parent().hasClass('six') ){
				parent_col = 6;
			}else if( jQuery(this).parent().parent().hasClass('eight') ){
				parent_col = 8;
			}else if( jQuery(this).parent().parent().hasClass('four') ){
				parent_col = 4;
			}else if( jQuery(this).parent().parent().hasClass('three') ){
				parent_col = 3;
			}
			
			var child_col;
			var child_size;
			if( port_item.filter(':first').hasClass('three') ){
				child_col = 3;
				child_size = port_carousel.parents('.row').width() / 4;
			}else if( port_item.filter(':first').hasClass('four') ){
				child_col = 4;
				child_size = port_carousel.parents('.row').width() / 3;
			}else if( port_item.filter(':first').hasClass('six') ){
				child_col = 6;
				child_size = port_carousel.parents('.row').width() / 2;
			}
			port_holder.attr('data-num', parseInt(parent_col/child_col) );
			
			if( jQuery('html').filter(':first').width() <= '767' ){
				port_holder.attr('data-num', 1);
				child_size = port_carousel.parents('.row').width();
			}
			
			port_item.css('width', child_size );
			
			port_holder.attr('data-width', child_size);
			port_holder.attr('data-max', port_item.length);
			port_holder.width( port_item.length * child_size );
			
			var cur_index = parseInt(port_holder.attr('data-index'));
			port_holder.css({ 'margin-left': -(cur_index * child_size + 10) });
		});
	}
	
	// bind the navigation
	var port_nav = port_carousel_wrapper.children('.blog-nav-wrapper');
	port_nav.children('.blog-nav.left').click(function(){
		var port_holder = jQuery(this).parent('.blog-nav-wrapper').siblings('.blog-carousel-holder');
		var cur_index = parseInt(port_holder.attr('data-index'));
		
		if( cur_index > 0 ){ cur_index--;  }
		port_holder.attr('data-index', cur_index);
		port_holder.animate({ 'margin-left': -(cur_index * parseInt(port_holder.attr('data-width')) + 10) });
	});
	port_nav.children('.blog-nav.right').click(function(){
		var port_holder = jQuery(this).parent('.blog-nav-wrapper').siblings('.blog-carousel-holder');
		var cur_index = parseInt(port_holder.attr('data-index'));
		if( cur_index + parseInt(port_holder.attr('data-num')) < parseInt(port_holder.attr('data-max')) ){
			cur_index++;
		}
		
		port_holder.attr('data-index', cur_index);
		port_holder.animate({ 'margin-left': -(cur_index * parseInt(port_holder.attr('data-width')) + 10) });
	});
	carousel_port_init();

	
	jQuery(window).resize(function(){
		carousel_port_init();
	});
	
});