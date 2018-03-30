<?php 

/**
 * Page Builder Functions
 * Queue Up Framework
 * @since version 1.0
 * @author TommusRhodus
 */
if(class_exists('AQ_Page_Builder')) {
	
	/**
	 * Dre-register defaults
	 */
	aq_unregister_block('AQ_Text_Block');
	aq_unregister_block('AQ_Tabs_Block');
	aq_unregister_block('AQ_Alert_Block');
	aq_unregister_block('AQ_Richtext_Block');
	aq_unregister_block('AQ_Clear_Block');
	aq_unregister_block('AQ_Widgets_Block');
	
	/**
	 * Register custom blocks
	 * Override by copying block file of your choice to your child theme, and then require & register from your child theme functions.php
	 * Ensure that you use aq_regiser_block() in your child theme to register the block with the page builder.
	 */
	if(!( class_exists('AQ_Header_Block') )){
		require_once ( "page_builder_blocks/header_block.php" );
		aq_register_block('AQ_Header_Block');
	}
	if(!( class_exists('AQ_Section_Block') )){
		require_once ( "page_builder_blocks/page_section_block.php" );
		aq_register_block('AQ_Section_Block');
	}
	if(!( class_exists('AQ_Spacer_Block') )){
		require_once ( "page_builder_blocks/clear_block.php" );
		aq_register_block('AQ_Spacer_Block');
	}
	if(!( class_exists('AQ_Team_Feed_Block') )){
		require_once ( "page_builder_blocks/team_feed_block.php" );
		aq_register_block('AQ_Team_Feed_Block');
	}
	if(!( class_exists('AQ_Big_Image_Block') )){
		require_once ( "page_builder_blocks/big_image_block.php" );
		aq_register_block('AQ_Big_Image_Block');
	}
	if(!( class_exists('AQ_Service_Block') )){
		require_once ( "page_builder_blocks/service_block.php" );
		aq_register_block('AQ_Service_Block');
	}
	if(!( class_exists('AQ_Ticker_Block') )){
		require_once ( "page_builder_blocks/ticker_block.php" );
		aq_register_block('AQ_Ticker_Block');
	}
	if(!( class_exists('AQ_Ebor_Text_Block') )){
		require_once ( "page_builder_blocks/text_block.php" );
		aq_register_block('AQ_Ebor_Text_Block');
	}
	if(!( class_exists('AQ_Chart_Block') )){
		require_once ( "page_builder_blocks/chart_block.php" );
		aq_register_block('AQ_Chart_Block');
	}
	if(!( class_exists('AQ_Counter_Block') )){
		require_once ( "page_builder_blocks/counter_block.php" );
		aq_register_block('AQ_Counter_Block');
	}
	if(!( class_exists('AQ_Portfolio_Block') )){
		require_once ( "page_builder_blocks/portfolio_block.php" );
		aq_register_block('AQ_Portfolio_Block'); 
	}
	if(!( class_exists('AQ_Pricing_Table_Block') )){
		require_once ( "page_builder_blocks/pricing_table_block.php" );
		aq_register_block('AQ_Pricing_Table_Block');
	}
	if(!( class_exists('AQ_Clients_Block') )){
		require_once ( "page_builder_blocks/clients_carousel.php" );
		aq_register_block('AQ_Clients_Block');
	}
	if(!( class_exists('AQ_Map_Block') )){
		require_once ( "page_builder_blocks/map_block.php" );
		aq_register_block('AQ_Map_Block');
	}
	if(!( class_exists('AQ_Blog_Carousel_Block') )){
		require_once ( "page_builder_blocks/blog_carousel_block.php" );
		aq_register_block('AQ_Blog_Carousel_Block');
	}
	if(!( class_exists('AQ_Background_Video_Block') )){
		require_once ( "page_builder_blocks/background_video_block.php" );
		aq_register_block('AQ_Background_Video_Block');
	}
	if(!( class_exists('AQ_Image_Block') )){
		require_once ( "page_builder_blocks/image_block.php" );
		aq_register_block('AQ_Image_Block');
	}
	if(!( class_exists('AQ_Skill_Block') )){
		require_once ( "page_builder_blocks/skill_block.php" );
		aq_register_block('AQ_Skill_Block');
	}
	if(!( class_exists('AQ_Testimonial_Carousel_Block') )){
		require_once ( "page_builder_blocks/testimonial_carousel_block.php" );
		aq_register_block('AQ_Testimonial_Carousel_Block');
	}
	
	/**
	 * Wrapper function overrides
	 * @doNotModify Unless you know exactly what you're doing, modification of these will break the theme layout. You have been warned.
	 */
	function aq_css_classes($block){
		$block = str_replace('span', '', $block);
		$output = 'col-sm-' . $block;
		return $output;
	}
	function aq_css_clearfix(){
		return false;
	}
	function aq_template_wrapper_start($template_id){
		return '';
	}
	function aq_template_wrapper_end(){
		return '';
	}
	
}