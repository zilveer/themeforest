<?php 
class Theme_Options_Page_Image extends Theme_Options_Page_With_Tabs {
	public $slug = 'image';

	function __construct(){
		$this->name = __('Image Settings','theme_admin');
		//"desc" => __("The options listed below determine the dimensions in pixels to use in the shortcode of image.",'theme_admin'),
		parent::__construct();
	}

	function tabs(){
		$options = array(
			array(
				"slug" => 'general',
				"name" => __("Image General",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Custom Sizes",'theme_admin'),
						"desc" => __("Enter the name of custom you'd like to create.",'theme_admin'),
						"id" => "customs",
						"function" =>  "_option_customs_function",
						"default" => "",
						"type" => "custom",
					),
				),
			),
			array(
				"slug" => 'size_small',
				"name" => __("Image Size: Small",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "small_width",
						"default" => 220,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "small_height",
						"default" => 150,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'size_medium',
				"name" => __("Image Size: Medium",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "medium_width",
						"default" => 292,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "medium_height",
						"default" => 190,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'size_large',
				"name" => __("Image Size: Large",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "large_width",
						"default" => 459,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "large_height",
						"default" => 240,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
				),
			),
		);

		if($customs =  theme_get_option_from_db('image','customs')){
			$custom_array = explode(',',$customs);
			foreach ($custom_array as $custom){
				$options[] = array(
					"slug" => 'size_'.$custom,
					"name" => "Image Size: ".$custom." Sizes",
					"options" => array(
						array(
							"name" => __("Width",'theme_admin'),
							"desc" => "",
							"id" => $custom."_width",
							"default" => 150,
							"min" => 0,
							"max" => 960,
							"unit" => 'px',
							"type" => "range"
						),
						array(
							"name" => __("Height",'theme_admin'),
							"desc" => "",
							"id" => $custom."_height",
							"default" => 150,
							"min" => 0,
							"max" => 960,
							"unit" => 'px',
							"type" => "range"
						),
					),
				);
			}
		}
		return $options;
	}

	function _option_customs_function($value, $default) {
		if(!empty($default)){
			$customs = explode(',',$default);
		}else{
			$customs = array();
		}
		
		echo <<<HTML
<script type="text/javascript">
jQuery(document).ready( function($) {
	$("#add_custom").validator({effect:'option'}).closest('form').submit(function(e) {
		if (!e.isDefaultPrevented() && $("#add_custom").val()) {
			if($('#customs').val()){
				$('#customs').val($('#customs').val()+','+$("#add_custom").val());
			}else{
				$('#customs').val($("#add_custom").val());
			}
		}
	});
	$(".custom-item input:button").click(function(){
		$(this).closest(".custom-item").fadeOut("normal",function(){
  			$(this).remove();
  			$('#customs').val('');
			$(".custom-item-value").each(function(){
				if($('#customs').val()){
					$('#customs').val($('#customs').val()+','+$(this).val());
				}else{
					$('#customs').val($(this).val());
				}
			});
 		});
		
	});
	
});
</script>
<style type="text/css">
.custom-title {
	margin:20px 0 5px;
	font-weight:bold;
}
.custom-item {
	padding-left:10px;
}
.custom-item span {
	margin-right:10px;
}

</style>
HTML;
		echo '<div class="theme-option-content">';
		echo '<input type="text" id="add_custom" name="add_custom" pattern="([a-zA-Z\x7f-\xff][ a-zA-Z0-9_\x7f-\xff]*){0,1}" data-message="'.__('Please input a valid name which starts with a letter, followed by letters, numbers, spaces, or underscores.','theme_admin').'" maxlength="20" /><span class="validator-error"></span>';
		if(!empty($customs)){
			echo '<div class="custom-title">'.__('Below are the Sizes you have created','theme_admin').'</div>';
			foreach($customs as $custom){
				echo '<div class="custom-item"><span>'.$custom.'</span><input type="hidden" class="custom-item-value" value="'.$custom.'"/><input type="button" class="button" value="'.__('Delete','theme_admin').'"/></div>';
			}
		}
		echo '<input type="hidden" value="' . $default . '" name="' . $value['id'] . '" id="customs"/>';
		echo '</div>';
	}
}
