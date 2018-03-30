/* =========================================================
 * jquery.vc_chart.js v1.0
 * =========================================================
 * Copyright 2013 Wpbakery
 *
 * Jquery chart plugin for the Visual Composer(modified).
 * ========================================================= */
(function($){
    /**
     * Pie chart animated.
     * @param element - DOM element
     * @param options - settings object.
     * @constructor
     */
    var VcChart = function(element, options) {
        this.el = element;
        this.$el = $(this.el);
        this.options = $.extend({
            color: '',
            units: '',
            units_color: '',
            content_selector: '.vsc_pie_chart_inside',
            number_selector: '.vsc_pie_chart_value',
            icon_selector: '.vsc_pie_chart_icon',
            heading_selector: '.vsc_pie_wrapper .wpb_pie_chart_heading',
            back_selector: '.vsc_pie_chart_back',
            responsive: true
        }, options);
        this.init();
    };
    VcChart.prototype = {
        constructor: VcChart,
        _progress_v: 0,
        animated: false,
        i: 1,
        init: function() {
            this.setupColor();
            this.value = this.$el.data('pie-value')/100;
            this.label_value = this.$el.data('pie-label-value') || this.$el.data('pie-value');
            this.$wrapper = $('.vsc_pie_wrapper', this.$el);
            this.$inside = $(this.options.content_selector, this.$el);
            this.$number = $(this.options.number_selector, this.$el);
            this.$icon = $(this.options.icon_selector, this.$el);
            this.$heading = $(this.options.heading_selector, this.$el);
            this.$back = $(this.options.back_selector, this.$el);
            this.$canvas = this.$el.find('canvas');
            this.draw();
            this.setWayPoint();
            if(this.options.responsive === true) this.setResponsive();

        },
        setupColor: function() {
            if (typeof this.options.color === 'string' && this.options.color.match(/^rgba?\([^\)]+\)/)) {
                this.color = this.options.color;
            } else {
                this.color = 'rgba(26, 198, 255, 0.2)';
            }
        },
        setResponsive: function() {
            var that = this;
            $(window).resize(function(){
                that.redraw();
            });
        },
        redraw: function () {
            if(this.animated === true) this.circle.stop();
            this.draw(true);
        },
        changeColor: function (param) {
            redraw = false;

            if ( typeof param == 'object' ) {
                if ( param.color ) color = param.color;
                if ( param.redraw ) redraw = param.redraw;
            }else if ( typeof param == 'string' ) {
                color = param;
            }

            if ( color ) {
                this.color = color;
            }

            if ( redraw ) {
                this.redraw();
            }
        },
        draw: function(redraw) {
            var w = this.$el.addClass('vsc_ready').width(),
                border_w = parseInt(this.$el.attr('data-thickness')) - 2,
                radius;

            if (!w) w = this.$el.parents(':visible').first().width()-2;

            if ( this.$wrapper.attr('data-radius').length && parseInt(this.$wrapper.attr('data-radius')) <= w/2 && parseInt(this.$wrapper.attr('data-radius')) > 0 ) w = parseInt(this.$wrapper.attr('data-radius'))*2;
            else w = w/100*80;

            if ( border_w >= w/2 - 1 ) {
                border_w = w/2 - 2;
            }

            this.$el.find('.vsc_pie_chart_back').css('border-width', border_w);

            if ( w >= 500 ) w = 500;

            radius = w/2 - border_w - 1;

            this.$wrapper.css({"width" : w + "px"});
            if ( !this.$inside.length ) {
                this.$number.css({"width" : w, "height" : w, "line-height" : w+"px"});
                this.$icon.css({"width" : w, "height" : w, "line-height" : w+"px"});
                this.$icon.css( "font-size", (w - border_w) * 0.25 );
                this.$heading.css({"width" : w, "height" : w, "line-height" : w+"px"});
            }
            this.$back.css({"width" : w, "height" : w});
            this.$canvas.attr({"width" : w + "px", "height" : w + "px"});
            this.$el.addClass('vsc_ready');
            this.circle = new ProgressCircle({
                canvas: this.$canvas.get(0),
                minRadius: radius + 2,
                arcWidth: border_w - 2
            });
            if(redraw === true && this.animated === true) {
                this._progress_v = this.value;
                this.circle.addEntry({
                    fillColor: this.color,
                    progressListener: $.proxy(this.setProgress, this)
                }).start(10);
            }
        },
        setProgress: function() {
            var units_html = '<span style="color: ' + this.options.units_color + ';">' + this.options.units + '</span>'

            if (this._progress_v >= this.value) {
                this.circle.stop();
                this.$number.html(this.label_value + units_html);
                return this._progress_v;
            }

            t = this.i/100;
            this.i++;
            this._progress_v += this.value*(t/=5)*t;

            if ( this.$el.hasClass('no-animation') ) {
                this._progress_v = this.value;
            }

            var label_value = this._progress_v/this.value*this.label_value;
            var val = Math.round(label_value).toString() + units_html;
            this.$number.html(val);
            return this._progress_v;
        },
        animate: function() {
            if(this.animated !== true) {
                this.animated = true;
                this.circle.addEntry({
                    fillColor: this.color,
                    progressListener: $.proxy(this.setProgress, this)
                }).start(10);
            }
        },
        setWayPoint: function() {
            if (typeof $.fn.waypoint !== 'undefined') {
                this.$el.waypoint($.proxy(this.animate, this), { offset: '85%' });
            } else {
                this.animate();
            }
        }
    };
    /**
     * jQuery plugin
     * @param option - object with settings
     * @return {*}
     */
    $.fn.vcChat = function(option, value) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('vsc_chart'),
                options = typeof option === 'object' ? option : {
                    color: $this.data('pie-color') || $('.back-to-top i').css('color'),
                    units: $this.data('pie-units'),
                    units_color: $this.data('pie-units-color')
                };

            if (typeof option == 'undefined') $this.data('vsc_chart', (data = new VcChart(this, options)));
            if (typeof option == 'string' && data && typeof data[option] == 'function') data[option](value);
        });
    };
    /**
     * Allows users to rewrite function inside theme.
     */
    if ( typeof window['vc_pieChart'] !== 'function' ) {
        window.vc_pieChart = function() {
            $('.vsc_pie_chart:visible').vcChat();
        }
    }
    $(document).ready(function(){
        !window.vc_iframe && vc_pieChart();
    });

})(window.jQuery);
