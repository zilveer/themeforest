<?php global $unf_options; ?>
<style>
<?php
/* DYNAMIC CSS */

//REGULAR SIZED LOGO
if( !empty($unf_options['unf_reg_logo']['url'])){
echo "
#header .logo {
	  background-image: url(". esc_url($unf_options['unf_reg_logo']['url']).");
	  width: ".esc_attr($unf_options['unf_reg_logo']['width'])."px;
	  height: ".esc_attr($unf_options['unf_reg_logo']['height'])."px;
}
";
} else { ?>
#header .logo {
	  background-image: url('<?php echo get_template_directory_uri();?>/library/img/toddlerslogo.png');
	  width: 502px;
	  height: 191px;
}
<?php }
//RETINA LOGO
if( !empty($unf_options['unf_reg_logo']['url']) && ($unf_options['unf_ret_logo']['url'])) {
echo "
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
	  #header .logo {
	    background-image: url(". esc_url($unf_options['unf_ret_logo']['url']) .");
	    background-size: ". esc_attr($unf_options['unf_reg_logo']['width'])."px ". esc_attr($unf_options['unf_reg_logo']['height'])."px;
	  }
}
";
}
if( empty($unf_options['unf_reg_logo']['url'])) { ?>
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
	  #header .logo {
	    background-image: url("<?php echo get_template_directory_uri();?>/library/img/toddlerslogo@2x.png");
	    background-size: 502px 191px;
	  }
}
<?php }

//LOGO TOP MARGIN
if( isset($unf_options['unf_logo_top_margin'])) {
echo "#header .logo,#header .mobile-nologo {margin-top:".esc_attr($unf_options['unf_logo_top_margin'])."px;}";
}
//LOGO BOTTOM MARGIN
if( isset($unf_options['unf_logo_bottom_margin'])) {
echo "#header .logo,#header .mobile-nologo {margin-bottom:".esc_attr($unf_options['unf_logo_bottom_margin'])."px;}";
}

//REGULAR SIZED LEFT IMAGE
if( !empty($unf_options['unf_reg_leftimage']['url'])){
echo "
#header .headimg-left {
	  background-image: url(".esc_url($unf_options['unf_reg_leftimage']['url']).");
}
@media (max-width: 991px) { #header .headimg-left {background-size: contain;}}
";
} else { ?>
#header .headimg-left {
background-image: url('<?php echo get_template_directory_uri();?>/library/img/headimg-left.png');
}
@media (max-width: 991px) {	#header .headimg-left {background-size: contain;}}
<?php }
//RETINA LEFT IMAGE
if( !empty($unf_options['unf_reg_leftimage']['url']) && ($unf_options['unf_ret_leftimage']['url'])) {
echo "
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
#header .headimg-left {
	    background-image: url(".esc_url($unf_options['unf_ret_leftimage']['url']).");
	    background-size: ".esc_attr($unf_options['unf_reg_leftimage']['width'])."px ".esc_attr($unf_options['unf_reg_leftimage']['height'])."px;
	  }
}
@media (max-width: 991px) {
	#header .headimg-left {background-size: contain;}
}
";
}
if( empty($unf_options['unf_reg_leftimage']['url'])) { ?>
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
	  #header .headimg-left {
	    background-image: url('<?php echo get_template_directory_uri();?>/library/img/headimg-left@2x.png');
	    background-size: 263px 141px;
	  }
}
@media (max-width: 991px) {	#header .headimg-left {background-size: contain;}}
<?php }



//REGULAR SIZED RIGHT IMAGE
if( !empty($unf_options['unf_reg_rightimage']['url'])){
echo "
#header .headimg-right {
	  background-image: url(".esc_url($unf_options['unf_reg_rightimage']['url']).");
}
@media (max-width: 991px) {
	#header .headimg-right {background-size: contain;}
}
";
} else { ?>
#header .headimg-right {
background-image: url('<?php echo get_template_directory_uri();?>/library/img/headimg-right.png');
}
@media (max-width: 991px) { #header .headimg-right {background-size: contain;}}
<?php }
//RETINA RIGHT IMAGE
if( !empty($unf_options['unf_reg_rightimage']['url']) && ($unf_options['unf_ret_rightimage']['url'])) {
echo "
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
#header .headimg-right {
	    background-image: url(".esc_url($unf_options['unf_ret_rightimage']['url']).");
	    background-size: ".esc_attr($unf_options['unf_reg_rightimage']['width'])."px ".esc_attr($unf_options['unf_reg_rightimage']['height'])."px;
	  }
}
@media (max-width: 991px) {#header .headimg-right {background-size: contain;}}
";
}
if( empty($unf_options['unf_reg_rightimage']['url'])) { ?>
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
	  #header .headimg-right {
	    background-image: url('<?php echo get_template_directory_uri();?>/library/img/headimg-right@2x.png');
	    background-size: 305px 147px;
	  }
}
@media (max-width: 991px) { #header .headimg-right {background-size: contain;}}
<?php }





//FOOTER IMAGE LEFT
if( !empty($unf_options['unf_reg_footerleftimage']['url'])){
echo "
.newlandscape .onleft {
	  background-image: url(".esc_url($unf_options['unf_reg_footerleftimage']['url']).");
}
";
} else { ?>
.newlandscape .onleft {
background-image: url('<?php echo get_template_directory_uri();?>/library/img/onleft.png');
}
<?php }

//FOOTER RETINA IMAGE LEFT
if( !empty($unf_options['unf_reg_footerleftimage']['url']) && ($unf_options['unf_ret_footerleftimage']['url'])) {
echo "
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
.newlandscape .onleft {
	    background-image: url(".esc_url($unf_options['unf_ret_footerleftimage']['url']).");
	  }
}
";
}
if( empty($unf_options['unf_reg_footerleftimage']['url'])) { ?>
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
	  .newlandscape .onleft {
	    background-image: url('<?php echo get_template_directory_uri();?>/library/img/onleft@2x.png');
	  }
}
<?php }

//FOOTER IMAGE RIGHT
if( !empty($unf_options['unf_reg_footerrightimage']['url'])){
echo "
.newlandscape .onright {
	  background-image: url(".esc_url($unf_options['unf_reg_footerrightimage']['url']).");
}
";
} else { ?>
.newlandscape .onright {
background-image: url('<?php echo get_template_directory_uri();?>/library/img/onright.png');
}
<?php }
//FOOTER RETINA IMAGE RIGHT
if( !empty($unf_options['unf_reg_footerrightimage']['url']) && ($unf_options['unf_ret_footerrightimage']['url'])) {
echo "
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
.newlandscape .onright {
	    background-image: url(".esc_url($unf_options['unf_ret_footerrightimage']['url']).");
	  }
}
";
}
if( empty($unf_options['unf_reg_footerrightimage']['url'])) { ?>
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
	  .newlandscape .onright {
	    background-image: url('<?php echo get_template_directory_uri();?>/library/img/onright@2x.png');
	  }
}
<?php }



//GRASS HEADER IMAGE
if( !empty($unf_options['unf_reg_grassimage']['url'])){
$grassheight = $unf_options['unf_reg_grassimage']['height'];

echo "
#header .grass {
	  background-image: url(".esc_url($unf_options['unf_reg_grassimage']['url']).");
	  height: ". esc_attr(($grassheight + 10))."px;
	  background-size: 90% auto;
}
";
} else { ?>
#header .grass {
background-image: url('<?php echo get_template_directory_uri();?>/library/img/grass.png');
height: 80px;
background-size: 90% auto;
}
<?php }
//RETINA GRASS HEADER IMAGE
if( !empty($unf_options['unf_reg_grassimage']['url']) && ($unf_options['unf_ret_grassimage']['url'])) {
echo "
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
#header .grass {
	    background-image: url(".esc_url($unf_options['unf_ret_grassimage']['url']).");
	    height: ".esc_attr(($grassheight + 10))."px;
	   background-size: 90% auto;
	  }
}
";
}
if( empty($unf_options['unf_reg_grassimage']['url'])) { ?>
@media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx) {
		#header .grass {
			background-image: url('<?php echo get_template_directory_uri();?>/library/img/grass@2x.png');
			height: 80px;
			background-size: 90% auto;
		}
}
<?php }


//ROTATE RAYS
if( !empty($unf_options['unf_rays_rotate'])){ ?>
@media screen and (-webkit-min-device-pixel-ratio:0) {
.ray-of-lights .c-lights {
	-webkit-transform-origin: 320px 320px;
	-ms-transform-origin: 320px 320px;
	transform-origin: 320px 320px;
	-webkit-animation: rotation 100s infinite linear;
	animation: rotation 100s infinite linear;
}
}
<?php }

// TURN OFF RAYS FOR MOBILE
if ( $unf_options['unf_raylightmobile'] == '0' ) { ?>
@media (max-width: 767px) {
.ray-of-lights {display: none;}
}
<?php }

// DROPDOWNS ON HOVER
if( !empty($unf_options['unf_mainmenu_dropdown_hover'])){ ?>
	@media (min-width:769px) {
	 .dropdown:hover .dropdown-menu {
	  display: block;
	 }
	}
<?php }

//DROPDOWN IMAGES
if( !empty($unf_options['unf_dropdown_image_1']['url'])){
	$paddingsize1 = $unf_options['unf_dropdown_image_1_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown1 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize1);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_1']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_1_width']);?>px auto;
		}
	}
<?php }

if( !empty($unf_options['unf_dropdown_image_2']['url'])){
	$paddingsize2 = $unf_options['unf_dropdown_image_2_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown2 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize2);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_2']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_2_width']);?>px auto;
		}
	}
<?php }

if( !empty($unf_options['unf_dropdown_image_3']['url'])){
	$paddingsize3 = $unf_options['unf_dropdown_image_3_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown1 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize3);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_3']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_3_width']);?>px auto;
		}
	}
<?php }

if( !empty($unf_options['unf_dropdown_image_3']['url'])){
	$paddingsize4 = $unf_options['unf_dropdown_image_4_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown4 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize4);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_4']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_4_width']);?>px auto;
		}
	}
<?php }
if( !empty($unf_options['unf_dropdown_image_5']['url'])){
	$paddingsize5 = $unf_options['unf_dropdown_image_5_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown5 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize5);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_5']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_5_width']);?>px auto;
		}
	}
<?php }
if( !empty($unf_options['unf_dropdown_image_6']['url'])){
	$paddingsize6 = $unf_options['unf_dropdown_image_6_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown1 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize6);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_6']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_6_width']);?>px auto;
		}
	}
<?php }
if( !empty($unf_options['unf_dropdown_image_7']['url'])){
	$paddingsize7 = $unf_options['unf_dropdown_image_7_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown1 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize7);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_7']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_7_width']);?>px auto;
		}
	}
<?php }
if( !empty($unf_options['unf_dropdown_image_8']['url'])){
	$paddingsize8 = $unf_options['unf_dropdown_image_8_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown1 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize8);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_8']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_8_width']);?>px auto;
		}
	}
<?php }
if( !empty($unf_options['unf_dropdown_image_9']['url'])){
	$paddingsize9 = $unf_options['unf_dropdown_image_9_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown1 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize9);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_9']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_9_width']);?>px auto;
		}
	}
<?php }
if( !empty($unf_options['unf_dropdown_image_10']['url'])){
	$paddingsize10 = $unf_options['unf_dropdown_image_10_width'] + '10';
	?>
	@media (min-width:769px) {
		.dropdown1 .dropdown-menu{
			padding-right: <?php echo esc_attr($paddingsize10);?>px;
			background-repeat: no-repeat;
			background-position: right 10px top 10px;
			background-image: url("<?php echo esc_url($unf_options['unf_dropdown_image_10']['url']);?>");
			background-size:<?php echo esc_attr($unf_options['unf_dropdown_image_10_width']);?>px auto;
		}
	}
<?php }

if( !empty($unf_options['unf_navtextsize_large'])){
	$navtextsize_large = $unf_options['unf_navtextsize_large'];
	?>
	.navcontainer .main-menu > li > a {
		font-size: <?php echo esc_attr($navtextsize_large);?>px;
	}
<?php }
if( !empty($unf_options['unf_navtextsize_medium'])){
	$navtextsize_medium = $unf_options['unf_navtextsize_medium'];
	?>
@media (min-width: 992px) and (max-width: 1199px) {
	.navcontainer .main-menu > li > a {
		font-size: <?php echo esc_attr($navtextsize_medium);?>px;
	}
}
<?php }
if( !empty($unf_options['unf_navtextsize_small'])){
	$navtextsize_small = $unf_options['unf_navtextsize_small'];
	?>
@media (min-width: 768px) and (max-width: 991px) {
	.navcontainer .main-menu > li > a {
		font-size: <?php echo esc_attr($navtextsize_small);?>px;
	}
}
<?php }
if( !empty($unf_options['unf_articletitlesize_large'])){
	$articletitlesize_large = $unf_options['unf_articletitlesize_large'];
	?>
#content .article h1, #content .article .h1 {
		font-size: <?php echo esc_attr($articletitlesize_large);?>px;
}
<?php }
if( !empty($unf_options['unf_articletitlesize_medium'])){
	$articletitlesize_medium = $unf_options['unf_articletitlesize_medium'];
	?>
@media (max-width: 1199px) {
	#content .article h1, #content .article .h1 {
			font-size: <?php echo esc_attr($articletitlesize_medium);?>px;
	}
}
<?php }
if( !empty($unf_options['unf_articletitlesize_small'])){
	$articletitlesize_small = $unf_options['unf_articletitlesize_small'];
	?>
@media (max-width: 991px) {
	#content .article h1, #content .article .h1 {
			font-size: <?php echo esc_attr($articletitlesize_small);?>px;
	}
}

<?php }
if( !empty($unf_options['unf_articletitlesize_extrasmall'])){
	$articletitlesize_extrasmall = $unf_options['unf_articletitlesize_extrasmall'];
	?>
@media (max-width: 767px) {
	#content .article h1, #content .article .h1 {
			font-size: <?php echo esc_attr($articletitlesize_extrasmall);?>px;
	}
}

<?php } ?>



/* CUSTOM CSS */
<?php
if(!empty($unf_options["unf_custom_css"])){
echo esc_attr($unf_options["unf_custom_css"]);
}?>

</style>
