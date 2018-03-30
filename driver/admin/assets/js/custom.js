jQuery(document).ready(function($) {

	$('.field_key-field_51c4d6b5f6477 .has-image').on('click', function(e) {
	    imagePositionCursor(e, this);
	});
	
	var down = false;
	$('.field_key-field_51c4d6b5f6477 .has-image').on({
	    mousedown : function(){
	     down = true;  
	    },
	    mousemove : function(e){
	        if(!down) return;
	        
	        e.preventDefault();
	        imagePositionCursor(e, this);
	    },
	    mouseup : function(){
	      down = false;
	    }
	});

	$('tr.field_key-field_51c4d622f6478').find('input[type="text"]').each(function() {
		
		var val = $(this).val();
		if(val != '') {
			
			position = val.split(' ');
			var left = position[0];
			var top = position[1];
			
			var image_wrap = $(this).closest('table.acf_input').find('.field_key-field_51c4d6b5f6477 .has-image');
			image_wrap.find('span').remove();
			image_wrap.append('<span />');
			image_wrap.find('span').css({'position':'absolute', 'left': left+'%', 'top': top+'%', 'background': 'red', 'width':'15px', 'height':'15px', 'opacity': 0.8 });
		}
	});
	
	function imagePositionCursor(e, obj) {
		
		var image_wrap = $(obj);
		
		var width = image_wrap.width();
		var height = image_wrap.height();
		
	    var offset = image_wrap.offset();
	    var row = image_wrap.closest('table.acf_input');
	
	    var left = (e.pageX - offset.left);
	    var top = (e.pageY - offset.top);
	    
	    top = (top / height) * 100;
	    left = (left / width) * 100;

	    var position = left+'% '+top+'%';
	    row.find('tr.field_key-field_51c4d622f6478').find('input[type="text"]').val(position).data('left', left).data('top', top);;
	
	    image_wrap.find('span').remove();
	    image_wrap.append('<span />');
		image_wrap.find('span').css({'position':'absolute', 'left': left+'%', 'top': top+'%', 'background': 'red', 'width':'15px', 'height':'15px', 'opacity': 0.8 });
	    
	}

});