<?php header("Content-type: text/css"); ?>
@charset "utf-8";
/* CSS Document */

/***************Top Margin *******************/
#container, .subsection { <?php 
// Get Button Color
if ( $contentpadding = get_option('of_content_padding') ) { echo 'padding-top:'.$contentpadding.'px;'; } 
?>	
}

.logonav { <?php 
// Get Button Color
if ( $logopadding = get_option('of_logo_padding') ) { echo 'padding-top:'.$logopadding.'px;'; } 
?>	
}

/*******************BG Image*******************/
body {
	<?php if ( $backgroundimage = get_option('of_background_image') ) { echo 'background-image:url('.$backgroundimage.');'; } else {
	if ($backgroundtexture = get_option('of_texture_bg') ) { echo 'background-image:url('.$backgroundtexture.');';} } ?>
    background-repeat:repeat;
    background-position:center top;
    }

/***************Don't Display Admin Bar on Homescreen*******************/
<?php
if ( is_home() ) { ?>
   #wpadminbar { display:none; }
   html { margin-top: 0 !important; }
    * html body { margin-top: 0 !important; }
<?php } ?>

/****************Button Colors***********************/

.button:hover, a.button:hover, a.more-link:hover, #footer .button:hover, #footer a.button:hover, #footer a.more-link:hover, .cancel-reply p a:hover {
		   
<?php 
// Get Button Color
if ( $buttonhover = get_option('of_button_hover_color') ) { echo 'background:'.$buttonhover.'!important;'; }
?>	
color:#fff;
}

.button, a.button, a.more-link, #footer .button, #footer a.button, #footer a.more-link, .cancel-reply p a {
		   
<?php 
// Get Button Color
if ( $buttoncolor = get_option('of_button_color') ) { echo 'background:'.$buttoncolor.';'; }
?>	
color:#fff;
}

/****************Link Colors***********************/
p a, a {
<?php 
// Get Link Color
if ( $linkcolor = get_option('of_link_color') ) { echo 'color:'.$linkcolor.';'; } 
?>	
}

h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, p a:hover, 
#footer h1 a:hover, #footer h2 a:hover, #footer h3 a:hover, #footer h3 a:hover, #footer h4 a:hover, #footer h5 a:hover, a:hover, #footer a:hover, .blogpost h2 a:hover {
<?php 
// Get Link Hover Color
if ( $linkhover = get_option('of_link_hover_color') ) { echo 'color:'.$linkhover.';'; } 
?>	
}

/****************Selection Colors***********************/
::-moz-selection {
<?php 
// Get heading font choices
if ( $linkhover = get_option('of_link_hover_color') ) { echo 'background:'.$linkhover.'; color:#fff;'; } 
?>	
}

::selection {
<?php 
// Get heading font choices
if ( $linkhover = get_option('of_link_hover_color') ) { echo 'background:'.$linkhover.'; color:#fff;'; } 
?>	
}

/***************Typographic User Values *********************************/

h1, h2, h1 a, h2 a, .blogpost h2 a {
<?php 
// Get heading font choices
if ( $headingfont = get_option('of_heading_font') ) { echo 'font-family:"'.$headingfont.'", georgia, serif;'; } 
?>
}

h5, h5 a, , .widget h3, .widget h2, .widget h4  {
<?php 

// Get tiny font option
if ( $tinyfont = get_option('of_tiny_font') ) { echo 'font-family:"'.$tinyfont.'", georgia, serif;'; } ?>
}

h3, .ag_projects_widget h3, h4, h3 a, h4 a, .aj_projects_widget h3 a, .footer .note h4, .footer h4.subheadline {
<?php 

// Get subfont option
if ($secondaryfont = get_option('of_secondary_font') ) { echo 'font-family:"'.$secondaryfont.'", georgia, serif;'; } ?>
}

p, ul, ol, .button, .ui-tabs-vertical .ui-tabs-nav li a span.text,
.footer p, .footer ul, .footer ol, .footer.button, .credits p,
.credits ul, .credits ol, .credits.button, .footer textarea, .footer input, .testimonial p, 
.contactsubmit label, .contactsubmit input[type=text], .contactsubmit textarea {
<?php 

// Get paragraph option
if ($pfont = get_option('of_p_font')) { echo 'font-family:"'.$pfont.'", arial, sans-serif;'; } ?>
}

/******************   Tab Images   ***************************/

 #tabs .tabimage {
 display: block;
 float:left;
 width:16px;
 height:16px;
 background: url(
<?php 
if ( $tabcustom = get_option('of_custom_icon') ) :
    echo $tabcustom;
elseif($tabicons = get_option('of_icons')): 
    echo $tabicons;
else:
    echo get_template_directory_uri().'/images/icons/icon_accept.gif) top center no-repeat;';
endif; ?>
) top center no-repeat;} 

<?php if ($openfooter = get_option('of_open_footer')) { 
	if ($openfooter == "Yes") { echo '
	.logonav {
position:static;
float:left;
height:auto;
}
#footer {
bottom: 0;
position: static;
}
 #footer #toggle_button {
display:none;
bottom: -20px;
right:30px;
}
#footer #footer_content {
display:block;
}
#footer #toggle_button.uparrow {
background:#222 url(images/downarrow.png) 10px 25px no-repeat;
padding-top:10px;
}
#footer #toggle_button.downarrow {
background:#222 url(images/uparrow.png) 10px 25px no-repeat;
padding-top:10px;
}

	'; }} ?>