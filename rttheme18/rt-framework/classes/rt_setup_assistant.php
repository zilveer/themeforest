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
		$screenshotURL = "http://templatemints.com/theme_screenshots/rt-theme18/index.php";
		
		
		//Class For Contents
		$contents  	=  new stdClass;
		$step_count 	= 0;
		$content_count = 0; 
		
		#
		#	Step 1
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Import Sample Content'; 
		@$contents->step[$step_count]->single_step = 1;
		
				#
				#	Sub Titles
				#
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Import Sample Content';  
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Importing Sample Content in RT-Theme-18.</div>
					<strong>This step is optional</strong>. We created some sample content for you and which you can import by the use of the wordpress import system. The sample content is a excerpt of some of the content and examples used in the demo website of RTTheme 18.  
					<br /><br /><strong>Note</strong> : Not all content of the demo is within the sample-content. In the sample content are examples that get you started on how to setup, use and build a website with RTTheme 18.
					<br /><br /><strong>Note</strong> : The sample content does not have any copyright protected material or images which are used in the demo of RTTheme 18. We are not allowed to do so or supply copies of these images.<br /><br />
				
					<div class="sub_title qa">Below are the steps needed to import the sample content file. <br /><br /><strong>Note</strong> : the <a href="http://wordpress.org/plugins/wordpress-importer/" target="_blank">wordpress import plugin</a> needs to be installed and activated. You also need to know where the sample-content xml file is located that comes with the theme (downloaded from Themeforest)</div>
					<ol>						
						<li>Go Tools → Import, click WordPress  <a href="admin.php?import=wordpress">show me →</a> </li>
						<li>Click browse button and find the XML file on your computer. It is located in the "Sample Content" folder that becomes available in one of the subfolders after unpacking the RT-Theme 18 zipfile downloaded from ThemeForest.</li>
						<li>Hit "Upload file and import" button and follow the screen instructions.</li>
						<li>Make sure to reassign the posts which you are about to import to the correct Admin or Author name.</li>
						<li>Make sure to check "Download and import file attachments" checkbox</li>
					</ol> 				

					<h3>WATCH THE IMPORT DEMO-CONTENT SCREENCAST</h3>
					<i>Please watch this fullscreen with high quality (720p) on how to import the sample content. <strong><br />Note</strong> : De video comes without audio support !</i>
					<iframe width="420" height="315" src="http://www.youtube.com/embed/K-PCAXVFzdU" frameborder="0" allowfullscreen></iframe>

				';
				
			
	
		#
		#	Step 2
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Website Pages';
		@$contents->step[$step_count]->single_step = 1;
		
				#
				#	Sub Titles
				#
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create your pages'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Creating Website Pages in RT-Theme-18.</div>
					Use the WordPress "Pages" section to create your website pages. <a href="post-new.php?post_type=page">show me →</a> <br /><br />
				
					<div class="sub_title qa">Things you should know and be aware of : </div>
					<ul>
						<li>Any page can have a featured image and a default template (left- right sidebar, fullwidth) or a custom template (which can be created in the theme template builder). </li>
						<li>The Template Builder is the core power (the engine) of this theme as in the Template you can visually design the look of the page and it&#39;s content. 
						This is done by adding, dragging and dropping available modules into the (created/existing) Template container and setting the available options of each module. <br /> <br />
						F.e. : a slider module can be added in which you can select & add the images to be shown in the slider. In the settings of the module you can set transitions and the timings, the titles and subtitles. <br /><br />
						Each module you add to the template in the template builder has it&#39;s own  different settings to control the behaviour of the module in the page (the frontside of your website, the endresult). </li>
						<li>Any template created can be selected and assigned to your page under the <b>"RT-Theme Template Options"</b> box. The created templates are listed via <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b>. 
						You can select and set it as your page template by choosing it from the presented dropdown list in the page. <a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>  </li>
						<li>A template can have any of the available modules, but you can only enable pagination once. So it is not allowed to have a bloglist module with pagination and a portfolio module with pagination.</li>
						<li>Modules are predefined pieces of code which present data in the front of your website following the settings one has set. So you are in control of what is shown depending on the available settings in each module.</li>
						<li>A Codebox module is available for adding your own custom code at the location of your choice to the template</li>
						<li>A sidebar can be assigned to a page in the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b>. 
						A custom sidebar container can be created in the <b><a href="admin.php?page=rt_sidebar_options">RT-Theme Sidebar Creator</a></b>. <br /><br />
						In RT-Theme 18 sidebars can be assigned to each row in the template builder (<strong>New Feature !</strong>). 
						This means that every row you add to a template can have a different sidebar, but this also means that it can have a different sidebar and a different layout per row (left-, right sidebar or fullwidth). <br /><br /> 
						Because of this feature the abilties are almost endless and will get your head spinning, but once you understand the logic you will embrace the unlimited abilities.</li>
						<li>The actual content of the (custom) sidebar can be set in the <b><a href="/wp-admin/widgets.php" target="_blank">wordpress → appearance → widgets section</a></b>.</li>
					</ul>
					
				';

		#
		#	Step 3
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create a Blog';
		
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create your posts'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Creating a Blog with RT-Theme-18.</div>
					Use WordPress "Posts" to create your blog posts. <a href="post-new.php?post_type=post">show me →</a> <br /><br />
				
					<div class="sub_title qa">Things to you should know</div>
					<ul>						
						<li>Any Post can have a featured image, a gallery of images, a video file, a audio file and a template (which can be created in the theme template builder). The Template Builder is the power (the engine) of this theme as in the Template you can visually design the layout of the post and the content. This is done by adding, dragging and dropping the available boxes into the Template and setting the available options of each box. F.e. A slider box in which you can add the images to be shown in the slider, but also the transition and the timings, the titles and subtitles. Each box you add to the template has settings to control the behaviour of the box in the page. </li>
						<li>You can select only template for your post under the <b>"RT-Theme Template Options"</b> box if you have created one or more custom templates via <b><a href="admin.php?page=rt_template_options">Template Builder</a></b>. You can set it as your post template by selecting it from the template list under the box.</li>
						<li>Upload a featured image by clicking the "Set featured image" link under the "Featured Image" box. 
						</li>						
						<li>A similar way the Gallery images can be attached to the post by pressing the "Add New Images" link/button in the Image Gallery box.</li>
						<li>A Post has a format option. Depending on which post format is chosen more settings become available which need to be set. The options each have help support textfields explaining what extra setting needs to be supplied. The chosen post format determines how the post should behave at the front of your website.</li>
						<li>A sidebar for the post can be set in the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b>. A custom sidebar container can be created in the <b><a href="admin.php?page=rt_sidebar_options">RT-Theme Sidebar Creator</a></b> and assigned to pages.</li>
						<li>The actual content of the (custom) sidebar can be set in the <b><a href="/wp-admin/widgets.php" target="_blank">wordpress → appearance → widgets section</a></b>.</li>
					</ul>

					<div class="sub_title qa">RT-Theme Post Format Options</div>
					<ul>						
						<li>There are six post format available to select at the "Post Format" options :<br /><br />
							<ol>
						       <li><strong>Standard</strong> : The attached featured image is shown,</li>
							   <li><strong>Gallery</strong> : Display Image(s) as gallery or slider,</li>
							   <li><strong>Link</strong> : Tell something about a subject of choice and add a (outside) link to the post,</li>
							   <li><strong>Video</strong> : Show and Play a Video,</li>
							   <li><strong>Audio</strong> : Show and Play a Audio file,</li>
							   <li><strong>Aside</strong> : The Post item is listed in the blog list but cannot be opened in a single post.</li>
							</ol>
						</li>
						<li>Once a post format has been selected new options that needs to be set for that post format become available in the post below the post format option setting.</li>
					</ul>
					
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Blog Listing Page'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 
					<div class="sub_title qa">Setting a Blog Listing Page in RT-Theme-18.</div>
					Any page can be set as your Blog Listing Page. You can create multiple Blog Listing Pages each showing a list of posts from different categories by the use of different Templates containing a Blog Box which has been set to list that category only.<br /><br />
					<div class="sub_title qa"><strong>Note</strong> : Do not assign a Blog listing Template to a blog post, because when you try to open the single post it will show you a blog list. When you still want do so, make sure the Blog Template also contains the default Content Box so that it shows the Default Post Content besides, above or below the Blog List</div>
					<br />Tip: If you do not need a customized layout by a  Blog Template with f.e. a slider above the Blog Posts Listing then you can just decide to add the Wordpress Blog Categories to your Wordpress Menu Container.  
					<br /><br />
					<div class="sub_title qa">Defining a page as a Blog Listing Page</div>
					<ol>	
						<li>Add/Edit a page</li>
						<li>Select "Default Blog Template" or Any Other Blog Template you have created from the "Templates" list under the <b>"RT-Theme Template Options"</b> box. <a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a></li>
						<li>Save the page, Add the page to the menu system and view the result.</li>
					</ol>  
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customizing Your Blog Template or Create a New One'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 	
					<div class="sub_title qa">Customizing the Default Blog Template in RT-Theme-18.</div>
					<ol>	
						<li>Open <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> and click on the edit button of your "Default Blog Template" or Click on the "Create New Template" Button to create a complete New Template.</li>
						<li>If you create a new Template make sure you set the Template name to something that makes sense so once you actually select the Template in a page you know what the Template is about and what it does.</li>
						<li>In the top Click on Select Module and from the dropdown list that appears select the Module "Blog Posts". Once selected hit the "Add Module" button on the right of the selected box. The Blog Post Module will open and allow you to set various settings. Once done with the settings hit the [X] Button in the top right corner of the Blog Post Module. The module is now finally added and shown in the Template.</li>
						<li>You can drag the Blog Post Module around and drop it in another (column) container to make it smaller and not full width. You can also click on the pencil icon, which becomes visible while hovering the module, to alter the settings of the Blog Box Module.</li>
						<li>Once done changing the options, add or remove new modules into the template by repeating previous steps.</li>
						<li>Click the "Save Template" Button on the top right of the Template Container you are building to Save the Template. If you try to close the Template without saving it first you will get a warning message. Ignoring that message will not save your Template or modifications you just made to it.</li>
					</ol>
					If you would like to learn more on how to create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';

		#
		#	Step 4
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create a Portfolio'; 
		
		
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create your Portfolio Items'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Creating a Portfolio in RT-Theme-18.</div>
					Use the "Porfolio" Custom Posttype to add Portfolio items.  <a href="post-new.php?post_type=portfolio">show me →</a> <br /><br />
					
					<div class="sub_title qa">Portfolio Formats type:</div>
					A portfolio item can have different formats and can be set to the type : <br /></br />
					<ol>
					<li><strong>Image</strong> : Display Image(s) as gallery or slider,</li>
					<li><strong>Video</strong> : Show and Play a Video,</li>
					<li><strong>Audio</strong> : Show and Play a Audio file.</li>
					</ol><div class="sub_title qa"><strong>Note : </strong>A placeholder image can be attached for the video and audio item so that a image is shown before the video or audio is started.</div>
				 
					<div class="sub_title qa">Things you should be aware of using portfolio items</div>
					<ul>
						<li>If you want to show a list of portfolio items in a page, you should create a Template in the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> and add the "Portfolio" module to that template or use the available default Portfolio template.</li>
						<li>The template must be assigned to a page in order to list the portfolio items</li>
						<li>You can create as many Portfolio listing pages as you want each using its own template</li>
						<li>The template portfolio module determines by its settings what portfolio items are listed</li>
						<li>You can set various settings for the Portfolio Categories on <a href="admin.php?page=rt_portfolio_options">Portfolio Options</a></li>
						<li>Opening or calling a Portfolio category will list all portfolio items attached to that category following the default theme portfolio settings</li>
						<li>Portfolio Categories can be added to the default Wordpress menu system</li>
						<li>Make sure that all your Portfolio items have been assigned to at least one portfolio category.   <a href="edit-tags.php?taxonomy=portfolio_categories&post_type=portfolio">manage portfolio categories →</a></li>
						<li>A Portfolio item can have more then one image attached to it. Default the attached images will be shown in a slider. It can be changed to type gallery in which case a image gallery is shown.</li>
					</ul>
					<div class="sub_title qa">Using the Wordpress Default Featured Image</div>
					<strong>Note</strong> : Setting the Default Wordpress Featured Image. In RT-Theme 18 the ability has been enabled to set and use the Wordpress Default Featured Image for the portfolio custom posttype. 
					<br /><br />If the Default Wordpress Featured Image has been set then : <br /><br />
					<ul>
						<li>The Default Wordpress Featured Image will show as first image in the Portfolio gallery if more images are attached to the portfolio item.</li>
						<li>The Default Wordpress Featured Image will be used in the portfolio listing pages.</li>
						<li>The Default Wordpress Featured Image will be the first image used in the single portfolio page</li>
						<li>The Default Wordpress Featured Image has priority above any other added image.</li>
					</ul>
					<strong>Note</strong> : If no featured image has been set, but one has decided to use the theme gallery image function, the first image added to that gallery will be used as the listing or single page image anywhere that portfolio item is called.<br /><br />
 
					<div class="sub_title qa">Q : How can I add my Portfolio categories to the main menu?</div>
					<div class="answer qa">A : Please read the further down below tutorial on "How Create Navigation Menus?"</div>

					<div class="sub_title qa">Q : How can i change the permalinks for Portfolios?</div>
					<div class="answer qa">A : Go to <a href="admin.php?page=rt_portfolio_options">RT-Theme Portfolio Options</a>, edit "Category Slug" and "Single Portfolio Slug"</div>					
					
				';
 
				
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Portfolio page'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					
					<div class="sub_title qa">Setting a Portfolio Listing Page in RT-Theme-18.</div>
					 Any page can be a Portfolio Listing page once you assign a Portfolio Template (default or a self created one) to that page. It will list the portfolio items as set in the Portfolio Module in that Template.<br /><br /> 
					 You can also call the Portfolio Categories directly and list portfolio items attached to that category. Categories can be added directly to the Wordpress menu system. Category Listing pages will follow the settings as set in the <a href="admin.php?page=rt_portfolio_options">RT-Theme Portfolio Options</a><br /><br /> 
					 For setting up a Portfolio Listing page all you need to do is to select "Default Portfolio Template" for your page under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)<br /><br />
					 <div class="sub_title qa"><strong>Note : </strong>Of course you can also select and assign your own created Portfolio Template to any page.</div>
					 You are free to create as many Portfolio Templates as you like to list any number of Portfolio Items or (of course) adjust the default Portfolio Template that comes with the theme via the <a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a> 
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customize the Default Portfolio Template or Create one'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 		
					<div class="sub_title qa">Customizing the Default Portfolio Template in RT-Theme-18.</div>
					<ol>	
						<li>Open <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> and click on the edit button of your "Default Portfolio Template" or Click on the "Create New Template" Button to create a complete New Template.</li>
						<li>If you create a new Template make sure you set the Template name to something that makes sense so once you actually select the Template in a page you know what the Template is about and what it does.</li>
						<li>In the top Click on Select Module and from the dropdown list that appears select the Module "Portfolio". Once selected hit the "Add Module" button on the right of the selected box. The Portfolio Module will open and allow you to set various settings. Once done with the settings hit the [X] Button in the top right corner of the Portfolio Module. The module is now finally added and shown in the Template.</li>
						<li>You can drag the Portfolio Module around and drop it in another (column) container to make it smaller and not full width. You can also click on the pencil icon, which becomes visible while hovering the module, to alter the settings of the Portfolio Module.</li>
						<li>Once done changing the options, add or remove new modules into the template by repeating previous steps.</li>
						<li>Click the "Save Template" Button on the top right of the Template Container you are building to Save the Template. If you try to close the Template without saving it first you will get a warning message. Ignoring that message will not save your Template or modifications you just made to it.</li>
					</ol>
					If you would like to learn more on how to create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';


		#
		#	Step 5
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create a Product Showcase'; 				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create your Products'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				
					<div class="sub_title qa">Creating a Product Showcase in RT-Theme-18.</div>
					Use the "Product" Custom Post Types to add Products.  <a href="post-new.php?post_type=products">show me →</a> <br /><br />
				 
					<div class="sub_title qa">Things you should be aware of using Products</div>
					<ul>						
						<li>Make sure that all your products has been assigned at least a product category.   <a href="edit-tags.php?taxonomy=product_categories&post_type=products">Manage Portfolio Categories →</a></li>
						<li>A Product can have more then one Gallery image attached to it. The moment more then one (1) image is added to the product they will be shown as a gallery in the single product page.</li>
						<li>A Product can have a Short description. The short description will be shown in : <br /><br />
						    <ol>
								<li>The Single Product page on the right side of the product image or slider below the product price.</li>
								<li>The Product Listing Pages</li> 
								<li>Product Category Listing Pages</li>
							</ol>
						</li>
						<li>You can select and add products to be listed as related products to any product. They will appear below the single product content or in a tab when tabbed layout is activated.</li>
						<li>To each product multiple attachments can be added. Per attachment one can set :<br /><br />
							<ol>
								<li>The Title or Filename,</li>
								<li>The Url to the attachment,</li>
								<li>The Target.</li>
							</ol>
						 </li>
						 <li>Products can have a normal layout or a Tabbed layout. Each product can have one to four tabs with any information of choice. They are called Free Tabs. The moment one or more Free Tabs are used the complete single product page changes to a tabbed layout. <br /><br />
							<ol>
								<li>The normal product information content goes into a tab called "General Details"</li>
								<li>The Attachments go into a tab called "Attachments"</li>
								<li>The Related Products go into a Tab called "Related Products"</li>
								<li>The Comments go into a tab called "Comments"</li>
								<li>The Free Tabs of which each one is shown with its own title and (valid html) content.</li>
								<li><div class="sub_title qa"><strong>Note</strong> : The titles of the <strong>default product tabs</strong> (not the free tabs) can be changed by the use of the default language file that comes with the theme.</div></li>
							</ol>
						</li>
					</ul>

					<div class="sub_title qa">Using the Wordpress Default Featured Image</div>
					<strong>Note</strong> : Setting the Default Wordpress Featured Image. In RT-Theme 18 the ability has been enabled to set and use the Wordpress Default Featured Image for the products custom posttype. 
					<br /><br />If the Default Wordpress Featured Image has been set then : <br /><br />
					<ul>
						<li>The Default Wordpress Featured Image will show as first image in the Product gallery if more images are attached to the single product item.</li>
						<li>The Default Wordpress Featured Image will be used in the product listing pages.</li>
						<li>The Default Wordpress Featured Image will be the first image used in the single product page</li>
						<li>The Default Wordpress Featured Image has priority above any other added image.</li>
					</ul>
					<strong>Note</strong> : If no featured image has been set, but one has decided to use the theme gallery image function, the first image added to that gallery will be used as the listing or single page image anywhere that product item is called.<br /><br />
 					
					
					<div class="sub_title qa">Q : How can I add my Product categories to the main menu?</div>

					<div class="answer qa">A : Please read the further down below tutorial on "How Create Navigation Menus?"</div> 

					<div class="sub_title qa">Q : How can i change the permalinks for products?</div>
					<div class="answer qa">A : Go to <a href="admin.php?page=rt_product_options">RT-Theme Product Options</a>, edit "Category Slug" and "Single Product Slug"</div>
					 
				';


				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Product Page'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Setting a Page as your Product Listing Page in RT-Theme-18.</div>
					 Any page can be a Product Listing page once you assign a Product Template to that page. It will list the Products form the category as set in the Product Module of that Template.<br /><br /> 
					 You can also call the Product Categories directly and list Products attached to that category. Categories can be added directly to the Wordpress menu system. Category Listing pages will follow the settings as set in the <a href="admin.php?page=rt_product_options">RT-Theme Product Options</a> <br /><br /> 
					 For setting up a Product Listing page all you need to do is to select a "Template" for your page (that has the product module attached to its content) under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)<br /><br />
					 <div class="sub_title qa"><strong>Note : </strong>Of course you can also select and assign your own created Product Template to any page.</div>
					 You are free to create as many Product Templates as you like to list any number of Products via the <a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a> 
					<br /> 
					If you would like to learn more on how to create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';
				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customize Default Product Template or Create one'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 	
					<div class="sub_title qa">Customizing the Default Product Showcase Template in RT-Theme-18.</div>
					<ol>	
						<li>Open <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> and click on the edit button of your "Default Product Showcase Template" or Click on the "Create New Template" Button to create a complete New Template.</li>
						<li>If you create a new Template make sure you set the Template name to something that makes sense so once you actually select the Template in a page you know what the Template is about and what it does.</li>
						<li>In the top Click on Select Module and from the dropdown list that appears select the Module "Product". Once selected hit the "Add Module" button on the right of the selected box. The Product Module will open and allow you to set various settings. Once done with the settings hit the [X] Button in the top right corner of the Product Module. The module is now finally added and shown in the Template.</li>
						<li>You can drag the Product Module around and drop it in another (column) container to make it smaller and not full width. You can also click on the pencil icon, which becomes visible while hovering the module, to alter the settings of the Product Module.</li>
						<li>Once done changing the options, add or remove new modules into the template by repeating previous steps.</li>
						<li>Click the "Save Template" Button on the top right of the Template Container you are building to Save the Template. If you try to close the Template without saving it first you will get a warning message. Ignoring that message will not save your Template or modifications you just made to it.</li>
					</ol>
					If you would like to learn more on how to create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';
		#
		#	Step 6
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create a Testimonial Showcase'; 				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create Testimonials'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Creating Testimonials in RT-Theme-18.</div>
					Testimonials can be used to show your client&#39;s remarks about anything they commented on. You can have them shown in any part of your website. The attached featured image is shown as a (rounded) thumbnail image of the person or company-logo beside the testimonial text. 
					Testimonial items can be listed and called : <br /><br />
					<ol>
						<li>In the template builder by adding a testimonial box,</li>
						<li>Directly in a page by the use of the testimonial shortcode.</li>
					</ol>
					
					Use the "Testimonial" Custom Post Type to add a new Testimonial.  <a href="post-new.php?post_type=testimonial">show me →</a> <br /><br />
					Testimonials can be shown : <br /><br />
					<ol>
						<li>A list of individual Testimonial Items,</li>
						<li>As a repeating carousel.</li>
					</ol>		
					<div class="sub_title qa">Things you should know about Testimonials</div>
					<ul>						
						<li>Testimonials dont have categories.</li>
						<li>Calling a Testimonial has do be done by it&#39;s id.</li>
						<li>the testimonial text allows valid HTML code (h-tags, a-tags, divs), but we advice to keep the formatting as simple as possible.</li>
						<li>For each Testimonial Item one can add : <br /><br />
							<ol>
								<li>A Name of the person who wrote the Testimonial</li>
								<li>A Jobtitle of the person who wrote the Testimonial</li>
								<li>A (valid) URL to that persons website or social page</li>
							</ol>
						</li>
					</ul>

				';


				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Testimonial Page'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				
					<div class="sub_title qa">Showing your Testimonials in RT-Theme-18.</div>
					 Any page can be a Testimonial page once you assign a Template to that page that has the Testimonial module attached to it&#39;s content. It will list the Testimonials as set in the Testimonial (carousel) Module of that Template.<br /><br /> 
					 For setting up a Testimonial page all you need to do is to select a "Template" for your page under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)<br /><br />
					 You are free to create as many Templates as you like to list any number of Testimonials via the <a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a> <br /><br />
					 <div class="sub_title qa"><strong>Note : </strong>You can add a testimonial (carousel) Module to any Template, Blog, Product, Portfolio, etc. At the location in that template where the testimonial module is added it will list the selected Testimonials Items.</div>
				';
				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customize or Create a Testimonial Template'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 
				<div class="sub_title qa">Creating / Customizing the Default  Testimonial Template in RT-Theme-18.</div>
				<strong>Note : </strong>Templates are mostly not created for showing Testimonials Items. One could beter add Testimonials Items to existing templates or by shortcode to pages, products items, portfolio items or blog posts to list what people say about that specific subject, product or portfolio item.
				But if you want to create a Testimonial template then this is the way to do this.<br /><br />
					<ol>	
						<li>Open <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> and click on the edit button of your "Default Testimonial Template" or Click on the "Create New Template" Button to create a complete New Template.</li>
						<li>If you create a new Template make sure you set the Template name to something that makes sense so once you actually select the Template in a page you know what the Template is about and what it does.</li>
						<li>In the top Click on Select Module and from the dropdown list that appears select the Module "Testimonial" or "Testimonial Carousel". Once selected hit the "Add Module" button on the right of the selected box. The Module will open and allow you to set various settings. Once done with the settings hit the [X] Button in the top right corner of the Module. The module is now finally added and shown in the Template.</li>
						<li>You can drag the Testimonial Module around and drop it in another (column) container to make it smaller and not full width. You can also click on the pencil icon, which becomes visible while hovering the module, to alter / change the settings of the Module.</li>
						<li>Once done changing the options, add or remove new modules into the template by repeating previous steps.</li>
						<li>Click the "Save Template" Button on the top right of the Template Container you are building to Save the Template. If you try to close the Template without saving it first you will get a warning message. Ignoring that message will not save your Template or modifications you just made to it.</li>
					</ol>
					If you would like to learn more on how to create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';


		#
		#	Step 7
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Team / Staff Memberlist'; 				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create Team/Staff Members'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Creating Team / Staff Members in RT-Theme-18.</div>
					Team / Staff member items can be used to show your complete team or individual or selected member(s) and their complete details, including all their contact and social information, 
					on any location within a page in your website. Attach a featured image to show a image of the member with his details. <br /><br />
					Team / Staff members can be listed and called : <br /><br />
					1) In the template builder by adding a Team/Staff box,<br />
					2) Directly in a page by the use of the Team/Staff shortcode.<br /><br />
					<strong>Note : </strong>The attached featured image can be shown in 3 different styles which can be selected and set in the template builder module or shortcode when calling the team member(s). <br /><br /> 
					
					Use the "Team / Staff" Custom Post Type to add a new members : <a href="post-new.php?post_type=staff">show me →</a> <br /><br />

					<div class="sub_title qa">Things you should know about Team / Staff Members</div>
					<ul>						
						<li>Team Staff Members dont have categories.</li>
						<li>Calling a Team / Staff members has do be done by it&#39;s id.</li>
						<li>The Team / Staff body except (short info) allows valid HTML code (h-tags, a-tags, divs), but we suggest you keep this as simple as possible</li>
						<li>The Team / Staff member post page supports layouts (left-, right sidebar, full width).</li>
						<li>For each Team / Staff Member item one can add : <br /><br />
							<ol>
								<li>A Short info box for the listing pages. A small excerpt.</li>
								<li>40+ links to social pages all supported with a icon</li>
								<li>A complete 	&#34;story	&#34; about the person into the body content of the members item post. Any valid html, shortcode is allowed.</li>
							</ol>
						</li>
					</ul>

				';


				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Team / Staff listing page'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Showing Team / Staff Members in RT-Theme-18.</div>
					 Any page can be a Member Listing page once you assign a Template to that page that has the Team / Staff member module attached to it&#39;s content. It will list the Team Members as set in the Team / Staff Module in that Template.<br /><br /> 
					 For setting up a Members listing page all you need to do is to select a "Template", containing the Team / Staff member module, for your page under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>). <br /><br />
					 The listed member items will be presented in a layout (columns) as set in the mdule settings. Clicking on a member will open the Team members single single post page displaying more detailed information about the team member.<br /><br />
					 You are free to create as many Templates as you like to list any number of Members via the <a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a> <br /><br />
					 <div class="sub_title qa"><strong>Note : </strong>You can add a Team / Staff member Module to any Template, Blog, Product, Portfolio, etc. At the location in that template where the module is added it will list the selected member Items.</div>
					  
				';
				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Customize or Create a Team / Staff Template'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				' 
				<div class="sub_title qa">Creating or Customizing The Default Team / Staff Template in RT-Theme-18.</div>
				<strong>Note : </strong>Templates are mostly not created for showing Team Members Items Only, but it can be done this way as there is no restiction not todo so. 
				One can add Team / Staff member items to existing Templates or by shortcode to pages, products items, portfolio items or blog posts to list f.e. one or more members details below the actual story in that page or post or portfolio item.
				Steps to create a Team / Staff Members Template : <br /><br />
					<ol>	
						<li>Open <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> and click on the edit button of your "Default Team / Staff Template" or Click on the "Create New Template" Button to create a complete New Template.</li>
						<li>If you create a new Template make sure you set the Template name to something that makes sense so once you actually select the Template in a page you know what the Template is about and what it does.</li>
						<li>In the top Click on Select Module and from the dropdown list that appears select the Module "Team/Staff List". Once selected hit the "Add Module" button on the right of the selected box. The Module will open and allow you to set various settings. Once done with the settings hit the [X] Button in the top right corner of the Module. The module is now finally added and shown in the Template.</li>
						<li>You can drag the Team / Staff Module around and drop it in another (column) container to make it smaller and not full width You can also click on the pencil icon, which becomes visible while hovering the module, to alter / change the settings of the Module.</li>
						<li>Once done changing the options, add or remove new modules into the template by repeating previous steps.</li>
						<li>Click the "Save Template" Button on the top right of the Template Container you are building to Save the Template. If you try to close the Template without saving it first you will get a warning message. Ignoring that message will not save your Template or modifications you just made to it.</li>
						<li><strong>Note : </strong>the module already has column support, so if you drop it into another column container make sure to set the module columns to a acceptable value otherwise it might get to small while viewing. </li>
					</ol>
					If you would like to learn more on how to create a new template please read "How To Use Template Builder" section of the Setup Assistant.
				';
		#
		#	Step 9
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Sliders & Carousels in RT-Theme 18';			
		
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= '3 Sliders types & 4 Carousels in RT-Theme-18.'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">There are 3 Sliders in RT-Theme-18.</div><br />	
					The RT-Theme18 comes with 3 sliders which can be added within the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> by the use of one of the available slider modules. The 3 slider types are : <br/><br />
					<ol>
					<li>The fully integrated Flex Slider</li>
					<li>The Revolution slider, integrated as a plugin</li>
					<li>The LayerSlider, integrated as a plugin</li>
					</ol>
					
					The RT-Theme18 comes also with 4 carousel sliders which can be added by shortcode or within the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> by the use of one of the available carousel modules. The 4 carousel types are : <br/><br />
					<ul>
					<li>The Blog Carousel</li>
					<li>The Product Carousel</li>
					<li>The Portfolio Carousel</li>
					<li>The Testimonial Carousel</li>					
					</ul>
					
					
					The way to add a slider or carousel to a page : <br /><br />
					<ol>
					<li>Open up the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> and create or edit a template.</li>
					<li>In the template add one of the available slider modules to the header area container.</li>
					<li>Or add a (new) row module and add one of the available slider modules into the row area. <strong>Note</strong> : The row can be set to full width <strong>(new feature)</strong> to make the slider show/appear all across the page width.</li>
					<li>In any template add one of the available carousel modules in any of the row module containers (or create a new row module). You can even add a carousel to the header area container is allowed.</li>
					</ol>

					<div class="sub_title qa">Important Note :</div>
					To add a Flex slider to a page the slider module in the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> has to be used!. In RT-Theme-18 the default Flex slider is no longer available by a custom post type. So it is not possible to add that slider by shortcode or by selecting the slider items directly by their id&#39;s. <br /><br />
					
					The LayerSlider and Revolution slider can be added anywhere in the (normal) content area#&39;s as those sliders have their own custom post type and code to insert the slider by shortcode anywhere within the website normal content area&#39;s.
				';
				
				
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'The Flex Slider Module'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">The Flex Slider in RT-Theme-18.</div><br />	
					The Flex Slider can be added to  any page at any location by the use of the Slider module in the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b>. The slider module comes with a lot of settings such as :<br /><br />
					
					<div class="sub_title qa">Global settings for all slider items per slider module</div>	
					<ul>
						<li>The transition speed.</li>
						<li>The transition effect</li>
						<li>Resizing and cropping of the images</li>
						<li>Image height and width in pixels</li>
					</ul>
					
					<div class="sub_title qa">Individual settings for all slider item</div>	
					<ul>
						<li>Slider Item Title</li>
						<li>Slider Item Text Area content</li>
						<li>Slider item image</li>
						<li>Slider item linking</li>
						<li>Slider item Title & text position</li>
						<li>Slider Item Image width</li>
						<li>Slider Item Title & text Font Size and Color settings</li>
					</ul>					
					
					<div class="sub_title qa">The process of adding a slider to a page is very straight forward:</div>
					
					<ol>
						<li>Create or edit a template in the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b></li>
						<li>Add a slider module</li>
						<li>Set and adjust the settings within the slider module</li>
						<li>Hit the &#39;Add Slide&#39; button and add slider items (slides) to the module.</li>
						<li>Adjust and set the Image, Title & Text settings for the slide which has just been added.</li>
						<li>Repeat step 4 an 5 and keep adding more slider items to the module.</li>
						<li>Create a page or post</li>
						<li>Select and set the template to that page or post under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)</li>
					</ol>
					
					<div class="sub_title qa">Q : Can I add a Flex slider by shortcode to a page?</div>
					No you can not. To add a slider to a page the slider module in the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> has to be used!. In RT-Theme-18 the default Flex slider is no longer available by a custom post type. So it is not possible to add that slider by shortcode or selecting the slider items by its id. 
					
					<br /><br />
					<div class="sub_title qa">Q : How can I add a slider to my home page?</div>

					<div class="answer qa">A : Your homepage is using the "Default Home Page Template". That template already contains a slider module if one did not removed or deleted the module from the template. <strong>Note</strong> : It is also possible to create a new template with a slider module and assign that to the homepage. <br /><br />Here are the steps : <br /><br />
					<ol>
						<li>Go to Template Builder → Expand the "Default Home Page Template"</li>
						<li>Expand the "Slider" module by clicking its edit button on the right side</li>
						<li>Change the global settings for that slider module and on the right side pane add as many slides as you need for this slider and change in each of the individual slider items the settings for the title, text, the colors and font sizes.</li>
						<li>Click save button on the top right window in the template builder.</li>
						<li>Make sure the template is assigned to your page which has been set as your homepage and view the page. if all done correctly the slider will show at the location in the page where you inserted the slider module.</li>
					</ol>
					</div>

					<div class="sub_title qa">Q : How can I add a slider to any page or post?</div>
					<div class="answer qa">A : Its same way as to add a slider to the Homepage. You must use the Template Builder and add a slider module to the template. Set its settings, save the template and select and set the template in your page.</div>
					If you would like to learn how to create a new template please read "How To Use the Template Builder" section available within the Setup Assistant.					
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'The Revolution Slider'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">The Revolution Slider</div>	
					Revolution Slider has been embedded to the theme as 3rd Party plugin. In order to create your slides you need to use it&#39;s own interface. The interface is located in the left sidebar menu of the WordPress Admin panel as "<a href="padmin.php?page=revslider">Revolution Slider</a>".

 					<br /><br />
					 
					<ul>						
						<li>Go to <a href="admin.php?page=revslider">Revolution Slider</a> → click on the Create New Slider button</li>
						<li>Give your slider a name and a alias name.</li>
						<li>Set and adjust all the available slider settings for that slider after creating the slider.</li>
						<li>Once done adjusting the global slider settings add your slider items (the actual slides) to the slider.</li>
						<li>After that you can open each of the individual slides and add items like layers of text, video&#39;s layers, layered images, buttons etc. to your slider. Set their positions by dragging dropping them in the design preview window adjust the layer&#39;s settings in the options window on the below left of the preview window..</li>
						<li>Save the Slider</li>
						<li><strong>Note</strong> : You can add any slider that has been created with the Revolution Slider plugin to any page or post 
							<ol>
								<li>by adding the Revolution Slider module to any template in the Template Builder and assign that template to the page or (custom) post.</li>
								<li>by inserting it&#39;s shortcode anywhere in the body content.</li>
								<li>by adding its shortcode to any other module in the template builder which supports shortcodes.</li>
							</ol>
						</li>
					</ul> 
 					
 					<br />
					<div class="sub_title qa">Q : How can I add a Revolution Slider to my Homepage?</div>

					<div class="answer qa">A : Go to "Template Builder", add a new "Revolution Slider" module, and select the Revolution Slider of your choice from the pulldown select list within the menu. Here are the steps : <br /><br />
					<ol>
						<li>Go to Template Builder → Expand the "Default Home Page Template"</li>
						<li>Add a new "Revolution Slider" module by selecting from the "Module List" and hit the Add Module button.</li>
						<li>Open the Revolution Slider module and select a slider from the dropdown list.</li>
						<li>Delete the any other "slider module" if you don&#39;t need those.</li>
						<li>Save the template.</li>
						<li>Select and set the template to a page or post under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)</li>
						<li>View the page in the front of your website</li>
						<li>Of course you can also insert the Revolution Slider shortcode anywhere in any page content. Consult the Revolution Slider documentation on how todo that: <a href="http://themepunch.com/codecanyon/revolution_wp/documentation/" title="The Revolution Slider Documentation" target="_blank">The Revolution Slider Documentation</a></li>
					</ol>
					</div>

					<div class="sub_title qa">Q : How can I find the Revolution Slider plugin&#39;s shortcode?</div>
					<div class="answer qa">A : Go to Revolution Slider, copy the correct shortcode name from the sliders that are listed from the "Shortcode" column.</div>

					<div class="sub_title qa">Q : How can I add a Revolution Slider to any page or post?</div>
					<div class="answer qa">A : Its same way as to add a Revolution Slider to the Home Page:
					<ol>
						<li>You must use the Template Builder and add a Revolution Slider module to your page template and assign that template to a page or (custom) post.</li>
						<li>Use the shortcode anywhere in the page content.</li>
						<li>Use the shortcode in any of the other template builder modules which support shortcodes.</li>
					</ol>
					</div>

					<div class="sub_title qa">Q : Can I get support on the Revolution Slider plugin and its working?</div>
					<div class="answer qa">A : No, the Revolution Slider is added as is. This means that if there are issue&#39;s within the theme integration we will fix those. But it means that we do not support any issue&#39;s you might be experiencing with the working (the how to) of the slider itself, multi language support etc.<br /><br />Consider this please : We did not develop that plugin, we just added it to the theme as is. If modified or added css does not work correctly we will not support that. Any &#39;real&#39; bug&#39;s within the plugin we can drop at the plugin&#39;s developers desk or if you own a revolution slider license yourselves you can do this by the use of your own license. We then will have to wait on a fix like any normal customer buying the plugin. It is not within our hands or control when it will be fixed.<br /><br />
					<strong>Note</strong> : You can find more information on how the Revolution Slider works in the <a href="http://themepunch.com/codecanyon/revolution_wp/documentation/" title="The Revolution Slider Documentation" target="_blank">The Revolution Slider Documentation</a></div>
					If you would like to learn how to create a new template please read "How To Use the Template Builder" section available within the Setup Assistant.					
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'The LayerSlider'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">The LayerSlider</div>	
					The LayerSlider has been embedded to the theme as 3rd Party plugin. In order to create your slides you need to use it&#39;s own interface. The interface is located in the left sidebar menu of the WordPress Admin panel as "<a href="padmin.php?page=layerslider">LayerSlider WP</a>".

 					<br /><br />
					 
					<ul>						
						<li>Go to <a href="admin.php?page=layerslider">LayerSlider WP</a> → click on the Create New Slider button</li>
						<li>Give your slider a name.</li>
						<li>Set and adjust all the available slider settings for that slider after creating the slider.</li>
						<li>Once done adjusting the global slider settings add your slider items (the actual slides) to the slider.</li>
						<li>After that you can open each of the individual slides and add items like layers of text, video&#39;s layers, layered images, buttons etc. to your slider. Set their positions by dragging dropping them in the design preview window and adjust the layer&#39;s settings in the options window below the preview window.</li>
						<li>Save the Slider</li>
						<li><strong>Note</strong> : You can add any LayerSlider that has been created with the LayerSlider plugin to any page or post by :
								<ol>
									<li>adding the LayerSlider module to any template in the Template Builder and assign that template to a page or (custom) post.</li>
									<li>inserting it&#39;s shortcode anywhere in the body content.</li>
									<li>inserting its shortcode to any other module in the template builder which supports shortcodes.</li>
								</ol>
						</li>
					</ul> 


					<div class="sub_title qa">Q : How can I add a LayerSlider to my Homepage?</div>

					<div class="answer qa">A : Go to "Template Builder", add a new "LayersSlider" module, and select the LayerSlider of your choice from the pulldown select list within the menu. Here are the steps : <br /><br />
					<ol>
						<li>Go to Template Builder → Expand the "Default Home Page Template"</li>
						<li>Add a new "LayerSlider" module by selecting from the "Module List" and hit the Add Module button.</li>
						<li>Open the LayerSlider module and select a slider from the dropdown list.</li>
						<li>Delete the any other "slider module" if you don&#39;t need those.</li>
						<li>Save the template.</li>
						<li>Select and set the template to a page or post under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)</li>
						<li>View the page in the front of your website</li>
						<li>Of course you can also insert the LayerSlider shortcode anywhere in any page content. </li>
					</ol>
					</div>

					<div class="sub_title qa">Q : How can I find the LayersSlider plugin&#39;s shortcode?</div>
					<div class="answer qa">A : Go to LayerSlider, copy the correct shortcode name from the sliders that are listed from the "Shortcode" column.</div>

					<div class="sub_title qa">Q : How can I add a LayerSlider to any page or post?</div>
					<div class="answer qa">A : Its same way as to add a LayerSlider to the Home Page:
					<ol>
						<li>You must use the Template Builder and add a LayerSlider module to your page template and assign that template to a page or post</li>
						<li>Use the shortcode anywhere in the page content</li>
						<li>Use the shortcode in any of the other template builder modules which support shortcodes.</li>
					</ol>
					</div>

					<div class="sub_title qa">Q : Can I get support on the LayerSlider plugin and its working?</div>
					<div class="answer qa">A : No, the LayerSlider is added as is. This means that if there are issue&#39;s within the theme integration we will fix those. But it means that we do not support any issue&#39;s you might be experiencing with the working (the how to) of the slider itself, multi language support etc. <br /><br />Consider this please : We did not develop that plugin, we just added it to the theme as is. If modified or added css does not work correctly we will not support that. Any &#39;real&#39; bug&#39;s within the plugin we can drop at the plugin&#39;s developers desk or if you own a revolution slider license yourselves you can do this by the use of your own license. We then will have to wait on a fix like any normal customer buying the plugin. It is not within our hands or control when it will be fixed.<br /><br />
					</div>
					
					If you would like to learn how to create a new template please read "How To Use the Template Builder" section available within the Setup Assistant.
				';
				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'The Carousels : &#39;Rotating&#39; Sliders'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">The Carousel &#39;Sliders&#39;</div>

					The RT-Theme18 comes with 4 carousel sliders which can be added by shortcode or within the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> by the use of one of the available carousel modules. The 4 carousel types are : <br/><br />
					<ul>
					<li>The Blog Carousel</li>
					<li>The Product Carousel</li>
					<li>The Portfolio Carousel</li>
					<li>The Testimonial Carousel</li>					
					</ul>
					
					By the use of a carousel slider it is possible to present a &#39rotating&#39; list of products, blog posts, testimonials or portfolio items, anywhere in the content or your page(s). The carousel slider pulls the items (posts) from the custom post types which are available by default in the theme (Posts, Products, Portfolios & Testimonials). 
					<br /><br /><strong>Note</strong> :It does not support any other custom posttypes added by 3rd party plugins. <br /><br />
					The carousel slider can be added within the template builder by the use of one of the available carousel modules. Each custom post type has its own carousel slider module. A carousel slider can also be added by the use of the available shortcode.
					Once done building the template the only thing left to do is creating a page and assign that template to that page, which has the carousel module or shortcode attached to it, under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)
					<br /><br /><strong>Note</strong> : Within the template builder one can add the carousel module, but you can also add the carousel shortcode in any of the other modules in the template builder that support shortcodes. 
					<br /><br /><strong>Note</strong> : The RT-Theme 18 theme is a very advanced premium theme and these kind of abilities might get ones head spinning as this way you are some how nesting the possibilities of the theme. So one has to keep track of where you did add what when you want to alter things.
					<br /><br />If you would like to learn how to create a new template please read "How To Use the Template Builder" section available within the Setup Assistant.
				';
		#
		#	Step 10
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Creating a Homepage';

				#
				#	Sub Titles
				#
				$content_count++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Create a Homepage';  
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'					
					<div class="sub_title qa">Creating a Homepage in RT-Theme-18.</div>		
					The process of creating a Homepage is RT-Theme-18 is fairly straight forward as it uses the default wordpress method.<br /><br/>
					<ol>						
						<li>In the wordpress admin part go to the Pages section <a href="edit.php?post_type=page">show me →</a>and add a new page. <a href="post-new.php?post_type=page">show me →</a></li>
						<li>Make sure to add your content to the home page by adding content into the content editor field of that page.</li>
						<li>Assign the Default Homepage Template to the page or any other custom template you have created. Assign the template to your home page using the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)</li>
						<li>Save and publish the page.</li>
						<li>Goto the wordpress reading settings and in the reading settings set &#39;Front page displays&#39 to static and select that page and set it as your Homepage (save the settings).<a href="options-reading.php">show me →</a> <strong>Note</strong> : Do not set it as your blog listing page.</li>
						<li>Goto the wordpress menu settings and add the Homepage to the (custom) menu container of your choice. Make sure you assign the (custom) menu container to the correct predefined theme locations in order to have that menu container show its menu at that location within the theme. <a href="nav-menus.php">show me →</a></li>
					</ol>
					

				'; 		 
								
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Edit Your Homepage Template'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				
				<div class="sub_title qa">Edit Your Homepage Template.</div>Open the Template you assigned to the Homepage. Most likely it is the "Default Homepage Template". if not open the custom Template you have created and selected and assigned to the Homepage page.
				<br /><br />
				
					<ul>	
						<li>Open Template Builder and expand by clicking the edit icon button the Template you assigned to your Homepage. Most likely the "Default Homepage Template".</li>
						<li>You will see there are some modules already added and available such as "Slider", "Row", "Default Page Content", etc.</li>
						<li>You can change the options/settings for each of the modules or add as many new modules as you need to create the Homepage layout and looks of your choice.</li>
						<li>Click &#39;Save Template&#39; button on the right top of the template you are editing to save all your Template adjustsment you made to each of the modules within that template.</li>
						<li>View your website again. If all changes are done/applied correctly it will show the modification that you made in the Homepage template in your Homepage in the front of your website. Pretty neat isn&#39;t it?</li>
					</ul>
					
					<br><div class="sub_title qa">Important to know and to keep in mind.</div>
					<br /><strong>Note</strong> : If you don&#39;t save the Template after changing it you will receive a warning message when you are trying to leave the template. If you then still continue without saving the template all changes you just made will be lost.
					<br /><br /><strong>Note</strong> : You can assign the homepage template to any page or post to create another page with the same layout or look but with different content if you add another content into the content editor field of that page or post. Get it?
					<br /><br /><strong>Note</strong> : If you would like to learn how to create a new template please read the "How To Use The Template Builder" section of the Setup Assistant.					
				';



		#
		#	Step 12
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create a Contact Page';
		@$contents->step[$step_count]->single_step = 1;

		 
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Define a page as your Contact page'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Creating a Contact page in RT-Theme-18.</div>					
					 Any page can be a contact page by assigning a template which has the contact module in it to that page. So one needs to create  a &#39;Contact&#39; template first or set (adjust) the "Default Contact Page Template", that is included in the theme, to a page. The template can contain a google map module (full width or not) or any other module but <strong>needs to have a contact form module</strong>. 
					 Once the template has been created and saved the only thing left to do is to create a page and assign that template to that page under the <b>"RT-Theme Template Options"</b> box. (<a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a>)
					 
					 <br /><br /><strong>Note</strong> : When you are using Wordpress Multi language you can create a template for each contact page for each language. Assign the correct &#39;language&#39; template, you have created per language, to each of the translated pages and make sure the languages match. Of course you can also use the WPML string translation addon for this, but by use of the template builder it is very easy to create this and accomplish translated contact page.
					 
					 <br /><br /><strong>Note</strong> : You are free to create as many (new) templates as you wish (server limitations will stop you) or change any of the available default or existing ones via  <a href="admin.php?page=rt_template_options">Template Builder</a> 
					 <br /> <br />
		 
					<div class="sub_title qa">Q : How can I customize a "Template" or create new one?</div>
 								
					<ol>	
						<li>Open the Template Builder and expand any of the available templates by clicking the edit button on the right side of the template in the listed templates overview or hit the &#39;Create New Template&#39; button below the template list to create a complete new template.</li>
						<li>Change the options / settings of the available modules which are already within that template and add / remove new modules into that template.</li>
						<li>Close the module and make sure you save the template  by clicking the save template button top right within the template builder. if you don&#39;t save the template you get a warning message while trying to close the template builder. On ignoring that message all changes will be lost.</li>
					</ol>
					
					If you would like to learn how to create a new template please read "How To Use the Template Builder" section available within the Setup Assistant.				
				';				

		#
		#	Step 13
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Use The Template Builder'; 

		 
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'What is the Template Builder & What do I need to know ?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">What is the Template Builder, What do I need to know ?</div>
					<a href="admin.php?page=rt_template_options">Template Builder</a> is a built-in tool that lets you create custom page layouts we call templates to use within your pages or posts. Templates are build by adding modules. Modules are predefined pieces of code which present content in the front of the website following the settings of the module. 
					Templates with modules gives you the ability to add (the same) extra content to any pages or (custom) post. Templates gives you the ability to create, if you want to todo so, a different layout for every page. Templates are a easy way to design your layouts which you can add to the default content of a page or post.
					
					<br /><br /><div class="sub_title qa">The Most Important Module is the Content Row</div>
					The Most important module is the content row as this is the master container for building your template layouts. The Content Row can be added multiple times in a template and can have different layout settings each time (fullwidth, content width based on your theme settings & sidebar layout).
					<br /><br /><div class="sub_title qa">Row Notes : </div>
					<strong>Note</strong> : There are two modules that can contain other modules. These modules are called rows (Header, Footer, Content) and columns. They are containers in which you can drag and drop other modules which present the actual data.
					<br /><br /><strong>Note</strong> : The (Header, Footer, Content) Row Module can contain column modules. A column module can contain other modules but it can <strong>never</strong> contain a (Header, Footer, Content) row module.
					<br /><br /><strong>Note</strong> : The (Header, Footer, Content) Row Module are so to say the master modules. They can have color settings applied to that row only and can have a custom background (image / color).
					<br /><br /><strong>Note</strong> : The Content Row can be set to full width or content width (theme setting in the styling option) and can have a sidebar layout. You can have as many Content Rows in a template as you wish but you can only have one Header and one Footer Row.
					
					<br /><br /><div class="sub_title qa">The Power of Templates & Modules</div>
					<strong>Note</strong> : Modules with textboxes do suppport shortcodes.
					<br /><br /><strong>Note</strong> : Some Modules pull certain content. Depending on the module you add you can adjust its settings and make specific content appear different in your page. F.e. a product list, a blog list, a portfolio list, sliders and many more.
					<br /><br /><strong>Note</strong> : You can create and add as many templates as you want. You can only assign one template to a page or post at a time.
					<br /><br /><strong>Note</strong> : Templates can be exported and imported into another website. No need to redesign your templates. This way as a designer you can quickly setup a website for your clients as you can already have your templates designed at a complete different (for the outside not viewable / hidden) server.
					<br /><br /><strong>Note</strong> : Modules can be cloned within the same content row or copied from one content row and pasted into another content row.
					<br /><br /><strong>Note</strong> : The RTTheme 18 Theme comes with a number of default templates which you can adjust or delete. You can always reset the template system to default again. This will delete all your custom templates. So make sure you export first the templates you want to keep. You can import them later again after the reset of the template builder system.
					<br /><br /><strong>Note</strong> : Using the template builder is not a must. But once you discover its power we know for sure you can&#39;t live without it.
					<br /><br /><strong>Note</strong> : Every page or post you create has (body) text. The default content. The story you want to tell in that page or post. When attaching a template to such page you have to make sure that content is shown in the front of your website. Therefor a very important module is de Default Page / Post Content Module as that  module pulls in that content you have added in the page or post content editor field into the page at the location where you inserted the Default Page / Post Content Module in the Template.
					';				

				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'How to add a Template to a Page or Post?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">How to add a Template to a Page or Post?</div>
					<ol>	
						<li>First create a template and add your modules of your choice. Drag the modules to its desired locations within the template. Make sure you save the template otherwise your changes you made will be gone. 
						<br /><br /><strong>Note</strong> : Make sure you add the Default Page / Post Content Module if you want to show the default page / post content within that template.</li> 
						<li>Open a existing page or post in the wordpress backend or create a new page or post.</li>
						<li>Select the template of your choice you want to use for that page or post under the <b>"RT-Theme Template Options"</b> <a href="'.$screenshotURL.'?image=template-options.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Screenshot</a></li>
						<li>Update (save) your page/post.</li>
						<li>View your page in the front of your website</li>
					</ol> 					

				<strong>Note</strong> : If you adjust the template you don&#39;t have to re-add the template to the page or post again. It will follow the adjustments in the template you just made when you reload the page in the front of your website.
				';					 

				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'How to Create a New Template?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">How to Create a New Template?</div>
					<ol>	
						<li>Go to <a href="admin.php?page=rt_template_options">Template Builder</a>.</li>
						<li>In the template builder bottom right right click on the &#39;Create New Template&#39; button.</li>
						<li>Once the Template is created click on the &#39;Edit&#39; button to open the template you have just created.</li>
						<li>First ting todo is to adjust the name of the template to something logical so you recognise it when you are working in pages or post and you want to attach that Template.</li>
						<li>The Newly created template have 3 default rows. A Header Row, A Content Row and A Footer Row. Each Row has on the right side a button to adjust the options of that Row. Those options can vary as there are different options for each row type.</li>
						<li>Content Rows can have different layouts Full width, Content Width, Sidebar layout. You can Add multiple Content rows as you wish giving your page a sectionalized look.</li>
						<li>The Header, Footer & Content Rows can contain modules of any kind.</li>
						<li>Start adding modules into each row by using the "Module List".</li>
						<li>Add more Content Rows if you need more content with a different layout (full width, content width, sidebar), background, image etc.</li>
						<li>Add columns to rows and set the column width to have data presented in a column layout look.</li>
						<li>Add modules to you columns and adjusts their settings.</li>
						<li>Once Done Adding modules and dragging and dropping them around to their correct locations in the rows and/or columns. Click the &#39;Save Template&#39; button to right in the template builder just below the admin name.</li>
					</ol>
				<strong>Note</strong> : If you do not save the template, before exiting it, the changes made to it will be lost. A warning message is presented if something has been changed in a template and you are trying to exit the template without saving it first. Ignoring that message will discard all changes permanently.
				';

				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Watch The Template Builder Video Tutorials'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">Watch The Template Builder Video Tutorials</div>
				We have created some video tutorials on how the template builder works. <strong>Note</strong> : They are without audio.<br /><br />
					<ol>
						<li>You can also find links to the video tutorials about the working of the template builder inside the documentation file that came with the download from Themeforest. </li> 
						<li>The documentation file can be found in the /Documentation/ folder as index.html file, that comes with the theme package!</li>			
					</ol>
					

					<h3>Watch The Template Builder Video Tutorials Screencasts</h3>
					<i>You can watch them in fullscreen as they are high quality (720p) video&#39;s.</i>

					<h5>PART 1 : </h5>
					<ul>
					<li>Introducing the Template Builder</li>
					<li>Create a new template and assign it with a page</li>
					<li>Add columns </li>
					<li>Add text with icons<br>
					</li>
					</ul>					
					<iframe width="420" height="315" src="http://www.youtube.com/embed/JI9VuXISh3k" frameborder="0" allowfullscreen></iframe>	

					<h5>PART 2 : </h5>
					<ul>
					<li>Add a new content row</li>
					<li>Customize the background of a content row and columns</li>
					<li>Add your portfolio items to your template</li>
					<li>Add a text with custom fonts and colors</li>
					<li>Add a sidebar and select widget locations to display<br>
					</li>
					</ul>					
					<iframe width="420" height="315" src="http://www.youtube.com/embed/mgBCAmzRjj0" frameborder="0" allowfullscreen></iframe>	

					<h5>PART 3 : </h5>
					<ul>
					<li>Customize the Header Row of a template</li>
					<li>Control the breadcrumb menu and title positions</li>
					<li>Add a slider to the header row</li>
					<li>Add a Google map to the header row<br>
					</li>
					</ul>					
					<iframe width="420" height="315" src="http://www.youtube.com/embed/Aa4R_r-X1tM" frameborder="0" allowfullscreen></iframe>	

					<h5>PART 4 : </h5>
					<ul>
					<li>Customize the Footer Content Row of a template</li>
					<li>Control the footer widgets</li>
					<li>Add a banner box to the Footer Content Row<br>
					</li>
					</ul>

					<iframe width="420" height="315" src="http://www.youtube.com/embed/yUc8FwGaU9M" frameborder="0" allowfullscreen></iframe>	


					<h5>PART 5 : </h5>
					<ul>
					<li>Customize colors of a content row</li>
					<li>Customize background of a content row</li> 
					</li>
					</ul>					
					<iframe width="420" height="315" src="http://www.youtube.com/embed/JdUBxJpTmLU" frameborder="0" allowfullscreen></iframe>

					<h5>PART 6 : </h5>
					<ul>
					<li>Set a page as your home page</li> 
					<li>Customize the default home page template</li> 
					</li>
					</ul>
					<iframe width="420" height="315" src="http://www.youtube.com/embed/qRRe7vs-sfk" frameborder="0" allowfullscreen></iframe>


				';		



				#
		#	Step 12
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Localization & the Wordpress Multi Language Plugin (WPML)';
		//@$contents->step[$step_count]->single_step = 1;

		 
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Localization of the Default Theme Strings'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">Localizing the Theme Default Strings by use of Language Files</div>
				The theme uses default strings which can we found in the theme language file that come with the theme. These strings are grouped in to one file which is located in the rttheme18/languages folder. The file called is rttheme.po. The values of those strings can be translated by the use of the <a href="http://www.poedit.net/" target="_blank">poedit program</a>. You will have to create a translation of that file by the use of poedit and name the file following the <a href="http://codex.wordpress.org/WordPress_in_Your_Language"  target="_blank">wordpress codex naming convention</a> for localization. If you use different names the theme will not find the translations for the default strings you created.
				<br /><br /><strong>Note</strong> : Even if you don&#39;t like the default English wording used by us within the theme you can create a translation file called en_US.po and en_US.mo and change the wording this way. No need to do hardcoded changes to the theme core files for those strings. The files you created with poedit you need to upload by a ftp program into the /wp-content/themes/rttheme18/languages folder.
				You can read more on this and how this works on the RTTheme forum : <a href="http://support-rt.com/discussion/2247/translating-themes-by-using-po-files#Item_1" target="_blank">Show me →</a> 
				'; 
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'The Wordpress Multi Language Plugin (WPML)'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  = '
				<div class="sub_title qa">What is the Wordpress Multi Language Plugin?</div>	
				WPML (Wordpress Multi Language) is a plugin which gives your website the ability to have the same content in different languages. With WPML you dont have to create a website for each language. You can have one website (domain) and have each page, post portfolio, product etc. show up in its the different language.
				<br /><br />
				<div class="sub_title qa">Changing languages in RT-Theme-18.</div>	
				In the theme general setting you can enable the language &#39;Flags&#39; for the header area. <a href="admin.php?page=rt_general_options">Theme General Settings</a>. Once the are enabled flags they will show in the front of the website within the header and give your visitors the ability to view a page in the selected (active) language (if the page has been created for that language). All they have todo is click on one of the listed flag (language) icons.
				<br /><br /><strong>Note</strong> : If a page or (custom) post has not been translated / created in that language it won&#39;t show of course.
				<br /><strong>Note</strong> : Flags will only show for each of the activated languages.
				<br /><br />
				<div class="sub_title qa">Versions of the Wordpress Multi Language Plugin.</div>	
				The WPML Plugin has a small "blog" version and the "multilingual CMS" version. The latter is the most complete version and best to use as it also support string translations (more on this further down below).
				<br /><br /><strong>Note</strong> : There are more (free) Language plugins at Wordpress.org or on the Internet. This theme has no buildin support for those. If you decide to use such plugins you will probably have to recode theme core files, css, html and php code. We don&#39;t support such coding adjustments to the theme. Not even on a paid basis as we do not have the time for that.				
				';
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'How to Use the Wordpress Multi Language Plugin in RT-Theme-18.'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  = '
				<div class="sub_title qa">How to Use the Wordpress Multi Language Plugin on Default Content?</div>
				Here are the Steps we would use to Translate a Page or Post : <br /><br />
				<ol>
				<li>Create a page and finish the complete content with featured images and all other images, attachments etc. Once done publish the post.</li>
				<li>Once finished that page make sure you have the post / page opened (in the admin backend) and on the right side just below the admin name in the wpml option box check the languages and create a duplicate of that page for each of the other languages. </li>
				<li>While still in that &#39;original&#39; page change the language by the use of the language selector button (menu option) in the admin bar. The page will be presented in the other language. </li>
				<li>You will see the page in the other language but since you duplicated the content it will look exactly the same as in the original content of the primary default language your created the page in, in the first place.</li>
				<li>You now have two options.... :<br />
				    <ol>
					  <li>You leave it like it is which means that if somebody switches the language in the front of your website he will see the same page but still not translated. <strong>Note</strong> : If you do not create duplicates for a page or post that page or post will not show in the other language and throw the user back to the root of the domain in the other language if he clicks on the flags while viewing a page in the hope to see and read the translated version of that page. <br /><br />
					  <div class="sub_title qa"><strong>Note</strong> : WPML has a option called &#39;Blog Post to Display&#39;. You can set that option to &#39;All posts&#39; or to &#39;Only Translated Posts&#39;. Please only use the &#39;Only Translated Posts&#39; setting. The Theme does not support the &#39;All Posts&#39; setting. You can read more about that here on the forum : <a href="http://support-rt.com/discussion/8883/tutorial-cause-of-most-wpml-not-working-issues#Item_1" target="_blank">Show me that tutorial </a></div></li>
					  <li>You disconnect the duplicate from the original language by hitting the &#39; Translate Independent&#39; button in the WPML box just below the admin name. Making them independently translated pages means you can now write and adjust the content in the other language without affecting the content in the &#39;master document&#39; or the original document. <strong>Note</strong> : The documents are still connected to each other by the WPML plugin but the content is now separated.
					  <br /><br /><strong>Note</strong> : Not making them &#39; Translate Independent&#39; documents means that if you change the content in one of the other languages you are actually  modifying the content in the primary default language. So be careful here and watch your steps.</li>
					</ol>
				<li>Assign the correct template to the translated page. Only applicable if &#39; Translate Independent&#39; is used. See further down below on How to Use the Wordpress Multi Language Plugin With the Template Builder.</li>
				<li>Don&#39;t forget to publish the translated version!</li>
				<li>Repeat steps 2, 3, 4, 5, 6 and 7 for each language.</li>
				</ol>
				';
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Wordpress Multi Language Plugin and Categories.'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  = '				
				<div class="sub_title qa">Wordpress Multi Language Plugin and Categories.</div>
				The RTTheme 18 comes with custom post types like Portfolios, Products which like the Posts of Wordpress itself can be grouped by categories. In order to have Posts grouped and listed by category you will have to : <br /><br />
				<ol>
					<li>Create a Post</li>
					<li>Create a Category</li>
					<li>Attach the Category to the Post</li>
					<li>Publish the Post</li>
				</ol>				
				Calling a category will list all posts attached to that category in the requested sort order. Categories can be added to the menu system as a menu item. So once clicked upon a list of posts attached to that category will show.<br /><br />
				By translating a category and posts the same can be accomplished for each of the translated category listing pages. The translated category will then list all posts attached to it within the other language.
				<br /><br /><strong>Note</strong> : It is wise to create the categories first and their translations for each language. You will notice that if a post is attached to a category and that post is translated you don&#39;t have to worry about the translation of the category any more as wpml will already know it and assign the correct one to the post.
				';
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'How to Use the Wordpress Multi Language Plugin With the Template Builder.'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  = '				
				<div class="sub_title qa">How to Use the Wordpress Multi Language Plugin With the Template Builder.</div>
				As long as the template builder has modules calling default content you don&#39;t need to create duplicates of a template for each language. But the moment a template has custom content the easy way is to create a duplicate of that template for each language and translate the custom content in each of the added modules within that template (which can be any type of content even titles). Repeat this and create a translation of that template for each language. 
				Once a duplicate template has been created go to the page concerned open the translated version of that page and assign the translated version of that template to that page.
				<br /><br /><strong>Note</strong> : This means that you can have translated pages have a different layout because the templates can have different modules. This is the great power of this Theme. Once you understand these abilities you will love that.
				';
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'The WPML Plugin String Translation Addon.'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  = '				
				<div class="sub_title qa">The WPML Plugin String Translation Addon.</div>	
				The WPML CMS Plugin comes with a add-on called String Translation. RTTheme-18 support string translations for fields we use throughout the theme. Even within the template builder. Once such string is detected by the WPML plugin its translation can be done in the String Translation AddOn. So instead of creating duplicates of some fields and content, if supported, these can be translated a different way. You can read more on the string translation addon at WPML.org. 
				<br /><br /><strong>Note</strong> : Not all strings will be visible in the string translation AddOn. 
				Only the strings (fields) we connected and have taken care of within the theme code, will be visible in the list of the string translation add-on. For example : <br /><br /> 
				<ul>
				<li>Copyright text</li>
				<li>Slogan</li>
				<li>Social Media</li>
				<li>Breadcrumb text</li>
				<li>And many more...</li>
				</ul>
				';
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'WPML and Different Widgets Per Language.'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  = '				
				<div class="sub_title qa">WPML and Different Widgets Per Language</div>
				For widgets that are not supported by (string) translation, duplication WPML advices to use plugins like Widget Logic and Dynamic Widgets to make widgets appear in a certain sidebar area&#39;s  based on a language ID. Please consult the WPML documentation on this on how to use and accomplish that. <a href="http://wpml.org/2011/03/howto-display-different-widgets-per-language/" target="_blank">Show me →</a>
				<br /><br /><strong>Note</strong> : You dont need these plugins as you can accomplish all this within RTTheme 18 by the creating custom (per language) templates in the template builder and custom sidebars with (text) widgets for that language only. But in rare occassion you might need these plugins and that is why we mentioned these here.
				
				';	
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'The WPML Plugin and getting support from RTTheme Support on that.'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  = '
					<div class="sub_title qa">Q : Can I get support on how the WPML plugin works?</div>
					<div class="answer qa">A :  No, WPML has its own support forum and documentation where one can get information and help (paid or non-paid). We only adjust our coding mistakes, if any we correct and support those. The in the HowTo section available documentation on WPML pretty much covers all common questions and working of the WPML plugin within RTTheme-18.</div>
				';
				#
		#	Step 8
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create a WooCommerce Webshop'; 				
				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Download the WooCommerce Plugin'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">Download the WooCommerce Plugin</div>
				To have a &#39;real webshop&#39; with products, stock registration, sales, coupons, customer registration and payment gateways, etc. in your website you have to install a plugin called WooCommerce. The WooCommerce plugin can be downloaded directly from http://wordpress.org.
					You can download WooCommerce plugin at  <a href="http://wordpress.org/extend/plugins/woocommerce/" target="_new">Download →</a> <br /><br />
						
					also available on <a href="http://www.woothemes.com/woocommerce/" target="_new">WooCommerce Official Website →</a> <br /><br />					
				The WooCommerce Plugin is free. The addon plugins are not. You can buy those at:
				<ol>
				<li><a href="http://codecanyon.net/search?utf8=%E2%9C%93&term=woocommerce" target="_new">Codecanyon →</a></li>
				<li><a href="http://www.woothemes.com/woocommerce/" target="_new">WooCommerce Official Website →</a> </li>
				</ol>
				Depending on what you want todo one has to buy one or more plugins. The WooCommerce Plugin by itself is however very well equiped to handle a default webshop.
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Learn How To Use WooCommerce'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">The WooCommerce Plugin How Does it Work?</div>
					 WooCommerce has rich documentation archive about the plugin. Go to <a href="http://wcdocs.woothemes.com/" target="_new">WooCommerce Documentation Website→</a>. 
					 
				<br /><br /><strong>Note</strong> : We don&#39;t support the working of any plugins within the theme. These plugins have extensive documentation of its own.
				<br /><br /><strong>Note</strong> : For adjusting the layout of the shop or the order of items within a product page one has to follow the WooCommerce documentation and add/remove/adjust the action calls. Problems of any kind with that can be dropped at the WooCommerce support forum.
				<br /><br /><strong>Note</strong> : We support our coding issues, mistakes and if any we fix those within a reasonable time if they are cause by our doing.
				<br /><br /><strong>Note</strong> : WooCommerce has its own support forum where one can get help (paid or non-paid). 
				';

				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Change WooCommerce Settings'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">The WooCommerce Settings can be found here.</div>
					 Find "WooCommerce" on the left hand side menu and click "Settings" from its sub menu.
					 <br />Show me → <a href="admin.php?page=wc-settings">WooCommerce Settings</a>
					 
				';


				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Change the RT-Theme&#39;s WooCommerce Related Settings'; 
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Adjust The Theme WooCommerce Related Settings</div>
					 This theme offers some global options for the WooCommerce Plugins such as "Layout", "Amount of products per page" etc. You can adjust those settings within the theme options. 
					 <br />Show me → <a href="admin.php?page=rt_woocommerce_options" target="">RT-Theme\'s WooCommerce Options →</a>
					 
				';


				$content_count ++;
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Read These Notes!'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
					<div class="sub_title qa">Q : How can I add WooCommerce Products into my templates?</div>
	
					<ol>	
						<li>Open the <b><a href="admin.php?page=rt_template_options">RT-Theme Template Builder</a></b> and edit a template that you want to add the WooCommerce products to.</li>
						<li>Select "WooCommerce Product Module" from the module dropdown list.</li>
						<li>Adjust the WooCommerce Product Module Settings.</li>
						<li>Click the &#39;Save Template&#39; button to save the template.</li>
						<li>Create a page or open a existing one and set that page to use that template. Save the page.</li>
						<li>View the page in the front of your website.</li>
					</ol>
					
					If you would like to learn how create a new template please read "How To Use The Template Builder" section here in the Setup Assistant.

					<br /><br /><div class="sub_title qa">Q : What is the differencies between Product Showcase and WooCommerce Products?</div>
					<div class="answer qa">A : They are completely different systems. You can use default "Product Showcase" to create an organized product catalog.  If you would like to
					sell your products online via various payment gateway systems, we advice to use WooCommerce. </div>

					<div class="sub_title qa">Q : Can i move my existing products from Product Showcase to WooCommerce?</div>
					<div class="answer qa">A :  No, this is not possible. You need to create new products, categories etc. by using the WooCommerce Product Post type.</div>
					
					<div class="sub_title qa">Q : Can I get support on how the WooCommerce plugin works?</div>
					<div class="answer qa">A :  No, WooCommerce has its own support forum where one can get help (paid or non-paid). We only adjust our coding mistakes, if any and support those.</div>
					<strong>Note</strong> : When The WooCommerce Plugin Updates it is wise to visit the RTTheme Support Forum to see if we aprove of the update. WooCommerce sometimes changes many of its code causing blindly installing of a update that your website does not look ok anymore.
					<br /><br /><strong>Note</strong> : You can visit the support forum here: <a href="http://support-rt.com" target="_blank">RTTheme Support Forum</a>
					<br /><br /><strong>Note</strong> : There are more (free) Ecommerce plugins at Wordpress.org or on the Internet. This theme has no buildin support for those. If you decide to use such plugins you will probably have to recode theme core files, css, html and php code. We don&#39;t support such coding adjustments to the theme. Not even on a paid basis as we do not have the time for that.
				

				'; 

		#
		#	Step 14
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Navigation Menus'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">Wordpress menu&#39;s and RT-Theme-18.</div>	
				The WordPress system comes with the ability to build your own custom navigation menus. Menus are build by creating &#39;containers&#39; in which you drag drop your menu items. The menu &#39;containers&#39; once created and filled with menu items are set to the themes locations. 
				<br /><br />F.e. : Suppose you create a menu container called &#39;My main navigation&#39;. Once done you assign this menu to the Theme Main Navigation Location. By doing so your custom menu will be listed at that location within the theme where the main navigation is located.<br /><br />
				<div class="sub_title qa">Menu Subtitles and RT-Theme-18.</div>
				
				<strong>First of all</strong> : Go to "Header Options" and check the "Enable Top Level Menu Subtitles" option to enable the subtitle visibility for the frontend navigation bar.<br /><br />

				RT-Theme-18 has subtitle support for the Main Menu location. Subtitles are to be added in the individual menu item itself in the menu-item description field. If you don&#39;t see the description field then while in the wordpress menu system click on the screen options just below the admin name 
				(top right corner of your screen) and enable the description field in the screen options. It will then become visible in the menu item to be used and filled with a subtitle.<br /><br />

				<strong>Note</strong> : Menu Item Subtitle support is only available for the main menu container / location and only for the toplevel menu-items. So sub level menu-items will not display any subtitle, which is by design.<br /><br />
				<strong>Note</strong> : You can use : <br /><br />
				<ul>
				<li>the "RT Theme Main Navigation Menu" container for the main navigation location,</li> 
				<li>the "RT Theme Footer Navigation Menu" container for the footer menu location,</li>
				<li>the "RT Theme Top Navigation Menu" for the page top menu location.</li>
				</ul>
				Of course you can create new containers with your own fancy naming and assign those to the theme menu locations. You can also assign each container to the same location. But be aware not every location supports sublevel menu items as the main menu location does. Which means that the footer and top menu locations can only have top level menu items and will not display any dropdown (sub) menu items.
				
				<br /><br />
				
					<div class="sub_title qa">Q : Where is the WordPress Menus??</div>
					<div class="answer qa">A : Go to Appearence → section tab → <a href="nav-menus.php">Menus</a> </div>
					

					<div class="sub_title qa">Q : How can I build a navigation menu?</div>
					<div class="answer qa">
					
						<ul>	
							<li>Click on the edit menu tab in the wordpress menu system and select the "RT Theme Main Navigation Menu" from the drop downlist and click the select button.  <a href="'.$screenshotURL.'?image=menus.jpg&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Click here for the screenshot</a></li>
							<li>You can also create a new menu container in that same tab by clicking on the &#39;create a new menu&#39; link on the right side of the menu select button.</li>
							<li>The menu system is divided in two sections. On the left you see all your pages, posts, products, categories, portfolio items. On the right section you see the custom menu container with your menu items.</li>
							<li>Drag the pages, posts, categories etc into the menu container or select them and click on the add to menu button. You will notice they appear as a list of menu items in the second section, the actual menu container.</li>
							<li>Each menu item has settings which can be adjusted. You can change the navigation label, the title attribute (this is what you see when you hover the menu item and which is very good for seo to use), the description, and even add your own classes to f.e. target that specific menu item by that class by the use of custom css (for experienced users).</li>
							<li>If you don&#39;t see all of the just mentioned menu item settings enable them in the <strong>screen options below the admin name</strong>.</li>
							<li>The listed menu items in the menu container can be rearranged by dragging and dropping. You can also make them a sublevel menu item by dragging them to the right below another menu item and releasing (dropping) them.</li>
							<li>Drag and Move the menu items within the list and thus create your menu system.</li> 
							<li>Below the Menu items in the menu container the <strong>theme locations</strong> are listed. Make sure you select the location for the menu you are creating. This will be the location where the menu will show in the front of your website. <strong>You need to select and set this in order to display your menu in that location.!!</strong></li>
							<li>Click "Save Menu" button to save your just designed and created menu and visit the front of your website to see the result.</li>
						</ul>
						
					</div>									
				 

					<div class="sub_title qa">Q : I do not see (Portfolio / Product / Post) Categories in the menu system to add to my menu.<br /> How can I make them visible?</div>
					<div class="answer qa">
					
						<ul>	
							<li>Click on "Screen Options" tab just below the admin name while you are working in the "<a href="nav-menus.php">Wordpress menu</a>" system.</li>
							<li>Make sure within the screen options the post, product and portfolio categories are selected (enabled) to have those categories listed and thus available on the left side of the menu system. Once enabled you can add them to your menu container.</li>
							<li><a href="'.$screenshotURL.'?image=menus-screen-tab.png&preview_iframe=1&TB_iframe=true&" title="RT-Theme Screenshots" class="thickbox">Click here for the screenshot</a></li>
						</ul>
						
					</div> 

					<div class="sub_title qa">Q : How can I add a "Home Page" or a Custom link?</div>
					<div class="answer qa">
					
						<ul>	
							<li>Use the "Links" box on the left side. Click on it to open its options.</li>
							<li>Type your (home page) URL in the URL field.</li>
							<li>Type "Home Page" or anything Label text that you want to call your (home) page in the "Link Text" field.</li>
							<li>Click "Add to Menu" button.</li> 
							<li>Goto the newly added link menu-item in the menu container and drag it to its place and adjust it settings (optional).</li>
							<li>Do not forget to save the menu !</li>
						</ul> 
					</div>	 
					<div class="sub_title qa">Q : Is there a video on this?</div>
					<div class="answer qa">
					There are many good video&#39;s available on youtube. Go to youtube.com and search for &#39;wordpress 3.0 menu system&#39;. Watch some of those great video&#39;s and discover how the menu system works.
					<a href="http://www.youtube.com/results?search_query=wordpress 3.0 menu system">show me on youtube ! →</a> 
					</div>

				';			 


		#
		#	Step 14
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create Mega Menus & Select Icons'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'	

					<strong>Icons</strong><br />

					1) Go to Appearance -> Menus and click the "Screen Options" button at the top right corner of the page. <br />
					2) Then select to activate CSS Classes field for icons. ( and Description field for sub titles )<br />
					3) Once you have enabled the CSS Classes field, expand an item in your menu and click it\'s "CSS Classes (optional)" field to select icons for it.<br /><br />
 
					<strong>Mega Menus</strong><br />

					1) Expand a "top level" item in your menu and click to enable it\'s "Multi-Column Menu" check box to display its sub menus in multi columns (mega menu).<br />
					2) Use column "Column Item Size" to deside, how many menu items will be displayed in a column.<br />
					3) Use "Column Heading" to display a sub menu as column heading. It is usufull when the item has sub items. <br />
 
				';			  


		#
		#	Step 15
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'How to Use Widgets'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">Wordpress Widgets and RT-Theme 18.</div>
				Widgets are predefined pieces of code which produce f.e. a  recent post list with thumbnails, a searchbox or whatever the widget is designed for in a sidebar.<br /><br />
				<div class="sub_title qa">Widgets and Sidebars.</div>
				Wordpress has widgets and sidebars. Widgets need to be added to sidebars. Sidebars are area&#39;s, containers, that contain widgets. Once a widget is in a sidebar container then when that sidebar is called within a page the widget will show what it is designed for at that location in that sidebar.
				Wordpress has a number of default widgets and the RT-Theme-18 also comes with a number of preset widgets. Any of those widgets can be dragged into any sidebar container / location / area of your choice. Each widget can have none or one or more settings which needs to be set in order to have the widget show the result you are looking for.
				<br /><br /><strong>Note</strong> : The more plugins you add to the wordpress system the more widgets become available. Not all will work within the theme as there can be conflicts because of (adjusted or older used versions) javascript or css classes used by the plugin developer. If this happens the plugin developer will point to the theme author and vice versa. This we can not support or help. It is simply not possible to have a premium theme, which already has loads of extra features and abilities, to have it support the more then 500.000 available plugins which there are on the market. Most of them are not even supported anymore by its developer and have become obsolete. Please check the wordpress version a plugin requires before adding this to your wordpress environment as it can damage your install.
				<br /><br /><strong>Note</strong> : A special widget is the text widget. It can contain theme shortcodes and any valid html code or even scripts. Keep in mind that adding html or scripts can have influence on the floating sidebar script the theme uses. It might require that you will have to turn off the floating sidebar ability. We can not help this or solve this issue. It is a result of your own content added.
				<br /><br /><strong>Note</strong> : Be aware that, in RT-Themes that have the template builder system, the sidebars are not always sidebars as you expect them to be, which appear and display vertically listing widgets at the left or right side of a page. In RT-Themes sidebars can also be used to show its widgets horizontally anywhere in your content by the use of the template builder. This way you can present the content of your widgets in columns (to be set in the sidebar module in the template builder). Not many premium theme have such ability. This might get your head spinning but once you understand it you will love it and embrace the power of this theme and its abilities.			
				<br /><br /><div class="sub_title qa">Wordpress Widgets : how to add them?.</div>
				<ol>	
				<li>Go to Appearance → <a href="widgets.php">Widgets</a> </li>
				<li>Choose a Widget click on it and choose a sidebar container / location to add it to or drag it to the sidebar location where you wish it to appear.</li>
				<li>There are default sidebars for the theme or you can create one or more custom sidebar containers. This way you can use a sidebar with specific widgets for a specific group of pages, posts, categories, etc. See the "<a href="admin.php?page=rt_sidebar_options">Sidebar Creator</a>"
				<li>To arrange the Widgets within the sidebar, click drag and drop them into its place. You can even move them to another sidebar container area.</li>
				<li>To customize the Widget features, click the down arrow in the upper right corner of the widget to expand the Widget&#39;s settings / options interface and adjust its settings (if available).</li>
				<li>To save the Widget&#39;s settings / options click Save button below the widget. <strong>Do not forget this</strong>.</li>
				<li>To remove the Widget, click the Delete link below the widget and confirm the removal.</li>
				</ol>

				<div class="sub_title qa">Q : How can I add a list of menu links into a sidebar by a widget?</div>
				<div class="answer qa">
				
					<ol>	
						<li>Goto the wordpress <a href="nav-menus.php">Menus</a> system and create a custom menu container. Add your menu-items to that menu container as explained in the how to Creating Navigation Menus section here in the setup assistant.
						<li>Save the menu but <strong>do not assign</strong> it to a theme menu location.</li>
						<li>Go to Appearance → <a href="widgets.php">Widgets</a> </li>
						<li>Click on the wordpress custom menu and add it to the sidebar container of your choice.</li>
						<li>In the sidebar open the wordpress custom menu widget settings and select the custom menu you have just created. Save the settings !</li> 
						<li>Go to the template builder and add that sidebar to a template at the location you want the sidebar with that widget to appear</li>
						<li><strong>Note</strong> : If you add the widget to the common sidebar that widget will appear in every page which has been set to a sidebar layout</li> 
						<li><strong>Note</strong> : If you add the widget to any of the default sidebars the theme uses, then when a left or right sidebar layout is set that widget will appear in those pages/post/products/categories/portfolios that uses that sidebar area by default.</li> 
					</ol> 
				</div>
				<div class="sub_title qa">RT-Theme 18 predefined widgets.</div>
				RT-theme 18 comes with a number of predefined widgets:<br /><br />
				<ol>
					<li>[RT-Theme 18] Contact Info widget</li>
					<li>[RT-Theme 18] Flickr widget</li>
					<li>[RT-Theme 18] Popular Posts widget</li>
					<li>[RT-Theme 18] Recent Posts widget</li>
					<li>[RT-Theme 18] Recent Posts widget - style 2</li>
				</ol>
				<strong>Note</strong> : For all other predefined abilities one has to use a default Wordpress Text-widget and insert one of the many available RT-Theme 18 shortcodes into the Text-widget text-area. See more on shortcodes in the setup assistant "RT-Theme 18 Shortcodes & Icons" section 
				';			 


		#
		#	Step 16 
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Adding Backgrounds in RT-Theme 18'; 				
		@$contents->step[$step_count]->single_step = 1;
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">Backgrounds in RT-Theme-18.</div>	
				The RT-Theme 18 is sectionized which means that (different) backgrounds can be set to each section. You can set a background to the top bar area, header & sub header area, the default content area, the navigation area, and the footer & sub footer area. 
				<br /><br />F.e. setting a background in the styling options in the Global style tab will result in a background displaying left, right (and even below) the content area. The latter depending on your transparency color settings for the inner content area (might require custom css.) <br /><br />
				<strong>Note</strong> : Setting a background to the Global Style can only be done when boxed mode is used. If the fullwidth layout is selected and set, the background needs to be set in the "Default Content Area" as that is then used covering up the whole content area.
				<br /><br /><strong>Note</strong> : You can set a default background for each of the available area&#39;s (sections) in the theme styling options.<br /><br />
				The theme is driven by a core system called the &#39;Template builder&#39;. Beside that you can set default backgrounds in the default styling options, for each of the available sections, you can override those background settings in the template itself and use different ones for each of the sections, with the exception of the navigation area, the top bar area and footer links bar area as those can onlye be set globally in the theme styling options.
				<br /><br /><strong>Note</strong> : The template builder uses rows to display its content. You can add as many rows to a page template. Each row can be set to box or fullwidth layout, left or right sidebar. Each row can have a different background. This way you can create a sectionized look within the content area of a page as each section (row) can have a different background color with transparency and its own background image.<br /><br />
				You can use the theme "Styling Options" to set the default backgrounds for each of the available theme sections / area&#39;s for the entire website.  <a href="admin.php?page=rt_styling_options">show me →</a>
				<br /><br /><strong>Note</strong> : In contrast to previous RT-Themes it is no longer possible to set a background in the page itself for that page. All has to be done by a template in the template builder. A template is assigned to a page and thus displaying the content, background and colors according its settings within that template. This is a pretty amazing and powerfull feature of this theme as because of this it has almost unlimited abilities. 
				The only thing needed is to understand the working of template builder system. We advice to read that section carefully here within the setup assistant where all is explained more detailed about the template builder.
				';
 

		#
		#	Step 17
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Controlling the Header Area in RT-Theme 18'; 				
		@$contents->step[$step_count]->single_step = 1;
				
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">The Header Area in RT-Theme-18.</div>
				The header area in RT-Theme-18 consists of a number of elements. We have the top bar, the header area containing the logo, the slogan and header widgets, we have the navigation area with the main navigation and the sub header area displaying sliders or any module you want to add to that area in the template builder. <br /><br />
				Controlling the Header Area can be done :<br /><br />
				<ul>
					<li>By the global settings for the header in the theme header settings.<a href="admin.php?page=rt_header_options">show me →</a> </li>
					<li>By the color and the background settings in the theme styling options. <a href="admin.php?page=rt_styling_options">show me →</a> </li>
					<li>By overriding some of those default (color background) settings in the header module of the template in the template builder, but also by adding different modules to the template in its header section.</li>
					<li>By Creating a custom menu container, add menu items and set that to the theme menu locations</li>
					<li>By using certain plugins you can even control what widgets show in the header area on a page, category, post basis. Such plugins can be download from <a href="http://wordpress.org/plugins" target="_blank">Wordpress.org</a></li>
				</ul>
				So there are different theme and wordpress settings for controlling all the elements in the header area. Together they will create the looks & feel, layout of the header of your website. You can even vary many of these  header elements on a page / post basis by using the template builder and creating different templates with different 
				settings and assigning these templates to different pages or post. 
				<br /><br />This theme is almost so to speak &#39;endless&#39; in its abilities. Although there are always some settings (defaults & elements) which are global and which are not adjustable on a single page basis like the top menu bar, the main navigation content (although possible by a plugin which adds menu logic to the wordpress menus system).
				But overall you can adjust many things making your website look special and different then all the others out there on the internet.

				<br /><br /><strong>Note</strong> : RT-Theme-18 does not have settings for the header in the single (custom) post or page like previous RT-Themes. You will have tp use the template builder. 
				';

		#
		#	Step 18
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Using Shortcodes & Icons in RT-Theme 18'; 
		@$contents->step[$step_count]->single_step = 1;
		 
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">Adding Shortcodes in to content</div>
				RT-Theme 18 comes with a huge number of shortcodes that allow you to add predesigned content by shortcodes into the content area of any page.  Shortcodes can also be added into text widget in a sidebar or into any text-area in any of the available modules in the template builder. When you insert a shortcode into a text-area you might be seeying something like this : <br /><br />
				[contact_form email="" title=""]Contact form description text[/contact_form]<br /><br />
				Because it is not html code it looks a bit ackward. The shortcode gets processed once the page is viewed in the front of your website. In this example a contact form is shown at the location where that shortcode was inserted into the content.
				<br /><br /><div class="sub_title qa">Editor Mode</div>
				The Wordpress editor has two modes : Visual Mode (in some languages called "Wysiwyg Mode") and Text Mode (in some languages called "HTML Mode). To use the auto insert function for the shortcodes one has to use the Visual or Wysiwyg Mode of the editor. 
				<strong>Note</strong> : The insertion of a shortcode while using the editor text mode is not possible.
				<br /><br /><div class="sub_title qa">The Shortcode Popup Window / Button <strong>[&#60;&#47;&#62;]</strong></div>
				There are two ways to open the shortcode generator window and insert a shortcode while the editor is in <strong>Visual</strong> mode :<br /><br />
				<ol>
					<li>Above the editor text-area by clicking clicking on a button which looks like this : <strong>[&#60;&#47;&#62;]</strong>.</li>
					<li>By clicking on the <strong>&#60;&#47;&#62; Shortcodes</strong> menu item in the Wordpress Admin Bar</li>
				</ol>
				Click on one of those two buttons will open a popup window with a list of available shortcodes. The shortcode you select in that popup window will present two or three sections: 
				<br /><br />
				<ul>
					<li>One section, on the left explaining the shortcode and its parameters,</li>
					<li>One section on the right showing a already pregenerated shortcode,</li>
					<li>Sometimes there is another pregenerated shortcode example,</li>
				</ul>
				The already pregenerated shortcode in the top right of that window can be altered by following the explaination on the left. It is wise to adjust the variables while having that window open before hitting the shortcode insert button (see also below the icon insert help text). 
				<br /><br />The moment you hit the insert button the shortcode will be inserted into the content text-area at the location where the cursor was the moment you hit the shortcode button to present you the list with the available shortcodes.
				
				<br /><br /><strong>Note</strong> : You can always view the shortcodes in the popup window by clicking <strong>&#60;&#47;&#62; Shortcodes</strong> menu item in the Wordpress Admin Bar. 
				<br /><br /><strong>Note</strong> : You can only insert shortcodes while the content text-area (editor) is in Visual or Wysiwyg Mode.
				<br /><br />
				<div class="sub_title qa">Scalable Vector Icons</div>
				RT-Theme 18 supports scalable vector icons. Those icons are called by its css class name. In some shortcodes you will see a parameter like this : icon="". Between these quotes "" you will have to insert the icon css class name. 
				<br /><br />In order to get the correct icon name, and to have a idea about how the icon looks before inserting, 
				there is a button (actually a menu item) on the Wordpress Admin Bar that looks like a little rocket with the text "Icons" on the right side of that "rocket" icon. <br /><br />
				When you click on that "Rocket-Icon" button (menu-item) in the Wordpress Admin Bar you get a preview list of all available icons. You can narrow the list by using the search ability of that box. Once the icon of your choice has been found then you need to select the icon css class name and copy its css class name and paste that name between the quotes of the icon="" parameter in the shortcode. So you get something like this: <br /><br /><strong>icon="icon-rocket"</strong> as part of the complete shortcode.
				';			 

		#
		#	Step 19
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Add Social Media Information to your website.'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =
				'
				<div class="sub_title qa">Adding Social information to your website</div>
				Social information can be added to the theme by the use of the global Social Media Options in the theme settings.<a href="admin.php?page=rt_social_options">show me →</a><br /><br />
				Per Social Media Icon the following options can be set :<br /><br />
				<ul>
					<li>The Social Icon Text which appears on hover,</li>
					<li>The Social Icon Link to which the social icon will link when clicked upon,</li>
					<li>The Social Icon Link Target. To be set to if the Icon should open the link a new browser tab (same window or new window)</li>
				</ul>
				
				You can make the (social media) icons appear in the top of the page and in the footer by turning on the &#39;position&#39 toggles in the RT-Theme 18 Social media Settings.
				You can also have the icons show anywhere in your website by inserting social icon shortcode [rt_social_media_icons] anywhere in the content text-area&#39;s
				
				<br /><br /><strong>Note</strong> : A valid URL to the Icon desitination has to be entered.
				<br /><strong>Note</strong> : For an email social icon one can either add a valid email address or a link (URL) to a contact page.
				';

		#
		#	Step 20
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Create a Footer Navigation & Footer Options'; 
		@$contents->step[$step_count]->single_step = 1;
		 
 			
				@$contents->step[$step_count]->contents[$content_count]->content  =	'
				<div class="sub_title qa">Creating a Footer Navigation & setting the Footer Options</div>
				RT-Theme 18 Footer area is divided into two sections. The Footer Area containing the footer Widgets and Footer Bottom Area containing the copyrights & the footer custom menu bar. 
				<br /><br />
				<div class="sub_title qa">How can I create a footer navigation?</div>
							
					<ol>	
						<li>Goto the wordpress <a href="nav-menus.php">Menus</a> system and create a custom menu container or use the default RT-Theme Footer Navigation container. Add your menu-items to that menu container as explained in the how to "Creating Navigation Menus" section here in the setup assistant.
						<li>Save the menu and <strong>assign</strong> it to a theme menu footer location.</li>
						<li>View your website. If all done correctly it will show the menu in the footer area</li>
					</ol> 
				<div class="sub_title qa">RT-Theme 18 Footer Options</div>
				The RT-Theme 18 footer options can be found here : <a href="admin.php?page=rt_footer_options">show me →</a><br /><br />
				In the RT-Theme 18 footer options one can set the copyright text & number columns to be used in the footer area for displaying widgets just above the copyright & navigation menu.
				The Footer widgets area&#39;s can be found in the Wordpress Admin Appearance Widgets section. <a href="widgets.php">show me →</a>. 
				<br /><br />Any widgets added in the available footer widget 
				area&#39;s container will show in the theme footer area columns in the front of your website.<br /><br />
				<strong>Note</strong> : If you set the footer columns to 3 (1/3) and you add widgets in to the 4th footer widget area container in the Wordpress Admin Appearance Widgets section they will not show.
				<br /><br /><strong>Note for advanced users</strong>  : By using a plugin from wordpress.org which adds widget logic to your widgets you can make widgets in the footer area appear or disappear on a page id basis.
				
				<br /><br />
				
				Also read "How To Creating Navigation Menus" here in the setup assistant. 
				';

		#
		#	Step 21
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Use the Sidebar Creator'; 
		//@$contents->step[$step_count]->single_step = 1;
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'What are Sidebars?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =	'
					<div class="sub_title qa">What are Sidebars?</div>
					Sidebars are containers, area&#39;s, that contain widgets. Widgets are predefined pieces of coding with settings that will display certain information in a website at the location the sidebar is inserted in a page. 
					<br /><br />The Theme has a Sidebar Creator which allows to create unlimited Sidebar Area&#39;s, containers that can contain widgets. Show me → <a href="admin.php?page=rt_sidebar_options">RT-Theme Sidebar Creator</a>
					<br /><br />Sidebar Area&#39;s are empty containers that need to be filled with widgets in the Wordpress Appearance Widget Section. Show me → <a href="widgets.php">Wordpress Widgets Section.</a>
					';
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'What You Need to Know About Sidebars?'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =	'					
					<div class="sub_title qa">Things you need to know about Sidebars?</div>
					<ol>
						<li>The RTTheme-18 comes with a number of default sidebar area&#39;s which can be disabled individually. Show me → <a href="admin.php?page=rt_sidebar_options">RT-Theme Sidebar Creator</a></li>
						<li>Sidebars in RTTheme-18 can be used as :
						<ol>
						<li>regular sidebars listing information (widgets) top down (vertically) when in a template / page / (custom) post the normal sidebar layout template is selected</li>
						<li>template builder sidebars which can list information horizontally (widgets left to right) or vertically (widgets top down). </li>
						</ol>
						</li>
						<li><strong>Note</strong> : A horizontal sidebar can only be created in the template builder by adding a custom sidebar module and settings its column layout to anything other then 1/1.</li>
						<li>The Theme Default Sidebars show always in the Theme Default Predefined Locations :<br /><br />
						   <ul>
								<li>The Common Sidebar will show in <strong>every page</strong> when a <strong>sidebar layout</strong> is selected. The common sidebar will not show in sidebar area&#39;s when a Sidebar Module is added in the template builder unless you have chosen the common sidebar area itself.</li>
								<li>The Sidebar for Products will show in pages or posts which use the "Default Product Template", all product categories and product detail pages</li>
								<li>The Sidebar for Single Products will show in every single product page when the page-layout is set to a sidebar layout.</li>
								<li>The Sidebar for Blog will show in pages or posts which use the "Default Blog Template", all blog categories and single post pages</li>
								<li>The Sidebar for Blog Single Post will show in every single blog post page when the page-layout is set to a sidebar layout. </li>
								<li>The Sidebar for Blog categories will show in every single blog category listing page when the page-layout is set to a sidebar layout. </li>
								<li>The Sidebar for Pages will show in every page when the page-layout is set to a sidebar layout</li>
								<li>The Sidebar for Portfolio will show in pages or posts which use the "Default Portfolio Template", all portfolio categories and single portfolio item pages.</li>
								<li>The Sidebar for Single Portfolio will show in every single portfolio page when the page-layout is set to a sidebar layout.</li>
								<li>The Sidebar for First Top Widget Area will be displayed next, below or before the logo depending on the settings chosen in the theme header options. </li>
								<li>The Sidebar for Second Top Widget Area will be displayed next, below or before the logo depending on the settings chosen in the theme header options. </li>
								<li>The Sidebar for Tags show in the Tags listing pages when the global theme page-layout is set to a sidebar layout. </li>
								<li>The Sidebar for Archives will show in the archive pages when the global theme page-layout is set to a sidebar layout.</li>
								<li>The Sidebar for Woocommerce will show in WooCommerce related pages when the page-layout is set to a sidebar layout. </li>
								<li>The Sidebar for Search Results will show in the Search result when the global theme page-layout is set to a sidebar layout. </li>
								<li>The Sidebar for Footer (column 1 to 5) will show in each of the corresponding footer columns depending on the theme footer settings.</li>
								<li>The Sidebar is a Area, a container, that needs to be filled with widgets in the wordpress appearance widget section. Show me → <a href="widgets.php">Wordpress Widgets Section.</a></li>
						   </ul>
						</li>
						<li>Row modules in the template builder each can have a different (floating) sidebar (new feature or RTTheme 18)</li>
						<li>A vertical sidebar does not have to be listed information vertically all across the page body content. Within a row module it can be limited to a certain section of the page (new feature or RTTheme-18)</li>
						<li>You can have as much sidebars as you want.</li>
					</ol>
					

					The Sidebar creator can be found in the RTTheme -18 Theme settings. Show me → <a href="admin.php?page=rt_sidebar_options">RT-Theme Sidebar Creator</a>
				';
				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Creating Custom Sidebar Containers / Area&#39;s'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =	'
					<div class="sub_title qa">Creating Custom Sidebar Containers / Area&#39;s</div>
					The Sidebar Creator gives you the ability to create custom sidebars (information areas driven by widgets) for your web pages. Area&#39;s that contain specific information for only one page or group of pages.
					<br /><br />The Sidebar is a Area, a container, ready to be filled with widgets in the Wordpress Appearance Widgets section. Show me → <a href="widgets.php">Wordpress Widgets Section.</a>
					<br /><br />
					<div class="sub_title qa">How To Create a Custom Sidebar Area?</div>
					For example: If you would like to put a Text Widget (or any other widget) for your Contact Us Page only. Here are the steps to do so :<br /><br />
					<ol>
						<li>Go to the Sidebar Creator. Show me → <a href="admin.php?page=rt_sidebar_options">Sidebar Creator</a></li>
						<li>Scroll to the bottom of the Sidebar Creator page and enter a name for your new Sidebar & click the "Create" button.</li>
						<li>Once you have created your custom sidebar you will see it listed in the Wordpress Appearance Widgets Page as a Widget Area, a container, with the name you just gave it, ready to be filled with widgets.</li>
						<li>Goto the wordpress appearance widgets page and add a new Text Widget to your Custom Sidebar Area. Show me → <a href="widgets.php">Wordpress Widgets Section.</a></li>
						<li>Goto The Template builder and open the default Contact Template by clicking the edit button. Show me → <a href="admin.php?page=rt_template_options">The Template Builder.</a></li>
						<li>Within the Contact Template go to the &#39;First Content Row&#39; open it by clicking on the &#39;show row options&#39; and in the Sidebar (widget Area) select your new custom sidebar.</li>
						<li><strong>Do not forget to set &#39;Sidebar Location&#39; (layout) of the Row to type Left or Right Sidebar.</strong> Otherwise the sidebar will not show.</li>
					</ol>
				'; 
						  

		#
		#	Step 22
		#
		$step_count++;
		@$contents->step[$step_count]->number = "How To"; 
		@$contents->step[$step_count]->title  = 'Update Revolution Slider & Layer Slider Plugins'; 

				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Update Revolution Slider Plugin'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =	" 

						Follow these steps to update the plugin;<br />

						1) Go to Revolution Slider and click the \"Manual Plugin Update\" screenshot at the bottom.<br />

						2) Unzip the rttheme18.zip into your computer<br />

						3) You can find the latest version of the plugin inside the /rttheme18/rt-framework/plugins/packages/ folder as revslider.zip<br />

						Then click the update slider button. 


				"; 


				$content_count ++;				
				@$contents->step[$step_count]->contents[$content_count]->content_title 	= 'Update Layer Slider Plugin'; 				
				@$contents->step[$step_count]->contents[$content_count]->content  =	" 

						Go to plugins page and simply deactivate and remove (delete) the old version of the Layer Slider plugin. Once you have removed you'll notify with a message like this \"This theme requires the following plugin: Layer Slider.\" at top of the page. Then you can follow the screen instructions to install the new version

				"; 
											


		echo '<br /><div id="rt_setup_assistant">';
		
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