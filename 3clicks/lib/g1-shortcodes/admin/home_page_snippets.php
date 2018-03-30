<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Shortcodes
 * @since G1_Shortcodes 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


/**
 * Adds "basic" section to the global shortcode generator
 *
 * @param G1_Shortcode_Generator $generator
 */
function g1_shortgen_section_home_page_snippets( $generator ) {
    $generator->add_section( 'homepagesnippets', array(
        'label' => __( 'Home Page Snippets', 'g1_theme' ),
        'priority' => 500,
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_home_page_snippets', 9 );

/**
 * Adds shortcode snippets to the global shortcode generator
 *
 * @param       G1_Shortcode_Generator $generator
 */

function g1_shortgen_home_page_snippets( $generator ) {

// HOME #1
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
[precontent]

[two_third valign="middle"]

<h2>Let's Give Your Website a Brand New Look!</h2>

[/two_third]

[one_third_last valign="middle"]

[button link="http://themeforest.net/item/3clicks-responsive-multipurpose-wordpress-theme/5092225" size="big" style="simple" type="wide"]Buy at ThemeForest[/button]

[/one_third_last]

[/precontent]

[section]

[one_third]

<h2>[icon icon="th-large" size="small" style="solid"] MetroStyle Menus</h2>

We offer a huge variety of custom menu styles but to be honest the MetroStyle is our favourite. You'll love it too.

<a href="/customize/menu-layouts/">— Read More</a>

[/one_third]

[one_third]

<h2>[icon icon="magic" size="small" style="solid"] Design Audits</h2>

When your site is ready, stop for a while and ask our designer what can be improved. What's more, it's a totally <strong>FREE</strong> service!

<a href="/metromenu/design-audits/">— Read More</a>

[/one_third]

[one_third_last]

<h2>[icon icon="gift" size="small" style="solid"] Brand New Sliders</h2>

Besides the awesome Revolution Slider, the 3Clicks Theme includes some new and unconventional sliders.

<a href="/">— Read More</a>

[/one_third_last]

[/section]

[section border_size="1" background_color="#f7f7f7" padding_bottom="0"]

<h2 class="g1-h1" style="text-align:center;"><a href="/shortcodes/misc/full-width-sections/">3Clicks v2 - Now With Full Width Sections</a></h2>

<div></div>

<h3 style="text-align:center;">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin facilisis commodo sapien, ut accumsan pellentesque arcu auctor nec</h3>

[space]

<div><img style="display:block;" width="968" height="380" src="/wp-content/uploads/2013/03/post_photo_03_v01.jpg" alt="Section Visual"/></div>

[/section]

[section]

[one_third]

<h2>Awesome Shortcodes</h2>

[duplicator start="0" stop="22" max="25" icon="gift"][/duplicator]

Duplicators, Animated Numbers, Progress Bars & Circles, Before & After. <a href="/shortcodes/">See The Full List</a>

[/one_third]

[one_third]

<h2>Some Facts</h2>

[list type="icon" icon="chevron-right" style="simple"]

<ul>
<li>100% Responsive & Retina Ready</li>
<li>SEO Optimized with Microdata Support</li>
<li>Smart Shortcodes with Shortcode Generator</li>
<li>Unlimited Colors & Custom Backgrounds</li>
<li>Video Tutorials and Documentation</li>
<li>Easy to Use Theme Options Panel</li>
</ul>

[/list]

[/one_third]

[one_third_last]

<h2>What Clients Say</h2>

[carousel coin_nav="none" direction_nav="none" autoplay="standard"]

[carousel_item]

[quote author_name="George Novitzky" author_description="Some Company" author_image="/wp-content/uploads/2013/06/quote_author_image_1_v01.jpg" size="small" style="solid"]

Auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris.

[/quote]

[/carousel_item]

[carousel_item]

[quote author_name="John Doe" size="small" style="solid"]

Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris. Auctor sit amet feugiat eu &amp; viverra ac felis.

[/quote]

[/carousel_item]

[/carousel]

[/one_third_last]

[/section]

[section background_image="/wp-content/uploads/2013/06/revslider_big_1_v01.jpg" background_position="center top" background_repeat="repeat"]

<h2 style="color:#ffffff;">Recent Works</h2>

[recent_works max="6" template="one-third-gallery" effect="grayscale" hide="summary,categories,tags"]

[/section]

[section]

[box]

[two_third valign="middle"]

<h2>You Will Love 3Clicks As Much As We Do</h2>
<h3 class="g1-h4">Ullamcorper mi viverra quis. Sed nec suscipit felis.</h3>

[/two_third]

[one_third_last valign="middle"]

[button style="solid" size="big" type="wide"]Get Started with 3Clicks[/button]

[/one_third_last]

[/box]

[divider]

<h2>Our Happy Clients</h2>

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_1_v01.png" width="171" height="77" alt="Brand Logo 1" />

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_2_v01.png" width="171" height="77" alt="Brand Logo 2" />

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_3_v01.png" width="171" height="77" alt="Brand Logo 3" />

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_4_v01.png" width="171" height="77" alt="Brand Logo 4" />

[/one_fifth]

[one_fifth_last]

<img src="/wp-content/uploads/2013/06/brand_logo_5_v01.png" width="171" height="77" alt="Brand Logo 5" />

[/one_fifth_last]

[/section]
G1_HEREDOC_DELIMITER;

    $generator->add_snippet( '*** Home #1', array(
        'label'			=> 'Home #1',
        'result'		=> $snippet,
        'section'		=> 'homepagesnippets',
    ));

// HOME #2
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
<div style="text-align:center">

<h1>Limitless Possibilities with Theme Options Panel</h1>

[button link="/features/other-features/advanced-admin-panel/" style="solid" size="medium"]Learn More[/button] [button link="/features/other-features/advanced-admin-panel/" style="simple" size="medium"]See Screens[/button]

</div>

<hr />

[one_half valign="middle"]

<h2>Easy to Use</h2>

[list type="icon" style="simple" icon="chevron-right"]

<ul>
<li><strong>Beautiful Skins</strong><br />Lorem Ipsum Dolor Sit Amet vel magna eu tortor aliq</li>
<li><strong>Powerful Admin Panel</strong><br />Vivamus Adispicing Consectetuer vel magna eu tortor aliquet</li>
<li><strong>Smart Shortcodes</strong><br />Adispicing Ipsum pelentesque Vivamus vel magna eu tortor</li>
<li><strong>The Help Mode</strong><br />Dolor Vivamus Pelenetesque Adispicing vel magna eu tortor aliquet</li>
<li><strong>Child Theme Support</strong><br />Vivamus Lorem Ipsum Dolor Sit Amet vel magna eu tortor</li>
<li><strong>Video TutorialsL</strong><br />Adispicing Consectetuer Vivamus vel magna eu tortor aliquet</li>
</ul>

[/list]

[/one_half]

[one_half_last valign="middle"]

<img src="/wp-content/uploads/2013/04/customize_01_v01.png" alt="Customizations" width="470" height="460" />

[/one_half_last]

[divider style="simple"]

<h2>Why Choose Our Theme?</h2>

[one_half]

We put a lot of effort to make sure that working with the 3Clicks Theme will be a great fun for you, as it is for us. You will love the way how easily things can be done, just in few clicks.

We tried to do everything as much intuitive as it only can be. Demo content, theme options and ready to use skins - all to make your work easier.

[button link="/" style="simple" size="small"]Read More[/button]

[/one_half]

[one_half_last]

[progress_bar value="25" icon="flag" size="small"]1. Load Demo[/progress_bar]

[progress_bar value="50" icon="crop" size="small"]2. Customize[/progress_bar]

[progress_bar value="75" icon="umbrella" size="small"]3. Five-Start Support[/progress_bar]

[progress_bar value="100" icon="magic" size="small"]4. Design Audit[/progress_bar]

[/one_half_last]

<hr />

[one_fourth]

<h3>[icon icon="film" size="small" style="solid" shape="circle"] Video Tutorials</h3>

We have created multiple video tutorials that quickly and easily walk you through the setup of the 3clicks theme.

<a href="/features/video-tutorials/">— Read More</a>

[/one_fourth]

[one_fourth]

<h3>[icon icon="beaker" size="small" style="solid" shape="circle"] Demo Content</h3>

We prepared the XML files so you can easily import our demo content and the theme options in just s few steps.

<a href="/features/demo-content/">— Read More</a>

[/one_fourth]

[one_fourth]

<h3>[icon icon="eye-open" size="small" style="solid" shape="circle"] Smart Shortcodes</h3>

Our shortcodes have built in mechanism recognising names and values aliases so you can use them more efficiently.

<a href="/features/intelligent-shortcodes/">— Read More</a>

[/one_fourth]

[one_fourth_last]

<h3>[icon icon="star" size="small" style="solid" shape="circle"] 5-Star Support</h3>

Need help? Have a question? Ask on our support forum and we will try do our best to help you solve any problem.

<a href="/features/ongoing-support/">— Read More</a>

[/one_fourth_last]

[divider style="simple"]

<h2>Interesting Facts</h2>

[one_third animation="fade_in"]

[duplicator size="small" start="0" stop="29" max="30" icon="user" style="simple"]

<h4>6,000+ Happy Customers</h4>

[/one_third]

[one_third animation="fade_in"]

[duplicator size="small" start="0" stop="20" max="30" icon="coffee" style="simple"]

<h4>500+ Drunk Coffees</h4>

[/one_third]

[one_third_last animation="fade_in"]

[duplicator size="small" start="0" stop="25" max="30" icon="rocket" style="solid"]

<h4>35+ Fancy Shortcodes Included</h4>

[/one_third_last]
G1_HEREDOC_DELIMITER;

    $generator->add_snippet( '*** Home #2', array(
        'label'			=> 'Home #2',
        'result'		=> $snippet,
        'section'		=> 'homepagesnippets',
    ));

// HOME #3
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
[one_third]

[one_sixth]

[icon icon="th-large" size="small" style="solid"]

[/one_sixth]

[five_sixth_last]

<h2>MetroStyle Menus</h2>

We offer a huge variety of custom menu styles but to be honest the MetroStyle is our favourite. You'll love it too.

<a href="/">— Read More</a>

[/five_sixth_last]

[/one_third]

[one_third]

[one_sixth]

[icon icon="magic" size="small" style="solid"]

[/one_sixth]

[five_sixth_last]

<h2>Design Audits</h2>

When your site is ready, stop for a while and ask our designer what can be improved. What's more, it's a totally <strong>FREE</strong> service!

<a href="/">— Read More</a>

[/five_sixth_last]

[/one_third]

[one_third_last]

[one_sixth]

[icon icon="gift" size="small" style="solid"]

[/one_sixth]

[five_sixth_last]

<h2>Brand New Sliders</h2>

Besides the awesome Revolution Slider, the 3Clicks Theme includes some new and unconventional sliders.

<a href="/">— Read More</a>

[/five_sixth_last]

[/one_third_last]

[divider]

<h2>Check Our Portfolio</h2>

[recent_works max="6" template="one_third" hide="summary,categories,tags,button_1"]

[divider]

[one_half]

<h2>What We Offer</h2>

[list type="icon" icon="chevron-right" style="simple"]

<ul>
<li><strong>100% Responsive Layout</strong><br />Your site will look great on any screen size</li>
<li><strong>Unlimited colors</strong><br />Define your color and all gradients will be generated</li>
<li><strong>Hundreds of fonts</strong><br />Google Web Fonts, Font-Face, System Fonts</li>
<li><strong>Ongoing Support</strong><br />Design Audit for FREE</li>
</ul>

[/list]

[/one_half]

[one_half_last]

<h2>What Clients Say</h2>

[carousel coin_nav="none" direction_nav="standard"]

[carousel_item]

[quote author_name="George Novitzky" author_description="Some Company" author_image="/wp-content/uploads/2013/06/quote_author_image_1_v01.jpg" size="medium" style="solid"]

Auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris.

[/quote]

[/carousel_item]

[carousel_item]

[quote author_name="John Doe" size="medium" style="solid"]

Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris. Auctor sit amet feugiat eu &amp; viverra ac felis.

[/quote]

[/carousel_item]

[/carousel]

[/one_half_last]

[divider icon="cut"]

<h2 style="text-align:center;">3Clicks Theme in Numbers</h2>
<h4 style="text-align:center;">Quisque venenatis risus non pulvinar sollicitudin venenatis risus id pretium</h4>

[one_fourth]

[numbers size="medium" icon="gift" stop="17" suffix="!"]Unexpected Situations[/numbers]

[/one_fourth]

[one_fourth]

[numbers size="medium" icon="time" stop="1400" suffix="+"]Hours of Development[/numbers]

[/one_fourth]

[one_fourth]

[numbers size="medium" icon="bug" stop="120" suffix="+"]Fixed Bugs[/numbers]

[/one_fourth]

[one_fourth_last]

[numbers size="medium" icon="coffee" stop="350" suffix="+"]Drunk Coffees[/numbers]

[/one_fourth_last]
G1_HEREDOC_DELIMITER;

    $generator->add_snippet( '*** Home #3', array(
        'label'			=> 'Home #3',
        'result'		=> $snippet,
        'section'		=> 'homepagesnippets',
    ));

// HOME #4
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
[precontent]

<div style="text-align:center">

<h1>We Create Professional Solutions</h1>
<h3>Make your site exceptional and be proud of it</h3>

</div>

[/precontent]

[one_third]

[box icon="magic" style="solid"]

<h2>Corner Roundness</h2>

<hr />

You’ll be amazed how easily change the look of the whole site only by changing its corners type.

<a href="/customize/corner-roundness/">— Read More —</a>

[/box]

[/one_third]

[one_third]

[box icon="tint" style="solid"]

<h2>Unlimited Colors</h2>

<hr />

Changing page colors never was so easy. You can set up your company ID colors in just a few minutes.

<a href="/customize/unlimited-colors/">— Read More —</a>

[/box]

[/one_third]

[one_third_last]

[box icon="exchange" style="solid"]

<h2>Header Layouts</h2>

<hr />

Header is one of the most important part of your page so we want to make sure it fits your need.

<a href="/customize/header-layouts/">— Read More —</a>

[/box]

[/one_third_last]

[divider]

<h2>Latest from the Portfolio</h2>

[recent_works max="4" template="one_half_gallery" effect="none" hide="tags, categories"]

[divider]

<h2>Why Choose Our Theme?</h2>

[one_third valign="middle"]

[list type="icon" icon="chevron-right" style="simple"]
<ul>
<li><strong>100% Responsive</strong><br />Vivamus condimentum, purus vitae</li>
<li><strong>Retina Ready</strong><br />Condimentum, purus vitae ullamcorper</li>
<li><strong>Unlimited Colors</strong><br />Adispicing purus vitae ullamcorper</li>
<li><strong>Multiple blog designs</strong><br />Ipsum dolo vamus condimentum</li>
<li><strong>Multiple portfolio designs</strong><br />Vivamus condimentum, purus</li>
</ul>
[/list]

[/one_third]

[one_third valign="middle"]

<img src="/wp-content/uploads/2013/06/visual_phone_top_1_v01.png" width="470" height="548" alt="Phone Visual"/>

[/one_third]

[one_third_last valign="middle"]

[list type="icon" icon="chevron-right" style="simple"]
<ul>
<li><strong>Various Menu Types</strong><br />Phasellus luctus vehicula nisi</li>
<li><strong>Tones of Built-in Features</strong><br />Luctus vehicula nisi sed</li>
<li><strong>Lots of Custom Pages</strong><br />Vehicula nisi, sed pellentesque</li>
<li><strong>Fancy Shortcodes</strong><br />Vivamus vehicula, sed</li>
<li><strong>and much more ...</strong><br />Vivamus vehicula, sed lipsum</li>
</ul>
[/list]

[/one_third_last]

[space value="3em"]

[box]

[two_third valign="middle"]

<h2>3clicks is the most flexlible multi-purpose theme!</h2>

[/two_third]

[one_third_last valign="middle"]

[button link="http://themeforest.net/user/bringthepixel/portfolio?ref=bringthepixel" size="big" style="solid" type="wide"]Buy at ThemeForest[/button]

[/one_third_last]

[/box]

[space value="3em"]
G1_HEREDOC_DELIMITER;

    $generator->add_snippet( '*** Home #4', array(
        'label'			=> 'Home #4',
        'result'		=> $snippet,
        'section'		=> 'homepagesnippets',
    ));

// HOME #5
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
[one_third]

[box icon="cog" style="solid"]

<h3>Flexible & Powerful</h3>

[/box]

[list type="icon" style="simple" icon="chevron-right"]

<ul>
<li>100% Responsive Layout</li>
<li>Unlimited Colors & Retina Ready</li>
<li>Many Types Of Layouts (Full Width, Boxed)</li>
<li>Beautiful Typography</li>
</ul>

[/list]

[/one_third]

[one_third]

[box icon="medkit" style="solid"]

<h3>Professional Support</h3>

[/box]

[list type="icon" style="simple" icon="chevron-right"]

<ul>
<li>5 Star Support</li>
<li>Frequent Updates With New Features</li>
<li>Design Audits</li>
<li>Video Tutorials</li>
</ul>

[/list]

[/one_third]

[one_third_last]

[box icon="magic" style="simple"]

<h3>Free Design Audits</h3>

[/box]

[quote author_name="Michael" author_description="bringthepixel" author_image="/wp-content/uploads/2013/04/person_portrait_1-55x55.jpg" size="small" style="simple"]

Our support includes more than just a regular help with configuration. We want you to be proud of the final result. That's why we've got FREE design audit for you.

[/quote]

[/one_third_last]

[divider style="simple"]

<h2>Latest From The Blog</h2>

[recent_works max="6" template="one_third" effect="none" hide="date, author, comments_link, button_1, tags, categories, summary"]

[divider style="simple"]

[one_half]

[tabs position="top-center" style="simple" type="click"]

[tab_title]

Philosophy

[/tab_title]

[tab_content]

<h2>Our Philosophy</h2>

Mauris congue est metus, nec iaculis purus placerat vel. Duis dictum sapien est, vel laoreet diam imperdiet ut. Nullam posuere fermentum eros, vitae tristique libero dictum a. Praesent vel ante quis leo.

Nullam tincidunt aliquet eros, ut facilisis purus rhoncus ac. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae. Duis dictum sapien est, vel laoreet diam imperdiet ut.

[/tab_content]

[tab_title]

Mission

[/tab_title]

[tab_content]

<h2>Our Mission</h2>

Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc porta scelerisque interdum. Donec est velit, scelerisque nec hendrerit at, suscipit feugiat nisl. Vestibulum a massa ac lacus congue auctor. Mauris congue est metus, nec iaculis purus placerat vel.

Duis dictum sapien est, vel laoreet diam imperdiet ut. Nullam posuere fermentum eros, vitae tristique libero dictum a. Praesent vel ante quis leo mollis lobortis. Nullam tincidunt aliquet eros, ut facilisis purus rhoncus ac.

[/tab_content]

[tab_title]

Tradition

[/tab_title]

[tab_content]

<h2>Our Tradition</h2>

Nullam tincidunt aliquet eros, ut facilisis purus rhoncus ac. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc porta scelerisque interdum. Donec est velit, scelerisque nec hendrerit at, suscipit feugiat nisl. Vestibulum a massa ac lacus congue auctor.

Mauris congue est metus, nec iaculis purus placerat vel. Duis dictum sapien est, vel laoreet diam imperdiet ut. Nullam posuere fermentum eros, vitae tristique libero dictum a. Praesent vel ante quis leo mollis lobortis.

[/tab_content]

[/tabs]

[/one_half]

[one_half_last]

<h2>Why Choose Us</h2>

[list type="icon" icon="chevron-right" style="simple"]

<ul>
<li><strong>100% responsive layout.</strong><br />Your site will look great on any screen size</li>
<li><strong>Unlimited colors.</strong><br />Define your color and all gradients will be generated</li>
<li><strong>Hundreds of fonts.</strong><br />(Google Web Fonts, Font-Face, System Fonts)</li>
<li><strong>Multiple Templates.</strong><br />Customize your pages, blog and portfolio sections</li>
<li><strong>Ongoin Support</strong><br />Design Audit included for FREE</li>
</ul>

[/list]

[/one_half_last]

[divider]

<h2>Meet Us & Our Alter Egos</h2>

[one_third]

[before_after width="304" height="171" before_src="/wp-content/uploads/2013/04/person_03_v01.jpg" after_src="/wp-content/uploads/2013/04/person_03_v02.jpg" type="flip"]

<h3>Steve Williams</h3>
<h5>— CEO & Founder</h5>

Nam rhoncus ullamcorper orci, ultrices posuere turpis. Sed convallis at dolor ac fermentum. Phasellus id neque luctus quam.

[/one_third]

[one_third]

[before_after width="304" height="171" before_src="/wp-content/uploads/2013/04/person_02_v01.jpg" after_src="/wp-content/uploads/2013/04/person_02_v02.jpg" type="flip"]

<h3>Anna Jessica Smith</h3>
<h5>— Creative Director</h5>

Nam rhoncus ullamcorper orci, ultrices posuere turpis. Sed convallis at dolor ac fermentum. Phasellus id neque luctus quam.

[/one_third]

[one_third_last]

[before_after width="304" height="171" before_src="/wp-content/uploads/2013/04/person_01_v01.jpg" after_src="/wp-content/uploads/2013/04/person_01_v02.jpg" type="flip"]

<h3>Michael Novitzky</h3>
<h5>— Tech Lead</h5>

Nam rhoncus ullamcorper orci, ultrices posuere turpis. Sed convallis at dolor ac fermentum. Phasellus id neque luctus.

[/one_third_last]
G1_HEREDOC_DELIMITER;

    $generator->add_snippet( '*** Home #5', array(
        'label'			=> 'Home #5',
        'result'		=> $snippet,
        'section'		=> 'homepagesnippets',
    ));

// HOME #6
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
[one_fourth valign="middle"]

<h2>Easy to Use</h2>
<h4>Curabitur Quam Arcu Porta</h4>

Curabitur quam arcu, porta ac arcu eget, commodo malesuada turpis. Donec ac rutrum libero.

[/one_fourth]

[three_fourth_last valign="middle"]

[one_half valign="middle"]

<img src="/wp-content/uploads/2013/04/customize_01_v01.png" alt="Customizations" width="470" height="460" />

[/one_half]

[one_half_last valign="middle"]

[list type="icon" style="simple" icon="chevron-right"]

<ul>
<li>Beautiful Demo Versions To Help You Start</li>
<li>Powerful Admin Panel</li>
<li>Intelligent Shortcodes & Shortcode Generator</li>
<li>Help Mode To Simplify Development</li>
<li>The Theme Is Well Documented</li>
</ul>

[/list]

[button link="#" style="solid"]Learn More[/button]

[/one_half_last]

[/three_fourth_last]

[divider]

[one_fourth]

<h2>Our Portfolio</h2>

Nam rhoncus blandit pharetra. Suspendisse placerat id tortor vitae euismod. Nunc ac porttitor velit.

<a href="#">See All Works</a>

[/one_fourth]

[three_fourth_last]

[recent_works max="9" template="one_fourth_gallery" effect="grayscale" hide="summary,categories,tags,button_1"]

[/three_fourth_last]

[space value="4.5em"]

[one_fourth]

<img src="/wp-content/uploads/2013/06/woman_pointing_1_v01.png" alt=""/>

[/one_fourth]

[three_fourth_last]

[box]

<h2 class="g1-h1">Curabitur quam arcu, porta</h2>

<p class="g1-h3">Curabitur quam arcu, porta ac arcu eget</p>

[one_half]

Aliquam ut enim quis enim viverra mollis. Nam rhoncus blandit pharetra. Suspendisse placerat id tortor vitae euismod. Nunc ac porttitor velit, at vehicula nisi. Curabitur quam arcu, porta ac arcu eget, commodo malesuada turpis. Donec ac rutrum libero.

[button size="medium" link="#"]Buy at Theme Forest[/button]

[/one_half]

[one_half_last]

Aliquam ut enim quis enim viverra mollis. Nam rhoncus blandit pharetra. Suspendisse placerat id tortor vitae euismod. Nunc ac porttitor velit, at vehicula nisi. Curabitur quam arcu, porta ac arcu eget, commodo malesuada turpis. Donec ac rutrum libero.

[button size="medium" link="#" style="simple"]Buy at Theme Forest[/button]

[/one_half_last]

[/box]

[/three_fourth_last]

[space value="4.5em"]

[one_fourth]

<h2>Unique Features</h2>

Curabitur quam arcu, porta ac arcu eget, commodo malesuada turpis. Donec ac rutrum libero.

[/one_fourth]

[three_fourth_last]

[one_half]

<h3>[icon name="beaker" size="small" style="solid" shape="circle"] Demo Content</h3>

Import the included demo content and choose from a bunch of exceptional demo skin versions.

[/one_half]

[one_half_last]

<h3>[icon name="star" size="small" style="solid" shape="circle"] Ongoing Support</h3>

Need help? We do our best to make your life easier. Support for all our products is conducted through our support forum.

[/one_half_last]

[space]

[one_half]

<h3>[icon name="magic" size="small" style="solid" shape="circle"] Design Audits</h3>

Our support includes more than just a regular help with configuration. We want you to be proud of the final result.

[/one_half]

[one_half_last]

<h3>[icon name="info" size="small" style="solid" shape="circle"] Help Mode</h3>

The Help Mode is a smart tool which provides useful, context-aware tips throughout the site.

[/one_half_last]

[space]

[one_half]

<h3>[icon name="check" size="small" style="solid" shape="circle"] Retina Ready</h3>

All the images included with the theme are 100% Retina Ready so look beautiful and sharp on high resolution devices.

[/one_half]

[one_half_last]

<h3>[icon name="cog" size="small" style="solid" shape="circle"] Admin Panel</h3>

The 3clicks has powerful theme options panel which allow you to customize every single part of your site.

[/one_half_last]

[/three_fourth_last]
G1_HEREDOC_DELIMITER;

    $generator->add_snippet( '*** Home #6', array(
        'label'			=> 'Home #6',
        'result'		=> $snippet,
        'section'		=> 'homepagesnippets',
    ));

// HOME #7
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
[section background_color="#ffcc00" background_image="/wp-content/uploads/2013/09/monster_bg_v01.png" background_position="center bottom" background_repeat="repeat-x" padding_bottom="0"]

[one_third valign="middle"]

<h2 class="g1-h1" style="color:#000000;">Be Creative!</h1>

<p style="color:#735b00;">Maecenas condimentum tincidunt elit, at aliquet sem pharetra non. Aliquam ultrices nisi at nibh lacinia facilisis sed sit amet nunc. Aliquam a est orci.</p>

[button link="/" style="simple" bg_color="#000000" text_color="#000000"]Read More[/button]

[space]

[/one_third]

[two_third_last valign="middle"]

<div><img src="/wp-content/uploads/2013/09/monster_v01.png" alt="" /></div>

[/two_third_last]

[/section]

[section background_image="/wp-content/uploads/2013/09/hand_tablet_bg_v01.jpg" background_position="bottom center" background_repeat="no-repeat" padding_bottom="400"]

[one_third]

<h2>Fully Responsive</h2>

Maecenas condimentum tincidunt elit, at aliquet sem pharetra non. Aliquam ultrices nisi at nibh lacinia facilisis sed sit amet nunc. Aliquam a est orci. Curabitur pulvinar fermentum purus sodales auctor.

[button link="/" style="simple"]Read More[/button]

[/one_third]

[one_third]

<h2>Mobile Optimized</h2>

Maecenas condimentum tincidunt elit, at aliquet sem pharetra non. Aliquam ultrices nisi at nibh lacinia facilisis sed sit amet nunc. Aliquam a est orci. Curabitur pulvinar fermentum purus sodales auctor.

[button link="/" style="simple"]Read More[/button]

[/one_third]

[one_third_last]

<h2>Retina Ready</h2>

Maecenas condimentum tincidunt elit, at aliquet sem pharetra non. Aliquam ultrices nisi at nibh lacinia facilisis sed sit amet nunc. Aliquam a est orci. Curabitur pulvinar fermentum purus sodales auctor.

[button link="/" style="simple"]Read More[/button]

[/one_third_last]

[/section]

[section background_image="/wp-content/uploads/2013/09/leafs_bg_v01.jpg" background_repeat="repeat" background_position="top top" background_scroll="standard" background_attachment="fixed" padding_top="60" padding_bottom="60"]

<h2 class="g1-h1" style="text-align:center; color:#ffffff;">Vestibulum Mauris Sed Eismod Aliquet</h2>
<h3 style="text-align:center; color:#ffffff;">Accumsan purus ultricies massa venenatis, id tincidunt massa tincidunt</h3>

[one_third]

[box icon="magic" style="solid"]

<h2>Corner Roundness</h2>

<hr />

You’ll be amazed how easily change the look of the whole site only by changing its corners type.

<a href="/customize/corner-roundness/">— Read More —</a>

[/box]

[/one_third]

[one_third]

[box icon="tint" style="solid"]

<h2>Unlimited Colors</h2>

<hr />

Changing page colors never was so easy. You can set up your company ID colors in just a few minutes.

<a href="/customize/unlimited-colors/">— Read More —</a>

[/box]

[/one_third]

[one_third_last]

[box icon="exchange" style="solid"]

<h2>Header Layouts</h2>

<hr />

Header is one of the most important part of your page so we want to make sure it fits your need.

<a href="/customize/header-layouts/">— Read More —</a>

[/box]

[/one_third_last]

[/section]

[section background_scroll="standard" background_image="/wp-content/uploads/2013/09/orange_bg_v01.jpg" background_repeat="no-repeat" background_position="center top" padding_top="260" padding_bottom="260"]

<h2 class="g1-h1" style="text-align:center;">"Maecenas condimentum tincidunt elit, at aliquet sem pharetra non. Aliquam ultrices nisi at nibh lacinia facilisis sed sit amet nunc"</h2>

[/section]

[section background_color="#000000" background_image="/wp-content/uploads/2013/09/girl_bg_v01.jpg" background_repeat="no-repeat" background_position="bottom center" padding_top="60" padding_bottom="580"]

<h2 class="g1-h1" style="text-align:center; color:#ffffff;">Beautiful Design in Every Detail</h2>
<h3 style="text-align:center; color="#999999">Cras vestibulum eu mauris sed euismod. Donec vel dignissim dui, non aliquet</h3>

[/section]

[section padding_top="60" padding_bottom="60"]

<h2 class="g1-h1" style="text-align:center;">You Will Love 3Clicks As Much As We Do</h2>
<h3 style="text-align:center;">Ullamcorper mi viverra quis. Sed nec suscipit felis.</h3>

[space]

<div style="text-align:center;">[button style="solid" size="big"]Get Started with 3Clicks[/button] [button style="simple" size="big"]Get Started with 3Clicks[/button]</div>

[/section]
G1_HEREDOC_DELIMITER;

    $generator->add_snippet( '*** Home #7', array(
        'label'			=> 'Home #7',
        'result'		=> $snippet,
        'section'		=> 'homepagesnippets',
    ));

}

add_action( 'g1_shortcode_generator_register', 'g1_shortgen_home_page_snippets' );