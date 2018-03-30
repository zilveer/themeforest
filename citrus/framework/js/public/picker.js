jQuery(document).ready(function($){

  "use strict";
  var $picker_container = jQuery("div.dt-style-picker-wrapper"),
      $theme_url = mytheme_urls.theme_base_url,
      $fw_url = mytheme_urls.framework_base_url,
	  $dark_layout = mytheme_urls.dark_layout,
	  $rtl = mytheme_urls.isRTL,
	  $logoURL = mytheme_urls.logoURL,
	  $retinalogoURL = mytheme_urls.retinalogoURL,
      $patterns_url = $fw_url+"theme_options/images/patterns/";
  
  //Applying Cookies
  if($.cookie("citrus_skin")!== null ){

    if( mytheme_urls.is_admin === '1' ) {
      $.cookie("citrus_skin",mytheme_urls.skin, { path: '/' });
    }

    var $href = $("link[id='skin-css']").attr("href");
    $href = $href.substr(0,$href.lastIndexOf("/"));
    $href = $href.substr(0,$href.lastIndexOf("/"))+"/"+$.cookie("citrus_skin")+"/style.css";
    
    $("link[id='skin-css']").attr("href",$href);
    $("ul.color-picker a[id='"+$.cookie("citrus_skin")+"']").addClass("selected");
  }else{
	$("ul.color-picker a:first").addClass("selected");
  }
  
	if($rtl == true) {
		if ( $.cookie('citrus-control-open') === '1' ) {
			$picker_container.animate({right: 0});
			$('a.style-picker-ico').removeClass('control-open');
		} else {
			$picker_container.animate( { right: -230 } );
			$('a.style-picker-ico').addClass('control-open');
		}
	} else {
		if ( $.cookie('citrus-control-open') === '1' ) {
			$picker_container.animate({left: 0});
			$('a.style-picker-ico').removeClass('control-open');
		} else {
			$picker_container.animate( { left: -230 } );
			$('a.style-picker-ico').addClass('control-open');
		}
	}

	if($.cookie("citrus_layout_color") !== null){
		if($.cookie("citrus_layout_color") == 'dark-layout'){
			$('body').addClass('dt-dark-layout');
			$("ul.layout-color-picker a#dark-layout").addClass("selected");
			$('#darkskin-css-css').attr('href', $theme_url+'css/dark-skin.css');
			if($logoURL == '') $('#dt_logo').attr('src', $theme_url+'images/logo-dark.png');
			if($retinalogoURL == '') $('#dt_retina_logo').attr('src', $theme_url+'images/logo@2x-dark.png');
		} else {
			$('body').removeClass('dt-dark-layout');
			$("ul.layout-color-picker a#default-layout").addClass("selected");
			$('#darkskin-css-css').attr('href', '#');
			if($logoURL == '') $('#dt_logo').attr('src', $theme_url+'images/logo.png');
			if($retinalogoURL == '') $('#dt_retina_logo').attr('src', $theme_url+'images/logo@2x.png');
		}
	} else {
		if($dark_layout != '') {
			$('body').addClass('dt-dark-layout');
			$("ul.layout-color-picker a#dark-layout").addClass("selected");
			$('#darkskin-css-css').attr('href', $theme_url+'css/dark-skin.css');
			if($logoURL == '') $('#dt_logo').attr('src', $theme_url+'images/logo-dark.png');
			if($retinalogoURL == '') $('#dt_retina_logo').attr('src', $theme_url+'images/logo@2x-dark.png');
		} else {
			$('body').removeClass('dt-dark-layout');
			$("ul.layout-color-picker a#default-layout").addClass("selected");
			$('#darkskin-css-css').attr('href', '#');
			if($logoURL == '') $('#dt_logo').attr('src', $theme_url+'images/logo.png');
			if($retinalogoURL == '') $('#dt_retina_logo').attr('src', $theme_url+'images/logo@2x.png');
		}
	}
    
  //1. Applying Layout & patterns
  if($.cookie("citrus_layout") === "boxed"){
	  
    $("ul.layout-picker li a").removeAttr("class");
    $("ul.layout-picker li a[id='"+$.cookie("citrus_layout")+"']").addClass("selected");

	  $("div#pattern-holder").removeAttr("style");
    $('body').addClass('boxed');
    if($.cookie("citrus_pattern")) {
	    var $i = $.cookie("citrus_pattern");
    	var $img = $patterns_url+$i;
        $('body').css('background-image', 'url('+$img+')');
	}
	
    
  }//Applying Cookies End
  
	//Picker On/Off
	$("a.style-picker-ico").click(function(e){
		var $this = $(this);	
		
		if($rtl == true) {
			if($this.hasClass('control-open')){
				$picker_container.animate({right: 0},function(){$this.removeClass('control-open');});
				$.cookie('citrus-control-open', 1, { path: '/' });	
			}else{
				$picker_container.animate({right: -230},function(){$this.addClass('control-open');});
				$.cookie('citrus-control-open', 0, { path: '/' });
			}
		} else {
			if($this.hasClass('control-open')){
				$picker_container.animate({left: 0},function(){$this.removeClass('control-open');});
				$.cookie('citrus-control-open', 1, { path: '/' });	
			}else{
				$picker_container.animate({left: -230},function(){$this.addClass('control-open');});
				$.cookie('citrus-control-open', 0, { path: '/' });
			}
		}
		
		e.preventDefault();
	});//Picker On/Off end

  //Layout Picker
  $("ul.layout-picker a").click(function(e){
    var $this = $(this);
    $("ul.layout-picker a").removeAttr("class");
    $this.addClass("selected");
    $.cookie("citrus_layout", $this.attr("id"), { path: '/' });

    if( $.cookie("citrus_layout") === "boxed") {
      $("body").addClass("boxed");
      $("div#pattern-holder").slideDown();
		if( $.cookie("citrus_pattern") == null ){
			$("ul.pattern-picker a:first").addClass('selected');
			$.cookie("citrus_pattern","pattern1.jpg",{ path: '/' });
			$('body').css('background-image', 'url('+$patterns_url+'pattern1.jpg)');
		} else {
			$img = $patterns_url+$.cookie("citrus_pattern");
			$('body').css('background-image', 'url('+$img+')');
      }
    } else {
      $("body").removeAttr("style").removeClass("boxed");
      $("div#pattern-holder").slideUp();
      $("ul.pattern-picker a").removeAttr("class");
    }
    window.location.href = location.href;
    e.preventDefault();
  });//Layout Picker End

  //Pattern Picker
  $("ul.pattern-picker a").click(function(e){
    
    if($.cookie("citrus_layout") === "boxed"){
      var $this = $(this);
      $("ul.pattern-picker a").removeAttr("class");
      $this.addClass("selected");
      $.cookie("citrus_pattern", $this.attr("data-image"), { path: '/' });
      var $img = $patterns_url+$.cookie("citrus_pattern");
      $('body').css('background-image', 'url('+$img+')');
    }
    e.preventDefault();
  });//Pattern Picker End


	//Layout Color Picker
	$("ul.layout-color-picker a").click(function(e){
	
		var $this = $(this);
		$("ul.layout-color-picker a").removeClass("selected");
		$this.addClass("selected");
	
		if($this.attr('id') === "dark-layout"){
			$.cookie("citrus_layout_color", 'dark-layout', { path: '/' });
			$('body').addClass('dt-dark-layout');
			$('#darkskin-css-css').attr('href', $theme_url+'css/dark-skin.css');
			if($logoURL == '') $('#dt_logo').attr('src', $theme_url+'images/logo-dark.png');
			if($retinalogoURL == '') $('#dt_retina_logo').attr('src', $theme_url+'images/logo@2x-dark.png');
			if($logoURL == '') $('#dt_togglelogo').attr('src', $theme_url+'images/logo-dark.png');
			if($retinalogoURL == '') $('#dt_retina_togglelogo').attr('src', $theme_url+'images/logo@2x-dark.png');
		} else {
			$.cookie("citrus_layout_color", 'white-layout', { path: '/' });
			$('body').removeClass('dt-dark-layout');
			$('#darkskin-css-css').attr('href', '#');
			if($logoURL == '') $('#dt_logo').attr('src', $theme_url+'images/logo.png');
			if($retinalogoURL == '') $('#dt_retina_logo').attr('src', $theme_url+'images/logo@2x.png');
			if($logoURL == '') $('#dt_togglelogo').attr('src', $theme_url+'images/logo.png');
			if($retinalogoURL == '') $('#dt_retina_togglelogo').attr('src', $theme_url+'images/logo@2x.png');
		}
		e.preventDefault();
	
	});//Layout Color Picker


  //Color Picker
  $("ul.color-picker a").click(function(e){
    var $this = $(this);
    $("ul.color-picker a").removeAttr("class");
    $this.addClass("selected");
    $.cookie("citrus_skin", $this.attr("id"), { path: '/' });
    $href = $("link[id='skin-css']").attr("href");
    $href = $href.substr(0,$href.lastIndexOf("/"));
    $href = $href.substr(0,$href.lastIndexOf("/"))+"/"+$this.attr("id")+"/style.css";
    $("link[id='skin-css']").attr("href",$href);
    e.preventDefault();
  });//Color Picker End
});