<style type="text/css" media="all">
	body {
	<?php if ($font = ct_get_option('style_font_style')): ?> <?php $normalized = explode(':', $font); ?>
	<?php if (isset($normalized[1])): ?>
	font-family: '<?php echo $normalized[0]?>', sans-serif;
	font-weight: '<?php echo $normalized[1];?>';
	<?php endif; ?> <?php endif;?>
	<?php echo ct_get_option_pattern('style_font_size', 'font-size: %dpx;')?>

	<?php //default styles ?> <?php echo ct_get_option_pattern('style_color_basic_background', 'background-color: %s;')?> <?php echo ct_get_option_pattern('style_color_basic_background_image', 'background: url(%s) repeat;')?> <?php echo ct_get_option_pattern('style_color_basic_text', 'color: %s;')?> <?php if(ct_get_option('style_color_basic_background') && !ct_get_option('style_color_basic_background_image')):?> background-image: none;
	<?php endif;?>
	}


	<?php if (ct_get_option('style_color_motive_background') || ct_get_option('style_color_motive_background_image')):?>


	.navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle,
	.navbar .nav > li > a:focus,
	.navbar .nav > li > a:hover,
	.navbar .nav > .active > a,
	.navbar .nav > .active > a:hover,
	.navbar .nav > .active > a:focus,
	.navbar .btn-navbar,
	.dropdown-menu li > a:hover,
	.dropdown-menu li > a:focus,
	.dropdown-submenu:hover > a,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.patBlue,
	.patBlue .crossLine span,
	.patBlue .twoLines span,
	.patBlue .oneLine span,
	.twoLines span,
	.priceBox.spec .wallp {
		<?php //motive color ?>  <?php echo ct_get_option_pattern('style_color_motive_background_image', 'background: url(%s) repeat;')?> <?php echo ct_get_option_pattern('style_color_motive_background', 'background-color: %s;')?>  <?php if(ct_get_option('style_color_motive_background') && !ct_get_option('style_color_motive_background_image')):?> background-image: none;
		<?php endif;?>
	}

	<?php endif;?>
	<?php if (ct_get_option('style_color_motive_background')):?>
	.dropdown-menu {
		<?php echo ct_get_option_pattern('style_color_motive_background', 'border-top: 2px solid %s;')?>
	}

	ul.dots li:before {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'color: %s;')?>
	}
	.oneLine:after,
	.crossLine:after,
	.filterPortfolio:after {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border-top: 2px solid %s;')?>
	}
	.filterPortfolio a:hover,
	.filterPortfolio li.active a,
	.btn {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'background: %s;')?>
	 filter:none;
	}

	.filterPortfolio a:hover:hover, .filterPortfolio a:hover:active, .filterPortfolio a:hover.active, .filterPortfolio a:hover.disabled, .filterPortfolio a:hover[disabled], .filterPortfolio li.active a:hover, .filterPortfolio li.active a:active, .filterPortfolio li.active a.active, .filterPortfolio li.active a.disabled, .filterPortfolio li.active a[disabled],
	.btn:hover:hover,
	.btn:hover:active,
	.btn:hover.active,
	.btn:hover.disabled,
	.btn:hover[disabled],
	.btn:hover,
	.btn:active,
	.btn.active,
	.btn.disabled,
	.btn[disabled] {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'background: %s;')?>
	 filter:none;
	}
	.btn:active,
	.btn.active {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'background: %s;')?>
	 filter:none;
	}
	.btn:hover,
	.btn:active,
	.btn.active,
	.btn.disabled,
	.btn[disabled] {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'background: %s;')?>
	 filter:none;
	}

	.circleFrame {
	<?php echo ct_get_option_pattern('style_color_motive_background', '-webkit-box-shadow: 0 0 0 2px %s;')?>
	<?php echo ct_get_option_pattern('style_color_motive_background', '-moz-box-shadow: 0 0 0 2px %s;')?>
	<?php echo ct_get_option_pattern('style_color_motive_background', 'box-shadow: 0 0 0 2px %s;')?>
	}
	.simpleFrame {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border: 2px solid %s;')?>
	}
	hr {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'background: %s;')?>
	}

	.prettyTable table th {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'background: %s;')?>
	}
	.prettyTable table td {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border-bottom: 2px solid %s;')?>
	}
	.priceBox {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border: 2px solid %s;')?>
	}

	.accordion-group {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border: 2px solid %s;')?>
	}
	.nav-tabs {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border: 2px solid %s;')?>
	}
	.nav-tabs > li > a:hover {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border: 2px solid %s;')?>
	}

	.nav-tabs > .active > a,
	.nav-tabs > .active > a:hover {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border: 2px solid %s;')?>
	}


	.form-horizontal input[type=text]:focus {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border: 1px solid %s;')?>
	}
	.form-horizontal textarea:focus {
	<?php echo ct_get_option_pattern('style_color_motive_background', 'border: 1px solid %s;')?>
	}


	.widget.widget_recent_entries h3:after,
	.widget.widget_recent_comments h3:after,
	.widget.widget_archive h3:after,
	.widget.widget_categories h3:after,
	.widget.widget_meta h3:after,
	.widget.widget_search h3:after,
	.widget.widget_pages h3:after,
	.widget.widget_rss h3:after,
	.widget.widget_tag_cloud h3:after,
	.widget.widget_nav_menu h3:after,
	.widget.widget_links h3:after {
		<?php echo ct_get_option_pattern('style_color_motive_background', 'border-top: 2px solid %s;')?>
	}
	.twoLines:after {
		<?php echo ct_get_option_pattern('style_color_motive_background', 'border-top: 2px solid #ccc;')?>
		<?php echo ct_get_option_pattern('style_color_motive_background', 'border-bottom: 2px solid #ccc;')?>
	}

	<?php endif;?>


	<?php if (ct_get_option('style_color_motive2_color')):?>
	a {
		<?php echo ct_get_option_pattern('style_color_motive2_color', 'color: %s;')?>
	}
	a:hover {
		<?php echo ct_get_option_pattern('style_color_motive2_color', 'color: %s;')?>
	}
	
	.dropdown-menu li > a:hover,
	.dropdown-menu li > a:focus,
	.dropdown-submenu:hover > a {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'background: %s;')?>
	 filter:none;
	}
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'background: %s;')?>
	 filter:none;
	}
	.btn-primary {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'background: %s;')?>
	 filter:none;
	}
	
	.btn-link {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'color: %s;')?>
	}
	.btn-link:hover {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'color: %s;')?>
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'background-color: %s;')?>
	}
	
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'background-color: %s;')?>
	}
	.nav .dropdown-toggle .caret {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'border-top-color: %s;')?>
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'border-bottom-color: %s;')?>
	}
	.nav .dropdown-toggle:hover .caret {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'border-top-color: %s;')?>
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'border-bottom-color: %s;')?>
	}
	
	a.thumbnail:hover {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'border-color: %s;')?>
	}
	.vorange {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'color: %s;')?>
	}
	.vorange:hover {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'color: %s;')?>
	}
	.crossLine strong {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'color: %s;')?>
	}
	.patDark .crossLine strong,
	.patDark .twoLines strong,
	.patDark .oneLine strong {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'color: %s;')?>
	}
	a .circleFrame:hover {
	<?php echo ct_get_option_pattern('style_color_motive2_color', '-webkit-box-shadow: 0 0 0 2px %s;')?>
	<?php echo ct_get_option_pattern('style_color_motive2_color', '-moz-box-shadow: 0 0 0 2px %s;')?>
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'box-shadow: 0 0 0 2px %s;')?>
	}

	.btn.vorange,
	.btn.vorange.active:hover, .btn.vorange.active:active, .btn.vorange.active.active, .btn.vorange.active.disabled, .btn.vorange.active[disabled], .btn.vorange:active:hover, .btn.vorange:active:active, .btn.vorange:active.active, .btn.vorange:active.disabled, .btn.vorange:active[disabled],
	.btn.vorange:hover:hover,
	.btn.vorange:hover:active,
	.btn.vorange:hover.active,
	.btn.vorange:hover.disabled,
	.btn.vorange:hover[disabled],
	.btn.vorange:hover,
	.btn.vorange:active,
	.btn.vorange.active,
	.btn.vorange.disabled,
	.btn.vorange[disabled] {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'background: %s;')?>
	 filter:none;
	}
	.btn.vorange:active,
	.btn.vorange.active {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'background: %s;')?>
	 filter:none;
	}
	.btn.vorange:hover,
	.btn.vorange:active,
	.btn.vorange.active,
	.btn.vorange.disabled,
	.btn.vorange[disabled] {
	<?php echo ct_get_option_pattern('style_color_motive2_color', 'background: %s;')?>
	 filter:none;
	}

	<?php endif;?>
	

	<?php if (ct_get_option('style_color_motive2_arrows')):?>
	[class^="arrow-"],
	[class*=" arrow-"],
	.nivo-directionNav a,
	.flex-direction-nav .flex-prev,
	.flex-direction-nav .flex-next,
	.tparrows.round,
	.tparrows.round.tp-leftarrow.large,
	.tparrows.round.tp-rightarrow.large {
		<?php echo ct_get_option_pattern('style_color_motive2_arrows', 'background-image: url("%s");')?>
	}
	<?php endif;?>

	<?php echo ct_get_option_pattern('style_font_size_h1', 'h1{font-size: %dpx!important;}')?>
	<?php echo ct_get_option_pattern('style_font_size_h2', 'h2{font-size: %dpx!important;}')?>
	<?php echo ct_get_option_pattern('style_font_size_h3', 'h3{font-size: %dpx!important;}')?>
	<?php echo ct_get_option_pattern('style_font_size_h4', 'h4{font-size: %dpx!important;}')?>
	<?php echo ct_get_option_pattern('style_font_size_h5', 'h5{font-size: %dpx!important;}')?>
	<?php echo ct_get_option_pattern('style_font_size_h6', 'h6{font-size: %dpx!important;}')?>

	<?php if(isset($normalized[1])):?>
	h1,h2,h3,h4,h5,h6 {font-family: '<?php echo $normalized[0]?>',sans-serif!important;}
	<?php endif;?>

	<?php echo ct_get_option_pattern('style_color_basic_heading', 'h1,h2,h3,h4,h5,h6 {color: %s}')?><?php echo ct_get_option_pattern('style_color_basic_link', 'a {color: %s;}')?><?php echo ct_get_option_pattern('style_color_basic_link_hover', 'a:hover {color: %s;}')?>
	<?php foreach(array(2=>'.patBright',3=>'.patBlue',4=>'.patDark') as $k=>$n):?>
	<?php echo $n?>{<?php echo ct_get_option_pattern('style_color_'.$k.'_background_image', 'background: url(%s) repeat;')?><?php echo ct_get_option_pattern('style_color_'.$k.'_background', 'background-color: %s;')?><?php echo ct_get_option_pattern('style_color_'.$k.'_text', 'color: %s;')?>
	<?php if(($c = ct_get_option('style_color_'.$k.'_background')) && !ct_get_option('style_color_'.$k.'_background_image')):?>background-image: none;<?php endif;?>
	}
	<?php if(($c = ct_get_option('style_color_'.$k.'_background')) && !ct_get_option('style_color_'.$k.'_background_image')):?>
	<?php echo $n?> h1 span, <?php echo $n?> h2 span, <?php echo $n?> h3 span, <?php echo $n?> h4 span, <?php echo $n?> h5 span, <?php echo $n?> h6 span { background-image: none !important; background-color: <?php echo $c ?> !important; }
	<?php endif; ?>
	<?php if(!ct_get_option('style_color_'.$k.'_background') && ($b = ct_get_option('style_color_'.$k.'_background_image'))):?>
	<?php echo $n?> h1 span, <?php echo $n?> h2 span, <?php echo $n?> h3 span, <?php echo $n?> h4 span, <?php echo $n?> h5 span, <?php echo $n?> h6 span { background: transparent url("<?php echo $b ?>")!important; }
	<?php if($k == 3):?>
	.navbar .nav > li > a:hover {background: url(<?php echo $b?>) repeat;}
	<?php endif;?>
	<?php endif;?>
	<?php echo ct_get_option_pattern('style_color_'.$k.'_text', '.patBright .vbright {color: %s;}')?><?php echo ct_get_option_pattern('style_color_'.$k.'_heading', $n.' h2,'.$n.' h2, '.$n.' h3, '.$n.' h4, '.$n.' h5, '.$n.' h6 {color: %s!important}')?>	<?php echo ct_get_option_pattern('style_color_'.$k.'_heading_strong', $n.' h2 strong,'.$n.' h2 strong, '.$n.' h3 strong, '.$n.' h4 strong, '.$n.' h5 strong, '.$n.' h6 strong{color: %s!important}')?><?php echo ct_get_option_pattern('style_color_'.$k.'_link', $n.' a {color: %s;}')?>
	<?php echo ct_get_option_pattern('style_color_'.$k.'_link_hover', $n.' a:hover {color: %s;}')?>
	<?php /** contact widget **/ ?>
	<?php echo ct_get_option_patterns(array('style_contact_widget_'.$k.'_label_color' => 'color: %s!important;'), $n.' .widget_contact em') ?>
	<?php endforeach;?>
	<?php /*custom style - code tab*/ ?>
	<?php echo ct_get_option('code_custom_styles_css')?>
</style>