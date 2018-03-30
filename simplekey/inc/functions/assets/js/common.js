/**
 * Created by ThemeVan.
 * Common Shortcode scripts.
 */
 
jQuery(document).ready(function($){
	 
	 //Toggle block
     $('.toggle .toggle_title').toggle(
	    function(){
	         if($(this).children('span').attr('class')=='off'){
			   $(this).next().slideDown();
			   $(this).children('span').attr('class','on');
			 }else{
			   $(this).next().slideUp();
			   $(this).children('span').attr('class','off');
			 }
		},
		function(){
		     if($(this).children('span').attr('class')=='off'){
			   $(this).next().slideDown();
			   $(this).children('span').attr('class','on');
			 }else{
			   $(this).next().slideUp();
			   $(this).children('span').attr('class','off');
			 }
		}
	 );
	 
	 //Tabs
	 $('.tab_box').each(function(){
	     var tabTitle = ".tab_items ul li";
		 var tabContent = '.tab_content .tab';
		 $(this).find(tabTitle + ":first").addClass("cur");
		 $(this).find(tabContent).not(":first").hide();
		 $(tabTitle).unbind("click").bind("click", function(){
			 $(this).siblings("li").removeClass("cur").end().addClass("cur");
			 var index = $(tabTitle).index( $(this) );
			 $(tabContent).eq(index).siblings(tabContent).hide().end().fadeIn("slow");
		 });
	 })
	
})