jQuery(document).ready(function($){
	//upload
	$("[name='medicenter_upload_button']").live('click', function(){
		var self = $(this);
		
		wp.media.frames.selectImageFrame=wp.media(
		{
			multiple		:	false,
			library			: 
			{
			   type			:	'image',
			}
		});

		wp.media.frames.selectImageFrame.open();

		wp.media.frames.selectImageFrame.on('select',function()
		{
			var selection=wp.media.frames.selectImageFrame.state().get('selection');

			if(!selection) return;

			selection.each(function(attachment)
			{
				var url=attachment.attributes.url;
				self.prev().val(url);
				if(self.prev().prev("input[name*='attachment_ids']").length)
					self.prev().prev("input[name*='attachment_ids']").val(attachment.id);
			});
		});
		return false;
	});
	if($("#medicenter-options-tabs").length)
		$("#medicenter-options-tabs").tabs({
			selected: $("#medicenter-options-tabs #medicenter-selected-tab").val()
		});
	$("#medicenter_add_new_button").click(function(){
		$(this).parent().before($(this).parent().prev().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1));
		$(".slider_image_url_row:last [id^='medicenter_slider_image_url_'][type='text']").attr("id", "medicenter_slider_image_url_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_url_row:last [id^='medicenter_slider_image_url_'][type='button']").attr("id", "medicenter_slider_image_url_button_" + $(".slider_image_url_row").length);
		$(".slider_image_title_row:last [id^='medicenter_slider_image_title_'][type='text']").attr("id", "medicenter_slider_image_title_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_subtitle_row:last [id^='medicenter_slider_image_subtitle_'][type='text']").attr("id", "medicenter_slider_image_subtitle_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_link_row:last [id^='medicenter_slider_image_link_'][type='text']").attr("id", "medicenter_slider_image_link_" + $(".slider_image_link_row").length).val('');
	});
	$("#medicenter_add_new_button_image").click(function(){
		$(this).parent().parent().before($(this).parent().parent().prev().prev().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".image_url_row").length, $(".image_url_row").length+1)+$(this).parent().parent().prev().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".image_url_row").length, $(".image_url_row").length+1)+$(this).parent().parent().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".image_url_row").length, $(".image_url_row").length+1)+$(this).parent().parent().prev().prev().clone().wrap('<div>').parent().html().replace($(".image_url_row").length, $(".image_url_row").length+1)+$(this).parent().parent().prev().clone().wrap('<div>').parent().html().replace($(".image_url_row").length, $(".image_url_row").length+1));
		$(".image_url_row:last [id^='medicenter_attachment_id_'][type='hidden']").attr("id", "medicenter_attachment_id_" + $(".image_url_row").length).val('');
		$(".image_url_row:last [id^='medicenter_image_url_'][type='text']").attr("id", "medicenter_image_url_" + $(".image_url_row").length).val('');
		$(".image_url_row:last [id^='medicenter_image_url_'][type='button']").attr("id", "medicenter_image_url_button_" + $(".image_url_row").length);
		$(".image_title_row:last [id^='medicenter_image_title_'][type='text']").attr("id", "medicenter_image_title_" + $(".image_url_row").length).val('');
		$(".video_row:last [id^='medicenter_video_'][type='text']").attr("id", "medicenter_video_" + $(".image_url_row").length).val('');
		$(".iframe_row:last [id^='medicenter_iframe_'][type='text']").attr("id", "medicenter_iframe_" + $(".image_url_row").length).val('');
		$(".external_url_row:last [id^='medicenter_external_url_'][type='text']").attr("id", "medicenter_external_url_" + $(".image_url_row").length).val('');
	});
	$(".medicenter_add_new_repeated_row").click(function(){
		var selfId = $(this).attr("id");
		var re = new RegExp($("." + selfId).length,"g");
		$(this).parent().parent().before($(this).parent().parent().prev().clone().wrap('<div>').parent().html().replace(re, $("." + selfId).length+1));
		$("." + selfId + ".repeated_row_" + $("." + selfId).length + " input[type='text'], ." + selfId + ".repeated_row_" + $("." + selfId).length + " select").val('');
	});
	//departments hours
	$("#add_department_hours").click(function(event){
		event.preventDefault();
		if($("#start_hour").val()!='' && $("#end_hour").val()!='')
		{
			var doctorsString = "", doctorsStringId = "";
			var doctorsLength = $("#department_hour_doctors :selected").length;
			var doctors = $("#department_hour_doctors :selected").each(function(index){
				doctorsString += $(this).text() + (index+1<doctorsLength ? "," : "");
				doctorsStringId += $(this).val() + (index+1<doctorsLength ? "," : "");
			});
			var detailsDiv = "";
			if($("#tooltip").val()!="" || $("#before_hour_text").val()!="" || $("#after_hour_text").val()!="" || doctorsString!="" || $("#department_hour_category").val()!="")
			{
				detailsDiv = '<div>';
				if($("#tooltip").val()!="")
					detailsDiv += '<br /><strong>Tooltip:</strong> ' + $("#tooltip").val();
				if($("#before_hour_text").val()!="")
					detailsDiv += '<br /><strong>Before hour text:</strong> ' + $("#before_hour_text").val();
				if($("#after_hour_text").val()!="")
					detailsDiv += '<br /><strong>After hour text:</strong> ' + $("#after_hour_text").val();
				if(doctorsString)
					detailsDiv += '<br /><strong>Doctors:</strong> ' + doctorsString;
				if($("#department_hour_category").val()!="")
					detailsDiv += '<br /><strong>Category:</strong> ' + $("#department_hour_category").val();
				detailsDiv += '</div>';
			}
			$("#department_hours_list").css("display", "block").append('<li>' + $("#weekday_id :selected").html() + ' ' + $("#start_hour").val() + "-" + $("#end_hour").val() + '<input type="hidden" name="weekday_ids[]" value="' + $("#weekday_id").val() + '" /><input type="hidden" name="start_hours[]" value="' + $("#start_hour").val() + '" /><input type="hidden" name="end_hours[]" value="' + $("#end_hour").val() + '" /><input type="hidden" name="tooltips[]" value="' + $("#tooltip").val() + '" /><input type="hidden" name="department_hours_category[]" value="' + $("#department_hour_category").val() + '" /><input type="hidden" name="before_hour_texts[]" value="' + $("#before_hour_text").val() + '" /><input type="hidden" name="after_hour_texts[]" value="' + $("#after_hour_text").val() + '" /><input type="hidden" name="department_hours_doctors[]" value="' + doctorsStringId + '" /><img class="operation_button delete_button" src="' + config.img_url + 'delete.png" alt="del" />' + detailsDiv + '</li>');
			$("#start_hour, #end_hour, #tooltip, #before_hour_text, #after_hour_text, #department_hour_doctors, #department_hour_category").val("");
			$("#weekday_id :first").attr("selected", "selected");
			if($("#add_department_hours").val()=="Edit")
			{
				$("#add_department_hours").val("Add");
				$("#department_hours_" + $("#department_hours_id").val() + " .delete_button").trigger("click");
				$("#department_hours_id").remove();
			}
		}
	});
	$("#department_hours_list .delete_button").live("click", function(event){
		if(typeof($(this).parent().attr("id"))!="undefined")
			$("#department_hours_list").after('<input type="hidden" name="delete_department_hours_ids[]" value="' + $(this).parent().attr("id").substr(17) + '" />');
		$(this).parent().remove();
		if(!$("#department_hours_list li").length)
			$("#department_hours_list").css("display", "none");
	});
	$("#department_hours_list .edit_button").live("click", function(event){
		if(typeof($(this).parent().attr("id"))!="undefined")
		{
			var loader = $(this).next(".edit_hour_department_loader");
			var id = $(this).parent().attr("id").substr(17);
			loader.css("display", "inline");
			$.ajax({
					url: ajaxurl,
					type: 'post',
					dataType: 'html',
					data: {
						action: 'get_department_hour_details',
						id: id,
						post_id: $("#post_ID").val()
					},
					success: function(json){
						var indexStart = json.indexOf("department_hour_start")+21;
						var indexEnd = json.indexOf("department_hour_end")-indexStart;
						json = $.parseJSON(json.substr(indexStart, indexEnd));
						$("#department_hours_table #weekday_id").val(json.weekday_id);
						$("#department_hours_table #start_hour").val(json.start);
						$("#department_hours_table #end_hour").val(json.end);
						$("#department_hours_table #tooltip").val(json.tooltip);
						$("#before_hour_text").val(json.before_hour_text);
						$("#after_hour_text").val(json.after_hour_text);
						$("#department_hour_doctors").val(json.doctors.split(","));
						$("#department_hour_category").val(json.category);
						$("#department_hours_id").remove();
						$("#department_hours_table #add_department_hours").after("<input type='hidden' id='department_hours_id' name='department_hours_id' value='" + id + "' />");
						loader.css("display", "none");
						var offset = $("#department_hours_table").offset();
						$("html, body").animate({scrollTop: offset.top-30}, 400);
						$("#add_department_hours").val("Edit");
					}
			});
		}
	});
	//theme options
	$(window).bind("hashchange", function(event){
		if($.isFunction($.param.fragment) && $.param.fragment()!="")
		{
			var hash = decodeURIComponent($.param.fragment());
			hashSplit = hash.split("_");
			var id1, id2=null;
			if(hashSplit.length>1)
			{
				id1 = hashSplit[0];
				id2 = hash;
			}
			else
				id1 = hash;
			var tab = $('.theme_options .menu [href="#' + id1 + '"]');
			$(".theme_options .menu a").removeClass("selected");
			tab.addClass("selected");
			if(id2!=null)
			{
				$('.theme_options .submenu a').removeClass("selected");
				$('.theme_options .submenu [href="#' + id2 + '"]').addClass("selected");
			}
			$(".theme_options .submenu, .theme_options .subsettings").css("display", "none");
			tab.next(".submenu").css("display", "block");
			$(".theme_options .settings").css("display", "none");
			$('.theme_options #' + id1).css("display", "block");
			if(id2!=null)
				$('.theme_options #' + id2).css("display", "block");
			else if(tab.next(".submenu").length)
			{
				$('.theme_options .submenu a').removeClass("selected");
				$('.theme_options .menu [href="#' + id1 + '"]+.submenu li:first a').addClass("selected");
				$('.theme_options #' + id1 + " .subsettings:first").css("display", "block");
			}
		}
	}).trigger("hashchange");
	$('.theme_options .menu a').click(function(){
		$.bbq.pushState($(this).attr("href"));
	});
	$("#theme-options-panel").submit(function(event){
		event.preventDefault();
		var self = $(this);
		var data = self.serializeArray();
		$("#theme_options_preloader").css("display", "block");
		$("#theme_options_tick").css("display", "none");
		$.ajax({
				url: ajaxurl,
				type: 'post',
				dataType: 'json',
				data: data,
				success: function(json){
					$("#theme_options_preloader").css("display", "none");
					$("#theme_options_tick").css("display", "block");
					if($("#slider_id").val()!="")
					{
						if(!$("#edit_slider_id option[value='medicenter_slider_settings_" + $("#slider_id").val() + "']").length)
						{
							$("#edit_slider_id").append($("<option></option>").attr("value", "medicenter_slider_settings_" + $("#slider_id").val()).text($("#slider_id").val()));
							$("#edit_slider_id option[value='medicenter_slider_settings_" + $("#slider_id").val() + "']").attr("selected", "selected")
						}
					}
				}
		});
	});
	$('.theme_options #header_layout_type').change(function(){
		if(parseInt($(this).val())==2)
			$(".theme_options #header_top_right_sidebar_container").css("display", "inline");
		else
		{
			$(".theme_options #header_top_right_sidebar_container").css("display", "none");
			$(".theme_options #header_top_right_sidebar").val("");
		}
	});
	//dummy content import
	$("#import_dummy").click(function(event){
		event.preventDefault();
		$("#dummy_content_tick").css("display", "none");
		$("#dummy_content_preloader").css("display", "inline");
		$("#dummy_content_info").html("Please wait and don't reload the page when import is in progress!");
		var version = $("#import_dummy_version").val();
		$.ajax({
				url: ajaxurl,
				type: 'post',
				//dataType: 'json',
				data: "version=" + version + "&action=medicenter_import_dummy",
				success: function(json){
					json = $.trim(json);
					var indexStart = json.indexOf("dummy_import_start")+18;
					var indexEnd = json.indexOf("dummy_import_end")-indexStart;
					json = $.parseJSON(json.substr(indexStart, indexEnd));
					$.ajax({
							url: ajaxurl,
							type: 'post',
							//dataType: 'json',
							data: "version=" + version + "&action=medicenter_import_dummy2",
							success: function(jsonSecond){
								jsonSecond = $.trim(jsonSecond);
								var indexStart = jsonSecond.indexOf("dummy_import_start")+18;
								var indexEnd = jsonSecond.indexOf("dummy_import_end")-indexStart;
								jsonSecond = $.parseJSON(jsonSecond.substr(indexStart, indexEnd));
								$("#dummy_content_preloader").css("display", "none");
								$("#dummy_content_tick").css("display", "inline");
								if(version!="blue")
								{
									version = version.replace("_no_animations", "");
									$("#logo_url").val($("#logo_url").val().replace("blue", version));
									$("#color_scheme").val(version).trigger("change");
									$("#theme-options-panel").trigger("submit");
								}
								$("#dummy_content_info").html(json.info + (jsonSecond.info!="" ? "<br><br>" : "") + jsonSecond.info);
							},
							error: function(jqXHR, textStatus, errorThrown){
								$("#dummy_content_preloader").css("display", "none");
								$("#dummy_content_info").html("Error during import:<br>" + jqXHR + "<br>" + textStatus + "<br>" + errorThrown);
								console.log(jqXHR);
								console.log(textStatus);
								console.log(errorThrown);
							}
					});
				},
				error: function(jqXHR, textStatus, errorThrown){
					$("#dummy_content_preloader").css("display", "none");
					$("#dummy_content_info").html("Error during import:<br>" + jqXHR + "<br>" + textStatus + "<br>" + errorThrown);
				}
		});
	});
	$("#import_shop_dummy").click(function(event){
		event.preventDefault();
		$("#dummy_shop_content_tick").css("display", "none");
		$("#dummy_shop_content_preloader").css("display", "inline");
		$("#dummy_shop_content_info").html("Please wait and don't reload the page when import is in progress!");
		$.ajax({
				url: ajaxurl,
				type: 'post',
				//dataType: 'json',
				data: "action=medicenter_import_shop_dummy",
				success: function(json){
					json = $.trim(json);
					var indexStart = json.indexOf("dummy_import_start")+18;
					var indexEnd = json.indexOf("dummy_import_end")-indexStart;
					json = $.parseJSON(json.substr(indexStart, indexEnd));
					$("#dummy_shop_content_preloader").css("display", "none");
					$("#dummy_shop_content_tick").css("display", "inline");
					$("#dummy_shop_content_info").html(json.info);
				},
				error: function(jqXHR, textStatus, errorThrown){
					$("#dummy_shop_content_preloader").css("display", "none");
					$("#dummy_shop_content_info").html("Error during import:<br>" + jqXHR + "<br>" + textStatus + "<br>" + errorThrown);
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);
				}
		});
	});
	//reset slider fields
	var resetSliderFields = function()
	{
		$('#tab-slider :input, #tab-slider select').not(':button, :submit, :reset, :hidden').val('').removeAttr('checked').removeAttr('selected');
		$('#tab-slider #slide_interval').val(5000);
		$('#tab-slider #slider_transition_speed').val(750);
	}
	resetSliderFields();
	$("#edit_slider_id").change(function(){
		if($(this).val()!="-1")
		{
			var id = $("#edit_slider_id :selected").text();
			$("#slider_id").val(id).trigger("paste");
			$("#slider_ajax_loader").css("display", "inline");
			$.ajax({
					url: ajaxurl,
					type: 'post',
					dataType: 'html',
					data: {
						action: 'slider_get_settings',
						id: id
					},
					success: function(json){
						json = $.trim(json);
						var indexStart = json.indexOf("slider_start")+12;
						var indexEnd = json.indexOf("slider_end")-indexStart;
						json = $.parseJSON(json.substr(indexStart, indexEnd));
						if(json.slider_image_url.length>3)
						{
							for(var i=3; i<json.slider_image_url.length; i++)
								$("#medicenter_add_new_button").trigger("click");
						}		
						$.each(json, function(key, val){
							if(key=="slider_image_url")
							{
								$("[name='slider_image_url[]']").each(function(index){
									$(this).val(val[index]);
								});
							}
							else if(key=="slider_image_title")
							{
								$("[name='slider_image_title[]']").each(function(index){
									$(this).val(val[index]);
								});
							}
							else if(key=="slider_image_subtitle")
							{
								$("[name='slider_image_subtitle[]']").each(function(index){
									$(this).val(val[index]);
								});
							}
							else if(key=="slider_image_link")
							{
								$("[name='slider_image_link[]']").each(function(index){
									$(this).val(val[index]);
								});
							}
							else
								$("#" + key).val(val);
						});
						$("#slider_ajax_loader").css("display", "none");
						$("#slider_delete_button").css("display", "inline");
					}
			});
		}
		else
		{
			resetSliderFields();
			$("#slider_delete_button").css("display", "none");
		}
	});
	$("#slider_delete_button").click(function(){
		var id = $("#edit_slider_id").val();
		$("#slider_delete_button").css("display", "none");
		$("#slider_ajax_loader").css("display", "inline");
		$.ajax({
					url: ajaxurl,
					type: 'post',
					dataType: 'html',
					data: {
						action: 'slider_delete',
						id: id
					},
					success: function(data){
						data = $.trim(data);
						var indexStart = data.indexOf("slider_start")+12;
						var indexEnd = data.indexOf("slider_end")-indexStart;
						data = data.substr(indexStart, indexEnd);
						if(parseInt(data)==1)
						{
							$("#edit_slider_id [value='" + id + "']").remove();
							resetSliderFields();
							$("#slider_ajax_loader").css("display", "none");
						}
					}
		});
	});
	//colorpicker
	if($(".color").length)
	{
		$(".color").ColorPicker({
			onChange: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).prev(".color_preview").css("background-color", "#" + hex);
			},
			onSubmit: function(hsb, hex, rgb, el){
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function (){
				var color = (this.value!="" ? this.value : $(this).attr("data-default-color"));
				$(this).ColorPickerSetColor(color);
				$(this).prev(".color_preview").css("background-color", color);
			}
		}).on('keyup', function(event, param){
			$(this).ColorPickerSetColor(this.value);
			
			var default_color = ($("#color_scheme").val()!="blue" && typeof($(this).attr("data-default-color-" + $("#color_scheme").val()))!="undefined" ? $(this).attr("data-default-color-" + $("#color_scheme").val()) : $(this).attr("data-default-color"));
			$(this).prev(".color_preview").css("background-color", (this.value!="none" ? (this.value!="" ? "#" + (typeof(param)=="undefined" ? $(".colorpicker:visible .colorpicker_hex input").val() : this.value) : (default_color!="transparent" ? "#" + default_color : default_color)) : "transparent"));
		});
	}
	//color scheme
	$("#color_scheme").change(function(){
		var self = $(this);
		$("#tab-colors .color").val("").trigger("keyup", [1]);
		if(self.val()!="blue")
			$("#tab-colors [data-default-color-" + self.val() + "]").each(function(){
				$(this).val($(this).attr("data-default-color-" + self.val())).trigger("keyup", [1]);
			});
	});
	//google font subset
	$("#header_font, #subheader_font").change(function(event, param){
		var self = $(this);
		if(self.val()!="")
		{
			self.parent().find(".theme_font_subset_preloader").css("display", "inline-block");
			$.ajax({
					url: ajaxurl,
					type: 'post',
					data: "action=medicenter_get_font_subsets&font=" + $(this).val(),
					success: function(data){
						data = $.trim(data);
						var indexStart = data.indexOf("mc_start")+8;
						var indexEnd = data.indexOf("mc_end")-indexStart;
						data = data.substr(indexStart, indexEnd);
						self.parent().find(".theme_font_subset_preloader").css("display", "none");
						self.parent().find(".font_subset").css("display", "block");
						self.parent().find("select.font_subset").html(data)
					}
			});
		}
		else
			self.parent().find(".font_subset").css("display", "none").find("option").remove();
	});
	//upcoming classes widget
	$("#upcoming_classes_time_from").live("change", function(){
		$(this).parent().next().css("display", ($(this).val()=="server" ? "block" : "none"));
	});
	//sidebars for templates
	$("#post #page_template").change(function(){
		var html = "";
		$("#mc_sidebars, #mc_slider").remove();
		if($(this).val()=="template-home.php")
		{
			html += "<div id='mc_slider'><p><strong>" + config.slider_label + "</strong></p>";
			if(config.theme_sliders.length)
			{
				html += "<select id='main_slider' name='main_slider'>";
				for(var i=0; i<config.theme_sliders.length; i++)
					html += "<option value='" + config.theme_sliders[i] + "'" + (config.theme_sliders[i]==config.main_slider ? " selected='selected'" : "") + ">" + config.theme_sliders[i].substr(27) + "</option>";
				html += "</select>";
			}
			else
				html += "Create slider <a href='themes.php?page=ThemeOptions#tab-slider'>here</a>";
			html += "</div>";
		}
		if(config.sidebars[$(this).val()].length)
		{
			html += "<div id='mc_sidebars'>";
			for(var i=0; i<config.sidebars[$(this).val()].length; i++)
			{
				html += "<p><strong>" + config.sidebar_label + " " + config.sidebars[$(this).val()][i]["label"] + "</strong></p>";
				html += "<select id='page_sidebar_" + i + "' name='page_sidebar_" + config.sidebars[$(this).val()][i]["name"] + "'>";
				for(var j=0; j<config.theme_sidebars.length; j++)
					html += "<option value='" + config.theme_sidebars[j]["id"] + "'" + (config.theme_sidebars[j]["id"]==config.page_sidebars[i] ? " selected='selected'" : "") + ">" + config.theme_sidebars[j]["title"] + "</option>";
				html += "</select>";
			}
			html += "</div>";
		}
		$(this).after(html);
	}).trigger("change");
});