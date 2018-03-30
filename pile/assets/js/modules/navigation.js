var Nav = (function() {

    var navIsOpen   = false;

    function init() {

        $('.js-nav-toggle').on('touchstart click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            if (!navIsOpen) {
                showMenu();
            } else {
                hideMenu();
            }
        });

        if( $html.is('.no-touchevents') ) {
            $('.site-header').on('mouseleave', function () {
                setTimeout(hideMenu, 300);
            });
        }

        $('.js-mobile-nav-close').on('click', hideMenu);

        // touch menus
        $('.sub-menu-toggle').on('touchstart', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var $this = $(this);

            $this.toggleClass('is-toggled');
            $this.closest('.menu-item').children('ul').fadeToggle();
        });

    }

    function hideMenu() {

        if (!navIsOpen) return;

        if (windowWidth < 900) {
            $html.removeClass('scroll-lock');
        }

        $html.removeClass('nav--is-visible');

        navIsOpen = false;
    }

    function showMenu() {

        if (navIsOpen) return;

        if (windowWidth < 900) {
            $html.addClass('scroll-lock');
        }

        $html.addClass('nav--is-visible');

        navIsOpen = true;
    }

    return {
        init: init,
        hideMenu: hideMenu
    }
})();