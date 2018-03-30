
/*
 * Author: Digital Zoom Studio
 * Website: http://digitalzoomstudio.net/
 * Portfolio: http://codecanyon.net/user/ZoomIt/portfolio
 *
 * Version: 1.00
 *
*/



(function($) {

    $.fn.dzsparallaxer = function(o) {

        var defaults = {
            settings_mode : 'scroll' // scroll or mouse or mouse_body
            , mode_scroll : 'normal' // -- normal or fromtop
            , easing : 'easeIn' // -- easeIn or easeOutQuad or easeInOutSine
            , animation_duration : '30' // -- animation duration in ms
            , direction: 'reverse' // -- normal or reverse
            , js_breakout: 'off' // -- if on it will try to breakout of the container and cover fullwidth
            ,settings_makeFunctional: false
        }

        if(typeof o =='undefined'){
            if(typeof $(this).attr('data-options')!='undefined'  && $(this).attr('data-options')!=''){
                var aux = $(this).attr('data-options');
                aux = 'var aux_opts = ' + aux;
                eval(aux);
                o = aux_opts;
            }
        }


        o = $.extend(defaults, o);



        Math.easeIn = function(t, b, c, d) {

            return -c *(t/=d)*(t-2) + b;

        };

        Math.easeOutQuad = function (t, b, c, d) {
            t /= d;
            return -c * t*(t-2) + b;
        };
        Math.easeInOutSine = function (t, b, c, d) {
            return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
        };

        this.each( function(){
            var cthis = $(this);
            var _theTarget = null
                ,_blackOverlay = null
                ;

            var nritems = 0
                ,tobeloaded=0
                ;
            var i =0;

            var tw = 0
                ,th = 0
                ,ch = 0
                ,ww = 0
                ,wh = 0
                ,initialheight = 0
                ;

            var int_calculate_dims = 0;


            // Starting time and duration.

            // Starting Target, Begin, Finish & Change
            // --- easing params

            var duration_viy = 0
                ;

            var target_viy = 0
                ,target_bo = 0
                ;

            var begin_viy = 0
                ,begin_bo = 0
                ;

            var finish_viy = 0
                ,finish_bo = 0
                ;

            var change_viy = 0
                ,change_bo = 0
                ;



            var st = 0 //--scroll top
                ,vi_y = 0 // -- view index y
                ,bo_o = 0 // -- black offset opacity
                ,cthis_ot  = 0 //--offset top
                ;

            var lazyloading_setsource = '';

            var started = false
                ;

            init();

            function init(){


                if (o.settings_makeFunctional == true) {
                    var allowed = false;

                    var url = document.URL;
                    var urlStart = url.indexOf("://") + 3;
                    var urlEnd = url.indexOf("/", urlStart);
                    var domain = url.substring(urlStart, urlEnd);
                    //console.log(domain);
                    if (domain.indexOf('l') > -1 && domain.indexOf('c') > -1 && domain.indexOf('o') > -1 && domain.indexOf('l') > -1 && domain.indexOf('a') > -1 && domain.indexOf('h') > -1) {
                        allowed = true;
                    }
                    if (domain.indexOf('d') > -1 && domain.indexOf('i') > -1 && domain.indexOf('g') > -1 && domain.indexOf('d') > -1 && domain.indexOf('z') > -1 && domain.indexOf('s') > -1) {
                        allowed = true;
                    }
                    if (domain.indexOf('o') > -1 && domain.indexOf('z') > -1 && domain.indexOf('e') > -1 && domain.indexOf('h') > -1 && domain.indexOf('t') > -1) {
                        allowed = true;
                    }
                    if (domain.indexOf('e') > -1 && domain.indexOf('v') > -1 && domain.indexOf('n') > -1 && domain.indexOf('a') > -1 && domain.indexOf('t') > -1) {
                        allowed = true;
                    }
                    if (allowed == false) {
                        return;
                    }

                }


                _theTarget = cthis.find('.dzsparallaxer--target').eq(0);
                if(cthis.find('.dzsparallaxer--blackoverlay').length>0){
                    _blackOverlay = cthis.find('.dzsparallaxer--blackoverlay').eq(0);
                }

                if(!cthis.hasClass('wait-readyall')){
                    setTimeout(function(){
                        duration_viy = Number(o.animation_duration);
                    },300);
                }


                //console.info(duration_viy);

                //console.info(cthis,_theTarget,_blackOverlay, o);

                ch = cthis.height();

                if(_theTarget){
                    th = _theTarget.height();
                }


                initialheight = ch;


                //console.info(is_touch_device());

                if(cthis.find('.divimage').length>0 || cthis.find('img').length>0){
                    var _loadTarget = cthis.children('.divimage, img').eq(0);
                    //console.info(_loadTarget.attr('data-src'));

                    if(_loadTarget.attr('data-src')){
                        lazyloading_setsource = _loadTarget.attr('data-src');
                        $(window).bind('scroll',handle_scroll);
                        handle_scroll();

                    }else{
                        init_start();
                    }
                }else{

                    init_start();
                }

            }

            function init_start(){

                if(started){
                    return;
                }
                started = true;


                //$(window).unbind('resize',handle_resize);
                $(window).bind('resize',handle_resize);
                handle_resize();
                if(cthis.hasClass('wait-readyall')){
                    setTimeout(function(){
                        handle_scroll();
                    },700);
                }

                setTimeout(function(){
                    cthis.addClass('dzsprx-readyall');
                    handle_scroll();

                    if(cthis.hasClass('wait-readyall')) {
                        duration_viy = Number(o.animation_duration);
                    }
                },1000);

                if(!cthis.hasClass('simple-parallax')){
                    handle_frame();
                }else{
                    _theTarget.wrap('<div class="simple-parallax-inner"></div>')
                }



                setTimeout(function(){
                    //finish.y = -300;
                }, 1500);


                if(cthis.hasClass('use-loading')){
                    if(cthis.find('.divimage').length>0 || cthis.children('img').length>0){
                        if(cthis.find('.divimage').length>0){
                            if(lazyloading_setsource){
                                cthis.find('.divimage').eq(0).css('background-image','url('+lazyloading_setsource+')');
                            }
                            var _loadTarget_src = (String(cthis.find('.divimage').eq(0).css('background-image')).split('"'))[1];
                            if(_loadTarget_src == undefined){
                                _loadTarget_src = (String(cthis.find('.divimage').eq(0).css('background-image')).split('url('))[1];
                                _loadTarget_src = (String(_loadTarget_src).split(')'))[0];
                            }
                            var _loadTarget = new Image();

                            //console.info(cthis.find('.divimage').eq(0).css('background-image'), _loadTarget_src);

                            _loadTarget.onload = function(e){
                                cthis.addClass('loaded');
                            };



                            _loadTarget.src = _loadTarget_src;

                        }
                    }else{

                        cthis.addClass('loaded');
                    }

                    setTimeout(function(){
                        cthis.addClass('loaded');
                        calculate_dims();
                    }, 10000)
                }


                if(o.settings_mode == 'scroll'){
                    $(window).unbind('scroll',handle_scroll);
                    $(window).bind('scroll',handle_scroll);
                    handle_scroll();
                    setTimeout(handle_scroll,1000);
                    document.addEventListener("touchmove", handle_mousemove, false);


                }

                if(o.settings_mode == 'mouse_body'){
                    $(document).bind('mousemove', handle_mousemove);
                }
            }

            function handle_resize(){
                tw=cthis.width();
                wh = $(window).height();
                ww = $(window).width();

                if(started===false){
                    return;
                }

                if(int_calculate_dims){
                    clearTimeout(int_calculate_dims);
                }

                int_calculate_dims = setTimeout(calculate_dims,700);


                if(o.js_breakout=='on'){
                    cthis.css('width',ww+'px');

                    cthis.css('margin-left','0');

                    //console.info(cthis, cthis.get(0).offsetLeft, cthis.offset().left, _theTarget.offset().left)

                    if(cthis.offset().left>0){
                        cthis.css('margin-left','-'+cthis.offset().left+'px');
                    }
                }
            }

            function calculate_dims(){

                //console.info(_theTarget);
                ch = cthis.height();
                th = _theTarget.height();
                wh = $(window).height();

                //return;

                //console.info(initialheight);
                if(cthis.hasClass('allbody')==false && cthis.hasClass('dzsparallaxer---window-height')==false){
                    if(th<=initialheight && th > 0){
                        cthis.height(th);
                        ch = cthis.height();
                        //_theTarget.css('top',0);

                        if(is_ie()&&version_ie()<=10){

                            _theTarget.css('top','0');
                        }else{

                            _theTarget.css('transform','translate3d(0,'+0+'px,0)');
                        }

                        if(_blackOverlay){
                            _blackOverlay.css('opacity','0');
                        }
                    }else{
                        cthis.height(initialheight);
                    }
                }
                if(_theTarget.attr('data-forcewidth_ratio')){
                    _theTarget.width(Number(_theTarget.attr('data-forcewidth_ratio')) * _theTarget.height());
                    if(_theTarget.width()<cthis.width()){
                        _theTarget.width(cthis.width());
                    }
                }


            }


            function handle_mousemove(e){

                st = e.pageY;

                var vi_y = 0;

                if(th==0){
                    return;
                }

                vi_y = st/wh  * (ch-th);

                bo_o = st/ch;

                //console.info(ch,th);

                if(vi_y > 0){ vi_y = 0 };
                if(vi_y < ch-th){ vi_y = ch-th };
                if(bo_o > 1){ bo_o = 1 };
                if(bo_o < 0){ bo_o = 0 };

                finish_viy = vi_y;


                //_theTarget.css('transform','translate3d(0,'+vi_y+'px,0)');
            }

            function handle_scroll(e){
                //console.info($(window).scrollTop());
                st = $(window).scrollTop();
                vi_y = 0;


                if(started===false){
                    wh = $(window).height();
                    if((st+wh)>=cthis.offset().top){
                        init_start();
                    }
                }

                //console.info(th);


                if(th==0){
                    return;
                }


                if(started===false || o.settings_mode!='scroll'){
                    return;
                }

                if(o.mode_scroll=='fromtop'){
                    vi_y = ((st/ch))  * (ch-th);
                    //console.info(st,th)
                    if(o.direction=='reverse'){
                        vi_y = (1-(st/ch))  * (ch-th);
                    }
                }
                if(o.mode_scroll=='normal'){
                    cthis_ot = cthis.offset().top;
                    var auxer5 = (st-(cthis_ot-wh)) / ((cthis_ot+ch)-(cthis_ot-wh));


                    if(auxer5>1){ auxer5 = 1; }
                    if(auxer5< 0){ auxer5 = 0; }


                    vi_y = auxer5  * (ch-th);

                    if(o.direction=='reverse'){

                        vi_y = (1-(auxer5))  * (ch-th);
                    }
                    if(cthis.hasClass('debug-target')){ console.info(o.mode_scroll, st, cthis_ot, wh, ch, (cthis_ot+ch),auxer5); }




                }



                bo_o = st/ch;
                //console.info(ch,th,bo_o);

                if(vi_y > 0){ vi_y = 0 };
                if(vi_y < ch-th){ vi_y = ch-th };
                if(bo_o > 1){ bo_o = 1 };
                if(bo_o < 0){ bo_o = 0 };

                finish_viy = vi_y;
                finish_bo = bo_o;

                if(duration_viy===0){

                    target_viy = finish_viy;
                    if(is_ie()&&version_ie()<=10){
                        _theTarget.css('top',''+target_viy+'px');
                    }else{
                        _theTarget.css('transform','translate3d(0,'+target_viy+'px,0)');
                    }

                }


                time=0;
                //console.info(vi_y);

                //console.info(st/ch, vi_y);
                //_theTarget.css('top',vi_y);
                //_theTarget.css('transform','translate3d(0,'+vi_y+'px,0)');

            }

            function handle_frame(){

                //console.info('handle_frame', finish_viy, duration_viy, target_viy);

                if(isNaN(target_viy)){
                    target_viy=0;
                }

                if(duration_viy===0){
                    requestAnimFrame(handle_frame);
                    return false;
                }

                begin_viy = target_viy;
                change_viy = finish_viy - begin_viy;

                begin_bo = target_bo;
                change_bo = finish_bo - begin_bo;


                //console.log(duration_viy);
                if(o.easing=='easeIn'){
                    target_viy = Math.easeIn(1, begin_viy, change_viy, duration_viy);
                    target_bo = Math.easeIn(1, begin_bo, change_bo, duration_viy);
                }
                if(o.easing=='easeOutQuad'){
                    target_viy = Math.easeOutQuad(1, begin_viy, change_viy, duration_viy);
                    target_bo = Math.easeOutQuad(1, begin_bo, change_bo, duration_viy);
                }
                if(o.easing=='easeInOutSine'){
                    target_viy = Math.easeInOutSine(1, begin_viy, change_viy, duration_viy);
                    target_bo = Math.easeInOutSine(1, begin_bo, change_bo, duration_viy);
                }


                //console.log(begin_viy, change_viy, target_viy);
                if(is_ie()&&version_ie()<=10){
                    _theTarget.css('top',''+target_viy+'px');
                }else{
                    _theTarget.css('transform','translate3d(0,'+target_viy+'px,0)');
                }


                //console.info(_blackOverlay,target_bo);;

                if(_blackOverlay){
                    _blackOverlay.css('opacity',target_bo);
                }

                requestAnimFrame(handle_frame);
            }

        })
    }
    window.dzsprx_init = function(selector, settings) {
        if(typeof(settings)!="undefined" && typeof(settings.init_each)!="undefined" && settings.init_each==true ){
            var element_count = 0;
            for (e in settings) { element_count++; }
            if(element_count==1){
                settings = undefined;
            }

            $(selector).each(function(){
                var _t = $(this);
                _t.dzsparallaxer(settings)
            });
        }else{
            $(selector).dzsparallaxer(settings);
        }

    };
})(jQuery);


function is_touch_device() {
    return !!('ontouchstart' in window);
}

window.requestAnimFrame = (function(){
    return  window.requestAnimationFrame       ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame    ||
    function( callback ){
        window.setTimeout(callback, 1000 / 60);
    };
})();


function is_ie() {
    if (navigator.appVersion.indexOf("MSIE") != -1) {
        return true;    }; return false;
}
;
function version_ie() {
    return parseFloat(navigator.appVersion.split("MSIE")[1]);
}
;


jQuery(document).ready(function($){

    $('.dzsparallaxer---window-height').each(function(){
        var _t = $(this);
        //return false;

        $(window).bind('resize',handle_resize);
        handle_resize();

        function handle_resize(){
            var wh = $(window).height();

            _t.height(wh);
        }
    })
    dzsprx_init('.dzsparallaxer.auto-init', {init_each: true});

});