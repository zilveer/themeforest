<?php
	
	// Require config
	require_once('config.php');

	// Kill user if not logged in and can edit posts
	if ( !is_user_logged_in() || !current_user_can('edit_posts') ) wp_die(__('You are not allowed to access this page', 'swiftframework'));
	
	$icon_list = sf_get_icons_list();
?>

<!-- Swift Framework Shortcode Panel -->

<!-- OPEN html -->
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- OPEN head -->
	<head>
		
		<!-- Title & Meta -->
		<title><?php _e('Swift Framework Shortcodes', 'swiftframework');?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />

		<!-- LOAD scripts -->
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/jquery/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/includes/swift-framework/sf-shortcodes/sf.shortcodes.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/includes/swift-framework/sf-shortcodes/sf.shortcode.embed.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>

		<base target="_self" />
		<link href="<?php echo get_template_directory_uri() ?>/includes/swift-framework/sf-shortcodes/base.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo get_template_directory_uri() ?>/includes/swift-framework/sf-shortcodes/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo get_template_directory_uri() ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

	<!-- CLOSE head -->
	</head>

	<!-- OPEN body -->
	<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" id="link" >
		
		<!-- OPEN swiftframework_shortcode_form -->
		<form name="swiftframework_shortcode_form" action="#">

			<!-- OPEN #shortcode_wrap -->
			<div id="shortcode_wrap">

				<!-- CLOSE #shortcode_panel -->
				<div id="shortcode_panel" class="current">

					<fieldset>

						<h4><?php _e('Select a shortcode', 'swiftframework');?></h4>
						<div class="option">
							<label for="shortcode-select"><?php _e('Shortcode', 'swiftframework');?></label>
							<select id="shortcode-select" name="shortcode-select">
								<option value="0"></option>
								<option value="shortcode-buttons"><?php _e('Button', 'swiftframework');?></option>
								<option value="shortcode-chart"><?php _e('Chart', 'swiftframework');?></option>
								<option value="shortcode-columns"><?php _e('Columns', 'swiftframework');?></option>
								<option value="shortcode-icons"><?php _e('Icons', 'swiftframework');?></option>
								<option value="shortcode-imagebanner"><?php _e('Image Banner', 'swiftframework'); ?></option>
								<option value="shortcode-labelledpricingtables"><?php _e('Labelled Pricing Table', 'swiftframework');?></option>
								<option value="shortcode-lists"><?php _e('Lists', 'swiftframework');?></option>
								<option value="shortcode-modal"><?php _e('Modal', 'swiftframework');?></option>
								<option value="shortcode-pricingtables"><?php _e('Pricing Table', 'swiftframework');?></option>
								<option value="shortcode-progressbar"><?php _e('Progress Bar', 'swiftframework');?></option>
								<option value="shortcode-responsivevis"><?php _e('Responsive Visiblity', 'swiftframework');?></option>
								<option value="shortcode-social"><?php _e('Social', 'swiftframework');?></option>
								<option value="shortcode-share"><?php _e('Share', 'swiftframework');?></option>
								<option value="shortcode-tables"><?php _e('Table', 'swiftframework');?></option>
								<option value="shortcode-tooltip"><?php _e('Tooltip', 'swiftframework');?></option>
								<option value="shortcode-typography"><?php _e('Typography', 'swiftframework');?></option>
							</select>
						</div>

					
						<!--//////////////////////////////
						////	BUTTONS
						//////////////////////////////-->

						<div id="shortcode-buttons">
							<h5><?php _e('Buttons', 'swiftframework');?></h5>
							<div class="option">
								<label for="button-size"><?php _e('Button size', 'swiftframework');?></label>
								<select id="button-size" name="button-size">
									<option value="0"></option>
									<option value="small"><?php _e('Small', 'swiftframework');?></option>
									<option value="medium"><?php _e('Medium', 'swiftframework');?></option>
									<option value="large"><?php _e('Large', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="button-colour"><?php _e('Button colour', 'swiftframework');?></label>
								<select id="button-colour" name="button-colour">
									<option value="0"></option>
									<option value="accent"><?php _e('Accent', 'swiftframework');?></option>
									<option value="black"><?php _e('Black', 'swiftframework');?></option>
									<option value="white"><?php _e('White', 'swiftframework');?></option>
									<option value="grey"><?php _e('Grey', 'swiftframework');?></option>
									<option value="lightgrey"><?php _e('Light Grey', 'swiftframework');?></option>
									<option value="purple"><?php _e('Purple', 'swiftframework');?></option>
									<option value="lightblue"><?php _e('Light Blue', 'swiftframework');?></option>
									<option value="green"><?php _e('Green', 'swiftframework');?></option>
									<option value="limegreen"><?php _e('Lime Green', 'swiftframework');?></option>
									<option value="turquoise"><?php _e('Turquoise', 'swiftframework');?></option>
									<option value="pink"><?php _e('Pink', 'swiftframework');?></option>
									<option value="orange"><?php _e('Orange', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="button-type"><?php _e('Button type', 'swiftframework');?></label>
								<select id="button-type" name="button-type">
									<option value="0"></option>
									<option value="standard"><?php _e('Standard', 'swiftframework');?></option>
									<option value="squarearrow"><?php _e('Square with arrow', 'swiftframework');?></option>
									<option value="slightlyrounded"><?php _e('Slightly rounded', 'swiftframework');?></option>
									<option value="slightlyroundedarrow"><?php _e('Slightly rounded with arrow', 'swiftframework');?></option>
									<option value="rounded"><?php _e('Rounded', 'swiftframework');?></option>
									<option value="roundedarrow"><?php _e('Rounded with arrow', 'swiftframework');?></option>
									<option value="outerglow"><?php _e('Outer glow effect', 'swiftframework');?></option>
									<option value="dropshadow"><?php _e('Drop shadow effect', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="button-text"><?php _e('Button text', 'swiftframework');?></label>
								<input id="button-text" name="button-text" type="text" value="<?php _e('Button text', 'swiftframework');?>"/>
							</div>
							<div class="option">
								<label for="button-url"><?php _e('Button URL', 'swiftframework');?></label>
								<input id="button-url" name="button-url" type="text" value="http://"/>
							</div>
							<div class="option">
								<label for="button-target" class="for-checkbox"><?php _e('Open link in a new window?', 'swiftframework');?></label>
								<input id="button-target" class="checkbox" name="button-target" type="checkbox"/>
							</div>
						</div>


						<!--//////////////////////////////
						////	ICONS
						//////////////////////////////-->

						<div id="shortcode-icons">
							<h5><?php _e('Icons', 'swiftframework');?></h5>
							<div class="option">
								<label for="icon-size"><?php _e('Icon size', 'swiftframework');?></label>
								<select id="icon-size" name="icon-size">
									<option value="0"></option>
									<option value="small"><?php _e('Small', 'swiftframework');?></option>
									<option value="medium"><?php _e('Medium', 'swiftframework');?></option>
									<option value="large"><?php _e('Large', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="icon-image"><?php _e('Icon image', 'swiftframework');?></label>
								<input id="icon-image" name="icon-image" type="text" value="" style="visibility: hidden;"/>
								<ul class="font-icon-grid"><?php echo $icon_list; ?></ul>
							</div>
							<div class="option">
								<label for="icon-cont"><?php _e('Circular container', 'swiftframework');?></label>
								<select id="icon-cont" name="icon-cont">
									<option value="no"><?php _e('No', 'swiftframework');?></option>
									<option value="yes"><?php _e('Yes', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="icon-float"><?php _e('Icon float', 'swiftframework');?></label>
								<select id="icon-float" name="icon-float">
									<option value="left"><?php _e('Left', 'swiftframework');?></option>
									<option value="right"><?php _e('Right', 'swiftframework');?></option>
									<option value="none"><?php _e('None', 'swiftframework');?></option>
								</select>
							</div>
						</div>

						
						<!--//////////////////////////////
						////	IMAGE BANNER
						//////////////////////////////-->
	
						<div id="shortcode-imagebanner" class="shortcode-option">
							<h5><?php _e('Image Banner', "swiftframework"); ?></h5>
							<div class="option">
								<label for="imagebanner-image"><?php _e('Background Image', "swiftframework"); ?></label>
								<input id="imagebanner-image" name="imagebanner-image" type="text" value=""/>
								<p class="info">Provide the URL here for the background image that you would like to use.</p>
							</div>
							<div class="option">
								<label for="imagebanner-animation"><?php _e('Content Animation', "swiftframework"); ?></label>
								<select id="imagebanner-animation" name="imagebanner-animation">
									<option value="none"><?php _e('None', "swiftframework"); ?></option>
									<option value="fade-in"><?php _e('Fade in', "swiftframework"); ?></option>
									<option value="fade-from-left"><?php _e('Fade from left', "swiftframework"); ?></option>
									<option value="fade-from-right"><?php _e('Fade from right', "swiftframework"); ?></option>
									<option value="fade-from-bottom"><?php _e('Fade from bottom', "swiftframework"); ?></option>
									<option value="move-up"><?php _e('Move up', "swiftframework"); ?></option>
									<option value="grow"><?php _e('Grow', "swiftframework"); ?></option>
									<option value="helix"><?php _e('Helix', "swiftframework"); ?></option>	
									<option value="flip"><?php _e('Flip', "swiftframework"); ?></option>	
									<option value="pop-up"><?php _e('Pop up', "swiftframework"); ?></option>	
									<option value="spin"><?php _e('Spin', "swiftframework"); ?></option>	
									<option value="flip-x"><?php _e('Flip X', "swiftframework"); ?></option>	
									<option value="flip-y"><?php _e('Flip Y', "swiftframework"); ?></option>	
								</select>
								<p class="info">Choose the intro animation for the content.</p>
							</div>
							<div class="option">
								<label for="imagebanner-contentpos"><?php _e('Content Position', "swiftframework"); ?></label>
								<select id="imagebanner-contentpos" name="imagebanner-contentpos">
									<option value="left"><?php _e('Left', "swiftframework"); ?></option>
									<option value="center"><?php _e('Center', "swiftframework"); ?></option>
									<option value="right"><?php _e('Right', "swiftframework"); ?></option>
								</select>
								<p class="info">Choose the alignment for the content.</p>
							</div>
							<div class="option">
								<label for="imagebanner-textalign"><?php _e('Text Align', "swiftframework"); ?></label>
								<select id="imagebanner-textalign" name="imagebanner-textalign">
									<option value="left"><?php _e('Left', "swiftframework"); ?></option>
									<option value="center"><?php _e('Center', "swiftframework"); ?></option>
									<option value="right"><?php _e('Right', "swiftframework"); ?></option>
								</select>
								<p class="info">Choose the alignment for the text within the content.</p>
							</div>
							<div class="option">
								<label for="imagebanner-extraclass"><?php _e('Extra class', "swiftframework"); ?></label>
								<input id="imagebanner-extraclass" name="imagebanner-extraclass" type="text" value=""/>
								<p class="info">Provide any extra classes you'd like to add here (optional).</p>
							</div>
						</div>
						

						<!--//////////////////////////////
						////	SOCIAL
						//////////////////////////////-->

						<div id="shortcode-social">
							<h5><?php _e('Social', 'swiftframework');?></h5>
							<div class="option">
								<label for="social-size"><?php _e('Social Icon Size', 'swiftframework');?></label>
								<select id="social-size" name="social-size">
									<option value="standard"><?php _e('Standard', 'swiftframework');?></option>
									<option value="small"><?php _e('Small', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="social-style"><?php _e('Social Icon Style', 'swiftframework');?></label>
								<select id="social-style" name="social-style">
									<option value="colour"><?php _e('Colour', 'swiftframework');?></option>
									<option value="light"><?php _e('Light', 'swiftframework');?></option>
									<option value="dark"><?php _e('Dark', 'swiftframework');?></option>
								</select>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	SOCIAL SHARE
						//////////////////////////////-->
						
						<div id="shortcode-share" class="shortcode-option">
						    <h5><?php _e( 'Social share', "swiftframework" ); ?></h5>
						
						    <div class="option">
						        <p class="info">This shortcode will embed the social share links asset, for sharing the current post/page on
						            social media.</p>
						    </div>
						</div>


						<!--//////////////////////////////
						////	TYPOGRAPHY
						//////////////////////////////-->

						<div id="shortcode-typography">
							<h5><?php _e('Typography', 'swiftframework');?></h5>
							<div class="option">
								<label for="typography-type"><?php _e('Type', 'swiftframework');?></label>
								<select id="typography-type" name="typography-type">
									<option value="0"></option>
									<option value="highlight"><?php _e('Highlight', 'swiftframework');?></option>
									<option value="decorative_ampersand"><?php _e('Decorative Ampersand', 'swiftframework');?></option>
									<option value="blockquote1"><?php _e('Blockquote Standard', 'swiftframework');?></option>
									<option value="blockquote2"><?php _e('Blockquote Medium', 'swiftframework');?></option>
									<option value="blockquote3"><?php _e('Blockquote Big', 'swiftframework');?></option>
									<option value="pullquote"><?php _e('Pull Quote', 'swiftframework');?></option>
									<option value="dropcap1"><?php _e('Dropcap Type 1', 'swiftframework');?></option>
									<option value="dropcap2"><?php _e('Dropcap Type 2', 'swiftframework');?></option>
									<option value="dropcap3"><?php _e('Dropcap Type 3', 'swiftframework');?></option>
									<option value="dropcap4"><?php _e('Dropcap Type 4', 'swiftframework');?></option>
								</select>
							</div>
						</div>


						<!--//////////////////////////////
						////	COLUMNS
						//////////////////////////////-->

						<div id="shortcode-columns" class="shortcode-option">
							<h5><?php _e('Columns', 'swiftframework');?></h5>
							<div class="option">
								<label for="column-options"><?php _e('Layout', 'swiftframework');?></label>
								<select id="column-options" name="column-options">
									<option value="0"></option>
									<option value="two_halves"><?php _e('1/2 + 1/2', 'swiftframework');?></option>
									<option value="three_thirds"><?php _e('1/3 + 1/3 + 1/3', 'swiftframework');?></option>
									<option value="one_third_two_thirds"><?php _e('1/3 + 2/3', 'swiftframework');?></option>
									<option value="two_thirds_one_third"><?php _e('2/3 + 1/3', 'swiftframework');?></option>
									<option value="four_quarters"><?php _e('1/4 + 1/4 + 1/4 + 1/4', 'swiftframework');?></option>
									<option value="one_quarter_three_quarters"><?php _e('1/4 + 3/4', 'swiftframework');?></option>
									<option value="three_quarters_one_quarter"><?php _e('3/4 + 1/4', 'swiftframework');?></option>
									<option value="one_quarter_one_quarter_one_half"><?php _e('1/4 + 1/4 + 1/2', 'swiftframework');?></option>
									<option value="one_quarter_one_half_one_quarter"><?php _e('1/4 + 1/2 + 1/4', 'swiftframework');?></option>
									<option value="one_half_one_quarter_one_quarter"><?php _e('1/2 + 1/4 + 1/4', 'swiftframework');?></option>
								</select>
							</div>
						</div>
						
						<!--//////////////////////////////
						////	PROGRESS BAR
						//////////////////////////////-->

						<div id="shortcode-progressbar" class="shortcode-option">
							<h5><?php _e('Progress Bar', 'swiftframework');?></h5>
							<div class="option">
								<label for="progressbar-percentage"><?php _e('Percentage', 'swiftframework');?></label>
								<input id="progressbar-percentage" name="progressbar-percentage" type="text" value=""/>
								<p class="info">Enter the percentage of the progress bar.</p>
							</div>
							<div class="option">
								<label for="progressbar-text"><?php _e('Progress Text', 'swiftframework');?></label>
								<input id="progressbar-text" name="progressbar-text" type="text" value=""/>
								<p class="info">Enter the text that you'd like shown on the bar, i.e. "COMPLETED".</p>
							</div>
							<div class="option">
								<label for="progressbar-value"><?php _e('Progress Value', 'swiftframework');?></label>
								<input id="progressbar-value" name="progressbar-value" type="text" value=""/>
								<p class="info">Enter value that you'd like shown on the bar, i.e. "90%".</p>
							</div>
							<div class="option">
								<label for="progressbar-type"><?php _e('Progress Bar Type', 'swiftframework');?></label>
								<select id="progressbar-type" name="progressbar-type">
									<option value=""><?php _e('Standard', 'swiftframework');?></option>
									<option value="progress-striped"><?php _e('Striped', 'swiftframework');?></option>
									<option value="progress-striped active"><?php _e('Striped - Animated', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="progressbar-colour"><?php _e('Progress Bar Colour', 'swiftframework');?></label>
								<input id="progressbar-colour" name="progressbar-colour" type="text" value=""/>
								<p class="info">Enter the hex value (with the #) for the progress bar colour, or it will default to accent colour.</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	RESPONSIVE VISIBILIY
						//////////////////////////////-->

						<div id="shortcode-responsivevis" class="shortcode-option">
							<h5><?php _e('Responsive Visibility', 'swiftframework');?></h5>
							<div class="option">
								<label for="responsivevis-config"><?php _e('Device Visiblity', 'swiftframework');?></label>
								<select id="responsivevis-config" name="responsivevis-config">
									<option value="visible-phone"><?php _e('Visible - Phone', 'swiftframework');?></option>
									<option value="visible-tablet"><?php _e('Visible - Tablet', 'swiftframework');?></option>
									<option value="visible-desktop"><?php _e('Visible - Desktop', 'swiftframework');?></option>
									<option value="hidden-phone"><?php _e('Hidden - Phone', 'swiftframework');?></option>
									<option value="hidden-tablet"><?php _e('Hidden - Tablet', 'swiftframework');?></option>
									<option value="hidden-desktop"><?php _e('Hidden - Desktop', 'swiftframework');?></option>
								</select>
								<p class="info">Choose the responsive visibility for the content within the shortcode.</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	TOOLTIP
						//////////////////////////////-->

						<div id="shortcode-tooltip" class="shortcode-option">
							<h5><?php _e('Tooltip', 'swiftframework');?></h5>
							<div class="option">
								<label for="tooltip-text"><?php _e('Text', 'swiftframework');?></label>
								<input id="tooltip-text" name="tooltip-text" type="text" value=''/>
								<p class="info">Enter the text for the tooltip.</p>
							</div>
							<div class="option">
								<label for="tooltip-link"><?php _e('Link', 'swiftframework');?></label>
								<input id="tooltip-link" name="tooltip-link" type="text" value=""/>
								<p class="info">Enter the link that the tooltip text links to.</p>
							</div>
							<div class="option">
								<label for="tooltip-direction"><?php _e('Direction', 'swiftframework');?></label>
								<select id="tooltip-direction" name="tooltip-direction">
									<option value="top"><?php _e('Top', 'swiftframework');?></option>
									<option value="bottom"><?php _e('Bottom', 'swiftframework');?></option>
									<option value="left"><?php _e('Left', 'swiftframework');?></option>
									<option value="right"><?php _e('Right', 'swiftframework');?></option>
								</select>
								<p class="info">Choose the direction in which the tooltip appears.</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	MODAL
						//////////////////////////////-->

						<div id="shortcode-modal" class="shortcode-option">
							<h5><?php _e('Modal', 'swiftframework');?></h5>
							<div class="option">
								<label for="modal-button-size"><?php _e('Modal Button size', 'swiftframework');?></label>
								<select id="modal-button-size" name="modal-button-size">
									<option value="small"><?php _e('Small', 'swiftframework');?></option>
									<option value="medium"><?php _e('Medium', 'swiftframework');?></option>
									<option value="large"><?php _e('Large', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="modal-button-colour"><?php _e('Modal Button colour', 'swiftframework');?></label>
								<select id="modal-button-colour" name="modal-button-colour">
									<option value="accent"><?php _e('Accent', 'swiftframework');?></option>
									<option value="black"><?php _e('Black', 'swiftframework');?></option>
									<option value="white"><?php _e('White', 'swiftframework');?></option>
									<option value="grey"><?php _e('Grey', 'swiftframework');?></option>
									<option value="lightgrey"><?php _e('Light Grey', 'swiftframework');?></option>
									<option value="purple"><?php _e('Purple', 'swiftframework');?></option>
									<option value="lightblue"><?php _e('Light Blue', 'swiftframework');?></option>
									<option value="green"><?php _e('Green', 'swiftframework');?></option>
									<option value="limegreen"><?php _e('Lime Green', 'swiftframework');?></option>
									<option value="turquoise"><?php _e('Turquoise', 'swiftframework');?></option>
									<option value="pink"><?php _e('Pink', 'swiftframework');?></option>
									<option value="orange"><?php _e('Orange', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="modal-button-type"><?php _e('Modal Button type', 'swiftframework');?></label>
								<select id="modal-button-type" name="modal-button-type">
									<option value="standard"><?php _e('Standard', 'swiftframework');?></option>
									<option value="squarearrow"><?php _e('Square with arrow', 'swiftframework');?></option>
									<option value="slightlyrounded"><?php _e('Slightly rounded', 'swiftframework');?></option>
									<option value="slightlyroundedarrow"><?php _e('Slightly rounded with arrow', 'swiftframework');?></option>
									<option value="rounded"><?php _e('Rounded', 'swiftframework');?></option>
									<option value="roundedarrow"><?php _e('Rounded with arrow', 'swiftframework');?></option>
									<option value="outerglow"><?php _e('Outer glow effect', 'swiftframework');?></option>
									<option value="dropshadow"><?php _e('Drop shadow effect', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="modal-button-text"><?php _e('Modal Button text', 'swiftframework');?></label>
								<input id="modal-button-text" name="modal-button-text" type="text" value="<?php _e('Button text', 'swiftframework');?>"/>
							</div>
							<div class="option">
								<label for="modal-header"><?php _e('Header', 'swiftframework');?></label>
								<input id="modal-header" name="modal-header" type="text" value=''/>
								<p class="info">Enter the heading for the modal popup.</p>
							</div>
						</div>					
										
												
						<!--//////////////////////////////
						////	CHART
						//////////////////////////////-->

						<div id="shortcode-chart" class="shortcode-option">
							<h5><?php _e('Chart', 'swiftframework');?></h5>
							<div class="option">
								<label for="chart-percentage"><?php _e('Percentage', 'swiftframework');?></label>
								<input id="chart-percentage" name="chart-percentage" type="text" value=""/>
								<p class="info">Enter the percentage of the chart value. NOTE: This must be between 0-100, numeric only.</p>
							</div>
							<div class="option">
								<label for="chart-content"><?php _e('Content', 'swiftframework');?></label>
								<input id="chart-content" name="chart-content" type="text" value=''/>
								<p class="info">Enter the content for the center of the chart, i.e. a number or percentage. NOTE: if you'd like to include a font awesome icon here, just enter the icon name, i.e. "fa-magic".</p>
							</div>
							<div class="option">
								<label for="chart-size"><?php _e('Chart Size', 'swiftframework');?></label>
								<select id="chart-size" name="chart-size">
									<option value="70"><?php _e('Standard', 'swiftframework');?></option>
									<option value="170"><?php _e('Large', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="chart-barcolour"><?php _e('Chart Bar Colour', 'swiftframework');?></label>
								<input id="chart-barcolour" name="chart-barcolour" type="text" value=""/>
								<p class="info">Enter the hex value (with the #) for the chart bar colour.</p>
							</div>
							<div class="option">
								<label for="chart-trackcolour"><?php _e('Chart Track Colour', 'swiftframework');?></label>
								<input id="chart-trackcolour" name="chart-trackcolour" type="text" value=""/>
								<p class="info">Enter the hex value (with the #) for the chart track colour (the path the bar follows).</p>
							</div>
							<div class="option">
								<label for="chart-align"><?php _e('Chart Align', 'swiftframework');?></label>
								<select id="chart-align" name="chart-align">
									<option value="left"><?php _e('Left', 'swiftframework');?></option>
									<option value="center"><?php _e('Center', 'swiftframework');?></option>
								</select>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	TABLE
						//////////////////////////////-->

						<div id="shortcode-tables" class="shortcode-option">
							<h5><?php _e('Tables', 'swiftframework');?></h5>
							<div class="option">
								<label for="table-type"><?php _e('Table style', 'swiftframework');?></label>
								<select id="table-type" name="table-type">
									<option value="standard_minimal"><?php _e('Standard minimal table', 'swiftframework');?></option>
									<option value="striped_minimal"><?php _e('Striped minimal table', 'swiftframework');?></option>
									<option value="standard_bordered"><?php _e('Standard bordered table', 'swiftframework');?></option>
									<option value="striped_bordered"><?php _e('Striped bordered table', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="table-head"><?php _e('Table Head', 'swiftframework');?></label>
								<select id="table-head" name="table-head">
									<option value="yes"><?php _e('Yes', 'swiftframework');?></option>
									<option value="no"><?php _e('No', 'swiftframework');?></option>
									<p class="info">Include a heading row in the table</p>
								</select>
							</div>
							<div class="option">
								<label for="table-columns"><?php _e('Number of columns', 'swiftframework');?></label>
								<select id="table-columns" name="table-columns">
									<option value="1"><?php _e('1', 'swiftframework');?></option>
									<option value="2"><?php _e('2', 'swiftframework');?></option>
									<option value="3"><?php _e('3', 'swiftframework');?></option>
									<option value="4"><?php _e('4', 'swiftframework');?></option>
									<option value="5"><?php _e('5', 'swiftframework');?></option>
									<option value="6"><?php _e('6', 'swiftframework');?></option>
								</select>
							</div>
							
							<div class="option">
								<label for="table-rows"><?php _e('Number of rows', 'swiftframework');?></label>
								<select id="table-rows" name="table-rows">
									<option value="1"><?php _e('1', 'swiftframework');?></option>
									<option value="2"><?php _e('2', 'swiftframework');?></option>
									<option value="3"><?php _e('3', 'swiftframework');?></option>
									<option value="4"><?php _e('4', 'swiftframework');?></option>
									<option value="5"><?php _e('5', 'swiftframework');?></option>
									<option value="6"><?php _e('6', 'swiftframework');?></option>
									<option value="7"><?php _e('7', 'swiftframework');?></option>
									<option value="8"><?php _e('8', 'swiftframework');?></option>
									<option value="9"><?php _e('9', 'swiftframework');?></option>
									<option value="10"><?php _e('10', 'swiftframework');?></option>
								</select>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	PRICING TABLE
						//////////////////////////////-->

						<div id="shortcode-pricingtables" class="shortcode-option">
							<h5><?php _e('Pricing Tables', 'swiftframework');?></h5>
							<div class="option">
								<label for="ptable-type"><?php _e('Table style', 'swiftframework');?></label>
								<select id="ptable-type" name="ptable-type">
									<option value="standard"><?php _e('Standard pricing table', 'swiftframework');?></option>
									<option value="bordered"><?php _e('Bordered pricing table', 'swiftframework');?></option>
									<option value="bordered_alt"><?php _e('Alt bordered pricing table', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="ptable-columns"><?php _e('Number of columns', 'swiftframework');?></label>
								<select id="ptable-columns" name="ptable-columns">
									<option value="1"><?php _e('1', 'swiftframework');?></option>
									<option value="2"><?php _e('2', 'swiftframework');?></option>
									<option value="3"><?php _e('3', 'swiftframework');?></option>
									<option value="4"><?php _e('4', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="ptable-highlight"><?php _e('Highlighted column', 'swiftframework');?></label>
								<select id="ptable-highlight" name="ptable-highlight">
									<option value="0"></option>
									<option value="1"><?php _e('1', 'swiftframework');?></option>
									<option value="2"><?php _e('2', 'swiftframework');?></option>
									<option value="3"><?php _e('3', 'swiftframework');?></option>
									<option value="4"><?php _e('4', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="ptable-buttontext"><?php _e('Button text', 'swiftframework');?></label>
								<input id="ptable-buttontext" name="ptable-buttontext" type="text" value=""/>
								<p class="info">Enter the button text here, or leave blank to hide the button.</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	LABELLED PRICING TABLE
						//////////////////////////////-->

						<div id="shortcode-labelledpricingtables" class="shortcode-option">
							<h5><?php _e('Labelled Pricing Table', 'swiftframework');?></h5>
							<div class="option">
								<label for="lptable-columns"><?php _e('Number of columns', 'swiftframework');?></label>
								<select id="lptable-columns" name="lptable-columns">
									<option value="1"><?php _e('1', 'swiftframework');?></option>
									<option value="2"><?php _e('2', 'swiftframework');?></option>
									<option value="3"><?php _e('3', 'swiftframework');?></option>
									<option value="4"><?php _e('4', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="lptable-highlight"><?php _e('Highlighted column', 'swiftframework');?></label>
								<select id="lptable-highlight" name="lptable-highlight">
									<option value="0"></option>
									<option value="1"><?php _e('1', 'swiftframework');?></option>
									<option value="2"><?php _e('2', 'swiftframework');?></option>
									<option value="3"><?php _e('3', 'swiftframework');?></option>
									<option value="4"><?php _e('4', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="lptable-rows"><?php _e('Number of rows', 'swiftframework');?></label>
								<select id="lptable-rows" name="lptable-highlight">
									<option value="1"><?php _e('1', 'swiftframework');?></option>
									<option value="2"><?php _e('2', 'swiftframework');?></option>
									<option value="3"><?php _e('3', 'swiftframework');?></option>
									<option value="4"><?php _e('4', 'swiftframework');?></option>
									<option value="5"><?php _e('5', 'swiftframework');?></option>
									<option value="6"><?php _e('6', 'swiftframework');?></option>
									<option value="7"><?php _e('7', 'swiftframework');?></option>
									<option value="8"><?php _e('8', 'swiftframework');?></option>
									<option value="9"><?php _e('9', 'swiftframework');?></option>
									<option value="10"><?php _e('10', 'swiftframework');?></option>
									<option value="11"><?php _e('11', 'swiftframework');?></option>
									<option value="12"><?php _e('12', 'swiftframework');?></option>
									<option value="13"><?php _e('13', 'swiftframework');?></option>
									<option value="14"><?php _e('14', 'swiftframework');?></option>
									<option value="15"><?php _e('15', 'swiftframework');?></option>
									<option value="16"><?php _e('16', 'swiftframework');?></option>
									<option value="17"><?php _e('17', 'swiftframework');?></option>
									<option value="18"><?php _e('18', 'swiftframework');?></option>
									<option value="19"><?php _e('19', 'swiftframework');?></option>
									<option value="20"><?php _e('20', 'swiftframework');?></option>
									<option value="21"><?php _e('21', 'swiftframework');?></option>
									<option value="22"><?php _e('22', 'swiftframework');?></option>
									<option value="23"><?php _e('23', 'swiftframework');?></option>
									<option value="24"><?php _e('24', 'swiftframework');?></option>
									<option value="25"><?php _e('25', 'swiftframework');?></option>
									<option value="26"><?php _e('26', 'swiftframework');?></option>
									<option value="27"><?php _e('27', 'swiftframework');?></option>
									<option value="28"><?php _e('28', 'swiftframework');?></option>
									<option value="29"><?php _e('29', 'swiftframework');?></option>
									<option value="30"><?php _e('30', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="lptable-buttontext"><?php _e('Button text', 'swiftframework');?></label>
								<input id="lptable-buttontext" name="lptable-buttontext" type="text" value=""/>
								<p class="info">Enter the button text here, or leave blank to hide the button.</p>
							</div>
						</div>						


						<!--//////////////////////////////
						////	LISTS
						//////////////////////////////-->

						<div id="shortcode-lists" class="shortcode-option">
							<h5><?php _e('Lists', 'swiftframework');?></h5>
							<div class="option">
								<label for="list-type"><?php _e('List type', 'swiftframework');?></label>
								<select id="list-type" name="list-type">
									<option value="add_bw"><?php _e('Add (B&W)', 'swiftframework');?></option>
									<option value="add"><?php _e('Add (Colour)', 'swiftframework');?></option>
									<option value="arrow_bw"><?php _e('Arrow (B&W)', 'swiftframework');?></option>
									<option value="arrow"><?php _e('Arrow (Colour)', 'swiftframework');?></option>
									<option value="article"><?php _e('Article', 'swiftframework');?></option>
									<option value="bar"><?php _e('Bar', 'swiftframework');?></option>
									<option value="bolt_bw"><?php _e('Bolt (B&W)', 'swiftframework');?></option>
									<option value="bolt"><?php _e('Bolt (Colour)', 'swiftframework');?></option>
									<option value="date"><?php _e('Date', 'swiftframework');?></option>
									<option value="delete_bw"><?php _e('Delete (B&W)', 'swiftframework');?></option>
									<option value="delete"><?php _e('Delete (Colour)', 'swiftframework');?></option>
									<option value="dot"><?php _e('Dot', 'swiftframework');?></option>
									<option value="like_bw"><?php _e('Like (B&W)', 'swiftframework');?></option>
									<option value="like"><?php _e('Like', 'swiftframework');?></option>
									<option value="pen"><?php _e('Pen', 'swiftframework');?></option>
									<option value="question_bw"><?php _e('Question mark (B&W)', 'swiftframework');?></option>
									<option value="question"><?php _e('Question mark (Colour)', 'swiftframework');?></option>
									<option value="settings_bw"><?php _e('Settings (B&W)', 'swiftframework');?></option>
									<option value="settings"><?php _e('Settings (Colour)', 'swiftframework');?></option>
									<option value="star_bw"><?php _e('Star (B&W)', 'swiftframework');?></option>
									<option value="star"><?php _e('Star (Colour)', 'swiftframework');?></option>
									<option value="tick_bw"><?php _e('Tick (B&W)', 'swiftframework');?></option>
									<option value="tick"><?php _e('Tick (Colour)', 'swiftframework');?></option>
									<option value="user"><?php _e('User', 'swiftframework');?></option>
									<option value="warning_bw"><?php _e('Warning (B&W)', 'swiftframework');?></option>
									<option value="warning"><?php _e('Warning', 'swiftframework');?></option>
								</select>
							</div>
							<div class="option">
								<label for="list-items"><?php _e('Number of list items', 'swiftframework');?></label>
								<select id="list-items" name="list-items">
									<option value="1"><?php _e('1', 'swiftframework');?></option>
									<option value="2"><?php _e('2', 'swiftframework');?></option>
									<option value="3"><?php _e('3', 'swiftframework');?></option>
									<option value="4"><?php _e('4', 'swiftframework');?></option>
									<option value="5"><?php _e('5', 'swiftframework');?></option>
									<option value="6"><?php _e('6', 'swiftframework');?></option>
									<option value="7"><?php _e('7', 'swiftframework');?></option>
									<option value="8"><?php _e('8', 'swiftframework');?></option>
									<option value="9"><?php _e('9', 'swiftframework');?></option>
									<option value="10"><?php _e('10', 'swiftframework');?></option>
									<p class="info">You can easily add more by duplicating the code after.</p>
								</select>
							</div>
						</div>

					</fieldset>

				<!-- CLOSE #shortcode_panel -->					
				</div>

				<div class="buttons clearfix">
					<input type="submit" id="insert" name="insert" value="<?php _e('Insert Shortcode', 'swiftframework');?>" onClick="embedSelectedShortcode();" />
				</div>

			<!-- CLOSE #shortcode_wrap -->
			</div>

		<!-- CLOSE swiftframework_shortcode_form -->
		</form>

	<!-- CLOSE body -->
	</body>

<!-- CLOSE html -->	
</html>
