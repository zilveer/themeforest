(function() {
    tinymce.create('tinymce.plugins.graph', {
        init : function(ed, url) {
            ed.addButton('graph', {
                title : 'Add a graph',
                image : url+'/images/graph.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Graph', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=graph-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('graph', tinymce.plugins.graph);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="graph-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="graph-height">Height</label>\
			    <span>insert bar height default is 25</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="graph-height" value="">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="graph-strips">Enable Strips</label>\
			    <span>make it striped</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="ch_switch"><input type="checkbox" id="graph-strips" value=""><label><i></i></label></div>\
			    </div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		<div class="mom_graph_wrap">\
		    <div class="mom_graph">\
			<div class="graph_sort_handle"></div>\
			<input type="text" id="graph-title" placeholder="title">\
			<div class="graph_score"><label for="graph-score">Score:</label><input type="text" id="graph-score" placeholder="0%"></div>\
			<div class="mom_progress_bar"><div class="mom_progress_inner" style="width:80%;"><div class="graph_prev"><span class="title_prev">Title</span> <span class="score_prev">0</span>%</div></div></div>\
			<div class="graph_color"><input type="text" id="graph-color" class="graph_icolor" /><input type="text" id="graph-text_color" class="graph_text_color" /></div>\
			<a href="#" class="remove_item remove_graph"></a>\
		    </div>\
		</div>\
		<a href="#" id="add_graph" class="mom_tiny_button">Add New</a>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="graph-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');

		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();


		var graph = {
		    change: function(event, ui){
			$(this).parent().parent().parent().parent().find('.mom_progress_inner').css('background', ui.color.toString());
		    }, };
		var text = {
		    change: function(event, ui){
			$(this).parent().parent().parent().parent().find('.mom_progress_inner .graph_prev').css('color', ui.color.toString());
		    }, };
		jQuery('.mom_graph:first .graph_icolor').wpColorPicker(graph);
		jQuery('.mom_graph:first .graph_text_color').wpColorPicker(text);

		jQuery('#add_graph').live('click', function(){
                    jQuery('.mom_graph:first').clone().addClass('new_graph').appendTo('.mom_graph_wrap');
		    jQuery('.new_graph:last').find('input').val('');
		    jQuery('.new_graph:last').find('.graph_color').remove();
		    $('<div class="graph_color"><input type="text" id="graph-color" class="graph_icolor" /><input type="text" id="graph-text_color" class="graph_text_color" /></div>').appendTo('.new_graph:last');
		    jQuery('.new_graph:last .graph_icolor').wpColorPicker({
		    change: function(event, ui){
			$(this).parent().parent().parent().parent().find('.mom_progress_inner').css('background', ui.color.toString());
		    }, });

		    jQuery('.new_graph:last .graph_text_color').wpColorPicker({
		    change: function(event, ui){
			$(this).parent().parent().parent().parent().find('.mom_progress_inner .graph_prev').css('color', ui.color.toString());
		    }, });

                    return false;
                });

                jQuery('.remove_graph').live('click', function(e) {
                    if(jQuery('.mom_graph').size() == 1) {
                        alert('Sorry, you need at least one element');
                    }
                    else {
			e.preventDefault();
                        jQuery(this).parent().slideUp(300, function() {
                            jQuery(this).remove();
                        })
                    }
                    return false;
                });
		    $('#graph-score').live('keyup',function() {
		        $(this).parent().parent().find('.mom_progress_inner').css('width',$(this).val()+'%');
			$(this).parent().parent().find('.mom_progress_inner .score_prev').text($(this).val());
		    });
		    $('#graph-title').live('keyup',function() {
			$(this).parent().find('.mom_progress_inner .title_prev').text($(this).val());
		    });

		    $( ".mom_graph_wrap" ).sortable({
			handle : '.graph_sort_handle'
		    });
	    

		// handles the click event of the submit button
		form.find('#graph-submit').click(function(){
				var options = { 
				'height':'',
		};
			if($('#graph-strips').is(':checked')) {
			    strips = ' strips="true"';

			} else {
			    strips = '';   
			}

			var output = '[graphs';
			
			for( var index in options) {
				var value = table.find('#graph-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					output += ' ' + index + '="' + value + '"';
			}
			
			output += strips+']<br>'

                jQuery('.mom_graph').each(function(index) {
                    var title = jQuery(this).find('#graph-title').val();
                    var score = jQuery(this).find('#graph-score').val();
                    var color = jQuery(this).find('#graph-color').val();
                    var txtcolor = jQuery(this).find('#graph-text_color').val();
		    if (color !== '') {
			icolor = ' color="'+color+'"'
		    } else {
			icolor = '';
		    }
		    if (txtcolor !== '') {
			tcolor = ' text_color="'+txtcolor+'"'
		    } else {
			tcolor = '';
		    }
                    output += '[graph title="'+title+'" score="'+score+'"'+icolor+tcolor+']<br>';
                });
                output += ' [/graphs] ';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
