<?php 
	header("Content-type: text/css",true); 
	ob_start("compress");
	function compress($buffer) {
	  /* remove comments */
	  $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	  /* remove tabs, spaces, newlines, etc. */
	  $buffer = str_replace(array("\r\n", "\r", "\n", "\t",'    '), '', $buffer);
	  return $buffer;
	}
	  
	/* css files */
	include('../inc/visualcomposer/assets/js_composer.min.css'); /* Import Visual Composer Stylesheet */
	include('./visualcomposer.css'); /* Import Modified Visual Composer Stylesheet */
	include('./base.css'); /* Import Basic Styles, Typography, Forms etc stylesheet */
	include('./scaffolding.css'); /* Import Responsive Grid System Stylesheet */
	include('./blox.css'); /* Import Full width Sections + Parallax Stylesheet */
	include('./fancybox.css'); /* Import fancyBox Stylesheet */
	include('./flexslider.css'); /* Import Flex Slider Stylesheet */
	include('./iconfonts.css'); /* Import Vector Icons Stylesheet */
	include('./blog.css'); /* Import Blog stylesheet */
	include('./elements.css'); /* Import Elements stylesheet */
	include('./widgets.css'); /* Import Widgets stylesheet */
	include('./icon-box.css'); /* Import Icon Boxes stylesheet */
	include('./live-search.css'); /* Import Color Skins Stylesheet */
	include('./main-menu.css'); /* Import Menu Stylesheet */
	include('./main-style.css'); /* Import Main Stylesheet */
	include('./color-skins.css'); /* Import Color Skins Stylesheet */
	ob_end_flush();
?>