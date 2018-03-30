<?php
$screen = get_current_screen();

$help = <<<HTML
<h2 class="theme_help_title"><b>STRIKING MULTIFLEX ADMIN OVERVIEW</b></h2>
<h3 align="center"><i><font color="#DC2F2F">MULTIFLEX</font></i> <font color="#0c4892">= MULTIPURPOSE & FLEXIBLE =</font> <i><font color="#DC2F2F">YOUR SITE YOUR WAY</font></i></h3>
<p align="justify">Thank you for your purchase of Striking MultiFlex & Ecommerce Premium Responsive Wordpress Theme. &nbsp;The development team behind Striking has been committed for approaching 4 years to providing wordpress users an enriched, flexible, multipurpose wordpress theme that incorporates functions designed to allow a DIY (&#34;Do It Yourself&#34;) user to format and display their content in interesting ways without requiring any knowledge of the dreaded wordpress &#34;hooks&#34; and &#34;filters&#34; or html, css, php and js.  &nbsp;At the same time, Striking incorporates the necessary tools allowing advanced users and designers who are comfortable with web code to incorporate custom html, css and js into their design: some examples of this are custom css and custom js fields, advanced functions like inline lightbox capability, and fields in some shortcodes for assigning classes or id for custom css to modify the shortcode output.</p>
<p align="justify">To assist all users with their design imperatives, Striking MultiFlex provides 3 main resources for configuring the look of a website:</p><ul>
<li><b>Administration Panels</b> - theme level custom settings</li>
<li><b>Metaboxes</b> - page & post level custom settings</li>
<li><b>Shortcodes</b> - content level custom settings</li></ul>
<p align="justify">Between these 3 methods are hundreds of optional settings that allow one to manipulate the appearence of the website down to the granular level.  &nbsp;Every setting has a preconfigured default, so one can take one&#180;s time to learn how each setting will benefit the customization of a site, without being hindered at the outset of the site implementation.</p>
<p align="justify">The help tabs to the left provide more detailed information on the 3 MultiFlex resources as well as information on our help policies and some general Wordpress administration related information for those previously unfamiliar with Wordpress.</p>
HTML;

$screen->add_help_tab( array(
	'id'      => 'overview',
	'title'   => __( 'Striking Intro' , 'theme_admin' ),
	'content' => $help,
) );


include('blocks/support.php');

$help  = '<p>' . __('<h2 class="theme_help_title">STRIKING MULTIFLEX ADMINISTRATION PANELS</h2>
<p align="justify">Striking has 13 administration panels (also called screens but we will use <em>panel</em> throughout the theme help dialogs) which contain between them hundreds of settings and functions organized into tab groupings of related items. &nbsp;Access to the panels is twofold -> via an addition to the WP navigation menu below the Settings nav group under &#34;Striking&#34;, and optionally, as another navigation item in the WP Admin toolbar found at the top of any administration panel. &nbsp;The Striking Advanced Panel ->General Tab has a setting for enabling/disabling the Striking panel links in the admin toolbar.<br /><br />The settings and functions in the Striking panels are typically used to set a behaviour to a website characteristic, such as a color, typeface, fontsize, background, or a facet of a content item such as a post featured image position. <b><span style="color:#0c4892">Typically, the settings in the Striking Panels can be viewed as the means for exercising control of the website appearence at a macro level</span></b>.</p>
<br /><div class="strikinghelptable">
<table align="center" border="0" cellpadding="0"> <thead> <tr> <th scope="col" width="100"><strong>Panel</strong></th> <th scope="col" width="500">Purpose</th></thead>
<tr class="odd"> <td >General</td> <td>3 Tabs for control of Header variables including Header Widget Area, Navigation, Favicons, and 3 Tabs: Page Design, Google Analytics & Custom CSS/JS for various theme wide settings.</td></tr>
<tr class="even"> <td>Background</td> <td>Set Backgrounds for Header, Feature Header, Box Mode, Page & Footer</td></tr>
<tr class="odd"> <td>Color</td> <td>11 Color Tabs (Flat Design, Body, Header, Page, Footer....) & 145+ settings for theme color elements</td></tr>
<tr class="even"> <td>Font</td> <td>5 Tabs: General Font Settings <b><span style="color:#0c4892">(incl Font Awesome activation)</span></b>, Font Size settings. Cufon, @font-face & Google font option controls</td></tr>
<tr class="odd"> <td>Slider Show</td> <td>General Slideshow Settings + Tabs for Nivo, Ken Burner, Accordion & Roundabout Slider controls, <span style="color:#0c4892"><b>Revolution Slider Plugin activation setting</b></span>.</td></tr>
<tr class="even"> <td>Sidebar <b><span style="color:#dc2222">**</span></b></td> <td>3 Tabs for creating & assigning Custom Sidebars to Pages, Posts & Archives</td></tr>
<tr class="odd"> <td>Image</td> <td>For creating and setting default image dimensions used by certain media shortcodes.</td></tr>
<tr class="even"> <td>Media</td> <td>Tabs w/theme settings for each video type (6 supported incl HTML5) and audio</td></tr>
<tr class="odd"> <td>Homepage</td> <td>Settings for designating a site homepage & and using optional quickstart homepage editor</td></tr>
<tr class="even"> <td>Blog</td> <td>8 Tabs for controlling all aspects of Blog appearence and behaviour</td></tr>
<tr class="odd"> <td>Portfolio</td> <td>9 Tabs for controlling all aspects of Portfolio appearence and behaviour</td></tr>
<tr class="even"> <td>Footer</td> <td>Footer options & layouts (16), and Subfooter, Copyright and Sub-Footer Widget Area settings</td></tr>
<tr class="odd"> <td>Advanced <b><span style="color:#dc2222">**</span></b></td> <td>11 Tabs: &nbsp;General (mainly Striking core options), Twitter, Responsive Options, Lightbox Options, Search, MetaBox Display, Save-Import-Export Theme Options, WooCommerce, Archive Titles, Grayscale and Theme Update settings and controls.</td></tr>
</table></div><br />
<b><span style="color:#dc2222">**</span></b> The number of tabs in these panels will increase if certain plugins such as Nextgen, and many ecommerce plugins (Woo, Easy Digital Downloads, ImageStore, WP-Ecommerce, etc) are in use as they generate their own post or archive types. &nbsp;Striking will pick these up as long as a plugin follows WP conventions, providing one the ability to control custom sidebars, search and archive feature header title/text content for the plugin generated content.
', 'theme_admin' ) .'</p>';

$screen->add_help_tab( array(
	'id'      => 'striking-panels',
	'title'   => __( 'Striking Panels' , 'theme_admin' ),
	'content' => $help,
) );

$help  = '<p>' . __('<h2 class="theme_help_title">STRIKING MULTIFLEX METABOXES</h2>
<p align="justify">In the edit panel work area when editing a page or a post, one will see new theme related boxes (called metaboxes) added by the theme code, usually placed below the main content editor. &nbsp;An example metabox is the <b>Blog Single Options</b> metabox appearing below the content editor when adding or editing a blog post. &nbsp;Some metaboxes such as the <b>Page General Options</b> metabox appear in almost all work area panels, and others are specific to a type of post being edited.</p>
<p align="justify">The purpose of the metaboxes is to provide settings for applying a behaviour of a charateristic or function specifically to that page or post.  Typically the array of settings will fall into the following purposes:</p><ul>
<li>Some settings will be designed to provide the ability to negate, or oppose a theme setting for the same function/characteristic in a Striking Panel. &nbsp;For example, the Striking Blog Panel contains a setting for setting the conditions of display of the post featured image in the feature header content area. &nbsp;However, the Blog Single Options metabox has a setting which allows for showing the opposite condition of the theme setting.</li>
<li>There are settings will allow for customizing the appearence of that specific page or post, such as assigning a custom sidebar, selecting the type of feature header to be used on the page, loading a special background for that page/post only, setting different background colors, creating custom css only for that page, and many other page specific controls.</li>

<p align="justify">The number of settings in a metabox will vary, ranging for just 1 setting with a selector in the Image Hover Effects Metabox appearing in the Woocommerce Edit Product panel to the 29 settings in 3 tabs appearing in the Page General Options Metabox. <b><span style="color:#0c4892">Thus Striking Metaboxes are intended to provide resources for exercising granular control of website appearence at the page/post level.</span></b></p>
<p align="justify">The table below contains a list of the metaboxes and where they are found. &nbsp;Sometimes the metabox will not display on theme activation, or you may not have a need for it. &nbsp;The appearence of metaboxes, both WP default and Striking, is activated & deactivated by checkboxes in the Screen Options Tab in the upper right handcorner of the administration panel. &nbsp;There is also a setting in the Striking Advanced Panel/Metabox Tab for presets for the Page General Options Metabox.</p>
<div class="strikinghelptable">
<table align="center" border="0" cellpadding="0"> <thead> <tr> <th scope="col" width="100"><strong>Metabox</strong></th> <th scope="col" width="500">Location</th></tr></thead>
<tr class="odd"> <td >Page General Options</td> <td>All Panels for Posts, Pages, Media (attachment), Portfolio Items, Slider Items, Catalog (Shop,Cart,Login,Account, etc) & Single Product Pages (Ecommerce Plugins)</td></tr>
<tr class="even"> <td>Blog Single Options</td> <td>Add & Edit Blog Post Panels</td></tr>
<tr class="odd"> <td>Portfolio Post Setup & Options</td> <td>Add & Edit Portfolio Post Panels</td></tr>
<tr class="even"> <td>Slideshow Item Options</td> <td>Add & Edit Slide Panels</td></tr>
<tr class="odd"> <td>Ken Burner Slider Options</td> <td>Add & Edit Slide Panels</td></tr>
<tr class="even"> <td>Image Hover Effect Options</td> <td>WooCommerce Single Product Add & Edit Panels</td></tr>
</table></div>', 'theme_admin' ) .'</p>';

$screen->add_help_tab( array(
	'id'      => 'striking-boxes',
	'title'   => __( 'Striking Metaboxes' , 'theme_admin' ),
	'content' => $help,
) );

$help  = '<p>' . __('<h2 class="theme_help_title">STRIKING MULTIFLEX SHORTCODES</h2>
<p align="justify">Different themes have different approaches for enabling assistance in content delivery in a page or post. &nbsp;The wordpress default themes provides only the content editor with a few buttons (an integrated script called "tinymce" provides the buttons and their associated functions) for applying some very basic html to content.  &nbsp;The WP core developers advocate that most other functionality should be obtained by plugins, or editing the core files using the supplied cdoe editor, to customize the look. &nbsp;This approach does not work for the average user for a variety of reasons the list of which is to far to long to go into here.</p>
<p align="justify">Wordpress eventually got the message that this approach was very cumbersome and in WP 2.5 created a shortcode api for plugin developers -> a set of functions within the WP core which developers could hook into and would allow them to create macro codes for use in post content, the goal being to allow an end user to be able to post a short string into the post editor which results in an action or display of some preformatted content. &nbsp;To the &#34;horror&#34; of the WP core team, premium theme developers have come along and used this api along with theme custom code to generate shortcodes for your use without the burden of a plugin (Wordpress does this as well - hence the wp gallery function, but just because they did it did not mean anyone else was supposed to....).</p>
<p align="justify">The Striking MultiFlex & Ecommerce Premium Wordpress Theme provides the user with what may very well be the most powerful array of theme shortcodes anywhere for generating varied, unique formatted content into a page or post. &nbsp;<b><span style="color:#0c4892">Comprising over 110 shortcodes (at this time!) access to the Striking MultiFlex shortcodes is via a button appearing in the tinymce button group at the top of the content editor</span></b> -> in the visual mode look for the last button in the first row, with a stylized capital &#34;S&#34; in the button frame, and in the text editor look for the &#34;Shortcodes&#34; button, again last button in the first row.</p>
<p align="justify">Clicking on the shortcode button will open up a list of sub-items, representing shortcode groups such as layouts, columns, typography, etc, and each group leader has in turn more another level of items, representing the actual shortcodes. &nbsp;Selecting one of the shortcodes will cause a dialogue box to open in the url window, containing settings that have selectors or input fields for customizing the shortcode function. &nbsp;The bottom of the dialogue box allows one to cancel the dialogue, preview the result (in the dialogue box) if so desired, and save the shortcode. &nbsp;Saving the shortcode results in a shortcode string being placed into the content editor, and it will appear similar to the following:</p>
<code>[portfolio column="3" max="10" sortable="true" ajax="true" titleLinkable="true" desc_length="50" advanceDesc="true" more="true" lightboxTitle="image" group="true" effect="hover"]</code><br />
<p align="justify">This example is a portfolio shortcode and its code is a set of instructions indicating the formatting and content to be shown in the page at the place the portfolio shortcode is inserted. &nbsp;While at the outset these code strings will be unfamiliar we can advise from user feedback over the years that in fact it takes only a short time for the average person to quickly start to understand the intent of the code, so much so that some users eventually get used to typing in the simpler shortcode strings from memory skipping the shortcode button altogether!! &nbsp;User feedback has been so overwhelmingly in favour of shortcodes (and panels as well as new settings for the metaboxes) given how they simplify matters for non-coders that the number of shortcodes in Striking has grown by at least 40% since theme inception due to the building in of requests from users.</p>
<p align="justify">So whereas Panels provide pan-website level controls, and metaboxes page/post level control, <b><span style="color:#0c4892">Shortcodes are designed to give fine grain formatting control at the content level.</span></b> The following table lists the shortcode groups and their attending shortcodes:</p>
<br /><div class="strikinghelptable">
<table align="center" border="0" cellpadding="0"> <thead> <tr> <th scope="col" width="100"><strong>Shortcode Group</strong></th> <th scope="col" width="500">Shortcodes</th></tr></thead>
<tr class="odd"> <td >Columns</td> <td>22 selectable Column Sizes</td></tr>
<tr class="even"> <td>Layouts</td> <td>19 Layouts of preset column groupings</td></tr>
<tr class="odd"> <td>Dividers</td> <td>6 Divider shortcodes: Simple divider line with top, Divider line, divider line w/padding, Divider Padding, Advanced Divider Line, Clear Both</td></tr>
<tr class="even"> <td>Typography</td> <td>11 shortcodes: Responsive Text, Drop Cap, Blockquote, Pre & Code, Styled List, Icon Font, Icon Text, Icon Link, Highlight, Button, & Tables</td></tr>
<tr class="odd"> <td>Styled Boxes</td> <td>8 shortcodes: Message, Content, Framed, Note, Slogan, Icon, Process Steps & Testimonials</td></tr>
<tr class="even"> <td>Advanced</td> <td>10 shortcodes: Milestone, Progress, Pie Progress, Iframe, Google Maps, Lightbox, Google Charts, Tabs, Accordions, Toggles</td></tr>
<tr class="odd"> <td>Slideshow & Carousels</td> <td>5 shortcodes: Nivo, Ken Burner and Fotorama slideshows, and Carousel (for images and posts) and Product Carousel (for ecommerce products)</td></tr>
<tr class="even"> <td>Widget</td> <td>12 shortcodes: Search, Contact Form, Twitter, Flickr, Contact Info, Popular Posts, Recent Posts, Portfolio List, Links, Archives, Categories, Recent Comments.</td></tr>
<tr class="odd"> <td>Media</td> <td>10 Shortcodes in 3 subgroups: Images, Video and Audio</td></tr>
<tr class="even"> <td>Masonry</td> <td>1 shortcode (with many settings)</td></tr>
<tr class="odd"> <td>Blog</td> <td>1 shortcode (with many settings)</td></tr>
<tr class="even"> <td>Portfolio</td> <td>1 shortcode (with many settings)</td></tr>
<tr class="odd"> <td>Sitemap</td> <td>5 sitemap shortcodes for creating partial sitemaps embedded into webpage content:  All, Pages, Categories, Posts, and Portfolio sitemaps.</td></tr>
</table></div><br />
', 'theme_admin' ) .'</p>';


$screen->add_help_tab( array(
	'id'      => 'striking-shortcodes',
	'title'   => __( 'Striking Shortcodes' , 'theme_admin' ),
	'content' => $help,
) );

$help  = '<p>' . __('<h2 class="theme_help_title">STRIKING MULTIFLEX ECOMMERCE</h2>
<h3>Types of Ecommerce Themes</h3>
<p align="justify">Striking MultiFlex possesses significant custom ecommerce specific features and functions.  &nbsp;However, it is worthwhile to quickly summarize wordpress themes in respect of ecommerce adaptability in order to obtain some context of where MultiFlex fits and it&#180;s features in respect of ecommerce capabilities:</p>
<ol>
<li><p align="justify">The wordpress theme provides <u>no specific ecommerce support</u> whatsoever in its code and use of any ecommerce plugin is entirely hit and miss in respect of it working within the theme (effectively this describes the default wordpress themes and pretty much all free themes in the wordpress.org theme library).</p></li>
<li><p align="justify">The theme provides some <u>limited ecommerce support</u>, at least to the extent of coding so that a particular ecommerce plugin(s) will not conflict but the theme otherwise has little or no specific custom ecommerce oriented features (some advanced free themes and entry level premium themes ($25-$40 range). </p></li>
 <li><p align="justify">The theme is <u>coded for a specific ecommerce plugin</u> (which is sometimes integrated into its core as a built-in plugin) or implements an ecommerce script (often a proprietary script), and is coded to facilitate the look and workings of the integration. &nbsp;Usually in this situation no other ecommerce plugin will work with the theme so the user is restricted to the integrated plugin/script for ecommerce use, and sometimes is limited to only the features programmed within the theme (select advanced premium themes, and ecommerce dedicated themes).</p></li>
<li><p align="justify">The theme provides <u>broad ecommerce support</u>, perhaps by way of both coding to eliminate conflicts with one or more ecommerce plugins, and specific code to facilitate certain features in one or more ecommerce plugins (rare).</p></li>
</ol>

<p>As the philosophy of MultiFlex is to be multipurpose and flexible, our theme encompasses both #3 & #4 above:</p>

<p align="justify"><b><span style="color:#0c4892">MultiFlex has custom design and features specifically coded for WooCommerce</span></b> which slots Multiflex into the 3rd category above.  &nbsp;The theme customization specifically for Woo includes:
<ul>
<li> Extensive restyling the Woo shop and single product pages into a new more modern appearence by custom code</li>
<li>Replacing the woo image scripts with the Striking Image scripts (resize and lightbox)</li>
<li>Adding Image Hover Effects to thumbnails appearing on the catalog page</li>
<li>Creating a new theme master CSS alternate for when Woo is activated to avoid conflict with the Woo CSS (as it uses CSS classnames usually reserved for themebuilders)</li>
<li>Added RTL support for Woo in Striking MultiFlex</li>
<li>A dedicate Woo Administration admin tab in the theme admin panels containing woo specific administration settings (layouts, feature headers, breadcrumbs, colors, default sidebars, etc)</li>
<li>Coding enabling parsing of custom breadcrumb functions from WP SEO onto Woo pages.</li></ul></p>
<p align="justify">The Woo plugin is not included in the theme pack. &nbsp;Install it as you would any other plugin, activate it, activate the Woo specfic theme settings which align the theme for Woo usage (see the Woo section of the documentation) and you are good to go!</p>

<p align="justify"><b><span style="color:#0c4892">However, Multiflex also has both specific core coding to support the functionality of another very popular ecommerce plugin Easy Digital Downloads (EDD), and a set of abilities and features which are designed to work with any custom post type based ecommerce plugin.</span></b> &nbsp;Please note the plugin must have valid and up-to-date code (including compatible with WP 3.8+), have registered its custom post type properly (if using custom post types for creating products) and has enqueued its scripts properly and used unique css classes for its style. &nbsp;If the plugin works on the basis of shortcodes only with no post template then as long as the code rules are followed it has an excellent chance of being compatible with Striking MultiFlex.</p>
<p>The custom MultiFlex features applicable to any ecommerce plugins, including Woo and EDD are:
<ol>
<li>Custom Product Carousel which displays single product items.</li>
<li>Ability to customize the appearence of any catalogue/shop or single product page for layout, colors, feature header (which has unlimited variations incl slideshow, images, custom html content, and more), background, and body content, etc (about 30 settings) by way of the Page General Options Metabox which is filtered into the catalog and single product edit panels generated by the plugins.</li>
<li>Ability to assign a custom sidebar to plugin custom post page types, custom post archive type pages, and custom post type taxonomy pages.</li>
<li>Ability to exclude from website search results the CPT, its media, or taxonomies.</li>
<li>An admin tab enabling setting Custom Post Type Archive Featured Header Titles and Text (which supports html and theme shortcodes) for plugin archive types generated</li>
<li>An admin tab enabling setting Custom Taxonomy Featured Header Titles and Text (which supports html and theme shortcodes) for plugin taxonomies generated</li>
</li></ol>
This array of features and abilities which allow customizing of any ecommerce plugin content places Striking MultiFlex squarely into the 4th category of ecommerce themes as well.</p>

<h3>Compatible Ecommerce Plugins</h3>
 <p>As noted above, Striking has specific code to support the working of 2 of the most popular ecommerce plugins from the wp codex, and <b><span style="color:#0c4892">they can be activated at the same time in the theme without conflict if desired</span></b>: 
<ul>
<li>WooCommerce - oriented towards traditional products historically</li>
<li>Easy Digital Downloads - an ecommerce plugin oriented towards digital downloads</li>
</ul></p>

<p align="justify">Both have many add-on plugins available.  Together they provide the opportunity for a large and sophisticated ecommerce site selling a wide variety of tangible and intangible goods.</p>
<p align="justify"><u>We can also advise that you can actually activate another plugin at the same time as Woo and EDD: &nbsp;Image Store</u> - an ecommerce plugin oriented towards the organization and sale of images, with special features such as watermarks, public and private galleries, etc, without theme conflict.  This plugin is often used as a NextGen replacement even if not engaging in ecommerce as it organizes media in albums with all the ancillary features. &nbsp;Watch out soon for our ecommerce demo site where we have all 3 plugins active and built out in a fully featured store.</p>

<p>Brief testing has been done with Cart66, WP-Ecommerce and Amazon Stores, and more ecommerce plugin testing is scheduled for the near future.  &nbsp;Should any user find a compatibility issue with one of the aforementioned plugins, or another common ecommerce plugin, please advise on the Support forum by opening a new thread.</p>', 'theme_admin' ) .'</p>';

$screen->add_help_tab( array(
	'id'      => 'striking-ecommerce',
	'title'   => __( 'Striking Ecommerce' , 'theme_admin' ),
	'content' => $help,
) );


$help  = '<p style="margin-top:30px;">' . __('The left-hand navigation menu provides links to all of the WordPress administration screens, with submenu items displayed on hover. You can minimize this menu to a narrow icon strip by clicking on the Collapse Menu arrow at the bottom.', 'theme_admin' ) . '</p>';
$help .= '<p>' . __('Links in the Toolbar at the top of the screen connect your dashboard and the front end of your site, and provide access to your profile and helpful WordPress information.', 'theme_admin' ) . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-navigation',
	'title'   => __('Wordpress Navigation' , 'theme_admin'),
	'content' => $help,
) );

$help  = '<p style="margin-top:30px;">' . __('You can use the following controls to arrange your Dashboard screen to suit your workflow. This is true on most other administration screens as well.', 'theme_admin' ) . '</p>';
$help .= '<p>' . __('<strong>Screen Options</strong> - Use the Screen Options tab to choose which Dashboard boxes to show, and how many columns to display.', 'theme_admin' ) . '</p>';
$help .= '<p>' . __('<strong>Drag and Drop</strong> - To rearrange the boxes, drag and drop by clicking on the title bar of the selected box and releasing when you see a gray dotted-line rectangle appear in the location you want to place the box.', 'theme_admin' ) . '</p>';
$help .= '<p>' . __('<strong>Box Controls</strong> - Click the title bar of the box to expand or collapse it. In addition, some boxes have configurable content, and will show a &#8220;Configure&#8221; link in the title bar if you hover over it.', 'theme_admin' ) . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-layout',
	'title'   => __('Wordpress Layout', 'theme_admin' ),
	'content' => $help,
) );

$help  = '<p style="margin-top:30px;">' . __('The boxes on your Dashboard screen are:', 'theme_admin' ) . '</p>';
if ( current_user_can( 'edit_posts' ) )
	$help .= '<p>' . __('<strong>Right Now</strong> - Displays a summary of the content on your site and identifies which theme and version of WordPress you are using.', 'theme_admin' ) . '</p>';
if ( current_user_can( 'moderate_comments' ) )
	$help .= '<p>' . __('<strong>Recent Comments</strong> - Shows the most recent comments on your posts (configurable, up to 30) and allows you to moderate them.', 'theme_admin' ) . '</p>';
if ( current_user_can( 'publish_posts' ) )
	$help .= '<p>' . __('<strong>Incoming Links</strong> - Shows links to your site found by Google Blog Search.', 'theme_admin' ) . '</p>';
if ( current_user_can( get_post_type_object( 'post' )->cap->create_posts ) ) {
	$help .= '<p>' . __('<strong>QuickPress</strong> - Allows you to create a new post and either publish it or save it as a draft.', 'theme_admin' ) . '</p>';
	$help .= '<p>' . __('<strong>Recent Drafts</strong> - Displays links to the 5 most recent draft posts you&#8217;ve started.', 'theme_admin' ) . '</p>';
}
$help .= '<p>' . __('<strong>WordPress Blog</strong> - Latest news from the official WordPress project.', 'theme_admin' ) . '</p>';
$help .= '<p>' . __('<strong>Other WordPress News</strong> - Shows the <a href="http://planet.wordpress.org" target="_blank">WordPress Planet</a> feed. You can configure it to show a different feed of your choosing.', 'theme_admin' ) . '</p>';
if ( ! is_multisite() && current_user_can( 'install_plugins' ) )
	$help .= '<p>' . __('<strong>Plugins</strong> - Features the most popular, newest, and recently updated plugins from the WordPress.org Plugin Directory.', 'theme_admin' ) . '</p>';
if ( current_user_can( 'edit_theme_options' ) )
	$help .= '<p>' . __('<strong>Welcome</strong> - Shows links for some of the most common tasks when setting up a new site.', 'theme_admin' ) . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-content',
	'title'   => __('Wordpress Content', 'theme_admin' ),
	'content' => $help,
) );

unset( $help );

include('blocks/sidebar.php');