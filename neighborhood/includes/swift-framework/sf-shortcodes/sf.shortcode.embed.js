function embedSelectedShortcode() {
	
	var shortcodeHTML;
	var shortcode_panel = document.getElementById('shortcode_panel');
	var current_shortcode = shortcode_panel.className.indexOf('current');

	if (current_shortcode != -1) {
		
		// SHORTCODE SELECT
		var shortcode_select = document.getElementById('shortcode-select').value;
		

		/////////////////////////////////////////
		////	SHORTCODE OPTION VARIABLES
		/////////////////////////////////////////
		
		// Button
		var button_size = document.getElementById('button-size').value;
		var button_type = document.getElementById('button-type').value;
		var button_colour = document.getElementById('button-colour').value;
		var button_text = document.getElementById('button-text').value;
		var button_url = document.getElementById('button-url').value;
		var button_target = "";
			
		if (document.getElementById('button-target').checked) {
			button_target = "_blank";
		} else {
			button_target = "_self";
		}
		
		// Icons
		var icon_size = document.getElementById('icon-size').value;
		var icon_image = document.getElementById('icon-image').value;
		var icon_cont = document.getElementById('icon-cont').value;	
		var icon_float = document.getElementById('icon-float').value;	
		
		// Image Banner
		var imagebanner_image = document.getElementById('imagebanner-image').value;
		var imagebanner_animation = document.getElementById('imagebanner-animation').value;
		var imagebanner_contentpos = document.getElementById('imagebanner-contentpos').value;
		var imagebanner_textalign = document.getElementById('imagebanner-textalign').value;
		var imagebanner_extraclass = document.getElementById('imagebanner-extraclass').value;
		
		// Typography
		var typography_type = document.getElementById('typography-type').value;

		// Columns
		var column_options = document.getElementById('column-options').value;
			
		// Progress Bar
		var progressbar_percentage = document.getElementById('progressbar-percentage').value;
		var progressbar_text = document.getElementById('progressbar-text').value;
		var progressbar_value = document.getElementById('progressbar-value').value;
		var progressbar_type = document.getElementById('progressbar-type').value;
		var progressbar_colour = document.getElementById('progressbar-colour').value;
		
		// Chart
		var chart_percentage = document.getElementById('chart-percentage').value;
		var chart_content = document.getElementById('chart-content').value;
		var chart_size = document.getElementById('chart-size').value;
		var chart_barcolour = document.getElementById('chart-barcolour').value;
		var chart_trackcolour = document.getElementById('chart-trackcolour').value;
		var chart_align = document.getElementById('chart-align').value;
		
		// Tooltip
		var tooltip_text = document.getElementById('tooltip-text').value;
		var tooltip_link = document.getElementById('tooltip-link').value;
		var tooltip_direction = document.getElementById('tooltip-direction').value;
		
		// Modal
		var modal_button_size = document.getElementById('modal-button-size').value;
		var modal_button_type = document.getElementById('modal-button-type').value;
		var modal_button_colour = document.getElementById('modal-button-colour').value;
		var modal_button_text = document.getElementById('modal-button-text').value;
		var modal_header = document.getElementById('modal-header').value;
		
		// Responsive Visibilty
		var responsivevis_config = document.getElementById('responsivevis-config').value;
		
		// Social
		var social_size = document.getElementById('social-size').value;
		var social_style = document.getElementById('social-style').value;
		
		// Table
		var table_type = document.getElementById('table-type').value;
		var table_head = document.getElementById('table-head').value;
		var table_columns = document.getElementById('table-columns').value;
		var table_rows = document.getElementById('table-rows').value;
		
		// Pricing Table
		var ptable_type = document.getElementById('ptable-type').value;
		var ptable_columns = document.getElementById('ptable-columns').value;
		var ptable_highlight = document.getElementById('ptable-highlight').value;
		var ptable_buttontext = document.getElementById('ptable-buttontext').value;
		
		// Labelled Pricing Table
		var lptable_columns = document.getElementById('lptable-columns').value;
		var lptable_highlight = document.getElementById('lptable-highlight').value;
		var lptable_rows = document.getElementById('lptable-rows').value;
		var lptable_buttontext = document.getElementById('lptable-buttontext').value;
		
		// Lists
		var list_type = document.getElementById('list-type').value;
		var list_items = document.getElementById('list-items').value;	
	
		/////////////////////////////////////////
		////	BUTTON SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-buttons') {
			shortcodeHTML = '[button colour="'+button_colour+'" type="'+button_type+'" size="'+button_size+'" link="'+button_url+'" target="'+button_target+'"]'+button_text+'[/button]';	
		}
		
		/////////////////////////////////////////
		////	ICON SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-icons') {
			shortcodeHTML = '[icon image="'+icon_image+'" size="'+icon_size+'" cont="'+icon_cont+'" float="'+icon_float+'"]';	
		}
		
		
		/////////////////////////////////////////
		////	IMAGE BANNER SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-imagebanner') {
			shortcodeHTML = '[sf_imagebanner image="'+imagebanner_image+'" animation="'+imagebanner_animation+'" contentpos="'+imagebanner_contentpos+'" textalign="'+imagebanner_textalign+'" extraclass="'+imagebanner_extraclass+'"]<br/>Enter your Image Banner content here<br/>[/sf_imagebanner]';	
		}


		/////////////////////////////////////////
		////	SOCIAL SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-social') {
			shortcodeHTML = '[social size="'+social_size+'" style="'+social_style+'"]';	
		}
		
		/////////////////////////////////////////
		////	SHARE SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-share') {
			shortcodeHTML = '[sf_share]';	
		}
		
		/////////////////////////////////////////
		////	LATEST TWEET SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-tweet') {
			shortcodeHTML = "[latest-tweet username="+twitter_username+"]";	
		}

		/////////////////////////////////////////
		////	TYPOGRAPHY SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-typography') {
			shortcodeHTML = "["+typography_type+"]TEXT HERE[/"+typography_type+"]";	
		}

		/////////////////////////////////////////
		////	COLUMNS SHORTCODE OUTPUT
		/////////////////////////////////////////


		if (shortcode_select == 'shortcode-columns' && column_options == 'two_halves') {
			shortcodeHTML = "[one_half]1/2 Text[/one_half]<br/>[one_half_last]1/2 Text[/one_half_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'three_thirds') {
			shortcodeHTML = "[one_third]1/3 Text[/one_third]<br/>[one_third]1/3 Text[/one_third]<br/>[one_third_last]1/3 Text[/one_third_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'one_third_two_thirds') {
			shortcodeHTML = "[one_third]1/3 Text[/one_third]<br/>[two_third_last]2/3 Text[/two_third_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'two_thirds_one_third') {
			shortcodeHTML = "[two_third]2/3 Text[/two_third]<br/>[one_third_last]1/3 Text[/one_third_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'four_quarters') {
			shortcodeHTML = "[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth_last]1/4 Text[/one_fourth_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'one_quarter_three_quarters') {
			shortcodeHTML = "[one_fourth]1/4 Text[/one_fourth]<br/>[three_fourth_last]3/4 Text[/three_fourth_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'three_quarters_one_quarter') {
			shortcodeHTML = "[three_fourth]3/4 Text[/three_fourth]<br/>[one_fourth_last]1/4 Text[/one_fourth_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'one_quarter_one_quarter_one_half') {
			shortcodeHTML = "[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth]1/4 Text[/one_fourth]<br/>[one_half_last]1/2 Text[/one_half_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'one_quarter_one_half_one_quarter') {
			shortcodeHTML = "[one_fourth]1/4 Text[/one_fourth]<br/>[one_half]1/2 Text[/one_half]<br/>[one_fourth_last]1/4 Text[/one_fourth_last]";	
		}

		if (shortcode_select == 'shortcode-columns' && column_options == 'one_half_one_quarter_one_quarter') {
			shortcodeHTML = "[one_half]1/2 Text[/one_half]<br/>[one_fourth]1/4 Text[/one_fourth]<br/>[one_fourth_last]1/4 Text[/one_fourth_last]";	
		}
		
		/////////////////////////////////////////
		////	PROGRESS BAR SHORTCODE OUTPUT
		/////////////////////////////////////////
				
		if (shortcode_select == 'shortcode-progressbar') {
		
			shortcodeHTML = '[progress_bar percentage="' + progressbar_percentage + '" name="' + progressbar_text + '" value="' + progressbar_value + '" type="' + progressbar_type + '" colour="' + progressbar_colour + '"]<br/>';
		
		}
		
		/////////////////////////////////////////
		////	CHART SHORTCODE OUTPUT
		/////////////////////////////////////////
				
		if (shortcode_select == 'shortcode-chart') {
		
			shortcodeHTML = '[chart percentage="' + chart_percentage + '" size="' + chart_size + '" barcolour="' + chart_barcolour + '" trackcolour="' + chart_trackcolour + '" content="' + chart_content + '" align="' + chart_align + '"]<br/>';
		
		}
		
		/////////////////////////////////////////
		////	TOOLTIP SHORTCODE OUTPUT
		/////////////////////////////////////////
				
		if (shortcode_select == 'shortcode-tooltip') {
		
			shortcodeHTML = '[sf_tooltip link="' + tooltip_link + '" direction="' + tooltip_direction + '" title="'+ tooltip_text +'"]TEXT HERE[/sf_tooltip]';
		
		}
		
		/////////////////////////////////////////
		////	MODAL SHORTCODE OUTPUT
		/////////////////////////////////////////
				
		if (shortcode_select == 'shortcode-modal') {
			
			shortcodeHTML = '[sf_modal header="' + modal_header + '" btn_colour="'+modal_button_colour+'" btn_type="'+modal_button_type+'" btn_size="'+modal_button_size+'" btn_text="'+modal_button_text+'"]<br/>ENTER THE MODAL BODY HERE<br/>[/sf_modal]<br/>';
		
		}
		
		/////////////////////////////////////////
		////	RESPONSIVE VIS SHORTCODE OUTPUT
		/////////////////////////////////////////
				
		if (shortcode_select == 'shortcode-responsivevis') {
			
			shortcodeHTML = '[sf_visibility class="'+ responsivevis_config +'"]<br/>ENTER THE RESPONSIVE VISIBILITY CONTENT HERE<br/>[/sf_visibility]<br/>';
		
		}
		
		/////////////////////////////////////////
		////	TABLE SHORTCODE OUTPUT
		/////////////////////////////////////////
	
		if (shortcode_select == 'shortcode-tables') {
			
			shortcodeHTML = '[table type="' + table_type + '"]<br/>';
			
			if (table_head == "yes") {
				shortcodeHTML += '[trow]<br/>';
				for ( var hc = 0; hc < table_columns; hc++ ) {
					shortcodeHTML += '[thcol]HEAD COL ' + parseInt(hc + 1) + '[/thcol]<br/>';
				}
				shortcodeHTML += '[/trow]<br/>';
			}
			
			for ( var r = 0; r < table_rows; r++ ) {
				shortcodeHTML += '[trow]<br/>';
				for ( var nc = 0; nc < table_columns; nc++ ) {
					shortcodeHTML += '[tcol]ROW ' + parseInt(r + 1) + ' COL ' + parseInt(nc + 1) + '[/tcol]<br/>';
				} 
				shortcodeHTML += '[/trow]<br/>';
			}
			
			shortcodeHTML += '[/table]<br/>';
		}
		
		/////////////////////////////////////////
		////	PRICING TABLE SHORTCODE OUTPUT
		/////////////////////////////////////////
	
		if (shortcode_select == 'shortcode-pricingtables') {
			
			shortcodeHTML = '[pricing_table type="' + ptable_type + '" columns="' + ptable_columns + '"]';
			
			for ( var ptc = 0; ptc < ptable_columns; ptc++ ) {
			
				if (parseInt(ptable_highlight) == parseInt(ptc + 1)) {
					shortcodeHTML += '[pt_column highlight="yes"]';
				} else {
					shortcodeHTML += '[pt_column]';
				}
			
				if (ptable_type == "bordered") {
				
					shortcodeHTML += '[pt_package]Basic Package [pt_price]$100<span>/ mo.</span>[/pt_price][/pt_package]';
					if (ptable_buttontext != "") {
					shortcodeHTML += '[pt_details]Details here<br/><br/>[pt_button link="#" target="_self"]' + ptable_buttontext + '[/pt_button][/pt_details]';
					} else {
					shortcodeHTML += '[pt_details]Details here[/pt_details]';
					}
				
				} else {
				
					shortcodeHTML += '[pt_price]$100<span>/ mo.</span>[/pt_price]';
					shortcodeHTML += '[pt_package]Basic Package[/pt_package]';
					if (ptable_buttontext != "") {
					shortcodeHTML += '[pt_details]Details here<br/><br/>[pt_button link="#" target="_self"]' + ptable_buttontext + '[/pt_button][/pt_details]';
					} else {
					shortcodeHTML += '[pt_details]Details here[/pt_details]';
					}				
				
				}
				
				shortcodeHTML += '[/pt_column]<br/>';
			
			}
			
			shortcodeHTML += '[/pricing_table]<br/>';
			
		}
		
		
		/////////////////////////////////////////
		////	LABELLED PRICING TABLE SHORTCODE OUTPUT
		/////////////////////////////////////////
	
		if (shortcode_select == 'shortcode-labelledpricingtables') {
			var totalColumns = parseInt(lptable_columns) + 1;
			shortcodeHTML = '[labelled_pricing_table columns="' + totalColumns + '"]<br/>';
			
			shortcodeHTML += '[lpt_label_column]<br/>';
			
			for ( var lptr = 0; lptr < lptable_rows; lptr++ ) {
				
				if (lptr % 2 == 0) { 
					shortcodeHTML += '[lpt_row_label alt="yes"] LABEL ' + lptr + ' [/lpt_row_label]<br/>';
				} else {
					shortcodeHTML += '[lpt_row_label] LABEL ' + lptr + ' [/lpt_row_label]<br/>';
				}
			}
			
			shortcodeHTML += '[/lpt_label_column]<br/>';
			
			for ( var lptc = 0; lptc < lptable_columns; lptc++ ) {
			
				if (parseInt(lptable_highlight) == parseInt(lptc + 1)) {
					shortcodeHTML += '[lpt_column highlight="yes"]<br/>';
				} else {
					shortcodeHTML += '[lpt_column]<br/>';
				}
			
				shortcodeHTML += '[lpt_price]$100<span>/ mo.</span>[/lpt_price]<br/>';
				shortcodeHTML += '[lpt_package]Basic Package[/lpt_package]<br/>';
				
				for ( var lptr = 0; lptr < lptable_rows; lptr++ ) {
				
					if (lptr % 2 == 0) { 
						shortcodeHTML += '[lpt_row_label alt="yes"] LABEL ' + lptr + ' [/lpt_row_label]<br/>';
						shortcodeHTML += '[lpt_row alt="yes"] DETAIL ' + lptr + ' [/lpt_row]<br/>';
					} else {
						shortcodeHTML += '[lpt_row_label] LABEL ' + lptr + ' [/lpt_row_label]<br/>';
						shortcodeHTML += '[lpt_row] DETAIL ' + lptr + ' [/lpt_row]<br/>';
					}

				}
				
				if (lptable_buttontext != "") {
				shortcodeHTML += '[lpt_button link="#" target="_self"]' + lptable_buttontext + '[/lpt_button]<br/>';
				}
								
				shortcodeHTML += '[/lpt_column]<br/>';
			
			}
			
			shortcodeHTML += '[/labelled_pricing_table]<br/>';
			
		}
			
		
		var lptable_columns = document.getElementById('lptable-columns').value;
		var lptable_highlight = document.getElementById('lptable-highlight').value;
		var lptable_rows = document.getElementById('lptable-rows').value;
		var lptable_buttontext = document.getElementById('lptable-buttontext').value;
		
		/////////////////////////////////////////
		////	LIST SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-lists') {
			shortcodeHTML = '[list type="'+ list_type +'"]<br/>';
			
			for ( var li = 0; li < list_items; li++ ) {
				shortcodeHTML += '[list_item]Item text '+ parseInt(li + 1) +'[/list_item]<br/>';
			}
			
			shortcodeHTML += '[/list]<br/>';	
		}
		
		/////////////////////////////////////////
		////	DIVIDER SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-divider') {
			shortcodeHTML = '[hr]';	
		}

		/////////////////////////////////////////
		////	ACCORDION SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-accordion') {
			shortcodeHTML = '[accordion]<br />[panel title="Panel #1"]First panel text[/panel]<br />[panel title="Panel #2"]Second panel text[/panel]<br />[panel title="Panel #3"]Third panel text[/panel]<br />[/accordion]';
		}

		/////////////////////////////////////////
		////	TABS SHORTCODE OUTPUT
		/////////////////////////////////////////

		if (shortcode_select == 'shortcode-tabs') {
			shortcodeHTML = '[tabs tab_one="Tab #1" tab_two="Tab #2" tab_three="Tab #3" tab_four="Tab #4"]<br />[tab]Tab #1 Content[/tab]<br />[tab]Tab #2 Content[/tab]<br />[tab]Tab #3 Content[/tab]<br />[tab]Tab #4 Content[/tab]<br />[/tabs]';
		}

	}

	/////////////////////////////////////////
	////	TinyMCE Callback & Embed
	/////////////////////////////////////////
	
	if (current_shortcode != -1) {
		activeEditor = window.tinyMCE.activeEditor.id;
		if (window.tinyMCE.majorVersion >= 4) {
			window.tinymce.get(activeEditor).insertContent(shortcodeHTML);
		} else {
			window.tinyMCE.execInstanceCommand(activeEditor, 'mceInsertContent', false, shortcodeHTML);		
		}
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	} else {
		tinyMCEPopup.close();		
	}

	return;
}