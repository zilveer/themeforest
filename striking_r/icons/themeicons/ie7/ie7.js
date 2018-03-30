/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'themeicons\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon_fullscreen': '&#xe64b;',
		'icon_user': '&#xe600;',
		'icon_grid': '&#xe64c;',
		'icon_tag': '&#xe601;',
		'icon_fullscreen-exit': '&#xe64d;',
		'icon_phone': '&#xe602;',
		'icon_multiuser': '&#xe603;',
		'icon_link': '&#xe604;',
		'icon_id': '&#xe605;',
		'icon_home': '&#xe606;',
		'icon_globe': '&#xe607;',
		'icon_email': '&#xe608;',
		'icon_download': '&#xe609;',
		'icon_chain': '&#xe60a;',
		'icon_calendar': '&#xe60b;',
		'icon_addressbook': '&#xe60c;',
		'icon_comment': '&#xe60e;',
		'icon_comment-o': '&#xe60f;',
		'icon_comment-s': '&#xe610;',
		'icon_heart': '&#xe611;',
		'icon_heart-o': '&#xe612;',
		'icon_thumbs-up': '&#xe613;',
		'icon_thumbs-down': '&#xe614;',
		'icon_key': '&#xe615;',
		'icon_lightbulb': '&#xe616;',
		'icon_eye': '&#xe617;',
		'icon_help': '&#xe618;',
		'icon_marker': '&#xe619;',
		'icon_gift': '&#xe61a;',
		'icon_star': '&#xe61b;',
		'icon_flag': '&#xe61c;',
		'icon_medal': '&#xe61d;',
		'icon_clock': '&#xe61e;',
		'icon_cart': '&#xe61f;',
		'icon_trash': '&#xe620;',
		'icon_cog': '&#xe621;',
		'icon_ban': '&#xe622;',
		'icon_times': '&#xe623;',
		'icon_pencil': '&#xe624;',
		'icon_note': '&#xe625;',
		'icon_book': '&#xe626;',
		'icon_gallery': '&#xe627;',
		'icon_picture': '&#xe628;',
		'icon_movie': '&#xe629;',
		'icon_music': '&#xe62a;',
		'icon_play': '&#xe62b;',
		'icon_check': '&#xe62c;',
		'icon_check-b': '&#xe62d;',
		'icon_check-circle': '&#xe62e;',
		'icon_check-square-d': '&#xe632;',
		'icon_arrow': '&#xe633;',
		'icon_arrow-circle': '&#xe634;',
		'icon_arrow-circle-o': '&#xe635;',
		'icon_circle': '&#xe636;',
		'icon_info': '&#xe637;',
		'icon_info-o': '&#xe638;',
		'icon_question': '&#xe639;',
		'icon_question-o': '&#xe63a;',
		'icon_exclamation': '&#xe63b;',
		'icon_exclamation-triangle': '&#xe63c;',
		'icon_exclamation-circle': '&#xe63d;',
		'icon_mobile': '&#xe63e;',
		'icon_tablet': '&#xe63f;',
		'icon_desktop': '&#xe640;',
		'icon_toggle-open': '&#xe641;',
		'icon_toggle-close': '&#xe642;',
		'icon_check-circle-o': '&#xe62f;',
		'icon_check-circle-d': '&#xe630;',
		'icon_check-square': '&#xe631;',
		'icon_comments': '&#xe60d;',
		'icon_search': '&#xe645;',
		'icon_fax': '&#xe646;',
		'icon_circle-s': '&#xe647;',
		'icon_cellphone': '&#xe648;',
		'icon_angle-right': '&#xe649;',
		'icon_angle-left': '&#xe64a;',
		'icon_icon_quote-left': '&#xe643;',
		'icon_idcard': '&#xe644;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon_[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
