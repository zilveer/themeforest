<?php 
$prevID = 0;
if(isset($_GET['preview']))
	$prevID = (int)$_GET['preview'];

header ("Content-Type:text/css"); 
//Setup location of WordPress
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

//Access WordPress
require_once( $path_to_wp.'/wp-load.php' );

$contentFont = "'".opt('contentFont','')."', sans-serif";
$headerFont = "'".opt('headerFont','')."', sans-serif";

?>
/*
Theme Name: This Way
Theme URI: http://www.renklibeyaz.com/thisway/
Description: This Way Light
Author: RenkliBeyaz - Salih Ozovali
Version: 1.0
*/

/*Body Loading*/

#bodyLoading{
	width:100%;
	position:absolute;
	left:0;
	top:0;
	text-align:center;
}
#loading{
	margin:200px auto 0px auto;
	text-align:center;
}
#contentLoading{
	display:none;
	width:200px;
	top:300px;
	left:220px;
	position:absolute;
	text-align:center;
	background: url('images/content-bg-light.png');
	padding:20px;
}
#CtLoading{
	margin:0px auto 0px auto;
	text-align:center;
}
/* General */
* {
	margin:0px;
	padding:0px;
	border:none;
	outline:none;
	font-size:<?php eopt('contentFontSize','12');?>px;
	line-height:1.4em;
	color: #333;
	font-family: <?php echo $contentFont; ?>;
}
* html .clearfix {
	height: 1%; /* IE5-6 */
	}
*+html .clearfix {
	display: inline-block; /* IE7not8 */
	}
.clearfix:after { /* FF, IE8, O, S, etc. */
	content: ".";
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
	}
::selection {
        background: #000; /* Safari */
		color: #fff;  
        }
::-moz-selection {
        background: #000; /* Firefox */
		color: #fff;  
}
a{
	-moz-transition: all 0.3s ease-in-out 0s;
	transition: all 0.3s ease-in-out;
	-webkit-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
}
a:link, a:visited{
	text-decoration:underline;
	color: #000;
}
a:hover, a:active{
	text-decoration:none;
}

body{
	background: #fff;
	overflow:hidden;
}
html {
	overflow:hidden;
}
#body-wrapper{
	width:100%;
	background-color: #fff;
	text-align:center;
	overflow:hidden;
	position:relative;
	opacity:0;
}
#content{
	position:absolute;
	overflow:auto;
	width:825px;
	height:200px;
	left:0px;
	top:0px;
	z-index:-888;
}
#contentBox{
	position:relative;
	display:none;
	text-align:left;
	width:600px;
	padding:20px;
	margin-bottom:20px;
	background: url('images/content-bg-light.png');
}
#bgImages{
	<?php $thCont = opt('thController','block'); 
	if($thCont=='none')
		echo 'z-index:-100;';
	else
		echo 'z-index:899;';
	?>
	list-style:none;
	position:absolute;
	right:20px;
	top:0;
	background:url('images/menu-bg1-light.png'); 
}
#bgImages li{
	margin:0;
	padding:5px 10px;
}
#bgImages img.thumb{
	width:120px;
	margin:0;
	padding:0;
	border:3px solid #fff;
	cursor:pointer;
	opacity:.4;
}
#bgImages img.source, #bgImages iframe{
	display:none;
}
#bgImages h3, #bgImages p{
	display:none;
}
#bgImage{
	position:absolute;
	left:0;
	top:0;
}
#bgText{
	<?php $thCont = opt('thController','block'); 
	if($thCont=='none')
		echo 'z-index:-100;';
	?>
	text-align:right;
	position:absolute;
	right:180px;
	top:50px;
}
#bgText h3{
	font-size:80px;
	color:#fff;
	text-shadow: 1px 1px #333;
}
#bgText .subText{
	float:right;
	margin-top:-10px;
	width:400px;
	font-size:14px;
	color:#fff;
	text-shadow: 1px 1px #333;
}
#bgImageWrapper{
	position:relative;
}
#bgImageWrapper img{
	position:absolute;
}
#ytVideo, vmVideo{
	position:absolute;
}
#bgPattern{
	display: <?php eopt('bgPattern','block'); ?>;
	position:absolute;
	background: url('images/pattern.png');
}
#videoExpander{
	display: none;
	position:absolute;
	background: url('images/top_right_expand.png') no-repeat center center;
}

/*Image Animate*/
.image_frame{
	position:relative;
	cursor:pointer;
}
portfolioitems li iframe{
	margin:0;
	padding:0;
}
portfolioitems li .image_frame{
	padding:0;
	margin:0;
	font-size:0px;
}


.image_frame > a{
	overflow:hidden;
	display:block;
	padding:0;
	margin:0;
	font-size:0px;
}
.hoverWrapperBg{
	opacity:0;
	background-color:#6d457a;
	position:absolute;
	width:100%;
	height:100%;
	left:0px;
	top:0px;
}
.hoverWrapper{
	position:absolute;
	width:100%;
	height:100%;
	left:0;
	top:0;
}
.hoverWrapper .link,  
.hoverWrapper .modal,
.hoverWrapper .modalVideo{
	-moz-transition: all 0.5s ease-in-out 0s;
	transition: all 0.5s ease-in-out;
	-webkit-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	
	display:block;
	width:26px;
	height:26px;
	border-radius:13px;
	position:absolute;
	opacity:0;
}
.hoverWrapper .link{
	top:50%;
	left:50%;
	margin-left:30px;
	margin-top:-13px;
}
.hoverWrapper .modal,
.hoverWrapper .modalVideo{
	top:50%;
	left:50%;
	margin-left:-56px;
	margin-top:-13px;
}
.hoverWrapper .link{background: url('images/imageLink-light.jpg');}
.hoverWrapper .link:hover, .hoverWrapper .link:active{background-position:-104px 0;}
.hoverWrapper .modal{background: url('images/imageModal-light.jpg') -104px 0;}
.hoverWrapper .modal:hover, .hoverWrapper .modal:active{background-position:0 0;}
.hoverWrapper .modalVideo{background: url('images/imageVideo-light.jpg') -104px 0;}
.hoverWrapper .modalVideo:hover, .hoverWrapper .modalVideo:active{background-position:0 0;}





.blogdate{
	position:absolute;
	left:10px;
	top:10px;
	width:66px;
	height:66px;
	border-radius:33px;
	background-color:#6d457a;
	color:#000;
}

.hoverWrapper h3{
	opacity:0;
	text-align:center;
	padding:17px 15px 0 15px;
	font-size:18px;
	line-height:20px;
	
	color:#fff;
	font-family: <?php echo $headerFont; ?>;
}
.hoverWrapper .enter-text{
	opacity:0;
	text-align:center;
	padding:17px 15px 10px 15px;
	font-size:11px;
	color:#fff;
}
.hoverWrapper .enter-text p{
	font-size:11px;
	color:#fff;
}

/*Twitter*/
#twt{
	display: <?php eopt('twitter','block'); ?>;
	position:absolute;
	left:20px;
	top:20px;
}
.twButton{
	-moz-transition: none;
	transition: none;
	-webkit-transition: none;
	-o-transition: none;
	
	-moz-transition: background 0.5s ease-in-out 0s;
	transition: background 0.5s ease-in-out;
	-webkit-transition: background 0.5s ease-in-out;
	-o-transition: background 0.5s ease-in-out;
	cursor:pointer;
	display:block;
	width:26px;
	height:26px;
}
.twButton:link, .twButton:visited{
	border-radius:13px;
	background:url('images/twitter-icon-light.jpg') 0 0 no-repeat;
}
.twButton:hover, 
.twButton:active,
.twActive:link,
.twActive:visited{
	background-position:-104px 0;
	border-radius:13px 13px 0 0;
	border-bottom:5px solid #fff;
}
#twt .twContent{
	display:none;
	opacity:0;
	text-align:left;
	width:130px;
	padding:15px;
	background-color:#fff;
	border-radius:0 13px 13px 13px;
}
#twt ul{list-style:none; position:relative; height:130px; overflow:hidden;}
#twt ul li{padding-top:5px; color:#999; font-size:11px; position:absolute;}
#twt ul{list-style:none;}
#twt ul li span{
	display:block;
}

#twt h3{
	font-size:18px;
	line-height:18px;
	
	font-family: <?php echo $headerFont; ?>;
	padding-bottom:5px;
	border-bottom:1px solid #999;
	color:#999;
}


a.closebutton:link,
a.closebutton:visited{
	-moz-transition: all 0.5s ease-in-out 0s;
	transition: all 0.5s ease-in-out;
	-webkit-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	background: url('images/closebtn.jpg') 0 0 no-repeat;
	display:block;
	float:right;
	width:22px;
	height:22px;
	margin-top:4px;
	border-radius:50%;
}
a.closebutton:hover,
a.closebutton:active{
	background-position:0 -88px;
}


/*Audio*/
#audioList{display:none;}
#audioControls{
	display: <?php eopt('audioController','block'); ?>;
	position:absolute;
	top:20px;
	left:46px;
}
#audioControls .btn{
	-moz-transition: all 0.5s ease-in-out 0s;
	transition: all 0.5s ease-in-out;
	-webkit-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	display:block;
	float:left;
	width: 26px;
	height:26px;
	border-radius:13px;
	margin-left:5px;
	background-color:#000;
}
#audioControls .play, #audioControls .pause{
	display:none;
}
#audioControls .next:link, #audioControls .next:visited{ background: url('images/audioControlRight-light.jpg') -104px 0 no-repeat;}
#audioControls .next:hover, #audioControls .next:active{ background: url('images/audioControlRight-light.jpg') 0 0 no-repeat;}
#audioControls .prev:link, #audioControls .prev:visited{ background: url('images/audioControlLeft-light.jpg') 0 0 no-repeat;}
#audioControls .prev:hover, #audioControls .prev:active{ background: url('images/audioControlLeft-light.jpg') -104px 0 no-repeat;}
#audioControls .pause:link, #audioControls .pause:visited{ background: url('images/audioControlPause-light.jpg') 0 -104px no-repeat;}
#audioControls .pause:hover, #audioControls .pause:active{ background: url('images/audioControlPause-light.jpg') 0 0 no-repeat;}
#audioControls .play:link, #audioControls .play:visited{ background: url('images/audioControlPlay-light.jpg') 0 0 no-repeat;}
#audioControls .play:hover, #audioControls .play:active{ background: url('images/audioControlPlay-light.jpg') 0 -104px no-repeat;}

/*Menu*/
#menu-container{
	position:absolute;
	padding-right:20px;
	left:0;
	top:200px;
	height:75px;
	background:url('images/menu-bg1-light.png'); 
	border-radius:0 20px 20px 0;
	z-index:922;
}
#menuOpener{
	position:absolute;
	left:100%;
	height:60px;
	line-height:60px;
	padding:0px 40px 0 20px;
	cursor:pointer;
	font-size:<?php eopt('menuFontSize','14');?>px;
	font-family: <?php echo $headerFont; ?>;
	background:#6d457a url('images/opener-arrow-light.png') 60px center no-repeat;
	border-radius:0 20px 20px 0;
	color:#fff;
}
#menuCloser{
	display:none;
	position:absolute;
	left:100%;
	float:right;
	height:75px;
	line-height:75px;
	padding:0px 40px 0 20px;
	cursor:pointer;
	font-size:<?php eopt('menuFontSize','14');?>px;
	font-family: <?php echo $headerFont; ?>;
	background:#6d457a;
	border-radius:0 20px 20px 0;
	color:#fff;
}
#mainmenu{
	float:left;
	margin-left:20px;
}
#mainmenu ul{
	list-style:none;
}
#mainmenu  ul > li{
	float:left;
	position:relative;
}
#mainmenu ul li a:link,
#mainmenu ul li a:visited{
	padding:0 10px;
	display:block;
	line-height:75px;
	height:75px;
	text-decoration:none;
	overflow:hidden;

	-moz-transition: all 0.5s ease-in-out 0s;
	transition: all 0.5s ease-in-out;
	-webkit-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
}
#mainmenu ul li a:hover,
#mainmenu ul li a:active{
	background-position:0 -280px;
}
#mainmenu ul > li.active > a:link,
#mainmenu ul > li.active > a:visited{
	background-position:0 -280px;
}
#mainmenu ul li a span.title{
	position:relative;
	color:#000;
	display:block;
	line-height:75px;
	height:75px;
	top:75px;
	font-size:<?php eopt('menuFontSize','14');?>px;
	font-family: <?php echo $headerFont; ?>;
}
#mainmenu ul > li > a{
	background: url('images/menuhover-bg-light.png') left top repeat-x; 
}
#mainmenu ul li ul li a:link,
#mainmenu ul li ul li a:visited{
	background: url('images/menuhover-bg2-light.png') left top repeat-x; 
	line-height:50px;
	height:50px;
}
#mainmenu ul li ul li a:hover,
#mainmenu ul li ul li a:active{
	background-position:0 -280px;
}
#mainmenu ul li ul li a span.title{
	height:50px;
	line-height:50px;
	color:#fff;
}
#mainmenu ul li a:hover span.title,
#mainmenu ul li a:active span.title,
#mainmenu ul > li.active > a:link span.title,
#mainmenu ul > li.active > a:visited span.title{
	-moz-transition:none;
	transition: none;
	-webkit-transition: none;
	-o-transition: none;
	color:#fff;
}
#mainmenu ul li ul li a:hover span.title,
#mainmenu ul li ul li a:active span.title{
	color:#000;
	line-height:50px;
	height:50px;
}
#mainmenu ul .description{
	display:none;
}
#mainmenu ul ul{
	position:absolute;
	background: url('images/menu-bg2-light.png'); 
	padding:0 15px;
	opacity:0;
	border-radius:20px;
	height:50px;
	width:100%;
}
#mainmenu ul ul li{
	position:static;
	float:left;
}

/* Footer */
#footer{
	position:absolute;
	left:0;
	bottom:0;
	width:100%;
	background: url('images/menu-bg1-light.png'); 
	height:46px;
	z-index:911;
}
#footertext{
	float:left;
	margin:11px 10px; 
	padding:0 10px;
	border-left:3px solid #999;
	height:24px;
	line-height:24px;
}
#bgControl{
	display: <?php eopt('bgController','block'); ?>;
	float:right;
	margin: 10px 44px 10px 24px;
}

#bgControl .prev, 
#bgControl .next,
#bgControl .play,
#bgControl .pause{
	-moz-transition: all 0.5s ease-in-out 0s;
	transition: all 0.5s ease-in-out;
	-webkit-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	display:block;
	float:left;
	width:26px;
	height:26px;
	background-color: #fff;
	border-radius:13px;
}
#bgControl .play,
#bgControl .pause{
	margin:0 10px;
}
#bgControl .play{display:none;}
#bgControl .next:link, #bgControl .next:visited{ background: url('images/bgControlRight-light.jpg') -104px 0 no-repeat;}
#bgControl .next:hover, #bgControl .next:active{ background: url('images/bgControlRight-light.jpg') 0 0 no-repeat;}
#bgControl .prev:link, #bgControl .prev:visited{ background: url('images/bgControlLeft-light.jpg') 0 0 no-repeat;}
#bgControl .prev:hover, #bgControl .prev:active{ background: url('images/bgControlLeft-light.jpg') -104px 0 no-repeat;}
#bgControl .pause:link, #bgControl .pause:visited{ background: url('images/bgControlPause-light.jpg') 0 -104px no-repeat;}
#bgControl .pause:hover, #bgControl .pause:active{ background: url('images/bgControlPause-light.jpg') 0 0 no-repeat;}
#bgControl .play:link, #bgControl .play:visited{ background: url('images/bgControlPlay-light.jpg') 0 0 no-repeat;}
#bgControl .play:hover, #bgControl .play:active{ background: url('images/bgControlPlay-light.jpg') 0 -104px no-repeat;}
#share{
	display: <?php eopt('shareIcons','block'); ?>;
	float:right;
	margin: 11px 0;
	padding-right:10px;
	border-right:1px solid #999;
}
#share  ul{list-style:none;}
#share li{float:left; margin-left:10px;}
#share a:link, #share a:visited{display:block; width:24px; height:24px; opacity:1;}
#share a:hover, #share a:active{opacity:.5;}
#share .fb{background: url('images/social/fb.png') no-repeat;}
#share .tw{background: url('images/social/tw.png') no-repeat;}
#share .deli{background: url('images/social/deli.png') no-repeat;}
#share .in{background: url('images/social/in.png') no-repeat;}
#share .st{background: url('images/social/st.png') no-repeat;}
#share .rss{background: url('images/social/rss.png') no-repeat;}

#logo{
	text-align:center;
	vertical-align:middle;
	float:left;
	position:relative;
}

/*BLOG*/
.blogitem{margin-top:14px;}
#content h1.caption{
	background: url('images/header-arrow.png') 15px 17px no-repeat, url('images/header-pattern-light.png');
	padding:9px 15px 9px 40px;
	font-family: <?php echo $headerFont; ?>;
	font-size:20px;
	line-height:30px;
	color: #333;
}
.blogimage{
	float:left;
}
.blogdateLeft{
	font-size:12px;
	padding-right:3px;
	margin-top:15px;
	float:left;
	border-right:1px solid #fff;
	width:30px;
	color:#fff;
	text-align:right;
}
.blogdateRight{
	font-size:12px;
	padding-left:3px;
	margin-top:15px;
	float:left;
	width:29px;
	text-align:left;
	color:#fff;
}
.blogcontent{
	width:230px;
	float:left;
	margin-left:20px;
}
.blogcontent h3{
	color:#6d457a;
	font-family: <?php echo $headerFont; ?>;
	font-size:14px;
	
	line-height:1.4em;
	margin-bottom:20px;
}
.blogTop{clear:both;}
.blogTop hr{
	float:left;
	width:570px;
	margin-top:8px;
	height:3px;
	background-color:#999;
}
.blogTop a:link,
.blogTop a:visited{
	display:block;
	float:right;
	color:#999;
	font-family: <?php echo $headerFont; ?>;
	font-size:12px;
	
	text-decoration:none;
}
.blogTop a:hover,
.blogTop a:active{
	color:#6d457a;
}
.blogcontent p{
	color:#333;
	font-size:11px;
	width:184px;
	float:left;
}
.meta-links{
	float:right;
	width:26px;
}
.meta-author, .meta-comments, .meta-tags{
	-moz-transition: all 0.5s ease-in-out 0s;
	transition: all 0.5s ease-in-out;
	-webkit-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	display:block;
	background-color:#6d457a;
	width:26px;
	height:26px;
	border-radius:13px;
	margin-bottom:10px;
}
.meta-author:link, .meta-author:visited{ background:url('images/blogicon-author-light.jpg') 0 0 no-repeat;}
.meta-author:hover, .meta-author:active{ background-position: -104px 0;}
.meta-comments:link, .meta-comments:visited{ background:url('images/blogicon-comment-light.jpg') 0 0 no-repeat;}
.meta-comments:hover, .meta-comments:active{ background-position: -104px 0;}
.meta-tags:link, .meta-tags:visited{ background:url('images/blogicon-tag-light.jpg') 0 0 no-repeat;}
.meta-tags:hover, .meta-tags:active{ background-position: -104px 0;}
.morelink:link,
.morelink:visited{
	display:inline-block;
	font-size:11px;
	line-height:22px;
	background-color:#6d457a;
	color:#fff;
	border-radius:4px;
	padding:0 11px;
	text-decoration:none;
	margin-top:20px;
}
.morelink:hover,
.morelink:active{
	background-color:#fff;
	color:#6d457a;
}
.meta-tips{
	position:absolute;
	color:#fff;
	padding:0px 10px;
	height:20px;
	line-height:20px;
	background-color:#6d457a;
}
.meta-tips span{
	width:6px;
	height:20px;
	background:url('images/meta-right-light.png') left center no-repeat;
	position:absolute;
	right:-6px;
}

/*About*/
.personName{display:inline-block; float:left; padding-top:14px;}
.personName h3{font-size:12px; line-height:16px;}
.personName span{font-size:11px; line-height:11px;}
.personContact{ display:inline-block; float:right; padding-top:24px;}
.personContact a:link, .personContact a:visited{width:16px; height:16px; opacity:.5; display:block; float:left; margin-left:2px;}
.personContact a:hover, .personContact a:active{opacity:1;}
.personFacebook{background:url('images/person-facebook.png');}
.personTwitter{background:url('images/person-twitter.png');}
.personEmail{background:url('images/person-email.png');}
/*Portfolio*/
.portfolioitems{
	list-style:none;
	width:620px;
	overflow:hidden;
}
.portfolio2columns li{
	float:left;
	margin: 20px 20px 0 0;
}
.portfolio4columns li{
	float:left;
	margin: 20px 20px 0 0;
}
.portfolioFilter{
	width:600px;
	list-style:none;
	margin:20px 0 0 0;
	height:30px;
	padding-bottom:20px;
	border-bottom:3px solid #999;
}
.portfolioFilter li{ float:left; margin-right:10px;}
.portfolioFilter li a:link,
.portfolioFilter li a:visited{
	display:block;
	background-color:#6d457a; 
	text-decoration:none;
	color:#fff;
	border-radius:4px;
	font-family: <?php echo $headerFont; ?>;
	font-size:12px;
	line-height:30px;
	padding:0 15px;
}
.portfolioFilter li a:hover,
.portfolioFilter li a:active{
	background-color:#fff; 
	color:#6d457a;
}
/*Columns*/
.c1,
.c1of2, .c1of2_end, 
.c1of3, .c1of3_end, .c2of3, .c2of3_end,
.c1of4, .c1of4_end, .c2of4, .c2of4_end, .c3of4,
.c3of4_end{float:left; margin-top:20px;}

.c1{clear:both; float:left; width:600px;}
.c1of2{float:left; width:280px; margin-right:40px;}
.c1of2_end{float:left; width:280px;}
.c1of3{float:left; width:173px; margin-right:40px;}
.c1of3_end{float:left; width:173px;}
.c2of3{float:left; width:386px; margin-right:40px;}
.c2of3_end{float:left; width:386px;}
.c1of4{float:left; width:120px; margin-right:40px;}
.c1of4_end{float:left; width:120px;}
.c2of4{float:left; width:280px; margin-right:40px;}
.c2of4_end{float:left; width:280px;}
.c3of4{float:left; width:440px; margin-right:40px;}
.c3of4_end{float:left; width:440px;}

/*STYLES*/
h1, h2, h3, h4, h5, h6{
	clear:both;
	font-family: <?php echo $headerFont; ?>;
	font-weight:normal;
	color: #6d457a;
}
h1{font-size:<?php eopt('h1FontSize','24');?>px;}
h2{font-size:<?php eopt('h2FontSize','20');?>px;}
h3{font-size:<?php eopt('h3FontSize','18');?>px;}
h4{font-size:<?php eopt('h4FontSize','16');?>px;}
h5{font-size:<?php eopt('h5FontSize','14');?>px;}
h6{font-size:<?php eopt('h6FontSize','12');?>px;}
.divider{clear:both; height:20px;}
.vericaldivider{display:inline-block; width:20px; }
hr.seperator{clear:both; float:left; margin-top:20px; height:3px; background-color:#999; width:100%; }
.quotes-one{
	margin-left:20px;
	border-left:3px solid #6d457a;
	padding-left:20px;
}
.quotes-two{
	padding-left:35px;
	background: url('images/quote-bg.png') top left no-repeat;
}
.dropcap{
	display:block;
	float:left;
	font-size:50px;
	line-height:50px;
	font-family: <?php echo $headerFont; ?>;
	padding:0;
	margin:0 5px 0 0;
}
.quotes-writer{color:#000;}
.right{float:right; margin:5px 0 5px 15px;}
.left{float:left; margin:5px 15px 5px 0px;}
span.highlight{background-color:#6d457a; color:#fff; padding:0px 2px;}
ul.list{list-style:none;}
ul.list li{padding: 3px 0 3px 20px;}
ul.check li{ background:url('images/list-check.png') left 6px no-repeat;}
ul.cross li{ background:url('images/list-cross.png') left 6px no-repeat;}
ul.arrow li{ background:url('images/list-arrow.png') left 6px no-repeat;}
ul.circle li{ background:url('images/list-circle.png') left 7px no-repeat;}

.infobox, .attentionbox, .downloadbox, .crossbox{
	padding:20px 20px 20px 75px;
	border:2px solid #333;
}
.infobox{
	border-color:#0066cc;
	color:#0066cc;
	background: url('images/box-info.png') 20px 24px no-repeat;
}
.attentionbox{
	border-color:#ddb720;
	color:#ddb720;
	background: url('images/box-attention.png') 20px 24px no-repeat;
}
.downloadbox{
	border-color:#009900;
	color:#009900;
	background: url('images/box-download.png') 20px 24px no-repeat;
}
.crossbox{
	border-color:#ff0000;
	color:#ff0000;
	background: url('images/box-cross.png') 20px 24px no-repeat;
}
.tipbox{
	position:absolute;
	color:#fff;
	padding:10px 10px;
	background-color:#6d457a;
	border-radius:6px;
}
.tipbox span{
	width:9px;
	height:5px;
	background:url('images/tips-bottom-light.png') center center no-repeat;
	position:absolute;
	bottom:-5px;
	left:50%;
}

div.item_two_one{
	clear:both;
	float:left;
	width:80px;
	padding:12px 5px 12px 0;
	vertical-align:top;
	font-family: <?php echo $headerFont; ?>;
	font-size:16px;
}
div.item_two_two{
	float:left;
	width:170px;
	margin-left:10px;
	padding:15px 5px;
	border-bottom: 1px solid #999;
	vertical-align:top;
}

/*Buttons*/
.buttonSmall{
	display:inline-block;
	background: url('images/button-white-left.png') left top no-repeat;
	height:26px;
	padding-left:5px;
}
.buttonSmall a{
	background: url('images/button-white-center.png') left top repeat-x;
	float:left;
	font-size:12px;
	line-height:26px;
	padding:0 10px;
	text-decoration:none;
	font-family: <?php echo $headerFont; ?>;
	
	color:#ffffff;
}
.buttonSmall span{
	float:left;
	background: url('images/button-white-right.png') left top no-repeat;
	height:26px;
	width:5px;
}

.smallBlack{background-image: url('images/button-black-left.png'); }
.smallBlack a{background-image: url('images/button-black-center.png'); }
.smallBlack span{background-image: url('images/button-black-right.png'); }

.smallWhite{background-image: url('images/button-white-left.png'); }
.smallWhite a{background-image: url('images/button-white-center.png'); color:#333333;}
.smallWhite span{background-image: url('images/button-white-right.png'); }

.smallRed{background-image: url('images/button-red-left.png'); }
.smallRed a{background-image: url('images/button-red-center.png'); }
.smallRed span{background-image: url('images/button-red-right.png'); }

.smallGreen{background-image: url('images/button-green-left.png'); }
.smallGreen a{background-image: url('images/button-green-center.png'); }
.smallGreen span{background-image: url('images/button-green-right.png'); }

.smallBlue{background-image: url('images/button-blue-left.png'); }
.smallBlue a{background-image: url('images/button-blue-center.png'); }
.smallBlue span{background-image: url('images/button-blue-right.png'); }

.buttonMedium{
	display:inline-block;
	background: url('images/buttonM-white-left.png') left top no-repeat;
	height:36px;
	padding-left:5px;
}
.buttonMedium a{
	background: url('images/buttonM-white-center.png') left top repeat-x;
	float:left;
	font-size:16px;
	line-height:36px;
	padding:0 10px;
	text-decoration:none;
	font-family: <?php echo $headerFont; ?>;
	
	color:#ffffff;
}
.buttonMedium span{
	float:left;
	background: url('images/buttonM-white-right.png') left top no-repeat;
	height:36px;
	width:5px;
}

.mediumBlack{background-image: url('images/buttonM-black-left.png'); }
.mediumBlack a{background-image: url('images/buttonM-black-center.png'); }
.mediumBlack span{background-image: url('images/buttonM-black-right.png'); }

.mediumWhite{background-image: url('images/buttonM-white-left.png'); }
.mediumWhite a{background-image: url('images/buttonM-white-center.png'); color:#333333;}
.mediumWhite span{background-image: url('images/buttonM-white-right.png'); }

.mediumRed{background-image: url('images/buttonM-red-left.png'); }
.mediumRed a{background-image: url('images/buttonM-red-center.png'); }
.mediumRed span{background-image: url('images/buttonM-red-right.png'); }

.mediumGreen{background-image: url('images/buttonM-green-left.png'); }
.mediumGreen a{background-image: url('images/buttonM-green-center.png'); }
.mediumGreen span{background-image: url('images/buttonM-green-right.png'); }

.mediumBlue{background-image: url('images/buttonM-blue-left.png'); }
.mediumBlue a{background-image: url('images/buttonM-blue-center.png'); }
.mediumBlue span{background-image: url('images/buttonM-blue-right.png'); }

/*CONTACT FORM*/
.dform p{
	display:block;
	clear:both;
	padding:5px 5px 5px 0;
}

.dFormInput{
	float:left;
	width:157px;
	padding:5px;
	margin-left:10px;
	border-top: 1px double #bbb;
	border-left: 1px double #bbb;
	border-right: 1px double #f0f0f0;
	border-bottom: 1px double #f0f0f0;
	background-color:none;
}
.dFormInputFocus{
	border:1px solid #6d457a;
}
.dform label{
	padding-top:0px;
	float:left;
	display:inline-block;
	width:95px;
	text-decoration:none;
	font-family: <?php echo $headerFont; ?>;
	font-size:16px;
}
.dform input[type=text], .dform select, .dform textarea{
	background:none;
	width:100%;
}
.dform input[type=text]:focus, .dform select:focus, .dform textarea:focus{
}
.dform select{
}
.dform input[type=submit]{
	margin-left:10px;
}
.dform textarea{
	height:113px;
}
.dform label.error{
	clear:both;
	float:left;
	margin-left:95px;
	padding-left:10px;
	width:172px;
	color:#6d457a;
	font-weight:normal;
	font-size:11px;
}
.form_message{
	display:none;
	padding:5px;
	background-color:#6d457a;
	color:#000;
}
div.form_input{
	float:left;
}
.dform .submitButton{
	display:block;
	margin:10px 0 0 10px;
	border-radius:6px;
	color:#fff;
	background-color:#6d457a;
	line-height:14px;
	padding:10px 20px;
	text-decoration:none;
	font-family: <?php echo $headerFont; ?>;
	font-size:12px;
}
.dform .submitButton:hover{
	color:#6d457a;
	background-color:#fff;
}

/* Single Page **/
#singleLeft{
	float:left;
	width:163px;
	padding-right:20px;
	border-right:3px solid #999;
}
#singleRight{
	float:left;
	margin-left:20px;
	width:394px;
}
#singleLeft ul{
	list-style:none;
}
#singleLeft ul li{
	padding-top:3px;
	height:21px;
	padding-left:33px;
	margin-bottom:10px;
}
#singleLeft .singleDate{ background:url('images/singleDate-light.png') left top no-repeat; }
#singleLeft .singleAuthor{ background:url('images/singleAuthor-light.png') left top no-repeat; }
#singleLeft .singleComments{ background:url('images/singleComments-light.png') left top no-repeat; }
#singleLeft .singleTags{ background:url('images/singleTags-light.png') left top no-repeat; }

/* Comments CSS*/
#comments h4{
	padding-bottom:20px;
}
.comment-wrapper{
	background-color:#fff;
	margin-bottom:20px;
}

#comments ul, #comments ol{
	list-style:none;
}

#comments ol li li{
	padding-left:100px;
	background: url('images/comment-icon-light.png') 34px 34px no-repeat;
}

.comment-avatar{
	float:left;
	width:80px;
	height:80px;
	margin:10px;
}
.comment-text{
	padding-left:100px;
	padding-right:10px;
}
.comment-author{
	float:left;
	padding-top:10px;
	border-bottom:1px solid #828282;
	padding-bottom:10px;
}
#comments li .comment-author{width:430px;}
#comments li li .comment-author{width:330px;}
#comments li li li .comment-author{width:230px;}
.author-link{
	font-size:12px;
	color: #6d457a;
}
.author-date{
	font-sieze:12px;
	font-weight:italic;
}
.author-time{
	font-size:12px;
}
.comment-text p{
	float:left;
	padding: 5px 10px 10px 0;
}
.form-allowed-tags{
	display:none;
}
#comments .comment-reply-link{
	display:inline-block;
	float:left;
	margin-left:10px;
	margin-top:10px;
}
#comments .comment-reply-link:link,
#comments .comment-reply-link:visited{
	display:inline-block;
	float:right;
	font-size:11px;
	line-height:25px;
	height:25px;
	padding:1px 11px 0px 11px;
	text-transform:uppercase;
	background-color: #6d457a;
	color: #fff;
	border-radius:6px;
	font-family: <?php echo $headerFont; ?>;
	text-decoration:none;
}
@-moz-document url-prefix() {
	#comments .comment-reply-link a:link,
	#comments .comment-reply-link a:visited{
		padding:0px 11px 1px 11px;
  }
}
#comments .comment-reply-link:link,
#comments .comment-reply-link:visited{
	margin-right:0px;
	margin-bottom:10px;
}
#comments ol ul .comment-reply-link:link,
#comments ol ul .comment-reply-link:visited{
	margin-right:0px;
}
#comments .comment-reply-link:hover,
#comments .comment-reply-link:active{
	text-decoration:none;
	background-color: #fff;
	color: #6d457a;
}

/*Comment Form*/
#commentform{
}
.comment-notes, .logged-in-as{
	padding: 0 0 0 0; 
}
#commentform label{
	display:inline-block;
	width: 132px;
	font-size:14px;
	height:32px;
	vertical-align:top;
	font-family: <?php echo $headerFont; ?>;
	font-size:16px;
} 
#commentform .required{
	display:inline-block;
	width:15px;
	height:22px;
	color: #6d457a;
	vertical-align:top;
}
#commentform .comment-form-author label, 
#commentform .comment-form-email label{
	width:115px;
}
#commentform input[type=text], 
#commentform textarea{
	width: 250px;
	height: 22px;
	border-top: 1px double #bbb;
	border-left: 1px double #bbb;
	border-right: 1px double #f0f0f0;
	border-bottom: 1px double #f0f0f0;
	background-color:transparent;
	padding:5px;
}
#commentform input[type=text]:focus, 
#commentform textarea:focus{
	border:1px solid #6d457a;
}
#commentform textarea{
	height:140px;
}
#commentform p{
	margin-top:20px;
	vertical-align:top;
}
#commentform input[type=submit]{
	cursor:pointer;
	margin-left:132px;
	display:inline-block;
	font-size:12px;
	line-height:35px;
	height:35px;
	padding:1px 11px 0px 11px;
	text-transform:uppercase;
	background-color: #6d457a;
	color: #fff;
	border-radius:6px;
	font-family: <?php echo $headerFont; ?>;
}
#commentform input[type=submit]:hover{
	color: #fff;
	background-color: #6d457a;
}
@-moz-document url-prefix() {
	#commentform input[type=submit]{
		padding:0px 11px 1px 11px;
  }
}
pre{
	 white-space: pre-wrap;       /* css-3 */
	white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
	white-space: -pre-wrap;      /* Opera 4-6 */
	white-space: -o-pre-wrap;    /* Opera 7 */
	overflow: auto;
	font-family: 'Consolas',monospace;
	font-size:13px;
	color: #333;
	line-height:18px;
	background: url("images/pre-bg.png") repeat scroll left top #FFFFFF;
	border-left: 4px solid #888;
	padding:18px 5px 18px 10px;
	margin: 10px 0 10px 0;
}
div.sh_toggle{
	clear:both;
}
div.sh_toggle_text a{
	color:#000000;
	font-size: 10pt;
	
	text-decoration: none;
}
.sh_toggle_text{
	padding: 4px 4px 4px 20px;
	background:url('images/toggle_arrow_closed.png') 0px 6px no-repeat;
	cursor:pointer;
}
.sh_toggle_text_opened{
	background:url('images/toggle_arrow_opened.png') 0px 6px no-repeat;	
	cursor:pointer;
}
.sh_toggle_content{
	display:none;
}
.wp-pagenavi {
	margin-top:20px;
}
.wp-pagenavi .pages{
	background-color:#999;
	color:#fff;
	border-radius:4px;
	padding:4px 8px;
	font-size:12px;
}

.wp-pagenavi .current{
	margin-left:5px;
	background-color:#6D457A;
	color:#fff;
	border-radius:4px;
	padding:4px 8px;
	font-size:12px;
}

.wp-pagenavi .page:link, 
.wp-pagenavi .page:visited, 
.wp-pagenavi .nextpostslink:link, 
.wp-pagenavi .nextpostslink:visited, 
.wp-pagenavi .previouspostslink:link,
.wp-pagenavi .previouspostslink:visited{
	margin-left:5px;
	background-color:#999;
	color:#fff;
	border-radius:4px;
	padding:4px 8px;
	font-size:12px;
	text-decoration:none;
}

.wp-pagenavi .page:hover, 
.wp-pagenavi .page:active, 
.wp-pagenavi .nextpostslink:hover, 
.wp-pagenavi .nextpostslink:active, 
.wp-pagenavi .previouspostslink:hover,
.wp-pagenavi .previouspostslink:active{
	background-color:#6D457A;
	color:#fff;
}