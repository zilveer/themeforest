post_page = ThemeAjax.ajaxurl;
jQuery(document).ready(function()
	{
		jQuery("a[id^='upgrade-all']").bind("click", function()
			{
				sure_upgrade = confirm("Are you sure you'd like to replace the old files?");
				if(sure_upgrade)
					{
						jQuery(jQuery("a[id^='upgrade-button-']").get().reverse()).each(function(){
							var zipfile = jQuery(this).attr("rel");
							var version = jQuery(this).attr("id").replace("upgrade-button-", "");
							var this_href = this;
							var status = version.replace(".", "-");
							var status = "#upgrade-status-"+status.replace(".", "-");
							jQuery(status).fadeIn();
							jQuery.get(post_page,
								{action : 'do_theme_upgrade', zipfile: zipfile, version: version},
								function(data)
										{
											setTimeout(function(){jQuery(this_href).parent().parent().fadeOut();}, 200);
											if(data.toString().indexOf("process_success") > -1)
												{ jQuery(this_href).parent().html("<p>Successfully Updated!</p>");}
											else
												{ jQuery(this_href).parent().html("<p>Update Failed</p>");}
										}
									);
						});
					};
				return false;
			});
		jQuery("a[id^='upgrade-button-']").bind("click", function()
			{
				zipfile = jQuery(this).attr("rel");
				version = jQuery(this).attr("id").replace("upgrade-button-", "");
				this_href = this;
				status = version.replace(".", "-");
				status = "#upgrade-status-"+status.replace(".", "-");
				sure_upgrade = confirm("Are you sure you'd like to replace the old files?");
				if(sure_upgrade)
					{
						jQuery(status).fadeIn();
						jQuery.get(post_page,
							{action : 'do_theme_upgrade', zipfile: zipfile, version: version},
							function(data)
									{

										setTimeout(function(){jQuery(this_href).parent().parent().fadeOut();}, 200);
										if(data.toString().indexOf("process_success") > -1)
											{ jQuery(this_href).parent().html("<p>Successfully Updated!</p>");}
										else
											{ jQuery(this_href).parent().html("<p>Update Failed</p>");}
									}
								);
					}
				return false;
			});
		jQuery("a[id^='upgrade-ocmx-button-']").bind("click", function()
			{
				version = jQuery(this).attr("id").replace("upgrade-ocmx-button-", "");
				status = version.replace(".", "-");
				status = "#upgrade-status-"+status.replace(".", "-");

				this_href = this;
				sure_upgrade = confirm("Are you sure you'd like to replace the old files?");
				if(sure_upgrade)
					{
						jQuery(status).fadeIn();
						jQuery.get(post_page,
							{action : 'do_ocmx_upgrade', version: version},
							function(data)
									{

										setTimeout(function(){jQuery(this_href).parent().parent().fadeOut();}, 200);
										if(data.toString().indexOf("process_success") > -1)
											{ jQuery(this_href).parent().html("<p>Successfully Updated!</p>");}
										else
											{ jQuery(this_href).parent().html("<p>Update Failed</p>");}
									}
								);
					}
				return false;
			});
		jQuery("a[id^='upgrade-files-href-']").bind("click", function()
			{
				tbody = jQuery(this).attr("rel");
				if(jQuery(tbody).hasClass("no_display"))
					{
						jQuery(tbody).fadeIn();
						jQuery(this).text("Hide File List");
						setTimeout(function(){jQuery(tbody).removeClass("no_display");}, 500);
					}
				else
					{
						jQuery(tbody).fadeOut();
						jQuery(this).text("Show File List");
						setTimeout(function(){jQuery(tbody).addClass("no_display");}, 500);
					}
				return false;
			});
	});