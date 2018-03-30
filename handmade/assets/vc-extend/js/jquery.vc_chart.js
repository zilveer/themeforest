/* =========================================================
 * jquery.vc_chart.js v1.0
 * =========================================================
 * Copyright 2013 Wpbakery
 *
 * Jquery chart plugin for the Visual Composer.
 * ========================================================= */
/* =========================================================
 * jquery.vc_chart.js v1.0
 * =========================================================
 * Copyright 2013 Wpbakery
 *
 * Jquery chart plugin for the Visual Composer.
 * ========================================================= */
(function ( $ ) {
    /**
     * Pie chart animated.
     * @param element - DOM element
     * @param options - settings object.
     * @constructor
     */
    function VcChart( element, options ) {
        this.el = element;
        this.$el = $( this.el );
        this.options = $.extend( {
            color: '#f7f7f7',
            units: '',
            icon:0,
            label_selector: '.vc_pie_chart_value',
            back_selector: '.vc_pie_chart_back',
            responsive: true
        }, options );
        this.init();
    }

    VcChart.prototype = {
        constructor: VcChart,
        _progress_v: 0,
        animated: false,
        init: function () {
            this.color = this.options.color;
            this.value = this.$el.data( 'pie-value' ) / 100;
            this.label_value = this.$el.data( 'pie-label-value' ) || this.$el.data( 'pie-value' );
            this.$wrapper = $( '.vc_pie_wrapper', this.$el );
            this.$label = $( this.options.label_selector, this.$el );
            this.$back = $( this.options.back_selector, this.$el );
            this.$canvas = this.$el.find( 'canvas' );
            this.draw();
            this.setWayPoint();
            if ( true === this.options.responsive ) {
                this.setResponsive();
            }
        },
        setResponsive: function () {
            var that = this;
            $( window ).resize( function () {
                if ( true === that.animated ) {
                    that.circle.stop();
                }
                that.draw( true );
            } );
        },
        draw: function ( redraw ) {
            var w = this.$el.addClass( 'vc_ready' ).width(),
                border_w = 4.5,
                radius;
            if ( ! w ) {
                w = this.$el.parents( ':visible' ).first().width() - 2;
            }
            w = w / 100 * 80;
            radius = w / 2 - border_w - 0.5;
            this.$wrapper.css( { "width": w + "px" } );
            this.$label.css( { "width": w, "height": w, "line-height": w + "px" } );
            this.$back.css( { "width": w, "height": w } );
            this.$canvas.attr( { "width": w + "px", "height": w + "px" } );
            this.$el.addClass( 'vc_ready' );

            this.circle = new ProgressCircle( {
                canvas: this.$canvas.get( 0 ),
                minRadius: radius,
                arcWidth: border_w
            } );
            if ( true === redraw && true === this.animated ) {
                this._progress_v = this.value;
                this.circle.addEntry( {
                    fillColor: this.color,
                    progressListener: $.proxy( this.setProgress, this )
                } ).start();
            }
        },
        setProgress: function () {
            if ( this._progress_v >= this.value ) {
                this.circle.stop();
                if(this.options.icon=="0")
                {
                    this.$label.text( this.label_value + this.options.units );
                }
                return this._progress_v;
            }
            this._progress_v += 0.005;
            var label_value = this._progress_v / this.value * this.label_value;
            var val = Math.round( label_value ) + this.options.units;
            if(this.options.icon=="0")
            {
                this.$label.text(val);
            }
            return this._progress_v;
        },
        animate: function () {
            if ( true !== this.animated ) {
                this.animated = true;
                this.circle.addEntry( {
                    fillColor: this.color,
                    progressListener: $.proxy( this.setProgress, this )
                } ).start( 5 );
            }
        },
        setWayPoint: function () {
            if ( 'undefined' !== typeof($.fn.waypoint) ) {
                this.$el.waypoint( $.proxy( this.animate, this ), { offset: '85%' } );
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
    $.fn.vcChat = function ( option, value ) {
        return this.each( function () {
            var $this = $( this ),
                data = $this.data( 'vc_chart' ),
                options = 'object' === typeof(option) ? option : {
                    color: $this.data( 'pie-color' ),
                    units: $this.data( 'pie-units' ),
                    icon:$this.data('pie-icon')
                };
            if ( 'undefined' === typeof(option) ) {
                $this.data( 'vc_chart', (data = new VcChart( this, options )) );
            }
            if ( 'string' === typeof(option) ) {
                data[ option ]( value );
            }
        } );
    };
    /**
     * Allows users to rewrite function inside theme.
     */
    if ( 'function' !== typeof(window[ 'vc_pieChart' ]) ) {
        window.vc_pieChart = function () {
            $( '.vc_pie_chart:visible' ).vcChat();
        }
    }
    $( document ).ready( function () {
        ! window.vc_iframe && vc_pieChart();
    } );

})( window.jQuery );
(function(window, document, undefined) {

    /**
     * Find the absolute position of an element
     */
    var absPos = function(element) {
        var offsetLeft, offsetTop;
        offsetLeft = offsetTop = 0;
        if (element.offsetParent) {
            do {
                offsetLeft += element.offsetLeft;
                offsetTop += element.offsetTop;
            } while (element = element.offsetParent);
        }
        return [offsetLeft, offsetTop];
    };

    /**
     * @constructor Progress Circle class
     * @param params.canvas Canvas on which the circles will be drawn.
     * @param params.minRadius Inner radius of the innermost circle, in px.
     * @param params.arcWidth Width of each circle(to be more accurate, ring).
     * @param params.gapWidth Space between each circle.
     * @param params.centerX X coordinate of the center of circles.
     * @param params.centerY Y coordinate of the center of circles.
     * @param params.infoLineBaseAngle Base angle of the info line.
     * @param params.infoLineAngleInterval Angles between the info lines.
     */
    var ProgressCircle = function(params) {
        this.canvas = params.canvas;
        this.minRadius = params.minRadius || 15;
        this.arcWidth = params.arcWidth || 5;
        this.gapWidth = params.gapWidth || 3;
        this.centerX = params.centerX || this.canvas.width / 2;
        this.centerY = params.centerY || this.canvas.height / 2;
        this.infoLineLength = params.infoLineLength || 60;
        this.horizLineLength = params.horizLineLength || 10;
        this.infoLineAngleInterval = params.infoLineAngleInterval || Math.PI / 8;
        this.infoLineBaseAngle = params.infoLineBaseAngle || Math.PI / 6;

        this.context = this.canvas.getContext('2d');

        this.width = this.canvas.width;
        this.height = this.canvas.height;

        this.circles = [];
        this.runningCount = 0;
    };

    ProgressCircle.prototype = {
        constructor: ProgressCircle,

        /**
         * @method Adds an progress monitor entry.
         * @param params.fillColor Color to fill in the circle.
         * @param params.outlineColor Color to outline the circle.
         * @param params.progressListener Callback function to fetch the progress.
         * @param params.infoListener Callback function to fetch the info.
         * @returns this
         */
        addEntry: function(params) {
            this.circles.push(new Circle({
                canvas: this.canvas,
                context: this.context,
                centerX: this.centerX,
                centerY: this.centerY,
                innerRadius: this.minRadius + this.circles.length *
                    (this.gapWidth + this.arcWidth),
                arcWidth: this.arcWidth,
                infoLineLength: this.infoLineLength,
                horizLineLength: this.horizLineLength,

                id: this.circles.length,
                fillColor: params.fillColor,
                outlineColor: params.outlineColor,
                progressListener: params.progressListener,
                infoListener: params.infoListener,
                infoLineAngle: this.infoLineBaseAngle +
                    this.circles.length * this.infoLineAngleInterval,
            }));

            return this;
        },

        /**
         * @method Starts the monitor and updates with the given interval.
         * @param interval Interval between updates, in millisecond.
         * @returns this
         */
        start: function(interval) {
            var self = this;
            this.timer = setInterval(function() {
                self._update();
            }, interval || 33);

            return this;
        },

        /**
         * @method Manually update all circles
         */
        update: function(value) {
            this._update(value);
        },

        /**
         * @method Stop the animation.
         */
        stop: function() {
            clearTimeout(this.timer);
        },

        /**
         * @private
         * @method Call update on each circle and redraw them.
         * @param value Value to be passed to circle update method (in case of manual update)
         * @returns this
         */
        _update: function(value) {
            this._clear();
            this.circles.forEach(function(circle, idx, array) {
                circle.update(value);
            });

            return this;
        },

        /**
         * @private
         * @method Clear the canvas.
         * @returns this
         */
        _clear: function() {
            this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);

            return this;
        },

    };

    /**
     * @private
     * @class Individual progress circle.
     * @param params.canvas Canvas on which the circle will be drawn.
     * @param params.context Context of the canvas.
     * @param params.innerRadius Inner radius of the circle, in px.
     * @param params.arcWidth Width of each arc(circle).
     * @param params.gapWidth Distance between each arc.
     * @param params.centerX X coordinate of the center of circles.
     * @param params.centerY Y coordinate of the center of circles.
     * @param params.fillColor Color to fill in the circle.
     * @param params.outlineColor Color to outline the circle.
     * @param params.progressListener Callback function to fetch the progress.
     * @param params.infoListener Callback function to fetch the info.
     * @param params.infoLineAngle Angle of info line.
     */
    var Circle = function(params) {
        this.id = params.id;
        this.canvas = params.canvas;
        this.context = params.context;
        this.centerX = params.centerX;
        this.centerY = params.centerY;
        this.arcWidth = params.arcWidth;
        this.innerRadius = params.innerRadius || 0;
        this.fillColor = params.fillColor || '#fff';
        this.outlineColor = params.outlineColor || this.fillColor;
        this.progressListener = params.progressListener;
        this.infoLineLength = params.infoLineLength || 250;
        this.horizLineLength = params.horizLineLength || 50;
        this.infoListener = params.infoListener;
        this.infoLineAngle = params.infoLineAngle;

        this.outerRadius = this.innerRadius + this.arcWidth;

        // If the info listener is not registered, then don't calculate
        // the related coordinates
        if (!this.infoListener) return;

        // calculate the info-line turning points
        var angle = this.infoLineAngle,
            arcDistance = (this.innerRadius + this.outerRadius) / 2,

            sinA = Math.sin(angle),
            cosA = Math.cos(angle);

        this.infoLineStartX = this.centerX + sinA * arcDistance;
        this.infoLineStartY = this.centerY - cosA * arcDistance;

        this.infoLineMidX = this.centerX + sinA * this.infoLineLength;
        this.infoLineMidY = this.centerY - cosA * this.infoLineLength;

        this.infoLineEndX = this.infoLineMidX +
            (sinA < 0 ? -this.horizLineLength : this.horizLineLength);
        this.infoLineEndY = this.infoLineMidY;

        var infoText = document.createElement('div'),
            style = infoText.style;

        style.color = this.fillColor;
        style.position = 'absolute';
        style.left = this.infoLineEndX + absPos(this.canvas)[0] + 'px';
        // style.top will be calculated in the `drawInfo` method. Since
        // user may want to change the size of the font, so the top offset
        // must be updated in each loop.
        infoText.className = 'ProgressCircleInfo'; // For css styling
        infoText.id = 'progress_circle_info_' + this.id;
        document.body.appendChild(infoText);
        this.infoText = infoText;
    };

    Circle.prototype = {
        constructor: Circle,

        update: function(value) {
            this.progress = value || this.progressListener();
            this._draw();

            if (this.infoListener) {
                this.info = this.infoListener();
                this._drawInfo();
            }
        },

        /**
         * @private
         * @method Draw the circle on the canvas.
         * @returns this
         */
        _draw: function() {
            var ctx = this.context,

                ANGLE_OFFSET = -Math.PI / 2,

                startAngle = 0 + ANGLE_OFFSET,
                endAngle= startAngle + this.progress * Math.PI * 2,

                x = this.centerX,
                y = this.centerY,

                innerRadius = this.innerRadius,
                outerRadius = this.outerRadius;

            ctx.fillStyle = this.fillColor;
            ctx.strokeStyle = this.outlineColor;

            ctx.beginPath();
            ctx.arc(x, y, innerRadius, startAngle, endAngle, false);
            ctx.arc(x, y, outerRadius, endAngle, startAngle, true);
            ctx.closePath();
            ctx.stroke();
            ctx.fill();

            return this;
        },

        /**
         * @private
         * @method Draw the info lines and info text.
         * @returns this
         */
        _drawInfo: function() {

            var pointList, lineHeight;

            pointList = [
                [this.infoLineStartX, this.infoLineStartY],
                [this.infoLineMidX, this.infoLineMidY],
                [this.infoLineEndX, this.infoLineEndY],
            ];
            this._drawSegments(pointList, false);

            this.infoText.innerHTML = this.info;

            lineHeight = this.infoText.offsetHeight;
            this.infoText.style.top = this.infoLineEndY +
                absPos(this.canvas)[1] - lineHeight / 2 + 'px';

            return this;
        },

        /**
         * @private
         * @method Helper function to draw the segments
         * @param pointList An array of points in the form of [x, y].
         * @param close Whether to connect the first and last point.
         */
        _drawSegments: function(pointList, close) {
            var ctx = this.context;

            ctx.beginPath();
            ctx.moveTo(pointList[0][0], pointList[0][1]);
            for (var i = 1; i < pointList.length; ++i) {
                ctx.lineTo(pointList[i][0], pointList[i][1]);
            }

            if (close) {
                ctx.closePath();
            }
            ctx.stroke();
        },
    };

    window.ProgressCircle = ProgressCircle;

})(window, document);