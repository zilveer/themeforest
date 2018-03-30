;(function($, window, document, undefined)
{
	"use strict";
	// var $x = 0;
	// var $oX = {c: "a", d: "b"};
	// var $i;

	tinymce.PluginManager.add('awe_mce_button', function( editor, url ) 
	{
		editor.addButton( 'awe_mce_button', {
			text: 'AWE Shortcodes',
			icon: false,
			type: 'menubutton',
			menu: 
			[
				{
					text: 'Buttons',
					onclick: function()
					{ 
						$("#awe_sc_button").dialog("open");
						$("#awe_sc_button").removeClass("hidden");
					},
				},
				// {	
				// 	text: 'Mailchimp',
				// 	onclick: function()
				// 	{ 
				// 		$("#awe_sc_mailchimp").dialog("open");
				// 		$("#awe_sc_mailchimp").removeClass("hidden");
				// 	},
				// },
				{	
					text: 'Alerts',
					onclick: function()
					{ 
						$("#awe_sc_alert").dialog("open");
						$("#awe_sc_alert").removeClass("hidden");
					},
				},
				{	
					text: 'Tabs',
					onclick: function()
					{ 
						$("#awe_sc_tabs").dialog("open");
						$("#awe_sc_tabs").removeClass("hidden");
					},
				},
				{	
					text: 'Accordion',
					onclick: function()
					{ 
						$("#awe_sc_toggle").dialog("open");
						$("#awe_sc_toggle").removeClass("hidden");
					},
				},
				{
					text: 'Dropcap',
					onclick: function()
					{ 
						$("#awe_sc_dropcap").dialog("open");
						$("#awe_sc_dropcap").removeClass("hidden");
					},
				},
				{
					text: 'List Style',
					onclick: function()
					{ 
						$("#awe_sc_liststyle").dialog("open");
						$("#awe_sc_liststyle").removeClass("hidden");
					},
				},
				{
					text: 'Progress Bar',
					onclick: function()
					{ 
						$("#awe_sc_progress_bar").dialog("open");
						$("#awe_sc_progress_bar").removeClass("hidden");
					},
				},
				{
					text: 'Video',
					onclick: function()
					{ 
						$("#awe_sc_embed_video").dialog("open");
						$("#awe_sc_embed_video").removeClass("hidden");
					},
				}
				// awe_configs()
			]
		});
	});

	function awe_configs()
	{
		var $oX = {c: "a", d: "b"};
		var $i;
		var $x = 0;
		var $a = [];
		for ( $i in $oX )
		{
			if ($i == 'c')
			{
				 console.log($a.push($x));
			}
		}
	}

	$( ".awe_shorcode_dialog" ).dialog({ 
		autoOpen: false, 
		modal: true ,
		dialogClass: "awe-shortcode" // Add class "awe-shortcode" to dialog
	});


	$(".color_picker").spectrum(
	{
		flat: false,
    	showInput: true,
    	showAlpha: true,
    	className: "full-spectrum",
    	preferredFormat: "hex",
    	showButtons: false,
		move: function(color)
		{
			var getcolor = color.toRgbString();
			var $target, $change;
				$target = $(this).data("target");
				$change = $(this).data("change");

				if ($change=='color')
				{
					$($target).css({color: getcolor});
				}else{
					$($target).css({'background-color': getcolor});
				}
		}
	
	});
	

	$(".awe_sc_builder .select").change(function()
	{
		var $type, $val, $useSplit, $method, $target, $parse, $attr, $caching, $oldSettings="", $aAllSettings=[], $general; 
		$type = $(this).data("type");
		$val  = $(this).find(":selected").attr("value");
		$target = $(this).data("target");
		$caching = $(this).attr("name");
		$useSplit = $type.search("|") != -1 ? true : false;

		if ($useSplit)
		{
			$parse  = $type.split("|");
			$method = $parse[0];
			$attr = $parse[1];
		}
		
		var $go = $(this).closest(".awe_shorcode_dialog").find($target);

		if ($attr != '')
		{

			if ($attr == 'class')
			{	
				var $getCurrentSetting =  $go.attr("class");
				var $hasDefault = $getCurrentSetting.indexOf("btn-default");
					// $hasDefault = $hasDefault != -1 ? 'btn-default' : '';

					$(this).children().each(function()
					{
						$getCurrentSetting = $getCurrentSetting.replace($(this).attr("value"), "");
					})

				// $general = $go.data("general");

				$getCurrentSetting = $getCurrentSetting + " " + $val;

				$go.attr("class", $getCurrentSetting);
			
			}else{
				$go[$method]($attr, $val);
			}
		}else{
			$go[$method]($val);

		}
	})
	
	$(document).on("mouseover", ".awe_chooseicon.thickbox", function()
	{
		var _self = $(this), $getIcon="";
		
		$(document).on("click", "#fa-table-list li", function()
		{
		 	$getIcon = $(this).children().attr("class");
			_self.next().val($getIcon);
			tb_remove(); 
		})
	})

	$(document).on("focus", ".awe_sc_builder .keypress", function()
	{
		var $target,$type, $useSplit, $parse, $method, $attr;
			$target = $(this).data("target");
			$type   = $(this).data("type");

			if (typeof $type != 'undefined')
			{
				$useSplit = $type.search("|") != -1 ? true : false;

				if ($useSplit)
				{
					$parse  = $type.split("|");
					$method = $parse[0];
					$attr = $parse[1];
				}

			}else{
				$type = 'text';
			}

			$(this).on( "keydown keyup", function()
			{	
				if ($type=='text')
				{
					$($target).text($(this).val());
				}else{
					$($target)[$method]($attr, $(this).val());
				}
			})
	})

	$(document).on("focus", ".awe_sc_builder .using_ajax", function(event)
	{
		event.preventDefault();

		var _self = $(this), $render = $(this).data("render"), $content = "";
	})


	$(document).on("click", ".awe_live_preview", function()
	{
		$(this).text("Refresh");

		var $content = "", $render="", $icon, $color, $effect;
		var _self=$(this);
		$content = $(this).siblings(".awe-settings").find(".awe_content").val();
		$icon    = typeof $(this).siblings(".awe-settings").find(".awe_icon").val() != 'undefined' ? $(this).siblings(".awe-settings").find(".awe_icon").val() : '';
		$color   = 	typeof $(this).siblings(".awe-settings").find(".color_picker").val() != 'undefined' ? $(this).siblings(".awe-settings").find(".color_picker").val() : '';

		$effect = 	typeof $(this).siblings(".awe-settings").find(".effect_processbar").val() != 'undefined' ? $(this).siblings(".awe-settings").find(".effect_processbar").val() : '';

		$render  = $(this).data("render");

		$.ajax(
		{
			url: ajaxurl,
			type:"POST",
			data:{action: 'shortcode_machine', render: $render, content: $content, icon: $icon, color:$color, effect: $effect},
			success: function(res)
			{
				
				
				switch ($render)
				{
					case 'tabs':
						_self.siblings(".awe-preview").html(res);
						$(".awe_tabs").tabs();
						break;

					case 'accordion':
						_self.siblings(".awe-preview").html(res);
						$(".awe_accordion").accordion();
						break;	
					case 'liststyle':
						$("#awe_liststyle_preview").html(res);
						// $().html("[awe_liststyle icon='"+$icon+"' color='"+$color+"' ");
						break;
					case 'progressbar':
						_self.siblings(".awe-preview").html(res);
						break;
				}

			} 
		})
	})
	
	$(document).on("change", ".effect_processbar", function()
	{
		var $getVal = $(this).find(":selected").attr("value"), $go="";

			$go = $(this).closest(".awe-settings").siblings(".awe-preview");

		if ($go.find(".progress").length>0)
		{
			$go.find(".progress").each(function()
			{
				switch ($getVal)
				{
					case '':
						$(this).find(".progress-bar").removeClass("active progress-bar-striped");
						break;

					case 'progress-bar-striped':
						$(this).find(".progress-bar").removeClass("active").addClass("progress-bar-striped");
						break;

					default:
						$(this).find(".progress-bar").addClass("progress-bar-striped active");
						break;
				}
			})
		}
	})

	$(document).on("click",  ".awe_insert_shortcode", function()
	{
		var $getVal="", $go = $(this).siblings(".awe-settings"), $data="", $scName="", $replaceContent;
			$scName = $go.data("shortcodename");

			$replaceContent = typeof $go.data("dontreplacecontnet") != 'undefined' ? true : false;

			if ($replaceContent == false)
			{
				$go.wrap("<form method='POST' action=''></form>");
				$getVal = $go.parent().serializeArray();
				$go.unwrap("form");
				
				$data += '[' + $scName;
				$($getVal).each(function(i, val)
				{
					if (typeof val != 'undefined' && typeof val.value != 'undefined' && typeof val.name != 'undefined')
					{
						$data += " " + val.name + '=' + '"' +  val.value + '"';
					}
				})
				$data += ' ]';
			}else{
				$data += '[' + $scName + '';

				if ( $go.find('.awe_style').length>0 )
				{
					$go.find(".awe_style").each(function()
					{
						$data += ' ' + $(this).attr("name") + '="' + $(this).val() + '"';
					})
				}
				$data += ' ]';
				$data += $go.find(".awe_content").val();
				$data += '[/'+$scName+']';
			}

			// console.log($data);

		tinyMCE.activeEditor.execCommand("mceInsertContent", false, $data);
		$("#"+$(this).closest(".awe_sc_builder").attr("id")).dialog("close");	
	});

	$(document).on("click", ".awe_add_video", function()
	{
		var $getVideoURL = $(this).prev().attr("value"), $parseVideo="", $this=$(this);	
			$parseVideo  = $.AWE_MEDIA.init({url: $getVideoURL});


			if (typeof $parseVideo != 'undefined')
			{	
				if ($parseVideo.type == 'vimeo')
				{
					var img, ivalue;
					$.getJSON('http://www.vimeo.com/api/v2/video/' + $parseVideo.id_vimeo + '.json?callback=?', {format: "json"}, function(data) 
	                {               
	                    ivalue={'type':'vimeo','src':'//player.vimeo.com/video/'+$parseVideo.id_vimeo,'image':data[0].thumbnail_large};
	                        
	                    img = '<img width="128" height="128" src="'+ivalue.image+'">';

	                    $this.next().val(ivalue.src);
						$this.parent().siblings(".awe-preview").html(img);
	                })
				}else{
					$(this).next().val($parseVideo.src);
					$(this).parent().siblings(".awe-preview").html($parseVideo.image);
				}
				
			}
	})




})(jQuery, window, document)