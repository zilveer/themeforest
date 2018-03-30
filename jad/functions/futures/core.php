<?php

if (file_exists(SG_TEMPLATEPATH . '/demo/init.php')) require_once SG_TEMPLATEPATH . '/demo/init.php';
if (!defined('SG_DEMO_MODE')) define('SG_DEMO_MODE', FALSE);

require_once SG_TEMPLATEPATH . '/functions/sgpanel/modules/sgp-config.php';

function sg_init_config($post)
{
	if (!empty($post)) {
		$post_custom = get_post_custom($post->ID);
		$ptt = $post->post_type;
		$tpl = isset($post_custom['_wp_page_template']) ? $post_custom['_wp_page_template'][0] : 'default';
		$tpl = str_replace('.php', '', $tpl);
		$tpl = str_replace('pg-', '', $tpl);
		SGP_Config::init($post->ID, $ptt, $tpl);
	} else {
		SGP_Config::init(0, 'page', 'default');
	}
}
function sg_get_tpl()
{
	return SGP_Config::getTPL();
}

function _sg($module, $noinit = FALSE)
{
	if ($module == 'Modules' OR $module == 'General' OR $module == 'Theme') {
		return SGP_Config::getGModule($module);
	} else {
		return SGP_Config::getModule($module, $noinit);
	}
}

function sg_message($message)
{
	$c = '<div class="ef-alertBox ef-warning" style="text-align:center;">';
	//$c .= '<p>' . $message . '</p>';
	$c .= $message;
	$c .= '</div>';

	return $c;
}

function sg_empty_sidebar($name)
{
	$c = 'Sidebar "' . $name . '" is empty.';
	echo sg_message($c);
}

function sg_text_trim($content, $limit = 120)
{
	$sub = '';
	$len = 0;
	foreach (explode(' ', $content) as $word){
		$part = (($sub != '') ? ' ' : '') . $word;
		$sub .= $part;
		$len += strlen($part);
		if (strlen($sub) >= $limit){
			break;
		}
	}
	return $sub . (($len < strlen($content)) ? '...' : '');
}

function sg_posts_count()
{
	global $wp_query;
	return $wp_query->post_count;
}

function sg_comments_count($id = 0)
{
	$post = &get_post($id);
	return $post->comment_count;
}

function sg_paged()
{
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$paged = (get_query_var('page')) ? get_query_var('page') : $paged;
	return $paged;
}

function sg_term()
{
	$uri = $_SERVER['REQUEST_URI'];
	if (isset($_REQUEST['portfolio_tag']) OR isset($_REQUEST['portfolio_category'])) return 'portfolio';
	if (strpos($uri, _sg('General')->getPortfolioTSlug()) > 0 OR strpos($uri, _sg('General')->getPortfolioCSlug()) > 0) return 'portfolio';
	return 'blog';
}