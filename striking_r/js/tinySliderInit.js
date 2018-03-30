jQuery(document).ready(function($) {
    jQuery('.tinyslider_images').tinySlider({
        useCSS: false,
        onStart: function() {
            if (this.$element.data('caption') === 1) {
                this.caption = true;
                this.$caption = $('<div class="tinyslider_images-caption">').appendTo(this.$element);

                if (this.options.pager) {
                    this.$caption.width(this.$pager.find('li:first').position().left - 15);
                } else {
                    this.$caption.addClass('tiny_caption_bg');
                }

                var caption_text = this.$slides.eq(this.current).find('img').attr('alt');
                this.$caption.text(caption_text);
            } else {
                this.caption = false;
            }
            if (themeUpdateImages && typeof this.current !== 'undefined') {
                themeUpdateImages(this.$slides.eq(this.current).find('img'));
            }
        },
        onBefore: function(data) {
            if (this.caption) {
                var caption_text = this.$slides.eq(data.index).find('img').attr('alt');
                this.$caption.text(caption_text);
            }
        },
        onAfter: function(data) {
            if (themeUpdateImages && data && typeof data.index !== 'undefined') {
                themeUpdateImages(this.$slides.eq(data.index).find('img'));
            }
        },
        //onResize: function() {
            //if (this.caption && this.options.pager) {
            //    this.$caption.width(this.$pager.find('li:first').position().left - 10);
           // }
      // }
		
    });
});
