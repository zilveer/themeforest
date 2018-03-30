jQuery(document).ready(function($){ 
    
    // Initial load Page Switcher
    var hash = window.location.hash;
    if(hash != ''){
		$('#page-' + hash.replace(/#/, '')).show();
        $('#zilla-framework .nav li a[href="'+ hash +'"]').addClass('active');
	} else {
        $('#zilla-framework .page:first').show();
        $('#zilla-framework .nav li a:first').addClass('active');
    }
    
    // Page Switcher
    $('#zilla-framework .nav li a').bind('click', function(){
        $('#zilla-framework .page').hide();
        var loc = $(this).attr('href');
        $('#page-' + loc.replace(/#/, '')).show();
        $('#zilla-framework .nav li a').removeClass('active');
        $(this).addClass('active');
    });
    
    // AJAX Save
    $('#zilla-framework form').submit(function(){
        var form = $(this);
        form.trigger('zilla-before-save');
        var button = $('#zilla-framework #save-button');
        var buttonVal = button.val();
        button.val('Saving...');
		$.post(form.attr("action"), form.serialize(), function(data){
            button.val(buttonVal);
			//$('#zilla-framework-messages').html(data.message);
			if(data.error){
				$.jGrowl(data.message, { header:'Error' });
			} else {
				$.jGrowl(data.message);
			}
            form.trigger('zilla-saved');
		}, 'json');
		return false;
    });
    
    // Reset Button
    $('#zilla-framework #reset-button').live('click', function(){
    	if(confirm('Click to reset. Any settings will be lost!')){
    		$(this).val('Reseting...');
	    	$.post(ajaxurl, { action:'zilla_framework_reset', nonce:$('#zilla_noncename').val() }, function(data){
				if(data.error){
					$.jGrowl(data.message, { header:'Error' });
				} else {
					window.location.reload(true);
				}
			}, 'json');
		}
		return false;
    });
    
    // Custom Layout Switcher
    $('#zilla-framework .main-layout br').remove();
    $('#zilla-framework .main-layout input[type="radio"]').each(function(){
    	var label = $(this).parent();
    	label.addClass($(this).val());
    	if($(this).is(':checked')) label.addClass('checked');
    });
    $('#zilla-framework .main-layout label').live('click', function(){
    	$('#zilla-framework .main-layout label').removeClass('checked');
    	$('#zilla-framework .main-layout input[type="radio"]').attr('checked', false);
    	var id = $(this).attr('for');
    	$(this).addClass('checked');
    	$('#zilla-framework .main-layout #'+ id).attr('checked', true);
    });
    
    // Color picker
    $('.colorpicker').each(function(){
    	var colorPicker = $(this);
    	colorPicker.farbtastic('#' + colorPicker.attr('id') + '_cp');
    	colorPicker.hide();
    	$('#' + colorPicker.attr('id') + '_cp').live('focus', function(){
    		colorPicker.show();
    	});
    	$('#' + colorPicker.attr('id') + '_cp').live('blur', function(){
    		colorPicker.hide();
    	});
    });
    
});