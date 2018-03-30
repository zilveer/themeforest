/*! New Idea Theme V4.0 */
jQuery(document).ready(function($) {
  "use strict";
	//==========================
	//  global params
	//==========================
	
	// inin window width/height/bg mobile
	var window_width = $(window).width();

	
	//portfolio data
	var portfolio = {parent:null,subparent:null,child:null,subelement:null};
	
	//news data
	var news = {parent:null,child:null};
	
	// menus
	var menu_items = $('nav#nav a');
	
	// menu can click
	var menu_click = true;
	
	// menu id
	var divId = $('nav#nav a:first').attr('href');
	
	// menu current click id
	var curr_anchor;
	
	// ================
	// Get current page div id
	// ================
	if($("#content-elements-page").length > 0){
		divId = '#' + $("#content-elements-page").attr('value');
	}else if($("#content-elements-single").length > 0){
		divId = '#' + $("#content-elements-single").attr('value');
	}
	
	// ================
	// Get hash #value and init
	// ================
	if(window.location.hash){
		var hashash = window.location.hash.substring();
		//here check is valid id
		if(hashash.length > 0 && $('nav#nav a[href="'+hashash+'"]').length > 0){
			divId = hashash;
			$(menu_items).removeClass('navActv');
		}
	}else{
		//get theme color
		var themecolors = ($('#theme_color').attr('value')).split(':');
		// loader for begin preloader
	   	$("body").queryLoader2({
			barColor: "#"+themecolors[0],
			backgroundColor: "#"+themecolors[1],
			percentage: false,
			barHeight: 1
		});
	}

	// remove default mask
	$('#loading-bg').remove();
	
	//Menu init
	if(window_width > 767) {
		
		//add menu bg
		$("#nav").find("a").each(function(index, element) {
			$(element).wrap('<div class="nav-item"></div>');
			$(element).before('<span class="nav-bg"></span>');
		});
		
		// active current menu
		$('nav#nav a[href="'+divId+'"]').addClass("navActv");
		
		//bind menu click
		$(menu_items).click(function() {
			if($(this).hasClass('navActv')){
				return;
			} else {
				if($(this).attr('href').indexOf('http://') == -1){
					menuClickMovePanel(this);
				}			
			}
		
		});
		
		//menu bg init position
		$('.nav-item').each(function(index, element) {
					
			$(element).hover(function(){
				$(this).find(".nav-bg").animate({top:'0px'},"fast");
			},function(){
				if($(this).find("a").hasClass("navActv")) return false;
				$(this).find(".nav-bg").animate({top:'-38px'},"fast");
			});
			if($(element).find("a").hasClass("navActv")) $(this).find(".nav-bg").animate({top:'0px'},0);
		});
		
		//setting default body min width
		if( parseInt($('#nav').width()) > 920) $("body").css("min-width",$('#nav').width());
		
		refreshNavMenu();

		$(window).resize(function(){
			if( $(window).width() <= 767){
				window.location.reload(true);
				return;
			}
			
			var target_top = ($(window).height() - $('header').height() - $('footer').height())/2 + $('header').height()- 195;
			
			if(news.child !== null)
				$(news.child).animate({marginTop:target_top + 'px'},200);
			else if(portfolio.child !== null) 
				$(portfolio.child).animate({marginTop:target_top + 'px'},200);
			else if(portfolio.subparent !== null) 
				$(portfolio.subparent).animate({marginTop:target_top + 'px'},200);
			else
				$(divId).animate({marginTop:target_top + 'px'},200);
	
			refreshNavMenu();
		});
		
	}
	
	function menuClickMovePanel(menu_element){
		if(menu_click) return;
					
		menu_click = true;
		
		curr_anchor = $(menu_element);
		
		$(menu_items).each(function(index, element) {
			if($(element).hasClass('navActv')) {
				$(element).removeClass("navActv");
				$(element).parent().find(".nav-bg").stop(true,true).animate({top:'-38px'},"fast");
			}
		});
		
		try{
			$(divId).find('video, audio').each(function() { $(menu_element)[0].player.pause(); });
		}catch(e){}
		
		$(menu_element).addClass("navActv");
		
		//delete sub element
		portfolio.subelement = null;
		
		//news showed
		if(news.child !== null){

			hidePagePanel(news.child,function() {
					removePanel('news.child');
					divId = curr_anchor.attr('href');
					showPagePanel(divId);
				});
			
		}else if(portfolio.child !== null){//portfolio List showed

			hidePagePanel(portfolio.child,function() {
					removePanel('portfolio.child');
					divId = curr_anchor.attr('href');
					showPagePanel(divId);
				});
		}else if(portfolio.subparent !== null){//portfolio List showed

			hidePagePanel(portfolio.subparent,function() {
					removePanel('portfolio.subparent');
					divId = curr_anchor.attr('href');
					showPagePanel(divId);
				});
		}else{
			
			hidePagePanel(divId, function() {
					$(divId).css({'display':'none'});
					divId = curr_anchor.attr('href');
					showPagePanel(divId);
				});
		}
	}
	
	//Initialize Backgound
	// mobile image
	var mobile_bg_url;
	var mobileImage;
	
	if(window_width > 767){
		if($('#default_background').attr('value') && $('#default_background').attr('value') !== ""){
			$.vegas({src:$('#default_background').attr('value'),fade:1000});
			if($('#background_overlay').attr('value') && $('#background_overlay').attr('value') !== ""){
				$.vegas('overlay',{src:$('#background_overlay').attr('value'),
                           opacity:($('#background_overlay_alpha').attr('value') !== "" ? Number($('#background_overlay_alpha').attr('value')) : 0.5)});
			}
		}
	}else{
		mobile_bg_url = $('#mobile_background').attr('value');
		if(mobile_bg_url !== ''){
			//change v1.1.0
			mobileImage = new Image();
			mobileImage.name = 'Mobile Image';
			mobileImage.onload = showMobileImage;
			mobileImage.src = mobile_bg_url;
		}
	}

	function showMobileImage() {
		var imgHeight = mobileImage.height;
		var imgWidth = mobileImage.width;
		
		$('body').prepend('<div class="mobile-bg-img"><img src="'+mobile_bg_url+'" alt="" /></div>');
		
		resizeImageSize();
		
		function resizeImageSize(){
			var current_width = $(window).width();
			var current_height = $(window).height();
			
			var h_p = Number(imgHeight/current_height) - 0.1;
			var w_p = Number(imgWidth/current_width) - 0.1;
			
			if(h_p > w_p){
				var tag_height = imgHeight/w_p;
				$('.mobile-bg-img img').css('width',imgWidth/w_p + 'px');
				$('.mobile-bg-img img').css('height',tag_height + 'px');
				$('.mobile-bg-img img').css('top',-( tag_height - current_height)/2 + 'px' );
			}else{
				var tag_width = imgWidth/h_p;
				$('.mobile-bg-img img').css('height',imgHeight/h_p + 'px');
				$('.mobile-bg-img img').css('width',tag_width + 'px');
				$('.mobile-bg-img img').css('left',-(tag_width - current_width)/2 + 'px' );
			}
		}
		
		$(window).resize(function(){
			resizeImageSize();
		});
	}
	
	// news,services
	if(window_width > 767) {
		$('.jcarousel-news').newideaJcarousel({vertical: true,ease:'easeOutBack',time:600,showNumber:2,itemHeight:164});
		$('.jcarousel-services').newideaJcarousel({vertical: true,ease:'easeOutBack',time:600,itemHeight:170,showNumber:2});
	}
	
	//----------------------------------------------//
	//contact page init
	//----------------------------------------------//
	function contactInit(){

		$('#contact-name').focusout(function() {
			checkForm();
		});
		
		$('#contact-email').focusout(function() {
			checkForm();
		});
		
		$('#contact-message').focusout(function() {
			checkForm();
		});
		
		$('#submit').click(function() {
			if($(this).hasClass('active')){
				var contact_name 		= $('#contact-name').attr('value');
				var contact_email 		= $('#contact-email').attr('value');
				var contact_message 	= $('#contact-message').val();
				var contact_email_to 	= $('#emailTo').attr('value');
				var ajax_load_date = new Date();
				$.ajax({type:'GET',
						url:$('#contact-form').attr('action') + '?' + ajax_load_date.getTime(),
						data: {contactName:contact_name, email: contact_email, message:contact_message , emailTo: contact_email_to} ,
						timeout:3000,
						error: backErrFun,
						complete: backSuccessFun
						});
				}
				$('#loading').addClass('active');
			
				function backErrFun(){
					$('#contact-form').find('.error').html('send error!');
					$('#loading').removeClass('active');
				}
				
				function backSuccessFun(data,textStatus){
					$('#contact-form').find('.success').html('send success!');
					$('#contact-form').find('.success').show();
					$('#contact-name').attr('value','');
					$('#contact-email').attr('value','');
					$('#contact-message').val("");
					$('#loading').removeClass('active');
				}
			
		});
	}
	contactInit();
	
	//----------------------------------------------//
	//portfolio scroll init
	//----------------------------------------------//
	
	portfolioScrollInit(".ps_slider");
	
	//portfolio scroll
	function portfolioScrollInit(element){
		var positions 	= {0 : '0px', 1 : '218px', 2 	: '436px', 3 	: '654px' };
		var items 	= $(element).find(".ps_album");
		var index	= 0;
		var bool 	= false;
		var endItem;
		
		// open portfolio images/subcategory
		$(items).click(function() {			
			if(menu_click){
				return false;
			}
			menu_click = true;
			if($(this).attr('data-type') == 'sub'){
				portfolioSubCategorySend(element,this);
			}else{
				portfolioSendPost(element,this);
			}
		});
		
		$(element).find('.prev').click(function() {
			if(bool){
				return;
			}
			if($(this).hasClass('disabled')){
				return false;
			}
			
			bool = true;
			var k = 0;
			
			for(var i=index-1; i<index+5 && i<items.length; i++){
				var target_left = parseInt($(items[i]).css('left'));

				if(k == 4){
					endItem = items[i];
					$(items[i]).animate({left:(target_left + 218) + 'px',opacity:0},600,'',moveComplete);
					
				}else if(k === 0){
					$(items[i]).css({opacity:0,display:'block','left':'-218px'}).animate({left:'0px',opacity:1},600);
				}else{
					$(items[i]).animate({left:(target_left + 218) + 'px'},600);
				}
				k++;
			}
			
			index--;
			
			refreshPortfolioBtnStatus(element,index,4,items);
			
		});
		
		$(element).find('.next').click(function() {
			if(bool){
				return;
			}
			if($(this).hasClass('disabled')){
				return false;
			}
				
			bool = true;
			
			var k = 0;
			for(var i=index; i<index+5 && i<items.length; i++){
				var target_left = parseInt($(items[i]).css('left'));
				if(k === 0){
					endItem = items[i];
					$(items[i]).animate({left:(target_left - 218) + 'px',opacity:0},600,'',moveComplete);
				}else if(k == 4){
					$(items[i]).css({opacity:0,display:'block','left':'876px'}).animate({left:'658px',opacity:1},600);
				}else{
					$(items[i]).animate({left:(target_left - 218) + 'px'},600);
				}
				k++;
				
			}
			
			index++;
			
			refreshPortfolioBtnStatus(element,index,4,items);	
		});
		
		function moveComplete(){
			bool = false;
			$(endItem).css('display','none');
		}

		refreshPortfolioBtnStatus(element,index,4,items);
		
		if(window_width > 767){
			if(items.length < 4){
				for(var i=0; i<items.length; i++){
					var left = (218 * (4-items.length)) /2;
					$(items[i]).css({'left':(parseInt(positions[i]) + left) + 'px','display':'block'});
				}
			}else{
				for(var j=0; j<items.length; j++){
					if(j < 4)
						$(items[j]).css({'left':positions[j],'display':'block'});
					else
						$(items[j]).css('display','none');
				}
			}
		}
	}
	
	// add portfolio images default effect
	function portfolioImagesEffect(){
		var items = $('.portfolio-list').find('.portfolio-list-item');
		var new_items = [];
		var index = 0;
		var bool = false;
		var endItem;
		
		for(var i=0;i < items.length;){
			var p_item = [];
			if(items[i] !== null){
				 p_item.push(items[i]);
				 if($(items[i]).find("a").attr('data-format') == '0'){ 
					$(items[i]).find("a").addClass('fancybox');
					$(items[i]).find("a").attr("data-fancybox-group",'button');
				 }else  if($(items[i]).find("a").attr('data-format') == '1'){ 
					$(items[i]).find("a").addClass('fancyboxMedia');
					$(items[i]).find("a").attr("rel",'media-gallery');
				 }
			}
			
			if( i+1 <items.length ){
				 p_item.push(items[i+1]);
				 if(window_width > 767){ 
				 	$(items[i+1]).css({'top':'160px'}); 
				 }
				 if($(items[i+1]).find("a").attr('data-format') == '0'){ 
					$(items[i+1]).find("a").addClass('fancybox');
					$(items[i+1]).find("a").attr("data-fancybox-group",'button');
				 }else  if($(items[i+1]).find("a").attr('data-format') == '1'){ 
				 	$(items[i+1]).find("a").addClass('fancyboxMedia');
					$(items[i+1]).find("a").attr("rel",'media-gallery');
				 }
			}
			new_items.push(p_item);
			i += 2;
		}
		
		
		if(window_width > 767){
			for(var j=0;j<new_items.length;j++){
				if(j > 3){
					$(new_items[j]).css('display','none');
				}else{
					var left_val 	=  (j * 220) + 'px';
					$(new_items[j]).css('left',left_val);
				}
			}
			//portfolio item mouse over effect
			$(items).each(function(index, element) {
				$(element).hover(function (){
					var h = parseInt($(this).find('.ps_desc').height());
					$(this).find('.ps_desc').stop(true,true).animate({top:(150- h)+'px'},300);
					$(this).find('.ps_img').stop(true,true).animate({top:(10-h) + 'px' },300);
				},function (){
					$(this).find('.ps_desc').stop(true,true).animate({top:'150px'},300);
					$(this).find('.ps_img').stop(true,true).animate({top:'0px' },300);
				});
			});
		}
		
		//background category
		$('.portfolio-list-back').children('a').click(function() {
			if(portfolio.subelement !== null) {
				portfolioSubCategorySend(portfolio.child , portfolio.subelement , true);
			}else{
				hidePagePanel(portfolio.child,function(){
					removePanel('portfolio.child');
					showPagePanel(portfolio.parent);
				});
			}
			
        });
		
		$('.portfolio-list').find('.prev').click(function() {
			if(bool){
				return;
			}
			if($(this).hasClass('disabled')){
				return false;
			}
			bool = true;
			var k = 0;
			for(var i=index-1; i<index+5 && i<new_items.length; i++){
				var target_left = parseInt($(new_items[i]).css('left'));
				
				if(k == 4){
					endItem = new_items[i];
					$(new_items[i]).animate({left:(target_left + 220) + 'px',opacity:0},600,'',moveComplete);
					
				}else if(k === 0){
					$(new_items[i]).css({opacity:0,display:'block','left':'-218px'}).animate({left:'0px',opacity:1},600);
				}else{
					$(new_items[i]).animate({left:(target_left + 220) + 'px'},600);
				}
				k++;
			}
			
			index--;
			
			refreshPortfolioBtnStatus('.portfolio-list',index,4,new_items);
			
		});
		
		$('.portfolio-list').find('.next').click(function() {
			if(bool){
				return;
			}
			if($(this).hasClass('disabled')){
				return false;
			}
			bool = true;
		
			var k = 0;
			for(var i=index; i< index + 5 && i<new_items.length; i++){
				var target_left = parseInt($(new_items[i][0]).css('left'));
				if(k === 0){
					endItem = new_items[i];
					$(new_items[i]).animate({left:(target_left - 220) + 'px',opacity:0},600,'',moveComplete);
				}else if(k == 4){
					$(new_items[i]).css({opacity:0,display:'block','left':'876px'}).animate({left:'658px',opacity:1},600);
				}else{
					$(new_items[i]).animate({left:(target_left - 220) + 'px'},600);
				}
				k++;
			}
		
			index++;

			refreshPortfolioBtnStatus('.portfolio-list',index,4,new_items);
		});
		
		function moveComplete(){
			bool = false;
			$(endItem).css('display','none');
		}
		
		refreshPortfolioBtnStatus('.portfolio-list',index,4,new_items);
		
		// fancybox
		if($.fn.fancybox !== null){
			$("a.fancybox").fancybox({openEffect  : 'fade',	closeEffect : 'fade',prevEffect : 'fade',nextEffect : 'fade',closeBtn  : false,
				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});
			$("a.fancyboxMedia").fancybox({	openEffect  : 'fade',closeEffect : 'fade',helpers : {media : {}	}});
		}
	}
	
	//refresh btn status
	function refreshPortfolioBtnStatus(element,index,length,items){
		if(index <= 0){
			$(element).find('.prev').removeClass('active');
			if($(element).find('.prev').hasClass('disabled')){
				
			}else{
				$(element).find('.prev').addClass('disabled');
			}
		}else{
			$(element).find('.prev').removeClass('disabled');
			$(element).find('.prev').addClass('active');
		}
		
		if(index + length < items.length){
			$(element).find('.next').removeClass('disabled');
			$(element).find('.next').addClass('active');
		}else{
			$(element).find('.next').addClass('disabled');
			$(element).find('.next').removeClass('active');
		}
	}
	
	// get portfolio images list
	function portfolioSubCategorySend(parent,element,bool){
		var current_parent;
		
		if(bool !== true){
			portfolio.parent = $(parent).parent().parent();
			current_parent = $(parent).parent().parent();
			portfolio.subelement = {url:$(element).attr('data-url'),slug:$(element).attr('data-slug'),href:$(element).attr('data-href'),bgimg:$(element).attr('data-bg')};
		}else{
			current_parent = parent;
		}
	
		hidePagePanel(current_parent,function(){
			if(bool){
				removePanel('portfolio.child');
			}else{
				$(this).css({'display':'none'});
			}
			var ajax_load_date = new Date();
			$.ajax({
				type: "GET",
				url: portfolio.subelement.url + '?' + ajax_load_date.getTime(),
				timeout: 5000,
				error: portfolioBackError,
				data: {slug:portfolio.subelement.slug,href:portfolio.subelement.href,bgimg:portfolio.subelement.bgimg},
				success: portfolioBackSuccess
			 });
			 $('#loading').addClass('active');
		});

		// get back error
		function portfolioBackError(){
			showPagePanel(current_parent);
			$('#loading').removeClass('active');
		}
		 
		// get back success
		function portfolioBackSuccess(data, textStatus) {
			
			$('#loading').removeClass('active');
			removePanel('portfolio.subparent');
			$('#content-elements').append(data);
			refreshContentPosition();
			portfolio.subparent = $('#portfolio-sub-category');
			portfolioScrollInit('#ps_sub_slider');
			$('#portfolio-sub-category .portfolio-list-back a').click(function() {
				hidePagePanel(portfolio.subparent,function(){
					portfolio.subelement = null;
					removePanel('portfolio.subparent');
					showPagePanel(portfolio.parent);
				});

            });
			showPagePanel(portfolio.subparent);
		}
	}
	
	// get portfolio images list
	function portfolioSendPost(parent,element){
		if(portfolio.parent === null) portfolio.parent = $(parent).parent().parent();
		
		hidePagePanel($(parent).parent().parent(),function(){
			$(this).css({'display':'none'});
			var ajax_load_date = new Date();
			$.ajax({
				type: "GET",
				url: $(element).attr('data-url') + '?' + ajax_load_date.getTime(),
				timeout: 5000,
				error: portfolioBackError,
				data: {slug:$(element).attr('data-slug'),'href':$(element).attr('data-href'),'bgimg':$(element).attr('data-bg')},
				success: portfolioBackSuccess
			 });
			 $('#loading').addClass('active');
		});

		// get back error
		function portfolioBackError(){
			showPagePanel($(parent).parent().parent());
			$('#loading').removeClass('active');
		}
		 
		// get back success
		function portfolioBackSuccess(data, textStatus) {
			$('#loading').removeClass('active');
			removePanel('portfolio.child');
			$('#content-elements').append(data);
			refreshContentPosition();
			portfolio.child = $('#portfolio-list-just-view');
			portfolioImagesEffect();
			showPagePanel(portfolio.child);
		}
	}
	
	// slide lite
	$('.slidelite').slideLite();
	
	// scroll pane
	$('.scroll-pane').jScrollPane({clickOnTrack:false});
	
	
	if($.fn.fancybox !== null){
		$("a.fancybox").fancybox({openEffect  : 'fade',	closeEffect : 'fade',prevEffect : 'fade',nextEffect : 'fade',closeBtn  : false,
				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});
		$("a.fancyboxMedia").fancybox({	openEffect  : 'none',closeEffect : 'none',helpers : {media : {}	}});
	}

	//----------------------------------------------//
	//news
	//----------------------------------------------//
	$('.news-container .newsList').each(function(index, element) {
		
        //replace link for more link
		var post_id = $(this).find('.title').attr('data-id');
		var post_title = $(this).find('.title').text();
		if($(this).find('.title.link').length > 0 && $(this).find('.more-link').length > 0){
			var more_link = $(this).find('.more-link');
			$(this).append('<div class="more-link" data-id="'+ post_id +'">'+$(more_link).text()+'</div>');
			$(more_link).remove();
		}else {
			$(this).find('.more-link').remove();
		}
		
		//add link
		$(this).find('.title.link').click(function() {
			openSinglePost(post_id,post_title);
		});
		$(this).find('.more-link').click(function() {
			openSinglePost(post_id,post_title);
		});
		
		// get single post 
		function openSinglePost(post_id,post_title){
			
			news.parent = divId;
			var ajax_load_date = new Date();
			hidePagePanel(news.parent,function(){
				$(this).css({'display':'none'});
				$.ajax({
					type: "GET",
					url: $('#default_url').attr('value')+'/post-single.php' + '?' + ajax_load_date.getTime(),
					timeout: 5000,
					error: postBackError,
					data: {post_id:post_id,'href':divId,post_title:post_title},
					success: postBackSuccess
				 });
				 $('#loading').addClass('active');
			});
			
			function postBackError(){
				showPagePanel(news.parent);
				$('#loading').removeClass('active');
			}
			
			function postBackSuccess(data,textStatus){
				$('#loading').removeClass('active');
				$('#content-elements').append(data);
				refreshContentPosition();
				news.child = $('#single-post-just-view');
				showPagePanel(news.child);
				//background category
				$('.news-back').children('a').click(function() {
					hidePagePanel(news.child,function(){
						removePanel('news.child');
						showPagePanel(news.parent);
					});
				});
				$('.single-post-content .scroll-pane').jScrollPane({clickOnTrack:false});
			}
		}
		
    });
	
	// ================
	// Common Function
	// ================
	
	//remove panel throught post obj params
	function removePanel(type){
		switch(type){
			case 'portfolio.subparent' :
				if(portfolio.subparent !== null) $(portfolio.subparent).remove();
				portfolio.subparent = null;
				break;
			case 'portfolio.child' :
				if(portfolio.child !== null) $(portfolio.child).remove();
				portfolio.child = null;
				break;
			case 'news.child' :
				if(news.child !== null) $(news.child).remove();
				news.child = null;
				break;
		}
	}
	
	//show panel
	function showPagePanel(elementId){
		document.title = $('nav#nav a[href="'+divId+'"]').text() + ' | ' + $('#default_title').attr('value');
		var target_top;
		if(window_width > 767){
			target_top = ($(window).height() - $('header').height() - $('footer').height())/2 + $('header').height()- 195;
			
			if($(elementId).attr('data-bg') && $(elementId).attr('data-bg') !== ""){
				 $.vegas({src:$(elementId).attr('data-bg'),fade:1500});
			}
			
			$(elementId).css({'display':'block', 'marginTop':'-260px','opacity':'0'}).delay(300).animate({opacity:1,marginTop:target_top + 'px'},{ duration: 1000, easing: "easeOutExpo",complete: function(){refreshLayerslideImage();}});
		  
		}else{
			target_top = 30;
			$(elementId).css({'display':'block', 'marginTop':'-260px','opacity':'0'}).delay(300).animate({opacity:1,marginTop:target_top + 'px'},{ duration: 1000 , easing: "easeOutExpo" ,complete: function(){refreshLayerslideImage();}} );
		}
		
		$(elementId).prevAll().css('display','none');
		$(elementId).nextAll().css('display','none');
		
		setTimeout(function(){
			menu_click = false;
			refreshLayerslideImage();
			},400);
		
		
		// fixed layerslide show issue
		refreshLayerslideImage();
		
		function refreshLayerslideImage(){
			if($.fn.layerSlider === null || $.fn.layerSlider === undefined){
				return false;
			}

			$('.newidea-layersider > div.ls-wp-container').layerSlider('stop');
			if($(elementId).find('.newidea-layersider > div.ls-wp-container').length > 0){
				$(elementId).find('.newidea-layersider > div.ls-wp-container').layerSlider('redraw');
				if($(elementId).find('.newidea-layersider > div.ls-wp-container .ls-circle-timer').length > 0 && $(elementId).find('.newidea-layersider > div.ls-wp-container .ls-circle-timer').css('display') === 'block'){
					$(elementId).find('.newidea-layersider > div.ls-wp-container').layerSlider('start');
				}
			}
			if($('.ls-container .ls-active img.ls-bg').length > 0 && ($('.ls-container .ls-active img.ls-bg').css('width') == '0px' || $('.ls-container .ls-active img.ls-bg').css('margin-top') == '0px' )) {
				$('.ls-container .ls-active img.ls-bg').css({'width':'860px','height':'360px'});
			}
		}
		
	}
	
	//hide panel
	function hidePagePanel(elementId,callback){
		menu_click = true;
		
		if(window_width <= 767){
			$('body,html').animate({ scrollTop: 0 }, 300);
			$(elementId).delay(400).animate({opacity:0, marginTop:'260px'},1000,'easeInExpo' ,callback );
		}else{
			$(elementId).animate({opacity:0, marginTop:'260px'},1000,'easeInExpo' ,callback );
		}
	}
	
	//refresh menu position
	function refreshNavMenu(){
				
		var defaultMenuWidth = $('#nav').width();
		
		if($('#navBg').attr('data-align') == '0'){
			//left
			$('#nav').css("margin-left",parseInt($('#navBg').attr('data-left')) + 'px');

		}else if($('#navBg').attr('data-align') == '1'){
			//center
			var tw = $(window).width() > parseInt($('body').css('min-width')) ? $(window).width() : parseInt($('body').css('min-width'));
			$('#nav').css("margin-left",(tw - defaultMenuWidth)/2 + parseInt($('#navBg').attr('data-left')) );
		}else{
			//right
			
			var tw2 = $(window).width() > parseInt($('body').css('min-width')) ? $(window).width() : parseInt($('body').css('min-width'));
			
			$('#nav').css("margin-left",tw2 - defaultMenuWidth + parseInt($('#navBg').attr('data-left')) );
		}
	}
	
	//refresh 
	function refreshContentPosition(){
		if(window_width <= 767){
			$('.contBg').css('margin-left',((window_width*0.06)/2 - 10) + 'px');
		}
	}
	
	function checkForm(){
		$('#contact-form').find('.success').hide();
		var str;
		str = $('#contact-name').attr('value').replace(/\s+/g,"");
        if(str.length <= 0) {
			$('#contact-form').find('.error').html("please input your name!");
			$('#submit').removeClass('active');
			$('#submit').attr('disabled','disabled');
			return false;
		}
		
		str = $('#contact-email').attr('value').replace(/\s+/g,"");
        if(str.length <= 0) {
			$('#contact-form').find('.error').html("please input your email!");
			$('#submit').removeClass('active');
			$('#submit').attr('disabled','disabled');
			return false;
		}
		
		var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
		 if(!myreg.test(str)){
			$('#contact-form').find('.error').html("please input valid email!");
			$('#submit').removeClass('active');
			$('#submit').attr('disabled','disabled');
			return false;
		 }
		
		str = $('#contact-message').val().replace(/\s+/g,"");
        if(str.length <= 0) {
			$('#contact-form').find('.error').html("please input message!");
			$('#submit').removeClass('active');
			$('#submit').attr('disabled','disabled');
			return false;
		}
		
		$('#contact-form').find('.error').html("");
		$('#submit').addClass('active');
		$('#submit').removeAttr('disabled');
	}

	// setting element position
	var select_val = '';
	var can_click = true;
	if(window_width <= 767) {
		
		refreshContentPosition();
		
		$('.menu-select .menu-select-top').click(function() {
            menuOpenClose(true);
    });
		
		$('.menu-select ul li').click(function() {
			if(menu_click || !can_click){
				return false;
			}

			can_click = false;
			
      $(this).prevAll().removeClass('active');
			$(this).nextAll().removeClass('active');
			$(this).addClass('active');
			
			select_val = $(this).attr('data-value');
			
			menuOpenClose();
        });
		
		$('.menu-select ul').children('li[data-value="'+divId+'"]').addClass('active');
		
		$('.newidea-layersider').css('zoom',((window_width*0.94)/860));
		
		$(window).resize(function(){
			if(window_width != $(window).width()){
				window.location.reload(true);
			}else{
				menuCenter();
			}
		});
		
		menuCenter();
	}
	
	function menuchangefun(){
		can_click = true;
		if(select_val === ''){
			return;
		}
		
		curr_anchor = select_val;
		
		if(select_val.indexOf('http://') == -1){
			try{
				$(divId).find('video, audio').each(function() { $(this)[0].player.pause(); });
			}catch(e){}
			
			//news showed
			if(news.child !== null){
				hidePagePanel(news.child,function() {
						removePanel('news.child');
						divId = select_val;
						showPagePanel(divId);
					});
				
			}else if(portfolio.child !== null){//portfolio List showed
				hidePagePanel(portfolio.child,function() {
						removePanel('portfolio.child');
						divId = select_val;
						showPagePanel(divId);
					});
			}else if(portfolio.subparent !== null){//portfolio List showed
				hidePagePanel(portfolio.subparent,function() {
						removePanel('portfolio.subparent');
						divId = select_val;
						showPagePanel(divId);
					});
			}else{
				hidePagePanel(divId, function() {
						$(divId).css({'display':'none'});
						divId = select_val;
						showPagePanel(divId);
					});
			}
		}else{
			window.location = select_val;
		}
	}
	
	function menuOpenClose(bool){
		if($('.menu-select ul').css('display') == 'none'){
			$('.menu-select .menu-select-top span.ms-arrow').addClass('menu-arrow-down');
			if(bool === true){
				$('.menu-select ul').slideDown(400);
			}else{
				$('.menu-select ul').slideDown(400,'',menuchangefun);
			}
		}else{
			$('.menu-select .menu-select-top span.ms-arrow').removeClass('menu-arrow-down');
			if(bool === true){
				$('.menu-select ul').slideUp(400);
			}else{
				$('.menu-select ul').slideUp(400,'',menuchangefun);
			}
		}
	}
	
	// menu center
	function menuCenter(){
		$('.menu-select .menu-select-title').css('margin-left' , ($(window).width() - $('.menu-select .menu-select-title').width())/2 +'px' );
	}
	
	// hide all page elements
	$('.contBg').css({'display':'none'});
	
	if(menu_items.length === 0){
		divId = '#' + $('#content-elements section:first').attr('id');
	}
	
	// show div
	showPagePanel(divId);
	
	// add page link use # + id
	checkElementLink('#content-elements');
	
	function checkElementLink(element){
		$(element).find('a').each(function(index, element) {
			if($('nav#nav a[href="'+ $(this).attr('href') +'"]').length > 0){
				$(this).click(function() {
					// get current link
					select_val = $(this).attr('href');

					if(window_width <= 767) {
						var select_menu = $('.menu-select ul li[data-value="'+ select_val +'"]');
						$(select_menu).prevAll().removeClass('active');
						$(select_menu).nextAll().removeClass('active');
						$(select_menu).addClass('active');
						
						menuchangefun();
					}else{
						menuClickMovePanel( $('nav#nav a[href="'+ $(this).attr('href') +'"]') );
					}
					
                });
			}
        });
	}
	
});

jQuery(window).load(function($) {
	"use strict";
	refreshNavMenu();
	function refreshNavMenu(){
		var defaultMenuWidth = jQuery('#nav').width();
		var tw = 0;
		if(jQuery('#navBg').attr('data-align') == '0'){
			//left
			jQuery('#nav').css("margin-left",parseInt(jQuery('#navBg').attr('data-left')) + 'px');
		}else if(jQuery('#navBg').attr('data-align') == '1'){
			//center
			tw = jQuery(window).width() > parseInt(jQuery('body').css('min-width')) ? jQuery(window).width() : parseInt(jQuery('body').css('min-width'));
			jQuery('#nav').css("margin-left",(tw - defaultMenuWidth)/2 + parseInt(jQuery('#navBg').attr('data-left')) );
		}else{
			//right
			tw = jQuery(window).width() > parseInt(jQuery('body').css('min-width')) ? jQuery(window).width() : parseInt(jQuery('body').css('min-width'));
			jQuery('#nav').css("margin-left",tw - defaultMenuWidth + parseInt(jQuery('#navBg').attr('data-left')) );
		}
	}
			
});