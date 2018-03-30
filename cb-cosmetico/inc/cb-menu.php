<?php 
if(function_exists('is_admin')){
	if(is_admin()){
		add_action('admin_menu', 'add_cb5_menu');

		function add_cb5_menu() {
			add_menu_page ('Cosmetico Settings', 'Cosmetico', 'edit_pages','cb-menu.php', 'admin_settings',  get_template_directory_uri('template_url').'/img/favicon.ico');
			add_theme_page('cb-menu.php', "Cosmetico Settings", "General Settings", 'edit_pages', 'cb-menu.php', 'admin_settings');
		}

		add_action('admin_head', 'ajax_hook');


		function ajax_hook() {
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_media();
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_script('jquery-ui-spinner');
			?>
			<?php if(isset($_GET['page'])){ if($_GET['page']=='cb-menu.php'){?>

<link
	rel="stylesheet"
	href="<?php echo WP_THEME_URL.'/inc/js/pixelmatrix-uniform/css/uniform.default.css'; ?>"
	type="text/css" media="screen">
			<?php } } ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  jQuery('form#cb_setts').submit(function() {
		  var data = jQuery(this).serialize();
		  jQuery('#saved').html('<div id="message" class="updated fade" style="margin-top:300px;border:0;background:url(<?php echo WP_THEME_URL;?>/img/opacity/w_20.png) repeat transparent;font-size:30px;color:#111;height:70%;display:block;vertical-align:middle;padding-top:50px;"><p><strong><img src="<?php echo WP_THEME_URL;?>/img/loader.gif" align="absmiddle"> <?php _e("please wait","cb-cosmetico");?>...</strong></p></div>').show();
		  jQuery.post(ajaxurl, data, function(response) {
			  if(response==1) {
				  show_message(1);
				  t=setTimeout('fade_message()', 2000);
			  } if(response==3) {
				  show_message(1);
				  t=setTimeout('fade_message()', 2000);
				  t2=setTimeout('window.location.reload()', 2000);
			  } if(response==0) {
				  show_message(2);
				  t=setTimeout('fade_message()', 2000);
			  }
			//alert(response);
		  });
		  return false;
	  });
	});
	function show_message(n) {
		if(n == 1) {
			jQuery('#saved').html('<div id="message" class="updated fade" style="margin-top:300px;border:0;background:url(<?php echo WP_THEME_URL;?>/img/opacity/w_20.png) repeat transparent;font-size:30px;color:#111;height:70%;display:block;vertical-align:middle;padding-top:50px;"><p><strong><img src="<?php echo WP_THEME_URL;?>/inc/images/admin_images/tick.png" align="absmiddle"> <?php _e("settings saved","cb-cosmetico");?>.</strong></p></div>').show();
		} else {
			jQuery('#saved').html('<div id="message" class="error fade" style="margin-top:300px;border:0;background:url(<?php echo WP_THEME_URL;?>/img/opacity/w_20.png) repeat transparent;font-size:30px;color:#111;height:70%;display:block;vertical-align:middle;padding-top:50px;"><p><strong><img src="<?php echo WP_THEME_URL;?>/inc/images/admin_images/err.png" align="absmiddle"> <?php _e("settings could not be saved","cb-cosmetico");?>.</strong></p></div>').show();
		}
	}
	function fade_message() {
		jQuery('#saved').fadeOut(1000);	
		clearTimeout(t);
	}
	</script>
			<?php
		}
		add_action('wp_ajax_st_data_save', 'st_save_ajax');

		function st_save_ajax() {
			check_ajax_referer('cosmetico-settings', 'security');
			$data = $_POST;
			unset($data['security'], $data['action']);
			$v3='';$fl='';
			global $wp_registered_sidebars;
			$sidebars = $wp_registered_sidebars;


			if($data['new_sidebar']!=''){

				$new_sidebar=str_replace(array("\n","\r","\t"),'',$data['new_sidebar']);
				$new_sidebar_id=str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'_',$new_sidebar);
				$new_sidebar=str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'_',$new_sidebar);
				$new_sidebars[$new_sidebar_id] = $new_sidebar;
				$fl=0;

				if(is_array($sidebars) && !empty($sidebars)){
					foreach($sidebars as $sidebar) {
						if($sidebar['id']==$new_sidebar_id) $fl=1;
					}
				}
				//$cb_sidebars = array();

				$cb_sidebars = unserialize(get_option('cb5_new_sidebaro'));
				$cb_sidebars[$new_sidebar_id]=$new_sidebar;
				$cb_sidebars1=serialize($cb_sidebars);

				if($fl==0) {
					update_option('cb5_new_sidebaro',$cb_sidebars1);
					$v3='1';
				}
				$sidebs_del = $cb_sidebars;
			}
			else{
				$sidebs_del=unserialize(get_option('cb5_new_sidebaro'));
			}
			$fl_dl=0;

			if(is_array($sidebars) && !empty($sidebars)){
				foreach($sidebars as $sidebar) {
					$sid_id=$sidebar['id'];
					$del_sid='del-'.$sid_id;
					if(isset($data[$del_sid])) { if($data[$del_sid]=='del') { if ($sidebs_del[$sid_id]){unset($sidebs_del[$sid_id]); $fl_dl=1;} } } else $data[$del_sid]='';
				}
			}
			if($fl_dl==1) { $sidebs_del=serialize($sidebs_del);update_option('cb5_new_sidebar',$sidebs_del); $v3='1'; }



			$adi_thumb='';
			update_option('cb5_adi_thumb', $adi_thumb);

			$scroll=esc_attr($data['scroll']);
			update_option('cb5_scroll', $scroll);

			$usescroll=esc_attr($data['usescroll']);
			update_option('cb5_usescroll', $usescroll);

			$mheadertype=esc_attr($data['mheadertype']);
			update_option('cb5_mheadertype', $mheadertype);

			if(!isset($data['rev_slider_name']))$data['rev_slider_name']='';
			$rev_slider_name=esc_attr($data['rev_slider_name']);
			update_option('cb5_rev_slider_name', $rev_slider_name);


			$woo_per_page=esc_attr($data['woo_per_page']);
			update_option('cb5_woo_per_page', $woo_per_page);
			$woo_cols=esc_attr($data['woo_cols']);
			update_option('cb5_woo_cols', $woo_cols);
			$woo_related_n=esc_attr($data['woo_related_n']);
			update_option('cb5_woo_related_n', $woo_related_n);
			$woo_related_c=esc_attr($data['woo_related_c']);
			update_option('cb5_woo_related_c', $woo_related_c);
			$woo_relatedup_n=esc_attr($data['woo_relatedup_n']);
			update_option('cb5_woo_relatedup_n', $woo_relatedup_n);
			$woo_relatedup_c=esc_attr($data['woo_relatedup_c']);
			update_option('cb5_woo_relatedup_c', $woo_relatedup_c);

			$iconspos=esc_attr($data['iconspos']);
			update_option('cb5_iconspos', $iconspos);
			$icons_bottom_margin=esc_attr($data['icons_bottom_margin']);
			update_option('cb5_icons_bottom_margin', $icons_bottom_margin);

			$adi_st='';
			update_option('cb5_adi_st', $adi_st);

			$bg_fixed=esc_attr($data['bg_fixed']);
			update_option('cb5_bg_fixed', $bg_fixed);

			
			$bg_str=esc_attr($data['bg_str']);
			update_option('cb5_bg_str', $bg_str);
			$fade_style=esc_attr($data['fade_style']);
			update_option('cb5_fade_style', $fade_style);

			$bgf_str=esc_attr($data['bgf_str']);
			update_option('cb5_bgf_str', $bgf_str);

			$admin_theme='';
			update_option('cb5_admin_theme', $admin_theme);

			$disable_pp=esc_attr($data['disable_pp']);
			update_option('cb5_disable_pp', $disable_pp);

			$shad=esc_attr($data['shad']);
			update_option('cb5_shad', $shad);

			$shad2=esc_attr($data['shad2']);
			update_option('cb5_shad2', $shad2);

			$add_css=esc_attr($data['add_css']);
			update_option('cb5_add_css', $add_css);

			$h_title=esc_attr($data['h_title']);
			update_option('cb5_h_title', $h_title);

			$h_more=esc_attr($data['h_more']);
			update_option('cb5_h_more', $h_more);

			$under=esc_attr($data['under']);
			update_option('cb5_under', $under);

			if(!isset($data['topw'])) $data['topw']='';
			$topw=esc_attr($data['topw']);
			update_option('cb5_top_widget', $topw);

			$wid=esc_attr($data['wid']);
			update_option('cb5_wid', $wid);
			$slide_type=esc_attr($data['slide_type']);
			update_option('cb5_slide_type', $slide_type);

			$h1fs=esc_attr($data['h1fs']);
			update_option('cb5_h1fs', $h1fs);
			$bodyfs=esc_attr($data['bodyfs']);
			update_option('cb5_bodyfs', $bodyfs);
			$h1fts=esc_attr($data['h1fts']);
			update_option('cb5_h1fts', $h1fts);
			$h2fs=esc_attr($data['h2fs']);
			update_option('cb5_h2fs', $h2fs);
			$h3fs=esc_attr($data['h3fs']);
			update_option('cb5_h3fs', $h3fs);
			$h4fs=esc_attr($data['h4fs']);
			update_option('cb5_h4fs', $h4fs);
			$h5fs=esc_attr($data['h5fs']);
			update_option('cb5_h5fs', $h5fs);
			$h6fs=esc_attr($data['h6fs']);
			update_option('cb5_h6fs', $h6fs);
			$headh=esc_attr($data['headh']);
			update_option('cb5_headh', $headh);
			$headhc=esc_attr($data['headhc']);
			update_option('cb5_headhc', $headhc);

			$slide_home=esc_attr($data['slide_home']);
			update_option('cb5_slide_home', $slide_home);

			$meta_description=esc_attr($data['meta_description']);
			update_option('cb5_meta_description', $meta_description);

			$meta_keywords=esc_attr($data['meta_keywords']);
			update_option('cb5_meta_keywords', $meta_keywords);

			$editor_style='';
			update_option('cb5_editor_style', $editor_style);

			$full_slider=esc_attr($data['full_slider']);
			update_option('cb5_full_slider', $full_slider);

			$full_slider_interval=esc_attr($data['full_slider_interval']);
			update_option('cb5_full_slider_interval', $full_slider_interval);

			$full_slider_effect=esc_attr($data['full_slider_effect']);
			update_option('cb5_full_slider_effect', $full_slider_effect);

			$full_slider_t_speed=esc_attr($data['full_slider_t_speed']);
			update_option('cb5_full_slider_t_speed', $full_slider_t_speed);

			if(!isset($full_slider_page)) $full_slider_page='';
			if(!isset($data['full_slider_page'])) $data['full_slider_page']='';
			$full_slider_page=esc_attr($data['full_slider_page']);
			update_option('cb5_full_slider_page', $full_slider_page);

			$full_slider_where=esc_attr($data['full_slider_where']);
			update_option('cb5_full_slider_where', $full_slider_where);

			$full_slider_bar=esc_attr($data['full_slider_bar']);
			update_option('cb5_full_slider_bar', $full_slider_bar);

			$full_slider_style=esc_attr($data['full_slider_style']);
			update_option('cb5_full_slider_style', $full_slider_style);

			$full_slider_thumbs=esc_attr($data['full_slider_thumbs']);
			update_option('cb5_full_slider_thumbs', $full_slider_thumbs);

			$full_slider_nav=esc_attr($data['full_slider_nav']);
			update_option('cb5_full_slider_nav', $full_slider_nav);

			$fixed_top=esc_attr($data['fixed_top']);
			update_option('cb5_fixed_top', $fixed_top);

			$social_foot=esc_attr($data['social_foot']);
			update_option('cb5_social_foot', $social_foot);

			$social_fb=esc_attr($data['social_fb']);
			update_option('cb5_social_fb', $social_fb);

			$social_tw=esc_attr($data['social_tw']);
			update_option('cb5_social_tw', $social_tw);

			$social_in=esc_attr($data['social_in']);
			update_option('cb5_social_in', $social_in);

			$social_yt=esc_attr($data['social_yt']);
			update_option('cb5_social_yt', $social_yt);

			$social_vi=esc_attr($data['social_vi']);
			update_option('cb5_social_vi', $social_vi);

			$social_rss=esc_attr($data['social_rss']);
			update_option('cb5_social_rss', $social_rss);

			$c_name='';
			update_option('cb5_c_name', $c_name);

			$c_email='';
			update_option('cb5_c_email', $c_email);

			$c_message='';
			update_option('cb5_c_message', $c_message);

			$c_thanks='';
			update_option('cb5_c_thanks', $c_thanks);

			$c_error='';
			update_option('cb5_c_error', $c_error);

			$r_use=esc_attr($data['r_use']);
			update_option('cb5_r_use', $r_use);

			$r_public=esc_attr($data['r_public']);
			update_option('cb5_r_public', $r_public);

			$r_private=esc_attr($data['r_private']);
			update_option('cb5_r_private', $r_private);

			$r_template=esc_attr($data['r_template']);
			update_option('cb5_r_template', $r_template);

			$page_id='';
			update_option('cb5_page_id', $page_id);

			$show_logo_text=esc_attr($data['show_logo_text']);
			update_option('cb5_show_logo_text', $show_logo_text);

			$logomt=esc_attr($data['logomt']);
			update_option('cb5_logomt', $logomt);

			$logo_text=esc_attr($data['logo_text']);
			update_option('cb5_logo_text', $logo_text);

			$logo_slogan=esc_attr($data['logo_slogan']);
			update_option('cb5_logo_slogan', $logo_slogan);

			$home_template=esc_attr($data['home_template']);
			update_option('cb5_home_template', $home_template);

			$home_limit=esc_attr($data['home_limit']);
			update_option('cb5_home_limit', $home_limit);

			$color_style=esc_attr($data['color_style']);
			update_option('cb5_color_style', $color_style);

			$font_family=esc_attr($data['font_family']);
			update_option('cb5_font_family', $font_family);

			$font_family_google=esc_attr($data['font_family_google']);
			update_option('cb5_font_family_google', $font_family_google);

			$font_family_head=esc_attr($data['font_family_head']);
			update_option('cb5_font_family_head', $font_family_head);

			$font_family_google_head=esc_attr($data['font_family_google_head']);
			update_option('cb5_font_family_google_head', $font_family_google_head);

			$font_family_google_head_title=esc_attr($data['font_family_google_head_title']);
			update_option('cb5_font_family_google_head_title', $font_family_google_head_title);

			$font_family_google_head_title2=esc_attr($data['font_family_google_head_title2']);
			update_option('cb5_font_family_google_head_title2', $font_family_google_head_title2);

			$show_bread=esc_attr($data['show_bread']);
			update_option('cb5_show_bread', $show_bread);

			$background='';
			update_option('cb5_background', $background);

			$background_color=esc_attr($data['background_color']);
			update_option('cb5_background_color', $background_color);

			$text_color=esc_attr($data['text_color']);
			update_option('cb5_text_color', $text_color);

			$logo_shad=esc_attr($data['logo_shad']);
			update_option('cb5_logo_shad', $logo_shad);

			$slogan_color=esc_attr($data['slogan_color']);
			update_option('cb5_slogan_color', $slogan_color);

			$logo_color=esc_attr($data['logo_color']);
			update_option('cb5_logo_color', $logo_color);

			$middle_background=esc_attr($data['middle_background']);
			update_option('cb5_middle_background', $middle_background);

			$middle_backgroundi=esc_attr($data['middle_backgroundi']);
			update_option('cb5_middle_backgroundi', $middle_backgroundi);

			$middle_backgroundc=esc_attr($data['middle_backgroundc']);
			update_option('cb5_middle_backgroundc', $middle_backgroundc);

			$ht_background=esc_attr($data['ht_background']);
			update_option('cb5_ht_background', $ht_background);

			$htb_background=esc_attr($data['htb_background']);
			update_option('cb5_htb_background', $htb_background);

			$footer_background=esc_attr($data['footer_background']);
			update_option('cb5_footer_background', $footer_background);

			$show_footer=esc_attr($data['show_footer']);
			update_option('cb5_show_footer', $show_footer);

			$wayp=esc_attr($data['wayp']);
			update_option('cb5_wayp', $wayp);

			$show_comments=esc_attr($data['show_comments']);
			update_option('cb5_show_comments', $show_comments);

			$show_midb=esc_attr($data['show_midb']);
			update_option('cb5_show_midb', $show_midb);

			$disable_rounded='';
			update_option('cb5_disable_rounded ', $disable_rounded);

			$google_analytics=esc_attr($data['google_analytics']);
			update_option('cb5_google_analytics', $google_analytics);

			$not_error=esc_attr($data['not_error']);
			update_option('cb5_not_error', $not_error);

			$not_desc=esc_attr($data['not_desc']);
			update_option('cb5_not_desc', $not_desc);

			$menu_font_size=esc_attr($data['menu_font_size']);
			update_option('cb5_menu_font_size', $menu_font_size);

			$headings_color=esc_attr($data['headings_color']);
			update_option('cb5_headings_color', $headings_color);

			$links_color=esc_attr($data['links_color']);
			update_option('cb5_links_color', $links_color);

			$pfilter_color=esc_attr($data['pfilter_color']);
			update_option('cb5_pfilter_color', $pfilter_color);

			$pfilter_bgcolor=esc_attr($data['pfilter_bgcolor']);
			update_option('cb5_pfilter_bgcolor', $pfilter_bgcolor);

			$links_hover_color=esc_attr($data['links_hover_color']);
			update_option('cb5_links_hover_color', $links_hover_color);

			$stripes_bg_schema=esc_attr($data['stripes_bg_schema']);
			update_option('cb5_stripes_bg_schema', $stripes_bg_schema);

			$menu_color=esc_attr($data['menu_color']);
			update_option('cb5_menu_color', $menu_color);

			$menu_font_color='';
			update_option('cb5_menu_font_color', $menu_font_color);

			$menu_hover_color='';
			update_option('cb5_menu_hover_color', $menu_hover_color);

			$logo_font=esc_attr($data['logo_font']);
			update_option('cb5_logo_font', $logo_font);

			$home_number=esc_attr($data['home_number']);
			update_option('cb5_home_number', $home_number);

			$home_cat=esc_attr($data['home_cat']);
			update_option('cb5_home_cat', $home_cat);

			$slide_bg='';
			update_option('cb5_slide_bg', $slide_bg);

			$s_easing=esc_attr($data['s_easing']);
			update_option('cb5_s_easing', $s_easing);

			$s_ani_time=esc_attr($data['s_ani_time']);
			update_option('cb5_s_ani_time', $s_ani_time);

			$s_resize=esc_attr($data['s_resize']);
			update_option('cb5_s_resize', $s_resize);

			$s_height=esc_attr($data['s_height']);
			update_option('cb5_s_height', $s_height);

			$s_link=esc_attr($data['s_link']);
			update_option('cb5_s_link', $s_link);

			$s_text=esc_attr($data['s_text']);
			update_option('cb5_s_text', $s_text);

			$s_delay=esc_attr($data['s_delay']);
			update_option('cb5_s_delay', $s_delay);

			$s_auto=esc_attr($data['s_auto']);
			update_option('cb5_s_auto', $s_auto);

			$cat=esc_attr($data['cat']);
			update_option('cb5_cat', $cat);

			$hide_top=esc_attr($data['hide_top']);
			update_option('cb5_hide_top', $hide_top);

			$sideb_col=esc_attr($data['sideb_col']);
			update_option('cb5_sideb_col', $sideb_col);

			$mwid='';
			update_option('cb5_mwid', $mwid);

			$post_details=esc_attr($data['post_details']);
			update_option('cb5_post_details', $post_details);

			$sideb_page=esc_attr($data['sideb_page']);
			update_option('cb5_sideb_page', $sideb_page);

			$color_schema=esc_attr($data['color_schema']);
			update_option('cb5_color_schema', $color_schema);

			$color_master=esc_attr($data['color_master']);
			update_option('cb5_color_master', $color_master);

			$o_con=esc_attr($data['o_con']);
			update_option('cb5_o_con', $o_con);

			$sidebar_shop=esc_attr($data['sidebar_shop']);
			update_option('cb5_sidebar_shop', $sidebar_shop);

			$woo_menu=esc_attr($data['woo_menu']);
			update_option('cb5_woo_menu', $woo_menu);

			$woo_pagi=esc_attr($data['woo_pagi']);
			update_option('cb5_woo_pagi', $woo_pagi);

			$woo_cat=esc_attr($data['woo_cat']);
			update_option('cb5_woo_cat', $woo_cat);

			$o_head=esc_attr($data['o_head']);
			update_option('cb5_o_head', $o_head);

			$o_mid=esc_attr($data['o_mid']);
			update_option('cb5_o_mid', $o_mid);

			$o_foot=esc_attr($data['o_foot']);
			update_option('cb5_o_foot', $o_foot);

			$bors=esc_attr($data['bors']);
			update_option('cb5_bors', $bors);

			$bors_h=esc_attr($data['bors_h']);
			update_option('cb5_bors_h', $bors_h);

			$bors_f=esc_attr($data['bors_f']);
			update_option('cb5_bors_f', $bors_f);

			$logo_f=esc_attr($data['logo_f']);
			update_option('cb5_logo_f', $logo_f);

			$h_sid=esc_attr($data['h_sid']);
			update_option('cb5_h_sid', $h_sid);

			$menu_f=esc_attr($data['menu_f']);
			update_option('cb5_menu_f', $menu_f);

			$mw=esc_attr($data['mw']);
			update_option('cb5_mw', $mw);

			$mwh=esc_attr($data['mwh']);
			update_option('cb5_mwh', $mwh);

			$sideb_blog='';
			update_option('cb5_sideb_blog', $sideb_blog);

			$sideb_post=esc_attr($data['sideb_post']);
			update_option('cb5_sideb_post', $sideb_post);

			$headertransparent=esc_attr($data['headertransparent']);
			update_option('cb5_headertransparent', $headertransparent);
			$slidertoptint=esc_attr($data['slidertoptint']);
			update_option('cb5_slidertoptint', $slidertoptint);
			$showtopwidget=esc_attr($data['showtopwidget']);
			update_option('cb5_showtopwidget', $showtopwidget);
			$showmenusearch=esc_attr($data['showmenusearch']);
			update_option('cb5_showmenusearch', $showmenusearch);

			$headings_up=esc_attr($data['headings_up']);
			update_option('cb5_headings_up', $headings_up);

			$headings_upw=esc_attr($data['headings_upw']);
			update_option('cb5_headings_upw', $headings_upw);


			$headings_upw_t=esc_attr($data['headings_upw_t']);
			update_option('cb5_headings_upw_t', $headings_upw_t);

			$headings_icons_size=esc_attr($data['headings_icons_size']);
			update_option('cb5_headings_icons_size', $headings_icons_size);
			

			if(get_option('cb5_mailchimp_key')!=esc_attr($data['mailchimp_key']))
				$v3='1';
			update_option('cb5_mailchimp_key', esc_attr($data['mailchimp_key']));
			update_option('cb5_mailchimp_default', esc_attr($data['mailchimp_default']));
			update_option('cb5_mailchimp_success', esc_attr($data['mailchimp_success']));
			update_option('cb5_mailchimp_failure', esc_attr($data['mailchimp_failure']));
				

			$icons_name=$data['icons_name'];
			$icons_link=$data['icons_link'];
			$icons_val=$data['icons_val'];
			$icons_color=$data['icons_color'];
			$headins_icons_array = array();
			if( isset( $icons_name ) && is_array( $icons_name ) ) {
				for($i=0;$i<sizeof($icons_name);$i++) {
					$headins_icons_array[$i]['icon'] = $icons_val[$i];
					$headins_icons_array[$i]['link'] = $icons_link[$i];
					$headins_icons_array[$i]['name'] = $icons_name[$i];
					$headins_icons_array[$i]['color'] = $icons_color[$i];
				}


			}
			update_option('cb5_headings_icons', serialize($headins_icons_array));

			$demol=esc_attr($data['demol']);
			$demol_att=esc_attr($data['demo_atts']);
			if($demol!='') {
				require(get_template_directory().'/inc/cb-install.php');

				if($demol_att=='yes') $auto_import_att='1'; else $auto_import_att='0';

				require(get_template_directory().'/inc/autoimporter/autoimporter.php');

				if($demol=='onepage'){
					$args = array('file'=>get_template_directory().'/docs/import/demo_content_one_page.xml','map_user_id' => 1);}else{$args = array('file'=>get_template_directory().'/docs/import/demo_content.xml','map_user_id' => 1);}

					ob_start();
					auto_import( $args,$auto_import_att );
					$con=ob_get_contents();
					ob_end_clean();
					$v3='1';

					update_option( 'show_on_front ', 'page' );
					if($demol=='onepage'){ update_option( 'page_on_front ', '19' ); }
					else { update_option( 'page_on_front ', '19' ); }

					$demo_widget=esc_attr($data['demo_widget']);

					if($demo_widget!='') {

						class Widget_Data_Importer {


							/**
							 * Import widgets
							 * @param array $import_array
							 */
							public static function parse_import_data( $import_array ) {
								$sidebars_data = $import_array[0];
								$widget_data = $import_array[1];
								$current_sidebars = get_option( 'sidebars_widgets' );
								foreach($current_sidebars as &$current){
									if(!is_array($current)&& !is_numeric($current))$current=array();
								}

								global $wp_registered_sidebars;
								foreach ($wp_registered_sidebars as $key=>$value){
									if(!array_key_exists ($key,$current_sidebars))$current_sidebars[$key]=array();
								}


								$new_widgets = array( );

								foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

								foreach ( $import_widgets as $import_widget ) :
								//if the sidebar exists
								if ( isset( $current_sidebars[$import_sidebar] ) ) :
								$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
								$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
								$current_widget_data = get_option( 'widget_' . $title );
								$new_widget_name = self::get_new_widget_name( $title, $index );
								$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

								if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
									while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
										$new_index++;
									}
								}
								$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
								if ( array_key_exists( $title, $new_widgets ) ) {
									$new_widgets[$title][$new_index] = $widget_data[$title][$index];
									$multiwidget = $new_widgets[$title]['_multiwidget'];
									unset( $new_widgets[$title]['_multiwidget'] );
									$new_widgets[$title]['_multiwidget'] = $multiwidget;
								} else {
									$current_widget_data[$new_index] = $widget_data[$title][$index];
									$current_multiwidget = $current_widget_data['_multiwidget'];
									$new_multiwidget = $widget_data[$title]['_multiwidget'];
									$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
									unset( $current_widget_data['_multiwidget'] );
									$current_widget_data['_multiwidget'] = $multiwidget;
									$new_widgets[$title] = $current_widget_data;
								}

								endif;
								endforeach;
								endforeach;

								if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
									update_option( 'sidebars_widgets', $current_sidebars );

									foreach ( $new_widgets as $title => $content )
									update_option( 'widget_' . $title, $content );

									return true;
								}

								return false;
							}



							/**
							 * Parse JSON import file and load
							 */
							public static function ajax_import_widget_data() {

								$up_file = get_template_directory() . '/docs/import/widget_data.json';

								$json = self::get_widget_settings_json();

								if( is_wp_error($json) )
								wp_die( $json->get_error_message() );

								if( !( $json_data = json_decode( $json[0], true ) ) )
								return;

									
								if ( isset( $json_data[0] ) ) :
								foreach ( self::order_sidebar_widgets( $json_data[0] ) as $sidebar_name => $widget_list ) :
								if ( count( $widget_list ) == 0 ) {
									continue;
								}
								$sidebar_info = self::get_sidebar_info( $sidebar_name );
								if ( $sidebar_info ) :
								foreach ( $widget_list as $widget ) :
								$widget_options = false;

								$widget_type = trim( substr( $widget, 0, strrpos( $widget, '-' ) ) );
								$widget_type_index = trim( substr( $widget, strrpos( $widget, '-' ) + 1 ) );
								foreach ( $json_data[1] as $name => $option ) {
									if ( $name == $widget_type ) {
										$widget_type_options = $option;
										break;
									}
								}
								if ( !isset($widget_type_options) || !$widget_type_options )
								continue;

								$widget_title = isset( $widget_type_options[$widget_type_index]['title'] ) ? $widget_type_options[$widget_type_index]['title'] : '';
								$widget_options = $widget_type_options[$widget_type_index];


								$new_widgets[$widget_type][$widget_type_index]='on'
															
															?>
								<?php endforeach; ?>


								<?php endif; ?>
								<?php endforeach; ?>
								<?php endif;

								$widgets = $new_widgets;
								$import_file = $up_file;

								$json_data = file_get_contents( $import_file );
								$json_data = json_decode( $json_data, true );
								$sidebar_data = $json_data[0];
								$widget_data = $json_data[1];
								foreach ( $sidebar_data as $title => $sidebar ) {
									$count = count( $sidebar );
									for ( $i = 0; $i < $count; $i++ ) {
										$widget = array( );
										$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
										$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
										if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
											unset( $sidebar_data[$title][$i] );
										}
									}
									$sidebar_data[$title] = array_values( $sidebar_data[$title] );
								}

								foreach ( $widgets as $widget_title => $widget_value ) {
									foreach ( $widget_value as $widget_key => $widget_value ) {
										$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
									}
								}

								$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

								$response['id'] = ( self::parse_import_data( $sidebar_data ) ) ? true : new WP_Error( 'widget_import_submit', 'Unknown Error' );

							}

							/**
							 * Read uploaded JSON file
							 * @return type
							 */
							public static function get_widget_settings_json() {

								$up_file = get_template_directory() . '/docs/import/widget_data.json';
								$file_contents = file_get_contents( $up_file );
								return array( $file_contents, $up_file );
							}


							/**
							 *
							 * @param string $widget_name
							 * @param string $widget_index
							 * @return string
							 */
							public static function get_new_widget_name( $widget_name, $widget_index ) {
								$current_sidebars = get_option( 'sidebars_widgets' );
								$all_widget_array = array( );
								foreach ( $current_sidebars as $sidebar => $widgets ) {
									if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
										foreach ( $widgets as $widget ) {
											$all_widget_array[] = $widget;
										}
									}
								}
								while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
									$widget_index++;
								}
								$new_widget_name = $widget_name . '-' . $widget_index;
								return $new_widget_name;
							}

							/**
							 *
							 * @global type $wp_registered_sidebars
							 * @param type $sidebar_id
							 * @return boolean
							 */
							public static function get_sidebar_info( $sidebar_id ) {
								global $wp_registered_sidebars;

								//since wp_inactive_widget is only used in widgets.php
								if ( $sidebar_id == 'wp_inactive_widgets' )
								return array( 'name' => 'Inactive Widgets', 'id' => 'wp_inactive_widgets' );

								foreach ( $wp_registered_sidebars as $sidebar ) {
									if ( isset( $sidebar['id'] ) && $sidebar['id'] == $sidebar_id )
									return $sidebar;
								}

								return false;
							}

							/**
							 *
							 * @param array $sidebar_widgets
							 * @return type
							 */
							public static function order_sidebar_widgets( $sidebar_widgets ) {
								$inactive_widgets = false;

								//seperate inactive widget sidebar from other sidebars so it can be moved to the end of the array, if it exists
								if ( isset( $sidebar_widgets['wp_inactive_widgets'] ) ) {
									$inactive_widgets = $sidebar_widgets['wp_inactive_widgets'];
									unset( $sidebar_widgets['wp_inactive_widgets'] );
									$sidebar_widgets['wp_inactive_widgets'] = $inactive_widgets;
								}

								return $sidebar_widgets;
							}


						}
						ob_start();
						$importer = new Widget_Data_Importer;
						$importer->ajax_import_widget_data();
						$con=ob_get_contents();
						ob_end_clean();
						$v3='1';
					}
			}



			$logo_old='';
			$bg_old=$data['bg_old'];
			$favi_old='';
			if ($data['upload_logo']&&$data['upload_logo']!='') {
				$upload_logo=esc_attr($data['upload_logo']);
				$remove_logo='';
				if($remove_logo=='yes') $upload_logo='';
				if($upload_logo!=$logo_old&&$upload_logo!='') update_option('cb5_upload_logo', $upload_logo);
			}
			if ($data['upload_bg']&&$data['upload_bg']!='') {
				$upload_bg=esc_attr($data['upload_bg']); if(!isset($data['remove_bg'])) $data['remove_bg']='';
				$remove_bg=esc_attr($data['remove_bg']);
				if($remove_bg=='yes') $upload_bg='';
				update_option('cb5_upload_bg', $upload_bg);
			}
			if ($data['middle_backgroundi']&&$data['middle_backgroundi']!='') {
				$middle_backgroundi=esc_attr($data['middle_backgroundi']); if(!isset($data['remove_bgi'])) $data['remove_bgi']='';
				$remove_bgi=esc_attr($data['remove_bgi']);
				if($remove_bgi=='yes') $middle_backgroundi='';
				update_option('cb5_middle_backgroundi', $middle_backgroundi);
			}
			if ($data['favi']&&$data['favi']!='') {
				$favi=esc_attr($data['favi']);
				if($favi!=$favi_old&&$favi!='') update_option('cb5_favi', $favi);
			}
			$dda='1';
			if($v3=='1') $dda='3'; else $dda='1';
			die($dda);
		}


		function admin_settings() {

add_option('cb5_woo_per_page', '12', '', 'yes');
			add_option('cb5_woo_related_c', '2', '', 'yes');
			add_option('cb5_woo_related_n', '2', '', 'yes');
			add_option('cb5_woo_relatedup_c', '3', '', 'yes');
			add_option('cb5_woo_relatedup_n', '3', '', 'yes');
			add_option('cb5_showtopwidget', 'no', '', 'yes');
			add_option('cb5_showmenusearch', 'yes', '', 'yes');
			add_option('cb5_iconspos', 'bottom', '', 'yes');
			add_option('cb5_icons_bottom_margin', '100px', '', 'yes');
			add_option('cb5_headertransparent', 'yes', '', 'yes');
			add_option('cb5_slidertoptint', 'yes', '', 'yes');
			add_option('cb5_woo_cols', '3', '', 'yes');
			add_option('cb5_nivo_style', 'default', '', 'yes');
			add_option('cb5_scroll', 'yes', '', 'yes');
			add_option('cb5_usescroll', 'yes', '', 'yes');
			add_option('cb5_mheadertype', 'yes', '', 'yes');
			add_option('cb5_nivo_cat', '', '', 'yes');
			add_option('cb5_rev_slider_name', '', '', 'yes');
			add_option('cb5_add_css', '', '', 'yes');
			add_option('cb5_sidebar_shop', 'right', '', 'yes');
			add_option('cb5_woo_menu', 'yes', '', 'yes');
			add_option('cb5_woo_pagi', 'ajax', '', 'yes');
			add_option('cb5_woo_cat', 'ajax', '', 'yes');
			add_option('cb5_s_text', 'no', '', 'yes');
			add_option('cb5_full_slider', 'no', '', 'yes');
			add_option('cb5_color_master', '', '', 'yes');
			add_option('cb5_shad', '#eee', '', 'yes');
			add_option('cb5_shad2', '', '', 'yes');
			add_option('cb5_wid', '', '', 'yes');
			add_option('cb5_editor_style', 'no', '', 'yes');
			add_option('cb5_full_slider_interval', '5000', '', 'yes');
			add_option('cb5_full_slider_effect', '1', '', 'yes');
			add_option('cb5_full_slider_t_speed', '1000', '', 'yes');
			add_option('cb5_full_slider_page', '', '', 'yes');
			add_option('cb5_full_slider_where', 'home', '', 'yes');
			add_option('cb5_full_slider_bar', '1', '', 'yes');
			add_option('cb5_full_slider_style', '0', '', 'yes');
			add_option('cb5_full_slider_thumbs', '0', '', 'yes');
			add_option('cb5_full_slider_nav', '0', '', 'yes');
			add_option('cb5_sidebars_tocat', '', '', 'yes');
			add_option('cb5_under', 'no', '', 'yes');
			add_option('cb5_top_widget', 'yes', '', 'yes');
			add_option('cb5_new_sidebar', '', '', 'yes');
			add_option('cb5_meta_keywords', 'Wordpress blog', '', 'yes');
			add_option('cb5_meta_description', 'Wordpress blog', '', 'yes');
			add_option('cb5_adi_thumb', 'yes', '', 'yes');
			add_option('cb5_adi_st', 'yes', '', 'yes');
			add_option('cb5_bg_fixed', 'yes', '', 'yes');
			add_option('cb5_bg_str', 'yes', '', 'yes');
			add_option('cb5_fade_style', 'yes', '', 'yes');
			add_option('cb5_bgf_str', 'yes', '', 'yes');
			add_option('cb5_disable_pp', 'no', '', 'yes');
			add_option('cb5_c_name', 'Name & Surname', '', 'yes');
			add_option('cb5_c_email', 'Email', '', 'yes');
			add_option('cb5_c_message', 'Message', '', 'yes');
			add_option('cb5_c_thanks', 'Thank You for Your message.', '', 'yes');
			add_option('cb5_c_error', 'There was an error. Message not sent.', '', 'yes');
			add_option('cb5_r_use', '', '', 'yes');
			add_option('cb5_r_public', '', '', 'yes');
			add_option('cb5_r_private', '', '', 'yes');
			add_option('cb5_r_template', 'white', '', 'yes');
			add_option('cb5_color_schema', '', '', 'yes');
			add_option('cb5_color_style', '', '', 'yes');
			add_option('cb5_slide_type', 'any', '', 'yes');
			add_option('cb5_stripes_bg_schema', '', '', 'yes');
			add_option('cb5_sideb_col', 'right', '', 'yes');
			add_option('cb5_sideb_page', 'yes', '', 'yes');
			add_option('cb5_sideb_blog', 'yes', '', 'yes');
			add_option('cb5_sideb_post', 'yes', '', 'yes');
			add_option('cb5_post_details', 'yes', '', 'yes');
			add_option('cb5_page_details', 'no', '', 'yes');
			add_option('cb5_slide_home', 'home', '', 'yes');
			add_option('cb5_font_family', 'Open+Sans', '', 'yes');
			add_option('cb5_background', '3', '', 'yes');
			add_option('cb5_page_id', '', '', 'yes');
			add_option('cb5_upload_logo', 'http://cb-theme.com/demo/cosmetico/wp-content/uploads/2013/07/logo_d5.png', '', 'yes');
			add_option('cb5_show_logo_text', 'yes', '', 'yes');
			add_option('cb5_logomt', '50px', '', 'yes');
			add_option('cb5_logo_text', 'cosmetico', '', 'yes');
			add_option('cb5_logo_slogan', 'Theme from cb-theme.com', '', 'yes');
			add_option('cb5_home_template', '3', '', 'yes');
			add_option('cb5_upload_bg', '', '', 'yes');
			add_option('cb5_favi', 'http://cb-theme.com/demo/cosmetico/wp-content/uploads/2013/01/favicon.png', '', 'yes');
			add_option('cb5_font_family_google', 'Raleway', '', 'yes');
			add_option('cb5_font_family_head', 'Arial', '', 'yes');
			add_option('cb5_font_family_google_head', 'Raleway', '', 'yes');
			add_option('cb5_font_family_google_head_title', '------', '', 'yes');
			add_option('cb5_font_family_google_head_title2', '------', '', 'yes');
			add_option('cb5_show_bread', 'yes', '', 'yes');
			add_option('cb5_show_footer', 'yes', '', 'yes');
			add_option('cb5_wayp', 'yes', '', 'yes');
			add_option('cb5_show_comments', 'yes', '', 'yes');
			add_option('cb5_show_midb', 'everywhere', '', 'yes');
			add_option('cb5_disable_rounded ', 'no', '', 'yes');
			add_option('cb5_google_analytics', '', '', 'yes');
			add_option('cb5_not_error', '404- Page not found', '', 'yes');
			add_option('cb5_not_desc', 'The page you requested cannot be found.', '', 'yes');
			add_option('cb5_menu_font_size', '', '', 'yes');
			add_option('cb5_headings_color', '', '', 'yes');
			add_option('cb5_links_color', '', '', 'yes');
			add_option('cb5_pfilter_color', '#FFFFFF', '', 'yes');
			add_option('cb5_pfilter_bgcolor', '#222222', '', 'yes');
			add_option('cb5_links_hover_color', '', '', 'yes');
			add_option('cb5_menu_color', '', '', 'yes');
			add_option('cb5_menu_font_color', '', '', 'yes');
			add_option('cb5_menu_hover_color', '', '', 'yes');
			add_option('cb5_text_color', '', '', 'yes');
			add_option('cb5_logo_color', '#FFFFFF', '', 'yes');
			add_option('cb5_slogan_color', '', '', 'yes');
			add_option('cb5_logo_shad', '#000000', '', 'yes');
			add_option('cb5_middle_background', '#282828', '', 'yes');
			add_option('cb5_middle_backgroundi', '', '', 'yes');
			add_option('cb5_middle_backgroundc', '', '', 'yes');
			add_option('cb5_ht_background', '', '', 'yes');
			add_option('cb5_htb_background', '', '', 'yes');
			add_option('cb5_footer_background', '', '', 'yes');
			add_option('cb5_background_color', '#e1e1e1', '', 'yes');
			add_option('cb5_logo_font', '35px', '', 'yes');
			add_option('cb5_remove_logo', 'yes', '', 'yes');
			add_option('cb5_remove_bg', 'no', '', 'yes');
			add_option('cb5_remove_bgi', 'no', '', 'yes');
			add_option('cb5_home_cat', '', '', 'yes');
			add_option('cb5_home_number', '3', '', 'yes');
			add_option('cb5_home_limit', '', '', 'yes');
			add_option('cb5_s_easing', 'swing', '', 'yes');
			add_option('cb5_s_ani_time', '600', '', 'yes');
			add_option('cb5_s_resize', 'true', '', 'yes');
			add_option('cb5_s_delay', '6000', '', 'yes');
			add_option('cb5_s_auto', 'true', '', 'yes');
			add_option('cb5_cat', '3', '', 'yes');
			add_option('cb5_admin_theme', 'no', '', 'yes');
			add_option('cb5_fixed_top', 'no', '', 'yes');
			add_option('cb5_social_foot', 'yes', '', 'yes');
			add_option('cb5_social_fb', '', '', 'yes');
			add_option('cb5_social_tw', '', '', 'yes');
			add_option('cb5_social_in', '', '', 'yes');
			add_option('cb5_social_yt', '', '', 'yes');
			add_option('cb5_social_vi', '', '', 'yes');
			add_option('cb5_social_rss', '', '', 'yes');
			add_option('cb5_hide_top', 'no', '', 'yes');
			add_option('cb5_h_title', '', '', 'yes');
			add_option('cb5_h_more', '', '', 'yes');
			add_option('cb5_mwid', '', '', 'yes');
			add_option('cb5_slide_bg', 'yes', '', 'yes');
			add_option('cb5_h_sid', '', '', 'yes');

			add_option('cb5_o_head', '', '', 'yes');
			add_option('cb5_o_con', '', '', 'yes');
			add_option('cb5_o_foot', '', '', 'yes');
			add_option('cb5_o_mid', '', '', 'yes');
			add_option('cb5_mw', '', '', 'yes');
			add_option('cb5_mwh', '', '', 'yes');
			add_option('cb5_logo_f', 'Open+Sans', '', 'yes');
			add_option('cb5_menu_f', '------', '', 'yes');
			add_option('bors', '', '', 'yes');
			add_option('bors_h', '', '', 'yes');
			add_option('bors_f', '', '', 'yes');
			add_option('s_height', '', '', 'yes');
			add_option('s_link', '', '', 'yes');

			add_option('cb5_bodyfs', '11px', '', 'yes');
			add_option('cb5_h1fs', '28px', '', 'yes');
			add_option('cb5_h1fts', '88px', '', 'yes');
			add_option('cb5_h2fs', '20px', '', 'yes');
			add_option('cb5_h3fs', '16px', '', 'yes');
			add_option('cb5_h4fs', '14px', '', 'yes');
			add_option('cb5_h5fs', '12px', '', 'yes');
			add_option('cb5_h6fs', '11px', '', 'yes');
			add_option('cb5_headh', '150px', '', 'yes');
			add_option('cb5_headhc', '#FFFFFF', '', 'yes');
			add_option('cb5_headings_up', 'uppercase', '', 'yes');
			add_option('cb5_headings_upw', 'lighter', '', 'yes');
			add_option('cb5_headings_upw_t', 'lighter', '', 'yes');

			add_option('cb5_headings_icons', '', '', 'yes');
			add_option('cb5_headings_icons_size', '', '', 'yes');

			$woo_per_page=get_option('cb5_woo_per_page');
			$woo_cols=get_option('cb5_woo_cols');
			$woo_related_n=get_option('cb5_woo_related_n');
			$woo_related_c=get_option('cb5_woo_related_c');
			$woo_relatedup_n=get_option('cb5_woo_relatedup_n');
			$woo_relatedup_c=get_option('cb5_woo_relatedup_c');
			$headertransparent=get_option('cb5_headertransparent');
			$slidertoptint=get_option('cb5_slidertoptint');
			$showtopwidget=get_option('cb5_showtopwidget');
			$showmenusearch=get_option('cb5_showmenusearch');

			$nivo_style=get_option('cb5_nivo_style');
			$scroll=get_option('cb5_scroll');
			$usescroll=get_option('cb5_usescroll');
			$mheadertype=get_option('cb5_mheadertype');
			$rev_slider_name=get_option('cb5_rev_slider_name');
			$nivo_height=get_option('cb5_nivo_height');
			$nivo_cat=get_option('cb5_nivo_cat');
			$nivo_link=get_option('cb5_nivo_link');
			$nivo_effect=get_option('cb5_nivo_effect');
			$nivo_anim=get_option('cb5_nivo_anim');
			$nivo_pause=get_option('cb5_nivo_pause');
			$nivo_direction=get_option('cb5_nivo_direction');
			$nivo_control=get_option('cb5_nivo_control');
			$nivo_thumbs=get_option('cb5_nivo_thumbs');
			$nivo_pause_hover=get_option('cb5_nivo_pause_hover');

			$round_pause=get_option('cb5_round_pause');
			$round_height=get_option('cb5_round_height');
			$round_cat=get_option('cb5_round_cat');
			$round_auto=get_option('cb5_round_auto');
			$round_hover=get_option('cb5_round_hover');
			$round_link=get_option('cb5_round_link');

			$kwicks_cat=get_option('cb5_kwicks_cat');
			$kwicks_max=get_option('cb5_kwicks_max');
			$kwicks_min=get_option('cb5_kwicks_min');
			$kwicks_spacing=get_option('cb5_kwicks_spacing');
			$kwicks_height=get_option('cb5_kwicks_height');
			$kwicks_link=get_option('cb5_kwicks_link');

			$drag_cat=get_option('cb5_drag_cat');
			$drag_height=get_option('cb5_drag_height');
			$drag_link=get_option('cb5_drag_link');

			$iconspos=get_option('cb5_iconspos');
			$icons_bottom_margin=get_option('cb5_icons_bottom_margin');
			$h1fs=get_option('cb5_h1fs');
			$bodyfs=get_option('cb5_bodyfs');
			$h1fts=get_option('cb5_h1fts');
			$h2fs=get_option('cb5_h2fs');
			$h3fs=get_option('cb5_h3fs');
			$h4fs=get_option('cb5_h4fs');
			$h5fs=get_option('cb5_h5fs');
			$h6fs=get_option('cb5_h6fs');
			$headh=get_option('cb5_headh');
			$headhc=get_option('cb5_headhc');

			$h_title=get_option('cb5_h_title');
			$slide_type=get_option('cb5_slide_type');
			$sidebar_shop=get_option('cb5_sidebar_shop');
			$woo_menu=get_option('cb5_woo_menu');
			$woo_pagi=get_option('cb5_woo_pagi');
			$woo_cat=get_option('cb5_woo_cat');
			$s_text=get_option('cb5_s_text');
			$add_css=get_option('cb5_add_css');
			$color_master=get_option('cb5_color_master');
			$shad=get_option('cb5_shad');
			$shad2=get_option('cb5_shad2');
			$wid=get_option('cb5_wid');
			$h_more=get_option('cb5_h_more');
			$editor_style=get_option('cb5_editor_style');
			$fixed_top=get_option('cb5_fixed_top');
			$social_foot=get_option('cb5_social_foot');
			$social_fb=get_option('cb5_social_fb');
			$social_tw=get_option('cb5_social_tw');
			$social_in=get_option('cb5_social_in');
			$social_yt=get_option('cb5_social_yt');
			$social_vi=get_option('cb5_social_vi');
			$social_rss=get_option('cb5_social_rss');
			$full_slider=get_option('cb5_full_slider');
			$full_slider_interval=get_option('cb5_full_slider_interval');
			$full_slider_effect=get_option('cb5_full_slider_effect');
			$full_slider_t_speed=get_option('cb5_full_slider_t_speed');
			$full_slider_page=get_option('cb5_full_slider_page');
			$full_slider_where=get_option('cb5_full_slider_where');
			$full_slider_bar=get_option('cb5_full_slider_bar');
			$full_slider_style=get_option('cb5_full_slider_style');
			$full_slider_thumbs=get_option('cb5_full_slider_thumbs');
			$full_slider_nav=get_option('cb5_full_slider_nav');
			$sidebars_tocat=get_option('cb5_sidebars_tocat');
			$meta_description=get_option('cb5_meta_description');
			$meta_keywords=get_option('cb5_meta_keywords');
			$adi_thumb=get_option('cb5_adi_thumb');
			$adi_st=get_option('cb5_adi_st');
			$bg_fixed=get_option('cb5_bg_fixed');
			$bg_str=get_option('cb5_bg_str');
			$fade_style=get_option('cb5_fade_style');
			$bgf_str=get_option('cb5_bgf_str');
			$disable_pp=get_option('cb5_disable_pp');
			$middle_background=get_option('cb5_middle_background');
			$middle_backgroundi=get_option('cb5_middle_backgroundi');
			$middle_backgroundc=get_option('cb5_middle_backgroundc');
			$ht_background=get_option('cb5_ht_background');
			$htb_background=get_option('cb5_htb_background');
			$text_color=get_option('cb5_text_color');
			$logo_color=get_option('cb5_logo_color');
			$slogan_color=get_option('cb5_slogan_color');
			$logo_shad=get_option('cb5_logo_shad');
			$background_color=get_option('cb5_background_color');
			$footer_background=get_option('cb5_footer_background');
			$c_name=get_option('cb5_c_name');
			$logo_font=get_option('cb5_logo_font');
			$c_email=get_option('cb5_c_email');
			$c_message=get_option('cb5_c_message');
			$c_thanks=get_option('cb5_c_thanks');
			$c_error=get_option('cb5_c_error');
			$r_use=get_option('cb5_r_use');
			$r_public=get_option('cb5_r_public');
			$r_private=get_option('cb5_r_private');
			$r_template=get_option('cb5_r_template');
			$color_schema=get_option('cb5_color_schema');
			$color_style=get_option('cb5_color_style');
			$stripes_bg_schema=get_option('cb5_stripes_bg_schema');
			$sideb_col=get_option('cb5_sideb_col');
			$sideb_page=get_option('cb5_sideb_page');
			$sideb_blog=get_option('cb5_sideb_blog');
			$sideb_post=get_option('cb5_sideb_post');
			$post_details=get_option('cb5_post_details');
			$page_details=get_option('cb5_page_details');
			$slide_home=get_option('cb5_slide_home');
			$font_family=get_option('cb5_font_family');
			$background=get_option('cb5_background');
			$page_id=get_option('cb5_page_id');
			$upload_logo=get_option('cb5_upload_logo');
			$show_logo_text=get_option('cb5_show_logo_text');
			$logo_text=get_option('cb5_logo_text');
			$logomt=get_option('cb5_logomt');
			$logo_slogan=get_option('cb5_logo_slogan');
			$home_template=get_option('cb5_home_template');
			$upload_bg=get_option('cb5_upload_bg');
			$favi=get_option('cb5_favi');
			$font_family_google=get_option('cb5_font_family_google');
			$font_family_head=get_option('cb5_font_family_head');
			$font_family_google_head=get_option('cb5_font_family_google_head');
			$font_family_google_head_title=get_option('cb5_font_family_google_head_title');
			$font_family_google_head_title2=get_option('cb5_font_family_google_head_title2');
			$show_bread=get_option('cb5_show_bread');
			$show_footer=get_option('cb5_show_footer');
			$wayp=get_option('cb5_wayp');
			$show_comments=get_option('cb5_show_comments');
			$show_midb=get_option('cb5_show_midb');
			$remove_logo=get_option('cb5_remove_logo');
			$disable_rounded=get_option('cb5_disable_rounded ');
			$google_analytics=get_option('cb5_google_analytics');
			$not_error=get_option('cb5_not_error');
			$not_desc=get_option('cb5_not_desc');
			$menu_font_size=get_option('cb5_menu_font_size');
			$headings_color=get_option('cb5_headings_color');
			$links_color=get_option('cb5_links_color');
			$pfilter_color=get_option('cb5_pfilter_color');
			$pfilter_bgcolor=get_option('cb5_pfilter_bgcolor');
			$links_hover_color=get_option('cb5_links_hover_color');
			$menu_color=get_option('cb5_menu_color');
			$menu_font_color=get_option('cb5_menu_font_color');
			$menu_hover_color=get_option('cb5_menu_hover_color');
			$home_number=get_option('cb5_home_number');
			$home_cat=get_option('cb5_home_cat');
			$home_limit=get_option('cb5_home_limit');
			$admin_theme=get_option('cb5_admin_theme');
			$under=get_option('cb5_under');
			$topw=get_option('cb5_top_widget');
			$s_easing=get_option('cb5_s_easing');
			$s_ani_time=get_option('cb5_s_ani_time');
			$s_resize=get_option('cb5_s_resize');
			$s_delay=get_option('cb5_s_delay');
			$s_auto=get_option('cb5_s_auto');
			$cat=get_option('cb5_cat');
			$hide_top=get_option('cb5_hide_top');
			$mwid=get_option('cb5_mwid');

			$o_head=get_option('cb5_o_head');
			$h_sid=get_option('cb5_h_sid');
			$o_con=get_option('cb5_o_con');
			$o_mid=get_option('cb5_o_mid');
			$o_foot=get_option('cb5_o_foot');
			$bors=get_option('cb5_bors');
			$bors_h=get_option('cb5_bors_h');
			$bors_f=get_option('cb5_bors_f');
			$logo_f=get_option('cb5_logo_f');
			$menu_f=get_option('cb5_menu_f');
			$mw=get_option('cb5_mw');
			$mwh=get_option('cb5_mwh');
			$s_height=get_option('cb5_s_height');
			$s_link=get_option('cb5_s_link');
			$headings_up=get_option('cb5_headings_up');
			$headings_upw=get_option('cb5_headings_upw');
			$headings_upw_t=get_option('cb5_headings_upw_t');
			$headings_icons_size=get_option('cb5_headings_icons_size');

			$headings_icons=unserialize(get_option('cb5_headings_icons'));



			$mailchimp_key=get_option('cb5_mailchimp_key');
			$mailchimp_default=get_option('cb5_mailchimp_default');
			$mailchimp_success=get_option('cb5_mailchimp_success');
			$mailchimp_failure=get_option('cb5_mailchimp_failure');

			if($mailchimp_success=='')$mailchimp_success='Thanks for subscribing.';
			if($mailchimp_failure=='')$mailchimp_failure='An error occurred.  Try again later or contact site owner.';



			$google_font = array('------','Abel','Abril+Fatface','Aclonica','Acme','Actor','Adamina','Advent+Pro','Aguafina+Script','Aladin','Aldrich','Alegreya','Alegreya+SC','Alex+Brush','Alfa+Slab+One','Alice','Alike','Alike+Angular','Allan','Allerta','Allerta+Stencil','Allura','Almendra','Almendra+SC','Amarante','Amaranth','Amatic+SC','Amethysta','Andada','Andika','Angkor','Annie+Use+Your+Telescope','Anonymous+Pro','Antic','Antic+Didone','Antic+Slab','Anton','Arapey','Arbutus','Architects+Daughter','Arimo','Arizonia','Armata','Artifika','Arvo','Asap','Asset','Astloch','Asul','Atomic+Age','Aubrey','Audiowide','Average','Averia+Gruesa+Libre','Averia+Libre','Averia+Sans+Libre','Averia+Serif+Libre','Bad+Script','Balthazar','Bangers','Basic','Battambang','Baumans','Bayon','Belgrano','Belleza','Bentham','Berkshire+Swash','Bevan','Bigshot+One','Bilbo','Bilbo+Swash+Caps','Bitter','Black+Ops+One','Bokor','Bonbon','Boogaloo','Bowlby+One','Bowlby+One+SC','Brawler','Bree+Serif','Bubblegum+Sans','Buda','Buenard','Butcherman','Butterfly+Kids','Cabin','Cabin+Condensed','Cabin+Sketch','Caesar+Dressing','Cagliostro','Calligraffitti','Cambo','Candal','Cantarell','Cantata+One','Cantora+One','Capriola','Cardo','Carme','Carter+One','Caudex','Cedarville+Cursive','Ceviche+One','Changa+One','Chango','Chau+Philomene+One','Chelsea+Market','Chenla','Cherry+Cream+Soda','Chewy','Chicle','Chivo','Coda','Coda+Caption','Codystar','Comfortaa','Coming+Soon','Concert+One','Condiment','Content','Contrail+One','Convergence','Cookie','Copse','Corben','Courgette','Cousine','Coustard','Covered+By+Your+Grace','Crafty+Girls','Creepster','Crete+Round','Crimson+Text','Crushed','Cuprum','Cutive','Damion','Dancing+Script','Dangrek','Dawning+of+a+New+Day','Days+One','Delius','Delius+Swash+Caps','Delius+Unicase','Della+Respira','Devonshire','Didact+Gothic','Diplomata','Diplomata+SC','Doppio+One','Dorsa','Dosis','Dr+Sugiyama','Droid+Sans','Droid+Sans+Mono','Droid+Serif','Duru+Sans','Dynalight','EB+Garamond','Eagle+Lake','Eater','Economica','Electrolize','Emblema+One','Emilys+Candy','Engagement','Enriqueta','Erica+One','Esteban','Euphoria+Script','Ewert','Exo','Expletus+Sans','Fanwood+Text','Fascinate','Fascinate+Inline','Fasthand','Federant','Federo','Felipa','Fjord+One','Flamenco','Flavors','Fondamento','Fontdiner+Swanky','Forum','Francois+One','Fredericka+the+Great','Fredoka+One','Freehand','Fresca','Frijole','Fugaz+One','GFS+Didot','GFS+Neohellenic','Galdeano','Galindo','Gentium+Basic','Gentium+Book+Basic','Geo','Geostar','Geostar+Fill','Germania+One','Give+You+Glory','Glass+Antiqua','Glegoo','Gloria+Hallelujah','Goblin+One','Gochi+Hand','Gorditas','Goudy+Bookletter+1911','Graduate','Gravitas+One','Great+Vibes','Gruppo','Gudea','Habibi','Hammersmith+One','Handlee','Hanuman','Happy+Monkey','Henny+Penny','Herr+Von+Muellerhoff','Holtwood+One+SC','Homemade+Apple','Homenaje','IM+Fell+DW+Pica','IM+Fell+DW+Pica+SC','IM+Fell+Double+Pica','IM+Fell+Double+Pica+SC','IM+Fell+English','IM+Fell+English+SC','IM+Fell+French+Canon','IM+Fell+French+Canon+SC','IM+Fell+Great+Primer','IM+Fell+Great+Primer+SC','Iceberg','Iceland','Imprima','Inconsolata','Inder','Indie+Flower','Inika','Irish+Grover','Istok+Web','Italiana','Italianno','Jim+Nightshade','Jockey+One','Jolly+Lodger','Josefin+Sans','Josefin+Slab','Judson','Julee','Junge','Jura','Just+Another+Hand','Just+Me+Again+Down+Here','Kameron','Karla','Kaushan+Script','Kelly+Slab','Kenia','Khmer','Knewave','Kotta+One','Koulen','Kranky','Kreon','Kristi','Krona+One','La+Belle+Aurore','Lancelot','Lato','League+Script','Leckerli+One','Ledger','Lekton','Lemon','Life+Savers','Lilita+One','Limelight','Linden+Hill','Lobster','Lobster+Two','Londrina+Outline','Londrina+Shadow','Londrina+Sketch','Londrina+Solid','Lora','Love+Ya+Like+A+Sister','Loved+by+the+King','Lovers+Quarrel','Luckiest+Guy','Lusitana','Lustria','Macondo','Macondo+Swash+Caps','Magra','Maiden+Orange','Mako','Marck+Script','Marko+One','Marmelad','Marvel','Mate','Mate+SC','Maven+Pro','McLaren','Meddon','MedievalSharp','Medula+One','Megrim','Merienda+One','Merriweather','Metal','Metal+Mania','Metamorphous','Metrophobic','Michroma','Miltonian','Miltonian+Tattoo','Miniver','Miss+Fajardose','Modern+Antiqua','Molengo','Monofett','Monoton','Monsieur+La+Doulaise','Montaga','Montez','Montserrat','Moul','Moulpali','Mountains+of+Christmas','Mr+Bedfort','Mr+Dafoe','Mr+De+Haviland','Mrs+Saint+Delafield','Mrs+Sheppards','Muli','Mystery+Quest','Neucha','Neuton','News+Cycle','Niconne','Nixie+One','Nobile','Nokora','Norican','Nosifer','Nothing+You+Could+Do','Noticia+Text','Nova+Cut','Nova+Flat','Nova+Mono','Nova+Oval','Nova+Round','Nova+Script','Nova+Slim','Nova+Square','Numans','Nunito','Odor+Mean+Chey','Old+Standard+TT','Oldenburg','Oleo+Script','Open+Sans','Open+Sans+Condensed','Orbitron','Oregano','Original+Surfer','Oswald','Over+the+Rainbow','Overlock','Overlock+SC','Ovo','Oxygen','PT+Mono','PT+Sans','PT+Sans+Caption','PT+Sans+Narrow','PT+Serif','PT+Serif+Caption','Pacifico','Parisienne','Passero+One','Passion+One','Patrick+Hand','Patua+One','Paytone+One','Peralta','Permanent+Marker','Petrona','Philosopher','Piedra','Pinyon+Script','Plaster','Play','Playball','Playfair+Display','Podkova','Poiret+One','Poller+One','Poly','Pompiere','Pontano+Sans','Port+Lligat+Sans','Port+Lligat+Slab','Prata','Preahvihear','Press+Start+2P','Princess+Sofia','Prociono','Prosto+One','Puritan','Quando','Quantico','Quattrocento','Quattrocento+Sans','Questrial','Quicksand','Qwigley','Racing+Sans+One','Radley','Raleway','Rammetto+One','Rancho','Rationale','Redressed','Reenie+Beanie','Revalia','Ribeye','Ribeye+Marrow','Righteous','Roboto','Rochester','Rock+Salt','Rokkitt','Romanesco','Ropa+Sans','Rosario','Rosarivo','Rouge+Script','Ruda','Ruge+Boogie','Ruluko','Ruslan+Display','Russo+One','Ruthie','Sail','Salsa','Sancreek','Sansita+One','Sarina','Satisfy','Schoolbell','Seaweed+Script','Sevillana','Shadows+Into+Light','Shadows+Into+Light+Two','Shanti','Share','Shojumaru','Short+Stack','Siemreap','Sigmar+One','Signika','Signika+Negative','Simonetta','Sirin+Stencil','Six+Caps','Slackey','Smokum','Smythe','Sniglet','Snippet','Sofia','Sonsie+One','Sorts+Mill+Goudy','Source+Sans+Pro','Special+Elite','Spicy+Rice','Spinnaker','Spirax','Squada+One','Stardos+Stencil','Stint+Ultra+Condensed','Stint+Ultra+Expanded','Stoke','Sue+Ellen+Francisco','Sunshiney','Supermercado+One','Suwannaphum','Swanky+and+Moo+Moo','Syncopate','Tangerine','Taprom','Telex','Tenor+Sans','The+Girl+Next+Door','Tienne','Tinos','Titan+One','Trade+Winds','Trocchi','Trochut','Trykker','Tulpen+One','Ubuntu','Ubuntu+Condensed','Ubuntu+Mono','Ultra','Uncial+Antiqua','UnifrakturCook','UnifrakturMaguntia','Unkempt','Unlock','Unna','VT323','Varela','Varela+Round','Vast+Shadow','Vibur','Vidaloka','Viga','Voces','Volkhov','Vollkorn','Voltaire','Waiting+for+the+Sunrise','Wallpoet','Walter+Turncoat','Wellfleet','Wire+One','Yanone+Kaffeesatz','Yellowtail','Yeseva+One','Yesteryear','Zeyada');
			$google_font = str_replace('+', ' ', $google_font);

			?>
<script type="text/javascript"
	src="<?php echo WP_THEME_URL; ?>/inc/js/jscolor/jscolor.js"></script>
<div class="wrap">
	<style type="text/css">
.mn a {
	display: block;
	width: 200px;
	font-size: 12px;
	text-shadow: 1px 1px #fff;
	font-weight: bold;
	background-color: #ffe222;
	height: 48px;
	line-height: 48px;
	border-bottom: 1px solid #ffc822;
	padding-left: 20px;
	color: #000;
}

.sel {
	text-shadow: 1px 1px #FFF !important;
	color: #111 !important;
	background-color: #fff !important;
	padding-right: 1px;
	border-bottom: 1px solid #ccc !important;
}

.mn a:hover {
	cursor: pointer;
	text-shadow: 1px 1px #fff !important;
	color: #000 !important;
	border-bottom: 1px solid #ffb922 !important;
	background-color: #ffd322 !important;
}

.mn {
	border: 1px solid #dfdfdf;
	width: 220px;
	position: absolute;
	z-index: 2;
}

input.btn {
	padding: 8px !important;
	padding-left: 20px !important;
	padding-right: 20px !important;
	-webkit-border-radius: 3px !important;
	border-radius: 3px !important;
}

.pd5 {
	padding: 5px;
	padding-top: 10px;
	padding-bottom: 10px;
	border-bottom: 1px solid #fff;
	border-top: 1px solid #e7e7e7;
}

hr {
	border: 0;
	border-bottom: 1px solid #fff;
	border-top: 1px solid #e7e7e7;
}

.pd5 label {
	width: 184px;
	display: inline-block;
	vertical-align: top;
	padding-top: 5px;
}

.sele {
	border: 2px solid #333;
	padding: 2px;
}

pre {
	padding: 10px;
	background: #f4f4f4;
	color: #333;
	border: 1px solid #f1f1f1;
	overflow: auto;
	overflow-y: hidden;
	font-size: 11px;
}

.postbox {
	background: #FFF !important;
	min-height: 595px;
}

.cblogo {
	position: absolute;
	right: 0;
	top: -10px;
	width: 113px;
	height: 74px;
}

.mn a i {
	font-size: 20px;
	padding-right: 2px;
	width: 30px;
	display: inline-block;
	vertical-align: middle;
}
</style>
	<h2 style="text-transform: uppercase; color: #000;">
		Cosmetico Theme Dashboard <a href="http://cb-theme.com"
			target="_blank"><img src="http://cb-theme.com/logo.png"
			alt="cb-theme wordpress themes" class="cblogo" width="113"
			height="74" /> </a>
	</h2>
	<div class="cl"></div>
	<div style="float: left; width: 221px; padding-top: 10px;">
		<div style="float: left; width: 30%;">
			<div class="mn">
				<a id="general" class="sel"><i class="icon-dashboard"></i> <?php _e('General Settings','cb-cosmetico'); ?>
				</a> <a id="homepage"><i class="icon-home"></i> <?php _e('Homepage','cb-cosmetico'); ?>
				</a> <a id="styles"><i class="icon-picture"></i> <?php _e('Styles','cb-cosmetico'); ?>
				</a> <a id="headermenu"><i class="icon-random"></i> <?php _e('Headers and Menu','cb-cosmetico'); ?>
				</a> <a id="sidebars"><i class="icon-exchange"></i> <?php _e('Sidebars','cb-cosmetico'); ?>
				</a> <a id="slider"><i class="icon-desktop"></i> <?php _e('Slider','cb-cosmetico'); ?>
				</a> <a id="slider2"><i class="icon-camera"></i> <?php _e('Fullscreen Slider','cb-cosmetico'); ?>
				</a> <a id="top-icons" style="display: none;"><i class="icon-beaker"></i>
				<?php _e('Top Icons','cb-cosmetico'); ?> </a> <a id="recaptcha"
					style="display: none;"><i class="icon-lock"></i> <?php _e('reCaptcha','cb-cosmetico'); ?>
				</a>
				<?php if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {?><a id="wooshop"><i class="icon-cogs"></i> <?php _e('WooCommerce','cb-cosmetico'); ?></a><?php }?>
				<a id="shortcodes" style="display: none;"><i class="icon-tags"></i>
				<?php _e('Shortcodes','cb-cosmetico'); ?> </a> <a id="democ"><i
					class="icon-magic"></i> <?php _e('Demo Content','cb-cosmetico'); ?>
				</a> <a id="general"
					href="../wp-content/themes/cb-cosmetico/docs/documentation.html"
					style="text-decoration: none;" target="_blank"><i class="icon-cogs"></i>
					<?php _e('Help and Credits','cb-cosmetico'); ?> </a>
			</div>

		</div>

		</br>
		<?php
		if (isset($_POST["update_settings"])) {
			$upload_logo=get_option('cb5_upload_logo');
			$upload_bg=get_option('cb5_upload_bg');
			$middle_backgroundi=get_option('cb5_middle_backgroundi');
			$favi=get_option('cb5_favi');
			?>
		<div id="message" class="updated" style="padding: 30px;">
		<?php _e('Settings saved','cb-cosmetico'); ?>
		</div>
		<script type="text/javascript">
jQuery('#message').delay(5000).fadeOut();

</script>
<?php } ?>

	</div>

	<div style="float: left; width: 70%;">
		<div id="poststuff" class="metabox-holder">
			<div class="postbox"
				style="-webkit-border-top-left-radius: 0px; border-top-left-radius: 0px !important;">
				<div class="inside">
					<form method="POST" action="" enctype="multipart/form-data"
						id="cb_setts">



						<div id="saved"
							style="position: fixed; top: 23px; left: 0; right: 0; height: 100%; display: none; z-index: 999999; text-align: center; vertical-align: middle;"></div>

						<!-- GENERAL SECTION START -->
						<div class="general">

							<div class="pd5" style="border-top: none;">
								<label for="upload_logo"><?php _e('Logo','cb-cosmetico'); ?> </label>
								<input id="upload_logo" type="text" size="36" name="upload_logo"
									class="upurl input-upload" value="<?php echo $upload_logo; ?>" /><input
									style="cursor: pointer;" class="upload_button2" type="button"
									value="Upload Logo" /><br /> <br />
									<?php _e('Enter an URL or upload logo','cb-cosmetico'); ?>
								.
								<?php if($upload_logo!='') {
									require_once(get_template_directory().'/BFI_Thumb.php');
									echo '</br></br><div>Current logo:  <a href="'.$upload_logo.'" target="_blank"><img class="sele" src="'.bfi_thumb($upload_logo, array('width' => 145, 'crop' => true)).'" align="absmiddle" alt="logo" style="background:#111;-moz-border-radius:3px;webkit-border-radius:3px;border-radius:3px;"/></a></div></br>';
								} ?>
							</div>
							<input type="hidden" name="bg_old"
								value="<?php echo $upload_bg; ?>" /><input type="hidden"
								name="bg_oldi" value="<?php echo $middle_backgroundi; ?>" />


							<div class="pd5">
								<label for="show_logo_text"><?php _e('Show only text logo','cb-cosmetico'); ?>?</label>
								<select name="show_logo_text" id="show_logo_text"><option
										value="yes">
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($show_logo_text=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select> (
								<?php _e('Disable image logo','cb-cosmetico'); ?>
								)
							</div>

							<div class="pd5">
								<label for="logo_text"><?php _e('Logo Text','cb-cosmetico'); ?>
								</label> <input type="text" name="logo_text" id="logo_text"
									value="<?php echo $logo_text;?>" />
							</div>
							<div class="pd5">
								<label for="logomt"><?php _e('Logo Top Margin','cb-cosmetico'); ?>
								</label> <input type="text" name="logomt" id="logomt"
									value="<?php echo $logomt;?>" />
							</div>


							<div class="pd5">
								<label for="logo_f"><?php _e('Logo Font Family - Google','cb-cosmetico'); ?>
								</label> <select name="logo_f" id="logo_f">
								<?php for ($i=0;$i<sizeof($google_font);$i++){
									if($logo_f==$google_font[$i]) $ffg=' selected'; else $ffg='';
									echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
								} ?>
								</select>
							</div>

							<div class="pd5">
								<label for="logo_font"><?php _e('Logo Font Size','cb-cosmetico'); ?>
								</label> <input type="text" name="logo_font" id="logo_font"
									value="<?php echo $logo_font;?>" /> (
									<?php _e('only numbers and px like 32px','cb-cosmetico'); ?>
								)
							</div>

							<div class="pd5" style="display: none;">
								<label for="logo_slogan"><?php _e('Logo Slogan','cb-cosmetico'); ?>
								</label> <input type="text" name="logo_slogan" id="logo_slogan"
									value="<?php echo $logo_slogan;?>" style="width: 250px" />
							</div>

							<div class="pd5">
								<label for="favi"><?php _e('Favicon upload','cb-cosmetico'); ?>
								</label> <input id="favi" type="text" size="36" name="favi"
									class="upurl input-upload" value="<?php echo $favi; ?>" /><input
									style="cursor: pointer;" class="upload_button2" type="button"
									value="<?php _e('Upload Favicon','cb-cosmetico'); ?>" /><br />
								<br />
								<?php _e('Enter an URL or upload favicon.','cb-cosmetico'); ?>
							</div>

							<div class="pd5">
								<label for="show_bread"><?php _e('Show breadcrumbs','cb-cosmetico'); ?>?</label>
								<select name="show_bread" id="show_bread"><option value="yes">
								<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($show_bread=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5" style="display: none;">
								<label for="show_footer"><?php _e('Show wordpress footer','cb-cosmetico'); ?>
								</label> <select name="show_footer" id="show_footer"><option
										value="no">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($show_footer=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select> (
								<?php _e('proudly powered by Wordpress','cb-cosmetico'); ?>
								)
							</div>

							<div class="pd5">
								<label for="wayp"><?php _e('Fade blocks','cb-cosmetico'); ?>?</label>
								<select name="wayp" id="wayp"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($wayp=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select> (
								<?php _e('fade in elements on scroll','cb-cosmetico'); ?>
								)
							</div>

							<div class="pd5">
								<label for="show_comments"><?php _e('Show comments','cb-cosmetico'); ?>
								</label> <select name="show_comments" id="show_comments"><option
										value="yes">
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($show_comments=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="show_midb"><?php _e('Show Middlebar Widget on','cb-cosmetico'); ?>:</label>
								<select name="show_midb" id="show_midb"><option value="home">
								<?php _e('home','cb-cosmetico'); ?>
									</option>
									<option value="everywhere"
									<?php if($show_midb=='everywhere'){?> selected <?php } ?>>
										<?php _e('everywhere','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="google_analytics"><?php _e('Google Analytics ID','cb-cosmetico'); ?>
								</label> <input type="text" name="google_analytics"
									id="google_analytics" value="<?php echo $google_analytics;?>" />
								(
								<?php _e('Only ID','cb-cosmetico'); ?>
								: UA-...)
							</div>

							<div class="pd5">
								<label for="not_error"><?php _e('Not found page title','cb-cosmetico'); ?>
								</label> <input type="text" name="not_error" id="not_error"
									value="<?php echo $not_error;?>" style="width: 250px" />
							</div>

							<div class="pd5">
								<label for="not_desc"><?php _e('Not found page desc','cb-cosmetico'); ?>
								</label><br />
								<textarea name="not_desc" id="not_desc"
									style="width: 250px; height: 100px;" />
									<?php echo $not_desc;?>
								</textarea>
							</div>

							<div class="pd5">
								<label for="meta_description"><?php _e('Blog meta description','cb-cosmetico'); ?>
								</label><br />
								<textarea name="meta_description" id="meta_description"
									style="width: 250px; height: 50px;" />
									<?php echo $meta_description;?>
								</textarea>
							</div>

							<div class="pd5">
								<label for="meta_keywords"><?php _e('Blog meta keywords','cb-cosmetico'); ?>
								</label><br />
								<textarea name="meta_keywords" id="meta_keywords"
									style="width: 250px; height: 50px;" />
									<?php echo $meta_keywords;?>
								</textarea>
							</div>

							<div class="pd5">
								<label for="post_details"><?php _e('Show post details','cb-cosmetico'); ?>?</label>
								<select name="post_details" id="post_details"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($post_details=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="disable_pp"><?php _e('Disable prettyPhoto','cb-cosmetico'); ?>?</label>
								<select name="disable_pp" id="disable_pp"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($disable_pp=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="admin_theme"><?php _e('Show under construction page','cb-cosmetico'); ?>?</label>
								<select name="under" id="under"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($under=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5">
								<label for="scroll"><?php _e('Show scroll to top button','cb-cosmetico'); ?>?</label>
								<select name="scroll" id="scroll"><option value="yes">
								<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($scroll=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5">
								<label for="usescroll"><?php _e('Use custom scrollbar','cb-cosmetico'); ?>?</label>
								<select name="usescroll" id="usescroll"><option value="yes">
								<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($usescroll=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5">
								<label for="social_fb"><?php _e('Facebook Link','cb-cosmetico'); ?>
								</label> <input type="text" name="social_fb" id="social_fb"
									style="width: 250px;" value="<?php echo $social_fb;?>" />
							</div>

							<div class="pd5">
								<label for="social_tw"><?php _e('Twitter Link','cb-cosmetico'); ?>
								</label> <input type="text" name="social_tw" id="social_tw"
									style="width: 250px;" value="<?php echo $social_tw;?>" />
							</div>

							<div class="pd5">
								<label for="social_in"><?php _e('LinkedIn Link','cb-cosmetico'); ?>
								</label> <input type="text" name="social_in" id="social_in"
									style="width: 250px;" value="<?php echo $social_in;?>" />
							</div>

							<div class="pd5">
								<label for="social_yt"><?php _e('YouTube Link','cb-cosmetico'); ?>
								</label> <input type="text" name="social_yt" id="social_yt"
									style="width: 250px;" value="<?php echo $social_yt;?>" />
							</div>

							<div class="pd5">
								<label for="social_vi"><?php _e('Vimeo Link','cb-cosmetico'); ?>
								</label> <input type="text" name="social_vi" id="social_vi"
									style="width: 250px;" value="<?php echo $social_vi;?>" />
							</div>

							<div class="pd5">
								<label for="social_rss"><?php _e('RSS','cb-cosmetico'); ?> </label>
								<input type="text" name="social_rss" id="social_rss"
									style="width: 250px;" value="<?php echo $social_rss;?>" />
							</div>

							<div class="pd5" style="display: none;">
								<label for="hide_top"><?php _e('Hide top Social bar','cb-cosmetico'); ?>?</label>
								<select name="hide_top" id="hide_top"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($hide_top=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5" style="display: none;">
								<label for="social_foot"><?php _e('Show social icons in footer','cb-cosmetico'); ?>?</label>
								<select name="social_foot" id="social_foot"><option value="yes">
								<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($social_foot=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							
							
							
							
							
							
							
							
							
							<div class="pd5">	<label for="" style="font-weight:bold;"><?php _e('Mailchimp Integration','cb-cosmetico'); ?></label>
							</div>
		<span class="prompt" style="font-size: 11px;padding-left: 5px;">Where to get the key from: <a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank">http://kb.mailchimp.com/article/where-can-i-find-my-api-key</a></span>
        <div class="cl"></div>
        <div class="pd5"><label for="mailchimp_key"><?php _e('MailChimp API key', 'cb-cosmetico'); ?></label>
            <input type="text" name="mailchimp_key" id="mailchimp_key" style="width:360px;" value="<?php echo get_option('cb5_mailchimp_key'); ?>"/>
        </div>
        <input type="hidden" name="mailchimp_default"  value="<?php echo get_option('cb5_mailchimp_default');?>" />
        <?php
        if (get_option('cb5_mailchimp_key')!=""){
            if (!class_exists('MailChimp')) require_once(get_template_directory() . '/inc/mailchimp-api-master/MailChimp.class.php');
            $MailChimp = new MailChimp(get_option('cb5_mailchimp_key'));
            $list = $MailChimp->call('lists/list');
            if (isset($list['status'])&&$list['status']=='error'){
              echo '<div id="message" class="error"><p><strong>' . $list['name'] . '</strong> ' . $list['error'] . '<hr>'.__('"General Settings" tab, "MailChimp settings" section', 'cb-cosmetico').'</p></div>';

            }else{
         
            ?>

        <div class="pd5"><label for="mailchimp_default"><?php _e('MailChimp default list', 'cb-cosmetico'); ?></label>
               <?php
               if ($list['total']>0){
               ?>
                <select name="mailchimp_default" id="mailchimp_default">
				<option value="">select list</option>
                    <?php
                    foreach ($list['data'] as $lista){
                        if(get_option('cb5_mailchimp_default')==$lista['id'])
                            echo '<option value="'.$lista['id'].'" selected>'.$lista['name'].'</option>';
                        else
                            echo '<option value="'.$lista['id'].'">'.$lista['name'].'</option>';
                    }
                    ?>

                </select>
                   <?php
               }
               else{
                   echo '<span>No lists added</span>';
               }
                       ?>
        </div>
         <?php   }}
        ?>
        <div class="pd5"><label for="mailchimp_success"><?php _e('MailChimp success message', 'cb-cosmetico'); ?></label>
            <textarea name="mailchimp_success" id="mailchimp_success"
                      style="width:250px;height:60px;"/><?php echo stripslashes($mailchimp_success); ?></textarea>
        </div>
        <div class="pd5"><label for="mailchimp_failure"><?php _e('MailChimp failure message', 'cb-cosmetico'); ?></label>
            <textarea name="mailchimp_failure" id="mailchimp_failure"
                      style="width:250px;height:60px;"/><?php echo stripslashes($mailchimp_failure); ?></textarea>
        </div>
							
							
							
							
							
							
							
							
							
							
						</div>
						<!-- ## GENERAL SECTION END ## -->








						<!-- HEADERS AND MENU SECTION START -->
						<div class="headermenu">

							

							<div class="pd5" style="border-top: none;display:none;">
								<label for="mheadertype"><?php _e('Header Type','cb-cosmetico'); ?>
								</label> <select name="mheadertype" id="mheadertype"><option
										value="left">
										<?php _e('left bottom menu- default','cb-cosmetico'); ?>
									</option>
									<option value="center" <?php if($mheadertype=='center'){?>
										selected <?php } ?>>
										<?php _e('center menu, center logo','cb-cosmetico'); ?>
									</option>
									<option value="right" <?php if($mheadertype=='right'){?>
										selected <?php } ?>>
										<?php _e('right menu, center logo','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<h4>Setting icons in Menu</h4>
							1. If you want to add custom icon to your menu copy icon name
							from <a
								href="../wp-content/themes/cb-cosmetico/docs/cb_documentation.html#icons"
								target="_blank">here</a><br /> 2. Go to Wordpress DA->
							Appearance-> Menus.<br /> 3. Select your menu and click Screen
							Options on the top right.<br /> 4. Click CSS checkbox.<br /> 5.
							Now when you click little triangle on the right of your menu item
							you will see CSS Classes input field.<br /> 6. Paste your icon
							name into CSS Classes input field. (for example: "icon-anchor")<br />
							7. Save<br /> <br /> You can control icon size by adding "small"
							or "big" to css class. <br /> For example it will look like this:
							<pre>icon-anchor big</pre>
							<br />

							<div class="pd5" style="border-top: none;">
								<label for="showtopwidget"><?php _e('Show top widget on home','cb-cosmetico'); ?>?</label>
								<select name="showtopwidget" id="showtopwidget"><option
										value="no">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($showtopwidget=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5" style="border-top: none;">
								<label for="showmenusearch"><?php _e('Show menu search icon','cb-cosmetico'); ?>?</label>
								<select name="showmenusearch" id="showmenusearch"><option
										value="no">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($showmenusearch=='yes'){?>
										selected <?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5" style="display: none;">
								<label for="headertransparent"><?php _e('Transparent header','cb-cosmetico'); ?>?</label>
								<select name="headertransparent" id="headertransparent"><option
										value="yes">
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($headertransparent=='no'){?>
										selected <?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="slidertoptint"><?php _e('Tint header title background','cb-cosmetico'); ?>?</label>
								<select name="slidertoptint" id="slidertoptint"><option
										value="blight">
										<?php _e('black light','cb-cosmetico'); ?>
									</option>
									<option value="bdark" <?php if($slidertoptint=='bdark'){?>
										selected <?php } ?>>
										<?php _e('black dark','cb-cosmetico'); ?>
									</option>
									<option value="wlight" <?php if($slidertoptint=='wlight'){?>
										selected <?php } ?>>
										<?php _e('white light','cb-cosmetico'); ?>
									</option>
									<option value="wdark" <?php if($slidertoptint=='wdark'){?>
										selected <?php } ?>>
										<?php _e('white dark','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($slidertoptint=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>




						</div>
						<!-- ## HEADER AND MENU SECTION END ## -->













						<!--WOOCOMMERCE SECTION START-->
						<div class="wooshop">

							<div class="pd5" style="border-top: none;">
								<label for="sidebar_shop"><?php _e('WooCommerce Sidebar Column','cb-cosmetico'); ?>
								</label> <select name="sidebar_shop" id="sidebar_shop"><option
										value="right">
										<?php _e('right','cb-cosmetico'); ?>
									</option>
									<option value="left" <?php if($sidebar_shop=='left'){?>
										selected <?php } ?>>
										<?php _e('left','cb-cosmetico'); ?>
									</option>
									<option value="" <?php if($sidebar_shop==''){?>
										selected <?php } ?>>
										<?php _e('none','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5">
								<label for="woo_menu"><?php _e('List WooCommerce Categories in Header Main Menu?','cb-cosmetico'); ?>
								</label> <select name="woo_menu" id="woo_menu"><option
										value="yes">
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($woo_menu=='no'){?>
										selected <?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5">
								<label for="woo_pagi"><?php _e('WooCommerce Pagination','cb-cosmetico'); ?>
								</label> <select name="woo_pagi" id="woo_pagi"><option
										value="ajax">
										<?php _e('ajax','cb-cosmetico'); ?>
									</option>
									<option value="normal" <?php if($woo_pagi=='normal'){?>
										selected <?php } ?>>
										<?php _e('normal','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5">
								<label for="woo_cat"><?php _e('Show default category background','cb-cosmetico'); ?>
								</label> <select name="woo_cat" id="woo_cat"><option
										value="yes">
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($woo_cat=='no'){?>
										selected <?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5">
								<label for="woo_per_page"><?php _e('Products per page','cb-cosmetico'); ?>
								</label> <input name="woo_per_page" id="woo_per_page"
									type="text" value="<?php echo $woo_per_page; ?>">
							</div>


							<div class="pd5">
								<label for="woo_cols"><?php _e('Number of columns','cb-cosmetico'); ?>
								</label> <input name="woo_cols" id="woo_cols" type="text"
									value="<?php echo $woo_cols; ?>">
							</div>
							<small>Don't forget to adjust thumbnail sizes in WooCommerce
								Settings page.</small>

							<div class="pd5">
								<label for="woo_related_c"><?php _e('You will also like Columns','cb-cosmetico'); ?>
								</label> <input name="woo_related_c" id="woo_related_c"
									type="text" value="<?php echo $woo_related_c; ?>">
							</div>
							<div class="pd5">
								<label for="woo_related_n"><?php _e('You will also like Products Number','cb-cosmetico'); ?>
								</label> <input name="woo_related_n" id="woo_related_n"
									type="text" value="<?php echo $woo_related_n; ?>">
							</div>

							<div class="pd5">
								<label for="woo_relatedup_c"><?php _e('Up/Crossels Columns','cb-cosmetico'); ?>
								</label> <input name="woo_relatedup_c" id="woo_relatedup_c"
									type="text" value="<?php echo $woo_relatedup_c; ?>">
							</div>
							<div class="pd5">
								<label for="woo_relatedup_n"><?php _e('Up/Crossels Products Number','cb-cosmetico'); ?>
								</label> <input name="woo_relatedup_n" id="woo_relatedup_n"
									type="text" value="<?php echo $woo_relatedup_n; ?>">
							</div>

						</div>
						<!--WOOCOMMERCE SECTION END ##-->






						<!-- RECAPTCHA SECTION START-->
						<div class="recaptcha">
							<div class="pd5" style="border-top: none;">
								<label for="r_use"><?php _e('Use reCAPTCHA','cb-cosmetico'); ?>?</label>
								<select name="r_use" id="r_use"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($r_use=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
								<div>
								<?php _e('Get reCAPTCHA keys from','cb-cosmetico'); ?>
									<a href="http://www.google.com/recaptcha" target="_blank"><?php _e('here','cb-cosmetico'); ?>
									</a>
								</div>
							</div>

							<div class="pd5">
								<label for="r_public"><?php _e('reCAPTCHA public key','cb-cosmetico'); ?>
								</label> <input type="text" name="r_public" id="r_public"
									style="width: 250px;" value="<?php echo $r_public;?>" />
							</div>

							<div class="pd5">
								<label for="r_private"><?php _e('reCAPTCHA private key','cb-cosmetico'); ?>
								</label> <input type="text" name="r_private" id="r_private"
									style="width: 250px;" value="<?php echo $r_private;?>" />
							</div>

							<div class="pd5">
								<label for="r_template"><?php _e('reCAPTCHA template','cb-cosmetico'); ?>
								</label> <select name="r_template" id="r_template"><option
										value="white">white</option>
									<option value="red" <?php if($r_template=='red'){?> selected
									<?php } ?>>red</option>
									<option value="clean" <?php if($r_template=='clean'){?>
										selected <?php } ?>>clean</option>
									<option value="blackglass"
									<?php if($r_template=='blackglass'){?> selected <?php } ?>>blackglass</option>
								</select>
							</div>
						</div>
						<!-- ## RECAPTCHA SECTION END ##-->




						<!-- HOMEPAGE SECTION START ##-->
						<div class="homepage">

							<b>Use this only if you did not set up home to a single page in
								Wordpress Settings -> Reading</b><br /> <br />

							<div class="pd5" style="border-top: none;">
								<label for="home_template"><?php _e('Home Layout','cb-cosmetico'); ?>
								</label> <select name="home_template" id="home_template"><option
										value="4" <?php if($home_template=='4'){?> selected <?php } ?>>
										<?php _e('4 Columns','cb-cosmetico'); ?>
									</option>
									<option value="3" <?php if($home_template=='3'){?> selected
									<?php } ?>>
										<?php _e('3 Columns','cb-cosmetico'); ?>
									</option>
									<option value="2" <?php if($home_template=='2'){?> selected
									<?php } ?>>
										<?php _e('2 Columns','cb-cosmetico'); ?>
									</option>
									<option value="1" <?php if($home_template=='1'){?> selected
									<?php } ?>>
										<?php _e('1 Column','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="h_title"><?php _e('Show title in posts with featured image','cb-cosmetico'); ?>?</label>
								<select name="h_title" id="h_title"><option value="yes">yes</option>
									<option value="no" <?php if($h_title=='no') echo 'selected'; ?>>no</option>
								</select>
							</div>

							<div class="pd5">
								<label for="h_more"><?php _e('Show short description and details in posts with featured image','cb-cosmetico'); ?>?</label>
								<select name="h_more" id="h_more"><option value="yes">yes</option>
									<option value="no" <?php if($h_more=='no') echo 'selected'; ?>>no</option>
								</select>
							</div>

							<div class="pd5">
								<label for="home_number"><?php _e('Home number of posts','cb-cosmetico'); ?>
								</label> <input type="text" name="home_number" id="home_number"
									value="<?php echo $home_number;?>" /> (
									<?php _e('numeric only','cb-cosmetico'); ?>
								)
							</div>

							<div class="pd5">
								<label for="home_limit"><?php _e('Post characters limit','cb-cosmetico'); ?>
								</label> <input type="text" name="home_limit" id="home_limit"
									value="<?php echo $home_limit;?>" /> (
									<?php _e('numeric only','cb-cosmetico'); ?>
								)
							</div>

							<div class="pd5">
								<label for="home_cat"><?php _e('Home posts category','cb-cosmetico'); ?>
								</label>
								<?php wp_dropdown_categories('show_count=0&hierarchical=1&hide_empty=0&name=home_cat&selected='.$home_cat.''); ?>
							</div>


							<div class="pd5">
								<label for="h_sid"><?php _e('Sidebar','cb-cosmetico'); ?> </label>
								<select name="h_sid" id="h_sid"><option value=""
								<?php if($h_sid== ''){ echo " selected";} ?>>none</option>
								<?php
								global $wp_registered_sidebars;
								$sidy = $wp_registered_sidebars;
								if(is_array($sidy) && !empty($sidy)){
									foreach($sidy as $side){
										if($h_sid == $side['name']){ echo "<option value='{$side['name']}' selected>{$side['name']}</option>\n";
										} else { echo "<option value='{$side['name']}'>{$side['name']}</option>\n";}
									}
								} ?></select>
							</div>






						</div>
						<!-- ## HOMEPAGE SECTION END ##-->




						<!-- STYLES SECTION START-->
						<div class="styles">

							<div class="pd5" style="border-top: none;">
								<label for="wid"><?php _e('Layout','cb-cosmetico'); ?> </label>
								<select name="wid" id="wid"><option value="full">
								<?php _e('full width','cb-cosmetico'); ?>
									</option>
									<option value="fixed" <?php if($wid=='fixed'){?> selected
									<?php } ?>>
										<?php _e('boxed or fixed','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5" style="display: none !important;">
								<label for="fixed_top"><?php _e('Floating Header area','cb-cosmetico'); ?>?</label>
								<select name="fixed_top" id="fixed_top"><option value="yes">
								<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($fixed_top=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>
							<div class="pd5" style="display: none !important;">
								<label for="color_schema"><?php _e('Color schema','cb-cosmetico'); ?>
								</label> <select name="color_schema" id="color_schema"><option
										value="style.css">
										<?php _e('white','cb-cosmetico'); ?>
									</option>
									<option value="black.css"
									<?php if($color_schema=='black.css'){?> selected <?php } ?>>
										<?php _e('black','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="color_style"><?php _e('Color style','cb-cosmetico'); ?>
								</label> <select name="color_style" id="color_style"><option
										value="">-----</option>
									<option value="grey" <?php if($color_style=='grey'){?> selected
									<?php } ?>>grey</option>
									<option value="bright_red"
									<?php if($color_style=='bright_red'){?> selected <?php } ?>>bright
										red</option>
									<option value="blue" <?php if($color_style=='blue'){?> selected
									<?php } ?>>blue</option>
									<option value="cocoa" <?php if($color_style=='cocoa'){?>
										selected <?php } ?>>cocoa</option>
									<option value="dark_brown"
									<?php if($color_style=='dark_brown'){?> selected <?php } ?>>dark
										brown</option>
									<option value="white_coffee"
									<?php if($color_style=='white_coffee'){?> selected <?php } ?>>white
										coffee</option>
									<option value="brown_coffee"
									<?php if($color_style=='brown_coffee'){?> selected <?php } ?>>brown
										coffee</option>
									<option value="magenta" <?php if($color_style=='magenta'){?>
										selected <?php } ?>>magenta</option>
									<option value="bordo" <?php if($color_style=='bordo'){?>
										selected <?php } ?>>bordo</option>
									<option value="orange" <?php if($color_style=='orange'){?>
										selected <?php } ?>>orange</option>
									<option value="green" <?php if($color_style=='green'){?>
										selected <?php } ?>>green</option>
									<option value="green_lemon"
									<?php if($color_style=='green_lemon'){?> selected <?php } ?>>green
										lemon</option>
									<option value="paradise" <?php if($color_style=='paradise'){?>
										selected <?php } ?>>paradise</option>
									<option value="violet" <?php if($color_style=='violet'){?>
										selected <?php } ?>>violet</option>
									<option value="purple_pink"
									<?php if($color_style=='purple_pink'){?> selected <?php } ?>>purple
										pink</option>
									<option value="raspberry_pink"
									<?php if($color_style=='raspberry_pink'){?> selected
									<?php } ?>>raspberry pink</option>
									<option value="barbie_pink"
									<?php if($color_style=='barbie_pink'){?> selected <?php } ?>>barbie
										pink</option>
								</select>
							</div>

							<div class="pd5">
								<label for="stripes_bg_schema"><?php _e('Background Pattern','cb-cosmetico'); ?>
								</label> <select name="stripes_bg_schema" id="stripes_bg_schema">

									<option value="" <?php if($stripes_bg_schema==''){?> selected
									<?php } ?>>-----</option>

									
									<option value="slider-bg.jpg"
									<?php if($stripes_bg_schema=='slider-bg.jpg'){?> selected <?php } ?>>
										<?php _e('Cosmetico Bg','cb-cosmetico'); ?>
									</option>
									<option value="w1.png"
									<?php if($stripes_bg_schema=='w1.png'){?> selected <?php } ?>>
										<?php _e('White 1','cb-cosmetico'); ?>
									</option>
									<option value="w2.png"
									<?php if($stripes_bg_schema=='w2.png'){?> selected <?php } ?>>
										<?php _e('White 2','cb-cosmetico'); ?>
									</option>
									<option value="w3.png"
									<?php if($stripes_bg_schema=='w3.png'){?> selected <?php } ?>>
										<?php _e('White 3','cb-cosmetico'); ?>
									</option>
									<option value="w4.png"
									<?php if($stripes_bg_schema=='w4.png'){?> selected <?php } ?>>
										<?php _e('White 4','cb-cosmetico'); ?>
									</option>
									<option value="w5.png"
									<?php if($stripes_bg_schema=='w5.png'){?> selected <?php } ?>>
										<?php _e('White 5','cb-cosmetico'); ?>
									</option>
									<option value="w6.png"
									<?php if($stripes_bg_schema=='w6.png'){?> selected <?php } ?>>
										<?php _e('White 6','cb-cosmetico'); ?>
									</option>
									<option value="w7.png"
									<?php if($stripes_bg_schema=='w7.png'){?> selected <?php } ?>>
										<?php _e('White 7','cb-cosmetico'); ?>
									</option>
									<option value="w8.png"
									<?php if($stripes_bg_schema=='w8.png'){?> selected <?php } ?>>
										<?php _e('White 8','cb-cosmetico'); ?>
									</option>
									<option value="w9.png"
									<?php if($stripes_bg_schema=='w9.png'){?> selected <?php } ?>>
										<?php _e('White 9','cb-cosmetico'); ?>
									</option>
									<option value="w10.png"
									<?php if($stripes_bg_schema=='w10.png'){?> selected <?php } ?>>
										<?php _e('White 10','cb-cosmetico'); ?>
									</option>
									<option value="w11.png"
									<?php if($stripes_bg_schema=='w11.png'){?> selected <?php } ?>>
										<?php _e('White 11','cb-cosmetico'); ?>
									</option>
									<option value="w12.png"
									<?php if($stripes_bg_schema=='w12.png'){?> selected <?php } ?>>
										<?php _e('White 12','cb-cosmetico'); ?>
									</option>
									<option value="w13.png"
									<?php if($stripes_bg_schema=='w13.png'){?> selected <?php } ?>>
										<?php _e('White 13','cb-cosmetico'); ?>
									</option>
									<option value="w14.png"
									<?php if($stripes_bg_schema=='w14.png'){?> selected <?php } ?>>
										<?php _e('White 14','cb-cosmetico'); ?>
									</option>
									<option value="w15.png"
									<?php if($stripes_bg_schema=='w15.png'){?> selected <?php } ?>>
										<?php _e('White 15','cb-cosmetico'); ?>
									</option>
									<option value="w16.png"
									<?php if($stripes_bg_schema=='w16.png'){?> selected <?php } ?>>
										<?php _e('White 16','cb-cosmetico'); ?>
									</option>
									<option value="w17.png"
									<?php if($stripes_bg_schema=='w17.png'){?> selected <?php } ?>>
										<?php _e('White 17','cb-cosmetico'); ?>
									</option>
									<option value="w18.png"
									<?php if($stripes_bg_schema=='w18.png'){?> selected <?php } ?>>
										<?php _e('White 18','cb-cosmetico'); ?>
									</option>
									<option value="b1.png"
									<?php if($stripes_bg_schema=='b1.png'){?> selected <?php } ?>>
										<?php _e('Black 1','cb-cosmetico'); ?>
									</option>
									<option value="b2.png"
									<?php if($stripes_bg_schema=='b2.png'){?> selected <?php } ?>>
										<?php _e('Black 2','cb-cosmetico'); ?>
									</option>
									<option value="b3.png"
									<?php if($stripes_bg_schema=='b3.png'){?> selected <?php } ?>>
										<?php _e('Black 3','cb-cosmetico'); ?>
									</option>
									<option value="b4.png"
									<?php if($stripes_bg_schema=='b4.png'){?> selected <?php } ?>>
										<?php _e('Black 4','cb-cosmetico'); ?>
									</option>
									<option value="b5.png"
									<?php if($stripes_bg_schema=='b5.png'){?> selected <?php } ?>>
										<?php _e('Black 5','cb-cosmetico'); ?>
									</option>
									<option value="b6.png"
									<?php if($stripes_bg_schema=='w6.png'){?> selected <?php } ?>>
										<?php _e('Black 6','cb-cosmetico'); ?>
									</option>
									<option value="b7.png"
									<?php if($stripes_bg_schema=='b7.png'){?> selected <?php } ?>>
										<?php _e('Black 7','cb-cosmetico'); ?>
									</option>
									<option value="b8.png"
									<?php if($stripes_bg_schema=='b8.png'){?> selected <?php } ?>>
										<?php _e('Black 8','cb-cosmetico'); ?>
									</option>
									<option value="b9.png"
									<?php if($stripes_bg_schema=='b9.png'){?> selected <?php } ?>>
										<?php _e('Black 9','cb-cosmetico'); ?>
									</option>
									<option value="b10.png"
									<?php if($stripes_bg_schema=='b10.png'){?> selected <?php } ?>>
										<?php _e('Black 10','cb-cosmetico'); ?>
									</option>
									<option value="b11.png"
									<?php if($stripes_bg_schema=='b11.png'){?> selected <?php } ?>>
										<?php _e('Black 11','cb-cosmetico'); ?>
									</option>
									<option value="b12.png"
									<?php if($stripes_bg_schema=='b12.png'){?> selected <?php } ?>>
										<?php _e('Black 12','cb-cosmetico'); ?>
									</option>
									<option value="b13.png"
									<?php if($stripes_bg_schema=='b13.png'){?> selected <?php } ?>>
										<?php _e('Black 13','cb-cosmetico'); ?>
									</option>
									<option value="b14.png"
									<?php if($stripes_bg_schema=='b14.png'){?> selected <?php } ?>>
										<?php _e('Black 14','cb-cosmetico'); ?>
									</option>
									<option value="b15.png"
									<?php if($stripes_bg_schema=='b15.png'){?> selected <?php } ?>>
										<?php _e('Black 15','cb-cosmetico'); ?>
									</option>
									<option value="b16.png"
									<?php if($stripes_bg_schema=='b16.png'){?> selected <?php } ?>>
										<?php _e('Black 16','cb-cosmetico'); ?>
									</option>
									<option value="b17.png"
									<?php if($stripes_bg_schema=='b17.png'){?> selected <?php } ?>>
										<?php _e('Black 17','cb-cosmetico'); ?>
									</option>
									<option value="b18.png"
									<?php if($stripes_bg_schema=='b18.png'){?> selected <?php } ?>>
										<?php _e('Black 18','cb-cosmetico'); ?>
									</option>
									<option value="b19.png"
									<?php if($stripes_bg_schema=='b19.png'){?> selected <?php } ?>>
										<?php _e('Black 19','cb-cosmetico'); ?>
									</option>

								</select>
							</div>
							<style>
.bg_o,.bg_a {
	cursor: pointer;
	width: 58px;
	height: 40px;
	margin: 0;
	padding: 0;
	float: left;
}

.bg_o {
	border: 2px solid #f8f8f8;
}

.bg_a {
	border: 2px solid #333;
}

.round {
	border-radius: 3px;
	webkit-border-radius: 3px;
	-moz-border-radius: 3px;
}
</style>

							<div class="pd5">
								<label for="upload_bg"><?php _e('Your own background upload','cb-cosmetico'); ?>
								</label> <input id="upload_bg" type="text" size="36"
									name="upload_bg" class="upurl input-upload"
									value="<?php echo $upload_bg; ?>" /><input
									style="cursor: pointer;" class="upload_button2" type="button"
									value="Upload Bg" /><br /> <br />
									<?php _e('Enter an URL or upload background image. This setting overrides predefined backgrounds.','cb-cosmetico'); ?>
									<?php if($upload_bg!='') {
										require_once(get_template_directory().'/BFI_Thumb.php');
										echo '</br></br><div>Current bg:  <a href="'.$upload_bg.'" target="_blank"><img src="'.bfi_thumb($upload_bg, array('width' => 145, 'height'=>70, 'crop' => true)).'" align="absmiddle" alt="logo" class="round" style="width:145px!important;height:70px!important;"/></a></div></br>';
									} ?></div>
									<?php if($upload_bg!='') { ?>
							<div class="pd5" style="border-top: 0;">
								<label for="remove_bg"><?php _e('Remove background image','cb-cosmetico'); ?>?</label>
								<select name="remove_bg" id="remove_bg"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes">
									<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>
							<?php
									} ?>

							<div class="pd5">
								<label for="bg_fixed"><?php _e('Fixed position background','cb-cosmetico'); ?>?</label>
								<select name="bg_fixed" id="bg_fixed"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($bg_fixed=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="bg_str"><?php _e('Stretch background width','cb-cosmetico'); ?>?</label>
								<select name="bg_str" id="bg_str"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($bg_str=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>
							
							<div class="pd5">
								<label for="fade_style"><?php _e('Fade effect for blog/images','cb-cosmetico'); ?></label>
								<select name="fade_style" id="fade_style"><option value="border">
								<?php _e('border','cb-cosmetico'); ?>
									</option>
									<option value="rift" <?php if($fade_style=='rift'){?> selected
									<?php } ?>>
										<?php _e('slice','cb-cosmetico'); ?>
									</option>
								</select>
							</div>
							

							<div class="pd5" style="display: none !important;">
								<label for="o_head"><?php _e('Header bg visibilty','cb-cosmetico'); ?>
								</label> <select name="o_head" id="o_head">
									<option value="visible">
									<?php _e('visible','cb-cosmetico'); ?>
									</option>
									<option value="half" <?php if($o_head=='half'){?> selected
									<?php } ?>>
										<?php _e('half visible','cb-cosmetico'); ?>
									</option>
									<option value="not" <?php if($o_head=='not'){?> selected
									<?php } ?>>
										<?php _e('not visible','cb-cosmetico'); ?>
									</option>
								</select>
								<?php _e('Background visibilty','cb-cosmetico'); ?>
								.
							</div>


							<div class="pd5" style="display: none !important;">
								<label for="o_con"><?php _e('Content bg visibilty','cb-cosmetico'); ?>
								</label> <select name="o_con" id="o_con">
									<option value="visible">
									<?php _e('visible','cb-cosmetico'); ?>
									</option>
									<option value="half" <?php if($o_con=='half'){?> selected
									<?php } ?>>
										<?php _e('half visible','cb-cosmetico'); ?>
									</option>
									<option value="not" <?php if($o_con=='not'){?> selected
									<?php } ?>>
										<?php _e('not visible','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5" style="display: none !important;">
								<label for="o_mid"><?php _e('Middle widget bg visibilty','cb-cosmetico'); ?>
								</label> <select name="o_mid" id="o_mid">
									<option value="visible">
									<?php _e('visible','cb-cosmetico'); ?>
									</option>
									<option value="half" <?php if($o_mid=='half'){?> selected
									<?php } ?>>
										<?php _e('half visible','cb-cosmetico'); ?>
									</option>
									<option value="not" <?php if($o_mid=='not'){?> selected
									<?php } ?>>
										<?php _e('not visible','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5" style="display: none !important;">
								<label for="o_foot"><?php _e('Footer bg visibilty','cb-cosmetico'); ?>
								</label> <select name="o_foot" id="o_foot">
									<option value="visible">
									<?php _e('visible','cb-cosmetico'); ?>
									</option>
									<option value="half" <?php if($o_foot=='half'){?> selected
									<?php } ?>>
										<?php _e('half visible','cb-cosmetico'); ?>
									</option>
									<option value="not" <?php if($o_foot=='not'){?> selected
									<?php } ?>>
										<?php _e('not visible','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5" style="display: none;">
								<label for="bors"><?php _e('Show borders','cb-cosmetico'); ?>?</label>
								<select name="bors" id="bors">
									<option value="yes">
									<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($bors=='no'){?> selected <?php } ?>>
									<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5" style="display: none;">
								<label for="bors_h"><?php _e('Show header bottom border','cb-cosmetico'); ?>?</label>
								<select name="bors_h" id="bors_h">
									<option value="yes">
									<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($bors_h=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5" style="display: none;">
								<label for="bors_f"><?php _e('Show footer top border','cb-cosmetico'); ?>?</label>
								<select name="bors_f" id="bors_f">
									<option value="yes">
									<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($bors_f=='no'){?> selected
									<?php } ?>>
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select>
							</div>


							<div class="pd5">
								<label for="font_family"><?php _e('Font Family','cb-cosmetico'); ?>
								</label> <select name="font_family" id="font_family">
									<option value="Arial" <?php if($font_family=='Arial'){?>
										selected <?php } ?>>Arial</option>
									<option value="Tahoma" <?php if($font_family=='Tahoma<'){?>
										selected <?php } ?>>Tahoma</option>
									<option value="Verdana" <?php if($font_family=='Verdana'){?>
										selected <?php } ?>>Verdana</option>
									<option value="Trebuchet Ms"
									<?php if($font_family=='Trebuchet Ms'){?> selected <?php } ?>>Trebuchet
										Ms</option>
									<option value="Times New Roman"
									<?php if($font_family=='Times New Roman'){?> selected
									<?php } ?>>Times New Roman</option>
									<option value="Georgia" <?php if($font_family=='Georgia'){?>
										selected <?php } ?>>Georgia</option>
								</select>
							</div>

							<div class="pd5">
								<label for="font_family_google"><?php _e('Font Family Google','cb-cosmetico'); ?>
								</label> <select name="font_family_google"
									id="font_family_google">
									<?php for ($i=0;$i<sizeof($google_font);$i++){
										if($font_family_google==$google_font[$i]) $ffg=' selected'; else $ffg='';
										echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
									} ?>
								</select> (
								<?php _e('Optional','cb-cosmetico'); ?>
								<a href="http://www.google.com/webfonts" target="_blank"><?php _e('fonts from Google','cb-cosmetico'); ?>
								</a>)<br />
								<br />
								<?php _e('Google font will override general font','cb-cosmetico'); ?>
								.
							</div>


							<div class="pd5">
								<label for="headings_up"><?php _e('Headings Transform','cb-cosmetico'); ?>
								</label> <select name="headings_up" id="headings_up">
									<option value="normal" <?php if($headings_up=='uppercase'){?>
										selected <?php } ?>>normal</option>
									<option value="uppercase"
									<?php if($headings_up=='uppercase'){?> selected <?php } ?>>uppercase</option>
								</select>
							</div>

							<div class="pd5">
								<label for="headings_upw"><?php _e('Headings Font Weight','cb-cosmetico'); ?>
								</label> <select name="headings_upw" id="headings_upw">
									<option value="300" <?php if($headings_upw=='300'){?> selected
									<?php } ?>>light</option>
									<option value="normal" <?php if($headings_upw=='normal'){?>
										selected <?php } ?>>normal</option>
									<option value="bold" <?php if($headings_upw=='bold'){?>
										selected <?php } ?>>semi-bold</option>
									<option value="bolder" <?php if($headings_upw=='bolder'){?>
										selected <?php } ?>>bold</option>
								</select>
							</div>

							<div class="pd5">
								<label for="headings_upw_t"><?php _e('Title Headings Font Weight','cb-cosmetico'); ?>
								</label> <select name="headings_upw_t" id="headings_upw_t">
									<option value="300" <?php if($headings_upw_t=='300'){?>
										selected <?php } ?>>light</option>
									<option value="normal" <?php if($headings_upw_t=='normal'){?>
										selected <?php } ?>>normal</option>
									<option value="bold" <?php if($headings_upw_t=='bold'){?>
										selected <?php } ?>>semi-bold</option>
									<option value="bolder" <?php if($headings_upw_t=='bolder'){?>
										selected <?php } ?>>bold</option>
								</select>
							</div>

							<div class="pd5">
								<label for="font_family_head"><?php _e('Headings Font Family','cb-cosmetico'); ?>
								</label> <select name="font_family_head" id="font_family_head">
									<option value="Arial" <?php if($font_family_head=='Arial'){?>
										selected <?php } ?>>Arial</option>
									<option value="Tahoma" <?php if($font_family_head=='Tahoma'){?>
										selected <?php } ?>>Tahoma</option>
									<option value="Verdana"
									<?php if($font_family_head=='Verdana'){?> selected <?php } ?>>Verdana</option>
									<option value="Trebuchet Ms"
									<?php if($font_family_head=='Trebuchet Ms'){?> selected
									<?php } ?>>Trebuchet Ms</option>
									<option value="Times New Roman"
									<?php if($font_family_head=='Times New Roman'){?> selected
									<?php } ?>>Times New Roman</option>
									<option value="Georgia"
									<?php if($font_family_head=='Georgia'){?> selected <?php } ?>>Georgia</option>
								</select>
							</div>

							<div class="pd5">
								<label for="font_family_google_head"><?php _e('Headings Font Family Google','cb-cosmetico'); ?>
								</label> <select name="font_family_google_head"
									id="font_family_google_head">
									<?php for ($i=0;$i<sizeof($google_font);$i++){
										if($font_family_google_head==$google_font[$i]) $ffg=' selected'; else $ffg='';
										echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
									} ?>
								</select> (
								<?php _e('Optional','cb-cosmetico'); ?>
								<a href="http://www.google.com/webfonts" target="_blank"><?php _e('fonts from Google','cb-cosmetico'); ?>
								</a>)<br />
								<br />
								<?php _e('Google font will override general font','cb-cosmetico'); ?>
								.
							</div>


							<div class="pd5">
								<label for="font_family_google_head_title"><?php _e('Title Heading Font Family - Google','cb-cosmetico'); ?>
								</label> <select name="font_family_google_head_title"
									id="font_family_google_head_title">
									<?php for ($i=0;$i<sizeof($google_font);$i++){
										if($font_family_google_head_title==$google_font[$i]) $ffg=' selected'; else $ffg='';
										echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
									} ?>
								</select> (
								<?php _e('Optional','cb-cosmetico'); ?>
								<a href="http://www.google.com/webfonts" target="_blank"><?php _e('fonts from Google','cb-cosmetico'); ?>
								</a>)<br />
								<br />
								<?php _e('Google font will override general font','cb-cosmetico'); ?>
								.
							</div>
							<div class="pd5">
								<label for="font_family_google_head_title2"><?php _e('Title 2 Heading Font Family Google','cb-cosmetico'); ?>
								</label> <select name="font_family_google_head_title2"
									id="font_family_google_head_title2">
									<?php for ($i=0;$i<sizeof($google_font);$i++){
										if($font_family_google_head_title2==$google_font[$i]) $ffg=' selected'; else $ffg='';
										echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
									} ?>
								</select> (
								<?php _e('Optional','cb-cosmetico'); ?>
								<a href="http://www.google.com/webfonts" target="_blank"><?php _e('fonts from Google','cb-cosmetico'); ?>
								</a>)<br />
								<br />
								<?php _e('Google font will override general font','cb-cosmetico'); ?>
								.
							</div>


							<div class="pd5">
								<label for="bodyfs"><?php _e('Body font size','cb-cosmetico'); ?>
								</label> <input type="text" name="bodyfs" id="bodyfs"
									value="<?php echo $bodyfs;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="h1fs"><?php _e('Heading 1 font size','cb-cosmetico'); ?>
								</label> <input type="text" name="h1fs" id="h1fs"
									value="<?php echo $h1fs;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="h1fts"><?php _e('Title Heading font size','cb-cosmetico'); ?>
								</label> <input type="text" name="h1fts" id="h1fts"
									value="<?php echo $h1fts;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="h2fs"><?php _e('Heading 2 font size','cb-cosmetico'); ?>
								</label> <input type="text" name="h2fs" id="h2fs"
									value="<?php echo $h2fs;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="h3fs"><?php _e('Heading 3 font size','cb-cosmetico'); ?>
								</label> <input type="text" name="h3fs" id="h3fs"
									value="<?php echo $h3fs;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="h4fs"><?php _e('Heading 4 font size','cb-cosmetico'); ?>
								</label> <input type="text" name="h4fs" id="h4fs"
									value="<?php echo $h4fs;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="h5fs"><?php _e('Heading 5 font size','cb-cosmetico'); ?>
								</label> <input type="text" name="h5fs" id="h5fs"
									value="<?php echo $h5fs;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="h6fs"><?php _e('Heading 6 font size','cb-cosmetico'); ?>
								</label> <input type="text" name="h6fs" id="h6fs"
									value="<?php echo $h6fs;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="headh"><?php _e('Title Heading bottom margin','cb-cosmetico'); ?>
								</label> <input type="text" name="headh" id="headh"
									value="<?php echo $headh;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<div class="pd5">
								<label for="headhc"><?php _e('Title Headings, slash, icon color','cb-cosmetico'); ?>
								</label> <input type="text" name="headhc" id="headhc"
									class="color" value="<?php echo $headhc;?>" />
							</div>


							<div class="pd5">
								<label for="menu_f"><?php _e('Menu Font Family - Google','cb-cosmetico'); ?>
								</label> <select name="menu_f" id="menu_f">
								<?php for ($i=0;$i<sizeof($google_font);$i++){
									if($menu_f==$google_font[$i]) $ffg=' selected'; else $ffg='';
									echo '<option value="'.$google_font[$i].'" '.$ffg.'>'.$google_font[$i].'</option>';
								} ?>
								</select>
							</div>

							<div class="pd5">
								<label for="menu_font_size"><?php _e('Menu font size','cb-cosmetico'); ?>
								</label> <input type="text" name="menu_font_size"
									id="menu_font_size" value="<?php echo $menu_font_size;?>" />
									<?php _e('only numbers and px like 12px','cb-cosmetico'); ?>
							</div>
							<h4>
							<?php _e('Custom Colors','cb-cosmetico'); ?>
								-
								<?php _e('This settings will override general color schema','cb-cosmetico'); ?>
								.
							</h4>


							<div class="pd5">
								<label for="color_master"><?php _e('Accent and Master color','cb-cosmetico'); ?>
								</label> <input type="text" name="color_master"
									id="color_master" value="<?php echo $color_master;?>"
									class="color" />
									<?php _e('This setting will work like color styles.','cb-cosmetico'); ?>
							</div>

							<div class="pd5">
								<label for="menu_color"><?php _e('Menu font color','cb-cosmetico'); ?>
								</label> <input type="text" name="menu_color" id="menu_color"
									value="<?php echo $menu_color;?>" class="color" />
							</div>

							<div class="pd5">
								<label for="shad"><?php _e('Borders color','cb-cosmetico'); ?>
								</label> <input type="text" name="shad" id="shad"
									value="<?php echo $shad;?>" class="color" />
							</div>

							<div class="pd5">
								<label for="shad2"><?php _e('Fixed width Shadow','cb-cosmetico'); ?>
								</label> <input type="text" name="shad2" id="shad2"
									value="<?php echo $shad2;?>" class="color" />
							</div>

							<div class="pd5">
								<label for="ht_background"><?php _e('Header background color','cb-cosmetico'); ?>
								</label> <input type="text" name="ht_background"
									id="ht_background" value="<?php echo $ht_background;?>"
									class="color" />
							</div>

							<div class="pd5">
								<label for="htb_background"><?php _e('Below Header background color','cb-cosmetico'); ?>
								</label> <input type="text" name="htb_background"
									id="htb_background" value="<?php echo $htb_background;?>"
									class="color" />
							</div>

							<div class="pd5">
								<label for="middle_background"><?php _e('Middle area background color','cb-cosmetico'); ?>
								</label> <input type="text" name="middle_background"
									id="middle_background" value="<?php echo $middle_background;?>"
									class="color" />
							</div>

							<div class="pd5">
								<label for="middle_backgroundc"><?php _e('Below middle area background color','cb-cosmetico'); ?>
								</label> <input type="text" name="middle_backgroundc"
									id="middle_backgroundc"
									value="<?php echo $middle_backgroundc;?>" class="color" />
							</div>

							<div class="pd5">
								<label for="middle_backgroundi"><?php _e('Below middle area background image','cb-cosmetico'); ?>
								</label> <input id="middle_backgroundi" type="text" size="36"
									name="middle_backgroundi" class="upurl input-upload"
									value="<?php echo $middle_backgroundi; ?>" /><input
									style="cursor: pointer;" class="upload_button2" type="button"
									value="Upload Image" /><br />
								<br />
								<?php _e('Enter an URL or upload background image.','cb-cosmetico'); ?>
								<?php if($middle_backgroundi!='') {
									require_once(get_template_directory().'/BFI_Thumb.php');
									echo '</br></br><div>Current bg:  <a href="'.$middle_backgroundi.'" target="_blank"><img src="'.bfi_thumb($middle_backgroundi, array('width' => 145, 'height'=>70, 'crop' => true)).'" align="absmiddle" alt="logo" class="round" style="width:145px!important;height:70px!important;"/></a></div></br>';
								} ?></div>
								<?php if($middle_backgroundi!='') { ?>
							<div class="pd5">
								<label for="remove_bgi"><?php _e('Remove background image','cb-cosmetico'); ?>?</label>
								<select name="remove_bgi" id="remove_bgi"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes">
									<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>
							<?php
} ?>

<div class="pd5"><label for="bgf_str"><?php _e('Stretch below middle background width','cb-cosmetico'); ?>?</label>
<select name="bgf_str" id="bgf_str"><option value="no"><?php _e('no','cb-cosmetico'); ?></option><option value="yes" <?php if($bgf_str=='yes') echo 'selected';?>><?php _e('yes','cb-cosmetico'); ?></option></select></div>

<div class="pd5"><label for="footer_background"><?php _e('Footer background color','cb-cosmetico'); ?></label>
<input type="text" name="footer_background" id="footer_background" class="color" value="<?php echo $footer_background;?>"/></div>

<div class="pd5"><label for="background_color"><?php _e('Background color','cb-cosmetico'); ?></label>
<input type="text" name="background_color" id="background_color" value="<?php echo $background_color;?>" class="color"/></div>

<div class="pd5"><label for="logo_color"><?php _e('Logo color','cb-cosmetico'); ?></label>
<input type="text" name="logo_color" id="logo_color" value="<?php echo $logo_color;?>" class="color"/></div>

<div class="pd5"><label for="logo_shad"><?php _e('Logo shadow color','cb-cosmetico'); ?></label>
<input type="text" name="logo_shad" id="logo_shad" value="<?php echo $logo_shad;?>" class="color"/></div>

<div class="pd5" style="display:none;"><label for="slogan_color"><?php _e('Slogan color','cb-cosmetico'); ?></label>
<input type="text" name="slogan_color" id="slogan_color" value="<?php echo $slogan_color;?>" class="color"/></div>

<div class="pd5"><label for="text_color"><?php _e('Text color','cb-cosmetico'); ?></label>
<input type="text" name="text_color" id="text_color" value="<?php echo $text_color;?>" class="color"/></div>

<div class="pd5"><label for="mwh"><?php _e('Middlebar Widget Headings color','cb-cosmetico'); ?></label>
<input type="text" name="mwh" id="mwh" value="<?php echo $mwh;?>" class="color"/></div>

<div class="pd5"><label for="mw"><?php _e('Middlebar Widget text color','cb-cosmetico'); ?></label>
<input type="text" name="mw" id="mw" value="<?php echo $mw;?>" class="color"/></div>

<div class="pd5"><label for="headings_color"><?php _e('Headings color','cb-cosmetico'); ?></label>
<input type="text" name="headings_color" id="headings_color" value="<?php echo $headings_color;?>" class="color"/></div>

<div class="pd5"><label for="links_color"><?php _e('Links color','cb-cosmetico'); ?></label>
<input type="text" name="links_color" id="links_color" value="<?php echo $links_color;?>" class="color"/></div>

<div class="pd5"><label for="links_hover_color"><?php _e('Links hover color','cb-cosmetico'); ?></label>
<input type="text" name="links_hover_color" id="links_hover_color" value="<?php echo $links_hover_color;?>" class="color"/></div>

<div class="pd5"><label for="pfilter_color"><?php _e('Portfolio Filter links color','cb-cosmetico'); ?></label>
<input type="text" name="pfilter_color" id="pfilter_color" value="<?php echo $pfilter_color;?>" class="color"/></div>

<div class="pd5"><label for="pfilter_bgcolor"><?php _e('Portfolio Filter background color','cb-cosmetico'); ?></label>
<input type="text" name="pfilter_bgcolor" id="pfilter_bgcolor" value="<?php echo $pfilter_bgcolor;?>" class="color"/></div>

<div class="pd5"><label for="add_css"><?php _e('Additional CSS','cb-cosmetico'); ?></label>
<textarea name="add_css" id="add_css" style="width:300px;height:100px;"><?php echo $add_css; ?></textarea></div>


</div>
						<!--## STYLES SECTION END ##-->




						<!-- SLIDER SECTION START-->
						<div class="slider">

							<div class="pd5" style="border-top: none;">
								<label for="slide_type"><?php _e('Slider Type','cb-cosmetico'); ?>
								</label> <select name="slide_type" id="slide_type">
									<option value="revo">
									<?php _e('Revolution Slider','cb-cosmetico'); ?>
									</option>
									<option value="any" <?php if($slide_type=='any'){?> selected
									<?php } ?>>
										<?php _e('Anything Slider','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="slide_home"><?php _e('Show Slider','cb-cosmetico'); ?>
								</label> <select name="slide_home" id="slide_home"><option
										value="home">
										<?php _e('only in homepage','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($slide_home=='yes'){?> selected
									<?php } ?>>
										<?php _e('everywhere','cb-cosmetico'); ?>
									</option>
									<option value="no" <?php if($slide_home=='no'){?> selected
									<?php } ?>>
										<?php _e('disable slider','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<style>
.hide_slider {
	display: none;
}
</style>
							<script>
 var ht="";
    jQuery("select#slide_type").change(function () {
          jQuery("select#slide_type option:selected").each(function () {
                ht=jQuery(this).val();
              });
          jQuery(".hide_slider").hide();
          jQuery("."+ht).show();
        })
        .change();

jQuery(document).ready(function(){
var htt="<?php echo $slide_type;?>";
jQuery("."+htt).show();
});

</script>
<?php /*REVOLUTION SLIDER*/?>
							<div class="revo hide_slider">
							<?php if ( in_array('revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {?>
								<div class="pd5">
									<label><?php _e('Slider Name','cb-cosmetico'); ?> </label> <select
										name="rev_slider_name">
										<?php  $slider = new RevSlider();
										$arrSliders = $slider->getArrSliders();
										foreach($arrSliders as $slider):
										$stitle = $slider->getTitle();
										$salias=$slider->getAlias();
										if($rev_slider_name==$salias) $curest=' selected '; else $curest='';
										echo '<option value='.$salias.' '.$curest.'>'.$stitle.'</option>';
										endforeach;
										?>
									</select>
								</div>
								<?php } ?>

								<br />
								<?php _e('You can configure Revolution Slider by','cb-cosmetico');?>
								<b> <a href="admin.php?page=revslider">clicking here</a> </b><br />

							</div>
							<?php /*REVOLUTION SLIDER END*/?>


							<?php /*ANYTHING SLIDER*/ $tttra=''; ?>
							<div class="any hide_slider">
								<div class="pd5">
									<label for="s_text"><?php _e('Show post content above image','cb-cosmetico'); ?>?</label>
									<select name="s_text" id="s_text"><option value="no">
									<?php _e('no','cb-cosmetico'); ?>
										</option>
										<option value="yes" <?php if($s_text=='yes'){?> selected
										<?php } ?>>
											<?php _e('yes','cb-cosmetico'); ?>
										</option>
									</select>
								</div>

								<div class="pd5">
									<label><?php _e('Select Category for slider','cb-cosmetico'); ?>
									</label>
									<?php wp_dropdown_categories('show_count=1&hierarchical=1&hide_empty=0&selected='.$cat); ?>
								</div>

								<h4>
								<?php _e('Optional Settings','cb-cosmetico'); ?>
								</h4>

								<div class="pd5">
									<label for="s_height"><?php _e('Slider Custom Height','cb-cosmetico'); ?>
									</label> <input type="text" name="s_height"
										value="<?php echo $s_height; ?>" /> (
										<?php _e('only numbers and px like 200px','cb-cosmetico'); ?>
									)
								</div>

								<div class="pd5">
									<label for="s_link"><?php _e('Link slides to posts','cb-cosmetico'); ?>?</label>
									<select name="s_link" id="s_link"><option value="yes">
									<?php _e('yes','cb-cosmetico'); ?>
										</option>
										<option value="no" <?php if($s_link=='no'){?> selected
										<?php } ?>>
											<?php _e('no','cb-cosmetico'); ?>
										</option>
									</select>
								</div>

								<div class="pd5">
									<label for="s_resize"><?php _e('Resize Contents','cb-cosmetico'); ?>?</label>
									<select name="s_resize" id="s_resize"><option value="true">
									<?php _e('true','cb-cosmetico'); ?>
										</option>
										<option value="false" <?php if($s_resize=='false'){?> selected
										<?php } ?>>
											<?php _e('false','cb-cosmetico'); ?>
										</option>
									</select>
								</div>

								<div class="pd5">
									<label for="s_auto"><?php _e('Autoplay','cb-cosmetico'); ?> </label>
									<select name="s_auto" id="s_auto"><option value="true">
									<?php _e('true','cb-cosmetico'); ?>
										</option>
										<option value="false" <?php if($s_auto=='false'){?> selected
										<?php } ?>>
											<?php _e('false','cb-cosmetico'); ?>
										</option>
									</select>
								</div>

								<div class="pd5">
									<label for="s_delay"><?php _e('Delay in ms','cb-cosmetico'); ?>
									</label> <input type="text" name="s_delay" id="s_delay"
										value="<?php echo $s_delay;?>" />
								</div>

								<div class="pd5">
									<label for="s_ani_time"><?php _e('Animation time','cb-cosmetico'); ?>
									</label> <input type="text" name="s_ani_time" id="s_ani_time"
										value="<?php echo $s_ani_time;?>" />
								</div>

								<div class="pd5">
									<label for="s_easing"><?php _e('Easing Effect','cb-cosmetico'); ?>
									</label> <select name="s_easing" id="s_easing"><option
											value="swing">swing</option>
										<option value="linear" <?php if($s_easing=='linear'){?>
											selected <?php } ?>>linear</option>
										<option value="easeInQuad"
										<?php if($s_easing=='easeInQuad'){?> selected <?php } ?>>InQuad</option>
										<option value="easeOutQuad"
										<?php if($s_easing=='easeOutQuad'){?> selected <?php } ?>>OutQuad</option>
										<option value="easeInOutQuad"
										<?php if($s_easing=='easeInOutQuad'){?> selected <?php } ?>>InOutQuad</option>
										<option value="easeInCubic"
										<?php if($s_easing=='easeInCubic'){?> selected <?php } ?>>InCubic</option>
										<option value="easeOutCubic"
										<?php if($s_easing=='easeOutCubic'){?> selected <?php } ?>>OutCubic</option>
										<option value="easeInOutCubic"
										<?php if($s_easing=='easeInOutCubic'){?> selected <?php } ?>>InOutCubic</option>
										<option value="easeInQuart"
										<?php if($s_easing=='easeInQuart'){?> selected <?php } ?>>InQuart</option>
										<option value="easeOutQuart"
										<?php if($s_easing=='easeOutQuart'){?> selected <?php } ?>>OutQuart</option>
										<option value="easeInOutQuart"
										<?php if($s_easing=='easeInOutQuart'){?> selected <?php } ?>>InOutQuart</option>
										<option value="easeInSine"
										<?php if($s_easing=='easeInSine'){?> selected <?php } ?>>InSine</option>
										<option value="easeOutSine"
										<?php if($s_easing=='easeOutSine'){?> selected <?php } ?>>OutSine</option>
										<option value="easeInOutSine"
										<?php if($s_easing=='easeInOutSine'){?> selected <?php } ?>>InOutSine</option>
										<option value="easeInExpo"
										<?php if($s_easing=='easeInExpo'){?> selected <?php } ?>>InExpo</option>
										<option value="easeOutExpo"
										<?php if($s_easing=='easeOutExpo'){?> selected <?php } ?>>OutExpo</option>
										<option value="easeInOutExpo"
										<?php if($s_easing=='easeInOutExpo'){?> selected <?php } ?>>InOutExpo</option>
										<option value="easeInQuint"
										<?php if($s_easing=='easeInQuint'){?> selected <?php } ?>>InQuint</option>
										<option value="easeOutQuint"
										<?php if($s_easing=='easeOutQuint'){?> selected <?php } ?>>OutQuint</option>
										<option value="easeInOutQuint"
										<?php if($s_easing=='easeInOutQuint'){?> selected <?php } ?>>InOutQuint</option>
										<option value="easeInCirc"
										<?php if($s_easing=='easeInCirc'){?> selected <?php } ?>>InCirc</option>
										<option value="easeOutCirc"
										<?php if($s_easing=='easeOutCirc'){?> selected <?php } ?>>OutCirc</option>
										<option value="easeInOutCirc"
										<?php if($s_easing=='easeInOutCirc'){?> selected <?php } ?>>InOutCirc</option>
										<option value="easeInElastic"
										<?php if($s_easing=='easeInElastic'){?> selected <?php } ?>>InElastic</option>
										<option value="easeOutElastic"
										<?php if($s_easing=='easeOutElastic'){?> selected <?php } ?>>OutElastic</option>
										<option value="easeInOutElastic"
										<?php if($s_easing=='easeInOutElastic'){?> selected
										<?php } ?>>InOutElastic</option>
										<option value="easeInBack"
										<?php if($s_easing=='easeInBack'){?> selected <?php } ?>>InBack</option>
										<option value="easeOutBack"
										<?php if($s_easing=='easeOutBack'){?> selected <?php } ?>>OutBack</option>
										<option value="easeInOutBack"
										<?php if($s_easing=='easeInOutBack'){?> selected <?php } ?>>InOutBack</option>
										<option value="easeInBounce"
										<?php if($s_easing=='easeInBounce'){?> selected <?php } ?>>InBounce</option>
										<option value="easeOutBounce"
										<?php if($s_easing=='easeOutBounce'){?> selected <?php } ?>>OutBounce</option>
										<option value="easeInOutBounce"
										<?php if($s_easing=='easeInOutBounce'){?> selected <?php } ?>>InOutBounce</option>
									</select>
								</div>

							</div>
							<?php /*ANYTHING SLIDER END*/?>





						</div>
						<!--## SLIDER SECTION END ##-->



						<!-- FULLSCREEN SLIDER SECTION START ##-->
						<div class="slider2">

							<div class="pd5" style="border-top: none;">
								<label for="full_slider"><?php _e('Show Fullscreen Slider','cb-cosmetico'); ?>?</label>
								<select name="full_slider" id="full_slider"><option value="no">
								<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($full_slider=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="full_slider_where"><?php _e('Show Slider on','cb-cosmetico'); ?>:</label>
								<select name="full_slider_where" id="full_slider_where"><option
										value="home">
										<?php _e('only in homepage','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($full_slider_where=='yes'){?>
										selected <?php } ?>>
										<?php _e('everywhere','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="full_slider_style"><?php _e('Show controls','cb-cosmetico'); ?>:</label>
								<select name="full_slider_style" id="full_slider_style"><option
										value="0">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="1" <?php if($full_slider_style=='1'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="full_slider_bar"><?php _e('Show Progress Bar','cb-cosmetico'); ?>:</label>
								<select name="full_slider_bar" id="full_slider_bar"><option
										value="0">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="1" <?php if($full_slider_bar=='1'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="full_slider_thumbs"><?php _e('Show Thumbnails','cb-cosmetico'); ?>:</label>
								<select name="full_slider_thumbs" id="full_slider_thumbs"><option
										value="0">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="1" <?php if($full_slider_thumbs=='1'){?>
										selected <?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="full_slider_nav"><?php _e('Show Prev/Next Buttons','cb-cosmetico'); ?>:</label>
								<select name="full_slider_nav" id="full_slider_nav"><option
										value="0">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="1" <?php if($full_slider_nav=='1'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="full_slider_interval"><?php _e('Slides Interval','cb-cosmetico'); ?>
								</label> <input type="text" name="full_slider_interval"
									id="full_slider_interval"
									value="<?php echo $full_slider_interval;?>" />
									<?php _e('in ms','cb-cosmetico'); ?>
							</div>

							<div class="pd5" style="border-top: none;">
								<label for="full_slider_effect"><?php _e('Slider Effect','cb-cosmetico'); ?>
								</label> <select name="full_slider_effect"
									id="full_slider_effect">
									<option value="0">
									<?php _e('None','cb-cosmetico'); ?>
									</option>
									<option value="1" <?php if($full_slider_effect=='1'){?>
										selected <?php } ?>>
										<?php _e('Fade','cb-cosmetico'); ?>
									</option>
									<option value="2" <?php if($full_slider_effect=='2'){?>
										selected <?php } ?>>
										<?php _e('Slide Top','cb-cosmetico'); ?>
									</option>
									<option value="3" <?php if($full_slider_effect=='3'){?>
										selected <?php } ?>>
										<?php _e('Slide Right','cb-cosmetico'); ?>
									</option>
									<option value="4" <?php if($full_slider_effect=='4'){?>
										selected <?php } ?>>
										<?php _e('Slide Bottom','cb-cosmetico'); ?>
									</option>
									<option value="5" <?php if($full_slider_effect=='5'){?>
										selected <?php } ?>>
										<?php _e('Slide Left','cb-cosmetico'); ?>
									</option>
									<option value="6" <?php if($full_slider_effect=='6'){?>
										selected <?php } ?>>
										<?php _e('Carousel Right','cb-cosmetico'); ?>
									</option>
									<option value="7" <?php if($full_slider_effect=='7'){?>
										selected <?php } ?>>
										<?php _e('Carousel Left','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="full_slider_t_speed"><?php _e('Effect Speed','cb-cosmetico'); ?>
								</label> <input type="text" name="full_slider_t_speed"
									id="full_slider_t_speed"
									value="<?php echo $full_slider_t_speed;?>" />
									<?php _e('in ms','cb-cosmetico'); ?>
							</div>

							<div class="pd5">
								<label for="full_slider_page"><?php _e('Get images attached to this page:','cb-cosmetico'); ?>
								</label>
								<?php wp_dropdown_pages('selected='.$full_slider_page.'&name=full_slider_page');?>
							</div>

						</div>
						<!-- ## FULLSCREEN SLIDER SECTION END ##-->

						<!-- TOP ICON SECTION START ##-->
						<div class="top-icons">
							<style>
#sortable {
	list-style-type: none;
	margin: 0;
	padding: 0;
	width: 60%;
}

#sortable li {
	margin: 0 3px 3px 3px;
	padding: 0.4em;
	padding-left: 1.5em;
	font-size: 1.4em;
	border: 1px solid #ccc;
}

#sortable li a {
	text-decoration: none
}
</style>
							<script>
  jQuery(function() {
    jQuery( "#sortable" ).sortable();
  });
  </script>
							<div class="pd5" style="border-top: none;">
								<label for="font-size">Font size<br /> <input type="text"
									id="font-size"
									value="<?php if($headings_icons_size=='') echo '20'; else echo $headings_icons_size; ?>"
									name="headings_icons_size"> </label>
							</div>
							<div class="pd5" style="border-top: none;">
								<ul id="sortable" style="width: 100%;">
								<?php
								if( isset( $headings_icons ) && is_array( $headings_icons ) ) {
									for($i=0;$i<sizeof($headings_icons);$i++) {
										?>
										<?php if(!isset($headings_icons[$i]['color'])) $headings_icons[$i]['color']=''; ?>
									<li class="ui-state-default"><div class="icons-content">
											<a
												href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
												class="thickbox"
												onclick="load_icon('cb-sor-top-icon-<?php echo ($i+1);?>');"><i id="cb-sor-top-icon-<?php echo ($i+1);?>" class="<?php echo $headings_icons[$i]['icon'];?>" style="font-size:<?php echo $headings_icons_size;?>px;color:<?php if($headings_icons[$i]['color']=='')echo ''; else echo $headings_icons[$i]['color'];?>;"><span
													style="color: #999; font-size: 10px; font-style: italic; cursor: pointer;"><?php if($headings_icons[$i]['icon']=='') echo 'set icon ';?>
												</span> </i> </a><input type="text" name="icons_name[]"
												value="<?php if($headings_icons[$i]['name']=='')echo 'set title'; else echo $headings_icons[$i]['name'];?>"
												style="font-size: 10px;"><input type="text"
												name="icons_link[]"
												value="<?php if($headings_icons[$i]['link']=='')echo 'set URL'; else echo $headings_icons[$i]['link'];?>"
												style="font-size: 10px;"><input type="hidden"
												name="icons_val[]"
												id="cb-sor-top-icon-<?php echo ($i+1);?>-val"
												value="<?php echo $headings_icons[$i]['icon'];?>"><input
												type="hidden" name="icons_color[]"
												id="cb-sor-top-icon-<?php echo ($i+1);?>-color"
												value="<?php if($headings_icons[$i]['color']=='')echo ''; else echo $headings_icons[$i]['color'];?>">
										</div></li>
										<?php
									}
								}else{
									?>
									<li class="ui-state-default"><div class="icons-content">
											<a
												href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
												class="thickbox" onclick="load_icon('cb-sor-top-icon-1');"><i
												id="cb-sor-top-icon-1"><span
													style="color: #999; font-size: 10px; font-style: italic; cursor: pointer;">set
														icon</span> </i> </a><input type="text"
												name="icons_name[]"><input type="text" name="icons_link[]"><input
												type="hidden" name="icons_val[]" id="cb-sor-top-icon-1-val"><input
												type="hidden" name="icons_color[]"
												id="cb-sor-top-icon-1-color">
										</div></li>
										<?php } ?>
								</ul>
								<span class="button" onclick="add_item();">Add item</span> <span
									class="button" onclick="remove_last();">Remove last</span> <input
									type="hidden" id="selected-id-builder">
							</div>


							<script type="text/javascript">
function load_icon(id) {
	if(typeof id !== 'undefined') {
	jQuery('#selected-id-builder').val(id);
	}else{
	jQuery('#selected-id-builder').val('');
	}
}
function remove_last() {
	jQuery("#sortable li:last").remove();
}
function add_item() {
var size = jQuery("#sortable li").size();
html='<li class="ui-state-default"><div class="icons-content"><a href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container" class="thickbox" onclick="load_icon(\'cb-sor-top-icon-'+(size+1)+'\');"><i id="cb-sor-top-icon-'+(size+1)+'"><span style="color:#999;font-size:10px;font-style:italic;cursor:pointer;">set icon </span></i></a> <input type="text" name="icons_name[]" value="set name" class="text" style="font-size:10px;"><input type="text" name="icons_link[]" value="set URL" class="text" style="font-size:10px;"><input type="hidden" name="icons_val[]" id="cb-sor-top-icon-'+(size+1)+'-val" ><input type="hidden" name="icons_color[]" id="cb-sor-top-icon-'+(size+1)+'-color" ></div></li>';
jQuery("#sortable").append(html);
}
jQuery(document).ready(function($) {
"use strict";
	jQuery('.newcolor').wpColorPicker();

	jQuery('.the-icons li').click(function() { 
	var sel_id = jQuery('#selected-id-builder').val();
	var style='';
	var data ='';
	var icon_class = jQuery(this).find('i').attr('class');
	var icon_color = jQuery('.wrap .pd5 .newcolor').val();
	if (sel_id===''){
	window.send_to_editor(data);
}
	else{
	jQuery('#'+sel_id+'-val').val(icon_class);
	jQuery('#'+sel_id).html('').attr('class',icon_class).attr('style',style);
	tb_remove();
}
	jQuery('#'+sel_id+'-color').val(icon_color);
	jQuery('#'+sel_id).css("color",icon_color);
	var size = jQuery('#font-size').val();
	jQuery('.icons-content > a > i').css("font-size",size+"px");
});
	
	
	function set_icon_size(){
	var size = jQuery('#font-size').val();
	jQuery('.icons-content > a > i').css("font-size",size+"px");
	
	}
	jQuery("#font-size" ).spinner({
	min: 1,
	numberFormat: "C",
	change: set_icon_size,
    stop: set_icon_size
    });
	

      jQuery("#sortable li").each(function(n) {
            jQuery(this).attr("id", "link" + n);
      });

 
});
</script>

							<div id="cb-icon-box-iframe-container" style="display: none;">

								<div class="wrap" style="padding: 1em">


									<div class="pd5" style="border-top: none;">
										<label for="color">Color<br /> <input id="color" type="text"
											value="#000" class="newcolor" autocomplete="off" style=""
											name="headings_icons_color"> </label>
									</div>

									<div class="container">


										<div id="new">
											<h2 class="page-header">New Icons in 3.1.1</h2>

											<style type="text/css">
.the-icons li {
	cursor: hand;
	cursor: pointer;
}

.span3 {
	width: 166px;
	float: left;
	margin-left: 20px;
}

.span12 {
	margin-left: 20px;
	float: left;
	width: 724px;
}
</style>

											<div class="row margin-top">
												<div class="span3">
													<ul class="the-icons">
														<li><i class="icon-expand-alt"></i> icon-expand-alt</li>
														<li><i class="icon-collapse-alt"></i> icon-collapse-alt</li>
														<li><i class="icon-smile"></i> icon-smile</li>
														<li><i class="icon-frown"></i> icon-frown</li>
														<li><i class="icon-meh"></i> icon-meh</li>
														<li><i class="icon-gamepad"></i> icon-gamepad</li>
														<li><i class="icon-keyboard"></i> icon-keyboard</li>
														<li><i class="icon-flag-alt"></i> icon-flag-alt</li>
														<li><i class="icon-flag-checkered"></i>
															icon-flag-checkered</li>
														<li><i class="icon-terminal"></i> icon-terminal</li>
														<li><i class="icon-code"></i> icon-code</li>
														<li><i class="icon-mail-forward"></i> icon-mail-forward <span
															class="muted">(alias)</span></li>
														<li><i class="icon-mail-reply"></i> icon-mail-reply <span
															class="muted">(alias)</span></li>
														<li><i class="icon-reply-all"></i> icon-reply-all</li>
														<li><i class="icon-mail-reply-all"></i>
															icon-mail-reply-all <span class="muted">(alias)</span></li>
													</ul>
												</div>
												<div class="span3">
													<ul class="the-icons">
														<li><i class="icon-star-half-empty"></i>
															icon-star-half-empty</li>
														<li><i class="icon-star-half-full"></i>
															icon-star-half-full <span class="muted">(alias)</span></li>
														<li><i class="icon-location-arrow"></i>
															icon-location-arrow</li>
														<li><i class="icon-rotate-left"></i> icon-rotate-left <span
															class="muted">(alias)</span></li>
														<li><i class="icon-rotate-right"></i> icon-rotate-right <span
															class="muted">(alias)</span></li>
														<li><i class="icon-crop"></i> icon-crop</li>
														<li><i class="icon-code-fork"></i> icon-code-fork</li>
														<li><i class="icon-unlink"></i> icon-unlink</li>
														<li><i class="icon-question"></i> icon-question</li>
														<li><i class="icon-info"></i> icon-info</li>
														<li><i class="icon-exclamation"></i> icon-exclamation</li>
														<li><i class="icon-superscript"></i> icon-superscript</li>
														<li><i class="icon-subscript"></i> icon-subscript</li>
														<li><i class="icon-eraser"></i> icon-eraser</li>
														<li><i class="icon-puzzle-piece"></i> icon-puzzle-piece</li>
													</ul>
												</div>
												<div class="span3">
													<ul class="the-icons">
														<li><i class="icon-microphone"></i> icon-microphone</li>
														<li><i class="icon-microphone-off"></i>
															icon-microphone-off</li>
														<li><i class="icon-shield"></i> icon-shield</li>
														<li><i class="icon-calendar-empty"></i>
															icon-calendar-empty</li>
														<li><i class="icon-fire-extinguisher"></i>
															icon-fire-extinguisher</li>
														<li><i class="icon-rocket"></i> icon-rocket</li>
														<li><i class="icon-maxcdn"></i> icon-maxcdn</li>
														<li><i class="icon-chevron-sign-left"></i>
															icon-chevron-sign-left</li>
														<li><i class="icon-chevron-sign-right"></i>
															icon-chevron-sign-right</li>
														<li><i class="icon-chevron-sign-up"></i>
															icon-chevron-sign-up</li>
														<li><i class="icon-chevron-sign-down"></i>
															icon-chevron-sign-down</li>
														<li><i class="icon-html5"></i> icon-html5</li>
														<li><i class="icon-css3"></i> icon-css3</li>
														<li><i class="icon-anchor"></i> icon-anchor</li>
														<li><i class="icon-unlock-alt"></i> icon-unlock-alt</li>
													</ul>
												</div>
												<div class="span3">
													<ul class="the-icons">
														<li><i class="icon-bullseye"></i> icon-bullseye</li>
														<li><i class="icon-ellipsis-horizontal"></i>
															icon-ellipsis-horizontal</li>
														<li><i class="icon-ellipsis-vertical"></i>
															icon-ellipsis-vertical</li>
														<li><i class="icon-rss-sign"></i> icon-rss-sign</li>
														<li><i class="icon-play-sign"></i> icon-play-sign</li>
														<li><i class="icon-ticket"></i> icon-ticket</li>
														<li><i class="icon-minus-sign-alt"></i>
															icon-minus-sign-alt</li>
														<li><i class="icon-check-minus"></i> icon-check-minus</li>
														<li><i class="icon-level-up"></i> icon-level-up</li>
														<li><i class="icon-level-down"></i> icon-level-down</li>
														<li><i class="icon-check-sign"></i> icon-check-sign</li>
														<li><i class="icon-edit-sign"></i> icon-edit-sign</li>
														<li><i class="icon-external-link-sign"></i>
															icon-external-link-sign</li>
														<li><i class="icon-share-sign"></i> icon-share-sign</li>
													</ul>
												</div>
											</div>
										</div>


										<section id="web-application" class="row">
										<div class="span12">
											<h2 class="page-header">Web Application Icons</h2>
										</div>

										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-adjust"></i> icon-adjust</li>
												<li><i class="icon-anchor"></i> icon-anchor</li>
												<li><i class="icon-asterisk"></i> icon-asterisk</li>
												<li><i class="icon-ban-circle"></i> icon-ban-circle</li>
												<li><i class="icon-bar-chart"></i> icon-bar-chart</li>
												<li><i class="icon-barcode"></i> icon-barcode</li>
												<li><i class="icon-beaker"></i> icon-beaker</li>
												<li><i class="icon-beer"></i> icon-beer</li>
												<li><i class="icon-bell-alt"></i> icon-bell-alt</li>
												<li><i class="icon-bell"></i> icon-bell</li>
												<li><i class="icon-bolt"></i> icon-bolt</li>
												<li><i class="icon-book"></i> icon-book</li>
												<li><i class="icon-bookmark-empty"></i> icon-bookmark-empty</li>
												<li><i class="icon-bookmark"></i> icon-bookmark</li>
												<li><i class="icon-briefcase"></i> icon-briefcase</li>
												<li><i class="icon-bullhorn"></i> icon-bullhorn</li>
												<li><i class="icon-bullseye"></i> icon-bullseye</li>
												<li><i class="icon-calendar-empty"></i> icon-calendar-empty</li>
												<li><i class="icon-calendar"></i> icon-calendar</li>
												<li><i class="icon-camera-retro"></i> icon-camera-retro</li>
												<li><i class="icon-camera"></i> icon-camera</li>
												<li><i class="icon-certificate"></i> icon-certificate</li>
												<li><i class="icon-check-empty"></i> icon-check-empty</li>
												<li><i class="icon-check-minus"></i> icon-check-minus</li>
												<li><i class="icon-check-sign"></i> icon-check-sign</li>
												<li><i class="icon-check"></i> icon-check</li>
												<li><i class="icon-circle-blank"></i> icon-circle-blank</li>
												<li><i class="icon-circle"></i> icon-circle</li>
												<li><i class="icon-cloud-download"></i> icon-cloud-download</li>
												<li><i class="icon-cloud-upload"></i> icon-cloud-upload</li>
												<li><i class="icon-cloud"></i> icon-cloud</li>
												<li><i class="icon-code-fork"></i> icon-code-fork</li>
												<li><i class="icon-code"></i> icon-code</li>
												<li><i class="icon-coffee"></i> icon-coffee</li>
												<li><i class="icon-cog"></i> icon-cog</li>
												<li><i class="icon-cogs"></i> icon-cogs</li>
												<li><i class="icon-collapse-alt"></i> icon-collapse-alt</li>
												<li><i class="icon-comment-alt"></i> icon-comment-alt</li>
												<li><i class="icon-comment"></i> icon-comment</li>
												<li><i class="icon-comments-alt"></i> icon-comments-alt</li>
												<li><i class="icon-comments"></i> icon-comments</li>
												<li><i class="icon-credit-card"></i> icon-credit-card</li>
												<li><i class="icon-crop"></i> icon-crop</li>
												<li><i class="icon-dashboard"></i> icon-dashboard</li>
												<li><i class="icon-desktop"></i> icon-desktop</li>
												<li><i class="icon-download-alt"></i> icon-download-alt</li>
												<li><i class="icon-download"></i> icon-download</li>
												<li><i class="icon-edit-sign"></i> icon-edit-sign</li>
												<li><i class="icon-edit"></i> icon-edit</li>
												<li><i class="icon-ellipsis-horizontal"></i>
													icon-ellipsis-horizontal</li>
												<li><i class="icon-ellipsis-vertical"></i>
													icon-ellipsis-vertical</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-envelope-alt"></i> icon-envelope-alt</li>
												<li><i class="icon-envelope"></i> icon-envelope</li>
												<li><i class="icon-eraser"></i> icon-eraser</li>
												<li><i class="icon-exchange"></i> icon-exchange</li>
												<li><i class="icon-exclamation-sign"></i>
													icon-exclamation-sign</li>
												<li><i class="icon-exclamation"></i> icon-exclamation</li>
												<li><i class="icon-expand-alt"></i> icon-expand-alt</li>
												<li><i class="icon-external-link-sign"></i>
													icon-external-link-sign</li>
												<li><i class="icon-external-link"></i> icon-external-link</li>
												<li><i class="icon-eye-close"></i> icon-eye-close</li>
												<li><i class="icon-eye-open"></i> icon-eye-open</li>
												<li><i class="icon-facetime-video"></i> icon-facetime-video</li>
												<li><i class="icon-fighter-jet"></i> icon-fighter-jet</li>
												<li><i class="icon-film"></i> icon-film</li>
												<li><i class="icon-filter"></i> icon-filter</li>
												<li><i class="icon-fire-extinguisher"></i>
													icon-fire-extinguisher</li>
												<li><i class="icon-fire"></i> icon-fire</li>
												<li><i class="icon-flag-alt"></i> icon-flag-alt</li>
												<li><i class="icon-flag-checkered"></i> icon-flag-checkered</li>
												<li><i class="icon-flag"></i> icon-flag</li>
												<li><i class="icon-folder-close-alt"></i>
													icon-folder-close-alt</li>
												<li><i class="icon-folder-close"></i> icon-folder-close</li>
												<li><i class="icon-folder-open-alt"></i>
													icon-folder-open-alt</li>
												<li><i class="icon-folder-open"></i> icon-folder-open</li>
												<li><i class="icon-food"></i> icon-food</li>
												<li><i class="icon-frown"></i> icon-frown</li>
												<li><i class="icon-gamepad"></i> icon-gamepad</li>
												<li><i class="icon-gift"></i> icon-gift</li>
												<li><i class="icon-glass"></i> icon-glass</li>
												<li><i class="icon-globe"></i> icon-globe</li>
												<li><i class="icon-group"></i> icon-group</li>
												<li><i class="icon-hdd"></i> icon-hdd</li>
												<li><i class="icon-headphones"></i> icon-headphones</li>
												<li><i class="icon-heart-empty"></i> icon-heart-empty</li>
												<li><i class="icon-heart"></i> icon-heart</li>
												<li><i class="icon-home"></i> icon-home</li>
												<li><i class="icon-inbox"></i> icon-inbox</li>
												<li><i class="icon-info-sign"></i> icon-info-sign</li>
												<li><i class="icon-info"></i> icon-info</li>
												<li><i class="icon-key"></i> icon-key</li>
												<li><i class="icon-keyboard"></i> icon-keyboard</li>
												<li><i class="icon-laptop"></i> icon-laptop</li>
												<li><i class="icon-leaf"></i> icon-leaf</li>
												<li><i class="icon-legal"></i> icon-legal</li>
												<li><i class="icon-lemon"></i> icon-lemon</li>
												<li><i class="icon-level-down"></i> icon-level-down</li>
												<li><i class="icon-level-up"></i> icon-level-up</li>
												<li><i class="icon-lightbulb"></i> icon-lightbulb</li>
												<li><i class="icon-location-arrow"></i> icon-location-arrow</li>
												<li><i class="icon-lock"></i> icon-lock</li>
												<li><i class="icon-magic"></i> icon-magic</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-magnet"></i> icon-magnet</li>
												<li><i class="icon-mail-forward"></i> icon-mail-forward <span
													class="muted">(alias)</span></li>
												<li><i class="icon-mail-reply"></i> icon-mail-reply <span
													class="muted">(alias)</span></li>
												<li><i class="icon-mail-reply-all"></i> icon-mail-reply-all
													<span class="muted">(alias)</span></li>
												<li><i class="icon-map-marker"></i> icon-map-marker</li>
												<li><i class="icon-meh"></i> icon-meh</li>
												<li><i class="icon-microphone-off"></i> icon-microphone-off</li>
												<li><i class="icon-microphone"></i> icon-microphone</li>
												<li><i class="icon-minus-sign-alt"></i> icon-minus-sign-alt</li>
												<li><i class="icon-minus-sign"></i> icon-minus-sign</li>
												<li><i class="icon-minus"></i> icon-minus</li>
												<li><i class="icon-mobile-phone"></i> icon-mobile-phone</li>
												<li><i class="icon-money"></i> icon-money</li>
												<li><i class="icon-move"></i> icon-move</li>
												<li><i class="icon-music"></i> icon-music</li>
												<li><i class="icon-off"></i> icon-off</li>
												<li><i class="icon-ok-circle"></i> icon-ok-circle</li>
												<li><i class="icon-ok-sign"></i> icon-ok-sign</li>
												<li><i class="icon-ok"></i> icon-ok</li>
												<li><i class="icon-pencil"></i> icon-pencil</li>
												<li><i class="icon-phone-sign"></i> icon-phone-sign</li>
												<li><i class="icon-phone"></i> icon-phone</li>
												<li><i class="icon-search"></i> icon-picture</li>
												<li><i class="icon-plane"></i> icon-plane</li>
												<li><i class="icon-plus-sign"></i> icon-plus-sign</li>
												<li><i class="icon-plus"></i> icon-plus</li>
												<li><i class="icon-print"></i> icon-print</li>
												<li><i class="icon-pushpin"></i> icon-pushpin</li>
												<li><i class="icon-puzzle-piece"></i> icon-puzzle-piece</li>
												<li><i class="icon-qrcode"></i> icon-qrcode</li>
												<li><i class="icon-question-sign"></i> icon-question-sign</li>
												<li><i class="icon-question"></i> icon-question</li>
												<li><i class="icon-quote-left"></i> icon-quote-left</li>
												<li><i class="icon-quote-right"></i> icon-quote-right</li>
												<li><i class="icon-random"></i> icon-random</li>
												<li><i class="icon-refresh"></i> icon-refresh</li>
												<li><i class="icon-remove-circle"></i> icon-remove-circle</li>
												<li><i class="icon-remove-sign"></i> icon-remove-sign</li>
												<li><i class="icon-remove"></i> icon-remove</li>
												<li><i class="icon-reorder"></i> icon-reorder</li>
												<li><i class="icon-reply-all"></i> icon-reply-all</li>
												<li><i class="icon-reply"></i> icon-reply</li>
												<li><i class="icon-resize-horizontal"></i>
													icon-resize-horizontal</li>
												<li><i class="icon-resize-vertical"></i>
													icon-resize-vertical</li>
												<li><i class="icon-retweet"></i> icon-retweet</li>
												<li><i class="icon-road"></i> icon-road</li>
												<li><i class="icon-rocket"></i> icon-rocket</li>
												<li><i class="icon-rotate-left"></i> icon-rotate-left <span
													class="muted">(alias)</span></li>
												<li><i class="icon-rotate-right"></i> icon-rotate-right <span
													class="muted">(alias)</span></li>
												<li><i class="icon-rss-sign"></i> icon-rss-sign</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-rss"></i> icon-rss</li>
												<li><i class="icon-screenshot"></i> icon-screenshot</li>
												<li><i class="icon-search"></i> icon-search</li>
												<li><i class="icon-share-alt"></i> icon-share-alt</li>
												<li><i class="icon-share-sign"></i> icon-share-sign</li>
												<li><i class="icon-share"></i> icon-share</li>
												<li><i class="icon-shield"></i> icon-shield</li>
												<li><i class="icon-shopping-cart"></i> icon-shopping-cart</li>
												<li><i class="icon-sign-blank"></i> icon-sign-blank</li>
												<li><i class="icon-signal"></i> icon-signal</li>
												<li><i class="icon-signin"></i> icon-signin</li>
												<li><i class="icon-signout"></i> icon-signout</li>
												<li><i class="icon-sitemap"></i> icon-sitemap</li>
												<li><i class="icon-smile"></i> icon-smile</li>
												<li><i class="icon-sort-down"></i> icon-sort-down</li>
												<li><i class="icon-sort-up"></i> icon-sort-up</li>
												<li><i class="icon-sort"></i> icon-sort</li>
												<li><i class="icon-spinner"></i> icon-spinner</li>
												<li><i class="icon-star-empty"></i> icon-star-empty</li>
												<li><i class="icon-star-half-full"></i> icon-star-half-full
													<span class="muted">(alias)</span></li>
												<li><i class="icon-star-half-empty"></i>
													icon-star-half-empty</li>
												<li><i class="icon-star-half"></i> icon-star-half</li>
												<li><i class="icon-star"></i> icon-star</li>
												<li><i class="icon-tablet"></i> icon-tablet</li>
												<li><i class="icon-tag"></i> icon-tag</li>
												<li><i class="icon-tags"></i> icon-tags</li>
												<li><i class="icon-tasks"></i> icon-tasks</li>
												<li><i class="icon-terminal"></i> icon-terminal</li>
												<li><i class="icon-thumbs-down"></i> icon-thumbs-down</li>
												<li><i class="icon-thumbs-up"></i> icon-thumbs-up</li>
												<li><i class="icon-ticket"></i> icon-ticket</li>
												<li><i class="icon-time"></i> icon-time</li>
												<li><i class="icon-tint"></i> icon-tint</li>
												<li><i class="icon-trash"></i> icon-trash</li>
												<li><i class="icon-trophy"></i> icon-trophy</li>
												<li><i class="icon-truck"></i> icon-truck</li>
												<li><i class="icon-umbrella"></i> icon-umbrella</li>
												<li><i class="icon-unlock-alt"></i> icon-unlock-alt</li>
												<li><i class="icon-unlock"></i> icon-unlock</li>
												<li><i class="icon-upload-alt"></i> icon-upload-alt</li>
												<li><i class="icon-upload"></i> icon-upload</li>
												<li><i class="icon-user-md"></i> icon-user-md</li>
												<li><i class="icon-user"></i> icon-user</li>
												<li><i class="icon-volume-down"></i> icon-volume-down</li>
												<li><i class="icon-volume-off"></i> icon-volume-off</li>
												<li><i class="icon-volume-up"></i> icon-volume-up</li>
												<li><i class="icon-warning-sign"></i> icon-warning-sign</li>
												<li><i class="icon-wrench"></i> icon-wrench</li>
												<li><i class="icon-zoom-in"></i> icon-zoom-in</li>
												<li><i class="icon-zoom-out"></i> icon-zoom-out</li>
											</ul>
										</div>
										</section>

										<section id="text-editor" class="row">
										<div class="span12">
											<h2 class="page-header">Text Editor Icons</h2>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-file"></i> icon-file</li>
												<li><i class="icon-file-alt"></i> icon-file-alt</li>
												<li><i class="icon-cut"></i> icon-cut</li>
												<li><i class="icon-copy"></i> icon-copy</li>
												<li><i class="icon-paste"></i> icon-paste</li>
												<li><i class="icon-save"></i> icon-save</li>
												<li><i class="icon-undo"></i> icon-undo</li>
												<li><i class="icon-repeat"></i> icon-repeat</li>
												<li><i class="icon-text-height"></i> icon-text-height</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-text-width"></i> icon-text-width</li>
												<li><i class="icon-align-left"></i> icon-align-left</li>
												<li><i class="icon-align-center"></i> icon-align-center</li>
												<li><i class="icon-align-right"></i> icon-align-right</li>
												<li><i class="icon-align-justify"></i> icon-align-justify</li>
												<li><i class="icon-indent-left"></i> icon-indent-left</li>
												<li><i class="icon-indent-right"></i> icon-indent-right</li>
												<li><i class="icon-font"></i> icon-font</li>
												<li><i class="icon-bold"></i> icon-bold</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-italic"></i> icon-italic</li>
												<li><i class="icon-strikethrough"></i> icon-strikethrough</li>
												<li><i class="icon-underline"></i> icon-underline</li>
												<li><i class="icon-superscript"></i> icon-superscript</li>
												<li><i class="icon-subscript"></i> icon-subscript</li>
												<li><i class="icon-link"></i> icon-link</li>
												<li><i class="icon-unlink"></i> icon-unlink</li>
												<li><i class="icon-paper-clip"></i> icon-paper-clip</li>
												<li><i class="icon-eraser"></i> icon-eraser</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-columns"></i> icon-columns</li>
												<li><i class="icon-table"></i> icon-table</li>
												<li><i class="icon-th-large"></i> icon-th-large</li>
												<li><i class="icon-th"></i> icon-th</li>
												<li><i class="icon-th-list"></i> icon-th-list</li>
												<li><i class="icon-list"></i> icon-list</li>
												<li><i class="icon-list-ol"></i> icon-list-ol</li>
												<li><i class="icon-list-ul"></i> icon-list-ul</li>
												<li><i class="icon-list-alt"></i> icon-list-alt</li>
											</ul>
										</div>
										</section>

										<section id="directional" class="row">
										<div class="span12">
											<h2 class="page-header">Directional Icons</h2>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-angle-left"></i> icon-angle-left</li>
												<li><i class="icon-angle-right"></i> icon-angle-right</li>
												<li><i class="icon-angle-up"></i> icon-angle-up</li>
												<li><i class="icon-angle-down"></i> icon-angle-down</li>
												<li><i class="icon-arrow-down"></i> icon-arrow-down</li>
												<li><i class="icon-arrow-left"></i> icon-arrow-left</li>
												<li><i class="icon-arrow-right"></i> icon-arrow-right</li>
												<li><i class="icon-arrow-up"></i> icon-arrow-up</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-caret-down"></i> icon-caret-down</li>
												<li><i class="icon-caret-left"></i> icon-caret-left</li>
												<li><i class="icon-caret-right"></i> icon-caret-right</li>
												<li><i class="icon-caret-up"></i> icon-caret-up</li>
												<li><i class="icon-chevron-down"></i> icon-chevron-down</li>
												<li><i class="icon-chevron-left"></i> icon-chevron-left</li>
												<li><i class="icon-chevron-right"></i> icon-chevron-right</li>
												<li><i class="icon-chevron-up"></i> icon-chevron-up</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-chevron-sign-left"></i>
													icon-chevron-sign-left</li>
												<li><i class="icon-chevron-sign-right"></i>
													icon-chevron-sign-right</li>
												<li><i class="icon-chevron-sign-up"></i>
													icon-chevron-sign-up</li>
												<li><i class="icon-chevron-sign-down"></i>
													icon-chevron-sign-down</li>
												<li><i class="icon-circle-arrow-down"></i>
													icon-circle-arrow-down</li>
												<li><i class="icon-circle-arrow-left"></i>
													icon-circle-arrow-left</li>
												<li><i class="icon-circle-arrow-right"></i>
													icon-circle-arrow-right</li>
												<li><i class="icon-circle-arrow-up"></i>
													icon-circle-arrow-up</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-double-angle-left"></i>
													icon-double-angle-left</li>
												<li><i class="icon-double-angle-right"></i>
													icon-double-angle-right</li>
												<li><i class="icon-double-angle-up"></i>
													icon-double-angle-up</li>
												<li><i class="icon-double-angle-down"></i>
													icon-double-angle-down</li>
												<li><i class="icon-hand-down"></i> icon-hand-down</li>
												<li><i class="icon-hand-left"></i> icon-hand-left</li>
												<li><i class="icon-hand-right"></i> icon-hand-right</li>
												<li><i class="icon-hand-up"></i> icon-hand-up</li>
											</ul>
										</div>
										</section>

										<section id="video-player" class="row">
										<div class="span12">
											<h2 class="page-header">Video Player Icons</h2>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-play-circle"></i> icon-play-circle</li>
												<li><i class="icon-play-sign"></i> icon-play-sign</li>
												<li><i class="icon-play"></i> icon-play</li>
												<li><i class="icon-pause"></i> icon-pause</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-stop"></i> icon-stop</li>
												<li><i class="icon-eject"></i> icon-eject</li>
												<li><i class="icon-backward"></i> icon-backward</li>
												<li><i class="icon-forward"></i> icon-forward</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-fast-backward"></i> icon-fast-backward</li>
												<li><i class="icon-fast-forward"></i> icon-fast-forward</li>
												<li><i class="icon-step-backward"></i> icon-step-backward</li>
												<li><i class="icon-step-forward"></i> icon-step-forward</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-fullscreen"></i> icon-fullscreen</li>
												<li><i class="icon-resize-full"></i> icon-resize-full</li>
												<li><i class="icon-resize-small"></i> icon-resize-small</li>
											</ul>
										</div>
										</section>

										<section id="brand" class="row">
										<div class="span12">
											<h2 class="page-header">Brand Icons</h2>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-css3"></i> icon-css3</li>
												<li><i class="icon-facebook"></i> icon-facebook</li>
												<li><i class="icon-facebook-sign"></i> icon-facebook-sign</li>
												<li><i class="icon-twitter"></i> icon-twitter</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-twitter-sign"></i> icon-twitter-sign</li>
												<li><i class="icon-github"></i> icon-github</li>
												<li><i class="icon-github-sign"></i> icon-github-sign</li>
												<li><i class="icon-html5"></i> icon-html5</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-linkedin"></i> icon-linkedin</li>
												<li><i class="icon-linkedin-sign"></i> icon-linkedin-sign</li>
												<li><i class="icon-maxcdn"></i> icon-maxcdn</li>
												<li><i class="icon-pinterest"></i> icon-pinterest</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-pinterest-sign"></i> icon-pinterest-sign</li>
												<li><i class="icon-google-plus"></i> icon-google-plus</li>
												<li><i class="icon-google-plus-sign"></i>
													icon-google-plus-sign</li>
											</ul>
										</div>
										</section>

										<section id="medical" class="row">
										<div class="span12">
											<h2 class="page-header">Medical Icons</h2>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-ambulance"></i> icon-ambulance</li>
												<li><i class="icon-beaker"></i> icon-beaker</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-h-sign"></i> icon-h-sign</li>
												<li><i class="icon-hospital"></i> icon-hospital</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-medkit"></i> icon-medkit</li>
												<li><i class="icon-plus-sign-alt"></i> icon-plus-sign-alt</li>
											</ul>
										</div>
										<div class="span3">
											<ul class="the-icons">
												<li><i class="icon-stethoscope"></i> icon-stethoscope</li>
												<li><i class="icon-user-md"></i> icon-user-md</li>
											</ul>
										</div>
										</section>


									</div>
								</div>



							</div>




							<div class="pd5">
								<label for="iconspos"><?php _e('Icons position','cb-cosmetico'); ?>
								</label> <select name="iconspos" id="iconspos"><option
										value="top">
										<?php _e('top','cb-cosmetico'); ?>
									</option>
									<option value="bottom" <?php if($iconspos=='bottom'){?>
										selected <?php } ?>>
										<?php _e('bottom','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="icons_bottom_margin"><?php _e('Icons bottom margin','cb-cosmetico'); ?>
								</label> <input name="icons_bottom_margin" type="text"
									id="icons_bottom_margin"
									value="<?php echo $icons_bottom_margin;?>" />
							</div>







						</div>
						<!-- ## TOP ICON SECTION END ##-->


						<!-- DEMO SECTION START-->

						<div class="democ">
							<br />
							<div class="pd5" style="border-top: 0px;">
								1. In order to install Cosmetico demo content select Demo
								settings option and click "SAVE ALL SETTINGS".<br /> <br /> If
								this is not new wordpress installation BACKUP your database
								before performing demo installation. You can use WP-DB-BACKUP
								plugin.<br /> <br /> <b>After clicking "Save All Settings" wait
									untill confirmation box appears. IT MAY TAKE FEW MINUTES.</b>

							</div>


							<div class="pd5" style="border-bottom: 0px;">
								<label for="demol"><?php _e('Demo settings option','cb-cosmetico'); ?>
								</label> <select name="demol" id="demol">
									<option value="">
										<?php _e('-----','cb-cosmetico'); ?>
									</option>
									<option value="normal">
										<?php _e('demo content','cb-cosmetico'); ?>
									</option>
								</select> <br />
							</div>
							<div class="pd5" style="border-bottom: 0px;">
								<label for="demo_widget"><?php _e('Load demo widgets','cb-cosmetico'); ?>
								</label> <select name="demo_widget" id="demo_widget">
									<option value="normal">
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select> <br />
							</div>
							<div class="pd5" style="border-bottom: 0px;">
								<label for="demo_atts"><?php _e('Load placeholder images','cb-cosmetico'); ?>
								</label> <select name="demo_atts" id="demo_atts">
									<option value="yes">
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
									<option value="">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
								</select> Will slow down installation. <br />
							</div>

						</div>
						<!-- ## DEMO SECTION END ##-->



						<!-- SIDEBARS SECTION START-->
						<div class="sidebars">
							<div class="pd5" style="border-top: none;">
								<label for="sideb_col"><?php _e('Sidebar Default Column','cb-cosmetico'); ?>
								</label> <select name="sideb_col" id="sideb_col"><option
										value="left">
										<?php _e('left','cb-cosmetico'); ?>
									</option>
									<option value="right" <?php if($sideb_col=='right'){?> selected
									<?php } ?>>
										<?php _e('right','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="sideb_page"><?php _e('Sidebar on pages','cb-cosmetico'); ?>?</label>
								<select name="sideb_page" id="sideb_page"><option value="no">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($sideb_page=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>

							<div class="pd5">
								<label for="sideb_post"><?php _e('Sidebar in posts','cb-cosmetico'); ?>?</label>
								<select name="sideb_post" id="sideb_post"><option value="no">
										<?php _e('no','cb-cosmetico'); ?>
									</option>
									<option value="yes" <?php if($sideb_post=='yes'){?> selected
									<?php } ?>>
										<?php _e('yes','cb-cosmetico'); ?>
									</option>
								</select>
							</div>
							<br /> <b><?php _e('Current Cosmetico Generated Sidebars','cb-cosmetico'); ?>:</b><br />
							<br />
							<?php global $wp_registered_sidebars;
$sidebars = $wp_registered_sidebars; 

if(is_array($sidebars) && !empty($sidebars)){
  foreach($sidebars as $sidebar){ 
   if($sidebar['name']!='sidebar'&&$sidebar['name']!='middlebar'&&$sidebar['name']!='after-post'&&$sidebar['name']!='shop'&&$sidebar['name']!='below-header'&&$sidebar['name']!='footer-lower'&&$sidebar['name']!='footer-top-lower'&&$sidebar['name']!='footer-top-lower-right'&&$sidebar['name']!='home-top-wide'&&$sidebar['name']!='footer-1'&&$sidebar['name']!='footer-2'&&$sidebar['name']!='footer-3'&&$sidebar['name']!='footer-4'&&$sidebar['name']!='top-header-left'&&$sidebar['name']!='top-header-right'&&$sidebar['name']!='footer-hidden'&&$sidebar['name']!='top-widget'&&$sidebar['name']!='slider')  
   echo '<input type="text" value="'.$sidebar['name'].'" id="'.$sidebar['id'].'" readonly="readonly" style="width:120px"> <input type="checkbox" id="del-'.$sidebar['id'].'" class="" name="del-'.$sidebar['id'].'" value="del"> Delete This Sidebar<br/>';
  }
 }

echo '<br/><input type="text" name="new_sidebar" id="new_sidebar" value=""/> <input type="submit" class="button-primary btn" id="add_sidebar" value="add new sidebar" style="padding:4px!important;padding-left:20px!important;padding-right:20px!important;"/>';

?>
							<br /> <br />
						</div>
						<!-- ## SIDEBARS SECTION END ##-->










						<style media="screen">
.help img {
	border: 1px solid #000;
}
</style>




						<script type="text/javascript">
jQuery('.homepage').hide();jQuery('.headermenu').hide();jQuery('.slider').hide();jQuery('.recaptcha').hide();jQuery('.wooshop').hide();jQuery('.democ').hide();jQuery('.help').hide();jQuery('.styles').hide();jQuery('.sidebars').hide();jQuery('.shortcodes').hide();jQuery('.slider2').hide();jQuery('.top-icons').hide();
jQuery('.mn a').click(function() {
jQuery('.homepage').hide();jQuery('.headermenu').hide();jQuery('.slider').hide();jQuery('.democ').hide();jQuery('.slider2').hide();jQuery('.recaptcha').hide();jQuery('.wooshop').hide();jQuery('.help').hide();jQuery('.styles').hide();jQuery('.shortcodes').hide();jQuery('.sidebars').hide();jQuery('.general').hide();jQuery('.top-icons').hide();jQuery('#homepage').removeClass('sel');jQuery('#headermenu').removeClass('sel');jQuery('#wooshop').removeClass('sel');jQuery('#slider').removeClass('sel');jQuery('#slider2').removeClass('sel');jQuery('#recaptcha').removeClass('sel');jQuery('#help').removeClass('sel');jQuery('#styles').removeClass('sel');jQuery('#sidebars').removeClass('sel');jQuery('#general').removeClass('sel');jQuery('#shortcodes').removeClass('sel');jQuery('#democ').removeClass('sel');jQuery('#top-icons').removeClass('sel');
var idd=jQuery(this).attr('id'); jQuery('#'+idd).addClass('sel'); jQuery('.'+idd).fadeIn('slow').show();
});
</script>

						<input type="hidden" name="action" value="st_data_save" /> <input
							type="hidden" name="security"
							value="<?php echo wp_create_nonce('cosmetico-settings'); ?>" />
						<input type="hidden" name="update_settings" value="Y" /> </br> </br>
						<input type="submit"
							value="<?php _e('SAVE ALL SETTINGS','cb-cosmetico'); ?>"
							class="button-primary btn" />

					</form>
				</div>
			</div>
			<div style="clear: both"></div>
		</div>
		<div style="clear: both"></div>
	</div>
	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>

<?php }

}  } else echo 'no cheatin!';
?>
