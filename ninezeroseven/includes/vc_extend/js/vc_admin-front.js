(function($) {
	"use strict";

    $('body').on('click','.wbc_vc_cats .term-list input', function(e){
        var values ='';

        var listArray = new Array();

        $(this).parents('.wbc_vc_cats').find('.term-list input').each(function(){

        	if($(this).is(':checked') && $(this).val()){
        		listArray.push($(this).val());
        		
        	}

        });

        if(listArray.length > 0){
        	values = listArray.join();
        }

        $(this).parents('.wbc_vc_cats').parent().find('input.wbc_categories_field').attr('value',values);

    });
    
})(window.jQuery);

(function($) {
	"use strict";
	
	window.InlineShortcodeView_wbc_list = window.InlineShortcodeViewContainer.extend({
		render: function() {
			var modal_id = this.model.get('id');
			
			var iconstyle = jQuery(this.$el.find('.wbc-list')).data('icon-style');
			var iconclass = jQuery(this.$el.find('.wbc-list')).data('icon-class');

			var liststyle = jQuery(this.$el.find('.wbc-list')).data('list-style');

			var icontype = jQuery(this.$el.find('.wbc-list')).data('icon-type');

			window.InlineShortcodeView_wbc_list.__super__.render.call(this);

			var wbc_list_item = jQuery("iframe").contents().find('div[data-model-id="'+modal_id+'"]');

			wbc_list_item.find("li").each(function(index, element) {
				jQuery(this).attr('style',liststyle);
				var currentClasses = '';
				if(icontype.length > 0){
					currentClasses = currentClasses + ' wbc-icon-'+icontype;
				}

				if(iconclass.length > 0){
					iconclass = iconclass.replace(/wbc-icon/,'');
					currentClasses = currentClasses + ' ' +iconclass;
				}

				jQuery(this).find('.wbc-icon-wrapper').attr('class', 'wbc-icon-wrapper ' + currentClasses);
				jQuery(this).find('.wbc-icon').attr('style',iconstyle);
			});

			return this;
		},
	});

	window.InlineShortcodeView_wbc_list_item = window.InlineShortcodeView.extend({
		render: function() {
			var modal_id = this.model.get('id');
			var iconstyle = jQuery("iframe").contents().find('div[data-model-id="'+modal_id+'"]').parents('.wbc-list').data('icon-style');
			var iconclass = jQuery("iframe").contents().find('div[data-model-id="'+modal_id+'"]').parents('.wbc-list').data('icon-class');
			var icontype = jQuery("iframe").contents().find('div[data-model-id="'+modal_id+'"]').parents('.wbc-list').data('icon-type');

			var liststyle = jQuery("iframe").contents().find('div[data-model-id="'+modal_id+'"]').parents('.wbc-list').data('list-style');
			
			window.InlineShortcodeView_wbc_list_item.__super__.render.call(this);
			jQuery(this.$el.find('li')).each(function(index, element) {
				jQuery(this).attr('style',liststyle);

				if(icontype.length > 0){
					jQuery(this).find('.wbc-icon-wrapper').addClass('wbc-icon-'+icontype);
				}

				if(iconclass.length > 0){
					iconclass = iconclass.replace(/wbc-icon/,'');
					jQuery(this).find('.wbc-icon-wrapper').addClass(iconclass);
				}
				jQuery(this).find('.wbc-icon').attr('style',iconstyle);
			});
			
			return this;
		},
	});

	window.InlineShortcodeView_wbc_portfolio_carousel = window.InlineShortcodeView.extend({
		render: function() {
			
			window.InlineShortcodeView_wbc_portfolio_carousel.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();
					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_portfolio = window.InlineShortcodeView.extend({
		render: function() {
			
			window.InlineShortcodeView_wbc_portfolio.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();
					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_blog = window.InlineShortcodeView.extend({
		render: function() {
			// jQuery('.wbc-video-wrap').remove();
			window.InlineShortcodeView_wbc_blog.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();
					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_button = window.InlineShortcodeView.extend({
		render: function() {
			// jQuery('.wbc-video-wrap').remove();
			window.InlineShortcodeView_wbc_button.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();
					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_countup = window.InlineShortcodeView.extend({
		render: function() {
			// jQuery('.wbc-video-wrap').remove();
			window.InlineShortcodeView_wbc_countup.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();

					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_progress = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_wbc_progress.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();

					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_logo = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_wbc_logo.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();

					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_logos = window.InlineShortcodeViewContainer.extend({
		render: function() {
			window.InlineShortcodeView_wbc_logos.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();
					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_testimonial = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_wbc_testimonial.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();

					}
			    
			 	});
			
			return this;
		}
	});

	window.InlineShortcodeView_wbc_testimonials = window.InlineShortcodeViewContainer.extend({
		render: function() {
			window.InlineShortcodeView_wbc_testimonials.__super__.render.call(this);

				vc.frame_window.vc_iframe.addActivity(function(){
					if (typeof vc.frame_window['wbcFrontEditor'] === 'function') {
							vc.frame_window.wbcFrontEditor();
					}
			    
			 	});
			
			return this;
		}
	});

})(jQuery);