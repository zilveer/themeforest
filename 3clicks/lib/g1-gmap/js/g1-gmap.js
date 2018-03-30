/* global window */
/* global document */
/* global jQuery */
/* global G1 */
/* global google */
/* global InfoBox */

(function ($) {
    "use strict";

    $(window).load(function() {
        embedGMap();
    });

    $(document).ready(function () {
        enableGMapAnimation();
    });

    function embedGMap () {
        if (typeof google === 'undefined') {
            return;
        }

        var handler = function ($this) {
            var mapInPrefooter = $this.parents('#g1-prefooter').length > 0;
            var showMap = !G1.isAndroid || !mapInPrefooter;

            if (!showMap) {
                $this.parent('.g1-gmap-wrapper').remove();
                return;
            }

            var $wrapper = $this.parent('.g1-gmap-wrapper');
            var config = $this.metadata({ type: 'attr', name: 'data-g1-gmap-config' });
            var contentHtml = $this.find('.g1-gmap-content').html();

            var hasRichInterface = config.type === 'rich';

            var mapType = google.maps.MapTypeId.ROADMAP;

            if (typeof config.map_type !== 'undefined') {
                switch ( config.map_type ) {
                    case 'satellite':
                        mapType = google.maps.MapTypeId.SATELLITE;
                        break;

                    case 'hybrid':
                        mapType = google.maps.MapTypeId.HYBRID;
                        break;

                    case 'terrain':
                        mapType = google.maps.MapTypeId.TERRAIN;
                        break;
                }
            }

            var mapOptions = {
                center: new google.maps.LatLng(config.latitude, config.longitude),
                zoom: parseInt(config.zoom, 10),
                mapTypeId: mapType,
                draggable: !G1.isDesktop ? false : true,
                scrollwheel: false,
                mapTypeControl: hasRichInterface,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                panControl: false,
                zoomControl: false,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                },
                scaleControl: false,
                streetViewControl: false
            };

            var map = new google.maps.Map($this.get(0), mapOptions);

            if ( typeof G1.theme.gmapCustomConfig === 'function' ) {
                G1.theme.gmapCustomConfig(map, config);
            }

            google.maps.event.addListener(map, 'tilesloaded', function() {
                $wrapper.addClass('g1-gmap--loaded');
            });

            var styles = [];
            styles.push({ "invert_lightness": config.invert_lightness === '1' });

            if (config.color) {
                styles.push({ "hue": config.color_hue });
                styles.push({ "saturation": config.color_saturation });
                styles.push({ "lightness": config.color_lightness });
            }

            var mapStyles = [
                { "stylers": styles }
            ];

            map.setOptions({styles: mapStyles});

            if (config.marker !== 'none') {
                var markerConfig = {
                    position: mapOptions.center,
                    map: map,
                    animation: google.maps.Animation.DROP
                };

                if (config.marker_icon) {
                    markerConfig.icon = config.marker_icon;
                }

                var marker = new google.maps.Marker(markerConfig);

                // info window
                var $boxText =
                    $('<div class="g1-inner">').html(contentHtml);

                var myOptions = {
                    boxClass:'g1-gmap__box',
                    content:$boxText.get(0),
                    disableAutoPan:true,
                    maxWidth:0,
                    alignBottom:false,
                    pixelOffset:new google.maps.Size(0, 0),
                    zIndex:null,
                    closeBoxURL:"",
                    infoBoxClearance:new google.maps.Size(1, 1),
                    isHidden:false,
                    pane:"floatPane",
                    enableEventPropagation:false
                };

                var handleInfoBoxClose = function () {
                    myOptions.boxClass = 'g1-gmap__box';
                    ib.setOptions(myOptions);
                };

                var handleInfoBoxOpen = function () {
                    if (!contentHtml) {
                        return;
                    }

                    $(myOptions.content).toggle();
                };

                InfoBox.prototype.getCloseClickHandler_ = function () {
                    return handleInfoBoxClose;
                };

                var ib = new InfoBox(myOptions);
                ib.open(map, marker);

                if (!contentHtml || config.marker !== 'open-bubble') {
                    $(myOptions.content).hide();
                }

                // listeners
                google.maps.event.addListener(marker, 'click', function() {
                    handleInfoBoxOpen();
                });
            }

            // custom controls
            if (hasRichInterface) {
                var $zoomControl = $('<div>').addClass('g1-zoom-control');
                var $zoomIn = $('<div class="g1-zoom-in">');
                var $zoomOut = $('<div class="g1-zoom-out">');
                $zoomControl.append($zoomIn);
                $zoomControl.append($zoomOut);

                var $panControl = $('<div>').addClass('g1-pan-control');
                var $panTop = $('<div class="g1-top">');
                var $panRight = $('<div class="g1-right">');
                var $panBottom = $('<div class="g1-bottom">');
                var $panLeft = $('<div class="g1-left">');
                $panControl.append($panTop);
                $panControl.append($panRight);
                $panControl.append($panBottom);
                $panControl.append($panLeft);

                $wrapper.append($zoomControl);
                $wrapper.append($panControl);


                // full map
                var fullMapUrl = 'https://maps.google.com/?ll=' + config.latitude + ',' + config.longitude + '&z=' + config.zoom + '&daddr=' + config.latitude + ',' + config.longitude;
                var $fullMapControl = $('<div>')
                    .addClass('g1-full-map-control')
                    .html(
                        $('<a>')
                            .attr('target', '_blank')
                            .attr('href', fullMapUrl)
                    );

                $wrapper.append($fullMapControl);

                // handle zoom
                $zoomIn.click(function() {
                    map.setZoom(map.getZoom() + 1);

                    if (config.marker !== 'none') {
                        map.setCenter(marker.getPosition());
                    }
                });

                $zoomOut.click(function() {
                    map.setZoom(map.getZoom() - 1);

                    if (config.marker !== 'none') {
                        map.setCenter(marker.getPosition());
                    }
                });

                // handle pan
                $panTop.click(function() {
                    map.panBy(0,-150);

                });

                $panRight.click(function() {
                    map.panBy(150,0);

                });

                $panBottom.click(function() {
                    map.panBy(0,150);

                });

                $panLeft.click(function() {
                    map.panBy(-150,0);

                });
            }
        };

        $('.g1-gmap:visible').each(function () {
            var $this = $(this);

            if ($this.parents('.g1-gmap-wrapper').hasClass('g1-gmap--loaded')) {
                return;
            }

            handler($this);
        });

        $('body').on('g1ContentElementVisible', function (event, $element) {
            var $this = $element.find('.g1-gmap');

            if ($this.length === 0) {
                return;
            }

            if ($this.parents('.g1-gmap-wrapper').hasClass('g1-gmap--loaded')) {
                return;
            }

            handler($this);
        });
    }

    function enableGMapAnimation () {
        var isSmoothScrollEnabled = !G1.isIOS;

        $('#g1-precontent .g1-gmap').each(function () {
            var $target = $(this);

            var mapInPrefooter = $target.parents('#g1-prefooter').length > 0;
            var showMap = !G1.isAndroid || !mapInPrefooter;

            if (!showMap) {
                return;
            }

            var containerHeight = $target.parent().height();
            var height = $target.height();
            var scrollHeight = height - containerHeight;
            var halfScrollHeight = Math.round(scrollHeight / 2);

            if (precontentScrollEnabled() && isSmoothScrollEnabled && G1.theme.SKROLLR_ENABLED) {
                $target.attr('data-0', 'margin-top: -' + halfScrollHeight + 'px;');
                $target.attr('data-top-bottom', 'margin-top: -' + scrollHeight + 'px;');
            } else {
                $target.css('margin-top', '-' + halfScrollHeight + 'px');
            }
        });

        $('#g1-prefooter .g1-gmap').each(function () {
            var $target = $(this);

            var mapInPrefooter = $target.parents('#g1-prefooter').length > 0;
            var showMap = !G1.isAndroid || !mapInPrefooter;

            if (!showMap) {
                return;
            }

            var containerHeight = $target.parent().height();
            var height = $target.height();
            var scrollHeight = height - containerHeight;
            var halfScrollHeight = Math.round(scrollHeight / 2);

            if (prefooterScrollEnabled() && isSmoothScrollEnabled && G1.theme.SKROLLR_ENABLED) {
                $target.attr('data-bottom-top', 'margin-top: 0px;');
                $target.attr('data-end', 'margin-top: -' + halfScrollHeight + 'px;');
            } else {
                $target.css('margin-top', '-' + halfScrollHeight + 'px');
            }
        });
    }

    function prefooterScrollEnabled () {
        return typeof G1.theme.DISABLE_GMAP_SCROLL_IN_PREFOOTER !== 'undefined' ? G1.theme.DISABLE_GMAP_SCROLL_IN_PREFOOTER : true;
    }

    function precontentScrollEnabled () {
        return typeof G1.theme.DISABLE_GMAP_SCROLL_IN_PRECONTENT !== 'undefined' ? G1.theme.DISABLE_GMAP_SCROLL_IN_PRECONTENT : true;
    }
})(jQuery);