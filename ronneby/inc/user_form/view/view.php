<?php
/* @var $this WPBakeryShortCode_Dfd_User_Form */
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$atts = array_merge($atts, array ("content" => $content));

$check_layout = $check_layout ? $check_layout : "";
$str = "";
if ($fake_check_layout == "") {
	return;
}
$check_layout_template_layout = "check_layout_" . $fake_check_layout;

$outer_border_color = !empty($outer_border_color) ? "border:2px solid " . esc_attr($outer_border_color) : "";
$button_color_text = isset($button_color_text) ? esc_attr($button_color_text) : "";
$border_color = isset($border_color) ? esc_attr($border_color) : "";
$text_color = isset($text_color) ? esc_attr($text_color) : "";
$borderwidth = isset($borderwidth) ? esc_attr($borderwidth) : "";
$border_style = isset($border_style) ? esc_attr($border_style) : "";
$border_radius = isset($border_radius) ? esc_attr($border_radius) : "";
$btn_align = isset($btn_align) ? esc_attr($btn_align) : "";
switch ($btn_align) {
	case "left":
		$btn_align = "float:left;";
		break;
	case "center":
		$btn_align = "margin:0 auto;";
		break;
	case "right":
		$btn_align = "float:right;";
		break;
}

$btn_style = "";
$btn_style_hover = "";


if (isset($btn_text_transform)) {
	$btn_style.='text-transform:' . esc_attr($btn_text_transform) . ';';
}
if (isset($font_size)) {
	$btn_style.='font-size:' . esc_attr($font_size) . 'px;';
}

if (isset($letter_spacing)) {
	$btn_style.='letter-spacing:' . esc_attr($letter_spacing) . 'px;';
}
if (isset($button_border_width)) {
	$btn_style.='border-width:' . esc_attr($button_border_width) . 'px;';
}
if (isset($button_border_color)) {
	$btn_style.='border-color:' . esc_attr($button_border_color) . ';';
}
if (isset($button_border_color_on_hover)) {
	$btn_style_hover.='border-color:' . esc_attr($button_border_color_on_hover) . ';';
}
if (isset($button_border_style)) {
	$btn_style.='border-style:' . esc_attr($button_border_style) . ';';
}
if (isset($button_border_radius)) {
	$btn_style.='border-radius:' . esc_attr($button_border_radius) . 'px;';
}
?>
<?php
$fontHelper = Dfd_Helper_GoogleFont::instance();

$label_font = $fontHelper->getGoogleFontArray($custom_fonts_label, true);
$button_font = $fontHelper->getGoogleFontArray($custom_fonts_button, true);
$input_font = $fontHelper->getGoogleFontArray($custom_fonts_input, true);


$fieldmanager = new Dfd_Contact_Form_FieldManager();
if (isset(${$check_layout_template_layout})) {
	$content = $fieldmanager->populate(${$check_layout_template_layout}, $fake_check_layout, $atts);
}
//global $form_id;
$form_id = Dfd_contact_form_settings::instance()->getFormid();
//echo $form_id;
$input_background = $input_background ? $input_background : "inherit";
$button_backgrond = $button_backgrond ? esc_attr($button_backgrond) : "inherit";
$hover_button_backgrond = $hover_button_backgrond ? esc_attr($hover_button_backgrond) : "inherit";
$boxshadow_border = "";
$table = "";
$compact_border_style = "";
$compact_border_width = "";
$height_input_span = "";
$height_input = "";
if ($preset == "preset2" || ($horiz_margin_btw_inputs == "" && $vert_margin_btw_inputs == "") || ( $horiz_margin_btw_inputs <= 0 && $vert_margin_btw_inputs <= 0)) {
	$table = "display: table;";
	$show_border = "border:none;";
	$compact_border_width = $borderwidth;
	$borderwidth = "";
	$hide_border_right = "border-right: inherit;";
	$hide_border_bottom = "border-bottom: inherit;";
	$vert_margin_btw_inputs = 0;
	$horiz_margin_btw_inputs = 0;
} else if ($preset == "preset3") {
	$border_style = "";
	$hide_border_right = "border-right: none !important;";
	$hide_border_bottom = "border-bottom: inherit;";
	$show_border = "border:none;";
	$outer_border_color = "";
} else {//preset1
	$hide_border_right = "border-right: none !important;";
	$hide_border_bottom = "border-bottom: none !important;";
	$show_border = " border-style:" . $border_style . ";";
	$outer_border_color = "";
}
$all_height_input = "54";
$height_input_span = "min-height:" . $all_height_input . "px;";
?>
<?php ob_start(); ?>
    #cf_<?php echo $form_id; ?>{
    
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 textarea{
        border:transparent;
        padding-left: 0px;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .box{
        margin-bottom: 11px;
    }
    #cf_<?php echo $form_id; ?> .box{
        
    }
    #cf_<?php echo $form_id; ?> p{
        margin-bottom: <?php echo $vert_margin_btw_inputs; ?>px;
        
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-compact p.last{
        margin-bottom: 0px;
    }
   
    #cf_<?php echo $form_id; ?> .dfd-half-size{
        width:50%;
    }
    #cf_<?php echo $form_id; ?> .padding-left{
        padding-right: <?php echo $horiz_margin_btw_inputs; ?>px;
    }
    #cf_<?php echo $form_id; ?> .padding-right{
        padding-left: <?php echo $horiz_margin_btw_inputs; ?>px;    
    }
    #cf_<?php echo $form_id; ?> .padding-center{
        padding:0 <?php echo $horiz_margin_btw_inputs; ?>px;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .right-border{
        background: <?php echo $border_color; ?>;
        z-index: 34;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .top-border{
        background: <?php echo $border_color; ?>;
        z-index: 34;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .left-border{
        background: <?php echo $border_color; ?>;
        z-index: 34;
    }
    #cf_<?php echo $form_id; ?> span.wpcf7-form-control-wrap span:not(".req_text"){
        color:<?php echo $text_color; ?>;
<?php echo $height_input_span; ?>
        height:<?php echo $all_height_input; ?>px;
        display: table;
        vertical-align: middle;
        width: 100%;
    }
    #cf_<?php echo $form_id; ?> span.wpcf7-form-control-wrap .label_text span:last-child{
		display: block;
		margin-top: 5px;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-compact .margin-left-1 .checkboxgroup{
        left: -<?php echo $compact_border_width; ?>px;
        bottom: -<?php echo $compact_border_width; ?>px;
        border-left: <?php echo $compact_border_width; ?>px solid <?php echo $border_color; ?>;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .border-bottom{
        border: none;
    }
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .wpcf7-form-control-wrap{
        border-bottom: 1px solid <?php echo $border_color; ?>;
        /*border:none;*/
    }
    #cf_<?php echo $form_id; ?> .container{        
<?php echo $outer_border_color; ?>;
<?php echo $table; ?>
        width:100%;
    }
	#cf_<?php echo $form_id; ?> input, #cf_<?php echo $form_id; ?> textarea{
<?php echo $input_font; ?>
	}
    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-compact .checkboxgroup{
        padding-left: 15px;        
    }
    #cf_<?php echo $form_id; ?> .checkboxgroup{
        display: table-cell;
        vertical-align: middle;
        height: <?php echo $all_height_input-5; ?>px;
        position: relative;

    }
    #cf_<?php echo $form_id; ?> .checkbox input[type='checkbox']{
        margin-right: 28px;
        min-height: <?php echo $all_height_input-5; ?>px;
    }
    #cf_<?php echo $form_id; ?> .checkbox input[type='checkbox']:before{
    }
    #cf_<?php echo $form_id; ?> .checkbox input[type='radio']{
        margin-right: 15px;
        min-height: <?php echo $all_height_input - 10; ?>px;
    }
    #cf_<?php echo $form_id; ?> .checkbox input{
        border:none;
        background: none !important;
    }
    #cf_<?php echo $form_id; ?> .checkbox{
        display: inline-table;
        vertical-align: middle;
        padding-right: 12px;
    }   
    .checkbox input{
        top:0px;
    }
    #cf_<?php echo $form_id; ?> .checkbox .c_value{
        display: table-cell;
        height:<?php echo $all_height_input-5; ?>px;
        vertical-align: middle;
    }
    #cf_<?php echo $form_id; ?> .checkbox .c_value label{
        height:<?php echo $all_height_input-5; ?>px;
        display: table-cell;
        vertical-align: middle;
		font-weight: inherit;
    }
    #cf_<?php echo $form_id; ?> .border-bottom{
<?php echo $hide_border_bottom; ?>
        border-bottom-style: solid;
        border-bottom-width: <?php echo $compact_border_width; ?>px;
        border-bottom-color: <?php echo $border_color; ?>;
    }
    #cf_<?php echo $form_id; ?> .border-right{
<?php echo $hide_border_right; ?>        
        border-right-style: solid;
        border-right-width: <?php echo $compact_border_width; ?>px;
        border-right-color: <?php echo $border_color; ?>;

    }
    #cf_<?php echo $form_id; ?> .border-left{
<?php echo $compact_border_style; ?>        
        border-left-style: solid;
        border-left-width: <?php echo $compact_border_width; ?>px;
        border-left-color: <?php echo $border_color; ?>;

    }
    #cf_<?php echo $form_id; ?> .border-top{
<?php echo $compact_border_style; ?>
        border-top-style: solid;
        border-top-width: <?php echo $compact_border_width; ?>px;
        border-top-color: <?php echo $border_color; ?>;

    }

    #cf_<?php echo $form_id; ?> .left{}
    #cf_<?php echo $form_id; ?> .right{}
    #cf_<?php echo $form_id; ?> .full{}
    #cf_<?php echo $form_id; ?> p input, #cf_<?php echo $form_id; ?> p textarea   
    {
<?php echo $show_border; ?>
<?php echo $height_input; ?>
        margin-bottom: 0px;
        border-width: <?php echo $borderwidth; ?>px;
        background-color: <?php echo esc_attr($input_background); ?>;
        border-radius: <?php echo $border_radius; ?>px;
        position :relative;
        color:<?php echo $text_color; ?>;
        border-color: <?php echo $border_color; ?>;
        z-index:0;
        min-height: <?php echo $all_height_input - 5; ?>px;
        /*margin-top: 5px;*/
    }
	#cf_<?php echo $form_id; ?>.preset1 .label_text label:first-child{
<?php echo $label_font; ?>
	}
	#cf_<?php echo $form_id; ?> .checkbox span
	{
		    font-weight: 400;
			<?php echo $input_font; ?>

	}
    #cf_<?php echo $form_id; ?> ::-webkit-input-placeholder {
		color: <?php // echo $text_color; ?>;
		<?php echo $label_font; ?>
	}
    #cf_<?php echo $form_id; ?> :-moz-placeholder {
		color: <?php // echo $text_color; ?>;
		<?php echo $label_font; ?>
	}
    #cf_<?php echo $form_id; ?> :focus::-webkit-input-placeholder {color: transparent;}
    :focus:-moz-placeholder { color: transparent; }​
    :focus::-moz-placeholder { color: transparent; }​
    :focus:-ms-input-placeholder { color: transparent; }
    #cf_<?php echo $form_id; ?> input[type="checkbox"]{
        float: none;
        top: inherit;
    }
    #cf_<?php echo $form_id; ?> .radio_el{
        text-align: center;
        width: 100%;
        display: block;
    }
    #cf_<?php echo $form_id; ?> .radio_el label{
        margin-right: 8px;
    }
    /*reCaptcha*/
    #cf_<?php echo $form_id; ?>  iframe{
        margin: 0 auto;
        display: block;
    }
    #cf_<?php echo $form_id; ?>  .captcha div{
        width: 100% !important;
    }
    #cf_<?php echo $form_id; ?>  .reloadCap{
        margin: 0 auto;
        display: block;
        text-align: center;
        cursor: pointer;
        color: rgb(152, 155, 168);
        transition: color 0.4s;
        display: block;
    }
    #cf_<?php echo $form_id; ?> p span.reloadCap:hover{
        color: rgb(39, 40, 42);
        cursor: pointer;
    }
    
    /**submit*/
    #cf_<?php echo $form_id; ?> .form_button{
        margin-bottom: 10px;
    }
    .checkbox input{
        float: left;
    }
    #cf_<?php echo $form_id; ?> .wpcf7-submit{
<?php echo $btn_align; ?>
<?php echo $btn_style; ?>
        line-height: 0;
        width: 100%;
        text-align: <?php echo esc_attr($text_align) ?>;
        margin-top: 0px;
		font-weight: 400;
        padding: 15px 20px 15px 20px;
        background-color: <?php echo $button_backgrond ?>;
        transition: all 0.4s;
        color: <?php echo $button_color_text ?>;
        height: 48px;
<?php echo $button_font; ?>
    }
    
    #cf_<?php echo $form_id; ?> input:hover.wpcf7-submit{
        background-color: <?php echo $hover_button_backgrond ?>;
        color: <?php echo $button_hover_color_text ?>;
<?php echo $btn_style_hover; ?>
    }

    #cf_<?php echo $form_id; ?> .dfd-contact-form-style-1 .wpcf7-submit{
    }
    /*select*/
    #cf_<?php echo $form_id; ?> .dk-selected{
<?php echo $show_border; ?>
        position: relative;
        background-color: <?php echo esc_attr($input_background); ?>;
        border-radius: <?php echo $border_radius; ?>px;
    }
    #cf_<?php echo $form_id; ?> .dk_container{
<?php echo $show_border; ?>
        position: relative;
        z-index: 1;
        background-color: <?php echo esc_attr($input_background); ?>;
        margin-bottom: 0px;
        vertical-align: middle;
        display: table-cell !important;
        border-radius: <?php echo $border_radius; ?>px;
        margin-top: 0px;
		width: 100%;
    }
	#cf_<?php echo $form_id; ?> .dk_container a,
	#cf_<?php echo $form_id; ?> .dk-select a{
		<?php echo $input_font;?>
	}
    #cf_<?php echo $form_id; ?> .dk_container .dk_toggle{
        height: 47px;
        line-height: 21px;
		color:<?php echo $text_color; ?>;
		
    }
    #cf_<?php echo $form_id; ?> .dk_open .dk_options,
    #cf_<?php echo $form_id; ?> .dk-select-open-down .dk-select-options,
    #cf_<?php echo $form_id; ?> .dk-select-open-up .dk-select-options{
        /*top: 40px !important;*/
    }

    /*ajax loader*/
    #cf_<?php echo $form_id; ?> img.ajax-loader{
        float: right;
        top: 19px;
        right: 5px;
        position: absolute;
        z-index: 59;
        border: none !important;
    }   
    
<!--    #cf_<?php echo $form_id; ?> div.wpcf7-validation-errors{
        margin-top: 10px;
        background: linear-gradient(-45deg, rgba(0, 0, 0, 0) 45%, #f2f2f2 37.9%, #f2f2f2 83.4%, rgba(0, 0, 0, 0) 88% ), linear-gradient(-45deg, #f2f2f2 30%, rgba(0, 0, 0, 0) 12% );
        background-size: 15px 15px;
        background-color: rgba(255, 255, 255, 0);
        border: none;
        font-family: 'Lora';
        color: #4F4F4F;
		display:none;
        padding: 10px 10px 10px 18px;
       
    }-->
    #cf_<?php echo $form_id; ?> .wpcf7-response-output{
        margin: 0;
    }
    #cf_<?php echo $form_id; ?> .recaptcha{
        /*float: left;*/
		margin-top: 6px;
    }

<?php $css = ob_get_clean(); ?>
<?php
$css = dfd_normalize_css($css);
?>
<script type="text/javascript">
	(function($){
		try {
			global_dfd.init($)
			dfdreCaptcha.el = [
			];
			dfdreCaptcha.widgets = [
			];
			dfdreCaptcha.show();

			$('form.wpcf7-form select').dropkick();
		} catch(e) {
		}
		$('head').append('<style type="text/css"><?php echo esc_js($css); ?></style>');
	})(jQuery);
</script>

<?php
$form = new Dfd_Simple_FormDecorator(
		  new Dfd_ButtonDecorator(
		  new Main_Form_Decorator()
		  )
);
echo $form->generate($content);
?>

