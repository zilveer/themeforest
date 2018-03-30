(function() {
    tinymce.create('tinymce.plugins.portfolio', {
        init : function(ed, url) {
            ed.addButton('portfolio', {
                title : 'Add a portfolio',
                image : url+'/images/portfolio.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Portfolio Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=portfolio-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('portfolio', tinymce.plugins.portfolio);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		var form = jQuery('<div id="portfolio-form">\
		<div class="mom_tiny_form portfolio_table">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="portfolio-columns">Columns</label>\
			    <span>one, two, three & four</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="portfolio-columns">\
					<option value="one">One Column</option>\
					<option value="two">Two Columns</option>\
					<option value="three" selected="selected">Three Columns</option>\
					<option value="four">Four Columns</option>\
				    </select>\
		</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="portfolio-count">Items Per Page</label>\
			    <span>By default its: 12</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <input id="portfolio-count" value="" type="text">\
		</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="portfolio-nav">Navigation</label>\
			    <span>filter, pagination, both or none</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="portfolio-nav">\
					<option value="filter">Filter</option>\
					<option value="pagination">Pagination</option>\
					<option value="both">Both ( filer and pagination )</option>\
					<option value="none">None</option>\
				    </select>\
		</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="portfolio-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');

		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();

		
		// handles the click event of the submit button
		form.find('#portfolio-submit').click(function(){
		    	var options = {
				'columns':'',
				'nav': '',
				'count':'',
		};

                    output = ' [portfolio';
		    			for( var index in options) {
				var value = table.find('#portfolio-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					output += ' ' + index + '="' + value + '"';
			}
			output += ']'

		    //output += ' [/portfolios] ';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
