<div class="post-content">
<?php 
$content = get_the_content();
$newcontent = preg_replace("/<p[^>]*?>/", "", $content);
$newcontent = str_replace("</p>", "", $newcontent);
$wmfi = 1;
foreach(preg_split("/((\r?\n)|(\r\n?))/", $newcontent) as $line){
    if($wmfi % 2 == 0){
		echo '<div class="chat-right">'.$line.'</div>';
	}else{
		echo '<div class="chat-left">'.$line.'</div>';
	}
	$wmfi = $wmfi + 1;
} 


?>
</div>
<div class="post-minfo"><?php the_time('F j, Y'); ?> / <?php comments_popup_link( '', __( '1 Comment / ', 'aurat2d' ), __( '% Comments / ', 'aurat2d' )); ?><?php _e( 'by', 'aurat2d' ); ?> <?php the_author_posts_link(); ?> <?php echo "/  "; the_tags(); ?></div>