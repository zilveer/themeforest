<?php 
	$username = $_POST['username']; 
	$tweettext = $_POST['tweettext']; 
	$postcount = $_POST['postcount']; 
?>
<ul id="twitter_update_list">
    <li><p></p></li>
</ul>
<a href="http://twitter.com/<?php echo $username; ?>" class="twitter-link"><?php echo $tweettext; ?></a>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $postcount; ?>"></script>