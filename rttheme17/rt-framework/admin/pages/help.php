<?php
#
#   RT-Framework Tooltip Help
#
define('THEMESLUG','rttheme');


	$tipID=$_GET['tipID'];
	$tipName=$_GET['tipName'];
	$adminURI=$_GET['adminURI'];

	switch ($tipID){


		///////////////////////////// 		GENERAL OPTIONS		/////////////////////////////

		#
		#	widgetized part of home page
		#
		case THEMESLUG.'_home_box_width';
		    
		    $content = 'You can select a custom layout of "widgetized home page" content area.<br /> <br /> There are two ways to add contents in home page. On of them using widgets in "Widgetized Home Page Area" sidebar. The other one is using <a href="edit.php?post_type=home_page">Home Page Custom Posts</a>. ';
		    
		break;


		#
		#	show search
		#
		case THEMESLUG.'_show_search';
		    
		    $content = 'Show search form field on top of the sub pages.';
		    
		break;

		#
		#	randomized background images
		#
		case THEMESLUG.'_background_image_urls';
		    
		    $content = 'To activate the random background images enter image urls line by line. 
				
						<u>example</u><br />
						
									http://www.myblog.com/images/image_1.png<br />
                                             http://www.myblog.com/images/image_2.png<br />
                                             http://www.myblog.com/images/image_3.png<br />
                            ';
		    
		break;

		///////////////////////////// 		TYPOGHRAPHY 			/////////////////////////////
		
		#
		#	Body Font Family
		#
		case THEMESLUG.'_body_font_family';
		    
		    $content = 'You can change body font family by using this list. Please be aware of that if you have selected a google font for the body text, this fonts family will be replaced by google fonts automatically.';
		    
		break;
 

		///////////////////////////// 		PRODUCTS 			/////////////////////////////

		#
		#	Product single slug
		#
		case THEMESLUG.'_product_single_slug' || THEMESLUG.'_product_category_slug' || THEMESLUG.'_portfolio_category_slug' || THEMESLUG.'_portfolio_category_slug';
		    
		    $content = 'You can change permalink slugs for single product pages or product listing pages. Do not use numbers, space, etc. Use only small caps. <br /><br /> Make sure there are not any other content that has same slug. for example; if you have a page which has "portfolio" slug, do not use "portfolio" word as a slug for this permalinks.';
		    
		break;

	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php echo $tipName;?></title> 
</head>
<body class="page">
<?php echo $content;?>
</body>
</html>