// Execute immediately, no DOM ready
// loading in header
(function($) {

    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = (this.value || '');
            }
        });
        return o;
    };

    $.fn.center = function () {
        this.css('position','absolute');
        this.css('top', (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + 'px');
        this.css('left', (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + 'px');
        return this;
    }

})(jQuery);

//function that shows that a field is mandatory

(function($) {
    $.fn.reddit=function() {
        if(this.is(':visible')) {
            curr=this;
        }
        else {
            curr=this.parent();
        }
        current_bg_color=curr.css('background-color');
        curr.css('background-color','red').animate({
            'background-color':current_bg_color
        },1000);
        return false;
    }
})(jQuery);

(function($) {
    $.fn.selectRange = function(start, end) {
        return this.each(function() {
            if(this.setSelectionRange) {
                this.focus();
                this.setSelectionRange(start, end);
            } else if(this.createTextRange) {
                var range = this.createTextRange();
                range.collapse(true);
                range.moveEnd('character', end);
                range.moveStart('character', start);
                range.select();
            }
        });
    }
})(jQuery);

function stripos (f_haystack, f_needle, f_offset) {
    var haystack = (f_haystack + '').toLowerCase();
    var needle = (f_needle + '').toLowerCase();
    var index = 0;

    if ((index = haystack.indexOf(needle, f_offset)) !== -1) {
        return index;
    }
    return false;
}

function uniqid() {
    if(typeof uniqid.id =='undefined')
        uniqid.id=0;
    else
        uniqid.id++;
    return uniqid.id;
}

/**
 * Removes [] from the end of the vars names
 */
function tf_clean_post_names(post_object, recursion) {
    if (recursion === undefined) recursion = false;
    if ( (typeof post_object) != 'object') return post_object;

    var result = (recursion ? [] : {});
    for (var id in post_object) {
        result[ jQuery.trim(id).replace(/\[\]$/, '') ] = ( (typeof post_object[id])=='object' ? tf_clean_post_names(post_object[id], true) : post_object[id] );
    }
    return result;
}

/**
 * Make form ajax submit
 */
function tf_form_bind_ajax_submit(form, data)
{
    var $       = jQuery;
    var Data    = data; // nu vede 'data' inauntru la submit()

    return $(form).submit(function(){
        showLoading();

        /**
         * Required data options:
         *
         * action:      'tf...'
         * tf_action:   '...'
         */
        var data = $.extend({
            options:     JSON.stringify( tf_clean_post_names($(this).serializeObject()) ),
            _ajax_nonce: tf_script.ajax_admin_save_options_nonce
        }, Data);

        $.ajax({
            type:       'POST',
            url:        tf_script.ajaxurl,
            data:       data,
            dataType:   "json",
            success: function(response){
                showFinishedLoading();

                if(response != null && response.reload_page == true) {
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                showFailLoading();
            }
        });

        return false;
    });
}

/**
 * Google maps input
 */
function tf_init_google_maps_input (_this)
{
    var $       = jQuery;
    var El      = ( _this !== undefined ? $(_this) : $(this) );
    var iD      = El.attr('id');
    var inputX  = $('input#' + iD + '_x');
    var inputY  = $('input#' + iD + '_y');
    var mapDiv  = $('#' + iD + '_map');

    new (function(){

        this.marker = null;
        this.map    = null;
        this.LatLng = null;
        this.isMoving = false; // if now user is moving the map (mouseDown+Drag?)

        this.__construct = function()
        {
            if (!google.maps.LatLng) {
                console.log ('[Error] Cannot initialize google maps');
                return false;
            }

            var x = inputX.val();
            x = (This.isFloat(x) ? parseFloat(x) : null );
            var y = inputY.val();
            y = (This.isFloat(y) ? parseFloat(y) : null );

            if(x !== null && y !== null){
                var mapCenter   = new google.maps.LatLng(x, y);
                var mapZoom     = 7;
                This.LatLng     = mapCenter;
            } else {
                var mapCenter   = new google.maps.LatLng(0, 0);
                var mapZoom     = 2;
                This.LatLng     = null;
            }

            This.map = new google.maps.Map(
                document.getElementById( mapDiv.attr('id') ),
                {
                    zoom:               mapZoom,
                    center:             mapCenter,
                    mapTypeId:          google.maps.MapTypeId.ROADMAP,
                    streetViewControl:  false
                }
            );

            This.setMarker(x, y);

            google.maps.event.addListener(This.map, 'click', function(event) {
                This.setMarker(event.latLng);
            });

            google.maps.event.addListener(This.map, 'mousedown', function(event) {
                This.isMoving = true;
            });
            google.maps.event.addListener(This.map, 'mouseup', function(event) {
                setTimeout(function(){
                    This.isMoving = false;
                }, 30);
            });
            google.maps.event.addListener(This.map, 'mouseout', function(event) {
                This.isMoving = false;
            });

            (function(){
                var changeFunction = function(){
                    var x = inputX.val();
                    x = (This.isFloat(x) ? parseFloat(x) : null );
                    var y = inputY.val();
                    y = (This.isFloat(y) ? parseFloat(y) : null );

                    if(x !== null && y !== null){
                        var tmp = new google.maps.LatLng(x, y);

                        El.val(tmp.lat() + ':' + tmp.lng());

                        This.setMarker(x, y, true);
                    } else {
                        El.val('');

                        if(This.marker !== null){
                            This.marker.setMap(null);
                        }
                    }
                };
                inputX.bind('blur change keyup', changeFunction);
                inputY.bind('blur change keyup', changeFunction);
            })();
        };

        this.setMarker = function(x ,y, iAmFromChange){
            var newPoint = null;

            if(typeof(x) == 'object'){
                newPoint = x; // assume google maps LatLng point
            } else {
                x = (This.isFloat(x) ? parseFloat(x) : null );
                y = (This.isFloat(y) ? parseFloat(y) : null );

                if(x !== null && y !== null){
                    newPoint = new google.maps.LatLng(x, y);
                }
            }

            if(newPoint !== null){
                if(This.marker === null){
                    This.marker = new google.maps.Marker({
                        position:   newPoint,
                        map:        This.map,
                        draggable:  true,
                        animation:  google.maps.Animation.DROP
                    });
                    google.maps.event.addListener(This.marker, 'dragend', function(event) {
                        This.setMarker(event.latLng);
                    });
                } else {
                    This.marker.setMap(This.map);
                    This.marker.setPosition(newPoint);
                }

                inputX.val( newPoint.lat() );
                inputY.val( newPoint.lng() );
                if(iAmFromChange !== undefined){
                    // This.map.setCenter(newPoint);
                } else {
                    inputX.trigger('change');
                }

                return true; // Return success
            } else {
                if(This.marker !== null){
                    This.marker.setMap(null);
                }
                return false; // Fail
            }
        };

        this.isFloat = function(value){
            if( $.trim(value) == '') return false;

            value = parseFloat(value);

            if(String(value) == 'NaN'){
                return false;
            }

            return true;
        };

        if(typeof(google) == 'undefined'){
            mapDiv.html('Error: goolge API cannot be loaded');
            return;
        }

        // __construct
        var This    = this;
        if(mapDiv.is(":visible")){
            This.__construct();
        }

        (function(){ // Fix map shift in hidden elements
            var resizeFunction  = function(){
                if (This.isMoving) return;

                google.maps.event.trigger(This.map, 'resize');

                if(This.marker !== null){
                    This.map.setCenter( This.marker.getPosition() );
                }
            };

            var mapDivState     = mapDiv.is(":visible");
            var click_function  = function(){
                if(This.map === null && mapDiv.is(":visible")){
                    This.__construct();
                }

                var newState = mapDiv.is(":visible");
                if(mapDivState != newState){
                    mapDivState = newState;
                    if(newState){
                        resizeFunction();
                    }
                }
            };

            $(document.body)
                .click(click_function)
                .on('change', 'select', click_function);

            var interval = setInterval(function(){ // wait until tabs are loaded (links in tabs have events with preventDefault()..)
                var tabs = $('.ui-tabs-nav', mapDiv.closest('.tf_meta_tabs'));
                mapDivState = false;
                if( tabs.length ){
                    $('a', tabs).click(click_function);
                    click_function();
                    clearInterval(interval);
                }
            }, 1000);
        })();
    })();
};

/**
 * IE8 fix
 */
Object.keys = Object.keys || function(o) {
    var result = [];
    for(var name in o) {
        if (o.hasOwnProperty(name))
            result.push(name);
    }
    return result;
};

/**
 * Useful functions
 */
var TUtils = {
    /**
     * Like intval in php. Returns 0 on failure, not NaN
     */
    intval: function(value)
    {
        value = parseInt(value);

        return !isNaN(value) ? value : 0;
    },
    /**
     * Try to convert to int or string
     */
    int_or_string_val: function(value)
    {
        if (value === undefined || value === null) {
            return 0;
        }

        var int_value;
        if ( !isNaN(int_value = parseInt(value)) ) {
            return int_value;
        }

        return String(value);
    },
    /**
     * Generates unique id
     */
    id_uniq: function()
    {
        return 'iD'+this.md5uniq();
    },
    /**
     * Generates random md5
     */
    md5uniq: function()
    {
        return this.MD5( this.random_string() + this.random_string() + this.random_string() + (new Date()).getTime() );
    },
    random_string: function()
    {
        return Math.floor((1 + Math.random()) * 0x100000000).toString(16).substring(1);
    },
    object_length: function(hash)
    {
        var length = 0;
        for (var key in hash) {
            if (hash.hasOwnProperty(key)) length++;
        }
        return length;
    },
    /**
     * Class to generate md5
     */
    MD5: function(string)
    {

        function RotateLeft(lValue, iShiftBits) {
            return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
        }

        function AddUnsigned(lX,lY) {
            var lX4,lY4,lX8,lY8,lResult;
            lX8 = (lX & 0x80000000);
            lY8 = (lY & 0x80000000);
            lX4 = (lX & 0x40000000);
            lY4 = (lY & 0x40000000);
            lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
            if (lX4 & lY4) {
                return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
            }
            if (lX4 | lY4) {
                if (lResult & 0x40000000) {
                    return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
                } else {
                    return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
                }
            } else {
                return (lResult ^ lX8 ^ lY8);
            }
        }

        function F(x,y,z) { return (x & y) | ((~x) & z); }
        function G(x,y,z) { return (x & z) | (y & (~z)); }
        function H(x,y,z) { return (x ^ y ^ z); }
        function I(x,y,z) { return (y ^ (x | (~z))); }

        function FF(a,b,c,d,x,s,ac) {
            a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
            return AddUnsigned(RotateLeft(a, s), b);
        };

        function GG(a,b,c,d,x,s,ac) {
            a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
            return AddUnsigned(RotateLeft(a, s), b);
        };

        function HH(a,b,c,d,x,s,ac) {
            a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
            return AddUnsigned(RotateLeft(a, s), b);
        };

        function II(a,b,c,d,x,s,ac) {
            a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
            return AddUnsigned(RotateLeft(a, s), b);
        };

        function ConvertToWordArray(string) {
            var lWordCount;
            var lMessageLength = string.length;
            var lNumberOfWords_temp1=lMessageLength + 8;
            var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;
            var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
            var lWordArray=Array(lNumberOfWords-1);
            var lBytePosition = 0;
            var lByteCount = 0;
            while ( lByteCount < lMessageLength ) {
                lWordCount = (lByteCount-(lByteCount % 4))/4;
                lBytePosition = (lByteCount % 4)*8;
                lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount)<<lBytePosition));
                lByteCount++;
            }
            lWordCount = (lByteCount-(lByteCount % 4))/4;
            lBytePosition = (lByteCount % 4)*8;
            lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);
            lWordArray[lNumberOfWords-2] = lMessageLength<<3;
            lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
            return lWordArray;
        };

        function WordToHex(lValue) {
            var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
            for (lCount = 0;lCount<=3;lCount++) {
                lByte = (lValue>>>(lCount*8)) & 255;
                WordToHexValue_temp = "0" + lByte.toString(16);
                WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
            }
            return WordToHexValue;
        };

        function Utf8Encode(string) {
            string = string.replace(/\r\n/g,"\n");
            var utftext = "";

            for (var n = 0; n < string.length; n++) {

                var c = string.charCodeAt(n);

                if (c < 128) {
                    utftext += String.fromCharCode(c);
                }
                else if((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
                else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }

            }

            return utftext;
        };

        var x=Array();
        var k,AA,BB,CC,DD,a,b,c,d;
        var S11=7, S12=12, S13=17, S14=22;
        var S21=5, S22=9 , S23=14, S24=20;
        var S31=4, S32=11, S33=16, S34=23;
        var S41=6, S42=10, S43=15, S44=21;

        string = Utf8Encode(string);

        x = ConvertToWordArray(string);

        a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;

        for (k=0;k<x.length;k+=16) {
            AA=a; BB=b; CC=c; DD=d;
            a=FF(a,b,c,d,x[k+0], S11,0xD76AA478);
            d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756);
            c=FF(c,d,a,b,x[k+2], S13,0x242070DB);
            b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
            a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);
            d=FF(d,a,b,c,x[k+5], S12,0x4787C62A);
            c=FF(c,d,a,b,x[k+6], S13,0xA8304613);
            b=FF(b,c,d,a,x[k+7], S14,0xFD469501);
            a=FF(a,b,c,d,x[k+8], S11,0x698098D8);
            d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);
            c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);
            b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);
            a=FF(a,b,c,d,x[k+12],S11,0x6B901122);
            d=FF(d,a,b,c,x[k+13],S12,0xFD987193);
            c=FF(c,d,a,b,x[k+14],S13,0xA679438E);
            b=FF(b,c,d,a,x[k+15],S14,0x49B40821);
            a=GG(a,b,c,d,x[k+1], S21,0xF61E2562);
            d=GG(d,a,b,c,x[k+6], S22,0xC040B340);
            c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);
            b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
            a=GG(a,b,c,d,x[k+5], S21,0xD62F105D);
            d=GG(d,a,b,c,x[k+10],S22,0x2441453);
            c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);
            b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
            a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);
            d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);
            c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87);
            b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);
            a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905);
            d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);
            c=GG(c,d,a,b,x[k+7], S23,0x676F02D9);
            b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
            a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942);
            d=HH(d,a,b,c,x[k+8], S32,0x8771F681);
            c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);
            b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
            a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);
            d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);
            c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);
            b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
            a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6);
            d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA);
            c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085);
            b=HH(b,c,d,a,x[k+6], S34,0x4881D05);
            a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039);
            d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);
            c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);
            b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
            a=II(a,b,c,d,x[k+0], S41,0xF4292244);
            d=II(d,a,b,c,x[k+7], S42,0x432AFF97);
            c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);
            b=II(b,c,d,a,x[k+5], S44,0xFC93A039);
            a=II(a,b,c,d,x[k+12],S41,0x655B59C3);
            d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92);
            c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);
            b=II(b,c,d,a,x[k+1], S44,0x85845DD1);
            a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F);
            d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);
            c=II(c,d,a,b,x[k+6], S43,0xA3014314);
            b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);
            a=II(a,b,c,d,x[k+4], S41,0xF7537E82);
            d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);
            c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);
            b=II(b,c,d,a,x[k+9], S44,0xEB86D391);
            a=AddUnsigned(a,AA);
            b=AddUnsigned(b,BB);
            c=AddUnsigned(c,CC);
            d=AddUnsigned(d,DD);
        }

        var temp = WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);

        return temp.toLowerCase();
    }
};
