(function(){

    var $hero = $('.hero-content'),
        $document = $(document),
        keysBound = false;

    function positionHeroContent(e) {
        switch(e.which) {
            case 37: // left
                if ( $hero.hasClass('right') ) {
                    $hero.removeClass('right');
                } else {
                    $hero.addClass('left');
                }
            break;

            case 38: // up
                if ( $hero.hasClass('bottom') ) {
                    $hero.removeClass('bottom');
                } else {
                    $hero.addClass('top');
                }
            break;

            case 39: // right
                if ( $hero.hasClass('left') ) {
                    $hero.removeClass('left');
                } else {
                    $hero.addClass('right');
                }
            break;

            case 40: // down
                if ( $hero.hasClass('top') ) {
                    $hero.removeClass('top');
                } else {
                    $hero.addClass('bottom');
                }
            break;

            default: return; // exit this handler for other keys
        }
        e.preventDefault(); // prevent the default action (scroll / move caret)
    }

    function bindArrowKeys(e) {
        if (keysBound) return;
        switch(e.which) {
            case 37:
            case 39:
                positionHeroContent(e);
                $document.off('keydown', bindArrowKeys);
                keysBound = true;
                $document.on('keydown', positionHeroContent);
            break;
            default: return;
        }
    }

    $document.on('keydown', bindArrowKeys);

})();
