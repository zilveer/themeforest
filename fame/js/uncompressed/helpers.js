var
    throttle = function (fn, delay){
        delay || (delay = 100);
        var interval = null, //for last call of function if there was event call after last execution and next delay point
            LastExecution = +new Date,
            FirstExecution = false, //for execution on first ever event occurrence
            LastTry = 0; //Last event occurrence with or without execution

        return function (){
            var now = +new Date,
                that = this, args = arguments, //save real arguments
                doThings = function(){
                    clearTimeout(interval); //event still going - no need for last call
                    fn.apply(that, args); //run our real event function
                    LastExecution = LastTry = now; //save new points to compare
                    FirstExecution = true;
                    interval = setTimeout(function(){ //set function if there will be event in delay time after last execution
                        if(LastTry !== LastExecution)//there was event after last execution
                            doThings();
                    }, delay);
                };

            if (!FirstExecution || now - LastExecution > delay){
                doThings();
            }
            else{
                LastTry = now;
            }
        };
    },

    debounce = function (func, threshold, execAsap) {
        var timeout;

        return function debounced () {
            var obj = this, args = arguments,
                delayed = function() {
                    if (!execAsap)
                        func.apply(obj, args);
                    timeout = null;
                };

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100);
        };

    };

//for old IE to get off
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop == 'float') prop = 'styleFloat';
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        };
        return this;
    }
}
if(!Array.indexOf){
    Array.prototype.indexOf = function(obj){
        for(var i=0; i<this.length; i++){
            if(this[i]==obj){
                return i;
            }
        }
        return -1;
    }
}


/* Easing for soft slide in thumbs */
jQuery.extend( jQuery.easing,
    {
        easeOutSine: function (x, t, b, c, d) {
            return c * Math.sin(t/d * (Math.PI/2)) + b;
        }
    });