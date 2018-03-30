(function($) {
    'use strict';

    var core = MK.core,
        path = core.path;

    MK.component.Chart = function(el) {
        var init = function() {
            MK.core.loadDependencies([MK.core.path.plugins + 'jquery.easyPieChart.js'], function() {
                $('.mk-chart__chart').each(function() {
                    var $this = $(this),
                        $parent_width = $(this).parent().width(),
                        $chart_size = parseInt($this.attr('data-barSize'));

                    if ($parent_width < $chart_size) {
                        $chart_size = $parent_width;
                        $this.css('line-height', $chart_size);
                        $this.find('i').css({
                            'line-height': $chart_size + 'px'
                        });
                        $this.css({
                            'line-height': $chart_size + 'px'
                        });
                    }

                    var build = function() {
                        $this.easyPieChart({
                            animate: 1300,
                            lineCap: 'butt',
                            lineWidth: $this.attr('data-lineWidth'),
                            size: $chart_size,
                            barColor: $this.attr('data-barColor'),
                            trackColor: $this.attr('data-trackColor'),
                            scaleColor: 'transparent',
                            onStep: function(value) {
                                this.$el.find('.chart-percent span').text(Math.ceil(value));
                            }
                        });
                    };

                    // refactored only :in-viewport logic. rest is to-do
                    MK.utils.scrollSpy(this, {
                        position: 'bottom',
                        after: build
                    });
                });
            });
        };

        return {
            init: init
        };
    };

})(jQuery);
