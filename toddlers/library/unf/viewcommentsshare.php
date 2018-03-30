<div class="readmorebox">

<?php if ( comments_open()){?>
	<a class="excerpt-read-more btn btn-primary archive-comment-button icon icon-comment" href="<?php the_permalink($post->ID);?>#comments" title="<?php _e("View Comments", "toddlers");?>"><?php _e("View Comments", "toddlers");?></a>
<?php } ?>

	<a class="excerpt-read-more btn btn-success archive-comment-button icon icon-share" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink($post->ID);?>" title="<?php _e("Share Post", "toddlers");?>" target="_blank"><?php _e("Share on Facebook", "toddlers");?></a>

</div>