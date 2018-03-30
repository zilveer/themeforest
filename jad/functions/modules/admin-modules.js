jQuery(document).ready(function($){

	function sg_set_metaboxes(){
		var tpl = $('#page_template').find('option:selected').val();
		if (tpl) {
			tpl = tpl.replace('pg-', '');
			tpl = tpl.replace('.php', '');
			$('.postbox .inside div.sg-meta-container').parent().parent().hide();
			$('.postbox .inside div.' + tpl).parent().parent().show();
		} else {
			$('.postbox .inside div.sg-meta-container').parent().parent().show();
		}
		if ($('.postbox .inside div.no-editor').parent().parent().is(':visible')) {
			$('#postdivrich').hide();
		} else {
			$('#postdivrich').show();
		}
	}

	$('.sg-meta-sidebar').parent().parent().parent().find('.inside').addClass('sg-set-sidebar');

	$('.postbox .inside div.sg-meta-container').parent().parent().map(function() {
			$('#' + this.id + '-hide').parent().remove();
			return true;
		}).get();

	sg_set_metaboxes();

	$('#page_template').live('change', function(){
		sg_set_metaboxes();
	});

	var ms = $('.sg-meta-sidebar ul li:first-child');
	if (ms.hasClass('sg-meta-tab')) {
		ms.next('li').addClass('active');
	} else {
		ms.addClass('active');
	}

	$('.sg-meta-content .sg-meta-section:first-child').siblings('.sg-meta-section').hide();

	$('.sg-meta-sidebar ul li a').click(function(e){
		e.preventDefault();
		var section_id = $(this).attr('href');
		$(section_id).show().siblings('.sg-meta-section').hide();
		$(this).parents('li').addClass('active').siblings('.active').removeClass('active');
	});

	$('.postbox .inside div.sg-meta-container').show();

	function sg_media_upload_I() {
		var win = window.dialogArguments || opener || parent || top;
		var name = win.sg_image_btn_name;
		$('<input type="submit" value="' + name + '" class="button sg-post-thumbnail">').insertBefore('a.del-link');
		$(".sg-post-thumbnail").click(function() {
			var nonce = win.sg_post_nonce;
			var id = $(this).parent().find('input:first').attr("id");
			id = id.replace('send[', '');id = id.replace(']', '');
			jQuery.post(win.sg_image_ajaxurl, {
				post_id: post_id, thumbnail_id: id, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
			}, function(str){
				if (str == '0') {
					alert(setPostThumbnailL10n.error);
				} else {
					win.SGSetImageHTML(str, id);
					win.SGTbRemove();
				}
			});
			return false;
		});
	}

	function sg_media_upload_SI() {
		var win = window.dialogArguments || opener || parent || top;
		var name = win.sg_slider_btn_name;
		$('<input type="submit" value="' + name + '" class="button sg-post-thumbnail">').insertBefore('a.del-link');
		$(".sg-post-thumbnail").click(function() {
			var nonce = win.sg_post_nonce;
			var id = $(this).parent().find('input:first').attr("id");
			id = id.replace('send[', '');id = id.replace(']', '');
			jQuery.post(win.sg_slider_ajaxurl, {
				post_id: post_id, thumbnail_id: id, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
			}, function(str){
				if (str == '0') {
					alert(setPostThumbnailL10n.error);
				} else {
					win.SGSetSlideHTML(str, id);
					win.SGTbRemove();
				}
			});
			return false;
		});
	}

	function sg_media_upload_PP() {
		var win = window.dialogArguments || opener || parent || top;
		var name = win.sg_pattern_btn_name;
		$('<input type="submit" value="' + name + '" class="button sg-post-thumbnail">').insertBefore('a.del-link');
		$(".sg-post-thumbnail").click(function() {
			var nonce = win.sg_post_nonce;
			var id = $(this).parent().find('input:first').attr("id");
			id = id.replace('send[', '');id = id.replace(']', '');
			jQuery.post(win.sg_pattern_ajaxurl, {
				post_id: post_id, thumbnail_id: id, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
			}, function(str){
				if (str == '0') {
					alert(setPostThumbnailL10n.error);
				} else {
					win.SGSetPatternHTML(str, id);
					win.SGTbRemove();
				}
			});
			return false;
		});
	}

	function sg_media_upload_PBG() {
		var win = window.dialogArguments || opener || parent || top;
		var name = win.sg_pbgs_btn_name;
		$('<input type="submit" value="' + name + '" class="button sg-post-thumbnail">').insertBefore('a.del-link');
		$(".sg-post-thumbnail").click(function() {
			var nonce = win.sg_post_nonce;
			var id = $(this).parent().find('input:first').attr("id");
			id = id.replace('send[', '');id = id.replace(']', '');
			jQuery.post(win.sg_slider_ajaxurl, {
				post_id: post_id, thumbnail_id: id, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
			}, function(str){
				if (str == '0') {
					alert(setPostThumbnailL10n.error);
				} else {
					win.SGSetBgHTML(str, id);
					win.SGTbRemove();
				}
			});
			return false;
		});
	}

	function sg_media_upload_PI() {
		var win = window.dialogArguments || opener || parent || top;
		var name = win.sg_media_upload_btn_name;
		$('<input type="submit" value="' + name + '" class="button sg-post-thumbnail">').insertBefore('a.del-link');
		$(".sg-post-thumbnail").click(function() {
			var nonce = win.sg_post_nonce;
			var id = $(this).parent().find('input:first').attr("id");
			id = id.replace('send[', '');id = id.replace(']', '');
			jQuery.post(ajaxurl, {
				action:"set-post-thumbnail", post_id: post_id, thumbnail_id: id, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
			}, function(str){
				if (str == '0') {
					alert(setPostThumbnailL10n.error);
				} else {
					win.SGSetThumbnailHTML(str);
					win.SGTbRemove();
				}
			});
			return false;
		});
	}

	function sg_media_upload_LFI() {
		var win = window.dialogArguments || opener || parent || top;
		var name = win.sg_media_upload_btn_name;
		$('.savesend .button').val(name);
	}

	var get = location.search;
	if(get.indexOf('custom-media-upload=I') + 1) {
		$('body').addClass('sg_load_box_ha');
		$('body').addClass('sg_load_box_hb');
		$('<input type="hidden" value="I" name="custom-media-upload">').insertBefore('input[name=post_id]');
		$('#image-form').attr('action', $('#image-form').attr('action') + '&custom-media-upload=I');
		$('#image-form').bind('ajaxComplete', sg_media_upload_I);
		sg_media_upload_I();
	}
	if(get.indexOf('custom-media-upload=SI') + 1) {
		$('body').addClass('sg_load_box_ha');
		$('body').addClass('sg_load_box_hb');
		$('<input type="hidden" value="SI" name="custom-media-upload">').insertBefore('input[name=post_id]');
		$('#image-form').attr('action', $('#image-form').attr('action') + '&custom-media-upload=SI');
		$('#image-form').bind('ajaxComplete', sg_media_upload_SI);
		sg_media_upload_SI();
	}
	if(get.indexOf('custom-media-upload=PP') + 1) {
		$('body').addClass('sg_load_box_ha');
		$('body').addClass('sg_load_box_hb');
		$('<input type="hidden" value="PP" name="custom-media-upload">').insertBefore('input[name=post_id]');
		$('#image-form').attr('action', $('#image-form').attr('action') + '&custom-media-upload=PP');
		$('#image-form').bind('ajaxComplete', sg_media_upload_PP);
		sg_media_upload_PP();
	}
	if(get.indexOf('custom-media-upload=PBG') + 1) {
		$('body').addClass('sg_load_box_ha');
		$('body').addClass('sg_load_box_hb');
		$('<input type="hidden" value="PBG" name="custom-media-upload">').insertBefore('input[name=post_id]');
		$('#image-form').attr('action', $('#image-form').attr('action') + '&custom-media-upload=PBG');
		$('#image-form').bind('ajaxComplete', sg_media_upload_PBG);
		sg_media_upload_PBG();
	}
	if(get.indexOf('custom-media-upload=PI') + 1) {
		$('body').addClass('sg_load_box_ha');
		$('body').addClass('sg_load_box_hb');
		$('<input type="hidden" value="PI" name="custom-media-upload">').insertBefore('input[name=post_id]');
		$('#image-form').attr('action', $('#image-form').attr('action') + '&custom-media-upload=PI');
		$('#image-form').bind('ajaxComplete', sg_media_upload_PI);
		sg_media_upload_PI();
	}
	if(get.indexOf('custom-media-upload=LFI') + 1) {
		$('body').addClass('sg_load_box_ha');
		$('<input type="hidden" value="LFI" name="custom-media-upload">').insertBefore('input[name=post_id]');
		$('#image-form').attr('action', $('#image-form').attr('action') + '&custom-media-upload=LFI');
		$('#image-form').bind('ajaxComplete', sg_media_upload_LFI);
		sg_media_upload_LFI();
	}

	SGSetImageHTML = function(html, id){
		var cur = window.sg_current_upload_image;
		$("input[name=" + cur + "]").val(id);
		$("#" + cur + "_clear").show();
		$("#" + cur + "_img").html($(html).find('a').html());
	};

	SGSetSlideHTML = function(html, id){
		var cur = window.sg_current_upload_slide;
		var name = $('#' + cur).attr("rel");
		$('#' + cur).find('.sg-slide-img').html($(html).find('a').html() + '<input type="hidden" name="' + name + '[img]" value="' + id + '" />');
	};

	SGSetPatternHTML = function(html, id){
		var cur = window.sg_current_upload_slide;
		var name = $('#' + cur).attr("rel");
		var iname = name.split('[');
		var input = '<input type="radio" class="sg-pattern-btm" value="' + id + '" name="' + iname[0] + '[value]">';
		input += '<input type="hidden" name="' + name + '[img]" value="' + id + '" />';
		$('#' + cur).find('.sg-slide-img').html(html + input);
		$('#' + cur).find('.sg-slide-img').unbind('click');
		$('#' + cur).find('.sg-slide-img').removeClass().addClass('sg-slide-img-p').css("background-color", sg_sgp_bg_color);
		$('#' + cur).find('.sg-slide-img-p').click(function(e){
			$(this).find('.sg-pattern-btm').attr('checked', 'checked');
		});
	};

	SGSetBgHTML = function(html, id){
		var cur = window.sg_current_upload_slide;
		var name = $('#' + cur).attr("rel");
		var input = '<input type="radio" checked="checked" class="sg-fbg-lt" value="left top" name="' + name + '[value]">';
		input += '<input type="radio" class="sg-fbg-lc" value="left center" name="' + name + '[value]">';
		input += '<input type="radio" class="sg-fbg-lb" value="left bottom" name="' + name + '[value]">';
		input += '<input type="radio" class="sg-fbg-ct" value="center top" name="' + name + '[value]">';
		input += '<input type="radio" class="sg-fbg-cc" value="center center" name="' + name + '[value]">';
		input += '<input type="radio" class="sg-fbg-cb" value="center bottom" name="' + name + '[value]">';
		input += '<input type="radio" class="sg-fbg-rt" value="right top" name="' + name + '[value]">';
		input += '<input type="radio" class="sg-fbg-rc" value="right center" name="' + name + '[value]">';
		input += '<input type="radio" class="sg-fbg-rb" value="right bottom" name="' + name + '[value]">';
		input += '<select class="sg-fbg-fep" name="' + name + '[value1]"><option value="">scroll</option><option value="fixed">fixed</option></select>';
		input += '<select class="sg-fbg-rep" name="' + name + '[value2]"><option value="no-repeat">no repeat</option><option value="repeat">repeat</option><option value="repeat-x">repeat x</option><option value="repeat-y">repeat y</option></select>';
		input += '<input type="hidden" name="' + name + '[img]" value="' + id + '" />';
		$('#' + cur).find('.sg-slide-img').html($(html).find('a').html() + input);
		$('#' + cur).find('.sg-slide-img').unbind('click');
		$('#' + cur).find('.sg-slide-img').removeClass().addClass('sg-slide-img-b');
	};

	SGTbRemove = function() {
		tb_remove();
	};

	SGSetThumbnailHTML = function(html){
		$('#' + window.sg_current_uid + '_img').html($(html).find('a').html());
		$('#' + window.sg_current_uid + '_clear').show();
	};

	SGRemoveThumbnail = function(){
		var nonce = window.sg_post_nonce;
		$.post(ajaxurl, {
			action:"set-post-thumbnail", post_id: $('#post_ID').val(), thumbnail_id: -1, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
		}, function(str){
			if (str == '0') {
				alert(setPostThumbnailL10n.error);
			} else {
				$('#' + window.sg_current_uid + '_img').html('');
			}
		}
		);
	};

});