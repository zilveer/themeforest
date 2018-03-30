<?php
#-----------------------------------------
#	RT-Theme rt_setup_assistant.php
#	version: 1.0
#-----------------------------------------

#
#	Setup assitant for RT-Themes
#

class RTSetupAssistant{
	
 
	function __construct(){     
		
		//Screenshot URL
		$screenshotURL = "http://templatemints.com/theme_screenshots/rt-theme17/index.php";
		
		
		//Class For Contents
		$contents  	=  new stdClass;
		$step_count 	= 0;
		$content_count = 0; 
		
		#
		#	Step 1
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Import Dummy Contents'; 
		@$contents->step[$step_count]->single_step = 1;
		
				#
				#	Sub Titles
				#
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Import Dummy Contents';  
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					This step is optional. You can import some of the dummy contents of the demo site if you want.  <br /><br />
				
					<div class="sub_title list">Follow these steps to inport the dummy content file</div>
					<ol>						
						<li>Go Tools → Import, click WordPress  <a href="admin.php?import=wordpress">show me →</a> </li>
						<li>Click browse button and find the XML file in the "Dummy Content" folder that comes with the package you donwloaded from ThemeForest.</li>
						<li>Hit "Upload file and import" button and follow the screen instructions.</li>
					</ol> 				

					<h3>WATCH THE SCREENCAST</h3>
					<i>Please watch fullscreen with high quality (720p).</i>
					<iframe width="420" height="315" src="http://www.youtube.com/embed/MQmlux7yzfE" frameborder="0" allowfullscreen></iframe>

				';
				
			
	
		#
		#	Step 2
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Pages';
		@$contents->step[$step_count]->single_step = 1;
		
				#
				#	Sub Titles
				#
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create your pages'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					Use WordPress "Pages" to create your pages. <a href="post-new.php?post_type=page">show me →</a> <br /><br />
				
					<div class="sub_title list">Things to you should know</div>
					<ul>						
						<li>You can select a template for your page under the <b>"RT-Theme Template Options"</b> box. If you have created custom templates via <b><a href="admin.php?page=rt_template_options">Template Builder</a></b>, you can use it as your page template by selecting it from the template list under the box. <a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>  </li>
						
					</ul>
					
				';

		#
		#	Step 3
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Blog';
		
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create your posts'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					Use WordPress "Posts" to create your blog posts. <a href="post-new.php?post_type=post">show me →</a> <br /><br />
				
					<div class="sub_title list">Things to you should know</div>
					<ul>						
						<li>You can select a template for your post under the <b>"RT-Theme Template Options"</b> box. If you have created custom templates via <b><a href="admin.php?page=rt_template_options">Template Builder</a></b>, you can use it as your page template by selecting it from the template list under the box. <a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>  </li>
						<li>Upload featured image by clicking the "Set featured image" link under the "Featured Image" box.
						
						<a href="'.$screenshotURL.'?image=featured-images.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>   
						</li>						
					</ul>

					<div class="sub_title list">RT-Theme Post Format Options</div>
					<ul>						
						<li>There are six post format available to select under the "Format" box listed as options.</li>
						<li>You can find related options with your post format under the "RT-Theme Post Format Options" box.</li>
					</ul>
					
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Blog page'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 
					
					Any page can be a blog page! Also you can have multiple blog pages that shows different categories.
					Tip: If you do not need a customized layout such as a slider before than the blog posts, you can just use categories as your menu items.  
					<br /><br />
					<div class="sub_title qa">Defining a page as a Blog page</div>
					<ol>	
						<li>Add/Edit a page</li>
						<li>Select "Default Blog Template" from the "Templates" list under the <b>"RT-Theme Template Options"</b> box. <a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a></li>
					</ol>  
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customize Default Blog Template or Create one'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 										
					<ol>	
						<li>Open Template Builder and expand "Default Blog Template"</li>
						<li>Expand "Blog Posts" by clicking the plus icon on right-top corner of the module.</li>
						<li>Change the options, add or remove new modules into the template.</li>
						<li>Click save options icon on the right or "Save Options" button at the bottom of the page.</li>
					</ol>
					
					<br /> 
					If you would like to learn how create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';

		#
		#	Step 4
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Portfolio'; 
		
		
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create your portfolio items'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					Use "Porfolio" custom post types to add a new portfolio item.  <a href="post-new.php?post_type=portfolio">show me →</a> <br /><br />
				 
					<div class="sub_title list">Things to you should know</div>
					<ul>
						<li>If you want to show your portfolio items in a page, you can use page templates by adding "Portfolio Posts" module.</li>
						<li>You can find various options for the portfolio categories on <a href="admin.php?page=rt_portfolio_options">Portfolio Options</a></li>
						<li>Make sure that all your portfolio items has been assigned at least a portfolio category.   <a href="edit-tags.php?taxonomy=portfolio_categories&post_type=portfolio">manage portfolio categories →</a></li>
					</ul>
 

					<div class="sub_title qa">Q : How can I add my Portfolio categories to the main menu?</div>

					<div class="answer qa">A : Please read "How Create Navigation Menus?" </div>
				';
 
				
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Portfolio page'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					 Any page can be a portfolio page also you can use the portfolio categories in your menu. You all need to select "Default Portfolio Template" for your page under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a></li>)
					 
					 <br />
					 You are also free to create new portfolio templates that suits your needs or customize the default one via  <a href="admin.php?page=rt_template_options">Template Builder</a> 
					  
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customize Default Portfolio Template or Create one'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 										
					<ol>	
						<li>Open Template Builder and expand "Default Portfolio Template"</li>
						<li>Expand "Portfolio Posts" by clicking the plus icon on right-top corner of the module.</li>
						<li>Change the options, add or remove new modules into the template.</li>
						<li>Click save options icon on the right or "Save Options" button at the bottom of the page.</li>
					</ol>
					
					<br /> 
					If you would like to learn how create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';


		#
		#	Step 5
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Product Showcase'; 				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create your products'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					Use "Product" custom post types to add a new product.  <a href="post-new.php?post_type=products">show me →</a> <br /><br />
				 
					<div class="sub_title list">Things to you should know</div>
					<ul>						
						<li>Make sure that all your products has been assigned at least a product category.   <a href="edit-tags.php?taxonomy=product_categories&post_type=products">Manage Portfolio Categories →</a></li>
					</ul>

					<div class="sub_title qa">Q : How can I add my Product categories to the main menu?</div>

					<div class="answer qa">A : Please read "How Create Navigation Menus?" </div> 

					<div class="sub_title qa">Q : How can i change the permalinks for products?</div>
					<div class="answer qa">A : Go to <a href="admin.php?page=rt_product_options">RT-Theme Product Options</a>, edit "Category Slug" and "Single Product Slug"</div>
					 
				';


				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Product page'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					 Any page can be a product page also you can use the product categories in your menu. You all need to select "Default Product Template" for your page under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a></li>)
					 
					 <br />
					 You are also free to create new templates that suits your needs or customize the default one via  <a href="admin.php?page=rt_template_options">Template Builder</a> 
					  
				';
				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customize Default Product Template or Create one'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 										
					<ol>	
						<li>Open Template Builder and expand "Default Product Template"</li>
						<li>Expand "Product Posts" by clicking the plus icon on right-top corner of the module.</li>
						<li>Change the options, add or remove new modules into the template.</li>
						<li>Click save options icon on the right or "Save Options" button at the bottom of the page.</li>
					</ol>
					
					<br /> 
					If you would like to learn how create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';



		#
		#	Step 5
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create WooCommerce Shop'; 				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Download WooCommerce'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					You can download WooCommerce plugin at  <a href="http://wordpress.org/extend/plugins/woocommerce/" target="_new">Download →</a> <br /><br />
						
					also available on <a href="http://www.woothemes.com/woocommerce/" target="_new">WooCommerce Official Website →</a> <br /><br />					
					
					 
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Learn How To Use WooCommerce'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					 WooCommerce has rich documentation archive about the plugin. Go to <a href="http://wcdocs.woothemes.com/" target="_new">WooCommerce Documentation Website→</a>
					 
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Change WooCommerce Settings'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					 Find "WooCommerce" on the left hand side menu and click "Settings" from its sub menu.
					 
				';


				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Change RT-Theme\'s WooCommerce Options'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					 This theme offers some options for WooCommerce related contents such as "Layout", "Amount of products per page" etc. Go to <a href="admin.php?page=rt_woocommerce_options" target="">RT-Theme\'s WooCommerce Options →</a>
					 
				';


				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Read These Notes!'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Q : How can I add WooCommerce Products into my templates?</div>
	
					<div class="answer qa">A :  					

					<ol>	
						<li>Open Template Builder and expand a template that you want to add the products.</li>
						<li>Select "WooCommerce Products" from the module list.</li>
						<li>Click save options icon on the right or "Save Options" button at the bottom of the page.</li>
					</ol>
					
					<br /> 
					If you would like to learn how create a new template please read "How To Use Template Builder" section of the Setup Assistant.

					</div>
	
					<div class="sub_title qa">Q : What is the differencies between Product Showcase and WooCommerce Products?</div>
					<div class="answer qa">A : They are completely different systems. You can use default "Product Showcase" to create an orginized product calatog.  If you would like to
					sell your products online via various payment systems, you should use WooCommerce. </div>

					<div class="sub_title qa">Q : Can i move my existing products from Product Showcase to WooCommerce?</div>
					<div class="answer qa">A :  No, this is not possible. You need to create new products, categegories etc. by using the WooCommerce tools.</div>

				'; 
	

		#
		#	Step 6
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Slider';			
		
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create Slider Contents'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					In order to provide more flexibility of slider usage, we created "Slider" custom post types.
					You can create slider contents and save them and keep ready to use with any slider of the theme on any page template you want.  <a href="post-new.php?post_type=slider">show me →</a> <br /><br />
					 
					<ul>						
						<li>Go to Slider → Add New</li>
						<li>Use the fields under the "RT-THEME Slider Options" to create slide content.</li>
						<li>Upload slide image by clicking the "Set featured image" link under the "Featured Image" box.
						
						<a href="'.$screenshotURL.'?image=step_1_3_1.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot 1</a>  
						<a href="'.$screenshotURL.'?image=step_1_3_2.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot 2</a>
						<a href="'.$screenshotURL.'?image=step_1_3_3.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot 3</a>
						</li>
						
					</ul> 
				';
				
				
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Add a Slider to a Page'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					You can add a slider to any page or post you want via Template Builder by adding a Slider module.
					<br /><br />
					<div class="sub_title qa">Q : How can I add a slider to my home page?</div>

					<div class="answer qa">A : Your home page is using the "Default Home Page Template" and it already contains a slider module if you have not removed. <br />
					<ol>
						<li>Go to Template Builder → Expand the "Default Home Page Template"</li>
						<li>Expand the "Slider" module by clicking its plus icon on the right side</li>
						<li>Change the options and follow screen instructions.</li>
						<li>Click save options icon on the right or "Save Options" button at the bottom of the page.</li>
					</ol>
					</div>

					<div class="sub_title qa">Q : How can I add a slider to any page or post?</div>
					<div class="answer qa">A : Its same way to add on Home Page. You must use the Template Builder and add a slider module to your page template.</div>
					
				';



		#
		#	Step 6 -2
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Revolution Slider';			
		
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create Slider Contents'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					Revolution Slider has been embedded to the theme as 3rd Party plugin. In order to create your slides you need to use it\'s own interface. The interface is located in the left sidebar menu of the WordPress Admin panel as "<a href="padmin.php?page=revslider">Revolution Slider</a>".

 					<br /><br />
					 
					<ul>						
						<li>Go to <a href="admin.php?page=revslider">Revolution Slider</a> → click on the Create New Slider button</li>
						<li>Give your slider a name and chose a slider aliasname. Set the height of the slider then click the Create slider button.</li>
						<li>Find the slider you created in the list and click the "Edit Slides" button. </li>
						<li>Create new slides by clicking the "New Slide" button at the bottom.</li>
						<li>Add items to your slider and set their positions by dragging dropping on the preview.</li>
					</ul> 

					<h3>WATCH THE SCREENCAST</h3>
					<i>Please watch fullscreen with high quality (720p).</i>
					<iframe width="420" height="315" src="http://www.youtube.com/embed/odBffheAoyc" frameborder="0" allowfullscreen></iframe>
				';
				
				
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Add a Revolution Slider to a Page'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					You can add any slider that has been created with the revolution slider plugin to any page or post by using the Template Builder. All you need is copy the shortcode of the slider and paste it within a revolution slider module. Please follow these steps for further details.
					<br /><br />
					<div class="sub_title qa">Q : How can I add a slider to my home page?</div>

					<div class="answer qa">A : Go to "Template Builder", add a new "Revolution Slider" module, and paste the shortcode that provided by the Revolution Slider plugin. Here are the steps;<br />
					<ol>
						<li>Go to Template Builder → Expand the "Default Home Page Template"</li>
						<li>Add a new "Revolution Slider" module by selecting from the "Module List"</li>
						<li>Paste the slider-shortcode  provided to you by the Revolution Slider plugin </li>
						<li>Delete the another "slider module" if you don\'t need it.</li>
						<li>Click save options icon on the right or "Save Options" button at the bottom of the page.</li>
					</ol>
					</div>

					<div class="sub_title qa">Q : How can I find the Revolution Slider plugin\'s shortcode?</div>
					<div class="answer qa">A : Go to Revolution Slider, copy the shortcode of a slider that listed in "Shortcode" column.</div>

					<div class="sub_title qa">Q : How can I add a slider to any page or post?</div>
					<div class="answer qa">A : Its same way to add on Home Page. You must use the Template Builder and add a revolution slider module to your page template.</div>

					<h3>WATCH THE SCREENCAST</h3>
					<i>Please watch fullscreen with high quality (720p).</i>
					<iframe width="420" height="315" src="http://www.youtube.com/embed/odBffheAoyc" frameborder="0" allowfullscreen></iframe>

				';

		#
		#	Step 7
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Build Home Page';

				#
				#	Sub Titles
				#
				$content_count++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create Home Page Contents';  
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'					
					There are two ways to add a content on your home page. <br /><br />		
					 
					
					<div class="sub_title list">Using Home Page Custom Posts</div>
					
					<ul>						
						<li>We created "Home Page" custom post type to use a content with any page you want on your web site in a styled box with a featured image including your home page. <a href="edit.php?post_type=home_page">show me →</a></li>
						<li>When you create a home page post and if you have not removed the "Home Page Contents" module from the "Default Home Page Template" it will be displayed on your home page automatically.</li>
						<li>You can also select one of them and change it\'s order or column sizes by adding "Home Page Content" module into your page templates via the Template Builder.</li>
					</ul>
					
					<div class="sub_title list">Using Widgets</div>
					
					<ul>						
						<li>You can use all widgets in any page you want including your home page.</li>
						<li>Go Appearence → Widgets, drag&drop a widget into the "Widgetized Home Page Area" that you want to show on your home page.</li>
						<li>Remember, you have too many options to customize their layouts and orders or use another widget area by customizing the "Default Home Page Template" via Template Builder.</li>
					</ul>		 
				   
				'; 		 
								
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customize Your Home Page'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				
				Your home page uses "Default Home Page Template" as its template, if you have not chaged your Reading settings and not defined another page as your home page! (Settings → Reading → Front page displays)
				<br /><br />
				
					<ul>	
						<li>Open Template Builder and expand "Default Home Page Template"</li>
						<li>You will see there are some modules already added such as "Slider", "Home Page Contents" etc.</li>
						<li>You can change options of the modules or add new modules as much as you need to create the home page you desired.</li>
						<li>Click save options icon on the right or "Save Options" button at the bottom of the page.</li>
					</ul>
					
					<br /> 
					If you would like to learn how create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';



		#
		#	Step 8
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Contact Page';
		@$contents->step[$step_count]->single_step = 1;

		 
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Contact page'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					 Any page can be a contact page. You all need to select "Default Contact Page Template" for your page under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a></li>)
					 
					 <br />
					 You are also free to create new templates that suits your needs or customize the default one via  <a href="admin.php?page=rt_template_options">Template Builder</a> 
					   <br /> <br />
		 
					<div class="sub_title qa">Q : How can I customize "Default Contact Page Template" or create new one?</div>
 								
					<ol>	
						<li>Open Template Builder and expand "Default Contact Page Template"</li>
						<li>Change the options of the modules or add/remove new modules into the template.</li>
						<li>Click save options icon on the right or "Save Options" button at the bottom of the page.</li>
					</ol>
					
					<br /> 
					If you would like to learn how create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';				
				 
		#
		#	Step 8
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Use Template Builder'; 

		 
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'What is Template Builder?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<a href="admin.php?page=rt_template_options">Template Builder</a> is a built-in tool that lets you create custom page templates to use with your pages or posts.
					You are free to edit the default templates or create a new one as you wish.
				 
				';				

				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'How to use a template with a page or post?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<ol>	
						<li>Add/Edit a page or post.</li>
						<li>Select a template name you want to use for your page under the <b>"RT-Theme Template Options"</b> <a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a></li>
						<li>Update your page/post.</li>
					</ol> 					
					 
				';					 

				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'How to create a new template?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<ol>	
						<li>Go to <a href="admin.php?page=rt_template_options">Template Builder</a></li>
						<li>Expand "Create New Template" box at the bottom of the page.</li>
						<li>Type a name for the template</li>
						<li>Select a sidebar location or full width page layout</li>
						<li>Start adding modules by using the "Module List"</li>
						<li>Click "Create Template Button"</li>
					</ol>
				';

				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Watch Video Tutorials?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<ol>
						<li>You can find video tutorials about template builder inside the documentation file. </li> 
						<li>The documnetation file can be found in the /Documentation/ folder as index.html file, that comes with the theme package!</li>			
					</ol>
					

					<h3>WATCH THE SCREENCAST</h3>
					<i>Please watch fullscreen with high quality (720p).</i>
					<iframe width="420" height="315" src="http://www.youtube.com/embed/hUx328cWF64" frameborder="0" allowfullscreen></iframe>						
				';		


		#
		#	Step 9
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Navigation Menus'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				
				WordPress has a great tool to create navigation menus and this theme is using the menus as well.
				
				You must use "RT Theme Main Navigation Menu" for the main navigation and "RT Theme Footer Navigation Menu" for the footer links.
				
				<br /><br />
				
					<div class="sub_title qa">Q : Where is the WordPress Menus??</div>
					<div class="answer qa">A : Go to Appearence → <a href="nav-menus.php">Menus</a> </div>
					

					<div class="sub_title qa">Q : How can I build a main navigation menu?</div>
					<div class="answer qa">
					
						<ol>	
							<li>Click "RT Theme Main Navigation Menu" tab.  <a href="'.$screenshotURL.'?image=menus.jpg&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Click here for the screenshot</a></li>
							<li>Use the boxes on the left such as "Pages", "Posts" to add items to your menu.</li>
							<li>Select an item from the boxes and click "Add to Menu" button of the box.</li>
							<li>Drag and Move the menu item in the list.</li> 
							<li>Click "Save Menu" button.</li>
						</ol>
						
					</div>									
				 

					<div class="sub_title qa">Q : How can I add portfolio or product categories to a menu?</div>
					<div class="answer qa">
					
						<ol>	
							<li>Click "Screen Options" tab on the top of the "<a href="nav-menus.php">Menus</a>" page.</li>
							<li>Check the boxes of available cotents to make them visible on the left side as others.</li>
							
							<li><a href="'.$screenshotURL.'?image=menus-screen-tab.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Click here for the screenshot</a></li>
							
						</ol>
						
					</div> 

					<div class="sub_title qa">Q : How can I add a "Home Page" link?</div>
					<div class="answer qa">
					
						<ol>	
							<li>Use "Custom Links" box</li>
							<li>Type your home page URL in the URL field.</li>
							<li>Type "Home Page" or anything else that you want to call your home page in the "Label" field.</li>
							<li>Click "Add to Menu" button.</li> 
						</ol> 
					</div>	 
				';			 



		#
		#	Step 9
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Use Widgets'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<ol>	
				<li>Go to Appearance → <a href="widgets.php">Widgets</a> </li>
				<li>Choose a Widget and drag it to the sidebar where you wish it to appear. There are default sidebars for the theme or you can create custom one for a specific content group by using "<a href="admin.php?page=rt_sidebar_options">Sidebar Creator</a>"
				<li>To arrange the Widgets within the sidebar or Widget area, click and drag it into place.</li>
				<li>To customize the Widget features, click the down arrow in the upper right corner to expand the Widget\'s interface.</li>
				<li>To save the Widget\'s customization, click Save.</li>
				<li>To remove the Widget, click Remove or Delete.</li>
				</ol>

				<div class="sub_title qa">Q : How can I add a "Home Page" link?</div>
				<div class="answer qa">
				
					<ol>	
						<li>Use "Custom Links" box</li>
						<li>Type your home page URL in the URL field.</li>
						<li>Type "Home Page" or anything else that you want to call your home page in the "Label" field.</li>
						<li>Click "Add to Menu" button.</li> 
					</ol> 
				</div>
					
				';			 


		#
		#	Step  
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Change Backgrouds'; 				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Change background of entire website'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					Use "Background Options" from the theme options panel to control background of entire website.  <a href="admin.php?page=rt_background_options">show me →</a> <br /><br />
					 
				';


				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Change background of an individual page'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					 You can find individual background options for each page in their "Edit" sections.
					 For example if you would like to edit your "About Us" page\'s background.
					 Go to Pages → click "About Us" to edit → and scroll down to find "RT-Theme Background Options"
					  
				'; 

		#
		#	Step  
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Change Header Images'; 				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Change header of entire website'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					Use "Header Options" from the theme options panel to control header of entire website.  <a href="admin.php?page=rt_header_options">show me →</a> <br /><br />
					 
				';


				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Change header of an individual page'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 
						You can find individual header options for each page in their "Edit" sections.
						For example if you would like to edit your "About Us" page\'s header.
						Go to Pages → click "About Us" to edit → and scroll down to find "RT-Theme Header Options" 
				';

		#
		#	Step 10
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Use Shortcodes and Quick Styling Buttons'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					RT-Theme comes with some great shortcodes that allow you to add photo galleries, contact forms, tabs, etc. In order to use them, you need to edit/add posts, pages or widgets and enter the shorcodes into the content area.				
					You can find all the shortcodes and quick styling buttons on the the Visual view mode of the editor. <a href="'.$screenshotURL.'?image=shortcodes.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>					

				';			 

		#
		#	Step 10
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Add Twitter, Flickr, Recent Posts etc.'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					RT-Theme comes with built-in widgets that coded for the theme. You can find them on the <a href="widgets.php">Widgets</a> page.					
					For example; If you would like to add your recent tweets drag "[RT-Theme] Twitter" widget and drop a widget area that you want to display.
					

				';

		#
		#	Step 11
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Footer Navigation'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					Please read "How To Create Navigation Menus" section. 

				';

		#
		#	Step 12
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Use Sidebar Creator'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					This tool gives you chance to create custom sidebars (widget areas) for your web site\'s specific contents only.
					<br />
					For example: If you would like to put a Text Widget (or anyone) only for your About Us and Contact Us pages;<br />
					
					<ul>
						<li>Go to <a href="admin.php?page=rt_sidebar_options">Sidebar Creator</a></li>
						<li>Expand "Create New Sidebar" box</li>
						<li>Type a name for your custom sidebar</li>
						<li>Select the pages or other available contents you want to diplay widgets of the sidebar</li>
						<li>Click "Create Sidebar" button.</li>
					</ul>
					
					Once you created your custom sidebar you will see it in the available sidebar list on the Widgets page. 
				'; 
						  
	
	
			#
		#	Step 12
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Update Slider Revolution Plugin?'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					

					<strong>Update With help of FTP</strong>

					<ul>
					    <li>Save the CSS Settings (You can edit css in editor, or just copy it from rs-plugin/css/captions.css)</li>
					    <li>Use FTP and delete the wp-content/plugins/revslider folder</li>
					    <li>Come back the WordPree Admin Panel and refresh. There will be a notification appering top of the page that directs you to install the included version of Slider Revolution plugin.</li>
					    <li>Restore your CSS Settings You can edit css in editor, or just copy back the file you saved before to rs-plugin/css/captions.css)</li>
					</ul>
				
	
					<strong>Update only via WP</strong>

					<ul>
					    <li>Export All Sldier Settings One by One</li>
					    <li>Save your CSS Settings via Edit CSS and select all copy to Clipboard, or text file</li>
					    <li>Deactivate the Slider Plugin</li>
					    <li>Delete the Slider Plugin</li>
					    <li>Go to WordPree Admin Panel dashboard, there will be a notification appering top of the page that lets you install the included version of Slider Revolution plugin.</li>
					    <li>Import the Sliders one by one</li>
					    <li>Edit CSS File and Paste the Saved version there</li>
					</ul>


				'; 
						  
	


		echo '<div id="rt_setup_assistant">';
		
		foreach($contents->step as $key=>$value){
			 
			 #
			 #	step container
			 #
				echo '<div class="rt_step"><div class="rt_s_number">'.$contents->step[$key]->number.'</div>'.$contents->step[$key]->title.'<div class="expand plus"></div></div>';
				echo '<div class="step_contents">';
					
					
					
					$content_number = 1;
					foreach ($contents->step[$key]->contents as $contentID => $theContent) {
						if(!isset($contents->step[$key]->single_step)) echo '<div class="step_content">'.($theContent->content_title).' <span class="step_number">Step '.$content_number.' </span>  </div>';			 
						echo (!isset($contents->step[$key]->single_step))  ? '<div class="step_content_hidden">' : '<div class="step_content_hidden show">';						
						echo $theContent->content.'</div>';
						$content_number++;
					}
					
				echo '</div>'; 

		 
		}
		echo '</div>'; 
	}

}

$RTSetupAssistant = new RTSetupAssistant();

?>