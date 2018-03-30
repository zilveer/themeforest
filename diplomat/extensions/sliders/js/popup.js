(function($){
    
    var self,
        overlay,
        instances = [],
        defaults = {
            content: '',
            title: '',
            popup_id: '',
            popup_class: '',
            open: function(){},
            close: function(){},
            save: null /* optional callback */
        },
        zindex = 1002;
    
    self = $.tmm_popup = function(options) {
        
        self.options = $.extend({}, defaults, options);
        self.instance;
        self.doc = $(document);
        self.body = $('body');
        self.init();
        
    };
    
    self.init = function() {
        
        overlay = $('.tmm-popup-overlay');
        if (overlay.length < 1) {
            self.body.append('<div class="tmm-popup-overlay"></div>');
            overlay = $('.tmm-popup-overlay');
        }
     
        self.instance = $('<div class="tmm-popup"></div>').css('z-index', zindex++);
        
        if(self.options.popup_id !== ''){
            self.instance.attr('id', self.options.popup_id);
        }
        
        if(self.options.popup_class !== ''){
            self.instance.addClass(self.options.popup_class);
        }
        
        var title = '<h3 class="tmm-popup-title">' + self.options.title + '</h3>',
            output = '';
    
        output += '<div class="tmm-popup-wrapper">\
                        <div class="tmm-popup-header">' + title + '<a href="#close" class="tmm-popup-close">X</a></div>\
                        <div class="tmm-popup-content">' + self.options.content + '</div>\
                        <div class="tmm-popup-footer">' +
                            (self.options.save ? '<a href="#save" class="tmm-popup-save button button-primary button-large">' + tmm_lang['apply'] + '</a>' : '') +
                            '<a href="#close" class="tmm-popup-close button button-primary button-large">' + tmm_lang['close'] + '</a>\
                        </div>\
                    </div>';
        
        self.body.append(self.instance);
        self.instance.append(output);
        
        var data = {
            popup: self.instance,
            onclose: self.options.close,
            onsave: self.options.save
        };
        instances.push(data);

        self.set_events_handlers();
        self.open();
        
    };
    
    self.set_events_handlers = function() {
        
        var count_instances = instances.length,
            namespace = 'tmm_popup' + count_instances;
    
        self.instance.find('.tmm-popup-close').on('click.'+namespace, function() {
            self.close();
            return false;
        });

        self.doc.on('keydown.'+namespace, function (e) {
            var keycode = e.keyCode;
            switch(keycode) {
                case 13:
                    if(!$(e.target).hasClass('wp-editor-area')){
                        setTimeout(function () {
                            var save_button = self.instance.find('.tmm-popup-save');
                            if(save_button.length){
                                save_button.trigger('click.'+namespace);
                            }
                        }, 100);
                        e.stopImmediatePropagation();
                    }
                break;
                case 27:
                    setTimeout(function () {
                        self.close();
                    }, 100);
                    e.stopImmediatePropagation();
                break;
            }
        });
        
        self.instance.find('.tmm-popup-save').on('click.'+namespace, function() {
            var _this = instances[count_instances-1],
                onsave = _this.onsave;
                
            if ($.isFunction(onsave)) {
                onsave();
            }
            self.close();
            return false;
        });

    };
    
    self.open = function() {
        
        overlay.fadeIn(200);
        self.instance.fadeIn(200);
                
        if ($.isFunction(self.options.open)) {
            self.options.open();
        }
        
        self.instance.find('select, input[type=text], input[type=checkbox], textarea').eq(0).trigger('focus');
        
    };
    
    self.close = function() {
        
        var count_instances = instances.length;
           
        if(count_instances > 0){
            var _this = instances[count_instances-1],
                namespace = 'tmm_popup' + count_instances,
                popup = _this.popup,
                onclose = _this.onclose;

            popup.find('.tmm-popup-close').off('click.'+namespace);
            popup.find('.tmm-popup-save').off('click.'+namespace);
            self.doc.off('keydown.'+namespace);
            
            popup.fadeOut(300, function() {
                if ($.isFunction(onclose)) {
                    onclose();
                }
                $(this).remove();
                if($('.tmm-popup').length < 1){
                    overlay.hide();
                }
            });
            instances.pop();
        }
        
    };
  
}(jQuery));

jQuery(function() {
	jQuery('body').append('<div class="tmm-cc-info-popup"></div>');
});

function tmm_info_popup_show(text, autohide) {
	var popup = jQuery('.tmm-cc-info-popup');

	popup.text(text).fadeTo(400, 0.9);

	if(autohide){
		if(isNaN(autohide)){
			autohide = 1500;
		}
		window.setTimeout(function() {
			popup.fadeOut(600);
		}, autohide);
	}

}

function tmm_info_popup_hide() {
    jQuery(".tmm-cc-info-popup").fadeOut(400);
}

function tmm_uniqid() {
	var d = new Date(),
		uniqid = Math.random() * d.getTime();
	return Math.round(uniqid);
}