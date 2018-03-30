<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Gallery Fullscreen
 * @package WordPress
 */

/**
*	Get all photos
**/ 

$menu_sets_query = '';

$portfolio_items = -1;

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if password protected
$portfolio_password = get_post_meta($current_page_id, 'portfolio_password', true);
if(!empty($portfolio_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		include (TEMPLATEPATH . "/templates/template-password.php");
		exit;
	}
}

$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => $portfolio_items, 
	'post_status' => null, 
	'post_parent' => $gallery_id,
	'order' => 'ASC',
	'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );

get_header(); ?>

<style type="text/css">
<!--
html,body{height:100%;}
*{outline:none;}
body{margin:0px; padding:0px; background:#000;}
#toolbar{position:fixed; z-index:3; right:10px; top:10px; padding:5px; background:url(<?php echo get_stylesheet_directory_uri(); ?>/js/fullscreen/fs_img_g_bg.png);}
#toolbar img{border:none;}
#img_title{position:fixed; z-index:3; right:10px; top:10px; padding:10px; background:url(<?php echo get_stylesheet_directory_uri(); ?>/js/fullscreen/fs_img_g_bg.png); color:#FFF; font-family: Arial, serif; font-size:24px; text-transform:uppercase; display:none;}
#bg{position:fixed; z-index:1; overflow:hidden; width:100%; height:100%;}
#bgimg{display:none; -ms-interpolation-mode: bicubic;}
#preloader{position:relative; z-index:3; width:32px; padding:20px; top:200px; margin:auto; background:#000;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
}
#thumbnails_wrapper{z-index:2; position:fixed; bottom:60px; width:100%;  /* stupid ie needs a background value to understand hover area */}
#outer_container{position:relative; padding:0; width:99%; margin: 0 0 7px 5px;}
#outer_container .thumbScroller{position:relative; overflow:hidden;}
#outer_container .thumbScroller, #outer_container .thumbScroller .container, #outer_container .thumbScroller .content{height:110px;}
#outer_container .thumbScroller .container{position:relative; left:0;}
#outer_container .thumbScroller .content{float:left;}
#outer_container .thumbScroller .content div{margin:0; height:100%;}
#outer_container .thumbScroller img{width: 100px; margin: 0 5px 0 0;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.7);
-moz-box-shadow: 0 1px 2px rgba(0,0,0,.7);
box-shadow: 0 1px 2px rgba(0,0,0,.7);
}
#outer_container .thumbScroller .content div a{display:block; padding:5px;}

#outer_container .thumbScroller .content div a:active{filter:alpha(opacity=.6); -moz-opacity:.6; -khtml-opacity:.6; opacity:.6;}

.nextImageBtn, .prevImageBtn{display:block; position:absolute; width:50px; height:50px; top:50%; margin:-25px 10px 0 10px; z-index:3; filter:alpha(opacity=0); -moz-opacity:0; -khtml-opacity:0; opacity:0; }
.nextImageBtn:hover,.prevImageBtn:hover{filter:alpha(opacity=0); -moz-opacity:0; -khtml-opacity:0; opacity:0;}
.nextImageBtn{right:20px; background:#000 url(<?php echo get_stylesheet_directory_uri(); ?>/js/fullscreen/nextImgBtn.png) center center no-repeat;}
.prevImageBtn{left: 50px; background:#000 url(<?php echo get_stylesheet_directory_uri(); ?>/js/fullscreen/prevImgBtn.png) center center no-repeat;}
-->
</style>

<?php
	$initial_image = $all_photo_arr[0]->guid;
?>
<div id="bg"><a href="#" class="nextImageBtn" title="next"></a><a href="#" class="prevImageBtn" title="previous"></a><img src="<?php echo $initial_image; ?>" alt="" title="" id="bgimg" /></div>
<div id="preloader"><img src="<?php echo get_stylesheet_directory_uri(); ?>/js/fullscreen/ajax-loader_dark.gif" width="32" height="32" /></div>
<div id="img_title"></div>
<div id="thumbnails_wrapper">
<div id="outer_container">
<div class="thumbScroller">
	<div class="container">
		<?php
			foreach($all_photo_arr as $key => $photo)
			{
			    $small_image_url = get_stylesheet_directory_uri().'/images/000_70.png';
			    $hyperlink_url = get_permalink($photo->ID);
			    
			    if(!empty($photo->guid))
			    {
			    	$image_url[0] = $photo->guid;
			    
			    	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'thumbnail');
			    }
		?>
    	<div class="content">
        	<div><a href="<?php echo $image_url[0]; ?>"><img src="<?php echo $small_image_url[0]; ?>" title="" alt="" class="thumb" /></a></div>
        </div>
        <?php
        	}
        ?>
	</div>
</div>
</div>
</div>
<script>
//config
//set default images view mode
$jdefaultViewMode="full"; //full, normal, original
$jtsMargin=30; //first and last thumbnail margin (for better cursor interaction) 
$jscrollEasing=600; //scroll easing amount (0 for no easing) 
$jscrollEasingType="easeOutCirc"; //scroll easing type 
$jthumbnailsContainerOpacity=0.8; //thumbnails area default opacity
$jthumbnailsContainerMouseOutOpacity=0; //thumbnails area opacity on mouse out
$jthumbnailsOpacity=1; //thumbnails default opacity
$jnextPrevBtnsInitState="show"; //next/previous image buttons initial state ("hide" or "show")
$jkeyboardNavigation="on"; //enable/disable keyboard navigation ("on" or "off")

//cache vars
$jthumbnails_wrapper=$j("#thumbnails_wrapper");
$jouter_container=$j("#outer_container");
$jthumbScroller=$j(".thumbScroller");
$jthumbScroller_container=$j(".thumbScroller .container");
$jthumbScroller_content=$j(".thumbScroller .content");
$jthumbScroller_thumb=$j(".thumbScroller .thumb");
$jpreloader=$j("#preloader");
$jtoolbar=$j("#toolbar");
$jtoolbar_a=$j("#toolbar a");
$jbgimg=$j("#bgimg");
$jimg_title=$j("#img_title");
$jnextImageBtn=$j(".nextImageBtn");
$jprevImageBtn=$j(".prevImageBtn");

$j(window).load(function() {
	$jtoolbar.data("imageViewMode",$jdefaultViewMode); //default view mode
	if($jdefaultViewMode=="full"){
		$jtoolbar_a.html("<img src='toolbar_n_icon.png' width='50' height='50'  />").attr("onClick", "ImageViewMode('normal');return false").attr("title", "Restore");
	} else {
		$jtoolbar_a.html("<img src='toolbar_fs_icon.png' width='50' height='50'  />").attr("onClick", "ImageViewMode('full');return false").attr("title", "Maximize");
	}
	ShowHideNextPrev($jnextPrevBtnsInitState);
	//thumbnail scroller
	$jthumbScroller_container.css("marginLeft",$jtsMargin+"px"); //add margin
	sliderLeft=$jthumbScroller_container.position().left;
	sliderWidth=$jouter_container.width();
	$jthumbScroller.css("width",sliderWidth);
	var totalContent=0;
	fadeSpeed=200;
	
	var $jthe_outer_container=document.getElementById("outer_container");
	var $jplacement=findPos($jthe_outer_container);
	
	$jthumbScroller_content.each(function () {
		var $jthis=$j(this);
		totalContent+=$jthis.innerWidth();
		$jthumbScroller_container.css("width",totalContent);
		$jthis.children().children().children(".thumb").fadeTo(fadeSpeed, $jthumbnailsOpacity);
	});

	$jthumbScroller.mousemove(function(e){
		if($jthumbScroller_container.width()>sliderWidth){
	  		var mouseCoords=(e.pageX - $jplacement[1]);
	  		var mousePercentX=mouseCoords/sliderWidth;
	  		var destX=-((((totalContent+($jtsMargin*2))-(sliderWidth))-sliderWidth)*(mousePercentX));
	  		var thePosA=mouseCoords-destX;
	  		var thePosB=destX-mouseCoords;
	  		if(mouseCoords>destX){
		  		$jthumbScroller_container.stop().animate({left: -thePosA}, $jscrollEasing,$jscrollEasingType); //with easing
	  		} else if(mouseCoords<destX){
		  		$jthumbScroller_container.stop().animate({left: thePosB}, $jscrollEasing,$jscrollEasingType); //with easing
	  		} else {
				$jthumbScroller_container.stop();  
	  		}
		}
	});

	$jthumbnails_wrapper.fadeTo(fadeSpeed, $jthumbnailsContainerOpacity);
	$j('body').hover(
		function(){ //mouse over
			var $jthis=$jthumbnails_wrapper;
			$jthis.stop().fadeTo("slow", 1);
			
			if(BrowserDetect.browser != 'Explorer')
 			{
				$j('#footer').stop().fadeTo("slow", 1);
			}
			/*$jnextImageBtn.fadeTo("slow", .4);
			$jprevImageBtn.fadeTo("slow", .4);*/
		},
		function(){ //mouse out
			var $jthis=$jthumbnails_wrapper;
			$jthis.stop().fadeTo("slow", $jthumbnailsContainerMouseOutOpacity);
			
			if(BrowserDetect.browser != 'Explorer')
 			{
				$j('#footer').stop().fadeTo("slow", 0);
			}
			/*$jnextImageBtn.fadeTo("slow", $jthumbnailsContainerMouseOutOpacity);
			$jprevImageBtn.fadeTo("slow", $jthumbnailsContainerMouseOutOpacity);*/
		}
	);
	

	$jthumbScroller_thumb.hover(
		function(){ //mouse over
			var $jthis=$j(this);
			$jthis.stop().fadeTo(fadeSpeed, 1);
		},
		function(){ //mouse out
			var $jthis=$j(this);
			$jthis.stop().fadeTo(fadeSpeed, $jthumbnailsOpacity);
		}
	);

	//on window resize scale image and reset thumbnail scroller
	$j(window).resize(function() {
		FullScreenBackground("#bgimg",$jbgimg.data("newImageW"),$jbgimg.data("newImageH"));
		$jthumbScroller_container.stop().animate({left: sliderLeft}, 400,"easeOutCirc"); 
		var newWidth=$jouter_container.width();
		$jthumbScroller.css("width",newWidth);
		sliderWidth=newWidth;
		$jplacement=findPos($jthe_outer_container);
	});

	//load 1st image
	var the1stImg = new Image();
	the1stImg.onload = CreateDelegate(the1stImg, theNewImg_onload);
	the1stImg.src = $jbgimg.attr("src");
	$jouter_container.data("nextImage",$j(".content").first().next().find("a").attr("href"));
	$jouter_container.data("prevImage",$j(".content").last().find("a").attr("href"));
});

function BackgroundLoad($jthis,imageWidth,imageHeight,imgSrc){
	$jthis.fadeOut("fast",function(){
		$jthis.attr("src", "").attr("src", imgSrc); //change image source
		FullScreenBackground($jthis,imageWidth,imageHeight); //scale background image
		$jpreloader.fadeOut("fast",function(){$jthis.fadeIn("slow");});
		/*var imageTitle=$jimg_title.data("imageTitle");
		if(imageTitle){
			$jthis.attr("alt", imageTitle).attr("title", imageTitle);
			$jimg_title.fadeOut("fast",function(){
				$jimg_title.html(imageTitle).fadeIn();
			});
		} else {
			$jimg_title.fadeOut("fast",function(){
				$jimg_title.html($jthis.attr("title")).fadeIn();
			});
		}*/
	});
}

//mouseover toolbar
if($jtoolbar.css("display")!="none"){
	$jtoolbar.fadeTo("fast", 0.4);
}
$jtoolbar.hover(
	function(){ //mouse over
		var $jthis=$j(this);
		$jthis.stop().fadeTo("fast", 1);
	},
	function(){ //mouse out
		var $jthis=$j(this);
		$jthis.stop().fadeTo("fast", 0.4);
	}
);

//Clicking on thumbnail changes the background image
$j("#outer_container a").click(function(event){ 
	event.preventDefault();
	var $jthis=$j(this);
	GetNextPrevImages($jthis);
	GetImageTitle($jthis);
	SwitchImage(this);
	ShowHideNextPrev("show");
}); 

//next/prev images buttons
$jnextImageBtn.click(function(event){
	event.preventDefault();
	SwitchImage($jouter_container.data("nextImage"));
	var $jthis=$j("#outer_container a[href='"+$jouter_container.data("nextImage")+"']");
	GetNextPrevImages($jthis);
	GetImageTitle($jthis);
});

$jprevImageBtn.click(function(event){
	event.preventDefault();
	SwitchImage($jouter_container.data("prevImage"));
	var $jthis=$j("#outer_container a[href='"+$jouter_container.data("prevImage")+"']");
	GetNextPrevImages($jthis);
	GetImageTitle($jthis);
});

//next/prev images keyboard arrows
if($jkeyboardNavigation=="on"){
$j(document).keydown(function(ev) {
    if(ev.keyCode == 39) { //right arrow
        SwitchImage($jouter_container.data("nextImage"));
		var $jthis=$j("#outer_container a[href='"+$jouter_container.data("nextImage")+"']");
		GetNextPrevImages($jthis);
		GetImageTitle($jthis);
        return false; // don't execute the default action (scrolling or whatever)
    } else if(ev.keyCode == 37) { //left arrow
        SwitchImage($jouter_container.data("prevImage"));
		var $jthis=$j("#outer_container a[href='"+$jouter_container.data("prevImage")+"']");
		GetNextPrevImages($jthis);
		GetImageTitle($jthis);
        return false; // don't execute the default action (scrolling or whatever)
    }
});
}

function ShowHideNextPrev(state){
	/*if(state=="hide"){
		$jnextImageBtn.fadeOut();
		$jprevImageBtn.fadeOut();
	} else {
		$jnextImageBtn.fadeIn();
		$jprevImageBtn.fadeIn();
	}*/
}

//get image title
function GetImageTitle(elem){
	var title_attr=elem.children("img").attr("title"); //get image title attribute
	$jimg_title.data("imageTitle", title_attr); //store image title
}

//get next/prev images
function GetNextPrevImages(curr){
	var nextImage=curr.parents(".content").next().find("a").attr("href");
	if(nextImage==null){ //if last image, next is first
		var nextImage=$j(".content").first().find("a").attr("href");
	}
	$jouter_container.data("nextImage",nextImage);
	var prevImage=curr.parents(".content").prev().find("a").attr("href");
	if(prevImage==null){ //if first image, previous is last
		var prevImage=$j(".content").last().find("a").attr("href");
	}
	$jouter_container.data("prevImage",prevImage);
}

//switch image
function SwitchImage(img){
	$jpreloader.fadeIn("fast"); //show preloader
	var theNewImg = new Image();
	theNewImg.onload = CreateDelegate(theNewImg, theNewImg_onload);
	theNewImg.src = img;
}

//get new image dimensions
function CreateDelegate(contextObject, delegateMethod){
	return function(){
		return delegateMethod.apply(contextObject, arguments);
	}
}

//new image on load
function theNewImg_onload(){
	$jbgimg.data("newImageW",this.width).data("newImageH",this.height);
	BackgroundLoad($jbgimg,this.width,this.height,this.src);
}

//Image scale function
function FullScreenBackground(theItem,imageWidth,imageHeight){
	var winWidth=$j(window).width();
	var winHeight=$j(window).height();
	if($jtoolbar.data("imageViewMode")!="original"){ //scale
		var picHeight = imageHeight / imageWidth;
		var picWidth = imageWidth / imageHeight;
		if ((winHeight / winWidth) < picHeight) {
		    $j(theItem).attr("width",winWidth);
		    $j(theItem).attr("height",picHeight*winWidth);
		} else {
		    $j(theItem).attr("height",winHeight);
		    $j(theItem).attr("width",picWidth*winHeight);
		};
		$j(theItem).css("margin-left",(winWidth-$j(theItem).width())/2);
		$j(theItem).css("margin-top",(winHeight-$j(theItem).height())/2);
	} else { //no scale
		$j(theItem).attr("width",imageWidth);
		$j(theItem).attr("height",imageHeight);
		$j(theItem).css("margin-left",(winWidth-imageWidth)/2);
		$j(theItem).css("margin-top",(winHeight-imageHeight)/2);
	}
}

//Image view mode function - fullscreen or normal size
function ImageViewMode(theMode){
	$jtoolbar.data("imageViewMode", theMode);
	FullScreenBackground($jbgimg,$jbgimg.data("newImageW"),$jbgimg.data("newImageH"));
	if(theMode=="full"){
		$jtoolbar_a.html("<img src='toolbar_n_icon.png' width='50' height='50'  />").attr("onClick", "ImageViewMode('normal');return false").attr("title", "Restore");
	} else {
		$jtoolbar_a.html("<img src='toolbar_fs_icon.png' width='50' height='50'  />").attr("onClick", "ImageViewMode('full');return false").attr("title", "Maximize");
	}
}

//function to find element Position
function findPos(obj) {
    var curleft = curtop = 0;
    if (obj.offsetParent) {
    	curleft = obj.offsetLeft
    	curtop = obj.offsetTop
    	while (obj = obj.offsetParent) {
    		curleft += obj.offsetLeft
    		curtop += obj.offsetTop
    	}
    }
    return [curtop, curleft];
}

</script>

<?php get_footer(); ?>