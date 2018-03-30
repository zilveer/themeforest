var themeInsertIcon;

(function($){
	var themeInsertIconTarget;

	$(document).on('click','.theme-nav-icon-chosen',function(){
		var title = 'Insert Icon';
		themeInsertIconTarget = $(this).data('target');
		var type = $('#edit-menu-item-icon-'+themeInsertIconTarget).val();
		var color = $('#edit-menu-item-icon-color-'+themeInsertIconTarget).val();
		var url = ajaxurl + '?action=theme-shortcode-dialog&dialog=nav_menu_icon&type='+type+'&color='+escape(color);
		
		tb_show(title, url + '&TB_iframe=1');
	});
	$(document).on('click','.theme-nav-icon-remove',function(){
		var target = $(this).data('target');
		$('#edit-menu-item-icon-'+target).val('');
		$('#edit-menu-item-icon-color-'+target).val('');
		$('.theme-nav-icon-chosen[data-target="'+target+'"]').text('Insert Icon');
		$('#edit-menu-item-icon-'+target+'-preview').empty('');
		$('.theme-nav-icon-remove[data-target="'+target+'"]').hide();
	});
	themeInsertIcon = function(type, color){
		$('#edit-menu-item-icon-'+themeInsertIconTarget+'-preview').html('<i class="icon-'+type+'" style="color:'+color+'"></i>');
		$('#edit-menu-item-icon-'+themeInsertIconTarget).val(type);
		$('.theme-nav-icon-chosen[data-target="'+themeInsertIconTarget+'"]').text('Change Icon');
		$('#edit-menu-item-icon-color-'+themeInsertIconTarget).val(color);
		$('.theme-nav-icon-remove[data-target="'+themeInsertIconTarget+'"]').show();
	}

	$(document).ready(function(){
		$( '.menu-item-visibility-enable' ).change( function() {
			$( this ).closest( '.visibility-enable' ).next().toggle( $( this ).prop( 'checked' ) );
		});

		$( '.menu-item-visibility-enable' ).each(function(){
			$( this ).closest( '.visibility-enable' ).next().toggle( $( this ).prop( 'checked' ) );
		});
	});
})(jQuery);