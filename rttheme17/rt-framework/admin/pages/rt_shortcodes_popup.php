<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 

<title>
<?php
# LAYOUTS
if($_GET['section']=='layouts'){
	echo 'RT-THEME LAYOUTS';
}elseif($_GET['section']=='shortcodes'){
	echo 'RT-THEME SHORTCODES';
}elseif($_GET['section']=='buttons'){
	echo 'RT-THEME BUTTONS';	
}else{
	echo 'RT-THEME QUICK STYLING';
}
?>
</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>  
<script type="text/javascript" src="../js/tiny_mce_popup.js?ver=3223"></script>
 
<style type="text/css">

	#wphead {
		font-size: 80%;
		border-top: 0;
		color: #555;
		background-color: #f1f1f1;
	}
	#wphead h1 {
		font-size: 24px;
		color: #555;
		margin: 0;
		padding: 10px;
	}
	#tabs {
		padding: 15px 15px 3px;
		background-color: #f1f1f1;
		border-bottom: 1px solid #dfdfdf;
	}
	#tabs li {
		display: inline;
	}
	#tabs a.current {
		background-color: #fff;
		border-color: #dfdfdf;
		border-bottom-color: #fff;
		color: #d54e21;
	}
	#tabs a {
		color: #2583AD;
		padding: 6px;
		border-width: 1px 1px 0;
		border-style: solid solid none;
		border-color: #f1f1f1;
		text-decoration: none;
	}
	#tabs a:hover {
		color: #d54e21;
	}
	.wrap h2 {
		border-bottom-color: #dfdfdf;
		color: #555;
		margin: 5px 0;
		padding: 0;
		font-size: 18px;
	}
	#user_info {
		right: 5%;
		top: 5px;
	}
	h3 {
		font-size: 1.1em;
		margin-top: 10px;
		margin-bottom: 0px;
	}
	#flipper {
		margin: 0;
		padding: 5px 20px 10px;
		background-color: #fff;
		border-left: 1px solid #dfdfdf;
		border-bottom: 1px solid #dfdfdf;
	}
	* html {
        overflow-x: hidden;
        overflow-y: scroll;
    }
	#flipper div p {
		margin-top: 0.4em;
		margin-bottom: 0.8em;
		text-align: justify;
	}
	th {
		text-align: center;
	}
	.top th {
		text-decoration: underline;
	}
	.top .key {
		text-align: center;
		width: 5em;
	}
	.top .action {
		text-align: left;
	}
	.align {
		border-left: 3px double #333;
		border-right: 3px double #333;
	}
	.keys {
		margin-bottom: 15px;
	}
	.keys p {
		display: inline-block;
		margin: 0px;
		padding: 0px;
	}
	.keys .left { text-align: left; }
	.keys .center { text-align: center; }
	.keys .right { text-align: right; }
	td b {
		font-family: "Times New Roman" Times serif;
	}
	#buttoncontainer {
		text-align: center;
		margin-bottom: 20px;
	}
	#buttoncontainer a, #buttoncontainer a:hover {
		border-bottom: 0px;
	}
     
     .rt_button{
        padding:3px;
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;  
        border:1px solid #B7B7B7;
        background:#EBEBEB;
        display:inline-block;
        position:relative;
        margin-left:2px;
        text-shadow: 1px 1px 0px #fff;
        cursor: pointer;
     }
     
     td{
        padding:4px 0;
     }
     
     td p {
        font-style: italic;
        color: #989898;
        font-size:10px;
     }

	
	table.layouts td{
		padding-right:20px;
		padding-bottom:20px;
		text-align:center;
	}
	
	table.layouts label{
		font-size:10px;
		color: #979797; 
	}

	table.layouts td img:hover{
		border-color:#71AEC6;
	}
	
	#values{
		display:none;
	}

	.content_wrapper{
		background:#fff;
		padding:20px;
	}


/* ----------------------------------------------------
	BUTTONS
------------------------------------------------------- */
	
	/* buttons common */
	a.button{
		display:inline-block !important;
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
		border-radius: 4px;
		padding: 0 15px;
		text-decoration:none;
		font-size:12px;
		line-height:23px;
		cursor:pointer;
	}
	
	/* medium button */
	.button.medium{
		padding: 2px 15px;
		text-decoration:none;
		font-size:14px;
		line-height:27px;
	}
	
	/* big button */
	.button.big{
		padding: 10px 15px;
		text-decoration:none;
		font-size:16px;
		line-height:31px;
	}
	
	/* mail button */
	.button .mail{
		background:url(../../../images/assets/icons/mail.png) left 2px  no-repeat;
		padding-left:25px;
	}

	/* mail button light icon */
	.button .mail.light{
		background:url(../../../images/assets/icons/mail_w.png) left 2px  no-repeat;
	}


	/* default button colors */
	.button.default{ 
		border: solid 1px #ccc;
		background: rgb(247,247,247); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(216,216,216,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(247,247,247,1)), color-stop(100%,rgba(216,216,216,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(247,247,247,1) 0%,rgba(216,216,216,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(247,247,247,1) 0%,rgba(216,216,216,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(247,247,247,1) 0%,rgba(216,216,216,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#d8d8d8',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(247,247,247,1) 0%,rgba(216,216,216,1) 100%); /* W3C */
		border-color: #D8D8D8 #CBCBCB #9D9D9D; 
		color: #646464 !important;
		text-shadow: 0 1px 0 #F4F4F4;
		-webkit-box-shadow: 0 1px 1px #D1D1D1, inset 0 1px 0 #fff;
		-moz-box-shadow: 0 1px 1px #D1D1D1, inset 0 1px 0 #fff;
		box-shadow: 0px 1px 2px #D1D1D1, inset 0 1px 0 #fff;    
	}

	/* default button hover state */	
	.button.default:hover{
		background: rgb(216,216,216); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(216,216,216,1) 0%, rgba(247,247,247,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(216,216,216,1)), color-stop(100%,rgba(247,247,247,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(216,216,216,1) 0%,rgba(247,247,247,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(216,216,216,1) 0%,rgba(247,247,247,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(216,216,216,1) 0%,rgba(247,247,247,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d8d8d8', endColorstr='#f7f7f7',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(216,216,216,1) 0%,rgba(247,247,247,1) 100%); /* W3C */
		border-color: #D8D8D8 #CBCBCB #B2B2B2;  
	}

	/* orange button colors */
	.button.orange{
		border: solid 1px #C1780F;
		background: rgb(254,193,35); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(254,193,35,1) 0%, rgba(232,120,1,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(254,193,35,1)), color-stop(100%,rgba(232,120,1,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(254,193,35,1) 0%,rgba(232,120,1,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(254,193,35,1) 0%,rgba(232,120,1,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(254,193,35,1) 0%,rgba(232,120,1,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fec123', endColorstr='#e87801',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(254,193,35,1) 0%,rgba(232,120,1,1) 100%); /* W3C */
		border-color: #FEB304 #E47A13 #C1780F;
		color: #773101 !important;
		text-shadow: 0 1px 0 #ECCF94;
		-webkit-box-shadow: 0 1px 1px #D1D1D1, inset 0 1px 0 #FEE09D;
		-moz-box-shadow: 0 1px 1px #D1D1D1, inset 0 1px 0 #FEE09D;
		box-shadow: 0px 1px 2px #D1D1D1, inset 0 1px 0 #FEE09D;    
	}

	/* orange button hover state */	
	.button.orange:hover{
		background: rgb(232,120,1); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(232,120,1,1) 0%, rgba(254,193,35,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(232,120,1,1)), color-stop(100%,rgba(254,193,35,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(232,120,1,1) 0%,rgba(254,193,35,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(232,120,1,1) 0%,rgba(254,193,35,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(232,120,1,1) 0%,rgba(254,193,35,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e87801', endColorstr='#fec123',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(232,120,1,1) 0%,rgba(254,193,35,1) 100%); /* W3C */
		border-color: #FEB304 #E47A13 #C1780F;
	}

	/* blue button colors */
	.button.blue{
		border: solid 1px #C1780F;
		background: rgb(176,209,236); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(176,209,236,1) 0%, rgba(53,88,108,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(176,209,236,1)), color-stop(100%,rgba(53,88,108,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(176,209,236,1) 0%,rgba(53,88,108,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(176,209,236,1) 0%,rgba(53,88,108,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(176,209,236,1) 0%,rgba(53,88,108,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b0d1ec', endColorstr='#35586c',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(176,209,236,1) 0%,rgba(53,88,108,1) 100%); /* W3C */
		border-color: #86ADC6 #4D6F8C #082132;
		color: #F7FFF9 !important;
		text-shadow: 0 1px 0 #082131;
		-webkit-box-shadow: 0 1px 1px #BABABA, inset 0 1px 0 #DCEAFB;
		-moz-box-shadow: 0 1px 1px #BABABA, inset 0 1px 0 #DCEAFB;
		box-shadow: 0px 1px 2px #BABABA, inset 0 1px 0 #DCEAFB;    
	}

	/* blue button hover state */	
	.button.blue:hover{
		background: rgb(53,88,108); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(53,88,108,1) 0%, rgba(176,209,236,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(53,88,108,1)), color-stop(100%,rgba(176,209,236,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(53,88,108,1) 0%,rgba(176,209,236,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(53,88,108,1) 0%,rgba(176,209,236,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(53,88,108,1) 0%,rgba(176,209,236,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#35586c', endColorstr='#b0d1ec',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(53,88,108,1) 0%,rgba(176,209,236,1) 100%); /* W3C */
		-webkit-box-shadow: 0 1px 1px #BABABA, inset 0 1px 0 #89A5AE;
		-moz-box-shadow: 0 1px 1px #BABABA, inset 0 1px 0 #89A5AE;
		box-shadow: 0px 1px 2px #BABABA, inset 0 1px 0 #89A5AE;    		
	}		

	/* dark button colors */
	.button.dark{
		border: solid 1px #C1780F;
		background: rgb(126,126,126); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(126,126,126,1) 0%, rgba(52,52,52,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(126,126,126,1)), color-stop(100%,rgba(52,52,52,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(126,126,126,1) 0%,rgba(52,52,52,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(126,126,126,1) 0%,rgba(52,52,52,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(126,126,126,1) 0%,rgba(52,52,52,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7e7e7e', endColorstr='#343434',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(126,126,126,1) 0%,rgba(52,52,52,1) 100%); /* W3C */															  
		border-color: #767676 #3C3C3C #171717;
		color: #F7FFF9 !important;
		text-shadow: 0 1px 0 #000;
		-webkit-box-shadow: 0 1px 1px #7E7E7E, inset 0 1px 0 #A5A5A5;
		-moz-box-shadow: 0 1px 1px #7E7E7E inset 0 1px 0 #A5A5A5;
		box-shadow: 0px 1px 2px #7E7E7E, inset 0 1px 0 #A5A5A5;    
	}

	/* dark button hover state */	
	.button.dark:hover{
		background: rgb(52,52,52); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(52,52,52,1) 0%, rgba(126,126,126,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(52,52,52,1)), color-stop(100%,rgba(126,126,126,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(52,52,52,1) 0%,rgba(126,126,126,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(52,52,52,1) 0%,rgba(126,126,126,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(52,52,52,1) 0%,rgba(126,126,126,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#343434', endColorstr='#7e7e7e',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(52,52,52,1) 0%,rgba(126,126,126,1) 100%); /* W3C */
	}		


	/* green button colors */
	.button.green{
		border: solid 1px #2F321A;
		background: rgb(164,179,87); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(164,179,87,1) 0%, rgba(76,109,0,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(164,179,87,1)), color-stop(100%,rgba(76,109,0,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(164,179,87,1) 0%,rgba(76,109,0,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(164,179,87,1) 0%,rgba(76,109,0,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(164,179,87,1) 0%,rgba(76,109,0,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a4b357', endColorstr='#4c6d00',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(164,179,87,1) 0%,rgba(76,109,0,1) 100%); /* W3C */
		border-color: #96A451 #586030 #2F321A;
		color: #fff !important;
		text-shadow: 0 1px 0 #2F321A;
		-webkit-box-shadow: 0 1px 1px #7E7E7E, inset 0 1px 0 #A5A5A5;
		-moz-box-shadow: 0 1px 1px #7E7E7E inset 0 1px 0 #A5A5A5;
		box-shadow: 0px 1px 2px #7E7E7E, inset 0 1px 0 #C1D26A;    
	}

	/* green button hover state */	
	.button.green:hover{
		background: rgb(76,109,0); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(76,109,0,1) 0%, rgba(164,179,87,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(76,109,0,1)), color-stop(100%,rgba(164,179,87,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(76,109,0,1) 0%,rgba(164,179,87,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(76,109,0,1) 0%,rgba(164,179,87,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(76,109,0,1) 0%,rgba(164,179,87,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c6d00', endColorstr='#a4b357',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(76,109,0,1) 0%,rgba(164,179,87,1) 100%); /* W3C */
	}	

	/* navy button colors */
	.button.navy{
		border: solid 1px #162D45;
		background: rgb(53,106,160); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(53,106,160,1) 0%, rgba(32,63,96,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(53,106,160,1)), color-stop(100%,rgba(32,63,96,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(53,106,160,1) 0%,rgba(32,63,96,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(53,106,160,1) 0%,rgba(32,63,96,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(53,106,160,1) 0%,rgba(32,63,96,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#356aa0', endColorstr='#203f60',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(53,106,160,1) 0%,rgba(32,63,96,1) 100%); /* W3C */
		border-color: #3267A3 #214365 #162D45;
		color: #fff !important;
		text-shadow: 0 1px 0 #001C32;
		-webkit-box-shadow: 0 1px 1px #7E7E7E, inset 0 1px 0 #87B5EF;
		-moz-box-shadow: 0 1px 1px #7E7E7E inset 0 1px 0 #87B5EF;
		box-shadow: 0px 1px 2px #7E7E7E, inset 0 1px 0 #87B5EF;    
	}

	/* navy button hover state */	
	.button.navy:hover{
		background: rgb(32,63,96); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(32,63,96,1) 0%, rgba(53,106,160,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(32,63,96,1)), color-stop(100%,rgba(53,106,160,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(32,63,96,1) 0%,rgba(53,106,160,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(32,63,96,1) 0%,rgba(53,106,160,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(32,63,96,1) 0%,rgba(53,106,160,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#203f60', endColorstr='#356aa0',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(32,63,96,1) 0%,rgba(53,106,160,1) 100%); /* W3C */
	}

	/* red button colors */
	.button.red{
		border: solid 1px #162D45;
		background: rgb(204,0,0); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(204,0,0,1) 0%, rgba(124,0,0,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(204,0,0,1)), color-stop(100%,rgba(124,0,0,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(204,0,0,1) 0%,rgba(124,0,0,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(204,0,0,1) 0%,rgba(124,0,0,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(204,0,0,1) 0%,rgba(124,0,0,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cc0000', endColorstr='#7c0000',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(204,0,0,1) 0%,rgba(124,0,0,1) 100%); /* W3C */
		border-color: #AC0101 #860101 #5C0101;
		color: #fff !important;
		text-shadow: 0 1px 0 #2F321A;
		-webkit-box-shadow: 0 1px 1px #7E7E7E, inset 0 1px 0 #FC6F6A;
		-moz-box-shadow: 0 1px 1px #7E7E7E inset 0 1px 0 #FC6F6A;
		box-shadow: 0px 1px 2px #7E7E7E, inset 0 1px 0 #FC6F6A;    
	}

	/* red button hover state */	
	.button.red:hover{
		background: rgb(124,0,0); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(124,0,0,1) 0%, rgba(204,0,0,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(124,0,0,1)), color-stop(100%,rgba(204,0,0,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(124,0,0,1) 0%,rgba(204,0,0,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(124,0,0,1) 0%,rgba(204,0,0,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(124,0,0,1) 0%,rgba(204,0,0,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7c0000', endColorstr='#cc0000',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(124,0,0,1) 0%,rgba(204,0,0,1) 100%); /* W3C */
	}

	/* light button colors */
	.button.light{
		border: solid 1px #9D9D9D;
		background: rgb(255,255,255); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(241,241,241,1) 50%, rgba(225,225,225,1) 51%, rgba(246,246,246,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(50%,rgba(241,241,241,1)), color-stop(51%,rgba(225,225,225,1)), color-stop(100%,rgba(246,246,246,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* W3C */
		border-color: #E0E0E0 #D1D1D1 #B2B2B2; 
		color: #646464 !important;
		text-shadow: 0 1px 0 #F4F4F4;
		-webkit-box-shadow: 0 1px 1px #D1D1D1, inset 0 1px 0 #fff;
		-moz-box-shadow: 0 1px 1px #D1D1D1, inset 0 1px 0 #fff;
		box-shadow: 0px 1px 2px #D1D1D1, inset 0 1px 0 #fff;    
	}

	/* light button hover state */	
	.button.light:hover{
		background: rgb(246,246,246); /* Old browsers */
		background: -moz-linear-gradient(top, rgba(246,246,246,1) 0%, rgba(249,249,249,1) 49%, rgba(241,241,241,1) 50%, rgba(255,255,255,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,246,246,1)), color-stop(49%,rgba(249,249,249,1)), color-stop(50%,rgba(241,241,241,1)), color-stop(100%,rgba(255,255,255,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, rgba(246,246,246,1) 0%,rgba(249,249,249,1) 49%,rgba(241,241,241,1) 50%,rgba(255,255,255,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, rgba(246,246,246,1) 0%,rgba(249,249,249,1) 49%,rgba(241,241,241,1) 50%,rgba(255,255,255,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(top, rgba(246,246,246,1) 0%,rgba(249,249,249,1) 49%,rgba(241,241,241,1) 50%,rgba(255,255,255,1) 100%); /* IE10+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f6f6', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
		background: linear-gradient(top, rgba(246,246,246,1) 0%,rgba(249,249,249,1) 49%,rgba(241,241,241,1) 50%,rgba(255,255,255,1) 100%); /* W3C */
	}																	      
		
	
</style>

<script type="text/javascript">
	function rt_send_shortcode(shortcode) {
	    
	    var shortcode_value = jQuery('#'+shortcode).html();
	    
	    parent.tinymce.activeEditor.execCommand( 'mceInsertContent',false, shortcode_value);
	    window.tinyMCE.activeEditor.execCommand('mceRepaint');
	    tinyMCEPopup.close();
	}
		
	function d(id) { return document.getElementById(id); }

	function flipTab(n) {
		for (i=1;i<=6;i++) {
			c = d('content'+i.toString());
			t = d('tab'+i.toString());
			if ( n == i ) {
				c.className = '';
				t.className = 'current';
			} else {
				c.className = 'hidden';
				t.className = '';
			}
		}
	}

    function init() {
        document.getElementById('version').innerHTML = tinymce.majorVersion + "." + tinymce.minorVersion;
        document.getElementById('date').innerHTML = tinymce.releaseDate;
    }
    
    tinyMCEPopup.onInit.add(init);
    
</script>

</head>

<?php
$dummy_text="Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.";
$dummy_text_short="Lorem ipsum dolor sit amet.";
$button_text= "Button Text";
?>
<div id="values">
	
	<!-- two cols -->
	<div id="two-cols">
		<br class="clear" /><div class="boxes clearfix"><div class="box two first"><?php echo $dummy_text;?></div><div class="box two last"><?php echo $dummy_text;?></div></div><br class="clear" />
	</div>	

	<!-- three cols -->
	<div id="three-cols">
		<br class="clear" /><div class="boxes clearfix"><div class="box three first"><?php echo $dummy_text;?></div><div class="box three"><?php echo $dummy_text;?></div><div class="box three last"><?php echo $dummy_text;?></div></div><br class="clear" />
	</div>

	<!-- four cols -->
	<div id="four-cols">
		<br class="clear" /><div class="boxes clearfix"><div class="box four first"><?php echo $dummy_text;?></div><div class="box four"><?php echo $dummy_text;?></div><div class="box four"><?php echo $dummy_text;?></div><div class="box four last"><?php echo $dummy_text;?></div></div><br class="clear" />
	</div>

	<!-- five cols -->
	<div id="five-cols">
		<br class="clear" /><div class="boxes clearfix"><div class="box five first"><?php echo $dummy_text;?></div><div class="box five"><?php echo $dummy_text;?></div><div class="box five"><?php echo $dummy_text;?></div><div class="box five"><?php echo $dummy_text;?></div><div class="box five last"><?php echo $dummy_text;?></div></div><br class="clear" />
	</div>

	<!-- two-three cols -->
	<div id="two-three-cols">
		<br class="clear" /><div class="boxes clearfix"><div class="box two-three first"><?php echo $dummy_text;?></div><div class="box three last"><?php echo $dummy_text;?></div></div><br class="clear" />
	</div>

	<!-- three-three cols -->
	<div id="three-four-cols">
		<br class="clear" /><div class="boxes clearfix"><div class="box three-four first"><?php echo $dummy_text;?></div><div class="box four last"><?php echo $dummy_text;?></div></div><br class="clear" />
	</div>
	
	<!-- four-five cols -->
	<div id="four-five-cols">
		<br class="clear" /><div class="boxes clearfix"><div class="box four-five first"><?php echo $dummy_text;?></div><div class="box five last"><?php echo $dummy_text;?></div></div><br class="clear" />
	</div>
	
	

	<!--
	******************************************************
	*
	*
	*         		Pullquotes
	*
	*
	******************************************************
	-->
			    
	
	<!-- pullquote left -->
	<div id="pullquote-left">
		<blockquote class="pullquote alignleft"><p><?php echo $dummy_text;?></p></blockquote>
	</div>

	<!-- pullquote right -->
	<div id="pullquote-right">
		<blockquote class="pullquote alignright"><p><?php echo $dummy_text;?></p></blockquote>
	</div>
	

	<!--
	******************************************************
	*
	*
	*         		Highlights
	*
	*
	******************************************************
	-->
	<div id="htext">
		<span class="htext"><?php echo $dummy_text_short;?></span>
	</div>

	<div id="red">
		<span class="red"><?php echo $dummy_text_short;?></span>
	</div>

	<div id="yellow">
		<span class="yellow"><?php echo $dummy_text_short;?></span>
	</div>	
	
	<div id="black">
		<span class="black"><?php echo $dummy_text_short;?></span>
	</div>

	<!--
	******************************************************
	*
	*
	*         		Dropcaps
	*
	*
	******************************************************
	-->

	<div id="dropcap1">
		<span class="dropcap style1 cufon">A</span>
	</div>
	
	<div id="dropcap2">
		<span class="dropcap style2 cufon">A</span>
	</div>

	<!--
	******************************************************
	*
	*
	*         		Lines
	*
	*
	******************************************************
	-->

	<div id="line">
		<div class="line"><span class="line">&nbsp;</span></div><br />
	</div>
	
	<div id="line_with_top">
		<div class="line"><span class="top">[top]</span></div><br />
	</div> 


	<!--
	******************************************************
	*
	*
	*         		Lists
	*
	*
	******************************************************
	-->

	<div id="star">
		<br />
			<ul class="star">
				<li>Unordered list test</li>
				<li>Another list element.</li>
				<li>Yet another element in the list.</li>
				<li>Some long text. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
			</ul>
		<br />
	</div> 

	<div id="check">
		<br />
			<ul class="check">
				<li>Unordered list test</li>
				<li>Another list element.</li>
				<li>Yet another element in the list.</li>
				<li>Some long text. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
			</ul>
		<br />
	</div> 		    


	<!--
	******************************************************
	*
	*
	*         		Buttons
	*
	*
	******************************************************
	-->
					
				
						
				
	<div id="button-1-1">
		<a class="button small default" href="">Small Button</a>
	</div>

	<div id="button-1-2">
		<a class="button medium default" href="">Medium Button</a>
	</div>
	
	<div id="button-1-3">
		<a class="button big default" href="">Big Button</a>		
	</div>

	<div id="button-1-4">
		<a class="button small default" href=""><span class="mail dark">Mail Button</span></a>		
	</div> 
	
	

	<div id="button-2-1">
		<a class="button small orange" href="">Small Button</a>
	</div>

	<div id="button-2-2">
		<a class="button medium orange" href="">Medium Button</a>
	</div>
	
	<div id="button-2-3">
		<a class="button big orange" href="">Big Button</a>		
	</div>

	<div id="button-2-4">
		<a class="button small orange" href=""><span class="mail light">Mail Button</span></a>		
	</div> 
	



	<div id="button-3-1">
		<a class="button small blue" href="">Small Button</a>
	</div>

	<div id="button-3-2">
		<a class="button medium blue" href="">Medium Button</a>
	</div>
	
	<div id="button-3-3">
		<a class="button big blue" href="">Big Button</a>		
	</div>

	<div id="button-3-4">
		<a class="button small blue" href=""><span class="mail light">Mail Button</span></a>		
	</div> 
	
		  
	<div id="button-4-1">
		<a class="button small dark" href="">Small Button</a>
	</div>

	<div id="button-4-2">
		<a class="button medium dark" href="">Medium Button</a>
	</div>
	
	<div id="button-4-3">
		<a class="button big dark" href="">Big Button</a>		
	</div>

	<div id="button-4-4">
		<a class="button small dark" href=""><span class="mail light">Mail Button</span></a>		
	</div> 



	<div id="button-5-1">
		<a class="button small green" href="">Small Button</a>
	</div>

	<div id="button-5-2">
		<a class="button medium green" href="">Medium Button</a>
	</div>
	
	<div id="button-5-3">
		<a class="button big green" href="">Big Button</a>		
	</div>

	<div id="button-5-4">
		<a class="button small green" href=""><span class="mail light">Mail Button</span></a>		
	</div> 



	<div id="button-7-1">
		<a class="button small red" href="">Small Button</a>
	</div>

	<div id="button-7-2">
		<a class="button medium red" href="">Medium Button</a>
	</div>
	
	<div id="button-7-3">
		<a class="button big red" href="">Big Button</a>		
	</div>

	<div id="button-7-4">
		<a class="button small red" href=""><span class="mail light">Mail Button</span></a>		
	</div> 
						 


	<div id="button-8-1">
		<a class="button small light" href="">Small Button</a>
	</div>

	<div id="button-8-2">
		<a class="button medium light" href="">Medium Button</a>
	</div>
	
	<div id="button-8-3">
		<a class="button big light" href="">Big Button</a>		
	</div>

	<div id="button-8-4">
		<a class="button small light" href=""><span class="mail dark">Mail Button</span></a>		
	</div> 
	

		
</div>



<?php
#
# 	LAYOUTS
#

if($_GET['section']=='layouts'):
?>

<div class="content_wrapper">
 <table class="layouts">
   <tr>
       <td>		
		<img src="../images/2-col.png" onclick="rt_send_shortcode('two-cols')" class="rt_button" /><br />
		<label>Two Columns</label>
	  </td>

       <td>		
		<img src="../images/3-col.png" onclick="rt_send_shortcode('three-cols')" class="rt_button" /><br />
		<label>Three Columns</label>
	  </td>

       <td>		
		<img src="../images/4-col.png" onclick="rt_send_shortcode('four-cols')" class="rt_button" /><br />
		<label>Four Columns</label>
	  </td>

       <td>		
		<img src="../images/5-col.png" onclick="rt_send_shortcode('five-cols')" class="rt_button" /><br />
		<label>Five Columns</label>
	  </td>       
   </tr>

   <tr>
       <td>		
		<img src="../images/3-1-col.png" onclick="rt_send_shortcode('two-three-cols')" class="rt_button" /><br />
		<label>2:3 and 1:3 Columns </label>
	  </td>

       <td>		
		<img src="../images/4-1-col.png" onclick="rt_send_shortcode('three-four-cols')" class="rt_button" /><br />
		<label>3:4 and 1:4 Columns</label>
	  </td>

       <td>		
		<img src="../images/5-1-col.png" onclick="rt_send_shortcode('four-five-cols')" class="rt_button" /><br />
		<label>4:5 and 1:5 Columns</label>
	  </td>
   </tr>
</table>
</div>
<?php endif;?> 



<?php
#
# 	QUICK STYLES
#

if($_GET['section']=='styling'):
?>
 <div class="content_wrapper">           
       <table>
           
       <tr>
           <td><label>Pullquotes: </label></td>
           <td>
            <input type="button" value="+ insert left" onclick="rt_send_shortcode('pullquote-left')" id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert right" onclick="rt_send_shortcode('pullquote-right')" id="rt_button_8" class="rt_button">
           </td>
       </tr>
       
    
       <tr>
           <td><label>Lists: </label></td>
            <td>
           <input type="button" value="+ insert star icon list" onclick='rt_send_shortcode("star")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert check icon list" onclick='rt_send_shortcode("check")' id="rt_button_8" class="rt_button">
           </td>
       </tr>
  
       <tr>
           <td><label for="rt_button_8">Line: </label></td>
           <td><input type="button" value="+ insert" onclick='rt_send_shortcode("line")' id="rt_button_8" class="rt_button"></td>
       </tr>
       
       <tr>
           <td width="150"><label for="rt_button_8">Line With Top Link: </label></td>
           <td><input type="button" value="+ insert" onclick='rt_send_shortcode("line_with_top")' id="rt_button_8" class="rt_button"></td>
       </tr>   
    
       <tr>
           <td><label>Highlights: </label></td>
           <td>
           <input type="button" value="+ insert blue" onclick="rt_send_shortcode('htext')"' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert red" onclick="rt_send_shortcode('red')" id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert yellow" onclick="rt_send_shortcode('yellow')" id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert black" onclick="rt_send_shortcode('black')" id="rt_button_8" class="rt_button">
           </td>
       </tr>   
     
    
       <tr>
           <td><label>Dropcaps: </label></td>
           <td>
           <input type="button" value="+ insert style 1" onclick="rt_send_shortcode('dropcap1')"' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert style 2" onclick="rt_send_shortcode('dropcap2')"' id="rt_button_8" class="rt_button">
           </td>
       </tr>
    
       </table>     
</div>     
<?php endif;?>


<?php
#
# 	BUTTONS
#

if($_GET['section']=='buttons'):
?>
<div class="content_wrapper">         
<table>
<tr>
	<td>				
		<a class="button small default" onclick='rt_send_shortcode("button-1-1")'>Small Button</a>
		<a class="button medium default" onclick='rt_send_shortcode("button-1-2")'>Medium Button</a>
		<a class="button big default" onclick='rt_send_shortcode("button-1-3")'>Big Button</a>				
		<a class="button small default" onclick='rt_send_shortcode("button-1-4")'><span class="mail dark">Mail Button</span></a>				
	</td>
</tr>

<tr>
	<td>				
		<a class="button small orange" onclick='rt_send_shortcode("button-2-1")'>Small Button</a>
		<a class="button medium orange" onclick='rt_send_shortcode("button-2-2")'>Medium Button</a>
		<a class="button big orange" onclick='rt_send_shortcode("button-2-3")'>Big Button</a>				
		<a class="button small orange" onclick='rt_send_shortcode("button-2-4")'><span class="mail light">Mail Button</span></a>				
	</td>
</tr>

<tr>
	<td>				
		<a class="button small blue" onclick='rt_send_shortcode("button-3-1")'>Small Button</a>
		<a class="button medium blue" onclick='rt_send_shortcode("button-3-2")'>Medium Button</a>
		<a class="button big blue" onclick='rt_send_shortcode("button-3-3")'>Big Button</a>				
		<a class="button small blue" onclick='rt_send_shortcode("button-3-4")'><span class="mail light">Mail Button</span></a>				
	</td>
</tr>
	
<tr>
	<td>				
		<a class="button small dark" onclick='rt_send_shortcode("button-4-1")'>Small Button</a>
		<a class="button medium dark" onclick='rt_send_shortcode("button-4-2")'>Medium Button</a>
		<a class="button big dark" onclick='rt_send_shortcode("button-4-3")'>Big Button</a>				
		<a class="button small dark" onclick='rt_send_shortcode("button-4-4")'><span class="mail light">Mail Button</span></a>				
	</td>
</tr>

<tr>
	<td>				
		<a class="button small green" onclick='rt_send_shortcode("button-5-1")'>Small Button</a>
		<a class="button medium green" onclick='rt_send_shortcode("button-5-2")'>Medium Button</a>
		<a class="button big green" onclick='rt_send_shortcode("button-5-3")'>Big Button</a>				
		<a class="button small green" onclick='rt_send_shortcode("button-5-4")'><span class="mail light">Mail Button</span></a>				
	</td>
</tr>

<tr>
	<td>				
		<a class="button small red" onclick='rt_send_shortcode("button-7-1")'>Small Button</a>
		<a class="button medium red" onclick='rt_send_shortcode("button-7-2")'>Medium Button</a>
		<a class="button big red" onclick='rt_send_shortcode("button-7-3")'>Big Button</a>				
		<a class="button small red" onclick='rt_send_shortcode("button-7-4")'><span class="mail light">Mail Button</span></a>				
	</td>
</tr>

<tr>
	<td>				
		<a class="button small light" onclick='rt_send_shortcode("button-8-1")'>Small Button</a>
		<a class="button medium light" onclick='rt_send_shortcode("button-8-2")'>Medium Button</a>
		<a class="button big light" onclick='rt_send_shortcode("button-8-3")'>Big Button</a>				
		<a class="button small light" onclick='rt_send_shortcode("button-8-4")'><span class="mail dark">Mail Button</span></a>				
	</td>
</tr>


</table>
</div>	
<?php endif;?>