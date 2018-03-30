jQuery(document).ready(function($){
	//upload
	$("[name='gymbase_upload_button']").on('click', function(){
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
			});
		});
		return false;
	});
	if($("#gymbase-options-tabs").length)
		$("#gymbase-options-tabs").tabs({
			selected: $("#gymbase-options-tabs #gymbase-selected-tab").val()
		});
	$("#gymbase_add_new_button").click(function(){
		$(this).parent().before($(this).parent().prev().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1));
		$(".slider_image_url_row:last [id^='gymbase_slider_image_url_'][type='text']").attr("id", "gymbase_slider_image_url_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_url_row:last [id^='gymbase_slider_image_url_'][type='button']").attr("id", "gymbase_slider_image_url_button_" + $(".slider_image_url_row").length);
		$(".slider_image_title_row:last [id^='gymbase_slider_image_title_'][type='text']").attr("id", "gymbase_slider_image_title_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_subtitle_row:last [id^='gymbase_slider_image_subtitle_'][type='text']").attr("id", "gymbase_slider_image_subtitle_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_link_row:last [id^='gymbase_slider_image_link_'][type='text']").attr("id", "gymbase_slider_image_link_" + $(".slider_image_link_row").length).val('');
	});
	$("#gymbase_add_new_icon_button").click(function(){
		$(this).parent().before($(this).parent().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".social_icon_type_row").length, $(".social_icon_type_row").length+1)+$(this).parent().prev().prev().clone().wrap('<div>').parent().html().replace($(".social_icon_type_row").length, $(".social_icon_type_row").length+1)+$(this).parent().prev().clone().wrap('<div>').parent().html().replace($(".social_icon_type_row").length, $(".social_icon_type_row").length+1));
		$(".social_icon_type_row:last select[id^='gymbase_social_icon_type_']").attr("id", "gymbase_social_icon_type_" + $(".social_icon_type_row").length).val($(".social_icon_type_row:last select[id^='gymbase_social_icon_type_'] option:first").val());		
		$(".social_icon_url_row:last [id^='gymbase_social_icon_url_'][type='text']").attr("id", "gymbase_social_icon_url_" + $(".social_icon_url_row").length).val('');
		$(".social_icon_target_row:last select[id^='gymbase_social_icon_target_']").attr("id", "gymbase_social_icon_target_" + $(".social_icon_target_row").length).val($(".social_icon_target_row:last select[id^='gymbase_social_icon_target_'] option:first").val());
		
	});
	//classes hours
	$("#add_class_hours").click(function(event){
		event.preventDefault();
		if($("#start_hour").val()!='' && $("#end_hour").val()!='')
		{
			var trainersString = "", trainersStringId = "";
			var trainersLength = $("#class_hour_trainers :selected").length;
			var trainers = $("#class_hour_trainers :selected").each(function(index){
				trainersString += $(this).text() + (index+1<trainersLength ? "," : "");
				trainersStringId += $(this).val() + (index+1<trainersLength ? "," : "");
			});
			var detailsDiv = "";
			if($("#tooltip").val()!="" || $("#before_hour_text").val()!="" || $("#after_hour_text").val()!="" || trainersString!="" || $("#class_hour_category").val()!="")
			{
				detailsDiv = '<div>';
				if($("#tooltip").val()!="")
					detailsDiv += '<br /><strong>Tooltip:</strong> ' + $("#tooltip").val();
				if($("#before_hour_text").val()!="")
					detailsDiv += '<br /><strong>Before hour text:</strong> ' + $("#before_hour_text").val();
				if($("#after_hour_text").val()!="")
					detailsDiv += '<br /><strong>After hour text:</strong> ' + $("#after_hour_text").val();
				if(trainersString)
					detailsDiv += '<br /><strong>Trainers:</strong> ' + trainersString;
				if($("#class_hour_category").val()!="")
					detailsDiv += '<br /><strong>Category:</strong> ' + $("#class_hour_category").val();
				detailsDiv += '</div>';
			}
			$("#class_hours_list").css("display", "block").append('<li>' + $("#weekday_id :selected").html() + ' ' + $("#start_hour").val() + "-" + $("#end_hour").val() + '<input type="hidden" name="weekday_ids[]" value="' + $("#weekday_id").val() + '" /><input type="hidden" name="start_hours[]" value="' + $("#start_hour").val() + '" /><input type="hidden" name="end_hours[]" value="' + $("#end_hour").val() + '" /><input type="hidden" name="tooltips[]" value="' + $("#tooltip").val() + '" /><input type="hidden" name="class_hours_category[]" value="' + $("#class_hour_category").val() + '" /><input type="hidden" name="before_hour_texts[]" value="' + $("#before_hour_text").val() + '" /><input type="hidden" name="after_hour_texts[]" value="' + $("#after_hour_text").val() + '" /><input type="hidden" name="class_hours_trainers[]" value="' + trainersStringId + '" /><img class="operation_button delete_button" src="' + config.img_url + 'delete.png" alt="del" />' + detailsDiv + '</li>');
			$("#start_hour, #end_hour, #tooltip, #before_hour_text, #after_hour_text, #class_hour_trainers, #class_hour_category").val("");
			$("#weekday_id :first").attr("selected", "selected");
			if($("#add_class_hours").val()=="Edit")
			{
				$("#add_class_hours").val("Add");
				$("#class_hours_" + $("#class_hours_id").val() + " .delete_button").trigger("click");
				$("#class_hours_id").remove();
			}
		}
	});
	$("#class_hours_list .delete_button").live("click", function(event){
		if(typeof($(this).parent().attr("id"))!="undefined")
			$("#class_hours_list").after('<input type="hidden" name="delete_class_hours_ids[]" value="' + $(this).parent().attr("id").substr(12) + '" />');
		$(this).parent().remove();
		if(!$("#class_hours_list li").length)
			$("#class_hours_list").css("display", "none");
	});
	$("#class_hours_list .edit_button").live("click", function(event){
		if(typeof($(this).parent().attr("id"))!="undefined")
		{
			var loader = $(this).next(".edit_hour_class_loader");
			var id = $(this).parent().attr("id").substr(12);
			loader.css("display", "inline");
			$.ajax({
					url: ajaxurl,
					type: 'post',
					dataType: 'html',
					data: {
						action: 'get_class_hour_details',
						id: id,
						post_id: $("#post_ID").val()
					},
					success: function(json){
						var indexStart = json.indexOf("class_hour_start")+16;
						var indexEnd = json.indexOf("class_hour_end")-indexStart;
						json = $.parseJSON(json.substr(indexStart, indexEnd));
						$("#class_hours_table #weekday_id").val(json.weekday_id);
						$("#class_hours_table #start_hour").val(json.start);
						$("#class_hours_table #end_hour").val(json.end);
						$("#class_hours_table #tooltip").val(json.tooltip);
						$("#before_hour_text").val(json.before_hour_text);
						$("#after_hour_text").val(json.after_hour_text);
						$("#class_hour_trainers").val(json.trainers.split(","));
						$("#class_hour_category").val(json.category);
						$("#class_hours_id").remove();
						$("#class_hours_table #add_class_hours").after("<input type='hidden' id='class_hours_id' name='class_hours_id' value='" + id + "' />");
						loader.css("display", "none");
						var offset = $("#class_hours_table").offset();
						$("html, body").animate({scrollTop: offset.top-30}, 400);
						$("#add_class_hours").val("Edit");
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
				}
		});
	});
	//dummy content import
	$("#import_dummy").click(function(event){
		event.preventDefault();
		$("#dummy_content_tick").css("display", "none");
		$("#dummy_content_preloader").css("display", "inline");
		$("#dummy_content_info").html("Please wait and don't reload the page when import is in progress!");
		$.ajax({
				url: ajaxurl,
				type: 'post',
				//dataType: 'json',
				data: "action=gymbase_import_dummy",
				success: function(json){
					json = $.trim(json);
					var indexStart = json.indexOf("dummy_import_start")+18;
					var indexEnd = json.indexOf("dummy_import_end")-indexStart;
					json = $.parseJSON(json.substr(indexStart, indexEnd));
					$("#dummy_content_preloader").css("display", "none");
					$("#dummy_content_tick").css("display", "inline");
					$("#dummy_content_info").html(json.info);
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
				data: "action=gymbase_import_shop_dummy",
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
		}).on('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
			var default_color = $(this).attr("data-default-color");
			$(this).prev(".color_preview").css("background-color", (this.value!="none" ? (this.value!="" ? "#" + (typeof(param)=="undefined" ? $(".colorpicker:visible .colorpicker_hex input").val() : this.value) : (default_color!="transparent" ? "#" + default_color : default_color)) : "transparent"));
		});
	}
	//google font subset
	$("#header_font, #subheader_font").change(function(event, param){
		var self = $(this);
		if(self.val()!="")
		{
			self.parent().find(".theme_font_subset_preloader").css("display", "inline-block");
			$.ajax({
					url: ajaxurl,
					type: 'post',
					data: "action=gymbase_get_font_subsets&font=" + $(this).val(),
					success: function(data){
						data = $.trim(data);
						var indexStart = data.indexOf("gb_start")+8;
						var indexEnd = data.indexOf("gb_end")-indexStart;
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
});