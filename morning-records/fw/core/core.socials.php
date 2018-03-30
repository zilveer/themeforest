<?php
/**
 * Morning records Framework: social networks
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('morning_records_socials_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_socials_theme_setup' );
	function morning_records_socials_theme_setup() {

		if ( !is_admin() ) {
			// Add og:image meta tag for facebook
			add_action( 'wp_head', 					'morning_records_facebook_og_tags', 5 );
		}

	}
}


/* Social Share and Profile links
-------------------------------------------------------------------------------- */
	
// List of social networks for site sharing and user profiles
morning_records_storage_set('share_links', array(
	'blogger' =>		'http://www.blogger.com/blog_this.pyra?t&u={link}&n={title}',
	'bobrdobr' =>		'http://bobrdobr.ru/add.html?url={link}&title={title}&desc={descr}',
	'delicious' =>		'http://delicious.com/save?url={link}&title={title}&note={descr}',
	'designbump' =>		'http://designbump.com/node/add/drigg/?url={link}&title={title}',
	'designfloat' =>	'http://www.designfloat.com/submit.php?url={link}',
	'digg' =>			'http://digg.com/submit?url={link}',
	'evernote' =>		'https://www.evernote.com/clip.action?url={link}&title={title}',
//	'facebook' =>		'http://www.facebook.com/sharer.php?s=100&p[url]={link}&p[title]={title}&p[summary]={descr}&p[images][0]={image}',
	'facebook' =>		'http://www.facebook.com/sharer.php?u={link}',
	'friendfeed' =>		'http://www.friendfeed.com/share?title={title} - {link}',
	'google' =>			'http://www.google.com/bookmarks/mark?op=edit&output=popup&bkmk={link}&title={title}&annotation={descr}',
	'gplus' => 			'https://plus.google.com/share?url={link}', 
	'identi' => 		'http://identi.ca/notice/new?status_textarea={title} - {link}', 
	'juick' => 			'http://www.juick.com/post?body={title} - {link}',
	'linkedin' => 		'http://www.linkedin.com/shareArticle?mini=true&url={link}&title={title}', 
	'liveinternet' =>	'http://www.liveinternet.ru/journal_post.php?action=n_add&cnurl={link}&cntitle={title}',
	'livejournal' =>	'http://www.livejournal.com/update.bml?event={link}&subject={title}',
	'mail' =>			'http://connect.mail.ru/share?url={link}&title={title}&description={descr}&imageurl={image}',
	'memori' =>			'http://memori.ru/link/?sm=1&u_data[url]={link}&u_data[name]={title}', 
	'mister-wong' =>	'http://www.mister-wong.ru/index.php?action=addurl&bm_url={link}&bm_description={title}', 
	'mixx' =>			'http://chime.in/chimebutton/compose/?utm_source=bookmarklet&utm_medium=compose&utm_campaign=chime&chime[url]={link}&chime[title]={title}&chime[body]={descr}', 
	'moykrug' =>		'http://share.yandex.ru/go.xml?service=moikrug&url={link}&title={title}&description={descr}',
	'myspace' =>		'http://www.myspace.com/Modules/PostTo/Pages/?u={link}&t={title}&c={descr}', 
	'newsvine' =>		'http://www.newsvine.com/_tools/seed&save?u={link}&h={title}',
	'odnoklassniki' =>	'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl={link}&title={title}', 
	'pikabu' =>			'http://pikabu.ru/add_story.php?story_url={link}',
	'pinterest' =>		'http://pinterest.com/pin/create/button/?url={link}&media={image}&description={title}',
	'posterous' =>		'http://posterous.com/share?linkto={link}&title={title}',
	'postila' =>		'http://postila.ru/publish/?url={link}&agregator=morning_records',
	'reddit' =>			'http://reddit.com/submit?url={link}&title={title}', 
	'rutvit' =>			'http://rutvit.ru/tools/widgets/share/popup?url={link}&title={title}', 
	'stumbleupon' =>	'http://www.stumbleupon.com/submit?url={link}&title={title}', 
	'surfingbird' =>	'http://surfingbird.ru/share?url={link}', 
	'technorati' =>		'http://technorati.com/faves?add={link}&title={title}', 
	'tumblr' =>			'http://www.tumblr.com/share?v=3&u={link}&t={title}&s={descr}', 
	'twitter' =>		'https://twitter.com/intent/tweet?text={title}&url={link}',
	'vk' =>				'http://vk.com/share.php?url={link}&title={title}&description={descr}',
	'vk2' =>			'http://vk.com/share.php?url={link}&title={title}&description={descr}',
	'webdiscover' =>	'http://webdiscover.ru/share.php?url={link}',
	'yahoo' =>			'http://bookmarks.yahoo.com/toolbar/savebm?u={link}&t={title}&d={descr}',
	'yandex' =>			'http://zakladki.yandex.ru/newlink.xml?url={link}&name={title}&descr={descr}',
	'ya' =>				'http://my.ya.ru/posts_add_link.xml?URL={link}&title={title}&body={descr}',
	'yosmi' =>			'http://yosmi.ru/index.php?do=share&url={link}'
	)
);

// Add social network
// Example: 1) add_share_link('pinterest', 'url');
//			2) add_share_link(array('pinterest'=>'url', 'dribble'=>'url'));
if (!function_exists('morning_records_add_share_link')) {
	function morning_records_add_share_link($soc, $url='') {
		if (!is_array($soc)) $soc = array($soc => $url);
		morning_records_storage_set('share_links', array_merge( morning_records_storage_get('share_links'), $soc ) );
	}
}

// Return (and show) share social links
if (!function_exists('morning_records_show_share_links')) {
	function morning_records_show_share_links($args) {
		if ( morning_records_get_custom_option('show_share')=='hide' ) return '';

		$args = array_merge(array(
			'post_id' => 0,						// post ID
			'post_link' => '',					// post link
			'post_title' => '',					// post title
			'post_descr' => '',					// post descr
			'post_thumb' => '',					// post featured image
			'size' => 'small',					// icons size: tiny|small|big
			'style' => morning_records_get_theme_setting('socials_type')=='images' ? 'bg' : 'icons',	// style for show icons: icons|images|bg
			'type' => 'block',					// share block type: list|block|drop
			'popup' => true,					// open share url in new window or in popup window
			'counters' => morning_records_get_custom_option('show_share_counters')=='yes',	// show share counters
			'direction' => morning_records_get_custom_option('show_share'),				// share block direction
			'caption' => morning_records_get_custom_option('share_caption'),				// share block caption
			'share' => morning_records_get_theme_option('share_buttons'),					// list of allowed socials
			'echo' => true						// if true - show on page, else - only return as string
			), $args);

		if (count($args['share'])==0) return '';
		$empty = false;
		foreach ($args['share'] as $k=>$v) {
			if (!is_array($v) || implode('', $v)=='') 
				$empty = true;
			break;
		}
		if ($empty) return '';
		
		$upload_info = wp_upload_dir();
		$upload_url = $upload_info['baseurl'];

		$output = '<div class="sc_socials sc_socials_size_'.esc_attr($args['size']).' sc_socials_share' . ($args['type']=='drop' ? ' sc_socials_drop' : ' sc_socials_dir_' . esc_attr($args['direction'])) . '">'
			. ($args['caption']!='' ? '<span class="share_caption">'.($args['caption']).'</span>' : '');

		if (is_array($args['share']) && count($args['share']) > 0) {
			foreach ($args['share'] as $soc) {
				$icon = $args['style']=='icons' || morning_records_strpos($soc['icon'], $upload_url)!==false ? $soc['icon'] : morning_records_get_socials_url(basename($soc['icon']));
				if ($args['style'] == 'icons') {
					$parts = explode('-', $soc['icon'], 2);
					$sn = isset($parts[1]) ? $parts[1] : $parts[0];
				} else {
					$sn = basename($soc['icon']);
					$sn = morning_records_substr($sn, 0, morning_records_strrpos($sn, '.'));
					if (($pos=morning_records_strrpos($sn, '_'))!==false)
						$sn = morning_records_substr($sn, 0, $pos);
				}
				$url = $soc['url'];
				if (empty($url)) $url = morning_records_storage_get_array('share_links', $sn);
			
				$link = str_replace(
					array('{id}', '{link}', '{title}', '{descr}', '{image}'),
					array(
						urlencode($args['post_id']),
						urlencode($args['post_link']),
						urlencode(strip_tags($args['post_title'])),
						urlencode(strip_tags($args['post_descr'])),
						urlencode($args['post_thumb'])
						),
					$url);
				$output .= '<div class="sc_socials_item' . (!empty($args['popup']) ? ' social_item_popup' : '') . '">'
						. '<a href="'.esc_url($soc['url']).'"'
						. ' class="social_icons social_'.esc_attr($sn).'"'
						. ($args['style']=='bg' ? ' style="background-image: url('.esc_url($icon).');"' : '')
						. ($args['popup'] ? ' data-link="' . esc_url($link) .'"' : ' target="_blank"')
						. ($args['counters'] ? ' data-count="'.esc_attr($sn).'"' : '') 
					. '>'
					. ($args['style']=='icons' 
						? '<span class="' . esc_attr($soc['icon']) . '"></span>' 
						: ($args['style']=='images' 
							? '<img src="'.esc_url($icon).'" alt="'.esc_attr($sn).'" />' 
							: '<span class="sc_socials_hover" style="background-image: url('.esc_url($icon).');"></span>'
							)
						)
					. '</a>'
					//. ($args['counters'] ? '<span class="share_counter">0</span>' : '') 
					. ($args['type']=='drop' ? '<i>' . trim(morning_records_strtoproper($sn)) . '</i>' : '')
					. '</div>';
			}
		}
		$output .= '</div>';
		if ($args['echo']) echo trim($output);
		return $output;
	}
}


// Return social icons links
if (!function_exists('morning_records_prepare_socials')) {
	function morning_records_prepare_socials($list, $style='') {
		if (empty($style)) $style = morning_records_get_theme_setting('socials_type')=='images' ? 'bg' : 'icons';
		$output = '';
		$upload_info = wp_upload_dir();
		$upload_url = $upload_info['baseurl'];
		if (is_array($list) && count($list) > 0) {
			foreach ($list as $soc) {
				if (empty($soc['url'])) continue;
				$icon = $style=='icons' || morning_records_strpos($soc['icon'], $upload_url)!==false ? $soc['icon'] : morning_records_get_socials_url(basename($soc['icon']));
				if ($style == 'icons') {
					$parts = explode('-', $soc['icon'], 2);
					$sn = isset($parts[1]) ? $parts[1] : $parts[0];
				} else {
					$sn = basename($soc['icon']);
					$sn = morning_records_substr($sn, 0, morning_records_strrpos($sn, '.'));
					if (($pos=morning_records_strrpos($sn, '_'))!==false)
						$sn = morning_records_substr($sn, 0, $pos);
				}
				$output .= '<div class="sc_socials_item">'
						. '<a href="'.esc_url($soc['url']).'" target="_blank" class="social_icons social_'.esc_attr($sn).'"'
						. ($style=='bg' ? ' style="background-image: url('.esc_url($icon).');"' : '')
						. '>'
						. ($style=='icons' 
							? '<span class="icon-' . esc_attr($sn) . '"></span>' 
							: ($style=='images' 
								? '<img src="'.esc_url($icon).'" alt="" />' 
								: '<span class="sc_socials_hover" style="background-image: url('.esc_url($icon).');"></span>'))
						. '</a>'
						. '</div>';
			}
		}
		return $output;
	}
}
	
	
/* Twitter
-------------------------------------------------------------------------------- */

if (!function_exists('morning_records_get_twitter_data')) {
	function morning_records_get_twitter_data($cfg) {
		return function_exists('trx_utils_twitter_acquire_data') 
				? trx_utils_twitter_acquire_data(array(
						'mode'            => 'user_timeline',
						'consumer_key'    => $cfg['consumer_key'],
						'consumer_secret' => $cfg['consumer_secret'],
						'token'           => $cfg['token'],
						'secret'          => $cfg['secret']
					))
				: '';
	}
}

if (!function_exists('morning_records_prepare_twitter_text')) {
	function morning_records_prepare_twitter_text($tweet) {
		$text = $tweet['text'];
		if (!empty($tweet['entities']['urls']) && count($tweet['entities']['urls']) > 0) {
			foreach ($tweet['entities']['urls'] as $url) {
				$text = str_replace($url['url'], '<a href="'.esc_url($url['expanded_url']).'" target="_blank">' . ($url['display_url']) . '</a>', $text);
			}
		}
		if (!empty($tweet['entities']['media']) && count($tweet['entities']['media']) > 0) {
			foreach ($tweet['entities']['media'] as $url) {
				$text = str_replace($url['url'], '<a href="'.esc_url($url['expanded_url']).'" target="_blank">' . ($url['display_url']) . '</a>', $text);
			}
		}
		return $text;
	}
}

// Return Twitter followers count
if (!function_exists('morning_records_get_twitter_followers')) {
	function morning_records_get_twitter_followers($cfg) {
		$data = morning_records_get_twitter_data($cfg); 
		return $data && isset($data[0]['user']['followers_count']) ? $data[0]['user']['followers_count'] : 0;
	}
}



/* Facebook
-------------------------------------------------------------------------------- */

if (!function_exists('morning_records_get_facebook_likes')) {
	function morning_records_get_facebook_likes($account) {
		$fb = get_transient("facebooklikes");
		if ($fb !== false) return $fb;
		$fb = '?';
		$url = esc_url(morning_records_get_protocol().'http://graph.facebook.com/'.($account));
		$headers = get_headers($url);
		if (morning_records_strpos($headers[0], '200')) {
			$json = morning_records_fgc($url);
			$rez = json_decode($json, true);
			if (isset($rez['likes']) ) {
				$fb = $rez['likes'];
				set_transient("facebooklikes", $fb, 60*60);
			}
		}
		return $fb;
	}
}


// Add facebook meta tags for post/page sharing
if (!function_exists('morning_records_facebook_og_tags')) {
	function morning_records_facebook_og_tags() {
		global $post;
		if ( !is_singular() || morning_records_storage_get('blog_streampage')) return;
		if (has_post_thumbnail( $post->ID )) {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>' . "\n";
		}
		//echo '<meta property="og:title" content="' . esc_attr( strip_tags( get_the_title() ) ) . '" />' . "\n"
		//	.'<meta property="og:description" content="' . esc_attr( strip_tags( strip_shortcodes( get_the_excerpt()) ) ) . '" />' . "\n"
		//	.'<meta property="og:url" content="' . esc_attr( get_permalink() ) . '" />';
	}
}


/* Feedburner
-------------------------------------------------------------------------------- */

if (!function_exists('morning_records_get_feedburner_counter')) {
	function morning_records_get_feedburner_counter($account) {
		$rss = get_transient("feedburnercounter");
		if ($rss !== false) return $rss;
		$rss = '?';
		$url = esc_url(morning_records_get_protocol().'://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='.($account));
		$headers = get_headers($url);
		if (morning_records_strpos($headers[0], '200')) {
			$xml = morning_records_fgc($url);
			preg_match('/circulation="(\d+)"/', $xml, $match);
			if ($match[1] != 0) {
				$rss = $match[1];
				set_transient("feedburnercounter", $rss, 60*60);
			}
		}
		return $rss;
	}
}
?>