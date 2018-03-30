// closure to avoid namespace collision
(function(){
	
	tinymce.PluginManager.add('mygallery_button', function( editor, url ) {
        editor.addButton( 'mygallery_button', {
           title : 'Shortcodes Index', // title of the button
			image : '../wp-content/themes/circolare/images/shortcodes.png',  // path to the button's image
            onclick: function() {
                // triggers the thickbox
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 84;
				tb_show( 'Shortcodes Index', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=mygallery-form' );
            }
        });
    });
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="mygallery-form"><table id="mygallery-table" style="margin-top: 20px;" class="form-table">\
			<tr class="myshortcode">\
				<td><label for="myshortcode">Select the shortcode :</label>\
					<select style="width: 250px;" name="shortcode" id="myshortcode">\
						<option selected>--------------------</option>\
						<option value="clear">clear</option>\
						<option value="raw">raw</option>\
						<option value="tabgroup">tabgroup</option>\
						<option value="tab">tab</option>\
						<option value="accordion_group">accordion group</option>\
						<option value="accordion">accordion pane</option>\
						<option value="alignleft">align left</option>\
						<option value="alignright">align right</option>\
						<option>--------------------</option>\
						<option value="mybutton">button</option>\
						<option value="divider">divider</option>\
						<option value="highlight">highlight text</option>\
						<option value="icon">icon</option>\
						<option value="client">clients</option>\
						<option value="quote">fancy quote</option>\
						<option value="fancyborder">fancy border</option>\
						<option value="faq">faq</option>\
						<option value="faqitem">faq item</option>\
						<option value="contactform">contact form</option>\
						<option>--------------------</option>\
						<option value="success">success message</option>\
						<option value="error">error message</option>\
						<option value="info">info message</option>\
						<option value="warning">warning message</option>\
						<option>--------------------</option>\
						<option value="col2">column 2</option>\
						<option value="col2_last">column 2 last</option>\
						<option value="col3">column 3</option>\
						<option value="col3_last">column 3 last</option>\
						<option value="col4">column 4</option>\
						<option value="col4_last">column 4 last</option>\
						<option value="col23">column 2/3</option>\
						<option value="col23_last">column 2/3 last</option>\
						<option value="col34">column 3/4</option>\
						<option value="col34_last">column 3/4 last</option>\
					</select>\
				</td>\
			</tr>\
			<tr class="mybutton" style="display: none;">\
				<th><label for="mybutton_linkto">Link Url</label></th>\
				<td><input type="text" value="" id="mybutton_linkto" /><br />\
				<small>The URL the button points to.</small></td>\
			</tr>\
			<tr class="mybutton" style="display: none;">\
				<th><label for="mybutton_content">Button Text</label></th>\
				<td><input type="text" value="" id="mybutton_content" /><br />\
				<small>The text that appears on the button.</small></td>\
			</tr>\
			<tr class="mybutton" style="display: none;">\
				<th><label for="mybutton_type">Button Color</label></th>\
				<td>\
					<select id="mybutton_type">\
						<option selected value="dark">dark</option>\
						<option value="light">light</option>\
						<option value="colored">color scheme</option>\
					</select>\
				<br />\
				<small>Select the button color.</small></td>\
			</tr>\
			<tr class="highlight" style="display: none;">\
				<th><label for="highlight_type">Select Highlight Type :</label></th>\
				<td>\
					<select id="highlight_type">\
						<option selected value="primary">primary</option>\
						<option value="secondary">secondary</option>\
					</select>\
				<br />\
				<small>Select the highlight type.</small></td>\
			</tr>\
			<tr class="faqitem" style="display: none;">\
				<th><label for="question_faqitem">Question</label></th>\
				<td><input type="text" value="" id="question_faqitem" /><br /></td>\
			</tr>\
			<tr class="faqitem" style="display: none;">\
				<th><label for="answer_faqitem">Answer</label></th>\
				<td><textarea type="text" name="text" id="answer_faqitem"></textarea><br /></td>\
			</tr>\
			<tr class="quote" style="display: none;">\
				<th><label for="quote_type">Select quote style</label></th>\
				<td>\
					<select id="quote_type">\
						<option selected value="default">default</option>\
						<option value="idea">idea</option>\
						<option value="award">award</option>\
					</select>\
				<br />\
				<small>Select the style of the quote.</small></td>\
			</tr>\
			<tr class="quote" style="display: none;">\
				<th><label for="quote_avatar">Avatar</label></th>\
				<td><input type="text" name="text" id="quote_avatar" /><br />\
				<small>Add the url of any image. It could be a photo of one of your staff members. This photo is shown only when you select \'default\' as the quote type above. The image should be preferably be 80px wide and high.</small></td>\
			</tr>\
			<tr class="divider" style="display: none;">\
				<th><label for="divider_type">Select divider type</label></th>\
				<td>\
					<select id="divider_type">\
						<option selected value="default">default</option>\
						<option value="separator-top">separator-top</option>\
						<option value="separator-bottom">separator-bottom</option>\
						<option value="heading-large">heading-large</option>\
						<option value="heading-small">heading-small</option>\
						<option value="link">link</option>\
					</select>\
				<br />\
				<small>Select the type of the divider.</small></td>\
			</tr>\
			<tr class="divider" style="display: none;">\
				<th><label for="divider_title">Title</label></th>\
				<td><input type="text" name="text" id="divider_title" /><br />\
				<small>This title would be shown only in the case when you select these options for divider type above: headling-large, heading-small and link</small></td>\
			</tr>\
			<tr class="divider" style="display: none;">\
				<th><label for="divider_linkto">Link to</label></th>\
				<td><input type="text" name="text" id="divider_linkto" /><br />\
				<small>A link will be shown in case you select \'link\' as the divider type above.</small></td>\
			</tr>\
			<tr class="icon" style="display: none;">\
				<th><label for="icon_type">Select Icon Type</label></th>\
				<td>\
					<select id="icon_type">\
						<option selected value="support">support</option>\
						<option value="shipping">shipping</option>\
						<option value="wallet">wallet</option>\
						<option value="cart">cart</option>\
						<option value="account">account</option>\
					</select>\
				</td>\
			</tr>\
			<tr class="contactform" style="display: none;">\
				<th><label for="contactform_sendto">Send Email To</label></th>\
				<td><input type="text" value="" id="contactform_sendto" /><br />\
				<small>The email address of the recipient.</small></td>\
			</tr>\
			<tr class="success" style="display: none;">\
				<th><label for="success_content">Content</label></th>\
				<td><textarea type="text" name="text" id="success_content"></textarea><br />\
				<small>The content text of the success message.</small></td>\
			</tr>\
			<tr class="error" style="display: none;">\
				<th><label for="error_content">Content</label></th>\
				<td><textarea type="text" name="text" id="error_content"></textarea><br />\
				<small>The content text of the error message.</small></td>\
			</tr>\
			<tr class="info" style="display: none;">\
				<th><label for="info_content">Content</label></th>\
				<td><textarea type="text" name="text" id="info_content"></textarea><br />\
				<small>The content text of the info message.</small></td>\
			</tr>\
			<tr class="warning" style="display: none;">\
				<th><label for="warning_content">Content</label></th>\
				<td><textarea type="text" name="text" id="warning_content"></textarea><br />\
				<small>The content text of the warning message.</small></td>\
			</tr>\
			<tr class="accordion" style="display: none;">\
				<th><label for="accordion_title">Title</label></th>\
				<td><input type="text" value="" id="accordion_title" /><br />\
				<small>The title of this accordion pane.</small></td>\
			</tr>\
			<tr class="tabgroup" style="display: none;">\
				<th><label for="tabgroup_1">Title 1</label></th>\
				<td><input type="text" value="" id="tabgroup_1" /><br />\
				<small>The title for the first tab.</small></td>\
			</tr>\
			<tr class="tabgroup" style="display: none;">\
				<th><label for="tabgroup_2">Title 2</label></th>\
				<td><input type="text" value="" id="tabgroup_2" /></td>\
			</tr>\
			<tr class="tabgroup" style="display: none;">\
				<th><label for="tabgroup_3">Title 3</label></th>\
				<td><input type="text" value="" id="tabgroup_3" /></td>\
			</tr>\
			<tr class="tabgroup" style="display: none;">\
				<th><label for="tabgroup_4">Title 4</label></th>\
				<td><input type="text" value="" id="tabgroup_4" /></td>\
			</tr>\
			<tr class="tabgroup" style="display: none;">\
				<th><label for="tabgroup_5">Title 5</label></th>\
				<td><input type="text" value="" id="tabgroup_5" /></td>\
			</tr>\
			<tr class="tab" style="display: none;">\
				<th><label for="tab_id">Title</label></th>\
				<td><input type="text" value="" id="tab_id" /><br />\
				<small>The id of this tab. This should be the same as what you entered when creating a tab group.</small></td>\
			</tr>\
			<tr class="client" style="display: none;">\
				<th><label for="client_image">Image Url</label></th>\
				<td><input type="text" value="" id="client_image" /><br />\
				<small>Add the url of the client\'s logo/image.</small></td>\
			</tr>\
			<tr class="client" style="display: none;">\
				<th><label for="client_linkto">Link to</label></th>\
				<td><input type="text" value="" id="client_linkto" /></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="mygallery-submit" class="button-primary" value="Insert" name="submit" />\
		</p>\
		</div>');		
		
		
		var table = form.find('table');
		form.appendTo('body').hide();		
		
		table.find('#myshortcode').change(function(){
			var mycode = table.find('#myshortcode').val();
			table.find('tr').not('.myshortcode').css("display", "none");			
			table.find('.'+mycode).css("display", "block");
		});
		
		
		// handles the click event of the submit button
		form.find('#mygallery-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless

			var current = table.find('#myshortcode').val();
			var shortcode;
			
			if(current == 'clear')
			shortcode = '['+current+' /]';
			
			else if (current == 'accordion_group')
			shortcode = '[raw]['+current+']Your content ...[/'+current+'][/raw]';
			
			else if(current == 'raw' || current == 'col2' || current == 'col2_last' || current == 'col3' || current == 'col3_last' || current == 'col4' || current == 'col4_last' || current == 'col23' || current == 'col23_last' || current == 'col34' || current == 'col34_last' || current == 'faq' || current == 'alignleft' || current == 'alignright' || current == 'fancyborder' )
			shortcode = '['+current+']Your content ...[/'+current+']';
			
			else if(current == 'icon')
			shortcode = '['+current+' type="'+table.find('#'+current+'_type').val()+'"]Enter content..[/'+current+']';
			
			else if(current == 'tabgroup'){
				shortcode = '['+current;
				var i;
				for(i=1; i<=5; i++){
					if(table.find('#'+current+'_'+i).val() != '')
					shortcode += ' tab'+i+'="'+table.find('#'+current+'_'+i).val()+'"';
					else break;
				}
				shortcode += ']Add your individual tabs here..[/'+current+']';
			}

			else if(current == 'mybutton')
			shortcode = '[button linkto="'+table.find('#mybutton_linkto').val()+'" type="'+table.find('#mybutton_type').val()+'"]'+table.find('#mybutton_content').val()+'[/button]';
			
			else if(current == 'highlight')
			shortcode = '[highlight type="'+table.find('#highlight_type').val()+'"]Your content..[/highlight]';
			
			else if(current == 'contactform')
			shortcode = '[raw][contactform sendto="'+table.find('#contactform_sendto').val()+'" /][/raw]';
			
			else if(current == 'accordion')
			shortcode = '[accordion title="'+table.find('#accordion_title').val()+'"]Your content..[/accordion]';
			
			else if(current == 'quote')
			shortcode = '[quote type="'+table.find('#quote_type').val()+'" avatar="'+table.find('#quote_avatar').val()+'"]Your content..[/quote]';
			
			else if(current == 'tab')
			shortcode = '[tab id="'+table.find('#tab_id').val()+'"]Enter the tab\'s content..[/tab]';
			
			else if(current == 'client') {
			shortcode = '[client image="'+table.find('#client_image').val()+'" linkto="'+table.find('#client_linkto').val()+'" /]';
			}
			
			else if(current == 'divider') {
			shortcode = '[raw][divider type="'+table.find('#divider_type').val()+'" title="'+table.find('#divider_title').val()+'" linkto="'+table.find('#divider_linkto').val()+'" /][/raw]';
			}
			
			else if(current == 'faqitem') {
			shortcode = '[faqitem question="'+table.find('#question_faqitem').val()+'"]'+table.find('#answer_faqitem').val()+'[/faqitem]';
			}
			
			else if(current == 'success' || current == 'error'  || current == 'info'  || current == 'warning')
			shortcode = '['+current+']'+table.find('#'+current+'_content').val()+'[/'+current+']';

			else 
			shortcode = '';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()