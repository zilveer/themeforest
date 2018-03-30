/**
 * This file contains the main JavaScript functionality that manages custom pages
 * within the admin section.
 * @author Pexeto
 */
(function($){
	$.fn.customPage=function(options){
		var defaults={
				//selectors
				itemWrapper:'.custom-item-wrapper',
				valueContainer:'div.item > span',
				singleItem:'div.item',
				nonce:'#pexeto_nonce',
				
				//messages
				errorMsg:'An error occurred, please try again later.',
				instanceMsg:'An instance with this name already exists',
				deleteMsg:'This item will be permanently deleted. Are you sure?',
				deleteSliderMsg:'This slider and all the items that belong to it will be permanently deleted. Are you sure?'
			};
			
			options=$.extend(defaults, options);
			var root=null;
			
			$root=$(this);
			
	/**
	 * Inits all the functionality.
	 */
	function init(){
		setAddButtonClickHandlers();
		setAddInstanceClickHandlers();
		setAccordion();
		setSortableFunctionality();
		setDeleteButtonClickHandlers();
		setEditButtonClickHandlers();
		setDeleteSliderClickHandlers();
		
		$root.delegate('.hover', 'mouseover', function(){
			$(this).css({cursor:'pointer'});	
		});
		
		if (navigator.userAgent.toLowerCase().indexOf('safari') > -1){
			$('body').addClass('chrome');
		}
		
	}

	/**
	 * Adds click handlers to the "Add new item" button - first validates the
	 * form input and if it is valid, creates an AJAX request to save the item data.
	 */
	function setAddButtonClickHandlers(){
		$root.delegate('.custom-option-button', 'click', function(){
			var data={},
				$form=null,
				valid=true;
			
			$form=$(this).parents('form.custom-page-form:first');
			//validate the form - check if the required fields are filled in
			$form.find('input.required, textarea.required').each(function(){
				$(this).removeClass('invalid');
				if(!$(this).val()){
					$(this).addClass('invalid');
					valid=false;
				}
			});	
			
			if(valid){
				//the data is valid
				var $sortable=$form.parents('.custom-section:first').find('ul.sortable'),
				order=$sortable.sortable('toArray').join(',');
				
				data=$form.serialize()+'&action=pexeto_insert_post&order='+order+'&nonce='+$(options.nonce).val();
				
				$form.find('.loading').show();
				
				//create an AJAX request to the server to save the input data
				$.ajax({
					type:'post',
					data:data,
					url:ajaxurl,
					dataType:'html',
					success:function(html){
						$sortable.append(html);
						$form.get(0).reset();
						$form.find('input.upload').val('');
						$form.find('.loading').hide();
					}
				});
			}
		});
		
		$root.delegate('input, textarea', 'focus', function(){
			$(this).removeClass('invalid');
		});
	}
	
	/**
	 * Adds click handlers to the "Add new instance" button- displays a dialog for the new instance name.
	 */
	function setAddInstanceClickHandlers(){
		$('.new-instance-button').click(function(e){
			e.preventDefault();
			var dialogHtml='<div><label>Slider name:</label><input type="text" id="instance-name" /><div class="loading"></div></div>',
				btn=$(this);
			$(dialogHtml).dialog({
				title:btn.text(),
				buttons: { "Add": function() { 
						addInstance($(this).find('#instance-name').val(), $(this)); 
					} 
				}
			});
		});
	}
	
	/**
	 * Creates an AJAX request for adding a new instance to a custom page.
	 */
	function addInstance(name, $dialog){
		var data={action:'pexeto_add_instance', name:name, taxonomy:$('#taxnonomy_id').val(), post_type:$('#post_type').val(), 'nonce':$(options.nonce).val()};
		$.ajax({
			url:ajaxurl,
			data:data,
			type:'post',
			dataType:'html',
			success:function(html){
				if(html!=='-1'){
					$content=$(html);
					$content.insertBefore(options.itemWrapper+':first');
					$dialog.dialog("close").remove();
					$(".sortable").sortable();
					 var uploadBtns = $content.find('.pexeto-upload-btn');
					 if(uploadBtns.length){
						 uploadBtns.each(function(){
							pexetoPageOptions.loadUploader(jQuery(this));
						});
					 }
				}else{
					//an error occurred
					$dialog.dialog("close").remove();
					displayMessage(options.instanceMsg);
				}
			}
		});
	}
	
	/**
	 * Sets the accordion functionality for the additional instances.
	 */
	function setAccordion(){
		var closedClass='closed-container';

		//accordion button action	
		$root.delegate(options.itemWrapper+' h3', 'click', function(){
			var $container=$(this).siblings('.custom-section:first'),
				$parent=$(this).parents(options.itemWrapper+':first');
			if($container.css('display')==='none'){
				$container.slideDown();
				$parent.removeClass(closedClass);
			}else{
				$container.slideUp();	
				$parent.addClass(closedClass);
			}
		});
	 
		//hide all the divs except the first one on load	
		$(".custom-section").not(':first').each(function(){
			$(this).hide().parents(options.itemWrapper+':first').addClass(closedClass);
		});
		
	}
	
	/**
	 * Sets the sortable item functionality - sets jQuery UI sortable functionality to the
	 * items and when the order has been changed and the "Save order" button is clicked, sends an AJAX
	 * request to the server to send the new order.
	 */
	function setSortableFunctionality(){
		$(".sortable").sortable();
		
		//on update(change) of the order of the items
		$root.delegate('.sortable', 'sortupdate', function(){
			if(!$(this).data('firstchanged')){
				var $ul=$(this);
				//do this only with the first change
				$('<a />', {'class':'button order-button', text:'Save Order'}).click(function(){
					var order=$ul.sortable('toArray').join(','),
						$container=$(this).parents(options.itemWrapper+':first'),
						category=$container.find('.category').val(),
						posttype=$container.find('input[name=post_type]').val(),
						data={'action':'pexeto_save_order', 'order':order, 'category':category,'nonce':$(options.nonce).val(),'posttype':posttype};
					
					$container.find('.custom-container .loading').show();
					
					//send an AJAX request to the server to save the new order
					$.ajax({
						type:'post',
						url:ajaxurl,
						data:data,
						success:function(res){
							$container.find('.loading').hide();
						}
					});
					
				})
				.insertBefore($ul);
				$(this).data('firstchanged', true);
			}
		});
		
		//save the initial order before the sorting starts
		$root.delegate('.sortable', 'sortstart', function(){
			if(!$(this).data('firstchanged')){
				$(this).data('initialorder',$(this).sortable('toArray'));
			}
		});
	}
	
	/**
	 * Sets delete button click handlers to the items. A confirmation dialog is displayed and
	 * after the confirmation, an AJAX request is sent to the server to perform the item delete.
	 */
	function setDeleteButtonClickHandlers(){
		$root.delegate('.delete-button', 'click', function(){
			var $btn=$(this);
			//show a confirmation dialog
			$('<div>'+options.deleteMsg+'</br><div class="loading"></div></div>').dialog({
				title:'Delete Item',
				height:160,
				buttons: {
					"Delete": function() {
						//delete confirmed
						var $parentLi=$btn.parents('li:first'),
							itemid=$parentLi.find('#itemid').val(),
							category=$parentLi.parents(options.itemWrapper+':first').find('.category').val(),
							posttype=$parentLi.parents(options.itemWrapper+':first').find('input[name=post_type]').val(),
							data={'action':'pexeto_detele_item', 'itemid':itemid, 'category':category, 'nonce':$(options.nonce).val(),'posttype':posttype},
							$dialog=$(this);
						
						$dialog.find('.loading').show();
						
						//send the AJAX request to the server to delete the item
						$.ajax({
							type:'post',
							url:ajaxurl,
							data:data,
							success:function(res){
								if(res==='-1'){
									//an error occurred
									$dialog.dialog( "close" ).remove();
									displayMessage(options.errorMsg);
								}else{
									$dialog.dialog( "close" ).remove();
									$parentLi.slideUp(500,function(){
										$(this).remove();
									});
								}
							}
						});
					},
					"Cancel": function() {
						//delete canceled
						$( this ).dialog( "close" ).remove();
					}
				}
			});
		});
	}
	
	/**
	 * Sets the edit item functionality - when the edit button is clicked, replaces all the text elements
	 * with the corresponding inputs so that they can be edited. When the "Done" button is clicked, sends an
	 * AJAX request to the server to save the changed data.
	 */
	function setEditButtonClickHandlers(){
		$root.delegate('.edit-button', 'click', function(){
			var $parentLi=$(this).parents('li:first');
			
			$parentLi.find(options.valueContainer).each(function(){
				var $that=$(this),
					itemClasses=$that.attr('class').split(" "),
					isTextarea=itemClasses[1]==='textarea'?true:false;
				
				//replace the value span with an input/textarea to enable editing
				if(isTextarea){
					$that.replaceWith($('<textarea />', {name:itemClasses[0], 'class':$that.attr('class')}).val($that.html()));
				}else{
					$that.replaceWith($('<input />', {name:itemClasses[0], type:'text', 'class':$that.attr('class')}).val($that.html()));
				}
			});
			
			//set the done button click handler (when done editing)
			$(this).replaceWith($('<div />', {'class':'done-button hover'}).click(function(){
				var valid=true,
					data=[],
					$btn=$(this),
					$inputs=$parentLi.find('input, textarea');
				
				$inputs.each(function(){
					var $that=$(this);
					
					//serialize the data
					data.push($.param($that));
					
					//validate the input
					if($that.hasClass('required')){
						$that.removeClass('invalid');
						if(!$that.val()){
							$that.addClass('invalid');
							valid=false;
						}
					}
				});	
				
				if(valid){
					$parentLi.find('.loading').show();
					var dataString=data.join('&')+'&action=pexeto_edit_item&nonce='+$(options.nonce).val();
					//send the AJAX request to the server to save the item
					$.ajax({
						url:ajaxurl,
						data:dataString,
						type:'post',
						success:function(){
							$inputs.each(function(){
								if($(this).attr('type')!=='hidden'){
									//replace the inputs with normal text elements
									var $input=$(this);
									$input.replaceWith($('<span />', {'class':$input.attr('class'), html:$input.val()}));
									$parentLi.find('.loading').hide();
									$btn.replaceWith($('<div />', {'class':'edit-button hover'}));
								}
							});
						}
					});
				}
			}));
			
			
		});
	}
	
	/**
	 * Sets the delete slider functionality. A confirmation dialog is displayed and
	 * after the confirmation, an AJAX request is sent to the server to perform the slider delete.
	 */
	function setDeleteSliderClickHandlers(){
		$root.delegate('.delete-slider-button', 'click', function(){
			var $btn=$(this);
			//show the confirmation dialog
			$('<div>'+options.deleteSliderMsg+'</br><div class="loading"></div></div>').dialog({
				title:'Delete Slider',
				height:180,
				buttons: {
					"Delete": function() {
						//delete confirmed
						var $parent=$btn.parents(options.itemWrapper+':first'),
							category=$parent.find('.category').val(),
							data={'action':'pexeto_detele_instance', 'taxonomy':$('#taxnonomy_id').val(), 'category':category, 'post_type':$('#post_type').val(), 'nonce':$(options.nonce).val()},
							$dialog=$(this);

						$dialog.find('.loading').show();
						
						//send the AJAX request to the server to permform the delete action
						$.ajax({
							type:'post',
							url:ajaxurl,
							data:data,
							success:function(){
								$dialog.dialog( "close" ).remove();
								$parent.slideUp(500,function(){
									$(this).remove();
								});
							}
						});
					},
					"Cancel": function() {
						//delete canceled
						$( this ).dialog( "close" ).remove();
					}
				}
			});
		});
	}
	
	/**
	 * Displays a modal dialog with a message.
	 * @param message the message to be displayed
	 */
	function displayMessage(message){
		$('<div>'+message+'</div>').dialog({buttons: {
			"Close": function() {
				$( this ).dialog( "close" ).remove();
			}
		}});
	}
	
	if($root.length>0){
		init();
	}
	
};
}(jQuery));

jQuery(function(){
	jQuery('.custom-page-wrapper:first').customPage();
});






