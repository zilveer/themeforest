<?php

function om_facebook_ids_add() {

	$admin_id=get_option(OM_THEME_PREFIX . 'fb_comments_admin_id');
	$app_id=get_option(OM_THEME_PREFIX . 'fb_comments_comments_app_id');


	if($admin_id) {
		$admin_id=explode(',',$admin_id);
		foreach($admin_id as $id) {
			echo '<meta property="fb:admins" content="'.esc_attr(trim($id)).'"/>';
		}
	}

	if($app_id)
		echo '<meta property="fb:app_id" content="'.esc_attr(trim($app_id)).'"/>';

}

add_action('wp_head', 'om_facebook_ids_add');


function om_facebook_comments() {
	
	$count=get_option( OM_THEME_PREFIX . 'fb_comments_count' );
	$color=get_option( OM_THEME_PREFIX . 'fb_comments_color' );

	$count=intval($count);
	if(!$count)
		$count=2;
		
	if($color == 'dark')
		$color=' data-colorscheme="dark"';
	else
		$color='';

	$locale=get_locale();
	
	$facebook_locales=array(
		'af_ZA',
		'ak_GH',
		'am_ET',
		'ar_AR',
		'as_IN',
		'ay_BO',
		'az_AZ',
		'be_BY',
		'bg_BG',
		'bn_IN',
		'br_FR',
		'bs_BA',
		'ca_ES',
		'cb_IQ',
		'ck_US',
		'co_FR',
		'cs_CZ',
		'cx_PH',
		'cy_GB',
		'da_DK',
		'de_DE',
		'el_GR',
		'en_GB',
		'en_IN',
		'en_PI',
		'en_UD',
		'en_US',
		'eo_EO',
		'es_CO',
		'es_ES',
		'es_LA',
		'et_EE',
		'eu_ES',
		'fa_IR',
		'fb_LT',
		'ff_NG',
		'fi_FI',
		'fo_FO',
		'fr_CA',
		'fr_FR',
		'fy_NL',
		'ga_IE',
		'gl_ES',
		'gn_PY',
		'gu_IN',
		'gx_GR',
		'ha_NG',
		'he_IL',
		'hi_IN',
		'hr_HR',
		'hu_HU',
		'hy_AM',
		'id_ID',
		'ig_NG',
		'is_IS',
		'it_IT',
		'ja_JP',
		'ja_KS',
		'jv_ID',
		'ka_GE',
		'kk_KZ',
		'km_KH',
		'kn_IN',
		'ko_KR',
		'ku_TR',
		'la_VA',
		'lg_UG',
		'li_NL',
		'lo_LA',
		'lt_LT',
		'lv_LV',
		'mg_MG',
		'mk_MK',
		'ml_IN',
		'mn_MN',
		'mr_IN',
		'ms_MY',
		'mt_MT',
		'my_MM',
		'nb_NO',
		'nd_ZW',
		'ne_NP',
		'nl_BE',
		'nl_NL',
		'nn_NO',
		'ny_MW',
		'or_IN',
		'pa_IN',
		'pl_PL',
		'ps_AF',
		'pt_BR',
		'pt_PT',
		'qu_PE',
		'rm_CH',
		'ro_RO',
		'ru_RU',
		'rw_RW',
		'sa_IN',
		'sc_IT',
		'se_NO',
		'si_LK',
		'sk_SK',
		'sl_SI',
		'sn_ZW',
		'so_SO',
		'sq_AL',
		'sr_RS',
		'sv_SE',
		'sw_KE',
		'sy_SY',
		'ta_IN',
		'te_IN',
		'tg_TJ',
		'th_TH',
		'tl_PH',
		'tl_ST',
		'tr_TR',
		'tt_RU',
		'tz_MA',
		'uk_UA',
		'ur_PK',
		'uz_UZ',
		'vi_VN',
		'wo_SN',
		'xh_ZA',
		'yi_DE',
		'yo_NG',
		'zh_CN',
		'zh_HK',
		'zh_TW',
		'zu_ZA',
		'zz_TR',
	);
	
	if(!in_array($locale,$facebook_locales)) {
		$locale='en_US';
	}
			
?>
			<div class="clear anti-mar">&nbsp;</div>
			
			<!-- FB Comments -->
			<div class="block-full bg-color-main">
				<div class="block-inner">
					<div class="widget-header"><?php _e('Comments', 'om_theme') ?></div>

					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/<?php echo esc_attr($locale) ?>/sdk.js#xfbml=1&version=v2.3";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-comments" data-href="<?php the_permalink() ?>" data-num-posts="<?php echo esc_attr($count); ?>" data-width="100%"<?php echo ( $color == 'dark' ? ' data-colorscheme="dark"' : '') ?>></div>
					
				</div>
			</div>			
			<!-- /FB Comments -->		
<?php	
}