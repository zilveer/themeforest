(function() {
   tinymce.create('tinymce.plugins.qode_shortcodes', {
      init : function(ed, url) {

          ed.addButton('qode_shortcodes', {
              id : 'qode_shortcode_button',
              title : 'Select Shortcodes',
              image : url+'/qode_shortcodes.ico',
              onclick : function() {

                  jQuery("#qode_shortcode_form_wrapper").remove();

                  var shortcodes_visible = jQuery("#qode_shortcodes_menu_holder").length;

                  if (shortcodes_visible){
                      jQuery("#qode_shortcodes_menu_holder").remove();
                  } else{

                      var container_element = "";
                      var id = jQuery(this).attr("id");

						if(jQuery('#qode_shortcode_button').length && !jQuery('#wp-wpb_tinymce_content-wrap').length){
							container_element = jQuery('#qode_shortcode_button').closest(".mce-toolbar-grp");
						} else if (jQuery("#"+id+"_toolbargroup").length){
							container_element = jQuery("#"+id+"_toolbargroup");
						} else if (jQuery('#wp-wpb_tinymce_content-wrap #qode_shortcode_button').length){
							container_element = jQuery('#wp-wpb_tinymce_content-wrap');
						}

						if(container_element != ""){
							container_element.append("<div id='qode_shortcodes_menu_holder'></div>");
						}

                      jQuery('#qode_shortcodes_menu_holder').load(url + '/qode_shortcodes_popup.html#qode_shortodes_popup', function(){

                          var y = 0;
                          var x = 0;

							if(jQuery('#qode_shortcode_button button').length && !jQuery('#wp-wpb_tinymce_content-wrap').length){
							  x = parseInt(jQuery("#qode_shortcode_button button").offset().left) - parseInt(jQuery("#adminmenuwrap").width()) + 10;
							} else if (jQuery("#content_qode_shortcodes").length){
							  x = parseInt(jQuery("#content_qode_shortcodes").offset().left) - parseInt(jQuery("#adminmenuwrap").width()) + 10;
							} else if (jQuery('#wp-wpb_tinymce_content-wrap').length){
								y = 70;
								x = 0;
							}

                          jQuery("#qode_shortcodes_menu_holder").css({top: y, left: x});

						jQuery("#SC_1-2x1-2").click(function(){
							var shortcode = '[vc_row][vc_column width="1/2"][/vc_column][vc_column width="1/2"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-3x2-3").click(function(){
							var shortcode = '[vc_row][vc_column width="1/3"][/vc_column][vc_column width="2/3"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_2-3x1-3").click(function(){
							var shortcode = '[vc_row][vc_column width="2/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-3x1-3x1-3").click(function(){
							var shortcode = '[vc_row][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-4x1-4x1-4x1-4").click(function(){
							var shortcode = '[vc_row][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-4x3-4").click(function(){
							var shortcode = '[vc_row][vc_column width="1/4"][/vc_column][vc_column width="3/4"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_3-4x1-4").click(function(){
							var shortcode = '[vc_row][vc_column width="3/4"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-4x1-2x1-4").click(function(){
							var shortcode = '[vc_row][vc_column width="1/4"][/vc_column][vc_column width="1/2"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_5-6x1-6").click(function(){
							var shortcode = '[vc_row][vc_column width="5/6"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-6x5-6").click(function(){
							var shortcode = '[vc_row][vc_column width="1/6"][/vc_column][vc_column width="5/6"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-6x1-6x1-6x1-6x1-6x1-6").click(function(){
							var shortcode = '[vc_row][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-6x2-3x1-6").click(function(){
							var shortcode = '[vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_1-6x1-6x1-6x1-2").click(function(){
							var shortcode = '[vc_row][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/2"][/vc_column][/vc_row]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_accordion").click(function(){
							var shortcode = '[vc_accordion style="accordion" active_tab="" collapsible="" accordion_border_radius="" el_class=""]<br/><br/>[vc_accordion_tab title="Section 1"][/vc_accordion_tab]<br/>[vc_accordion_tab title="Section 2"][/vc_accordion_tab]<br/>[vc_accordion_tab title="Section 3"][/vc_accordion_tab]<br/><br/>[/vc_accordion]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})
						
						jQuery("#SC_pricing_table").click(function(){
							var shortcode = '[qode_pricing_table title="" target="" button_size="" active="" price="" price_font_weight="" currency="" price_period="" button_text="" link="" active_text=""][/qode_pricing_table]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_custom_font").click(function(){
							var shortcode = '[custom_font font_family="Crete Round" font_size="17" line_height="26" font_style="italic" text_align="left" font_weight="400" color="" background_color="" text_decoration="none" text_shadow="no" letter_spacing="0" padding="0" margin="0"]content content content[/custom_font]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_ordered-list").click(function(){
							var shortcode = '[ordered_list]<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>[/ordered_list]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})
						jQuery("#SC_social_share").click(function(){
							var shortcode = '[social_share]';
							ed.execCommand('mceInsertContent', false, shortcode);
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						////////////////////////////////
						// pop-up shortcodes          //
						////////////////////////////////
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 120;


						jQuery("#call_to_action").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_action.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
								colorPicker();
							    tb_show( 'Call To Action Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								    var full_width = jQuery('#TB_window #full_width option:selected').val();
								    var content_in_grid = jQuery('#TB_window #content_in_grid option:selected').val();
								    var type = jQuery('#TB_window #type option:selected').val();
								    var icon = jQuery('#TB_window #icon option:selected').val();
								    var icon_size = jQuery('#TB_window #icon_size option:selected').val();
									var icon_color = jQuery('#TB_window #icon_color').val();
									var custom_icon = jQuery('#TB_window #custom_icon').val();
									var background_color = jQuery('#TB_window #background_color').val();
									var border_color = jQuery('#TB_window #border_color').val();
									var box_padding = jQuery('#TB_window #box_padding').val();
									var text_size = jQuery('#TB_window #text_size').val();
									var show_button = jQuery('#TB_window #show_button option:selected').val();
									var button_text = jQuery('#TB_window #button_text').val();
									var button_link = jQuery('#TB_window #button_link').val();
									var button_target = jQuery('#TB_window #button_target option:selected').val();
									var button_text_color = jQuery('#TB_window #button_text_color').val();
									var button_hover_text_color = jQuery('#TB_window #button_hover_text_color').val();
									var button_background_color = jQuery('#TB_window #button_background_color').val();
									var button_hover_background_color = jQuery('#TB_window #button_hover_background_color').val();
									var button_border_color = jQuery('#TB_window #button_border_color').val();
									var button_hover_border_color = jQuery('#TB_window #button_hover_border_color').val();
								    var shortcode = "[call_to_action full_width='"+full_width+"' content_in_grid='"+content_in_grid+"' type='"+type+"' icon='"+icon+"' icon_size='"+icon_size+"' icon_color='"+icon_color+"' custom_icon='"+custom_icon+"' background_color='"+background_color+"' border_color='"+border_color+"' box_padding='"+box_padding+"' text_size='"+text_size+"' show_button='"+show_button+"' button_text='"+button_text+"' button_link='"+button_link+"' button_target='"+button_target+"' button_text_color='"+button_text_color+"' button_hover_text_color='"+button_hover_text_color+"' button_background_color='"+button_background_color+"' button_hover_background_color='"+button_hover_background_color+"' button_border_color='"+button_border_color+"' button_hover_border_color='"+button_hover_border_color+"']<br /><br /> content content content <br /><br />[/call_to_action]";
									jQuery("#qode_shortcode_form_wrapper").remove()
								    ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								    return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_blockquotes").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_blockquotes.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
                                colorPicker();
							    tb_show( 'Blockquote Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var text = jQuery('#TB_window #text').val();
									var text_color = jQuery('#TB_window #text_color').val();
									var title_tag = jQuery('#TB_window #title_tag option:selected').val();
									var width = jQuery('#TB_window #blockquote_width').val();
									var line_height = jQuery().val('#TB_window #line_height').val();
									var background_color = jQuery('#TB_window #background_color').val();
									var border_color = jQuery('#TB_window #border_color').val();
                                    var show_quote_icon = jQuery('#TB_window #show_quote_icon option:selected').val();
									var quote_icon_color = jQuery('#TB_window #quote_icon_color').val();
									var quote_icon_size = jQuery('#TB_window #quote_icon_size').val();
									var shortcode = "[blockquote text='"+text+"' text_color='"+text_color+"' title_tag='"+title_tag+"' width='"+width+"' line_height='"+line_height+"' background_color='"+background_color+"' border_color='"+border_color+"' show_quote_icon='"+show_quote_icon+"' quote_icon_color='"+quote_icon_color+"' quote_icon_size='"+quote_icon_size+"']";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							    });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_button").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_button.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
								colorPicker();
							    tb_show( 'Button Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								    var size = jQuery('#TB_window #size option:selected').val();
								    var style = jQuery('#TB_window #style option:selected').val();
								    var text = jQuery('#TB_window #text').val();
									var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
									var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
									var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
								    var icon_size = jQuery('#TB_window #icon_size').val();
								    var icon_color = jQuery('#TB_window #icon_color').val();
								    var link = jQuery('#TB_window #link').val();
								    var target = jQuery('#TB_window #target option:selected').val();
								    var background_color = jQuery('#TB_window #background_color').val();
								    var hover_background_color = jQuery('#TB_window #hover_background_color').val();
								    var border_color = jQuery('#TB_window #border_color').val();
								    var hover_border_color = jQuery('#TB_window #hover_border_color').val();
								    var color = jQuery('#TB_window #color').val();
								    var hover_color = jQuery('#TB_window #hover_color').val();
								    var font_style = jQuery('#TB_window #font_style option:selected').val();
								    var font_weight = jQuery('#TB_window #font_weight option:selected').val();
								    var text_align = jQuery('#TB_window #text_align option:selected').val();
									var margin = jQuery('#TB_window #margin').val();
								    var shortcode = '[qbutton size="'+size+'" style="'+style+'" text="'+text+'" icon_pack="'+icon_pack+'" fa_icon="'+fa_icon+'" fe_icon="'+fe_icon+'" icon_color="'+icon_color+'" link="'+link+'" target="'+target+'" color="'+color+'" hover_color="'+hover_color+'" border_color="'+border_color+'" hover_border_color="'+hover_border_color+'" background_color="'+background_color+'" hover_background_color="'+hover_background_color+'" font_style="'+font_style+'" font_weight="'+font_weight+'" text_align="'+text_align+'" margin="'+margin+'"]';
								    jQuery("#qode_shortcode_form_wrapper").remove()
								    ed.execCommand('mceInsertContent', false, shortcode);
								    tb_remove();
								    return false;
							    });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_counter").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_counter.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								colorPicker();
							   tb_show( 'Counter Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
							   	   var type = jQuery('#TB_window #type option:selected').val();
							   	   var box = jQuery('#TB_window #box option:selected').val();
                                   var box_border_color = jQuery('#TB_window #box_border_color').val();
							   	   var position = jQuery('#TB_window #position option:selected').val();
								   var digit = jQuery('#TB_window #digit').val();
								   var font_size = jQuery('#TB_window #font_size').val();
								   var font_weight = jQuery('#TB_window #font_weight option:selected').val();
								   var font_color = jQuery('#TB_window #font_color').val();
								   var text = jQuery('#TB_window #text').val();
								   var text_size = jQuery('#TB_window #text_size').val();
								   var text_font_weight = jQuery('#TB_window #text_font_weight option:selected').val();
								   var text_transform = jQuery('#TB_window #text_transform option:selected').val();
                                   var text_color = jQuery('#TB_window #text_color').val();
                                   var separator = jQuery('#TB_window #separator option:selected').val();
                                   var separator_color = jQuery('#TB_window #separator_color').val();
								   var separator_border_style = jQuery('#TB_window #separator_border_style option:selected').val();
								   var shortcode = "[counter type='"+type+"' box='"+box+"' position='"+position+"' digit='"+digit+"' font_size='"+font_size+"' font_weight='"+font_weight+"' font_color='"+font_color+" text='"+text+"' text_size='"+text_size+"' text_font_weight='"+text_font_weight+"' text_transform='"+text_transform+"' text_color='"+text_color+"' separator='"+separator+"' separator_color='"+separator_color+"' separator_border_style='"+separator_border_style+"']";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								   return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_cover_boxes").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_cover_boxes.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
								colorPicker();
							    tb_show( 'Cover Boxes Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var active_element = jQuery('#TB_window #active_element').val();
									var title_tag = jQuery('#TB_window #title_tag option:selected').val();
									var image1 = jQuery('#TB_window #image1').val();
									var title1 = jQuery('#TB_window #title1').val();
									var title_color1 = jQuery('#TB_window #title_color1').val();
									var text1 = jQuery('#TB_window #text1').val();
									var text_color1 = jQuery('#TB_window #text_color1').val();
									var link1 = jQuery('#TB_window #link1').val();
									var link_label1 = jQuery('#TB_window #link_label1').val();
								    var target1 = jQuery('#TB_window #target1 option:selected').val();
									var image2 = jQuery('#TB_window #image2').val();
									var title2 = jQuery('#TB_window #title2').val();
									var title_color2 = jQuery('#TB_window #title_color2').val();
									var text2 = jQuery('#TB_window #text2').val();
									var text_color2 = jQuery('#TB_window #text_color2').val();
									var link2 = jQuery('#TB_window #link2').val();
									var link_label2 = jQuery('#TB_window #link_label2').val();
								    var target2 = jQuery('#TB_window #target2 option:selected').val();
									var image3 = jQuery('#TB_window #image3').val();
									var title3 = jQuery('#TB_window #title3').val();
									var title_color3 = jQuery('#TB_window #title_color3').val();
									var text3 = jQuery('#TB_window #text3').val();
									var text_color3 = jQuery('#TB_window #text_color3').val();
									var link3 = jQuery('#TB_window #link3').val();
									var link_label3 = jQuery('#TB_window #link_label3').val();
								    var target3 = jQuery('#TB_window #target3 option:selected').val();
									var read_more_button_style = jQuery('#TB_window #read_more_button_style option:selected').val();

									var shortcode = "[cover_boxes active_element='"+active_element+"' title_tag='"+title_tag+"' image1='"+image1+"' title1='"+title1+"' title_color1='"+title_color1+"' text1='"+text1+"' text_color1='"+text_color1+"' link1='"+link1+"' link_label1='"+link_label1+"' target1='"+target1+"' image2='"+image2+"' title2='"+title2+"' title_color2='"+title_color2+"' text2='"+text2+"' text_color2='"+text_color2+"' link2='"+link2+"' link_label2='"+link_label2+"' target2='"+target2+"' image3='"+image3+"' title3='"+title3+"' title_color3='"+title_color3+"' text3='"+text3+"' text_color3='"+text_color3+"' link3='"+link3+"' link_label3='"+link_label3+"' target3='"+target3+"' read_more_button_style='"+read_more_button_style+"']";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_dropcaps").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_dropcaps.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
								colorPicker();
							    tb_show( 'Dropcap Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								   var type = jQuery('#TB_window #type option:selected').val();
								   var letter = jQuery('#TB_window #letter').val();
								   var color = jQuery('#TB_window #color').val();
								   var background_color = jQuery('#TB_window #background_color').val();
								   var border_color = jQuery('#TB_window #border_color').val();
								   var shortcode = "[dropcaps type='"+type+"' color='"+color+"' background_color='"+background_color+"' border_color='"+border_color+"']" + letter + "[/dropcaps]";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								   return false;
							    });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_horizontal_progress").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_progress_bar_horizontal.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Horizontal Progress Bar Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
							   	   var title = jQuery('#TB_window #title').val();
                                   var title_color = jQuery('#TB_window #title_color').val();
                                   var title_tag = jQuery('#TB_window #title_tag option:selected').val();
                                   var title_custom_size = jQuery('#TB_window #title_custom_size').val();
                                   var percent = jQuery('#TB_window #percent').val();
                                   var show_percent_mark = jQuery('#TB_window #show_percent_mark option:selected').val();
							   	   var percent_color = jQuery('#TB_window #percent_color').val();
								   var percent_font_size = jQuery('#TB_window #percent_font_size').val();
								   var percent_font_weight = jQuery('#TB_window #percent_font_weight').val();
							   	   var active_background_color = jQuery('#TB_window #active_background_color').val();
							   	   var active_border_color = jQuery('#TB_window #active_border_color').val();
							   	   var noactive_background_color = jQuery('#TB_window #noactive_background_color').val();
							   	   var height = jQuery('#TB_window #height').val();
								   var border_radius = jQuery('#TB_window #border_radius').val();
								   var shortcode = "[progress_bar title='"+title+"' title_color='"+title_color+"' title_tag='"+title_tag+"' title_custom_size='"+title_custom_size+"' percent='"+percent+"' show_percent_mark='"+show_percent_mark+"' percent_color='"+percent_color+"' percent_font_size='"+percent_font_size+"' percent_font_weight='"+percent_font_weight+"' active_background_color='"+active_background_color+"' active_border_color='"+active_border_color+"' noactive_background_color='"+noactive_background_color+"' height='"+height+"' border_radius='"+border_radius+"']";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);
								   tb_remove();
								   return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

                        jQuery("#SC_vertical_progress").click(function(){
                            jQuery("#qode_shortcode_form_wrapper").remove();
                            jQuery.get(url + "/qode_shortcodes_progress_bar_vertical.php", function(data){
                               var form = jQuery(data);
                               form.appendTo('body').hide();
                               colorPicker();
                               tb_show( 'Vertical progress bar shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
                               jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
                                   var title = jQuery('#TB_window #title').val();
                                   var title_color = jQuery('#TB_window #title_color').val();
                                   var title_tag = jQuery('#TB_window #title_tag option:selected').val();
                                   var title_size = jQuery('#TB_window #title_size').val();
                                   var bar_color = jQuery('#TB_window #bar_color').val();
                                   var bar_border_color = jQuery('#TB_window #bar_border_color').val();
                                   var background_color = jQuery('#TB_window #background_color').val();
                                   var border_radius = jQuery('#TB_window #border_radius').val();
								   var percent = jQuery('#TB_window #percent').val();
								   var show_percent_mark = jQuery('#TB_window #show_percent_mark option:selected').val();
                                   var percentage_text_size = jQuery('#TB_window #percentage_text_size').val();
                                   var percent_color = jQuery('#TB_window #percent_color').val();
                                   var text = jQuery('#TB_window #text').val();
                                   var shortcode = "[progress_bar_vertical title='"+title+"' title_color='"+title_color+"' title_tag='"+title_tag+"' title_size='"+title_size+"' percent='"+percent+"' show_percent_mark='"+show_percent_mark+"' percentage_text_size='"+percentage_text_size+"' percent_color='"+percent_color+"' bar_color='"+bar_color+"' bar_border_color='"+bar_border_color+"' background_color='"+background_color+"' border_radius='"+border_radius+"' text='"+text+"']";
                                   jQuery("#qode_shortcode_form_wrapper").remove();
                                   ed.execCommand('mceInsertContent', false, shortcode);
                                   tb_remove();
                                   return false;
                               });
                            });
                            jQuery("#qode_shortcodes_menu_holder").remove();
                        });

						jQuery("#SC_qode_carousel").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_qode_carousel.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
                               colorPicker();
							   tb_show( 'Select Carousel Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								   var carousel = jQuery('#TB_window #carousel').val();
								   var order_by = jQuery('#TB_window #order_by option:selected').val();
								   var order = jQuery('#TB_window #order option:selected').val();
								   var control_style = jQuery('#TB_window #control_style option:selected').val();
								   var show_navigation = jQuery('#TB_window #show_navigation option:selected').val();
								   var show_in_two_rows = jQuery('#TB_window #show_in_two_rows option:selected').val();
								   var shortcode = "[qode_carousel carousel='"+carousel+"' order_by='"+order_by+"' order='"+order+"' control_style='"+control_style+"' show_in_two_rows='"+show_in_two_rows+"' show_navigation='"+show_navigation+"']";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);
								   tb_remove();
								   return false;
					    		});
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_icon").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_icons.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
                               colorPicker();
							   tb_show( 'Icon Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								   var fa_size = jQuery('#TB_window #fa_size option:selected').val();
								   var custom_size = jQuery('#TB_window #custom_size').val();
								   var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
								   var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
								   var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
								   var type = jQuery('#TB_window #type option:selected').val();
								   var position = jQuery('#TB_window #position option:selected').val();
								   var border_color = jQuery('#TB_window #border_color').val();
								   var icon_color = jQuery('#TB_window #icon_color').val();
                                   var background_color = jQuery('#TB_window #background_color').val();
                                   var margin = jQuery('#TB_window #margin').val();
                                   var icon_animation = jQuery('#TB_window #icon_animation option:selected').val();
                                   var icon_animation_delay = jQuery('#TB_window #icon_animation_delay').val();
                                   var link = jQuery('#TB_window #link').val();
                                   var target = jQuery('#TB_window #target option:selected').val();
								   var shortcode = "[icons fa_size='"+fa_size+"' custom_size='"+custom_size+"' icon_pack='"+icon_pack+"' fa_icon='"+fa_icon+"' fe_icon='"+fe_icon+"' type='"+type+"' position='"+position+"' border_color='"+border_color+"' icon_color='"+icon_color+"' background_color='"+background_color+"' margin='"+margin+"' icon_animation='"+icon_animation+"' icon_animation_delay='"+icon_animation_delay+"' link='"+link+"' target='"+target+"']";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);
								   tb_remove();
								   return false;
					    		});
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

                        jQuery("#SC_icon_text").click(function() {
                            jQuery("#qode_shortcode_form_wrapper").remove();
                            jQuery.get(url + "/qode_shortcodes_icons_text.php", function(data) {
                                var form = jQuery(data);
                                form.appendTo('body').hide();
                                colorPicker();
                                tb_show('Icon Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper');
                                jQuery('#TB_window #qode_insert_shortcode_button').click(function() {
                                    var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
								    var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
								    var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
                                    var icon_size = jQuery('#TB_window #icon_size option:selected').val();                                    
                                    var icon_margin = jQuery('#TB_window #icon_margin').val();
                                    var icon_animation = jQuery('#TB_window #icon_animation option:selected').val();
                                    var icon_animation_delay = jQuery('#TB_window #icon_animation_delay').val();
                                    var icon_type = jQuery('#TB_window #icon_type option:selected').val();
                                    var icon_position = jQuery('#TB_window #icon_position option:selected').val();
                                    var icon_margin = jQuery('#TB_window #icon_margin').val();
                                    var icon_border_color = jQuery('#TB_window #icon_border_color').val();
                                    var icon_color = jQuery('#TB_window #icon_color').val();
                                    var icon_background_color = jQuery('#TB_window #icon_background_color').val();

                                    var box_type = jQuery('#TB_window #box_type').val();
									var box_border = jQuery('#TB_window #box_border option:selected').val();
                                    var box_border_color = jQuery('#TB_window #box_border_color').val();
                                    var box_background_color = jQuery('#TB_window #box_background_color').val();

                                    var title = jQuery('#TB_window #title').val();
                                    var title_tag = jQuery('#TB_window #title_tag option:selected').val();
                                    var title_color = jQuery('#TB_window #title_color').val();
                                    var text = jQuery('#TB_window #text').val();
                                    var text_color = jQuery('#TB_window #text_color').val();

                                    var link = jQuery('#TB_window #link').val();
                                    var link_color = jQuery('#TB_window #link_color').val();
                                    var target = jQuery('#TB_window #target option:selected').val();									

                                    var shortcode = "[icon_text box_type='"+box_type+"' box_border='"+box_border+"' icon_pack='"+icon_pack+"' fa_icon='"+fa_icon+"'  fe_icon='"+fe_icon+"' box_border_color='"+icon_border_color+"' box_background_color='"+icon_background_color+"' icon_type='"+icon_type+"' icon_size='"+icon_size+"' icon_margin='"+icon_margin+"' icon_animation='"+icon_animation+"' icon_animation_delay='"+icon_animation_delay+"' icon_position='"+icon_position+"' icon_margin='"+icon_margin+"' icon_border_color='"+icon_border_color+"' icon_color='"+icon_color+"'  icon_background_color='"+icon_background_color+"'  title='"+title+"' title_tag='"+title_tag+"' title_color='"+title_color+"' text='"+text+"' text_color='"+text_color+"' link_text='"+link+"' link_color='"+link_color+"' target='"+target+"']";
                                    jQuery("#qode_shortcode_form_wrapper").remove()
                                    ed.execCommand('mceInsertContent', false, shortcode);
                                    tb_remove();
                                    return false;
                                });
                            });
                            jQuery("#qode_shortcodes_menu_holder").remove();
                        });

						jQuery("#SC_icon_progress").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_progress_bar_icon.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
							   colorPicker();
							   tb_show( 'Icon Progress Bar Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								   var icons_number = jQuery('#TB_window #icons_number').val();
								   var active_number = jQuery('#TB_window #active_number').val();
								   var type = jQuery('#TB_window #type option:selected').val();
								   var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
								   var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
								   var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
								   var size = jQuery('#TB_window #size option:selected').val();
								   var icon_color = jQuery('#TB_window #icon_color').val();
								   var icon_active_color = jQuery('#TB_window #icon_active_color').val();
								   var background_color = jQuery('#TB_window #background_color').val();
								   var background_active_color = jQuery('#TB_window #background_active_color').val();
								   var border_color = jQuery('#TB_window #border_color').val();
								   var border_active_color = jQuery('#TB_window #border_active_color').val();
								   var shortcode = "[progress_bar_icon icons_number='"+icons_number+"' active_number='"+active_number+"' type='"+type+"' icon_pack='"+icon_pack+"' fa_icon='"+fa_icon+"' fe_icon='"+fe_icon+"' size='"+size+"' icon_color='"+icon_color+"' icon_active_color='"+icon_active_color+"' background_color='"+background_color+"' background_active_color='"+background_active_color+"' border_color='"+border_color+"' border_active_color='"+border_active_color+"']";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);
								   tb_remove();
								   return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_latest_post").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_latest_post.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
							   tb_show( 'Latest Posts Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								   var type = jQuery('#TB_window #type option:selected').val();
								   var number_of_posts = jQuery('#TB_window #number_of_posts').val();
								   var number_of_columns = jQuery('#TB_window #number_of_columns option:selected').val();
								   var number_of_rows = jQuery('#TB_window #number_of_rows option:selected').val();
								   var order_by = jQuery('#TB_window #order_by option:selected').val();
								   var order = jQuery('#TB_window #order option:selected').val();
								   var category = jQuery('#TB_window #category').val();
								   var text_length = jQuery('#TB_window #text_length').val();
                                   var title_tag = jQuery('#TB_window #title_tag option:selected').val();
								   var display_category = jQuery('#TB_window #display_category option:selected').val();
								   var display_date = jQuery('#TB_window #display_date option:selected').val();
								   var display_author = jQuery('#TB_window #display_author option:selected').val();
								   var shortcode = "[latest_post type='"+type+"' number_of_posts='"+number_of_posts+"' number_of_columns='"+number_of_columns+"' number_of_rows='"+number_of_rows+"' order_by='"+order_by+"' order='"+order+"' category='"+category+"' text_length='"+text_length+"' title_tag='"+title_tag+"' display_category='"+display_category+"' display_date='"+display_date+"' display_author='"+display_author+"']";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								   return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

                        jQuery("#SC_line_graph").click(function() {
                            jQuery("#qode_shortcode_form_wrapper").remove();
                            jQuery.get(url + "/qode_shortcodes_line_graph.php", function(data) {
                                var form = jQuery(data);
                                form.appendTo('body').hide();
                                colorPicker();
                                tb_show('Line Graph Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper');
                                jQuery('#TB_window #qode_insert_shortcode_button').click(function() {
                                    var type = jQuery('#TB_window #type option:selected').val();
                                    var custom_color = jQuery('#TB_window #custom_color').val();
                                    if (jQuery('#TB_window #width').val() != "") {
                                        var width = "width='" + jQuery('#TB_window #width').val() + "'";
                                    } else {
                                        var width = "";
                                    }
                                    if (jQuery('#TB_window #height').val() != "") {
                                        var height = "height='" + jQuery('#TB_window #height').val() + "'";
                                    } else {
                                        var height = "";
                                    }
                                    if (jQuery('#TB_window #scalesteps').val() != "") {
                                        var scalesteps = "scalesteps='" + jQuery('#TB_window #scalesteps').val() + "'";
                                    } else {
                                        var scalesteps = "";
                                    }
                                    if (jQuery('#TB_window #scalestepwidth').val() != "") {
                                        var scalestepwidth = "scalestepwidth='" + jQuery('#TB_window #scalestepwidth').val() + "'";
                                    } else {
                                        var scaleStepWidth = "";
                                    }
                                    var shortcode = "[line_graph " + width + " " + height + " " + scalesteps + " " + scalestepwidth + " custom_color='" + custom_color + "' type='" + type + "' labels='Label 1, Label 2, Label 3']#1abc9c,Legend One,1,5,10;#5ed0ba,Legend Two,3,7,20;#8cddcd,Legend Three,10,2,34[/line_graph]";
                                    jQuery("#qode_shortcode_form_wrapper").remove()
                                    ed.execCommand('mceInsertContent', false, shortcode);
                                    tb_remove();
                                    return false;
                                });
                            });
                            jQuery("#qode_shortcodes_menu_holder").remove();
                        })

						jQuery("#SC_message").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_message.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
								colorPicker();
							    tb_show( 'Message Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var type = jQuery('#TB_window #type option:selected').val();
									var background_color = jQuery('#TB_window #background_color').val();
                                    var border_color = jQuery('#TB_window #border_color').val();
									var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
									var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
									var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
									var icon_size = jQuery('#TB_window #icon_size option:selected').val();
									var icon_color = jQuery('#TB_window #icon_color').val();
									var icon_background_color = jQuery('#TB_window #icon_background_color').val();
									var custom_icon = jQuery('#TB_window #custom_icon').val();
									var close_button_color = jQuery('#TB_window #close_button_color').val();
								    var shortcode = "[message type='"+type+"' icon_pack='"+icon_pack+"' icon_color='"+icon_color+"' icon_size='"+icon_size+"' icon_background_color='"+icon_background_color+"' custom_icon='"+custom_icon+"' background_color='"+background_color+"' border_color='"+border_color+"' close_button_color='"+close_button_color+"']<h4>Message Title</h4>[/message]";
								    jQuery("#qode_shortcode_form_wrapper").remove()
								    ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								    return false;
							    });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_pie_chart").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_pie_chart.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
                               colorPicker();
							   tb_show( 'Pie Chart Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var percentage = jQuery('#TB_window #percentage').val();
									var show_percent_mark = jQuery('#TB_window #show_percent_mark option:selected').val();
                                    var percentage_color = jQuery('#TB_window #percentage_color').val();
								    var percentage_font_size = jQuery('#TB_window #percentage_font_size').val();
								    var percentage_font_weight = jQuery('#TB_window #percentage_font_weight').val();
                                    var active_color = jQuery('#TB_window #active_color').val();
                                    var noactive_color = jQuery('#TB_window #noactive_color').val();
                                    var line_width = jQuery('#TB_window #line_width').val();
									var title = jQuery('#TB_window #title').val();
									var title_color = jQuery('#TB_window #title_color').val();
                                    var title_tag = jQuery('#TB_window #title_tag option:selected').val();
									var text = jQuery('#TB_window #text').val();
									var text_color = jQuery('#TB_window #text_color').val();
								    var shortcode = "[pie_chart percent='"+percentage+"' show_percent_mark='"+show_percent_mark+"' percentage_color='"+percentage_color+"' percentage_font_size='"+percentage_font_size+"' percentage_font_weight='"+percentage_font_weight+"' active_color='"+active_color+"' noactive_color='"+noactive_color+"' line_width='"+line_width+"' title='"+title+"' title_color='"+title_color+"' title_tag='"+title_tag+"' text='"+text+"' text_color='"+text_color+"']";
								    jQuery("#qode_shortcode_form_wrapper").remove()
								    ed.execCommand('mceInsertContent', false, shortcode);
								    tb_remove();
								    return false;
							   });
							});
						})

						jQuery("#SC_pie_chart_with_icon").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_pie_chart_with_icon.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
                                colorPicker();
							    tb_show( 'Pie Chart With Icon Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var percentage = jQuery('#TB_window #percentage').val();
                                    var active_color = jQuery('#TB_window #active_color').val();
                                    var noactive_color = jQuery('#TB_window #noactive_color').val();
                                    var line_width = jQuery('#TB_window #line_width').val();
                                    var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
									var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
									var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
                                    var icon_size = jQuery('#TB_window #icon_size option:selected').val();
									var icon_color = jQuery('#TB_window #icon_color').val();
									var title = jQuery('#TB_window #title').val();
									var title_color = jQuery('#TB_window #title_color').val();
                                    var title_tag = jQuery('#TB_window #title_tag option:selected').val();
									var text = jQuery('#TB_window #text').val();
									var text_color = jQuery('#TB_window #text_color').val();
								    var shortcode = "[pie_chart_with_icon percent='"+percentage+"' active_color='"+active_color+"' noactive_color='"+noactive_color+"' line_width='"+line_width+"' icon_pack='"+icon_pack+"' fa_icon='"+fa_icon+"' fe_icon='"+fe_icon+"' icon_size='"+icon_size+"' icon_color='"+icon_color+"' title='"+title+"' title_color='"+title_color+"' title_tag='"+title_tag+"' text='"+text+"' text_color='"+text_color+"']";
								    jQuery("#qode_shortcode_form_wrapper").remove()
								    ed.execCommand('mceInsertContent', false, shortcode);
								    tb_remove();
								    return false;
							    });
							});
						})

						jQuery("#SC_pie_chart2").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_pie_chart2.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
                               colorPicker();
							   tb_show( 'Pie Chart 2 Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									 if(jQuery('#TB_window #width').val() != ""){
										var width = "width='"+jQuery('#TB_window #width').val()+"'";
									 }else{ var width = ""; }
									 if(jQuery('#TB_window #height').val() != ""){
										var height = "height='"+jQuery('#TB_window #height').val()+"'";
									 }else{ var height = ""; }
									 var color = jQuery('#TB_window #color').val();
									 var shortcode = "[pie_chart2 "+width+" "+height+" color='"+color+"']15,#1abc9c,Legend One; 35,#5ed0ba,Legend Two; 50,#8cddcd,Legend Three[/pie_chart2]";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								   return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_pie_chart3").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_pie_chart3.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
                               colorPicker();
							   tb_show( 'Pie Chart 3 Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									 if(jQuery('#TB_window #width').val() != ""){
										var width = "width='"+jQuery('#TB_window #width').val()+"'";
									 }else{ var width = ""; }
									 if(jQuery('#TB_window #height').val() != ""){
										var height = "height='"+jQuery('#TB_window #height').val()+"'";
									 }else{ var height = ""; }
									 var color = jQuery('#TB_window #color').val();
									 var shortcode = "[pie_chart3 "+width+" "+height+" color='"+color+"']15,#1abc9c,Legend One; 35,#5ed0ba,Legend Two; 50,#8cddcd,Legend Three[/pie_chart3]";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								   return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_portfolio_list").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_portfolio_list.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								colorPicker();
							   tb_show( 'Portfolio List Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var filter = jQuery('#TB_window #filter option:selected').val();
									var filter_order_by = jQuery('#TB_window #filter_order_by option:selected').val();
									var disable_filter_title = jQuery('#TB_window #disable_filter_title option:selected').val();
									var filter_align = jQuery('#TB_window #filter_align option:selected').val();
									var disable_link = jQuery('#TB_window #disable_link option:selected').val();
									var lightbox = jQuery('#TB_window #lightbox option:selected').val();
									var show_like = jQuery('#TB_window #show_like option:selected').val();
									var type = jQuery('#TB_window #type option:selected').val();
									var hover_type = jQuery('#TB_window #hover_type option:selected').val();
									var box_background_color = jQuery('#TB_window #box_background_color').val();
									var box_border = jQuery('#TB_window #box_border').val();
									var box_border_width = jQuery('#TB_window #box_border_width').val();
									var box_border_color = jQuery('#TB_window #box_border_color').val();
									var columns = jQuery('#TB_window #columns option:selected').val();
									var image_size = jQuery('#TB_window #image_size option:selected').val();
									var order_by = jQuery('#TB_window #order_by option:selected').val();
									var order = jQuery('#TB_window #order option:selected').val();
									var number = jQuery('#TB_window #number').val();
									var category = jQuery('#TB_window #category').val();
									var selected_projects = jQuery('#TB_window #selected_projects').val();
									var show_load_more = jQuery('#TB_window #show_load_more option:selected').val();
                                    var title_tag = jQuery('#TB_window #title_tag option:selected').val();
                                    var title_font_size = jQuery('#TB_window #title_font_size').val();
									var shortcode = "[portfolio_list type='"+type+"' hover_type='"+hover_type+"' box_background_color='"+box_background_color+"' box_border='"+box_border+"' box_border_width='"+box_border_width+"' box_border_color='"+box_border_color+"' columns='"+columns+"' image_size='"+image_size+"' order_by='"+order_by+"' order='"+order+"' number='"+number+"' category='"+category+"' selected_projects='"+selected_projects+"' filter='"+filter+"' filter_order_by='"+filter_order_by+"' disable_filter_title='"+disable_filter_title+"' filter_align='"+filter_align+"' lightbox='"+lightbox+"' disable_link='"+disable_link+"' show_like='"+show_like+"' show_load_more='" + show_load_more +"' title_tag='"+title_tag+"' title_font_size='"+title_font_size+"']";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_portfolio_slider").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_portfolio_slider.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								colorPicker();
							   tb_show( 'Portfolio Slider Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var disable_link = jQuery('#TB_window #disable_link option:selected').val();
									var lightbox = jQuery('#TB_window #lightbox option:selected').val();
									var show_like = jQuery('#TB_window #show_like option:selected').val();
									var order_by = jQuery('#TB_window #order_by option:selected').val();
									var order = jQuery('#TB_window #order option:selected').val();
									var number = jQuery('#TB_window #number').val();
									var category = jQuery('#TB_window #category').val();
									var selected_projects = jQuery('#TB_window #selected_projects').val();
                                    var title_tag = jQuery('#TB_window #title_tag option:selected').val();
								    var text_align = jQuery('#TB_window #text_align option:selected').val();
                                    var image_size = jQuery('#TB_window #image_size option:selected').val();
									var shortcode = "[portfolio_slider order_by='"+order_by+"' order='"+order+"' number='"+number+"' category='"+category+"' selected_projects='"+selected_projects+"' lightbox='"+lightbox+"' disable_link='"+disable_link+"' show_like='"+show_like+"' title_tag='"+title_tag+"' text_align='"+text_align+"' image_size='"+image_size+"']";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_separator").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_separator.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Separator Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
                                    var type = jQuery('#TB_window #type option:selected').val();
                                    var position = jQuery('#TB_window #position option:selected').val();
                                    var color = jQuery('#TB_window #color').val();
									var border_style = jQuery('#TB_window #border_style option:selected').val();
									var thickness = jQuery('#TB_window #thickness').val();
									var width = jQuery('#TB_window #width').val();
									var top = jQuery('#TB_window #top').val();
									var bottom = jQuery('#TB_window #bottom').val();
									var shortcode = "[vc_separator type='"+type+"' position='"+position+"' color='"+color+"' border_style='"+border_style+"' thickness='"+thickness+"'  up='"+top+"' down='"+bottom+"']";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_social_icons").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_social_icon.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
							   colorPicker();
							   tb_show( 'Social Icon Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
							   		var type = jQuery('#TB_window #type option:selected').val();
							   		var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
									var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
									var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
									var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
							   		var size = jQuery('#TB_window #size option:selected').val();
							   		var link = jQuery('#TB_window #link').val();
							   		var target = jQuery('#TB_window #target option:selected').val();
							   		var icon_color = jQuery('#TB_window #icon_color').val();
							   		var background_color = jQuery('#TB_window #background_color').val();
							   		var border_color = jQuery('#TB_window #border_color').val();
							   		var icon_hover_color = jQuery('#TB_window #icon_hover_color').val();
							   		var background_hover_color = jQuery('#TB_window #background_hover_color').val();
							   		var border_hover_color = jQuery('#TB_window #border_hover_color').val();
								    var shortcode = "[social_icons type='"+type+"' icon_pack='"+icon_pack+"' size='"+size+"' link='"+link+"' target='"+target+"' icon_color='"+icon_color+"' 'background_color='"+background_color+"' border_color='"+border_color+"' icon_hover_color='"+icon_hover_color+"' background_hover_color='"+background_hover_color+"' border_hover_color='"+border_hover_color+"' /]";
									jQuery("#qode_shortcode_form_wrapper").remove()
								    ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								    return false;
							   });
							});
						})

						jQuery("#SC_testimonials").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_testimonials.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
							   colorPicker();
							   tb_show( 'Testimonial Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
                                    var category = jQuery('#TB_window #category').val();
                                    var number = jQuery('#TB_window #number').val();
							   		var text_color = jQuery('#TB_window #text_color').val();
							   		var author_text_color = jQuery('#TB_window #author_text_color').val();
							   		var text_align = jQuery('#TB_window #text_align option:selected').val();
									var text_font_size = jQuery('#TB_window #text_font_size').val();
							   		var show_navigation = jQuery('#TB_window #show_navigation option:selected').val();
							   		var navigation_style = jQuery('#TB_window #navigation_style option:selected').val();
							   		var auto_rotate_slides = jQuery('#TB_window #auto_rotate_slides').val();
							   		var animation_type = jQuery('#TB_window #animation_type option:selected').val();
								    var shortcode = "[testimonials category='"+category+"' number='"+number+"' text_color='"+text_color+"' text_font_size='"+text_font_size+"' author_text_color='"+author_text_color+"' text_align='"+text_align+"' show_navigation='"+show_navigation+"' navigation_style='"+navigation_style+"' auto_rotate_slides='"+auto_rotate_slides+"' animation_type='"+animation_type+"']";
						    		jQuery("#qode_shortcode_form_wrapper").remove()
								    ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								    return false;
							   });
							});
						})

						jQuery("#SC_unordered_list").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_unordered_list.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
							   tb_show( 'Unordered Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								   var style = jQuery('#TB_window #style option:selected').val();
								   var number_type = jQuery('#TB_window #number_type').val();
								   var animate = jQuery('#TB_window #animate option:selected').val();
                                   var font_weight = jQuery('#TB_window #font_weight option:selected').val();
								   var shortcode = "[unordered_list style='" + style + "' number_type='"+number_type+"' animate='"+animate+"' font_weight='"+font_weight+"']<ul><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li></ul>[/unordered_list]";
								   jQuery("#qode_shortcode_form_wrapper").remove()
								   ed.execCommand('mceInsertContent', false, shortcode);
								   tb_remove();
								   return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_video").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_video.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
							   tb_show( 'Video Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								    var video_link = jQuery('#TB_window #video_link').val();
								    var shortcode = "[vc_video link='"+video_link+"']";
								    jQuery("#qode_shortcode_form_wrapper").remove()
								    ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
								    return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_row").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_row.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
								colorPicker();
							    tb_show( 'Row Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var css_animation = jQuery('#TB_window #css_animation option:selected').val();
									var text_align = jQuery('#TB_window #text_align option:selected').val();
									var shortcode = "[vc_row row_type='row' text_align='"+text_align+"' css_animation='"+css_animation+"'][vc_column width='1/1']<p>Enter content here</p>[/vc_column][/vc_row]";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_section").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_section.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Section Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var type = jQuery('#TB_window #type option:selected').val();
									var text_align = jQuery('#TB_window #text_align option:selected').val();
									var row_type = jQuery('#TB_window #row_type option:selected').val();
									var video = jQuery('#TB_window #video').val();
									var video_overlay = jQuery('#TB_window #video_overlay').val();
									var video_webm = jQuery('#TB_window #video_webm').val();
									var video_mp4 = jQuery('#TB_window #video_mp4').val();
									var video_ogv = jQuery('#TB_window #video_ogv').val();
									var video_image = jQuery('#TB_window #video_image').val();
									var background_color = jQuery('#TB_window #background_color').val();
									var border_color = jQuery('#TB_window #border_color').val();
									var padding = jQuery('#TB_window #padding').val();
									var padding_top_bottom = jQuery('#TB_window #padding_top_bottom').val();
									var shortcode = "[vc_row row_type='section' type='"+type+"' text_align='"+text_align+"' video='"+video+"' video_overlay='"+video_overlay+"' video_webm='"+video_webm+"' video_mp4='"+video_mp4+"' video_ogv='"+video_ogv+"' video_image='"+video_image+"' background_color='"+background_color+"' border_color='"+border_color+"' padding='"+padding+"' padding_top_bottom='"+padding_top_bottom+"'][vc_column width='1/1'] <p>Enter content here</p> [/vc_column][/vc_row]";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						});

						jQuery("#SC_expandable").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_expandable.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Expandable Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var text_align = jQuery('#TB_window #text_align option:selected').val();
									var background_color = jQuery('#TB_window #background_color').val();
									var border_color = jQuery('#TB_window #border_color').val();
									var more_button_label = jQuery('#TB_window #more_button_label').val();
									var less_button_label = jQuery('#TB_window #less_button_label').val();
									var button_position = jQuery('#TB_window #button_position option:selected').val();
									var color = jQuery('#TB_window #color').val();
									var shortcode = "[vc_row row_type='expandable' text_align='"+text_align+"' background_color='"+background_color+"' border_color='"+border_color+"' more_button_label='"+more_button_label+"' less_button_label='"+less_button_label+"' button_position='"+button_position+"' color='"+color+"'][vc_column width='1/1']<p>Enter content here</p>[/vc_column][/vc_row]";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_image_with_text").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_image_with_text.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Image With Text Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var image = jQuery('#TB_window #image').val();
									var title = jQuery('#TB_window #title').val();
									var title_color = jQuery('#TB_window #title_color').val();
                                    var title_tag = jQuery('#TB_window #title_tag option:selected').val();
									var shortcode = "[image_with_text image='"+image+"' title='"+title+"' title_color='"+title_color+"' title_tag='"+title_tag+"']<p>Enter text here</p>[/image_with_text]";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_interactive_banners").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_interactive_banners.php", function(data){
							    var form = jQuery(data);
							    form.appendTo('body').hide();
								colorPicker();
							    tb_show( 'Interactive Banners Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							    jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
							   		var layout_width = jQuery('#TB_window #layout_width option:selected').val();
									var image = jQuery('#TB_window #image').val();
									var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
									var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
									var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
									var icon_custom_size =  jQuery('#TB_window #icon_custom_size').val();
									var icon_color = jQuery('#TB_window #icon_color').val();
									var title = jQuery('#TB_window #title').val();
									var title_color = jQuery('#TB_window #title_color').val();
                                    var title_size = jQuery('#TB_window #title_size').val();
                                    var title_tag = jQuery('#TB_window #title_tag option:selected').val();
                                    var subtitle = jQuery('#TB_window #subtitle').val();
									var subtitle_color = jQuery('#TB_window #subtitle_color').val();
                                    var subtitle_size = jQuery('#TB_window #subtitle_size').val();
                                    var subtitle_tag = jQuery('#TB_window #subtitle_tag option:selected').val();
									var shortcode = "[interactive_banners layout_width='"+layout_width+"' image='"+image+"' icon_pack='"+icon_pack+"' fa_icon='"+fa_icon+"' fe_icon='"+fe_icon+"' icon_custom_size='"+icon_custom_size+"' icon_color='"+icon_color+"' title='"+title+"' title_color='"+title_color+"' title_size='"+title_size+"' title_tag='"+title_tag+"' subtitle='"+subtitle+"' subtitle_color='"+subtitle_color+"' subtitle_size='"+subtitle_size+"' subtitle_tag='"+subtitle_tag+"']<p>Enter text here</p>[/interactive_banners]";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

                        jQuery("#SC_image_hover").click(function() {
                            jQuery("#qode_shortcode_form_wrapper").remove();
                            jQuery.get(url + "/qode_shortcodes_image_hover.php", function(data) {
                                var form = jQuery(data);
                                form.appendTo('body').hide();
                                colorPicker();
                                tb_show('Image Hover Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper');
                                jQuery('#TB_window #qode_insert_shortcode_button').click(function() {
                                    var image = jQuery('#TB_window #image').val();
                                    var hover_image = jQuery('#TB_window #hover_image').val();
                                    var link = jQuery('#TB_window #link').val();
                                    var target = jQuery('#TB_window #target option:selected').val();
                                    var animation = jQuery('#TB_window #animation option:selected').val();
                                    var animation_speed = jQuery('#TB_window #animation_speed').val();
                                    var transition_delay = jQuery('#TB_window #transition_delay').val();;

                                    var shortcode = "[image_hover image='" + image + "' hover_image='" + hover_image + "' link='"+link+"' target='"+target+"' animation='"+animation+"' animation_speed='"+animation_speed+"' transition_delay='"+transition_delay+"']";
                                    jQuery("#qode_shortcode_form_wrapper").remove()
                                    ed.execCommand('mceInsertContent', false, shortcode);
                                    tb_remove();
                                    return false;
                                });
                            });
                            jQuery("#qode_shortcodes_menu_holder").remove();
                        });

						jQuery("#SC_icon_list_item").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_icon_list_item.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Icon List Item Shosrtcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var icon_pack = jQuery('#TB_window #icon_pack option:selected').val();
									var fa_icon = jQuery('#TB_window #fa_icon option:selected').val();
									var fe_icon = jQuery('#TB_window #fe_icon option:selected').val();
									var icon_type = jQuery('#TB_window #icon_type option:selected').val();
									var icon_color = jQuery('#TB_window #icon_color').val();
									var border_type = jQuery('#TB_window #border_type option:selected').val();
									var border_color = jQuery('#TB_window #border_color').val();
									var title = jQuery('#TB_window #title').val();
									var title_color = jQuery('#TB_window #title_color').val();
									var title_size = jQuery('#TB_window #title_size').val();
									var shortcode = "[icon_list_item icon_pack='"+icon_pack+"' fa_icon='"+fa_icon+"' fe_icon='"+fe_icon+"' icon_type='"+icon_type+"' icon_color='"+icon_color+"' border_type='"+border_type+"' border_color='"+border_color+"' title='"+title+"' title_color='"+title_color+"' title_size='"+title_size+"']";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_highlights").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_highlights.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Highlight Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var color = jQuery('#TB_window #color').val();
									var background_color = jQuery('#TB_window #background_color').val();
									var shortcode = "[highlight color='"+color+"' background_color='"+background_color+"']enter text here[/highlight]";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_tabs").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_tabs.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Tabs Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var style = jQuery('#TB_window #style option:selected').val();
									var shortcode = "[vc_tabs style='"+style+"'][vc_tab title='Tab 1' tab_id='001'][/vc_tab][vc_tab title='Tab 2' tab_id='002'][/vc_tab][/vc_tabs]";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})
						
						
							jQuery("#SC_team").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_team.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Team Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var team_image = jQuery('#TB_window #team_image').val();
									var team_image_hover_color = jQuery('#TB_window #team_image_hover_color').val();
									var team_name = jQuery('#TB_window #team_name').val();
									var team_name_tag = jQuery('#TB_window #team_name_tag option:selected').val();
									var team_name_font_size = jQuery('#TB_window #team_name_font_size').val();
									var team_name_font_weight = jQuery('#TB_window #team_name_font_weight option:selected').val();
									var team_name_text_transform = jQuery('#TB_window #team_name_text_transform option:selected').val();
									var team_position = jQuery('#TB_window #team_position').val();
									var team_position_font_size = jQuery('#TB_window #team_position_font_size ').val();
									var team_position_color = jQuery('#TB_window #team_position_color').val();
									var team_position_font_weight = jQuery('#TB_window #team_position_font_weight option:selected').val();
									var team_position_text_transform = jQuery('#TB_window #team_position_text_transform option:selected').val();
									var team_description = jQuery('#TB_window #team_description').val();
									var team_description_color = jQuery('#TB_window #team_description_color').val();
									var text_align = jQuery('#TB_window #text_align option:selected').val();
									var background_color = jQuery('#TB_window #background_color').val();
								    var box_border = jQuery('#TB_window #box_border').val();
								    var team_social_icon_pack = jQuery('#TB_window #team_social_icon_pack option:selected').val();
								    var team_social_fa_icon_1 = jQuery('#TB_window #team_social_fa_icon_1').val();
								    var team_social_fe_icon_1 = jQuery('#TB_window #team_social_fe_icon_1').val();
									var team_social_icon_1_link = jQuery('#TB_window #team_social_icon_1_link').val();
									var team_social_icon_1_target = jQuery('#TB_window #team_social_icon_1_target option:selected').val();
									var team_social_fa_icon_2 = jQuery('#TB_window #team_social_fa_icon_2').val();
									var team_social_fe_icon_2 = jQuery('#TB_window #team_social_fe_icon_2').val();
									var team_social_icon_2_link = jQuery('#TB_window #team_social_icon_2_link').val();
									var team_social_icon_2_target = jQuery('#TB_window #team_social_icon_2_target option:selected').val();
									var team_social_fa_icon_3 = jQuery('#TB_window #team_social_fa_icon_3').val();
									var team_social_fe_icon_3 = jQuery('#TB_window #team_social_fe_icon_3').val();
									var team_social_icon_3_link = jQuery('#TB_window #team_social_icon_3_link').val();
									var team_social_icon_3_target = jQuery('#TB_window #team_social_icon_3_target option:selected').val();
									var team_social_fa_icon_4 = jQuery('#TB_window #team_social_fa_icon_4').val();
									var team_social_fe_icon_4 = jQuery('#TB_window #team_social_fe_icon_4').val();
									var team_social_icon_4_link = jQuery('#TB_window #team_social_icon_4_link').val();
									var team_social_icon_4_target = jQuery('#TB_window #team_social_icon_4_target option:selected').val();
									var team_social_fa_icon_5 = jQuery('#TB_window #team_social_fa_icon_5').val();
									var team_social_fe_icon_5 = jQuery('#TB_window #team_social_fe_icon_5').val();
									var team_social_icon_5_link = jQuery('#TB_window #team_social_icon_5_link').val();
									var team_social_icon_5_target = jQuery('#TB_window #team_social_icon_5_target option:selected').val();
									var show_skills = jQuery('#TB_window #show_skills option:selected').val();
									var skills_title_size = jQuery('#TB_window #skills_title_size').val();
									var skill_title_1 = jQuery('#TB_window #skill_title_1').val();
									var skill_percentage_1 = jQuery('#TB_window #skill_percentage_1').val();
									var skill_title_2 = jQuery('#TB_window #skill_title_2').val();
									var skill_percentage_2 = jQuery('#TB_window #skill_percentage_2').val();
									var skill_title_3 = jQuery('#TB_window #skill_title_3').val();
									var skill_percentage_3 = jQuery('#TB_window #skill_percentage_3').val(); 
									var shortcode = "[q_team team_image='"+team_image+"' team_image_hover_color='"+team_image_hover_color+"' team_name='"+team_name+"' team_name_tag='"+team_name_tag+"' team_name_font_size='"+team_name_font_size+"' team_name_font_weight='"+team_name_font_weight+"' team_name_text_transform='"+team_name_text_transform+"' team_position='"+team_position+"' team_position_font_size='"+team_position_font_size+"' team_position_color='"+team_position_color+"' team_position_font_weight='"+team_position_font_weight+"' team_position_text_transform='"+team_position_text_transform+"' text_align='"+text_align+"' team_description='"+team_description+"' team_description_color='"+team_description_color+"' background_color ='"+background_color +"' box_border ='"+box_border +"' team_social_icon_pack ='"+team_social_icon_pack +"' team_social_fa_icon_1 ='"+team_social_fa_icon_1 +"' team_social_fa_icon_2 ='"+team_social_fa_icon_2 +"'  team_social_fa_icon_3 ='"+team_social_fa_icon_3 +"' team_social_fa_icon_4 ='"+team_social_fa_icon_4 +"' team_social_fa_icon_5 ='"+team_social_fa_icon_5 +"' team_social_fe_icon_1 ='"+team_social_fe_icon_1 +"'  team_social_fe_icon_2 ='"+team_social_fe_icon_2 +"'  team_social_fe_icon_3 ='"+team_social_fe_icon_3 +"'  team_social_fe_icon_4 ='"+team_social_fe_icon_4 +"'  team_social_fe_icon_5 ='"+team_social_fe_icon_5 +"' team_social_icon_1_link ='"+team_social_icon_1_link +"' team_social_icon_2_link ='"+team_social_icon_2_link +"' team_social_icon_3_link ='"+team_social_icon_3_link +"' team_social_icon_4_link ='"+team_social_icon_4_link +"' team_social_icon_5_link ='"+team_social_icon_5_link +"' team_social_icon_1_target ='"+team_social_icon_1_target +"' team_social_icon_3_link ='"+team_social_icon_3_link +"' team_social_icon_4_link ='"+team_social_icon_4_link +"' team_social_icon_5_link ='"+team_social_icon_5_link +"' team_social_icon_2_target ='"+team_social_icon_2_target +"' team_social_icon_3_target ='"+team_social_icon_3_target +"' team_social_icon_4_target ='"+team_social_icon_4_target +"' team_social_icon_5_target ='"+team_social_icon_5_target +"' show_skills ='"+show_skills +"' skills_title_size='"+skills_title_size+"' skill_title_1 ='"+skill_title_1 +"' skill_title_2 ='"+skill_title_2 +"' skill_title_3 ='"+skill_title_3 +"' skill_percentage_1 ='"+skill_percentage_1 +"' skill_percentage_2 ='"+skill_percentage_2 +"' skill_percentage_3 ='"+skill_percentage_3 +"']";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						})

						jQuery("#SC_separator_with_steps").click(function(){
							jQuery("#qode_shortcode_form_wrapper").remove();
							jQuery.get(url + "/qode_shortcodes_separator_with_text.php", function(data){
							   var form = jQuery(data);
							   form.appendTo('body').hide();
								 colorPicker();
							   tb_show( 'Separator With Text Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									var title = jQuery('#TB_window #title').val();
									var title_align = jQuery('#TB_window #title_align option:selected').val();
									var border = jQuery('#TB_window #border option:selected').val();
									var border_color = jQuery('#TB_window #border_color').val();
									var background_color = jQuery('#TB_window #background_color').val();
									var title_color = jQuery('#TB_window #title_color').val();
									var shortcode = "[vc_text_separator title='"+title+"' title_align='"+title_align+"' border='"+border+"' border_color='"+border_color+"' background_color='"+background_color+"' title_color='"+title_color+"']";
									jQuery("#qode_shortcode_form_wrapper").remove()
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									return false;
							   });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						});

						jQuery("#SC_animated_icons_with_text").click(function(){
						  jQuery("#qode_shortcode_form_wrapper").remove();
						  jQuery.get(url + "/qode_shortcodes_animated_icons_with_text.php", function(data){
						      var form = jQuery(data);
						      form.appendTo('body').hide();
						      colorPicker();
						      tb_show( 'Animated Icons with Text Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
						      jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
						          var columns = jQuery('#TB_window #columns option:selected').val();
						          var shortcode = "[animated_icons_with_text columns='"+columns+"'][animated_icon_with_text title_tag='' icon_pack='' fa_icon='' fe_icon='' title='' text='' size='' icon_color='' icon_background_color='' icon_color_hover='' icon_background_color_hover='' border_color_hover=''][/animated_icons_with_text]";
						          jQuery("#qode_shortcode_form_wrapper").remove();
						          ed.execCommand('mceInsertContent', false, shortcode);
						          tb_remove();
						          return false;
						      });
						  });
						  jQuery("#qode_shortcodes_menu_holder").remove();
						});

						jQuery("#SC_circles").click(function(){
						  jQuery("#qode_shortcode_form_wrapper").remove();
						  jQuery.get(url + "/qode_circles.php", function(data){
							  var form = jQuery(data);
							  form.appendTo('body').hide();
							  colorPicker();
							  tb_show( 'Circles Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
							  jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
								  var columns = jQuery('#TB_window #columns option:selected').val();
								  var line_color = jQuery('#TB_window #line_color').val();
								  var lines_between = jQuery('#TB_window #lines_between option:selected').val();
								  var shortcode = "[qode_circles columns='"+columns+"' lines_between='"+lines_between+"' line_color='"+line_color+"'][qode_circle type='' without_double_border='' icon_pack='' fe_icon='' link_target='' title_tag='' background_color='' background_transparency='' border_color='' border_width='' image='' link='' title='' title_color='' text='' text_color=''][/qode_circles]";
								  jQuery("#qode_shortcode_form_wrapper").remove();
								  ed.execCommand('mceInsertContent', false, shortcode);
								  tb_remove();
								  return false;
							  });
							});
							jQuery("#qode_shortcodes_menu_holder").remove();
						  });
						})
				}
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Shortcodes",
            author : "Select Themes",
            authorurl : "http://demo.select-themes.com",
            infourl : "http://demo.select-themes.com",
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('qode_shortcodes', tinymce.plugins.qode_shortcodes);
})();