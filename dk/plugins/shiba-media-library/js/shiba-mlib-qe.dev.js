// Modified from wp-admin/js/edit-comments.dev.js
(function($) {
shibaAttachmentQE = {
	id : '',

	init : function() {
		var row = $('#attrow');

		$('a.cancel', row).click(function() { return shibaAttachmentQE.revert(); });
		$('a.save', row).click(function() { return shibaAttachmentQE.send(); });

		$('td.field input[type=text]', row).bind('keypress', shibaAttachmentQE.keyCapture);

		// add events
		$('#doaction, #doaction2, #mlib_doaction, #post-query-submit, #mlib-post-query-submit').click(function(e){
			if ( $('#the-list #addrow').length > 0 )
				shibaAttachmentQE.close();
		});
	},

	keyCapture : function(e){
		if ( e.which == 13 ) {
			e.preventDefault();
			return shibaAttachmentQE.send();
		}
	},

	toggle : function(el) {
		if ( $(el).css('display') != 'none' )
			$(el).find('a.vim-q').click();
	},

	revert : function() {

		if ( $('#attrow').length < 1 )
			return false;

		$('#attrow').fadeOut('fast', function(){
			shibaAttachmentQE.close();
		});

		return false;
	},

	close : function() {
		var a, attrow = $('#attrow');

		if ( attrow.parent().is('#att-reply') )
			return;

		if ( this.id ) {
			a = $('#post-' + this.id);
			a.fadeIn(300, function(){ a.show() }).css('backgroundColor', '');
		}

		// clear imgedit-response, close edit image if it is open
		$('#imgedit-response-' + this.id).html('').hide();
		imageEdit.close(this.id);

		attrow.hide();
		$('#att-reply').append( attrow );
		$('.error', attrow).html('').hide();
		$('.waiting', attrow).hide();

		this.id = '';
	},

	open : function(attachment_id) {
		var t = this, editRow, rowData, act, a = $('#post-' + attachment_id), h = a.height(), replyButton;

		t.close(); 
		t.id = attachment_id;

		editRow = $('#attrow');
		rowData = $('#inline-' + t.id);

		// For image edit to work we must add id for 
		// media-head thumbnail-head media-dims imgedit-open-btn image-editor imgedit-response
		$('.media-item-info:first').attr('id','media-head-' + t.id);
		$('.A1B1:first').attr('id','thumbnail-head-' + t.id);
		$('.shiba-imgedit-open-btn:first').attr('id','imgedit-open-btn-' + t.id);
		$('.shiba-image-editor:first').attr('id','image-editor-' + t.id);
		$('.imgedit-response:first').attr('id','imgedit-response-' + t.id);

		thumbnailHead = $('#thumbnail-head-' + t.id);
		mediaHead = $('#media-head-' + t.id);
		imgeditBtn = $('#imgedit-open-btn-' + t.id);
		
		$('p:first a', thumbnailHead).attr('href', $('div.attachment_url', rowData).text());
		$('p:first img', thumbnailHead).attr('src', $('div.thumb_url', rowData).text());
//		console.log($('#thumbnail-head').next().html());
		$(thumbnailHead).next().html($('div.file_info', rowData).html());
		$(imgeditBtn).attr('onClick', $('div.image_edit_button', rowData).text());

//		console.log($('.field', editRow));
		$('.field', editRow).each(function() {
			var i = $(this).children(':first');	
			var cname = $(i).closest('tr').attr('class').split(' ')[0];
//			console.log(cname);
			var sourceData = $('div.' + cname, rowData);
			var sourceClass = $(sourceData).attr('class').split(' ');
			if (sourceClass[1] && (sourceClass[1] == 'is-html')) {
				var htmlStr = $(sourceData).text(),
					data = htmlStr.replace(/[+-]/g, function(c) {
       					return {
							"+" : "<",
							"-" : ">"
						}[c];
					}),
					newInput = $(data);
				$(newInput).filter(':input[type=text]').bind('keypress', shibaAttachmentQE.keyCapture);
				$(this).empty().append(newInput);
//				$(this).html($(sourceData).html());
			} else {
				$(i).val($(sourceData).text());
			}
		});	

		$('#shiba-media-upload-form #attachment_id').val(t.id);
		
		$(mediaHead, editRow).show();
		$(editRow).hide();

		a.after( editRow ).fadeOut('fast', function(){
			$( editRow ).fadeIn(300, function(){ $(this).show() });
		});


		setTimeout(function() {
			var rtop, rbottom, scrollTop, vp, scrollBottom;

			rtop = $('#attrow').offset().top;
			rbottom = rtop + $('#attrow').height();
			scrollTop = window.pageYOffset || document.documentElement.scrollTop;
			vp = document.documentElement.clientHeight || self.innerHeight || 0;
			scrollBottom = scrollTop + vp;

			if ( scrollBottom - 20 < rbottom )
				window.scroll(0, rbottom - vp + 35);
			else if ( rtop - 20 < scrollTop )
				window.scroll(0, rtop - 35);

		}, 600);

		return false;
	},

	send : function() {
		var data = {};
		$('#replysubmit .error').hide();
		$('#replysubmit .waiting').show();

		var fields = $('#shiba-media-upload-form input').serializeArray();
     	jQuery.each(fields, function(i, field){
//        	console.log(field.name + " " + field.value);
			data[field.name] = field.value;
      	});


		$('#attrow .field').each(function() {
			var i = $(this).find('input,textarea,select').filter(':first');					 			var cname = $(this).closest('tr').attr('class').split(' ')[0];
			var type = $(i).attr('type');
			switch (type) {
			case 'radio':
				data[cname] = $(this).find('input[type=radio]:checked').val();
				break;
			default: // works for textarea, select, text
				data[cname] = $(i).val();
			}
//			console.log(cname + " " + data[cname]);
		});	

		$.ajax({
			type : 'POST',
			url : ajaxurl,
			data : data,
			success : function(x) { shibaAttachmentQE.show(x); },
			error : function(r) { shibaAttachmentQE.error(r); }
		});

		return false;
	},

	show : function(xml) {
		var t = this, r, c, id, bg, pid;

		if ( typeof(xml) == 'string' ) {
			t.error({'responseText': xml});
			return false;
		}

		r = wpAjax.parseAjaxResponse(xml);
		if ( r.errors ) {
			t.error({'responseText': wpAjax.broken});
			return false;
		}

		t.revert();

		r = r.responses[0];
		c = r.data;
		id = '#post-' + r.id;

		// Remove previous table row
		$(id).remove();

		// Add in updated table row and show
		$(c).hide()
		$('#attrow').after(c);
		// Add whatever interactive events is necessary to the newly added row
//		id = $(id);
//		t.addEvents(id);
	},

	error : function(r) {
		var er = r.statusText;

		$('#replysubmit .waiting').hide();

		if ( r.responseText )
			er = r.responseText.replace( /<.[^<>]*?>/g, '' );

		if ( er )
			$('#replysubmit .error').html(er).show();

	}

};

$(document).ready(function(){
	shibaAttachmentQE.init();
});

})(jQuery);