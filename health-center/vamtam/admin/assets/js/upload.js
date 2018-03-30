(function($, undefined) {
	'use strict';

	$.WPV = $.WPV || {};

	$.WPV.upload = {
		init: function() {
			var file_frame;

			$(document).on('click', '.wpv-upload-button', function(e) {
				var field_id = $(this).attr('data-target');

				file_frame = wp.media.frames.file_frame = wp.media({
					multiple: false,
					library: {
						type: $(this).hasClass('wpv-video-upload') ? 'video' : 'image'
					}
				});

				file_frame.on( 'select', function() {
					var attachment = file_frame.state().get('selection').first();
					$.WPV.upload.fill(field_id, attachment.attributes.url);
				});

				file_frame.open();
				e.preventDefault();
			});

			$(document).on('click', '.wpv-upload-clear', function(e) {
				$.WPV.upload.remove($(this).attr('data-target'));
				e.preventDefault();
			});

			$(document).on('click', '.wpv-upload-undo', function(e) {
				$.WPV.upload.undo($(this).attr('data-target'));
				e.preventDefault();
			});
		},

		fill: function(id, str) {
			if (/^\s*$/.test(str)) {
				$.WPV.upload.remove(id);
				return;
			}

			var target = $('#' + id);
			target.data('undo', target.val());
			target.val(str);
			target.siblings('.wpv-upload-clear, .wpv-upload-undo').css({
				display: 'inline-block'
			});
			$.WPV.upload.preview(id, str);
		},

		preview: function(id, str) {
			$('#' + id + '_preview').parents('.upload-basic-wrapper').addClass('active');
			$('#' + id + '_preview').find('img').attr('src', str).css({
				display: 'inline-block'
			});
		},

		remove: function(id) {
			var inp = $('#' + id);
			$('#' + id + '_preview').find('img').attr('src', '').hide();
			$('#' + id + '_preview').parents('.upload-basic-wrapper').removeClass('active');
			inp.data('undo', inp.val()).val('')
				.siblings('.wpv-upload-undo').css({
				display: 'inline-block'
			})
				.siblings('.wpv-upload-clear').hide();
		},
		undo: function(id) {
			var inp = $('#' + id);
			this.preview(id, inp.data('undo'));
			inp.val(inp.data('undo'));
			inp.data('undo', '').siblings('.wpv-upload-undo').hide();
			var remove = inp.siblings('.wpv-upload-clear');
			if (inp.val().length === 0 && remove.is(':visible')) {
				remove.hide();
			} else if (inp.val().length > 0 && remove.is(':hidden')) {
				remove.css({
					display: 'inline-block'
				});
			}
		}
	};
})(jQuery);