/*-----------------------------------------------------------------------------------

 	Custom JS for metabox display
 
-----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function() {

	
/*----------------------------------------------------------------------------------*/
/*	Setup pages
/*----------------------------------------------------------------------------------*/
	
	/* Always show general page meta */
	var general_page_meta = jQuery('#general_page_meta');
	general_page_meta.css('display', 'block');
	
	var sponsors_page_meta = jQuery('#sponsors_page_meta');
	sponsors_page_meta.css('display', 'none');
	
	var testimonials_page_meta = jQuery('#testimonials_page_meta');
	testimonials_page_meta.css('display', 'none');
	
	var services_page_meta = jQuery('#services_page_meta');
	services_page_meta.css('display', 'none');
	
	var faq_page_meta = jQuery('#faq_page_meta');
	faq_page_meta.css('display', 'none');
	
	var team_page_meta = jQuery('#team_page_meta');
	team_page_meta.css('display', 'none');

	var blog_page_meta = jQuery('#blog_page_meta');
	blog_page_meta.css('display', 'none');

	var portfolio_page_meta = jQuery('#portfolio_page_meta');
	portfolio_page_meta.css('display', 'none');	

	var contact_page_meta = jQuery('#contact_page_meta');
	contact_page_meta.css('display', 'none');
	
/*----------------------------------------------------------------------------------*/
/*	Setup sidebars
/*----------------------------------------------------------------------------------*/

	var pages_widget_area = jQuery('.pages-widget-area');
	pages_widget_area.css('display', 'none');
	
	var portfolio_widget_area = jQuery('.portfolio-widget-area');
	portfolio_widget_area.css('display', 'none');
	
	var contact_widget_area = jQuery('.contact-widget-area');
	contact_widget_area.css('display', 'none');
	
	/* Always show footer and posts sidebars */
	var posts_widget_area = jQuery('.posts-widget-area');
	posts_widget_area.css('display', 'block');
	
	var first_footer_widget_area = jQuery('.first-footer-widget-area');
	first_footer_widget_area.css('display', 'block');
	
	var second_footer_widget_area = jQuery('.second-footer-widget-area');
	second_footer_widget_area.css('display', 'block');
	
	var third_footer_widget_area = jQuery('.third-footer-widget-area');
	third_footer_widget_area.css('display', 'block');
	
	var fourth_footer_widget_area = jQuery('.fourth-footer-widget-area');
	fourth_footer_widget_area.css('display', 'block');
	

/*----------------------------------------------------------------------------------*/
/*	OnChange conditions
/*----------------------------------------------------------------------------------*/

	var group = jQuery('#page_template');
	
	group.change( function() {
		
		if(jQuery(this).val() == 'default') {
			pages_widget_area.css('display', 'block');
			SidebarHideAll(pages_widget_area);
		
		} else if(jQuery(this).val() == 'page-sponsors.php')  {
			sponsors_page_meta.css('display', 'block');
			tzHideAll(sponsors_page_meta);
			pages_widget_area.css('display', 'block');
			SidebarHideAll(pages_widget_area);
			
		} else if(jQuery(this).val() == 'page-team.php')  {
			team_page_meta.css('display', 'block');
			tzHideAll(team_page_meta);
			pages_widget_area.css('display', 'block');
			SidebarHideAll(pages_widget_area);
			
		} else if(jQuery(this).val() == 'page-services.php')  {
			services_page_meta.css('display', 'block');
			tzHideAll(services_page_meta);
			pages_widget_area.css('display', 'block');
			SidebarHideAll(pages_widget_area);
			
		} else if(jQuery(this).val() == 'page-faq.php')  {
			faq_page_meta.css('display', 'block');
			tzHideAll(faq_page_meta);
			pages_widget_area.css('display', 'block');
			SidebarHideAll(pages_widget_area);		
			
		} else if(jQuery(this).val() == 'page-testimonials.php')  {
			testimonials_page_meta.css('display', 'block');
			tzHideAll(testimonials_page_meta);
			pages_widget_area.css('display', 'block');
			SidebarHideAll(pages_widget_area);		
			
		} else if(jQuery(this).val() == 'page-blog.php')  {
			blog_page_meta.css('display', 'block');
			tzHideAll(blog_page_meta);
			posts_widget_area.css('display', 'block');
			SidebarHideAll(posts_widget_area);
			
		} else if(jQuery(this).val() == 'page-portfolio.php') {
			portfolio_page_meta.css('display', 'block');
			tzHideAll(portfolio_page_meta);
			portfolio_widget_area.css('display', 'block');
			SidebarHideAll(portfolio_widget_area);
		
		} else if(jQuery(this).val() == 'page-contact.php') {
			contact_page_meta.css('display', 'block');
			tzHideAll(contact_page_meta);
			contact_widget_area.css('display', 'block');
			SidebarHideAll(contact_widget_area);
			
		} else {
			sponsors_page_meta.css('display', 'none');
			testimonials_page_meta.css('display', 'none');
			team_page_meta.css('display', 'none');
			services_page_meta.css('display', 'none');
			faq_page_meta.css('display', 'none');
			blog_page_meta.css('display', 'none');
			portfolio_page_meta.css('display', 'none');
			contact_page_meta.css('display', 'none');
			
			posts_widget_area.css('display', 'none');
			pages_widget_area.css('display', 'none');
			portfolio_widget_area.css('display', 'none');
			contact_widget_area.css('display', 'none');
		}
		
	});
	
/*----------------------------------------------------------------------------------*/
/*	OnLoad conditions
/*----------------------------------------------------------------------------------*/	
	
	if (jQuery("#page_template option[value='default']").attr('selected')) 
		{ 
			pages_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}
	
	if (jQuery("#page_template option[value='page-sponsors.php']").attr('selected'))
		{ 
			sponsors_page_meta.css('display', 'block');
			pages_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}
	
	if (jQuery("#page_template option[value='page-testimonials.php']").attr('selected'))
		{ 
			testimonials_page_meta.css('display', 'block');
			pages_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}
		
	if (jQuery("#page_template option[value='page-team.php']").attr('selected'))
		{ 
			team_page_meta.css('display', 'block');
			pages_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}
	
	if (jQuery("#page_template option[value='page-services.php']").attr('selected'))
		{ 
			services_page_meta.css('display', 'block');
			pages_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}
	
	if (jQuery("#page_template option[value='page-faq.php']").attr('selected'))
		{ 
			faq_page_meta.css('display', 'block');
			pages_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}				
		
	if (jQuery("#page_template option[value='page-blog.php']").attr('selected'))
		{ 
			blog_page_meta.css('display', 'block');
			posts_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}

	
	if (jQuery("#page_template option[value='page-portfolio.php']").attr('selected')) 
		{ 
			portfolio_page_meta.css('display', 'block');
			portfolio_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}

	if (jQuery("#page_template option[value='page-contact.php']").attr('selected')) 
		{ 
			contact_page_meta.css('display', 'block');
			contact_widget_area.css('display', 'block');
			posts_widget_area.css('display', 'none');
		}
		
		
	function tzHideAll(notThisOne) {
		sponsors_page_meta.css('display', 'none');
		testimonials_page_meta.css('display', 'none');
		team_page_meta.css('display', 'none');
		services_page_meta.css('display', 'none');
		faq_page_meta.css('display', 'none');
		blog_page_meta.css('display', 'none');
		portfolio_page_meta.css('display', 'none');
		contact_page_meta.css('display', 'none');
		notThisOne.css('display', 'block');
	}
	
	function SidebarHideAll(notThisOne) {
		posts_widget_area.css('display', 'none');
		pages_widget_area.css('display', 'none');
		portfolio_widget_area.css('display', 'none');
		contact_widget_area.css('display', 'none');
		notThisOne.css('display', 'block');
	}

});