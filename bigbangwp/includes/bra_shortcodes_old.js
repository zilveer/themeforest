(function() {

tinymce.create('tinymce.plugins.bra_shortcodes', {
      init : function(ed, url) {		 
		 
         ed.addButton('bra_shortcodes', {
            title : 'Brankic Shortcodes',
            image : url+'/bra_shortcodes.ico',
            onclick : function() {
						
						
									

						jQuery("#brankic_shortcode_form_wrapper").remove();
					
						
						var shortcodes_visible = jQuery("#bra_shortcodes_menu_holder").length;
						
						if (shortcodes_visible){
							jQuery("#bra_shortcodes_menu_holder").remove();
						}
						else{
													
							jQuery("#wp-content-editor-container").append("<div id='bra_shortcodes_menu_holder'></div>");							
//alert("d");
                       		jQuery('#bra_shortcodes_menu_holder').load(url + '/bra_shortcodes_popup.html#bra_shortodes_popup', function(){
								
//alert(jQuery("#content_bra_shortcodes").length);
								//var y = parseInt(jQuery("#content_bra_shortcodes").offset().top) - 25;	
								//alert(y);
								//var x = parseInt(jQuery("#content_bra_shortcodes").offset().left) - parseInt(jQuery("#adminmenuwrap").width()) + 10;
								//var y = 0;
								//var x = 0;
								//alert(x + " " + y);
								jQuery("#bra_shortcodes_menu_holder").css({top: 0, left: 0});
								//alert(jQuery("#content_bra_shortcodes").length);
								
								
								    
								
								
								
								//////////////////////////////////////
								// simplest shortcodes	            //
								//////////////////////////////////////
								jQuery("#Bra_graph_container").click(function(){
									var shortcode = "[bra_graph_container]delete this text and insert graph bars[/bra_graph_container]"
									ed.execCommand('mceInsertContent', false, shortcode);                            
								})
								
								jQuery("#Bra_social_icons").click(function(){
									var shortcode = "[bra_social_icons]twitter, http://twitter.com/brankic1979, facebook, https://www.facebook.com/brankic1979themes[/bra_social_icons]"
									ed.execCommand('mceInsertContent', false, shortcode);                            
								})
								
								jQuery("#Bra_1-1").click(function(){
									var shortcode = "[one]<h3>Dummy</h3> Content[/one]"
									ed.execCommand('mceInsertContent', false, shortcode);                            
								})
								
								jQuery("#Bra_1-2x1-2").click(function(){
									var shortcode = "[one_half]<h3>Dummy</h3> Content[/one_half] [one_half_last]<h3>Dummy</h3> Content[/one_half_last]"
									ed.execCommand('mceInsertContent', false, shortcode);                            
								})
								
								jQuery("#Bra_1-3x1-3x1-3").click(function(){
									var shortcode = "[one_third]<h3>Dummy</h3> Content[/one_third] [one_third]<h3>Dummy</h3> Content[/one_third] [one_third_last]<h3>Dummy</h3> Content[/one_third_last]"
									ed.execCommand('mceInsertContent', false, shortcode);                            
								})
								
								jQuery("#Bra_1-3x2-3").click(function(){
									var shortcode = "[one_third]<h3>Dummy</h3> Content[/one_third] [two_thirds_last]<h3>Dummy</h3> Content[/two_thirds_last]"
									ed.execCommand('mceInsertContent', false, shortcode);                            
								})
								
								jQuery("#Bra_2-3x1-3").click(function(){
									var shortcode = "[two_thirds]<h3>Dummy</h3> Content[/two_thirds] [one_third_last]<h3>Dummy</h3> Content[/one_third_last]"
									ed.execCommand('mceInsertContent', false, shortcode);                            
								})
								
								jQuery("#Bra_1-4x1-4x1-4x1-4").click(function(){
									var shortcode = "[one_fourth]<h3>Dummy</h3> Content[/one_fourth] [one_fourth]<h3>Dummy</h3> Content[/one_fourth] [one_fourth]<h3>Dummy</h3> Content[/one_fourth] [one_fourth_last]<h3>Dummy</h3> Content[/one_fourth_last]"
									ed.execCommand('mceInsertContent', false, shortcode);                            
								})
								
								
								////////////////////////////////
								// pop-up shortcodes          //
								////////////////////////////////
								var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
								W = W - 80;
								H = H - 84;
								
								jQuery("#Bra_center_title").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_centered_title.php", function(data){
							
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Centered title shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var title = jQuery('#TB_window #title').val();
										   var subtitle = jQuery('#TB_window #subtitle').val();
										   var top_margin = jQuery('#TB_window #top_margin').val();
										   var shortcode = "[bra_center_title title='" + title +"' subtitle='" + subtitle +"' top_margin='" + top_margin + "']";
										   jQuery("#brankic_shortcode_form_wrapper").remove();
										   ed.execCommand('mceInsertContent', false, shortcode);	    
										   tb_remove();										   
										   return false;
									   });
							
									});
                            
								})
								
								
								jQuery("#Bra_graph").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_sliding_graph_bar.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Sliding Graph Bar shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var title = jQuery('#TB_window #title').val();
										   var percent = jQuery('#TB_window #percent').val();
										   var shortcode = "[bra_graph Title='" + title +"' Percent='" + percent +"']";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								jQuery("#Bra_photostream").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_photostream.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Photostream shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var user = jQuery('#TB_window #user').val();
										   var limit = jQuery('#TB_window #limit').val();
										   var social_network = jQuery('#TB_window #social_network option:selected').val();
										   var layout = jQuery('#TB_window #layout option:selected').val();
										   var shape = jQuery('#TB_window #shape option:selected').val();

										   var shortcode = "[bra_photostream user='" + user +"' limit='" + limit +"'  social_network='" + social_network + "'  layout='" + layout + "'  shape='" + shape + "']";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								jQuery("#Bra_google_map").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_map.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Google Map shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var location = jQuery('#TB_window #location').val();
										   var zoom = jQuery('#TB_window #zoom').val();

										   var shortcode = "[bra_google_map location='" + location +"' zoom='" + zoom +"']";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								jQuery("#Bra_border_divider").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_border_divider.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Border Divider shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var top = jQuery('#TB_window #top').val();
										   var bottom = jQuery('#TB_window #bottom').val();

										   var shortcode = "[bra_border_divider top='" + top +"' bottom='" + bottom +"']";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								jQuery("#Bra_divider").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_divider.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Divider shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var height = jQuery('#TB_window #height').val();

										   var shortcode = "[bra_divider height='" + height + "']";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								jQuery("#Bra_toggle").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_toggle.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Toggle / Accordion shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var caption = jQuery('#TB_window #caption').val();
										   var content = jQuery('#TB_window #content').val();
										   var collapsable = jQuery('#TB_window #collapsable option:selected').val();

										   var shortcode = "[bra_toggle collapsable='" + collapsable + "' caption='" + caption + "']" + content + "[/bra_toggle]";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								jQuery("#Bra_buttons").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_buttons.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Buttons shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var text = jQuery('#TB_window #text').val();
										   var url = jQuery('#TB_window #url').val();
										   var target = jQuery('#TB_window #target option:selected').val();
										   var size = jQuery('#TB_window #size option:selected').val();
										   var style = jQuery('#TB_window #style option:selected').val();
										   var color = jQuery('#TB_window #color option:selected').val();

										   var shortcode = "[bra_button text='" + text +"' url='" + url +"'  target='" + target + "' size='" + size + "' style='" + style + "' color='" + color + "']";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								jQuery("#Bra_icon_boxes").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_icon_boxes.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Icon boxes shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var caption_1 = jQuery('#TB_window #caption_1').val();
										   var url_1 = jQuery('#TB_window #url_1').val();
										   var icon_1 = jQuery('#TB_window #icon_1 option:selected').val();
										   var target_1 = jQuery('#TB_window #target_1 option:selected').val();
										   var about_1 = jQuery('#TB_window #about_1').val();
										   
										   var caption_2 = jQuery('#TB_window #caption_2').val();
										   var url_2 = jQuery('#TB_window #url_2').val();
										   var icon_2 = jQuery('#TB_window #icon_2 option:selected').val();
										   var target_2 = jQuery('#TB_window #target_2 option:selected').val();
										   var about_2 = jQuery('#TB_window #about_2').val();
										   
										   var caption_3 = jQuery('#TB_window #caption_3').val();
										   var url_3 = jQuery('#TB_window #url_3').val();
										   var icon_3 = jQuery('#TB_window #icon_3 option:selected').val();
										   var target_3 = jQuery('#TB_window #target_3 option:selected').val();
										   var about_3 = jQuery('#TB_window #about_3').val();
										   
										   var caption_4 = jQuery('#TB_window #caption_4').val();
										   var url_4 = jQuery('#TB_window #url_4').val();
										   var icon_4 = jQuery('#TB_window #icon_4 option:selected').val();
										   var target_4 = jQuery('#TB_window #target_4 option:selected').val();
										   var about_4 = jQuery('#TB_window #about_4').val();

										   var shortcode = "[bra_icon_boxes_container] [bra_icon_box caption='" + caption_1 +"' url='" + url_1 +"'  icon='" + icon_1 + "' target='" + target_1 + "']" + about_1 + "[/bra_icon_box]";
										   shortcode += "[bra_icon_box caption='" + caption_2 +"' url='" + url_2 +"'  icon='" + icon_2 + "' target='" + target_2 + "']" + about_2 + "[/bra_icon_box]";
										   shortcode += "[bra_icon_box caption='" + caption_3 +"' url='" + url_3 +"'  icon='" + icon_3 + "' target='" + target_3 + "']" + about_3 + "[/bra_icon_box]";
										   shortcode += "[bra_icon_box caption='" + caption_4 +"' url='" + url_4 +"'  icon='" + icon_4 + "' target='" + target_4 + "']" + about_4 + "[/bra_icon_box][/bra_icon_boxes_container]";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								jQuery("#Bra_team_member").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_team_member.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Team Member shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var member_name = jQuery('#TB_window #member_name').val();
										   var member_position = jQuery('#TB_window #member_position').val();
										   var member_img_src = jQuery('#TB_window #member_img_src').val();
										   var member_social_list = jQuery('#TB_window #member_social_list').val();
										   var about = jQuery('#TB_window #about').val();
										   var member_columns = jQuery('#TB_window #member_columns option:selected').val();

										   var shortcode = "[bra_team_member member_name='" + member_name +"' member_position='" + member_position +"'  member_img_src='" + member_img_src + "' member_social_list='" + member_social_list + "' member_columns='" + member_columns + "']" + about + "[/bra_team_member]";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										                                           tb_remove();
										   return false;
									   });
							
									});
                            
								})
								
								
								jQuery("#Bra_portfolio").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();

									jQuery.get(url + "/bra_shortcodes_portfolio.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Portfolio shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
																										
										   var title = jQuery('#TB_window #title').val();
										   var cat_id = jQuery('#TB_window #cat_id option:selected').val();
										   var no = jQuery('#TB_window #no').val();
										   var show_filters = jQuery('#TB_window #show_filters option:selected').val();
										   var columns = jQuery('#TB_window #columns option:selected').val();
										   var shape = jQuery('#TB_window #shape option:selected').val();
										   var hover = jQuery('#TB_window #hover option:selected').val();
										   var height = jQuery('#TB_window #height').val();
										   var shortcode = "[bra_portfolio title='" + title +"' cat_id='" + cat_id +"'  no='" + no + "' show_filters='" + show_filters + "' columns='" + columns + "' shape='" + shape + "' height='" + height + "' hover='" + hover + "']";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										                                           tb_remove();
										   return false;
									   });
									});
									
									
								})
								
								
								jQuery("#Bra_grid").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_grid.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Grid shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var grid_columns = jQuery('#TB_window #grid_columns option:selected').val();
										   var shortcode = "[bra_grid grid_columns='" + grid_columns + "']insert linked images here[/bra_grid]";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});                            
								})
								
								jQuery("#Bra_list").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_list.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'List wrapper shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var style = jQuery('#TB_window #style option:selected').val();
										   var shortcode = "[bra_list style='" + style + "']INSERT LIST HERE[/bra_list]";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});                            
								})
								
								jQuery("#Bra_highlights").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_highlights.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'List wrapper shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var text = jQuery('#TB_window #text').val();
										   var style = jQuery('#TB_window #style option:selected').val();
										   var shortcode = "[bra_highlight style='" + style + "']" + text + "[/bra_highlight]";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});                            
								})
								
								jQuery("#Bra_dropcaps").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_dropcaps.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Dropcap shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var letter = jQuery('#TB_window #letter').val();
										   var style = jQuery('#TB_window #style option:selected').val();
										   var shortcode = "[bra_dropcaps style='" + style + "']" + letter + "[/bra_dropcaps]";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});                            
								})
								
								jQuery("#Bra_blockquotes").click(function(){
									jQuery("#brankic_shortcode_form_wrapper").remove();
									jQuery.get(url + "/bra_shortcodes_blockquotes.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Blockquote shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=brankic_shortcode_form_wrapper' );
									   jQuery('#TB_window #bra_insert_shortcode_button').click(function(){
										   var text = jQuery('#TB_window #text').val();
										   var align = jQuery('#TB_window #align option:selected').val();
										   var shortcode = "[bra_blockquote align='" + align + "']" + text + "[/bra_blockquote]";
										   jQuery("#brankic_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});                            
								})
																																																
																																																
																																																
																																																						                            })
						
													
						
						
						}
            
			
			

			
			
				if (text != null && text != ''){
                  if (posts != null && posts != '')
                     ed.execCommand('mceInsertContent', false, '[recent-posts posts="'+posts+'"]'+text+'[/recent-posts]');
                  else
                     ed.execCommand('mceInsertContent', false, '[recent-posts]'+text+'[/recent-posts]');
               }
               else{
                  if (posts != null && posts != '')
                     ed.execCommand('mceInsertContent', false, '[recent-posts posts="'+posts+'"]');
                  else
                     ed.execCommand('mceInsertContent', false, '[recent-posts]');
               }
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Recent Posts",
            author : 'Konstantinos Kouratoras',
            authorurl : 'http://www.kouratoras.gr',
            infourl : 'http://wp.smashingmagazine.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('bra_shortcodes', tinymce.plugins.bra_shortcodes);
   

})();