<?php
return array(
	"title" => __("Portfolio", "theme_admin"),
	"shortcode" => 'portfolio',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Column",'theme_admin'),
			"desc" => __("One can diplay up to 8 columns in a portfolio list. &nbsp;It is important to remember that the dimensions of the thumbnails will be as per what has been set in the <strong>Portfolio Panel/Height of Thumbnail tab/Column</strong> settings.<br /><br />The widths per column for both a full page, and a page with sidebar are:<br /><br />
FULL PAGE PORTFOLIO FEATURED IMAGE (FI) WIDTHS ARE:<br />
1 Column FI width = 600px<br />
2 Column FI width = 450px<br /> 
3 Column FI width = 292px<br />
4 Column FI width = 217px<br />
5 Column FI width = 170px<br />
6 Column FI width = 138px<br />
7 Column FI width = 118px<br />
8 Column FI width = &nbsp;97px<br />
<br />
PAGE WITH SIDEBAR PORTFOLIO FEATURED IMAGE WIDTHS ARE:<br />
1 Column Page w/Sidebar FI width = 400px<br />
2 Column Page w/Sidebar FI width = 293px<br />
3 Column Page w/Sidebar FI width = 188px<br />
4 Column Page w/Sidebar FI width = 136px<br />
5 Column Page w/Sidebar FI width = 108px<br />
6 Column Page w/Sidebar FI width =  &nbsp;88px<br />
7 Column Page w/Sidebar FI width =  &nbsp;70px<br />
8 Column Page w/Sidebar FI width =  &nbsp;61px.<br /><br />The height is per what has been set for the respective column in <strong>Portfolio Panel/Height of Thumbnail</strong> settings. &nbsp;However one can set a custom height specific to the images displayed in this portfolio listing using the <strong>Thumbnail Height</strong> setting below.",'theme_admin'),
			"id" => "column",
			"default" => '4',
			"options" => array(
				"1" => sprintf(__("%d Column",'theme_admin'),1),
				"2" => sprintf(__("%d Columns",'theme_admin'),2),
				"3" => sprintf(__("%d Columns",'theme_admin'),3),
				"4" => sprintf(__("%d Columns",'theme_admin'),4),
				"5" => sprintf(__("%d Columns",'theme_admin'),5),
				"6" => sprintf(__("%d Columns",'theme_admin'),6),
				"7" => sprintf(__("%d Columns",'theme_admin'),7),
				"8" => sprintf(__("%d Columns",'theme_admin'),8),
			),
			"type" => "select",
		),
		array (
			"name" => __("Thumbnail Height (Optional)&#x200E;",'theme_admin'),
			"desc" => __("The <strong>Striking Portfolio Panel/Height of Thumbnail</strong> tab is where one sets the theme default height of the thumbnail image for each portfolio column display option.<br /><br />However, there could be circumstances where one desires to override the standard portfolio thumbnail height which is accomplished by the pixel height selector below.",'theme_admin'),
			"id" => "height",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Thumbnail Image Effect",'theme_admin'),
			"desc" => __("The theme provides a wide variety of effects for when a cursor hovers over the images in the portfolio list. &nbsp;Choose one from the dropdown selector below.<br /><br /><u>NOTES</u> &nbsp;:<br />Grayscale -> Internet Explorer does not currently support grayscale by the CSS3 technique used in this theme so no effect will show - in the IE browsers the viewer will only see the thumbnail image without any effect.<br /><br />Blur -> is only supported by webkit browsers Chrome and Safari. &nbsp;If using Blur there would be no image effect in Firefox or Internet Explorer. &nbsp;It is thought Firefox may eventually be adding the necessary CSS3 support enabling the blur ability.<br /><br />Default -> in the <strong>Portfolio Panel/General Options tab</strong> there is an Effects setting for enabling a default effect behaviour for all portfolio lists in the site.",'theme_admin'),
			"id" => "effect",
			"default" => 'icon',
			"options" => array(
				"icon" => __("Icon",'theme_admin'),
				"grayscale" => __("Grayscale",'theme_admin'),
				"blur" => __("Blur",'theme_admin'),
				"zoom" => __("Zoom",'theme_admin'),
				"rotate" => __("Rotate",'theme_admin'),
				"morph" => __("Morph",'theme_admin'),
				"tilt" => __("Tilt",'theme_admin'),
				"none" => __("None",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Page Layout",'theme_admin'),
			"desc" => __("Choose the page type the portfolio shortcode is being used within. &nbsp;The theme core code for the portfolio layout of the columns depends upon the page width --> full width or with sidebar, so the purpose of this setting is to trigger the appropriate theme code for the page type in which the portfolio shortcode is placed.",'theme_admin'),
			"id" => "layout",
			"default" => 'full',
			"options" => array(
				"full" => __("Full Width",'theme_admin'),
				"sidebar" => __("With Sidebar",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Disable Portfolio Pagination",'theme_admin'),
			"id" => "nopaging",
			"desc" => __("By default a portfolio list automatically paginates and the number of portfolio items displaying in a webpage is per the <strong>Pagination Amount</strong> setting below. <br /><br />However, if this Disable Portgolio Pagination toggle is set to &#34;ON&#34;, pagination will be disabled and all the portfolio posts of the selected portfolio category(s) chosen for display via the <strong>Category(s)</strong> setting below will show in the single webpage.<br /><br />NOTE : So if one desires pagination, leave this setting in the &#34;OFF&#34; position.",'theme_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Pagination Amount",'theme_admin'),
			"desc" => __("This setting determines the number of portfolio items to show per webpage when one is paginating the portfolio list.",'theme_admin'),
			"id" => "max",
			"default" => '-1',
			"min" => -1,
			"max" => 50,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Enable Sortable Tabbing",'theme_admin'),
			"id" => "sortable",
			"desc" => __("If the option is &#34;ON&#34;, then a tab with the category name will appear for each category chosen to appear in the portfolio list. &nbsp;Within each tab will appear only the portfolio items assigned to that category. <br /><br />So this setting is very useful for creating &#34;visual&#34; divisions by tab effect when displaying multiple categories in a portfolio listing. ",'theme_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Show &#34;All&#34; Tab",'theme_admin'),
			"id" => "sortable_all",
			"desc" => __("If the option is &#34;ON&#34;, an &#34;ALL&#34; tab will display and this tab will contain all the portfolio items of all the portfolio categories one has selected for inclusion into the portfolio list.",'theme_admin'),
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Sortable &#34;Show&#34; Text<br />Option",'theme_admin'),
			"desc" => __("If using Sortable Tabbing, the tabs are preceeded by some text, and the default text is &#34;Show&#34;. &nbsp;However, the text can be changed to any word(s) desired by removing the word &#34;Show&#34; from the field below and typing in different text.",'theme_admin'),
			"id" => "sortable_showText",
			"default" => theme_get_option('portfolio','show_text'),
			"type" => "text",
		),
		array(
			"name" => __("Ajax Sorting Effect",'theme_admin'),
			"id" => "ajax",
			"desc" => __("Ajax is a combination of CSS and Java code that enables a nice visual sorting effect when going from tab to tab if one is utilizing the Sortable Tabbing feature. &nbsp;Individual portfolio items will appear to slide and sort as one clicks on a category tab. &nbsp;We normally recommend enabling ajax when using Sortable Tabbing.",'theme_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Category(s) (Optional)&#x200E;",'theme_admin'),
			"desc" => __("One can have one or multiple categories display using this shortcode.  &nbsp;Choose multiple categories in the field below the same way one selects multiple items on a desktop - hold down the Ctrl key on the keyboard while using the mouse to click on the desired categories.<br /><br />HINT :&nbsp; This portfolio shortcode can also be used to display just one portfolio item - this is achieved by either using the <strong>Custom Select Items</strong> setting below, or by assigning only one portfolio item to a category, and then choosing that category in this setting!<br /><br />NOTE :&nbsp; If this setting is left blank, all portfolio items created will display by default. &nbsp;They will only be sorted into categories if one has enabled Sorted Tabbing above.  If one has not enabled the Sorted Tabbing, they will simply all display and their order will be per the two order settings found below.",'theme_admin'),	
			"id" => "cat",
			"default" => array(),
			"chosen" => true,
			"target" => 'portfolio_category',
			"prompt" => __("Click Here to Select Categories..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Current Tab (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If using Sortable Tabbing, one has the option to determine which will be the open &#34;current&#34; tab showing to the viewer upon page load. &nbsp;Select the category to be the current tab from the field below (click in the field and it will show a scrolling dropdown list).",'theme_admin'),
			"id" => "current",
			"default" => array(),
			"chosen" => true,
			"target" => 'portfolio_category',
			"prompt" => __("Select the Current Category..",'theme_admin'),
			"type" => "select",
		),
		array(
			"name" => __("Custom Select Portfolio <br />Items (Optional)&#x200E;",'theme_admin'),
			"desc" => __("In the dropdown field below is a list of all the portfolio items created for the website. &nbsp;This setting allows one to choose specific items: one only, or a custom grouping by using the Ctrl key + mouse, to show in the portfolio list. ",'theme_admin'),
			"id" => "ids",
			"default" => array(),
			"chosen" => true,
			"target" => 'portfolio',
			"prompt" => __("Select Individual Porfolio Items..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Portfolio Items <br />Sorting Parameter",'theme_admin'),
			"desc" => __("For all the portfolio items one is choosing to show (irrespective of whether Sortable Tabbing is active), there are two sorting options for the order in which they display. &nbsp;This setting concerns the primary sorting parameter which include sorting by: date, author, wp id number, comment count, etc. &nbsp;There are 10 parameters in total.",'theme_admin'),
			"id" => "orderby",
			"default" => 'menu_order',
			"options" => array(
				"none" => __("No order",'theme_admin'),
				"id" => __("Order by post id",'theme_admin'),
				"author" => __("Order by author",'theme_admin'),
				"title" => __("Order by title",'theme_admin'),
				"date" => __("Order by date",'theme_admin'),
				"modified" => __("Order by last modified date",'theme_admin'),
				"parent" => __("Order by post/page parent id",'theme_admin'),
				"rand" => __("Random order",'theme_admin'),
				"comment_count" => __("Order by number of comments",'theme_admin'),
				"menu_order" => __("Order by Page Order",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Ascending or Descending<br />Order",'theme_admin'),
			"desc" => __("Designates the ascending or descending order of the Portfolio Items within the primary parameter chosen in the above setting.  Ascending order is oldest first and Descending order is newest first, of the primary parameter selected above.",'theme_admin'),
			"id" => "order",
			"default" => 'ASC',
			"options" => array(
				"ASC" => __("ASC (ascending order)",'theme_admin'),
				"DESC" => __("DESC (descending order)",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Display Portfolio Item<br />Title",'theme_admin'),
			"id" => "title",
			"desc" => __("If the option is &#34;ON&#34;, the title of each portfolio item will display below the thumbnail image (1 column portfolio lists have the title display beside the image rather then below it).",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Title Linkable",'theme_admin'),
			"id" => "titleLinkable",
			"desc" => __("If this option is &#34;ON&#34;, the portfolio item title will be an active link to the portfolio single post webpage. &nbsp;Of couse this setting only works if one has chosen to display the portfolio item titles via the setting above.",'theme_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Title Link Target",'theme_admin'),
			"id" => "titleLinkTarget",
			"default" => '_self',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"_blank" => __('Load in a new window','theme_admin'),
				"_self" => __('Load in the same frame as it was clicked','theme_admin'),
				"_parent" => __('Load in the parent frameset','theme_admin'),
				"_top" => __('Load in the full body of the window','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Display Portfolio Item<br />Excerpt/Description",'theme_admin'),
			"id" => "desc",
			"desc" => __("If the option is &#34;ON&#34; then the Portfolio Excerpt of each portfolio item will be displayed below the portfolio item image (and below the title if the title option above is activated).<br /><br />If the Portfolio Excerpt field is empty, it will fallback to display instead the content of the main wp editor field of the single portfolio post (if you have entered any content into it).<br /><br />If you have no content in either the excerpt field or the main content editor, then nothing will display.",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Description Length",'theme_admin'),
			"desc" => __("You can set the number of characters -> this includes blank spaces, that you will show of the portfolio item excerpt/description for each item appearing in your portfolio list.&nbsp;&nbsp;The maximum number of characters is 200.&nbsp;&nbsp;Please note that this setting does not work if you have the <b>Enable Shortcode Support in Description</b> setting below <em>ON</em>.",'theme_admin'),
			"id" => "desc_length",
			"default" => '0',
			"min" => 0,
			"max" => 200,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Enable Shortcode Support<br />in Description Field",'theme_admin'),
			"id" => "advanceDesc",
			"desc" => __("If the option is &#34;ON&#34;, one can use shortcodes in the Excerpt and post editor fields and the shortcodes will be also work properly in the description display of each portfolio item in the portfolio list.  If the setting is <em>OFF</em>, simple html tags will work, but actual shortcodes (for example typography shortcodes), will not work.",'theme_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Display &#34;Read More&#34;<br />Text",'theme_admin'),
			"id" => "more",
			"desc" => __("If the option is &#34;ON&#34;, the &#34;Read More&#34; text will display as an active link so that a viewer can click on it with their mouse (or finger on a mobile device) to go to the portfolio post webpage. &nbsp;As this is a tritoggle setting, there is a default setting for the Read More text one can set in the <strong>Portfolio Panel/Portfolio General</strong> tab.",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Customize Read More<br />
Text",'theme_admin'),
			"id" => "moreText",
			"desc" => __("If one has set the <strong>Read More Text</strong> to display above, then with this setting one can change the text to some other wording.",'theme_admin'),
			"default" => theme_get_option('portfolio','more_button_text'),
			"type" => "text",
		),
		array(
			"name" => __("Display &#34;Read More&#34;<br />as button",'theme_admin'),
			"id" => "moreButton",
			"desc" => __("Normally, if the &#34;Read More&#34; text is enabled above, it displays as text in a format similar to how a tag displays, but if this setting is toggled &#34;ON&#34; then the Read More text (or the custom text set above) will display within a button.<br /><br />As this is a tritoggle setting, there is a default option for the Read More button one can set in the <strong>Portfolio Panel/Read More</strong> tab.",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Lightbox Grouping of<br />Featured Images",'theme_admin'),
			"id" => "group",
			"desc" => __("If the option is &#34;ON&#34;, a user will be able to transition from one portfolio item to the next without having to click on each portfolio list item -> the lightbox will display left and right arrows so that the viewer can use them for navigation between list items while in the open lightbox.",'theme_admin'),
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Lightbox Caption Options",'theme_admin'),
			"id" => "lightboxTitle",
			"desc" => __("When a lightbox is open, one can choose what will be displayed in the caption field of the lightbox. &nbsp;Choose one of the 5 options from the dropdown selector below. ",'theme_admin'),
			"default" => 'portfolio',
			"options" => array(
				"portfolio" => __("Portfolio Title",'theme_admin'),
				"image" => __("Image Title",'theme_admin'),
				"imagecaption" => __("Image Caption",'theme_admin'),
				"imagedesc" => __("Image Description",'theme_admin'),
				"none" => __("None",'theme_admin'),
			),
			"type" => "select",
		),
	),
);
