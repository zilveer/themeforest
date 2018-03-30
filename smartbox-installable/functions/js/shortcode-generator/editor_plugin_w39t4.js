( function() {

	jQuery('.wpb_switch-to-composer').click(function(){ jQuery(window).scroll(); setTimeout(function(){jQuery(window).scroll();}, 100);  });
	
	jQuery('body').append('<div class="shortcode-loader" style="display:none;color:white;font-size: 30px;z-index: 99999999999999;"><i class="icon-spinner icon-spin"></i></div>');
	
	jQuery('html,body').height( jQuery('#wpwrap').height() );
	// TinyMCE plugin start.
    tinymce.PluginManager.add( 'DesThemesShortcodes', function( editor, url ) {
		// Register a command to open the dialog.
		editor.addCommand( 'des_open_dialog', function( ui, v ) {
			desSelectedShortcodeType = v;
			selectedText = editor.selection.getContent({format: 'text'});
			desDialogHelper.loadShortcodeDetails();
			desDialogHelper.setupShortcodeType( v );
			var desSelectedShortcodeTitle = v;

			jQuery( '#des-options' ).addClass( 'shortcode-' + v );

			var f=jQuery(window).width();
			b=jQuery(window).height();
			f=720<f?720:f;
			f-=80;
			b-=84;

			if (desSelectedShortcodeTitle !== "Dropcap" && desSelectedShortcodeTitle !== "Highlight"){
				jQuery('.shortcode-loader').dialog({
					modal:true,
					minHeight: jQuery('#wpwrap').height(),
					resizable: false,
					draggable: false,
					open:function(event,ui){
						jQuery('.ui-widget-overlay').css({
							'position':'fixed',
							'z-index':9999999999999999,
							'background-color':'#000'
						});
						jQuery('.ui-dialog-titlebar').remove();
						jQuery('.shortcode-loader').parent().css({
							'text-align':'center',
							'z-index':999999999999999,
							'background':'transparent',
							'border':'none',
							'display':'block',
							'position':'fixed',
							'top':'50%',
						});
						jQuery('.shortcode-loader i').css({'margin-top':'20px'});
					}
				});

			}
										
			jQuery.get(jQuery('.temppath').html()+"/functions/js/shortcode-generator/dialog.php",function(b){
																		
				var checkLoading = setInterval(function(){
					if (jQuery('#TB_window').length != 0){
						jQuery('.shortcode-loader').dialog('close');
						clearInterval(checkLoading);
					}
				}, 10);	
				
				jQuery( '#des-options').addClass( 'shortcode-' + desSelectedShortcodeType );
				jQuery( '#des-preview').addClass( 'shortcode-' + desSelectedShortcodeType );
				
				// Skip the popup on certain shortcodes.
				switch ( desSelectedShortcodeType ) {
			
					// Highlight
					
					case 'highlight':
				
					var a = '[highlight] Your content here. [/highlight]';
					
					editor.execCommand( "mceInsertContent", false, a);

					jQuery('.shortcode-loader').dialog('close');
				
					break;
					
					// Dropcap
					
					case 'dropcap':
				
					var a = '[dropcap]Your text here.[/dropcap]';
					
					editor.execCommand( "mceInsertContent", false, a);
				
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
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
				
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
					
					case 'ifontawesome':
					
					jQuery( "#des-dialog").remove();
					jQuery( "body").append(b);
					jQuery( "#des-dialog").hide();
					var f=jQuery(window).width();
					b=jQuery(window).height();
					f=720<f?720:f;
					f-=80;
					b-=84;
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
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
					
					case 'unordered_list':
					
					jQuery( "#des-dialog").remove();
					jQuery( "body").append(b);
					jQuery( "#des-dialog").hide();
					var f=jQuery(window).width();
					b=jQuery(window).height();
					f=720<f?720:f;
					f-=80;
					b-=84;
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
					var checker = setInterval(function(){
						if (jQuery('.select_wrapper').length != 0){
							jQuery('.select_wrapper').eq(0).css('display','none');
						  	jQuery('.select_wrapper').eq(0).after('<ul class="icon_chooser" />');
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
						
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
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
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
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
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
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
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
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
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
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
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
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
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
						var rposts_checker = setInterval(function(){
							if (jQuery('#des-options-table').length != 0){
							
								/*scroller*/
								jQuery('#des-value-postsPerRow').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
								
								jQuery('#des-value-autoplay_enabled').change(function(){
									if (jQuery(this).val() === "no"){
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','none');
									} else {
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','table-row');
									}
								});

								jQuery('#des-value-rpScroller').change(function(){
									if (jQuery(this).val() == "no") {
										jQuery('#des-value-postsPerRow').closest('tr').css('display','table-row');	
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
									}
									else {
										jQuery('#des-value-postsPerRow').closest('tr').css('display','none');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','table-row');
										jQuery('#des-value-autoplay_enabled').trigger('change');
									} 
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
						var checkerrpsone = setInterval(function(){
							if (jQuery('#des-value-rpsOneScroller').length != 0){
								
								/*scroller*/
								jQuery('#des-value-autoplay_enabled').change(function(){
									if (jQuery(this).val() === "no"){
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','none');
									} else {
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','table-row');
									}
								});
								
								jQuery('#des-value-proj_per_row').parents('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
								jQuery('#des-value-rpsOneScroller').change(function(){
									if (jQuery(this).val() == "no") {
										jQuery('#des-value-proj_per_row').closest('tr').css('display','table-row');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
									}
									else {
										jQuery('#des-value-proj_per_row').parents('tr').css('display','none');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','table-row');
										jQuery('#des-value-autoplay_enabled').trigger('change');
									}
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
						var checker = setInterval(function(){
							if (jQuery('#des-value-rpsTwoScroller').length != 0){
							
								/*scroller*/
								jQuery('#des-value-autoplay_enabled').change(function(){
									if (jQuery(this).val() === "no"){
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','none');
									} else {
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','table-row');
									}
								});
								
								jQuery('#des-value-proj_per_row').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
								jQuery('#des-value-rpsTwoScroller').change(function(){
									if (jQuery(this).val() == "no") {
										jQuery('#des-value-proj_per_row').closest('tr').css('display','table-row');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
									}
									else {
										jQuery('#des-value-proj_per_row').closest('tr').css('display','none');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','table-row');
										jQuery('#des-value-autoplay_enabled').trigger('change');
									}
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
						var checker = setInterval(function(){
							if (jQuery('#des-value-testimonialsScroller').length != 0){
							
								/*scroller*/
								jQuery('#des-value-testimonialsPerRow').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
								
								jQuery('#des-value-autoplay_enabled').change(function(){
									if (jQuery(this).val() === "no"){
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','none');
									} else {
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','table-row');
									}
								});
								
								jQuery('#des-value-testimonialsScroller').change(function(){
									if (jQuery(this).val() == "no") {
										jQuery('#des-value-testimonialsPerRow').closest('tr').css('display','table-row');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
									}
									else {
										jQuery('#des-value-testimonialsPerRow').closest('tr').css('display','none');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','table-row');
										jQuery('#des-value-autoplay_enabled').trigger('change');
									}
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
						var checker = setInterval(function(){
							if (jQuery('#des-value-partnersScroller').length != 0){
							
								jQuery('#des-value-partnersPerRow').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
								
								jQuery('#des-value-autoplay_enabled').change(function(){
									if (jQuery(this).val() === "no"){
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','none');
									} else {
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','table-row');
									}
								});
								
								jQuery('#des-value-partnersScroller').change(function(){
									if (jQuery(this).val() == "no") {
										jQuery('#des-value-partnersPerRow').closest('tr').css('display','table-row');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
									}
									else {
										jQuery('#des-value-partnersPerRow').closest('tr').css('display','none');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','table-row');
										jQuery('#des-value-autoplay_enabled').trigger('change');
									}
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
					
						tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
					
						var checkerTeam = setInterval(function(){

							if (jQuery('#des-value-teamScroller').length != 0){
							
								/*scroller*/
								jQuery('#des-value-teamPerRow').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
								
								jQuery('#des-value-autoplay_enabled').change(function(){
									if (jQuery(this).val() === "no"){
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','none');
									} else {
										jQuery('#des-value-autoplay_speed').closest('tr').css('display','table-row');
									}
								});

								jQuery('#des-value-teamScroller').change(function(){
									if (jQuery(this).val() == "no") {
										jQuery('#des-value-teamPerRow').closest('tr').css('display','table-row');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','none');
									}
									else {
										jQuery('#des-value-teamPerRow').closest('tr').css('display','none');
										jQuery('#des-value-autoplay_enabled').closest('tr').add(jQuery('#des-value-autoplay_speed').closest('tr')).css('display','table-row');
										jQuery('#des-value-autoplay_enabled').trigger('change');
									}
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
				
					tb_show( "Insert "+ desSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=des-dialog" );jQuery( "#des-options h3:first").text( "Customize the "+desSelectedShortcodeTitle+" Shortcode" );
				
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
			
			});
		});

		// Register a command to insert the shortcode immediately.
		editor.addCommand( 'des_insert_immediate', function( ui, v ) {
			var selected = editor.selection.getContent({format: 'text'});

			// If we have selected text, close the shortcode.
			if ( '' != selected ) {
				selected += '[/' + v + ']';
			}

			editor.insertContent( '[' + v + ']' + selected );
		});

        // Add a button that opens a window
        editor.addButton( 'desthemes_shortcodes_button', {
			type: 'menubutton',
			text: 'Shortcodes',
			icon: 'des-shortcode-icon',
			classes: 'btn des-shortcode-button',
			tooltip: 'Insert a Designare Shortcode',
			menu: [
			
                {text: 'Button', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'button', { title: 'Button' } ); } },
				{text: 'Add This', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'addthis', { title: 'Add This' } ); } },
				{text: 'Icon Font Awesome', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'ifontawesome', { title: 'Icon Font Awesome' } ); } },
				{text: 'Tooltip', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'tooltip', { title: 'Tooltip' } ); } },
				{text: 'Title Smartbox Style', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'title', { title: 'Title Smartbox Style' } ); } },
				{text: 'Fullwidth Section', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'fullwidth_section', { title: 'Fullwidth Section' } ); } },
				{text: 'Columns Layout', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'column', { title: 'Columns Layout' } ); } },
               	// Typography menu.
                {text: 'Typography', menu: [
                	{text: 'Dropcap', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'dropcap', { title: 'Dropcap' } ); } },
                	{text: 'Quote', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'quote', { title: 'Quote' } ); } },
                	{text: 'Highlight', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'highlight', { title: 'Highlight' } ); } },
                	{text: 'Abbreviation', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'abbr', { title: 'Abbreviation' } ); } },
                	{text: 'Custom Typography', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'typography', { title: 'Custom Typography' } ); } }
                ]},

				{text: 'Info Box', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'box', { title: 'Info Box' } ); } },
				{text: 'Featured Box', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'featured_box', { title: 'Featured Box' } ); } },

				// Features menu.
                {text: 'Features', menu: [
					{text: 'Custom Sidebar', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'custom_sidebar', { title: 'Custom Sidebar' } ); } },
					{text: 'Toggle', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'toggle', { title: 'Toggle' } ); } },
					{text: 'Pricing Table', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'pricing_table', { title: 'Pricing Table' } ); } },
					{text: 'Special Tabs', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'special_tabs', { title: 'Special Tabs' } ); } },
					{text: 'Tabs', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'tab', { title: 'Tabs' } ); } },
					{text: 'Accordion', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'acc', { title: 'Accordion' } ); } },
					{text: 'Services Layout', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'servicefa', { title: 'Services Layout' } ); } },
					{text: 'Service Balls', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'serviceballs', { title: 'Service Balls' } ); } },
					{text: 'Testimonials', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'testimonials', { title: 'Testimonials' } ); } }
                ]},

				//Percentage Graphs menu.
				{text: 'Percentage Graphs', menu: [
					{text: 'Donuts Graphic', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'donuts', { title: 'Donuts Graphic' } ); } },
					{text: 'Sliding Bars', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'bars', { title: 'Sliding Bars' } ); } },
					{text: 'Numerical Increment', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'numerical', { title: 'Numerical Increment' } ); } },
					{text: 'Circular Diagram', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'diagram', { title: 'Circular Diagram' } ); } }
				]},
				
				//Contacts menu.
				{text: 'Contacts', menu: [
					{text: 'Contact Form', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'contactform', { title: 'Contact Form' } ); } },
					{text: 'Google Maps', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'maps', { title: 'Google Maps' } ); } }
				]},
				
				//Media menu.
				{text: 'Media', menu: [
					{text: 'Images', onclick: function() { editor.execCommand( 'des_open_dialog', false, 's_images', { title: 'Images' } ); } },
					{text: 'Youtube Video', onclick: function() { editor.execCommand( 'des_open_dialog', false, 's_video', { title: 'Youtube Video' } ); } },
					{text: 'Vimeo Video', onclick: function() { editor.execCommand( 'des_open_dialog', false, 's_vimeo_video', { title: 'Vimeo Video' } ); } },
					{text: 'Custom Slider', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'custom_slider', { title: 'Custom Slider' } ); } }
				]},

				//Recent Posts menu.
				{text: 'Recent Posts', menu: [
					{text: 'Style 1', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'rposts', { title: 'Style 1' } ); } },
					{text: 'Style 2', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'rposts2', { title: 'Style 2' } ); } }
				]},
				
				//Recent Projects menu.
				{text: 'Recent Projects', menu: [
					{text: 'Style 1', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'rp_style1', { title: 'Style 1' } ); } },
					{text: 'Style 2', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'rp_style2', { title: 'Style 2' } ); } }
				]},
				
				{text: 'Team Layout', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'team', { title: 'Team Layout' } ); } },
				{text: 'Partners List', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'partners', { title: 'Partners List' } ); } },
				
				//List Generators menu.
				{text: 'List Generators', menu: [
					{text: 'Unordered List', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'unordered_list', { title: 'Unordered List' } ); } },
					{text: 'Ordered List', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'ordered_list', { title: 'Ordered List' } ); } }
				]},
				
				//Dividers Generators menu.
				{text: 'Dividers Generators', menu: [
					{text: 'Single Line', onclick: function() { editor.execCommand( "mceInsertContent",false, '[single_line_divider]' ); } },
					{text: 'Double Line', onclick: function() { editor.execCommand( "mceInsertContent",false, '[double_line_divider]' ); } }
				]},
				
				//Social Buttons menu.
				{text: 'Social Buttons', menu: [
					{text: 'Social Icons', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'social_icons', { title: 'Social Icons' } ); } },
					{text: 'Twitter', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'twitter', { title: 'Twitter' } ); } },
					{text: 'Twitter Follow Button', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'twitter_follow', { title: 'Twitter Follow Button' } ); } },
					{text: 'Digg Button', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'digg', { title: 'Digg Button' } ); } },
					{text: 'Like on Facebook', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'fblike', { title: 'Like on Facebook' } ); } },
					{text: 'Share on Facebook', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'fbshare', { title: 'Share on Facebook' } ); } },
					{text: 'Share on LinkedIn', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'linkedin_share', { title: 'Share on LinkedIn' } ); } },
					{text: 'Google +1 Button', onclick: function() { editor.execCommand( 'des_open_dialog', false, 'google_plusone', { title: 'Google +1 Button' } ); } }	
				]},
            ]
        });
    } ); // TinyMCE plugin end.
} )();