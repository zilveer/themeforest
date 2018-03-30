<div class="readmorebox">
	<a class="excerpt-read-more btn btn-primary icon icon-doc-7" href="<?php echo get_permalink($post->ID);?>" title="<?php _e("Read More", "toddlers");?>"> <?php _e("Read More", "toddlers");?></a>

<?php if ( comments_open()){?>
	<a class="excerpt-read-more btn btn-primary archive-comment-button icon icon-comment " href="<?php the_permalink($post->ID);?>#comments" title="<?php _e("View Comments", "toddlers");?>"><?php _e("View Comments", "toddlers");?></a>
<?php } //end if comments open ?>
</div>
