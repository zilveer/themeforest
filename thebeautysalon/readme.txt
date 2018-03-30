# The Beauty Salon Theme Documentation

The Beauty Salon theme is a theme created by [Red Factory](http://redfactory.nl/themes/).
It has a powerful framework which allows you to create the website you'd like
to have with as few restrictions as possible.

If you have any questions or comments please feel free to use our [support
forum](http://www.redfactory.nl/themes/forum).

# Installation

## Automatic Installation

1. Log in to your WordPress admin and go to the 'Appearance' page. Click on
   the 'Install Themes' tab on top. Click on 'Upload' below the tabs.

2. Upload the theme package and click 'Install Now'

3. Once the installation is complete click 'activate' to activate the theme


## Manual Installation

1. Upload 'The Beauty Salon.zip' to your WordPress themes directory. This is usually
   found in 'wp-content/themes/'

2. Extract the files. This can usually be done through the file manager in
   your cPanel. If you have no idea what this is or you don't have cPanel
   access, you will need to extract the files on your hard drive and upload
   all the files instead of the zip package.

3. Log in to your WordPress admin and go to the 'Appearance' page. You should
   see the theme in the list. Click on 'activate' to activate the theme.


# About Red Factory Themes

Red Factory themes use a common theme framework. This includes shortcodes,
widgets, custom field handling, the control panel, and so on.

All the controls should be familiar, we use checkboxes, text fields, select
boxes and so on. We try to include as much inline documentation as needed,
so if you're stuck, take a look at the help icons next to the fields.

# Theme Usage

Your theme includes a lot of options and settings to modify. We recommend
getting to know your theme first before you implement it on a live site.
Playing around with options is encouraged, take a look at what everything
does, look at the information next to options.

Your theme will come with some options set up by default. This way your
initial experience will be as close as possible to the demo site you saw.

We have some tutorial videos available on our Vimeo channel
https://vimeo.com/channels/440757

# Options Types

There are a few types of options available such as text inputs, select
boxes, radio buttons, etc. Some require some special actions to be taken,
please read the section below if you are having trouble.

## Text Inputs

These elements require you to enter some text into them. Just type away
and save, that's it.


## Textareas

Textareas are just larger text inputs which allow you to add some longer
text.


## Select Dropdown

Select dropdowns are simple select boxes, click on them to show the items
and select the one you want. Many dropdowns have a build in search field
you can use to find what you want quickly.


## Dual Boxes

Dual boxes are used when a group needs to be selected from a list. For
example, if you want to select 5 specific categories from your list of
20 to show posts from.

In this case the left hand box will contain your available options and
the right hand box will have your selected options. You can move options
between boxes by selecting them (CTRL + Click to select multiple items)
and using the arrows in the middle.


## Upload

To upload a file, click on the "+ Upload File" button where available.
Once a file has been selected it will be uploaded and shown right away.
Don't forget to save your changes though as the images will only be
applied if you do so.


## Color Selectors

Color selectors are text input boxes with a a colored background.
If you click on the text field a color picker will appear, allowing you
to choose any color you like. You can also simply paste a HEX color into
the field yourself.


# Global Options, Page Type Options and Post Options

For a number of settings (sidebar position, sidebar content, etc. ) there
are three levels of settings. You can set up a global default for them
in the general->global settings tab. This will be a global setting applied
to all pages on your site.

By going to General->page types you can set the page type level settings
for each page type.

By going into the editor screen for a specific post, you can then override
these settings.

For example, let's assume that you want your sidebar to show up on every page
by default. In this case you would set the "Show the sidebar by default"
setting to yes.

However, on your gallery pages, to make them more spacious,
you might want to disable the sidebar. Instead of having to go to each
gallery page to disable it separately you can go to the page type options
and disable sidebars for all gallery pages.

On one specific gallery page though you could want your sidebar back,
so for that specific page you can override the setting in the page's
options.


# Setting Up A Home Page

There are a number of ways to set up your home page depending on what you
want to put on it. If your goal is to have a blog which shows the latest
posts then you'll be fine out of the box. Let's take a look at some other
scenarios below.

## Post List Home Page

You might want to show posts on your home page, but not your latest ones.
Let's say you want to show your latest posts from the "Animals" category
on the front page and you want to have a separate page which lists all
posts.

First, go to 'Pages->Add New' and create a page with the 'Post List'
template.

Add the 'Animals' category to the selected categories using the dualbox
selector in the post list options, Let's call this page the 'Animals Blog'.

Next, create another post list page but don't select any categories to
include or exclude. This page will list all your posts. Let's call it
'My Thoughts' and publish it as well.

Go to 'Settings->Reading' and next to 'Front page displays' select the
static page option. Set your 'Animals Blog' as the front page and your
'My Thoughts' page as your posts page.

When anyone visits your front page they will see the post list listing all
your posts about animals. Depending on how your menus are set up you may
need to add a link to your posts page, see the 'Setting up Menus' section.


## Customized Front Page

In many cases you don't want to list posts on your front page at all, you
want some static content to show visitors. This case is very similar to the
one above, except instead of creating a post list as our front page we
simply use a page.

Create a page named 'home' (it can be named anything) and add the content
you'd like. Using columns and buttons can be a good way of making some
vibrant front page content. When done make sure to publish the page.

Create a page named 'blog' (this can also be named anything) and publish it.

Go to 'Settings->Reading' and next to 'Front page displays' select the
static page option. Set your 'Home' page as the front page and your
'Blog' page as your posts page.

When anyone visits your front page they will see the content of the 'Home'
page that you created. Depending on how your menus are set up you may
need to add a link to your posts page, see the 'Setting up Menus' section.

You can put some more elaborate home pages in place without duplicating
content by using the Mashup page template. If you would like your home page
to be built out of an 'About Me' section, a 'My Services' section and a
'Awesome Clients' section you can create these three as separate pages and
pull them into one place with a mashup page. This way the content on these
pages is reachable separately but is mashed together on the front page.

# Setting Up Menus

Your website contains two customizable menus, one in the header and one in
the footer. By default these show all the pages you have created. This might
not be what you want though since you might want to hide some pages, and
if you have too many it would just be too much to put on the page.

You can customize these menus by going to 'Appearance->Menus'. WordPress
allows you to create as many menus as you'd like. Once you've created a menu
you can assign it to a location in the theme.

First add a menu on the right side of the page. You can then add items to it
using the controls on the left. You can also rearrange the items by dragging
and dropping them into the correct place.

Once done, save the menu and use the 'Theme Locations' box on the top left
to assign a menu to a location. Once complete your new menu should show up
in the location specified.

Make sure to look at additional options offered in the menu. Once you add
a page to the menu for example you can click the arrow on its right side
to get further options. You can change the label which is handy if you want
to keep the name of the page in the admin but want to show users a different
name.

# Setting up the Sidebar

WordPress allows you to set up your sidebar in any way you wish and gives
you powerful controls to modify and tweak it at any time. Sidebars can be
modified by going to 'Appearance->Widgets'.

Your sidebars are shown on the right and the widgets you can use in them on
the left. By default you only have one sidebar named 'Sidebar' but you may
set up more in the Theme Settings (see Custom Sidebars in the Theme
Settings).

Just drag and drop widgets you want to use into the sidebar of your choice.
If a sidebar is empty you may have to click the arrow next to its title
first to open it up.

Once a widget is in the sidebar you can click on the arrow next to it to
expand the available options.

WordPress has many widgets available by default and their usage should be
pretty easy. We've also added a few for added flexibility, lets take a look.


# Shortcodes

Each Red Factory theme comes with shortcodes you can use to tailor your
content to your needs. We have inline documentation for each shortcode.

In the editor, when in visual mode, click the shortcode icon (should be
the second from the left) and you'll see the shortcode inserter.

You'll see a list of shortcodes with a short description. Clcik on any
shortcode to get the list of parameters with documentation on what
values they can use.

# Widgets

All our custom widgets come with inline documentation as well, so just
drag them to the sidebars and view the documentation there.


# Files Included in Your Theme

Your theme includes a number of files which are not used by WordPress, but
were used for development. If you want to make modifications to the code you
may of course do so, and using some of these development files your job may
be a bit easier.

## LESS Files

Your theme contains a folder named 'less'. This folder includes all the LESS
files we used to build the stylsheets. LESS is a dynamic stylehseet language
and a superset of CSS. This means that all CSS is valid LESS code, but not
all LESS code is valid CSS.

To learn almost everything there is to know about LESS visit its webpage at
http://lesscss.org. While you can include LESS files in websites directly by
using an additional Javascript file, we always compile the LESS code into
CSS for themes.

'base.less' and 'base-admin.less' are files which are not used directly,
they are included into other LESS files. 'style.less' generates the main
stylesheet for your site, the compiled CSS from this file is 'style.css'
from your main directory. All other LESS files are compiled to the 'css'
directory.


## Javascript Files

We only include the minified Javascript files but we have added the
non-minified version for convenience. Non-minified versions make debugging
and adding features much easier.

If you have any questions about the Javascript files, we recommend visiting
the sites of the respective plugins, or if it is one of our files, going to
the support forum.

# Modifying the Theme Code

We recommend modifying the code only if you are well versed in WordPress and
PHP in general. You are of course allowed to make any modifications you
wish, but we might not be able to provide extensive support for modified
themes.

If you would like to modify the styles of your site, please use custom.css
in the CSS folder. If you don't directly use the other CSS files it will
be much easier to troubleshoot problems in the future.

Many files are inside the framework folder, please do not modify these.
We have an automatic update in place which will overwrite the modifications
you make.