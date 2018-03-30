post_page = ThemeAjax.ajaxurl;
function check_nan(element, element_value, max_value)
	{
		var len = element_value.length;
		if(isNaN(element_value))
			{
				alert("Only number vlues are allow in this input.");
				element.value = element_value.substring(0, (len/1)-1);
			}

		if(max_value && ((element_value/1) > (max_value/1)))
			{
				alert("The maximum value allowed for this input is "+max_value);
				element.value = max_value;
			}
	}
function check_linked(this_id, link_id)
	{
		this_id = "#"+this_id;
		link_div_id = "#"+link_id+"_div";
		link_id = "#"+link_id;

		if(jQuery(this_id).attr("value") !== "0")
			{
				jQuery(link_div_id).slideUp();
				jQuery(link_id).attr("disabled", "true");
			}
		else
			{
				jQuery(link_div_id).slideDown();
				jQuery(link_id).removeAttr("disabled");
			}

	}
jQuery(document).ready(function()
	{
		if(jQuery.isFunction(jQuery.fn.wpColorPicker)){
			jQuery("input[id*='colour'], input[id*='color']").each(function(){
				if ( -1 == jQuery(this).attr("id").toString().indexOf('_color_clear') && -1 == jQuery(this).attr("id").toString().indexOf('admin_color') ){
					jQuery(this).wpColorPicker();
				}
			})
		}
		jQuery("#ocmx-options").submit(function(){
			formvalues = jQuery("#ocmx-options").serialize();
			jQuery("#content-block").animate({opacity: 0.50}, 500)

			if(document.getElementById("ocmx-note"))
				{jQuery("#ocmx-note").html("<p>Saving...</p>");}
			else
				{jQuery("<div id=\"ocmx-note\" class=\"updated below-h2\"><p>Saving...</p></div>").insertBefore("#header-block");}

			jQuery.post(post_page,
				{action : 'ocmx_save-options', data: formvalues},
				function(data)
						{
							setTimeout(function(){
								jQuery("#content-block").animate({opacity: 1}, 500)
								jQuery("#ocmx-note").html("<p>Your changes were successful.</p>");
							}, 500);
						}
					);
			return false;
		});

		jQuery("[id^='ocmx-reset']").click(function(){
			sure_reset = confirm("Are you sure you want reset these options to default?");
			if(sure_reset)
				{
					formvalues = jQuery("#ocmx-options").serialize();
					jQuery("#content-block").animate({opacity: 0.50}, 500)

					if(document.getElementById("ocmx-note"))
						{jQuery("#ocmx-note").html("<p>Saving...</p>");}
					else
						{jQuery("<div id=\"ocmx-note\" class=\"updated below-h2\"><p>Saving...</p></div>").insertBefore("#header-block");}
					jQuery.post(post_page,
						{action : 'ocmx_reset-options', data: formvalues},
						function(data)
								{
									setTimeout(function(){
										jQuery("#ocmx-note").html("<p>Refreshing Page...</p>");
										jQuery("#content-block").animate({opacity: 1}, 500)
										window.location = jQuery("#ocmx-options").attr("action").replace("&changes_done=1", "")+"&options_reset=1";
									}, 500);
								}
							);
				}
			else
				return false;
		});

		jQuery("#tabs a").click(function()
			{
				oldtabid = jQuery(".selected").children("a").attr("rel");
				tabid = jQuery(this).attr("rel");
				//$new_class = jQuery($oldtabid).attr("class");
				if(!(jQuery(this).parent().hasClass("selected")))
					{
						jQuery(".selected").removeClass("selected");
						jQuery(this).parent().addClass("selected");
						jQuery(oldtabid).slideUp();
						jQuery(tabid).slideDown();

						formaction = jQuery("form").attr("action");
						findtab = formaction.indexOf("tab=");
						action_len = formaction.length;
						tabno = jQuery(this).attr("rel").replace("#tab-", "");
						if(findtab == -1)
							{
								jQuery("form").attr("action", formaction+"&current_tab="+tabno);
							}
						else
							{
								formaction = formaction.substr(0,(findtab+4));
								jQuery("form").attr("action", formaction+tabno);
							}

						jQuery(oldtabid+"-href").fadeOut({duration: 0});
						jQuery(tabid+"-href").fadeIn({duration: 250});
						jQuery(oldtabid+"-href-1").fadeOut({duration: 0});
						jQuery(tabid+"-href-1").fadeIn({duration: 250});

					}
				return false;
			});

		jQuery("a[id^='ocmx_layout_']").click(function(){
			// Set active state
			jQuery(this).parent().parent().children(".layout-select").removeClass("layout-select");
			jQuery(this).parent().addClass("layout-select");

			// Grab the relevant attributes
			layout = jQuery(this).attr("data-layout");
			inputid = jQuery(this).attr("data-input");
			form = jQuery(this).attr("data-options");

			// Set the OCMX option
			jQuery("#"+inputid).val(layout);

			// Load additional options for your selection
			jQuery("#"+inputid+"_form").hide();
			if(form !== '') {
				loading = "<li><div class=\"form-wrap\"><a href=\"#\"><img src=\"images/loading.gif\" alt=\"\" /></a></div></li>";
				setTimeout(function(){jQuery("#"+inputid+"_form").html(loading).fadeIn();}, 250);
				jQuery.get(post_page,
					{action : 'ocmx_layout-refresh', layout_option: form, layout: layout},
					function(data)
							{
								setTimeout(function(){
									if(data == ''){
										jQuery("#"+inputid+"_form").html(data).hide();
									} else {
										jQuery("#"+inputid+"_form").html(data).fadeIn();
									}
								}, 500);
							}
						);

			}
			return false;
		});

		jQuery("a[id^='ocmx_sidebar_']").click(function(){
			jQuery(".sidebar-select").removeClass("sidebar-select");
			jQuery(this).parent().addClass("sidebar-select");

			layout_id = jQuery(this).attr("id");
			layout = jQuery(this).attr("id").replace("ocmx_sidebar_", "");
			layout_option = layout+"_home_options";

			jQuery("#ocmx_sidebar_layout").attr("value", layout);

			loading = "<li><div class=\"form-wrap\"><a href=\"#\"><img src=\"images/loading.gif\" alt=\"\" /></a></div></li>";

			jQuery("#sidebar_options").html(loading);

			i = 1;

			jQuery.get(post_page,
				{action : 'ocmx_sidebar-refresh', layout_option: layout_option, layout: layout},
				function(data)
						{jQuery("#sidebar_options").html(data).fadeIn()}
					);
			return false;
		});

		jQuery("#ocmx_feature_post_content").bind("change", function(){
			if(jQuery(this).attr("value") == "gallery")
				{
					jQuery(".ocmx_feature_gallery_div").slideDown();
					jQuery("#ocmx_feature_gallery_div").slideDown();
					jQuery(".ocmx_feature_post_cat_div").slideUp();
					jQuery("#ocmx_feature_post_cat_div").slideUp();
				}
			else
				{
					jQuery(".ocmx_feature_post_cat_div").slideDown();
					jQuery("#ocmx_feature_post_cat_div").slideDown();
					jQuery(".ocmx_feature_gallery_div").slideUp();
					jQuery("#ocmx_feature_gallery_div").slideUp();
				}
			return false;
		});
		jQuery(".element-selector > li > a").click(function(){
			//Set the height of the functioning li
			minHeight = jQuery(".element-selected").height();
			jQuery(this).parent().parent().parent().parent().css("minHeight", minHeight+"px");

			//Hide the old tab
			jQuery(this).parent().parent().children("li").children(".element-selected-tab").removeClass("element-selected-tab");
			jQuery(".element-selected").slideUp("slow", function(){jQuery(this).removeClass("element-selected").addClass("no_display")});

			//Show the new tab
			liid = "#"+jQuery(this).attr("rel")+"_li";
			jQuery(this).addClass("element-selected-tab");
			jQuery(liid).addClass("element-selected").slideDown("slow", function(){jQuery(this).removeClass("no_display")});

			return false;
		});

		jQuery(".image-select").click(function(){
			//Uncheck all the other options
			jQuery("img[src*='-on.png']").each(function(){
				src = jQuery(this).attr("src");
				src = src.replace("-on.png", "-off.png");
				jQuery(this).attr("src", src);
			});

			src = jQuery(this).children("img").attr("src").replace("off.png", "on.png");
			jQuery(this).children("img").attr("src", src);
		});
		jQuery(".image-edit-item").click(function(){
			//Uncheck all the other options
			current = jQuery(this).parent().children(".selectit");
			current.children("input").removeAttr("checked");
			current.children("a").removeClass("active");
			current.removeClass("selectit");

			newitem = jQuery(this);
			newitem.children("input").attr("checked", "checked");
			newitem.children("a").addClass("active");
			newitem.addClass("selectit");

			return false;
		});

		jQuery(".sortable-ads").sortable({
				over: function(event, ui) {jQuery(this).children().css({cursor: 'move'}); jQuery(this).children().animate({opacity: 0.65});},
				stop: function(event, ui) {
					//Reset Cursor
					jQuery(this).children().css({cursor: ''})
					jQuery(this).children().animate({opacity: 1});

					ad_prefix = jQuery(this).attr("rel");
					ad_option = ad_prefix+"s";
					ad_select = "#"+ad_option;
					ad_div = "#"+ad_option+"_div";

					ad_list = jQuery(ad_div).children("ul");
					i=1;
					ad_list.children("li").each(function(){
						jQuery(this).children("div").children("div").each(function(){
						  jQuery(this).children("div:eq(0)").children("input").attr("id", ad_prefix+"_link_"+i).attr("name", ad_prefix+"_link_"+i);
						  jQuery(this).children("div:eq(1)").children("input").attr("id", ad_prefix+"_img_"+i).attr("name", ad_prefix+"_img_"+i);
						  jQuery(this).children("div:eq(2)").children("input").attr("id", ad_prefix+"_title_"+i).attr("name", ad_prefix+"_title_"+i);
						  jQuery(this).children("div:eq(3)").children("textarea").attr("id", ad_prefix+"_href_"+i).attr("name", ad_prefix+"_href_"+i);
						  jQuery(this).children("div:eq(3)").children("a").attr("id", "remove_ad_"+ad_prefix+"_"+i);
						  i++;
						});
					});
				}
		});

		jQuery("a[id^='add_ad_top_']").bind("click", function()
			{
				ad_prefix = jQuery(this).attr("rel");
				ad_option = jQuery(this).attr("id").replace("add_ad_top_", "");
				ad_select = "#"+ad_option;
				ad_div = "#"+ad_option+"_div";
				ad_width = "#ad_width_"+ad_option;
				ad_width = jQuery(ad_width).html();
				ad_no_ads = "#"+ad_option+"_no_ads";

				ad_amt = (jQuery(ad_div+" > ul").children().length);

				//Change the details of the current li's
				for(i = (ad_amt/1-1); i > 0; i--)
					{
						j = (i/1+1);
						jQuery("#"+ad_prefix+"_title_"+i).attr("id", ad_prefix+"_title_"+j).attr("name", ad_prefix+"_title_"+j);
						jQuery("#"+ad_prefix+"_link_"+i).attr("id", ad_prefix+"_link_"+j).attr("name", ad_prefix+"_link_"+j);
						jQuery("#"+ad_prefix+"_img_"+i).attr("id", ad_prefix+"_img_"+j).attr("name", ad_prefix+"_img_"+j);
						jQuery("#"+ad_prefix+"_href_"+i).attr("id", ad_prefix+"_href_"+j).attr("name", ad_prefix+"_href_"+j);
						jQuery("#"+ad_prefix+"_script_"+i).attr("id", ad_prefix+"_script_"+j).attr("name", ad_prefix+"_script_"+j);
						jQuery("#remove_ad_"+ad_prefix+"_"+i).attr("id", "remove_ad_"+ad_prefix+"_"+j);
					};
				jQuery.get(post_page,
					{action : 'ocmx_ads-refresh', option: ad_option, prefix: jQuery(this).attr("rel"), width: ad_width, count: 1},
					function(data)
							{;
								//Generate New li
								newli = "<li style=\"display: none;\">"+data+"</li>";

								jQuery(ad_div).children("ul").html(newli+jQuery(ad_div).children("ul").html());

								//Count the members
								new_child = (jQuery(ad_div+" > ul").children().length);
								jQuery(ad_select).attr("value", (new_child-1));

								//Slide in the new advert
								jQuery(ad_div+" > ul").children("ul li:nth-child("+1+")").slideDown("slow");
							}
						);
				return false;
			});

		jQuery("a[id^='add_ad_']").bind("click", function()
			{
				ad_option = jQuery(this).attr("id").replace("add_ad_", "");
				ad_select = "#"+ad_option;
				ad_div = "#"+ad_option+"_div";
				ad_width = "#ad_width_"+ad_option;
				ad_width = jQuery(ad_width).html();
				ad_no_ads = "#"+ad_option+"_no_ads";

				ad_amt = (jQuery(ad_div+" > ul").children().length);
				jQuery.get(post_page,
					{action : 'ocmx_ads-refresh', option: ad_option, prefix: jQuery(this).attr("rel"), width: ad_width, count: ad_amt},
					function(data)
							{
								jQuery(ad_no_ads).slideUp();
								newli = "<li style=\"display: none;\">"+data+"</li>";
								jQuery(newli).attr("class", "no_display");
								setTimeout(function(){
									jQuery(ad_no_ads).remove()
									jQuery(ad_div+" > ul").html(jQuery(ad_div+" > ul").html()+newli);
									new_child = (jQuery(ad_div+" > ul").children().length);
									jQuery(ad_select).attr("value", (new_child-1));
									jQuery(ad_div+" > ul").children("ul li:nth-child("+new_child+")").slideDown("slow");

								}, 500);
							}
						);
				return false;
			});

		jQuery("a[id^='remove_ad_']").bind("click", function()
			{
				ad_prefix = jQuery(this).attr("rel");
				ad_option = ad_prefix+"s";
				ad_select = "#"+ad_option;
				ad_div = "#"+ad_option+"_div";
				li_id = "#"+jQuery(this).attr("id");
				ad_number = jQuery(this).attr("id").replace("remove_ad_", "");
				ad_number = ad_number.replace(ad_prefix+"_", "");

				ad_width = jQuery("#ad_width_"+ad_option).html();

				sure_delete = confirm("Are you sure you want to remove this advert?");
				if(sure_delete)
					{
						jQuery.get(post_page,
							{action : 'mobile_ads-remove', option: ad_option, prefix: ad_prefix, ad_number: ad_number},
							function(data)
									{
										i = 1;
										ad_list = jQuery(ad_div).children("ul");
										//alert(ad_number+" | "+ad_list.children("li:eq("+(ad_number-1)+")").html());
										ad_list.children("li:eq("+(ad_number-1)+")").slideUp();
										ad_list.children("li").each(function(){
											i++;
											if(ad_number < i)
												{
													jQuery("#"+ad_prefix+"_title_"+i).attr("id", ad_prefix+"_title_"+(i/1-1)).attr("name", ad_prefix+"_title_"+(i/1-1));
													jQuery("#"+ad_prefix+"_link_"+i).attr("id", ad_prefix+"_link_"+(i/1-1)).attr("name", ad_prefix+"_link_"+(i/1-1));
													jQuery("#"+ad_prefix+"_img_"+i).attr("id", ad_prefix+"_img_"+(i/1-1)).attr("name", ad_prefix+"_img_"+(i/1-1));
													jQuery("#"+ad_prefix+"_href_"+i).attr("id", ad_prefix+"_href_"+(i/1-1)).attr("name", ad_prefix+"_href_"+(i/1-1));
													jQuery("#remove_ad_"+ad_prefix+"_"+i).attr("id", "remove_ad_"+ad_prefix+"_"+(i/1-1));
												}
										});
										setTimeout(function(){
											ad_list.children("li:eq("+(ad_number-1)+")").remove();
											new_child = (ad_list.children("li").length);
											jQuery(ad_select).attr("value", (new_child));
										}, 500);
									}
								);
					}
				return false;
			});

		jQuery("input[id^='ocmx_small_ad_img_']").bind("blur", function()
			{
				ad_id = jQuery(this).attr("id").replace("ocmx_small_ad_img_", "");
				//Set the href Id
				href_id = "#ocmx_small_ad_href_"+ad_id;

				jQuery(href_id).attr("src", jQuery(this).attr("value"));

			});

		jQuery("input[id^='ocmx_mediu_ad_img_']").bind("blur", function()
			{
				ad_id = jQuery(this).attr("id").replace("ocmx_mediu_ad_img_", "");
				//Set the href Id
				href_id = "#ocmx_mediu_ad_href_"+ad_id;

				jQuery(href_id).attr("src", jQuery(this).attr("value"));

			});

		//AJAX Upload & Logo Select
		jQuery("li a.remove").bind("click", function(){
			sure_delete = confirm("Are you sure you want to remove this image?");
			if(sure_delete)
				{
					attachid = jQuery(this).parent().children("a.image").attr("id");
					jQuery.get(post_page,
						{action : 'ocmx_remove-image', attachid: attachid},
						function(data)
								{jQuery("#"+attachid).parent().fadeOut();}
							);
				}
			return false;
		});

		jQuery(".previous-logos li a.image").bind("click", function(){
			//Text Box for image
			selected_input = jQuery(this).parent().parent().parent().children("input[type='text']");

			//Anchore which displays image
			selected_a = jQuery(this).parent().parent().parent().children(".logo-display").children("a");

			//fadeOut the image
			jQuery(selected_a).stop().fadeOut();

			//Get the new image src
			image_value = jQuery(this).children("img").attr("src");

			//Change the BG and fade in the image
			setTimeout(function(){
				jQuery(selected_a).css({background: 'url("'+image_value+'") no-repeat center'}).fadeIn();
				jQuery(selected_input).attr("value", image_value);
			}, 500);
			return false;
		})

		jQuery("input[id^='clear_upload_']").click(function(){
			input_id = jQuery(this).attr("id").replace("clear_", "")+"_text";
			image_link_id = input_id.replace("_text", "_href");
			var clear_img = confirm("Are you sure you want to clear this image?");
			if(clear_img){
				jQuery("#"+image_link_id).css({background: 'url("") no-repeat center'}).fadeIn();
				jQuery("#"+input_id).attr("value", "")
			}
			return false;
		});

		jQuery("input[id^='upload_button']").each(function(){
			//Get the button Id
			var input_id = "#"+jQuery(this).attr("id");

			//Make sure we're only talking about the button, and not the text field, that'll get messy
			if(input_id.indexOf("_text") <= -1){
				meta = jQuery(this).attr("id").replace("upload_button_", "");
				meta = jQuery(this).attr("id").replace("upload_button", "");
				// Set the approtpriate meta, links and input id's
				var meta = meta.replace("_href", "");

				if(meta !== "")
					{var metaid = "#new-upload-"+meta;}
				else
					{var metaid = "#new-upload";}

				if(meta == "")
					{meta = "logo";}

				var image_link_id = input_id+"_href";
				var image_input_id = input_id+"_text";

				//Beging the Ajax upload vibe
				new AjaxUpload(jQuery(this).attr("id"), {
				  action:	ThemeAjax.ajaxurl,
				  name: 	jQuery(this).attr("name"), // File upload name
				  data: 	{action:  "ocmx_ajax-upload",
							input_name: jQuery(this).attr("name"),
							type: 'upload',
							meta_key: meta,
							data: jQuery(this).id},
				  autoSubmit: true, // Submit file after selection
				  responseType: false,
				  onChange: function(file, extension){
					  new_li = "<img src=\"images/loading.gif\" alt=\"\" /></a>";

					  jQuery(metaid+" a.image").html(new_li);
					  jQuery(metaid).fadeIn();
					},
				  onSubmit: function(file, extension){},
				  onComplete: function(file, response) {
					// If there was an error
					if(response.search('Upload Error') > -1){
						jQuery("#new-upload-"+meta+" a:nth-child(1)").html(response);
						setTimeout(function(){jQuery("#new-upload-"+meta).remove();}, 2000);
					}
					else{
						new_image = "<img width=\"100\" src=\""+response+"\" alt=\"\" />";
						jQuery(image_link_id).fadeOut();

						setTimeout(function(){
							jQuery(metaid+" a.image").html(new_image);
							jQuery(metaid).attr("id", "");
							listItem = "<li id=\""+metaid+"\" style=\"display: none;\"><a href=\"#\" class=\"image\"></a></li>";
							jQuery(".previous-logos").append(listItem);
							jQuery(image_input_id).attr("value", response);
							jQuery(image_link_id).css({background: 'url("'+response+'") no-repeat center'}).fadeIn();
						}, 1500);
					}
				  }
				});
			}
		});


		/*********************/
		/* GALLERY FUNCTIONS */

		jQuery("a[id^='edit-image-']").click(function()
			{
				if(jQuery("a[id^='edit-image-']").html() == "edit")
					{
						jQuery(".gallery-item").parent().animate({width: 704}, {duration: 350});
						setTimeout(function(){
						jQuery(".image-form").fadeIn({duration: 450});
											}, 350);
						jQuery("a[id^='edit-image-']").html("cancel");
					}
				else
					{
						jQuery(".image-form").fadeOut({duration: 100});
						setTimeout(function(){
							jQuery(".gallery-item").parent().animate({width: 200}, {duration: 350});
						}, 50);
						jQuery("a[id^='edit-image-']").html("edit");
					}
				return false;

			});

		jQuery("#sortable").sortable({
				over: function(event, ui) {jQuery(this).children().css({border: '1px dashed #39F', padding: '5px'})},
				stop: function(event, ui) {jQuery(this).children().css({border: '', padding: '0px'})},
		});
		jQuery(".sortable").sortable();
		jQuery(".no-sort").sortable({ disabled: true });


		jQuery("#width_1, #height_1, #width_2, #height_2").keyup(function(){
				check_nan(this, jQuery(this).attr("value"));
			});

		jQuery("#item").blur(function(){
			check_value = jQuery("#item").attr("value");
			use_value = "";
			validchar = "1234567980abcdefghijklmnopqrstuvwxyz- ";
			i_max = jQuery("#item").attr("value").length;
			for(i = 0; i < i_max; i++)
				{
					this_char = check_value.toLowerCase().charAt(i)
					if(validchar.indexOf(this_char) !== -1)
						{use_value = use_value + this_char;}
				}
			use_value = use_value.replace(/ /g, "-");
			jQuery("#linkTitle").attr("value", use_value);
		});
	});