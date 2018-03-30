<link href="<?php echo get_template_directory_uri(); ?>/includes/demopanel/demo.panel.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/framework/admin/js/mColorPicker.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/framework/admin/js/jquery.cookie.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
	var mtheme_uri="<?php echo get_template_directory_uri(); ?>";
	jQuery.fn.mColorPicker.init.showLogo = false;
	jQuery.fn.mColorPicker.defaults.imageFolder = mtheme_uri + "/framework/admin/images/colorpicker/";
/* ]]> */
</script>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function(){
	jQuery('#demopanel .closedemo').click(function() {

		 jQuery('#demopanel .closedemo').css('display', 'none');
		 jQuery('#demopanel .opendemo').css('display', 'block');
		 jQuery('#demopanel').stop().animate({opacity: 1, left: '-130'}, 250 );
	});
	jQuery('#demopanel .opendemo').click(function() {

		 jQuery('#demopanel .closedemo').css('display', 'block');
		 jQuery('#demopanel .opendemo').css('display', 'none');
		 jQuery('#demopanel').stop().animate({opacity: 1, left: '0'}, 250 );
	});
	
	
	if ( (jQuery.cookie('themeBG') != null))	{
		jQuery('body').attr("style",jQuery.cookie('themeBG'));
	}
	
    jQuery('a.demo_pattern').click( function() {
        var divId = $(this).attr('id');
		divId=divId.replace('-', '.');
		jQuery("body").removeAttr("style").attr("style","background-image:url(<?php echo get_template_directory_uri(); ?>/images/backgrounds/" + divId + ");");
		jQuery.cookie('themeBG',"background-image:url(<?php echo get_template_directory_uri(); ?>/images/backgrounds/" + divId + ")",{ expires: 7, path: '/'});
	  	return false;
    });
	
	jQuery("#patterndelete").click(function(){
		jQuery.cookie('themeBG',null,{expires: 7, path: '/'});
        return false;
	});

	
});
/* ]]> */
</script>
<div id="demopanel">
	<div class="demo_toggle closedemo"><img src="<?php echo get_template_directory_uri(); ?>/includes/demopanel/images/close.png" alt="demo toggle" /></div>
	<div class="demo_toggle opendemo"><img src="<?php echo get_template_directory_uri(); ?>/includes/demopanel/images/open.png" alt="demo toggle" /></div>
	<div class="paneloptions">
	<form action="#" id="demoform" method="get">
		<h3><img src="<?php echo get_template_directory_uri(); ?>/includes/demopanel/images/eyedropper_12x12.png" alt="demoicon" /> Theme Style</h3>
		
			<select class="selectmenu" name="demo_theme_style">
				<option title="Light theme" value="light" <?php if ( $_SESSION['demo_theme_style']=="light") echo " selected"; ?>>Light</option>
				<option title="Dark theme" value="dark" <?php if ( $_SESSION['demo_theme_style']=="dark") echo " selected"; ?>>Dark</option>
			</select>
			
		<div class="clear"></div>
		<h3><img src="<?php echo get_template_directory_uri(); ?>/includes/demopanel/images/eyedropper_12x12.png" alt="demoicon" /> Backgrounds</h3>
		
<input class="colorselector_big" value="<?php echo $_SESSION['demo_header_color']; ?>" name="demo_header_color" type="color" data-hex="true" />
			
<div class="clear"></div>

<div class="demo_background">		
	<a href="#" class="demo_pattern" id="pattern1-png"></a>
	<a href="#" class="demo_pattern" id="pattern2-png"></a>
	<a href="#" class="demo_pattern" id="pattern3-png"></a>
	<a href="#" class="demo_pattern" id="pattern4-png"></a>
	<a href="#" class="demo_pattern" id="pattern5-png"></a>
	<a href="#" class="demo_pattern" id="pattern6-png"></a>
	<a href="#" class="demo_pattern" id="pattern7-png"></a>
	<a href="#" class="demo_pattern" id="pattern8-png"></a>
	<a href="#" class="demo_pattern" id="pattern9-png"></a>
	<a href="#" class="demo_pattern" id="pattern10-png"></a>
	<a href="#" class="demo_pattern" id="pattern11-png"></a>
	<a href="#" class="demo_pattern" id="pattern12-png"></a>
	<a href="#" class="demo_pattern" id="pattern13-png"></a>
	<a href="#" class="demo_pattern" id="pattern14-png"></a>
	<a href="#" class="demo_pattern" id="pattern15-png"></a>
	<a href="#" class="demo_pattern" id="pattern16-png"></a>
	<a href="#" class="demo_pattern" id="pattern17-png"></a>
	<a href="#" class="demo_pattern" id="pattern18-png"></a>
	<a href="#" class="demo_pattern" id="pattern19-png"></a>
	<a href="#" class="demo_pattern" id="pattern20-png"></a>
	<a href="#" class="demo_pattern" id="pattern21-png"></a>

	<a href="#" class="demo_pattern" id="darkwood-jpg"></a>
	<a href="#" class="demo_pattern" id="wood-jpg"></a>
	<a href="#" class="demo_pattern" id="sand-jpg"></a>
	<a href="#" class="demo_pattern" id="metal1-jpg"></a>
	<a href="#" class="demo_pattern" id="metal2-jpg"></a>
	<a href="#" class="demo_pattern" id="grains1-jpg"></a>
	<a href="#" class="demo_pattern" id="rainbow-jpg"></a>
	<a href="#" class="demo_pattern" id="paint1-jpg"></a>
	<a href="#" class="demo_pattern" id="paint2-jpg"></a>
	<a href="#" class="demo_pattern" id="paint3-jpg"></a>
	<a href="#" class="demo_pattern" id="paint4-jpg"></a>
</div>

		<div class="clear"></div>
		

		<h3><img src="<?php echo get_template_directory_uri(); ?>/includes/demopanel/images/heart_fill_12x11.png" alt="demoicon" /> Featured</h3>
			<select class="selectmenu" name="demo_featured">
				<option title="Showcase with Thumbnails" value="showcase" <?php if ( $_SESSION['demo_featured']=="showcase") echo " selected"; ?>>Showcase</option>
				<option title="Accordion Slides" value="accordion" <?php if ( $_SESSION['demo_featured']=="accordion") echo " selected"; ?>>Accordion</option>
				<option title="nivo Slides" value="nivoslides" <?php if ( $_SESSION['demo_featured']=="nivoslides") echo " selected"; ?>>Nivo Slides</option>
				<option title="Video Block" value="video" <?php if ( $_SESSION['demo_featured']=="video") echo " selected"; ?>>Video Block</option>
				<option title="Image Block" value="image" <?php if ( $_SESSION['demo_featured']=="video") echo " selected"; ?>>Static image</option>
			</select>
		<div class="clear"></div>
		<button id="demobutton" title="Apply" type="submit">Apply</button>
	</form>
	
	</div>

</div>