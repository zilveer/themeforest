var A = A || {};

/*--------------------------------------------------------------------------
  User Interface Methods
/*------------------------------------------------------------------------*/

A.UserInterface = {

  tabs: function () {

    jQuery('.tabs').each(function() {

      var $c = jQuery('.tab', this); // content
      var $t = jQuery('> ul li', this); // tab
      
      $t.on('click', function() {
        var id = jQuery(this).index();
        jQuery([$t, this, $c, $c.eq(id)]).toggleClass('active');
        return false;
      });
    });
  },

  togglers: function () {

    jQuery('.toggle').on('click prepare', 'h4', function(ev) {
      
      var $h4 = jQuery(this);
      $h4.siblings('.toggle-inner').stop().slideToggle('fast','easeInOut');

      if (ev.type == 'click') {
        var $t = $h4.parent();
        // accordion:
        if ($t.hasClass('acc')) $t.siblings('.open.toggle.acc:first').find('h4').trigger('click');
        // classes:
        $t.toggleClass('open');
    }});

    jQuery('.toggle:not(.open) h4').trigger('prepare');
  },

  mobileMenu: function() {
    var id = '#menu-list-mobile';
    if (!jQuery(id).length) return;

    jQuery(id).change(function() {
      var v = jQuery(this).val();
      if (v) location.href = v;
    });
  },

  contactForm: function() { // contact form client logic

    if (!jQuery('#contact').length) return;

    var
      $form = jQuery('#contact'),
      $msg = $form.find('textarea[name="msg"]'),
      msgSI = new aSmartInput($msg,{ checkEmpty: true }),
      nameSI = new aSmartInput($form.find('input[name="title"]'),{ checkEmpty: true }),
      mailSI = new aSmartInput($form.find('input[name="mail"]'),{ checkEmpty: true, checkMail: true }),
      $send = $form.find('input[type="submit"]'),
      $submitAlt = jQuery('<a/>', { href: "#", text: $send.val(), 'class': 'button black' });

    // prepare
    $msg.attr('rows', 1).autosize().blur();
    $send.replaceWith($submitAlt);

    // click event
    $submitAlt.click(function(ev){
      ev.preventDefault();

      var err = false;
      if (msgSI.checkErr()) err = true;
      if (nameSI.checkErr()) err = true;
      if (mailSI.checkErr()) err = true;
      if (err) return;

      $submitAlt.remove();

      jQuery.post($form.attr('action'), $form.serialize(), function (resp) {
        resp = jQuery(resp).find('#email-response').html();
        if (resp) $form.fadeOut(function () { $form.replaceWith(resp).fadeIn(); });
      });
    });
  },
  
  autoLoad: function () {

    this.contactForm();
    this.mobileMenu();
    this.tabs();
    this.togglers();
  }
};

/*--------------------------------------------------------------------------
  Run 3rd-party jQuery Plugins
/*------------------------------------------------------------------------*/

A.JQueryPlugins = {

  slides: function() {
    
    var
      atts = jQuery('ol.slides').data(),
      speed = ((atts && atts.speed) || 0.85) * 1000,
      timeout = ((atts && atts.timeout) || 10) * 1000; // ms

    jQuery('#head + ol.slides').responsiveSlides({
      auto: true, // Boolean: Animate automatically, true or false
      nav: true, // Boolean: Add navigation, true or false
      nextText: 'Next slide', // String: Text for the "next" button
      speed: speed, // Integer: Speed of the transition, in milliseconds
      timeout: timeout // Integer: Time between slide transitions, in milliseconds
    });

    jQuery('.post .content .slides').responsiveSlides({
      auto: true,
      nav: false,
      pager: false,
      timeout: 3000,
      speed: 450
    });

    this.slidesControls();
  },

  slidesControls: function() {
    var
      $s = jQuery('#head + ol.slides'),
      $n = $s.siblings('.rslides_nav.next'),
      $p = $s.siblings('.rslides_nav.prev'),
      $li = $s.children('li'),
      $span = jQuery('<span>'),
      $next = jQuery('<a>',{'href':'#next',html:$n.text()}),
      $prev = jQuery('<a>',{'href':'#prev',html:$p.text()});

    if ($li.length < 2) return;

    jQuery('p.info').append( $span.append( $prev, ' / ' ,$next ) );
    $next.on('click',function(){ $n.trigger('click'); return false; });
    $prev.on('click',function(){ $p.trigger('click'); return false; });
  },

  autoLoad: function() {
    
    this.slides();

    if (jQuery.fn.fitVids) jQuery('.media-container').fitVids();
  }
};

/*--------------------------------------------------------------------------
  Portfolio
/*------------------------------------------------------------------------*/

A.Filter={holder:'.main .filter',filter:'.list > li',items:'.main .thumbs > a.item',setup:function(){var b='hide',actClass='active',$hldr=this.$filterHolder,$filter=jQuery(this.filter,$hldr),$items=jQuery(this.items),hideAll=function(){$items.addClass(b)},showAll=function(){$items.removeClass(b)},clearLinks=function(){$filter.filter('.'+actClass).removeClass(actClass)};$hldr.on('click',this.filter,function(){var a=jQuery(this),d=a.data(),tag=d.tag;if(a.hasClass(actClass))return false;clearLinks();a.addClass(actClass);if(!tag){showAll()}else{hideAll();$items.filter('[data-tags*="'+tag+'"]').removeClass(b)}return false});this.urlHandler($filter)},urlHandler:function(a){var h=window.location.hash,t=h.match(/(filter|tag):([-\w]*)/i);if(!t)return;a.filter('[data-tag="'+t[2]+'"]').trigger('click')},autoLoad:function(){this.$filterHolder=jQuery(this.holder);this.$filterHolder.length&&this.setup()}};

A.Anim = {

  autoLoad: function () {

    var $thumbs = jQuery('body.folio .thumbs[data-fx] > .item'),l=$thumbs.length;
    if (!l) return;

    $thumbs.shuffleElements().each(function(i){
      var d = i*140;
      jQuery(this).attr("style", "-webkit-animation-delay:" + d + "ms;"
        + "-moz-animation-delay:" + d + "ms;"
        + "-o-animation-delay:" + d + "ms;"
        + "animation-delay:" + d + "ms;");
      if (i+1 == l) $thumbs.parent('[data-fx]').addClass('play');
    });
  }
}

jQuery.fn.shuffleElements=function(){var o=jQuery(this);for(var j,x,i=o.length;i;j=parseInt(Math.random()*i),x=o[--i],o[i]=o[j],o[j]=x);return o};

/*--------------------------------------------------------------------------
  Google Map Wrapper
/*------------------------------------------------------------------------*/

A.GMap = {

  hue: '#373432',
  latitude: 51.508,
  longitude: -0.128,
  marker: 'theme/img/marker.png',

  setup: function() {

    this.atts = this.$map.data();
    this.center = new google.maps.LatLng(this.atts.lat || this.latitude, this.atts.long || this.longitude);
    
    var opts = {
      center: this.center,
      disableDefaultUI: true,
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      scrollwheel: false,
      zoom: this.atts.zoom || 18
    };
    this.map = new google.maps.Map(this.$map[0], opts);
    
    var m = new google.maps.Marker({
        map: this.map,
        position: this.center,
        icon: new google.maps.MarkerImage(this.atts.marker || this.marker, new google.maps.Size(61, 61), new google.maps.Point(0, 0), new google.maps.Point(24, 54))});
    
    var s = [{ stylers: [{ hue: this.atts.hue || this.hue }, {saturation: -97}, {visibility: ''}, {weight: 0.3}, {gamma: 1}, {lightness: 38}] }];
    var t = new google.maps.StyledMapType(this.atts.style ? s : []);
    
    this.map.mapTypes.set('map', t);
    this.map.setMapTypeId('map');
  },

  onResize: function() {
    this.map && this.map.setCenter(this.center);
  },

  autoLoad: function() {

    this.$map = jQuery('#map');
    this.$map.length && this.setup();
    
    jQuery(window).bind('resize orientationchange', function(){ A.GMap.onResize(); });
  }
};

/*--------------------------------------------------------------------------
  Init jQuery & A Object
/*------------------------------------------------------------------------*/

; (function(){jQuery.noConflict();jQuery(document).ready(function(){for(var p in A)A.hasOwnProperty(p)&&A[p]&&A[p].autoLoad&&A[p].autoLoad()})})(jQuery);

/*--------------------------------------------------------------------------
  Packed Custom & 3rd-party jQuery Plugins
/*------------------------------------------------------------------------*/

// Custom easing
; jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:'easeOut',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d)},easeIn:function(x,t,b,c,d){return(!t)?b:c*Math.pow(2,10*(t/d-1))+b},easeOut:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b},easeInOut:function(x,t,b,c,d){if(!t)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b}});
// Custom placeholder
; var aSmartInput=function(f,d){var b=f instanceof jQuery?f:jQuery(f),e=b.val();d=jQuery.extend({placeholder:!0,checkEmpty:!0,checkMail:!1},d);b.val(e).focus(function(){b.val()==e&&b.val("");b.removeClass("err")}).blur(function(){b.val()||b.val(e)});this.checkErr=function(){var c=!1,a;if(a=d.checkEmpty)if(a=!c)a=b,a.jquery&&(a=a.val()),a=!(jQuery.trim(a).length&&a!=e);a&&(c=!0);if(a=d.checkMail)if(a=!c)a=b,a.jquery&&(a=a.val()),a=!a.match(/[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}/);a&&(c=!0);c?b.addClass("err"):b.removeClass("err");return c};this.noErr=function(){return!this.checkErr()}};

// jQuery Autosize by Jack Moore; MIT
; (function(e){var t,o={className:"autosizejs",append:"",callback:!1},i="hidden",n="border-box",s="lineHeight",a='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden;"/>',r=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],l="oninput",c="onpropertychange",h=e(a).data("autosize",!0)[0];h.style.lineHeight="99px","99px"===e(h).css(s)&&r.push(s),h.style.lineHeight="",e.fn.autosize=function(s){return s=e.extend({},o,s||{}),h.parentNode!==document.body&&e(document.body).append(h),this.each(function(){function o(){t=b,h.className=s.className,e.each(r,function(e,t){h.style[t]=f.css(t)})}function a(){var e,n,a;if(t!==b&&o(),!d){d=!0,h.value=b.value+s.append,h.style.overflowY=b.style.overflowY,a=parseInt(b.style.height,10),h.style.width=Math.max(f.width(),0)+"px",h.scrollTop=0,h.scrollTop=9e4,e=h.scrollTop;var r=parseInt(f.css("maxHeight"),10);r=r&&r>0?r:9e4,e>r?(e=r,n="scroll"):p>e&&(e=p),e+=g,b.style.overflowY=n||i,a!==e&&(b.style.height=e+"px",x&&s.callback.call(b)),setTimeout(function(){d=!1},1)}}var p,d,u,b=this,f=e(b),g=0,x=e.isFunction(s.callback);f.data("autosize")||((f.css("box-sizing")===n||f.css("-moz-box-sizing")===n||f.css("-webkit-box-sizing")===n)&&(g=f.outerHeight()-f.height()),p=Math.max(parseInt(f.css("minHeight"),10)-g,f.height()),u="none"===f.css("resize")||"vertical"===f.css("resize")?"none":"horizontal",f.css({overflow:i,overflowY:i,wordWrap:"break-word",resize:u}).data("autosize",!0),c in b?l in b?b[l]=b.onkeyup=a:b[c]=a:b[l]=a,e(window).resize(function(){d=!1,a()}),f.bind("autosize",function(){d=!1,a()}),a())})}})(window.jQuery||window.Zepto);
// http://responsiveslides.com v1.32 by @viljamis
; (function(d,D,v){d.fn.responsiveSlides=function(h){var b=d.extend({auto:!0,speed:1E3,timeout:4E3,pager:!1,nav:!1,random:!1,pause:!1,pauseControls:!1,prevText:"Previous",nextText:"Next",maxwidth:"",controls:"",namespace:"rslides",before:function(){},after:function(){}},h);return this.each(function(){v++;var e=d(this),n,p,i,k,l,m=0,f=e.children(),w=f.size(),q=parseFloat(b.speed),x=parseFloat(b.timeout),r=parseFloat(b.maxwidth),c=b.namespace,g=c+v,y=c+"_nav "+g+"_nav",s=c+"_here",j=g+"_on",z=g+"_s",o=d("<ul class='"+c+"_tabs "+g+"_tabs' />"),A={"float":"left",position:"relative"},E={"float":"none",position:"absolute"},t=function(a){b.before();f.stop().fadeOut(q,function(){d(this).removeClass(j).css(E)}).eq(a).fadeIn(q,function(){d(this).addClass(j).css(A);b.after();m=a})};b.random&&(f.sort(function(){return Math.round(Math.random())-0.5}),e.empty().append(f));f.each(function(a){this.id=z+a});e.addClass(c+" "+g);h&&h.maxwidth&&e.css("max-width",r);f.hide().eq(0).addClass(j).css(A).show();if(1<f.size()){if(x<q+100)return;if(b.pager){var u=[];f.each(function(a){a=a+1;u=u+("<li><a href='#' class='"+z+a+"'>"+a+"</a></li>")});o.append(u);l=o.find("a");h.controls?d(b.controls).append(o):e.after(o);n=function(a){l.closest("li").removeClass(s).eq(a).addClass(s)}}b.auto&&(p=function(){k=setInterval(function(){f.stop(true,true);var a=m+1<w?m+1:0;b.pager&&n(a);t(a)},x)},p());i=function(){if(b.auto){clearInterval(k);p()}};b.pause&&e.hover(function(){clearInterval(k)},function(){i()});b.pager&&(l.bind("click",function(a){a.preventDefault();b.pauseControls||i();a=l.index(this);if(!(m===a||d("."+j+":animated").length)){n(a);t(a)}}).eq(0).closest("li").addClass(s),b.pauseControls&&l.hover(function(){clearInterval(k)},function(){i()}));if(b.nav){c="<a href='#' class='"+y+" prev'>"+b.prevText+"</a><a href='#' class='"+y+" next'>"+b.nextText+"</a>";h.controls?d(b.controls).append(c):e.after(c);var c=d("."+g+"_nav"),B=d("."+g+"_nav.prev");c.bind("click",function(a){a.preventDefault();if(!d("."+j+":animated").length){var c=f.index(d("."+j)),a=c-1,c=c+1<w?m+1:0;t(d(this)[0]===B[0]?a:c);b.pager&&n(d(this)[0]===B[0]?a:c);b.pauseControls||i()}});b.pauseControls&&c.hover(function(){clearInterval(k)},function(){i()})}}if("undefined"===typeof document.body.style.maxWidth&&h.maxwidth){var C=function(){e.css("width","100%");e.width()>r&&e.css("width",r)};C();d(D).bind("resize",function(){C()})}})}})(jQuery,this,0);

