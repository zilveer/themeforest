<?php

$options = array (
	
 	array(
	"type"      => "hr"),	
	
	array(
	"name"      => __("Footer Copyright Text",'rt_theme_admin'),
	"desc"      => __('Set a copyright text in the left side of footer in your website. You can use shorcodes, simple javascript (f.e. to display auto year) and HTML within this field.<br /><br /><strong>Example</strong> : To put a auto year within the copyright section copy and paste the code below into the Footer Copyright Text field. <br /><br />Copyright &copy; &#60;script type="text/javascript"&#62;<br />copyright=new Date();<br />update=copyright.getFullYear();<br />document.write("2013 -  " + update + " " + " ");<br />&#60;/script&#62; &#60;a title="Visit our company" href="/"&#62;Company name&#60;/a&#62;','rt_theme_admin'),
	"id"        => RT_THEMESLUG."_footer_copy",
	"default"	=>  'Copyright &copy; 2014 Company Name, Inc.',
	"type"      => "textarea"),


	array(
	"name" 		=> __("FOOTER WIDGETS",'rt_theme_admin'), 
	"type" 		=> "heading"),

	
	array(
	"name"      => __("Footer Widget Layout",'rt_theme_admin'),
	"desc"      => __("Select and set the column layout of the footer widget area. Footer widgets can be presented into 1 column up to 5 columns. <br /><br /><strong>Note</strong> : The footer comes with five default widgetized area&#39;s. Setting the column in here to a two column layout will result that the theme will only display widgets which are dropped into the first two footer widgetized area's. So it is useless to drop widgets in the third footer widget area when the columns in here are set to display only two columns.",'rt_theme_admin'),
	"id"        => RT_THEMESLUG."_footer_box_width",
	"options"   =>  array(
						5 => "1/5", 
						4 => "1/4",
						3 => "1/3",
						2 => "1/2",
						1 => "1/1"
					),
	"default"   => "4",
	"hr"        => "true",
	"help"      => "true",
	"type"      => "select"),

); 
?>