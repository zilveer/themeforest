(function($) {
    $(document).ready(function () {
        var findInput = function (corner, $context) {
            return $context.parents('.g1-border-radius').find('input.g1-border-radius-value-' + corner);
        };

        var getCornerName = function ($elem) {
            return $elem.attr('data-g1-corner');
        };

        var removeTypeClass = function ($elem) {
            var matches = $elem.attr('class').match(/g1-type-([^\s]+)/);

            if (matches) {
                $elem.removeClass('g1-type-' + matches[1]);
            }
        };

        var setCorner = function ($borderElem, className) {
            var corner = getCornerName($borderElem);
            var type = className.replace('g1-type-', '');

            removeTypeClass($borderElem);
            $borderElem.addClass(className);
            findInput(corner, $borderElem).val(type);
        };

        var setBorderTypeCallback = function ($elem, classes) {
            for (var i = 0; i < classes.length; i++) {
                var className = classes[i];
                var finalClassName;

                if ($elem.is('.' + className)) {
                    if (i + 1 < classes.length) {
                        finalClassName = classes[(i+1)];
                    } else {
                        finalClassName = classes[0];
                    }
                    break;
                }
            }

            if (typeof finalClassName !== 'undefined') {
                setCorner($elem, finalClassName);
            }
        };

        $('.g1-border-radius .g1-configurator').each(function() {
            var $configurator = $(this);
            var classes = $configurator.attr('data-g1-classes').split(',');

            $configurator.find('.g1-border').each(function() {
                var $this = $(this);
                var $input = findInput(getCornerName($this), $this);

                if ($input.val() === '') {
                    setCorner($this, classes[0]);
                } else {
                    setCorner($this, 'g1-type-' + $input.val());
                }

                $this.click(function () {
                    setBorderTypeCallback($(this), classes);
                });
            });
        });
    });
})(jQuery);





