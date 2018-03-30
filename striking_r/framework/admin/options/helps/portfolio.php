<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title">STRIKING PORTFOLIO PANEL</h2>
<p align="justify">This Portfolio Panel is &#34;central command&#34; for portfolio functionality in the website.  &nbsp;The Portfolio Panel provides a &#34;set and forget&#34; type functionality for various portfolio settings. &nbsp;However, many of these settings have an overide in either the The Portfolio Post Setup & Options Metabox (found in the portfolio post admin panel) or the portfolio shortcode, thus allowing for case by case individualization as circumstances warrant. &nbsp;The panel settings are for such matters as determining what appears in a portfolio list, the height of the thumbnail image, the default lightbox sizes for different media types when a thumbnail is clicked upon and the default behavior of various elements for the single post page.</p>
<p align="justify">There are 9 resource tabs for control of the the various portfolio related functions on a site wide basis. &nbsp;It is helpful to quickly review them in order to assist with understanding all the functionality available in portfolio building. But all have default settings so that work can commence creating portfolios without worrying about having to set each feature, and come back and customize later as required. &nbspSome resource tabs will have a <b>&#34;Help Information&#34;</b> link which opens a help dialogue of information on the functions within the resource tab, and most settings possess a help field when explanation of the setting is warranted.</p>

HTML;

$screen->add_help_tab( array(
	'id'      => 'portfoliopanel',
	'title'   => __( 'Striking Portfolio Panel' , 'theme_admin' ),
	'content' => $help,
) );

// Help tabs

$help  = '<p>' . __('<h2 class="theme_help_title">INTRODUCTION</H2>
<p align="justify">A portfolio item is a custom post type created especially for the Striking MultiFlex theme. &nbsp;Its purpose is to allow for creation of varied types of media content that can be displayed in condensed form via a list, and each list item may by choice lead to a full post webpage containing additional content.  &nbsp;The full post can contain expanded descriptive content fully customized as desired. &nbsp;So a portfolio &#34;Item&#34; is simply a post, and like a blog post, it can have short form display (lists, widgets) and long form display with as much content as needed.</p>
<h3>Difference between a Portfolio List and a WP Gallery</h3>
<p align="justify">There is often confusion between a portfolio post and a wp gallery. &nbsp;In fact as noted a portfolio post is a post type in wordpress, whereas a gallery is a display of images and is not a post type at all.  &nbsp;But a portfolio list can consist simply of a group of images, identical on first appearence to a wp gallery and as a result this often confuses people upon the differences between them. &nbsp;So here is some of the key differences: <ol>
<li>A portfolio list can (in MultiFlex) be used to display many types of media including images, audio tracks, different types of videos, pdfs, and more, whereas a wp gallery can display only images;</li>
<li>There can be many different portfolio lists in the body content of a page or post and each be restricted by lightbox grouping whereas if there are  multiple wp galleries inserted in a page, they will group automatically into one lightbox if the &#34;Link to Media File&#34; option has been selected in the wp gallery creation options.</li>
<li>Portfolio lists allow for display be categories and can be filtered and ordered by a very wide range of parameters to display only certain portfolio categories or individual items whereas a wp gallery has no filtering other then the ability to select specific images from the media library.</li>
<li>Each item in a portfolio list can have a caption, a title, a read more button, and excerpt content just like each post in a blog list, whereas a WP Gallery can have only images with captions. &nbsp;Furthermore, the thumbnail image, and read more button for the same item can have different linking actions, none of which is possible with the wp gallery. </li>
<li>The thumbnail image appearing in a portfolio list can perform many functions such as opening a lightbox that displays many types of media, or be a direct link to a page, post or outside url.  &nbsp;An image in a wp gallery can only be static (ie a non-active image just sitting in the page content), open to a bigger version of itself in a lightbox, or open to the image attachment page.</li>
</ol>
<p align="justify">Due to the above characteristics the key positive to portfolios is that they are a huge leap in flexibility for display of mixed media content. &nbsp;The negative of portfolios is that creation is slightly more time consuming, thus making larger portfolio lists requires the creation of many portfolio items, whereas a simple image gallery can be quickly created by grabbing some images from the media library. &nbsp;Creating portfolios requires a greater time investment with the tradeof being much greater utilty and flexibility for display of the content.</p>
<h3 align="center">Portfolio Types and General Information</H3>
 <p align="justify">There are <u>8 different Portfolio Types</u> available in Striking designed to fulfill every conceivable portfolio display requirement.  &nbsp;The <b>Set the Portfolio Type of this Post</b> setting in the <b>Portfolio Post Metabox</b> has a detailed help field discussing the 8 types and the use for each.  &nbsp;After selecting a type in the setting dropdown field its corresponding admin tab (left of that setting dialogue) will become active and this is where the specific settings for that portfolio type can be adjusted.</p>
<p align="justify"><u>Please note it is necessary to set a featured image, and give the portfolio item a title</u> for all Portfolio Types. &nbsp;The Portfolio Type choice determines the action of the featured image thumbnail when selected by a site viewer - it will either open a lightbox with content or transport the website viewer somewhere else in the site, or even to an external url.</p>
<p align="justify">Striking MultiFlex does not restrict portfolio display to a special page template, the case with most themes.  &nbsp;In MultiFlex, a portfolio list can be inserted in any page or post content, and can range in size from just one item in the list to as many as desired. &nbsp;All the settings for creating a list/display of portfolio items in any webpage are found in the portfolio shortcode, and some portfolio behaviours can be standardized sitewide for lists or the post page by way of settings in the panel below. <span style="color:#0c4892">There are no practical display limits for portfolio lists or portfolio items in MultiFlex.  &nbsp;A page can have just one instance of the portfolio shortcode, or it can have 10 separate instances (ex- each list only displays one category). &nbsp;A website built with Striking MultiFlex can have an unlimited number of portfolio lists, and portfolio items.</span></b></p>
<p align="justify">Unless otherwise stated all portfolio list thumbnail images open into a lightbox. &nbsp;In some instances it is possible to set a custom lightbox size in a Portfolio Type tab that will override the defaults found in the <b>Lightbox Dimension Tab</b> below wherein are set the theme defaults for the various portfolio lightbox types.</p>  
<p align="justify">Finally, the portfolio items grouped into a portfolio category are entirely determined by choice -> a portfolio category may be used to group same type items or it can have a mixed group of portfolio types - there are no restrictions of any sort as to what portfolio items are placed into any portfolio category.  &nbsp;Portfolio Categories are like shelves in a bookcase, what is put in them and how they are organized is all according to choice and convenience. &nbsp;The Portfolio Shortcode is used to display the portfolio items, grouped by category(s), or selected individually, as part of the content.</p>').'</p>';

$screen->add_help_tab( array(
	'id'      => 'allaboutportfolio',
	'title'   => __( 'Portfolios Explained' , 'theme_admin' ),
	'content' => $help,
) );

$help  = '<p>' . __('<h2 class="theme_help_title">FEATURED AND THUMBNAIL IMAGES</H2>
<p align="justify">Very simply, <u>a &#34;Featured Image&#34; is an image that is automatically associated with a post or page.</u> &nbsp;It is an image that wordpress displays along with the post, in various formats whether a widget, or a full webpage, as long as a theme supports the functions necessary for displaying a featured image. &nbsp;It if often described as the visual &#34;headline&#34; for a post.</p>
<p align="justify">Striking provides the ability to display a featured image with all post types in the theme. &#34;When landing on a single post webpage, the featured image can be shown in its maximum displayable size (which may be smaller then its actual size). &nbsp;<u>When the featured image is shown in a list using a shortcode, or in a widget, it is referred to as the &#34;thumbnail&#34; meaning that it is smaller version of the featured image.</u></p>
<h4>Featured Images and the WP Auto Resizing function</h4>
<p align="justify">Featured image sizing sometimes seems complicated as whether being displayed in a post or in a thumbnail, each of these image spaces has a different dimension (W x H) and if the uploaded image does not conform to the dimensions of all space allotted for it, or at least be in the same ratio of W x H, then wordpress automatically  crops and scales the image to fit the space. &nbsp;The wp auto resizing functions for slotting an image into any sized space are intended to be helpful, but they often result in an image either losing some relevant portion, or it being scaled upwards (as the image is smaller then the alloted space) resulting in artifacting and blurriness.</p>
<p align="justify">To stop the wp auto resizing from being an issue (it is frowned upon to actually disable and other facets of the wp resizing functions are beneficial) the Striking post and shortcode functions have help fields listing the correct featured image sizing.</p>
<h4>Featured Images Options</h4>
<p align="justify">Also available in Striking are settings to turn off the display of the featured image in the single post, so that if a better quality or differently sized image is available, it can be inserted into the single post content by using the image shortcode.</p>
<p align="justify">Another portfolio scenario -> if the featured image was loaded solely to be the thumbnail image in post list for an audio, video or document portfolio item, then it is likely not desirable to have the featured image show in the single post webpage, so the ability to turn off the featured image for these scenarios allows removal of an unnecessary piece of content.</p>
<p align="justify">Finally, in Striking the featured image can be edited at any time via the built-in wp media editor to create a unique thumbnail size for post widgets which have square thumbnails, and the Striking video library has a video on Editing Media for Widget Thumbnails to guide on this matter.</p>
<p align="justify">In summary, Striking has a very signficant array of featured image abilities to compliment the various portfolio and blog display options available in the theme.  &nbsp;The help fields and videos are guides to sizing featured images and their thumbnails correctly. &nbsp;The portfolio and blog shortcode help fields list the featured image sizes as do the correct settings in the Portfolio and Blog Panels. <font  color="Red"><b>So it is suggested, prior to uploading a featured image, one should decide the type of portfolio or blog list array (1 column, 2 column, etc) for which the post is being created, and and check the array help to confirm the correct featured image dimensions for the <i>Set Featured Image</i> function in the post creation so that it&#180;s thumbnail version appearing in the list is resized correctly.</b></font></p>

</p>', 'theme_admin' ).'</p>';

$screen->add_help_tab( array(
	'id'      => 'featuredimagesexplained',
	'title'   => __( 'Featured & Thumbnail Images Explained!' , 'theme_admin' ),
	'content' => $help,
) );




$help  = '<p>' . __('<h2 class="theme_help_title">PORTFOLIO ITEM DISPLAY</H2>
<p align="justify">There are 2 steps to showing a portfolio in a webpage: creating some portfolio items, and then using the Portfolio Shortcode in the content editor to call them up for display in a webpage (a &#34;portfolio list&#34;):</p>
<h3>Portfolio Item Creation</h3>
<p align="justify">Creating a portfolio item is very straightforward:
<ol>
<li>Go to Portfolio items-> Add New in the WP admin menu.</li>
<li>Give the Item a title.</li>
<li>Categorize the Item using the <b>Portfolio Categories</b> metabox settings found to the right of the editor.</li>
<li><p>Set a Featured Image using the metabox for this purpose again found to the right of the content editor.  This image will show as the thumbnail image in the portfolio items list. &nbsp;It is important at this stage to have reviewed the <b>Height of Thumbnail Tab</b> below for the thumbnail image size as it varies depending on the number of columns one and whether a full width or sidebar page template.  &nbsp;The featured image loaded should be the same size or larger, and in the same size ratio so that it does not get cropped by the image resizing script.</p>
<p>An example: The featured image size for a one column portfolio in a sidebar page is 600px wide and the theme default height is 350px (which can be adjusted), this is an aspect ratio of 1.71:1. &nbsp;So the featured image should be at least this size or larger, and maintain the same aspect ratio. &nbsp;A featured image of 1200 x 700 would be fine as the aspect ratio is still 1.71:1, and would resize downwards by wordpress to the thumbnail size correctly, but an image of 1200 x 900 would crop (the aspect ratio is 1.33:1) and in the thumbnail a portion of the height would be shaved off distorting the image. &nbsp;If the image was smaller then 600 x 350, it would be magnified by the wp image resizing script and appear fuzzy as a result. &nbsp;The worst option is an image that is both too small and an incorrect aspect ratio as it will both distort in resizing and be cropped!</p></li>
<li>Use the settings in the <b>Portfolio Post Setup & Options Metabox</b> to determine the type of portfolio item, and configure via the appropriate settings. &nbsp;All the settings have very detailed help fields to guide to the appropriate choice(s)(most media can be displayed more then one way and is according to design choice).</li>
<li>Add detail of the portfolio to the content editor. &nbsp;Portfolio posts also have an Excerpt module for creating description content that will only appear in the portfolio list. &nbsp;Choose either or both and fill with content as appropriate. &nbsp;If the Excerpt Metabox is not visible in the <b>Add New Portfolio Item</b> panel, then click on the <b>Screen Options</b> Tab in the upper right hand corner of the url window which will drop down a panel where there are visibility controls for various metaboxes.</li>
<li>Once done, click on the <b>Publish</b> button and the portfolio item has been created.</li>
</ol>
<p align="justify">The process is very straightforward as long as it is rememberered to size the featured images correctly (see the <b>Portfolio Lists -> Thumbnail Height Settings Tab below)</b>and after performing a few times, portfolio items typically take less then a minute to create.</p>
', 'theme_admin' ) .'</p>';

$screen->add_help_tab( array(
	'id'      => 'portfoliocreation',
	'title'   => __( 'Creating Portfolios' , 'theme_admin' ),
	'content' => $help,
) );



$help  = '<p>' . __('<h2 class="theme_help_title">SHOWING THE PORTFOLIOS</h2>
<p align="justify">After creating some portfolio items we use the portfolio shortcode to embed them in the content of any page or post:
<ol>
<li>Open a page or post to edit (or create a new one)</li>
<li>Go to the shortcode button in the content editor and click on the porfolio shortcode - it will open a dialogue box with the settings for use to configure a portfolio list.  &nbsp;After configuring the settings the shortcode dialogue has a preview button at the bottom which will show how the portfolio will appear in the page. &nbsp;Make any adjustments and then click the <b>Insert</b> button and the portfolio shortcode string will be inserted into the content editor.</li>
<li>Publish the page and all done!</li>
</ol></p>
<h3>The Shortcode String</h3>
<p align="justify">At first, the shortcode string will appear fairly incomprehensible, but experience has shown that users soon start to recognize the shortcode elements, and even just generate them from memory as time progresses. &nbsp;Following are some sample shortcode strings:</p>
<p> - Show a portfolio items list without page navigation:	<code>[portfolio nopaging="true"]</code><br />
This would result in every portfolio item created showing in the one webpage, probably not a desired outcome unless there are only a few.</p>
<p> - Show the portfolio items list sorted with specific categories: <code>
[portfolio cat="document,image" sortable="true"]</code><br />
This would result in a portfolio display having two tabs, each tab being one of the categories and displaying in that tab all the portfolio items assigned to that category.</p>
<p> - Following is a more typical portfolio string one will generate, as it has more of the shortcode settings in effect:<br /> <code>[portfolio column="5" height="275" effect="zoom" max="15" sortable="true" ajax="true" cat="document,image, video,audio" current="image" orderby="author" order="DESC" titleLinkable="true" titleLinkTarget="_blank" desc_length="75" advanceDesc="true" more="true" moreButton="true" lightboxTitle="imagecaption"] </code><br /><br />
Here is what is going on in this string:<ul>
<li><code>portfolio column="5"</code> This is a 5 column portfolio  -> <i>Column</i> setting</li>
<li><code>height="275"</code> with a custom image height of 275px -> <i>Thumbnail Height</i> setting</li>
<li><code>effect="zoom"</code> and an image hover effect of Zoom -> <i>Thumbnail Image Effect</i> setting</li>
<li><code>max="15"</code> which will only show max 15 portfolio items after which it paginates -> <i>Pagination Amount</i> setting</li>
<li><code>sortable="true"</code> the categories will be tabbed -> <i>Enable Sortable Tabbing</i> setting</li>
<li><code>ajax="true"</code> transitions when someone clicks on a category tab will be via ajax -> <i>Ajax Sorting Effect</i> setting</li>
<li><code>cat="document,image, video,audio"</code> the categories selected for display are the document, image, video and audio categories -> <i>Category(s)</i> setting</li>
<li><code>current="image"</code> the category that will display when one first lands on the page is the image category thumbnails -> <i>Current Tab</i> setting</li>
<li><code>orderby="author"</code> the actual portfolio items appearing in each category will be ordered by the author who created them -> <i>Portfolio Items Sorting Parameter</i> setting</li>
<li><code>order="DESC"</code> the author alphabetical sorting order will be descending alphabetical form -> <i>Ascending or Descending Order</i> setting</li>
<li><code>titleLinkable="true"</code> the portfolio item title appearing below the thumbnail image will be an active link to the single post webpage -> <i>Title Linkable</i> setting</li>
<li><code>titleLinkTarget="_blank"</code> the portfolio post will open in a new tab -> <i>Title Link Target</i> setting</li>
<li><code>desc_length="75"</code> this indicates that the portfolio excerpt will show a maximum of 75 characters -> <i>Description Length</i> setting</li>
<li><code>advanceDesc="true"</code> shortcodes used in the excerpt field will show correctly in the portfolio list item descriptions -> <i>Enable Shortcode Support in Description Text</i> setting</li>
<li><code>more="true"</code> this short string means that the Read More Text will show -> <i>Display Read More Text</i> setting</li>
<li><code>moreButton="true"</code> this indicates that the Read More Text will be shown within a button -> <i>Display Read More as Button</i> setting</li>
<li><code>lightboxTitle="imagecaption"</code> when a lightbox is opened for any portfolio item in the display the caption of the lightbox will be from the caption field of the media, versus the other options of the media title, or the media description, or nothing at all -> <i>Lightbox Caption Options</i> setting</li>
</ul></p>
<p align="justify"><b>HINT -</b>&nbsp;&nbsp;If a portfolio string has been set it is decided to change an option, it is not necessary to generate a whole new string of all the settings again. &nbsp;Instead, generate a new portfolio string consisting of just the option needed, and then cut and paste it into the existing string (and don&#180;t forget to delete what is left of the unneeded new portfolio shortcode). &nbsp;This is the quick cheat method to rapid changes to a portfolio shortcode when working to refine the look to exactly what is needed.</p>
<p align="justify"><b>ANOTHER HINT -</b>&nbsp;&nbsp;There are many options to customize the appearence of the portfolio list -> the <b>Color</b> and <b>Font</b> Panels both have settings applicable to portfolio display: there are 9 color settings and 2 font size settings specific to portfolio lists.</p>
', 'theme_admin' ) .'</p>';

$screen->add_help_tab( array(
	'id'      => 'portfolioshow',
	'title'   => __( 'Displaying Portfolios in the Website' , 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/admin.php');
include('blocks/support.php');
include('blocks/sidebar.php');