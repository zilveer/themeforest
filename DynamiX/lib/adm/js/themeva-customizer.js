/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

	( function( $ )
	{
		/* ------------------------------------
		:: ADD SKIN FUNCTIONALITY
		------------------------------------ */
		
		$(document).ready(function()
		{
			// Set Skin Tab Open
			$( '#accordion-section-themeva_skin' ).addClass('open');
			
			// Add Form to Form Select Menu
			$('#customize-control-skin_select select').parent('label').wrapAll('<form id="skin_control" method="post"></form>');
			
	
			// Add New Button
			$( '#skin_control' ).append('<p><a href="#" id="new-skin" class="button button-primary button-action">New</a> <a href="#" id="duplicate-skin" class="button button-primary button-action">Duplicate</a> <a href="#" id="delete-skin" class="button button-secondary button-action">Delete</a></p>');
			
			// Add New Skin Title Field
			$( '.button-action' ).click(function()
			{
				var id   = $( this ).attr('id'),
					len  = $( '.'+ id +'-wrapper' ).length,
					text = id.charAt(0).toUpperCase() + id.slice(1).replace('-skin',' ');
				
				$( '.button-action' ).each(function(index, element) {
					
					var alt_id = $( this ).attr('id'); 
					
					if( alt_id != id )
					{
						$( '#'+ alt_id ).fadeOut();	
					}
				});
				
				if( len == 0 )
				{
					if( id == 'delete-skin' )
					{
						$( '#skin_control' ).append( '<div class="'+ id +'-wrapper clear"><span>Confirm deletion of the <strong>"'+ $( '#skin_select' ).val() +'"</strong> skin.</span><p><a href="#" id="'+ id +'-save" class="button button-primary save-skin">Delete</a><input id="'+ id +'-title" name="'+ id +'-title" type="hidden" class="skin-title" value="delete" /></p></div>'	);
					}
					else
					{
						$( '#skin_control' ).append( '<div class="'+ id +'-wrapper clear"><label><span class="customize-control-title">New Skin ID</span><input id="'+ id +'-title" name="'+ id +'-title" type="text" class="skin-title" /></label><p><a href="#" id="'+ id +'-save" class="button button-primary save-skin">Save</a></p></div>'	);
					}
					
					$( this ).removeClass('button-primary').addClass('button-secondary cancel').text('Cancel');
				}
				else
				{
					if( $(this).hasClass('cancel') )
					{
						$( '.'+ id +'-wrapper' ).fadeOut();
						$( '#'+ id +'-title' ).val('');
						
						if( id == 'delete-skin' )
						{
							$( this ).removeClass( 'button-secondary cancel' ).addClass( 'button-secondary' ).text( text );
						}
						else
						{
							$( this ).removeClass( 'button-secondary cancel' ).addClass( 'button-primary' ).text( text );
						}
						
						$( '.button-action' ).fadeIn();
					}
					else
					{
						$( '.'+ id +'-wrapper' ).fadeIn();
				
						$( this ).addClass( 'button-secondary cancel' ).removeClass( 'button-primary' ).text('Cancel');
						
						$( '#delete-skin-title' ).val('delete');
						
					}
				}
			});		
		
		
			$('#customize-control-skin_select select').attr('name','skin_select').attr('id','skin_select').change(function()
			{
				$( '#skin_control' ).submit();
			});
		
			$( '.save-skin' ).live('click', function ()
			{
				var id  = $( this ).attr('id').replace('-save',''),
					val = $( '#'+ id +'-title' ).val();
		
				if( val !='' )
				{				
					$( '#skin_control' ).submit();
				}
	
			});		
	
			
			// Validate Field
			$( '.skin-title' ).live('keypress', function (event)
			{
				var regex = new RegExp("^[a-zA-Z0-9]+$"),
					key = String.fromCharCode(!event.charCode ? event.which : event.charCode),
					inputStr = $( this ).val();
				
				if ( !regex.test(key) )
				{
				   event.preventDefault();
				   return false;
				}
			});
	
			/* ------------------------------------
			:: BACKGROUND LAYER SELECTOR 
			------------------------------------ */
	
			function show_options(type, id, value, layer)
			{
				if( type == 'layer-options' || type == 'section-background' )
				{
					if( value != '' )
					{
						value = value + '_opt';	
					}
				}
				
				if( layer != '' )
				{
					layer = '.' + layer;
				}
				else
				{
					layer = '';	
				}
							
				$( '#'+ id +' .'+ type + layer ).each(function() {
					
					$( this ).css({
						'visibility':'hidden',
						'height':'0'
					});
					
					if( $( this ).attr('id').match(value) && value !='' )
					{
						$(this).css({
							'visibility':'visible',
							'height':'auto'
						});
					}
	
					// Check datasource needs to be displayed if set to gallery layer type
					if( type == 'data-options' )
					{		
						if( $(layer + '.layer-options-type select').val() != layer.replace(".", "") +'_cycle' )
						{
							$( '.data-options'+ layer ).css({
								'visibility':'hidden',
								'height':'0'
								});
						}
					}
	
					if( type == 'layer-options' )
					{
						if( $(layer + '.layer-options-type select').val() == layer.replace(".", "") +'_cycle' )
						{
							$( '#customize-control-'+ $( layer + '.data-source-type select' ).val() ).css({
								'visibility':'visible',
								'height':'auto'
							});
						}
					}				
					
				});
			}
			
			$( '#customize-control-layer1_type,#customize-control-layer2_type,#customize-control-layer3_type,#customize-control-layer4_type,#customize-control-layer5_type,#customize-control-layer1_heading,#customize-control-layer2_heading,#customize-control-layer3_heading,#customize-control-layer4_heading,#customize-control-layer5_heading' ).addClass('layer-options-type');
			
			$( '#accordion-section-themeva_background_1 li,#accordion-section-themeva_background_2 li,#accordion-section-themeva_background_3 li,#accordion-section-themeva_background_4 li,#accordion-section-themeva_background_5 li' ).not('.layer-options-type, #accordion-section-themeva_background_1 li li,#accordion-section-themeva_background_2 li li,#accordion-section-themeva_background_3 li li,#accordion-section-themeva_background_4 li li,#accordion-section-themeva_background_5 li li,li.customize-section-description-container').addClass('layer-options');
			
			
			$( '#customize-control-layer1_cycle_opt_datasource,#customize-control-layer2_cycle_opt_datasource,#customize-control-layer3_cycle_opt_datasource,#customize-control-layer4_cycle_opt_datasource,#customize-control-layer5_cycle_opt_datasource' ).addClass('data-source-type');
			
			
			// Background Types	
			$( '#accordion-section-themeva_frame li,#accordion-section-themeva_header li,#accordion-section-themeva_footer li,#accordion-section-themeva_sidebar li' ).not('.accordion-section li.customize-section-description-container').each(function()
			{
				var el_id = $(this).attr('id');
	
				if( el_id.match(/_opt/) ) // main background areas
				{
					$(this).addClass('section-background');
				}		
			});
				
			$( '#customize-control-layer_main_type,#customize-control-layer_header_type,#customize-control-layer_footer_type,#customize-control-layer_sidebar_type' ).addClass('section-background-type');
			$( '#customize-control-shaded_main_type,#customize-control-shaded_header_type,#customize-control-shaded_footer_type' ).addClass('section-shaded-type');
			
			// Add Class to Data Source Options
			$(".data-source-type option").each(function()
			{
				var value = $( this ).val();
			
				$( '.layer-options' ).each(function(layer)
				{
					if( $( this ).attr('id').match(value) && value !='' )
					{
						$( this ).addClass('data-options');
					}
				});
			});
	
			// Add Class to Section Background Options 
			$(".section-background").each(function()
			{
				var el_id = $(this).attr('id');
					
				if( el_id.match(/\blayer_([a-z]+)/) ) // main background areas
				{
					num = el_id.match(/\blayer_([a-z]+)/);
				}
				else if( el_id.match(/\bshaded_([a-z]+)/) ) // shaded background areas
				{
					num = el_id.match(/\bshaded_([a-z]+)/);
				}
				
				if( num ) $(this).addClass(num[0]);
			});		
			
			// Add Layer Number to elements
			$( '.layer-options,.layer-options-type' ).each(function()
			{	
				var el_id = $(this).attr('id'),
					num = el_id.match(/\blayer(\d+)/);
					if( num ) $(this).addClass(num[0]);		
			});
	
	
			$('.layer-options-type select,.data-source-type select,.section-background-type select,.section-shaded-type select').change(function()
			{
				var value = $( this ).val(),
					id = $( this ).parents('li.control-section').attr('id'),
					elem_id = $( this ).parents('li.layer-options-type').attr('id'),
					back_id = $( this ).parents('li.section-background-type').attr('id'),
					shaded_id = $( this ).parents('li.section-shaded-type').attr('id');
					
	
				if( $( this ).parents('li').hasClass('data-source-type') )
				{
					var type = 'data-options';
				}
				else if( $( this ).parents('li').hasClass('section-background-type') )
				{
					var type = 'section-background',
						num = back_id.match(/\blayer_([a-z]+)/);
				
					if( num ) layer = num[0];
					
				}		
				else if( $( this ).parents('li').hasClass('section-shaded-type') )
				{
					var type = 'section-background',
						num = shaded_id.match(/\bshaded_([a-z]+)/);
				
					if( num ) layer = num[0];
				}			
				else
				{
					var type = 'layer-options',
						num = elem_id.match(/\blayer(\d+)/);
						
						if( num ) layer = num[0];
				}
				
				// Show / Hide Relevant Fields
				show_options( type, id, value, layer );			
			});		
				
	
			/* ------------------------------------
			:: RANGE SLIDER
			------------------------------------ */
			
			$( '.range-slider' ).each(function()
			{
				var id 	   = $(this).attr('id'),
					name   = id.replace('_slider', ''),
					ovalue = jQuery('#' + name).val(),
					std	   = parseInt($( '#'+ id ).attr('data-default')),
					min	   = parseInt($( '#'+ id ).attr('data-min')),
					max    = parseInt($( '#'+ id ).attr('data-max'));
					
					if( ovalue == '.' ) ovalue = '0';
					
					if( ovalue == '' && !isNaN(std) )
					{
						ovalue = std;
						$('#' + name).val( ovalue ).trigger('change');
					}
					
				$( '#' + id ).slider({
					range: "max",
					min: min,
					max: max,
					step: 1,
					value: ovalue,
					slide: function( event, ui )
					{
						$('#' + name).val( ui.value ).trigger('change');						
					}
				});
	
	
				$('#' + name).change(function ()
				{
					var value = $('#' + name).val();
					$('#' + name + '_slider').slider("value", parseInt(value));
				});	
			
			});
	
			/* ------------------------------------
			:: MEDIA UPLOADER
			------------------------------------ */
			
			$(document).ready(function()
			{
	
				// Trigger change on options
				$('.layer-options-type select,.data-source-type select,.section-background-type select,.section-shaded-type select').trigger("change");
				
				$( '.media-upload' ).click(function()
				{
					var button_id = '#' + $( this ).attr('id'),
						field_id = button_id.replace( "_button","" );
			
					set_uploader( button_id, field_id );
				
				});
			 
				function set_uploader( button, field )
				{
					// make sure both button and field are in the DOM
					if( $(button) && $(field) )
					{
						// when button is clicked show thick box
						$(button).live('click', function ()
						{
							tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				 
							// when the thick box is opened set send to editor button
							set_send(field);
							return false;
						});
					}
				}
			 
				function set_send(field)
				{
					// store send_to_event so at end of function normal editor works
					window.original_send_to_editor = window.send_to_editor;
				 
					// override function so you can have multiple uploaders pre page
					window.send_to_editor = function(html) {
						imgurl = $('img',html).attr('src');
						imgurl = imgurl.replace(/^.*\/\/[^\/]+/, '');
						
						$(field).val(imgurl).change();
						tb_remove();
						// Set normal uploader for editor
						window.send_to_editor = window.original_send_to_editor;
					};
				}
			
			});
		
		});
		
	} )( jQuery );
	