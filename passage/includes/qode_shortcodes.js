(function() {
   tinymce.create('tinymce.plugins.qode_shortcodes', {
      init : function(ed, url) {

      ed.addButton('qode_shortcodes', {
        id : 'qode_shortcode_button',
        title : 'Qode Shortcodes',
        image : url+'/qode_shortcodes.ico',
        onclick : function() {

          jQuery("#qode_shortcode_form_wrapper").remove();

          var shortcodes_visible = jQuery("#qode_shortcodes_menu_holder").length;

          if (shortcodes_visible){
            jQuery("#qode_shortcodes_menu_holder").remove();
          } else{

            var container_element = "";
            var id = jQuery(this).attr("id");

            if(jQuery('#qode_shortcode_button, #wp-wpb_tinymce_content-wrap #qode_shortcode_button').length){
              container_element = jQuery('#qode_shortcode_button').closest(".mce-toolbar-grp");
            } else if (jQuery("#"+id+"_toolbargroup").length){
              container_element = jQuery("#"+id+"_toolbargroup");
            }

            if(container_element != ""){
              container_element.append("<div id='qode_shortcodes_menu_holder'></div>");
            }

            jQuery('#qode_shortcodes_menu_holder').load(url + '/qode_shortcodes_popup.html#qode_shortodes_popup', function(){

                var y = 0;
                var x = 0;

                if(jQuery('#qode_shortcode_button button').length){
                    var x = parseInt(jQuery("#qode_shortcode_button button").offset().left) - parseInt(jQuery("#adminmenuwrap").width()) + 10;
                } else if (jQuery("#content_qode_shortcodes").length){
                    var x = parseInt(jQuery("#content_qode_shortcodes").offset().left) - parseInt(jQuery("#adminmenuwrap").width()) + 10;
                }

                jQuery("#qode_shortcodes_menu_holder").css({top: y, left: x});
								

								jQuery("#SC_1-2x1-2").click(function(){
									var shortcode = "[two_col_50_50_col1]<p>content content content</p> [/two_col_50_50_col1]<br/>[two_col_50_50_col2] <p>content content content</p>[/two_col_50_50_col2] "
									ed.execCommand('mceInsertContent', false, shortcode); 
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})

								jQuery("#SC_1-2x1-2_nested").click(function(){
									var shortcode = "[two_col_50_50_nested_col1]<p>content content content</p> [/two_col_50_50_nested_col1]<br/>[two_col_50_50_nested_col2] <p>content content content</p>[/two_col_50_50_nested_col2] "
									ed.execCommand('mceInsertContent', false, shortcode); 
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_1-3x1-3x1-3").click(function(){
									var shortcode = "[three_col_col1] <p>content content content</p> [/three_col_col1]<br/>[three_col_col2] <p>content content content</p>[/three_col_col2]<br/>[three_col_col3] <p>content content content</p>[/three_col_col3]"
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_1-3x2-3").click(function(){
									var shortcode = "[two_col_33_66_col1] <p>content content content</p>[/two_col_33_66_col1]<br/>[two_col_33_66_col2]<p>content content content</p>[/two_col_33_66_col2] "
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_2-3x1-3").click(function(){
									var shortcode = "[two_col_66_33_col1]<p>content content content</p>[/two_col_66_33_col1]<br/>[two_col_66_33_col2]<p>content content content</p>[/two_col_66_33_col2] "
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_1-4x3-4").click(function(){
									var shortcode = "[two_col_25_75_col1]<p>content content content</p>[/two_col_25_75_col1]<br/>[two_col_25_75_col2]<p>content content content</p>[/two_col_25_75_col2] "
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_3-4x1-4").click(function(){
									var shortcode = "[two_col_75_25_col1]<p>content content content</p>[/two_col_75_25_col1]<br/>[two_col_75_25_col2]<p>content content content</p>[/two_col_75_25_col2] "
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_1-4x1-4x1-4x1-4").click(function(){
									var shortcode = "[four_col_col1]<p>content content content</p>[/four_col_col1]<br/>[four_col_col2]<p>content content content</p>[/four_col_col2]<br/>[four_col_col3]<p>content content content</p>[/four_col_col3]<br/>[four_col_col4]<p>content content content</p> [/four_col_col4] "
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_ordered-list").click(function(){
									var shortcode = "[ordered_list]<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>[/ordered_list] "
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_highlights").click(function(){
									var shortcode = "[highlight] content content content[/highlight]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_action").click(function(){
									var shortcode = "[action background_color='' border='no' border_color='']<br /><br /> content content content <br /><br />[/action]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})

								jQuery("#SC_table").click(function(){
									var shortcode = "[table]<br/><br/>[table_row][table_cell_head] Dummy Title [/table_cell_head][table_cell_head] Dummy Title [/table_cell_head][table_cell_head] Dummy Title [/table_cell_head][/table_row]<br/><br/>[table_row][table_cell_body] content content [/table_cell_body][table_cell_body] content content [/table_cell_body][table_cell_body] content content [/table_cell_body][/table_row]<br/>[table_row][table_cell_body] content content [/table_cell_body][table_cell_body] content content [/table_cell_body][table_cell_body] content content [/table_cell_body][/table_row]<br/><br/>[/table]";
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									jQuery("#qode_shortcodes_menu_holder").remove();                                  
								})
								
								jQuery("#SC_social_share").click(function(){
									var shortcode = "[social_share]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})

								jQuery("#SC_social_icons").click(function(){
									var shortcode = "[social_icons] youtube,http://www.youtube.com, vimeo,http://www.vimeo.com, facebook,http://www.facebook.com [/social_icons]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove(); 
								})

								jQuery("#SC_box_with_border").click(function(){
									var shortcode = "[box_with_border background_color='' border_width='']<br /><br />Put here some content or shortcode<br /><br />[/box_with_border]";
									ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
									jQuery("#qode_shortcodes_menu_holder").remove();                                  
								})
								
								jQuery("#SC_box_with_shadow").click(function(){
									var shortcode = "[box_with_shadow background_color='' shadow='yes']<br /><br />Put here some content or shortcode<br /><br />[/box_with_shadow]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})

								jQuery("#SC_image_with_text").click(function(){
									var shortcode = "[image_with_text background_color='' image_link='' image_title='' lightbox='no' link='' target='']<h4>TITLE</h4><p>Put here some content</p>[/image_with_text]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})

								jQuery("#SC_image_with_text_over").click(function(){
									var shortcode = "[image_with_text_over image_link='' background_color='' title='MARISSA SMITH' title_color='' text='Lorem ipsun solarem' text_color='' link='' target='']";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})

								jQuery("#SC_h5_with_line").click(function(){
									var shortcode = "[h5_with_line title='MARISSA SMITH' title_color='' link_text='See project' link_color='' link='' target='']";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_parallax").click(function(){
									var shortcode = "[parallax]<br/><br/>[parallax_section id='insert image id' height='' title='...'] <p>content content content</p> [/parallax_section]<br/><br/>[/parallax]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								
								////////////////////////////////
								// pop-up shortcodes          //
								////////////////////////////////
								var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
								W = W - 80;
								H = H - 120;

								jQuery("#SC_accordion").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_accordion.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Accordion shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #accordion_type option:selected').val();
										   var title_color = jQuery('#TB_window #title_color').val();
										   var background_color = jQuery('#TB_window #background_color').val();
										   var shortcode = "[accordion accordion_type='"+type+"']<br /><br />[accordion_item caption=\"Accordion 1\" title_color='"+title_color+"' background_color='"+background_color+"'] <p class='accordions'>This is some content</p> [/accordion_item]<br />[accordion_item caption=\"Accordion 2\" title_color='"+title_color+"' background_color='"+background_color+"'] <p>This is some content</p> [/accordion_item]<br />[accordion_item caption=\"Accordion 3\" title_color='"+title_color+"' background_color='"+background_color+"'] <p>This is some content</p> [/accordion_item]<br/><br/>[/accordion]";
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
									   tb_show( 'Dropcap shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var letter = jQuery('#TB_window #letter').val();
										   var style = jQuery('#TB_window #style option:selected').val();
										   var background_color = jQuery('#TB_window #background_color').val();
										   var border = jQuery('#TB_window #border option:selected').val();
										   var border_color = jQuery('#TB_window #border_color').val();
										   var shortcode = "[dropcaps style='"+style+"' background_color='"+background_color+"' border='"+border+"' border_color='"+border_color+"']" + letter + "[/dropcaps]";
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
									   tb_show( 'Blockquote shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var text = jQuery('#TB_window #text').val();
										   var width = jQuery('#TB_window #blockquote_width').val();
										   var shortcode = "[blockquote width='" + width + "']<br/><br/>" + text + "<br/><br/>[/blockquote]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})

								jQuery("#SC_pricing_table").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_pricing_table.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Pricing table shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
										   var shortcode = "[pricing_table]<br/><br/>[pricing_column type='"+type+"' title='Price dummy title' price='100' currency='$' price_period='/mo' link='insert your link here' button_text='Buy Now' active='no']<br/><br/>[pricing_cell] content content content [/pricing_cell]<br/>[pricing_cell] content content content [/pricing_cell]<br/>[pricing_cell] content content content [/pricing_cell]<br/><br/>[/pricing_column]<br/><br/>[/pricing_table]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});                                
								})
								
								jQuery("#SC_latest_post").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_latest_post.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Latest posts shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var post_number = jQuery('#TB_window #post_number option:selected').val();
										   var order_by = jQuery('#TB_window #order_by option:selected').val();
										   var order = jQuery('#TB_window #order option:selected').val();
										   var category = jQuery('#TB_window #category').val();
										   var text_length = jQuery('#TB_window #text_length').val();
										   var shortcode = "[latest_post post_number='"+post_number + "' order_by='"+order_by+"' order='"+order+"' category='"+category+"' text_length='"+text_length+"'/]";
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
									   tb_show( 'Pie chart shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
										   var percentage = jQuery('#TB_window #percentage').val();
										   var percentage_color = jQuery('#TB_window #percentage_color').val();
										   var active_color = jQuery('#TB_window #active_color').val();
										   var noactive_color = jQuery('#TB_window #noactive_color').val();
										   var line_width = jQuery('#TB_window #line_width').val();
										   var shortcode = "[pie_chart type='"+type+"' title='Pie Chart Title' title_color='' percent='"+percentage+"' percentage_color='"+percentage_color+"' active_color='"+active_color+"' noactive_color='"+noactive_color+"' line_width='"+line_width+"'] <p>This is some content</p> [/pie_chart]";
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
									   tb_show( 'Pie Chart 2', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
											 if(jQuery('#TB_window #width').val() != ""){
												var width = "width='"+jQuery('#TB_window #width').val()+"'";
											 }else{ var width = ""; }
											 if(jQuery('#TB_window #height').val() != ""){
												var height = "height='"+jQuery('#TB_window #height').val()+"'";
											 }else{ var height = ""; }
											 var color = jQuery('#TB_window #color').val();
											 var shortcode = "[pie_chart2 "+width+" "+height+" color='"+color+"']30,#cccccc,Legend One;70,#669900,Legend Two [/pie_chart2]";
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
									   tb_show( 'Pie Chart 3', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
											 if(jQuery('#TB_window #width').val() != ""){
												var width = "width='"+jQuery('#TB_window #width').val()+"'";
											 }else{ var width = ""; }
											 if(jQuery('#TB_window #height').val() != ""){
												var height = "height='"+jQuery('#TB_window #height').val()+"'";
											 }else{ var height = ""; }
											 var color = jQuery('#TB_window #color').val();
											 var shortcode = "[pie_chart3 "+width+" "+height+" color='"+color+"']30,#cccccc,Legend One;70,#669900,Legend Two [/pie_chart3]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})

								jQuery("#SC_line_graph").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_line_graph.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Line Graph', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
										   	var custom_color = jQuery('#TB_window #custom_color').val();
											 if(jQuery('#TB_window #width').val() != ""){
												var width = "width='"+jQuery('#TB_window #width').val()+"'";
											 }else{ var width = ""; }
											 if(jQuery('#TB_window #height').val() != ""){
												var height = "height='"+jQuery('#TB_window #height').val()+"'";
											 }else{ var height = ""; }
											 if(jQuery('#TB_window #scaleSteps').val() != ""){
												var scaleSteps = "scale_steps='"+jQuery('#TB_window #scaleSteps').val()+"'";
											 }else{ var scaleSteps = ""; }
											 if(jQuery('#TB_window #scaleStepWidth').val() != ""){
												var scaleStepWidth = "scale_step_width='"+jQuery('#TB_window #scaleStepWidth').val()+"'";
											 }else{ var scaleStepWidth = ""; }
										   var shortcode = "[line_graph "+width+" "+height+" "+scaleSteps+" "+scaleStepWidth+" custom_color='"+custom_color+"' type='"+type+"' labels='Label 1, Label 2, Label 3']#cccccc,Legend One,100,78,56;#669900,Legend Two,50,30,88[/line_graph]";
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
									   tb_show( 'Horizontal progress bar shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									   	   var color = jQuery('#TB_window #color').val();
									   	   var percent_color = jQuery('#TB_window #percent_color').val();
									   	   var active_background_color = jQuery('#TB_window #active_background_color').val();
									   	   var noactive_background_color = jQuery('#TB_window #noactive_background_color').val();
									   	   var height = jQuery('#TB_window #height').val();
										   var shortcode = "[progress_bars]<br /><br />[progress_bar title=\"Progress 1\" percent=\"50\" color='"+color+"' percent_color='"+percent_color+"' active_background_color='"+active_background_color+"' noactive_background_color='"+noactive_background_color+"' height='"+height+"']<br />[progress_bar title=\"Progress 2\" percent=\"50\" color='"+color+"' percent_color='"+percent_color+"' active_background_color='"+active_background_color+"' noactive_background_color='"+noactive_background_color+"' height='"+height+"']<br />[progress_bar title=\"Progress 3\" percent=\"50\" color='"+color+"' percent_color='"+percent_color+"' active_background_color='"+active_background_color+"' noactive_background_color='"+noactive_background_color+"' height='"+height+"']<br/><br/>[/progress_bars]";
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
									   tb_show( 'Vertical progress bar shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var background_color = jQuery('#TB_window #background_color').val();
										   var percentage_color = jQuery('#TB_window #percentage_color').val();
										   var text_color = jQuery('#TB_window #text_color').val();
										   var text_size = jQuery('#TB_window #text_size').val();
										   var shortcode = "[progress_bars_vertical]<br /><br />[progress_bar_vertical title=\"Progress 1\" percent=\"50\" background_color='"+background_color+"' percentage_color='"+percentage_color+"' text_color='"+text_color+"' text_size='"+text_size+"']<p>Put here some content</p>[/progress_bar_vertical]<br />[progress_bar_vertical title=\"Progress 2\" percent=\"50\" background_color='"+background_color+"' percentage_color='"+percentage_color+"' text_color='"+text_color+"' text_size='"+text_size+"']<p>Put here some content</p>[/progress_bar_vertical]<br />[progress_bar_vertical title=\"Progress 3\" percent=\"50\" background_color='"+background_color+"' percentage_color='"+percentage_color+"' text_color='"+text_color+"' text_size='"+text_size+"']<p>Put here some content</p>[/progress_bar_vertical]<br/><br/>[/progress_bars_vertical]";
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
									   tb_show( 'Icon shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									   	   var type = jQuery('#TB_window #type option:selected').val();
										   var icon = jQuery('#TB_window #icon option:selected').val();
										   var shortcode = "[icon type='"+type+"' icon='"+icon+"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})

								jQuery("#SC_icons_with_title").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_icons_with_title.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Icon with title shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									   	   var type = jQuery('#TB_window #type option:selected').val();
										   var icon = jQuery('#TB_window #icon option:selected').val();
										   var position = jQuery('#TB_window #position').val();
										   var background_color = jQuery('#TB_window #background_color').val();
										   var title = jQuery('#TB_window #title').val();
										   var color = jQuery('#TB_window #color').val();
										   var shortcode = "[icon_with_title type='"+type+"' icon='"+icon+"' position='"+position+"' background_color='"+background_color+"' title='"+title+"' color='"+color+"']";
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
									   tb_show( 'Tabs shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
										   var border = jQuery('#TB_window #border option:selected').val();
										   var shortcode = "[tabs type='"+type+"' border='"+border+"' tabid1=\"Tab 1\" tabid2=\"Tab 2\" tabid3=\"Tab 3\"]<br /><br />[tab id=1]Tab content 1[/tab]<br />[tab id=2]Tab content 2[/tab]<br />[tab id=3]Tab content 3[/tab]<br /><br />[/tabs]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});                         
								})
								
								jQuery("#SC_message").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_message.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Message shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var background_color = jQuery('#TB_window #background_color').val();
										   var border = jQuery('#TB_window #border option:selected').val();
										   var border_color = jQuery('#TB_window #border_color').val();
										   var shortcode = "[message background_color='"+background_color+"' border='"+border+"' border_color='"+border_color+"']<h5>Message Title</h5>[/message]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})

								jQuery("#SC_elements_animation").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_elements_animation.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Elements Animation shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var animation_type = jQuery('#TB_window #animation_type').val();
										   var shortcode = "[elements_animation animation_type='"+animation_type+"']<p>Put here some content</p>[/elements_animation]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_unordered_list").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_unordered_list.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Unordered shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var style = jQuery('#TB_window #style option:selected').val();
										   var shortcode = "[unordered_list style='" + style + "']<ul><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li></ul>[/unordered_list]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);
										   tb_remove();
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
									   tb_show( 'Button shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var size = jQuery('#TB_window #size option:selected').val();
										   var text = jQuery('#TB_window #text').val();
										   var link = jQuery('#TB_window #link').val();
										   var target = jQuery('#TB_window #target option:selected').val();
										   var color = jQuery('#TB_window #color').val();
										   var background_color = jQuery('#TB_window #background_color').val();
										   var font_style = jQuery('#TB_window #font_style option:selected').val();
										   var font_size = jQuery('#TB_window #font_size').val();
										   var line_height = jQuery('#TB_window #line_height').val();
										   var font_weight = jQuery('#TB_window #font_weight option:selected').val();
										   var shortcode = "[button size='" + size + "' color='"+ color + "' background_color='"+ background_color +"' font_size='"+ font_size +"' line_height='"+ line_height +"' font_style='"+ font_style +"' font_weight='"+ font_weight +"' text='"+ text +"' link='"+ link +"' target='"+ target +"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);	
										   tb_remove();
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
									   tb_show( 'Portfolio list shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
											var filter = jQuery('#TB_window #filter option:selected').val();
											var filter_title = jQuery('#TB_window #filter_title').val();
											var lightbox = jQuery('#TB_window #lightbox option:selected').val();
											 var type = jQuery('#TB_window #type option:selected').val();
											 var columns = jQuery('#TB_window #columns option:selected').val();
											 var order_by = jQuery('#TB_window #order_by option:selected').val();
											 var order = jQuery('#TB_window #order option:selected').val();
											 var number = jQuery('#TB_window #number').val();
											 var category = jQuery('#TB_window #category').val();
											 var selected_projects = jQuery('#TB_window #selected_projects').val();
											 var show_load_more = jQuery('#TB_window #show_load_more option:selected').val();
										   var shortcode = "[portfolio_list type='" + type + "' columns='"+columns+"' order_by='"+order_by+"' order='"+order+"' number='"+number+"' category='"+category+"' selected_projects='"+selected_projects+"' filter='"+filter+"' filter_title='"+filter_title+"' lightbox='"+lightbox+"' show_load_more='" + show_load_more +"']";
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
									   tb_show( 'Separator shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									   		 var type = jQuery('#TB_window #type option:selected').val();
										     var color = jQuery('#TB_window #color').val();
											 var thickness = jQuery('#TB_window #thickness').val();
											 var top = jQuery('#TB_window #top').val();
											 var bottom = jQuery('#TB_window #bottom').val();
										   var shortcode = "[separator type='"+type+"' color='"+color+"' thickness='"+thickness+"'  up='"+top+"' down='"+bottom+"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_testimonial").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_testimonials.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Separator shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									   		 var name_color = jQuery('#TB_window #name_color').val();
										     var background_color = jQuery('#TB_window #background_color').val();
										     var border = jQuery('#TB_window #border option:selected').val();
										     var border_color = jQuery('#TB_window #border_color').val();
										     var shortcode = "[testimonial name_color='"+name_color+"' background_color='"+background_color+"' border='"+border+"' border_color='"+border_color+"' name='MARISSA COPPER' image_link='']<br/>Etiam eget mi enim, non ultricies nisi volup tatem, illo inventore veritatis et quasi architecto beatae vitae dicta sunt.<br/>[/testimonial]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_service").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_service.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Service shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										    var type = jQuery('#TB_window #type option:selected').val();
											var title = jQuery('#TB_window #title').val();
											var color = jQuery('#TB_window #color').val();
											var link = jQuery('#TB_window #link').val();
											var target = jQuery('#TB_window #target').val();
										   var shortcode = "[service type='"+type+"' title='"+title+"' color='"+color+"' link='"+link+"' target='"+target+"']<p>content content content</p>[/service]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})

								jQuery("#SC_service_with_animation").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_services_with_animation.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Service shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
										   var position = jQuery('#TB_window #position option:selected').val();
										   var size = jQuery('#TB_window #size').val();
										   var link = jQuery('#TB_window #link').val();
										   var target = jQuery('#TB_window #target option:selected').val();
										   var text = jQuery('#TB_window #text').val();
										   var icon_color = jQuery('#TB_window #icon_color option:selected').val();
										   var icon = jQuery('#TB_window #icon option:selected').val();
										   var background_color = jQuery('#TB_window #background_color').val();
										   var animation_in = jQuery('#TB_window #animation_in option:selected').val();
										   var hover = jQuery('#TB_window #hover option:selected').val();
										   var shortcode = "[service_animate type='"+type+"' size='"+size+"' position='"+position+"' background_color='"+background_color+"' link='"+link+"' target='"+target+"' text='"+text+"' icon_color='"+icon_color+"' icon='"+icon+"' animation_in='"+animation_in+"' hover='"+hover+"']<h4>Title</h4><p>content content content</p>[/service_animate]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
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
									   tb_show( 'Video shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
											 var id = jQuery('#TB_window #id').val();
											 var height = jQuery('#TB_window #height').val();
										   var shortcode = "[video type='"+type+"' id='"+id+"' height='"+height+"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
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
									   tb_show( 'Counter', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
									   	   var type = jQuery('#TB_window #type option:selected').val();
									   	   var position = jQuery('#TB_window #position option:selected').val();
										   var digit = jQuery('#TB_window #digit').val();
										   var font_size = jQuery('#TB_window #font_size').val();
										   var font_color = jQuery('#TB_window #font_color').val();
										   var shortcode = "[counter type='"+type+"' position='"+position+"' digit='"+digit+"' font_size='"+font_size+"' font_color='"+font_color+"']<p>Content content content</p>[/counter]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								
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
            longname : "Recent Posts",
            author : 'Konstantinos Kouratoras',
            authorurl : 'http://www.kouratoras.gr',
            infourl : 'http://wp.smashingmagazine.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('qode_shortcodes', tinymce.plugins.qode_shortcodes);
   

})();