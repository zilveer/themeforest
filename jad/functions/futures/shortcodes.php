<?php

/* ----- HR ----- */
function sg_sc_hr($atts, $content = "", $shortcodename = "")
{
	if (is_array($atts)) extract($atts);
	$class = (isset($class) AND !empty($class)) ? ' class="' . trim($class) . '"' : '';
	return '<hr' . $class . ' />';
}

function sg_sc_clear($atts, $content = "", $shortcodename = "")
{
	return '<div class="clear"></div>';
}

add_shortcode('hr', 'sg_sc_hr');
add_shortcode('clear', 'sg_sc_clear');


/* ----- BLOCK QUOTES ----- */
function sg_sc_block_quotes($atts, $content = "", $shortcodename = "")
{
	return '<blockquote class="block' . $shortcodename . '">' . sg_remove_autop($content) . '</blockquote>';
}

add_shortcode('quote-left', 'sg_sc_block_quotes');
add_shortcode('quote-right', 'sg_sc_block_quotes');

function sg_sc_testimonials($atts, $content = "", $shortcodename = "")
{
	extract($atts);
	return '<div class="testimonials ef-xl"><div class="ef-t-content clearfix">' . sg_remove_autop($content) . '</div><p class="ef-author">' . $name . '</p></div>';
}

add_shortcode('testimonials', 'sg_sc_testimonials');


/* ----- ALERT BOXES ----- */
function sg_sc_alerts($atts, $content = "", $shortcodename = "")
{
	$class = 'ef-alertBox ' . str_replace('alert-', 'ef-', $shortcodename);
	$class = str_replace('info', 'warning', $class);
	return '<div class="' . $class . '">' . sg_remove_autop($content) . '</div>';
}

add_shortcode('alert-info', 'sg_sc_alerts');
add_shortcode('alert-success', 'sg_sc_alerts');
add_shortcode('alert-alert', 'sg_sc_alerts');


/* ----- HEADINGS ----- */
function sg_sc_castoms($atts, $content = "", $shortcodename = "")
{
	if (is_array($atts)) extract($atts);
	$class = (isset($class) AND !empty($class)) ? ' class="' . trim($class) . '"' : '';
	return '<' . $shortcodename . $class . '>' . sg_remove_autop($content) . '</' . $shortcodename . '>';
}

add_shortcode('h1', 'sg_sc_castoms');
add_shortcode('h2', 'sg_sc_castoms');
add_shortcode('h3', 'sg_sc_castoms');
add_shortcode('h4', 'sg_sc_castoms');
add_shortcode('h5', 'sg_sc_castoms');
add_shortcode('h6', 'sg_sc_castoms');


/* ----- SOCIAL ----- */
function sg_sc_social_list($atts, $content = "", $shortcodename = "")
{
	global $sg_social_list_open;
	$sg_social_list_open = TRUE;
	$content = sg_remove_autop($content);
	$sg_social_list_open = FALSE;
	return '<div class="ef-team-social">' . $content . '</div>';
}

function sg_sc_social($atts, $content = "", $shortcodename = "")
{
	global $sg_social_list_open;
	if (!$sg_social_list_open) return '';
	if (is_array($atts)) extract($atts);
	$icon = str_replace('social-', '', $shortcodename);
	$title = (isset($title) AND !empty($title)) ? trim($title) : ucfirst($icon);
	$href = (isset($href) AND !empty($href)) ? trim($href) : '#';
	return '<a target="_blank" href="' . $href . '" title="' . $title . '" class="ef-team-' . $icon . '">' . SG_HTML::image(get_template_directory_uri() . '/images/social/team-' . $icon . '.png') . $title . '</a><br />';
}

add_shortcode('social_list', 'sg_sc_social_list');
add_shortcode('social-skype', 'sg_sc_social');
add_shortcode('social-dribbble', 'sg_sc_social');
add_shortcode('social-twitter', 'sg_sc_social');
add_shortcode('social-facebook', 'sg_sc_social');
add_shortcode('social-flickr', 'sg_sc_social');
add_shortcode('social-linkedin', 'sg_sc_social');
add_shortcode('social-deviantart', 'sg_sc_social');
add_shortcode('social-pinterest', 'sg_sc_social');
add_shortcode('social-vimeo', 'sg_sc_social');
add_shortcode('social-tumblr', 'sg_sc_social');
add_shortcode('social-behance', 'sg_sc_social');
add_shortcode('social-gp', 'sg_sc_social');


/* ----- HIGHTLIGHT ----- */
function sg_sc_highlights($atts, $content = "", $shortcodename = "")
{
	if (is_array($atts)) extract($atts);
	$color = (isset($color) AND !empty($color)) ? ' style="background:' . trim($color) . ';"' : '';
	$class = 'highlight-' . str_replace('h1-', '', $shortcodename);

	return '<span class="' . $class . '"' . $color . '>' . sg_remove_autop($content) . '</span>';
}

add_shortcode('hl-theme', 'sg_sc_highlights');
add_shortcode('hl-red', 'sg_sc_highlights');
add_shortcode('hl-blue', 'sg_sc_highlights');
add_shortcode('hl-green', 'sg_sc_highlights');
add_shortcode('hl-grey', 'sg_sc_highlights');
add_shortcode('hl-black', 'sg_sc_highlights');
add_shortcode('hl-orange', 'sg_sc_highlights');
add_shortcode('hl-gold', 'sg_sc_highlights');
add_shortcode('hl-lime', 'sg_sc_highlights');
add_shortcode('hl-turquoise', 'sg_sc_highlights');
add_shortcode('hl-violet', 'sg_sc_highlights');
add_shortcode('hl-custom', 'sg_sc_highlights');


/* ----- DROPCASTS ----- */
function sg_sc_dropcaps($atts, $content = "", $shortcodename = "")
{
	if (is_array($atts)) extract($atts);
	$color = (isset($color) AND !empty($color)) ? ' style="background-color:' . trim($color) . ';"' : '';
	$class = (isset($style) AND !empty($style)) ? ' ef-' . $style : '';

	return '<span class="ef-first' . $class . '"' . $color . '>' . trim($letter) . '</span>';
}

add_shortcode('dropcap', 'sg_sc_dropcaps');


/* ----- LISTS ----- */
function sg_sc_lists($atts, $content = "", $shortcodename = "")
{
	if (is_array($atts)) extract($atts);
	$class = str_replace('-list', '', $shortcodename);
	$class = (isset($style) AND !empty($style)) ? $class . ' ef-' . $style : $class;
	$content = str_replace('[/li]<br />', '[/li]', $content);
	return '<ul class="' . $class . '">' . sg_remove_autop($content) . '</ul>';
}

function sg_sc_lists_ittem($atts, $content = "", $shortcodename = "")
{
	return '<li>' . sg_remove_autop($content) . '</li>';
}

add_shortcode('checkboxes-list', 'sg_sc_lists');
add_shortcode('star-list', 'sg_sc_lists');
add_shortcode('arrow-list', 'sg_sc_lists');
add_shortcode('colored-disc-list', 'sg_sc_lists');
add_shortcode('arrow-bullet-list', 'sg_sc_lists');
add_shortcode('li', 'sg_sc_lists_ittem');


/* ----- COLUMN LAYOUTS ----- */
function sg_sc_column_layouts($atts, $content = "", $shortcodename = "")
{
	return '<div class="' . str_replace('_last', ' omega', $shortcodename) . '">' . sg_remove_autop($content) . '</div>' . (strpos($shortcodename, '_last') !== FALSE ? '<div class="clear"></div>' : '');
}

add_shortcode('one_sixth', 'sg_sc_column_layouts');
add_shortcode('one_sixth_last', 'sg_sc_column_layouts');
add_shortcode('one_fifth', 'sg_sc_column_layouts');
add_shortcode('one_fifth_last', 'sg_sc_column_layouts');
add_shortcode('one_fourth', 'sg_sc_column_layouts');
add_shortcode('one_fourth_last', 'sg_sc_column_layouts');
add_shortcode('one_third', 'sg_sc_column_layouts');
add_shortcode('one_third_last', 'sg_sc_column_layouts');
add_shortcode('one_half', 'sg_sc_column_layouts');
add_shortcode('one_half_last', 'sg_sc_column_layouts');
add_shortcode('two_thirds', 'sg_sc_column_layouts');
add_shortcode('two_thirds_last', 'sg_sc_column_layouts');
add_shortcode('three_fourth', 'sg_sc_column_layouts');
add_shortcode('three_fourth_last', 'sg_sc_column_layouts');


/* ----- BUTTONS ----- */
function sg_sc_shortcode_button($atts, $content = "", $shortcodename = "")
{
	if (is_array($atts)) extract($atts);
	$url = (isset($url) AND !empty($url) AND $url != '#') ? $url : get_permalink();
	$style = (isset($color) AND !empty($color) AND isset($hover) AND !empty($hover)) ? ' rel="b" style="background-color:' . $color . ';"' : '';
	$style = (!empty($style) AND stripos($type, 'link') !== FALSE) ? ' rel="c" style="color:' . $color . ';"' : $style;
	$color = (isset($color) AND !empty($color)) ? ' crel="' . $color . '"' : '';
	$hover = (isset($hover) AND !empty($hover)) ? ' hrel="' . $hover . '"' : '';
	$target = (isset($target) AND !empty($target)) ? ' target="' . $target . '"' : '';
	$type = (isset($type) AND !empty($type)) ? explode(' ', $type) : array();
	$type = (!empty($type)) ? ' ef-' . implode(' ef-', $type) : '';
	$type = (!empty($style)) ? ' ef-custom' . $type : $type;

	return '<a class="ef-button' . $type . '" href="' . $url . '"' . $color . $hover . $target . $style . '><span>' . $text . '</span></a>';
}

add_shortcode('button', 'sg_sc_shortcode_button');


/* ----- PROGRESS BAR ----- */
function sg_sc_progress($atts, $content = "", $shortcodename = "")
{
	if (is_array($atts)) extract($atts);
	$value = (isset($value) AND !empty($value)) ? $value : '0';

	return '<div class="ef-progress-bar">' . $title . '<div data-id="' . $value . '"></div></div>';
}

add_shortcode('progress', 'sg_sc_progress');


/* ----- TABS ----- */
function sg_sc_tabs($atts, $content = null)
{
	extract(shortcode_atts(array(), $atts));
	global $tab_count_1;
	global $tab_count_2;
	$tab_count_1++;
	$tab_count_2++;
	$out = '<div class="sg-sc-tabs ef-tabs">';
	$out .= '<ul class="tabs-nav">';
	$counter = 1;

	foreach ($atts as $tab) {
		if ($counter == 1) {
			$first = 'first';
		} else {
			$first = '';
		}
		$out .= '<li class="' . $first . '"><a title="' . $tab . '" href="#tab-' . $tab_count_1 . '">' . $tab . '</a></li>';
		$tab_count_1++;
		$counter++;
	}
	$out .= '</ul>';
	$content = str_replace('[/tab]<br />', '[/tab]', $content);
	$out .= sg_remove_autop($content) . '</div>';
	return $out;
}

function sg_sc_panes($atts, $content = null)
{
	global $tab_count_2;
	$out = '<div class="tab" id="tab-' . $tab_count_2 . '">' . sg_remove_autop($content) . '</div>';
	$tab_count_2++;
	return $out;
}

add_shortcode('tabs', 'sg_sc_tabs');
add_shortcode('tab', 'sg_sc_panes');


/* ----- ACCORDION ----- */
function sg_sc_accordion($atts, $content = null)
{
	$content = str_replace('[/section]<br />', '[/section]', $content);
	return '<div class="accordion">' . sg_remove_autop($content) . '</div>';
}

function sg_sc_section($atts, $content = null)
{
	if (is_array($atts)) extract($atts);
	$out = '<h4><a href="#">' . $title . '</a></h4>';
	$out .= '<div>' . sg_remove_autop($content) . '</div>';
	return $out;
}

add_shortcode('accordion', 'sg_sc_accordion');
add_shortcode('section', 'sg_sc_section');


/* ----- TOGGLE BOXES ----- */
function sg_sc_toggle($atts, $content = null)
{
	$content = str_replace('[/box]<br />', '[/box]', $content);
	return '<ul class="ef-toggle-box">' . sg_remove_autop($content) . '</ul>';
}

function sg_sc_box($atts, $content = null)
{
	if (is_array($atts)) extract($atts);
	$out = '<li' . (isset($status) ? ' class="' . $status . '"' : '') . '>';
	$out .= '<h4 class="toggle-head">' . $title . '</h4>';
	$out .= '<div class="toggle-content"><div>' . sg_remove_autop($content) . '</div></div>';
	$out .= '</li>';
	return $out;
}

add_shortcode('toggle', 'sg_sc_toggle');
add_shortcode('box', 'sg_sc_box');


/* ----- TABLE ----- */
function sg_sc_table($atts, $content = null)
{
	$content = str_replace('[/tr]<br />', '[/tr]', $content);
	return '<table>' . sg_remove_autop($content) . '</table>';
}

function sg_sc_tr($atts, $content = null)
{
	if (is_array($atts)) extract($atts);
	$align = (isset($align) AND !empty($align)) ? ' align="' . $align . '"' : '';
	$content = str_replace('[/th]<br />', '[/th]', $content);
	$content = str_replace('[/td]<br />', '[/td]', $content);
	return '<tr' . $align . '>' . sg_remove_autop($content) . '</tr>';
}

function sg_sc_th($atts, $content = null)
{
	$content = str_replace(array('<p>', '</p>'), '', $content);
	return '<th>' . trim(sg_remove_autop($content)) . '</th>';
}

function sg_sc_td($atts, $content = null)
{
	$content = str_replace('</p>', '<br />', $content);
	$content = str_replace('<p>', '', $content);
	return '<td>' . trim(sg_remove_autop($content)) . '</td>';
}

add_shortcode('table', 'sg_sc_table');
add_shortcode('tr', 'sg_sc_tr');
add_shortcode('th', 'sg_sc_th');
add_shortcode('td', 'sg_sc_td');


/* ----- PRICE TABLE ----- */
function sg_sc_price($atts, $content = null)
{
	global $price_items_count;
	$price_items_count = substr_count($content, '[/item]');
	$content = str_replace('[/item]<br />', '[/item]', $content);
	return '<div class="price-table">' . sg_remove_autop($content) . '<div class="clear"></div></div>';
}

function sg_sc_item($atts, $content = null)
{
	if (is_array($atts)) extract($atts);
	$type = (isset($type) AND !empty($type)) ? ' ' . $type : '';
	$price = (isset($price) AND !empty($price)) ? '<div class="price-tag"><span>' . $price . ((isset($sup) AND !empty($sup)) ? '<sup> ' . $sup . '</sup>' : '') . '</span></div>' : '';
	$title = (isset($title) AND !empty($title)) ? '<div class="price-title">' . $title . '</div>' : '';
	$moretitle = (isset($moretitle) AND !empty($moretitle)) ? $moretitle : __('Read More', SG_TDN);
	$more = (isset($more) AND !empty($more) AND $more != '#') ? '<a href="' . $more . '" class="ef-button"><span>' . $moretitle . '</span></a>' : '';

	global $price_items_count;
	$style = ' style="width:' . floor(100 / $price_items_count) . '%;"';

	return '<div class="pt-column"' . $style . '><div class="price-item' . $type . '">' . $price . $title . '<div class="price-content"><ul>' . sg_remove_autop($content) . '</ul></div>' . $more . '</div></div>';
}

function sg_sc_yesno($atts, $content = null, $shortcodename = "")
{
	if (is_array($atts)) extract($atts);
	return '<li class="ef-' . $shortcodename . '"><span>' . trim(sg_remove_autop($text)) . '</span></li>';
}

add_shortcode('price', 'sg_sc_price');
add_shortcode('item', 'sg_sc_item');
add_shortcode('yes', 'sg_sc_yesno');
add_shortcode('no', 'sg_sc_yesno');


/* ----- YOUTUBE VIDEO ----- */
function youtubeVideo($atts, $content = null)
{
	extract($atts);
	return "<div class=\"sg-youtube-short\"><iframe src=\"http://www.youtube.com/embed/$id?wmode=transparent\" width=\"320\" height=\"180\" frameborder=\"0\"  wmode=\"opaque\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";
}

add_shortcode("youtube", "youtubeVideo");


/* ----- VIMEO VIDEO ----- */
function vimeoVideo($atts, $content = null)
{
	extract($atts);
	return "<div class=\"sg-vimeo-short\"><iframe src=\"http://player.vimeo.com/video/$id\" width=\"320\" height=\"180\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";
}

add_shortcode("vimeo", "vimeoVideo");


function sg_remove_autop($content)
{
	$content = do_shortcode(shortcode_unautop($content));
	$content = preg_replace('#^<br\s?\/?>|<br\s?\/?>$#', '', $content);
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	$content = preg_replace('#<\/div><br \/>|<\/div><p><\/p>#', '</div>', $content);
	$content = preg_replace('#<\/div><\/p>#', '</div>', $content);
	return $content;
}


add_action('the_content', 'sg_the_content');
function sg_the_content($content)
{
	$content = do_shortcode(shortcode_unautop($content));
	$content = preg_replace('#^<br\s?\/?>|<br\s?\/?>$#', '', $content);
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	$content = preg_replace('#<\/div><br \/>|<\/div><\/p>#', '</div>', $content);
	$content = preg_replace('#<p><div#', '<div', $content);
	return $content;
}

add_filter('widget_text', 'do_shortcode');