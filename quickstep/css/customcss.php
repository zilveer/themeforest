<?php if(of_get_option('qs_heading_font')): ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo of_get_option('qs_heading_font'); ?>">
<?php endif; ?>
<?php if(of_get_option('qs_nav_font')): ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo of_get_option('qs_nav_font'); ?>">
<?php endif; ?>
<?php if(of_get_option('qs_style_base') == 'dark'): ?>
<link rel="stylesheet" type="text/css" href='<?php echo get_template_directory_uri(); ?>/css/dark.css' />
<?php endif; ?>

<style type="text/css">
<?php $main_font = of_get_option('qs_main_font'); ?>
body, p, thead tr th, table tfoot tr th, table tbody tr td, table tr td, table tfoot tr td, label {
	color: <?php echo $main_font['color']; ?>;
	font-size: <?php echo $main_font['size']; ?>;
	font-weight: <?php echo $main_font['style']; ?>;
	font-family: <?php echo $main_font['face']; ?>;
}

a, a > * {
	color:<?php echo of_get_option('qs_link_color'); ?>;
}

<?php $heading_font = preg_split( '/:/', of_get_option('qs_heading_font')); ?>
<?php $heading_font = str_replace('+', ' ', $heading_font[0]); ?>
h1, h2, h3, h4, h5, h6 {
	color:<?php echo of_get_option('qs_heading_color'); ?>;
	font-family:'<?php echo $heading_font; ?>', <?php echo $main_font['face']; ?>;
}
.button-alt, .button, .button.small, .button.large, .button.medium, input[type="submit"], .commentlist .comment-reply-link  {
	background:<?php echo of_get_option('qs_button_bg_color', '#666'); ?> ;
	color:<?php echo of_get_option('qs_button_text_color', '#fff'); ?> ;
	font-family:'<?php echo $heading_font; ?>', <?php echo $main_font['face']; ?>;
}
.button.inverse:hover {
	background:<?php echo of_get_option('qs_button_bg_color'); ?> ;
}



<?php if($header_position == 'fadein' && is_home()): ?>
.ie8 header[role="banner"], .ie8 #header-bg, .ie7 header[role="banner"], .ie7 #header-bg
{
	display:none;
}
@media all and (max-width: 800px) {
#logo
{
	display:none;
}
}
<?php endif; ?>
<?php $opacity = of_get_option('qs_header_opacity', '100'); ?>
.ie8 #header-bg, .ie7 #header-bg {
	background:<?php echo of_get_option('qs_header'); ?>;
	border-color:<?php echo of_get_option('qs_header_border'); ?>;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $opacity; ?>)";
	filter: alpha(opacity=<?php echo $opacity; ?>);
	-moz-opacity: <?php echo ($opacity / 100); ?>;
	-khtml-opacity: <?php echo ($opacity / 100); ?>;
	opacity: <?php echo ($opacity / 100); ?>;
}



@media all and (min-width: 800px) {
header[role="banner"], #header-bg {
	<?php $header_position = of_get_option('qs_header_position'); ?>
	<?php if($header_position == 'fixed'): ?>
	position:fixed !important;
	<?php elseif ($header_position == 'absolute'): ?>
	position:absolute !important;
	<?php elseif ($header_position == 'hidden'): ?>
	display:none	 !important;
	<?php endif; ?>
}
<?php if($header_position == 'fadein' && is_home()): ?>
header[role="banner"], #header-bg
{
	display:none;
}

<?php endif; ?>
<?php $opacity = of_get_option('qs_header_opacity', '100'); ?>
#header-bg {
	background:<?php echo of_get_option('qs_header'); ?>;
	border-color:<?php echo of_get_option('qs_header_border'); ?>;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $opacity; ?>)";
	filter: alpha(opacity=<?php echo $opacity; ?>);
	-moz-opacity: <?php echo ($opacity / 100); ?>;
	-khtml-opacity: <?php echo ($opacity / 100); ?>;
	opacity: <?php echo ($opacity / 100); ?>;
}
}
.ie8 header[role="banner"], .ie8 #header-bg, .ie7 header[role="banner"], .ie7 #header-bg {
	left:0px;
	<?php $header_position = of_get_option('qs_header_position'); ?>
        position: <?php echo $header_position; ?>;
	<?php if($header_position == 'fixed' || $header_position == 'fadein'): ?>
	position:fixed !important;
	<?php elseif ($header_position == 'absolute'): ?>
	position:absolute !important;
	<?php elseif ($header_position == 'hidden'): ?>
	display:none	 !important;
	<?php endif; ?>
}
<?php $nav_font = preg_split( '/:/', of_get_option('qs_nav_font')); ?>
<?php $nav_font = str_replace('+', ' ', $nav_font[0]); ?>
nav[role="navigation"] .sf-menu a {
	font-family:<?php if($nav_font) { echo "'".$nav_font."',"; } ?> Arial, Helvetica, sans-serif;
	color:<?php echo of_get_option('qs_nav_link_color'); ?>;
}
nav[role="navigation"] .sf-menu li.active ul a {
        color:<?php echo of_get_option('qs_nav_link_color'); ?> ;
}
@media all and (max-width: 800px) {
    nav[role="navigation"] .sf-menu a, nav[role="navigation"] .sf-menu li.active ul a {
            color:#f7f7f7;
    }
}
footer[role="contentinfo"] h1, footer[role="contentinfo"] h2, footer[role="contentinfo"] h3, footer[role="contentinfo"] h4, footer[role="contentinfo"] h5, footer[role="contentinfo"] h6{
	color:<?php echo of_get_option('qs_footer_widgets_heading_color'); ?> ;
}
footer[role="contentinfo"] {
	background:<?php echo of_get_option('qs_footer_widgets_bg_color'); ?> ;
	color:<?php echo of_get_option('qs_footer_widgets_text_color'); ?> ;	
}
footer[role="contentinfo"] a{
	color:<?php echo of_get_option('qs_footer_widgets_link_color'); ?> ;	
}
#footer-copy {
	background:<?php echo of_get_option('qs_footer_bg_color'); ?> ;
	color:<?php echo of_get_option('qs_footer_text_color'); ?> ;	
}
footer[role="contentinfo"] a{
	color:<?php echo of_get_option('qs_footer_link_color'); ?> ;	
}
<?php $background = of_get_option('qs_background'); ?>
.container, .child-container {
	<?php echo 'background-color:'.$background['color'].';';  ?>
	<?php if($background['image']): ?>
		background:url('<?php echo $background['image']; ?>') <?php echo $background['repeat']; ?> <?php echo $background['attachment']; ?> <?php echo $background['position']; ?>;
	<?php endif; ?>
}
<?php 
        // @DEMO only
	if( isset($_POST['accentHex'])) { 
                $accentHex =  mysql_real_escape_string($_POST['accentHex']);
		$accent = $accentHex; 
	} 
	else { 
		$accent = of_get_option('qs_accent');
	} 
?>
.entry-utility a:active, .entry-utility a:hover, .entry-meta a:active, .entry-meta a:hover, .entry-title a:active, .entry-title a:hover, p.trigger.active a, .aside .current_page_item a, .aside .current_page_item .page_item a:hover, .aside .current_page_item .page_item a:active, .aside a:active, .aside a:hover, .accent, a:active, a:hover, nav[role="navigation"] .sf-menu a:hover, nav[role="navigation"] .sf-menu li.active a, .project-title a:hover, footer[role=contentinfo] a:hover, .foundicon-email:hover, #comments span, a.more-link:hover, nav[role="navigation"] .sf-menu li.active ul a:hover  {color:<?php echo $accent; ?>;}

 input[type="submit"]:hover, .filter li:hover, .button:hover, .button.inverse, .commentlist .comment-reply-link:hover, .qs_page_navi li.bpn-current, .accent-bg, .circle {background-color:<?php echo $accent; ?>;}

.menu-button.open:hover, .menu-button:hover {background-color:<?php echo $accent; ?> !important;}
::selection {background-color:<?php echo $accent; ?> ;}



ul.tabs li.active, [role='navigation'] li:hover, footer[role=contentinfo], nav[role="navigation"] .sf-menu li.active { 
border-color:<?php echo $accent; ?> !important;}

 <?php $args = array(
    'post_type' => 'page',
    'post_status' => 'publish'
); ?> 
<?php //get_pages( $args ); ?>

<?php $page_ids = get_all_page_ids(); ?>
<?php foreach ( $page_ids as $page_id ) { 

	$bg_color = qs_get_meta('qs_page_bg_color', $page_id);
	$text_color = qs_get_meta('qs_page_text_color', $page_id);
	$heading_color = qs_get_meta('qs_page_heading_color', $page_id);
	$images = qs_get_meta('qs_page_bg_image', $page_id);
	$bg_image = wp_get_attachment_image_src( $images, 'full' );
	$bg_repeat = qs_get_meta('qs_page_bg_repeat', $page_id);
	$bg_position = qs_get_meta('qs_page_bg_position', $page_id);
	$bg_attachment = qs_get_meta('qs_page_bg_attachment', $page_id);
	$height = qs_get_meta('qs_page_height', $page_id);
	
	$content = '#container-'.$page_id.'{ ';
	if($bg_color == ('#')) {$bg_color = '';}
	if($bg_image[0]):
		$content .= 'background: url('.$bg_image[0].') '.$bg_color.' '.$bg_position.' '.$bg_attachment.';';
	else :
		$content .= 'background:'.$bg_color.';';
	endif;
	$content .= 'color:'.$text_color.';';
	$content .= 'height:'.$height.';';
	if($bg_repeat == 'cover') {
		$content .= '	 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;}';
	}
	else {
		$content .= 'background-repeat:'.$bg_repeat.';}';
	}
	
	$content .= '#container-'.$page_id.' h1, #container-'.$page_id.' h2, #container-'.$page_id.' h3, #container-'.$page_id.' h4, #container-'.$page_id.' h5, #container-'.$page_id.' h6{ ';
	$content .= 'color:'.$heading_color.';';
	$content .= '}';
	$content .= '#container-'.$page_id.' p, #container-'.$page_id.' label { ';
        $content .= 'color:'.$text_color.';';
        $content .= '}';
	echo $content;
}

?>

@media all and (max-width: 800px) {
	.container {
		background-attachment:scroll !important;
	}
	.menu-button {
		display:block !important;
	}
}

<?php if(of_get_option('qs_blog_opacity') == '1'): ?>
.attachment-blog-image {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
	filter: alpha(opacity=80);
	-moz-opacity: 0.8;
	-khtml-opacity: 0.8;
	opacity: 0.8;
}
<?php endif; ?>


<?php if(of_get_option('qs_portfolio_opacity') == '1'): ?>
#portfolio-container img {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
	filter: alpha(opacity=80);
	-moz-opacity: 0.8;
	-khtml-opacity: 0.8;
	opacity: 0.8;
}
<?php endif; ?>


<?php

	$args = array(
				  'post_type'      => 'slider',
			  );
	$sliders = get_posts( $args );
	foreach ($sliders as $slider) : setup_postdata($slider); 
		$slider_height = qs_get_meta('qs_slider_height', $slider->ID); ?>
		#slider-<?php echo $slider->ID; ?>, #slider-<?php echo $slider->ID; ?> .slides { max-height: <?php echo $slider_height; ?>px !important; }
		.slides {overflow:hidden;}
	<?php endforeach; ?>

 
        @media only screen and (orientation: landscape) and (device-width: 320px), (device-width: 768px) {
            .container {
                background-attachment:scroll !important;
            }
            #demo-styles {
                position: absolute !important;
            }
        }

<?php echo of_get_option('qs_custom_css'); ?>

</style>