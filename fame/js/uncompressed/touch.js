function addTouchEvent(element, callbacks){
    var startX,
        startY,
        dx,
        startT,
        scrolling = false,
        wasScrolling = false,

        onTouchStart = function(e){
//            console.log('touch start')
            if (e.touches.length === 1) {
                startT = Number(new Date());
                startX = e.touches[0].pageX;
                startY = e.touches[0].pageY;

                element.addEventListener('touchmove', onTouchMove, false);
                element.addEventListener('touchend', onTouchEnd, false);
            }
        },

        onTouchMove = function(e){
            dx = startX - e.touches[0].pageX;
            scrolling = (Math.abs(dx) < Math.abs(e.touches[0].pageY - startY));

            if(scrolling) wasScrolling = true;

            //if user is not scrolling page
            if (!wasScrolling) {
                e.preventDefault();
            }
        },

        onTouchEnd = function(e){
//            console.log('touch end')
            // finish the touch by undoing the touch session
            element.removeEventListener('touchmove', onTouchMove, false);
//            console.log('wasScrolling', wasScrolling);
            if(!wasScrolling && !(dx === null)){
                //swipe left
                if(dx > 0){
                    callbacks.left(e);
                }
                //swipe right
                else{
                    callbacks.right(e);
                }
            }

            //clean after work
            element.removeEventListener('touchend', onTouchEnd, false);
            startX = null;
            startY = null;
            dx = null;
            wasScrolling = false;
        };

    element.addEventListener('touchstart', onTouchStart, false);
}