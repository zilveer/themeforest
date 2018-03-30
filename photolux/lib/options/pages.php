<?php
global $pexeto_data;

array_unshift($pexeto_categories, array('id'=>-1, 'name'=>'All Categories'));

//load the porftfolio categeories
$portf_taxonomies=get_terms('portfolio_category');
$portf_categories=array(array('id'=>'hide','name'=>'Hide'), (array('id'=>'disabled','name'=>'Show:', 'class'=>'caption')), array('id'=>'-1', 'name'=>'All Categories'));
foreach($portf_taxonomies as $taxonomy){
	$portf_categories[]=array("name"=>$taxonomy->name, "id"=>$taxonomy->term_id);
}

$pexeto_pages_options= array( array(
"name" => "Page Settings",
"type" => "title",
"img" => "icon-document"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"blog", "name"=>"Blog"), array("id"=>"portfolio", "name"=>"Portfolio"), array("id"=>"contact", "name"=>"Contact"))
),

/* ------------------------------------------------------------------------*
 * BLOG PAGE SETTINGS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'blog'
),



array(
"name" => "Page Layout",
"id" => PEXETO_SHORTNAME."_blog_layout",
"type" => "select",
"options" => array(array('id'=>'right','name'=>'Right Sidebar'), array('id'=>'left','name'=>'Left Sidebar'), array('id'=>'full','name'=>'Full width')),
"std" => 'right',
"desc" => 'This layout setting will affect the blog page, blog posts template, archives and search pages'
),

array(
"name" => "Blog sidebar",
"id" => PEXETO_SHORTNAME."_blog_sidebar",
"type" => "select",
"options" => $pexeto_data->pexeto_sidebars,
"std" => 'default',
"desc" => 'This sidebar setting will affect the blog page, blog posts template, archives and search pages'
),


array(
"name" => "Header",
"id" => PEXETO_SHORTNAME."_home_slider",
"type" => "select",
"options" => pexeto_get_created_sliders(),
"std" => 'none',
"desc" => 'If you have created additional sliders, you can select the name of the slider to be displayed
on the blog. By default the Default slider for each slider type is displayed.'
),

array(
"name" => "Static Image URL",
"id" => PEXETO_SHORTNAME."_blog_static_image",
"type" => "upload",
"desc" => 'The header image URL when "Static Header Image" selected above. Optimal image size: 980 x 370 pixels.',
),

array(
"name" => "Exclude categories from blog",
"id" => PEXETO_SHORTNAME."_exclude_cat_from_blog",
"type" => "multicheck",
"options" => $pexeto_categories,
"class"=>"exclude",
"desc" => "You can select which categories not to be shown on the blog"),

array(
"name" => "Number of posts per page",
"id" => PEXETO_SHORTNAME."_post_per_page_on_blog",
"type" => "text",
"std" => "5"
),


array(
"name" => "Show sections from post info",
"id" => PEXETO_SHORTNAME."_exclude_post_sections",
"type" => "multicheck",
"options" => array(array("id"=>"date", "name"=>"Post Date"), array("id"=>"author", "name"=>"Post Author"), array("id"=>"category", "name"=>"Post Category"), array("id"=>"comments", "name"=>"Comment Number")),
"class"=>"exclude",
"desc" => "You can select which sections from the post info to be dispplayed.",
"std" => "")
,

array(
"name" => "Show post summary as",
"id" => PEXETO_SHORTNAME."_post_summary",
"type" => "select",
"options" => array(array('id'=>'readmore','name'=>"Separated with 'More' tag"), array('id'=>'excerpt','name'=>"Excerpt")),
"std" => 'readmore',
"desc" => "This is the way the summary is displayed. Using the 'More' tag is more flexible than using the excerpt. With this
option selected, only the text that is displayed before the 'More' tag will be displayed as summary. 
You can insert a 'More' tag by using the 'Insert More tag' button that is located above the main content area.
<br /><br />With the Excerpt option
selected, only the first several words of the post will be displayed as summary."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * PORTFOLIO PAGE SETTINGS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'portfolio'
),

array(
"name" => "Page Layout",
"id" => PEXETO_SHORTNAME."_portfolio_layout",
"type" => "select",
"options" => array(array('id'=>'right','name'=>'Right Sidebar'), array('id'=>'left','name'=>'Left Sidebar'), array('id'=>'full','name'=>'Full width')),
"std" => 'right',
"desc" => 'This is the layout of the portfolio item content page'
),

array(
"name" => "Show comments",
"id" => PEXETO_SHORTNAME."_portfolio_comments",
"type" => "checkbox",
"std" =>'off'
),

array(
"name" => "Content sidebar",
"id" => PEXETO_SHORTNAME."_portfolio_sidebar",
"type" => "select",
"options" => $pexeto_data->pexeto_sidebars,
"std" => 'default',
"desc" => 'This is the sidebar that is displayed on the item content page.'
),

array(
"name" => "Hide gallery in slider description",
"id" => PEXETO_SHORTNAME."_hide_slider_desc",
"type" => "checkbox",
"std" =>'on',
"desc" => "When enabled, it will hide the gallery inserted in the portfolio item
when it is displayed in a slider in the Grid Gallery. This functionality is 
useful when you add the slider images with a gallery into the content of the item."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * CONTACT PAGE SETTINGS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'contact'
),

array(
"name" => "Email to which to send contact form message",
"id" => PEXETO_SHORTNAME."_email",
"type" => "text"),

array(
'name' => 'Email sender',
'id' => PEXETO_SHORTNAME.'_email_from',
'type' => 'text',
'desc' => '<b>Important:</b> Please do not leave this field empty.<br/>
Set a custom email address that will be set as a sender of the email.<br/>
Yahoo has recently published a DMARC policy of reject, meaning
that all the emails that are sent from Yahoo emails, but not from the Yahoo servers,
should be rejected by the email providers.<br/>
This means that if your site visitor sets a Yahoo email and this email is set as a
sender, you may not be able to receive the email (depending on the email provider that you use
	to receive the messages).<br/>
Therefore, please make sure to set your custom email address in this field (such as noreply@domain.com, non-Yahoo address),
so that you can receive emails from Yahoo users.' 
),


array(
"name" => "Name text",
"id" => PEXETO_SHORTNAME."_name_text",
"type" => "text",
"std" => "Name"
),

array(
"name" => "Your e-mail text",
"id" => PEXETO_SHORTNAME."_your_email_text",
"type" => "text",
"std" => "Your e-mail"
),

array(
"name" => "Question text",
"id" => PEXETO_SHORTNAME."_question_text",
"type" => "text",
"std" => "Question"
),

array(
"name" => "Send text",
"id" => PEXETO_SHORTNAME."_send_text",
"type" => "text",
"std" => "Send"
),

array(
"name" => "Message sent text",
"id" => PEXETO_SHORTNAME."_message_sent_text",
"type" => "text",
"std" => "Message sent"
),

array(
"name" => "Validation error message",
"id" => PEXETO_SHORTNAME."_contact_error",
"type" => "text",
"std" => "Please fill in all the fields correctly."
),

array(
		'type' => 'documentation',
		'text' => '<h3>CAPTCHA Settings</h3>'
	),

	array(
		'name' => 'Enable CAPTCHA',
		'id' => PEXETO_SHORTNAME.'_captcha',
		'type' => 'checkbox',
		'std' => false,
		'desc' => 'reCAPTCHA will protect your contact form from spam emails 
			that are generated from robots. If this field is enabled, a CAPTCHA 
			form will be added to the bottom of the contact form. The user will 
			have to insert the text from the generated image in order to prove 
			that he/she is a real human and not a spamming robot.<br /> Please 
			note that you have to also set the "reCAPTCHA public Key" and 
			"reCAPTCHA private Key" fields below.'
	),

	array(
		'name' => 'reCAPTCHA Public Key',
		'id' => PEXETO_SHORTNAME.'_captcha_public_key',
		'type' => 'text',
		'desc' => 'In order to use CAPTCHA you need to register a public and 
			private keys - you can do it on this page:<br/>
			http://www.google.com/recaptcha/whyrecaptcha <br/>
			For more information you can refer to the "Contact Page" section 
			of the documentation.'
	),

	array(
		'name' => 'reCAPTCHA Private Key',
		'id' => PEXETO_SHORTNAME.'_captcha_private_key',
		'type' => 'text',
		'desc' => 'In order to use CAPTCHA you need to register a public 
			and private keys - you can do it on this page:<br/>
			http://www.google.com/recaptcha/whyrecaptcha <br/>
			For more information you can refer to the "Contact Page" section of 
			the documentation.'
	),

	array(
		'name' => 'CAPTCHA text',
		'id' => PEXETO_SHORTNAME.'_captcha_text',
		'type' => 'text',
		'std' => 'Insert the text from the image'
	),

	array(
		'name' => 'Wrong CAPTCHA message',
		'id' => PEXETO_SHORTNAME.'_wrong_captcha_error_text',
		'type' => 'text',
		'std' => 'The text you have entered did not match the text on the image. 
		Please try again.'
	),

	array(
		'name' => 'Get a new challenge text',
		'id' => PEXETO_SHORTNAME.'_refresh_btn_text',
		'type' => 'text',
		'std' => 'Get a new challenge'
	),

array(
"type" => "close"),


array(
"type" => "close"));

pexeto_add_options($pexeto_pages_options);