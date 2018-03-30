<?php

######################################################################
# social icon builder
######################################################################

function avia_social_media_icons($args = array())
{
	$icons = new avia_social_media_icons($args);
	echo $icons->html();
}



if(!class_exists('avia_social_media_icons'))
{
	class avia_social_media_icons
	{
		var $args;
		var $icons = array();
		var $html  = "";
		
		/*
		 * constructor
		 * initialize the variables necessary for all social media links
		 */
		 
		function __construct($args = array())
		{
			$default_arguments = array('outside'=>'ul', 'inside'=>'li', 'class' => 'social_bookmarks', 'append' => '');
			$this->args = array_merge($default_arguments, $args);
			
			$this->icons = apply_filters( 'avia_filter_social_icons', avia_get_option('social_icons') );
		}
		
		/*
		 * function build_icon
		 * builds the html string for a single item, with a few options for special items like rss feeds
		 */
		
		function build_icon($icon)
		{
			//special cases
			switch($icon['social_icon'])
			{
				case 'rss':  if(empty($icon['social_icon_link'])) $icon['social_icon_link'] = get_bloginfo('rss2_url'); break;
				case 'mail': if(empty($icon['social_icon_link'])) $icon['social_icon_link'] = get_permalink(avia_get_option('email_page')); break;
				case 'twitter': 
				case 'dribbble': 
				case 'vimeo': 
				case 'behance': 
				
				if(strpos($icon['social_icon_link'], 'http') === false)
				{
					$icon['social_icon_link'] = "http://".$icon['social_icon'].".com/".$icon['social_icon_link']."/";
				} 
				break;
			}
		
		
			$html  = "";
			$html .= "<".$this->args['inside']." class='".$this->args['class']."_".$icon['social_icon']."'>";
			$html .= "<a href='".$icon['social_icon_link']."'>".ucfirst($icon['social_icon'])."</a>";
			$html .= "</".$this->args['inside'].">";
			
			return $html;
		}
		
		/*
		 * function html
		 * builds the html, based on the available icons
		 */
		
		function html()
		{
			if(!empty($this->icons))
			{
				$this->html = "<".$this->args['outside']." class='noLightbox ".$this->args['class']." icon_count_".count($this->icons)."'>";
		
				foreach ($this->icons as $icon)
				{
					if(!empty($icon['social_icon'])) $this->html .= $this->build_icon($icon);
				}
				
				$this->html .= $this->args['append'];
				$this->html .= "</".$this->args['outside'].">";
			}
			
			
			return $this->html;
		}
	}
}









######################################################################
# CUSTOM FACEBOOK & Twitter BUTTON
######################################################################



function avia_facebook_like($id)
{
	return avia_social_count_network_link($id, 'facebook');
}

function avia_retweet($id)
{
	return avia_social_count_network_link($id, 'twitter');
}



function avia_social_count_network_link($id, $network)
{
	global $avia_social_links;
	
	if($avia_social_links)
	{
		$avia_social_links->new_post($id);
	}
	else
	{
		$avia_social_links = new avia_social_count($id);
	}
	
	return $avia_social_links->show_link($network);
}


if(!is_admin()){ add_action('init', 'avia_social_count_localize_script'); }

function avia_social_count_localize_script()
{
	wp_localize_script( 'avia-social', 'avia_social_count_nonce', array(
    'nonce' => wp_create_nonce( 'avia_social_count_nonce' ),
    ));
}



//check if the portfolio item was requested by an ajax call:
if(! function_exists('avia_ajax_update_social_count'))
{
	function avia_ajax_update_social_count()
	{
		$nonce = $_POST['av_nonce'];
		check_ajax_referer( 'avia_social_count_nonce', 'av_nonce' );
		if ( ! wp_verify_nonce( $nonce, 'avia_social_count_nonce' ) ) die('verification failed');
		if(!isset($_POST['post_id']) || !isset($_POST['new_count'])) die('no count or id');
		
		$id				= $_POST['post_id'];
		$key_base 		= $_POST['network'].'count-cache';
		$transient_key 	= $key_base.'-'.$id;
		$meta_key 		= "_".$key_base;
		
		update_post_meta($id, $meta_key, $_POST['new_count']);
		set_transient($transient_key, '1', 60*60); /*cache for one hour*/
			
		die();
	}
}

add_action('wp_ajax_avia_ajax_update_social_count', 'avia_ajax_update_social_count');
add_action('wp_ajax_nopriv_avia_ajax_update_social_count', 'avia_ajax_update_social_count');	



if (!class_exists('avia_social_count'))
{
	class avia_social_count
	{
		var $post_id 		= false;
		var $url 			= false;
		var $shortlink  	= false;
		var $network  		= false;
		var $transient_key 	= false;
		var $meta_key		= false;
		var $api			= array();
		var $data			= false;
		var $set_cache		= false;
		var $html			= array();
		var $max_updates 	= 40;
		var $titter_account = false;
		
		/*
		 * constructor
		 * initialize the variables necessary for all social media links
		 */
		function __construct($id = false)
		{
			$this->new_post($id);	
		}
		
		/*
		 * new_post
		 * set necessary variables for a specific post, based on the post id
		 */
		function new_post($id)
		{
			$this->post_id 		= $id !== false ? $id : @get_the_ID();
			if(!$this->post_id) return false;
			
			$this->url			= get_permalink($id);			$this->shortlink 	= wp_get_shortlink($id);
			$this->shortlink 	= $this->shortlink != "" ? $this->shortlink : $this->url;
			
			//test link// $this->url = $this->shortlink = 'http://techcrunch.com/2012/02/19/put-a-fork-in-erp/';//remove-it
			
			//set api urls
			$this->api['twitter']	= 'http://urls.api.twitter.com/1/urls/count.json?url='.urlencode($this->url);
			$this->api['facebook']	= 'http://api.facebook.com/restserver.php?method=links.getStats&urls='.urlencode($this->url);
			
			//set html structure
			$this->html['facebook'] = $this->build_facebook_link();
			$this->html['twitter']  = $this->build_twitter_link();
			
		}
		
		/*
		 * show_link
		 * displays the link of the passed social network if available
		 */
		function show_link($network)
		{
			if(!$this->post_id) return false;
			
			if(method_exists($this, $network))
			{
				$this->init_network($network);
				return $this->$network();
			}
		}
		
		
		/*
		 * init_network
		 * set variables for the current network
		 */
		function init_network($network)
		{
			$key_base 				= $network.'count-cache';
			$this->transient_key 	= $key_base.'-'.$this->post_id;
			$this->meta_key 		= "_".$key_base;
			$this->network 			= $network;
			$this->data				= $this->get_data();
		}
		
		
		/*
		 * get_data
		 * retrieve the data for the current network, either by api or by cache. if its retrieved by api set the "set_cache" var to true, so once the data is processed
		 * in the network specific function it can be stored as post meta data with an expiring transient (int) $xml->link_stat->like_count
		 */
		function get_data()
		{
			$cache 	= get_transient($this->transient_key);
			$data  	= false;
			
			if(!$cache && $this->max_updates >= 0)
			{
				$data = wp_remote_get($this->api[$this->network], array('sslverify'=>false));
				if(is_wp_error($data)) $data = false;
				$this->max_updates--;
			}
			
			if(!$data)
			{
				$data = get_post_meta($this->post_id, $this->meta_key, true);
			}
			
			if(!$data)
			{
				$data = 0;
			}
			
			return $data;
		}
		
		/*
		 * set_data
		 * set the cache for the current data set
		 */
		function set_data()
		{
			if(is_numeric($this->data))
			{
				set_transient($this->transient_key, '1', 60*60); /*cache for one hour*/
				update_post_meta($this->post_id, $this->meta_key, $this->data);
			}
		}
		
		/*
		 * create_html
		 * creates the html output for the current button based on the html array structure
		 */
		function create_html()
		{	
			return str_replace('{avia-social-count}', $this->data, $this->html[$this->network]); 
		}
		
		
		######################################################################
		# NETWORK SPECIFIC FUNCTIONS
		######################################################################
		
		/*facebook*/
		function build_facebook_link()
		{
			$param['href']		= 'http://www.facebook.com/sharer/sharer.php?';
			$param['title'] 	= 't='.urlencode(get_the_title($this->post_id));
			$param['url']		= '&amp;u='.urlencode($this->url);
			
			$sharelink 	 = "";
			$sharelink 	.= "<a data-post_id='".$this->post_id."' data-json='".$this->api['facebook']."' ";
			$sharelink 	.= "class='avia_social_link avia_facebook_likes' href='".implode("",$param)."'>";
			$sharelink 	.= "<span class='avia_count'>{avia-social-count}</span> ".__('Likes', 'avia_framework')."</a>";
			
			$sharelink 	.= '<div class="avia-facebook-like"><div class="fb-like" data-href="'.urlencode($this->url).'" data-send="false" data-layout="box_count" data-width="250" data-show-faces="false" data-font="arial"></div></div>';
			
			return $sharelink;
		}
		
		function facebook()
		{
			if(!is_numeric($this->data))
			{
				if(!empty($this->data) && !empty($this->data['body']))
				{
					$xml = simplexml_load_string($this->data['body']);
		
					if( empty( $xml->error ) && isset($xml->link_stat)) 
				    {
						$this->data = (int) $xml->link_stat->total_count;
						$this->set_data();
					}
				}
			}
		
			return $this->create_html();
		}
		
		
		/*twitter*/
				
		function build_twitter_link()
		{
			if($this->titter_account === false)
			{
				$tw_acc = "";
				$accounts = avia_get_option('social_icons');
				
				if(is_array($accounts))
				{
					foreach($accounts as $account)
					{
						if(isset($account['social_icon']) && $account['social_icon'] == 'twitter')
						{
							$account = rtrim($account['social_icon_link'],"/");
							
							if(strrpos($account,'/') !== false)
							{
								$account = substr( $account , strrpos($account,'/') + 1);
							}
							$tw_acc = $account;
							break;
						}
					}
				}
				$this->titter_account = $tw_acc;
			}
			
			
			$param['href']		= 'https://twitter.com/intent/tweet?';
			$param['title'] 	= 'text='.urlencode(get_the_title($this->post_id));
			$param['url']		= '&amp;url='.urlencode($this->shortlink);
			
			if($this->titter_account) 
			{	$param['via']	= '&amp;via='.urlencode($this->titter_account);	}
			
			$tweetlink 	 = "";
			$tweetlink 	.= "<a data-post_id='".$this->post_id."' data-json='".$this->api['twitter']."' ";
			$tweetlink 	.= "class='avia_social_link avia_retweet_link' href='".implode("",$param)."'>";
			$tweetlink 	.= "<span class='avia_count'>{avia-social-count}</span> ".__('Tweets', 'avia_framework')."</a>";
			
			return $tweetlink;
		}
		
		function twitter()
		{
			if(!is_numeric($this->data))
			{
				if(!empty($this->data) && !empty($this->data['body']))
				{
					$resp = json_decode($this->data['body'],true);
	        		if ($resp['count'] !== false) $this->data = $resp['count'];
					$this->set_data();
				}
			}
		
			return $this->create_html();
		}
	}
}








