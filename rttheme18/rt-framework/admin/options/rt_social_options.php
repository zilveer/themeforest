<?php 
$options = array (
	array(
		"name" => __("Info",'rt_theme_admin'),
		"desc" => __("Supply a valid URL to the your email address, contact page, rss-feed or social media page of your choice in the corresponding fields below in order to display it's icon at the front of your website. The icon will link to the supplied address.<br /><br />You can make the (social media) icons appear in the top of the page and in the footer by turning on the 'position' toggles down below. You can also have the icons show anywhere in your website by the use of the available social icon shortcode." ,'rt_theme_admin'),
		"type" => "info",
	),

	array(
		"name" => __("SOCIAL MEDIA SHORTCODE",'rt_theme_admin'), 
		"type" => "heading"),

	array( 
		"desc" => __("Use this shortcode to list the social icons anywhere within your website at the shortcode&#39;s position.<br /><br />[rt_social_media_icons] ",'rt_theme_admin'),
		"type" => "info_text",
	),

	array(
		"name" => __("POSITIONS",'rt_theme_admin'), 
		"type" => "heading"),

	array(
		"name"    => __("Display icons in the top of the website page above the header.",'rt_theme_admin'),			
		"id"      => RT_THEMESLUG."_social_media_top",
		"type"    => "checkbox2",				
		"hr"      => "true",
		"default" => "on" 				
	),

	array(
		"name"    => __("Display icons in the footer of the website page",'rt_theme_admin'),
		"id"      => RT_THEMESLUG."_social_media_bottom",
		"type"    => "checkbox2",
		"default" => "on" 
	),

); 

global $rt_social_media_icons;

$i=0; foreach( $rt_social_media_icons as $key => $value ){   
	$i++; 
		$httpkeyurl='http://'.strtolower($key).__('.com/the-','rt_theme_admin').strtolower($key);
		if ($key=="Google +") $httpkeyurl=str_replace( ' +' , '' , $httpkeyurl);
		$msgdesc=__(" Link field : Enter a valid URL (http or https) to social media ",'rt_theme_admin').$key.__(" page. <br /><br /><strong>For example</strong> : ",'rt_theme_admin').$httpkeyurl.__("-userpath/ <br /><strong>Note</strong> : Consult the <strong>",'rt_theme_admin').$key. __(" documentation</strong> for more information on the how to link to ",'rt_theme_admin').$key.'.';

		if ($key=="Email") {
			global $current_user; 
			$msgdesc=__(" Link field : Enter a valid URL (http or https) to : <br /><br />the contact page [<strong>Example</strong> : ",'rt_theme_admin'). site_url().__("/contact",'rt_theme_admin').__("] <br />the email address. [<strong>Example</strong> : ",'rt_theme_admin').$current_user->user_email.__("] <br /><br /><strong>Note</strong> : Do not add 'mailto:' as the theme will add that automatically in case a valid emailaddress is used.",'rt_theme_admin');
		}
		
		if ($key=="Skype") $msgdesc=__(" Link field : Enter a valid skype address. <strong>Syntax</strong> : 'skype:skypeid?call' or 'skype:phonenumber?call'.<br /><br /><strong>Note</strong> : Consult the <strong>Skype documentation</strong> for more options and exact details.",'rt_theme_admin');	

		if ($key=="RSS") {
           		$msgdesc= __(" Link field : Enter a valid URL (http or https) to the RSS-feed. <strong>For example</strong> : ",'rt_theme_admin').site_url().__("/feed/<br /><br /><strong>Note</strong> : Consult the online <strong>Wordpress RSS documentation</strong> for more information on the how to link to a RSS feed",'rt_theme_admin');
		}
	
	
	$hr = count($rt_social_media_icons)==$i ? "true" : "" ; // hr for latest element  

	array_push($options, 
				array(
				"name" => $key,  
				"type" => "heading"
				)
			);  

	array_push($options, 
				array(
				"name" => $key. __(" icon link",'rt_theme_admin'),
				"desc"      => $msgdesc,
				"id"   => RT_THEMESLUG."_".$value."",
				"type" => "text"
				)
			);   

	array_push($options, 
				array(
				"name" => $key. __(" Text",'rt_theme_admin'), 
				"desc"      => __('Enter the hover text for the ','rt_theme_admin').$key.__(' icon. The text will appear on mouse hover of the icon.','rt_theme_admin'),
				"id"   => RT_THEMESLUG."_".$value."_text",
				"type" => "text" 
				)
			);  			
 
	array_push($options, 
				array(
				"name" => $key. __(" Link target",'rt_theme_admin'),  
				"id"   => RT_THEMESLUG."_".$value."_target",
				"options"   => array('_blank'=>'New Window','_self'=>'Same Window'), 
				"type" => "select",
				"desc" => __('Select and set the target for the (social) icon.','rt_theme_admin'),
				"hr"   => "".$hr."" 
				)
			);  			
} 
?>