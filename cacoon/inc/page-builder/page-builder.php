<?php
if(class_exists('AQ_Page_Builder')) {

	define('AQPB_CUSTOM_DIR', get_template_directory() . '/inc/page-builder/');
	define('AQPB_CUSTOM_URI', get_template_directory_uri() . '/inc/page-builder/');

	aq_unregister_block('AQ_Text_Block');
	aq_unregister_block('AQ_Tabs_Block');
	aq_unregister_block('AQ_Alert_Block');

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/blog_list_block.php');
	aq_register_block('MET_Blog_List_One');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/blog_list_vertical.php');
	aq_register_block('MET_Blog_List_Vertical');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/css.php');
	aq_register_block('MET_CSS_Block');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/gallery.php');
	aq_register_block('MET_Gallery');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/google_maps.php');
	aq_register_block('MET_Google_Maps');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/html_heading.php');
	aq_register_block('MET_Heading_Block');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/text.php');
	aq_register_block('MET_Text_Block');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/text_balloon.php');
	aq_register_block('MET_Text_Balloon_Block');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/team.php');
	aq_register_block('MET_Team_Group');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/tabs.php');
	aq_register_block('MET_Tabs_Block');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/tabs_icon.php');
	aq_register_block('MET_Icon_Tabs_Block');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/twitter.php');
	aq_register_block('MET_Twitter_Ticker');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/testimonial_ticker.php');
	aq_register_block('MET_Testimonial_Ticker');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/message_box.php');
	aq_register_block('MET_Msg_Box');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/progress.php');
	aq_register_block('MET_Progress_Group');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/infobox_photo.php');
	aq_register_block('MET_Info_Box_Photo');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/infobox.php');
	aq_register_block('MET_Info_Box');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/infobox_knob.php');
	aq_register_block('MET_Info_Box_Knob');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/slider-concept-one.php');
	aq_register_block('MET_Concept_Slider_One');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/slider-concept-two.php');
	aq_register_block('MET_Concept_Slider_Two');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/shortcode.php');
	aq_register_block('MET_Shortcode');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/page_header.php');
	aq_register_block('MET_Page_Header');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/portfolio_block.php');
	aq_register_block('MET_Portfolio_Block');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/portfolio_listing.php');
	aq_register_block('MET_Portfolio');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	require_once(AQPB_CUSTOM_DIR . 'blocks/portfolio_listing_2.php');
	aq_register_block('MET_Portfolio_2');
	//////////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	//require_once(AQPB_CUSTOM_DIR . 'blocks/rich_text.php');
	//aq_register_block('MET_RichText_Block');
	//////////////////////////////////////////////////////




	function my_enqueue($hook) {
		if( 'appearance_page_aq-page-builder' == $hook ){
			//wp_enqueue_script( 'page-builder-custom',  AQPB_CUSTOM_URI . 'custom.js');
			//wp_enqueue_style('wetro_circle_icons',get_template_directory_uri().'/css/circle_icons.css');
			wp_enqueue_style('custom-page-builder',get_template_directory_uri().'/inc/page-builder/custom_page_builder.css');

			wp_enqueue_script('ckeditorr',get_template_directory_uri().'/inc/page-builder/ckeditor/ckeditor.js');
			wp_enqueue_script('ckeditorrj',get_template_directory_uri().'/inc/page-builder/ckeditor/jquery.js');

			//add_thickbox();
		}
	}add_action( 'admin_enqueue_scripts', 'my_enqueue' );


	function ckeditor_admin_head(){
		if( 'appearance_page_aq-page-builder' == get_current_screen()->id ):
?>
		<script>

			jQuery().ready(function(){

				jQuery(document).on('click', '#page-builder a.block-edit', function() {
					jQuery('.met_ckeditor').ckeditor(function(){},{
							toolbar: [
								['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'Image', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight' , '-','Source']
								,['Format', 'Font', 'FontSize', '-', 'TextColor', 'BGColor','-','Table']
							]
					});

					jQuery('.block-settings > .cke').each(function(){
						jQuery(this).remove();
					})
				});

				jQuery( "ul.blocks" ).bind( "sortstart", function(event, ui) {
					jQuery('.met_ckeditor', ui.item).each(function(){
						var str = jQuery(this).attr('id');
						var n = str.substr(0,12);

						if(n != 'aq_block___i'){
							jQuery('#'+str).ckeditorGet().destroy();
						}
					});
				});

				jQuery( "ul.blocks" ).bind( "sortstop", function(event, ui) {
					setTimeout(function(){
						jQuery('.met_ckeditor', ui.item).ckeditor(function(){},
							{
								toolbar: [
									['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'Image', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight' , '-','Source']
									,['Format', 'Font', 'FontSize', '-', 'TextColor', 'BGColor','-','Table']
								]
							});
					},1);
				});


			})

		</script>
<?php
		endif;
	}add_action('admin_head', 'ckeditor_admin_head');

}