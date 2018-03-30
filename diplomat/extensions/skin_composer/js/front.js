var tmm_demo_config="";
jQuery(document).ready(function() {

	if(tmm_demo_styles_list.length == 0){
		return;
	}

	var tmm_demo_config = {
		skin : {
			colors: {
				name : 'Color Skin',
				id : 'theme_color',
				desc : 'Take a look at this examples. <br/> Now it\'s under your control to create and add as many different colors as you want.',
				list : tmm_demo_styles_list
			}
		}
	}

	/* Theme controller --> Begin */

	if(jQuery.cookie('style_css_file_uri')!=null){
		changeBodyCssFile(jQuery.cookie('style_css_file_uri'), false);
	}

	var $body = jQuery('body'),
	$themePanel = jQuery('<div id="control-panel" />').addClass('control-panel'),
	$panel_label = jQuery('<a href="#" id="control-label"><i class="icon-wrench"></i></a>');
	$themePanel.append($panel_label);

	function changeBodyCssFile(style_css_file_uri, reset) {
		var cssId = 'tmm_ext_demo_css';  // you could encode the css path itself to generate id..
		//***
		var elem=document.getElementById(cssId);
		if(elem){
			elem.parentNode.removeChild(elem);
		}
		//***
		if(reset == false){
			if (!document.getElementById(cssId))
			{
				var head  = document.getElementsByTagName('head')[0];
				var link  = document.createElement('link');
				var l = document.getElementById('tmm_theme_layout-css');
				link.id   = cssId;
				link.rel  = 'stylesheet';
				link.type = 'text/css';
				link.href = style_css_file_uri;
				link.media = 'all';

				head.insertBefore(link, l);

			}
		}

	}

	if (typeof tmm_demo_config != 'undefined' && $themePanel) {

		var defaultSettings = {};

		if (tmm_demo_config.skin) {

			var $block_skin, $label_skin, $desc_skin, $ul = jQuery("<ul/>"), html_skin = '', theme_classes = [];

			jQuery.each(tmm_demo_config.skin, function(index, value) {

				$block_skin = jQuery('<div/>').addClass('style-block').attr({
					id : value.id
				});

				$label_skin = jQuery('<h6>' + value.name + '</h6>');
				$desc_skin = jQuery('<span>' + value.desc +'</span>');

				jQuery.each(value.list,function(index_list, value_list) {
					var style="";

					if(value_list.icon_type == 'color'){
						style="background-color: "+value_list.color;
					}else{
						style="background-image: url("+value_list.image_file+")";
					}

					html_skin += '<li><a href="' + value_list.css_file_link + '" style="' + style  + '"></a></li>';
					defaultSettings[index] = index_list;
					theme_classes.push(value_list.className);
				});

				$ul.html(html_skin);
				$block_skin.append($label_skin, $desc_skin, $ul);
				$themePanel.append($block_skin);

			});

			$block_skin.find('a').click(function() {
				var style_css_file_uri = jQuery(this).attr('href');
				jQuery.cookie('style_css_file_uri', style_css_file_uri);
				changeBodyCssFile(style_css_file_uri, false);
				$block_skin.find('.active').removeClass('active');
				jQuery(this).parent().addClass('active');
				return false;
			});


		}

		/* Reset Settings  --> Begin */

		var setDefaultsSettings = function() {
			jQuery.cookie('style_css_file_uri', null);
			$themePanel.find('.active').removeClass("active");
			changeBodyCssFile(tmm_demo_config.skin.colors.list[0].css_file_link, true);

			return false;
		};

		var $restore_button_wrapper = jQuery('<div/>').addClass('restore-button-wrapper');
		var $restore_button = jQuery('<a/>').text('Reset').attr('id','restore-button').addClass('button default medium').click(setDefaultsSettings);
		$restore_button_wrapper.append($restore_button);
		$themePanel.append($restore_button_wrapper);

		/* Reset Settings  --> Begin */


		/* Control Panel Label --> Begin */

		$panel_label.click(function() {
			if ($themePanel.hasClass('visible')) {
				$themePanel.animate({
					left: -145
				}, 400, function() {
					$themePanel.removeClass('visible');
				});
			} else {
				$themePanel.animate({
					left: 0
				}, 400, function() {
					$themePanel.addClass('visible');
				});
			}
			return false;
		});

		/* Control Panel Label --> End */

		$body.append($themePanel);
		//***
		if(jQuery.cookie('style_css_file_uri')!=null){
			var styles_links=jQuery("#theme_color ul li a");
			jQuery.each(styles_links, function(index, value){
				if(jQuery(value).attr('href') === jQuery.cookie('style_css_file_uri')){
					jQuery(value).parent().addClass('active');
					return false;
				}
			});
		}

	}

/* Theme controller --> End */

});

/* ---------------------------------------------------- */
/*	jQuery Cookie
/* ---------------------------------------------------- */
jQuery.cookie = function(name, value) {
	if (value !== undefined) {
		document.cookie = name + "=" + value + ";path=/;";
	} else {
		var value = null;
		switch (name) {
			case 'style_css_file_uri':
				value = document.cookie.replace(/(?:(?:^|.*;\s*)style_css_file_uri\s*\=\s*([^;]*).*$)|^.*$/, "$1");
				break;
		}
		return value;
	}

};

/* end jQuery Cookie */
