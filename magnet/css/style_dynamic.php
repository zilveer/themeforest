<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
?>

/* Webkit */
::selection {
    background: <?php echo $qode_options_magnet['selection_color'];  ?>;
}
/* Gecko/Mozilla */
::-moz-selection {
    background: <?php echo $qode_options_magnet['selection_color'];  ?>;
}

body {
	background-color:<?php echo $qode_options_magnet['background_color'];  ?>;
	<?php if($qode_options_magnet['google_fonts'] != "-1"){ ?>
	<?php $font = str_replace('+', ' ', $qode_options_magnet['google_fonts']); ?>
	font-family: <?php echo $font; ?>, sans-serif;
	<?php } ?>
	color: <?php echo $qode_options_magnet['text_color'];  ?>;
	font-size: <?php echo $qode_options_magnet['text_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['text_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['text_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['text_fontweight'];  ?>;
	<?php if($qode_options_magnet['regular_background_image'] != ""){  ?>
		background-image: url('<?php echo $qode_options_magnet['regular_background_image'] ?>');
		background-position: center 0px;
		background-repeat: no-repeat;
		background-attachment: fixed;
	<?php } else if($qode_options_magnet['pattern_background_image'] != ""){  ?>
		background-image: url('<?php echo $qode_options_magnet['pattern_background_image'] ?>');
		background-position: 0px 0px;
		background-repeat: repeat;
	<?php } ?>
}

<?php if (!empty($qode_options_magnet['background_color'])) { ?>
.progress_bars .progress_title{
	background-color:<?php echo $qode_options_magnet['background_color'];  ?>;
}
<?php } ?>

<?php
$boxed = "no";
if (isset($qode_options_magnet['boxed']))
	$boxed = $qode_options_magnet['boxed'];
?>
<?php if($boxed == "yes"){ ?>
body.boxed{
	background-color:<?php echo $qode_options_magnet['background_color_box'];  ?>;
}

.boxed .container_shadow_inner{
	background-color:<?php echo $qode_options_magnet['background_color'];  ?>;
}

.progress_bars .progress_title{
	background-color:<?php echo $qode_options_magnet['background_color'];  ?>;
}

<?php } ?>

<?php if (!empty($qode_options_magnet['highlight_color'])) { ?>
span.highlight {
	background-color: <?php echo $qode_options_magnet['highlight_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
#magic,
#magic2,
.move_down .second,
.selectnav ul,
.big-slider-control .control-seek-box.pressed,
.big-slider-control .control-left:hover,
.big-slider-control .control-right:hover,
.portfolio_next a:hover .next_button,
.portfolio_prev a:hover .prev_button,
.blog_next a:hover .next_button,
.blog_prev a:hover .prev_button,
span.submit_button:hover input,
p.form-submit:hover input,
.button:hover,
.accordion h5 span:hover,
.accordion h5.ui-state-active span,
.circle_item .circle:hover,
.square_item .square:hover,
.twitter_post .tweet .twitter_controls .twitter_outer:hover,
.box_small:hover,
#back_to_top:hover,
.widget.widget_search form input[type="submit"]:hover,
.social_menu li a:hover,
.footer_bottom .social_menu a:hover,
.drop_down .second ul,
.drop_down .second ul li ul,
ul.latest_post li .post_date span:hover,
.link_holder a:hover,
.link_holder a:hover, .link_holder a.active
{
	background-color: <?php echo $qode_options_magnet['first_color'];?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
.logo p,
.menuHoverOn nav.main_menu > ul > li:hover > a span{
	border-color: <?php echo $qode_options_magnet['first_color'];?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['second_color'])) { ?>
.price_table_inner,
.message,
.different_color_testimonials,
.bx-wrapper .bx-pager.bx-default-pager a,
.progress_bars .progress_content_outer,
form#contact-form input[type="text"],
form#contact-form textarea,
table.standard-table th,
table.standard-table tr:nth-child(odd) td,
.widget.widget_archive select,
.widget.widget_categories select,
.widget.widget_text select,
.widget.widget_search form input[type="text"],
.tabs .tabs-nav li.active a,
.tabs .tabs-container
{
	background-color: <?php echo $qode_options_magnet['second_color'];?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
h1{
	color: <?php echo $qode_options_magnet['first_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h1_color']) || !empty($qode_options_magnet['h1_fontsize']) || !empty($qode_options_magnet['h1_lineheight']) || !empty($qode_options_magnet['h1_fontstyle']) || !empty($qode_options_magnet['h1_fontweight']) || $qode_options_magnet['h1_google_fonts'] != "-1") { ?>
h1{
	color: <?php echo $qode_options_magnet['h1_color'];  ?>;
	<?php if($qode_options_magnet['h1_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h1_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['h1_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['h1_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['h1_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['h1_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h2_color']) || !empty($qode_options_magnet['h2_fontsize']) || !empty($qode_options_magnet['h2_lineheight']) || !empty($qode_options_magnet['h2_fontstyle']) || !empty($qode_options_magnet['h2_fontweight']) || $qode_options_magnet['h2_google_fonts'] != "-1") { ?>
h2{
	color: <?php echo $qode_options_magnet['h2_color'];  ?>;
	<?php if($qode_options_magnet['h2_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h2_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['h2_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['h2_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['h2_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['h2_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h3_color']) || !empty($qode_options_magnet['h3_fontsize']) || !empty($qode_options_magnet['h3_lineheight']) || !empty($qode_options_magnet['h3_fontstyle']) || !empty($qode_options_magnet['h3_fontweight']) || $qode_options_magnet['h3_google_fonts'] != "-1") { ?>
h3,
.posts_holder .text h3 a, 
.blog_holder3 article h3 a, 
.posts_holder1 article h3 a{
	color: <?php echo $qode_options_magnet['h3_color'];  ?>;
	<?php if($qode_options_magnet['h3_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h3_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['h3_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['h3_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['h3_fontstyle'];?>; 
	font-weight: <?php echo $qode_options_magnet['h3_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h4_color']) || !empty($qode_options_magnet['h4_fontsize']) || !empty($qode_options_magnet['h4_lineheight']) || !empty($qode_options_magnet['h4_fontstyle']) || !empty($qode_options_magnet['h4_fontweight']) || $qode_options_magnet['h4_google_fonts'] != "-1") { ?>
h4,
.portfolio_holder article h4 a{
	color: <?php echo $qode_options_magnet['h4_color'];  ?>;
	<?php if($qode_options_magnet['h4_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h4_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['h4_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['h4_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['h4_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['h4_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
h5,
ul.latest_post li a{
	color: <?php echo $qode_options_magnet['first_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h5_color']) || !empty($qode_options_magnet['h5_fontsize']) || !empty($qode_options_magnet['h5_lineheight']) || !empty($qode_options_magnet['h5_fontstyle']) || !empty($qode_options_magnet['h5_fontweight']) || $qode_options_magnet['h5_google_fonts'] != "-1") { ?>
h5,
ul.latest_post li a{
	color: <?php echo $qode_options_magnet['h5_color'];  ?>;
	<?php if($qode_options_magnet['h5_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h5_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['h5_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['h5_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['h5_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['h5_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h6_color']) || !empty($qode_options_magnet['h6_fontsize']) || !empty($qode_options_magnet['h6_lineheight']) || !empty($qode_options_magnet['h6_fontstyle']) || !empty($qode_options_magnet['h6_fontweight']) || $qode_options_magnet['h6_google_fonts'] != "-1") { ?>
h6,
.big-slider-slide .more-info a{
	color: <?php echo $qode_options_magnet['h6_color'];  ?>;
	<?php if($qode_options_magnet['h6_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h6_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['h6_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['h6_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['h6_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['h6_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['text_color']) || !empty($qode_options_magnet['text_fontsize']) || !empty($qode_options_magnet['text_lineheight']) || !empty($qode_options_magnet['text_fontstyle']) || !empty($qode_options_magnet['text_fontweight']) || $qode_options_magnet['text_google_fonts'] != "-1") { ?>
p,
.title span,
.box1.catalog .big-slider-slide .more-info p,
.big-slider .big-slider-slide .more-info p a,
.comment_holder .comment .info,
aside .widget a,
.footer_bottom nav.footer_menu ul li a,
.footer_bottom ul.menu li a,
.progress_bars .progress_title,
.progress_bars .progress_number{
	color: <?php echo $qode_options_magnet['text_color'];  ?>;
	<?php if($qode_options_magnet['text_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['text_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['text_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['text_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['text_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['text_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['text_margin'])) { ?>
p{
	margin: <?php echo $qode_options_magnet['text_margin'];  ?>px 0px;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
a,
.filter a,
p a,
.posts_holder1 article .info .left a,
.blog_holder3 article .info .left a,
.blog_holder3 article .text a.link,
.blog_holder3 article .text .post_holder a.link,
.comment_holder .comment .info .right a.comment-reply-link,
.posts_holder .info .left a,
.posts_holder1 article .info a.more,
.posts_holder1 article .text a.link,
.posts_holder .text a.more,
.blog_holder3 .text a.more,
.box1.catalog .big-slider-slide .more-info h2,
.portfolio_holder_v3 article:hover h4 a,
ul.latest_post li a,
.first_color{
	color: <?php echo $qode_options_magnet['first_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['link_color']) || !empty($qode_options_magnet['link_fontstyle']) || !empty($qode_options_magnet['link_fontweight']) || !empty($qode_options_magnet['link_fontdecoration'])) { ?>
a,
.filter a,
p a,
.posts_holder1 article .info .left a,
.blog_holder3 article .info .left a,
.blog_holder3 article .text a.link,
.blog_holder3 article .text .post_holder a.link,
.comment_holder .comment .info .right a.comment-reply-link,
.posts_holder .info .left a,
.posts_holder1 article .info a.more,
.posts_holder1 article .text a.link,
.posts_holder .text a.more,
.blog_holder3 .text a.more,
ul.latest_post li a{
	color: <?php echo $qode_options_magnet['link_color'];  ?>;
	font-style: <?php echo $qode_options_magnet['link_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['link_fontweight'];  ?>;
	text-decoration: <?php echo $qode_options_magnet['link_fontdecoration'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
.big-slider-slide .more-info a:hover,
.footer_bottom nav.footer_menu ul li a:hover,
.footer_bottom ul.menu li a:hover,
.big-slider-slide .more-info h2 a:hover,
.big-slider-slide .more-info a:hover,
.big-slider .big-slider-slide:hover .more-info h4 a{
	color: <?php echo $qode_options_magnet['first_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['link_color'])) { ?>
.big-slider-slide .more-info a:hover,
.footer_bottom nav.footer_menu ul li a:hover,
.footer_bottom ul.menu li a:hover,
.big-slider-slide .more-info h2 a:hover,
.big-slider-slide .more-info a:hover,
.big-slider .big-slider-slide:hover .more-info h4 a,
.portfolio_holder_v3 article:hover h4 a{
	color: <?php echo $qode_options_magnet['link_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
a:hover,
.filter a:hover,
p a:hover,
.posts_holder1 article .info .left a:hover,
.blog_holder3 article .info .left a:hover,
.blog_holder3 article .text a.link,
.blog_holder3 article .text .post_holder a.link:hover,
.comment_holder .comment .info .right a.comment-reply-link:hover,
.posts_holder .info .left a:hover,
.posts_holder1 article .info a.more:hover,
.posts_holder1 article .text a.link:hover,
.posts_holder .text a.more:hover,
.blog_holder3 .text a.more:hover,
.portfolio_holder article h4 a:hover,
.posts_holder .text h3 a:hover, 
.blog_holder3 article h3 a:hover, 
.posts_holder1 article h3 a:hover,
aside .widget a:hover,
.tooltip,
.footer_top a:hover,
.footer_bottom nav.footer_menu ul li a:hover,
.footer_bottom ul.menu li a:hover
{
	color: <?php echo $qode_options_magnet['first_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['link_hovercolor']) || !empty($qode_options_magnet['link_fontdecoration'])) { ?>
a:hover,
.filter a:hover,
p a:hover,
.posts_holder1 article .info .left a:hover,
.blog_holder3 article .info .left a:hover,
.blog_holder3 article .text a.link,
.blog_holder3 article .text .post_holder a.link:hover,
.comment_holder .comment .info .right a.comment-reply-link:hover,
.posts_holder .info .left a:hover,
.posts_holder1 article .info a.more:hover,
.posts_holder1 article .text a.link:hover,
.posts_holder .text a.more:hover,
.blog_holder3 .text a.more:hover,
.portfolio_holder article h4 a:hover,
.posts_holder .text h3 a:hover, 
.blog_holder3 article h3 a:hover, 
.posts_holder1 article h3 a:hover,
aside .widget a:hover,
.tooltip,
.footer_top a:hover,
.footer_bottom nav.footer_menu ul li a:hover,
.footer_bottom ul.menu li a:hover
{
	color: <?php echo $qode_options_magnet['link_hovercolor'];  ?>;
	text-decoration: <?php echo $qode_options_magnet['link_fontdecoration'];  ?>;
}
<?php } ?>

<?php if($qode_options_magnet['main_menu_position'] == "2"){?>
	nav.main_menu{
		text-align: center;
	}
	
	nav.main_menu > ul {
    display: inline-block;
		padding: 0px;
		text-align: left;
	}

<?php } ?>

<?php if($qode_options_magnet['main_menu_position'] == "3"){?>
	nav.main_menu{
		text-align: right;
	}
	
	nav.main_menu > ul {
    display: inline-block;
		padding: 0px 10p 0px 0px;
		text-align: left;
	}

<?php } ?>

<?php if (!empty($qode_options_magnet['menu_color']) || !empty($qode_options_magnet['menu_fontsize']) || !empty($qode_options_magnet['menu_lineheight']) || !empty($qode_options_magnet['menu_fontstyle']) || !empty($qode_options_magnet['menu_fontweight']) || $qode_options_magnet['menu_google_fonts'] != "-1") { ?>
nav.main_menu ul li a{
	color: <?php echo $qode_options_magnet['menu_color'];  ?>;
	<?php if($qode_options_magnet['menu_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['menu_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['menu_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['menu_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['menu_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['menu_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['menu_hovercolor'])) { ?>
nav.main_menu ul li:hover > a,
nav.main_menu ul li.active > a{
	color: <?php echo $qode_options_magnet['menu_hovercolor'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['dropdown_color']) || !empty($qode_options_magnet['dropdown_fontsize']) || !empty($qode_options_magnet['dropdown_lineheight']) || !empty($qode_options_magnet['dropdown_fontstyle']) || !empty($qode_options_magnet['dropdown_fontweight']) || $qode_options_magnet['dropdown_google_fonts'] != "-1") { ?>
.second ul li a{
	color: <?php echo $qode_options_magnet['dropdown_color']; ?> !important;
	<?php if($qode_options_magnet['dropdown_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['dropdown_google_fonts']) ?>, sans-serif !important;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['dropdown_fontsize'];  ?>px !important;
	line-height: <?php echo $qode_options_magnet['dropdown_lineheight'];  ?>px !important;
	font-style: <?php echo $qode_options_magnet['dropdown_fontstyle'];  ?> !important; 
	font-weight: <?php echo $qode_options_magnet['dropdown_fontweight'];  ?> !important;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['dropdown_hovercolor'])) { ?>
.second ul li:hover a{
	color: <?php echo $qode_options_magnet['dropdown_hovercolor'];  ?> !important;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['header_separator_thickness']) || !empty($qode_options_magnet['header_separator_color']) || $qode_options_magnet['page_title_position'] != "0") { ?>
.title{
	<?php if($qode_options_magnet['page_title_position'] == "1"){?>
	text-align:left;
	<?php }  if($qode_options_magnet['page_title_position'] == "2"){ ?>
	text-align:center;
	<?php } if($qode_options_magnet['page_title_position'] == "3"){ ?>
	text-align:right;
	<?php }?>
	border-width: <?php echo $qode_options_magnet['header_separator_thickness'];  ?>px;
	border-color: <?php echo $qode_options_magnet['header_separator_color'];  ?>;
}
<?php } ?>

<?php if($qode_options_magnet['gradient_color_top'] != "" && $qode_options_magnet['gradient_color_bottom'] != ""){ ?>

widget.widget_search form input[type="submit"],
.title_search form input[type="submit"],
.flex-direction-nav .flex-prev,
.flex-direction-nav .flex-next{
	background-color: <?php echo $qode_options_magnet['gradient_color_bottom']; ?>;
}

.rounded_background,
.big-slider-control .control-seek-box,
.big-slider-control .control-left,
.big-slider-control .control-right,
.portfolio_next .next_button,
.portfolio_prev .prev_button,
.blog_next .next_button,
.blog_prev .prev_button,
.button,
span.submit_button,
p.form-submit,
.accordion h5 span,
.progress_bars .progress_content,
.pagination ul li:hover,
.pagination ul li.active > span,
.circle_item .circle,
.square_item .square,
.twitter_post .tweet .twitter_controls .twitter_outer,
.box_small,
.social_menu li a,
.footer_bottom .social_menu li a,
.tabs .tabs-nav li a,
ul.latest_post li .post_date,
.title_search form input[type="submit"]
{
	background-image: -ms-linear-gradient(top, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	background-image: -moz-linear-gradient(top, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	background-image: -o-linear-gradient(top, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, <?php echo $qode_options_magnet['gradient_color_top']; ?>), color-stop(1, <?php echo $qode_options_magnet['gradient_color_bottom']; ?>));
	background-image: -webkit-linear-gradient(top, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	background-image: linear-gradient(to bottom, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
}

.rounded_background_inner,
.big-slider-control .control-seek-box-inner,
.big-slider-control .control-inner,
.portfolio_next .next_button .inner,
.portfolio_prev .prev_button .inner,
.blog_next .next_button .inner,
.blog_prev .prev_button .inner,
span.submit_button input,
p.form-submit input,
.button.small span,
.button span,
.accordion h5 span .control-inner,
.progress_bars .progress_content span,
.pagination ul li:hover a,
.pagination ul li.active > span,
.circle_item .circle span,
.square_item .square span,
.twitter_post .tweet .twitter_controls .twitter_outer .twitter_prev,
.twitter_post .tweet .twitter_controls .twitter_outer .twitter_next,
.box_small_inner,
.social_menu li a > span,
.footer_bottom .social_menu li a > span,
.tabs .tabs-nav li a span,
ul.latest_post li .post_date span
{
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $qode_options_magnet['gradient_color_top']; ?>', endColorstr='<?php echo $qode_options_magnet['gradient_color_bottom']; ?>');
}
<?php } ?>

<?php if($qode_options_magnet['round_corners'] != ""){ ?>
.rounded_background,
.big-slider-control .control-seek-box,
.button,
span.submit_button,
p.form-submit,
.accordion h5 span,
.price_table:hover .price_table_inner,
.price_table_inner.active_best_price,
.price_table.active .price_table_inner,
.progress_bars .progress_content_outer,
.message,
.testimonial,
.pagination ul li:hover,
form#contact-form input[type="text"],
form#contact-form textarea,
.square_item .square,
.box_small,
#back_to_top,
.widget.widget_archive select,
.widget.widget_search form input[type="submit"],
.widget.widget_search form input[type="text"],
.widget .tagcloud a,
.logo_dot,
.pagination ul li,
.magic_holder,
.tooltip,
.stylish-select .newListSelected,
.open,
.big-slider-control .control-left, 
.big-slider-control .control-right, 
.portfolio_next .next_button, 
.portfolio_prev .prev_button, 
.blog_next .next_button, 
.blog_prev .prev_button,
.twitter_post .tweet .twitter_controls .twitter_outer,
ul.latest_post li .post_date,
.title_search form #s,
.title_search form input[type="submit"],
.contact_detail form#contact-form input[type="text"],
.contact_detail form#contact-form textarea,
.comment_form form#contact-form input[type="text"],
.comment_form form#contact-form textarea
{
	-webkit-border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
}

.move_down .second,
.selectnav ul{
	-webkit-border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
}

.price_table:first-child .price_table_inner{
	border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px; 
	border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;		
}

.price_table:last-child .price_table_inner{
	border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;	
}

.price_table:nth-child(4n+1) .price_table_inner{
	border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px; 
	border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;		
}

.price_table:nth-child(4) .price_table_inner{
	border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;	
}

.progress_bars .progress_content{
	border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
}

.tabs .tabs-nav li {
	border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-top-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;	
}

.tabs .tabs-container {
	border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-bottom-left-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-bottom-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-top-right-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
}

.link_holder{
	-webkit-border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px;
}

#panel-admin{
	-webkit-border-radius: 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px 0px;
	-moz-border-radius: 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px 0px;
	border-radius: 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px 0px;
}

.stylish-select .SSContainerDivWrapper{
	-webkit-border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
}

<?php } ?>

<?php if (!empty($qode_options_magnet['magic_pane_hover_color'])) { ?>
#magic2,
.drop_down .second ul{
	background-color: <?php echo $qode_options_magnet['magic_pane_hover_color']; ?> !important;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['magic_pane_active_color'])) { ?>
#magic{
	background-color: <?php echo $qode_options_magnet['magic_pane_active_color']; ?> !important;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['magic_pane_hover_color'])) { ?>
.menuHoverOn nav.main_menu > ul > li:hover > a span{
	border-color: <?php echo $qode_options_magnet['magic_pane_hover_color']; ?> !important;
}
<?php } ?>

<?php
$center_logo_image = "no";
if (isset($qode_options_magnet['center_logo_image']))
	$center_logo_image = $qode_options_magnet['center_logo_image'];
?>
.logo {
	<?php if($center_logo_image == 'no'){ ?>
	top: <?php echo $qode_options_magnet['logo_top']; ?>px;
	left: <?php echo $qode_options_magnet['logo_left']; ?>px;
	
	<?php }else {?>
		top: <?php echo $qode_options_magnet['logo_top']; ?>px;
		left: 50%;
	<?php } ?>
}

<?php if($center_logo_image == 'yes'){ ?>
.logo a,
.logo p{
	left: -50%;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['footer_separator_thickness']) || !empty($qode_options_magnet['footer_separator_color'])) { ?>
.footer_top{
	border-width: <?php echo $qode_options_magnet['footer_separator_thickness'];  ?>px;
	border-color: <?php echo $qode_options_magnet['footer_separator_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['footer_dotted_separator_thickness']) || !empty($qode_options_magnet['footer_dotted_separator_color'])) { ?>
.footer_bottom{
	border-width: <?php echo $qode_options_magnet['footer_dotted_separator_thickness'];  ?>px;
	border-color: <?php echo $qode_options_magnet['footer_dotted_separator_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['separator_thickness']) || !empty($qode_options_magnet['separator_topmargin']) || !empty($qode_options_magnet['separator_bottommargin']) || !empty($qode_options_magnet['separator_color'])) { ?>
.separator{
  height: <?php echo $qode_options_magnet['separator_thickness'];  ?>px;
	margin-top: <?php echo $qode_options_magnet['separator_topmargin'];  ?>px;
	margin-bottom: <?php echo $qode_options_magnet['separator_bottommargin'];  ?>px;
	background-color: <?php echo $qode_options_magnet['separator_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['separator_color'])) { ?>
.big-slider-control .control-seek,
.page_not_found hr{
	background-color:<?php echo $qode_options_magnet['separator_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['separator_thickness']) || !empty($qode_options_magnet['separator_color'])) { ?>
.portfolio_separator{
	height: <?php echo $qode_options_magnet['separator_thickness'];  ?>px;
	background-color:<?php echo $qode_options_magnet['separator_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['separator_thickness']) || !empty($qode_options_magnet['separator_color'])) { ?>
.posts_holder1 article .info,
.posts_holder .info,
.blog_holder3 article .info,
.portfolio_navigation,
.google_map{
	border-width: <?php echo $qode_options_magnet['separator_thickness'];  ?>px;
	border-color: <?php echo $qode_options_magnet['separator_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['separator_dotted_thickness']) || !empty($qode_options_magnet['separator_dotted_color']) || !empty($qode_options_magnet['separator_dotted_topmargin']) || !empty($qode_options_magnet['separator_dotted_bottommargin'])) { ?>
.separator.dotted{
	border-width: <?php echo $qode_options_magnet['separator_dotted_thickness'];  ?>px;
	border-color: <?php echo $qode_options_magnet['separator_dotted_color'];  ?>;
	margin-top: <?php echo $qode_options_magnet['separator_dotted_topmargin'];  ?>px;
	margin-bottom: <?php echo $qode_options_magnet['separator_dotted_bottommargin'];  ?>px;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['separator_dotted_thickness']) || !empty($qode_options_magnet['separator_dotted_color'])) { ?>
aside .widget,
.article_separator{
	border-width: <?php echo $qode_options_magnet['separator_dotted_thickness'];  ?>px;
	border-color: <?php echo $qode_options_magnet['separator_dotted_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['slider_title_color']) || !empty($qode_options_magnet['slider_title_fontsize']) || !empty($qode_options_magnet['slider_title_lineheight']) || !empty($qode_options_magnet['slider_title_fontstyle']) || !empty($qode_options_magnet['slider_title_fontweight']) || $qode_options_magnet['slider_title_google_fonts'] != "-1") { ?>
.slide .text h2{
	color: <?php echo $qode_options_magnet['slider_title_color'];  ?>;
	<?php if($qode_options_magnet['slider_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['slider_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['slider_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['slider_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['slider_title_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['slider_title_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['slider_title_color']) || !empty($qode_options_magnet['slider_title_fontstyle'])) { ?>
.slide .text .toplabel{
	color: <?php echo $qode_options_magnet['slider_title_color'];  ?>;
	font-style: <?php echo $qode_options_magnet['slider_title_fontstyle'];  ?>; 
}
<?php } ?>

<?php if (!empty($qode_options_magnet['slider_text_color']) || !empty($qode_options_magnet['slider_text_fontsize']) || !empty($qode_options_magnet['slider_text_lineheight']) || !empty($qode_options_magnet['slider_text_fontstyle']) || !empty($qode_options_magnet['slider_text_fontweight']) || $qode_options_magnet['slider_text_google_fonts'] != "-1") { ?>
.slide .text p{
	color: <?php echo $qode_options_magnet['slider_text_color'];  ?>;
	<?php if($qode_options_magnet['slider_text_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['slider_text_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['slider_text_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['slider_text_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['slider_text_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['slider_text_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertype2_title_color']) || !empty($qode_options_magnet['scrollertype2_title_fontsize']) || !empty($qode_options_magnet['scrollertype2_title_lineheight']) || !empty($qode_options_magnet['scrollertype2_title_fontstyle']) || !empty($qode_options_magnet['scrollertype2_title_fontweight']) || $qode_options_magnet['scrollertype2_title_google_fonts'] != "-1") { ?>
.box2 .big-slider-slide .more-info h2, 
.box2 .big-slider-slide .more-info h2 a{
	color: <?php echo $qode_options_magnet['scrollertype2_title_color'];  ?>;
	<?php if($qode_options_magnet['scrollertype2_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['scrollertype2_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['scrollertype2_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['scrollertype2_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['scrollertype2_title_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['scrollertype2_title_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertype2_text_color']) || !empty($qode_options_magnet['scrollertype2_text_fontsize']) || !empty($qode_options_magnet['scrollertype2_text_lineheight']) || !empty($qode_options_magnet['scrollertype2_text_fontstyle']) || !empty($qode_options_magnet['scrollertype2_text_fontweight']) || $qode_options_magnet['scrollertype2_text_google_fonts'] != "-1") { ?>
.box2 .big-slider-slide .more-info p{
	color: <?php echo $qode_options_magnet['scrollertype2_text_color'];  ?>;
	<?php if($qode_options_magnet['scrollertype2_text_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['scrollertype2_text_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['scrollertype2_text_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['scrollertype2_text_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['scrollertype2_text_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['scrollertype2_text_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertype1_title_color']) || !empty($qode_options_magnet['scrollertype1_title_fontsize']) || !empty($qode_options_magnet['scrollertype1_title_lineheight']) || !empty($qode_options_magnet['scrollertype1_title_fontstyle']) || !empty($qode_options_magnet['scrollertype1_title_fontweight']) || $qode_options_magnet['scrollertype1_title_google_fonts'] != "-1") { ?>
.box1 .big-slider-slide .more-info h2, 
.box1 .big-slider-slide .more-info h2 a{
	color: <?php echo $qode_options_magnet['scrollertype1_title_color'];  ?>;
	<?php if($qode_options_magnet['scrollertype1_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['scrollertype1_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['scrollertype1_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['scrollertype1_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['scrollertype1_title_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['scrollertype1_title_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertype1_text_color']) || !empty($qode_options_magnet['scrollertype1_text_fontsize']) || !empty($qode_options_magnet['scrollertype1_text_lineheight']) || !empty($qode_options_magnet['scrollertype1_text_fontstyle']) || !empty($qode_options_magnet['scrollertype1_text_fontweight']) || $qode_options_magnet['scrollertype1_text_google_fonts'] != "-1") { ?>
.box1 .big-slider-slide .more-info p{
	color: <?php echo $qode_options_magnet['scrollertype1_text_color'];  ?>;
	<?php if($qode_options_magnet['scrollertype1_text_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['scrollertype1_text_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['scrollertype1_text_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['scrollertype1_text_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['scrollertype1_text_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['scrollertype1_text_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertype3_title_color']) || !empty($qode_options_magnet['scrollertype3_title_fontsize']) || !empty($qode_options_magnet['scrollertype3_title_lineheight']) || !empty($qode_options_magnet['scrollertype3_title_fontstyle']) || !empty($qode_options_magnet['scrollertype3_title_fontweight']) || $qode_options_magnet['scrollertype3_title_google_fonts'] != "-1") { ?>
.box4 .big-slider-slide .more-info h4, 
.box4 .big-slider-slide .more-info h4 a{
	color: <?php echo $qode_options_magnet['scrollertype3_title_color'];  ?>;
	<?php if($qode_options_magnet['scrollertype3_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['scrollertype3_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['scrollertype3_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['scrollertype3_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['scrollertype3_title_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['scrollertype3_title_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertype3_text_color']) || !empty($qode_options_magnet['scrollertype3_text_fontsize']) || !empty($qode_options_magnet['scrollertype3_text_lineheight']) || !empty($qode_options_magnet['scrollertype3_text_fontstyle']) || !empty($qode_options_magnet['scrollertype3_text_fontweight']) || $qode_options_magnet['scrollertype3_text_google_fonts'] != "-1") { ?>
.box4 .big-slider-slide .more-info p,
.box4 .big-slider-slide .more-info p a{
	color: <?php echo $qode_options_magnet['scrollertype3_text_color'];  ?>;
	<?php if($qode_options_magnet['scrollertype3_text_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['scrollertype3_text_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['scrollertype3_text_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['scrollertype3_text_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['scrollertype3_text_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['scrollertype3_text_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertypecatalog_title_color']) || !empty($qode_options_magnet['scrollertypecatalog_title_fontsize']) || !empty($qode_options_magnet['scrollertypecatalog_title_lineheight']) || !empty($qode_options_magnet['scrollertypecatalog_title_fontstyle']) || !empty($qode_options_magnet['scrollertypecatalog_title_fontweight']) || $qode_options_magnet['scrollertypecatalog_title_google_fonts'] != "-1") { ?>
.box1.catalog .big-slider-slide .more-info h2{
	color: <?php echo $qode_options_magnet['scrollertypecatalog_title_color'];  ?>;
	<?php if($qode_options_magnet['scrollertypecatalog_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['scrollertypecatalog_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['scrollertypecatalog_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['scrollertypecatalog_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['scrollertypecatalog_title_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['scrollertypecatalog_title_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertypecatalog_title_color']) || !empty($qode_options_magnet['scrollertypecatalog_title_fontstyle'])) { ?>
.box1.catalog .big-slider-slide .more-info .toplabel{
	color: <?php echo $qode_options_magnet['scrollertypecatalog_title_color'];  ?>;
	font-style: <?php echo $qode_options_magnet['scrollertypecatalog_title_fontstyle'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['scrollertypecatalog_text_color']) || !empty($qode_options_magnet['scrollertypecatalog_text_fontsize']) || !empty($qode_options_magnet['scrollertypecatalog_text_lineheight']) || !empty($qode_options_magnet['scrollertypecatalog_text_fontstyle']) || !empty($qode_options_magnet['scrollertypecatalog_text_fontweight']) || $qode_options_magnet['scrollertypecatalog_text_google_fonts'] != "-1") { ?>
.box1.catalog .big-slider-slide .more-info p{
	color: <?php echo $qode_options_magnet['scrollertypecatalog_text_color'];  ?>;
	<?php if($qode_options_magnet['scrollertypecatalog_text_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['scrollertypecatalog_text_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['scrollertypecatalog_text_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['scrollertypecatalog_text_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['scrollertypecatalog_text_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['scrollertypecatalog_text_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['button_title_color']) || !empty($qode_options_magnet['button_title_fontsize']) || !empty($qode_options_magnet['button_title_lineheight']) || !empty($qode_options_magnet['button_title_fontstyle']) || !empty($qode_options_magnet['button_title_fontweight']) || $qode_options_magnet['button_title_google_fonts'] != "-1" || ($qode_options_magnet['button_top_gradient_color'] != "" && $qode_options_magnet['button_bottom_gradient_color'] != "")) { ?>
.button,
span.submit_button,
p.form-submit{
	color: <?php echo $qode_options_magnet['button_title_color'];  ?>;
	<?php if($qode_options_magnet['button_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['button_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['button_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['button_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['button_title_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['button_title_fontweight'];  ?>;
	<?php if($qode_options_magnet['button_top_gradient_color'] != "" && $qode_options_magnet['button_bottom_gradient_color'] != ""){ ?>
	background-image: -ms-linear-gradient(top, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	background-image: -moz-linear-gradient(top, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	background-image: -o-linear-gradient(top, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, <?php echo $qode_options_magnet['button_top_gradient_color']; ?>), color-stop(1, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?>));
	background-image: -webkit-linear-gradient(top, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	background-image: linear-gradient(to bottom, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	<?php } ?>
}
<?php } ?>

<?php if($qode_options_magnet['button_top_gradient_color'] != "" && $qode_options_magnet['button_bottom_gradient_color'] != ""){ ?>
.button span{
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $qode_options_magnet['button_top_gradient_color']; ?>', endColorstr='<?php echo $qode_options_magnet['button_bottom_gradient_color']; ?>');
}
<?php } ?>

<?php if (!empty($qode_options_magnet['button_title_color']) || !empty($qode_options_magnet['button_title_fontsize']) || !empty($qode_options_magnet['button_title_lineheight']) || !empty($qode_options_magnet['button_title_fontstyle']) || !empty($qode_options_magnet['button_title_fontweight']) || $qode_options_magnet['button_title_google_fonts'] != "-1" || ($qode_options_magnet['button_top_gradient_color'] != "" && $qode_options_magnet['button_bottom_gradient_color'] != "")) { ?>
span.submit_button input,
p.form-submit input{
	color: <?php echo $qode_options_magnet['button_title_color'];  ?>;
	<?php if($qode_options_magnet['button_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['button_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['button_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['button_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['button_title_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['button_title_fontweight'];  ?>;
	<?php if($qode_options_magnet['button_top_gradient_color'] != "" && $qode_options_magnet['button_bottom_gradient_color'] != ""){ ?>
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $qode_options_magnet['button_top_gradient_color']; ?>', endColorstr='<?php echo $qode_options_magnet['button_bottom_gradient_color']; ?>');
	<?php } ?>
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
.button:hover, input[type="submit"]:hover,
span.submit_button:hover input,
p.form-submit:hover input{
	background-color: <?php echo $qode_options_magnet['first_color'];  ?>
}
<?php } ?>

<?php if (!empty($qode_options_magnet['button_title_hovercolor']) || !empty($qode_options_magnet['button_backgroundhovercolor'])) { ?>
.button:hover,
span.submit_button:hover input,
p.form-submit:hover input{
	color: <?php echo $qode_options_magnet['button_title_hovercolor'];?> !important;
	background-color: <?php echo $qode_options_magnet['button_backgroundhovercolor'];?> !important;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['message_backgroundcolor'])) { ?>
.message{
	background-color: <?php echo $qode_options_magnet['message_backgroundcolor'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['message_title_color']) || !empty($qode_options_magnet['message_title_fontsize']) || !empty($qode_options_magnet['message_title_lineheight']) || !empty($qode_options_magnet['message_title_fontstyle']) || !empty($qode_options_magnet['message_title_fontweight']) || $qode_options_magnet['message_title_google_fonts'] != "-1") { ?>
.message p{
	color: <?php echo $qode_options_magnet['message_title_color'];  ?>;
	<?php if($qode_options_magnet['message_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['message_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['message_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['message_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['message_title_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['message_title_fontweight'];  ?>;
}
<?php } ?>

<?php
$parallax_onoff = "on";
if (isset($qode_options_magnet['parallax_onoff']))
	$parallax_onoff = $qode_options_magnet['parallax_onoff'];
if ($parallax_onoff == "off"){
?>

	.touch .parallax section{
		height: auto !important;
		min-height: 300px;  
		background-position: center top !important;  
		background-size: 100% auto !important;  
		background-attachment: scroll;
	}
		
	.touch	.parallax section.no_background{
		padding: 0px;
	}

<?php } ?>

/* ----------------------------- WOO CSS start ----------------------------- */

<?php if (!empty($qode_options_magnet['text_color']) || !empty($qode_options_magnet['text_fontsize']) || !empty($qode_options_magnet['text_lineheight']) || !empty($qode_options_magnet['text_fontstyle']) || !empty($qode_options_magnet['text_fontweight']) || $qode_options_magnet['text_google_fonts'] != "-1") { ?>
.woocommerce-info,
.woocommerce-message,
.woocommerce span.onsale, 
.woocommerce-page span.onsale,
.woocommerce div.product .woocommerce-tabs ul.tabs li a, 
.woocommerce #content div.product .woocommerce-tabs ul.tabs li a, 
.woocommerce-page div.product .woocommerce-tabs ul.tabs li a, 
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
.woocommerce a.button.alt, 
.woocommerce button.button.alt, 
.woocommerce input.button.alt, 
.woocommerce #respond input#submit.alt, 
.woocommerce #content input.button.alt, 
.woocommerce-page a.button.alt, 
.woocommerce-page button.button.alt, 
.woocommerce-page input.button.alt, 
.woocommerce-page #respond input#submit.alt, 
.woocommerce-page #content input.button.alt,
.woocommerce #respond input#submit,
.woocommerce-page #respond input#submit,
.woocommerce button.button,
.woocommerce-page button.button,
.woocommerce-message a.button,
.woocommerce .quantity .plus, 
.woocommerce .quantity .minus, 
.woocommerce #content .quantity .plus, 
.woocommerce #content .quantity .minus, 
.woocommerce-page .quantity .plus, 
.woocommerce-page .quantity .minus, 
.woocommerce-page #content .quantity .plus, 
.woocommerce-page #content .quantity .minus,
.woocommerce_cart_items a,
.woocommerce .widget_price_filter .price_slider_amount button.button, 
.woocommerce-page .widget_price_filter .price_slider_amount button.button,
.woocommerce .widget_price_filter .price_slider_amount .price_label, 
.woocommerce-page .widget_price_filter .price_slider_amount .price_label,
.woocommerce table.shop_table thead tr th, 
.woocommerce-page table.shop_table thead tr th,
.woocommerce table.shop_table tbody td, 
.woocommerce-page table.shop_table tbody td,
.woocommerce table.shop_table tfoot tr th, 
.woocommerce-page table.shop_table tfoot tr th,
.woocommerce table.shop_table tfoot tr td, 
.woocommerce-page table.shop_table tfoot tr td,
.woocommerce .cart-collaterals .cart_totals tr td, 
.woocommerce .cart-collaterals .cart_totals tr th, 
.woocommerce-page .cart-collaterals .cart_totals tr td, 
.woocommerce-page .cart-collaterals .cart_totals tr th,
.woocommerce #payment div.payment_box, 
.woocommerce-page #payment div.payment_box,
.woocommerce-page ul.order_details li,
.woocommerce ul.order_details li,
.woocommerce .order_details li strong, 
.woocommerce-page .order_details li strong,
.woocommerce dl.customer_details,
.woocommerce-checkout .addresses address p,
.woo_my_account_holder .addresses address,
.woocommerce-account .addresses .address header.title a,
.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce-page nav.woocommerce-pagination ul li a,
.woocommerce nav.woocommerce-pagination ul li span,
.woocommerce-page nav.woocommerce-pagination ul li span,
.woocommerce #content nav.woocommerce-pagination ul li a, 
.woocommerce #content nav.woocommerce-pagination ul li span, 
.woocommerce-page #content nav.woocommerce-pagination ul li a, 
.woocommerce-page #content nav.woocommerce-pagination ul li span{
	color: <?php echo $qode_options_magnet['text_color'];  ?>;
	<?php if($qode_options_magnet['text_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['text_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['text_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['text_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['text_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['text_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h3_color']) || !empty($qode_options_magnet['h3_fontsize']) || !empty($qode_options_magnet['h3_lineheight']) || !empty($qode_options_magnet['h3_fontstyle']) || !empty($qode_options_magnet['h3_fontweight']) || $qode_options_magnet['h3_google_fonts'] != "-1") { ?>
.woo_cart_empty,
.woo_order_recive{
	color: <?php echo $qode_options_magnet['h3_color'];  ?>;
	<?php if($qode_options_magnet['h3_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h3_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['h3_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['h3_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['h3_fontstyle'];?>; 
	font-weight: <?php echo $qode_options_magnet['h3_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h4_color']) || !empty($qode_options_magnet['h4_fontsize']) || !empty($qode_options_magnet['h4_lineheight']) || !empty($qode_options_magnet['h4_fontstyle']) || !empty($qode_options_magnet['h4_fontweight']) || $qode_options_magnet['h4_google_fonts'] != "-1") { ?>
.woocommerce .cart-collaterals .shipping_calculator h2 a,
.woocommerce-page .cart-collaterals .shipping_calculator h2 a,
.woocommerce .related h2,
.woocommerce .upsells h2,
.woocommerce-page .related h2,
.woocommerce-page .upsells h2,
.woocommerce .product .woocommerce-tabs .panel h2,
.woocommerce-page .product .woocommerce-tabs .panel h2,
.woocommerce .cart-collaterals .cart_totals h2,
.woocommerce-page .cart-collaterals .cart_totals h2,
.woocommerce ul.products li.product h3, 
.woocommerce-page ul.products li.product h3,
.woocommerce .cart-collaterals .cross-sells h2, 
.woocommerce-page .cart-collaterals .cross-sells h2,
.woocommerce .cart-collaterals .shipping_calculator h2,
.woocommerce-page .cart-collaterals .shipping_calculator h2,
.woocommerce-checkout form.checkout h3,
.woocommerce-checkout h3,
.woocommerce-checkout h2,
.woocommerce-account h2,
.woo_my_account_holder h3,
.woo_my_account_holder h2,
.woocommerce-account .woocommerce .addresses .title h3, 
.woocommerce-account .woocommerce-page .addresses .title h3{
	color: <?php echo $qode_options_magnet['h4_color'];  ?>;
	<?php if($qode_options_magnet['h4_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h4_google_fonts']); ?>, sans-serif;
	<?php } ?>
	<?php if($qode_options_magnet['h4_fontsize'] != ""){ ?>
	font-size: <?php echo $qode_options_magnet['h4_fontsize']+1;  ?>px;
	<?php } ?>
	<?php if($qode_options_magnet['h4_lineheight'] != ""){ ?>
	line-height: <?php echo $qode_options_magnet['h4_lineheight']+1;  ?>px;
	<?php } ?>
	font-style: <?php echo $qode_options_magnet['h4_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['h4_fontweight'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['h6_color']) || !empty($qode_options_magnet['h6_fontsize']) || !empty($qode_options_magnet['h6_lineheight']) || !empty($qode_options_magnet['h6_fontstyle']) || !empty($qode_options_magnet['h6_fontweight']) || $qode_options_magnet['h6_google_fonts'] != "-1") { ?>
.woocommerce .widget .product_list_widget li a, 
.woocommerce-page .widget .product_list_widget li a,
.woocommerce ul.products li.product a.add_to_cart_button, 
.woocommerce-page ul.products li.product a.add_to_cart_button,
.woo_order_recive_conf{
	color: <?php echo $qode_options_magnet['h6_color'];  ?>;
	<?php if($qode_options_magnet['h6_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['h6_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['h6_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['h6_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['h6_fontstyle'];  ?>; 
	font-weight: <?php echo $qode_options_magnet['h6_fontweight'];  ?>;
}
<?php } ?>

<?php if($qode_options_magnet['round_corners'] != ""){ ?>
.widget_product_search #searchform input.placeholder,
.widget_product_search #searchform input:focus,
.woocommerce .woocommerce-ordering select, 
.woocommerce-page .woocommerce-ordering select,
.woocommerce form .form-row select, 
.woocommerce-page form .form-row select,
.woocommerce a.button.alt, 
.woocommerce button.button.alt, 
.woocommerce input.button.alt, 
.woocommerce #respond input#submit.alt, 
.woocommerce #content input.button.alt, 
.woocommerce-page a.button.alt, 
.woocommerce-page button.button.alt, 
.woocommerce-page input.button.alt, 
.woocommerce-page #respond input#submit.alt, 
.woocommerce-page #content input.button.alt,
.woocommerce #respond input#submit,
.woocommerce-page #respond input#submit,
.woocommerce button.button,
.woocommerce-page button.button,
.woocommerce-message a.button,
.woocommerce table.shop_table input.button,
.woocommerce-page table.shop_table input.button,
.woocommerce-checkout form.login .form-row input.button,
.woocommerce-checkout form.checkout_coupon .form-row input.button,
.woocommerce-account input.button,
.woo_cart_emtpty_button a.button,
.woocommerce-account .my_account_orders a.button,
.widget_product_search #searchform #searchsubmit,
#pp_full_res #commentform input,
.woocommerce #payment, 
.woocommerce-page #payment,
.woocommerce nav.woocommerce-pagination ul li,
.woocommerce-page nav.woocommerce-pagination ul li,
.woocommerce #billing_country_chzn,
.woocommerce #shipping_country_chzn,
.woocommerce form .form-row input.input-text, 
.woocommerce-page form .form-row input.input-text,
#pp_full_res #commentform textarea,
.woocommerce form .form-row textarea, 
.woocommerce-page form .form-row textarea,
.widget_shopping_cart_content p.buttons a.button{
	-webkit-border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
	border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px;
}

.woocommerce-info:before,
.woocommerce-message:before{
	border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-radius: 0px 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;		
}

.woocommerce div.product .woocommerce-tabs ul.tabs li, 
.woocommerce #content div.product .woocommerce-tabs ul.tabs li, 
.woocommerce-page div.product .woocommerce-tabs ul.tabs li, 
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li {
	border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px 0px 0px;
	-webkit-border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px 0px 0px;
	-moz-border-radius: <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px 0px 0px;
}

.woocommerce div.product .woocommerce-tabs .panel, 
.woocommerce #content div.product .woocommerce-tabs .panel, 
.woocommerce-page div.product .woocommerce-tabs .panel, 
.woocommerce-page #content div.product .woocommerce-tabs .panel{
	border-radius: 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
	-webkit-border-radius: 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
	-moz-border-radius: 0px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px <?php echo $qode_options_magnet['round_corners']; ?>px;
}

<?php } ?>


<?php if($qode_options_magnet['gradient_color_top'] != "" && $qode_options_magnet['gradient_color_bottom'] != ""){ ?>
.woocommerce nav.woocommerce-pagination ul li:hover,
.woocommerce-page nav.woocommerce-pagination ul li:hover,
.woocommerce nav.woocommerce-pagination ul li.active,
.woocommerce-page nav.woocommerce-pagination ul li.active,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li span.current,
.woocommerce #billing_country_chzn,
.woocommerce #shipping_country_chzn,
.woocommerce .quantity .plus, 
.woocommerce .quantity .minus, 
.woocommerce #content .quantity .plus, 
.woocommerce #content .quantity .minus, 
.woocommerce-page .quantity .plus, 
.woocommerce-page .quantity .minus, 
.woocommerce-page #content .quantity .plus, 
.woocommerce-page #content .quantity .minus,
.woocommerce a.button.alt, 
.woocommerce button.button.alt, 
.woocommerce input.button.alt, 
.woocommerce #respond input#submit.alt, 
.woocommerce #content input.button.alt, 
.woocommerce-page a.button.alt, 
.woocommerce-page button.button.alt, 
.woocommerce-page input.button.alt, 
.woocommerce-page #respond input#submit.alt, 
.woocommerce-page #content input.button.alt,
.woocommerce #respond input#submit,
.woocommerce-page #respond input#submit,
.woocommerce button.button,
.woocommerce-page button.button,
.woocommerce-message a.button,
.woocommerce table.shop_table input.button,
.woocommerce-page table.shop_table input.button,
.woocommerce-checkout form.login .form-row input.button,
.woocommerce-checkout form.checkout_coupon .form-row input.button,
.woocommerce-account input.button,
.woo_cart_emtpty_button a.button,
.woocommerce-account .my_account_orders a.button,
.widget_product_search #searchform #searchsubmit,
.woocommerce div.product .woocommerce-tabs ul.tabs li a, 
.woocommerce #content div.product .woocommerce-tabs ul.tabs li a, 
.woocommerce-page div.product .woocommerce-tabs ul.tabs li a, 
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
.woocommerce nav.woocommerce-pagination ul li span.current, 
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce nav.woocommerce-pagination ul li a:focus, 
.woocommerce #content nav.woocommerce-pagination ul li span.current, 
.woocommerce #content nav.woocommerce-pagination ul li a:hover, 
.woocommerce #content nav.woocommerce-pagination ul li a:focus, 
.woocommerce-page nav.woocommerce-pagination ul li span.current, 
.woocommerce-page nav.woocommerce-pagination ul li a:hover, 
.woocommerce-page nav.woocommerce-pagination ul li a:focus, 
.woocommerce-page #content nav.woocommerce-pagination ul li span.current, 
.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, 
.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
.widget_shopping_cart_content p.buttons a.button{
	background-color: <?php echo $qode_options_magnet['gradient_color_bottom']; ?>;
	background-image: -ms-linear-gradient(top, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	background-image: -moz-linear-gradient(top, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	background-image: -o-linear-gradient(top, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, <?php echo $qode_options_magnet['gradient_color_top']; ?>), color-stop(1, <?php echo $qode_options_magnet['gradient_color_bottom']; ?>));
	background-image: -webkit-linear-gradient(top, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	background-image: linear-gradient(to bottom, <?php echo $qode_options_magnet['gradient_color_top']; ?> 0%, <?php echo $qode_options_magnet['gradient_color_bottom']; ?> 100%);
	
}

.woocommerce nav.woocommerce-pagination ul li:hover a,
.woocommerce-page nav.woocommerce-pagination ul li:hover a,
.woocommerce nav.woocommerce-pagination ul li.active > span,
.woocommerce-page nav.woocommerce-pagination ul li.active > span,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li span.current{
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $qode_options_magnet['gradient_color_top']; ?>', endColorstr='<?php echo $qode_options_magnet['gradient_color_bottom']; ?>');	
}

<?php } ?>

<?php if (!empty($qode_options_magnet['button_title_color']) || !empty($qode_options_magnet['button_title_fontsize']) || !empty($qode_options_magnet['button_title_lineheight']) || !empty($qode_options_magnet['button_title_fontstyle']) || !empty($qode_options_magnet['button_title_fontweight']) || $qode_options_magnet['button_title_google_fonts'] != "-1" || ($qode_options_magnet['button_top_gradient_color'] != "" && $qode_options_magnet['button_bottom_gradient_color'] != "")) { ?>
.woocommerce a.button.alt, 
.woocommerce button.button.alt, 
.woocommerce input.button.alt, 
.woocommerce #respond input#submit.alt, 
.woocommerce #content input.button.alt, 
.woocommerce-page a.button.alt, 
.woocommerce-page button.button.alt, 
.woocommerce-page input.button.alt, 
.woocommerce-page #respond input#submit.alt, 
.woocommerce-page #content input.button.alt,
.woocommerce #respond input#submit,
.woocommerce-page #respond input#submit,
.woocommerce button.button,
.woocommerce-page button.button,
.woocommerce-message a.button,
.woocommerce table.shop_table input.button,
.woocommerce-page table.shop_table input.button,
.woocommerce-checkout form.login .form-row input.button,
.woocommerce-checkout form.checkout_coupon .form-row input.button,
.woocommerce-account input.button,
.woo_cart_emtpty_button a.button,
.woocommerce-account .my_account_orders a.button,
.widget_product_search #searchform #searchsubmit,
.widget_shopping_cart_content p.buttons a.button{
	color: <?php echo $qode_options_magnet['button_title_color'];  ?>;
	<?php if($qode_options_magnet['button_title_google_fonts'] != "-1"){ ?>
	font-family: <?php echo str_replace('+', ' ', $qode_options_magnet['button_title_google_fonts']); ?>, sans-serif;
	<?php } ?>
	font-size: <?php echo $qode_options_magnet['button_title_fontsize'];  ?>px;
	line-height: <?php echo $qode_options_magnet['button_title_lineheight'];  ?>px;
	font-style: <?php echo $qode_options_magnet['button_title_fontstyle'];  ?>;
	font-weight: <?php echo $qode_options_magnet['button_title_fontweight'];  ?>;
	<?php if($qode_options_magnet['button_top_gradient_color'] != "" && $qode_options_magnet['button_bottom_gradient_color'] != ""){ ?>
	background-color: <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?>;
	background-image: -ms-linear-gradient(top, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	background-image: -moz-linear-gradient(top, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	background-image: -o-linear-gradient(top, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, <?php echo $qode_options_magnet['button_top_gradient_color']; ?>), color-stop(1, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?>));
	background-image: -webkit-linear-gradient(top, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	background-image: linear-gradient(to bottom, <?php echo $qode_options_magnet['button_top_gradient_color']; ?> 0%, <?php echo $qode_options_magnet['button_bottom_gradient_color']; ?> 100%);
	<?php } ?>
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
.woocommerce a.button.alt:hover, 
.woocommerce button.button.alt:hover, 
.woocommerce input.button.alt:hover, 
.woocommerce #respond input#submit.alt:hover, 
.woocommerce #content input.button.alt:hover, 
.woocommerce-page a.button.alt:hover, 
.woocommerce-page button.button.alt:hover, 
.woocommerce-page input.button.alt:hover, 
.woocommerce-page #respond input#submit.alt:hover, 
.woocommerce-page #content input.button.alt:hover,
.woocommerce #respond input#submit:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce button.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-message a.button:hover,
.woocommerce-checkout form.login .form-row input.button:hover,
.woocommerce-checkout form.checkout_coupon .form-row input.button:hover,
.woocommerce-account input.button:hover,
.woo_cart_emtpty_button a.button:hover,
.woocommerce-account .my_account_orders a.button:hover,
.widget_product_search #searchform #searchsubmit:hover,
.widget_shopping_cart_content p.buttons a.button:hover{
	background-color: <?php echo $qode_options_magnet['first_color'];  ?>
}
<?php } ?>

<?php if (!empty($qode_options_magnet['button_backgroundhovercolor'])) { ?>
.woocommerce a.button.alt:hover, 
.woocommerce button.button.alt:hover, 
.woocommerce input.button.alt:hover, 
.woocommerce #respond input#submit.alt:hover, 
.woocommerce #content input.button.alt:hover, 
.woocommerce-page a.button.alt:hover, 
.woocommerce-page button.button.alt:hover, 
.woocommerce-page input.button.alt:hover, 
.woocommerce-page #respond input#submit.alt:hover, 
.woocommerce-page #content input.button.alt:hover,
.woocommerce #respond input#submit:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce button.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-message a.button:hover,
.woocommerce-checkout form.login .form-row input.button:hover,
.woocommerce-checkout form.checkout_coupon .form-row input.button:hover,
.woocommerce-account input.button:hover,
.woo_cart_emtpty_button a.button:hover,
.woocommerce-account .my_account_orders a.button:hover,
.widget_product_search #searchform #searchsubmit:hover,
.widget_shopping_cart_content p.buttons a.button:hover{
	background-color: <?php echo $qode_options_magnet['button_backgroundhovercolor'];?> !important;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['text_color'])) { ?>
.woocommerce .woocommerce-ordering select, 
.woocommerce-page .woocommerce-ordering select,
.woocommerce form .form-row select, 
.woocommerce-page form .form-row select,
.woocommerce ul.products li.product .price, 
.woocommerce-page ul.products li.product .price,
.woocommerce ul.products li.product .price ins, 
.woocommerce-page ul.products li.product .price ins,
.woocommerce ul.products li.product .price del, 
.woocommerce-page ul.products li.product .price del,
.woocommerce div.product span.price, 
.woocommerce div.product p.price, 
.woocommerce #content div.product span.price, 
.woocommerce #content div.product p.price, 
.woocommerce-page div.product span.price, 
.woocommerce-page div.product p.price, 
.woocommerce-page #content div.product span.price, 
.woocommerce-page #content div.product p.price,
.woocommerce div.product span.price del, 
.woocommerce div.product p.price del, 
.woocommerce #content div.product span.price del, 
.woocommerce #content div.product p.price del, 
.woocommerce-page div.product span.price del, 
.woocommerce-page div.product p.price del, 
.woocommerce-page #content div.product span.price del, 
.woocommerce-page #content div.product p.price del,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, 
.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, 
.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, 
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover, 
.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:hover, 
.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a:hover, 
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a:hover,
.woocommerce .quantity input.qty, 
.woocommerce #content .quantity input.qty, 
.woocommerce-page .quantity input.qty, 
.woocommerce-page #content .quantity input.qty,
.woocommerce table.cart td.actions .coupon .input-text,
.woocommerce-page table.cart td.actions .coupon .input-text,
.woocommerce .widget_price_filter .price_slider_amount .price_label, 
.woocommerce-page .widget_price_filter .price_slider_amount .price_label,
.widget_product_search #searchform input.placeholder,
.widget_product_search #searchform input:focus,
.woocommerce .cart-collaterals .cart_totals tr td, 
.woocommerce .cart-collaterals .cart_totals tr th, 
.woocommerce-page .cart-collaterals .cart_totals tr td, 
.woocommerce-page .cart-collaterals .cart_totals tr th,
.woocommerce form .form-row input.input-text, 
.woocommerce-page form .form-row input.input-text,
#pp_full_res #commentform textarea,
.woocommerce form .form-row textarea, 
.woocommerce-page form .form-row textarea,
.woocommerce .chzn-container .chzn-results,
.woocommerce .chzn-container .chzn-results .no-results span,
.woocommerce-checkout .form-row .chzn-container-single .chzn-search input,
.woocommerce dl.customer_details,
.woocommerce-checkout .addresses address p{
	color: <?php echo $qode_options_magnet['text_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['second_color'])) { ?>
.woocommerce .woocommerce-ordering select, 
.woocommerce-page .woocommerce-ordering select,
.woocommerce form .form-row select, 
.woocommerce-page form .form-row select,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, 
.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, 
.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, 
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
.woocommerce div.product .woocommerce-tabs .panel, 
.woocommerce #content div.product .woocommerce-tabs .panel, 
.woocommerce-page div.product .woocommerce-tabs .panel, 
.woocommerce-page #content div.product .woocommerce-tabs .panel,
.woocommerce .quantity input.qty, 
.woocommerce #content .quantity input.qty, 
.woocommerce-page .quantity input.qty, 
.woocommerce-page #content .quantity input.qty,
.woocommerce table.cart td.actions .coupon .input-text,
.woocommerce-page table.cart td.actions .coupon .input-text,
.widget_product_search #searchform input.placeholder,
.widget_product_search #searchform input:focus,
.woocommerce table.shop_table tfoot tr:nth-child(2n) th, 
.woocommerce-page table.shop_table tfoot tr:nth-child(2n) th,
.woocommerce table.shop_table tfoot tr:nth-child(2n) td, 
.woocommerce-page table.shop_table tfoot tr:nth-child(2n) td,
.woocommerce table.shop_table tbody tr:nth-child(2n) td,
.woocommerce table.shop_table thead, 
.woocommerce-page table.shop_table thead,
.woocommerce .cart-collaterals .cart_totals tr:nth-child(2n) td,
.woocommerce .cart-collaterals .cart_totals tr:nth-child(2n) th,
.woocommerce-page .cart-collaterals .cart_totals tr:nth-child(2n) td,
.woocommerce-page .cart-collaterals .cart_totals tr:nth-child(2n) th,
#pp_full_res #commentform input,
.woocommerce form .form-row input.input-text, 
.woocommerce-page form .form-row input.input-text,
#pp_full_res #commentform textarea,
.woocommerce form .form-row textarea, 
.woocommerce-page form .form-row textarea,
.woocommerce .chzn-container .chzn-results,
.woocommerce .chzn-container-single .chzn-search,
.woocommerce .chzn-container .chzn-results .no-results,
.woocommerce-checkout .form-row .chzn-container-single .chzn-search input,
.woocommerce #payment, 
.woocommerce-page #payment{
	background-color: <?php echo $qode_options_magnet['second_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
.woocommerce-info:before,
.woocommerce-error:before,
.woocommerce-message:before,
.woocommerce span.onsale, 
.woocommerce-page span.onsale,
.woocommerce a.button.alt:hover, 
.woocommerce button.button.alt:hover, 
.woocommerce input.button.alt:hover, 
.woocommerce #respond input#submit.alt:hover, 
.woocommerce #content input.button.alt:hover, 
.woocommerce-page a.button.alt:hover, 
.woocommerce-page button.button.alt:hover, 
.woocommerce-page input.button.alt:hover, 
.woocommerce-page #respond input#submit.alt:hover, 
.woocommerce-page #content input.button.alt:hover,
.woocommerce #respond input#submit:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce button.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-message a.button:hover,
.woocommerce-checkout form.login .form-row input.button:hover,
.woocommerce-checkout form.checkout_coupon .form-row input.button:hover,
.woocommerce-account input.button:hover,
.woo_cart_emtpty_button a.button:hover,
.woocommerce-account .my_account_orders a.button:hover,
.widget_product_search #searchform #searchsubmit:hover,
.widget_shopping_cart_content p.buttons a.button:hover,
.woocommerce .quantity .plus:hover, 
.woocommerce .quantity .minus:hover, 
.woocommerce #content .quantity .plus:hover, 
.woocommerce #content .quantity .minus:hover, 
.woocommerce-page .quantity .plus:hover, 
.woocommerce-page .quantity .minus:hover, 
.woocommerce-page #content .quantity .plus:hover, 
.woocommerce-page #content .quantity .minus:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range, 
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce table.shop_table input.button:hover, 
.woocommerce-page table.shop_table input.button:hover,
.woocommerce .chzn-container-single .chzn-drop ul li:hover,
.woocommerce .chzn-container-single .chzn-drop ul li.highlighted
{
	background-color: <?php echo $qode_options_magnet['first_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['button_backgroundhovercolor'])) { ?>
.woocommerce a.button.alt:hover, 
.woocommerce button.button.alt:hover, 
.woocommerce input.button.alt:hover, 
.woocommerce #respond input#submit.alt:hover, 
.woocommerce #content input.button.alt:hover, 
.woocommerce-page a.button.alt:hover, 
.woocommerce-page button.button.alt:hover, 
.woocommerce-page input.button.alt:hover, 
.woocommerce-page #respond input#submit.alt:hover, 
.woocommerce-page #content input.button.alt:hover,
.woocommerce #respond input#submit:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce button.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-message a.button:hover,
.woocommerce-checkout form.login .form-row input.button:hover,
.woocommerce-checkout form.checkout_coupon .form-row input.button:hover,
.woocommerce-account input.button:hover,
.woo_cart_emtpty_button a.button:hover,
.woocommerce-account .my_account_orders a.button:hover,
.widget_product_search #searchform #searchsubmit:hover,
.widget_shopping_cart_content p.buttons a.button:hover,
.woocommerce table.shop_table input.button:hover, 
.woocommerce-page table.shop_table input.button:hover{
	background-color: <?php echo $qode_options_magnet['button_backgroundhovercolor'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['first_color'])) { ?>
.woocommerce ul.products li.product a.add_to_cart_button:hover, 
.woocommerce-page ul.products li.product a.add_to_cart_button:hover,
.woocommerce p.stars a:hover:before, 
.woocommerce p.stars a:focus:before, 
.woocommerce-page p.stars a:hover:before, 
.woocommerce-page p.stars a:focus:before,
.woocommerce .widget .product_list_widget li a:hover,
.woocommerce-page .widget .product_list_widget li a:hover,
.woocommerce table.cart a.remove:hover, 
.woocommerce #content table.cart a.remove:hover, 
.woocommerce-page table.cart a.remove:hover, 
.woocommerce-page #content table.cart a.remove:hover,
.woocommerce table.cart a.remove, 
.woocommerce #content table.cart a.remove, 
.woocommerce-page table.cart a.remove, 
.woocommerce-page #content table.cart a.remove,
.woocommerce .cart-collaterals .shipping_calculator h2:hover a,
.woocommerce-page .cart-collaterals .shipping_calculator h2:hover a
{
	color: <?php echo $qode_options_magnet['first_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_magnet['link_hovercolor'])) { ?>
.woocommerce ul.products li.product a.add_to_cart_button:hover, 
.woocommerce-page ul.products li.product a.add_to_cart_button:hover,
.woocommerce .widget .product_list_widget li a:hover,
.woocommerce-page .widget .product_list_widget li a:hover,
.woocommerce .cart-collaterals .shipping_calculator h2:hover a,
.woocommerce-page .cart-collaterals .shipping_calculator h2:hover a
{
	color: <?php echo $qode_options_magnet['link_hovercolor'];  ?>;
}
<?php } ?>

/* ----------------------------- WOO CSS end ----------------------------- */