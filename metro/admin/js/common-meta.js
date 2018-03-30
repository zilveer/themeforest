jQuery(function($) {

	$('.om-metabox-gallery-select').change(function(){
		var gallery_id=$(this).data('field-id')+'-gallery-wrapper';
		var attached_id=$(this).data('field-id')+'-gallery-attached';
		if($(this).val() == 'custom') {
			$('#'+gallery_id).slideDown(300);
			$('#'+attached_id).slideUp(300);
			initialize_metabox_gallery(gallery_id);
		}	else {
			$('#'+gallery_id).slideUp(300);
			$('#'+attached_id).slideDown(300);
		}
	}).change();
	
	$('.om-metabox-gallery-library-refresh').click(function(){
		var gallery_id=$(this).data('field-id')+'-gallery-wrapper';
		initialize_metabox_gallery(gallery_id);
		return false;
	});
	
	$('.om-metabox-gallery-select').each(function(){
		var gallery_id=$(this).data('field-id')+'-gallery-wrapper';
		var $wrapper=$('#'+gallery_id);
		var images_input_id=$wrapper.data('images-input-id');
		var $chosen_images=$wrapper.find('.om-metabox-gallery-images');
		
		$chosen_images.sortable({
			update: function(event, ui) {
				$('#'+images_input_id).attr('value',$chosen_images.sortable('toArray',{attribute: 'data-attachment-id'}).toString());
			}
		});
	});

		
	function initialize_metabox_gallery(gallery_id){

			var ajaxRequest;
			
			var $wrapper=$('#'+gallery_id);
			var images_input_id=$wrapper.data('images-input-id');
			var current_page=$wrapper.data('current-page');
			if(!current_page)
				current_page=1;
			var $images_box=$wrapper.find('.om-metabox-gallery-library-images');
			var $controls=$wrapper.find('.om-metabox-gallery-library-controls').empty();
			var $chosen_images=$wrapper.find('.om-metabox-gallery-images');
			var $no_images_label=$wrapper.find('.om-metabox-gallery-images-no-images');
			

			
			jQuery.post(
			   ajaxurl, 
			   {
			      action: 'om_metabox_gallery',
			      page: current_page
			   }, 
			   function(data){
			   	fill_controls(data);
					fill_images(data);
			   }
			);
			
			/*******************************************/

			$chosen_images.find('.om-remove').unbind('click').each(function(){
				attach_remove(this);
			});
							
			/*******************************************/
			
			function fill_images(data) {
	   		$images_box.empty();
	      for(i in data.images) {
	      	var $img=$('<img src="'+data.images[i].src+'" width="'+data.images[i].width+'" height="'+data.images[i].height+'" />');
	      	var $item=$('<div class="om-item"/>');
	      	$img.appendTo($item);
	      	$item.data('attachment-id',data.images[i].ID);
					$item.click(function(){
						var $new_img=$(this).children('img').clone();
						var $img_wrapper=$('<div class="om-item" />').hide();
						$new_img.appendTo($img_wrapper);
						var $remove=$('<span class="om-remove" />');
						$img_wrapper.data('attachment-id',$(this).data('attachment-id')).attr('data-attachment-id',$(this).data('attachment-id'));
						$remove.appendTo($img_wrapper);
						attach_remove($remove);
						
						$img_wrapper.appendTo($chosen_images).show(200);

						var count=$chosen_images.data('count');
						if(!count)
							count=0;
						count++;

						if(count == 1)
							$no_images_label.slideUp(200);						
						
						$chosen_images.data('count',count);
						
						var $img_anim=$(this).clone();
						var pos=$(this).position();
						$img_anim.css({
							position: 'absolute',
							top: pos.top+'px',
							left: pos.left+'px',
							boxShadow: 'none'
						});
						$img_anim.insertAfter(this).animate({marginTop: '-100px', opacity: 0}, 200, function(){
							$(this).remove();
						});

						refresh_input();

						return false;
					});

	      	$item.appendTo($images_box);
	      	
	      }
	      $images_box.append('<div class="clear" />');
			}
			
			/*******************************************/
			
			function attach_remove(obj) {
				var $obj=$(obj);
				$obj.click(function(){
					$(this).parent().hide(100,function(){
						$(this).remove();
						refresh_input();
					});
					var count=$chosen_images.data('count');
					count--;
					$chosen_images.data('count',count);

					if(count == 0)
						$no_images_label.slideDown(200);
					return false;
				});
			}
			
			/*******************************************/
			
			function refresh_input() {
				var ids=[];

				$chosen_images.children('.om-item').each(function(){
					ids.push($(this).data('attachment-id'));
				});
				
				$('#'+images_input_id).attr('value',ids.join(','));
			}
			
			/*******************************************/
			
			function fill_controls(data) {
				if(data.max_num_pages > 1) {
					var $pager=$('<ul class="om-metabox-gallery-pager" />');
					for(var i=1;i<=data.max_num_pages;i++) {
						var $li=$('<li class="button">'+i+'</li>');
						$li.data('page',i);
						$li.addClass('glp-'+i);
						if(i == data.page)
							$li.addClass('active');
						
						$li.click(function(){
							if($(this).hasClass('active'))
								return false;
							if(ajaxRequest)
								ajaxRequest.abort();
							
							$images_box.addClass('loading');
							
							current_page=$(this).data('page');
							$pager.find('li.active').removeClass('active');
							$(this).addClass('active');
							
							if(current_page > 1)
								$prev.removeClass('button-disabled');
							if(current_page < data.max_num_pages)
								$next.removeClass('button-disabled');
							if(current_page == 1)
								$prev.addClass('button-disabled');
							else if( current_page == data.max_num_pages)
								$next.addClass('button-disabled');
							
							ajaxRequest=jQuery.post(
							   ajaxurl,
							   {
							      action: 'om_metabox_gallery',
							      page: current_page
							   }, 
							   function(data_){
									fill_images(data_);
							   }
							).always(function(){
								$images_box.removeClass('loading');
							});
							
							return false;
						});
							
						$li.appendTo($pager);
					}
					$pager.appendTo($controls);
					
					var $prev_next=$('<div class="om-metabox-gallery-prevnext" />');
					$prev=$('<span class="om-metabox-gallery-prevnext-prev button button-primary button-disabled">&larr;</span>');
					$prev.click(function(){
						if(current_page < 2)
							return false;
						if(ajaxRequest)
							ajaxRequest.abort();
						$images_box.addClass('loading');
							
						current_page--;
						$pager.find('li.active').removeClass('active');
						$pager.find('li.glp-'+current_page).addClass('active');

						$next.removeClass('button-disabled');
						if(current_page == 1)
							$prev.addClass('button-disabled');
						
						ajaxRequest=jQuery.post(
						   ajaxurl,
						   {
						      action: 'om_metabox_gallery',
						      page: current_page
						   }, 
						   function(data_){
								fill_images(data_);
						   }
						).always(function(){
							$images_box.removeClass('loading');
						});
						
					});
					$prev.appendTo($prev_next);
					
					$next=$('<span class="om-metabox-gallery-prevnext-next button button-primary">&rarr;</span>');
					$next.click(function(){
						if(current_page >= data.max_num_pages)
							return false;
						if(ajaxRequest)
							ajaxRequest.abort();
						$images_box.addClass('loading');
							
						current_page++;
						$pager.find('li.active').removeClass('active');
						$pager.find('li.glp-'+current_page).addClass('active');

						$prev.removeClass('button-disabled');
						if(current_page == data.max_num_pages)
							$next.addClass('button-disabled');
						
						ajaxRequest=jQuery.post(
						   ajaxurl,
						   {
						      action: 'om_metabox_gallery',
						      page: current_page
						   }, 
						   function(data_){
								fill_images(data_);
						   }
						).always(function(){
							$images_box.removeClass('loading');
						});
						
					});
					$next.appendTo($prev_next);
					
					$prev_next.appendTo($controls);
				}
			}
			
	}
	
});