function des_js_querystring(ji) {

	hu = window.location.search.substring(1);
	gy = hu.split( "&" );
	for (i=0;i<gy.length;i++) {
	
		ft = gy[i].split( "=" );
		if (ft[0] == ji) {
		
			return ft[1];
		
		} // End IF Statement
		
	} // End FOR Loop
	
} // End des_js_querystring()
	
(
	
	function(){
	
		// Get the URL to this script file (as JavaScript is loaded in order)
		// (http://stackoverflow.com/questions/2255689/how-to-get-the-file-path-of-the-currenctly-executing-javascript-code)
		
		var scripts = document.getElementsByTagName( "script"),
		src = scripts[scripts.length-1].src;
		
		if ( scripts.length ) {
		
			for ( i in scripts ) {

				var scriptSrc = '';
				
				if ( typeof scripts[i].src != 'undefined' ) { scriptSrc = scripts[i].src; } // End IF Statement
	
				var txt = scriptSrc.search( 'shortcode-generator' );
				
				if ( txt != -1 ) {
				
					src = scripts[i].src;
				
				} // End IF Statement
			
			} // End FOR Loop
		
		} // End IF Statement

		var framework_url = src.split( '/js/' );
		
		var icon_url = framework_url[0] + '/images/shortcode-icon.png';
		
		jQuery('body').append('<div class="shortcode-loader" style="display:none;color:white;font-size: 30px;z-index: 99999999999999;"><i class="icon-spinner icon-spin"></i></div>');
	
		tinymce.create(
			"tinymce.plugins.DesThemesShortcodes",
			{
				init: function(d,e) {
						d.addCommand( "desVisitDesThemes", function(){ window.open( "http://designarethemes.com/" ) } );
						
						d.addCommand( "desOpenDialog",function(a,c){
							
							// Grab the selected text from the content editor.
							selectedText = '';
						
							if ( d.selection.getContent().length > 0 ) {
						
								selectedText = d.selection.getContent();
								
							} // End IF Statement
							
							desSelectedShortcodeType = c.identifier;
							desSelectedShortcodeTitle = c.title;
							
							if (c.title !== "Dropcap" && c.title !== "Highlight"){
								jQuery('.shortcode-loader').dialog({
									modal:true,
									open:function(event,ui){
										jQuery('.ui-dialog-titlebar').remove();
										jQuery('.shortcode-loader').parent().css({
											'text-align':'center',
											'z-index':999999,
											'background':'transparent',
											'border':'none',
											'display':'block'
										});
										jQuery('.shortcode-loader i').css({'margin-top':'20px'});
									}
								});
	
							}
														
							jQuery.get(e+"/dialog.php",function(b){
																
								if (c.title !== "Dropcap" && c.title !== "Highlight"){
									var checkLoading = setInterval(function(){
										if (jQuery('#TB_window').length != 0){
											jQuery('.shortcode-loader').dialog('close');
											clearInterval(checkLoading);
										}
									}, 10);	
								}
								
								jQuery( '#des-options').addClass( 'shortcode-' + desSelectedShortcodeType );
								jQuery( '#des-preview').addClass( 'shortcode-' + desSelectedShortcodeType );
								
								// Skip the popup on certain shortcodes.
								switch ( desSelectedShortcodeType ) {
							
									// Highlight
									
									case 'highlight':
								
									var a = '[highlight] Your content here. [/highlight]';
									
									tinyMCE.activeEditor.execCommand( "mceInsertContent", false, a);
								
									break;
									
									// Dropcap
									
									case 'dropcap':
								
									var a = '[dropcap]Your text here.[/dropcap]';
									
									tinyMCE.activeEditor.execCommand( "mceInsertContent", false, a);
								
									break;
									
									case 'addthis':
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
								
									var checker = setInterval(function(){
										if (jQuery('#des-options').length != 0){
											jQuery('#TB_window').css('overflow','scroll');
											if (jQuery('#des-preview').length < 1){
												jQuery('#des-options').width('100%');
												jQuery('textarea').width('100%');
											}
											clearInterval(checker);
										}
									}, 100);
									
									break;
									
									case 'ifontawesome': case 'unordered_list':
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
									var checker = setInterval(function(){
										if (jQuery('.select_wrapper').length != 0){
											jQuery('.select_wrapper').eq(2).css('display','none');
										  	jQuery('.select_wrapper').eq(2).after('<ul class="icon_chooser" />');
											jQuery('#des-value-icon option').each(function(){
												jQuery('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED');jQuery('#des-value-icon').val(jQuery(this).attr('id'));\" />");
											});
											jQuery('#des-options').width('100%');
											jQuery('#des-value-icon_color').css('float','left');
											jQuery('#TB_window').css('overflow','scroll');
											clearInterval(checker);
										}
									}, 100);
									
									break;
									
									case 'service':
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
										
										var checker = setInterval(function(){
										
											if (jQuery('.des-icon-chooser').length != 0){
												jQuery('.des-icon-chooser').css('display','none');
											  	jQuery('.des-icon-chooser').after('<ul class="icon_chooser" />');
											  	var path = framework_url[0].split('/functions');
											  		path = path[0] + "/img/designare_icons/";
												jQuery('.des-icon-chooser option').each(function(){
													jQuery(this).parent().siblings('.icon_chooser').append("<img src='"+path+jQuery(this).val()+".png' id='"+jQuery(this).val()+"' class='des_icon_preview' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED');jQuery(this).parent().siblings('input').val(jQuery(this).attr('id'));\" />");
												});
												jQuery('#des-options').width('100%');
												jQuery('#TB_window').css('overflow','scroll');
												clearInterval(checker);
											}
										}, 100);
									break;
									
									case 'servicefa':
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									break;
									
									case 'ides':
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
									var checker = setInterval(function(){
									
										if (jQuery('.select_wrapper').length != 0){
											jQuery('.select_wrapper').eq(0).css('display','none');
										  	jQuery('.select_wrapper').eq(0).after('<ul class="icon_chooser" />');
										  	var path = framework_url[0].split('/functions');
										  		path = path[0] + "/img/designare_icons/";
											jQuery('#des-value-desicon option').each(function(){
												jQuery('.icon_chooser').append("<img src='"+path+jQuery(this).val()+".png' id='"+jQuery(this).val()+"' class='des_icon_preview' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED');jQuery('#des-value-desicon').val(jQuery(this).attr('id'));\" />");
											});
											jQuery('#des-options').width('100%');
											jQuery('#des-value-icon_color').css('float','left');
											jQuery('#TB_window').css('overflow','scroll');
											clearInterval(checker);
										}
									}, 100);
									
									break;
									
									case 'special_tabs':
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
									var checker = setInterval(function(){
										if (jQuery('.input-select').length != 0){
											/*
jQuery('.input-select').css('display','none');
											jQuery('.input-select').each(function(){
												jQuery(this).after('<ul class="icon_chooser" />');
												jQuery(this).find('option').each(function(){
													jQuery(this).parent().siblings('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED'); jQuery(this).parents('.icon_chooser').siblings('.input-text').val(jQuery(this).attr('id'));jQuery('#des-value-icon').val(jQuery(this).attr('id'));\" />");
												});
											});
*/
											jQuery('.input-select').each(function(){
												jQuery(this).parents('tr')
													.before('<tr class="added"><th valign="top" scope="row"><label for="hasicon" class="">Icon ?</label></th><td><form ><input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" value="On" style="cursor:pointer;"> On<input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" checked value="Off" style="margin-left:30px;cursor:pointer;"> Off</form><br><span class="des-input-help">If set to <strong style="font-style:normal;">On</strong> you can choose an icon to place before the title from a list of icons. </span><ul class="icon_chooser" style="display:none;"/></td></tr>')
													.addClass('added');
												jQuery(this).find('option').each(function(i){
													jQuery(this).parents('tr').prev('tr').find('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED'); jQuery(this).parents('tr').next('tr').find('.input-text').val(jQuery(this).attr('id'));\" />");
												});
												jQuery(this).parents('tr').css('display','none');
											});
											
											jQuery('#des-fontawesome-select').change(function(){
												
												jQuery('tr.added').remove();
												jQuery('tr.remover ~ tr.added:eq(0)').remove();
												jQuery('.td-divider').parent().remove();
												jQuery('.input-select').each(function(){
													jQuery(this).parents('tr')
														.before('<tr class="added"><th valign="top" scope="row"><label for="hasicon" class="">Icon ?</label></th><td><form ><input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" value="On" style="cursor:pointer;"> On<input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" checked value="Off" style="margin-left:30px;cursor:pointer;"> Off</form><br><span class="des-input-help">If set to <strong style="font-style:normal;">On</strong> you can choose an icon to place before the title from a list of icons. </span><ul class="icon_chooser" style="display:none;"/></td></tr>')
														.addClass('added');
													jQuery(this).find('option').each(function(i){
														jQuery(this).parents('tr').prev('tr').find('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED'); jQuery(this).parents('tr').next('tr').find('.input-text').val(jQuery(this).attr('id'));\" />");
													});
													jQuery(this).parents('tr').css('display','none');
												});
		
											});
											
											jQuery('#des-options').width('100%');
											jQuery('#des-value-icon_color').css('float','left');
											jQuery('#TB_window').css('overflow','scroll');
											clearInterval(checker);
										}
									}, 100);
									
									
									break;
									
									case 'serviceballs':
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
									var checker = setInterval(function(){
										if (jQuery('.input-select').length != 0){
											jQuery('.input-select').each(function(){
												jQuery(this).parents('.des-marker-select-control')
													.after('<div <ul class="icon_chooser" />');
												jQuery(this).find('option').each(function(i){
													jQuery(this).parents('.des-marker-select-control').siblings('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED'); jQuery(this).parents('.icon_chooser').siblings('.des-marker-select-control').find('.input-select').val(jQuery(this).attr('id'));\" />");
												});
												jQuery(this).parents('.des-marker-select-control').css('display','none');
											});
											jQuery('#des-options').width('100%');
											jQuery('#des-value-icon_color').css('float','left');
											jQuery('input.input-colourpicker').css({ 'float':'left','margin-left':'5px' });
											jQuery('#TB_window').css('overflow','scroll');
											clearInterval(checker);
										}
									}, 100);
									
									
									break;

									case 'acc':
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
									var checker = setInterval(function(){
										if (jQuery('.input-select').length != 0){
											jQuery('.input-select').each(function(){
												jQuery(this).parents('tr')
													.before('<tr class="added"><th valign="top" scope="row"><label for="hasicon" class="">Icon ?</label></th><td><form ><input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" value="On" style="cursor:pointer;"> On<input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" checked value="Off" style="margin-left:30px;cursor:pointer;"> Off</form><br><span class="des-input-help">If set to <strong style="font-style:normal;">On</strong> you can choose an icon to place before the title from a list of icons. </span><ul class="icon_chooser" style="display:none;"/></td></tr>')
													.addClass('added');
												jQuery(this).find('option').each(function(i){
													jQuery(this).parents('tr').prev('tr').find('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED'); jQuery(this).parents('tr').next('tr').find('.input-text').val(jQuery(this).attr('id'));\" />");
												});
												jQuery(this).parents('tr').css('display','none');
											});
											
											jQuery('#des-acc-select').change(function(){
												jQuery('tr.added').remove();
												jQuery('tr.remover ~ tr.added:eq(0)').remove();
												jQuery('.td-divider').parent().remove();
												jQuery('.input-select').each(function(){
													jQuery(this).parents('tr')
														.before('<tr class="added"><th valign="top" scope="row"><label for="hasicon" class="">Icon ?</label></th><td><form ><input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" value="On" style="cursor:pointer;"> On<input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" checked value="Off" style="margin-left:30px;cursor:pointer;"> Off</form><br><span class="des-input-help">If set to <strong style="font-style:normal;">On</strong> you can choose an icon to place before the title from a list of icons. </span><ul class="icon_chooser" style="display:none;"/></td></tr>')
														.addClass('added');
													jQuery(this).find('option').each(function(i){
														jQuery(this).parents('tr').prev('tr').find('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED'); jQuery(this).parents('tr').next('tr').find('.input-text').val(jQuery(this).attr('id'));\" />");
													});
													jQuery(this).parents('tr').css('display','none');
												});
											});
											
											
											jQuery('#des-options').width('100%');
											jQuery('#des-value-icon_color').css('float','left');
											jQuery('input.input-colourpicker').css({ 'float':'left','margin-left':'5px' });
											jQuery('#TB_window').css('overflow','scroll');
											clearInterval(checker);
										}
									}, 100);
									
									
									break;
									
									case 'tab':
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
									var checker = setInterval(function(){
										if (jQuery('.input-select').length != 0){
											//jQuery('.input-select').css('display','none');
											jQuery('.input-select').each(function(){
												jQuery(this).parents('tr')
													.before('<tr class="added"><th valign="top" scope="row"><label for="hasicon" class="">Icon ?</label></th><td><form ><input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" value="On" style="cursor:pointer;"> On<input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" checked value="Off" style="margin-left:30px;cursor:pointer;"> Off</form><br><span class="des-input-help">If set to <strong style="font-style:normal;">On</strong> you can choose an icon to place before the title from a list of icons. </span><ul class="icon_chooser" style="display:none;"/></td></tr>')
													.addClass('added');
												jQuery(this).find('option').each(function(i){
													jQuery(this).parents('tr').prev('tr').find('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED'); jQuery(this).parents('tr').next('tr').find('.input-text').val(jQuery(this).attr('id'));\" />");
												});
												jQuery(this).parents('tr').css('display','none');
											});
											
											jQuery('#des-tab-select').change(function(){
												jQuery('tr.added').remove();
												jQuery('tr.remover ~ tr.added:eq(0)').remove();
												jQuery('.td-divider').parent().remove();
												jQuery('.input-select').each(function(){
													jQuery(this).parents('tr')
														.before('<tr class="added"><th valign="top" scope="row"><label for="hasicon" class="">Icon ?</label></th><td><form ><input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" value="On" style="cursor:pointer;"> On<input onchange="jQuery(this).parents(\'tr\').find(\'ul.icon_chooser\').toggle(1000);" type="radio" name="hasicon" checked value="Off" style="margin-left:30px;cursor:pointer;"> Off</form><br><span class="des-input-help">If set to <strong style="font-style:normal;">On</strong> you can choose an icon to place before the title from a list of icons. </span><ul class="icon_chooser" style="display:none;"/></td></tr>')
														.addClass('added');
													jQuery(this).find('option').each(function(i){
														jQuery(this).parents('tr').prev('tr').find('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED'); jQuery(this).parents('tr').next('tr').find('.input-text').val(jQuery(this).attr('id'));\" />");
													});
													jQuery(this).parents('tr').css('display','none');
												});
											});
											
											
											jQuery('#des-options').width('100%');
											jQuery('#des-value-icon_color').css('float','left');
											jQuery('input.input-colourpicker').css({ 'float':'left','margin-left':'5px' });
											jQuery('#TB_window').css('overflow','scroll');
											clearInterval(checker);
										}
									}, 100);
									
									
									break;

									
									case 'button':
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
									var checker = setInterval(function(){
										if (jQuery('.select_wrapper').length != 0){
											jQuery('#des-value-icon').parents('.select_wrapper').css('display','none');
										  	jQuery('#des-value-icon').parents('.select_wrapper').after('<ul class="icon_chooser" />');
											jQuery('#des-value-icon > option').each(function(){
												jQuery('.icon_chooser').append("<i id='"+jQuery(this).val()+"' class='icon-"+jQuery(this).val()+"' style='position:relative;float:left;width:30px;height:30px;padding:5px;font-size:30px;cursor:pointer;text-align:center;' onclick=\"jQuery(this).siblings().css('background','none');jQuery(this).css('background','#EDEDED');jQuery('#des-value-icon').val(jQuery(this).attr('id'));\" />");
											});
											jQuery('.icon_chooser').before('<span style="margin-top:7px;" class="des-input-help">The icon will only be visible on the website.</span>');					
											jQuery('#des-options').width('100%');
											if (jQuery('#des-value-enable_icon').val() == "No"){
												jQuery('.icon_chooser').closest('tr').css('display','none');
											}
											
											jQuery('#des-value-enable_icon').change(function(){
												if (jQuery('#des-value-enable_icon').val() == "No"){
													jQuery('.icon_chooser').closest('tr').css('display','none');
												} else jQuery('.icon_chooser').closest('tr').css('display','table-row');
											});
											jQuery('#des-value-bg_color, #des-value-border, #des-value-text_icon_color').css('float','left');
											jQuery('#TB_window').css('overflow','scroll');
											clearInterval(checker);
										}
									}, 100);
									
									break;
							
									case "fullwidth_section":
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
										var checker = setInterval(function(){
											if (jQuery('input.input-colourpicker').length != 0){
												jQuery('#TB_window').css('overflow','scroll');
												if (jQuery('#des-preview').length < 1){
													jQuery('#des-options').width('400px');
												}
												clearInterval(checker);
											}
										}, 100);
										break;
										
									case 'rposts': case 'rposts2':
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
										var rposts_checker = setInterval(function(){
											if (jQuery('#des-options-table').length != 0){
											
												/*scroller*/
												jQuery('#des-value-postsPerRow').closest('tr').css('display','none');
												jQuery('#des-value-rpScroller').change(function(){
													if (jQuery(this).val() == "no") jQuery('#des-value-postsPerRow').closest('tr').css('display','table-row');
													else jQuery('#des-value-postsPerRow').closest('tr').css('display','none');
												});
											
												/*categories*/
												jQuery('#des-value-postsCategories').css('display','none').after('<div class="categories_holder" />');
												if (jQuery('.designare_post_categories').eq(0).children('li').length > 1){
													/*add categories*/
													jQuery('#des-value-postsCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="all" value="All"> All</label>');
													jQuery('.designare_post_categories').eq(0).children('li').each(function(){
														var cat = jQuery(this).html().split('|*|');
														jQuery('#des-value-postsCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="'+cat[0]+'" value="'+cat[1]+'"> '+cat[1]+'</label>');
													});
													
													/*add events*/
													jQuery('#des-value-postsCategories').siblings('.categories_holder').find('input').eq(0).change(function(){
														if (jQuery(this).is(':checked')){
															jQuery(this).closest('.categories_holder').find('input').attr('checked','true');
														}
														else {
															jQuery(this).closest('.categories_holder').find('input').removeAttr('checked'); 	
														}
														jQuery('#des-value-postsCategories').val('all');
													});
													
													jQuery('#des-value-postsCategories').siblings('.categories_holder').children('label').eq(0).siblings().find('input').change(function(){
														var categories = "";
														jQuery('#des-value-postsCategories').siblings('.categories_holder').children('label').eq(0).siblings().each(function(){
															if (jQuery(this).find('input').is(':checked')) categories += jQuery(this).find('input').attr('name') + "|*|";
														});
														jQuery('#des-value-postsCategories').val(categories);
													});
													
																										
												} else {
													jQuery('.categories_holder').html('No defined categories found.');
													jQuery('#des-value-postsCategories').val('all');
												}

											
												jQuery('#TB_window').css('overflow','scroll');
												if (jQuery('#des-preview').length < 1){
													jQuery('#des-options').width('100%');
												}
												clearInterval(rposts_checker);
											}
										}, 300);
										
									break;
									
									case 'rp_style1':
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
										var checkerrpsone = setInterval(function(){
											if (jQuery('#des-value-rpsOneScroller').length != 0){
												
												/*scroller*/
												jQuery('#des-value-proj_per_row').parents('tr').css('display','none');
												jQuery('#des-value-rpsOneScroller').change(function(){
													if (jQuery(this).val() == "no") jQuery('#des-value-proj_per_row').closest('tr').css('display','table-row');
													else jQuery('#des-value-proj_per_row').parents('tr').css('display','none');
												});
											
												/*categories*/
												jQuery('#des-value-projectsCategories').css('display','none').after('<div class="categories_holder" />');
												if (jQuery('.designare_portfolio_categories').eq(0).children('li').length > 1){
													/*add categories*/
													jQuery('#des-value-projectsCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="all" value="All"> All</label>');
													jQuery('.designare_portfolio_categories').eq(0).children('li').each(function(){
														var cat = jQuery(this).html().split('|*|');
														jQuery('#des-value-projectsCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="'+cat[0]+'" value="'+cat[1]+'"> '+cat[1]+'</label>');
													});
													
													/*add events*/
													jQuery('#des-value-projectsCategories').siblings('.categories_holder').find('input').eq(0).change(function(){
														if (jQuery(this).is(':checked')){
															jQuery(this).closest('.categories_holder').find('input').attr('checked','true');
														}
														else {
															jQuery(this).closest('.categories_holder').find('input').removeAttr('checked'); 	
														}
														jQuery('#des-value-projectsCategories').val('all');
													});
													
													jQuery('#des-value-projectsCategories').siblings('.categories_holder').children('label').eq(0).siblings().find('input').change(function(){
														var categories = "";
														jQuery('#des-value-projectsCategories').siblings('.categories_holder').children('label').eq(0).siblings().each(function(){
															if (jQuery(this).find('input').is(':checked')) categories += jQuery(this).find('input').attr('name') + "|*|";
														});
														jQuery('#des-value-projectsCategories').val(categories);
													});
													
																										
												} else {
													jQuery('.categories_holder').html('No defined categories found.');
													jQuery('#des-value-projectsCategories').val('all');
												}
											
												jQuery('#TB_window').css('overflow','scroll');
												if (jQuery('#des-preview').length < 1){
													jQuery('#des-options').width('100%');
												}
												clearInterval(checkerrpsone);
											}
										}, 100);
									break;
									
									case 'rp_style2':
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
										var checker = setInterval(function(){
											if (jQuery('#des-value-rpsTwoScroller').length != 0){
											
												/*scroller*/
												jQuery('#des-value-proj_per_row').closest('tr').css('display','none');
												jQuery('#des-value-rpsTwoScroller').change(function(){
													if (jQuery(this).val() == "no") jQuery('#des-value-proj_per_row').closest('tr').css('display','table-row');
													else jQuery('#des-value-proj_per_row').closest('tr').css('display','none');
												});
												
												/*categories*/
												jQuery('#des-value-projectsCategories').css('display','none').after('<div class="categories_holder" />');
												if (jQuery('.designare_portfolio_categories').eq(0).children('li').length > 1){
													/*add categories*/
													jQuery('#des-value-projectsCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="all" value="All"> All</label>');
													jQuery('.designare_portfolio_categories').eq(0).children('li').each(function(){
														var cat = jQuery(this).html().split('|*|');
														jQuery('#des-value-projectsCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="'+cat[0]+'" value="'+cat[1]+'"> '+cat[1]+'</label>');
													});
													
													/*add events*/
													jQuery('#des-value-projectsCategories').siblings('.categories_holder').find('input').eq(0).change(function(){
														if (jQuery(this).is(':checked')){
															jQuery(this).closest('.categories_holder').find('input').attr('checked','true');
														}
														else {
															jQuery(this).closest('.categories_holder').find('input').removeAttr('checked'); 	
														}
														jQuery('#des-value-projectsCategories').val('all');
													});
													
													jQuery('#des-value-projectsCategories').siblings('.categories_holder').children('label').eq(0).siblings().find('input').change(function(){
														var categories = "";
														jQuery('#des-value-projectsCategories').siblings('.categories_holder').children('label').eq(0).siblings().each(function(){
															if (jQuery(this).find('input').is(':checked')) categories += jQuery(this).find('input').attr('name') + "|*|";
														});
														jQuery('#des-value-projectsCategories').val(categories);
													});
													
																										
												} else {
													jQuery('.categories_holder').html('No defined categories found.');
													jQuery('#des-value-projectsCategories').val('all');
												}
											
												jQuery('#TB_window').css('overflow','scroll');
												if (jQuery('#des-preview').length < 1){
													jQuery('#des-options').width('100%');
												}
												clearInterval(checker);
											}
										}, 100);
									break;
									
									case 'testimonials':
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
										var checker = setInterval(function(){
											if (jQuery('#des-value-testimonialsScroller').length != 0){
											
												/*scroller*/
												jQuery('#des-value-testimonialsPerRow').closest('tr').css('display','none');
												jQuery('#des-value-testimonialsScroller').change(function(){
													if (jQuery(this).val() == "no") jQuery('#des-value-testimonialsPerRow').closest('tr').css('display','table-row');
													else jQuery('#des-value-testimonialsPerRow').closest('tr').css('display','none');
												});
												
												/*categories*/
												jQuery('#des-value-testimonialsCategories').css('display','none').after('<div class="categories_holder" />');
												if (jQuery('.designare_testimonials_categories').eq(0).children('li').length > 1){
													/*add categories*/
													jQuery('#des-value-testimonialsCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="all" value="All"> All</label>');
													jQuery('.designare_testimonials_categories').eq(0).children('li').each(function(){
														var cat = jQuery(this).html().split('|*|');
														jQuery('#des-value-testimonialsCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="'+cat[0]+'" value="'+cat[1]+'"> '+cat[1]+'</label>');
													});
													
													/*add events*/
													jQuery('#des-value-testimonialsCategories').siblings('.categories_holder').find('input').eq(0).change(function(){
														if (jQuery(this).is(':checked')){
															jQuery(this).closest('.categories_holder').find('input').attr('checked','true');
														}
														else {
															jQuery(this).closest('.categories_holder').find('input').removeAttr('checked'); 	
														}
														jQuery('#des-value-testimonialsCategories').val('all');
													});
													
													jQuery('#des-value-testimonialsCategories').siblings('.categories_holder').children('label').eq(0).siblings().find('input').change(function(){
														var categories = "";
														jQuery('#des-value-testimonialsCategories').siblings('.categories_holder').children('label').eq(0).siblings().each(function(){
															if (jQuery(this).find('input').is(':checked')) categories += jQuery(this).find('input').attr('name') + "|*|";
														});
														jQuery('#des-value-testimonialsCategories').val(categories);
													});
													
																										
												} else {
													jQuery('.categories_holder').html('No defined categories found.');
													jQuery('#des-value-testimonialsCategories').val('all');
												}
											
												jQuery('#TB_window').css('overflow','scroll');
												if (jQuery('#des-preview').length < 1){
													jQuery('#des-options').width('100%');
												}
												clearInterval(checker);
											}
										}, 100);
									break;
									
									case 'partners':
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
										var checker = setInterval(function(){
											if (jQuery('#des-value-partnersScroller').length != 0){
											
												jQuery('#des-value-partnersPerRow').closest('tr').css('display','none');
												
												jQuery('#des-value-partnersScroller').change(function(){
													if (jQuery(this).val() == "no") jQuery('#des-value-partnersPerRow').closest('tr').css('display','table-row');
													else jQuery('#des-value-partnersPerRow').closest('tr').css('display','none');
												});
											
												/*categories*/
												jQuery('#des-value-partnersCategories').css('display','none').after('<div class="categories_holder" />');
												if (jQuery('.designare_partners_categories').eq(0).children('li').length > 1){
													/*add categories*/
													jQuery('#des-value-partnersCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="all" value="All"> All</label>');
													jQuery('.designare_partners_categories').eq(0).children('li').each(function(){
														var cat = jQuery(this).html().split('|*|');
														jQuery('#des-value-partnersCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="'+cat[0]+'" value="'+cat[1]+'"> '+cat[1]+'</label>');
													});
													
													/*add events*/
													jQuery('#des-value-partnersCategories').siblings('.categories_holder').find('input').eq(0).change(function(){
														if (jQuery(this).is(':checked')){
															jQuery(this).closest('.categories_holder').find('input').attr('checked','true');
														}
														else {
															jQuery(this).closest('.categories_holder').find('input').removeAttr('checked'); 	
														}
														jQuery('#des-value-partnersCategories').val('all');
													});
													
													jQuery('#des-value-partnersCategories').siblings('.categories_holder').children('label').eq(0).siblings().find('input').change(function(){
														var categories = "";
														jQuery('#des-value-partnersCategories').siblings('.categories_holder').children('label').eq(0).siblings().each(function(){
															if (jQuery(this).find('input').is(':checked')) categories += jQuery(this).find('input').attr('name') + "|*|";
														});
														jQuery('#des-value-partnersCategories').val(categories);
													});
													
																										
												} else {
													jQuery('.categories_holder').html('No defined categories found.');
													jQuery('#des-value-partnersCategories').val('all');
												}
											
												jQuery('#TB_window').css('overflow','scroll');
												if (jQuery('#des-preview').length < 1){
													jQuery('#des-options').width('100%');
												}
												clearInterval(checker);
											}
										}, 100);
									break;
									
									case 'team':
										jQuery( "#des-dialog").remove();
										jQuery( "body").append(b);
										jQuery( "#des-dialog").hide();
										var f=jQuery(window).width();
										b=jQuery(window).height();
										f=720<f?720:f;
										f-=80;
										b-=84;
									
										tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
									
										var checkerTeam = setInterval(function(){

											if (jQuery('#des-value-teamScroller').length != 0){
											
												/*scroller*/
												jQuery('#des-value-teamPerRow').closest('tr').css('display','none');
												jQuery('#des-value-teamScroller').change(function(){
													if (jQuery(this).val() == "no") jQuery('#des-value-teamPerRow').closest('tr').css('display','table-row');
													else jQuery('#des-value-teamPerRow').closest('tr').css('display','none');
												});
											
												/*categories*/
												jQuery('#des-value-teamCategories').css('display','none').after('<div class="categories_holder" />');
												if (jQuery('.designare_team_categories').eq(0).children('li').length > 1){
													/*add categories*/
													jQuery('#des-value-teamCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="all" value="All"> All</label>');
													jQuery('.designare_team_categories').eq(0).children('li').each(function(){
														var cat = jQuery(this).html().split('|*|');
														jQuery('#des-value-teamCategories').siblings('.categories_holder').append('<label style="display:inline-block;"><input type="checkbox" name="'+cat[0]+'" value="'+cat[1]+'"> '+cat[1]+'</label>');
													});
													
													/*add events*/
													jQuery('#des-value-teamCategories').siblings('.categories_holder').find('input').eq(0).change(function(){
														if (jQuery(this).is(':checked')){
															jQuery(this).closest('.categories_holder').find('input').attr('checked','true');
														}
														else {
															jQuery(this).closest('.categories_holder').find('input').removeAttr('checked'); 	
														}
														jQuery('#des-value-teamCategories').val('all');
													});
													
													jQuery('#des-value-teamCategories').siblings('.categories_holder').children('label').eq(0).siblings().find('input').change(function(){
														var categories = "";
														jQuery('#des-value-teamCategories').siblings('.categories_holder').children('label').eq(0).siblings().each(function(){
															if (jQuery(this).find('input').is(':checked')) categories += jQuery(this).find('input').attr('name') + "|*|";
														});
														jQuery('#des-value-teamCategories').val(categories);
													});
													
																										
												} else {
													jQuery('.categories_holder').html('No defined categories found.');
													jQuery('#des-value-teamCategories').val('all');
												}
											
												jQuery('#TB_window').css('overflow','scroll');
												if (jQuery('#des-preview').length < 1){
													jQuery('#des-options').width('100%');
												}
												clearInterval(checkerTeam);
											}
										}, 100);
									break;
							
									default:
									
									jQuery( "#des-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#des-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
									tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+c.title+" Shortcode" );
								
									var checker = setInterval(function(){
										if (jQuery('#des-options').length != 0){
											jQuery('#TB_window').css('overflow','scroll');
											if (jQuery('#des-preview').length < 1){
												jQuery('#des-options').width('100%');
											}
											clearInterval(checker);
										}
									}, 100);
									
								
									break;
									
									
								
								} // End SWITCH Statement
							
							}
													 
						)
						 
						} 
					);
						
					},
					
				createControl:function(d,e){
				
						if(d=="desthemes_shortcodes_button"){
						
							d=e.createMenuButton( "desthemes_shortcodes_button",{
								title:"Insert Designare Shortcode",
								image:icon_url,
								icons:false
								});
								
								var a=this;d.onRenderMenu.add(function(c,b){
								
									a.addWithDialog(b,"Button","button" );
									a.addWithDialog(b,"AddThis","addthis" );
									a.addWithDialog(b,"Icon Font Awesome","ifontawesome" );
									//a.addWithDialog(b,"Icon Designare","ides" );
									a.addWithDialog(b,"Tooltip","tooltip" );
									a.addWithDialog(b,"Title Smartbox Style","title" );
									a.addWithDialog(b,"Section Fullwidth Background","fullwidth_section" );
									b.addSeparator();
									a.addWithDialog(b,"Column Layout","column" );
									c=b.addMenu({title:"Typography"});
										//a.addWithDialog(c,"Headings","headings" );
										a.addWithDialog(c,"Dropcap","dropcap" );
										a.addWithDialog(c,"Quote","quote" );
										a.addWithDialog(c,"Highlight","highlight" );
										a.addWithDialog(c,"Custom Typography","typography" );
										a.addWithDialog(c,"Abbreviation","abbr" );
									a.addWithDialog(b,"Info Box","box" );
									a.addWithDialog(b,"Featured Box","featured_box" );
									b.addSeparator();
									c=b.addMenu({title:"Features"});
										a.addWithDialog(c,"Custom Sidebar","custom_sidebar" );
										a.addWithDialog(c,"Content Toggle","toggle" );
										a.addWithDialog(c,"Pricing Table","pricing_table" );
										a.addWithDialog(c,"Special Tabs","special_tabs" );
										a.addWithDialog(c,"Tabs","tab" );
										a.addWithDialog(c,"Accordion","acc" );
										//a.addWithDialog(c,"Services (Designare Icon)","service" );
										a.addWithDialog(c,"Services Layout","servicefa" );
										a.addWithDialog(c, "Services Balls", "serviceballs");
										a.addWithDialog(c,"Testimonials","testimonials" );
									c=b.addMenu({title:"Percentage Graphs"});
										a.addWithDialog(c,"Donuts Graphic","donuts" );
										a.addWithDialog(c,"Sliding Bars","bars" );
										a.addWithDialog(c,"Numerical Increment","numerical" );
										a.addWithDialog(c,"Circular Diagram","diagram" );
									c=b.addMenu({title:"Contacts"});
										a.addWithDialog(c,"Contact Form","contactform" );
										a.addWithDialog(c,"Google Maps","maps" );
									c=b.addMenu({title:"Media"});
										a.addWithDialog(c,"Images","s_images" );
										a.addWithDialog(c,"Youtube Video","s_video" );
										a.addWithDialog(c,"Vimeo Video","s_vimeo_video" );
										a.addWithDialog(c,"Slider","custom_slider" );
									c=b.addMenu({title:"Recent Posts"});
										a.addWithDialog(c,"Style 1","rposts" );
										a.addWithDialog(c,"Style 2 [NEW]","rposts2" );
									c=b.addMenu({title:"Recent Projects"});
										a.addWithDialog(c,"Style 1","rp_style1" );
										a.addWithDialog(c,"Style 2","rp_style2" );
									a.addWithDialog(b,"Team Layout","team" );
									a.addWithDialog(b,"Partners List","partners" );
									b.addSeparator();
										c=b.addMenu({title:"List Generator"});
											a.addWithDialog(c,"Unordered List","unordered_list" );
											a.addWithDialog(c,"Ordered List","ordered_list" );
										c=b.addMenu({title:"Dividers"});
											a.addImmediate(c,"Simple Line","[single_line_divider]" );
											a.addImmediate(c,"Double Line","[double_line_divider]" );
										c=b.addMenu({title:"Social Buttons"});
											a.addWithDialog(c,"Social Icons","social_icons" );
											a.addWithDialog(c,"Twitter","twitter" );
											a.addWithDialog(c,"Twitter Follow Button","twitter_follow" );
											a.addWithDialog(c,"Digg","digg" );
											a.addWithDialog(c,"Like on Facebook","fblike" );
											a.addWithDialog(c,"Share on Facebook","fbshare" );
											a.addWithDialog(c,"Share on LinkedIn","linkedin_share" );
											a.addWithDialog(c,"Google +1 Button","google_plusone" );
									
								});
							return d
						
						} // End IF Statement
						
						return null
					},
		
				addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}})},
				
				addWithDialog:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "desOpenDialog",false,{title:e,identifier:a})}})},
		
				getInfo:function(){ return{longname:"DesThemes Shortcode Generator",author:"VisualShortcodes.com",authorurl:"http://visualshortcodes.com",infourl:"http://visualshortcodes.com/shortcode-ninja",version:"1.0"} }
			}
		);
		
		tinymce.PluginManager.add( "DesThemesShortcodes",tinymce.plugins.DesThemesShortcodes)
	}
)();

function strip_tags (input, allowed) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Luke Godfrey
    // +      input by: Pul
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +      input by: Alex
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Marc Palau
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Eric Nagel
    // +      input by: Bobby Drake
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Tomasz Wesolowski
    // +      input by: Evertjan Garretsen
    // +    revised by: Rafał Kukawski (http://blog.kukawski.pl/)
    // *     example 1: strip_tags('<p>Kevin</p> <br /><b>van</b> <i>Zonneveld</i>', '<i><b>');
    // *     returns 1: 'Kevin <b>van</b> <i>Zonneveld</i>'
    // *     example 2: strip_tags('<p>Kevin <img src="someimage.png" onmouseover="someFunction()">van <i>Zonneveld</i></p>', '<p>');
    // *     returns 2: '<p>Kevin van Zonneveld</p>'
    // *     example 3: strip_tags("<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>", "<a>");
    // *     returns 3: '<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>'
    // *     example 4: strip_tags('1 < 5 5 > 1');
    // *     returns 4: '1 < 5 5 > 1'
    // *     example 5: strip_tags('1 <br/> 1');
    // *     returns 5: '1  1'
    // *     example 6: strip_tags('1 <br/> 1', '<br>');
    // *     returns 6: '1  1'
    // *     example 7: strip_tags('1 <br/> 1', '<br><br/>');
    // *     returns 7: '1 <br/> 1'
    allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
        commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}

jQuery(document).ready(function(){ jQuery('#content_desthemes_shortcodes_button, #content_desthemes_shortcodes_button img').width(20); });
jQuery(window).load(function(){ jQuery('#content_desthemes_shortcodes_button, #content_desthemes_shortcodes_button img').width(20); });