(function($, window)
{
	$(document).ready(function()
	{
		var laborator_fontello_select = $(".laborator_fontello_select");

		laborator_fontello_select.each(function(i, el)
		{
			var fontello_select = $(el),
				fontello_label = fontello_select.next(),
				fonts_list = fontello_select.parent().next(),
				fonts_list_span = fonts_list.find('span'),
				close_icons_tm;

			fontello_label.click(function()
			{
				fontello_select.focus();
			});

			fonts_list.hide();
			checkChanges();

			fontello_select.on({
				focus: function()
				{
					fonts_list.slideDown('normal');
					window.clearTimeout(close_icons_tm);
					close_icons_tm = null;
				},

				keyup: checkChanges,

				blur: function()
				{
					close_icons_tm = setTimeout(function()
					{
						fonts_list.slideUp();
					}, 200);
				}
			});

			fonts_list.on('click', 'span', function(ev)
			{
				var $this = $(this);

				fontello_select.val($this.data('icon')).focus();
				checkChanges();
			});


			function checkChanges()
			{
				fontello_label.attr('class', 'vc-icon-' + fontello_select.val());
				fonts_list_span.removeClass('current').filter('[data-icon="' + fontello_select.val() + '"]').addClass('current');
			}
		});

	});

})(jQuery, window);