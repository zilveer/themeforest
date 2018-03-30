(function($) {
    'use strict';

    var reseting = false,
        pending = false;

    window.progressCircle = function() {
        var $progressCircle = $( '.progress-circle' ),
            $successIcon = $progressCircle.find( '.success-icon' ),
            $errorIcon = $progressCircle.find( '.error-icon' ),
            $msg =  $progressCircle.find( '.progress-msg' ),
            progressLine = $progressCircle.find( '.outer' )[0],
            progressLine2 = $progressCircle.find( '.outer' )[1],
            animTime = 0.7,
            lineLength = 200,
            step =  lineLength / (animTime * 60),
            dashNewOffset = null,
            i = 0;

        var animTo = 0.75;
        var animate = function() {
            if( i === 0 ) {
                pending = true;
                $progressCircle.addClass( 'is-active' );
            } 

            i += 1;

            if( i >= (animTime * 60) * animTo ) { 
                reset();
                reseting = true;
                return; 
            }

            dashNewOffset = lineLength - (step * i);
            progressLine.style.strokeDashoffset = dashNewOffset;
            if( progressLine2 ) progressLine2.style.strokeDashoffset = dashNewOffset;
            
            window.requestAnimationFrame( animate );
        }; 

        var finish = function() {
            animTo = 1;
            animate();
        };

        var status = function( accomplished ) {
            var statusClass = accomplished ? 'is-success' : 'is-error',
                msg = accomplished ? 'Saved Successfully!' : 'You have already saved settings.';

            $msg.html( msg );
            $progressCircle.addClass( statusClass );
        };

        var reset = function() {
            if( reseting ) { return; }
            setTimeout( function() { 
                reseting = false;
                pending = false;
                animTo = 0.75;
                i = 0;
                progressLine.style.strokeDashoffset = lineLength;
                if( progressLine2 ) progressLine2.style.strokeDashoffset = lineLength;
                $progressCircle.removeClass( 'is-active is-error is-success' );
                $msg.html('');
            }, 2000);
        };

        return {
            play: function() {
                if( pending ) { return; }
                animate();
            },
            finish: finish,
            status : status
        };
    };


})(jQuery);