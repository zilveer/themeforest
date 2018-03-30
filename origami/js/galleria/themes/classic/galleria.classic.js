/*!
 * Galleria Classic Theme
 * http://galleria.aino.se
 *
 * Copyright (c) 2010, Aino
 * Licensed under the MIT license.
 */

(function($) {

Galleria.addTheme({
    name: 'classic',
    author: 'Galleria',
    version: '1.2',
    css: 'galleria.classic.css',
    defaults: {
        transition: 'slide',
        show_caption: false,
        thumb_crop: 'height'
    },
    init: function(options) {
        
        this.addElement('info-link','info-close');
        this.append({
            'info' : ['info-link','info-close']
        });
        
        this.$('loader').show().fadeTo(200, .4);
        this.$('counter').show().fadeTo(200, .4);
        
        this.$('thumbnails').children().hover(function() {
            $(this).not('.active').children().stop().fadeTo(100, 1);
        }, function() {
            $(this).not('.active').children().stop().fadeTo(400, .8);
        }).not('.active').children().css('opacity',.4);
        
        this.$('container').hover(this.proxy(function() {
            this.$('image-nav-left,image-nav-right,counter').fadeIn(200);
        }), this.proxy(function() {
            this.$('image-nav-left,image-nav-right,counter').fadeOut(500);
        }));
        
        this.$('image-nav-left,image-nav-right,counter').hide();
        
        var elms = this.$('info-link,info-close,info-text').click(function() {
            elms.toggle();
        });
        
        if (options.show_caption) {
            elms.trigger('click');
        }
        
        this.bind(Galleria.LOADSTART, function(e) {
            if (!e.cached) {
                this.$('loader').show().fadeTo(200, .8);
            }
            if (this.hasInfo()) {
                this.$('info').show();
            } else {
                this.$('info').hide();
            }
            jQuery(e.thumbTarget).css('opacity',1).parent().addClass('active')
                .siblings('.active').removeClass('active').children().css('opacity',.8);
        });

        this.bind(Galleria.LOADFINISH, function(e) {
            this.$('loader').fadeOut(200);
            jQuery(e.thumbTarget).css('opacity',1)
			
			var imgWidth = jQuery(e.imageTarget).parent().width() -18;
			var imgHeight = jQuery(e.imageTarget).parent().height() -42;
			
			jQuery(e.imageTarget).attr( 'width', imgWidth );
			jQuery(e.imageTarget).attr( 'height', imgHeight );
			jQuery(e.imageTarget).addClass('origamiFrame galleria-image-inline');
			jQuery(e.imageTarget).parent().css( 'height', imgHeight +18);
        });
    }
});

})(jQuery);