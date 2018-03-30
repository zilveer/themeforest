<?php
$wp_scripts = new WP_Scripts();

$timebeforerevote = 744; // = 30 days

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

if ( !function_exists( 'post_like' ) ) {
function post_like()
{
	$nonce = $_POST['nonce'];
 
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
		
	if(isset($_POST['post_like']))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];
		
		$meta_IP = get_post_meta($post_id, "voted_IP");

	if(isset($meta_IP[0]))
	{
		$voted_IP = $meta_IP[0]; 
		if(!is_array($voted_IP))
			$voted_IP = array();}
		
		$meta_count = get_post_meta($post_id, "votes_count", true);

		if(!hasAlreadyVoted($post_id))
		{
			$voted_IP[$ip] = time();

			update_post_meta($post_id, "voted_IP", $voted_IP);
			update_post_meta($post_id, "votes_count", ++$meta_count);
			
			echo $meta_count;
		}
		else
			echo "already";
	}
	exit;
}
}


if ( !function_exists( 'hasAlreadyVoted' ) ) {
function hasAlreadyVoted($post_id)
{
	global $timebeforerevote;

	$meta_IP = get_post_meta($post_id, "voted_IP");
	if ( !isset($meta_IP[0]) ) $meta_IP[0] = '0';
	if(isset($meta_IP[0]))
	{
		$voted_IP = $meta_IP[0];
	
	if(!is_array($voted_IP))
		$voted_IP = array();
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if(in_array($ip, array_keys($voted_IP)))
	{
		$time = $voted_IP[$ip];
		$now = time();
		
		if(round(($now - $time) / 3600 ) > $timebeforerevote)
			return false;
			
		return true;
	}}
	return false;
}
}


if ( !function_exists( 'getPostLikeLink' ) ) {
function getPostLikeLink($post_id)
{

	$vote_count = get_post_meta($post_id, "votes_count", true);
	if ( empty($vote_count)) $vote_count = 0;

	echo '<span class="post-like">'."\n";
	if(hasAlreadyVoted($post_id))
		echo '<span title="'.__('I like this article', 'color-theme-framework').'" class="qtip like icon-heart alreadyvoted"></span>'."\n";
	else
		echo '<a href="#" data-post_id="'.$post_id.'">' ."\n".'<span  title="'.__('I like this article', 'color-theme-framework').'" class="qtip like icon-heart"></span></a>'."\n";
		echo '<span class="count">'.$vote_count.'</span><!-- .count -->' ."\n".'</span><!-- .post-like -->'."\n";
	
//	return $output;
}
}