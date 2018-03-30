/*
 * Project: Scrolly2 - Background Image Parallax
 * Originally based on Scrolly by Victor C. / Octave & Octave web agency
 * Rewritten and heavily adjusted by Benjamin Intal / Gambit
 */
(function ( $, window, document, undefined ) {

    var pluginName = 'scrolly2';

    function Plugin( element, options ) {
        this.$element = $(element);
        this.init();
    }

    Plugin.prototype.init = function () {

        // Declare vars
        var self               = this;
            this.startPosition = 0;
            this.offsetTop     = this.$element.offset().top;
            this.height        = this.$element.outerHeight(true);
            this.velocity      = this.$element.attr('data-velocity');
            this.direction     = this.$element.attr('data-direction');

        // Bind so that we don't refresh everytime
        $(window).bind('scroll', function() {
			self.scrolly2();
        });
    };

    Plugin.prototype.scrolly2 = function() {
        
        // Check if the element is inside our viewport, if it's not, don't do anything
        var viewTop = $(window).scrollTop() - 20; // with leeway
        var viewBottom = $(window).scrollTop() + $(window).height() + 20; // with leeway
        var elemTop = this.$element.offset().top;
        var elemBottom = this.$element.offset().top + this.$element.height();

        if ( elemTop >= viewBottom || elemBottom <= viewTop ) {
            return;
        }

        // If the element is below the fold, then we need to
        // make sure that when we first see the element,
        // our background image should be in the starting position
        if ( this.$element.offset().top > $(window).height() ) {
            if ( this.direction !== 'none' ) {
                this.startPosition = (this.$element.offset().top - $(window).height()) * Math.abs(this.velocity);
            }
        }

        // Calculate position
        var position = this.startPosition + $(window).scrollTop() * this.velocity;

        // Adjust position
        var xPos = "50%";
        var yPos = "50%";
        if ( this.direction === 'left' ) {
            xPos = position + 'px';
        } else if ( this.direction === 'right' ) {
            xPos = 'calc(100% + ' + -position + 'px)';
        } else if ( this.direction === 'down' ) {
            // yPos = 'calc(100% + ' + (-position) + 'px)';
            // Use this one for background-attachment: fixed
            var offset = - ( $(window).height() -
                         this.$element.offset().top -
                         this.$element.height() -
                         parseInt( this.$element.css('paddingTop') ) -
                         parseInt( this.$element.css('paddingBottom') ) );
            yPos = 'calc(100% + ' + ( offset - $(window).scrollTop() - position ) + 'px)';
        } else { // up
            // yPos = position + 'px';
            // Use this one for background-attachment: fixed
            yPos = ( this.$element.offset().top - $(window).scrollTop() + position ) + 'px';
        }
        this.$element.css( { backgroundPosition: xPos + ' ' + yPos } );
    };

    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
            }
        });
    };

})(jQuery, window, document);