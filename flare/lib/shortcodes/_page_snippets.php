<?php
/**
 * This file is part of the BTP_FaderTheme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* Add "Home Page Snippets" subgroup to the global shortcode generator */
btp_shortgen_add_subgroup( 
	'homepagesnippets', 
	array( 
		'label' => __( 'Home Page Snippets', 'btp_theme' ),
	),  
	'general',
	500
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Homepage 1',
	array(
		'label'			=> 'Homepage 1',
		'result'		=> 
'[precontent]' .
"\n\n" .
'<div style="text-align:center;">' .
"\n\n" .
'<h1>Unlimited Colors</h1>' .
"\n\n" .
'[subheading_3]Now grab and drag the handle below to see the difference[/subheading_3]' .
"\n\n" .
'[before_after width="960" height="280" before_src="/wp-content/uploads/2012/03/unlimited_colors_before.png" after_src="/wp-content/uploads/2012/03/unlimited_colors_after.png"]' .
"\n\n" .
'</div>' .
"\n\n" .
'[/precontent]' .
"\n\n" .
'<div style="text-align:center;">' .
"\n\n" .
'<h2>Define basic colors and all gradients will be generated!</h2>' .
"\n\n" .
'<p>[button link="/features/unlimited-colors/" size="medium"]Learn More[/button] [button link="/admin-ui/style-tab/" size="medium"]See Admin UI[/button]</p>' .
"\n\n" .
'</div>' .
"\n\n" .
'[divider]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'<h2>Responsive Design</h2>' .
"\n\n" .
'Now you can easily browse your site using smartphones, tablets, laptops & desktop computers.' .
"\n\n" .
'<a href="/features/responsive-design/">&ndash; Read more</a>' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[two_third_last]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/03/responsive_v111.jpg" alt="" title="responsive_v111" width="711" height="336" class="alignnone size-full wp-image-676" />' .
"\n\n" .
'[/two_third_last]' .
"\n\n" .
'[divider type="plane-left"]' .
"\n\n" .
'<h2>Many Ways to Present Your Portfolio</h2>' .
"\n\n" .
'[subheading_4]Various templates + full control over visible elements[/subheading_4]' .
"\n\n" .
'[space px="22"]' .
"\n\n" .
'[custom_works entry_ids="509,516,533" template="one_third" hide="summary, categories, tags, button_1"]' .
"\n\n" .
'[divider type="plane-right"]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'<h2>Fancy Shortcodes</h2>' .
"\n\n" .
'Sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam gravida pharetra ullamcorper. Cras euismod massa.' .
"\n\n" .
'<a href="/shortcodes/dividers-headings/">&ndash; View fancy dividers</a>' ."\n" .
'<a href="/shortcodes/images-frames/">&ndash; View fancy frames</a>' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[two_third_last]' .
"\n\n" .
'[frame link="/shortcodes/dividers-headings/" type="easel"]<img src="/wp-content/uploads/2012/03/shortcodes_1_v01.jpg" alt="" title="shortcodes_1_v01" width="500" height="281" class="alignnone size-full wp-image-674" />[/frame]' .
"\n\n" .
'[/two_third_last]' .
"\n\n" .
'<hr />' .
"\n\n" .
'[one_half]' .
"\n\n" .
'<h3><img style="vertical-align:bottom;margin-right:10px;" src="/wp-content/uploads/2012/01/icon_magicwand_32.png" alt="Shortcode Generator"/> Shortcode Generator</h3>' .
"\n\n" .
'The Flare Theme comes with many custom shortcodes you can use to spice up your content. It\'s hard to remember them all - here\'s where the Shortcode Generator comes into place. It provides a user friendly interface for all shortcodes and code snippets.' . 
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_half_last]' .
"\n\n" .
'<h3><img style="vertical-align:bottom;margin-right:10px;" src="/wp-content/uploads/2012/01/icon_applications_32.png" alt="Pre-built Layouts"/> Pre-built layouts</h3>' .
"\n\n" .
'The FlareTheme hasnt got special homepage templates.' ."\n" .
'This way you can really build whatever you want. All example hompages are built with shortcodes and the entire code is available in the Shortcode Generator.' .
"\n\n" .
'[/one_half_last]' .
"\n\n" .
'[divider type="plane-left"]' .
"\n\n" .
'<h2>Other Features</h2>' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[list type="arrow"]' .
'<ul>' .
'<li>Ongoing Support</li>' .
'<li>&quot;Before &amp; After&quot; shortcode</li>' .
'<li>FlexSlider + <a href="/features/slider-managers/">the Slider Manager</a></li>' .
'<li><a href="/features/custom-post-types/">Custom Post Types</a> for works & FlexSliders</li>' .
'<li>Custom Taxonomies for work categories and tags</li>' .
'<li>A special custom taxonomy Relation Tags to relate various content</li>' .
'<li>Unlimited Sidebars</li>' .
'<li>10+ <a href="/features/custom-widgets/">Custom Widgets</a></li>' .
'<li>Documentation Included</li>' .
'<li>Help Mode</li>' .
'</ul>' ."\n" .
'[/list]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[list type="arrow"]' .
'<ul>' .
'<li>HTML5 &amp; CSS3</li>' .
'<li>Change the size of the slider from the Theme Options without touching the code</li>' .
'<li>Change image sizes from the Theme Options without touching the code</li>' .
'<li>Demo content included</li>' .
'<li>A <strong>contact form</strong> through a shortcode or a widget no more special pages, place it wherever you want even multiple times</li>' .
'<li>Support for <a href="/pages/splitted-page/">splitted</a> and <a href="/pages/page-password-protected/">password protected pages</a></li>' .
'</ul>' ."\n" .
'[/list]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[list type="arrow"]' .
'<ul>' .
'<li>Ready for translation (.po/.mo files)</li>' .
'<li>Turn On/Off the search form in the header</li>' .
'<li>Turn On/Off the sliding top panel (the preheader)</li>' .
'<li>Turn On/Off breadcrumbs</li>' .
'<li>Turn On/Off <a href="/features/font-replacement/">Font Replacement</a></li>' .
'<li>Social Media Links with a dedicated shortcode and a widget</li>' .
'<li>Customize the WordPress Login Logo</li>' .
'<li>No text as graphics</li>' .
'</ul>' ."\n" .
'[/list]' .
"\n\n" .
'[/one_third_last]',
		'group'			=> 'general',
		'subgroup'		=> 'homepagesnippets',	
		'position'		=> 10,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Homepage 2',
	array(
		'label'			=> 'Homepage 2',
		'result'		=> 
'[precontent]' .
"\n\n" .
'<hr />' .
"\n\n" .
'[two_third]' .
"\n\n" .
'<h2>Responsive FlexSlider with two layouts</h2>' .
"\n\n" .
'[/two_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[button link="/features/slider-managers/" size="medium" type="wide"]See the Slider Manager <small>and learn more</small>[/button]' .
"\n\n" .
'[/one_third_last]' .
"\n\n" .
'[/precontent]' .
"\n\n" .
'<h2>[dropcap type="square"]1[/dropcap] Why Choose Us?</h2>' .
"\n\n" .
'[space px="20"]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[frame type="paper-stack"][placeholder width="296" height="120" type="no-image"][/frame]' .
"\n\n" .
'<h3><a href="/">Responsive Design</a></h3>' .
"\n\n" .
'Neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris. Integer non laoreet orci.' . 
"\n\n" .
'<a href="/features/responsive-design/">&ndash; Read more</a>' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[frame type="paper-stack"][placeholder width="296" height="120" type="no-image"][/frame]' .
"\n\n" .
'<h3><a href="/">Unlimited Colors</a></h3>' .
"\n\n" .
'Neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris. Integer non laoreet orci.' . 
"\n\n" .
'<a href="/features/unlimited-colors/">&ndash; Read more</a>' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[frame type="paper-stack"][placeholder width="296" height="120" type="no-image"][/frame]' .
"\n\n" .
'<h3><a href="/">Ongoing Support</a></h3>' .
"\n\n" .
'Neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris. Integer non laoreet orci.' .
"\n\n" .
'<a href="/features/ongoing-support/">&ndash; Read more</a>' .
"\n\n" .
'[/one_third_last]' .
"\n\n" .
'[divider type="rocket-right"]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'<h2>[dropcap type="square"]2[/dropcap] Our Approach</h2>' .
"\n\n" .
'Nam molestie enim et metus vestibulum et congue purus facilisis. Integer iaculis sem nunc. Donec convallis, mi vel commodo facilisis, elit quam.' .
"\n\n" .
'Mauris erat leo, faucibus mollis pharetra sed, ullamcorper ac enim. Aenean vehicula risus sit amet magna pharetra lacinia.' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_half_last]' .
"\n\n" .
'[frame type="projector-screen"][placeholder width="480" height="270" type="users"][/frame]' .
"\n\n" .
'[/one_half_last]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[frame type="paper-stack"][placeholder width="296" height="120" type="no-image"][/frame]' .
"\n\n" .
'Step 1: [flag]Discover[/flag] [flag]Define[/flag]' .
"\n\n" .
'[space px="-11"]' .
"\n\n" .
'<h3>Vestibulum mauris aenean egestas ipsum</h3>' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[frame type="paper-stack"][placeholder width="296" height="120" type="no-image"][/frame]' .
"\n\n" .
'Step 2: [flag]Design[/flag] [flag]Develop[/flag]' .
"\n\n" .
'[space px="-11"]' .
"\n\n" .
'<h3>Interdum, lectus ac lacinia aliquet dolor</h3>' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[frame type="paper-stack"][placeholder width="296" height="120" type="no-image"][/frame]' .
"\n\n" .
'Step 4: [flag]Deliver[/flag]' .
"\n\n" .
'[space px="-11"]' .
"\n\n" .
'<h3>Nullam interdum, lectus ac lacinia sit amet</h3>' .
"\n\n" .
'[/one_third_last]' .
"\n\n" .
'[divider type="rocket-left"]' .
"\n\n" .
'<h2>[dropcap type="square"]3[/dropcap] Are You Interested?</h2>' .
"\n\n" .
'[two_third]' .
"\n\n" .
'<strong>Maecenas nec ante id arcu faucibus laoreet</strong>. Donec pulvinar, ante a fermentum mattis, lacus enim dignissim arcu, nec bibendum orci libero non nulla. Mauris egestas risus non orci luctus vitae tristique erat tempus. Nullam interdum, lectus ac lacinia aliquet, velit purus hendrerit magna' .
"\n\n" .
'[/two_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'<p>[button link="/" size="big" type="wide"]Buy Now[/button]</p>' .
"\n\n" .
'[/one_third_last]',
		'group'			=> 'general',
		'subgroup'		=> 'homepagesnippets',	
		'position'		=> 20,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Homepage 3',
	array(
		'label'			=> 'Homepage 3',
		'result'		=> 
'[one_fourth]' .
"\n\n" .
'<h2>Responsive Webdesign</h2>' .
"\n\n" .
'Now you can easily browse your site using smartphones, tablets, laptops & desktop computers.' .
"\n\n" .
'<p>[button link="/features/responsive-design/" size="small"]Read more[/button]</p>' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[three_fourth_last]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/responsive_v02.png" alt="" title="responsive_v02" width="943" height="326" class="aligncenter size-full wp-image-482" />' .
"\n\n" .
'[/three_fourth_last]' .
"\n\n" .
'[divider]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'<h2>Our Work</h2>' .
"\n\n" .
'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices' .
"\n\n" .
'<p>[button link="/work/" size="small"]See all Projects[/button]</p>' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[three_fourth_last]' .
"\n\n" .
'[custom_works entry_ids="509,516,533" template="one_fourth" hide="summary, categories, tags, button_1"]' .
"\n\n" .
'[/three_fourth_last]' .
"\n\n" .
'[space px="-20"]' .
"\n\n" .
'[divider]' .
"\n\n" .
'<h2>What Our Clients Say</h2>' .
"\n\n" .
'[testimonial size="medium" type="bubble" name="Edward Jackson" company="SampleCompany"]' .
"\n\n" .
'Maecenas non orci orci, et vestibulum mauris. Aenean egestas viverra ligula in molestie. Id libero est, a placerat justo. Ipsum eu <a href="/"><strong>placerat vulputate</strong></a>, tortor risus tempus erat, nec cursus enim arcu sed dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla consequat, leo et elementum tempus' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[space px="1"]' .
"\n\n" .
'[divider]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'<h2>On the Blog</h2>' .
"\n\n" .
'Vestibulum ante ipsum primis in faucibus orci luctus et.' .
"\n\n" .
'<p>[button link="/blog/" size="small"]See all Posts[/button]</p>' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[three_fourth_last]' .
"\n\n" .
'[recent_posts max="3" template="one_fourth" hide="summary, categories, tags, button_1"]' .
"\n\n" .
'[/three_fourth_last]',
		'group'			=> 'general',
		'subgroup'		=> 'homepagesnippets',	
		'position'		=> 30,															
	)			 
);
	


/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Homepage 4',
	array(
		'label'			=> 'Homepage 4',
		'result'		=>
'[precontent]' .
"\n\n" .
'[space px="10"]' .
"\n\n" .
'<div style="text-align: center;">' .
"\n\n" .
'[heading_1 type="divider"]Fully Responsive Design[/heading_1]' .
"\n\n" .
'[subheading_3]Browse your site easily using smartphones, tablets, laptops & desktop computers[/subheading_3]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/responsive_v02.png" alt="" title="responsive_v02" width="943" height="326" class="aligncenter size-full wp-image-482" />' .
"\n\n" .
'[space px="10"]' .
"\n\n" .
'The Flare Theme adapts to many screen sizes thanks to Responsive Webdesign Techniques (try resizing your browser).' ."\n" .
'Now you can easily browse your site using smartphones, tablets, laptops & desktop computers.' .
"\n\n" .
'<p>[button link="/features/responsive-design/" size="medium"]Read More[/button] [button link="/" size="medium" bg_color="#00b4ff"]Buy Now[/button]</p>' .
"\n\n" .
'</div>' .
"\n\n" .
'[/precontent]' .
"\n\n" .
'<div style="text-align:center;">' .
"\n\n" .
'[heading_2 type="divider"]Our Services[/heading_2]' .
"\n\n" .
'[lead]' .
"\n\n" .
'Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus.' .
"\n\n" .
'[/lead]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_monitor_32.png" alt="" />' .
"\n\n" .
'[space px="-20"]' .
"\n\n" .
'<h3><a href="/">Ipusm duis sollicitudin</a></h3>' .
"\n\n" .
'<strong>Purus ipsum ac elementum</strong> libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras interdum, lectus ac iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_colorwheel_32.png" alt="" />' .
"\n\n" .
'[space px="-20"]' .
"\n\n" .
'<h3><a href="/">Sollicitudin purus</a></h3>' .
"\n\n" .
'<strong>Interdum, lectus ac</strong> purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_security_32.png" alt="" />' .
"\n\n" .
'[space px="-20"]' .
"\n\n" .
'<h3><a href="/">Purus ipsum ac</a></h3>' .
"\n\n" .
'<strong>Ipsum interdum</strong> lectus ac amet elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/one_third_last]' .
"\n\n" .
'[space px="40"]' .
"\n\n" .
'[heading_2 type="divider"]Featured Works[/heading_2]' .
"\n\n" .
'[lead]' .
"\n\n" .
'Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus.' .
"\n\n" .
'[/lead]' .
"\n\n" .
'[custom_works entry_ids="509,516,533" template="one_third" hide="summary, categories, tags, button_1"]' .
"\n\n" .
'[space px="-20"]' .
"\n\n" .
'<p>[button link="/work/" type="divider" size="small"]See All Works[/button]</p>' .
"\n\n" .
'</div>',
		'group'			=> 'general',
		'subgroup'		=> 'homepagesnippets',	
		'position'		=> 40,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Homepage 5',
	array(
		'label'			=> 'Homepage 5',
		'result'		=>
'[precontent]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'<h2>Responsive Video</h2>' .
"\n\n" .
'Just use the embed shortcode (the default WordPress shortcode for embedding media) and the <strong>Flare</strong>Theme will do the magic.' .
"\n\n" .
'<p>[button link="/shortcodes/audio-and-video/"]Read More[/button]</p>' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[two_third_last]' .
"\n\n" .
'[frame type="projector-screen"][embed]http://vimeo.com/27127177[/embed][/frame]' .
"\n\n" .
'[/two_third_last]' .
"\n\n" .
'[/precontent]' .
"\n\n" .
'<div style="text-align: center;">' .
"\n\n" .
'[heading_1 type="divider"]A Modern WP Theme[/heading_1]' .
"\n\n" .
'[subheading_3]Praesent malesuada enim nec nunc bibendum aliquet. Duis mollis eros vitae nisi tempus sit. Praesent sit amet <a href="/">augue adipiscing</a> leo ultrices.[/subheading_3]' .
"\n\n" .
'[space px="40"]' .
"\n\n" .
'[heading_2 type="divider"]4 Reasons To Choose[/heading_2]' .
"\n\n" .
'[subheading_4]the Flare Theme[/subheading_4]' .
"\n\n" .
'[space px="20"]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/02/responsive_v041.png" alt="" class="aligncenter" />' .
"\n\n" .
'<h3><a href="/features/responsive-design/">Responsive Design</a></h3>' .
"\n\n" .
'Maecenas ultrices nisl in massa consectetur lobortis. Praesent vel elit felis, quis malesuada erat. Vestibulum sit amet luctus orci.' .
"\n\n" .
'<p>[button link="/features/responsive-design/"]More[/button]</p>' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/02/unlimited_colors_v02.png" alt="" class="aligncenter" />' .
"\n\n" .
'<h3><a href="/features/unlimited-colors/">Unlimited Colors</a></h3>' .
"\n\n" .
'Maecenas ultrices nisl in massa consectetur lobortis. Praesent vel elit felis, quis malesuada erat. Vestibulum sit amet luctus orci.' .
"\n\n" .
'<p>[button link="/features/unlimited-colors/"]More[/button]</p>' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/02/easy_to_customize_v01.png" alt="" class="aligncenter" />' .
"\n\n" .
'<h3><a href="/admin-ui/">Easy to Customize</a></h3>' .
"\n\n" .
'Maecenas ultrices nisl in massa consectetur lobortis. Praesent vel elit felis, quis malesuada erat. Vestibulum sit amet luctus orci.' .
"\n\n" .
'<p>[button link="/admin-ui/"]More[/button]</p>' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/02/support_forum_v02.png" alt="" class="aligncenter" />' .
"\n\n" .
'<h3><a href="/features/ongoing-support/">Ongoing Support</a></h3>' .
"\n\n" .
'Maecenas ultrices nisl in massa consectetur lobortis. Praesent vel elit felis, quis malesuada erat. Vestibulum sit amet luctus orci.' .
"\n\n" .
'<p>[button link="/features/ongoing-support/"]More[/button]</p>' .
"\n\n" .
'[/one_fourth_last]' .
"\n\n" .
'[space px="40"]' .
"\n\n" .
'[heading_2 type="divider"]Find Out More About the Theme[/heading_2]' .
"\n\n" .
'[subheading_4]<a href="/features/">&raquo; Check the Full List of Features &laquo;</a>[/subheading_4]' .
"\n\n" .
'</div>',	
		'group'			=> 'general',
		'subgroup'		=> 'homepagesnippets',	
		'position'		=> 50,															
	)			 
);





/* Add "Page Snippets" subgroup to the global shortcode generator */
btp_shortgen_add_subgroup( 
	'pagesnippets', 
	array( 
		'label' => __( 'Page Snippets', 'btp_theme' ),
	),  
	'general',
	500
);


/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Services 1',
	array(
		'label'			=> 'Services 1',
		'result'		=>
'<h2>Our Services 1</h2>' .
"\n\n" .
'[lead]' .
"\n\n" .
'Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula.' . 
"\n\n" .
'[/lead]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[one_fifth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_monitor_32.png" alt="" />' .
"\n\n" .
'[/one_fifth]' .
"\n\n" .
'[four_fifth_last]' .
"\n\n" .
'<h3>Ipusm duis sollicitudin</h3>' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/four_fifth_last]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[one_fifth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_colorwheel_32.png" alt="" />' .
"\n\n" .
'[/one_fifth]' .
"\n\n" .
'[four_fifth_last]' .
"\n\n" .
'<h3>Sollicitudin purus</h3>' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/four_fifth_last]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[one_fifth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_security_32.png" alt="" />' .
"\n\n" .
'[/one_fifth]' .
"\n\n" .
'[four_fifth_last]' .
"\n\n" .
'<h3>Purus ipsum ac</h3>' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/four_fifth_last]' .
"\n\n" .
'[/one_third_last]' .
"\n\n" .
'[divider_arrow]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[one_fifth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_magicwand_32.png" alt="" />' .
"\n\n" .
'[/one_fifth]' .
"\n\n" .
'[four_fifth_last]' .
"\n\n" .
'<h3>Ipusm duis sollicitudin</h3>' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/four_fifth_last]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[one_fifth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_applications_32.png" alt="" />' .
"\n\n" .
'[/one_fifth]' .
"\n\n" .
'[four_fifth_last]' .
"\n\n" .
'<h3>Sollicitudin purus</h3>' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/four_fifth_last]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[one_fifth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_preferences_32.png" alt="" />' .
"\n\n" .
'[/one_fifth]' .
"\n\n" .
'[four_fifth_last]' .
"\n\n" .
'<h3>Purus ipsum ac</h3>' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat.' .
"\n\n" .
'[/four_fifth_last]' .
"\n\n" .
'[/one_third_last]' . "\n\n",	
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 110,															
	)			 
);

/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Services 2',
	array(
		'label'			=> 'Services 2',
		'result'		=>
'<h2>Our Services 2</h2>' .
"\n\n" .
'[lead]' .
"\n\n" .
'Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula.' . 
"\n\n" .
'[/lead]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[one_sixth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_monitor_32.png" alt="" />' .
"\n\n" .
'[/one_sixth]' .
"\n\n" .
'[five_sixth_last]' .
"\n\n" .
'<h3>Ipusm duis sollicitudin</h3>' .
"\n\n" .
'[/five_sixth_last]' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[one_sixth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_colorwheel_32.png" alt="" />' .
"\n\n" .
'[/one_sixth]' .
"\n\n" .
'[five_sixth_last]' .
"\n\n" .
'<h3>Sollicitudin purus</h3>' .
"\n\n" .
'[/five_sixth_last]' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[one_sixth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_security_32.png" alt="" />' .
"\n\n" .
'[/one_sixth]' .
"\n\n" .
'[five_sixth_last]' .
"\n\n" .
'<h3>Purus ipsum ac</h3>' .
"\n\n" .
'[/five_sixth_last]' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus' .
"\n\n" .
'[/one_third_last]' .
"\n\n" .
'[divider_arrow]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[one_sixth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_magicwand_32.png" alt="" />' .
"\n\n" .
'[/one_sixth]' .
"\n\n" .
'[five_sixth_last]' .
"\n\n" .
'<h3>Ipusm duis sollicitudin</h3>' .
"\n\n" .
'[/five_sixth_last]' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[one_sixth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_applications_32.png" alt="" />' .
"\n\n" .
'[/one_sixth]' .
"\n\n" .
'[five_sixth_last]' .
"\n\n" .
'<h3>Sollicitudin purus</h3>' .
"\n\n" .
'[/five_sixth_last]' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[one_sixth]' .
"\n\n" .
'<img src="/wp-content/uploads/2012/01/icon_preferences_32.png" alt="" />' .
"\n\n" .
'[/one_sixth]' .
"\n\n" .
'[five_sixth_last]' .
"\n\n" .
'<h3>Purus ipsum ac</h3>' .
"\n\n" .
'[/five_sixth_last]' .
"\n\n" .
'Purus ipsum, ac elementum libero. Nam sem purus, blandit sed malesuada nec, consectetur sed neque. Cras iaculis quam in elit dapibus sed volutpat. Pellentesque ipsum tellus' .
"\n\n" .
'[/one_third_last]' . "\n\n",

		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 120,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Services 3',
	array(
		'label'			=> 'Services 3',
		'result'		=>
'<h2>Our Services 3</h2>' . "\n\n" .

'[lead]' .
 "\n\n" .
'Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula.' . 
 "\n\n" .
'[/lead]' .
 "\n\n" .
'[tabs position="bottom-center"]' .
"\n\n" .
'[tab_title]Web Design[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'[placeholder width="640" height="360" type="no-image"]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_half_last]' .
"\n\n" .
'<h2>Web Design</h2>' .
"\n\n" .
'[subheading_4]Pellentesque habitant morbi[/subheading_4]' .
"\n\n" .
'[list type="check"]' .
'<ul>' .
'<li>Vestibulum ac purus nibh. Duis posuere viverra adipiscing.</li>' .
'<li>Phasellus dui justo, placerat ac tempor et, euismod dictum enim.</li>' .
'<li>Sed nec tortor metus. Duis sollicitudin purus ipsum, ac elementum libero.</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'Vestibulum ac purus nibh. Duis posuere viverra adipiscing. Phasellus dui justo, placerat ac tempor et, euismod dictum enim. Sed nec tortor metus. Duis sollicitudin purus ipsum, ac elementum libero.' .
"\n\n" .
'[/one_half_last]' . 
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[tab_title]Internet Marketing[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'[placeholder width="640" height="360" type="no-image"]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_half_last]' .
"\n\n" .
'<h2>Internet Marketing</h2>' .
"\n\n" .
'[subheading_4]Habitant morbi tristique[/subheading_4]' .
"\n\n" .
'[list type="pin"]' .
"\n\n" .
'<ul>' .
'<li>Vestibulum ac purus nibh. Duis posuere viverra adipiscing.</li>' .
'<li>Phasellus dui justo, placerat ac tempor et, euismod dictum enim.</li>' .
'<li>Sed nec tortor metus. Duis sollicitudin purus ipsum, ac elementum libero.</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'Vestibulum ac purus nibh. Duis posuere viverra adipiscing. Phasellus dui justo, placerat ac tempor et, euismod dictum enim. Sed nec tortor metus. Duis sollicitudin purus ipsum, ac elementum libero.' .
"\n\n" .
'[/one_half_last]' .
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[tab_title]E-Commerce[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'[placeholder width="640" height="360" type="no-image"]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_half_last]' .
"\n\n" .
'<h2>E-Commerce</h2>' .
"\n\n" .
'[subheading_4]Morbi tristique senectus[/subheading_4]' .
"\n\n" .
'[list type="arrow"]' .
"\n\n" .
'<ul>' . "\n" .
'<li>Vestibulum ac purus nibh. Duis posuere viverra adipiscing.</li>' .
'<li>Phasellus dui justo, placerat ac tempor et, euismod dictum enim.</li>' .
'<li>Sed nec tortor metus. Duis sollicitudin purus ipsum, ac elementum libero.</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'Vestibulum ac purus nibh. Duis posuere viverra adipiscing. Phasellus dui justo, placerat ac tempor et, euismod dictum enim. Sed nec tortor metus. Duis sollicitudin purus ipsum, ac elementum libero.' .
"\n\n" .
'[/one_half_last]' .
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[/tabs]' . "\n\n",
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 130,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Team 1',
	array(
		'label'			=> 'Team 2',
		'result'		=>
'<h2>[dropcap type="square" bg_color="#42a600" text_color="#ffffff"]1[/dropcap]Project Management Team</h2>' .
"\n\n" .
'[lead]' .
"\n\n" .
'Nunc a libero purus, nec hendrerit lacus. Vestibulum nisl orci, lobortis ac tincidunt vitae, porta et odio. Phasellus mattis molestie erat feugiat tincidunt. Mauris eget enim ac velit lobortis tincidunt consectetur quis elit' .
"\n\n" .
'[/lead]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'[frame][placeholder width="213" height="200" type="user"][/frame]' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'<h3>Edward Thompson [flag bg_color="#42a600" text_color="#ffffff"]Senior PM[/flag]</h3>' .
'[subheading_5]Happy father, Book lover, Guitar player[/subheading_5]' .
"\n\n" .
'Aenean ut tellus nisl, non pellentesque justo. Nam accumsan, lacus in tempor tempus, neque tellus accumsan nisl, ut egestas magna magna sit amet nulla. Ut eleifend sagittis tellus, ut malesuada odio volutpat sit amet. Donec dignissim auctor lacus, eu auctor nulla luctus convallis. Donec lacus elit, sagittis eget suscipit id, lacinia in lorem. Integer feugiat nulla a magna mattis malesuada. Maecenas dignissim urna vitae enim pretium vel aliquam metus volutpat.' .
"\n\n" .
'Etiam felis felis, volutpat quis imperdiet id, tincidunt id purus. Nunc mi dolor, vestibulum sed vehicula ut, consequat nec sapien. Etiam nisi est, auctor sit amet feugiat eu, viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris. Integer non laoreet orci. Sed luctus nisi ut ante fringilla bibendum. Donec laoreet, nisi et varius porttitor, nulla ipsum fermentum neque, vitae lobortis eros mi non velit.' . 
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'[twitter username="envatowebdev" max="1"]' .
"\n\n" .
'[/one_fourth_last]' .
"\n\n" .
'[divider]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'[frame][placeholder width="213" height="200" type="user"][/frame]' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'<h3>Jennifer Williams [flag bg_color="#42a600" text_color="#ffffff"]PM[/flag]</h3>' .
'[subheading_5]Happy mother, Typography lover, Piano player[/subheading_5]' .
"\n\n" .
'Aenean ut tellus nisl, non pellentesque justo. Nam accumsan, lacus in tempor tempus, neque tellus accumsan nisl, ut egestas magna magna sit amet nulla. Ut eleifend sagittis tellus, ut malesuada odio volutpat sit amet. Donec dignissim auctor lacus, eu auctor nulla luctus convallis. Donec lacus elit, sagittis eget suscipit id, lacinia in lorem. Integer feugiat nulla a magna mattis malesuada. Maecenas dignissim urna vitae enim pretium vel aliquam metus volutpat.' . 
"\n\n" .
'Etiam felis felis, volutpat quis imperdiet id, tincidunt id purus. Nunc mi dolor, vestibulum sed vehicula ut, consequat nec sapien. Etiam nisi est, auctor sit amet feugiat eu, viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris. Integer non laoreet orci. Sed luctus nisi ut ante fringilla bibendum.' . 
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'[twitter username="envatowebdesign" max="1"]' .
"\n\n" .
'[/one_fourth_last]',	
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 210,															
	)			 
);


/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Team 2',
	array(
		'label'			=> 'Team 2',
		'result'		=>	
'<h2>[dropcap type="square" bg_color="#ff0000" text_color="#ffffff"]2[/dropcap]Design Team</h2>' .
"\n\n" .
'[lead]' .
"\n\n" .
'Nunc a libero purus, nec hendrerit lacus. Vestibulum nisl orci, lobortis ac tincidunt vitae, porta et odio. Phasellus mattis molestie erat feugiat tincidunt. Mauris eget enim ac velit lobortis tincidunt consectetur quis elit' .
"\n\n" .
'[/lead]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'[frame][placeholder width="213" height="200" type="user"][/frame]' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'<h3>Edward Thompson [flag bg_color="#ff0000" text_color="#ffffff"]Creative Director[/flag]</h3>' .
'[subheading_5]Happy father, Book lover, Guitar player[/subheading_5]' .
"\n\n" .
'[testimonial type="bubble"]' .
"\n\n" .
'Aenean ut tellus nisl, non pellentesque justo. Nam accumsan, lacus in tempor tempus, neque tellus accumsan nisl, ut egestas magna magna sit amet nulla. Ut eleifend sagittis tellus, ut malesuada odio volutpat sit amet. Donec dignissim auctor lacus, eu auctor nulla luctus convallis.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'Follow Edward on' . "\n" .
'<a href="/">Twiitter</a>' .
"\n\n" .
'Check out Edward\'s profile on' . "\n" .
'<a href="/">Facebook</a>' .
"\n\n" .
'[/one_fourth_last]' .
"\n\n" .
'[divider]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'[frame][placeholder width="213" height="200" type="user"][/frame]' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'<h3>Jennifer Williams [flag bg_color="#ff0000" text_color="#ffffff"]Senior Designer[/flag]</h3>' .
'[subheading_5]Happy mother, Typography Lover, Piano Player[/subheading_5]' .
"\n\n" .
'[testimonial type="bubble"]' .
"\n\n" .
'Aenean ut tellus nisl, non pellentesque justo. Nam accumsan, lacus in tempor tempus, neque tellus accumsan nisl, ut egestas magna magna sit amet nulla. Ut eleifend sagittis tellus, ut malesuada odio volutpat sit amet. Donec dignissim auctor lacus, eu auctor nulla luctus convallis.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'Follow Jennifer on' ."\n" .
'<a href="/">Twiitter</a>' .
"\n\n" .
'Check out Jennifer\'s profile on' .
'<a href="/">Facebook</a>' .
"\n\n" .
'[/one_fourth_last]',	
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 220,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Team 3',
	array(
		'label'			=> 'Team 3',
		'result'		=>
'<h2>[dropcap type="square" bg_color="#00b4ff" text_color="#ffffff"]3[/dropcap]Development Team</h2>' .
"\n\n" .
'[lead]' .
"\n\n" .
'Nunc a libero purus, nec hendrerit lacus. Vestibulum nisl orci, lobortis ac tincidunt vitae, porta et odio. Phasellus mattis molestie erat feugiat tincidunt. Mauris eget enim ac velit lobortis tincidunt consectetur quis elit.' .
"\n\n" .
'[/lead]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'[frame][placeholder width="213" height="200" type="user"][/frame]' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'<h3>Edward Thompson [flag bg_color="#00b4ff" text_color="#ffffff"]Senion Developer[/flag]</h3>' .
'[subheading_5]Happy father, Book lover, Guitar player[/subheading_5]' .
"\n\n" .
'Aenean ut tellus nisl, non pellentesque justo. Nam accumsan, lacus in tempor tempus, neque tellus accumsan nisl, ut egestas magna magna sit amet nulla. Ut eleifend sagittis tellus, ut malesuada odio volutpat sit amet.' . 
"\n\n" .
'Donec lacus elit, sagittis eget suscipit id, lacinia in lorem. Integer feugiat nulla a magna mattis malesuada. Maecenas dignissim urna vitae enim pretium vel aliquam metus volutpat.' . 
"\n\n" .
'[list type="pin"]' .
'<ul>' .
'<li>Etiam felis felis, volutpat quis imperdiet id</li>' .
'<li>Tincidunt id purus. Nunc mi dolor, vestibulum sed vehicula</li>' .
'<li>Etiam nisi est, auctor sit amet feugiat eu, viverra ac felis.</li>' .
'<li>Nullam gravida neque quis augue vestibulum euismod.</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'[progress_bar value="80"]' .
"\n\n" .
'<p style="margin-top:-20px;text-align:center;">PHP</p>' .
"\n\n" .
'[progress_bar value="70"]' .
"\n\n" .
'<p style="margin-top:-20px;text-align:center;">Javascript</p>' .
"\n\n" .
'[progress_bar value="60"]' .
"\n\n" .
'<p style="margin-top:-20px;text-align:center;">HTML &amp; CSS</p>' .
"\n\n" .
'[/one_fourth_last]' .
"\n\n" .
'[divider_top]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'[frame][placeholder width="213" height="200" type="user"][/frame]' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'<h3>Jennifer Williams [flag bg_color="#00b4ff" text_color="#ffffff"]Web Developer[/flag]</h3>' .
'[subheading_5]Happy mother, Typography lover, Piano player[/subheading_5]' ."\n\n" .
"\n\n" .
'Aenean ut tellus nisl, non pellentesque justo. Nam accumsan, lacus in tempor tempus, neque tellus accumsan nisl, ut egestas magna magna sit amet nulla. Ut eleifend sagittis tellus, ut malesuada odio volutpat sit amet.' . 
"\n\n" .
'Donec lacus elit, sagittis eget suscipit id, lacinia in lorem. Integer feugiat nulla a magna mattis malesuada. Maecenas dignissim urna vitae enim pretium vel aliquam metus volutpat.' . 
"\n\n" .
'[list type="pin"]' .
'<ul>' .
'<li>Etiam felis felis, volutpat quis imperdiet id</li>' .
'<li>Tincidunt id purus. Nunc mi dolor, vestibulum sed vehicula</li>' .
'<li>Etiam nisi est, auctor sit amet feugiat eu, viverra ac felis.</li>' .
'<li>Nullam gravida neque quis augue vestibulum euismod.</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'[progress_bar value="80"]' .
"\n\n" .
'<p style="margin-top:-20px;text-align:center;">PHP</p>' .
"\n\n" .
'[progress_bar value="70"]' .
"\n\n" .
'<p style="margin-top:-20px;text-align:center;">Javascript</p>' .
"\n\n" .
'[progress_bar value="60"]' .
"\n\n" .
'<p style="margin-top:-20px;text-align:center;">HTML &amp; CSS</p>' .
"\n\n" .
'[/one_fourth_last]',
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 230,															
	)			 
);






/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Process 1',
	array(
		'label'			=> 'Process 1',
		'result'		=>
'<h2>Our Approach 1</h2>' .
"\n\n" .
'[space px="20"]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'Step 1: [flag]Discover[/flag]' .
"\n\n" .
'[space px="-10"]' .
"\n\n" .
'<h3>Vestibulum mauris aenean egestas</h3>' .
"\n\n" .
'[placeholder height="90" width="213" type="no-image"]' .
"\n\n" .
'Quisque interdum massa eu nisi condimentum ac pretium orci aliquam. Maecenas non orci orci, et vestibulum mauris. Aenean egestas viverra ligula in molestie. Maecenas id libero est, a placerat justo. Donec vehicula, ipsum eu placerat vulputate, tortor risus tempus erat, nec cursus enim arcu sed dolor. Nunc suscipit auctor pretium.' . 
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'Step 2: [flag]Design[/flag]' .
"\n\n" .
'[space px="-10"]' .
"\n\n" .
'<h3>Vestibulum mauris aenean egestas</h3>' .
"\n\n" .
'[placeholder height="90" width="213" type="no-image"]' .
"\n\n" .
'Quisque interdum massa eu nisi condimentum ac pretium orci aliquam. Maecenas non orci orci, et vestibulum mauris. Aenean egestas viverra ligula in molestie. Maecenas id libero est, a placerat justo. Donec vehicula, ipsum eu placerat vulputate, tortor risus tempus erat, nec cursus enim arcu sed dolor. Nunc suscipit auctor pretium.' . 
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'Step 3: [flag]Develop[/flag]' .
"\n\n" .
'[space px="-10"]' .
"\n\n" .
'<h3>Vestibulum mauris aenean egestas</h3>' .
"\n\n" .
'[placeholder height="90" width="213" type="no-image"]' .
"\n\n" .
'Quisque interdum massa eu nisi condimentum ac pretium orci aliquam. Maecenas non orci orci, et vestibulum mauris. Aenean egestas viverra ligula in molestie. Maecenas id libero est, a placerat justo. Donec vehicula, ipsum eu placerat vulputate, tortor risus tempus erat, nec cursus enim arcu sed dolor. Nunc suscipit auctor pretium.' . 
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'Step 4: [flag]Deliver[/flag]' .
"\n\n" .
'[space px="-10"]' .
"\n\n" .
'<h3>Vestibulum mauris aenean egestas</h3>' .
"\n\n" .
'[placeholder height="90" width="213" type="no-image"]' .
"\n\n" .
'Quisque interdum massa eu nisi condimentum ac pretium orci aliquam. Maecenas non orci orci, et vestibulum mauris. Aenean egestas viverra ligula in molestie. Maecenas id libero est, a placerat justo. Donec vehicula, ipsum eu placerat vulputate, tortor risus tempus erat, nec cursus enim arcu sed dolor. Nunc suscipit auctor pretium.' . 
"\n\n" .
'[/one_fourth_last]',	
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 810,															
	)			 
);
/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Process 2',
	array(
		'label'			=> 'Process 2',
		'result'		=>
'<h2 style="text-align:center;">Our Approach 2</h2>' .
"\n\n" .
'[space px="20"]' .
"\n\n" .
'[one_fourth]' .
"\n\n" .
'[/one_fourth]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h2>1. Discover</h2>' .
"\n\n" .
'[subheading_4]Vivamus elit adispicing sit amet[/subheading_4]' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'Maecenas augue elit, gravida vel dictum vitae, hendrerit at lorem. Donec odio eros, aliquet ac venenatis in, tincidunt ut purus. Quisque dolor elit, facilisis sed placerat eu, pulvinar at ipsum. Vivamus aliquet nisi luctus eros molestie ac dapibus purus tristique.' . 
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[divider_arrow]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h2>2. Define</h2>' .
"\n\n" .
'[subheading_4]Vivamus elit adispicing sit amet[/subheading_4]' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'Maecenas augue elit, gravida vel dictum vitae, hendrerit at lorem. Donec odio eros, aliquet ac venenatis in, tincidunt ut purus. Quisque dolor elit, facilisis sed placerat eu, pulvinar at ipsum. Vivamus aliquet nisi luctus eros molestie ac dapibus purus tristique.' . 
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[divider_arrow]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h2>3. Design</h2>' .
"\n\n" .
'[subheading_4]Vivamus elit adispicing sit amet[/subheading_4]' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'Maecenas augue elit, gravida vel dictum vitae, hendrerit at lorem. Donec odio eros, aliquet ac venenatis in, tincidunt ut purus. Quisque dolor elit, facilisis sed placerat eu, pulvinar at ipsum. Vivamus aliquet nisi luctus eros molestie ac dapibus purus tristique.' . 
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[divider_arrow]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h2>4. Develop</h2>' .
"\n\n" .
'[subheading_4]Vivamus elit adispicing sit amet[/subheading_4]' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'Maecenas augue elit, gravida vel dictum vitae, hendrerit at lorem. Donec odio eros, aliquet ac venenatis in, tincidunt ut purus. Quisque dolor elit, facilisis sed placerat eu, pulvinar at ipsum. Vivamus aliquet nisi luctus eros molestie ac dapibus purus tristique.' . 
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[divider_arrow]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h2>5. Deliver</h2>' .
"\n\n" .
'[subheading_4]Vivamus elit adispicing sit amet[/subheading_4]' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'Maecenas augue elit, gravida vel dictum vitae, hendrerit at lorem. Donec odio eros, aliquet ac venenatis in, tincidunt ut purus. Quisque dolor elit, facilisis sed placerat eu, pulvinar at ipsum. Vivamus aliquet nisi luctus eros molestie ac dapibus purus tristique.' . 
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'[/one_fourth_last]',	
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 812,															
	)			 
);
/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Process 3',
	array(
		'label'			=> 'Process 3',
		'result'		=>
'<h2>Our Approach 3</h2>' .
"\n\n" .
'[space px="20"]' .
"\n\n" .
'[tabs position="left-top"]' .
"\n\n" .
'[tab_title]' .
"\n\n" .
'<h3>1. Discover</h3>' .
"\n\n" .
'[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur id turpis ut magna sollicitudin pulvinar quis vel felis. Cras urna mi, accumsan id faucibus a, ultricies in est. Donec est massa, ullamcorper dictum tempor ut, vehicula id nulla. Vivamus sagittis sodales diam, sit amet sagittis lorem ornare sit amet. Duis arcu urna, condimentum id blandit nec, ornare at eros. Maecenas scelerisque eleifend dapibus. In nec mi arcu. Fusce erat nisl, auctor quis malesuada malesuada, varius non justo.' . 
"\n\n" .
'Ut quis metus vitae nunc commodo elementum a eu elit. Morbi eu lacus sem, vel varius risus. Proin posuere dapibus sapien at luctus. Fusce pretium tortor at diam tempus pretium. Nulla facilisi. Suspendisse potenti. Vivamus convallis dolor eu leo sagittis lacinia. Sed accumsan metus vel erat pellentesque condimentum.' . 
"\n\n" .
'Integer accumsan magna non lorem pellentesque aliquam. Sed eget tortor ut arcu luctus sollicitudin nec et nulla. Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula.' . 
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[tab_title]' .
"\n\n" .
'<h3>2. Define</h3>' .
"\n\n" .
'[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur id turpis ut magna sollicitudin pulvinar quis vel felis.Nam sagittis, velit in vulputate iaculis, magna est imperdiet nisl, vel laoreet neque purus vel eros. Duis rutrum, mi eget porttitor pretium, mi ipsum pulvinar lectus, et dictum erat diam eget tortor. Cras urna mi, accumsan id faucibus a, ultricies in est. Donec est massa, ullamcorper dictum tempor ut, vehicula id nulla. Vivamus sagittis sodales diam, sit amet sagittis lorem ornare sit amet.' . 
"\n\n" .
'Duis arcu urna, condimentum id blandit nec, ornare at eros. Maecenas scelerisque eleifend dapibus. In nec mi arcu. Fusce erat nisl, auctor quis malesuada malesuada, varius non justo. Ut quis metus vitae nunc commodo elementum a eu elit. Morbi eu lacus sem, vel varius risus. Proin posuere dapibus sapien at luctus. Fusce pretium tortor at diam tempus pretium. Nulla facilisi. Suspendisse potenti. Vivamus convallis dolor eu leo sagittis lacinia. Sed accumsan metus vel erat pellentesque condimentum.' . 
"\n\n" .
'Integer accumsan magna non lorem pellentesque aliquam. Sed eget tortor ut arcu luctus sollicitudin nec et nulla. Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula.' . 
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[tab_title]' .
"\n\n" .
'<h3>3. Design</h3>' .
"\n\n" .
'[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'Vestibulum feugiat porttitor purus, nec vehicula est vulputate id. Cras suscipit convallis diam, vel dictum enim egestas at. Aliquam sed turpis tellus, scelerisque scelerisque enim. Cras nulla ligula, facilisis eget mattis at, volutpat vitae est. Curabitur at dolor sit amet erat egestas eleifend a nec dui. Phasellus ac leo sed tortor pulvinar convallis. Cras urna mi, accumsan id faucibus a, ultricies in est. Donec est massa, ullamcorper dictum tempor ut, vehicula id nulla.' . 
"\n\n" .
'Vivamus sagittis sodales diam, sit amet sagittis lorem ornare sit amet. Duis arcu urna, condimentum id blandit nec, ornare at eros. Maecenas scelerisque eleifend dapibus. In nec mi arcu. Fusce erat nisl, auctor quis malesuada malesuada, varius non justo. Ut quis metus vitae nunc commodo elementum a eu elit. Morbi eu lacus sem, vel varius risus. Proin posuere dapibus sapien at luctus. Fusce pretium tortor at diam tempus pretium. Nulla facilisi. Suspendisse potenti. Vivamus convallis dolor eu leo sagittis lacinia. Sed accumsan metus vel erat pellentesque condimentum.' . 
"\n\n" .
'Integer accumsan magna non lorem pellentesque aliquam. Sed eget tortor ut arcu luctus sollicitudin nec et nulla. Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula.' .
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[tab_title]' .
"\n\n" .
'<h3>4. Develop</h3>' .
"\n\n" .
'[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'Cras suscipit convallis diam, vel dictum enim egestas at. Aliquam sed turpis tellus, scelerisque scelerisque enim. Cras nulla ligula, facilisis eget mattis at, volutpat vitae est. Curabitur at dolor sit amet erat egestas eleifend a nec dui. Phasellus ac leo sed tortor pulvinar convallis. Cras urna mi, accumsan id faucibus a, ultricies in est. Donec est massa, ullamcorper dictum tempor ut, vehicula id nulla. Vivamus sagittis sodales diam, sit amet sagittis lorem ornare sit amet.' . 
"\n\n" .
'Duis arcu urna, condimentum id blandit nec, ornare at eros. Maecenas scelerisque eleifend dapibus. In nec mi arcu. Fusce erat nisl, auctor quis malesuada malesuada, varius non justo. Ut quis metus vitae nunc commodo elementum a eu elit. Morbi eu lacus sem, vel varius risus. Proin posuere dapibus sapien at luctus. Fusce pretium tortor at diam tempus pretium. Nulla facilisi. Suspendisse potenti. Vivamus convallis dolor eu leo sagittis lacinia. Sed accumsan metus vel erat pellentesque condimentum.' . 
"\n\n" .
'Integer accumsan magna non lorem pellentesque aliquam. Sed eget tortor ut arcu luctus sollicitudin nec et nulla. Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula. ' .
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[tab_title]' .
"\n\n" .
'<h3>5. Deliver</h3>' .
"\n\n" .
'[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'Porttitor purus, nec vehicula est vulputate id. Cras suscipit convallis diam, vel dictum enim egestas at. Aliquam sed turpis tellus, scelerisque scelerisque enim. Cras nulla ligula, facilisis eget mattis at, volutpat vitae est. Curabitur at dolor sit amet erat egestas eleifend a nec dui. Phasellus ac leo sed tortor pulvinar convallis. Cras urna mi, accumsan id faucibus a, ultricies in est. Donec est massa, ullamcorper dictum tempor ut, vehicula id nulla. Vivamus sagittis sodales diam, sit amet sagittis lorem ornare sit amet.' . 
"\n\n" .
'Duis arcu urna, condimentum id blandit nec, ornare at eros. Maecenas scelerisque eleifend dapibus. In nec mi arcu. Fusce erat nisl, auctor quis malesuada malesuada, varius non justo. Ut quis metus vitae nunc commodo elementum a eu elit. Morbi eu lacus sem, vel varius risus. Proin posuere dapibus sapien at luctus. Fusce pretium tortor at diam tempus pretium. Nulla facilisi. Suspendisse potenti. Vivamus convallis dolor eu leo sagittis lacinia. Sed accumsan metus vel erat pellentesque condimentum. ' .
"\n\n" .
'Integer accumsan magna non lorem pellentesque aliquam. Sed eget tortor ut arcu luctus sollicitudin nec et nulla. Curabitur elit ipsum, consequat nec tincidunt a, laoreet tincidunt est. Quisque sed arcu mollis dui condimentum auctor et ac diam. Donec tempus, mauris sed eleifend auctor, felis lectus rutrum risus, ac gravida massa neque quis risus. Nulla sit amet massa purus, eu varius ligula.' . 
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[/tabs]',	
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 814,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Contact',
	array(
		'label'			=> 'Contact',
		'result'		=>
'[one_half]' .
"\n\n" .
'<h2><img width="32" height="32" src="/wp-content/uploads/2012/03/user_group.png" alt=""> Get in Touch</h2>' .
"\n\n" .
'Proin id justo id libero consectetur fringilla. Vestibulum fringilla interdum mi, eget tristique nibh ultricies ut. In hac habitasse platea dictumst. Proin vulputate velit id dui porttitor eget.' . 
"\n\n" .
'[divider]' .
"\n\n" .
'<h2><img width="32" height="32" src="/wp-content/uploads/2012/03/icon_tablet_32.png" alt=""/> Our Office</h2>' .
'<dl>' .
'<dt><strong>Address</strong></dt>' .
'<dd>Big Street 987, London</dd>' .
'<dt><strong>Phone</strong></dt>' .
'<dd>444-555-666-777</dd>' .
'<dt><strong>Fax</strong></dt>' .
'<dd>444-555-666-777</dd>' .
'</dl>' .
"\n" .
'[divider]' .
"\n\n" .
'<h2><img width="32" height="32" src="/wp-content/uploads/2012/01/icon_magicwand_32.png" alt="" /> Opening Hours</h2>' .
"\n\n" .
'<dl>' .
'<dt><strong>Monday</strong></dt>' .
'<dd>9am-5pm</dd>' .
'<dt><strong>Tuesday</strong></dt>' .
'<dd>9am-5pm</dd>' .
'<dt><strong>Wednesday</strong></dt>' .
'<dd>9am-5pm</dd>' .
'<dt><strong>Tuesday</strong></dt>' .
'<dd>9am-5pm</dd>' .
'<dt><strong>Friday</strong></dt>' .
'<dd>9am-2pm</dd>' .
'</dl>' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_half_last]' .
"\n\n" .
'<h2><img width="32" height="32" src="/wp-content/uploads/2012/03/icon_mail_32.png" alt="" /> Send Us a Message</h2>' .
"\n\n" .
'<strong>This is just a sample contact form.</strong>' ."\n" .
'You can place it wherever you want, even multiple times with different attributes.' .
"\n\n" .
'[contact_form]' .
"\n\n" .
'[/one_half_last]',	
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 410,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** FAQ 1',
	array(
		'label'			=> 'FAQ 1',
		'result'		=>
'[toggle title="Cras mollis vehicula dolor, a faucibus felis scelerisque ac?"]' .
"\n\n" .
'Donec sed lacus sed ligula volutpat ullamcorper. Nullam non purus in eros lacinia tempus. Vestibulum nec volutpat ipsum. Vestibulum malesuada sollicitudin eleifend. Quisque ultricies commodo iaculis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum tempor varius fringilla. Sed feugiat, tortor ut rutrum cursus, ligula nunc pretium est, eget porta tellus nibh at leo. Maecenas ut ipsum ipsum, vel vulputate erat. Fusce auctor pulvinar nunc, vitae sodales augue volutpat feugiat. Donec eu tellus sem. Maecenas feugiat rhoncus est, ac pellentesque dolor facilisis vel. Etiam bibendum massa dictum felis condimentum vehicula. Nunc interdum molestie odio, ac pellentesque magna facilisis id.' . 
"\n\n" .
'[/toggle]' .
"\n\n" .
'[toggle title="Vestibulum at velit diam. Donec et est vel lorem egestas hendrerit?"]' .
"\n\n" .
'Sed felis purus, faucibus ut dapibus ac, ullamcorper at lorem. In ut eros congue lectus interdum fringilla vel commodo nisi. Maecenas magna quam, dapibus at malesuada nec, vestibulum ut tortor. Quisque blandit lectus a quam suscipit non fermentum erat consectetur. Sed iaculis lacinia augue, nec scelerisque metus placerat vel.' .
"\n\n" .
'[/toggle]' .
"\n\n" .
'[toggle title="Pellentesque habitant morbi tristique senectus et netus et malesuada?"]' .
"\n\n" .
'Donec commodo justo non eros vehicula volutpat. Nunc accumsan, metus quis volutpat fermentum, felis lacus euismod quam, at ullamcorper quam velit ut augue. Etiam fringilla, dolor eget tempus mattis, nulla sem luctus ante, at tristique purus neque quis neque. Vivamus pretium feugiat hendrerit.' . 
"\n\n" .
'[/toggle]' .
"\n\n" .
'[toggle title="Habitant morbi tristique senectus et netus et malesuada fames?"]' .
"\n\n" .
'Consequat scelerisque eu libero. Aliquam erat volutpat. Donec ac metus vel sem tincidunt molestie eu eget lectus. Nullam placerat fermentum velit, ac porta nunc viverra nec. Etiam sit amet facilisis urna.' .
"\n\n" .
'[/toggle]' .
"\n\n" .
'[toggle title="Morbi tristique senectus et netus et malesuada fames ac turpis?"]' .
"\n\n" .
'Condimentum lacinia congue at lorem. Suspendisse nec elit nunc. Ut tristique metus sed lacus sollicitudin consequat. Curabitur et facilisis nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam ornare posuere aliquam.' . 
"\n\n" .
'[/toggle]' . "\n\n",
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 510,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** FAQ 2',
	array(
		'label'			=> 'FAQ 2',
		'result'		=>
'<h2>[dropcap type="square"]1[/dropcap] Proin lorem orci, aliquet sed?</h2>' .
"\n\n" .
'[testimonial name="Michael" job_title="Frontend Developer" type="bubble"]' .
"\n\n" .
'Etiam nisi est, auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[divider_top]' .
"\n\n" .
'<h2>[dropcap type="square"]2[/dropcap] Cras id nulla et neque volutpat facilisis?</h2>' .
"\n\n" .
'[testimonial name="Bartek" job_title="Flash Developer" type="bubble"]' .
"\n\n" .
'Fusce consectetur tellus id lorem luctus id eleifend magna lobortis. Aliquam facilisis magna ac nisi porta porta. In hac habitasse platea dictumst. Mauris sollicitudin, mi nec vulputate iaculis, dui dolor congue nunc, sit amet venenatis erat nulla sit amet turpis. Integer pharetra vehicula lectus, ullamcorper venenatis lacus commodo nec.' . 
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[divider_top]' .
"\n\n" .
'<h2>[dropcap type="square"]3[/dropcap] Lorem orci, aliquet sed molestie vel?</h2>' .
"\n\n" .
'[testimonial name="Peter" job_title="Webdesigner" type="bubble"]' .
"\n\n" .
'Etiam nisi est, auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris.' .
"\n\n" .
'[/testimonial]' . "\n\n",
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 520,															
	)			 
);




/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Pricing Boxes 1',
	array(
		'label'			=> 'Pricing Boxes 1',
		'result'		=>
'<h2>Our Packages 1</h2>' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h2 style="text-align: center;">Starter</h2>' .
"\n\n" .
'<h4 style="text-align: center;">Vivamus Adispicing</h4>' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<ul>' . 
'<li>Curabitur euismod ipsum dolor</li>' . 
'<li>Tincidunt lacinia sit adispicing</li>' . 
'<li>Morbi adipis vivamus elit</li>' .
'</ul>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h1 style="text-align: center;">$19<sup>99</sup><sub>/mo</sub></h1>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[button link="/" size="medium" wide="true" bg_color="#cccccc" text_color="#666666"]Sign Up[/button]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h2 style="text-align: center;">Advanced</h2>' .
"\n\n" .
'<h4 style="text-align: center;">Vivamus Adispicing</h4>' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<ul>' .
'<li>Curabitur euismod ipsum dolor</li>' .
'<li>Tincidunt lacinia sit adispicing</li>' .
'<li>Morbi adipis vivamus elit</li>' .
'</ul>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h1 style="text-align: center;">$29<sup>99</sup><sub>/mo</sub></h1>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[button link="/" size="medium" wide="true"]Sign Up[/button]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h2 style="text-align: center;">Business</h2>' .
"\n\n" .
'<h4 style="text-align: center;">Vivamus Adispicing</h4>' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<ul>' .
'<li>Curabitur euismod ipsum dolor</li>' .
'<li>Tincidunt lacinia sit adispicing</li>' .
'<li>Morbi adipis vivamus elit</li>' .
'</ul>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h1 style="text-align: center;">$39<sup>99</sup><sub>/mo</sub></h1>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[button link="/" size="medium" wide="true" bg_color="#cccccc" text_color="#666666"]Sign Up[/button]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[/one_third_last]' . "\n\n",
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 610,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Pricing Boxes 2',
	array(
		'label'			=> 'Pricing Boxes 2',
		'result'		=>
'<h2>Our Packages 2</h2>' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'Starter Pack' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h1>$19<sup>99</sup><sub>/mo</sub></h1>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[list type="check"]' .
'<ul>' .
'<li>Curabitur euismod ipsum dolor</li>' .
'<li>Tincidunt lacinia sit adispicing</li>' .
'<li>Morbi adipis vivamus elit</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[button link="/" size="medium" wide="true" bg_color="#cccccc" text_color="#666666"]Sign Up[/button]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'Advanced Pack' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h1>$29<sup>99</sup><sub>/mo</sub></h1>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[list type="check"]' .
'<ul>' .
'<li>Curabitur euismod ipsum dolor</li>' .
'<li>Tincidunt lacinia sit adispicing</li>' .
'<li>Morbi adipis vivamus elit</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[button link="/" size="medium" wide="true"]Sign Up[/button]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[/one_third]' .
"\n\n" .
'[one_third_last]' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'Business Pack' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h1>$39<sup>99</sup><sub>/mo</sub></h1>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[list type="check"]' .
'<ul>' .
'<li>Curabitur euismod ipsum dolor</li>' . 
'<li>Tincidunt lacinia sit adispicing</li>' .
'<li>Morbi adipis vivamus elit</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[button link="/" size="medium" wide="true" bg_color="#cccccc" text_color="#666666"]Sign Up[/button]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[/one_third_last]' . "\n\n",
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 620,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Careers',
	array(
		'label'			=> 'Careers',
		'result'		=>		
'[three_fourth]' .
"\n\n" .
'<h2>Our Benefits</h2>' .
"\n\n" .
'[lead]' .
"\n\n" .
'Phasellus fermentum est ac nisi consectetur viverra id id neque. Vivamus felis turpis, porta non malesuada eu, egestas sit amet nisi. Suspendisse sed eros nulla, sit amet consequat ligula Ut a est non risus mollis' .
"\n\n" .
'[/lead]' .
"\n\n" .
'<h2>Career Opportunities</h2>' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h3>Senior Developer [flag bg_color="#00ae10" text_color="#ffffff"]Development Team[/flag]</h3>' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h4>Overview</h4>' .
"\n\n" .
'<dl>' . 
'<dt>Date Posted</dt>' .
'<dd>2/8/12</dd>' .
'<dt>Job Code</dt>' .
'<dd>GHDF2389</dd>' .
'<dt>City</dt>' .
'<dd>New York</dd>' .
'<dt>Country</dt>' .
'<dd>United States of America</dd>' .
'<dt>Job Type</dt>' .
'<dd>Regular</dd>' .
'</dl>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h4>Description</h4>' .
"\n\n" .
'Vivamus euismod eleifend ipsum sit amet molestie. Pellentesque eget turpis ac leo vehicula consectetur. Fusce tortor turpis, consectetur non laoreet a, feugiat feugiat tortor. Donec vel augue massa. Cras eleifend tempus eros nec adipiscing. Morbi et nisl odio. Nam sed lacus nunc. Sed porta volutpat lectus, et congue sem consequat at. In justo odio, lobortis quis fermentum eu, consectetur id libero. Mauris eget enim ac velit lobortis tincidunt consectetur quis elit.' . 
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h4>Minimum Requirements</h4>' .
"\n\n" .
'[list type="arrow"]' .
'<ul>' .
'<li>Vivamus euismod eleifend ipsum sit amet molestie</li>' .
'<li>Pellentesque eget turpis ac leo vehicula consectetur</li>' .
'<li>Fusce tortor turpis, consectetur non laoreet a</li>' .
'<li>Feugiat feugiat tortor. Donec vel augue massa.</li>' .
'<li>Cras eleifend tempus eros nec adipiscing</li>' .
'<li>Morbi et nisl odio. Nam sed lacus nunc</li>' .
'<li>Sed porta volutpat lectus, et congue sem consequat at</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[button size="medium" link="/"]Apply Now[/button]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'<hr />' .
"\n\n" .
'[box]' .
"\n\n" .
'[box_header]' .
"\n\n" .
'<h3>Creative Director [flag bg_color="#ff0000" text_color="#ffffff"]Design Team[/flag]</h3>' .
"\n\n" .
'[/box_header]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h4>Overview</h4>' .
"\n\n" .
'<dl>' .
'<dt>Date Posted</dt>' .
'<dd>2/8/12</dd>' .
'<dt>Job Code</dt>' .
'<dd>GHDF2389</dd>' .
'<dt>City</dt>' .
'<dd>New York</dd>' .
'<dt>Country</dt>' .
'<dd>United States of America</dd>' .
'<dt>Job Type</dt>' .
'<dd>Regular</dd>' .
'</dl>' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h4>Description</h4>' .
"\n\n" .
'Vivamus euismod eleifend ipsum sit amet molestie. Pellentesque eget turpis ac leo vehicula consectetur. Fusce tortor turpis, consectetur non laoreet a, feugiat feugiat tortor. Donec vel augue massa. Cras eleifend tempus eros nec adipiscing. Morbi et nisl odio. Nam sed lacus nunc. Sed porta volutpat lectus, et congue sem consequat at. In justo odio, lobortis quis fermentum eu, consectetur id libero. Mauris eget enim ac velit lobortis tincidunt consectetur quis elit.' . 
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'<h4>Minimum Requirements</h4>' .
"\n\n" .
'[list type="arrow"]' .
'<ul>' .
'<li>Vivamus euismod eleifend ipsum sit amet molestie</li>' .
'<li>Pellentesque eget turpis ac leo vehicula consectetur</li>' .
'<li>Fusce tortor turpis, consectetur non laoreet a</li>' .
'<li>Feugiat feugiat tortor. Donec vel augue massa.</li>' .
'<li>Cras eleifend tempus eros nec adipiscing</li>' .
'<li>Morbi et nisl odio. Nam sed lacus nunc</li>' .
'<li>Sed porta volutpat lectus, et congue sem consequat at</li>' .
'</ul>' .
"\n\n" .
'[/list]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[box_content]' .
"\n\n" .
'[button size="medium" link="/"]Apply Now[/button]' .
"\n\n" .
'[/box_content]' .
"\n\n" .
'[/box]' .
"\n\n" .
'[/three_fourth]' .
"\n\n" .
'[one_fourth_last]' .
"\n\n" .
'<h2>Our Culture</h2>' .
"\n\n" .
'<img src="/wp-content/uploads/2012/02/responsive_design_v05.png" width="120" height="120" class="aligncenter" alt="Responsive Design" />' .
"\n\n" .
'<strong>Class aptent</strong> taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.' .
"\n\n" .
'Aenean fermentum velit vel lacus tempor quis pulvinar elit gravida. Mauris quis congue dui.' .
"\n\n" .
'[/one_fourth_last]	',
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 710,															
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Testimonials',
	array(
		'label'			=> 'Testimonials',
		'result'		=>		
'[precontent]' .
"\n\n" .
'<div style="text-align:center;">' .
"\n\n" .
'[heading_1 type="divider"]Client Speaks[/heading_1]' .
"\n\n" .
'[tabs type="button" position="bottom-center"]' .
"\n\n" .
'[tab_title]<img src="/wp-content/uploads/2012/01/logo_1.png" alt="Logo 1" class="aligncenter"/>[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'[testimonial size="big" type="simple"]' .
"\n\n" .
'Maecenas non orci orci, et vestibulum mauris. Aenean egestas viverra ligula in molestie. Id libero est, a placerat justo. Donec vehicula, ipsum eu <a href="/"><strong>placerat vulputate</strong></a>, tortor risus tempus erat, nec cursus enim arcu sed dolor' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[tab_title]<img src="/wp-content/uploads/2012/01/logo_2.png" alt="Logo 2" class="aligncenter"/>[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'[testimonial size="big" type="simple"]' .
"\n\n" .
'Ames maecenas non orci orci, et vestibulum mauris. Aenean egestas viverra ligula in molestie. <a href="/"><strong>Maecenas id libero</strong></a> est, a placerat justo. Donec vehicula, ipsum eu placerat vulputate, tortor risus tempus erat, nec cursus enim arcu sed dolor' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[tab_title]<img src="/wp-content/uploads/2012/01/logo_3.png" alt="Logo 3" class="aligncenter"/>[/tab_title]' .
"\n\n" .
'[tab_content]' .
"\n\n" .
'[testimonial size="big" type="simple"]' .
"\n\n" .
'Lotem sit non orci orci, et vestibulum mauris. Aenean egestas <a href="/"><strong>viverra ligula</strong></a> in molestie. Maecenas id libero est, a placerat justo. Donec vehicula, ipsum eu placerat vulputate, tortor risus tempus erat, nec cursus enim arcu sed dolor' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/tab_content]' .
"\n\n" .
'[/tabs]' .
"\n\n" .
'</div>' .
"\n\n" .
'[/precontent]' .
"\n\n" .
'<div style="text-align:center;">' .
"\n\n" .
'[frame type="simple"]<img src="/wp-content/uploads/2012/03/avatar_1.jpg" width="40" height="40" alt="George Novitzky Avatar 1" />[/frame]' .
"\n\n" .
'[space px="-20"]' .
"\n\n" .
'[testimonial name="George Novitzky" company="MyCompany" size="big" type="simple"]' .
"\n\n" .
'Auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. <a href="/">Suspendisse risus</a> tortor, varius ac malesuada in, mattis vitae mauris. Curabitur aliquam blandit tortor.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[divider]' .
"\n\n" .
'[frame type="simple"]<img src="/wp-content/uploads/2012/03/avatar_1.jpg" width="40" height="40" alt="George Novitzky Avatar 1" />[/frame]' .
"\n\n" .
'[space px="-20"]' .
"\n\n" .
'[testimonial name="James Thompson" job_title="CEO" company="YourCompany" size="big" type="simple"]' .
"\n\n" .
'Nullam gravida neque quis augue vestibulum euismod. <a href="/">Suspendisse risus</a> tortor, varius ac malesuada in, mattis vitae mauris. Curabitur aliquam blandit tortor. Auctor sit amet feugiat eu &amp; viverra ac felis.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[divider]' .
"\n\n" .
'</div>' .
"\n\n" .
'[one_half]' .
"\n\n" .
'[testimonial name="James Thompson" job_title="CEO" company="YourCompany" size="small" type="bubble"]' .
"\n\n" .
'Praesent porta placerat consectetur. Auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. <a href="/">Suspendisse risus</a> tortor, varius ac malesuada in, mattis vitae mauris. Curabitur aliquam blandit tortor.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_half_last]' .
"\n\n" .
'[testimonial name="Jennifer Nowak" job_title="CEO" company="YourCompany" company_link="/" size="small" type="bubble"]' .
"\n\n" .
'Auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. <a href="/">Suspendisse risus</a> tortor, varius ac malesuada in, mattis vitae mauris. Curabitur aliquam blandit tortor. Praesent porta placerat consectetur.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/one_half_last]' .
"\n\n" .
'[one_half]' .
"\n\n" .
'[testimonial name="Michelle Pier" job_title="Executive Officer" company="AnotherCompany" size="small" type="bubble"]' .
"\n\n" .
'Placerat consectetur. Auctor sit amet feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. <a href="/">Suspendisse risus</a> tortor, varius ac malesuada in, mattis vitae mauris. Curabitur aliquam blandit tortor. Praesent porta.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/one_half]' .
"\n\n" .
'[one_half_last]' .
"\n\n" .
'[testimonial name="James Thompson" job_title="CEO" company="YourCompany" size="small" type="bubble"]' .
"\n\n" .
'Feugiat eu &amp; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. <a href="/">Suspendisse risus</a> tortor, varius ac malesuada in, mattis vitae mauris. Curabitur aliquam blandit tortor. Praesent porta placerat consectetur. Auctor sit amet.' .
"\n\n" .
'[/testimonial]' .
"\n\n" .
'[/one_half_last]',
		'group'			=> 'general',
		'subgroup'		=> 'pagesnippets',	
		'position'		=> 910,															
	)			 
);
?>