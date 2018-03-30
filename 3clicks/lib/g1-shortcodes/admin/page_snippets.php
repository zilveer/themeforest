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
function g1_shortgen_section_page_snippets( $generator ) {
    $generator->add_section( 'pagesnippets', array(
        'label' => __( 'Page Snippets', 'g1_theme' ),
        'priority' => 510,
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_page_snippets', 9 );


/**
 * Adds shortcode snippets to the global shortcode generator
 *
 * @param G1_Shortcode_Generator $generator
 */

function g1_shortgen_page_snippets( $generator ) {

// ABOUT US
// ========
    $snippet = <<<G1_HEREDOC_DELIMITER
[one_half valign="middle"]

[before_after width="719" height="404" type="flip" linking="default" before_src="/wp-content/uploads/2013/06/our_office_outside_1_v01.jpg" after_src="/wp-content/uploads/2013/06/our_office_inside_1_v01.jpg"]

[/one_half]

[one_half_last valign="middle"]

<h2>How We Work</h2>

<hr />

[lead]

Aenean dignissim ac leo et varius. Maecenas enim leo, pharetra nec cursus eu, pellentesque eget sapien. Morbi pellentesque non nulla a scelerisque. Pellentesque mollis erat et elit porta venenatis augue.

[/lead]

[/one_half_last]

[divider icon="long-arrow-down"]

[one_third animation="fade_in"]

<h2>Our Skills</h2>

[progress_bar icon="picture" value="90" size="medium" style="solid"]Web Design[/progress_bar]

[progress_bar icon="html5" value="85" size="medium" style="solid"]HTML[/progress_bar]

[/one_third]

[one_third animation="fade_in"]

<h2>Satisfaction Guaranteed</h2>

[quote author_name="George Novitzky" author_description="Some Company" author_image="/wp-content/uploads/2013/06/quote_author_image_1_v01.jpg" size="small" style="solid"]

Auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod.

[/quote]

[/one_third]

[one_third_last animation="fade_in"]

<h2>Fun Facts About Us</h2>

[duplicator size="small" start="0" stop="11" max="25" icon="music" style="simple"]

<h4>11 Members Are Musicians</h4>

[/one_third_last]

[divider icon="long-arrow-down"]

<h2>Our Core Values</h2>

[one_half]

[one_sixth]

[icon name="thumbs-up" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3>Value Teamwork</h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half]

[one_half_last]

[one_sixth]

[icon name="thumbs-up" size="medium" style="simple"]

[/one_sixth]

[five_sixth_last]

<h3>Lead by Example</h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half_last]

[space]

[one_half]

[one_sixth]

[icon name="thumbs-up" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3>Focus on the Future</h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half]

[one_half_last]

[one_sixth]

[icon name="thumbs-up" size="medium" style="simple"]

[/one_sixth]

[five_sixth_last]

<h3>Be Respectful</h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half_last]

[space]

[one_half]

[one_sixth]

[icon name="thumbs-up" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3>Challenge the Status Quo</h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half]

[one_half_last]

[one_sixth]

[icon name="thumbs-up" size="medium" style="simple"]

[/one_sixth]

[five_sixth_last]

<h3>Strive for Excellence</h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half_last]

[divider icon="long-arrow-down"]

<h2>Key Customers</h2>

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_1_v01.png" alt="brand_logo_1_v01" width="171" height="77" />

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_2_v01.png" alt="brand_logo_2_v01" width="171" height="77" />

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_3_v01.png" alt="brand_logo_3_v01" width="171" height="77" />

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_4_v01.png" alt="brand_logo_4_v01" width="171" height="77" />

[/one_fifth]

[one_fifth_last]

<img src="/wp-content/uploads/2013/06/brand_logo_5_v01.png" alt="brand_logo_5_v01" width="171" height="77"/>

[/one_fifth_last]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_3_v01.png" alt="brand_logo_3_v01" width="171" height="77"/>

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_3_v01.png" alt="brand_logo_5_v01" width="171" height="77"/>

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_1_v01.png" alt="brand_logo_1_v01" width="171" height="77"/>

[/one_fifth]

[one_fifth]

<img src="/wp-content/uploads/2013/06/brand_logo_4_v01.png" alt="brand_logo_4_v01" width="171" height="77"/>

[/one_fifth]

[one_fifth_last]

<img src="/wp-content/uploads/2013/06/brand_logo_2_v01.png" alt="brand_logo_2_v01" width="171" height="77"/>

[/one_fifth_last]

[divider icon="long-arrow-down"]

<div style="text-align:center;">

<h2>What else can we do to convince you?</h2>

[button size="big" link="/" style="solid"]Contact Us[/button] [button size="big" link="/" style="simple"]Join Our Team[/button]

</div>
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** About Us', array(
        'label'			=> 'About Us',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

// HISTORY
// ========
    $snippet = <<<G1_HEREDOC_DELIMITER
[one_half valign="middle"]

<h2>Over 20 Years On The Market</h2>

[lead]

Morbi congue tincidunt erat, eget suscipit nisl blandit sed. Phasellus et fringilla quam. Integer leo purus, ullamcorper ac dignissim a, ultrices nec justo. Duis feugiat ornare arcu quis faucibus vivamus adispicing.

[/lead]

[/one_half]

[one_half_last valign="middle"]

[frame linking="lightbox" link="/wp-content/uploads/2013/03/photo_14_v011.jpg" align="left" style="simple" shape="square"]<img src="/wp-content/uploads/2013/03/photo_14_v011.jpg" />[/frame]

[/one_half_last]

[divider]

[tabs]

[tab_title]1980-1987[/tab_title]

[tab_content]

[one_third]

<h3>1980</h3>

[list type="icon" icon="ok" style="simple"]
<ul>
<li>Proin sit amet mauris lorem</li>
<li>Sollicitudin, rhoncus ligula nec</li>
<li>Ut et libero malesuada ipsum</li>
<li>Convallis justo in, luctus dolor</li>
</ul>
[/list]

Etiam consectetur fermentum justo commodo eleifend. Nulla ac eros nec tortor mollis sodales. Quisque malesuada vulputate neque, eu blandit lectus feugiat a.

[/one_third]

[one_third]

<h3>1985</h3>

[list type="icon" icon="ok" style="simple"]
<ul>
<li>Proin sit amet mauris lorem</li>
<li>Sollicitudin, rhoncus ligula nec</li>
<li>Ut et libero malesuada ipsum</li>
<li>Convallis justo in, luctus dolor</li>
</ul>
[/list]

Nam egestas malesuada tellus ornare tincidunt. Nam tortor arcu, consequat quis semper euismod, ornare ut arcu. Nullam dictum, metus vel fringilla pharetra, orci augue commodo orci.

[/one_third]

[one_third_last]

<h3>1987</h3>

[list type="icon" icon="ok" style="simple"]
<ul>
<li>Proin sit amet mauris lorem</li>
<li>Sollicitudin, rhoncus ligula nec</li>
<li>Ut et libero malesuada ipsum</li>
<li>Convallis justo in, luctus dolor</li>
</ul>
[/list]

Etiam viverra dui sed leo condimentum blandit. Vestibulum volutpat erat nec congue semper. Etiam pretium a massa vel tincidunt.

[/one_third_last]

[/tab_content]

[tab_title]1987-1995[/tab_title]

[tab_content]

Etiam consectetur fermentum justo commodo eleifend. Nulla ac eros nec tortor mollis sodales. Quisque malesuada vulputate neque, eu blandit lectus feugiat a. Nam egestas malesuada tellus ornare tincidunt. Nam tortor arcu, consequat quis semper euismod, ornare ut arcu. Nullam dictum, metus vel fringilla pharetra, orci augue commodo orci, sed mollis nunc erat vel tellus. Proin malesuada semper ullamcorper. Aliquam ut viverra turpis. Maecenas enim augue, volutpat eget venenatis non, laoreet a mauris.

[/tab_content]

[tab_title]1995-2013[/tab_title]

[tab_content]

Etiam consectetur fermentum justo commodo eleifend. Nulla ac eros nec tortor mollis sodales. Quisque malesuada vulputate neque, eu blandit lectus feugiat a. Nam egestas malesuada tellus ornare tincidunt. Nam tortor arcu, consequat quis semper euismod, ornare ut arcu. Nullam dictum, metus vel fringilla pharetra, orci augue commodo orci, sed mollis nunc erat vel tellus. Proin malesuada semper ullamcorper. Aliquam ut viverra turpis. Maecenas enim augue, volutpat eget venenatis non, laoreet a mauris.

[/tab_content]

[tab_title]Future[/tab_title]

[tab_content]

Etiam consectetur fermentum justo commodo eleifend. Nulla ac eros nec tortor mollis sodales. Quisque malesuada vulputate neque, eu blandit lectus feugiat a. Nam egestas malesuada tellus ornare tincidunt. Nam tortor arcu, consequat quis semper euismod, ornare ut arcu. Nullam dictum, metus vel fringilla pharetra, orci augue commodo orci, sed mollis nunc erat vel tellus. Proin malesuada semper ullamcorper. Aliquam ut viverra turpis. Maecenas enim augue, volutpat eget venenatis non, laoreet a mauris.

[/tab_content]

[/tabs]

[divider style="simple"]

<h2>What We Are Proud Of</h2>

[one_third animation="fade_in"]

Etiam pretium a massa vel tincidunt. Aenean condimentum ac mi a molestie. Vivamus turpis ipsum, pulvinar sed tincidunt vitae.

Eeleifend id sapien. Maecenas hendrerit, metus a vestibulum tempor vivamus sit.

[/one_third]

[one_third animation="fade_in"]

[duplicator size="small" start="0" stop="31" max="31" icon="user" style="simple"]

<h4>31 Happy Clients</h4>

[/one_third]

[one_third_last animation="fade_in"]

[duplicator size="small" start="0" stop="35" max="35" icon="ok-circle"]

<h4>35 Finished Projects</h4>

[/one_third_last]

[divider style="simple"]

<h2>Our History In Details</h2>

[one_half]

[toggle title="1980" state="on" icon="calendar"]

<strong>Founded by</strong> John Michael Doe

[_one_half]

<img src="/wp-content/uploads/2013/04/person_03_v01.jpg" />

[/_one_half]

[_one_half_last]

Tincidunt nisi eu quam mattis eget ullamcorper nulla commodo. Mauris eu quam erat. Ut vitae augue nec enim lobortis aliquet. Mauris eu quam erat. Ut vitae augue nec enim lobortis aliquet.

[/_one_half_last]

Tincidunt nisi eu quam mattis eget ullamcorper nulla commodo. Mauris eu quam erat. Ut vitae augue nec enim lobortis aliquet.

[/toggle]

[toggle title="1989" icon="calendar"]

<strong>Next important year</strong>

Tincidunt nisi eu quam mattis eget ullamcorper nulla commodo. Mauris eu quam erat. Ut vitae augue nec enim lobortis aliquet
Tincidunt nisi eu quam mattis eget ullamcorper nulla commodo. Mauris eu quam erat. Ut vitae augue nec enim lobortis aliquet

[/toggle]

[toggle title="2013" icon="calendar"]

<strong>Current year</strong>

Tincidunt nisi eu quam mattis eget ullamcorper nulla commodo. Mauris eu quam erat. Ut vitae augue nec enim lobortis aliquet
Tincidunt nisi eu quam mattis eget ullamcorper nulla commodo. Mauris eu quam erat. Ut vitae augue nec enim lobortis aliquet

[/toggle]

[/one_half]

[one_half_last]

<h2>Our Tradition</h2>

[quote author_name="John Michael Doe" author_description="Founder & First CEO" author_image="/wp-content/uploads/2013/06/quote_author_image_1_v01.jpg" size="big" style="simple"]

Phasellus luctus vehicula nisi, sed pellentesque lorem placerat id. Sed at suscipit nisl, non placerat erat. Nulla facilisi. Sed vitae hendrerit libero. Morbi vel nulla mi. Phasellus a urna eget mi condimentum aliquam.

[/quote]

[/one_half_last]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** History', array(
        'label'			=> 'History',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

// SERVICES
// ========
    $snippet = <<<G1_HEREDOC_DELIMITER
<h2 style="text-align:center;">Core Services - at a Glance</h2>

[one_third]

[box icon="keyboard"]

<h3>Web Development</h3>

[lead]

Gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula.

[/lead]

<a href="#">— Read More —</a>

[/box]

[/one_third]

[one_third]

[box icon="pencil"]

<h3>Web Design</h3>

[lead]

Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est amet quis.

[/lead]

<a href="#">— Read More —</a>

[/box]

[/one_third]

[one_third_last]

[box icon="thumbs-up"]

<h3>SEO</h3>

[lead]

Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus.

[/lead]

<a href="#">— Read More —</a>

[/box]

[/one_third_last]

[divider style="simple"]

[one_half]

[one_sixth]

[icon name="camera" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3><a href="#">Photoshop Courses</a></h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half]

[one_half_last]

[one_sixth]

[icon name="camera" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3><a href="#">Web Marketing</a></h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half_last]

[space px="22"]

[one_half]

[one_sixth]

[icon name="camera" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3><a href="#">Web Hosting</a></h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half]

[one_half_last]

[one_sixth]

[icon name="camera" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3><a href="#">Photoshop Courses</a></h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half_last]

[space px="22"]

[one_half]

[one_sixth]

[icon name="camera" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3><a href="#">Photoshop Courses</a></h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half]

[one_half_last]

[one_sixth]

[icon name="camera" size="medium" style="solid"]

[/one_sixth]

[five_sixth_last]

<h3><a href="#">Photoshop Courses</a></h3>

Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus

[/five_sixth_last]

[/one_half_last]

[divider style="simple"]

[rev_slider content-slider-2]

[divider style="simple"]

<div style="text-align:center;">

[one_third]

<span>[icon icon="pencil" size="big" style="solid" shape="circle"]</span>

<h2>Web Design</h2>

[list type="empty" style="simple"]
<ul>
<li>Proin sit amet mauris lorem</li>
<li>Sollicitudin, rhoncus ligula nec</li>
<li>Ut et libero malesuada ipsum</li>
<li>Convallis justo in, luctus dolor</li>
</ul>
[/list]

[/one_third]

[one_third]

<span>[icon icon="keyboard" size="big" style="solid" shape="circle"]</span>

<h2>Web Development</h2>

[list type="empty" style="simple"]
<ul>
<li>Proin sit amet mauris lorem</li>
<li>Sollicitudin, rhoncus ligula nec</li>
<li>Ut et libero malesuada ipsum</li>
<li>Convallis justo in, luctus dolor</li>
<li>In non ipsum eget libero sit</li>
</ul>
[/list]

[/one_third]

[one_third_last]

<span>[icon icon="thumbs-up" size="big" style="solid" shape="circle"]</span>

<h2>Online Marketing</h2>

[list type="empty" style="simple"]
<ul>
<li>Proin sit amet mauris lorem</li>
<li>Sollicitudin, rhoncus ligula nec</li>
<li>Ut et libero malesuada ipsum</li>
<li>Convallis justo in, luctus dolor</li>
</ul>
[/list]

[/one_third_last]

</div>

[divider style="simple"]

<h2>Recent Case Studies</h2>

[recent_works max="3" template="one_third" effect="grayscale" hide="comments_link,summary,categories,tags,button_1"]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** Services', array(
        'label'			=> 'Services',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

// PRICING
// ========
    $snippet = <<<G1_HEREDOC_DELIMITER
<h2 style="text-align:center;">Dedicated Solutions For Your Business</h2>

[one_third]

[box icon="star-empty"]

<h2 style="text-align: center;">Starter</h2>
<h4 style="text-align: center;">Vivamus Adispicing</h4>

[divider]

[list type="empty" style="simple"]
<ul>
<li>Curabitur euismod ipsum dolor</li>
<li>Tincidunt lacinia sit adispicing</li>
<li>Morbi adipis vivamus elit</li>
</ul>
[/list]

[divider]

<h1 style="text-align: center;">$19<sup>99</sup><sub>/mo</sub></h1>

[divider]

[button link="/" size="medium" type="wide" bg_color="#cccccc" text_color="#666666"]Sign Up[/button]

[/box]

[/one_third]

[one_third]

[box icon="star"]

<h2 style="text-align: center;">Advanced</h2>
<h4 style="text-align: center;">Vivamus Adispicing</h4>

[divider]

[list type="empty" style="simple"]
<ul>
<li>Curabitur euismod ipsum dolor</li>
<li>Tincidunt lacinia sit adispicing</li>
<li>Morbi adipis vivamus elit</li>
</ul>
[/list]

[divider]

<h1 style="text-align: center;">$39<sup>99</sup><sub>/mo</sub></h1>

[divider]

[button link="/" size="medium" type="wide"]Sign Up[/button]

[/box]

[/one_third]

[one_third_last]

[box icon="star-half-empty"]

<h2 style="text-align: center;">Business</h2>
<h4 style="text-align: center;">Vivamus Adispicing</h4>

[divider]

[list type="empty" style="simple"]
<ul>
<li>Curabitur euismod ipsum dolor</li>
<li>Tincidunt lacinia sit adispicing</li>
<li>Morbi adipis vivamus elit</li>
</ul>
[/list]

[divider]

<h1 style="text-align: center;">$29<sup>99</sup><sub>/mo</sub></h1>

[divider]

[button link="/" size="medium" type="wide" bg_color="#cccccc" text_color="#666666"]Sign Up[/button]

[/box]

[/one_third_last]

[divider icon="question-sign"]

<h2 style="text-align:center;">Quick Pricing View</h2>

[table style="solid"]
<table>
<thead>
<tr>
<th>Column 1</th>
<th>Column 2</th>
<th>Column 3</th>
<th>Column 4</th>
</tr>
</thead>
<tfoot>
<tr>
<td><strong>All Items</strong></td>
<td><strong>Item Info</strong></td>
<td><strong>Total Price</strong></td>
<td><strong>$99</strong></td>
</tr>
</tfoot>
<tbody>
<tr>
<td>Item #1</td>
<td>Item Data</td>
<td>Item Price</td>
<td>$10</td>
</tr>
<tr>
<td>Item #2</td>
<td>Item Data</td>
<td>Item Price</td>
<td>$50</td>
</tr>
<tr>
<td>Item #3</td>
<td>Item Data</td>
<td>Item Price</td>
<td>$19</td>
</tr>
<tr>
<td>Item #4</td>
<td>Item Data</td>
<td>Item Price</td>
<td>$20</td>
</tr>
</tbody>
</table>
[/table]

[divider icon="question-sign"]

<h2 style="text-align:center;">Common Questions</h2>

[one_half]

<h3>Do you have setup fees or contracts?</h3>

Curabitur sollicitudin ac nunc eu auctor. Proin ac metus id est vestibulum venenatis. Aliquam id pretium nunc. Cras imperdiet massa tortor, pharetra accumsan tortor lacinia suscipit.

[/one_half]

[one_half_last]

[toggle state="on" style="simple" title="How much does it cost?"]

[two_third]

In porttitor vulputate vehicula. Fusce lacinia varius libero, et ullamcorper magna aliquam ut. Nulla non sodales mi, ut mollis nisi. Quisque diam nulla, ornare id elementum nec, ullamcorper quis dui.

[/two_third]

[one_third_last]

<img style="width: 70px;" src="/wp-content/uploads/2013/06/free_badge_1_v01.png" />

[/one_third_last]

[/toggle]

[/one_half_last]

[one_half]

<h3>What is the billing cycle?</h3>

Aliquam accumsan aliquam nibh id sagittis. Nulla id purus mattis, consectetur purus sed, molestie nulla. Curabitur tempor velit sit amet dolor sagittis pretium. Integer ac libero et massa fringilla venenatis rhoncus nec orci.

[/one_half]

[one_half_last]

[toggle style="simple" title="How many users can I add using regular license?"]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu elit quis eros ornare ullamcorper. Duis porta interdum urna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.

[/toggle]

[toggle style="simple" title="How many users can I add using regular license?"]

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu elit quis eros ornare ullamcorper. Duis porta interdum urna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.

[/toggle]

[/one_half_last]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** Pricing', array(
        'label'			=> 'Pricing',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

// TESTIMONIALS
// ============
    $snippet = <<<G1_HEREDOC_DELIMITER
<h1 style="text-align: center;">What Our Clients Say About Us</h1>
<h3 style="text-align: center;">Vivamus turpis ipsum, pulvinar sed tincidunt vitae. Duis pulvinar mattis nib</h3>

[divider icon="comments"]

[one_half]

[quote author_name="George Novitzky" author_description="Some Company CEO" author_image="/wp-content/uploads/2013/06/quote_author_image_1_v01.jpg" size="medium" style="solid"]

Auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris.

[/quote]

[/one_half]

[one_half_last]

[quote author_name="John Smith" author_description="Some Company Creative Director" author_image="/wp-content/uploads/2013/04/person_portrait_1-55x55.jpg" size="medium" style="solid"]

Suspendisse ut posuere augue. Sed semper rhoncus volutpat. Cras eget mi eu nibh vulputate pretium sed et massa. Nulla ut libero eget turpis mollis hendrerit.

[/quote]

[/one_half_last]

<hr />

[one_third]

[quote size="small" author_name="Jane Doe" author_description="President Of Some Company" author_image="/wp-content/uploads/2013/06/quote_author_image_2_v01.jpg"]

In commodo leo nulla, vehicula elementum purus vestibulum non. Morbi sodales odio mauris, in molestie sapien faucibus tristique. Nulla porta mauris a purus.

Etiam pretium a massa vel tincidunt. Aenean condimentum ac mi a molestie. Vivamus turpis ipsum, pulvinar sed tincidunt vitae.

[/quote]

[/one_third]

[one_third]

[quote size="small" author_name="John Smith" author_description="Some Company Founder"]

Etiam pretium a massa vel tincidunt. Aenean condimentum ac mi a molestie. Vivamus turpis ipsum, pulvinar sed tincidunt vitae.

Integer porta molestie massa vitae cursus. Vivamus a bibendum magna. Proin in turpis condimentum, fermentum justo sed, sollicitudin nibh. Nulla vitae hendrerit.

[/quote]

[/one_third]

[one_third_last]

[quote size="small" author_name="John Doe" author_description="Marketing Manager" author_image="/wp-content/uploads/2013/04/person_portrait_1-55x55.jpg"]

Suspendisse ut posuere augue. Sed semper rhoncus volutpat. Cras eget mi eu nibh vulputate pretium sed et massa. Nulla ut libero eget turpis mollis hendrerit.

Etiam pretium a massa vel tincidunt. Aenean condimentum ac mi a molestie. Vivamus turpis ipsum, pulvinar sed tincidunt vitae.

[/quote]

[/one_third_last]

[divider style="simple"]

<h2>Our Happy Customers</h2>

<img src="/wp-content/uploads/2013/06/clients_grid.jpg" alt=""/>

[divider style="simple"]

<h2>Interesting Facts About Our Clients</h2>

[one_third animation="fade_in"]

[progress_circle value="88" icon="thumbs-up" style="simple"]

<h3>88% Our Clients Stay With Us</h3>

[/one_third]

[one_third animation="fade_in"]

[progress_circle value="57" icon="plane" style="solid"]

<h3>57% Fear Of Flying</h3>

[/one_third]

[one_third_last animation="fade_in"]

[progress_circle value="33" icon="coffee" style="simple"]

<h3>Only 33% Like Coffee</h3>

[/one_third_last]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** Testimonials', array(
        'label'			=> 'Testimonials',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

// TEAM
// ====
    $snippet = <<<G1_HEREDOC_DELIMITER
[one_half]

<h1>We Are Creatives.
We Design & Develop Smart Products For You</h1>

[button size="medium" link="/"]Drop Us a Message[/button]

[/one_half]

[one_half_last]

[lead]

Ut mattis consequat erat, ut adipiscing neque lacinia eget. Suspendisse potenti. Pellentesque accumsan velit id ipsum rutrum pretium. Quisque rhoncus lacus posuere mi aliquam scelerisque.

Aliquam semper facilisis eros, sed porta erat fermentum eu. Etiam fermentum pharetra massa, consectetur malesuada dui congue vel.

Duis aliquam leo a laoreet cursus. Morbi mattis tincidunt arcu, vel semper enim vulputate a. Nullam vitae elit a tortor cursus lobortis. Aliquam tincidunt ante libero.

[/lead]

[/one_half_last]

[divider style="simple"]

<h2>Meet Our Team</h2>

[one_third]

[before_after width="304" height="171" before_src="/wp-content/uploads/2013/04/person_03_v01.jpg" after_src="/wp-content/uploads/2013/04/person_03_v02.jpg" type="flip"]

<h3>Steve Williams</h3>
<h5>— CEO & Founder</h5>

[list type="icon" icon="trophy" style="simple"]
<ul>
<li>2013 Award Condimentum</li>
<li>2011 Next Award Condimentum</li>
<li>2011 Grand Prix Co Pellentesque</li>
</ul>
[/list]

Nam rhoncus ullamcorper orci, ultrices posuere turpis. Sed convallis at dolor ac fermentum. Phasellus id neque luctus quam.

[/one_third]

[one_third]

[before_after width="304" height="171" before_src="/wp-content/uploads/2013/04/person_02_v01.jpg" after_src="/wp-content/uploads/2013/04/person_02_v02.jpg" type="flip"]

<h3>Anna Jessica Smith</h3>
<h5>— Creative Director</h5>

[list type="icon" icon="trophy" style="simple"]
<ul>
<li>2013 Award Condimentum</li>
<li>2011 Next Award Condimentum</li>
<li>2011 Grand Prix Co Pellentesque</li>
</ul>
[/list]

Nam rhoncus ullamcorper orci, ultrices posuere turpis. Sed convallis at dolor ac fermentum. Phasellus id neque luctus quam.

[/one_third]

[one_third_last]

[before_after width="304" height="171" before_src="/wp-content/uploads/2013/04/person_01_v01.jpg" after_src="/wp-content/uploads/2013/04/person_01_v02.jpg" type="flip"]

<h3>Michael Novitzky</h3>
<h5>— Tech Lead</h5>

[list type="icon" icon="trophy" style="simple"]
<ul>
<li>2013 Award Condimentum</li>
<li>2011 Next Award Condimentum</li>
<li>2011 Grand Prix Co Pellentesque</li>
</ul>
[/list]

Nam rhoncus ullamcorper orci, ultrices posuere turpis. Sed convallis at dolor ac fermentum. Phasellus id neque luctus.

[/one_third_last]

[divider style="simple"]

<h2>Our Awesome Skills</h2>

[one_half]

[progress_bar value="80" icon="code" direction="left" size="medium"]WordPress[/progress_bar]

[progress_bar value="60" icon="code" direction="left" size="medium"]Drupal[/progress_bar]

[progress_bar value="40" icon="code" direction="left" size="medium"]Joomla[/progress_bar]

[/one_half]

[one_half_last]

[progress_bar value="80" icon="pencil" size="medium" style="simple"]Photoshop[/progress_bar]

[progress_bar value="60" icon="pencil" size="medium" style="simple"]Illustrator[/progress_bar]

[progress_bar value="40" icon="pencil" size="medium" style="simple"]InDesign[/progress_bar]

[/one_half_last]

[divider style="simple"]

<h2>Our Office</h2>

[one_third animation="fade_in"]

Nam rhoncus ullamcorper orci, ultrices posuere turpis. Sed convallis at dolor ac fermentum. Phasellus id neque luctus quam posuere euismod. Nulla euismod dolor convallis mi dapibus tincidunt.

[/one_third]

[one_third animation="fade_in"]

[frame lightbox_group="office" linking="lightbox" link="/wp-content/uploads/2013/03/smooth_slide_2_v01.jpg" align="left" style="none" shape="inherit"]<img src="/wp-content/uploads/2013/03/smooth_slide_2_v01.jpg" />[/frame]

[/one_third]

[one_third_last animation="fade_in"]

[frame lightbox_group="office" linking="lightbox" link="/wp-content/uploads/2013/03/smooth_slide_2_v01.jpg" align="left" style="none" shape="inherit"]<img src="/wp-content/uploads/2013/03/smooth_slide_2_v01.jpg" />[/frame]

[/one_third_last]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** Team', array(
        'label'			=> 'Team',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

// CAREERS
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
[one_third]

<h2>Our Benefits</h2>

[lead]

Phasellus fermentum est ac nisi consectetur viverra id id neque. Vivamus felis turpis, porta non malesuada eu, egestas sit amet nisi. Suspendisse sed eros nulla, sit amet consequat ligula Ut a est non risus.

[/lead]

[/one_third]

[two_third_last]

[carousel coin_nav="standard" direction_nav="none" progress_bar="none"]

[carousel_item]

<img src="/wp-content/uploads/2013/03/photo_15_v011.jpg" />

[/carousel_item]

[carousel_item]

<img src="/wp-content/uploads/2013/03/photo_16_v011.jpg" />

[/carousel_item]

[carousel_item]

<img src="/wp-content/uploads/2013/03/photo_11_v011.jpg" />

[/carousel_item]

[/carousel]

[/two_third_last]

[divider style="simple"]

<h2>Career Opportunities</h2>

[tabs position="left-top"]

[tab_title]

<h3>Senior Developer</h3>

[/tab_title]

[tab_content]

<h4>Overview</h4>

<strong>Date Posted:</strong> 2/8/12
<strong>Job Code:</strong> GHDF2389
<strong>City:</strong> New York, United States of America

[progress_bar value="50" icon="time" size="medium"]Part Time Job[/progress_bar]

<hr />

<h4>Description</h4>

Vivamus euismod eleifend ipsum sit amet molestie. Pellentesque eget turpis ac leo vehicula consectetur. Fusce tortor turpis, consectetur non laoreet a, feugiat feugiat tortor. Donec vel augue massa. Cras eleifend tempus eros nec adipiscing. Morbi et nisl odio. Nam sed lacus nunc. Sed porta volutpat lectus, et congue sem consequat at. In justo odio, lobortis quis fermentum eu, consectetur id libero. Mauris eget enim ac velit lobortis tincidunt consectetur quis elit.

<hr />

<h4>Minimum Requirements</h4>

[one_third]

[numbers stop="100" suffix="%" icon="star"]Excellent Photoshop Skill[/numbers]

[/one_third]

[one_third]

[numbers stop="75" suffix="%" icon="star-half-full"]Good InDesign Knwoledge[/numbers]

[/one_third]

[one_third_last]

[numbers stop="75" suffix="%" icon="star-half-full"]Good Dreamweaver Skill[/numbers]

[/one_third_last]

<hr />

[list type="icon" icon="ok"]

<ul>
<li>Vivamus euismod eleifend ipsum sit amet molestie</li>
<li>Pellentesque eget turpis ac leo vehicula consectetur</li>
<li>Fusce tortor turpis, consectetur non laoreet a</li>
<li>Feugiat feugiat tortor. Donec vel augue massa.</li>
<li>Cras eleifend tempus eros nec adipiscing</li>
<li>Morbi et nisl odio. Nam sed lacus nunc</li>
<li>Sed porta volutpat lectus, et congue sem consequat at</li>
</ul>

[/list]

<hr />

[button size="medium" link="/"]Apply Now[/button]

[/tab_content]

[tab_title]

<h3>Creative Director</h3>

[/tab_title]

[tab_content]

<h4>Overview</h4>

<strong>Date Posted:</strong> 2/8/12
<strong>Job Code:</strong> GHDF2389
<strong>City:</strong> New York, United States of America

[progress_bar value="100" icon="time" size="medium"]Full Time Job[/progress_bar]

<hr />

<h4>Description</h4>

Vivamus euismod eleifend ipsum sit amet molestie. Pellentesque eget turpis ac leo vehicula consectetur. Fusce tortor turpis, consectetur non laoreet a, feugiat feugiat tortor. Donec vel augue massa. Cras eleifend tempus eros nec adipiscing. Morbi et nisl odio. Nam sed lacus nunc. Sed porta volutpat lectus, et congue sem consequat at. In justo odio, lobortis quis fermentum eu, consectetur id libero. Mauris eget enim ac velit lobortis tincidunt consectetur quis elit.

<hr />

<h4>Minimum Requirements</h4>

[one_third]

[numbers stop="100" suffix="%" icon="star"]Excellent Photoshop Skill[/numbers]

[/one_third]

[one_third]

[numbers stop="75" suffix="%" icon="star-half-full"]Good InDesign Knwoledge[/numbers]

[/one_third]

[one_third_last]

[numbers stop="75" suffix="%" icon="star-half-full"]Good Dreamweaver Skill[/numbers]

[/one_third_last]

<hr />

[list type="icon" icon="ok"]

<ul>
<li>Vivamus euismod eleifend ipsum sit amet molestie</li>
<li>Pellentesque eget turpis ac leo vehicula consectetur</li>
<li>Fusce tortor turpis, consectetur non laoreet a</li>
<li>Feugiat feugiat tortor. Donec vel augue massa.</li>
<li>Cras eleifend tempus eros nec adipiscing</li>
<li>Morbi et nisl odio. Nam sed lacus nunc</li>
<li>Sed porta volutpat lectus, et congue sem consequat at</li>
</ul>

[/list]

<hr />

[button size="medium" link="/"]Apply Now[/button]

[/tab_content]

[/tabs]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** Careers', array(
        'label'			=> 'Careers',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

// PROCESS
// =======
    $snippet = <<<G1_HEREDOC_DELIMITER
<h2>We Make Your Ideas Real</h2>

[one_fourth]

[progress_circle value="25" icon="lightbulb" style="simple"]

<h3>Discover an Initial Idea</h3>

Maecenas hendrerit, metus a vestibulum tempor, velit augue aliquet tortor, vitae feugiat.

<a href="#">— Read More</a>

[/one_fourth]

[one_fourth]

[progress_circle value="50" icon="pencil"]

<h3>Define Business Goals</h3>

Hendrerit, metus a vestibulum tempor, velit augue aliquet tortor, vitae feugiat magna nibh.

<a href="#">— Read More</a>

[/one_fourth]

[one_fourth]

[progress_circle value="75" icon="code" style="simple"]

<h3>Develop Key Activities</h3>

Metus a vestibulum tempor, velit augue aliquet tortor, vitae feugiat magna nibh eget massa.

<a href="#">— Read More</a>

[/one_fourth]

[one_fourth_last]

[progress_circle value="100" icon="gift"]

<h3>Deliver the Product</h3>

Maecenas hendrerit, metus a vestibulum tempor, velit augue aliquet tortor, vitae feugiat magna.

<a href="#">— Read More</a>

[/one_fourth_last]

[divider style="simple"]

<h2>Give Your Site A Brand New Look</h2>

[one_half]

[box]

<h3>01. Load Demo</h3>

Suspendisse molestie vehicula lorem, quis tristique erat adipiscing nec. Nam eu arcu leo. Suspendisse id felis in urna gravida congue mollis vitae eros. Maecenas magna augue, iaculis non dignissim id, ultrices ultricies purus. Phasellus nunc nunc, semper a tristique eget, interdum vel arcu.

[/box]

[/one_half]

[one_half_last]

[/one_half_last]

[one_sixth]

[/one_sixth]

[one_half_last]

[box]

<h3>02. Customize</h3>

Suspendisse molestie vehicula lorem, quis tristique erat adipiscing nec. Nam eu arcu leo. Suspendisse id felis in urna gravida congue mollis vitae eros. Maecenas magna augue, iaculis non dignissim id, ultrices ultricies purus. Phasellus nunc nunc, semper a tristique eget, interdum vel arcu.

[/box]

[/one_half_last]

[one_third]

[/one_third]

[one_half_last]

[box]

<h3>03. Support</h3>

Suspendisse molestie vehicula lorem, quis tristique erat adipiscing nec. Nam eu arcu leo. Suspendisse id felis in urna gravida congue mollis vitae eros. Maecenas magna augue, iaculis non dignissim id, ultrices ultricies purus. Phasellus nunc nunc, semper a tristique eget, interdum vel arcu.

[/box]

[/one_half_last]

[one_half]

[/one_half]

[one_half_last]

[box]

<h3>04. Design Audit</h3>

Suspendisse molestie vehicula lorem, quis tristique erat adipiscing nec. Nam eu arcu leo. Suspendisse id felis in urna gravida congue mollis vitae eros. Maecenas magna augue, iaculis non dignissim id, ultrices ultricies purus. Phasellus nunc nunc, semper a tristique eget, interdum vel arcu.

[/box]

[/one_half_last]

[divider style="simple"]

<h2>How Does It Work?</h2>

[rev_slider content-slider-1]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** Process', array(
        'label'			=> 'Process',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

// FAQ
// ====
    $snippet = <<<G1_HEREDOC_DELIMITER
[two_third]

<h2>Frequently Asked Questions</h2>

[divider style="simple"]

[/two_third]

[one_third_last valign="bottom"]

<h2>Still Need Help?</h2>

[divider style="simple"]

[/one_third_last]

[two_third]

[toggle title="What about the theme options?" state="on" icon="question-sign"]

Donec sed lacus sed ligula volutpat ullamcorper. Nullam non purus in eros lacinia tempus. Vestibulum nec volutpat ipsum. Vestibulum malesuada sollicitudin eleifend. Quisque ultricies commodo iaculis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.

[one_half]

<img width="470" width="242" src="/wp-content/uploads/2013/04/demo_content_1_v01.png" />

[/one_half]

[one_half_last]

Fusce auctor pulvinar nunc, vitae sodales augue volutpat feugiat. Donec eu tellus sem. Maecenas feugiat rhoncus est, ac pellentesque.

Dolor facilisis vel. Etiam bibendum massa dictum felis condimentum vehicula. Nunc interdum molestie odio, ac pellentesque magna facilisis id.

[/one_half_last]

[/toggle]

[toggle title="Can I change map color schema in the footer?" icon="question-sign"]

Sed felis purus, faucibus ut dapibus ac, ullamcorper at lorem. In ut eros congue lectus interdum fringilla vel commodo nisi. Maecenas magna quam, dapibus at malesuada nec, vestibulum ut tortor. Quisque blandit lectus a quam suscipit non fermentum erat consectetur. Sed iaculis lacinia augue, nec scelerisque metus placerat vel.

[/toggle]

[toggle title="Is the demo content included in the package?" icon="question-sign"]

Donec commodo justo non eros vehicula volutpat. Nunc accumsan, metus quis volutpat fermentum, felis lacus euismod quam, at ullamcorper quam velit ut augue. Etiam fringilla, dolor eget tempus mattis, nulla sem luctus ante, at tristique purus neque quis neque. Vivamus pretium feugiat hendrerit.

[/toggle]

[toggle title="How can I change current skin keeping all other options in place?" icon="question-sign"]

Consequat scelerisque eu libero. Aliquam erat volutpat. Donec ac metus vel sem tincidunt molestie eu eget lectus. Nullam placerat fermentum velit, ac porta nunc viverra nec. Etiam sit amet facilisis urna.

[/toggle]

[/two_third]

[one_third_last]

[box icon="medkit" style="solid"]

<h3>Ask On Support</h3>

<hr />

Pellentesque egestas eleifend felis. Cras lectus diam, <a href="#">venenatis</a> blandit nisi id, congue scelerisque tortor. Ut volutpat fringilla aliquet.

[/box]

[box icon="group" style="solid"]

<h3>Use Our Forum</h3>

<hr />

Pellentesque egestas eleifend felis. Cras lectus diam, venenatis blandit nisi id, congue scelerisque tortor. Ut volutpat fringilla aliquet.

[/box]

[/one_third_last]

[space px="20"]

<h2>Knowledge Base</h2>

[divider style="simple"]

<h3>01. How to install the theme?</h3>

Fusce consectetur tellus id lorem luctus id eleifend magna lobortis. Aliquam facilisis magna ac nisi porta porta. In hac habitasse platea dictumst. Mauris sollicitudin, mi nec vulputate iaculis, dui dolor congue nunc, sit amet venenatis erat nulla sit amet turpis. Integer pharetra vehicula lectus, ullamcorper venenatis lacus commodo nec.

<hr />

<h3>02. How can I register on forum?</h3>

Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi. Fusce quam leo, facilisis id metus eget, dignissim aliquet erat. Praesent scelerisque eleifend magna, vel blandit turpis sodales ac.

<hr />

<h3>03. How to upload the theme using FTP?</h3>

Nulla porttitor, justo ut auctor ultrices, magna ante porttitor nibh, vel euismod justo risus at arcu. Mauris pellentesque nisi lorem, ac tincidunt ipsum tristique vel. Sed sit amet augue porta, lobortis purus sed, feugiat mauris. Pellentesque suscipit sodales molestie. Aliquam scelerisque aliquam lacus. Vivamus placerat in magna id dictum.
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** FAQ', array(
        'label'			=> 'FAQ',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

    // CONTACT US
    $snippet = <<<G1_HEREDOC_DELIMITER
<h2>Have A Question? Need Some Help?</h2>

<hr />

[lead]

Vestibulum non interdum lectus, eu pulvinar nisi. Vivamus et risus a quam ullamcorper mollis. Pellentesque convallis turpis et ligula malesuada, quis adipiscing elit lacinia. Donec non scelerisque lacus, in hendrerit nulla.

[/lead]

<h2>Send Us a Message</h2>

[contact_form]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** Contact Us #1', array(
        'label'			=> 'Contact Us #1',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

    // CONTACT US 2
    $snippet = <<<G1_HEREDOC_DELIMITER
[one_half]

<h2>Check Our Location</h2>

[gmap height="400px" invert_lightness="none" latitude="40.714353" longitude="-74.005973" marker="standard" type="simple"]

[/one_half]

[one_half_last]

<h2>Send Us a Message</h2>

[contact_form]

[/one_half_last]

[divider]

[one_third]

[one_fourth]

[icon icon="map-marker" style="solid" size="medium"]

[/one_fourth]

[three_fourth_last]

<strong>Address:</strong>
United States of America.
New York. 123 Fifth Avenue.

[/three_fourth_last]

[/one_third]

[one_third]

[one_fourth]

[icon icon="phone" style="solid" size="medium"]

[/one_fourth]

[three_fourth_last]

<strong>Phone:</strong>
GFX Team: (123) 456-7890
Dev Team: (987) 654-3210

[/three_fourth_last]

[/one_third]

[one_third_last]

[one_fourth]

[icon icon="envelope-alt" style="solid" size="medium"]

[/one_fourth]

[three_fourth_last]

<strong>Email:</strong>
<a href="mailto:gfx@somecompany.com">gfx@somecompany.com</a>
<a href="mailto:devteam@somecompany.com">devteam@somecompany.com</a>

[/three_fourth_last]

[/one_third_last]
G1_HEREDOC_DELIMITER;

    // Add snippet to the global shortcode generator
    $generator->add_snippet( '*** Contact Us #2', array(
        'label'			=> 'Contact Us #2',
        'result'		=> $snippet,
        'section'		=> 'pagesnippets',
    ));

}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_page_snippets' );