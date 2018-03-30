jQuery(document).ready(function(){

    jQuery(".r_background_displays").change(function(){if(jQuery(this).val()=="bg_pattren"){jQuery("#custom_pattrens_color, #custom_pattrens").fadeIn();jQuery("#custom_background, #item-custom_background_full").hide()}else{jQuery("#custom_background, #item-custom_background_full").fadeIn();jQuery("#custom_pattrens_color, #custom_pattrens").hide()}});
    jQuery(".postbox input:checked").parent().addClass("selected");jQuery(".postbox .checkbox-select").click(function(e){e.preventDefault(e);jQuery(".postbox li").removeClass("selected");jQuery(this).parent().addClass("selected");jQuery(this).parent().find(":radio").attr("checked","checked")});

    /**
     * advanced_export
     */

    jQuery(".select_plugin li input").css('display','none');
    jQuery(".select_plugin li").click(function()
    {
        jQuery(this).parent('ol').find('li').removeClass('selectd');
        jQuery(this).addClass('selectd');
        jQuery(this).find('input').attr('checked','checked');
    });
    jQuery(".select_plugin li a").click(function(event)
    {
        event.preventDefault(event);
    });

    /**
     * add_news
     */
    jQuery("#add_news").click(function(event)
    {
        event.preventDefault(event);
        var template = jQuery('#bd_news_box'),data = {data: total_boxes};
        var compile = template.tmpl(data).html();
        jQuery('.bdayh_list_boxes').append(compile);
        jQuery('#home_box_'+total_boxes+' .bd_item_content').css('display','block');
        jQuery('#bd_cats option').clone().appendTo('#bd_setting_home_'+ total_boxes +'_cat');
        total_boxes++;
    });

    /**
     * add_scrolling_box
     */
    jQuery("#add_scrolling_box").click(function(event)
    {
        event.preventDefault(event);
        var template = jQuery('#bd_scrolling_box'),data = {data: total_boxes};
        var compile = template.tmpl(data).html();
        jQuery('.bdayh_list_boxes').append(compile);
        jQuery('#home_box_'+total_boxes+' .bd_item_content').css('display','block');
        jQuery('#bd_cats option').clone().appendTo('#bd_setting_home_'+ total_boxes +'_cat');
        total_boxes++;
    });

    /**
     * add_recent_box
     */
    jQuery("#add_recent_box").click(function(event)
    {
        event.preventDefault(event);
        var template = jQuery('#bd_recent_box'),data = {data: total_boxes};
        var compile = template.tmpl(data).html();
        jQuery('.bdayh_list_boxes').append(compile);
        jQuery('#home_box_'+total_boxes+' .bd_item_content').css('display','block');
        jQuery('#bd_cats option').clone().appendTo('#bd_setting_home_'+ total_boxes +'_cat');
        total_boxes++;
    });

    /**
     * add_videos
     */
    jQuery("#add_videos").click(function(event)
    {
        event.preventDefault(event);
        var template = jQuery('#bd_add_videos'),data = {data: total_boxes};
        var compile = template.tmpl(data).html();
        jQuery('.bdayh_list_boxes').append(compile);
        jQuery('#home_box_'+total_boxes+' .bd_item_content').css('display','block');
        jQuery('#bd_cats option').clone().appendTo('#bd_setting_home_'+ total_boxes +'_cat');
        total_boxes++;
    });

    /**
     * add_videos
     */
    jQuery("#add_gallery").click(function(event)
    {
        event.preventDefault(event);
        var template = jQuery('#bd_add_gallery'),data = {data: total_boxes};
        var compile = template.tmpl(data).html();
        jQuery('.bdayh_list_boxes').append(compile);
        jQuery('#home_box_'+total_boxes+' .bd_item_content').css('display','block');
        jQuery('#bd_cats option').clone().appendTo('#bd_setting_home_'+ total_boxes +'_cat');
        total_boxes++;
    });

    /**
     * add_ads_box
     */
    jQuery("#add_ads_box").click(function(event) {
        event.preventDefault(event);
        var template = jQuery('#bd_ads_box'),data = {data: total_boxes};
        var compile = template.tmpl(data).html();
        jQuery('.bdayh_list_boxes').append(compile);
        jQuery('#home_box_'+total_boxes+' .bd_item_content').css('display','block');
        total_boxes++;
    });

    /**
     * del
     */
    jQuery(".del").live("click", function()
    {
        var box_id = jQuery(this).attr('id').replace('remove_','');
        jQuery('#home_box_'+box_id).fadeOut('slow').remove();
    });

    /**
     * boxes_title
     */
    jQuery(".boxes_title").live("click", function()
    {
        jQuery(this).parent().find('.bd_item_content').fadeToggle('fast');
    });

    /**
     * bdayh_list_boxes
     */
    jQuery( "#bdayh_list_boxes" ).sortable
    (
        {
            placeholder: "ui-state-highlight"
        }
    );

    /**
     * ad_type
     */
    jQuery(".ad_type").live("change", function()
    {
        if(jQuery(this).val() == 'code')
        {
            jQuery(this).parents('.bd_item_content').find('.ads_img').hide();
            jQuery(this).parents('.bd_item_content').find('.ads_code').show();
        }
        else
        {
            jQuery(this).parents('.bd_item_content').find('.ads_code').hide();
            jQuery(this).parents('.bd_item_content').find('.ads_img').show();
        }
    });

    /**
     * home_type
     */
    jQuery(".home_type").change(function ()
    {
        if(jQuery(this).val() == "blog")
        {
            jQuery("#box_type_content").hide();
        }
        else
        {
            jQuery("#box_type_content").show();
        }
    });

    /**
     * box_layout
     */
    jQuery(".bd_box_layout li").live("click", function()
    {
        jQuery(this).parent('ul').find('li').removeClass('selectd');
        jQuery(this).addClass('selectd');
        jQuery(this).parent('ul').find('input').removeAttr('checked');
        jQuery(this).find('input').attr('checked','checked');
        return false;
    });

    jQuery(".bd_box_layout li a").live("click", function(event)
    {
        event.preventDefault(event);
    });

    /**
     * tabs
     */
    jQuery(".box_tabs_container").hide();
    jQuery("#bd-panel-tabs li:first").addClass("active").show();
    jQuery(".box_tabs_container:first").show();
    jQuery("#bd-panel-tabs li").click(function() {
        jQuery("#bd-panel-tabs li").removeClass("active");
        jQuery(this).addClass("active");
        jQuery(".box_tabs_container").hide();
        var activeTab = jQuery(this).find("a").attr("href");
        jQuery(activeTab).fadeIn('fast');
        return false;
    });

    /**
     * tooltips
     */
    jQuery('.ttip, .bd_option_item a , .titlebuilder a, .navbuilder a, .box_layout_list li a').tipsy({fade: true, gravity: 's'});
    jQuery('.tooldown, .tooltip-s').tipsy({fade: true, gravity: 'n'});
    jQuery('.tooltip-nw').tipsy({fade: true, gravity: 'nw'});
    jQuery('.tooltip-ne').tipsy({fade: true, gravity: 'ne'});
    jQuery('.tooltip-w').tipsy({fade: true, gravity: 'w'});
    jQuery('.tooltip-e').tipsy({fade: true, gravity: 'e'});
    jQuery('.tooltip-sw').tipsy({fade: true, gravity: 'w'});
    jQuery('.tooltip-se').tipsy({fade: true, gravity: 'e'});

    /**
     * Go top
     */
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 1) {
            jQuery('.gotop').css({bottom:"25px"});
        } else {
            jQuery('.gotop').css({bottom:"-100px"});
        }
    });
    jQuery('.gotop').click(function(){
        jQuery('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });
});

/* Tipsy */
(function(a){function b(a,b){return typeof a=="function"?a.call(b):a}function c(a){while(a=a.parentNode){if(a==document)return true}return false}function d(b,c){this.$element=a(b);this.options=c;this.enabled=true;this.fixTitle()}d.prototype={show:function(){var c=this.getTitle();if(c&&this.enabled){var d=this.tip();d.find(".tipsy-inner")[this.options.html?"html":"text"](c);d[0].className="tipsy";d.remove().css({top:0,left:0,visibility:"hidden",display:"block"}).prependTo(document.body);var e=a.extend({},this.$element.offset(),{width:this.$element[0].offsetWidth,height:this.$element[0].offsetHeight});var f=d[0].offsetWidth,g=d[0].offsetHeight,h=b(this.options.gravity,this.$element[0]);var i;switch(h.charAt(0)){case"n":i={top:e.top+e.height+this.options.offset,left:e.left+e.width/2-f/2};break;case"s":i={top:e.top-g-this.options.offset,left:e.left+e.width/2-f/2};break;case"e":i={top:e.top+e.height/2-g/2,left:e.left-f-this.options.offset};break;case"w":i={top:e.top+e.height/2-g/2,left:e.left+e.width+this.options.offset};break}if(h.length==2){if(h.charAt(1)=="w"){i.left=e.left+e.width/2-15}else{i.left=e.left+e.width/2-f+15}}d.css(i).addClass("tipsy-"+h);d.find(".tipsy-arrow")[0].className="tipsy-arrow tipsy-arrow-"+h.charAt(0);if(this.options.className){d.addClass(b(this.options.className,this.$element[0]))}if(this.options.fade){d.stop().css({opacity:0,display:"block",visibility:"visible"}).animate({opacity:this.options.opacity})}else{d.css({visibility:"visible",opacity:this.options.opacity})}}},hide:function(){if(this.options.fade){this.tip().stop().fadeOut(function(){a(this).remove()})}else{this.tip().remove()}},fixTitle:function(){var a=this.$element;if(a.attr("title")||typeof a.attr("original-title")!="string"){a.attr("original-title",a.attr("title")||"").removeAttr("title")}},getTitle:function(){var a,b=this.$element,c=this.options;this.fixTitle();var a,c=this.options;if(typeof c.title=="string"){a=b.attr(c.title=="title"?"original-title":c.title)}else if(typeof c.title=="function"){a=c.title.call(b[0])}a=(""+a).replace(/(^\s*|\s*$)/,"");return a||c.fallback},tip:function(){if(!this.$tip){this.$tip=a('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>');this.$tip.data("tipsy-pointee",this.$element[0])}return this.$tip},validate:function(){if(!this.$element[0].parentNode){this.hide();this.$element=null;this.options=null}},enable:function(){this.enabled=true},disable:function(){this.enabled=false},toggleEnabled:function(){this.enabled=!this.enabled}};a.fn.tipsy=function(b){function e(c){var e=a.data(c,"tipsy");if(!e){e=new d(c,a.fn.tipsy.elementOptions(c,b));a.data(c,"tipsy",e)}return e}function f(){var a=e(this);a.hoverState="in";if(b.delayIn==0){a.show()}else{a.fixTitle();setTimeout(function(){if(a.hoverState=="in")a.show()},b.delayIn)}}function g(){var a=e(this);a.hoverState="out";if(b.delayOut==0){a.hide()}else{setTimeout(function(){if(a.hoverState=="out")a.hide()},b.delayOut)}}if(b===true){return this.data("tipsy")}else if(typeof b=="string"){var c=this.data("tipsy");if(c)c[b]();return this}b=a.extend({},a.fn.tipsy.defaults,b);if(!b.live)this.each(function(){e(this)});if(b.trigger!="manual"){var h=b.live?"live":"bind",i=b.trigger=="hover"?"mouseenter":"focus",j=b.trigger=="hover"?"mouseleave":"blur";this[h](i,f)[h](j,g)}return this};a.fn.tipsy.defaults={className:null,delayIn:0,delayOut:0,fade:false,fallback:"",gravity:"n",html:false,live:false,offset:0,opacity:.8,title:"title",trigger:"hover"};a.fn.tipsy.revalidate=function(){a(".tipsy").each(function(){var b=a.data(this,"tipsy-pointee");if(!b||!c(b)){a(this).remove()}})};a.fn.tipsy.elementOptions=function(b,c){return a.metadata?a.extend({},c,a(b).metadata()):c};a.fn.tipsy.autoNS=function(){return a(this).offset().top>a(document).scrollTop()+a(window).height()/2?"s":"n"};a.fn.tipsy.autoWE=function(){return a(this).offset().left>a(document).scrollLeft()+a(window).width()/2?"e":"w"};a.fn.tipsy.autoBounds=function(b,c){return function(){var d={ns:c[0],ew:c.length>1?c[1]:false},e=a(document).scrollTop()+b,f=a(document).scrollLeft()+b,g=a(this);if(g.offset().top<e)d.ns="n";if(g.offset().left<f)d.ew="w";if(a(window).width()+a(document).scrollLeft()-g.offset().left<b)d.ew="e";if(a(window).height()+a(document).scrollTop()-g.offset().top<b)d.ns="s";return d.ns+(d.ew?d.ew:"")}}})(jQuery);
/* Easing */
jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,t,n,r,i){return jQuery.easing[jQuery.easing.def](e,t,n,r,i)},easeInQuad:function(e,t,n,r,i){return r*(t/=i)*t+n},easeOutQuad:function(e,t,n,r,i){return-r*(t/=i)*(t-2)+n},easeInOutQuad:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t+n;return-r/2*(--t*(t-2)-1)+n},easeInCubic:function(e,t,n,r,i){return r*(t/=i)*t*t+n},easeOutCubic:function(e,t,n,r,i){return r*((t=t/i-1)*t*t+1)+n},easeInOutCubic:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t+n;return r/2*((t-=2)*t*t+2)+n},easeInQuart:function(e,t,n,r,i){return r*(t/=i)*t*t*t+n},easeOutQuart:function(e,t,n,r,i){return-r*((t=t/i-1)*t*t*t-1)+n},easeInOutQuart:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t+n;return-r/2*((t-=2)*t*t*t-2)+n},easeInQuint:function(e,t,n,r,i){return r*(t/=i)*t*t*t*t+n},easeOutQuint:function(e,t,n,r,i){return r*((t=t/i-1)*t*t*t*t+1)+n},easeInOutQuint:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t*t+n;return r/2*((t-=2)*t*t*t*t+2)+n},easeInSine:function(e,t,n,r,i){return-r*Math.cos(t/i*(Math.PI/2))+r+n},easeOutSine:function(e,t,n,r,i){return r*Math.sin(t/i*(Math.PI/2))+n},easeInOutSine:function(e,t,n,r,i){return-r/2*(Math.cos(Math.PI*t/i)-1)+n},easeInExpo:function(e,t,n,r,i){return t==0?n:r*Math.pow(2,10*(t/i-1))+n},easeOutExpo:function(e,t,n,r,i){return t==i?n+r:r*(-Math.pow(2,-10*t/i)+1)+n},easeInOutExpo:function(e,t,n,r,i){if(t==0)return n;if(t==i)return n+r;if((t/=i/2)<1)return r/2*Math.pow(2,10*(t-1))+n;return r/2*(-Math.pow(2,-10*--t)+2)+n},easeInCirc:function(e,t,n,r,i){return-r*(Math.sqrt(1-(t/=i)*t)-1)+n},easeOutCirc:function(e,t,n,r,i){return r*Math.sqrt(1-(t=t/i-1)*t)+n},easeInOutCirc:function(e,t,n,r,i){if((t/=i/2)<1)return-r/2*(Math.sqrt(1-t*t)-1)+n;return r/2*(Math.sqrt(1-(t-=2)*t)+1)+n},easeInElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return-(u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o))+n},easeOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return u*Math.pow(2,-10*t)*Math.sin((t*i-s)*2*Math.PI/o)+r+n},easeInOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i/2)==2)return n+r;if(!o)o=i*.3*1.5;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);if(t<1)return-.5*u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)+n;return u*Math.pow(2,-10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)*.5+r+n},easeInBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*(t/=i)*t*((s+1)*t-s)+n},easeOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*((t=t/i-1)*t*((s+1)*t+s)+1)+n},easeInOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;if((t/=i/2)<1)return r/2*t*t*(((s*=1.525)+1)*t-s)+n;return r/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+n},easeInBounce:function(e,t,n,r,i){return r-jQuery.easing.easeOutBounce(e,i-t,0,r,i)+n},easeOutBounce:function(e,t,n,r,i){if((t/=i)<1/2.75){return r*7.5625*t*t+n}else if(t<2/2.75){return r*(7.5625*(t-=1.5/2.75)*t+.75)+n}else if(t<2.5/2.75){return r*(7.5625*(t-=2.25/2.75)*t+.9375)+n}else{return r*(7.5625*(t-=2.625/2.75)*t+.984375)+n}},easeInOutBounce:function(e,t,n,r,i){if(t<i/2)return jQuery.easing.easeInBounce(e,t*2,0,r,i)*.5+n;return jQuery.easing.easeOutBounce(e,t*2-i,0,r,i)*.5+r*.5+n}});