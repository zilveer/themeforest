<?php

require_once('twitterfeed/TwitterFeed.php');
$config = include('config.php');

$twitter = new TwitterFeed($config);



$type = isset($_GET['type'])?$_GET['type']: false;
switch ($type) {
	case 'list':
		$twitter->getList(array(
			'list_id' => isset($_GET['list_id'])?$_GET['list_id']: '',
			'slug'    => isset($_GET['slug'])?$_GET['slug']: '',
			'owner_screen_name' => isset($_GET['owner_screen_name'])?$_GET['owner_screen_name']: '',
			'count'   => isset($_GET['count'])?$_GET['count']: '',
			'page'    => isset($_GET['page'])?$_GET['page']: '',
			'include_rts' => isset($_GET['include_rts'])?$_GET['include_rts']: '',
		));
		break;
	case 'favorites':
		$twitter->getFavorites(array(
			'screen_name' => isset($_GET['screen_name'])?$_GET['screen_name']: '',
			'count'   => isset($_GET['count'])?$_GET['count']: '',
			'page'    => isset($_GET['page'])?$_GET['page']: '',
		));
		break;
	case 'usertimeline':
		$twitter->getUserTimeLine(array(
			'screen_name' => isset($_GET['screen_name'])?$_GET['screen_name']: '',
			'count'   => isset($_GET['count'])?$_GET['count']: '',
			'page'    => isset($_GET['page'])?$_GET['page']: '',
			'include_rts' => isset($_GET['include_rts'])?$_GET['include_rts']: '',
		));
		break;
	case 'search':
		$twitter->getSearch(array(
			'count'   => isset($_GET['count'])?$_GET['count']: '',
			//'page'    => isset($_GET['page'])?$_GET['page']: '',
			'q' => isset($_GET['q'])?$_GET['q']: '',
		));
		break;
	default:
		echo json_encode(array(
			'errors'=>array(
				array('message'=>'Sorry, please try with a correct type.')
			)
		));
		break;
}