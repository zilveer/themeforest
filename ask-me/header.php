<?php ob_start();?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=9">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head();?>
</head>
<?php
$site_users_only = vpanel_options("site_users_only");
if ($site_users_only != 1) {
	$site_users_only = "no";
}else {
	$site_users_only = (!is_user_logged_in()?"yes":"no");
}

$vbegy_layout = "";
if (is_single() || is_page()) {
	$vbegy_layout = rwmb_meta('vbegy_layout','radio',$post->ID);
	$vbegy_layout = ($vbegy_layout != ""?$vbegy_layout:"default");
}

$cat_layout = "";
if (is_category()) {
	$category_id = get_query_var('cat');
	$categories = get_option("categories_$category_id");
	$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
}else if (is_tax("product_cat")) {
	$tax_id = get_term_by('slug',get_query_var('term'),"product_cat");
	$tax_id = $tax_id->term_id;
	$categories = get_option("categories_$tax_id");
	$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
	if ($cat_layout == "" || $cat_layout == "default") {
		$cat_layout = vpanel_options("products_layout");
	}
}else if (is_tax("product_tag") || is_post_type_archive("product")) {
	$products_layout = vpanel_options("products_layout");
}else if (is_tax("question-category")) {
	$tax_id = get_term_by('slug',get_query_var('term'),"question-category");
	$tax_id = $tax_id->term_id;
	$categories = get_option("categories_$tax_id");
	$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
	if ($cat_layout == "default") {
		$cat_layout = vpanel_options("questions_layout");
	}
}else if (is_tax("question_tags") || is_post_type_archive("question")) {
	$questions_layout = vpanel_options("questions_layout");
}else if (is_single() || is_page()) {
	if (is_singular("product") && ($vbegy_layout == "" || $vbegy_layout == "default")) {
		$vbegy_layout = vpanel_options("products_layout");
	}
	if (is_singular("question") && ($vbegy_layout == "" || $vbegy_layout == "default")) {
		$vbegy_layout = vpanel_options("questions_layout");
	}
	if ($vbegy_layout == "" || $vbegy_layout == "default") {
		$vbegy_layout = vpanel_options("home_layout");
	}
}
$home_layout = vpanel_options("home_layout");
$top_panel_skin = vpanel_options("top_panel_skin");
$header_skin = vpanel_options("header_skin");
$header_fixed = vpanel_options("header_fixed");
$author_layout = vpanel_options("author_layout");
if (is_author() && $author_layout != "default" && $author_layout != "") {
	$home_layout = $author_layout;
}
if (is_singular("question")) {
	$questions_layout = vpanel_options("questions_layout");
}
if (is_singular("product")) {
	$products_layout = vpanel_options("products_layout");
}

$boxed_1 = "boxed";
$boxed_2 = "boxed2";
$boxed_end = "";
if (is_category() && $cat_layout != "default" && $cat_layout != "") {
	if ($cat_layout == "fixed") {
		$boxed_end = $boxed_1;
	}else if ($cat_layout == "fixed_2") {
		$boxed_end = $boxed_2;
	}
}else if (is_tax("question-category") && $cat_layout != "default" && $cat_layout != "") {
	if ($cat_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($cat_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if (is_tax("question_tags") && $questions_layout != "default" && $questions_layout != "") {
	if ($questions_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($questions_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if (is_post_type_archive("question") && $questions_layout != "default" && $questions_layout != "") {
	if ($questions_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($questions_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if (is_tax("product_cat") && $cat_layout != "default" && $cat_layout != "") {
	if ($cat_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($cat_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if (is_tax("product_tag") && $products_layout != "default" && $products_layout != "") {
	if ($products_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($products_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if ((is_post_type_archive("product")) && $products_layout != "default" && $products_layout != "") {
	if ($products_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($products_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else {
	if ((is_single() || is_page()) && $vbegy_layout != "default" && $vbegy_layout != "") {
		if ($vbegy_layout == "fixed") {
			$boxed_end = $boxed_1;
		}else if ($vbegy_layout == "fixed_2") {
			$boxed_end = $boxed_2;
		}else if ($vbegy_layout == "full") {
			$boxed_end = "";
		}
	}else {
		if (is_singular("product") && $products_layout != "default" && $products_layout != "") {
			if ($products_layout == "fixed") {
				$boxed_end = $boxed_1;
			}else if ($products_layout == "fixed_2") {
				$boxed_end = $boxed_2;
			}else if ($products_layout == "full") {
				$boxed_end = "";
			}
		}else if (is_singular("question") && $questions_layout != "default" && $questions_layout != "") {
			if ($questions_layout == "fixed") {
				$boxed_end = $boxed_1;
			}else if ($questions_layout == "fixed_2") {
				$boxed_end = $boxed_2;
			}else if ($questions_layout == "full") {
				$boxed_end = "";
			}
		}else {
			if ($home_layout == "fixed") {
				$boxed_end = $boxed_1;
			}else if ($home_layout == "fixed_2") {
				$boxed_end = $boxed_2;
			}else if ($home_layout == "full") {
				$boxed_end = "";
			}
		}
	}
}
?>
<body <?php echo (isset($boxed_end) && $boxed_end != ""?"id='body_".$boxed_end."'":"")?> <?php body_class();?>>
	<div class="background-cover"></div>
	<?php
	$loader_option = vpanel_options("loader");
	if ($loader_option == 1) {?>
		<div class="loader"><div class="loader_html"></div></div>
	<?php }
	
	if (!is_user_logged_in()) {
		if (isset($_POST["form_type"]) && ($_POST["form_type"] == "ask-signup" || $_POST["form_type"] == "ask-login" || $_POST["form_type"] == "ask-forget")) {?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					function wrap_pop() {
						jQuery(".wrap-pop").click(function () {
							jQuery(".panel-pop").animate({"top":"-100%"},500).fadeOut(function () {
								jQuery(this).animate({"top":"-100%"},500);
							});
							jQuery(this).remove();
						});
					}
					jQuery(".panel-pop").animate({"top":"-100%"},10).hide();
					<?php if ($_POST["form_type"] == "ask-signup") {?>
						jQuery("#signup").show().animate({"top":"2%"},500);
					<?php }else if ($_POST["form_type"] == "ask-login") {?>
						jQuery("#login-comments").show().animate({"top":"2%"},500);
					<?php }else if ($_POST["form_type"] == "ask-forget") {?>
						jQuery("#lost-password").show().animate({"top":"2%"},500);
					<?php }?>
					jQuery("html,body").animate({scrollTop:0},500);
					jQuery("body").prepend("<div class='wrap-pop'></div>");
					wrap_pop();
				});
			</script>
		<?php }
		
		if ((isset($_POST["form_type"]) && $_POST["form_type"] == "ask-signup") || empty($_POST)) {?>
			<div class="panel-pop" id="signup">
				<h2><?php _e("Register Now","vbegy");?><i class="icon-remove"></i></h2>
				<div class="form-style form-style-3">
					<?php echo do_shortcode("[ask_signup]");?>
				</div>
			</div><!-- End signup -->
		<?php }
		
		if ((isset($_POST["form_type"]) && $_POST["form_type"] == "ask-login") || empty($_POST)) {?>
			<div class="panel-pop" id="login-comments">
				<h2><?php _e("Login","vbegy");?><i class="icon-remove"></i></h2>
				<div class="form-style form-style-3">
					<?php echo do_shortcode("[ask_login]");?>
				</div>
			</div><!-- End login-comments -->
		<?php }
		
		if ((isset($_POST["form_type"]) && $_POST["form_type"] == "ask-forget") || empty($_POST)) {?>
			<div class="panel-pop" id="lost-password">
				<h2><?php _e("Lost Password","vbegy");?><i class="icon-remove"></i></h2>
				<div class="form-style form-style-3">
					<p><?php _e("Lost your password? Please enter your email address. You will receive a link and will create a new password via email.","vbegy");?></p>
					<?php echo do_shortcode("[ask_lost_pass]");?>
					<div class="clearfix"></div>
				</div>
			</div><!-- End lost-password -->
		<?php }
	}
	
	if (isset($_POST["form_type"]) && $_POST["form_type"] == "add_question") {?>
		<div class="panel-pop panel-pop-ask" id="ask-question">
			<h2><?php _e("Add question","vbegy");?><i class="icon-remove"></i></h2>
			<div class="form-style form-style-3">
				<?php echo do_shortcode("[ask_question]");?>
			</div>
		</div><!-- End ask-question -->
	<?php }
	
	if (is_tax("question_tags")) {
		$grid_template_q = vpanel_options("questions_template");
		$grid_template_q = ($grid_template_q != ""?$grid_template_q:"default");
	}
	if (is_author()) {
		$grid_template_a = vpanel_options("author_template");
		$grid_template = $grid_template_a;
	}else if (is_category()) {
		$grid_template_c = (isset($categories["cat_template"])?$categories["cat_template"]:"default");
		$grid_template = $grid_template_c;
	}else if (is_tax("question-category")) {
		$grid_template_c = (isset($categories["cat_template"])?$categories["cat_template"]:"default");
		$grid_template = $grid_template_c;
		if ($grid_template == "default") {
			$grid_template_c = vpanel_options("questions_template");
			$grid_template = $grid_template_c;
		}
	}else if (is_tax("question_tags") || is_post_type_archive("question")) {
		$grid_template = vpanel_options("questions_template");
		$grid_template = ($grid_template != ""?$grid_template:"default");
	}else if (is_tax("product_cat")) {
		$grid_template_c = (isset($categories["cat_template"])?$categories["cat_template"]:"default");
		$grid_template = $grid_template_c;
		if ($grid_template == "" || $grid_template == "default") {
			$grid_template_c = vpanel_options("products_template");
			$grid_template = $grid_template_c;
		}
	}else if (is_tax("product_tag") || is_post_type_archive("product")) {
		$grid_template = vpanel_options("products_template");
		$grid_template = ($grid_template != ""?$grid_template:"default");
	}else {
		if (is_single() || is_page()) {
			$grid_template_s = rwmb_meta('vbegy_home_template','radio',$post->ID);
			if (is_singular("question")) {
				$grid_template_q = vpanel_options("questions_template");
				$grid_template_q = ($grid_template_q != ""?$grid_template_q:"default");
			}
			if (is_singular("product")) {
				$grid_template_p = vpanel_options("products_template");
				$grid_template_p = ($grid_template_p != ""?$grid_template_p:"default");
			}
		}
		if ((is_single() || is_page()) && ($grid_template_s != "default" && $grid_template_s != "")) {
			$grid_template = $grid_template_s;
		}else {
			if ((is_singular("question") && $grid_template_q != "default" && $grid_template_q != "")) {
				$grid_template = $grid_template_q;
			}else if ((is_singular("product") && $grid_template_p != "default" && $grid_template_p != "")) {
				$grid_template = $grid_template_p;
			}else {
				$grid_template = vpanel_options("home_template");
			}
		}
	}
	
	if ((is_author() && $grid_template_a == "default") || ((is_single() || is_page()) && $grid_template == "default") || (is_category() && $grid_template_c == "default") || (is_tax("product_cat") && ($grid_template_c == "" || $grid_template_c == "default")) || (is_tax("product_tag") && ($grid_template == "" || $grid_template == "default")) || ((is_post_type_archive("product")) && ($grid_template == "" || $grid_template == "default")) || (is_tax("question-category") && ($grid_template_c == "" || $grid_template_c == "default")) || (is_tax("question_tags") && ($grid_template == "" || $grid_template == "default")) || ((is_post_type_archive("question")) && ($grid_template == "" || $grid_template == "default"))) {
		$grid_template = vpanel_options("home_template");
	}
	
	$nicescroll = vpanel_options("nicescroll");?>
	<div id="wrap" class="<?php echo $grid_template." ";if ($header_fixed == 1) {echo "fixed-enabled ";}echo $boxed_end;if ($nicescroll == 1) {echo " wrap-nicescroll";}?>">
		
		<?php $login_panel = vpanel_options("login_panel");
		$top_menu = vpanel_options("top_menu");
		if ($login_panel == 1 && $top_menu == 1) {?>
			<div class="login-panel <?php if ($top_panel_skin == "panel_light") {echo "panel_light";}else {echo "panel_dark";}?>">
				<section class="container">
					<div class="row">
						<?php if (is_user_logged_in()) {?>
							<div class="col-md-12">
								<div class="page-content">
									<?php echo is_user_logged_in_data(vpanel_options("user_links"))?>
								</div><!-- End page-content -->
							</div><!-- End col-md-12 -->
						<?php }else {?>
							<div class="col-md-6">
								<div class="page-content">
									<h2><?php _e("Login","vbegy")?></h2>
									<div class="form-style form-style-3">
										<?php echo do_shortcode("[ask_login]");?>
									</div>
								</div><!-- End page-content -->
							</div><!-- End col-md-6 -->
							<div class="col-md-6">
								<div class="page-content Register">
									<h2><?php _e("Register Now","vbegy")?></h2>
									<p><?php echo stripslashes(vpanel_options("register_content"))?></p>
									<div class="button color small signup"><?php _e("Create an account","vbegy")?></div>
								</div><!-- End page-content -->
							</div><!-- End col-md-6 -->
						<?php }?>
					</div>
				</section>
			</div><!-- End login-panel -->
		<?php }
		
		if ($top_menu) {?>
			<div id="header-top">
				<section class="container clearfix">
					<div class="row">
						<div class="col-md-6">
							<nav class="header-top-nav">
								<?php 
								if (is_user_logged_in()) {
									wp_nav_menu(array('container_class' => 'header-top','menu_class' => '','theme_location' => 'top_bar_login','fallback_cb' => 'vpanel_nav_fallback'));
								}else {
									wp_nav_menu(array('container_class' => 'header-top','menu_class' => '','theme_location' => 'top_bar','fallback_cb' => 'vpanel_nav_fallback'));
								}?>
							</nav>
							<div class="f_left language_selector">
								<?php do_action('icl_language_selector'); ?>
							</div>
							<div class="clearfix"></div>
						</div><!-- End col-md-6 -->
						<div class="col-md-6">
							<?php $social_icon_h = vpanel_options("social_icon_h");
							if ($social_icon_h == 1) {
								$twitter_icon_f = vpanel_options("twitter_icon_f");
								$facebook_icon_f = vpanel_options("facebook_icon_f");
								$gplus_icon_f = vpanel_options("gplus_icon_f");
								$youtube_icon_f = vpanel_options("youtube_icon_f");
								$skype_icon_f = vpanel_options("skype_icon_f");
								$flickr_icon_f = vpanel_options("flickr_icon_f");
								$linkedin_icon_f = vpanel_options("linkedin_icon_f");
								$rss_icon_f = vpanel_options("rss_icon_f");
								?>
								<div class="social_icons f_right">
									<ul>
										<?php if ($twitter_icon_f) {?>
										<li class="twitter"><a target="_blank" original-title="<?php _e("Twitter","vbegy")?>" class="tooltip-s" href="<?php echo $twitter_icon_f?>"><i class="social_icon-twitter font17"></i></a></li>
										<?php }
										if ($facebook_icon_f) {?>
											<li class="facebook"><a target="_blank" original-title="<?php _e("Facebook","vbegy")?>" class="tooltip-s" href="<?php echo $facebook_icon_f?>"><i class="social_icon-facebook font17"></i></a></li>
										<?php }
										if ($gplus_icon_f) {?>
											<li class="gplus"><a target="_blank" original-title="<?php _e("Google plus","vbegy")?>" class="tooltip-s" href="<?php echo $gplus_icon_f?>"><i class="social_icon-gplus font17"></i></a></li>
										<?php }
										if ($youtube_icon_f) {?>
											<li class="youtube"><a target="_blank" original-title="<?php _e("Youtube","vbegy")?>" class="tooltip-s" href="<?php echo $youtube_icon_f?>"><i class="social_icon-youtube font17"></i></a></li>
										<?php }
										if ($skype_icon_f) {?>
											<li class="skype"><a target="_blank" original-title="<?php _e("Skype","vbegy")?>" class="tooltip-s" href="skype:<?php echo $skype_icon_f?>?call"><i class="social_icon-skype font17"></i></a></li>
										<?php }
										if ($flickr_icon_f) {?>
											<li class="flickr"><a target="_blank" original-title="<?php _e("Flickr","vbegy")?>" class="tooltip-s" href="<?php echo $flickr_icon_f?>"><i class="social_icon-flickr font17"></i></a></li>
										<?php }
										if ($linkedin_icon_f) {?>
											<li class="linkedin"><a target="_blank" original-title="<?php _e("Linkedin","vbegy")?>" class="tooltip-s" href="<?php echo $linkedin_icon_f?>"><i class="social_icon-linkedin font17"></i></a></li>
										<?php }
										if ($rss_icon_f == 1) {?>
											<li class="rss"><a original-title="<?php _e("Rss","vbegy")?>" class="tooltip-s" href="<?php echo (vpanel_options("rss_icon_f_other") != ""?vpanel_options("rss_icon_f_other"):bloginfo('rss2_url'));?>"><i class="social_icon-rss font17"></i></a></li>
										<?php }?>
									</ul>
								</div><!-- End social_icons -->
							<?php }
							
							$header_search = vpanel_options("header_search");
							if ($header_search == 1) {?>
								<div class="header-search">
									<form method="get" action="<?php echo home_url('/'); ?>">
									    <input type="text" value="<?php if (get_search_query() != "") {echo the_search_query();}else {_e("Search here ...","vbegy");}?>" onfocus="if(this.value=='<?php _e("Search here ...","vbegy");?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e("Search here ...","vbegy");?>';" name="s">
									    <button type="submit" class="search-submit"></button>
									</form>
								</div>
							<?php }
							
							$header_cart = vpanel_options("header_cart");
							if (class_exists('woocommerce') && $header_cart == 1) {
								echo "<div class='cart-wrapper'>";
									global $woocommerce;
									$cart_url = $woocommerce->cart->get_cart_url();
									$num = $woocommerce->cart->cart_contents_count;
									echo '<a href="'.$cart_url.'" class="cart_control nav-button nav-cart"><i class="enotype-icon-cart"></i>';
										echo '<span class="numofitems" data-num="'.$num.'">'.$num.'</span>';
									echo '</a>';
									echo '<div class="cart_wrapper'.(sizeof($woocommerce->cart->get_cart()) < 1?" cart_wrapper_empty":"").'"><div class="widget_shopping_cart_content"></div></div>';
								echo "</div>";
							}?>
							<div class="clearfix"></div>
						</div><!-- End col-md-6 -->
					</div><!-- End row -->
				</section><!-- End container -->
			</div><!-- End header-top -->
		<?php }
		
		$index_top_box = "";
		if ((is_home() || is_front_page()) && !is_page_template("template-home.php")) {
			$index_top_box = vpanel_options('index_top_box');
			$index_top_box_layout = vpanel_options('index_top_box_layout');
			$index_about = vpanel_options('index_about');
			$index_about_h = vpanel_options('index_about_h');
			$index_join = vpanel_options('index_join');
			$index_join_h = vpanel_options('index_join_h');
			$index_about_login = vpanel_options('index_about_login');
			$index_about_h_login = vpanel_options('index_about_h_login');
			$index_join_login = vpanel_options('index_join_login');
			$index_join_h_login = vpanel_options('index_join_h_login');
			$index_title = vpanel_options("index_title");
			$index_content = vpanel_options("index_content");
			$index_top_box_background = vpanel_options("index_top_box_background");
			$background_home = vpanel_options("background_home");
			$background_full_home = vpanel_options("background_full_home");
			$background_full_home = ($background_full_home == 1?"-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;":"");
			$background_color_home = (isset($background_home["color"]) && $background_home["color"] != ""?"background-color:".$background_home["color"].";":"");
			$background_img_home = (isset($background_home["image"]) && $background_home["image"] != ""?"background-image:url(".$background_home["image"].");":"");
			$background_repeat_home = (isset($background_home["repeat"]) && $background_home["repeat"] != ""?"background-repeat:".$background_home["repeat"].";":"");
			$background_fixed_home = (isset($background_home["attachment"]) && $background_home["attachment"] != ""?"background-attachment:".$background_home["attachment"].";":"");
			$background_position_home = (isset($background_home["position"]) && $background_home["position"] != ""?"background-position:".$background_home["position"].";":"");
			if ($index_top_box_background == "background") {
				$index_top_box_style = "style='".$background_color_home.$background_img_home.$background_repeat_home.$background_fixed_home.$background_position_home.$background_full_home."'";
			}else {
				$index_top_box_style = "";
			}
			$remove_index_content = vpanel_options("remove_index_content");
		}else {
			if (is_page_template("template-home.php")) {
				$index_top_box = rwmb_meta('vbegy_index_top_box','checkbox',$post->ID);
				$index_top_box_layout = rwmb_meta('vbegy_index_top_box_layout','radio',$post->ID);
				$index_about = rwmb_meta('vbegy_index_about','text',$post->ID);
				$index_about_h = rwmb_meta('vbegy_index_about_h','text',$post->ID);
				$index_join = rwmb_meta('vbegy_index_join','text',$post->ID);
				$index_join_h = rwmb_meta('vbegy_index_join_h','text',$post->ID);
				$index_about_login = rwmb_meta('vbegy_index_about_login','text',$post->ID);
				$index_about_h_login = rwmb_meta('vbegy_index_about_h_login','text',$post->ID);
				$index_join_login = rwmb_meta('vbegy_index_join_login','text',$post->ID);
				$index_join_h_login = rwmb_meta('vbegy_index_join_h_login','text',$post->ID);
				$index_title = rwmb_meta('vbegy_index_title','text',$post->ID);
				$index_content = rwmb_meta('vbegy_index_content','textarea',$post->ID);
				$index_top_box_background = rwmb_meta('vbegy_index_top_box_background','radio',$post->ID);
				$upload_images_home = rwmb_meta('vbegy_upload_images_home','image_advanced',$post->ID);
				$background_color_home = rwmb_meta('vbegy_background_color_home','color',$post->ID);
				$background_img_home = rwmb_meta('vbegy_background_img_home','upload',$post->ID);
				$background_repeat_home = rwmb_meta('vbegy_background_repeat_home','select',$post->ID);
				$background_fixed_home = rwmb_meta('vbegy_background_fixed_home','select',$post->ID);
				$background_position_x_home = rwmb_meta('vbegy_background_position_x_home','select',$post->ID);
				$background_position_y_home = rwmb_meta('vbegy_background_position_y_home','select',$post->ID);
				$background_full_home = rwmb_meta('vbegy_background_full_home','checkbox',$post->ID);
				$background_color_home = (isset($background_color_home) && $background_color_home != ""?"background-color:".$background_color_home.";":"");
				$background_img_home = (isset($background_img_home) && $background_img_home != ""?"background-image:url(".$background_img_home.");":"");
				$background_repeat_home = (isset($background_repeat_home) && $background_repeat_home != ""?"background-repeat:".$background_repeat_home.";":"");
				$background_fixed_home = (isset($background_fixed_home) && $background_fixed_home != ""?"background-attachment:".$background_fixed_home.";":"");
				$background_position_x_home = (isset($background_position_x_home) && $background_position_x_home != ""?"background-position-x:".$background_position_x_home.";":"");
				$background_position_y_home = (isset($background_position_y_home) && $background_position_y_home != ""?"background-position-y:".$background_position_y_home.";":"");
				$background_full_home = ($background_full_home == 1?"-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;":"");
				if ($index_top_box_background == "background") {
					$index_top_box_style = "style='".$background_color_home.$background_img_home.$background_repeat_home.$background_fixed_home.$background_position_x_home.$background_position_y_home.$background_full_home."'";
				}else {
					$index_top_box_style = "";
				}
				$remove_index_content = rwmb_meta('vbegy_remove_index_content','checkbox',$post->ID);
			}
		}
		
		$breadcrumbs = vpanel_options("breadcrumbs");
		$logo_position = vpanel_options("logo_position");
		$logo_display = vpanel_options("logo_display");
		$logo_img = vpanel_options("logo_img");
		$retina_logo = vpanel_options("retina_logo");
		
		if (is_tax("product_cat") || is_tax("product_tag") || is_post_type_archive("product") || is_singular("product")) {
			$products_custom_header = vpanel_options("products_custom_header");
			if ($products_custom_header == 1) {
				$logo_position = vpanel_options("products_logo_position");
				$header_skin = vpanel_options("products_header_skin");
				$logo_display = vpanel_options("products_logo_display");
				$logo_img = vpanel_options("products_logo_img");
				$retina_logo = vpanel_options("products_retina_logo");
			}
		}else if (is_tax("question-category") || is_tax("question_tags") || is_post_type_archive("question") || is_singular("question")) {
			$questions_custom_header = vpanel_options("questions_custom_header");
			if ($questions_custom_header == 1) {
				$logo_position = vpanel_options("questions_logo_position");
				$header_skin = vpanel_options("questions_header_skin");
				$logo_display = vpanel_options("questions_logo_display");
				$logo_img = vpanel_options("questions_logo_img");
				$retina_logo = vpanel_options("questions_retina_logo");
			}
		}
		?>
		<header id="header" class='<?php if ($header_skin == "header_light") {echo "header_light ";}
		if (is_front_page() || is_home()) {
			if ($index_top_box != 1) {
				echo "index-no-box ";
			}
		}else {
			if (is_page_template("template-home.php")) {
				if (($breadcrumbs != 1 && $index_top_box != 1) || ($breadcrumbs == 1 && $index_top_box != 1)) {
					echo "index-no-box ";
				}
			}else {
				if ($breadcrumbs != 1 && $index_top_box != 1) {
					echo "index-no-box ";
				}
			}
		}
		if ($logo_position == "right_logo") {echo "header_2 ";}else if ($logo_position == "center_logo") {echo "header_3 ";}?>'>
			<section class="container clearfix">
				<div class="logo">
					<?php
					if ($logo_display == "custom_image") {?>
					    <a class="logo-img" href="<?php echo esc_url(home_url('/'));?>" itemprop="url" title="<?php echo esc_attr(get_bloginfo('name','display'))?>">
					    	<?php if (isset($logo_img) && $logo_img != "") {?>
					    		<img class="default_logo" itemprop="logo" alt="<?php echo esc_attr(get_bloginfo('name','display'))?>" src="<?php echo $logo_img?>">
					    	<?php }
					    	if (isset($retina_logo) && $retina_logo != "") {?>
					    		<img class="retina_logo" itemprop="logo" alt="<?php echo esc_attr(get_bloginfo('name','display'))?>" src="<?php echo esc_attr($retina_logo)?>">
					    	<?php }
					    	if ($retina_logo == "" && isset($logo_img) && $logo_img != "") {?>
					    		<img class="retina_logo" itemprop="logo" alt="<?php echo esc_attr(get_bloginfo('name','display'))?>" src="<?php echo esc_attr($logo_img)?>">
					    	<?php }?>
					    </a>
					<?php }else {?>
						<h2><a href="<?php echo esc_url(home_url('/'));?>" itemprop="url" title="<?php echo esc_attr(get_bloginfo('name','display'))?>"><?php bloginfo('name');?></a></h2>
					<?php }?>
					<meta itemprop="name" content="<?php bloginfo('name'); ?>">
				</div>
				<nav class="navigation">
					<?php wp_nav_menu(array('container_class' => 'header-menu','menu_class' => '','theme_location' => 'header_menu','fallback_cb' => 'vpanel_nav_fallback'));?>
				</nav>
				<nav class="navigation_mobile navigation_mobile_main">
					<div class="navigation_mobile_click"><?php _e("Go to...","vbegy")?></div>
					<ul></ul>
				</nav><!-- End navigation_mobile -->
			</section><!-- End container -->
		</header><!-- End header -->
		
		<?php if ($site_users_only != "yes") {
			if (is_page_template("template-home.php") || is_front_page()) {
				$ask_a_new_question = __("Ask any question and you be sure find your answer ?","vbegy");
				if ($index_top_box == 1) {?>
					<div class="section-warp ask-me<?php echo (isset($remove_index_content) && $remove_index_content == 1?" remove-index-content":"")?>"<?php echo $index_top_box_style?>>
						<?php
						if ($index_top_box_background == "slideshow") {
							$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = 'vbegy_upload_images_home' AND post_id = {$post->ID}");?>
							<div class="flexslider blog_silder margin_b_20 post-img">
							    <ul class="slides">
							    	<?php
							    	foreach ($result as $results) {
							    	    $slideshow_imgs = $results->meta_value.',';
							    	    $slideshow_imgs = explode(",",$slideshow_imgs);
							    	    $images = $wpdb->get_col("
							    	    SELECT ID FROM $wpdb->posts
							    	    WHERE post_type = 'attachment'
							    	    AND ID IN ('".implode("','",$slideshow_imgs)."')
							    	    ORDER BY menu_order ASC");
							    	    foreach ($images as $att) {
							    	    $src = wp_get_attachment_image_src($att,'full');
							    	    $src = $src[0];?>
							    	    <li><img alt="" src="<?php echo $src;?>"></li>
							    	<?php
							    	    }
							    	}?>
							    </ul>
							</div><!-- End flexslider -->
							<?php
						}?>
						<div class="container clearfix">
							<div class="box_icon box_warp box_no_border box_no_background">
								<div class="row">
									<?php if ($remove_index_content != 1) {
										if ($index_top_box_layout == 2) {?>
											<div class="col-md-12">
												<h2><?php echo $index_title;?></h2>
												<p><?php echo $index_content;?></p>
												<div class="clearfix"></div>
												<?php if (is_user_logged_in()) {
													if ($index_about_login != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_about_h_login?>"><?php echo $index_about_login?></a>
													<?php }
													if ($index_join_login != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_join_h_login?>"><?php echo $index_join_login?></a>
													<?php }
												}else {
													if ($index_about != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_about_h?>"><?php echo $index_about?></a>
													<?php }
													if ($index_join != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_join_h?>"><?php echo $index_join?></a>
													<?php }
												}?>
												<div class="clearfix"></div>
												<form class="form-style form-style-2" method="post" action="<?php echo esc_url(get_page_link(vpanel_options('add_question')))?>">
													<p>
														<input name="title" type="text" id="question_title" value="<?php echo $ask_a_new_question;?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
														<i class="icon-pencil"></i>
														<input type="hidden" name="form_type" value="add_question">
														<input type="hidden" name="post_type" value="add_question">
														<button class="ask-question"><span class="color button small publish-question<?php echo (is_user_logged_in()?"":" ask-not-login")?>"><?php _e("Ask Now","vbegy");?></span></button>
													</p>
												</form>
											</div>
										<?php }else {?>
											<div class="col-md-3">
												<h2><?php echo $index_title;?></h2>
												<p><?php echo $index_content;?></p>
												<div class="clearfix"></div>
												<?php if (is_user_logged_in()) {
													if ($index_about_login != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_about_h_login?>"><?php echo $index_about_login?></a>
													<?php }
													if ($index_join_login != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_join_h_login?>"><?php echo $index_join_login?></a>
													<?php }
												}else {
													if ($index_about != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_about_h?>"><?php echo $index_about?></a>
													<?php }
													if ($index_join != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_join_h?>"><?php echo $index_join?></a>
													<?php }
												}?>
											</div>
											<div class="col-md-9">
												<form class="form-style form-style-2" method="post" action="<?php echo esc_url(get_page_link(vpanel_options('add_question')))?>">
													<p>
														<textarea name="title" rows="4" id="question_title" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"><?php echo $ask_a_new_question;?></textarea>
														<i class="icon-pencil"></i>
														<input type="hidden" name="form_type" value="add_question">
														<input type="hidden" name="post_type" value="add_question">
														<button class="ask-question"><span class="color button small publish-question<?php echo (is_user_logged_in()?"":" ask-not-login")?>"><?php _e("Ask Now","vbegy");?></span></button>
													</p>
												</form>
											</div>
										<?php }
									}?>
								</div><!-- End row -->
							</div><!-- End box_icon -->
						</div><!-- End container -->
					</div><!-- End section-warp -->
				<?php
				}
			}else {
				if (is_singular("question")) {
					$question_category = wp_get_post_terms($post->ID,'question-category',array("fields" => "all"));
					$user_get_current_user_id = get_current_user_id();
					$get_question_category = get_option("questions_category_".$question_category[0]->term_id);
					if (isset($question_category[0])) {
						$get_question_category = get_option("questions_category_".$question_category[0]->term_id);
						$yes_private = 0;
						if (isset($question_category[0]) && isset($get_question_category['private']) && $get_question_category['private'] == "on") {
							if (isset($post->post_author) && $post->post_author > 0 && $post->post_author == $user_get_current_user_id) {
								$yes_private = 1;
							}
						}else if (isset($question_category[0]) && !isset($get_question_category['private'])) {
							$yes_private = 1;
						}
					}else {
						$yes_private = 1;
					}
					
					if (is_super_admin($user_get_current_user_id)) {
						$yes_private = 1;
					}
					if ($yes_private != 1 && is_singular("question")) {
						$breadcrumbs = 0;
						$yes_put_it = 1;
					}
				}
				if ($breadcrumbs == 1) {
					breadcrumbs();
				}
				if (isset($yes_put_it) && $yes_put_it == 1) {
					echo "<div class='index-no-box'></div>";
				}
			}
		}// End if site_users_only
		
		$sidebar_width = vpanel_options("sidebar_width");
		$sidebar_width = (isset($sidebar_width) && $sidebar_width != ""?$sidebar_width:"col-md-3");
		$sidebar_layout = "";
		if (isset($sidebar_width) && $sidebar_width == "col-md-3") {
			$container_span = "col-md-9";
		}else {
			$container_span = "col-md-8";
		}
		$full_span = "col-md-12";
		$page_right = "page-right-sidebar";
		$page_left = "page-left-sidebar";
		$page_full_width = "page-full-width";
		
		$sidebar_dir = vpanel_sidebars("sidebar_dir");
		$homepage_content_span = vpanel_sidebars("homepage_content_span");
		$sidebar_class = vpanel_sidebars("sidebar_class");
		
		if ($site_users_only != "yes") {
			if (is_single() || is_page()) {
				$vbegy_header_adv_type = rwmb_meta('vbegy_header_adv_type','radio',$post->ID);
				$vbegy_header_adv_code = rwmb_meta('vbegy_header_adv_code','textarea',$post->ID);
				$vbegy_header_adv_href = rwmb_meta('vbegy_header_adv_href','text',$post->ID);
				$vbegy_header_adv_img = rwmb_meta('vbegy_header_adv_img','upload',$post->ID);
			}
			
			if ((is_single() || is_page()) && (($vbegy_header_adv_type == "display_code" && $vbegy_header_adv_code != "") || ($vbegy_header_adv_type == "custom_image" && $vbegy_header_adv_img != ""))) {
				$header_adv_type = $vbegy_header_adv_type;
				$header_adv_code = $vbegy_header_adv_code;
				$header_adv_href = $vbegy_header_adv_href;
				$header_adv_img = $vbegy_header_adv_img;
			}else {
				$header_adv_type = vpanel_options("header_adv_type");
				$header_adv_code = vpanel_options("header_adv_code");
				$header_adv_href = vpanel_options("header_adv_href");
				$header_adv_img = vpanel_options("header_adv_img");
			}
			if (($header_adv_type == "display_code" && $header_adv_code != "") || ($header_adv_type == "custom_image" && $header_adv_img != "")) {
				echo '<div class="clearfix"></div>
				<div class="advertising">';
				if ($header_adv_type == "display_code") {
					echo stripcslashes($header_adv_code);
				}else {
					if ($header_adv_href != "") {
						echo '<a target="_blank" href="'.$header_adv_href.'">';
					}
					echo '<img alt="" src="'.$header_adv_img.'">';
					if ($header_adv_href != "") {
						echo '</a>';
					}
				}
				echo '</div><!-- End advertising -->
				<div class="clearfix"></div>';
			}
		}
		?>
		<section class="container main-content <?php echo (!is_404() && $site_users_only != "yes"?$sidebar_dir:"page-full-width");?>">
			<?php
			$question_publish = vpanel_options("question_publish");
			$post_publish = vpanel_options("post_publish");
			if ($question_publish == "draft" && !is_super_admin(get_current_user_id())) {
				vpanel_session('','vbegy_session');
			}
			if ($post_publish == "draft" && !is_super_admin(get_current_user_id())) {
				vpanel_session('','vbegy_session_post');
			}
			vpanel_session('','vbegy_session_e');
			vpanel_session('','vbegy_session_comment');
			vpanel_session('','vbegy_session_answer');
			vpanel_session('','vbegy_session_a');
			vpanel_session('','vbegy_session_p');
			
			if (isset($_POST["post_type"]) && $_POST["post_type"] == "add_question") {
				do_action('new_post');
			}else if (isset($_POST["post_type"]) && $_POST["post_type"] == "edit_question") {
				do_action('edit_question');
			}else if (isset($_POST["post_type"]) && $_POST["post_type"] == "add_post") {
				do_action('new_post');
			}else if (isset($_POST["post_type"]) && $_POST["post_type"] == "edit_post") {
				do_action('vpanel_edit_post');
			}?>
			<div class="row">
				<div class="with-sidebar-container">
					<div class="<?php echo (!is_404() && $site_users_only != "yes"?$homepage_content_span:$full_span);?>">
					<?php if (isset($_GET['reset_password']) && isset($_GET['u'])) {
						$user_reset = (int)esc_attr($_GET['u']);
						if (!is_user_logged_in()) {
							$reset_password = get_user_meta($user_reset,"reset_password",true);
							if ($reset_password == esc_attr((int)$_GET['reset_password'])) {
								$pw 	= ask_generate_random();
								$pwdb	= md5(trim($pw));
								$wpdb->query("UPDATE ".$wpdb->users." SET user_pass = '".$pwdb."' WHERE ID = ".$user_reset);
								$get_user_by_id = get_user_by('id',$user_reset);
								delete_user_meta($user_reset,"reset_password");
								$send_text  = '';
								$send_text .= "<p> ".__("You are :","vbegy")." ".$get_user_by_id->data->display_name." ( ".$get_user_by_id->data->user_login." )</p>";
								$send_text .= "<p> ".__("The New Password :")." ".$pw."</p>";
								global $vpanel_emails,$vpanel_emails_2,$vpanel_emails_3;
								$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$send_text.$vpanel_emails_3;
								sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),esc_html($get_user_by_id->data->user_email),esc_html($get_user_by_mail->data->display_name),__("Reset your password","vbegy"),$last_message_email);
								$_SESSION['vbegy_session_a'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Your password has been reset","vbegy").'</span><br>'.__("Check your email .","vbegy").'</p></div>';
								wp_safe_redirect(esc_url(home_url('/')));
							}else {
								wp_safe_redirect(esc_url(home_url('/')));
							}
						}else {
							$_SESSION['vbegy_session_a'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("You are already logged in","vbegy").'</span><br>'.sprintf(__("If you want to change your password go to <a href='%s'>edit profile</a> .","vbegy"),get_page_link(vpanel_options('user_edit_profile_page'))).'</p></div>';
							wp_safe_redirect(esc_url(home_url('/')));
						}
					}
					$confirm_email = vpanel_options("confirm_email");
					if (is_user_logged_in() && $confirm_email == 1) {
						$if_user_id = get_user_by("id",get_current_user_id());
						if (isset($if_user_id->caps["activation"]) && $if_user_id->caps["activation"] == 1) {
							$get_user_a = (isset($_GET['u'])?esc_attr($_GET['u']):"");
							$get_activate = (isset($_GET['activate'])?esc_attr($_GET['activate']):"");
							if (isset($_GET['u']) && isset($_GET['activate'])) {
								$activation = get_user_meta(get_current_user_id(),"activation",true);
								if ($activation == $get_activate) {
									$default_group = vpanel_options("default_group");
									$default_group = (isset($default_group) && $default_group != ""?$default_group:"subscriber");
									wp_update_user( array ('ID' => get_current_user_id(), 'role' => $default_group) ) ;
									delete_user_meta(get_current_user_id(),"activation");
									if(!session_id()) session_start();
									$_SESSION['vbegy_session_a'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Membership Activated","vbegy").'</span><br>'.__("Your membership is now activated.","vbegy").'</p></div>';
									wp_safe_redirect(esc_url(home_url('/')));
								}else {
									echo '<div class="alert-message error"><i class="icon-ok"></i><p><span>'.sprintf(__("Kindly activate your membership","vbegy").'</span><br>'.__("A confirmation email has been sent to your registered email account.If you have not received the confirmation email, kindly  <a href='%s'>Click here</a> to re-send another confirmation email.","vbegy"),esc_url(add_query_arg(array("get_activate" => "do"),esc_url(home_url('/'))))).'</p></div>';
								}
							}else if (!isset($_GET['activate']) && !isset($_SESSION['vbegy_session_a'])) {
								if (isset($_GET['get_activate']) && $_GET['get_activate'] == "do") {
									$user_data = get_user_by("id",get_current_user_id());
									$rand_a = rand(1,1000000000000);
									update_user_meta(get_current_user_id(),"activation",$rand_a);
									$send_text  = '';
									$send_text .= "<p>".__( 'Hi there', 'vbegy' ).'</p>';
									$send_text .= "<p>".__( "Your registration has been successful! To confirm your account, kindly click on 'Activate' below.", "vbegy" ).'</p>';
									$send_text .= "<p><a href=".esc_url(add_query_arg(array("u" => get_current_user_id(),"activate" => $rand_a),esc_url(home_url('/')))).">".__("Activate","vbegy")."</a></p>";
									$send_text .= "<p>".__( 'If the link above does not work, Please use your browser to go to:', 'vbegy' )."</p>";
									$send_text .= esc_url(add_query_arg(array("u" => get_current_user_id(),"activate" => $rand_a),esc_url(home_url('/'))));
									$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$send_text.$vpanel_emails_3;
									sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),esc_html($user_data->user_email),esc_html($user_data->display_name),__("Confirm account","vbegy"),$last_message_email);
									$_SESSION['vbegy_session_a'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Activate the membership","vbegy").'</span><br>'.__("Check your email again .","vbegy").'</p></div>';
									wp_safe_redirect(esc_url(home_url('/')));
								}else {
									echo '<div class="alert-message error"><i class="icon-ok"></i><p><span>'.sprintf(__("Kindly activate your membership","vbegy").'</span><br>'.__("A confirmation email has been sent to your registered email account. If you have not received the confirmation email, kindly <a href='%s'>Click here</a> to re-send another confirmation email.","vbegy"),esc_url(add_query_arg(array("get_activate" => "do"),esc_url(home_url('/'))))).'</p></div>';
								}
							}
							get_footer();
							die();
						}
					}
					if ($site_users_only == "yes") {?>
						<div class="login login-login<?php if (is_front_page() || is_home()) {
							if ($index_top_box != 1) {
								echo " index-no-box-login";
							}
						}else {
							if ($breadcrumbs != 1) {
								echo " index-no-box-login";
							}
						}?>">
							<div class="row">
								<div class="col-md-6">
									<div class="page-content">
										<h2><?php _e("Login","vbegy")?></h2>
										<div class="form-style form-style-3">
											<?php echo do_shortcode("[ask_login]");?>
										</div>
									</div><!-- End page-content -->
								</div><!-- End col-md-6 -->
								<?php if (!is_user_logged_in()) {?>
									<div class="col-md-6">
										<div class="page-content">
											<h2><?php _e("Register Now","vbegy")?></h2>
											<p><?php echo stripslashes(vpanel_options("register_content"))?></p>
											<div class="button small color signup"><?php _e("Create an account","vbegy")?></div>
										</div><!-- End page-content -->
									</div><!-- End col-md-6 -->
								<?php }?>
							</div><!-- End row -->
						</div><!-- End login -->
						<?php get_footer();
						die();
					}
					$get_posts_count = array();
					$best_answer_option = get_option("best_answer_option");
					if (!$best_answer_option) {
						$the_query = new WP_Query(array("post_type" => "question","meta_key" => "the_best_answer","nopaging" => true));
						foreach ($the_query->posts as $key => $value) {
							$get_posts_count[] = get_post_meta($value->ID,"the_best_answer",true)."<br>";
						}
						update_option("best_answer_option",count($get_posts_count));
						wp_reset_postdata();
					}
					
					require_once get_template_directory() . '/functions/payment.php';
					
					/*
					$the_currency = get_option("the_currency");
					if (isset($the_currency) && is_array($the_currency)) {
						foreach ($the_currency as $key => $currency) {
							$all_money = get_option("all_money_".$currency);
							$_all_my_payment = get_user_meta(get_current_user_id(),get_current_user_id()."_all_my_payment_".$currency,true);
							echo "all money ".(isset($all_money) && $all_money != ""?$all_money:0)." ".$currency."<br>";
							echo " all my payment ".(isset($_all_my_payment) && $_all_my_payment != ""?$_all_my_payment:0)." ".$currency."<br>";
						}
					}
					$user_id = get_current_user_id();
					$_payments = get_user_meta($user_id,$user_id."_payments",true);
					
					$rows_per_page = get_option("posts_per_page");
					for ($payments = 1; $payments <= $_payments; $payments++) {
						$payment_one[] = get_user_meta($user_id,$user_id."_payments_".$payments);
					}
					if (isset($payment_one) and is_array($payment_one)) {
						$payment = array_reverse($payment_one);
						
						$current = max(1,$paged);
						$pagination_args = array(
							'base' => @esc_url(add_query_arg('paged','%#%')),
							'format' => '?page/%#%/',
							'total' => ceil(sizeof($payment)/$rows_per_page),
							'current' => $current,
							'show_all' => false,
							'prev_text' => '<i class="icon-angle-left"></i>',
							'next_text' => '<i class="icon-angle-right"></i>',
						);
						
						if( !empty($wp_query->query_vars['s']) )
							$pagination_args['add_args'] = array('s'=>get_query_var('s'));
							
						$start = ($current - 1) * $rows_per_page;
						$end = $start + $rows_per_page;
						$end = (sizeof($payment) < $end) ? sizeof($payment) : $end;
						for ($i=$start;$i < $end ;++$i ) {
							$payment_result = $payment[$i];
							echo "<pre>";print_r($payment_result);echo "</pre>";
						}
					}
					
					if (isset($payment_one) &&is_array($payment_one) && $pagination_args["total"] > 1) {?>
						<div class='pagination'><?php echo (paginate_links($pagination_args) != ""?paginate_links($pagination_args):"")?></div>
					<?php }
					*/