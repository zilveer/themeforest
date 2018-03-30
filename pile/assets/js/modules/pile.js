var Pile = (function() {

    function initialize() {
        if (globalDebug) { console.group("pile::initialize"); }

        $('.pile-item').each(function (i, item) {

            var $item       = $(item),
                itemOffset  = $item.offset(),
                itemHeight  = $item.outerHeight(),
                stickTop    = itemOffset.top - windowHeight,
                timeline    = new TimelineMax({paused: true}),
                isArchive   = $item.hasClass('pile-item--archive');

            $item.data('height', itemHeight);

            if ( isArchive || latestKnownScrollY > stickTop ) {
                $item.addClass('is-visible');
            }

            $item.data('stickTop', stickTop);
        });

        $portfolio_container = $('.pile--portfolio-archive');

        if ( ! $portfolio_container.length || ! $portfolio_container.hasClass('infinite-scroll') ) {
            if (globalDebug) { console.groupEnd(); }
            return;
        }

        // if there are not sufficient projects to have scroll - load the next page also (prepending)
        if ( $portfolio_container.children('.pile-item--archive').last().offset().top < window.innerHeight ) {
            loadNextProjects();
        }

        if (globalDebug) { console.groupEnd(); }
    }

	function refresh() {
        if (globalDebug) { console.group("pile::refresh"); }

        $portfolio_container = $('.pile--portfolio-archive');

        $('.pile-item').each(function (i, item) {
            var $item       = $(item),
                itemOffset  = $item.offset(),
                stickTop    = itemOffset.top - windowHeight;

            $item.data('stickTop', stickTop);
        });

        update();

        if (globalDebug) { console.groupEnd(); }
	}

	function update() {
        maybeloadNextProjects();

        $('.pile-item--single').each(function (i, item) {

            var $item       = $(item),
                itemHeight  = $item.data('height'),
                stickTop    = $item.data('stickTop'),
                timeline    = $item.data('pile');

            if ('up' == scrollDirection && latestKnownScrollY <= stickTop + itemHeight / 2) {
                $item.removeClass('is-visible');
                return;
            }

            if ('down' == scrollDirection && latestKnownScrollY > stickTop) {
                $item.addClass('is-visible');
            }
		});
	}

    function loadNextProjects() {
        var $portfolio_container = $('.pile--portfolio-archive'),
            offset = $portfolio_container.find('.pile-item--archive').length;

        if (globalDebug) {console.log("Loading More Projects - AJAX Offset = " + offset);}

        isLoadingProjects = true;

        var args = {
            action : 'pile_load_next_projects',
            nonce : pile_ajax.nonce,
            offset : offset,
            pageid: $portfolio_container.data('pageid')
        };

        if ( !empty($portfolio_container.data('taxonomy')) ) {
            args['taxonomy'] = $portfolio_container.data('taxonomy');
            args['term_id'] = $portfolio_container.data('termid');
        }

        $.post(
            ajaxurl,
            args,
            function(response_data) {

                if( response_data.success ){
                    if (globalDebug) {console.log("Loaded next projects");}

                    var $result = $( response_data.data.posts).filter('.pile-item--archive');

                    if (globalDebug) {console.log("Adding new "+$result.length+" items to the DOM");}

                    $result.imagesLoaded(function() {
                        $portfolio_container.append( $result );
                        $window.trigger('infiniteLoad');
                        isLoadingProjects = false;
                    });
                } else {
                    // we have failed
                    // it's time to call it a day
                    if (globalDebug) {console.log("It seems that there are no more projects to load");}

                    $('.pagination--archive').fadeOut();

                    // don't make isLoadingProjects true so we won't load any more projects
                }
            }
        );
    }

    function maybeloadNextProjects() {
        var $portfolio_container = $('.pile--portfolio-archive');

        if ( ! $portfolio_container.length || ! $portfolio_container.hasClass('infinite-scroll') || isLoadingProjects ) {
            return;
        }

        var $lastChild = $portfolio_container.children('.pile-item--archive').last();

        // if the last child is in view then load more projects
        if ( $lastChild.is(':appeared') ) {
            loadNextProjects();
        }
    }

    return {
        initialize: initialize,
        update: update
    }

})();