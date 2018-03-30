<?php 

/**
 * Page Builder Functions
 * Queue Up Framework
 * @since version 1.0
 * @author TommusRhodus
 */
if(class_exists('TD_Page_Builder')) {
	
	/**
	 * Register custom blocks
	 * Override by copying block file of your choice to your child theme, and then require & register from your child theme functions.php
	 * Ensure that you use td_regiser_block() in your child theme to register the block with the page builder.
	 */
	if(!( class_exists('TD_Section_Block') )){
		require_once ( "page-builder-blocks/page_section_block.php" );
		td_register_block('TD_Section_Block');
	}
	if(!( class_exists('TD_HTML_Block') )){
		require_once ( "page-builder-blocks/html_block.php" );
		td_register_block('TD_HTML_Block');
	}
	if(!( class_exists('TD_WYSIWYG_Block') )){
		require_once ( "page-builder-blocks/wysiwyg_block.php" );
		td_register_block('TD_WYSIWYG_Block');
	}
	if(!( class_exists('TD_Divider_Block') )){
		require_once ( "page-builder-blocks/divider_block.php" );
		td_register_block('TD_Divider_Block');
	}
	if(!( class_exists('TD_Section_Title_Block') )){
		require_once ( "page-builder-blocks/secton_title_block.php" );
		td_register_block('TD_Section_Title_Block');
	}
	if(!( class_exists('TD_Social_Block') )){
		require_once ( "page-builder-blocks/social_block.php" );
		td_register_block('TD_Social_Block');
	}
	if(!( class_exists('TD_Instagram_Block') )){
		require_once ( "page-builder-blocks/instagram_block.php" );
		td_register_block('TD_Instagram_Block');
	}
	if(!( class_exists('TD_Food_Block') )){
		require_once ( "page-builder-blocks/food_block.php" );
		td_register_block('TD_Food_Block');
	}
	if(!( class_exists('TD_Food_Section_Block') )){
		require_once ( "page-builder-blocks/food_section_block.php" );
		td_register_block('TD_Food_Section_Block');
	}
	if(!( class_exists('TD_Fullwidth_Food_Menu_Block') )){
		require_once ( "page-builder-blocks/fullwidth_food_menu_block.php" );
		td_register_block('TD_Fullwidth_Food_Menu_Block');
	}
	if(!( class_exists('TD_Image_Block') )){
		require_once ( "page-builder-blocks/image_block.php" );
		td_register_block('TD_Image_Block');
	}
	if(!( class_exists('TD_Embed_Block') )){
		require_once ( "page-builder-blocks/embed_block.php" );
		td_register_block('TD_Embed_Block');
	}
	/**
	 * Wrapper function overrides
	 * @doNotModify Unless you know exactly what you're doing, modification of these will break the theme layout. You have been warned.
	 */
	function td_css_classes($block){
		$block = str_replace('span', '', $block);
		$output = 'col-sm-' . $block;
		return $output;
	}
	function td_css_clearfix(){
		return false;
	}
	function td_template_wrapper_start($template_id){
		return '<div class="row">';
	}
	function td_template_wrapper_end(){
		return '</div>';
	}
	
}