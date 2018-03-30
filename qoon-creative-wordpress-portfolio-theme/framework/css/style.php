<?php
	$oi_qoon_options = get_option('oi_qoon_options');
?>
/* 
*	=================================================================================================================================================
*	GENERATED CSS FILE
*	=================================================================================================================================================
*/
{ margin-bottom:}
.oi_go_back i { background: <?php echo $oi_qoon_options['oi_sub_logo-menu-menu-li-a-bg']['hover']?>}
.oi_cart_widget .buttons a:hover { font-weight:normal !important; background:<?php echo $oi_qoon_options['oi_accent_color']?> !important; color:#fff !important;}
.background--dark .oi_burger_normal span, .background--dark .oi_burger_normal span:after, .background--dark .oi_burger_normal span:before { background:<?php echo $oi_qoon_options['oi_logo-typography-dark']?>}
.oi_pg span, .oi_pg a:hover, .oi_a_holder:hover { background:<?php echo $oi_qoon_options['oi_accent_color']?>;}
<?php if ($oi_qoon_options['oi_first_page'] == 0){?>
body.home .oi_layout_standard {margin-top:0px !important; margin-bottom:0px !important;}
body.home { overflow-y:hidden}
body.home .wpb_revslider_element.wpb_content_element { margin:0px !important}
<?php };?>
.console-underscore  { color:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_conosle_done_text:before, .oi_blog_meta_date span {background:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_widget_title span {border-bottom: 1px solid <?php echo $oi_qoon_options['oi_accent_color']?> }

.oi_text_logo a:hover { color:<?php echo $oi_qoon_options['oi_accent_color']?>}
input[type="submit"]:hover {background:<?php echo $oi_qoon_options['oi_accent_color']?>; border:1px solid <?php echo $oi_qoon_options['oi_accent_color']?> !important;}
.oi_com_header span, .comment-reply-title {background:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_pg { text-align:<?php echo $oi_qoon_options['pagination-position']?>}

/*Main Menu*/
.oi_main_menu > li  a { 
    background:<?php echo $oi_qoon_options['oi_logo-menu-menu-li-a-bg']['regular']?>;
}
ul.oi_main_menu li:hover > a {
    text-decoration:none;
    background:<?php echo $oi_qoon_options['oi_logo-menu-menu-li-a-bg']['hover']?>;
    color: <?php echo $oi_qoon_options['oi_logo-menu-menu']['hover']?>;
    <?php
    echo 'border-top: '    . $oi_qoon_options['oi_logo-menu-border-hover']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_logo-menu-border-hover']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_logo-menu-border-hover']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_logo-menu-border-hover']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_logo-menu-border-hover']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_logo-menu-border-hover']['border-color'].';';
	?>
}
.oi_main_menu li.current-menu-item > a, .oi_main_menu li.current_page_parent > a, .oi_main_menu li.current-menu-parent > a, .oi_main_menu li.current_page_parent > a, .oi_main_menu li.current-menu-parent:hover > a, .oi_main_menu li.current_page_parent:hover > a, .oi_main_menu li.current-menu-ancestor >a, .oi_main_menu li.current-menu-ancestor:hover >a {
	background:<?php echo $oi_qoon_options['oi_logo-menu-menu-li-a-bg']['active']?>;
    color: <?php echo $oi_qoon_options['oi_logo-menu-menu']['active']?>;
	<?php
    echo 'border-top: '    . $oi_qoon_options['oi_logo-menu-border-active']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_logo-menu-border-active']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_logo-menu-border-active']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_logo-menu-border-active']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_logo-menu-border-active']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_logo-menu-border-active']['border-color'].';';
	?>

}

<?php if ($oi_qoon_options['site-layout'] !='Left Menu'){?>
/*SUB  Menu*/
.oi_main_menu li > ul > li > a { 
    background:<?php echo $oi_qoon_options['oi_sub_logo-menu-menu-li-a-bg']['regular']?>;
}
.oi_main_menu li > ul > li:hover > a {
    text-decoration:none;
    background:<?php echo $oi_qoon_options['oi_sub_logo-menu-menu-li-a-bg']['hover']?>;
    color: <?php echo $oi_qoon_options['oi_sub_logo-menu-menu']['hover']?>;
    <?php
    echo 'border-top: '    . $oi_qoon_options['oi_sub_logo-menu-border-hover']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_sub_logo-menu-border-hover']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_sub_logo-menu-border-hover']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_sub_logo-menu-border-hover']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_sub_logo-menu-border-hover']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_sub_logo-menu-border-hover']['border-color'].';';
	?>
}
.oi_main_menu ul > li.current-menu-item > a, .oi_main_menu ul > li.current_page_parent > a, .oi_main_menu ul > li.current-menu-parent > a, .oi_main_menu ul > li.current_page_parent > a, .oi_main_menu ul > li.current-menu-parent:hover > a, .oi_main_menu ul > li.current_page_parent:hover > a, .oi_main_menu ul > li.current-menu-ancestor >a, .oi_main_menu ul > li.current-menu-ancestor:hover >a {
	background:<?php echo $oi_qoon_options['oi_sub_logo-menu-menu-li-a-bg']['active']?>;
    color: <?php echo $oi_qoon_options['oi_sub_logo-menu-menu']['active']?>;
	<?php
    echo 'border-top: '    . $oi_qoon_options['oi_sub_logo-menu-border-active']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_sub_logo-menu-border-active']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_sub_logo-menu-border-active']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_sub_logo-menu-border-active']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_sub_logo-menu-border-active']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_sub_logo-menu-border-active']['border-color'].';';
	?>

}
<?php };?>





/*FOOTER Menu*/
.oi_footer_menu > li  a { 
    background:<?php echo $oi_qoon_options['oi_footer_logo-menu-menu-li-a-bg']['regular']?>;
}
ul.oi_footer_menu li a:hover {
    text-decoration:none;
    background:<?php echo $oi_qoon_options['oi_footer_logo-menu-menu-li-a-bg']['hover']?>;
    color: <?php echo $oi_qoon_options['oi_footer_logo-menu-menu']['hover']?>;
    <?php
    echo 'border-top: '    . $oi_qoon_options['oi_footer_logo-menu-border-hover']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_footer_logo-menu-border-hover']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_footer_logo-menu-border-hover']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_footer_logo-menu-border-hover']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_footer_logo-menu-border-hover']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_footer_logo-menu-border-hover']['border-color'].';';
	?>
}
.oi_footer_menu li.current-menu-item > a, .oi_footer_menu li.current_page_parent > a, .oi_footer_menu li.current-menu-parent > a, .oi_footer_menu li.current_page_parent > a, .oi_footer_menu li.current-menu-parent:hover > a, .oi_footer_menu li.current_page_parent:hover > a, .oi_footer_menu li.current-menu-ancestor >a, .oi_footer_menu li.current-menu-ancestor:hover >a {
	background:<?php echo $oi_qoon_options['oi_footer_logo-menu-menu-li-a-bg']['active']?>;
    color: <?php echo $oi_qoon_options['oi_footer_logo-menu-menu']['active']?>;
	<?php
    echo 'border-top: '    . $oi_qoon_options['oi_footer_logo-menu-border-active']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_footer_logo-menu-border-active']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_footer_logo-menu-border-active']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_footer_logo-menu-border-active']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_footer_logo-menu-border-active']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_footer_logo-menu-border-active']['border-color'].';';
	?>

}
.oi_footer_menu li > a { border-radius:<?php echo $oi_qoon_options['oi_footer_border_radius']?>;}


<?php if ($oi_qoon_options['oi_footer_fixed']==0){?>
.oi_layout_standard { margin-bottom:0px !important;}
<?php }?>
.oi_blog_meta_date span { background:<?php echo $oi_qoon_options['single_title-date-bg']['regular']; ?> !important}


/*ACCENT COLOR*/
.oi_list_cats .current-cat a { background:<?php echo $oi_qoon_options['oi_accent_color']?>;}
a { color:<?php echo $oi_qoon_options['oi_accent_color']?>}
a:hover {color:<?php echo $oi_qoon_options['oi_accent_color']?>}
a:focus, a:active { color:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_f_date  { color:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_first_featured_post_heading a:hover { color:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_fp_in_list_heading .oi_meta_cat {  color:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_over_blog_meta {background:<?php echo $oi_qoon_options['oi_accent_color']?>; }
.oi_fp_in_list_heading .oi_meta_cat a {color:<?php echo $oi_qoon_options['oi_accent_color']?>}
.oi_focused_title {color:<?php echo $oi_qoon_options['oi_accent_color']?>}
.oi_readmore_btn { border:1px solid <?php echo $oi_qoon_options['oi_accent_color']?>; color:<?php echo $oi_qoon_options['oi_accent_color']?>; }
.oi_readmore_btn:hover {background:<?php echo $oi_qoon_options['oi_accent_color']?>; }
.oi_blog_pagination_holder a:hover {border-bottom:1px solid <?php echo $oi_qoon_options['oi_accent_color']?>}
.colored {color:<?php echo $oi_qoon_options['oi_accent_color']?>}
.oi_left_menu li:hover > a { color:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_left_menu > li > ul > li:hover > a {background:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_left_menu > li > ul > li > ul > li:hover > a {background:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_left_menu > li > ul > li > ul > li.current-menu-item > a, .oi_left_menu > li > ul > li.current-menu-ancestor > a  {background:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_left_menu > li.current-menu-item > a { color:<?php echo $oi_qoon_options['oi_accent_color']?>}
.oi_left_menu > li.current-menu-parent > a { color:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_left_menu > li.current-menu-ancestor > a { color:<?php echo $oi_qoon_options['oi_accent_color']?>;}
.oi_left_menu > li > ul > li.current-menu-item > a {background:<?php echo $oi_qoon_options['oi_accent_color']?>;  }



/*FILTERS*/

.oi_list_cats  > li  a { 
    background:<?php echo $oi_qoon_options['oi_cats-menu-menu-li-a-bg']['regular']?>;
}
.oi_list_cats li a:hover {
    text-decoration:none;
    background:<?php echo $oi_qoon_options['oi_cats-menu-menu-li-a-bg']['hover']?>;
    color: <?php echo $oi_qoon_options['oi_cats-menu-menu']['hover']?>;
    <?php
    echo 'border-top: '    . $oi_qoon_options['oi_cats-menu-border-hover']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_cats-menu-border-hover']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_cats-menu-border-hover']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_cats-menu-border-hover']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_cats-menu-border-hover']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_cats-menu-border-hover']['border-color'].';';
	?>
}
.oi_list_cats  li.current-cat > a, .oi_list_cats  li.current-cat:hover > a {
	background:<?php echo $oi_qoon_options['oi_cats-menu-menu-li-a-bg']['active']?>;
    color: <?php echo $oi_qoon_options['oi_cats-menu-menu']['active']?>;
	<?php
    echo 'border-top: '    . $oi_qoon_options['oi_cats-menu-border-active']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_cats-menu-border-active']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_cats-menu-border-active']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_cats-menu-border-active']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_cats-menu-border-active']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_cats-menu-border-active']['border-color'].';';
	?>

}






.oi_port_filter .oi_list_cats  > li  a { 
    background:<?php echo $oi_qoon_options['oi_filter-menu-menu-li-a-bg']['regular']?>;
}
.oi_port_filter .oi_list_cats li a:hover {
    text-decoration:none;
    background:<?php echo $oi_qoon_options['oi_filter-menu-menu-li-a-bg']['hover']?>;
    color: <?php echo $oi_qoon_options['oi_filter-menu-menu']['hover']?>;
    <?php
    echo 'border-top: '    . $oi_qoon_options['oi_filter-menu-border-hover']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_filter-menu-border-hover']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_filter-menu-border-hover']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_filter-menu-border-hover']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_filter-menu-border-hover']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_filter-menu-border-hover']['border-color'].';';
	?>
}
.oi_port_filter .oi_list_cats  li.current-cat > a, .oi_port_filter .oi_list_cats  li.current-cat:hover > a {
	background:<?php echo $oi_qoon_options['oi_filter-menu-menu-li-a-bg']['active']?>;
    color: <?php echo $oi_qoon_options['oi_filter-menu-menu']['active']?>;
	<?php
    echo 'border-top: '    . $oi_qoon_options['oi_filter-menu-border-active']['border-top'].';';
	echo 'border-bottom: ' . $oi_qoon_options['oi_filter-menu-border-active']['border-bottom'].';';
	echo 'border-left: '   . $oi_qoon_options['oi_filter-menu-border-active']['border-left'].';';
	echo 'border-right: '  . $oi_qoon_options['oi_filter-menu-border-active']['border-right'].';';
	echo 'border-style: '  . $oi_qoon_options['oi_filter-menu-border-active']['border-style'].';';
	echo 'border-color: '  . $oi_qoon_options['oi_filter-menu-border-active']['border-color'].';';
	?>

}




.blog .oi_list_cats, .archive .oi_list_cats{text-align:<?php echo $oi_qoon_options['cats-position']?> !important;}
.blog .oi_list_cats:after, .archive .oi_list_cats:after {
	<?php if ($oi_qoon_options['cats-position'] =='left'){?>
    margin-left:0px;
    <?php }elseif($oi_qoon_options['cats-position'] =='center'){?>
    <?php }else{?>
    margin-right:0px;
    <?php };?>
    margin-top:<?php echo $oi_qoon_options['oi_cats-marginss'] ?>;
    width:<?php echo $oi_qoon_options['oi_cats-width'] ?>;
    border-bottom-color:<?php echo $oi_qoon_options['oi_cats-color'] ?>;
}



.oi_port_filter .oi_list_cats {text-align:<?php echo $oi_qoon_options['filters-position']?> !important;}
.oi_port_filter .oi_list_cats:after {
	<?php if ($oi_qoon_options['filters-position'] =='left'){?>
    margin-left:0px;
    <?php }elseif($oi_qoon_options['filters-position'] =='center'){?>
    <?php }else{?>
    margin-right:0px;
    <?php };?>
    margin-top:<?php echo $oi_qoon_options['oi_filters-marginss'] ?>;
    width:<?php echo $oi_qoon_options['oi_filters-width'] ?>;
    border-bottom-color:<?php echo $oi_qoon_options['oi_filters-color'] ?>;
}




/*Single Post*/
.oi_blog_post_single_descr .oi_blog_title:after {
	<?php if ($oi_qoon_options['single_title-position'] =='left'){?>
    margin-left:0px;
    <?php }elseif($oi_qoon_options['single_title-position'] =='center'){?>
    <?php }else{?>
    margin-right:0px;
    <?php };?>
    margin-top:<?php echo $oi_qoon_options['single_title-margins'] ?>;
    <?php if ( isset($oi_qoon_options['single_title-width'])) {?>
    width:<?php echo $oi_qoon_options['single_title-width'] ?>;
    <?php }?>
    background:<?php echo $oi_qoon_options['single_title-color'] ?>;
}


/*CRUMBS*/
<?php if ($oi_qoon_options['oi_breadcrumbs_style'] == '0'){?>
.breadcrumbs { display:none !important;}
<?php  };?>
.breadcrumbs { text-align:<?php echo $oi_qoon_options['breadcrumbs-position']?>;}




<?php echo $oi_qoon_options['oi_custom_css']?>



















