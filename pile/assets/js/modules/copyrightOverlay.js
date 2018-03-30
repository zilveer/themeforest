function copyrightOverlayAnimation(direction, x, y){
    switch (direction){
        case 'in':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Copyright Overlay - IN"+timestamp);}

            TweenMax.fromTo($('.copyright-overlay'), 0.1, {opacity: 0, scale: 0.7}, {opacity: 1, scale: 1,
                onStart: function(){
                    $('.copyright-overlay').css({top: y, left: x});
                    $('body').addClass('is--active-copyright-overlay');
                }
            });

            break;
        }

        case 'out':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Copyright Overlay - OUT"+timestamp);}

            TweenMax.fromTo($('.copyright-overlay'), 0.1, {opacity: 1, scale: 1}, {opacity: 0, scale: 0.7,
                onComplete: function(){
                    $('body').removeClass('is--active-copyright-overlay');
                }
            });

            break;
        }

        default: break;
    }
}

function copyrightOverlayInit(){
    $(document).on('contextmenu', '.entry__featured-image, .hero, .entry-content img, .pile-item img, .mfp-img', function(event){
        if( !empty($('.copyright-overlay'))){
            event.preventDefault();
            event.stopPropagation();

            copyrightOverlayAnimation('in', event.clientX, event.clientY);
        }
    });

    $(document).on('mousedown', function(){
        if($('body').hasClass('is--active-copyright-overlay'))
            copyrightOverlayAnimation('out');
    });
}