var eb_vars, datatype, ajaxurl;

jQuery( document ).ready( function() {

	jQuery( '#page_template' ).change( function() {
		var template = jQuery( this ).val();
		action_show_controls( template );
	});


	jQuery( '.eb-datepicker-monthday' ).datepicker({
		dateFormat: "MM dd",
	})

	if( jQuery('.control-product_page_content').length > 0 ) {
		jQuery('.control-product_page_content').product_control();
	}

	if( window.location.hash !== '' ) {
		var location = explode( '%7C', window.location.hash.substr( 1 ) );
		var group = '';
		if( location.length === 1 ) {
			group = jQuery( '.eb-tabbed-settings .group-nav li[data-group_id="' + location[0] + '"]' );
			switch_group( group );
		}
		else if( location.length === 2 ) {
			group = jQuery( '.eb-tabbed-settings .group-nav li[data-group_id="' + location[0] + '"]' );
			var tab = jQuery( '.eb-tabbed-settings .group[data-group_id="' + location[0] + '"] .tab[data-section_id="' + location[1] + '"]' );
			switch_group( group );
			switch_section( tab );
		}
	}

	jQuery('.eb-admin :checkbox').iphoneStyle({
		checkedLabel: 'YES',
		uncheckedLabel: 'NO'
	});



	jQuery( '.eb-tabbed-settings .tabs .tab' ).live( 'click', function() {
		switch_section( jQuery( this ) );
	});

	jQuery( '.eb-tabbed-settings .group-nav li' ).live( 'click', function() {
		switch_group( jQuery( this ) );
	});

	jQuery( '.tagsinput' ).tagsInput({
		defaultText: ''
	});

	jQuery( '.chosen' ).chosen();

	jQuery.configureBoxes({
		useSorting: false,
		useCounters: false
	});

    var farbtastic = jQuery.farbtastic('#colorpicker');
    var picker = jQuery('#colorpicker');
    picker.prependTo( 'body' );
    jQuery('.color')
		.each( function() {
			farbtastic.linkTo( this );
			jQuery( this ).css( 'opacity', 0.75 );
		})
		.focus( function() {
			farbtastic.linkTo( this );
			var offset = jQuery( this ).offset();
			var windowHeight = jQuery(window).height();

			offset.top = offset.top + jQuery( this ).outerHeight();

			if( offset.top + 280 > windowHeight ) {
				offset.top = offset.top - 245 - jQuery( this ).outerHeight();
			}

			picker.stop().addClass( 'startup' ).offset( offset ).animate( { opacity: 1 } );
		})
		.blur( function() {
			picker.animate( { opacity: 0 }, function() {
				picker.removeClass( 'startup' );
			});
		});


	create_uploaders();

	jQuery(document).ajaxSuccess(function() {
		create_uploaders();
		jQuery( '.chosen' ).chosenDestroy();
		jQuery( '.chosen' ).chosen();
		jQuery.configureBoxes();

		removeIPhoneStyle('.eb-admin :checkbox');

		jQuery('.eb-admin :checkbox').iphoneStyle({
			checkedLabel: 'YES',
			uncheckedLabel: 'NO'
		});

		jQuery('.color')
			.each( function() {
				farbtastic.linkTo( this );
				jQuery( this ).css( 'opacity', 0.75 );
			})
			.focus( function() {
				farbtastic.linkTo( this );
				var offset = jQuery( this ).offset();
				offset.top = offset.top + jQuery( this ).outerHeight();
				picker.stop().addClass( 'startup' ).offset( offset ).animate( { opacity: 1 } );
			})
			.blur( function() {
				picker.animate( { opacity: 0 }, function() {
				picker.removeClass( 'startup' );
			});
		});
	});

	jQuery( '.add_subgroup' ).click( function() {
		var container = jQuery( this ).parents( '.control:first' );
		var element = container.find( '.control-subgroup:first' ).clone();
		element.find( 'input' ).val( '' );
		container.find( '.control-subgroups' ).append( element );

		element.find('.eb-datepicker, .eb-datepicker-monthday').removeAttr('id').removeClass('hasDatepicker')
		jQuery( '.eb-datepicker' ).datepicker();
		jQuery( '.eb-datepicker-monthday' ).datepicker({
			dateFormat: "MM dd",
		})
		jQuery( '.eb-datepicker' ).datepicker( 'refresh' );
		jQuery( '.eb-datepicker-monthday' ).datepicker( 'refresh' );
	});



	jQuery( '.remove_subgroup' ).live( 'click', function() {
		var container = jQuery( this ).parents( '.control:first' );
		var items = container.find( '.control-subgroup' ).length;
		var group = jQuery( this ).parents( '.control-subgroup:first' );

		if( items > 1 ) {
			group.slideUp( function() {
				group.remove();
			});
		}
		else {
			newgroup = group.clone();
			newgroup.find('*').val('');
			newgroup.insertAfter(group);
			group.remove();
		}
	});





	jQuery('.remove-image').live( 'click', function() {
		if( jQuery( this ).attr( 'data-datatype' ) == 'option' ) {
			var option = jQuery(this).attr('data-option');
			jQuery.ajax({
				url: eb_vars.ajaxurl,
				type: 'post',
				data: {
					action: 'action_remove_image',
					option: option
				}
			});
		}

		jQuery( this ).parents( '.upload-container ' ).find( 'input[type="file"]' ).next().val('');

		jQuery(this).parents( '.image' ).hide().find('img').attr( 'src', '' );
		return false;
	});


    jQuery( '.eb-datepicker' ).datepicker();


	jQuery( '.image-selector .image' ).click( function() {
		if( jQuery( this ).hasClass( '.selected' ) ) {
			jQuery( this ).find( '.select-text' ).text('Click to select');
		}
		else {
			jQuery( this ).find( '.select-text' ).text('Click to deselect');
		}
		jQuery( this ).toggleClass( 'selected' );

		var selected = jQuery( '.image-selector .image.selected' );
		var images = [];

		jQuery.each( jQuery(selected), function( index ) {
			images[index] = jQuery( this ).attr( 'data-id' );
		});
		jQuery(this).parents( '.image-selector' ).find( 'input' ).val( images.join( ',' ) );
	});

});

function removeIPhoneStyle( target ) {
	jQuery.each( jQuery( target ), function() {
		var container = jQuery(this).parents( '.iPhoneCheckContainer' );
		container.before( jQuery(this).clone() );
		container.remove();
	});
}


function create_uploaders() {
    jQuery('.upload').fileupload({
		dataType: 'json',
		url: eb_vars.ajaxurl,
		submit: function( e, data) {
			datatype = e.currentTarget.dataset.datatype;
			data.formData = {
				action: 'action_upload',
				name: data.paramName,
				field: data.fileInput.attr('data-hidden_field'),
				datatype: datatype
			};
		},
		send: function( e, data ) {
			jQuery( 'input[name="' + data.fileInput.attr('data-hidden_field') + '"]' ).parents( '.upload-container:first' ).find( '.loader' ).removeClass('hidden');
		},
		done: function (e, data) {
			jQuery( 'input[name="' + data.result.field + '"]' ).parents( '.upload-container:first' ).find( '.loader' ).addClass('hidden');

			var field = jQuery( 'input[name="' +data.result.field + '"]' );

			var image_container = field.parents( '.upload-container' ).find('.image');

			field.val( data.result.attachment_id );
			image_container.show().find('img').attr( 'src', data.result.thumb );
		}
	});
}

jQuery.fn.chosenDestroy = function () {
	jQuery(this).show().removeClass('chzn-done').removeAttr('id');
	jQuery(this).next().remove();
	jQuery('.chzn-container').remove();
	return jQuery(this);
};

function action_show_controls( template ) {
	var args = jQuery( '.eb-tabbed-settings .groups' ).attr( 'data-settings' );
	var post_id = jQuery( '#post_ID' ).val();
	jQuery.ajax({
		url: ajaxurl,
		type: 'post',
		data: {
			action: 'action_show_controls',
			args: args,
			post_id: post_id,
			template: template
		},
		beforeSend: function() {
			show_settings_loader();
		},
		success: function( response ) {
			remove_settings_loader();
			html = jQuery(response)
			jQuery( '#eb-custom-fields .eb-admin' ).replaceWith( html );

		}
	});
}

function show_settings_loader() {
	jQuery( '.eb-options-form' ).prepend( '<div class="loader-large"></div>' );
}

function remove_settings_loader() {
	jQuery( '.eb-options-form .loader-large' ).remove();
}


function switch_section( tab ) {
	var group = tab.parents( '.group' );
	var section_id = tab.attr( 'data-section_id' );
	var group_id = group.attr( 'data-group_id' );

	group.find( '.tab, .section' ).removeClass( 'current' );
	group.find( '.tab[data-section_id=' + section_id + '], .section[data-section_id=' + section_id + ']' ).addClass( 'current' );

	switch_hash( group_id + '%7C' + section_id );
	proper_height();

}



function switch_group( nav ) {
	var group_id = nav.attr( 'data-group_id' );
	var settings = nav.parents( '.eb-tabbed-settings' );

	settings.find( '.group, .group-nav li' ).removeClass( 'current' );
	settings.find( '.group-nav li[data-group_id=' + group_id + '], .group[data-group_id=' + group_id + ']' ).addClass( 'current' );

	switch_hash( group_id );
	proper_height();

}


function switch_hash( hash ) {
	window.location.hash = hash;
	jQuery( '.eb-options-form' ).find( 'input[name="location"]' ).val( hash );
}


function proper_height() {
	var element = jQuery('.eb-tabbed-settings .group.current');
	var sections = element.find( '.sections' );
	var nav = jQuery( '.group-nav' );

	element_height = sections.height();
	nav_height = nav.height();

	if( nav_height >= element_height ) {
		element.height( nav_height )
	}
	else {
		element.css( 'height', 'auto')
	}
}


function explode (delimiter, string, limit) {

	if ( arguments.length < 2 || typeof delimiter == 'undefined' || typeof string == 'undefined' ) return null;
	if ( delimiter === '' || delimiter === false || delimiter === null) return false;
	if ( typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object'){
	return { 0: '' };
	}
	if ( delimiter === true ) delimiter = '1';

	// Here we go...
	delimiter += '';
	string += '';

	var s = string.split( delimiter );


	if ( typeof limit === 'undefined' ) return s;

	// Support for limit
	if ( limit === 0 ) limit = 1;

	// Positive limit
	if ( limit > 0 ){
	if ( limit >= s.length ) return s;
	return s.slice( 0, limit - 1 ).concat( [ s.slice( limit - 1 ).join( delimiter ) ] );
	}

	// Negative limit
	if ( -limit >= s.length ) return [];

	s.splice( s.length + limit );
	return s;

}