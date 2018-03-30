<?php
	global $oi_options;
?>
/* 
*	=================================================================================================================================================
*	GENERATED CSS FILE
*	=================================================================================================================================================
*/



body {
    font-family: <?php echo $oi_options['oi_body-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_body-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_body-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_body-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_body-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_body-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_body-typography']['color']?>;
    background-color: <?php echo $oi_options['oi-background']['background-color']?>;
	<?php if (isset($oi_options['oi-background']['background-image'])){?>background-image:  url('<?php echo $oi_options['oi-background']['background-image']?>');<?php } ?>
    <?php if (isset($oi_options['oi-background']['background-repeat'])){?> background-repeat: <?php echo $oi_options['oi-background']['background-repeat']?>;<?php } ?>
    <?php if (isset($oi_options['oi-background']['background-position'])){?> background-position: <?php echo $oi_options['oi-background']['background-position']?>;<?php } ?>
    <?php if (isset($oi_options['oi-background']['background-size'])){?>background-size: <?php echo $oi_options['oi-background']['background-size']?>;<?php } ?>
    <?php if (isset($oi_options['oi-background']['background-attachment'])){?>background-attachment: <?php echo $oi_options['oi-background']['background-attachment']?>;<?php } ?>
}

.oi_legend {
    font-family: <?php echo $oi_options['oi_legend-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_legend-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_legend-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_legend-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_legend-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_legend-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_legend-typography']['color']?>;
}

.oi_sub_legend {
    font-family: <?php echo $oi_options['oi_sub_legend-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_sub_legend-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_sub_legend-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_sub_legend-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_sub_legend-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_sub_legend-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_sub_legend-typography']['color']?>;
}




h1 {
    font-family: <?php echo $oi_options['oi_h1-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_h1-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_h1-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_h1-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_h1-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_h1-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_h1-typography']['color']?>;
}

h2 {
    font-family: <?php echo $oi_options['oi_h2-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_h2-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_h2-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_h2-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_h2-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_h2-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_h2-typography']['color']?>;
}


h3 {
    font-family: <?php echo $oi_options['oi_h3-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_h3-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_h3-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_h3-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_h3-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_h3-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_h3-typography']['color']?>;
}


h4 {
    font-family: <?php echo $oi_options['oi_h4-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_h4-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_h4-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_h4-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_h4-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_h4-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_h4-typography']['color']?>;
}

h5 {
    font-family: <?php echo $oi_options['oi_h5-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_h5-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_h5-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_h5-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_h5-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_h5-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_h5-typography']['color']?>;
}

h6 {
    font-family: <?php echo $oi_options['oi_h6-typography']['font-family']?>;
    <?php if (isset($oi_options['oi_h6-typography']['font-weight'])){?>font-weight: <?php echo $oi_options['oi_h6-typography']['font-weight']?>;<?php } ?>
    font-style: <?php echo $oi_options['oi_h6-typography']['font-style']?>;
    font-size: <?php echo $oi_options['oi_h6-typography']['font-size']?>;
    line-height: <?php echo $oi_options['oi_h6-typography']['line-height']?>;
    color: <?php echo $oi_options['oi_h6-typography']['color']?>;
}
.oi_widget li.current-menu-item a{ color:<?php echo $oi_options['oi_accent_color']?>}
a { color:<?php echo $oi_options['oi_accent_color']?>}
#filters a:hover { color:<?php echo $oi_options['oi_accent_color']?> !important}
a:hover {color:<?php echo $oi_options['oi_accent_color']?>}
.oi_header_menu > li.current-menu-item > a, .oi_header_menu > li.current-menu-parent > a, .oi_header_menu > li.current_page_parent > a, .oi_header_menu > li.current-menu-parent:hover > a, .oi_header_menu > li.current_page_parent:hover > a {
color: <?php echo $oi_options['oi_accent_color']?>}
.oi_link_block a:hover { color:<?php echo $oi_options['oi_accent_color']?> !important;}
.page-numbers.current { color:<?php echo $oi_options['oi_accent_color']?>}
.colored {color: <?php echo $oi_options['oi_accent_color']?>; }
.oi_soc_header a:hover { color:<?php echo $oi_options['oi_accent_color']?>; }
#scroll_to_content a:hover { text-decoration:none; color:<?php echo $oi_options['oi_accent_color']?>; border-color:<?php echo $oi_options['oi_accent_color']?>}
.post-categories li:not(.current-menu-item):not(.current-menu-parent) a:after {
    background: <?php echo $oi_options['oi_accent_color']?>;
}
.post-categories li:not(.current-menu-item):not(.current-menu-parent) a:hover:before {
    background: <?php echo $oi_options['oi_accent_color']?>;
}
.oi_header_menu ul > li > a:hover { color:<?php echo $oi_options['oi_accent_color']?>}
.oi_header_menu ul > li.current-menu-item > a { color:<?php echo $oi_options['oi_accent_color']?>}
.oi_breadcrumbs a:hover { color:<?php echo $oi_options['oi_accent_color']?>; text-decoration:none;}
.oi_add_post_like:hover strong { color:<?php echo $oi_options['oi_accent_color']?>;}
.oi_add_post_like.oi_already_post_liked strong {color:<?php echo $oi_options['oi_accent_color']?>;}
.oi_already_post_liked  .oi_like_post_count {color:<?php echo $oi_options['oi_accent_color']?>;}
.oi_blog_post_cat.oi_already_post_liked  { color:<?php echo $oi_options['oi_accent_color']?>}
.oi_readmore_btn:hover { color:<?php echo $oi_options['oi_accent_color']?>; text-decoration:none;}
.oi_blog_post_meta_holder {color:<?php echo $oi_options['oi_accent_color']?>}
.oi_ddate { color:<?php echo $oi_options['oi_accent_color']?>; border-bottom:1px solid <?php echo $oi_options['oi_accent_color']?>; }
.oi_blog_post_cat a:after, .oi_readmore_btn:after {
    background: <?php echo $oi_options['oi_accent_color']?>;
}
.oi_blog_post_cat a:hover:before, .oi_readmore_btn:hover:before {
    background: <?php echo $oi_options['oi_accent_color']?>;
}
.link_post .link_date { color:<?php echo $oi_options['oi_accent_color']?>; border-bottom:1px solid <?php echo $oi_options['oi_accent_color']?>;}
.link_url .blog_title_a:hover { color:<?php echo $oi_options['oi_accent_color']?>}
.wpcf7 input.wpcf7-submit:hover { color:<?php echo $oi_options['oi_accent_color']?>}
.oi_content_btn:hover {color:<?php echo $oi_options['oi_accent_color']?>;}
.comment-form input#submit:hover { color:<?php echo $oi_options['oi_accent_color']?>}
#load_more_port_masorny_posts:hover { color:<?php echo $oi_options['oi_accent_color']?>; }
@media (min-width: 0px) and (max-width: 767px) {
	.post-categories > li.current-menu-item > a { color:<?php echo $oi_options['oi_accent_color']?>}
    .post-categories li.active { background:<?php echo $oi_options['oi_accent_color']?>}
}
#wp-calendar a { color:<?php echo $oi_options['oi_accent_color']?>}
#wp-calendar caption { color:<?php echo $oi_options['oi_accent_color']?>}
.oi_tweet a:hover { color:<?php echo $oi_options['oi_accent_color']?>; }
.oi_tweet_time > a.twitter_time { color:<?php echo $oi_options['oi_accent_color']?>; }
.oi_widget ul:not(#cbox):not(.oi_instagram_widget_ul) li a:hover { text-decoration:none; opacity:1; color:<?php echo $oi_options['oi_accent_color']?>;}
.oi_header_menu ul {
border-top-color: <?php echo $oi_options['oi_accent_color']?>  !important;
}
.oi_port_sep {
 background: <?php echo $oi_options['oi_accent_color']?> !important;
}
.filter_current {
color: <?php echo $oi_options['oi_accent_color']?> !important;
}


<?php if ($oi_options['oi_web_page_layout'] =='fullwidth') {?>
.oi_content_holder, .oi_top_line_holder, .oi_logo_holder, .oi_owl_slider { max-width:100% !important}
<?php };?>
<?php if ($oi_options['oi_web_page_layout'] =='smallboxed') {?>
.oi_content_holder, .oi_top_line_holder, .oi_logo_holder, .oi_full_row_vc, .oi_owl_slider  { max-width:1240px !important}
<?php };?>




/*Top Line*/
.oi_top_line .oi_mail { border-left-color: <?php echo $oi_options['top_line_mail-border']['rgba']?>}
ul.oi_topline_menu > li > a { 
    background:<?php echo $oi_options['oi_topline-menu-li-a-bg']['regular']?>
    }
ul.oi_topline_menu > li:hover > a {
    text-decoration:none;
    background:<?php echo $oi_options['oi_topline-menu-li-a-bg']['hover']?>;
     color: <?php echo $oi_options['oi_topline-menu']['hover']?>
}

ul.oi_topline_menu > li.current-menu-item > a, ul.oi_topline_menu > li.current-menu-parent > a{
	background:<?php echo $oi_options['oi_topline-menu-li-a-bg']['active']?>;
    color: <?php echo $oi_options['oi_topline-menu']['active']?>
}
ul.oi_topline_menu > li > a {border-radius:<?php echo $oi_options['oi_topline-menu-border-radius']?>px;}

ul.oi_topline_menu > li > ul >li > a { 
    background:<?php echo $oi_options['oi_topline-menu-li-a-bg_sub']['regular']?>
}
ul.oi_topline_menu > li > ul >li > a:hover { 
    background:<?php echo $oi_options['oi_topline-menu-li-a-bg_sub']['hover']?>
}
ul.oi_topline_menu > li > ul >li.current-menu-item > a { 
    background:<?php echo $oi_options['oi_topline-menu-li-a-bg_sub']['active']?>
}


/*Main Menu*/
.oi_readmore_btn:hover {
	background:<?php echo $oi_options['oi_logo-menu-menu-li-a-bg']['active']?>;
	color: <?php echo $oi_options['oi_logo-menu-menu']['active']?>;
}
ul.oi_header_menu_fixed > li > ul {
margin-left:<?php echo ($oi_options['oi_logo-menu-menu-margins']['margin-left'])?> !important;
}    


ul.oi_header_menu_fixed > li > a { 
    background:<?php echo $oi_options['oi_logo-menu-menu-li-a-bg']['regular']?>;
    border-radius:<?php echo $oi_options['oi_logo-menu-menu-border-radius']?>px;
}
ul.oi_header_menu_fixed > li:hover > a {
    text-decoration:none;
    background:<?php echo $oi_options['oi_logo-menu-menu-li-a-bg']['hover']?>;
    color: <?php echo $oi_options['oi_logo-menu-menu']['hover']?>;
    <?php
    echo 'border-top: '    . $oi_options['oi_logo-menu-border-hover']['border-top'].';';
	echo 'border-bottom: ' . $oi_options['oi_logo-menu-border-hover']['border-bottom'].';';
	echo 'border-left: '   . $oi_options['oi_logo-menu-border-hover']['border-left'].';';
	echo 'border-right: '  . $oi_options['oi_logo-menu-border-hover']['border-right'].';';
	echo 'border-style: '  . $oi_options['oi_logo-menu-border-hover']['border-style'].';';
	echo 'border-color: '  . $oi_options['oi_logo-menu-border-hover']['border-color'].';';
	?>
}
.oi_header_menu_fixed > li:not(.megamenu).current_page_item >a, .oi_header_menu_fixed > li:not(.megamenu).current-menu-parent >a, .oi_header_menu_fixed > li.current-menu-ancestor >a  { 
	background:<?php echo $oi_options['oi_logo-menu-menu-li-a-bg']['active']?>;
    color: <?php echo $oi_options['oi_logo-menu-menu']['active']?>;
	<?php
    echo 'border-top: '    . $oi_options['oi_logo-menu-border-active']['border-top'].';';
	echo 'border-bottom: ' . $oi_options['oi_logo-menu-border-active']['border-bottom'].';';
	echo 'border-left: '   . $oi_options['oi_logo-menu-border-active']['border-left'].';';
	echo 'border-right: '  . $oi_options['oi_logo-menu-border-active']['border-right'].';';
	echo 'border-style: '  . $oi_options['oi_logo-menu-border-active']['border-style'].';';
	echo 'border-color: '  . $oi_options['oi_logo-menu-border-active']['border-color'].';';
	?>

}

/*Menu Scroll*/
.oi_scrolled ul.oi_header_menu_fixed > li > a { 
    background:<?php echo $oi_options['oi_logo-menu-menu-li-a-bg-scroll']['regular']?>;
}
.oi_scrolled ul.oi_header_menu_fixed > li:hover > a {
    text-decoration:none;
    background:<?php echo $oi_options['oi_logo-menu-menu-li-a-bg-scroll']['hover']?>;
    color: <?php echo $oi_options['oi_logo-menu-menu-scroll']['hover']?>;
    <?php
    echo 'border-top: '    . $oi_options['oi_logo-menu-border-hover-scroll']['border-top'].';';
	echo 'border-bottom: ' . $oi_options['oi_logo-menu-border-hover-scroll']['border-bottom'].';';
	echo 'border-left: '   . $oi_options['oi_logo-menu-border-hover-scroll']['border-left'].';';
	echo 'border-right: '  . $oi_options['oi_logo-menu-border-hover-scroll']['border-right'].';';
	echo 'border-style: '  . $oi_options['oi_logo-menu-border-hover-scroll']['border-style'].';';
	echo 'border-color: '  . $oi_options['oi_logo-menu-border-hover-scroll']['border-color'].';';
	?>
}
.oi_scrolled .oi_header_menu_fixed > li.current_page_item >a, .oi_scrolled .oi_header_menu_fixed > li.current-menu-parent >a, .oi_scrolled .oi_header_menu_fixed > li.current-menu-ancestor >a  { 
	background:<?php echo $oi_options['oi_logo-menu-menu-li-a-bg-scroll']['active']?>;
    color: <?php echo $oi_options['oi_logo-menu-menu-scroll']['active']?>;
	<?php
    echo 'border-top: '    . $oi_options['oi_logo-menu-border-active-scroll']['border-top'].';';
	echo 'border-bottom: ' . $oi_options['oi_logo-menu-border-active-scroll']['border-bottom'].';';
	echo 'border-left: '   . $oi_options['oi_logo-menu-border-active-scroll']['border-left'].';';
	echo 'border-right: '  . $oi_options['oi_logo-menu-border-active-scroll']['border-right'].';';
	echo 'border-style: '  . $oi_options['oi_logo-menu-border-active-scroll']['border-style'].';';
	echo 'border-color: '  . $oi_options['oi_logo-menu-border-active-scroll']['border-color'].';';
	?>

}



/*Sub Menu*/
.oi_header_menu_fixed > li.megamenu > ul {  background:  <?php echo $oi_options['oi_megamenu-ul-bg']['rgba']?> !important;}
.oi_header_menu_fixed > li > ul > li > a { 
    background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['regular']?>;
}
.oi_header_menu_fixed > li > ul > li:hover > a {
    text-decoration:none;
    background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['hover']?> !important;
    color: <?php echo $oi_options['oi_logo-menu-sub_menu']['hover']?> !important;
}
.oi_header_menu_fixed > li > ul > li.current_page_item > a, ul.oi_header_menu_fixed > li:not(.megamenu) > ul > li.current-menu-parent  > a {
    background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['active']?> !important;
    color: <?php echo $oi_options['oi_logo-menu-sub_menu']['active']?> !important;

}
.oi_header_menu_fixed >li:not(.megamenu) > ul > li> ul > li > a{ 
    background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['regular']?>;
}
.oi_header_menu_fixed >li:not(.megamenu) > ul > li> ul > li:hover > a{
    background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['hover']?>;
    color: <?php echo $oi_options['oi_logo-menu-sub_menu']['hover']?>;
} 
.oi_header_menu_fixed >li:not(.megamenu) > ul > li> ul > li.current_page_item > a, .oi_header_menu_fixed >li:not(.megamenu) > ul > li> ul > li.current-menu-item > a, .oi_header_menu_fixed >li:not(.megamenu) > ul.sub-menu > li.current-menu-item > a, .oi_header_menu_fixed > li > ul.sub-menu > li.current-menu-item > a{
    background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['active']?> !important;
    color: <?php echo $oi_options['oi_logo-menu-sub_menu']['active']?>  !important;
}
	/*Mega menu*/
    .oi_header_menu_fixed > li.megamenu > ul > li > ul > li > a {
    	background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['regular']?>;
    }
    .oi_header_menu_fixed > li.megamenu > ul > li > ul > li:hover > a {
    	background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['hover']?>;
        color: <?php echo $oi_options['oi_logo-menu-sub_menu']['hover']?>;
    }
    .oi_header_menu_fixed > li.megamenu > ul > li > ul > li.current_page_item > a, .oi_header_menu_fixed > li.megamenu > ul > li > ul > li.current-menu-item > a  {
    	background:<?php echo $oi_options['oi_logo-menu-sub_menu-li-a-bg']['active']?>;
    	color: <?php echo $oi_options['oi_logo-menu-sub_menu']['active']?>;
    }
	
    .oi_header_menu_fixed > li.megamenu > ul > li > a {
    	color: <?php echo $oi_options['oi_megamenu-title-color']['rgba']?> !important;
        background:  <?php echo $oi_options['oi_megamenu-title-bg']['rgba']?> !important;
    
    }
    


<?php echo $oi_options['oi_custom_css']?>



















