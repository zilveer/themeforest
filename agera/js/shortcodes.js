/*-----------------------------------------------------------------------------------*/
/*	jQuery for MassivePixelCreation custom shortcodes
/*	version 1.0
/*-----------------------------------------------------------------------------------*/

jQuery(function($){
	$(document).ready(function(){
		/* Toggle Handler */
		$(".toggle-content").hide();
		$("div.toggle-header").click(function(){
			$(this).toggleClass("active").next().slideToggle();
			return false;
		});
		/* End Toggle Handler */

		/* Tabs Handler */
		$('div.tabs div.tab_content, div.tabs-ext div.tab_content ').hide();
		$('div.tabs div.tab_content:first, div.tabs-ext div.tab_content:first').fadeIn(); // Show the first div
		$('div.tabs ul li:first, div.tabs-ext ul li:first').addClass('active'); // Set the class of the first link to active

		$('div.tabs ul li a, div.tabs-ext ul li a').click(function(e) {
			var $this = $(this);
			$('div.tabs ul li, div.tabs-ext ul li').removeClass('active'); // Remove active class from all links
			$this.parent().addClass('active'); //Set clicked link class to active
			var currentTab = $this.attr('href'); // Set variable currentTab to value of href attribute of clicked link
			$('div.tabs div, div.tabs-ext div').hide(); // Hide all divs
			$(currentTab).fadeIn(); // Show div with id equal to variable currentTab
			e.preventDefault();
		});
		/* End Tabs Handler */
	});
});

/*------------------------------------ The End ------------------------------------- */