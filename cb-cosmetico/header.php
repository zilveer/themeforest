<?php if (! isset($content_width)) $content_width=980; ?>
<!DOCTYPE html>
<html>
<head>
<title><?php if(in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))){if(is_product()){echo get_the_title().' | ';}} if(get_post_type($post)=='product') { ?>
<?php woocommerce_page_title(); ?> | <?php bloginfo('name'); ?> <?php } else { ?>
<?php if(is_front_page()) { ?> <?php bloginfo('description'); ?> | <?php } ?>
<?php if(is_search()) { ?><?php _e('Search Results','cb-cosmetico');?> | <?php bloginfo('name'); ?> <?php } ?>
<?php if(is_author()) { ?><?php _e('Author Archives','cb-cosmetico');?> | <?php bloginfo('name'); ?> <?php } ?>
<?php if(is_single()) { ?> <?php the_title(); ?> | <?php bloginfo('name');?>
<?php } ?> <?php if(is_page()) { ?> <?php the_title(); ?> | <?php bloginfo('name');?>
<?php } ?> <?php if(is_archive()) { if(is_category()) { single_cat_title(); } else {  ?>
<?php echo single_cat_title(); echo single_month_title(' '); } ?> | <?php bloginfo('name'); ?>
<?php } } ?></title>
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<meta http-equiv="Content-Type"
	content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<meta name="keywords"
	content="<?php echo esc_attr(get_option('cb5_meta_keywords')); ?>" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0"
	href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92"
	href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3"
	href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

<?php $favi=esc_attr(get_option('cb5_favi')); if($favi!=''){?>
<link rel="shortcut icon" type="image/png" href="<?php echo $favi; ?>" />
<?php } else { ?>
<link rel="shortcut icon" type="image/png"
	href="<?php echo WP_THEME_URL; ?>/img/favicon.ico" />
<?php } ?>

<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="<?php echo WP_THEME_URL; ?>/inc/css/drop_ie.css" media="screen" /><![endif]-->
<!--[if lte IE 7]><link rel="stylesheet" href="<?php echo WP_THEME_URL; ?>/inc/js/anything_slider/css/anythingslider-ie.css" type="text/css" media="screen" /><![endif]-->

<?php
require_once(get_template_directory().'/inc/cb-general-options.php');
require_once(get_template_directory().'/inc/cb-page-options.php');
$is_woo='';
if (in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))) {
	$is_woo='woocommerce woocommerce-page';
	if(is_single())$is_woo='';
} else $is_woo='';

wp_head();
?>
</head>
<body <?php body_class($is_woo); ?>>
	<div id="bg">
		<div class="bg_head">





		<?php $dfixed='';
		/*  Floating menu wrapper  */
		if($fixed_top=='yes'&&($wid=='fixed'||$dfixed=='true')) { ?>
			<div class="wrapper_p dfwrap">
			<?php } ?>

			<?php
			/*  top widget  */
			if(is_active_sidebar('top-widget')&&$hide_top!='yes'){?>
				<div class="widget_top">
					<div class="wrapper_p">
						<ul>
						<?php dynamic_sidebar('top-widget'); ?>
						</ul>
						<div id="socials_a">
							<ul>
							<?php
							if($fb!='') echo '<li class="w16"><a class="fb" href="'.$fb.'" target="_blank"></a></li>'; if($tw!='') echo '<li class="w16"><a class="tw" href="'.$tw.'" target="_blank"></a></li>'; if($in!='') echo '<li class="w16"><a class="in" href="'.$in.'" target="_blank"></a></li>'; if($yt!='') echo '<li class="w16"><a class="yt" href="'.$yt.'" target="_blank"></a></li>'; if($vi!='') echo '<li class="w16"><a class="vi" href="'.$vi.'" target="_blank"></a></li>'; if($rss!='') echo '<li class="w16"><a class="rss" href="'.$rss.'" target="_blank"></a></li>'; ?>
							</ul>
						</div>
						<div class="cl"></div>


					</div>
				</div>
				<?php }
				/* top widget end   */
				?>

				<div class="head_top_container">
					<div class="wrapper_p top_header">
						<div class="top_con">
							<div class="toph_l">
							<?php if(is_active_sidebar('top-header-left')) { ?>
								<ul>
								<?php dynamic_sidebar('top-header-left'); ?>
								</ul>
								<?php } ?>
							</div>
							<div class="toph_c">
								<div class="logo">
								<?php if($show_logo=='yes'||$upload_logo=='') { ?>
									<h1>
										<a href="<?php echo esc_url(home_url()); ?>/"><?php echo $cb5_logo_text; ?>
										<?php if($cb5_logo_text=='') echo get_bloginfo('name'); ?> </a>
									</h1>
									<p class="blog-description">
									<?php echo $cb5_logo_slogan; ?>
									</p>
									<?php } else { ?>
									<a href="<?php echo esc_url(home_url()); ?>/"><img
										src="<?php echo $upload_logo;?>"
										alt="<?php echo $cb5_logo_text; ?>"
										class="skin_bg cosmetico_logo" /> </a>
										<?php } ?>
								</div>
							</div>
							<div class="toph_r">
							<?php if(is_active_sidebar('top-header-right')) { ?>
								<ul>
								<?php dynamic_sidebar('top-header-right'); ?>
								</ul>
								<?php } ?>
							</div>
						</div>
						<div class="cl"></div>
					</div>
					<div class="top_header_bottom">
						<div class="wrapper_p">
							<div class="menu">
								<ul id="cb-menu" class="drop round gr">
								<?php if (has_nav_menu('main-menu')) {
									wp_nav_menu(array('theme_location'=>'main-menu','container'=>'','items_wrap'=>'%3$s','fallback_cb'=>false));
								} else {
									wp_nav_menu(array('menu'=>'main-menu','container'=>'','items_wrap'=>'%3$s','fallback_cb'=>false));
								} ?>
								<?php if(in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))){if($woo_menu=='yes') {
									$cat_children=array();
									$cat_children_vals=array();
									$cat_children_old=array(); $i=0;
									$catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'menu_order'));
									foreach($catTerms as $catTerm) :
									if($catTerm->parent!='0') {
										$i++;
										$cat_children[$catTerm->parent][$i]=$catTerm;
									}
									endforeach;
									foreach($catTerms as $catTerm) :
									$curty=get_query_var('product_cat');
									if($catTerm->parent=='0') { if($catTerm->slug==$curty) $curty=' class="current-menu-item current_page_item menu-item product_cat"'; else $curty=''; ?>
									<li <?php echo $curty;?>><a
										href="<?php $cattr=$catTerm->slug; $tr=get_term_link($cattr, 'product_cat'); if(is_wp_error($tr) ) continue; echo $tr;?>">
										<?php echo $catTerm->name; ?> </a> <?php foreach($cat_children as $catck => $catckv) {
											if($catck==$catTerm->term_id) {
												echo '<ul>';
												foreach($catckv as $cat_f) { $curty=get_query_var('product_cat'); if($cat_f->slug==$curty) $curty=' class="current-menu-item current_page_item menu-item product_cat"'; else $curty='';
												$cattr=$cat_f->slug; $tr=get_term_link($cattr, 'product_cat'); if(is_wp_error($tr) ) continue;
												echo '<li'.$curty.'><a href="'.$tr.'">'.$cat_f->name.'</a></li>';
												}
												echo '</ul>';

											}

										}?></li>
										<?php } endforeach;
								}} ?>
								<?php if($showmenusearch=='yes'){?>
									<li class="cb-menu-search">
										<form method="get" id="searchform"
											action="<?php echo home_url();?>">
											<input type="text" class="field" name="s" id="s"
												placeholder="<?php _e('Type and hit enter','cb-cosmetico');?>" /> <i class="icon-search"></i><input
												type="hidden" name="post_type" value="product">
										</form>
									</li>
									<?php } ?>
								</ul>
							</div>

							<?php
							/* mobile menu */
							if(!isset($sl))$sl='';
							echo '<div class="nav-mobile skin_bg"><a title="Show/Hide Menu"></a></div><ul id="mobile-menu">';
							?>	<?php if (has_nav_menu('main-menu')) {
									wp_nav_menu(array('theme_location'=>'main-menu','container'=>'','items_wrap'=>'%3$s','fallback_cb'=>false));
								} else {
									wp_nav_menu(array('menu'=>'main-menu','container'=>'','items_wrap'=>'%3$s','fallback_cb'=>false));
								} ?>
								<?php if(in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))){if($woo_menu=='yes') {
									$cat_children=array();
									$cat_children_vals=array();
									$cat_children_old='';
									$catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'menu_order'));
									foreach($catTerms as $catTerm) :
									if($catTerm->parent!='0') {
										if($cat_children_old!=$catTerm->parent) $cat_children_vals=array();
										array_push($cat_children_vals,$catTerm);
										$cat_children[$catTerm->parent]=$cat_children_vals;
										$cat_children_old=$catTerm->parent;
									}
									endforeach;
									foreach($catTerms as $catTerm) :
									$curty=get_query_var('product_cat');
									if($catTerm->parent=='0') { if($catTerm->slug==$curty) $curty=' class="current-menu-item current_page_item menu-item product_cat"'; else $curty=''; ?>
									<li <?php echo $curty;?>><a
										href="<?php $cattr=$catTerm->slug; $tr=get_term_link($cattr, 'product_cat'); if(is_wp_error($tr) ) continue; echo $tr;?>">
										<?php echo $catTerm->name; ?> </a> <?php foreach($cat_children as $catck => $catckv) {
											if($catck==$catTerm->term_id) {
												echo '<ul class="sub-menu">';
												foreach($catckv as $cat_f) { $curty=get_query_var('product_cat'); if($cat_f->slug==$curty) $curty=' class="current-menu-item current_page_item menu-item product_cat"'; else $curty='';
												$cattr=$cat_f->slug; $tr=get_term_link($cattr, 'product_cat'); if(is_wp_error($tr) ) continue;
												echo '<li'.$curty.'><a href="'.$tr.'">'.$cat_f->name.'</a></li>';
												}
												echo '</ul>';

											}

										}?></li>
										<?php } endforeach;
								}} ?>
							<?php echo '</ul>';
							
							?>

							<div class="cl"></div>
						</div>
					</div>


					<div class="cl"></div>
				</div>
				<!-- head_top_container end -->






				<?php
				/*  Floating menu wrapper end  */
				if($fixed_top=='yes'&&($wid=='fixed'||$dfixed=='true')) { ?>
			</div>
			<?php } ?>

			<?php if($fixed_top=='yes') { ?>
			<div class="fixed_top"></div>
			<?php } ?>


			<?php
			/*  fullscreen slider  */
		 if(($full_slider=='yes'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$full_slider_where=='yes' ) )||$slider_home=='full'){
				get_template_part('inc/headers/full');
			} ?>


			<?php $sth='-154';$sth2='-154px!important;'; ?>

			<?php if(!isset($header_height))$header_height='';
			if(!isset($showbreads))$showbreads='yes';
			?>
			<div class="slider_top" style="<?php if(isset($_GET['s']))$sgets=esc_attr($_GET['s']); else $sgets=''; if(($slide_home=='yes'||($slider_home!='none'&&$slider_home!='')||($slide_home=='home'&&is_front_page()))&&$sgets==''){ echo 'padding-top:0px;padding-bottom:0px;'; } if($header_height!=''&&$header_type=='bg_head') echo 'padding-top:'.$header_height.'px;'; if(($slide_type=='round'&&(is_home()||is_front_page()))||$slider_home=='round') echo 'padding:0;'; if( ($full_slider=='yes'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$full_slider_where=='yes' ) )||$slider_home=='full') echo 'padding:0;'; if($showbreads!='no'&&$show_bread=='yes'&&$header_type!='slider_head'){ if(function_exists('yoast_breadcrumb')){?> margin-bottom:55px;<?php } }?>">


			<?php
			/*  map header type  */
			if($header_type=='map'&&$map_a!=''){
				get_template_part('inc/headers/map');
			} ?>




			<?php
			/*  revolution slider header type  */
		 if(($cb_type=='portfolio'||$header_bg_image!='')&&is_single()&&$header_type=='bg_head') { ?>
				<div id="loading"></div>
				<?php } ?>

				<?php
				$s = '';
				if(isset($_GET['s']))$s=esc_attr(strip_tags($_GET['s']));

				if( (($slide_type=='revo'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$slide_home=='yes' ) )||$slider_home=='revo'&&$s==''&&$slide_home!='no')||$slider_home=='revo'){
					if(class_exists("RevSlider")&&($slide_home!='no'||$slider_home=='revo')){
						$slider5 = new RevSlider();
						$arrSliders = $slider5->getArrSliders();
						$salias='';
						foreach($arrSliders as $slider5):
						$salias.=$slider5->getAlias();
                        if($slider5->getAlias()==$revo_type)$rev_slider_name=$slider5->getAlias();
						endforeach;
                      
						if($salias!='')

						putRevSlider($rev_slider_name);
						else echo '<h1 class="confin" style="font-size:20px;padding-top:100px;">Configure this element in Revolution Slider Settings</h1>';
					}else{
						if($slide_home!='no')echo '<h1 class="confin" style="font-size:20px;padding-top:100px;">Change slider settings or activate Revolution Slider</h1>';
					}
				}

				if( ($slide_type=='any'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$slide_home=='yes' ) )||$slider_home=='any'&&$s==''){
					get_template_part('inc/headers/any');
				} ?>

				<?php
				/*  below slider sidebar  */
				if(is_active_sidebar('slider')) { ?>
				<div class="wrapper_p">

					<div id="slider_widget">
						<?php dynamic_sidebar('slider'); ?>
					</div>

					<div class="cl"></div>

				</div>
				<?php } ?>
