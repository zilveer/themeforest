 /**
  -webkit-background-clip: text Polyfill

  # What? #
  A polyfill which replaces the specified element with a SVG
  in browser where "-webkit-background-clip: text"
  is not available.

  Fork it on GitHub
  https://github.com/TimPietrusky/background-clip-text-polyfill

  # 2013 by Tim Pietrusky
  # timpietrusky.com
**/

Element.prototype.backgroundClipPolyfill = function () { // 2013 by Tim Pietrusky timpietrusky.com
    var a = arguments[0],
        d = document,
        b = d.body,
        el = this;

    function addAttributes(el, attributes) {
        for (var key in attributes) {
            el.setAttribute(key, attributes[key]);
        }
    }

    function createSvgElement(tagname) {
        return d.createElementNS('http://www.w3.org/2000/svg', tagname);
    }

    function createSVG() {
        var a = arguments[0],
            svg = createSvgElement('svg'),
            pattern = createSvgElement('pattern'),
            image = createSvgElement('image'),
            text = createSvgElement('text');

        addAttributes(svg, {
            'width' : window.svgHeadline[a.number].parentWidth,
            'height' : window.svgHeadline[a.number].parentHeight
        });

        // Add attributes to elements
        addAttributes(pattern, {
            'id' : a.id,
            'patternUnits' : 'userSpaceOnUse',
            'width' : window.svgHeadline[a.number].parentWidth,
            'height' : window.svgHeadline[a.number].parentHeight
        });

        addAttributes(image, {
            'width' : '100%',
            'height' : '100%',
            'preserveAspectRatio' : 'xMinYMin slice'
        });

        image.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', a.url);


        addAttributes(text, {
            'width': window.svgHeadline[a.number].width,
            'height': window.svgHeadline[a.number].height,
            'x' : window.svgHeadline[a.number].left + 3,
            'y' : window.svgHeadline[a.number].top,
            'class' : a['class'],
            'style' : window.svgHeadline[a.number].style + 'fill:url(#' + a.id + ');'
        });

        // Set text
        text.textContent = a.text;

        svg.appendChild(text);
        // Add elements to pattern
        pattern.appendChild(image);

        // Add elements to SVG
        svg.appendChild(pattern);

        return svg;
    };

  /*
   * Replace the element if background-clip
   * is not available.
   */
    var img = new Image();
    img.onload = function() {
        var svg = createSVG({
            'number': a.number,
            'id' : a.patternID,
            'url' : a.patternURL,
            'class' : a['class'],
            'width' : this.width,
            'height' : this.height,
            'text' : el.textContent
        });

        el.parentNode.replaceChild(svg, el);
    }

    img.src = a.patternURL;
};

rebuildWithSvg = function () {
    window.svgHeadline = {};

    $.each($('.canvas-headline'), function (i) {
        var parentWidth = $(this).parent().width()
            thisWidth = $(this).width(),
            styles = '';

        styles += 'font: ' + $(this).css('font-style') + ' ' + $(this).css('font-weight') + ' ' + $(this).css('font-size') + ' '+ $(this).css('font-family') + '; ';

        if ( $(this).closest('.canvas-title-block').length ) {
            window.svgHeadline[i] = {
                parentWidth: $(this).outerWidth(),
                parentHeight: $(this).outerHeight(),
                width: $(this).find('.text').width(),
                height: $(this).find('.text').height(),
                top: parseInt($(this).css('padding-top').replace('px', '')) + $(this).find('.text').height() * 0.80,
                left: $(this).find('.text').offset().left - $(this).offset().left,
                style: styles
            }
        } else {
            window.svgHeadline[i] = {
                parentWidth: $(this).width(),
                parentHeight: $(this).height(),
                width: $(this).find('.text').width(),
                height: $(this).find('.text').height(),
                top: $(this).height() * 0.87,
                left: $(this).find('.text').offset().left - $(this).offset().left,
                style: styles
            }
        }

        this.backgroundClipPolyfill({
            'number' : i,
            'patternID' : 'mypattern_'+ i,
            'patternURL' : $(this).attr('data-img'),
            'class' : 'canvas-headline'
        });
    });
}

$(document).on('ready', function () {
    if ( $('.canvas-title-block').length ) {
        $.each($('.canvas-title-block'), function () {
            var $column = $(this).closest('.wpb_column');
            if ( $column.outerWidth() == $(window).width() ) {
                $column.css({ 'padding-left': 0, 'padding-right': 0 });
            }
        });
    }

    if ( document.body.style.webkitBackgroundClip == undefined ) setTimeout(function () { rebuildWithSvg(); }, 400);
});
