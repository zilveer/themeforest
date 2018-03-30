(function($){
	var prefix_header = $('#prefix_header').val();
	var prefix_footer = $('#prefix_footer').val();
	var prefix_other = $('#prefix_other').val();

	function reloadSelect(select, data) {
		select.empty();
		for(var option in data) {

			option = $('<option>', {
				value: data[option].alias,
				text: data[option].title
			});			
			
			select.append(option);
		}
	}

	/* LAYOUTS FUNCTIONALITY*/
	$layoutGrid = $('#GridWrapper').layoutGrid({divider_width: 12, sections: 12});

	var layoutData = {};
	$.ajax({
		url: ajaxurl,
		async: false,
		data: {
			action:'get_layout_data', 
			alias: layoutAlias // 'test-layout'
		}
	}).done(function(response){

		if ( $.trim(response) == 'false' ) {
			// Dummy Data (needed for everything to load and work. without this some of the triggers don't fire.)
			response = '{"action":"save_layout","title":"New Layout","alias":"new-layout","header":"","footer":"","body_structure":{"row_0":{"column_0":{"content_elements":{"element-0":{"content_type":"default_content","content_source":""}},"grid_position":"12"}}}}';
		}


		layoutData = $.parseJSON($.trim(response));
		
		if(layoutData != null){
			loadHeaderSettings();
			loadFooterSettings();
			// render layout data to visual view
			for(row in layoutData.body_structure){

				var $newRow = $('#RowTemplate .rowWrapper').clone().insertBefore( $('#GridEnd') );

				for(column in layoutData.body_structure[row]){					
					
					var $newOnlyColumn = $('#OnlyColumnTemplate').contents().clone();
								
					for(var content_element in layoutData.body_structure[row][column].content_elements) {						
						
						var $newElement = $('#OnlyContentElementTemplate').contents().clone();						
						var type = layoutData.body_structure[row][column].content_elements[content_element].content_type;
						var source = layoutData.body_structure[row][column].content_elements[content_element].content_source;					
						
						if(type != 'default_content'){
							$newElement.find('select[name="content_element_type"]')
	                        	.attr('data-content_source-saved-value', source);
						}

						$newElement.find('select[name="content_element_type"] option[value="'+type+'"]')           
                        	.attr('selected', 'selected');

						$newElement.clone()
							.insertBefore($newOnlyColumn.find('#ColumnEnd'));
							
					}
					
					// Set column visibility
					$newOnlyColumn.find('.responsive-visibility').each( function(index, columnVisbility){
						var showOn = 0;
						for(visibleOnIndex in layoutData.body_structure[row][column].visible_on){
							if($(columnVisbility).hasClass(layoutData.body_structure[row][column].visible_on[visibleOnIndex]+'-view')){
								showOn++;
							}							
						}

						if(showOn == 0){
							$(columnVisbility).removeClass('show-on').addClass('hide-on');
						}						
					});
				
					$newItem = $newOnlyColumn.clone();
					$newItem.data('item', {grid_position: layoutData.body_structure[row][column].grid_position});

					// Add the column to the layout
					$newRow.find('.rowContainer').append($newItem);					

				}

				// Initialize everything again...
				$layoutGrid.update(function () {
					// if($('.rowWrapper').length <= 2) {
					// 	$('#AddNewRow').trigger('click');
					// 	$('.rowWrapper').first().next().css('display','none');
					// }
					$layoutGrid.on('change', 'select[name="content_element_type"]', function(e) {  // modified binding to apply to new elements
					// $('select[name="content_element_type"]').on('change', function () {
						
						var dataSource = $(this).val();		
						var currentLayoutElement = $(this).parent();
						var contentListSelect = $(this).parent().find('select[name="content_element_source"]');		
						var secondaryContainer = contentListSelect.parent('.secondary-select');
						var contentSelectDescription = $(this).parent().find('.content-type-help-text');	
						var content_source = $(this).parent().find('select[name="content_element_type"]').data('content_source-saved-value');		

						// Show loading graphic
						currentLayoutElement.find('.spinner').fadeIn(100);

						// Show current description
						contentSelectDescription.find('[class^="description-"]').fadeOut(100).filter('.description-'+dataSource).delay(100).fadeIn(200);

						// Update the select values
						getContentElementsBySource(dataSource, function (contentElements) {
							if (contentElements == '') {
								secondaryContainer.fadeOut(100);
							} else {
								secondaryContainer.fadeIn(200);
								reloadSelect(contentListSelect, contentElements);
								contentListSelect.find('option[value="'+content_source+'"]').attr('selected', 'selected');
							}
							// Hide loading graphic
							currentLayoutElement.find('.spinner').fadeOut(200);

							// for good measure... to ensuer everthing fits
							$(window).trigger('resize');
						});
					});

					$('select[name="content_element_type"]').trigger('change');	
				});				
				$layoutGrid.new_column_buttons($newRow);			
			}
		}
		
	});

	function getContentElementsBySource(source, callback){
		
		var async = false; 

		if(callback) {
			var async = true;
		}

		var data = {};
		
		$.ajax({
			url: ajaxurl,
			async: async,
			data: {
				action: 'get_content_elements',
				source: source
			},
			
		}).done(function (response) {
			data = $.parseJSON(response);
			if(callback) {
				callback(data);
			}					
		});

		return data;
	}

	// save event
	$('body').on('click touchstart', '#save_structure', function(e){		
		e.preventDefault();

		if($('#title').val() != '') {							
			$(this).parent().find('.spinner').fadeIn(200);
			//$('.rowWrapper').first().next().remove();

			var layout = {};
			// make layout object
			$('.rowWrapper').each(function(rowIndex, row){

				layout['row_'+rowIndex] = {};
				// get columns in row
				$(row).find('.column').each(function(columnIndex,column){
					
					// set visibility settings to column
					var visibleOn = [];
					$(column).find('.responsive-visibility').each(function(index, headerElement){
						if($(headerElement).hasClass('show-on')){
							visibleOn.push($(headerElement).attr('id'));							
						}
					});

					// set content elements in column
					var contentElements = {};
					$(column).find('.content-element').each(function(index, contentElement){
						contentElements['element-'+index] = {
							content_type: $(contentElement).find('select[name="content_element_type"]').val(),
							content_source: $(contentElement).find('select[name="content_element_source"]').val(),
						};				
					});
					// Debug
					// console.log('CONTENT ELEMENTS:');
					// console.log(contentElements);

					// grid position (column size)
					var gridPosition = 0;
					$divider = $(column).next('.column-divider').data('item');
					gridPosition = $divider.grid_position;

					layout['row_'+rowIndex]['column_'+columnIndex] = {
						content_elements: contentElements,
						visible_on: visibleOn,
						grid_position: gridPosition,
					};

				});				

			});
			// Debug
			// console.log('LAYOUT:');
			// console.log(layout);

			var data, is_new_header, is_new_footer;

			is_new_header = ($('#none_header').length > 0 )? true : false;
			is_new_footer = ($('#none_footer').length > 0 )? true : false;

			header_alias = $("select[name='header_select']").val();
			if($.trim($('input[name="header_title"]').val()) != '') {
				data = {
					action: 'update_header',
					title: $('input[name="header_title"]').val(),
				};
				
				if( ! is_new_header )
					data.alias = $('select[name="header_select"]').val();
				$.ajax({
					url: ajaxurl,
					async:false,
					data: data,
				}).done(function(response){
					header_alias = $("select[name='header_select']").val();
					if( is_new_header ) {
					    var alias = $('input[name="header_title"]').val();
						header_alias = alias.replace(/\s+/g, '-').toLowerCase();
						header_alias = header_alias.replace(/'/g, "");
						$('select[name="header_select"]').val(header_alias);
						$('#none_header').last().attr("id", header_alias);
					}
				});				
			}

			footer_alias = $("select[name='footer_select']").val();
			if($.trim($('input[name="footer_title"]').val()) != '') {
				data = {
					action: 'update_footer',
					title: $('input[name="footer_title"]').val(),
					};
				if( ! is_new_footer )
					data.alias = $('select[name="footer_select"]').val();
				$.ajax({
					url: ajaxurl,
					async:false,
					data: data,
				}).done(function(response){
					footer_alias = $("select[name='footer_select']").val();
					if( is_new_footer ) {
					    var alias = $('input[name="footer_title"]').val();
						footer_alias = alias.replace(/\s+/g, '-').toLowerCase();
						footer_alias = footer_alias.replace(/'/g, "");
						$('select[name="footer_select"]').val(footer_alias);
						$('#none_footer').last().attr("id", footer_alias);
					}
				});
			}

			// ajax request to save layout
			data = {
					action: 'save_layout',
					title: $('#title').val(),
					alias: $('#layout_alias').val(),
					header: header_alias,
					footer: footer_alias,
					body_structure: layout,
			};

			$.ajax({
				url: ajaxurl,
				async:false,
				data: data
			}).done(function(response){
				// Save custom options
				if($.trim($('input[name="header_title"]').val()) != ''){
					save_custom_options(header_alias, prefix_header+header_alias, 'header');
				}

				if($.trim($('input[name="footer_title"]').val()) != ''){
					save_custom_options(footer_alias, prefix_footer+footer_alias, 'footer');
				}
				
				save_custom_options('other_options', prefix_other+$('#layout_alias').val(), 'other_options');

				document.location = '?page=layout-manager&navigation=edit-layout&alias=' + $('#layout_alias').val();				
			});
		}
		else alert('Title must be set before saving!');

	});

	/* END LAYOUTS FUNCTIONALITY*/

	/* FOOTER AND HEADER FUNCTIONALITY */	
	var action = '';
	$('.control-bar').on('click touchstart', '#EditHeader, #AddHeader', function(e){
		action = $(this).attr('id');
		
		// Set the input value
		if (action == "AddHeader") {
			$('input[name="header_title"]').val('')
			loadHeaderSettings('none_header');
		} else {
			if ($("select[name='header_select'] option:selected").text().trim() != '')
				$('input[name="header_title"]').val($("select[name='header_select'] option:selected").text().trim());
			else
				return false;			
		}
		// Toggle visibility
		$('#HeaderSelect').fadeOut();
		$('#HeaderAddNew').fadeOut();
		$('#HeaderAddEdit').fadeIn();


		$('#headerAddEditForm').slideDown();

		// suppress href link
		e.preventDefault()

	}).on('click touchstart', '#EditFooter, #AddFooter', function(e) { 
		action = $(this).attr('id');
		// Set the input value
		if (action == "AddFooter") {
			$('input[name="footer_title"]').val('')
			loadFooterSettings('none_footer');
		} else {
			if ($("select[name='footer_select'] option:selected").text().trim() != '')
				$('input[name="footer_title"]').val($("select[name='footer_select'] option:selected").text().trim());
			else
				return false;
		}
		// Toggle visibility
		$('#FooterSelect').fadeOut();
		$('#FooterAddNew').fadeOut();
		$('#FooterAddEdit').fadeIn();

		$('#footerAddEditForm').slideDown();
		
		// suppress href link
		e.preventDefault()

	});

	function updateHeaderSelectAndSettings(){

		var headers = {};

		$.ajax({
			url: ajaxurl,
			async:false,
			data: {
				action:'get_headers'
			}
		}).done(function(response){
			headers = $.parseJSON(response);
			reloadSelect($('select[name="header_select"]'), headers);
		});		
							
		//$('input[name="header_title"]').val('');
		// $('select[name="header_select"]').val(layoutData.header);
	}

	// Click behaviors for Edit buttons
	$('.control-bar').on('click touchstart', '#SaveHeader, #CancelEditHeader', function(e) { 

		function updateHeaderSelect() {
			$.ajax({
				url: ajaxurl,
				async:false,
				data: {
					action:'get_headers'
				}
			}).done(function(response){
                var headers = $.parseJSON(response.replace(/\\/g, ""));        // replace all backslashes with nothing
				reloadSelect($('select[name="header_select"]'), headers);
			});
		}

		// Add/Edit header action
		if($(this).attr('id') == 'SaveHeader' && $('input[name="header_title"]').val().trim() != ''){
			$('#HeaderWrapper').find('.spinner').fadeIn(100);
			var data = {
				action: 'update_header',
				title: $('input[name="header_title"]').val(),
			};
		
			if(action == 'EditHeader'){
				data.alias = $('select[name="header_select"]').val();

				$.post(ajaxurl, data, function(response){					
					updateHeaderSelect();
					$('select[name="header_select"]').val(data.alias);
					$('#HeaderWrapper').find('.spinner').fadeOut(100);

					var header_alias = $("select[name='header_select']").val();
					save_custom_options(header_alias, prefix_header+header_alias, 'header');
				});
			}
			else if(action == 'AddHeader'){
				$.post(ajaxurl, data, function(response){
					updateHeaderSelect();

					// TODO: Update value to show new header selected
					alias = data.title.replace(/\s+/g, '-').toLowerCase(); // this is weak, lowercasing and spaces to dashes won't always work
					alias = alias.replace(/'/g, "");
					$('select[name="header_select"]').val(alias);
					$('#HeaderWrapper').find('.spinner').fadeOut(100);

					$('#none_header').attr("id", alias);                // needs to save custom fields
					save_custom_options(alias, prefix_header+alias, 'header'); 
				});
			}
		}

		// Toggle visibility
		$('#HeaderAddEdit').fadeOut();
		$('#HeaderSelect').fadeIn();
		$('#HeaderAddNew').fadeIn();
		$('#headerAddEditForm').slideUp();
		
		// suppress href link
		e.preventDefault()

	}).on('click touchstart', '#SaveFooter, #CancelEditFooter', function(e) { 

		function updateFootersSelect(){

			$.ajax({
				url: ajaxurl,
				async: false,
				data: {
					action:'get_footers'
				}
			}).done(function(response){
                var footers = $.parseJSON(response.replace(/\\/g, ""));           // replace all backslashes with nothing
				reloadSelect($('select[name="footer_select"]'), footers);
			});
								
			//$('input[name="footer_title"]').val('');
			// $('select[name="footer_select"]').val(layoutData.footer);
		}
		
		// Add/Edit footer action
		if($(this).attr('id') == 'SaveFooter' && $('input[name="footer_title"]').val().trim() != ''){			
			
			$('#FooterWrapper').find('.spinner').fadeIn(100);

			var data = {
				action: 'update_footer',
				title: $('input[name="footer_title"]').val(),
				footer_top_content: $('#footer-top-content').val(),
				footer_bottom_content: $('#footer-bottom-content').val(),
			};
		
			if(action == 'EditFooter'){
				data.alias = $('select[name="footer_select"]').val();

				$.post(ajaxurl, data, function(response){					
					updateFootersSelect();
					$('select[name="footer_select"]').val(data.alias);
					$('#FooterWrapper').find('.spinner').fadeOut(100);

					var footer_alias = $("select[name='footer_select']").val();
					save_custom_options(footer_alias, prefix_footer+footer_alias, 'footer');					
				});
			}
			else if(action == 'AddFooter'){
				$.post(ajaxurl, data, function(response){
					updateFootersSelect();

					// TODO: Update value to show new footer selected
					alias = data.title.replace(/\s+/g, '-').toLowerCase(); // this is weak, lowercasing and spaces to dashes won't always work
					alias = alias.replace(/'/g, "");					
					$('select[name="footer_select"]').val(alias);
					$('#FooterWrapper').find('.spinner').fadeOut(100);

					$('#none_footer').attr("id", alias);                // needs to save custom fields
					save_custom_options(alias, prefix_footer+alias, 'footer'); 
				});
			}
		}

		// reloadSelect($('select[name="footer_select"]'), '');

		// Toggle visibility
		$('#FooterAddEdit').fadeOut();
		$('#FooterSelect').fadeIn();
		$('#FooterAddNew').fadeIn();
		$('#footerAddEditForm').slideUp();
		
		// suppress href link
		e.preventDefault()

	});	

	function loadHeaderSettings(alias){

		$('#HeaderWrapper').find('.spinner').fadeIn(100);

		var headers = {};
		
		if(!alias){
			alias = $('select[name="header_select"]').val();
		}

		$.ajax({
			url: ajaxurl,
			async:false,
			data: {
				action:'get_header_settings_form',
				alias: alias
			}
		}).done(function(response){
			$('#headerAddEditForm').html(response);
			$('#HeaderWrapper').find('.spinner').fadeOut(100);
		});
	}

	$('body').on('change', 'select[name="header_select"]', function(e){		
		
		loadHeaderSettings();

	});

	function loadFooterSettings(alias){

		$('#FooterWrapper').find('.spinner').fadeIn(100);

		var footers = {};

		if(!alias){
			alias = $('select[name="footer_select"]').val();
		}

		$.ajax({
			url: ajaxurl,
			async:false,
			data: {
				action:'get_footer_settings_form',
				alias: alias
			}
		}).done(function(response){
			$('#footerAddEditForm').html(response);
			$('#FooterWrapper').find('.spinner').fadeOut(100);
		});
	}

	$('body').on('change', 'select[name="footer_select"]', function(e){
		loadFooterSettings();
	});
	/* END FOOTER AND HEADER FUNCTIONALITY */

})(jQuery);