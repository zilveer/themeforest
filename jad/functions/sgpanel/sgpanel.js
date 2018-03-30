jQuery(document).ready(function($){
	
	$('#sgp-options-container #submit').click(function(e){
		$('input[name=action]').val('save');
	});
	$('#sgp-options-container #reset').click(function(e){
		$('input[name=action]').val('reset');
	});
	
	$('#sgp-options-sidebar ul li:first-child').addClass('active');
	$('#sgp-options-content .sgp-options-section:first-child').siblings('.sgp-options-section').hide();

	$('#sgp-options-sidebar ul li a').click(function(e){
		e.preventDefault();
		var section_id = $(this).attr('href');
		$(section_id).show().siblings('.sgp-options-section').hide();
		$(this).parents('li').addClass('active').siblings('.active').removeClass('active');
	});
	
	//SGP Sidebars
	$('.sgp-sb-add').click(function(e){
		var i = $('input[name=sgp_sidebars]').val();
		var o = $('input[name=sgp_sidebars_options]').val();
		$('<tr><td><input type="text" value="" name="sgp_sidebars_name[' + i + ']"></td><td><select name="sgp_sidebars_pos[' + i + ']">' + o + '</select></td><td><input type="text" value="" name="sgp_sidebars_desc[' + i + ']"></td><td><a class="button sgp-sb-rm" href="#">-</a></td></tr>').insertBefore($('.sgp-sb-add').parent().parent());
		$('input[name=sgp_sidebars]').val(++i);
		$('.sgp-sb-rm').click(function(e){$(this).parent().parent().remove();return false;});
		return false;
	});
	
	$('.sgp-sb-rm').click(function(e){
		$(this).parent().parent().remove();
		return false;
	});
	
});